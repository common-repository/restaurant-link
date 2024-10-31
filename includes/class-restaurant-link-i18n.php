<?php


class Restaurant_Link_i18n {


	/**
	 * Load text domain for translation.
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'restaurant-link',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
