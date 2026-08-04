$(document).ready(function () {
    $('form input[type="text"], form textarea')
        .not('[name="form[frm_comentario]"]')
        .prop('readonly', true);
});

function ajustarColumnas(hayPreliquidacion) {
    var cols = ['#col-preliq', '#col-caso', '#col-reclamo'];
    cols.forEach(function (id) {
        if (hayPreliquidacion) {
            $(id).removeClass('col-md-4').addClass('col-md-3');
        } else {
            $(id).removeClass('col-md-3').addClass('col-md-4');
        }
    });
}

// 1. Número de Preliquidación
$("#id-stro").html('' + $("#frm_numpreliq").getValue());
if ($("#frm_numpreliq").getValue() == '') {
    $("#id-stro").html('');
}

// 2. Número de Caso
$("#nro-stro").html('' + $("#frm_numcaso").getValue());
if ($("#frm_numcaso").getValue() == '') {
    $("#nro-stro").html('');
}

// 3. Reclamo
$("#reclamo-stro").html('' + $("#frm_numero_reclamo_sise").getValue());
if ($("#frm_numero_reclamo_sise").getValue() == '') {
    $("#reclamo-stro").html('');
}

// 4. Estado — solo visible si frm_numpreliq tiene dato
if ($("#frm_numpreliq").getValue() != '' && $("#frm_numpreliq").getValue() != 'xxxx' && $("#frm_estado").getValue() != '') {
    $("#card-estado").show();
    $("#estado-stro").html('' + $("#frm_estado").getValue());
    ajustarColumnas(true);
} else {
    $("#card-estado").hide();
    ajustarColumnas(false);
}


// 5. Ocultar submit si no hay preliquidación O si el estado es PENDIENTE o FINALIZADO
var preliq = $("#frm_numpreliq").getValue();
var estado = $("#frm_estado").getValue();

if (preliq == 'xxxx' || preliq == '' || estado == '') {
    // Preliquidación NO enviada todavía
    $("#submit0000000001").show();
} else {
    // Preliquidación YA enviada (tiene número y estado, ej. PENDIENTE)
    $("#submit0000000001").hide();

    // Oculta el comentario y le quita la validación
    $("#frm_comentario").closest('.pmdynaform-field').hide();
    $("#frm_comentario").setRequired(false);

    // Oculta el subtítulo "Atención al caso"
    $("#subt_atencion").closest('.pmdynaform-field').hide();
}

$("#subtitle0000000003").setValue($("#frm_name_process").getValue());

// 6. NRO RRN
$("#frm_nro_rrn").setValue(
    String($("#frm_numero_reporte_sise").getValue()) +
    String($("#frm_numero_reclamo_sise").getValue()) +
    String($("#frm_numcaso").getValue())
);

$("#frm_vale").setValue(
    'DP' + $("#frm_numcaso").getValue()
);

$("#frm_ordenReparacion").setValue(
    $("#frm_numcaso").getValue()
);

// 7. Bloquear el submit si la consulta a SISE no validó el siniestro
$('#submit0000000001').on('click', function (e) {
    $("#frm_accion").setValue("CONTINUAR");
    if ($("#tri_bandera_error_sise").getValue() == '1') {
        console.log('No se pudo validar la información del siniestro. No se puede continuar.');
        e.preventDefault();
        e.stopPropagation();
        alert('No se pudo validar la información del siniestro. No se puede continuar.');
        return false;
    }
})