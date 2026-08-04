//<?php
$(function() 
  {
  $("#frm_requiere_buro").hide(); 
  $("#lnk_informe").hide(); 
  $("#3659092825f484ded40e690037283996").hide(); 
  $("#7232410255f4510e7ddb431040314312").hide();   
  $("#subtit_lnk").hide();   
  $("#ajx_eqfx_cliente_tipo").hide(); 

  $("#ajx_eqfx_pagador_tipo").hide(); 

  $("#pnl_cliente").hide();
  $("#pnl_pagador").hide();
  $("#pnl_error").hide();
  $("#subtit_pagador").show();
  $("#8639320456010cbab579823088697264").hide();
  // $("#frm_pago_terceros").disableValidation(); 
  //$("#frm_pago_terceros").hide();
  //  $("#mensaje_cliente").html($("#eqfx_cliente_mensaje").getValue());
  // $("#pnl_cliente").show();
  // $("#pnl_mensaje").hide();

  $("#ajx_eqfx_cliente_estado").hide();
  $("#ajx_eqfx_pagador_estado").hide();

  var dir = $("#decision_dir_eqfx").getValue();
  var ruta_aprob = $("#tri_ruta_aprobacion").getValue();

  if (ruta_aprob != '' || dir != ''){
    estadoCivil();
    pago_terceros();
    $("#8514610995fbe749293f281014281615").find(".form-control").prop("disabled", true);
    $("#3757104985ec4355abb45c4085575644").find(".form-control").prop("disabled", true);  
    $("#8639320456010cbab579823088697264").find(".form-control").prop("disabled", true);    
    $("#frm_pago_terceros").find(".form-control").prop("disabled", true);   
    $("#ajx_eqfx_cliente_mensaje").show();
    var decision = $("#decision_dir_eqfx").getValue();

    $("#mensaje_cliente").html($("#eqfx_cliente_mensaje").getValue());        
    $("#pnl_cliente").show();     	
    $("#mensaje_pagador").html($("#eqfx_pagador_mensaje").getValue());        

    if (decision == 'NEGADO')
    {
      $("#frm_pago_terceros").setValue('S');
      $("#frm_pago_terceros").getControl().attr('disabled', true); 
      pago_terceros();
      $("#pnl_cliente").show(); 
    }
$('#ifrmcony').children().removeClass('glyphicon-plus').addClass('glyphicon-minus');
  }
  else
  {
    var cedula = $("#frm_numero_identificacion").getValue();
    var frec = $("#frm_frecuencia_cotizacion_aux").getValue();
    if (cedula != '' && frec != '') {
      consultar_cliente();
      //consultar_equifax_cliente();
    }
    estadoCivil();
    pago_terceros();
    var pagador = $("#frm_pago_terceros").getControl().val();
    if (pagador == 'S') {
      $("#subtit_pagador").show();
      $("#subtit_pagador").show();    
      $("#frm_pago_terceros").show();
      $("#pnl_mensaje").show();	
      //consultar_pagador();
      //consultar_equifax_pagador();
      $("#mensaje_pagador").html($("#eqfx_pagador_mensaje").getValue());        
      $("#pnl_pagador").show();     
    }   
  }

  var lnk = $("#lnk_solicitud").getValue();  
  var comen = $("#tri_comentarios").getValue();  

  if (lnk == 'http://' || lnk == 'https://'){
    $("#7232410255f4510e7ddb431040314312").hide();  
  }
  if (comen == ''){
    $("#3659092825f484ded40e690037283996").hide(); 
    $("#subtit_hist").hide(); 
    //   $("#subtit_lnk").hide(); 
  }
});


$('#subtit_hist').on('click', function(){
  var lnk = $("#lnk_solicitud").getValue();  
  var comen = $("#tri_comentarios").getValue();  
  //  alert (comen);
  if (lnk == 'http://' || lnk == 'https://'){
    $("#7232410255f4510e7ddb431040314312").hide();  
  }
  else 
  {
    $("#subtit_lnk").toggle();
    $("#7232410255f4510e7ddb431040314312").toggle();
  }
  if (comen == ''){
    $("#3659092825f484ded40e690037283996").hide(); 
    // $("#subtit_hist").hide(); 
  }
  else
  {
    $("#3659092825f484ded40e690037283996").toggle(); 
  }
})


$("#frm_conyuge_numero_identificacion").focusout(function () {
  var iden = $("#frm_conyuge_numero_identificacion").getValue();
  if ($("#frm_numero_identificacion").getValue() == iden) {
    alert("La identificacion ingresada no puede ser la misma del asegurado");
    $("#frm_conyuge_numero_identificacion").setValue("");
  }

});

$("#frm_estado_civil").change(function () {
  // $('#3757104985ec4355abb45c4085575644').hide();
  estadoCivil();
});

function estadoCivil(){
  var estado = $("#frm_estado_civil").getControl().val();

  if (estado == 5 || estado == 2) {
    $('#3757104985ec4355abb45c4085575644').show();
    $('#ifrmcony').children().removeClass('glyphicon-minus').addClass('glyphicon-minus');
    $("#frm_sbt_conyuge_datos").show();
    $("#frm_conyuge_tipo_identificacion").enableValidation(); 
    $("#frm_conyuge_numero_identificacion").enableValidation(); 
    $("#frm_conyuge_apellido_paterno").enableValidation(); 
    $("#frm_conyuge_primer_nombre").enableValidation(); 

  }
  else {
    $('#3757104985ec4355abb45c4085575644').hide();
    $("#frm_sbt_conyuge_datos").hide();
    $("#frm_conyuge_tipo_identificacion").disableValidation(); 
    $("#frm_conyuge_numero_identificacion").disableValidation(); 
    $("#frm_conyuge_apellido_paterno").disableValidation(); 
    $("#frm_conyuge_primer_nombre").disableValidation();

    $("#frm_conyuge_tipo_identificacion").setValue("");
    $("#frm_conyuge_numero_identificacion").setValue("");
    $("#frm_conyuge_apellido_paterno").setValue("");
    $("#frm_conyuge_apellido_materno").setValue("");
    $("#frm_conyuge_primer_nombre").setValue("");
    $("#frm_conyuge_segundo_nombre").setValue("");     
  }	
}

$("#95672365763b785722563f9076272164").setOnSubmit(function(){
  $("#95672365763b785722563f9076272164").saveForm() ;
  var pagador = $("#frm_pago_terceros").getControl().val();
  var paren = $("#frm_parentesco").getControl().val();
  if (paren == '' && pagador == 'S'){ 
    alert ("Seleccione parentesco");
    return false;
  }
  var bandera = true;

  //PDF
  var array_PDF = $("#file_cotizacion").find( ".pmdynaform-field-control li" );

  if(array_PDF.length == 0){
    alert("Cotizacion PDF - requerido");
    bandera = false;
  }else if(array_PDF.length > 1){
    alert("Cotizacion PDF - Por favor adjunte solo un archivo");
    bandera = false;
  }

  const nombresArchivos = [];
  $.each(array_PDF, function( index, value ) {

    nombreArchivo_PDF = $(value).html();

    if(nombreArchivo_PDF != '' && typeof nombreArchivo_PDF !== 'undefined'){
      var pizza = nombreArchivo_PDF.toString().trim().split('.');
      var ext = pizza[pizza.length - 1];
      if(ext != "pdf" && ext != "PDF"){
        alert("Cotizacion PDF - debe ser un archivo .pdf");
        bandera = false;
      }
    }

    //verificar repetidos
    if(jQuery.inArray(nombreArchivo_PDF, nombresArchivos) !== -1){
      alert("Archivos PDF repetidos");
      bandera = false;
    }
    nombresArchivos.push(nombreArchivo_PDF);

  });

  //CSV
  var array_CSV = $("#file_cotizacion_csv").find( ".pmdynaform-field-control li" );

  if(array_CSV.length == 0){
    alert("Cotizacion XLSX - requerido");
    bandera = false;
  }else if(array_CSV.length > 1){
    alert("Cotizacion XLSX - Por favor adjunte solo un archivo");
    bandera = false;
  }

  const nombresArchivos_2 = [];
  $.each(array_CSV, function( index, value ) {

    nombreArchivo_CSV = $(value).html();

    if(nombreArchivo_CSV != '' && typeof nombreArchivo_CSV !== 'undefined'){
      var pizza = nombreArchivo_CSV.toString().trim().split('.');
      var ext = pizza[pizza.length - 1];
      if(ext != "xlsx" && ext != "XLSX" ){
        alert("Cotizacion XLSX - debe ser un archivo .xlsx");
        bandera = false;
      }
    }

    //verificar repetidos
    if(jQuery.inArray(nombreArchivo_CSV, nombresArchivos_2) !== -1){
      alert("Archivos XLSX repetidos");
      bandera = false;
    }
    nombresArchivos_2.push(nombreArchivo_CSV);

  });

  return bandera;
});

// $("#frm_numero_identificacion").change(function () {
//   consultar_equifax_cliente();
//  })

$("#frm_cedula_pagador").focusout(function () {
  consultar_pagador();
  //consultar_equifax_pagador();
})


$("#frm_pago_terceros").change(function () {
  pago_terceros();
});

function pago_terceros()
{
  var pago = $("#frm_pago_terceros").getControl().val();
  // alert(pago);
  if (pago == 'S'){
    $("#subtit_pagador").show();
    $("#frm_tipo_identificacion_pagador").enableValidation(); 
    $("#frm_cedula_pagador").enableValidation(); 
    $("#frm_nombre_pagador").enableValidation(); 
    $("#frm_apellidos_pagador").enableValidation(); 
    $("#frm_parentesco").enableValidation(); 
    $("#8639320456010cbab579823088697264").show();
    //$("#pnl_pagador").show();            
  }
  else
  {
    $("#frm_tipo_identificacion_pagador").setValue(''); 
    $("#frm_cedula_pagador").setValue(''); 
    $("#frm_nombre_pagador").setValue(''); 
    $("#frm_apellidos_pagador").setValue(''); 
    $("#frm_parentesco").setValue(''); 
    $("#ajx_eqfx_pagador_tipo").setValue(''); 


    $("#frm_tipo_identificacion_pagador").disableValidation(); 
    $("#frm_cedula_pagador").disableValidation(); 
    $("#frm_nombre_pagador").disableValidation(); 
    $("#frm_apellidos_pagador").disableValidation(); 
    $("#frm_parentesco").disableValidation(); 
    $("#ajx_eqfx_pagador_tipo").disableValidation(); 

    $("#8639320456010cbab579823088697264").hide();
  }
}

//equifax cliente
function consultar_equifax_cliente() {
  var cedula  = $("#frm_numero_identificacion").getControl().val();  
  var tipo  = $("#frm_tipo_identificacion").getControl().val();  
  var frecuencia  = $("#frm_frecuencia_cotizacion_aux").getControl().val();  
  $("#ajx_eqfx_validacion").setValue('');
   //alert (cedula);
  if (cedula != '' && frecuencia != ''){
    $.ajax({
      //    async: false,
      url  : '../beesmartec/services/poliza_especialista/ajax_especialista.php',
      data : {
        'funcion' : 'consultar_equifax',
        'cedula'  : cedula,
        'frecuencia'  : frecuencia,
        'tipo': tipo
      },
      type : 'POST',
      dataType : 'json',
      beforeSend : function(){
        // $("#95672365763b785722563f9076272164").showFormModal();
      },
      success : function(respuesta) {
        //      $("#instructivo").html(respuesta.detalle);
        // console.log(respuesta);

        var resultado = JSON.stringify(respuesta);
		if(respuesta.mensaje != 'false'){
			//console.log(resultado);
			var calificacion = respuesta.tipo;
			$("#ajx_eqfx_validacion").setValue(respuesta.tipo_validacion);
			var tarjeta = respuesta.tarjeta;
			//    alert (calificacion);
			//$("#frm_pago_terceros").setValue('');
			$("#frm_pago_terceros").getControl().attr('disabled', false); 

			$("#frm_tiene_tarjeta").setValue(tarjeta);

			if (calificacion == 'A'){
			  var mensaje = tarjeta+" Tiene tarjeta de credito";
			  var color = "green";
			  var estado = "PASA";
			}		  
			if (calificacion == 'B'){
			  var mensaje =  tarjeta+" Tiene tarjeta de credito";
			  var color = "#82FA58"; //limegreen
			  var estado = "PASA";
			}		  
			if (calificacion == 'C'){
			  var mensaje = tarjeta+" Tiene tarjeta de credito. Para debito bancario requiere requisito adicional";
			  var color = "yellow";
			  var estado = "PASA";
			}		  		  

			if (calificacion == 'D'){
			  var mensaje = tarjeta+" Tiene tarjeta de credito. Para debito bancario requiere requisito adicional";
			  var color = "#FFD24D";
			  if (tarjeta == 'NO') {var estado = "PENDIENTE";
									var mensaje = tarjeta+" Tiene tarjeta de credito. Para debito bancario requiere aprobacion y requisito adicional";
								   }
			  if (tarjeta == 'SI') var estado = "PASA";
			  //    alert (estado);

			}		  
			if (calificacion == 'E'){
			  var mensaje = tarjeta+" Tiene tarjeta de cedito: Este cliente no es pagador apto; requiere obligatoriamente pagador tercero";
			  var color = "red";
			  var estado = "NOPASA";
			  //  $("#frm_pago_terceros").setValue('S');
			  //  $("#frm_pago_terceros").getControl().attr('disabled', true); 
			  //  pago_terceros();
			}
			$("#ajx_eqfx_cliente_tipo").setValue(calificacion);
			$("#ajx_eqfx_cliente_estado").setValue(estado);  
			$("#eqfx_cliente_mensaje").setValue(mensaje);
			$("#mensaje_cliente").html(mensaje);        
			$("#pnl_cliente").show();
			$("#mensaje_cliente").css("backgroundColor", color);
			//   $("#subtit_pagador").show()   
		}else{
			alert(respuesta.mensaje_mostrar);
			$("#95672365763b785722563f9076272164").hideFormModal();	
			$("#mensaje_cliente").css("backgroundColor", "red");
			$("#mensaje_cliente").html("NO SE PUDO VALIDAR EN EQUIFAX");
			$("#pnl_cliente").show();
		}			
      },
      error : function(xhr, status) {
        //alert(status);
      },
      complete : function(xhr, status) {
        $("#95672365763b785722563f9076272164").hideFormModal();
		var pagador = $("#frm_pago_terceros").getControl().val();
		if (pagador == 'S') {
		  setTimeout(function(){
			consultar_pagador();
			}, 2000);
		  
		}
        //alert ("hola fin ");
      }
    });     
  }else{
  	alert("Datos de busqueda requeridos");
  }
}

//equifax pagador
function consultar_equifax_pagador(tipo) {

  var cedula  = $("#frm_cedula_pagador").getControl().val();  
  var tipo  = $("#frm_tipo_identificacion_pagador").getControl().val();  
  var frecuencia  = $("#frm_frecuencia_cotizacion_aux").getControl().val(); 
  if (cedula != '' && frecuencia != ''){
    $.ajax({
      //     async: false,
      url  : '../beesmartec/services/poliza_especialista/ajax_especialista.php',
      data : {
        'funcion' : 'consultar_equifax',
        'tipo': tipo,        
		'frecuencia'  : frecuencia,
        'cedula'  : cedula
      },
      type : 'POST',
      dataType : 'json',
      beforeSend : function(){
        // $("#95672365763b785722563f9076272164").showFormModal();
      },
      success : function(respuesta) {
        //      $("#instructivo").html(respuesta.detalle);
        // console.log(respuesta);

        var resultado = JSON.stringify(respuesta);
		if(respuesta.mensaje != 'false'){
			//console.log(resultado);
			$("#ajx_eqfx_validacion").setValue(respuesta.tipo_validacion);
			var calificacion = respuesta.tipo;
			var tarjeta = respuesta.tarjeta;

			$("#frm_tiene_tarjeta").setValue(tarjeta);

			//     alert (calificacion);
			if (calificacion == 'A'){
			  var mensaje = tarjeta+" Tiene tarjeta de credito";
			  var color = "green";
			  var estado = "PASA";
			}		  
			if (calificacion == 'B'){
			  var mensaje =  tarjeta+" Tiene tarjeta de credito.";
			  var color = "#82FA58"; //limegreen
			  var estado = "PASA";
			}		  
			if (calificacion == 'C'){
			  var mensaje = tarjeta+" Tiene tarjeta de credito. Para debito bancario requiere requisito adicional";
			  var color = "yellow";
			  var estado = "PASA";
			}		  		  

			if (calificacion == 'D'){
			  var mensaje = tarjeta+" Tiene tarjeta de credito. Para debito bancario requiere requisito adicional";
			  var color = "#FFD24D";
			  if (tarjeta == 'NO') {var estado = "PENDIENTE";
									var mensaje = tarjeta+" Tiene tarjeta de credito. Para debito bancario requiere aprobacion y requisito adicional";
								   }
			  if (tarjeta == 'SI') var estado = "PASA";


			}		  
			if (calificacion == 'E'){
			  var mensaje = tarjeta+" Tiene tarjeta de credito: No es pagador apto; requiere otro pagador tercero";
			  var color = "red";
			  var estado = "NOPASA";
			}
			$("#ajx_eqfx_pagador_tipo").setValue(calificacion);
			$("#ajx_eqfx_pagador_estado").setValue(estado);  
			$("#eqfx_pagador_mensaje").setValue(mensaje);
			$("#mensaje_pagador").html(mensaje);        
			$("#pnl_pagador").show();
			$("#mensaje_pagador").css("backgroundColor", color);
		}else{
			alert(respuesta.mensaje_mostrar);
			$("#95672365763b785722563f9076272164").hideFormModal();	
			$("#mensaje_pagador").css("backgroundColor", "red");
			$("#mensaje_pagador").html("NO SE PUDO VALIDAR EN EQUIFAX");
			$("#pnl_pagador").show();
		}		
      },

      error : function(xhr, status) {
        //alert(status);
      },
      complete : function(xhr, status) {
        $("#95672365763b785722563f9076272164").hideFormModal();
        //alert ("hola fin ");
      }
    });     
  }else{
  	alert("Datos de busqueda requeridos");
  }
}

function validar_rcs1(){
  //  alert ("entro");
  // validar rcs cliente
  var tipo 	= $("#frm_tipo_identificacion").getControl().val();  
  var cedula 	= $("#frm_numero_identificacion").getControl().val();
  var nombre1  = $("#frm_primer_nombre").getControl().val();
  var nombre2 = $("#frm_segundo_nombre").getControl().val();
  var apellido1 = $("#frm_apellido_paterno").getControl().val();
  var apellido2 = $("#frm_apellido_materno").getControl().val();
  var estado = consultar_rcs1(tipo,cedula, nombre1,nombre2,apellido1,apellido2);

  return true
}


function consultar_rcs1(tipo,cedula, nombre1,nombre2,apellido1,apellido2) { 
  //alert ('nodo');
  //console.log(codigo);

  alert ("ajax");
  $.ajax({
    url  : '../beesmartec/services/poliza_especialista/ajax_especialista.php',
    data : {
      'funcion' : 'consultar_rcs1',
      'tipo'  : tipo,      
      'cedula'  : cedula,
      'nombre1'  : nombre1,
      'nombre2'  : nombre2,
      'apellido1'  : apellido1,
      'apellido2'  : apellido2
    },
    type : 'POST',
    dataType : 'json',
    beforeSend : function(){
      $("#95672365763b785722563f9076272164").showFormModal();
    },
    success : function(respuesta) {
      //      $("#instructivo").html(respuesta.detalle);
      var estado = respuesta.estado;
    },
    error : function(xhr, status) {
      //alert(status);
    },
    complete : function(xhr, status) {
      $("#95672365763b785722563f9076272164").hideFormModal();
      //alert ("hola fin ");
    }
  });     

}

//enriquecimiento cliente
function consultar_cliente() {
  var cedula  = $("#frm_numero_identificacion").getControl().val();  
  //alert (cedula);
  if (cedula != ''){
    $.ajax({
      //    async: false,
      url  : '../beesmartec/services/poliza_especialista/ajax_especialista.php',
      data : {
        'funcion' : 'consultar_eriquecimiento',
        'cedula'  : cedula
      },
      type : 'POST',
      dataType : 'json',
      beforeSend : function(){
		  $("#95672365763b785722563f9076272164").showFormModal();
      },
      success : function(respuesta) {
        var resultado = JSON.stringify(respuesta);
        
		if(respuesta.mensaje != 'false'){
			nombre1 = respuesta.nombre1;
			nombre2 = (respuesta.nombre2 === null) ? '' : respuesta.nombre2;
			apellido1 = respuesta.apellido1;
			apellido2 = (respuesta.apellido2 === null) ? '' : respuesta.apellido2;
			nacimiento = respuesta.nacimiento;
			genero = respuesta.genero;
			civil = respuesta.civil;

			if (nombre1 == '')
			{
			  $("#frm_primer_nombre").getControl().attr('disabled', false);
			  $("#frm_segundo_nombre").getControl().attr('disabled', false);
			  $("#frm_apellido_paterno").getControl().attr('disabled', false);
			  $("#frm_apellido_materno").getControl().attr('disabled', false);
			  $("#95672365763b785722563f9076272164").hideFormModal();
			  if($("#frm_requiere_buro").getValue() == 'SI'){
				consultar_equifax_cliente();
				}else{
				 $("#95672365763b785722563f9076272164").hideFormModal();
			  }
			}
			else
			{
			  $("#frm_primer_nombre").setValue(nombre1);
			  $("#frm_segundo_nombre").setValue(nombre2);
			  $("#frm_apellido_paterno").setValue(apellido1);
			  $("#frm_apellido_materno").setValue(apellido2);
			  $("#frm_primer_nombre").getControl().attr('disabled', true);
			  $("#frm_segundo_nombre").getControl().attr('disabled', true);
			  $("#frm_apellido_paterno").getControl().attr('disabled', true);
			  $("#frm_apellido_materno").getControl().attr('disabled', true);

			  $("#frm_fecha_nacimiento").setValue(nacimiento);
			  $("#frm_sexo").setValue(genero);
			  $("#frm_estado_civil").setValue(civil);
			  estadoCivil();
			  if($("#frm_requiere_buro").getValue() == 'SI'){
				consultar_equifax_cliente();
			  }else{
				 $("#95672365763b785722563f9076272164").hideFormModal();
			  }
			}
        }else{
          let mensaje = respuesta.mensaje_mostrar;
          if (mensaje.includes("RegistroMaestro con primaryKeyValue")) {
              mensaje += "\n\nPor favor registre manualmente los datos de la persona.";
          }
          alert(mensaje);
          $("#frm_primer_nombre").getControl().attr('disabled', false);
          $("#frm_segundo_nombre").getControl().attr('disabled', false);
          $("#frm_apellido_paterno").getControl().attr('disabled', false);
          $("#frm_apellido_materno").getControl().attr('disabled', false);
          $("#95672365763b785722563f9076272164").hideFormModal();
			}
      },
      error : function(xhr, status) {
        //alert(status);
      },
      complete : function(xhr, status) {
        // $("#95672365763b785722563f9076272164").hideFormModal();
        //alert ("hola fin ");
      }
    });     
  }
}

//enriquecimiento conyuge cliente
function consultar_conyuge() {
  var cedula  = $("#frm_conyuge_numero_identificacion").getControl().val();  
  if (cedula != ''){
    $.ajax({
      //    async: false,
      url  : '../beesmartec/services/poliza_especialista/ajax_especialista.php',
      data : {
        'funcion' : 'consultar_eriquecimiento',
        'cedula'  : cedula
      },
      type : 'POST',
      dataType : 'json',
      beforeSend : function(){
		  $("#95672365763b785722563f9076272164").showFormModal();
      },
      success : function(respuesta) {
        var resultado = JSON.stringify(respuesta);
           
		if(respuesta.mensaje != 'false'){
			nombre1 = respuesta.nombre1;
			nombre2 = (respuesta.nombre2 === null) ? '' : respuesta.nombre2;
			apellido1 = respuesta.apellido1;
			apellido2 = (respuesta.apellido2 === null) ? '' : respuesta.apellido2;
			nacimiento = respuesta.nacimiento;
			genero = respuesta.genero;
			if (nombre1 == '')
			{
			  $("#frm_conyuge_primer_nombre").getControl().attr('disabled', false);
			  $("#frm_conyuge_segundo_nombre").getControl().attr('disabled', false);
			  $("#frm_conyuge_apellido_paterno").getControl().attr('disabled', false);
			  $("#frm_conyuge_apellido_materno").getControl().attr('disabled', false);
			  $("#95672365763b785722563f9076272164").hideFormModal();
			}
			else
			{
			  $("#frm_conyuge_primer_nombre").setValue(nombre1);
			  $("#frm_conyuge_segundo_nombre").setValue(nombre2);
			  $("#frm_conyuge_apellido_paterno").setValue(apellido1);
			  $("#frm_conyuge_apellido_materno").setValue(apellido2);
			  $("#frm_conyuge_fecha_nacimiento").setValue(nacimiento);

			  $("#frm_conyuge_primer_nombre").getControl().attr('disabled', true);
			  $("#frm_conyuge_segundo_nombre").getControl().attr('disabled', true);
			  $("#frm_conyuge_apellido_paterno").getControl().attr('disabled', true);
			  $("#frm_conyuge_apellido_materno").getControl().attr('disabled', true);          

			}
		}else{
			let mensaje = respuesta.mensaje_mostrar;
      if (mensaje.includes("RegistroMaestro con primaryKeyValue")) {
          mensaje += "\n\nPor favor registre manualmente los datos de la persona.";
      }
      alert(mensaje);
      $("#frm_conyuge_primer_nombre").getControl().attr('disabled', false);
      $("#frm_conyuge_segundo_nombre").getControl().attr('disabled', false);
      $("#frm_conyuge_apellido_paterno").getControl().attr('disabled', false);
      $("#frm_conyuge_apellido_materno").getControl().attr('disabled', false);
			$("#95672365763b785722563f9076272164").hideFormModal();
			
		}
      },
      error : function(xhr, status) {
        //alert(status);
      },
      complete : function(xhr, status) {
        $("#95672365763b785722563f9076272164").hideFormModal();
        //alert ("hola fin ");
      }
    });     
  }
}

//enriquecimiento pagador
function consultar_pagador() {
  var cedula  = $("#frm_cedula_pagador").getControl().val();  
  if (cedula != ''){
    $.ajax({
      //    async: false,
      url  : '../beesmartec/services/poliza_especialista/ajax_especialista.php',
      data : {
        'funcion' : 'consultar_eriquecimiento',
        'cedula'  : cedula
      },
      type : 'POST',
      dataType : 'json',
      beforeSend : function(){
		  $("#95672365763b785722563f9076272164").showFormModal();
      },
      success : function(respuesta) {
        var resultado = JSON.stringify(respuesta);
        //   console.log(resultado);        
		if(respuesta.mensaje != 'false'){
			var nombre1 = respuesta.nombre1;
			var nombre2 = (respuesta.nombre2 === null) ? '' : respuesta.nombre2;
			var apellido1 = respuesta.apellido1;
			var apellido2 = (respuesta.apellido2 === null) ? '' : respuesta.apellido2;

			if (nombre1 == '')
			{
			  $("#frm_nombre_pagador").getControl().attr('disabled', false);
			  $("#frm_apellidos_pagador").getControl().attr('disabled', false);
			  $("#95672365763b785722563f9076272164").hideFormModal();
			  if($("#frm_requiere_buro").getValue() == 'SI'){
				consultar_equifax_pagador();
			  }else{
				 $("#95672365763b785722563f9076272164").hideFormModal();
			  }
			}
			else
			{

			  $("#frm_nombre_pagador").setValue(nombre1+' '+nombre2);
			  $("#frm_apellidos_pagador").setValue(apellido1+' '+apellido2);

			  $("#frm_nombre_pagador").getControl().attr('disabled', true);
			  $("#frm_apellidos_pagador").getControl().attr('disabled', true);
			  if($("#frm_requiere_buro").getValue() == 'SI'){
				consultar_equifax_pagador();
			  }else{
				 $("#95672365763b785722563f9076272164").hideFormModal();
			  }
			}
		}else{
			alert(respuesta.mensaje_mostrar);
			$("#95672365763b785722563f9076272164").hideFormModal();
		}
      },
      error : function(xhr, status) {
        //alert(status);
      },
      complete : function(xhr, status) {
        //$("#95672365763b785722563f9076272164").hideFormModal();
        //alert ("hola fin ");
      }
    });     
  }
}