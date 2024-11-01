<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Contracts\Serviceable;

defined( 'ABSPATH' ) || die();

class Language extends BaseController implements Serviceable {
	public function register() {
		add_action( 'init', array( $this, 'load_translation' ) );
	}

	public function load_translation() {
		load_plugin_textdomain( 'timeline-feed', false, basename( $this->plugin_path ) . '/languages' );
	}
}
