<?php
$array_documentos = array();
$array_documentos = @@chk_docs_basicos_grid;
@=label_docs=array();
foreach($array_documentos as $documento){
	
	@=label_docs[]=array($documento['frm_documento'],$documento['frm_documento']);
}

/*print_r($array_documentos);
echo("n");
print_r(@@label_docs);

die();*/