<?php
class GATB_Init
{
    public function __construct()
    {
        // Include required files
        $this->load_dependencies();

        // Initialize the required classes
        $this->init_classes();
    }

    /**
     * Load required dependencies.
     */
    private function load_dependencies()
    {
        $files = [
            'enqueue.php',
            'templates/gatb-profile.php',
            'settings.php',
            'shortcodes/init.php'
        ];

        foreach ($files as $file) {
            $file_path = GATB_DIR_PATH . 'inc/' . $file;
            if (file_exists($file_path)) {
                include_once($file_path);
            }
        }
    }

    /**
     * Initialize the required classes
     */
    private function init_classes()
    {
        new GATB_Enqueue();
        new GATB_Profile();
        new GATB_Settings();
        new GATB_Shortcodes_Init();
    }
}
