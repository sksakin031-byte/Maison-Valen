<?php
/**
 * Search Results Template
 *
 * @package Maison_Valen
 */
get_header();
?>
<section class="mv-section">
	<div class="mv-container">
		<p class="mv-kicker"><?php esc_html_e( 'Archive Search', 'maison-valen' ); ?></p>
		<h1 class="mv-page-title">
			<?php
			/* translators: %s: search query */
			printf( esc_html__( 'Results for: %s', 'maison-valen' ), esc_html( get_search_query() ) );
			?>
		</h1>

		<?php if ( have_posts() ) : ?>
			<div class="mv-grid-2">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="mv-card">
						<p class="mv-meta"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></p>
						<h2 class="mv-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="mv-card-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p class="mv-muted"><?php esc_html_e( 'No matching services, case studies, or essays were found.', 'maison-valen' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
