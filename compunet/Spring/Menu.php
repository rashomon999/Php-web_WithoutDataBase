<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirección con Botones</title>
    <style>
        .centered-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .btn {
            display: block;
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: blue;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <div class="centered-container">
        <a class="btn" href=".\Introduccion\index.php">Introduccion</a>
        <a class="btn" href=".\cuestionarioIntro\index.php">cuestionario</a>
        <a class="btn" href=".\introduccion_2\index.php">Introduccion 2</a>
        <a class="btn" href=".\cuestionario_2\index.php">cuestionario_2</a>

        <a class="btn" href=".\Anotaciones\index.php">Anotaciones</a>
        <a class="btn" href=".\AnotacionesCuestionario\index.php">AnotacionesCuestionario</a>
         

    </div>
</body>
</html>
