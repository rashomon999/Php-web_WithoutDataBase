<?php
// Variable para la primera pregunta
$verificar_1 = '';
$verificar_2 = '';
// Procesar el formulario cuando se envía
if ($_POST) {
    // Verificar la respuesta de la primera pregunta
    $primero = isset($_POST['primero']) ? $_POST['primero'] : '';
  
    if ($primero === 'verdad') {
        $verificar_1 = "correcto";
    } elseif ($primero === '') {
        $verificar_1 = '';
    } else {
        $verificar_1 = "incorrecto";
    }

    // Verificar la respuesta de la segunda pregunta
    
    $segundo = isset($_POST['segundo']) ? $_POST['segundo'] : '';
  
    if ($segundo === 'verdad') {
        $verificar_2 = "correcto";
    } elseif ($segundo === '') {
        $verificar_2 = '';
    } else {
        $verificar_2 = "incorrecto";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas sobre simplificación de expresiones matemáticas</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="Octavo.css">
    <style>
        .imagen {
            max-width: 100%;
            height: auto;
        }

         .seccion {
    width: 50%; /* El 50% del ancho de la página menos el margen izquierdo */
    padding: 20px; /* importante este padding*/
    box-sizing: border-box;
    height: 170vh;
    }
    </style>
    <script>
        function handleSubmit(event) {
            event.preventDefault();

            const formData = new FormData(event.target);

            fetch(event.target.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(html => {
                document.body.innerHTML = html;
            })
            .catch(error => {
                console.error('Error al enviar el formulario:', error);
            });
        }
    </script>
</head>
<body>
<div class="seccion izquierda">
    <form action="./Octavo.php" method="POST" onsubmit="handleSubmit(event)">
        <img src="..\img\Captura de pantalla 2024-07-06 094015.png" alt="">
        <img src="..\..\img\Captura de pantalla 2024-07-06 094122.png" alt=""><br>
        Encontramos el valor que satisface la igualdad (con limite definido como e=2,71828) <br>
        <img src="..\..\img\Captura de pantalla 2024-07-06 094201.png" alt="" width="520"> <br>
        Deseamos encontrar el valor para el que a_n=2,71828. usamos round y nos costo 200000 n definidos. <br>
        <img src="..\..\img\Captura de pantalla 2024-07-06 094215.png" alt="" width="520">
        <img src="..\..\img\Captura de pantalla 2024-07-06 094259.png" alt="" width="600"> <br><br>
     

    </form>
</div>

<div class="seccion derecha">
    <form action="./Octavo.php" method="POST" onsubmit="handleSubmit(event)"> 
        <img src="..\..\img\Captura de pantalla 2024-07-06 095457.png" alt="">
        <img src="..\..\img\Captura de pantalla 2024-07-06 095538.png" alt=""> <br><br>
        <img src="..\..\img\Captura de pantalla 2024-07-06 100138.png" alt=""> <br><br>
        <img src="..\..\img\Captura de pantalla 2024-07-06 100214.png" alt="">
    </form>
</div>

<div class="centered-container">
        <a
        name="siguiente"
        id="siguiente"
        class="btn btn-primary"
        href="Noveno.php"
        role="button"
        width="50px"
        height="50px"
        >Siguiente</a>
    </div>
    
</body>
</html>
