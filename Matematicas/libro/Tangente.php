<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="Tangente.css">
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
        <form action="./Tangente.php" method="POST" onsubmit="handleSubmit(event)">
            <br><br>
            <img src="..\img\Captura de pantalla 2024-06-26 084851.png" alt="">
            <br><br>
            -Objetivo saber la pendiente de la recta tangente en (1,1).
            -De la recta secante renemos dos puntos (1,1) y (2,4), este es el punto de partida.
            <br><br>
            -sabemos que C (x^2), esta definida para -infinito,infinito. pero dado que queremos la recta
            tangente que pasa por (1,1), solo nos interesa aproximarnos desde (2,4) a (1,1).
            <br><br>
            -Es decir, el punto fijo (el que queremos por el que pase la recta tangente), es (1,1).
            <br><br>
            -Elegimos x  bajo el criterio de ser un numero mayor a 1 y menor 2:
            <br><br>
            <img src="..\img\Captura de pantalla 2024-06-26 092224.png" alt="">
            <br><br>
            Partiendo de m1 (la pendiente de la recta entre (1,1) y (2,4)), generalizamos las aproxomaciones...
            <br><br>
            Garantizando que se aproxima desde numeros mayores (1,1).
            <img src="..\img\Captura de pantalla 2024-06-26 092611.png" alt="">
            <br><br>
            Se observa como:
            <img src="..\img\Captura de pantalla 2024-06-26 093505.png" alt="">
            <br><br>
            Pendiente entre (1,1) y la generalizacion de la aproximacion. <br>
            <img src="..\img\Captura de pantalla 2024-06-26 094234.png" alt="">
            <br><br>
            Limite de la pendiente y recta tangente en (1,1):
            <br><br>
            <img src="..\img\Captura de pantalla 2024-06-26 094447.png" alt="">
            <br><br>
            <span class="titulo_1"><h2>Pregunta 1:</h2></span>
            <br><br>
            Use Figure 1.1.4 to verify that a parallelogram with height 𝑎 and base of length 𝑏
            has area 𝑎𝑏. <br>
            3 forma de evidenciar la igualdad:
            <br><br>
            -Si sumamos ambos lados parelelos (con (f y f1) respectivamente), obtendremos un rectangulo.
            <img src="..\img\Captura de pantalla 2024-06-26 115643.png" alt=""><br><br><br>
            -Otra forma de mirar es como c-f1 = a-f, obteniendo de igual forma un rectangulo.
            <br><br>
            - Por ultimo, a puede ser visto como la suma de dos valores x+z y c como z+x. siendo x el 
            segmeneto de 2-10.
            
    </div>

    <div class="seccion derecha">
        <form action="./Tangente.php" method="POST" onsubmit="handleSubmit(event)">
        <span class="titulo_1"><h2>Pregunta2 :</h2></span>
        como un triangulo es la mitad de un paralelogramo?
        Para hacer la division en dos triangulos, es conveniente que el lado superior comience antes 
        que el inferior, de manera que se formen subtruangulos que me permitan distinguir la altura de los 
        triangulos recien formados.
        <img src="..\img\Captura de pantalla 2024-06-26 130745.png" width="500" alt=""> <br>
        Una forma de saber el area de uno de estos dos triangulos es volver a dividir uno de estos en dos 
        para que se formen dos triangulos rectangulos y luego sumar las areas 
        <br>
        Denominamos a los triangulos resultados de la division A0 y A1. <br><br>
        Asi, en la parte de abajo tenemos A0.1 =(8*5)/2=22.5 y A0.2 =(1*5)/2=2.5  para que A0=25. de manera que el
        area del paralelogramo es A0+A1 = 25+25 = 50.
        <br><br><br>
        <span class="titulo_1"><h2>Pregunta3 :</h2></span>
        Utilice la imagen para verificar las formulas de la base y la altura de uno de los triangulos
        isosceles de Pn. 
        <br>
        <img src="..\img\Captura de pantalla 2024-06-26 132334.png" alt="">
        <br><br><br>
        Area de triangulo isosceles= 1/2(b*h) <br>
        Esto ya lo hicimos, si queremos despejar bn, entonces Sin(pi/n) = (1/2)*bn/h  = (1/2)*bn/1 = (1/2)bn
        =bn/2.
        <br>
        Entonces 2sin(pi/n) = bn.
        <br><br>
        Para despejar hn Entonces Cos(pi/n)=hn/h=hn/1=hn
        <br>
        Entonces Cos(pi/n)=hn.
        <br>
        El area del triangulo total = (2Sin(pi/n)*Cos(pi/n))/2
        = Sin(pi/n)*Cos(pi/n).
        <br><br>
        Para simplificar esto utilizamos: sin(20)=2sin(0)*cos(0), 
        por lo que queda 1/2sin*(pi/n) 
        <br><br><br>
        <span class="titulo_1"><h2>Pregunta4 :</h2></span>
        <h3>a)</h3>
        <br>
        <img src="..\img\Captura de pantalla 2024-06-26 153852.png" alt=""><br>
        <img src="..\img\Captura de pantalla 2024-06-26 154007.png" alt=""><br>
        <img src="..\img\Captura de pantalla 2024-06-26 154141.png" alt=""><br>
        <img src="..\img\Captura de pantalla 2024-06-26 154311.png" alt="" width="600 "height="400">

    </div>
    <div class="centered-container">
        <a
        name="siguiente"
        id="siguiente"
        class="btn btn-primary"
        href="Ejercicios.php"
        role="button"
        width="50px"
        height="50px"
        >Siguiente</a>
        </div>
</body>
</html>