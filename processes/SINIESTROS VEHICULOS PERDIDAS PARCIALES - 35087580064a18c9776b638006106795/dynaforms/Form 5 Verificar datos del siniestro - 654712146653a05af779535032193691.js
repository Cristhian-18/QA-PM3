console.log('verificar datos');

let nombre_taller = $("#frm_taller").getValue();
$("#grd_valores_siniestros").hideColumn(9);

$("#frm_valoresAprobados_procentajeDescuentoProformado").setValue(0);

let numberRows = $("#grd_valores_siniestros").getNumberRows();
console.log(numberRows);
let valorSuma = 0;


function checkValores(newVal, oldVal) {
  valorSuma = 0;
  valorTotal = 0;
  for (let i = 1; i <= numberRows; i++) {
    if ($("#grd_valores_siniestros").getValue(i, 11) != "Negado") {
      console.log("Valor", $("#grd_valores_siniestros").getValue(i, 5));
      valorSuma = valorSuma + parseInt($("#grd_valores_siniestros").getValue(i, 5));
    }
    valorTotal = valorTotal + parseInt($("#grd_valores_siniestros").getValue(i, 5));

  }
  $valorSuma = roundToFixed(valorSuma, 2);

  console.log("Valor suma", $valorSuma);
  $("#frm_valoresAprobados_valoresRepuestos1").setValue(valorSuma);
  console.log("Valor suma", $valorSuma);
  hideRepuestos();

}
checkValores($("#grd_valores_siniestros").getValue(), '');
$('#grd_valores_siniestros').change(checkValores);

function hideRepuestos() {
  console.log("Valor suma", valorSuma);
  if (valorTotal > 0) {
    if (nombre_taller.includes("MUNDO MOTRIZ")) {

    }
    if (nombre_taller == "TALLER INDEMNIZACION") {
      $("option[value='Aprobado']").remove();
      $("option[value='Pendiente']").remove();
    }

  } else {

    /*  $("#sub_gestionrepuestos").hide()
     $("#grd_valores_siniestros").hide() */

  }
}
function accion(newValue, oldValue) {
  $("#sub_gestionrepuestos").hide();
  $("#366613650653bef32842d90065375790").hide();
  //
  $("#file_ajusteCotizacion").enableValidation();
  //frm_valoresAprobados_manoObraProformada
  //frm_valoresAprobados_diasEstimadosReparacion
  $("#frm_valoresAprobados_manoObraProformada").enableValidation();
  $("#frm_valoresAprobados_diasEstimadosReparacion").enableValidation();
  if (newValue == 'COTIZAR') {
    $("#sub_gestionrepuestos").show();
    $("#366613650653bef32842d90065375790").show();
  }
  //MANTENER
  if (newValue == 'MANTENER') {
    $("#file_ajusteCotizacion").disableValidation();
    $("#frm_valoresAprobados_manoObraProformada").disableValidation();
    $("#frm_valoresAprobados_diasEstimadosReparacion").disableValidation();
  }
}


accion();
$("#frm_accion").setOnchange(accion);


$('.menu').on('click', function () {
  ocultar_todo()
  console.log(this.id)
  console.log('CAMBIO')
  switch (this.id) {
    case 'solicitud':

      mostrar_solicitud()
      break
    case 'documentos':
      $('#subt_docs').show()
      $('#418835952652a78d09ec638009652152').show()
      break
    case 'historial':
      $('#sbt_historial').show()
      $('#200528691652a78b49077a9030935355').show()
      break
    case 'repuestos':
      $('#sub_repuestos').show()
      $("#sub_gestionrepuestos").show();
      $("#470410481653944a172eeb1027144131").show();
      $('#sub_valores_aprobados').show()
      $('#38051173965398bc04c3a10085381199').show()
      $('#470410481653944a172eeb1027144131').show()
      $('#frm_comentarioAnalista_ajustadorInterno').show()

      break
  }
  hideRepuestos();
})

function ocultar_todo() {
  $('#frm_comentarioAnalista_ajustadorInterno').hide()
  $('#subt_friss').hide()
  $('#88678649164f7eaea023df2027918886').hide()
  $('#711981759653951b01d9fc7055662056').hide()
  $('#subt_tallerAsignado').hide()
  $('#subt_ppolicial').hide()
  $('#82315095164a5ea0d445d33098806451').hide()
  $('#subt_accesoriosRegistrados').hide()
  $('#757211058653970103ff5d0031705379').hide()
  $('#subt_accidente').hide()
  $('#342283484650ba7c9f2fd13056558401').hide()
  $('#585018357653c2950773cf3076340308').hide()
  $('#sub_busqueda').hide()
  $('#56711039964a8241d124701020566530').hide()
  $('#subt_vehiculo').hide()
  $('#95746246564a4a9c711dfb2023501124').hide()
  $('#subt_asegurado').hide()
  $('#15180521364a5eaf5f02815065887190').hide()
  $('#subt_detalle').hide()
  $('#61446768964a848b295ae19072670821').hide()
  $('#subt_registro').hide()
  $('#22536303964a5e5cc12a673090504456').hide()
  $('#subt_ve_afectados').hide()
  $('#24440509064a84d82d7a6e4090951046').hide()
  $('#isubt_pe_afectados').hide()
  $('#59581944164a84e6bc66f02025995827').hide()
  $('#iisubt_pr_afectados').hide()
  $('#83626962464a84f217fbb30019736581').hide()
  $('#sub_docs').hide()
  $('#24155013164a5edc37a3b68095174528').hide()
  $('#sub_valores').hide()
  $('#79905380564f7ece7bc8989091267394').hide()
  $('#subt_docs').hide()
  $('#418835952652a78d09ec638009652152').hide()
  $('#sbt_historial').hide()
  $('#200528691652a78b49077a9030935355').hide()
  $('#subt_poliza').hide()
  $('#12366487464a4a855bed4c8081629548').hide()
  $('#sub_repuestos').hide()
  $('#470410481653944a172eeb1027144131').hide()
  $('#subt_hsiniestros').hide()
  $('#14870785564a5e392d24239097281950').hide()
  $('#subt_direccionador').hide()
  $('#34599290264a5ec882dda43091413149').hide()
  $('#subt_documentosTaller').hide()
  $('#96756789765393848ee6b94042482704').hide()
  $('#subt_gestionTaller').hide()
  $('#63032550665392b8983d5f2053584474').hide()
  $('#subt_valoresSiniestros').hide()
  $('#256570049653931cb709279020139545').hide()
  $('#subt_documentos_cotizacion').hide()
  $('#8610529466539486b57c397064374142').hide()
  $('#sub_valores_aprobados').hide()
  $('#38051173965398bc04c3a10085381199').hide()


}
function mostrar_solicitud() {
  $('#frm_comentarioAnalista_ajustadorInterno').show()
  $('#subt_friss').show()
  $('#88678649164f7eaea023df2027918886').show()
  $('#711981759653951b01d9fc7055662056').show()
  $('#subt_tallerAsignado').show()
  $('#subt_ppolicial').show()
  $('#82315095164a5ea0d445d33098806451').show()
  $('#subt_accesoriosRegistrados').show()
  $('#757211058653970103ff5d0031705379').show()
  $('#subt_accidente').show()
  $('#342283484650ba7c9f2fd13056558401').show()
  $('#subt_hsiniestros').show()
  $('#sub_busqueda').show()
  $('#56711039964a8241d124701020566530').show()
  $('#subt_vehiculo').show()
  $('#95746246564a4a9c711dfb2023501124').show()
  $('#subt_asegurado').show()
  $('#15180521364a5eaf5f02815065887190').show()
  $('#subt_detalle').show()
  $('#61446768964a848b295ae19072670821').show()
  $('#subt_registro').show()
  $('#22536303964a5e5cc12a673090504456').show()
  $('#subt_ve_afectados').show()
  $('#24440509064a84d82d7a6e4090951046').show()
  $('#isubt_pe_afectados').show()
  $('#59581944164a84e6bc66f02025995827').show()
  $('#iisubt_pr_afectados').show()
  $('#83626962464a84f217fbb30019736581').show()
  $('#sub_docs').show()
  $('#24155013164a5edc37a3b68095174528').show()
  $('#sub_valores').show()
  $('#79905380564f7ece7bc8989091267394').show()
  $('#subt_poliza').show()
  $('#12366487464a4a855bed4c8081629548').show()
  $('#subt_historial_siniestro').show()
  $('#14870785564a5e392d24239097281950').show()
  $('#subt_direccionador').show()
  $('#34599290264a5ec882dda43091413149').show()
  $('#subt_documentosTaller').show()
  $('#96756789765393848ee6b94042482704').show()
  $('#subt_gestionTaller').show()
  $('#63032550665392b8983d5f2053584474').show()
  $('#subt_valoresSiniestros').show()
  $('#256570049653931cb709279020139545').show()
  $('#subt_documentos_cotizacion').show()
  $('#8610529466539486b57c397064374142').show()

}

ocultar_todo()
mostrar_solicitud()
