<?php defined( 'ABSPATH' ) OR exit; ?>

<div data-stly-layout="extra">
    <h3 class="title"><?php _e( 'Extra', 'statically' ); ?></h3>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">
                <?php _e( 'Emoji CDN', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_emoji">
                        <input type="checkbox" name="statically[emoji]" id="statically_emoji" value="1" <?php checked(1, $options['emoji']) ?> />
                        <?php _e( 'Replace default wp.org Emoji CDN with statically.io', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'Favicon', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_favicon">
                        <input type="checkbox" name="statically[favicon]" id="statically_favicon" value="1" <?php checked(1, $options['favicon']) ?> />
                        <?php _e( 'Automatically generate a favicon for your website using the statically.io Icon service', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'This feature allows you to generate a personalized image based on the name of your website using the statically.io Icon service and then use it as your website&#39;s favicon. Use this feature if you haven&#39;t set one.', 'statically' ); ?>
                        <?php _e( 'See <a href="https://cdn.statically.io/icon/g/statically.io.png" target="_blank">example</a>.', 'statically' ); ?>
                    </p>

                    <label for="statically_favicon-shape">
                        <h4><?php _e( 'Shape', 'statically' ); ?></h4>
                        <select class="mr-1" name="statically[favicon_shape]">
                            <option <?php if ( 'rounded' === $options['favicon_shape'] ) echo 'selected="selected"'; ?> value="rounded"><?php _e( 'rounded', 'statically' ); ?></option>
                            <option <?php if ( 'square' === $options['favicon_shape'] ) echo 'selected="selected"'; ?> value="square"><?php _e( 'square', 'statically' ); ?></option>
                        </select>
                    </label>

                    <label for="statically_favicon-bg">
                        <h4><?php _e( 'Background', 'statically' ); ?></h4>
                        <input type="color" name="statically[favicon_bg]" class="mr-1" id="statically_favicon-bg" value="<?php echo $options['favicon_bg']; ?>" />
                    </label>

                    <label for="statically_favicon-color">
                        <h4><?php _e( 'Font Color', 'statically' ); ?></h4>
                        <input type="color" name="statically[favicon_color]" class="mr-1" id="statically_favicon-color" value="<?php echo $options['favicon_color']; ?>" />
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'Open Graph Image', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_og">
                        <input type="checkbox" name="statically[og]" id="statically_og" value="1" <?php checked(1, $options['og']) ?> />
                        <?php _e( 'Automatically generate beautiful OG Image for your posts and pages', 'statically' ); ?>
                    </label>

                    <p class="description">
                        <?php _e( 'Create beautiful new images from post and page titles using the statically.io OG Image service to embed in metadata. Useful for increasing visibility on Facebook and Twitter. Check this <a href="https://cdn.statically.io/og/Hello%20World.jpg" target="_blank">example</a>. Learn more about <a href="https://ogp.me" target="_blank">The Open Graph protocol</a>.', 'statically' ); ?>
                    </p>

                    <label for="statically_og-theme">
                        <h4><?php _e( 'Theme', 'statically' ); ?></h4>
                        <select class="mr-1" name="statically[og_theme]">
                            <option <?php if ( 'light' === $options['og_theme'] ) echo 'selected="selected"'; ?> value="light"><?php _e( 'light', 'statically' ); ?></option>
                            <option <?php if ( 'dark' === $options['og_theme'] ) echo 'selected="selected"'; ?> value="dark"><?php _e( 'dark', 'statically' ); ?></option>
                        </select>
                    </label>

                    <label for="statically_og-fontsize">
                        <h4><?php _e( 'Font Size', 'statically' ); ?></h4>
                        <select class="mr-1" name="statically[og_fontsize]">
                            <option <?php if ( 'medium' === $options['og_fontsize'] ) echo 'selected="selected"'; ?> value="medium"><?php _e( 'medium', 'statically' ); ?></option>
                            <option <?php if ( 'large' === $options['og_fontsize'] ) echo 'selected="selected"'; ?> value="large"><?php _e( 'large', 'statically' ); ?></option>
                            <option <?php if ( 'extra-large' === $options['og_fontsize'] ) echo 'selected="selected"'; ?> value="extra-large"><?php _e( 'extra-large', 'statically' ); ?></option>
                        </select>
                    </label>

                    <label for="statically_og-type">
                        <h4><?php _e( 'File Type', 'statically' ); ?></h4>
                        <select name="statically[og_type]">
                            <option <?php if ( 'jpeg' === $options['og_type'] ) echo 'selected="selected"'; ?> value="jpeg"><?php _e( 'jpeg', 'statically' ); ?></option>
                            <option <?php if ( 'png' === $options['og_type'] ) echo 'selected="selected"'; ?> value="png"><?php _e( 'png', 'statically' ); ?></option>
                        </select>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'WP Admin', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_wpadmin">
                        <input type="checkbox" name="statically[wpadmin]" id="statically_wpadmin" value="1" <?php checked(1, $options['wpadmin']) ?> />
                        <?php _e( 'Enable statically.io functionality in the WP Admin area', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'Relative Path', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_relative">
                        <input type="checkbox" name="statically[relative]" id="statically_relative" value="1" <?php checked(1, $options['relative']) ?> />
                        <?php _e( 'Enable CDN for relative paths', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'CDN HTTPS', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_https">
                        <input type="checkbox" name="statically[https]" id="statically_https" value="1" <?php checked(1, $options['https']) ?> />
                        <?php _e( 'Enable CDN for HTTPS connections', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'Remove Query Strings', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_query_strings">
                        <input type="checkbox" name="statically[query_strings]" id="statically_query_strings" value="1" <?php checked(1, $options['query_strings']) ?> />
                        <?php _e( 'Strip all query strings like <code>?ver=1.0</code> from static assets', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <?php _e( 'Developer Mode', 'statically' ); ?>
            </th>
            <td>
                <fieldset>
                    <label for="statically_dev">
                        <input type="checkbox" name="statically[dev]" id="statically_dev" value="1" <?php checked(1, $options['dev']) ?> />
                        <?php _e( 'Enable developer mode to add more options', 'statically' ); ?>
                    </label>
                </fieldset>
            </td>
        </tr>
    </table>

    <?php submit_button(); ?>
</div>
