<?php defined( 'ABSPATH' ) OR exit; ?>

<div data-stly-layout="general">
    <?php if ( ! statically_use_https() ) { ?>
        <p><i class="dashicons dashicons-warning" style="color:#ffb900"></i>
        <?php _e( 'In order for statically.io to work, website must have HTTPS enabled.', 'statically' ); ?>
        </p>
    <?php } ?>

    <h3 class="title"><?php _e( 'General', 'statically' ); ?></h3>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">
                <?php _e( 'Zone URL', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_url">
                        <input type="text" name="statically[url]" id="statically_url" value="<?php echo str_replace( 'cdn.statically.io/sites/', '', $options['url'] ); ?>" size="64" class="regular-text" required />
                    </label>

                    <p class="description">
                        <?php _e( 'Enter Zone URL without trailing slash', 'statically' ); ?>. <br>
                        <?php _e( 'Example:', 'statically' ); ?> <code>https://example.com</code> <?php _e( 'or', 'statically' ); ?> <code>https://cdn.example.com</code> <?php _e( 'if you have a custom domain setup', 'statically' ); ?>.
                    </p>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'API Key', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_api_key">
                        <input type="password" name="statically[statically_api_key]" id="statically_api_key" value="<?php echo $options['statically_api_key']; ?>" size="64" class="regular-text" required />
                    </label>

                    <p class="description">
                        <?php _e( 'API key to make this plugin working. Never share it to anybody! Treat this API key as a password. &#8212; <a href="https://statically.io/wordpress/" target="_blank">Get one here</a>', 'statically' ); ?>
                    </p>
                </fieldset>
            </td>
        </tr>

        <tr valign="top" <?php if ( ! Statically::is_custom_domain() ) echo 'style="display:none"'; ?>>
            <th scope="row">
                <?php _e( 'Zone ID', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_zone_id">
                        <input type="text" name="statically[statically_zone_id]" id="statically_zone_id" value="<?php echo $options['statically_zone_id']; ?>" size="64" class="regular-text" />
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top" <?php if ( Statically::is_custom_domain() ) echo 'style="display:none"'; ?>>
            <th scope="row">
                <?php _e( 'Images', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_img">
                        <input type="checkbox" name="statically[img]" id="statically_img" value="1" <?php checked(1, $options['img']) ?> />
                        <?php _e( 'Optimize image files with CDN (wp-content folder only)', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top" <?php if ( Statically::is_custom_domain() ) echo 'style="display:none"'; ?>>
            <th scope="row">
                <?php _e( 'CSS', 'statically' ); ?>
                <span class="new"><?php _e( 'New', 'statically' ); ?></span>
            </th>
            <td>
                <fieldset>
                    <label for="statically_css">
                        <input type="checkbox" name="statically[css]" id="statically_css" value="1" <?php checked(1, $options['css']) ?> />
                        <?php _e( 'Serve and automatically minify CSS files with CDN (wp-content folder only)', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top" <?php if ( Statically::is_custom_domain() ) echo 'style="display:none"'; ?>>
            <th scope="row">
                <?php _e( 'JavaScript', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_js">
                        <input type="checkbox" name="statically[js]" id="statically_js" value="1" <?php checked(1, $options['js']) ?> />
                        <?php _e( 'Serve and automatically minify JavaScript files with CDN (wp-content folder only)', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top" <?php if ( ! Statically::is_custom_domain() ) echo 'style="display:none"'; ?>>
            <th scope="row">
                <?php _e( 'Asset Inclusions', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_dirs">
                        <input type="text" name="statically[dirs]" id="statically_dirs" value="<?php echo $options['dirs']; ?>" size="64" class="regular-text" />
                        <?php _e( 'Default: <code>wp-content,wp-includes</code>', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'Assets in these directories will be pointed to the CDN URL. Enter the directories separated by', 'statically' ); ?> <code>,</code>
                    </p>
                </fieldset>
            </td>
        </tr>

        <tr valign="top" <?php if ( ! Statically::is_custom_domain() ) echo 'style="display:none"'; ?>>
            <th scope="row">
                <?php _e( 'Asset Exclusions', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_excludes">
                        <input type="text" name="statically[excludes]" id="statically_excludes" value="<?php echo $options['excludes']; ?>" size="64" class="regular-text" />
                        <?php _e( 'Default: <code>.php</code>', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'Enter the exclusions (directories or extensions) separated by', 'statically' ); ?> <code>,</code>
                    </p>
                </fieldset>
            </td>
        </tr>
    </table>

    <?php submit_button(); ?>
</div>
