<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Alex Lash Design
 */

?><!DOCTYPE html>

	<?php 
	// Global variables
		$page_color = get_field('page_color');
		$text_color = get_field('text_color');
 	?>

<html <?php language_attributes(); ?> style="background-color: <?php echo $page_color ?>; color: <?php echo $text_color ?>; fill: <?php echo $text_color ?>;" data-origcolor="rgb(193,76,63)">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="icon" type="image/png" href="<?php echo site_url(); ?>/favicon.png">
<!-- Typography.com, Sentinel -->
<link rel="stylesheet" type="text/css" href="//cloud.typography.com/6837574/768848/css/fonts.css" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'alex-lash-design' ); ?></a>

	<header class="site-header" role="banner">
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php get_template_part('SVGs/inline', 'logo.svg'); ?></a></h1>
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"></button>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>', 'depth' => 1, ) ); ?>
		</nav>
	</header>
