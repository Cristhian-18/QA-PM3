$("#repuestos").hide();

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
            $("#75921207865655b4ed5b3c1053457518").show();
            break;
        case 'historial':
            $("#sbt_historial").show();
            $("#79094655365655b4ed40d17058683087").show();
            break;
    }
});


function ocultar_todo() {
    $("#sub_busqueda").hide();
    $("#60259283965655b4ed68cb6009778512").hide();
    $("#subt_vehiculo").hide();
    $("#17569986565655b4ed8c995023188336").hide();
    $("#subt_asegurado").hide();
    $("#76241453365655b4ed3ad27050479402").hide();
    $("#subt_detalle").hide();
    $("#41209453665655b4ed71780023900709").hide();
    $("#subt_registro").hide();
    $("#44056937965655b4ed42c04054669455").hide();
    $("#subt_ve_afectados").hide();
    $("#93254149565655b4ed46a66057215729").hide();
    $("#isubt_pe_afectados").hide();
    $("#43602034065655b4ed6ca46084965014").hide();
    $("#iisubt_pr_afectados").hide();
    $("#46533585865655b4ed84dd4018270742").hide();
    $("#sub_docs").hide();
    $("#98325375965655b4ed45b13092827388").hide();
    $("#sub_valores").hide();
    $("#51718349165655b4ed81039097317111").hide();
    $("#subt_docs").hide();
    $("#75921207865655b4ed5b3c1053457518").hide();
    $("#sbt_historial").hide();
    $("#79094655365655b4ed40d17058683087").hide();
    $("#subt_poliza").hide();
    $("#28358068365655b4ed35473079795674").hide();
    $("#57719423965655b4ed5e193039723079").hide();
    $("#subt_historial_siniestro").hide();
    $("#47330327665655b4ed38dc0072757607").hide();
    $("#13230486865655b4ed57598003315291").hide();
    $("#aub_friss").hide();
    $("#95547977665655b4ed87ca6055466913").hide();



}
function mostrar_solicitud() {
    $("#sub_busqueda").show();
    $("#60259283965655b4ed68cb6009778512").show();
    $("#subt_vehiculo").show();
    $("#17569986565655b4ed8c995023188336").show();
    $("#subt_asegurado").show();
    $("#76241453365655b4ed3ad27050479402").show();
    $("#subt_detalle").show();
    $("#41209453665655b4ed71780023900709").show();
    $("#subt_registro").show();
    $("#44056937965655b4ed42c04054669455").show();
    $("#subt_ve_afectados").show();
    $("#93254149565655b4ed46a66057215729").show();
    $("#isubt_pe_afectados").show();
    $("#43602034065655b4ed6ca46084965014").show();
    $("#iisubt_pr_afectados").show();
    $("#46533585865655b4ed84dd4018270742").show();
    $("#sub_docs").show();
    $("#98325375965655b4ed45b13092827388").show();
    $("#sub_valores").show();
    $("#51718349165655b4ed81039097317111").show();
    $("#subt_poliza").show();
    $("#28358068365655b4ed35473079795674").show();
    $("#57719423965655b4ed5e193039723079").show();
    $("#subt_historial_siniestro").show();
    $("#47330327665655b4ed38dc0072757607").show();
    $("#13230486865655b4ed57598003315291").show();
    $("#aub_friss").show();
    $("#95547977665655b4ed87ca6055466913").show();

}

let vehiculos = $("#frm_siniestro_OtrosVehiculos").getValue();
let propiedades = $("#frm_siniestro_Propiedad").getValue();
let personas = $("#frm_siniestro_Personas").getValue();

$("#isubt_pe_afectados").hide();
$("#43602034065655b4ed6ca46084965014").hide();
$("#subt_ve_afectados").hide();
$("#93254149565655b4ed46a66057215729").hide();
$("#iisubt_pr_afectados").hide();
$("#46533585865655b4ed84dd4018270742").hide();

if (vehiculos == 'SI') {
    $("#subt_ve_afectados").show();
    $("#93254149565655b4ed46a66057215729").show();
}
if (propiedades == 'SI') {
    $("#iisubt_pr_afectados").show();
    $("#46533585865655b4ed84dd4018270742").show();
}
if (personas == 'SI') {
    $("#isubt_pe_afectados").show();
    $("#43602034065655b4ed6ca46084965014").show();
}



ocultar_todo();
mostrar_solicitud();

function action(newVal, oldVal) {
    //frm_valoresSiniestro_manoObraProformada
    //frm_valoresAprobados_diasEstimadosReparacion

    $("#frm_valoresAprobados_manoObraProformada").enableValidation();
    $("#frm_valoresAprobados_diasEstimadosReparacion").enableValidation();
    if (newVal == 'AJUSTAR' || newVal == 'RECHAZAR') {
        $("#frm_valoresAprobados_manoObraProformada").disableValidation();
        $("#frm_valoresAprobados_diasEstimadosReparacion").disableValidation();
        $("#frm_valoresAprobados_valoresRepuestos1").disableValidation();
        $("#frm_valoresAprobados_procentajeDescuentoProformado").disableValidation();
    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);

$("#frm_conductor_identificacion").disableValidation();
$("#frm_conductor_telefono").disableValidation();

