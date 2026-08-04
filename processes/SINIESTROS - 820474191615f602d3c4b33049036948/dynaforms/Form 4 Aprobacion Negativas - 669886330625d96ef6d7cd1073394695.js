//$(document).ready(function() {
//Seleccionar todos los campos cuyo ID comienza con 'frm' y deshabilitar la validacion
  // $("[id^='frm'], [id^='frm'], [id^='frm']").each(function() {
   // $(this).disableValidation();
//});
//});


$('#frm_asegurado_mail').getControl().attr("disabled", true);
$('#frm_asegurado_mail_1').getControl().attr("disabled", true);
$('#frm_asegurado_mailAdicional').getControl().attr("disabled", true);
//$("#669886330625d96ef6d7cd1073394695").setOnSubmit(function(){
//var file = $("#frm_documento_NegativaAprobada");
//var file = $("#frm_documento_NegativaAprobada").getText();
//console.log(file);
//if(file.length == 1){
  //alert("Se debe adjuntar un solo elemento en la Negativa Aprobada");
  //return false;
//} else {
  //return false;
//}
//});

$(document).ready(function() {
    // Capturar el evento de clic en el boton de enviar
    $("#btn_enviar").on('click', function(event) {
        // Seleccionar el campo multipleFile por su ID
        var fileInput = $("#frm_documento_NegativaAprobada");
        
        // Verificar si el input contiene algun archivo seleccionado
        if (fileInput[0].files.length > 1) {
            // Mostrar alerta si hay mas de un archivo
            alert("Solo puedes subir un archivo.");

            // Bloquear el envio del formulario
            event.preventDefault();  // Esto previene el envio del formulario
        }
    });
});




////////////////////////////////////////////////////

//created by Henry
if($("#frm_asegurado_mail_1").getValue() == ''){
	$("#frm_asegurado_mail_1").setValue($("#frm_asegurado_mail").getValue());
}

//$('#frm_asegurado_mail_1').getControl().attr("disabled", false);
//$('#frm_asegurado_mail').getControl().attr("disabled", false);

$("#frm_sbt_medico").hide();
$("#71422138261da327fe6a4d5053466166").hide();
$("#frm_fecha_diagnostico").disableValidation();
$("#frm_diagnostico_medico").disableValidation();
$("#frm_antecedentes_medico").disableValidation();
$("#frm_motivo_medica").disableValidation();
$("#frm_resumen_medico").disableValidation();

if($("#tri_bandera_analista").getValue() == 'true'){
	$("#frm_sbt_medico").show()
	$("#71422138261da327fe6a4d5053466166").show()
}


function mensaje(){
  if($("#tri_message_update").getValue() != ''){
    window.dynaform.flashMessage( {
       duration : 8000,
       emphasisMessage: "ERROR: ",
       message:$("#tri_message_update").getValue(),
       type : 'danger',
       appendTo:$('#title0000000001')
    } )
  }
}

mensaje();

function mensaje1(){
  if($("#tri_bandera_alcance").getValue() == 'ALCANCE' || $("#tri_bandera_parcial").getValue() == 'true'){
    window.dynaform.flashMessage( {
       duration : 8000,
       emphasisMessage: "ERROR: ",
       message:"POR FAVOR DAR DE BAJA LA RESERVA EN SISE",
       type : 'danger',
       appendTo:$('#title0000000001')
    } )
  }
}

mensaje1();

function accion(newValue, oldValue) {
  //alert(newValue);
  $("#tri_user_pda").hide();
  $("#tri_user_auditor").hide();
  $("#fle_negativa").hide();
  $("#frm_documento_NegativaAprobada").disableValidation();
  
  if(newValue == 'REASIGNAR_PDA'){
    $("#tri_user_pda").show();
  }
  if(newValue == 'NEGAR'){
    $("#fle_negativa").show();
  }
  if(newValue == 'REASIGNAR'){
    $("#tri_user_auditor").show();
    $("#frm_monto_liquidar").disableValidation();
  }
  if(newValue == 'REGRESAR'){
    $("#frm_documento_NegativaAprobada").disableValidation();
  }
  if(newValue == 'FINALIZAR'){
    $("#frm_documento_NegativaAprobada").enableValidation();
  }
  
}

accion();
$("#frm_accion").setOnchange(accion);