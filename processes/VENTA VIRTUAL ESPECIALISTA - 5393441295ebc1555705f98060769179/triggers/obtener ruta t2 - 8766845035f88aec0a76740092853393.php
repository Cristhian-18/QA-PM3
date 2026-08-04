<?php
$frm_pago_terceros = @@frm_pago_terceros;
$frm_cedula_pagador = @@frm_cedula_pagador;
$frm_numero_identificacion = @@frm_numero_identificacion;

@@frm_respuesta_cliente = strtoupper(trim(@@frm_respuesta_cliente));
if (@@frm_respuesta_cliente=="Acepto" || @@frm_respuesta_cliente=="ACEPTO"){
    if(@@frm_pago_si == 'SI'){
        @@tri_solicitud_fecha_cliente = date("Y-m-d H:i:s");
        if ($frm_cedula_pagador == $frm_numero_identificacion){
            $rutat2 = (@@frm_deposito_medio == "PAGOSMEDIOS" ? 'PAGO' : 'OPERACIONES');
        }
        else {
            if(@@frm_debito_si == 'SI'){
                $rutat2 = 'AUTORIZACION';
                //@@tri_usr_autorizacion_t2 = @@USER_LOGGED;
                //@@usr_dana_cliente = @@USER_LOGGED;
                @@tri_user_pagador = @@dana_pagador_uid;
            }else{
                $rutat2 = 'OPERACIONES';
            }
        }
    }else{
        if(@@frm_debito_si == 'SI' && $frm_pago_terceros == 'S'){
            $rutat2 = 'AUTORIZACION';
            //@@tri_usr_autorizacion_t2 = @@USER_LOGGED;
            //@@usr_dana_cliente = @@USER_LOGGED;
            @@tri_user_pagador = @@dana_pagador_uid;
        }else{
            if(@@frm_debito_si == 'SI' && $frm_pago_terceros == 'N'){
                $rutat2 = 'OPERACIONES';
            }else{
                $rutat2 = 'OPERACIONES_S';
            }
        }
    }
}
else {
    if(@@frm_requiere_buro)
    $rutat2 = 'RECHAZOB';
    else
    $rutat2 = 'RECHAZO';
}

@@rutat2 = $rutat2;

