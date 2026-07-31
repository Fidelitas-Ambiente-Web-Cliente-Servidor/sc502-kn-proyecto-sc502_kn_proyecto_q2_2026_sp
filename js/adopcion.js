$(document).ready(function () {
    //form de adopcion
    //valida campos como formulario de contacto pero para adoptar una mascota
    let formAdopcion = $('.btn-verde.w-100.btn-lg').closest('form');
    if (formAdopcion.length) {
        formAdopcion.on('submit', function (e) {
            e.preventDefault();

            let textarea = $(this).find('textarea');
            let mensaje = textarea.val().trim();

            if (!mensaje) {
                textarea.addClass('is-invalid');
                if (textarea.siblings('.invalid-feedback').length === 0) {
                    textarea.after('<div class="invalid-feedback d-block fw-semibold text-danger mt-2">Por favor, escribe un mensaje.</div>');
                } else {
                    textarea.siblings('.invalid-feedback').show();
                }
            } else {
                textarea.removeClass('is-invalid').addClass('is-valid');
                textarea.siblings('.invalid-feedback').hide();

                let btn = $(this).find('button[type="submit"]');
                let textoOriginal = btn.html();
                btn.html('<i class="fa-solid fa-check me-2"></i> ¡Enviado!');
                btn.removeClass('btn-verde').addClass('btn-success');

                setTimeout(function () {
                    textarea.val('').removeClass('is-valid');
                    btn.html(textoOriginal);
                    btn.removeClass('btn-success').addClass('btn-verde');
                    alert("¡Tu mensaje ha sido enviado al rescatista! Pronto te contactarán.");
                }, 1500);
            }
        });
    }
});
