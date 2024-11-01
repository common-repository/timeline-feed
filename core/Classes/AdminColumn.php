<?php
namespace TimelineFeed\Core\Classes;

use TimelineFeed\Core\Contracts\Serviceable;

defined( 'ABSPATH' ) || die();

class AdminColumn extends BaseController implements Serviceable {
	protected $timeline;

	public function __construct() {
		$this->timeline = new Timeline();
	}

	public function register() {
		add_filter( 'manage_edit-' . PostType::FEED . '_columns', array( $this, 'edit_timeline_columns' ) );
		add_action( 'manage_' . PostType::FEED . '_posts_custom_column', array( $this, 'timeline_custom_column' ), 10, 2 );
		add_filter( 'manage_edit-' . PostType::FEED . '_sortable_columns', array( $this, 'timeline_sortable_columns' ) );
	}

	public function edit_timeline_columns( $columns ) {
		$columns = array(
			'cb'           => '<input type="checkbox" />',
			'title'        => esc_html__( 'Title', 'timeline-feed' ),
			'total_events' => esc_html__( 'Total Events', 'timeline-feed' ),
			'shortcode'    => esc_html__( 'Timeline Shortcode', 'timeline-feed' ),
			'do_shortcode' => esc_html__( 'Display Timeline in Theme', 'timeline-feed' ),
			'author'       => esc_html__( 'Author', 'timeline-feed' ),
			'date'         => esc_html__( 'Date', 'timeline-feed' ),
		);

		return $columns;
	}

	public function timeline_custom_column( $column, $post_id ) {
		switch ( $column ) {
			case 'total_events':
				$events_query = $this->timeline->get_events_query( $post_id, 'ids' );
				echo absint( $events_query->found_posts );
				break;
			case 'shortcode':
				echo '<input type="text" value="[timeline_feed id=' . esc_attr( $post_id ) . ']" readonly />';
				break;
			case 'do_shortcode':
				echo '<input type="text" value="<?php echo do_shortcode( \'[timeline_feed id=' . esc_attr( $post_id ) . ']\' ); ?>" readonly />';
				break;
			default:
				break;
		}
	}

	public function timeline_sortable_columns( $columns ) {
		$columns['total_events'] = 'total_events';
		$columns['shortcode']    = 'shortcode';
		$columns['do_shortcode'] = 'do_shortcode';
		$columns['author']       = 'author';

		return $columns;
	}
}
