<?php
/**
 * OceanWP CSS Variables Output.
 *
 * @package OceanWP WordPress theme
 * @since 4.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * OceanWP CSS variables class.
 */
class OceanWP_CSS_Variables {

	/**
	 * Version where new defaults are introduced.
	 *
	 * Existing installs before this version keep old defaults.
	 */
	const COMPAT_VERSION = '4.2.0';

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'ocean_head_css', array( $this, 'generate_css' ), 1 );
	}

	/**
	 * Generate CSS variables.
	 *
	 * @param string $output CSS output.
	 * @return string
	 */
	public function generate_css( $output ) {

		$desktop_vars = array();
		$tablet_vars  = array();
		$mobile_vars  = array();

		foreach ( $this->get_token_map() as $token ) {
			$value = $this->get_token_value( $token );

			if ( '' === $value || null === $value ) {
				continue;
			}

			$media = isset( $token['media'] ) ? $token['media'] : 'desktop';

			if ( 'tablet' === $media ) {
				$tablet_vars[ $token['var'] ] = $value;
			} elseif ( 'mobile' === $media ) {
				$mobile_vars[ $token['var'] ] = $value;
			} else {
				$desktop_vars[ $token['var'] ] = $value;
			}
		}

		$css = '';

		if ( ! empty( $desktop_vars ) ) {
			$css .= $this->build_root_css( $desktop_vars );
		}

		if ( ! empty( $tablet_vars ) ) {
			$css .= '@media screen and (max-width: 768px){';
			$css .= $this->build_root_css( $tablet_vars );
			$css .= '}';
		}

		if ( ! empty( $mobile_vars ) ) {
			$css .= '@media screen and (max-width: 480px){';
			$css .= $this->build_root_css( $mobile_vars );
			$css .= '}';
		}

		if ( ! empty( $css ) ) {
			$output .= '/* CSS Variables */' . $css;
		}

		return $output;
	}

	/**
	 * Build :root CSS.
	 *
	 * @param array $vars CSS variables.
	 * @return string
	 */
	private function build_root_css( $vars ) {

		$css = ':root{';

		foreach ( $vars as $name => $value ) {
			$name  = $this->sanitize_css_variable_name( $name );
			$value = $this->sanitize_css_value( $value );

			if ( '' === $name || '' === $value ) {
				continue;
			}

			$css .= $name . ':' . $value . ';';
		}

		$css .= '}';

		return $css;
	}

	/**
	 * Get token value.
	 *
	 * Priority:
	 * 1. User-saved Customizer value.
	 * 2. Old default for existing installs.
	 * 3. New default for new installs.
	 *
	 * @param array $token Token data.
	 * @return string
	 */
	private function get_token_value( $token ) {

		$setting     = isset( $token['setting'] ) ? $token['setting'] : '';
		$old_default = isset( $token['old'] ) ? $token['old'] : '';
		$new_default = isset( $token['new'] ) ? $token['new'] : $old_default;
		$type        = isset( $token['type'] ) ? $token['type'] : 'text';

		$default = $this->get_compatible_default( $old_default, $new_default );

		if ( $setting ) {
			$value = $this->get_theme_mod_value( $setting, $default );
		} else {
			$value = $default;
		}

		if ( '' === $value || null === $value ) {
			return '';
		}

		if ( 'size' === $type ) {
			$value = $this->maybe_add_unit( $value, $token );
		}

		return $this->sanitize_token_value( $value, $type );
	}

	/**
	 * Get old or new default.
	 *
	 * @param mixed $old_default Old default.
	 * @param mixed $new_default New default.
	 * @return mixed
	 */
	private function get_compatible_default( $old_default, $new_default ) {

		if ( function_exists( 'oceanwp_is_existing_installation' ) && oceanwp_is_existing_installation( self::COMPAT_VERSION ) ) {
			return $old_default;
		}

		return $new_default;
	}

	/**
	 * Get theme mod value.
	 *
	 * Supports normal settings:
	 * ocean_theme_button_color
	 *
	 * And array settings:
	 * button_typography[font-size]
	 *
	 * @param string $setting Setting ID.
	 * @param mixed  $default Default value.
	 * @return mixed
	 */
	private function get_theme_mod_value( $setting, $default = '' ) {

		if ( false === strpos( $setting, '[' ) ) {
			return get_theme_mod( $setting, $default );
		}

		preg_match( '/^([^\[]+)\[([^\]]+)\]$/', $setting, $matches );

		if ( empty( $matches[1] ) || empty( $matches[2] ) ) {
			return $default;
		}

		$theme_mod = get_theme_mod( $matches[1], array() );
		$key       = $matches[2];

		if ( ! is_array( $theme_mod ) || ! array_key_exists( $key, $theme_mod ) || '' === $theme_mod[ $key ] || null === $theme_mod[ $key ] ) {
			return $default;
		}

		return $theme_mod[ $key ];
	}

	/**
	 * Maybe add unit to size values.
	 *
	 * @param mixed $value Value.
	 * @param array $token Token data.
	 * @return string
	 */
	private function maybe_add_unit( $value, $token ) {

		$value = trim( (string) $value );

		if ( '' === $value ) {
			return '';
		}

		// Already has a CSS unit or CSS function.
		if ( preg_match( '/(px|em|rem|%|vw|vh|pt|ch|ex|clamp\(|calc\(|min\(|max\()/i', $value ) ) {
			return $value;
		}

		$unit = isset( $token['unit'] ) ? $token['unit'] : '';

		if ( isset( $token['unit_setting'] ) && $token['unit_setting'] ) {
			$old_unit = isset( $token['old_unit'] ) ? $token['old_unit'] : $unit;
			$new_unit = isset( $token['new_unit'] ) ? $token['new_unit'] : $unit;
			$default  = $this->get_compatible_default( $old_unit, $new_unit );

			$unit = $this->get_theme_mod_value( $token['unit_setting'], $default );
		}

		if ( '' === $unit ) {
			return $value;
		}

		return $value . $unit;
	}

	/**
	 * Sanitize token value.
	 *
	 * @param mixed  $value Value.
	 * @param string $type  Value type.
	 * @return string
	 */
	private function sanitize_token_value( $value, $type ) {

		$value = trim( (string) $value );

		if ( '' === $value ) {
			return '';
		}

		switch ( $type ) {
			case 'color':
				// Supports hex, rgb(), rgba(), hsl(), hsla(), currentColor, transparent.
				if ( preg_match( '/^(#([A-Fa-f0-9]{3}){1,2}|rgb[a]?\([0-9.,%\s]+\)|hsl[a]?\([0-9.,%\s]+\)|transparent|currentColor)$/', $value ) ) {
					return $value;
				}
				return '';

			case 'size':
				// Supports 14px, 1.2em, 100%, clamp(), calc(), etc.
				if ( preg_match( '/^[0-9.\-+\s%a-zA-Z(),\/]+$/', $value ) ) {
					return $value;
				}
				return '';

			case 'number':
				if ( is_numeric( $value ) ) {
					return $value;
				}
				return '';

			case 'font-family':
				return sanitize_text_field( $value );

			case 'keyword':
				return sanitize_key( $value );

			default:
				return sanitize_text_field( $value );
		}
	}

	/**
	 * Sanitize CSS variable name.
	 *
	 * @param string $name Variable name.
	 * @return string
	 */
	private function sanitize_css_variable_name( $name ) {

		$name = trim( (string) $name );

		if ( preg_match( '/^--[a-zA-Z0-9\-_]+$/', $name ) ) {
			return $name;
		}

		return '';
	}

	/**
	 * Sanitize final CSS value.
	 *
	 * @param string $value CSS value.
	 * @return string
	 */
	private function sanitize_css_value( $value ) {

		$value = trim( (string) $value );

		// Avoid breaking out of declarations.
		$value = str_replace( array( ';', '{', '}' ), '', $value );

		return $value;
	}

	/**
	 * CSS token map.
	 *
	 * This is the only place where you add new variables.
	 *
	 * @return array
	 */
	private function get_token_map() {

		return array(

			/*
			 * Buttons: colors.
			 */
			array(
				'var'     => '--owp-button-bg-color',
				'setting' => 'ocean_theme_button_bg',
				'old'     => '#13aff0',
				'new'     => '#13aff0',
				'type'    => 'color',
			),
			array(
				'var'     => '--owp-button-bg-color-hover',
				'setting' => 'ocean_theme_button_hover_bg',
				'old'     => '#0b7cac',
				'new'     => '#0b7cac',
				'type'    => 'color',
			),
			array(
				'var'     => '--owp-button-text-color',
				'setting' => 'ocean_theme_button_color',
				'old'     => '#ffffff',
				'new'     => '#000000',
				'type'    => 'color',
			),
			array(
				'var'     => '--owp-button-text-color-hover',
				'setting' => 'ocean_theme_button_hover_color',
				'old'     => '#ffffff',
				'new'     => '#000000',
				'type'    => 'color',
			),
			array(
				'var'     => '--owp-button-border-color',
				'setting' => 'ocean_theme_button_border_color',
				'old'     => '',
				'new'     => '',
				'type'    => 'color',
			),
			array(
				'var'     => '--owp-button-border-color-hover',
				'setting' => 'ocean_theme_button_border_hover_color',
				'old'     => '',
				'new'     => '',
				'type'    => 'color',
			),

			/*
			 * Buttons: spacing.
			 * These are existing settings from style-settings.php.
			 */
			array(
				'var'     => '--owp-button-padding-top',
				'setting' => 'ocean_theme_button_top_padding',
				'old'     => '14',
				'new'     => '14',
				'type'    => 'size',
				'unit'    => 'px',
			),
			array(
				'var'     => '--owp-button-padding-right',
				'setting' => 'ocean_theme_button_right_padding',
				'old'     => '20',
				'new'     => '20',
				'type'    => 'size',
				'unit'    => 'px',
			),
			array(
				'var'     => '--owp-button-padding-bottom',
				'setting' => 'ocean_theme_button_bottom_padding',
				'old'     => '14',
				'new'     => '14',
				'type'    => 'size',
				'unit'    => 'px',
			),
			array(
				'var'     => '--owp-button-padding-left',
				'setting' => 'ocean_theme_button_left_padding',
				'old'     => '20',
				'new'     => '20',
				'type'    => 'size',
				'unit'    => 'px',
			),

			/*
			 * Buttons: typography.
			 * Existing Customizer setting IDs are array-style:
			 * button_typography[font-size]
			 * button_typography[font-size-unit]
			 */
			array(
				'var'          => '--owp-button-font-size',
				'setting'      => 'button_typography[font-size]',
				'unit_setting' => 'button_typography[font-size-unit]',
				'old'          => '12',
				'new'          => '14',
				'old_unit'     => 'px',
				'new_unit'     => 'px',
				'type'         => 'size',
			),
			array(
				'var'     => '--owp-button-font-weight',
				'setting' => 'button_typography[font-weight]',
				'old'     => '600',
				'new'     => '600',
				'type'    => 'text',
			),
			array(
				'var'          => '--owp-button-letter-spacing',
				'setting'      => 'button_typography[letter-spacing]',
				'unit_setting' => 'button_typography[letter-spacing-unit]',
				'old'          => '0.1',
				'new'          => '0.05',
				'old_unit'     => 'em',
				'new_unit'     => 'em',
				'type'         => 'size',
			),
			array(
				'var'     => '--owp-button-line-height',
				'setting' => 'button_typography[line-height]',
				'old'     => '1',
				'new'     => '1.2',
				'type'    => 'number',
			),
			array(
				'var'     => '--owp-button-text-transform',
				'setting' => 'button_typography[text-transform]',
				'old'     => 'uppercase',
				'new'     => 'none',
				'type'    => 'keyword',
			),

			/*
			 * Buttons: responsive typography examples.
			 * These only print if a user has saved tablet/mobile values,
			 * otherwise they use empty defaults and do nothing.
			 */
			array(
				'var'          => '--owp-button-font-size',
				'setting'      => 'button_tablet_typography[font-size]',
				'unit_setting' => 'button_typography[font-size-unit]',
				'old'          => '',
				'new'          => '',
				'old_unit'     => 'px',
				'new_unit'     => 'px',
				'type'         => 'size',
				'media'        => 'tablet',
			),
			array(
				'var'          => '--owp-button-font-size',
				'setting'      => 'button_mobile_typography[font-size]',
				'unit_setting' => 'button_typography[font-size-unit]',
				'old'          => '',
				'new'          => '',
				'old_unit'     => 'px',
				'new_unit'     => 'px',
				'type'         => 'size',
				'media'        => 'mobile',
			),

			/*
			 * Forms: colors.
			 */
			array(
				'var'     => '--owp-input-text-color',
				'setting' => 'ocean_input_color',
				'old'     => '#333333',
				'new'     => '#333333',
				'type'    => 'color',
			),
			array(
				'var'     => '--owp-input-border-color',
				'setting' => 'ocean_input_border_color',
				'old'     => '#dddddd',
				'new'     => '#767676',
				'type'    => 'color',
			),
			array(
				'var'     => '--owp-input-border-color-focus',
				'setting' => 'ocean_input_border_color_focus',
				'old'     => '#bbbbbb',
				'new'     => '#333333',
				'type'    => 'color',
			),

			/*
			 * Forms: size examples.
			 */
			array(
				'var'     => '--owp-input-font-size',
				'setting' => '',
				'old'     => '14',
				'new'     => '16',
				'type'    => 'size',
				'unit'    => 'px',
			),
			array(
				'var'     => '--owp-input-line-height',
				'setting' => '',
				'old'     => '1.8',
				'new'     => '1.6',
				'type'    => 'number',
			),
			array(
				'var'     => '--owp-input-border-radius',
				'setting' => 'ocean_input_border_top_left_radius',
				'old'     => '3',
				'new'     => '3',
				'type'    => 'size',
				'unit'    => 'px',
			),

			/*
			 * Accessibility/internal variables.
			 * No Customizer setting required.
			 */
			array(
				'var'     => '--owp-focus-outline-width',
				'setting' => '',
				'old'     => '0',
				'new'     => '2',
				'type'    => 'size',
				'unit'    => 'px',
			),
			array(
				'var'     => '--owp-focus-outline-offset',
				'setting' => '',
				'old'     => '0',
				'new'     => '2',
				'type'    => 'size',
				'unit'    => 'px',
			),
			array(
				'var'     => '--owp-focus-outline-color',
				'setting' => 'ocean_primary_color',
				'old'     => '#13aff0',
				'new'     => '#000000',
				'type'    => 'color',
			),
		);
	}
}

return new OceanWP_CSS_Variables();
