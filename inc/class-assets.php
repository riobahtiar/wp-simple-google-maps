<?php

namespace WPSGM;


class Assets {

	public function __construct() {
		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_assets' ) );

			// Add async tag for google maps assets loader
			add_filter( 'script_loader_tag', function ( $tag, $handle ) {

				if ( 'wpsgm-script-maps' !== $handle ) {
					return $tag;
				}

				return str_replace( ' id=', ' async id=', $tag );
			}, 10, 2 );

		} else {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
		}
	}

	public function frontend_assets() {
		// Style
		wp_register_style( 'wpsgm-style', WPSGM__PLUGIN_URL . 'assets/wpsgm.css', array(), '1.0.0', false );
		wp_enqueue_style( 'wpsgm-style' );

		// JS
		wp_register_script( 'wpsgm-script-main', WPSGM__PLUGIN_URL . 'assets/wpsgm-min.js', array(), '1.0.0', false );
		wp_localize_script( 'wpsgm-script-main', 'wpsgmVar', array(
			'zoom' => $this->get_config( 'zoom_level' ),
			'long' => $this->get_config( 'longitude' ),
			'lat'  => $this->get_config( 'latitude' )
		) );
		wp_enqueue_script( 'wpsgm-script-main' );

		wp_register_script( 'wpsgm-script-maps', esc_url( 'https://maps.googleapis.com/maps/api/js?key=' . $this->get_config( 'api_key' ) . '&callback=initMap' ), array(), null, true );
		wp_enqueue_script( 'wpsgm-script-maps' );
	}

	public function get_config( $option_name = null ) {
		$options = get_option( 'maps_options' );

		return $options[ $option_name ];
	}

	public function admin_assets() {
		// JS
		wp_register_script( 'wpsgm-script-admin', WPSGM__PLUGIN_URL . 'assets/wpsgm-admin-min.js', array(), '1.0.0', true );
		wp_enqueue_script( 'wpsgm-script-admin' );

		// Style
		wp_register_style( 'wpsgm-style-admin', WPSGM__PLUGIN_URL . 'assets/wpsgm-admin.css', array(), '1.0.0', false );
		wp_enqueue_style( 'wpsgm-style-admin' );
	}
}