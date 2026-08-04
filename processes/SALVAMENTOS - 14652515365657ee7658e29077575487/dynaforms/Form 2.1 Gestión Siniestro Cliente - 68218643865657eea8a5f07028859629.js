$('#repuestos').hide();
$("#frm_documentos_check").disableValidation();
$('#fle_matricula').disableValidation();
$('#fle_cedula').disableValidation();
$('#fle_licencia').disableValidation();
$('#fle_denuncia').disableValidation();
$('#fle_partePolicial').disableValidation();
$('.menu').on('click', function () {
    ocultar_todo()
     console.log(this.id)
    console.log('CAMBIO')
    switch (this.id) {
        case 'solicitud':
            mostrar_solicitud()
            checkVehiculosImplicados($("#frm_siniestro_OtrosVehiculos").getValue(), '');
    $('#frm_siniestro_OtrosVehiculos').setOnchange(checkVehiculosImplicados); //execute when field's value changes

    checkPropiedadImplicados($("#frm_siniestro_Propiedad").getValue(), '');
    $('#frm_siniestro_Propiedad').setOnchange(checkPropiedadImplicados); //execute when field's value changes

    checkPersonasImplicados($("#frm_siniestro_Personas").getValue(), '');
    $('#frm_siniestro_Personas').setOnchange(checkPersonasImplicados); //execute when field's value changes
   
            break
        case 'documentos':
            $('#subt_docs').show()
            $('#23271031065657eea890261027484884').show()
            break
        case 'historial':
            $('#sbt_historial').show()
            $('#38388078065657eea86f554052132558').show()
            break
        case 'repuestos':
            $('#sub_repuestos').show()
            $('#38963767765657eea87aa86094721410').show()
            break
    }
   
})

function ocultar_todo() {
    $('#sub_estadoTaller').hide()
    $('#34010538965657eea8ab189068687628').hide()
    $('#subt_friss').hide()
    $('#37834123465657eea8c1164099238212').hide()
    $('#47781112665657eea8b0668042786066').hide()
    $('#subt_tallerAsignado').hide()
    $('#subt_ppolicial').hide()
    $('#15894986365657eea8bd0f2052191535').hide()
    $('#subt_accesoriosRegistrados').hide()
    $('#38598074265657eea8b6072000128001').hide()
    $('#subt_accidente').hide()
    $('#33751146965657eea8867b4097970847').hide()
       $('#iisubt_pr_afectados').hide()
    $('#80125453265657eea8be050001169192').hide()
    $('#23654578165657eea8a1875054303713').hide()
    $('#sub_busqueda').hide()
    $('#52345823565657eea89f273081823396').hide()
    $('#subt_vehiculo').hide()
    $('#39942008765657eea8c60e4037826925').hide()
    $('#subt_asegurado').hide()
    $('#77577551765657eea869184079116697').hide()
    $('#subt_detalle').hide()
    $('#40264027065657eea8a90a6057516237').hide()
    $('#subt_registro').hide()
    $('#41246456365657eea871e92041543660').hide()
    $('#subt_ve_afectados').hide()
    $('#15565307165657eea877078043143405').hide()
    $('#isubt_pe_afectados').hide()
    $('#72757335765657eea8a3ea5068757906').hide()
    $('#sub_docs').hide()
    $('#42369092065657eea875f65039015911').hide()
    $('#sub_valores').hide()
    $('#81367868865657eea8ba0a9094814227').hide()
    $('#subt_docs').hide()
    $('#23271031065657eea890261027484884').hide()
    $('#sbt_historial').hide()
    $('#38388078065657eea86f554052132558').hide()
    $('#subt_poliza').hide()
    $('#85517892965657eea863bb6085915178').hide()
    $('#sub_repuestos').hide()
    $('#83349221365657eea8935c0034368501').hide()
    $('#subt_hsiniestros').hide()
    $('#70029930365657eea866da2082229749').hide()

    $('#subt_direccionador').hide()
    $('#17233983365657eea8880d0032087370').hide()
    $('#subt_documentosTaller').hide()
    $('#55104713665657eea8c7130067901735').hide()
    $('#subt_gestionTaller').hide()
    $('#34010538965657eea8ab189068687628').hide()
    $('#subt_valoresSiniestros').hide()
    $('#49436449665657eea879846048030792').hide()
}
function mostrar_solicitud() {
    $('#sub_estadoTaller').show()
    $('#34010538965657eea8ab189068687628').show()
    $('#subt_friss').show()
    $('#37834123465657eea8c1164099238212').show()
    $('#47781112665657eea8b0668042786066').show()
    $('#subt_tallerAsignado').show()
    $('#subt_ppolicial').show()
    $('#15894986365657eea8bd0f2052191535').show()
    $('#subt_accesoriosRegistrados').show()
    $('#38598074265657eea8b6072000128001').show()
    $('#subt_accidente').show()
    $('#33751146965657eea8867b4097970847').show()
    $('#subt_hsiniestros').show()
    $('#sub_busqueda').show()
    $('#52345823565657eea89f273081823396').show()
    $('#subt_vehiculo').show()
    $('#39942008765657eea8c60e4037826925').show()
    $('#subt_asegurado').show()
    $('#77577551765657eea869184079116697').show()
    $('#subt_detalle').show()
    $('#40264027065657eea8a90a6057516237').show()
    $('#subt_registro').show()
    $('#41246456365657eea871e92041543660').show()
    $('#sub_docs').show()
    $('#42369092065657eea875f65039015911').show()
    $('#sub_valores').show()
    $('#81367868865657eea8ba0a9094814227').show()
    $('#subt_poliza').show()
    $('#85517892965657eea863bb6085915178').show()
    $('#subt_historial_siniestro').show()
    $('#70029930365657eea866da2082229749').show()
    $('#subt_direccionador').show()
    $('#17233983365657eea8880d0032087370').show()
    $('#subt_documentosTaller').show()
    $('#55104713665657eea8c7130067901735').show()
    $('#subt_gestionTaller').show()
    $('#34010538965657eea8ab189068687628').show()
    $('#subt_valoresSiniestros').show()
    $('#49436449665657eea879846048030792').show()
}

ocultar_todo()
mostrar_solicitud()
