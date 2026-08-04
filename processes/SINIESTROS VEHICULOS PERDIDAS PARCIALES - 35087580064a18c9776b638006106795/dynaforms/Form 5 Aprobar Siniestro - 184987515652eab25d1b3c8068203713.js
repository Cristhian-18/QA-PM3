 $("#frm_conductor_identificacion").disableValidation();
        $("#frm_conductor_telefono").disableValidation();
        $("#frm_conductor_nombres").disableValidation();
        $("#frm_conductor_relacion").disableValidation();
$("#repuestos").hide();
$("#frm_asegurado_tipo").disableValidation();

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
    $("#aub_friss").hide();
    $("#88678649164f7eaea023df2027918886").hide();



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
    $("#aub_friss").show();
    $("#88678649164f7eaea023df2027918886").show();

}

let vehiculos = $("#frm_siniestro_OtrosVehiculos").getValue();
let propiedades = $("#frm_siniestro_Propiedad").getValue();
let personas = $("#frm_siniestro_Personas").getValue();

$("#isubt_pe_afectados").hide();
$("#59581944164a84e6bc66f02025995827").hide();
$("#subt_ve_afectados").hide();
$("#24440509064a84d82d7a6e4090951046").hide();
$("#iisubt_pr_afectados").hide();
$("#83626962464a84f217fbb30019736581").hide();

if (vehiculos == 'SI') {
    $("#subt_ve_afectados").show();
    $("#24440509064a84d82d7a6e4090951046").show();
}
if (propiedades == 'SI') {
    $("#iisubt_pr_afectados").show();
    $("#83626962464a84f217fbb30019736581").show();
}
if (personas == 'SI') {
    $("#isubt_pe_afectados").show();
    $("#59581944164a84e6bc66f02025995827").show();
}

function checkAccion(newVal, oldVal) {
    if (newVal == 'AJUSTAR') {
        $("#frm_valoresAprobados_manoObraProformada").disableValidation();
        $("#frm_valoresAprobados_diasEstimadosReparacion").disableValidation();

    } 
    console.log("TIPO DE ACCION: " + newVal);
}
//execute when the Dynaform loads:
checkAccion($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(checkAccion);


ocultar_todo();
mostrar_solicitud();

$("#frm_conductor_identificacion").disableValidation();
$("#frm_conductor_telefono").disableValidation();

