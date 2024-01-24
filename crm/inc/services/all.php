<?php
global $wpdb;

$table_name = $wpdb->prefix . 'crm_services';
$per_page = 50;
$current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
$offset = ($current_page - 1) * $per_page;

$categories = $wpdb->get_results("SELECT * FROM $table_name LIMIT $per_page OFFSET $offset", ARRAY_A);

// Total number of categories
$total_categories = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");

// Deletion
if (isset($_POST['submit_delete'])) {
    $delete_category_ids = isset($_POST['delete_category_ids']) ? array_map('intval', $_POST['delete_category_ids']) : array();

    if (!empty($delete_category_ids)) {
        $wpdb->query("DELETE FROM $table_name WHERE id IN (" . implode(',', $delete_category_ids) . ")");
        echo '<div class="updated"><p>Services deleted successfully.</p></div>';

        echo '<script> window.location.href = "' . admin_url('admin.php?page=crm-services') . '";</script>';
    } else {
        echo '<div class="error"><p>Please select at least one service to delete.</p></div>';
    }
}
?>
<?php require_once plugin_dir_path(__FILE__) . '../components/header.php'; ?>



<div class="tabs">


    <div class="tabs-nav">
        <a href="<?php echo admin_url('admin.php?page=crm-settings'); ?>" class="tabs-btn " id="options">General
            Options</a>
        <a href="<?php echo admin_url('admin.php?page=crm-categories'); ?>" class="tabs-btn "
            id="categories">Categories</a>
        <a href="<?php echo admin_url('admin.php?page=crm-services'); ?>" class="tabs-btn current"
            id="services">Services</a>
        <a href="<?php echo admin_url('admin.php?page=crm-contacts-type'); ?>" class="tabs-btn " id="types">Stages</a>
    </div>


    <div class="tabs-content ">
        <p>Loading...</p>
    </div>

    <div class="tabs-content">
        <p>Loading...</p>
    </div>
    <div class="tabs-content current">

        <h1>Services</h1>

        <div class="all-categories">
            <form method="post" action="">
                <div class="options">
                    <ul>
                        <li>
                            <a class='btn' href="<?php echo admin_url('admin.php?page=new-service'); ?>">
                                <span class="iconify color-green" data-icon="material-symbols:add-circle"
                                    data-inline="false"></span>
                                <span>Add New Service</span>
                            </a>
                        </li>
                        <li>

                            <button class='btn' type="submit" name="submit_delete">
                                <span class="iconify color-red" data-icon="material-symbols:delete-forever"
                                    data-inline="false"></span>
                                <span>Delete</span> </button>
                        </li>
                    </ul>
                </div>

                <div class="scroll">
                    <table class="wp-list-table  fixed striped">
                        <thead>
                            <tr>
                                <th class='select'><input type="checkbox" id="select-all"></th>
                                <th class='id'>ID</th>
                                <th class='small'>Edit</th>
                                <th>Service</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    if ($total_categories == 0) {
                        echo '<tr><td colspan="29"><div class="notice notice-warning"><p>No service found.</p></div></td></tr>';
                    } else {
                        foreach ($categories as $category) : 
                            ?>
                            <tr>
                                <td class='select'><input type="checkbox" class="delete-checkbox"
                                        name="delete_category_ids[]" value="<?php echo esc_attr($category['id']); ?>">
                                </td>
                                <td class='id'><?php echo esc_html($category['id']); ?></td>
                                <td>
                                    <a class='button edit-btn'
                                        href="<?php echo admin_url('admin.php?page=edit-service&category_id=' . $category['id']); ?>">
                                        <span class="iconify color-orange" data-icon="material-symbols:edit-sharp"
                                            data-inline="false"></span>
                                    </a>
                                </td>

                                <td><?php echo esc_html($category['service_name']); ?></td>

                            </tr>
                            <?php endforeach;
                    }
                    ?>
                        </tbody>
                    </table>
                </div>
            </form>

            <?php 
                $total_pages = ceil($total_categories / $per_page);
                if ($total_pages > 1) {
                    echo '<div class="pagination">';
                    echo paginate_links(array(
                        'base' => add_query_arg('paged', '%#%'),
                        'format' => '',
                        'prev_text' => __('&laquo;'),
                        'next_text' => __('&raquo;'),
                        'total' => $total_pages,
                        'current' => $current_page,
                    ));
                    echo '</div>';
                }
            ?>
        </div>
    </div>


    <div class="tabs-content ">
        <p>Loading...</p>
    </div>

</div>






<?php require_once plugin_dir_path(__FILE__) . '../components/footer.php'; ?>


<script>
document.getElementById('select-all').addEventListener('change', function() {
    var checkboxes = document.getElementsByClassName('delete-checkbox');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
    }
});
</script>