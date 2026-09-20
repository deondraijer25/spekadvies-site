<?php
function insonis_register_meta_boxes(){
	$prefix = 'insonis_';
	global $meta_boxes;
	$meta_boxes = array();

	/* ====== Metabox Template ====== */
	$meta_boxes[] = array(
		'id'    => 'gavias_metaboxes_page',
		'title' => esc_html__('Page Meta', 'insonis'),
		'pages' => array( 'gva__template'),
		'priority'   => 'high',
		'fields' => array(
			array(
				'name' => esc_html__('Template Type', 'insonis'),
				'id'   => "gva_template_type",
				'type' => 'text'
			),
		)
	);

	/* ====== Metabox Page ====== */
	$meta_boxes[] = array(
		'id'    => 'gavias_metaboxes_page',
		'title' => esc_html__('Page Meta', 'insonis'),
		'pages' => array( 'page'),
		'priority'   => 'high',
		'fields' => array(
			array(
            'name' => esc_html__('Full Width', 'insonis'),
            'id'   => "{$prefix}page_full_width",
            'type' => 'switch',
            'desc' => esc_html__('Turn on to have the main area display at 100% width according to the window size. Turn off to follow site width.', 'insonis'),
            'std' => 0,
         ),
			array(
				'name' => esc_html__('Header Layout', 'insonis'),
				'id'   => "{$prefix}header_layout",
				'type' => 'select',
				'options' => insonis_list_header_layout(),
				'multiple' => false,
				'std'  => '_default_active',
			),
			array(
				'name' => esc_html__('Footer Layout', 'insonis'),
				'id'   => "{$prefix}footer_layout",
				'type' => 'select',
				'options' => insonis_list_footer_layout(),
				'multiple' => false,
				'std'  => '_default_active',
			),
			array(
				'name' => esc_html__('Extra page class', 'insonis'),
				'id' => $prefix . 'extra_page_class',
				'desc' => esc_html__("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", 'insonis'),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
		)
	);

	/* ====== Metabox Page Title ====== */
	$meta_boxes[] = array(
		'id' => 'gavias_metaboxes_page_heading',
		'title' => esc_html__('Page Title & Breadcrumb', 'insonis'),
		'pages' => array( 'post', 'page', 'product', 'portfolio', 'tribe_events'),
		'context' => 'normal',
		'priority'   => 'high',
		'fields' => array(
		  	array(
				'name' => esc_html__('Remove Title of Page', 'insonis'),   
				'id'   => "{$prefix}disable_page_title",
				'type' => 'switch',
				'std'  => 0,
		  	),
		  	array(
			 	'name' => esc_html__('Disable Breadcrumbs', 'insonis'),
			 	'id'   => "{$prefix}no_breadcrumbs",
			 	'type' => 'switch',
			 	'desc' => esc_html__('Disable the breadcrumbs from under the page title on this page.', 'insonis'),
			 	'std' => 0,
		  	),
		  	array(
			 	'name' => esc_html__('Breadcrumb Layout', 'insonis'),
			 	'id'   => "{$prefix}breadcrumb_layout",
			 	'type' => 'select',
			 	'options' => array(
				 	'layout_options'    => esc_html__('Default Options in Layout Template', 'insonis'),
				 	'page_options'      => esc_html__('Individuals Options This Page', 'insonis')
			 	),
			 	'multiple' => false,
			 	'std'  => 'theme_options',
			 	'desc' => esc_html__('You can use breadcrumb settings default in Layout Template or individuals this page', 'insonis')
		  	),
		  	array(
			 	'name' 	=> esc_html__( 'Background Overlay Color', 'insonis' ),
			 	'id'   	=> "{$prefix}insonis_breacrumb_bg_color",
			 	'desc' 	=> esc_html__( "Set an overlay color for hero heading image.", 'insonis' ),
			 	'type' 	=> 'color',
			 	'class' => 'breadcrumb_setting',
			 	'std'  	=> '',
		  	),
		  	array(
			 	'name'       => esc_html__( 'Overlay Opacity', 'insonis' ),
			 	'id'         => "{$prefix}breacrumb_bg_opacity",
			 	'desc'       => esc_html__( 'Set the opacity level of the overlay. This will lighten or darken the image depening on the color selected.', 'insonis' ),
			 	'clone'      => false,
			 	'type'       => 'slider',
			 	'prefix'     => '',
			 	'class'   	  => 'breadcrumb_setting',
			 	'js_options' => array(
				  	'min'  => 0,
				  	'max'  => 100,
				  	'step' => 1,
			 	),
			 	'std'   => '50'
		  	),
		  	array(
			 	'name'  	=> esc_html__('Breadcrumb Background Image', 'insonis'),
			 	'id'    	=> "{$prefix}insonis_breacrumb_image",
			 	'type'  	=> 'image_advanced',
			 	'class'   	=> 'breadcrumb_setting',
			 	'max_file_uploads' => 1
		  	),
		)
	);

	$meta_boxes[] = array(
    	'id'    		=> 'metaboxes_give_forms',
    	'title' 		=> esc_html__('Give Forms Settings', 'insonis'),
    	'pages' 		=> array( 'give_forms' ),
    	'priority' 	=> 'high',
    	'fields' 	=> array(
	     	array (
	        	'name'   => esc_html__('Gallery Images', 'insonis'),
	        	'id'    	=> "{$prefix}give_gallery_images",
	        	'type'             => 'image_advanced',
	        	'max_file_uploads' => 50,
	      ),
	      array(
	        	'name' => esc_html__('Video URL', 'insonis'),
	        	'id' 	 => $prefix . 'give_video_url',
	        	'type' => 'text'
	      ),
	      array(
	        	'name' => esc_html__('Featured', 'insonis'),   
	        	'id'   => "{$prefix}give_featured",
	        	'type' => 'checkbox',
	        	'std'  => 0,
	      ),
	      array(
			 	'name' 	=> esc_html__( 'Color', 'insonis' ),
			 	'id'   	=> "{$prefix}give_color",
			 	'type' 	=> 'color'
		  	),
		  	array(
				'name' => esc_html__('Layout Page', 'insonis'),
				'id'   => "{$prefix}template_layout",
				'type' => 'select',
				'options' => insonis_get_donation_layout(),
				'multiple' => false,
				'std'  => '_default_active',
			),
    	)
  	);

	return $meta_boxes;
 }  
  /********************* META BOX REGISTERING ***********************/
  add_filter( 'rwmb_meta_boxes', 'insonis_register_meta_boxes' , 99 );

