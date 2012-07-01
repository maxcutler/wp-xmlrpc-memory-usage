<?php

/*
* Plugin Name: XML-RPC Memory Usage
* Description: Logs memory usage during XML-RPC handling.
* Version: 1.0
* Author: Max Cutler
* Author URI: http://www.maxcutler.com
*
*/

if ( defined( 'XMLRPC_REQUEST' ) ) {

	function xmu_log_usage( $label, $peak = false ) {
		$usage = $peak ? memory_get_peak_usage() : memory_get_usage();
		$usage_mb =  round($usage / 1048576, 2);
		error_log( '[' . $label . ']: ' . $usage . ' (' .$usage_mb . ' MiB)' );
	}

	function xmu_start() {
		xmu_log_usage( 'XML-RPC Loaded' );
	}

	function xmu_xmlrpc_call( $method_name ) {
		xmu_log_usage( 'XML-RPC Call, ' . $method_name );
	}

	function xmu_prepare( ) {
		$filter = current_filter();
		xmu_log_usage( 'XML-RPC Filter, ' . $filter );
	}

	function xmu_shutdown() {
		xmu_log_usage( 'XML-RPC Shutdown' );
		xmu_log_usage( 'XML-RPC Peak', true );
	}

	add_action( 'plugins_loaded', 'xmu_start', 1 );
	add_action( 'xmlrpc_call', 'xmu_xmlrpc_call', 10, 1 );
	add_action( 'shutdown', 'xmu_shutdown' );

	$prepare_filters = array(
		'xmlrpc_prepare_taxonomy',
		'xmlrpc_prepare_term',
		'xmlrpc_prepare_post',
		'xmlrpc_prepare_post_type',
		'xmlrpc_prepare_media_item',
		'xmlrpc_prepare_page',
		'xmlrpc_prepare_comment'
	);
	foreach ( $prepare_filters as $filter ) {
		add_filter( $filter, 'xmu_prepare' );
	}
}