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
    $("#subt_ve_afectados").hide();
    $("#15565307165657eea877078043143405").hide();
    $("#isubt_pe_afectados").hide();
    $("#72757335765657eea8a3ea5068757906").hide();
    $("#iisubt_pr_afectados").hide();
    $("#80125453265657eea8be050001169192").hide();
    $("#sub_docs").hide();
    $("#42369092065657eea875f65039015911").hide();
    $("#sub_valores").hide();
    $("#81367868865657eea8ba0a9094814227").hide();
    $("#subt_docs").hide();
    $("#23271031065657eea890261027484884").hide();
    $("#sbt_historial").hide();
    $("#38388078065657eea86f554052132558").hide();
    $("#subt_poliza").hide();
    $("#85517892965657eea863bb6085915178").hide();
    $("#83349221365657eea8935c0034368501").hide();
    $("#subt_historial_siniestro").hide();
    $("#70029930365657eea866da2082229749").hide();
    $("#66500223665657eea88bf88096551186").hide();
    $("#sub_datosFriss").hide();
    $("#37834123465657eea8c1164099238212").hide();
    $("#sub_alcance").hide();
    $("#21055464165657eea891214083340557").hide();
    
    
    
    
}
function mostrar_solicitud() {
    $("#sub_busqueda").show();
    $("#52345823565657eea89f273081823396").show();
    $("#subt_vehiculo").show();
    $("#39942008765657eea8c60e4037826925").show();
    $("#subt_asegurado").show();
    $("#77577551765657eea869184079116697").show();
    $("#subt_detalle").show();
    $("#40264027065657eea8a90a6057516237").show();
    $("#subt_registro").show();
    $("#41246456365657eea871e92041543660").show();
    $("#subt_ve_afectados").show();
    $("#15565307165657eea877078043143405").show();
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
    $("#83349221365657eea8935c0034368501").show();
    $("#subt_historial_siniestro").show();
    $("#70029930365657eea866da2082229749").show();
    $("#66500223665657eea88bf88096551186").show();
    $("#sub_datosFriss").show();
    $("#37834123465657eea8c1164099238212").show();
    $("#sub_alcance").show();
    $("#21055464165657eea891214083340557").show();
    

}

let vehiculos = $("#frm_siniestro_OtrosVehiculos").getValue();
let propiedades = $("#frm_siniestro_Propiedad").getValue();
let personas = $("#frm_siniestro_Personas").getValue();

$("#isubt_pe_afectados").hide();
$("#72757335765657eea8a3ea5068757906").hide();
$("#subt_ve_afectados").hide();
$("#15565307165657eea877078043143405").hide();
$("#iisubt_pr_afectados").hide();
$("#80125453265657eea8be050001169192").hide();

if (vehiculos == 'SI') {
    $("#subt_ve_afectados").show();
    $("#15565307165657eea877078043143405").show();
}
if (propiedades == 'SI') {
    $("#iisubt_pr_afectados").show();
    $("#80125453265657eea8be050001169192").show();
}
if (personas == 'SI') {
    $("#isubt_pe_afectados").show();
    $("#72757335765657eea8a3ea5068757906").show();
}



ocultar_todo();
mostrar_solicitud();