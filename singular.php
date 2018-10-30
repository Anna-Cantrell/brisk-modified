<?php
/**
 * Singular Template
 *
 * This file is the single post template for the WordPress theme. It displays 
 * the main content area of individual types (posts, pages, etc).
 *
 * @package WordPress
 * @subpackage Brisk
 * @since Brisk 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<main class="content">
		<?php while ( have_posts() ) : the_post(); ?>
			<article>
				<?php get_template_part('flexible-sections'); ?>
			</article>
		<?php endwhile; ?>
	</main>
<?php endif; ?>

<?php get_footer(); ?>
