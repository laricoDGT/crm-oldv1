<script>
// export to pdf

function printData() {
    var divToPrint = document.getElementById("crm-table").cloneNode(true);

    var cellsToExclude = divToPrint.querySelectorAll(".no-csv");
    cellsToExclude.forEach(function(cell) {
        cell.parentNode.removeChild(cell);
    });

    var newWin = window.open("");
    newWin.document.write(
        "<html><head><title>CRM Contacts</title>" +
        "<style>" +
        "@media print {" +
        "  table {" +
        "    border-collapse: collapse;" +
        "    width: 100%;" +
        "  }" +
        "  th, td {" +
        "    border: 1px solid #ddd;" +
        "    padding: 4px;" +
        "    text-align: left;" +
        '    font-family: "system-ui", sans-serif;' +
        "  }" +
        "  th {" +
        "    background-color: #ccc;" +
        "  }" +
        "}" +
        "</style>" +
        "</head><body>"
    );
    newWin.document.write(divToPrint.outerHTML);
    newWin.document.write("</body></html>");
    newWin.print();
    newWin.close();
}

document.querySelector(".export-to-pdf").addEventListener("click", function() {
    printData();
});

// Exportar a CSV

document.addEventListener("DOMContentLoaded", () => {
    const csvButton = document.querySelector(".export-to-csv");
    const csvTable = document.querySelector("#crm-table");

    csvButton.addEventListener("click", () => {
        const csv = [];
        const rows = document.querySelectorAll("table tr");

        for (const row of rows) {
            const rowData = [];
            const columns = row.querySelectorAll("th, td");

            for (const [index, column] of columns.entries()) {
                if (!column.classList.contains("no-csv")) {
                    if ((index + 1) % 3 === 0) {
                        rowData.push('"' + column.innerText + '"');
                    } else {
                        rowData.push(column.innerText);
                    }
                }
            }
            csv.push(rowData.join(","));
        }

        downloadCSV(csv.join("\n"), "crm-contacts.csv");
    });

    function downloadCSV(csv, filename) {
        const csvFile = new Blob([csv], {
            type: "text/csv",
        });

        const downloadLink = document.createElement("a");
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
    }
});
</script>