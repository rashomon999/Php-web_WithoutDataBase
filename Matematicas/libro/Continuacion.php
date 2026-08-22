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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="Continuacion.css">
    <style>
        .imagen {
            max-width: 100%;
            height: auto;
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
    <form action="./Continuacion.php" method="POST" onsubmit="handleSubmit(event)">
        <span class="titulo_1"><h2>9) </h2></span>
        <img src="..\img\Captura de pantalla 2024-06-29 074753.png" alt=""><br><br>
        <img src="..\img\Captura de pantalla 2024-06-29 075059.png" alt=""><br><br>
        <img src="..\img\Captura de pantalla 2024-06-29 075230.png" alt=""><br><br>
        <img src="..\img\Captura de pantalla 2024-06-29 075552.png" alt=""><br><br>
        <span class="titulo_1"><h2>c) </h2></span>
        <br>
        <img src="..\img\Captura de pantalla 2024-06-29 080119.png" alt=""><br><br>
        <img src="..\img\Captura de pantalla 2024-06-29 081000.png" alt="">
        <img src="..\img\Captura de pantalla 2024-06-29 081102.png" alt="">
    </form>
</div>
<div class="seccion derecha">
    <form action="./Continuacion.php" method="POST" onsubmit="handleSubmit(event)">
        <span class="titulo_1"><h2>Limites</h2></span><br>
        <img src="..\img\Captura de pantalla 2024-06-29 083830.png" alt=""> <br><br>
        <img src="..\img\Captura de pantalla 2024-06-29 085731.png" alt="" width="550">
        <img src="..\img\Captura de pantalla 2024-06-29 085843.png" alt=""  width="550">
        <img src="..\img\Captura de pantalla 2024-06-29 090743.png" alt="" width="550">
        <img src="..\img\Captura de pantalla 2024-06-29 090913.png" alt="" width="550">
        <img src="..\img\Captura de pantalla 2024-06-29 091043.png" alt="" width="550">
        <img src="..\img\Captura de pantalla 2024-06-29 091154.png" alt="" width="550">
         <!-- Primera Pregunta -->
         <p>1. El objetivo es encontrar a partir de cual n se cumple la desigualdad</p>
        <input type="radio" id="opcion1" name="primero" value="verdad">
        <label for="opcion1">A) Verdadero</label><br>
        <input type="radio" id="opcion2" name="primero" value="falso">
        <label for="opcion2">B) Falso</label><br>
        <input type="radio" id="opcion3" name="primero" value="falso">
        <label for="opcion3">C) 1</label><br>
        <input type="radio" id="opcion4" name="primero" value="falso">
        <label for="opcion4">D) Infinito</label><br>
        <span><?php echo $verificar_1; ?></span><br><br>

        <!-- Segunda Pregunta -->
        <p>2. Que expresa E</p>
        <input type="radio" id="opcion5" name="segundo" value="falso">
        <label for="opcion5">A) \( \frac{a}{1-r} \)</label><br>
        <input type="radio" id="opcion6" name="segundo" value="verdad">
        <label for="opcion6">B) Distancia</label><br>
        <input type="radio" id="opcion7" name="segundo" value="falso">
        <label for="opcion7">C) Constante</label><br>
        <input type="radio" id="opcion8" name="segundo" value="falso">
        <label for="opcion8">D) \( \frac{r}{a-1} \)</label><br>
        <span><?php echo $verificar_2; ?></span><br><br>

        <button type="submit">Verificar respuestas</button>
    </form>
</div>
<div class="centered-container">
        <a
        name="siguiente"
        id="siguiente"
        class="btn btn-primary"
        href="Comienzo.php"
        role="button"
        width="50px"
        height="50px"
        >Siguiente</a>
        </div>
</body>
</html>
