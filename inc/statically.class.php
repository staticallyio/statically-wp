<?php

/**
 * Statically
 *
 * @since 0.0.1
 */

class Statically
{
    const API = 'https://api.statically.io/';
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
        $options = self::get_options( 'statically' );
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
        add_action( $base_action, [ 'Statically_Icon', 'hook' ] );
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
        add_action( 'admin_enqueue_scripts', [ __CLASS__, 'admin_scripts' ] );

        /* admin notices */
        add_action( 'all_admin_notices', [ __CLASS__, 'statically_requirements_check' ] );

        /* for custom domain */
        if ( self::is_custom_domain() ) {
            if ( self::admin_pagenow( 'statically' ) ) {
                add_action( 'admin_init', [ __CLASS__, 'ajax_analytics' ] );
                add_action( 'admin_init', [ __CLASS__, 'ajax_purge' ] );
                add_action( 'admin_init', [ __CLASS__, 'ajax_purge_all' ] );
            }
        }

        /* remove unused options */
        delete_option( 'statically-admin-notice-dismissed2' );
        delete_option( 'statically-admin-notice-dismissed3' );
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
                'url'            => get_option( 'home' ),
                'dirs'           => 'wp-content,wp-includes',
                'excludes'       => '.php',
                'quality'        => '0',
                'width'          => '0',
                'height'         => '0',
                'smartresize'    => '0',
                'webp'           => '1',
                'img'            => '1',
                'css'            => '0',
                'js'             => '0',
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
                'query_strings'  => '0',
                'wpcdn'          => '1',
                'private'        => '0',
                'dev'            => '0',
                'replace_cdnjs'  => '0',
                'statically_api_key' => '',
                'statically_zone_id' => '',
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
                        __( 'Statically is optimized for WordPress %s. Please disable the plugin or upgrade your WordPress installation (recommended).', 'statically' ),
                        STATICALLY_MIN_WP
                    )
                )
            );
        }
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
                'url'             => get_option( 'home' ),
                'dirs'            => 'wp-content,wp-includes',
                'excludes'        => '.php',
                'quality'         => '0',
                'width'           => '0',
                'height'          => '0',
                'smartresize'     => 0,
                'webp'            => 1,
                'img'             => 1,
                'css'             => 0,
                'js'              => 0,
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
                'query_strings'   => 0,
                'wpcdn'           => 1,
                'private'         => 0,
                'dev'             => 0,
                'replace_cdnjs'   => 0,
                'statically_api_key'  => '',
                'statically_zone_id' => '',
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
            $options['img'],
            $options['css'],
            $options['js'],
            $options['relative'],
            $options['https'],
            $options['replace_cdnjs'],
            $options['statically_api_key']
        );
    }

    /**
     * check if the CDN URL is custom domain
     *
     * @since 0.4.1
     */
    public static function is_custom_domain() {
        $options = self::get_options();
        $cdn_url = str_replace( 'cdn.statically.io/sites/', '', $options['url'] );;
        return get_option( 'home' ) !== $cdn_url;
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
        wp_enqueue_style( 'statically', plugin_dir_url( STATICALLY_FILE ) . 'static/statically.css', array( 'wp-jquery-ui-dialog' ), STATICALLY_VERSION );

        // main js
        wp_enqueue_script( 'statically', plugin_dir_url( STATICALLY_FILE ) . 'static/statically.js', array( 'jquery-form', 'jquery-ui-core', 'jquery-ui-dialog' ), STATICALLY_VERSION );
    }

    /**
     * run rewrite hook
     *
     * @since 0.0.1
     */
    public static function handle_rewrite_hook() {
        $options = self::get_options();

        // check if Statically API Key is set before start rewriting
        if ( ! array_key_exists( 'statically_api_key', $options )
              || strlen( $options['statically_api_key'] ) < 32 ) {
            return;
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

    /**
     * analytics
     * 
     * @since 0.8
     */
    public static function ajax_analytics() {
        $options = self::get_options();

        if ( isset( $_GET['statically_analytics_data'] ) ) {

            if ( ! array_key_exists( 'statically_api_key', $options )
                    || strlen( $options['statically_api_key'] ) < 32 ) {
                $ajax = [
                    'status' => 'error',
                    'message' => 'API Key is not valid'
                ];
                echo json_encode( $ajax );
                exit();
            }

            if ( strlen( $options['statically_zone_id'] ) < 4 ) {
                $ajax = [
                    'status' => 'error',
                    'message' => 'Zone ID is required'
                ];
                echo json_encode( $ajax );
                exit();
            }

            $response = wp_remote_get(
                Statically::API . 'stats?zone_id=' . $options['statically_zone_id'],
                [
                    'timeout' => 20,
                    'headers' => [
                        'Statically-Key' => $options['statically_api_key'],
                    ]
                ]
            );
    
            if ( is_wp_error( $response ) ) {
                $data = [
                    'status' => 'error',
                    'message' => 'Error connecting to Statically API - '. $response->get_error_message()
                ];
                echo json_encode( $data );
                exit();
            }
    
            $json = json_decode( $response['body'], true );
    
            $data = [
                'status' => 'success',
                'TotalRequests' => number_format( $json['msg']['TotalRequestsServed'] ),
                'TotalBandwidth' => statically_format_bytes( $json['msg']['TotalBandwidthUsed'] ),
                'CacheHitRate' => number_format( $json['msg']['CacheHitRate'] ) . '%'
            ];
    
            echo json_encode( $data );
            exit();
        }
    }

    /**
     * purge (by URL)
     * 
     * @since 0.8
     */
    public static function ajax_purge() {
        $options = self::get_options();

        if ( isset( $_POST['purge_submit'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

            // Check for valid API Key and Zone ID
            self::api_requirements_check();
    
            if ( empty( $_POST['purge_url'] ) ) {
                echo 'URL required';
                exit();
            } else {
                $urls_to_purge = str_replace( '%0D%0A', ',', urlencode( $_POST['purge_url'] ) );
                $total_urls = count( explode( ',', urldecode( $urls_to_purge ) ) );

                if ( $total_urls > 10 ) {
                    echo 'Too many URLs';
                    exit();
                }

                $response = wp_remote_get(
                    Statically::API . 'purge?zone_id=' . $options['statically_zone_id'] . '&url=' . $urls_to_purge,
                    [
                        'timeout' => 20,
                        'headers' => [
                            'Statically-Key' => $options['statically_api_key'],
                        ]
                    ]
                );

                if ( is_wp_error( $response ) ) {
                    printf(
                        '<p>%s</p>',
                        esc_html__( 'Error connecting to Statically API - '. $response->get_error_message(), 'statically' )
                    );
                    exit();
                }

                //error_log( 'Statically API: ' . $response['body'] );
                echo $total_urls . ' URL(s) - ';

                $json = json_decode( $response['body'], true );
                if ( $json['status'] == 'success' ) {
                    $status = $json['status'] . '<i class="dashicons dashicons-yes"></i>';
                } else {
                    $status = $json['status'] . ': ' . $json['message'] . '<i class="dashicons dashicons-no"></i>';
                }
                echo $status;
                exit();
            }
        }
    }

    /**
     * purge all
     * 
     * @since 0.8
     */
    public static function ajax_purge_all() {
        $options = self::get_options();
 
        if( isset( $_POST['purge_all_submit'] ) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

            // Check for valid API Key and Zone ID
            self::api_requirements_check();
    
            if ( empty( $_POST['purge_all'] ) ) {
                echo '0';
                exit();
            } else {
                $response = wp_remote_get(
                    Statically::API . 'purge_all?zone_id=' . $options['statically_zone_id'],
                    [
                        'timeout' => 20,
                        'headers' => [
                            'Statically-Key' => $options['statically_api_key'],
                        ]
                    ]
                );

                if ( is_wp_error( $response ) ) {
                    printf(
                        '<p>%s</p>',
                        esc_html__( 'Error connecting to Statically API - '. $response->get_error_message(), 'statically' )
                    );
                    exit();
                }

                $json = json_decode($response['body'], true);
                if ( $json['status'] == 'success' ) {
                    $status = $json['status'] . '<i class="dashicons dashicons-yes"></i>';
                } else {
                    $status = $json['status'] . ': ' . $json['message'] . '<i class="dashicons dashicons-no"></i>';
                }
                echo $status;
                exit();
            }
        }
    }

    /**
     * API requirements check
     * 
     * @since 0.8
     */
    public static function api_requirements_check() {
        $options = self::get_options();

        if ( ! array_key_exists( 'statically_api_key', $options )
                || strlen( $options['statically_api_key'] ) < 32 ) {
            echo 'API Key is not valid';
            exit();
        }

        if ( strlen( $options['statically_zone_id'] ) < 4 ) {
            echo 'Zone ID is required';
            exit();
        }
    }

}
