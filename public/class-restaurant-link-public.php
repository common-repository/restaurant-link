<?php

class Restaurant_Link_Public
{

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing.
     */
    public function restaurantLink_public_enqueue_styles()
    {

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/restaurant-link-public.css', array(), $this->version, 'all');

    }

    /**
	 * Register the JavaScript for the public-facing. 
	 */
	
    public function restaurantLink_public_enqueue_scripts()
    {

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/restaurant-link-public.js', array('jquery'), $this->version, false);

    }

}
