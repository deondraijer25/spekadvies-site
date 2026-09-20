<?php

if (!defined('ABSPATH')) {
		exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Icon_Box_Group extends GVAElement_Base{
	const NAME = 'gva_icon_box_group';
	const TEMPLATE = 'general/icon-box-group';
	const CATEGORY = 'insonis_general';

	public function get_categories() {
		return array(self::CATEGORY);
	}
		
	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return esc_html__('Icon Box Carousel/Grid', 'insonis-themer');
	}

	public function get_keywords() {
		return [ 'icon', 'box', 'content', 'carousel', 'grid' ];
	}

	public function get_script_depends() {
		return [
			'swiper',
			'gavias.elements',
		];
	}

	public function get_style_depends() {
		return array('swiper');
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__('Content', 'insonis-themer'),
			]
		);
		$this->add_control( // xx Layout
			'layout_heading',
			[
				'label'   => esc_html__('Layout', 'insonis-themer'),
				'type'    => Controls_Manager::HEADING,
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
					'carousel'  => esc_html__('Carousel', 'insonis-themer')
				]
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> esc_html__('Style', 'insonis-themer'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'style-1' => esc_html__('Style 01', 'insonis-themer'),
					'style-2' => esc_html__('Style 02', 'insonis-themer'),
					'style-3' => esc_html__('Style 03', 'insonis-themer'),
					'style-4' => esc_html__( 'Style 04', 'insonis-themer' ),
					'style-5' => esc_html__( 'Style 05', 'insonis-themer' )
				],
				'default' => 'style-1',
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'selected_icon',
			[
				'label'      	=> esc_html__('Choose Icon', 'insonis-themer'),
				'type'       	=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 		=> 'icon-insonis-strategy',
					'library' 	=> 'insonis-icons-theme'
				]
			]
		);
		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'insonis-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Add your Title',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'desc',
			[
				'label'       => esc_html__('Description', 'insonis-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'	  => 'Pellentesque egestas orci felis, eu maximus metus vulputate sit amet, eget ultricies enim dignissim blandit.'
			]
		);
		
		$repeater->add_control(
			'link',
			[
				'label'     	=> esc_html__('Link', 'insonis-themer'),
				'type'      	=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__('https://your-link.com', 'insonis-themer'),
				'label_block' 	=> true
			]
		);

		$repeater->add_control(
			'number',
			[
				'label' => esc_html__('Number', 'insonis-themer'),
				'type' => Controls_Manager::TEXT,
				'default' => '01',
			]
		);

		$repeater->add_control(
			'active',
			[
				'label' 			=> esc_html__('Active', 'insonis-themer'),
				'type' 			=> Controls_Manager::SWITCHER,
				'placeholder' 	=> esc_html__('Active', 'insonis-themer'),
				'default' 		=> 'no'
			]
		);

		$this->add_control(
			'icon_boxs',
			[
				'label'       => esc_html__('Content Item', 'insonis-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'title'  					=> esc_html__('Car insurance', 'insonis-themer'),
						'selected_icon' 			=> array('value' => 'micon__car'),
					),
					array(
						'title'  					=> esc_html__('Life insurance', 'insonis-themer'),
						'selected_icon' 			=> array('value' => 'micon__cardiogram'),
						'item_primary_color'		=> '#FFAD0E'
					),
					array(
						'title'  					=> esc_html__('Home insurance', 'insonis-themer'),
						'selected_icon' 			=> array('value' => 'micon__home1'),
						'item_primary_color'		=> '#8139E7'
					),
					array(
						'title'  					=> esc_html__('Business insurance', 'insonis-themer'),
						'selected_icon' 			=> array('value' => 'micon__suitcase'),
						'item_primary_color'		=> '#2EC58E'
					)
				)
			]
		);
		
		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

		// Icon Styling
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Style', 'insonis-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_box',
			[
				'label'	=> esc_html__('Box', 'insonis-themer'),
				'type'	=> Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' 		=> esc_html__('Primary Color', 'insonis-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-four' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .iconbox-four:after' => 'background: {{VALUE}};'
				],
				'condition' => [
					'style' => ['style-4']
				],
			] 
		);

		$this->add_control(
			'primary_color_hover',
			[
				'label' 		=> esc_html__('Primary Color - Hover', 'insonis-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-four:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .iconbox-four:hover:after' => 'background: {{VALUE}};'
				],
				'condition' => [
					'style' => ['style-4']
				],
			] 
		);

		$this->add_control(
			'heading_icon',
			[
				'label'	=> esc_html__('Icon', 'insonis-themer'),
				'type'	=> Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__('Icon Color', 'insonis-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .el-icon i' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .el-icon svg' => 'fill: {{VALUE}}!important;'
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' 		=> esc_html__('Size', 'insonis-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el-icon i' => 'font-size: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .el-icon svg' => 'width: {{SIZE}}{{UNIT}}!important;',
					
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' 		=> esc_html__('Spacing', 'insonis-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el-icon' => 'padding-bottom: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__('Title', 'insonis-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__('Spacing', 'insonis-themer'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el-title' => 'padding-bottom: {{SIZE}}{{UNIT}}!important;',
				],
			]
		); 

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'insonis-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .el-title' => 'color: {{VALUE}}!important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .el-title'
			]
		);

		$this->add_control(
			'heading_desc',
			[
				'label' => esc_html__('Description', 'insonis-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__('Color', 'insonis-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .el-desc' => 'color: {{VALUE}}!important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .el-desc'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
			if( !empty($settings['layout']) ){
				include $this->get_template('general/icon-box-group/' . $settings['layout'] . '.php');
			}
		print '</div>';
	}

}

$widgets_manager->register(new GVAElement_Icon_Box_Group());
