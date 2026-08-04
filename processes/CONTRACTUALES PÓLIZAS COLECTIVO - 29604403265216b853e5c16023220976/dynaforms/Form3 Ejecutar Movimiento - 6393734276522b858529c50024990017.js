//
function action(newVal, oldVal) {
    if (newVal == 'CONTINUAR') {
        $("#frm_emisor_asignado").show();
      	$("#frm_emisor_asignado").enableValidation();
    } else {
       $("#frm_emisor_asignado").hide();
      $("#frm_emisor_asignado").disableValidation();
    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(action);

//

function ocultarTodo(){
	$("#7934340406522afa0b6ed54047470201").hide(); //Cancelaciones
	$("#frm_datosCancelacion_poliza").disableValidation();
  $("#frm_datosCancelacion_fechaVigencia").disableValidation();
  $("#frm_datosCancelacion_motivo").disableValidation();

  	$("#8809799596522b259653331054481206").hide(); //Contractual
    $("#frm_datosContractual_poliza").disableValidation();

  	$("#4611306546522b51cd7d158024974567").hide(); //Extension
    $("#frm_datosExtencion_poliza").disableValidation();
    $("#frm_datosExtencion_motivo").disableValidation();
    $("#frm_datosExtencion_fechaInicio").disableValidation();
    $("#frm_datosExtencion_fechaFin").disableValidation();


}

function checkTipoRequerimiento(newVal, oldVal) {
  ocultarTodo();
  switch(newVal){
    case 'Cancelacion':
      	$("#7934340406522afa0b6ed54047470201").show();
        $("#frm_datosCancelacion_poliza").enableValidation();
        $("#frm_datosCancelacion_fechaVigencia").enableValidation();
        $("#frm_datosCancelacion_motivo").enableValidation();
    break;
    case 'Contractual':
      $("#8809799596522b259653331054481206").show();
      $("#frm_datosContractual_poliza").enableValidation();

    break;
    case 'Extencion':
      $("#4611306546522b51cd7d158024974567").show();
      $("#frm_datosExtencion_poliza").enableValidation();
    $("#frm_datosExtencion_motivo").enableValidation();
    $("#frm_datosExtencion_fechaInicio").enableValidation();
    $("#frm_datosExtencion_fechaFin").enableValidation();
    break;
    default:
      //aqui mostrar algo
    break;       
  }
}
//execute when the Dynaform loads
$('#frm_datosSolicitud_tipo').setOnchange(checkTipoRequerimiento);

if($("#frm_datosSolicitud_tipo").getValue() != ''){
  	ocultarTodo();
	checkTipoRequerimiento($("#frm_datosSolicitud_tipo").getValue(), ''); 
}else{
	ocultarTodo();
}