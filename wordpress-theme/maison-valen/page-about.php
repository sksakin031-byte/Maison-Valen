<?php
/**
 * Template Name: About Us
 *
 * @package Maison_Valen
 */
get_header();
?>
<section class="mv-section">
	<div class="mv-container mv-split-2">
		<div>
			<p class="mv-kicker"><?php esc_html_e( 'About Maison Valen', 'maison-valen' ); ?></p>
			<h1 class="mv-page-title"><?php the_title(); ?></h1>
			<div class="mv-prose">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		</div>
		<div class="mv-media-4x3">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'mv-card', array( 'class' => 'mv-cover-img' ) ); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/atelier-studio.jpg' ); ?>" alt="<?php esc_attr_e( 'Maison Valen senior partners in Zurich studio', 'maison-valen' ); ?>" class="mv-cover-img" />
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="mv-section mv-section-surface">
	<div class="mv-container mv-grid-2">
		<div class="mv-card">
			<p class="mv-kicker"><?php esc_html_e( 'Zurich Headquarters', 'maison-valen' ); ?></p>
			<h2 class="mv-card-title"><?php echo esc_html( get_theme_mod( 'mv_zurich_address', 'Talstrasse 82, 8001 Zurich, Switzerland' ) ); ?></h2>
			<p class="mv-muted"><?php echo esc_html( get_theme_mod( 'mv_zurich_phone', '+41 44 580 24 90' ) ); ?></p>
		</div>
		<div class="mv-card">
			<p class="mv-kicker"><?php esc_html_e( 'London Practice', 'maison-valen' ); ?></p>
			<h2 class="mv-card-title"><?php echo esc_html( get_theme_mod( 'mv_london_address', '24 Savile Row, Mayfair, London W1S 3PR' ) ); ?></h2>
			<p class="mv-muted"><?php echo esc_html( get_theme_mod( 'mv_london_phone', '+44 20 7946 0821' ) ); ?></p>
		</div>
	</div>
</section>
<?php get_footer(); ?>
