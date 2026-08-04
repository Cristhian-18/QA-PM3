let bandera = 0;

$("#frm_negocioPerdido_explicacionCobertura").disableValidation();
$("#frm_negocioPerdido_explicacionTasa").disableValidation();
$("#frm_negocioPerdido_explicacionBeneficios").disableValidation();
$("#frm_negocioPerdido_explicacionPrima").disableValidation();
$("#frm_negocioPerdido_explicacionComision").disableValidation();
$("#frm_negocioPerdido_explicacionMedica").disableValidation();
$("#frm_negocioPerdido_explicaiconHonorarios").disableValidation();

$("#frm_negocioPerdido_explicacionCobertura").getControl().attr('disabled', true);
$("#frm_negocioPerdido_explicacionTasa").getControl().attr('disabled', true);
$("#frm_negocioPerdido_explicacionBeneficios").getControl().attr('disabled', true);
$("#frm_negocioPerdido_explicacionPrima").getControl().attr('disabled', true);
$("#frm_negocioPerdido_explicacionComision").getControl().attr('disabled', true);
$("#frm_negocioPerdido_explicacionMedica").getControl().attr('disabled', true);
$("#frm_negocioPerdido_explicaiconHonorarios").getControl().attr('disabled', true);


function checkBandera(){
    if( 
        $("#frm_negocioPerdido_cobertura").getValue() == 1 ||
        $("#frm_negocioPerdido_tasa").getValue() == 1 ||
        $("#frm_negocioPerdido_beneficios").getValue() == 1 ||
        $("#frm_negocioPerdido_prima").getValue() == 1 ||
        $("#frm_negocioPerdido_comision").getValue() == 1 ||
        $("#frm_negocioPerdido_medica").getValue() == 1 ||
        $("#frm_negocioPerdido_honorarios").getValue() == 1
        ){
            bandera = 1;
            $("#frm_negocioPerdido_cobertura").disableValidation();
            $("#frm_negocioPerdido_tasa").disableValidation();
            $("#frm_negocioPerdido_beneficios").disableValidation();
            $("#frm_negocioPerdido_prima").disableValidation();
            $("#frm_negocioPerdido_comision").disableValidation();
            $("#frm_negocioPerdido_medica").disableValidation();
            $("#frm_negocioPerdido_honorarios").disableValidation();
        } else {
            bandera = 0;
            $("#frm_negocioPerdido_cobertura").enableValidation();
            $("#frm_negocioPerdido_tasa").enableValidation();
            $("#frm_negocioPerdido_beneficios").enableValidation();
            $("#frm_negocioPerdido_prima").enableValidation();
            $("#frm_negocioPerdido_comision").enableValidation();
            $("#frm_negocioPerdido_medica").enableValidation();
            $("#frm_negocioPerdido_honorarios").enableValidation();
        }
};

function checkCobertura(newVal, oldVal) {
    checkBandera()
    console.log("COBERTURA: " + newVal)
    if(newVal == 1){
        $("#frm_negocioPerdido_explicacionCobertura").enableValidation();
        $("#frm_negocioPerdido_explicacionCobertura").getControl().attr('disabled', false);

    } else {
        //erase
        $("#frm_negocioPerdido_explicacionCobertura").setValue("");
        $("#frm_negocioPerdido_explicacionCobertura").disableValidation();
        $("#frm_negocioPerdido_explicacionCobertura").getControl().attr('disabled', true);


    }
}
//execute when the Dynaform loads:
checkCobertura($("#frm_negocioPerdido_cobertura").getValue(), ''); 
$('#frm_negocioPerdido_cobertura').setOnchange(checkCobertura);

function checkTasa(newVal, oldVal) {
    checkBandera()
    console.log("COBERTURA: " + newVal)
    if(newVal == 1){
        $("#frm_negocioPerdido_explicacionTasa").enableValidation();
        $("#frm_negocioPerdido_explicacionTasa").getControl().attr('disabled', false);

    } else {
        //erase
        $("#frm_negocioPerdido_explicacionTasa").setValue("");
        $("#frm_negocioPerdido_explicacionTasa").disableValidation();
        $("#frm_negocioPerdido_explicacionTasa").getControl().attr('disabled', true);


    }
}
//execute when the Dynaform loads:
checkTasa($("#frm_negocioPerdido_tasa").getValue(), ''); 
$('#frm_negocioPerdido_tasa').setOnchange(checkTasa);

function checkBeneficios(newVal, oldVal) {
    checkBandera()
    console.log("COBERTURA: " + newVal)
    if(newVal == 1){
        $("#frm_negocioPerdido_explicacionBeneficios").enableValidation();
        $("#frm_negocioPerdido_explicacionBeneficios").getControl().attr('disabled', false);

    } else {
        //erase
        $("#frm_negocioPerdido_explicacionBeneficios").setValue("");
        $("#frm_negocioPerdido_explicacionBeneficios").disableValidation();
        $("#frm_negocioPerdido_explicacionBeneficios").getControl().attr('disabled', true);

    }
}
//execute when the Dynaform loads:
checkBeneficios($("#frm_negocioPerdido_beneficios").getValue(), ''); 
$('#frm_negocioPerdido_beneficios').setOnchange(checkBeneficios);

function checkPrima(newVal, oldVal) {
    checkBandera()
    console.log("COBERTURA: " + newVal)
    if(newVal == 1){
        $("#frm_negocioPerdido_explicacionPrima").enableValidation();
        $("#frm_negocioPerdido_explicacionPrima").getControl().attr('disabled', false);

    } else {
        //erase
        $("#frm_negocioPerdido_explicacionPrima").setValue("");
        $("#frm_negocioPerdido_explicacionPrima").disableValidation();
        $("#frm_negocioPerdido_explicacionPrima").getControl().attr('disabled', true);


    }
}
//execute when the Dynaform loads:
checkPrima($("#frm_negocioPerdido_prima").getValue(), ''); 
$('#frm_negocioPerdido_prima').setOnchange(checkPrima);

function checkComision(newVal, oldVal) {
    checkBandera()
    console.log("COBERTURA: " + newVal)
    if(newVal == 1){
        $("#frm_negocioPerdido_explicacionComision").enableValidation();
        $("#frm_negocioPerdido_explicacionComision").getControl().attr('disabled', false);

    } else {
        //erase
        $("#frm_negocioPerdido_explicacionComision").setValue("");
        $("#frm_negocioPerdido_explicacionComision").disableValidation();
        $("#frm_negocioPerdido_explicacionComision").getControl().attr('disabled', true);


    }
}
//execute when the Dynaform loads:
checkComision($("#frm_negocioPerdido_comision").getValue(), ''); 
$('#frm_negocioPerdido_comision').setOnchange(checkComision);

function checkMedica(newVal, oldVal) {
    checkBandera()
    console.log("COBERTURA: " + newVal)
    if(newVal == 1){
        $("#frm_negocioPerdido_explicacionMedica").enableValidation();
        $("#frm_negocioPerdido_explicacionMedica").getControl().attr('disabled', false);

    } else {
        //erase
        $("#frm_negocioPerdido_explicacionMedica").setValue("");
        $("#frm_negocioPerdido_explicacionMedica").disableValidation();
        $("#frm_negocioPerdido_explicacionMedica").getControl().attr('disabled', true);


    }
}
//execute when the Dynaform loads:
checkMedica($("#frm_negocioPerdido_medica").getValue(), ''); 
$('#frm_negocioPerdido_medica').setOnchange(checkMedica);

function checkHonorarios(newVal, oldVal) {
    checkBandera()
    console.log("COBERTURA: " + newVal)
    if(newVal == 1){
        $("#frm_negocioPerdido_explicaiconHonorarios").enableValidation();
        $("#frm_negocioPerdido_explicaiconHonorarios").getControl().attr('disabled', false);

    } else {
        //erase
        $("#frm_negocioPerdido_explicaiconHonorarios").setValue("");
        $("#frm_negocioPerdido_explicaiconHonorarios").disableValidation();
        $("#frm_negocioPerdido_explicaiconHonorarios").getControl().attr('disabled', true);

    }
}
//execute when the Dynaform loads:
checkHonorarios($("#frm_negocioPerdido_honorarios").getValue(), ''); 
$('#frm_negocioPerdido_honorarios').setOnchange(checkHonorarios);