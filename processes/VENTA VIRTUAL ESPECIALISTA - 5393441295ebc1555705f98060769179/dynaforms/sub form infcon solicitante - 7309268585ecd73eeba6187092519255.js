$("#pnl_declaracion_asesor").css("height", "5px");
$("#pnl_declaracion_asesor").css("background-color", "#f29500");
$(function () {
  campos_a_combo();
  campos_b_combo();
  campos_c_combo();
  campos_d_combo();

  campos_f_combo();
  campos_g_combo();
  campos_no_crm();

});
///////////
//Preguntas
///////////

//Pregunta a)
$("#frm_infconf_a").change(function () {
  campos_a_combo();
});

function campos_a_combo() {
		
  if ($("#frm_infconf_a option:selected").val() == 'S') {
	  
    $("#frm_infconf_a_parentesco").show("slow");
    jQuery("#frm_infconf_a_parentesco").enableValidation();

    $("#frm_infconf_a_contacto").parent().parent().hide("slow");
    jQuery("#frm_infconf_a_contacto").disableValidation();	 
    jQuery("#frm_infconf_a_detalle").disableValidation();	     
	
    jQuery("#frm_infconf_a_contacto").setValue('');	 
    jQuery("#frm_infconf_a_detalle").setValue('');	

  }
  else if ($("#frm_infconf_a option:selected").val() == 'N') {
	  
    $("#frm_infconf_a_parentesco").hide("slow");
    jQuery("#frm_infconf_a_parentesco").disableValidation();	 
    jQuery("#frm_infconf_a_parentesco").setValue('');	 
	
    $("#frm_infconf_a_contacto").parent().parent().show("slow");
    jQuery("#frm_infconf_a_contacto").enableValidation();
	jQuery("#frm_infconf_a_detalle").enableValidation();	     

  }
  else {
	  
    $("#frm_infconf_a_parentesco").hide("slow");
    $("#frm_infconf_a_contacto").parent().parent().hide("slow");

  }  
}

//Pregunta hospitalizado
$("#frm_infconf_a_contacto").change(function () {
  campos_no_crm();
});

function campos_no_crm() {
  var canal = $("#frm_infconf_a_contacto option:selected").val();
  if (canal != 'CRM' && canal != 'BASE_DATOS' && canal != '') {
    $("#frm_infconf_a_detalle").show("slow");
    jQuery("#frm_infconf_a_detalle").enableValidation();
  }
  else {
    $("#frm_infconf_a_detalle").hide("slow");
	$("#frm_infconf_a_detalle").setValue("");    
    jQuery("#frm_infconf_a_detalle").disableValidation();
  }
}

//Pregunta b)
$("#frm_infconf_b").change(function () {
  campos_b_combo();
});

function campos_b_combo() {
  if ($("#frm_infconf_b option:selected").val() == 'N') {
    $("#frm_infconf_b_detalle").parent().parent().show("slow");
    jQuery("#frm_infconf_b_detalle").enableValidation();

  }
  else {
    $("#frm_infconf_b_detalle").parent().parent().hide("slow");
    $("#frm_infconf_b_detalle").setValue("");    
    jQuery("#frm_infconf_b_detalle").disableValidation();

  }
}

//Pregunta c)
$("#frm_infconf_c").change(function () {
  campos_c_combo();
});

function campos_c_combo() {
  if ($("#frm_infconf_c option:selected").val() == 'N') {
    $("#frm_infconf_c_detalle").parent().parent().show("slow");
    jQuery("#frm_infconf_c_detalle").enableValidation();

  }
  else {
    $("#frm_infconf_c_detalle").parent().parent().hide("slow");
    $("#frm_infconf_c_detalle").setValue("");    
    jQuery("#frm_infconf_c_detalle").disableValidation();

  }
}

//Pregunta d)
$("#frm_infconf_d").change(function () {
  campos_d_combo();
});

function campos_d_combo() {
  if ($("#frm_infconf_d option:selected").val() == 'N') {
    $("#frm_infconf_d_detalle").parent().parent().show("slow");
    jQuery("#frm_infconf_d_detalle").enableValidation();
  }
  else {
    $("#frm_infconf_d_detalle").parent().parent().hide("slow");
    $("#frm_infconf_d_detalle").setValue("");    
    jQuery("#frm_infconf_d_detalle").disableValidation();
  }
}

//Pregunta f)
$("#frm_infconf_f").change(function () {
  campos_f_combo();
});

function campos_f_combo() {
  if ($("#frm_infconf_f option:selected").val() == 'OTRO') {
    $("#frm_infconf_f_detalle").parent().parent().show("slow");
    jQuery("#frm_infconf_f_detalle").enableValidation();
  }
  else {
    $("#frm_infconf_f_detalle").parent().parent().hide("slow");
	$("#frm_infconf_f_detalle").setValue("");        
    jQuery("#frm_infconf_f_detalle").disableValidation();
  }
}
//Pregunta G)
$("#frm_infconf_g").change(function () {
  campos_g_combo();
});

function campos_g_combo() {
  if ($("#frm_infconf_g option:selected").val() == 'OTRO') {
    $("#frm_infconf_g_detalle").parent().parent().show("slow");
    jQuery("#frm_infconf_g_detalle").enableValidation();
  }
  else {
    $("#frm_infconf_g_detalle").parent().parent().hide("slow");
    $("#frm_infconf_g_detalle").setValue("");    
    jQuery("#frm_infconf_g_detalle").disableValidation();
  }
}

