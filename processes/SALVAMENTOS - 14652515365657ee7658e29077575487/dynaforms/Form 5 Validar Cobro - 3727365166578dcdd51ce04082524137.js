function action(newVal, oldVal) {
    $("#file_retiroSalvamento").hide();
    $("#file_ingresoSalvamento").hide();
    $("#file_retiroSalvamento").disableValidation();
    $("#file_ingresoSalvamento").disableValidation();

    if (newVal == 'CONTINUAR') {
        $("#file_retiroSalvamento").show();
        $("#file_ingresoSalvamento").show();
        $("#file_retiroSalvamento").enableValidation();
        $("#file_ingresoSalvamento").enableValidation();
    }

}

$(".pmdynaform-grid-newitem").hide();

let numberRows = $("#grd_registro_pagos").getNumberRows();

for (let i = 1; i <= numberRows; i++) {
    for (let j = 1; j <= 8; j++) {
        $("#grd_registro_pagos").getControl(i, j).attr('disabled', true);
    }
}



//execute when the Dynaform loads:
action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);

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
            $("#sub_documentos_caso").show();
            $("#23271031065657eea890261027484884").show();
            break;
        case 'historial':
            $("#sub_historial_caso").show();
            $("#38388078065657eea86f554052132558").show();
            break;
    }
});


function ocultar_todo() {
    $("#sub_informacion").hide();
    $("#35324623065767d4e255aa7070191370").hide();
    $("#sub_ubicacionSalvamento").hide();
    $("#4617805716576880a1eae81047564293").hide();

    $("#sub_historial_caso").hide();
    $("#38388078065657eea86f554052132558").hide();
    $("#sub_documentos_caso").hide();
    $("#23271031065657eea890261027484884").hide();


}
function mostrar_solicitud() {
    $("#sub_informacion").show();
    $("#35324623065767d4e255aa7070191370").show();
    $("#sub_ubicacionSalvamento").show();
    $("#4617805716576880a1eae81047564293").show();

}


ocultar_todo();
mostrar_solicitud();

$("#3727365166578dcdd51ce04082524137").setOnSubmit(function () {
    var aRc = $("#grd_registro_pagos").getNumberRows();

    for (var i = 0; i <= aRc; i++) {
        if ($("#grd_registro_pagos").getValue(i, 9) == "" || $("#grd_registro_pagos").getValue(i, 9) == null) {
            if ($("#grd_registro_pagos").getValue(i, 6) != "" && $("#grd_registro_pagos").getValue(i, 6) != null) {
                alert("Verifique que el estado de transferencia de todos los pagos hayan sido validados o rechazados");
                return false;
            }
        }
    }
    return true;
});