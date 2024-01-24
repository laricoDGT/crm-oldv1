<?php
function crm_settings_page() {
 
  
?>

<?php require_once plugin_dir_path(__FILE__) . 'components/header.php'; ?>




<div class="tabs">

    <div class="tabs-nav">
        <a href="<?php echo admin_url('admin.php?page=crm-settings'); ?>" class="tabs-btn current" id="options">General
            Options</a>
        <a href="<?php echo admin_url('admin.php?page=crm-categories'); ?>" class="tabs-btn"
            id="categories">Categories</a>
        <a href="<?php echo admin_url('admin.php?page=crm-services'); ?>" class="tabs-btn" id="services">Services</a>
        <a href="<?php echo admin_url('admin.php?page=crm-contacts-type'); ?>" class="tabs-btn " id="types">Stages</a>
    </div>

    <div class="tabs-content current">
        <h1>CRM Settings</h1>
    </div>
    <div class="tabs-content">
        <p>Loading...</p>
    </div>
    <div class="tabs-content">
        <p>Loading...</p>
    </div>
    <div class="tabs-content ">
        <p>Loading...</p>
    </div>

</div>

<?php require_once plugin_dir_path(__FILE__) . 'components/footer.php'; ?>

<?php
}
?>