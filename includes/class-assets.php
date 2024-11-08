<?php

namespace MyReactContactPlugin;

class Assets
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
    }

    // Helper function to enqueue scripts and styles
    private function enqueue_assets($type)
    {
        $base_dir = $type === 'frontend' ? '../frontend/js/' : '../admin/js/';
        $asset_file = plugin_dir_path(__FILE__) . "{$base_dir}index.asset.php";

        if (!file_exists($asset_file)) {
            return;
        }

        $asset = include $asset_file;

        // Enqueue JavaScript
        $js_handle = "{$type}-js";
        wp_enqueue_script(
            $js_handle,
            plugins_url("{$base_dir}index.js", __FILE__),
            array_merge($asset['dependencies'], ['wp-util']),
            $asset['version'],
            true
        );


        // Enqueue CSS based on RTL
        $css_handle = is_rtl() ? "{$type}-style-rtl" : "{$type}-style";
        $css_file = is_rtl() ? "{$base_dir}index-rtl.css" : "{$base_dir}index.css";
        wp_enqueue_style(
            $css_handle,
            plugins_url($css_file, __FILE__),
            array_filter(
                $asset['dependencies'],
                fn($style) => wp_style_is($style, 'registered')
            ),
            $asset['version']
        );

        // Localize script for AJAX requests
        wp_localize_script($js_handle, 'contact_form_ajax', [
            'nonce' => wp_create_nonce('contact_form_nonce')
        ]);
    }

    // Enqueue assets for the frontend
    public function enqueue_frontend_assets()
    {
        $this->enqueue_assets('frontend');
    }

    // Enqueue assets for the admin
    public function enqueue_admin_assets()
    {
        $this->enqueue_assets('admin');
    }
}
