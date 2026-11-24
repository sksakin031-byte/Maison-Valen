<?php
/**
 * Footer Template
 *
 * @package Maison_Valen
 */

$mv_whatsapp = preg_replace( '/\D+/', '', get_theme_mod( 'mv_whatsapp_number', '41445802490' ) );
$mv_email    = get_theme_mod( 'mv_contact_email', 'concierge@maisonvalen.com' );
$mv_bio      = get_theme_mod( 'mv_footer_bio', 'Architectural brand strategy and zero-bloat WordPress engineering for international houses.' );
?>
</main>

<footer class="mv-footer" role="contentinfo">
	<div class="mv-container">
		<div class="mv-footer-grid">
			<div>
				<p class="mv-brand-footer"><?php bloginfo( 'name' ); ?></p>
				<p class="mv-muted"><?php echo esc_html( $mv_bio ); ?></p>
				<p class="mv-footer-direct">
					<a href="mailto:<?php echo esc_attr( $mv_email ); ?>"><?php echo esc_html( $mv_email ); ?></a>
					<span aria-hidden="true"> · </span>
					<a href="https://wa.me/<?php echo esc_attr( $mv_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">
						<?php esc_html_e( 'WhatsApp Concierge', 'maison-valen' ); ?>
					</a>
				</p>
			</div>

			<div>
				<h2 class="mv-footer-heading"><?php esc_html_e( 'Practice', 'maison-valen' ); ?></h2>
				<ul class="mv-footer-links">
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'maison-valen' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'maison-valen' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'Portfolio', 'maison-valen' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Journal', 'maison-valen' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'maison-valen' ); ?></a></li>
				</ul>
			</div>

			<div>
				<h2 class="mv-footer-heading"><?php esc_html_e( 'Quarterly Monograph', 'maison-valen' ); ?></h2>
				<p class="mv-muted"><?php esc_html_e( 'Essays on WordPress performance, architectural UX, and luxury commerce.', 'maison-valen' ); ?></p>
				<form id="mv-newsletter-form" class="mv-newsletter-form" novalidate>
					<label class="mv-sr-only" for="mv-newsletter-email"><?php esc_html_e( 'Work Email', 'maison-valen' ); ?></label>
					<input id="mv-newsletter-email" name="email" type="email" required placeholder="name@company.com" class="mv-input" />
					<button type="submit" class="mv-btn mv-btn-primary"><?php esc_html_e( 'Subscribe', 'maison-valen' ); ?></button>
					<p class="mv-form-feedback" aria-live="polite"></p>
				</form>

				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mv-footer-search">
					<label class="mv-sr-only" for="mv-footer-search-input"><?php esc_html_e( 'Search Archive', 'maison-valen' ); ?></label>
					<input id="mv-footer-search-input" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search services, works, essays...', 'maison-valen' ); ?>" class="mv-input" />
					<button type="submit" class="mv-btn mv-btn-secondary"><?php esc_html_e( 'Search', 'maison-valen' ); ?></button>
				</form>
			</div>
		</div>

		<div class="mv-footer-bottom">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Zurich & London.', 'maison-valen' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'maison-valen' ); ?></a>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
