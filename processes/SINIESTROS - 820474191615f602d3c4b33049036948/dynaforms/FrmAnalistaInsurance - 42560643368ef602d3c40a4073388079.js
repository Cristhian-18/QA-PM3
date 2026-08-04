// created by Henry
$(document).ready(function () {
  $("#frm_accion").getControl().val("").trigger("change");
  if ($("#frmTipoGestion").getValue() == "LIQUIDACION") {
    $("#frmValorLiquidarInsurance").enableValidation();
  } else {
    $("#frmValorLiquidarInsurance").disableValidation();
  }

  function accion(newValue, oldValue) {
    $("#frm_comentario").setValue("");

    if ($("#frmTipoGestion").getValue() == "LIQUIDACION") {
      $("#frmValorLiquidarInsurance").enableValidation();
    } else {
      $("#frmValorLiquidarInsurance").disableValidation();
    }

   
  }

  accion($("#frm_accion").getValue(), null);

  $("#frm_accion").getControl().on("change", function () {
    var newValue = $("#frm_accion").getValue();
    accion(newValue, null);
  });

  // Evento para el botón
  $("#btn_enviar").click(function (event) {
    $("#frm_monto_liquidar").disableValidation();
    if ($("#frmTipoGestion").getValue() == "LIQUIDACION") {
      $("#frmValorLiquidarInsurance").enableValidation();
    } else {
      $("#frmValorLiquidarInsurance").disableValidation();
    }

    var newValue = $("#frm_accion").getValue();
    if (newValue == "FINALIZAR_I") {
      if ($("#frmTipoGestion").getValue() == "NEGATIVA"){
        alert("Por favor no se olvide de dar de baja la reserva.");
      }
    }
  });

});
