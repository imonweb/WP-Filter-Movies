<?php

/* -------------------
/  dissable all emotes
/  ------------------- */
function disable_wp_emojicons()
{
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
}
add_action('init', 'disable_wp_emojicons');

/* -------------------------------
/ add theme support for thumbnails
/  ------------------------------- */
add_theme_support(
	'post-thumbnails',
	array(
		'post',
		'page',
		'movie'
	)
);

/* ------------------
/  dissable admin bar
/  ------------------ */
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
	show_admin_bar(false);
}

/* --------------------------
/  dissable gutenburg editor
/  -------------------------- */
add_filter('use_block_editor_for_post', '__return_false');

/* ---------------------
/  hide admin menu items
/  --------------------- */
function remove_menus()
{
	//remove_menu_page( 'index.php' );                  //Dashboard
	//remove_menu_page( 'edit.php' );                   //Posts
	//remove_menu_page( 'edit.php?post_type=page' );    //Pages
	//remove_menu_page( 'upload.php' );                 //Media
	//remove_menu_page( 'edit-comments.php' );          //Comments
	//remove_menu_page( 'themes.php' );                 //Appearance
	//remove_menu_page( 'plugins.php' );                //Plugins
	//remove_menu_page( 'tools.php' );                  //Tools
	//remove_menu_page( 'options-general.php' );        //Settings
}
add_action('admin_menu', 'remove_menus', 100);

/* ------------------------
/  allow uploading of svg's
/  ------------------------ */
function svg_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'svg_mime_types');

/* --------------------------
/  show svg's in medialibrary
/  -------------------------- */
function rc_svg_enqueue_scripts($hook)
{
	wp_enqueue_style('rc-svg-style', get_theme_file_uri('/assets/admin/svg.css'));
	wp_enqueue_script('rc-svg-script', get_theme_file_uri('/assets/admin/svg.js'), 'jquery');
	wp_localize_script(
		'rc-svg-script',
		'script_vars',
		array('AJAXurl' => admin_url('admin-ajax.php'))
	);
}
add_action('admin_enqueue_scripts', 'rc_svg_enqueue_scripts');
function rc_get_attachment_url_media_library()
{
	$url          = '';
	$attachmentID = isset($_REQUEST['attachmentID']) ? $_REQUEST['attachmentID'] : '';
	if ($attachmentID) {
		$url = wp_get_attachment_url($attachmentID);
	}
	echo $url;
	die();
}
add_action('wp_ajax_svg_get_attachment_url', 'rc_get_attachment_url_media_library');

/* -------------------------------------------
/ remove wordpress and comments from admin bar
/  ------------------------------------------- */
function rc_admin_bar_render()
{
	global $wp_admin_bar;
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'rc_admin_bar_render');

/* ------------------------------
/  remove default gallery styling
/  ------------------------------ */
add_filter('use_default_gallery_style', '__return_false');

/* ---------------------------
/  remove hellip from exceprts
/  --------------------------- */
function new_excerpt_more($more)
{
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* --------------------
/  move Yoast to bottom
/  -------------------- */
function yoast_to_bottom()
{
	return 'low';
}
add_filter('wpseo_metabox_prio', 'yoast_to_bottom');

/* ----------------------
/  Remove p tags from cf7
/  ---------------------- */
add_filter('wpcf7_autop_or_not', '__return_false');

/* ---------------------------------------
/  let wordpress manage the document title
/  --------------------------------------- */
add_theme_support('title-tag');
