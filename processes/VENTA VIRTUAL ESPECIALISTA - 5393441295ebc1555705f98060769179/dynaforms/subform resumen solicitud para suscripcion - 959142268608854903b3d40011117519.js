
/*
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
*/



$(function() {

if(typeof calcular_edad === 'function') {
	
	var fechaNacimiento = $("#frm_fecha_nacimiento").getValue();
	alert(fechaNacimiento);
	$("#frm_resumen_edad").setValue(calcular_edad(fechaNacimiento));
	
}

});








