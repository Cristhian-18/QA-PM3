 var appNumber = (function() {
    const casoTab = window.parent.document.querySelector(".x-tab-strip-text");
    return casoTab?.innerText.match(/\d+/)?.[0] || null;
})();

 var token = $("#token_portal").getValue();
 sessionStorage.setItem('token', token);


$("#frm_monto_asegurado").hide();
function tipo_asegurado(newValue) {
  //ocultar
  if (newValue == 'O') {
    $("#frm_tipo_documento_fallecido").show();
    $("#frm_documento_fallecido").show();
    $("#frm_apellido_paterno_fallecido").show();
    $("#frm_apellido_materno_fallecido").show();
    $("#frm_nombres_fallecido").show();
    $("#frm_parentesco_fallecido").show();
    $("#frm_fecha_nacimiento_fallecido").show();
    $("#frm_genero_fallecido").show();
  } else {
    $("#frm_tipo_documento_fallecido").hide();
    $("#frm_documento_fallecido").hide();
    $("#frm_apellido_paterno_fallecido").hide();
    $("#frm_apellido_materno_fallecido").hide();
    $("#frm_nombres_fallecido").hide();
    $("#frm_parentesco_fallecido").hide();
    $("#frm_fecha_nacimiento_fallecido").hide();
    $("#frm_genero_fallecido").hide();
  }
}

tipo_asegurado($("#frm_tipo_asegurado").getValue());
$("#frm_tipo_asegurado").setOnchange(tipo_asegurado);

function Monto_liquidar() {
  $("#frm_cambio_estimacion").hide();

  if ($("#tri_bandera_parcial").getValue() == 'true') {
    $("#frm_monto_liquidar").getControl().attr('disabled', true);
    $("#frm_tipo_asegurado").getControl().attr('disabled', true);
    $("#frm_fecha_ocurrencia_auditor").getControl().attr('disabled', true);
    $("#frm_pais_ocurrencia").getControl().attr('disabled', true);
    $("#frm_provincia_ocurrencia").getControl().attr('disabled', true);
    $("#frm_causa_siniestro").getControl().attr('disabled', true);
    $("#frm_edad_asegurado").getControl().attr('disabled', true);
    $("#frm_genero_asegurado").getControl().attr('disabled', true);
    $("#frm_fecha_concesion").getControl().attr('disabled', true);
    $("#frm_fecha_vencimiento").getControl().attr('disabled', true);
    $("#frm_plazo_credito").getControl().attr('disabled', true);
    $("#frm_forma_pago").getControl().attr('disabled', true);
    $("#frm_num_at").getControl().attr('disabled', true);
    $("#frm_tipo_pago").getControl().attr('disabled', true);

    $("#frm_cambio_estimacion").show();
  } else {
    if ($("#tri_bandera_alcance").getValue() == '') {
      var txt_cober = $("#frm_coberturas").getValue();
      var arr_cober = txt_cober.split("|");
      var indice = arr_cober[0];

      //renta
      if (indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507 || indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456) {

        if ($("#tri_bandera_monto").getValue() == 'true') {
          $("#frm_monto_liquidar").setValue($("#frm_monto_aprobado").getValue());
          $("#frm_monto_liquidar").getControl().attr('disabled', true);
        } else {
          if (($("#frm_monto_liquidar").getValue() * 1) > ($("#frm_monto_reportado").getValue() * 1)) {
            alert("No puede reportar un monto mayor al asegurado");
            $("#frm_monto_liquidar").setValue('0.00');
          }
        }
      } else {
        if ($("#tri_bandera_monto").getValue() == 'true') {
          $("#frm_monto_liquidar").setValue($("#frm_monto_aprobado").getValue());
          $("#frm_monto_liquidar").getControl().attr('disabled', true);
        } else {
          if (($("#frm_monto_asegurado").getValue() * 1) == 0) {
            //$("#frm_monto_liquidar").setValue($("#frm_monto_reportado").getValue());
            //$("#frm_monto_liquidar").setValue($("#frm_monto_reportado").getValue());
            try {
              $("#frm_monto_liquidar").getControl().attr('disabled', true);

            } catch (e) {
            }
          } else {
            if (($("#frm_monto_liquidar").getValue() * 1) > ($("#frm_monto_asegurado").getValue() * 1)) {
              alert("No puede reportar un monto mayor al asegurado");
              $("#frm_monto_liquidar").setValue('0.00');
            }
          }
        }
      }
    }
  }

}

Monto_liquidar();
$("#frm_monto_liquidar").focusout(Monto_liquidar);


function datos_validaciones(indice) {
  $('#frm_conoce_monto').hide();
  $('#frm_porcentaje_aplica').hide();
  $('#frm_conoce_dias').hide();
  $('#frm_aplica_dias').hide();
  $('#frm_conoce_cuotas').hide();
  $('#frm_aplica_cuotas').hide();
  $('#frm_valor_cuota').hide();
  if (indice == 0) {
    $('#frm_conoce_monto').hide();
    $('#frm_porcentaje_aplica').hide();
    $('#frm_conoce_dias').hide();
    $('#frm_aplica_dias').hide();
  } else {
    //gastos
    if (indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470) {
      $('#frm_conoce_monto').show();
      $('#frm_porcentaje_aplica').show();
    } else {
      //renta
      if (indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456) {
        $('#frm_conoce_dias').show();
        $('#frm_aplica_dias').show();
      } else {
        //desempleo
        if (indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507) {
          $('#frm_conoce_cuotas').show();
          $('#frm_aplica_cuotas').show();
          $('#frm_valor_cuota').show();
        } else {
          datos_validaciones(0);
        }
      }
    }
  }

}


var txt_cober = $("#frm_coberturas").getValue();
var arr_cober = txt_cober.split("|");
var indice = arr_cober[0];
datos_validaciones(indice);


function estimacion(newValue, oldValue) {

  if (newValue == 'SI') {
    $("#frm_monto_liquidar").getControl().attr('disabled', false);
    $("#frm_monto_liquidar").disableValidation;
  }

  if (newValue == 'NO') {
    $("#frm_monto_liquidar").getControl().attr('disabled', true);
  }
}
estimacion();
$("#frm_cambio_estimacion").setOnchange(estimacion);

function limpiar_datos_fallecido() {
  $('#frm_apellido_paterno_fallecido').setValue('');
  $('#frm_apellido_materno_fallecido').setValue('');
  $('#frm_nombres_fallecido').setValue('');
  $('#frm_parentesco_fallecido').setValue('');
  $('#frm_fecha_nacimiento_fallecido').setValue('');
  $('#frm_genero_fallecido').setValue('');
  $('#frm_cod_aseg_fallecido').setValue('');
  $('#frm_id_cns_fallecido').setValue('');
  $('#frm_id_persona_fallecido').setValue('');
}

$("#frm_documento_fallecido").focusout(function () {
  limpiar_datos_fallecido();
  var frm_tipo_documento_fallecido = $('#frm_tipo_documento_fallecido').getValue();
  var frm_documento_fallecido = $('#frm_documento_fallecido').getValue();

  if (frm_documento_fallecido != '') {
    $.ajax({
      url: '../beesmartec/services/siniestrosVida/ajax_pantalla.php',
      data: {
        'funcion': 'consultar_datos_fallecido',
        'frm_tipo_documento_fallecido': frm_tipo_documento_fallecido,
        'frm_documento_fallecido': frm_documento_fallecido,
        'frm_tipo_cns': 1,
        'frm_token': sessionStorage.getItem('token'),
        'app_number': appNumber
      },
      type: 'POST',
      beforeSend: function () {
        $("#19704822661d89a84dc5eb6067966042").showFormModal();
      },

      success: function (respuesta) {

        var respuestadata = JSON.parse(respuesta);

        if (respuestadata.mensaje == 'false') {
          alert(respuestadata.mensaje_mostrar);
          limpiar_datos_fallecido();
        }
        else {
          $('#frm_apellido_paterno_fallecido').setValue(respuestadata.txt_apellido1_deudor);
          $('#frm_apellido_materno_fallecido').setValue(respuestadata.txt_apellido2_deudor);
          $('#frm_nombres_fallecido').setValue(respuestadata.txt_nombre_deudor);
          if (respuestadata.cod_parentesco == 0)
            respuestadata.cod_parentesco = '';
          $('#frm_parentesco_fallecido').setValue(respuestadata.cod_parentesco);
          $('#frm_cod_aseg_fallecido').setValue(respuestadata.cod_aseg);
          $('#frm_id_cns_fallecido').setValue(respuestadata.id_cns_codeudor);
          $('#frm_id_persona_fallecido').setValue(respuestadata.id_persona);

          var text = respuestadata.fec_nac;
          var result_naci = text.substring(0, 10);
          var result_naci = result_naci.split("/");
          var dia = result_naci[0];
          var mes = result_naci[1];
          var anio = result_naci[2];

          var result_naci_t = anio + '-' + mes + '-' + dia;

          $('#frm_fecha_nacimiento_fallecido').setValue(result_naci_t);
          $('#frm_fecha_nacimiento_fallecido').setText(result_naci_t);
          $('#frm_genero_fallecido').setValue(respuestadata.sexo);
        }
      },
      error: function (xhr, status) {
        alert(status);
      },
      complete: function (xhr, status) {
        $("#19704822661d89a84dc5eb6067966042").hideFormModal();
      }
    });
  } else {
    alert("Por favor ingrese los datos requeridos");
  }
});




