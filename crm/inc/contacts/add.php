<?php require_once plugin_dir_path(__FILE__) . '../components/header.php'; ?>

<?php
if (isset($_POST['submit_contact'])) {
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $category = sanitize_text_field($_POST['category']);
    $service = sanitize_text_field($_POST['service']);
    $email_1 = sanitize_text_field($_POST['email_1']);
    $company = sanitize_text_field($_POST['company']);

    if (!empty($first_name) && !empty($last_name)) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'crm_contacts';

        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'category' => $category,
            'service' => $service,
            'email_1' => $email_1,
            'company' => $company,
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

<div class="form add-edit-contact">
    <h1>Add New Contact</h1>
    <form method="post" action="">
        <div class="fields">
            <div class="field">
                <label for="first_name">First Name: <span class='color-red'>*</span> </label>
                <input type="text" name="first_name" required><br>
            </div>

            <div class="field">
                <label for="last_name">Last Name: <span class='color-red'>*</span></label>
                <input type="text" name="last_name" required><br>
            </div>

            <div class="field">
                <label for="company">Company:</label>
                <input type="text" name="company"><br>
            </div>
            <div class="field">
                <label for="title">Title:</label>
                <input type="text" name="title"><br>
            </div>

            <div class="field">
                <label for="category">Category:</label>
                <input type="text" name="category"><br>
            </div>

            <div class="field">
                <label for="service">Service:</label>
                <input type="text" name="service"><br>
            </div>

            <div class="field">
                <label for="address">Address:</label>
                <input type="email" name="address"><br>
            </div>
            <div class="field">
                <label for="city">City:</label>
                <input type="text" name="city"><br>
            </div>
            <div class="field">
                <label for="st">St:</label>
                <input type="text" name="st"><br>
            </div>
            <div class="field">
                <label for="zip">Zip:</label>
                <input type="text" name="zip"><br>
            </div>
            <div class="field">
                <label for="phone_work">Phone Work:</label>
                <input type="tel" name="phone_work"><br>
            </div>
            <div class="field">
                <label for="phone_mobile">Phone Mobile:</label>
                <input type="tel" name="phone_mobile"><br>
            </div>

            <div class="field">
                <label for="email_1">Email:</label>
                <input type="email" name="email_1"><br>
            </div>
            <div class="field">
                <label for="web">Web:</label>
                <input type="url" name="web"><br>
            </div>
            <div class="field">
                <label for="since">Since:</label>
                <input type="url" name="since"><br>
            </div>
            <div class="field">
                <label for="gender">Gender:</label>
                <input type="text" name="gender"><br>
            </div>
            <div class="field">
                <label for="dob">DOB:</label>
                <input type="text" name="dob"><br>
            </div>
            <div class="field textarea large">
                <label for="notes">Notes:</label>
                <textarea name="notes" id="" cols="30" rows="10"></textarea>
            </div>





        </div>

        <button type="submit" name="submit_contact" class="button button-primary">
            <span class="iconify" data-icon="ion:ios-save" data-inline="false"></span>
            <span>Save</span>
        </button>

    </form>
</div>


<?php require_once plugin_dir_path(__FILE__) . '../components/footer.php'; ?>