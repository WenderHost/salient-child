<?php

namespace SalientChild\fns\acf;

// Save ACF Calendar Events to post content
function save_calendar_events( $post_id ) {
    $post_title = get_the_title( $post_id );

    // Only run this code if we're on a particilar post / page
    if( 'Calendar Events' != $post_title )
        return;

    write_log( 'Saving Calendar Events to post_content...' );
    // Start an output buffer
    ob_start();

    // Loop over our testimonials
    if ( have_rows( 'events' ) ) : ?>
        <div class="calendar-events wpb_row vc_row-fluid vc_row standard_section">
            <?php while ( have_rows( 'events' ) ) : the_row() ?>
                <div class="col span_12 dark left event">
                    <div class="vc_col-sm-3">
                        <?php
                        $thumbnail = get_sub_field( 'thumbnail' );
                        if( ! empty( $thumbnail ) && is_array( $thumbnail ) ){
                            ?><img class="alignleft thumbnail" src="<?= $thumbnail['url']; ?>" alt="<?= $thumbnail['alt']; ?>" /><?php
                        }
                        ?>
                    </div>
                    <div class="vc_col-md-5">
                        <h3><?php the_sub_field( 'title' ) ?></h3>
                        <?php the_sub_field( 'description' ) ?>
                    </div>
                    <div class="vc_col-md-4 details">
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
                        if( is_email( $rsvp_link ) )
                            $rsvp_link = 'mailto:' . $rsvp_link;
                        write_log( '$rsvp_link = ' . $rsvp_link );
                        if( ! empty( $rsvp_link ) ){
                            echo '<p><a class="button" href="' . $rsvp_link . '" target="_blank">RSVP</a></p>';
                        }
                        ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div><!-- .calendar-events -->
    <?php endif;

    // Store output buffer
    $new_post_content = ob_get_clean();

    // Update the post_content
    wp_update_post( ['ID' => $post_id, 'post_content' => $new_post_content ] );


}
add_action('acf/save_post', __NAMESPACE__ . '\\save_calendar_events', 20);