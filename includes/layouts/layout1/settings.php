<?php
defined( 'ABSPATH' ) || die();
?>
<div class="sttf-form-group">
	<label for="sttf-l1-background-color" class="sttf-form-label"><?php esc_html_e( 'Timeline Background Color', 'timeline-feed' ); ?></label>
	<input name="l1_background_color" type="text" class="color-picker" id="sttf-l1-background-color" data-default-color="<?php echo esc_attr( $default['background_color'] ); ?>" value="<?php echo esc_attr( $settings['background_color'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l1-color-1" class="sttf-form-label"><?php esc_html_e( 'Timeline Color 1', 'timeline-feed' ); ?></label>
	<input name="l1_color_1" type="text" class="color-picker" id="sttf-l1-color-1" data-default-color="<?php echo esc_attr( $default['color_1'] ); ?>" value="<?php echo esc_attr( $settings['color_1'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l1-color-2" class="sttf-form-label"><?php esc_html_e( 'Timeline Color 2', 'timeline-feed' ); ?></label>
	<input name="l1_color_2" type="text" class="color-picker" id="sttf-l1-color-2" data-default-color="<?php echo esc_attr( $default['color_2'] ); ?>" value="<?php echo esc_attr( $settings['color_2'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l1-color-3" class="sttf-form-label"><?php esc_html_e( 'Timeline Color 3', 'timeline-feed' ); ?></label>
	<input name="l1_color_3" type="text" class="color-picker" id="sttf-l1-color-3" data-default-color="<?php echo esc_attr( $default['color_3'] ); ?>" value="<?php echo esc_attr( $settings['color_3'] ); ?>">
</div>

<div class="sttf-form-group">
	<label for="sttf-l1-color-4" class="sttf-form-label"><?php esc_html_e( 'Timeline Color 4', 'timeline-feed' ); ?></label>
	<input name="l1_color_4" type="text" class="color-picker" id="sttf-l1-color-4" data-default-color="<?php echo esc_attr( $default['color_4'] ); ?>" value="<?php echo esc_attr( $settings['color_4'] ); ?>">
</div>
