<?php

function resquivel_theme_support(){
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'resquivel_theme_support');

function resquivel_register_styles(){
    $version = wp_get_theme() ->get( 'Version' );
    wp_enqueue_style('resquivel-css', get_template_directory_uri() . "/style.css", array(), $version, 'all');
} 
add_action('wp_enqueue_scripts', 'resquivel_register_styles');


function resquivel_menus() {
    $locations = array(
        'primary' => 'Desktop Primary',
        'footer' => 'Footer menu'
    );

    register_nav_menus($locations);
}

add_action('init', 'resquivel_menus');


?>
