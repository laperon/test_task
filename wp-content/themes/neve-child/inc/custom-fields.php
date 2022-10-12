<?php

/**
 * Add custom fields
 */
class CustomFields {

	public array $post_types = [ 'rw_olx' ];

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {

		$post_types = $this->post_types;

		if ( in_array( $post_type, $post_types ) ) {
			add_meta_box(
				'image_metabox',
				__( 'Image', 'neve' ),
				array( $this, 'render_meta_box_content' ),
				$post_type,
				'advanced',
				'high'
			);
		}
	}

	public function save( $post_id ) {

		if ( ! isset( $_POST['key_custom_box_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['key_custom_box_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'key_custom_box' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( 'rw_olx' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		$mydata = sanitize_text_field( $_POST['_custom_field_meta_image_key'] );
		update_post_meta( $post_id, '_custom_field_meta_image_key', $mydata );
	}

	public function render_meta_box_content( $post ) {
		wp_nonce_field( 'key_custom_box', 'key_custom_box_nonce' );

		$attachment_id = get_post_meta( $post->ID, '_custom_field_meta_image_key', true );

		wp_enqueue_media();

		?>

        <form method='post'>
            <div class='image-preview-wrapper'>
                <img id='image-preview' src='<?php echo wp_get_attachment_url( $attachment_id ); ?>' height='100'>
            </div>

            <input id="upload_image_button"
                   type="button"
                   class="button"
                   data-post_id="<?php echo $post->ID; ?>"
                   data-attachment_id="<?php echo $attachment_id; ?>"
                   value="<?php _e( 'Upload image', 'neve' ); ?>"/>

            <input id="remove_image_button"
                   type="button" class="button"
                   value="<?php _e( 'Remove' ); ?>"/>

            <input type='hidden'
                   name='_custom_field_meta_image_key'
                   id='image_attachment_id'/>
        </form>

		<?php
	}
}

new CustomFields();