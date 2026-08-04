$(document).ready(function () {
  ocultar_todo();
  $("#subtit_prov").show();
  $("#8920896775d37d1cf470856076601548").show();
  $("#btn_ruc").hide();
  $('#menu1').show();
  $("#subtit_solicitante").show();
  $("#2103186295d09b1e15c6ea1035176468").show();
  $("#subtit_requerimiento").show();
  $("#7953612365d09b9efcecfa7084181429").show();
  $("#subtit_accion").show();
  $("#frm_accion").show();
  $("#frm_fecha_aprobacion").show();
  $("#frm_comentario").show();
  $("#frm_chk_documento").show();
  $("#btn_continuar").show();
  ////////////////////////////
  var data = $("#grd_detalle").getData();
  console.log("data completa:", data);

  var rows = data.gridtable || [];
  var total = 0;

  rows.forEach(function (row) {
    row.forEach(function (cell) {
      if (cell.name === 'frm_producto_total') {
        total += parseFloat(cell.value) || 0;
      }
    });
  });

  console.log("Total calculado:", total);
  $("#frm_pago_valor").setValue(total);
});

$("#frm_pago_numfactura").getControl().mask("999-999-999?9999999");

$("#btn_save").click(function () {
  $("#8769947935bce9ea9b14407038315848").saveForm()
  alert("Guardado");
})