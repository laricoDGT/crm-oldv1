<?php
global $wpdb;

$table_name = $wpdb->prefix . 'crm_contacts';
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 25;
$current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
$offset = ($current_page - 1) * $per_page;

$search_term = isset($_GET['search_term']) ? sanitize_text_field($_GET['search_term']) : '';
$fields_to_search = array(
    'first_name', 'last_name', 'email_1', 'zip', 'type', 'Category', 'Service', 'City', 'State'
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

        echo '<script> window.location.href = "' . admin_url('admin.php?page=crm') . '";</script>';
    } else {
        echo '<div class="error"><p>Please select at least one contact to delete.</p></div>';
    }
}
?>


<div class="all-contacts">
    <form method="get" action="">
        <input placeholder='Enter search term' type="search" name="search_term">
        <input type="hidden" name="page" value="crm">
        <button type="submit">
            <span class="iconify color-green" data-icon="material-symbols:search" data-width='18'
                data-inline="false"></span>
        </button>
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
                        <span>Delete</span>
                    </button>
                </li>
                <li>
                    <a class='btn export-to-pdf'>
                        <span class="iconify" data-icon="teenyicons:pdf-solid" data-inline="false"
                            data-width="16"></span>
                        <span>Export to PDF</span>
                    </a>
                </li>
                <li>
                    <a class='btn export-to-csv'>
                        <span class="iconify color-green" data-icon="teenyicons:csv-solid" data-inline="false"
                            data-width="16"></span>
                        <span>Export to CSV</span>
                    </a>
                </li>

                <li>

                    <a class='btn' href="<?php echo admin_url('admin.php?page=crm-contact-importer'); ?>">
                        <span class="iconify color-green" data-icon="fa6-solid:file-import" data-inline="false"
                            data-width="16"></span>
                        <span>Import Contacts (CSV)</span>
                    </a>
                </li>
            </ul>

        </div>

        <div class="scroll">
            <table id='crm-table' class="wp-list-table fixed striped">
                <thead>
                    <tr>
                        <th class='no-csv select'><input type="checkbox" id="select-all"></th>
                        <th class='no-csv id'>ID</th>
                        <th class='no-csv edit small'>Edit</th>
                        <th class='no-csv mail small'>Mail</th>
                        <th class='no-csv wa small'>WA</th>
                        <th class='no-csv sms small'>SMS</th>
                        <th class='no-csv papers'>Papers</th>
                        <th class='no-csv small'>Bill</th>
                        <th class='medium'>Stage</th>
                        <th class='no-csv avatar'>Image</th>
                        <th class='gender'>Gender</th>
                        <th class='firstname'>First Name</th>
                        <th class='lastname'>Last Name</th>
                        <th class='title'>Title</th>
                        <th class='category'>Category</th>
                        <th class='no-csv service'>Service</th>
                        <th class='company'>Company</th>
                        <th class='city'>City</th>
                        <th class='state'>State</th>
                        <th class='zip'>Zip</th>
                        <th class='phonework'>Phone Work</th>
                        <th class='phonemobile'>Phone Mobile</th>
                        <th class='email'>Email</th>
                        <th class='web'>Web</th>
                        <th class='no-csv slogan'>Slogan</th>
                        <th class='dob'>DOB</th>
                        <th class='no-csv since'>Since</th>
                        <th class='no-csv registrationdate'>Registration date</th>
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
                        <td class='no-csv select'><input type="checkbox" class="delete-checkbox"
                                name="delete_contact_ids[]" value="<?php echo esc_attr($contact['id']); ?>"></td>
                        <td class='no-csv id'><?php echo esc_html($contact['id']); ?></td>
                        <td class='no-csv'>
                            <a class='button edit-btn'
                                href="<?php echo admin_url('admin.php?page=edit-contact&contact_id=' . $contact['id']); ?>">
                                <span class="iconify color-orange" data-icon="material-symbols:edit-sharp"
                                    data-inline="false"></span>
                            </a>
                        </td>
                        <td class='no-csv'>

                            <?php 
                                if (!empty($contact['email_1'])) {
                                    echo '<a class="button" href="mailto:' . esc_html($contact['email_1']) . '">
                                            <span class="iconify" data-icon="material-symbols:outgoing-mail" data-inline="false"></span>
                                        </a>';
                                }
                            ?>

                        </td>
                        <td class='no-csv'>
                            <?php
                                if (!empty($contact['phone_mobile'])) { 
                                    $phone_number = str_replace(['.', '-', ' '], '', $contact['phone_mobile']); 
                                    echo '<a target="_blank" class="button" href="https://wa.me/' . esc_html($phone_number) . '">
                                            <span class="iconify" data-icon="logos:whatsapp-icon" data-inline="false"></span>
                                        </a>';
                                }
                            ?>

                        </td>
                        <td class='no-csv'>
                            <?php
                                if (!empty($contact['phone_mobile'])) { 
                                    $phone_number = str_replace(['.', '-', ' '], '', $contact['phone_mobile']); 
                                    echo '<a target="_blank" class="button" href="sms:+' . esc_html($phone_number) . '?body=">
                                            <span class="iconify" data-icon="mdi:cellphone" data-inline="false"></span>
                                        </a>';
                                }
                            ?>

                        </td>
                        <td class='no-csv'>
                            <a class='button' href="">
                                <span class="iconify color-yellow" data-icon="material-symbols:folder-open-rounded"
                                    data-inline="false"></span>
                            </a>
                        </td>
                        <td class='no-csv'>
                            <?php
                            $bill = esc_html($contact['bill']);
                            $color_class = '';

                            switch ($bill) {
                                case 'green':
                                    $color_class = 'color-green';
                                    break;
                                case 'red':
                                    $color_class = 'color-red';
                                    break;
                                default:
                                    $color_class = 'color-gray';
                                    break;
                            }
                            ?>
                            <span class='button'>
                                <span class="iconify <?php echo $color_class; ?>" data-icon="ic:baseline-circle"
                                    data-inline="false"></span>
                            </span>


                        </td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=quick-edit-contact&contact_id=' . $contact['id'] . '&to_type'); ?>"
                                class="openModal">
                                <?php echo !empty($contact['type']) ? esc_html($contact['type']) : 'Add'; ?>
                            </a>


                            <a href="<?php echo admin_url('admin.php?page=quick-new-contacts-type'); ?>"
                                class="modal-button openModal">
                                +
                            </a>
                        </td>
                        <td class='no-csv'>

                            <?php
                                $image_url = esc_html($contact['image']); 
                                if (filter_var($image_url, FILTER_VALIDATE_URL)) {
                                    echo "<img src='$image_url' class='avatar-img' loading='lazy' width='32' height='32' />";
                                } else {
                                    echo "";
                                }
                            ?>
                        </td>

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

                        <td>


                            <a href="<?php echo admin_url('admin.php?page=quick-edit-contact&contact_id=' . $contact['id'] . '&to_first_name'); ?>"
                                class="openModal"> <?php echo esc_html($contact['first_name']); ?></a>


                        </td>

                        <td>
                            <a href="<?php echo admin_url('admin.php?page=quick-edit-contact&contact_id=' . $contact['id'] . '&to_last_name'); ?>"
                                class="openModal">
                                <?php echo esc_html($contact['last_name']); ?>
                            </a>
                        </td>

                        <td><?php echo esc_html($contact['title']); ?></td>
                        <td><?php echo esc_html($contact['category']); ?></td>
                        <td class='no-csv'><?php echo esc_html($contact['service']); ?></td>
                        <td><?php echo esc_html($contact['company']); ?></td>
                        <td><?php echo esc_html($contact['city']); ?></td>
                        <td><?php echo esc_html($contact['state']); ?></td>
                        <td><?php echo esc_html($contact['zip']); ?></td>
                        <td><?php echo esc_html($contact['phone_work']); ?></td>
                        <td><?php echo esc_html($contact['phone_mobile']); ?></td>
                        <td><?php echo esc_html($contact['email_1']); ?></td>
                        <td><?php echo esc_html($contact['web']); ?></td>
                        <td class='no-csv'><?php echo esc_html($contact['slogan']); ?></td>
                        <td><?php echo esc_html($contact['dob']); ?></td>
                        <td class='no-csv'><?php echo esc_html($contact['since']); ?></td>
                        <td class='no-csv'><?php echo esc_html($contact['registration_date']); ?></td>
                    </tr>
                    <?php endforeach; } ?>
                </tbody>
            </table>
        </div>


    </form>

    <div class="table-footer">
        <div class="records">
            <span>Records per Page</span>
            <select name="per_page" id="per_page" onchange="changePerPage(this.value)">
                <option value="5" <?php echo ($per_page == 5) ? 'selected' : ''; ?>>5</option>
                <option value="25" <?php echo ($per_page == 25) ? 'selected' : ''; ?>>25</option>
                <option value="50" <?php echo ($per_page == 50) ? 'selected' : ''; ?>>50</option>
                <option value="100" <?php echo ($per_page == 100) ? 'selected' : ''; ?>>100</option>
                <option value="200" <?php echo ($per_page == 200) ? 'selected' : ''; ?>>200</option>
                <option value="300" <?php echo ($per_page == 300) ? 'selected' : ''; ?>>300</option>
                <option value="500" <?php echo ($per_page == 500) ? 'selected' : ''; ?>>500</option>
            </select>
        </div>

        <?php 
        $total_pages = ceil($total_contacts / $per_page);
        if ($total_pages > 1) {
            echo '<div class="pagination">';
            echo paginate_links(array(
                'base' => add_query_arg(array('paged' => '%#%', 'search_term' => $search_term, 'per_page' => $per_page, 'page' => 'crm')),
                'format' => '',
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
                'total' => $total_pages,
                'current' => $current_page,
            ));
            echo '</div>';
        }
    ?>

        <div class="displaying">
            Displaying <strong><?php echo (($current_page - 1) * $per_page) + 1; ?></strong> -
            <strong><?php echo min($current_page * $per_page, $total_contacts); ?></strong> of
            <strong><?php echo $total_contacts; ?></strong>
        </div>
    </div>


</div>




<script>
function changePerPage(value) {
    window.location.href = "<?php echo admin_url('admin.php?page=crm&per_page='); ?>" + value;
}



document.getElementById('select-all').addEventListener('change', function() {
    var checkboxes = document.getElementsByClassName('delete-checkbox');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
    }
});


(function($) {
    $(document).ready(function() {
        $('.wp-list-table th:not(.select)').click(function() {
            var table = $(this).parents('table').eq(0)
            var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
            this.asc = !this.asc
            if (!this.asc) {
                rows = rows.reverse()
                $(this).addClass('descending').removeClass('ascending');
            } else {
                $(this).addClass('ascending').removeClass('descending');
            }
            for (var i = 0; i < rows.length; i++) {
                table.append(rows[i])
            }
        })

        function comparer(index) {
            return function(a, b) {
                var valA = getCellValue(a, index),
                    valB = getCellValue(b, index)
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString()
                    .localeCompare(valB)
            }
        }

        function getCellValue(row, index) {
            return $(row).children('td').eq(index).text()
        }
    })


})(jQuery);
</script>



<?php 
require_once plugin_dir_path(__FILE__) . '../../assets/exports.php';
?>