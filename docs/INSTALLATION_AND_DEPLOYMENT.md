# Installation & Production Deployment Guide

## 1. Prerequisites

- **PHP**: 8.1 or 8.2+ (with `mysqli`, `mbstring`, `curl`, `gd`/`imagick`, `zip`)
- **WordPress**: 6.4 or newer
- **Database**: MySQL 8.0+ or MariaDB 10.6+
- **Web Server**: Nginx or Apache (`mod_rewrite` enabled) with valid TLS/HTTPS certificate

---

## 2. Installing the Custom WordPress Theme

1. Download `maison-valen-wordpress-package.zip` (either from the live website's **WordPress Package** drawer or generated in the repository).
2. Extract the archive and locate `/wordpress-theme/maison-valen/`.
3. Compress `/wordpress-theme/maison-valen/` into `maison-valen.zip` (or upload the folder directly via SFTP to `/wp-content/themes/maison-valen/`).
4. In WordPress Admin, navigate to **Appearance → Themes → Add New → Upload Theme**, select `maison-valen.zip`, and click **Activate**.
5. Navigate to **Settings → Permalinks**, choose **Post name** (`/%postname%/`), and click **Save Changes** to register `/services/<slug>/` and `/portfolio/` clean URLs.

---

## 3. Editing Content in the WordPress Admin Dashboard

Every key element on the website is editable without touching PHP or CSS:

- **Homepage Hero, Metrics, Studios & WhatsApp Number**:
  Go to **Appearance → Customize → Maison Valen Studio Settings**. Update the Hero Headline, Subcopy, CTA Label, 4 KPI metrics, Zurich & London addresses, Concierge Email, and WhatsApp digits.
- **Services & Service Details**:
  Go to **Services → Add New** in the WordPress Admin sidebar. Fill in the title, overview editor, excerpt, and the **Service Specifications & Admin Mapping** meta panel (Editorial Index, Timeline, Starting Investment, Verified Proof Statement, Deliverables list).
- **Portfolio Case Studies**:
  Go to **Portfolio → Add New**, assign a **Sector** taxonomy term (`Horology & Luxury`, `Hospitality`, `Private Wealth`, `Architecture`), attach a Featured Image, and complete **Case Study Specifications & Metrics** (Client, Year, Location, Outcome Metric).
- **Journal / Blog Articles**:
  Go to **Posts → Add New**, assign a Category, Featured Image, and Excerpt.
- **Navigation Menus**:
  Go to **Appearance → Menus** and assign your menu to **Primary Header Navigation**.

---

## 4. Production Hosting Checklist

- [ ] Enable HTTPS across all routes and set `FORCE_SSL_ADMIN` to `true`.
- [ ] Configure an authenticated SMTP plugin (e.g., Postmark or Amazon SES) so `wp_mail()` notifications from `mv_submit_contact` land reliably in your inbox.
- [ ] Enable object caching (Redis) and page caching (Nginx FastCGI Cache or WP Rocket), excluding `admin-ajax.php`.
- [ ] Set `WP_DEBUG` to `false` in `wp-config.php`.
- [ ] Schedule automated daily off-site database and `/wp-content/uploads/` backups.
