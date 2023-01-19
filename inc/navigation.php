<?php

// Register Navigation Menus
function rc_navigation_menus() {
    $locations = array(
        'navmain' => __( 'Main Navigation', 'text_domain' ),
    );
    register_nav_menus( $locations );
}

// Hook into the 'init' action
add_action( 'init', 'rc_navigation_menus' );
