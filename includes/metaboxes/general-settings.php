<?php
defined( 'ABSPATH' ) || die();

$nonce_action = 'st_timeline_feed_meta_' . $post->ID;
?>
<input type="hidden" name="<?php echo esc_attr( $nonce_action ); ?>" value="<?php echo esc_attr( wp_create_nonce( $nonce_action ) ); ?>">

<div class="sttf-form-group">
	<label for="sttf-link-in-new-tab" class="sttf-form-label"><?php esc_html_e( 'Open Link in a New Tab', 'timeline-feed' ); ?></label>
	<input <?php checked( $settings['link_in_new_tab'], true, true ); ?> name="link_in_new_tab" type="checkbox" class="sttf-toggle-input" id="sttf-link-in-new-tab" value="1">
	<label for="sttf-link-in-new-tab" class="sttf-toggle-label"><?php esc_html_e( 'Open Link in a New Tab', 'timeline-feed' ); ?></label>
</div>

<div class="sttf-form-group">
	<label for="sttf-title-underline" class="sttf-form-label"><?php esc_html_e( 'Title Underline', 'timeline-feed' ); ?></label>
	<input <?php checked( $settings['title_underline'], true, true ); ?> name="title_underline" type="checkbox" class="sttf-toggle-input" id="sttf-title-underline" value="1">
	<label for="sttf-title-underline" class="sttf-toggle-label"><?php esc_html_e( 'Title Letter Spacing', 'timeline-feed' ); ?></label>
</div>

<div class="sttf-form-group">
	<label for="sttf-title-letter-spacing" class="sttf-form-label"><?php esc_html_e( 'Title Letter Spacing', 'timeline-feed' ); ?></label>
	<input <?php checked( $settings['title_letter_spacing'], true, true ); ?> name="title_letter_spacing" type="checkbox" class="sttf-toggle-input" id="sttf-title-letter-spacing" value="1">
	<label for="sttf-title-letter-spacing" class="sttf-toggle-label"><?php esc_html_e( 'Title Letter Spacing', 'timeline-feed' ); ?></label>
</div>

<div class="sttf-form-group">
	<label for="sttf-desc-letter-spacing" class="sttf-form-label"><?php esc_html_e( 'Description Letter Spacing', 'timeline-feed' ); ?></label>
	<input <?php checked( $settings['desc_letter_spacing'], true, true ); ?> name="desc_letter_spacing" type="checkbox" class="sttf-toggle-input" id="sttf-desc-letter-spacing" value="1">
	<label for="sttf-desc-letter-spacing" class="sttf-toggle-label"><?php esc_html_e( 'Description Letter Spacing', 'timeline-feed' ); ?></label>
</div>

<div class="sttf-form-group">
	<label for="sttf-title-font-weight" class="sttf-form-label"><?php esc_html_e( 'Title Font Weight', 'timeline-feed' ); ?></label>
	<select name="title_font_weight" class="widefat" id="sttf-title-font-weight">
		<?php
		foreach ( $font_weights as $key => $value ) {
		?>
		<option <?php selected( $settings['title_font_weight'], $key, true ); ?> value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
		<?php
		}
		?>
	</select>
</div>

<div class="sttf-form-group">
	<label for="sttf-desc-font-weight" class="sttf-form-label"><?php esc_html_e( 'Description Font Weight', 'timeline-feed' ); ?></label>
	<select name="desc_font_weight" class="widefat" id="sttf-desc-font-weight">
		<?php
		foreach ( $font_weights as $key => $value ) {
		?>
		<option <?php selected( $settings['desc_font_weight'], $key, true ); ?> value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
		<?php
		}
		?>
	</select>
</div>

<div class="sttf-form-group">
	<label for="sttf-desc-line-height" class="sttf-form-label"><?php esc_html_e( 'Description Line Height (Default: 1.4)', 'timeline-feed' ); ?>
		<span class="sttf-range-value"> - <?php echo esc_html( $settings['desc_line_height'] ); ?></span>
	</label>
	<input name="desc_line_height" type="range" min="1" max="3.0" step=".1" class="sttf-input-range" id="sttf-desc-line-height" value="<?php echo esc_attr( $settings['desc_line_height'] ); ?>">
</div>
