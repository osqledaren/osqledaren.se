<?php
/**
 * osqledaren Theme Customizer
 *
 * @package osqledaren
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function osqledaren_customize_preview_js() {
	wp_enqueue_script( 'osqledaren_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'osqledaren_customize_preview_js' );
