<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Contracts\LayoutInterface;

defined( 'ABSPATH' ) || die();

class LayoutLoader {
	protected $layout;

	private function __construct( LayoutInterface $layout ) {
		$this->layout = $layout;
	}

	public static function with( LayoutInterface $layout ) {
		return new static( $layout );
	}

	public function render( $post_id ) {
		$this->layout->render( $post_id );
	}

	public static function get_layout_instance( $layout_id ) {
		$prefix = BaseLayout::CLASS_PREFIX;
		$class  = $prefix . absint( $layout_id );

		if ( class_exists( $class ) ) {
			$instance = new $class;

			if ( $instance instanceof LayoutInterface ) {
				return $instance;
			}
		}

		$class = $prefix . BaseLayout::LABEL;

		return new $class;
	}
}
