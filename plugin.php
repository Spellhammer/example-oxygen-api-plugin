<?php

/*
Plugin Name: My Oxygen Elements
Author: You
Author URI: https://example.com
Description: Add custom elements to Oxygen.
Version: 1.0
*/

add_action('plugins_loaded', 'my_oxygen_elements_init');

function my_oxygen_elements_init()
{

    if (!class_exists('OxygenElement')) {
        return;
    }

    foreach ( glob(plugin_dir_path(__FILE__) . "elements/*.php" ) as $filename)
    {
        include $filename;
    }

}
