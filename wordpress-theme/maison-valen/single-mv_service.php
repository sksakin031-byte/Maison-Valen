<?php
/**
 * Single Service Details Template
 *
 * @package Maison_Valen
 */
get_header();
?>
<section class="mv-section">
	<div class="mv-container mv-narrow">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			$index        = get_post_meta( get_the_ID(), '_mv_service_index', true );
			$timeline     = get_post_meta( get_the_ID(), '_mv_service_timeline', true );
			$investment   = get_post_meta( get_the_ID(), '_mv_service_investment', true );
			$proof        = get_post_meta( get_the_ID(), '_mv_service_proof', true );
			$deliverables = array_filter( array_map( 'trim', explode( "\n", (string) get_post_meta( get_the_ID(), '_mv_service_deliverables', true ) ) ) );
			?>
			<p class="mv-meta">
				<?php echo esc_html( $index ); ?>
				<span aria-hidden="true"> · </span>
				<?php echo esc_html( $timeline ); ?>
				<span aria-hidden="true"> · </span>
				<?php echo esc_html( $investment ); ?>
			</p>
			<h1 class="mv-page-title"><?php the_title(); ?></h1>
			<div class="mv-prose"><?php the_content(); ?></div>

			<?php if ( ! empty( $proof ) ) : ?>
				<div class="mv-proof-callout">
					<p class="mv-kicker"><?php esc_html_e( 'Verified Client Outcome', 'maison-valen' ); ?></p>
					<p class="mv-proof-val"><?php echo esc_html( $proof ); ?></p>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $deliverables ) ) : ?>
				<h2 class="mv-section-title"><?php esc_html_e( 'Core Deliverables', 'maison-valen' ); ?></h2>
				<ul class="mv-deliverables-list">
					<?php foreach ( $deliverables as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<div class="mv-mt-lg">
				<a class="mv-btn mv-btn-primary" href="<?php echo esc_url( add_query_arg( 'service', get_the_title(), home_url( '/contact/' ) ) ); ?>">
					<?php esc_html_e( 'Request Engagement Brief', 'maison-valen' ); ?>
				</a>
			</div>
		<?php endwhile; ?>
	</div>
</section>
<?php get_footer(); ?>
