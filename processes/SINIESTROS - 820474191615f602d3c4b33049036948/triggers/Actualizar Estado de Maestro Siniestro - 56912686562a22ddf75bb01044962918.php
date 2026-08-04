<?php
//created by Henry
//11-01-2021
//Guardar Estado de Siniestro
try{

    $cnx = '11264850561d723f004d5c2072943786';

    $app_uid   = @@APPLICATION;
    $task_uid  = @@TASK;
    $ticket 			 = @@APP_NUMBER;
    $usr_uid_pda      = @@USER_LOGGED;
    $usr_uid = @@tri_user_auditor;
    $id_str = @@tri_id_stro;
    $nr_stro = @@tri_nro_stro;

    $sql = "UPDATE SINIESTRO_REGISTRADO SET estado = '2', usr_auditor = '$usr_uid', id_stro = '$id_str', nro_stro = '$nr_stro' WHERE APP_UID = '$app_uid'";

    $rs = executeQuery($sql, $cnx);

} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
