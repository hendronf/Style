<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php bloginfo( 'name' ); ?><?php wp_title(' | '); ?></title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<?php wp_head(); ?>

<!-- Call the custom colors, if there are any -->
<?php 
$nav_bg_color = get_option('nav_bg_color');
$nav_link_text = get_option('nav_link_text'); 
$nav_link_hover = get_option('nav_link_hover'); 
?>
<style> 
.main-navigation, #colophon { background-color:<?php echo $nav_bg_color; ?>; }
.current-page-parent { background-color: <?php echo $nav_link_hover; ?>; }
.menu-item a, .menu-parent-item:before, .site-info, .site-info a { color:<?php echo $nav_link_text; ?>; } 
</style>
<!-- End Custom Color Call -->

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<div id="main" class="wrapper">