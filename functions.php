<?php
/** http://alexvolkov.ru/how_to_hide_you_are_using_wordpress.html
/** https://habrahabr.ru/post/264033/

/**
 * @package antonia
 */

/**
* http://tgmpluginactivation.com
*/
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php'; 
add_action( 'tgmpa_register', 'mytheme_require_plugins' ); 
function mytheme_require_plugins() { 
    $plugins = array(
    	array(
    	'name'               => 'iThemes Security',
			'slug'               => 'better-wp-security',
			'required'           => false,
			),
			array(
				'name'               => 'Cyr to Lat enhanced',
				'slug'               => 'cyr3lat',
				'required'           => false,
			),
			array(
				'name'               => 'Google XML Sitemaps',
				'slug'               => 'google-sitemap-generator',
				'required'           => false,
			)
		);
    $config = array(); 
    tgmpa( $plugins, $config ); 
}

if ( ! function_exists( 'antonia_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function antonia_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on antonia, use a find and replace
	 * to change 'antonia' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'antonia', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	// add_theme_support( 'automatic-feed-links' );

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
		'primary' => esc_html__( 'Primary', 'antonia' ),
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

}
endif;
add_action( 'after_setup_theme', 'antonia_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function antonia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'antonia_content_width', 640 );
}
add_action( 'after_setup_theme', 'antonia_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function antonia_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'antonia' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'antonia' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'antonia_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function antonia_scripts() {
	//wp_enqueue_style( 'antonia-style', get_stylesheet_uri() );

	wp_enqueue_script( 'antonia-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
// What is it?
	wp_enqueue_script( 'antonia-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
}
add_action( 'wp_enqueue_scripts', 'antonia_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
 require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
// require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
/**
	* All scripts move to footer
	*/
function footer_enqueue_scripts(){
  remove_action('wp_head','wp_print_scripts');
  remove_action('wp_head','wp_print_head_scripts',9);
  remove_action('wp_head','wp_enqueue_scripts',1);
  add_action('wp_footer','wp_print_scripts',5);
  add_action('wp_footer','wp_enqueue_scripts',5);
  add_action('wp_footer','wp_print_head_scripts',5);
}
add_action('after_setup_theme','footer_enqueue_scripts');