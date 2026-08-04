//Subform Check List Documentos
$("#grd_obligatorios").hideColumn(3);
//$("#grd_especificos").hideColumn(3);

$(".pmdynaform-grid-title").removeClass("pmdynaform-grid-title");
//getFieldById("grd_especificos").$el.css("padding-bottom", "150px")

ocultar_todo();
$("#subtit_datos").show();
$("#25830987060590cf686aa76067215111").show();
$("#subtit_commen").show();
$("#3659092825f484ded40e690037283996").show();


$('.menu').on('click', function () {
    ocultar_todo();
    switch (this.id) {
        case 'solicitud':
            $("#subtit_datos").show();

			//if($('#subtit_datos i').attr('class').indexOf("glyphicon-minus") > 0){
			$("#25830987060590cf686aa76067215111").show();
        	$("#subtit_commen").hide();
			$("#3659092825f484ded40e690037283996").hide();
			//}

            break;

        case 'documentos':
            $("#subtit_docs").show();
			
			//if($('#subtit_docs i').attr('class').indexOf("glyphicon-minus") > 0){
				$("#7232410255f4510e7ddb431040314312").show();
				$("#4134920295f9c8c87b37d96033269232").show();
        		$("#4240566656458731d63f9a5040971812").show();
			//}
			
            break;
			
        case 'suscripcion':
            //$("#subtit_revision").show();
			
			//if($('#subtit_revision i').attr('class').indexOf("glyphicon-minus") > 0){
				//$("#9379493576457c9284775a0019336286").show();
				//$("#897660916609f1c71cba367023383689").show();
			//}
			
            break;

        case 'historial':
            $("#subtit_cambios").show();
            $("#subtit_commen").show();
        	//$("#subtit_revision").show();

            $("#frm_accion").show();
            $("#frm_comentario").show();
			
			//if($('#ifrm_sbt_commen i').attr('class').indexOf("glyphicon-minus") > 0){
				$("#3659092825f484ded40e690037283996").show();
			//}		
			//$("#9379493576457c9284775a0019336286").show();
			//if($('#ifrm_sbt_acc i').attr('class').indexOf("glyphicon-minus") > 0){
				$("#9458715575fa435e25efcc4029990032").show();
        		//$("#7143229796457cc4c0f1d64039882781").show();
        		$("#frm_numero_poliza").show();
        
        	$("#btn_emision_save").show();
  			$("#btn_continuar").show();
			//}
            break;
    }
});


function ocultar_todo() {
    $("#subtit_commen").hide();
    $("#3659092825f484ded40e690037283996").hide();
    $("#subtit_datos").hide();
    $("#6479360225f976335c43157021199308").hide();
    $("#subtit_docs").hide();
    $("#7232410255f4510e7ddb431040314312").hide();
    $("#4134920295f9c8c87b37d96033269232").hide();
    $("#subtit_cambios").hide();
    $("#subtit_sise").hide();
    $("#7322237105fa4354c1c5cc1002811158").hide();
    $("#frm_accion").hide();
    $("#frm_comentario").hide();

    $("#25830987060590cf686aa76067215111").hide();
    $("#9458715575fa435e25efcc4029990032").hide();
  	$("#4240566656458731d63f9a5040971812").hide();
	
	//$("#subtit_revision").hide();
	//$("#9379493576457c9284775a0019336286").hide();
	//$("#897660916609f1c71cba367023383689").hide();
  
  $("#btn_emision_save").hide();
  $("#btn_continuar").hide();
	
 
  	//$("#7143229796457cc4c0f1d64039882781").hide();
  	$("#frm_numero_poliza").hide();
	$("#fle_poliza").hide();
    $("#fle_endosos").hide();
}

$("#btn_emision_save").find("button").on("click", function () {
  $("#8954144176457d9bade08a0081167749").saveForm();
  alert("Formulario guardado ...");
});


$("#8954144176457d9bade08a0081167749").setOnSubmit(function () {
    $("#8954144176457d9bade08a0081167749").saveForm();	//debe ir despues de "Encerar campos"
    return true;
});
