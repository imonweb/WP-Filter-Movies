<?php

function register_taxonomy_keywords() {
    $labels = [
        'name'              => _x('Keywords', 'taxonomy general name'),
        'singular_name'     => _x('Keyword', 'taxonomy singular name'),
        'search_items'      => __('Search Keywords'),
        'all_items'         => __('All Keywords'),
        'parent_item'       => __('Parent Keyword'),
        'parent_item_colon' => __('Parent Keyword:'),
        'edit_item'         => __('Edit Keyword'),
        'update_item'       => __('Update Keyword'),
        'add_new_item'      => __('Add New Keyword'),
        'new_item_name'     => __('New Keyword Name'),
        'menu_name'         => __('Keyword'),
        ];
        $args = [
        'hierarchical'      => false, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'keyword'],
        ];
        register_taxonomy('keyword', ['movie'], $args);
}
add_action('init', 'register_taxonomy_keywords');