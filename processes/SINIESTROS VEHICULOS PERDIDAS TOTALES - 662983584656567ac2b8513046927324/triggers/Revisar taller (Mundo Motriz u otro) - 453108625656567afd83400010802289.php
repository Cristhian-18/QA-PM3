<?php
if(@@frm_taller == "MUNDO MOTRIZ" || @@frm_taller == "MUNDO MOTRIZ SA"){
		@@tri_bandera_mundoMotriz = "1";
	    @=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        @=frm_accion_dum[] = array("CONTINUAR", "Enviar al PDA para su aprobación");
        @=frm_accion_dum[] = array("SOLICITAR", "Solicitar información al Cliente");
	    @=frm_accion_dum[] = array("RECOTIZAR", "Solicitar recotización a Mundo Partes");
        @=frm_accion_dum[] = array("ACTUALIZAR", "Mantener en la gestión del analista");
        @=frm_accion_dum[] = array("REQUERIR", "Solicitar aprobación para peritaje especial");
		@=frm_accion_dum[] = array("SUSTITUIR", "Solicitar auto sustituto");
        @=frm_accion_dum[] = array("PERDER", "Determinar pérdida total");
        @=frm_accion_dum[] = array("APROBAR", "Solicitar aprobación carta no supera deducible");
		@=frm_accion_dum[] = array("NEGAR", "Asignar caso para negativa");
        @=frm_accion_dum[] = array("FINALIZAR", "Cierre administrativo del caso");
	}
	//revisar si es concesionario
	else if(@@frm_taller_tipo == "TALLER AUTORIZADO MULTIMARCA")
	{
		@=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        if(@@tri_bandera_indemnizar == "1"){
            @=frm_accion_dum[] = array("INDEMNIZAR", "Proceder al envio de correo de indemnización");
        }else {
            @=frm_accion_dum[] = array("VERIFICAR", "Enviar al ajustador interno para su aprobación");
        }
        @=frm_accion_dum[] = array("SOLICITAR", "Solicitar información al Cliente");
        @=frm_accion_dum[] = array("ACTUALIZAR", "Mantener en la gestión del analista");
		@=frm_accion_dum[] = array("RECOTIZAR", "Solicitar recotización a Mundo Partes");
        @=frm_accion_dum[] = array("REQUERIR", "Solicitar aprobación para peritaje especial");
		@=frm_accion_dum[] = array("SUSTITUIR", "Solicitar auto sustituto");
        @=frm_accion_dum[] = array("PERDER", "Determinar pérdida total");
        @=frm_accion_dum[] = array("APROBAR", "Solicitar aprobación carta no supera deducible");
		@=frm_accion_dum[] = array("NEGAR", "Asignar caso para negativa");
        @=frm_accion_dum[] = array("FINALIZAR", "Cierre administrativo del caso");
	}
	else{
		@=frm_accion_dum = array();
        
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        if(@@tri_bandera_indemnizar == "1"){
            @=frm_accion_dum[] = array("INDEMNIZAR", "Proceder al envio de correo de indemnización");
        }else {
            @=frm_accion_dum[] = array("VERIFICAR", "Enviar al ajustador interno para su aprobación");
        }
        @=frm_accion_dum[] = array("SOLICITAR", "Solicitar información al Cliente");
        @=frm_accion_dum[] = array("ACTUALIZAR", "Mantener en la gestión del analista");
        @=frm_accion_dum[] = array("REQUERIR", "Solicitar aprobación para peritaje especial");
		@=frm_accion_dum[] = array("SUSTITUIR", "Solicitar auto sustituto");
        @=frm_accion_dum[] = array("PERDER", "Determinar pérdida total");
        @=frm_accion_dum[] = array("APROBAR", "Solicitar aprobación carta no supera deducible");
		@=frm_accion_dum[] = array("NEGAR", "Asignar caso para negativa");
        @=frm_accion_dum[] = array("FINALIZAR", "Cierre administrativo del caso");
	}



