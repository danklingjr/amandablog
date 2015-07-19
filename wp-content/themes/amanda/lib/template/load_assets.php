<?php

/************************************************************
 * Enque Custom Scripts
 ************************************************************/
add_action( 'wp_enqueue_scripts', 'gsep_enqueue_scripts', 99);
function gsep_enqueue_scripts(){
    wp_enqueue_style('google-fonts', 'http://fonts.googleapis.com/css?family=Hind:400,700,300,600|Roboto+Slab:400,700,300|Lato:900');
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style('theme-css', get_bloginfo('stylesheet_directory') . '/assets/css/main.css');
    wp_enqueue_style('theme-css', get_bloginfo('stylesheet_directory') . '/assets/css/main.css');
    
    wp_enqueue_script('theme-js', get_bloginfo('stylesheet_directory') . '/assets/js/main.js', array(), '1', true);

}

