<?php
namespace TimelineFeed\Core\Classes;

defined( 'ABSPATH' ) || die();

class Setting extends BaseController {
	const GENERAL_SETTINGS = 'general_settings';

	public function save_general_settings( $post_id ) {
		$default_settings = $this->default_general_settings();

		$link_in_new_tab      = isset( $_POST['link_in_new_tab'] ) ? (bool) ( $_POST['link_in_new_tab'] ) : false;
		$title_underline      = isset( $_POST['title_underline'] ) ? (bool) $_POST['title_underline'] : false;
		$title_letter_spacing = isset( $_POST['title_letter_spacing'] ) ? (bool) $_POST['title_letter_spacing'] : false;
		$desc_letter_spacing  = isset( $_POST['desc_letter_spacing'] ) ? (bool) $_POST['desc_letter_spacing'] : false;
		$title_font_weight    = isset( $_POST['title_font_weight'] ) ? sanitize_text_field( $_POST['title_font_weight'] ) : $default_settings['title_font_weight'];
		$desc_font_weight     = isset( $_POST['desc_font_weight'] ) ? sanitize_text_field( $_POST['desc_font_weight'] ) : $default_settings['desc_font_weight'];
		$desc_line_height     = isset( $_POST['desc_line_height'] ) ? (float) ( $_POST['desc_line_height'] ) : $default_settings['desc_line_height'];

		$font_weights_keys = array_keys( $this->get_font_weights() );

		if ( ! in_array( $title_font_weight, $font_weights_keys ) ) {
			$title_font_weight = $default_settings['title_font_weight'];
		}

		if ( ! in_array( $desc_font_weight, $font_weights_keys ) ) {
			$desc_font_weight = $default_settings['desc_font_weight'];
		}

		$settings = compact(
			'link_in_new_tab',
			'title_underline',
			'title_letter_spacing',
			'desc_letter_spacing',
			'title_font_weight',
			'desc_font_weight',
			'desc_line_height'
		);

		update_post_meta( $post_id, self::GENERAL_SETTINGS, $settings );
	}

	public function load_general_settings( $post_id ) {
		$default_settings = $this->default_general_settings();

		$settings = get_post_meta( $post_id, self::GENERAL_SETTINGS, true );

		if ( ! is_array( $settings ) ) {
			$settings = array();
		}

		$link_in_new_tab      = isset( $settings['link_in_new_tab'] ) ? (bool) $settings['link_in_new_tab'] : $default_settings['link_in_new_tab'];
		$title_underline      = isset( $settings['title_underline'] ) ? (bool) $settings['title_underline'] : $default_settings['title_underline'];
		$title_letter_spacing = isset( $settings['title_letter_spacing'] ) ? (bool) $settings['title_letter_spacing'] : $default_settings['title_letter_spacing'];
		$desc_letter_spacing  = isset( $settings['desc_letter_spacing'] ) ? (bool) $settings['desc_letter_spacing'] : $default_settings['desc_letter_spacing'];
		$title_font_weight    = isset( $settings['title_font_weight'] ) ? esc_attr( $settings['title_font_weight'] ) : $default_settings['title_font_weight'];
		$desc_font_weight     = isset( $settings['desc_font_weight'] ) ? esc_attr( $settings['desc_font_weight'] ) : $default_settings['desc_font_weight'];
		$desc_line_height     = isset( $settings['desc_line_height'] ) ? (float) ( $settings['desc_line_height'] ) : $default_settings['desc_line_height'];

		$font_weights_keys = array_keys( $this->get_font_weights() );

		if ( ! in_array( $title_font_weight, $font_weights_keys ) ) {
			$title_font_weight = $default_settings['title_font_weight'];
		}

		if ( ! in_array( $desc_font_weight, $font_weights_keys ) ) {
			$desc_font_weight = $default_settings['desc_font_weight'];
		}

		return compact(
			'link_in_new_tab',
			'title_underline',
			'title_letter_spacing',
			'desc_letter_spacing',
			'title_font_weight',
			'desc_font_weight',
			'desc_line_height'
		);
	}

	public function default_general_settings() {
		return array(
			'link_in_new_tab'      => true,
			'title_underline'      => true,
			'title_letter_spacing' => false,
			'desc_letter_spacing'  => false,
			'title_font_weight'    => 'bold',
			'desc_font_weight'     => 'normal',
			'desc_line_height'     => 1.4,
		);
	}

	public function get_font_weights() {
		return array(
			'normal' => __( 'Normal', 'timeline-feed' ),
			'bold'   => __( 'Bold', 'timeline-feed' ),
			'400'    => __( '400', 'timeline-feed' ),
			'500'    => __( '500', 'timeline-feed' ),
			'600'    => __( '600', 'timeline-feed' ),
			'700'    => __( '700', 'timeline-feed' ),
		);
	}
}
