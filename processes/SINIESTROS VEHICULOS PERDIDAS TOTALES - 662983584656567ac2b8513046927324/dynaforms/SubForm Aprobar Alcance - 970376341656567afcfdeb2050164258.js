$("#frm_alcanceAdicional_valorRepuestosAprobado").setOnchange(function(newVal, oldVal) {
  console.log(newVal);
  let value = roundToFixed(newVal, 2);
  $("#frm_alcanceAdicional_valorRepuestosAprobado").setValue(value);
})

$("#frm_alcanceAdicional_valorManoAprobado").setOnchange(function(newVal, oldVal) {
  console.log(newVal);
  let value = roundToFixed(newVal, 2);
  $("#frm_alcanceAdicional_valorManoAprobado").setValue(value);
})

$("#frm_alcanceAdicional_valorTotalAprobado").setOnchange(function(newVal, oldVal) {
  console.log(newVal);
  let value = roundToFixed(newVal, 2);
  $("#frm_alcanceAdicional_valorTotalAprobado").setValue(value);
})
