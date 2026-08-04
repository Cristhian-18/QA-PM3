$("#frm_documentos_check").disableValidation();
$('#fle_matricula').disableValidation();
$('#fle_cedula').disableValidation();
$('#fle_licencia').disableValidation();
$('#fle_denuncia').disableValidation();
$('#fle_partePolicial').disableValidation();

let rows = $(".pmdynaform-grid-row",'#grd_valores_siniestros');
let length = rows.length-1;
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

      //$("#grd_valores_siniestros").setValue("Aprobado", i, 9);
      //$("#grd_valores_siniestros").getControl(i, 9).attr('disabled', true);
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
  $('#35780238365657eea88efe2041775866').hide();
  $('#99373678665657eea884bd9020840251').hide();
  $('#frm_alcance_adicional').hide();
  $('#frm_alcance_adicional').disableValidation();
  $("#97590038765657eea8c5027052291288").hide();
  $("#34758459565657eea8976f9050430735").hide();

  if (newVal == "SOLICITAR") {
    $('#frm_comentario_aux').show();
    $('#frm_comentario_aux').enableValidation();
    if(taller == "MUNDO MOTRIZ" || tipo_taller == "TALLER AUTORIZADO MULTIMARCA"){
      if(pest == 'repuestos'){
        $('#35780238365657eea88efe2041775866').show();
        }
      }
    
    if(taller == "MUNDO MOTRIZ"){
      $('#frm_alcanceAdicional_valorRepuestos').getControl().attr('disabled', true);
    } else if(tipo_taller == "TALLER AUTORIZADO MULTIMARCA") {
      $('#frm_alcanceAdicional_valorRepuestos').getControl().attr('disabled', true);
    } 
    else{
      $('#frm_alcanceAdicional_valorRepuestos').getControl().attr('disabled', false);
    }
    $('#99373678665657eea884bd9020840251').show();
    $('#frm_alcance_adicional').show();
    $('#frm_alcance_adicional').enableValidation();

  }
  if (newVal == "REGISTRAR") {
    $('#frm_comentario').show();
    $('#frm_comentario').enableValidation();
    $('#frm_comentario').setValue("");
  }
  if (newVal == "CONTINUAR") {
    $('#frm_comentario_aux').show();
    $('#frm_comentario_aux').enableValidation();
    $("#97590038765657eea8c5027052291288").show();
    $("#34758459565657eea8976f9050430735").show();
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
      $("#23271031065657eea890261027484884").show();
      break;
    case 'historial':
      $("#sbt_historial").show();
      $("#38388078065657eea86f554052132558").show();
      break;
    case 'repuestos':
      if(taller == "MUNDO MOTRIZ" || tipo_taller == "TALLER AUTORIZADO MULTIMARCA"){
      $("#sub_repuestos").show();
      $("#83349221365657eea8935c0034368501").show();
      }
      $("#sub_valores_aprobados").show();
      $("#66500223665657eea88bf88096551186").show();
      if ($("#frm_accion").getValue() == "SOLICITAR") {
        $('#35780238365657eea88efe2041775866').show();    
      }
      checkRepuestos();
      break;
  }
});


function ocultar_todo() {
  $("#btn_anadir").hide();
  $("#38963767765657eea87aa86094721410").hide();
  $("#subt_friss").hide();
  $("#37834123465657eea8c1164099238212").hide();
  $("#47781112665657eea8b0668042786066").hide();
  $("#subt_tallerAsignado").hide();
  $("#subt_ppolicial").hide();
  $("#15894986365657eea8bd0f2052191535").hide();
  $("#subt_accesoriosRegistrados").hide();
  $("#38598074265657eea8b6072000128001").hide();
  $("#subt_accidente").hide();
  $("#33751146965657eea8867b4097970847").hide();
  $("#23654578165657eea8a1875054303713").hide();
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
  $("#subt_ve_afectados").hide();
  $("#15565307165657eea877078043143405").hide();
  $("#isubt_pe_afectados").hide();
  $("#72757335765657eea8a3ea5068757906").hide();
  $("#iisubt_pr_afectados").hide();
  $("#80125453265657eea8be050001169192").hide();
  $("#sub_docs").hide();
  $("#42369092065657eea875f65039015911").hide();
  $("#sub_valores").hide();
  $("#81367868865657eea8ba0a9094814227").hide();
  $("#subt_docs").hide();
  $("#23271031065657eea890261027484884").hide();
  $("#sbt_historial").hide();
  $("#38388078065657eea86f554052132558").hide();
  $("#subt_poliza").hide();
  $("#85517892965657eea863bb6085915178").hide();
  $("#sub_repuestos").hide();
  $("#83349221365657eea8935c0034368501").hide();
  $("#subt_hsiniestros").hide();
  $("#70029930365657eea866da2082229749").hide();
  $("#sub_valores_aprobados").hide();
  $("#66500223665657eea88bf88096551186").hide();
  $("#97590038765657eea8c5027052291288").hide();
  $("#34758459565657eea8976f9050430735").hide();
  $("#35780238365657eea88efe2041775866").hide();
  
}
function mostrar_solicitud() {

  $("#subt_friss").show();
  $("#37834123465657eea8c1164099238212").show();
  $("#47781112665657eea8b0668042786066").show();
  $("#subt_tallerAsignado").show();
  $("#subt_ppolicial").show();
  $("#15894986365657eea8bd0f2052191535").show();
  $("#subt_accesoriosRegistrados").show();
  $("#38598074265657eea8b6072000128001").show();
  $("#subt_accidente").show();
  $("#33751146965657eea8867b4097970847").show();

  $("#sub_busqueda").show();
  $("#52345823565657eea89f273081823396").show();
  $("#subt_vehiculo").show();
  $("#39942008765657eea8c60e4037826925").show();
  $("#subt_asegurado").show();
  $("#77577551765657eea869184079116697").show();
  $("#subt_detalle").show();
  $("#40264027065657eea8a90a6057516237").show();
  $("#subt_registro").show();
  $("#41246456365657eea871e92041543660").show();
  $("#subt_ve_afectados").show();
  $("#15565307165657eea877078043143405").show();
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
  $("#subt_historial_siniestro").show();
  $("#70029930365657eea866da2082229749").show();

}



ocultar_todo();
mostrar_solicitud();