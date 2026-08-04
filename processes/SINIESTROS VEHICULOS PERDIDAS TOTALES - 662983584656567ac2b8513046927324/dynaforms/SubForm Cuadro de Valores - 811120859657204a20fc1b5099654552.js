function inicioNegociacion(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_inicioNegociacion").setValue(value);
}
inicioNegociacion($("#frm_valores_inicioNegociacion").getValue(), '');
$("#frm_valores_inicioNegociacion").setOnchange(inicioNegociacion);

function topeNegociacion(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_topeNegociacion").setValue(value);
}
topeNegociacion($("#frm_valores_topeNegociacion").getValue(), '');
$("#frm_valores_topeNegociacion").setOnchange(topeNegociacion);

function maximaNegociacion(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_maximaNegociacion").setValue(value);
}
maximaNegociacion($("#frm_valores_maximaNegociacion").getValue(), '');
$("#frm_valores_maximaNegociacion").setOnchange(maximaNegociacion);

function netoSalvamento(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_netoSalvamento").setValue(value);
}
netoSalvamento($("#frm_valores_netoSalvamento").getValue(), '');
$("#frm_valores_netoSalvamento").setOnchange(netoSalvamento);


function comisionSalvamento(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_comisionSalvamento").setValue(value);
}
comisionSalvamento($("#frm_valores_comisionSalvamento").getValue(), '');
$("#frm_valores_comisionSalvamento").setOnchange(comisionSalvamento);


function valorSalvamentoBase(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_salvamentoBase").setValue(value);
}
valorSalvamentoBase($("#frm_valores_salvamentoBase").getValue(), '');
$("#frm_valores_salvamentoBase").setOnchange(valorSalvamentoBase);

function valorCasco(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_valorCasco").setValue(value);
}
valorCasco($("#frm_valores_valorCasco").getValue(), '');
$("#frm_valores_valorCasco").setOnchange(valorCasco);


function valorExtras(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_extras").setValue(value);
}
valorExtras($("#frm_valores_extras").getValue(), '');
$("#frm_valores_extras").setOnchange(valorExtras);



$("#frm_valores_valorAcordado").setOnchange(function (newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_valorAcordado").setValue(value);
})

function valorAcordado(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_valorAcordado").setValue(value);
}
valorAcordado($("#frm_valores_valorAcordado").getValue(), '');
$("#frm_valores_valorAcordado").setOnchange(valorAcordado);

function valorAcordadoMasExtras(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_valorAcordadoMasExtras").setValue(value);
}
valorAcordadoMasExtras($("#frm_valores_valorAcordadoMasExtras").getValue(), '');
$("#frm_valores_valorAcordadoMasExtras").setOnchange(valorAcordadoMasExtras);

function valorDeducible(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_valorDeducible").setValue(value);
}
valorDeducible($("#frm_valores_valorDeducible").getValue(), '');
$("#frm_valores_valorDeducible").setOnchange(valorDeducible);

function valorALiquidar(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_valorALiquidar").setValue(value);
}
valorALiquidar($("#frm_valores_valorALiquidar").getValue(), '');
$("#frm_valores_valorALiquidar").setOnchange(valorALiquidar);

function porcentajePerdida(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_porcentajePerdida").setValue(value);
}
porcentajePerdida($("#frm_valores_porcentajePerdida").getValue(), '');
$("#frm_valores_porcentajePerdida").setOnchange(porcentajePerdida);

function valorIva(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_iva").setValue(value);
}
valorIva($("#frm_valores_iva").getValue(), '');
$("#frm_valores_iva").setOnchange(valorIva);

function audatexmasIva(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_audatexmasIva").setValue(value);
}
audatexmasIva($("#frm_valores_audatexmasIva").getValue(), '');
$("#frm_valores_audatexmasIva").setOnchange(audatexmasIva);

$("#frm_valores_valorDeducibleParcial").setOnchange(function (newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_valorDeducibleParcial").setValue(value);
})

function valorDeducibleParcial(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }

    $("#frm_valores_valorDeducibleParcial").setValue(value);
}
valorDeducibleParcial($("#frm_valores_valorDeducibleParcial").getValue(), '');
$("#frm_valores_valorDeducibleParcial").setOnchange(valorDeducibleParcial);

function totalParcial(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_totalParcial").setValue(value);
}
totalParcial($("#frm_valores_totalParcial").getValue(), '');
$("#frm_valores_totalParcial").setOnchange(totalParcial);

function valorPerdida(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_valorPerdida").setValue(value);
}
valorPerdida($("#frm_valores_valorPerdida").getValue(), '');
$("#frm_valores_valorPerdida").setOnchange(valorPerdida);

function porcentajePerdidaSalvamento(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_porcentajePerdidaSalvamento").setValue(value);
}
porcentajePerdidaSalvamento($("#frm_valores_porcentajePerdidaSalvamento").getValue(), '');
$("#frm_valores_porcentajePerdidaSalvamento").setOnchange(porcentajePerdidaSalvamento);


function valorAjustado(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_valorAjustado").setValue(value);
}
valorAjustado($("#frm_valores_valorAjustado").getValue(), '');
$("#frm_valores_valorAjustado").setOnchange(valorAjustado);


function valores_deducible(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_deducible").setValue(value);
}
valores_deducible($("#frm_valores_deducible").getValue(), '');
$("#frm_valores_deducible").setOnchange(valores_deducible);

function porcentajeDeducible(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
    $("#frm_valores_porcentajeDeducible").setValue(value);
}
porcentajeDeducible($("#frm_valores_porcentajeDeducible").getValue(), '');
$("#frm_valores_porcentajeDeducible").setOnchange(porcentajeDeducible);


