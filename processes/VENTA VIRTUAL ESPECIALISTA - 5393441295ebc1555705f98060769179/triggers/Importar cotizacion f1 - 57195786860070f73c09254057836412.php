<?php
@@tri_error_validacion = '';
 
function limpiar($dato)
{
    if ($dato === null) {
        return 0;
    }
    $dato = trim($dato);
    if ($dato === '' || $dato === '-') {
        return 0;
    }

    // quitar símbolos
    $dato = str_replace(['%o', '%', ' '], '', $dato);

    // Formato europeo con coma decimal: 1.234,56
    if (strpos($dato, ',') !== false && strpos($dato, '.') !== false) {
        // tiene ambos → punto es miles, coma es decimal
        $dato = str_replace('.', '', $dato);
        $dato = str_replace(',', '.', $dato);
    }
    // solo coma → es decimal
    elseif (strpos($dato, ',') !== false) {
        $dato = str_replace(',', '.', $dato);
    }
    // solo punto
    elseif (strpos($dato, '.') !== false) {
        $partes = explode('.', $dato);
        $ultimaParte = end($partes);

        if (count($partes) > 2) {
            // Múltiples puntos → todos son separadores de miles: 1.234.567
            $dato = str_replace('.', '', $dato);
        } elseif (strlen($ultimaParte) > 2) {
            // Un punto con 3+ dígitos tras él → decimal real (3.046666666666667)
            // NO tocar
        } else {
            // Un punto con 1-2 dígitos → verificar si es decimal o miles
            if (preg_match('/^\d+\.\d{1,2}$/', $dato)) {
                // decimal normal, no tocar
            } else {
                // es separador de miles
                $dato = str_replace('.', '', $dato);
            }
        }
    }

    return is_numeric($dato) ? round((float)$dato, 2) : 0;
}

function normalizarTexto($txt)
{
    if ($txt === null) {
        return '';
    }

    $txt = (string)$txt;

    // Espacios no rompibles (Excel)
    $txt = str_replace("\xC2\xA0", ' ', $txt);

    // Saltos raros
    $txt = str_replace(["\r", "\n", "\t"], ' ', $txt);

    // Colapsar múltiples espacios
    $txt = preg_replace('/\s+/', ' ', $txt);

    return trim($txt);
}

$caseId    = @@APPLICATION;
$cnx = '1479570925ec29f1d8d1d57019959618';

$prod = @@frm_producto;
$prod_label = @@frm_producto_label;

// benficios para descuentos campo1 y deducibles CAMPO2
$sql = "SELECT  CODIGO, CAMPO1, CAMPO2
FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO='PRODUCTO_COBERTURA'
and ESTADO = 1
AND VALOR = '$prod'
ORDER BY DESCRIPCION ASC";
$rsBen = executeQuery($sql,$cnx);
//@@tmprsBen = $rsBen;

// consultar impuesto
$sql = "SELECT VALOR FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'PARAMETROS_GENERALES' AND CODIGO = 'IMPUESTO' AND ESTADO = 1 AND PRO_UID = '5393441295ebc1555705f98060769179'";
$rs = executeQuery($sql,$cnx);
$iva = $rs[1]['VALOR'];
@@frm_impuesto = $iva;
// CONSULTAR RAMO
// consultar impuesto
$sql = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'producto_vida' AND CODIGO = '$prod' AND ESTADO = 1 ";
$rs = executeQuery($sql,$cnx);
@@frm_ramo = $rs[1]['VALOR'];

/*
// consular path de documento
$app_doc_filename = @@file_cotizacion1_csv_label[0];
//  AND APP_DOC_FILENAME = '$app_doc_filename'
$sql = "SELECT
*
FROM
APP_DOCUMENT
WHERE APP_UID = '$caseId'
AND APP_DOC_FIELDNAME = 'file_cotizacion1_csv'
AND APP_DOC_STATUS = 'ACTIVE'
ORDER BY APP_DOC_CREATE_DATE DESC";
$rs = executeQuery($sql);

@@tmp_sqlimpor = $sql;
*/

$file = @@file_cotizacion_csv['0']['appDocUid'];
$exte = '_1'.substr(@@file_cotizacion_csv['0']['name'],-5);
@@tmp_file_csv = $exte;
//$ext = $rs[1]['APP_DOC_FILENAME'];
//$ext = substr($ext, -3);
//INICIO
$g = new G();
$filePath = PATH_DOCUMENT . $g->getPathFromUID($caseId) . PATH_SEP . $file . $exte;

// Verificar que el archivo existe
if (!file_exists($filePath)) {
    die("ERROR: Archivo no encontrado: " . basename($filePath));
}

// Cargar PhpSpreadsheet (reemplazo de PHPExcel)
$g = new G();
$filePath = PATH_DOCUMENT . $g->getPathFromUID($caseId) . PATH_SEP . $file . $exte;

// Verificar archivo
if (!file_exists($filePath)) {
    die("ERROR: Archivo no encontrado: " . basename($filePath));
}

// Cargar PhpSpreadsheet
require_once '/code/workflow/public_html/vendor/autoload.php';

try {
    // Identificar tipo (sin "use")
    $inputFileType = PhpOffice\PhpSpreadsheet\IOFactory::identify($filePath);

    // Crear reader (sin "use")
    $reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

    // Cargar archivo
    $spreadsheet = $reader->load($filePath);

    // Obtener primera hoja
    $sheet = $spreadsheet->getActiveSheet();

    // Obtener dimensiones
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();



    // Variables ProcessMaker
    @=excelFilas = $highestRow;
    @=excelColumnas = $highestColumn;
    @=excelTipo = $inputFileType;

    // Tu logica aqui

} catch (Exception $e) {
    die("ERROR: " . $e->getMessage());
}


// FIN
// 3. VERIFICAR PhpSpreadsheet

try {
    require_once '/code/workflow/public_html/vendor/autoload.php';
    echo " Autoload cargado<br>";
} catch (Exception $e) {
    echo "   Error autoload: " . $e->getMessage() . "<br>";
    exit;
}

// 4. INTENTAR CARGAR
echo "<br>4. Cargando Excel...<br>";
try {
    $spreadsheet = PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();

    echo "  Excel cargado correctamente!<br>";
    echo "  Filas: " . $sheet->getHighestRow() . "<br>";
    echo "  Columnas: " . $sheet->getHighestColumn() . "<br>";

    // TU LÓGICA AQUÍ

} catch (Exception $e) {
    echo "  Error al cargar: " . $e->getMessage() . "<br>";
    echo "   Detalles: " . $e->getTraceAsString() . "<br>";
}



/*@@tmp_archivo = $filePath;
$contents = file_get_contents($filePath) or die("archivo $filePath no esta en la ruta");
*/
//print_r($sheet);
// arreglo de beneficios
$abeneficios = @@aBeneficios;
$beneficios = array();
foreach ( $abeneficios as $row) {
    $beneficios[$row[1]] = $row[0];
}
@@tmp_beneficios = $beneficios;
/*
$i = 0;
$lines = explode(PHP_EOL, $contents);
$cotizacion = array();
foreach ($lines as $line) {
    $i++;
    $cotizacion[$i] = str_getcsv($line,";");
}
@@tmp_cotizacion1 = $cotizacion;
*/
//$aux_producto = buscarCodigoEnCatologo(strtoupper($cotizacion[11][2]),'producto_vida',$cnx);

$triesgo_ocupacion = $sheet->getCell("I14")->getValue();
$tforma_pago = $sheet->getCell("C14")->getValue();
$topcion_beneficio = $sheet->getCell("I100")->getValue();

//fecha de cotizacion valida
@@tri_fecha_Cotizadorvalida = $sheet->getCell("I13")->getValue();

@@frm_tipo_riesgo = buscarCodigoEnCatologo(strtoupper($triesgo_ocupacion),'triesgo_ocupacion',$cnx);
@@frm_frecuencia_pago = buscarCodigoEnCatologo(strtoupper($tforma_pago),'tforma_pago',$cnx);
@@frm_beneficio = buscarCodigoEnCatologo(strtoupper($topcion_beneficio),'topcion_beneficio',$cnx);

$frecuencia = @@frm_frecuencia_pago;

// inicializar variables GRILLA COBERTURA
$i = 23;
$cobertura = array();

$cobertura[$i-22]['producto'] = @@frm_producto;

$suma_prima_neta = 0;
$dental = 0;
$exequial = 0;
@@frm_valor_asegurado = 0;

$beneficiosNorm = [];

foreach ($beneficios as $k => $v) {
    $beneficiosNorm[normalizarTexto($k)] = (string)$v;
}

$beneficios = $beneficiosNorm;


for ($i = 23; $i <= 37; $i++) {

    if ($sheet->getCell("A".$i)->getValue() != '') {

        $cobertura[$i-22]['producto'] = @@frm_producto;

        /* ========= Cobertura ========= */
        $auxcob = normalizarTexto($sheet->getCell("A".$i)->getValue());

        if (strpos($auxcob, 'PLAN DENTAL') !== false) {

            $valE = normalizarTexto($sheet->getCell("E".$i)->getValue());

            if (
                $cobertura[$i-22]['producto'] == 'Provision Classic Opción B - Creciente' ||
                $cobertura[$i-22]['producto'] == 'Provision Plus Opción B - Creciente'
            ) {
                $auxcob = $auxcob . $valE;
            } else {
                // solo agrega espacio si hay valor
                $auxcob = $valE !== '' ? $auxcob . ' ' . $valE : $auxcob;
            }

            @@frm_incluye_dental = $valE;
        }


        $auxcob = normalizarTexto($auxcob);


        if (strpos($auxcob, 'PLAN DENTAL') !== false && !isset($beneficios[$auxcob])) {
            $auxcob = 'PLAN DENTAL EQUIDENT - 0';
        }


        $cobertura[$i-22]['cobertura_label'] = $auxcob;
        $codBen = $beneficios[$auxcob];
        $cobertura[$i-22]['cobertura'] = $codBen;



        /* ========= Valor asegurado (número o texto) ========= */
        $valorAseg = trim($sheet->getCell("E".$i)->getValue());

        if (is_numeric(str_replace([',','.'], '', $valorAseg))) {
            $cobertura[$i-22]['valor_asegurado'] = limpiar($valorAseg);
        } else {
            $cobertura[$i-22]['valor_asegurado'] = $valorAseg;
        }

        /* ========= Extraprima ========= */
        $cobertura[$i-22]['por_extraprima'] = limpiar($sheet->getCell("F".$i)->getValue());
        $cobertura[$i-22]['val_extraprima'] = limpiar($sheet->getCell("G".$i)->getValue());

        /* ========= Prima neta ========= */
        $prima = limpiar($sheet->getCell("I".$i)->getValue());
        $cobertura[$i-22]['prima_neta_anual'] = $prima;

        /* ========= Otros campos ========= */
        $cobertura[$i-22]['dsctos']    = 0;
        $cobertura[$i-22]['deducible'] = 0;

        /* ========= Acumulados ========= */
        $suma_prima_neta += $prima;

        if ($codBen >= 24 && $codBen <= 32) {
            $dental += $prima;
        }

        if (in_array($codBen, [20, 58, 5801, 5802, 5803])) {
            $exequial += $prima;
        }

        if ($codBen == 1) {
            @@frm_valor_asegurado = $cobertura[$i-22]['valor_asegurado'];
        }
    }
}

@@frm_prima_exequial = $exequial;
@@frm_prima_dental = $dental;
unset(@@grd_coberturas);
@@grd_coberturas = array();
@@grd_coberturas = $cobertura;
@@frm_prima_subtt = $suma_prima_neta;

if (@@frm_ramo == 58) {
    /*@@frm_aporte_adicional = limpiar($cotizacion[48][3]);
    @@frm_provisional_saldo_inicial = limpiar($cotizacion[48][8]);
    @@frm_prima_total = limpiar($cotizacion[52][3]);
    @@frm_prima_primer_pago = limpiar($cotizacion[54][3]);*/
    @@frm_aporte_adicional = $sheet->getCell("D48")->getValue();
    @@frm_provisional_saldo_inicial = limpiar($sheet->getCell("G48")->getValue());
    @@frm_prima_total = $sheet->getCell("D52")->getValue();
    @@frm_prima_primer_pago = $sheet->getCell("D54")->getValue();
    //	$adicional_inicial = @@frm_aporte_adicional;
    //	@@frm_prima_conimpuesto = $suma_prima_neta + @@frm_prima_iva;
    @@frm_prima_iva = $suma_prima_neta * $iva /100;
    @@frm_seguro_campesino = $suma_prima_neta * 0.5 /100;
    @@frm_super_bancos = $suma_prima_neta * 3.5 /100;
}
if (@@frm_ramo == 59) {
    //	$total = limpiar($cotizacion[48][3])*1;
    //	@@tmp_total = $total;
    //	@@frm_aporte_adicional = $total - $suma_prima_neta;
    //	@@frm_aporte_adicional = (@@frm_aporte_adicional< 0? 0: @@frm_aporte_adicional);
    @@frm_aporte_adicional = 0;
    @@frm_prima_iva = 0;
    @@frm_impuesto = 0;
    @@frm_prima_conimpuesto =0;
    /*
    @@frm_provisional_saldo_inicial = limpiar($cotizacion[50][3]);
    @@frm_prima_minima = limpiar($cotizacion[54][3]);
    @@frm_prima_total = limpiar($cotizacion[48][3]);
    */
    @@frm_provisional_saldo_inicial = $sheet->getCell("D50")->getValue();
    @@frm_prima_minima = $sheet->getCell("D54")->getValue();
    @@frm_prima_total = $sheet->getCell("D48")->getValue();
}

// controlar nombre de producto
//$prod_cot_label = $cotizacion[11][2];
$prod_cot_label = $sheet->getCell("C11")->getValue();
//@@tmp_prod_label = $prod_cot_label;
@@tri_error_producto = ($prod_cot_label == $prod_label ? $sheet->getCell("C11")->getValue() : 'SI' );
@@tri_error_validacion = (@@frm_frecuencia_cotizacion_aux != $frecuencia ? 'SI' : 'NO' );



//$naci = $cotizacion[12][2];
//$auxsexo = $cotizacion[13][2];

@@frm_num_cotizacion = $sheet->getCell("C84")->getValue();

$naci = $sheet->getCell("C12")->getFormattedValue();

$auxsexo = $sheet->getCell("C13")->getValue();

$aSexo = explode(" ", $auxsexo);
$sexo = $aSexo[0];
$fumador = $aSexo[1];

$aNaci = explode('-',$naci);
//@@tmp_aNaci= $aNaci;
//

$mestra = strtoupper($aNaci[1]);

switch ($mestra) {
    case 'JAN':
    case 'ENE':
    $mn = '01';
    break;
    case 'FEB':
    $mn = '02';
    break;
    case 'MAR':
    $mn = '03';
    break;
    case 'APR':
    case 'ABR':
    $mn = '04';
    break;
    case 'MAY':
    $mn = '05';
    break;
    case 'JUN':
    $mn = '06';
    break;
    case 'JUL':
    $mn = '07';
    break;
    case 'AUG':
    case 'AGO':
    $mn = '08';
    break;
    case 'SEP':
    $mn = '09';
    break;
    case 'OCT':
    $mn = '10';
    break;
    case 'NOV':
    $mn = '11';
    break;
    case 'DEC':
    case 'DIC':
    $mn = '12';
    break;
}
$fn = $aNaci[0].'-'.$mn.'-'.$aNaci[2];
@@frm_fecha_nacimiento_label=date("d-m-Y", strtotime($fn));
@@frm_fecha_nacimiento=date("Y-m-d", strtotime($fn));

@@frm_sexo = ($sexo == 'Masculino'? 'M' :'F');
@@frm_declaracion_h_combo = ($fumador == 'Fumador'? 'S' :'N');

// CONSULTAR
$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'RECARGO_FINANCIERO' AND CODIGO = '$prod'
AND DESCRIPCION = '$frecuencia'  AND ESTADO = 1 AND PRO_UID = '5393441295ebc1555705f98060769179'";
$rs = executeQuery($sql,$cnx);
@@frm_por_recargo = $rs[1]['VALOR'];
@@frm_frecuencia_cotizacion =  @@frm_frecuencia_pago ;

