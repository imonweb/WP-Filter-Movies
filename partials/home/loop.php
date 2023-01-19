<?php
  $args = array(
    'post_type' => 'movie',
    'posts_per_page' => -1,
    'order' => 'ASC'
  );

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
endif; wp_reset_postdata(); 
