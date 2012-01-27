<?php
/**
 * Custom Theme Settings - adds custom theme settings to the Hybrid Theme Settings page.
 *
 * @version 0.3.0
 * @author Brent Shepherd
 */


add_action( 'admin_menu', 'dschool_theme_admin_setup' );

function dschool_theme_admin_setup() {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'dschool_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'dschool_validate_banner_settings' );
}

/* Adds custom meta boxes to the theme settings page. */
function dschool_theme_settings_meta_boxes() {

	/* Add a custom meta box. */
	add_meta_box(
		'dschool-banner-settings-meta-box',
		__( 'Banner Settings', hybrid_get_textdomain() ),
		'dschool_banner_settings_meta_box',
		'appearance_page_theme-settings',
		'normal',
		'high'
	);

	/* Add additional add_meta_box() calls here. */
}

/* Function for displaying the meta box. */
function dschool_banner_settings_meta_box() {

	foreach( array( 'top' => 'Top', 'bottom' => 'Bottom' ) as $position => $description ) : ?>

	<h4><?php printf( __( '%s Side Banner', hybrid_get_textdomain() ), $description ); ?></h4>
	<table class="form-table">

		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'banner_side_'.$position.'_title' ); ?>"><?php _e( 'Title:', hybrid_get_textdomain() ); ?></label>
			</th>
			<td>
				<input type="text" id="<?php echo hybrid_settings_field_id( 'banner_side_'.$position.'_title' ); ?>" name="<?php echo hybrid_settings_field_name( 'banner_side_'.$position.'_title' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'banner_side_'.$position.'_title' ) ); ?>" />
			</td>
		</tr>

		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'banner_side_'.$position.'_copy' ); ?>"><?php _e( 'Copy:', hybrid_get_textdomain() ); ?></label>
			</th>
			<td>
				<input type="text" id="<?php echo hybrid_settings_field_id( 'banner_side_'.$position.'_copy' ); ?>" name="<?php echo hybrid_settings_field_name( 'banner_side_'.$position.'_copy' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'banner_side_'.$position.'_copy' ) ); ?>" />
			</td>
		</tr>

		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'banner_side_'.$position.'_link' ); ?>"><?php _e( 'Media Link:', hybrid_get_textdomain() ); ?></label>
			</th>
			<td>
				<input type="text" id="<?php echo hybrid_settings_field_id( 'banner_side_'.$position.'_link' ); ?>" name="<?php echo hybrid_settings_field_name( 'banner_side_'.$position.'_link' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'banner_side_'.$position.'_link' ) ); ?>" />
				<input type="checkbox" id="<?php echo hybrid_settings_field_id( 'banner_side_'.$position.'_link_is_video' ); ?>" name="<?php echo hybrid_settings_field_name( 'banner_side_'.$position.'_link_is_video' ); ?>" <?php checked( hybrid_get_setting( 'banner_side_'.$position.'_link_is_video' ), 'on' ); ?> /> Links to a video
			</td>
		</tr>

	</table><?php
	endforeach;
}

/* Validates theme settings. */
function dschool_validate_banner_settings( $input ) {

	/* Return the array of theme settings. */
	return $input;
}

