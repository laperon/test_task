<?php

/**
 * Functions for filter and structure data
 */
class Helper {
	public static function the_attachment_image( int $post_id ) {
		$attachment_id = get_post_meta( $post_id, '_custom_field_meta_image_key', 'true' );
		if ( $attachment_id ) {
			$image = wp_get_attachment_image( $attachment_id, 'large' );

			if ( ! empty( $image ) ) {
				return $image;
			}
		}

		return false;
	}
}