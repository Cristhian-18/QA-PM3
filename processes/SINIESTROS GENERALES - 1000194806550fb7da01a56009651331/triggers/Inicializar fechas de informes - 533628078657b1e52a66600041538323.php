<?php
//Inicializar fechas de informes

@@frm_rip_fechaEntregaInformePreliminar = date('d-m-Y');
@@frm_rif_fechaEntregaInformeFinal = date('d-m-Y');

if(@@frm_as_tipoGestion == 'FASTTRACK'){
	@@tri_bandera_inspeccion = 'true';
}

