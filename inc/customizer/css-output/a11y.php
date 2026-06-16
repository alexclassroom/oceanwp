<?php
/**
 * OceanWP Customizer CSS Output for Accessibility
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The OceanWP Customizer class
 */
class OceanWP_Customize_A11Y_CSS {

	/**
	 * fonts
	 *
	 * @var $fonts
	 * @access private
	 * @since 3.5.1
	 */
	private $fonts = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		// add_filter('ocean_a11y_css', array($this, 'generate_css'));

		add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_css' ), 999 );
	}

	public function add_inline_css() {

		if ( true !== get_theme_mod( 'ocean_accessibility_mode', ocean_accessibility_get_default_value() ) ) {
			return;
		}

		wp_add_inline_style(
			'oceanwp-a11y-style',
			$this->generate_css()
		);
	}

	public function generate_css() {

        $search_form_label_size					 = get_theme_mod( 'ocean_custom_header_search_form_label_size', '' );
		$search_form_label_size_tablet		     = get_theme_mod( 'ocean_custom_header_search_form_label_size_tablet', '' );
		$search_form_label_size_mobile			 = get_theme_mod( 'ocean_custom_header_search_form_label_size_mobile', '' );
		$search_form_label_size_unit			 = get_theme_mod( 'ocean_custom_header_search_form_label_size_unit', 'px' );
		$search_form_label_color                 = get_theme_mod( 'ocean_custom_header_search_form_label_color', '' );

        $comment_form_label_size			     = get_theme_mod( 'ocean_comment_form_label_size', '' );
		$comment_form_label_size_tablet		     = get_theme_mod( 'ocean_comment_form_label_size_tablet', '' );
		$comment_form_label_size_mobile			 = get_theme_mod( 'ocean_comment_form_label_size_mobile', '' );
		$comment_form_label_size_unit			 = get_theme_mod( 'ocean_comment_form_label_size_unit', 'px' );
		$comment_form_label_color                = get_theme_mod( 'ocean_comment_form_label_color', '' );
        $comment_form_label_ie_color             = get_theme_mod( 'ocean_comment_form_label_ie_color', '' );


		$header_social_external_icon_size		 = get_theme_mod( 'ocean_header_social_external_icon_size', 0.72 );
		$header_social_external_icon_size_tablet = get_theme_mod( 'ocean_header_social_external_icon_size_tablet', '' );
		$header_social_external_icon_size_mobile = get_theme_mod( 'ocean_header_social_external_icon_size_mobile', '' );
		$header_social_external_icon_x_offset    = get_theme_mod( 'ocean_header_social_external_icon_x_offset', -0.15 );
		$header_social_external_icon_y_offset    = get_theme_mod( 'ocean_header_social_external_icon_y_offset', -0.25 );
		$header_social_external_icon_color       = get_theme_mod( 'ocean_header_social_external_icon_color', '#ffffff' );
        $header_social_external_icon_color_hover = get_theme_mod( 'ocean_header_social_external_icon_background_color', '#000000' );
			
		$css = '';

		if ( ! empty( $search_form_label_size ) ) {
			$css .= '.header-search-visible-label,.medium-header-search-visible-label,.vertical-header-search-visible-label,.mobile-fs-search-visible-label,.oceanwp-mobile-menu-search-visible-label{font-size:'. $search_form_label_size . $search_form_label_size_unit . ';}';
		}

		if ( ! empty( $search_form_label_size_tablet ) ) {
			$css .= '@media (max-width: 768px){.header-search-visible-label,.medium-header-search-visible-label,.vertical-header-search-visible-label,.mobile-fs-search-visible-label,.oceanwp-mobile-menu-search-visible-label{font-size:'. $search_form_label_size_tablet . $search_form_label_size_unit . ';}}';
		}

		if ( ! empty( $search_form_label_size_mobile ) ) {
			$css .= '@media (max-width: 480px){.header-search-visible-label,.medium-header-search-visible-label,.vertical-header-search-visible-label,.mobile-fs-search-visible-label,.oceanwp-mobile-menu-search-visible-label{font-size:'. $search_form_label_size_mobile . $search_form_label_size_unit . ';}}';
		}

		if ( ! empty( $search_form_label_color ) ) {
			$css .= '.header-search-visible-label,.medium-header-search-visible-label,.vertical-header-search-visible-label,.mobile-dropdown-search-visible-label,.mobile-fs-search-visible-label,.oceanwp-mobile-menu-search-visible-label{color:' . $search_form_label_color . ';}';
		}

        if ( ! empty( $comment_form_label_size ) ) {
			$css .= '.comment-form-visible-label{font-size:'. $comment_form_label_size . $comment_form_label_size_unit . ';}';
		}

		if ( ! empty( $comment_form_label_size_tablet ) ) {
			$css .= '@media (max-width: 768px){.comment-form-visible-label{font-size:'. $comment_form_label_size_tablet . $comment_form_label_size_unit . ';}}';
		}

		if ( ! empty( $comment_form_label_size_mobile ) ) {
			$css .= '@media (max-width: 480px){.comment-form-visible-label{font-size:'. $comment_form_label_size_mobile . $comment_form_label_size_unit . ';}}';
		}

		if ( ! empty( $comment_form_label_color ) ) {
			$css .= '.comment-form-visible-label{color:' . $comment_form_label_color . ';}';
		}

        if ( ! empty( $comment_form_label_ie_color ) ) {
			$css .= '.comment-form-visible-label span{color:' . $comment_form_label_ie_color . ';}';
		}

		if ( ! empty( $header_social_external_icon_size ) ) {
			$css .= '.header-social-menu-external-mark{--ocean-social-external-mark-size:'. $header_social_external_icon_size . 'em;}';
			$css .= '.header-social-menu-external-mark{--ocean-social-external-mark-size:'. $header_social_external_icon_size . 'em;}';
		}

		if ( ! empty( $header_social_external_icon_size_tablet ) ) {
			$css .= '@media (max-width: 768px){
				.header-social-menu-external-mark{--ocean-social-external-mark-size:'. $header_social_external_icon_size_tablet . 'em;}
				.header-social-menu-external-mark{--ocean-social-external-mark-size:'. $header_social_external_icon_size_tablet . 'em;}
			}';
		}

		if ( ! empty( $header_social_external_icon_size_mobile ) ) {
			$css .= '@media (max-width: 480px){
				.header-social-menu-external-mark{--ocean-social-external-mark-size:'. $header_social_external_icon_size_mobile . 'em;}
				.header-social-menu-external-mark{--ocean-social-external-mark-size:'. $header_social_external_icon_size_mobile . 'em;}
			}';
		}

		if ( ! empty( $header_social_external_icon_x_offset ) ) {
			$css .= '.header-social-menu-external-mark{--ocean-social-external-mark-offset-x:'. $header_social_external_icon_x_offset . 'em;}';
		}

		if ( ! empty( $header_social_external_icon_y_offset ) ) {
			$css .= '.header-social-menu-external-mark{--ocean-social-external-mark-offset-y:'. $header_social_external_icon_y_offset . 'em;}';
		}


		if ( ! empty( $header_social_external_icon_color ) ) {
			$css .= '.header-social-menu-external-mark{--ocean-social-external-mark-color:' . $header_social_external_icon_color . ';}';
		}

		if ( ! empty( $header_social_external_icon_color_hover ) ) {
			$css .= '.header-social-menu-external-mark{--ocean-social-external-mark-bg:' . $header_social_external_icon_color_hover . ';}';
		}


		$output = '';

		// Return CSS.
		if ( ! empty( $css ) ) {
			$output .= '/* A11Y CSS */' . $css;
		}

		// Return output css.
		return $output;
	}
}

return new OceanWP_Customize_A11Y_CSS();
  