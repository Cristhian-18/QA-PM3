
$("#btn_consultar").hide();
$("#subtitulo_poliza").hide();
$("#96522713165215257855dc3024232010").hide();

$("#file_poliza_corregido").disableValidation();


$("#subtitle0000000010").show();  
$("#513825951652152578538a3017012620").show();  
$("#frm_borrador_poliza").enableValidation();  

function action(newVal, oldVal) {
  $("#96522713165215257855dc3024232010").hide();  
$("#file_poliza_corregido").disableValidation();  
$("#subtitulo_poliza").hide();  
$("#subtitle0000000010").hide();  
$("#513825951652152578538a3017012620").hide();  
$("#frm_borrador_poliza").disableValidation();  



  console.log(newVal);
  $("#frm_documentos_cotizaciones").disableValidation();  
     if (newVal == 'CONTINUAR'){
        $("#frm_documentos_cotizaciones").enableValidation();
        $("#subtitle0000000010").show();  
        $("#513825951652152578538a3017012620").show();  
        $("#frm_borrador_poliza").enableValidation();  

    } 
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(action);
