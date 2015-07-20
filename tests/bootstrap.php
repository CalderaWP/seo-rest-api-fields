<?php

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

require_once $_tests_dir . '/includes/functions.php';

function _manually_load_plugin() {
	require dirname( dirname( dirname( __FILE__ ) ) ) . '/WP-API/plugin.php';
	require dirname( dirname( dirname( __FILE__ ) ) ) . '/wordpress-seo/wp-seo.php';
	require dirname( dirname( __FILE__ ) ) . '/seo-rest-api-fields.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

require $_tests_dir . '/includes/bootstrap.php';
