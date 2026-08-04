<?php



echo date('Y-m-d H:i:s') . "\n";
echo "<pre> Datos del servidor";

foreach ($_SERVER as $key => $value) {
    echo $key . " = " . $value . "\n";
}

echo "</pre>";
die();