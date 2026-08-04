$('.menu').on('click', function () {
  pest = this.id;
  ocultar_todo();
  console.log(this.id)
  console.log("CAMBIO")
  switch (this.id) {
    case 'solicitud':
      mostrar_solicitud();
      break;
    case 'documentos':
      $("#subt_docs").show();
      $("#89682335465afe6f344a372005028595").show();
      break;
    case 'historial':
      $("#sbt_historial").show();
      $("#24402141165afe6f3464602000676261").show();
      break;
    case 'informacion':
      $("#sub_inf").show();
      $("#39099956865afe6f34626a7042279865").show();
      break;
  }

});


function ocultar_todo() {
  $("#sub_friss").hide();
  $("#76977141365afe6f344c508090278808").hide();
  $("#sub_busqueda").hide();
  $("#99540153965afe6f344b488063484252").hide();
  $("#subt_poliza").hide();
  $("#91396116065afe6f345c669041463905").hide();
  $("#sub_accesorios").hide();
  $("#15773507265afe6f3451579006226306").hide();
  $("#subt_vehiculo").hide();
  $("#42092666565afe6f34655b0047486880").hide();
  $("#sub_taller_asign").hide();
  $("#28071553965afe6f345d623046014981").hide();
  $("#subt_hsiniestros").hide();
  $("#32334568465afe6f3453660023452185").hide();
  $("#subt_asegurado").hide();
  $("#50031253165afe6f3459661061467171").hide();
  $("#subt_accidente").hide();
  $("#70433990065afe6f34479e4033736953").hide();
  $("#subt_ppolicial").hide();
  $("#88721209965afe6f345b6a4073649834").hide();

  $("#subt_ve_afectados").hide();
  $("#46549814765afe6f3463654003004790").hide();
  $("#isubt_pe_afectados").hide();
  $("#85235204665afe6f34492e1063839270").hide();
  $("#iisubt_pr_afectados").hide();
  $("#19095217365afe6f345a6d3020147591").hide();
  $("#subt_registro").hide();
  $("#74653330465afe6f34586a1085412115").hide();
  $("#subt_analisis_coberturas").hide();
  $("#97084544065afe6f344d4e0036575681").hide();
  
  $("#sub_docs").hide();
  $("#35981980465afe6f34576c8043867250").hide();
  $("#sub_inf").hide();
  $("#39099956865afe6f34626a7042279865").hide();
  $("#subt_docs").hide();
  $("#89682335465afe6f344a372005028595").hide();
  $("#sbt_historial").hide();
  $("#24402141165afe6f3464602000676261").hide();

  

}
function mostrar_solicitud() {

    $("#sub_friss").show();
    $("#76977141365afe6f344c508090278808").show();
    $("#sub_busqueda").show();
    $("#99540153965afe6f344b488063484252").show();
    $("#subt_poliza").show();
    $("#91396116065afe6f345c669041463905").show();
    $("#sub_accesorios").show();
    $("#15773507265afe6f3451579006226306").show();
    $("#subt_vehiculo").show();
    $("#42092666565afe6f34655b0047486880").show();
    $("#sub_taller_asign").show();
    $("#28071553965afe6f345d623046014981").show();
    $("#subt_hsiniestros").show();
    $("#32334568465afe6f3453660023452185").show();
    $("#subt_asegurado").show();
    $("#50031253165afe6f3459661061467171").show();
    $("#subt_accidente").show();
    $("#70433990065afe6f34479e4033736953").show();
    $("#subt_ppolicial").show();
    $("#88721209965afe6f345b6a4073649834").show();

    
  $("#subt_ve_afectados").show();
  $("#46549814765afe6f3463654003004790").show();
  $("#isubt_pe_afectados").show();
  $("#85235204665afe6f34492e1063839270").show();
  $("#iisubt_pr_afectados").show();
  $("#19095217365afe6f345a6d3020147591").show();
  $("#subt_registro").show();
  $("#74653330465afe6f34586a1085412115").show();
  $("#subt_analisis_coberturas").show();
  $("#97084544065afe6f344d4e0036575681").show();
  
  $("#sub_docs").show();
  $("#35981980465afe6f34576c8043867250").show();
  

}



ocultar_todo();
mostrar_solicitud();

let vehiculos = $("#frm_siniestro_OtrosVehiculos").getValue();
let propiedades = $("#frm_siniestro_Propiedad").getValue();
let personas = $("#frm_siniestro_Personas").getValue();

$("#subt_ve_afectados").hide();
  $("#46549814765afe6f3463654003004790").hide();
  $("#isubt_pe_afectados").hide();
  $("#85235204665afe6f34492e1063839270").hide();
  $("#iisubt_pr_afectados").hide();
  $("#19095217365afe6f345a6d3020147591").hide();

if (vehiculos == 'SI') {
    $("#subt_ve_afectados").show();
  $("#46549814765afe6f3463654003004790").show();
}
if (propiedades == 'SI') {
    $("#iisubt_pr_afectados").show();
    $("#19095217365afe6f345a6d3020147591").show();
}
if (personas == 'SI') {
    $("#isubt_pe_afectados").show();
    $("#85235204665afe6f34492e1063839270").show();
}
