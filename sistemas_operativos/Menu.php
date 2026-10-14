<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistemas Operativos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 20px;
        }

        .centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .menu-box {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
            max-width: 660px;
            width: 100%;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #1a202c;
        }

        p.intro {
            margin-bottom: 24px;
            color: #4a5568;
            line-height: 1.6;
        }

        .grupo {
            margin: 18px 0;
            padding-top: 14px;
            border-top: 1px solid #e2e8f0;
        }

        .grupo h2 {
            font-size: 1.05rem;
            color: #2d3748;
            margin: 0 0 4px;
        }

        .grupo .sub {
            font-size: 0.86rem;
            color: #718096;
            margin: 0 0 12px;
            line-height: 1.5;
        }

        .btn {
            display: inline-block;
            margin: 6px 5px;
            padding: 11px 20px;
            border-radius: 8px;
            background: #3182ce;
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.95rem;
        }

        .btn:hover {
            background: #2b6cb0;
        }

        .btn.chequeo {
            background: #c53030;
        }

        .btn.chequeo:hover {
            background: #9b2c2c;
        }

        .btn.cap {
            background: #2f855a;
        }

        .btn.cap:hover {
            background: #276749;
        }
    </style>
</head>
<body>
    <div class="centered-container">
        <div class="menu-box">
            <h1>Sistemas Operativos</h1>
            <p class="intro">Material de estudio de la materia: procesos, memoria y sistemas de archivos.</p>

            <div class="grupo">
                <h2>Preguntas de chequeo</h2>
                <p class="sub">Las preguntas del documento, con las respuestas del solucionario del curso</p>
                <a class="btn chequeo" href="Chequeo_8/index.php">Chequeo cap. 8</a>
                <a class="btn chequeo" href="Chequeo_9/index.php">Chequeo cap. 9</a>
                <a class="btn chequeo" href="Chequeo_10/index.php">Chequeo cap. 10</a>
            </div>

            <div class="grupo">
                <h2>Cuestionarios ampliados del libro</h2>
                <p class="sub">Silberschatz, <i>Operating System Concepts</i>, 10.ª ed. &mdash; con cálculos, simulaciones y diagramas</p>
                <a class="btn cap" href="Capitulo_8/index.php">Cap. 8 &mdash; Abrazos mortales</a>
                <a class="btn cap" href="Capitulo_9/index.php">Cap. 9 &mdash; Memoria principal</a>
                <a class="btn cap" href="Capitulo_10/index.php">Cap. 10 &mdash; Memoria virtual</a>
            </div>

            <div class="grupo">
                <h2>Clase y parciales</h2>
                <p class="sub">Lecturas y práctica de parcial</p>
                <a class="btn" href="Lectura_1/index.php">Lectura_1 y 2</a>
                <a class="btn" href="Parcial_1/index.php">Parcial 1 (práctica)</a>
            </div>
        </div>
    </div>
</body>
</html>
