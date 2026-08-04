<?php
$array_comentario = @=grd_historial_caso;

//get last comment
$last_comment = $array_comentario[count($array_comentario)]['txt_comentario'];

@@frm_comentarioAnalista_ajustadorInterno = $last_comment;
