<?php
if(@@tri_resultado_automatico == 'SI'){
$analistaActual = @@tri_usr_analista;
$bot_cliente  = '94104395265bd6a5a21f5b6027683357';

@@tri_usr_analista_anterior = $analistaActual ;
@@tri_usr_analista = $bot_cliente;

}