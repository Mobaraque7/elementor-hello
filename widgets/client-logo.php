<?php

namespace VenusCompanion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Client_logo extends Widget_Base {

    public function get_name() {
        return 'client-logo';
    }

    public function get_title() {
        return __('Client Logo', 'venus-companion');
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_categories() {
        return array('general');
    }

    public function get_script_depends() {
        return array('venus-client-logo');
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
				'label' => __( 'Logo', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
        );
        
        $repeater->add_control(
			'url', [
				'label' => __( 'Name', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
			]
        );
        
       

		$this->add_control(
			'logos',
			[
				'label' => __( 'Client Logos', 'venus-companion' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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
        echo '<div class="owl-carousel owl-theme dot-style-1 text-center" data-items="[5,3,2]" data-autoplay="true" data-margin="10" data-dots="true">';
        foreach($settings['logos'] as $logo){
            $image = wp_get_attachment_image_url($logo['photo']['id'],'large');
            ?>
            <div class="item">
                <a target="_blank" href="<?php echo esc_url($logo['url']['url']) ;?>">
                    <img class="clients-thumb" src="<?php echo esc_url($image) ;?>" alt="">
                </a>
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
