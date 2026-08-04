//PROVINCIA
function checkProvincia(newVal, oldVal) {
  $.ajax({
    url  : '../beesmartec/services/siniestrosVeh/ajax_pantalla.php',
    data : {
      'funcion' : 'consultar_provincias',
      'frm_dato' : newVal,
      'frm_tipo' : 'provincia'
    },
    type : 'POST',
    beforeSend : function(){
      //$("#96986217061e95ce2ad1563044086004").showFormModal();
      $('#frm_accidente_provincia').getControl().empty();
    $('#frm_accidente_provincia').getControl().append( new Option("--- Seleccione ---", "") );
      $('#frm_accidente_ciudad').getControl().empty();
    $('#frm_accidente_ciudad').getControl().append( new Option("--- Seleccione ---", "") );
    },
    success : function(respuesta) {
      var respuestadata = JSON.parse(respuesta); 
      console.log(respuesta);
      var i=1;
      $.each(respuestadata, function(i, item) {
        $('#frm_accidente_provincia').getControl().append( new Option(item.txtDesc, item.codDpto) );
        i++;
      });
    },
    error : function(xhr, status) {
      alert(status);
    },
    complete : function(xhr, status) {
      //$("#96986217061e95ce2ad1563044086004").hideFormModal();          
    }
  });
}
//execute when the Dynaform loads:
/*if ($("#frm_accidente_pais").getValue() == '') {
  checkProvincia($("#frm_accidente_pais").getValue(), '');
} 
*/
$('#frm_accidente_pais').setOnchange(checkProvincia); //execute when field's value changes

//CANTON
function checkCanton(newVal, oldVal) {
var frm_dato = $("#frm_accidente_pais").getValue();
  $.ajax({
    url  : '../beesmartec/services/siniestrosVeh/ajax_pantalla.php',
    data : {
      'funcion' : 'consultar_cantones',
      'frm_dato' : newVal,
      'frm_tipo' : 'canton'
    },
    type : 'POST',
    beforeSend : function(){
      //$("#96986217061e95ce2ad1563044086004").showFormModal();
      $('#frm_accidente_ciudad').getControl().empty();
    $('#frm_accidente_ciudad').getControl().append( new Option("--- Seleccione ---", "") );
    },
    success : function(respuesta) {
      console.log(respuesta);
      var respuestadata = JSON.parse(respuesta); 
      var i=1;
      $.each(respuestadata, function(i, item) {
        $('#frm_accidente_ciudad').getControl().append( new Option(item.txtDesc, item.codCanton) );
        i++;
      });
    },
    error : function(xhr, status) {
      alert(status);
    },
    complete : function(xhr, status) {
      //$("#96986217061e95ce2ad1563044086004").hideFormModal();          
    }
  });
}
//execute when the Dynaform loads:
/*if ($("#frm_accidente_provincia").getValue() != '') {
  checkCanton($("#frm_accidente_provincia").getValue(), '');
} 
*/
$('#frm_accidente_provincia').setOnchange(checkCanton); //execute when field's value changes

$("#frm_siniestro_afectado").setOnchange( function(newVal, oldVal) {
  /*console.log("BANDERA CAMBIO: " + newVal);
$("#frm_taller").setValue("MUNDO MOTRIZ SA");
$("#frm_taller_email").setValue("atencion@mundomotriza.com");
$("#frm_taller_direccion").setValue("Av Eloy Alfaro y Anonas");
$("#frm_taller_ciudad").setValue("Q");
$("#frm_taller_prioridad").setValue("1");
$("#frm_taller_capacidad").setValue("20");
$("#frm_taller_vehiculosIngresados").setValue("5");
$("#frm_taller_saldo").setValue("15");
$("#frm_taller_tipo").setValue("MULTIMARCA");
$("#frm_taller_horario").setValue("RECEPCION 24 HORAS LABORABLES");
$("#frm_taller_serviciosAdicionales").setValue("ENDEREZADA Y PINTURA");*/
});


function checkVehiculosImplicados(newVal, oldVal) {
  if (newVal == 'SI') {
      $("#subt_ve_afectados").show();
      $("#24440509064a84d82d7a6e4090951046").show();
  } else {
     $("#subt_ve_afectados").hide();
      $("#24440509064a84d82d7a6e4090951046").hide();
  }
}

checkVehiculosImplicados($("#frm_siniestro_OtrosVehiculos").getValue(), ''); 
$('#frm_siniestro_OtrosVehiculos').setOnchange(checkVehiculosImplicados); 


function checkPropiedadImplicados(newVal, oldVal) {
  if (newVal == 'SI') {
      $("#iisubt_pr_afectados").show();
      $("#83626962464a84f217fbb30019736581").show();
  } else {
     $("#iisubt_pr_afectados").hide();
      $("#83626962464a84f217fbb30019736581").hide();
  }
}

checkPropiedadImplicados($("#frm_siniestro_Propiedad").getValue(), ''); 
$('#frm_siniestro_Propiedad').setOnchange(checkPropiedadImplicados); 

function checkPersonasImplicados(newVal, oldVal) {
  if (newVal == 'SI') {
      $("#isubt_pe_afectados").show();
      $("#59581944164a84e6bc66f02025995827").show();
  } else {
     $("#isubt_pe_afectados").hide();
      $("#59581944164a84e6bc66f02025995827").hide();
  }
}

checkPersonasImplicados($("#frm_siniestro_Personas").getValue(), ''); 
$('#frm_siniestro_Personas').setOnchange(checkPersonasImplicados);
