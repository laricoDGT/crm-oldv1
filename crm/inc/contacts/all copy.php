<?php  
    
    global $wpdb;

    $table_name = $wpdb->prefix . 'crm_contacts';
    $contacts = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
?>

<div class="all-contacts">

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
                <button class="btn load-block2" data-block="">
                    <span class="iconify color-red" data-icon="material-symbols:delete-forever"
                        data-inline="false"></span>
                    <span>Delete</span>
                </button>
            </li>


        </ul>
    </div>




    <div id="block-container2">
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Edit</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Category</th>
                    <th>Service</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <td><?php echo esc_html($contact['id']); ?></td>
                    <td></td>
                    <td><?php echo esc_html($contact['first_name']); ?></td>
                    <td><?php echo esc_html($contact['last_name']); ?></td>
                    <td><?php echo esc_html($contact['category']); ?></td>
                    <td><?php echo esc_html($contact['service']); ?></td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <script>
    /* 
    jQuery(document).ready(function($) {
        $(".load-block2").on("click", function() {
            $(".load-block2").removeClass("current");
            $(this).addClass("current");

            var blockName2 = $(this).data("block");
            $.ajax({
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                type: "POST",
                data: {
                    action: "load_block",
                    block: blockName2
                },
                success: function(response) {
                    $("#block-container2").html(response);
                }
            });
        }); 
    });
*/


    document.addEventListener('DOMContentLoaded', function() {
        var loadBlock2Buttons = document.querySelectorAll('.load-block2');

        loadBlock2Buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                loadBlock2Buttons.forEach(function(btn) {
                    btn.classList.remove('current');
                });

                this.classList.add('current');

                var blockName2 = this.getAttribute('data-block');

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById('block-container2').innerHTML = xhr
                            .responseText;
                    }
                };

                xhr.send('action=load_block&block=' + blockName2);
            });
        });
    });
    </script>




</div>



<?php
 
?>


<?php
// Hook 
add_action('wp_ajax_load_block', 'load_block_callback2');
add_action('wp_ajax_nopriv_load_block', 'load_block_callback2');

function load_block_callback2() {
    $block_name = sanitize_text_field($_POST['block']);

    // component name
    $block_path = plugin_dir_path(__FILE__) . '../components/' . $block_name . '.php';

    if (file_exists($block_path)) {
        include($block_path);
    }

    die(); // Important to prevent render
}