<?php
add_action('init','custom_theme_options');
function custom_theme_options() {
	if(!function_exists( 'ot_settings_id' ) || !is_admin())
		return false;
	$saved_settings = get_option(ot_settings_id(),array());
	$custom_settings = array(
		'sections' => array(
			array(
				'id'          => 'ot_site_settings',
				'title'       => __('Site settings','option-tree-theme')
			),
		),
		'settings' => array(
			// site settings
			array(
				'id'        => 'logo',
				'label'     => __('Company Logo','option-tree-theme'),
				'type'		=> 'upload',
				'class'		=> 'ot-upload-attachment-id',
				'section'	=> 'ot_site_settings'
			),
		)
	);
	$custom_settings = apply_filters( ot_settings_id().'_args',$custom_settings);
	if($saved_settings !== $custom_settings){
		update_option(ot_settings_id(),$custom_settings);
	}
	global $ot_has_custom_theme_options;
	$ot_has_custom_theme_options = true;
}
