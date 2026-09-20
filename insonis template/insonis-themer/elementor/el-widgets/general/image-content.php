<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Image_Content extends GVAElement_Base {
	const NAME = 'gva-image-content';
	const TEMPLATE = 'general/image-content';
	const CATEGORY = 'insonis_general';

   public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __( 'Image Content', 'insonis-themer' );
	}
	
	public function get_keywords() {
		return [ 'image', 'content' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'insonis-themer' ),
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'insonis-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'skin-v1' => esc_html__('Style 01', 'insonis-themer'),
					'skin-v2' => esc_html__('Style 02', 'insonis-themer'),
					'skin-v3' => esc_html__('Style 03', 'insonis-themer'),
					'skin-v4' => esc_html__('Style 04', 'insonis-themer'),
					'skin-v5' => esc_html__('Style 05', 'insonis-themer'),
					'skin-v6' => esc_html__('Style 06', 'insonis-themer'),
					'skin-v7' => esc_html__('Style 07', 'insonis-themer')
				],
				'default' => 'skin-v1',
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'insonis-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'insonis-themer' ),
				'default' => __( 'Insurance', 'insonis-themer' ),
				'label_block' => true,
				'condition' => [
					'style' => ['skin-v1', 'skin-v2','skin-v3', 'skin-v4', 'skin-v5', 'skin-v6']
				],
			]
		);
		$this->add_control(
			'description_text',
			[
				'label' => __( 'Description', 'insonis-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Your Description', 'insonis-themer' ),
				'condition' => [
					'style' => [ 'skin-v2', 'skin-v4', 'skin-v5'],
				],
			]
		);
		
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'insonis-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_INSONIS_PLUGIN_URL . 'elementor/assets/images/image-1.jpg',
				],
			]
		);

		$this->add_control(
			'image_second',
			[
				'label' => __( 'Choose Image Second', 'insonis-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_INSONIS_PLUGIN_URL . 'elementor/assets/images/image-2.jpg',
				],
				'condition' => [
					'style' => ['skin-v2', 'skin-v4']
				],
			]
		);

		$this->add_control(
			'image_three',
			[
				'label' => __( 'Choose Logo', 'insonis-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => false,
				'default' => [
					'url' => GAVIAS_INSONIS_PLUGIN_URL . 'elementor/assets/images/policy.png',
				],
				'condition' => [
					'style' => ['skin-v2', 'skin-v7']
				],
			]
		);

		$this->add_group_control(
         Elementor\Group_Control_Image_Size::get_type(),
         [
            'name'      => 'image',
            'default'   => 'full',
            'separator' => 'none',
	         'condition' => [
					'style' => ['skin-v1'],
				]
         ]
      );

		$this->add_responsive_control(
			'content_height',
			[
				'label' => __( 'Height', 'insonis-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 250,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .about-one__image, 
					{{WRAPPER}} .about-two__image, {{WRAPPER}} .about-five__image, 
					{{WRAPPER}} .about-three__image, {{WRAPPER}} .about-six__image' => 'min-height: {{SIZE}}{{UNIT}};'
				],  
				'condition' => [
					'style' => ['skin-v1', 'skin-v2', 'skin-v3', 'skin-v5', 'skin-v6']
				]
			]
		);

		$this->add_control(
			'header_tag',
			[
				'label' => __( 'HTML Tag', 'insonis-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
				'condition' => [
					'style' => ['skin-v1', 'skin-v4']
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'insonis-themer' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'insonis-themer' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'link_text',
			[
				'label' => __( 'Text Link', 'insonis-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Read More', 'insonis-themer' ),
				'default' => __( 'Read More', 'insonis-themer' ),
				'condition' => [
					'style' => [''],
				],
			]
		);

		$this->end_controls_section();

		// Title Style
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'insonis-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['skin-v1', 'skin-v2', 'skin-v4', 'skin-v5'],
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .about-one__title, {{WRAPPER}} .about-two__title, {{WRAPPER}} .about-four__title, {{WRAPPER}} .about-five__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{WRAPPER}} .about-one__title, {{WRAPPER}} .about-two__title, {{WRAPPER}} .about-four__title, {{WRAPPER}} .about-five__title',
			]
		);

		$this->end_controls_section();

		// Description Style
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Description', 'insonis-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['skin-v1', 'skin-v2', 'skin-v4', 'skin-v5'],
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-one__desc, {{WRAPPER}} .about-two__desc, {{WRAPPER}} .about-four__desc, {{WRAPPER}} .about-five__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .about-one__desc, {{WRAPPER}} .about-two__desc, {{WRAPPER}} .about-four__desc, {{WRAPPER}} .about-five__desc',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
	}

}

 $widgets_manager->register(new GVAElement_Image_Content());
