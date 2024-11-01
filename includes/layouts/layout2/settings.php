<?php
defined( 'ABSPATH' ) || die();
?>
<div class="sttf-form-group">
	<label for="sttf-l2-main-background-color" class="sttf-form-label"><?php esc_html_e( 'Main Background Color', 'timeline-feed' ); ?></label>
	<input name="l2_main_background_color" type="text" class="color-picker" id="sttf-l2-main-background-color" data-default-color="<?php echo esc_attr( $default['main_background_color'] ); ?>" value="<?php echo esc_attr( $settings['main_background_color'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l2-side-background-color" class="sttf-form-label"><?php esc_html_e( 'Side Background Color', 'timeline-feed' ); ?></label>
	<input name="l2_side_background_color" type="text" class="color-picker" id="sttf-l2-side-background-color" data-default-color="<?php echo esc_attr( $default['side_background_color'] ); ?>" value="<?php echo esc_attr( $settings['side_background_color'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l2-timeline-border-color" class="sttf-form-label"><?php esc_html_e( 'Timeline Border Color', 'timeline-feed' ); ?></label>
	<input name="l2_timeline_border_color" type="text" class="color-picker" id="sttf-l2-timeline-border-color" data-default-color="<?php echo esc_attr( $default['timeline_border_color'] ); ?>" value="<?php echo esc_attr( $settings['timeline_border_color'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l2-title-font-color" class="sttf-form-label"><?php esc_html_e( 'Title Font Color', 'timeline-feed' ); ?></label>
	<input name="l2_title_font_color" type="text" class="color-picker" id="sttf-l2-title-font-color" data-default-color="<?php echo esc_attr( $default['title_font_color'] ); ?>" value="<?php echo esc_attr( $settings['title_font_color'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l2-desc-font-color" class="sttf-form-label"><?php esc_html_e( 'Description Font Color', 'timeline-feed' ); ?></label>
	<input name="l2_desc_font_color" type="text" class="color-picker" id="sttf-l2-desc-font-color" data-default-color="<?php echo esc_attr( $default['desc_font_color'] ); ?>" value="<?php echo esc_attr( $settings['desc_font_color'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l2-dashed-border-color" class="sttf-form-label"><?php esc_html_e( 'Dashed Border Color', 'timeline-feed' ); ?></label>
	<input name="l2_dashed_border_color" type="text" class="color-picker" id="sttf-l2-dashed-border-color" data-default-color="<?php echo esc_attr( $default['dashed_border_color'] ); ?>" value="<?php echo esc_attr( $settings['dashed_border_color'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l2-date-font-color" class="sttf-form-label"><?php esc_html_e( 'Date Font Color', 'timeline-feed' ); ?></label>
	<input name="l2_date_font_color" type="text" class="color-picker" id="sttf-l2-date-font-color" data-default-color="<?php echo esc_attr( $default['date_font_color'] ); ?>" value="<?php echo esc_attr( $settings['date_font_color'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l2-main-border-radius" class="sttf-form-label"><?php esc_html_e( 'Main Border Radius (Default: 8)', 'timeline-feed' ); ?>
		<span class="sttf-range-value"> - <?php echo esc_html( $settings['main_border_radius'] ); ?></span>
	</label>
	<input name="l2_main_border_radius" type="range" min="0" max="60" step="1" class="sttf-input-range" id="sttf-l2-main-border-radius"" value="<?php echo esc_attr( $settings['main_border_radius'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l2-timeline-padding" class="sttf-form-label"><?php esc_html_e( 'Timeline Padding (Default: 0)', 'timeline-feed' ); ?>
		<span class="sttf-range-value"> - <?php echo esc_html( $settings['timeline_padding'] ); ?></span>
	</label>
	<input name="l2_timeline_padding" type="range" min="0" max="60" step="1" class="sttf-input-range" id="sttf-l2-timeline-padding" value="<?php echo esc_attr( $settings['timeline_padding'] ); ?>">
</div>
