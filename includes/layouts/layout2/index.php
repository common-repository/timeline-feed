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
$main_background_color = $layout_settings['main_background_color'];
$side_background_color = $layout_settings['side_background_color'];
$timeline_border_color = $layout_settings['timeline_border_color'];
$title_font_color      = $layout_settings['title_font_color'];
$desc_font_color       = $layout_settings['desc_font_color'];
$dashed_border_color   = $layout_settings['dashed_border_color'];
$date_font_color       = $layout_settings['date_font_color'];
$main_border_radius    = $layout_settings['main_border_radius'];
$timeline_padding      = $layout_settings['timeline_padding'];

$css = '';
// General settings.
if ( ! $title_underline ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-title { text-decoration: none; } ';
}
if ( $title_letter_spacing ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-title { letter-spacing: 1px; } ';
}
if ( $desc_letter_spacing ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-desc { letter-spacing: 1px; } ';
}
if ( $default_general['title_font_weight'] !== $title_font_weight ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-title { font-weight: ' . esc_attr( $title_font_weight ) . '; } ';
}
if ( $default_general['desc_font_weight'] !== $desc_font_weight ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-desc { font-weight: ' . esc_attr( $desc_font_weight ) . '; } ';
}
if ( $default_general['desc_line_height'] !== $desc_line_height ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-desc { line-height: ' . esc_attr( $desc_line_height ) . '; } ';
}

// Layout settings.
if ( $default['main_background_color'] !== $main_background_color ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline { background-color: ' . sanitize_hex_color( $main_background_color ) . '; } #sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-content::after { background-color: ' . sanitize_hex_color( $main_background_color ) . '; } ';
}
if ( $default['side_background_color'] !== $side_background_color ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' { background-color: ' . sanitize_hex_color( $side_background_color ) . '; } ';
}
if ( $default['timeline_border_color'] !== $timeline_border_color ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline:after { background-color: ' . sanitize_hex_color( $timeline_border_color ) . '; } #sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-content::after { border-color: ' . sanitize_hex_color( $timeline_border_color ) . '; } ';
}
if ( $default['title_font_color'] !== $title_font_color ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-title { color: ' . sanitize_hex_color( $title_font_color ) . '; } ';
}
if ( $default['desc_font_color'] !== $desc_font_color ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-desc { color: ' . sanitize_hex_color( $desc_font_color ) . '; } ';
}
if ( $default['dashed_border_color'] !== $dashed_border_color ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-content { border-bottom-color: ' . sanitize_hex_color( $dashed_border_color ) . '; } ';
}
if ( $default['date_font_color'] !== $date_font_color ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-icon { color: ' . sanitize_hex_color( $date_font_color ) . '; } #sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event-date { color: ' . sanitize_hex_color( $date_font_color ) . '; } ';
}
if ( $default['main_border_radius'] !== $main_border_radius ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' .sttf-timeline { border-top-right-radius: ' . absint( $main_border_radius ) . 'px; border-bottom-right-radius: ' . absint( $main_border_radius ) . 'px; } ';
}
if ( $default['timeline_padding'] !== $timeline_padding ) {
	$css .= '#sttf-l2-' . esc_attr( $post_id ) . ' { padding-top: ' . absint( $timeline_padding ) . 'px; padding-right: ' . absint( $timeline_padding ) . 'px; padding-bottom: ' . absint( $timeline_padding ) . 'px; } ';
}

if ( ! empty( $css ) ) {
	$this->load_css( $css );
}
?>
<div class="sttf-container sttf-l sttf-l2" id="sttf-l2-<?php echo esc_attr( $post_id ); ?>">
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
