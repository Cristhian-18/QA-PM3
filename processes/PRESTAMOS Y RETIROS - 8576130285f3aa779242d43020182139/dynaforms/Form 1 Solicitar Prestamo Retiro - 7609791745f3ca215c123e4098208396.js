//contraccion
 
$('#7689594095f3ca309a42d38006294228').toggle(); //asegurado
$('#9802986195f3cace465c8e8078214983').toggle(); //documentos
$('#3481439505f3d658c99b673065865401').toggle(); //acreditar
$('#3420420135f3cad48cf08a7020087388').toggle(); //debitar

//estilo del checkbox
$("#chk_confirmar_proceso").children("div").eq(0).removeClass()
$("#chk_confirmar_proceso").children("div").eq(0).addClass("col-sm-8.col-md-8.col-lg-8")
$("#chk_confirmar_proceso").children("div").eq(0).find("label").css("float", "left")
$("#chk_confirmar_proceso").children("div").eq(1).removeClass()
$("#chk_confirmar_proceso").children("div").eq(1).addClass("col-sm-4 col-md-4 col-lg-4 pmdynaform-field-control")
$("#chk_confirmar_proceso").children("div").eq(1).css("float", "left")
$("#chk_confirmar_proceso").children("div").eq(1).css("padding-left", "0")
$("div.pmdynaform-control-checkbox-list").css("box-shadow", "none");
$("input.pmdynaform-control-checkbox").css("transform", "scale(1.5)");
$("#chk_confirmar_proceso").find("span.textlabel").css("font-size", "18px");


//requerido check box
if ($("#tri_accion_bandera").getValue() == '') {
  //$("#chk_confirmar_proceso").disableValidation();
  $("#cmb_accion").hide();
  $("#cmb_accion").disableValidation();
} else {
  $("#chk_confirmar_proceso").enableValidation();
  $("#cmb_accion").show();
  $("#cmb_accion").enableValidation();
}


$("#7609791745f3ca215c123e4098208396").setOnSubmit(function () {
  $("#7609791745f3ca215c123e4098208396").showFormModal();
  var formId = $("form").prop("id");
  if (getFormById(formId).isValid() == true) {
    $("#" + formId).saveForm();
    $("#7609791745f3ca215c123e4098208396").hideFormModal();
  } else {
    $("#7609791745f3ca215c123e4098208396").hideFormModal();
    return showConfirmDlg();
    return false;
  }

  /*$("#7609791745f3ca215c123e4098208396").saveForm() ;
  return showConfirmDlg();*/
});

$("#btn_financiera_save").find("button").on("click", function () {
  $("#7609791745f3ca215c123e4098208396").saveForm();
  alert("Formulario guardado ...");
});

$("#frm_tipo_solicitud").setValue('');
$("#frm_canal").setValue('');
$('#frm_canal').getControl().empty();
$("#chk_vencimiento").setValue('');
$('#chk_vencimiento').getControl().empty();

function solicitud(newValue, oldValue) {
  //ingresa oculta y desabilitado retiros
  $('#frm_monto').disableValidation();
  $('#frm_costo_retiro').disableValidation();
  $('#frm_derecho_retiro').disableValidation();
  $('#frm_val_descontado').disableValidation();
  $('#frm_monto').hide();
  $('#frm_costo_retiro').hide();
  $('#frm_derecho_retiro').hide();
  $('#frm_val_descontado').hide();
  //ingresa oculta y desabilitado prestamos
  $('#frm_monto_prestamo').disableValidation();
  $('#frm_frecuencia_pago').disableValidation();
  $('#frm_plazo_prestamo').disableValidation();
  $('#frm_monto_prestamo').hide();
  $('#frm_frecuencia_pago').hide();
  $('#frm_plazo_prestamo').hide();
  $('#lbl_msg_tasa').hide();
  //para los datos dl calculo
  $('#frm_monto_disponible').hide();
  $('#frm_monto_actual').hide();
  $('#frm_tasa_calc').hide();
  $('#frm_total_capital').hide();
  $('#frm_total_interes').hide();
  $('#frm_total_pagar').hide();
  $('#pnl_tabla_amortizacion').hide();
  $('#btn_calcular').hide();
  $('#chk_vencimiento').hide();

  //oculto seccion debito
  $('#frm_sbt_debito').hide();
  $('#3420420135f3cad48cf08a7020087388').hide();
  $('#frm_opcion_debito').disableValidation();
  $('#frm_tipo_identificacion_pagador').disableValidation();
  $('#frm_cedula_pagador').disableValidation();
  $('#frm_entidad_financiera').disableValidation();
  $('#frm_medio_pago').disableValidation();
  $('#frm_numero_cuenta').disableValidation();
  $('#frm_canal').getControl().empty();
  $('#frm_canal').getControl().append(new Option("Seleccione", ""));
  $("#frm_canal").setValue('');

  //si es retiro por defecto natural
  if (newValue == 'R') {
    $('#frm_tipo_persona').setValue('N');
    $('#frm_monto').enableValidation();
    $('#frm_costo_retiro').enableValidation();
    $('#frm_derecho_retiro').enableValidation();
    $('#frm_val_descontado').enableValidation();
    $('#frm_monto').show();
    //combo ramo
    //$('#frm_canal').getControl().append( new Option("PROTEGER PLUS", "58") );
    $('#frm_canal').getControl().append(new Option("VIDA UNIVERSAL", "59"));
  }

  if (newValue == 'P') {
    $('#frm_tipo_persona').setValue('N');
    $('#frm_monto_prestamo').enableValidation();
    $('#frm_frecuencia_pago').enableValidation();
    $('#frm_plazo_prestamo').enableValidation();
    $('#frm_monto_prestamo').show();
    $('#frm_frecuencia_pago').show();
    $('#frm_plazo_prestamo').show();
    $('#lbl_msg_tasa').show();
    //otro subform
    $('#frm_sbt_debito').show();
    $('#3420420135f3cad48cf08a7020087388').show();
    $('#3420420135f3cad48cf08a7020087388').toggle(); //debitar
    $('#frm_opcion_debito').enableValidation();
    $('#frm_tipo_identificacion_pagador').enableValidation();
    $('#frm_cedula_pagador').enableValidation();
    $('#frm_entidad_financiera').enableValidation();
    $('#frm_medio_pago').enableValidation();
    $('#frm_numero_cuenta').enableValidation();
    //combo ramo
    //$('#frm_canal').getControl().append( new Option("PROTEGER PLUS", "58") );
    //$('#frm_canal').getControl().append( new Option("VIDA PROVISION", "55") );
    $('#frm_canal').getControl().append(new Option("VIDA UNIVERSAL", "59"));
    $('#chk_vencimiento').show();
  }
}
solicitud();
$("#frm_tipo_solicitud").setOnchange(solicitud);

function persona(newValue, oldValue) {
  //oculto empresa
  $('#frm_nombre_empresa').hide();
  $('#frm_nombre_empresa').disableValidation();
  $('#frm_tipo_identificacion_juridico').hide();
  $('#frm_tipo_identificacion_juridico').disableValidation();
  $('#frm_numero_identificacion_juridico').hide();
  $('#frm_numero_identificacion_juridico').disableValidation();

  //oculto y desabilitado documentos
  $('#frm_documentos_natural_cedula').hide();
  $('#frm_documentos_nombramiento').hide();
  $('#frm_documentos_natural_representante_cedula').hide();
  $('#frm_documentos_natural_cedula').disableValidation();
  $('#frm_documentos_nombramiento').disableValidation();
  $('#frm_documentos_natural_representante_cedula').disableValidation();

  if (newValue == 'N') {
    //contratante
    //$("#frm_tipo_identificacion").getControl().attr('disabled', false);
    $('#frm_apellido_paterno').setLabel('Apellido Paterno');
    $('#frm_apellido_materno').setLabel('Apellido Materno');
    $('#frm_primer_nombre').setLabel('Nombres');
    //documentos
    $('#frm_documentos_natural_cedula').show();
    $('#frm_documentos_natural_cedula').enableValidation();
  }

  if (newValue == 'J') {
    //contratante
    $('#frm_tipo_identificacion').setValue('R');
    $("#frm_tipo_identificacion").getControl().attr('disabled', true);
    $('#frm_nombre_empresa').show();
    $('#frm_nombre_empresa').enableValidation();
    $('#frm_tipo_identificacion_juridico').show();
    $('#frm_tipo_identificacion_juridico').enableValidation();
    $('#frm_numero_identificacion_juridico').show();
    $('#frm_numero_identificacion_juridico').enableValidation();
    $('#frm_apellido_paterno').setLabel('Apellido Paterno del Representante Legal');
    $('#frm_apellido_materno').setLabel('Apellido Materno del Representante Legal');
    $('#frm_primer_nombre').setLabel('Nombres del Representante Legal');
    //documentos
    $('#frm_documentos_nombramiento').show();
    $('#frm_documentos_natural_representante_cedula').show();
    $('#frm_documentos_nombramiento').enableValidation();
    $('#frm_documentos_natural_representante_cedula').enableValidation();
  }
}
persona();
$("#frm_tipo_persona").setOnchange(persona);

function acreditacion(newValue, oldValue) {
  var persona = $('#frm_tipo_identificacion').getValue();

  if (newValue == 'C' && persona == 'C') {
    $('#frm_cedula_receptor').setValue($("#frm_numero_identificacion").getValue());
  }

  if (newValue == 'R' && persona == 'R') {
    $('#frm_cedula_receptor').setValue($("#frm_numero_identificacion").getValue());
  }

  if (newValue == 'C' && persona == 'R') {
    var res = $("#frm_numero_identificacion").getValue().substring(0, 10);
    $('#frm_cedula_receptor').setValue(res);
  }

  if (newValue == 'R' && persona == 'C') {
    $('#frm_cedula_receptor').setValue($("#frm_numero_identificacion").getValue() + '001');
  }
}
acreditacion();
$("#frm_tipo_identificacion_receptor").setOnchange(acreditacion);

/*function debito(newValue, oldValue) {
  if(newValue == 'S'){
//asignacion de valores
$('#frm_tipo_identificacion_pagador').setValue($("#frm_tipo_identificacion_receptor").getValue());
  $('#frm_cedula_pagador').setValue($("#frm_cedula_receptor").getValue());
  $('#frm_entidad_financiera').setValue($("#frm_entidad_financiera_receptor").getValue());
  $('#frm_medio_pago').setValue($("#frm_medio_pago_receptor").getValue());
  $('#frm_numero_cuenta').setValue($("#frm_numero_cuenta_receptor").getValue());
  //dsabilitado de campos
  $("#frm_tipo_identificacion_pagador").getControl().attr('disabled', true);
  $("#frm_cedula_pagador").getControl().attr('disabled', true);
  $("#frm_entidad_financiera").getControl().attr('disabled', true);
  $("#frm_medio_pago").getControl().attr('disabled', true);
  $("#frm_numero_cuenta").getControl().attr('disabled', true);
  }

   if(newValue == 'N'){
   //encerar datos
    $('#frm_tipo_identificacion_pagador').setValue("");
  $('#frm_cedula_pagador').setValue("");
  $('#frm_entidad_financiera').setValue("");
  $('#frm_medio_pago').setValue("");
  $('#frm_numero_cuenta').setValue("");
  //habilitar campos
  $("#frm_tipo_identificacion_pagador").getControl().attr('disabled', false);
  $("#frm_cedula_pagador").getControl().attr('disabled', false);
    $("#frm_entidad_financiera").getControl().attr('disabled', false);
  $("#frm_medio_pago").getControl().attr('disabled', false);
  $("#frm_numero_cuenta").getControl().attr('disabled', false);
   }

}
debito();
$("#frm_opcion_debito").setOnchange(debito);*/

function debitacion(newValue, oldValue) {

  var persona = $('#frm_tipo_identificacion').getValue();

  if (newValue == 'C' && persona == 'C') {
    $('#frm_cedula_pagador').setValue($("#frm_numero_identificacion").getValue());
  }

  if (newValue == 'R' && persona == 'R') {
    $('#frm_cedula_pagador').setValue($("#frm_numero_identificacion").getValue());
  }

  if (newValue == 'C' && persona == 'R') {
    var res = $("#frm_numero_identificacion").getValue().substring(0, 10);
    $('#frm_cedula_pagador').setValue(res);
  }

  if (newValue == 'R' && persona == 'C') {
    $('#frm_cedula_pagador').setValue($("#frm_numero_identificacion").getValue() + '001');
  }
}
debitacion();
$("#frm_tipo_identificacion_pagador").setOnchange(debitacion);

function mensaje() {
  if ($("#tri_mes_ConsultaPID").getValue() != '' || $("#tri_mes_CotizaPR").getValue() != '' || $("#tri_mes_ActualizaBPM").getValue() != '') {
    console.log("se ejecuto esto: tri_mes_ConsultaPID en el error");
    window.dynaform.flashMessage({
      duration: 8000,
      emphasisMessage: "ERROR: ",
      message: $("#tri_mes_ConsultaPID").getValue() + ' ' + $("#tri_mes_CotizaPR").getValue() + ' ' + $("#tri_mes_ActualizaBPM").getValue(),
      type: 'danger',
      appendTo: $('#tit_autorizacion')
    })
    console.log("error consulta PID");
  }
  if ($("#tri_accion_bandera").getValue() != '') {
    console.log("se ejecuto esto: tri_accion_bandera en el error");
    window.dynaform.flashMessage({
      duration: 8000,
      emphasisMessage: "WARNING: ",
      message: "POR FAVOR ACTUALIZAR LOS DATOS DE LA COTIZACION PARA CONTINUAR",
      type: 'warning',
      appendTo: $('#tit_autorizacion')
    })
    console.log("error consulta bandera");
  }

}

mensaje();

var primerBancoDebito = '';

$("#ifrm_sbt_acreedor").on("click", function () {
  var tipo_per = $('#frm_tipo_persona').getValue();
  if (tipo_per == 'J') {
    $("#frm_tipo_identificacion_receptor").setValue('R');
    $("#frm_tipo_identificacion_receptor").getControl().attr('disabled', true);
    //$("#frm_cedula_receptor").getControl().attr('disabled', true);
  }
});
$("#frm_sbt_debito").on("click", function () {
  $("#grd_ctas_debito").hide();
  $("#chk_nuevo_banco").hide();

  if ($("#tri_accion_bandera").getValue() == '') {
    $("#frm_medio_pago").setValue('');
    $("#frm_numero_cuenta").setValue('');
  }

  $("#frm_tipo_identificacion_pagador").setValue($("#frm_tipo_identificacion").getValue());
  $("#frm_cedula_pagador").setValue($("#frm_numero_identificacion").getValue());

  var tipo_per = $('#frm_tipo_persona').getValue();
  if (tipo_per == 'J') {
    $("#frm_tipo_identificacion_pagador").setValue('R');
    $("#frm_tipo_identificacion_pagador").getControl().attr('disabled', true);
    $('#frm_cedula_pagador').setValue($("#frm_cedula_receptor").getValue());
    //$("#frm_cedula_pagador").getControl().attr('disabled', true);
  }

  var id_pev_cero = $("#id_pev_cero").getValue();

  if (id_pev_cero != '') {

    $.ajax({
      url: '../beesmartec/services/prestamos_retiros/ajax_pantalla.php',
      data: {
        'funcion': 'consultar_datos_debito',
        'id_pev_cero': id_pev_cero
      },
      type: 'POST',
      beforeSend: function () {
        $("#7609791745f3ca215c123e4098208396").showFormModal();
      },

      success: function (respuesta) {

        var respuestadata = JSON.parse(respuesta);

        if (respuestadata.mensaje == 'false') {
          alert(respuestadata.mensaje_mostrar);
        }
        else {
          primerBancoDebito = '';
          $("#grd_ctas_debito").clear();
          $("#grd_ctas_debito").show();
          $("#chk_nuevo_banco").show();
          $("#chk_nuevo_banco").setValue("0");
          $.each(respuestadata, function (i, item) {
            if (i == 0) {
              primerBancoDebito = item.cod_conducto;
            }
            var aData = [
              { value: item.cod_conducto }, //textbox
              { value: item.sn_cta_corriente }, //checkbox is "1" or "0"
              { value: item.nro_cta_tarj }, //datetime must have "YYYY-MM-DD" or "YYYY-MM-DD HH:MM:SS" format
              { value: "1" }  //file field can't be set
            ];
            $("#grd_ctas_debito").addRow(aData);
            $("#frm_entidad_financiera").disableValidation();
            $("#frm_medio_pago").disableValidation();
            $("#frm_numero_cuenta").disableValidation();
            $("#frm_entidad_financiera").hide();
            $("#frm_medio_pago").hide();
            $("#frm_numero_cuenta").hide();
          });

          if (primerBancoDebito != null && primerBancoDebito != '') {
            $("#frm_entidad_financiera").setValue(primerBancoDebito);
          }
        }
      },
      error: function (xhr, status) {
        alert(status);
        console.log("fallo calcular_datos 374");
      },
      complete: function (xhr, status) {
        $("#7609791745f3ca215c123e4098208396").hideFormModal();
      }
    });
  } else {
    alert("Por favor ingrese los datos requeridos");
  }

});

$("#chk_nuevo_banco").setOnchange(function (newVal, oldVal) {
  //check for version 3.1+ or version 3.0.1.8-
  if (newVal == '1' || newVal == 1 || newVal == '"1"' || newVal == '["1"]' || newVal == 'on' || newVal === true) {
    if ($("#frm_entidad_financiera").getValue() == '' && primerBancoDebito != null && primerBancoDebito != '') {
      $("#frm_entidad_financiera").setValue(primerBancoDebito);
    }
    $("#frm_entidad_financiera").show();
    $("#frm_medio_pago").show();
    $("#frm_numero_cuenta").show();
    $("#frm_entidad_financiera").enableValidation();
    $("#frm_medio_pago").enableValidation();
    $("#frm_numero_cuenta").enableValidation();
  }
  else {
    $("#frm_entidad_financiera").disableValidation();
    $("#frm_medio_pago").disableValidation();
    $("#frm_numero_cuenta").disableValidation();
    $("#frm_entidad_financiera").hide();
    $("#frm_medio_pago").hide();
    $("#frm_numero_cuenta").hide();
  }
});


function consultar_datos() {

  var frm_tipo_solicitud = $("#frm_tipo_solicitud").getValue();
  var frm_sucursal = $("#frm_sucursal").getValue();
  var frm_canal = $("#frm_canal").getValue();
  console.log(frm_canal);
  var frm_numero_poliza = $("#frm_numero_poliza").getValue();
  var frm_numero_endozo_vigente = $("#frm_numero_endozo_vigente").getValue();

  if (frm_tipo_solicitud != '' && frm_sucursal != '' && frm_canal != '' && frm_numero_poliza != '' && frm_numero_endozo_vigente != '') {

    $.ajax({
      url: '../beesmartec/services/prestamos_retiros/ajax_pantalla.php',
      data: {
        'funcion': 'consultar_datos',
        'frm_tipo_solicitud': frm_tipo_solicitud,
        'frm_sucursal': frm_sucursal,
        'frm_canal': frm_canal,
        'frm_numero_poliza': frm_numero_poliza,
        'frm_numero_endozo_vigente': frm_numero_endozo_vigente
      },
      type: 'POST',
      beforeSend: function () {
        $("#7609791745f3ca215c123e4098208396").showFormModal();
      },

      success: function (respuesta) {

        var respuestadata = JSON.parse(respuesta);

        if (respuestadata.mensaje == 'false') {
          alert(respuestadata.mensaje_mostrar);
          $("#id_pev_cero").setValue('');
          $("#cod_aseg").setValue('');
          $("#frm_tipo_identificacion").setValue('');
          $("#frm_numero_identificacion").setValue('');
          $("#frm_apellido_paterno").setValue('');
          $("#frm_apellido_materno").setValue('');
          $("#frm_primer_nombre").setValue('');
          $("#frm_monto_disponible").setValue('');
          $("#frm_monto_actual").setValue('');
          $("#frm_tasa_calc").setValue('');
        }
        else {
          $("#id_pev_cero").setValue(respuestadata.datos.id_pv_cero);
          $("#cod_aseg").setValue(respuestadata.datos.cod_aseg);
          $("#frm_tipo_identificacion").setValue(respuestadata.datos.cod_tipo_doc);
          $("#frm_numero_identificacion").setValue(respuestadata.datos.nro_doc);
          if (respuestadata.datos.codPersonType == 'J') {
            $("#frm_nombre_empresa").setValue(respuestadata.datos.txt_apellido1);
            $("#frm_tipo_persona").setValue(respuestadata.datos.codPersonType);
            persona(respuestadata.datos.codPersonType, '');
            $("#frm_apellido_paterno").getControl().attr('disabled', false);
            $("#frm_apellido_materno").getControl().attr('disabled', false);
            $("#frm_primer_nombre").getControl().attr('disabled', false);
            //$("#frm_apellido_paterno").setValue(".");
            //$("#frm_apellido_materno").setValue(".");
            //$("#frm_primer_nombre").setValue(".");
          } else {
            $("#frm_tipo_persona").setValue(respuestadata.datos.codPersonType);
            persona(respuestadata.datos.codPersonType, '');
            $("#frm_apellido_paterno").setValue(respuestadata.datos.txt_apellido1);
            $("#frm_apellido_materno").setValue(respuestadata.datos.txt_apellido2);
            $("#frm_primer_nombre").setValue(respuestadata.datos.txt_nombres);
          }
          switch (respuestadata.datos.cod_tipo_doc) {
            case "R":
              $('#frm_tipo_identificacion_receptor').getControl().empty();
              $('#frm_tipo_identificacion_receptor').getControl().append(new Option("CEDULA", "C"));
              $('#frm_tipo_identificacion_receptor').getControl().append(new Option("RUC", "R"));

              $('#frm_tipo_identificacion_pagador').getControl().empty();
              $('#frm_tipo_identificacion_pagador').getControl().append(new Option("CEDULA", "C"));
              $('#frm_tipo_identificacion_pagador').getControl().append(new Option("RUC", "R"));

              $("#frm_tipo_identificacion_receptor").setValue(respuestadata.datos.cod_tipo_doc);
              $("#frm_cedula_receptor").setValue(respuestadata.datos.nro_doc);
              //dejar habilitado datos
              $("#frm_tipo_identificacion_receptor").getControl().attr('disabled', false);
              //$("#frm_cedula_receptor").getControl().attr('disabled', false);
              $("#frm_tipo_identificacion_pagador").getControl().attr('disabled', false);
              //$("#frm_cedula_pagador").getControl().attr('disabled', false);
              break;
            case "C":
              $('#frm_tipo_identificacion_receptor').getControl().empty();
              $('#frm_tipo_identificacion_receptor').getControl().append(new Option("CEDULA", "C"));
              $('#frm_tipo_identificacion_receptor').getControl().append(new Option("RUC", "R"));

              $('#frm_tipo_identificacion_pagador').getControl().empty();
              $('#frm_tipo_identificacion_pagador').getControl().append(new Option("CEDULA", "C"));
              $('#frm_tipo_identificacion_pagador').getControl().append(new Option("RUC", "R"));

              $("#frm_tipo_identificacion_receptor").setValue(respuestadata.datos.cod_tipo_doc);
              $("#frm_cedula_receptor").setValue(respuestadata.datos.nro_doc);
              //dejar habilitado datos
              $("#frm_tipo_identificacion_receptor").getControl().attr('disabled', false);
              //$("#frm_cedula_receptor").getControl().attr('disabled', false);
              $("#frm_tipo_identificacion_pagador").getControl().attr('disabled', false);
              //$("#frm_cedula_pagador").getControl().attr('disabled', false);
              break;
            case "P":
              $('#frm_tipo_identificacion_receptor').getControl().empty();
              $('#frm_tipo_identificacion_receptor').getControl().append(new Option("PASAPORTE", "P"));

              $('#frm_tipo_identificacion_pagador').getControl().empty();
              $('#frm_tipo_identificacion_pagador').getControl().append(new Option("PASAPORTE", "P"));

              $("#frm_tipo_identificacion_receptor").setValue(respuestadata.datos.cod_tipo_doc);
              $("#frm_cedula_receptor").setValue(respuestadata.datos.nro_doc);
              //desabilitar datos
              $("#frm_tipo_identificacion_receptor").getControl().attr('disabled', true);
              //$("#frm_cedula_receptor").getControl().attr('disabled', true);
              $("#frm_tipo_identificacion_pagador").getControl().attr('disabled', true);
              $("#frm_cedula_pagador").setValue(respuestadata.datos.nro_doc);
              //$("#frm_cedula_pagador").getControl().attr('disabled', true);
              break;
          }

          //            $('#3481439505f3d658c99b673065865401').toggle(); //acreditar
          //			$('#3420420135f3cad48cf08a7020087388').toggle(); //debitar

          $("#frm_monto_disponible").setValue(respuestadata.datos.imp_monto_disponible);
          $("#frm_monto_actual").setValue(respuestadata.datos.imp_monto_actual);
          $("#frm_tasa_calc").setValue(respuestadata.datos.tasa_interes);

          $("#frm_cod_tipoAgente").setValue(respuestadata.datos.codTypeAgent);
          //$("#frm_tipo_agente").setValue(respuestadata.datos.typeAgent);
          $("#frm_cod_agente").setValue(respuestadata.datos.codAgent);
          $("#frm_agente").setValue(respuestadata.datos.agent);
          $("#frm_canal_venta").setValue(respuestadata.datos.canalVenta);
          $("#frm_linea_negocio").setValue(respuestadata.datos.lineaVenta);
          $("#frm_sublinea_negocio").setValue(respuestadata.datos.sublineaVenta);


          //validacion de datos de consulta
          $('#frm_monto_disponible').show();
          if (frm_tipo_solicitud == 'P')
            $('#frm_tasa_calc').show();
          else {
            //$('#frm_monto_actual').show();
          }
          $('#btn_calcular').show();
        }
      },
      error: function (xhr, status) {
        alert(status);
        console.log("fallo calcular_datos 552");
      },
      complete: function (xhr, status) {
        $("#7609791745f3ca215c123e4098208396").hideFormModal();
      }
    });
  } else {
    alert("Por favor ingrese los datos requeridos");
  }
}

$("#btn_consultar").find("button").on("click", function () {
  consultar_datos();
});


function calcular_datos() {

  $("#frm_costo_retiro").setValue("");
  $("#frm_derecho_retiro").setValue("");
  $("#frm_val_descontado").setValue("");
  $("#imp_valor_rescate").setValue("");

  var frm_tipo_solicitud = $("#frm_tipo_solicitud").getValue();
  var id_pev_cero = $("#id_pev_cero").getValue();
  var frm_monto_prestamo = $("#frm_monto_prestamo").getValue();
  //para retiros
  var frm_monto = $("#frm_monto").getValue();
  var frm_monto_disponible = $("#frm_monto_disponible").getValue();
  var frm_monto_actual = $("#frm_monto_actual").getValue();

  var frm_plazo_prestamo = $("#frm_plazo_prestamo").getValue();
  var frm_frecuencia_pago = $("#frm_frecuencia_pago").getValue();
  var frm_tipo_identificacion = $("#frm_tipo_identificacion").getValue();
  var frm_numero_identificacion = $("#frm_numero_identificacion").getValue();
  var frm_correo_electronico_receptor = $("#frm_correo_electronico_receptor").getValue();
  var frm_celular_receptor = $("#frm_celular_receptor").getValue();
  var frm_tasa_calc = $("#frm_tasa_calc").getValue();
  var chk_vencimiento = $("#chk_vencimiento").getValue();
  if ($("#frm_tipo_identificacion").getValue() == 'R') {
    var repLegalItendificationType = $("#frm_tipo_identificacion_juridico").getValue();
    var repLegalIdentification = $("#frm_numero_identificacion_juridico").getValue();
    var lastnameRepLegal = $("#frm_apellido_paterno").getValue();
    var secondLastnameRepLegal = $("#frm_apellido_materno").getValue();
    var nameRepLegal = $("#frm_primer_nombre").getValue();
    var sourceType = 2;
  } else {
    var repLegalItendificationType = '';
    var repLegalIdentification = '';
    var lastnameRepLegal = '';
    var secondLastnameRepLegal = '';
    var nameRepLegal = '';
    var sourceType = 2;
  }
  if (frm_tipo_solicitud == 'R') {
    if (frm_tipo_solicitud != '' && frm_monto != '' && frm_correo_electronico_receptor != '' && frm_celular_receptor != '') {

      $.ajax({
        url: '../beesmartec/services/prestamos_retiros/ajax_pantalla.php',
        data: {
          'funcion': 'calcular_datos',
          'frm_tipo_solicitud': frm_tipo_solicitud,
          'id_pev_cero': id_pev_cero,
          'frm_monto': frm_monto,
          'frm_monto_disponible': frm_monto_disponible,
          'frm_monto_actual': frm_monto_actual,
          'frm_tipo_identificacion': frm_tipo_identificacion,
          'frm_numero_identificacion': frm_numero_identificacion,
          'frm_correo_electronico_receptor': frm_correo_electronico_receptor,
          'frm_celular_receptor': frm_celular_receptor,
          'repLegalItendificationType': repLegalItendificationType,
          'repLegalIdentification': repLegalIdentification,
          'lastnameRepLegal': lastnameRepLegal,
          'secondLastnameRepLegal': secondLastnameRepLegal,
          'nameRepLegal': nameRepLegal,
          'sourceType': sourceType
        },
        type: 'POST',
        beforeSend: function () {
          $("#7609791745f3ca215c123e4098208396").showFormModal();
        },

        success: function (respuesta) {

          var respuestadata = JSON.parse(respuesta);

          if (respuestadata.mensaje == 'false') {
            alert(respuestadata.mensaje_mostrar);
            $("#frm_total_capital").setValue('');
            $("#frm_total_interes").setValue('');
            $("#frm_total_pagar").setValue('');
            $("#tri_table_amor").setValue('');
            $("#tabla_amor").html("");
            $("#frm_monto").setValue('');
          }
          else {
            if (frm_tipo_solicitud == 'P') {
              $("#frm_valor_inicial").setValue(respuestadata.frm_valor_inicial.toFixed(2));
              $("#frm_total_capital").setValue(respuestadata.frm_total_capital.toFixed(2));
              $("#frm_total_interes").setValue(respuestadata.frm_total_interes.toFixed(2));
              $("#frm_total_pagar").setValue(respuestadata.frm_total_pagar.toFixed(2));
              $("#tri_table_amor").setValue(respuestadata.tri_table_amor);
              $("#tabla_amor").html(respuestadata.tri_table_amor);
              $('#frm_total_capital').show();
              $('#frm_total_interes').show();
              $('#frm_total_pagar').show();
              $('#pnl_tabla_amortizacion').show();
            } else {
              $("#frm_costo_retiro").setValue(respuestadata.imp_cargos_x_retiro);
              $("#frm_derecho_retiro").setValue(respuestadata.imp_penalidad);
              $("#frm_val_descontado").setValue(respuestadata.frm_val_descontado);
              $("#imp_valor_rescate").setValue(respuestadata.imp_valor_rescate);
              $('#frm_costo_retiro').show();
              $('#frm_derecho_retiro').show();
              $('#frm_val_descontado').show();
            }
          }
        },
        error: function (xhr, status) {
          alert(status);
          console.log("fallo calcular_datos 680");
        },
        complete: function (xhr, status) {
          $("#7609791745f3ca215c123e4098208396").hideFormModal();
        }
      });
    } else {
      alert("Por favor ingrese los datos requeridos");
    }

  } else {
    if (frm_tipo_solicitud != '' && frm_monto_prestamo != '' && frm_plazo_prestamo != '' && frm_frecuencia_pago != '' && frm_correo_electronico_receptor != '' && frm_celular_receptor != '') {

      $.ajax({
        url: '../beesmartec/services/prestamos_retiros/ajax_pantalla.php',
        data: {
          'funcion': 'calcular_datos',
          'frm_tipo_solicitud': frm_tipo_solicitud,
          'id_pev_cero': id_pev_cero,
          'frm_monto_prestamo': frm_monto_prestamo,
          'frm_plazo_prestamo': frm_plazo_prestamo,
          'frm_frecuencia_pago': frm_frecuencia_pago,
          'frm_tipo_identificacion': frm_tipo_identificacion,
          'frm_numero_identificacion': frm_numero_identificacion,
          'frm_correo_electronico_receptor': frm_correo_electronico_receptor,
          'frm_celular_receptor': frm_celular_receptor,
          'frm_tasa_calc': frm_tasa_calc,
          'chk_vencimiento': chk_vencimiento,
          'repLegalItendificationType': repLegalItendificationType,
          'repLegalIdentification': repLegalIdentification,
          'lastnameRepLegal': lastnameRepLegal,
          'secondLastnameRepLegal': secondLastnameRepLegal,
          'nameRepLegal': nameRepLegal,
          'sourceType': sourceType
        },
        type: 'POST',
        beforeSend: function () {
          $("#7609791745f3ca215c123e4098208396").showFormModal();
        },

        success: function (respuesta) {

          var respuestadata = JSON.parse(respuesta);

          if (respuestadata.mensaje == 'false') {
            alert(respuestadata.mensaje_mostrar);
            $("#frm_total_capital").setValue('');
            $("#frm_total_interes").setValue('');
            $("#frm_total_pagar").setValue('');
            $("#tri_table_amor").setValue('');
            $("#tabla_amor").html("");
            $("#frm_monto_prestamo").setValue('');
          }
          else {
            if (frm_tipo_solicitud == 'P') {
              $("#frm_valor_inicial").setValue(respuestadata.frm_valor_inicial.toFixed(2));
              $("#frm_total_capital").setValue(respuestadata.frm_total_capital.toFixed(2));
              $("#frm_total_interes").setValue(respuestadata.frm_total_interes.toFixed(2));
              $("#frm_total_pagar").setValue(respuestadata.frm_total_pagar.toFixed(2));
              $("#tri_table_amor").setValue(respuestadata.tri_table_amor);
              $("#tabla_amor").html(respuestadata.tri_table_amor);
              $('#frm_total_capital').show();
              $('#frm_total_interes').show();
              $('#frm_total_pagar').show();
              $('#pnl_tabla_amortizacion').show();
            } else {
              $('#frm_costo_retiro').show();
              $('#frm_derecho_retiro').show();
              $('#frm_val_descontado').show();
            }
          }
        },
        error: function (xhr, status) {
          alert(status);
          console.log("fallo calcular_datos 756");
        },
        complete: function (xhr, status) {
          $("#7609791745f3ca215c123e4098208396").hideFormModal();
        }
      });
    } else {
      alert("Por favor ingrese los datos requeridos");
    }
  }
}

$("#btn_calcular").find("button").on("click", function () {
  calcular_datos();
});

// Evento para chk_vencimiento: controlar frm_plazo_prestamo
$("#chk_vencimiento").setOnchange(function (newValue, oldValue) {
  console.log("chk_vencimiento cambió a: " + newValue);
  if (newValue == 'on' || newValue == '1' || newValue == true || newValue === true) {
    // Checkbox activado: establecer plazo en 1 y bloquear
    $("#frm_plazo_prestamo").setValue('1');
    $("#frm_plazo_prestamo").getControl().attr('disabled', true);
    console.log("frm_plazo_prestamo bloqueado en 1");
  } else {
    // Checkbox desactivado: desbloquear el campo
    $("#frm_plazo_prestamo").getControl().attr('disabled', false);
    console.log("frm_plazo_prestamo desbloqueado");
  }
});


