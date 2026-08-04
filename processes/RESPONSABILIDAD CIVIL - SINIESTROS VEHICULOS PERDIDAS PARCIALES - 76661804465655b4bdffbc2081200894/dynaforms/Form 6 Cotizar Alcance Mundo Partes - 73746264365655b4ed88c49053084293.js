$("#grd_valores_siniestros_alcance").hideColumn(9);
$("#grd_valores_siniestros_alcance").hideColumn(11);


function checkNewGrid(newVal, oldVal) {
  console.log("CHECK");
  let rowNum = 0;
  rowNum = $("#grd_valores_siniestros_alcance").getNumberRows();
  console.log(rowNum);
  for (let i= 1; i <= rowNum; i++) {
      let disponible = $("#grd_valores_siniestros_alcance").getValue(i, 7);

      if (disponible == "DISPONIBLE") {
          $("#grd_valores_siniestros_alcance").setValue("Aprobado", i,11);
      } 
      if (disponible == "IMPORTACIÓN") {
        $("#grd_valores_siniestros_alcance").setValue("Pendiente", i,11);
    } 
    if (disponible == "FABRICACION") {
      $("#grd_valores_siniestros_alcance").setValue("Indemnizacion", i,11);
  
    }
     
  }
}
checkNewGrid($("#grd_valores_siniestros_alcance").getValue(), '');
$("#grd_valores_siniestros_alcance").change(checkNewGrid);


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
      $("#75921207865655b4ed5b3c1053457518").show();
      break;
    case 'historial':
      $("#sbt_historial").show();
      $("#79094655365655b4ed40d17058683087").show();
      break;
    case 'repuestos':
      $('#sub_valores').show()
      $('#10860191065655b4ed51747094306214').show()
      break
  }
  $("#frm_documentos_otros").hide();

});


function ocultar_todo() {
  $("#sub_busqueda").hide();
  $("#60259283965655b4ed68cb6009778512").hide();
  $("#subt_vehiculo").hide();
  $("#17569986565655b4ed8c995023188336").hide();
  $("#subt_asegurado").hide();
  $("#76241453365655b4ed3ad27050479402").hide();
  $("#subt_detalle").hide();
  $("#41209453665655b4ed71780023900709").hide();
  $("#subt_registro").hide();
  $("#44056937965655b4ed42c04054669455").hide();
  //$("#subt_ve_afectados").hide();
  //$("#93254149565655b4ed46a66057215729").hide();
  $("#isubt_pe_afectados").hide();
  $("#43602034065655b4ed6ca46084965014").hide();
  $("#iisubt_pr_afectados").hide();
  $("#46533585865655b4ed84dd4018270742").hide();
  $("#sub_docs").hide();
  $("#98325375965655b4ed45b13092827388").hide();
  $("#sub_valores").hide();
  $('#57719423965655b4ed5e193039723079').hide()
  $("#51718349165655b4ed81039097317111").hide();
  $("#subt_docs").hide();
  $("#75921207865655b4ed5b3c1053457518").hide();
  $("#sbt_historial").hide();
  $("#79094655365655b4ed40d17058683087").hide();
  $("#subt_poliza").hide();
  $("#28358068365655b4ed35473079795674").hide();
  $("#subt_hsiniestros").hide();
  $("#47330327665655b4ed38dc0072757607").hide();
  $("#subt_ppolicial").hide();
  $("#57796621765655b4ed83ea3082357963").hide();
  $("#subt_direccionador").hide();
  $("#83210580965655b4ed546d3053710376").hide();
  $("#subt_friss").hide();
  $("#95547977665655b4ed87ca6055466913").hide();

  $("#subt_accidente").hide();
  $("#31053789365655b4ed53799071011166").hide();
  //$("#subt_ve_afectados").hide();
  //$("#93254149565655b4ed46a66057215729").hide();
  $("#isubt_pe_afectados").hide();
  $("#43602034065655b4ed6ca46084965014").hide();
  $("#iisubt_pr_afectados").hide();
  $("#46533585865655b4ed84dd4018270742").hide();
  $("#81475448765655b4ed746c3049785877").hide();
  $('#10860191065655b4ed51747094306214').hide()

}
function mostrar_solicitud() {
  $("#sub_busqueda").show();
  $("#60259283965655b4ed68cb6009778512").show();
  $("#subt_vehiculo").show();
  $("#17569986565655b4ed8c995023188336").show();
  $("#subt_asegurado").show();
  $("#76241453365655b4ed3ad27050479402").show();
  //$("#subt_detalle").show();
  //$("#41209453665655b4ed71780023900709").show();
  //$("#subt_registro").show();
  //$("#44056937965655b4ed42c04054669455").show();
  //$("#subt_ve_afectados").show();
  //$("#93254149565655b4ed46a66057215729").show();
  $("#isubt_pe_afectados").show();
  $("#43602034065655b4ed6ca46084965014").show();
  $("#iisubt_pr_afectados").show();
  $("#46533585865655b4ed84dd4018270742").show();
  $("#sub_docs").show();
  $("#98325375965655b4ed45b13092827388").show();
  $("#51718349165655b4ed81039097317111").show();
  $("#subt_poliza").show();
  $("#28358068365655b4ed35473079795674").show();
  $("#subt_hsiniestros").show();
  $("#47330327665655b4ed38dc0072757607").show();
  $("#subt_ppolicial").show();
  $("#57796621765655b4ed83ea3082357963").show();
  $("#subt_direccionador").show();
  $("#83210580965655b4ed546d3053710376").show();
  $("#subt_friss").show();
  $("#95547977665655b4ed87ca6055466913").show();
  $("#subt_accidente").show();
  $("#31053789365655b4ed53799071011166").show();
  //$("#subt_ve_afectados").show();
  //$("#93254149565655b4ed46a66057215729").show();
  $("#isubt_pe_afectados").show();
  $("#43602034065655b4ed6ca46084965014").show();
  $("#iisubt_pr_afectados").show();
  $("#46533585865655b4ed84dd4018270742").show();
  $("#81475448765655b4ed746c3049785877").show();


}

ocultar_todo();
mostrar_solicitud();

$("#73746264365655b4ed88c49053084293").setOnSubmit(function(){
    if ($("#frm_accion").getValue() == 'MANTENER') {
        return true;
    }
    var aRc = $("#grd_valores_siniestros_alcance").getNumberRows();
    for (var i=0; i <= aRc; i++) {
        let aprobacion = $("#grd_valores_siniestros_alcance").getValue(i, 7);
        if (aprobacion == null || aprobacion == "") {
                alert("Por favor, revise la disponibilidad de todos los productos");
                return false;
        }
    }
    return true;
  }
);