<?php

namespace WPSGM;

function init() {
	if ( ! check_requirements() ) {
		return;
	}

	new namespace\PluginSettings();
	new namespace\Assets();
	( new namespace\Shorcode() )->register();

}

function check_requirements(): bool {

	if ( version_compare( PHP_VERSION, '7.2', '<' ) ) {
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			add_action( 'admin_notices', __NAMESPACE__ . '\\outdated_php_version_notice' );
		}

		return false;
	}

	return true;
}

/**
 * Print an admin notice when the PHP version is not high enough.
 *
 */
function outdated_php_version_notice() {
	printf(
		'<div class="error"><p>The WP Simple Google Maps plugin requires PHP version 7.2 or higher. Your server is running PHP version %s.</p></div>',
		PHP_VERSION
	);
}