<?php defined( 'ABSPATH' ) OR exit; ?>

<div data-stly-layout="speed">
    <h3 class="title"><?php _e( 'Speed', 'statically' ); ?></h3>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">
                <?php _e( 'Auto WebP', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_webp">
                        <input type="checkbox" name="statically[webp]" id="statically_webp" value="1" <?php checked(1, $options['webp']) ?> />
                        <?php _e( 'Automatically generate WebP versions of original images on the fly', 'statically' ); ?>
                    </label>

                    <?php if ( ! Statically::is_custom_domain() ) : ?>
                        <p class="description">
                            <i class="dashicons dashicons-info"></i> <?php _e( 'CDN will send WebP when the resulting image is smaller than the original (only available via Cloudflare).', 'statically' ); ?>
                        </p>
                    <?php endif; ?>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'Image Quality', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_quality">
                        <input type="number" name="statically[quality]" id="statically_quality" value="<?php echo $options['quality']; ?>" min="0" max="100" style="max-width: 6em" />
                        <?php _e( ' % &#8212; Value between: <code>10 - 100</code>', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'Set the compression level for all images. Enter <code>0</code> to disable.', 'statically' ); ?>
                    </p>
                </fieldset>
            </td>
        </tr>

        <tr valign="top" <?php if ( !Statically::is_custom_domain() ) echo 'style="display:none"'; ?>>
            <th scope="row">
                <?php _e( 'Image Resize', 'statically' ); ?>
            </th>
            <td>
                <fieldset style="margin-bottom: 10px;">
                    <label for="statically_smartresize">
                        <input type="checkbox" name="statically[smartresize]" id="statically_smartresize" value="1" <?php checked(1, $options['smartresize']); ?> <?php if ( !Statically::is_custom_domain() ) echo 'disabled'; ?> />
                        <?php _e( 'Perfect image sizes for every device', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'This option allows you to use automatic image resizing for most WordPress media. You can still use the Max-width and Max-height manual options below to control other images not listed in the library.', 'statically' ); ?>
                    </p>
                </fieldset>

                <fieldset>
                    <label for="statically_width">
                        <h4 style="margin-top: 0;"><?php _e( 'Max-width', 'statically' ); ?></h4>
                        <input type="number" name="statically[width]" id="statically_width" value="<?php echo $options['width']; ?>" min="0" max="2000" style="max-width: 6em" />
                        <?php _e( ' px &#8212; Value up to: <code>2000</code>', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'Set the maximum width for all images. Enter <code>0</code> to disable.', 'statically' ); ?>
                    </p>

                    <label for="statically_height">
                        <h4><?php _e( 'Max-height', 'statically' ); ?></h4>
                        <input type="number" name="statically[height]" id="statically_height" value="<?php echo $options['height']; ?>" min="0" max="2000" style="max-width: 6em" />
                        <?php _e( ' px &#8212; Value up to: <code>2000</code>', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'Set the maximum height for all images. Enter <code>0</code> to disable.', 'statically' ); ?>
                    </p>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'WordPress Core Assets', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_wpcdn">
                        <input type="checkbox" name="statically[wpcdn]" id="statically_wpcdn" value="1" <?php checked(1, $options['wpcdn']) ?> />
                        <?php _e( 'Significantly saves internal bandwidth by serving core assets with CDN', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'Disable for Logged In Users', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_private">
                        <input type="checkbox" name="statically[private]" id="statically_private" value="1" <?php checked(1, $options['private']) ?> />
                        <?php _e( 'This will disable CDN for logged in users', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>
    </table>

    <?php submit_button(); ?>
</div>