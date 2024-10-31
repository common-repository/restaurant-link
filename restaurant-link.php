<?php

/**
 * @link              http://restaurant.link/
 * @since             1.0.4
 * @package           restaurant-link
 *
 * @wordpress-plugin
 * Plugin Name:       Restaurant link
 * Plugin URI:        http://restaurant.link/
 * Description:       Créer un formulaire de réservation dynamique pour votre restaurant
 * Version:           1.0.4
 * Author:            Support restaurant link
 * Author URI:        http://restaurant.link/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       restaurant-link
 * Domain Path:       /languages
 */
if (!defined('ABSPATH')) exit;

if (!defined('WPINC')) {
    die;
}

define('RESTAURANT_LINK_VERSION', '1.0.4');
define('RESTAURANT_LINK_NAME', 'Reservation LINK');
define('RESTAURANT_LINK_SLUG','restaurant-link');
/**
 * Activate plugin
 */
register_activation_hook(__FILE__, 'activate_restaurant_link');
function activate_restaurant_link()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-restaurant-link-activator.php';
    Restaurant_Link_Activator::restaurantLink_activate();
}

/**
 * Desactivate plugin
 */
register_deactivation_hook(__FILE__, 'deactivate_restaurant_link');
function deactivate_restaurant_link()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-restaurant-link-deactivator.php';
    Restaurant_Link_Deactivator::restaurantLink_deactivate();
}

require plugin_dir_path(__FILE__) . 'includes/class-restaurant-link.php';

/**
 * Run plugin
 */

function run_restaurant_link()
{

    $plugin = new Restaurant_Link();
    $plugin->run_restaurantLink();

}

run_restaurant_link();