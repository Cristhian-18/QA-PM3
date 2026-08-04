let mundoMotriz = $("#tri_bandera_mundoMotriz").getValue();
console.log(mundoMotriz);
$("#grd_valores_siniestros").hideColumn(9);

console.log($('#grd_registro_siniestro').getControl(1, 4));

function checkGrid(newVal, oldVal) {
    console.log(newVal);
    let rowNum = 0;
    rowNum = $("#grd_registro_siniestro").getNumberRows();
    console.log(rowNum);
    for (let i = 1; i <= rowNum; i++) {
        console.log($("#grd_registro_siniestro").getControl(i, 4));
        if ($("#grd_registro_siniestro").getValue(i, 4) == "SI") {
            $("#grd_registro_siniestro").getControl(i, 6).attr('disabled', false);
        } else {
            $("#grd_registro_siniestro").getControl(i, 6).attr('disabled', true);
            $("#grd_registro_siniestro").setValue("", i, 6)
        }
    }
}

checkGrid($("#grd_registro_siniestro").getValue(), '');
$('#grd_registro_siniestro').change(checkGrid);


let numberRows = $("#grd_valores_siniestros").getNumberRows();
console.log(numberRows);
let valorSuma = 0;
for (let i = 1; i <= numberRows; i++) {
    if($("#grd_valores_siniestros").getValue(i, 7) == "DISPONIBLE"){
        $("#grd_valores_siniestros").setValue("Aprobado", i, 11);
    } else if($("#grd_valores_siniestros").getValue(i, 7) == "IMPORTACIÓN"){
        $("#grd_valores_siniestros").setValue("Pendiente", i,11);
    }  else if($("#grd_valores_siniestros").getValue(i, 7) == "FABRICACION"){
        $("#grd_valores_siniestros").setValue("Indemnizacion", i, 11);
    }
    
    for (let j = 1; j <= 11; j++) {
        if (j != 10) {
            $("#grd_valores_siniestros").getControl(i, j).attr('disabled', true);
        }
    }
}
//$("#grd_valores_siniestros").hideColumn(10);

function checkValores(newVal, oldVal) {
    valorTotal = 0;
    valorSuma = 0;
    for (let i = 1; i <= numberRows; i++) {
            valorSuma = valorSuma + parseInt($("#grd_valores_siniestros").getValue(i, 4));
        
        valorTotal = valorTotal + parseInt($("#grd_valores_siniestros").getValue(i, 4));
    }
    hideRepuestos();

}
checkValores($("#grd_valores_siniestros").getValue(), '');
$('#grd_valores_siniestros').change(checkValores);


//solo cuando es Mundo Motriz
let bandera_mundo = $("#tri_bandera_mundoMotriz").getValue();
function hideRepuestos() {
    console.log("Valor suma", valorTotal);
    //Existe una cotización de repuestos
    if (valorTotal > 0) {
        let nombre_taller = $("#frm_taller").getValue();
        //Es Mundo Motriz
        
    } else {
        for (let i = 1; i <= numberRows; i++) {
            //$("#grd_valores_siniestros").setValue("DISPONIBLE", i, 6);
        }
        $("#sub_gestionrepuestos").hide()
        $("#grd_valores_siniestros").hide()

    }
}
/*
let value = $("#frm_valoresSiniestro_totalProformado").getValue();
if (value != '') {
    //value = roundToFixed(value, 2);
    $("#grd_registro_siniestro").setValue(value, 2, 6);
}

let value2 = $("#frm_valoresAprobados_totalProformado").getValue();
if (value2 != '') {
    //value2 = roundToFixed(value2, 2);
    $("#grd_registro_siniestro").setValue(value2, 2, 7);
}*/

function changeValueRelacion(newVal, oldVal) {
    $("#frm_accion").setValue("");
    $("#frm_accion").getControl().attr('disabled', false);
    console.log(newVal);
    valorAsegurado = $("#grd_registro_siniestro").getValue(2, 5);
    valorReserva = $("#grd_registro_siniestro").getValue(2, 6);
    relacionSuma = 100 * valorReserva / valorAsegurado;
    if (relacionSuma >= 65) {
        console.log('perdida total');
        $("#frm_accion").setValue("PERDER");
        //$("#frm_accion").getControl().attr('disabled', true);
    } else {
        $("#frm_accion").setValue("");
        $("#frm_accion").getControl().attr('disabled', false);
    }
    relacionSuma = roundToFixed(relacionSuma, 2) + '%';
    $("#frm_analisisCoberturas_relacionTotal").setValue(relacionSuma);
}

changeValueRelacion($("#grd_registro_siniestro").getValue(), '');
$('#grd_registro_siniestro').change(changeValueRelacion);



function changeValueRelacion(newVal, oldVal) {
    $("#frm_accion").setValue("");
    $("#frm_accion").getControl().attr('disabled', false);
    console.log(newVal);
    valorAsegurado = $("#grd_registro_siniestro").getValue(2, 5);
    valorReserva = $("#grd_registro_siniestro").getValue(2, 6);
    relacionSuma = 100 * valorReserva / valorAsegurado;
    if (relacionSuma >= 65) {
        console.log('perdida total');
        $("#frm_accion").setValue("PERDER");
        //$("#frm_accion").getControl().attr('disabled', true);
    } else {
        $("#frm_accion").setValue("");
        $("#frm_accion").getControl().attr('disabled', false);
    }
    relacionSuma = roundToFixed(relacionSuma, 2) + '%';
    $("#frm_analisisCoberturas_relacionTotal").setValue(relacionSuma);
}

changeValueRelacion($("#grd_registro_siniestro").getValue(), '');
$('#grd_registro_siniestro').change(changeValueRelacion);


$('#frm_solicitarPeritaje_causa').hide();
$('#frm_solicitarPeritaje_nombre').hide();
$('#frm_solicitarPeritaje_correo').hide();
$('#frm_solicitarPeritaje_fechaEntrega').hide();
$('#frm_carta_noDeducible').hide();

$('#frm_solicitarPeritaje_causa').disableValidation();
$('#frm_solicitarPeritaje_nombre').disableValidation();
$('#frm_solicitarPeritaje_correo').disableValidation();
$('#frm_solicitarPeritaje_fechaEntrega').disableValidation();
$('#frm_carta_noDeducible').disableValidation();

$('#frm_cartaNegativa').hide();
$('#frm_cartaNegativa').disableValidation();
        $("#413499516656567afcedb62004747135").hide();

function action(newVal, oldVal) {
        $("#413499516656567afcedb62004747135").hide();

    $('#frm_solicitarPeritaje_causa').hide();
    $('#frm_solicitarPeritaje_nombre').hide();
    $('#frm_solicitarPeritaje_correo').hide();
    $('#frm_solicitarPeritaje_fechaEntrega').hide();
    $('#frm_carta_noDeducible').hide();


    $('#frm_solicitarPeritaje_causa').disableValidation();
    $('#frm_solicitarPeritaje_nombre').disableValidation();
    $('#frm_solicitarPeritaje_correo').disableValidation();
    $('#frm_solicitarPeritaje_fechaEntrega').disableValidation();
    $('#frm_carta_noDeducible').disableValidation();

    $('#frm_cartaNegativa').hide();
    $('#frm_cartaNegativa').disableValidation();

    if (newVal == "REQUERIR") {
        $('#frm_solicitarPeritaje_causa').show();
        $('#frm_solicitarPeritaje_nombre').show();
        $('#frm_solicitarPeritaje_correo').show();
        $('#frm_solicitarPeritaje_fechaEntrega').show();

        $('#frm_solicitarPeritaje_causa').enableValidation();
        $('#frm_solicitarPeritaje_nombre').enableValidation();
        $('#frm_solicitarPeritaje_correo').enableValidation();
        $('#frm_solicitarPeritaje_fechaEntrega').enableValidation();
    }
    if (newVal == "APROBAR") {
        $('#frm_carta_noDeducible').show();
        $('#frm_carta_noDeducible').enableValidation();
    }
    if (newVal == "NEGAR") {
        $('#frm_cartaNegativa').show();
        $('#frm_cartaNegativa').enableValidation();
        $("#413499516656567afcedb62004747135").show();

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
            checkVehiculosImplicados($("#frm_siniestro_OtrosVehiculos").getValue(), '');
            $('#frm_siniestro_OtrosVehiculos').setOnchange(checkVehiculosImplicados); //execute when field's value changes

            checkPropiedadImplicados($("#frm_siniestro_Propiedad").getValue(), '');
            $('#frm_siniestro_Propiedad').setOnchange(checkPropiedadImplicados); //execute when field's value changes

            checkPersonasImplicados($("#frm_siniestro_Personas").getValue(), '');
            $('#frm_siniestro_Personas').setOnchange(checkPersonasImplicados); //execute when field's value changes

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
            $("#sub_gestionrepuestos").show();
            $("#480602794656567afd00279083326971").show();
            $("#sub_valores_siniestros").show();
            $("#991013308656567afcf8d28052513130").show();
			//henry
			$("#subt_ve_afectados").hide();
			$("#831468248656567afce7676060479058").hide();
            break
    }
    $("#frm_documentos_otros").hide();
    hideRepuestos();
});


function ocultar_todo() {
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
    //$("#subt_ve_afectados").hide();
    //$("#831468248656567afce7676060479058").hide();
    $("#isubt_pe_afectados").hide();
    $("#516059836656567afd10a48026370985").hide();
    $("#iisubt_pr_afectados").hide();
    $("#976441291656567afd2a935002448351").hide();
    $("#sub_docs").hide();
    $("#780469005656567afce66c5098057154").hide();
    $("#sub_valores").hide();
    $('#480602794656567afd00279083326971').hide()
    $("#527111746656567afd266e9046897016").hide();
    $("#subt_docs").hide();
    $("#375344004656567afcfcd58015574466").hide();
    $("#sbt_historial").hide();
    $("#709751460656567afce0474081432341").hide();
    $("#subt_poliza").hide();
    $("#970216769656567afcd3ed7021146455").hide();
    $("#subt_hsiniestros").hide();
    $("#582336739656567afcd7d26036202949").hide();
    $("#subt_ppolicial").hide();
    $("#282239801656567afd29986025672858").hide();
    $("#subt_direccionador").hide();
    $("#489756561656567afcf5da3068863338").hide();
    $("#subt_friss").hide();
    $("#614037051656567afd2d975045685007").hide();

    $("#subt_accidente").hide();
    $("#560832659656567afcf4d25066588147").hide();
    //$("#subt_ve_afectados").hide();
    //$("#831468248656567afce7676060479058").hide();
    $("#isubt_pe_afectados").hide();
    $("#516059836656567afd10a48026370985").hide();
    $("#iisubt_pr_afectados").hide();
    $("#976441291656567afd2a935002448351").hide();
    $("#765755715656567afd18e09041007921").hide();
    $("#sub_accesorios").hide();
    $("#388204042656567afd22313001660735").hide();
    $("#sub_taller_asign").hide();
    $("#756477459656567afd1cfb3086270388").hide();
    $("#subt_analisis_coberturas").hide();
    $("#547976094656567afcf9d53019630989").hide();

    $("#sub_gestionrepuestos").hide();
    $("#sub_valores_siniestros").hide();
    $("#991013308656567afcf8d28052513130").hide();
   $("#sub_deducibles").hide();
    $("#970120515656567afd31875022633165").hide();

    



}
function mostrar_solicitud() {
    $("#sub_busqueda").show();
    $("#718299480656567afd0c6f5055771758").show();
    $("#subt_vehiculo").show();
    $("#565843896656567afd328b8087596694").show();
    $("#subt_asegurado").show();
    $("#142725203656567afcda002050435920").show();
    //$("#subt_detalle").show();
    //$("#624298983656567afd15b60051714541").show();
    $("#subt_registro").show();
    $("#601939553656567afce2703072259389").show();
    //$("#subt_ve_afectados").show();
    //$("#831468248656567afce7676060479058").show();
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
    $("#subt_hsiniestros").show();
    $("#582336739656567afcd7d26036202949").show();
    $("#subt_ppolicial").show();
    $("#282239801656567afd29986025672858").show();
    $("#subt_direccionador").show();
    $("#489756561656567afcf5da3068863338").show();
    $("#subt_friss").show();
    $("#614037051656567afd2d975045685007").show();
    $("#subt_accidente").show();
    $("#560832659656567afcf4d25066588147").show();
    //$("#subt_ve_afectados").show();
    //$("#831468248656567afce7676060479058").show();
    $("#isubt_pe_afectados").show();
    $("#516059836656567afd10a48026370985").show();
    $("#iisubt_pr_afectados").show();
    $("#976441291656567afd2a935002448351").show();
    $("#765755715656567afd18e09041007921").show();
    $("#sub_accesorios").show();
    $("#388204042656567afd22313001660735").show();
    $("#sub_taller_asign").show();
    $("#756477459656567afd1cfb3086270388").show();
    $("#subt_analisis_coberturas").show();
    $("#547976094656567afcf9d53019630989").show();
  $("#sub_deducibles").show();
    $("#970120515656567afd31875022633165").show();
}

ocultar_todo();
mostrar_solicitud();

let vehiculos = $("#frm_siniestro_OtrosVehiculos").getValue();
let propiedades = $("#frm_siniestro_Propiedad").getValue();
let personas = $("#frm_siniestro_Personas").getValue();

$("#isubt_pe_afectados").hide();
$("#516059836656567afd10a48026370985").hide();
$("#subt_ve_afectados").hide();
$("#831468248656567afce7676060479058").hide();
$("#iisubt_pr_afectados").hide();
$("#976441291656567afd2a935002448351").hide();

if (vehiculos == 'SI') {
    $("#subt_ve_afectados").show();
    $("#831468248656567afce7676060479058").show();
}
if (propiedades == 'SI') {
    $("#iisubt_pr_afectados").show();
    $("#976441291656567afd2a935002448351").show();
}
if (personas == 'SI') {
    $("#isubt_pe_afectados").show();
    $("#516059836656567afd10a48026370985").show();
}

$("#frm_valoresAprobados_valoresRepuestos1").disableValidation();
$("#frm_valoresAprobados_procentajeDescuentoProformado").disableValidation();
$("#frm_valoresAprobados_valorRepuestosProformado").disableValidation();
$("#frm_valoresAprobados_totalProformado").disableValidation();

