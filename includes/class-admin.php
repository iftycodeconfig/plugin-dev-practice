<?php
namespace MyReactContactPlugin;

class Admin {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    public function add_admin_menu() {
        add_menu_page(
            'Contact Plugin',
            'Contact Plugin',
            'manage_options',
            'contact-plugin',
            [$this, 'render_admin_page'],
            'dashicons-email',
            6
        );
    }

    public function render_admin_page() {
        echo '<div id="my-plugin-admin-dashboard"></div>';
    }
}
