// ── RESET BASE ──────────────────────────────────────────────
$("#dyn_forward").hide();
$("img[src='/images/bulletButton.gif']").hide();
$('.panel').css({"border":"none","box-shadow":"none","margin-bottom":"6px"});
$(".row").css("box-shadow","none");
$(".panel-body").css("padding","0");
$('.pmdynaform-form').css("border","none");
// QUITADO: $(".form-control").css() — causaba border-color y color en todos los campos
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
  
 $("<style id='eq-styles'>" +
  "body, input, select, textarea, button, .form-control, td, th, div, span, label, p { font-family: 'Inter', sans-serif !important; }" +
  "input, select, textarea, .form-control { font-size: 14px !important; }" +
  "h4 { font-size: 15px !important; }" +
  "h5 { font-size: 14px !important; }" +
  ".pmdynaform-grid-title { font-size: 13px !important; }" +
  "[class*='glyphicon'] { font-family: 'Glyphicons Halflings' !important; }" +  // ← ESTO
"</style>").appendTo("head");

  // Estilos via CSS — no toca el atributo style de los campos
  $("<style id='eq-styles'>" +
    "body, input, select, textarea, button, .form-control, td, th, div, span, label, p { font-family: 'Inter', sans-serif !important; }" +
    "input, select, textarea, .form-control { font-size: 14px !important; }" +
    "h4 { font-size: 15px !important; }" +
    "h5 { font-size: 14px !important; }" +
    ".pmdynaform-grid-title { font-size: 13px !important; }" +
  "</style>").appendTo("head");

  $(".textlabel, .control-label, .pmdynaform-label span").each(function(){
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
  this.style.setProperty("background-color","#DFFFCE","important");
  this.style.setProperty("color","#005c50","important");
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


function validarExpresionRegular(id, numeroExpresion) {

    if (numeroExpresion == 4) {
        ponerDecimales(id);
    }

    $("#" + id).focusout(function () {
        validarExpresionRegular_2($(this), numeroExpresion);
    });

    validarExpresionRegular_2($("#" + id), numeroExpresion);
}

function roundToFixed(_float, _digits) {
    var rounder = Math.pow(10, _digits);
    return (Math.round(_float * rounder) / rounder).toFixed(_digits);
}

function limitMaxMin(_float, _max, _min) {
    var parsed = parseFloat(_float);
    if (isNaN(parsed)) {
        return '';
    }
    console.log(parsed);
    if (parsed > _max) {
        console.log(_max, parsed);
        return _max;
    }
    if (parsed < _min) {
        console.log(_min, parsed);
        return _min;
    }
    return parsed;
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

function validarIdentificacion(identificacion, tipoIdentificacion, aux) {

    numero = identificacion;
    var tercerDigito = numero.substring(2, 3);
    var bandera = true;
    if (tipoIdentificacion == 'C') {
        if (numero.length != 10) {
            if (aux) {
                alert("La identificacion no tiene diez digitos");
            }
            identificacion.value = '';
            bandera = false;
            return false;
        }
    } else if (tipoIdentificacion == 'R') {
        //alert('otro');
        if (isNaN(numero)) {
            alert("La identificacion es incorrecta");
        }
        if (numero.length != 13) {
            if (aux) {
                alert("La identificacion no tiene trece digitos");
            }
            identificacion.value = '';
            bandera = false;
            return false;
        }
        if (tercerDigito == 9) {
            digitos = numero.split("");
            totdigitos = 10;
            total = 0;
            digito = (digitos[9] * 1);
            p1 = digitos[0] * 4;
            p2 = digitos[1] * 3;
            p3 = digitos[2] * 2;
            p4 = digitos[3] * 7;
            p5 = digitos[4] * 6;
            p6 = digitos[5] * 5;
            p7 = digitos[6] * 4;
            p8 = digitos[7] * 3;
            p9 = digitos[8] * 2;
            total = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
            residuo = total % 11
            final = residuo == 0 ? 0 : 11 - residuo
            //comprobando codigo verificador
            if (final == digito) {
                //alert("RUC EMPRESA valido");
                bandera = false;
                return true;
            } else {
                if (aux) {
                    alert("RUC EMPRESA no valido");
                }
                identificacion.value = '';
                bandera = false;
            }
        }
    }
    if (bandera) {
        digitos = numero.split("");
        totdigitos = 10;
        total = 0;
        digito = (digitos[9] * 1);
        var i = 0;
        for (i = 0; i < (totdigitos - 1); i++) {
            mult = 0;
            if ((i % 2) != 0) {
                total = total + (digitos[i] * 1);
            } else {
                mult = digitos[i] * 2;
                if (mult > 9)
                    total = total + (mult - 9);
                else
                    total = total + mult;
            }
        }
        //comprobando codigo verificador
        decena = total / 10;
        decena = Math.floor(decena);
        decena = (decena + 1) * 10;
        final = (decena - total);
        if ((final == 10 && digito == 0) || (final == digito)) {
            //alert("Cedula valida");
            return true;
        } else {
            if (tipoIdentificacion == 'P') {
                return true;
            } else {
                if (aux) {
                    alert("Identificacion no valida");
                }
                identificacion.value = '';
                return false;
            }
        }
    }
};

