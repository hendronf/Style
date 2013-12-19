<div id="site-navigation" class="main-navigation" role="navigation">
<nav>	
	<header id="masthead" role="banner">
		<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
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
</div><!-- #site-navigation -->
