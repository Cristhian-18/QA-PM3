<?php
//open file for reading

$pro_uid = @@PROCESS;

$caseUID = @@APPLICATION; //set to the Output Document's unique ID

$query = "SELECT APP_DOC_FIELDNAME, APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
                FROM APP_DOCUMENT
                WHERE APP_UID='$caseUID'
                AND APP_DOC_FIELDNAME = 'file_cotizacion_csv'
                AND APP_DOC_TYPE IN ('INPUT', 'ATTACHED') AND APP_DOC_STATUS = 'ACTIVE'
                ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);
$number = @@APP_NUMBER;

if (is_array($outDoc)) {

    $cont = 1;
    foreach ($outDoc as $dataoutDoc) {
        $g = new G();
        $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP  . $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];
        $filename = str_replace("N/A", $number, $dataoutDoc['FILENAME']);
        //separate by dot and take the last part
        $extension = end(explode(".", $filename));
        $name = $dataoutDoc['APP_DOC_FIELDNAME'];
        $path = substr($path, 1);
        $path = $path . "." . $extension;
        //$arch_base64 = base64_encode($data);
        $arch_base64 = file_get_contents($path);
        //transform to base64
        $arch_base64 = base64_encode($arch_base64);

        $base64Data = $arch_base64;

        // Decode the base64 data
        $binaryData = base64_decode($base64Data);

        // Save the binary data to a temporary file
        $tempFilePath = tempnam(sys_get_temp_dir(), 'xlsx_');
        file_put_contents($tempFilePath, $binaryData);

        // Read the XLSX file
        $zip = new ZipArchive();
        if ($zip->open($tempFilePath) === true) {
            // Locate the shared strings file (contains cell values)
            $sharedStrings = $zip->getFromName('xl/sharedStrings.xml');

            // Locate the sheet data file (contains cell references)
            $sheetData = $zip->getFromName('xl/worksheets/sheet1.xml');

            // Parse the shared strings
            $sharedStringsXml = simplexml_load_string($sharedStrings);
            $sharedStringsArray = [];
            foreach ($sharedStringsXml->si as $si) {
                $t = $si->t;
                $sharedStringsArray[] = (string)$t;
            }

            // Parse the sheet data
            $sheetDataXml = simplexml_load_string($sheetData);
            foreach ($sheetDataXml->sheetData->row as $row) {

                foreach ($row->c as $cell) {
                    //print cell and column
                    $value = (string)$cell->v;

                    $cell_ref = (string)$cell['r'];
                    

                    if ($cell_ref == "C84") {
                        if ($cell['t'] == 's') {
                            // Cell value is a shared string
                            echo $sharedStringsArray[(int)$value] . "\t";
                        } else {
                            // Cell value is a direct value
                            echo $value . "\t";
                        }
                    }
                }
                echo PHP_EOL;
            }

            $zip->close();
        } else {
            echo "Error: Unable to open the XLSX file.";
        }
      
        // Clean up: Delete the temporary file
        unlink($tempFilePath);
        die();
    }
}
