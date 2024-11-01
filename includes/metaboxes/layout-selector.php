<?php
defined( 'ABSPATH' ) || die();
?>
<div class="sttf-container sttf-container--layout-selector">
	<fieldset>
		<legend class="screen-reader-text">
			<span><?php esc_html_e( 'Choose Layout for Timeline', 'timeline-feed' ); ?></span>
		</legend>

		<div class="sttf-layouts">
			<?php
			$js = '(function($) { "use strict"; $(document).ready(function() {';
			foreach ( $layouts as $layout ) {
			?>
			<div class="sttf-layouts__selector">
				<label for="sttf-layout-<?php echo esc_attr( $layout->get_id() ); ?>">
					<input <?php checked( $layout_id, $layout->get_id(), true ); ?> name="layout" type="radio" id="sttf-layout-<?php echo esc_attr( $layout->get_id() ); ?>" value="<?php echo esc_attr( $layout->get_id() ); ?>">
					<span class="sttf-layouts__selector__check dashicons dashicons-yes"></span>
					<span class="sttf-layouts__selector__border"></span>
					<figure>
						<img src="<?php echo esc_url( $layout->get_preview_url() ); ?>" alt="<?php echo esc_attr( $layout->get_name() ); ?>">
						<figcaption><?php echo esc_html( $layout->get_name() ); ?></figcaption>
					</figure>
				</label>
			</div>
			<?php
				$js .= ('var layout' . esc_attr( $layout->get_id() ) . ' = $(".st-layout' . esc_attr( $layout->get_id() ) . '-settings");'); 
			}
			?>
		</div>
	</fieldset>
</div>
<?php
$js .= 'var layoutSettings = $(".st-layout-settings");
		var layoutNumber = $("input[name=\'layout\']:checked").val();
		layoutSettings.hide();
		layoutSettings.find("[name^=\'l\']").prop("disabled", true);
		var currentLayoutSettings = $(".st-layout" + layoutNumber + "-settings");
		currentLayoutSettings.find("[name^=\'l" + layoutNumber + "\']").prop("disabled", false);
		currentLayoutSettings.show();
		$(document).on("change", "input[name=\'layout\']", function() {
			var layoutNumber = this.value;
			layoutSettings.hide();
			layoutSettings.find("[name^=\'l\']").prop("disabled", true);
			var checkedLayoutSettings = $(".st-layout" + layoutNumber + "-settings");
			checkedLayoutSettings.find("[name^=\'l" + layoutNumber + "\']").prop("disabled", false);
			checkedLayoutSettings.fadeIn();
		});
	});
})(jQuery);';
wp_add_inline_script( 'timeline-feed-admin', $js );
