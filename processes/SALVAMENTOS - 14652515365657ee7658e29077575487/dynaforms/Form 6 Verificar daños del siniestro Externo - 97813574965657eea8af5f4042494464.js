$("#repuestos").hide();


$('.menu').on('click', function () {
  ocultar_todo();
  console.log(this.id)
  console.log("CAMBIO")
  switch (this.id) {
    case 'solicitud':
      mostrar_solicitud();
      break;
    case 'documentos':
      $("#subt_docs").show();
      $("#23271031065657eea890261027484884").show();
      break;
    case 'historial':
      $("#sbt_historial").show();
      $("#38388078065657eea86f554052132558").show();
      break;
    case 'repuestos':
      $('#sub_valores').show()
      $('#83349221365657eea8935c0034368501').show()
      break
  }
  $("#frm_documentos_otros").hide();

});


function ocultar_todo() {
  $("#sub_busqueda").hide();
  $("#52345823565657eea89f273081823396").hide();
  $("#subt_vehiculo").hide();
  $("#39942008765657eea8c60e4037826925").hide();
  $("#subt_asegurado").hide();
  $("#77577551765657eea869184079116697").hide();
  $("#subt_detalle").hide();
  $("#40264027065657eea8a90a6057516237").hide();
  $("#subt_registro").hide();
  $("#41246456365657eea871e92041543660").hide();
  //$("#subt_ve_afectados").hide();
  //$("#15565307165657eea877078043143405").hide();
  $("#isubt_pe_afectados").hide();
  $("#72757335765657eea8a3ea5068757906").hide();
  $("#iisubt_pr_afectados").hide();
  $("#80125453265657eea8be050001169192").hide();
  $("#sub_docs").hide();
  $("#42369092065657eea875f65039015911").hide();
  $("#sub_valores").hide();
  $('#83349221365657eea8935c0034368501').hide()
  $("#81367868865657eea8ba0a9094814227").hide();
  $("#subt_docs").hide();
  $("#23271031065657eea890261027484884").hide();
  $("#sbt_historial").hide();
  $("#38388078065657eea86f554052132558").hide();
  $("#subt_poliza").hide();
  $("#85517892965657eea863bb6085915178").hide();
  $("#subt_hsiniestros").hide();
  $("#70029930365657eea866da2082229749").hide();
  $("#subt_ppolicial").hide();
  $("#15894986365657eea8bd0f2052191535").hide();
  $("#subt_direccionador").hide();
  $("#17233983365657eea8880d0032087370").hide();
  $("#subt_friss").hide();
  $("#37834123465657eea8c1164099238212").hide();

  $("#subt_accidente").hide();
  $("#33751146965657eea8867b4097970847").hide();
  //$("#subt_ve_afectados").hide();
  //$("#15565307165657eea877078043143405").hide();
  $("#isubt_pe_afectados").hide();
  $("#72757335765657eea8a3ea5068757906").hide();
  $("#iisubt_pr_afectados").hide();
  $("#80125453265657eea8be050001169192").hide();
  $("#94611480865657eea8ac269071748434").hide();

}
function mostrar_solicitud() {
  $("#sub_busqueda").show();
  $("#52345823565657eea89f273081823396").show();
  $("#subt_vehiculo").show();
  $("#39942008765657eea8c60e4037826925").show();
  $("#subt_asegurado").show();
  $("#77577551765657eea869184079116697").show();
  //$("#subt_detalle").show();
  //$("#40264027065657eea8a90a6057516237").show();
  //$("#subt_registro").show();
  //$("#41246456365657eea871e92041543660").show();
  //$("#subt_ve_afectados").show();
  //$("#15565307165657eea877078043143405").show();
  $("#isubt_pe_afectados").show();
  $("#72757335765657eea8a3ea5068757906").show();
  $("#iisubt_pr_afectados").show();
  $("#80125453265657eea8be050001169192").show();
  $("#sub_docs").show();
  $("#42369092065657eea875f65039015911").show();
  $("#sub_valores").show();
  $("#81367868865657eea8ba0a9094814227").show();
  $("#subt_poliza").show();
  $("#85517892965657eea863bb6085915178").show();
  $("#subt_hsiniestros").show();
  $("#70029930365657eea866da2082229749").show();
  $("#subt_ppolicial").show();
  $("#15894986365657eea8bd0f2052191535").show();
  $("#subt_direccionador").show();
  $("#17233983365657eea8880d0032087370").show();
  $("#subt_friss").show();
  $("#37834123465657eea8c1164099238212").show();
  $("#subt_accidente").show();
  $("#33751146965657eea8867b4097970847").show();
  //$("#subt_ve_afectados").show();
  //$("#15565307165657eea877078043143405").show();
  $("#isubt_pe_afectados").show();
  $("#72757335765657eea8a3ea5068757906").show();
  $("#iisubt_pr_afectados").show();
  $("#80125453265657eea8be050001169192").show();
  $("#94611480865657eea8ac269071748434").show();


}

ocultar_todo();
mostrar_solicitud();

