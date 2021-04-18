<?php

defined( 'ABSPATH' ) OR exit;

$statically_logo_url = plugin_dir_url( STATICALLY_FILE ) . 'static/statically.svg';

?>

<header class="stly-header-container">
    <div class="stly-header">
        <div class="logo">
            <a href="https://statically.io" target="_blank">
                <img src="<?php echo $statically_logo_url; ?>" />
            </a>
        </div>

        <nav>
            <ul>
                <li><a href="https://statically.discourse.group" target="_blank"><?php _e( 'Ask the Community', 'statically' ); ?></a></li>
                <li><a href="https://twitter.com/staticallyio" target="_blank" title="<?php _e( 'Follow @staticallyio on Twitter', 'statically' ); ?>"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://github.com/staticallyio" target="_blank" title="<?php _e( 'This plugin is open source software', 'statically' ); ?>"><i class="fab fa-github"></i></a></li>
            </ul>
        </nav>
    </div>
</header>

<nav class="stly-tab">
    <ul class="stly">

    <?php if ( Statically::admin_pagenow( 'statically' ) ) : ?>
        <li>
            <a data-stly-tab="general" href="#general">
                <?php _e( 'General', 'statically' ); ?>
                <?php if ( ! Statically::is_custom_domain() ) : ?>
                <span class="new"><?php _e( 'New', 'statically' ); ?></span>
                <?php endif; ?>
            </a>
        </li>
        <?php if ( Statically::is_custom_domain() ) : ?>
        <li>
            <a data-stly-tab="analytics" href="#analytics">
                <?php _e( 'Analytics', 'statically' ); ?>
                <span class="new"><?php _e( 'Beta', 'statically' ); ?></span>
            </a>
        </li>
        <?php endif; ?>
        <li><a data-stly-tab="speed" href="#speed"><?php _e ( 'Speed', 'statically'); ?></a></li>
        <?php if ( Statically::is_custom_domain() ) : ?>
        <li>
            <a data-stly-tab="caching" href="#caching">
                <?php _e ( 'Caching', 'statically'); ?>
                <span class="new"><?php _e( 'Beta', 'statically' ); ?></span>
            </a>
        </li>
        <?php endif; ?>
        <li><a data-stly-tab="extra" href="#extra"><?php _e( 'Extra', 'statically' ); ?></a></li>
        <li><a data-stly-tab="labs" href="#labs"><?php _e( 'Labs', 'statically' ); ?></a></li>
        <li><a data-stly-tab="tools" href="#tools"><?php _e( 'Tools ', 'statically' ); ?></a></li>
        <li>
            <a class="support-me" data-stly-tab="support-me" href="#support-me">
                <?php _e( 'Donate', 'statically' ); ?>
            </a>
        </li>
    <?php endif; ?>

    <?php if ( Statically::admin_pagenow( 'statically-debugger' ) ) : ?>
        <li>
            <a href="<?php echo admin_url( 'admin.php?page=statically' ); ?>">
                <i class="dashicons dashicons-arrow-left"></i>
                <?php _e( 'Back to Settings', 'statically' ); ?>
            </a>
        </li>
    <?php endif; ?>

    </ul>
</nav>
