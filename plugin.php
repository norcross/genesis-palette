<?php
/**
Plugin Name: Genesis Design Palette
Plugin URI: http://andrewnorcross.com/plugins
Description: A design settings panel for the Genesis framework. Requires Genesis v1.8
Author: Andrew Norcross
Version: 1.02
Author URI: http://andrewnorcross.com


License: GNU General Public License v2.0 (or later)
License URI: http://www.opensource.org/licenses/gpl-license.php

*/ 

/** Define our constants */
define( 'GS_SETTINGS_FIELD', 'gs-settings' );
define( 'GS_PLUGIN_DIR', dirname( __FILE__ ) );

register_activation_hook( __FILE__, 'gs_activation' );

/**
 * This function runs on plugin activation. It checks to make sure Genesis
 * or a Genesis child theme is active. If not, it deactivates itself.
 *
 * @since 0.1.0
 */
function gs_activation() {

	if ( 'genesis' != basename( TEMPLATEPATH ) ) {
		gs_deactivate( '1.8.0', '3.3' );
	}

}

/**
 * Deactivate GS Design.
 *
 * This function deactivates the design panel.
 *
 * @since 1.8.0.2
 */
function gs_deactivate( $genesis_version = '1.8.0', $wp_version = '3.3' ) {
	deactivate_plugins( plugin_basename( __FILE__ ) );
	wp_die( sprintf( __( 'Sorry, you cannot run Genesis Palette without WordPress %s and <a href="%s">Genesis %s</a> or greater.', 'gsdesign' ), $wp_version, 'http://andrewnorcross.com/go/genesis', $genesis_version ) );
	
}

add_action( 'genesis_init', 'gs_init', 20 );

/**
 * Load admin menu and helper functions. Hooked to `genesis_init`.
 *
 * @since 1.8.0
 */
function gs_init() {
	
	/** Deactivate if not running Genesis 1.8.0 or greater */
	if ( ! class_exists( 'Genesis_Admin_Boxes' ) )
		add_action( 'admin_init', 'gs_deactivate', 10, 0 );

	/** Admin Menu */
	if ( is_admin() )
		require_once( GS_PLUGIN_DIR . '/gs-design.php' );

	/** CSS generator function */
	require_once( GS_PLUGIN_DIR . '/gs-deploy.php' );
	
	/** Helper function */
	require_once( GS_PLUGIN_DIR . '/gs-misc.php' );
	
}
