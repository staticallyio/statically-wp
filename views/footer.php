<?php defined( 'ABSPATH' ) OR exit; ?>

<footer class="stly stly-footer">
    <div class="mission">
        <em>&#8212; <?php _e( 'In mission to make static files easy to manage and fast to deliver.', 'statically' ); ?> &#8212;</em>
    </div>

    <a href="https://statically.io" target="_blank"><?php _e( 'About', 'statically'); ?></a>
    <a href="https://wordpress.org/plugins/statically/#description-header" target="_blank"><?php _e( 'Features', 'statically'); ?></a>
    <a href="https://statically.io/docs/" target="_blank"><?php _e( 'Docs', 'statically'); ?></a>

    <div class="social">
        <span class="rating">
            <?php _e( '<span class="wide-display">Do you think this is useful? Be kind and</span> rate statically.io', 'statically' ); ?>
            <a class="stars" href="https://wordpress.org/support/plugin/statically/reviews/?filter=5#new-post" target="_blank">
                <i class="dashicons dashicons-star-filled"></i>
                <i class="dashicons dashicons-star-filled"></i>
                <i class="dashicons dashicons-star-filled"></i>
                <i class="dashicons dashicons-star-filled"></i>
                <i class="dashicons dashicons-star-filled"></i>
            </a>
        </span>
        <p><?php _e( 'and', 'statically' ); ?></p>
        <span class="twitter">
            <span class="mobile-block">
                <?php _e( 'Share with your friends so their website is as fast as yours!', 'statically' ); ?>
            </span>
            <a
                class="tweet"
                href="https://twitter.com/intent/tweet?hashtags=statically&amp;related=statically&amp;url=https://statically.io&amp;text=<?php _e(  'The all-in-one solution for your website static asset optimization and CDN, try @staticallyio now!', 'statically' ); ?>"
                target="_blank"
            >
                <i class="fab fa-twitter"></i> <?php _e ( 'Tweet', 'statically' ); ?>
            </a>
        </span>

        <p class="project-by">
            A project by <a href="https://upset.dev" target="_blank"> upset.dev</a> &bull; Thank you for your time
        </p>
    </div>
</footer>