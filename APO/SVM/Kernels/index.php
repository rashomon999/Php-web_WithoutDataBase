<?php
/* ==========================================================================
   APO / SVM / Kernels  —  Margen duro vs blando, el parametro C,
                           el truco del kernel y los tipos de kernel (gamma)
   Fuentes: SVM.pdf (Anibal Sosa) · 0_SVM_theory_examples_v2.ipynb ·
            1_SVM-sklearn.ipynb · 2_SVM_Exercises.ipynb · articulo de Medium
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* --- 1. margen duro vs blando --- */
    1  => ['margen duro', 'hard margin', 'duro'],
    2  => ['separables', 'linealmente separables', 'separable'],
    3  => ['outliers', 'atipicos', 'valores atipicos', 'outlier', 'datos atipicos'],
    4  => ['margen blando', 'soft margin', 'blando', 'margen suave', 'suave'],
    5  => ['holgura', 'slack', 'variables de holgura'],

    /* --- 2. el parametro C --- */
    6  => ['angosto', 'estrecho', 'pequeno', 'delgado', 'mas angosto', 'mas estrecho'],
    7  => ['sobreajuste', 'overfitting', 'sobreajustar'],
    8  => ['ancho', 'amplio', 'grande', 'mas ancho', 'mas amplio'],
    9  => ['subajuste', 'underfitting', 'subajustar'],
    10 => ['lambda', 'λ'],

    /* --- 3. el truco del kernel --- */
    11 => ['mayor', 'mas alta', 'superior', 'alta', 'mas grande'],
    12 => ['origen'],
    13 => ['infinitas', 'infinita', 'miles'],
    14 => ['producto punto', 'producto escalar', 'producto interno'],
    15 => ['similitud', 'similaridad', 'parecido'],

    /* --- 4. los tipos de kernel --- */
    16 => ['separables', 'linealmente separables', 'separable'],
    17 => ['grado', 'grado d', 'd'],
    18 => ['defecto', 'por defecto'],
    19 => ['tanh', 'tangente hiperbolica'],
    20 => ['rbf', 'gaussiano'],

    /* --- 5. kernel polinomico a mano --- */
    21 => ['11'],
    22 => ['121'],

    /* --- 6. RBF y gamma --- */
    23 => ['1', 'uno'],
    24 => ['0', 'cero'],
    25 => ['lineal', 'recta', 'casi lineal'],
    26 => ['irregular', 'muy irregular', 'curva', 'compleja', 'ondulada'],
    27 => ['infinita', 'infinitas'],
    28 => ['disminuye', 'baja', 'decrece', 'se reduce', 'menor'],
];

$TEXTO = range(1, 28);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En el dataset del ejercicio 2 hay un punto atipico (un "+" solo, a la izquierda, junto a los "o"). &iquest;Que le pasa a un SVM lineal segun C?',
        'opciones' => [
            'a' => 'Con cualquier C la frontera es la misma',
            'b' => 'Con <b>C = 1</b> deja la frontera en el hueco natural y <b>clasifica mal el atipico</b>; con <b>C = 100</b> lo clasifica bien todo, pero la frontera se tuerce y ya no parece natural',
            'c' => 'Con C = 1 lo clasifica todo bien y con C = 100 se equivoca en muchos',
            'd' => 'Con C = 100 el modelo no se puede entrenar'
        ],
        'porque'   => 'C grande = "no te equivoques en ningun punto del entrenamiento", aunque haya que estrechar la calle para lograrlo. Eso es justo sobreajustarse a un punto ruidoso.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Si los atipicos se pueden quitar limpiando los datos, &iquest;para que sirve sobre todo el margen blando?',
        'opciones' => [
            'a' => 'Para acelerar el entrenamiento',
            'b' => 'Para los casos en que los datos <b>no son linealmente separables</b>: ahi el margen duro ni siquiera tiene solucion',
            'c' => 'Para que el modelo use mas vectores de soporte por gusto',
            'd' => 'Para poder usar regresion'
        ],
        'porque'   => 'Es la pregunta que se hace el articulo de Medium. Con datos que se mezclan un poco (lo normal en la vida real), exigir cero errores es imposible; el margen blando acepta unos pocos a cambio de una frontera razonable.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => '&iquest;Por que funciona el truco del kernel? &iquest;Que tiene la formulacion de SVM que lo permite?',
        'opciones' => [
            'a' => 'Que los datos siempre son de dos dimensiones',
            'b' => 'Que en la forma <b>dual</b> los datos nunca aparecen solos, <b>siempre dentro de un producto punto</b> x&#7522;&middot;x&#11388;: basta con cambiar ese producto por K(x&#7522;, x&#11388;)',
            'c' => 'Que el kernel elimina los outliers',
            'd' => 'Que la funcion de costo es convexa'
        ],
        'porque'   => 'El notebook lo marca como "el punto mas importante". Si la decision dependiera de cada coordenada por separado, habria que construir &phi;(x) de verdad y el truco no serviria.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'Datos en forma de <b>dos circulos concentricos</b> (una clase dentro, la otra en un anillo alrededor). &iquest;Que kernel NO sirve?',
        'opciones' => [
            'a' => 'RBF',
            'b' => 'Polinomico de grado 2',
            'c' => '<b>Lineal</b>: ninguna recta separa un circulo de otro que lo rodea (en el notebook se queda en ~59% de exactitud)',
            'd' => 'Todos funcionan igual'
        ],
        'porque'   => 'Da igual cuanto ajustes C: el problema no es lineal. El polinomico de grado 2 lo resuelve porque crea terminos como x&#8321;&sup2; y x&#8322;&sup2;, que es justo lo que mide "lo lejos que estas del centro".',
        'correcta' => 'c'
    ],
    'm5' => [
        'texto'    => 'En <code>make_moons</code> se prueba RBF con gamma = 0.1, 1, 10 y 50. &iquest;Que pasa con gamma = 50?',
        'opciones' => [
            'a' => 'La frontera es casi una recta',
            'b' => 'La frontera se vuelve <b>muy irregular</b> y rodea cada punto: el modelo memoriza el ruido (sobreajuste)',
            'c' => 'El modelo no cambia respecto a gamma = 1',
            'd' => 'Todas las predicciones son de la misma clase'
        ],
        'porque'   => 'Gamma grande = cada punto solo influye en su vecindad inmediata. Igual que C, gamma no se fija a ojo: se busca con validacion.',
        'correcta' => 'b'
    ],
    'm6' => [
        'texto'    => 'En el ejercicio 4 se prueban 8 valores de C y 8 de gamma (0.01, 0.03, 0.1, &hellip;, 30). &iquest;Como se elige la mejor pareja?',
        'opciones' => [
            'a' => 'Se toma el C mas alto y el gamma mas alto',
            'b' => 'Se entrenan las <b>8 &times; 8 = 64</b> combinaciones con el conjunto de entrenamiento y se queda la que mejor acierta en el conjunto de <b>validacion</b>',
            'c' => 'Se elige la que mejor acierta en el propio conjunto de entrenamiento',
            'd' => 'Se prueban solo 8 modelos, uno por cada C'
        ],
        'porque'   => 'Hay que probar <b>todas</b> las parejas porque C y gamma interactuan. Y se mide fuera del entrenamiento: dentro, el ganador seria siempre el que mas sobreajusta. Los valores van en pasos multiplicativos (&times;3 aprox.).',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('SVM 2 — Margen blando y kernels',
         'SVM.pdf · notebooks 0, 1 y 2 de SVM · articulo de Medium');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Que pasa cuando los datos <b>no</b> se dejan separar limpiamente: el margen blando y su
     parametro C, y despues el truco del kernel con los kernels que se usan en clase
     (lineal, polinomico, RBF y sigmoide) y el parametro gamma.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayusculas ni tildes.</div>
</div>


<div class="card">
  <h2>1. Margen duro vs margen blando</h2>

  <p>Si se exige que <b>todos</b> los puntos queden del lado correcto y fuera de la calle,
     se habla de <?php hueco(1, 12); ?>. Tiene dos problemas: solo funciona si los datos son
     linealmente <?php hueco(2, 12); ?>, y es muy sensible a los
     <?php hueco(3, 10); ?> (un solo punto raro cambia toda la frontera).</p>

  <p>La alternativa es el <?php hueco(4, 12); ?>, que permite algunos errores en el
     entrenamiento. Para eso se agrega a cada punto una variable de
     <?php hueco(5, 10); ?> &xi;&#7522; que mide cuanto viola el margen.</p>

  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. El parametro C</h2>

  <p><b>C</b> decide cuanto se castiga cada error: es el equilibrio entre una calle ancha y
     pocos errores de entrenamiento.</p>

  <table class="datos">
    <tr><th>C</th><th>Margen</th><th>Errores</th><th>Riesgo</th></tr>
    <tr><td><b>Grande</b></td><td>mas <?php hueco(6, 9); ?></td>
        <td>casi no tolera ninguno</td><td><?php hueco(7, 12); ?></td></tr>
    <tr><td><b>Pequeno</b></td><td>mas <?php hueco(8, 9); ?></td>
        <td>tolera muchos</td><td><?php hueco(9, 12); ?></td></tr>
  </table>

  <p>En el notebook de ejercicios se dice que C juega un papel parecido a
     1/<?php hueco(10, 7); ?>, el parametro de regularizacion que se usaba en la regresion
     logistica.</p>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Datos no separables: el truco del kernel</h2>

  <p>Si una recta no sirve, la idea es proyectar los datos con una funcion &phi;(x) a un espacio
     de <?php hueco(11, 8); ?> dimension, donde si se puedan separar con un hiperplano.</p>

  <p>Ejemplo de los circulos: se agrega una tercera variable
     <code>z = x&#8321;&sup2; + x&#8322;&sup2;</code>, que es la distancia (al cuadrado) al
     <?php hueco(12, 8); ?>. En 3D los circulos quedan a distinta altura y un plano horizontal
     los separa.</p>

  <p>El problema: calcular &phi;(x) a mano puede ser carisimo; el espacio transformado puede
     tener miles o incluso <?php hueco(13, 10); ?> dimensiones.</p>

  <pre><code>K(xᵢ, xⱼ) = φ(xᵢ) · φ(xⱼ)</code></pre>

  <p>El <b>kernel</b> da directamente el <?php hueco(14, 14); ?> de los dos puntos en el espacio
     transformado, sin construir &phi;. Dicho de otra forma (articulo de Medium): en vez de
     crear columnas nuevas, mide la <?php hueco(15, 10); ?> entre pares de puntos.</p>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Los kernels: cual sirve para que</h2>

  <table class="datos">
    <tr><th>Kernel</th><th>Formula</th><th>Cuando usarlo</th></tr>
    <tr><td><b>Lineal</b></td><td><code>x&#7522; &middot; x&#11388;</code></td>
        <td>datos <?php hueco(16, 12); ?> (o casi) por una recta o plano; rapido y con pocos hiperparametros</td></tr>
    <tr><td><b>Polinomico</b></td><td><code>(x&#7522; &middot; x&#11388; + c)<sup>d</sup></code></td>
        <td>fronteras curvas "moderadas"; hay que elegir de antemano el <?php hueco(17, 6); ?></td></tr>
    <tr><td><b>RBF / Gaussiano</b></td><td><code>exp(&minus;&gamma;&middot;&#8214;x&#7522; &minus; x&#11388;&#8214;&sup2;)</code></td>
        <td>fronteras muy flexibles sin conocer su forma; es la opcion por <?php hueco(18, 8); ?></td></tr>
    <tr><td><b>Sigmoide</b></td><td><code><?php hueco(19, 6); ?>(&kappa;&middot;x&#7522;&middot;x&#11388; + &theta;)</code></td>
        <td>menos comun; aparece en la lista de las diapositivas</td></tr>
  </table>

  <p>En sklearn se escogen con <code>kernel='linear'</code>, <code>'poly'</code>,
     <code>'rbf'</code> o <code>'sigmoid'</code>. Si no pones nada, <code>SVC()</code> usa el
     kernel <?php hueco(20, 8); ?>.</p>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Kernel polinomico a mano</h2>

  <p>Con <code>d = 2</code> y <code>c = 0</code>:
     <code>K(x&#7522;, x&#11388;) = (x&#7522; &middot; x&#11388;)&sup2;</code>.
     Toma <code>x&#7522; = [1, 2]</code> y <code>x&#11388; = [3, 4]</code>.</p>

  <ol>
    <li>Producto punto: 1&middot;3 + 2&middot;4 = <?php hueco(21, 5); ?></li>
    <li>Kernel: (11)&sup2; = <?php hueco(22, 5); ?></li>
  </ol>

  <div class="nota">Comprobacion del notebook: con la transformacion explicita
    <code>&phi;(x) = [x&#8321;&sup2;, &radic;2&middot;x&#8321;x&#8322;, x&#8322;&sup2;]</code> sale
    <code>&phi;(x&#7522;)&middot;&phi;(x&#11388;) = 9 + 48 + 64</code>: <b>el mismo numero</b>, pero
    habiendo construido vectores de 3 dimensiones. Ese es el ahorro del truco.</div>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. El kernel RBF y gamma</h2>

  <pre><code>K(xᵢ, xⱼ) = exp( −γ · ‖xᵢ − xⱼ‖² )          (en el ejercicio 1:  exp( −‖xᵢ − xⱼ‖² / 2σ² ) )</code></pre>

  <p>Es una medida de parecido: dos puntos casi iguales dan K &asymp; <?php hueco(23, 4); ?> y
     dos puntos muy lejanos dan K &asymp; <?php hueco(24, 4); ?>.</p>

  <table class="datos">
    <tr><th>gamma</th><th>Influencia de cada punto</th><th>Frontera</th></tr>
    <tr><td><b>Pequeno</b></td><td>llega lejos</td><td>suave, casi <?php hueco(25, 8); ?> (puede subajustar)</td></tr>
    <tr><td><b>Grande</b></td><td>solo los vecinos muy cercanos</td><td>muy <?php hueco(26, 10); ?> (puede sobreajustar)</td></tr>
  </table>

  <p>Por la serie de Taylor de la exponencial, el RBF es una suma infinita de kernels
     polinomicos de todos los grados; por eso equivale a un espacio de dimension
     <?php hueco(27, 9); ?>, y aun asi se calcula con una sola formula.</p>

  <p>En la version con &sigma;, gamma va como 1/(2&sigma;&sup2;): si &sigma; aumenta, gamma
     <?php hueco(28, 10); ?>.</p>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Basico/index.php', '../Sklearn/index.php');
