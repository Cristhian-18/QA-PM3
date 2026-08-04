function enmascarar(valor, visiblesIni = 2, visiblesFin = 2) {
  if (!valor || valor.length <= (visiblesIni + visiblesFin)) return valor;
  let parteVisibleInicio = valor.substring(0, visiblesIni);
  let parteVisibleFinal = valor.substring(valor.length - visiblesFin);
  return parteVisibleInicio + 'X'.repeat(valor.length - visiblesIni - visiblesFin) + parteVisibleFinal;
}

$(document).ready(function () {
  // Supongamos que estos campos vienen de @@camposEnmascarar
  let campos = ["txtCedulaMax", "txtNombresMax"];

  campos.forEach(function (campo) {
    let valorReal = getField(campo);
    let valorMascara = enmascarar(valorReal);

    // Guardas el valor real como atributo data-real
    $("#" + campo).attr("data-real", valorReal);

    // Mostramos la máscara visualmente
    setField(campo, valorMascara);
  });

  // Antes de enviar, restaurar los valores reales
  $("form").on("submit", function () {
    campos.forEach(function (campo) {
      let valorReal = $("#" + campo).attr("data-real");
      setField(campo, valorReal);
    });
  });
});
