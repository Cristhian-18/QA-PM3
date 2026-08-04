let mundoMotriz = $("#tri_bandera_mundoMotriz").getValue();
console.log(mundoMotriz);
$("#grd_valores_siniestros").hideColumn(9);
$("#frm_valoresAprobados_manoObraProformada").disableValidation();
$("#frm_valoresAprobados_diasEstimadosReparacion").disableValidation();


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


 
let bandera_mundo = $("#tri_bandera_mundoMotriz").getValue();
function hideRepuestos() {
    console.log("Valor suma", valorTotal);
    //Existe una cotización de repuestos
    if (valorTotal > 0) {
        let nombre_taller = $("#frm_taller").getValue();
      
        
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
/*
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

//changeValueRelacion($("#grd_registro_siniestro").getValue(), '');
//$('#grd_registro_siniestro').change(changeValueRelacion);

*/

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
        $("#279455812654d1ab585c912082491027").hide();

function action(newVal, oldVal) {



    if (newVal == "CONTINUAR") {

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
            $("#418835952652a78d09ec638009652152").show();
            break;
        case 'historial':
            $("#sbt_historial").show();
            $("#200528691652a78b49077a9030935355").show();
            break;
        case 'repuestos':
            $("#sub_gestionrepuestos").show();
            $("#470410481653944a172eeb1027144131").show();
            $("#sub_valores_siniestros").show();
            $("#38051173965398bc04c3a10085381199").show();
			//henry
			$("#subt_ve_afectados").hide();
			$("#24440509064a84d82d7a6e4090951046").hide();
            break
    }
    $("#frm_documentos_otros").hide();
    hideRepuestos();
});


function ocultar_todo() {
    $("#sub_busqueda").hide();
    $("#56711039964a8241d124701020566530").hide();
    $("#subt_vehiculo").hide();
    $("#95746246564a4a9c711dfb2023501124").hide();
    $("#subt_asegurado").hide();
    $("#15180521364a5eaf5f02815065887190").hide();
    $("#subt_detalle").hide();
    $("#61446768964a848b295ae19072670821").hide();
    $("#subt_registro").hide();
    $("#22536303964a5e5cc12a673090504456").hide();
    //$("#subt_ve_afectados").hide();
    //$("#24440509064a84d82d7a6e4090951046").hide();
    $("#isubt_pe_afectados").hide();
    $("#59581944164a84e6bc66f02025995827").hide();
    $("#iisubt_pr_afectados").hide();
    $("#83626962464a84f217fbb30019736581").hide();
    $("#sub_docs").hide();
    $("#24155013164a5edc37a3b68095174528").hide();
    $("#sub_valores").hide();
    $('#470410481653944a172eeb1027144131').hide()
    $("#79905380564f7ece7bc8989091267394").hide();
    $("#subt_docs").hide();
    $("#418835952652a78d09ec638009652152").hide();
    $("#sbt_historial").hide();
    $("#200528691652a78b49077a9030935355").hide();
    $("#subt_poliza").hide();
    $("#12366487464a4a855bed4c8081629548").hide();
    $("#subt_hsiniestros").hide();
    $("#14870785564a5e392d24239097281950").hide();
    $("#subt_ppolicial").hide();
    $("#82315095164a5ea0d445d33098806451").hide();
    $("#subt_direccionador").hide();
    $("#34599290264a5ec882dda43091413149").hide();
    $("#subt_friss").hide();
    $("#88678649164f7eaea023df2027918886").hide();

    $("#subt_accidente").hide();
    $("#342283484650ba7c9f2fd13056558401").hide();
    //$("#subt_ve_afectados").hide();
    //$("#24440509064a84d82d7a6e4090951046").hide();
    $("#isubt_pe_afectados").hide();
    $("#59581944164a84e6bc66f02025995827").hide();
    $("#iisubt_pr_afectados").hide();
    $("#83626962464a84f217fbb30019736581").hide();
    $("#65277878264f7ec384dd014099215285").hide();
    $("#sub_accesorios").hide();
    $("#757211058653970103ff5d0031705379").hide();
    $("#sub_taller_asign").hide();
    $("#711981759653951b01d9fc7055662056").hide();
    $("#subt_analisis_coberturas").hide();
    $("#382364427653ad52ac14dd0015953831").hide();

    $("#sub_gestionrepuestos").hide();
    $("#sub_valores_siniestros").hide();
    $("#38051173965398bc04c3a10085381199").hide();
   $("#sub_deducibles").hide();
    $("#9392191066554eaa66da190035332083").hide();

    



}
function mostrar_solicitud() {
    $("#sub_busqueda").show();
    $("#56711039964a8241d124701020566530").show();
    $("#subt_vehiculo").show();
    $("#95746246564a4a9c711dfb2023501124").show();
    $("#subt_asegurado").show();
    $("#15180521364a5eaf5f02815065887190").show();
    //$("#subt_detalle").show();
    //$("#61446768964a848b295ae19072670821").show();
    $("#subt_registro").show();
    $("#22536303964a5e5cc12a673090504456").show();
    //$("#subt_ve_afectados").show();
    //$("#24440509064a84d82d7a6e4090951046").show();
    $("#isubt_pe_afectados").show();
    $("#59581944164a84e6bc66f02025995827").show();
    $("#iisubt_pr_afectados").show();
    $("#83626962464a84f217fbb30019736581").show();
    $("#sub_docs").show();
    $("#24155013164a5edc37a3b68095174528").show();
    $("#sub_valores").show();
    $("#79905380564f7ece7bc8989091267394").show();
    $("#subt_poliza").show();
    $("#12366487464a4a855bed4c8081629548").show();
    $("#subt_hsiniestros").show();
    $("#14870785564a5e392d24239097281950").show();
    $("#subt_ppolicial").show();
    $("#82315095164a5ea0d445d33098806451").show();
    $("#subt_direccionador").show();
    $("#34599290264a5ec882dda43091413149").show();
    $("#subt_friss").show();
    $("#88678649164f7eaea023df2027918886").show();
    $("#subt_accidente").show();
    $("#342283484650ba7c9f2fd13056558401").show();
    //$("#subt_ve_afectados").show();
    //$("#24440509064a84d82d7a6e4090951046").show();
    $("#isubt_pe_afectados").show();
    $("#59581944164a84e6bc66f02025995827").show();
    $("#iisubt_pr_afectados").show();
    $("#83626962464a84f217fbb30019736581").show();
    $("#65277878264f7ec384dd014099215285").show();
    $("#sub_accesorios").show();
    $("#757211058653970103ff5d0031705379").show();
    $("#sub_taller_asign").show();
    $("#711981759653951b01d9fc7055662056").show();
    $("#subt_analisis_coberturas").show();
    $("#382364427653ad52ac14dd0015953831").show();
  $("#sub_deducibles").show();
    $("#9392191066554eaa66da190035332083").show();
}

ocultar_todo();
mostrar_solicitud();

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

$("#frm_valoresAprobados_valoresRepuestos1").disableValidation();
$("#frm_valoresAprobados_procentajeDescuentoProformado").disableValidation();
$("#frm_valoresAprobados_valorRepuestosProformado").disableValidation();
$("#frm_valoresAprobados_totalProformado").disableValidation();

$("#frm_siniestro_OtrosVehiculos").disableValidation();
$("#frm_siniestro_Propiedad").disableValidation();
$("#frm_siniestro_Personas").disableValidation();
$("#frm_requiere_AsesoriaLegal").disableValidation();

