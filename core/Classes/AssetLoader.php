<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Contracts\Serviceable;

defined( 'ABSPATH' ) || die();

class AssetLoader extends BaseController implements Serviceable {
	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	public function enqueue_assets() {
		wp_enqueue_style( 'font-awesome', $this->plugin_url . 'assets/css/all.min.css', array(), '6.5.1', 'all' );
		wp_register_style( 'st-timeline-feed', $this->plugin_url . 'assets/css/style.css', array(), STTF_PLUGIN_VERSION, 'all' );
		wp_enqueue_style( 'st-timeline-feed' );
		wp_style_add_data( 'st-timeline-feed', 'rtl', 'replace' );
	}
}
