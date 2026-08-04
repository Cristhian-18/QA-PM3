//created by Henry

$("#frm_sbt_medico").hide();
$("#71422138261da327fe6a4d5053466166").hide();
//$("#361044504624e0b4c74a4c2046528217").hide();
$("#frm_fecha_diagnostico").disableValidation();
$("#frm_diagnostico_medico").disableValidation();
$("#frm_antecedentes_medico").disableValidation();
$("#frm_motivo_medica").disableValidation();
$("#frm_resumen_medico").disableValidation();

if ($("#tri_bandera_analista").getValue() == 'true') {
  $("#frm_sbt_medico").show()
  $("#71422138261da327fe6a4d5053466166").show()
}

function accion(newValue, oldValue) {

  $("#frm_razon_negativa").disableValidation();
  $("#fle_negativa").disableValidation();
  $("#frm_razon_negativa").hide();
  $("#fle_negativa").hide();
  $("#frm_auditores_medicos").hide();

  //18-12-2024
  $("#frm_negativa_asunto").hide();
  $("#frm_negativa_asunto").disableValidation();
  $("#frm_negativa_asunto_2").hide();
  $("#frm_negativa_asunto_3").hide();
  $("#frm_negativa_dirigido_1").hide();
  $("#frm_negativa_dirigido_2").hide();
  $("#frm_negativa_dirigido_3").hide();
  $("#frm_negativa_email_1").hide();
  $("#frm_negativa_email_2").hide();
  $("#frm_negativa_email_3").hide();
  //

  if (newValue == 'MEDICO') {
    $("#frm_auditores_medicos").show();
    $("#71422138261da327fe6a4d5053466166").show();
    //$("#frm_comentario").show();
  }

  if (newValue == 'NEGAR') {
    $("#frm_razon_negativa").show();
    $("#fle_negativa").show();
    //$("#361044504624e0b4c74a4c2046528217").show();
    $("#frm_razon_negativa").enableValidation();
    $("#fle_negativa").enableValidation();
    $("#frm_negativa_asunto").show();
    $("#frm_negativa_asunto_2").show();
    $("#frm_negativa_asunto_3").show();
    $("#frm_negativa_dirigido_1").show();
    $("#frm_negativa_dirigido_2").show();
    $("#frm_negativa_dirigido_3").show();

  }

}
accion();
$("#frm_accion").setOnchange(accion);

//18-12-2024
$("#frm_negativa_asunto").setOnchange(function (newV, oldV) {
  var datoSelect = $("#frm_negativa_asunto").getText();
  if (datoSelect == "CONTRATANTE") {
    $("#frm_negativa_email_1").setValue('');
    $("#frm_negativa_email_1").setLabel("Email Contratante");
    //$("#frm_negativa_email_1").removeAttr("disabled");
    $("#frm_negativa_email_1").show();
  } else if (datoSelect == "ADICIONAL") {
    var emailOtro = $("#frm_asegurado_mailAdicional").getValue();
    $("#frm_negativa_email_1").setLabel("Email Adicional");
    $("#frm_negativa_email_1").setValue(emailOtro);
    //$("#frm_negativa_email_1").removeAttr("disabled");
    $("#frm_negativa_email_1").hide();
  } else if (datoSelect == "BROKER") {
    var emailBroker = $("#frm_asegurado_mail").getValue();
    $("#frm_negativa_email_1").setLabel("Email Broker");
    $("#frm_negativa_email_1").setValue(emailBroker);
    $("#frm_negativa_email_1").hide();
    //$("#frm_negativa_email_1").prop("disabled", true);
  } else if (datoSelect == "ASEGURADO") {
    var emailAsegurado = $("#frm_asegurado_mail_1").getValue();
    $("#frm_negativa_email_1").setLabel("Email Asegurado");
    $("#frm_negativa_email_1").setValue(emailAsegurado);
    //$("#frm_negativa_email_1").attr("disabled", "");
    $("#frm_negativa_email_1").hide();
  } else {
    $("#frm_negativa_email_1").setValue('');
    $("#frm_negativa_dirigido_1").setValue('');
    $("#frm_negativa_email_1").setLabel("Email");
    $("#frm_negativa_email_1").hide();
    //$("#frm_negativa_email_1").removeAttr("disabled");
  }
  //dirigido(newV,oldV,"#frm_negativa_dirigido_1");
  //dirigido(newV,oldV,"#frm_negativa_dirigido_2")
  //dirigido(newV,oldV,"#frm_negativa_dirigido_3");
});

$("#frm_negativa_asunto_2").setOnchange(function (newV, oldV) {
  var datoSelect2 = $("#frm_negativa_asunto_2").getText();
  if (datoSelect2 == "CONTRATANTE") {
    $("#frm_negativa_email_2").setValue('');
    $("#frm_negativa_email_2").setLabel("Email Contratante");
    $("#frm_negativa_email_2").show();
  } else if (datoSelect2 == "ADICIONAL") {
    var emailOtro = $("#frm_asegurado_mailAdicional").getValue();
    $("#frm_negativa_email_2").setLabel("Email Adicional");
    $("#frm_negativa_email_2").setValue(emailOtro);
    $("#frm_negativa_email_2").hide();
  } else if (datoSelect2 == "BROKER") {
    var emailBroker = $("#frm_asegurado_mail").getValue();
    $("#frm_negativa_email_2").setLabel("Email Broker");
    $("#frm_negativa_email_2").setValue(emailBroker);
    $("#frm_negativa_email_2").hide();
  } else if (datoSelect2 == "ASEGURADO") {
    var emailAsegurado = $("#frm_asegurado_mail_1").getValue();
    $("#frm_negativa_email_2").setLabel("Email Asegurado");
    $("#frm_negativa_email_2").setValue(emailAsegurado);
    $("#frm_negativa_email_2").hide();
  } else {
    $("#frm_negativa_email_2").setValue('');
    $("#frm_negativa_dirigido_2").setValue('');
    $("#frm_negativa_email_2").setLabel("Email");
    $("#frm_negativa_email_2").hide();
  }
  //dirigido(newV,oldV,"#frm_negativa_dirigido_1");
  //dirigido(newV,oldV,"#frm_negativa_dirigido_2")
  //dirigido(newV,oldV,"#frm_negativa_dirigido_3");
});

$("#frm_negativa_asunto_3").setOnchange(function (newV, oldV) {
  var datoSelect3 = $("#frm_negativa_asunto_3").getText();
  if (datoSelect3 == "CONTRATANTE") {
    $("#frm_negativa_email_3").setValue('');
    $("#frm_negativa_email_3").setLabel("Email Contratante");
    $("#frm_negativa_email_3").show();
  } else if (datoSelect3 == "ADICIONAL") {
    var emailOtro = $("#frm_asegurado_mailAdicional").getValue();
    $("#frm_negativa_email_3").setLabel("Email Adicional");
    $("#frm_negativa_email_3").setValue(emailOtro);
    $("#frm_negativa_email_3").hide();
  } else if (datoSelect3 == "BROKER") {
    var emailBroker = $("#frm_asegurado_mail").getValue();
    $("#frm_negativa_email_3").setLabel("Email Broker");
    $("#frm_negativa_email_3").setValue(emailBroker);
    $("#frm_negativa_email_3").hide();
  } else if (datoSelect3 == "ASEGURADO") {
    var emailAsegurado = $("#frm_asegurado_mail_1").getValue();
    $("#frm_negativa_email_3").setLabel("Email Asegurado");
    $("#frm_negativa_email_3").setValue(emailAsegurado);
    $("#frm_negativa_email_3").hide();
  } else {
    $("#frm_negativa_email_3").setValue('');
    $("#frm_negativa_dirigido_3").setValue('');
    $("#frm_negativa_email_3").setLabel("Email");
    $("#frm_negativa_email_3").hide();
  }
  //dirigido(newV,oldV,"#frm_negativa_dirigido_1");
  //dirigido(newV,oldV,"#frm_negativa_dirigido_2")
  //dirigido(newV,oldV,"#frm_negativa_dirigido_3");
});
//
