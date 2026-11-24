<?php
/**
 * Blog / Journal Index Template
 *
 * @package Maison_Valen
 */
get_header();
?>
<section class="mv-section">
	<div class="mv-container">
		<div class="mv-section-head">
			<div>
				<p class="mv-kicker"><?php esc_html_e( 'Editorial Dispatches', 'maison-valen' ); ?></p>
				<h1 class="mv-page-title"><?php esc_html_e( 'The Monograph Journal', 'maison-valen' ); ?></h1>
			</div>
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mv-inline-search">
				<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search articles...', 'maison-valen' ); ?>" class="mv-input" />
				<button type="submit" class="mv-btn mv-btn-secondary"><?php esc_html_e( 'Search', 'maison-valen' ); ?></button>
			</form>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="mv-grid-2">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="mv-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="mv-media-4x3"><?php the_post_thumbnail( 'mv-card', array( 'class' => 'mv-cover-img' ) ); ?></div>
						<?php endif; ?>
						<p class="mv-meta">
							<?php echo esc_html( get_the_date() ); ?>
							<span aria-hidden="true"> · </span>
							<?php echo esc_html( get_the_author() ); ?>
						</p>
						<h2 class="mv-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="mv-card-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<a class="mv-link-quiet" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read Essay', 'maison-valen' ); ?></a>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
