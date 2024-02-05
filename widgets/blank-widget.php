<?php

namespace VenusCompanion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Hello_World extends Widget_Base {

    public function get_name() {
        return 'hello-world';
    }

    public function get_title() {
        return __('Hello World', 'venus-companion');
    }

    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_categories() {
        return array('general');
    }

    public function get_script_depends() {
        return array('venus-companion');
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
                'label' => __('Title', 'venus-companion'),
                'type'  => Controls_Manager::TEXT,
            )
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

        echo '<div class="title">';
        echo $settings['title'];
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
