<?php
/**
 * Plugin Name: Statically
 * Plugin URI:  https://statically.io/wordpress/
 * Description: Use Statically CDN for image processing and optimization, CSS/JS minification, and much more.
 * Version:     0.8
 * Author:      Statically
 * Author URI:  https://statically.io
 * License:     GPLv2 or later
 * Text Domain: statically
 */

/* Check & Quit */
defined( 'ABSPATH' ) OR exit;

/* constants */
define( 'STATICALLY_VERSION', '0.8' );
define( 'STATICALLY_FILE', __FILE__ );
define( 'STATICALLY_DIR', dirname( __FILE__ ) );
define( 'STATICALLY_BASE', plugin_basename( __FILE__ ) );
define( 'STATICALLY_MIN_WP', '3.8' );

/* loader */
add_action( 'plugins_loaded', [ 'Statically', 'instance' ] );

/* uninstall */
register_uninstall_hook( __FILE__, [ 'Statically', 'handle_uninstall_hook' ] );

/* activation */
register_activation_hook( __FILE__, [ 'Statically', 'handle_activation_hook' ] );

/* autoload init */
spl_autoload_register('STATICALLY_autoload');

/* functions */
require_once( STATICALLY_DIR . '/inc/statically.func.php' );

/* autoload funktion */
function STATICALLY_autoload( $class ) {
    if ( in_array(
        $class, [
            'Statically',
            'Statically_Rewriter',
            'Statically_SmartImageResize',
            'Statically_WPCDN',
            'Statically_Emoji',
            'Statically_Favicons',
            'Statically_OG',
            'Statically_PageBooster',
            'Statically_Settings',
            'Statically_Debugger'
        ] ) ) {
        require_once(
            sprintf(
                '%s/inc/%s.class.php',
                STATICALLY_DIR,
                strtolower( $class )
            )
        );
    }
}
