<?php
/**
 * FWD Starter Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FWD_Starter_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.2.4' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fwd_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on FWD Starter Theme, use a find and replace
		* to change 'fwd' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'fwd', get_template_directory() . '/languages' );

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

    // Our Custom Image Crap Sizes
    // Portrait Blog Size - 200px width, 250px height, hard crop
    add_image_size( 'portrait-blog', 200, 250, true );
    add_image_size( 'landscape-blog', 400, 200, true );
    
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header'        => esc_html__( 'Header Menu Location', 'fwd' ),
            'footer-left'   => esc_html__( 'Footer - Left Side', 'fwd' ),
            'footer-right'  => esc_html__( 'Footer - Right Side', 'fwd' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'fwd_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
			// 'unlink-homepage-logo' 	=> true,
		)
	);

	/**
	 * Add support for Block Editor features.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
	 */
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	// add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'fwd_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fwd_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'fwd_content_width', 960 );
}
add_action( 'after_setup_theme', 'fwd_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fwd_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Post Sidebar', 'fwd' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'fwd' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
    register_sidebar(
        array(
            'name'          => esc_html__( 'Page Sidebar', 'fwd' ),
            'id'            => 'sidebar-2',
            'description'   => esc_html__( 'Add widgets here.', 'fwd' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'fwd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fwd_scripts() {
    wp_enqueue_style(
        'fwd-googlefonts', // unique handle
        'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap', // Google Fonts url
        array(),        // Dependencies array
        null           // Version number for Google Fonts, always set to null
    );
	wp_enqueue_style( 'fwd-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'fwd-style', 'rtl', 'replace' );

	wp_enqueue_script( 'fwd-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fwd_scripts' );

/** Custom post types and taxonomies. */
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Add the theme (fwd) color
 */
function fwd_theme_color() {
    echo '<meta name="theme-color" content="#fff200">';
}
add_action( 'wp_head', 'fwd_theme_color', 1 );

/**
 * Change excerpt length to 20 words for theme (fwd)
 */
function fwd_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'fwd_excerpt_length', 999 );

/**
 * Use this to change the default placeholder text "Add Title" on new
 * Service posts to "Add Service name"
 */
function fwd_enter_service_here( $title ) {
    $screen = get_current_screen();

    if ( is_admin() && $screen ) {
        switch ( $screen->post_type ) {
            case 'fwd-work':
                return 'Add work title';
            case 'fwd-service':
                return 'Add service name';
            case 'fwd-testimonial':
                return 'Add client name';
            case 'fwd-career':
                return 'Add new career posting';
            // No need for default, will return $title shortly
        }
    }

    return $title;
}
add_filter( 'enter_title_here', 'fwd_enter_service_here' );

/**
 * Change excerpt length to 20 words for theme (fwd)
 */
function fwd_excerpt_more( $more ) {
    $more = '... <a class="read-more" href="'
        . esc_url( get_permalink() )
        . '">'
        . __( 'Continue Reading', 'fwd' )
        .'</a>';
    return $more;
}
add_filter( 'excerpt_more', 'fwd_excerpt_more' );

/**
 * Use this to switch from Block editor to Classic editor
 */
function fwd_post_filter( $use_block_editor, $post ) {
    $page_ids = array( 6, 67 ); // Home Page, Test (ACF) Page
    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'fwd_post_filter', 10, 2 );


/**
 * Remove "Archive:" from Work archive page heading
 */
function fwd_remove_work_archive_title_prefix( $prefix ){
    if ( get_post_type() === 'fwd-work' ) {
        return '';
    }
    return $prefix;
}
add_filter( 'get_the_archive_title_prefix', 'fwd_remove_work_archive_title_prefix' );
 