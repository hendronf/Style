<?php
/**
 * Twenty Twelve functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

function style_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style('inc/editor-style.css');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */

	// Register Custom Color Options in the Customise Interface.
	add_action( 'customize_register', 'hg_customize_register' );
	function hg_customize_register($wp_customize)
	{
	  $colors = array();
	  $colors[] = array( 'slug'=>'nav_bg_color', 'default' => '#e8e8e8', 'label' => __( 'Navigation Background Color', 'style' ) );
	  $colors[] = array( 'slug'=>'nav_link_text', 'default' => '#2469A0', 'label' => __( 'Nav Link Text', 'style' ) );
	  $colors[] = array( 'slug'=>'nav_link_hover', 'default' => '#cfcfcf', 'label' => __( 'Nav Link Hover', 'style' ) );


	  foreach($colors as $color)
	  {
	    // SETTINGS
	    $wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));

	    // CONTROLS
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
	  }
	}

}
add_action( 'after_setup_theme', 'style_setup' );

/**
 * Adds support for a custom header
 */

$args = array(
	'random-default'         => false,
	'width'         => '240',
	'flex-height'    => true,
	'height'        => '70px',
	'default-image' =>  get_template_directory_uri() . '/src/img/style.png',
	'uploads'       => true,
	'header-text'	=> false,
);
add_theme_support( 'custom-header', $args );

/**
 * Adds our content visibility plugin.
 */

require( get_template_directory() . '/inc/content-visibility.php' );


/**
 * Enqueues scripts and styles for front-end.
 */
function twentytwelve_scripts_styles() {
	global $wp_styles;

    /*
     * Adds JavaScript for handling the navigation menu hide-and-show behavior.
     */
    wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation-ck.js', array(), '1.0', true );

	/*
	 * Loads our stylesheets.
	 */
	wp_enqueue_style( 'style_styles', get_stylesheet_uri() ); // only for the theme name
	wp_enqueue_style( 'style-styles', get_template_directory_uri() . '/css/style-styles.css');

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );


// AdminBar Styles (available in the backend and frontend)

function custom_admin_css() {
	/*
	 * Loads custom admin css
	 */
	wp_register_style( 'custom-admin-css', get_template_directory_uri() . '/css/custom-admin-styles.css', false, '1.0.0' );
	wp_enqueue_style( 'custom-admin-css' );
}
add_action('wp_enqueue_scripts', 'custom_admin_css');
add_action('admin_enqueue_scripts', 'custom_admin_css');

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

// *************************************************************************
// Login Page Customisations
// *************************************************************************

//  Custom Login Logo and style
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url('<?php header_image(); ?>');
            background-size: inherit;
            width: 320px;
        }
        .login_form_message {
        	padding-bottom: 1rem;
        	color: #777;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

add_filter( 'login_headerurl', 'custom_login_header_url' );
function custom_login_header_url($url) {
return '';
}


// Custom Login Message

add_action('login_form', 'login_form_message');
function login_form_message() {
$adminemail = get_option('admin_email');
	echo '<p class="login_form_message">Please <a href="mailto:' . $adminemail . '">contact me</a> if you need login details.</p>';
}

// Redirect to homepage after login

function admin_default_page() {
  return '/';
}

add_filter('login_redirect', 'admin_default_page');

// *************************************************************************
// End of Login Page Customisations
// *************************************************************************

// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}


// Customizing Nav Menu's sub menus
class My_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"nav-sub-menu\">\n";
    }
}

// Custom Meta Boxes for CSS in pages thanks to http://pea.rs
add_action( 'add_meta_boxes', 'pears_add_meta_box' );
add_action( 'save_post', 'pears_save_post' );

function pears_add_meta_box() {

    add_meta_box(
        'style',
        'Style',
        'style_meta_box',
        'page',
        'normal',
        'high'
    );

}

function style_meta_box( $post ) {
  	wp_nonce_field( plugin_basename( __FILE__ ), 'style_noncename' );
  	$css = get_post_meta($post->ID,'css',true);

	echo '<p>This field is for CSS specific to this page. The post body should contain the markup relating to this page.</p>';
	echo '<label for="css">CSS</label>	';
  	echo '<p><textarea style="width:100%;" id="css" name="css" rows="20" class=""/>' . $css . '</textarea></p>';
}

function pears_save_post( $post_id ) {

	// Ignore if doing an autosave
  	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  	    return;

	// verify data came from style meta box
  	if ( !wp_verify_nonce( $_POST['style_noncename'], plugin_basename( __FILE__ ) ) )
		return;


  	// Check user permissions
  	if ( 'post' == $_POST['post_type'] ) {
    	if ( !current_user_can( 'edit_page', $post_id ) )
        	return;
  	}
  	else{
    	if ( !current_user_can( 'edit_post', $post_id ) )
	        return;
  	}

  	$html_data = $_POST['html'];
	update_post_meta($post_id, 'html', $html_data);

	$css_data = $_POST['css'];
	update_post_meta($post_id, 'css', $css_data);
}

// Default Image Instert Image to Link: None
update_option('image_default_link_type','none');

// Remove New Menu from Admin Bar.
function style_remove_new_menu() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('new-content'); // This removes the complete menu “Add New”.
    $wp_admin_bar->remove_menu('comments'); // This removes the comments link
}
add_action( 'wp_before_admin_bar_render', 'style_remove_new_menu' );

// flush rewrite rules and start again.

function my_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'init', 'codex_custom_init' );

/*-----------------------------------------------------------------------------------*/
/* Remove Unwanted Admin Menu Items */
/*-----------------------------------------------------------------------------------*/
add_action( 'admin_menu', 'style_remove_menu_pages' );

function style_remove_menu_pages() {
		remove_menu_page('edit.php');
		remove_menu_page('edit-comments.php');
}
// *******************************************************
// Add Custon New, Documentation and Changelog menus to the Admin bar.
// *******************************************************

add_action('admin_bar_menu', 'add_new_menu_items', 100);
function add_new_menu_items($admin_bar){
	$admin_bar->
		add_menu( array(
		'id'    => 'new_style_page_link', // add the New menu
		'title' => __('New' ),
		'href'  => '/wp-admin/post-new.php?post_type=page',
		'meta'  => array(
			'title' => __('Add a new page to the style guide'),
		),
	));
			$admin_bar->add_menu( array(
			'id'    => 'new_style_page_sublink', // add the New menu, New Page Link
				'parent' => 'new_style_page_link',
				'title' => 'New Page',
				'href'  => '/wp-admin/post-new.php?post_type=page',
				'meta'  => array(
					'title' => __('Add a new page to the style guide'),
					'class' => 'new_style_page_sublink'
				),
			));
			$admin_bar->add_menu( array(
				'id'    => 'add_new_media', // add the New menu, New Media Link
				'parent' => 'new_style_page_link',
				'title' => 'Add Download',
				'href'  => '/wp-admin/media-new.php',
				'meta'  => array(
					'title' => __('Add a new download, you will need to add this to a page after upload'),
					'class' => 'add_download_link'
				),
			));
			$admin_bar->add_menu( array(
				'id'    => 'add_new_user', // add the New menu, New User Link
				'parent' => 'new_style_page_link',
				'title' => 'Add User',
				'href'  => '/wp-admin/user-new.php',
				'meta'  => array(
					'title' => __('Give a new user access to the style guide.'),
					'class' => 'add_user_link'
				),
			));
	$admin_bar->
		add_menu( array(
		'id'    => 'documentation_link', // add the Documentation menu
		'title' => 'Documentation',
		'href'  => 'http://style.nu/docs',
		'meta'  => array(
			'title' => __('A how guide for Style. E.g. Add and remove users / add a new page edit menus etc.'),
			'target'=> '_blank',
		),
	));

	$admin_bar->
		add_menu( array(
		'id'    => 'changelog_link', // add the Changelog menu
		'title' => 'Change Log',
		'href'  => 'http://style.nu/changelog/',
		'meta'  => array(
			'title' => __('See the recent changes in Style'),
			'target'=> '_blank',
		),
	));
}



// *******************************************************
// /END of Add Custon New, Documentation and Changelog menus to the Admin bar.
// *******************************************************

?>
