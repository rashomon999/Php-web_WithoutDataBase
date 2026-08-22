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
    <link rel="stylesheet" href="Septimo.css">
    <style>
        .imagen {
            max-width: 100%;
            height: auto;
        }

         .seccion {
    width: 50%; /* El 50% del ancho de la página menos el margen izquierdo */
    padding: 20px; /* importante este padding*/
    box-sizing: border-box;
    height: 280vh;
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
<style>


/* === responsive movil (anadido automaticamente) === */
@media (max-width: 768px) {
    html, body {
        height: auto !important;
        min-height: 100vh !important;
        max-width: 100% !important;
        overflow-x: hidden !important;
    }

    .form-container {
        display: flex !important;
        flex-direction: column !important;
        gap: 12px !important;
        max-width: 100% !important;
        padding: 12px 10px 10px !important;
    }

    /* Las secciones dejan de ir a media pantalla y se apilan:
       primero la izquierda, debajo la derecha. La altura la manda
       el contenido, no un valor fijo en vh. */
    .seccion {
        width: 100% !important;
        max-width: 100% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        height: auto !important;
        min-height: 0 !important;
        padding: 16px 12px !important;
        box-sizing: border-box !important;
    }
    .seccion.izquierda { order: 1 !important; }
    .seccion.derecha   { order: 2 !important; }

    .seccion input[type="text"],
    .seccion textarea,
    .seccion select,
    input[type="text"], textarea, select {
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
    }

    .input-container { flex-wrap: wrap !important; }

    .centered-container {
        position: static !important;
        width: auto !important;
        padding: 12px 14px 18px !important;
    }

    .imagen, img { max-width: 100% !important; height: auto !important; }

    /* Las formulas de MathJax se desbordan en pantallas estrechas */
    mjx-container[display="true"] { overflow-x: auto !important; max-width: 100% !important; }
}

</style>
</head>
<body>
<div class="seccion izquierda">
    <form action="./Septimo.php" method="POST" onsubmit="handleSubmit(event)">
        <img src="..\..\img\Captura de pantalla 2024-07-05 182018.png" alt="">
        <img src="..\..\img\Captura de pantalla 2024-07-05 184501.png" alt="">
        <img src="..\..\img\Captura de pantalla 2024-07-05 184520.png" alt="">
        <img src="..\..\img\Captura de pantalla 2024-07-05 184536.png" alt="">
        <img src="..\..\img\Captura de pantalla 2024-07-05 184549.png" alt="">
        <img src="..\..\img\Captura de pantalla 2024-07-05 184604.png" alt="" width="622"> <br>
        Explicacion (Se reescribe en forma de cociente: ) <br>
        <img src="..\..\img\Captura de pantalla 2024-07-05 193557.png" alt="" width="600">
    </form>
</div>

<div class="seccion derecha">
    <form action="./Septimo.php" method="POST" onsubmit="handleSubmit(event)"> 
        Explicación (deshacer del logaritmo) para obtener y,e
        <img src="..\..\img\Captura de pantalla 2024-07-05 194829.png" alt="" width="600">
        <img src="..\..\img\Captura de pantalla 2024-07-05 194850.png" alt="" width="600">
        <img src="..\..\img\Captura de pantalla 2024-07-05 194901.png" alt="" width="600"> <br><br>
        <img src="..\..\img\Captura de pantalla 2024-07-06 092938.png" alt=""> <br><br>
        <img src="..\..\img\Captura de pantalla 2024-07-06 093140.png" alt="">
        <img src="..\..\img\Captura de pantalla 2024-07-06 093155.png" alt="" width="600">
    </form>
</div>

<div class="centered-container">
        <a
        name="siguiente"
        id="siguiente"
        class="btn btn-primary"
        href="Octavo.php"
        role="button"
        width="50px"
        height="50px"
        >Siguiente</a>
    </div>
    
</body>
</html>
