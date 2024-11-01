<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Contracts\Serviceable;

defined( 'ABSPATH' ) || die();

class Shortcode extends BaseController implements Serviceable {
	protected $timeline;

	public function __construct() {
		$this->timeline = new Timeline();
	}

	public function register() {
		add_shortcode( 'timeline_feed', array( $this, 'timeline_feed' ) );
	}

	public function timeline_feed( $attr ) {
		$post_id = isset( $attr['id'] ) ? absint( $attr['id'] ) : '';

		$layout_id = $this->timeline->get_layout( $post_id );

		$layout = LayoutLoader::get_layout_instance( $layout_id );

		ob_start();
		LayoutLoader::with( $layout )->render( $post_id );
		return ob_get_clean();
	}
}
