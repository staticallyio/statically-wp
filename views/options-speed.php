<?php defined( 'ABSPATH' ) OR exit; ?>

<div data-stly-layout="speed">
    <h3 class="title"><?php _e( 'Speed', 'statically' ); ?></h3>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">
                <?php _e( 'WordPress Core Assets', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_wpcdn">
                        <input type="checkbox" name="statically[wpcdn]" id="statically_wpcdn" value="1" <?php checked(1, $options['wpcdn']) ?> />
                        <?php _e( 'Accelerate WordPress core static assets with Statically WP-CDN. Default: <code>ON</code>', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'That means if core/plugin/theme assets like JavaScript and CSS are available on the WordPress SVN, then serve them using Statically WP-CDN. This is useful to reduce load on your server.', 'statically' ); ?>
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
                        <?php _e( 'Enable Smart Image Resize. Default: <code>OFF</code>', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'This option allows you to use automatic image resizing for most WordPress media. You can still use the Max-width and Max-height manual options below to control other images that are not listed in the library.', 'statically' ); ?>
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
                <?php _e( 'Image Quality', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_quality">
                        <input type="number" name="statically[quality]" id="statically_quality" value="<?php echo $options['quality']; ?>" min="0" max="100" style="max-width: 6em" />
                        <?php _e( ' % &#8212; Value between: <code>10 - 100</code>', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'Set the compression rate for all images. Enter <code>0</code> to disable.', 'statically' ); ?>
                    </p>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'Auto WebP', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_webp">
                        <input type="checkbox" name="statically[webp]" id="statically_webp" value="1" <?php checked(1, $options['webp']) ?> />
                        <?php _e( 'Automatically convert images into WebP format. Default: <code>ON</code>', 'statically' ); ?>
                    </label>

                    <?php if ( ! Statically::is_custom_domain() ) : ?>
                        <p class="description">
                            <?php _e( 'A feature: Statically will send a WebP when image is smaller than the original (currently available over Cloudflare only)', 'statically' ); ?>.
                            <?php echo sprintf(
                                '<a href="https://statically.discourse.group/t/82" target="_blank">%s</a>',
                                __( 'Learn more', 'statically' ) ); ?>
                        </p>
                    <?php endif; ?>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'Disable for Logged-in Users', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_private">
                        <input type="checkbox" name="statically[private]" id="statically_private" value="1" <?php checked(1, $options['private']) ?> />
                        <?php _e( 'Turn off Statically for logged-in users. Default: <code>OFF</code>', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'Exclude Query Strings', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_qs-excludes">
                        <input type="text" name="statically[qs_excludes]" id="statically_qs-excludes" value="<?php echo $options['qs_excludes']; ?>" size="64" class="regular-text" />
                        <?php _e( 'Default: <code>no-statically</code>', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'Pages with query string containing these parameters will not perform Statically optimization. For example, if we set <code>no-statically</code> then <code>/?no-statically=1</code> will not be optimized. Enter the query string keys separated by', 'statically' ); ?> <code>,</code>
                    </p>

                    <p class="description">
                        <?php _e( 'This can be useful when you use other plugins that require query string to work and you want to turn off Statically to avoid possible JavaScript errors.', 'statically' ); ?>
                    </p>
                </fieldset>
            </td>
        </tr>
    </table>

    <?php submit_button(); ?>
</div>