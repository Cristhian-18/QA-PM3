
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
      $('#164219982655447c9733796008417810').show()
      break
    case 'historial':
      $('#sub_historial').show()
  $('#9579607476554479a9a40c3062705647').show()
      break
  
  }
})

function ocultar_todo() {
  $('#sub_info').hide()
  $('#8772638676554496d6f8428069996411').hide()
  $('#sub_declaracion').hide()
  $('#210046437654e5dda2471b8060121807').hide()
  $('#sub_poliza').hide()
  $('#712682644654e5e1b762a32057232411').hide()
  $('#sub_parte').hide()
  $('#595992730654e5eba660bc4059005720').hide()
  $('#sub_historial').hide()
  $('#9579607476554479a9a40c3062705647').hide()
  $('#sub_documentos').hide()
  $('#164219982655447c9733796008417810').hide()
  
}
function mostrar_solicitud() {
  $('#sub_info').show()
  $('#8772638676554496d6f8428069996411').show()
  $('#sub_declaracion').show()
  $('#210046437654e5dda2471b8060121807').show()
  $('#sub_poliza').show()
  $('#712682644654e5e1b762a32057232411').show()
  $('#sub_parte').show()
  $('#595992730654e5eba660bc4059005720').show()
    
}

ocultar_todo()
mostrar_solicitud()
