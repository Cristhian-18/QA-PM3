
let numberRows = $("#grd_registro_INVEC").getNumberRows();
console.log(numberRows);

for (let i = 1; i <= numberRows; i++) {
    for (let j = 1; j <= 2; j++) {
        if (i != 1) {
            $("#grd_registro_INVEC").getControl(i, j).attr('disabled', true);
        } else {
            let accion = $("#grd_registro_INVEC").getValue(i, 1);
            if (accion != '' && accion != null) {
                $("#grd_registro_INVEC").getControl(i, j).attr('disabled', true);
            }
        }
        //$("#grd_valores_siniestros").getControl(i, j).attr('hidden');
    }
}

$("#frm_INVEC_valorInsoluto").setValue('');

function valorInsoluto(newVal, oldVal) {
    var value = newVal;
    if (value != '') {
        value = roundToFixed(value, 2);
    }
        $("#frm_INVEC_valorInsoluto").setValue(value);
    
}
valorInsoluto($("#frm_INVEC_valorInsoluto").getValue(), '');
$("#frm_INVEC_valorInsoluto").setOnchange(valorInsoluto);


function action(newVal, oldVal) {
    $("#frm_INVEC_valorInsoluto").hide();
    $("#frm_INVEC_valorInsoluto").disableValidation();
    $("#884070260657619960bd635090368551").hide();
    $("#sub_legalSalvamento").hide();
    $("#446491751657615ee541126034606936").hide();
              $("#file_saldoInsoluto").hide();

    $("#frm_legalInvec_enajenacion").disableValidation();
    $("#frm_legalInvec_enajenacionFecha").disableValidation();
    $("#frm_legalInvec_prendado").disableValidation();
    $("#frm_legalInvec_prendaFecha").disableValidation();
    $("#frm_legalInvec_bloqueo").disableValidation();
    $("#frm_legalInvec_bloqueoFecha").disableValidation();

    $("#frm_legalInvec_legalizacionDocs").disableValidation();
    $("#frm_legalInvec_fechaFin").disableValidation();
    $("#frm_legalInvec_fechaCesion").disableValidation();
    $("#frm_legalInvec_fechaCompraVenta").disableValidation();

    $("#file_validacionMultas").disableValidation();
    $("#file_validacionSRI").disableValidation();
    $("#file_documentos_respaldoIMVEC").hide();

    $("#tri_user_imvec").hide();

    if (newVal == 'CONTINUAR') {
        $("#sub_legalSalvamento").show();
        $("#446491751657615ee541126034606936").show();

        $("#frm_legalInvec_enajenacion").enableValidation();
        $("#frm_legalInvec_prendado").enableValidation();
        $("#frm_legalInvec_bloqueo").enableValidation();
        $("#frm_legalInvec_legalizacionDocs").enableValidation();
        $("#frm_legalInvec_fechaFin").enableValidation();
        $("#frm_legalInvec_fechaCesion").enableValidation();
        $("#frm_legalInvec_fechaCompraVenta").enableValidation();

        $("#file_validacionMultas").enableValidation();
        $("#file_validacionSRI").enableValidation();

    }
    if (newVal == 'MANTENER') {
        $("#884070260657619960bd635090368551").show();
    }
    if (newVal == 'PAGAR') {
        $("#frm_INVEC_valorInsoluto").show();
        $("#frm_INVEC_valorInsoluto").enableValidation();
              $("#file_saldoInsoluto").show();

    }
  	if(newVal == "REASIGNAR"){
        $("#tri_user_imvec").show();
    }
    if(newVal == "RESPALDO"){
        $("#file_documentos_respaldoIMVEC").show();
    }

}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);


$('.menu').on('click', function () {
    ocultar_todo();
    console.log(this.id)
    console.log("CAMBIO")
    switch (this.id) {
        case 'solicitud':
            mostrar_solicitud();
            break;
        case 'repuestos':
            $("#sub_taller").show();
            $("#489756561656567afcf5da3068863338").show();
            $("#765755715656567afd18e09041007921").show();
            break;
        case 'documentos':
            $("#sub_documentos_caso").show();
            $("#375344004656567afcfcd58015574466").show();
            break;
        case 'historial':
            $("#sub_historial_caso").show();
            $("#709751460656567afce0474081432341").show();
            break;
    }
});


function ocultar_todo() {

    $("#614037051656567afd2d975045685007").hide();

    $("#subt_poliza").hide();
    $("#970216769656567afcd3ed7021146455").hide();
    $("#sub_busqueda").hide();
    $("#718299480656567afd0c6f5055771758").hide();
    $("#subt_registro").hide();
    $("#601939553656567afce2703072259389").hide();
    $("#subt_dvehiculo").hide();
    $("#702321057656567afd0b5f8055682937").hide();
    $("#subt_ppolicial").hide();
    $("#282239801656567afd29986025672858").hide();
    $("#subt_asegurado").hide();
    $("#142725203656567afcda002050435920").hide();
    $("#subt_accidente").hide();
    $("#560832659656567afcf4d25066588147").hide();
    $("#subt_danios").hide();
    $("#624298983656567afd15b60051714541").hide();
    $("#subt_ve_afectados").hide();
    $("#831468248656567afce7676060479058").hide();

    $("#isubt_pe_afectados").hide();
    $("#516059836656567afd10a48026370985").hide();
    $("#iisubt_pr_afectados").hide();
    $("#976441291656567afd2a935002448351").hide();
    $("#sub_taller").hide();
    $("#489756561656567afcf5da3068863338").hide();
    $("#765755715656567afd18e09041007921").hide();


    $("#sub_accesorios").hide();
    $("#388204042656567afd22313001660735").hide();
    $("#subt_historial").hide();
    $("#582336739656567afcd7d26036202949").hide();
    $("#sub_docs").hide();
    $("#780469005656567afce66c5098057154").hide();
    $("#765755715656567afd18e09041007921").hide();

    $("#sub_historial_caso").hide();
    $("#709751460656567afce0474081432341").hide();
    $("#sub_documentos_caso").hide();
    $("#375344004656567afcfcd58015574466").hide();
}
function mostrar_solicitud() {
    $("#614037051656567afd2d975045685007").show();

    $("#subt_poliza").show();
    $("#970216769656567afcd3ed7021146455").show();
    $("#sub_busqueda").show();
    $("#718299480656567afd0c6f5055771758").show();
    $("#subt_registro").show();
    $("#601939553656567afce2703072259389").show();
    $("#subt_dvehiculo").show();
    $("#702321057656567afd0b5f8055682937").show();
    $("#subt_ppolicial").show();
    $("#282239801656567afd29986025672858").show();
    $("#subt_asegurado").show();
    $("#142725203656567afcda002050435920").show();
    $("#subt_accidente").show();
    $("#560832659656567afcf4d25066588147").show();
    $("#subt_danios").show();
    $("#624298983656567afd15b60051714541").show();
    $("#subt_ve_afectados").show();
    $("#831468248656567afce7676060479058").show();

    $("#isubt_pe_afectados").show();
    $("#516059836656567afd10a48026370985").show();
    $("#iisubt_pr_afectados").show();
    $("#976441291656567afd2a935002448351").show();



    $("#sub_accesorios").show();
    $("#388204042656567afd22313001660735").show();
    $("#subt_historial").show();
    $("#582336739656567afcd7d26036202949").show();
    $("#sub_docs").show();
    $("#780469005656567afce66c5098057154").show();

}

let vehiculos = $("#frm_siniestro_OtrosVehiculos").getValue();
let propiedades = $("#frm_siniestro_Propiedad").getValue();
let personas = $("#frm_siniestro_Personas").getValue();

$("#isubt_pe_afectados").hide();
$("#59581944164a84e6bc66f02025995827").hide();
$("#subt_ve_afectados").hide();
$("#24440509064a84d82d7a6e4090951046").hide();
$("#iisubt_pr_afectados").hide();
$("#83626962464a84f217fbb30019736581").hide();

if (vehiculos == 'SI') {
    $("#subt_ve_afectados").show();
    $("#24440509064a84d82d7a6e4090951046").show();
}
if (propiedades == 'SI') {
    $("#iisubt_pr_afectados").show();
    $("#83626962464a84f217fbb30019736581").show();
}
if (personas == 'SI') {
    $("#isubt_pe_afectados").show();
    $("#59581944164a84e6bc66f02025995827").show();
}



ocultar_todo();
mostrar_solicitud();
