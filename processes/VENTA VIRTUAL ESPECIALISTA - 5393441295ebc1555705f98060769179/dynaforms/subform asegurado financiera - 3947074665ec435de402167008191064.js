	$( document ).ready(function() {
	  if(typeof validarExpresionRegular === 'function') {
		//validarExpresionRegular("frm_financiera_actividad_principal", 4);
		//validarExpresionRegular("frm_financiera_otros_ingresos", 4);
		//validarExpresionRegular("frm_ingresos_familiares", 4);
		//validarExpresionRegular("frm_financiera_total_egresos", 4);
		//validarExpresionRegular("frm_financiera_total_activos", 4);
		//validarExpresionRegular("frm_financiera_total_pasivos", 4);
		//validarExpresionRegular("frm_financiera_total_patrimonio", 4);
		//validarExpresionRegular("frm_ingresos_ultimo_anio", 4);
		//validarExpresionRegular("frm_financiera_otros_ingresos", 4);
		//validarExpresionRegular("frm_ingresos_anterior_anio", 4);

	  }
	  //$("#frm_origen_otros_ingresos").hide();
	  //$("#frm_origen_otros_ingresos").enableValidation(); 

	  otrosIngresos( $('#frm_tiene_otra_actividad').getValue().trim());
	  calcular_patrimonio();
	  //calcular();
	  //anios();
	});

	if(typeof validarExpresionRegular === 'function') {

	  //ponerDecimales("frm_financiera_total_egresos");
	  //ponerDecimales("frm_financiera_total_activos");
	  //ponerDecimales("frm_financiera_total_pasivos");  
	  $("#frm_financiera_actividad_principal").focusout(function(){
		//ponerDecimales("frm_financiera_actividad_principal");
		validarExpresionRegular("frm_financiera_actividad_principal", 4);
	  });
	  
	  $("#frm_ingresos_familiares").focusout(function(){
		//ponerDecimales("frm_ingresos_familiares");
		validarExpresionRegular("frm_ingresos_familiares", 4);
	  });

	  $("#frm_financiera_total_egresos").focusout(function(){
		//ponerDecimales("frm_financiera_total_egresos");
		validarExpresionRegular("frm_financiera_total_egresos", 4);
	  });

	  $("#frm_financiera_total_activos").focusout(function(){
		//ponerDecimales("frm_financiera_total_activos");
		validarExpresionRegular("frm_financiera_total_activos", 4);
	  });

	  $("#frm_financiera_total_pasivos").focusout(function(){
		//ponerDecimales("frm_financiera_total_pasivos");
		validarExpresionRegular("frm_financiera_total_pasivos", 4);
	  });

	  /*$("#frm_ingresos_ultimo_anio").focusout(function(){
		ponerDecimales("frm_ingresos_ultimo_anio");
		validarExpresionRegular("frm_ingresos_ultimo_anio", 4);
	  });*/

	  $("#frm_financiera_otros_ingresos").focusout(function(){
		var ingresos = $("#frm_financiera_otros_ingresos").getControl().val();
		let result = ingresos.replace(",", "");
		console.log(result);
		if (result > 0) 
		{
		  $("#frm_origen_otros_ingresos").show();
		  $("#frm_origen_otros_ingresos").enableValidation(); 
		}
		else
		{
		  $("#frm_origen_otros_ingresos").hide();
		  console.log('vacio');
		  $("#frm_origen_otros_ingresos").setValue('');
		  $("#frm_origen_otros_ingresos").disableValidation();
		}
		//ponerDecimales("frm_financiera_otros_ingresos");
		validarExpresionRegular("frm_financiera_otros_ingresos", 4);
	  });


	  /*$("#frm_ingresos_anterior_anio").focusout(function(){
		ponerDecimales("frm_ingresos_anterior_anio");
		validarExpresionRegular("frm_ingresos_anterior_anio", 4);
	  });*/


	}

	//if(typeof validarExpresionRegular === 'function') {
	//	validarExpresionRegular("frm_origen_otros_ingresos", 1);
	//}

	//Sumar el total de ingresos
	$("#frm_financiera_actividad_principal, #frm_financiera_otros_ingresos").focusout(function (){
	  //calcular();
	});

	function otrosIngresos(otrosIngresosValue){
	  //alert (otrosIngresosValue*1);
	  
	  
	  if(otrosIngresosValue == 'S' ){
		jQuery("#frm_origen_otros_ingresos").enableValidation();
		jQuery("#frm_origen_otros_ingresos").enableValidation();
		jQuery("#frm_financiera_otros_ingresos").show();
		jQuery("#frm_origen_otros_ingresos").show();

	  }
	  else{
		jQuery("#frm_financiera_otros_ingresos").disableValidation();
		jQuery("#frm_origen_otros_ingresos").disableValidation();
		jQuery("#frm_financiera_otros_ingresos").hide();
		jQuery("#frm_origen_otros_ingresos").hide();
	  }
	}

	/*function anios(){
	  var fecha = new Date();
	  var anio = fecha.getFullYear();
	  var ultimoanio=anio-1;
	  var anioanterior=anio-2;
	  $("#frm_ingresos_ultimo_anio").setLabel("Ingreso anio "+ ultimoanio);
	  $("#frm_ingresos_anterior_anio").setLabel("Ingreso anio "+ anioanterior);
	}*/

	$("#frm_tiene_otra_actividad").setOnchange( function(){
		otrosIngresos($('#frm_tiene_otra_actividad').getValue().trim());
	});


	$("#frm_plan_pago_impuestos").setOnchange( function(){
	  var res = $("#frm_plan_pago_impuestos").getControl().val();
	  if (res == 'NO') alert("Llene el formulario AUTO CERTIFICACION DE RESIDENCIA FISCAL");

	});

	function calcular(){

	  validarExpresionRegular("frm_financiera_actividad_principal", 4);
	  validarExpresionRegular("frm_financiera_otros_ingresos", 4);	
	  validarExpresionRegular("frm_ingresos_familiares", 4);

	  //var principalValue =  $('#frm_financiera_actividad_principal').getValue()*1;	
	  //var otrosIngresosValue =  $('#frm_financiera_otros_ingresos').getValue()*1;
	  //var ingresosFamiliaresValue =  $('#frm_ingresos_familiares').getValue()*1;  
	  //var suma = principalValue + otrosIngresosValue+ingresosFamiliaresValue;
	  //$('#frm_financiera_total_ingresos').setValue(suma);
	  //ponerDecimales("frm_financiera_total_ingresos");
	}

	function calcular_patrimonio(){
	  var frm_financiera_total_activos =  $('#frm_financiera_total_activos').getValue();	
	  var frm_financiera_total_pasivos =  $('#frm_financiera_total_pasivos').getValue();
	  
	  let result_ac = parseFloat(frm_financiera_total_activos.replace(/,/g, ""));
      let result_pa = parseFloat(frm_financiera_total_pasivos.replace(/,/g, ""));
	  
	  let suma = result_ac - result_pa;
	  $('#frm_financiera_total_patrimonio').setValue(suma);
	  validarExpresionRegular("frm_financiera_total_patrimonio",4);
	}

	//Sumar el total de ingresos
	$("#frm_financiera_total_activos, #frm_financiera_total_pasivos").focusout(function (){
	  calcular_patrimonio();
	});

