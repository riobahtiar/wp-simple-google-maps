<?php

namespace WPSGM;


class Assets {

	public function get_config( $option_name = null ) {
		$options = get_option( 'maps_options' );

		return $options[ $option_name ];
	}

	public function __construct() {
		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'javascript' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		}
	}

	public function styles() {
		wp_register_style( 'wpsgm-style', WPSGM__PLUGIN_URL . 'assets/wpsgm.css', array(), '1.0.0', false );
		wp_enqueue_style( 'wpsgm-style' );
	}


	public function javascript() {
		wp_register_script( 'wpsgm-script-main', WPSGM__PLUGIN_URL . 'assets/wpsgm-min.js', array(), '1.0.0', false );
		wp_localize_script( 'wpsgm-script-main', 'wpsgmVar', array(
			'zoom' => $this->get_config( 'zoom_level' ),
			'long' => $this->get_config( 'longitude' ),
			'lat'  => $this->get_config( 'latitude' )
		) );
		wp_enqueue_script( 'wpsgm-script-main' );

		wp_register_script( 'wpsgm-script-maps', 'https://maps.googleapis.com/maps/api/js?&key=' . $this->get_config( 'api_key' ) . '&callback=initMap', array(), '', true );
		wp_enqueue_script( 'wpsgm-script-maps' );
	}
}