<?php
namespace TimelineFeed\Core\Contracts;

defined( 'ABSPATH' ) || die();

interface LayoutInterface {
	public function get_id();
	public function get_name();
	public function get_preview_url();
	public function default_settings();
	public function save_settings( $post_id );
	public function load_settings( $post_id );
	public function render_settings( $post_id );
	public function render( $post_id );
}
