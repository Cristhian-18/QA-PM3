function action(newVal, oldVal) {
  $("#80780172465579f030c7799056227712").hide();  
  let tipo = $("#frm_informacion_tipo").getValue();
  if(newVal == 'CERRAR'){
    $("#80780172465579f030c7799056227712").show();  
    $("#frm_cierre_comprobantePago").hide();
    $("#frm_cierre_actaFiscalia").hide();
    $("#frm_cierre_cierreFiscalia").hide();
    if(tipo == 'SUBROGACIÓN'){
      $("#frm_cierre_comprobantePago").show();
    } else {
      $("#frm_cierre_actaFiscalia").show();
      $("#frm_cierre_cierreFiscalia").show();
    }
  }
}

action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);
$('.menu').on('click', function () {
  pest = this.id;
  ocultar_todo();
  console.log(this.id)
  console.log("CAMBIO")
  switch (this.id) {
    case 'solicitud':
      mostrar_solicitud();
      action($("#frm_accion").getValue(), '');
      break;
    case 'documentos':
      $("#subt_docs").show();
      $("#164219982655447c9733796008417810").show();
      break;
    case 'historial':
      $("#sbt_historial").show();
      $("#9579607476554479a9a40c3062705647").show();
      break;
    case 'informacion':
      $("#sub_inf").show();
      $("#8772638676554496d6f8428069996411").show();
      break;
  }

});


function ocultar_todo() {
  $("#sub_friss").hide();
  $("#276991790654e5db64db976015608181").hide();
  $("#sub_busqueda").hide();
  $("#210046437654e5dda2471b8060121807").hide();
  $("#subt_poliza").hide();
  $("#712682644654e5e1b762a32057232411").hide();
  $("#sub_accesorios").hide();
  $("#47854012665568139bb0451001865945").hide();
  $("#subt_vehiculo").hide();
  $("#975172180654e5e4cdcea97042363185").hide();
  $("#sub_taller_asign").hide();
  $("#7556819866556e6d7e0ed03014600235").hide();
  $("#subt_hsiniestros").hide();
  $("#504620397654e5e8bd06c38001384835").hide();
  $("#subt_asegurado").hide();
  $("#578719942654e5ed5144508033935400").hide();
  $("#subt_accidente").hide();
  $("#134085550654e5efe0a0bb4059785346").hide();
  $("#subt_ppolicial").hide();
  $("#595992730654e5eba660bc4059005720").hide();

  $("#subt_ve_afectados").hide();
  $("#925223586654e5f134f8d66048355477").hide();
  $("#isubt_pe_afectados").hide();
  $("#140487401654e6097d7c7c9075610530").hide();
  $("#iisubt_pr_afectados").hide();
  $("#583353528654e60af727c44072609866").hide();
  $("#subt_registro").hide();
  $("#5778108566556e727dab9e9020834769").hide();
  $("#subt_analisis_coberturas").hide();
  $("#3167242526556e74a77b816087056308").hide();
  
  $("#sub_docs").hide();
  $("#573968372654e60c8554bd0031157549").hide();
  $("#sub_inf").hide();
  $("#8772638676554496d6f8428069996411").hide();
  $("#subt_docs").hide();
  $("#164219982655447c9733796008417810").hide();
  $("#sbt_historial").hide();
  $("#9579607476554479a9a40c3062705647").hide();
  $("#subt_ve_afectados").hide();
  $("#925223586654e5f134f8d66048355477").hide();
  $("#isubt_pe_afectados").hide();
  $("#140487401654e6097d7c7c9075610530").hide();
  $("#iisubt_pr_afectados").hide();
  $("#583353528654e60af727c44072609866").hide();

}
function mostrar_solicitud() {
  let vehiculos = $("#frm_siniestro_OtrosVehiculos").getValue();
  let propiedades = $("#frm_siniestro_Propiedad").getValue();
  let personas = $("#frm_siniestro_Personas").getValue();
    $("#sub_friss").show();
    $("#276991790654e5db64db976015608181").show();
    $("#sub_busqueda").show();
    $("#210046437654e5dda2471b8060121807").show();
    $("#subt_poliza").show();
    $("#712682644654e5e1b762a32057232411").show();
    $("#sub_accesorios").show();
    $("#47854012665568139bb0451001865945").show();
    $("#subt_vehiculo").show();
    $("#975172180654e5e4cdcea97042363185").show();
    $("#sub_taller_asign").show();
    $("#7556819866556e6d7e0ed03014600235").show();
    $("#subt_hsiniestros").show();
    $("#504620397654e5e8bd06c38001384835").show();
    $("#subt_asegurado").show();
    $("#578719942654e5ed5144508033935400").show();
    $("#subt_accidente").show();
    $("#134085550654e5efe0a0bb4059785346").show();
    $("#subt_ppolicial").show();
    $("#595992730654e5eba660bc4059005720").show();
  $("#subt_ve_afectados").show();
  $("#925223586654e5f134f8d66048355477").show();
  $("#isubt_pe_afectados").show();
  $("#140487401654e6097d7c7c9075610530").show();
  $("#iisubt_pr_afectados").show();
  $("#583353528654e60af727c44072609866").show();
  $("#subt_registro").show();
  $("#5778108566556e727dab9e9020834769").show();
  $("#subt_analisis_coberturas").show();
  $("#3167242526556e74a77b816087056308").show();
  
  $("#sub_docs").show();
  $("#573968372654e60c8554bd0031157549").show();
  if (vehiculos == 'SI') {
      $("#subt_ve_afectados").show();
    $("#925223586654e5f134f8d66048355477").show();
  }
  if (propiedades == 'SI') {
      $("#iisubt_pr_afectados").show();
      $("#583353528654e60af727c44072609866").show();
  }
  if (personas == 'SI') {
      $("#isubt_pe_afectados").show();
      $("#140487401654e6097d7c7c9075610530").show();
  }

}


$("#subt_ve_afectados").hide();
$("#925223586654e5f134f8d66048355477").hide();
$("#isubt_pe_afectados").hide();
$("#140487401654e6097d7c7c9075610530").hide();
$("#iisubt_pr_afectados").hide();
$("#583353528654e60af727c44072609866").hide();

ocultar_todo();
$("#sub_inf").show();
$("#8772638676554496d6f8428069996411").show();
$('#informacion').click();
