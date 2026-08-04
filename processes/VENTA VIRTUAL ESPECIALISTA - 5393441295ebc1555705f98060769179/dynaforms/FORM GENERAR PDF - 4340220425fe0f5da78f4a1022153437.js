
$("#6248928035fd95293b0c439084434656").css('border-width','0');

$("#panelGenerarPDF").css('border-width','0');


$("#panelGenerarPDF").css('margin-top','150px');
$("#panelGenerarPDF").hide();


if($("#bandera_regresar").getValue()*1 == 0){
	
	$("#dyn_backward").hide();
	
}

//Funcionalidad al regresar a la pantalla anterior
$( "#dyn_backward" ).click(function() {
	
  $("#bandera_regresar").setValue(0);
  
  $("#6248928035fd95293b0c439084434656").saveForm();
  
});


//Ocultar menu clic derecho
$(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
	
	document.oncontextmenu = function(){return false}
});

$("#btn_generar_pdf_submit").find("button").on("click" , function() {
    $("#6248928035fd95293b0c439084434656").showFormModal();
	$("#panelGenerarPDF").show();
    // $("#6248928035fd95293b0c439084434656").saveForm();
});



$("#frm_cliente_medio_aprobacion").hide();
$("#frm_pagador_medio_aprobacion").hide();

$("#frm_cliente_medio_aprobacion").show();
if($("#frm_pago_terceros").getValue() == 'S'){
  $("#frm_pagador_medio_aprobacion").show();
  $("#frm_pagador_medio_aprobacion").enableValidation();
}
