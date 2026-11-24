<?php
/**
 * Maison Valen Theme Functions & Definitions
 *
 * @package Maison_Valen
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MV_THEME_VERSION', '1.0.0' );

/**
 * 1. Theme Setup & Supports
 */
function mv_theme_setup() {
	load_theme_textdomain( 'maison-valen', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 220,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary'         => __( 'Primary Header Navigation', 'maison-valen' ),
			'footer_company'  => __( 'Footer Company Links', 'maison-valen' ),
			'footer_services' => __( 'Footer Services Links', 'maison-valen' ),
			'footer_legal'    => __( 'Footer Legal Links', 'maison-valen' ),
		)
	);

	add_image_size( 'mv-hero', 1600, 900, true );
	add_image_size( 'mv-card', 1000, 750, true );
}
add_action( 'after_setup_theme', 'mv_theme_setup' );

/**
 * 2. Enqueue Styles, Google Fonts & Vanilla JS
 */
function mv_enqueue_assets() {
	wp_enqueue_style(
		'mv-google-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&family=JetBrains+Mono:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'mv-theme-style',
		get_template_directory_uri() . '/assets/css/theme.css',
		array( 'mv-google-fonts' ),
		MV_THEME_VERSION
	);

	wp_enqueue_script(
		'mv-theme-script',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		MV_THEME_VERSION,
		true
	);

	wp_localize_script(
		'mv-theme-script',
		'mvAjaxConfig',
		array(
			'ajaxUrl'         => admin_url( 'admin-ajax.php' ),
			'contactNonce'    => wp_create_nonce( 'mv_contact_nonce' ),
			'newsletterNonce' => wp_create_nonce( 'mv_newsletter_nonce' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'mv_enqueue_assets' );

/**
 * 3. Custom Post Types (Services & Portfolio) + Sector Taxonomy
 */
function mv_register_post_types() {
	register_post_type(
		'mv_service',
		array(
			'labels'       => array(
				'name'          => __( 'Services', 'maison-valen' ),
				'singular_name' => __( 'Service', 'maison-valen' ),
				'add_new_item'  => __( 'Add New Service', 'maison-valen' ),
				'edit_item'     => __( 'Edit Service', 'maison-valen' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'rewrite'      => array( 'slug' => 'services', 'with_front' => false ),
			'menu_icon'    => 'dashicons-admin-generic',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'show_in_rest' => true,
		)
	);

	register_post_type(
		'mv_portfolio',
		array(
			'labels'       => array(
				'name'          => __( 'Portfolio', 'maison-valen' ),
				'singular_name' => __( 'Case Study', 'maison-valen' ),
				'add_new_item'  => __( 'Add New Case Study', 'maison-valen' ),
				'edit_item'     => __( 'Edit Case Study', 'maison-valen' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'portfolio', 'with_front' => false ),
			'menu_icon'    => 'dashicons-portfolio',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'show_in_rest' => true,
		)
	);

	register_taxonomy(
		'portfolio_sector',
		array( 'mv_portfolio' ),
		array(
			'labels'       => array(
				'name'          => __( 'Sectors', 'maison-valen' ),
				'singular_name' => __( 'Sector', 'maison-valen' ),
			),
			'hierarchical' => true,
			'rewrite'      => array( 'slug' => 'sector' ),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'mv_register_post_types' );

/**
 * Flush rewrite rules cleanly upon theme activation
 */
function mv_activate_theme() {
	mv_register_post_types();
	mv_create_custom_tables();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'mv_activate_theme' );

/**
 * 4. Custom Database Tables (Leads & Subscribers) using dbDelta
 */
function mv_create_custom_tables() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();

	$leads_table       = $wpdb->prefix . 'mv_leads';
	$subscribers_table = $wpdb->prefix . 'mv_subscribers';

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$sql_leads = "CREATE TABLE {$leads_table} (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		full_name VARCHAR(120) NOT NULL,
		email VARCHAR(160) NOT NULL,
		company VARCHAR(160) DEFAULT '',
		service_interest VARCHAR(160) DEFAULT '',
		budget_tier VARCHAR(80) DEFAULT '',
		message TEXT NOT NULL,
		created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY  (id),
		KEY email (email)
	) {$charset_collate};";

	$sql_subscribers = "CREATE TABLE {$subscribers_table} (
		id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		email VARCHAR(160) NOT NULL,
		subscribed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY  (id),
		UNIQUE KEY email (email)
	) {$charset_collate};";

	dbDelta( $sql_leads );
	dbDelta( $sql_subscribers );
}

/**
 * 5. WordPress Customizer API (All Primary Copy & Contact Info Editable in WP Admin)
 */
function mv_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'mv_agency_panel',
		array(
			'title'       => __( 'Maison Valen Studio Settings', 'maison-valen' ),
			'description' => __( 'Edit homepage copy, metrics, offices, and WhatsApp concierge settings.', 'maison-valen' ),
			'priority'    => 30,
		)
	);

	// Section: Hero Content
	$wp_customize->add_section(
		'mv_hero_section',
		array(
			'title' => __( 'Homepage Hero & Proof', 'maison-valen' ),
			'panel' => 'mv_agency_panel',
		)
	);

	$hero_fields = array(
		'mv_hero_kicker'     => array( 'Zurich · London · Architectural Digital Consultancy', __( 'Hero Kicker', 'maison-valen' ), 'text' ),
		'mv_hero_headline'   => array( 'Digital flagships built for enduring authority.', __( 'Hero Headline', 'maison-valen' ), 'text' ),
		'mv_hero_subcopy'    => array( 'We engineer bespoke WordPress platforms, brand systems, and luxury commerce experiences for international leaders.', __( 'Hero Subheadline', 'maison-valen' ), 'textarea' ),
		'mv_hero_cta_label'  => array( 'Schedule Discovery Call', __( 'Primary CTA Label', 'maison-valen' ), 'text' ),
		'mv_metric_1_val'    => array( 'CHF 420M+', __( 'Metric 1 Value', 'maison-valen' ), 'text' ),
		'mv_metric_1_lbl'    => array( 'Client valuation influenced across flagship launches', __( 'Metric 1 Label', 'maison-valen' ), 'text' ),
		'mv_metric_2_val'    => array( '14', __( 'Metric 2 Value', 'maison-valen' ), 'text' ),
		'mv_metric_2_lbl'    => array( 'International markets engineered with multilingual precision', __( 'Metric 2 Label', 'maison-valen' ), 'text' ),
		'mv_metric_3_val'    => array( '99.98%', __( 'Metric 3 Value', 'maison-valen' ), 'text' ),
		'mv_metric_3_lbl'    => array( 'Measured uptime across managed WordPress clusters', __( 'Metric 3 Label', 'maison-valen' ), 'text' ),
		'mv_metric_4_val'    => array( '0.8s', __( 'Metric 4 Value', 'maison-valen' ), 'text' ),
		'mv_metric_4_lbl'    => array( 'Median global Largest Contentful Paint', __( 'Metric 4 Label', 'maison-valen' ), 'text' ),
	);

	foreach ( $hero_fields as $key => $cfg ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $cfg[0],
				'sanitize_callback' => 'textarea' === $cfg[2] ? 'sanitize_textarea_field' : 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'   => $cfg[1],
				'section' => 'mv_hero_section',
				'type'    => $cfg[2],
			)
		);
	}

	// Section: Contact & WhatsApp
	$wp_customize->add_section(
		'mv_contact_section',
		array(
			'title' => __( 'Offices, Email & WhatsApp', 'maison-valen' ),
			'panel' => 'mv_agency_panel',
		)
	);

	$contact_fields = array(
		'mv_contact_email'   => array( 'concierge@maisonvalen.com', __( 'Concierge Email', 'maison-valen' ) ),
		'mv_whatsapp_number' => array( '41445802490', __( 'WhatsApp Number (digits only, international format)', 'maison-valen' ) ),
		'mv_zurich_address'  => array( 'Talstrasse 82, 8001 Zurich, Switzerland', __( 'Zurich Studio Address', 'maison-valen' ) ),
		'mv_zurich_phone'    => array( '+41 44 580 24 90', __( 'Zurich Phone', 'maison-valen' ) ),
		'mv_london_address'  => array( '24 Savile Row, Mayfair, London W1S 3PR', __( 'London Studio Address', 'maison-valen' ) ),
		'mv_london_phone'    => array( '+44 20 7946 0821', __( 'London Phone', 'maison-valen' ) ),
		'mv_footer_bio'      => array( 'Architectural brand strategy and zero-bloat WordPress engineering for international houses.', __( 'Footer Studio Summary', 'maison-valen' ) ),
	);

	foreach ( $contact_fields as $key => $cfg ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $cfg[0],
				'sanitize_callback' => 'mv_contact_email' === $key ? 'sanitize_email' : 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'   => $cfg[1],
				'section' => 'mv_contact_section',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'mv_customize_register' );

/**
 * 6. Native Meta Boxes for Services & Portfolio (Zero ACF Dependency)
 */
function mv_register_meta_boxes() {
	add_meta_box(
		'mv_service_details_box',
		__( 'Service Specifications & Admin Mapping', 'maison-valen' ),
		'mv_render_service_meta_box',
		'mv_service',
		'normal',
		'high'
	);

	add_meta_box(
		'mv_portfolio_details_box',
		__( 'Case Study Specifications & Metrics', 'maison-valen' ),
		'mv_render_portfolio_meta_box',
		'mv_portfolio',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'mv_register_meta_boxes' );

function mv_render_service_meta_box( $post ) {
	wp_nonce_field( 'mv_save_service_meta', 'mv_service_meta_nonce' );
	$index        = get_post_meta( $post->ID, '_mv_service_index', true );
	$timeline     = get_post_meta( $post->ID, '_mv_service_timeline', true );
	$investment   = get_post_meta( $post->ID, '_mv_service_investment', true );
	$proof        = get_post_meta( $post->ID, '_mv_service_proof', true );
	$deliverables = get_post_meta( $post->ID, '_mv_service_deliverables', true );
	?>
	<p><label><strong><?php esc_html_e( 'Editorial Index (e.g. 01)', 'maison-valen' ); ?></strong></label><br>
	<input type="text" name="mv_service_index" value="<?php echo esc_attr( $index ); ?>" class="regular-text" /></p>

	<p><label><strong><?php esc_html_e( 'Typical Timeline (e.g. 8–12 Weeks)', 'maison-valen' ); ?></strong></label><br>
	<input type="text" name="mv_service_timeline" value="<?php echo esc_attr( $timeline ); ?>" class="regular-text" /></p>

	<p><label><strong><?php esc_html_e( 'Starting Investment (e.g. From CHF 46,000)', 'maison-valen' ); ?></strong></label><br>
	<input type="text" name="mv_service_investment" value="<?php echo esc_attr( $investment ); ?>" class="regular-text" /></p>

	<p><label><strong><?php esc_html_e( 'Quantified Proof Statement', 'maison-valen' ); ?></strong></label><br>
	<input type="text" name="mv_service_proof" value="<?php echo esc_attr( $proof ); ?>" class="large-text" /></p>

	<p><label><strong><?php esc_html_e( 'Key Deliverables (One per line)', 'maison-valen' ); ?></strong></label><br>
	<textarea name="mv_service_deliverables" rows="5" class="large-text"><?php echo esc_textarea( $deliverables ); ?></textarea></p>
	<?php
}

function mv_render_portfolio_meta_box( $post ) {
	wp_nonce_field( 'mv_save_portfolio_meta', 'mv_portfolio_meta_nonce' );
	$client   = get_post_meta( $post->ID, '_mv_client_name', true );
	$year     = get_post_meta( $post->ID, '_mv_project_year', true );
	$location = get_post_meta( $post->ID, '_mv_project_location', true );
	$outcome  = get_post_meta( $post->ID, '_mv_outcome_metric', true );
	?>
	<p><label><strong><?php esc_html_e( 'Client Organization', 'maison-valen' ); ?></strong></label><br>
	<input type="text" name="mv_client_name" value="<?php echo esc_attr( $client ); ?>" class="regular-text" /></p>

	<p><label><strong><?php esc_html_e( 'Completion Year', 'maison-valen' ); ?></strong></label><br>
	<input type="text" name="mv_project_year" value="<?php echo esc_attr( $year ); ?>" class="regular-text" /></p>

	<p><label><strong><?php esc_html_e( 'Location', 'maison-valen' ); ?></strong></label><br>
	<input type="text" name="mv_project_location" value="<?php echo esc_attr( $location ); ?>" class="regular-text" /></p>

	<p><label><strong><?php esc_html_e( 'Verified Outcome Metric (e.g. +164% Bespoke Inquiries)', 'maison-valen' ); ?></strong></label><br>
	<input type="text" name="mv_outcome_metric" value="<?php echo esc_attr( $outcome ); ?>" class="large-text" /></p>
	<?php
}

function mv_save_post_meta( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['mv_service_meta_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mv_service_meta_nonce'] ) ), 'mv_save_service_meta' ) ) {
		$fields = array(
			'mv_service_index'        => '_mv_service_index',
			'mv_service_timeline'     => '_mv_service_timeline',
			'mv_service_investment'   => '_mv_service_investment',
			'mv_service_proof'        => '_mv_service_proof',
		);
		foreach ( $fields as $input => $meta_key ) {
			if ( isset( $_POST[ $input ] ) ) {
				update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $input ] ) ) );
			}
		}
		if ( isset( $_POST['mv_service_deliverables'] ) ) {
			update_post_meta( $post_id, '_mv_service_deliverables', sanitize_textarea_field( wp_unslash( $_POST['mv_service_deliverables'] ) ) );
		}
	}

	if ( isset( $_POST['mv_portfolio_meta_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mv_portfolio_meta_nonce'] ) ), 'mv_save_portfolio_meta' ) ) {
		$fields = array(
			'mv_client_name'      => '_mv_client_name',
			'mv_project_year'     => '_mv_project_year',
			'mv_project_location' => '_mv_project_location',
			'mv_outcome_metric'   => '_mv_outcome_metric',
		);
		foreach ( $fields as $input => $meta_key ) {
			if ( isset( $_POST[ $input ] ) ) {
				update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $input ] ) ) );
			}
		}
	}
}
add_action( 'save_post', 'mv_save_post_meta' );

/**
 * 7. Hardened AJAX Contact Form & Newsletter Handlers
 */
function mv_handle_contact_submission() {
	check_ajax_referer( 'mv_contact_nonce', 'nonce' );

	$name     = isset( $_POST['full_name'] ) ? sanitize_text_field( wp_unslash( $_POST['full_name'] ) ) : '';
	$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$company  = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$service  = isset( $_POST['service_interest'] ) ? sanitize_text_field( wp_unslash( $_POST['service_interest'] ) ) : '';
	$budget   = isset( $_POST['budget_tier'] ) ? sanitize_text_field( wp_unslash( $_POST['budget_tier'] ) ) : '';
	$message  = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( empty( $name ) || ! is_email( $email ) || strlen( $message ) < 10 ) {
		wp_send_json_error(
			array( 'message' => __( 'Please provide your name, a valid email address, and project details (at least 10 characters).', 'maison-valen' ) ),
			400
		);
	}

	global $wpdb;
	$table = $wpdb->prefix . 'mv_leads';

	$wpdb->insert(
		$table,
		array(
			'full_name'        => $name,
			'email'            => $email,
			'company'          => $company,
			'service_interest' => $service,
			'budget_tier'      => $budget,
			'message'          => $message,
		),
		array( '%s', '%s', '%s', '%s', '%s', '%s' )
	);

	$admin_email = get_theme_mod( 'mv_contact_email', get_option( 'admin_email' ) );
	$subject     = sprintf( '[Maison Valen Inquiry] %s (%s)', $name, $service );
	$body        = sprintf(
		"Name: %s\nEmail: %s\nCompany: %s\nService: %s\nBudget: %s\n\nMessage:\n%s",
		$name,
		$email,
		$company,
		$service,
		$budget,
		$message
	);
	wp_mail( $admin_email, $subject, $body );

	wp_send_json_success(
		array(
			'message' => __( 'Thank you. A managing partner from our Zurich or London studio will respond within one business day.', 'maison-valen' ),
			'refId'   => 'MV-' . gmdate( 'Ymd' ) . '-' . absint( $wpdb->insert_id ),
		)
	);
}
add_action( 'wp_ajax_mv_submit_contact', 'mv_handle_contact_submission' );
add_action( 'wp_ajax_nopriv_mv_submit_contact', 'mv_handle_contact_submission' );

function mv_handle_newsletter_submission() {
	check_ajax_referer( 'mv_newsletter_nonce', 'nonce' );

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	if ( ! is_email( $email ) ) {
		wp_send_json_error(
			array( 'message' => __( 'Please enter a valid work email address.', 'maison-valen' ) ),
			400
		);
	}

	global $wpdb;
	$table = $wpdb->prefix . 'mv_subscribers';

	$exists = $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$table} WHERE email = %s", $email ) );
	if ( $exists ) {
		wp_send_json_success(
			array( 'message' => __( 'This address is already subscribed to our quarterly monograph.', 'maison-valen' ) )
		);
	}

	$wpdb->insert(
		$table,
		array( 'email' => $email ),
		array( '%s' )
	);

	wp_send_json_success(
		array( 'message' => __( 'Subscribed. You will receive our next quarterly architectural dispatch.', 'maison-valen' ) )
	);
}
add_action( 'wp_ajax_mv_subscribe_newsletter', 'mv_handle_newsletter_submission' );
add_action( 'wp_ajax_nopriv_mv_subscribe_newsletter', 'mv_handle_newsletter_submission' );

/**
 * 8. SEO OpenGraph & Schema.org JSON-LD Injection
 */
function mv_inject_seo_meta() {
	$title       = wp_get_document_title();
	$description = get_bloginfo( 'description' );
	if ( is_singular() && has_excerpt() ) {
		$description = wp_strip_all_tags( get_the_excerpt() );
	}
	?>
	<meta property="og:title" content="<?php echo esc_attr( $title ); ?>" />
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>" />
	<meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>" />
	<meta property="og:url" content="<?php echo esc_url( get_permalink() ?: home_url( '/' ) ); ?>" />
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "ProfessionalService",
		"name": <?php echo wp_json_encode( get_bloginfo( 'name' ) ); ?>,
		"url": <?php echo wp_json_encode( home_url( '/' ) ); ?>,
		"email": <?php echo wp_json_encode( get_theme_mod( 'mv_contact_email', 'concierge@maisonvalen.com' ) ); ?>,
		"telephone": <?php echo wp_json_encode( get_theme_mod( 'mv_zurich_phone', '+41 44 580 24 90' ) ); ?>
	}
	</script>
	<?php
}
add_action( 'wp_head', 'mv_inject_seo_meta', 5 );
