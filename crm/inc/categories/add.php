<?php require_once plugin_dir_path(__FILE__) . '../components/header.php'; ?>

<?php 
include 'functions.php'; 

if (isset($_POST['category_submit'])) {
    $data = get_common_data();

    if (!empty($data['category_name'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'crm_categories';

        $wpdb->insert($table_name, $data);
        display_message('updated', 'Category added successfully.');
        redirect_to_crm_overview();
    } else {
        display_message('error', 'Please complete all mandatory fields.');
    }
}
?>
<div class="form form-category add-edit-category">
    <h1>Add New Category</h1>
    <form method="post" action="">
        <?php display_cat_form_fields(); ?>
        <button type="submit" name="category_submit" class="button button-primary">
            <span class="iconify" data-icon="ion:ios-save" data-inline="false"></span>
            <span>Save</span>
        </button>
    </form>
</div>

<?php require_once plugin_dir_path(__FILE__) . '../components/footer.php'; ?>