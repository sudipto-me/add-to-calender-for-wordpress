<?php
/**
 * Gutenberg block registration.
 *
 * @package Add_to_calender
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Add to Calender For Wordpress block.
 *
 * @return void
 */
function add_to_calender_register_blocks() {
	$block_build_path = ADD_TO_CALENDER_DIR . '/build';

	if ( ! file_exists( $block_build_path . '/block.json' ) ) {
		return;
	}

	register_block_type_from_metadata( $block_build_path );
}
add_action( 'init', 'add_to_calender_register_blocks' );

/**
 * Load the ATCB library for frontend content and the iframed editor canvas.
 *
 * enqueue_block_editor_assets only hits the parent admin page, so the canvas
 * iframe never upgrades <add-to-calendar-button> and the block looks empty.
 *
 * @return void
 */
function add_to_calender_enqueue_block_assets() {
	wp_enqueue_script(
		'add-to-calender-scripts',
		'https://cdn.jsdelivr.net/npm/add-to-calendar-button@2',
		array(),
		ADD_TO_CALENDER_VERSION,
		true
	);
}
add_action( 'enqueue_block_assets', 'add_to_calender_enqueue_block_assets' );
