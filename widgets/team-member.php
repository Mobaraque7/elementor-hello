<?php

namespace VenusCompanion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Team_Member extends Widget_Base {

    public function get_name() {
        return 'team-member';
    }

    public function get_title() {
        return __('Team Member', 'venus-companion');
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

        $this->add_control(
            'facebook',
            array(
                'label' => __('Facebook', 'venus-companion'),
                'type'  => Controls_Manager::TEXT,
            )
        );
        
        $this->add_control(
            'twitter',
            array(
                'label' => __('Twitter', 'venus-companion'),
                'type'  => Controls_Manager::TEXT,
            )
        );
        
        $this->add_control(
            'linkedin',
            array(
                'label' => __('Linked In', 'venus-companion'),
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

        $this->add_control(
            'overlay',
            array(
                'label' => __('Overlay Color', 'venus-companion'),
                'type'  => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .team-hover .team-info' => 'background: {{VALUE}}',
				],
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        ?>

        <div class="team-hover card border-0 mb-4">
            <img class="card-img rounded" src="<?php echo  esc_url($settings['photo']['url']) ;?>" alt="">
            <div class="team-info">
                <div class="team-title">
                    <h6><?php echo esc_html($settings['name']) ;?></h6>
                    <p><?php echo esc_html($settings['designation']) ;?></p>
                </div>
                <div class="team-social-links">
                    <a href="<?php echo esc_url($settings['facebook'])  ;?>"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?php echo esc_url($settings['twitter'])  ;?>"><i class="fab fa-twitter"></i></a>
                    <a href="<?php echo esc_url($settings['linkedin'])  ;?>"><i class="fab fa-linkedin"></i></a>
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
