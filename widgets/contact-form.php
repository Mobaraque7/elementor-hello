<?php

namespace VenusCompanion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Contact_Form extends Widget_Base {

    public function get_name() {
        return 'contact-form';
    }

    public function get_title() {
        return __('Contact Form', 'venus-companion');
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_categories() {
        return array('general');
    }

    public function get_script_depends() {
        return array('venus-contact');
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __('Content', 'venus-companion'),
            )
        );

        $this->add_control(
            'title',
            array(
                'label' => __('Form Title', 'venus-companion'),
                'type'  => Controls_Manager::TEXT,
                'label_block' => false,
            )
        );
        
        $this->add_control(
            'button_title',
            array(
                'label' => __('Button Title', 'venus-companion'),
                'type'  => Controls_Manager::TEXT,
                'label_block' => false,
            )
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'field_id', [
				'label' => __( 'Field Id', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
        $repeater->add_control(
			'field_placeholder', [
				'label' => __( 'Placeholder Text', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
        $repeater->add_control(
			'field_type',
			[
				'label' => __( 'Field Type', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					'text'  => __( 'Text', 'venus-companion' ),
					'textarea' => __( 'Textarea', 'venus-companion' ),
				],
			]
		);

		$this->add_control(
			'fields',
			[
				'label' => __( 'Fields', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ field_id }}}',
			]
		);

		$this->end_controls_section();
        

        $this->start_controls_section(
            'section_style',
            array(
                'label' => __('Style', 'venus-companion'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
			'form_bg',
			[
				'label' => __( 'Form Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-wrapper' => 'background: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="form-wrapper">
            <form class="p-4 py-5" >
                <?php 
                wp_nonce_field('venus_contact','venus_nonce');
                ?>
                <h5 class="mb-3"><?php echo esc_html($settings['title']) ;?></h5>
                <?php 
                foreach($settings['fields'] as $field){
                    if('text'==$field['field_type']){
                        printf('<div class="form-group">
                            <input id="%s" type="text" class="form-control" placeholder="%s">
                        </div>',esc_attr($field['field_id']),esc_attr($field['field_placeholder']));
                    }else{
                        printf('<div class="form-group">
                            <textarea id="%s" class="form-control" rows="4" placeholder="Message"></textarea>
                        </div>',esc_attr($field['field_id']),esc_attr($field['field_placeholder']));
                    }
                }
                ?>
                <button  type="submit" class="contact_button btn btn-pill btn-primary"><?php echo esc_html($settings['button_title']) ;?></button>
            </form>
        </div>
        <?php
    }

    /* protected function _content_template() {
    ?>
        <div class="title">
            {{{ settings.title }}}
        </div>
    <?php
    } */
}
