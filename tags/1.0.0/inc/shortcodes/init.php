<?php

namespace RSAB;

if (! defined('ABSPATH')) exit;
class Shortcodes_Init
{
    private $selected_layout;
    private $bg_color;
    private $text_color;
    private $image_width;
    private $image_height;
    private $border_radius;
    private $show_link;
    private $read_more_text;

    public function __construct()
    {
        // Retrieve plugin settings
        $this->selected_layout = get_option('rsab_author_layout', 'layout1');
        $this->bg_color = get_option('rsab_author_bg_color', '#f9f9f9');
        $this->text_color = get_option('rsab_author_text_color', '#333');
        $this->image_width = get_option('rsab_author_image_width', '150');
        $this->image_height = get_option('rsab_author_image_height', '150');
        $this->border_radius = get_option('rsab_author_border_radius', '0');
        $this->show_link = get_option('rsab_author_show_user_link', '1');
        $this->read_more_text = get_option('rsab_author_user_link_text', 'Read More');


        // Initialize shortcodes
        add_action('init', [$this, 'rsab_shortcodes_init']);
    }


    /**
     * Register shortcodes
     */
    public function rsab_shortcodes_init()
    {
        add_shortcode('rsab_author_box', [$this, 'rsab_render_author_box']);
    }

    public function rsab_render_author_box()
    {
        $file_path = RSAB_DIR_PATH . 'inc/templates/';

        // Layout data to be passed to templates
        $layout_data = [
            'bg_color' => $this->bg_color,
            'text_color' => $this->text_color,
            'image_width' => $this->image_width,
            'image_height' => $this->image_height,
            'border_radius' => $this->border_radius,
            'show_link' => $this->show_link,
            'read_more_text' => $this->read_more_text,
            'layout' => $this->selected_layout
        ];

        return $this->include_template($file_path . 'layout.php', $layout_data);
    }

    /**
     * Safely include a template file.
     */
    private function include_template($path, $data = [])
    {
        if (file_exists($path)) {
            ob_start();
            include $path;
            return ob_get_clean();
        } else {
            return '<p>Error: Template not Selected.</p>';
        }
    }
}
