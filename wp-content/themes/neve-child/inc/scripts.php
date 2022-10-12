<?php

function neve_child_scripts() {

	wp_enqueue_script( 'custom-init',
		get_stylesheet_directory_uri() . '/assets/js/init.js',
		[ 'jquery' ],
		'1.0',
		true );

	wp_localize_script( 'custom-init', 'ajax_object',
		array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/assets/css/child-style.css',
		false,
		'1.0',
		'all' );

}
add_action( 'wp_enqueue_scripts', 'neve_child_scripts' );

function neve_child_admin_scripts() {
	wp_enqueue_script( 'media-library',
		get_stylesheet_directory_uri() . '/assets/js/media-library.js',
		[ 'jquery' ],
		'',
		true );
}
add_action( 'admin_footer', 'neve_child_admin_scripts' );

