<?php 
function enqueue_crm_scripts_styles() {
 
    if (is_admin()) {
        wp_enqueue_script('crm-script', plugin_dir_url(__FILE__) . '../assets/js/crm.js', array(), null, true);
        wp_enqueue_style('crm-style', plugin_dir_url(__FILE__) . '../assets/css/crm.css', array(), null);
 
        wp_enqueue_script('external-iconify', 'https://code.iconify.design/3/3.1.0/iconify.min.js', array(), null, true);
    }
}

 
add_action('admin_enqueue_scripts', 'enqueue_crm_scripts_styles');

 
if (!is_admin()) {
    wp_enqueue_script('theme-script', plugin_dir_url(__FILE__) . '../assets/js/theme.js', array('jquery'), null, true);
    wp_enqueue_style('theme-style', plugin_dir_url(__FILE__) . '../assets/css/theme.css', array(), null);
}