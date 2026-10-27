<?php
/* ==========================================================================
   APO / Arboles / Ensambles  —  Bagging, Random Forest, Boosting (AdaBoost),
                                 OOB y el codigo de sklearn
   Fuentes: 02_AprendSup-Ensambles.pptx · 04_Random_Forest.ipynb ·
            01_Arboles_Churn-STUD.ipynb (parte 3)
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. idea */
    1  => ['sabiduria de las multitudes', 'wisdom of crowds', 'sabiduria de la multitud', 'diversificacion'],
    2  => ['votacion', 'voto', 'votar', 'mayoria'],
    3  => ['promedio', 'media'],
    4  => ['sesgo', 'bias'],

    /* 2. robustos vs debiles */
    5  => ['robustos', 'robusto', 'fuertes', 'complejos'],
    6  => ['debiles', 'debil', 'weak'],

    /* 3. bagging */
    7  => ['bootstrap aggregating', 'bootstrap aggregation'],
    8  => ['reemplazo', 'repeticion', 'con reemplazo', 'reposicion'],
    9  => ['varianza'],
    10 => ['paralelo', 'en paralelo', 'paralela'],
    11 => ['pasting'],
    12 => ['random subspaces', 'subespacios aleatorios', 'random subspace'],
    13 => ['random patches', 'parches aleatorios'],

    /* 4. OOB */
    14 => ['63.2', '63,2', '63.2%', '63,2%', '63'],
    15 => ['36.8', '36,8', '36.8%', '36,8%', '37'],
    16 => ['out of bag', 'out-of-bag', 'fuera de la bolsa', 'oob'],

    /* 5. random forest */
    17 => ['caracteristicas', 'variables', 'atributos', 'features'],
    18 => ['raiz cuadrada', 'raiz', 'sqrt', '√m'],
    19 => ['m/3', 'un tercio', 'tercera parte'],
    20 => ['interpretar', 'interpretable'],

    /* 6. boosting */
    21 => ['secuencial', 'secuencialmente', 'en serie'],
    22 => ['aumenta', 'aumentan', 'sube', 'suben', 'se aumenta', 'crece'],
    23 => ['sesgo', 'bias'],
    24 => ['learning rate', 'tasa de aprendizaje', 'shrinking', 'shrinkage'],
    25 => ['decision stumps', 'decision stump', 'stumps', 'stump'],

    /* 7. codigo */
    26 => ["RandomForestClassifier(n_estimators=100, max_depth=5, random_state=42)",
           "RandomForestClassifier(n_estimators=100, random_state=42, max_depth=5)",
           "RandomForestClassifier(max_depth=5, n_estimators=100, random_state=42)",
           "RandomForestClassifier(max_depth=5, random_state=42, n_estimators=100)",
           "RandomForestClassifier(random_state=42, n_estimators=100, max_depth=5)",
           "RandomForestClassifier(random_state=42, max_depth=5, n_estimators=100)"],
    27 => ['rforest.oob_score_'],
    28 => ["AdaBoostClassifier(n_estimators=400, learning_rate=0.2)",
           "AdaBoostClassifier(learning_rate=0.2, n_estimators=400)",
           "AdaBoostClassifier(n_estimators=400, algorithm='SAMME', learning_rate=0.2)"],
];
$TEXTO = range(1, 25);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Al empezar la clase cada uno escribe, sin hablar con nadie, la fecha de la llegada a la luna o la edad de Madonna. &iquest;Que se quiere mostrar?',
        'opciones' => [
            'a' => 'Que nadie se sabe esas fechas',
            'b' => 'Que el <b>promedio de muchas respuestas independientes</b> suele quedar mas cerca de la verdad que la mayoria de respuestas individuales: la idea del ensamble',
            'c' => 'Que hay que buscar en internet',
            'd' => 'Que gana la persona que mas sabe'
        ],
        'porque'   => 'Cada modelo tiene su riesgo de equivocarse. &iquest;Por que quedarse con uno solo si se pueden construir varios y combinarlos?',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => '&iquest;Que pasa con el sobreajuste de un bagging o un Random Forest si se aumenta mucho el numero de arboles?',
        'opciones' => [
            'a' => 'Aumenta: mas arboles, mas sobreajuste',
            'b' => '<b>No se genera</b> sobreajuste por poner mas arboles (solo se vuelve mas lento); los arboles individuales si pueden sobreajustar, por eso se limita su profundidad',
            'c' => 'El modelo deja de funcionar a partir de 100 arboles',
            'd' => 'Se convierte en boosting'
        ],
        'porque'   => 'Esta en las consideraciones de las dos diapositivas. Ojo con boosting: ahi si se puede caer en sobreajuste si se agregan modelos sin control.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => '&iquest;Cuales son las <b>dos fuentes de aleatoriedad</b> de un Random Forest?',
        'opciones' => [
            'a' => 'El orden de las filas y el orden de las columnas',
            'b' => 'Las muestras <b>bootstrap</b> de los registros (bagging) y el <b>subconjunto aleatorio de variables</b> que se considera en cada particion',
            'c' => 'La semilla y el numero de arboles',
            'd' => 'La profundidad y el criterio de division'
        ],
        'porque'   => 'Es la nota de las diapositivas: "bagging and feature subspace split at each node". La segunda es la que lo distingue de un bagging de arboles normal.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'Ventaja practica del error <b>OOB</b> segun las diapositivas:',
        'opciones' => [
            'a' => 'Es siempre 0',
            'b' => 'Es un buen estimador del error que evita <b>dejar aparte un conjunto de prueba</b> y evita un costoso K-Fold; con muchos arboles tiende al error LOOCV',
            'c' => 'Sirve para escoger el kernel',
            'd' => 'Solo funciona con boosting'
        ],
        'porque'   => 'Cada arbol no vio el ~36,8% de los datos: esos ejemplos sirven "gratis" para evaluarlo. En sklearn se pide con <code>oob_score=True</code>.',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => 'En el notebook de churn se entrena AdaBoost con <code>learning_rate</code> 1,0, 0,2 y 0,05. &iquest;Que controla ese parametro?',
        'opciones' => [
            'a' => 'El numero de arboles',
            'b' => 'La profundidad de cada stump',
            'c' => 'Cuanto pesa cada nuevo modelo: un valor menor hace el aprendizaje <b>mas lento y progresivo</b>, para limitar el sobreajuste (normalmente necesita mas modelos)',
            'd' => 'El porcentaje de datos de prueba'
        ],
        'porque'   => 'Los tres tipos de parametros de boosting son: numero de arboles, tasa de aprendizaje (shrinking) y complejidad de los arboles.',
        'correcta' => 'c'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Árboles 4 — Ensambles',
         '02_AprendSup-Ensambles.pptx · 04_Random_Forest.ipynb · 01_Arboles_Churn-STUD.ipynb');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>En vez de un solo arbol, muchos: bagging, Random Forest y boosting, como reparten el trabajo,
     que error reducen y como se escriben en sklearn.</p>
  <div class="nota">Secciones 1 a 6: <b>texto</b>. Seccion 7: <b>codigo</b>.</div>
</div>


<div class="card">
  <h2>1. La idea del ensamble</h2>
  <p>Se basa en la diversificacion o <?php hueco(1, 22); ?>: se combinan varios
     clasificadores/regresores en un solo modelo. La decision final se toma por
     <?php hueco(2, 9); ?> (clasificacion) o por <?php hueco(3, 9); ?> (regresion).</p>
  <p>Lo que se busca es un mejor compromiso entre el error de <?php hueco(4, 6); ?> y el
     de varianza.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Modelos robustos y debiles</h2>
  <table class="datos">
    <tr><th>Tipo</th><th>Como son</th><th>Ejemplo</th></tr>
    <tr><td><?php hueco(5, 9); ?></td><td>complejos, mucho mejores que el baseline</td><td>arboles profundos</td></tr>
    <tr><td><?php hueco(6, 9); ?></td><td>simples, apenas mejores que el baseline</td><td>arboles poco profundos</td></tr>
  </table>
  <p>Regla para recordar: bagging junta modelos <b>robustos</b>; boosting junta modelos <b>debiles</b>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Bagging</h2>
  <p>Bagging significa <?php hueco(7, 20); ?>. Algoritmo:</p>
  <ol>
    <li>Se escogen varios subconjuntos de registros con <?php hueco(8, 10); ?> (remuestreo bootstrap).</li>
    <li>Se entrena el mismo modelo robusto en cada subconjunto (bajo sesgo, alta varianza).</li>
    <li>Se agregan las decisiones; eso reduce el error de <?php hueco(9, 9); ?>.
        Resultado: sesgo parecido, varianza menor.</li>
  </ol>
  <p>Los modelos son independientes entre si, asi que se pueden entrenar en
     <?php hueco(10, 9); ?>.</p>

  <table class="datos">
    <tr><th>Variante</th><th>Que se muestrea</th></tr>
    <tr><td><?php hueco(11, 9); ?></td><td>registros al azar <b>sin</b> reemplazo</td></tr>
    <tr><td>Bagging</td><td>registros al azar <b>con</b> reemplazo</td></tr>
    <tr><td><?php hueco(12, 15); ?></td><td>subconjuntos de las variables independientes</td></tr>
    <tr><td><?php hueco(13, 15); ?></td><td>subconjuntos de registros <b>y</b> de variables</td></tr>
  </table>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. El error OOB</h2>
  <p>Una muestra bootstrap contiene en promedio el <?php hueco(14, 5); ?>% de los datos
     originales (1 &minus; (1 &minus; 1/n)<sup>n</sup> &asymp; 1 &minus; 1/e). El
     <?php hueco(15, 5); ?>% restante no lo vio ese arbol.</p>
  <p>Evaluar cada modelo con esos datos no usados da el error <?php hueco(16, 12); ?>.</p>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Random Forest</h2>
  <ol>
    <li>Se crean muchos arboles, cada uno con una muestra bootstrap del dataset.</li>
    <li>En cada punto de particion solo se considera una muestra aleatoria de las
        <?php hueco(17, 14); ?> disponibles.</li>
    <li>Se dejan crecer los arboles y se agregan los resultados.</li>
  </ol>
  <p>Cuantas variables se consideran por defecto: la <?php hueco(18, 12); ?> de m en
     clasificacion (<code>max_features='sqrt'</code>) y <?php hueco(19, 6); ?> en regresion.</p>
  <p>Hereda lo bueno de los arboles (la importancia de las variables), mejora lo malo
     (la varianza), pero es muy dificil de <?php hueco(20, 10); ?> y ocupa mucha memoria.</p>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Boosting (AdaBoost)</h2>
  <p>Agrega predictores debiles aprendidos de forma <?php hueco(21, 11); ?>: cada modelo depende
     de los anteriores.</p>
  <ol>
    <li>Se crea un primer modelo debil sobre el dataset.</li>
    <li>Se le da un peso a su decision segun su error de entrenamiento.</li>
    <li>El peso de las instancias <b>mal predichas</b> se <?php hueco(22, 8); ?>; el de las bien predichas se reduce.</li>
    <li>Se crea un nuevo predictor influido por esos errores, y al final se suma la decision ponderada de todos.</li>
  </ol>
  <p>La idea es reducir el error de <?php hueco(23, 6); ?> (al reves que bagging). Puede caer
     en sobreajuste. Sus parametros: numero de arboles, <?php hueco(24, 14); ?> y complejidad
     de los arboles.</p>
  <p>En sklearn, <code>AdaBoostClassifier</code> usa por defecto
     <?php hueco(25, 14); ?> como modelo base.</p>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Las lineas de codigo</h2>
  <?php linea(26, 'un Random Forest con <b>100</b> arboles, profundidad maxima <b>5</b> y <code>random_state=42</code>', 'rf_clf = ...'); ?>
  <?php linea(27, 'lea la exactitud OOB de un bosque <code>rforest</code> entrenado con <code>oob_score=True</code>'); ?>
  <?php linea(28, 'un AdaBoost con <b>400</b> modelos y tasa de aprendizaje <b>0.2</b>', 'ada_02 = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Poda/index.php', '../Validacion/index.php');
