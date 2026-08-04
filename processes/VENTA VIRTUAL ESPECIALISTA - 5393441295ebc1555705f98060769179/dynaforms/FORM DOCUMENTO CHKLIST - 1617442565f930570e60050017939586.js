$("#subtit_obl").hide();
$("#grd_obligatorios").hide();
$("#grd_especificos").hide();
$("#frm_opcionales").hide();
//$("#fle_docs_cliente").hide();


$(".pmdynaform-multiplefile-control").find("button").html("Seleccionar archivos");

var valor = $("#grd_especificos").getValue(1, 1);
if (valor == "") {
	$("#grd_especificos").clear();
}

var valorTipoAgente = $('#frm_aps_codigo_tipoAgente').getValue();
if (valorTipoAgente && !isNaN(valorTipoAgente)) {
  var codigoTipoAgente = parseInt(valorTipoAgente);
  codigoTipoAgente = 3;
  // Evaluar si es fuerza de ventas
  if (codigoTipoAgente == 3) {
    $("#file_primeraCuota").enableValidation();
  }else{
    $("#file_primeraCuota").disableValidation();
  }
}else{
  $("#file_primeraCuota").disableValidation();
}


$("#frm_cedula_fechaCaducidad").setOnchange(checkValidezCedula);

function checkValidezCedula(newValue, oldValue) {
	let now = $("#now").getValue();
	console.log(now);
	let fechaCaducidad = $("#frm_cedula_fechaCaducidad").getValue();
	console.log(fechaCaducidad);
	//check validez
	if (fechaCaducidad < now && fechaCaducidad != "") {
		/*alert("Revisar la fecha de caducidad de la tarjeta");
		$("#frm_fecha_caducidad_tarjeta").setValue('');*/
		alert ("La cedula ingresada esta vencida");
		$("#frm_cedula_fechaCaducidad").setValue('');
	}else{
    	console.log('faso-'+fechaCaducidad);
    }
}

// $("#grd_especificos").clear();

$(".pmdynaform-grid-title").removeClass("pmdynaform-grid-title");

//getFieldById("grd_especificos").$el.css("padding-bottom", "150px")

function agregarFila() {

	if ($("#frm_opcionales").getControl().val() == "") {
		$("#grd_especificos").find(".pmdynaform-grid-newitem").hide();
	}
	else {
		$("#grd_especificos").find(".pmdynaform-grid-newitem").show();
	}

}

ocultarOpcionesOcupadas();
agregarFila();//IMPORTANTE Q ESTE DESPUES DE ocultarOpcionesOcupadas() para q oculte el boton agregar fila

$("#frm_opcionales").on('change', function () {
	agregarFila();
});

$("#grd_especificos").onAddRow(function (newArrayRow, gridObject, indexAdd) {

	opcion_value = $("#frm_opcionales").getValue();

	$("#grd_especificos").setValue($("#frm_opcionales").getText(), indexAdd, 1);

	//Ocultar la opcion del combo
	$("#frm_opcionales option[value=" + opcion_value + "]").hide();
	$("#frm_opcionales").setValue("");

	agregarFila();

});

$("#grd_especificos").onDeleteRow(function (oGrid, aRow, rowIndex) {
	// alert(aRow[0][0].getValue());
	opcion_value = $("#frm_opcionales option:contains('" + aRow[0][0].getValue() + "')").val();
	$("#frm_opcionales option[value=" + opcion_value + "]").show();

});


$("#1617442565f930570e60050017939586").setOnSubmit(function () {

	$("#1617442565f930570e60050017939586").saveForm();

});

$("#btn_documentos_save").find("button").on("click", function () {
	$("#1617442565f930570e60050017939586").saveForm();
	alert("Formulario guardado ...");
});



function ocultarOpcionesOcupadas() {

	for (f = 1; f <= $("#grd_especificos").getNumberRows(); f++) {
		opcion_value = jQuery("#grd_especificos").getValue(f, 1);
		if (opcion_value != "") {
			opcion_value = $("#frm_opcionales option:contains('" + opcion_value + "')").val();
			$("#frm_opcionales option[value=" + opcion_value + "]").hide();
		}
	}

	$("#frm_opcionales").setValue("");

}


$("#grd_especificos").hideColumn(2);

