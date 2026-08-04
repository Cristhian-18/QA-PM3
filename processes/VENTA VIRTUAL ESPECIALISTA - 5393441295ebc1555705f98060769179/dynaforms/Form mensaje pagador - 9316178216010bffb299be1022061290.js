var men = $("#tri_mensaje").getValue();
$("#mensaje").html(men);

var ruta = $("#tri_ruta_cot").getValue();
if (ruta == 'RECHAZADO')
    {ruta = '<H3>NO ADMISIBLE</H3>';

$("#resultado").html(ruta);
}