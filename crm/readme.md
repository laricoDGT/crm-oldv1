# Unite name for categories or services

```
function make_unique_name($table, $column, $name) {
        global $wpdb;
        $count = 1;
        $original_name = $name;

        while ($wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE $column = %s", $name)) > 0) {
            $name = $original_name . '-' . ++$count;
        }

        return $name;
    }
```

# Shortcodes

```
[crm_search zip="" city='' service='' category='Awesome']
```

<!--
// Edit dialog

 <a class='open-dialog' data-contact-id='<?php echo $contact['id']; ?>'>
                                <?php echo esc_html($contact['type']); ?>
                            </a>

        // dialog container
<div id='editDialog' title='Edit Contact'></div>

    $('#editDialog').dialog({
        autoOpen: false,
        modal: true,
        width: '90%',
        fluid: true,
        height: 600,


        create: function(event, ui) {
            // Set maxWidth
            $(this).css("maxWidth", "660px");
            $(this).css("margin", "auto");
        },

        open: function() {
            // Cargar la página en un iframe en el diálogo cuando se abre
            $(this).html('<iframe style="border: 0; " src="admin.php?page=edit-contact&contact_id=' + $(
                this).data('contact-id') + '" width="100%" height="100%"></iframe>');
        },
        buttons: {
            "Close": function() {
                $(this).dialog("close");
                location.reload();
            }
        }
    });

    // Evento de clic para abrir el diálogo
    $('.open-dialog').click(function() {
        var contactId = $(this).data('contact-id');

        // Guardar el ID del contacto en el diálogo para usarlo después
        $('#editDialog').data('contact-id', contactId);

        // Abrir el diálogo
        $('#editDialog').dialog('open');
    });


     -->
