// =============================================
// INICIALIZACIÓN
// =============================================
var appNumber = (function() {
    const casoTab = window.parent.document.querySelector(".x-tab-strip-text");
    return casoTab?.innerText.match(/\d+/)?.[0] || null;
})();

 

var consulta = $("#consultaExterior").getValue();
if (consulta == 1) {
    $(document).ready(function () {
        var session = sessionStorage.getItem('sesion-usuario');
        var nombre  = sessionStorage.getItem('nombre');
        var usuario = sessionStorage.getItem('usuario');
        var correo  = sessionStorage.getItem('correo');

        // Sin sesión → inválido
        if (!session) {
            window.location.href = '/syscertificacion/es/3sesa/beesmartec/services/portal/invalido.php';
            return;
        }

        // Faltan datos pero ya intentamos redirigir antes → evitar bucle
        if (session && (!nombre || !usuario || !correo)) {
            if (sessionStorage.getItem('redirect_intentado')) {
                // Ya se intentó una vez y aún faltan datos → inválido
                sessionStorage.removeItem('redirect_intentado');
                window.location.href = '/syscertificacion/es/3sesa/beesmartec/services/portal/invalido.php';
                return;
            }
            sessionStorage.setItem('redirect_intentado', '1');
            window.location.href = '/syscertificacion/es/3sesa/beesmartec/services/portal/redirector_siniestros.php?sesion-usuario=' + session;
            return;
        }

        // Todo OK → limpiar flag, llenar campos y limpiar datos sensibles
        sessionStorage.removeItem('redirect_intentado');
        sessionStorage.removeItem('nombre');
        sessionStorage.removeItem('usuario');
        sessionStorage.removeItem('correo');

        $("#frm_session_token").setValue(session);
        $("#frm_nombre_portal").setValue(nombre);
        $("#frm_usuario_portal").setValue(usuario);
        $("#frm_correo_portal").setValue(correo);
    });
} else {
    var token = $("#token_portal").getValue();
    sessionStorage.setItem('token', token);
}
$("#grdInfoContratantePoliza").hide();
$("#dyn_backward").hide();
$("#chk_documentos").hide();
$("img[src='/images/bulletButtonLeft.gif']").hide();
$("#b_modal").click();

$("#frm_sbt_documentos").hide();
$("#41383009861d6fda8bfc0e4083116599").hide();
$("#pnl_datareturn").hide();

$("#ifrm_sbt_datSiniestros").hide();
$("#35181779861e95fb4b89895043554708").hide();
$("#ifrm_sbt_datAsegurado").hide();
$("#13722500361d66707a60381015639101").hide();
$("#frm_sbt_docs").hide();
$("#55241990862ba1704c23881005873211").hide();
$("#sbt_atencion").hide();
$("#frm_accion").hide();
$("#frm_comentario").hide();
$("#btn_enviar").hide();
$("#frm_coberturas").hide();

$("#frm_cie_siniestro").setValue("");
$("#frm_causa_siniestro").setValue("");
$("#frm_causa_siniestro_label").setValue("");
$("#tri_id_stro").setValue("");
$("#tri_nro_stro").setValue("");

$("#frm_polizas").getControl().empty();
$("#frm_polizas").getControl().append(new Option("--- Seleccione ---", ""));
$("#frm_coberturas").getControl().empty();
$("#frm_coberturas").getControl().append(new Option("--- Seleccione ---", ""));

if ($("#tri_bandera_sac").getValue() == "true") {
  $("#frm_sbt_historial").show();
  $("#22934569061d6fd88f0d814094422539").show();
  $("#frm_sbt_documentos").show();
  $("#41383009861d6fda8bfc0e4083116599").show();
}

// =============================================
// UTILIDADES GENERALES
// =============================================

var modalVisible = false;

function clearGrid(grd_name) {
  var rows = $("#" + grd_name).getNumberRows();
  for (var i = 1; i < rows; i++) {
    $("#" + grd_name).deleteRow();
  }
  var aValues = $("#" + grd_name).getValue();
  for (var col = 1; col <= aValues[0].length; col++) {
    $("#" + grd_name).setValue("", 1, col);
  }
}

function mostrarSeccionPrincipal() {
  $("#ifrm_sbt_datSiniestros").show();
  $("#35181779861e95fb4b89895043554708").show();
  $("#ifrm_sbt_datAsegurado").show();
  $("#13722500361d66707a60381015639101").show();
  $("#frm_sbt_docs").show();
  $("#55241990862ba1704c23881005873211").show();
  $("#sbt_atencion").show();
  $("#frm_comentario").show();
  $("#btn_enviar").show();
}

function mensaje() {
  if ($("#tri_message_grabado").getValue() != "") {
    window.dynaform.flashMessage({
      duration: 8000,
      emphasisMessage: "ERROR: ",
      message: $("#tri_message_grabado").getValue(),
      type: "danger",
      appendTo: $("#title0000000001"),
    });
  }
}

mensaje();

// =============================================
// LÓGICA DE COBERTURAS (extraída para evitar duplicación)
// =============================================

/**
 * Habilita el campo correcto en el grid de coberturas según el índice de cobertura.
 * Centraliza la lógica que antes estaba duplicada 4-5 veces.
 */
function habilitarCampoPorIndice(rowNo_g, indice) {
  // Gastos médicos
  if ([5, 14, 21, 31, 50, 51, 61, 147, 148, 269, 442, 470].indexOf(parseInt(indice)) !== -1) {
    $("#form\\[grd_coberturas\\]\\[" + rowNo_g + "\\]\\[grd_txt_conoce_monto\\]").prop("disabled", false);
    alert("Por favor seleccione si conoce el monto \n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
    return;
  }
  // Renta
  if ([6, 19, 39, 18, 48, 52, 53, 293, 311, 456].indexOf(parseInt(indice)) !== -1) {
    $("#form\\[grd_coberturas\\]\\[" + rowNo_g + "\\]\\[grd_txt_conoce_dias\\]").prop("disabled", false);
    alert("Por favor seleccione si conoce los dias \n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
    return;
  }
  // Desempleo
  if ([4, 15, 149, 268, 339, 507, 552, 564, 758, 583, 719, 737].indexOf(parseInt(indice)) !== -1) {
    $("#form\\[grd_coberturas\\]\\[" + rowNo_g + "\\]\\[grd_txt_conoce_vcuota\\]").prop("disabled", false);
    alert("Por favor seleccione si conoce el valor de la cuota\n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
    return;
  }
  // Valor directo
  $("#form\\[grd_coberturas\\]\\[" + rowNo_g + "\\]\\[grd_txt_valor\\]").prop("disabled", false);
  $("#grd_coberturas").setValue($("#grd_coberturas").getValue(rowNo_g, 2), rowNo_g, 11);
}

// =============================================
// BÚSQUEDA POR TIPO
// =============================================

function busqueda(newValue, oldValue) {
  $("#frm_tipo_documento").disableValidation();
  $("#frm_numero_identificacion").disableValidation();
  $("#frm_numero_poliza").disableValidation();
  $("#frm_sucursal").disableValidation();
  $("#frm_ramo").disableValidation();
  $("#frm_contratante").disableValidation();
  $("#frm_broker").disableValidation();

  $("#frm_tipo_documento").hide();
  $("#frm_numero_identificacion").hide();
  $("#frm_numero_poliza").hide();
  $("#frm_sucursal").hide();
  $("#frm_ramo").hide();
  $("#btn_consultar_i").hide();
  $("#btn_consultar_p").hide();
  $("#frm_apellido_paterno").hide();
  $("#frm_apellido_materno").hide();
  $("#frm_nombres").hide();
  $("#frm_contratante").hide();
  $("#frm_broker").hide();
  $("#frm_dias_respuesta").hide();
  $("#frm_monto_reportado").hide();

  if (newValue == "ID") {
    $("#frm_tipo_documento").enableValidation();
    $("#frm_numero_identificacion").enableValidation();
    $("#frm_tipo_documento").show();
    $("#frm_numero_identificacion").show();
    $("#btn_consultar_i").show();
    $("#frm_accion").getControl().empty();
    $("#frm_accion").getControl().append(new Option("--- Seleccione ---", ""));
    $("#frm_accion").getControl().append(new Option("Continuar con la creacion del siniestro", "CONTINUAR"));
    $("#frm_accion").getControl().append(new Option("Guardar el caso", "GUARDAR"));
  }

  if (newValue == "Poliza") {
    $("#frm_numero_poliza").enableValidation();
    $("#frm_sucursal").enableValidation();
    $("#frm_ramo").enableValidation();
    $("#frm_contratante").enableValidation();
    $("#frm_broker").enableValidation();
    $("#frm_tipo_documento").show();
    $("#frm_numero_identificacion").show();
    $("#frm_numero_poliza").show();
    $("#frm_sucursal").show();
    $("#frm_ramo").show();
    $("#frm_apellido_paterno").show();
    $("#frm_apellido_materno").show();
    $("#frm_nombres").show();
    $("#frm_contratante").show();
    $("#frm_broker").show();
    $("#frm_apellido_paterno").getControl().attr("disabled", false);
    $("#frm_apellido_materno").getControl().attr("disabled", false);
    $("#frm_nombres").getControl().attr("disabled", false);
    $("#frm_contratante").getControl().attr("disabled", false);
    $("#frm_broker").getControl().attr("disabled", false);
    mostrarSeccionPrincipal();
    $("#frm_polizas").disableValidation();
    $("#frm_coberturas").disableValidation();
    $("#frm_accion").getControl().empty();
    $("#frm_accion").getControl().append(new Option("--- Seleccione ---", ""));
    $("#frm_accion").getControl().append(new Option("Continuar con la Negacion del Siniestro", "NEGAR"));
  }
}

$("#frm_tipo_busqueda").setValue("ID");
busqueda("ID", "");
$("#frm_tipo_busqueda").setOnchange(busqueda);

// =============================================
// LIMPIAR DATOS
// =============================================

function limpiar_datos() {
  $("#frm_reclamante").disableValidation();
  $("#frm_contratante").setValue("");
  $("#frm_apellido_paterno").setValue("");
  $("#frm_apellido_materno").setValue("");
  $("#frm_nombres").setValue("");
}

function limpiar_datos_asegurado() {
  $("#frm_reclamante").disableValidation();
  $("#frm_tipo_asegurado").setValue("");
  $("#frm_pais_ocurrencia").setValue("");
  $("#frm_provincia_ocurrencia").setValue("");
  $("#frm_causa_siniestro_label").setValue("");
  $("#frm_causa_siniestro").setValue("");
  $("#frm_cie_siniestro").setValue("");
  $("#frm_edad_asegurado").setValue("");
  $("#frm_genero_asegurado").setValue("");
}

function limpiar_datos_fallecido() {
  $("#frm_apellido_paterno_fallecido").setValue("");
  $("#frm_apellido_materno_fallecido").setValue("");
  $("#frm_nombres_fallecido").setValue("");
  $("#frm_parentesco_fallecido").setValue("");
  $("#frm_fecha_nacimiento_fallecido").setValue("");
  $("#frm_genero_fallecido").setValue("");
  $("#frm_cod_aseg_fallecido").setValue("");
  $("#frm_id_cns_fallecido").setValue("");
  $("#frm_id_persona_fallecido").setValue("");
}

// =============================================
// CONSULTA PRINCIPAL DE DATOS
// =============================================

function consultar_datos() {
  var frm_fecha_ocurrencia = $("#frm_fecha_ocurrencia").getValue();
  var frm_tipo_documento = $("#frm_tipo_documento").getValue();
  var frm_numero_identificacion = $("#frm_numero_identificacion").getValue();
  var frm_numero_poliza_pvcero = $("#frm_numero_poliza_pvcero").getValue();
  var frm_numero_poliza_b = $("#frm_numero_poliza_b").getValue();
  var frm_tipo_doc_contratante = $("#frm_tipo_doc_contratante").getValue();
  var frm_contratante_numero_identificacion = $("#frm_contratante_numero_identificacion").getValue();
  var tri_user_sac_uname = $("#tri_user_sac_uname").getValue();

  $("#frm_polizas").getControl().empty();
  $("#frm_polizas").getControl().append(new Option("--- Seleccione ---", ""));
  $("#datareturn").html("");

  clearGrid("grd_coberturas");
  clearGrid("grd_siniestros_alcances");
  clearGrid("grd_siniestros_registrados");

  if (
    frm_fecha_ocurrencia != "" &&
    frm_tipo_documento != "" &&
    frm_numero_poliza_pvcero != "" &&
    frm_numero_identificacion != "" &&
    frm_contratante_numero_identificacion != ""
  ) {
    $.ajax({
      url: "../beesmartec/services/siniestrosVida/ajax_pantalla.php",
      data: {
        funcion: "consultar_datos_cero",
        frm_fecha_ocurrencia: frm_fecha_ocurrencia,
        frm_tipo_documento: frm_tipo_documento,
        frm_numero_identificacion: frm_numero_identificacion,
        frm_numero_poliza_pvcero: frm_numero_poliza_pvcero,
        frm_tipo_doc_contratante: frm_tipo_doc_contratante,
        frm_contratante_numero_identificacion: frm_contratante_numero_identificacion,
        tri_user_sac_uname: tri_user_sac_uname,
        frm_numero_poliza_b: frm_numero_poliza_b,
        frm_token: sessionStorage.getItem('token'),
        app_number: appNumber
      },
      type: "POST",
      beforeSend: function () {
        $("#645044310615f604fbf13b2086110376").showFormModal();
      },
      success: function (respuesta) {
        try {
          var respuestadata = JSON.parse(respuesta);

          if (respuestadata.mensaje == "false") {
            alert(respuestadata.mensaje_mostrar);
            limpiar_datos();
            return;
          }

          // Datos del asegurado
          $("#frm_apellido_paterno").setValue(respuestadata.asegurado.txt_apellido1);
          $("#frm_apellido_materno").setValue(respuestadata.asegurado.txt_apellido2);
          $("#frm_nombres").setValue(respuestadata.asegurado.txt_nombre);
          $("#frm_apellido_paterno").show();
          $("#frm_apellido_materno").show();
          $("#frm_nombres").show();

          // Ordenar pólizas prioritarias primero
          var polizasPrioritarias = [];
          var polizasAuxiliares = [];
          $.each(respuestadata.polizas, function (i, item) {
            if (item.codigo_dato == 3) {
              polizasPrioritarias.push(item);
            } else {
              polizasAuxiliares.push(item);
            }
          });
          respuestadata.polizas = polizasPrioritarias.concat(polizasAuxiliares);

          var tri_mensaje_poliza = "";
          $.each(respuestadata.polizas, function (i, item) {
            tri_mensaje_poliza = "true";
            var valor =
              item.id_cns + "|" + item.id_pv + "|" + item.id_pv_cero + "|" +
              item.cod_tercero + "|" + item.cod_aseg + "|" + item.nro_aseg + "|" +
              item.nro_pariente + "|" + item.nro_pol + "|" + item.cod_ramo + "|" +
              item.cod_suc + "|" + item.linea_negocio + "|" + item.fec_ingreso_pol + "|" +
              item.txt_broker + "|" + item.txt_contratante + "|" + item.ruc_contratante + "|" +
              item.txt_certificado + "|" + item.fec_vig_desde + "|" + item.fec_vig_hasta + "|" +
              item.origen + "|" + (item.codigo_dato == 3 ? item.nro_stro_pol : "");

            var etiqueta = item.codigo_dato == 3
              ? item.nro_pol + " - " + item.txt_contratante + " - " + item.txt_certificado + " - Stro: " + item.nro_stro_pol + " - Origen: " + item.origen
              : item.nro_pol + " - " + item.txt_contratante + " - " + item.txt_certificado + " - Origen: " + item.origen;

            $("#frm_polizas").getControl().append(new Option(etiqueta, valor));
          });

          $("#pnl_datareturn").show();
          $("#datareturn").html(respuestadata.mensaje_data);

          if (tri_mensaje_poliza == "") {
            alert("No se encontraron polizas disponibles para la fecha de ocurrencia");
          }

          // Llenar datos del asegurado
          if (respuestadata.mensaje_stro_aseg == "") {
            $.each(respuestadata.stro_aseg, function (i, item) {
              $("#frm_pais_ocurrencia").setValue(item.FRM_PAIS_OCURRENCIA);
              $("#frm_provincia_ocurrencia").setValue(item.FRM_PROVINCIA_OCURRENCIA);
              $("#frm_edad_asegurado").setValue(item.FRM_EDAD_ASEGURADO == null ? "" : item.FRM_EDAD_ASEGURADO);
              $("#frm_genero_asegurado").setValue(item.FRM_GENERO_ASEGURADO);
              $("#frm_asegurado_mail").setValue(item.FRM_ASEGURADO_MAIL == null ? "" : item.FRM_ASEGURADO_MAIL);
              $("#frm_asegurado_celular").setValue(item.FRM_ASEGURADO_CELULAR == null ? "" : item.FRM_ASEGURADO_CELULAR);
              $("#frm_asegurado_mail_1").setValue(item.FRM_ASEGURADO_MAIL_1 == null ? "" : item.FRM_ASEGURADO_MAIL_1);
              $("#frm_asegurado_celular_1").setValue(item.FRM_ASEGURADO_CELULAR_1 == null ? "" : item.FRM_ASEGURADO_CELULAR_1);
            });
          }

          // Grid de siniestros para alcances
          if (respuestadata.mensaje_stro_find == "") {
            var j = 1;
            $.each(respuestadata.stro_find, function (i, item) {
              if (j > 1) $("#grd_siniestros_alcances").addRow();
              $("#grd_siniestros_alcances").setValue(item.nro_stro, j, 1);
              $("#grd_siniestros_alcances").setValue(item.nro_poliza, j, 2);
              $("#grd_siniestros_alcances").setValue(item.txt_certificado, j, 3);
              $("#grd_siniestros_alcances").setValue(item.cod_causa, j, 4);
              $("#grd_siniestros_alcances").setValue(item.cod_cobertura_madre, j, 5);
              $("#grd_siniestros_alcances").setValue(item.imp_monto_estimado + "/" + item.imp_monto_pagado, j, 6);
              $("#grd_siniestros_alcances").setValue(item.fec_ocurrencia, j, 7);
              $("#grd_siniestros_alcances").setValue(item.cod_estado_siniestro, j, 8);
              $("#form\\[grd_siniestros_alcances\\]\\[" + j + "\\]\\[grd_reanudar3\\]").prop("disabled", true);
              $("#grd_siniestros_alcances").setValue(item.Contratante, j, 9);
              $("#grd_siniestros_alcances").setValue("NO", j, 10);
              $("#grd_siniestros_alcances").setValue(item.cod_suc, j, 11);
              $("#grd_siniestros_alcances").setValue(item.cod_ramo_comercial, j, 12);
              $("#grd_siniestros_alcances").setValue(item.cod_ramo_tec, j, 13);
              $("#grd_siniestros_alcances").setValue(item.id_pv, j, 14);
              $("#grd_siniestros_alcances").setValue(item.id_pv_cero, j, 15);
              $("#grd_siniestros_alcances").setValue(item.cod_causa, j, 16);
              $("#grd_siniestros_alcances").setValue(item.cod_estado_evento, j, 17);
              $("#grd_siniestros_alcances").setValue(item.cod_causa_stro, j, 18);
              $("#grd_siniestros_alcances").setValue(item.imp_monto_estimado, j, 19);
              $("#grd_siniestros_alcances").setValue(item.cod_cobertura_madre, j, 20);
              $("#grd_siniestros_alcances").setValue(item.cod_aseg, j, 21);
              $("#grd_siniestros_alcances").setValue(item.nro_aseg, j, 22);
              $("#grd_siniestros_alcances").setValue(item.id_cns_stro, j, 23);
              $("#grd_siniestros_alcances").setValue(item.cod_tercero, j, 24);
              $("#grd_siniestros_alcances").setValue(item.nro_pariente, j, 25);
              $("#grd_siniestros_alcances").setValue(item.Contratante, j, 26);
              $("#grd_siniestros_alcances").setValue(item.cod_amparo, j, 27);
              $("#grd_siniestros_alcances").setValue(item.cod_riesgo, j, 28);
              $("#grd_siniestros_alcances").setValue(item.id_stro, j, 29);
              j++;
            });
          }

          var bandera_registro = respuestadata.mensaje_polizas_dis == "false" ? "true" : "";

          // Grid siniestros registrados
          if (respuestadata.mensaje_stro_exits == "") {
            var j = 1;
            $.each(respuestadata.stro_exits, function (i, item) {
              if (j > 1) $("#grd_siniestros_registrados").addRow();
              $("#grd_siniestros_registrados").setValue(item.nro_stro + " - " + item.app_number, j, 1);
              $("#grd_siniestros_registrados").setValue(item.detalle_poliza, j, 2);
              $("#grd_siniestros_registrados").setValue(item.cod_causa, j, 3);
              $("#grd_siniestros_registrados").setValue(item.cobertura, j, 4);
              $("#grd_siniestros_registrados").setValue(item.monto, j, 5);
              $("#grd_siniestros_registrados").setValue(item.fecha_notificacion, j, 6);
              $("#grd_siniestros_registrados").setValue(item.usr_username, j, 7);
              j++;
            });
          } else {
            if (bandera_registro == "") mostrarSeccionPrincipal();
          }

          // Grid siniestros en proceso
          clearGrid("grd_siniestros_enproceso");
          if (respuestadata.mensaje_stro_proceso == "") {
            var j = 1;
            $.each(respuestadata.stro_proceso, function (i, item) {
              if (j > 1) $("#grd_siniestros_enproceso").addRow();
              $("#grd_siniestros_enproceso").setValue(item.nro_stro + " - " + item.app_number, j, 1);
              $("#grd_siniestros_enproceso").setValue(item.detalle_poliza, j, 2);
              $("#grd_siniestros_enproceso").setValue(item.cod_causa, j, 3);
              $("#grd_siniestros_enproceso").setValue(item.cobertura_madre, j, 4);
              $("#grd_siniestros_enproceso").setValue(item.monto, j, 5);
              $("#grd_siniestros_enproceso").setValue(item.fecha_notificacion, j, 6);
              $("#grd_siniestros_enproceso").setValue(item.tarea, j, 7);
              $("#grd_siniestros_enproceso").setValue(item.usr_username, j, 8);
              j++;
            });
          } else {
            if (bandera_registro == "") mostrarSeccionPrincipal();
          }

          // Grid siniestros parciales
          clearGrid("grd_siniestros_parcial");
          if (respuestadata.mensaje_stro_parcial == "") {
            var j = 1;
            $.each(respuestadata.stro_parcial, function (i, item) {
              if (j > 1) $("#grd_siniestros_parcial").addRow();
              $("#grd_siniestros_parcial").setValue(item.nro_stro, j, 1);
              $("#grd_siniestros_parcial").setValue(item.app_number, j, 2);
              $("#grd_siniestros_parcial").setValue(item.detalle_poliza, j, 3);
              $("#grd_siniestros_parcial").setValue(item.cod_causa, j, 4);
              $("#grd_siniestros_parcial").setValue(item.cobertura, j, 5);
              $("#grd_siniestros_parcial").setValue(item.monto, j, 6);
              $("#grd_siniestros_parcial").setValue(item.fecha_notificacion, j, 7);
              $("#grd_siniestros_parcial").setValue(item.usr_username, j, 8);
              j++;
            });
          } else {
            if (bandera_registro == "") mostrarSeccionPrincipal();
          }

          if (respuestadata.mensaje_polizas_dis == "" && bandera_registro == "") {
            mostrarSeccionPrincipal();
          }

        } catch (err) {
          alert("Error en la respuesta del servidor: " + err.message);
        } finally {
          $("#645044310615f604fbf13b2086110376").hideFormModal();
        }
      },
      error: function (xhr, status) {
        alert(status);
      },
      complete: function (xhr, status) {
        $("#645044310615f604fbf13b2086110376").hideFormModal();
      },
    });
  } else {
    alert("Por favor ingrese los datos requeridos");
  }
}

$("#btn_consultar").find("button").on("click", function () {
  consultar_datos();
});

// =============================================
// CONTRATANTE - CAMBIO DE PÓLIZA
// =============================================

$("#frm_pols_contratante").getControl().on("change", function () {
  var partes = $(this).val().split("|");
  var id_pv_cero = partes[0];
  var nro_pol = partes[1];
  var origenEncontrado = null;
  var totalFilas = $("#grdInfoContratantePoliza").getNumberRows();

  for (var i = 1; i <= totalFilas; i++) {
    var idPvCeroFila = $("#grdInfoContratantePoliza").getValue(i, 5);
    var nroPolFila = $("#grdInfoContratantePoliza").getValue(i, 6);
    if (idPvCeroFila == id_pv_cero && nroPolFila == nro_pol) {
      origenEncontrado = $("#grdInfoContratantePoliza").getValue(i, 7);
      break;
    }
  }

  if (origenEncontrado !== null) {
    $("#cmbOrigen").setValue(origenEncontrado);
    $("#cmbOrigenAux").setValue(origenEncontrado);
  } else {
    $("#cmbOrigen").setValue("INSURANCE");
    $("#cmbOrigenAux").setValue(null);
  }
});

// =============================================
// CONSULTA DE PÓLIZAS POR CONTRATANTE
// =============================================

function consultar_datos_pol() {
  limpiar_datos();
  limpiar_datos_asegurado();

  var frm_tipo_doc_contratante = $("#frm_tipo_doc_contratante").getValue();
  var frm_contratante_numero_identificacion = $("#frm_contratante_numero_identificacion").getValue();
  var tri_user_sac_uname = $("#tri_user_sac_uname").getValue();

  $("#frm_pols_contratante").getControl().empty();

  if (frm_tipo_doc_contratante != "" && frm_contratante_numero_identificacion != "") {
    $.ajax({
      url: "../beesmartec/services/siniestrosVida/ajax_pantalla.php",
      data: {
        funcion: "consultar_datos_pol",
        frm_tipo_doc_contratante: frm_tipo_doc_contratante,
        frm_contratante_numero_identificacion: frm_contratante_numero_identificacion,
        tri_user_sac_uname: tri_user_sac_uname,
        frm_token: sessionStorage.getItem('token'),
        app_number: appNumber
      },
      type: "POST",
      beforeSend: function () {
        $("#645044310615f604fbf13b2086110376").showFormModal();
      },
      success: function (respuesta) {
        var respuestadata = JSON.parse(respuesta);
        if (respuestadata.mensaje == "false") {
          alert(respuestadata.mensaje_mostrar);
          return;
        }
        
        var items = respuestadata.consulta0.filter(function(item) {
        return item.id_pv_cero !== "" && item.nro_pol !== 0;
    });

      var tmpIdPvCero = "";
$.each(items, function (i, item) {  
    tmpIdPvCero += item.id_pv_cero + "¬";
});
        
     $.each(items, function (i, item) {   
    if (i === 0) {
        $("#frm_pols_contratante").getControl().append(
            new Option(item.txt_contratante, tmpIdPvCero + "|" + item.nro_pol)
        );
    }
    if (i > 0) $("#grdInfoContratantePoliza").addRow();
    $("#grdInfoContratantePoliza").setValue(item.cod_aseg, i + 1, 1);
    $("#grdInfoContratantePoliza").setValue(item.cod_ramo, i + 1, 2);
    $("#grdInfoContratantePoliza").setValue(item.cod_suc, i + 1, 3);
    $("#grdInfoContratantePoliza").setValue(item.id_cns, i + 1, 4);
    $("#grdInfoContratantePoliza").setValue(item.id_pv_cero, i + 1, 5);
    $("#grdInfoContratantePoliza").setValue(item.nro_pol, i + 1, 6);
    $("#grdInfoContratantePoliza").setValue(item.origen, i + 1, 7);
});
      },
      error: function (xhr, status) {
        alert(status);
      },
      complete: function (xhr, status) {
        $("#645044310615f604fbf13b2086110376").hideFormModal();
      },
    });
  } else {
    alert("Por favor ingrese los datos requeridos");
  }
}

$("#frm_contratante_numero_identificacion").setOnchange(consultar_datos_pol);

// =============================================
// RECLAMANTES
// =============================================

function getReclamantes(codAseg) {
  $.ajax({
    url: "../beesmartec/services/siniestrosVida/ajax_pantalla.php",
    data: {
      funcion: "obtener_reclamantes",
      entidadid: codAseg,
      frm_token: sessionStorage.getItem('token'),
      app_number: appNumber
    },
    type: "POST",
    beforeSend: function () {
      if (!modalVisible) {
        $("#645044310615f604fbf13b2086110376").showFormModal();
        modalVisible = true;
      }
    },
    success: function (respuesta) {
      var respuestadata = JSON.parse(respuesta);
      $.each(respuestadata, function (i, item) {
        $("#frm_reclamante").getControl().append(new Option(item.nombrecompleto, item.id));
        $("#frm_reclamante").enableValidation();
      });
    },
    error: function (xhr, status) {
      alert(status);
    },
    complete: function () {
      $("#645044310615f604fbf13b2086110376").hideFormModal();
      modalVisible = false;
    },
  });
}

// =============================================
// BÚSQUEDA DE COBERTURAS POR PÓLIZA
// =============================================

function busqueda_cobertura(newValue, oldValue) {
  var partes = newValue.split("|");
  var cod_aseg = partes[4];
  var origen = partes[partes.length - 1];

  $("#frm_coberturas").getControl().empty();
  $("#cmbOrigenAux").setValue(origen.trim());
  $("#cmbOrigen").setValue(origen.trim());
  clearGrid("grd_coberturas");

  if (newValue == "") {
    alert("Por favor ingrese los datos requeridos");
    return;
  }

  $.ajax({
    url: "../beesmartec/services/siniestrosVida/ajax_pantalla.php",
    data: {
      funcion: "consultar_datos_cobertura",
      frm_poliza: newValue,
      frm_token: sessionStorage.getItem('token'),
      app_number: appNumber
    },
    type: "POST",
    beforeSend: function () {
      $("#645044310615f604fbf13b2086110376").showFormModal();
      modalVisible = true;
    },
    success: function (respuesta) {
      var respuestadata = JSON.parse(respuesta);

      if (respuestadata.mensaje == "false") {
        alert(respuestadata.mensaje_mostrar);
        limpiar_datos();
        return;
      }

      var j = 1;
      var esAlcance = $("#tri_bandera_alcance").getValue() == "ALCANCE";
      var validaAlcance = $("#tri_bandera_valida").getValue();

      $.each(respuestadata.consulta2, function (i, item) {
        var valida = item.cod_amparo + "|" + item.cod_riesgo;
        if (esAlcance && valida !== validaAlcance) return; // saltar si no coincide

        if (j > 1) $("#grd_coberturas").addRow();

        $("#grd_coberturas").setValue(item.txt_desc_riesgo, j, 1);
        $("#grd_coberturas").setValue(item.imp_suma_aseg, j, 2);
        $("#grd_coberturas").setValue("NO", j, 3);
        for (var col = 4; col <= 11; col++) {
          $("#grd_coberturas").setValue("", j, col);
        }
        
        $("#grd_coberturas").setValue(item.cod_cobertura, j, 12);
        $("#grd_coberturas").setValue(item.cod_amparo, j, 13);
        $("#grd_coberturas").setValue(item.cod_categ, j, 14);
        $("#grd_coberturas").setValue(item.cod_ramo_tec, j, 15);
        $("#grd_coberturas").setValue(item.cod_riesgo, j, 16);
        $("#grd_coberturas").setValue(item.cod_subramo_tec, j, 17);
        $("#grd_coberturas").setValue(item.id_cns, j, 18);
        $("#grd_coberturas").setValue(item.id_cob, j, 19);
        $("#grd_coberturas").setValue(item.ind_riesgo, j, 20);
        $("#grd_coberturas").setValue(item.cod_objeto, j, 21);
        $("#grd_coberturas").setValue(item.cod_tercero, j, 22);
        $("#grd_coberturas").setValue(item.cod_aseg, j, 23);
        $("#grd_coberturas").setValue(item.nro_aseg, j, 24);
        $("#grd_coberturas").setValue(item.nro_pariente, j, 25);
        $("#grd_coberturas").setValue(1, j, 26);
        $("#grd_coberturas").setValue(1, j, 27);
        $("#grd_coberturas").setValue(item.id_indice, j, 28);
        $("#grd_coberturas").setValue(item.id_pv, j, 29);
        $("#grd_coberturas").setValue(item.id_pv_cero, j, 30);
        $("#grd_coberturas").setValue(item.cod_cobertura_madre, j, 31);

        $("#form\\[grd_coberturas\\]\\[" + j + "\\]\\[grd_txt_aplicar\\]").prop("disabled", false);
        ["grd_txt_alcance", "grd_txt_conoce_vcuota", "grd_txt_vcuota", "grd_txt_conoce_dias", "grd_txt_dias", "grd_txt_conoce_monto", "grd_txt_porcentaje", "grd_txt_valor"]
          .forEach(function (campo) {
            $("#form\\[grd_coberturas\\]\\[" + j + "\\]\\[" + campo + "\\]").prop("disabled", true);
          });

        $("#frm_coberturas").getControl().append(
          new Option(
            item.txt_desc_riesgo + " - " + item.imp_suma_aseg,
            item.cod_cobertura + "|" + item.imp_suma_aseg + "|" + item.cod_amparo + "|" +
            item.cod_categ + "|" + item.cod_ramo_tec + "|" + item.cod_riesgo + "|" +
            item.cod_subramo_tec + "|" + item.id_cns + "|" + item.id_cob + "|" +
            item.ind_riesgo + "|" + item.cod_objeto
          )
        );
        j++;
      });

      if (origen.trim() == "INSURANCE") {
        getReclamantes(cod_aseg);
      }
    },
    error: function (xhr, status) {
      alert(status);
    },
    complete: function () {
      $("#645044310615f604fbf13b2086110376").hideFormModal();
    },
  });
}

$("#frm_polizas").setOnchange(busqueda_cobertura);

// =============================================
// DATOS DEL FALLECIDO
// =============================================

$("#frm_documento_fallecido").focusout(function () {
  limpiar_datos_fallecido();
  var frm_tipo_documento_fallecido = $("#frm_tipo_documento_fallecido").getValue();
  var frm_documento_fallecido = $("#frm_documento_fallecido").getValue();

  if (frm_documento_fallecido == "") {
    alert("Por favor ingrese los datos requeridos");
    return;
  }

  $.ajax({
    url: "../beesmartec/services/siniestrosVida/ajax_pantalla.php",
    data: {
      funcion: "consultar_datos_fallecido",
      frm_tipo_documento_fallecido: frm_tipo_documento_fallecido,
      frm_documento_fallecido: frm_documento_fallecido,
      frm_tipo_cns: 1,
      frm_token: sessionStorage.getItem('token'),
      app_number: appNumber
    },
    type: "POST",
    beforeSend: function () {
      $("#645044310615f604fbf13b2086110376").showFormModal();
    },
    success: function (respuesta) {
      var respuestadata = JSON.parse(respuesta);
      if (respuestadata.mensaje == "false") {
        alert(respuestadata.mensaje_mostrar);
        limpiar_datos_fallecido();
        return;
      }

      $("#frm_apellido_paterno_fallecido").setValue(respuestadata.txt_apellido1_deudor);
      $("#frm_apellido_materno_fallecido").setValue(respuestadata.txt_apellido2_deudor);
      $("#frm_nombres_fallecido").setValue(respuestadata.txt_nombre_deudor);
      $("#frm_parentesco_fallecido").setValue(respuestadata.cod_parentesco == 0 ? "" : respuestadata.cod_parentesco);
      $("#frm_cod_aseg_fallecido").setValue(respuestadata.cod_aseg);
      $("#frm_id_cns_fallecido").setValue(respuestadata.id_cns_codeudor);
      $("#frm_id_persona_fallecido").setValue(respuestadata.id_persona);
      $("#frm_genero_fallecido").setValue(respuestadata.sexo);

      var partesFecha = respuestadata.fec_nac.substring(0, 10).split("/");
      var fechaFormateada = partesFecha[2] + "-" + partesFecha[1] + "-" + partesFecha[0];
      $("#frm_fecha_nacimiento_fallecido").setValue(fechaFormateada);
      $("#frm_fecha_nacimiento_fallecido").setText(fechaFormateada);
    },
    error: function (xhr, status) {
      alert(status);
    },
    complete: function () {
      $("#645044310615f604fbf13b2086110376").hideFormModal();
    },
  });
});

// =============================================
// EVENTOS DE CAMBIO EN EL FORMULARIO (grids)
// =============================================

$("#tri_bandera_alcance").setValue("");
var formId = $("form").prop("id");

$("#" + formId).setOnchange(function (fieldId, newVal, oldVal) {
  var aMatches = fieldId.match(/^\[grd_siniestros_alcances\]\[(\d+)\]\[grd_reanudar3\]$/);
  var aMatches_cober = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_aplicar\]$/);
  var aMatches_vsolicitado = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_valor\]$/);
  var aMatches_conoce_vcuota = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_conoce_vcuota\]$/);
  var aMatches_vcuota = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_vcuota\]$/);
  var aMatches_conoce_dias = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_conoce_dias\]$/);
  var aMatches_dias = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_dias\]$/);
  var aMatches_conoce_monto = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_conoce_monto\]$/);

  // ── GRID ALCANCES: selección de siniestro para reanudar ──────────────────
  if (aMatches) {
    var rowNo = aMatches[1];

    if (newVal == "SI") {
      $("#tri_bandera_alcance").setValue("ALCANCE");
      var nRows = $("#grd_siniestros_alcances").getNumberRows();
      for (var i = 1; i <= nRows; i++) {
        if (i != rowNo) {
          $("#form\\[grd_siniestros_alcances\\]\\[" + i + "\\]\\[grd_reanudar3\\]").val("NO");
        }
      }

      var nro_stro = $("#grd_siniestros_alcances").getValue(rowNo, 1);
      var nro_pol = $("#grd_siniestros_alcances").getValue(rowNo, 2);
      var stro_montos = $("#grd_siniestros_alcances").getValue(rowNo, 6);
      var id_pv = $("#grd_siniestros_alcances").getValue(rowNo, 14);
      var id_pv_cero = $("#grd_siniestros_alcances").getValue(rowNo, 15);
      var cod_tercero = $("#grd_siniestros_alcances").getValue(rowNo, 24);
      var cod_aseg = $("#grd_siniestros_alcances").getValue(rowNo, 21);
      var nro_aseg = $("#grd_siniestros_alcances").getValue(rowNo, 22);
      var nro_pariente = $("#grd_siniestros_alcances").getValue(rowNo, 25) || 0;
      var cod_ramo = $("#grd_siniestros_alcances").getValue(rowNo, 12);
      var cod_suc = $("#grd_siniestros_alcances").getValue(rowNo, 11);
      var txt_contratante = $("#grd_siniestros_alcances").getValue(rowNo, 26);
      var cod_amparo = $("#grd_siniestros_alcances").getValue(rowNo, 27);
      var cod_riesgo = $("#grd_siniestros_alcances").getValue(rowNo, 28);
      var cod_causa = $("#grd_siniestros_alcances").getValue(rowNo, 16);
      var id_stro = $("#grd_siniestros_alcances").getValue(rowNo, 29);

      $("#tri_bandera_valida").setValue(cod_amparo + "|" + cod_riesgo);
      $("#tri_id_stro").setValue(id_stro);
      $("#tri_nro_stro").setValue(nro_stro);
    
      //nuevo
      $("#frm_causa_siniestro").setValue(String(cod_causa));

      var arr_mon = stro_montos.split("/");
      $("#frm_monto_pagado_al").setValue(arr_mon[0]);

      $("#frm_polizas").getControl().attr("disabled", true);
      $("#frm_coberturas").getControl().attr("disabled", true);
      $("#frm_monto_reportado").show();
      $("#frm_tipo_asegurado").disableValidation();
      $("#frm_cie_siniestro").disableValidation();
      $("#frm_sbt_docs").show();
      $("#55241990862ba1704c23881005873211").show();
      $("#frm_sbt_datAsegurado").show();
      $("#13722500361d66707a60381015639101").show();
      $("#frm_causa_siniestro").hide();
      $("#frm_cie_siniestro").hide();
      $("#frm_comentario").show();      
      $("#btn_enviar").show();
      //nuevo 0605
     

    } else {
      $("#tri_bandera_alcance").setValue("");
      $("#tri_bandera_valida").setValue("");
    }
  }

  // ── GRID COBERTURAS: aplicar cobertura ───────────────────────────────────
  if (aMatches_cober) {
    var rowNo_g = aMatches_cober[1];
    $("#frm_check_documentos").setValue("");
    $("#frm_cober_select").setValue("");

    if (newVal != "SI") {
      $("#grd_coberturas").setValue("", rowNo_g, 11);
      $("#form\\[grd_coberturas\\]\\[" + rowNo_g + "\\]\\[grd_txt_valor\\]").prop("disabled", true);
      return;
    }

    var txt_poli = $("#frm_polizas").getValue();
    var arr_poli = txt_poli.split("|");
    var num_poliza = arr_poli[7];
    var num_certificado = arr_poli[15];
    var num_stro_sel = arr_poli[19] || "";
    var txt_fec_ocu = $("#frm_fecha_ocurrencia").getValue();
    var fec_ocu = txt_fec_ocu.replace(/-/g, "/");
    var indice = parseInt($("#grd_coberturas").getValue(rowNo_g, 12));
    var bandera_validacion = "";

    $("#frm_cobertura_madre").setValue($("#grd_coberturas").getValue(rowNo_g, 31));
    var cobertura = $("#grd_coberturas").getValue(rowNo_g, 12);

    // ── Validar contra siniestros registrados en alcances ────────────────
    if ($("#grd_siniestros_alcances").getValue(1, 1) !== "") {
      var aStros = $("#grd_siniestros_alcances").getValue();

      for (var i = 0; i < aStros.length; i++) {
        var num_stro = aStros[i][0];
        var num_polistro = aStros[i][1];
        var num_certstro = aStros[i][2];
        var estado = aStros[i][7];
        var cobertura_stro = aStros[i][27];
        var montos_stro = aStros[i][5];

        // Parseo de fecha de ocurrencia del siniestro
        var arr_fec = aStros[i][6].split(" ")[0].split("/");
        var fec_day = arr_fec[0].length == 1 ? "0" + arr_fec[0] : arr_fec[0];
        var fec_mont = arr_fec[1].length == 1 ? "0" + arr_fec[1] : arr_fec[1];
        var fec_ocurr_stro = arr_fec[2] + "/" + fec_mont + "/" + fec_day;

        if (estado == 1) {
          // Siniestro en proceso de análisis
          if (num_poliza == num_polistro && num_certificado == num_certstro && cobertura == cobertura_stro && fec_ocu == fec_ocurr_stro && (num_stro_sel == "" || num_stro_sel == num_stro)) {
            alert("Ya existe un siniestro en proceso de analisis");
            bandera_validacion = "true";
            $("#grd_coberturas").setValue("NO", rowNo_g, 3);
            $("#form\\[grd_coberturas\\]\\[" + rowNo_g + "\\]\\[grd_txt_conoce_dias\\]").prop("disabled", true);

            // Revisar si también está en el manager
            var aManager = $("#grd_siniestros_parcial").getValue();
            for (var j = 0; j < aManager.length; j++) {
              if (num_stro == aManager[j][0]) {
                alert("En el manager ya existe un Siniestro en la tarea 5.2 Revisar la bandeja de Sin asignar \n Num Caso: " + aManager[j][1]);
              }
            }
            return false;
          } else {
            habilitarCampoPorIndice(rowNo_g, indice);
          }

        } else if (estado == 3 || estado == 1) {
          // Posible alcance
          var montos_des = montos_stro.split("/");
          var monto_1 = montos_des[0];
          var monto_2 = montos_des[1];

          if (num_poliza == num_polistro && num_certificado == num_certstro && cobertura == cobertura_stro && (num_stro_sel == "" || num_stro_sel == num_stro)) {
            alert("POR FAVOR VALIDAR HISTORIAL YA QUE COINCIDE LA INFORMACION DE LA COBERTURA");
          }

          if (num_poliza == num_polistro && num_certificado == num_certstro && cobertura == cobertura_stro && fec_ocu == fec_ocurr_stro && (num_stro_sel == "" || num_stro_sel == num_stro)) {
            var sum_aseg = parseFloat($("#grd_coberturas").getValue(rowNo_g, 2));
            var indicesExcepcion = [268, 66, 507, 583, 564, 572, 552, 758, 15, 737, 339, 719, 668];

            if (indicesExcepcion.indexOf(indice) === -1 && parseFloat(monto_2) >= sum_aseg) {
              alert("EXCEDE LA SUMA ASEGURADA DE LA COBERTURA");
              $("#grd_coberturas").setValue("NO", rowNo_g, 3);
              $("#grd_coberturas").setValue("", rowNo_g, 4);
              return false;
            }

            alert("Ya existe un siniestro registrado \n debe aplicar un alcance en el grid de alcances");
            bandera_validacion = "true";
            $("#96000800361d66285a6b129007859955").show();
            $("#grd_siniestros_registrados").hide();
            $("#grd_siniestros_enproceso").hide();
            $("#grd_siniestros_parcial").hide();
            $("#grd_coberturas").setValue("0", rowNo_g, 11);
            $("#grd_coberturas").setValue("SI", rowNo_g, 4);
            $("#form\\[grd_coberturas\\]\\[" + rowNo_g + "\\]\\[grd_txt_conoce_dias\\]").prop("disabled", true);
            $("#form\\[grd_coberturas\\]\\[" + rowNo_g + "\\]\\[grd_txt_valor\\]").prop("disabled", false);
            $("#frm_sbt_datAsegurado").hide();
            $("#13722500361d66707a60381015639101").hide();
            $("#frm_sbt_docs").hide();
            $("#55241990862ba1704c23881005873211").hide();
            $("#form\\[grd_siniestros_alcances\\]\\[" + (i + 1) + "\\]\\[grd_reanudar3\\]").prop("disabled", false);
            $("#frm_accion").hide();
            $("#frm_comentario").hide();
            $("#btn_enviar").hide();

            // Deshabilitar el resto de filas del grid
            var nRowsp = $("#grd_coberturas").getNumberRows();
            for (var ip = 1; ip <= nRowsp; ip++) {
              if (ip != rowNo_g) {
                $("#form\\[grd_coberturas\\]\\[" + ip + "\\]\\[grd_txt_aplicar\\]").val("NO");
                $("#form\\[grd_coberturas\\]\\[" + ip + "\\]\\[grd_txt_aplicar\\]").prop("disabled", true);
              }
            }
            return false;

          } else {
            habilitarCampoPorIndice(rowNo_g, indice);
          }

        } else {
          habilitarCampoPorIndice(rowNo_g, indice);
        }
      }

    } else {
      // No hay siniestros en alcances
      habilitarCampoPorIndice(rowNo_g, indice);
    }
  }

  // ── GRID COBERTURAS: cambio de monto solicitado ──────────────────────────
  if (aMatches_vsolicitado) {
    var rowNo_gv = aMatches_vsolicitado[1];
    $("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));

    if (newVal == "") return;

    var grd_imp_suma_aseg = parseFloat($("#grd_coberturas").getValue(rowNo_gv, 2));
    var grd_txt_valor = parseFloat($("#grd_coberturas").getValue(rowNo_gv, 11));
    var indice_v = parseInt($("#grd_coberturas").getValue(rowNo_gv, 12));
    var alcance_gv = $("#grd_coberturas").getValue(rowNo_gv, 4);
    var indicesLibres = [268, 19, 39, 66, 507, 583, 552, 758, 564, 15, 339, 719, 737, 293,6];

    if (alcance_gv == "SI") {
      var bandera_sialcance = "";
      var stro_montos_al = "";
      var nRows = $("#grd_siniestros_alcances").getNumberRows();
      for (var i = 1; i <= nRows; i++) {
        if ($("#grd_siniestros_alcances").getValue(i, 10) == "SI") {
          stro_montos_al = $("#grd_siniestros_alcances").getValue(i, 6);
          bandera_sialcance = "true";
        }
      }
      if (bandera_sialcance == "") {
        alert("Seleccione el Alcance en el Grid de alcances");
        $("#grd_coberturas").setValue("0", rowNo_gv, 11);
        return false;
      }
      var arr_mon_al = stro_montos_al.split("/");
      grd_imp_suma_aseg = grd_imp_suma_aseg - parseFloat(arr_mon_al[0]);
    }

    if (indicesLibres.indexOf(indice_v) !== -1) {
      $("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
    } else {
      if (grd_imp_suma_aseg == 0) {
        $("#grd_coberturas").setValue("1", rowNo_gv, 11);
        $("#form\\[grd_coberturas\\]\\[" + rowNo_gv + "\\]\\[grd_txt_valor\\]").prop("disabled", true);
        alert("Al ser una cobertura de servicio se registra con el valor de 1\n Una vez realizado el analisis se ajusta el valor");
      } else if (grd_txt_valor > grd_imp_suma_aseg) {
        alert("No se puede reportar un monto mayor del asegurado");
        $("#grd_coberturas").setValue("0", rowNo_gv, 11);
      }
    }
  }

  // ── GRID COBERTURAS: conoce valor de cuota ───────────────────────────────
  if (aMatches_conoce_vcuota) {
    var rowNo_cvc = aMatches_conoce_vcuota[1];
    if (newVal == "SI") {
      $("#form\\[grd_coberturas\\]\\[" + rowNo_cvc + "\\]\\[grd_txt_vcuota\\]").prop("disabled", false);
    } else {
      $("#form\\[grd_coberturas\\]\\[" + rowNo_cvc + "\\]\\[grd_txt_vcuota\\]").prop("disabled", true);
      $("#grd_coberturas").setValue("", rowNo_cvc, 6);
      var suma_cvc = parseFloat($("#grd_coberturas").getValue(rowNo_cvc, 2));
      $("#grd_coberturas").setValue(suma_cvc * 2, rowNo_cvc, 11);
    }
    $("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
  }

  // ── GRID COBERTURAS: valor de cuota ─────────────────────────────────────
  if (aMatches_vcuota) {
    var rowNo_vc = aMatches_vcuota[1];
    var suma_vc = parseFloat($("#grd_coberturas").getValue(rowNo_vc, 2));
    if (newVal != "") {
      var cuota = Math.min(parseFloat(newVal), 2000);
      $("#grd_coberturas").setValue(cuota, rowNo_vc, 6);
      $("#grd_coberturas").setValue(cuota * 2, rowNo_vc, 11);
    } else {
      $("#grd_coberturas").setValue(suma_vc * 2, rowNo_vc, 11);
    }
    $("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
  }

  // ── GRID COBERTURAS: conoce días ─────────────────────────────────────────
  if (aMatches_conoce_dias) {
    var rowNo_cd = aMatches_conoce_dias[1];
    var suma_cd = parseFloat($("#grd_coberturas").getValue(rowNo_cd, 2));
    if (newVal == "SI") {
      $("#form\\[grd_coberturas\\]\\[" + rowNo_cd + "\\]\\[grd_txt_dias\\]").prop("disabled", false);
    } else {
      $("#form\\[grd_coberturas\\]\\[" + rowNo_cd + "\\]\\[grd_txt_dias\\]").prop("disabled", true);
      $("#grd_coberturas").setValue(3, rowNo_cd, 8);
      $("#grd_coberturas").setValue(suma_cd != 0 ? suma_cd * 3 : 1, rowNo_cd, 11);
    }
    $("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
  }

  // ── GRID COBERTURAS: cambio de días ──────────────────────────────────────
  if (aMatches_dias) {
    var rowNo_d = aMatches_dias[1];
    var suma_d = parseFloat($("#grd_coberturas").getValue(rowNo_d, 2));
    var dias_d = parseFloat($("#grd_coberturas").getValue(rowNo_d, 8)) || 3;
    $("#grd_coberturas").setValue(suma_d != 0 ? suma_d * dias_d : 1, rowNo_d, 11);
    $("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
  }

  // ── GRID COBERTURAS: conoce monto ────────────────────────────────────────
  if (aMatches_conoce_monto) {
    var rowNo_cm = aMatches_conoce_monto[1];
    var sum_aseg_cm = parseFloat($("#grd_coberturas").getValue(rowNo_cm, 2));

    if (newVal == "SI") {
      $("#form\\[grd_coberturas\\]\\[" + rowNo_cm + "\\]\\[grd_txt_valor\\]").prop("disabled", false);
      $("#grd_coberturas").setValue("", rowNo_cm, 10);
    } else {
      $("#form\\[grd_coberturas\\]\\[" + rowNo_cm + "\\]\\[grd_txt_valor\\]").prop("disabled", true);
      // Porcentaje según tramo de suma asegurada
      var porcentaje = 0;
      if (sum_aseg_cm > 0 && sum_aseg_cm <= 250) porcentaje = 50;
      else if (sum_aseg_cm > 250 && sum_aseg_cm <= 500) porcentaje = 46;
      else if (sum_aseg_cm > 500 && sum_aseg_cm <= 1000) porcentaje = 23;
      else if (sum_aseg_cm > 1000 && sum_aseg_cm <= 2000) porcentaje = 19;
      else if (sum_aseg_cm > 2000 && sum_aseg_cm <= 3000) porcentaje = 17;
      else if (sum_aseg_cm > 3000 && sum_aseg_cm <= 5000) porcentaje = 13;
      else if (sum_aseg_cm > 5000) porcentaje = 9;

      $("#grd_coberturas").setValue(porcentaje, rowNo_cm, 10);
      $("#grd_coberturas").setValue((sum_aseg_cm * porcentaje) / 100, rowNo_cm, 11);
    }
    $("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
  }
});

// =============================================
// VALIDACIÓN AL ENVIAR EL FORMULARIO
// =============================================

$("#645044310615f604fbf13b2086110376").setOnSubmit(function () {
  if ($("#cmbOrigen").getValue() == "INSURANCE") {    
    /*$("#frm_accion").setValue("CONTINUAR");
    $("#form\\[frm_accion\\]").val("CONTINUAR");
    alert($("#frm_accion").getValue());*/
    $('[name="form[frm_accion]"]').val("CONTINUAR").trigger("change");
	//alert($('[name="form[frm_accion]"]').val());
  }

  var grd = $("#grd_coberturas");
  for (var i = 1; i <= grd.getNumberRows(); i++) {
    if (grd.getValue(i, 3) == "SI") return true;
  }

  alert("NO HA SELECCIONADO NINGUNA COBERTURA");
  return false;
});
