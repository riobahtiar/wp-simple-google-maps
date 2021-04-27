<?php

namespace WPSGM;

class Shorcode {

	public function register() {
		add_shortcode( 'wpsgm', [ $this, 'load_view' ] );
	}

	public function load_view( $name ) {
		ob_start();
		echo '<div id="wpsgm" class="wpsgm-widget"></div>';

		return ob_get_clean();
	}

}