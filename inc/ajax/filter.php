<?php

add_action( 'wp_ajax_nopriv_filter', 'filter_ajax' );
add_action( 'wp_ajax_filter', 'filter_ajax' );

function filter_ajax() {

  // print_r($_POST);

  $movie_title = $_POST['movie-title'];
  $movie_genre = $_POST['movie-genre'];
  $movie_keywords = $_POST['movie-keywords'];
  $movie_order = $_POST['movie-order'];

  $args = array(
    'post_type' => 'movie',
    'posts_per_page' => -1,
    'order' => 'ASC'
  );

  /*  For the search bar */
  if(!empty($movie_title)){
    $args['s']  = $movie_title;
  }

  /*  genres dropdown */
  if(!empty($movie_genre)){
    $args['tax_query'] = array(
      array(
        'taxonomy'    =>  'genre',
        'field'       =>  'term_id',
        'terms'       =>  'array($movie_genre)'
      )
    );
  }

  $query = new WP_Query($args);

  if($query->have_posts()) : 
    
    $counter = 0;
    
    while($query->have_posts()) : $counter++; $query->the_post();

    $movie_id = get_the_ID();
  
    $url = get_the_permalink();
    $title = get_the_title();
    $thumb = get_the_post_thumbnail_url();
    $excerpt = get_the_excerpt();
    $year = get_post_meta($movie_id,'year',true);
    $rating = get_post_meta($movie_id,'rating',true);
    $runtime = get_post_meta($movie_id,'runtime',true);
    $score = get_post_meta($movie_id,'score',true);

    $taxonomy = 'genre';
 
    // Get the term IDs assigned to post.
    $post_terms = wp_get_object_terms( $movie_id, $taxonomy, array( 'fields' => 'ids' ) );
    
    // Separator between links.
    $separator = ', ';
    
    if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
    
        $term_ids = implode( ',' , $post_terms );
    
        $terms = wp_list_categories( array(
            'title_li' => '',
            'style'    => 'none',
            'echo'     => false,
            'taxonomy' => $taxonomy,
            'include'  => $term_ids
        ) );
    
        $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
    }

?>
    <article data-css-card="movie-card">
      <div data-css-card="movie-wrapper">
        <div data-css-card="movie-thumbnail">
          <img src="<?= $thumb; ?>" alt="Avengers: Infinity War" />
        </div>
        <div data-css-card="movie-summary">
          <h2 class="title"><span class="number"><?= $counter; ?>. </span><a href="<?= $url;?>"><?= $title; ?></a> <span class="date">(<?= $year; ?>)</span></h2>
          <div data-css-card="movie-meta">
            <span class="rating"><?= $rating; ?></span> 
            <span class="runtime"><?= $runtime; ?></span> 
            <div class="categories">
              <?= $terms; ?>
            </div>
          </div>
          <p data-css-card="movie-score"><span class="score"><?= $score; ?></span></p>
          <?= $excerpt; ?>
        </div>
      </div>
    </article>
    <?php endwhile;
    else :?>
    <article data-css-card="movie-card">
      <p>No movies found.</p>
    </article>
    
    <?php endif; ?>
 
    <?php //wp_direct_php_update_button(  )

    wp_reset_postdata(); 

    ?>
      
    <?php 


  die();
}
