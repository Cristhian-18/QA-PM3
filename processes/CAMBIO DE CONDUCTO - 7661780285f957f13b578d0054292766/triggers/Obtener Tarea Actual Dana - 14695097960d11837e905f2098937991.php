<?php
//Obtener Tarea Actual dana

if(@@tri_ban_bpm == 'true'){
	@@tri_task_actual = '1628975415f95804f7cc8f1008580474';
	@@tri_user_actual = @@tri_user_cobranza;
}else{
	@@tri_task_actual = '7238334425f958006c88c88045780453';
	@@tri_user_actual = @@tri_user_sac;
}