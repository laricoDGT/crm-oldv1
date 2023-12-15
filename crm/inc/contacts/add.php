<?php require_once plugin_dir_path(__FILE__) . '../components/header.php'; ?>

<?php
if (isset($_POST['submit_contact'])) {
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

        $wpdb->insert($table_name, $data);
        echo '<div class="updated"><p>Contacto agregado correctamente</p></div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "' . admin_url('admin.php?page=crm-overview') . '";
            }, 1000);
        </script>';
    } else {
        echo '<div class="error"><p>Por favor, completa todos los campos obligatorios</p></div>';
    }
}
?>

<div class="form">
    <h1>New Contact</h1>
    <form method="post" action="">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label for="category">Category:</label>
        <input type="text" name="category"><br>

        <label for="service">Service:</label>
        <input type="text" name="service"><br>

        <input type="submit" name="submit_contact" value="Save">


    </form>
</div>


<?php require_once plugin_dir_path(__FILE__) . '../components/footer.php'; ?>