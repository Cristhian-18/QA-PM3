$("#btn_condiciones").find("button").on("click", function() {
  var text = $("#frm_txt_condiciones").getValue();
    alert(text);
} );

$("#condicionesPoliza").html($("#tri_condiciones_poliza").getValue());
$("#carteraPoliza").html($("#tri_cartera").getValue());

