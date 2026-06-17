<?php
/**
 * Main Header Layout
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Header style.
$header_style = oceanwp_header_style();

// Header height, used for local scrolling.
$header_height = get_theme_mod( 'ocean_header_height', 74 );

if ( class_exists( 'Ocean_Sticky_Header' ) ) {

	if ( 'shrink' === get_theme_mod( 'osh_sticky_header_style', 'shrink' ) ) {
		$header_height = get_theme_mod( 'osh_shrink_header_height', '54' );
	}
}

// If vertical header style.
if ( 'vertical' === $header_style ) {
	$header_height = 0;
}


// Add container class if the header is not full width.
$class = '';
if ( true !== get_theme_mod( 'ocean_header_full_width', false ) ) {
	$class = 'container';
}

$has_video = function_exists( 'has_header_video' ) && has_header_video();
$has_image = has_header_image();

$enabled_a11y_tag = oceanwp_is_semantic_desktop_header_enabled();

$video_controls = get_theme_mod( 'ocean_display_header_video_controls', true );

$media_classes = array();

if ( $has_video ) {
	$media_classes[] = 'has-video';

	if ( $video_controls ) {
		$media_classes[] = 'has-video-controls';
	} else {
		$media_classes[] = 'no-video-controls';
	}
}

if ( $has_image ) {
	$media_classes[] = 'has-image';
}

if ( $enabled_a11y_tag ) {
	$media_classes[] = 'owp-accessibility-header-enabled';
}

$overlay_classes = array();

if ( $has_video ) {
	$overlay_classes[] = 'has-video';
}

if ( $has_image ) {
	$overlay_classes[] = 'has-image';
}

if ( $has_video && $has_image ) {
	$overlay_classes[] = 'has-video-image';
}

do_action( 'ocean_before_header' );

// If transparent header style.
if ( 'transparent' === $header_style
	|| ( 'full_screen' === $header_style && true === get_theme_mod( 'ocean_full_screen_header_transparent', false ) )
		|| ( 'center' === $header_style && true === get_theme_mod( 'ocean_center_header_transparent', false ) )
		|| ( 'medium' === $header_style && true === get_theme_mod( 'ocean_medium_header_transparent', false ) ) ) { ?>
	<div id="transparent-header-wrap" class="clr">
	<?php
}
?>

<header id="site-header" class="<?php echo esc_attr( oceanwp_header_classes() ); ?>" data-height="<?php echo esc_attr( $header_height ); ?>"<?php oceanwp_schema_markup( 'header' ); ?> role="banner">

	<?php
	// Elementor `header` location.
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
		?>

		<?php
		// If header video.
		if ( $has_video || $has_image ) {
			?>
			<div class="custom-header-media <?php echo esc_attr( implode( ' ', $media_classes ) ); ?>">

				<?php the_custom_header_markup(); ?>

			</div>
			<?php
		}

		if ( 'top' === $header_style ) {
			// If top header style.
			get_template_part( 'partials/header/style/top-header' );

		} elseif ( 'full_screen' === $header_style ) {
			// If full screen header style.
			get_template_part( 'partials/header/style/full-screen-header' );

		} elseif ( 'center' === $header_style ) {
			// If center header style.
			get_template_part( 'partials/header/style/center-header' );

		} elseif ( 'medium' === $header_style ) {
			// If medium header style.
			get_template_part( 'partials/header/style/medium-header' );

		} elseif ( 'vertical' === $header_style ) {
			// If vertical header style.
			get_template_part( 'partials/header/style/vertical-header' );

		} elseif ( 'custom' === $header_style ) {
			// If custom header style.
			get_template_part( 'partials/header/style/custom-header' );

		} else {
			// Default header style.
			?>
			<?php do_action( 'ocean_before_header_inner' ); ?>

			<div id="site-header-inner" class="clr <?php echo esc_attr( $class ); ?>">

				<?php do_action( 'ocean_header_inner_left_content' ); ?>

				<?php do_action( 'ocean_header_inner_middle_content' ); ?>

				<?php do_action( 'ocean_header_inner_right_content' ); ?>

			</div><!-- #site-header-inner -->

			<?php get_template_part( 'partials/mobile/mobile-dropdown' ); ?>

			<?php do_action( 'ocean_after_header_inner' ); ?>

			<?php
		}
		?>

		<?php
		// If header media.
		if ( $has_image && ! oceanwp_is_existing_installation( '4.2.0' ) ) {
			?>
			<div class="overlay-header-media <?php echo esc_attr( implode( ' ', $overlay_classes ) ); ?>"></div>
			<?php
		}
	}
	?>

</header><!-- #site-header -->

<?php
// If transparent header style.
if ( 'transparent' === $header_style
	|| ( 'full_screen' === $header_style && true === get_theme_mod( 'ocean_full_screen_header_transparent', false ) )
		|| ( 'center' === $header_style && true === get_theme_mod( 'ocean_center_header_transparent', false ) )
		|| ( 'medium' === $header_style && true === get_theme_mod( 'ocean_medium_header_transparent', false ) ) ) {
	?>
	</div>
	<?php
}

do_action( 'ocean_after_header' ); ?>
