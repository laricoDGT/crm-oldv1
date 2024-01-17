<?php
function get_categories_from_database() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'crm_categories';  
    $categories = $wpdb->get_results("SELECT id, category_name FROM $table_name");
    return $categories;
}

function get_services_from_database() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'crm_services';
    $services = $wpdb->get_results("SELECT id, service_name FROM $table_name");
    return $services;
}

function get_contact_types_from_database() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'crm_contacts_type';
    $types = $wpdb->get_results("SELECT id, contact_type_name FROM $table_name");
    return $types;
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
   
     // Load JSON
     $json_file_path = plugin_dir_path(__FILE__) . '../../assets/json/US_States_and_Cities.json';
     $cities_data = json_decode(file_get_contents($json_file_path), true);
 

    echo '<div class="fields">';
    foreach ($fields as $key => $label) {
        $class = strtolower(str_replace(' ', '_', $key));
        echo '<div class="field ' . $class . '">';
        echo '<label for="' . $key . '">' . $label;
        if ($key === 'first_name' || $key === 'last_name') {
            echo '<span class="color-red">*</span>';
        }
        echo '</label>';

        $value = ($contact && property_exists($contact, $key)) ? esc_attr($contact->$key) : '';
        $required = ($key === 'first_name' || $key === 'last_name') ? 'required' : '';

        if ($key === 'city' || $key === 'state') {
            echo '<input list="' . $key . 's" name="' . $key . '" value="' . $value . '" ' . $required . '>';
            echo '<datalist id="' . $key . 's">';
            foreach ($cities_data as $state => $cities) {
                echo '<option value="' . $state . '">';
                foreach ($cities as $city) {
                    echo '<option value="' . $city . '">';
                }
            }
            echo '</datalist>';
        } 

        elseif ($key === 'image') {
            $value = ($contact && property_exists($contact, $key)) ? esc_attr($contact->$key) : '';
            echo '<input type="text" name="' . $key . '" value="' . $value . '" class="image-upload-field">';
            echo '<button class="button  upload-image-btn" data-target="' . $key . '">   <span class="iconify" data-icon="material-symbols:add-photo-alternate"></span> Select Image </button>';
        }
        
        elseif ($key === 'gender') {
            echo '<select name="' . $key . '" ' . $required . '>';
            echo '<option value="male" ' . selected('male', $value, false) . '>Male</option>';
            echo '<option value="female" ' . selected('female', $value, false) . '>Female</option>';
            echo '<option value="other" ' . selected('other', $value, false) . '>Other</option>';
            echo '</select>';
        } 
        elseif ($key === 'bill') {
            echo '<select name="' . $key . '" ' . $required . '>';
            echo '<option value="blank" ' . selected('blank', $value, false) . '>Blank</option>';
            echo '<option value="green" ' . selected('green', $value, false) . '>Green</option>';
            echo '<option value="red" ' . selected('red', $value, false) . '>Red</option>';
            echo '</select>';
        }
        elseif ($key === 'service') {
            $services = get_services_from_database();
            echo '<select name="' . $key . '" ' . $required . '>';
            
           
            echo '<option value="" ' . selected('', $value, false) . '></option>';
            
            foreach ($services as $service) {
                $selected = ($value == $service->service_name) ? 'selected' : '';
                echo "<option value='{$service->service_name}' $selected>{$service->service_name}</option>";
            }
            echo '</select>';
        }
        elseif ($key === 'type') {
            $types = get_contact_types_from_database();
            echo '<select name="' . $key . '" ' . $required . '>';
            foreach ($types as $contact_type) {
                $selected = ($value == $contact_type->contact_type_name) ? 'selected' : '';
                echo "<option value='{$contact_type->contact_type_name}' $selected>{$contact_type->contact_type_name}</option>";
            }
            echo '</select>';
        }
        elseif ($key === 'note') {
            echo '<textarea name="' . $key . '" ' . $required . '>' . $value . '</textarea>';
        } elseif ($key === 'category') {
            $categories = get_categories_from_database();
            // echo '<select name="' . $key . '[]" ' . $required . ' multiple>';
            // foreach ($categories as $category) {
            //     $selected = in_array($category->category_name, explode(',', $value)) ? 'selected' : '';
            //     echo "<option value='{$category->category_name}' $selected>{$category->category_name}</option>";
            // }
            // echo '</select>';

            echo '<ul class="dropdown"><li><a href="#">Select Category</a>';
            echo '<ul class="submenu">';
            foreach ($categories as $category) {
                $checked = in_array($category->category_name, explode(',', $value)) ? 'checked' : '';
                echo "<li><label><input type='checkbox' name='{$key}[]' value='{$category->category_name}' $checked> {$category->category_name}</label></li>";
            }
            echo '</ul>';
            echo '</li></ul>';
        }else {
            
            echo '<input type="' . ($key === 'email_1' ? 'email' : ($key === 'since' ? 'date' : ($key === 'dob' ? 'date' : 'text'))) . '" name="' . $key . '" value="' . $value . '" ' . $required . '>';

        }

        echo '<br>';
        echo '</div>';
    }
    echo '</div>';
}


function get_contact_form_fields() {
    return [
        
        'type' => 'Type',
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
        'bill' => 'Bill',
        'category' => 'Category',
        'slogan' => 'Slogan',
        'note' => 'Note',
        'image' => 'Image', 
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
            window.location.href = "' . admin_url('admin.php?page=crm') . '";
        }, 1000);
    </script>';
}


// wp_enqueue_script('jquery');
wp_enqueue_media();

echo '<script>
    jQuery(document).ready(function($){
      
        $(".upload-image-btn").on("click", function(e){
            e.preventDefault();

            var button = $(this);
            var fieldName = button.data("target");
 
            var mediaUploader = wp.media({
                frame: "select",
                multiple: false,
            });
 
            mediaUploader.on("select", function(){
                var attachment = mediaUploader.state().get("selection").first().toJSON(); 
                $("input[name=\'" + fieldName + "\']").val(attachment.url);
            }); 
            mediaUploader.open();
        });
    });
</script>';

?>