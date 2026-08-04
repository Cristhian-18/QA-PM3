function tipo_asegurado(newValue) {
	//ocultar
  if(newValue == 'O'){
    $("#frm_tipo_documento_fallecido").show();
    $("#frm_documento_fallecido").show();
    $("#frm_apellido_paterno_fallecido").show();
    $("#frm_apellido_materno_fallecido").show();
    $("#frm_nombres_fallecido").show();
    $("#frm_parentesco_fallecido").show();
    $("#frm_fecha_nacimiento_fallecido").show();
    $("#frm_genero_fallecido").show();
  }else{
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

function Monto_liquidar(){


var txt_cober = $("#frm_coberturas").getValue();
var arr_cober = txt_cober.split("|");
var indice = arr_cober[0];
  
//renta
  if(indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507 || indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456){
         
    if($("#tri_bandera_monto").getValue() == 'true'){
		$("#frm_monto_liquidar").setValue($("#frm_monto_aprobado").getValue());
    	$("#frm_monto_liquidar").getControl().attr('disabled',true);
	}else{
	 if (($("#frm_monto_liquidar").getValue()*1) > ($("#frm_monto_reportado").getValue()*1)) {
        alert("No puede reportar un monto mayor al asegurado");
      	$("#frm_monto_liquidar").setValue('0.00');
    	}
    }
  }else{
    if($("#tri_bandera_monto").getValue() == 'true'){
		$("#frm_monto_liquidar").setValue($("#frm_monto_aprobado").getValue());
    	$("#frm_monto_liquidar").getControl().attr('disabled',true);
	}else{
      if(($("#frm_monto_asegurado").getValue()*1) == 0){
        $("#frm_monto_liquidar").setValue($("#frm_monto_reportado").getValue());
    	$("#frm_monto_liquidar").getControl().attr('disabled',true);
      }else{
	 if (($("#frm_monto_liquidar").getValue()*1) > ($("#frm_monto_asegurado").getValue()*1) ) {
         alert("No puede reportar un monto mayor al asegurado");
      	$("#frm_monto_liquidar").setValue('0.00');
    	}  
      }
  }
  }
  
  if($("#tri_bandera_sac").getValue() == 'true'){
		$("#frm_monto_liquidar").setValue($("#frm_monto_reportado").getValue());
    	$("#frm_monto_liquidar").getControl().attr('disabled',true);
    	$("#frm_monto_liquidar").hide();
	}
    
}

Monto_liquidar();
//$("#frm_monto_liquidar").focusout(Monto_liquidar);


function datos_validaciones(indice){
  $('#frm_conoce_monto').hide();
  $('#frm_porcentaje_aplica').hide();
  $('#frm_conoce_dias').hide();
  $('#frm_aplica_dias').hide();
  $('#frm_conoce_cuotas').hide();
  $('#frm_aplica_cuotas').hide();
  $('#frm_valor_cuota').hide();
	if(indice == 0)
    {
    	$('#frm_conoce_monto').hide();
      	$('#frm_porcentaje_aplica').hide();
      	$('#frm_conoce_dias').hide();
      	$('#frm_aplica_dias').hide();
    }else{
      	//gastos
    	if(indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470)
        {
            $('#frm_conoce_monto').show();
            $('#frm_porcentaje_aplica').show();
        }else{
          //renta
        	if(indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456){
               	$('#frm_conoce_dias').show();    
              	$('#frm_aplica_dias').show();    
               }else{
                 	//desempleo
              		if(indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507)
                      {
                          $('#frm_conoce_cuotas').show();
                          $('#frm_aplica_cuotas').show();
                          $('#frm_valor_cuota').show();
                      }else{                   
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



