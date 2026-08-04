<?php
//<?
//get current year

$year = date("Y");

@@tri_id_stro = @@APP_NUMBER . " - " . $year;
@@tri_nro_stro = '1234';

$tri_stro = @@tri_nro_stro;

echo json_encode(array(
	'tri_nro_stro' => $tri_stro
));
