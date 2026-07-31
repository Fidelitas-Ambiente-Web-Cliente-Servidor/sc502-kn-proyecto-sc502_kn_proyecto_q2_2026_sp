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

});