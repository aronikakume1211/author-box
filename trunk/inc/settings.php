<?php

namespace RSAB;

if (! defined('ABSPATH')) exit; // Exit if accessed directly
require RSAB_DIR_PATH . 'inc/utility/sanitization.php';

class Settings extends Sanitization
{
    private $sanitizer;

    public function __construct()
    {
        $this->sanitizer = new \RSAB\Sanitization();
        add_action('admin_menu', [$this, 'rsab_rsab_author_info_settings_menu']);
        add_action('admin_init', [$this, 'rsab_register_settings']);
    }

    /**
     * Add the settings page to the admin menu
     */
    public function rsab_rsab_author_info_settings_menu()
    {
        add_options_page(
            'Author Info Settings',
            'Author Box',
            'manage_options',
            'really-simple-author-box-settings',
            [$this, 'rsab_render_rsab_author_info_settings_page']
        );
    }

    /**
     * Render the settings page
     */
    public function rsab_render_rsab_author_info_settings_page()
    {
?>
        <div class="wrap">
            <h1>Author Info Settings</h1>
            <h2 class="nav-tab-wrapper">
                <a href="#layout" class="nav-tab nav-tab-active" id="layout-tab">Layout</a>
                <a href="#settings" class="nav-tab" id="settings-tab">Settings</a>
            </h2>
            <form method="post" action="options.php">
                <?php
                settings_fields('rsab_info_settings_group');

                // Render the layout settings tab
                echo '<div id="layout" class="tab-content">';
                $this->render_layout_tab();
                echo '</div>';

                // Render the general settings tab
                echo '<div id="settings" class="tab-content" style="display:none;">';
                $this->render_settings_tab();
                echo '</div>';

                submit_button();
                ?>
            </form>
        </div>
<?php
    }

    public function render_layout_tab()
    {
        $this->render_layout_field();
    }


    public function render_settings_tab()
    {
        $this->render_bg_color_field();
        $this->render_text_color_field();
        $this->render_image_width_field();
        $this->render_image_height_field();
        $this->render_border_radius_field();
        $this->render_show_user_link_field();
        $this->render_user_link_text_field();
        $this->render_shortcode_text_field();
    }

    /**
     * Register settings, sections, and fields
     */
    public function rsab_register_settings()
    {
        // Register the settings
        register_setting('rsab_info_settings_group', 'rsab_author_bg_color', ['sanitize_callback' => [$this->sanitizer, 'sanitize_color']]);
        register_setting('rsab_info_settings_group', 'rsab_author_text_color', ['sanitize_callback' => [$this->sanitizer, 'sanitize_color']]);
        register_setting('rsab_info_settings_group', 'rsab_author_layout', ['sanitize_callback' => [$this->sanitizer, 'sanitize_text']]);
        register_setting('rsab_info_settings_group', 'rsab_author_image_width', ['sanitize_callback' => [$this->sanitizer, 'sanitize_integer']]);
        register_setting('rsab_info_settings_group', 'rsab_author_image_height', ['sanitize_callback' => [$this->sanitizer, 'sanitize_integer']]);
        register_setting('rsab_info_settings_group', 'rsab_author_border_radius', ['sanitize_callback' => [$this->sanitizer, 'sanitize_integer']]);
        register_setting('rsab_info_settings_group', 'rsab_author_show_user_link', ['sanitize_callback' => [$this->sanitizer, 'sanitize_checkbox']]);
        register_setting('rsab_info_settings_group', 'rsab_author_user_link_text', ['sanitize_callback' => [$this->sanitizer, 'sanitize_text']]);
        register_setting('rsab_info_settings_group', 'rsab_shortcode_text', ['sanitize_callback' => [$this->sanitizer, 'sanitize_text']]);

        // Add a section to group the fields
        add_settings_section(
            'rsab_author_info_section',
            'Customize Author Info',
            null,
            'author-info-settings'
        );

        // Add individual fields
        add_settings_field(
            'rsab_author_bg_color',
            'Background Color',
            [$this, 'render_bg_color_field'],
            'author-info-settings',
            'rsab_author_info_section'
        );

        add_settings_field(
            'rsab_author_text_color',
            'Text Color',
            [$this, 'render_text_color_field'],
            'author-info-settings',
            'rsab_author_info_section'
        );

        add_settings_field(
            'rsab_author_image_width',
            'Author Image Width (px)',
            [$this, 'render_image_width_field'],
            'author-info-settings',
            'rsab_author_info_section'
        );

        add_settings_field(
            'rsab_author_image_height',
            'Author Image Height (px)',
            [$this, 'render_image_height_field'],
            'author-info-settings',
            'rsab_author_info_section'
        );

        add_settings_field(
            'rsab_author_border_radius',
            'Border Radius (0-100px)',
            [$this, 'render_border_radius_field'], // New field for border radius
            'author-info-settings',
            'rsab_author_info_section'
        );

        add_settings_field(
            'rsab_author_show_user_link',
            'Show User Link',
            [$this, 'render_show_user_link_field'],
            'author-info-settings',
            'rsab_author_info_section'
        );

        add_settings_field(
            'rsab_author_user_link_text',
            'User Link Text',
            [$this, 'render_user_link_text_field'],
            'author-info-settings',
            'rsab_author_info_section'
        );

        add_settings_field(
            'rsab_shortcode_text',
            'Shortcode',
            [$this, 'render_shortcode_text_field'],
            'author-info-settings',
            'rsab_author_info_section'
        );

        add_settings_field(
            'rsab_author_layout',
            'Select Layout',
            [$this, 'render_layout_field'],
            'author-info-settings',
            'rsab_author_info_section'
        );
    }

    public function render_show_user_link_field()
    {
        $value = get_option('rsab_author_show_user_link', '0');
        echo '<br /><br /><label for="rsab_author_show_user_link">';
        echo '<input type="checkbox" id="rsab_author_show_user_link" name="rsab_author_show_user_link" value="1" ' . checked(1, $value, false) . ' />';
        echo esc_html__(' Enable User Link', 'really-simple-author-box');
        echo '</label><br /><br />';
    }

    public function render_user_link_text_field()
    {
        $text = get_option('rsab_author_user_link_text', 'Read More');
        echo '<input type="text" name="rsab_author_user_link_text" value="' . esc_attr($text) . '" />';
    }
    /**
     * Render the shortcode field
     */

    public function render_shortcode_text_field()
    {
        $text = get_option('rsab_shortcode_text', '[rsab_author_box]');
        echo '<br /><br /><input type="text" name="rsab_shortcode_text" value="' . esc_attr($text) . '" onfocus="this.select();" />';
    }

    /**
     * Render the border radius field
     */
    public function render_border_radius_field()
    {
        $value = get_option('rsab_author_border_radius', 0);
        echo '<br /><br /><label>' . esc_html__('Border Radius', 'really-simple-author-box') . '</label> : ';
        echo '<input type="range" id="rsab_author_border_radius" name="rsab_author_border_radius" min="0" max="100" value="' . esc_attr($value) . '" oninput="authorBorderRadiusOutput.value = this.value" />';
        echo '<output id="authorBorderRadiusOutput" style="margin-left: 10px;">' . esc_attr($value) . '</output> %';
    }

    /**
     * Render the background color input field
     */
    public function render_bg_color_field()
    {
        $color = get_option('rsab_author_bg_color', '#f9f9f9');
        echo '<br /><label>' . esc_html__('Background Color', 'really-simple-author-box') . '</label> : ';
        echo '<input type="text" name="rsab_author_bg_color" value="' . esc_attr($color) . '" class="color-field" />';
    }

    /**
     * Render the text color input field
     */
    public function render_text_color_field()
    {
        $color = get_option('rsab_author_text_color', '#333');
        echo '<br /><br /><label>' . esc_html__('Text Color', 'really-simple-author-box') . '</label> : ';
        echo '<input type="text" name="rsab_author_text_color" value="' . esc_attr($color) . '" class="color-field" />';
    }

    /**
     * Render the author image width input field
     */
    public function render_image_width_field()
    {
        $width = get_option('rsab_author_image_width', '150');
        echo '<br /><br /><label>' . esc_html__('Width', 'really-simple-author-box') . '</label> : ';
        echo '<input type="number" name="rsab_author_image_width" value="' . esc_attr($width) . '" min="0" /> px';
    }

    /**
     * Render the author image height input field
     */
    public function render_image_height_field()
    {
        $height = get_option('rsab_author_image_height', '150');
        echo '<br /><br /><label>' . esc_html__('Height', 'really-simple-author-box') . '</label> : ';
        echo '<input type="number" name="rsab_author_image_height" value="' . esc_attr($height) . '" min="0" /> px';
    }


    /**
     * Render the layout selection dropdown
     */
    public function render_layout_field()
    {
        $selected_layout = get_option('rsab_author_layout', 'layout1');
        $bg_color = esc_attr(get_option('rsab_author_bg_color', '#f9f9f9'));
        $text_color = esc_attr(get_option('rsab_author_text_color', '#333'));
        $image_width = intval(get_option('rsab_author_image_width', '150'));
        $image_height = intval(get_option('rsab_author_image_height', '150'));
        $border_radius = intval(get_option('rsab_author_border_radius', '0'));

        $layouts = [
            'layout1' => esc_html__('Layout 1 - Avatar Left', 'really-simple-author-box'),
            'layout2' => esc_html__('Layout 2 - Avatar Right', 'really-simple-author-box'),
            'layout3' => esc_html__('Layout 3 - Centered', 'really-simple-author-box'),
        ];

        echo "<div class='layout-cards-container'>";

        foreach ($layouts as $key => $label) {
            $selected = ($selected_layout === $key) ? 'selected-layout' : '';

            echo "<label class='layout-card " . esc_attr($selected) . "' style='background-color: " . esc_attr($bg_color) . "; color: " . esc_attr($text_color) . ";'>";
            echo "<input type='radio' name='rsab_author_layout' value='" . esc_attr($key) . "' " . checked($selected_layout, $key, false) . ">";
            echo "<div class='layout-preview " . esc_attr($key) . "'>";
            echo "<img src='" . esc_url(RSAB_IMG) . "' alt='" . esc_attr($key) . "' 
            style='width: " . esc_attr($image_width) . "px; 
           height: " . esc_attr($image_height) . "px; 
           border-radius: " . esc_attr($border_radius) . "%;'>";

            echo "<div class='layout-preview-content'>";
            echo "<h2 style='color: " . esc_attr($text_color) . ";'>" . esc_html__('Author Name', 'really-simple-author-box') . "</h2>";
            echo "<p style='color: " . esc_attr($text_color) . ";'>" .
                esc_html__('Author Bio goes here in this layout preview. Author Bio goes here in this layout preview. Author Bio goes here in this layout preview', 'really-simple-author-box') .
                "</p>";

            echo "<a href='#' class='button' style='background-color: " . esc_attr($text_color) . "; color: " . esc_attr($bg_color) . ";'>" .
                esc_html__('Read More', 'really-simple-author-box') .
                "</a>";
            echo "</div>"; // Close layout-preview-content
            echo "</div>"; // Close layout-preview
            echo "</label>";
        }

        echo "</div>";
    }
}
