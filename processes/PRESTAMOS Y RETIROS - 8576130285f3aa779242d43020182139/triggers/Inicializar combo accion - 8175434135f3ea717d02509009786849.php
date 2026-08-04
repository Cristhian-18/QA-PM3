<?php
//created by Henry
//20-08-2020
//Inicializar combo accion

@@mrt_cmb_accion = array();
$tas = @@TASK;
//array('NC','NEGADO POR EL CLIENTE'),
//array('N','NOVEDADES NO SOLVENTADO NEGADO'));
switch($tas){
		//TASK 4
	case '5567842745f3aa9ae5c6848018455054':
		if(@@cmb_accion_t3 != ''){
		@@mrt_cmb_accion = array(
				array('','Seleccione'),
				array('N','SOLICITUD DE PRESTAMO O RETIRO NEGADO'));
		}
		if(@@cmb_accion_t30 != ''){
		@@mrt_cmb_accion = array(
				array('','Seleccione'),
				array('N','SOLICITUD DE PRESTAMO O RETIRO NEGADO'));
		}
		if(@@cmb_accion_t5 != ''){
		@@mrt_cmb_accion = array(
				array('','Seleccione'),
				array('N','SOLICITUD DE PRESTAMO O RETIRO NEGADO'));
		}
		if(@@cmb_accion_t6 != ''){
		@@mrt_cmb_accion = array(
				array('','Seleccione'),
				array('R','REINTENTO DE TRANSFERENCIA AUTOMÁTICA'),
				array('N','SOLICITUD DE PRESTAMO O RETIRO CANCELADO NEGADO'));
		}
		if(@@cmb_accion_t6_1 != ''){
		@@mrt_cmb_accion = array(
				array('','Seleccione'),
				array('R','REINTENTO DE TRANSFERENCIA AUTOMÁTICA'),
				array('N','SOLICITUD DE PRESTAMO O RETIRO NEGADO'));
		@@tri_bandera_transfer = 'true';
		}
	break;
	//TASK 6
	case '4953250045f4ad54e93c1e8067311607':
		if(@@cmb_accion_t5 != ''){
		@@mrt_cmb_accion = array(
				array('','Seleccione'),
				array('S','REALIZAR TRANSFERENCIA'),
				array('N','SOLICITUD DE PRESTAMO O RETIRO CANCELADO'));
		}
	break;
	//TASK 6.1
	case '1544916375f3aaa4eaec343054838090':
		if(@@cmb_accion_t6 != ''){
		@@mrt_cmb_accion = array(
				array('','Seleccione'),
				array('A','TRANSFERENCIA CONFIRMADA'),
				array('N','NOVEDADES EN LA TRANSFERENCIA'));
		}
	break;
		//TASK 4 fidelizacion
	case '42776573267ad7009927e90081631510':
		if(@@cmb_accion_t30 == 'NC'){
		@@mrt_cmb_accion = array(
				array('','Seleccione'),
				array('AC','REINTENTO DE ENVIO AL CLIENTE'),
				array('N','SOLICITUD DE PRESTAMO O RETIRO NEGADO'));
		}
		if(@@cmb_accion_t30 == 'N'){
		@@mrt_cmb_accion = array(
				array('','Seleccione'),
				array('AD','REGRESO AL DIRECTOR COMERCIAL'),
				array('N','SOLICITUD DE PRESTAMO O RETIRO NEGADO'));
		}
	break;
	default:
	break;		
}
