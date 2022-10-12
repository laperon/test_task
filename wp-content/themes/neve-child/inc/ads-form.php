<?php

/**
 * Ads Form
 */
class AdsForm {
	public function __construct() {
		add_action( 'wp_ajax_save_form_data', array( $this, 'save_data_form' ) );
		add_action( 'wp_ajax_nopriv_save_form_data', array( $this, 'save_data_form' ) );
	}

	public function save_data_form() {
		if ( ! empty( $_FILES ) && $_POST['action'] == 'save_form_data' ) {
			$attachment_id = $this->save_image_to_upload();
			$this->save_fields( $attachment_id );
		}
	}

	public function save_fields( int $attachment_id ) {

		$title = wp_strip_all_tags( $_POST['title'] );
		$email = $_POST['email'];

		if ( ! empty( $title ) && ! empty( $email ) && ! empty( $attachment_id ) ) {
			$this->create_post( $title, $email, $attachment_id );
		}

		return false;
	}


	public function create_post( string $title, string $email, int $image_id ) {
		$post = array(
			'post_type'     => 'ads',
			'post_title'    => wp_strip_all_tags( $title ),
			'post_status'   => 'publish',
			'post_content'  => $email,
			'post_author'   => 1,
			'_thumbnail_id' => $image_id
		);

		wp_insert_post( $post );
	}

	public function save_image_to_upload() {
		$file_name = $_FILES['image']['name'];
		$file_temp = $_FILES['image']['tmp_name'];

		$upload_dir = wp_upload_dir();
		$image_data = file_get_contents( $file_temp );
		$filename   = basename( $file_name );
		$filetype   = wp_check_filetype( $file_name );
		$filename   = time() . '.' . $filetype['ext'];

		if ( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}

		file_put_contents( $file, $image_data );
		$wp_filetype = wp_check_filetype( $filename, null );
		$attachment  = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name( $filename ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);

		$attach_id = wp_insert_attachment( $attachment, $file );
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		if ( ! empty( $attach_id ) ) {
			return $attach_id;
		}

		return false;
	}
}

new AdsForm();