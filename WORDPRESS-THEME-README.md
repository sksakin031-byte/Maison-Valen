# Maison Valen — Architectural Brand & WordPress Consultancy

A complete, production-ready luxury agency website built in two synchronized deliverables:

1. **Live Full-Stack Interactive Web Application** (`server.ts` + `src/`): React 19, TypeScript, Tailwind CSS v4, and an Express API powering live search, validated contact inquiries, newsletter subscriptions, WhatsApp concierge routing, and one-click `.zip` packaging of the WordPress deliverable.
2. **Genuine Custom WordPress Theme** (`/wordpress-theme/maison-valen/`): Standards-compliant PHP 8.1+ custom theme featuring zero page-builder bloat, WordPress Customizer studio controls, Services & Portfolio Custom Post Types, native WP Admin Meta Boxes, hardened `wp_ajax` handlers, and Schema.org SEO metadata.

---

## Pages Implemented

1. **Home** (`/`) — Hero proposition, studio proof metrics, capabilities index, selected case studies, client testimonials, and editorial journal preview.
2. **About Us** (`/about`) — Studio philosophy, Zurich & London headquarters, senior leadership partners, and direct WordPress package download.
3. **Services** (`/services`) — Filterable & searchable advisory and engineering disciplines with timelines and investment guidance.
4. **Service Details** (`/services/:slug`) — Dedicated specifications, 4-phase delivery methodology, deliverables list, WordPress Admin field mapping, and inquiry routing.
5. **Portfolio** (`/portfolio`) — Interactive sector filtering, keyword search, and full-screen case study inspection modal.
6. **Journal / Blog** (`/blog` & `/blog/:slug`) — Searchable editorial articles with category filtering and full-length reading views.
7. **Contact Us** (`/contact`) — Validated consultation brief form backed by `POST /api/contact` (and `mv_submit_contact` in WordPress) plus customizable WhatsApp Concierge launch.
8. **Privacy Policy** (`/privacy-policy`) — GDPR & Swiss Federal Act on Data Protection (FADP) compliance disclosure.

---

## Security & Quality Safeguards

- **WordPress Escaping & Nonces**: All theme templates escape output with `esc_html()`, `esc_attr()`, `esc_url()`, and `wp_json_encode()`. AJAX forms enforce `check_ajax_referer()` and input sanitization.
- **Prepared SQL**: Custom WordPress lead and subscriber tables use `$wpdb->insert()` and `$wpdb->prepare()`.
- **Full-Stack Express Validation**: Backend API endpoints validate email format, field lengths, and sanitize payloads before recording inquiries or subscriptions.
- **Accessibility**: Semantic HTML landmarks, keyboard focus visibility, skip links, WCAG AA color contrast, and `prefers-reduced-motion` support.

---

## Documentation Index

- `docs/DATABASE_SETUP.md` — MySQL schema, `wp-config.php` hardening, and WP-CLI seeding commands.
- `docs/INSTALLATION_AND_DEPLOYMENT.md` — Theme upload, WordPress Admin editing workflow, and production checklist.
- `wordpress-theme/maison-valen/` — Complete custom WordPress theme directory.
