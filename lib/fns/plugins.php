<?php

namespace Salient\fns\plugins;

/**
 * Filters call to `get_users()` by author_widget
 *
 * @param      array  $user_args  Arguments passed to get_user()
 *
 * @return     array  Filtered arguments to be passed to get_user().
 */
function author_widget_args( $user_args ) {
    $user_args['orderby'] = 'meta_value';
    $user_args['meta_key'] = 'nickname';
    $user_args['role'] = 'author';
    $user_args['who'] = null;
    return $user_args;
}
add_filter( 'author_widget_user_args', __NAMESPACE__ . '\\author_widget_args' );