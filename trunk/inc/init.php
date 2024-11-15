<?php

namespace RSAB;

if (! defined('ABSPATH')) exit;
class Init
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
            'templates/rsab-profile.php',
            'settings.php',
            'shortcodes/init.php'
        ];

        foreach ($files as $file) {
            $file_path = RSAB_DIR_PATH . 'inc/' . $file;
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
        new \RSAB\Enqueue();
        new \RSAB\Profile();
        new \RSAB\Settings();
        new \RSAB\Shortcodes_Init();
    }
}
