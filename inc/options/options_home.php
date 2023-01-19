<?php
// options for homepage template
add_action('admin_init','homepage_meta_boxes');
function homepage_meta_boxes() {
	$example_fields = array(
		'id'          => 'homepagepage_data_box',
		'title'       => 'Movie custom data',
		'desc'        => '',
		'pages'       => array('movie'),
		'context'     => 'normal',
		'priority'    => 'default',
		'fields'      => array(
			array(
				'id'          => 'rating',
				'label'       => 'Rating',
				'type'        => 'text',
				'desc'        => 'e.g. 15',
				'std'         => '',
			),
			array(
				'id'          => 'runtime',
				'label'       => 'Runtime',
				'desc'        => 'e.g. 149 min',
				'type'        => 'text',
				'std'         => '',
			),
			array(
				'id'          => 'year',
				'label'       => 'Year',
				'desc'        => 'e.g. 2019',
				'type'        => 'text',
				'std'         => '',
			),
			array(
				'id'          => 'score',
				'label'       => 'Score',
				'desc'        => 'e.g. 9.5',
				'type'        => 'text',
				'std'         => '',
			)
		)
	);
	
	ot_register_meta_box($example_fields);

}
?>
