<?php

//Register the scripts
function registerScripts()
{
    $path = get_template_directory_uri() . '/assets/js/';
    //Removes the default wordpress jquery script
    wp_deregister_script('jquery');

    wp_register_script('jquery', $path . 'jquery-3.4.1.min.js', array(), '3.4.1', true);
    wp_enqueue_script('jquery');

    wp_register_script('scripts', $path . 'scripts.js', array(), '', true);
    wp_enqueue_script('scripts');

    wp_register_script('audioplayer', $path . 'audioplayer.js', array(), '', true);
    wp_enqueue_script('audioplayer');

    wp_register_script('fontSize', $path . 'fontSize.js', array(), '', true);
    wp_enqueue_script('fontSize');
}
add_action('wp_enqueue_scripts', 'registerScripts');


//Register the CSS styles
function registerStyles()
{
    $path = get_template_directory_uri() . '/assets/css/';
    wp_register_style('normalize', $path . 'normalize.css', array(), false,false);
    wp_enqueue_style('normalize');

    wp_register_style('style', $path . 'style.css', array(), false,false);
    wp_enqueue_style('style');

    wp_register_style('reverbera', $path . 'reverbera.css', array(), false,false);
    wp_enqueue_style('reverbera');

}
add_action('wp_enqueue_scripts', 'registerStyles');