<?php defined( 'ABSPATH' ) OR exit; ?>

<div data-stly-layout="analytics" class="analytics">
  <p id="analytics-error-message" style="margin-top:-1em;margin-bottom:2em"></p>
  <div class="date"><?php _e( 'Data based on 1 month usage', 'statically' ); ?></div>
  <section class="summary">
    <div>
      <h3><?php _e( 'Total Requests', 'statically' ); ?></h3>
      <p id="TotalRequests">N</p>
    </div>
    
    <div>
      <h3><?php _e( 'Total Bandwidth', 'statically' ); ?></h3>
      <p id="TotalBandwidth">N</p>
    </div>

    <div>
      <h3><?php _e( 'Cache HIT Ratio', 'statically' ); ?></h3>
      <p id="CacheHitRate">N</p>
    </div>
  </section>
</div>

<script>
  jQuery('#analytics-error-message').hide();
  jQuery.getJSON('<?php echo admin_url( 'admin.php?page=statically&statically_analytics_data=1' ); ?>', function(data) {
    jQuery('#TotalRequests').html(data.TotalRequests);
    jQuery('#TotalBandwidth').html(data.TotalBandwidth);
    jQuery('#CacheHitRate').html(data.CacheHitRate);
    if ( data.status == 'error' ) {
      jQuery('#analytics-error-message').show().html('<i class="dashicons dashicons-warning" style="color:#ffb900"></i> ' + data.message); 
    }
  });
</script>