<?php
$sql_u = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = 'vmedina@imvec.com'
OR USR_POSITION = 'vmedina@imvec.com'";

$rs_u = executeQuery($sql_u);

@@tri_user_imvec = $rs_u['1']['USR_UID'];

if(@@tri_user_imvec == null || @@tri_user_imvec == ''){
    echo ("Proveedor de imvec no existe");
    die();
}
