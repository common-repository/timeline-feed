<?php
namespace TimelineFeed\Core\Classes\Layouts;

use TimelineFeed\Core\Classes\BaseLayout;
use TimelineFeed\Core\Contracts\LayoutInterface;

defined( 'ABSPATH' ) || die();

class Layout3 extends BaseLayout implements LayoutInterface {
	const LABEL = 3;

	public function save_settings( $post_id ) {
		$default = $this->default_settings();

		$background_color   = isset( $_POST['l3_background_color'] ) ? sanitize_hex_color( $_POST['l3_background_color'] ) : $default['background_color'];
		$color_1_gradient_1 = isset( $_POST['l3_color_1_gradient_1'] ) ? sanitize_hex_color( $_POST['l3_color_1_gradient_1'] ) : $default['color_1_gradient_1'];
		$color_1_gradient_2 = isset( $_POST['l3_color_1_gradient_2'] ) ? sanitize_hex_color( $_POST['l3_color_1_gradient_2'] ) : $default['color_1_gradient_2'];
		$color_2_gradient_1 = isset( $_POST['l3_color_2_gradient_1'] ) ? sanitize_hex_color( $_POST['l3_color_2_gradient_1'] ) : $default['color_2_gradient_1'];
		$color_2_gradient_2 = isset( $_POST['l3_color_2_gradient_2'] ) ? sanitize_hex_color( $_POST['l3_color_2_gradient_2'] ) : $default['color_2_gradient_2'];
		$color_3_gradient_1 = isset( $_POST['l3_color_3_gradient_1'] ) ? sanitize_hex_color( $_POST['l3_color_3_gradient_1'] ) : $default['color_3_gradient_1'];
		$color_3_gradient_2 = isset( $_POST['l3_color_3_gradient_2'] ) ? sanitize_hex_color( $_POST['l3_color_3_gradient_2'] ) : $default['color_3_gradient_2'];
		$color_4_gradient_1 = isset( $_POST['l3_color_4_gradient_1'] ) ? sanitize_hex_color( $_POST['l3_color_4_gradient_1'] ) : $default['color_4_gradient_1'];
		$color_4_gradient_2 = isset( $_POST['l3_color_4_gradient_2'] ) ? sanitize_hex_color( $_POST['l3_color_4_gradient_2'] ) : $default['color_4_gradient_2'];

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
			'background_color'   => '#ffffff',
			'color_1_gradient_1' => '#d62053',
			'color_1_gradient_2' => '#af2850',
			'color_2_gradient_1' => '#fc8d44',
			'color_2_gradient_2' => '#fc7114',
			'color_3_gradient_1' => '#1071b2',
			'color_3_gradient_2' => '#0a5c96',
			'color_4_gradient_1' => '#3fb1ea',
			'color_4_gradient_2' => '#3da6dc',
		);
	}

	public function load_color_style( $post_id, $color_gradient_1, $color_gradient_2, $offset ) {
		return '#sttf-l3-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event:nth-child(4n+' . esc_attr( $offset ) . ') .sttf-event-content { background: -webkit-linear-gradient(left, ' . sanitize_hex_color( $color_gradient_1 ) . ', ' . sanitize_hex_color( $color_gradient_2 ) . '); background: -o-linear-gradient(left, ' . sanitize_hex_color( $color_gradient_1 ) . ', ' . sanitize_hex_color( $color_gradient_2 ) . '); background: linear-gradient(to right, ' . sanitize_hex_color( $color_gradient_1 ) . ', ' . sanitize_hex_color( $color_gradient_2 ) . '); } #sttf-l3-' . esc_attr( $post_id ) . ' .sttf-timeline .sttf-event:nth-child(4n+' . esc_attr( $offset ) . ') .sttf-event-icon { background: -webkit-linear-gradient(35deg, ' . sanitize_hex_color( $color_gradient_1 ) . ', ' . sanitize_hex_color( $color_gradient_2 ) . '); background: -o-linear-gradient(35deg, ' . sanitize_hex_color( $color_gradient_1 ) . ', ' . sanitize_hex_color( $color_gradient_2 ) . '); background: linear-gradient(125deg, ' . sanitize_hex_color( $color_gradient_1 ) . ', ' . sanitize_hex_color( $color_gradient_2 ) . '); } ';
	}
}
