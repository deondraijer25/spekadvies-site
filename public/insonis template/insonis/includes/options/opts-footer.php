<?php
Redux::setSection( $opt_name, array(
  	'title' => esc_html__('Footer Options', 'insonis'),
  	'icon' => 'el-icon-compass',
  	'fields' => array(
	 	array(
			'id' 			=> 'copyright_default',
			'type' 		=> 'button_set',
			'title' 		=> esc_html__('Enable/Disable Copyright Text', 'insonis'),
			'options' 	=> array(
				'yes' 	=> esc_html__('Enable', 'insonis'),
				'no' 		=> esc_html__('Disable', 'insonis')
			),
			'default' 	=> 'yes'
	 	),
	 	array(
			'id' 			=> 'copyright_text',
			'type' 		=> 'editor',
			'title' 		=> esc_html__('Footer Copyright Text', 'insonis'),
			'default' 	=> esc_html__('Copyright - 2026 - All rights reserved. Powered by WordPress.', 'insonis')
	 	),
  	)
));