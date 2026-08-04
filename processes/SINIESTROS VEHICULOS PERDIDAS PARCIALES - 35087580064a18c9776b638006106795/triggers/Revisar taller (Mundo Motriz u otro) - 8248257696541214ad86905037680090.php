<?php
if(@@tri_resultado_automatico == 'SI') {
    @=frm_accion_dum = array();
    @=frm_accion_dum[] = array("AUTOMATICO", "Continuar con proceso automático");
}
else if(@@tri_resultado_automatico == 'NO') {
    if(strpos(@@frm_taller, "MUNDO MOTRIZ") !== false) {
        @@tri_bandera_mundoMotriz = "1";
        @=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        @=frm_accion_dum[] = array("CONTINUAR", "Enviar al PDA para su aprobación");
        @=frm_accion_dum[] = array("SOLICITAR", "Solicitar información al Cliente");
        @=frm_accion_dum[] = array("RECOTIZAR", "Solicitar recotización a Mundo Partes");
        @=frm_accion_dum[] = array("ACTUALIZAR", "Mantener en la gestión del analista");
        @=frm_accion_dum[] = array("INDEMNIZAR", "Solicitar aprobación de indemnización");
        @=frm_accion_dum[] = array("REQUERIR", "Solicitar aprobación peritaje / Ajustador externo");
        @=frm_accion_dum[] = array("SUSTITUIR", "Solicitar auto sustituto");
        @=frm_accion_dum[] = array("PERDER", "Determinar pérdida total");
        @=frm_accion_dum[] = array("APROBAR", "Solicitar aprobación carta no supera deducible");
        @=frm_accion_dum[] = array("NEGAR", "Asignar causales para negativa");
        @=frm_accion_dum[] = array("FINALIZAR", "Cierre administrativo del caso");
        @=frm_accion_dum[] = array("RESPONSABILIDAD", "Generar Responsabilidad Civil");
    }
    else if(@@frm_taller_tipo == "TALLER AUTORIZADO MULTIMARCA") {
        @=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        if(@@tri_bandera_indemnizar == "1") {
            @=frm_accion_dum[] = array("INDEMNIZAR", "Proceder al envio de correo de indemnización");
        } else {
            @=frm_accion_dum[] = array("VERIFICAR", "Enviar al ajustador interno para su aprobación");
        }
        @=frm_accion_dum[] = array("SOLICITAR", "Solicitar información al Cliente");
        @=frm_accion_dum[] = array("ACTUALIZAR", "Mantener en la gestión del analista");
        @=frm_accion_dum[] = array("INDEMNIZAR", "Solicitar aprobación de indemnización");
        @=frm_accion_dum[] = array("RECOTIZAR", "Solicitar recotización a Mundo Partes");
        @=frm_accion_dum[] = array("REQUERIR", "Solicitar aprobación peritaje / Ajustador externo");
        @=frm_accion_dum[] = array("SUSTITUIR", "Solicitar auto sustituto");
        @=frm_accion_dum[] = array("PERDER", "Determinar pérdida total");
        @=frm_accion_dum[] = array("APROBAR", "Solicitar aprobación carta no supera deducible");
        @=frm_accion_dum[] = array("NEGAR", "Asignar causales para negativa");
        @=frm_accion_dum[] = array("FINALIZAR", "Cierre administrativo del caso");
        @=frm_accion_dum[] = array("RESPONSABILIDAD", "Generar Responsabilidad Civil");
    }
    else {
        @=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        if(@@tri_bandera_indemnizar == "1") {
            @=frm_accion_dum[] = array("INDEMNIZAR", "Proceder al envio de correo de indemnización");
        } else {
            @=frm_accion_dum[] = array("VERIFICAR", "Enviar al ajustador interno para su aprobación");
        }
        @=frm_accion_dum[] = array("SOLICITAR", "Solicitar información al Cliente");
        @=frm_accion_dum[] = array("ACTUALIZAR", "Mantener en la gestión del analista");
        @=frm_accion_dum[] = array("INDEMNIZAR", "Solicitar aprobación de indemnización");
        @=frm_accion_dum[] = array("REQUERIR", "Solicitar aprobación peritaje");
        @=frm_accion_dum[] = array("SUSTITUIR", "Solicitar auto sustituto");
        @=frm_accion_dum[] = array("PERDER", "Determinar pérdida total");
        @=frm_accion_dum[] = array("APROBAR", "Solicitar aprobación carta no supera deducible");
        @=frm_accion_dum[] = array("NEGAR", "Asignar causales para negativa");
        @=frm_accion_dum[] = array("FINALIZAR", "Cierre administrativo del caso");
        @=frm_accion_dum[] = array("RESPONSABILIDAD", "Generar Responsabilidad Civil");
    }
}