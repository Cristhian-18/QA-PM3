$( function(){
  var aux = $("#frm_recibio_deposito").getControl().val();
  if (aux == 'S'){
    $("#frm_primera_cuota_medio_pago").hide();   
    $("#frm_deposito_medio").show();   
  }
  else
  {
    $("#frm_primera_cuota_medio_pago").show();   
    $("#frm_deposito_medio").hide();       
  }
})
