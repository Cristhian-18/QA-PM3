function tipo_asegurado(newValue, oldValue) {
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

tipo_asegurado();
$("#frm_tipo_asegurado").setOnchange(tipo_asegurado);