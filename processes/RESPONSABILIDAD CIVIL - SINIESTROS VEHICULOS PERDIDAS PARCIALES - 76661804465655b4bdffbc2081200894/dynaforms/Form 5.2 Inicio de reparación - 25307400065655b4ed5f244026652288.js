console.log('inicio de reparacion');

$("#frm_documentos_check").disableValidation();
$('#fle_matricula').disableValidation();
$('#fle_cedula').disableValidation();
$('#fle_licencia').disableValidation();
$('#fle_denuncia').disableValidation();
$('#fle_partePolicial').disableValidation();

//nuevos
$('#frm_deducible_ProcentajeSiniestro').disableValidation();
$('#frm_deducible_ValorMinimo').disableValidation();

let rows = $(".pmdynaform-grid-row", '#grd_valores_siniestros');
let length = rows.length - 1;
let bandera_completada = $('#tri_bandera_compra_completada').getValue();
console.log(bandera_completada);

for (let i = 0; i <= length; i++) {
  if (($("#grd_valores_siniestros").getValue(i + 1, 11)) != "Aprobado") {
    $(rows[i]).hide();
    console.log(rows[i]);
  }
}

let bandera_compra = $('#tri_bandera_compra_completada').getValue();
let mano_de_obra = $('#frm_valoresAprobados_manoObraProformada').getValue();
let mano_de_obra_proformada = $('#frm_valoresSiniestro_manoObraProformada').getValue();
console.log("MANO2");

console.log(mano_de_obra_proformada);
if (mano_de_obra == null || mano_de_obra == '') {
  console.log("MANO");
  $('#frm_valoresAprobados_manoObraProformada').setValue(mano_de_obra_proformada);
}
console.log($('#frm_valoresAprobados_manoObraProformada').getValue());

let pest = '';
let taller = $("#frm_taller").getValue();
let tipo_taller = $("#frm_taller_tipo").getValue();


function checkRepuestos() {
  let numberRows = $("#grd_valores_siniestros").getNumberRows();
  console.log(numberRows);
  let valorSuma = 0;

  for (let i = 1; i <= numberRows; i++) {

    //$("#grd_valores_siniestros").setValue("Aprobado", i, 9);
    //$("#grd_valores_siniestros").getControl(i, 9).attr('disabled', true);
    valorSuma = valorSuma + parseInt($("#grd_valores_siniestros").getValue(i, 4));
    if (bandera_compra == "1") {
      $("#grd_valores_siniestros").getControl(i, 7).attr('disabled', true);
    }
  }
  if (valorSuma == 0) {

  } else {

  }
}


let rowsNum = $("#grd_valores_siniestros").getNumberRows();

for (let i = 1; i <= rowsNum; i++) {
  if (bandera_completada == "1") {
    $("#grd_valores_siniestros").getControl(i, 9).attr('disabled', true);
  }
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
  $('#39079096965655b4ed5a357088976205').hide();
  $('#30054645565655b4ed52671075267205').hide();
  $('#frm_alcance_adicional').hide();
  $('#frm_alcance_adicional').disableValidation();
  $("#49472546965655b4ed8baa6093274134").hide();
  $("#57144853765655b4ed62006023146023").hide();
  $('#frm_alcanceAdicional_valorMano').disableValidation();

  if (newVal == "SOLICITAR") {
    $('#frm_alcanceAdicional_valorMano').enableValidation();

    $('#frm_comentario_aux').show();
    $('#frm_comentario_aux').enableValidation();
    if (taller == "MUNDO MOTRIZ" || tipo_taller == "TALLER AUTORIZADO MULTIMARCA") {
      if (pest == 'repuestos') {
        $('#39079096965655b4ed5a357088976205').show();
      }
    }

    if (taller == "MUNDO MOTRIZ") {
      $('#frm_alcanceAdicional_valorRepuestos').getControl().attr('disabled', true);
    } else if (tipo_taller == "TALLER AUTORIZADO MULTIMARCA") {
      $('#frm_alcanceAdicional_valorRepuestos').getControl().attr('disabled', true);
    }
    else {
      $('#frm_alcanceAdicional_valorRepuestos').getControl().attr('disabled', false);
    }
    $('#30054645565655b4ed52671075267205').show();
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
    $("#49472546965655b4ed8baa6093274134").show();
    $("#57144853765655b4ed62006023146023").show();
  }
  if (newVal == "REPUESTOS") {
    $('#frm_comentario_aux').show();
    $('#frm_comentario_aux').enableValidation();
  }
  if (newVal == "REPUESTOSP") {
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
      $("#75921207865655b4ed5b3c1053457518").show();
      break;
    case 'historial':
      $("#sbt_historial").show();
      $("#79094655365655b4ed40d17058683087").show();
      break;
    case 'repuestos':
      if (taller == "MUNDO MOTRIZ" || tipo_taller == "TALLER AUTORIZADO MULTIMARCA") {


        $("#57719423965655b4ed5e193039723079").show();
      }
      $("#sub_repuestos").show();
      $("#57719423965655b4ed5e193039723079").show();

      $("#sub_valores_aprobados").show();
      $("#13230486865655b4ed57598003315291").show();
      if ($("#frm_accion").getValue() == "SOLICITAR") {
        $('#39079096965655b4ed5a357088976205').show();
      }
      checkRepuestos();
      break;
  }
});


function ocultar_todo() {
  $("#btn_anadir").hide();
  $("#17206049365655b4ed499f4054369527").hide();
  $("#subt_friss").hide();
  $("#95547977665655b4ed87ca6055466913").hide();
  $("#43198352265655b4ed78569007990565").hide();
  $("#subt_tallerAsignado").hide();
  $("#subt_ppolicial").hide();
  $("#57796621765655b4ed83ea3082357963").hide();
  $("#subt_accesoriosRegistrados").hide();
  $("#43015877965655b4ed7d2a1016407207").hide();
  $("#subt_accidente").hide();
  $("#31053789365655b4ed53799071011166").hide();
  $("#33327433165655b4ed6abd1080464820").hide();
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
  $("#subt_ve_afectados").hide();
  $("#93254149565655b4ed46a66057215729").hide();
  $("#isubt_pe_afectados").hide();
  $("#43602034065655b4ed6ca46084965014").hide();
  $("#iisubt_pr_afectados").hide();
  $("#46533585865655b4ed84dd4018270742").hide();
  $("#sub_docs").hide();
  $("#98325375965655b4ed45b13092827388").hide();
  $("#sub_valores").hide();
  $("#51718349165655b4ed81039097317111").hide();
  $("#subt_docs").hide();
  $("#75921207865655b4ed5b3c1053457518").hide();
  $("#sbt_historial").hide();
  $("#79094655365655b4ed40d17058683087").hide();
  $("#subt_poliza").hide();
  $("#28358068365655b4ed35473079795674").hide();
  $("#sub_repuestos").hide();
  $("#57719423965655b4ed5e193039723079").hide();
  $("#subt_hsiniestros").hide();
  $("#47330327665655b4ed38dc0072757607").hide();
  $("#sub_valores_aprobados").hide();
  $("#13230486865655b4ed57598003315291").hide();
  //$("#49472546965655b4ed8baa6093274134").hide();
  $("#57144853765655b4ed62006023146023").hide();
  $("#39079096965655b4ed5a357088976205").hide();

}
function mostrar_solicitud() {

  $("#subt_friss").show();
  $("#95547977665655b4ed87ca6055466913").show();
  $("#43198352265655b4ed78569007990565").show();
  $("#subt_tallerAsignado").show();
  $("#subt_ppolicial").show();
  $("#57796621765655b4ed83ea3082357963").show();
  $("#subt_accesoriosRegistrados").show();
  $("#43015877965655b4ed7d2a1016407207").show();
  $("#subt_accidente").show();
  $("#31053789365655b4ed53799071011166").show();

  $("#sub_busqueda").show();
  $("#60259283965655b4ed68cb6009778512").show();
  $("#subt_vehiculo").show();
  $("#17569986565655b4ed8c995023188336").show();
  $("#subt_asegurado").show();
  $("#76241453365655b4ed3ad27050479402").show();
  $("#subt_detalle").show();
  $("#41209453665655b4ed71780023900709").show();
  $("#subt_registro").show();
  $("#44056937965655b4ed42c04054669455").show();
  $("#subt_ve_afectados").show();
  $("#93254149565655b4ed46a66057215729").show();
  $("#isubt_pe_afectados").show();
  $("#43602034065655b4ed6ca46084965014").show();
  $("#iisubt_pr_afectados").show();
  $("#46533585865655b4ed84dd4018270742").show();
  $("#sub_docs").show();
  $("#98325375965655b4ed45b13092827388").show();
  $("#sub_valores").show();
  $("#51718349165655b4ed81039097317111").show();
  $("#subt_poliza").show();
  $("#28358068365655b4ed35473079795674").show();
  $("#subt_historial_siniestro").show();
  $("#47330327665655b4ed38dc0072757607").show();

}

ocultar_todo();
mostrar_solicitud();



$("#25307400065655b4ed5f244026652288").setOnSubmit(function () {
  var aRc = $("#grd_valores_siniestros").getNumberRows();
  if ($("#frm_accion").getValue() == "REPUESTOS") {
    for (var i = 0; i <= aRc; i++) {
      if ($("#grd_valores_siniestros").getValue(i, 11) == "Aprobado") {
        if ($("#grd_valores_siniestros").getValue(i, 9) != "SI") {
          alert("No todos los repuestos han sido confirmados");
          return false;
        }
      }
    }
  }
  return true;
});


