<?php
//get date today + 1 day
@@today = date("Y-m-d", time() + 86400);
@@frm_emisionNegativa_fechaAnalisis = date("Y-m-d");
@@frm_emisionNegativa_ciudad = @@frm_accidente_ciudad;

$documentos = @@gridDocumentos;

$lenght = sizeof($documentos);

$last_date = $documentos[$lenght]['gridDocumentos_Fecha'];
@@frm_emisionNegativa_fechaUltimoDoc = $last_date;

$dias = @@today - @@frm_emisionNegativa_fechaUltimoDoc;
@@frm_emisionNegativa_fechaUltimoPoliza = $dias;


