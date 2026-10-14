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
        <a class="btn" href=".\ingesoft_3\Menu.php">Ingesoft_3</a>
        <br><br>
        <a class="btn" href=".\SWEBOK\Menu.php">SWEBOK  </a>
        <a class="btn" href=".\Sommerville\Menu.php">Ian Sommerville - Software Engineering (9ª edición)</a>
        <a class="btn" href=".\Scrum\Menu.php">Scrum</a>

        <br><br><br>
        <a class="btn" href=".\Pressman\Menu.php">  Roger Pressman - Software Engineering: A Practitioner’s Approach (7ª edición) </a>
        <a class="btn" href=".\ErichGamma\index.php">Erich Gamma et al. - Design Patterns </a>
        <a class="btn" href=".\ArthurLanger\index.php">Arthur M. Langer - Guide to Software Development </a>
        <br><br><br>
        <a class="btn" href=".\devops\Menu.php">devops</a>
        <a class="btn" href=".\devops2\Menu.php">devops2</a>
         
    </div>
</body>
</html>
