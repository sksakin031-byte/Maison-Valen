<?php
/**
 * Single Portfolio Case Study Template
 *
 * @package Maison_Valen
 */
get_header();
?>
<article class="mv-section">
	<div class="mv-container mv-narrow">
		<?php while ( have_posts() ) : the_post(); ?>
			<p class="mv-meta">
				<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_client_name', true ) ); ?>
				<span aria-hidden="true"> · </span>
				<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_project_location', true ) ); ?>
				<span aria-hidden="true"> · </span>
				<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_project_year', true ) ); ?>
			</p>
			<h1 class="mv-page-title"><?php the_title(); ?></h1>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="mv-media-16x9 mv-mb-md"><?php the_post_thumbnail( 'mv-hero', array( 'class' => 'mv-cover-img' ) ); ?></div>
			<?php endif; ?>
			<?php $outcome = get_post_meta( get_the_ID(), '_mv_outcome_metric', true ); ?>
			<?php if ( $outcome ) : ?>
				<div class="mv-proof-callout">
					<p class="mv-kicker"><?php esc_html_e( 'Measured Outcome', 'maison-valen' ); ?></p>
					<p class="mv-proof-val"><?php echo esc_html( $outcome ); ?></p>
				</div>
			<?php endif; ?>
			<div class="mv-prose"><?php the_content(); ?></div>
		<?php endwhile; ?>
	</div>
</article>
<?php get_footer(); ?>
