<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Contracts\LayoutInterface;
use TimelineFeed\Core\Contracts\Serviceable;

defined( 'ABSPATH' ) || die();

class Metabox extends BaseController implements Serviceable {
	protected $layouts;
	protected $timeline;
	protected $setting;

	public function __construct() {
		parent::__construct();

		$this->layouts = array(
			new Layouts\Layout1(),
			new Layouts\Layout2(),
			new Layouts\Layout3(),
			new Layouts\Layout4(),
		);

		$this->timeline = new Timeline();
		$this->setting  = new Setting();
	}

	public function register() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 10, 2 );
	}

	public function add_meta_boxes() {
		add_meta_box( 'st-timeline-feed-layout-selector', esc_html__( 'Choose Layout for Timeline', 'timeline-feed' ), array( $this, 'layout_selector' ), PostType::FEED, 'normal', 'default' );

		add_meta_box( 'st-timeline-feed-events', esc_html__( 'Add Events to Timeline', 'timeline-feed' ), array( $this, 'events' ), PostType::FEED, 'normal', 'default' );

		add_meta_box( 'st-timeline-feed-copy-shortcode', esc_html__( 'Timeline Shortcode', 'timeline-feed' ), array( $this, 'copy_shortcode' ), PostType::FEED, 'side', 'default' );

		add_meta_box( 'st-timeline-feed-general-settings', esc_html__( 'General Settings', 'timeline-feed' ), array( $this, 'general_settings' ), PostType::FEED, 'side', 'default' );

		add_meta_box( 'st-timeline-feed-layout-settings', esc_html__( 'Layout Settings', 'timeline-feed' ), array( $this, 'layout_settings' ), PostType::FEED, 'side', 'default' );

		add_meta_box( 'st-timeline-feed-do-shortcode', esc_html__( 'Display Timeline in your Theme', 'timeline-feed' ), array( $this, 'do_shortcode' ), PostType::FEED, 'side', 'default' );
	}

	public function layout_selector( $post ) {
		$layouts = $this->layouts;

		$layout_id = $this->timeline->get_layout( $post->ID );

		$layout_id = $this->sanitize_layout_id( $layout_id );

		require_once $this->plugin_path . 'includes/metaboxes/layout-selector.php';
	}

	public function events( $post ) {
		$events_query = $this->timeline->get_events_query( $post->ID );

		$events = array();

		if ( $events_query->have_posts() ) {
			while ( $events_query->have_posts() ) {
				$events_query->the_post();
				array_push(
					$events,
					array(
						'id'    => get_the_ID(),
						'title' => get_the_title(),
						'desc'  => get_the_content(),
						'url'   => get_post_meta( get_the_ID(), 'event_url', true ),
						'icon'  => get_post_meta( get_the_ID(), 'event_icon', true ),
						'date'  => get_post_meta( get_the_ID(), 'event_date', true ),
					)
				);
			}
			wp_reset_postdata();
		}

		$event_fields_path = $this->timeline->get_event_fields_path();

		$event_fields = wp_json_encode( $this->timeline->get_event_fields_html() );

		$event_default = $this->timeline->get_event_default();

		require_once $this->plugin_path . 'includes/metaboxes/events.php';
	}

	private function render_settings( LayoutInterface $layout, $post_id ) {
		$layout->render_settings( $post_id );
	}

	public function copy_shortcode( $post ) {
		require_once $this->plugin_path . 'includes/metaboxes/copy-shortcode.php';
	}

	public function general_settings( $post ) {
		$settings     = $this->setting->load_general_settings( $post->ID );
		$font_weights = $this->setting->get_font_weights();

		require_once $this->plugin_path . 'includes/metaboxes/general-settings.php';
	}

	public function layout_settings( $post ) {
		foreach ( $this->layouts as $layout ) {
			$this->render_settings( $layout, $post->ID );
		}
	}

	public function do_shortcode( $post ) {
		require_once $this->plugin_path . 'includes/metaboxes/do-shortcode.php';
	}

	public function save_meta_boxes( $post_id, $post ) {
		if ( ! isset( $_POST[ 'st_timeline_feed_meta_' . $post_id ] ) || ! wp_verify_nonce( $_POST[ 'st_timeline_feed_meta_' . $post_id ], 'st_timeline_feed_meta_' . $post_id ) ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		if ( PostType::FEED !== $post->post_type ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}
		if ( wp_is_post_revision( $post ) ) {
			return;
		}

		$layout_id = $this->save_layout( $post_id );

		$this->save_events( $post_id );

		$this->save_general_settings( $post_id );

		$prefix = BaseLayout::CLASS_PREFIX;
		$class  = $prefix . absint( $layout_id );

		if ( class_exists( $class ) ) {
			$instance = new $class;

			if ( $instance instanceof LayoutInterface ) {
				$this->save_layout_meta( $instance, $post_id );
			}
		}
	}

	private function save_layout( $post_id ) {
		$layout_id = isset( $_POST['layout'] ) ? sanitize_text_field( $_POST['layout'] ) : '';

		$layout_id = $this->sanitize_layout_id( $_POST['layout'] );

		$this->timeline->save_layout( $post_id, $layout_id );

		return $layout_id;
	}

	private function save_events( $post_id ) {
		$this->timeline->save_events( $post_id );
	}

	private function save_general_settings( $post_id ) {
		$this->setting->save_general_settings( $post_id );
	}

	private function save_layout_meta( LayoutInterface $layout, $post_id ) {
		$layout->save_settings( $post_id );
	}

	private function available_layout_ids() {
		$available_layout_ids = array();

		foreach ( $this->layouts as $layout ) {
			array_push( $available_layout_ids, $layout->get_id() );
		}

		return $available_layout_ids;
	}

	private function sanitize_layout_id( $layout_id ) {
		if ( ! in_array( $layout_id, $this->available_layout_ids() ) ) {
			$layout_id = BaseLayout::get_default_id();
		}

		return $layout_id;
	}
}
