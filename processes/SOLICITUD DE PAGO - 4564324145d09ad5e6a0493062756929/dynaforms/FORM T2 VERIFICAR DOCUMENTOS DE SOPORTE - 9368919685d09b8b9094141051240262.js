$( document ).ready(function() {
  ocultar_todo();
  $('#menu1').show();    
  $("#subtit_solicitante").show(); 
  $("#2103186295d09b1e15c6ea1035176468").show();
  $("#subtit_requerimiento").show();  
  $("#7953612365d09b9efcecfa7084181429").show();
  $("#subtit_accion").show();  
  $("#frm_accion").show();    
  $("#frm_fecha_aprobacion").show();  
  $("#frm_comentario").show();  
  $("#btn_continuar").show();   
  $("#frm_chk_documento").show();   
  $("#subtit_prov").show();
  $("#8920896775d37d1cf470856076601548").show();  
  ////////////////////////////
  //$("#grd_detalle").deleteRow(1);
  
  var totalCost = parseFloat($("#grd_detalle").getSummary("frm_producto_total"));
  
  $("#frm_valor_total").setValue(totalCost);
  $("#btn_ruc").hide();
});

$("#btn_save").click( function ()
{

$("#8769947935bce9ea9b14407038315848").saveForm()  
  alert ("Guardado");  
})


