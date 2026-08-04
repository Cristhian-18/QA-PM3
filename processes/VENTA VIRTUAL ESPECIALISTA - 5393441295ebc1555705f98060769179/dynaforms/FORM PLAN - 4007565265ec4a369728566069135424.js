//$('#3832351495ec4a389dbc866046549095').toggle();
let bandera_exequial = $('#tri_bandera_exquial').getValue();
console.log("Bandera exequial: " + bandera_exequial);

let banderaContingente = false;



$('#8323199425ec549bca5cf96089834194').toggle();
$('#frm_aclaraciones_observacion').toggle();
$('#1898319455f1266b5a4a1d4059999865').toggle();
$('#8289982305ec5e457199fd7088050775').toggle();
$('#7455655435ec5e04de42eb2043075382').toggle();
$('#frm_banco_ccontable').hide();
$('#btn_copiar').hide();

$('#ajx_eqfx_pagador_tipo').hide();

$("#frm_recibio_deposito").setValue('N');
$("#frm_recibio_deposito").getControl().attr('disabled', true);

$("#frm_pago_terceros").change(function () {
  pago_terceros();
});

pago_terceros();

function pago_terceros() {
  var pago = $("#frm_pago_terceros").getControl().val();
  // alert(pago);
  if (pago == 'S') {
    $("#subtit_pagador").show();
    $("#frm_tipo_identificacion_pagador").enableValidation();
    $("#frm_cedula_pagador").enableValidation();
    $("#frm_nombre_pagador").enableValidation();
    $("#frm_apellidos_pagador").enableValidation();
    $("#frm_parentesco").enableValidation();
    $("#8639320456010cbab579823088697264").show();
  }
  else {
    $("#subtit_pagador").hide();
    $("#frm_tipo_identificacion_pagador").setValue('');
    $("#frm_cedula_pagador").setValue('');
    $("#frm_nombre_pagador").setValue('');
    $("#frm_apellidos_pagador").setValue('');
    $("#frm_parentesco").setValue('');

    $("#frm_tipo_identificacion_pagador").disableValidation();
    $("#frm_cedula_pagador").disableValidation();
    $("#frm_nombre_pagador").disableValidation();
    $("#frm_apellidos_pagador").disableValidation();
    $("#frm_parentesco").disableValidation();
    $("#8639320456010cbab579823088697264").hide();
  }
}


if ($('#frm_modificar_solicitud_label').getValue() == 'SI' || $('#tri_case_id_magnum').getValue() != '') {
  //$("#frm_motivo_seguro").getControl().attr('disabled', true);
}

$(document).ready(function () {
  try {

    //para corregir el bug q permitia pasar con vitality, aun cuando estaba indicado q NO
    if ($("#frm_aplica_vitality").getValue() == 'N' && $("#frm_misma_cuenta_vitality").getValue() == 'CTAVITALITY') {
      alert("Seleccionado que no usara una cuenta vitality, ingrese otra cuenta por favor");
      $("#frm_misma_cuenta_vitality").setValue('CTAOTRA');
    }
    seguroDental();
    //Variable para hacer aparecer las referencias
    var montoAseguradoBase = 200000;
    // validarGrilla(false, false);
    presentaReferencias();
    vitality();
    validarFamilia();
    validarIdentificacionBeneficiario();
    validarIdentificacionBeneficiarioContingente();
    validarDependientesGrilla();
    validarExequialGrilla();
    validarMedicosGrilla();

    //Al cargar ya debe estar deshabilitado los campos de VITALITY
    if ($("#frm_misma_cuenta_vitality option:selected").val() == 'CTAVITALITY') {
      $("#frm_devolucion_banco").getControl().attr('disabled', true);
      $("#frm_devolucion_tipo_cuenta").getControl().attr('disabled', true);
      $("#frm_devolucion_numero_cuenta").getControl().attr('disabled', true);
      $("#frm_devolucion_tipo_identificacion").getControl().attr('disabled', true);
      $("#frm_devolucion_titular").getControl().attr('disabled', true);
      $("#frm_devolucion_titular_apellidos").getControl().attr('disabled', true);
      $("#frm_devolucion_identificacion").getControl().attr('disabled', true);
    }

    var tarea = $("#TASK").getControl().val();
    if (tarea == '9938028895f0f3574ab7db1043599014') {
      $("#1898319455f1266b5a4a1d4059999865").find(".form-control").prop("disabled", true);
    }
  }

  catch (err) {

  }

});

$("#btn_plan_submit").children().addClass("btn-default");
$("#btn_plan_submit").find("button").on("click", function () {
$("#4007565265ec4a369728566069135424").showFormModal();
  calcula_dental();
  calcula_exequial();
  $("#4007565265ec4a369728566069135424").saveForm();
  // var avanzar=true;

  //if($("#grid_beneficiarios_contingentes").getNumberRows()>0){
  //	  if($("#frm_plan_total_beneficiarios_contingentes").getValue()!=100){
  //avanzar=false;
  //  }
  // }
  //if(avanzar){

  // return showConfirmDlg();
  ////////////
  var bandera = true;
  var c = '';
  var count = 0;
  var noCumplioValidacion;
  var noCumplioValidacionProcess;
  var stringHtml = "";

  $("div.pmdynaform-edit-text, div.pmdynaform-edit-dropdown, div.pmdynaform-edit-datetime, pmdynaform-edit-dropdown").each(function (index) {

    // Ignorar campos ocultos
    if($(this).is(":hidden")) return;

    var control = $(this).getControl();

    // Ignorar campos de grillas o sin control
    if(!control || control.toString() == "") return;

    if (typeof $(this).find(".pmdynaform-message-error").html() !== 'undefined') {
      noCumplioValidacionProcess = true;
    } else {
      noCumplioValidacionProcess = false;
    }

    var styleAttr = control.attr("style");
    stringHtml = (typeof styleAttr === 'undefined' || styleAttr === null) ? "" : styleAttr.toString();

    // Solo detectar border-color rojo de error real
    if (stringHtml.indexOf("border-color: red") >= 0 || stringHtml.indexOf("border-color:red") >= 0) {
      noCumplioValidacion = true;
    } else {
      noCumplioValidacion = false;
    }

    var reqStyle = $(this).find(".pmdynaform-field-required").attr("style");
    deshabilitadaValidacion = (typeof reqStyle !== 'undefined' && reqStyle != "display: none;") ? true : false;

    if ((deshabilitadaValidacion && $(this).find(".pmdynaform-field-required").html() == '*') || noCumplioValidacion || noCumplioValidacionProcess) {
      var valor = $(this).getValue();
      longitudTexto = (valor == null || valor == '' ? 0 : valor.length);
      if (longitudTexto == 0 || noCumplioValidacion || noCumplioValidacionProcess) {
        count++;
        c += count + ") " + $(this).getLabel() + "<br>";
        bandera = false;
      }
    }

  });

  //////Validar grillas
  columnasIncorrectasDental = new Array();
  columnasIncorrectasDental = verificarGrilla("grid_dental");
  columnasIncorrectasExequial = new Array();
  let bandera_exequial = $('#tri_bandera_exquial').getValue();
  if (bandera_exequial > 0) {
    columnasIncorrectasExequial = verificarGrilla("grid_seguro_exequial");
  }

  columnasIncorrectasBeneficiario = new Array();
  columnasIncorrectasBeneficiario = verificarGrilla("grd_beneficiario");

  columnasIncorrectasContingentes = new Array();
  if (!banderaContingente)
    columnasIncorrectasContingentes = verificarGrilla("grid_beneficiarios_contingentes");

  //columnasIncorrectasDependientes = new Array();
  //columnasIncorrectasDependientes = verificarGrilla("grid_historia_familiar");

  columnasIncorrectasVinculos2 = new Array();
  columnasIncorrectasVinculos2 = verificarGrilla("grd_vinculos_2");
  columnasIncorrectasVinculos3 = new Array();
  columnasIncorrectasVinculos3 = verificarGrilla("grd_otros_seguros");
  columnasIncorrectasVinculos4 = new Array();
  columnasIncorrectasVinculos4 = verificarGrilla("grid_medicos_consultados");
  columnasIncorrectasReferencias = new Array();
  columnasIncorrectasReferencias = verificarGrilla("grd_referencias");
  var c2 = '';
  var count2 = 0;

  if (columnasIncorrectasBeneficiario.length > 0) {
    // c += "<br>";
    c2 += "<u><strong>Beneficiarios:</strong></u>";
    c2 += "<br>";
  }
  $.each(columnasIncorrectasBeneficiario, function (key, value) {
    count2++;
    c2 += count2 + ") " + " - " + value + "<br>";
  });

  if (columnasIncorrectasContingentes.length > 0) {
    // c += "<br>";
    c2 += "<u><strong>Beneficiarios Contingentes:</strong></u>";
    c2 += "<br>";
  }
  $.each(columnasIncorrectasContingentes, function (key, value) {
    count2++;
    c2 += count2 + ") " + " - " + value + "<br>";
  });
  /*if (columnasIncorrectasDependientes.length > 0) {
    // c += "<br>";
    c2 += "<u><strong>Historia Familiar:</strong></u>";
    c2 += "<br>";
  }
  $.each(columnasIncorrectasDependientes, function (key, value) {
    count2++;
    c2 += count2 + ") " + " - " + value + "<br>";
  });*/

  if (columnasIncorrectasVinculos2.length > 0) {
    // c += "<br>";
    c2 += "<u><strong>Vinculos:</strong></u>";
    c2 += "<br>";
  }

  $.each(columnasIncorrectasVinculos2, function (key, value) {
    count2++;
    c2 += count2 + ") " + " - " + value + "<br>";
  });
  if (columnasIncorrectasVinculos3.length > 0) {
    // c += "<br>";
    c2 += "<u><strong>Otros Seguros:</strong></u>";
    c2 += "<br>";
  }

  $.each(columnasIncorrectasVinculos3, function (key, value) {
    count2++;
    c2 += count2 + ") " + " - " + value + "<br>";
  });
  
  if (columnasIncorrectasVinculos4.length > 0) {
    // c += "<br>";
    c2 += "<u><strong>Medicos Consultados:</strong></u>";
    c2 += "<br>";
  }
  $.each(columnasIncorrectasVinculos4, function (key, value) {
    count2++;
    c2 += count2 + ") " + " - " + value + "<br>";
  });
  
  if (columnasIncorrectasDental.length > 0) {
    // c += "<br>";
    c2 += "<u><strong>Dental:</strong></u>";
    c2 += "<br>";
  }
  $.each(columnasIncorrectasDental, function (key, value) {
    count2++;
    c2 += count2 + ") " + " - " + value + "<br>";
  });

  if (columnasIncorrectasExequial.length > 0) {
    // c += "<br>";
    c2 += "<u><strong>Seguro Exequial:</strong></u>";
    c2 += "<br>";
  }
  $.each(columnasIncorrectasExequial, function (key, value) {
    count2++;
    c2 += count2 + ") " + " - " + value + "<br>";
  });
  
  console.log('colIncRef: ',columnasIncorrectasReferencias);
  if (columnasIncorrectasReferencias.length !== 0 && columnasIncorrectasReferencias.length > 0) {
    // c += "<br>";
    c2 += "<u><strong>Referencias:</strong></u>";
    c2 += "<br>";
  }
  $.each(columnasIncorrectasReferencias, function (key, value) {
    count2++;
    c2 += count2 + ") " + " - " + value + "<br>";
  });

  c = c + c2;
  count = count + count2;

  /*if ($("#grd_referencias").getNumberRows()!== 0 && $("#grd_referencias").getNumberRows() > 1) {
      for (var i = 1; i <= $("#grd_referencias").getNumberRows(); i++) {
         if($("#grd_referencias").getValue(i, 1) == '' || $("#grd_referencias").getValue(i, 2) == ''){
      alert("Las referencias son obligatorias");
      c=i;
      bandera = false;
     }
      }
   }
   else {
      alert("No existe las suficientes referencias.");
    c=1;
    bandera = false;
   }
   */

  if (c == 0) {
    $("form").first().submitForm();
  }

  //Mostrar popUp
  $("#validacionesCampos").html(c);

  var dlgContents = {
    modal: true,
    resizable: false,
    buttons: {
      "Ok": function () {
        $(this).dialog("close");
        // callback(true);
      }
    }
  }

  if (count > 0) {
    $("#validacionesCampos").dialog(dlgContents);
  } else {
    $("form").saveForm();
    $("form").first().submitForm();
  }
  /*}
  else
  {
  alert('Beneficiarios contingentes debe ser igual a 100');
  }*/
  $("#4007565265ec4a369728566069135424").hideFormModal();
});


function verificarGrilla(nombreGrilla) {

  title = new Array();
  titleIncorrecto = new Array();

  //Todas las columnas
  $("#" + nombreGrilla + " .title-column").each(function (index) {
    var bool = $(this).parent().find(".pmdynaform-field-required").html() == '*';
    title[index] = [index + 1, $(this).html(), bool];//Columna, nombre de la Columna, requerido
  });

  var bandera = true;

  $.each(title, function (key, value) {//recorrer columnas

    var aux = true;
    var columna = value[0];
    var totalFilas = $("#" + nombreGrilla).getNumberRows();

    for (fila = 1; fila <= totalFilas; fila++) {//recorrer filas
      var stringHtml = "";
      try {
        stringHtml = $("#" + nombreGrilla).getControl(fila, columna).attr("style").toString();
      }
      catch {

        stringHtml = "";
      }
      //	alert(stringHtml.indexOf("border-color")+"color:"+ stringHtml.indexOf("color"));
      if (stringHtml.indexOf("border-color") >= 0 && stringHtml.indexOf("color") > 0) {//No cumplio alguna validacion
        aux = false;
      }

      if (value[2] && $("#" + nombreGrilla).getValue(fila, columna).trim() == "") {//Campo vacio
        aux = false;
      }
    }

    if (aux == false) {
      titleIncorrecto.push(value[1]);
      bandera = false;
    }


  });

  // return bandera;
  return titleIncorrecto;

}


if ($("#frm_monto").getValue() < 50000) {
  $("#frm_aclaraciones_sumas_aseguradas").hide();
  $("#frm_aclaraciones_file_sumas_aseguradas").hide();
}

if ($("#frm_trabajo_expuesta_politicamente").getValue() == 'N') {
  $("#frm_aclaraciones_file_pep").hide();
}

if ($("#frm_plan_tipo_identificacion").getValue() != 'C') {
  $("#frm_aclaraciones_file_sol_natural").hide();
}

if ($("#frm_plan_tipo_identificacion").getValue() != 'R') {
  $("#frm_aclaraciones_file_sol_juridico").hide();
}


function ponerDecimales_2(valor) {

  valor = valor + '';

  if (valor == '') {
    return '';
  } else if (typeof valor.split(".")[1] === 'undefined') {
    return valor + ".00";
  } else if (valor.split(".")[1].length == 0) {
    return valor + "00";
  } else if (valor.split(".")[1].length == 1) {
    return valor + "0";
  } else {
    return valor;
  }
}

function validarExpresionRegularGrid(id, numeroExpresion, grid) {
  var filas = jQuery("#" + grid).getNumberRows();
  var count = 0;
  var expresion_regular_1 = $("#expresion_regular_" + numeroExpresion).getValue();

  for (i = 1; i <= filas; i++) {

    var texto = jQuery("#" + grid).getValue(i, id).toString();

    if (texto.match(expresion_regular_1) != null || texto.length == 0) {
      jQuery("#grd_beneficiario").getControl(i, id).css("borderColor", "");
    } else {
      count += 1;
      jQuery("#grd_beneficiario").getControl(i, id).css("borderColor", "red");
    }
  }

  if (count > 0) {
    jQuery("#" + grid).find('.pmdynaform-grid-thead :nth-child(' + (id + 1) + ')').children().css("color", "red");
    return false;
  } else {
    jQuery("#" + grid).find('.pmdynaform-grid-thead :nth-child(' + (id + 1) + ')').children().css("color", "");
    return true;
  }
}



//$('#3525841575e87cc1ab4c9a1019379452').toggle();






$("#btn_plan_save").find("button").on("click", function () {

  $("#4007565265ec4a369728566069135424").saveForm();
  alert("Formulario guardado ...");

});





$("#frm_aplica_vitality").change(function () {
  vitality();
});

$("#frm_misma_cuenta_vitality").change(function () {
  mismacuentavitality();
});

$("#frm_tipo_seguro_contratado").change(function () {
  deshabilitarVitality();
});



$("#frm_valor_asegurado").focusout(function () {
  presentaReferencias();
});

function presentaReferencias() {
  var monto_asegurado = $("#frm_valor_asegurado").getValue();
  //lert(monto_asegurado);
  if (monto_asegurado > 200000) {
    $("#lbl_referencias").show();
    $("#4898898915ec72dbe10c885073313812").show();
    $("#grd_referencias").enableValidation(1);
    $("#grd_referencias").enableValidation(2);
    if ($("#grd_referencias").getNumberRows() < 2)
      $("#grd_referencias").addRow();
    else {
      var rows = $("#grd_referencias").getNumberRows();
      for (var i = 2; i < rows; i++) {
        $("#grd_referencias").deleteRow();
      }
    }
    alert("Es necesario ingresar 2 referencias");
  }
  else {
    $("#lbl_referencias").hide();
    //$("#4898898915ec72dbe10c885073313812").hide();
    $("#grd_referencias").disableValidation(1);
    $("#grd_referencias").disableValidation(2);
    $("#grd_referencias").clear();
  }
}
function mismacuentavitality() {
  if ($("#frm_misma_cuenta_vitality option:selected").val() == 'CTAVITALITY') {
    var auxBan = $("#frm_vitality_banco").getValue();
    //   alert (auxBan);
    $("#frm_devolucion_titular").setValue($("#frm_vitality_titular").getValue());
    $("#frm_devolucion_titular_apellidos").setValue($("#frm_vitality_titular_apellidos").getValue());
    $("#frm_devolucion_tipo_cuenta").setValue($("#frm_vitality_tipo_cuenta").getValue());
    $("#frm_devolucion_banco").setValue(auxBan);
    $("#frm_devolucion_numero_cuenta").setValue($("#frm_vitality_numero_cuenta").getControl().val());
    $("#frm_devolucion_tipo_identificacion").setValue($("#frm_vitality_tipo_identificacion").getValue());
    $("#frm_devolucion_identificacion").setValue($("#frm_vitality_identificacion").getValue());

    $("#frm_devolucion_banco").getControl().attr('disabled', true);
    $("#frm_devolucion_tipo_cuenta").getControl().attr('disabled', true);
    $("#frm_devolucion_numero_cuenta").getControl().attr('disabled', true);
    $("#frm_devolucion_tipo_identificacion").getControl().attr('disabled', true);
    $("#frm_devolucion_titular").getControl().attr('disabled', true);
    $("#frm_devolucion_titular_apellidos").getControl().attr('disabled', true);
    $("#frm_devolucion_identificacion").getControl().attr('disabled', true);
  }
  else {
    // encerarCuentaTransferencia();
    $("#frm_devolucion_titular").setValue('');
    $("#frm_devolucion_titular_apellidos").setValue('');
    $("#frm_devolucion_tipo_cuenta").setValue('');
    $("#frm_devolucion_banco").setValue('');
    $("#frm_devolucion_numero_cuenta").setValue('');
    $("#frm_devolucion_tipo_identificacion").setValue('');
    $("#frm_devolucion_identificacion").setValue('');

    $("#frm_devolucion_banco").getControl().attr('disabled', false);
    $("#frm_devolucion_tipo_cuenta").getControl().attr('disabled', false);
    $("#frm_devolucion_numero_cuenta").getControl().attr('disabled', false);
    $("#frm_devolucion_tipo_identificacion").getControl().attr('disabled', false);
    $("#frm_devolucion_titular").getControl().attr('disabled', false);
    $("#frm_devolucion_titular_apellidos").getControl().attr('disabled', false);
    $("#frm_devolucion_identificacion").getControl().attr('disabled', false);
  }
}

var grillaFamiliar = jQuery("form");

grillaFamiliar.on("change", validarFamilia);
grillaFamiliar.on("click", validarFamilia);

function validarFamilia() {
  //alert('');
  var bandera = true;
  var sumaPorcentaje = 0;
  //var gridId="grid_historia_familiar";

  for (i = 1; i <= $("#grid_historia_familiar").getNumberRows(); i++) {

    var valor = $("#grid_historia_familiar").getValue(i, 2);

    if (valor == "VIVO") {


      $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_edad_actual\\]").prop("disabled", false);
      $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_enfermedades\\]").prop("disabled", false);
      $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_edad_diagnostico\\]").prop("disabled", false);
      if ($("#grid_historia_familiar").getValue(i, 3) == "")
        $("#grid_historia_familiar").getControl(i, 3).css("borderColor", "red");
      else
        $("#grid_historia_familiar").getControl(i, 3).css("borderColor", "");

      if ($("#grid_historia_familiar").getValue(i, 4) == "")
        $("#grid_historia_familiar").getControl(i, 4).css("borderColor", "red");
      else
        $("#grid_historia_familiar").getControl(i, 4).css("borderColor", "");



      $("#grid_historia_familiar").setValue('', i, 6);
      $("#grid_historia_familiar").setValue('', i, 7);
      $("#grid_historia_familiar").setValue('', i, 8);


      $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_edad_morir\\]").prop("disabled", true);
      $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_diagnostico\\]").prop("disabled", true);
      $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_causa_muerte\\]").prop("disabled", true);
      $("#grid_historia_familiar").getControl(i, 6).css("borderColor", "");
      $("#grid_historia_familiar").getControl(i, 7).css("borderColor", "");
      $("#grid_historia_familiar").getControl(i, 8).css("borderColor", "");

    }
    else {
      if (valor == "FALLECIDO") {
        $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_edad_actual\\]").prop("disabled", true);
        $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_enfermedades\\]").prop("disabled", true);
        $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_edad_diagnostico\\]").prop("disabled", true);
        $("#grid_historia_familiar").setValue('', i, 3);
        $("#grid_historia_familiar").setValue('', i, 4);
        $("#grid_historia_familiar").setValue('', i, 5);



        $("#grid_historia_familiar").getControl(i, 3).css("borderColor", "");
        $("#grid_historia_familiar").getControl(i, 4).css("borderColor", "");
        $("#grid_historia_familiar").getControl(i, 5).css("borderColor", "");

        $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_edad_morir\\]").prop("disabled", false);
        $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_diagnostico\\]").prop("disabled", false);
        $("#form\\[grid_historia_familiar\\]\\[" + i + "\\]\\[frm_causa_muerte\\]").prop("disabled", false);
        if ($("#grid_historia_familiar").getValue(i, 6) == "")
          $("#grid_historia_familiar").getControl(i, 6).css("borderColor", "red");
        else
          $("#grid_historia_familiar").getControl(i, 6).css("borderColor", "");

        if ($("#grid_historia_familiar").getValue(i, 7) == "")
          $("#grid_historia_familiar").getControl(i, 7).css("borderColor", "red");
        else
          $("#grid_historia_familiar").getControl(i, 7).css("borderColor", "");

        if ($("#grid_historia_familiar").getValue(i, 8) == "")
          $("#grid_historia_familiar").getControl(i, 8).css("borderColor", "red");
        else
          $("#grid_historia_familiar").getControl(i, 8).css("borderColor", "");
        var murio = $("#grid_historia_familiar").getValue(i, 6);
        var diamurio = $("#grid_historia_familiar").getValue(i, 8);
        if (murio < diamurio) {
          //	alert ('Verifique edad de fallecimiento');
          $("#grid_historia_familiar").getControl(i, 6).css("borderColor", "red");
          $("#grid_historia_familiar").getControl(i, 8).css("borderColor", "red");
          //$("#grid_historia_familiar").setValue('',i, 6);
          //$("#grid_historia_familiar").setValue('',i, 8);
        }

      }
    }



    bandera = false
  }


  return bandera;
}


var expresion_regular = $("#expresion_regular_1").getValue();

var grillaBeneficiario = jQuery("form");

grillaBeneficiario.on("change", validarIdentificacionBeneficiario);
grillaBeneficiario.on("click", validarIdentificacionBeneficiario);

function validarIdentificacionBeneficiario() {

  mismoDocumentoQueAsegurado("grd_beneficiario", 2, true);

  //alert('');
  var bandera = true;
  var sumaPorcentaje = 0;

  for (i = 1; i <= $("#grd_beneficiario").getNumberRows(); i++) {

    var tipoDocumento = $("#grd_beneficiario").getValue(i, 1);

    //alert(tipoDocumento);

    var numeroIdentificacionBeneficiario = $("#grd_beneficiario").getValue(i, 2);

    $("#grd_beneficiario").getControl(i, 1).css("borderColor", "");
    $("#grd_beneficiario").getControl(i, 2).css("borderColor", "");

    var HijosDelCliente = [3, 4];

    //////////////////////////////////////////
    if (HijosDelCliente.indexOf(jQuery("#grd_beneficiario").getValue(i, 9) * 1) >= 0) { //parentesco Hij@
      if (tipoDocumento == '' && numeroIdentificacionBeneficiario != '') {
        $("#grd_beneficiario").getControl(i, 2).css("borderColor", "red");
        bandera = false;
      }

      if (tipoDocumento != '' && numeroIdentificacionBeneficiario == '') {
        $("#grd_beneficiario").getControl(i, 1).css("borderColor", "red");
        bandera = false;
      }

      if (tipoDocumento != '' && numeroIdentificacionBeneficiario != '') {

        var bool = validarIdentificacion_2(numeroIdentificacionBeneficiario, tipoDocumento, false);

        if (bool == false) {
          $("#grd_beneficiario").getControl(i, 2).css("borderColor", "red");
          bandera = false;
        }
      }

    } else {

      var bool = validarIdentificacion_2(numeroIdentificacionBeneficiario, tipoDocumento, false);
      if (bool == false) {
        $("#grd_beneficiario").getControl(i, 2).css("borderColor", "red");
        bandera = false;
      }

    }
    //////////////////////////////////////////

    //Sumar el porcentaje
    sumaPorcentaje += $("#grd_beneficiario").getValue(i, 10) * 1;
  }


  $("#frm_plan_total_beneficiarios").setValue(sumaPorcentaje);

  if (sumaPorcentaje != 100) {

    for (i = 1; i <= $("#grd_beneficiario").getNumberRows(); i++) {
      $("#grd_beneficiario").getControl(i, 10).css("borderColor", "red");
    }

    $("#frm_plan_total_beneficiarios").parent().find(".textlabel").css("color", "#a94442");
    bandera = false;
  } else {
    for (i = 1; i <= $("#grd_beneficiario").getNumberRows(); i++) {
      $("#grd_beneficiario").getControl(i, 10).css("borderColor", "");
    }
    $("#frm_plan_total_beneficiarios").parent().find(".textlabel").css("color", "");
  }

  // Validar que en los casos que se registre la cedula/pasaporte del Beneficiario en caso de muerte
  // no se repita el mismo beneficiario
  if (typeof gridIdentificacionRepetida === 'function') {
    var grdBool = gridIdentificacionRepetida("grd_beneficiario", 2);
    if (grdBool == false) {
      bandera = false;
    }
  }

  var grdBool_2 = mismoDocumentoGrillas(true);
  if (grdBool_2 == false) {
    bandera = false;
  }

  return bandera;
}


var grillaBeneficiario = jQuery("form");

grillaBeneficiario.on("change", validarIdentificacionBeneficiarioContingente);
grillaBeneficiario.on("click", validarIdentificacionBeneficiarioContingente);

function validarIdentificacionBeneficiarioContingente() {

  mismoDocumentoQueAsegurado("grid_beneficiarios_contingentes", 2, true);

  //alert('');
  var bandera = true;
  var sumaPorcentaje = 0;

  for (i = 1; i <= $("#grid_beneficiarios_contingentes").getNumberRows(); i++) {

    var tipoDocumentoc = $("#grid_beneficiarios_contingentes").getValue(i, 1);

    var numeroIdentificacionBeneficiarioc = $("#grid_beneficiarios_contingentes").getValue(i, 2);

    $("#grid_beneficiarios_contingentes").getControl(i, 1).css("borderColor", "");
    $("#grid_beneficiarios_contingentes").getControl(i, 2).css("borderColor", "");

    var HijosDelCliente = [3, 4];

    //////////////////////////////////////////
    if (HijosDelCliente.indexOf(jQuery("#grid_beneficiarios_contingentes").getValue(i, 9) * 1) >= 0) { //parentesco Hij@
      if (tipoDocumentoc == '' && numeroIdentificacionBeneficiarioc != '') {
        $("#grid_beneficiarios_contingentes").getControl(i, 2).css("borderColor", "red");
        bandera = false;
      }

      if (tipoDocumentoc != '' && numeroIdentificacionBeneficiarioc == '') {
        $("#grid_beneficiarios_contingentes").getControl(i, 1).css("borderColor", "red");
        bandera = false;
      }

      if (tipoDocumentoc != '' && numeroIdentificacionBeneficiarioc != '') {

        var bool = validarIdentificacion_2(numeroIdentificacionBeneficiarioc, tipoDocumentoc, false);

        if (bool == false) {
          $("#grid_beneficiarios_contingentes").getControl(i, 2).css("borderColor", "red");
          bandera = false;
        }
      }

    } else {

      var bool = validarIdentificacion_2(numeroIdentificacionBeneficiarioc, tipoDocumentoc, false);
      if (bool == false) {
        $("#grid_beneficiarios_contingentes").getControl(i, 2).css("borderColor", "red");
        bandera = false;
      }

    }
    //////////////////////////////////////////

    // if (tipoDocumentoc.length > 0) {
    // var bool = validarIdentificacion_2(numeroIdentificacionBeneficiarioc, tipoDocumentoc, false);
    // if (bool == false) {
    // $("#grid_beneficiarios_contingentes").getControl(i, 2).css("borderColor", "red");
    // bandera = false;
    // }

    // }



    //Sumar el porcentaje
    sumaPorcentaje += $("#grid_beneficiarios_contingentes").getValue(i, 10) * 1;
  }


  $("#frm_plan_total_beneficiarios_contingentes").setValue(sumaPorcentaje);

  if (sumaPorcentaje != 100) {

    for (i = 1; i <= $("#grid_beneficiarios_contingentes").getNumberRows(); i++) {
      $("#grid_beneficiarios_contingentes").getControl(i, 10).css("borderColor", "red");
    }

    $("#frm_plan_total_beneficiarios_contingentes").parent().find(".textlabel").css("color", "#a94442");
    bandera = false;
  } else {
    for (i = 1; i <= $("#grid_beneficiarios_contingentes").getNumberRows(); i++) {
      $("#grid_beneficiarios_contingentes").getControl(i, 10).css("borderColor", "");
    }
    $("#frm_plan_total_beneficiarios_contingentes").parent().find(".textlabel").css("color", "");
  }

  // Validar que en los casos que se registre la cedula/pasaporte del Beneficiarios contingentes
  // no se repita el mismo beneficiario
  if (typeof gridIdentificacionRepetida === 'function') {
    var grdBool = gridIdentificacionRepetida("grid_beneficiarios_contingentes", 2);
    if (grdBool == false) {
      bandera = false;
    }
  }

  var grdBool_2 = mismoDocumentoGrillas(true);
  if (grdBool_2 == false) {
    bandera = false;
  }

  return bandera;
}


function validarIdentificacion_2(identificacion, tipoIdentificacion_old, aux) {

  var tipoId = ['1', '2', '3'];
  var tipoIdentificacion = '';

  if (tipoId.indexOf(tipoIdentificacion_old) >= 0) {

    switch (tipoIdentificacion_old) {
      case '1':
        tipoIdentificacion = 'C';
        break;
      case '2':
        tipoIdentificacion = 'R';
        break;
      case '3':
        tipoIdentificacion = 'P';
        break;
    }

  } else {
    tipoIdentificacion = tipoIdentificacion_old;
  }

  numero = identificacion;
  var tercerDigito = numero.substring(2, 3);
  var bandera = true;
  if (tipoIdentificacion == 'C') {
    if (numero.length != 10) {
      if (aux) {
        alert("La identificacion no tiene diez digitos");
      }
      identificacion.value = '';
      bandera = false;
      return false;
    }
  } else if (tipoIdentificacion == 'R') {
    if (numero.length != 13) {
      if (aux) {
        alert("La identificacion no tiene trece digitos");
      }
      identificacion.value = '';
      bandera = false;
      return false;
    }
    if (tercerDigito == 9) {
      digitos = numero.split("");
      totdigitos = 10;
      total = 0;
      digito = (digitos[9] * 1);
      p1 = digitos[0] * 4;
      p2 = digitos[1] * 3;
      p3 = digitos[2] * 2;
      p4 = digitos[3] * 7;
      p5 = digitos[4] * 6;
      p6 = digitos[5] * 5;
      p7 = digitos[6] * 4;
      p8 = digitos[7] * 3;
      p9 = digitos[8] * 2;
      total = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
      residuo = total % 11
      final = residuo == 0 ? 0 : 11 - residuo
      //comprobando codigo verificador
      if (final == digito) {
        //alert("RUC EMPRESA valido");
        bandera = false;
        return true;
      }
    }
    if (tercerDigito == 6) {
      digitos = numero.split("");
      totdigitos = 10;
      total = 0;
      digito = (digitos[8] * 1);
      p1 = digitos[0] * 3;
      p2 = digitos[1] * 2;
      p3 = digitos[2] * 7;
      p4 = digitos[3] * 6;
      p5 = digitos[4] * 5;
      p6 = digitos[5] * 4;
      p7 = digitos[6] * 3;
      p8 = digitos[7] * 2;

      total = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8;
      residuo = total % 11
      final = residuo == 0 ? 0 : 11 - residuo
      //comprobando codigo verificador
      if (final == digito) {
        //alert("RUC EMPRESA PUBLICA valido");
        bandera = false;
        return true;
      }
      else {
        if (aux) {
          alert("RUC EMPRESA no valido");
          alert(aux);
        }
        identificacion.value = '';
        bandera = false;
      }
    }
  }
  if (bandera) {
    digitos = numero.split("");
    totdigitos = 10;
    total = 0;
    digito = (digitos[9] * 1);
    var i = 0;
    for (i = 0; i < (totdigitos - 1); i++) {
      mult = 0;
      if ((i % 2) != 0) {
        total = total + (digitos[i] * 1);
      } else {
        mult = digitos[i] * 2;
        if (mult > 9)
          total = total + (mult - 9);
        else
          total = total + mult;
      }
    }
    //comprobando codigo verificador
    decena = total / 10;
    decena = Math.floor(decena);
    decena = (decena + 1) * 10;
    final = (decena - total);
    if ((final == 10 && digito == 0) || (final == digito)) {
      //alert("Cedula valida");
      return true;
    } else {
      if (tipoIdentificacion == 'P' && identificacion != '') {

        return true;
      } else {
        if (aux) {
          alert("Identificacion no valida");
        }
        identificacion.value = '';
        return false;
      }
    }
  }
}

var grillaDependientes = jQuery("form");

grillaDependientes.on("change", validarDependientesGrilla);
grillaDependientes.on("click", validarDependientesGrilla);
let bandera_creado = 0;

function validarNumDependientesDental() {
  let bandera_dental = $('#tri_bandera_dental').getValue();
  console.log("Bandera dental: " + bandera_dental);

  //get the number of rows in the grid
  var i = 0;
  var numberRows = $("#grid_dental").getNumberRows();
  console.log("Number of rows dental: " + numberRows);
  
  if(bandera_dental == 0 && numberRows == 1){
      $("#grid_dental").deleteRow(1);
    }else{
  
  if (bandera_dental == 2) {
    if (numberRows <= 2) {
      $(".pmdynaform-grid-removerow-static", '#grid_dental').hide();

      if (numberRows == 1 || numberRows == 0) {
        $("#grid_dental").addRow();
        $("#grid_dental").addRow();
      }
    } else {
      $(".pmdynaform-grid-removerow-static", '#grid_dental').show();
    }
    return;
  } else {

    $(".pmdynaform-grid-newitem", '#grid_dental').hide();
    $(".pmdynaform-grid-removerow-static", '#grid_dental').hide();

    
    if(bandera_dental == 1 && numberRows == 1 && bandera_creado == 0){
      $("#grid_dental").addRow();
      bandera_creado = 1;
    }
  }
}
  /*
  //numberRows and bandera_dental must match
  if (numberRows > bandera_dental) {
    //remove the last rows until the number of rows is equal to bandera_dental
    //$("#grid_dental").deleteRow(lastIndex);
    for (i = 0; i <= (numberRows - bandera_dental); i++) {
      $("#grid_dental").deleteRow(numberRows - i - 1);
    }

  }
  if (numberRows < bandera_dental) {
    //add rows until the number of rows is equal to bandera_dental
    console.log("numberRows: " + numberRows);
    console.log("bandera_dental: " + bandera_dental);
    for (i = 0; i <= (bandera_dental - numberRows); i++) {
      $("#grid_dental").addRow();
    }
  }
*/

}

validarNumDependientesDental()

function validarNumDependientesExequial() {
  let bandera_exequial = $('#tri_bandera_exquial').getValue();
  //get the number of rows in the grid
  var i = 0;
  var numberRows = $("#grid_seguro_exequial").getNumberRows();
  console.log(numberRows);
  console.log(bandera_exequial);
  //if bandera_exequial is invalid, return
  if (bandera_exequial == 0 || bandera_exequial == null) {
    $("#grid_seguro_exequial").addRow();
    console.log("bandera_exequial is invalid");
    //get number of columns in the grid
    var aCols = $('#grid_seguro_exequial').getInfo().columns;
    var gColNo = aCols.length;
    console.log("Number of columns: " + gColNo);
    for (i = 0; i <= gColNo; i++) {
      $('#grid_seguro_exequial').disableValidation(i);

    }
    $('#grid_seguro_exequial').deleteRow(1);
    $('#grid_seguro_exequial').disableValidation();
    $('#grid_seguro_exequial').hide();
    console.log("grid_seguro_exequial is not valid");
    return;
  }


  //numberRows and bandera_exequial must match
  if (numberRows > bandera_exequial) {
    //remove the last rows until the number of rows is equal to bandera_exequial
    //$("#grid_seguro_exequial").deleteRow(lastIndex);
    for (i = 0; i <= (numberRows - bandera_exequial); i++) {
      $("#grid_seguro_exequial").deleteRow(numberRows - i - 1);
    }
  }
  if (numberRows < bandera_exequial) {
    //add rows until the number of rows is equal to bandera_exequial
    console.log("numberRows: " + numberRows);
    console.log("bandera_exequial: " + bandera_exequial);
    for (i = 0; i < (bandera_exequial - numberRows); i++) {
      $("#grid_seguro_exequial").addRow();
    }
  }
}

validarNumDependientesExequial()
function validarDependientesGrilla() {

  mismoDocumentoQueAsegurado("grid_dental", 3, true);

  validarNumDependientesDental();
  var bandera = true;

  for (i = 1; i <= $("#grid_dental").getNumberRows(); i++) {
    if (validarEdadesGrilla(i, 9, true) == false) {
      bandera = false;
    }

    //	Opcional (en el caso de parentesco Hij@, Tipo de identificacion y Numero de identificacion
    $("#grid_dental").getControl(i, 2).css("borderColor", "");
    $("#grid_dental").getControl(i, 3).css("borderColor", "");

    var tipoDocumento = jQuery("#grid_dental").getValue(i, 2);


    var numeroIdentificacion = jQuery("#grid_dental").getValue(i, 3).trim();

    var HijosDelCliente = [3, 4];

    if (HijosDelCliente.indexOf(jQuery("#grid_dental").getValue(i, 8) * 1) >= 0) { //parentesco Hij@
      if (tipoDocumento == '' && numeroIdentificacion != '') {
        $("#grid_dental").getControl(i, 2).css("borderColor", "red");
        bandera = false;
      }

      if (tipoDocumento != '' && numeroIdentificacion == '') {
        $("#grid_dental").getControl(i, 3).css("borderColor", "red");
        bandera = false;
      }

      if (tipoDocumento != '' && numeroIdentificacion != '') {

        var bool = validarIdentificacion_2(numeroIdentificacion, tipoDocumento, false);
        if (bool == false) {
          $("#grid_dental").getControl(i, 3).css("borderColor", "red");
          bandera = false;
        }
      }

      // if (tipoDocumento == '' && numeroIdentificacion == '') en este caso no hace nada

    } else {

      var bool = validarIdentificacion_2(numeroIdentificacion, tipoDocumento, false);
      if (bool == false) {
        $("#grid_dental").getControl(i, 3).css("borderColor", "red");
        bandera = false;
      }

    }

  }

  // 1.	Validar que no se repita la cdula/pasaporte en el registro de Dependientes de Dental
  if (typeof gridIdentificacionRepetida === 'function') {
    var grdBool = gridIdentificacionRepetida("grid_dental", 3);
    if (grdBool == false) {
      bandera = false;
    }
  }

  return bandera;
}

grillaDependientes.on("change", validarExequialGrilla);
grillaDependientes.on("click", validarExequialGrilla);

function validarExequialGrilla() {

  let bandera_exequial = $('#tri_bandera_exquial').getValue();
  if (bandera_exequial == 0 || bandera_exequial == null) {
    $("#grid_seguro_exequial").disableValidation();
    return;
  }
  //validarNumDependientesExequial();
  mismoDocumentoQueAsegurado("grid_seguro_exequial", 3, true);

  var bandera = true;

  for (i = 1; i <= $("#grid_seguro_exequial").getNumberRows(); i++) {

    if (validarFechaActualGrilla("grid_seguro_exequial", i, 9, true) == false) {
      bandera = false;
    }

    ponerEdadesGrilla(i, 9, true);

    //Opcional (en el caso de parentesco Hij@, Tipo de identificacin y Numero de identificacion
    $("#grid_seguro_exequial").getControl(i, 2).css("borderColor", "");
    $("#grid_seguro_exequial").getControl(i, 3).css("borderColor", "");

    var tipoDocumento = jQuery("#grid_seguro_exequial").getValue(i, 2);

    var numeroIdentificacion = jQuery("#grid_seguro_exequial").getValue(i, 3).trim();

    var HijosDelCliente = [3, 4];

    if (HijosDelCliente.indexOf(jQuery("#grid_seguro_exequial").getValue(i, 8) * 1) >= 0) { //parentesco Hij@
      if (tipoDocumento == '' && numeroIdentificacion != '') {
        $("#grid_seguro_exequial").getControl(i, 2).css("borderColor", "red");
        bandera = false;
      }

      if (tipoDocumento != '' && numeroIdentificacion == '') {
        $("#grid_seguro_exequial").getControl(i, 3).css("borderColor", "red");
        bandera = false;
      }

      if (tipoDocumento != '' && numeroIdentificacion != '') {

        var bool = validarIdentificacion_2(numeroIdentificacion, tipoDocumento, false);
        if (bool == false) {
          $("#grid_seguro_exequial").getControl(i, 3).css("borderColor", "red");
          bandera = false;
        }
      }

      // if (tipoDocumento == '' && numeroIdentificacion == '') en este caso no hace nada

    } else {

      if (tipoDocumento == '') {
        $("#grid_seguro_exequial").getControl(i, 2).css("borderColor", "red");
        bandera = false;
      }

      if (numeroIdentificacion == '') {
        $("#grid_seguro_exequial").getControl(i, 3).css("borderColor", "red");
        bandera = false;
      }

      var bool = validarIdentificacion_2(numeroIdentificacion, tipoDocumento, false);
      if (bool == false) {
        $("#grid_seguro_exequial").getControl(i, 3).css("borderColor", "red");
        bandera = false;
      }

    }

  }

  // 1.	Validar que no se repita la cedula/pasaporte en el registro de Dependientes de Dental
  if (typeof gridIdentificacionRepetida === 'function') {
    var grdBool = gridIdentificacionRepetida("grid_seguro_exequial", 3);
    if (grdBool == false) {
      bandera = false;
    }
  }

  return bandera;
}


function validarEdadesGrilla(fila, columna, auxAlert) {

  var fecha = jQuery("#grid_dental").getValue(fila, columna);
  if (fecha.length != 10) {
    $("#grid_dental").getControl(fila, columna).css("borderColor", "red");
    return false;
  }

  var hoy = new Date();
  //set time to 23:59:59
  hoy.setHours(23);
  hoy.setMinutes(59);
  hoy.setSeconds(59);

  //add one day 
  //hoy = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate() - 1);

  var fechaNacimiento = new Date(fecha);
  //editar fecha Nacimiento Dental
  fechaNacimiento.setDate(fechaNacimiento.getDate());
  console.log(fechaNacimiento);
  //sum one day 
  fechaNacimiento.setDate(fechaNacimiento.getDate() + 2);
  console.log(fechaNacimiento);
  fechaNacimiento.setHours(0);
  fechaNacimiento.setMinutes(0);
  fechaNacimiento.setSeconds(0);

  var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
  var diferenciaMeses = hoy.getMonth() - fechaNacimiento.getMonth();
  var diferenciaDias = hoy.getDay() - fechaNacimiento.getDay()+1;

  if (diferenciaMeses < 0 || (diferenciaMeses === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
    edad--
  }

  jQuery("#grid_dental").setValue(edad, fila, 10) //Poner la edad cualquiera q esta sea

  var bandera = true;

  if (edad < 0) {
    bandera = false;
  }

  // var parejaDelCliente = [1, 2];	//Conyugue
  var parejaDelCliente = [15, 22];	//Conyugue
  if ((edad >= 69 || edad <= 17) && (parejaDelCliente.indexOf(jQuery("#grid_dental").getValue(fila, 8) * 1) >= 0)) {
    bandera = false;
  }

  var HijosDelCliente = [3, 4]; //Hij@

  if ((edad >= 23 || edad <= 0) && (HijosDelCliente.indexOf(jQuery("#grid_dental").getValue(fila, 8) * 1) >= 0)) {
    bandera = false;
  }
  if (bandera == false) {
    jQuery("#grid_dental").setValue("", fila, columna);
  }

  if (edad >= 0 && bandera == false) {
    if (auxAlert) {

      window.dynaform.flashMessage({
        emphasisMessage: "El dependiente ",
        message: jQuery("#grid_dental").getText(fila, 8) + " supera o es inferior a la edad permitida",
        duration: 5000,
        type: 'info',

        absoluteTop: true
      })

      //alert("El dependiente " + jQuery("#grd_dependientes").getText(fila,7) + " supera la edad permitida");
    }
  }

  if (edad < 0) {
    if (auxAlert) {

      window.dynaform.flashMessage({
        emphasisMessage: "Fecha de nacimiento incorrecta",
        message: " ",
        duration: 5000,
        type: 'info',

        absoluteTop: true
      })

      // alert("Fecha incorrecta");
    }
  }

  if (bandera == false) {
    $("#grid_dental").getControl(fila, 9).css("borderColor", "red");
  } else {
    // $("#ReceiptList").find("div.pmdynaform-grid-tbody").css("border", "1px solid red");
    // alert(	$("#grid_dental").getControl(fila, 10).html()	);
    $("#grid_dental").getControl(fila, 9).css("borderColor", "");
  }

  return bandera;
}

function ponerEdadesGrilla(fila, columna, auxAlert) {

  var fecha = jQuery("#grid_seguro_exequial").getValue(fila, columna);
  if (fecha.length != 10) {
    $("#grid_seguro_exequial").getControl(fila, columna).css("borderColor", "red");
    return false;
  }
  console.log('edades grilla');
  var hoy = new Date();
  /*hoy = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate() - 1);
  console.log(hoy);*/
  var fechaNacimiento = new Date(fecha);
  fechaNacimiento.setDate(fechaNacimiento.getDate() + 1);

  var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
  var diferenciaMeses = hoy.getMonth() - fechaNacimiento.getMonth();
  var diferenciaDias = hoy.getDay() - fechaNacimiento.getDay();

  if (diferenciaMeses < 0 || (diferenciaMeses === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
    edad--
  }

  jQuery("#grid_seguro_exequial").setValue(edad, fila, 10) //Poner la edad cualquiera q esta sea
  var bandera = true;

  if (edad < 0) {
    bandera = false;
  }

  // var HijosDelCliente = [1,13,4,3,29,28,6,5,10,9,15,33,32]; //padres, hijos, abuelos, hermanos, nietos, cinyuge, padres del cinyuge (suegros) e hijos del cnyuge
  var HijosDelCliente = [1, 2, 4, 3, 29, 28, 6, 5, 10, 9, 15, 33, 32, 22, 58, 57]; //padres, hijos, abuelos, hermanos, nietos, cnyuge, padres del cnyuge (suegros) e hijos del cnyuge
  //var Conyugues = [15, 22]; //Conyugue
  if (edad >= 69 && (HijosDelCliente.indexOf(jQuery("#grid_seguro_exequial").getValue(fila, 8) * 1) >= 0)) {
    bandera = false;
  }
  /* if ((edad >= 69 || edad <= 17 ) && (Conyugues.indexOf(jQuery("#grid_seguro_exequial").getValue(fila, 8) * 1) >= 0)) {
     bandera = false;
   }*/
  if (bandera == false) {
    jQuery("#grid_seguro_exequial").setValue("", fila, columna);
  }

  if (edad >= 0 && bandera == false) {
    if (auxAlert) {
      window.dynaform.flashMessage({
        emphasisMessage: "Exequial ",
        message: jQuery("#grid_seguro_exequial").getText(fila, 8) + " supera o es inferior a la edad permitida",
        duration: 5000,
        type: 'info',

        absoluteTop: true
      })

      //alert("El dependiente " + jQuery("#grid_seguro_exequial").getText(fila,7) + " supera la edad permitida");
    }
  }

  if (edad < 0) {
    if (auxAlert) {

      window.dynaform.flashMessage({
        emphasisMessage: "Fecha de nacimiento incorrecta",
        message: " ",
        duration: 5000,
        type: 'info',

        absoluteTop: true
      })

      // alert("Fecha incorrecta");
    }
  }

  // if (bandera == false) {
  // $("#grid_seguro_exequial").getControl(fila, 9).css("borderColor", "red");
  // } else {
  // $("#grid_seguro_exequial").getControl(1, 10).css("border", "1px solid red");
  // }

  return bandera;
}

var grillaMedicos = jQuery("form");

grillaMedicos.on("change", validarMedicosGrilla);
grillaMedicos.on("click", validarMedicosGrilla);

function validarMedicosGrilla() {

  var bandera = true;

  for (i = 1; i <= $("#grid_medicos_consultados").getNumberRows(); i++) {
    if (validarFechaActualGrilla("grid_medicos_consultados", i, 4, true) == false) {
      bandera = false;
    }
  }
  return bandera;
}
function validarFechaActualGrilla(grilla, fila, columna, auxAlert) {

  var fecha = jQuery("#" + grilla).getValue(fila, columna);
  if (fecha.length != 10) {
    $("#" + grilla).getControl(fila, columna).css("borderColor", "red");

    return false;
  }

  var hoy = new Date();

  var fechaNacimiento = new Date(fecha);

  if (fechaNacimiento > hoy) bandera = false;
  else bandera = true;

  if (bandera == false) {
    jQuery("#" + grilla).setValue("", fila, columna);
  }
  if (bandera == false) {
    if (auxAlert) {

      window.dynaform.flashMessage({
        emphasisMessage: "Fecha incorrecta",
        message: "La fecha no puede ser mayor a la actual",
        duration: 5000,
        type: 'info',

        absoluteTop: true
      })


    }
  }


  if (bandera == false) {
    $("#" + grilla).getControl(fila, columna).css("borderColor", "red");
  } else {
    $("#" + grilla).getControl(fila, columna).css("borderColor", "");
  }

  return bandera;
}

function deshabilitarVitality() {
  if ($("#frm_tipo_seguro_contratado option:selected").val() == 'TEMPORAL1') {
    $("#frm_aplica_vitality").setValue("N");
    $("#frm_aplica_vitality").getControl().attr('disabled', true);
    vitality();

  }
  else {
    $("#frm_aplica_vitality").getControl().attr('disabled', false);
  }


}
function vitality() {
  if ($("#frm_aplica_vitality option:selected").val() == 'S') {

    $("#tit_vitality").show();

    // if ($('#7455655435ec5e04de42eb2043075382').is(':hidden')) {
    // $('#tit_vitality i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    // }

    if (typeof $("#tit_vitality").find(".glyphicon-plus").html() === 'undefined') {
      $("#7455655435ec5e04de42eb2043075382").show();
    }

    $("#frm_misma_cuenta_vitality").find("option[value=CTAVITALITY]").show();

    $("#frm_vitality_banco").enableValidation();
    $("#frm_vitality_tipo_cuenta").enableValidation();
    $("#frm_vitality_numero_cuenta").enableValidation();
    $("#frm_vitality_tipo_identificacion").enableValidation();
    $("#frm_vitality_identificacion").enableValidation();
    $("#frm_vitality_titular").enableValidation();
    $("#frm_vitality_titular_apellidos").enableValidation();
	//henry
	$("#frm_vitality_tipo_identificacion").setValue($("#frm_tipo_identificacion").getValue());
    $("#frm_vitality_identificacion").setValue($("#frm_numero_identificacion").getValue());
    $("#frm_vitality_titular").setValue($("#frm_primer_nombre").getValue()+' '+$("#frm_segundo_nombre").getValue());
    $("#frm_vitality_titular_apellidos").setValue($("#frm_apellido_paterno").getValue()+' '+$("#frm_apellido_materno").getValue());

  }
  else {//Seleccione y OTRA CUENTA

    $("#tit_vitality").hide();
    $('#7455655435ec5e04de42eb2043075382').hide();
    $("#frm_misma_cuenta_vitality").find("option[value=CTAVITALITY]").hide();

    // insertado damian
    $("#frm_vitality_banco").setValue("");
    $("#frm_vitality_banco").disableValidation();
    
    $("#frm_vitality_tipo_cuenta").setValue("");
    $("#frm_vitality_tipo_cuenta").disableValidation();
    
    $("#frm_vitality_numero_cuenta").setValue("");
    $("#frm_vitality_numero_cuenta").disableValidation();
    
    $("#frm_vitality_identificacion").setValue("");
    $("#frm_vitality_identificacion").disableValidation();
    
    $("#frm_vitality_tipo_identificacion").setValue("");
    $("#frm_vitality_tipo_identificacion").disableValidation();
    
    $("#frm_vitality_titular").setValue("");
    $("#frm_vitality_titular").disableValidation();
    
    $("#frm_vitality_titular_apellidos").setValue("");
    $("#frm_vitality_titular_apellidos").disableValidation();

    if ($("#frm_misma_cuenta_vitality option:selected").val() == 'CTAVITALITY') {
      $("#frm_misma_cuenta_vitality").setValue('CTAOTRA');

      // encerarCuentaTransferencia();

      $("#frm_devolucion_titular").setValue('');
      $("#frm_devolucion_titular").getControl().attr('disabled', false);
      
      $("#frm_devolucion_titular_apellidos").setValue('');
      $("#frm_devolucion_titular_apellidos").getControl().attr('disabled', false);
      
      $("#frm_devolucion_tipo_cuenta").setValue('');
      $("#frm_devolucion_tipo_cuenta").getControl().attr('disabled', false);
      
      $("#frm_devolucion_banco").setValue('');
      $("#frm_devolucion_banco").getControl().attr('disabled', false);
      
      $("#frm_devolucion_numero_cuenta").setValue('');
      $("#frm_devolucion_numero_cuenta").getControl().attr('disabled', false);
      
      $("#frm_devolucion_tipo_identificacion").setValue('');
      $("#frm_devolucion_tipo_identificacion").getControl().attr('disabled', false);
      
      $("#frm_devolucion_identificacion").setValue('');      
      $("#frm_devolucion_identificacion").getControl().attr('disabled', false);

    }
  }

}

function mismoDocumentoQueAsegurado(nombre_grilla, columna, auxAlert) {

  var filas = $("#" + nombre_grilla).getNumberRows();
  var identificacionAsegurado = $("#frm_numero_identificacion").getValue();
  identificacionAsegurado = identificacionAsegurado.toUpperCase();

  for (f = 1; f <= filas; f++) {
    var identificacionGrilla = $("#" + nombre_grilla).getValue(f, columna).trim();
    identificacionGrilla = identificacionGrilla.toUpperCase();

    if (identificacionAsegurado != "" && identificacionGrilla == identificacionAsegurado) {
      if (auxAlert) {
        alert("No ingresar la misma identificacion que el asegurado");
      }
      $("#" + nombre_grilla).setValue("", f, columna)
    }
  }
}

function mismoDocumentoGrillas(auxAlert) {
  // grd_beneficiario
  // grid_beneficiarios_contingentes

  var columnaBeneficiario = 2;
  var columnaBeneficiarioContingentes = 2;
  var bandera = true;
  var identificacionBeneficiario = [];

  for (f = 1; f <= $("#grd_beneficiario").getNumberRows(); f++) {

    var identificacionGrilla = $("#grd_beneficiario").getValue(f, columnaBeneficiario).trim();
    identificacionGrilla = identificacionGrilla.toUpperCase();
    if (identificacionGrilla != "") {
      identificacionBeneficiario.push(identificacionGrilla);
    }

  }

  // $.each( identificacionBeneficiario, function( key, value ) {
  // alert(key + "-----" + value)
  // });

  for (f = 1; f <= $("#grid_beneficiarios_contingentes").getNumberRows(); f++) {

    var identificacionGrilla = $("#grid_beneficiarios_contingentes").getValue(f, columnaBeneficiarioContingentes).trim();
    identificacionGrilla = identificacionGrilla.toUpperCase();

    if (identificacionBeneficiario.indexOf(identificacionGrilla) >= 0) {
      bandera = false;
      if (auxAlert) {

        window.dynaform.flashMessage({
          emphasisMessage: "Identificacion repetida :",
          message: "Beneficiario en caso de muerte y en Beneficiarios contingentes, no pueden tener la misma identificacion",
          duration: 5000,
          type: 'info',

          absoluteTop: true
        })

      }
      $("#grid_beneficiarios_contingentes").setValue("", f, columnaBeneficiarioContingentes);
    }

  }

  return bandera;
}

$("#frm_devolucion_tipo_identificacion").change(function () {
  $('#frm_devolucion_identificacion').setValue('');
});

$("#frm_vitality_banco, #frm_vitality_tipo_cuenta, #frm_vitality_numero_cuenta, #frm_vitality_tipo_identificacion, #frm_vitality_identificacion, #frm_vitality_titular, #frm_vitality_titular_apellidos").change(function () {

  // id = $(this).getControl().attr("id");
  // if(id == "form[frm_devolucion_tipo_identificacion]"){
  // $('#frm_devolucion_identificacion').setValue('');
  // }

  if ($("#frm_misma_cuenta_vitality").getValue() == 'CTAVITALITY') {
    $("#frm_misma_cuenta_vitality").setValue('CTAOTRA');
    // encerarCuentaTransferencia();

    $("#frm_devolucion_titular").setValue('');
    $("#frm_devolucion_titular").getControl().attr('disabled', false);
    
    $("#frm_devolucion_titular_apellidos").setValue('');
    $("#frm_devolucion_titular_apellidos").getControl().attr('disabled', false);
    
    $("#frm_devolucion_tipo_cuenta").setValue('');
    $("#frm_devolucion_tipo_cuenta").getControl().attr('disabled', false);
    
    $("#frm_devolucion_banco").setValue('');
    $("#frm_devolucion_banco").getControl().attr('disabled', false);
    
    $("#frm_devolucion_numero_cuenta").setValue('');
    $("#frm_devolucion_numero_cuenta").getControl().attr('disabled', false);
    
    $("#frm_devolucion_tipo_identificacion").setValue('');
    $("#frm_devolucion_tipo_identificacion").getControl().attr('disabled', false);
    
    $("#frm_devolucion_identificacion").setValue('');    
    $("#frm_devolucion_identificacion").getControl().attr('disabled', false);

  }

});

function encerarCuentaTransferencia() {
  $("#frm_devolucion_titular").setValue('');
  $("#frm_devolucion_titular_apellidos").setValue('');
  $("#frm_devolucion_tipo_cuenta").setValue('');
  $("#frm_devolucion_banco").setValue('');
  $("#frm_devolucion_numero_cuenta").setValue('');
  $("#frm_devolucion_tipo_identificacion").setValue('');
  $("#frm_devolucion_identificacion").setValue('');
  /*
  $("#frm_devolucion_banco").getControl().attr('disabled', false);
  $("#frm_devolucion_tipo_cuenta").getControl().attr('disabled', false);
  $("#frm_devolucion_numero_cuenta").getControl().attr('disabled', false);
  $("#frm_devolucion_tipo_identificacion").getControl().attr('disabled', false);
  $("#frm_devolucion_titular").getControl().attr('disabled', false);
  $("#frm_devolucion_titular_apellidos").getControl().attr('disabled', false);
  $("#frm_devolucion_identificacion").getControl().attr('disabled', false);
  */
}

function checkDesgravamen(newVal, oldVal) {
  $("#grid_beneficiarios_contingentes").show();
  $("#frm_plan_total_beneficiarios_contingentes").show();
  $("#frm_plan_total_beneficiarios_contingentes").enableValidation();

  if (newVal == '11') {
    banderaContingente = true;
    $("#grid_beneficiarios_contingentes").hide();
    $("#grid_beneficiarios_contingentes").deleteRow(0);
    $("#frm_plan_total_beneficiarios_contingentes").hide();
    $("#frm_plan_total_beneficiarios_contingentes").disableValidation();
  }
}

checkDesgravamen($("#frm_motivo_seguro").getValue(), '');
$('#frm_motivo_seguro').setOnchange(checkDesgravamen);
