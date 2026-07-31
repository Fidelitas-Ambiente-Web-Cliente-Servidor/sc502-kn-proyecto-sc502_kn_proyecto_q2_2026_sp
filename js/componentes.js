//por ahora solo hay un archivo general js
//con forme a otras fases del proyecto se van separando por modulos y este va a manejar validaciones generales

$(document).ready(function () {
    $('input[type="email"]').on('invalid', function () {
        if (!this.value) {
            this.setCustomValidity('Por favor, completa este campo.');
        } else if (!this.value.includes('@')) {
            this.setCustomValidity("Por favor, incluye un '@' en la dirección de correo electrónico. La dirección '" + this.value + "' no incluye el símbolo '@'.");
        } else {
            this.setCustomValidity('Por favor ingresa un correo válido.');
        }
    }).on('input', function () {
        this.setCustomValidity('');
    });

    $('input[required], textarea[required]').not('[type="email"]').on('invalid', function () {
        if (!this.value) {
            this.setCustomValidity('Por favor, completa este campo.');
        }
    }).on('input', function () {
        this.setCustomValidity('');
    });

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
            } else {
                //cuando se vaya a implementar AJAX
                /*
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log("Respuesta del servidor:", response);
                        // window.location.href = 'index.php?action=rescatista';
                    }
                });
                */
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
            } else {
                //cuando se vaya a implementar AJAX
                /*
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log("Respuesta del servidor:", response);
                        // window.location.href = 'index.php?action=rescatista';
                    }
                });
                */
            }
        });
    }

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

    //filtro del catalogo
    let inputBuscarCat = $('input[placeholder="Buscar por nombre, raza..."]');
    if (inputBuscarCat.length) {
        inputBuscarCat.on('keyup', function () {
            let valorBusqueda = $(this).val().toLowerCase();
            $('.col-md-6.col-lg-4').each(function () {
                let textoTarjeta = $(this).text().toLowerCase();
                if (textoTarjeta.indexOf(valorBusqueda) > -1) {
                    $(this).fadeIn(200);
                } else {
                    $(this).fadeOut(200);
                }
            });
        });
    }

    //panel rescatista
    //buscador de la tabla de mascotas
    let inputBuscarTabla = $('input[placeholder="Buscar por nombre o especie..."]');
    if (inputBuscarTabla.length) {
        inputBuscarTabla.on('keyup', function () {
            let valor = $(this).val().toLowerCase();
            $('table tbody tr').each(function () {
                let textoFila = $(this).text().toLowerCase();
                $(this).toggle(textoFila.indexOf(valor) > -1);
            });
        });
    }
    //panel rescatista
    //pestañas dinamicas mis mascotas vs solicitudes
    let tabs = $('.nav.flex-column .side-link');
    if (tabs.length && $('.col-lg-9').length) {
        //esto valida si las metricas existen, si no existen las crea
        if ($('#seccion-solicitudes').length === 0) {
            $('.col-lg-9').append(`
                <div id="seccion-solicitudes" style="display:none;">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                        <div>
                            <h2 class="fw-bold mb-1 text-navy">Solicitudes Recibidas</h2>
                            <p class="text-secondary mb-0">Revisa quién quiere adoptar a tus mascotas.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-4 shadow-sm border border-light-subtle p-5 text-center my-5">
                        <i class="fa-regular fa-face-frown-open fs-1 text-muted mb-3 d-block"></i>
                        <h4 class="text-secondary fw-semibold">Aún no hay solicitudes nuevas</h4>
                        <p class="text-muted">Cuando alguien llene el formulario de adopción, aparecerá aquí.</p>
                    </div>
                </div>
            `);
            $('.col-lg-9 > div:not(#seccion-solicitudes)').wrapAll('<div id="seccion-mascotas"></div>');
        }
        //evento para las pestañas, cambia el contenido segun la pestaña seleccionada
        tabs.on('click', function (e) {
            e.preventDefault();
            let titulo = $(this).find('span:first').text().trim();

            if (titulo !== 'Mis Mascotas' && titulo !== 'Solicitudes') {
                alert("Esta sección estará disponible próximamente.");
                return;
            }
            //remueve los estilos de la pestaña activa
            tabs.removeClass('active text-dark').find('span:first').addClass('text-secondary');
            $(this).addClass('active text-dark').find('span:first').removeClass('text-secondary');
            //muestra el contenido de la pestaña activa
            if (titulo === 'Solicitudes') {
                $('#seccion-mascotas').hide();
                $('#seccion-solicitudes').fadeIn(300);
            } else if (titulo === 'Mis Mascotas') {
                $('#seccion-solicitudes').hide();
                $('#seccion-mascotas').fadeIn(300);
            }
        });
    }

    // filtros por especie y estado en catalogo
    $('.filtro-chk').on('change', function () {
        let especiesSeleccionadas = [];
        let estadosSeleccionados = [];

        $('.filtro-chk[data-tipo="especie"]:checked').each(function () {
            especiesSeleccionadas.push($(this).val());
        });

        $('.filtro-chk[data-tipo="estado"]:checked').each(function () {
            estadosSeleccionados.push($(this).val());
        });
        $('.mascota-item').each(function () {
            let especieMascota = $(this).data('especie');
            let estadoMascota = $(this).data('estado');

            let cumpleEspecie = especiesSeleccionadas.length === 0 || especiesSeleccionadas.includes(especieMascota);
            let cumpleEstado = estadosSeleccionados.length === 0 || estadosSeleccionados.includes(estadoMascota);

            if (cumpleEspecie && cumpleEstado) {
                $(this).fadeIn(200);
            } else {
                $(this).fadeOut(200);
            }
        });
    });

    // limpiar filtros
    $('#btn-clear-filters').on('click', function () {
        $('.filtro-chk').prop('checked', false).trigger('change');
    });

    // ordenar por nombre o recientes
    if ($('.mascota-item').length > 0) {
        // orden inicial
        $('.mascota-item').each(function (index) {
            $(this).attr('data-index', index);
        });

        $('.ordenar-select').on('change', function () {
            let valor = $(this).val();
            let $contenedor = $('.mascota-item').first().parent();
            let items = $('.mascota-item').get();

            items.sort(function (a, b) {
                if (valor === 'nombre') {
                    let nombreA = $(a).find('.mascota-card-body h4').text().trim().toLowerCase();
                    let nombreB = $(b).find('.mascota-card-body h4').text().trim().toLowerCase();
                    if (nombreA < nombreB) return -1;
                    if (nombreA > nombreB) return 1;
                    return 0;
                } else {
                    let indexA = parseInt($(a).data('index'));
                    let indexB = parseInt($(b).data('index'));
                    return indexA - indexB;
                }
            });

            $.each(items, function (i, item) {
                $contenedor.append(item);
            });
        });
    }

});