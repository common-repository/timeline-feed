<?php
defined( 'ABSPATH' ) || die();

// General settings.
$target_blank         = $general_settings['link_in_new_tab'] ? ' target="blank"' : '';
$title_underline      = $general_settings['title_underline'];
$title_letter_spacing = $general_settings['title_letter_spacing'];
$desc_letter_spacing  = $general_settings['desc_letter_spacing'];
$title_font_weight    = $general_settings['title_font_weight'];
$desc_font_weight     = $general_settings['desc_font_weight'];
$desc_line_height     = $general_settings['desc_line_height'];

// Layout settings.
$background_color = $layout_settings['background_color'];
$color_1          = $layout_settings['color_1'];
$color_2          = $layout_settings['color_2'];
$color_3          = $layout_settings['color_3'];
$color_4          = $layout_settings['color_4'];

$css = '';
// General settings.
if ( ! $title_underline ) {
	$css .= '#sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-title { text-decoration: none; } ';
}
if ( $title_letter_spacing ) {
	$css .= '#sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-title { letter-spacing: 1px; } ';
}
if ( $desc_letter_spacing ) {
	$css .= '#sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-desc { letter-spacing: 1px; } ';
}
if ( $default_general['title_font_weight'] !== $title_font_weight ) {
	$css .= '#sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-title { font-weight: ' . esc_attr( $title_font_weight ) . '; } ';
}
if ( $default_general['desc_font_weight'] !== $desc_font_weight ) {
	$css .= '#sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-desc { font-weight: ' . esc_attr( $desc_font_weight ) . '; } ';
}
if ( $default_general['desc_line_height'] !== $desc_line_height ) {
	$css .= '#sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-desc { line-height: ' . esc_attr( $desc_line_height ) . '; } ';
}

// Layout settings.
if ( $default['background_color'] !== $background_color ) {
	$css .= '#sttf-l1-' . esc_attr( $post_id ) . ' { background-color: ' . sanitize_hex_color( $background_color ) . '; } ';
}
if ( $default['color_1'] !== $color_1 ) {
	$css .= $this->load_color_style( $post_id, $color_1, 1 );
}
if ( $default['color_2'] !== $color_2 ) {
	$css .= $this->load_color_style( $post_id, $color_2, 2 );
}
if ( $default['color_3'] !== $color_3 ) {
	$css .= $this->load_color_style( $post_id, $color_3, 3 );
}
if ( $default['color_4'] !== $color_4 ) {
	$css .= $this->load_color_style( $post_id, $color_4, 4 );
}

if ( ! empty( $css ) ) {
	$this->load_css( $css );
}
?>
<div class="sttf-container sttf-l sttf-l1" id="sttf-l1-<?php echo esc_attr( $post_id ); ?>">
	<div class="sttf-timeline">
	<?php
	if ( $events_query->have_posts() ) {
		while ( $events_query->have_posts() ) {
			$events_query->the_post();

			$event_id	 = get_the_ID();
			$event_title = get_the_title();
			$event_desc  = get_the_content();
			$event_url   = get_post_meta( $event_id, 'event_url', true );
			$event_icon  = get_post_meta( $event_id, 'event_icon', true );
			$event_date  = get_post_meta( $event_id, 'event_date', true );
		?>
		<div class="sttf-event" id="sttf-event-<?php echo esc_attr( $event_id ); ?>">
			<div class="sttf-event-content">
				<?php if ( $event_url ) { ?>
				<a href="<?php echo esc_url( $event_url ); ?>"<?php echo esc_attr( $target_blank ); ?> class="sttf-event-link">
				<?php } ?>
					<div class="sttf-event-date"><?php echo esc_html( $event_date ); ?></div>
					<?php if ( $event_icon ) { ?>
					<div class="sttf-event-icon"><i class="<?php echo esc_attr( $event_icon ); ?>"></i></div>
					<?php } ?>
					<h3 class="sttf-event-title"><?php echo esc_html( $event_title ); ?></h3>
					<p class="sttf-event-desc"><?php echo esc_html( $event_desc ); ?></p>
				<?php if ( $event_url ) { ?>
				</a>
				<?php } ?>
			</div>
		</div>
		<?php
		}
		wp_reset_postdata();
	}
	?>
	</div>
</div>
