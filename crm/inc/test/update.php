<?php
global $wpdb;

if (isset($_POST['contactId']) && isset($_POST['value'])) {
    $contactId = $_POST['contactId'];
    $value = $_POST['value'];

    $table_name = $wpdb->prefix . 'crm_contacts';

    $data = array(
        'first_name' => $value
    );

    $where = array(
        'id' => $contactId
    );

    $wpdb->update($table_name, $data, $where);

    echo "Success";
} else {
    echo "Error: Invalid request";
}
?>