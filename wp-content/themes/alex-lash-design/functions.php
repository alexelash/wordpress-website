<?php
/**
 * Alex Lash Design functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Alex Lash Design
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page( );
}
function pp($var) { 
	print '<pre>'; print_r($var); print '</pre>'; 
}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function siblings($link) {
	global $post;
	$siblings = get_pages('child_of='.$post->post_parent.'&parent='.$post->post_parent.'&sort_column=menu_order');
	foreach ($siblings as $key=>$sibling){
		if ($post->ID == $sibling->ID){
			$ID = $key;
		}    
	}

	if( $ID == 0 ){
		$closest = array('before'=>get_permalink($siblings[count($siblings)-1]->ID),'after'=>get_permalink($siblings[$ID+1]->ID));  
	}elseif( $ID == count($siblings)-1 ){
		$closest = array('before'=>get_permalink($siblings[$ID-1]->ID),'after'=>get_permalink($siblings[0]->ID));
	}else{
		$closest = array('before'=>get_permalink($siblings[$ID-1]->ID),'after'=>get_permalink($siblings[$ID+1]->ID));   
	}

	if ($link == 'before' || $link == 'after') { echo $closest[$link]; } else { return $closest; } 
}


$the_page = array(
	/* (string) The title displayed on the options page. Required. */
	'page_title' => 'Global Variables',
	
	/* (string) The title displayed in the wp-admin sidebar. Defaults to page_title */
	'menu_title' => '',
	
	/* (string) The slug name to refer to this menu by (should be unique for this menu). 
	Defaults to a url friendly version of menu_slug */
	'menu_slug' => 'global_variables',
	
	/* (string) The capability required for this menu to be displayed to the user. Defaults to edit_posts.
	Read more about capability here: http://codex.wordpress.org/Roles_and_Capabilities */
	'capability' => 'edit_posts',
	
	//  (int|string) The position in the menu order this menu should appear. 
	// WARNING: if two menu items use the same position attribute, one of the items may be overwritten so that only one item displays!
	// Risk of conflict can be reduced by using decimal instead of integer values, e.g. '63.3' instead of 63 (must use quotes).
	// Defaults to bottom of utility menu items 
	'position' => false,
	
	/* (string) The slug of another WP admin page. if set, this will become a child page. */
	'parent_slug' => '',
	
	/* (string) The icon url for this menu. Defaults to default WordPress gear */
	'icon_url' => false,
	
	/* (boolean) If set to true, this options page will redirect to the first child page (if a child page exists). 
	If set to false, this parent page will appear alongside any child pages. Defaults to true */
	'redirect' => true,
	
	/* (int|string) The '$post_id' to save/load data to/from. Can be set to a numeric post ID (123), or a string ('user_2'). 
	Defaults to 'options'. Added in v5.2.7 */
	'post_id' => 'global_variables',
	
	/* (boolean)  Whether to load the option (values saved from this options page) when WordPress starts up. 
	Defaults to false. Added in v5.2.8. */
	'autoload' => false,
	
);
if ( ! function_exists( 'alex_lash_design_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function alex_lash_design_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Alex Lash Design, use a find and replace
	 * to change 'alex-lash-design' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'alex-lash-design', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'alex-lash-design' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'alex_lash_design_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // alex_lash_design_setup
add_action( 'after_setup_theme', 'alex_lash_design_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function alex_lash_design_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'alex_lash_design_content_width', 640 );
}
add_action( 'after_setup_theme', 'alex_lash_design_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function alex_lash_design_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'alex-lash-design' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'alex_lash_design_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'alex_lash_design_scripts' );
function alex_lash_design_scripts() {
	wp_enqueue_style( 'alex-lash-design-style', get_stylesheet_uri() );
	wp_enqueue_script( 'alex-lash-design-jquery', get_template_directory_uri() . '/js/vendor/jquery-2.1.4.min.js');
	wp_enqueue_script( 'alex-lash-design-modernizr', get_template_directory_uri() . '/js/vendor/modernizr.min.js');
	wp_enqueue_script( 'alex-lash-design-plugins', get_template_directory_uri() . '/js/plugins.js');
	wp_enqueue_script( 'alex-lash-design-main', get_template_directory_uri() . '/js/main.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
