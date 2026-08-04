<?php
$fecha_actual = date('Y-m-d H:i:s');
@@now = date("Y-m-d",strtotime($fecha_actual."- 0 days"));
/*echo (@@now);
die();*/
//@@now = date('Y-m-d H:i:s');