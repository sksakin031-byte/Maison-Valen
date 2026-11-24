<?php
/**
 * Template Name: Contact Us
 *
 * @package Maison_Valen
 */
get_header();

$mv_whatsapp    = preg_replace( '/\D+/', '', get_theme_mod( 'mv_whatsapp_number', '41445802490' ) );
$mv_email       = get_theme_mod( 'mv_contact_email', 'concierge@maisonvalen.com' );
$preselected    = isset( $_GET['service'] ) ? sanitize_text_field( wp_unslash( $_GET['service'] ) ) : '';
?>
<section class="mv-section">
	<div class="mv-container mv-split-2">
		<div>
			<p class="mv-kicker"><?php esc_html_e( 'Initiate Dialogue', 'maison-valen' ); ?></p>
			<h1 class="mv-page-title"><?php esc_html_e( 'Commission a consultation.', 'maison-valen' ); ?></h1>
			<p class="mv-hero-lead"><?php esc_html_e( 'Share your architectural objectives, target launch window, and preferred studio office. A managing partner responds within one business day.', 'maison-valen' ); ?></p>

			<div class="mv-card mv-mt-md">
				<h2 class="mv-card-title"><?php esc_html_e( 'Direct WhatsApp Concierge', 'maison-valen' ); ?></h2>
				<p class="mv-muted"><?php esc_html_e( 'Prefer immediate encrypted partner coordination? Connect directly with our Zurich client desk.', 'maison-valen' ); ?></p>
				<a class="mv-btn mv-btn-secondary" href="https://wa.me/<?php echo esc_attr( $mv_whatsapp ); ?>?text=<?php echo rawurlencode( 'Hello Maison Valen, I would like to discuss a digital flagship consultation.' ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Message via WhatsApp', 'maison-valen' ); ?>
				</a>
			</div>

			<div class="mv-mt-md">
				<p class="mv-kicker"><?php esc_html_e( 'Studios', 'maison-valen' ); ?></p>
				<p><strong>Zurich:</strong> <?php echo esc_html( get_theme_mod( 'mv_zurich_address', 'Talstrasse 82, 8001 Zurich' ) ); ?></p>
				<p><strong>London:</strong> <?php echo esc_html( get_theme_mod( 'mv_london_address', '24 Savile Row, Mayfair, London W1S 3PR' ) ); ?></p>
				<p><strong>Direct Email:</strong> <a href="mailto:<?php echo esc_attr( $mv_email ); ?>"><?php echo esc_html( $mv_email ); ?></a></p>
			</div>
		</div>

		<div class="mv-card">
			<form id="mv-contact-form" class="mv-contact-form" novalidate>
				<div class="mv-field">
					<label for="mv-name"><?php esc_html_e( 'Full Name *', 'maison-valen' ); ?></label>
					<input id="mv-name" name="full_name" type="text" required class="mv-input" />
				</div>
				<div class="mv-field">
					<label for="mv-email"><?php esc_html_e( 'Work Email *', 'maison-valen' ); ?></label>
					<input id="mv-email" name="email" type="email" required class="mv-input" />
				</div>
				<div class="mv-field">
					<label for="mv-company"><?php esc_html_e( 'Organization', 'maison-valen' ); ?></label>
					<input id="mv-company" name="company" type="text" class="mv-input" />
				</div>
				<div class="mv-field">
					<label for="mv-service"><?php esc_html_e( 'Primary Discipline', 'maison-valen' ); ?></label>
					<input id="mv-service" name="service_interest" type="text" value="<?php echo esc_attr( $preselected ); ?>" placeholder="Bespoke WordPress Engineering" class="mv-input" />
				</div>
				<div class="mv-field">
					<label for="mv-budget"><?php esc_html_e( 'Estimated Scope', 'maison-valen' ); ?></label>
					<select id="mv-budget" name="budget_tier" class="mv-input">
						<option value="CHF 25,000 – 45,000">CHF 25,000 – 45,000</option>
						<option value="CHF 45,000 – 85,000">CHF 45,000 – 85,000</option>
						<option value="CHF 85,000+">CHF 85,000+</option>
					</select>
				</div>
				<div class="mv-field">
					<label for="mv-message"><?php esc_html_e( 'Project Brief *', 'maison-valen' ); ?></label>
					<textarea id="mv-message" name="message" rows="5" required class="mv-input"></textarea>
				</div>
				<button type="submit" class="mv-btn mv-btn-primary"><?php esc_html_e( 'Submit Consultation Brief', 'maison-valen' ); ?></button>
				<p class="mv-form-feedback" aria-live="polite"></p>
			</form>
		</div>
	</div>
</section>
<?php get_footer(); ?>
