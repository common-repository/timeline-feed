<?php
defined( 'ABSPATH' ) || die();
?>
<div class="sttf-container sttf-container--copy-shortcode">
	<p class="description"><?php esc_html_e( 'Copy below shortcode in any page or post to publish the timeline.', 'timeline-feed' ); ?></p>

	<input type="text" id="sttf-shortcode-timeline-feed" value="<?php echo '[timeline_feed id=' . esc_attr( get_the_ID() ) . ']'; ?>" readonly>

	<button type="button" class="button button-primary button-large" id="sttf-copy-shortcode-timeline-feed" data-message="<?php esc_attr_e( 'Copied to clipboard.', 'timeline-feed' ); ?>">
		<?php esc_html_e( 'Copy', 'timeline-feed' ); ?>
	</button>
</div>
