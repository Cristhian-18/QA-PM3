var host = PMDynaform.getHostName();
var ws = PMDynaform.getWorkspaceName();
var app_uid = frames.app_uid ? frames.app_uid : '';

$(function () {
    var numero_columna_link = 5;

    // Refrescar links existentes
    for (var i = 1; i <= $("#gridDocumentos").getNumberRows(); i++) {
        var url = $("#gridDocumentos").getValue(i, numero_columna_link);
        $("#gridDocumentos").setValue(url, i, numero_columna_link);
    }

    // Si los enlaces están vacíos, cargar automáticamente
    var primerEnlace = $("#gridDocumentos").getValue(1, numero_columna_link);
    if (!primerEnlace || primerEnlace.trim() === '') {
        cargarDocumentos();
    }

    // Comentarios
    $('#historial_comentarios').html($('#tri_comentarios').getValue());
    $('#tabla-comentarios').dataTable({
        dom: 'Bfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
        "language": {
            "url": "/plugin/phsoluciones/core_librerias/datatables/spanish.json"
        }
    });
});

function cargarDocumentos() {
    if (!app_uid) return;
    $.ajax({
        url: host + "/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/consultar_documentos/obtener_enlaces.php?app_uid=" + app_uid,
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (!response.success || !response.documentos.length) return;
            llenarGridDocumentos(response.documentos);
        },
        error: function (xhr, status, error) {
            console.error("Error cargando documentos:", error);
        }
    });
}

function llenarGridDocumentos(docs) {
    var gridId = "gridDocumentos";
    var totalFilas = $("#" + gridId).getNumberRows();
    for (var i = totalFilas; i > 1; i--) {
        $("#" + gridId).deleteRow(i);
    }
    for (var c = 1; c <= 5; c++) {
        $("#" + gridId).setValue("", 1, c);
    }
    $.each(docs, function (i, doc) {
        if (i === 0) {
            $("#" + gridId).setValue(doc.fecha, 1, 1);
            $("#" + gridId).setValue(doc.archivo, 1, 2);
            $("#" + gridId).setValue(doc.comentario, 1, 3);
            $("#" + gridId).setValue(doc.usuario, 1, 4);
            $("#" + gridId).setValue(doc.descarga, 1, 5);
        } else {
            $("#" + gridId).addRow([
                { value: doc.fecha },
                { value: doc.archivo },
                { value: doc.comentario },
                { value: doc.usuario },
                { value: doc.descarga }
            ]);
        }
    });
}