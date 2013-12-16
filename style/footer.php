<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<a href="https://github.com/hendronf/Style" target="_blank">Style</a> by <a href="http://fearghal.co.uk/" target="_blank">Fearghal</a> <?php if ( is_user_logged_in() ) { echo ' - <a href="'; echo wp_logout_url(); echo '" title="Logout">Logout</a>';} else { }?>



		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>