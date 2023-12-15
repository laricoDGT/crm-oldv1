<?php require_once plugin_dir_path(__FILE__) . '../components/header.php'; ?>

<?php
if (isset($_POST['submit_edit'])) {
    $contact_id = intval($_POST['contact_id']);
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

        $where = array('id' => $contact_id);

        $wpdb->update($table_name, $data, $where);
        echo '<div class="updated"><p>Contact updated successfully.</p>'; 
        echo '<a href="' . admin_url('admin.php?page=crm-overview') . '" class="button">Go to Contacts</a></br> </br></div>';


        echo '<script>
            setTimeout(function() {
                window.location.href = "' . admin_url('admin.php?page=crm-overview') . '";
            }, 1000);
        </script>';

    } else {
        echo '<div class="error"><p>Please fill out all required fields.</p></div>';
    }
} elseif (isset($_GET['contact_id'])) {
    $contact_id = intval($_GET['contact_id']);
    global $wpdb;
    $table_name = $wpdb->prefix . 'crm_contacts';
    $contact = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $contact_id));

    if ($contact) {
         
?>
<div class="form add-edit-contact">
    <h1>Edit Contact</h1>
    <form method="post" action="">

        <div class="fields">
            <input type="hidden" name="contact_id" value="<?php echo esc_attr($contact->id); ?>">

            <div class="field">
                <label for="first_name">First Name: <span class='color-red'>*</span> </label>
                <input type="text" name="first_name" value='<?php echo esc_attr($contact->first_name); ?>' required><br>
            </div>

            <div class="field">
                <label for="last_name">Last Name: <span class='color-red'>*</span></label>
                <input type="text" name="last_name" value='<?php echo esc_attr($contact->last_name); ?>' required><br>
            </div>

            <div class="field">
                <label for="company">Company:</label>
                <input type="text" name="company" value='<?php echo esc_attr($contact->company); ?>'><br>
            </div>
            <div class="field">
                <label for="title">Title:</label>
                <input type="text" name="title"><br>
            </div>

            <div class="field">
                <label for="category">Category:</label>
                <input type="text" name="category" value='<?php echo esc_attr($contact->category); ?>'><br>
            </div>

            <div class="field">
                <label for="service">Service:</label>
                <input type="text" name="service" value='<?php echo esc_attr($contact->service); ?>'><br>
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
                <label for="email_1">Email: <span class='color-red'>*</span></label>
                <input type="email" name="email_1" value='<?php echo esc_attr($contact->email_1); ?>' required><br>
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





        <button type="submit" name="submit_edit" class="button button-primary">
            <span class="iconify" data-icon="ion:ios-save" data-inline="false"></span>
            <span>Save</span>
        </button>
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