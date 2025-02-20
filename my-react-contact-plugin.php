<?php
/*
Plugin Name: My React Contact Plugins
Description: A contact form plugin with React-based admin dashboard and frontend UI.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) exit;

define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MY_PLUGIN_URL', plugin_dir_url(__FILE__));

// Autoload classes
spl_autoload_register(function ($class) {
    $prefix = 'MyReactContactPlugin\\';
    $base_dir = plugin_dir_path(__FILE__) . 'includes/'; // Ensure correct path
    $len = strlen($prefix);
    
    // Only load classes that are within the MyReactContactPlugin namespace
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    // Get the relative class name and convert to lowercase, replace _ with -
    $relative_class = strtolower(str_replace('_', '-', substr($class, $len)));
    
    // Determine the file path for the class
    $file = $base_dir . 'class-' . $relative_class . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});


use MyReactContactPlugin\Plugin;
register_activation_hook(__FILE__, ['MyReactContactPlugin\Database', 'create_table']); // Create DB table on activation

new Plugin();
