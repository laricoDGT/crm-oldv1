<?php 
function get_common_data() {
    $fields = get_contact_form_fields();
    $data = array();

    foreach ($fields as $key => $label) {
        $data[$key] = sanitize_input($_POST[$key]);
    }

    return $data;
}

function display_contact_form_fields($contact = null) {
    $fields = get_contact_form_fields();

    echo '<div class="fields">';
    foreach ($fields as $key => $label) {
        echo '<div class="field">';
        echo '<label for="' . $key . '">' . $label;
        if ($key === 'first_name' || $key === 'last_name' || $key === 'email_1') {
            echo '<span class="color-red">*</span>';
        }
        echo '</label>';

        $value = ($contact && property_exists($contact, $key)) ? esc_attr($contact->$key) : '';
        $required = ($key === 'first_name' || $key === 'last_name' || $key === 'email_1') ? 'required' : '';

        echo '<input type="' . ($key === 'email_1' ? 'email' : ($key === 'since' ? 'date' : 'text')) . '" name="' . $key . '" value="' . $value . '" ' . $required . '><br>';
        echo '</div>';
    }
    echo '</div>';
}

 
function get_contact_form_fields() {
    return [
        'image' => 'Image',
        'since' => 'Since',
        'gender' => 'Gender',
        'dob' => 'DOB',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'title' => 'Title',
        'category' => 'Category',
        'service' => 'Service',
        'company' => 'Company',
        'city' => 'City',
        'state' => 'State',
        'zip' => 'Zip',
        'phone_work' => 'Phone Work',
        'phone_mobile' => 'Phone Mobile',
        'email_1' => 'Email',
        'web' => 'Web',
        'slogan' => 'Slogan',
        'note' => 'Note',
    ];
}

 

function sanitize_input($input) {
    return sanitize_text_field($input);
}

function display_message($type, $message) {
    echo "<div class='$type'><p>$message</p></div>";
}

function redirect_to_crm_overview() {
    echo '<script>
        setTimeout(function() {
            window.location.href = "' . admin_url('admin.php?page=crm-overview') . '";
        }, 1000);
    </script>';
}
?>