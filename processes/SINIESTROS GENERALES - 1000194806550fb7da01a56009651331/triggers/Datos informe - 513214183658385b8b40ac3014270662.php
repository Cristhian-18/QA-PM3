<?php
foreach (@=frm_grd_siniestrosRegsitrados as $row) {
   $grid.= '<tr>';
   $grid.= '<td>RAMO</td>';
   $grid.= '<td>MONTO</td>';
   $grid.= '</tr>';
   $grid.= '<tr>';
   $grid.= '<td>' . $row['grd_ramo'] . '</td>';
   $grid.= '<td>' . $row['grd_montoSolicitado'] . '</td>';
   $grid.= '</tr>';
}
@=contentRamo = $grid;