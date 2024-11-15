<?php

namespace RSAB;

if (! defined('ABSPATH')) exit; 
class Enqueue
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'rsab_admin_script']);
        add_action('wp_enqueue_scripts', [$this, 'rsab_frontend_script']);
    }

    /**
     * Enqueue admin scripts and styles.
     */
    public function rsab_admin_script($hook_suffix)
    {
        // Enqueue media uploader
        wp_enqueue_media();

        // Enqueue the admin JavaScript file
        wp_enqueue_script(
            'rsab-admin-script',
            RSAB_DIR_URL . 'inc/assets/js/admin.js',
            ['jquery'],
            filemtime(RSAB_DIR_PATH . 'inc/assets/js/admin.js'),
            true
        );

        // Enqueue the admin stylesheet
        wp_enqueue_style(
            'rsab-admin-style',
            RSAB_DIR_URL . 'inc/assets/css/rsab-admin.css',
            [],
            filemtime(RSAB_DIR_PATH . 'inc/assets/css/rsab-admin.css')
        );

        // Load only on the Author Info settings page
        if ($hook_suffix === 'settings_page_really-simple-author-box-settings') {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('rsab-color-picker', RSAB_DIR_URL . 'inc/assets/js/color-picker.js', ['wp-color-picker'], true, true);
        }
    }

    /**
     * @param string $
     * Enqueue style for frontend
     */
    public function rsab_frontend_script()
    {
        // Check if the shortcode is present on the page
        if (is_singular() && has_shortcode(get_post()->post_content, 'rsab_author_box')) {
            // Enqueue the frontend stylesheet
            wp_enqueue_style(
                'rsab-frontend-style',
                RSAB_DIR_URL . 'inc/assets/css/rsab-frontend.css',
                [],
                filemtime(RSAB_DIR_PATH . 'inc/assets/css/rsab-frontend.css')
            );

            // Enqueue any additional scripts or styles if needed
        }
    }
}
