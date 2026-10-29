<?php

namespace Database\Factories;

use App\Models\PageView;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PageView>
 */
class PageViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $path = fake()->randomElement(['/', '/servicos', '/projetos', '/sobre', '/contato']);
        $userAgent = fake()->userAgent();
        $ip = fake()->ipv4();

        return [
            'path' => $path,
            'route_name' => null,
            'url' => config('app.url').$path,
            'referrer' => fake()->optional()->url(),
            'referrer_host' => fake()->optional()->domainName(),
            'visitor_hash' => hash('sha256', $ip.$userAgent),
            'session_id' => Str::random(40),
            'device_type' => fake()->randomElement(['desktop', 'mobile', 'tablet']),
            'browser' => fake()->randomElement(['Chrome', 'Firefox', 'Safari', 'Edge']),
            'platform' => fake()->randomElement(['Windows', 'macOS', 'Linux', 'Android', 'iOS']),
            'user_agent' => $userAgent,
            'ip_hash' => hash('sha256', $ip),
            'viewed_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
