<?php
$email = @@frm_emisionNegativa_jefatura;

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = '$email'";

$rs_u = executeQuery($sql_u);

if(empty($rs_u)) {
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = ''";
    $rs_u = executeQuery($sql_u);

}

@@tri_jefatura_negativa = $rs_u['1']['USR_UID'];

