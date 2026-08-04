<?php
@@frm_respuesta_cliente = strtoupper(trim(@@frm_respuesta_cliente));
if (@@frm_respuesta_cliente=="Acepto" || @@frm_respuesta_cliente=="ACEPTO"){
	$rutat21 = 'ACEPTO';
}
else {
	$rutat21 = 'RECHAZO';
	@@tri_user_pagador = @@frm_uid_vendedor ;
}

@@rutat2_1 = $rutat21;