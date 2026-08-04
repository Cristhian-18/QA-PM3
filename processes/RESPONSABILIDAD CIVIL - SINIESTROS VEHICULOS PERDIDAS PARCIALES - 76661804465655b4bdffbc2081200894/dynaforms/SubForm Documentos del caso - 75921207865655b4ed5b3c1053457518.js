var host = PMDynaform.getHostName();
var ws = PMDynaform.getWorkspaceName();
var app_uid = frames.app_uid ? frames.app_uid : '';
var app_uid_padre = $("#app_uid_rc").getValue() || ''; // campo del dynaform con el UID padre

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

    // Leer app_uid_padre en el momento de ejecutar (puede que cargue después)
    var uid_padre = $("#app_uid_rc").getValue() || '';

    $.ajax({
        url: host + "/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/consultar_documentos/obtener_enlaces_rc.php"
            + "?app_uid=" + app_uid
            + "&app_uid_padre=" + uid_padre,
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (!response.success || !response.documentos.length) return;
            llenarGridDocumentos(response.documentos, "gridDocumentos");
            llenarGridDocumentos(response.documentos_cliente, "gridDocumentos_cliente");
        },
        error: function (xhr, status, error) {
            console.error("Error cargando documentos RC:", error);
        }
    });
}

function llenarGridDocumentos(docs, gridId) {
    // Vaciar visualmente
    var totalFilas = $("#" + gridId).getNumberRows();
    for (var i = totalFilas; i > 1; i--) {
        $("#" + gridId).deleteRow(i);
    }
    for (var c = 1; c <= 5; c++) {
        $("#" + gridId).setValue("", 1, c);
    }
    // Llenar
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