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

    //ajax para procesar aprobacion o rechazo de solicitud en vivo sin recargar pagina
    //antes se recargaba toda la pagina con index.php?action=solicitud_estado con post tradicional
    $(document).on('click', '.btn-ajax-estado', async function () {
        //boton clicked
        let btn = $(this);
        //id de la solicitud
        let solicitudId = btn.data('id');
        //estado de la solicitud
        let estado = btn.data('estado');

        let formData = new FormData();
        formData.append('solicitud_id', solicitudId);
        formData.append('estado', estado);

        //ajax
        try {
            //peticion ajax
            let res = await fetch('index.php?action=api_solicitud_estado', {
                method: 'POST',
                body: formData
            });
            //convierte la respuesta en json
            let data = await res.json();

            if (data.success) {
                //actualiza el badge con animacion
                let badge = $(`#badge-solicitud-${solicitudId}`);
                badge.text(data.estado);
                badge.removeClass('bg-warning bg-success bg-danger text-dark');
                if (data.estado === 'Aprobada') {
                    badge.addClass('bg-success');
                } else {
                    badge.addClass('bg-danger');
                }
                //oculta los botones de accion de esta solicitud
                $(`#cont-botones-${solicitudId}`).fadeOut();
            } else {
                alert('hubo un problema al cambiar el estado por ajax: ' + (data.error || 'error desconocido'));
            }
        } catch (err) {
            console.error('error ajax:', err);
            alert('no se pudo conectar con el servidor.');
        }
    });

});
