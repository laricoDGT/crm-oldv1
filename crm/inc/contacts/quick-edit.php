<?php require_once plugin_dir_path(__FILE__) . '../../assets/css.php'; ?>
<?php require_once plugin_dir_path(__FILE__) . '../../assets/js.php'; ?>


<?php 
include 'functions.php'; 

if (isset($_POST['submit_edit'])) {
    $contact_id = intval($_POST['contact_id']);
    $data = get_common_data();

    if (!empty($data['first_name']) && !empty($data['last_name'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'crm_contacts';

        $where = array('id' => $contact_id);

        $wpdb->update($table_name, $data, $where);
        display_message('updated', 'Contact updated successfully.');
        // redirect_to_crm_overview();
    } else {
        display_message('error', 'Please fill out all required fields.');
    }
} elseif (isset($_GET['contact_id'])) {
    $contact_id = intval($_GET['contact_id']);
    global $wpdb;
    $table_name = $wpdb->prefix . 'crm_contacts';
    $contact = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $contact_id));

    if ($contact) {
        ?>



<?php
$parametrosClases = array('to_first_name', 'to_last_name', 'to_type', 'to_email', 'to_phone', 'to_address', 'to_city', 'to_state', 'to_zip', 'to_country', 'to_company', 'to_job_title', 'to_website', 'to_notes');
$clases = array(); 
foreach ($parametrosClases as $parametro) {
    if (isset($_GET[$parametro])) {
        $clases[] = $parametro;
    }
} 
$clasesString = implode(' ', $clases);
?>




<style>
html.wp-toolbar {
    padding-top: 0 !important;
}

#adminmenumain,
#wpadminbar,
#wpfooter {
    display: none !important;
}

#wpcontent {
    margin: 0;
    padding: 0 !important;
    height: auto;
}

#wpbody {
    padding-top: 0 !important;
}

body {
    background-color: transparent !important;
}

.add-edit-contact .fields .field {
    margin-bottom: 8px;
}

.add-edit-contact .fields .field label {
    display: block;
}

.to_first_name .fields .field:not(.first_name) {
    display: none;
}

.to_last_name .fields .field:not(.last_name) {
    display: none;
}

.to_type .fields .field:not(.type) {
    display: none;
}
</style>


<div class="form add-edit-contact <?php echo $clasesString; ?>">
    <form method="post" action="">
        <input type="hidden" name="contact_id" value="<?php echo esc_attr($contact->id); ?>">
        <?php display_contact_form_fields($contact); ?>


        <div class="actions">
            <button type="submit" name="submit_edit" class="button button-primary">
                <span class="iconify" data-icon="ion:ios-save" data-inline="false"></span>
                <span>Update</span>
            </button>


        </div>

    </form>
</div>
<?php
    } else {
        display_message('error', 'Contact not found.');
    }
} else {
    display_message('error', 'No contact information provided.');
}
?>