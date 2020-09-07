<?php defined( 'ABSPATH' ) OR exit; ?>

<div data-stly-layout="caching">
  <h3 class="title"><?php _e( 'Caching', 'statically' ); ?></h3>
  <table class="form-table">
    <tr valign="top">
      <th scope="row">
        <?php _e( 'Purge Cache', 'statically' ); ?>
      </th>
      <td>
        <fieldset>
          <label for="statically_purge">
            <a class="button button-primary" id="btn-purge"><?php _e( 'Purge URL', 'statically' ); ?></a>
            <a class="button button-primary" id="btn-purge-all"><?php _e( 'Purge All', 'statically' ); ?></a>
          </label>
        </fieldset>
      </td>
    </tr>
  </table>
</div>