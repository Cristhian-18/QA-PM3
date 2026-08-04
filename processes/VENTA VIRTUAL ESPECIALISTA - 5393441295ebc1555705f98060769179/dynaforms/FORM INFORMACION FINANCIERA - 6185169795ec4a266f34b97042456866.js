alert("aca");
$("#6185169795ec4a266f34b97042456866").setOnSubmit(function(){
  alert("aca1");
  
  
  var principalValue =  $('#frm_financiera_actividad_principal').getValue().trim();
  principalValue = principalValue *1;
  alert (principalValue);
  if (principalValue == 0 ){alert ("Total de ingresos por actividad principal no debe ser 0"); return false;}

  var principalValue =  $('#frm_financiera_total_egresos').getValue().trim();
  principalValue = principalValue *1;
  if (principalValue == 0 ){alert ("Total de egresos no debe ser 0"); return false;}
  
  var principalValue =  $('#frm_financiera_total_activos').getValue().trim();
  principalValue = principalValue *1;
  if (principalValue == 0 ){alert ("Total de activos no debe ser 0"); return false;}  
  
  $("#6185169795ec4a266f34b97042456866").saveForm() ;
  return showConfirmDlg();
});

$("#btn_financiera_save").find("button").on("click" , function() {
  $("#6185169795ec4a266f34b97042456866").saveForm();
  alert ("Formulario guardado ...");  
});

