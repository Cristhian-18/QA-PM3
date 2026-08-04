$("#repuestos").hide();
let numberRows = $("#grd_valores_siniestros_alcance").getNumberRows();
//
//
$('#frm_alcanceAdicional_valorManoAprobado').disableValidation();
$('#frm_alcanceAdicional_valorRepuestosAprobado').disableValidation();

$('#frm_asegurado_tipo').disableValidation();
$('#frm_conductor_identificacion').disableValidation();
$('#frm_conductor_nombres').disableValidation();
$('#frm_conductor_telefono').disableValidation();
$('#frm_conductor_relacion').disableValidation();
$('#frm_conductor_relacion_otro').disableValidation();

function checkValores(newVal, oldVal) {
    valorSuma = 0;
    valorTotal = 0;
    for (let i = 1; i <= numberRows; i++) {
        if ($("#grd_valores_siniestros_alcance").getValue(i, 11) != "Negado") {
            console.log("Valor", $("#grd_valores_siniestros_alcance").getValue(i, 5));
            valorSuma = valorSuma + parseInt($("#grd_valores_siniestros_alcance").getValue(i, 5));
        }
        valorTotal = valorTotal + parseInt($("#grd_valores_siniestros_alcance").getValue(i, 5));
  
    }
    $valorSuma = roundToFixed(valorSuma, 2);
}

  checkValores($("#grd_valores_siniestros_alcance").getValue(), '');
  $('#grd_valores_siniestros_alcance').change(checkValores);

$('.menu').on('click', function () {
    ocultar_todo();
    console.log(this.id)
    console.log("CAMBIO")
    switch (this.id) {
        case 'solicitud':
            mostrar_solicitud();
            break;
        case 'documentos':
            $("#subt_docs").show();
            $("#418835952652a78d09ec638009652152").show();
            break;
        case 'historial':
            $("#sbt_historial").show();
            $("#200528691652a78b49077a9030935355").show();
            break;
    }
});


function ocultar_todo() {
    $("#sub_busqueda").hide();
    $("#56711039964a8241d124701020566530").hide();
    $("#subt_vehiculo").hide();
    $("#95746246564a4a9c711dfb2023501124").hide();
    $("#subt_asegurado").hide();
    $("#15180521364a5eaf5f02815065887190").hide();
    $("#subt_detalle").hide();
    $("#61446768964a848b295ae19072670821").hide();
    $("#subt_registro").hide();
    $("#22536303964a5e5cc12a673090504456").hide();
    $("#subt_ve_afectados").hide();
    $("#24440509064a84d82d7a6e4090951046").hide();
    $("#isubt_pe_afectados").hide();
    $("#59581944164a84e6bc66f02025995827").hide();
    $("#iisubt_pr_afectados").hide();
    $("#83626962464a84f217fbb30019736581").hide();
    $("#sub_docs").hide();
    $("#24155013164a5edc37a3b68095174528").hide();
    $("#sub_valores").hide();
    $("#79905380564f7ece7bc8989091267394").hide();
    $("#subt_docs").hide();
    $("#418835952652a78d09ec638009652152").hide();
    $("#sbt_historial").hide();
    $("#200528691652a78b49077a9030935355").hide();
    $("#subt_poliza").hide();
    $("#12366487464a4a855bed4c8081629548").hide();
    $("#470410481653944a172eeb1027144131").hide();
    $("#subt_historial_siniestro").hide();
    $("#14870785564a5e392d24239097281950").hide();
    $("#38051173965398bc04c3a10085381199").hide();
    $("#sub_datosFriss").hide();
    $("#88678649164f7eaea023df2027918886").hide();
    $("#sub_alcance").hide();
    $("#4381450096549105c9501e6023494625").hide();
    
    $('#sub_gestionrepuestos').hide()
    $('#3333297516562f070836c34088397701').hide()
    
    
}
function mostrar_solicitud() {
    $("#sub_busqueda").show();
    $("#56711039964a8241d124701020566530").show();
    $("#subt_vehiculo").show();
    $("#95746246564a4a9c711dfb2023501124").show();
    $("#subt_asegurado").show();
    $("#15180521364a5eaf5f02815065887190").show();
    $("#subt_detalle").show();
    $("#61446768964a848b295ae19072670821").show();
    $("#subt_registro").show();
    $("#22536303964a5e5cc12a673090504456").show();
    $("#subt_ve_afectados").show();
    $("#24440509064a84d82d7a6e4090951046").show();
    $("#isubt_pe_afectados").show();
    $("#59581944164a84e6bc66f02025995827").show();
    $("#iisubt_pr_afectados").show();
    $("#83626962464a84f217fbb30019736581").show();
    $("#sub_docs").show();
    $("#24155013164a5edc37a3b68095174528").show();
    $("#sub_valores").show();
    $("#79905380564f7ece7bc8989091267394").show();
    $("#subt_poliza").show();
    $("#12366487464a4a855bed4c8081629548").show();
    $("#470410481653944a172eeb1027144131").show();
    $("#subt_historial_siniestro").show();
    $("#14870785564a5e392d24239097281950").show();
    $("#38051173965398bc04c3a10085381199").show();
    $("#sub_datosFriss").show();
    $("#88678649164f7eaea023df2027918886").show();
    $("#sub_alcance").show();
    $("#4381450096549105c9501e6023494625").show();
    
    if(valorSuma>0){
        $('#sub_gestionrepuestos').show()
      $('#3333297516562f070836c34088397701').show()
      }
}


ocultar_todo();
mostrar_solicitud();