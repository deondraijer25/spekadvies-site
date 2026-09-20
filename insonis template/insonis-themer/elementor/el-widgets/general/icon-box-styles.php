<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

class GVAElement_Icon_Box_Styles extends GVAElement_Base {  
	const NAME = 'gva-icon-box-styles';
	const TEMPLATE = 'general/icon-box-styles';
	const CATEGORY = 'insonis_general';

   public function get_categories() {
      return array(self::CATEGORY);
   }
    
	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __( 'Icon Box Style', 'insonis-themer' );
	}

	public function get_keywords() {
		return [ 'icon box', 'icon' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon Box Style', 'insonis-themer' ),
			]
		);
		
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'insonis-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style 01', 'insonis-themer' ),
					'style-2' 		=> __( 'Style 02', 'insonis-themer' ),
					'style-3' 		=> __( 'Style 03', 'insonis-themer' )
				],
				'default' => 'style-1',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'insonis-themer' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-home',
					'library' => 'fa-solid',
				]
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title & Description', 'insonis-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'This is the heading', 'insonis-themer' ),
				'placeholder' => __( 'Enter your title', 'insonis-themer' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'There are many new variations of pasages of available text.', 'insonis-themer' ),
				'placeholder' => __( 'Enter your description', 'insonis-themer' ),
				'show_label' => false,
				'condition' => [
					'style' => ['style-1', 'style-2', 'style-3']
				]
			]
		);

		$this->add_control(
			'header_tag',
			[
				'label' => __( 'Title HTML Tag', 'insonis-themer' ),
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
				'default' => 'h3',
			]
		);

		$this->add_control(
			'active',
			[
				'label' => __( 'Active', 'insonis-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( //** Section Button
			'section_button',
			[
				'label' => __( 'Button & Link', 'insonis-themer' ),
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' => __( 'Link', 'insonis-themer' ),
				'type' => Controls_Manager::URL,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box Style', 'insonis-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_primary_color',
			[
				'label' => __( 'Primary Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-style.style-1 .icon-box-content, {{WRAPPER}} .iconbox-style.style-2 .iconbox-content .iconbox-icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'box_second_color',
			[
				'label' => __( 'Second Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-style.style-2 .iconbox-content .iconbox-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .iconbox-style.style-2 .iconbox-content .iconbox-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-2']
				]
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-style.style-2 .iconbox-desc:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-2']
				]
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'insonis-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' 		=> 0,
					'right' 		=> 0,
					'left'		=> 0,
					'bottom'		=> 0,
					'unit'		=> 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .iconbox-style.style-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style' => ['style-1']
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'insonis-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'selected_icon[value]!' => ''
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'insonis-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 120,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .iconbox-style .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .iconbox-style .box-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .iconbox-style .box-icon img' => 'max-width: {{SIZE}}{{UNIT}};'
				],
			]
		);


		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Icon Padding', 'insonis-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .iconbox-style .icon-inner .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'insonis-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'insonis-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'insonis-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .iconbox-style.style-1 .title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .iconbox-style.style-2 .iconbox-content' => 'padding-right: {{SIZE}}{{UNIT}};'
				],
			]
		); 

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-style .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .iconbox-style .title a' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .iconbox-style .title, {{WRAPPER}} .iconbox-style .title a',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'insonis-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => ['style-1', 'style-2'],
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-style .iconbox-desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-1', 'style-2'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .iconbox-style .iconbox-desc',
				'condition' => [
					'style' => ['style-1', 'style-2'],
				],

			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template( self::TEMPLATE . '.php');
      print '</div>';
	}
}

$widgets_manager->register(new GVAElement_Icon_Box_Styles());
