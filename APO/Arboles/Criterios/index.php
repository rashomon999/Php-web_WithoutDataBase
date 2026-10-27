<?php
/* ==========================================================================
   APO / Arboles / Criterios  —  Como elige el arbol donde cortar:
                                 Gini, entropia, ganancia, gain ratio, varianza
   Fuentes: 00_Arboles de decision y CART.pptx · 01_AprendSup-Arboles1.pptx
            (taller Golf, ID3) · 00_intro_arboles.ipynb (ejemplo Edad/Salario)
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. la idea */
    1  => ['impureza', 'impuridad'],
    2  => ['puro', 'pura', 'puros'],

    /* 2. las medidas */
    3  => ['gini', 'indice de gini'],
    4  => ['entropia'],
    5  => ['ganancia de informacion', 'information gain', 'ganancia'],
    6  => ['gain ratio', 'relacion de ganancia', 'razon de ganancia', 'ratio de ganancia'],
    7  => ['reduccion de varianza', 'reduction in variance', 'varianza'],

    /* 3. Gini */
    8  => ['0', 'cero'],
    9  => ['0.5', '0,5'],
    10 => ['0.444', '0,444', '0.4444', '0,4444', '0.44', '0,44', '4/9'],
    11 => ['0.375', '0,375'],
    12 => ['0', 'cero'],
    13 => ['0.167', '0,167', '0.1667', '0,1667', '0.1666', '0,1666', '0.17', '0,17', '1/6'],
    14 => ['0.296', '0,296', '0.2963', '0,2963', '0.30', '0,30', '0.3', '0,3', '8/27'],
    15 => ['edad'],
    16 => ['menor', 'minimo', 'mas bajo', 'mas pequeno'],

    /* 4. entropia */
    17 => ['desorden', 'aleatoriedad', 'incertidumbre'],
    18 => ['2'],
    19 => ['1.75', '1,75'],
    20 => ['0.94', '0,94', '0.940', '0,940'],
    21 => ['0.694', '0,694', '0.69', '0,69'],
    22 => ['0.247', '0,247', '0.25', '0,25', '0.246', '0,246'],
    23 => ['outlook'],
    24 => ['mayor', 'maxima', 'mas alta', 'mas grande'],
    25 => ['overcast'],
];
$TEXTO = range(1, 25);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Un nodo tiene <b>10 muestras de la clase A y 0 de la clase B</b>. Otro tiene <b>5 y 5</b>. &iquest;Cual es mejor para una hoja y por que?',
        'opciones' => [
            'a' => 'El de 5 y 5, porque esta balanceado',
            'b' => 'El de <b>10 y 0</b>: es puro (Gini = 0, entropia = 0); el de 5 y 5 es el caso de maxima mezcla',
            'c' => 'Los dos son iguales porque tienen 10 muestras',
            'd' => 'Ninguno; las hojas deben tener exactamente una muestra'
        ],
        'porque'   => 'Lo que busca el arbol en cada corte es que los hijos queden lo mas puros posible. Con dos clases, Gini va de 0 (puro) a 0,5 y la entropia de 0 a 1 bit.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => '&iquest;Por que existe el <b>gain ratio</b> (C4.5) si ya teniamos la ganancia de informacion?',
        'opciones' => [
            'a' => 'Porque la ganancia de informacion no sirve con dos clases',
            'b' => 'Porque la ganancia de informacion esta <b>sesgada hacia los atributos con muchos valores distintos</b>; el gain ratio la corrige teniendo en cuenta cuantas ramas saldrian',
            'c' => 'Porque el gain ratio es mas rapido de calcular',
            'd' => 'Porque el gain ratio sirve para regresion'
        ],
        'porque'   => 'Un atributo como un ID unico partiria el conjunto en hojas de 1 elemento (todas puras) y "ganaria" siempre, sin servir para nada en datos nuevos.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'En un arbol de <b>regresion</b> (CART) &iquest;que se minimiza al escoger el corte?',
        'opciones' => [
            'a' => 'El indice de Gini',
            'b' => 'La entropia',
            'c' => 'La <b>varianza</b> (suma de cuadrados de los errores) dentro de las regiones resultantes',
            'd' => 'El numero de hojas'
        ],
        'porque'   => 'No hay clases que mezclar: hay numeros. Un buen corte deja en cada lado valores parecidos entre si, o sea, con poca dispersion. Es lo que hace <code>CalculateLoss()</code> en el notebook del libro: <code>sum((y - y.mean())**2)</code>.',
        'correcta' => 'c'
    ],
    'm4' => [
        'texto'    => 'Las diapositivas dicen que el arbol minimiza la <b>impureza</b> y no directamente el error de clasificacion. &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque el error de clasificacion no se puede calcular',
            'b' => 'Porque minimizar el error de clasificacion haria a los arboles <b>todavia mas sensibles a pequenos cambios</b> en los datos',
            'c' => 'Porque la impureza siempre da 100% de exactitud',
            'd' => 'Porque es lo mismo'
        ],
        'porque'   => 'Es la nota de la diapositiva de clasificacion (35 R / 31 A). La impureza es una medida mas "suave" que premia ir haciendo los nodos mas puros aunque la clase mayoritaria no cambie.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Árboles 2 — Criterios de división',
         '00_Arboles de decision y CART.pptx · 01_AprendSup-Arboles1.pptx · 00_intro_arboles.ipynb');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>En cada nodo el arbol tiene que decidir <b>que variable</b> usar para cortar y
     <b>donde</b>. Aqui van las medidas que usa para decidirlo y dos ejemplos hechos a mano
     (Gini con Edad/Salario y entropia con el dataset del golf).</p>
  <div class="nota">Respuestas en <b>texto</b>. Los decimales aceptan punto o coma y 2 o 3 cifras.</div>
</div>


<div class="card">
  <h2>1. La idea</h2>
  <p>Un buen corte separa los datos en grupos con clases poco mezcladas. Esa mezcla se mide con
     una funcion de <?php hueco(1, 10); ?>. Si todos los ejemplos de un nodo son de la misma clase,
     el nodo es <?php hueco(2, 6); ?>.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Las cinco medidas</h2>
  <table class="datos">
    <tr><th>Medida</th><th>Para que</th></tr>
    <tr><td><?php hueco(3, 8); ?></td><td>probabilidad de etiquetar mal un ejemplo escogido al azar; es la de CART en clasificacion</td></tr>
    <tr><td><?php hueco(4, 10); ?></td><td>mide la aleatoriedad de la informacion; cuanto mas alta, mas dificil sacar conclusiones</td></tr>
    <tr><td><?php hueco(5, 20); ?></td><td>entropia antes de dividir menos entropia promedio despues; la usa ID3</td></tr>
    <tr><td><?php hueco(6, 14); ?></td><td>la anterior corregida por el numero de ramas; la usa C4.5</td></tr>
    <tr><td><?php hueco(7, 20); ?></td><td>para variables objetivo continuas (regresion)</td></tr>
  </table>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Gini a mano</h2>
  <pre><code>Gini = 1 − Σ pᵢ²                 Gini ponderado = Σ ( |Sⱼ| / |S| ) · Giniⱼ</code></pre>
  <p>Con dos clases, un nodo puro tiene Gini = <?php hueco(8, 4); ?> y uno mitad y mitad
     tiene Gini = <?php hueco(9, 5); ?>.</p>

  <table class="datos">
    <tr><th>ID</th><th>Edad</th><th>Salario</th><th>Compra</th></tr>
    <tr><td>1</td><td>Joven</td><td>Bajo</td><td>No</td></tr>
    <tr><td>2</td><td>Joven</td><td>Medio</td><td>No</td></tr>
    <tr><td>3</td><td>Joven</td><td>Alto</td><td>Si</td></tr>
    <tr><td>4</td><td>Joven</td><td>Bajo</td><td>No</td></tr>
    <tr><td>5&ndash;9</td><td>Adulto</td><td>Medio, Alto, Bajo, Medio, Alto</td><td>Si (los 5)</td></tr>
  </table>

  <table class="datos">
    <tr><th>Calculo</th><th>Resultado</th></tr>
    <tr><td>Nodo raiz: 6 Si, 3 No &rarr; 1 &minus; ((6/9)&sup2; + (3/9)&sup2;)</td><td><?php hueco(10, 6); ?></td></tr>
    <tr><td>Grupo Joven: 3 No, 1 Si</td><td><?php hueco(11, 6); ?></td></tr>
    <tr><td>Grupo Adulto: 5 Si</td><td><?php hueco(12, 4); ?></td></tr>
    <tr><td>Gini ponderado partiendo por Edad = (4/9)&middot;0,375 + (5/9)&middot;0</td><td><?php hueco(13, 6); ?></td></tr>
    <tr><td>Gini ponderado partiendo por Salario (Bajo 2No/1Si, Medio 1No/2Si, Alto 3Si)</td><td><?php hueco(14, 6); ?></td></tr>
  </table>
  <p>Se parte primero por <?php hueco(15, 8); ?>, porque es la que deja el Gini ponderado
     <?php hueco(16, 7); ?>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Entropia y ganancia de informacion (ID3)</h2>
  <pre><code>H = − Σ pᵢ · log₂(pᵢ)            Ganancia(X) = H(padre) − Σ ( |Sⱼ| / |S| ) · H(Sⱼ)</code></pre>
  <p>La entropia mide el <?php hueco(17, 10); ?>: es alta cuando la distribucion es uniforme y
     hay poca predictibilidad. Se mide en bits.</p>
  <table class="datos">
    <tr><th>Distribucion</th><th>Entropia</th></tr>
    <tr><td>4 simbolos equiprobables (0,25 cada uno)</td><td><?php hueco(18, 4); ?> bits</td></tr>
    <tr><td>probabilidades 0,5 · 0,25 · 0,125 · 0,125</td><td><?php hueco(19, 5); ?> bits</td></tr>
  </table>

  <h3>Taller del golf (14 dias, 9 "yes" y 5 "no")</h3>
  <table class="datos">
    <tr><th>Paso</th><th>Resultado</th></tr>
    <tr><td>Entropia de la clase <code>play</code></td><td><?php hueco(20, 6); ?></td></tr>
    <tr><td>Entropia condicional de <code>outlook</code>: sunny 2y/3n, overcast 4y/0n, rainy 3y/2n</td><td><?php hueco(21, 6); ?></td></tr>
    <tr><td>Ganancia de <code>outlook</code> = 0,940 &minus; 0,694</td><td><?php hueco(22, 6); ?></td></tr>
    <tr><td>Ganancias de las otras: humidity 0,152 · windy 0,048 · temperature 0,029</td><td>&mdash;</td></tr>
  </table>
  <p>El nodo raiz es <code><?php hueco(23, 9); ?></code>, porque se elige el atributo con la
     ganancia de informacion <?php hueco(24, 7); ?>. Ademas, la rama
     <code><?php hueco(25, 9); ?></code> queda pura (4 yes, 0 no) y ya es una hoja.</p>
  <?php mc('m4'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Basico/index.php', '../Poda/index.php');
