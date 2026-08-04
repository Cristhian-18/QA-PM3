//created by Hwenry

let nombre_taller = $("#frm_taller").getValue();
$("#grd_valores_siniestros").hideColumn(9);

let numberRows = $("#grd_valores_siniestros").getNumberRows();
console.log(numberRows);
let valorSuma = 0;

function checkValores(newVal, oldVal) {
    valorSuma = 0;
    valorTotal = 0;
    for (let i = 1; i <= numberRows; i++) {
        if ($("#grd_valores_siniestros").getValue(i, 9) != "Negado") {
            valorSuma = valorSuma + parseInt($("#grd_valores_siniestros").getValue(i, 4));
        }
        valorTotal = valorTotal + parseInt($("#grd_valores_siniestros").getValue(i, 4));
    }
}
checkValores($("#grd_valores_siniestros").getValue(), '');
$('#grd_valores_siniestros').change(checkValores);


function accion(newValue, oldValue) {
  $("#sub_gestionrepuestos").hide();
  $("#61619725465655b4ed55658058928127").hide();

  if(newValue == 'COTIZAR'){
     $("#sub_gestionrepuestos").show();
    $("#61619725465655b4ed55658058928127").show();
  } 
}


accion();
$("#frm_accion").setOnchange(accion);

let numberRows2 = $("#grd_historial_caso").getNumberRows();
console.log(numberRows2);

for (let i = numberRows2-1; i <= numberRows2; i++) {
    let last_commment = $("#grd_historial_caso").getValue(i, 7);
    $("#frm_comentarioAnalista_ajustadorInterno").setValue(last_commment);
}
    

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
        $('#75921207865655b4ed5b3c1053457518').show()
        break
      case 'historial':
        $('#sbt_historial').show()
        $('#79094655365655b4ed40d17058683087').show()
        break
      case 'repuestos':
        $('#sub_repuestos').show()
        $("#sub_gestionrepuestos").show();
        $("#57719423965655b4ed5e193039723079").show();
        $('#sub_valores_aprobados').show()
        $('#13230486865655b4ed57598003315291').show()
        $('#57719423965655b4ed5e193039723079').show()
        $('#frm_comentarioAnalista_ajustadorInterno').show()

        break
    }
    hideRepuestos();
  })
  
  function ocultar_todo() {
    $('#frm_comentarioAnalista_ajustadorInterno').hide()
    $('#subt_friss').hide()
    $('#95547977665655b4ed87ca6055466913').hide()
    $('#43198352265655b4ed78569007990565').hide()
    $('#subt_tallerAsignado').hide()
    $('#subt_ppolicial').hide()
    $('#57796621765655b4ed83ea3082357963').hide()
    $('#subt_accesoriosRegistrados').hide()
    $('#43015877965655b4ed7d2a1016407207').hide()
    $('#subt_accidente').hide()
    $('#31053789365655b4ed53799071011166').hide()
    $('#33327433165655b4ed6abd1080464820').hide()
    $('#sub_busqueda').hide()
    $('#60259283965655b4ed68cb6009778512').hide()
    $('#subt_vehiculo').hide()
    $('#17569986565655b4ed8c995023188336').hide()
    $('#subt_asegurado').hide()
    $('#76241453365655b4ed3ad27050479402').hide()
    $('#subt_detalle').hide()
    $('#41209453665655b4ed71780023900709').hide()
    $('#subt_registro').hide()
    $('#44056937965655b4ed42c04054669455').hide()
    $('#subt_ve_afectados').hide()
    $('#93254149565655b4ed46a66057215729').hide()
    $('#isubt_pe_afectados').hide()
    $('#43602034065655b4ed6ca46084965014').hide()
    $('#iisubt_pr_afectados').hide()
    $('#46533585865655b4ed84dd4018270742').hide()
    $('#sub_docs').hide()
    $('#98325375965655b4ed45b13092827388').hide()
    $('#sub_valores').hide()
    $('#51718349165655b4ed81039097317111').hide()
    $('#subt_docs').hide()
    $('#75921207865655b4ed5b3c1053457518').hide()
    $('#sbt_historial').hide()
    $('#79094655365655b4ed40d17058683087').hide()
    $('#subt_poliza').hide()
    $('#28358068365655b4ed35473079795674').hide()
    $('#sub_repuestos').hide()
    $('#57719423965655b4ed5e193039723079').hide()
    $('#subt_hsiniestros').hide()
    $('#47330327665655b4ed38dc0072757607').hide()
    $('#subt_direccionador').hide()
    $('#83210580965655b4ed546d3053710376').hide()
    $('#subt_documentosTaller').hide()
    $('#13053029065655b4ed8da75032156816').hide()
    $('#subt_gestionTaller').hide()
    $('#16138142065655b4ed73766092455273').hide()
    $('#subt_valoresSiniestros').hide()
    $('#48813423665655b4ed48ac5080424075').hide()
    $('#subt_documentos_cotizacion').hide()
    $('#11357093065655b4ed85e43013712128').hide()
    $('#sub_valores_aprobados').hide()
    $('#13230486865655b4ed57598003315291').hide()
    
    
  }
  function mostrar_solicitud() {
    $('#frm_comentarioAnalista_ajustadorInterno').show()
    $('#subt_friss').show()
    $('#95547977665655b4ed87ca6055466913').show()
    $('#43198352265655b4ed78569007990565').show()
    $('#subt_tallerAsignado').show()
    $('#subt_ppolicial').show()
    $('#57796621765655b4ed83ea3082357963').show()
    $('#subt_accesoriosRegistrados').show()
    $('#43015877965655b4ed7d2a1016407207').show()
    $('#subt_accidente').show()
    $('#31053789365655b4ed53799071011166').show()
    $('#subt_hsiniestros').show()
    $('#sub_busqueda').show()
    $('#60259283965655b4ed68cb6009778512').show()
    $('#subt_vehiculo').show()
    $('#17569986565655b4ed8c995023188336').show()
    $('#subt_asegurado').show()
    $('#76241453365655b4ed3ad27050479402').show()
    $('#subt_detalle').show()
    $('#41209453665655b4ed71780023900709').show()
    $('#subt_registro').show()
    $('#44056937965655b4ed42c04054669455').show()
    $('#subt_ve_afectados').show()
    $('#93254149565655b4ed46a66057215729').show()
    $('#isubt_pe_afectados').show()
    $('#43602034065655b4ed6ca46084965014').show()
    $('#iisubt_pr_afectados').show()
    $('#46533585865655b4ed84dd4018270742').show()
    $('#sub_docs').show()
    $('#98325375965655b4ed45b13092827388').show()
    $('#sub_valores').show()
    $('#51718349165655b4ed81039097317111').show()
    $('#subt_poliza').show()
    $('#28358068365655b4ed35473079795674').show()
    $('#subt_historial_siniestro').show()
    $('#47330327665655b4ed38dc0072757607').show()
    $('#subt_direccionador').show()
    $('#83210580965655b4ed546d3053710376').show()
    $('#subt_documentosTaller').show()
    $('#13053029065655b4ed8da75032156816').show()
    $('#subt_gestionTaller').show()
    $('#16138142065655b4ed73766092455273').show()
    $('#subt_valoresSiniestros').show()
    $('#48813423665655b4ed48ac5080424075').show()
    $('#subt_documentos_cotizacion').show()
    $('#11357093065655b4ed85e43013712128').show()
   
}
  
  ocultar_todo()
  mostrar_solicitud()
  