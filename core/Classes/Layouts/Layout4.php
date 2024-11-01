<?php
namespace TimelineFeed\Core\Classes\Layouts;

use TimelineFeed\Core\Classes\BaseLayout;
use TimelineFeed\Core\Contracts\LayoutInterface;

defined( 'ABSPATH' ) || die();

class Layout4 extends BaseLayout implements LayoutInterface {
	const LABEL = 4;

	public function save_settings( $post_id ) {
		$default = $this->default_settings();

		$background_color   = isset( $_POST['l4_background_color'] ) ? sanitize_hex_color( $_POST['l4_background_color'] ) : $default['background_color'];
		$color_1_gradient_1 = isset( $_POST['l4_color_1_gradient_1'] ) ? sanitize_hex_color( $_POST['l4_color_1_gradient_1'] ) : $default['color_1_gradient_1'];
		$color_1_gradient_2 = isset( $_POST['l4_color_1_gradient_2'] ) ? sanitize_hex_color( $_POST['l4_color_1_gradient_2'] ) : $default['color_1_gradient_2'];
		$color_2_gradient_1 = isset( $_POST['l4_color_2_gradient_1'] ) ? sanitize_hex_color( $_POST['l4_color_2_gradient_1'] ) : $default['color_2_gradient_1'];
		$color_2_gradient_2 = isset( $_POST['l4_color_2_gradient_2'] ) ? sanitize_hex_color( $_POST['l4_color_2_gradient_2'] ) : $default['color_2_gradient_2'];
		$color_3_gradient_1 = isset( $_POST['l4_color_3_gradient_1'] ) ? sanitize_hex_color( $_POST['l4_color_3_gradient_1'] ) : $default['color_3_gradient_1'];
		$color_3_gradient_2 = isset( $_POST['l4_color_3_gradient_2'] ) ? sanitize_hex_color( $_POST['l4_color_3_gradient_2'] ) : $default['color_3_gradient_2'];
		$color_4_gradient_1 = isset( $_POST['l4_color_4_gradient_1'] ) ? sanitize_hex_color( $_POST['l4_color_4_gradient_1'] ) : $default['color_4_gradient_1'];
		$color_4_gradient_2 = isset( $_POST['l4_color_4_gradient_2'] ) ? sanitize_hex_color( $_POST['l4_color_4_gradient_2'] ) : $default['color_4_gradient_2'];

		$settings = compact(
			'background_color',
			'color_1_gradient_1',
			'color_1_gradient_2',
			'color_2_gradient_1',
			'color_2_gradient_2',
			'color_3_gradient_1',
			'color_3_gradient_2',
			'color_4_gradient_1',
			'color_4_gradient_2'
		);

		update_post_meta( $post_id, $this->get_settings_key(), $settings );
	}

	public function load_settings( $post_id ) {
		$default = $this->default_settings();

		$settings = get_post_meta( $post_id, $this->get_settings_key(), true );

		if ( ! is_array( $settings ) ) {
			$settings = array();
		}

		$background_color   = isset( $settings['background_color'] ) ? sanitize_hex_color( $settings['background_color'] ) : $default['background_color'];
		$color_1_gradient_1 = isset( $settings['color_1_gradient_1'] ) ? sanitize_hex_color( $settings['color_1_gradient_1'] ) : $default['color_1_gradient_1'];
		$color_1_gradient_2 = isset( $settings['color_1_gradient_2'] ) ? sanitize_hex_color( $settings['color_1_gradient_2'] ) : $default['color_1_gradient_2'];
		$color_2_gradient_1 = isset( $settings['color_2_gradient_1'] ) ? sanitize_hex_color( $settings['color_2_gradient_1'] ) : $default['color_2_gradient_1'];
		$color_2_gradient_2 = isset( $settings['color_2_gradient_2'] ) ? sanitize_hex_color( $settings['color_2_gradient_2'] ) : $default['color_2_gradient_2'];
		$color_3_gradient_1 = isset( $settings['color_3_gradient_1'] ) ? sanitize_hex_color( $settings['color_3_gradient_1'] ) : $default['color_3_gradient_1'];
		$color_3_gradient_2 = isset( $settings['color_3_gradient_2'] ) ? sanitize_hex_color( $settings['color_3_gradient_2'] ) : $default['color_3_gradient_2'];
		$color_4_gradient_1 = isset( $settings['color_4_gradient_1'] ) ? sanitize_hex_color( $settings['color_4_gradient_1'] ) : $default['color_4_gradient_1'];
		$color_4_gradient_2 = isset( $settings['color_4_gradient_2'] ) ? sanitize_hex_color( $settings['color_4_gradient_2'] ) : $default['color_4_gradient_2'];

		return compact(
			'background_color',
			'color_1_gradient_1',
			'color_1_gradient_2',
			'color_2_gradient_1',
			'color_2_gradient_2',
			'color_3_gradient_1',
			'color_3_gradient_2',
			'color_4_gradient_1',
			'color_4_gradient_2'
		);
	}

	public function default_settings() {
		return array(
			'background_color'   => '#dfdfdf',
			'color_1_gradient_1' => '#734a91',
			'color_1_gradient_2' => '#b371c6',
			'color_2_gradient_1' => '#1c6f82',
			'color_2_gradient_2' => '#4491a2',
			'color_3_gradient_1' => '#4e5db2',
			'color_3_gradient_2' => '#7582d1',
			'color_4_gradient_1' => '#525156',
			'color_4_gradient_2' => '#686c75',
		);
	}

	public function load_color_style( $post_id, $color_gradient_1, $color_gradient_2, $offset ) {
		return '#sttf-l4-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event:nth-child(4n+' . esc_attr( $offset ) . ')::after { background-color: ' . sanitize_hex_color( $color_gradient_1 ) . '; } #sttf-l4-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event:nth-child(4n+' . esc_attr( $offset ) . ') .sttf-event-content { background: -webkit-linear-gradient(left, ' . sanitize_hex_color( $color_gradient_1 ) . ', ' . sanitize_hex_color( $color_gradient_2 ) . '); background: -o-linear-gradient(left, ' . sanitize_hex_color( $color_gradient_1 ) . ', ' . sanitize_hex_color( $color_gradient_2 ) . '); background: linear-gradient(to right, ' . sanitize_hex_color( $color_gradient_1 ) . ', ' . sanitize_hex_color( $color_gradient_2 ) . '); } ';
	}
}
