<?php
/**
 * Customizer default values
 *
 * @package OceanWP WordPress theme
 * @since 4.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'oceanwp_get_customizer_defaults_map' ) ) {

	/**
	 * Get Customizer compatibility defaults map.
	 *
	 * old = existing installs
	 * new = new installs
	 *
	 * @return array
	 */
	function oceanwp_get_customizer_defaults_map() {

		return apply_filters(
			'oceanwp_register_customizer_default_data',
			array(

                /*
                * Buttons.
                */
                'ocean_theme_button_color' => array(
                    'old' => '#ffffff',
                    'new' => '#000000',
                ),

                'ocean_theme_button_hover_color' => array(
                    'old' => '#ffffff',
                    'new' => '#000000',
                ),

                'ocean_theme_button_bg' => array(
                    'old' => '#13aff0',
                    'new' => '#13aff0',
                ),

                'ocean_theme_button_hover_bg' => array(
                    'old' => '#0b7cac',
                    'new' => '#0b7cac',
                ),

                /*
                * Button typography.
                */
                'button_typography' => array(
                    'old' => array(
                        'font-size'           => '12',
                        'font-size-unit'      => 'px',
                        'font-weight'         => '600',
                        'line-height'         => '1',
                        'letter-spacing'      => '0.1',
                        'letter-spacing-unit' => 'em',
                        'text-transform'      => 'uppercase',
                    ),
                    'new' => array(
                        'font-size'           => '14',
                        'font-size-unit'      => 'px',
                        'font-weight'         => '600',
                        'line-height'         => '1.2',
                        'letter-spacing'      => '0.05',
                        'letter-spacing-unit' => 'em',
                        'text-transform'      => 'none',
                    ),
                ),

                /*
                * Forms.
                */
                'ocean_input_border_color' => array(
                    'old' => '#dddddd',
                    'new' => '#767676',
                ),

                'ocean_input_border_color_focus' => array(
                    'old' => '#bbbbbb',
                    'new' => '#333333',
                ),

                /*
                * New internal / future settings.
                * These can be used later if you add Customizer controls.
                */
                'ocean_widget_link_color' => array(
                    'old' => '',
                    'new' => '#000000',
                ),

                'ocean_widget_link_text_decoration' => array(
                    'old' => 'none',
                    'new' => 'underline',
                ),
            )
        );
	}
}

if ( ! function_exists( 'oceanwp_get_customizer_default' ) ) {

	/**
	 * Get Customizer default with install compatibility.
	 *
	 * @param string $setting_id Setting ID.
	 * @param mixed  $fallback   Fallback default.
	 * @param string $version    Compatibility version.
	 *
	 * @return mixed
	 */
	function oceanwp_get_customizer_default( $setting_id, $fallback = '', $version = '4.2.0' ) {

		$defaults = oceanwp_get_customizer_defaults_map();

		if ( empty( $defaults[ $setting_id ] ) ) {
			return $fallback;
		}

		$is_existing_install = function_exists( 'oceanwp_is_existing_installation' )
			&& oceanwp_is_existing_installation( $version );

		if ( $is_existing_install ) {
			return isset( $defaults[ $setting_id ]['old'] )
				? $defaults[ $setting_id ]['old']
				: $fallback;
		}

		return isset( $defaults[ $setting_id ]['new'] )
			? $defaults[ $setting_id ]['new']
			: $fallback;
	}
}
