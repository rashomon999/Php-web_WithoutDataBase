<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirección con Botones</title>
    <style>
        .centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .menu-columns {
            display: flex;
            gap: 50px;
        }

        .column {
            display: flex;
            flex-direction: column;
            align-items: center;
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
            text-align: center;
        }

        .btn:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <div class="centered-container">
        <div class="menu-columns">
            <div class="column">
                <a class="btn" href=".\Marsden\Menu.php">Marsden,Tromba</a>
                <a class="btn" href=".\Boyd\Menu.php">Boyd</a>
                <a class="btn" href=".\kolman\Menu.php">Kolman</a>
                <a class="btn" href=".\Poole\Menu.php">Poole</a>
            <br><br>
                <a class="btn" href=".\sloughter\Menu.php">sloughter</a>
                <a class="btn" href=".\libro\Comienzo.php">libro (secuencias)</a>
                <a class="btn" href=".\libro2_0\index.php">libro 2.0</a>
                <a class="btn" href=".\basico\index.php">basico</a>
                <a class="btn" href=".\algebra_lineal\Menu.php">algebra lineal</a>
            </div>
            <div class="column">
                <a class="btn" href=".\derivadas\index.php">derivadas</a>
                <a class="btn" href=".\ecuaciones\Menu.php">ecuaciones</a>
                <a class="btn" href=".\formulas\index.php">formulas</a>
                <a class="btn" href=".\graficas\index.php">graficas</a>
                <a class="btn" href=".\integrales\Menu.php">integrales</a>
                <a class="btn" href=".\trigonometricas\index.php">trigonometricas</a>
            </div>
        </div>
    </div>
</body>
</html>
