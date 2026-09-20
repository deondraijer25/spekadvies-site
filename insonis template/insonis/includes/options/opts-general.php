<?php
Redux::setSection( $opt_name, array(
	'title' => esc_html__('General Options', 'insonis'),
	'icon' => 'el-icon-wrench',
	'fields' => array(
		array(
			'id'           => 'page_layout',
			'type'         => 'button_set',
			'title'        => esc_html__('Page Layout', 'insonis'),
			'subtitle'     => esc_html__('Select the page layout type', 'insonis'),
			'options'      => array(
				'boxed'     => esc_html__('Boxed', 'insonis'),
				'fullwidth' => esc_html__('Fullwidth', 'insonis')
			),
			'default' => 'fullwidth'
		),
      array(
        'id' => 'map_api_key',
        'type' => 'text',
        'title' => esc_html__('Google Map API key', 'insonis'),
        'default' => ''
      ),

      // Logo Default Settings
      array(
         'id'     => 'logo_default',
         'type'   => 'info',
         'icon'   => true,
         'raw'    => '<h3 class="margin-bottom-0">' . esc_html__('Logo Default', 'insonis') . '</h3>',
      ),
      array(
        'id'      => 'header_logo', 
        'type'    => 'media',
        'url'     => true,
        'title'   => esc_html__('Logo in header default', 'insonis'), 
        'default' => ''
      ), 
         
		// Breadcrumb Default Settings
		array(
         'id'     => 'breadcrumb_default',
         'type'   => 'info',
         'icon'   => true,
         'raw'    => '<h3 class="margin-bottom-0">' . esc_html__('Breadcrumb Settings Without Elementor', 'insonis') . '</h3>',
      ),
		array(
         'id'        => 'breadcrumb_title',
         'type'      => 'button_set',
         'title'     => esc_html__('Breadcrumb Title', 'insonis'),
         'options'   => array(
            1 => esc_html__('Enable', 'insonis'),
            0 => esc_html__('Disable', 'insonis')
         ),
         'default'   => 1
      ),
      array(
         'id'        => 'breadcrumb_bg_color',
         'type'      => 'color',
         'title'     => esc_html__('Background Overlay Color', 'insonis'),
         'default'   => ''
      ),
      array(
         'id'        => 'breadcrumb_bg_opacity',
         'type'      => 'slider',
         'title'     => esc_html__('Breadcrumb Ovelay Color Opacity', 'insonis'),
         'default'   => 50,
         'min'       => 0,
         'max'       => 100,
         'step'      => 2,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'breadcrumb_bg_image',
         'type'      => 'media',
         'url'       => true,
         'title'     => esc_html__('Breadcrumb Background Image', 'insonis'),
         'default'   => '',
      ),
      array(
         'id'        => 'breadcrumb_text_stype',
         'type'      => 'select',
         'title'     => esc_html__('Breadcrumb Text Stype', 'insonis'),
         'options'   => 
         array(
            'text-light'     => esc_html__('Light', 'insonis'),
            'text-dark'      => esc_html__('Dark', 'insonis')
         ),
         'default' => 'text-light'
      ),
	)
));