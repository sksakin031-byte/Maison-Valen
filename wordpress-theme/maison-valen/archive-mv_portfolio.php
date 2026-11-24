<?php
/**
 * Portfolio Archive Template
 *
 * @package Maison_Valen
 */
get_header();

$sectors = get_terms( array( 'taxonomy' => 'portfolio_sector', 'hide_empty' => true ) );
?>
<section class="mv-section">
	<div class="mv-container">
		<p class="mv-kicker"><?php esc_html_e( 'Selected Works', 'maison-valen' ); ?></p>
		<h1 class="mv-page-title"><?php esc_html_e( 'Portfolio Archive', 'maison-valen' ); ?></h1>

		<?php if ( ! is_wp_error( $sectors ) && ! empty( $sectors ) ) : ?>
			<div class="mv-filter-bar" role="group" aria-label="<?php esc_attr_e( 'Filter portfolio by sector', 'maison-valen' ); ?>">
				<button type="button" class="mv-filter-btn is-active" data-sector="all"><?php esc_html_e( 'All Works', 'maison-valen' ); ?></button>
				<?php foreach ( $sectors as $sector ) : ?>
					<button type="button" class="mv-filter-btn" data-sector="<?php echo esc_attr( $sector->slug ); ?>">
						<?php echo esc_html( $sector->name ); ?>
					</button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<div class="mv-grid-3" id="mv-portfolio-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					$terms      = get_the_terms( get_the_ID(), 'portfolio_sector' );
					$term_slugs = ( $terms && ! is_wp_error( $terms ) ) ? implode( ' ', wp_list_pluck( $terms, 'slug' ) ) : '';
					?>
					<article class="mv-project-card" data-sectors="<?php echo esc_attr( $term_slugs ); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="mv-media-4x3"><?php the_post_thumbnail( 'mv-card', array( 'class' => 'mv-cover-img' ) ); ?></div>
						<?php endif; ?>
						<p class="mv-meta">
							<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_client_name', true ) ); ?>
							<span aria-hidden="true"> · </span>
							<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_project_year', true ) ); ?>
							<span aria-hidden="true"> · </span>
							<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_outcome_metric', true ) ); ?>
						</p>
						<h2 class="mv-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="mv-card-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
					</article>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
