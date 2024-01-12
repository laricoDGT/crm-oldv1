<?php 

function crm_search_shortcode($atts) {
 
    $atts = shortcode_atts(array(
        'zip' => '',
        'city' => '',
        'service' => '',
        'category' => '',
    ), $atts);

    global $wpdb;
 
    $sql = "SELECT * FROM {$wpdb->prefix}crm_contacts WHERE 1=1";

  
    $attribute_labels = array(
        'zip' => 'Zip',
        'city' => 'City',
        'service' => 'Service',
        'category' => 'Category',
    );
 
    $output = '<div class="crm-search-container">';
 
    foreach ($atts as $attribute => $value) {
        if (!empty($value)) {
            if ($attribute == 'category') {
                $categories = explode(',', $value);
                $categories_clause = implode("', '", $categories);
                $sql .= " AND {$attribute} IN ('{$categories_clause}')";
            } else {
                $sql .= " AND {$attribute} = '{$value}'";
            }
 
            $output .= '<h3 class="crm-sc-title">' . esc_html($attribute_labels[$attribute]) . ': ' . esc_html($value) . '</h3>';
        }
    }
 
    $results = $wpdb->get_results($sql);

    $output .= '<ul class="shortcode-items">';
    foreach ($results as $result) {
        $output .= '<li>';
        $output .= '<h4>' . esc_html($result->first_name) . ' ' . esc_html($result->last_name) . '</h4>';
        $output .= '<p>Gender: ' . esc_html($result->gender) . '</p>';
        $output .= '<p>Date of Birth: ' . esc_html($result->dob) . '</p>';
      

        if (!empty($result->email_1)) {
            $output .= '<p>Email: ' . esc_html($result->email_1) . '</p>';
        }

        // Add more information as needed
     
        $output .= '</li>';
    }
    $output .= '</ul>';

    $output .= '</div>'; 

    return $output;
}
 
add_shortcode('crm_search', 'crm_search_shortcode');