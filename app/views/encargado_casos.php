<?php
require_once 'layouts/header.php';
require_once 'layouts/sidebar_encargado.php';
require '../config/database.php';
require_once '../controllers/CasosController.php';

session_start();

$usuario_id = $_SESSION['usuario'];
$conn = Database::connect();

$sql = "SELECT c.*, 
               p.NOMBRE_USUARIO AS nombre, 
               p.APELLIDOPA_USUARIO AS apellido_paterno, 
               p.APELLIDOMA_USUARIO AS apellido_materno 
        FROM casos_denuncias c
        JOIN personas_completado p ON c.dni_usuario = p.DNI_USUARIO
        WHERE c.encargado_id = ? AND c.estado = 'pendiente'";

$stmt = $conn->prepare($sql);
$stmt->execute([$usuario_id]);
$casos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<main>
    <h2>Casos Asignados</h2>
    <p>Aquí puedes ver los casos que te han sido asignados.</p>
    <table class="table display" id="tablaCasos">
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>Denunciante</th>
                <th>Descripción</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($casos as $caso): ?>
            <tr>
                <td><?= htmlspecialchars($caso['id_caso']) ?></td>
                <td><?= htmlspecialchars($caso['dni_usuario']) ?></td>
                <td><?= htmlspecialchars($caso['nombre'] . ' ' . $caso['apellido_paterno'] . ' ' . $caso['apellido_materno']) ?></td>
                <td><?= htmlspecialchars($caso['descripcion']) ?></td>
                <td>
                    <form action="../controllers/CasosController.php" method="POST" style="display: flex; align-items: center;">
                        <input type="hidden" name="accion" value="cerrar">
                        <input type="hidden" name="caso_id" value="<?= htmlspecialchars($caso['id_caso']) ?>">
                        <label style="margin-right: 10px;">En pendiente</label>
                        <input type="checkbox" class="check-resolver" name="resuelto" value="1" title="Marcar como resuelto" style="transform: scale(1.5);">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>


<script>
    $(document).ready(function () {
        $('#tablaCasos').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            pageLength: 5
        });
    });
</script>




<script>
    document.querySelectorAll('.check-resolver').forEach(function(checkbox) {
        checkbox.addEventListener('change', function(e) {
            e.preventDefault(); // Evita el submit automático

            const form = this.closest('form');
            const casoId = form.querySelector('input[name="caso_id"]').value;

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Deseas marcar el caso #${casoId} como resuelto?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, marcar como resuelto',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: '¡Caso resuelto!',
                        text: 'El caso fue marcado como resuelto correctamente.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // Espera un poco para que el usuario vea la notificación antes de enviar
                    setTimeout(() => {
                        form.submit();
                    }, 1500);
                } else {
                    this.checked = false; // Desmarca si el usuario cancela
                }
            });
        });
    });
</script>

<?php require_once 'layouts/footer.php'; ?>

<style>
    main {
        padding: 50px 40px;
        background: #f9fafb;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 10px;
        font-weight: 700;
        color: #1a202c;
    }

    p {
        text-align: center;
        font-size: 1rem;
        margin-bottom: 30px;
        color: #4a5568;
    }

    .table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .table th {
        background-color: #2d3748;
        color: white;
        padding: 16px;
        font-size: 1rem;
        text-align: center;
    }

    .table td {
        text-align: center;
        padding: 14px;
        font-size: 0.95rem;
        color: #2d3748;
        vertical-align: middle;
    }

    .table tr:hover {
        background-color: #edf2f7;
        transition: background-color 0.3s ease;
    }

    label {
        font-size: 0.9rem;
        color: #718096;
    }

    input[type='checkbox'].check-resolver {
        accent-color: #38a169;
        margin-left: 10px;
        cursor: pointer;
    }

    input[type='checkbox']:hover {
        transform: scale(1.2);
        transition: transform 0.2s ease;
    }

    @media (max-width: 768px) {
        main {
            padding: 30px 15px;
        }

        .table {
            font-size: 0.85rem;
        }

        .table th, .table td {
            padding: 10px;
        }
    }
</style>

