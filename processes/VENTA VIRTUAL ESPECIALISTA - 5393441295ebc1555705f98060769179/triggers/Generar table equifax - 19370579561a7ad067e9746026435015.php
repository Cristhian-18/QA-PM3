<?php
//<?php
function recorreArrayHTML($vector, $nivel ) {
    $nivel++;
    $html_array = "
    <style>
    .css_1 {color: #FFFFFF; font-size: 16px;}
    .css_2 {background-color: #9DB6FF; color: #000000;}
    .css_3 {background-color: #FCFC3E; color: #000000;}
    </style>
    ";
    $htlm_tabla = "";
    $count_campos = 1;
    $count_title = 1;
    $html_string = "";
    foreach ($vector as $key => $valor) {
        if(is_array($valor) == 'Array') {
            $label = str_replace('_x0028_', '(', $key);
            $label = str_replace('_x0029_', ')', $label);
            $label = str_replace('_x0020_', ' ', $label);
            if($nivel == 1) {
                $html_array .= '
                <div id="titulo_'.$count_title.'" class="pmdynaform-field-subtitle form-group col-sm-12 col-md-12 col-lg-12 pmdynaform-field" style="display: block;">
                <h5 id="form[titulo_'.$count_title.']" style="background-color: rgb(77, 156, 43); border-color: rgb(77, 156, 43);">
                <p class="pmdynaform-label-subtitle">
                ';
                $html_array .= "<span class='css_$nivel subtitulo' id='ifrm_$count_title' subform='tabla_$count_title'><i class='glyphicon glyphicon-minus'></i>".$label."</span>";
                $html_array .= '</p>
                </h5>
                </div>
                ';
                $html_array .= "<table class='tablaClass' id='tabla_$count_title' border='1' WIDTH='100%'>
                <tbody>";
                $count_title++;
            }
            else{
                $html_array .= "<table id='tabla_$count_title' border='1' WIDTH='100%'>
                <tbody>";
                $html_array .= "<tr class='css_$nivel' >";
                $nivel_html = "<strong style='color: red;'>Nivel : $nivel&emsp;</strong>";
                $html_array .= "<td>.<strong>".$label."</strong></td>";
                $html_array .= "<td></td>";
                $html_array .= "</tr>";
            }
            $html_array .=  "<tr><td colspan='2' >";	//INICIO
            // $html_array .=  "<br><br>";
            $html_array .= recorreArrayHTML($valor, $nivel);
            $html_array .=  "</tr></td>";	//FIN
            $html_array .= "
            </tbody>
            </table>
            ";
            if($nivel == 1) {
                $html_array .=  "<br>";
            }
        }else{
            if($count_campos == 1) {
                $html_string =  "<tr>";
            }
            $html_string .= "<td><strong>".$key."</strong></td>";
            $html_string .= "<td>".$valor."</td>";
            if($count_campos%3==0) {
                $html_string .=  "</tr>";
            }
            $count_campos++;
        }
    }
    $html_string_tabla = "";
    $html_string_tabla .= "
    <table border='1' WIDTH='100%'>
    <tbody>
    ";
    $html_string_tabla .= $html_string;
    $html_string_tabla .= "
    </tbody>
    </table>
    ";
    $htlm_tabla .= $html_string_tabla;
    $htlm_tabla .= $html_array;
    return $htlm_tabla;
}

function recorreArrayHTMLPagador($vector, $nivel ) {
    $nivel++;
    $html_array = "
    <style>
    .css_1 {color: #FFFFFF; font-size: 16px;}
    .css_2 {background-color: #9DB6FF; color: #000000;}
    .css_3 {background-color: #FCFC3E; color: #000000;}
    </style>
    ";
    $htlm_tabla = "";
    $count_campos = 1;
    $count_title = 1;
    $html_string = "";
    foreach ($vector as $key => $valor) {
        if(is_array($valor) == 'Array') {
            $label = str_replace('_x0028_', '(', $key);
            $label = str_replace('_x0029_', ')', $label);
            $label = str_replace('_x0020_', ' ', $label);
            if($nivel == 1) {
                $html_array .= '
                <div id="tituloP_'.$count_title.'" class="pmdynaform-field-subtitle form-group col-sm-12 col-md-12 col-lg-12 pmdynaform-field" style="display: block;">
                <h5 id="form[tituloP_'.$count_title.']" style="background-color: rgb(77, 156, 43); border-color: rgb(77, 156, 43);">
                <p class="pmdynaform-label-subtitle">
                ';
                $html_array .= "<span class='css_$nivel subtitulo' id='ifrm_p$count_title' subform='tabla_p$count_title'><i class='glyphicon glyphicon-minus'></i>".$label."</span>";
                $html_array .= '</p>
                </h5>
                </div>
                ';
                $html_array .= "<table class='tablaClass' id='tabla_p$count_title' border='1' WIDTH='100%'>
                <tbody>";
                $count_title++;
            }
            else{
                $html_array .= "<table id='tabla_p$count_title' border='1' WIDTH='100%'>
                <tbody>";
                $html_array .= "<tr class='css_$nivel' >";
                $nivel_html = "<strong style='color: red;'>Nivel : $nivel&emsp;</strong>";
                $html_array .= "<td>.<strong>".$label."</strong></td>";
                $html_array .= "<td></td>";
                $html_array .= "</tr>";
            }
            $html_array .=  "<tr><td colspan='2' >";	//INICIO
            // $html_array .=  "<br><br>";
            $html_array .= recorreArrayHTMLPagador($valor, $nivel);
            $html_array .=  "</tr></td>";	//FIN
            $html_array .= "
            </tbody>
            </table>
            ";
            if($nivel == 1) {
                $html_array .=  "<br>";
            }
        }else{
            if($count_campos == 1) {
                $html_string =  "<tr>";
            }
            $html_string .= "<td><strong>".$key."</strong></td>";
            $html_string .= "<td>".$valor."</td>";
            if($count_campos%3==0) {
                $html_string .=  "</tr>";
            }
            $count_campos++;
        }
    }
    $html_string_tabla = "";
    $html_string_tabla .= "
    <table border='1' WIDTH='100%'>
    <tbody>
    ";
    $html_string_tabla .= $html_string;
    $html_string_tabla .= "
    </tbody>
    </table>
    ";
    $htlm_tabla .= $html_string_tabla;
    $htlm_tabla .= $html_array;
    return $htlm_tabla;
}

//<?PHP
// llamado a WS
$user = $_SESSION['USR_USERNAME'];
$ced = @@frm_numero_identificacion;
$tipo = @@frm_tipo_identificacion;
// aqui el select al catalogo para credencial url
$cnx = '1479570925ec29f1d8d1d57019959618';
$sqlws  = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'EQUIFAX'";
$rsws   = executeQuery($sqlws,$cnx);
$url = $rsws['1']['VALOR'];
$curl = curl_init();
$data = array(
    "tipoDocumento" => $tipo,
    "identificacion" => $ced,
    "fechaNacimiento" => "",
    "nombreUsuario" => $user
);
$data= json_encode($data);
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS     => $data,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));
$response = curl_exec($curl);
$err			= curl_error($curl);
@@tmp_Resp_eqfx = $response;
@@tmp_errr_qfx = curl_error($curl);
curl_close($curl);

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'Generar table equifax',
    $url,
    'POST',
    'NO APLICA',
    $data,
    $response,
    $err
);



$aData = json_decode($response,true);
$tabla = recorreArrayHTML($aData, 0);
$tabla = str_replace('u00f3','ó',$tabla);
$tabla = str_replace('u00f1','ñ',$tabla);
$tabla = str_replace('u00fa','ú',$tabla);
$tabla = str_replace('u00e1','á',$tabla);
@@tri_rpt_equifax =  $tabla;

@@tri_rpt_equifax_pagador =  '';
$pagador = @@frm_pago_terceros;
if ($pagador == 'S'){
    // equifax pagador
    $user = $_SESSION['USR_USERNAME'];
    $ced = @@frm_cedula_pagador;
    $tipo = @@frm_tipo_identificacion_pagador;
    $curl = curl_init();
    $data = array(
        "tipoDocumento" => $tipo,
        "identificacion" => $ced,
        "fechaNacimiento" => "",
        "nombreUsuario" => $user
    );
    $data= json_encode($data);
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS     => $data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    @@tmp_Resp_eqfx_pag = $response;
    curl_close($curl);
    $aData = json_decode($response,true);
    $tabla = recorreArrayHTMLPagador($aData, 0);
    $tabla = str_replace('u00f3','ó',$tabla);
    $tabla = str_replace('u00f1','ñ',$tabla);
    $tabla = str_replace('u00fa','ú',$tabla);
    $tabla = str_replace('u00e1','á',$tabla);
    @@tri_rpt_equifax_pagador =  $tabla;
}
