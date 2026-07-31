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

});
