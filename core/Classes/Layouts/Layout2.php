<?php
namespace TimelineFeed\Core\Classes\Layouts;

use TimelineFeed\Core\Classes\BaseLayout;
use TimelineFeed\Core\Contracts\LayoutInterface;

defined( 'ABSPATH' ) || die();

class Layout2 extends BaseLayout implements LayoutInterface {
	const LABEL = 2;

	public function save_settings( $post_id ) {
		$default = $this->default_settings();

		$main_background_color = isset( $_POST['l2_main_background_color'] ) ? sanitize_hex_color( $_POST['l2_main_background_color'] ) : $default['l2_main_background_color'];
		$side_background_color = isset( $_POST['l2_side_background_color'] ) ? sanitize_hex_color( $_POST['l2_side_background_color'] ) : $default['l2_side_background_color'];
		$timeline_border_color = isset( $_POST['l2_timeline_border_color'] ) ? sanitize_hex_color( $_POST['l2_timeline_border_color'] ) : $default['l2_timeline_border_color'];
		$title_font_color      = isset( $_POST['l2_title_font_color'] ) ? sanitize_hex_color( $_POST['l2_title_font_color'] ) : $default['l2_title_font_color'];
		$desc_font_color       = isset( $_POST['l2_desc_font_color'] ) ? sanitize_hex_color( $_POST['l2_desc_font_color'] ) : $default['l2_desc_font_color'];
		$dashed_border_color   = isset( $_POST['l2_dashed_border_color'] ) ? sanitize_hex_color( $_POST['l2_dashed_border_color'] ) : $default['l2_dashed_border_color'];
		$date_font_color       = isset( $_POST['l2_date_font_color'] ) ? sanitize_hex_color( $_POST['l2_date_font_color'] ) : $default['l2_date_font_color'];
		$main_border_radius    = isset( $_POST['l2_main_border_radius'] ) ? absint( $_POST['l2_main_border_radius'] ) : $default['l2_main_border_radius'];
		$timeline_padding      = isset( $_POST['l2_timeline_padding'] ) ? absint( $_POST['l2_timeline_padding'] ) : $default['l2_timeline_padding'];

		$settings = compact(
			'main_background_color',
			'side_background_color',
			'timeline_border_color',
			'title_font_color',
			'desc_font_color',
			'dashed_border_color',
			'date_font_color',
			'main_border_radius',
			'timeline_padding'
		);

		update_post_meta( $post_id, $this->get_settings_key(), $settings );
	}

	public function load_settings( $post_id ){
		$default = $this->default_settings();

		$settings = get_post_meta( $post_id, $this->get_settings_key(), true );

		if ( ! is_array( $settings ) ) {
			$settings = array();
		}

		$main_background_color = isset( $settings['main_background_color'] ) ? sanitize_hex_color( $settings['main_background_color'] ) : $default['main_background_color'];
		$side_background_color = isset( $settings['side_background_color'] ) ? sanitize_hex_color( $settings['side_background_color'] ) : $default['side_background_color'];
		$timeline_border_color = isset( $settings['timeline_border_color'] ) ? sanitize_hex_color( $settings['timeline_border_color'] ) : $default['timeline_border_color'];
		$title_font_color      = isset( $settings['title_font_color'] ) ? sanitize_hex_color( $settings['title_font_color'] ) : $default['title_font_color'];
		$desc_font_color       = isset( $settings['desc_font_color'] ) ? sanitize_hex_color( $settings['desc_font_color'] ) : $default['desc_font_color'];
		$dashed_border_color   = isset( $settings['dashed_border_color'] ) ? sanitize_hex_color( $settings['dashed_border_color'] ) : $default['dashed_border_color'];
		$date_font_color       = isset( $settings['date_font_color'] ) ? sanitize_hex_color( $settings['date_font_color'] ) : $default['date_font_color'];
		$main_border_radius    = isset( $settings['main_border_radius'] ) ? absint( $settings['main_border_radius'] ) : $default['main_border_radius'];
		$timeline_padding      = isset( $settings['timeline_padding'] ) ? absint( $settings['timeline_padding'] ) : $default['timeline_padding'];

		return compact(
			'main_background_color',
			'side_background_color',
			'timeline_border_color',
			'title_font_color',
			'desc_font_color',
			'dashed_border_color',
			'date_font_color',
			'main_border_radius',
			'timeline_padding'
		);
	}

	public function default_settings() {
		return array(
			'main_background_color' => '#2f3331',
			'side_background_color' => '#252827',
			'timeline_border_color' => '#4298c3',
			'title_font_color'      => '#ffffff',
			'desc_font_color'       => '#c4c4c4',
			'dashed_border_color'   => '#555555',
			'date_font_color'       => '#c0c0c0',
			'main_border_radius'    => 8,
			'timeline_padding'      => 0,
		);
	}
}
