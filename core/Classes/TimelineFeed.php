<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Contracts\Serviceable;

defined( 'ABSPATH' ) || die();

class TimelineFeed extends BaseController implements Serviceable {
	protected $timeline;

	public function __construct() {
		$this->timeline = new Timeline();
	}

	public function register() {
		add_action( 'delete_post', array( $this, 'delete_timeline_events' ) );
	}

	public function delete_timeline_events( $post_id ) {
		if ( PostType::FEED !== get_post_type( $post_id ) ) {
			return;
		}

		$events_query = $this->timeline->get_events_query( $post_id, 'ids' );

		foreach ( $events_query->posts as $timeline_event_id ) {
			wp_delete_post( $timeline_event_id, true );
		}
	}
}
