<?php

namespace Salient\fns\tinymce;

/**
 * Enables the `Format` select drop down in Tinymce
 *
 * @param      array  $buttons  Tinymce button configuration
 *
 * @return     array  Filtered Tinymce button configuration
 */
function styleselect_options( $buttons ){
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons', __NAMESPACE__ . '\\styleselect_options' );

function tinymce_style_formats( $init_array ){
    $style_formats = [
        [
            'title' => 'p.lead',
            'block' => 'p',
            'classes' => 'lead',
            'wrapper' => false,
        ],
    ];
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;
}
add_filter( 'tiny_mce_before_init', __NAMESPACE__ . '\\tinymce_style_formats' );