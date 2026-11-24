<?php
/**
 * Template Name: Privacy Policy
 *
 * @package Maison_Valen
 */
get_header();
?>
<section class="mv-section">
	<div class="mv-container mv-narrow">
		<p class="mv-kicker"><?php esc_html_e( 'Legal & Governance', 'maison-valen' ); ?></p>
		<h1 class="mv-page-title"><?php the_title(); ?></h1>
		<div class="mv-prose">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
			endif;
			?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
