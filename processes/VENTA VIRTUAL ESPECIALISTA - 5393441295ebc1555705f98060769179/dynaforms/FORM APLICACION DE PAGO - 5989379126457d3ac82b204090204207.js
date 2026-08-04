//Subform Check List Documentos
//$("#grd_obligatorios").hideColumn(3);
//$("#grd_especificos").hideColumn(3);
$(".btn-uploadfile").text("Seleccionar archivo");
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
        		$("#7143229796457cc4c0f1d64039882781").show();
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
	
	//$("#subtit_revision").hide();
	$("#4240566656458731d63f9a5040971812").hide();
	//$("#897660916609f1c71cba367023383689").hide();
  
  $("#btn_emision_save").hide();
  $("#btn_continuar").hide();
	
 
  	$("#7143229796457cc4c0f1d64039882781").hide();
  	$("#frm_numero_poliza").hide();
	$("#fle_poliza").hide();
    $("#fle_endosos").hide();
    $("#fileEvidPago1").hide();
	$("#fileEvidPago2").hide();
}

$("#btn_emision_save").find("button").on("click", function () {
  $("#5989379126457d3ac82b204090204207").saveForm();
  alert("Formulario guardado ...");
});


$("#5989379126457d3ac82b204090204207").setOnSubmit(function () {
    $("#5989379126457d3ac82b204090204207").saveForm();	//debe ir despues de "Encerar campos"
    if (ValidarEvidenciaPago() && ValidarEvidenciaPago2()){
      return true;
    }
});


function ValidarEvidenciaPago(){
  var bandera = true;
  
  var arrayPdf1 = $("#fileEvidPago1").find(".pmdynaform-field-control li");
  if (arrayPdf1.length == 0) {
    bandera = true;
    return bandera;
  } else if (arrayPdf1.length > 1) {
    alert("Evidencia 1 - Por favor adjunte solo un archivo");
    bandera = false;
  }
  
  const nameEvidenciaPdf1 = [];
  $.each(arrayPdf1, function (index, value) {

    nombreArchivo_PDF = $(value).html();

    if (nombreArchivo_PDF != '' && typeof nombreArchivo_PDF !== 'undefined') {
      var pizza = nombreArchivo_PDF.toString().trim().split('.');
      var ext = pizza[pizza.length - 1];
      if (ext != "pdf" && ext != "PDF") {
        alert("Evidencia 1 - debe ser un archivo .pdf");
        bandera = false;
      }
    }

    //verificar repetidos
    if (jQuery.inArray(nombreArchivo_PDF, nameEvidenciaPdf1) !== -1) {
      alert("Archivos PDF repetidos");
      bandera = false;
    }
    nameEvidenciaPdf1.push(nombreArchivo_PDF);

  });
  
  return bandera;
}

function ValidarEvidenciaPago2(){
  var bandera = true;
  
  var arrayPdf = $("#fileEvidPago2").find(".pmdynaform-field-control li");
  if (arrayPdf.length == 0) {
    bandera = true;
    return bandera;
  } else if (arrayPdf.length > 1) {
    alert("Evidencia 2 - Por favor adjunte solo un archivo");
    bandera = false;
  }
  
  const nameEvidenciaPdf = [];
  $.each(arrayPdf, function (index, value) {

    nombreArchivo_PDF = $(value).html();

    if (nombreArchivo_PDF != '' && typeof nombreArchivo_PDF !== 'undefined') {
      var pizza = nombreArchivo_PDF.toString().trim().split('.');
      var ext = pizza[pizza.length - 1];
      if (ext != "pdf" && ext != "PDF") {
        alert("Evidencia 2 - debe ser un archivo .pdf");
        bandera = false;
      }
    }

    //verificar repetidos
    if (jQuery.inArray(nombreArchivo_PDF, nameEvidenciaPdf) !== -1) {
      alert("Archivos PDF repetidos");
      bandera = false;
    }
    nameEvidenciaPdf.push(nombreArchivo_PDF);

  });
  
  return bandera;
}

function acciones(){
var accion =   $("#frm_accion").getControl().val();
  $("#frm_comentario").disableValidation();
  //alert ("accion");
  if(accion == 'PAGAR'){
    $("#frm_comentario").enableValidation();
  }
  if(accion == 'CONTINUAR'){
	$("#fileEvidPago1").show();
	$("#fileEvidPago2").show();
  }else{
    $("#fileEvidPago1").hide();
	$("#fileEvidPago2").hide();
  }
}


$('#frm_accion').setOnchange(acciones);
acciones();
