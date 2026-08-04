$("#chk_errores").find("div.checkbox").addClass("radio-inline");
$("#chk_errores_poliza").find("div.checkbox").addClass("radio-inline");

$("#chk_errores").hide();
$("#chk_errores_poliza").hide();
$("#frm_estado_cu").hide();
$("#frm_anexo_crs").hide();
$("#frm_estado_cu").disableValidation();
$("#frm_anexo_crs").disableValidation();

function acciones(){
var accion =   $("#frm_accion").getControl().val();
  //alert ("accion");
  if(accion == 'REPROCESAR'){
    $("#chk_errores").show();
    $("#frm_comentario").setLabel('Dictamen para Comercial');
    //$("#chk_errores_poliza").show();
    $("#frm_estado_cu").disableValidation();
	$("#frm_anexo_crs").disableValidation();
    $("#frm_estado_cu").hide();
    $("#frm_anexo_crs").hide();
  }
  else
  {
    if(accion == 'CONTINUAR'){
       	$("#chk_errores").hide();
      	$("#frm_estado_cu").show();
		$("#frm_anexo_crs").show();
      	$("#frm_estado_cu").enableValidation();
		$("#frm_anexo_crs").enableValidation();
		$("#frm_comentario").setLabel('Observaciones para Emision');
    }else{
    	if(accion == 'RECHAZAR'){
          $("#chk_errores").hide();
          $("#frm_estado_cu").hide();
          $("#frm_anexo_crs").hide();
          $("#frm_estado_cu").disableValidation();
          $("#frm_anexo_crs").disableValidation();
          $("#frm_comentario").setLabel('Dictamen para Comercial_Rechazo o Aplazo');
    	}else{
    		$("#chk_errores").hide();
    		//$("#chk_errores_poliza").hide();
			$("#frm_comentario").setLabel('Comentarios');
           	$("#frm_estado_cu").hide();
          	$("#frm_anexo_crs").hide();
      		$("#frm_estado_cu").disableValidation();
			$("#frm_anexo_crs").disableValidation();
        }
  	}
  }
}


$('#frm_accion').setOnchange(acciones);
acciones();