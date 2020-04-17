<?php

/**
 * Plugin translations.
 */
function wp_helloworld_load_plugin_textdomain()
{
    load_plugin_textdomain('wp-helloworld-plugin');
}

add_action('plugins_loaded', 'wp_helloworld_load_plugin_textdomain');

/**
 * Plugin settings menu.
 */
function wp_helloworld_plugin_settings_menu()
{
    add_options_page('Hello World', 'Hello World', 'read', 'wp-helloworld-plugin', 'wp_helloworld_plugin_settings');
}

add_action('admin_menu', 'wp_helloworld_plugin_settings_menu');

/**
 * Plugin settings.
 */
function wp_helloworld_plugin_settings()
{
    $saved = false;

    if (isset($_POST['save']) && check_admin_referer('wp_helloworld_plugin_settings', 'wp_helloworld_plugin_settings_nonce')) {
        $downloadKey = isset($_POST['wp_helloworld_plugin_downloadkey'])
            ? sanitize_text_field(wp_unslash(wp_strip_all_tags($_POST['wp_helloworld_plugin_downloadkey'])))
            : '';

        // Here you can validate or activate the provided download key, before saving it to database.
        // Please see the download key validation and/or activation tutorials.

        // Once done validating/activating the download key, update the option
        update_option('wp_helloworld_plugin_downloadkey', $downloadKey);

        $saved = true;
    }

    $downloadKey = get_option('wp_helloworld_plugin_downloadkey', ''); ?>

    <div class="wrap">
        <h1><?php echo __('Hello World', 'wp-helloworld-plugin'); ?></h1>
        <?php if ($saved) : ?>
            <div id="message" class="updated fade">
                <p><strong><?php echo __('Settings saved.', 'wp-helloworld-plugin'); ?></strong></p>
            </div>
        <?php endif ?>
        <h2>
            <?php echo __('Please enter your download key.', 'wp-helloworld-plugin'); ?>
        </h2>
        <form method="post" action="">
            <div>
                <?php wp_nonce_field('wp_helloworld_plugin_settings', 'wp_helloworld_plugin_settings_nonce'); ?>
                <p>
                    <label for="wp_helloworld_plugin_downloadkey"><?php echo __('Download key', 'wp-helloworld-plugin'); ?></label>
                </p>
                <input type="text" name="wp_helloworld_plugin_downloadkey" id="wp_helloworld_plugin_downloadkey" value="<?php echo esc_attr($downloadKey); ?>" />
            </div>
            <p class="submit">
                <input class="button-primary" name="save" type="submit" value="<?php echo __('Save download key', 'wp-helloworld-plugin'); ?>" />
            </p>
        </form>
    </div>
<?php
}
