<?php
$g = new G();

$g->SendMessageText("Proceso completado", "SUCCESS");

$g->SendMessageText("La actualización no pudo completarse debido a que el servicio procesador devolvió una respuesta que impidió continuar con la operación. Se recomienda revisar el detalle del mensaje para identificar la causa del inconveniente y realizar las acciones correctivas correspondientes antes de volver a intentarlo.<br><br><strong>Detalle:</strong>", "WARNING");
 

 