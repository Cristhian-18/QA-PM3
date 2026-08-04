<?php
@=grdPruebas = @@grdDetallePago;
@=grdPruebasOrden  = @@grdDetallePago;

/*if (!empty(@@grdDetallePago) && is_array(@@grdDetallePago) && count(@@grdDetallePago) > 0) {    
    $grid = @@grdDetallePago;
    
    // Ordenamos por 'grdtxtCodigoContratante' como número
    usort($grid, function ($a, $b) {
        return (int)$a['grdtxtCodigoContratante'] - (int)$b['grdtxtCodigoContratante'];
    });

    // Reasignamos al grid (manteniendo los índices secuenciales)
    $nuevoGrid = array();
    $i = 1;
    foreach ($grid as $fila) {
        $nuevoGrid[$i++] = $fila;
    };
    @@grdDetallePago = $nuevoGrid; 
    @=grdPruebasOrden  = $nuevoGrid;
}
*/