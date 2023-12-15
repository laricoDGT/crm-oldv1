<?php require_once plugin_dir_path(__FILE__) . '../components/header.php'; ?>

<?php
if (isset($_POST['submit_edit'])) {
    $contact_id = intval($_POST['contact_id']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $category = sanitize_text_field($_POST['category']);
    $service = sanitize_text_field($_POST['service']);

    if (!empty($first_name) && !empty($last_name)) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'crm_contacts';

        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'category' => $category,
            'service' => $service,
        );

        $where = array('id' => $contact_id);

        $wpdb->update($table_name, $data, $where);
        echo '<div class="updated"><p>Contacto actualizado correctamente</p>'; 
        echo '<a href="' . admin_url('admin.php?page=crm-overview') . '" class="button">Go to Contacts</a></br> </br></div>';


        echo '<script>
            setTimeout(function() {
                window.location.href = "' . admin_url('admin.php?page=crm-overview') . '";
            }, 1000);
        </script>';

    } else {
        echo '<div class="error"><p>Por favor, completa todos los campos obligatorios</p></div>';
    }
} elseif (isset($_GET['contact_id'])) {
    $contact_id = intval($_GET['contact_id']);
    global $wpdb;
    $table_name = $wpdb->prefix . 'crm_contacts';
    $contact = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $contact_id));

    if ($contact) {
        // Mostrar el formulario de edición con los datos existentes
?>
<div class="form">
    <h1>Edit Contact</h1>
    <form method="post" action="">
        <input type="hidden" name="contact_id" value="<?php echo esc_attr($contact->id); ?>">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo esc_attr($contact->first_name); ?>" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo esc_attr($contact->last_name); ?>" required><br>

        <label for="category">Category:</label>
        <input type="text" name="category" value="<?php echo esc_attr($contact->category); ?>"><br>

        <label for="service">Service:</label>
        <input type="text" name="service" value="<?php echo esc_attr($contact->service); ?>"><br>

        <input type="submit" name="submit_edit" value="Save">
    </form>
</div>
<?php
    } else {
        echo '<div class="error"><p>Contacto no encontrado</p></div>';
    }
} else {
    echo '<div class="error"><p>No se proporcionó información de contacto</p></div>';
}
?>


<?php require_once plugin_dir_path(__FILE__) . '../components/footer.php'; ?>