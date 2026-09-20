<?php
if(!defined('ABSPATH')){ exit; }
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Counter extends GVAElement_Base {  

	const NAME = 'gva-counter';
   const TEMPLATE = 'general/counter/';
   const CATEGORY = 'insonis_general';

   public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }
   
	public function get_title() {
		return __( 'Counter', 'insonis-themer' );
	}

	
	public function get_keywords() {
		return [ 'counter', 'icon' ];
	}

	public function get_script_depends() {
      return [
         'jquery.count_to',
         'jquery.appear',
      ];
   }

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'insonis-themer' ),
			]
		);
		$this->add_control(
			'layout',
			[
				'label'   => esc_html__('Layout Display', 'insonis-themer'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carousel',
				'options' => [
					'grid'      => esc_html__('Grid', 'insonis-themer'),
					'carousel'  => esc_html__('Carousel', 'insonis-themer'),
					'single'  	=> esc_html__('Single', 'insonis-themer')
				]
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

		$repeater = new Repeater();
		$repeater->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon Class', 'insonis-themer' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-home',
					'library' => 'fa-solid',
				],
			]
		);
		$repeater->add_control(
			'number',
			[
				'label' => __( 'Number', 'insonis-themer' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 110
			]
		);
		$repeater->add_control(
			'text_before',
			[
				'label' => __( 'Text Before Number', 'insonis-themer' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'text_after',
			[
				'label' => __( 'Text After Number', 'insonis-themer' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'insonis-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'This is the heading', 'insonis-themer' ),
				'placeholder' => __( 'Enter your title', 'insonis-themer' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'insonis-themer' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'insonis-themer' ),
			]
		);
		$repeater->add_control(
			'active',
			[
				'label' 			=> __( 'Active', 'insonis-themer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no'
			]
		);

		$this->add_control(
			'counter_items',
			[
				'label'       => esc_html__('Content Item', 'insonis-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title_text }}}',
				'default'     => array(
					array(
						'title_text'  				=> esc_html__('People We Gave Insurance', 'insonis-themer'),
						'selected_icon' 			=> array('value' => 'iicon-document'),
						'number'						=> '260',
						'text_after'				=> '+'
					),
					array(
						'title_text'  					=> esc_html__('Company Won Awards', 'insonis-themer'),
						'selected_icon' 			=> array('value' => 'iicon-award-1'),
						'number'						=> '150',
						'text_after'				=> '+'
					),
					array(
						'title_text'  				=> esc_html__('Years Of Experience', 'insonis-themer'),
						'selected_icon' 			=> array('value' => 'iicon-like'),
						'number'						=> '32',
						'text_after'				=> '+'
					),
					array(
						'title_text'  				=> esc_html__('Professional Team Staff', 'insonis-themer'),
						'selected_icon' 			=> array('value' => 'iicon-users-1'),
						'number'						=> '98',
						'text_after'				=> '+'
					)
				)
			]
		);

		$this->add_control(
			'title_size',
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
				'default' => 'div',
			]
		);
		
		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));
		$this->add_control_grid(array('layout' => 'grid'));

		// Style Icon
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'insonis-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-one__icon i, {{WRAPPER}} .milestone-two__icon i, {{WRAPPER}} .milestone-three__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .milestone-one__icon svg, {{WRAPPER}} .milestone-two__icon svg, {{WRAPPER}} .milestone-three__icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'insonis-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .milestone-one__icon i, {{WRAPPER}} .milestone-two__icon i, {{WRAPPER}} .milestone-three__icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .milestone-one__icon svg, {{WRAPPER}} .milestone-two__icon svg, {{WRAPPER}} .milestone-three__icon svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
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
					'{{WRAPPER}} .milestone-one__icon, {{WRAPPER}} .milestone-two__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} milestone-three__content' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'insonis-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_top_space',
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
					'{{WRAPPER}} .milestone-one__title, {{WRAPPER}} .milestone-two__title, {{WRAPPER}} .milestone-three__title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .milestone-one__title, {{WRAPPER}} .milestone-two__title, {{WRAPPER}} .milestone-three__title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-one__title, {{WRAPPER}} .milestone-two__title, {{WRAPPER}} .milestone-three__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_bg_color',
			[
				'label' => __( 'Background Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-one__title' => 'background: {{VALUE}};',
					'{{WRAPPER}} .milestone-one__title:after'	=> 'border-bottom-color: {{VALUE}};'
				],
				'condition' => [
					'style' => ['style-1']
				],
			]
		);
		
		$this->add_control(
			'title_hover',
			[
				'label' => __( 'Hover: Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-one:hover .milestone-one__title, {{WRAPPER}} .milestone-one:focus .milestone-one__title' => 'color: {{VALUE}}!important;',
				],
				'condition' => [
					'style' => ['style-1']
				],
			]
		); 

		$this->add_control(
			'title_hover_bg',
			[
				'label' => __( 'Hover: Background Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-one:hover .milestone-one__title, {{WRAPPER}} .milestone-one:focus .milestone-one__title' => 'background: {{VALUE}};',
					'{{WRAPPER}} .milestone-one:hover .milestone-one__title:after, {{WRAPPER}} .milestone-one:focus .milestone-one__title:after' => 'border-bottom-color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-1']
				],
			]
		);
		$this->end_controls_section();

		// Number Text
		$this->start_controls_section(
			'sectionn_number_style',
			[
				'label' => __( 'Number Text', 'insonis-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'number_bottom_space',
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
					'{{WRAPPER}} .milestone-one__number, {{WRAPPER}} .milestone-two__number, {{WRAPPER}} .milestone-three__number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'number_text_color',
			[
				'label' => __( 'Color', 'insonis-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-one__number, {{WRAPPER}} .milestone-two__number, {{WRAPPER}} .milestone-three__number' => 'color: {{VALUE}};',
					'{{WRAPPER}} .milestone-one__number .symbol, {{WRAPPER}} .milestone-two__number .symbol, {{WRAPPER}} .milestone-three__number .symbol' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_text_typography',
				'selector' => '{{WRAPPER}} .milestone-one__number, {{WRAPPER}} .milestone-two__number, {{WRAPPER}} .milestone-three__number',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         if( !empty($settings['layout']) ){
            include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
        	}
      print '</div>';
	}
}
$widgets_manager->register(new GVAElement_Counter());
