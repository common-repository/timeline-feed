<?php
defined( 'ABSPATH' ) || die();

if ( ! isset( $event_id ) ) {
	$event_id = '';
}
if ( ! isset( $event_title ) ) {
	$event_title = '';
}
if ( ! isset( $event_desc ) ) {
	$event_desc = '';
}
if ( ! isset( $event_url ) ) {
	$event_url = '';
}
if ( ! isset( $event_icon ) ) {
	$event_icon = $event_default['icon'];
}
if ( ! isset( $event_date ) ) {
	$event_date = $event_default['date'];
}
?>
<div class="sttf-events__item sttf-event">
	<input type="hidden" class="widefat sttf-event-id" value="<?php echo esc_attr( $event_id ); ?>">

	<div class="sttf-form-group">
		<label><?php esc_html_e( 'Title', 'timeline-feed' ); ?></label>
		<input type="text" class="widefat sttf-event-title" placeholder="<?php esc_attr_e( 'Enter event title', 'timeline-feed' ); ?>" value="<?php echo esc_attr( $event_title ); ?>">
	</div>

	<div class="sttf-form-group">
		<label><?php esc_html_e( 'Description', 'timeline-feed' ); ?></label>
		<textarea class="widefat sttf-event-desc" cols="30" rows="6" placeholder="<?php esc_attr_e( 'Enter event description', 'timeline-feed' ); ?>"><?php echo esc_textarea( $event_desc ); ?></textarea>
	</div>

	<div class="sttf-form-group">
		<label><?php esc_html_e( 'Link', 'timeline-feed' ); ?></label>
		<input type="text" class="widefat sttf-event-url" placeholder="<?php esc_attr_e( 'Enter event url', 'timeline-feed' ); ?>" value="<?php echo esc_url( $event_url ); ?>">
	</div>

	<div class="sttf-form-group">
		<label><?php esc_html_e( 'Icon Class', 'timeline-feed' ); ?></label>
		<input type="text" class="widefat sttf-event-icon" placeholder="<?php esc_attr_e( 'Enter event icon', 'timeline-feed' ); ?>" value="<?php echo esc_attr( $event_icon ); ?>">
		<p class="description">
			<a target="_blank" href="https://fontawesome.com/icons"><?php esc_html_e( 'Search more icons', 'timeline-feed' ); ?></a>
		</p>
	</div>

	<div class="sttf-form-group">
		<label><?php esc_html_e( 'Date / Time', 'timeline-feed' ); ?></label>
		<input type="text" class="widefat sttf-event-date" placeholder="<?php esc_attr_e( 'Enter event date or time', 'timeline-feed' ); ?>" value="<?php echo esc_attr( $event_date ); ?>">
	</div>

	<span class="screen-reader-text"><?php esc_html_e( 'Remove Event', 'timeline-feed' ); ?></span>
	<span class="sttf-event__remove-btn dashicons dashicons-no"></span>
</div>
