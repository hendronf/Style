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
			<a href="https://github.com/hendronf/Stile" target="_blank">Stile</a> by <a href="http://fearghal.co.uk/" target="_blank">Fearghal</a> - <a href="/changelog">Change Log</a> - <a href="<?php echo wp_logout_url(); ?>" title="Logout" class="logouturl">Logout</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>