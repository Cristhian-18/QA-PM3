<?php
//<?php
    //created by Jean Hachi
    $pro_uid = @@PROCESS;

    $sql_reserva= "SELECT DESCRIPCION, CAMPO2, CAMPO1 FROM ADMIN_CATALOGOS WHERE CODIGO = 'Consultar_reserva'";
    $rs_reserva =  executeQuery($sql_reserva);
    $url_reserva = isset($rs_reserva['1']['DESCRIPCION']) ? $rs_reserva['1']['DESCRIPCION'] : '';

    $sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
	$rs_sql_apikey =  executeQuery($sql_apikey);

	$apikey = isset($rs_sql_apikey['1']['DESCRIPCION']) ? $rs_sql_apikey['1']['DESCRIPCION'] : '';

    $sql_sesa_key = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Sesa-Key'";
    $rs_sql_sesa_key =  executeQuery($sql_sesa_key);

    $sesa_key = isset($rs_sql_sesa_key['1']['DESCRIPCION']) ? $rs_sql_sesa_key['1']['DESCRIPCION'] : '';

    $idStroInsp = @@id_stro_insp;
    $idStro = 0;

    $datos_array = array(
        "idStroInsp" => $idStroInsp,
        "idStro" => $idStro
    );

    $datos = json_encode($datos_array);

    try{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_reserva);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "Accept: */*",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                "Sesa-Key: " . $sesa_key,
                "Connection: keep-alive",
                "apikey: " . $apikey,
				"User-Agent: PostmanRuntime/7.36.3"
            )
        );
        $res = curl_exec($ch);
        $res = json_decode($res);

        if (curl_errno($ch)) {
            $msg_m = curl_error($ch);


		$g = new G();
        $msg[] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador. ';
		 $g->sendMessageText(implode("\n", $msg), 'INFO');


            @@tri_msg_error = $msg_m;
            @@tri_bandera_recupera = 'true';
        }

        curl_close($ch);

          PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'CNR-SVPP-74',
      $url_reserva,
      'POST',
       "Sesa-Key: " . $sesa_key .  "apikey: " . $apikey,
      json_encode($datos),
      json_encode($res),
      json_encode($msg_m));

		$nro_stro = $res->data->idStro;

		if($nro_stro == '' || $nro_stro==null || $nro_stro == '0' || $nro_stro == 0 ){
		$g = new G();
		 $msg[] = "No se encontró el ID-Stro";
			      $g->sendMessageText(implode("\n", $msg), 'ERROR');
		return;
		}
		$g = new G();
 $msg[] = "IDStro encontrado";
			      $g->sendMessageText(implode("\n", $msg), 'INFO');

		@@id_stro =  $nro_stro;
		@@tri_id_stro = $nro_stro;


    }catch (Exception $e) {
        echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
        $result['mensaje'] = 'false';
        $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
		$g = new G();

			      $g->sendMessageText(implode("\n",  $result['mensaje_mostrar'] ), 'ERROR');
		return;
        @@tri_msg_error = $msg_m;
    }
