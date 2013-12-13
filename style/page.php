<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
				
				<!-- This is to display the styles entered on the page in the admin interface -->
				<style id="s" type="text/css">
				<?php $key="css"; echo get_post_meta($post->ID, $key, true); ?>
				</style>
				<!-- End Custom page style -->
				
				<?php get_template_part( 'content'); ?>
				
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>