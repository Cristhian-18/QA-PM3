<?php
$cnx = '1479570925ec29f1d8d1d57019959618';

$app_uid =  @@APPLICATION; 
$app_number = @@APP_NUMBER ; 

$sql ="INSERT INTO `VV_TICKET` ( APP_UID, APP_NUMBER)  VALUES ('$app_uid', '$app_number')" ;
$rs = execute_query($sql,$cnx);

$sql ="INSERT INTO `VV_CLIENTE` ( APP_UID, APP_NUMBER)  VALUES ('$app_uid', '$app_number')" ;
$rs = execute_query($sql,$cnx);

$sql ="INSERT INTO `VV_SEGURO` ( APP_UID, APP_NUMBER)  VALUES ('$app_uid', '$app_number')" ;
$rs = execute_query($sql,$cnx);

$sql ="INSERT INTO `VV_COVID` ( APP_UID, APP_NUMBER)  VALUES ('$app_uid', '$app_number')" ;
$rs = execute_query($sql,$cnx);

$sql ="INSERT INTO `VV_INFORME_CONFIDENCIAL` ( APP_UID, APP_NUMBER)  VALUES ('$app_uid', '$app_number')" ;
$rs = execute_query($sql,$cnx);

$sql ="INSERT INTO `VV_DEPOSITO_PROVISIONAL` ( APP_UID, APP_NUMBER)  VALUES ('$app_uid', '$app_number')" ;
$rs = execute_query($sql,$cnx);

$sql ="INSERT INTO `VV_AUTORIZACION_DEBITO` ( APP_UID, APP_NUMBER)  VALUES ('$app_uid', '$app_number')" ;
$rs = execute_query($sql,$cnx);

$sql ="INSERT INTO `VV_DEPOSITO_PROVISIONAL` ( APP_UID, APP_NUMBER)  VALUES ('$app_uid', '$app_number')" ;
$rs = execute_query($sql,$cnx);


