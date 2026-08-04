
$('.menu').on('click', function () {
  ocultar_todo()
  console.log(this.id)
  console.log('CAMBIO')
  switch (this.id) {
    case 'solicitud':
      mostrar_solicitud()
      break
    case 'documentos':
      $('#sub_documentos').show()
      $('#89682335465afe6f344a372005028595').show()
      break
    case 'historial':
      $('#sub_historial').show()
      $('#24402141165afe6f3464602000676261').show()
      break

  }
})

function ocultar_todo() {
  $('#sub_info').hide()
  $('#39099956865afe6f34626a7042279865').hide()
  $('#sub_declaracion').hide()
  $('#99540153965afe6f344b488063484252').hide()
  $('#sub_poliza').hide()
  $('#91396116065afe6f345c669041463905').hide()
  $('#sub_parte').hide()
  $('#88721209965afe6f345b6a4073649834').hide()
  $('#sub_historial').hide()
  $('#24402141165afe6f3464602000676261').hide()
  $('#sub_documentos').hide()
  $('#89682335465afe6f344a372005028595').hide()

}
function mostrar_solicitud() {
  $('#sub_info').show()
  $('#39099956865afe6f34626a7042279865').show()
  $('#sub_declaracion').show()
  $('#99540153965afe6f344b488063484252').show()
  $('#sub_poliza').show()
  $('#91396116065afe6f345c669041463905').show()
  $('#sub_parte').show()
  $('#88721209965afe6f345b6a4073649834').show()

}

ocultar_todo()
mostrar_solicitud()

