$("#frm_primera_cuota_total_primer_pago").setOnchange(calcular);
$("#frm_primera_cuota_descuento").setOnchange(calcular);
$("#frm_primera_cuota_plan").hide();

//calcular();
function calcular()
{
  var sub = $("#frm_primera_cuota_total_primer_pago").getValue()*1;
  var des = $("#frm_primera_cuota_descuento").getValue()*1;  
  var tot = sub - des;
  tot =  tot.toFixed(2);
  $("#frm_primera_cuota_total_pagar").setValue(tot);
  
  if(tot < 1){
      alert('Valor total a pagar no debe ser menor a $1');
      $("#frm_primera_cuota_descuento").setValue(0);
      return false;
    }
  
}

$('#frm_accion').on('change', function(){  
  var accion = $("#frm_accion").getControl().val();  
  if (accion == 'TERMINAR'){ $("#frm_comentario").enableValidation(); }
  else    { $("#frm_comentario").disableValidation();}
});