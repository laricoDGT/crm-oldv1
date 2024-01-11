<?php
function crm_settings_page() {
    global $wpdb;

    function process_category_form() {
        global $wpdb;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["category_submit"])) {
            $category_name = sanitize_text_field($_POST["category_name"]);

            if (!empty($category_name)) {
                $category_name = make_unique_name($wpdb->prefix . 'crm_categories', 'category_name', $category_name);
                $table_name = $wpdb->prefix . 'crm_categories';
                $wpdb->insert($table_name, array('category_name' => $category_name));
            }
        }
    }

    function process_service_form() {
        global $wpdb;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["service_submit"])) {
            $service_name = sanitize_text_field($_POST["service_name"]);

            if (!empty($service_name)) {
                $service_name = make_unique_name($wpdb->prefix . 'crm_services', 'service_name', $service_name);
                $table_name = $wpdb->prefix . 'crm_services';
                $wpdb->insert($table_name, array('service_name' => $service_name));
            }
        }
    }

    function make_unique_name($table, $column, $name) {
        global $wpdb;
        $count = 1;
        $original_name = $name;
        
        while ($wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE $column = %s", $name)) > 0) {
            $name = $original_name . '-' . ++$count;
        }
        
        return $name;
    }

    function delete_category($category_id) {
        global $wpdb;

        $table_name = $wpdb->prefix . 'crm_categories';
        $wpdb->delete($table_name, array('id' => $category_id));
    }

    function delete_service($service_id) {
        global $wpdb;

        $table_name = $wpdb->prefix . 'crm_services';
        $wpdb->delete($table_name, array('id' => $service_id));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["category_submit"])) {
        process_category_form();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_category_name"])) {
        $edit_category_name = sanitize_text_field($_POST["edit_category_name"]);
        $edit_category_id = intval($_POST["edit_category_id"]);
    
        // Update the category in the database
        $table_name = $wpdb->prefix . 'crm_categories';
        $wpdb->update($table_name, array('category_name' => $edit_category_name), array('id' => $edit_category_id));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["service_submit"])) {
        process_service_form();
    }

    if (isset($_GET["delete_category"])) {
        $delete_category_id = intval($_GET["delete_category"]);
        delete_category($delete_category_id);
    }

    if (isset($_GET["delete_service"])) {
        $delete_service_id = intval($_GET["delete_service"]);
        delete_service($delete_service_id);
    }
?>

<?php require_once plugin_dir_path(__FILE__) . 'components/header.php'; ?>

<h1>CRM Settings</h1>

<br>


<div class="tabs">
    <div class="tabs-nav">
        <div class="tabs-btn current" id="options">General Options</div>
        <div class="tabs-btn" id="categories">Categories</div>
        <div class="tabs-btn" id="services">Services</div>
    </div>

    <div class="tabs-content current">
        <h2>Options</h2>
    </div>

    <div class="tabs-content">
        <h2>Categories</h2>
        <form method="post" action="">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" required>
            <input type="hidden" name="category_submit" value="1">
            <input type="submit" value="Add">
        </form>

        <h3>Category List</h3>
        <table class="wp-list-table fixed striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            <?php
    $categories = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}crm_categories", ARRAY_A);
    foreach ($categories as $category) {
        echo "<tr>";
        echo "<td>{$category['id']}</td>";
        echo "<td>{$category['category_name']}</td>";
        echo "<td>";
        echo "<a href='?page=crm-settings&edit_category={$category['id']}#categories'>Edit</a> | ";
        echo "<a href='?page=crm-settings&delete_category={$category['id']}#categories'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
        </table>



        <h3>Edit Category</h3>
        <form method="post" action="">
            <label for="edit_category_name">Edit Category Name:</label>
            <input type="text" name="edit_category_name" required>
            <input type="hidden" name="edit_category_id" value="<?php echo $category['id']; ?>">
            <input type="submit" value="Save">
        </form>


    </div>

    <div class="tabs-content">
        <h2>Services</h2>
        <form method="post" action="">
            <label for="service_name">Service Name:</label>
            <input type="text" name="service_name" required>
            <input type="hidden" name="service_submit" value="1">
            <input type="submit" value="Add">
        </form>

        <h3>Service List</h3>
        <table class='wp-list-table fixed striped'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            <?php
        $services = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}crm_services", ARRAY_A);
        foreach ($services as $service) {
            echo "<tr>";
            echo "<td>{$service['id']}</td>";
            echo "<td>{$service['service_name']}</td>";
            echo "<td><a href='?page=crm-settings&delete_service={$service['id']}#services'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
        </table>
    </div>

</div>

<?php require_once plugin_dir_path(__FILE__) . 'components/footer.php'; ?>

<?php
}
?>