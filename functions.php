<?php
// Include files
include_once 'lib/fns/breadcrumbs.php';
include_once 'lib/fns/debug.php';
include_once 'lib/fns/header.php';
include_once 'lib/fns/plugins.php';
include_once 'lib/fns/tinymce.php';

/**
 * Enqueues parent theme styles
 */
function salient_parent_theme_enqueue_styles() {
    $deregister_styles = ['salient-style','rgs','font-awesome','main-styles','responsive','skin-ascend'];
    foreach ($deregister_styles as $handle ) {
        wp_deregister_style( $handle );
    }
    $version = ( file_exists( get_stylesheet_directory() . '/lib/css/main.css' ) ) ? filemtime( get_stylesheet_directory() . '/lib/css/main.css' ) : '';
    wp_enqueue_style( 'salient-child-style', get_stylesheet_directory_uri() . '/lib/css/main.css', null, $version );

    wp_enqueue_script( 'global', get_stylesheet_directory_uri() . '/lib/js/global.js', ['jquery','nectarFrontend'], filemtime( get_stylesheet_directory() . '/lib/js/global.js' ), true );
    wp_localize_script( 'global', 'wpvars', ['breadcrumbs' => SalientChild\fns\breadcrumbs\get_breadcrumbs() ] );

}
add_action( 'wp_enqueue_scripts', 'salient_parent_theme_enqueue_styles', 99 );

// Enqueue TinyMCE Editor styles
add_editor_style( get_stylesheet_directory_uri() . '/lib/css/editor-styles.css' );