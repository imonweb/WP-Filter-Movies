<?php

// 1st line
add_filter('mce_buttons','remove_tiny_mce_buttons_from_editor');
function remove_tiny_mce_buttons_from_editor($buttons){
    $remove_buttons = array(
				'formatselect',
        //'bold',
        //'italic',
        //'bullist',
        //'numlist',
        'blockquote',
        'alignleft',
        'aligncenter',
        'alignright',
        //'link',
        //'unlink',
        'wp_more',
        //'spellchecker',
        //'dfw', // distraction free writing mode
        'wp_adv', // kitchen sink toggle (if removed, kitchen sink will always display)
    );
    foreach($buttons as $button_key => $button_value){
        if(in_array($button_value,$remove_buttons)){
            unset($buttons[$button_key]);
        }
    }
		array_unshift($buttons, 'styleselect');
    return $buttons;
}

// 2nd line
add_filter('mce_buttons_2','remove_tiny_mce_buttons_from_kitchen_sink');
function remove_tiny_mce_buttons_from_kitchen_sink($buttons){
    $remove_buttons = array(
        'strikethrough',
        'hr',
        //'formatselect',
        //'underline',
        //'alignjustify',
        // 'forecolor',
        //'pastetext', // paste as text
        //'removeformat', // clear formatting
        'charmap',
        'outdent',
        'indent',
        // 'undo',
        // 'redo',
        'wp_help',
    );
    foreach($buttons as $button_key => $button_value){
        if(in_array($button_value, $remove_buttons)){
            unset($buttons[$button_key]);
        }
    }
    return $buttons;
}

// Add custom classes for headings
function rc_mce_before_init($settings) {
	$style_formats = array(
		array(
			'title' => 'Text',
			'items' => array(
				array(
					'title' => 'H1',
					'block' => 'p',
					'classes' => 'data-css-font1'
				),
				array(
					'title' => 'H2',
					'block' => 'p',
					'classes' => 'data-css-font2'
				),
				array(
					'title' => 'H3',
					'block' => 'p',
					'classes' => 'data-css-font3'
				),
				array(
					'title' => 'H4',
					'block' => 'p',
					'classes' => 'data-css-font4'
				),
				array(
					'title' => 'H5',
					'block' => 'p',
					'classes' => 'data-css-font5'
				),
				array(
					'title' => 'H6',
					'block' => 'p',
					'classes' => 'data-css-font6'
				),
				array(
					'title' => 'Paragraph',
					'block' => 'p',
					'classes' => 'data-css-font'
				)
			)			
		)
	);

	$settings['style_formats'] = json_encode($style_formats);
	$settings['style_formats_merge'] = false;

	return $settings;
}
add_filter('tiny_mce_before_init', 'rc_mce_before_init');
