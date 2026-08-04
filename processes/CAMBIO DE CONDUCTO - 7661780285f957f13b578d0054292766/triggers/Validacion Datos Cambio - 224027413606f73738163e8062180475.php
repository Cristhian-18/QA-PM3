<?php
//created by Henry



if(@@frm_medio_pago == 'TARJETA'){
    $date_tajeta = strtotime(@@frm_fecha_caducidad_tarjeta);
    $date_actual = strtotime(date('Y-m-d'));


    if($date_tajeta < $date_actual){
        $result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='6815113295f95800698d791042595831' and STEP_POSITION = 1");
        @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
        $g = new G();
        $g->SendMessageText("La fecha de la tarjeta no es correcta", "WARNING");
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
    }else{
        if(@@frm_medio_pago == @@frm_medio_pago_aux && @@frm_numero_tarjeta == @@frm_numero_tarjeta_aux && @@frm_tipo_tarjeta == @@frm_tipo_tarjeta_aux && @@frm_fecha_caducidad_tarjeta == @@frm_fecha_caducidad_tarjeta_aux){
            $result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='6815113295f95800698d791042595831' and STEP_POSITION = 1");
            @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
            $g = new G();
            $g->SendMessageText("Por favor cambie la forma de pago", "WARNING");
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
        }
    }
}else{



    if(@@frm_medio_pago == @@frm_medio_pago_aux && @@frm_numero_tarjeta == @@frm_numero_tarjeta_aux  && @@frm_entidad_financiera == @@frm_entidad_financiera_axu){
        $result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='6815113295f95800698d791042595831' and STEP_POSITION = 1");
        @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
        $g = new G();
        $g->SendMessageText("Por favor cambie la forma de pago", "WARNING");
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
    }
}


