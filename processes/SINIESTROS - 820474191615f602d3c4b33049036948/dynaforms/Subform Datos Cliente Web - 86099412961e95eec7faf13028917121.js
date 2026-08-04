function registro_siniestro(newValue, oldValue){
  if(newValue != '001'){
  	$("#frm_registro_siniestro").setValue('C');
    $("#frm_numero_poliza_b").hide();
    $("#frm_numero_poliza_b").disableValidation();
  }else{
  	$("#frm_registro_siniestro").setValue('P');
    $("#frm_numero_poliza_b").show();
    $("#frm_numero_poliza_b").enableValidation();
  }

}

$("#btn_consultar_pol").hide();
$("#frm_numero_poliza_b").hide();
$("#frm_tipo_contratante").hide();
$("#frm_registro_siniestro").hide();
$("#frm_numero_poliza_pvcero").hide();
$("#frm_tipo_siniestro").hide();
$("#frm_cobertura_madre").hide();
$("#frm_mes_vencido_web").hide();

$("#frm_tipo_contratante").setOnchange(registro_siniestro);

function cargar_pol(newValue, oldValue){
  if(newValue != ''){    
    const myArray = newValue.split("|");
    $("#frm_numero_poliza_pvcero").setValue(myArray[0]);
  	$("#frm_numero_poliza_b").setValue(myArray[1]);
  }else{
  	$("#frm_numero_poliza_pvcero").setValue('');
    $("#frm_numero_poliza_b").setValue('');
  }

}

$("#frm_pols_contratante").setOnchange(cargar_pol);
if($("#TASK").getValue() == '799986505615f607b50a4f4033464318'){
  $("#frm_fecha_notificacion_real").show();
  $("#frm_fecha_notificacion_real").enableValidation();
}else{
  $("#frm_fecha_notificacion_real").disableValidation();
  $("#frm_fecha_notificacion_real").hide();
}