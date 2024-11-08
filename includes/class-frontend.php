<?php
namespace MyReactContactPlugin;

class Frontend {
    public function __construct() {
        add_shortcode('contact_form', [$this, 'render_contact_form']);
    }

    public function render_contact_form() {
        ob_start();
        ?>
        <div id="my-plugin-contact-form"></div>
        <?php
        return ob_get_clean();
    }
}
