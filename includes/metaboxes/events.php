<?php
defined( 'ABSPATH' ) || die();
?>
<div class="sttf-container sttf-container--events">
	<fieldset>
		<legend class="screen-reader-text">
			<span><?php esc_html_e( 'Add Events to Timeline', 'timeline-feed' ); ?></span>
		</legend>

		<input type="hidden" name="events" id="sttf-events" value="<?php echo esc_attr( wp_json_encode( $events ) ); ?>">

		<div class="sttf-events" data-event-fields="<?php echo esc_attr( $event_fields ); ?>">
			<div class="sttf-events__item sttf-events__item--action sttf-events__item--add">
				<span class="sttf-events__item--action-label"><?php esc_html_e( 'Add New Event', 'timeline-feed' ); ?></span>
				<span class="sttf-events__item--action-btn sttf-events__item--add-btn dashicons dashicons-plus"></span>
			</div>

			<div class="sttf-events-wrap">
			<?php
			if ( count( $events ) > 0 ) {
				foreach ( $events as $event ) {
					$event_id    = $event['id'];
					$event_title = $event['title'];
					$event_desc  = $event['desc'];
					$event_url   = $event['url'];
					$event_icon  = $event['icon'];
					$event_date  = $event['date'];

					require $event_fields_path;
				}
				wp_reset_postdata();
			}
			?>
			</div>

			<div class="sttf-events__item sttf-events__item--action sttf-events__item--remove-all" data-confirm-message="<?php esc_attr_e( 'Are you sure to remove all events from timeline?', 'timeline-feed' ); ?>">
				<span class="sttf-events__item--action-label"><?php esc_html_e( 'Delete all Events', 'timeline-feed' ); ?></span>
				<span class="sttf-events__item--action-btn sttf-events__item--remove-all-btn dashicons dashicons-trash"></span>
			</div>
		</div>
	</fieldset>
</div>

<div class="sttf-other">
	<div class="sttf-review-us">
		<div class="sttf-review-link">
			<a target="_blank" href="https://wordpress.org/support/plugin/timeline-feed/reviews/#new-post" class="sttf-review-link">
				<span class="sttf-rate-us">
					<?php esc_html_e( 'Like this plugin? Leave a Review.', 'timeline-feed' ); ?>
				</span>
				<div class="vers column-rating">
					<div class="star-rating">
						<span class="screen-reader-text"><?php esc_html_e( 'Like this plugin? Leave a Review.', 'timeline-feed' ); ?></span>
						<div class="star star-full" aria-hidden="true"></div>
						<div class="star star-full" aria-hidden="true"></div>
						<div class="star star-full" aria-hidden="true"></div>
						<div class="star star-full" aria-hidden="true"></div>
						<div class="star star-full" aria-hidden="true"></div>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
