$("#frm_alcanceAdicional_valorRepuestos").setOnchange(function(newVal, oldVal) {
  console.log(newVal);
  let value = roundToFixed(newVal, 2);
  $("#frm_alcanceAdicional_valorRepuestos").setValue(value);
})

$("#frm_alcanceAdicional_valorMano").setOnchange(function(newVal, oldVal) {
  console.log(newVal);
  let value = roundToFixed(newVal, 2);
  $("#frm_alcanceAdicional_valorMano").setValue(value);
})

$("#frm_alcanceAdicional_total").setOnchange(function(newVal, oldVal) {
  console.log(newVal);
  let value = roundToFixed(newVal, 2);
  $("#frm_alcanceAdicional_total").setValue(value);
})
