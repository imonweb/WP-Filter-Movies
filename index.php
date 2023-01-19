<?php
get_header();

if ( have_posts() ) : 
    
    while ( have_posts() ) : the_post();
    /**
    *
    * Include your partials here eg
    * get_template_part( 'partials/news-loop' );
    *
    */
    endwhile;

endif;

get_footer();
