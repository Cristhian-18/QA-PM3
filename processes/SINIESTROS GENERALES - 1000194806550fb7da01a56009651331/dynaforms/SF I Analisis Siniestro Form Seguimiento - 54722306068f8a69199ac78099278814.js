$("#grd_participacion_coaseguro").hide();

function ajustadorChange(newVal, oldVal) {
    $("#frm_as_nombreAjustadorAsignado").getControl().attr('disabled', false);

    console.log("TIPO DE REQUERIMIENTO: " + newVal);
    if(newVal == 'SINIESTROS_ANALISTAS_GN'){
        console.log($("#tri_usr_analista").getValue());
        $("#frm_as_nombreAjustadorAsignado").setValue($("#tri_usr_analista").getValue())
        $("#frm_as_nombreAjustadorAsignado").getControl().attr('disabled', true);

    }
    //
    //frm_as_emailAjustadorAsignado
    //frm_as_telefonoAjustadorAsignado
   /* $("#frm_as_nombreAjustadorAsignado").hide();
    $("#frm_as_emailAjustadorAsignado").hide();
    $("#frm_as_telefonoAjustadorAsignado").hide();
    $("#frm_as_nombreAjustadorAsignado").disableValidation();
    $("#frm_as_emailAjustadorAsignado").disableValidation();
    $("#frm_as_telefonoAjustadorAsignado").disableValidation();

    if (newVal == 'SINIESTROS_AJUSTADORES_EXTERNOS') {
        $("#frm_as_nombreAjustadorAsignado").show();
        $("#frm_as_emailAjustadorAsignado").show();
        $("#frm_as_telefonoAjustadorAsignado").show();
        $("#frm_as_nombreAjustadorAsignado").enableValidation();
        $("#frm_as_emailAjustadorAsignado").enableValidation();
        $("#frm_as_telefonoAjustadorAsignado").enableValidation();
    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);*/
}
//execute when the Dynaform loads:
//ajustadorChange($("#frm_as_tipoAjustador").getValue(), '');
$('#frm_as_tipoAjustador').setOnchange(ajustadorChange);
