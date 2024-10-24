<?php
class GATB_Settings
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'gatb_author_info_settings_menu']);
        add_action('admin_init', [$this, 'gatb_register_settings']);
    }

    /**
     * Add the settings page to the admin menu
     */
    public function gatb_author_info_settings_menu()
    {
        add_options_page(
            'Author Info Settings',
            'Author Info',
            'manage_options',
            'author-info-settings',
            [$this, 'gatb_render_author_info_settings_page']
        );
    }

    /**
     * Render the settings page
     */
    public function gatb_render_author_info_settings_page()
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
                settings_fields('author_info_settings_group');

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
    }

    /**
     * Register settings, sections, and fields
     */
    public function gatb_register_settings()
    {
        // Register the settings
        register_setting('author_info_settings_group', 'author_bg_color');
        register_setting('author_info_settings_group', 'author_text_color');
        register_setting('author_info_settings_group', 'author_layout');
        register_setting('author_info_settings_group', 'author_image_width');
        register_setting('author_info_settings_group', 'author_image_height');
        register_setting('author_info_settings_group', 'author_border_radius');

        // Add a section to group the fields
        add_settings_section(
            'author_info_section',
            'Customize Author Info',
            null,
            'author-info-settings'
        );

        // Add individual fields
        add_settings_field(
            'author_bg_color',
            'Background Color',
            [$this, 'render_bg_color_field'],
            'author-info-settings',
            'author_info_section'
        );

        add_settings_field(
            'author_text_color',
            'Text Color',
            [$this, 'render_text_color_field'],
            'author-info-settings',
            'author_info_section'
        );

        add_settings_field(
            'author_image_width',
            'Author Image Width (px)',
            [$this, 'render_image_width_field'],
            'author-info-settings',
            'author_info_section'
        );

        add_settings_field(
            'author_image_height',
            'Author Image Height (px)',
            [$this, 'render_image_height_field'],
            'author-info-settings',
            'author_info_section'
        );

        add_settings_field(
            'author_border_radius',
            'Border Radius (0-100px)',
            [$this, 'render_border_radius_field'], // New field for border radius
            'author-info-settings',
            'author_info_section'
        );

        add_settings_field(
            'author_layout',
            'Select Layout',
            [$this, 'render_layout_field'],
            'author-info-settings',
            'author_info_section'
        );
    }

    /**
     * 
     */
    public function render_border_radius_field()
    {
        $value = get_option('author_border_radius', 0); // Default to 0 if not set
        echo '<br /><br /><label>Border Radius</label> :<input type="range" id="author_border_radius" name="author_border_radius" min="0" max="100" value="' . esc_attr($value) . '" oninput="authorBorderRadiusOutput.value = this.value" />';
        echo '<output id="authorBorderRadiusOutput" style="margin-left: 10px;">' . esc_attr($value) . '</output> %';
    }

    /**
     * Render the background color input field
     */
    public function render_bg_color_field()
    {
        $color = get_option('author_bg_color', '#f9f9f9');
        echo "<br /><label>Background Color</label> :<input type='text' name='author_bg_color' value='$color' class='color-field' />";
    }

    /**
     * Render the text color input field
     */
    public function render_text_color_field()
    {
        $color = get_option('author_text_color', '#333');
        echo "<br /><br /><label>Text Color</label> :<input type='text' name='author_text_color' value='$color' class='color-field' />";
    }

    /**
     * Render the author image width input field
     */
    public function render_image_width_field()
    {
        $width = get_option('author_image_width', '150'); // Default width
        echo "<br /><br /><label>Width</label> :<input type='number' name='author_image_width' value='$width' min='0' /> px"; // Add 'px' label
    }

    /**
     * Render the author image height input field
     */
    public function render_image_height_field()
    {
        $height = get_option('author_image_height', '150'); // Default height
        echo "<br /><br /><label>Height</label> :<input type='number' name='author_image_height' value='$height' min='0' /> px"; // Add 'px' label
    }

    /**
     * Render the layout selection dropdown
     */
    public function render_layout_field()
    {
        $selected_layout = get_option('author_layout', 'layout1');
        $bg_color = get_option('author_bg_color', '#f9f9f9');
        $text_color = get_option('author_text_color', '#333');
        $image_width = get_option('author_image_width', '150');
        $image_height = get_option('author_image_height', '150');
        $border_radius = get_option('author_border_radius', '0');

        $layouts = [
            'layout1' => 'Layout 1 - Avatar Left',
            'layout2' => 'Layout 2 - Avatar Right',
            'layout3' => 'Layout 3 - Centered',
        ];

        echo "<div class='layout-cards-container'>";

        foreach ($layouts as $key => $label) {
            $selected = ($selected_layout === $key) ? 'selected-layout' : '';
            echo "
            <label class='layout-card $selected' style='background-color: $bg_color; color: $text_color;'>
                <input type='radio' name='author_layout' value='$key' " . checked($selected_layout, $key, false) . ">
                <div class='layout-preview $key'>
                    <img src='" . GATB_IMG . "' alt='$key' style='width: {$image_width}px; height: {$image_height}px; border-radius: {$border_radius}%;'>
                    <div class='layout-preview-content' >
                        <h2 style='color: $text_color;'>Author Name</h2>
                        <p style='color: $text_color;'>Author Bio goes here in this layout preview. Author Bio goes here in this layout preview Author Bio goes here in this layout preview</p>
                        <a href='#' class='button' style='background-color: $text_color; color: $bg_color;'>Read More</a>
                    </div>
                </div>
            </label>
        ";
        }

        echo "</div>";
    }
}
