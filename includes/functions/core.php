<?php
namespace CG\Multisite_Clone\Core;

/**
 * Default setup routine
 *
 * @uses add_action()
 * @uses do_action()
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'init', $n( 'i18n' ) );
	add_action( 'init', $n( 'init' ) );

	do_action( 'msc_loaded' );
}

/**
 * Registers the default textdomain.
 *
 * @uses apply_filters()
 * @uses get_locale()
 * @uses load_textdomain()
 * @uses load_plugin_textdomain()
 * @uses plugin_basename()
 *
 * @return void
 */
function i18n() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'msc' );
	load_textdomain( 'msc', WP_LANG_DIR . '/msc/msc-' . $locale . '.mo' );
	load_plugin_textdomain( 'msc', false, plugin_basename( MSC_PATH ) . '/languages/' );
}

/**
 * Initializes the plugin and fires an action other plugins can hook into.
 *
 * @uses do_action()
 *
 * @return void
 */
function init() {
	do_action( 'msc_init' );
}

/**
 * Activate the plugin
 *
 * @uses init()
 * @uses flush_rewrite_rules()
 *
 * @return void
 */
function activate( $network_activated ) {
	// First, Deactivate the plugin if we are not running a multisite
	if ( ! $network_activated ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );

		// Return the error message
		$errormsg = sprintf(
			'<p><strong>%s</strong><br />%s</p><p><a href="' . esc_url( admin_url( '/plugins.php' ) ) . '">%s</a></p>',
			esc_html__( 'Multisite Clone could not be activated.', 'msc' ),
			esc_html__( 'This plugin requires WordPress Multisite and must be "Network Activated".', 'msc' ),
			esc_html__( 'Go back to Plugins', 'msc' )
		);

		wp_die( $errormsg );
	}

	// Now we can load the init scripts in case any rewrite functionality is being loaded
	init();
	flush_rewrite_rules();
}

/**
 * Deactivate the plugin
 *
 * Uninstall routines should be in uninstall.php
 *
 * @return void
 */
function deactivate() {

}
