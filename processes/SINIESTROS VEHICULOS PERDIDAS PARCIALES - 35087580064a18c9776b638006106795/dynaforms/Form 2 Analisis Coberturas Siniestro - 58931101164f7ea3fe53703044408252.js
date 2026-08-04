let numberRows = $("#grd_registro_siniestro").getNumberRows();
console.log(numberRows);

for (let i = 1; i <= numberRows; i++) {
    $("#grd_valores_siniestros").setValue("Aprobado", i, 9);
    //$("#grd_valores_siniestros").getControl(i, 9).attr('disabled', true);
    let aplicar = +  $("#grd_valores_siniestros").getValue(i, 4);
    if (aplicar != "SI") {
        for (let j = 1; j <= 6; j++) {
            //$("#grd_valores_siniestros").getControl(i, j).attr('hidden', true);
            //$("#grd_valores_siniestros").getControl(i, j).attr('hidden');
        }
    }
}

let provincia = $("#frm_accidente_provincia").getValue();


$("#sub_valores").hide();
$("#79905380564f7ece7bc8989091267394").hide();
$("#subt_gestionTaller").hide();
$("#63032550665392b8983d5f2053584474").hide();
$("#subt_documentosTaller").hide();
$("#96756789765393848ee6b94042482704").hide();

$("#frm_documentos_cotizacion").disableValidation();
$("#frm_documentos_evidencia").disableValidation();

$("#subt_valoresSiniestros").hide();
$("#256570049653931cb709279020139545").hide();


/*function action(newVal, oldVal) {

    $("#sub_valores").hide();
    $("#79905380564f7ece7bc8989091267394").hide();
    $("#subt_gestionTaller").hide();
    $("#63032550665392b8983d5f2053584474").hide();
    $("#subt_documentosTaller").hide();
    $("#96756789765393848ee6b94042482704").hide();

    $("#frm_documentos_cotizacion").disableValidation();
    $("#frm_documentos_evidencia").disableValidation();

    $("#subt_valoresSiniestros").hide();
    $("#256570049653931cb709279020139545").hide();

    $("#frm_siniestro_OtrosVehiculos").enableValidation();
    $("#frm_siniestro_Propiedad").enableValidation();
    $("#frm_siniestro_Personas").enableValidation();
    $("#frm_requiere_PartePolicial").enableValidation();
    $("#frm_requiere_AsesoriaLegal").enableValidation();
    $("#frm_siniestro_afectado").enableValidation();
    $("#frm_asegurado_tipo").enableValidation();
    $("#frm_asegurado_identificacion").enableValidation();
    $("#frm_asegurado_nombres").enableValidation();
    $("#frm_asegurado_telefono").enableValidation();

    $("#frm_documentos_check").disableValidation();
    $('#fle_matricula').disableValidation();
    $('#fle_cedula').disableValidation();
    $('#fle_licencia').disableValidation();
    $('#fle_denuncia').disableValidation();
    $('#fle_partePolicial').disableValidation();

    if (newVal == 'CONTINUAR') {
        //$("#frm_documentos_check").enableValidation();

        $("#sub_valores").show();
        $("#79905380564f7ece7bc8989091267394").show();
        $("#subt_gestionTaller").show();
        $("#63032550665392b8983d5f2053584474").show();
        $("#subt_documentosTaller").show();
        $("#96756789765393848ee6b94042482704").show();
        $("#subt_valoresSiniestros").show();
        $("#256570049653931cb709279020139545").show();

        $("#frm_documentos_cotizacion").enableValidation();
        $("#frm_documentos_evidencia").enableValidation();

    }


    if (newVal == 'COTIZADO') {
        $("#frm_documentos_check").enableValidation();

        $("#subt_gestionTaller").show();
        $("#63032550665392b8983d5f2053584474").show();
        $("#subt_documentosTaller").show();
        $("#96756789765393848ee6b94042482704").show();
        $("#subt_valoresSiniestros").show();
        $("#256570049653931cb709279020139545").show();

        $("#frm_documentos_cotizacion").enableValidation();
        $("#frm_documentos_evidencia").enableValidation();
    }

    if (newVal == 'PERDIDA') {

        $("#subt_gestionTaller").show();
        $("#63032550665392b8983d5f2053584474").show();
        $("#subt_documentosTaller").show();
        $("#96756789765393848ee6b94042482704").show();
        $("#subt_valoresSiniestros").show();
        $("#256570049653931cb709279020139545").show();

        $("#frm_documentos_cotizacion").enableValidation();
        $("#frm_documentos_evidencia").enableValidation();

    }
    if (newVal == 'SOLICITAR') {

        $("#frm_siniestro_OtrosVehiculos").disableValidation();
        $("#frm_siniestro_Propiedad").disableValidation();
        $("#frm_siniestro_Personas").disableValidation();
        $("#frm_requiere_PartePolicial").disableValidation();
        $("#frm_requiere_AsesoriaLegal").disableValidation();
        $("#frm_siniestro_afectado").disableValidation();
        $("#frm_asegurado_tipo").disableValidation();
        $("#frm_asegurado_identificacion").disableValidation();
        $("#frm_asegurado_nombres").disableValidation();
        $("#frm_asegurado_telefono").disableValidation();

    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}*/
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);



$("#repuestos").hide();

$('.menu').on('click', function () {
    ocultar_todo()
    console.log(this.id)
    console.log('CAMBIO')
    switch (this.id) {
        case 'solicitud':
            mostrar_solicitud()
            break
        case 'documentos':
            $('#subt_docs').show()
            $('#418835952652a78d09ec638009652152').show()
            break
        case 'historial':
            $('#sbt_historial').show()
            $('#200528691652a78b49077a9030935355').show()
            break
        case 'repuestos':
            $('#sub_repuestos').show()
            $('#267077245653c2f21671c39092873297').show()
            break
    }
})

function ocultar_todo() {
    $('#subt_friss').hide()
    $('#88678649164f7eaea023df2027918886').hide()
    $('#711981759653951b01d9fc7055662056').hide()
    $('#subt_tallerAsignado').hide()
    $('#subt_ppolicial').hide()
    $('#82315095164a5ea0d445d33098806451').hide()
    $('#subt_accesoriosRegistrados').hide()
    $('#757211058653970103ff5d0031705379').hide()
    $('#subt_accidente').hide()
    $('#342283484650ba7c9f2fd13056558401').hide()
    $('#585018357653c2950773cf3076340308').hide()
    $('#sub_busqueda').hide()
    $('#56711039964a8241d124701020566530').hide()
    $('#subt_vehiculo').hide()
    $('#95746246564a4a9c711dfb2023501124').hide()
    $('#subt_asegurado').hide()
    $('#15180521364a5eaf5f02815065887190').hide()
    $('#subt_detalle').hide()
    $('#61446768964a848b295ae19072670821').hide()
    $('#subt_registro').hide()
    $('#22536303964a5e5cc12a673090504456').hide()
    $('#sub_docs').hide()
    $('#24155013164a5edc37a3b68095174528').hide()
    $('#sub_valores').hide()
    $('#79905380564f7ece7bc8989091267394').hide()
    $('#subt_docs').hide()
    $('#418835952652a78d09ec638009652152').hide()
    $('#sbt_historial').hide()
    $('#200528691652a78b49077a9030935355').hide()
    $('#subt_poliza').hide()
    $('#12366487464a4a855bed4c8081629548').hide()
    $('#sub_repuestos').hide()
    $('#470410481653944a172eeb1027144131').hide()
    $('#subt_hsiniestros').hide()
    $('#14870785564a5e392d24239097281950').hide()

    $('#subt_direccionador').hide()
    $('#34599290264a5ec882dda43091413149').hide()
    $('#subt_documentosTaller').hide()
    $('#96756789765393848ee6b94042482704').hide()
    $('#subt_gestionTaller').hide()
    $('#63032550665392b8983d5f2053584474').hide()
    $('#subt_valoresSiniestros').hide()
    $('#256570049653931cb709279020139545').hide()
    $("#subt_ve_afectados").hide();
    $("#24440509064a84d82d7a6e4090951046").hide();
    $("#iisubt_pr_afectados").hide();
    $("#83626962464a84f217fbb30019736581").hide();
    $("#isubt_pe_afectados").hide();
    $("#59581944164a84e6bc66f02025995827").hide();
    $("#822876425654c53aeac1a76093258382").hide();

}
function mostrar_solicitud() {
    $('#subt_friss').show()
    $('#88678649164f7eaea023df2027918886').show()
    $('#711981759653951b01d9fc7055662056').show()
    $('#subt_tallerAsignado').show()
    $('#subt_ppolicial').show()
    $('#82315095164a5ea0d445d33098806451').show()
    $('#subt_accesoriosRegistrados').show()
    $('#757211058653970103ff5d0031705379').show()
    $('#subt_accidente').show()
    $('#342283484650ba7c9f2fd13056558401').show()
    $('#subt_hsiniestros').show()

    $('#sub_busqueda').show()
    $('#56711039964a8241d124701020566530').show()
    $('#subt_vehiculo').show()
    $('#95746246564a4a9c711dfb2023501124').show()
    $('#subt_asegurado').show()
    $('#15180521364a5eaf5f02815065887190').show()
    $('#subt_detalle').show()
    $('#61446768964a848b295ae19072670821').show()
    $('#subt_registro').show()
    $('#22536303964a5e5cc12a673090504456').show()
    $('#sub_docs').show()
    $('#24155013164a5edc37a3b68095174528').show()

    $('#subt_poliza').show()
    $('#12366487464a4a855bed4c8081629548').show()
    $('#subt_historial_siniestro').show()
    $('#14870785564a5e392d24239097281950').show()
    $('#subt_direccionador').show()
    $('#34599290264a5ec882dda43091413149').show()
    $("#822876425654c53aeac1a76093258382").show();

    checkVehiculosImplicados($("#frm_siniestro_OtrosVehiculos").getValue(), '');
    checkPropiedadImplicados($("#frm_siniestro_Propiedad").getValue(), '');
    checkPersonasImplicados($("#frm_siniestro_Personas").getValue(), '');



}

ocultar_todo()
mostrar_solicitud()


$("#sub_valores").hide();
$("#79905380564f7ece7bc8989091267394").hide();
$("#subt_gestionTaller").hide();
$("#63032550665392b8983d5f2053584474").hide();
$("#subt_documentosTaller").hide();
$("#96756789765393848ee6b94042482704").hide();

$("#frm_documentos_cotizacion").disableValidation();
$("#frm_documentos_evidencia").disableValidation();

$("#subt_valoresSiniestros").hide();
$("#256570049653931cb709279020139545").hide();

$("#frm_siniestro_OtrosVehiculos").disableValidation();
$("#frm_siniestro_Propiedad").disableValidation();
$("#frm_siniestro_Personas").disableValidation();

function action(newVal, oldVal) {
    $('#frm_correo_cliente').hide();
    $('#frm_correo_cliente2').hide();
    $('#frm_requiere_AsesoriaLegal').disableValidation();
    $('#frm_siniestro_seConsidera').disableValidation();
    $('#frm_requiere_PartePolicial').disableValidation();
    $('#frm_asegurado_tipo').disableValidation();
    $('#frm_conductor_identificacion').disableValidation();
    $('#frm_conductor_nombres').disableValidation();
    $('#frm_conductor_telefono').disableValidation();
    $('#frm_conductor_relacion').disableValidation();
    $('#frm_conductor_relacion_otro').disableValidation();
    $('#frm_siniestro_direccion').disableValidation();
    $('#frm_siniestro_detalle').disableValidation();
    $('#frm_siniestro_OtrosVehiculos').disableValidation();
    $('#frm_siniestro_Propiedad').disableValidation();
    $('#frm_siniestro_Personas').disableValidation();
    $('#frm_accidente_pais').disableValidation();
    $('#frm_accidente_provincia').disableValidation();
    $('#frm_accidente_ciudad').disableValidation();
    //frm_rp_componente_e frm_componente_accesorios frm_componente_inundado
    //disabled false
    $("#frm_rp_componente_e").getControl().attr('disabled', false);
    $("#frm_componente_accesorios").getControl().attr('disabled', false);
    $("#frm_componente_inundado").getControl().attr('disabled', false);


    if (newVal == "SOLICITAR") {
        $('#frm_correo_cliente').show();
        $('#frm_correo_cliente2').show();
        //$('#frm_requiere_PartePolicial').disableValidation();
    } else if (newVal == "CONTINUAR" || newVal == "RESPONSABILIDAD") {
        /*$('#frm_requiere_AsesoriaLegal').enableValidation();
        $('#frm_siniestro_seConsidera').enableValidation();
        $('#frm_requiere_PartePolicial').enableValidation();
        $('#frm_asegurado_tipo').enableValidation();
        $('#frm_conductor_identificacion').enableValidation();
        $('#frm_conductor_nombres').enableValidation();
        $('#frm_conductor_telefono').enableValidation();
        $('#frm_conductor_relacion').enableValidation();
        $('#frm_conductor_relacion_otro').enableValidation();
        $('#frm_siniestro_direccion').enableValidation();
        $('#frm_siniestro_detalle').enableValidation();
        $('#frm_siniestro_OtrosVehiculos').enableValidation();
        $('#frm_siniestro_Propiedad').enableValidation();
        $('#frm_siniestro_Personas').enableValidation();*/
        $("#58931101164f7ea3fe53703044408252").setOnSubmit(function () {
            var aRc = $("#grd_vehiculos_afectados").getNumberRows();
            for (var i = 0; i <= aRc; i++) {
                if (($("#grd_vehiculos_afectados").getValue(i, 1) != '' || $("#grd_vehiculos_afectados").getValue(i, 2) != '' || $("#grd_vehiculos_afectados").getValue(i, 3) != '') && $("#grd_vehiculos_afectados").getValue(i, 7) == '') {
                    alert("El vehículo afectado # " + (i) + " no tiene un estado seleccionado.");
                    return false;  //return false to stop submit action
                }
                // get numberRows of grd_vehiculos_afectados
                let numberRows = $("#grd_vehiculos_afectados").getNumberRows();
                for (let j = 1; j <= numberRows; j++) {
                    // 7 != NOAPLICA y 10 == 0 
                    if ($("#grd_vehiculos_afectados").getValue(j, 7) != 'NOAPLICA' && $("#grd_vehiculos_afectados").getValue(j, 9) == ''
                        && ($("#grd_vehiculos_afectados").getValue(j, 10) == 0 ||
                            $("#grd_vehiculos_afectados").getValue(j, 10) == '0.00' )) {
                        alert("El vehículo afectado # " + (j) + " no tiene un valor de reserva definido.");
                        return false;  //return false to stop submit action
                    }
                }

            }
            return true;
        });
    }

}

action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);
