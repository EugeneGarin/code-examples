<?php
// Add custom pagination wrapper
add_filter('navigation_markup_template', 'my_navigation_template', 10 );
function my_navigation_template(){

    $previous_post_is_available = get_previous_posts_link() !== null;
    $next_post_is_available = get_next_posts_link() !== null;

	return '
    <div class="navigation %1$s">

        <a href="' . ( $previous_post_is_available ? get_previous_posts_page_link() : '#' ) . '">
            <span class="pagination-previous"><img loading="lazy" class="' . ( $previous_post_is_available ? '' : 'opacity-30' ) . '" src="'. get_stylesheet_directory_uri() . '/assets/images/arrow-left-glyph.svg' . '" alt=""></span>
        </a>

        <div class="nav-links">%3$s</div>

        <a href="' . ( $next_post_is_available ? get_next_posts_page_link() : '#' ) . '">
            <span class="pagination-next"><img loading="lazy" class="' . ( $next_post_is_available ? '' : 'opacity-30' ) . '" src="'. get_stylesheet_directory_uri() . '/assets/images/arrow-right-glyph.svg' . '" alt=""></span>
        </a>

    </div>
	';

}
