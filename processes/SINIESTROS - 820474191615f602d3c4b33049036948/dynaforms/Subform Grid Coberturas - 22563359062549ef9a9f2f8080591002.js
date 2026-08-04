function escapeRegExp(string) {
	return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); // $& means the whole matched string
  }
  
  function replaceAll(str, find, replace) {
	return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
  }
  
  if($("#tri_bandera_grid").getValue() == 'true'){
	//$("#grd_coberturas").hideColumn(4);
	var nRows = $("#grd_coberturas").getNumberRows(); 
	for (var j = 1; j <= nRows; j++) {
	  $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_aplicar\\]").prop("disabled", true);
	  $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_alcance\\]").prop("disabled", true);
	  $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_conoce_vcuota\\]").prop("disabled", true);
	  $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_vcuota\\]").prop("disabled", true);
	  $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_conoce_dias\\]").prop("disabled", true);
	  $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_dias\\]").prop("disabled", true);
	  $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_conoce_monto\\]").prop("disabled", true);
	  $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_porcentaje\\]").prop("disabled", true);
	  $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_valor\\]").prop("disabled", true);
	  if($("#grd_coberturas").getValue(j, 3) == 'NO'){
			$("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_valor_aprobado\\]").prop("disabled", true);
		 }else{
		   $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_modificar\\]").prop("disabled", true);
		   if($("#tri_bandera_monto").getValue() == 'true'){
			 if($("#TASK").getValue() == '77775011261e6e6a3f16759039105464'){
				   $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_valor_aprobado\\]").prop("disabled", false);
				  $("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(12));
			 }else{
					 $("#form\\[grd_coberturas\\]\\["+j+"\\]\\[grd_txt_valor_aprobado\\]").prop("disabled", true);
				  $("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(12));
			 }
		   }else{           
			   if($("#tri_bandera_web").getValue() == 'true')
					$("#grd_coberturas").setValue($("#grd_coberturas").getValue(j, 11), j, 12);
		   }
		 }
	}
	if($("#grd_coberturas").getSummary(12) != 0)
		$("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(12));
  }else{
	if($("#grd_coberturas").getSummary(12) != 0)
	  $("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(12));
  }
  
  
  $("#tri_bandera_alcance").setValue("");
  var formId = $("form").prop("id");
	
  //Set an onchange event handler for the form. When the value of a field changes in the Dynaform, 
  //check whether the changed field is the hasDiscount field in the grid. 
  //If so, then if hasDiscount is set to "Discount", then enable the discountRate field in the same row. 
  //If set to "No Discount", then disable the discountRate field.
  $( "#" + formId ).setOnchange( function(fieldId, newVal, oldVal) {	
	//check if a field changed inside the grid:
	var aMatches = fieldId.match(/^\[grd_siniestros_alcances\]\[(\d+)\]\[grd_reanudar3\]$/);  
	var aMatches_cober = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_modificar\]$/);
	var aMatches_vsolicitado = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_valor_aprobado\]$/);
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
	  //$("#frm_check_documentos").setValue('');
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
								  $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor_aprobado\\]").prop("disabled", false);
								  $("#grd_coberturas").setValue($("#grd_coberturas").getValue(rowNo_g, 2), rowNo_g, 12);
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
			  if(num_poliza == num_polistro && num_certificado == num_certstro && cobertura == cobertura_stro){
				  alert("POR FAVOR VALIDAR HISTORIAL YA QUE COINCIDE LA INFORMACION DE LA COBERTURA");
			  }
			  if(num_poliza == num_polistro && num_certificado == num_certstro && cobertura == cobertura_stro && fec_ocu == fec_ocurr_stro){
				  //nueva validacion de suma asegurada
				  var sum_aseg = $("#grd_coberturas").getValue(rowNo_g, 2);//grd_txt_suma_aseg
				  if(monto_2 >= sum_aseg){
					  alert('EXCEDE LA SUMA ASEGURADA DE LA COBERTURA');
					  $("#grd_coberturas").setValue("NO", rowNo_g, 3);//grd_txt_APLICAR
					  $("#grd_coberturas").setValue("", rowNo_g, 4);//grd_txt_ALCANCE
					  return false;
					  
				  }else{
					  //  if(num_poliza == num_polistro && cobertura == cobertura_stro && fec_ocu == fec_ocurr_stro && monto_1 == monto_2){
					  alert("Ya existe un siniestro registrado \n debe aplicar un alcance en el grid de alcances");
					  bandera_validacion = 'true';
					  $("#96000800361d66285a6b129007859955").show();
					  $("#grd_siniestros_registrados").hide();
					  $("#grd_siniestros_enproceso").hide();
					  $("#grd_siniestros_parcial").hide();
					  
					  //$("#grd_coberturas").setValue("NO", rowNo_g, 3);
					  $("#grd_coberturas").setValue("SI", rowNo_g, 4);
					  $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_conoce_dias\\]").prop("disabled", true);
					  $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor_aprobado\\]").prop("disabled", false);
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
				  }
				}else{
				   $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor_aprobado\\]").prop("disabled", false);
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
								  $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor_aprobado\\]").prop("disabled", false);
								  $("#grd_coberturas").setValue($("#grd_coberturas").getValue(rowNo_g, 2), rowNo_g, 12);
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
								  $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor_aprobado\\]").prop("disabled", false);
								  $("#grd_coberturas").setValue($("#grd_coberturas").getValue(rowNo_g, 2), rowNo_g, 12);
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
							  $("#grd_coberturas").setValue($("#grd_coberturas").getValue(rowNo_g, 2), rowNo_g, 12);
							}
					 }
			  }
		}
	  }else{
		  $("#grd_coberturas").setValue("0", rowNo_g, 11)
		  $("#grd_coberturas").setValue("0", rowNo_g, 12)
		  $("#form\\[grd_coberturas\\]\\["+rowNo_g+"\\]\\[grd_txt_valor\\]").prop("disabled", true);
		  
	  }
	}
	//grid de coberturas monto solicitado
	if (aMatches_vsolicitado) {
	  var rowNo_gv = aMatches_vsolicitado[1];
	  $("#frm_monto_liquidar").setValue(0);
	  
	  if (newVal != "") {
		  var grd_imp_suma_aseg = $("#grd_coberturas").getValue(rowNo_gv, 2)*1	;//grd_imp_suma_aseg
		  var grd_txt_valor = $("#grd_coberturas").getValue(rowNo_gv, 12)*1;//grd_txt_valor		
		  var indice = $("#grd_coberturas").getValue(rowNo_gv, 13);//grd_txt_valor		
		  
		  /*if(indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470 || indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456 || indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507){
			  $("#form\\[grd_coberturas\\]\\["+rowNo_gv+"\\]\\[grd_txt_valor\\]").prop("disabled", true);	
			  $("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
		  }else{*/
		  if($("#TASK").getValue() != '77775011261e6e6a3f16759039105464'){
			  if(indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470 || indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456 || indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507){
				  if(grd_imp_suma_aseg == 0){
					  $("#grd_coberturas").setValue("1", rowNo_gv, 12);
					  $("#form\\[grd_coberturas\\]\\["+rowNo_gv+"\\]\\[grd_txt_valor\\]").prop("disabled", true);	
					  alert("Al ser una cobertura de servicio se registra con el valor de 1\n Una vez realizado el analisis se ajusta el valor");
				  }
			  }else{
				  if(grd_imp_suma_aseg != 0 && grd_txt_valor > grd_imp_suma_aseg){
					  alert("No se puede reportar un monto mayor del asegurado");			
					  $("#grd_coberturas").setValue("", rowNo_gv, 12);
				  }else{
					  if(grd_imp_suma_aseg == 0){
						  $("#grd_coberturas").setValue("1", rowNo_gv, 12);
						  $("#form\\[grd_coberturas\\]\\["+rowNo_gv+"\\]\\[grd_txt_valor\\]").prop("disabled", true);	
						  alert("Al ser una cobertura de servicio se registra con el valor de 1\n Una vez realizado el analisis se ajusta el valor");
					  }
				  }
			  }
		  }
			  $("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(12));
		  //}
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
  
  
  /*
  var formId = $("form").prop("id");  
  //Set an onchange event handler for the form. When the value of a field changes in the Dynaform, 
  //check whether the changed field is the hasDiscount field in the grid. 
  //If so, then if hasDiscount is set to "Discount", then enable the discountRate field in the same row. 
  //If set to "No Discount", then disable the discountRate field.
  $( "#" + formId ).setOnchange( function(fieldId, newVal, oldVal) {
	if($("#TASK").getValue() != '77775011261e6e6a3f16759039105464'){
	var aMatches_vsolicitado = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_valor_aprobado\]$/);
	//grid de coberturas monto solicitado
	  if (aMatches_vsolicitado) {
		var rowNo_gv = aMatches_vsolicitado[1];
		//$("#frm_monto_liquidar").setValue(0);
  
		if (newVal != "") {
			var grd_imp_suma_aseg = ($("#grd_coberturas").getValue(rowNo_gv, 2)	*1);//grd_imp_suma_aseg
			var grd_txt_valor = ($("#grd_coberturas").getValue(rowNo_gv, 12) * 1);//grd_txt_valor		
			var indice = $("#grd_coberturas").getValue(rowNo_gv, 13);//grd_txt_valor		
  
			if(indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470 || indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456 || indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507){
				$("#form\\[grd_coberturas\\]\\["+rowNo_gv+"\\]\\[grd_txt_valor\\]").prop("disabled", true);	
				$("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(12));
			}else{
			  //console.log(grd_imp_suma_aseg+'---'+grd_txt_valor);
				if(grd_imp_suma_aseg != 0 && grd_txt_valor > grd_imp_suma_aseg){
					alert("No se puede reportar un monto mayor del asegurado");			
					$("#grd_coberturas").setValue("", rowNo_gv, 12);
				}else{
					if(grd_imp_suma_aseg == 0){
						$("#grd_coberturas").setValue("1", rowNo_gv, 12);
						$("#form\\[grd_coberturas\\]\\["+rowNo_gv+"\\]\\[grd_txt_valor\\]").prop("disabled", true);	
					}
				}
				$("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(12));
			}
		}
	  }
	}
  });
  */