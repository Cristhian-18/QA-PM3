//$('#3662047915f238f68a7fa92019816378').toggle();
//$('#6238792205f95844f06bfb2011814992').toggle();

// •	Cuando Cobro anticipado sea “SI” no se deberá desplegar bloque de datos Cobro Primera Cuota
// •	Cuando Cobro anticipado sea “NO” se deberá desplegar bloque de datos Cobro Primera Cuota

var sw = $("#frm_recibio_deposito").getValue();
//alert (sw);

if (sw == 'S') {
    $('#frm_sbt_debito_primera_cuota').hide();
    $('#6238792205f95844f06bfb2011814992').hide();

    $('#frm_primera_cuota_medio_pago').disableValidation();
    $('#frm_primera_cuota_modalidad').disableValidation();
    $('#frm_primera_cuota_plan').disableValidation();
    $('#frm_primera_cuota_total_primer_pago').disableValidation();
    $('#frm_primera_cuota_descuento').disableValidation();
    $('#frm_primera_cuota_total_pagar').disableValidation();
}

$("#1338086785f95840fbc81b7082554585").setOnSubmit(function () {
    $("#1338086785f95840fbc81b7082554585").saveForm();
	//pago a terceros No
  	if($('#frm_pago_terceros').getValue() == 'N'){
		//validacion de cedula contratante - pagador
		if($('#frm_identificacion_poliza').getValue() == $('#frm_cedula_pagador').getValue()){
			//validacion cambio de cuenta
			if($('#frm_medio_pago').getValue() == 'TARJETA'){
              	var f1 = new Date($("#frm_fecha_caducidad_tarjeta").getValue()); //mes año
				var f2 = new Date($("#fecha_actual").getValue()); //mes año
				if(f1 < f2){
					alert("Revisar la fecha de caducidad de la tarjeta");
					$("#frm_fecha_caducidad_tarjeta").setValue('');
					  return false;
				}else{
					if($('#frm_medio_pago').getValue() == $('#frm_medio_pago_aux').getValue() && 
					 $('#frm_numero_tarjeta').getValue() == $('#frm_numero_tarjeta_aux').getValue() && 
					 $('#frm_tipo_tarjeta').getValue() == $('#frm_tipo_tarjeta_aux').getValue()){
					  alert("No ha cambiado la forma de pago");
						return false;
					}else{
						return true;
					}
				}
			//else medio de pago
			}else{
              if($('#frm_medio_pago').getValue() != '' && $('#frm_numero_tarjeta').getValue() != '' && $('#frm_entidad_financiera').getValue() != ''){
                  if($('#frm_medio_pago').getValue() == $('#frm_medio_pago_aux').getValue() && 
                   $('#frm_numero_tarjeta').getValue() == $('#frm_numero_tarjeta_aux').getValue() && 
                   $('#frm_entidad_financiera').getValue() == $('#frm_entidad_financiera_axu').getValue()){
                      alert("No ha cambiado la forma de pago");
                      return false;
                    }else{
                        return true;
                    }
              }else{
              	alert("Revise campos requeridos");
                return false;
              }
			}
		}//fin de validacion de identificacion
		else{
			alert("Revisar las condiciones de Pago a terceros");
			return false;			
		}
	}//pago a terceros si
	else{
		//validacion de cedula contratante - pagador
		if($('#frm_identificacion_poliza').getValue() != $('#frm_cedula_pagador').getValue()){
			//validacion cambio de cuenta
			if($('#frm_medio_pago').getValue() == 'TARJETA'){
				if($("#frm_fecha_caducidad_tarjeta").getValue() < $("#fecha_actual").getValue()){
					alert("Revisar la fecha de caducidad de la tarjeta");
					$("#frm_fecha_caducidad_tarjeta").setValue('');
					  return false;
				}else{
					if($('#frm_medio_pago').getValue() == $('#frm_medio_pago_aux').getValue() && 
					 $('#frm_numero_tarjeta').getValue() == $('#frm_numero_tarjeta_aux').getValue() && 
					 $('#frm_tipo_tarjeta').getValue() == $('#frm_tipo_tarjeta_aux').getValue()){
					  alert("No ha cambiado la forma de pago");
						return false;
					}else{
						return true;
					}                   
				}
			//else medio de pago
			}else{
				if($('#frm_medio_pago').getValue() == $('#frm_medio_pago_aux').getValue() && 
                 $('#frm_numero_tarjeta').getValue() == $('#frm_numero_tarjeta_aux').getValue() && 
                 $('#frm_entidad_financiera').getValue() == $('#frm_entidad_financiera_axu').getValue()){
					alert("No ha cambiado la forma de pago");
					return false;
				  }else{    
					  return true;
				  }
			}
		}//fin de validacion de identificacion
		else{
			alert("Revisar las condiciones de Pago a terceros");
			return false;			
		}
		
	}
});

$("#btn_financiera_save").find("button").on("click", function () {
    $("#1338086785f95840fbc81b7082554585").saveForm();
    alert("Formulario guardado ...");
});
