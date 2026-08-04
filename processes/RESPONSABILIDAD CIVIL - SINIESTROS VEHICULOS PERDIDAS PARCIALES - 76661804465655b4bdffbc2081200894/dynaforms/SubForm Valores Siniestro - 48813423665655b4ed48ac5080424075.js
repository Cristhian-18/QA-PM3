$("#frm_valoresSiniestro_procentajeDescuentoProformado").setOnchange(function(newVal, oldVal) {

  let max = 100;
  let min = 0;
  let value = limitMaxMin(newVal, max, min);
  if(value!=''){
    value = roundToFixed(value, 2);
  }
  value = roundToFixed(newVal, 2);
  $("#frm_valoresSiniestro_procentajeDescuentoProformado").setValue(value);
})

$("#frm_valoresSiniestro_valoresRepuestos1").setOnchange(function(newVal, oldVal) {

  let value = roundToFixed(newVal, 2);
  $("#frm_valoresSiniestro_valoresRepuestos1").setValue(value);
})

$("#frm_valoresSiniestro_valorRepuestosProformado").setOnchange(function(newVal, oldVal) {

  let value = roundToFixed(newVal, 2);
  $("#frm_valoresSiniestro_valorRepuestosProformado").setValue(value);
})

$("#frm_valoresSiniestro_manoObraProformada").setOnchange(function(newVal, oldVal) {

  let value = roundToFixed(newVal, 2);
  $("#frm_valoresSiniestro_manoObraProformada").setValue(value);
})

$("#frm_valoresSiniestro_totalProformado").setOnchange(function(newVal, oldVal) {

  let value = roundToFixed(newVal, 2);
  $("#frm_valoresSiniestro_totalProformado").setValue(value);
})

$("#frm_valoresSiniestro_diasEstimadosReparacion").setOnchange(function(newVal, oldVal) {

  let value = roundToFixed(newVal, 0);
  $("#frm_valoresSiniestro_diasEstimadosReparacion").setValue(value);
})



