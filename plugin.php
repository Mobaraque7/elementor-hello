<?php
namespace VenusCompanion;

use VenusCompanion\Widgets\Bullet_List;
use VenusCompanion\Widgets\Client_logo;
use VenusCompanion\Widgets\Contact_Form;
use VenusCompanion\Widgets\Hello_World;
use VenusCompanion\Widgets\Icon_Text;
use VenusCompanion\Widgets\Image_Hover;
use VenusCompanion\Widgets\Inline_Editing;
use VenusCompanion\Widgets\Minimal_Team_Member;
use VenusCompanion\Widgets\Portfolio;
use VenusCompanion\Widgets\Service_Widget;
use VenusCompanion\Widgets\Team_Carousel;
use VenusCompanion\Widgets\Team_Member;
use VenusCompanion\Widgets\Testimonial;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class VenusPlugin {

    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function widget_scripts() {
        wp_register_script( 'elementor-hello-world', plugins_url( '/assets/js/hello-world.js', __FILE__ ), array('jquery'), false, true );
        wp_register_script( 'venus-portfolio', plugins_url( '/assets/js/venus-portfolio.js', __FILE__ ), array('jquery', 'imagesloaded-js', 'isotope-js'), time(), true );
        wp_register_script( 'venus-carousel', plugins_url( '/assets/js/venus-carousel.js', __FILE__ ), array('jquery'), time(), true );
        wp_register_script( 'venus-client-logo', plugins_url( '/assets/js/venus-client-logo.js', __FILE__ ), array('jquery'), time(), true );
        wp_register_script( 'venus-team-carousel', plugins_url( '/assets/js/venus-team-carousel.js', __FILE__ ), array('jquery'), time(), true );
        wp_register_script( 'venus-contact', plugins_url( '/assets/js/contact.js', __FILE__ ), array('jquery'), time(), true );
		$ajax_url = admin_url('admin-ajax.php');
		wp_localize_script('venus-contact','venus',['ajax_url'=>$ajax_url]);
	}

    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_widgets_files() {
        require_once __DIR__ . '/widgets/hello-world.php';
        require_once __DIR__ . '/widgets/inline-editing.php';
        require_once __DIR__ . '/widgets/image-hover.php';
        require_once __DIR__ . '/widgets/icon-text.php';
        require_once __DIR__ . '/widgets/portfolio.php';
        require_once __DIR__ . '/widgets/team-member.php';
        require_once __DIR__ . '/widgets/testimonial-widget.php';
        require_once __DIR__ . '/widgets/service-widget.php';
        require_once __DIR__ . '/widgets/bullet-list.php';
        require_once __DIR__ . '/widgets/client-logo.php';
        require_once __DIR__ . '/widgets/team-carousel.php';
        require_once __DIR__ . '/widgets/minimal-team-member.php';
        require_once __DIR__ . '/widgets/contact-form.php';
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets() {
        // Its is now safe to include Widgets files
        $this->include_widgets_files();

        // Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Hello_World() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Inline_Editing() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Image_Hover() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Icon_Text() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Portfolio() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Team_Member() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Testimonial() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Service_Widget() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Bullet_List() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Client_logo() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Team_Carousel() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Minimal_Team_Member() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Contact_Form() );

    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct() {

        // Register widget scripts
        add_action( 'elementor/frontend/after_register_scripts', array($this, 'widget_scripts') );

        // Register widgets
        add_action( 'elementor/widgets/widgets_registered', array($this, 'register_widgets') );
	
		add_action('wp_ajax_nopriv_venus_contact',[$this,'process_contact_form']);
		add_action('wp_ajax_venus_contact',[$this,'process_contact_form']);
	}

	public function process_contact_form(){
		if(wp_verify_nonce($_POST['nonce'],'venus_contact')){
			$email = get_option('admin_email');
			$data = "";
			foreach($_POST['formdata'] as $key=>$val){
				$data .= sprintf("%s = %s<br/>",$key,sanitize_text_field($val));
			}
			wp_mail($email,__("Contact Form Submission","venus-companion"),$data);
			echo "sent";
		}
		die();
	}
	

}

// Instantiate Plugin Class
VenusPlugin::instance();
