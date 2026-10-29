<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackPageView
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            $this->record($request);
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (! config('analytics.enabled') || ! $request->isMethod('GET')) {
            return false;
        }

        if ($response->getStatusCode() >= 400 || $request->ajax() || $request->prefetch()) {
            return false;
        }

        if (! str_starts_with((string) $response->headers->get('Content-Type'), 'text/html')) {
            return false;
        }

        if (config('analytics.respect_do_not_track') && $request->headers->get('DNT') === '1') {
            return false;
        }

        if (Str::is(config('analytics.excluded_paths'), $request->path())) {
            return false;
        }

        $routeName = $request->route()?->getName();

        if ($routeName !== null && Str::startsWith($routeName, ['filament.', 'livewire.'])) {
            return false;
        }

        return config('analytics.track_bots') || ! $this->isBot($request->userAgent());
    }

    private function record(Request $request): void
    {
        try {
            $userAgent = $request->userAgent();
            $referrer = $this->externalReferrer($request);
            $path = '/'.ltrim($request->path(), '/');
            $ip = $request->ip();

            PageView::create([
                'path' => $path,
                'route_name' => $request->route()?->getName(),
                'url' => Str::limit($request->fullUrl(), 2048, ''),
                'referrer' => $referrer === null ? null : Str::limit($referrer, 2048, ''),
                'referrer_host' => $referrer === null ? null : parse_url($referrer, PHP_URL_HOST),
                'visitor_hash' => hash('sha256', ($ip ?? 'unknown').'|'.($userAgent ?? 'unknown')),
                'session_id' => $request->hasSession() ? $request->session()->getId() : null,
                'device_type' => $this->deviceType($userAgent),
                'browser' => $this->browser($userAgent),
                'platform' => $this->platform($userAgent),
                'user_agent' => $userAgent,
                'ip_hash' => $ip === null ? null : hash_hmac('sha256', $ip, (string) config('app.key')),
                'viewed_at' => now(),
            ]);
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    private function externalReferrer(Request $request): ?string
    {
        $referrer = $request->headers->get('referer');

        if (blank($referrer)) {
            return null;
        }

        $host = parse_url($referrer, PHP_URL_HOST);

        if ($host === null || $host === $request->getHost()) {
            return null;
        }

        return $referrer;
    }

    private function isBot(?string $userAgent): bool
    {
        if (blank($userAgent)) {
            return false;
        }

        $userAgent = Str::lower($userAgent);

        foreach (config('analytics.bot_patterns') as $pattern) {
            if (str_contains($userAgent, $pattern)) {
                return true;
            }
        }

        return false;
    }

    private function deviceType(?string $userAgent): string
    {
        $userAgent = Str::lower((string) $userAgent);

        if (Str::contains($userAgent, ['ipad', 'tablet'])) {
            return 'tablet';
        }

        if (Str::contains($userAgent, ['mobile', 'android', 'iphone'])) {
            return 'mobile';
        }

        return 'desktop';
    }

    private function browser(?string $userAgent): string
    {
        $userAgent = (string) $userAgent;

        return match (true) {
            Str::contains($userAgent, ['Edg/', 'EdgA/']) => 'Edge',
            Str::contains($userAgent, ['OPR/', 'Opera']) => 'Opera',
            Str::contains($userAgent, ['Chrome/', 'CriOS/']) => 'Chrome',
            str_contains($userAgent, 'Firefox/') => 'Firefox',
            str_contains($userAgent, 'Safari/') => 'Safari',
            default => 'Outro',
        };
    }

    private function platform(?string $userAgent): string
    {
        $userAgent = (string) $userAgent;

        return match (true) {
            str_contains($userAgent, 'Windows') => 'Windows',
            Str::contains($userAgent, ['Android']) => 'Android',
            Str::contains($userAgent, ['iPhone', 'iPad', 'iPod']) => 'iOS',
            str_contains($userAgent, 'Mac OS X') => 'macOS',
            str_contains($userAgent, 'Linux') => 'Linux',
            default => 'Outro',
        };
    }
}
