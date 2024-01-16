<?php
/*
Plugin Name: CRM Plugin
Description: CRM.
Version: 2.0
Author: W.A. (PlatformBuilder)
*/

 
register_activation_hook(__FILE__, 'crm_plugin_activate');
function crm_plugin_activate() {
    require_once('inc/db.php');
}
 

add_action('admin_menu', 'crm_plugin_menu');

function crm_plugin_menu() {
    add_menu_page(
        'CRM',
        'CRM',
        'manage_options',
        'crm',
        'crm_overview_page'
    );

    add_submenu_page(
        'crm',
        'CRM Overview',
        'CRM Overview',
        'manage_options',
        'crm',
        'crm_overview_page'
    );

    add_submenu_page(
        'crm',
        'New Contact',
        'New Contact',
        'manage_options',
        'new-contact',
        'new_contact_page'
    );
 
    add_submenu_page(
        'crm',
        'CRM Categories',
        'CRM Categories',
        'manage_options',
        'crm-categories',
        'crm_categories_page', 
    ); 
    
    add_submenu_page(
        'crm',
        'Test',
        'CRM Test',
        'manage_options',
        'crm-test',
        'crm_test_page', 
    ); 

    add_submenu_page(
        'crm',
        'CRM Services',
        'CRM Services',
        'manage_options',
        'crm-services',
        'crm_services_page', 
    ); 

    add_submenu_page(
        'crm',
        'CRM Settings',
        'CRM Settings',
        'manage_options',
        'crm-settings',
        'crm_settings_page'
    ); 


    add_submenu_page(
        'crm',
        '',
        '',
        'manage_options',
        'crm-contacts-type',
        'crm_contacts_type_page', 
    );

    add_submenu_page(
        'crm',
        '',
        '',
        'manage_options',
        'new-category',
        'new_category_page'
    );
    add_submenu_page(
        'crm',
        '',
        '',
        'manage_options',
        'edit-category',
        'edit_category_page'
    );
    
    add_submenu_page(
        'crm',
        '',
        '',
        'manage_options',
        'new-service',
        'new_service_page'
    );
    add_submenu_page(
        'crm',
        '',
        '',
        'manage_options',
        'edit-service',
        'edit_service_page'
    );

    add_submenu_page(
        'crm',
        '',
        '',
        'manage_options',
        'new-contacts-type',
        'new_contacts_type_page'
    );

    add_submenu_page(
        'crm',
        '',
        '',
        'manage_options',
        'edit-contacts-type',
        'edit_contacts_type_page'
    );

    add_submenu_page(
        'crm',
        '',
        '',
        'manage_options',
        'edit-contact',
        'edit_contact_page',
        15
    );

   
}

 


require_once plugin_dir_path(__FILE__) . 'inc/assets.php';
 
require_once plugin_dir_path(__FILE__) . 'inc/overview.php';




 

// Contacts
function new_contact_page() {  
    require_once plugin_dir_path(__FILE__) . 'inc/contacts/add.php';
}

function edit_contact_page() { 
    require_once plugin_dir_path(__FILE__) . 'inc/contacts/edit.php';
}

function edit_contasearch_pagect_page() { 
    require_once plugin_dir_path(__FILE__) . 'inc/contacts/search.php';
}

// Contacts Type

function crm_contacts_type_page() {  
    require_once plugin_dir_path(__FILE__) . 'inc/contacts-type/all.php';
}

function new_contacts_type_page() {  
    require_once plugin_dir_path(__FILE__) . 'inc/contacts-type/add.php';
}

function edit_contacts_type_page() { 
    require_once plugin_dir_path(__FILE__) . 'inc/contacts-type/edit.php';
}

// Categories

function crm_categories_page() {  
    require_once plugin_dir_path(__FILE__) . 'inc/categories/all.php';
}

function new_category_page() {  
    require_once plugin_dir_path(__FILE__) . 'inc/categories/add.php';
}

function edit_category_page() { 
    require_once plugin_dir_path(__FILE__) . 'inc/categories/edit.php';
}


// Services

function crm_services_page() {  
    require_once plugin_dir_path(__FILE__) . 'inc/services/all.php';
}

function new_service_page() {  
    require_once plugin_dir_path(__FILE__) . 'inc/services/add.php';
}

function edit_service_page() { 
    require_once plugin_dir_path(__FILE__) . 'inc/services/edit.php';
}


// test

function crm_test_page() {  
    require_once plugin_dir_path(__FILE__) . 'inc/test/index.php';
}



// general
require_once plugin_dir_path(__FILE__) . 'inc/crm-settings.php';


// shortcode
require_once plugin_dir_path(__FILE__) . 'inc/shortcode.php';
 