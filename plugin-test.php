<?php
/*
Plugin Name: Plugin Test
Plugin URI: http://www.aaronweidele.com
Description: Plugin Test!!!!
Version: 1.0
Author: Aaron
Author URI: http://www.aaronweidele.com
*/

$options_page = 'general';
add_action( 'admin_init', 'register_bn_options' );
function register_bn_options() {

	global $options_page; /* <-- DELETE THIS LATER */

	add_settings_section(
		'pt_settings',						// ID used to identify this section and with which to register options
        'PT Settings', 		                // Title to be displayed on the administration page
        'pt_settings_callback_function', 	// Callback used to render the description of the section
        $options_page			  			// Page on which to add this section of options <--- NOTE we're going to change this
	);
	add_settings_field( 
		'bn_title',							// ID used to identify the field throughout the theme
		'Breaking News Title',				// Label for the feild
		'bn_title_callback_function',		// The name of the function responsible for rendering the option interface
		$options_page,						// The page on which this option will be displayed
		'pt_settings',						// The name of the section to which this field belongs (Same as first setting in add_settings_section()
		array(								// Not exactly sure what this is? We'll find out
			'What is this?',
		)
	);
	register_setting( $options_page , 'bn_title' );
}

//// THIS FUNCTION REFERENCES THE THIRD SETTING IN add_settings_section
function pt_settings_callback_function() {
	//echo 'FUCK YOU';
}

//// THIS FUNCTION REFERENCES THE THIRD SETTING IN add_settings_field
function bn_title_callback_function( $args ) {
	$html = '<input type="text" id="bn_title" name="bn_title" value="' . get_option('bn_title') . '" class="regular-text code">';	
	echo $html;
}
