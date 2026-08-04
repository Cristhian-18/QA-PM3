<?php
//created by Henry
//Generar combo Numero de dias
//7-4-2022
try{
$combo_dias = array(
    '1' => array('1','1'),
    '2' => array('2', '2'),
    '3' => array('3', '3'),
	'4' => array('4', '4'),
    '5' => array('5', '5'),
    '6' => array('6', '6'),
	'7' => array('7', '7'),
    '8' => array('8', '8'),
    '9' => array('9', '9'),
	'10' => array('10', '10'),
    '11' => array('11', '11'),
    '12' => array('12', '12'),
	'13' => array('13', '13'),
    '14' => array('14', '14'),
    '15' => array('15', '15'),
	'16' => array('16', '16'),
    '17' => array('17', '17'),
    '18' => array('18', '18'),
	'19' => array('19', '19'),
    '20' => array('20', '20'),
    '21' => array('21', '21'),
	'22' => array('22', '22'),
    '23' => array('23', '23'),
    '24' => array('24', '24'),
	'25' => array('25', '25'),
    '26' => array('26', '26'),
    '27' => array('27', '27'),
	'28' => array('28', '28'),
	'29' => array('29', '29'),
	'30' => array('30', '30')
);

# Then make $contactOptions available to be queried  
# in the DynaForm like a table from a database:
global $_DBArray;
$_DBArray['combo_dias'] = $combo_dias;

@@tri_combo_dias = $combo_dias;
 } catch (Exception $e) {
	
	$errorMessage =  $e->getMessage();
	
 
}