<?php

require_once plugin_dir_path(__FILE__) . '../components/header.php';


 
$importedContacts = 0;  

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csv_file"])) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'crm_contacts';

    $csv_file = $_FILES["csv_file"];

    if ($csv_file["error"] == UPLOAD_ERR_OK) {
        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir["basedir"] . '/' . basename($csv_file["name"]);

        move_uploaded_file($csv_file["tmp_name"], $file_path);

        if (($handle = fopen($file_path, "r")) !== FALSE) {
            // Skip the first row (headers)
            fgetcsv($handle, 1000, ",");
            
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $first_name = $data[0];
                $last_name = $data[1];
                $email = $data[2];
                $phone_mobile = $data[3];
                $city = $data[4];
                $state = $data[5];
                $zip = $data[6];

                $wpdb->insert(
                    $table_name,
                    array(
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email_1' => $email,
                        'phone_mobile' => $phone_mobile,
                        'city' => $city,
                        'state' => $state,
                        'zip' => $zip
                    )
                );

                $importedContacts++;
            }
            fclose($handle);

            unlink($file_path);

            echo "<div class='notice notice-success'><p>Successful import</p></div>";
        } else { 
            echo "<div class='notice notice-error'><p>Error processing CSV file</p></div>";
        }
    } else { 
        echo "<div class='notice notice-error'><p>Error uploading file</p></div>";
    }
}

// Insert your existing code below

global $wpdb;

$table_name = $wpdb->prefix . 'crm_contacts';

$query = "SELECT id, first_name, last_name, email_1, phone_mobile FROM $table_name";
$results = $wpdb->get_results($query);

$totalContacts = count($results); // Total number of contacts in the database

echo "<h1>Total Contacts: $totalContacts</h1>";
echo "<h2>Contacts Imported in this Session: $importedContacts</h2>";


/*
if ($results) {
    echo "<table class=' wp-list-table fixed striped importer-table'>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>";

    foreach ($results as $row) {
        echo "<tr>
            <td>" . esc_html($row->first_name) . "</td>
            <td>" . esc_html($row->last_name) . "</td>
            <td>" . esc_html($row->email_1) . "</td>
          </tr>";
    }

    echo "</table>";

} else { 
    echo "<div class='notice notice-warning'><p>No results.</p></div>"; 
}
*/

// Form for uploading the CSV file
echo "<div class='importer-form'><form method='post' enctype='multipart/form-data'>
        <label for='csv_file'>Select CSV file:</label>
        <input type='file' name='csv_file' accept='.csv' required>
        <input class='button button-primary' type='submit' value='Import'>
      </form> </div> ";
?>



<?php require_once plugin_dir_path(__FILE__) . '../components/footer.php'; ?>