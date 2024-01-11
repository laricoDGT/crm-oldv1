<?php
function get_common_data() {
    $fields = get_contact_form_fields();
    $data = array();

    foreach ($fields as $key => $label) {
        $data[$key] = sanitize_input($_POST[$key]);
    }

    return $data;
}

function display_cat_form_fields($cat = null) {
    $fields = get_contact_form_fields();

    echo '<div class="fields">';
    foreach ($fields as $key => $label) {
        $class = strtolower(str_replace(' ', '_', $key));
        echo '<div class="field ' . $class . '">';
        echo '<label for="' . $key . '">' . $label;
        echo '</label>';

        $value = ($cat && property_exists($cat, $key)) ? esc_attr($cat->$key) : '';
        $required = ($key === 'category_name') ? 'required' : '';

        echo '<input type="' . ($key === 'since' ? 'date' : 'text') . '" name="' . $key . '" value="' . $value . '" ' . $required . '>';

        echo '<br>';
        echo '</div>';
    }
    echo '</div>';
}

function get_contact_form_fields() {
    return [
        'category_name' => 'Category',
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
            window.location.href = "' . admin_url('admin.php?page=crm-categories') . '";
        }, 1000);
    </script>';
}
?>