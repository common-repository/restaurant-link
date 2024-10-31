<?php

class Restaurant_Link
{

    protected $loader;

    protected $plugin_name;

    protected $version;

    protected $plugin_slug;

    public function __construct()
    {
        if (defined('RESTAURANT_LINK_VERSION')) {
            $this->version = RESTAURANT_LINK_VERSION;
        } else {
            $this->version = '1.0.4';
        }
        if (defined('RESTAURANT_LINK_NAME')) {
            $this->plugin_name = RESTAURANT_LINK_NAME;
        } else {
            $this->plugin_name = 'Reservation LINK';
        }
        if (defined('RESTAURANT_LINK_SLUG')) {
            $this->plugin_slug = RESTAURANT_LINK_SLUG;
        } else {
            $this->plugin_slug = 'restaurant-link';
        }

        $this->load_dep_restaurantLink();
        $this->set_language_restaurantLink();
        $this->admin_hooks_restaurantLink();
        $this->public_hooks_restaurantLink();
        $this->add_admin_menu_restaurantLink();
        $this->reservat_form_restaurantLink();


    }

    /**
     * Load class
     */

    private function load_dep_restaurantLink()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-restaurant-link-back-menu.php';

        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-restaurant-link-loader.php';

        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-restaurant-link-i18n.php';

        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-restaurant-link-admin.php';

        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-restaurant-link-public.php';

        $this->loader = new Restaurant_Link_Loader();

    }

    /**
     * Internationalization.
     */
    private function set_language_restaurantLink()
    {

        $plugin_i18n = new Restaurant_Link_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     */
    private function admin_hooks_restaurantLink()
    {

        $plugin_admin = new Restaurant_Link_Admin($this->get_restaurantLink_name(), $this->get_restaurantLink_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'restaurantLink_admin_enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'restaurantLink_admin_enqueue_scripts');

    }

    /**
     * @return string
     */
    public function get_restaurantLink_name()
    {
        return $this->plugin_name;
    }

    /**
     * @return string
     */
    public function get_restaurantLink_version()
    {
        return $this->version;
    }
	

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     */
    private function public_hooks_restaurantLink()
    {

        $plugin_public = new Restaurant_Link_Public($this->get_restaurantLink_name(), $this->get_restaurantLink_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'restaurantLink_public_enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'restaurantLink_public_enqueue_scripts');

    }

    /**
     * Add admin menu
     */

    private function add_admin_menu_restaurantLink()
    {
        $menu = new Restaurant_Link_Back_Menu($this->plugin_name, $this->plugin_slug);
        $this->loader->add_action('admin_menu', $menu, 'admin_menu');
    }

    private function reservat_form_restaurantLink()
    {
        add_shortcode('restaurant_link_reservation_form', array($this, 'formReservation_restaurantLink'));
    }

    /**
     * Run the loader to execute hooks WordPress.
     */
    public function run_restaurantLink()
    {
        $this->loader->restaurantLink_run();
    }

    /**
     * @return mixed
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Active shortcode
     */

    public function formReservation_restaurantLink()
    {
        ob_start();
        if (Restaurant_Link_Back_Menu::check_filds() == true) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'module/restaurant-link-shortcode.php';

        }
		return ob_get_clean();


    }


}
