//created by Henry
var appNumber = (function() {
    const casoTab = window.parent.document.querySelector(".x-tab-strip-text");
    return casoTab?.innerText.match(/\d+/)?.[0] || null;
})();

var token = $("#token_portal").getValue();
sessionStorage.setItem('token', token);

$("#dyn_backward").hide();
$("#chk_documentos").hide();
$("img[src='/images/bulletButtonLeft.gif']").hide();
$('#b_modal').click();
//ocultar datos de historia y docmemntos
$('#frm_sbt_historial').hide();
$('#22934569061d6fd88f0d814094422539').hide();
$('#frm_sbt_documentos').hide();
$('#41383009861d6fda8bfc0e4083116599').hide();
$('#pnl_datareturn').hide();
$('#frm_sbt_histSiniestros ').hide();
$('#96000800361d66285a6b129007859955').hide();

//validacion de sinietros en proceso
$('#ifrm_sbt_datSiniestros').hide();
$('#35181779861e95fb4b89895043554708').hide();
$('#ifrm_sbt_datAsegurado').hide();
$('#13722500361d66707a60381015639101').hide();
$('#frm_sbt_docs').hide();
$('#55241990862ba1704c23881005873211').hide();
$('#sbt_atencion').hide();
$('#frm_accion').hide();
$('#frm_comentario').hide();
$('#btn_enviar').hide();
$('#frm_coberturas').hide();

//para validar nuevamemte el ingreso
$("#frm_cie_siniestro").setValue('');
$("#frm_causa_siniestro").setValue('');
$("#frm_causa_siniestro_label").setValue('');
$("#tri_id_stro").setValue('');
$("#tri_nro_stro").setValue('');


//hay que vaciar y dejar que sea requerido el combo de la poliza y cobertura
$('#frm_polizas').getControl().empty();
$('#frm_polizas').getControl().append( new Option("--- Seleccione ---", "") );
$('#frm_coberturas').getControl().empty();
$('#frm_coberturas').getControl().append( new Option("--- Seleccione ---", "") );

if($("#tri_bandera_sac").getValue() == 'true'){
	$('#frm_sbt_historial').show();
  	$('#22934569061d6fd88f0d814094422539').show();
 	$('#frm_sbt_documentos').show();
  	$('#41383009861d6fda8bfc0e4083116599').show();	
}

function clearGrid (grd_name) {
    //first delete all rows except for the first:
    var rows = $("#"+grd_name).getNumberRows();
    for (var i=1; i < rows; i++) {
        $("#"+grd_name).deleteRow();
    }
    //clear all fields in the grid:
    var aValues = $("#"+grd_name).getValue();
    for (var i=1; i <= aValues[0].length; i++) {
        $("#"+grd_name).setValue("", 1, i);
    }
}

function busqueda(newValue, oldValue) {
//ingresa desabilitado
$('#frm_tipo_documento').disableValidation();
$('#frm_numero_identificacion').disableValidation();
$('#frm_numero_poliza').disableValidation();
$('#frm_sucursal').disableValidation();
$('#frm_ramo').disableValidation();
$('#frm_contratante').disableValidation();
$('#frm_broker').disableValidation();
//ocultar
$('#frm_tipo_documento').hide();
$('#frm_numero_identificacion').hide();
$('#frm_numero_poliza').hide();
$('#frm_sucursal').hide();
$('#frm_ramo').hide();
$('#btn_consultar_i').hide();
$('#btn_consultar_p').hide();
$('#frm_apellido_paterno').hide();
$('#frm_apellido_materno').hide();
$('#frm_nombres').hide();
$('#frm_contratante').hide(); 
$('#frm_broker').hide(); 
$('#frm_dias_respuesta').hide();
$('#frm_monto_reportado').hide();
  
  
//si es retiro por defecto natural
  if(newValue == 'ID'){
	$('#frm_tipo_documento').enableValidation();
    $('#frm_numero_identificacion').enableValidation();
    $('#frm_tipo_documento').show();
	$('#frm_numero_identificacion').show();   
    $('#btn_consultar_i').show();
    //combo accion
    $('#frm_accion').getControl().empty();
  	$('#frm_accion').getControl().append( new Option("--- Seleccione ---", "") );
    $('#frm_accion').getControl().append( new Option("Continuar con la creacion del siniestro", "CONTINUAR") );
    $('#frm_accion').getControl().append( new Option("Guardar el caso", "GUARDAR") );
  }
  
  if(newValue == 'Poliza'){
    $('#frm_numero_poliza').enableValidation();
    $('#frm_sucursal').enableValidation();
    $('#frm_ramo').enableValidation();
    $('#frm_contratante').enableValidation();
    $('#frm_broker').enableValidation(); 
    $('#frm_tipo_documento').show();
	$('#frm_numero_identificacion').show();
    $('#frm_numero_poliza').show();
    $('#frm_sucursal').show();
    $('#frm_ramo').show();
    //$('#btn_consultar_p').show();
    $('#frm_apellido_paterno').show();
    $('#frm_apellido_materno').show();
    $('#frm_nombres').show();
    $('#frm_contratante').show(); 
    $('#frm_broker').show(); 
    //desbloqueo
    $('#frm_apellido_paterno').getControl().attr("disabled", false);
    $('#frm_apellido_materno').getControl().attr("disabled", false);
    $('#frm_nombres').getControl().attr("disabled", false);
    $('#frm_contratante').getControl().attr("disabled", false);
    $('#frm_broker').getControl().attr("disabled", false);
    //oculto
    $('#ifrm_sbt_datSiniestros').show();
    $('#35181779861e95fb4b89895043554708').show();
    $('#ifrm_sbt_datAsegurado').show();
    $('#13722500361d66707a60381015639101').show();
    $('#frm_sbt_docs').show();
    $('#55241990862ba1704c23881005873211').show();
    $('#sbt_atencion').show();
    //$('#frm_accion').show();
    $('#frm_comentario').show();
    $('#btn_enviar').show();
    //quito requerido
    $('#frm_polizas').disableValidation();
    $('#frm_coberturas').disableValidation();
    //combo accion
    $('#frm_accion').getControl().empty();
    $('#frm_accion').getControl().append( new Option("--- Seleccione ---", "") );
  	$('#frm_accion').getControl().append( new Option("Continuar con la Negacion del Siniestro", "NEGAR") );
    
   }
}

$("#frm_tipo_busqueda").setValue('ID');
busqueda('ID', '');
$("#frm_tipo_busqueda").setOnchange(busqueda);

function limpiar_datos(){
  $('#frm_contratante').setValue('');
  $('#frm_apellido_paterno').setValue('');
  $('#frm_apellido_materno').setValue('');
  $('#frm_nombres').setValue('');
}

function limpiar_datos_asegurado(){
  $('#frm_tipo_asegurado').setValue('');
  $('#frm_pais_ocurrencia').setValue('');
  $('#frm_provincia_ocurrencia').setValue('');
  $('#frm_causa_siniestro_label').setValue('');
  $('#frm_causa_siniestro').setValue('');
  $('#frm_cie_siniestro').setValue('');
  $('#frm_edad_asegurado').setValue('');
  $('#frm_genero_asegurado').setValue('');
}

function consultar_datos(){
 
  //limpiar_datos();  
  var frm_fecha_ocurrencia = $("#frm_fecha_ocurrencia").getValue(); 
  var frm_tipo_documento = $("#frm_tipo_documento").getValue(); 
  var frm_numero_identificacion = $("#frm_numero_identificacion").getValue();   
  var frm_numero_poliza_pvcero = $("#frm_numero_poliza_pvcero").getValue();   
  var frm_numero_poliza_b = $("#frm_numero_poliza_b").getValue();   
  var frm_tipo_doc_contratante = $("#frm_tipo_doc_contratante").getValue(); 
  var frm_contratante_numero_identificacion = $("#frm_contratante_numero_identificacion").getValue(); 
  var tri_user_sac_uname = $("#tri_user_sac_uname").getValue(); 
  
  $('#frm_polizas').getControl().empty();
  $('#frm_polizas').getControl().append( new Option("--- Seleccione ---", "") );
  $('#datareturn').html('');
  
  clearGrid("grd_siniestros_alcances");
  clearGrid("grd_siniestros_registrados");
  
  if(frm_fecha_ocurrencia != '' && frm_tipo_documento != '' && frm_numero_poliza_pvcero != '' && frm_numero_identificacion != '' && frm_contratante_numero_identificacion != ''){
   $.ajax({
            url  : '../beesmartec/services/siniestrosVida/ajax_pantalla.php',
            data : {
              'funcion' : 'consultar_datos_cero',
              'frm_fecha_ocurrencia' : frm_fecha_ocurrencia,
              'frm_tipo_documento' : frm_tipo_documento,
              'frm_numero_identificacion' : frm_numero_identificacion,
              'frm_numero_poliza_pvcero' : frm_numero_poliza_pvcero,
              'frm_tipo_doc_contratante' : frm_tipo_doc_contratante,
              'frm_contratante_numero_identificacion' : frm_contratante_numero_identificacion,
              'tri_user_sac_uname' : tri_user_sac_uname,
			        'frm_numero_poliza_b' : frm_numero_poliza_b,
                'frm_token': sessionStorage.getItem('token'),
                'app_number': appNumber

            },
            type : 'POST',
            beforeSend : function(){
               $("#96986217061e95ce2ad1563044086004").showFormModal();
               
            },

            success : function(respuesta) {             

              var respuestadata = JSON.parse(respuesta);                           

              if(respuestadata.mensaje == 'false')     
              {           
                alert(respuestadata.mensaje_mostrar);
                limpiar_datos();
              }
              else  
              {     
                $('#frm_apellido_paterno').setValue(respuestadata.asegurado.txt_apellido1); 
                $('#frm_apellido_materno').setValue(respuestadata.asegurado.txt_apellido2); 
                $('#frm_nombres').setValue(respuestadata.asegurado.txt_nombre); 
                $('#frm_apellido_paterno').show(); 
                $('#frm_apellido_materno').show(); 
                $('#frm_nombres').show(); 
                //polizas
                var i=1;
                var tri_mensaje_poliza = '';
              $.each(respuestadata.polizas, function(i, item) {
                  tri_mensaje_poliza = 'true';
                  $('#frm_polizas').getControl().append( new Option(item.nro_pol+' - '+item.txt_contratante+' - '+item.txt_certificado, item.id_cns+'|'+item.id_pv+'|'+item.id_pv_cero+'|'+item.cod_tercero+'|'+item.cod_aseg+'|'+item.nro_aseg+'|'+item.nro_pariente+'|'+item.nro_pol+'|'+item.cod_ramo+'|'+item.cod_suc+'|'+item.linea_negocio+'|'+item.fec_ingreso_pol+'|'+item.txt_broker+'|'+item.txt_contratante+'|'+item.ruc_contratante+'|'+item.txt_certificado+'|'+item.fec_vig_desde+'|'+item.fec_vig_hasta ) );
                  i++;
                });
                
                $('#datareturn').html(respuestadata.mensaje_data); 
                if(tri_mensaje_poliza == ''){
                  alert("No se encontro la poliza indicada\n por favor revise los parametros de busqueda");
                }else{
                //lleno datos encontrados en la tablas
                  if(respuestadata.mensaje_stro_aseg == ''){
                    var i=1;
                    $.each(respuestadata.stro_aseg, function(i, item) {
                      $('#frm_pais_ocurrencia').setValue(item.FRM_PAIS_OCURRENCIA); 
                      $('#frm_provincia_ocurrencia').setValue(item.FRM_PROVINCIA_OCURRENCIA); 
                      //$('#frm_causa_siniestro_label').setValue(item.FRM_CAUSA_SINIESTRO_LABEL);
                      //$('#frm_causa_siniestro').setValue(item.FRM_CAUSA_SINIESTRO);
                      //$('#frm_cie_siniestro').setValue(item.FRM_CIE_SINIESTRO);
                      $('#frm_edad_asegurado').setValue((item.FRM_EDAD_ASEGURADO == null) ? '' : item.FRM_EDAD_ASEGURADO);
                      $('#frm_genero_asegurado').setValue(item.FRM_GENERO_ASEGURADO);
                      $('#frm_asegurado_mail').setValue((item.FRM_ASEGURADO_MAIL == null) ? '' : item.FRM_ASEGURADO_MAIL);
                      $('#frm_asegurado_celular').setValue((item.FRM_ASEGURADO_CELULAR == null) ? '' : item.FRM_ASEGURADO_CELULAR);
                      $('#frm_asegurado_mail_1').setValue((item.FRM_ASEGURADO_MAIL_1 == null) ? '' : item.FRM_ASEGURADO_MAIL_1);
                      $('#frm_asegurado_celular_1').setValue((item.FRM_ASEGURADO_CELULAR_1 == null) ? '' : item.FRM_ASEGURADO_CELULAR_1);
                      i++;
                    });
                  }
				
				//llenar los siniestros para alcances en el grid
                if(respuestadata.mensaje_stro_find == ''){
                  var j=1;
                  $.each(respuestadata.stro_find, function(i, item) {
                    if(j > 1)
                      $("#grd_siniestros_alcances").addRow();
                    
                    	$("#grd_siniestros_alcances").setValue(item.nro_stro, j, 1);
                    	$("#grd_siniestros_alcances").setValue(item.nro_poliza, j, 2);
                    	$("#grd_siniestros_alcances").setValue(item.txt_certificado, j, 3);
                    	$("#grd_siniestros_alcances").setValue(item.cod_causa, j, 4);
                    	$("#grd_siniestros_alcances").setValue(item.cod_cobertura_madre, j, 5);
                    	$("#grd_siniestros_alcances").setValue(item.imp_monto_estimado+'/'+item.imp_monto_pagado, j, 6);
                    	$("#grd_siniestros_alcances").setValue(item.fec_ocurrencia, j, 7);
                    	$("#grd_siniestros_alcances").setValue(item.cod_estado_siniestro, j, 8);
                    
                    		//if(item.cod_estado_siniestro == 3)
                              $("#form\\[grd_siniestros_alcances\\]\\["+j+"\\]\\[grd_reanudar3\\]").prop("disabled", true);
                              
                              
                    	$("#grd_siniestros_alcances").setValue(item.Contratante, j, 9);
                    	$("#grd_siniestros_alcances").setValue('NO', j, 10);
                    	
                    	//datos adicionales al grid para el alcance
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
                    
                       i++;
                       j++;
                    });
                  }
                //llenar los siniestros para alcances en el grid
                var bandera_registro = '';
                if(respuestadata.mensaje_stro_exits == ''){
                  bandera_registro = 'true';
                  var j=1;
                  $.each(respuestadata.stro_exits, function(i, item) {
                    if(j > 1)
                      $("#grd_siniestros_registrados").addRow();
                    
                    	$("#grd_siniestros_registrados").setValue(item.nro_stro+' - '+item.app_number, j, 1);
                    	$("#grd_siniestros_registrados").setValue(item.detalle_poliza, j, 2);
                    	$("#grd_siniestros_registrados").setValue(item.cod_causa, j, 3);
                    	$("#grd_siniestros_registrados").setValue(item.cobertura, j, 4);
                    	$("#grd_siniestros_registrados").setValue(item.monto, j, 5);
                    	$("#grd_siniestros_registrados").setValue(item.fecha_notificacion, j, 6);
                    	$("#grd_siniestros_registrados").setValue(item.usr_username, j, 7);
                       i++;
                       j++;
                    });
                  }else{
                    $('#ifrm_sbt_datSiniestros').show();
                    $('#35181779861e95fb4b89895043554708').show();
                    $('#ifrm_sbt_datAsegurado').show();
                    $('#13722500361d66707a60381015639101').show();
                    $('#frm_sbt_docs').show();
                    $('#55241990862ba1704c23881005873211').show();
                    $('#sbt_atencion').show();
                    //$('#frm_accion').show();
                    $('#frm_comentario').show();
                    $('#btn_enviar').show();
                  }
                //console.log(respuestadata.mensaje_stro_proceso);
                //llenar los siniestros para alcances en el grid
                clearGrid("grd_siniestros_enproceso");
                if(respuestadata.mensaje_stro_proceso == ''){
                  var j=1;
                  $.each(respuestadata.stro_proceso, function(i, item) {
                    if(j > 1)
                      $("#grd_siniestros_enproceso").addRow();
                    
                    	$("#grd_siniestros_enproceso").setValue(item.nro_stro+' - '+item.app_number, j, 1);
                    	$("#grd_siniestros_enproceso").setValue(item.detalle_poliza, j, 2);
                    	$("#grd_siniestros_enproceso").setValue(item.cod_causa, j, 3);
                    	$("#grd_siniestros_enproceso").setValue(item.cobertura, j, 4);
                    	$("#grd_siniestros_enproceso").setValue(item.monto, j, 5);
                    	$("#grd_siniestros_enproceso").setValue(item.fecha_notificacion, j, 6);
                    	$("#grd_siniestros_enproceso").setValue(item.tarea, j, 7);
                    	$("#grd_siniestros_enproceso").setValue(item.usr_username, j, 8);
                       i++;
                       j++;
                    });
                  }else{
                    if(bandera_registro == ''){
                      $('#ifrm_sbt_datSiniestros').show();
                      $('#35181779861e95fb4b89895043554708').show();
                      $('#ifrm_sbt_datAsegurado').show();
                      $('#13722500361d66707a60381015639101').show();
                      $('#frm_sbt_docs').show();
                      $('#55241990862ba1704c23881005873211').show();
                      $('#sbt_atencion').show();
                      //$('#frm_accion').show();
                      $('#frm_comentario').show();
                      $('#btn_enviar').show();
                    }
                  }
                //llenar los siniestros para alcances en el grid
                clearGrid("grd_siniestros_parcial");
                if(respuestadata.mensaje_stro_parcial == ''){
                  var j=1;
                  $.each(respuestadata.stro_parcial, function(i, item) {
                    if(j > 1)
                      $("#grd_siniestros_parcial").addRow();
                    
                    	$("#grd_siniestros_parcial").setValue(item.nro_stro, j, 1);
                    	$("#grd_siniestros_parcial").setValue(item.app_number, j, 2);
                    	$("#grd_siniestros_parcial").setValue(item.detalle_poliza, j, 3);
                    	$("#grd_siniestros_parcial").setValue(item.cod_causa, j, 4);
                    	$("#grd_siniestros_parcial").setValue(item.cobertura, j, 5);
                    	$("#grd_siniestros_parcial").setValue(item.monto, j, 6);
                    	$("#grd_siniestros_parcial").setValue(item.fecha_notificacion, j, 7);
                    	$("#grd_siniestros_parcial").setValue(item.usr_username, j, 8);
                       i++;
                       j++;
                    });
                  }else{
                    if(bandera_registro == ''){
                      $('#ifrm_sbt_datSiniestros').show();
                      $('#35181779861e95fb4b89895043554708').show();
                      $('#ifrm_sbt_datAsegurado').show();
                      $('#13722500361d66707a60381015639101').show();
                      $('#frm_sbt_docs').show();
                      $('#55241990862ba1704c23881005873211').show();
                      $('#sbt_atencion').show();
                      //$('#frm_accion').show();
                      $('#frm_comentario').show();
                      $('#btn_enviar').show();
                    }
                  }
                }
              }
            },
            error : function(xhr, status) {
              alert(status);
            },
            complete : function(xhr, status) {
              $("#96986217061e95ce2ad1563044086004").hideFormModal();          
            }
          });
      }else{
    alert("Por favor ingrese los datos requeridos");
    }
}

$("#btn_consultar").find("button").on("click" , function() {
    consultar_datos();
} );

/* CONSULTAR CONTRATANTES POR ID */

function consultar_datos_pol(){
 
  limpiar_datos();
  limpiar_datos_asegurado(); 
  var frm_tipo_doc_contratante = $("#frm_tipo_doc_contratante").getValue(); 
  var frm_contratante_numero_identificacion = $("#frm_contratante_numero_identificacion").getValue(); 
  var tri_user_sac_uname = $("#tri_user_sac_uname").getValue(); 
  
  $('#frm_pols_contratante').getControl().empty();
  //$('#frm_pols_contratante').getControl().append( new Option("--- Seleccione ---", "") );
  
  if(frm_tipo_doc_contratante != '' && frm_contratante_numero_identificacion != ''){
   $.ajax({
            url  : '../beesmartec/services/siniestrosVida/ajax_pantalla.php',
            data : {
              'funcion' : 'consultar_datos_pol',
              'frm_tipo_doc_contratante' : frm_tipo_doc_contratante,
              'frm_contratante_numero_identificacion' : frm_contratante_numero_identificacion,
              'tri_user_sac_uname' : tri_user_sac_uname,
                'frm_token': sessionStorage.getItem('token'),
                'app_number': appNumber

            },
            type : 'POST',
            beforeSend : function(){
               $("#96986217061e95ce2ad1563044086004").showFormModal();
            },

            success : function(respuesta) {             

              var respuestadata = JSON.parse(respuesta);                           

              if(respuestadata.mensaje == 'false')     
              {           
                alert(respuestadata.mensaje_mostrar);
              }
              else  
              {
				  var i=0;
					$.each(respuestadata.consulta0, function(i, item) {
					if(i==0)
						$('#frm_pols_contratante').getControl().append( new Option(item.txt_contratante, item.id_pv_cero+'|'+item.nro_pol ) );
                     i++;
                });
              }
            },
            error : function(xhr, status) {
              alert(status);
            },
            complete : function(xhr, status) {
              $("#96986217061e95ce2ad1563044086004").hideFormModal();          
            }
          });
      }else{
    alert("Por favor ingrese los datos requeridos");
    }
}

/*$("#btn_consultar_pol").find("button").on("click" , function() {
    consultar_datos_pol();
} );*/

$("#frm_contratante_numero_identificacion").setOnchange(consultar_datos_pol);


function busqueda_cobertura(newValue, oldValue){
 
  //limpiar_datos();  
  $('#frm_coberturas').getControl().empty();
  //$('#frm_coberturas').getControl().append( new Option("--- Seleccione ---", "") );
  clearGrid("grd_coberturas");
  
  if(newValue != ''){
   $.ajax({
            url  : '../beesmartec/services/siniestrosVida/ajax_pantalla.php',
            data : {
              'funcion' : 'consultar_datos_cobertura',
              'frm_poliza' : newValue,
               'frm_token': sessionStorage.getItem('token'),
                'app_number': appNumber
            },
            type : 'POST',
            beforeSend : function(){
               $("#96986217061e95ce2ad1563044086004").showFormModal();
            },

            success : function(respuesta) {             

              var respuestadata = JSON.parse(respuesta);                           

              if(respuestadata.mensaje == 'false')     
              {           
                alert(respuestadata.mensaje_mostrar);
                limpiar_datos();
              }
              else  
              {     
                //coberturas
                var i=1;
				var j=1;
              $.each(respuestadata.consulta2, function(i, item) {
                console.log($("#tri_bandera_alcance").getValue());
                if($("#tri_bandera_alcance").getValue() == "ALCANCE"){    
                  var valida = item.cod_amparo+'|'+item.cod_riesgo;
                  console.log(valida);
                  console.log($("#tri_bandera_valida").getValue());
                  if($("#tri_bandera_valida").getValue() == valida){
					  if(j > 1)
                      $("#grd_coberturas").addRow();
                    
                    	$("#grd_coberturas").setValue(item.txt_desc_riesgo, j, 1);
                    	$("#grd_coberturas").setValue(item.imp_suma_aseg, j, 2);
						$("#grd_coberturas").setValue('NO', j, 3);
						$("#grd_coberturas").setValue('', j, 4);
						$("#grd_coberturas").setValue('', j, 5);
						$("#grd_coberturas").setValue('', j, 6);
						$("#grd_coberturas").setValue('', j, 7);
						$("#grd_coberturas").setValue('', j, 8);
						$("#grd_coberturas").setValue('', j, 9);
						$("#grd_coberturas").setValue('', j, 10);
						$("#grd_coberturas").setValue('', j, 11);
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
						
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_aplicar\\]").prop("disabled", false);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_alcance\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_conoce_vcuota\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_vcuota\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_conoce_dias\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_dias\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_conoce_monto\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_porcentaje\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_valor\\]").prop("disabled", true);						
						
        				$('#frm_coberturas').getControl().append( new Option(item.txt_desc_riesgo+' - '+item.imp_suma_aseg, item.cod_cobertura+'|'+item.imp_suma_aseg+'|'+item.cod_amparo+'|'+item.cod_categ+'|'+item.cod_ramo_tec+'|'+item.cod_riesgo+'|'+item.cod_subramo_tec+'|'+item.id_cns+'|'+item.id_cob+'|'+item.ind_riesgo+'|'+item.cod_objeto ) );        
                	}
                }else{
					
                    if(j > 1)
                      $("#grd_coberturas").addRow();
                    
                    	$("#grd_coberturas").setValue(item.txt_desc_riesgo, j, 1);
                    	$("#grd_coberturas").setValue(item.imp_suma_aseg, j, 2);
						$("#grd_coberturas").setValue('NO', j, 3);
						$("#grd_coberturas").setValue('', j, 4);
						$("#grd_coberturas").setValue('', j, 5);
						$("#grd_coberturas").setValue('', j, 6);
						$("#grd_coberturas").setValue('', j, 7);
						$("#grd_coberturas").setValue('', j, 8);
						$("#grd_coberturas").setValue('', j, 9);
						$("#grd_coberturas").setValue('', j, 10);
						$("#grd_coberturas").setValue('', j, 11);
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
						
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_aplicar\\]").prop("disabled", false);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_alcance\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_conoce_vcuota\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_vcuota\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_conoce_dias\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_dias\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_conoce_monto\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_porcentaje\\]").prop("disabled", true);
						$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_valor\\]").prop("disabled", true);	
                    	
                	$('#frm_coberturas').getControl().append( new Option(item.txt_desc_riesgo+' - '+item.imp_suma_aseg, item.cod_cobertura+'|'+item.imp_suma_aseg+'|'+item.cod_amparo+'|'+item.cod_categ+'|'+item.cod_ramo_tec+'|'+item.cod_riesgo+'|'+item.cod_subramo_tec+'|'+item.id_cns+'|'+item.id_cob+'|'+item.ind_riesgo+'|'+item.cod_objeto ) );
                }
                  //$("#frm_contratante").disableValidation();
                   j++;
				   i++;
                });
              }
            },
            error : function(xhr, status) {
              alert(status);
            },
            complete : function(xhr, status) {
              $("#96986217061e95ce2ad1563044086004").hideFormModal();          
            }
          });
      }else{
    alert("Por favor ingrese los datos requeridos");
    }
}

$("#frm_polizas").setOnchange(busqueda_cobertura);

function limpiar_datos_fallecido(){
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
  
  if(frm_documento_fallecido != ''){
   $.ajax({
            url  : '../beesmartec/services/siniestrosVida/ajax_pantalla.php',
            data : {
              'funcion' : 'consultar_datos_fallecido',
              'frm_tipo_documento_fallecido' : frm_tipo_documento_fallecido,
              'frm_documento_fallecido' : frm_documento_fallecido,
              'frm_tipo_cns' : 1,
               'frm_token': sessionStorage.getItem('token'),
                'app_number': appNumber
            },
            type : 'POST',
            beforeSend : function(){
               $("#96986217061e95ce2ad1563044086004").showFormModal();
            },

            success : function(respuesta) {             

              var respuestadata = JSON.parse(respuesta);                           

              if(respuestadata.mensaje == 'false')     
              {           
                alert(respuestadata.mensaje_mostrar);
                limpiar_datos_fallecido();
              }
              else  
              {     
            	$('#frm_apellido_paterno_fallecido').setValue(respuestadata.txt_apellido1_deudor);
                $('#frm_apellido_materno_fallecido').setValue(respuestadata.txt_apellido2_deudor);
                $('#frm_nombres_fallecido').setValue(respuestadata.txt_nombre_deudor);
                if(respuestadata.cod_parentesco == 0)
                   respuestadata.cod_parentesco = '';
                $('#frm_parentesco_fallecido').setValue(respuestadata.cod_parentesco);
                $('#frm_cod_aseg_fallecido').setValue(respuestadata.cod_aseg);
                $('#frm_id_cns_fallecido').setValue(respuestadata.id_cns_codeudor);
                $('#frm_id_persona_fallecido').setValue(respuestadata.id_persona);
                
                var text = respuestadata.fec_nac;
                var result_naci = text.substring(0,10);
                var result_naci = result_naci.split("/");
                var dia = result_naci[0];
                var mes = result_naci[1];
                var anio = result_naci[2];
                
                var result_naci_t = anio+'-'+mes+'-'+dia;
                
                $('#frm_fecha_nacimiento_fallecido').setValue(result_naci_t);
                $('#frm_fecha_nacimiento_fallecido').setText(result_naci_t);
                $('#frm_genero_fallecido').setValue(respuestadata.sexo);
              }
            },
            error : function(xhr, status) {
              alert(status);
            },
            complete : function(xhr, status) {
              $("#96986217061e95ce2ad1563044086004").hideFormModal();          
            }
          });
      }else{
    alert("Por favor ingrese los datos requeridos");
    }
});

$("#tri_bandera_alcance").setValue("");
var formId = $("form").prop("id");
  
//Set an onchange event handler for the form. When the value of a field changes in the Dynaform, 
//check whether the changed field is the hasDiscount field in the grid. 
//If so, then if hasDiscount is set to "Discount", then enable the discountRate field in the same row. 
//If set to "No Discount", then disable the discountRate field.
$( "#" + formId ).setOnchange( function(fieldId, newVal, oldVal) {
  //check if a field changed inside the grid:
  var aMatches = fieldId.match(/^\[grd_siniestros_alcances\]\[(\d+)\]\[grd_reanudar3\]$/);
  var aMatches_cober = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_aplicar\]$/);
  var aMatches_vsolicitado = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_valor\]$/);
  //conoce valor cuota
  var aMatches_conoce_vcuota = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_conoce_vcuota\]$/);
  //cambia el valor de la cuota
  var aMatches_vcuota = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_vcuota\]$/);
  //conoce los dias
  var aMatches_conoce_dias = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_conoce_dias\]$/);
  //cambio el num de dias
  var aMatches_dias = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_dias\]$/);
  //conoce los monto
  var aMatches_conoce_monto = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_conoce_monto\]$/);  
  
  if (aMatches) {
    var rowNo = aMatches[1];
    
    if (newVal == "SI") {
      //prendo la bandera de alance
      $("#tri_bandera_alcance").setValue("ALCANCE");
      //para poner el resto en NO
      var nRows = $("#grd_siniestros_alcances").getNumberRows(); 

      for (var i = 1; i <= nRows; i++) {
        if(i != rowNo)
        	$("#form\\[grd_siniestros_alcances\\]\\["+i+"\\]\\[grd_reanudar3\\]").val("NO");
        else{
          var nro_stro = $("#grd_siniestros_alcances").getValue(rowNo, 1)	;//nro_stro
		  var nro_pol = $("#grd_siniestros_alcances").getValue(rowNo, 2)	;//poliza
          var nro_cert = $("#grd_siniestros_alcances").getValue(rowNo, 3)	;//poliza
          var stro_montos = $("#grd_siniestros_alcances").getValue(rowNo, 6)	;//stro_montos
          var txt_contratante = $("#grd_siniestros_alcances").getValue(rowNo, 9)	;//contratante
          var nro_aseg = $("#grd_siniestros_alcances").getValue(rowNo, 22)	;//nro_aseg
          var id_cns = $("#grd_siniestros_alcances").getValue(rowNo, 23)	;//id_cns
          var id_pv = $("#grd_siniestros_alcances").getValue(rowNo, 14)	;//id_pv
          var id_pv_cero = $("#grd_siniestros_alcances").getValue(rowNo, 15)	;//id_pv_cero
          var cod_tercero = $("#grd_siniestros_alcances").getValue(rowNo, 24)	;//cod_tercero
          var cod_aseg = $("#grd_siniestros_alcances").getValue(rowNo, 21)	;//cod_aseg
          var nro_pariente_aux = $("#grd_siniestros_alcances").getValue(rowNo, 25)	;//nro_pariente
          var nro_pariente = (nro_pariente_aux == '' ? 0 : nro_pariente_aux);
          var cod_ramo = $("#grd_siniestros_alcances").getValue(rowNo, 12)	;//cod_ramo
          var cod_suc = $("#grd_siniestros_alcances").getValue(rowNo, 11)	;//cod_suc
          //falta estos
          var linea_negocio = 0;//poliza
          var fec_ingreso_pol = 0;//poliza
          var txt_broker = 0;//poliza
          //hasta aqui
          var txt_contratante = $("#grd_siniestros_alcances").getValue(rowNo, 26)	;//txt_contratante
          var cod_amparo = $("#grd_siniestros_alcances").getValue(rowNo, 27);
          var cod_riesgo = $("#grd_siniestros_alcances").getValue(rowNo, 28);
          
          var validacion = cod_amparo+'|'+cod_riesgo;
          $("#tri_bandera_valida").setValue(validacion);
		  
		  var cod_causa = $("#grd_siniestros_alcances").getValue(rowNo, 16);
		  var id_stro = $("#grd_siniestros_alcances").getValue(rowNo, 29);
		  
		  $('#tri_id_stro').setValue(id_stro);
		  $('#tri_nro_stro').setValue(nro_stro);
		  $('#frm_causa_siniestro').setValue(cod_causa);
          
          //montos
          var arr_mon = stro_montos.split("/");
          $('#frm_monto_pagado_al').setValue(arr_mon[0]);
          
          /*cargar el combo de polizas
          $('#frm_polizas').getControl().empty();
          $('#frm_polizas').getControl().append( new Option("--- Seleccione ---", "") );
          $('#frm_polizas').getControl().append( new Option(nro_pol+' - '+txt_contratante+' - '+nro_aseg, id_cns+'|'+id_pv+'|'+id_pv_cero+'|'+cod_tercero+'|'+cod_aseg+'|'+nro_aseg+'|'+nro_pariente+'|'+nro_pol+'|'+cod_ramo+'|'+cod_suc+'|'+linea_negocio+'|'+fec_ingreso_pol+'|'+txt_broker+'|'+txt_contratante ) );
          
                   
          //cargar el combo de coberturas
           $('#frm_coberturas').getControl().empty();
           $('#frm_coberturas').getControl().append( new Option("--- Seleccione ---", "") );
          $('#frm_coberturas').getControl().append( new Option(item.txt_desc_riesgo+' - '+item.imp_suma_aseg, item.cod_cobertura+'|'+item.imp_suma_aseg+'|'+item.cod_amparo+'|'+item.cod_categ+'|'+item.cod_ramo_tec+'|'+item.cod_riesgo+'|'+item.cod_subramo_tec+'|'+item.id_cns+'|'+item.id_cob+'|'+item.ind_riesgo+'|'+item.cod_objeto ) );
          */
          //bloqueo combos de polizas y coberturas
          $('#frm_polizas').getControl().attr("disabled", true);
          $('#frm_coberturas').getControl().attr("disabled", true);
          $('#frm_monto_reportado').show();
          //$('#frm_monto_reportado').disableValidation();
          $('#frm_tipo_asegurado').disableValidation();
          $('#frm_cie_siniestro').disableValidation();
          //$('#frm_dias_respuesta').show();
          $('#frm_sbt_docs').show();
          $('#55241990862ba1704c23881005873211').show();
          $('#frm_sbt_datAsegurado').show();
          $('#13722500361d66707a60381015639101').show();
          $('#frm_causa_siniestro').hide();
          $('#frm_cie_siniestro').hide();
          //$('#frm_accion').show();
          $('#frm_comentario').show();
          $('#btn_enviar').show();
        }          
      }
    }else{
    	$("#tri_bandera_alcance").setValue("");
      	$("#tri_bandera_valida").setValue('');
    }
  }
  //grid de coberturas
  if (aMatches_cober) {
    var rowNo_g = aMatches_cober[1];
	$("#frm_check_documentos").setValue('');
	$("#frm_cober_select").setValue('');
    
    if (newVal == "SI") {
      //primero valido con el grid de alcances y pagos pagos parciales
	  //validacion para no duplicar resrvaer combo polizas
	  var txt_poli = $("#frm_polizas").getValue();
	  var arr_poli = txt_poli.split("|");
	  var num_poliza = arr_poli[7];
	  var num_certificado = arr_poli[15];
	  //alert(num_poliza);
	  var txt_fec_ocu = $("#frm_fecha_ocurrencia").getValue();
	  var fec_ocu = replaceAll(txt_fec_ocu, '-', '/');
	  new Date(fec_ocu);
	  $("#frm_cobertura_madre").setValue($("#grd_coberturas").getValue(rowNo_g, 31));//grd_txt_cobertura
	  var cobertura = $("#grd_coberturas").getValue(rowNo_g, 12);//grd_txt_cobertura
	   //console.log(fec_ocu+'--');
	  if ($("#grd_siniestros_alcances").getValue(1, 1) !== '') {
	  var aStros = $("#grd_siniestros_alcances").getValue();
		for (var i=0; i < aStros.length; i++) {
			var num_stro = aStros[i][0];//numero de siniestros
			var num_polistro = aStros[i][1];//poliza
          	var num_certstro = aStros[i][2];//poliza
			var estado = aStros[i][7];//estado
			var cobertura_stro = aStros[i][27];//cod_riesgo
			var montos_stro = aStros[i][5];//montos
			var arr_fec_ocurr_stro = aStros[i][6].split(" ");//fecha de siniestros
			var fech_sola = arr_fec_ocurr_stro[0];
			var arr_feech_sola = fech_sola.split("/");
			var fec_day = (arr_feech_sola[0].length == 1 ? 0+arr_feech_sola[0] : arr_feech_sola[0]);
			var fec_mont = (arr_feech_sola[1].length == 1 ? 0+arr_feech_sola[1] : arr_feech_sola[1]);
			var fec_year = arr_feech_sola[2];
			var fec_ocurr_stro = fec_year+'/'+fec_mont+'/'+fec_day;
			new Date(fec_ocurr_stro);
		  //console.log(fec_ocurr_stro);
		  //para los pagos parciales
		  if(estado == 1 && estado == 3){
			if(num_poliza == num_polistro && num_certificado == num_certstro && cobertura == cobertura_stro && fec_ocu == fec_ocurr_stro){
				alert("Ya existe un siniestro en proceso de pago");
				bandera_validacion = 'true';
				$("#grd_coberturas").setValue("NO", rowNo_g, 3);
				$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_dias\\]").prop("disabled", true);
			  //ocultar todo
					  /*$("#frm_sbt_datAsegurado").hide();
					  $("#13722500361d66707a60381015639101").hide();
					  $("#frm_sbt_docs").hide();
					  $("#40350410561d9cbe0f0c3b3037075503").hide();
					  $("#frm_accion").hide();
					  $("#frm_comentario").hide();
					  $("#btn_enviar").hide();*/
				//existe en el manager
				var aManager = $("#grd_siniestros_parcial").getValue();
				for (var j=0; j < aManager.length; j++) {
					var num_stro_par = aManager[j][0];//num siniestro
					var num_caso_par = aManager[j][1];//num siniestro
					if(num_stro == num_stro_par){
						alert("En el manager ya existe un Siniestro en la tarea 5.2 Revisar la bandeja de Sin asignar \n Num Caso: "+num_caso_par);
						//ocultar todo
					  /*$("#frm_sbt_datAsegurado").hide();
					  $("#13722500361d66707a60381015639101").hide();
					  $("#frm_sbt_docs").hide();
					  $("#40350410561d9cbe0f0c3b3037075503").hide();
					  $("#frm_accion").hide();
					  $("#frm_comentario").hide();
					  $("#btn_enviar").hide();*/
					}
				}
				return false;
			}else{
				var indice = $("#grd_coberturas").getValue(rowNo_g, 12);//grd_txt_valor
				//validaciones para cada cobertura
				//gastos
				if(indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470)
				{
					$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_monto\\]").prop("disabled", false);	
					alert("Por favor seleccione si conoce el monto \n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
				}else{
				  //renta
					if(indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456){
					   $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_dias\\]").prop("disabled", false);
					   alert("Por favor seleccione si conoce los dias \n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
					   }else{
							//desempleo
							if(indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507)
							  {
								  $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_vcuota\\]").prop("disabled", false);
								  alert("Por favor seleccione si conoce el valor de la cuota\n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
								  
							  }else{                   
								$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor\\]").prop("disabled", false);
								$("#grd_coberturas").setValue($("#grd_coberturas").getValue(rowNo_g, 2), rowNo_g, 11);
							  }
					   }
				}				
			}
		  }else{
			//para los alcances
			if(estado == 3 || estado == 1){
              var montos_des = montos_stro.split("/");
              var monto_1 = montos_des[0];
              var monto_2 = montos_des[1];
				//alert(num_poliza +'-'+ num_polistro +'-'+ cobertura +'-'+ cobertura_stro +'-'+ fec_ocu +'-'+ fec_ocurr_stro);
				//desbloquear el grid de alcances validar montos	
			  if(num_poliza == num_polistro && cobertura == cobertura_stro && fec_ocu == fec_ocurr_stro && monto_1 == monto_2){
				alert("Ya existe un siniestro registrado \n debe aplicar un alcance en el grid de alcances");
				bandera_validacion = 'true';
                $("#96000800361d66285a6b129007859955").show();
                $("#grd_siniestros_registrados").hide();
                $("#grd_siniestros_enproceso").hide();
                $("#grd_siniestros_parcial").hide();
                
				//$("#grd_coberturas").setValue("NO", rowNo_g, 3);
				$("#grd_coberturas").setValue("SI", rowNo_g, 4);
				$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_dias\\]").prop("disabled", true);
				$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor\\]").prop("disabled", false);
					  //$("#frm_monto_reportado").hide();
					  //$("#frm_dias_respuesta").hide();
					  $("#frm_sbt_datAsegurado").hide();
					  $("#13722500361d66707a60381015639101").hide();
					  $("#frm_sbt_docs").hide();
					  $("#55241990862ba1704c23881005873211").hide();
					  var aux1 = i+1;
					  $("#form\\[grd_siniestros_alcances\\]\\["+aux1+"\\]\\[grd_reanudar3\\]").prop("disabled", false);
					  $("#frm_accion").hide();
					  $("#frm_comentario").hide();
					  $("#btn_enviar").hide();
					  //desabilito todo lo del grid de coberturas
					  var nRowsp = $("#grd_coberturas").getNumberRows(); 
					  for (var ip = 1; ip <= nRowsp; ip++) {
						if(ip != rowNo_g){
							$("#form\\[grd_coberturas\\]\\["+ip+"\\]\\[grd_txt_aplicar\\]").val("NO");
							$("#form\\[grd_coberturas\\]\\["+ip+"\\]\\[grd_txt_aplicar\\]").prop("disabled", true);
						}
					  }
					return false;
			  }else{
				 $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor\\]").prop("disabled", false);
				 var indice = $("#grd_coberturas").getValue(rowNo_g, 12);//grd_txt_valor
				//validaciones para cada cobertura
				//gastos
				if(indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470)
				{
					$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_monto\\]").prop("disabled", false);
					$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_monto\\]").prop("disabled", false);	
					alert("Por favor seleccione si conoce el monto \n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
				}else{
				  //renta
					if(indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456){
					   $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_dias\\]").prop("disabled", false);
					   alert("Por favor seleccione si conoce los dias \n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
					   }else{
							//desempleo
							if(indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507)
							  {
								  $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_vcuota\\]").prop("disabled", false);
								  alert("Por favor seleccione si conoce el valor de la cuota\n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
									//return false;
							  }else{                   
								$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor\\]").prop("disabled", false);
                                $("#grd_coberturas").setValue($("#grd_coberturas").getValue(rowNo_g, 2), rowNo_g, 11);
							  }
					   }
				}
			  }
			}else{
				var indice = $("#grd_coberturas").getValue(rowNo_g, 12);//grd_txt_valor
				//validaciones para cada cobertura
				//gastos
				if(indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470)
				{
					$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_monto\\]").prop("disabled", false);
					$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_monto\\]").prop("disabled", false);	
					alert("Por favor seleccione si conoce el monto \n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
				}else{
				  //renta
					if(indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456){
					   $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_dias\\]").prop("disabled", false);
					   alert("Por favor seleccione si conoce los dias \n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
					   }else{
							//desempleo
							if(indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507)
							  {
								  $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_vcuota\\]").prop("disabled", false);
								  alert("Por favor seleccione si conoce el valor de la cuota\n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
								  
							  }else{                   
								$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor\\]").prop("disabled", false);
                                $("#grd_coberturas").setValue($("#grd_coberturas").getValue(rowNo_g, 2), rowNo_g, 11);
							  }
					   }
				}
				
			}
		  }
		}
	  }else{
  
	  /*
      var nRows_g = $("#grd_coberturas").getNumberRows();
      for (var i = 1; i <= nRows_g; i++) {
        var indice = $("#grd_coberturas").getValue(rowNo_g, 12);//grd_txt_valor
	  }
	  */
	
		var indice = $("#grd_coberturas").getValue(rowNo_g, 12);//grd_txt_valor
			//validaciones para cada cobertura
			//gastos
			if(indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470)
			{
				$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_monto\\]").prop("disabled", false);
				$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_monto\\]").prop("disabled", false);	
					alert("Por favor seleccione si conoce el monto \n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
			}else{
			  //renta
				if(indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456){
				   $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_dias\\]").prop("disabled", false);
				   alert("Por favor seleccione si conoce los dias \n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
				   }else{
						//desempleo
						if(indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507)
						  {
							  $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_vcuota\\]").prop("disabled", false);
							  alert("Por favor seleccione si conoce el valor de la cuota\n Caso contrario seleccione NO para que el sistema le asigne el valor referencial");
							  
						  }else{                   
							$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor\\]").prop("disabled", false);
                            $("#grd_coberturas").setValue($("#grd_coberturas").getValue(rowNo_g, 2), rowNo_g, 11);
						  }
				   }
			}
	  }
	}else{
		$("#grd_coberturas").setValue("", rowNo_g, 11)
		$("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor\\]").prop("disabled", true);
		
	}
  }
  //grid de coberturas monto solicitado
  if (aMatches_vsolicitado) {
    var rowNo_gv = aMatches_vsolicitado[1];
    $("#frm_monto_reportado").setValue(0);
    
    if (newVal != "") {
        var grd_imp_suma_aseg = $("#grd_coberturas").getValue(rowNo_gv, 2)	;//grd_imp_suma_aseg
		var grd_txt_valor = $("#grd_coberturas").getValue(rowNo_gv, 11);//grd_txt_valor		
		var indice = $("#grd_coberturas").getValue(rowNo_gv, 12);//grd_txt_valor		
		
		if(indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470 || indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456 || indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507){
			$("#form\\[grd_coberturas\\]\\["+rowNo_gv+"\\]\\[grd_txt_valor\\]").prop("disabled", true);	
			$("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
		}else{
			if(grd_imp_suma_aseg != 0 && grd_txt_valor > grd_imp_suma_aseg){
				alert("No se puede reportar un monto mayor del asegurado");			
				$("#grd_coberturas").setValue("", rowNo_gv, 11);
			}else{
				if(grd_imp_suma_aseg == 0){
					$("#grd_coberturas").setValue("1", rowNo_gv, 11);
					$("#form\\[grd_coberturas\\]\\["+rowNo_gv+"\\]\\[grd_txt_valor\\]").prop("disabled", true);	
					alert("Al ser una cobertura de servicio se registra con el valor de 1\n Una vez realizado el analisis se ajusta el valor");
				}
			}
			$("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
		}
    }
  }
  //grid de coberturas conoce el valor de la cuota
  if (aMatches_conoce_vcuota) {
    var rowNo_cvc = aMatches_conoce_vcuota[1];
    
    if (newVal == "SI") {
		$("#form\\[grd_coberturas\\]\\["+rowNo_cvc+"\\]\\[grd_txt_vcuota\\]").prop("disabled", false);
    }else{
		$("#form\\[grd_coberturas\\]\\["+rowNo_cvc+"\\]\\[grd_txt_vcuota\\]").prop("disabled", true);
		$("#grd_coberturas").setValue("", rowNo_cvc, 6);
		var grd_imp_suma_aseg = $("#grd_coberturas").getValue(rowNo_cvc, 2)	;//grd_imp_suma_aseg
		var total = grd_imp_suma_aseg * 2;
		$("#grd_coberturas").setValue(total, rowNo_cvc, 11);
	}
	$("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
  }
  //grid de coberturas valor de la cuota
  if (aMatches_vcuota) {
    var rowNo_vc = aMatches_vcuota[1];
    
    if (newVal != "") {
		if(newVal > 2000){
			$("#grd_coberturas").setValue(2000, rowNo_vc, 6);	
			newVal = 2000;
		}
		
		var total = newVal * 2;
		$("#grd_coberturas").setValue(total, rowNo_vc, 11);
		$("#form\\[grd_coberturas\\]\\["+rowNo_vc+"\\]\\[grd_txt_vcuota\\]").prop("disabled", false);
    }else{
		var grd_imp_suma_aseg = $("#grd_coberturas").getValue(rowNo_vc, 2)	;//grd_imp_suma_aseg
		var total = grd_imp_suma_aseg * 2;
		$("#grd_coberturas").setValue(total, rowNo_vc, 11);
	}	
	$("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
  }
   //grid de coberturas conoce los dias
  if (aMatches_conoce_dias) {
    var rowNo_cd = aMatches_conoce_dias[1];
    
    if (newVal == "SI") {
		$("#form\\[grd_coberturas\\]\\["+rowNo_cd+"\\]\\[grd_txt_dias\\]").prop("disabled", false);
    }else{
		$("#form\\[grd_coberturas\\]\\["+rowNo_cd+"\\]\\[grd_txt_dias\\]").prop("disabled", true);
		$("#grd_coberturas").setValue(3, rowNo_cd, 8);
		var grd_imp_suma_aseg = $("#grd_coberturas").getValue(rowNo_cd, 2)	;//grd_imp_suma_aseg
		var total = grd_imp_suma_aseg * 3;
		if(grd_imp_suma_aseg != 0)
			$("#grd_coberturas").setValue(total, rowNo_cd, 11);
		else
			$("#grd_coberturas").setValue(1, rowNo_cd, 11);
	}
	$("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
  }
  //grid de coberturas cambgia los dias
  if (aMatches_dias) {
    var rowNo_d = aMatches_dias[1];
    
    if (newVal != "") {
		var grd_imp_suma_aseg = $("#grd_coberturas").getValue(rowNo_d, 2)	;//grd_imp_suma_aseg
		var grd_imp_dias = $("#grd_coberturas").getValue(rowNo_d, 8)	;//grd_imp_suma_aseg
		var total = grd_imp_suma_aseg * grd_imp_dias;
		if(grd_imp_suma_aseg != 0)
			$("#grd_coberturas").setValue(total, rowNo_d, 11);
		else
			$("#grd_coberturas").setValue(1, rowNo_d, 11);		
    }else{
		var grd_imp_suma_aseg = $("#grd_coberturas").getValue(rowNo_d, 2)	;//grd_imp_suma_aseg
		var total = grd_imp_suma_aseg * 3;
		if(grd_imp_suma_aseg != 0)
			$("#grd_coberturas").setValue(total, rowNo_d, 11);
		else
			$("#grd_coberturas").setValue(1, rowNo_d, 11);
	}
	$("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
  }
  //grid de coberturas conoce monto
  if (aMatches_conoce_monto) {
    var rowNo_cm = aMatches_conoce_monto[1];
    
    if (newVal == "SI") {
		$("#form\\[grd_coberturas\\]\\["+rowNo_cm+"\\]\\[grd_txt_valor\\]").prop("disabled", false);
		$("#grd_coberturas").setValue("", rowNo_cm, 10);
    }else{
		$("#form\\[grd_coberturas\\]\\["+rowNo_cm+"\\]\\[grd_txt_valor\\]").prop("disabled", true);
		var sum_aseg = $("#grd_coberturas").getValue(rowNo_cm, 2)	;//grd_imp_suma_aseg		
		if(sum_aseg > 0 && sum_aseg < 251){
    	//50%
      	var tot_res = (sum_aseg*1) / 2;
			$("#grd_coberturas").setValue(50, rowNo_cm, 10);
			$("#grd_coberturas").setValue(tot_res, rowNo_cm, 11);
		}
		if(sum_aseg > 250 && sum_aseg < 501){
			//46%
			var tot_res = (sum_aseg*46) / 100;
		  $("#grd_coberturas").setValue(46, rowNo_cm, 10);
			$("#grd_coberturas").setValue(tot_res, rowNo_cm, 11);
		}if(sum_aseg > 500 && sum_aseg < 1001){
			//23%
			var tot_res = (sum_aseg*23) / 100;
		  $("#grd_coberturas").setValue(23, rowNo_cm, 10);
			$("#grd_coberturas").setValue(tot_res, rowNo_cm, 11);
		}if(sum_aseg > 1000 && sum_aseg < 2001){
			//19%
			var tot_res = (sum_aseg*19) / 100;
		  $("#grd_coberturas").setValue(19, rowNo_cm, 10);
			$("#grd_coberturas").setValue(tot_res, rowNo_cm, 11);
		}if(sum_aseg > 2000 && sum_aseg < 3001){
			//17%
			var tot_res = (sum_aseg*17) / 100;
		  $("#grd_coberturas").setValue(17, rowNo_cm, 10);
			$("#grd_coberturas").setValue(tot_res, rowNo_cm, 11);
		}if(sum_aseg > 3000 && sum_aseg < 5001){
			//13%
			var tot_res = (sum_aseg*13) / 100;
		  $("#grd_coberturas").setValue(13, rowNo_cm, 10);
			$("#grd_coberturas").setValue(tot_res, rowNo_cm, 11);
		}if(sum_aseg > 5000){
			//9%
			var tot_res = (sum_aseg*9) / 100;
		  $("#grd_coberturas").setValue(9, rowNo_cm, 10);
			$("#grd_coberturas").setValue(tot_res, rowNo_cm, 11);
		}
	}
	$("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
  }
});

$("#btn_enviar").find("button").click(function() {
   //save work and return to the same DynaForm
   $("#btn_enviar").hide();
});
