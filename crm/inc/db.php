<?php 
 
register_activation_hook(__FILE__, 'crm_plugin_activate');
 
function crm_plugin_activate() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'crm_contacts';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        first_name varchar(255) NOT NULL,
        last_name varchar(255) NOT NULL,
        category varchar(255),
        service varchar(255),
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}