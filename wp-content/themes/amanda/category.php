<?php

/**
* Template Name: Blog Page
*
*/

// Set the page layout to full-width
add_filter( 'genesis_pre_get_option_site_layout', 'gsep_home_layout' );
    function gsep_home_layout( $opt ) {
    $opt = 'content-sidebar'; // You can change this to any Genesis layout
    return $opt;
}


//Remove Post Title and headers for Home Page
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );


//Page Header
add_action( 'genesis_after_header', 'four_page_header');
function four_page_header() {
        remove_action( 'genesis_loop', 'genesis_do_loop' );
}

//Page Main Section
add_action('genesis_before_loop', 'four_homecenter');
function four_homecenter() 
{
    ?>
<section class="blog__wrap">
    
    <div class="blog__lower">
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


    query_posts( 'post_type=post&posts_per_page=8&paged='.$paged );
    if ( have_posts() ) : while ( have_posts() ) : the_post();

	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,'large-rectangle', true);
    

?>
        <article class="article__small">
	        <?php if ( has_post_thumbnail() ) { ?>
            <figure class="article__graphic">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url[0]; ?>" alt=""></a>
            </figure>
            <?php } ?>
            <div class="article__content">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="article__info">
                    <time datetime=""><?php echo get_the_time('M d, Y'); ?></time>
                    <span class="article__author">By: <?php the_author(); ?> </span>
                </div>
                <p class="article__excerpt"><?php the_excerpt(); ?></p>
                <hr>
                <div class="article__more">
                    <a href="<?php the_permalink(); ?>" class="button__article">Read Whole Story</a>
                </div>
            </div>
        </article>
<?php
endwhile;
?>        
    </div>
    <div class="article__pagination">
            <?php previous_posts_link('Previous'); ?>
            <?php next_posts_link('Next'); ?>
        </div>
<?php endif; ?>
<?php wp_reset_query(); ?>
</section>
    <?php
}
//Page Main Section
add_action( 'genesis_sidebar', 'four_sidebar' );
function four_sidebar() {
    ?>
<div class="sidebar__search">
    <h3>Search The Blog</h3>
    <div class="search__wrap">
	    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="text" value="<?php echo get_search_query(); ?>">
        <input type="submit" value="" class="search__submit">
	    </form>
    </div>
</div>
<div class="sidebar__list">
    <h3>Recent Posts</h3>
    <ul>
<?php
$args = array( 'post_type' => 'post', 'posts_per_page' => 5 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();

?>
        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
endwhile;
?> 
    </ul>
</div>
<div class="sidebar__newsletter">
    <h3>Sign Up For Updates</h3>
    <div class="search__wrap">
        <input type="text" name="">
        <input type="submit" value="subscribe">
    </div>
</div>
<div class="sidebar__list">
    <h3>Categories</h3>
    <ul>
<?php

	$args3 = array(
	'show_option_all'    => '',
	'orderby'            => 'name',
	'order'              => 'ASC',
	'style'              => 'list',
	'show_count'         => 0,
	'hide_empty'         => 1,
	'use_desc_for_title' => 1,
	'child_of'           => 0,
	'feed'               => '',
	'feed_type'          => '',
	'feed_image'         => '',
	'exclude'            => '',
	'exclude_tree'       => '',
	'include'            => '',
	'hierarchical'       => 1,
	'title_li'           => __( '' ),
	'show_option_none'   => __( '' ),
	'number'             => null,
	'echo'               => 1,
	'depth'              => 0,
	'current_category'   => 0,
	'pad_counts'         => 0,
	'taxonomy'           => 'category',
	'walker'             => null
    );


while ( have_posts() ) : the_post();

?>
        <?php wp_list_categories( $args3 ); ?> 
<?php
endwhile;
?>
    </ul>
</div>
<div class="sidebar__social">
    <h3>Follow Us On Social</h3>
    <a href="https://www.facebook.com/FourSeasonsProduceInc?fref=ts"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 200 200" enable-background="new 0 0 200 200" xml:space="preserve"><g display="none"><rect display="inline" width="35" height="200" class="style0"/><rect x="55" display="inline" width="35" height="200" class="style0"/><rect x="110" display="inline" width="35" height="200" class="style0"/><rect x="165" display="inline" width="35" height="200" class="style0"/><g display="inline"><line x1="200" y1="-100" x2="200" y2="300" class="style1"/><line x1="165" y1="-100" x2="165" y2="300" class="style1"/><line x1="145" y1="-100" x2="145" y2="300" class="style1"/><line x1="110" y1="-100" x2="110" y2="300" class="style1"/><line x1="90" y1="-100" x2="90" y2="300" class="style1"/><line x1="55" y1="-100" x2="55" y2="300" class="style1"/><line x1="35" y1="-100" x2="35" y2="300" class="style1"/><line x1="0" y1="-100" x2="0" y2="300" class="style1"/><line x1="-100" y1="200" x2="300" y2="200" class="style1"/><line x1="-100" y1="0" x2="300" y2="0" class="style1"/></g></g><g><path d="M99.9 49.3c13.9 0 26.9 5.4 36.8 15.2c9.8 9.8 15.2 22.9 15.2 36.8 c0 13.9-5.4 26.9-15.2 36.8c-9.8 9.8-22.9 15.2-36.8 15.2c-13.9 0-26.9-5.4-36.7-15.2c-9.8-9.8-15.2-22.9-15.2-36.8 c0-13.9 5.4-26.9 15.2-36.8C72.9 54.7 86 49.3 99.9 49.3 M99.9 36.7c-35.6 0-64.5 28.9-64.5 64.5c0 35.6 28.9 64.5 64.5 64.5 c35.6 0 64.5-28.9 64.5-64.5C164.4 65.6 135.5 36.7 99.9 36.7L99.9 36.7z M91 89.4h-7.4v12H91v35.3h14.2v-35.5h9.9l1-11.9h-10.9 c0 0 0-4.4 0-6.8c0-2.8 0.6-3.9 3.3-3.9c2.2 0 7.7 0 7.7 0V66.4c0 0-8.1 0-9.8 0C95.8 66.4 91 71 91 79.9C91 87.6 91 89.4 91 89.4z " class="style2"/><path display="none" d="M100 49.3c13.9 0 26.9 5.4 36.7 15.2 c9.8 9.8 15.2 22.9 15.2 36.7c0 13.9-5.4 26.9-15.2 36.7c-9.8 9.8-22.9 15.2-36.7 15.2c-13.9 0-26.9-5.4-36.7-15.2 c-9.8-9.8-15.2-22.9-15.2-36.7c0-13.9 5.4-26.9 15.2-36.7C73.1 54.7 86.1 49.3 100 49.3 M100 36.7c-35.6 0-64.5 28.9-64.5 64.5 c0 35.6 28.9 64.5 64.5 64.5c35.6 0 64.5-28.9 64.5-64.5C164.5 65.6 135.6 36.7 100 36.7L100 36.7z M86.7 76.1c0 4-3.2 7.2-7.1 7.2 c-3.9 0-7.1-3.2-7.1-7.2c0-4 3.2-7.2 7.1-7.2C83.5 68.9 86.7 72.1 86.7 76.1z M85.6 88.4h-12v38.9h12V88.4z M104.8 88.4H93.3v38.9 h11.5c0 0 0-14.4 0-20.4c0-5.5 2.5-8.7 7.3-8.7c4.4 0 6.6 3.1 6.6 8.7c0 5.6 0 20.4 0 20.4h12c0 0 0-14.2 0-24.6 c0-10.4-5.9-15.4-14.1-15.4c-8.2 0-11.7 6.4-11.7 6.4L104.8 88.4L104.8 88.4z" class="style2"/><path display="none" d="M100 49.3c28.7 0 51.9 23.2 51.9 51.9c0 28.7-23.2 51.9-51.9 51.9 c-28.7 0-51.9-23.2-51.9-51.9C48.1 72.5 71.3 49.3 100 49.3 M100 36.8c-35.6 0-64.4 28.8-64.4 64.4c0 35.6 28.9 64.4 64.4 64.4 c35.6 0 64.4-28.8 64.4-64.4C164.4 65.6 135.6 36.8 100 36.8L100 36.8z M135.3 84.3c-2.4 1.1-5 1.8-7.7 2.1 c2.8-1.7 4.9-4.3 5.9-7.4c-2.6 1.5-5.5 2.7-8.5 3.3c-2.5-2.6-6-4.3-9.8-4.3c-8.7 0-15.1 8.1-13.1 16.5C90.8 94 80.9 88.6 74.3 80.5 c-3.5 6-1.8 14 4.2 18c-2.2-0.1-4.3-0.7-6.1-1.7c-0.1 6.2 4.3 12.1 10.8 13.4c-1.9 0.5-4 0.6-6.1 0.2c1.7 5.3 6.7 9.2 12.6 9.3 c-5.7 4.4-12.8 6.4-19.9 5.6c6 3.8 13 6 20.6 6c25 0 39.1-21.1 38.2-40C131.2 89.4 133.5 87 135.3 84.3z" class="style2"/><path display="none" d="M100 36.8c-35.6 0-64.4 28.8-64.4 64.4c0 35.6 28.9 64.4 64.4 64.4 c35.6 0 64.4-28.8 64.4-64.4C164.4 65.6 135.6 36.8 100 36.8z M100 153.1c-28.7 0-51.9-23.2-51.9-51.9c0-28.7 23.2-51.9 51.9-51.9 c28.7 0 51.9 23.2 51.9 51.9C151.9 129.9 128.7 153.1 100 153.1z M79.2 65.5h4.1l2.8 10.6l2.6-10.6H93l-4.8 15.8v10.8h-4.1V81.3 L79.2 65.5z M92.8 87.2c0 3.5 1.8 5.3 5.3 5.3c2.9 0 5.3-2 5.3-5.3v-9.6c0-3.1-2.3-5.3-5.3-5.3c-3.2 0-5.3 2.1-5.3 5.3V87.2z M96.5 77.9c0-1.1 0.5-1.9 1.5-1.9c1.1 0 1.6 0.8 1.6 1.9V87c0 1.1-0.5 1.9-1.5 1.9c-1 0-1.6-0.8-1.6-1.9V77.9L96.5 77.9z M113.3 72.4v14.9c-0.4 0.6-1.4 1.5-2.1 1.5c-0.8 0-1-0.5-1-1.3V72.4h-3.7v16.4c0 1.9 0.6 3.5 2.6 3.5c1.1 0 2.6-0.6 4.2-2.4v2.2 h3.7V72.4H113.3z M107.9 112.7c0.2 0.3 0.4 0.8 0.4 1.4v9.7c0 0.6-0.1 1-0.3 1.3c-0.4 0.5-1.2 0.5-1.8 0.2 c-0.3-0.1-0.5-0.3-0.8-0.7V113c0.2-0.3 0.5-0.4 0.7-0.6C106.7 112.1 107.5 112.2 107.9 112.7z M119.6 112.3c-1.3 0-1.6 0.9-1.6 2.2 v1.9h3.1v-1.9C121.1 113.2 120.9 112.3 119.6 112.3z M130.2 126.1c0 4.6-3.8 8.4-8.4 8.4H78.8c-4.6 0-8.4-3.8-8.4-8.4v-21.2 c0-4.6 3.8-8.4 8.4-8.4h43.1c4.6 0 8.4 3.8 8.4 8.4V126.1L130.2 126.1z M84.5 106.5h4.1v-3.7h-12v3.7h4.1v21.7h3.9V106.5 L84.5 106.5z M98.4 109.5H95v14.2c-0.4 0.5-1.4 1.4-2 1.4c-0.7 0-0.9-0.5-0.9-1.3v-14.3h-3.5v15.6c0 3.8 2.6 3.8 4.4 2.7 c0.7-0.4 1.4-1 2-1.7v2.1h3.5V109.5z M111.8 113.9c0-2.5-0.8-4.7-3.4-4.7c-1.2 0-2.3 0.8-3.1 1.7v-8.2h-3.5v25.4h3.5v-1.4 c1 1.2 2 1.7 3.3 1.7c2.3 0 3.2-1.8 3.2-4.1V113.9L111.8 113.9z M124.7 114.5c0-3.4-1.6-5.5-5-5.5c-3.1 0-5.3 2.3-5.3 5.5v8.4 c0 3.4 1.7 5.8 5 5.8c3.7 0 5.2-2.2 5.2-5.8v-1.4h-3.6v1.3c0 1.6-0.1 2.6-1.6 2.6c-1.4 0-1.5-1.2-1.5-2.6v-3.5h6.7V114.5 L124.7 114.5z" class="style2"/></g></svg></a>
                  
	<a href="https://www.linkedin.com/company/four-seasons-produce?trk=top_nav_home"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 200 200" enable-background="new 0 0 200 200" xml:space="preserve"><g display="none"><rect display="inline" width="35" height="200" class="style0"/><rect x="55" display="inline" width="35" height="200" class="style0"/><rect x="110" display="inline" width="35" height="200" class="style0"/><rect x="165" display="inline" width="35" height="200" class="style0"/><g display="inline"><line x1="200" y1="-100" x2="200" y2="300" class="style1"/><line x1="165" y1="-100" x2="165" y2="300" class="style1"/><line x1="145" y1="-100" x2="145" y2="300" class="style1"/><line x1="110" y1="-100" x2="110" y2="300" class="style1"/><line x1="90" y1="-100" x2="90" y2="300" class="style1"/><line x1="55" y1="-100" x2="55" y2="300" class="style1"/><line x1="35" y1="-100" x2="35" y2="300" class="style1"/><line x1="0" y1="-100" x2="0" y2="300" class="style1"/><line x1="-100" y1="200" x2="300" y2="200" class="style1"/><line x1="-100" y1="0" x2="300" y2="0" class="style1"/></g></g><g><path display="none" d="M99.9 49.3c13.9 0 26.9 5.4 36.8 15.2 c9.8 9.8 15.2 22.9 15.2 36.8c0 13.9-5.4 26.9-15.2 36.8c-9.8 9.8-22.9 15.2-36.8 15.2c-13.9 0-26.9-5.4-36.7-15.2 c-9.8-9.8-15.2-22.9-15.2-36.8c0-13.9 5.4-26.9 15.2-36.8C72.9 54.7 86 49.3 99.9 49.3 M99.9 36.7c-35.6 0-64.5 28.9-64.5 64.5 c0 35.6 28.9 64.5 64.5 64.5c35.6 0 64.5-28.9 64.5-64.5C164.4 65.6 135.5 36.7 99.9 36.7L99.9 36.7z M91 89.4h-7.4v12H91v35.3 h14.2v-35.5h9.9l1-11.9h-10.9c0 0 0-4.4 0-6.8c0-2.8 0.6-3.9 3.3-3.9c2.2 0 7.7 0 7.7 0V66.4c0 0-8.1 0-9.8 0 C95.8 66.4 91 71 91 79.9C91 87.6 91 89.4 91 89.4z" class="style2"/><path d="M100 49.3c13.9 0 26.9 5.4 36.7 15.2c9.8 9.8 15.2 22.9 15.2 36.7 c0 13.9-5.4 26.9-15.2 36.7c-9.8 9.8-22.9 15.2-36.7 15.2c-13.9 0-26.9-5.4-36.7-15.2c-9.8-9.8-15.2-22.9-15.2-36.7 c0-13.9 5.4-26.9 15.2-36.7C73.1 54.7 86.1 49.3 100 49.3 M100 36.7c-35.6 0-64.5 28.9-64.5 64.5c0 35.6 28.9 64.5 64.5 64.5 c35.6 0 64.5-28.9 64.5-64.5C164.5 65.6 135.6 36.7 100 36.7L100 36.7z M86.7 76.1c0 4-3.2 7.2-7.1 7.2c-3.9 0-7.1-3.2-7.1-7.2 c0-4 3.2-7.2 7.1-7.2C83.5 68.9 86.7 72.1 86.7 76.1z M85.6 88.4h-12v38.9h12V88.4z M104.8 88.4H93.3v38.9h11.5c0 0 0-14.4 0-20.4 c0-5.5 2.5-8.7 7.3-8.7c4.4 0 6.6 3.1 6.6 8.7c0 5.6 0 20.4 0 20.4h12c0 0 0-14.2 0-24.6c0-10.4-5.9-15.4-14.1-15.4 c-8.2 0-11.7 6.4-11.7 6.4L104.8 88.4L104.8 88.4z" class="style2"/><path display="none" d="M100 49.3c28.7 0 51.9 23.2 51.9 51.9c0 28.7-23.2 51.9-51.9 51.9 c-28.7 0-51.9-23.2-51.9-51.9C48.1 72.5 71.3 49.3 100 49.3 M100 36.8c-35.6 0-64.4 28.8-64.4 64.4c0 35.6 28.9 64.4 64.4 64.4 c35.6 0 64.4-28.8 64.4-64.4C164.4 65.6 135.6 36.8 100 36.8L100 36.8z M135.3 84.3c-2.4 1.1-5 1.8-7.7 2.1 c2.8-1.7 4.9-4.3 5.9-7.4c-2.6 1.5-5.5 2.7-8.5 3.3c-2.5-2.6-6-4.3-9.8-4.3c-8.7 0-15.1 8.1-13.1 16.5C90.8 94 80.9 88.6 74.3 80.5 c-3.5 6-1.8 14 4.2 18c-2.2-0.1-4.3-0.7-6.1-1.7c-0.1 6.2 4.3 12.1 10.8 13.4c-1.9 0.5-4 0.6-6.1 0.2c1.7 5.3 6.7 9.2 12.6 9.3 c-5.7 4.4-12.8 6.4-19.9 5.6c6 3.8 13 6 20.6 6c25 0 39.1-21.1 38.2-40C131.2 89.4 133.5 87 135.3 84.3z" class="style2"/><path display="none" d="M100 36.8c-35.6 0-64.4 28.8-64.4 64.4c0 35.6 28.9 64.4 64.4 64.4 c35.6 0 64.4-28.8 64.4-64.4C164.4 65.6 135.6 36.8 100 36.8z M100 153.1c-28.7 0-51.9-23.2-51.9-51.9c0-28.7 23.2-51.9 51.9-51.9 c28.7 0 51.9 23.2 51.9 51.9C151.9 129.9 128.7 153.1 100 153.1z M79.2 65.5h4.1l2.8 10.6l2.6-10.6H93l-4.8 15.8v10.8h-4.1V81.3 L79.2 65.5z M92.8 87.2c0 3.5 1.8 5.3 5.3 5.3c2.9 0 5.3-2 5.3-5.3v-9.6c0-3.1-2.3-5.3-5.3-5.3c-3.2 0-5.3 2.1-5.3 5.3V87.2z M96.5 77.9c0-1.1 0.5-1.9 1.5-1.9c1.1 0 1.6 0.8 1.6 1.9V87c0 1.1-0.5 1.9-1.5 1.9c-1 0-1.6-0.8-1.6-1.9V77.9L96.5 77.9z M113.3 72.4v14.9c-0.4 0.6-1.4 1.5-2.1 1.5c-0.8 0-1-0.5-1-1.3V72.4h-3.7v16.4c0 1.9 0.6 3.5 2.6 3.5c1.1 0 2.6-0.6 4.2-2.4v2.2 h3.7V72.4H113.3z M107.9 112.7c0.2 0.3 0.4 0.8 0.4 1.4v9.7c0 0.6-0.1 1-0.3 1.3c-0.4 0.5-1.2 0.5-1.8 0.2 c-0.3-0.1-0.5-0.3-0.8-0.7V113c0.2-0.3 0.5-0.4 0.7-0.6C106.7 112.1 107.5 112.2 107.9 112.7z M119.6 112.3c-1.3 0-1.6 0.9-1.6 2.2 v1.9h3.1v-1.9C121.1 113.2 120.9 112.3 119.6 112.3z M130.2 126.1c0 4.6-3.8 8.4-8.4 8.4H78.8c-4.6 0-8.4-3.8-8.4-8.4v-21.2 c0-4.6 3.8-8.4 8.4-8.4h43.1c4.6 0 8.4 3.8 8.4 8.4V126.1L130.2 126.1z M84.5 106.5h4.1v-3.7h-12v3.7h4.1v21.7h3.9V106.5 L84.5 106.5z M98.4 109.5H95v14.2c-0.4 0.5-1.4 1.4-2 1.4c-0.7 0-0.9-0.5-0.9-1.3v-14.3h-3.5v15.6c0 3.8 2.6 3.8 4.4 2.7 c0.7-0.4 1.4-1 2-1.7v2.1h3.5V109.5z M111.8 113.9c0-2.5-0.8-4.7-3.4-4.7c-1.2 0-2.3 0.8-3.1 1.7v-8.2h-3.5v25.4h3.5v-1.4 c1 1.2 2 1.7 3.3 1.7c2.3 0 3.2-1.8 3.2-4.1V113.9L111.8 113.9z M124.7 114.5c0-3.4-1.6-5.5-5-5.5c-3.1 0-5.3 2.3-5.3 5.5v8.4 c0 3.4 1.7 5.8 5 5.8c3.7 0 5.2-2.2 5.2-5.8v-1.4h-3.6v1.3c0 1.6-0.1 2.6-1.6 2.6c-1.4 0-1.5-1.2-1.5-2.6v-3.5h6.7V114.5 L124.7 114.5z" class="style2"/></g></svg></a>
	
	<a href="https://twitter.com/fsproduce"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 200 200" enable-background="new 0 0 200 200" xml:space="preserve"><g display="none"><rect display="inline" width="35" height="200" class="style0"/><rect x="55" display="inline" width="35" height="200" class="style0"/><rect x="110" display="inline" width="35" height="200" class="style0"/><rect x="165" display="inline" width="35" height="200" class="style0"/><g display="inline"><line x1="200" y1="-100" x2="200" y2="300" class="style1"/><line x1="165" y1="-100" x2="165" y2="300" class="style1"/><line x1="145" y1="-100" x2="145" y2="300" class="style1"/><line x1="110" y1="-100" x2="110" y2="300" class="style1"/><line x1="90" y1="-100" x2="90" y2="300" class="style1"/><line x1="55" y1="-100" x2="55" y2="300" class="style1"/><line x1="35" y1="-100" x2="35" y2="300" class="style1"/><line x1="0" y1="-100" x2="0" y2="300" class="style1"/><line x1="-100" y1="200" x2="300" y2="200" class="style1"/><line x1="-100" y1="0" x2="300" y2="0" class="style1"/></g></g><g><path display="none" d="M99.9 49.3c13.9 0 26.9 5.4 36.8 15.2 c9.8 9.8 15.2 22.9 15.2 36.8c0 13.9-5.4 26.9-15.2 36.8c-9.8 9.8-22.9 15.2-36.8 15.2c-13.9 0-26.9-5.4-36.7-15.2 c-9.8-9.8-15.2-22.9-15.2-36.8c0-13.9 5.4-26.9 15.2-36.8C72.9 54.7 86 49.3 99.9 49.3 M99.9 36.7c-35.6 0-64.5 28.9-64.5 64.5 c0 35.6 28.9 64.5 64.5 64.5c35.6 0 64.5-28.9 64.5-64.5C164.4 65.6 135.5 36.7 99.9 36.7L99.9 36.7z M91 89.4h-7.4v12H91v35.3 h14.2v-35.5h9.9l1-11.9h-10.9c0 0 0-4.4 0-6.8c0-2.8 0.6-3.9 3.3-3.9c2.2 0 7.7 0 7.7 0V66.4c0 0-8.1 0-9.8 0 C95.8 66.4 91 71 91 79.9C91 87.6 91 89.4 91 89.4z" class="style2"/><path display="none" d="M100 49.3c13.9 0 26.9 5.4 36.7 15.2 c9.8 9.8 15.2 22.9 15.2 36.7c0 13.9-5.4 26.9-15.2 36.7c-9.8 9.8-22.9 15.2-36.7 15.2c-13.9 0-26.9-5.4-36.7-15.2 c-9.8-9.8-15.2-22.9-15.2-36.7c0-13.9 5.4-26.9 15.2-36.7C73.1 54.7 86.1 49.3 100 49.3 M100 36.7c-35.6 0-64.5 28.9-64.5 64.5 c0 35.6 28.9 64.5 64.5 64.5c35.6 0 64.5-28.9 64.5-64.5C164.5 65.6 135.6 36.7 100 36.7L100 36.7z M86.7 76.1c0 4-3.2 7.2-7.1 7.2 c-3.9 0-7.1-3.2-7.1-7.2c0-4 3.2-7.2 7.1-7.2C83.5 68.9 86.7 72.1 86.7 76.1z M85.6 88.4h-12v38.9h12V88.4z M104.8 88.4H93.3v38.9 h11.5c0 0 0-14.4 0-20.4c0-5.5 2.5-8.7 7.3-8.7c4.4 0 6.6 3.1 6.6 8.7c0 5.6 0 20.4 0 20.4h12c0 0 0-14.2 0-24.6 c0-10.4-5.9-15.4-14.1-15.4c-8.2 0-11.7 6.4-11.7 6.4L104.8 88.4L104.8 88.4z" class="style2"/><path d="M100 49.3c28.7 0 51.9 23.2 51.9 51.9c0 28.7-23.2 51.9-51.9 51.9 c-28.7 0-51.9-23.2-51.9-51.9C48.1 72.5 71.3 49.3 100 49.3 M100 36.8c-35.6 0-64.4 28.8-64.4 64.4c0 35.6 28.9 64.4 64.4 64.4 c35.6 0 64.4-28.8 64.4-64.4C164.4 65.6 135.6 36.8 100 36.8L100 36.8z M135.3 84.3c-2.4 1.1-5 1.8-7.7 2.1 c2.8-1.7 4.9-4.3 5.9-7.4c-2.6 1.5-5.5 2.7-8.5 3.3c-2.5-2.6-6-4.3-9.8-4.3c-8.7 0-15.1 8.1-13.1 16.5C90.8 94 80.9 88.6 74.3 80.5 c-3.5 6-1.8 14 4.2 18c-2.2-0.1-4.3-0.7-6.1-1.7c-0.1 6.2 4.3 12.1 10.8 13.4c-1.9 0.5-4 0.6-6.1 0.2c1.7 5.3 6.7 9.2 12.6 9.3 c-5.7 4.4-12.8 6.4-19.9 5.6c6 3.8 13 6 20.6 6c25 0 39.1-21.1 38.2-40C131.2 89.4 133.5 87 135.3 84.3z" class="style2"/><path display="none" d="M100 36.8c-35.6 0-64.4 28.8-64.4 64.4c0 35.6 28.9 64.4 64.4 64.4 c35.6 0 64.4-28.8 64.4-64.4C164.4 65.6 135.6 36.8 100 36.8z M100 153.1c-28.7 0-51.9-23.2-51.9-51.9c0-28.7 23.2-51.9 51.9-51.9 c28.7 0 51.9 23.2 51.9 51.9C151.9 129.9 128.7 153.1 100 153.1z M79.2 65.5h4.1l2.8 10.6l2.6-10.6H93l-4.8 15.8v10.8h-4.1V81.3 L79.2 65.5z M92.8 87.2c0 3.5 1.8 5.3 5.3 5.3c2.9 0 5.3-2 5.3-5.3v-9.6c0-3.1-2.3-5.3-5.3-5.3c-3.2 0-5.3 2.1-5.3 5.3V87.2z M96.5 77.9c0-1.1 0.5-1.9 1.5-1.9c1.1 0 1.6 0.8 1.6 1.9V87c0 1.1-0.5 1.9-1.5 1.9c-1 0-1.6-0.8-1.6-1.9V77.9L96.5 77.9z M113.3 72.4v14.9c-0.4 0.6-1.4 1.5-2.1 1.5c-0.8 0-1-0.5-1-1.3V72.4h-3.7v16.4c0 1.9 0.6 3.5 2.6 3.5c1.1 0 2.6-0.6 4.2-2.4v2.2 h3.7V72.4H113.3z M107.9 112.7c0.2 0.3 0.4 0.8 0.4 1.4v9.7c0 0.6-0.1 1-0.3 1.3c-0.4 0.5-1.2 0.5-1.8 0.2 c-0.3-0.1-0.5-0.3-0.8-0.7V113c0.2-0.3 0.5-0.4 0.7-0.6C106.7 112.1 107.5 112.2 107.9 112.7z M119.6 112.3c-1.3 0-1.6 0.9-1.6 2.2 v1.9h3.1v-1.9C121.1 113.2 120.9 112.3 119.6 112.3z M130.2 126.1c0 4.6-3.8 8.4-8.4 8.4H78.8c-4.6 0-8.4-3.8-8.4-8.4v-21.2 c0-4.6 3.8-8.4 8.4-8.4h43.1c4.6 0 8.4 3.8 8.4 8.4V126.1L130.2 126.1z M84.5 106.5h4.1v-3.7h-12v3.7h4.1v21.7h3.9V106.5 L84.5 106.5z M98.4 109.5H95v14.2c-0.4 0.5-1.4 1.4-2 1.4c-0.7 0-0.9-0.5-0.9-1.3v-14.3h-3.5v15.6c0 3.8 2.6 3.8 4.4 2.7 c0.7-0.4 1.4-1 2-1.7v2.1h3.5V109.5z M111.8 113.9c0-2.5-0.8-4.7-3.4-4.7c-1.2 0-2.3 0.8-3.1 1.7v-8.2h-3.5v25.4h3.5v-1.4 c1 1.2 2 1.7 3.3 1.7c2.3 0 3.2-1.8 3.2-4.1V113.9L111.8 113.9z M124.7 114.5c0-3.4-1.6-5.5-5-5.5c-3.1 0-5.3 2.3-5.3 5.5v8.4 c0 3.4 1.7 5.8 5 5.8c3.7 0 5.2-2.2 5.2-5.8v-1.4h-3.6v1.3c0 1.6-0.1 2.6-1.6 2.6c-1.4 0-1.5-1.2-1.5-2.6v-3.5h6.7V114.5 L124.7 114.5z" class="style2"/></g></svg></a>
	
	<a href="https://www.youtube.com/channel/UCybCBHFmyOMMm5WcQ5k6b9A"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 200 200" enable-background="new 0 0 200 200" xml:space="preserve"><g display="none"><rect display="inline" width="35" height="200" class="style0"/><rect x="55" display="inline" width="35" height="200" class="style0"/><rect x="110" display="inline" width="35" height="200" class="style0"/><rect x="165" display="inline" width="35" height="200" class="style0"/><g display="inline"><line x1="200" y1="-100" x2="200" y2="300" class="style1"/><line x1="165" y1="-100" x2="165" y2="300" class="style1"/><line x1="145" y1="-100" x2="145" y2="300" class="style1"/><line x1="110" y1="-100" x2="110" y2="300" class="style1"/><line x1="90" y1="-100" x2="90" y2="300" class="style1"/><line x1="55" y1="-100" x2="55" y2="300" class="style1"/><line x1="35" y1="-100" x2="35" y2="300" class="style1"/><line x1="0" y1="-100" x2="0" y2="300" class="style1"/><line x1="-100" y1="200" x2="300" y2="200" class="style1"/><line x1="-100" y1="0" x2="300" y2="0" class="style1"/></g></g><g><path display="none" d="M99.9 49.3c13.9 0 26.9 5.4 36.8 15.2 c9.8 9.8 15.2 22.9 15.2 36.8c0 13.9-5.4 26.9-15.2 36.8c-9.8 9.8-22.9 15.2-36.8 15.2c-13.9 0-26.9-5.4-36.7-15.2 c-9.8-9.8-15.2-22.9-15.2-36.8c0-13.9 5.4-26.9 15.2-36.8C72.9 54.7 86 49.3 99.9 49.3 M99.9 36.7c-35.6 0-64.5 28.9-64.5 64.5 c0 35.6 28.9 64.5 64.5 64.5c35.6 0 64.5-28.9 64.5-64.5C164.4 65.6 135.5 36.7 99.9 36.7L99.9 36.7z M91 89.4h-7.4v12H91v35.3 h14.2v-35.5h9.9l1-11.9h-10.9c0 0 0-4.4 0-6.8c0-2.8 0.6-3.9 3.3-3.9c2.2 0 7.7 0 7.7 0V66.4c0 0-8.1 0-9.8 0 C95.8 66.4 91 71 91 79.9C91 87.6 91 89.4 91 89.4z" class="style2"/><path display="none" d="M100 49.3c13.9 0 26.9 5.4 36.7 15.2 c9.8 9.8 15.2 22.9 15.2 36.7c0 13.9-5.4 26.9-15.2 36.7c-9.8 9.8-22.9 15.2-36.7 15.2c-13.9 0-26.9-5.4-36.7-15.2 c-9.8-9.8-15.2-22.9-15.2-36.7c0-13.9 5.4-26.9 15.2-36.7C73.1 54.7 86.1 49.3 100 49.3 M100 36.7c-35.6 0-64.5 28.9-64.5 64.5 c0 35.6 28.9 64.5 64.5 64.5c35.6 0 64.5-28.9 64.5-64.5C164.5 65.6 135.6 36.7 100 36.7L100 36.7z M86.7 76.1c0 4-3.2 7.2-7.1 7.2 c-3.9 0-7.1-3.2-7.1-7.2c0-4 3.2-7.2 7.1-7.2C83.5 68.9 86.7 72.1 86.7 76.1z M85.6 88.4h-12v38.9h12V88.4z M104.8 88.4H93.3v38.9 h11.5c0 0 0-14.4 0-20.4c0-5.5 2.5-8.7 7.3-8.7c4.4 0 6.6 3.1 6.6 8.7c0 5.6 0 20.4 0 20.4h12c0 0 0-14.2 0-24.6 c0-10.4-5.9-15.4-14.1-15.4c-8.2 0-11.7 6.4-11.7 6.4L104.8 88.4L104.8 88.4z" class="style2"/><path display="none" d="M100 49.3c28.7 0 51.9 23.2 51.9 51.9c0 28.7-23.2 51.9-51.9 51.9 c-28.7 0-51.9-23.2-51.9-51.9C48.1 72.5 71.3 49.3 100 49.3 M100 36.8c-35.6 0-64.4 28.8-64.4 64.4c0 35.6 28.9 64.4 64.4 64.4 c35.6 0 64.4-28.8 64.4-64.4C164.4 65.6 135.6 36.8 100 36.8L100 36.8z M135.3 84.3c-2.4 1.1-5 1.8-7.7 2.1 c2.8-1.7 4.9-4.3 5.9-7.4c-2.6 1.5-5.5 2.7-8.5 3.3c-2.5-2.6-6-4.3-9.8-4.3c-8.7 0-15.1 8.1-13.1 16.5C90.8 94 80.9 88.6 74.3 80.5 c-3.5 6-1.8 14 4.2 18c-2.2-0.1-4.3-0.7-6.1-1.7c-0.1 6.2 4.3 12.1 10.8 13.4c-1.9 0.5-4 0.6-6.1 0.2c1.7 5.3 6.7 9.2 12.6 9.3 c-5.7 4.4-12.8 6.4-19.9 5.6c6 3.8 13 6 20.6 6c25 0 39.1-21.1 38.2-40C131.2 89.4 133.5 87 135.3 84.3z" class="style2"/><path d="M100 36.8c-35.6 0-64.4 28.8-64.4 64.4c0 35.6 28.9 64.4 64.4 64.4 c35.6 0 64.4-28.8 64.4-64.4C164.4 65.6 135.6 36.8 100 36.8z M100 153.1c-28.7 0-51.9-23.2-51.9-51.9c0-28.7 23.2-51.9 51.9-51.9 c28.7 0 51.9 23.2 51.9 51.9C151.9 129.9 128.7 153.1 100 153.1z M79.2 65.5h4.1l2.8 10.6l2.6-10.6H93l-4.8 15.8v10.8h-4.1V81.3 L79.2 65.5z M92.8 87.2c0 3.5 1.8 5.3 5.3 5.3c2.9 0 5.3-2 5.3-5.3v-9.6c0-3.1-2.3-5.3-5.3-5.3c-3.2 0-5.3 2.1-5.3 5.3V87.2z M96.5 77.9c0-1.1 0.5-1.9 1.5-1.9c1.1 0 1.6 0.8 1.6 1.9V87c0 1.1-0.5 1.9-1.5 1.9c-1 0-1.6-0.8-1.6-1.9V77.9L96.5 77.9z M113.3 72.4v14.9c-0.4 0.6-1.4 1.5-2.1 1.5c-0.8 0-1-0.5-1-1.3V72.4h-3.7v16.4c0 1.9 0.6 3.5 2.6 3.5c1.1 0 2.6-0.6 4.2-2.4v2.2 h3.7V72.4H113.3z M107.9 112.7c0.2 0.3 0.4 0.8 0.4 1.4v9.7c0 0.6-0.1 1-0.3 1.3c-0.4 0.5-1.2 0.5-1.8 0.2 c-0.3-0.1-0.5-0.3-0.8-0.7V113c0.2-0.3 0.5-0.4 0.7-0.6C106.7 112.1 107.5 112.2 107.9 112.7z M119.6 112.3c-1.3 0-1.6 0.9-1.6 2.2 v1.9h3.1v-1.9C121.1 113.2 120.9 112.3 119.6 112.3z M130.2 126.1c0 4.6-3.8 8.4-8.4 8.4H78.8c-4.6 0-8.4-3.8-8.4-8.4v-21.2 c0-4.6 3.8-8.4 8.4-8.4h43.1c4.6 0 8.4 3.8 8.4 8.4V126.1L130.2 126.1z M84.5 106.5h4.1v-3.7h-12v3.7h4.1v21.7h3.9V106.5 L84.5 106.5z M98.4 109.5H95v14.2c-0.4 0.5-1.4 1.4-2 1.4c-0.7 0-0.9-0.5-0.9-1.3v-14.3h-3.5v15.6c0 3.8 2.6 3.8 4.4 2.7 c0.7-0.4 1.4-1 2-1.7v2.1h3.5V109.5z M111.8 113.9c0-2.5-0.8-4.7-3.4-4.7c-1.2 0-2.3 0.8-3.1 1.7v-8.2h-3.5v25.4h3.5v-1.4 c1 1.2 2 1.7 3.3 1.7c2.3 0 3.2-1.8 3.2-4.1V113.9L111.8 113.9z M124.7 114.5c0-3.4-1.6-5.5-5-5.5c-3.1 0-5.3 2.3-5.3 5.5v8.4 c0 3.4 1.7 5.8 5 5.8c3.7 0 5.2-2.2 5.2-5.8v-1.4h-3.6v1.3c0 1.6-0.1 2.6-1.6 2.6c-1.4 0-1.5-1.2-1.5-2.6v-3.5h6.7V114.5 L124.7 114.5z" class="style2"/></g></svg></a>
</div>
    <?php
}



add_action( 'genesis_before','remove_blogpage_content' );

function remove_blogpage_content() {
        remove_action( 'genesis_loop', 'genesis_do_loop' );
}

genesis();