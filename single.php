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

				<h6 class="archive-title"><?php printf( __( 'Section: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h6>
				<?php get_template_part( 'content', get_post_format() ); ?>

				

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>