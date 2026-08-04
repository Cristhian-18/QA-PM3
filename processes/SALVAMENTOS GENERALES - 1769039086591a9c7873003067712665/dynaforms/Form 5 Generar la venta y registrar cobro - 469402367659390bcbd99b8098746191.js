$("#grd_registro_pagos").hideColumn(9);

$('.menu').on('click', function () {
    ocultar_todo();
    console.log(this.id)
    console.log("CAMBIO")
    switch (this.id) {
        case 'solicitud':
            mostrar_solicitud();
            break;
        case 'documentos':
            $("#sub_documentos").show();
            $("#92853227165931f54609887007781137").show();        
            break;
        case 'historial':
            $("#sub_historial").show();
            $("#47021317065931f0e2db040023291496").show();        
            break;
    }
});


function ocultar_todo() {
    $("#sub_gestion").hide();
    $("#2309144536593215e2e8ba8034215620").hide();
    $("#sub_ofertas").hide();
    $("#793893375659322983606b8061453696").hide();
    $("#sub_historial").hide();
    $("#47021317065931f0e2db040023291496").hide();
    $("#sub_documentos").hide();
    $("#92853227165931f54609887007781137").hide();

}
function mostrar_solicitud() {
   
    $("#sub_gestion").show();
    $("#2309144536593215e2e8ba8034215620").show();
    $("#sub_ofertas").show();
    $("#793893375659322983606b8061453696").show();
  

}

ocultar_todo();
mostrar_solicitud();

function action(newVal, oldVal){
    $('#6721758496597976bc7dca9015795896').hide();
    $('#704780638659797805034d9078931266').hide();

    if(newVal == 'CONTINUAR'){
        $('#6721758496597976bc7dca9015795896').show();
        $('#704780638659797805034d9078931266').show();


    }
}

action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);