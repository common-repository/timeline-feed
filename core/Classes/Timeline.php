<?php
namespace TimelineFeed\Core\Classes;

defined( 'ABSPATH' ) || die();

class Timeline extends BaseController {
	const LAYOUT_META_KEY    = 'layout';
	const DEFAULT_EVENT_ICON = 'fas fa-calendar';

	public function get_events_query( $post_id, $fields = 'all' ) {
		$args = array(
			'post_type'      => PostType::EVENT,
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'   => 'timeline_id',
					'value' => $post_id,
				)
			),
			'orderby'        => 'meta_value_num',
			'meta_key'       => 'event_order',
			'order'          => 'DESC',
			'fields'         => $fields,
		);

		return new \WP_Query( $args );
	}

	public function save_events( $post_id ) {
		$events = isset( $_POST['events'] ) ? sanitize_text_field( $_POST['events'] ) : '';

		$events = json_decode( html_entity_decode( stripslashes( $events ) ), true );

		if ( ! is_array( $events ) ) {
			$events = array();
		}

		$events_query = $this->get_events_query( $post_id, 'ids' );

		$events_list = array();
		foreach ( $events as $event ) {
			array_push(
				$events_list,
				array(
					'id'    => array_key_exists( 'id', $event ) ? absint( $event['id'] ) : '',
					'title' => array_key_exists( 'title', $event ) ? sanitize_text_field( $event['title'] ) : '',
					'desc'  => array_key_exists( 'desc', $event ) ? sanitize_text_field( $event['desc'] ) : '',
					'url'   => array_key_exists( 'url', $event ) ? esc_url_raw( $event['url'] ) : '',
					'icon'  => array_key_exists( 'icon', $event ) ? sanitize_text_field( $event['icon'] ) : '',
					'date'  => array_key_exists( 'date', $event ) ? sanitize_text_field( $event['date'] ) : '',
				)
			);
		}

		// Get saved timeline event ids.
		$saved_timeline_event_ids = $events_query->posts;

		// Initialize updated timeline event ids.
		$updated_timeline_event_ids = array();

		$total_events = count( $events_list );
		if ( $total_events > 0 ) {

			foreach ( $events_list as $key => $event ) {
				$id    = $event['id'];
				$title = $event['title'];
				$desc  = $event['desc'];
				$url   = $event['url'];
				$icon  = $event['icon'];
				$date  = $event['date'];

				$order = $total_events - $key;

				// Check if timeline event exists.
				if ( $this->event_exists( $post_id, $id ) ) {
					// Update timeline event.
					$timeline_event_id = wp_update_post(
						array(
							'ID'             => $id,
							'post_title'     => $title,
							'post_content'   => $desc,
							'post_type'      => PostType::EVENT,
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'ping_status'    => 'closed',
							'meta_input'     => array(
								'timeline_id' => $post_id,
								'event_url'   => $url,
								'event_icon'  => $icon,
								'event_date'  => $date,
								'event_order' => $order,
							),
						)
					);

					// Push updated timeline event id to the array.
					array_push( $updated_timeline_event_ids, $timeline_event_id );

				} else {
					// Insert timeline event.
					$timeline_event_id = wp_insert_post(
						array(
							'post_title'     => $title,
							'post_content'   => $desc,
							'post_type'      => PostType::EVENT,
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'ping_status'    => 'closed',
							'meta_input'     => array(
								'timeline_id' => $post_id,
								'event_url'   => $url,
								'event_icon'  => $icon,
								'event_date'  => $date,
								'event_order' => $order,
							),
						)
					);
				}

			}

		}

		// Delete timeline events.
		$delete_timeline_event_ids = array_diff( $saved_timeline_event_ids, $updated_timeline_event_ids );
		foreach ( $delete_timeline_event_ids as $timeline_event_id ) {
			wp_delete_post( $timeline_event_id, true );
		}
	}

	public function get_layout( $post_id ) {
		return get_post_meta( $post_id, self::LAYOUT_META_KEY, true );
	}

	public function save_layout( $post_id, $layout_id ) {
		update_post_meta( $post_id, self::LAYOUT_META_KEY, $layout_id );
	}

	public function get_event_fields_html() {
		ob_start();

		$event_default = $this->get_event_default();

		require $this->get_event_fields_path();

		return ob_get_clean();
	}

	public function get_event_fields_path() {
		return $this->plugin_path . 'includes/metaboxes/partials/event.php';
	}

	// Check if timeline event record exists for timeline.
	public function event_exists( $post_id, $event_id ) {
		if ( $post_id === absint( get_post_meta( $event_id, 'timeline_id', true ) ) ) {
			return true;
		}

		return false;
	}

	public function get_event_default() {
		return array(
			'icon' => self::DEFAULT_EVENT_ICON,
			'date' => date('M Y'),
		);
	}
}
