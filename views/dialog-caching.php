<?php defined( 'ABSPATH' ) OR exit; ?>

<div class="stly-dialog" id="dialog-purge" title="Purge">
  <p><?php _e( '1 URL per line. Up to 10 URLs at a time.', 'statically' ); ?></p>
  <form id="purge-form" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
      <textarea name="purge_url" required></textarea>
      <input class="button button-primary btn-purge" id="purge-submit" name="purge_submit" type="submit" value="Purge">
      <p id="purge-ajax-load" style="display:none"><?php _e( 'Purging', 'statically' ); ?>...</p>
  </form>
  <p id="purge-result" class="purge-result" style="display:none"></p>
</div>

<div class="stly-dialog" id="dialog-purge-all" title="Purge All">
  <p><?php _e( 'Are you sure?', 'statically' ); ?></p>
  <form id="purge-all-form" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
    <input name="purge_all" value="1" type="hidden"></textarea>
    <input class="button button-primary btn-purge" id="purge-all-submit" name="purge_all_submit" type="submit" value="<?php _e( 'Yes, Purge All', 'statically' ); ?>">
    <p id="purge-all-ajax-load" style="display:none"><?php _e( 'Purging', 'statically' ); ?>...</p>
  </form>
  <p id="purge-all-result" class="purge-result" style="display:none"></p>
</div>
