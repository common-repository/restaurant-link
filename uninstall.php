<?php
// If uninstall called from WordPress.
if (defined('WP_UNINSTALL_PLUGIN')) {
    delete_option('rest_link_settings');
}

