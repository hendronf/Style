<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="site-search"><?php get_search_form(); ?></div>
			<!-- <h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3> -->
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->