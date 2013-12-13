<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
	<?php get_sidebar(); ?>
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				
				<?php get_template_part( 'content') ?>

				

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>