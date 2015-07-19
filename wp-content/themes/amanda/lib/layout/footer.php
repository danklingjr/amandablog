<?php

// Footer
remove_action( 'genesis_footer', 'genesis_do_footer' );

add_action( 'genesis_footer', 'four_do_footer' );
function four_do_footer() {
?>

<?php
}