var controles="#frm_covid_uno,#frm_covid_dos,#frm_covid_tres,#frm_covid_cuatro";
$(controles).find(".textlabel").css("display", "none");

$(controles).css("width", "275px");
$(controles).css("float", "right");
$(function () {
  campos_a_combo();
  campos_b_combo();
  campos_c_combo();
  campos_d_combo();
  //campos_hospitalizado_combo();
  campos_recuperado_combo();
  campos_sintomas_combo();
  campos_hc_combo();
  campos_refuerzo_combo();

});
//campos actualizados no se muestran
$("#frm_covid_uno_tratamiento").hide();
jQuery("#frm_covid_uno_tratamiento").disableValidation();
$("#frm_covid_uno_hospitalizado_dias").hide();
$("#frm_covid_uno_hospitalizado_dias").disableValidation();
$("#frm_covid_tres_relacion").hide();
$("#frm_covid_tres_relacion").disableValidation();

///////////
//Preguntas
///////////

//Pregunta a)
$("#frm_covid_uno").change(function () {

  $("#frm_covid_dos").setValue($("#frm_covid_dos").getValue()=="N/A" ? "" : $("#frm_covid_dos").getValue());
  $("#frm_covid_tres").setValue($("#frm_covid_tres").getValue()=="N/A" ? "" : $("#frm_covid_tres").getValue());
  $("#frm_covid_cuatro").setValue($("#frm_covid_cuatro").getValue()=="N/A" ? "" : $("#frm_covid_cuatro").getValue());

  campos_a_combo();
  campos_b_combo();
  campos_c_combo();
  campos_d_combo();	  
});

function campos_a_combo() {
  if ($("#frm_covid_uno option:selected").val() == 'S') {
    $("#frm_covid_uno_fecha").parent().parent().show("slow");
    jQuery("#frm_covid_uno_fecha").enableValidation();
    $("#frm_covid_uno_hospitalizado").parent().parent().show("slow");
    jQuery("#frm_covid_uno_hospitalizado").enableValidation();
    $("#frm_covid_uno_estado").parent().parent().show("slow");
    jQuery("#frm_covid_uno_estado").enableValidation();
    $("#frm_covid_uno_persistentes").parent().parent().show("slow");
    jQuery("#frm_covid_uno_persistentes").enableValidation();
    $("#frm_covid_uno_estado").parent().parent().show("slow");
    jQuery("#frm_covid_uno_estado").enableValidation();
    $("#frm_covid_uno_fecha_aisla").parent().parent().show("slow");
    jQuery("#frm_covid_uno_fecha_aisla").enableValidation();
    $("#frm_covid_uno_recuperado").parent().parent().show("slow");
    jQuery("#frm_covid_uno_recuperado").enableValidation();
    $("#frm_covid_uno_secuelas").parent().parent().show("slow");
    jQuery("#frm_covid_uno_secuelas").enableValidation();
    

    /*$("#frm_covid_dos").disableValidation();
    $("#frm_covid_tres").disableValidation();
    $("#frm_covid_cuatro").disableValidation();

    $("#frm_covid_dos").getControl().attr('disabled', true);
    $("#frm_covid_tres").getControl().attr('disabled', true);
    $("#frm_covid_cuatro").getControl().attr('disabled', true);

    $('#frm_covid_dos option[value="N/A"]').show();		
    $('#frm_covid_tres option[value="N/A"]').show();		
    $('#frm_covid_cuatro option[value="N/A"]').show();			

    $("#frm_covid_dos").setValue("N/A");
    $("#frm_covid_tres").setValue("N/A");
    $("#frm_covid_cuatro").setValue("N/A");	*/


  }
  else {

    $("#frm_covid_uno_fecha").setValue('N/A');
    $("#frm_covid_uno_tratamiento").setValue('');
    $("#frm_covid_uno_hospitalizado").setValue('N');
    $("#frm_covid_uno_persistentes").setValue('N');
    $("#frm_covid_uno_estado").setValue('N/A');
    $("#frm_covid_uno_fecha_aisla").setValue('');
    $("#frm_covid_uno_recuperado").setValue('S');
    $("#frm_covid_uno_secuelas").setValue('N/A');
    campos_hc_combo();

    $("#frm_covid_uno_fecha").parent().parent().hide("slow");
    jQuery("#frm_covid_uno_fecha").disableValidation();
    //$("#frm_covid_uno_tratamiento").parent().parent().hide("slow");
    //jQuery("#frm_covid_uno_tratamiento").disableValidation();
    $("#frm_covid_uno_hospitalizado").parent().parent().hide("slow");
    $("#frm_covid_uno_hospitalizado").disableValidation();
    jQuery("#frm_covid_uno_estado").disableValidation();
    $("#frm_covid_uno_persistentes").parent().parent().hide("slow");
    jQuery("#frm_covid_uno_persistentes").disableValidation();
    $("#frm_covid_uno_estado").parent().parent().hide("slow");
    jQuery("#frm_covid_uno_estado").disableValidation();
    $("#frm_covid_uno_fecha_aisla").parent().parent().hide("slow");
    jQuery("#frm_covid_uno_fecha_aisla").disableValidation();
    $("#frm_covid_uno_recuperado").parent().parent().hide("slow");
    jQuery("#frm_covid_uno_recuperado").disableValidation();
    $("#frm_covid_uno_secuelas").parent().parent().hide("slow");
    jQuery("#frm_covid_uno_secuelas").disableValidation();
    

    $("#frm_covid_dos").enableValidation();
    $("#frm_covid_tres").enableValidation();
    $("#frm_covid_cuatro").enableValidation();		

    $("#frm_covid_dos").getControl().attr('disabled', false);
    $("#frm_covid_tres").getControl().attr('disabled', false);
    $("#frm_covid_cuatro").getControl().attr('disabled', false);

    $('#frm_covid_dos option[value="N/A"]').hide();		
    $('#frm_covid_tres option[value="N/A"]').hide();		
    $('#frm_covid_cuatro option[value="N/A"]').hide();		

  }
}

//Pregunta b)
$("#frm_covid_dos").change(function () {
  campos_b_combo();
});

function campos_b_combo() {
  if ($("#frm_covid_dos option:selected").val() == 'S') {
    $("#frm_covid_dos_sintomas").parent().parent().show("slow");
    jQuery("#frm_covid_dos_sintomas").enableValidation();
    $("#frm_covid_dos_sintomas_fecha").parent().parent().show("slow");
    jQuery("#frm_covid_dos_sintomas_fecha").enableValidation();
    $("#frm_covid_dos_atencion").parent().parent().show("slow");
    jQuery("#frm_covid_dos_atencion").enableValidation();
    $("#frm_covid_dos_estado_actual").parent().parent().show("slow");
    jQuery("#frm_covid_dos_estado_actual").enableValidation();
  }
  else {
    $("#frm_covid_dos_sintomas").parent().parent().hide("slow");
    jQuery("#frm_covid_dos_sintomas").disableValidation();
    $("#frm_covid_dos_sintomas_fecha").parent().parent().hide("slow");
    jQuery("#frm_covid_dos_sintomas_fecha").disableValidation();
    $("#frm_covid_dos_atencion").parent().parent().hide("slow");
    jQuery("#frm_covid_dos_atencion").disableValidation();
    $("#frm_covid_dos_estado_actual").parent().parent().hide("slow");
    jQuery("#frm_covid_dos_estado_actual").disableValidation();
    $("#frm_covid_dos_sintomas").setValue('N/A');
    $("#frm_covid_dos_sintomas_fecha").setValue('');
    $("#frm_covid_dos_atencion").setValue('N');
    $("#frm_covid_dos_estado_actual").setValue('N/A');
  }
}

//Pregunta c)
$("#frm_covid_tres").change(function () {
  campos_c_combo();
});

function campos_c_combo() {
  if ($("#frm_covid_tres option:selected").val() == 'S') {
    $("#frm_covid_tres_fecha").parent().parent().show("slow");
    jQuery("#frm_covid_tres_fecha").enableValidation();
    //$("#frm_covid_tres_relacion").parent().parent().show("slow");
    //jQuery("#frm_covid_tres_relacion").enableValidation();
  }
  else {
    $("#frm_covid_tres_fecha").parent().parent().hide("slow");
    jQuery("#frm_covid_tres_fecha").disableValidation();
    //$("#frm_covid_tres_relacion").parent().parent().hide("slow");
    //jQuery("#frm_covid_tres_relacion").disableValidation();
    $("#frm_covid_tres_fecha").setValue('');
  }
}

//Pregunta d)
$("#frm_covid_cuatro").change(function () {
  campos_d_combo();
});

function campos_d_combo() {
  if ($("#frm_covid_cuatro option:selected").val() == 'S') {
    $("#frm_covid_cuatro_detalle").parent().parent().show("slow");
    jQuery("#frm_covid_cuatro_detalle").enableValidation();
    $("#frm_covid_cuatro_vacuna").parent().parent().show("slow");
    jQuery("#frm_covid_cuatro_vacuna").enableValidation();
    $("#frm_covid_cuatro_dosis").parent().parent().show("slow");
    jQuery("#frm_covid_cuatro_dosis").enableValidation();
    $("#frm_covid_cuatro_fecha_dosis").parent().parent().show("slow");
    jQuery("#frm_covid_cuatro_fecha_dosis").enableValidation();
    $("#frm_covid_cuatro_refuerzo").parent().parent().show("slow");
    jQuery("#frm_covid_cuatro_refuerzo").enableValidation();
    $("#frm_covid_cuatro_fecha_refuerzo").parent().parent().show("slow");
    jQuery("#frm_covid_cuatro_fecha_refuerzo").enableValidation();
    $("#frm_covid_cuatro_detalle_refuerzo").parent().parent().show("slow");
    jQuery("#frm_covid_cuatro_detalle_refuerzo").enableValidation();
  }
  else {
    $("#frm_covid_cuatro_detalle").parent().parent().hide("slow");
    jQuery("#frm_covid_cuatro_detalle").disableValidation();
    $("#frm_covid_cuatro_vacuna").parent().parent().hide("slow");
    jQuery("#frm_covid_cuatro_vacuna").disableValidation();
    $("#frm_covid_cuatro_dosis").parent().parent().hide("slow");
    jQuery("#frm_covid_cuatro_dosis").disableValidation();
    $("#frm_covid_cuatro_fecha_dosis").parent().parent().hide("slow");
    jQuery("#frm_covid_cuatro_fecha_dosis").disableValidation();
    $("#frm_covid_cuatro_refuerzo").parent().parent().hide("slow");
    jQuery("#frm_covid_cuatro_refuerzo").disableValidation();
    $("#frm_covid_cuatro_fecha_refuerzo").parent().parent().hide("slow");
    jQuery("#frm_covid_cuatro_fecha_refuerzo").disableValidation();
    $("#frm_covid_cuatro_detalle_refuerzo").parent().parent().hide("slow");
    jQuery("#frm_covid_cuatro_detalle_refuerzo").disableValidation();
    $("#frm_covid_cuatro_vacuna").setValue('N/A');
    $("#frm_covid_cuatro_dosis").setValue('N/A');
    $("#frm_covid_cuatro_fecha_dosis").setValue('');
    $("#frm_covid_cuatro_detalle").setValue('N/A');
    $("#frm_covid_cuatro_refuerzo").setValue('N/A');
    $("#frm_covid_cuatro_fecha_refuerzo").setValue('');
    $("#frm_covid_cuatro_detalle_refuerzo").setValue('N/A');
  }
}
/*Pregunta hospitalizado
$("#frm_covid_uno_hospitalizado").change(function () {
  campos_hospitalizado_combo();
});
function campos_hospitalizado_combo() {
  if ($("#frm_covid_uno_hospitalizado option:selected").val() == 'S') {
    //$("#frm_covid_uno_hospitalizado_dias").show("slow");
    //jQuery("#frm_covid_uno_hospitalizado_dias").enableValidation();
  }
  else {
    $("#frm_covid_uno_hospitalizado_dias").hide("slow");
    jQuery("#frm_covid_uno_hospitalizado_dias").disableValidation();
  }
}
*/
//Pregunta recuperado
$("#frm_covid_uno_recuperado").change(function () {
  campos_recuperado_combo();
});
function campos_recuperado_combo() {
  if ($("#frm_covid_uno_recuperado option:selected").val() == 'N') {
    $("#frm_covid_uno_secuelas").show("slow");
    jQuery("#frm_covid_uno_secuelas").enableValidation();
  }
  else {
    $("#frm_covid_uno_secuelas").hide("slow");
    jQuery("#frm_covid_uno_secuelas").disableValidation();
  }
}

//Pregunta sintomas persistentes
$("#frm_covid_uno_persistentes").change(function () {
  campos_sintomas_combo();
});
function campos_sintomas_combo() {
  if ($("#frm_covid_uno_persistentes option:selected").val() == 'S') {
    $("#frm_covid_uno_estado").show("slow");
    jQuery("#frm_covid_uno_estado").enableValidation();
  }
  else {
    $("#frm_covid_uno_estado").hide("slow");
    jQuery("#frm_covid_uno_estado").disableValidation();
  }
}

//Pregunta historia clinica
$("#frm_covid_uno_hospitalizado").change(function () {
  campos_hc_combo();
});
function campos_hc_combo() {
  if ($("#frm_covid_uno_hospitalizado option:selected").val() == 'S') {
    $("#frm_doc_historia_clinica").show("slow");
  }
  else {
    $("#frm_doc_historia_clinica").hide("slow");
  }
}

//Pregunta refuerzo
$("#frm_covid_cuatro_refuerzo").change(function () {
  campos_refuerzo_combo();
});
function campos_refuerzo_combo() {
  if ($("#frm_covid_cuatro_refuerzo option:selected").val() == 'S') {
    $("#frm_covid_cuatro_fecha_refuerzo").show("slow");
    jQuery("#frm_covid_cuatro_fecha_refuerzo").enableValidation();
    $("#frm_covid_cuatro_detalle_refuerzo").show("slow");
    jQuery("#frm_covid_cuatro_detalle_refuerzo").enableValidation();
  }
  else {
    $("#frm_covid_cuatro_fecha_refuerzo").hide("slow");
    jQuery("#frm_covid_cuatro_fecha_refuerzo").disableValidation();
    $("#frm_covid_cuatro_detalle_refuerzo").hide("slow");
    jQuery("#frm_covid_cuatro_detalle_refuerzo").disableValidation();
  }
}
