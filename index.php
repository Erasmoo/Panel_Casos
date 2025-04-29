<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defensoría Universitaria - UNU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('/Panel_Casos/public/img/universidad.jpg') no-repeat center center fixed;
            backdrop-filter: blur(3px);

            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(6px);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .btn-custom {
            background-color: #004085;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color:rgb(26, 44, 82);
            color: white;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="overlay col-md-8 col-lg-6">
            <h1 class="mb-4">Defensoría Universitaria</h1>
            <p class="lead">
                Bienvenido al Sistema de Gestión de Casos de la Universidad Nacional de Ucayali. <br>
                Aquí podrás acceder a reportes, asignaciones y seguimiento de denuncias conforme a la Ley N° 30220.
            </p>
            <hr>
            <a href="/Panel_Casos/app/views/login.php" class="btn btn-custom mt-3 px-4 py-2">Iniciar Sesión</a>
        </div>
    </div>
</body>
</html>
