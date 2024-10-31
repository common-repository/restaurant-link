<?php

class Restaurant_Link_Admin
{

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the CSS for the admin area.
     */
    public function restaurantLink_admin_enqueue_styles()
    {

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/restaurant-link-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     */
    public function restaurantLink_admin_enqueue_scripts()
    {
        if (get_admin_page_title() == RESTAURANT_LINK_NAME) {
            wp_enqueue_script($this->plugin_name . '-roCpy', plugin_dir_url(__FILE__) . 'js/reCopy.js', array('jquery'), $this->version, false);
            wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/restaurant-link-admin.js', array('jquery'), $this->version, false);

        }
    }

}
