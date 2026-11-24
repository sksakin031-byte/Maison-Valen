<?php
/**
 * Main Fallback Loop Template
 *
 * @package Maison_Valen
 */
get_header();
?>
<section class="mv-section">
	<div class="mv-container">
		<h1 class="mv-page-title"><?php esc_html_e( 'Archive', 'maison-valen' ); ?></h1>
		<?php if ( have_posts() ) : ?>
			<div class="mv-grid-3">
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'mv-card' ); ?>>
						<p class="mv-meta"><?php echo esc_html( get_the_date() ); ?></p>
						<h2 class="mv-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="mv-card-excerpt"><?php the_excerpt(); ?></div>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'No entries found.', 'maison-valen' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
