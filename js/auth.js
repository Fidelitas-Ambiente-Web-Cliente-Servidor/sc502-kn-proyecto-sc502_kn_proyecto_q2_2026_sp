$(document).ready(function () {
    //validacion de formulario login
    if ($('#form-login').length) {
        $('#form-login').on('submit', function (e) {
            let correo = $('#loginEmail').val().trim();
            let contrasena = $('#loginPassword').val().trim();
            let hasError = false;

            //ressetear
            $(this).removeClass('was-validated');
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').hide();
            // validar que el correo sea valido
            if (!correo || !correo.includes('@')) {
                $('#loginEmail').addClass('is-invalid');
                $('#loginEmail').siblings('.invalid-feedback').text('Por favor ingresa un correo válido.').show();
                hasError = true;
            } else {
                $('#loginEmail').addClass('is-valid');
            }
            // contrasena valida
            if (!contrasena) {
                $('#loginPassword').addClass('is-invalid');
                $('#loginPassword').siblings('.invalid-feedback').text('Ingresa tu contraseña.').show();
                hasError = true;
            } else {
                $('#loginPassword').addClass('is-valid');
            }

            // si da error
            if (hasError) {
                e.preventDefault();
            }
        });
    }

    //form de registro
    if ($('#form-registro').length) {
        //valida si existe y cuando se envia el form de registro
        $('#form-registro').on('submit', function (e) {
            let nombre = $('#regNombre').val().trim();
            let apellido = $('#regApellido').val().trim();
            let correo = $('#regEmail').val().trim();
            let contrasena = $('#regPassword').val().trim();
            let confirmar = $('#regPasswordConfirm').length ? $('#regPasswordConfirm').val().trim() : '';
            let hasError = false;

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').hide();
            //validaciones de los campos
            if (!nombre) { $('#regNombre').addClass('is-invalid').siblings('.invalid-feedback').show(); hasError = true; } else { $('#regNombre').addClass('is-valid'); }
            if (!apellido) { $('#regApellido').addClass('is-invalid').siblings('.invalid-feedback').show(); hasError = true; } else { $('#regApellido').addClass('is-valid'); }
            if (!correo || !correo.includes('@')) { $('#regEmail').addClass('is-invalid').siblings('.invalid-feedback').show(); hasError = true; } else { $('#regEmail').addClass('is-valid'); }
            if (!contrasena) {
                $('#regPassword').addClass('is-invalid').siblings('.invalid-feedback').text('Ingresa una contraseña.').show();
                hasError = true;
            } else if ($('#regPasswordConfirm').length && contrasena !== confirmar) {
                $('#regPasswordConfirm').addClass('is-invalid').siblings('.invalid-feedback').text('Las contraseñas no coinciden.').show();
                hasError = true;
            } else {
                $('#regPassword').addClass('is-valid');
                if ($('#regPasswordConfirm').length) $('#regPasswordConfirm').addClass('is-valid');
            }
            //si da error
            if (hasError) {
                e.preventDefault();
            }
        });
    }
});
