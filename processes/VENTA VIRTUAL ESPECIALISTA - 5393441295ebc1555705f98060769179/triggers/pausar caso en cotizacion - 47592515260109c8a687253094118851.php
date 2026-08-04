<?php
@@tmp_pausa = 'so';
$mifecha= date('Y-m-d H:i:s'); 
$fecha_despausa = strtotime ( '+365 days' , strtotime ($mifecha) ) ;
$fecha_despausa = date( "Y-m-d H:i:s",$fecha_despausa);
$indice = @%INDEX + 1;

@@sw_pausa = PMFPauseCase(@@APPLICATION, $indice, @@USER_LOGGED, $fecha_despausa);
	
//header("Location: casesListExtJsRedirector");
//die();