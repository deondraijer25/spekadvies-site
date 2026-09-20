<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Tabs_Contact_Form extends GVAElement_Base{
   const NAME = 'gva-tab-contact-form';
   const TEMPLATE = 'general/tabs-contact';
   const CATEGORY = 'insonis_general';

   public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_title() {
      return esc_html__('Tabs Contact Form', 'insonis-themer');
   }

   public function get_keywords() {
      return [ 'tabs', 'contact', 'form' ];
   }

   public function get_script_depends() {
      return [
         'rangeSlider',
         'gavias.elements',
      ];
   }

   public function get_style_depends() {
      return array('rangeSlider');
   }

   protected function register_controls() {
      $forms = array();
      $posts = get_posts(array(
        'post_type'     => 'wpcf7_contact_form',
        'numberposts'   => -1
      ));
      foreach($posts as $p){
         $forms[$p->ID] =  $p->post_title;
      }

      $this->start_controls_section(
         'section_content',
         [
            'label' => esc_html__('Content', 'insonis-themer'),
         ]
      );
      $this->add_control(
         'style',
         [
            'label'        => esc_html__('Style', 'insonis-themer'),
            'type'         => Controls_Manager::SELECT,
            'options' => [
               'style-1'   => esc_html__('Style 01', 'insonis-themer'),
               'style-2'   => esc_html__('Style 02', 'insonis-themer'),
               'style-3'   => esc_html__('Style 03', 'insonis-themer')
            ],
            'default' => 'style-1',
         ]
      );
      $this->add_control(
         'sub_title',
         [
            'label'        => __( 'Sub Title', 'insonis-themer' ),
            'type'         => Controls_Manager::TEXT,
            'placeholder'  => __( 'Enter your Sub Title', 'insonis-themer' ),
            'default'      => __('Free quote', 'insonis-themer'),
            'label_block'  => true,
            'condition' => [
               'style' => ['style-2', 'style-3']
            ],
         ]
      );
      $this->add_control(
         'title_text',
         [
            'label'        => __( 'Title', 'insonis-themer' ),
            'type'         => Controls_Manager::TEXTAREA,
            'placeholder'  => __( 'Enter your title', 'insonis-themer' ),
            'default'      => __( 'Get an insurance quote to get started', 'insonis-themer' ),
            'label_block'  => true,
            'condition' => [
               'style' => ['style-2', 'style-3']
            ],
         ]
      );
      $repeater = new Repeater();
      $repeater->add_control(
         'title',
         [
            'label'       => esc_html__('Title', 'insonis-themer'),
            'type'        => Controls_Manager::TEXT,
            'default'     => 'Tab Title',
            'label_block' => true
         ]
      );
      $repeater->add_control(
         'form_id',
         [
            'label'       => esc_html__('Contact Form', 'insonis-themer'),
            'type'        => Controls_Manager::SELECT,
            'options'     => $forms
         ]
      );
      $repeater->add_control(
         'selected_icon',
         [
            'label'        => esc_html__('Choose Icon', 'insonis-themer'),
            'type'         => Controls_Manager::ICONS
         ]
      );
      $this->add_control(
         'forms_content',
         [
            'label'       => esc_html__('Contact Form Item', 'insonis-themer'),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
            'default'     => array(
               array(
                  'title'     => esc_html__('Home', 'insonis-themer'),
                  'form_id'   => '107' 
               )
            )
         ]
      );
      $this->add_control(
         'image',
         [
            'label'        => __( 'Choose Image', 'insonis-themer' ),
            'type'         => Controls_Manager::MEDIA,
            'label_block'  => true,
            'default' => [
               'url' => GAVIAS_INSONIS_PLUGIN_URL . 'elementor/assets/images/image-7.png',
            ],
            'condition'    => [
               'style'     => ['style-2', 'style-3']
            ],
         ]
      );
      $this->end_controls_section();

// === Style Tabs ==================
      $this->start_controls_section(
         'section_style_tab',
         [
            'label' => __( 'Style Tab', 'insonis-themer' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
               'style' => ['style-1']
            ],
         ]
      );

      $this->add_responsive_control(
         'nav_item_padding',
         [
            'label' => __( 'Nav Link | Padding', 'insonis-themer' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px'],
            'selectors' => [
               '{{WRAPPER}} .tabs-contact-one__nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;'
            ],
         ]
      );
      $this->add_control(
         'nav_item_border_color',
         [
            'label' => esc_html__('Nav Link Border Color', 'insonis-themer'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
              '{{WRAPPER}} .tabs-contact-one__nav-link' => 'border-color: {{VALUE}};',
            ],
         ]
      );
      $this->add_control(
         'nav_item_color',
         [
            'label' => esc_html__('Nav Link Color', 'insonis-themer'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
              '{{WRAPPER}} .tabs-contact-one__nav-link' => 'color: {{VALUE}};',
            ],
         ]
      );
      $this->add_control(
         'nav_item_background',
         [
            'label' => esc_html__('Nav Link Background', 'insonis-themer'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
              '{{WRAPPER}} .tabs-contact-one__nav-link' => 'background-color: {{VALUE}};',
            ],
         ]
      );

      $this->add_control(
         'nav_item_border_color_hover',
         [
            'label' => esc_html__('Nav Link Border Color Hover', 'insonis-themer'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
              '{{WRAPPER}} .tabs-contact-one__nav-link:hover, {{WRAPPER}} .tabs-contact-one__nav-link.active' => 'border-color: {{VALUE}};',
            ],
         ]
      );
      $this->add_control(
         'nav_item_color_hover',
         [
            'label' => esc_html__('Nav Link Color Hover', 'insonis-themer'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
              '{{WRAPPER}} .tabs-contact-one__nav-link:hover, {{WRAPPER}} .tabs-contact-one__nav-link.active' => 'color: {{VALUE}};',
            ],
         ]
      );
      $this->add_control(
         'nav_item_background_hover',
         [
            'label' => esc_html__('Nav Link Background Hover', 'insonis-themer'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
              '{{WRAPPER}} .tabs-contact-one__nav-link:hover, {{WRAPPER}} .tabs-contact-one__nav-link.active' => 'background-color: {{VALUE}};',
            ],
         ]
      );

      $this->end_controls_section();

   }

   protected function render() {
      $settings = $this->get_settings_for_display();
      printf('<div class="gva-element-%s gva-element">', $this->get_name() );
      include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
   }

}

$widgets_manager->register(new GVAElement_Tabs_Contact_Form());
