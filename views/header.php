<?php

$statically_logo_url = plugin_dir_url( STATICALLY_FILE ) . 'static/statically.svg';

?>

<header class="stly-header-container">
    <div class="stly-header">
        <div class="logo">
            <a href="https://statically.io/" target="_blank" title="<?php _e( 'Optimization for your website static assets.', 'statically' ); ?>">
                <img src="<?php echo $statically_logo_url; ?>" />
            </a>
        </div>

        <nav>
            <ul>
                <li><a href="https://wordpress.org/support/plugin/statically/" target="_blank"><?php _e( 'Help', 'statically' ); ?></a></li>
                <li><a href="https://twitter.com/intent/follow?screen_name=staticallyio" target="_blank" title="Follow @staticallyio on Twitter"><i class="dashicons dashicons-twitter"></i></a></li>
            </ul>
        </nav>
    </div>
</header>

<nav class="stly-tab">
    <ul class="stly">

    <?php if ( Statically::admin_pagenow( 'statically' ) ) : ?>
        <li><a data-stly-tab="general" href="#general"><?php _e( 'General', 'statically' ); ?></a></li>
        <li><a data-stly-tab="optimization" href="#optimization"><?php _e ( 'Optimization', 'statically'); ?></a></li>
        <li><a data-stly-tab="misc" href="#misc"><?php _e( 'Misc', 'statically' ); ?></a></li>
        <li><a data-stly-tab="caching" href="#caching"><?php _e( 'Caching', 'statically' ); ?></a></li>
        <li><a data-stly-tab="advanced" href="#advanced"><?php _e( 'Advanced', 'statically' ); ?></a></li>
    <?php endif; ?>

    <?php if ( Statically::admin_pagenow( 'statically-debugger' ) ) : ?>
        <li>
            <a href="?page=statically">
                <i class="dashicons dashicons-arrow-left"></i>
                <?php _e( 'Back to Settings', 'statically' ); ?>
            </a>
        </li>
    <?php endif; ?>

    </ul>
</nav>