<?php
global $wpdb;

$table_name = $wpdb->prefix . 'crm_contacts';
$per_page = 5;
$current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
$offset = ($current_page - 1) * $per_page;

$search_term = isset($_GET['search_term']) ? sanitize_text_field($_GET['search_term']) : '';
$fields_to_search = array(
    'first_name', 'last_name', 'email_1', 'zip', 'Category', 'Service', 'City', 'State'
);

$query = "SELECT * FROM $table_name";

if (!empty($search_term)) {
    $conditions = array();
    foreach ($fields_to_search as $field) {
        $conditions[] = "$field LIKE '%{$search_term}%'";
    }
    $query .= " WHERE " . implode(' OR ', $conditions);
}

$query .= " ORDER BY registration_date DESC";
$query .= " LIMIT $per_page OFFSET $offset";

$contacts = $wpdb->get_results($query, ARRAY_A);
$total_contacts = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");

if (isset($_POST['submit_delete'])) {
    $delete_contact_ids = isset($_POST['delete_contact_ids']) ? array_map('intval', $_POST['delete_contact_ids']) : array();

    if (!empty($delete_contact_ids)) {
        $wpdb->query("DELETE FROM $table_name WHERE id IN (" . implode(',', $delete_contact_ids) . ")");
        echo '<div class="updated"><p>Contacts deleted successfully.</p></div>';

        echo '<script> window.location.href = "' . admin_url('admin.php?page=crm-overview') . '";</script>';
    } else {
        echo '<div class="error"><p>Please select at least one contact to delete.</p></div>';
    }
}
?>


<div class="all-contacts">
    <form method="get" action="">
        <input placeholder='Enter search term' type="search" name="search_term">
        <input type="hidden" name="page" value="crm-overview"> <!-- Agregar este campo oculto -->
        <button type="submit">Search</button>
    </form>

    <form method="post" action="">
        <div class="options">
            <ul>
                <li>
                    <a class='btn' href="<?php echo admin_url('admin.php?page=new-contact'); ?>">
                        <span class="iconify color-green" data-icon="material-symbols:add-circle"
                            data-inline="false"></span>
                        <span>Add Contact</span>
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
                        <th class='small'>Mail</th>
                        <th class='small'>SMS</th>
                        <th class=''>Papers</th>
                        <th class='small'>Bill</th>
                        <th class='medium'>Type</th>
                        <th>Image</th>
                        <th>Gender</th>

                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Service</th>
                        <th>Company</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Phone Work</th>
                        <th>Phone Mobile</th>
                        <th>Email</th>
                        <th>Web</th>
                        <th>Slogan</th>
                        <th>DOB</th>
                        <th>Since</th>
                        <th>Registration date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($total_contacts == 0) {
                        echo '<tr><td colspan="29"><div class="notice notice-warning"><p>No contacts found.</p></div></td></tr>';
                    } else {
                        foreach ($contacts as $contact) :
                    ?>
                    <tr>
                        <td class='select'><input type="checkbox" class="delete-checkbox" name="delete_contact_ids[]"
                                value="<?php echo esc_attr($contact['id']); ?>"></td>
                        <td class='id'><?php echo esc_html($contact['id']); ?></td>
                        <td>
                            <a class='button edit-btn'
                                href="<?php echo admin_url('admin.php?page=edit-contact&contact_id=' . $contact['id']); ?>">
                                <span class="iconify color-orange" data-icon="material-symbols:edit-sharp"
                                    data-inline="false"></span>
                            </a>
                        </td>
                        <td>
                            <a class='button' href="">
                                <span class="iconify" data-icon="material-symbols:outgoing-mail"
                                    data-inline="false"></span>
                            </a>
                        </td>
                        <td>
                            <a class='button' href="">
                                <span class="iconify" data-icon="logos:whatsapp-icon" data-inline="false"></span>
                            </a>

                        </td>
                        <td>
                            <a class='button' href="">
                                <span class="iconify color-yellow" data-icon="material-symbols:folder-open-rounded"
                                    data-inline="false"></span>
                            </a>
                        </td>
                        <td>
                            <a class='button' href="">
                                <span class="iconify color-gray" data-icon="ic:baseline-circle"
                                    data-inline="false"></span>
                            </a>
                        </td>
                        <td>type</td>
                        <td><?php echo esc_html($contact['image']); ?></td>

                        <td>
                            <?php
                                $gender = esc_html($contact['gender']); 
                                $color_class = '';
                                if ($gender === 'male') {
                                    $color_class = 'color-blue';
                                } elseif ($gender === 'female') {
                                    $color_class = 'color-pink';
                                } else {
                                    $color_class = 'color-gray';
                                }
                                ?>
                            <span class='button'>
                                <span class="iconify <?php echo $color_class; ?>" data-icon="ic:baseline-circle"
                                    data-inline="false"></span>
                            </span>
                        </td>

                        <td><?php echo esc_html($contact['first_name']); ?></td>
                        <td><?php echo esc_html($contact['last_name']); ?></td>
                        <td><?php echo esc_html($contact['title']); ?></td>
                        <td><?php echo esc_html($contact['category']); ?></td>
                        <td><?php echo esc_html($contact['service']); ?></td>
                        <td><?php echo esc_html($contact['company']); ?></td>
                        <td><?php echo esc_html($contact['city']); ?></td>
                        <td><?php echo esc_html($contact['state']); ?></td>
                        <td><?php echo esc_html($contact['zip']); ?></td>
                        <td><?php echo esc_html($contact['phone_work']); ?></td>
                        <td><?php echo esc_html($contact['phone_mobile']); ?></td>
                        <td><?php echo esc_html($contact['email_1']); ?></td>
                        <td><?php echo esc_html($contact['web']); ?></td>
                        <td><?php echo esc_html($contact['slogan']); ?></td>
                        <td><?php echo esc_html($contact['dob']); ?></td>
                        <td><?php echo esc_html($contact['since']); ?></td>
                        <td><?php echo esc_html($contact['registration_date']); ?></td>
                    </tr>
                    <?php endforeach; } ?>
                </tbody>
            </table>
        </div>


    </form>

    <?php 
        $total_pages = ceil($total_contacts / $per_page);
        if ($total_pages > 1) {
            echo '<div class="pagination">';
            echo paginate_links(array(
                'base' => add_query_arg(array('paged' => '%#%', 'search_term' => $search_term, 'page' => 'crm-overview')),
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

<script>
document.getElementById('select-all').addEventListener('change', function() {
    var checkboxes = document.getElementsByClassName('delete-checkbox');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
    }
});
</script>