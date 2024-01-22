<?php require_once plugin_dir_path(__FILE__) . '../components/header.php'; ?>

<?php 
include 'functions.php'; 

if (isset($_POST['contact_type_submit'])) {
    $data = get_common_data();

    if (!empty($data['contact_type_name'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'crm_contacts_type';

        $wpdb->insert($table_name, $data);
        display_message('updated', 'Contact Stae added successfully.');
        redirect_to_crm_overview();
    } else {
        display_message('error', 'Please complete all mandatory fields.');
    }
}
?>
<div class="form form-category add-edit-category">
    <h1>Add New Contact Stage</h1>
    <form method="post" action="">
        <?php display_contact_type_form_fields(); ?>
        <button type="submit" name="contact_type_submit" class="button button-primary">
            <span class="iconify" data-icon="ion:ios-save" data-inline="false"></span>
            <span>Save</span>
        </button>
    </form>
</div>

<?php require_once plugin_dir_path(__FILE__) . '../components/footer.php'; ?>