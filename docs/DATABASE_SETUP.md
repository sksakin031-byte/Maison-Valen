# Database Setup & Content Seeding Guide

## 1. Create the WordPress Database (MySQL 8.0+ / MariaDB 10.6+)

Run the following SQL commands as a privileged database administrator:

```sql
CREATE DATABASE maison_valen_wp
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

CREATE USER 'mv_wp_user'@'localhost' IDENTIFIED BY 'CHANGE_TO_STRONG_PASSWORD';

GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER
  ON maison_valen_wp.*
  TO 'mv_wp_user'@'localhost';

FLUSH PRIVILEGES;
```

## 2. Configure `wp-config.php`

Set strong unique table prefixes and authentication salts:

```php
define( 'DB_NAME', 'maison_valen_wp' );
define( 'DB_USER', 'mv_wp_user' );
define( 'DB_PASSWORD', 'CHANGE_TO_STRONG_PASSWORD' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

$table_prefix = 'mv_';

// Hardening recommended for production
define( 'DISALLOW_FILE_EDIT', true );
define( 'FORCE_SSL_ADMIN', true );
```

## 3. Custom Application Tables (Auto-Provisioned on Theme Activation)

Upon activating **Maison Valen** in **Appearance → Themes**, `mv_create_custom_tables()` automatically runs `dbDelta()` to provision two dedicated tables:

1. `{$wpdb->prefix}mv_leads`
   - `id`, `full_name`, `email`, `company`, `service_interest`, `budget_tier`, `message`, `created_at`
2. `{$wpdb->prefix}mv_subscribers`
   - `id`, `email` (unique index), `subscribed_at`

All inserts and duplicate checks in `functions.php` use `$wpdb->insert()` with explicit format arrays and `$wpdb->prepare()`.

## 4. Seed All 8 Pages & Sample Content via WP-CLI

After installing WordPress core and activating the `maison-valen` theme, run:

```bash
# 1. Create required pages with SEO-friendly slugs
wp post create --post_type=page --post_title="Home" --post_name="home" --post_status=publish
wp post create --post_type=page --post_title="About Us" --post_name="about" --post_status=publish --page_template="page-about.php"
wp post create --post_type=page --post_title="Services" --post_name="services" --post_status=publish --page_template="page-services.php"
wp post create --post_type=page --post_title="Journal" --post_name="blog" --post_status=publish
wp post create --post_type=page --post_title="Contact Us" --post_name="contact" --post_status=publish --page_template="page-contact.php"
wp post create --post_type=page --post_title="Privacy Policy" --post_name="privacy-policy" --post_status=publish --page_template="page-privacy-policy.php"

# 2. Assign static Homepage & Journal page
HOME_ID=$(wp post list --post_type=page --name=home --field=ID)
BLOG_ID=$(wp post list --post_type=page --name=blog --field=ID)
wp option update show_on_front page
wp option update page_on_front "$HOME_ID"
wp option update page_for_posts "$BLOG_ID"

# 3. Enable SEO Permalinks
wp rewrite structure '/%postname%/' --hard
wp rewrite flush --hard
```
