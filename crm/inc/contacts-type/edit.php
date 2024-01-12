<?php require_once plugin_dir_path(__FILE__) . '../components/header.php'; ?>
<?php 
include 'functions.php'; 

if (isset($_POST['submit_edit'])) {
    $category_id = intval($_POST['category_id']);
    $data = get_common_data();

    if (!empty($data['contact_type_name'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'crm_contacts_type';

        $where = array('id' => $category_id);

        $wpdb->update($table_name, $data, $where);
        display_message('updated', 'Contact Type updated successfully.');
        redirect_to_crm_overview();
    } else {
        display_message('error', 'Please fill out all required fields.');
    }
} elseif (isset($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']);
    global $wpdb;
    $table_name = $wpdb->prefix . 'crm_contacts_type';
    $contact = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $category_id));

    if ($contact) {
        ?>
<div class="form form-category add-edit-category">
    <h1>Edit Contact Type</h1>
    <form method="post" action="">
        <input type="hidden" name="category_id" value="<?php echo esc_attr($contact->id); ?>">
        <?php display_contact_type_form_fields($contact); ?>
        <button type="submit" name="submit_edit" class="button button-primary">
            <span class="iconify" data-icon="ion:ios-save" data-inline="false"></span>
            <span>Update</span>
        </button>
    </form>
</div>
<?php
    } else {
        display_message('error', 'Contact Type not found.');
    }
} else {
    display_message('error', 'No Contact Types information provided.');
}
?>

<?php require_once plugin_dir_path(__FILE__) . '../components/footer.php'; ?>