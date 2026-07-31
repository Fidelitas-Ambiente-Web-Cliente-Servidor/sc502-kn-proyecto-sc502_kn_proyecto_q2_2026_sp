$(document).ready(function () {
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
});
