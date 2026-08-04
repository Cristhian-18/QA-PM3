function calcularTotalProformado() {
  let manoObra = parseFloat($("#frm_valoresAprobados_manoObraProformada").getValue()) || 0;
  let repuestos = parseFloat($("#frm_valoresAprobados_valorRepuestosProformado").getValue()) || 0;
  let total = roundToFixed(manoObra + repuestos, 2);
  $("#frm_valoresAprobados_totalProformado").setValue(total);
}

function calcularTotalSiniestro() {
  let manoObra = parseFloat($("#frm_valoresSiniestro_manoObraProformada").getValue()) || 0;
  let repuestos = parseFloat($("#frm_valoresSiniestro_valoresRepuestos1").getValue()) || 0;
  let total = roundToFixed(manoObra + repuestos, 2);
  $("#frm_valoresSiniestro_totalProformado").setValue(total);
}

$("#frm_valoresAprobados_procentajeDescuentoProformado").setOnchange(function(newVal, oldVal) {
  let max = 100;
  let min = 0;
  let value = limitMaxMin(newVal, max, min);
  if (value != '') {
    value = roundToFixed(value, 2);
  }
  value = roundToFixed(newVal, 2);
  $("#frm_valoresAprobados_procentajeDescuentoProformado").setValue(value);
})

$("#frm_valoresAprobados_valoresRepuestos1").setOnchange(function(newVal, oldVal) {
  let value = roundToFixed(newVal, 2);
  $("#frm_valoresAprobados_valoresRepuestos1").setValue(value);
 
})

$("#frm_valoresAprobados_valorRepuestosProformado").setOnchange(function(newVal, oldVal) {
  let value = roundToFixed(newVal, 2);
  $("#frm_valoresAprobados_valorRepuestosProformado").setValue(value);
 
})

$("#frm_valoresAprobados_manoObraProformada").setOnchange(function(newVal, oldVal) {
  let value = roundToFixed(newVal, 2);
  $("#frm_valoresAprobados_manoObraProformada").setValue(value);
 
})

$("#frm_valoresSiniestro_manoObraProformada").setOnchange(function(newVal, oldVal) {
  let value = roundToFixed(newVal, 2);
  $("#frm_valoresSiniestro_manoObraProformada").setValue(value);
 
})

$("#frm_valoresAprobados_totalProformado").setOnchange(function(newVal, oldVal) {
  let value = roundToFixed(newVal, 2);
  $("#frm_valoresAprobados_totalProformado").setValue(value);
})

$("#frm_valoresAprobados_diasEstimadosReparacion").setOnchange(function(newVal, oldVal) {
  let value = roundToFixed(newVal, 0);
  $("#frm_valoresAprobados_diasEstimadosReparacion").setValue(value);
})

calcularTotalProformado();
calcularTotalSiniestro();
