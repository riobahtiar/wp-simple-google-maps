<?php


namespace WPSGM;


class PluginSettings {
	private $maps_options;

	public function __construct() {
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'maps_init_admin_menu' ) );
		}
		add_action( 'admin_init', array( $this, 'maps_init_admin_settings' ) );
	}

	public function maps_init_admin_menu() {
		add_menu_page(
			__( 'Google Maps General Settings', 'wp-simple-google-maps' ),
			__( 'Google Maps', 'wp-simple-google-maps' ),
			'edit_posts',
			'maps-main-options',
			[ $this, 'maps_create_admin_page' ],
			'dashicons-location-alt',
			2
		);

	}

	public function maps_create_admin_page() {
		$this->maps_options = get_option( 'maps_options' ); ?>

        <div class="wrap">
            <h1><?php _e( 'Google Maps General Settings', 'wp-simple-google-maps' ) ?></h1>
			<?php settings_errors(); ?>

            <form method="post" action="options.php">
				<?php
				settings_fields( 'maps_option_group' );
				do_settings_sections( 'maps-admin' );
				submit_button();
				?>

            </form>

            <div class="wpsgm">
                <div class="widget-content">
                    <h2>To enable Google Maps widget you need to include shorcode in your content editor.</h2>
                    <input type="text" value="[wpsgm]" id="shorcodeInput" disabled>
                    <div class="tooltip">
                        <button class="copy-btn" onclick="copyShorcode()" onmouseout="tooltipHandler()">
                            <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                            Copy Shorcode
                        </button>
                    </div>
                </div>
            </div>

        </div>
	<?php }


	public function maps_init_admin_settings() {
		register_setting(
			'maps_option_group',
			'maps_options',
			[ $this, 'maps_data_validation' ]
		);

		add_settings_section(
			'maps_setting_section',
			'',
			[ $this, 'maps_description' ],
			'maps-admin'
		);

		add_settings_field(
			'api_key',
			__( 'API Key', 'wp-simple-google-maps' ),
			[ $this, 'api_key_callback' ],
			'maps-admin',
			'maps_setting_section'
		);

		add_settings_field(
			'zoom_level',
			__( 'Zoom Level', 'wp-simple-google-maps' ),
			[ $this, 'zoom_level_callback' ],
			'maps-admin',
			'maps_setting_section'
		);

		add_settings_field(
			'longitude',
			__( 'Longitude', 'wp-simple-google-maps' ),
			[ $this, 'longitude_callback' ],
			'maps-admin',
			'maps_setting_section'
		);

		add_settings_field(
			'latitude',
			__( 'Latitude', 'wp-simple-google-maps' ),
			[ $this, 'latitude_callback' ],
			'maps-admin',
			'maps_setting_section'
		);

	}

	public function maps_data_validation( $input ) {
		$settings_val = array();

		foreach ( $input as $key => $val ) {

			// Validate API Key
			if ( 'api_key' === $key && strlen( $val ) <= 30 ) {
				add_settings_error( 'maps_validation', esc_attr( 'settings_updated' ),
					__( 'API Key field is empty or the api key is invalid (The API key is usually 30-60 characters).',
						'wp-simple-google-maps' ), 'error' );
			} else {
				// Validate before save to DB
				$settings_val[ $key ] = sanitize_text_field( $val );
			}

		}

		return $settings_val;
	}

	public function maps_description() {
		_e( 'Please complete the following data correctly. If invalid your map will not appear.',
			'wp-simple-google-maps' );
	}


	public function api_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="maps_options[api_key]" id="api_key" value="%s" aria-describedby="field-of-api-key-description"><p class="description" id="field-of-api-key-description">%s</p>',
			isset( $this->maps_options['api_key'] ) ? esc_attr( $this->maps_options['api_key'] ) : '',
			__( 'The Google Maps API key is a unique identifier that authenticates requests associated with your project for usage and billing purposes. ', 'wp-simple-google-maps' )
		);
	}

	public function zoom_level_callback() {
		printf(
			'<input class="regular-text" type="number" name="maps_options[zoom_level]" id="zoom_level" value="%s" aria-describedby="field-of-zoom-description"><p class="description" id="field-of-zoom-description">%s</p>',
			isset( $this->maps_options['zoom_level'] ) ? esc_attr( $this->maps_options['zoom_level'] ) : '',
			__( 'Map initial zoom level.', 'wp-simple-google-maps' )
		);
	}

	public function longitude_callback() {
		printf(
			'<input class="regular-text" type="text" name="maps_options[longitude]" id="longitude" value="%s" aria-describedby="field-of-longitude-description"><p class="description" id="field-of-longitude-description">%s</p>',
			isset( $this->maps_options['longitude'] ) ? esc_attr( $this->maps_options['longitude'] ) : '',
			__( 'Longitude, is a geographic coordinate that specifies the east–west position of a point on the Earth.', 'wp-simple-google-maps' )
		);
	}

	public function latitude_callback() {
		printf(
			'<input class="regular-text" type="text" name="maps_options[latitude]" id="latitude" value="%s" aria-describedby="field-of-latitude-description"><p class="description" id="field-of-latitude-description">%s</p>',
			isset( $this->maps_options['latitude'] ) ? esc_attr( $this->maps_options['latitude'] ) : '',
			__( 'Latitude is a geographic coordinate that specifies the north–south position of a point on the Earth.', 'wp-simple-google-maps' )
		);
	}

}