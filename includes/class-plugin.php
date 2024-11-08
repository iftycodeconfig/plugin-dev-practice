<?php

namespace MyReactContactPlugin;

class Plugin
{
    public function __construct()
    {
        $this->initialize_classes();
    }

    private function initialize_classes()
    {
        new Database();
        new Assets();
        new Admin();
        new Frontend();
        new Ajax();
    }
}
