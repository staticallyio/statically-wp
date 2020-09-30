<?php

class Statically_PageBooster
{
    public static function add_js() {
        $options = Statically::get_options();
        $f3h_version = '1.0.12';

        if ( 1 !== $options['pagebooster_custom_js_enabled'] ) {
            if ( !empty( $options['pagebooster_content'] ) ) {
                $elements_to_replace = $options['pagebooster_content'];
            } else {
                $elements_to_replace = '#page';
            }

            if ( 1 === ( $options['pagebooster_turbo'] ) ) {
                $turbo = 'true';
            } else {
                $turbo = 'false';
            }

            // Control using plugin option
            if ( !empty( $options['pagebooster_scripts_to_refresh'] ) ) {
                $scripts_to_refresh = $options['pagebooster_scripts_to_refresh'];
            } else {
                $scripts_to_refresh = "";
            }

            $inline = <<<JS
F3H.state.statically = {
    elementsToReplace: '$elements_to_replace',
    turbo: '$turbo',
    scriptsToRefresh: '$scripts_to_refresh'
};
JS;
        } else {
            $inline = $options['pagebooster_custom_js'];
        }

        wp_enqueue_script( 'statically-f3h', Statically::CDN . "gh/taufik-nurrohman/f3h/v$f3h_version/f3h.min.js", array(), STATICALLY_VERSION );
        wp_add_inline_script( 'statically-f3h', $inline );
        wp_enqueue_script( 'statically-pagebooster', plugin_dir_url( STATICALLY_FILE ) . 'static/pagebooster.js', array(), STATICALLY_VERSION );
    }
}
