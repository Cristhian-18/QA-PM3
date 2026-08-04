let mundoMotriz = $("#tri_bandera_mundoMotriz").getValue();
$("#57719423965655b4ed5e193039723079").show();
console.log(mundoMotriz);
$("#grd_valores_siniestros").hideColumn(9);
$("#frm_valoresAprobados_manoObraProformada").disableValidation();
$("#frm_valoresAprobados_diasEstimadosReparacion").disableValidation();
console.log($('#grd_registro_siniestro').getControl(1, 4));
 
 

 
$("#frm_siniestro_informacionResponsable").disableValidation();
$('#frm_requiere_PartePolicia').disableValidation();

// AGREGAR ESTO - asignarle un valor por defecto
$("#frm_requiere_PartePolicia").setValue("NO");

$("#frm_deducible_ProcentajeSiniestro").disableValidation();
$("#frm_deducible_ValorMinimo").disableValidation();

 


function checkGrid(newVal, oldVal) {
    try {
        let rowNum = $("#grd_registro_siniestro").getNumberRows();
        for (let i = 1; i <= rowNum; i++) {
            let val4 = $("#grd_registro_siniestro").getValue(i, 4);
            let ctrl6 = $("#grd_registro_siniestro").getControl(i, 6);
            if (!ctrl6 || ctrl6.length === 0) continue;
            if (val4 == "SI") {
                ctrl6.prop('disabled', false);
            } else {
                ctrl6.prop('disabled', true);
                ctrl6.val(""); // sin trigger, sin setValue
            }
        }
    } catch(e) {
        console.warn("[checkGrid] error capturado:", e.message);
    }
}

setTimeout(function() {
    checkGrid($("#grd_registro_siniestro").getValue(), '');
}, 400);

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
        let val = parseFloat($("#grd_valores_siniestros").getValue(i, 4)) || 0;
        valorSuma += val;
        valorTotal += val;
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
        $("#sub_gestionrepuestos").show()
       $("#57719423965655b4ed5e193039723079").show();
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
        $("#66043585565655b4ed4c8d2031469461").hide();

function action(newVal, oldVal) {
    $("#66043585565655b4ed4c8d2031469461").hide();

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

    $('#frm_asegurado_tipo').disableValidation();
    // $('#frm_conductor_identificacion').disableValidation();
    // $('#frm_conductor_nombres').disableValidation();
    // $('#frm_conductor_telefono').disableValidation();
    $('#frm_conductor_relacion').disableValidation();
    $('#frm_conductor_relacion_otro').disableValidation();


    $('#frm_requiere_PartePolicia').disableValidation();
    $('#frm_requiere_AsesoriaLegal').disableValidation();
    $('#frm_siniestro_seConsidera').disableValidation();
    /*$('#frm_siniestro_informacionResponsable').disableValidation();
    $('#frm_siniestro_placaResponsable').disableValidation();
    $('#frm_siniestro_nombreResponsable').disableValidation();*/

    $('#frm_accidente_pais').disableValidation();
    $('#frm_accidente_provincia').disableValidation();
    $('#frm_accidente_ciudad').disableValidation();
    $('#frm_siniestro_direccion').disableValidation();
    $('#frm_siniestro_detalle').disableValidation();
    $('#frm_requiere_PartePolicial').disableValidation();

    
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
        $("#66043585565655b4ed4c8d2031469461").show();

    }
    if (newVal == "CONTINUAR" || newVal == "VERIFICAR" || newVal == "INDEMNIZAR" || newVal == "PERDER" || newVal == "REQUERIR" || newVal == "APROBAR" || newVal == "NEGAR") {

        

        $('#frm_asegurado_tipo').enableValidation();
        $('#frm_conductor_relacion').enableValidation();
        $('#frm_requiere_AsesoriaLegal').enableValidation();
        $('#frm_siniestro_seConsidera').enableValidation();
        $('#frm_accidente_pais').enableValidation();
        $('#frm_accidente_provincia').enableValidation();
        $('#frm_accidente_ciudad').enableValidation();
        $('#frm_siniestro_direccion').enableValidation();
        $('#frm_siniestro_detalle').enableValidation();
        $('#frm_requiere_PartePolicial').enableValidation();

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
            $("#75921207865655b4ed5b3c1053457518").show();
            break;
        case 'historial':
            $("#sbt_historial").show();
            $("#79094655365655b4ed40d17058683087").show();
            break;
        case 'repuestos':
            $("#sub_gestionrepuestos").show();
            $("#57719423965655b4ed5e193039723079").show();
           
 
        
            $("#sub_valores_siniestros").show();
            $("#13230486865655b4ed57598003315291").show();
		 
			$("#subt_ve_afectados").hide();
			$("#93254149565655b4ed46a66057215729").hide();
            break
    }
    $("#frm_documentos_otros").hide();
    hideRepuestos();
});


function ocultar_todo() {
    $("#sub_busqueda").hide();
    $("#60259283965655b4ed68cb6009778512").hide();
    $("#subt_vehiculo").hide();
    $("#17569986565655b4ed8c995023188336").hide();
    $("#subt_asegurado").hide();
    $("#76241453365655b4ed3ad27050479402").hide();
    $("#subt_detalle").hide();
    $("#41209453665655b4ed71780023900709").hide();
    $("#subt_registro").hide();
    $("#44056937965655b4ed42c04054669455").hide();
    //$("#subt_ve_afectados").hide();
    //$("#93254149565655b4ed46a66057215729").hide();
    $("#isubt_pe_afectados").hide();
    $("#43602034065655b4ed6ca46084965014").hide();
    $("#iisubt_pr_afectados").hide();
    $("#46533585865655b4ed84dd4018270742").hide();
    $("#sub_docs").hide();
    $("#98325375965655b4ed45b13092827388").hide();
    $("#sub_valores").hide();
  //  $('#57719423965655b4ed5e193039723079').hide()
    $("#51718349165655b4ed81039097317111").hide();
    $("#subt_docs").hide();
    $("#75921207865655b4ed5b3c1053457518").hide();
    $("#sbt_historial").hide();
    $("#79094655365655b4ed40d17058683087").hide();
    $("#subt_poliza").hide();
    $("#28358068365655b4ed35473079795674").hide();
    $("#subt_hsiniestros").hide();
    $("#47330327665655b4ed38dc0072757607").hide();
    $("#subt_ppolicial").hide();
    $("#57796621765655b4ed83ea3082357963").hide();
    $("#subt_direccionador").hide();
    $("#83210580965655b4ed546d3053710376").hide();
    $("#subt_friss").hide();
    $("#95547977665655b4ed87ca6055466913").hide();

    $("#subt_accidente").hide();
    $("#31053789365655b4ed53799071011166").hide();
    //$("#subt_ve_afectados").hide();
    //$("#93254149565655b4ed46a66057215729").hide();
    $("#isubt_pe_afectados").hide();
    $("#43602034065655b4ed6ca46084965014").hide();
    $("#iisubt_pr_afectados").hide();
    $("#46533585865655b4ed84dd4018270742").hide();
    $("#81475448765655b4ed746c3049785877").hide();
    $("#sub_accesorios").hide();
    $("#43015877965655b4ed7d2a1016407207").hide();
    $("#sub_taller_asign").hide();
    $("#43198352265655b4ed78569007990565").hide();
    $("#subt_analisis_coberturas").hide();
    $("#75783003565655b4ed584d5025482593").hide();

    $("#sub_gestionrepuestos").show();
   $("#57719423965655b4ed5e193039723079").show();
  
    $("#sub_valores_siniestros").hide();
    $("#13230486865655b4ed57598003315291").hide();
   $("#sub_deducibles").hide();
    $("#49472546965655b4ed8baa6093274134").hide();

    



}
function mostrar_solicitud() {
    $("#sub_busqueda").show();
    $("#60259283965655b4ed68cb6009778512").show();
    $("#subt_vehiculo").show();
    $("#17569986565655b4ed8c995023188336").show();
    $("#subt_asegurado").show();
    $("#76241453365655b4ed3ad27050479402").show();
    //$("#subt_detalle").show();
    //$("#41209453665655b4ed71780023900709").show();
    $("#subt_registro").show();
    $("#44056937965655b4ed42c04054669455").show();
    //$("#subt_ve_afectados").show();
    //$("#93254149565655b4ed46a66057215729").show();
    $("#isubt_pe_afectados").show();
    $("#43602034065655b4ed6ca46084965014").show();
    $("#iisubt_pr_afectados").show();
    $("#46533585865655b4ed84dd4018270742").show();
    $("#sub_docs").show();
    $("#98325375965655b4ed45b13092827388").show();
    $("#sub_valores").show();
    $("#51718349165655b4ed81039097317111").show();
    $("#subt_poliza").show();
    $("#28358068365655b4ed35473079795674").show();
    $("#subt_hsiniestros").show();
    $("#47330327665655b4ed38dc0072757607").show();
    $("#subt_ppolicial").show();
    $("#57796621765655b4ed83ea3082357963").show();
    $("#subt_direccionador").show();
    $("#83210580965655b4ed546d3053710376").show();
    $("#subt_friss").show();
    $("#95547977665655b4ed87ca6055466913").show();
    $("#subt_accidente").show();
    $("#31053789365655b4ed53799071011166").show();
    //$("#subt_ve_afectados").show();
    //$("#93254149565655b4ed46a66057215729").show();
    $("#isubt_pe_afectados").show();
    $("#43602034065655b4ed6ca46084965014").show();
    $("#iisubt_pr_afectados").show();
    $("#46533585865655b4ed84dd4018270742").show();
    $("#81475448765655b4ed746c3049785877").show();
    $("#sub_accesorios").show();
    $("#43015877965655b4ed7d2a1016407207").show();
    $("#sub_taller_asign").show();
    $("#43198352265655b4ed78569007990565").show();
    $("#subt_analisis_coberturas").show();
    $("#75783003565655b4ed584d5025482593").show();
  $("#sub_deducibles").show();
    $("#49472546965655b4ed8baa6093274134").show();
}

ocultar_todo();
mostrar_solicitud();

let vehiculos = $("#frm_siniestro_OtrosVehiculos").getValue();
let propiedades = $("#frm_siniestro_Propiedad").getValue();
let personas = $("#frm_siniestro_Personas").getValue();

$("#isubt_pe_afectados").hide();
$("#43602034065655b4ed6ca46084965014").hide();
$("#subt_ve_afectados").hide();
$("#93254149565655b4ed46a66057215729").hide();
$("#iisubt_pr_afectados").hide();
$("#46533585865655b4ed84dd4018270742").hide();

if (vehiculos == 'SI') {
    $("#subt_ve_afectados").show();
    $("#93254149565655b4ed46a66057215729").show();
}
if (propiedades == 'SI') {
    $("#iisubt_pr_afectados").show();
    $("#46533585865655b4ed84dd4018270742").show();
}
if (personas == 'SI') {
    $("#isubt_pe_afectados").show();
    $("#43602034065655b4ed6ca46084965014").show();
}

$("#frm_valoresAprobados_valoresRepuestos1").disableValidation();
$("#frm_valoresAprobados_procentajeDescuentoProformado").disableValidation();
$("#frm_valoresAprobados_valorRepuestosProformado").disableValidation();
$("#frm_valoresAprobados_totalProformado").disableValidation();

$("#57719423965655b4ed5e193039723079").show();

setTimeout(function() {
    var submitBtn = document.querySelector('.pmdynaform-field-submit button');
    if (submitBtn) {
        // Guardar el click original
        var originalClick = submitBtn.onclick;
        
        // Reemplazar con nuevo comportamiento
        submitBtn.addEventListener('click', function(e) {
            // Remover validaciones del grid antes de enviar
            var rowsRep = $("#grd_valores_siniestros").getNumberRows();
            for (var i = 1; i <= rowsRep; i++) {
                $("#grd_valores_siniestros").getControl(i, 5).removeAttr('required');
                $("#grd_valores_siniestros").getControl(i, 6).removeAttr('required');
                $("#grd_valores_siniestros").getControl(i, 5).attr('required', false);
                $("#grd_valores_siniestros").getControl(i, 6).attr('required', false);
            }
        }, true); // true = captura antes que ProcessMaker
    }
}, 1500);