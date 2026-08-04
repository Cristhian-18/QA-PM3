function fmt(val, decimals) {
  let n = parseFloat(String(val).replace(/,/g, ''));
  if (isNaN(n)) return '';
  return n.toFixed(decimals);
}

$(document).ready(function() {
  var campos = [
    "frm_alcanceAdicional_valorRepuestosAprobado",
    "frm_alcanceAdicional_valorManoAprobado",
    "frm_alcanceAdicional_valorTotalAprobado",
    "frm_alcanceAdicional_valorRepuestos",
    "frm_alcanceAdicional_total"
  ];

  campos.forEach(function(id) {
    var val = $("#" + id).getValue();
    if (val !== '' && val !== null && val !== undefined) {
      $("#" + id).setValue(fmt(val, 2));
    }
  });
});

$("#frm_alcanceAdicional_valorRepuestosAprobado").setOnchange(function(newVal, oldVal) {
  $("#frm_alcanceAdicional_valorRepuestosAprobado").setValue(fmt(newVal, 2));
});

$("#frm_alcanceAdicional_valorManoAprobado").setOnchange(function(newVal, oldVal) {
  $("#frm_alcanceAdicional_valorManoAprobado").setValue(fmt(newVal, 2));
});

$("#frm_alcanceAdicional_valorTotalAprobado").setOnchange(function(newVal, oldVal) {
  $("#frm_alcanceAdicional_valorTotalAprobado").setValue(fmt(newVal, 2));
});

$("#frm_alcanceAdicional_valorRepuestos").setOnchange(function(newVal, oldVal) {
  $("#frm_alcanceAdicional_valorRepuestos").setValue(fmt(newVal, 2));
});

$("#frm_alcanceAdicional_total").setOnchange(function(newVal, oldVal) {
  $("#frm_alcanceAdicional_total").setValue(fmt(newVal, 2));
});