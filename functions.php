<?php

require_once('inc/scripts.php');
require_once('inc/styles.php');
require_once('inc/ajax/filter.php');


require_once('inc/post-types/_post-type-includes.php');
require_once('inc/taxonomies/_taxonomies-includes.php');

// include option tree
add_filter('ot_theme_mode','__return_true');
add_filter('ot_show_pages','__return_false');
add_filter('ot_child_theme_mode','__return_false');
require_once('plugins/option-tree/ot-loader.php');
require_once('inc/options/_option-includes.php');

require_once('inc/general-functions.php');

 