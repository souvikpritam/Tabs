<?php
/**
 * Franke functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Franke
 */

/**
 * Template directory define
 */
if ( !defined( 'FRANKE_TEMPLATE_URI' ) ) {
    define( 'FRANKE_TEMPLATE_URI', get_template_directory_uri());
}
if ( !defined( 'FRANKE_TEMPLATE_DIR' ) ) {
    define( 'FRANKE_TEMPLATE_DIR', get_template_directory());
}

if ( ! function_exists( 'franke_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function franke_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Franke, use a find and replace
		 * to change 'franke' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'franke', FRANKE_TEMPLATE_DIR . '/languages' );

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
			'main-menu' => esc_html__( 'Primary', 'franke' ),
			'mobile-menu' => esc_html__( 'Mobile', 'franke' ),
			'footer-menu' => esc_html__( 'Footer', 'franke' )
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'franke_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/style.css', franke_google_fonts_url() ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 58,
			'width'       => 182,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Remove admin bar.
		 */
		if( current_user_can('executive_member') || 
			current_user_can('unverified_user')  || 
			current_user_can('subscriber')          ) {
			show_admin_bar(false);
		}
	}

endif;
add_action( 'after_setup_theme', 'franke_setup' );

/**
 * Add SVG Upload Support.
 */
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

function wpse303391_change_graphic_editor ($array) {
    return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}
add_filter ('wp_image_editors', 'wpse303391_change_graphic_editor');


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function register_all_franke_widgets() {

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Left One Part', 'franke' ),
		'id'            => 'footer-left-one-part',
		'description'   => esc_html__( 'Add widgets here.', 'franke' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Left Two Part', 'franke' ),
		'id'            => 'footer-left-two-part',
		'description'   => esc_html__( 'Add widgets here.', 'franke' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Right One Part', 'franke' ),
		'id'            => 'footer-right-one-part',
		'description'   => esc_html__( 'Add widgets here.', 'franke' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Right Two Part', 'franke' ),
		'id'            => 'footer-right-two-part',
		'description'   => esc_html__( 'Add widgets here.', 'franke' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright Text', 'franke' ),
		'id'            => 'footer-copyright-text',
		'description'   => esc_html__( 'Add widgets here.', 'franke' ),
		'before_widget' => '<div id="%1$s" class="col-md-3 footer_bar_column_second">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="hidden">',
		'after_title'   => '</p>'
	) );

}
add_action( 'widgets_init', 'register_all_franke_widgets' );

if ( ! function_exists( 'franke_google_fonts_url' ) ) :

/**
 * Register Google fonts for Franke.
 *
 * Create your own franke_google_fonts_url() function to override in a child theme.
 *
 * @since Franke 1.0
 *
 * @return string Google fonts URL for the theme.
 */

add_filter( 'google_fonts_api', function() {
	$fonts = 'Open+Sans:300,400,600,700';

	return $fonts;
}, 10, 1 );

function franke_google_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'franke' ) ) {
		$fonts[] = apply_filters( 'google_fonts_api', array($fonts) );
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => implode( '|', $fonts ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function franke_scripts() {

	wp_enqueue_style( 'franke-style', get_stylesheet_uri() );

	if ( !wp_style_is( 'font-awesome', 'registered' ) ) {
		wp_enqueue_style( 'font-awesome', FRANKE_TEMPLATE_URI.'/assets/css/font-awesome.min.css' );
	}

	wp_enqueue_style( 'franke-google-fonts', franke_google_fonts_url(), array(), null );

	wp_enqueue_style( 'bootstrap-style', FRANKE_TEMPLATE_URI.'/assets/css/bootstrap.min.css' );

	wp_enqueue_style( 'franke-event-style', FRANKE_TEMPLATE_URI.'/assets/css/franke-event.css' );

	wp_enqueue_style( 'franke-theme-style', FRANKE_TEMPLATE_URI.'/assets/css/franke-style-1.0.0.css' );

	if( !wp_style_is( 'js_composer_front', 'enqueued' ) && defined('WPB_VC_VERSION') ) {
	    wp_enqueue_style( 'js_composer_front' );
	}

	if ( is_rtl() ) {
		wp_enqueue_style( 'franke-theme-style-rtl', FRANKE_TEMPLATE_URI.'/rtl.css' );
	}

	wp_enqueue_script( 'franke-navigation', FRANKE_TEMPLATE_URI .'/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'franke-skip-link-focus-fix', FRANKE_TEMPLATE_URI .'/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bootstrap-script', FRANKE_TEMPLATE_URI .'/assets/js/bootstrap.min.js', array('jquery'), '20151215', true );
	
	wp_enqueue_script( 'retina-script', FRANKE_TEMPLATE_URI .'/assets/js/retina.min.js', array('bootstrap-script'), '20151215', true );

	wp_enqueue_script( 'franke-mobile-nav-script', FRANKE_TEMPLATE_URI .'/assets/js/franke-mobile-nav-script.js', array(), '20151215', true );

	wp_enqueue_script( 'franke-theme-script', FRANKE_TEMPLATE_URI .'/assets/js/franke-script-1.0.0.min.js', array('retina-script'), '20151215', true );

	$ICL_LANGUAGE_CODE = ( defined('ICL_LANGUAGE_CODE') ) ? ICL_LANGUAGE_CODE : '';

    wp_localize_script( 'franke-theme-script', 'wp_localize_object', 
    	array( 
    		'ajax_url'  	=> admin_url( 'admin-ajax.php' ),
    		'text_next' 	=> __('next', 'franke'),
    		'text_send' 	=> __('send', 'franke'),
    		'current_lang'  => $ICL_LANGUAGE_CODE
    	)
    );

	if( is_singular('event') ) {
	   wp_enqueue_script( 'franke-gmapapi', "https://maps.googleapis.com/maps/api/js?key=AIzaSyCPaaOCK8b-KZf3UDDe_teoYoxwp7jc-Wc", [], null, true);
       wp_enqueue_script( 'franke-gmapjs', FRANKE_TEMPLATE_URI . '/assets/js/gmap.js', [], '1.0.0', true ); 
	}
}
add_action( 'wp_enqueue_scripts', 'franke_scripts' );

/**
 * Enqueue a script in the WordPress admin
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function wpdocs_selectively_enqueue_admin_script( $hook ) {
    if ( 'users_page_executivemember' != $hook ) {
        return;
    }

    wp_enqueue_script( 'franke-admin-script', FRANKE_TEMPLATE_URI . '/assets/js/franke-admin-script.min.js', array('jquery'), '20151214', true );
    wp_localize_script( 'franke-admin-script', 'wp_localize_object', 
    	array( 
    		'ajax_url'  => admin_url( 'admin-ajax.php' )
    	)
    );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );

/**
 * Customizing Admin Login Styles.
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/customizing-admin-login.php';

/**
 * Implement the Custom Header feature.
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/customizer.php';


require_once FRANKE_TEMPLATE_DIR . '/inc/EventInvoice.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once FRANKE_TEMPLATE_DIR . '/inc/jetpack.php';
}

/**
 * Visual Composer Settings.
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/visual-composer-settings.php';

/**
 * Visual Composer Settings.
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/social-widget.php';

/**
 * Custom posts
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/custom-posts.php';

/**
 * Shortcodes
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/shortcodes.php';

/**
 * Shortcodes
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/custom-taxonomies.php';

/**
 * Nav Walker
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/navwalker.php';

/**
 * Custom meta boxes
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/custom-metaboxes.php';

/**
 * User custom roles
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/custom-user-roles-management.php';

/**
 * For executive member Settings.
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/executive-member-settings.php';

/**
 * For executive member Settings.
 */
require_once FRANKE_TEMPLATE_DIR . '/inc/user-meta-admin-page.php';