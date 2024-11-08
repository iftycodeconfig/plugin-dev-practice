<?php

namespace MyReactContactPlugin;

class Ajax
{
    public function __construct()
    {
        // Hook for logged-in users
        add_action('wp_ajax_submit_contact_form', [$this, 'handle_form_submission']);

        // Hook for non-logged-in users
        add_action('wp_ajax_nopriv_submit_contact_form', [$this, 'handle_form_submission']);

        // Hook to fetch submissions
        add_action('wp_ajax_get_contact_form_submissions', [$this, 'get_contact_form_submissions']);
        add_action('wp_ajax_nopriv_get_contact_form_submissions', [$this, 'get_contact_form_submissions']);
    }

    // Handle form submission
    public function handle_form_submission()
    {
        error_log(print_r($_POST, true)); // Log POST data
        // Verify nonce for security
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'contact_form_nonce')) {
            wp_send_json_error(['message' => 'Nonce verification failed.']);
        }

        // Sanitize input data
        $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';


        if (empty($name) || empty($email) || empty($message)) {
            wp_send_json_error(['message' => 'All fields are required.']);
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'contact_submissions';

        // Insert the data into the database
        $result = $wpdb->insert(
            $table_name,
            [
                'name' => $name,
                'email' => $email,
                'message' => $message,
                'created_at' => current_time('mysql'),
            ]
        );

        // Send the appropriate response
        if ($result) {
            wp_send_json_success(['message' => 'Form submitted successfully!']);
        } else {
            wp_send_json_error(['message' => 'There was an error submitting the form.']);
        }
    }

    // Get contact form submissions
    public function get_contact_form_submissions()
    {
        // Verify nonce for security
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'contact_form_nonce')) {
            wp_send_json_error(['message' => 'Nonce verification failed.']);
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'contact_submissions';

        // Fetch submissions from the database
        $submissions = $wpdb->get_results(
            "SELECT * FROM $table_name ORDER BY created_at DESC"
        );

        if ($submissions) {
            wp_send_json_success(['data' => $submissions]);
        } else {
            wp_send_json_error(['message' => 'No submissions found.']);
        }
    }
}
