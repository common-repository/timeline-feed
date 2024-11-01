<?php
defined( 'ABSPATH' ) || die();
?>
<div class="sttf-container sttf-container--do-shortcode">
	<p class="description"><?php esc_html_e( 'Use below code in your theme to display the timeline.', 'timeline-feed' ); ?></p>

	<input type="text" id="sttf-code-timeline-feed" value="<?php echo '<?php echo do_shortcode( \'[timeline_feed id=' . esc_attr( get_the_ID() ) . ']\' ); ?>'; ?>" readonly>

	<button type="button" class="button button-primary button-large" id="sttf-copy-code-timeline-feed" data-message="<?php esc_attr_e( 'Copied to clipboard.', 'timeline-feed' ); ?>">
		<?php esc_html_e( 'Copy', 'timeline-feed' ); ?>
	</button>
</div>
