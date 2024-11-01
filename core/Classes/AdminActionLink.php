<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Contracts\Serviceable;

defined( 'ABSPATH' ) || die();

class AdminActionLink extends BaseController implements Serviceable {
	public function register() {
		add_filter( 'plugin_action_links_' . $this->plugin_base, array( $this, 'add_action_links' ) );
	}

	public function add_action_links( $links ) {
		$settings_link = ( '<a href="' . esc_url( admin_url( 'edit.php?post_type=' . PostType::FEED ) ) . '">' . esc_html__( 'Settings', 'timeline-feed' ) . '</a>' );
		array_unshift( $links, $settings_link );

		return $links;
	}
}
