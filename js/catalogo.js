$(document).ready(function () {
    const ITEMS_POR_PAGINA = 6;
    let paginaActual = 1;

    function aplicarPaginacion() {
        let itemsVisibles = $('.mascota-item').not('.filtered-out');
        let totalItems = itemsVisibles.length;
        let totalPaginas = Math.ceil(totalItems / ITEMS_POR_PAGINA);

        if (totalPaginas === 0) totalPaginas = 1;
        if (paginaActual > totalPaginas) paginaActual = totalPaginas;

        //mostrar solo los de la página actual
        itemsVisibles.hide();

        let inicio = (paginaActual - 1) * ITEMS_POR_PAGINA;
        let fin = inicio + ITEMS_POR_PAGINA;

        itemsVisibles.slice(inicio, fin).fadeIn(200);

        renderizarControlesPaginacion(totalPaginas);
    }

    function renderizarControlesPaginacion(totalPaginas) {
        let $container = $('#pagination-container');
        if (!$container.length) return;

        $container.empty();

        if (totalPaginas <= 1) return; //validacion de las paginas en el catalogo

        //boton anterior
        let btnPrev = $('<button class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center btn-pagination"><i class="fa-solid fa-chevron-left"></i></button>');
        if (paginaActual === 1) btnPrev.prop('disabled', true);
        btnPrev.on('click', function () {
            if (paginaActual > 1) {
                paginaActual--;
                aplicarPaginacion();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
        $container.append(btnPrev);

        // botones numericos
        for (let i = 1; i <= totalPaginas; i++) {
            let btn = $(`<button class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center fw-semibold text-secondary btn-pagination">${i}</button>`);
            if (i === paginaActual) {
                btn.removeClass('btn-light text-secondary border-light-subtle').addClass('active');
            }
            btn.on('click', function () {
                paginaActual = i;
                aplicarPaginacion();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            $container.append(btn);
        }

        // boton siguiente
        let btnNext = $('<button class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center btn-pagination"><i class="fa-solid fa-chevron-right"></i></button>');
        if (paginaActual === totalPaginas) btnNext.prop('disabled', true);
        btnNext.on('click', function () {
            if (paginaActual < totalPaginas) {
                paginaActual++;
                aplicarPaginacion();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
        $container.append(btnNext);
    }

    // aplicar los filtros al catalogo mediante ajax
    async function aplicarFiltros() {
        let valorBusqueda = '';
        let inputBuscarCat = $('input[placeholder="Buscar por nombre, raza..."]');
        if (inputBuscarCat.length) {
            valorBusqueda = inputBuscarCat.val().toLowerCase();
        }

        let especiesSeleccionadas = [];
        let estadosSeleccionados = [];

        $('.filtro-chk[data-tipo="especie"]:checked').each(function () {
            especiesSeleccionadas.push($(this).val());
        });

        $('.filtro-chk[data-tipo="estado"]:checked').each(function () {
            estadosSeleccionados.push($(this).val());
        });

        /* forma anterior sincrona sin ajax, filtrado en cliente en el dom sin llamar al servidor
        $('.mascota-item').each(function () {
            let $item = $(this);
            let textoTarjeta = $item.text().toLowerCase();
            let especieMascota = $item.data('especie');
            let estadoMascota = $item.data('estado');

            let cumpleBusqueda = valorBusqueda === '' || textoTarjeta.indexOf(valorBusqueda) > -1;
            let cumpleEspecie = especiesSeleccionadas.length === 0 || especiesSeleccionadas.includes(especieMascota);
            let cumpleEstado = estadosSeleccionados.length === 0 || estadosSeleccionados.includes(estadoMascota);

            if (cumpleBusqueda && cumpleEspecie && cumpleEstado) {
                $item.removeClass('filtered-out');
            } else {
                $item.addClass('filtered-out');
                $item.hide();
            }
        });
        */

        //metodo ajax asincrono consulta al backend, db, que mascotas coinciden y actualiza la vista
        try {
            //arma los parametros para la peticion
            let params = new URLSearchParams({
                busqueda: valorBusqueda,
                especies: especiesSeleccionadas.join(','),
                estados: estadosSeleccionados.join(',')
            });
            //peticion ajax
            let res = await fetch('index.php?action=api_mascotas_filtradas&' + params.toString());
            //convierte la respuesta en json
            let data = await res.json();
            //crea un array con los ids de las mascotas coincidentes
            let idsCoincidentes = data.map(item => Number(item.id));
            //itera sobre todas las mascotas
            $('.mascota-item').each(function () {
                let idItem = Number($(this).data('id'));
                //muestra la mascota si su id esta en el array de coincidentes, si no la oculta
                if (idsCoincidentes.includes(idItem)) {
                    $(this).removeClass('filtered-out');
                } else {
                    $(this).addClass('filtered-out');
                    $(this).hide();
                }
            });
        } catch (err) {
            console.error('error en filtrado ajax del catalogo:', err);
        }

        paginaActual = 1;
        aplicarPaginacion();
    }

    //events
    let inputBuscarCat = $('input[placeholder="Buscar por nombre, raza..."]');
    if (inputBuscarCat.length) {
        inputBuscarCat.on('keyup', aplicarFiltros);
    }

    $('.filtro-chk').on('change', aplicarFiltros);

    $('#btn-clear-filters').on('click', function () {
        $('.filtro-chk').prop('checked', false);
        if (inputBuscarCat.length) inputBuscarCat.val('');
        aplicarFiltros();
    });

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
            aplicarPaginacion();
        });
    }
    aplicarFiltros();
});
