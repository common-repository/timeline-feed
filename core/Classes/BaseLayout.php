<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Classes\BaseController;

defined( 'ABSPATH' ) || die();

abstract class BaseLayout extends BaseController {
	const LABEL        = 1;
	const CLASS_PREFIX = 'TimelineFeed\Core\Classes\Layouts\\Layout';

	protected $timeline;
	protected $setting;

	public function __construct() {
		parent::__construct();
		$this->timeline = new Timeline();
		$this->setting  = new Setting();
	}

	public static function get_default_id() {
		return self::LABEL;
	}

	public function get_id() {
		return static::LABEL;
	}

	public function get_name() {
		return sprintf(
			/* translators: %s: Layout number */
			__( 'Timeline Layout %s', 'timeline-feed' ),
			static::LABEL
		);
	}

	public function get_preview_url() {
		return $this->plugin_url . 'assets/images/layout' . static::LABEL . '.jpg';
	}

	public function get_settings_key() {
		return 'layout' . static::LABEL . '_settings';
	}

	public function render( $post_id ) {
		$events_query     = $this->timeline->get_events_query( $post_id );
		$general_settings = $this->setting->load_general_settings( $post_id );
		$layout_settings  = $this->load_settings( $post_id );
		$default          = $this->default_settings();
		$default_general  = $this->setting->default_general_settings();

		require $this->get_base_file();
	}

	public function render_settings( $post_id ) {
		$settings = $this->load_settings( $post_id );
		$default  = $this->default_settings();

		echo '<div class="st-layout-settings st-layout' . static::LABEL . '-settings">';
		require $this->get_settings_file();
		echo '</div>';
	}

	public function load_settings( $post_id ) {
		return array();
	}

	public function default_settings() {
		return array();
	}

	public function load_css( $css ) {
		wp_register_style( 'st-timeline-feed-layout', '' );
		wp_enqueue_style( 'st-timeline-feed-layout' );
		wp_add_inline_style( 'st-timeline-feed-layout', $css );
	}

	protected function get_base_url() {
		return $this->plugin_url . 'includes/layouts/layout' . static::LABEL . '/';
	}

	protected function get_base_path() {
		return $this->plugin_path . 'includes/layouts/layout' . static::LABEL . '/';
	}

	protected function get_base_file() {
		return $this->get_base_path() . 'index.php';
	}

	protected function get_settings_file() {
		return $this->get_base_path() . 'settings.php';
	}
}
