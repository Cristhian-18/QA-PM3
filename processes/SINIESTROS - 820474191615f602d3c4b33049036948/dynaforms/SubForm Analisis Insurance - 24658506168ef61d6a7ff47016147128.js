function accion(newValue, oldValue) {
  $("#frm_negativa_nota").disableValidation();  
  if(newValue == 'NEGATIVA'){
    $("#frm_negativa_nota").enableValidation();    
    $("#frmValorLiquidarInsurance").disableValidation();
  }else{
    $("#frmValorLiquidarInsurance").enableValidation();    
  }
}

accion();
$("#frmTipoGestion").setOnchange(accion);