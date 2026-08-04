let precio_venta = $("#frm_salvamento_precioVenta").getValue();

if (precio_venta != '' && precio_venta != null) {
    $("#frm_salvamento_precioVenta").getControl().attr("disabled", true);
}

let numberRows = $("#grd_registro_pagos").getNumberRows();

for (let i = 1; i <= numberRows; i++) {
    for (let j = 1; j <= 9; j++) {
        $("#grd_registro_pagos").getControl(i,j).attr('disabled', true);
    }
}

$("#repuestos").hide();

function action(newVal, oldVal) {
   
    $("#frm_proveedor_factura").hide();
    $("#frm_proveedor_factura").disableValidation();
    $("#frm_salvamento_fechaEntrega").hide();
    $("#frm_salvamento_fechaEntrega").disableValidation();
    $("#frm_salvamento_fechaTraspaso").hide();
    $("#frm_salvamento_fechaTraspaso").disableValidation();
    $("#frm_salvamento_fechaContratoFirmado").hide();
    $("#frm_salvamento_fechaContratoFirmado").disableValidation();
    $("#file_finiquito").hide();
    $("#file_finiquito").disableValidation();


    if (newVal == "CONTINUAR") {
        $("#frm_proveedor_factura").show();
        $("#frm_proveedor_factura").enableValidation();
        $("#frm_salvamento_fechaEntrega").show();
        $("#frm_salvamento_fechaEntrega").enableValidation();
        $("#frm_salvamento_fechaTraspaso").show();
        $("#frm_salvamento_fechaTraspaso").enableValidation();
        $("#frm_salvamento_fechaContratoFirmado").show();
        $("#frm_salvamento_fechaContratoFirmado").enableValidation();
        $("#file_finiquito").show();
        $("#file_finiquito").enableValidation();


    }
    if (newVal == "REGRESAR") {

    }

}

action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);

$("#frm_documentos_otros").hide();
//$("#grd_valores_siniestros").hideColumn(8);


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
            $("#23271031065657eea890261027484884").show();
            break;
        case 'historial':
            $("#sbt_historial").show();
            $("#38388078065657eea86f554052132558").show();
            break;

    }
});


function ocultar_todo() {
    $("#sub_busqueda").hide();
    $("#52345823565657eea89f273081823396").hide();
    $("#subt_vehiculo").hide();
    $("#39942008765657eea8c60e4037826925").hide();
    $("#subt_asegurado").hide();
    $("#77577551765657eea869184079116697").hide();
    $("#subt_detalle").hide();
    $("#40264027065657eea8a90a6057516237").hide();
    $("#subt_registro").hide();
    $("#41246456365657eea871e92041543660").hide();
    //$("#subt_ve_afectados").hide();
    //$("#15565307165657eea877078043143405").hide();
    $("#isubt_pe_afectados").hide();
    $("#72757335765657eea8a3ea5068757906").hide();
    $("#iisubt_pr_afectados").hide();
    $("#80125453265657eea8be050001169192").hide();
    $("#sub_docs").hide();
    $("#42369092065657eea875f65039015911").hide();
    $("#sub_valores").hide();
    $('#83349221365657eea8935c0034368501').hide()
    $("#81367868865657eea8ba0a9094814227").hide();
    $("#subt_docs").hide();
    $("#23271031065657eea890261027484884").hide();
    $("#sbt_historial").hide();
    $("#38388078065657eea86f554052132558").hide();
    $("#subt_poliza").hide();
    $("#85517892965657eea863bb6085915178").hide();
    $("#subt_hsiniestros").hide();
    $("#70029930365657eea866da2082229749").hide();
    $("#subt_ppolicial").hide();
    $("#15894986365657eea8bd0f2052191535").hide();
    $("#subt_direccionador").hide();
    $("#17233983365657eea8880d0032087370").hide();
    $("#subt_friss").hide();
    $("#37834123465657eea8c1164099238212").hide();

    $("#subt_accidente").hide();
    $("#33751146965657eea8867b4097970847").hide();
    //$("#subt_ve_afectados").hide();
    //$("#15565307165657eea877078043143405").hide();
    $("#isubt_pe_afectados").hide();
    $("#72757335765657eea8a3ea5068757906").hide();
    $("#iisubt_pr_afectados").hide();
    $("#80125453265657eea8be050001169192").hide();
    $("#94611480865657eea8ac269071748434").hide();
    $("#sub_accesorios").hide();
    $("#38598074265657eea8b6072000128001").hide();
    $("#sub_taller_asign").hide();
    $("#47781112665657eea8b0668042786066").hide();
    $("#subt_analisis_coberturas").hide();
    $("#91758672765657eea88cfb3093276063").hide();

    $("#sub_gestionrepuestos").hide();
    $("#sub_valores_siniestros").hide();
    $("#66500223665657eea88bf88096551186").hide();
    $("#sub_deducibles").hide();
    $("#97590038765657eea8c5027052291288").hide();

    $("#sub_legal").hide();
    $("#27168820065768ecf6ec438053950907").hide();
    $("#sub_prov").hide();
    $("#7711155976578c19a395e12024178579").hide();
    $("#sub_infSalv").hide();
    $("#86763720065786dd114faf5039608023").hide();
    $("#sub_precioVenta").hide();
    $("#1858955726578b9083b9a50099192627").hide();
    $("#sub_registro").hide();
    $("#2053793746578d25b72b9b2009235826").hide();
    $("#sbt_historial").hide();


    $("#sub_informacion").hide();
    $("#94556961765657eea89e266060411572").hide();
    $("#sub_precio").hide();
    $("#628538942657688c37ffaa5090948147").hide();
    $("#sub_registro_subasta").hide();

}
function mostrar_solicitud() {
    $("#sub_busqueda").show();
    $("#52345823565657eea89f273081823396").show();
    $("#subt_vehiculo").show();
    $("#39942008765657eea8c60e4037826925").show();
    $("#subt_asegurado").show();
    $("#77577551765657eea869184079116697").show();
    //$("#subt_detalle").show();
    //$("#40264027065657eea8a90a6057516237").show();
    $("#subt_registro").show();
    $("#41246456365657eea871e92041543660").show();
    //$("#subt_ve_afectados").show();
    //$("#15565307165657eea877078043143405").show();
    $("#isubt_pe_afectados").show();
    $("#72757335765657eea8a3ea5068757906").show();
    $("#iisubt_pr_afectados").show();
    $("#80125453265657eea8be050001169192").show();
    $("#sub_docs").show();
    $("#42369092065657eea875f65039015911").show();
    $("#sub_valores").show();
    $("#81367868865657eea8ba0a9094814227").show();
    $("#subt_poliza").show();
    $("#85517892965657eea863bb6085915178").show();
    $("#subt_hsiniestros").show();
    $("#70029930365657eea866da2082229749").show();
    $("#subt_ppolicial").show();
    $("#15894986365657eea8bd0f2052191535").show();
    $("#subt_direccionador").show();
    $("#17233983365657eea8880d0032087370").show();
    $("#subt_friss").show();
    $("#37834123465657eea8c1164099238212").show();
    $("#subt_accidente").show();
    $("#33751146965657eea8867b4097970847").show();
    //$("#subt_ve_afectados").show();
    //$("#15565307165657eea877078043143405").show();
    $("#isubt_pe_afectados").show();
    $("#72757335765657eea8a3ea5068757906").show();
    $("#iisubt_pr_afectados").show();
    $("#80125453265657eea8be050001169192").show();
    $("#94611480865657eea8ac269071748434").show();
    $("#sub_accesorios").show();
    $("#38598074265657eea8b6072000128001").show();
    $("#sub_taller_asign").show();
    $("#47781112665657eea8b0668042786066").show();
    $("#subt_analisis_coberturas").show();
    $("#91758672765657eea88cfb3093276063").show();
    $("#sub_deducibles").show();
    $("#97590038765657eea8c5027052291288").show();

    $("#sub_legal").show();
    $("#27168820065768ecf6ec438053950907").show();
    $("#sub_prov").show();
    $("#7711155976578c19a395e12024178579").show();
    $("#sub_infSalv").show();
    $("#86763720065786dd114faf5039608023").show();
    $("#sub_precioVenta").show();
    $("#1858955726578b9083b9a50099192627").show();
    $("#sub_registro").show();
    $("#2053793746578d25b72b9b2009235826").show();

    $("#sub_informacion").show();
    $("#94556961765657eea89e266060411572").show();
    $("#sub_precio").show();
    $("#628538942657688c37ffaa5090948147").show();
    $("#sub_registro_subasta").show();


}

ocultar_todo();
mostrar_solicitud();

