<?php

namespace VenusCompanion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Bullet_List extends Widget_Base {

    public function get_name() {
        return 'bullet-list';
    }

    public function get_title() {
        return __('Bullet List', 'venus-companion');
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
            'list_items',
            array(
                'label' => __('List Items', 'venus-companion'),
                'type'  => Controls_Manager::TEXTAREA,
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
        $list_items  = explode("\n",$settings['list_items']);
        ?>
        <ul class="list-unstyled text-muted">
            <?php 
            foreach($list_items as $list_item){
                printf('<li><i class="vl-minus font-size-12 pr-3 pb-0"></i>%s </li>',$list_item);
            }
            ?>
        </ul>
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
