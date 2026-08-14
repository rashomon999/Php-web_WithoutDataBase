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
        <a class="btn" href=".\Lectura_1\index.php">Lectura_1</a>
        <a class="btn" href=".\dummies\index.php">Lectura_1 (parte 2)</a>
        <a class="btn" href=".\GitBash\index.php">Bash — 1. el lenguaje</a>
        <a class="btn" href=".\GitBash\segundo.php">Bash — 2. los 15 retos</a>
        <a class="btn" href=".\Docker\index.php">Docker — 1. contenedores</a>
        <a class="btn" href=".\Docker\segundo.php">Docker — 2. Dockerfile y comandos</a>
        <a class="btn" href=".\Sesion03\index.php">Sesión 3 — 1. Definiciones y necesidad</a>
        <a class="btn" href=".\Sesion03\segundo.php">Sesión 3 — 2. Silos y sistemas</a>
        <a class="btn" href=".\Sesion03\tercero.php">Sesión 3 — 3. Prácticas y adopción</a>
        <a class="btn" href=".\Sesion03\cuarto.php">Sesión 3 — 4. Procesos, tecnología y equipos</a>

        
    </div>
</body>
</html>
