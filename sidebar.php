<div id="site-navigation" class="main-navigation" role="navigation">
<nav>	
	<header id="masthead" role="banner">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<div class="header-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a></div>
		<?php else : ?>
			<div class="site-description"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="style-text-title" rel="home"><?php bloginfo( 'name' ); ?></div>
		<?php endif; ?>
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
			<?php wp_nav_menu( array( 'theme_location' => 'sidebar', 'menu_class' => 'nav-menu', 'walker' => new My_Walker_Nav_Menu(), ) ); ?>
</nav>
</div><!-- #site-navigation -->
