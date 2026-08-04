/* original henry
var id_op = $("#html_op").html('Id Stro - '+$("#tri_id_stro").getValue()+' | '+'Nro Stro - '+$("#tri_nro_stro").getValue());
*/
//$("#tri_id_stro").setValue("12345");

$("#id-stro").html(''+$("#tri_id_stro").getValue());
$("#nro-stro").html(''+$("#app_number_padre").getValue());

// Número de reclamo real (viene del SISE, vía @@frm_numero_reclamo_sise)
var reclamoReal = String($("#frm_numero_reclamo_sise").getValue() || '').trim();

if (reclamoReal == '') {
    reclamoReal = 'XXXX';
    $("#frm_numero_reclamo_sise").setValue(reclamoReal);
}

if (reclamoReal.toUpperCase().indexOf('XXXX') === 0) {
    // Aún no se ha logrado consultar / hubo un error
    $("#nro-reclamo-real").html('Consultando...');
} else {
    $("#nro-reclamo-real").html(''+reclamoReal);
}

// --- NUEVO: si el origen es INSURER o viene vacío, ocultar RECLAMO y renombrar INTEGRACIÓN ---
var origenCoreInsurance = String($("#frm_origen_core_insurance").getValue() || '').trim().toUpperCase();
if (origenCoreInsurance == 'INSURANCE' || origenCoreInsurance == '') {
    $("#box-reclamo-real").hide();
    $("#label-integracion").html('RECLAMO:');

    // Centrar las 2 cajas que quedan visibles
    $("#row-cajas-info").css({
        'display': 'flex',
        'justify-content': 'center',
        'flex-wrap': 'wrap'
    });
} else {
    // Por si acaso el flujo pasa por aquí más de una vez (ej. recarga del bloque),
    // devolvemos el layout normal
    $("#row-cajas-info").css({
        'display': '',
        'justify-content': '',
        'flex-wrap': ''
    });
}