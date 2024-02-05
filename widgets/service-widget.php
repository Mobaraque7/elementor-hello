<?php

namespace VenusCompanion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Service_Widget extends Widget_Base {

    public function get_name() {
        return 'service';
    }

    public function get_title() {
        return __('Service', 'venus-companion');
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
            'icon',
            array(
                'label' => __('Icon', 'venus-companion'),
                'type'  => Controls_Manager::ICONS,
            )
        );

        $this->add_control(
            'label',
            array(
                'label' => __('Label', 'venus-companion'),
                'type'  => Controls_Manager::TEXT,
            )
        );


        $this->add_control(
            'title',
            array(
                'label' => __('Title', 'venus-companion'),
                'type'  => Controls_Manager::TEXT,
            )
        );

        
        $this->add_control(
            'description',
            array(
                'label' => __('Description', 'venus-companion'),
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

        $this->add_control(
            'label_color',
            array(
                'label' => __('Label Color', 'venus-companion'),
                'type'  => Controls_Manager::COLOR,
                'default'=>'#287dfe',
                'selectors'=>[
                    '{{WRAPPER}} .step-number' => 'background: {{VALUE}}',
                ]
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="justify-content-center text-center">
        <div class="steps-dashed mb-md-5 mb-3">
            <i class="<?php echo esc_attr($settings['icon']['value']) ;?> icon-lg"></i>
            <span class="step-number">
                <?php echo esc_html($settings['label']) ;?>
            </span>
        </div>
        <div class="steps-info">
            <h6 class="mb-3"><?php echo esc_html($settings['title']) ;?></h6>
            <p><?php echo esc_html($settings['description']) ;?></p>
        </div>
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
