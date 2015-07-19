<?php
//Remove Header Information
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
remove_action( 'genesis_header', 'genesis_do_header' );



//Primary Header
add_action( 'genesis_before_header', 'amanda_search' );
function amanda_search()
{
?>

<?php 
}
//Primary Header
add_action( 'genesis_header', 'amanda_do_header' );
function amanda_do_header()
{
?>

<?php
}

add_action('genesis_after', 'amanda_mobile_nav');
function amanda_mobile_nav()
{
?>

<?php
}