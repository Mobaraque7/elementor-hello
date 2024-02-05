<?php

namespace VenusCompanion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Testimonial extends Widget_Base {

    public function get_name() {
        return 'testimonial';
    }

    public function get_title() {
        return __('Testimonial', 'venus-companion');
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_categories() {
        return array('general');
    }

    public function get_script_depends() {
        return array('venus-carousel');
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __('Content', 'venus-companion'),
            )
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'photo', [
				'label' => __( 'Photo', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
        );
        
        $repeater->add_control(
			'name', [
				'label' => __( 'Name', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
        $repeater->add_control(
			'designation', [
				'label' => __( 'Designation', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content', [
				'label' => __( 'Content', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'show_label' => false,
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label' => __( 'Testimonials', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
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

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="owl-carousel owl-theme dot-style-2" data-items="[2,2]" data-margin="30" data-loop="true" data-autoplay="true" data-dots="true">';
        foreach($settings['testimonials'] as $testimonial){
            $image = wp_get_attachment_image_url($testimonial['photo']['id']);
            ?>
            <div class="item">
                <div class="card border-0 mb-md-0 mb-3 text-center">
                    <div class="card-body p-md-5">
                        <img class="avatar-md rounded-circle mb-3 d-inline-block"
                            src="<?php echo esc_url($image) ;?>" alt="<?php echo esc_attr($testimonial['name']) ;?>">
                        <p class="font-lora mb-4">
                            <?php echo esc_html($testimonial['content']) ;?>
                        </p>
                        <strong class="text-primary"><?php echo esc_html($testimonial['name']) ;?></strong>
                        <p class="font-size-14 mb-0"><?php echo esc_html($testimonial['designation']) ;?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        echo '</div>';
    }

    /* protected function _content_template() {
    ?>
        <div class="title">
            {{{ settings.title }}}
        </div>
    <?php
    } */
}
