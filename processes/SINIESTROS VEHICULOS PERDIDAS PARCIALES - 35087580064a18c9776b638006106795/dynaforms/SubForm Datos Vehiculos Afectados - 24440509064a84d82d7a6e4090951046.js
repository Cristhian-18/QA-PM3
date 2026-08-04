//SI ESTÁ CREADO, DESHABILITAR

//TODO REMOVER TRY CATCH CUANDO FUNCIONE CORRECTAMENTE
try {
    var grdAfectados = $("#grd_vehiculos_afectados").getNumberRows();
    for (var i = 1; i <= grdAfectados; i++) {
        if ($("#grd_vehiculos_afectados").getValue(i, 8) == "1") {
            console.log(i);
            var numCols = 10;
            for (var j = 1; j <= numCols; j++) {
                console.log(j);
                $("#grd_vehiculos_afectados").getControl(i, j).attr('disabled', true);
                try {
                    var row = $($("#grd_vehiculos_afectados").find("div.pmdynaform-grid-row")[i - 1]);
                    var button = row.find(".remove-row");
                    button.hide();
                } catch (e) {
                    console.log(e);
                }


            }
        }
    }
}
catch (e) {
    console.log(e);
}
