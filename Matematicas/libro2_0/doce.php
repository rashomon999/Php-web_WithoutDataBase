<?php
// Variables de respuesta
$primero = ""; $segundo = ""; $tercero = ""; $cuarto = ""; $quinto = "";
$sexto = ""; $septimo = ""; $octavo = ""; $noveno = ""; $decimo = "";
$undecimo = ""; $duodecimo = ""; $decimotercero = ""; $decimocuarto = ""; $decimoquinto = "";
$decimosexto = ""; $decimoseptimo = ""; $decimooctavo = ""; $decimonoveno = ""; $vigesimo = "";
$vigesp = ""; $vigesimo_segundo = ""; $vigesimo_tercero = ""; $vigesimo_cuarto = ""; $vigesimo_quinto = "";
$vigesimo_sexto = ""; $vigesimo_septimo = ""; $vigesimo_octavo = ""; $vigesimo_noveno = ""; $trigesimo = "";
$trigesimo_primero = ""; $trigesimo_segundo = ""; $trigesimo_tercero = ""; $trigesimo_cuarto = ""; $trigesimo_quinto = "";
$trigesimo_sexto = ""; $trigesimo_septimo = ""; $trigesimo_octavo = ""; $trigesimo_noveno = ""; $cuadragesimo = "";
$cuadragesimo_primero = ""; $cuadragesimo_segundo = ""; $cuadragesimo_tercero = ""; $cuadragesimo_cuarto = ""; $cuadragesimo_quinto = "";
$cuadragesimo_sexto = ""; $cuadragesimo_septimo = ""; $cuadragesimo_octavo = ""; $cuadragesimo_noveno = ""; $quincuagesimo = "";
$quincuagesimo_primero = ""; $quincuagesimo_segundo = ""; $quincuagesimo_tercero = ""; $quincuagesimo_cuarto = ""; $quincuagesimo_quinto = "";
$quincuagesimo_sexto = ""; $quincuagesimo_septimo = ""; $quincuagesimo_octavo = ""; $quincuagesimo_noveno = "";

// Variables de verificación
$verificar_1 = ''; $verificar_2 = ''; $verificar_3 = ''; $verificar_4 = ''; $verificar_5 = '';
$verificar_6 = ''; $verificar_7 = ''; $verificar_8 = ''; $verificar_9 = ''; $verificar_10 = '';
$verificar_11 = ''; $verificar_12 = ''; $verificar_13 = ''; $verificar_14 = ''; $verificar_15 = '';
$verificar_16 = ''; $verificar_17 = ''; $verificar_18 = ''; $verificar_19 = ''; $verificar_20 = '';
$verificar_21 = ''; $verificar_22 = ''; $verificar_23 = ''; $verificar_24 = ''; $verificar_25 = '';
$verificar_26 = ''; $verificar_27 = ''; $verificar_28 = ''; $verificar_29 = ''; $verificar_30 = '';
$verificar_31 = ''; $verificar_32 = ''; $verificar_33 = ''; $verificar_34 = ''; $verificar_35 = '';
$verificar_36 = ''; $verificar_37 = ''; $verificar_38 = ''; $verificar_39 = ''; $verificar_40 = '';
$verificar_41 = ''; $verificar_42 = ''; $verificar_43 = ''; $verificar_44 = ''; $verificar_45 = '';
$verificar_46 = ''; $verificar_47 = ''; $verificar_48 = ''; $verificar_49 = ''; $verificar_50 = '';
$verificar_51 = ''; $verificar_52 = ''; $verificar_53 = ''; $verificar_54 = ''; $verificar_55 = '';
$verificar_56 = ''; $verificar_57 = ''; $verificar_58 = ''; $verificar_59 = '';

// Variable para mostrar solución
$mostrar_solucion = '';

if ($_POST) {
    $mostrar_solucion = isset($_POST['mostrar_solucion']) ? $_POST['mostrar_solucion'] : '';
  
    if ($mostrar_solucion === 'mostrar_solucion') {  
        // Establecer todas las respuestas correctas
        $primero = 'cx+C';
        $verificar_1 = "correcto";
        
        $segundo = 'x';
        $verificar_2 = "correcto";
        
        $tercero = 'xu+c';
        $verificar_3 = "correcto";
        
        $cuarto = 'xLn(2x)-x+C';
        $verificar_4 = "correcto";
        
        $quinto = '2x';
        $verificar_5 = "correcto";
        
        $sexto = '2';
        $verificar_6 = "correcto";
        
        $septimo = '+C';
        $verificar_7 = "correcto";
        
        $octavo = '\frac{x^3Lnx}{3}-\frac{x}{9}+C';
        $verificar_8 = "correcto";
        
        $noveno = '4';
        $verificar_9 = "correcto";
        
        $decimo = 'x';
        $verificar_10 = "correcto";
        
        $undecimo = '+C';
        $verificar_11 = "correcto";
        
        $duodecimo = '2xln(x)-2x+C';
        $verificar_12 = "correcto";
        
        $decimotercero = '3x';
        $verificar_13 = "correcto";
        
        $decimocuarto = '3';
        $verificar_14 = "correcto";
        
        $decimoquinto = '+C';
        $verificar_15 = "correcto";
        
        $decimosexto = '\frac{1}{2}x^3e^{2x}-\frac{3}{4}x^2e^{2x}+\frac{3}{4}xe^{2x}-\frac{3}{8}e^{2x}+C';
        $verificar_16 = "correcto";
        
        $vigesimo = '-\frac{1}{2}x^3Cos(2x)+\frac{3}{4}x^2Sin(2x)+\frac{3}{4}xCos(2x)-\frac{3}{8}Sin(2x)+C';
        $verificar_20 = "correcto";
        
        $vigesp = 'x';
        $verificar_21 = "correcto";
        
        $vigesimo_segundo = '3';
        $verificar_22 = "correcto";
        
        $vigesimo_tercero = '+C';
        $verificar_23 = "correcto";
        
        $vigesimo_cuarto = '3x';
        $verificar_24 = "correcto";
        
        $vigesimo_quinto = '5/3';
        $verificar_25 = "correcto";
        
        $vigesimo_sexto = '3';
        $verificar_26 = "correcto";
        
        $vigesimo_septimo = '+C';
        $verificar_27 = "correcto";
        
        $vigesimo_octavo = '2x';
        $verificar_28 = "correcto";
        
        $vigesimo_noveno = '3/2';
        $verificar_29 = "correcto";
        
        $trigesimo = '3';
        $verificar_30 = "correcto";
        
        $trigesimo_primero = '+C';
        $verificar_31 = "correcto";
        
        $trigesimo_segundo = '3x';
        $verificar_32 = "correcto";
        
        $trigesimo_tercero = '2/3';
        $verificar_33 = "correcto";
        
        $trigesimo_cuarto = '2';
        $verificar_34 = "correcto";
        
        $trigesimo_quinto = '+C';
        $verificar_35 = "correcto";
        
        $trigesimo_sexto = 'Ln';
        $verificar_36 = "correcto";
        
        $trigesimo_septimo = '|x|';
        $verificar_37 = "correcto";
        
        $trigesimo_octavo = '+C';
        $verificar_38 = "correcto";
        
        $trigesimo_noveno = '+C';
        $verificar_39 = "correcto";
        
        $cuadragesimo = '5';
        $verificar_40 = "correcto";
        
        $cuadragesimo_primero = '4';
        $verificar_41 = "correcto";
        
        $cuadragesimo_segundo = 'Ln|x|';
        $verificar_42 = "correcto";
        
        $cuadragesimo_tercero = '+C';
        $verificar_43 = "correcto";
        
        $cuadragesimo_cuarto = '3';
        $verificar_44 = "correcto";
        
        $cuadragesimo_quinto = '5';
        $verificar_45 = "correcto";
        
        $cuadragesimo_sexto = '3';
        $verificar_46 = "correcto";
        
        $cuadragesimo_septimo = 'x^5';
        $verificar_47 = "correcto";
        
        $cuadragesimo_octavo = '2';
        $verificar_48 = "correcto";
        
        $cuadragesimo_noveno = '3x^3';
        $verificar_49 = "correcto";
        
        $quincuagesimo = '3';
        $verificar_50 = "correcto";
        
        $quincuagesimo_primero = '+C';
        $verificar_51 = "correcto";
        
        $quincuagesimo_segundo = '8';
        $verificar_52 = "correcto";
        
        $quincuagesimo_tercero = '3';
        $verificar_53 = "correcto";
        
        $quincuagesimo_cuarto = '2';
        $verificar_54 = "correcto";
        
        $quincuagesimo_quinto = 'x^3';
        $verificar_55 = "correcto";
        
        $quincuagesimo_sexto = '-4';
        $verificar_56 = "correcto";
        
        $quincuagesimo_septimo = '2';
        $verificar_57 = "correcto";
        
        $quincuagesimo_octavo = 'x';
        $verificar_58 = "correcto";
        
        $quincuagesimo_noveno = '+C';
        $verificar_59 = "correcto";
        
    } else {
    $mostrar_solucion = isset($_POST['mostrar_solucion']) ? $_POST['mostrar_solucion'] : '';
  
    if ($mostrar_solucion === 'mostrar_solucion') {  
        // Establecer todas las respuestas correctas
        $cuarto = '-\\frac{1}{4}Cos^4x+C';
        $verificar_4 = "correcto";
        
        $octavo = '-\\frac{1}{Senx}+C';
        $verificar_8 = "correcto";
        
        $duodecimo = '-\\frac{1}{2Sen^2x}+C';
        $verificar_12 = "correcto";
        
        $decimosexto = '\\frac{1}{2Cos^2x}+C';
        $verificar_16 = "correcto";
        
        $vigesimo = '-2ln(cosx)+C';
        $verificar_20 = "correcto";
        
        $vigesimo_cuarto = '3xe^x-3e^x+C';
        $verificar_24 = "correcto";
        
        $vigesimo_octavo = '-2xCosx+2Senx+C';
        $verificar_28 = "correcto";
        
    } else {
    
    $cuarto = isset($_POST['cuarto']) ? $_POST['cuarto'] : '';

    if ($cuarto === '-\frac{1}{4}Cos^4x+C') {
        $verificar_4 = "correcto";
    } elseif ($cuarto === '') {
        $verificar_4 = '';
    } else {
        $verificar_4 = "incorrecto";
    }

    
   
    $octavo = isset($_POST['octavo']) ? $_POST['octavo'] : '';

    if ($octavo === '-\frac{1}{Senx}+C') {
        $verificar_8 = "correcto";
    } elseif ($octavo === '') {
        $verificar_8 = '';
    } else {
        $verificar_8 = "incorrecto";
    }

  
    // Verificar la respuesta de la duodécima pregunta
    $duodecimo = isset($_POST['duodecimo']) ? $_POST['duodecimo'] : '';
    if ($duodecimo === '-\frac{1}{2Sen^2x}+C') {
        $verificar_12 = "correcto";
    } elseif ($duodecimo === '') {
        $verificar_12 = '';
    } else {
        $verificar_12 = "incorrecto";
    }


$decimosexto = isset($_POST['decimosexto']) ? $_POST['decimosexto'] : '';
if ($decimosexto === '\frac{1}{2Cos^2x}+C') {
    $verificar_16 = "correcto";
} elseif ($decimosexto === '') {
    $verificar_16 = '';
} else {
    $verificar_16 = "incorrecto";
}


$vigesimo = isset($_POST['vigesimo']) ? $_POST['vigesimo'] : '';
if ($vigesimo === '-2ln(cosx)+C' || $vigesimo === '-2ln[cosx]+C' || $vigesimo === '-2Ln(Cosx)+C' || $vigesimo === '-2Ln[Cosx]+C') {
    $verificar_20 = "correcto";
} elseif ($vigesimo === '') {
    $verificar_20 = '';
} else {
    $verificar_20 = "incorrecto";
}


$vigesimo_cuarto = isset($_POST['vigesimo_cuarto']) ? $_POST['vigesimo_cuarto'] : '';
if ($vigesimo_cuarto === '3xe^x-3e^x+C') {
    $verificar_24 = "correcto";
} elseif ($vigesimo_cuarto === '') {
    $verificar_24 = '';
} else {
    $verificar_24 = "incorrecto";
}

$vigesimo_octavo = isset($_POST['vigesimo_octavo']) ? $_POST['vigesimo_octavo'] : '';
if ($vigesimo_octavo === '-2xCosx+2Senx+C') {
    $verificar_28 = "correcto";
} elseif ($vigesimo_octavo === '') {
    $verificar_28 = '';
} else {
    $verificar_28 = "incorrecto";
}

}
}}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas sobre simplificación de expresiones matemáticas</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="doce.css">
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<style>
    .imagen {
        max-width: 100%;
        height: auto;
    }

     .seccion {
    width: 50%; /* El 50% del ancho de la página menos el margen izquierdo */
    padding: 20px; /* importante este padding*/
    box-sizing: border-box;
    height: 240vh;
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

        // Asegúrate de que MathJax procese el nuevo contenido
        if (window.MathJax) {
            MathJax.typeset();
        }
        actualizarFormula();
        actualizarFormula2();
        actualizarFormula3();
        actualizarFormula4();
        actualizarFormula5();
        actualizarFormula6();
        actualizarFormula7();
       
    })
    .catch(error => {
        console.error('Error al enviar el formulario:', error);
    });
}

function actualizarFormula() {
    // Obtener los valores de los inputs
   
    var f = document.getElementById('cuarto').value || "";
    


    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;

    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula').innerHTML = `$$ ${formula} $$`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula2() {
    // Obtener los valores de los inputs
   
    var f = document.getElementById('octavo').value || "";
  


    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;

    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula2').innerHTML = `$$ ${formula} $$`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula3() {
    // Obtener los valores de los inputs
   
    var f = document.getElementById('duodecimo').value || "";
 


    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;

    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula3').innerHTML = `$$ ${formula} $$`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula4() {
    // Obtener los valores de los inputs
    var f = document.getElementById('decimosexto').value || "";
 

    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula4').innerHTML = `$$ ${formula} $$`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}


function actualizarFormula5() {
    // Obtener los valores de los inputs
    var f = document.getElementById('vigesimo').value || "";
 

    // Construir la fórmula dinámica
    var formula = ` \\ ${f} \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula5').innerHTML = `$$ ${formula} $$`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}


function actualizarFormula6() {
    // Obtener los valores de los inputs
    var f = document.getElementById('vigesimo_cuarto').value || "";
   

    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula24').innerHTML = `$$ ${formula} $$`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}


function actualizarFormula7() {
    // Obtener los valores de los inputs
    var f = document.getElementById('vigesimo_octavo').value || "";
 

    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula7').innerHTML = `$$ ${formula} $$`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
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
    <form action="./doce.php" method="POST" onsubmit="handleSubmit(event)">
    Ejemplo (integral comun y famosa):
    \( \int Sen^2x \, Cosx \, dx  \) <br>

    \( \int (Senx)^2 \, Cosx \, dx  \) <br><br>

    \( u=Senx ,  \,\,\, du = Cosx \, dx\) <br><br>

    \(  \int u^2 * du \) <br><br>

    \( \frac{u^3}{3} + C  \) = \( \frac{Sen^3x}{3} \, +C \)
    <hr>
    La integral indefinida de \( Cos^3x \,\, + \,\, Senx dx \) es: <br>
        \(
        \int Cos^3x \,\, + \,\, Senx \, dx = \)
        <span id="formula">
            \( \frac{0}{0} \)
        </span> 
         <br><br>
        <input type="text" name="cuarto" size="20" id="cuarto" oninput="actualizarFormula()" value=<?php echo $cuarto?>>
         
    <br>
    <button type="submit">enviar</button>
    <?php echo $verificar_4 ?>
    <hr>
    La integral indefinida de \( \frac{Cosx}{Sen^2x} dx \) es: <br>
        \(
        \int  \frac{Cosx}{Sen^2x}  \, dx = \)
        <span id="formula2">
        \( \frac{0}{0} \)
    </span>
    <br><br>
    <input type="text" name="octavo" size="20" id="octavo" oninput="actualizarFormula2()" value="<?php echo $octavo?>">
     
    <br>
    <button type="submit">enviar</button>
    <?php echo $verificar_8 ?>
    <hr>


    <p>
    La integral indefinida de \( \frac{Cotx}{Sen^2x} \) es: <br>
    \(
    \int \frac{Cotx}{Sen^2x} \, dx = 
    \)
    </p>
    <span id="formula3">
        \( \frac{0}{0} \)
    </span> 
     
    <br><br>

    <input type="text" name="duodecimo" size="20" id="duodecimo" oninput="actualizarFormula3()" value="<?php echo $duodecimo ?>">
  
    <br>
    <button type="submit">enviar</button>

     <?php echo $verificar_12 ?>
    <hr>


    La integral indefinida de \( \frac{Senx}{Cos^3x} \) es: <br>
    \(
    \int \frac{Senx}{Cos^3x} \, dx = 
    \)
    <span id="formula4">
        \( \frac{0}{0} \)
    </span> 
    <br><br>

    <input type="text" name="decimosexto" size="20" id="decimosexto" oninput="actualizarFormula4()" value="<?php echo $decimosexto ?>">

    <br>
    <button type="submit">enviar</button>

    <?php echo $verificar_16 ?>

    <hr>
    <p>
    La integral indefinida de \( \frac{2Senx}{Cosx} \) es: <br>
    \(
    \int \frac{2Senx}{Cosx} \, dx = 
    \)
    </p>

    <span id="formula5">
        \( \frac{0}{0} \)
    </span> 
     
    <br><br>

    <input type="text" name="vigesimo" size="20" id="vigesimo" oninput="actualizarFormula5()" value="<?php echo $vigesimo ?>">
     
    <br>
    <button type="submit">enviar</button>

    <?php echo $verificar_20 ?>
    </form>
</div>
<div class="seccion derecha">
    <form action="./doce.php" method="POST" onsubmit="handleSubmit(event)">


        <Strong>Integracion por partes: </Strong>
        <p>Sirve cuando el integrando esta formado por un producto o una division que se podra escribir
            como producto 
        </p>
        <p>
            \( \int u * dv = u*v \, - \, \int v du  \)
        </p>
        Palabra que nos ayuda a distinguir a u y dv (u tiene mas prioridad que dv ). <br>
        <strong>ILATE.</strong>   (inversa, logaritmica, algebraica, trigonometrica, exponencial). <br>
        ej: \( e * ln. \) (ln es u y e es dv). <br>
        
        Nota: dv se selecciona junto con el dx. <br>
        <br>
        <p>
            <Strong>Ejemplo: </Strong>
            \( \int x^2 * Lnx \, dx\) <br><br>
            Si analisamos tenemos A y L , en ILATE va primero la L entonces \( Lnx \) es u y 
            \( x^2 \) es dv. <br><br>
            \( u = Lnx   \,\,  , \,\, dv = x^2 dx\) <br><br>
            derivamos u, integramos dv. <br><br>
            \( du = \frac{1}{x}  \,\, , \,\,  v=\frac{x^3}{3} \) <br><br>
            Reemplazamos: <br><br>
            \( \int x^2 Lnx \, dx = \,\,\,\, Lnx*\frac{x^3}{3} - \int \frac{x^3}{3} * \frac{1}{x}  dx\)
            <br><br>
        </p>
        <hr>
        Caso exponencial: como vimos en integral por sustitucion, la derivada del exponente de e debia ser 
        algo parecido a lo que acompaña a e, pero por ejemplo, en este caso esta x, que no aparece por ningun
        sitio en la derivada (2). <br><br>
        \( \int x e^{2x} \) <br><br>
        \(  u = x \,\,\, , \,\, dv = e^{2x} dx \) <br><br>
        \( du = dx  \,\,\, , \,\, v = \frac{1}{2} e^{2x} \) <br><br>
        reemplazamos: <br><br>
        \( \int x e^{2x} = \, x*\frac{1}{2}e^{2x} \,\,  -  \,\, \int \frac{1}{2} e^{2x} dx \) <br><br>
        \( =\frac{1}{2}x e^{2x} - \frac{1}{2}  * \frac{1}{2} e^{2x} +C \) <br><br>
        \( =\frac{1}{2}x e^{2x} - \frac{1}{4}  e^{2x} +C \) 
        <hr>
        <p>
        La integral indefinida de \( 3x e^x \) es: <br>
        \(
        \int  3x e^x  \, dx = 
        \)
        </p>

        <span id="formula24">
        \( \frac{0}{0} \)
        </span> 
         
        <br><br>

        <input type="text" name="vigesimo_cuarto" size="20" id="vigesimo_cuarto" oninput="actualizarFormula6()" value="<?php echo $vigesimo_cuarto ?>">
   
        <br>
        <button type="submit">enviar</button>

        <?php echo $verificar_24 ?>
        <hr>



        <p>
        La integral indefinida de \( 2x Senx \) es: <br>
        \(
        \int 2x Senx  \, dx = 
        \)
        </p>
        <span id="formula7">
        \( \frac{0}{0} \)
        </span> 
         
        <br><br>

        <input type="text" name="vigesimo_octavo" size="20" id="vigesimo_octavo" oninput="actualizarFormula7()" value="<?php echo $vigesimo_octavo ?>">
         
        <br>
        <button type="submit">enviar</button>
        <?php echo $verificar_28 ?>

        
    <hr>
    <strong>si desea ver las soluciones escribir: mostrar_solucion</strong>
    <br>
    <input type="text" id="mostrar_solucion" name="mostrar_solucion"  value="<?php echo $mostrar_solucion?>">
    <button type="submit"   >Mostrar Solución</button>
        
    </form>
</div>
<div class="centered-container">
    <a
        name="siguiente"
        id="siguiente"
        class="btn btn-primary"
        href="trece.php"
        role="button"
        width="50px"
        height="50px"
    >Siguiente</a>
</div>
</body>
</html>
