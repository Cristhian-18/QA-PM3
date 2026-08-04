<?php
//<?

$valor_total = @@frm_precioVendidoSubasta;

$array_pagos = array();

$array_pagos = @@grd_registro_pagos;
echo 'ENTRA AL SALDO PENDIENTE<br>';
foreach($array_pagos as $valor){
    echo 'Valor total: '.$valor_total.' - Valor transf: '.$valor['valor_transf'].'<br>';
    if($valor['estado'] == 'REGISTRADO'){
        echo 'Entro al if<br>';
        echo $valor_total .' - '.$valor['valor_transf'].' = ';
        $valor['saldo_venta'] = $valor_total - (int)$valor['valor_transf'];
        echo $valor['saldo_venta'];
    }
   
}

@@grd_registro_pagos = $array_pagos;
echo 'SALDO PENDIENTE FINALIZADO<br>';
