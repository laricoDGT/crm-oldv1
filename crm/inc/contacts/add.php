<?php require_once plugin_dir_path(__FILE__) . '../components/header.php'; ?>

<?php 
include 'functions.php'; 

if (isset($_POST['submit_contact'])) {
    $data = get_common_data();

    if (!empty($data['first_name']) && !empty($data['last_name'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'crm_contacts';

        $wpdb->insert($table_name, $data);
        display_message('updated', 'Contact added successfully.');
        redirect_to_crm_overview();
    } else {
        display_message('error', 'Please complete all mandatory fields.');
    }
}
?>
<div class="form add-edit-contact">
    <h1>Add New Contact</h1>
    <form method="post" action="">
        <?php display_contact_form_fields(); ?>


        <div class="actions">
            <button type="submit" name="submit_edit" class="button button-primary">
                <span class="iconify" data-icon="ion:ios-save" data-inline="false"></span>
                <span>Update</span>
            </button>


            <a href="<?php echo admin_url('admin.php?page=crm'); ?>" class="button ">
                <span class="iconify" data-icon="ion:arrow-back-circle-outline" data-inline="false"></span>
                <span>Back</span>
            </a>
        </div>
    </form>
</div>


<?php require_once plugin_dir_path(__FILE__) . '../components/footer.php'; ?>