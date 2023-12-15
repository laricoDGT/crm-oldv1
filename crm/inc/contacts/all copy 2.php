<?php
global $wpdb;

$table_name = $wpdb->prefix . 'crm_contacts';
$contacts = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

// Deletion
if (isset($_POST['submit_delete'])) {
    $delete_contact_ids = isset($_POST['delete_contact_ids']) ? array_map('intval', $_POST['delete_contact_ids']) : array();

    if (!empty($delete_contact_ids)) {
        $wpdb->query("DELETE FROM $table_name WHERE id IN (" . implode(',', $delete_contact_ids) . ")");
        echo '<div class="updated"><p>Contactos eliminados correctamente</p></div>';
 
        echo '<script> window.location.href = "' . admin_url('admin.php?page=crm-overview') . '";</script>';
    } else {
        echo '<div class="error"><p>Por favor, selecciona al menos un contacto para eliminar</p></div>';
    }
}
?>

<div class="all-contacts">
    <form method="post" action="">
        <div class="options">
            <ul>
                <li>
                    <a class='btn' href="<?php echo admin_url('admin.php?page=new-contact'); ?>">
                        <span class="iconify color-green" data-icon="material-symbols:add-circle"
                            data-inline="false"></span>
                        <span>Add Contact</span>
                    </a>
                </li>
                <li>

                    <button class='btn' type="submit" name="submit_delete">
                        <span class="iconify color-red" data-icon="material-symbols:delete-forever"
                            data-inline="false"></span>
                        <span>Delete</span> </button>
                </li>
            </ul>
        </div>


        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Category</th>
                    <th>Service</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <td><input type="checkbox" class="delete-checkbox" name="delete_contact_ids[]"
                            value="<?php echo esc_attr($contact['id']); ?>"></td>
                    <td><?php echo esc_html($contact['id']); ?></td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=edit-contact&contact_id=' . $contact['id']); ?>">
                            Edit
                        </a>
                    </td>
                    <td></td>
                    <td><?php echo esc_html($contact['first_name']); ?></td>
                    <td><?php echo esc_html($contact['last_name']); ?></td>
                    <td><?php echo esc_html($contact['category']); ?></td>
                    <td><?php echo esc_html($contact['service']); ?></td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </form>

</div>

<script>
document.getElementById('select-all').addEventListener('change', function() {
    var checkboxes = document.getElementsByClassName('delete-checkbox');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
    }
});
</script>