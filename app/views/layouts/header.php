
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="../../public/css/usuario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/d314bebc98.js" crossorigin="anonymous"></script>


  <!-- Bootstrap -->

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<!-- jQuery (necesario para DataTables) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</head>
<script>
    $(document).ready(function() {
        $('#miTabla').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/Spanish.json"
            },
            "pageLength": 5,  // Registros por página
            "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Todos"]],
            "responsive": true,
            "autoWidth": false
        });
    });
</script>

</head>
<body>
    <header>
        <h2>Bienvenido</h2>
    </header>
