<?php


$pathTmpFolder = "/code/workflow/engine/plugins/beesmartec/public_html/mnt/portalenlinea/Siniestros/";
if (!is_dir($pathTmpFolder)) {
    echo "❌ La carpeta NO existe";
} else {
    echo "✅ La carpeta existe";
}

