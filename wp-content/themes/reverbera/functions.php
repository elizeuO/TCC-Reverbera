<?php

//removes wordpress admin bar
add_filter('show_admin_bar', '__return_false');

//Register and enqueue the scripts
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


//Register and enqueue the CSS styles
function registerStyles()
{
    $path = get_template_directory_uri() . '/assets/css/';
    wp_register_style('normalize', $path . 'normalize.css', array(), false, false);
    wp_enqueue_style('normalize');

    wp_register_style('style', $path . 'style.css', array(), false, false);
    wp_enqueue_style('style');

    wp_register_style('reverbera', $path . 'reverbera.css', array(), false, false);
    wp_enqueue_style('reverbera');

}

add_action('wp_enqueue_scripts', 'registerStyles');

add_theme_support('post-thumbnails');

//Creates the custom post type Audiolivro
function addCustomPostTypeAudiolivro()
{
    $labels = array(
        'name' => _x('Áudiolivros', 'post type general name'),
        'singular_name' => _x('Áudiolivro', 'post type singular name'),
        'add_new' => _x('Adicionar Novo', 'Novo item'),
        'add_new_item' => __('Novo Item'),
        'edit_item' => __('Editar Item'),
        'new_item' => __('Novo Item'),
        'view_item' => __('Ver Item'),
        'search_items' => __('Procurar Itens'),
        'not_found' => __('Nenhum registro encontrado'),
        'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
        'parent_item_colon' => '',
        'menu_name' => 'Áudiolivros',

    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'public_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has-singular' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => 'dashicons-format-audio',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
    );

    register_post_type('audiolivro', $args);
    flush_rewrite_rules();
}

add_action('init', 'addCustomPostTypeAudiolivro');

//Creates the taxonomy categorias to the postype audiolivro
register_taxonomy(
    "categorias",
    "audiolivro",
    array(
        "label" => "Categorias",
        "singular_label" => "Categoria",
        "rewrite" => true,
        "hierarchical" => true,
        'has_archive' => true
    )
);

//Creates the custom post type Autor
function addCustomPostTypeAutor()
{
    $labels = array(
        'name' => _x('Autor', 'post type general name'),
        'singular_name' => _x('Autor', 'post type singular name'),
        'add_new' => _x('Adicionar Novo', 'Novo item'),
        'add_new_item' => __('Novo Item'),
        'edit_item' => __('Editar Item'),
        'new_item' => __('Novo Item'),
        'view_item' => __('Ver Item'),
        'search_items' => __('Procurar Itens'),
        'not_found' => __('Nenhum registro encontrado'),
        'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
        'parent_item_colon' => '',
        'menu_name' => 'Autores',

    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'public_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has-singular' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => 'dashicons-admin-users',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
    );

    register_post_type('autor', $args);
    flush_rewrite_rules();
}

add_action('init', 'addCustomPostTypeAutor');
