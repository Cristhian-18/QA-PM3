conduce_moto();
ocupacion_habitual();

$("#frm_tipo_uso_moto").change(function () {
    if ($("#frm_tipo_uso_moto option:selected").val() == 'COMPETENCIA') {
    	alert("Recuerde llenar el cuestionario de competencias de Moto ");
    }
});

$("#frm_piloto").change(function () {
    if ($("#frm_piloto option:selected").val() == 'S') {
    	alert("Recuerde llenar el cuestionario de aviacion ");
    }
});
$("#frm_relacion_ocupacion_habitual").change(function () {
    ocupacion_habitual();
});

$("#frm_tipo_practica_deporte").change(function () {
    deportes();
});

function ocupacion_habitual() {
    if ($("#frm_relacion_ocupacion_habitual option:selected").val() == 'VIAJES') {
        $("#frm_frecuencia_viajes").parent().parent().show("slow");
        jQuery("#frm_frecuencia_viajes").enableValidation();
		 $("#frm_otra_actividad_relacion_habitual").parent().parent().hide("slow");
      $("#frm_otra_actividad_relacion_habitual").setValue('');
        jQuery("#frm_otra_actividad_relacion_habitual").disableValidation();
    }
    else {
		if($("#frm_relacion_ocupacion_habitual option:selected").val() == 'OTROS'){
			$("#frm_frecuencia_viajes").parent().parent().hide("slow");
          $("#frm_frecuencia_viajes").setValue('');
			jQuery("#frm_frecuencia_viajes").disableValidation();
			 $("#frm_otra_actividad_relacion_habitual").parent().parent().show("slow");
			jQuery("#frm_otra_actividad_relacion_habitual").enableValidation();
		}
		else{
			$("#frm_frecuencia_viajes").parent().parent().hide("slow");
          $("#frm_frecuencia_viajes").setValue('');
			jQuery("#frm_frecuencia_viajes").disableValidation();
			 $("#frm_otra_actividad_relacion_habitual").parent().parent().hide("slow");
			jQuery("#frm_otra_actividad_relacion_habitual").disableValidation();
           $("#frm_otra_actividad_relacion_habitual").setValue('');
		}
	}
}
$("#frm_conduce_moto").change(function () {
    conduce_moto();
});

function conduce_moto() {
  if ($("#frm_conduce_moto option:selected").val() == 'S') {
        $("#frm_cilindraje_moto").parent().parent().show("slow");
        jQuery("#frm_cilindraje_moto").enableValidation();
		 $("#frm_tipo_uso_moto").parent().parent().show("slow");
        jQuery("#frm_tipo_uso_moto").enableValidation();
        $("#frm_tiene_accidentes").parent().parent().show("slow");
        jQuery("#frm_tiene_accidentes").enableValidation();
    }
    else {
       $("#frm_cilindraje_moto").parent().parent().hide("slow");
        jQuery("#frm_cilindraje_moto").disableValidation();
       jQuery("#frm_cilindraje_moto").setValue('');
		 $("#frm_tipo_uso_moto").parent().parent().hide("slow");
        jQuery("#frm_tipo_uso_moto").disableValidation();
      $("#frm_tipo_uso_moto").setValue('');
        $("#frm_tiene_accidentes").parent().parent().hide("slow");
        jQuery("#frm_tiene_accidentes").disableValidation();
       $("#frm_tiene_accidentes").setValue('');
    }
  accidentes();
}

$("#frm_tiene_accidentes").change(function () {
    accidentes();
});

function accidentes() {
  if ($("#frm_tiene_accidentes option:selected").val() == 'S') {
        $("#frm_fecha_accidentes").parent().parent().show("slow");
        jQuery("#frm_fecha_accidentes").enableValidation();
		 $("#frm_gravedad_accidente").parent().parent().show("slow");
        jQuery("#frm_gravedad_accidente").enableValidation();
    }
    else {
       $("#frm_fecha_accidentes").parent().parent().hide("slow");
        jQuery("#frm_fecha_accidentes").disableValidation();
       $("#frm_fecha_accidentes").setValue('');
		 $("#frm_gravedad_accidente").parent().parent().hide("slow");
        jQuery("#frm_gravedad_accidente").disableValidation();
      $("#frm_gravedad_accidente").setValue('');
    }
}
function deportes() {
    if ($("#frm_tipo_practica_deporte option:selected").val() == 'NINGUNO') {
        $("#frm_deporte_practica").setValue('NINGUNO');
        $("#frm_deporte_practica").parent().find(".textlabel").css("color", "");
        $("#frm_deporte_practica").getControl().css("borderColor", "");

        $("#frm_deporte_practica").getControl().attr('disabled', true);
    } else {
        $("#frm_deporte_practica").getControl().attr('disabled', false);
		
		if($("#frm_deporte_practica").getValue() == 'NINGUNO' || $("#frm_deporte_practica").getValue() == 0){
			$("#frm_deporte_practica").setValue("");
		}
		
    }

	// var trabajo_deporte = $('#frm_deporte_practica').getValue();
	// alert(trabajo_deporte);	
	
}

$( document ).ready(function() {
    deporteFuncionalidad(true);
});

$("#frm_deporte_practica").on("focusout", function () {
    deporteFuncionalidad(false);
});


function deporteFuncionalidad(load) {

	var trabajo_deporte = $('#frm_deporte_practica').getValue();

    $("#frm_tipo_practica_deporte").getControl().attr('disabled', false);
// alert(trabajo_deporte);
    if (trabajo_deporte != "") {
		if (trabajo_deporte == 0) {
			// alert(1111);
			$("#frm_tipo_practica_deporte").setValue('NINGUNO');
			$("#frm_tipo_practica_deporte").getControl().attr('disabled', true);
		}
    } else {
		if(load == false && $("#frm_tipo_practica_deporte option:selected").val() == 'NINGUNO'){
			$("#frm_tipo_practica_deporte").setValue("");
		}
    }

}