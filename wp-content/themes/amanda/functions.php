<?php

// Start the engine
require_once( get_template_directory() . '/lib/init.php' );

// Layout
require_once(CHILD_DIR.'/lib/layout.php');

// Template
include_once(CHILD_DIR.'/lib/template.php');

// Admin
//include_once(CHILD_DIR.'/lib/admin.php');

//error log
function elog($x){
    ob_start();
    print_r($x);
    $contents = ob_get_contents();
    ob_end_clean();
    error_log($contents);
}
unregister_sidebar( 'sidebar' );
// Registering Extra Menus
function register_menu() {
    register_nav_menu('about-sub', __('About Sub'));
}
add_action('init', 'register_menu');

function register_product_menu() {
    register_nav_menu('product-sub', __('Product Sub'));
}
add_action('init', 'register_product_menu');

function register_serve_menu() {
    register_nav_menu('serve-sub', __('Serve Sub'));
}
add_action('init', 'register_serve_menu');

function register_contact_menu() {
    register_nav_menu('contact-sub', __('Contact Sub'));
}
add_action('init', 'register_contact_menu');


add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'nav_main', __( 'Nav Main', 'theme-slug' ) );
}

add_action( 'after_setup_theme', 'fourseasons_setup' );
function fourseasons_setup() {
  add_image_size( 'gallery-large', 600, 400, array( 'center', 'center' ) ); // Hard crop left top
  add_image_size( 'large-square', 500, 500, array( 'center', 'center' ) ); // Hard crop left top
  add_image_size( 'large-rectangle', 574, 200, array( 'center', 'center' ) ); // Hard crop left top
  add_image_size( 'milestone-rectangle', 514, 146, array( 'center', 'center' ) ); // Hard crop left top
  add_image_size( 'resource-rectangle', 277, 134, array( 'center', 'top' ) ); // soft crop
  add_image_size( 'capabilities-rectangle', 574, 274, array( 'center', 'center' ) ); // soft crop
  add_image_size( 'slider-large', 1400, 550, array( 'top', 'center' ) ); // soft crop
  add_image_size( 'transport-square', 800, 800, array( 'top', 'center' ) ); // soft crop
}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

if(function_exists('acf_add_options_page')) { 
 
  acf_add_options_page();

}
add_action( 'genesis_before_loop', 'sk_excerpts_search_page' );
function sk_excerpts_search_page() {
  if ( is_search() ) {
        add_filter( 'genesis_pre_get_option_content_archive', 'sk_show_excerpts' );
    }
}

function sk_show_excerpts() {
    return 'excerpts';
}


