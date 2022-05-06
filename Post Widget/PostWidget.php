<?php
/**
 * Plugin Name: My Elementor Post
 * Description: My First Elementor Post Plugin
 * Plugin URI: https://demo.imagint.co/
 * Author: Tan En Qian
 * Version: 3.5.2
 * Elementor tested up to: 3.5.0
 * Author URI: https://demo.imagint.co/
 *
 * Text Domain: elementor-test-addon
 */
class My_Post_Elementor_Widgets {
	protected static $instance = null;
	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}
		return static::$instance;
	}
	
	protected function __construct() {
		require_once('PostWidgetContent.php');
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\My_Widget_3() );
	}
}

add_action( 'init', 'my_post_elementor_init' );
function my_post_elementor_init() {
	My_Post_Elementor_Widgets::get_instance(); }
