<?php

/**
* Template Name: Home Page
*
*/

// Set the page layout to full-width
add_filter( 'genesis_pre_get_option_site_layout', 'gsep_home_layout' );
    function gsep_home_layout( $opt ) {
    $opt = 'full-width-content'; // You can change this to any Genesis layout
    return $opt;
}


//Remove Post Title and headers for Home Page
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );


//Home Page Slider
add_action( 'genesis_after_header', 'amanda_hero');
function amanda_hero()
{
?>
    
<?php
}

//Home Page Center Section
add_action('genesis_before_content', 'amanda_homecenter');
function amanda_homecenter() 
{
?>

<?php
}

//Home Page Market News
add_action('genesis_before_footer', 'amanda_marketnews');
function amanda_marketnews() 
{
?>

<?php
}


//Home Page Looking for More
add_action('genesis_before_footer', 'amanda_lookingformore');
function amanda_lookingformore() 
{
?>

<?php
}

add_action( 'genesis_before','remove_homepage_content' );

function remove_homepage_content() {
        if (is_front_page() ) { 
        remove_action( 'genesis_loop', 'genesis_do_loop' );
        }
}

genesis();