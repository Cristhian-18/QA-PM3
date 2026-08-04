// ── RESET BASE ──────────────────────────────────────────────
$("#dyn_forward").hide();
$("img[src='/images/bulletButton.gif']").hide();
$('.panel').css({"border":"none","box-shadow":"none","margin-bottom":"6px"});
$(".row").css("box-shadow","none");
$(".panel-body").css("padding","0");
$('.pmdynaform-form').css("border","none");
// QUITADO: $(".form-control").css() — causaba border-color en todos los campos
$(".pmdynaform-grid-row").css("border-bottom","none");
$(".pmdynaform-label-options").css("text-align","left");

// ── TIPOGRAFÍA INTER ─────────────────────────────────────────
$(".pmdynaform-form").css("visibility","hidden");

setTimeout(function(){

  if(!$("#inter-font").length){
    $("<link>", {
      id: "inter-font",
      rel: "stylesheet",
      href: "https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap"
    }).appendTo("head");
  }

  if(!$("#glyphicons-cdn").length){
    $("<link>", {
      id: "glyphicons-cdn",
      rel: "stylesheet",
      href: "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/3.4.1/css/bootstrap.min.css"
    }).appendTo("head");
  }

  // Estilos via CSS — no toca el atributo style de los campos
  $("<style id='eq-styles'>" +
    "body, input, select, textarea, button, .form-control, td, th, div, label, p { font-family: 'Inter', sans-serif !important; }" +
    "span:not(.glyphicon):not([class*='ion-']):not([class*='fa-']) { font-family: 'Inter', sans-serif !important; }" +
    ".glyphicon { font-family: 'Glyphicons Halflings' !important; }" +
    "input, select, textarea, .form-control { font-size: 14px !important; }" +
    "h4 { font-size: 15px !important; }" +
    "h5 { font-size: 14px !important; }" +
    ".pmdynaform-grid-title { font-size: 13px !important; }" +
  "</style>").appendTo("head");

  $(".textlabel, .control-label, .pmdynaform-label span:not(.glyphicon)").each(function(){
    var clean = ($(this).attr("style") || "")
      .replace(/font-size\s*:[^;]+;?/gi, "")
      .replace(/font-family\s*:[^;]+;?/gi, "");
    $(this).attr("style", clean + " font-family: 'Inter', sans-serif !important; font-size: 13px !important;");
  });

  $(".pmdynaform-form").css("visibility","visible");

}, 100);

// ── TÍTULO PRINCIPAL ─────────────────────────────────────────
$(".pmdynaform-field-title h4").css({
  "background-color":"#008E78",
  "color":"#DFFFCE",
  "border-color":"#008E78",
  "border-radius":"6px 6px 0 0",
  "text-align":"center",
  "padding":"10px 16px",
  "font-size":"15px",
  "font-weight":"600",
  "letter-spacing":"0.4px"
});
$(".pmdynaform-field-title").css({"margin-bottom":"0","text-align":"center"});

// ── SUBTÍTULOS DE SECCIÓN ────────────────────────────────────
$(".pmdynaform-field-subtitle h5").css({
  "background-color":"#f0fdf9",
  "color":"#005c50",
  "border-left":"3px solid #008E78",
  "border-top":"none",
  "border-right":"none",
  "border-bottom":"none",
  "border-radius":"0 6px 6px 0",
  "padding":"7px 14px",
  "font-size":"14px",
  "font-weight":"600",
  "margin":"10px 0 6px 0"
});

// ── ETIQUETAS ────────────────────────────────────────────────
$("h5").css("color","#008E78");
$('.textlabel').each(function(){
  this.style.setProperty("color","#555","important");
});
$(".pmdynaform-label-title span").each(function(){
  this.style.setProperty("color","#DFFFCE","important");
});

// ── BOTONES PRIMARIOS ────────────────────────────────────────
$(".btn-primary").css({
  "background-color":"#008E78",
  "color":"#ffffff",
  "border-color":"#008E78",
  "border-radius":"7px",
  "font-size":"14px",
  "font-weight":"500",
  "padding":"7px 18px"
});

// ── BOTONES DEFAULT ──────────────────────────────────────────
$(".btn-default").each(function(){
  this.style.setProperty("background-color","#ffffff","important");
  this.style.setProperty("color","#008E78","important");
  this.style.setProperty("border-color","#008E78","important");
  this.style.setProperty("border-radius","7px","important");
  this.style.setProperty("font-size","14px","important");
  this.style.setProperty("font-weight","500","important");
});

// ── BOTONES UPLOAD ───────────────────────────────────────────
$(".btn-uploadfile, .btn-uploadfile-disabled").each(function(){
  this.style.setProperty("background-color","#008E78","important");
  this.style.setProperty("color","#ffffff","important");
  this.style.setProperty("border-color","#008E78","important");
  this.style.setProperty("border-radius","7px","important");
  this.style.setProperty("font-size","14px","important");
});

// ── BOTÓN DANGER ────────────────────────────────────────────
$(".btn-danger").each(function(){
  this.style.setProperty("background-color","#008E78","important");
  this.style.setProperty("color","#ffffff","important");
  this.style.setProperty("border-color","#008E78","important");
  this.style.setProperty("border-radius","7px","important");
});

// ── GRILLA / TABLA ───────────────────────────────────────────
$(".pmdynaform-grid-title").css({
  "background-color":"#008E78",
  "color":"#DFFFCE",
  "border-radius":"6px 6px 0 0"
});
$(".pmdynaform-grid-newitem").each(function(){
  this.style.setProperty("background-color","#DFFFCE","important");
  this.style.setProperty("color","#005c50","important");
  this.style.setProperty("border-color","#008E78","important");
  this.style.setProperty("font-size","13px","important");
});
$(".pmdynaform-grid-text-plus").css({"color":"#005c50","border-color":"#008E78"});
$(".pmdynaform-grid-text-plus").text("+ Agregar");

// ── PAGINADOR ────────────────────────────────────────────────
$(".pagination li.active a").each(function(){
  this.style.setProperty("background-color","#008E78","important");
  this.style.setProperty("color","#ffffff","important");
  this.style.setProperty("border-color","#008E78","important");
});

// ── INFO BOX ─────────────────────────────────────────────────
$(".info-box-icon.bg-blue").each(function(){
  this.style.setProperty("background-color","#008E78","important");
});
$(".info-box.box-primary").each(function(){
  this.style.setProperty("border-top-color","#008E78","important");
});

 
// ── TÍTULO PERSONALIZADO ─────────────────────────────────────
$(".titulo").css({
  "background-color":"#008E78",
  "border-color":"#008E78",
  "color":"#DFFFCE",
  "border-radius":"6px"
});

// ── NAV ──────────────────────────────────────────────────────
$(".nav").css("padding-bottom","2px");

$("#1852090325ec434cca75924044427744").hide();


$(function () {
    $('.subtitulo').css('cursor', 'pointer');

    $('.subtitulo').on('click', function () {
        id = this.id;
        subforms = $('#' + this.id).attr('subform').split('|');
        if ($('#' + id).children().attr('class') == 'glyphicon glyphicon-plus')
            $('#' + id).children().removeClass('glyphicon-plus').addClass('glyphicon-minus');
        else
            $('#' + id).children().removeClass('glyphicon-minus').addClass('glyphicon-plus');
        $.each(subforms, function (index, subform) {
            $('#' + subform).toggle('slow');
        });
    });


})

function validarExpresionRegular(id, numeroExpresion) {

    if (numeroExpresion == 4) {
        formatMoney(id);
    }

    $("#" + id).focusout(function () {
        validarExpresionRegular_2($(this), numeroExpresion);
    });

    validarExpresionRegular_2($("#" + id), numeroExpresion);
}

function validarExpresionRegular_2(id, numeroExpresion) {
    var expresion_regular = $("#expresion_regular_" + numeroExpresion).getValue();
    //alert(expresion_regular);
    var texto = $(id).getValue().toString().trim();
    //alert(texto);

    //alert(texto.match(expresion_regular) + " - " + texto.length);

    if (texto.match(expresion_regular) || texto.length == 0) {
        $(id).parent().find(".textlabel").css("color", "");
        $(id).getControl().css("borderColor", "");
    } else {
        $(id).parent().find(".textlabel").css("color", "#a94442");
        $(id).getControl().css("borderColor", "#e4655f");
    }
}

function ponerDecimales(id) {

    var identificador = $('#' + id);
    var valor = identificador.getValue().toString().trim();

    if (valor == '') {
        identificador.setValue("");
        return;
    }

    if (typeof valor.split(".")[1] === 'undefined') {
        identificador.setValue(valor + ".00");
    } else if (valor.split(".")[1].length == 0) {
        identificador.setValue(valor + "00");
    } else if (valor.split(".")[1].length == 1) {
        identificador.setValue(valor + "0");
    }

}

function formatMoney(id, decimalCount = 2, decimal = ".", thousands = ",") {
  try {
    var identificador = $('#' + id);
    var amount = identificador.getValue().toString().trim();
    
    console.log(amount)
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    let valor = negativeSign +
      (j ? i.substr(0, j) + thousands : '') +
      i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) +
      (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    	identificador.setValue(valor);
  } catch (e) {
    identificador.setValue("");
    console.log(e)
  }
}

function canton_2(bandera, idProvincia, idCanton) {

    var str = $('#frm_canton_auxiliar').getValue() + "";//El espacio vacio es para q se convierta a string
    var vector = str.split(",");

    $("#" + idCanton).find("option").hide();
    $("#" + idCanton).find("option[value='']").show();
    if (bandera) {
        $('#' + idCanton).setValue('');
    }

    var comboUno = $('#' + idProvincia).getControl().val();

    if (comboUno == '') {
        $('#' + idCanton).getControl().attr('disabled', true);
    } else if (comboUno != "") {
        $('#' + idCanton).getControl().attr('disabled', false);
        for (i = 0; i < (vector.length / 2); i++) {
            if (vector[i * 2] == comboUno) {
                $("#" + idCanton).find("option[value=" + vector[i * 2 + 1] + "]").show();
            }
        }
    }

}



//validar campos vacios
$("#validacionesCampos").hide();

function showConfirmDlg() {

    if ($("form").prop("id") == "9653957035e829ed50c2e51034344533") {
        return;
    }

    var bandera = true;
    var c = '';
    var count = 0;
    var noCumplioValidacion;
    var noCumplioValidacionProcess;
    var stringHtml = "";

    $("div.pmdynaform-edit-radio, div.pmdynaform-edit-text, div.pmdynaform-edit-dropdown, div.pmdynaform-edit-datetime, pmdynaform-edit-dropdown").each(function (index) {
        //      $("div.pmdynaform-edit-datetime").each(function(index) {

        if ($(this).getControl().toString() == "") {//para q ingnore los campos de grillas
            return;
        }

        if (typeof $(this).find(".pmdynaform-message-error").html() !== 'undefined') {
            noCumplioValidacionProcess = true;
        } else {
            noCumplioValidacionProcess = false;
        }

        if ($(this).prop("class").indexOf("pmdynaform-edit-radio") < 0) {
            stringHtml = $(this).getControl().attr("style").toString();//attr da error cuando el campo es radio
            //    	alert(($(this).toString()));
        }

        if (stringHtml.indexOf("border-color") > 0 || stringHtml.indexOf("color") > 0) {
            noCumplioValidacion = true;

        } else {
            noCumplioValidacion = false;

        }

        //if($(this).find(".pmdynaform-field-required").html() == '*')){


        deshabilitadaValidacion = $(this).find(".pmdynaform-field-required").attr("style") != "display: none;" ? true : false;

        if ((deshabilitadaValidacion && $(this).find(".pmdynaform-field-required").html() == '*') || noCumplioValidacion || noCumplioValidacionProcess) {
            if ($(this).getValue().trim().length == 0 || noCumplioValidacion || noCumplioValidacionProcess) {
                count++;
                c += count + ") " + $(this).getLabel() + "<br>";
                bandera = false;
            }
        }

    });

    $("#validacionesCampos").html(c);

    var dlgContents = {
        modal: true,
        resizable: false,
        buttons: {
            "Ok": function () {
                $(this).dialog("close");
                callback(true);
            }
        }
    }

    if (count > 0) {
        $("#validacionesCampos").dialog(dlgContents);
    }
    return bandera;
}

function validarIdentificacion(identificacion, tipoIdentificacion, aux) {
	console.log(identificacion + " - " + tipoIdentificacion + " - " + aux);
    return identificacionValidez(identificacion, tipoIdentificacion, aux);
}

function gridIdentificacionRepetida(nombre_grilla, columna) {

    var bandera = true;

    var filas = $("#" + nombre_grilla).getNumberRows();
    var arr = new Array(0);

    // Verificar si hay repetidos
    for (f = 1; f <= filas; f++) {
        var identificacion = $("#" + nombre_grilla).getValue(f, columna).trim();
        identificacion = identificacion.toUpperCase();

        if (identificacion != "" && arr.indexOf(identificacion) >= 0) {
            bandera = false;
        }

        arr.push(identificacion);
    }

    //Colorear bordes
    for (f = 1; f <= filas; f++) {
        if (bandera == false) {
            $("#" + nombre_grilla).getControl(f, columna).css("borderColor", "red");
        } else {
            stringHtml = $("#" + nombre_grilla).getControl(f, columna).attr("style");
            if (typeof stringHtml !== 'undefined') {
                stringHtml = stringHtml.toString();

                if (stringHtml.indexOf("border-color") < 0 || stringHtml.indexOf("color") < 0) {
                    $("#" + nombre_grilla).getControl(f, columna).css("borderColor", "");
                }
            }
        }
    }

    return bandera;

}

function identificacionAlgoritmo(identificacion, tipoValidacion) {
  		//TODO
  		if(identificacion=='1793189541001'||identificacion=='0993391059001'||
           identificacion=='1793207598001'){
         return true;
     }

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
    //Sociedades publicas
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
    //Sociedades privadas y extranjeros no residentes (sin cedula de identidad)
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
	var resta = modulo - residuo;
	
	//console.log(total + " - " + residuo + " - " + digitoVerificador+ " - " + resta);
	//solo por un RUC
	/*if(modulo = 11){
		resta = resta + 3;
	}*/
	
    if (residuo == 0 && residuo == digitoVerificador) {
        return true;
    } else if (resta == digitoVerificador) {
        return true;
    } else {
        return false;
    }

    return true;
}

function identificacionValidez(identificacion, tipoIdentificacion, aux) {
	
	console.log(identificacion + " - " + tipoIdentificacion + " - " + aux);
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
                // alert(tipo["C"] + " : Dos primeros digitos comprenden el rango entre (01 - 24) y 30");
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

        //Quitar luego
        if(identificacion=='1793204134001'){
            return true;
        }

        if (/^\d+$/.test(identificacion) == false) {
            if (aux) {
                alert(tipo["R"] + " : solo se permite digitos");
				console.log(tipo["R"] + " : solo se permite digitos");
            }
            return false;
        } else if (/^\d{13}$/.test(identificacion) == false) {
            if (aux) {
                alert(tipo["R"] + " : debe tener 13 digitos");
				console.log(tipo["R"] + " : debe tener 13 digitos");
            }
            return false;
        } else if ((identificacion.substr(0, 2) * 1 < 1 || identificacion.substr(0, 2) * 1 > 24) && identificacion.substr(0, 2) * 1 != 30) {
            if (aux) {
                // alert(tipo["R"] + " : Dos primeros digitos comprenden el rango entre (01 - 24) y 30");
                alert(tipo["R"] + " : incorrecto");
            }
            return false;
        } else if (identificacion.charAt(2) * 1 > 6 && identificacion.charAt(2) * 1 != 9) {
            // Personas naturales ecuatorianos y extranjeros residentes: ( 0,1,2,3,4,5 )
            // Sociedades plicas:	6
            // Sociedades privadas y extranjeros no residentes (sin cedula de identidad):	9

            if (aux) {
                // alert(tipo["R"] + " : El tercer digito debe ser ( 0,1,2,3,4,5,6,9 )");
                alert(tipo["R"] + " : incorrecto");
				console.log(tipo["R"] + " : incorrecto");
            }
            return false;

        } else if (identificacion.charAt(2) * 1 <= 5) {
            ci = identificacion.slice(0, -3);
            console.log(ci);
            bandera = identificacionAlgoritmo(ci, "cedula");

        } else if (identificacion.charAt(2) * 1 == 6) {

            bandera = identificacionAlgoritmo(identificacion, "rucPublicas");
			console.log("rucPublicas");

        } else if (identificacion.charAt(2) * 1 == 9) {

            bandera = identificacionAlgoritmo(identificacion, "rucPrivadas");
			console.log("rucPrivadas");
        }

        if (aux && bandera == false) {
            alert(tipo["R"] + " : incorrecto");
			console.log(tipo["R"] + " : incorrecto");
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
        } else if (identificacion.length > 30) {
            if (aux) {
                alert(tipo["P"] + " : incorrecto maximo 30 caracteres");
            }
            return false;
        }

    }

    //console.log(bandera);
	return bandera;

}


//validarIdentificacion('1793132499001','R',true);

function validarTarjetas(tipotarjeta, numero) {
    switch (tipotarjeta) {
        case "4":	//VISA
            if (!numero.match(/^4[0-9]{12}(?:[0-9]{3})?$/)) {
                return false;
            }
            else {
                return true;
            }
            break;
        case "8":	//AMEX
            if (!numero.match(/^3[47][0-9]{13}$/)) {
                return false;
            }
            else {
                return true;
            }
            break;
        case "3":	//DINERS
            if (!numero.match(/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/)) {
                return false;
            }
            else {
                return true;
            }
            break;

        case "5":	//MASTERCARD
            if (!numero.match(/5[1-5][0-9]{14}$/)) {
                return false;
            }
            else {
                return true;
            }
            break;
        case "2":	//MASTERCARDTITANIUM
            if (!numero.match(/2[0-9]{15}$/)) {
                return false;
            }
            else {
                return true;
            }
            break;
        case "6":	//DISCOVER
            if (!numero.match(/^6(?:011|5[0-9]{2})[0-9]{12}$/)) {
                return false;
            }
            else {
                return true;
            }
            break;
    }
}

function calcular_edad(fechaNacimiento) {
    //Split de las fecha recibida para separarla
    var x = fechaNacimiento.split("-");
    var dia = x[2];
    var mes = x[1];
    var ano = x[0];

    fecha_hoy = new Date();
    ahora_ano = fecha_hoy.getYear();
    ahora_mes = fecha_hoy.getMonth();
    ahora_dia = fecha_hoy.getDate();
    edad = (ahora_ano + 1900) - ano;

    if (ahora_mes < (mes - 1)) {
        edad--;
    }
    if (((mes - 1) == ahora_mes) && (ahora_dia < dia)) {
        edad--;
    }
    if (edad > 1900) {
        edad -= 1900;
    }

    return edad;
}



