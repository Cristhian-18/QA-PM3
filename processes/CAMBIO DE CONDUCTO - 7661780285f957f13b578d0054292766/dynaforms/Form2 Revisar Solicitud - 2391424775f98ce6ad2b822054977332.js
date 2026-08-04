//$('#3035922845f99c52413aef2053437437').toggle();
//$('#6238792205f95844f06bfb2011814992').toggle();

// •	Cuando Cobro anticipado sea “SI” no se deberá desplegar bloque de datos Cobro Primera Cuota
// •	Cuando Cobro anticipado sea “NO” se deberá desplegar bloque de datos Cobro Primera Cuota

var sw = $("#frm_recibio_deposito").getValue();
//alert (sw);

if (sw == 'S') {
    $('#frm_sbt_debito_primera_cuota').hide();
    $('#6238792205f95844f06bfb2011814992').hide();

    $('#frm_primera_cuota_medio_pago').disableValidation();
    $('#frm_primera_cuota_modalidad').disableValidation();
    $('#frm_primera_cuota_plan').disableValidation();
    $('#frm_primera_cuota_total_primer_pago').disableValidation();
    $('#frm_primera_cuota_descuento').disableValidation();
    $('#frm_primera_cuota_total_pagar').disableValidation();
}

$("#2391424775f98ce6ad2b822054977332").setOnSubmit(function () {
    $("#2391424775f98ce6ad2b822054977332").saveForm();
    return showConfirmDlg();
});

$("#btn_financiera_save").find("button").on("click", function () {
    $("#2391424775f98ce6ad2b822054977332").saveForm();
    alert("Formulario guardado ...");
});

function mensaje(){
   if($("#tri_mes_grbar").getValue() != ''){
    window.dynaform.flashMessage( {
       duration : 8000,
       emphasisMessage: "WARNING: ",
       message:$("#tri_mes_grbar").getValue(),
       type : 'warning',
       appendTo:$('#tit_autorizacion')
    } )
  }
}

mensaje();
