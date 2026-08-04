let numberRows = $("#grd_valores_siniestros").getNumberRows();
console.log(numberRows);

for (let i = 1; i <= numberRows; i++) {
    for (let j = 1; j <= 9; j++) {
        if(j!=7){
            $("#grd_valores_siniestros").getControl(i,j).attr('disabled', true);

        }
    }
}

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
          $("#375344004656567afcfcd58015574466").show();
          break;
      case 'historial':
        $("#sbt_historial").show();
        $("#709751460656567afce0474081432341").show();
          break;
          case 'repuestos':
        $("#sub_repuestos").show();
        $("#384439457656567afceab65011611057").show();
      $("#480602794656567afd00279083326971").show();

          break;
  }
});


function ocultar_todo() {
 
  $("#subt_friss").hide();
  $("#614037051656567afd2d975045685007").hide();
  $("#756477459656567afd1cfb3086270388").hide();
  $("#subt_tallerAsignado").hide();
  $("#subt_ppolicial").hide();
  $("#282239801656567afd29986025672858").hide();
  $("#subt_accesoriosRegistrados").hide();
  $("#388204042656567afd22313001660735").hide();
  $("#subt_accidente").hide();
  $("#560832659656567afcf4d25066588147").hide();
  $("#735645906656567afd0e8b4088103117").hide();
$("#sub_busqueda").hide();
$("#718299480656567afd0c6f5055771758").hide();
$("#subt_vehiculo").hide();
$("#565843896656567afd328b8087596694").hide();
$("#subt_asegurado").hide();
$("#142725203656567afcda002050435920").hide();
$("#subt_detalle").hide();
$("#624298983656567afd15b60051714541").hide();
$("#subt_registro").hide();
$("#601939553656567afce2703072259389").hide();
$("#subt_ve_afectados").hide();
$("#831468248656567afce7676060479058").hide();
$("#isubt_pe_afectados").hide();
$("#516059836656567afd10a48026370985").hide();
$("#iisubt_pr_afectados").hide();
$("#976441291656567afd2a935002448351").hide();
$("#sub_docs").hide();
$("#780469005656567afce66c5098057154").hide();
$("#sub_valores").hide();
$("#527111746656567afd266e9046897016").hide();
$("#subt_docs").hide();
$("#375344004656567afcfcd58015574466").hide();
$("#sbt_historial").hide();
$("#709751460656567afce0474081432341").hide();
$("#subt_poliza").hide();
$("#970216769656567afcd3ed7021146455").hide();
$("#sub_repuestos").hide();
$("#480602794656567afd00279083326971").hide();
$("#subt_hsiniestros").hide();
$("#582336739656567afcd7d26036202949").hide();


}
function mostrar_solicitud(){
  
  $("#subt_friss").show();
  $("#614037051656567afd2d975045685007").show();
  $("#756477459656567afd1cfb3086270388").show();
  $("#subt_tallerAsignado").show();
  $("#subt_ppolicial").show();
  $("#282239801656567afd29986025672858").show();
  $("#subt_accesoriosRegistrados").show();
  $("#388204042656567afd22313001660735").show();
  $("#subt_accidente").show();
  $("#560832659656567afcf4d25066588147").show();

$("#sub_busqueda").show();
$("#718299480656567afd0c6f5055771758").show();
$("#subt_vehiculo").show();
$("#565843896656567afd328b8087596694").show();
$("#subt_asegurado").show();
$("#142725203656567afcda002050435920").show();
$("#subt_detalle").show();
$("#624298983656567afd15b60051714541").show();
$("#subt_registro").show();
$("#601939553656567afce2703072259389").show();
$("#subt_ve_afectados").show();
$("#831468248656567afce7676060479058").show();
$("#isubt_pe_afectados").show();
$("#516059836656567afd10a48026370985").show();
$("#iisubt_pr_afectados").show();
$("#976441291656567afd2a935002448351").show();
$("#sub_docs").show();
$("#780469005656567afce66c5098057154").show();
$("#sub_valores").show();
$("#527111746656567afd266e9046897016").show();
$("#subt_poliza").show();
$("#970216769656567afcd3ed7021146455").show();
$("#subt_historial_siniestro").show();
$("#582336739656567afcd7d26036202949").show();

}



ocultar_todo();
mostrar_solicitud();