<?php

add_filter('body_class', 'gs_custom_classes');
add_action('wp_enqueue_scripts', 'gs_css_loader');

// add custom body class for CSS file
function gs_custom_classes ($classes){
	$switch = genesis_get_option( 'gs_switch', 'gs-settings' );
	// if it isn't turned on, don't add it
	if($switch !== 'true' )
	    return $classes;

	// otherwise add the class
	$classes[] = 'gs-custom';
	    return $classes;
}



// load CSS file on front-end
function gs_css_loader() {
	$switch = genesis_get_option( 'gs_switch', 'gs-settings' );
	// if it isn't turned on, don't add it
	if($switch !== 'true' )
		return;

	// otherwise load our CSS
	wp_enqueue_style( 'gs-style', plugins_url('/css/gs-custom.css', __FILE__) );
}




