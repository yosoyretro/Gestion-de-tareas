$(document).ready(function () {
    // Agrega un evento de clic al botón para abrir el modal
    $('.ui.button').on('click', function () {
        // Obtiene el ID del modal desde el atributo data-target
        var modalId = $(this).data('target');

        // Abre el modal usando Semantic UI
        $(modalId).modal('show');
    });
});
$(document).ready(function () {
    // Agrega un evento de cambio a ambos campos de contraseña
    $('#clave, #clave_verify').on('input', function () {
        // Verifica la igualdad de las contraseñas y muestra el mensaje de validación
        validarContraseñas();
    });

    // Ejecuta la verificación inicial al cargar la página
    validarContraseñas();
});
$(document).ready(function () {
    $('.message .close').on('click', function () {
        $(this).closest('.message').transition('fade');
    });
});

$(document).ready(function () {
    $(".delete-button").on("click", function () {
        var userId = $(this).attr("id").split("-")[1];
        console.log("ID del usuario a eliminar:", userId);
        // ... resto del código
    });
});


// Función para verificar la igualdad de las contraseñas y mostrar mensajes de validación
function validarContraseñas() {
    var clave = $('#clave').val();
    var claveVerify = $('#clave_verify').val();
    var mensajeValidacion = $('#mensajeValidacion');

    // Verifica si los valores son iguales
    if (clave === claveVerify) {
        // Si son iguales, muestra un mensaje de validación positivo
        mensajeValidacion.text("Las claves coinciden.").css('color', 'green');
    } else {
        // Si no son iguales, muestra un mensaje de validación negativo
        mensajeValidacion.text("Las claves no coinciden.").css('color', 'red');
    }
}

