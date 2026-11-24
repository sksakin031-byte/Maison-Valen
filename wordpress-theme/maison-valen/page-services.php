<?php
/**
 * Template Name: Services Overview
 *
 * @package Maison_Valen
 */
get_header();

$services = new WP_Query(
	array(
		'post_type'      => 'mv_service',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);
?>
<section class="mv-section">
	<div class="mv-container">
		<p class="mv-kicker"><?php esc_html_e( 'Advisory & Engineering', 'maison-valen' ); ?></p>
		<h1 class="mv-page-title"><?php the_title(); ?></h1>
		<div class="mv-prose"><?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?></div>

		<?php if ( $services->have_posts() ) : ?>
			<div class="mv-grid-2 mv-mt-lg">
				<?php while ( $services->have_posts() ) : $services->the_post(); ?>
					<article class="mv-card">
						<p class="mv-meta">
							<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_service_index', true ) ); ?>
							<span aria-hidden="true"> · </span>
							<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_service_timeline', true ) ); ?>
							<span aria-hidden="true"> · </span>
							<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_service_investment', true ) ); ?>
						</p>
						<h2 class="mv-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="mv-card-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<a class="mv-btn mv-btn-secondary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Service Details', 'maison-valen' ); ?></a>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
