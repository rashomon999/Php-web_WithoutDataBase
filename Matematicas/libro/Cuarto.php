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
    <link rel="stylesheet" href="Cuarto.css">
    <style>
        .imagen {
            max-width: 100%;
            height: auto;
        }

         .seccion {
    width: 50%; /* El 50% del ancho de la página menos el margen izquierdo */
    padding: 20px; /* importante este padding*/
    box-sizing: border-box;
    height: 290vh;
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

    /* Las secciones dejan de ir a media pantalla y se apilan: primero la
       izquierda, debajo la derecha. La altura la manda el contenido, no un
       valor fijo en vh. */
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

    /* Los huecos de tipo texto van DENTRO de la frase ("DevOps es un ___ a
       ___ entre ___"), asi que NO se les pone ancho completo: cada uno
       ocuparia una linea entera y se ve desproporcionado. Se respeta su
       atributo size y solo se limita para que nunca se salga de pantalla. */
    .seccion input[type="text"],
    input[type="text"] {
        display: inline-block !important;
        width: auto !important;
        max-width: 100% !important;
        min-width: 3.5em !important;
        box-sizing: border-box !important;
        vertical-align: baseline !important;
    }

    /* Estos si ocupan su propia linea */
    .seccion textarea, .seccion select,
    textarea, select {
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
    mjx-container[display="true"] {
        overflow-x: auto !important;
        max-width: 100% !important;
    }
}
</style>
</head>
<body>
<div class="seccion izquierda">
    <form action="./Cuarto.php" method="POST" onsubmit="handleSubmit(event)">
       <img src="..\..\img\Captura de pantalla 2024-07-04 104403.png" alt="">
       <img src="..\..\img\Captura de pantalla 2024-07-04 105005.png" alt="" >
       <img src="..\..\img\Captura de pantalla 2024-07-04 105342.png" alt="" width="600">
       <img src="..\..\img\Captura de pantalla 2024-07-04 105142.png" alt=""> <br><br>
       <img src="..\..\img\Captura de pantalla 2024-07-04 110515.png" alt="">
       <img src="..\..\img\Captura de pantalla 2024-07-04 113111.png" alt="" width="600">
       <img src="..\..\img\Captura de pantalla 2024-07-04 113130.png" alt="" width="600">
       <img src="..\..\img\Captura de pantalla 2024-07-04 114634.png" alt="" width="600"> <br>
       <span><h4>limite es 1.5</h4></span>
       
    </form>
</div>

<div class="seccion derecha">
    <form action="./Cuarto.php" method="POST" onsubmit="handleSubmit(event)"> <br> 
        La clave es: <br>
        plt.yscale('symlog')  # Escala logarítmica simétrica en el eje y <br><br><br>
        <img src="..\..\img\Captura de pantalla 2024-07-04 115941.png" alt=""> <br><br>
        <img src="..\..\img\Captura de pantalla 2024-07-04 122842.png" alt="" ><br><br>
        <img src="..\..\img\Captura de pantalla 2024-07-04 122921.png" alt="" width="600"><br><br>
        <img src="..\..\img\Captura de pantalla 2024-07-04 122947.png" alt="" width="600"> <br><br>
        <img src="..\..\img\Captura de pantalla 2024-07-04 123002.png" alt="" width="600" > <br><br>
        Otra manera de verlo: <br> <br>
        <img src="..\..\img\Captura de pantalla 2024-07-04 124419.png" alt="" width="600">
    
    </form>
</div>

<div class="centered-container">
        <a
        name="siguiente"
        id="siguiente"
        class="btn btn-primary"
        href="Quinto.php"
        role="button"
        width="50px"
        height="50px"
        >Siguiente</a>
    </div>
    
</body>
</html>
