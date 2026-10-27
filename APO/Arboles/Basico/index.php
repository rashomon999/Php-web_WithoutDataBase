<?php
/* ==========================================================================
   APO / Arboles / Basico  —  Que es un arbol, terminologia, tipos,
                              clasificacion vs regresion, stump, pros/contras
   Fuentes: 00_Arboles de decision y CART.pptx (J. A. Ordonez) ·
            01_AprendSup-Arboles1.pptx · 00_intro_arboles.ipynb (M. Sarria) ·
            Interactive_Decision_Tree.ipynb · DecStump-Ejemplo.ipynb
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. que es */
    1  => ['supervisado'],
    2  => ['no parametrico', 'no parametrico'],
    3  => ['clasificacion'],
    4  => ['regresion'],
    5  => ['diagrama de flujo', 'flujo'],

    /* 2. terminologia */
    6  => ['nodo raiz', 'raiz', 'root node', 'root'],
    7  => ['nodo interno', 'nodos internos', 'interno', 'nodo de decision', 'nodos de decision', 'internal node'],
    8  => ['rama', 'ramas', 'branch', 'branches'],
    9  => ['hoja', 'hojas', 'nodo hoja', 'nodos hoja', 'nodo terminal', 'leaf'],
    10 => ['splitting', 'division', 'split'],
    11 => ['profundidad', 'depth', 'tree depth'],

    /* 3. clasificacion vs regresion */
    12 => ['discretos', 'discreto', 'categoricos', 'categorias'],
    13 => ['continuos', 'continuo'],
    14 => ['promedio', 'media'],

    /* 4. el espacio de variables */
    15 => ['mutuamente excluyentes', 'excluyentes'],
    16 => ['perpendiculares', 'perpendicular', 'paralelas a los ejes', 'ortogonales'],
    17 => ['si', 'if', 'if anidados', 'reglas si entonces', 'booleanas', 'reglas booleanas'],

    /* 5. tipos */
    18 => ['ID3'],
    19 => ['C4.5', 'c45', 'c 4.5'],
    20 => ['CART'],
    21 => ['CHAID'],
    22 => ['binarias', 'binaria', 'dos'],

    /* 6. decision stump */
    23 => ['1', 'uno', 'un nivel'],
    24 => ['debil', 'muy debil', 'weak', 'weak learner'],
    25 => ['boosting'],

    /* 7. ventajas / desventajas */
    26 => ['interpretar', 'entender', 'interpretables'],
    27 => ['distancia'],
    28 => ['sobreajuste', 'overfitting'],
    29 => ['inestable', 'inestables'],
];
$TEXTO = range(1, 29);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Caso de la aseguradora: hay 100.000 personas y solo se pueden enviar 10.000 ofertas. Al azar se logra un 3% de compras (300). &iquest;Que muestra el ejemplo cuando se va partiendo por sexo, luego por salario y luego por las dos?',
        'opciones' => [
            'a' => 'Que la tasa de exito no cambia, siempre es 3%',
            'b' => 'Que al elegir <b>sub-poblaciones</b> cada vez mas especificas la tasa sube (3% &rarr; 3,5% &rarr; 4,9% &rarr; 5,5%): eso es justo lo que un arbol aprende de forma automatica',
            'c' => 'Que es mejor enviar las ofertas a los hombres',
            'd' => 'Que hacen falta mas de 10.000 envios'
        ],
        'porque'   => 'Con 10.000 envios se pasa de 300 compras a 550. En la diapositiva los porcentajes estan dados; la idea del arbol es <b>aprenderlos</b> y elegir las particiones por si solo.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'En el taller de "adivinar la entidad con el menor numero de preguntas", &iquest;que se busca?',
        'opciones' => [
            'a' => 'Hacer la mayor cantidad posible de preguntas',
            'b' => 'Un arbol de preguntas lo <b>menos profundo</b> posible: primero las preguntas (atributos) que mas informacion dan',
            'c' => 'Preguntar siempre por el nombre directamente',
            'd' => 'Que todas las ramas tengan la misma longitud'
        ],
        'porque'   => 'Es la intuicion de la seleccion de atributos: una buena pregunta parte el conjunto en grupos mas "puros". Un arbol corto es un buen arbol.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => '&iquest;Por que se dice que la construccion del arbol es un algoritmo <b>greedy</b> (voraz)?',
        'opciones' => [
            'a' => 'Porque usa todos los datos de memoria',
            'b' => 'Porque en cada paso escoge la <b>mejor particion local</b>, sin garantizar que el arbol final sea el optimo global',
            'c' => 'Porque siempre llega a 100% de exactitud',
            'd' => 'Porque prueba todos los arboles posibles y elige el mejor'
        ],
        'porque'   => 'Decide nodo a nodo y nunca vuelve atras. Por eso es rapido y escalable, pero una decision temprana "buena" puede no ser la mejor para el arbol completo.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'Un <i>decision stump</i> sobre el dataset de cancer de mama (con <code>max_depth=1</code>) logra 0,877 de exactitud en prueba usando una sola regla: <code>mean concave points &lt;= 0.051</code>. &iquest;Que se concluye?',
        'opciones' => [
            'a' => 'Que siempre basta con una regla',
            'b' => 'Que a veces <b>pocos atributos dan mucha informacion</b>: un modelo debil puede quedar bastante por encima del azar; combinando muchos asi se construye boosting',
            'c' => 'Que el stump sobreajusta',
            'd' => 'Que la regresion logistica no sirve'
        ],
        'porque'   => 'En el notebook la regresion logistica llega a 0,918 en prueba; el stump, con una sola pregunta, no esta lejos. "Debil" significa poco mejor que el azar, no inutil.',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => '&iquest;Por que un arbol de decision <b>no necesita normalizar</b> las variables, a diferencia de KNN o SVM?',
        'opciones' => [
            'a' => 'Porque sklearn las normaliza automaticamente',
            'b' => 'Porque no se basa en <b>distancias</b>: cada corte compara una sola variable contra un umbral, y cambiar la escala solo mueve el umbral',
            'c' => 'Porque solo funciona con variables categoricas',
            'd' => 'Si la necesita, igual que KNN'
        ],
        'porque'   => 'Las diapositivas lo dicen asi: es indiferente a la escala y a la forma de la distribucion de los datos.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Árboles 1 — Lo básico',
         '00_Arboles de decision y CART.pptx · 01_AprendSup-Arboles1.pptx · 00_intro_arboles.ipynb');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>La idea general del arbol de decision antes de cualquier formula: que es, como se llaman
     sus partes, que tipos existen y para que sirve el <i>decision stump</i>.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayusculas, tildes ni el articulo.</div>
</div>


<div class="card">
  <h2>1. Que es un arbol de decision</h2>
  <p>Es un algoritmo de aprendizaje <?php hueco(1, 12); ?> y
     <?php hueco(2, 14); ?> (no supone ninguna forma fija para los datos), que sirve tanto
     para <?php hueco(3, 13); ?> como para <?php hueco(4, 11); ?>.</p>
  <p>Su estructura se parece a un <?php hueco(5, 16); ?>: cada nodo hace una pregunta sobre
     los datos y las ramas llevan a la respuesta.</p>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Terminologia</h2>
  <table class="datos">
    <tr><th>Nombre</th><th>Que es</th></tr>
    <tr><td><?php hueco(6, 12); ?></td><td>el nodo de arriba; representa el conjunto de datos completo</td></tr>
    <tr><td><?php hueco(7, 14); ?></td><td>hace una pregunta sobre una caracteristica y se sigue ramificando</td></tr>
    <tr><td><?php hueco(8, 8); ?></td><td>indica la regla (la respuesta a la pregunta) que conecta un nodo con el siguiente</td></tr>
    <tr><td><?php hueco(9, 10); ?></td><td>nodo final: ya no se divide y da la clase o el valor predicho</td></tr>
    <tr><td><?php hueco(10, 10); ?></td><td>el proceso de dividir un nodo en dos o mas subnodos</td></tr>
    <tr><td><?php hueco(11, 11); ?></td><td>numero maximo de niveles; mucha puede sobreajustar, muy poca infraajustar</td></tr>
  </table>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Clasificacion vs regresion</h2>
  <p>La distincion principal: la clasificacion se usa para valores <?php hueco(12, 10); ?>
     (sano / enfermo) y la regresion para valores <?php hueco(13, 10); ?> (precio de un auto).</p>
  <p>En un arbol de regresion, la prediccion de cada hoja es el <?php hueco(14, 9); ?> de los
     valores de entrenamiento que caen en esa region.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Como ve el arbol el espacio de variables</h2>
  <p>El arbol divide el espacio de las variables en J regiones
     <?php hueco(15, 22); ?> (cada punto cae en una sola region) y exhaustivas (entre todas cubren
     todo el espacio).</p>
  <p>Con variables numericas, los cortes solo pueden ser <?php hueco(16, 14); ?> a los ejes,
     porque cada pregunta mira una sola variable a la vez.</p>
  <p>Por eso el modelo se puede escribir como un conjunto de sentencias
     <code><?php hueco(17, 6); ?></code> anidadas:</p>
  <pre><code>if porosity > 0.15:
    if brittleness < 20: initial_production = 1000
    else:                initial_production = 7000
else:
    ...</code></pre>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Tipos de arboles</h2>
  <table class="datos">
    <tr><th>Algoritmo</th><th>Lo que hay que recordar</th></tr>
    <tr><td><?php hueco(18, 6); ?></td><td>Iterative Dichotomiser 3; usa entropia y ganancia de informacion</td></tr>
    <tr><td><?php hueco(19, 6); ?></td><td>version mejorada del anterior; acepta atributos continuos y discretos, datos faltantes y poda (en WEKA se llama J48)</td></tr>
    <tr><td><?php hueco(20, 6); ?></td><td>Classification And Regression Trees; Gini para clasificar y reduccion de varianza para regresion</td></tr>
    <tr><td><?php hueco(21, 6); ?></td><td>Chi-squared Automatic Interaction Detector; usa la prueba chi-cuadrado</td></tr>
  </table>
  <p>CART solo hace particiones <?php hueco(22, 9); ?>: cada nodo se parte en dos.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Decision stump</h2>
  <p>Es un arbol de un solo nivel (<code>max_depth=<?php hueco(23, 3); ?></code>): una unica regla,
     por ejemplo "quien mide mas de 1,65 m es hombre".</p>
  <p>Es un clasificador muy <?php hueco(24, 7); ?> (apenas mejor que el azar), y se usa mucho
     dentro de los ensambles, sobre todo en <?php hueco(25, 9); ?>.</p>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Ventajas y desventajas</h2>
  <table class="datos">
    <tr><th>Ventajas</th><th>Desventajas</th></tr>
    <tr><td>faciles de entender e <?php hueco(26, 10); ?>; se parecen al razonamiento humano</td>
        <td>tendencia al <?php hueco(28, 12); ?></td></tr>
    <tr><td>no se basan en ninguna nocion de <?php hueco(27, 9); ?>, asi que no les importa la normalizacion</td>
        <td>son <?php hueco(29, 9); ?>: un pequeno cambio en los datos puede dar un arbol muy distinto</td></tr>
    <tr><td>sirven con variables numericas y categoricas, y para clasificacion y regresion</td>
        <td>sesgados hacia los atributos con mas valores; sensibles al desbalance de clases</td></tr>
  </table>
  <?php mc('m5'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../Criterios/index.php');
