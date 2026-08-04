

if (typeof validarExpresionRegular === 'function') {
    validarExpresionRegular("frm_cliente_nombre", 1);
    validarExpresionRegular("frm_cliente_segundo_nombre", 1);
    validarExpresionRegular("frm_cliente_apellidoPaterno", 1);
    validarExpresionRegular("frm_cliente_apellidoMaterno", 1);
}

$("#frm_cliente_cedula").focusout(function () {

    if (typeof identificacionValidez === 'function') {

        var identificacion = $('#frm_cliente_cedula').getValue();
        var tipoIdentificacion = $('#frm_cliente_tipo_identificacion').getValue();

        if (tipoIdentificacion == "C" || tipoIdentificacion == "P") {
            var bool = identificacionValidez(identificacion, tipoIdentificacion,true);
            if (bool == false) {
                $('#frm_cliente_cedula').setValue("");
            }
        }
    }
});