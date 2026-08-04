/**
 * Inicialización de estilos
 */
$('.panel').css("border","none");
$(".row").css("box-shadow", "none");
$(".panel").css("box-shadow", "none");
$('.pmdynaform-form').css("border","none");
$(".form-control").css("box-shadow", "none");
$(".pmdynaform-grid-row").css("border-bottom", "none");
$(".pmdynaform-label-options").css("text-align", "left");
$(".pmdynaform-grid-title").css("display", "none");

// ── RESET BASE ──────────────────────────────────────────────
$("#dyn_forward").hide();
$("img[src='/images/bulletButton.gif']").hide();
$('.panel').css({"border":"none","box-shadow":"none","margin-bottom":"6px"});
$(".row").css("box-shadow","none");
$(".panel-body").css("padding","0");
$('.pmdynaform-form').css("border","none");
$(".pmdynaform-grid-row").css("border-bottom","none");
$(".pmdynaform-label-options").css("text-align","left");

$("<style>" +
  "@font-face { font-family: 'FontAwesome'; " +
  "src: url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.woff2') format('woff2'); " +
  "font-weight: normal; font-style: normal; }" +
"</style>").appendTo("head");

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
  "body, input, select, textarea, button, .form-control, td, th, div:not([class*='fa-']):not([class*='glyphicon']), label, p { font-family: 'Inter', sans-serif !important; }" +
  "span:not([class*='glyphicon']):not([class*='fa']) { font-family: 'Inter', sans-serif !important; }" +
  "i[class*='fa'], div[class*='fa-'] { font-family: 'FontAwesome' !important; }" +
  "i[class*='glyphicon'], span[class*='glyphicon'], div[class*='glyphicon'] { font-family: 'Glyphicons Halflings' !important; }" +
  "input, select, textarea, .form-control { font-size: 14px !important; }" +
  "h4 { font-size: 15px !important; }" +
  "h5 { font-size: 14px !important; }" +
  ".pmdynaform-grid-title { font-size: 13px !important; }" +
 ".pmdynaform-mfile-icon { color: #008E78 !important; font-family: 'FontAwesome' !important; }" +
".pmdynaform-mfile-icon::before { font-family: 'FontAwesome' !important; color: #008E78 !important; }" +
  ".fa-file-pdf-o::before, .pmdynaform-mfile-icon::before { font-family: 'FontAwesome' !important; }" +
"</style>").appendTo("head");
  
var sheet = document.styleSheets[0];
sheet.insertRule(".pmdynaform-mfile-icon::before { font-family: 'FontAwesome' !important; }", sheet.cssRules.length);
sheet.insertRule(".fa::before { font-family: 'FontAwesome' !important; }", sheet.cssRules.length);
sheet.insertRule(".fa-file-pdf-o::before { font-family: 'FontAwesome' !important; }", sheet.cssRules.length);
  
  $(".textlabel, .control-label, .pmdynaform-label span").each(function(){
    var clean = ($(this).attr("style") || "")
      .replace(/font-size\s*:[^;]+;?/gi, "")
      .replace(/font-family\s*:[^;]+;?/gi, "");
    $(this).attr("style", clean + " font-family: 'Inter', sans-serif !important; font-size: 13px !important;");
  });

  $(".pmdynaform-form").css("visibility","visible");
}, 100);

setTimeout(function(){
    $(".pmdynaform-mfile-icon").each(function(){
        var el = $(this);
        el[0].style.setProperty("font-family", "FontAwesome", "important");
        el[0].style.setProperty("color", "#008E78", "important");
    });
    
    setTimeout(function(){
        $("#eq-fa-fix").remove();
        $("<style id='eq-fa-fix'>" +
            ".pmdynaform-mfile-icon::before { font-family: FontAwesome !important; color: #008E78 !important; }" +
            ".fa::before { font-family: FontAwesome !important; }" +
        "</style>").appendTo("body");
    }, 600);

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

$("h5").css("color","#008E78");
$('.textlabel').each(function(){
  this.style.setProperty("color","#555","important");
});
$(".pmdynaform-label-title span").each(function(){
  this.style.setProperty("color","#DFFFCE","important");
});

$(".btn-primary").css({
  "background-color":"#008E78",
  "color":"#ffffff",
  "border-color":"#008E78",
  "border-radius":"7px",
  "font-size":"14px",
  "font-weight":"500",
  "padding":"7px 18px"
});

$(".btn-default").each(function(){
  this.style.setProperty("background-color","#ffffff","important");
  this.style.setProperty("color","#008E78","important");
  this.style.setProperty("border-color","#008E78","important");
  this.style.setProperty("border-radius","7px","important");
  this.style.setProperty("font-size","14px","important");
  this.style.setProperty("font-weight","500","important");
});

$(".btn-uploadfile, .btn-uploadfile-disabled").each(function(){
  this.style.setProperty("background-color","#DFFFCE","important");
  this.style.setProperty("color","#005c50","important");
  this.style.setProperty("border-color","#008E78","important");
  this.style.setProperty("border-radius","7px","important");
  this.style.setProperty("font-size","14px","important");
});

$(".btn-danger").each(function(){
  this.style.setProperty("background-color","#008E78","important");
  this.style.setProperty("color","#ffffff","important");
  this.style.setProperty("border-color","#008E78","important");
  this.style.setProperty("border-radius","7px","important");
});

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

$(".pagination li.active a").each(function(){
  this.style.setProperty("background-color","#008E78","important");
  this.style.setProperty("color","#ffffff","important");
  this.style.setProperty("border-color","#008E78","important");
});

$(".info-box-icon.bg-blue").each(function(){
  this.style.setProperty("background-color","#008E78","important");
});
$(".info-box.box-primary").each(function(){
  this.style.setProperty("border-top-color","#008E78","important");
});

$(".titulo").css({
  "background-color":"#008E78",
  "border-color":"#008E78",
  "color":"#DFFFCE",
  "border-radius":"6px"
});

$(".nav").css("padding-bottom","2px");
$(function(){
	$('.subtitulo').css('cursor','pointer');
	$('.subtitulo').on('click', function(){
		id = this.id;
		subforms = $('#'+this.id).attr('subform').split('|');
		if($('#'+id).children().attr('class') == 'glyphicon glyphicon-plus')
			$('#'+id).children().removeClass('glyphicon-plus').addClass('glyphicon-minus');
		else
			$('#'+id).children().removeClass('glyphicon-minus').addClass('glyphicon-plus');
		$.each(subforms, function(index, subform){
			$('#'+subform).toggle('slow');
		});
	});
});

}, 100); // ← cierra el segundo setTimeout  


$('.menu').on('click', function(){
  ocultar_todo();
  switch(this.id)
      {
    case 'menu1' :
      $("#2103186295d09b1e15c6ea1035176468").show(); // solicitante
      $("#8772332725d09b1b69b4e27050529844").show(); // detalle
      $("#frm_accion").show();
      $("#frm_chk_documento").show();        
      $("#frm_comentario").show();  
      $('#subtit_solicitante').show();  
      $('#subtit_requerimiento').show();        
      $('#subtit_acc').show();        
      $('#btn_continuar').show(); 
      $('#subtit_prov').show();       
      $('#8920896775d37d1cf470856076601548').show();       
      break;
    case 'menu2' :
      $('#5354114765d09b78de33941005151445').show();
     // $('#subtit_historial').show();
      break;
  }
});

function ocultar_todo(){
  // SOLICITUD
  $("#2103186295d09b1e15c6ea1035176468").hide();
  $("#8772332725d09b1b69b4e27050529844").hide();
  $("#frm_accion").hide();
  $("#frm_chk_documento").hide();  
  $("#frm_comentario").hide();  
  $("#subtit_solicitante").hide();  
  $("#subtit_requerimiento").hide();  
  $("#subtit_acc").hide();  
  $("#btn_continuar").hide(); 
  $('#subtit_prov').hide();      
  $('#8920896775d37d1cf470856076601548').hide();
  
  // HISTORIAL
  $("#5354114765d09b78de33941005151445").hide();  
  
}




