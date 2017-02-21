<?php

add_action( 'wp_enqueue_scripts', 'salient_parent_theme_enqueue_styles', 99 );

function salient_parent_theme_enqueue_styles() {
    $deregister_styles = ['salient-style','rgs','font-awesome','main-styles','responsive','skin-ascend'];
    foreach ($deregister_styles as $handle ) {
        wp_deregister_style( $handle );
    }
    $version = ( file_exists( get_stylesheet_directory() . '/lib/css/main.css' ) ) ? filemtime( get_stylesheet_directory() . '/lib/css/main.css' ) : '';
    wp_enqueue_style( 'salient-child-style', get_stylesheet_directory_uri() . '/lib/css/main.css', null, $version );

}
