<?php  
global $wpdb;
 
$table_name_contacts = $wpdb->prefix . 'crm_contacts';
$charset_collate = $wpdb->get_charset_collate();

$sql_contacts = "CREATE TABLE $table_name_contacts (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    image varchar(255),
    since date,
    registration_date timestamp DEFAULT CURRENT_TIMESTAMP, 
    gender varchar(255),
    dob date,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    title varchar(255) NOT NULL,
    category varchar(255),
    service varchar(255),
    company varchar(255),
    city varchar(255),
    state varchar(255),
    zip varchar(255),
    phone_work varchar(255),
    phone_mobile varchar(255),
    email_1 varchar(255),
    web varchar(255),
    slogan varchar(255),
    note text,
    PRIMARY KEY  (id)
) $charset_collate;";
 
$table_name_categories = $wpdb->prefix . 'crm_categories';

$sql_categories = "CREATE TABLE $table_name_categories (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    category_name varchar(255) NOT NULL,
    PRIMARY KEY  (id)
) $charset_collate;";
 
$table_name_services = $wpdb->prefix . 'crm_services';

$sql_services = "CREATE TABLE $table_name_services (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    service_name varchar(255) NOT NULL,
    PRIMARY KEY  (id)
) $charset_collate;";
 
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
 
dbDelta($sql_contacts);
dbDelta($sql_categories);
dbDelta($sql_services);
?>