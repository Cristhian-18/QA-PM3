//created by Henry
//$("#361044504624e0b4c74a4c2046528217").hide();



function accion(newValue, oldValue) {
  $("#frm_comentario").setValue("");
  
  $("#frm_monto_liquidar").disableValidation();
}
accion();
$("#frm_accion").setOnchange(accion);



// Asignar un evento click al boton con id "btn_enviar"
$("#btn_enviar").click(function(event) {
  let newValue = $("#frm_accion").getValue();    
  if(newValue == "DOCUMENTAR"){
    event.preventDefault();    
    const confirmar = confirm("Verifique que los correos ingresados se encuentren correctos, ya que estos recibiran la notificacion de la solicitud de documentos adicionales.");
    if (confirmar) {
      const confirmar2 = confirm("Esta seguro de que el valor colocado en el Monto Aprobado es el valor correcto? VALIDAR EN SISE.");
      if (confirmar2) {
        $("#19704822661d89a84dc5eb6067966042").submit();
      }
    }
  }else if(newValue == 'NEGAR' || newValue == 'NO_PROCEDER'){
    event.preventDefault();
    const confirmar = confirm("Verifique que los correos ingresados se encuentren correctos, ya que estos recibiran la notificacion de la negativa.");
    if (confirmar) {
      $("#19704822661d89a84dc5eb6067966042").submit();
    }
  }else if(newValue == 'APROBAR'||newValue == 'MEDICO' || newValue == 'MANTENER'|| newValue == 'DEVOLVER'){
    event.preventDefault();    
    const confirmar = confirm("Esta seguro de que el valor colocado en el Monto Aprobado es el valor correcto? VALIDAR EN SISE.");
    console.log("confirmar: " + confirmar);
    if (confirmar) {
      $("#19704822661d89a84dc5eb6067966042").submit();
    }
  }
});
