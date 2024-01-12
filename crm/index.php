<?php
/*
Plugin Name: CRM Plugin
Description: Plugin para gestionar contactos y CRM.
Version: 1.0
Author: Larico for PlatformBuilder.
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
        'crm-overview',
        'crm_overview_page'
    );

    add_submenu_page(
        'crm-overview',
        'CRM Overview',
        'CRM Overview',
        'manage_options',
        'crm-overview',
        'crm_overview_page'
    );

    add_submenu_page(
        'crm-overview',
        'New Contact',
        'New Contact',
        'manage_options',
        'new-contact',
        'new_contact_page'
    );
 
    add_submenu_page(
        'crm-overview',
        'CRM Categories',
        'CRM Categories',
        'manage_options',
        'crm-categories',
        'crm_categories_page', 
    );

   


    add_submenu_page(
        'crm-overview',
        'CRM Settings',
        'CRM Settings',
        'manage_options',
        'crm-settings',
        'crm_settings_page'
    ); 


    add_submenu_page(
        'crm-overview',
        '',
        '',
        'manage_options',
        'crm-contacts-type',
        'crm_contacts_type_page', 
    );

    add_submenu_page(
        'crm-overview',
        '',
        '',
        'manage_options',
        'new-category',
        'new_category_page'
    );
    add_submenu_page(
        'crm-overview',
        '',
        '',
        'manage_options',
        'edit-category',
        'edit_category_page'
    );
    

    add_submenu_page(
        'crm-overview',
        '',
        '',
        'manage_options',
        'new-contacts-type',
        'new_contacts_type_page'
    );

    add_submenu_page(
        'crm-overview',
        '',
        '',
        'manage_options',
        'edit-contacts-type',
        'edit_contacts_type_page'
    );

    add_submenu_page(
        'crm-overview',
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

// general
require_once plugin_dir_path(__FILE__) . 'inc/crm-settings.php';



 