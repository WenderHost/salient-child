<?php

namespace SalientChild\fns\acf;

// Save ACF Calendar Events to post content
function save_calendar_events( $post_id ) {
    $post_title = get_the_title( $post_id );

    // Only run this code if we're on a particilar post / page
    if( 'Calendar Events' === $post_title ) {
        write_log( 'Saving Calendar Events to post_content...' );
        // Start an output buffer
        ob_start();

        // Loop over our testimonials
        if ( have_rows( 'events' ) ) : ?>
            <table class="calendar-events">
                <colgroup>
                    <col style="width: 20%">
                    <col style="width: 50%">
                    <col style="width: 30%">
                </colgroup>
                <thead>
                    <tr>
                        <th colspan="2">Event Description</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ( have_rows( 'events' ) ) : the_row() ?>
                    <tr>
                        <td class="thumbnail">
                            <?php
                            $thumbnail = get_sub_field( 'thumbnail' );
                            if( ! empty( $thumbnail ) && is_array( $thumbnail ) ){
                                ?><img src="<?= $thumbnail['url']; ?>" alt="<?= $thumbnail['alt']; ?>" /><?php
                            }
                            ?>
                        </td>
                        <td class="description">
                            <h3><?php the_sub_field( 'title' ) ?></h3>
                            <?php the_sub_field( 'description' ) ?>
                        </td>
                        <td class="details">
                            <h5>Time</h5>
                            <?php the_sub_field( 'time' ) ?>
                            <h5>Location</h5>
                            <?php
                            $location_link = get_sub_field( 'location_link' );
                            if( ! empty( $location_link ) ){
                                echo '<a href="' . $location_link . '" target="_blank">' . get_sub_field( 'location' ) . '</a>';
                            } else {
                                the_sub_field( 'location_link' );
                            }
                            $rsvp_link = get_sub_field( 'rsvp_link' );
                            if( ! empty( $rsvp_link ) ){
                                echo '<a class="button" href="' . $rsvp_link . '" target="_blank">RSVP</a>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif;

        // Store output buffer
        $new_post_content = ob_get_clean();

        // Update the post_content
        wp_update_post( ['ID' => $post_id, 'post_content' => $new_post_content ] );

    }
}
add_action('acf/save_post', __NAMESPACE__ . '\\save_calendar_events', 20);