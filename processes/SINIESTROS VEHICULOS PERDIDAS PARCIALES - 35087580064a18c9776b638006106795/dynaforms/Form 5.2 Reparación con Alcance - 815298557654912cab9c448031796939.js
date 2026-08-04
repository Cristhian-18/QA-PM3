console.log('repuestos');
$("#frm_documentos_check").disableValidation();
$('#fle_matricula').disableValidation();
$('#fle_cedula').disableValidation();
$('#fle_licencia').disableValidation();
$('#fle_denuncia').disableValidation();
$('#fle_partePolicial').disableValidation();

let rows = $(".pmdynaform-grid-row",'#grd_valores_siniestros');
let length = rows.length-1;
let bandera_completada  = $('#tri_bandera_compra_completada').getValue();
console.log(bandera_completada);

for(let i = 0; i <= length; i++){
    if(($("#grd_valores_siniestros").getValue(i+1, 11))!="Aprobado"){
      $(rows[i]).hide();
       console.log(rows[i]);
    } 
}

let bandera_compra = $('#tri_bandera_compra_completada').getValue();
let mano_de_obra = $('#frm_valoresAprobados_manoObraProformada').getValue();
let mano_de_obra_proformada = $('#frm_valoresSiniestro_manoObraProformada').getValue();
console.log("MANO2");

console.log(mano_de_obra_proformada);
if(mano_de_obra == null || mano_de_obra == '' ){
  console.log("MANO");
	$('#frm_valoresAprobados_manoObraProformada').setValue(mano_de_obra_proformada);
}
console.log($('#frm_valoresAprobados_manoObraProformada').getValue());

let pest = '';
let taller = $("#frm_taller").getValue();
let tipo_taller = $("#frm_taller_tipo").getValue();


function checkRepuestos(){
  let numberRows = $("#grd_valores_siniestros").getNumberRows();
  console.log(numberRows);
  let valorSuma = 0;
  
  for (let i = 1; i <= numberRows; i++) {
    if(bandera_completada == "1"){
      $("#grd_valores_siniestros").getControl(i, 9).attr('disabled', true);
    }
      valorSuma = valorSuma +  parseInt($("#grd_valores_siniestros").getValue(i, 4));
      if(bandera_compra == "1"){
        $("#grd_valores_siniestros").getControl(i, 7).attr('disabled', true);
      }
  }
  if(valorSuma==0){
  
  } else {
   
  }
}


let rowsNum = $("#grd_valores_siniestros").getNumberRows();

for (let i = 1; i <= rowsNum; i++) {
  let recibido = $("#grd_valores_siniestros").getValue(i, 9);
  console.log(recibido);
  if (recibido == "SI") {
    $("#grd_valores_siniestros").getControl(i, 9).attr('disabled', true);
  }
  for (let j = 1; j <= 11; j++) {
    if (j != 10 && j != 9) {
      $("#grd_valores_siniestros").getControl(i, j).attr('disabled', true);
    }
  }
}


function action(newVal, oldVal) {
  $('#frm_comentario_aux').hide();
  $('#frm_comentario_aux').disableValidation();
  $('#frm_comentario').hide();
  $('#frm_comentario').disableValidation();
  $('#frm_comentario').getControl().attr('disabled', false);
  $('#4005122106562eeba2b7905017718451').hide();
  $('#34070655965490e3b7ef1a6078991211').hide();
  $('#frm_alcance_adicional').hide();
  $('#frm_alcance_adicional').disableValidation();
  $("#9392191066554eaa66da190035332083").hide();
  $("#5092940376554f7a061c981008683967").hide();
    $('#frm_alcanceAdicional_valorMano').disableValidation();
    $("#frm_reparacion_fotos").hide();

  if (newVal == "SOLICITAR") {
        $('#frm_alcanceAdicional_valorMano').enableValidation();

    $('#frm_comentario_aux').show();
    $('#frm_comentario_aux').enableValidation();
    if(taller.includes("MUNDO MOTRIZ") || tipo_taller == "TALLER AUTORIZADO MULTIMARCA"){
      if(pest == 'repuestos'){
        $('#4005122106562eeba2b7905017718451').show();
        }
      }
    
    if(taller.includes("MUNDO MOTRIZ")){
      $('#frm_alcanceAdicional_valorRepuestos').getControl().attr('disabled', true);
    } else if(tipo_taller == "TALLER AUTORIZADO MULTIMARCA") {
      $('#frm_alcanceAdicional_valorRepuestos').getControl().attr('disabled', true);
    } 
    else{
      $('#frm_alcanceAdicional_valorRepuestos').getControl().attr('disabled', false);
    }
    $('#34070655965490e3b7ef1a6078991211').show();
    $('#frm_alcance_adicional').show();
    $('#frm_alcance_adicional').enableValidation();

  }
  if (newVal == "REGISTRAR") {
    $('#frm_comentario').show();
    $('#frm_comentario').enableValidation();
    $('#frm_comentario').setValue("");
        $("#frm_reparacion_fotos").show();

  }
  if (newVal == "CONTINUAR") {
    $('#frm_comentario_aux').show();
    $('#frm_comentario_aux').enableValidation();
    $("#9392191066554eaa66da190035332083").show();
    $("#5092940376554f7a061c981008683967").show();
  }
  if (newVal == "REPUESTOSP") {
    $('#frm_comentario_aux').show();
    $('#frm_comentario_aux').enableValidation();
  }
  if (newVal == "REPUESTOS") {
    $('#frm_comentario_aux').show();
    $('#frm_comentario_aux').enableValidation();
  }
  if (newVal == "DISCREPANCIA") {
    $('#frm_comentario_aux').show();
    $('#frm_comentario_aux').enableValidation();
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
      $("#418835952652a78d09ec638009652152").show();
      break;
    case 'historial':
      $("#sbt_historial").show();
      $("#200528691652a78b49077a9030935355").show();
      break;
    case 'repuestos':
      if(taller.includes("MUNDO MOTRIZ") || tipo_taller == "TALLER AUTORIZADO MULTIMARCA"){
      $("#sub_repuestos").show();
      $("#470410481653944a172eeb1027144131").show();
      }
      $("#470410481653944a172eeb1027144131").show();
      $("#sub_valores_aprobados").show();
      $("#38051173965398bc04c3a10085381199").show();
      if ($("#frm_accion").getValue() == "SOLICITAR") {
        $('#4005122106562eeba2b7905017718451').show();    
      }
      $("#sub_alcances").show();
  $("#656162179655cbbd1dcb9d9041597272").show();
      checkRepuestos();
      break;
  }
});


function ocultar_todo() {
  $("#btn_anadir").hide();
  $("#267077245653c2f21671c39092873297").hide();
  $("#subt_friss").hide();
  $("#88678649164f7eaea023df2027918886").hide();
  $("#711981759653951b01d9fc7055662056").hide();
  $("#subt_tallerAsignado").hide();
  $("#subt_ppolicial").hide();
  $("#82315095164a5ea0d445d33098806451").hide();
  $("#subt_accesoriosRegistrados").hide();
  $("#757211058653970103ff5d0031705379").hide();
  $("#subt_accidente").hide();
  $("#342283484650ba7c9f2fd13056558401").hide();
  $("#585018357653c2950773cf3076340308").hide();
  $("#sub_busqueda").hide();
  $("#56711039964a8241d124701020566530").hide();
  $("#subt_vehiculo").hide();
  $("#95746246564a4a9c711dfb2023501124").hide();
  $("#subt_asegurado").hide();
  $("#15180521364a5eaf5f02815065887190").hide();
  $("#subt_detalle").hide();
  $("#61446768964a848b295ae19072670821").hide();
  $("#subt_registro").hide();
  $("#22536303964a5e5cc12a673090504456").hide();
  $("#subt_ve_afectados").hide();
  $("#24440509064a84d82d7a6e4090951046").hide();
  $("#isubt_pe_afectados").hide();
  $("#59581944164a84e6bc66f02025995827").hide();
  $("#iisubt_pr_afectados").hide();
  $("#83626962464a84f217fbb30019736581").hide();
  $("#sub_docs").hide();
  $("#24155013164a5edc37a3b68095174528").hide();
  $("#sub_valores").hide();
  $("#79905380564f7ece7bc8989091267394").hide();
  $("#subt_docs").hide();
  $("#418835952652a78d09ec638009652152").hide();
  $("#sbt_historial").hide();
  $("#200528691652a78b49077a9030935355").hide();
  $("#subt_poliza").hide();
  $("#12366487464a4a855bed4c8081629548").hide();
  $("#sub_repuestos").hide();
  $("#470410481653944a172eeb1027144131").hide();
  $("#subt_hsiniestros").hide();
  $("#14870785564a5e392d24239097281950").hide();
  $("#sub_valores_aprobados").hide();
  $("#38051173965398bc04c3a10085381199").hide();
  $("#9392191066554eaa66da190035332083").hide();
  $("#5092940376554f7a061c981008683967").hide();
  $("#4005122106562eeba2b7905017718451").hide();

  $("#sub_alcances").hide();
  $("#656162179655cbbd1dcb9d9041597272").hide();
  
  
}
function mostrar_solicitud() {

  $("#subt_friss").show();
  $("#88678649164f7eaea023df2027918886").show();
  $("#711981759653951b01d9fc7055662056").show();
  $("#subt_tallerAsignado").show();
  $("#subt_ppolicial").show();
  $("#82315095164a5ea0d445d33098806451").show();
  $("#subt_accesoriosRegistrados").show();
  $("#757211058653970103ff5d0031705379").show();
  $("#subt_accidente").show();
  $("#342283484650ba7c9f2fd13056558401").show();

  $("#sub_busqueda").show();
  $("#56711039964a8241d124701020566530").show();
  $("#subt_vehiculo").show();
  $("#95746246564a4a9c711dfb2023501124").show();
  $("#subt_asegurado").show();
  $("#15180521364a5eaf5f02815065887190").show();
  $("#subt_detalle").show();
  $("#61446768964a848b295ae19072670821").show();
  $("#subt_registro").show();
  $("#22536303964a5e5cc12a673090504456").show();
  $("#subt_ve_afectados").show();
  $("#24440509064a84d82d7a6e4090951046").show();
  $("#isubt_pe_afectados").show();
  $("#59581944164a84e6bc66f02025995827").show();
  $("#iisubt_pr_afectados").show();
  $("#83626962464a84f217fbb30019736581").show();
  $("#sub_docs").show();
  $("#24155013164a5edc37a3b68095174528").show();
  $("#sub_valores").show();
  $("#79905380564f7ece7bc8989091267394").show();
  $("#subt_poliza").show();
  $("#12366487464a4a855bed4c8081629548").show();
  $("#subt_historial_siniestro").show();
  $("#14870785564a5e392d24239097281950").show();

}



ocultar_todo();
mostrar_solicitud();

$("#815298557654912cab9c448031796939").setOnSubmit(function(){
  var aRc = $("#grd_valores_siniestros").getNumberRows();
  if($("#frm_accion").getValue() == "REPUESTOS"){
  for (var i=0; i <= aRc; i++) {
      if ($("#grd_valores_siniestros").getValue(i, 11) == "Aprobado" 
      && $("#grd_valores_siniestros").getValue(i, 1) != "" 
      && $("#grd_valores_siniestros").getValue(i, 2) != ""
      && $("#grd_valores_siniestros").getValue(i, 3) != "") {
          if($("#grd_valores_siniestros").getValue(i, 9) != "SI"){
              alert("No todos los repuestos han sido confirmados");
              return false;
          }
      }
  }}
  return true;
} );

