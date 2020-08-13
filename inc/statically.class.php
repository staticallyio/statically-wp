<?php

/**
 * Statically
 *
 * @since 0.0.1
 */

class Statically
{
    const CDN = 'https://cdn.statically.io/';
    const WPCDN = 'https://cdn.statically.io/wp/';

    /**
     * pseudo-constructor
     *
     * @since 0.0.1
     */
    public static function instance() {
        new self();
    }

    /**
     * constructor
     *
     * @since 0.0.1
     */
    public function __construct() {
        error_reporting(0);

        $options = Statically::get_options( 'statically' );
        if ( $options['wpadmin'] ) {
            $base_action = 'init';
        } else {
            $base_action = 'template_redirect';
        }

        /* CDN rewriter hook */
        add_action( $base_action, [ __CLASS__, 'handle_rewrite_hook' ] );

        /* Rewrite rendered content in REST API */
        add_filter( 'the_content', [ __CLASS__, 'rewrite_the_content', ], 100 );

        /* ONLY enable these options if has a custom domain */
        if ( $this->is_custom_domain() ) {
            if ( $options['smartresize'] ) {
                add_filter( 'wp_get_attachment_image_src', [ 'Statically_SmartImageResize', 'smartresize'] );
            }
        }

        /* WP Core CDN rewriter hook */
        add_action( $base_action, [ 'Statically_WPCDN', 'hook' ] );

        /* Features */
        add_action( $base_action, [ 'Statically_Emoji', 'hook' ] );
        add_action( $base_action, [ 'Statically_Favicons', 'hook' ] );
        add_action( 'wp_head', [ 'Statically_OG', 'hook' ], 3 );

        if ( $options['pagebooster'] ) {
            add_action( 'wp_footer', [ 'Statically_PageBooster', 'add_js' ] );
        }

        /* remove query strings */
        if ( $options['query_strings'] ) {
            add_filter( 'style_loader_src', [ __CLASS__, 'remove_query_strings' ], 999 );
            add_filter( 'script_loader_src', [ __CLASS__, 'remove_query_strings' ], 999 );
        }

        /* Hooks */
        add_action( 'admin_init', [ __CLASS__, 'register_textdomain' ] );
        add_action( 'admin_init', [ 'Statically_Settings', 'register_settings' ] );
        add_action( 'admin_menu', [ 'Statically_Settings', 'add_settings_page' ] );
        add_filter( 'plugin_action_links_' . STATICALLY_BASE, [ __CLASS__, 'add_action_link' ] );
        add_action( 'admin_menu', [ 'Statically_Debugger', 'add_settings_page' ] );
        add_action( 'admin_enqueue_scripts', [ __CLASS__, 'admin_scripts' ] );

        /* admin notices */
        add_action( 'all_admin_notices', [ __CLASS__, 'statically_requirements_check' ] );

        /* add illage usage notice */
        if( empty( get_option( 'statically-illegal-cdnurl-notice-dismissed' ) ) ) {
            add_action( 'admin_notices', [ __CLASS__, 'statically_illegal_cdnurl_notice' ] );
        }
        
        /* ajax for illegal usage notice */
        add_action( 'wp_ajax_statically_illegal_cdnurl_notice_dismiss', [ __CLASS__, 'statically_illegal_cdnurl_notice_dismiss' ] );

        /* TODO: remove unused options */
        //delete_option( 'statically-illegal-cdnurl-notice-dismissed' );
    }

    /**
     * add action links
     *
     * @since 0.0.1
     *
     * @param array $data alreay existing links
     * @return array $data extended array with links
     */
    public static function add_action_link($data) {
        // check permission
        if ( ! current_user_can( 'manage_options' ) ) {
            return $data;
        }

        return array_merge(
            $data,
            [
                sprintf(
                    '<a href="%s">%s</a>',
                    add_query_arg(
                        [
                            'page' => 'statically',
                        ],
                        admin_url( 'admin.php' )
                    ),
                    __("Settings")
                ),
            ]
        );
    }

    /**
     * run uninstall hook
     *
     * @since 0.0.1
     */
    public static function handle_uninstall_hook() {
        delete_option( 'statically' );
    }

    /**
     * run activation hook
     *
     * @since 0.0.1
     */
    public static function handle_activation_hook() {
        add_option(
            'statically',
            [
                'url'            => self::get_cdn_url(),
                'dirs'           => 'wp-content,wp-includes',
                'excludes'       => '.php',
                'qs_excludes'    => 'no-statically',
                'quality'        => '0',
                'width'          => '0',
                'height'         => '0',
                'smartresize'    => '0',
                'webp'           => '1',
                'emoji'          => '1',
                'favicon'        => '0',
                'favicon_shape'  => 'rounded',
                'favicon_bg'     => '#000000',
                'favicon_color'  => '#ffffff',
                'og'             => '0',
                'og_theme'       => 'light',
                'og_fontsize'    => 'medium',
                'og_type'        => 'jpeg',
                'pagebooster'    => '0',
                'pagebooster_content' => '#page',
                'pagebooster_turbo' => '0',
                'pagebooster_custom_js' => '',
                'pagebooster_custom_js_enabled' => '0',
                'pagebooster_scripts_to_refresh' => 'connect.facebook.net/en_US/sdk.js,platform.twitter.com/widgets.js',
                'wpadmin'        => '0',
                'relative'       => '1',
                'https'          => '1',
                'query_strings'  => '1',
                'wpcdn'          => '1',
                'private'        => '0',
                'dev'            => '0',
                'replace_cdnjs'    => '0',
                'statically_api_key' => '',
            ]
        );
    }

    /**
     * check plugin requirements
     *
     * @since 0.0.1
     */
    public static function statically_requirements_check() {
        // WordPress version check
        if ( version_compare( $GLOBALS['wp_version'], STATICALLY_MIN_WP . 'alpha', '<' ) ) {
            show_message(
                sprintf(
                    '<div class="error"><p>%s</p></div>',
                    sprintf(
                        __( "Statically is optimized for WordPress %s. Please disable the plugin or upgrade your WordPress installation (recommended).", "statically" ),
                        STATICALLY_MIN_WP
                    )
                )
            );
        }
    }

    /**
     * tell people to stop using the Statically CDN URL in other plugin settings
     * 
     * @since 0.6.1
     */
    public static function statically_illegal_cdnurl_notice() {
        show_message(
            sprintf(
                '<div class="statically-illegal-cdnurl-notice notice notice-warning is-dismissible">
                    <p><i class="dashicons dashicons-warning"></i> %s</p>
                </div>',
                __( 'Statically Sites Free CDN URL <code>https://cdn.statically.io/sites/</code> will be deprecated soon. Please re-check your settings and make sure to remove this CDN URL from any plugin settings except the Statically plugin.', 'statically' )
            )
        );
    }

    /**
     * update option for CDN URL notice dismiss
     * 
     * @since 0.6.1
     */
    public static function statically_illegal_cdnurl_notice_dismiss() {
        update_option( 'statically-illegal-cdnurl-notice-dismissed', 1 );
    }

    /**
     * register textdomain
     *
     * @since 0.0.1
     */
    public static function register_textdomain() {
        load_plugin_textdomain(
            'statically',
            false,
            'statically/lang'
        );
    }

    /**
     * return plugin options
     *
     * @since 0.0.1
     *
     * @return array $diff data pairs
     */
    public static function get_options() {
        return wp_parse_args(
            get_option( 'statically' ),
            [
                'url'             => self::get_cdn_url(),
                'dirs'            => 'wp-content,wp-includes',
                'excludes'        => '.php',
                'qs_excludes'     => 'no-statically',
                'quality'         => '0',
                'width'           => '0',
                'height'          => '0',
                'smartresize'     => 0,
                'webp'            => 1,
                'emoji'           => 1,
                'favicon'         => 0,
                'favicon_shape'   => 'rounded',
                'favicon_bg'      => '#000000',
                'favicon_color'   => '#ffffff',
                'og'              => 0,
                'og_theme'        => 'light',
                'og_fontsize'     => 'medium',
                'og_type'         => 'jpeg',
                'pagebooster'     => 0,
                'pagebooster_content' => '#page',
                'pagebooster_turbo' => '0',
                'pagebooster_custom_js' => '',
                'pagebooster_custom_js_enabled' => 0,
                'pagebooster_scripts_to_refresh' => 'connect.facebook.net/en_US/sdk.js,platform.twitter.com/widgets.js',
                'wpadmin'         => 0,
                'relative'        => 1,
                'https'           => 1,
                'query_strings'   => 1,
                'wpcdn'           => 1,
                'private'         => 0,
                'dev'             => 0,
                'replace_cdnjs'     => 0,
                'statically_api_key'  => '',
            ]
        );
    }

    /**
     * return new rewriter
     *
     * @since 0.0.1
     */
    public static function get_rewriter() {
        $options = self::get_options();

        $excludes = array_map( 'trim', explode( ',', $options['excludes'] ) );

        return new Statically_Rewriter(
            get_option( 'home' ),
            $options['url'],
            $options['dirs'],
            $excludes,
            $options['quality'],
            $options['width'],
            $options['height'],
            $options['webp'],
            $options['relative'],
            $options['https'],
            $options['replace_cdnjs'],
            $options['statically_api_key']
        );
    }
    
    /**
     * get CDN URL
     *
     * @since 0.5.0
     * 
     * @return string CDN URL
     */
    public static function get_cdn_url() {
        $base = str_replace( ['http://', 'https://'], '', get_option( 'home' ) );

        $cdn = self::CDN . 'sites/' . $base;
        return $cdn;
    }

    /**
     * check if the CDN URL is custom domain
     *
     * @since 0.4.1
     */
    public static function is_custom_domain() {
        $options = self::get_options();
        $cdn_url = $options['url'];
        return ! preg_match( '/cdn.statically.io/', $cdn_url );
    }

    /**
     * remove query strings from asset URL
     *
     * @since 0.1.0
     *
     * @param string $src original asset URL
     * @return string asset URL without query strings
     */
    public static function remove_query_strings( $src ) {
		if ( false !== strpos( $src, '.css?' ) || false !== strpos( $src, '.js?' ) ) {
			$src = preg_replace( '/\?.*/', '', $src );
		}

		return $src;
    }

    /**
     * check if admin page
     *
     * @since 0.5.0
     * 
     * @param string $page admin page now
     */
    public static function admin_pagenow( $page ) {
        global $pagenow;
        if ( 'admin.php' === $pagenow &&
                isset( $_GET['page'] ) && $page === $_GET['page'] ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * register plugin styles
     * 
     * @since 0.0.1
     */
    public static function admin_scripts() {
        // main css
		wp_enqueue_style( 'statically', plugin_dir_url( STATICALLY_FILE ) . 'static/statically.css', array(), STATICALLY_VERSION );

        // main js
        wp_enqueue_script( 'statically', plugin_dir_url( STATICALLY_FILE ) . 'static/statically.js', array(), STATICALLY_VERSION );
    }

    /**
     * run rewrite hook
     *
     * @since 0.0.1
     */
    public static function handle_rewrite_hook() {
        $options = self::get_options();
        $qs_excludes = array_map( 'trim', explode( ',', $options['qs_excludes'] ) );

        // check if origin equals cdn url
        if ( $options['url'] === get_option( 'home' ) ) {
            return;
        }

        // check if Statically API Key is set before start rewriting
        if ( ! array_key_exists( 'statically_api_key', $options )
              || strlen( $options['statically_api_key'] ) < 32 ) {
            return;
        }

        // do not perform rewriting on pages with specified query strings
        foreach ( $qs_excludes as $qs_exclude ) {
            if ( !! $qs_exclude && array_key_exists( $qs_exclude, $_GET ) ) {
                return;
            }
        }

        // check if private is enabled
        if ( $options['private'] && is_user_logged_in() ) {
            return;
        }

        $rewriter = self::get_rewriter();
        ob_start( array( &$rewriter, 'rewrite' ) );
    }

    /**
     * rewrite html content
     *
     * @since 0.0.1
     */
    public static function rewrite_the_content( $html ) {
        $rewriter = self::get_rewriter();
        return $rewriter->rewrite( $html );
    }

}
