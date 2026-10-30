---
name: skynet-site-design
description: "Design system and UX rules for the Skynet Projetos e Consultoria website. Use when creating, editing, reviewing, or extending any Skynet page, section, component, under-construction screen, technical SVG, or admin branding. Covers the white Swiss layout, Montserrat typography, corporate red accent, strict 12-column grid, technical line diagrams, copy tone, responsiveness, and accessibility."
---

# Skynet Site Design

This is the visual and UX source of truth for the Skynet Projetos e Consultoria website. Apply it to every public page, section, component, illustration, and admin-facing brand surface. When the current implementation and this skill disagree, update the implementation toward this skill — or record why the deviation is necessary.

## Source of truth

Read these files before changing the public interface:

| File | Purpose |
| --- | --- |
| `resources/css/app.css` | Design tokens, base typography, focus and motion rules |
| `resources/views/site/construction.blade.php` | Reference implementation of the current page |
| `app/Filament/Pages/ConstructionPage.php` | Admin control for page title, message and availability |
| `database/seeders/SettingSeeder.php` | Default institutional content and contact data |

## Non-negotiables

1. **White canvas.** The page background is `#FFFFFF`. Use white or `#F8F9FA` only for adjacent surfaces; never use dark hero sections, gradients, glassmorphism, or colored page backgrounds.
2. **One accent.** Corporate red `#C8102E` is the only accent. Do not introduce blue, green, purple, or a second accent color.
3. **Montserrat only.** Use Montserrat for all interface text. Do not add a second typeface.
4. **Rectilinear geometry.** No rounded corners, glass effects, decorative shadows, or floating cards. Use 1 px borders and flat color blocks.
5. **Strong typographic hierarchy.** Display headings are bold (`700`/`800`), tight, and large. Body copy is regular (`400`) with generous line-height. Never use bold for long paragraphs.
6. **12-column grid.** Every layout uses the 12-column grid with an 8 px spacing base. Collapse to one column on mobile.
7. **Generous whitespace.** Section padding starts at `py-16`; desktop uses `py-24`. Do not compress sections to fit more content.
8. **Thin structure.** Borders are `border-ink/10`; dividers are 1 px. Use structure instead of shadows.
9. **Precise, technical copy.** Write for Tier 1 operators, tower companies and engineering teams. Avoid generic marketing adjectives and invented metrics.
10. **Accessible by default.** Visible focus, 44 px touch targets, reduced-motion support, semantic headings, and readable contrast are part of the design.

## Design tokens

Define tokens in `resources/css/app.css` through Tailwind's `@theme`:

| Token | Value | Usage |
| --- | --- | --- |
| `--color-canvas` | `#FFFFFF` | Page background |
| `--color-ink` | `#111827` | Primary text, borders at opacity, diagrams |
| `--color-accent` | `#C8102E` | CTAs, status dots, active states, key diagram elements |

Use opacity for hierarchy instead of extra grays:

| Role | Class | Minimum use |
| --- | --- | --- |
| Primary text | `text-ink` | Headings and key values |
| Secondary text | `text-ink/60` | Paragraphs, descriptions, labels |
| Decorative only | `text-ink/30` | Large background numerals, never essential text |

For small text under 18 px, keep a minimum of `text-ink/60` so contrast stays acceptable on white.

Borders: `border-ink/10`; stronger separators: `border-ink/20`. Never use arbitrary hex borders inline when a token fits.

## Typography

- Font stack: `'Montserrat', 'Helvetica Neue', Helvetica, Arial, system-ui, sans-serif`
- Load weights `400, 500, 600, 700, 800` through the Vite/Bunny font pipeline (`@fonts`). Do not rely on the user having Montserrat installed.

| Role | Recipe |
| --- | --- |
| Page hero | `text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-[1.02] text-balance` |
| Section title | `text-3xl md:text-4xl font-bold tracking-tight` |
| Card title | `text-lg/xl font-bold tracking-tight` |
| Body | `text-base leading-relaxed text-ink/60 max-w-[60ch]` |
| Small body | `text-sm leading-relaxed text-ink/60 max-w-[52ch]` |
| Micro-label | `text-[10px] font-semibold tracking-[0.16em] uppercase text-ink/60` |
| Eyebrow | `text-xs font-semibold tracking-[0.2em] uppercase text-accent` |
| Numeric data | `tabular-nums` on every aligned number |

- Body copy never exceeds `60ch`.
- Use `text-balance` on display titles; use `text-pretty` on longer paragraphs.
- Use the ellipsis character `…`, curly quotes, and non-breaking spaces inside units when relevant.

## Layout

- Container: `mx-auto w-full max-w-6xl px-4 md:px-8`.
- Grid: `grid grid-cols-12 gap-8`; mobile children use `col-span-12`, desktop splits use `lg:col-span-*`.
- Section spacing: `py-16 md:py-24`; large hero/editorial sections can use `md:py-28`.
- Section separator: `border-b border-ink/10`.
- Max text width: `max-w-[56ch]` to `max-w-[60ch]`.
- Mobile-first: default classes describe the smallest viewport; add `sm:`, `md:` and `lg:` progressively.
- Touch targets: interactive elements use `min-h-[44px]`; primary CTAs use `min-h-[48px]`.
- Tables must be wrapped in `overflow-x-auto` with a sensible `min-w`.

## Page anatomy

The current under-construction page is the reference. Future institutional pages should preserve the same rhythm:

1. **Top accent line** — 4 px red bar, `h-1 bg-accent`.
2. **Header** — typographic logo “Skynet / Projetos e Consultoria”, plus contact links on desktop; 1 px bottom border.
3. **Hero / main message** — 12-column split, eyebrow/status, bold display title, red rule, explanation, primary and secondary contact actions.
4. **Contact micro-grid** — three bordered cells: email, phone, coverage.
5. **Technical panel** — white card with a thin border, status label, technical SVG and supporting data.
6. **Supporting section** — “O que está por vir” or services/pillars, using numbered columns and thin dividers.
7. **Footer** — legal name, CNPJ, contact links, coverage.

## Components

### Header and logo

- Logo is typographic, not an image: “Skynet” bold, “Projetos e Consultoria” in 9 px uppercase with tracking.
- Header is sticky when navigation exists, with `border-b border-ink/10` and a white background.
- Navigation links are small, medium weight, with red hover; active items use red or a red underline.
- Mobile navigation collapses into a flat, border-based disclosure menu.

### Buttons and links

```html
<!-- Primary -->
<a class="inline-flex min-h-[48px] items-center justify-center bg-accent px-6 py-3 text-sm font-semibold tracking-wide text-white transition-colors hover:bg-accent/90">
  Solicitar proposta
</a>

<!-- Secondary -->
<a class="inline-flex min-h-[48px] items-center justify-center border border-ink/20 px-6 py-3 text-sm font-semibold tracking-wide text-ink transition-colors hover:border-accent hover:text-accent">
  Falar com a equipe
</a>

<!-- Text action -->
<a class="inline-flex min-h-[44px] items-center gap-2 text-sm font-semibold text-accent underline-offset-4 hover:underline">
  Ver detalhes →
</a>
```

- No pills. No rounded buttons.
- Transitions only on color/border/transform; keep them subtle.

### Cards and grids

- Surface: `border border-ink/10 bg-white p-6 md:p-8`.
- Grid grouping: use a 1 px background-color gap (`gap-px bg-ink/10`) with white cells.
- Section and card numbers: `font-mono text-xs font-semibold text-accent tabular-nums`.
- Hover: advance border to `hover:border-accent/40`, not elevation or scale.

### Technical panel

- White card with `border border-ink/10`.
- Panel header uses micro-labels and a red status dot.
- Keep panel content inside a fixed aspect ratio, e.g. `aspect-[5/4]`.
- Use technical SVGs as the primary illustration; never stock photos or generic 3D renders.

## Technical SVG rules

The reference is the top-view radio-link diagram, not a tower illustration.

- Draw radio links as a **top view**: site nodes, direct link paths, endpoint orientation marks, link labels, a hub and a north indicator.
- Use ink lines; highlight only the primary link/hub in accent red.
- Include a faint grid and optional contour lines for technical context.
- Label nodes with letters (A/B/C/D) and short site codes (SKY-01, HUB, SKY-03…).
- Keep labels small, uppercase and tracked; align them away from link paths.
- Wrap decorative SVGs with `aria-hidden="true"` and add a `.sr-only` description of what the diagram represents.
- SVG must scale with its container; use `viewBox` and avoid fixed pixel dimensions.

## Motion

- Motion exists only for feedback: color transitions, border transitions and small arrow translations.
- Do not add scroll reveals, parallax, gradient animation or looping decorative motion.
- Respect `prefers-reduced-motion` globally in `app.css`.
- Use `motion-safe:` for optional transforms when possible.

## Accessibility

- Include a skip link to `#conteudo`.
- Every page has one `<h1>`, then sequential `<h2>`/`<h3>`.
- Focus ring: `outline-2 outline-offset-2 outline-accent` on `:focus-visible`.
- Interactive elements must be at least 44 × 44 px on mobile.
- Do not use color alone to communicate status; pair the red dot with text such as “Em construção”.
- Maintain readable contrast: `text-ink/60` minimum for small text on white.
- Mark decorative shapes and background numerals with `aria-hidden="true"`.
- Forms require visible labels, inline errors, and a text-based success message.

## Copy and content

- Tone: technical, direct, confident, and specific. Portuguese (pt-BR).
- Lead with the operational value: precisão, rastreabilidade, conformidade, redução de retrabalho, cobertura nacional.
- Prefer concrete nouns: rollout documental, As-Built, DEC, EHS, RF, microwave, DWDM, TSSR.
- Avoid: “soluções inovadoras”, “sinergia”, “transformação digital”, superlativos e métricas inventadas.
- Contact data comes from settings; the current production values are `eduardo@skynetprojetos.com.br` and `+55 (91) 98438-7990`.
- Legal footer: Skynet Projetos e Consultoria · CNPJ 68.340.372/0001-09.
- The current page states “Site em construção” and must keep `noindex, nofollow` while active.

## Admin and content control

- The construction page is managed at **Sistema → Página em construção**.
- The admin controls: visibility (`construction_enabled`), `construction_title`, and `construction_message`.
- When disabled, the public route must return 404 until the definitive site exists.
- Contact details are managed in **Sistema → Configurações** and must flow into the page from settings, not be hardcoded in the view (except legal CNPJ).
- Admin brand color follows the red accent; do not introduce a separate admin palette.

## Checklist before shipping

- [ ] White canvas, one red accent, Montserrat, and no rounded corners
- [ ] 12-column grid and mobile-first behavior at 320 px, 768 px and 1440 px
- [ ] Body text limited to 60ch and small text uses `text-ink/60`
- [ ] All CTAs have clear primary/secondary hierarchy and 44–48 px height
- [ ] Thin borders and whitespace carry the structure; no shadows or gradients
- [ ] Technical SVG uses ink lines and a single red highlight
- [ ] Focus states, skip link, reduced motion and semantic headings present
- [ ] Contact data and CNPJ correct
- [ ] `noindex` while the under-construction page is active
- [ ] `npm run build`, `php artisan test` and a rendered browser check pass

## Common mistakes

- Reintroducing the wine/dark panel as the main illustration background; the reference is now white.
- Using red for large paragraphs instead of only actions and status.
- Adding a second typeface or using system fonts without loading Montserrat.
- Using stock photography, 3D antennas, or decorative icons instead of line diagrams.
- Letting cards float with shadows or rounded corners.
- Hardcoding email/phone instead of reading them from settings.
- Hiding essential text below the contrast threshold or using gray text over gray surfaces.
- Creating new pages with a different header, spacing rhythm, or section numbering.
