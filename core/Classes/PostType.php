<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Contracts\Serviceable;

defined( 'ABSPATH' ) || die();

class PostType implements Serviceable {
	const FEED  = 'timeline_feed';
	const EVENT = 'timeline_feed_event';

	public function register() {
		add_action( 'init', array( $this, 'register_post_types' ) );
	}

	public function register_post_types() {
		$this->register_timeline_feed();
		$this->register_timeline_feed_event();
	}

	private function register_timeline_feed() {
		$labels = array(
			'name'                     => _x( 'Timeline Feed', 'General Name', 'timeline-feed' ),
			'singular_name'            => _x( 'Timeline', 'Singular name', 'timeline-feed' ),
			'add_new'                  => __( 'Add New Timeline', 'timeline-feed' ),
			'add_new_item'             => __( 'Add New Timeline', 'timeline-feed' ),
			'edit_item'                => __( 'Edit Timeline', 'timeline-feed' ),
			'new_item'                 => __( 'New Timeline', 'timeline-feed' ),
			'view_item'                => __( 'View Timeline', 'timeline-feed' ),
			'view_items'               => __( 'View Timelines', 'timeline-feed' ),
			'search_items'             => __( 'Search Timelines', 'timeline-feed' ),
			'not_found'                => __( 'No timelines found', 'timeline-feed' ),
			'not_found_in_trash'       => __( 'No timelines found in Trash', 'timeline-feed' ),
			'all_items'                => __( 'All Timelines', 'timeline-feed' ),
			'menu_name'                => _x( 'Timeline Feed', 'Menu Name', 'timeline-feed' ),
			'item_published'           => __( 'Timeline published.', 'timeline-feed' ),
			'item_published_privately' => __( 'Timeline published privately.', 'timeline-feed' ),
			'item_reverted_to_draft'   => __( 'Timeline reverted to draft.', 'timeline-feed' ),
			'item_scheduled'           => __( 'Timeline scheduled.', 'timeline-feed' ),
			'item_updated'             => __( 'Timeline updated.', 'timeline-feed' ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'supports'            => array( 'title' ),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 10,
			'menu_icon'           => 'dashicons-calendar-alt',
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'has_archive'         => false,
			'query_var'           => false,
			'can_export'          => true,
			'rewrite'             => false,
			'capability_type'     => 'post',
		);

		register_post_type( self::FEED, $args );
	}

	private function register_timeline_feed_event() {
		$labels = array(
			'name'                     => _x( 'Timeline Event', 'General Name', 'timeline-feed' ),
			'singular_name'            => _x( 'Timeline Event', 'Singular name', 'timeline-feed' ),
			'add_new'                  => __( 'Add New Event', 'timeline-feed' ),
			'add_new_item'             => __( 'Add New Event', 'timeline-feed' ),
			'edit_item'                => __( 'Edit Event', 'timeline-feed' ),
			'new_item'                 => __( 'New Timeline Event', 'timeline-feed' ),
			'view_item'                => __( 'View Timeline Event', 'timeline-feed' ),
			'view_items'               => __( 'View Timeline Events', 'timeline-feed' ),
			'search_items'             => __( 'Search Timeline Events', 'timeline-feed' ),
			'not_found'                => __( 'No timeline events found', 'timeline-feed' ),
			'not_found_in_trash'       => __( 'No timeline events found in Trash', 'timeline-feed' ),
			'all_items'                => __( 'All Events', 'timeline-feed' ),
			'menu_name'                => _x( 'Timeline Event', 'Menu Name', 'timeline-feed' ),
			'item_published'           => __( 'Timeline event published.', 'timeline-feed' ),
			'item_published_privately' => __( 'Timeline event published privately.', 'timeline-feed' ),
			'item_reverted_to_draft'   => __( 'Timeline event reverted to draft.', 'timeline-feed' ),
			'item_scheduled'           => __( 'Timeline event scheduled.', 'timeline-feed' ),
			'item_updated'             => __( 'Timeline event updated.', 'timeline-feed' ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'supports'            => array( 'title' ),
			'public'              => false,
			'show_ui'             => false,
			'show_in_menu'        => false,
			'menu_position'       => 10,
			'menu_icon'           => 'dashicons-calendar',
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'has_archive'         => false,
			'query_var'           => false,
			'can_export'          => true,
			'rewrite'             => false,
			'capability_type'     => 'post',
		);

		register_post_type( self::EVENT, $args );
	}
}
