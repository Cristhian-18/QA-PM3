var respuestaJson = $("#respuestaApiLiquidacion").getValue();
if (respuestaJson === null || respuestaJson === undefined || respuestaJson.trim() === "") {
  $('#pnlInfoLiquidacionSiniestro').html("<p style='color: red;'> No existen datos para mostrar.</p>");
}else{
  try {
      var respuestaApi = JSON.parse(respuestaJson);

      var html = "<table border='1' style='width:100%; font-size:12px; border-collapse: collapse;'>";
      html += `
        <thead>
          <tr>
            <th style="width: 20%; border: 1px solid #ccc; padding: 6px;">Codigo Abonado</th>
            <th style="width: 50%; border: 1px solid #ccc; padding: 6px;">Estado</th>
            <th style="width: 30%; border: 1px solid #ccc; padding: 6px;">Valor</th>
          </tr>
        </thead>
        <tbody>
      `;

      respuestaApi.forEach(function (item) {
          var estado = "-";
          var valor = "";
          var estiloFila = ""; 

          try {
              var respuesta = JSON.parse(item.respuesta);

              var code = respuesta.code !== undefined ? respuesta.code : respuesta.Code;
              var message = respuesta.message !== undefined ? respuesta.message : respuesta.Message;
              var data = respuesta.data !== undefined ? respuesta.data : respuesta.Data;

              estado = message || "Sin mensaje";

              if (code !== 0) {
                  estiloFila = "background-color: #f8d7da; color: #721c24;"; // rojo claro
                  $("#errorLiquidacion").setValue("1");
              }

              if (code === 0 && Array.isArray(data) && data.length > 0) {
                  var datos = data[0];
                  valor = `
                    <ul style="padding-left: 18px; margin: 0;">
                      <li><strong>No. AT:</strong> ${datos.nro_aut_tec || "-"}</li>
                      <li><strong>No. Recibo:</strong> ${datos.nro_recibo || "-"}</li>
                      <li><strong>No. OP:</strong> ${datos.nro_op || "-"}</li>
                    </ul>
                  `;
              }

          } catch (err) {
              estado = "Respuesta no valida";
              estiloFila = "background-color: #f8d7da; color: #721c24;";
          }

          html += `
            <tr style="${estiloFila}">
              <td style="border: 1px solid #ccc; padding: 6px;">${item.cod_abona_vrs}</td>
              <td style="border: 1px solid #ccc; padding: 6px;">${estado}</td>
              <td style="border: 1px solid #ccc; padding: 6px;">${valor}</td>
            </tr>
          `;
      });

      html += "</tbody></table>";

      $('#pnlInfoLiquidacionSiniestro').html(html);

  } catch (e) {
      console.error("Error al parsear JSON:", e);
      $('#pnlInfoLiquidacionSiniestro').html("<p style='color: red;'> Error al mostrar los resultados.</p>");
  }
}
