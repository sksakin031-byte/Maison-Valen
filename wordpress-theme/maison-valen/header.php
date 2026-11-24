<?php
/**
 * Header Template
 *
 * @package Maison_Valen
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'mv-body' ); ?>>
<?php wp_body_open(); ?>
<a class="mv-skip-link" href="#main-content"><?php esc_html_e( 'Skip to content', 'maison-valen' ); ?></a>

<header class="mv-header" role="banner">
	<div class="mv-container mv-header-inner">
		<a class="mv-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php bloginfo( 'name' ); ?>
		</a>

		<nav class="mv-nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'maison-valen' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'mv-nav-list',
						'depth'          => 1,
					)
				);
			} else {
				?>
				<ul class="mv-nav-list">
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'maison-valen' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'maison-valen' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'Portfolio', 'maison-valen' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Journal', 'maison-valen' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'maison-valen' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</nav>

		<div class="mv-header-actions">
			<a class="mv-btn mv-btn-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
				<?php esc_html_e( 'Book Consultation', 'maison-valen' ); ?>
			</a>
			<button type="button" class="mv-mobile-toggle" aria-expanded="false" aria-controls="mv-mobile-drawer">
				<?php esc_html_e( 'Menu', 'maison-valen' ); ?>
			</button>
		</div>
	</div>

	<div id="mv-mobile-drawer" class="mv-mobile-drawer" hidden>
		<nav aria-label="<?php esc_attr_e( 'Mobile Navigation', 'maison-valen' ); ?>">
			<ul class="mv-mobile-list">
				<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'maison-valen' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'maison-valen' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'Portfolio', 'maison-valen' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Journal', 'maison-valen' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'maison-valen' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'maison-valen' ); ?></a></li>
			</ul>
		</nav>
	</div>
</header>
<main id="main-content" role="main">
