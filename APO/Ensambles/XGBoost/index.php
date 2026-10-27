<?php
/* ==========================================================================
   APO / Ensambles / XGBoost  —  Que es, funcion objetivo regularizada,
        diferencias con GB clasico, hiperparametros, DMatrix, early stopping,
        importancia, escalabilidad/GPU y alternativas
   Fuentes: Actividad_Gradient_Boosting.ipynb (sec. 5 y 7) ·
            IBM "¿Que es XGBoost?" · NVIDIA Glossary "XGBoost"
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. que es */
    1  => ['extreme gradient boosting', 'extreme gradient boost'],
    2  => ['tianqi chen', 'chen'],
    3  => ['2016'],
    4  => ['kaggle'],

    /* 2. funcion objetivo */
    5  => ['regularizacion', 'termino de regularizacion', 'penalizacion'],
    6  => ['hojas', 'numero de hojas'],
    7  => ['pesos', 'pesos de las hojas', 'valores de las hojas'],
    8  => ['ridge', 'l2'],
    9  => ['hessiano', 'segunda derivada', 'hessian'],
    10 => ['newton'],

    /* 3. vs GB clasico */
    11 => ['imputacion', 'imputar', 'imputacion manual'],
    12 => ['direccion', 'rama', 'direccion predeterminada', 'lado'],
    13 => ['early_stopping_rounds'],

    /* 4. hiperparametros */
    14 => ['6'],
    15 => ['0'],
    16 => ['0.3', '0,3'],
    17 => ['disminuir', 'bajar', 'reducir', 'menor'],
    18 => ['binary:logistic', 'binary logistic'],
    19 => ['multi:softmax', 'multi softmax'],

    /* 5. dmatrix y escalabilidad */
    20 => ['dmatrix'],
    21 => ['out-of-core', 'out of core', 'memoria externa'],
    22 => ['gpu', 'gpus'],
    23 => ['rapids'],

    /* 6. importancia y alternativas */
    24 => ['weight'],
    25 => ['gain'],
    26 => ['lightgbm'],
    27 => ['catboost'],

    /* 7. codigo */
    28 => ['xgb.XGBClassifier(n_estimators=100, learning_rate=0.1, max_depth=3, reg_lambda=1.0)',
           'XGBClassifier(n_estimators=100, learning_rate=0.1, max_depth=3, reg_lambda=1.0)',
           'xgb.XGBClassifier(n_estimators=100, learning_rate=0.1, max_depth=3, reg_lambda=1)'],
    29 => ['xgb.DMatrix(X_train, label=y_train)'],
    30 => ["xgb.train(params, dtrain, num_boost_round=100, evals=[(dtest, 'test')], early_stopping_rounds=10)"],
    31 => ["xgb.plot_importance(xgb_model, importance_type='gain')"],
];
$TEXTO = range(1, 27);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En <code>&Omega;(f) = &gamma;T + &frac12;&lambda;&Sigma;w<sub>j</sub>&sup2;</code>, si se <b>sube &gamma;</b>, &iquest;que tipo de arbol se ve mas castigado?',
        'opciones' => [
            'a' => 'Los arboles con pocas hojas grandes',
            'b' => 'Los arboles con <b>muchas hojas</b>: cada hoja nueva "cuesta" &gamma;, asi que solo se divide si la mejora de la perdida lo paga. Resultado: arboles mas simples, menos sobreajuste',
            'c' => 'Ninguno, &gamma; solo afecta la velocidad',
            'd' => 'Los arboles con pesos negativos'
        ],
        'porque'   => 'En la API de XGBoost &gamma; es la "reduccion minima de perdida para hacer otra division". &lambda; (<code>reg_lambda</code>) encoge los valores de las hojas como Ridge; <code>reg_alpha</code> hace lo mismo tipo L1.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'NVIDIA dice que XGBoost construye arboles "en paralelo". &iquest;Contradice eso que el boosting es secuencial?',
        'opciones' => [
            'a' => 'Si: XGBoost entrena todos los arboles a la vez como Random Forest',
            'b' => 'No: los arboles siguen siendo <b>secuenciales</b> (cada uno corrige al anterior); lo que se paraleliza es la <b>construccion de cada arbol</b> (evaluar los posibles cortes de un nivel sobre todos los datos a la vez, por ejemplo en GPU)',
            'c' => 'Si: XGBoost no es boosting sino bagging',
            'd' => 'No importa, es un error de la pagina'
        ],
        'porque'   => 'NVIDIA describe una estrategia "level-wise": recorre los gradientes y con sumas parciales evalua la calidad de cada corte posible. En GPU usa sumas de prefijos en paralelo y ordenamiento radix.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Con <code>num_boost_round=100</code> y <code>early_stopping_rounds=10</code>, el mejor <code>test-error</code> aparece en la ronda 23. &iquest;Que pasa?',
        'opciones' => [
            'a' => 'Entrena las 100 rondas igual',
            'b' => 'Sigue hasta la ronda <b>33</b> y, como en 10 rondas seguidas no mejoro, <b>se detiene</b>; <code>best_iteration</code> queda en 23',
            'c' => 'Se detiene en la ronda 10',
            'd' => 'Se detiene en la ronda 23 sin mirar mas'
        ],
        'porque'   => 'Es control de sobreajuste por <b>tiempo</b> (cuantos arboles), distinto de limitar la forma de cada arbol con <code>max_depth</code> o <code>reg_lambda</code>. Ademas ahorra computo.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'En breast_cancer (569 muestras) XGBoost y GradientBoostingClassifier dan exactitudes parecidas. &iquest;Donde se espera que XGBoost marque la diferencia?',
        'opciones' => [
            'a' => 'En datasets pequenos, siempre con mucha mas exactitud',
            'b' => 'En datasets <b>grandes</b>, sobre todo en <b>velocidad</b> (paralelizacion, compresion en DMatrix, cache, GPU); por eso el ejercicio compara tiempos con MNIST',
            'c' => 'En que no necesita datos de entrenamiento',
            'd' => 'En que es facil de interpretar'
        ],
        'porque'   => 'IBM habla de mas de 10 veces mas rapido que otros marcos en una sola maquina gracias a la precarga en cache. La guia pide anotar la prediccion antes de medir con <code>time</code>.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Ensambles 6 — XGBoost',
         'Actividad_Gradient_Boosting.ipynb · IBM ¿Que es XGBoost? · NVIDIA Glossary');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>La version "extrema" del gradient boosting: que la hace distinta, su funcion objetivo con
     regularizacion, los hiperparametros que hay que conocer, DMatrix y early stopping, por que escala
     tan bien y que alternativas existen.</p>
  <div class="nota">Secciones 1 a 6: <b>texto</b>. Seccion 7: <b>codigo</b>.</div>
</div>


<div class="card">
  <h2>1. Que es</h2>
  <p>XGBoost significa <?php hueco(1, 20); ?>: una biblioteca de codigo abierto y distribuida de
     arboles de decision potenciados por gradiente (GBDT), para regresion, clasificacion y ranking.</p>
  <p>La desarrollo <?php hueco(2, 12); ?> en la Universidad de Washington; el articulo con Carlos
     Guestrin (KDD) es de <?php hueco(3, 5); ?>.</p>
  <p>Se hizo famosa por ayudar a ganar muchas competencias de datos tabulares en
     <?php hueco(4, 8); ?>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. La funcion objetivo regularizada</h2>
  <pre><code>𝓛 = Σ L(yᵢ, ŷᵢ) + Σ Ω(fₘ)            Ω(f) = γ·T + ½·λ·Σ wⱼ²</code></pre>
  <p>A diferencia del gradient boosting clasico, el objetivo incluye un termino de
     <?php hueco(5, 14); ?> que castiga la complejidad de cada arbol.</p>
  <table class="datos">
    <tr><th>Parametro</th><th>Que penaliza</th></tr>
    <tr><td>&gamma;</td><td>tener muchas <?php hueco(6, 7); ?> (T): un costo fijo por cada hoja nueva</td></tr>
    <tr><td>&lambda;</td><td>que los <?php hueco(7, 7); ?> w<sub>j</sub> sean grandes; es la misma idea que la regresion <?php hueco(8, 6); ?></td></tr>
  </table>
  <p>Ademas usa el gradiente <b>y</b> el <?php hueco(9, 10); ?> de la perdida: un paso de
     <?php hueco(10, 8); ?> en vez de solo descenso de gradiente.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Frente al Gradient Boosting de sklearn</h2>
  <table class="datos">
    <tr><th></th><th>GradientBoosting (sklearn)</th><th>XGBoost</th></tr>
    <tr><td>Optimizacion</td><td>gradiente (1ª derivada)</td><td>gradiente + hessiano</td></tr>
    <tr><td>Regularizacion</td><td>no incluida en el objetivo</td><td>L1/L2 dentro de &Omega;(f)</td></tr>
    <tr><td>Valores faltantes</td><td>requiere <?php hueco(11, 10); ?></td><td>automatico</td></tr>
    <tr><td>Early stopping</td><td><code>n_iter_no_change</code></td><td><code><?php hueco(13, 20); ?></code></td></tr>
  </table>
  <p>Con los faltantes, XGBoost los manda por una <?php hueco(12, 10); ?> predeterminada en cada
     corte y aprende cual es la mejor.</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Hiperparametros</h2>
  <table class="datos">
    <tr><th>Parametro</th><th>Que hace</th><th>Por defecto</th></tr>
    <tr><td><code>max_depth</code></td><td>profundidad de cada arbol; mas profundo, mas riesgo de sobreajuste</td><td><?php hueco(14, 3); ?></td></tr>
    <tr><td><code>gamma</code></td><td>reduccion minima de perdida para hacer otra division</td><td><?php hueco(15, 3); ?></td></tr>
    <tr><td><code>learning_rate</code> (<code>eta</code>)</td><td>cuanto aprende en cada ronda; entre 0 y 1</td><td><?php hueco(16, 4); ?></td></tr>
    <tr><td><code>n_estimators</code></td><td>numero de arboles</td><td>&mdash;</td></tr>
  </table>
  <p>Si se aumenta <code>n_estimators</code>, conviene <?php hueco(17, 9); ?> la tasa de aprendizaje.</p>
  <p>El hiperparametro <code>objective</code> define la tarea:
     <code><?php hueco(18, 15); ?></code> para clasificacion binaria y
     <code><?php hueco(19, 13); ?></code> para multiclase.</p>
  <div class="nota">El articulo de IBM dice que <code>eta</code> vale 0,36 por defecto; la documentacion
    oficial de XGBoost dice <b>0,3</b>. Aqui se usa 0,3.</div>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. DMatrix y escalabilidad</h2>
  <p><code><?php hueco(20, 8); ?></code> es la estructura de datos interna de XGBoost: comprime,
     optimiza el entrenamiento en paralelo y maneja los faltantes.</p>
  <p>Guarda los datos en bloques que se pueden repartir entre maquinas (Spark, Dask, Kubernetes) o
     dejar en disco: computo <?php hueco(21, 12); ?>.</p>
  <p>NVIDIA anade aceleracion en <?php hueco(22, 4); ?> (miles de nucleos en paralelo), desarrollada
     con el equipo de <?php hueco(23, 7); ?>, su plataforma de analitica sobre CUDA.</p>
  <?php mc('m2'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Importancia de variables y alternativas</h2>
  <p><code>xgb.plot_importance</code> usa por defecto <code>importance_type='<?php hueco(24, 7); ?>'</code>
     (cuantas veces se usa una variable para dividir). Otra opcion es <code>'<?php hueco(25, 5); ?>'</code>
     (cuanto mejora la perdida al usarla) o <code>'cover'</code>. El ranking puede cambiar segun el criterio,
     y tampoco coincide necesariamente con el MDI de Random Forest.</p>
  <table class="datos">
    <tr><th>Alternativa</th><th>Quien / cuando</th><th>Rasgo</th></tr>
    <tr><td><?php hueco(26, 9); ?></td><td>Microsoft, 2016</td><td>crece los arboles por hojas (leaf-wise) en vez de por niveles</td></tr>
    <tr><td><?php hueco(27, 9); ?></td><td>Yandex, 2017</td><td>maneja variables categoricas sin preprocesar</td></tr>
    <tr><td>AdaBoost</td><td>Freund y Schapire</td><td>sube el peso de los ejemplos mal clasificados</td></tr>
  </table>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Las lineas de codigo</h2>
  <p>Con <code>import xgboost as xgb</code>:</p>
  <?php linea(28, 'un XGBClassifier con <b>100</b> arboles, tasa <b>0.1</b>, profundidad <b>3</b> y <code>reg_lambda=1.0</code>, en ese orden', 'xgb_model = ...'); ?>
  <?php linea(29, 'convierta <code>X_train</code> / <code>y_train</code> a la estructura interna de XGBoost', 'dtrain = ...'); ?>
  <?php linea(30, "entrene con la API nativa: <code>params</code>, <code>dtrain</code>, <b>100</b> rondas, evaluando en <code>[(dtest, 'test')]</code> y deteniendose tras <b>10</b> rondas sin mejorar", 'model = ...'); ?>
  <?php linea(31, 'grafique la importancia de <code>xgb_model</code> usando el criterio de <b>ganancia</b>'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../GradientBoosting/index.php', '');
