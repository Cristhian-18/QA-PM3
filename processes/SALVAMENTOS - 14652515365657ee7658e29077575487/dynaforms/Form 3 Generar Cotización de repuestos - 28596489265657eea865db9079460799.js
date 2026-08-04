

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
}
function mostrar_solicitud(){
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
}



ocultar_todo();
mostrar_solicitud();