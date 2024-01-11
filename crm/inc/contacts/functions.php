<?php

function get_categories_from_database() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'crm_categories';  
    $categories = $wpdb->get_results("SELECT id, category_name FROM $table_name");

    return $categories;
}



function get_common_data() {
    $fields = get_contact_form_fields();
    $data = array();

    foreach ($fields as $key => $label) {
        if ($key === 'category') {
            $data[$key] = isset($_POST[$key]) ? implode(',', $_POST[$key]) : '';   
        } else {
            $data[$key] = sanitize_input($_POST[$key]);
        }
    }

    return $data;
}



function display_contact_form_fields($contact = null) {
    $fields = get_contact_form_fields();

    echo '<div class="fields">';
    foreach ($fields as $key => $label) {
        $class = strtolower(str_replace(' ', '_', $key));
        echo '<div class="field ' . $class . '">';
        echo '<label for="' . $key . '">' . $label;
        if ($key === 'first_name' || $key === 'last_name' || $key === 'email_1') {
            echo '<span class="color-red">*</span>';
        }
        echo '</label>';

        $value = ($contact && property_exists($contact, $key)) ? esc_attr($contact->$key) : '';
        $required = ($key === 'first_name' || $key === 'last_name' || $key === 'email_1') ? 'required' : '';

        if ($key === 'gender') {
            echo '<select name="' . $key . '" ' . $required . '>';
            echo '<option value="male" ' . selected('male', $value, false) . '>Male</option>';
            echo '<option value="female" ' . selected('female', $value, false) . '>Female</option>';
            echo '<option value="other" ' . selected('other', $value, false) . '>Other</option>';
            echo '</select>';
        } elseif ($key === 'note') {
            echo '<textarea name="' . $key . '" ' . $required . '>' . $value . '</textarea>';
        } elseif ($key === 'category') {
            $categories = get_categories_from_database();
            echo '<select name="' . $key . '[]" ' . $required . ' multiple>';
            foreach ($categories as $category) {
                $selected = in_array($category->category_name, explode(',', $value)) ? 'selected' : '';
                echo "<option value='{$category->category_name}' $selected>{$category->category_name}</option>";
            }
            echo '</select>';
        }else {
            echo '<input type="' . ($key === 'email_1' ? 'email' : ($key === 'since' ? 'date' : 'text')) . '" name="' . $key . '" value="' . $value . '" ' . $required . '>';
        }

        echo '<br>';
        echo '</div>';
    }
    echo '</div>';
}


function get_contact_form_fields() {
    return [
        // 'image' => 'Image',
        
        
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'gender' => 'Gender',
        'title' => 'Title',
        
        'service' => 'Service',
        'company' => 'Company',
        'city' => 'City',
        'state' => 'State',
        'zip' => 'Zip',
        'phone_work' => 'Phone Work',
        'phone_mobile' => 'Phone Mobile',
        'email_1' => 'Email',
        'web' => 'Web',
        
       
        'since' => 'Since', 
        'dob' => 'DOB',
        'category' => 'Category',
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