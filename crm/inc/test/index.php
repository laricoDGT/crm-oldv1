<?php
global $wpdb;

$table_name = $wpdb->prefix . 'crm_contacts';

$query = "SELECT id, first_name, last_name, email_1 FROM $table_name";
$results = $wpdb->get_results($query);

if ($results) {
    echo "<table border='1'>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>";

    foreach ($results as $row) {
        echo "<tr>
            <td class='editable-cell' data-id='" . esc_attr($row->id) . "' ondblclick='editCell(this)'>" . esc_html($row->first_name) . "</td>
            <td>" . esc_html($row->last_name) . "</td>
            <td>" . esc_html($row->email_1) . "</td>
          </tr>";
    }

    echo "</table>"; 
      

} else {
    echo "No hay resultados.";
}
?>

<script>
function editCell(cell) {
    // Crear un elemento de entrada de texto
    var input = document.createElement("input");
    input.type = "text";
    input.value = cell.innerText;

    // Reemplazar el contenido de la celda con el elemento de entrada de texto
    cell.innerHTML = "";
    cell.appendChild(input);

    // Establecer el enfoque en el elemento de entrada de texto
    input.focus();

    // Manejar el evento "keydown" para guardar los cambios al presionar Enter
    input.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            saveCell(cell, input.value);
        }
    });

    // Manejar el evento "blur" para guardar los cambios al hacer clic fuera del elemento de entrada de texto
    input.addEventListener("blur", function() {
        saveCell(cell, input.value);
    });
}

function saveCell(cell, value) {
    // Obtener el ID del contacto desde el atributo "data-id"
    var contactId = cell.getAttribute("data-id");

    // Realizar una solicitud AJAX para guardar los cambios en la base de datos
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Actualizar el contenido de la celda con el nuevo valor guardado
            cell.innerText = value;
        }
    };
    xhr.send("contactId=" + encodeURIComponent(contactId) + "&value=" + encodeURIComponent(value));
}
</script>