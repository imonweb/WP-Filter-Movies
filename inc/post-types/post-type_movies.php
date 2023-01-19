<?php

function create_movie_posttype(){
	$args = array(
		'label' => 'Movie',
		'labels' => array(
			'name' => __('Movie'),
			'singular_name' => __('Movie'),
			'add_new' => __('Add New'),
			'add_new_item' => __('Add New Movie'),
			'edit_item' => __('Edit Movie'),
			'new_item' => __('New Movie'),
			'view_item' => __('View Movie'),
			'search_items' => __('Search Movies'),
			'not_found' => __('No Movies found'),
			'not_found_in_trash' => __('No Movies found in trash'),
			'all_items' => __('All Movies'),
			'archives' => __('Movie Archives'),
			'insert_into_item' => __('Insert into Movie'),
			'uploaded_to_this_item' => __('Uploaded to this Movie'),
			'featured_image' => __('Movie Image'),
			'set_featured_image' => __('Set Movie Image'),
			'remove_featured_image' => __('Remove Movie Image'),
			'use_featured_image' => __('Use Movie Image'),
			'menu_name' => __('Movies')
		),
		'description' => __('Post type to contain content for Movies.'),
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 18,
		'menu_icon' => 'dashicons-tickets-alt',
		'supports' => array('title','editor','author','thumbnail','excerpt','revisions','page-attributes'),
		'has_archive' => false,
		'hierarchical' => false,
		'rewrite' => array('slug'=>'movie','with_front'=>false),
		'capabilities' => array(
			'edit_post'          => 'update_core',
			'read_post'          => 'update_core',
			'delete_post'        => 'update_core',
			'edit_posts'         => 'update_core',
			'edit_others_posts'  => 'update_core',
			'delete_posts'       => 'update_core',
			'publish_posts'      => 'update_core',
			'read_private_posts' => 'update_core'
		),
	);
	register_post_type('movie',$args);
}
add_action('init','create_movie_posttype',0);
