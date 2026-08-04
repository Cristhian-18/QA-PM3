$(function () {
  $("#frm_sexo").hide();
  var controles = "#frm_declaracion_a_combo,#frm_declaracion_b_combo,#frm_declaracion_c_combo,#frm_declaracion_d_combo,#frm_declaracion_e_combo,#frm_declaracion_f_combo,#frm_declaracion_g_combo,#frm_declaracion_h_combo,#frm_declaracion_i_combo,#frm_declaracion_j_combo,#frm_declaracion_k_combo,#frm_declaracion_l_combo,#frm_declaracion_m_combo,#frm_declaracion_n_combo,#frm_declaracion_o_combo";
  var paneles = "#pnl_a,#pnl_b,#pnl_c,#pnl_d,#pnl_e,#pnl_f,#pnl_g,#pnl_h,#pnl_i,#pnl_j,#pnl_k,#pnl_l,#pnl_m,#pnl_n,#pnl_o,#pnl_p";
  var grids = "#grid_historia_familiar,#grid_medicos_consultados";


  $(controles).find(".textlabel").css("display", "none");

  $(paneles).css("height", "5px");
  $(paneles).css("background-color", "#039BE3");

  $(grids).find(".pmdynaform-grid-title").css("background-color", "#039BE3");
  $(grids).find(".pmdynaform-grid-title").css("font-size", "12px");
  $(grids).find(".pmdynaform-grid-newitem").css("background-color", "#039BE3");
  $(grids).find(".pmdynaform-grid-newitem").css("font-size", "12px");
  $(grids).find(".btn-default").css("background-color", "#039BE3");
  $(grids).find(".btn-default").css("border-color", "#039BE3");
  $("#frm_declaracion_peso").setValue(Math.round($("#frm_declaracion_peso").getValue()));
  $("#frm_declaracion_estatura").setValue(Math.round($("#frm_declaracion_estatura").getValue()));

  validarPeso(false);
  validarEstatura(false);

  // campos_a_combo();
  campos_b_combo();
  campos_c_combo();
  campos_d_combo();
  campos_e_combo();
  campos_f_combo();
  campos_g_combo();
  campos_h_combo();
  campos_i_combo();
  campos_j_combo();
  campos_k_combo();
  campos_l_combo();
  campos_m_combo();
  campos_n_combo();
  campos_o_combo();
  variacionPeso();
  initGridHistoriaFamiliar();
  embarazo();
  cambiarUnidad();
  if ($("#grid_medicos_consultados").getNumberRows() > 0) {
    if ($("#grid_medicos_consultados").getValue()[0][1] == "") {
      $("#grid_medicos_consultados").deleteRow(0);
    }
  }

  // damian para esconder la grilla de exequial cuando viene vacia
  // var num_exe = $("#grid_seguro_exequial").getValue(1, 'frm_exequial_identificacion');
  // if (num_exe == ''){
  // $("#grid_seguro_exequial").clear();
  // }

  // var num_den = $("#grid_dental").getValue(1, 'frm_dental_identificacion');
  // if (num_den == ''){
  // $("#grid_dental").clear();
  // }


});


$("#grid_historia_familiar").onAddRow(function (newArrayRow, gridObject, indexAdd) {
  if (indexAdd >= 3) {
    newArrayRow[0].setValue("HERMANO");
    newArrayRow[0].setText("Hermano(a)");
  }
})

function initGridHistoriaFamiliar() {
  //alert($("#grid_historia_familiar").getNumberRows());
  if ($("#grid_historia_familiar").getNumberRows() < 2) {
    //Inicializar Grid de Historia Familiar
    //$("#grid_historia_familiar").addRow();
    $("#grid_historia_familiar").addRow();

    jQuery("#grid_historia_familiar").setValue('MADRE', '1', '1');
    jQuery("#grid_historia_familiar").setText('Madre', '1', '1');
    jQuery("#grid_historia_familiar").setValue('PADRE', '2', '1');
    jQuery("#grid_historia_familiar").setText('Padre', '2', '1');
  }
  var aGridVals = $('#grid_historia_familiar');
  for (i = 1; i <= 2; i++) {
    $($("#grid_historia_familiar").find("button")[i]).attr("disabled", true);
    //	$($("#grid_historia_familiar").find("select")[i-1][1]).attr("disabled", true);
  }
}




$("#frm_declaracion_peso_variacion").change(function () {
  variacionPeso();
});
function variacionPeso() {
  var opcion = $("#frm_declaracion_peso_variacion option:selected").val();
  // alert ($("#frm_declaracion_a_combo option:selected").val());
  switch (opcion) {
    case 'GANO':
      $("#frm_declaracion_peso_ganado").parent().parent().show("slow");
      jQuery("#frm_declaracion_peso_ganado").enableValidation();
      jQuery("#frm_declaracion_causa_ganancia_peso").enableValidation();
      $("#frm_declaracion_peso_perdido").parent().parent().hide("slow");
      $("#frm_declaracion_peso_perdido").setValue('');
      jQuery("#frm_declaracion_peso_perdido").disableValidation();
      jQuery("#frm_declaracion_causa_perdida_peso").disableValidation();
      $("#frm_declaracion_causa_perdida_peso").setValue('');
      break;
    case 'PERDIO':
      $("#frm_declaracion_peso_ganado").parent().parent().hide("slow");
      $("#frm_declaracion_peso_ganado").setValue('');
      jQuery("#frm_declaracion_peso_ganado").disableValidation();
      jQuery("#frm_declaracion_causa_ganancia_peso").disableValidation();
      $("#frm_declaracion_causa_ganancia_peso").setValue('');
      $("#frm_declaracion_peso_perdido").parent().parent().show("slow");
      jQuery("#frm_declaracion_peso_perdido").enableValidation();
      jQuery("#frm_declaracion_causa_perdida_peso").enableValidation();
      break;
    default:
      $("#frm_declaracion_peso_ganado").parent().parent().hide("slow");
      jQuery("#frm_declaracion_peso_ganado").disableValidation();
      $("#frm_declaracion_peso_perdido").setValue('');
      jQuery("#frm_declaracion_causa_ganancia_peso").disableValidation();
      $("#frm_declaracion_peso_perdido").parent().parent().hide("slow");
      $("#frm_declaracion_peso_ganado").setValue('');
      $("#frm_declaracion_causa_ganancia_peso").setValue('');
      jQuery("#frm_declaracion_peso_perdido").disableValidation();
      jQuery("#frm_declaracion_causa_perdida_peso").disableValidation();
      $("#frm_declaracion_causa_perdida_peso").setValue('');

  }
}



$("#frm_declaracion_peso_unidad").setOnchange(function () {
  $("#frm_declaracion_peso").setValue('');
  cambiarUnidad();
});
function cambiarUnidad() {
  var unidadPeso = $("#frm_declaracion_peso_unidad").getValue();
  $("#frm_declaracion_peso").setLabel("Peso en " + unidadPeso);
  $("#frm_declaracion_peso_ganado").setLabel("Peso en " + unidadPeso + " ganado el ultimo anio");
  $("#frm_declaracion_peso_perdido").setLabel("Peso en " + unidadPeso + " perdido el ultimo anio");
}
//Todos los combos inicializados en Seleccion damian
//$('select option[value=""]').attr("selected", true);



//////////////////////////
//Validar peso y estatura
//////////////////////////
$("#frm_declaracion_peso").on("focusout", function () {
  validarPeso(true);
});

$("#frm_declaracion_estatura").on("focusout", function () {
  validarEstatura(true);
});

function validarPeso(auxAlert) {
  $("#frm_declaracion_peso").getControl().css("borderColor", "");
  var peso = parseFloat($("#frm_declaracion_peso").getValue());

  if ($("#frm_declaracion_peso_unidad option:selected").val() == 'Libras') {
    if (isNaN(peso) || peso <= 87 || peso >= 441) {
      $("#frm_declaracion_peso").getControl().css("borderColor", "#e4655f");
      if (auxAlert) {
        alert("Confirme si el peso es correcto");
      }
      return false;
    }
  }
  else {
    if (isNaN(peso) || peso <= 39 || peso >= 201) {
      $("#frm_declaracion_peso").getControl().css("borderColor", "#e4655f");
      if (auxAlert) {
        alert("Confirme si el peso es correcto");
      }
      return false;
    }

  }


  return true;
}

function validarEstatura(auxAlert) {
  $("#frm_declaracion_estatura").getControl().css("borderColor", "");
  var estatura = parseFloat($("#frm_declaracion_estatura").getValue());
  if (isNaN(estatura) || estatura <= 119 || estatura >= 199) {
    $("#frm_declaracion_estatura").getControl().css("borderColor", "#e4655f");
    if (auxAlert) {
      alert("Confirme si la estatura es correcta");
    }
    return false;
  }
  return true;
}


//Pregunta b)
$("#frm_declaracion_b_combo").change(function () {
  campos_b_combo();
});

function campos_b_combo() {
  if ($("#frm_declaracion_b_combo option:selected").val() == 'S') {
    $("#frm_declaracion_b_detalle").parent().parent().show("slow");
    jQuery("#frm_declaracion_b_detalle").enableValidation();
    if ($("#frm_declaracion_b_detalle").getValue() == '' || $("#frm_declaracion_b_detalle").getValue() == 'N/A') $("#frm_declaracion_b_detalle").setValue('');
  }
  else {
    $("#frm_declaracion_b_detalle").parent().parent().hide("slow");
    $("#frm_declaracion_b_detalle").setValue('N/A');
    jQuery("#frm_declaracion_b_detalle").disableValidation();
  }
}

//Pregunta c)
$("#frm_declaracion_c_combo").change(function () {
  campos_c_combo();
});

function campos_c_combo() {
  if ($("#frm_declaracion_c_combo option:selected").val() == 'S') {
    $("#frm_declaracion_c_detalle").parent().parent().show("slow");
    jQuery("#frm_declaracion_c_detalle").enableValidation();
    if ($("#frm_declaracion_c_detalle").getValue() == '' || $("#frm_declaracion_c_detalle").getValue() == 'N/A') $("#frm_declaracion_c_detalle").setValue('');
  }
  else {
    $("#frm_declaracion_c_detalle").parent().parent().hide("slow");
    $("#frm_declaracion_c_detalle").setValue('N/A');
    jQuery("#frm_declaracion_c_detalle").disableValidation();
  }
}

//Pregunta d)
$("#frm_declaracion_d_combo").change(function () {
  campos_d_combo();
});

function campos_d_combo() {
  if ($("#frm_declaracion_d_combo option:selected").val() == 'S') {
    $("#frm_declaracion_d_motivo").parent().parent().show("slow");
    jQuery("#frm_declaracion_d_motivo").enableValidation();
    $("#frm_declaracion_d_causa").parent().parent().show("slow");
    jQuery("#frm_declaracion_d_causa").enableValidation();
    $("#frm_declaracion_d_resultado").parent().parent().show("slow");
    jQuery("#frm_declaracion_d_resultado").enableValidation();

    if ($("#frm_declaracion_d_motivo").getValue() == '' || $("#frm_declaracion_d_motivo").getValue() == 'N/A') $("#frm_declaracion_d_motivo").setValue('');
    if ($("#frm_declaracion_d_causa").getValue() == '' || $("#frm_declaracion_d_causa").getValue() == 'N/A') $("#frm_declaracion_d_causa").setValue('');
    if ($("#frm_declaracion_d_resultado").getValue() == '' || $("#frm_declaracion_d_resultado").getValue() == 'N/A') $("#frm_declaracion_d_resultado").setValue('');

  }
  else {
    $("#frm_declaracion_d_motivo").parent().parent().hide("slow");
    $("#frm_declaracion_d_motivo").setValue('N/A');
    jQuery("#frm_declaracion_d_motivo").disableValidation();

    $("#frm_declaracion_d_causa").parent().parent().hide("slow");
    $("#frm_declaracion_d_causa").setValue('N/A');
    jQuery("#frm_declaracion_d_causa").disableValidation();

    $("#frm_declaracion_d_resultado").parent().parent().hide("slow");
    $("#frm_declaracion_d_resultado").setValue('N/A');
    jQuery("#frm_declaracion_d_resultado").disableValidation();
  }
}
//Pregunta e)
$("#frm_declaracion_e_combo").change(function () {
  campos_e_combo();
});

function campos_e_combo() {
  if ($("#frm_declaracion_e_combo option:selected").val() == 'S') {
    $("#frm_declaracion_e_detalle").parent().parent().show("slow");
    jQuery("#frm_declaracion_e_detalle").enableValidation();
    if ($("#frm_declaracion_e_detalle").getValue() == '' || $("#frm_declaracion_e_detalle").getValue() == 'N/A') $("#frm_declaracion_e_detalle").setValue('');
  }
  else {
    $("#frm_declaracion_e_detalle").parent().parent().hide("slow");
    $("#frm_declaracion_e_detalle").setValue('N/A');
    jQuery("#frm_declaracion_e_detalle").disableValidation();
  }
}
//Pregunta f)
$("#frm_declaracion_f_combo").change(function () {
  campos_f_combo();
});

function campos_f_combo() {
  if ($("#frm_declaracion_f_combo option:selected").val() == 'S') {
    $("#frm_declaracion_f_detalle").parent().parent().show("slow");
    jQuery("#frm_declaracion_f_detalle").enableValidation();
    if ($("#frm_declaracion_f_detalle").getValue() == '' || $("#frm_declaracion_f_detalle").getValue() == 'N/A') $("#frm_declaracion_f_detalle").setValue('');
  }
  else {
    $("#frm_declaracion_f_detalle").parent().parent().hide("slow");
    $("#frm_declaracion_f_detalle").setValue('N/A');
    jQuery("#frm_declaracion_f_detalle").disableValidation();
  }
}

//Pregunta g)
$("#frm_declaracion_g_combo").change(function () {
  campos_g_combo();
});

function campos_g_combo() {
  if ($("#frm_declaracion_g_combo option:selected").val() == 'S') {
    $("#frm_declaracion_g_detalle").parent().parent().show("slow");
    jQuery("#frm_declaracion_g_detalle").enableValidation();
    if ($("#frm_declaracion_g_detalle").getValue() == '' || $("#frm_declaracion_g_detalle").getValue() == 'N/A') $("#frm_declaracion_g_detalle").setValue('');
  }
  else {
    $("#frm_declaracion_g_detalle").parent().parent().hide("slow");
    $("#frm_declaracion_g_detalle").setValue('N/A');
    jQuery("#frm_declaracion_g_detalle").disableValidation();
  }
}
//Pregunta h)
$("#frm_declaracion_h_combo").change(function () {
  campos_h_combo();
});

function campos_h_combo() {
  if ($("#frm_declaracion_h_combo option:selected").val() == 'S') {
    $("#frm_declaracion_h_edad").parent().parent().show("slow");
    jQuery("#frm_declaracion_h_edad").enableValidation();
    $("#frm_declaracion_h_cantidad").parent().parent().show("slow");
    jQuery("#frm_declaracion_h_cantidad").enableValidation();
    if ($("#frm_declaracion_h_edad").getValue() == '' || $("#frm_declaracion_h_edad").getValue() == 'N/A') $("#frm_declaracion_h_edad").setValue('');
    if ($("#frm_declaracion_h_cantidad").getValue() == '' || $("#frm_declaracion_h_cantidad").getValue() == 'N/A') $("#frm_declaracion_h_cantidad").setValue('');
  }
  else {
    $("#frm_declaracion_h_edad").parent().parent().hide("slow");
    $("#frm_declaracion_h_edad").setValue('N/A');
    jQuery("#frm_declaracion_h_edad").disableValidation();
    $("#frm_declaracion_h_cantidad").parent().parent().hide("slow");
    $("#frm_declaracion_h_cantidad").setValue('N/A');
    jQuery("#frm_declaracion_h_cantidad").disableValidation();
  }
}
//Pregunta i)
$("#frm_declaracion_i_combo").change(function () {
  campos_i_combo();
});

function campos_i_combo() {
  if ($("#frm_declaracion_i_combo option:selected").val() == 'S') {
    $("#frm_declaracion_i_detalle").parent().parent().show("slow");
    jQuery("#frm_declaracion_i_detalle").enableValidation();
    if ($("#frm_declaracion_i_detalle").getValue() == '' || $("#frm_declaracion_i_detalle").getValue() == 'N/A') $("#frm_declaracion_i_detalle").setValue('');
  }
  else {
    $("#frm_declaracion_i_detalle").parent().parent().hide("slow");
    $("#frm_declaracion_i_detalle").setValue('N/A');
    jQuery("#frm_declaracion_i_detalle").disableValidation();
  }
}
//Pregunta j)
$("#frm_declaracion_j_combo").change(function () {
  campos_j_combo();
});

function campos_j_combo() {
  if ($("#frm_declaracion_j_combo option:selected").val() == 'S') {
    // $("#frm_declaracion_j_detalle").parent().parent().show("slow");
    //jQuery("#frm_declaracion_j_detalle").enableValidation();
    alert("Recuerde llenar el formulario adicional para esta pregunta");
  }
  else {
    // $("#frm_declaracion_j_detalle").parent().parent().hide("slow");
    //	$("#frm_declaracion_j_detalle").setValue('');
    //  jQuery("#frm_declaracion_j_detalle").disableValidation();
  }
}
//Pregunta k)
$("#frm_declaracion_k_combo").change(function () {
  campos_k_combo();
});

function campos_k_combo() {
  if ($("#frm_declaracion_k_combo option:selected").val() == 'S') {


    $("#frm_declaracion_k_clase").parent().parent().show("slow");
    jQuery("#frm_declaracion_k_clase").enableValidation();
    $("#frm_declaracion_k_cantidad").parent().parent().show("slow");
    jQuery("#frm_declaracion_k_cantidad").enableValidation();
    $("#frm_declaracion_k_frecuencia").parent().parent().show("slow");
    jQuery("#frm_declaracion_k_frecuencia").enableValidation();
    if ($("#frm_declaracion_k_clase").getValue() == '' || $("#frm_declaracion_k_clase").getValue() == 'N/A') $("#frm_declaracion_k_clase").setValue('');
    if ($("#frm_declaracion_k_cantidad").getValue() == '' || $("#frm_declaracion_k_cantidad").getValue() == 'N/A') $("#frm_declaracion_k_cantidad").setValue('');
    if ($("#frm_declaracion_k_frecuencia").getValue() == '' || $("#frm_declaracion_k_frecuencia").getValue() == 'N/A') $("#frm_declaracion_k_frecuencia").setValue('');
  }
  else {
    $("#frm_declaracion_k_clase").parent().parent().hide("slow");
    $("#frm_declaracion_k_clase").setValue('N/A');
    jQuery("#frm_declaracion_k_clase").disableValidation();
    $("#frm_declaracion_k_cantidad").parent().parent().hide("slow");
    $("#frm_declaracion_k_cantidad").setValue('N/A');
    jQuery("#frm_declaracion_k_cantidad").disableValidation();
    $("#frm_declaracion_k_frecuencia").parent().parent().hide("slow");
    $("#frm_declaracion_k_frecuencia").setValue('N/A');
    jQuery("#frm_declaracion_k_frecuencia").disableValidation();
  }
}
//Pregunta l)
$("#frm_declaracion_l_combo").change(function () {
  campos_l_combo();
});

function campos_l_combo() {
  if ($("#frm_declaracion_l_combo option:selected").val() == 'S') {
    $("#frm_declaracion_l_detalle").parent().parent().show("slow");
    jQuery("#frm_declaracion_l_detalle").enableValidation();
    if ($("#frm_declaracion_l_detalle").getValue() == '' || $("#frm_declaracion_l_detalle").getValue() == 'N/A') $("#frm_declaracion_l_detalle").setValue('');
  }
  else {
    $("#frm_declaracion_l_detalle").parent().parent().hide("slow");
    $("#frm_declaracion_l_detalle").setValue('N/A');
    jQuery("#frm_declaracion_l_detalle").disableValidation();
  }
}
//Pregunta m)
$("#frm_declaracion_m_combo").change(function () {
  campos_m_combo();
});

function campos_m_combo() {
  if ($("#frm_declaracion_m_combo option:selected").val() == 'S') {
    $("#frm_declaracion_m_detalle").parent().parent().show("slow");
    jQuery("#frm_declaracion_m_detalle").enableValidation();
    if ($("#frm_declaracion_m_detalle").getValue() == '' || $("#frm_declaracion_m_detalle").getValue() == 'N/A') $("#frm_declaracion_m_detalle").setValue('');
  }
  else {
    $("#frm_declaracion_m_detalle").parent().parent().hide("slow");
    $("#frm_declaracion_m_detalle").setValue('N/A');
    jQuery("#frm_declaracion_m_detalle").disableValidation();
  }
}
//Pregunta n)
$("#frm_declaracion_n_combo").change(function () {
  campos_n_combo();
});

function campos_n_combo() {
  if ($("#frm_declaracion_n_combo option:selected").val() == 'S') {
    $("#frm_declaracion_n_detalle").parent().parent().show("slow");
    jQuery("#frm_declaracion_n_detalle").enableValidation();
    if ($("#frm_declaracion_n_detalle").getValue() == '' || $("#frm_declaracion_n_detalle").getValue() == 'N/A') $("#frm_declaracion_n_detalle").setValue('');
  }
  else {
    $("#frm_declaracion_n_detalle").parent().parent().hide("slow");
    $("#frm_declaracion_n_detalle").setValue('N/A');
    jQuery("#frm_declaracion_n_detalle").disableValidation();
  }
}
//Pregunta o)
$("#frm_declaracion_o_combo").change(function () {
  campos_o_combo();
});

function campos_o_combo() {
  if ($("#frm_declaracion_o_combo option:selected").val() == 'N') {
    $("#frm_declaracion_o_detalle").parent().parent().show("slow");
    jQuery("#frm_declaracion_o_detalle").enableValidation();
    if ($("#frm_declaracion_o_detalle").getValue() == '' || $("#frm_declaracion_o_detalle").getValue() == 'N/A') $("#frm_declaracion_o_detalle").setValue('');
  }
  else {
    $("#frm_declaracion_o_detalle").parent().parent().hide("slow");
    $("#frm_declaracion_o_detalle").setValue('N/A');
    jQuery("#frm_declaracion_o_detalle").disableValidation();
  }
}
function embarazo() {
  if ($('#frm_sexo').getValue() == "F") {

    $('#frm_declaracion_embarazo').parent().parent().show();
    jQuery("#frm_declaracion_embarazo").enableValidation();
    $('#frm_declaracion_fecha_cita').parent().parent().show();
    jQuery("#frm_declaracion_fecha_cita").enableValidation();
    $('#frm_declaracion_resultado_cita').parent().parent().show();
    jQuery("#frm_declaracion_resultado_cita").enableValidation();


  }
  else {
    $('#frm_declaracion_embarazo').parent().parent().hide();
    $('#frm_declaracion_embarazo').setValue('N/A');
    jQuery("#frm_declaracion_embarazo").disableValidation();
    $('#frm_declaracion_fecha_cita').parent().parent().hide();
    $('#frm_declaracion_fecha_cita').setValue('');
    jQuery("#frm_declaracion_fecha_cita").disableValidation();
    $('#frm_declaracion_resultado_cita').parent().parent().hide();
    $('#frm_declaracion_resultado_cita').setValue('N/A');
    jQuery("#frm_declaracion_resultado_cita").disableValidation();

  }
}

validarGrillaHistoriaFamiliar(false);	//al cargar el form

$("#grid_historia_familiar").change(function () {

  validarGrillaHistoriaFamiliar(true);

});

function validarGrillaHistoriaFamiliar(auxAlert) {

  var bandera = true;
  var filas = $("#grid_historia_familiar").getNumberRows();

  for (f = 1; f <= filas; f++) {

    $("#grid_historia_familiar").getControl(f, 3).css("borderColor", "");
    $("#grid_historia_familiar").getControl(f, 5).css("borderColor", "");
    $("#grid_historia_familiar").getControl(f, 6).css("borderColor", "");
    $("#grid_historia_familiar").getControl(f, 8).css("borderColor", "");

    // Validacion FALLECIDO
    var edadDiagnosticoFallecido = $("#grid_historia_familiar").getValue(f, 8);
    var edadMorir = $("#grid_historia_familiar").getValue(f, 6);

    if (edadDiagnosticoFallecido != "" && edadMorir != "" && edadDiagnosticoFallecido > edadMorir) {
      bandera = false;
      $("#grid_historia_familiar").getControl(f, 8).css("borderColor", "red");
      $("#grid_historia_familiar").getControl(f, 6).css("borderColor", "red");
      if (auxAlert) {
        alert("Edad de Diagnostico no puede ser mayor a la Edad al morir");
      }
    }

    // Validacion VIVO
    var edadDiagnosticoVivo = $("#grid_historia_familiar").getValue(f, 5);
    var edadActual = $("#grid_historia_familiar").getValue(f, 3);

    if (edadDiagnosticoVivo != "" && edadActual != "" && edadDiagnosticoVivo > edadActual) {
      bandera = false;
      $("#grid_historia_familiar").getControl(f, 5).css("borderColor", "red");
      $("#grid_historia_familiar").getControl(f, 3).css("borderColor", "red");
      if (auxAlert) {
        alert("Edad Diagnostico no puede ser mayor a la Edad Actual");
      }
    }

  }



  return bandera;
}












