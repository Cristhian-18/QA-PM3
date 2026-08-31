$("#frm_monto_liquidar").disableValidation();

if($("#frm_asegurado_mail_1").getValue() == ''){
	$("#frm_asegurado_mail_1").setValue($("#frm_asegurado_mail").getValue());
}

// Campos requeridos en subformularios — agregar aqui nuevas entradas segun se necesite
var camposRequeridosSubform = [
    { name: 'form[frm_cie_medico]' },
    { name: 'form[frm_cie_siniestro]' },
    // { name: 'form[otro_campo]' },
];

// Busca el input en el documento principal y en iframes, devuelve el ultimo encontrado
function buscarInputSubform(fieldName) {
    var selector = 'input.value-hidden[name="' + fieldName + '"]';

    // Buscar en documento principal (subforms inline)
    var matches = document.querySelectorAll(selector);
    if (matches.length > 0) return matches[matches.length - 1];

    // Buscar en iframes (subforms en iframe)
    var frames = document.querySelectorAll('iframe');
    for (var i = 0; i < frames.length; i++) {
        try {
            var doc = frames[i].contentDocument;
            if (!doc) continue;
            matches = doc.querySelectorAll(selector);
            if (matches.length > 0) return matches[matches.length - 1];
        } catch (e) { /* cross-origin, ignorar */ }
    }

    return null;
}

function validarCamposSubform() {
    var valid = true;
    var primerError = null;

    camposRequeridosSubform.forEach(function(campo) {
        var input      = buscarInputSubform(campo.name);
        var formGroup  = input ? input.closest('.form-group') : null;
        var errorClass = 'subform-err-' + campo.name.replace(/[^a-z0-9]/gi, '_');

        if (!input || input.value.trim() === '') {
            valid = false;
            if (!primerError && input) primerError = input;
            if (formGroup) {
                formGroup.classList.add('has-error');
                if (!formGroup.querySelector('.' + errorClass)) {
                    var errSpan = document.createElement('span');
                    errSpan.className = 'help-block ' + errorClass;
                    errSpan.style.cssText = 'color:#a94442;background:#f2dede;padding:2px 6px;border-radius:3px;display:inline-block;margin-top:4px;';
                    errSpan.innerHTML = '<span class="glyphicon glyphicon-exclamation-sign"></span> Este campo es requerido.';
                    var colDiv = input ? input.closest('[class*="col-"]') || formGroup : formGroup;
                    colDiv.appendChild(errSpan);
                }
            }
        } else {
            if (formGroup) {
                formGroup.classList.remove('has-error');
                var errMsg = formGroup.querySelector('.' + errorClass);
                if (errMsg) errMsg.remove();
            }
        }
    });

    if (primerError) primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    return valid;
}

$("#30710006661da2afe78f889017117406").setOnSubmit(validarCamposSubform);