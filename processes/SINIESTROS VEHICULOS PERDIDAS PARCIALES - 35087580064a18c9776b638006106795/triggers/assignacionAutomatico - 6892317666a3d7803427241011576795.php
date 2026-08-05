<?php
$resultado = trim(strtoupper(@@tri_resultado_automatico));
$bot_cliente = '94104395265bd6a5a21f5b6027683357';

if ($resultado == 'SI') {
    // Solo guardar el analista anterior si NO es ya el bot (evita sobrescribir en re-ejecuciones)
    if (@@tri_usr_analista != $bot_cliente) {
        @@tri_usr_analista_anterior = @@tri_usr_analista;
    }
    @@tri_usr_analista = $bot_cliente;
} else {
    // Solo restaurar si hay un valor previo válido
    if (!empty(@@tri_usr_analista_anterior)) {
        @@tri_usr_analista = @@tri_usr_analista_anterior;
    }
}