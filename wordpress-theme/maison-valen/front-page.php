<?php
/**
 * Homepage Template
 *
 * @package Maison_Valen
 */
get_header();

$kicker   = get_theme_mod( 'mv_hero_kicker', 'Zurich · London · Architectural Digital Consultancy' );
$headline = get_theme_mod( 'mv_hero_headline', 'Digital flagships built for enduring authority.' );
$subcopy  = get_theme_mod( 'mv_hero_subcopy', 'We engineer bespoke WordPress platforms, brand systems, and luxury commerce experiences for international leaders.' );
$cta_lbl  = get_theme_mod( 'mv_hero_cta_label', 'Schedule Discovery Call' );
?>

<section class="mv-hero">
	<div class="mv-container mv-hero-grid">
		<div class="mv-hero-copy">
			<p class="mv-kicker"><?php echo esc_html( $kicker ); ?></p>
			<h1 class="mv-hero-title"><?php echo esc_html( $headline ); ?></h1>
			<p class="mv-hero-lead"><?php echo esc_html( $subcopy ); ?></p>
			<div class="mv-hero-actions">
				<a class="mv-btn mv-btn-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php echo esc_html( $cta_lbl ); ?></a>
				<a class="mv-link-quiet" href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'Explore Selected Works', 'maison-valen' ); ?></a>
			</div>
		</div>
		<div class="mv-hero-media">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'mv-hero', array( 'class' => 'mv-cover-img', 'loading' => 'eager' ) ); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-studio.jpg' ); ?>" alt="<?php esc_attr_e( 'Maison Valen Zurich architectural studio', 'maison-valen' ); ?>" class="mv-cover-img" loading="eager" />
			<?php endif; ?>
		</div>
	</div>

	<div class="mv-container mv-proof-strip">
		<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
			<div class="mv-proof-item">
				<p class="mv-proof-val"><?php echo esc_html( get_theme_mod( "mv_metric_{$i}_val", '' ) ); ?></p>
				<p class="mv-proof-lbl"><?php echo esc_html( get_theme_mod( "mv_metric_{$i}_lbl", '' ) ); ?></p>
			</div>
		<?php endfor; ?>
	</div>
</section>

<section class="mv-section mv-section-surface">
	<div class="mv-container">
		<div class="mv-section-head">
			<div>
				<p class="mv-kicker"><?php esc_html_e( 'Capabilities', 'maison-valen' ); ?></p>
				<h2 class="mv-section-title"><?php esc_html_e( 'Architecture, engineering, and commercial rigor.', 'maison-valen' ); ?></h2>
			</div>
			<a class="mv-link-quiet" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'View All Services', 'maison-valen' ); ?></a>
		</div>

		<?php
		$services = new WP_Query(
			array(
				'post_type'      => 'mv_service',
				'posts_per_page' => 4,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);
		if ( $services->have_posts() ) :
			?>
			<div class="mv-grid-2">
				<?php while ( $services->have_posts() ) : $services->the_post(); ?>
					<article class="mv-card">
						<p class="mv-meta">
							<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_service_index', true ) ?: '01' ); ?>
							<span aria-hidden="true"> · </span>
							<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_service_timeline', true ) ?: '8–12 Weeks' ); ?>
						</p>
						<h3 class="mv-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="mv-card-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<a class="mv-link-quiet" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Inspect Specification', 'maison-valen' ); ?></a>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<section class="mv-section">
	<div class="mv-container">
		<div class="mv-section-head">
			<div>
				<p class="mv-kicker"><?php esc_html_e( 'Selected Case Studies', 'maison-valen' ); ?></p>
				<h2 class="mv-section-title"><?php esc_html_e( 'Measurable transformation across heritage sectors.', 'maison-valen' ); ?></h2>
			</div>
			<a class="mv-link-quiet" href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'Full Archive', 'maison-valen' ); ?></a>
		</div>

		<?php
		$projects = new WP_Query(
			array(
				'post_type'      => 'mv_portfolio',
				'posts_per_page' => 3,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);
		if ( $projects->have_posts() ) :
			?>
			<div class="mv-grid-3">
				<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
					<article class="mv-project-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="mv-media-4x3"><?php the_post_thumbnail( 'mv-card', array( 'class' => 'mv-cover-img' ) ); ?></div>
						<?php endif; ?>
						<p class="mv-meta">
							<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_client_name', true ) ); ?>
							<span aria-hidden="true"> · </span>
							<?php echo esc_html( get_post_meta( get_the_ID(), '_mv_outcome_metric', true ) ); ?>
						</p>
						<h3 class="mv-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="mv-card-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
