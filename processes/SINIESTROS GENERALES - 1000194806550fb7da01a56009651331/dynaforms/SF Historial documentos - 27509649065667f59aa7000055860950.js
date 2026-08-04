// Resuelve el bug de que el link de la grilla
// no funciona al cargar la data desde trigger.
$(function () {
  var numero_columna_link = 5;

  for (var i = 1; i <= $("#gridDocumentos").getNumberRows(); i++) {
    /*
    console.log('****************************');
    console.log($("#gridDocumentos").getText (i, numero_columna_link));
    console.log($("#gridDocumentos").getValue(i, numero_columna_link));
    */

    var url = $("#gridDocumentos").getValue(i, numero_columna_link);
    $("#gridDocumentos").setValue(url, i, numero_columna_link);
  }


  // Cargar documentos
  $('#historial_comentarios').html($('#tri_comentarios').getValue());
  $('#tabla-comentarios').dataTable({
    dom: 'Bfrtip',
    buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5'
    ],
    "language": {
      "url": "/plugin/beesmartec/core_librerias/datatables/spanish.json"
    }
  });

})

