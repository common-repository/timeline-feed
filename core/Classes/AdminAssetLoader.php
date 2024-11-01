<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Contracts\Serviceable;

defined( 'ABSPATH' ) || die();

class AdminAssetLoader extends BaseController implements Serviceable {
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	public function enqueue_assets( $hook_suffix ) {
		global $post;
		if ( in_array( $hook_suffix, array( 'edit.php', 'post.php', 'post-new.php' ), true ) ) {
			$screen = get_current_screen();
			if ( is_object( $screen ) && ( PostType::FEED === $screen->post_type ) ) {
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_style( 'font-awesome', $this->plugin_url . 'assets/css/all.min.css', array(), '6.5.1', 'all' );
				wp_enqueue_style( 'fontawesome-iconpicker', $this->plugin_url . 'assets/css/fontawesome-iconpicker.min.css', array(), '6.5.1', 'all' );
				wp_register_style( 'timeline-feed-admin', $this->plugin_url . 'assets/css/admin.css', array(), STTF_PLUGIN_VERSION, 'all' );
				wp_enqueue_style( 'timeline-feed-admin' );
				wp_style_add_data( 'timeline-feed-admin', 'rtl', 'replace' );
				wp_enqueue_script( 'fontawesome-iconpicker', $this->plugin_url . 'assets/js/fontawesome-iconpicker.min.js', array(), '6.5.1', true );
				wp_enqueue_script( 'timeline-feed-admin', $this->plugin_url . 'assets/js/admin.js', array( 'wp-color-picker', 'jquery-ui-sortable' ), STTF_PLUGIN_VERSION, true );
			}
		}
	}
}
