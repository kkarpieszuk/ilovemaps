<?php
/*
 * Plugin Name: I ♥ Maps!
 */

function simpleMapBlock() {
	$assetFile = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');
	wp_register_script(
		'ilovemaps_simple_js',
		plugins_url( 'build/index.js', __FILE__ ),
		$assetFile['dependencies'],
		$assetFile['version']
	);

	register_block_type( 'ilovemaps/simple', array(
		'editor_script' => 'ilovemaps_simple_js',
	) );
}
add_action( 'init', 'simpleMapBlock' );

function simpleMapAssets() {
	$sharedBlockPath = '/build/simpleMapScript.js';

	wp_register_script(
		'ilovemap_leaflet',
		'https://unpkg.com/leaflet@1.6.0/dist/leaflet.js',
		[],
		filemtime( plugin_dir_path( __FILE__ ) . $sharedBlockPath )
	);

	wp_enqueue_script(
		'ilovemap_simple_map_asset_script',
		plugins_url( $sharedBlockPath, __FILE__ ),
		[  'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data', 'ilovemap_leaflet' ],
		filemtime( plugin_dir_path( __FILE__ ) . $sharedBlockPath ),
		true
	);

	wp_enqueue_style(
		'ilovemap_leaflet_style',
		'https://unpkg.com/leaflet@1.6.0/dist/leaflet.css',
		[],
		filemtime( plugin_dir_path( __FILE__ ) . $sharedBlockPath )
	);
}
add_action( 'enqueue_block_assets', 'simpleMapAssets' );