<?php

/**
 * Statically_Icon
 *
 * @since 0.5.0
 */

class Statically_Icon
{
    const CDN = 'https://cdn.statically.io/icon/g';

    public static function hook() {
        $options = Statically::get_options();

        if ( 1 !== $options['favicon'] ) {
            return;
        }

        add_action( 'wp_head', [ __CLASS__, 'generate_favicon' ], 2 );
        add_action( 'admin_head', [ __CLASS__, 'generate_favicon' ], 2 );
    }

    /**
     * generate Favicon
     * 
     * @since 0.5.0
     */
    public static function generate_favicon() {
        $options = Statically::get_options();

        // default variables
        $size_small = '64';
        $size_medium = $size_small * 2;
        $size_large = $size_small * 4;
        $name = get_bloginfo( 'name' );
        $image = '/' . urlencode( $name ) . '.png';
        $favicon_bg = str_replace( '#', '', $options['favicon_bg'] );
        $favicon_color = str_replace( '#', '', $options['favicon_color'] );

        // set sizes for meta tag
        $sizes_small = $size_small . 'x' . $size_small;
        $sizes_medium = $size_medium . 'x' . $size_medium;

        // start options
        $params = '';
        if ( 'rounded' !== $options['favicon_shape']  ) {
            $params = '/square=1';
        }

        // option for background
        if ( '000000' !== $favicon_bg ) {
            $params .= ',bg=' . $favicon_bg;
        }

        // option for color
        if ( 'ffffff' !== $favicon_color ) {
            $params .= ',c=' . $favicon_color;
        }

        // option for size
        $params .= ',s=';

        // clean up params if shape is rounded by finding and remove
        // the first comma `,` from options and change it to slash `/`
        if ( 'rounded' === $options['favicon_shape']  && '000000' === $favicon_bg && 'ffffff' === $favicon_color ||
        'rounded' === $options['favicon_shape']  && '000000' !== $favicon_bg && 'ffffff' === $favicon_color ||
        'rounded' === $options['favicon_shape']  && '000000' === $favicon_bg && 'ffffff' !== $favicon_color ||
        'rounded' === $options['favicon_shape']  && '000000' !== $favicon_bg && 'ffffff' !== $favicon_color ) {
            $params = substr($params, strpos($params, ',') + 1);
            $params = '/' . $params;
        }

        // combine URL
        $url = self::CDN . $params;

        // meta tag
        $icon = '<link rel="icon" href="' . $url . $size_small . $image . '" sizes="' . $sizes_small . '" />' . "\n";
        $icon .= '<link rel="icon" href="' . $url . $size_medium . $image . '" sizes="' . $sizes_medium . '" />' . "\n";
        $icon .= '<link rel="apple-touch-icon-precomposed" href="' . $url . $size_large . $image . '" />' . "\n";

        echo $icon;
    }
}