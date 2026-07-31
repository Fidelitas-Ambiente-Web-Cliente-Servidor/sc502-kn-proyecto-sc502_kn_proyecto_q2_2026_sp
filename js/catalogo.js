$(document).ready(function () {
    //filtro del catalogo (Búsqueda por texto)
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
