<?php

/**
 * Register custom post types
 */
class RegisterCustomPostTypes {
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_types') );
	}

	public function register_post_types() {
		register_post_type( 'rw_olx',
			array(
				'labels' => array(
					'name'          => __( 'Publications', 'neve' ),
					'singular_name' => __( 'Publication', 'neve' )
				),
				'public'        => true,
				'has_archive'   => true,
				'rewrite'       => [
					'slug' => 'rw_olx'
				],
				'supports'      => array( 'title' ),
				'show_in_rest' => false,

			)
		);

		register_post_type( 'ads',
			array(
				'labels' => array(
					'name'          => __( 'Advertisement', 'neve' ),
					'singular_name' => __( 'Advertisement', 'neve' )
				),
				'public'        => true,
				'has_archive'   => true,
				'rewrite'       => [
					'slug' => 'ads'
				],
				'supports'      => array( 'title', 'thumbnail', 'editor' ),
				'show_in_rest' => false,

			)
		);
	}
}

new RegisterCustomPostTypes();