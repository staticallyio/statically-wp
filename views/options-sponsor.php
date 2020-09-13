<?php defined( 'ABSPATH' ) OR exit; ?>

<div data-stly-layout="support-me">
    <section class="support-me">
        <img class="logo" src="<?php echo plugin_dir_url( STATICALLY_FILE ) . 'static/statically-mark.svg'; ?>" alt="Statically logo">
        <h3 class="title">
          <?php _e( 'Get your name put in the Statically repository!', 'statically' ); ?>
        </h3>
        <p class="description">
          <?php _e( 'Who is "me"? Hi, I\'m Frans Allen, do you love this project? Did this project help you in any way? Show love by monthly donation on Patreon, even a small amount will help me cover development and server expenses.', 'statically' ); ?>
        </p>
        <a class="button button-primary" href="https://www.patreon.com/fransallen" target="_blank">
          <?php _e( 'Become A Patron', 'statically' ); ?>
        </a>
    </section>
</div>