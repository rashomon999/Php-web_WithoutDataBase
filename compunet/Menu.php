<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompuNet</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            display: flex;
            gap: 25px;
            justify-content: center;
            align-items: flex-start;
        }

        .col {
            flex: 1;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            min-height: 500px;
        }

        h1 {
            text-align: center;
            font-size: 26px;
        }

        h2 {
            margin-top: 25px;
            font-size: 20px;
        }

        .btn {
            display: block;
            text-decoration: none;
            background: #3498db;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            text-align: center;
        }

        .btn:hover {
            background: #217dbb;
        }

        @media(max-width: 900px) {
            .container {
                flex-direction: column;
            }
        }
    </style>

</head>

<body>

<div class="container">


    <!-- 📚 COMPUNET 1 -->
    <div class="col left">

        <h1>📚 CompuNet 1</h1>

        <h2>Contenido</h2>
        <a class="btn" href="./semana_1/Menu.php">Semana 1</a>
        <a class="btn" href="./semana_2/Menu.php">Semana 2</a>
        <a class="btn" href="./semana_3/Menu.php">Semana 3</a>


        <h2>Evaluaciones</h2>
        <a class="btn" href="./parcial_2/Menu.php">Parcial 2</a>


        <h2>Otros</h2>
        <a class="btn" href="./multihilos/Menu.php">Multihilos</a>

    </div>



    <!-- ⚙️ COMPUNET 2 -->
    <div class="col right">

        <h1>⚙️ CompuNet 2</h1>


        <h2>Backend</h2>

        <a class="btn" href="./Spring/Menu.php">Spring</a>
        <a class="btn" href="./SpringJPA/index.php">Spring JPA</a>
        <a class="btn" href="./REST/index.php">REST</a>
        <a class="btn" href="./MVC/index.php">MVC</a>
        <a class="btn" href="./Thymeleaf/index.php">Thymeleaf</a>


        <h2>Frontend</h2>

        <a class="btn" href="./JAVASCRIPT/index.php">JavaScript</a>
        <a class="btn" href="./REACT/index.php">REACT</a>
        <a class="btn" href="./AXIOS/index.php">AXIOS</a>
        <a class="btn" href="./CRUD/index.php">CRUD</a>

    </div>



    <!-- 🚀 COMPUNET 3 -->
    <div class="col">

        <h1>🚀 CompuNet 3</h1>


        <h2>Contenido</h2>

        <a class="btn" href="./virtualizacion/index.php">virtualizacion</a>
        <a class="btn" href=".\docker\index.php">docker</a>
        <a class="btn" href=".\NodeJs\index.php">NodeJs</a>

    </div>


</div>

</body>
</html>