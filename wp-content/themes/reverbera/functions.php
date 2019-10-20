<?php

//Enqueue the stylesheets to the head
function enqueue_styles() {
    wp_enqueue_style( 'normalize', 'css/normalize.css\'', false );
    wp_enqueue_style( 'style', 'css/style.css\'', false );
    wp_enqueue_style( 'reverbera', 'css/reverbera.css\'', false );
}

add_action( 'wp_enqueue_scripts', 'enqueue_styles' );