<?php

namespace VenusCompanion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Minimal_Team_Member extends Widget_Base {

    public function get_name() {
        return 'minimal-team-member';
    }

    public function get_title() {
        return __('Minimal Team Member', 'venus-companion');
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
            'photo',
            array(
                'label' => __('Photo', 'venus-companion'),
                'type'  => Controls_Manager::MEDIA,
            )
        );
        
        $this->add_control(
            'name',
            array(
                'label' => __('Name', 'venus-companion'),
                'type'  => Controls_Manager::TEXT,
            )
        );
        
        $this->add_control(
            'designation',
            array(
                'label' => __('Designation', 'venus-companion'),
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
        $image  = $settings['photo']['url'];
        ?>
        <div class="card border-0 mb-4 box-hover">
            <img class="card-img-top" src="<?php echo esc_url($image) ;?>" alt="">
            <div class="card-footer border-0">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <?php echo esc_html($settings['name']) ;?>
                        <span class="text-muted d-block font-size-14">
                            <?php echo esc_html($settings['designation']) ;?>
                        </span>
                    </div>
                </div>
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
