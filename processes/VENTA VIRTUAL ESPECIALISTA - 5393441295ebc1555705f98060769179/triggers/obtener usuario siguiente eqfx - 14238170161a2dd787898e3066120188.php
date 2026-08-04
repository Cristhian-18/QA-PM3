<?php
$es_broker = @@tri_es_broker;
if ($es_broker == 'SI')
{
	$grupo = '495134937623df495aa0eb9048166646';
	$sql ="SELECT 
	U.USR_UID 
	FROM
	GROUP_USER G,
	USERS U 
	WHERE G.GRP_UID = '$grupo' 
	AND G.USR_UID = U.USR_UID 
	AND U.USR_STATUS = 'ACTIVE'";
	$rs = executeQuery($sql);
	@@tri_director_t2 = $rs[1]['USR_UID'];
}
else
{
	@@tri_director_t2  = @@tri_jefe_uid;
}
