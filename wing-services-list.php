<?php
/**
 * Plugin Name:       Wing Services List
 * Description:       A custom Gutenberg block for displaying a grid of services with images, titles, descriptions, and links. Built for NorthWing Digital.
 * Version:           0.1.0
 * Requires at least: 6.8
 * Requires PHP:      7.4
 * Author:            Ignacio Talvi Robledo
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wing-services-list
 *
 * @package WingServicesList
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Wing Services List block.
 */
function create_block_wing_services_list_block_init() {
	wp_register_block_types_from_metadata_collection(
		__DIR__ . '/build',
		__DIR__ . '/build/blocks-manifest.php'
	);
}
add_action( 'init', 'create_block_wing_services_list_block_init' );

/**
 * Enqueue Overpass and Roboto from Google Fonts.
 */
function wing_services_list_enqueue_fonts() {
	wp_enqueue_style(
		'wing-services-list-fonts',
		'https://fonts.googleapis.com/css2?family=Overpass:wght@400;500;600;700&family=Roboto:wght@400;500&display=swap',
		array(),
		null
	);
}
add_action( 'wp_enqueue_scripts', 'wing_services_list_enqueue_fonts' );
add_action( 'enqueue_block_editor_assets', 'wing_services_list_enqueue_fonts' );