<?php
/* ==========================================================================
   APO / Arboles / Validacion  —  Validacion cruzada: K-Fold, estratificado,
                                  LOO, Shuffle & Split, pipelines y CV para C/alpha
   Fuentes: cross_val.pptx · 1-Methodologies to validate a classifier.ipynb
            (M. Sarria) · 02_DSML book - Ch8 (Trees).ipynb · 00_intro_arboles.ipynb
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. por que */
    1  => ['metodologico', 'error metodologico'],
    2  => ['sobreajuste', 'overfitting'],
    3  => ['validacion', 'conjunto de validacion', 'validation'],
    4  => ['prueba', 'test', 'conjunto de prueba'],
    5  => ['remuestreo', 'resampling'],

    /* 2. para que sirve */
    6  => ['generalizara', 'generaliza', 'generalizacion'],
    7  => ['algoritmos', 'modelos'],
    8  => ['hiperparametros', 'hiperparametro'],

    /* 3. K-Fold */
    9  => ['K', 'k'],
    10 => ['K-1', 'k-1', 'k - 1'],
    11 => ['promedio', 'media'],
    12 => ['ordenados', 'ordenado', 'ordenadas', 'por clase'],
    13 => ['shuffle', 'mezclar', 'mezclarlos', 'barajar'],
    14 => ['97.3', '97,3', '97.33', '97,33', '97'],

    /* 4. estratificado */
    15 => ['desbalanceadas', 'desbalanceados', 'desbalance', 'desbalanceada'],
    16 => ['proporcion', 'porcentaje'],

    /* 5. LOO */
    17 => ['n', 'numero de muestras'],
    18 => ['n-1', 'n - 1'],
    19 => ['desviacion estandar', 'desviacion', 'std'],

    /* 6. shuffle split */
    20 => ['disjuntos', 'disjuntas', 'separados'],
    21 => ['monte carlo', 'montecarlo'],

    /* 7. hiperparametros */
    22 => ['antes', 'antes del entrenamiento'],
    23 => ['1/λ', '1/lambda', '1 / lambda', '1/λ'],
    24 => ['cero', '0'],
    25 => ['pequenos', 'pequeno', 'cerca de cero', 'casi cero'],

    /* 8. codigo */
    26 => ['KFold(n_splits=10, shuffle=True, random_state=42)',
           'KFold(n_splits=10, random_state=42, shuffle=True)',
           'KFold(shuffle=True, n_splits=10, random_state=42)'],
    27 => ['StratifiedKFold(n_splits=10)'],
    28 => ['ShuffleSplit(n_splits=10, test_size=0.3, random_state=0)',
           'ShuffleSplit(n_splits=10, random_state=0, test_size=0.3)',
           'ShuffleSplit(test_size=0.3, n_splits=10, random_state=0)'],
    29 => ["cross_val_score(pipeline, X, y, cv=cv, scoring='accuracy')",
           'cross_val_score(pipeline, X, y, cv=cv)',
           "cross_val_score(pipeline, X, y, scoring='accuracy', cv=cv)"],
    30 => ["Pipeline([('scaler', StandardScaler()), ('clf', LogisticRegression())])",
           "Pipeline(steps=[('scaler', StandardScaler()), ('clf', LogisticRegression())])"],
];
$TEXTO = range(1, 25);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Se separa train/test y se ajustan los hiperparametros una y otra vez mirando el resultado en <b>test</b> hasta que sale muy bien. &iquest;Cual es el problema?',
        'opciones' => [
            'a' => 'Ninguno, para eso esta el test',
            'b' => 'Que el conocimiento del conjunto de prueba se "<b>filtra</b>" en el modelo: el test deja de medir la generalizacion (se sobreentrena en el test)',
            'c' => 'Que el modelo se vuelve lineal',
            'd' => 'Que se pierden las etiquetas'
        ],
        'porque'   => 'Por eso se aparta un conjunto de <b>validacion</b> para ajustar y el test se usa una sola vez al final. Pero partir en tres reduce los datos de entrenamiento y hace depender el resultado de una particion al azar: de ahi nace la validacion cruzada.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Con <code>KFold(n_splits=10)</code> <b>sin</b> shuffle sobre Iris, el fold 0 tiene en prueba solo etiquetas 0, el fold 4 solo 1, etc. &iquest;Por que pasa eso?',
        'opciones' => [
            'a' => 'Porque KFold elimina clases',
            'b' => 'Porque el dataset viene <b>ordenado por clase</b> y KFold, sin mezclar, toma bloques consecutivos: se entrena sin ver una clase y se prueba solo con ella',
            'c' => 'Porque 10 folds son demasiados',
            'd' => 'Porque Iris esta desbalanceado'
        ],
        'porque'   => 'La solucion del notebook es <code>shuffle=True</code> (con <code>random_state</code> para que sea reproducible). Otra opcion es estratificar.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Diabetes de OpenML: 500 negativos y 268 positivos. &iquest;Que iterador de validacion cruzada conviene?',
        'opciones' => [
            'a' => 'KFold sin shuffle',
            'b' => '<code>StratifiedKFold</code> (o <code>StratifiedShuffleSplit</code>): cada fold mantiene aproximadamente la misma proporcion 500/268 que el dataset completo',
            'c' => 'LeaveOneOut porque es el mas rapido',
            'd' => 'Ninguno, con clases desbalanceadas no se puede validar'
        ],
        'porque'   => 'Con un fold al azar podria tocar muy pocos positivos y la metrica de ese fold no seria comparable con las otras.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => '&iquest;Que diferencia a Shuffle &amp; Split de K-Fold?',
        'opciones' => [
            'a' => 'Ninguna, son lo mismo',
            'b' => 'Shuffle &amp; Split crea <b>divisiones independientes al azar</b> en cada iteracion (un mismo ejemplo puede caer varias veces en prueba o nunca); K-Fold reparte los datos en pliegues disjuntos y cada ejemplo se prueba exactamente una vez',
            'c' => 'K-Fold no usa datos de prueba',
            'd' => 'Shuffle &amp; Split solo sirve para regresion'
        ],
        'porque'   => 'En Shuffle &amp; Split fijas el numero de divisiones (<code>n_splits</code>) y el tamano de prueba (<code>test_size</code>) por separado.',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => '&iquest;Para que sirve meter el <code>StandardScaler</code> dentro de un <code>Pipeline</code> antes de hacer validacion cruzada?',
        'opciones' => [
            'a' => 'Para que el codigo sea mas corto, nada mas',
            'b' => 'Para que en cada fold el escalador (y los imputadores) se <b>ajusten solo con los datos de entrenamiento de ese fold</b> y luego se apliquen al de prueba: asi no hay fuga de informacion',
            'c' => 'Para que el modelo no necesite etiquetas',
            'd' => 'Porque <code>cross_val_score</code> no acepta modelos sueltos'
        ],
        'porque'   => 'Si se escala todo el dataset antes de partir, la media y la desviacion ya "vieron" los datos de prueba. El pipeline repite <code>fit</code> + <code>transform</code> correctamente en cada fold.',
        'correcta' => 'b'
    ],
    'm6' => [
        'texto'    => 'Con <code>LassoCV</code> y <code>RidgeCV</code> sobre un dataset donde solo X1 explica y (X2 y X3 son ruido), &iquest;que se observa en los coeficientes?',
        'opciones' => [
            'a' => 'Los dos modelos ponen X1 en cero',
            'b' => '<b>Lasso</b> deja X2 y X3 exactamente en <b>0</b> (selecciona variables); <b>Ridge</b> los deja pequenos pero rara vez en cero. Los dos escogen su mejor alpha con validacion cruzada',
            'c' => 'Ridge pone X2 y X3 en cero y Lasso no',
            'd' => 'Los dos dan exactamente los mismos coeficientes'
        ],
        'porque'   => 'En el notebook: Lasso &rarr; X1 = 2,76, X2 = X3 = 0; Ridge &rarr; X1 = 2,80, X2 = &minus;0,048, X3 = 0,009.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Validación cruzada',
         'cross_val.pptx · 1-Methodologies to validate a classifier.ipynb (Prof. Milton Sarria)');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Como medir bien un modelo: por que no basta con un train/test, los tipos de validacion cruzada
     (K-Fold, estratificado, LOO, Shuffle &amp; Split), y como se usa para escoger hiperparametros.</p>
  <div class="nota">Secciones 1 a 7: <b>texto</b>. Seccion 8: <b>codigo</b>.</div>
</div>


<div class="card">
  <h2>1. Por que hace falta</h2>
  <p>Entrenar y evaluar con los mismos datos es un error <?php hueco(1, 14); ?>: un modelo que
     solo repite lo que vio lo haria perfecto, y eso es <?php hueco(2, 12); ?>.</p>
  <p>Si ademas se ajustan los hiperparametros mirando el test, hay que apartar otro conjunto de
     <?php hueco(3, 11); ?> y dejar el de <?php hueco(4, 7); ?> solo para la evaluacion final.</p>
  <p>La validacion cruzada es una tecnica de <?php hueco(5, 11); ?>: entrena y evalua varias
     veces sobre distintos subconjuntos para tener una estimacion mas robusta.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Para que sirve</h2>
  <table class="datos">
    <tr><th>Uso</th><th>En pocas palabras</th></tr>
    <tr><td>Estimar el rendimiento</td><td>que tan bien se <?php hueco(6, 12); ?> el modelo a datos nuevos</td></tr>
    <tr><td>Seleccionar modelos</td><td>comparar de forma justa distintos <?php hueco(7, 10); ?></td></tr>
    <tr><td>Ajustar</td><td>encontrar la mejor combinacion de <?php hueco(8, 15); ?></td></tr>
  </table>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. K-Fold</h2>
  <ol>
    <li><b>Dividir</b> los datos en <?php hueco(9, 3); ?> subconjuntos (folds).</li>
    <li><b>Iterar</b>: en cada vuelta se entrena con <?php hueco(10, 5); ?> folds y se prueba con el que queda fuera.</li>
    <li><b>Promediar</b>: el resultado final es el <?php hueco(11, 9); ?> de las K metricas.</li>
  </ol>
  <p>En Iris, KFold sin mezclar da folds con una sola clase porque los datos vienen
     <?php hueco(12, 10); ?>; se arregla con <code><?php hueco(13, 8); ?>=True</code>.</p>
  <p>Con 10 folds mezclados, la regresion logistica en Iris da un promedio de
     &asymp; <?php hueco(14, 5); ?>% (desviacion 4,42).</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. K-Fold estratificado</h2>
  <p>Se usa en clasificacion con clases <?php hueco(15, 14); ?>: cada pliegue mantiene
     aproximadamente la misma <?php hueco(16, 11); ?> de cada clase que el dataset completo.</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Leave-One-Out (LOOCV)</h2>
  <p>Es el caso extremo de K-Fold con K = <?php hueco(17, 4); ?> (el numero de muestras):
     cada vez se entrena con <?php hueco(18, 5); ?> muestras y se prueba con la que sobra.</p>
  <p>En Iris da 96,67%, pero no se puede calcular la <?php hueco(19, 18); ?> entre iteraciones,
     porque cada prueba tiene una sola muestra (acierta o falla).</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Shuffle &amp; Split</h2>
  <p>No divide los datos en pliegues <?php hueco(20, 10); ?>: en cada iteracion mezcla y parte
     de nuevo, de forma independiente. Tambien se le llama Repeated Random Sub-sampling o
     validacion cruzada <?php hueco(21, 11); ?>.</p>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Escoger hiperparametros con CV</h2>
  <p>Un hiperparametro no se aprende durante el entrenamiento: se fija
     <?php hueco(22, 8); ?> (por ejemplo la tasa de aprendizaje o la profundidad de un arbol).</p>
  <p>En <code>LogisticRegression</code> con penalizacion L1, el equivalente al <code>alpha</code>
     de Lasso es <code>C</code>, con <code>C = <?php hueco(23, 7); ?></code>.
     <code>LogisticRegressionCV</code> prueba varios C con validacion cruzada (en diabetes escogio C &asymp; 2,15).</p>
  <p>Lasso tiende a llevar los coeficientes de las variables de ruido a
     <?php hueco(24, 5); ?>; Ridge los deja <?php hueco(25, 10); ?>.</p>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Las lineas de codigo</h2>
  <?php linea(26, 'un K-Fold de <b>10</b> pliegues que <b>mezcle</b> los datos, con semilla 42', 'kf = ...'); ?>
  <?php linea(27, 'un K-Fold <b>estratificado</b> de 10 pliegues', 'skf = ...'); ?>
  <?php linea(28, 'un Shuffle &amp; Split de <b>10</b> divisiones con <b>30%</b> de prueba y <code>random_state=0</code>', 'ss = ...'); ?>
  <?php linea(29, 'calcule el accuracy por fold de un <code>pipeline</code> con el iterador <code>cv</code>', 'scores = ...'); ?>
  <?php linea(30, 'un Pipeline con dos pasos: <code>\'scaler\'</code> (StandardScaler) y <code>\'clf\'</code> (LogisticRegression sin argumentos)', 'pipeline = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Poda/index.php', '');
