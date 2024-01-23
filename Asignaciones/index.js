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
    $('.ui.checkbox').checkbox(); // Inicializa Semantic UI Checkbox
});

// var selectUsuarios = document.getElementById('usuarios');

// // Agrega un evento al hacer clic en el select
// selectUsuarios.addEventListener('click', function () {
//     for (var i = 0; i < selectUsuarios.options.length; i++) {
//         selectUsuarios.options[i].selected = true;
//     }
// });