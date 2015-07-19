<?php

/**
* Template Name: Blog Single Page
*
*/



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

    <article class="article__main single">
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); 

    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id,'large', true);

?>
        <h2><?php the_title(); ?></h2>
        <div class="article__info">
            <time datetime=""><?php the_date('M d, Y'); ?></time>
            <span class="article__author">By: <?php the_author(); ?></span>
        </div>
        <figure class="article__graphic">
            <img src="<?php echo $image_url[0]; ?>" alt="">
        </figure>
        <?php the_content(); ?>
        
        <hr>
        <div class="article__more article post--full">
            <div class="article__sharing">
            <h3>Share This Article:</h3>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5137f0cf11509f3c" async="async"></script>

                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_sharing_toolbox"></div>
            </div>
            <span class="article__categories">(Category: 

                <?php
                $categories = get_the_category();
                $separator = ', ';
                $output = '';
                if($categories){
                    foreach($categories as $category) {
                        $output .= '<a href="'.get_category_link( $category->term_id ).'"">'.$category->cat_name.'</a>'.$separator;
                    }
                echo trim($output, $separator);
                }
                ?>
                )
            </span>
        </div>
<?php
endwhile;

?>

        <div class="article__pagination">
            <?php previous_posts_link('Previous'); ?>
            <?php next_posts_link('Next'); ?>
        </div>


    </article>
<?php endif; ?>
</section>
    <?php
}



add_action( 'genesis_before','remove_blogpage_content' );

function remove_blogpage_content() {
        remove_action( 'genesis_loop', 'genesis_do_loop' );
}

genesis();