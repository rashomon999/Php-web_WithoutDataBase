<?php
// el name es lo importante
$primero = '';
$segundo = '';
$tercero = '';
$cuarto = '';
$cuarto2 = '';
$quinto = '';
$sexto = '';
$septimo = '';
$octavo = '';
$nueve = '';
$diez = '';
if ($_POST) {
    $primero = isset($_POST['primero']) ? ($_POST['primero']) : '';
    $segundo = isset($_POST['segundo']) ? ($_POST['segundo']) : '';
    $tercero = isset($_POST['tercero']) ? ($_POST['tercero']) : '';
    $cuarto = isset($_POST['cuarto']) ? ($_POST['cuarto']) : '';
    $cuarto2 = isset($_POST['cuarto2']) ? ($_POST['cuarto2']) : '';
    $quinto = isset($_POST['quinto']) ? ($_POST['quinto']) : '';
    $sexto = isset($_POST['sexto']) ? ($_POST['sexto']) : '';
    $septimo = isset($_POST['septimo']) ? ($_POST['septimo']) : '';
    $octavo = isset($_POST['octavo']) ? ($_POST['octavo']) : '';
    $nueve = isset($_POST['nueve']) ? ($_POST['nueve']) : '';
    $diez = isset($_POST['diez']) ? ($_POST['diez']) : '';
    // Validación del primero
    if ($primero === 'change') {
        $verificar_1 = "correcto";
    } elseif ($primero === '') {
        $verificar_1 = '';
    } else {
        $verificar_1 = "incorrecto";
    }

    // Validación del segundo
    if ($segundo === 'quantity') {
        $verificar_2 = "correcto";
    } elseif ($segundo === '') {
        $verificar_2 = '';
    } else {
        $verificar_2 = "incorrecto";
    }

    // Validación del tercero
    if ($tercero === 'approximation') {
        $verificar_3 = "correcto";
    } elseif ($tercero === '') {
        $verificar_3 = '';
    } else {
        $verificar_3 = "incorrecto";
    }

    // Validación del cuarto
    if (($cuarto === 'sequences' && $cuarto2 === 'limits of sequences') || ($cuarto === 'limits of sequences' && $cuarto2 === 'sequences')) {
        $verificar_4 = "correcto";
    } elseif (($cuarto === 'derivatives' && $cuarto2 === 'integrals') || ($cuarto === 'integrals' && $cuarto2 === 'derivatives')) {
        $verificar_4 = "correcto";
    } elseif ($cuarto === '' || $cuarto2 === '') {
        $verificar_4 = '';
    } else {
        $verificar_4 = "incorrecto";
    }


    // Validación del primero
    if ($quinto === 'area of a region in the plane') {
        $verificar_5 = "correcto";
    } elseif ($quinto === '') {
        $verificar_5 = '';
    } else {
        $verificar_5 = "incorrecto";
    }

    // Validación del segundo
    if ($sexto === ' find the line tangent to a curve at a given point on the curve') {
        $verificar_6 = "correcto";
    } elseif ($sexto === '') {
        $verificar_6 = '';
    } else {
        $verificar_6 = "incorrecto";
    }

     // Validación del séptimo (nueva pregunta)
     if ($septimo === 'inverse') {
        $verificar_7 = "correcto";
    } elseif ($septimo === '') {
        $verificar_7 = '';
    } else {
        $verificar_7 = "incorrecto";
    }

     // Validación del séptimo (nueva pregunta)
     if ($octavo === 'pi') {
        $verificar_8 = "correcto";
    } elseif ($octavo === '') {
        $verificar_8 = '';
    } else {
        $verificar_8 = "incorrecto";
    }


    // Validación del nueve
    if ($nueve === 'cos(θ)') {
    $verificar_9 = "correcto";
    } elseif ($nueve === '') {
    $verificar_9 = '';
    } else {
    $verificar_9 = "incorrecto";
    }

     // Validación del octavo
     if ($diez === '2sin(pi/n)') {
        $verificar_10 = "correcto";
        } elseif ($diez === '') {
        $verificar_10 = '';
        } else {
        $verificar_10 = "incorrecto";
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="Primero.css">
    <title>Ejercicios de Cálculo</title>
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

        function updateSentence() {
            const selectedOption = document.querySelector('input[name="segundo"]:checked');
            const sentence = document.getElementById('sentence');
            if (selectedOption) {
                sentence.textContent = `affect the value of another related ${selectedOption.value}`;
            } else {
                sentence.textContent = 'affect the value of another related ____________';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const radioButtons = document.querySelectorAll('input[name="segundo"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', updateSentence);
            });

            updateSentence(); // Initialize on page load
        });
 
        function mostrarMensaje() {
            var mensaje = document.getElementById('mensaje');
            mensaje.style.display = 'block';
        }

        function ocultarMensaje() {
            var mensaje = document.getElementById('mensaje');
            mensaje.style.display = 'none';
        }

        function mostrarMensaje2() {
            var mensaje = document.getElementById('mensaje2');
            mensaje.style.display = 'block';
        }

        function ocultarMensaje2() {
            var mensaje = document.getElementById('mensaje2');
            mensaje.style.display = 'none';
        }

        function mostrarMensaje3() {
            var mensaje = document.getElementById('mensaje3');
            mensaje.style.display = 'block';
        }

        function ocultarMensaje3() {
            var mensaje = document.getElementById('mensaje3');
            mensaje.style.display = 'none';
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
        <form action="./Primero.php" method="POST" onsubmit="handleSubmit(event)">
            <span class="titulo_1"><h2>Pregunta 1:</h2></span>
            <br><br>
            The study of calculus begins with questions about <span id="pregunta1"><?php echo isset($primero) && $primero !== '' ? $primero : '__________'; ?></span> <br><br>
            <input style="margin:10px;" value="change" type="radio" name="primero" id="primero1" <?php echo isset($primero) && ($primero === 'change') ? 'checked' : ''; ?>>Change
            <input style="margin:10px;" value="quantity" type="radio" name="primero" id="primero2" 
            <?php if ($primero === 'quantity') echo 'checked'; ?>>Quantity
            <br><br>
            <button class="btn btn-primary" type="submit">Submit</button>
            <?php echo isset($verificar_1) ? $verificar_1 : ''; ?>

            <br><br><br>
            <span class="titulo_1"><h2>Pregunta 2:</h2></span>
            <br><br>
            Mathematically, one is interested in learning to what extent changes in one <br><br>
            <input style="margin:10px;" value="quantity" type="radio" name="segundo" id="segundo1" <?php echo isset($segundo) && ($segundo === 'quantity') ? 'checked' : ''; ?>>Quantity
            <input style="margin:10px;" value="variable" type="radio" name="segundo" id="segundo2"
            <?php if ($segundo === 'variable') echo 'checked'; ?>>Variable
            <br>
            <span id="sentence">affect the value of another related <?php echo isset($segundo) && $segundo !== '' ? $segundo : '__________'; ?></span>
            <br><br>
            <button class="btn btn-primary" type="submit">Submit</button>
            <?php echo isset($verificar_2) ? $verificar_2 : ''; ?>

            <br><br><br>
            <span class="titulo_1"><h2>Pregunta 3:</h2></span>
            <br><br>
            Related to questions of change are problems of <span id="pregunta3"><?php echo isset($tercero) && $tercero !== '' ? $tercero : '________'; ?></span><br><br>
            <input style="margin:10px;" value="approximation" type="radio" name="tercero" id="tercero1" <?php echo isset($tercero) && ($tercero === 'approximation') ? 'checked' : ''; ?>>Approximation
            <input style="margin:10px;" value="estimation" type="radio" name="tercero" id="tercero2" <?php if ($tercero === 'estimation') echo 'checked'; ?>>Estimation
            <br><br>
            <button class="btn btn-primary" type="submit">Submit</button>
            <?php echo isset($verificar_3) ? $verificar_3 : ''; ?>

            <br><br><br>
            <span class="titulo_1"><h2>Pregunta 4:</h2></span>
            <br><br>
            Two fundamental concepts for studying change are 
            <span id="pregunta4"><?php echo isset($cuarto) && $cuarto !== '' ? str_replace('','',$cuarto) : '__________________'; ?></span> and 
            <span id="pregunta4_2"><?php echo isset($cuarto2) && $cuarto2 !== '' ? str_replace('',' and ', $cuarto2) : '__________________'; ?></span>
            .<br><br>
            <input style="margin:10px;" value="sequences" type="radio" name="cuarto" id="cuarto1" <?php echo isset($cuarto) && ($cuarto === 'sequences') ? 'checked' : ''; ?>>Sequences
            <input style="margin:10px;" value="limits of sequences" type="radio" name="cuarto2" id="cuarto2" <?php if ($cuarto2 === 'limits of sequences') echo 'checked'; ?>>Limits of sequences
            <br><br>
            <input style="margin:10px;" value="derivatives" type="radio" name="cuarto" id="cuarto3" <?php if ($cuarto === 'derivatives') echo 'checked'; ?>>Derivatives
            <input style="margin:10px;" value="integrals" type="radio" name="cuarto2" id="cuarto4" <?php if ($cuarto2 === 'integrals') echo 'checked'; ?>>Integrals
            <br><br>
            <button class="btn btn-primary" type="submit">Submit</button>
            <?php echo isset($verificar_4) ? $verificar_4 : ''; ?>

            <span class="titulo_1"><h2>Pregunta5:</h2></span>
            <br><br>
            In calculus, two fundamental problems are addressed. The first refers to finding
            <span id="pregunta1"><?php echo isset($quinto) && $quinto !== '' ? $quinto : '__________'; ?></span>. 
            the other is to 
            <span id="pregunta2"><?php echo isset($sexto) && $sexto !== '' ? $sexto : '__________'; ?></span>.
            <br><br>
            <input style="margin:10px;" value="tasa de cambio instantánea" type="radio" name="quinto" id="quinto1" <?php echo isset($quinto) && ($primero === 'tasa de cambio instantánea') ? 'checked' : ''; ?>>Tasa de cambio instantánea
            <input style="margin:10px;" value="area of a region in the plane" type="radio" name="quinto" id="quinto2" <?php if ($quinto === 'area of a region in the plane') echo 'checked'; ?>>area of a region in the
            plane
            <input style="margin:10px;" value="volumen de un sólido" type="radio" name="quinto" id="quinto3" <?php if ($primero === 'volumen de un sólido') echo 'checked'; ?>>Volumen de un sólido
            <br><br>
            <input style="margin:10px;" value="tasa de cambio instantánea" type="radio" name="sexto" id="sexto1" <?php echo isset($sexto) && ($sexto === 'tasa de cambio instantánea') ? 'checked' : ''; ?>>Tasa de cambio instantánea
            <input style="margin:10px;" value=" find the line tangent to a curve at a given point on the curve" type="radio" name="sexto" id="sexto2" <?php if ($sexto === ' find the line tangent to a curve at a given point on the curve') echo 'checked'; ?>>find the line tangent to a curve
            <input style="margin:10px;" value="límite de una función" type="radio" name="sexto" id="sexto3" <?php if ($sexto === 'límite de una función') echo 'checked'; ?>>Límite de una función
            <br><br>
            <button class="btn btn-primary" type="submit">Submit</button>
            <?php echo isset($verificar_5) ? $verificar_5 : ''; ?>
            <?php echo isset($verificar_6) ? $verificar_6 : ''; ?>

            <br><br><br>
            <span class="titulo_1"><h2>Pregunta 6:</h2></span>
            <br><br>
            Moreover, we will see that these two problems are, surprisingly, closely related, with the area problem actually being the
            <span id="pregunta1"><?php echo isset($septimo) && $septimo !== '' ? $septimo : '__________'; ?></span>
            of the tangent problem.<br><br>
            <input style="margin:10px;" value="Area" type="radio" name="septimo" id="septimo1" <?php echo isset($septimo) && ($septimo === 'area of a region in the plane') ? 'checked' : ''; ?>>Area
            <input style="margin:10px;" value="inverse" type="radio" name="septimo" id="septimo2" <?php if ($septimo === 'the sequences') echo 'checked'; ?>>inverse
            <br><br>
            <button class="btn btn-primary" type="submit">Submit</button>
            <?php echo isset($verificar_5) ? $verificar_5 : ''; ?>
            <br><br><br>
            <span class="titulo_1"><h2>Pregunta 7:</h2></span>
            <br><br>
            La proporción que guarda la longitud y el diámetro de una circunferencia
            <span id="pregunta7"><?php echo isset($octavo) && $octavo !== '' ? $octavo : '__________'; ?></span>.<br><br>
            <input style="margin:10px;" value='pi' type="radio" name="octavo" id="octavo1" <?php echo isset($octavo) && ($septimo === 'pi') ? 'checked' : ''; ?>>pi
            <input style="margin:10px;" value="e" type="radio" name="octavo" id="octavo2" <?php if ($octavo === 'e') echo 'checked'; ?>>e
            <br><br>
            <button class="btn btn-primary" type="submit">Submit</button>
            <?php echo isset($verificar_8) ? $verificar_8 : ''; ?>

            <br><br><br>
            <span class="titulo_1"><h2>Pregunta 8:</h2></span>
            <br><br>
            El círculo a continuación es de radio 1. ¿Cuál es la altura de los triángulos formados?<br><br>
            <img src="../../img/main-qimg-4a7c59773032eee7f3d4c623d8c5243b-pjlq.jpeg" alt="" width="200" height="200"><br>
            <input style="margin:10px;" value="cos(θ)" type="radio" name="nueve" id="nueve1" <?php echo isset($nueve) && ($nueve === 'cos(θ)') ? 'checked' : ''; ?>>cos(θ)
            <input style="margin:10px;" value="sen(θ)" type="radio" name="nueve" id="nueve2" <?php if ($nueve === 'sen(θ)') echo 'checked'; ?>>sen(θ)
            <input style="margin:10px;" value="tan(θ)" type="radio" name="nueve" id="nueve3" <?php if ($nueve === 'tan(θ)') echo 'checked'; ?>>tan(θ)
            <br><br>
            θ = π/n.
            <br>
            <button onmousedown="mostrarMensaje()" onmouseup="ocultarMensaje()">Dato</button>
            <div id="mensaje" style="display: none; margin-top: 10px; padding: 10px; background-color: #f0f0f0;">
            El ángulo de cualquier triángulo equilátero dentro del círculo es 2π/n. 
            Pero para encontrar la altura es necesario dividir el triángulo equilátero en dos triángulos rectángulos, 
            entonces (2π/n)/2 = π/n. 
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>

            <button onmousedown="mostrarMensaje2()" onmouseup="ocultarMensaje2()">Ayuda</button>
            <div id="mensaje2" style="display: none; margin-top: 10px; padding: 10px; background-color: #f0f0f0;">
            <p>
            <strong>cos(θ)</strong> =
            <sup>cat.adyacente</sup> /
            <sub>hipotenusa</sub> =
            <sup>height</sup> /
            <sub>r</sub> =
            <sup>/height</sup> /
            <sub>1</sub> = 
            <sup>height</sup>
            </p>
            </div>
            <?php echo isset($verificar_9) ? $verificar_9 : ''; ?>

        </form>
    </div>

    <div class="seccion derecha">
    <form action="./Primero.php" method="POST" onsubmit="handleSubmit(event)">
        <span class="titulo_1"><h2>Pregunta 9:</h2></span>
            <br><br>
            El círculo a continuación es de radio 1. ¿Cuál es la base de los triángulos formados?<br><br>
            <img src="../../img/main-qimg-4a7c59773032eee7f3d4c623d8c5243b-pjlq.jpeg" alt="" width="200" height="200"><br>
            <input style="margin:10px;" value="cos(θ)" type="radio" name="diez" id="diez1" <?php echo isset($diez) && ($diez === 'cos(θ)') ? 'checked' : ''; ?>>cos(θ)
            <input style="margin:10px;" value="sen(θ)" type="radio" name="diez" id="diez2" <?php if ($diez === 'sen(θ)') echo 'checked'; ?>>sen(θ)
            <input style="margin:10px;" value="2sin(pi/n)" type="radio" name="diez" id="diez3" <?php if ($diez === '2sin(pi/n)') echo 'checked'; ?>>2sin(pi/n)
            <br><br>
            <button class="btn btn-primary" type="submit">Submit</button>
            <button onmousedown="mostrarMensaje3()" onmouseup="ocultarMensaje3()">Ayuda</button>
            <div id="mensaje3" style="display: none; margin-top: 10px; padding: 10px; background-color: #f0f0f0;">
            <p>
            <strong>sin(θ)</strong> =
            <sup>cat.opuesto</sup> /
            <sub>hipotenusa</sub> =
            <sup>1/2(base)</sup> /
            <sub>1</sub> =
            <sup>1/2(base)</sup>
            </p>
            <p>
            <strong>2sin(θ)</strong> =
            <sup>(base)</sup> 
            </p>
            </div>
            <?php echo isset($verificar_10) ? $verificar_10 : ''; ?>
    </form>
    </div>
</body>
</html>
