<section id="site-navigation" class="main-navigation" role="navigation">
	<nav class="navigation-sidebar">
		<header id="masthead" role="banner">
			<img class="custom-logo" src="<?php header_image(); ?>" alt="" />
			<div class="site-search"><?php get_search_form(); ?></div>
		</header><!-- #masthead -->
	            <?php add_filter( 'wp_nav_menu_objects', 'special_nav_classes' ); ?>
	            <?php function special_nav_classes($items) {
	                    $parents = array();
	                    foreach ( $items as $item ) {
	                        if ( $item->menu_item_parent && $item->menu_item_parent > 0 && !in_array( $item->menu_item_parent, $parents ) ) {
	                            $parents[] = $item->menu_item_parent;
	                        }
	                    }

	                    foreach ( $items as $item ) {
	                        if ( in_array( $item->ID, $parents ) ) {
	                            $item->classes[] = 'menu-parent-item';
	                        }
	                    }

	                    return $items;
	                } ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'walker' => new My_Walker_Nav_Menu(), ) ); ?>
	</nav>
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<a href="https://github.com/hendronf/Style" target="_blank">Style</a> by <a href="http://fearghal.co.uk/" target="_blank">Fearghal</a> <?php if ( is_user_logged_in() ) { echo ' - <a href="'; echo wp_logout_url(); echo '" title="Logout">Logout</a>';} else { }?>



		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</section><!-- #site-navigation -->
