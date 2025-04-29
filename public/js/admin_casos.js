// public/js/admin_casos.js
$(document).ready(function() {
    // AJAX para asignar encargado
    $('.asignación').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        $.ajax({
            type: 'POST',
            url: '../controllers/CasosController.php',
            data: form.serialize(),
            success: function(response) {
                alert('Encargado asignado correctamente.');
            },
            error: function() {
                alert('Error al asignar el encargado.');
            }
        });
    });

    // AJAX para eliminar caso
    $('.eliminacion').on('submit', function(e) {
        e.preventDefault();
        if (confirm('¿Estás seguro de eliminar este caso?')) {
            const form = $(this);
            $.ajax({
                type: 'POST',
                url: '../controllers/CasosController.php',
                data: form.serialize(),
                success: function(response) {
                    alert('Caso eliminado correctamente.');
                    form.closest('tr').remove(); // Borra la fila de la tabla
                },
                error: function() {
                    alert('Error al eliminar el caso.');
                }
            });
        }
    });
});
