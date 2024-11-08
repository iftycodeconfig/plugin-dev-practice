<?php
namespace MyReactContactPlugin;

class Assets
{
public function __construct()
{
add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets']);
add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
}

// Enqueue assets for the frontend
public function enqueue_frontend_assets()
{
// Ensure the paths are correct
wp_enqueue_style('frontend-style', plugin_dir_url(__FILE__) . '../frontend/js/index.css');

// Correct script handle (it should match with the one you're localizing)
wp_enqueue_script('frontend-react-js', plugin_dir_url(__FILE__) . '../frontend/js/index.js', ['react', 'react-dom', 'react-jsx-runtime'], null, true);

// Localize script for AJAX requests (Ensure you're using the correct script handle)
wp_localize_script('frontend-react-js', 'contact_form_ajax', [
'ajax_url' => admin_url('admin-ajax.php'),
'nonce' => wp_create_nonce('contact_form_nonce')
]);
}

// Enqueue assets for the admin
public function enqueue_admin_assets()
{
wp_enqueue_style('admin-style', plugin_dir_url(__FILE__) . '../admin/js/index.css');
wp_enqueue_script('admin-js', plugin_dir_url(__FILE__) . '../admin/js/index.js', ['react', 'react-dom', 'react-jsx-runtime'], null, true);

// Localize script for admin AJAX requests
wp_localize_script('admin-js', 'contact_form_ajax', [
'ajax_url' => admin_url('admin-ajax.php'), // Admin AJAX URL
'nonce' => wp_create_nonce('contact_form_nonce') // Nonce for security
]);
}
}