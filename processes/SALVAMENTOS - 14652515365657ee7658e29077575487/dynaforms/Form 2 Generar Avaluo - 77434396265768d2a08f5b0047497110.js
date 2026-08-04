function action(newVal, oldVal) {
    $("#file_retiroSalvamento").hide();
    $("#file_ingresoSalvamento").hide();
    $("#file_retiroSalvamento").disableValidation();
    $("#file_ingresoSalvamento").disableValidation();
    $("#484580118657892ce08be80045083095").hide();
    $("#frm_retiroVehiculo").hide();
    $("#frm_retiroVehiculo").disableValidation();
    
    if (newVal == 'CONTINUAR') {
        $("#file_retiroSalvamento").show();
        $("#file_ingresoSalvamento").show();
        $("#file_retiroSalvamento").enableValidation();
        $("#file_ingresoSalvamento").enableValidation();
        $("#484580118657892ce08be80045083095").show();
        $("#frm_retiroVehiculo").show();
        $("#frm_retiroVehiculo").disableValidation();
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

    $("#94556961765657eea89e266060411572").hide();
    $("#17233983365657eea8880d0032087370").hide();
    $("#sub_vehiculo").hide();
    $("#94556961765657eea89e266060411572").hide();
    $("#sub_gestionSalv").hide();
    $("#86763720065786dd114faf5039608023").hide();
    $("#sub_precio").hide();
    $("#1858955726578b9083b9a50099192627").hide();
    
    
}
function mostrar_solicitud() {
    $("#sub_informacion").show();
    $("#35324623065767d4e255aa7070191370").show();
    $("#sub_ubicacionSalvamento").show();
    $("#4617805716576880a1eae81047564293").show();
    $("#94556961765657eea89e266060411572").show();
    $("#17233983365657eea8880d0032087370").show();
    $("#sub_vehiculo").show();
    $("#94556961765657eea89e266060411572").show();
    $("#sub_gestionSalv").show();
    $("#86763720065786dd114faf5039608023").show();
    $("#sub_precio").show();
    $("#1858955726578b9083b9a50099192627").show();
}


ocultar_todo();
mostrar_solicitud();