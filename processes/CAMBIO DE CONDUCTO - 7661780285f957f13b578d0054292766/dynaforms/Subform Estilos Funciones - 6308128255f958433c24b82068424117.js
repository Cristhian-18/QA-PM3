$("#dyn_forward").hide();
$("img[src='/images/bulletButton.gif']").hide();
$('.panel').css("border","none");
$(".row").css("box-shadow", "none");
$(".panel").css("box-shadow", "none");
$(".panel").css("margin-bottom", "5px");
$(".panel-body").css("padding", "0");
$('.pmdynaform-form').css("border","none");
$(".form-control").css("box-shadow", "none");
$(".pmdynaform-grid-row").css("border-bottom", "none");
$(".pmdynaform-label-options").css("text-align", "left");
$(".pmdynaform-grid-title").css("color", "#e1ffcb");
$(".pmdynaform-field-title").css("margin-bottom", "1px");
$(".pmdynaform-field-title").css("text-align", "center");
$(".nav").css("padding.bottom", "1px");
$(".pmdynaform-field-subtitle h5").css("color", "#000000");
$(".pmdynaform-field-subtitle h5").css("background-color", "#e1ffcb");
$(".pmdynaform-field-subtitle h5").css("border-color", "#e1ffcb");
$(".pmdynaform-field-title h4").css("color", "#e1ffcb");
$(".pmdynaform-field-title h4").css("background-color", "#027361");
$(".pmdynaform-field-title h4").css("border-color", "#027361");

$(".btn-primary:hover").css("background-color", "#027361");
$(".btn-primary:hover").css("color", "#027361");
$(".btn-primary").css("background-color", "#027361");
$(".btn-primary").css("color", "#e1ffcb");

$(".btn-default").css("background-color", "#027361");
$(".btn-default").css("color", "#e1ffcb");
$(".btn-default").css("border-color", "#027361");

$(".btn-default:hover").css("background-color", "#027361 !important");
$(".btn-default:hover").css("color", "#e1ffcb !important");
$(".btn-default:hover").css("border-color", "#027361 !important");

$(".btn-uploadfile:hover").css("background-color", "#027361 !important");
$(".btn-uploadfile:hover").css("color", "#e1ffcb !important");
$(".btn-uploadfile").css("background-color", "#027361 !important");
$(".btn-uploadfile").css("color", "#e1ffcb !important");
$(".btn-uploadfile").css("border-color", "#027361 !important");

$(".btn:hover").css("background-color", "#027361");
$(".btn:hover").css("color", "#027361");
$(".btn").css("background-color", "#027361");
$(".btn").css("color", "#e1ffcb");
$(".btn").css("border-color", "#027361");

$(".ui-dialog-titlebar.ui-widget-header.ui-corner-all.ui-helper-clearfix").css("background-color", "#027361");
$(".ui-dialog-titlebar.ui-widget-header.ui-corner-all.ui-helper-clearfix").css("color", "#e1ffcb");
$(".ui-button").css("background-color", "#027361");
$(".ui-button").css("color", "#e1ffcb");

$(".pmdynaform-grid-title").css("background-color", "#027361");
$(".pmdynaform-grid-title").css("font-size", "12px");
$(".pmdynaform-grid-newitem").css("background-color", "#027361");
$(".pmdynaform-grid-newitem").css("color", "#E1FFCB");
$(".pmdynaform-grid-newitem").css("font-size", "12px");
$(".pmdynaform-grid-newitem").css("border-color", "#027361");

$(".pmdynaform-grid-text-plus").css("color", "#E1FFCB");
$(".pmdynaform-grid-text-plus").css("border-color", "#E1FFCB");

$(".btn-default").css("background-color", "#027361");
$(".btn-default").css("border-color", "#027361");
$(".pmdynaform-grid-text-plus").text("Agregar");

$("h5").css("color", "#027361");

$(".info-box-icon.bg-blue").each(function() {
    this.style.setProperty("background-color", "#027361", "important");
});
$(".info-box.box-primary").each(function() {
    this.style.setProperty("border-top-color", "#027361", "important");
});


$(".btn-uploadfile").each(function() {
    this.style.setProperty("background-color", "#027361", "important");
    this.style.setProperty("color", "#e1ffcb", "important");
    this.style.setProperty("border-color", "#027361", "important");
});

$('.textlabel').each(function() {
    this.style.setProperty("color", "#027361", "important");
});


$('.pmdynaform-grid-newitem').each(function() {
    this.style.setProperty("color", "#e1ffcb", "important");
    this.style.setProperty("background-color", "#027361", "important");
    this.style.setProperty("border-color", "#027361", "important");
});


$(".titulo").css("background-color", "#027361");
$(".titulo").css("border-color", "#027361");
$(".titulo").css("color", "#e1ffcb");

$(".pmdynaform-label-title span").each(function() {
    this.style.setProperty("color", "#e1ffcb", "important");
});

$( function(){
	$('.subtitulo').css( 'cursor', 'pointer' );
	
	$('.subtitulo').on('click', function(){
		id = this.id;
		subforms = $('#'+this.id).attr('subform').split('|');
		if( $('#'+id).children().attr('class') == 'glyphicon glyphicon-plus')
		$('#'+id).children().removeClass('glyphicon-plus').addClass('glyphicon-minus');
		else
		$('#'+id).children().removeClass('glyphicon-minus').addClass('glyphicon-plus');
		$.each( subforms , function( index, subform ) {
			$('#'+subform).toggle('slow');
		});
	});
	
	
})

function validarExpresionRegular(id, numeroExpresion){
	
	if(numeroExpresion == 4){
		ponerDecimales(id);
	}
	
	$("#" + id).focusout( function () {
		validarExpresionRegular_2($(this), numeroExpresion);
	}); 	
	
	validarExpresionRegular_2($("#" + id), numeroExpresion);
} 

function validarExpresionRegular_2(id, numeroExpresion){
	var expresion_regular = $("#expresion_regular_" + numeroExpresion).getValue();
	//alert(expresion_regular);
	var texto = $(id).getValue().toString().trim();
	//alert(texto);
	
	//alert(texto.match(expresion_regular) + " - " + texto.length);
	
	if (texto.match(expresion_regular) || texto.length == 0){
		$(id).parent().find( ".textlabel" ).css( "color", "" );
		$(id).getControl().css("borderColor", "");
		}else {
		$(id).parent().find( ".textlabel" ).css( "color", "#a94442" );
		$(id).getControl().css("borderColor", "#e4655f");
	}	
}

function ponerDecimales(id){
	
	var identificador = $('#' + id);
	var valor = identificador.getValue().toString().trim();
	
	if(valor == ''){
		identificador.setValue("");
		return;
	}  
	
	if(typeof valor.split(".")[1] === 'undefined'){
		identificador.setValue(valor + ".00");
		}else if(valor.split(".")[1].length == 0){
		identificador.setValue(valor + "00");
		}else if(valor.split(".")[1].length == 1){
		identificador.setValue(valor + "0");
	}
	
}

function canton_2(bandera, idProvincia, idCanton){
	
	var str = $('#frm_canton_auxiliar').getValue() + "";//El espacio vacio es para q se convierta a string
	var vector = str.split(",");	
	
	$("#" + idCanton).find("option").hide();
	$("#" + idCanton).find("option[value='']").show();	
	if(bandera){
		$('#' + idCanton).setValue('');	
	}
	
	var comboUno = $('#'+idProvincia).getControl().val();
	
	if(comboUno == ''){
		$('#' + idCanton).getControl().attr('disabled',true);
		}else if(comboUno != ""){
		$('#' + idCanton).getControl().attr('disabled',false);
		for (i = 0; i < (vector.length/2); i++) {
			if(vector[i*2] == comboUno){
				$("#" + idCanton).find("option[value=" + vector[i*2 + 1] +"]").show();
			}
		}
	}	
	
}



//validar campos vacios
$("#validacionesCampos").hide();

function showConfirmDlg() {

	/*if($("form").prop("id") == "9653957035e829ed50c2e51034344533"){
		return;
	}*/
	
	var bandera = true;
	var c = '';
    var count = 0;
	var noCumplioValidacion;
	var noCumplioValidacionProcess;
	var stringHtml = "";
	
	$("div.pmdynaform-edit-radio, div.pmdynaform-edit-text, div.pmdynaform-edit-dropdown, div.pmdynaform-edit-datetime, pmdynaform-edit-dropdown").each(function(index) {
//      $("div.pmdynaform-edit-datetime").each(function(index) {
	
		if($(this).getControl().toString() == ""){//para q ingnore los campos de grillas
			return;
		}	
		
		if(typeof $(this).find(".pmdynaform-message-error").html() !== 'undefined'){
			noCumplioValidacionProcess = true;
		}else{
			noCumplioValidacionProcess = false;
		}
		
		if($(this).prop("class").indexOf("pmdynaform-edit-radio") < 0){
			stringHtml = $(this).getControl().attr("style").toString();//attr da error cuando el campo es radio
	  //    	alert(($(this).toString()));
      	}
		
		if(stringHtml.indexOf("border-color") > 0 || stringHtml.indexOf("color") > 0){
			noCumplioValidacion = true;
    
		}else{
			noCumplioValidacion = false;
    
		}	
        
        //if($(this).find(".pmdynaform-field-required").html() == '*')){
          
		
		deshabilitadaValidacion = $(this).find(".pmdynaform-field-required").attr("style") != "display: none;" ? true : false;
		
		if((deshabilitadaValidacion && $(this).find(".pmdynaform-field-required").html() == '*') || noCumplioValidacion || noCumplioValidacionProcess){
			if($(this).getValue().trim().length == 0 || noCumplioValidacion || noCumplioValidacionProcess){
				count++;
				c += count + ") " + $(this).getLabel() + "<br>";
				bandera = false;
			}		
		}
		
	});  

	$("#validacionesCampos").html(c); 
	
	var dlgContents = {
		modal:     true,
		resizable: false,
		buttons: {
			"Ok": function() {
				$(this).dialog("close");
				callback(true);
			}
		}
	}
	
	if(count > 0){
		$("#validacionesCampos").dialog(dlgContents);
	}
	return bandera;
}
function validarIdentificacion(identificacion, tipoIdentificacion, aux) {
	return identificacionValidez(identificacion, tipoIdentificacion, aux);
}

function gridIdentificacionRepetida(nombre_grilla, columna){
	
	var bandera = true;
	
	var filas = $("#" + nombre_grilla).getNumberRows();
	var arr = new Array(0);
	
	// Verificar si hay repetidos
    for (f = 1; f <= filas; f++) {	
		var identificacion = $("#" + nombre_grilla).getValue(f, columna).trim();
		
		if(identificacion != "" && arr.indexOf(identificacion) >= 0){
			bandera = false;
		}		
		
		arr.push(identificacion);
	}
	
	//Colorear bordes
    for (f = 1; f <= filas; f++) {	
        if (bandera == false) {
			$("#" + nombre_grilla).getControl(f, columna).css("borderColor", "red");
        }else{
			stringHtml = $("#" + nombre_grilla).getControl(f, columna).attr("style").toString();
			if(stringHtml.indexOf("border-color") < 0 || stringHtml.indexOf("color") < 0){
				$("#" + nombre_grilla).getControl(f, columna).css("borderColor", "");
			}
		}
	}	
	
	return bandera;
	
}

function identificacionAlgoritmo(identificacion, tipoValidacion) {
	
    digitos = identificacion.split("");
    total = 0;
// alert(tipoValidacion + " - " + identificacion);
    //Personas naturales ecuatorianos y extranjeros residentes
    if (tipoValidacion == "cedula") {

        modulo = 10;
        digitoVerificador = digitos[9] * 1;

        digitos[0] *= 2;
        digitos[1] *= 1;
        digitos[2] *= 2;
        digitos[3] *= 1;
        digitos[4] *= 2;
        digitos[5] *= 1;
        digitos[6] *= 2;
        digitos[7] *= 1;
        digitos[8] *= 2;

    }
    //Sociedades públicas
    else if (tipoValidacion == "rucPublicas") {

        modulo = 11;
        digitoVerificador = digitos[8] * 1;

        digitos[0] *= 3;
        digitos[1] *= 2;
        digitos[2] *= 7;
        digitos[3] *= 6;
        digitos[4] *= 5;
        digitos[5] *= 4;
        digitos[6] *= 3;
        digitos[7] *= 2;
        digitos[8] *= 0;//El noveno digito no se ocupa en el algoritmo por eso le multiplico por cero

    }
    //Sociedades privadas y extranjeros no residentes (sin cédula de identidad)
    else if (tipoValidacion == "rucPrivadas") {

        modulo = 11;
        digitoVerificador = digitos[9] * 1;

        digitos[0] *= 4;
        digitos[1] *= 3;
        digitos[2] *= 2;
        digitos[3] *= 7;
        digitos[4] *= 6;
        digitos[5] *= 5;
        digitos[6] *= 4;
        digitos[7] *= 3;
        digitos[8] *= 2;
    }

    //si es mayor a 9 sumo entre digitos
    for (g = 0; g <= 8; g++) {

		if (tipoValidacion == "cedula") {
			tempo = digitos[g] + "";
			if (tempo * 1 > 9) {
				digitos[g] = tempo.charAt(0) * 1 + tempo.charAt(1) * 1;
			}
		}
        total += digitos[g] * 1;
    }
	
    residuo = total % modulo;
    // alert(total + " - " + residuo + " - " + digitoVerificador);
	
	if(residuo == 0 && residuo == digitoVerificador){
		return true;
    }else if (modulo - residuo == digitoVerificador) {
        return true;
    } else {
        return false;
    }	
	
	return true;
}

function identificacionValidez(identificacion, tipoIdentificacion, aux) {

    var bandera = true;
    var tipo = { C: "CEDULA", R: "RUC", P: "PASAPORTE" };

    if (identificacion.length == 0 || typeof tipo[tipoIdentificacion] === 'undefined') {
        return false;
    }

    /////////////////
    //Cedula
    //Personas naturales ecuatorianos y extranjeros residentes
    /////////////////
    if (tipoIdentificacion == 'C') {

        if (/^\d+$/.test(identificacion) == false) {
            if (aux) {
                alert(tipo["C"] + " : solo se permite digitos");
            }
            return false;
        } else if (/^\d{10}$/.test(identificacion) == false) {
            if (aux) {
                alert(tipo["C"] + " : debe tener 10 digitos");
            }
            return false;
        } else if ((identificacion.substr(0, 2) * 1 < 1 || identificacion.substr(0, 2) * 1 > 24) && identificacion.substr(0, 2) * 1 != 30) {
            if (aux) {
                // alert(tipo["C"] + " : Dos primeros dígitos comprenden el rango entre (01 - 24) y 30");
                alert(tipo["C"] + " : incorrecta");
            }
            return false;
        } else {
            bandera = identificacionAlgoritmo(identificacion, "cedula");
			if (aux && bandera == false) {
				alert(tipo["C"] + " : incorrecta");
			}				
        }
		
    }

    /////////////////
    //RUC
    /////////////////
    if (tipoIdentificacion == 'R') {

        if (/^\d+$/.test(identificacion) == false) {
            if (aux) {
                alert(tipo["R"] + " : solo se permite digitos");
            }
            return false;
        } else if (/^\d{13}$/.test(identificacion) == false) {
            if (aux) {
                alert(tipo["R"] + " : debe tener 13 digitos");
            }
            return false;
        } else if ((identificacion.substr(0, 2) * 1 < 1 || identificacion.substr(0, 2) * 1 > 24) && identificacion.substr(0, 2) * 1 != 30) {
            if (aux) {
                // alert(tipo["R"] + " : Dos primeros dígitos comprenden el rango entre (01 - 24) y 30");
				alert(tipo["R"] + " : incorrecto");
            }
            return false;
        } else if (identificacion.charAt(2) * 1 > 6 && identificacion.charAt(2) * 1 != 9) {
			// Personas naturales ecuatorianos y extranjeros residentes: ( 0,1,2,3,4,5 )
            // Sociedades públicas:	6
            // Sociedades privadas y extranjeros no residentes (sin cédula de identidad):	9
			
            if (aux) {
                // alert(tipo["R"] + " : El tercer digito debe ser ( 0,1,2,3,4,5,6,9 )");
				alert(tipo["R"] + " : incorrecto");
            }
            return false;

        } else if (identificacion.charAt(2) * 1 <= 5) {
			ci = identificacion.slice(0, -3); 
			// alert(ci);
            bandera = identificacionAlgoritmo(ci, "cedula");

        } else if (identificacion.charAt(2) * 1 == 6) {

            bandera = identificacionAlgoritmo(identificacion, "rucPublicas");

        } else if (identificacion.charAt(2) * 1 == 9) {

            bandera = identificacionAlgoritmo(identificacion, "rucPrivadas");

        }

		if (aux && bandera == false) {
			alert(tipo["R"] + " : incorrecto");
		}		
    }

    /////////////////
    //PASAPORTE
    /////////////////
    if (tipoIdentificacion == 'P') {

        if (/^[a-zA-Z0-9_-]*$/.test(identificacion) == false) {
            if (aux) {
                alert(tipo["P"] + " : Caracteres incorrectos");
            }
            return false;
        }else if (identificacion.length > 30) {
			if (aux) {
				alert(tipo["P"] + " : incorrecto maximo 30 caracteres");
			}
            return false;
        }

    }

    return bandera;

}






