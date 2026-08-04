//contraccion
$('#7689594095f3ca309a42d38006294228').toggle(); //asegurado
$('#9802986195f3cace465c8e8078214983').toggle(); //documentos
$('#3481439505f3d658c99b673065865401').toggle(); //acreditar
$('#3420420135f3cad48cf08a7020087388').toggle(); //debitar
$('#2287684385f3ea13a46f6c7064108437').toggle(); //historial


$("#7609791745f3ca215c123e4098208396").setOnSubmit(function(){
  $("#7609791745f3ca215c123e4098208396").saveForm() ;
  return showConfirmDlg();
});

$("#btn_financiera_save").find("button").on("click" , function() {
  $("#7609791745f3ca215c123e4098208396").saveForm();
  alert ("Formulario guardado ...");  
});


function solicitud() {
var newValue = $("#frm_tipo_solicitud").getValue();
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
 
//oculto seccion debito
$('#frm_sbt_debito').hide();
$('#3420420135f3cad48cf08a7020087388').hide();
$('#frm_opcion_debito').disableValidation();
$('#frm_tipo_identificacion_pagador').disableValidation();
$('#frm_cedula_pagador').disableValidation();
$('#frm_entidad_financiera').disableValidation();
$('#frm_medio_pago').disableValidation();
$('#frm_numero_cuenta').disableValidation();

//si es retiro por defecto natural
  if(newValue == 'R'){
	$('#frm_tipo_persona').setValue('N');
  	$('#frm_monto').enableValidation();
    $('#frm_costo_retiro').enableValidation();
    $('#frm_derecho_retiro').enableValidation();
    $('#frm_val_descontado').enableValidation();
    $('#frm_monto').show();
    $('#frm_costo_retiro').show();
    $('#frm_derecho_retiro').show();
    $('#frm_val_descontado').show();
  }
  
  if(newValue == 'P'){
    $('#frm_tipo_persona').setValue('N');
    $('#frm_monto_prestamo').enableValidation();
    $('#frm_frecuencia_pago').enableValidation();
    $('#frm_plazo_prestamo').enableValidation();
    $('#frm_monto_prestamo').show();
    $('#frm_frecuencia_pago').show();
    $('#frm_plazo_prestamo').show();
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
   }
}
solicitud();
//$("#frm_tipo_solicitud").setOnchange(solicitud);

function persona() {
var newValue = $("#frm_tipo_persona").getValue();
//oculto empresa
$('#frm_nombre_empresa').hide();
$('#frm_nombre_empresa').disableValidation();
//oculto y desabilitado documentos
$('#frm_documentos_natural_cedula').hide();
$('#frm_documentos_nombramiento').hide();
$('#frm_documentos_natural_representante_cedula').hide();
$('#frm_documentos_natural_cedula').disableValidation();
$('#frm_documentos_nombramiento').disableValidation();
$('#frm_documentos_natural_representante_cedula').disableValidation();
  
  if(newValue == 'N'){
    //contratante
    //$("#frm_tipo_identificacion").getControl().attr('disabled', false);
    $('#frm_apellido_paterno').setLabel('Apellido Paterno');
    $('#frm_apellido_materno').setLabel('Apellido Materno');
    $('#frm_primer_nombre').setLabel('Nombres');
    //documentos
    $('#frm_documentos_natural_cedula').show();
    $('#frm_documentos_natural_cedula').enableValidation();
  }
 
   if(newValue == 'J'){
     //contratante
     //$('#frm_tipo_identificacion').setValue('R');
     //$("#frm_tipo_identificacion").getControl().attr('disabled', true);
     $('#frm_nombre_empresa').show();
     $('#frm_nombre_empresa').enableValidation();
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
//$("#frm_tipo_persona").setOnchange(persona);

function acreditacion() {
var newValue = $("#frm_tipo_identificacion_receptor").getValue();
  
var persona = $('#frm_tipo_persona').getValue();

  if(newValue == 'C' && persona == 'N'){
    $('#frm_cedula_receptor').setValue($("#frm_numero_identificacion").getValue());
  }
 
   if(newValue == 'R' && persona == 'J'){
    $('#frm_cedula_receptor').setValue($("#frm_numero_identificacion").getValue());
   }
   
   if(newValue == 'C' && persona == 'J'){
	var res = $("#frm_numero_identificacion").getValue().substring(0,10);
    $('#frm_cedula_receptor').setValue(res);
   }
   
   if(newValue == 'R' && persona == 'N'){
    $('#frm_cedula_receptor').setValue($("#frm_numero_identificacion").getValue()+'001');
   }
}

//acreditacion();
//$("#frm_tipo_identificacion_receptor").setOnchange(acreditacion);

function debito() {
var newValue = $("#frm_opcion_debito").getValue();
  
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
//debito();
//$("#frm_opcion_debito").setOnchange(debito);