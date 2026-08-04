$("#frm_as_nombreAjustadorAsignado").hide();

function checkCountry(newVal, oldVal) {
    var nombreCtrl = $("#frm_as_nombreAjustadorAsignado");

    if (newVal === 'SINIESTROS_ANALISTAS_GN') {
        nombreCtrl.show();

        var analista = $("#tri_usr_analista").getValue();
        console.log("Analista:", analista);

        nombreCtrl.setValue(analista);
        // ya no se bloquea el campo
    } else {
        nombreCtrl.show();
        // tampoco se bloquea ni limpia el valor
    }
}

// execute when the Dynaform loads:
if ($("#frm_as_tipoAjustador").getValue() != '') {
    checkCountry($("#frm_as_tipoAjustador").getValue(), '');
} else {
    $("#frm_as_nombreAjustadorAsignado").hide();
}

// execute when field's value changes:
$('#frm_as_tipoAjustador').setOnchange(checkCountry);

