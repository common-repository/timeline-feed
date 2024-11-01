<?php
namespace TimelineFeed\Core\Classes\Layouts;

use TimelineFeed\Core\Classes\BaseLayout;
use TimelineFeed\Core\Contracts\LayoutInterface;

defined( 'ABSPATH' ) || die();

class Layout1 extends BaseLayout implements LayoutInterface {
	const LABEL = 1;

	public function save_settings( $post_id ) {
		$default = $this->default_settings();

		$background_color = isset( $_POST['l1_background_color'] ) ? sanitize_hex_color( $_POST['l1_background_color'] ) : $default['background_color'];
		$color_1          = isset( $_POST['l1_color_1'] ) ? sanitize_hex_color( $_POST['l1_color_1'] ) : $default['l1_color_1'];
		$color_2          = isset( $_POST['l1_color_2'] ) ? sanitize_hex_color( $_POST['l1_color_2'] ) : $default['l1_color_2'];
		$color_3          = isset( $_POST['l1_color_3'] ) ? sanitize_hex_color( $_POST['l1_color_3'] ) : $default['l1_color_3'];
		$color_4          = isset( $_POST['l1_color_4'] ) ? sanitize_hex_color( $_POST['l1_color_4'] ) : $default['l1_color_4'];

		$settings = compact(
			'background_color',
			'color_1',
			'color_2',
			'color_3',
			'color_4'
		);

		update_post_meta( $post_id, $this->get_settings_key(), $settings );
	}

	public function load_settings( $post_id ) {
		$default = $this->default_settings();

		$settings = get_post_meta( $post_id, $this->get_settings_key(), true );

		if ( ! is_array( $settings ) ) {
			$settings = array();
		}

		$background_color = isset( $settings['background_color'] ) ? sanitize_hex_color( $settings['background_color'] ) : $default['background_color'];
		$color_1          = isset( $settings['color_1'] ) ? sanitize_hex_color( $settings['color_1'] ) : $default['color_1'];
		$color_2          = isset( $settings['color_2'] ) ? sanitize_hex_color( $settings['color_2'] ) : $default['color_2'];
		$color_3          = isset( $settings['color_3'] ) ? sanitize_hex_color( $settings['color_3'] ) : $default['color_3'];
		$color_4          = isset( $settings['color_4'] ) ? sanitize_hex_color( $settings['color_4'] ) : $default['color_4'];

		return compact(
			'background_color',
			'color_1',
			'color_2',
			'color_3',
			'color_4'
		);
	}

	public function default_settings() {
		return array(
			'background_color' => '#f9f0ff',
			'color_1'          => '#7f45e8',
			'color_2'          => '#fe5ee6',
			'color_3'          => '#03b2ec',
			'color_4'          => '#00e984',
		);
	}

	public function load_color_style( $post_id, $color, $offset ) {
		return '#sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event:nth-child(4n+' . esc_attr( $offset ) . ') .sttf-event-content { border-left-color: ' . sanitize_hex_color( $color ) . '; } #sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event:nth-child(4n+' . esc_attr( $offset ) . ')::before, ' . '#sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event:nth-child(4n+' . esc_attr( $offset ) . ') .sttf-event-date { background-color: ' . sanitize_hex_color( $color ) . '; } #sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event:nth-child(4n+' . esc_attr( $offset ) . ') .sttf-event-icon, ' . '#sttf-l1-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event:nth-child(4n+' . esc_attr( $offset ) . ') .sttf-event-title { color: ' . sanitize_hex_color( $color ) . '; } ';
	}
}
