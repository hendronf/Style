<nav id="site-navigation" class="main-navigation" role="navigation">
	<header id="masthead" class="" role="banner">
		<hgroup>
		
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<div class="header-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a></div>
		<?php else : ?>
			<div class="site-description"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> <?php bloginfo( 'description' ); ?></div>
		<?php endif; ?>
			
			<!-- <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'top-menu', 'items_wrap' => '<ul id="header-nav" class="topie">%3$s</ul>', ) ); ?> -->
		</hgroup>
	</header><!-- #masthead -->
			<div class="site-search"><?php get_search_form(); ?></div>
			<!-- <h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3> -->
			<?php wp_nav_menu( array( 'theme_location' => 'sidebar', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->