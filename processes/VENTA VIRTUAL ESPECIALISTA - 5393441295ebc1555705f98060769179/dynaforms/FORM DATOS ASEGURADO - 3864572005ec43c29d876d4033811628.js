//$('#3659092825f484ded40e690037283996').hide();

$(document).on('focusin', function(e) {
  if ($(e.target).closest(".ui-dialog, .modal").length) {
    e.stopImmediatePropagation();
  }
});


$('#frm_cod_cotizacion').hide();
$('#frm_cotizacion').hide();

$('#2200289695ec4351a1bd6d3027166827').toggle();
$('#472083576608f275e8eac64071905583').toggle();
$('#4989348205ec4353801c771067884578').toggle();
$('#7823646525ec4358402e633079398860').toggle();
$('#4721577465ec463ffc95d82085591878').toggle();
$('#5032478615ec435a90a1eb9075237565').toggle();
$('#9375138705f0243767f1c28069669725').toggle();
$('#2307113435efe81c155f517021774116').toggle();
$('#3947074665ec435de402167008191064').toggle();

var tarea =$('#TASK').getValue();
if (tarea == '9938028895f0f3574ab7db1043599014'){
  $('#subtit_atencion').hide();
  $('#3659092825f484ded40e690037283996').hide();
}
else
{
  var comm = $("#tri_comentarios").getValue();
  if (comm.length >0)
  {
    //  $('#3659092825f484ded40e690037283996').show();
    $('#subtit_atencion').show();  
    // var comm = $("#tri_comentarios").getValue();
    $("#comentarios").html(comm); 
  }
  else
  {
    $("#pnl_comentarios").hide();
  }
}


if($('#frm_modificar_solicitud_label').getValue() == 'SI' || $('#tri_case_id_magnum').getValue() != ''){
  $("#frm_financiera_actividad_principal").getControl().attr('disabled', true);
  //$("#frm_tiene_otra_actividad").getControl().attr('disabled', true);
}


estadoCivil();
//direccionTrabajo();

$("#frm_conyuge_numero_identificacion").focusout(function () {
  //alert($("#frm_numero_identificacion").getValue());
  if ($("#frm_numero_identificacion").getValue() == $("#frm_conyuge_numero_identificacion").getValue()) {
    alert("La identificacion ingresada no puede ser la misma del asegurado");
    $("#frm_conyuge_numero_identificacion").setValue("");
  }else{
    	consultar_conyuge();
    }  
});

$("#3864572005ec43c29d876d4033811628").setOnSubmit(function () {

 
  calcular_edad1();
  $("#3864572005ec43c29d876d4033811628").saveForm();
  var tipo = $("#frm_tipo_identificacion").getControl().val();
  //alert (tipo);
  if (tipo == 'P'){
    var fexp =  $("#frm_fecha_expedicion_pasaporte").getValue();
    var fnac =  $("#frm_fecha_nacimiento").getValue();
    if (fexp <= fnac){

      alert ("fecha de expedicion de pasaporte debe ser mayor a la Fecha de nacimiento");
      return false;
    }

  }
  var v1 = $("#frm_financiera_actividad_principal").getValue()*1;

  //var v2 = $("#frm_financiera_otros_ingresos").getValue();
  var v3 = $("#frm_ingresos_familiares").getControl().val()*1;
  //var v4 = $("#frm_financiera_actividad_principal").getValue()*1;
  var v5 = $("#frm_financiera_total_egresos").getValue()*1;
  var v6 = $("#frm_financiera_total_activos").getValue()*1;
  var v7 = $("#frm_financiera_total_pasivos").getValue()*1;
  //var v8 = $("#frm_ingresos_ultimo_anio").getValue()*1;
  //var v9 = $("#frm_ingresos_anterior_anio").getValue()*1;

//alert (v1+'1 '+v3+'3 '+v4+'4 '+v5+'5 '+v6+'6 '+v7+'7 '+v8+'8 '+v9+'9 ');
  // v1 == '' || v3 == '' ||  v4 == '' || v5 == '' || v6 == '' || v7 == '' || v8 == '' || v9 == '' || 
  if (v1 <= 0 || v5 <= 0 || v6 <= 0 || v7 <= 0 )
  {
    alert ("Revise informacion financiera");
    return false;
  }
  var prof = $("#frm_ocupacion_tipo_empleo").getControl().val();
  if (prof == ''){
    alert ("Seleccione un tipo de empleo del listado");
    return false;
  }
  $("#3864572005ec43c29d876d4033811628").hideFormModal();
  
  return showConfirmDlg();
  $("#3864572005ec43c29d876d4033811628").hideFormModal();
  
});

$("#frm_estado_civil").change(function () {
  estadoCivil();
});

/*
$("#frm_ocupacion_tipo_empleo").change(function () {
  direccionTrabajo();

});
*/


function estadoCivil(){
  var estado = $("#frm_estado_civil").getControl().val();
  //alert (estado);

  if (estado == 5 || estado == 2) {
    $("#frm_sbt_conyuge_datos").show();
    // $('#472083576608f275e8eac64071905583').show();
    $('#frm_ingresos_familiares').show();
    $('#frm_ingresos_familiares').enableValidation();
    $("#frm_conyuge_tipo_identificacion").enableValidation(); 
    $("#frm_conyuge_numero_identificacion").enableValidation(); 
    $("#frm_conyuge_apellido_paterno").enableValidation(); 
    $("#frm_conyuge_primer_nombre").enableValidation(); 
    $("#frm_conyuge_fecha_nacimiento").enableValidation(); 
    $("#frm_conyuge_tipo_empleo").enableValidation(); 
    $("#frm_conyuge_nacionalidad").enableValidation(); 
    $("#frm_conyuge_correo").enableValidation(); 
  }
  else {
    $("#frm_sbt_conyuge_datos").hide();
    $('#frm_ingresos_familiares').setValue(0);
    $('#frm_ingresos_familiares').hide();
    $('#frm_ingresos_familiares').disableValidation();
    $("#frm_conyuge_tipo_identificacion").disableValidation(); 
    $("#frm_conyuge_numero_identificacion").disableValidation(); 
    $("#frm_conyuge_apellido_paterno").disableValidation(); 
    $("#frm_conyuge_primer_nombre").disableValidation();
    $("#frm_conyuge_fecha_nacimiento").disableValidation(); 
    $("#frm_conyuge_tipo_empleo").disableValidation(); 
    $("#frm_conyuge_nacionalidad").disableValidation(); 
    $("#frm_conyuge_correo").disableValidation();
	$("#frm_conyuge_telefono").disableValidation();
    $("#frm_conyuge_tipo_identificacion").setValue("");
    $("#frm_conyuge_numero_identificacion").setValue("");
    $("#frm_conyuge_apellido_paterno").setValue("");
    $("#frm_conyuge_primer_nombre").setValue("");
    $('#472083576608f275e8eac64071905583').hide();       
  }	
}

/*
function direccionTrabajo(){
  var estado = $("#frm_ocupacion_tipo_empleo").getControl().val();
  //alert (estado);

  if (estado == 'DEPENDIENTE' || estado == 'INDEPENDIENTE' || estado == 'DEPENDIENTE_1') {
    $("#frm_dir_trabajo").show();

    if (typeof $("#frm_dir_trabajo").find(".glyphicon-plus").html() === 'undefined') {
      $("#5032478615ec435a90a1eb9075237565").show();
      $("#9375138705f0243767f1c28069669725").show();
    }

    //$('#5032478615ec435a90a1eb9075237565').show();
    //$('#9375138705f0243767f1c28069669725').show();

    $("#frm_trabajo_provincia").enableValidation(); 
    $("#frm_trabajo_canton").enableValidation(); 
    $("#frm_trabajo_sector_barrio").enableValidation(); 
    $("#frm_trabajo_calle_principal").enableValidation(); 
    $("#frm_trabajo_calle_transversal").enableValidation();          

    $("#frm_trabajo_celular").enableValidation(); 
    $("#frm_trabajo_hora_inicial").enableValidation(); 
    $("#frm_trabajo_hora_final").enableValidation(); 
    $("#frm_trabajo_correo_trabajo").enableValidation();   

    $("#frm_trabajo_envio_correspondencia").enableValidation(); 
    $("#frm_trabajo_contacto_preferido").enableValidation(); 
    $("#frm_trabajo_correo_preferido").enableValidation(); 
    $('#pnl_contacto').show();

    // $("#frm_trabajo_envio_correspondencia").setValue('');
    // $("#frm_trabajo_contacto_preferido").setValue('');
    // $("#frm_trabajo_correo_preferido").setValue('');

  }
  else {
    $("#frm_dir_trabajo").hide();
    $('#5032478615ec435a90a1eb9075237565').hide();
    $('#9375138705f0243767f1c28069669725').hide();

    $("#frm_trabajo_provincia").disableValidation(); 
    $("#frm_trabajo_canton").disableValidation(); 
    $("#frm_trabajo_sector_barrio").disableValidation(); 
    $("#frm_trabajo_calle_principal").disableValidation();
    $("#frm_trabajo_calle_transversal").disableValidation();       
    $("#frm_trabajo_celular").disableValidation(); 
    $("#frm_trabajo_hora_inicial").disableValidation(); 
    $("#frm_trabajo_hora_final").disableValidation();
    $("#frm_trabajo_correo_trabajo").disableValidation();      

    $("#frm_trabajo_provincia").setValue('');
    $("#frm_trabajo_canton").setValue('');
    $("#frm_trabajo_sector_barrio").setValue('');
    $("#frm_trabajo_calle_principal").setValue('');
    $("#frm_trabajo_calle_transversal").setValue('');      
    $("#frm_trabajo_celular").setValue('');
    $("#frm_trabajo_hora_inicial").setValue('');
    $("#frm_trabajo_hora_final").setValue('');
    $("#frm_trabajo_correo_trabajo").setValue(''); 


    $('#pnl_contacto').hide();
    // $("#frm_trabajo_envio_correspondencia").setValue('1');
    $("#frm_trabajo_envio_correspondencia").disableValidation();   
    // $("#frm_trabajo_contacto_preferido").setValue('1');
    $("#frm_trabajo_contacto_preferido").disableValidation();     
    // $("#frm_trabajo_correo_preferido").setValue('1');
    $("#frm_trabajo_correo_preferido").disableValidation();  

  }	
}
*/


$("#btn_datos_save").find("button").on("click", function () {
  $("#3864572005ec43c29d876d4033811628").saveForm();
  alert("Formulario guardado ...");
   $("#modalProceso").modal('show');

        // Cerrar el modal cuando se haga clic en el boton Aceptar
        $("#btnCerrarModal").on('click', function() {
            $("#modalProceso").modal('hide');
        });
});	


$('#frm_hora_inicial').focusout( function() {

  var inicio=$('#frm_hora_inicial').getValue();
  var termino=$('#frm_hora_final').getValue();
  var comparar=compararHoras2(inicio,termino);
  if(comparar==false){
    $('#frm_hora_inicial').setValue('');
  }

});
$('#frm_hora_final').focusout( function() {
  var inicio=$('#frm_hora_inicial').getValue();
  var termino=$('#frm_hora_final').getValue();
  var comparar=compararHoras2(inicio,termino);
  if(comparar==false){
    $('#frm_hora_final').setValue('');
  }
});


$('#frm_trabajo_hora_inicial').focusout( function() {
  var inicio=$('#frm_trabajo_hora_inicial').getValue();
  var termino=$('#frm_trabajo_hora_final').getValue();
  var comparar=compararHoras2(inicio,termino);
  if(comparar==false){
    $('#frm_trabajo_hora_inicial').setValue('');
  }
});
$('#frm_trabajo_hora_final').focusout( function() {
  var inicio=$('#frm_trabajo_hora_inicial').getValue();
  var termino=$('#frm_trabajo_hora_final').getValue();
  var comparar=compararHoras2(inicio,termino);
  if(comparar==false){
    $('#frm_trabajo_hora_final').setValue('');
  }
});

function compararHoras2(inicio,termino){

  inicio = parseInt(inicio.replace(/-|:|\s/g , ""));
  termino = parseInt(termino.replace(/-|:|\s/g , ""));

  //compara que dato es mayor
  if(inicio > termino){
    alert("La hora de inicio no puede ser mayor a la hora de fin");
    return false;
  }else{

    return true;
  }

}

//Garantizar Control de seleccion de una opcion del catalogo de valores
// Profesion 
// Cual es la actividad economica que genera la mayor parte de sus ingresos?
// Deporte
/*
$("#frm_ocupacion_profesion, #frm_ocupacion_mayor_ingresos, #frm_deporte_practica").on("focusout", function () {

  if (isNaN($(this).getValue()) == false || $("#frm_deporte_practica").getValue() == 'NINGUNO') {
    $(this).parent().find(".textlabel").css("color", "");
    $(this).getControl().css("borderColor", "");
  } else {

    $(this).parent().find(".textlabel").css("color", "#a94442");
    $(this).getControl().css("borderColor", "#e4655f");
    $(this).setValue('');
    // alert("seleccione un valor de la lista");
    return false;
  }

});
*/

function calcular_edad1() {

  var fecha = $('#frm_fecha_nacimiento').getValue();
  //alert (fecha);
  var hoy = new Date();

  var fechaNacimiento = new Date(fecha);
  fechaNacimiento.setDate(fechaNacimiento.getDate() + 1);
  //  alert (hoy);  
  //  alert (fechaNacimiento);
  var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
  var diferenciaMeses = hoy.getMonth() - fechaNacimiento.getMonth();
  var diferenciaDias = hoy.getDay() - fechaNacimiento.getDay();

  if (
    diferenciaMeses < 0 || (diferenciaMeses === 0 && hoy.getDate() < fechaNacimiento.getDate())
  ) {
    edad--
  }
  //alert (edad);
  $("#frm_cliente_edad").setValue(edad);
}

//enriquecimiento conyuge cliente
function consultar_conyuge() {
  console.log('entra conyuge');
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
		  $("#3864572005ec43c29d876d4033811628").showFormModal();
      },
      success : function(respuesta) {
        var resultado = JSON.stringify(respuesta);
           
		if(respuesta.mensaje != 'false'){
			nombre1 = respuesta.nombre1;
			nombre2 = respuesta.nombre2; ;
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
			  $("#5104185456006ed1e5b8fc2023497272").hideFormModal();
			  
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
			alert(respuesta.mensaje_mostrar);
			$("#5104185456006ed1e5b8fc2023497272").hideFormModal();
				 $("#frm_conyuge_primer_nombre").getControl().attr('disabled', false);
			  $("#frm_conyuge_segundo_nombre").getControl().attr('disabled', false);
			  $("#frm_conyuge_apellido_paterno").getControl().attr('disabled', false);
			  $("#frm_conyuge_apellido_materno").getControl().attr('disabled', false);
			
		}
      },
      error : function(xhr, status) {
        //alert(status);
      },
      complete : function(xhr, status) {
        $("#3864572005ec43c29d876d4033811628").hideFormModal();
        //copiamos los datos de direccion del cliente
        var direccion = $("#frm_canton").getText()+', '+$("#frm_calle_principal").getValue()+', '+$("#frm_numero").getValue()+', '+$("#frm_calle_transversal").getValue();
        $("#frm_conyuge_direccion").setValue(direccion);
        var telConyuge = $("#frm_conyuge_telefono").getValue();

        if (!telConyuge || telConyuge.trim() === "") {
          $("#frm_conyuge_telefono").setValue($("#frm_celular").getValue());
        }
        //$("#frm_conyuge_correo").setValue($("#frm_correo_electronico_personal").getValue());
        //alert ("hola fin ");
      }
    });     
  }
}

//cargar datos del conyuge
function cargar_datos_direccion_conyuge(){
	var direccion = $("#frm_canton").getText()+', '+$("#frm_calle_principal").getValue()+', '+$("#frm_numero").getValue()+', '+$("#frm_calle_transversal").getValue();
        $("#frm_conyuge_direccion").setValue(direccion);
        var telConyuge = $("#frm_conyuge_telefono").getValue();

        if (!telConyuge || telConyuge.trim() === "") {
          $("#frm_conyuge_telefono").setValue($("#frm_celular").getValue());
        }
        //$("#frm_conyuge_correo").setValue($("#frm_correo_electronico_personal").getValue());
}

$('#frm_correo_electronico_personal').focusout( function() {
	cargar_datos_direccion_conyuge();
});

if($("#frm_estado_civil").getValue() == '2' || $("#frm_estado_civil").getValue() == '5'){
   cargar_datos_direccion_conyuge();
   }


