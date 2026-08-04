function escapeRegExp(string) {
  return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); // $& means the whole matched string
}

function replaceAll(str, find, replace) {
  return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

$("#frm_monto_reportado").focusout(function () {
  
    var txt_cober =  $("#frm_coberturas").getValue();
    var arr_cober = txt_cober.split("|");
    var sum_aseg = arr_cober[1];
  
if($("#tri_bandera_montos").getValue() == 'true'){
	$("#frm_monto_reportado").getControl().prop('disabled', true);
}else{
  	$("#frm_monto_reportado").getControl().prop('disabled', false);
  if(sum_aseg != 0){
     if (($("#frm_monto_reportado").getValue()*1) > (sum_aseg*1)) {
        alert("No puede reportar un monto mayor al asegurado");
      	$("#frm_monto_reportado").setValue('0.00');
    }
  }
}
});



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
      	$("#frm_monto_reportado").getControl().prop('disabled', false);
    }else{
      	//gastos
    	if(indice == 5 || indice == 14 || indice == 21 || indice == 31 || indice == 50 || indice == 51 || indice == 61 || indice == 147 || indice == 148 || indice == 269 || indice == 442 || indice == 470)
        {
            $('#frm_conoce_monto').show();
        }else{
          //renta
        	if(indice == 6 || indice == 19 || indice == 39 || indice == 18 || indice == 48 || indice == 52 || indice == 53 || indice == 293 || indice == 311 || indice == 456){
               	$('#frm_conoce_dias').show();
              	var txt_cober = $("#frm_coberturas").getValue();
    			var arr_cober = txt_cober.split("|");
    			var sum_aseg = arr_cober[1];
              	$("#frm_aplica_dias").setValue(3);
              	var dias = $("#frm_aplica_dias").getValue();
              	var tot_dias = (sum_aseg*1) * dias;
              	if(tot_dias == 0)
       				tot_dias = 1
    			$("#frm_monto_reportado").setValue(tot_dias);              	
               }else{
                 	//desempleo
              		if(indice == 4 || indice == 15 || indice == 149 || indice == 268 || indice == 339 || indice == 507)
                      {
                          $('#frm_conoce_cuotas').show();
                        	//$("#frm_conoce_cuotas").getControl().prop('disabled', true);
                        	var txt_cober = $("#frm_coberturas").getValue();
    						var arr_cober = txt_cober.split("|");
                        	var sum_aseg = arr_cober[1];
                        	var tot_dias = (sum_aseg*1) * 2;
    						$("#frm_monto_reportado").setValue(tot_dias); 
                        	$("#frm_monto_reportado").getControl().prop('disabled', true);
                      }else{                   
               			datos_validaciones(0);
                      }
               }
        }
    }
  
}

//datos_validaciones(0);
  $('#frm_conoce_monto').hide();
  $('#frm_porcentaje_aplica').hide();
  $('#frm_conoce_dias').hide();
  $('#frm_aplica_dias').hide();
  $('#frm_conoce_cuotas').hide();
  $('#frm_aplica_cuotas').hide();
  $('#frm_valor_cuota').hide();

function cargar_validaciones_poliza(newValue, oldValue){
  $("#frm_monto_reportado").show();
  $("#frm_dias_respuesta").show(); 
  $("#frm_sbt_datAsegurado").show();
  $("#13722500361d66707a60381015639101").show();
  $("#frm_sbt_docs").show();
  $("#40350410561d9cbe0f0c3b3037075503").show();
  $("#frm_accion").show();
  $("#frm_comentario").show();
  $("#btn_enviar").show();
  
  var bandera_validacion = '';
  //validacion para no duplicar resrvaer combo coberturas
  	var txt_cober = newValue;
    var arr_cober = txt_cober.split("|");
    var sum_aseg = arr_cober[1];
    var cobertura = arr_cober[0];
  //alert(cobertura);
  //validacion para no duplicar resrvaer combo polizas
  var txt_poli = $("#frm_polizas").getValue();
  var arr_poli = txt_poli.split("|");
  var num_poliza = arr_poli[7];
  //alert(num_poliza);
  
  var txt_fec_ocu = $("#frm_fecha_ocurrencia").getValue();
  var fec_ocu = replaceAll(txt_fec_ocu, '-', '/');
  new Date(fec_ocu);
   //console.log(fec_ocu+'--');
  if ($("#grd_siniestros_alcances").getValue(1, 1) !== '') {
  var aStros = $("#grd_siniestros_alcances").getValue();
    for (var i=0; i < aStros.length; i++) {
      	var num_stro = aStros[i][0];//numero de siniestros
      	var num_polistro = aStros[i][1];//poliza
      	var estado = aStros[i][6];//estado
      	var cobertura_stro = aStros[i][26];//cod_riesgo
        var montos_stro = aStros[i][4];//montos
      	var arr_fec_ocurr_stro = aStros[i][5].split(" ");//fecha de siniestros
        var fech_sola = arr_fec_ocurr_stro[0];
      	var arr_feech_sola = fech_sola.split("/");
      	var fec_day = (arr_feech_sola[0].length == 1 ? 0+arr_feech_sola[0] : arr_feech_sola[0]);
      	var fec_mont = (arr_feech_sola[1].length == 1 ? 0+arr_feech_sola[1] : arr_feech_sola[1]);
        var fec_year = arr_feech_sola[2];
      	var fec_ocurr_stro = fec_year+'/'+fec_mont+'/'+fec_day;
      	new Date(fec_ocurr_stro);
      //console.log(fec_ocurr_stro);
      //para los pagos parciales
      if(estado == 1){
      	if(num_poliza == num_polistro && cobertura == cobertura_stro && fec_ocu == fec_ocurr_stro){
        	alert("Ya existe un siniestro en proceso de pago");
          	bandera_validacion = 'true';
          //ocultar todo
                  $("#frm_sbt_datAsegurado").hide();
                  $("#13722500361d66707a60381015639101").hide();
                  $("#frm_sbt_docs").hide();
                  $("#40350410561d9cbe0f0c3b3037075503").hide();
                  $("#frm_accion").hide();
                  $("#frm_comentario").hide();
                  $("#btn_enviar").hide();
          	//existe en el manager
          	var aManager = $("#grd_siniestros_parcial").getValue();
            for (var j=0; j < aManager.length; j++) {
                var num_stro_par = aManager[j][0];//num siniestro
              	var num_caso_par = aManager[j][1];//num siniestro
              	if(num_stro == num_stro_par){
                	alert("En el manager ya existe un Siniestro en la tarea 5.2 Revisar la bandeja de Sin asignar \n Num Caso: "+num_caso_par);
                  	//ocultar todo
                  $("#frm_sbt_datAsegurado").hide();
                  $("#13722500361d66707a60381015639101").hide();
                  $("#frm_sbt_docs").hide();
                  $("#40350410561d9cbe0f0c3b3037075503").hide();
                  $("#frm_accion").hide();
                  $("#frm_comentario").hide();
                  $("#btn_enviar").hide();
                }
            }
        }
      }else{
        //para los alcances
      	if(estado == 3){
        	//desbloquear el grid de alcances validar montos	
          if(num_poliza == num_polistro && cobertura == cobertura_stro && fec_ocu == fec_ocurr_stro){
        	alert("Ya existe un siniestro registrado \n debe aplicar un alcance");
            bandera_validacion = 'true';
            	  $("#frm_monto_reportado").hide();
            	  $("#frm_dias_respuesta").hide();
             	  $("#frm_sbt_datAsegurado").hide();
                  $("#13722500361d66707a60381015639101").hide();
                  $("#frm_sbt_docs").hide();
                  $("#40350410561d9cbe0f0c3b3037075503").hide();
            	  var aux1 = i+1;
             	  $("#form\\[grd_siniestros_alcances\\]\\["+aux1+"\\]\\[grd_reanudar3\\]").prop("disabled", false);
                  $("#frm_accion").hide();
                  $("#frm_comentario").hide();
            	  $("#btn_enviar").hide();
          }
        }
      }
    }
  }
  
  if(bandera_validacion == ''){
      $("#frm_monto_reportado").setValue('0.00');
      $("#tri_bandera_montos").setValue('');

      var txt_cober = newValue;
      var arr_cober = txt_cober.split("|");
      var sum_aseg = arr_cober[1];

      if(sum_aseg == 0){
        $("#tri_bandera_montos").setValue('true');
        $("#frm_monto_reportado").setValue(1);
        $("#frm_monto_reportado").getControl().prop('disabled', true);
      }

      if(newValue != ''){
        var newArry = newValue.split("|");
        var ind_riesgo = newArry[0];        
            datos_validaciones(ind_riesgo);	
     }else{
        datos_validaciones(0);
     }
   }
}

$("#frm_coberturas").setOnchange(cargar_validaciones_poliza);


function porc_monto(newValue, oldValue){
 	   
  datos_validaciones(0);
  if(newValue == 'NO'){
    //aqui la regla de porcentajes
    var txt_cober = $("#frm_coberturas").getValue();
	var arr_cober = txt_cober.split("|");
	var sum_aseg = arr_cober[1];
    
    if(sum_aseg > 0 && sum_aseg < 251){
    	//50%
      	var tot_res = (sum_aseg*1) / 2;
      $("#frm_porcentaje_aplica").setValue(50);
    }
    if(sum_aseg > 250 && sum_aseg < 501){
    	//46%
      	var tot_res = (sum_aseg*46) / 100;
      $("#frm_porcentaje_aplica").setValue(46);
    }if(sum_aseg > 500 && sum_aseg < 1001){
    	//23%
      	var tot_res = (sum_aseg*23) / 100;
      $("#frm_porcentaje_aplica").setValue(23);
    }if(sum_aseg > 1000 && sum_aseg < 2001){
    	//19%
      	var tot_res = (sum_aseg*19) / 100;
      $("#frm_porcentaje_aplica").setValue(19);
    }if(sum_aseg > 2000 && sum_aseg < 3001){
    	//17%
      	var tot_res = (sum_aseg*17) / 100;
      $("#frm_porcentaje_aplica").setValue(17);
    }if(sum_aseg > 3000 && sum_aseg < 5001){
    	//13%
      	var tot_res = (sum_aseg*13) / 100;
      $("#frm_porcentaje_aplica").setValue(13);
    }if(sum_aseg > 5000){
    	//9%
      	var tot_res = (sum_aseg*9) / 100;
      $("#frm_porcentaje_aplica").setValue(9);
    }
      
     $('#frm_conoce_monto').show();
    $('#frm_porcentaje_aplica').show();
    $("#frm_monto_reportado").setValue(tot_res);
 }else{
   $("#tri_bandera_montos").setValue('');
    $("#frm_porcentaje_aplica").setValue(0);
   	$("#frm_monto_reportado").setValue(0);
 	
 }
  
}


$("#frm_conoce_monto").setOnchange(porc_monto);


function porc_dias(newValue, oldValue){
 	   
  	$("#tri_bandera_montos").setValue('true');
  	var txt_cober = $("#frm_coberturas").getValue();
	var arr_cober = txt_cober.split("|");
	var sum_aseg = arr_cober[1];
  	datos_validaciones(6);
  
  if(newValue == 'NO'){
    $("#frm_aplica_dias").setValue(3);
   var dias = $('#frm_aplica_dias').getValue();
    var tot_dias = (sum_aseg*1) * dias;
    if(tot_dias == 0)
       tot_dias = 1
   	$("#frm_monto_reportado").setValue(tot_dias);
          
 }else{
   //aqui la regla de porcentajes
   $('#frm_aplica_dias').show();     
    var tot_dias = (sum_aseg*1) * 3;
   	if(tot_dias == 0)
       tot_dias = 1
    $("#frm_monto_reportado").setValue(tot_dias);
 	
 }
  
}


$("#frm_conoce_dias").setOnchange(porc_dias);


function porc_validadias(newValue, oldValue){
  
    var txt_cober = $("#frm_coberturas").getValue();
	var arr_cober = txt_cober.split("|");
	var sum_aseg = arr_cober[1];
    var dias = $('#frm_aplica_dias').getValue();
    
    var tot_dias = (sum_aseg*1) * dias;
  if(tot_dias == 0)
       tot_dias = 1
    $("#frm_monto_reportado").setValue(tot_dias);
  
  $("#frm_monto_reportado").getControl().prop('disabled', true);
  
}


$("#frm_aplica_dias").setOnchange(porc_validadias);

function porc_cuotas(newValue, oldValue){
 	   
  	//$("#tri_bandera_montos").setValue('true');
  	var txt_cober = $("#frm_coberturas").getValue();
	var arr_cober = txt_cober.split("|");
	var sum_aseg = arr_cober[1];
  	$("#frm_valor_cuota").setValue(sum_aseg);
  	//datos_validaciones(4);
  
  if(newValue == 'NO'){
   $("#frm_valor_cuota").hide();
    $("#frm_aplica_cuotas").setValue(1);
   var dias = $('#frm_aplica_cuotas').getValue();
    var tot_dias = (sum_aseg*1) * 2;
   	$("#frm_monto_reportado").setValue(tot_dias);
          
 }else{
   //aqui la regla de porcentajes
   $("#frm_valor_cuota").show();
   $("#tri_bandera_montos").setValue('true');
   $('#frm_aplica_cuotas').show();     
   $('#frm_valor_cuotas').show(); 
    var tot_dias = (sum_aseg*1) * 2;
    $("#frm_monto_reportado").setValue(tot_dias);
   $("#frm_monto_reportado").getControl().prop('disabled', true);
 	
 }
  
}


$("#frm_conoce_cuotas").setOnchange(porc_cuotas);

function porc_validacuotas(newValue, oldValue){
  
    var txt_cober = $("#frm_coberturas").getValue();
	var arr_cober = txt_cober.split("|");
	var sum_aseg = arr_cober[1];
    var dias = $('#frm_aplica_cuotas').getValue();
    
    var tot_dias = (sum_aseg*1) * dias;
    $("#frm_monto_reportado").setValue(tot_dias);
  
  $("#frm_monto_reportado").getControl().prop('disabled', true);
  
}


$("#frm_aplica_cuotas").setOnchange(porc_validacuotas);

function Monto_cuota(){
    var sum_aseg = $("#frm_valor_cuota").getValue();
  	var tot_dias = (sum_aseg*1) * 2;
  	$("#frm_monto_reportado").setValue(tot_dias);
}

$("#frm_valor_cuota").focusout(Monto_cuota);
