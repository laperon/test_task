<?php

/**
 * Notication admin for new post
 *
 * @param $new_status
 * @param $old_status
 * @param $post
 *
 * @return void
 */

function admin_notification( $new_status, $old_status, $post ) {
	if ( $new_status == 'publish' && $old_status != 'publish' && $post->post_type == 'ads' ) {
		$author  = get_userdata( $post->post_author );
		$message = "
            Hi " . $author->display_name . ",
            New post, " . $post->post_title . " has just been published at " . get_permalink( $post->ID ) . ".
        ";

		wp_mail( $author->user_email, "New Post Published", $message );
	}
}
add_action( 'transition_post_status', 'admin_notification', 10, 3 );