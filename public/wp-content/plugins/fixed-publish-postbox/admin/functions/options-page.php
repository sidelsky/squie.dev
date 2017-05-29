<?php
add_action( 'admin_menu', 'fpp_add_admin_menu' );
add_action( 'admin_init', 'fpp_settings_init' );


function fpp_add_admin_menu() {

	add_options_page( 'Fixed Publish Postbox', 'Fixed Publish Postbox', 'manage_options', 'fixed_publish_postbox', 'fpp_options_page' );

}


function fpp_settings_init() {

	register_setting(
        'pluginPage',
        'fpp_settings'
     );

	add_settings_section(
		'fpp_pluginPage_section',
		__( 'Your section description', 'fpp' ),
		'fpp_settings_section_callback',
		'pluginPage'
	);

	/**
	* Adds 'Show Post, Page or Cutom Post Type ID' on Options page
	*/
	add_settings_field(
		'fpp_checkbox_field_0',
		__( 'Show Post, Page or Cutom Post Type ID', 'fpp' ),
		'fpp_checkbox_field_0_render',
		'pluginPage',
		'fpp_pluginPage_section'
	);


}


function fpp_checkbox_field_0_render() {

	/**
	* Checks options if 'Show Post, Page or Cutom Post Type ID' is check
	*/
	$options = get_option( 'fpp_settings' );
	$checkForCheck = (isset($options['fpp_checkbox_field_0']) && (1 == $options['fpp_checkbox_field_0'])) ? 'checked="checked"' : '' ;

	echo '<input type="checkbox" name="fpp_settings[fpp_checkbox_field_0]" ' . $checkForCheck . ' value="1">';

}


function fpp_settings_section_callback() {

	echo __( 'This section description', 'fpp' );

}


function fpp_options_page() {

	echo '<form action="options.php" method="post">';

		echo '<h2>Fixed Publish Postbox Settings</h2>';

		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();

	echo '</form>';

}

?>
