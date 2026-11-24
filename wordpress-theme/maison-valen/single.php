<?php
/**
 * Single Blog Post Template
 *
 * @package Maison_Valen
 */
get_header();
?>
<article class="mv-section">
	<div class="mv-container mv-narrow">
		<?php while ( have_posts() ) : the_post(); ?>
			<p class="mv-meta">
				<?php echo esc_html( get_the_date() ); ?>
				<span aria-hidden="true"> · </span>
				<?php echo esc_html( get_the_author() ); ?>
			</p>
			<h1 class="mv-page-title"><?php the_title(); ?></h1>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="mv-media-16x9 mv-mb-md"><?php the_post_thumbnail( 'mv-hero', array( 'class' => 'mv-cover-img' ) ); ?></div>
			<?php endif; ?>
			<div class="mv-prose"><?php the_content(); ?></div>
			<div class="mv-mt-lg">
				<a class="mv-link-quiet" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Back to Journal', 'maison-valen' ); ?></a>
			</div>
		<?php endwhile; ?>
	</div>
</article>
<?php get_footer(); ?>
