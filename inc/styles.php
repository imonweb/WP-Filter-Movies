<?php
/*
 * Stop Contact Form 7 css loading globally
 */

add_filter('wpcf7_load_css', '__return_false');


/*
* Enqueue vendor styles if they exist
*/

function rm_load_vendor_styles() {
	$styles = array();

	// Stylesheet name and Path to check.
	$temp_array['styleName'] = 'vendor';
	$temp_array['stylePath'] =  '/assets/css/vendor/vendor.min.css';
	$styles[] = $temp_array;
	unset($temp_array);

	// loop through styles
	foreach($styles as $style){

	// Get path + url to file.
		$file_path = get_template_directory().$style['stylePath'];
		$file_url  = get_template_directory_uri().$style['stylePath'];

		if(file_exists($file_path)){
			wp_enqueue_style($style['styleName'],$file_url,array(),filemtime($file_path));
		}

	}
}
add_action( 'get_footer', 'rm_load_vendor_styles' );


/*
* Enqueue stylesheets if they exist
*/
function rm_load_styles() {
	$styles = array();

	// Stylesheet name and Path to check.
	$temp_array['styleName'] = 'style';
	$temp_array['stylePath'] =  '/assets/css/style.min.css';
	$styles[] = $temp_array;
	unset($temp_array);

	// loop through styles
	foreach($styles as $style){

	// Get path + url to file.
		$file_path = get_template_directory().$style['stylePath'];
		$file_url  = get_template_directory_uri().$style['stylePath'];

		if(file_exists($file_path)){
			wp_enqueue_style($style['styleName'],$file_url,array(),filemtime($file_path));
		}

	}
}
add_action('wp_enqueue_scripts','rm_load_styles');


/*
* Enqueue admin editor stylesheet
*/
add_action('init','rc_add_editor_styles' );
function rc_add_editor_styles() {
	$file_path = 'assets/css/editor-style.min.css';
	if(file_exists(get_template_directory().'/'.$file_path)){
		add_editor_style($file_path);
	}
}


/*
* Enqueue Google fonts if exists
*/
function rm_load_google_fonts() {
	wp_register_style('sen', 'https://fonts.googleapis.com/css?family=Sen:400,700&display=swap', array(), '1.0.0', 'all');

	wp_enqueue_style('sen');
}

add_action( 'get_footer', 'rm_load_google_fonts' );
