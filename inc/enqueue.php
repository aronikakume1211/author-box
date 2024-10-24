<?php

class GATB_Enqueue
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'gatb_admin_script']);
    }

    /**
     * Enqueue admin scripts and styles.
     */
    public function gatb_admin_script($hook_suffix)
    {
        // Enqueue media uploader
        wp_enqueue_media();

        // Enqueue the admin JavaScript file
        wp_enqueue_script('gatb-admin-script', GATB_DIR_URL . 'assets/js/admin.js', ['jquery'], null, true);

        // Enqueue the frontend stylesheet
        wp_enqueue_style('gatb-admin-style', GATB_DIR_URL . 'assets/css/gatb-admin.css');

        // Load only on the Author Info settings page
        if ($hook_suffix === 'settings_page_author-info-settings') {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('gatb-color-picker', GATB_DIR_URL . 'assets/js/color-picker.js', ['wp-color-picker'], false, true);
        }
    }
}
