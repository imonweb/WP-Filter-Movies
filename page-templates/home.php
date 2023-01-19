<?php

/**
 * Template Name: Home Page
 *
 */

get_header();

    while (have_posts()) :

    the_post(); ?>

        <div data-css-flex="container">
            <div data-css-flex="row-col">
            <?php 
                get_template_part('partials/home/sidebar');
                get_template_part('partials/home/content');
            ?>
            </div>
        </div>
    <?php 
    endwhile;

get_footer();
