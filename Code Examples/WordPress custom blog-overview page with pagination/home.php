<?php

// Id of the post which should be excluded from WordPress query
$excluded_post_id = 15;

// Take global $wp_query var
global $wp_query;

// Creating custom WordPress query and rewriting existing global $wp_query variable with custom one
$wp_query = new WP_Query( [

    'post_type'     => 'post',                      // Select only posts with type 'post'
    'orderby'       => 'date',                      // Order posts by date
    'order'         => 'DESC',                      // Show new posts first
    'post__not_in'  => [ $excluded_post_id ],       // Exclude post with selected id from custom query
    'paged'         => get_query_var( 'paged' ),    // Set current pagination page

] );

?>

<?php // If current query has any posts ?>
<?php if ( have_posts() ) : ?>

<section>

    <?php // Loop through them ?>
    <?php while (have_posts()) : the_post(); ?>

    <div>

        <?php // Show post thumbnail only if it has one ?>
        <?php if ( has_post_thumbnail() ) : ?>

        <div>
            <img loading="lazy" src="<?php the_post_thumbnail_url(); ?>" alt="">
        </div>

        <?php endif; ?>

        <?php // Show other post data like publish date, title, excerpt and 'Read more' button ?>
        <div class="p-6 pb-8 xl:p-10 xl:pt-6">
            <div><?php the_date( 'M d, Y' ); ?></div>
            <h4><?php the_title(); ?></h4>
            <p ><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>">Read now</a>
        </div>

    </div>

    <?php endwhile; ?>

    <?php // Output bottom pagination ?>
    <?php
    $args = array(
        'show_all'     => false,    // Show all pages in pagination
        'end_size'     => 1,        // Number of pages at the ends
        'mid_size'     => 2,        // Number of pages around selected
        'prev_next'    => false,    // Show buttons 'Next', 'Previous'
    );
    ?>

    <?php // Output automatically generated pagination links based on $args array ?>
    <?php the_posts_pagination($args); ?>

</section>

<?php endif;
