<script>
jQuery(document).ready(function($) {
    $(".load-block").on("click", function() {
        $(".load-block").removeClass("current");
        $(this).addClass("current");

        var blockName = $(this).data("block");
        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: "POST",
            data: {
                action: "load_block",
                block: blockName
            },
            success: function(response) {
                $("#block-container").html(response);
            }
        });
    });
});
</script>




<?php
// Hook 
add_action('wp_ajax_load_block', 'load_block_callback');
add_action('wp_ajax_nopriv_load_block', 'load_block_callback');

function load_block_callback() {
    $block_name = sanitize_text_field($_POST['block']);

    // component name
    $block_path = plugin_dir_path(__FILE__) . 'components/' . $block_name . '.php';

    if (file_exists($block_path)) {
        include($block_path);
    }

    die(); // Important to prevent render
}