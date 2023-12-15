<?php 
function enqueue_crm_scripts_styles() {
    wp_enqueue_script('crm-script', plugin_dir_url(__FILE__) . '../assets/js/crm.js', array(), null, true);
    wp_enqueue_style('crm-style', plugin_dir_url(__FILE__) . '../assets/css/crm.css', array(), null);

    // Enqueue the external script
    wp_enqueue_script('external-iconify', 'https://code.iconify.design/3/3.1.0/iconify.min.js', array(), null, true);
}

if (is_admin()) {
    add_action('admin_enqueue_scripts', 'enqueue_crm_scripts_styles');
    add_action('admin_menu', 'crm_plugin_menu');
}