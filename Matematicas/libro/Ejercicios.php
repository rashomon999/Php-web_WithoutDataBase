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
    <link rel="stylesheet" href="Ejercicios.css">
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
    <form action="./Ejercicios.php" method="POST" onsubmit="handleSubmit(event)">
        <span class="titulo_1"><h2>Pregunta 1 :</h2></span>
        <img class="imagen" src="..\img\Captura de pantalla 2024-06-26 171751.png" alt="Expresión matemática a simplificar"><br><br>
        *Para hallar el límite, se debe simplificar la fracción completa. De manera que no debe haber denominador común.<br><br>
        <input style="margin:10px;" value="verdad" type="radio" name="primero" id="fraccion1">V
        <input style="margin:10px;" value="falso" type="radio" name="primero" id="fraccion2">F
        <br><br>
        <button class="btn btn-primary" type="submit">Enviar</button>
        <?php echo isset($verificar_1) ? $verificar_1 : ''; ?>
        <br><br>
        *Para simplificar esta expresión, ¿qué principio debería seguir?<br><br>
        <img src="..\img\Captura de pantalla 2024-06-26 174857.png" alt=""><br>
        <input style="margin:10px;" value="verdad" type="radio" name="segundo" id="fraccion3">multiplicar 
        numerador y denominador por n. <br>
        <input style="margin:10px;" value="falso" type="radio" name="segundo" id="fraccion4">Dividir numerador y denominador por n.<br>
        <input style="margin:10px;" value="falso" type="radio" name="segundo" id="fraccion5">Sumar numerador y denominador. <br>
        <button class="btn btn-primary" type="submit">Enviar</button>
        <?php echo isset($verificar_2) ? $verificar_2 : ''; ?> 
        <br>
        <span class="titulo_1"><h2>b)</h2></span><br>
        <img src="..\img\Captura de pantalla 2024-06-26 180758.png" alt="">
        <img src="..\img\Captura de pantalla 2024-06-26 181023.png" alt="">
        <img src="..\img\Captura de pantalla 2024-06-26 181102.png" alt="">
        <span class="titulo_1"><h2>c)</h2></span><br>
        <img src="..\img\Captura de pantalla 2024-06-26 181243.png" alt="">
        <img src="..\img\Captura de pantalla 2024-06-26 181350.png" alt="">
        <img src="..\img\Captura de pantalla 2024-06-26 181438.png" alt="">
        
    </form>
</div>
<div class="seccion derecha">
    <form action="./Ejercicios.php" method="POST" onsubmit="handleSubmit(event)">
        <span class="titulo_1"><h2>d)</h2></span><br>
        <img src="..\img\Captura de pantalla 2024-06-26 181742.png" alt="">
        <img src="..\img\Captura de pantalla 2024-06-26 181903.png" alt="">
        <img src="..\img\Captura de pantalla 2024-06-26 182019.png" alt=""><br>
        Resumen punto 4.
        Generalizacion del punto medio. <br>
        pendiente del punto dado y generalizacion. <br>
        recta tangente.
        <br>
        <img src="..\img\Captura de pantalla 2024-06-26 182533.png" alt="">
        <br>
        Resumen generalizaciones <br>
        2x^2  (1,2)<img src="..\img\Captura de pantalla 2024-06-26 183731.png" alt=""><br>
        x^2 + 1 (1,2)<img src="..\img\Captura de pantalla 2024-06-26 183309.png" alt=""><br>
        x^3 (1,1)<img src="..\img\Captura de pantalla 2024-06-26 183401.png" alt=""><br>
        x^2 (2,4)<img src="..\img\Captura de pantalla 2024-06-26 183452.png" alt=""><br>
        <br>
        <span class="titulo_1"><h2>6)</h2></span><br>
        For the tangent-line example, how large would 𝑛 have to be in order for |𝑚𝑛 − 2|
        to be less than 0.005? <br>
        <img src="..\img\Captura de pantalla 2024-06-27 185142.png" alt="">
        <br>Entonces: <br>
        <img src="..\img\Captura de pantalla 2024-06-27 185329.png" alt=""> 
        <br>
        <span class="titulo_1"><h2>7)</h2></span><br>
        <img src="..\img\Captura de pantalla 2024-06-28 114639.png" alt="">
        <img src="..\img\Captura de pantalla 2024-06-28 115000.png" alt="">
        <img src="..\img\Captura de pantalla 2024-06-28 115039.png" alt="">
    </form>
</div>
<div class="centered-container">
        <a
        name="siguiente"
        id="siguiente"
        class="btn btn-primary"
        href="Continuacion.php"
        role="button"
        width="50px"
        height="50px"
        >Siguiente</a>
        </div>
</body>
</html>
