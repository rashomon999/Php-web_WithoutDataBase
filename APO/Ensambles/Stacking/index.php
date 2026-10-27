<?php
/* ==========================================================================
   APO / Ensambles / Stacking  —  Stacking, voting y la comparacion
                                  Bagging vs Boosting vs Stacking
   Fuentes: Ensemble Learning (Bagging, Boostrap, Stacking).pdf ·
            IBM "What is ensemble learning?" · scikit-learn 1.11.4 – 1.11.6
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. que es */
    1  => ['metamodelo', 'meta-modelo', 'meta modelo', 'meta-clasificador', 'metaclasificador', 'meta learner', 'meta-learner', 'estimador final'],
    2  => ['validacion cruzada', 'cross validation', 'cross-validation', 'cv'],
    3  => ['regresion'],
    4  => ['stacked generalization', 'generalizacion apilada'],
    5  => ['meta-learning', 'meta learning', 'metaaprendizaje', 'meta-aprendizaje', 'meta aprendizaje'],

    /* 2. los 4 pasos */
    6  => ['folds', 'n folds', 'pliegues', 'n-folds'],
    7  => ['1', 'uno'],
    8  => ['meta-clasificador', 'metaclasificador', 'meta clasificador', 'meta-modelo', 'metamodelo'],
    9  => ['prueba', 'test', 'pruebas'],

    /* 3. pros y contras */
    10 => ['algoritmos', 'modelos'],
    11 => ['competiciones', 'competencias', 'competencia', 'kaggle'],
    12 => ['rapidas', 'rapida', 'tiempo real'],

    /* 4. comparacion */
    13 => ['paralelo', 'paralelo e independiente', 'independiente'],
    14 => ['secuencial'],
    15 => ['heterogeneos', 'heterogeneo', 'heterogeneous'],
    16 => ['profundos', 'profundo', 'deep'],
    17 => ['poco profundos', 'superficiales', 'shallow', 'poco profundo'],
    18 => ['igual', 'el mismo', 'mismo peso', 'equal'],
    19 => ['varianza'],
    20 => ['sesgo', 'bias'],
    21 => ['bajo', 'poca', 'low'],

    /* 5. voting */
    22 => ['hard'],
    23 => ['soft'],
    24 => ['predict_proba'],
    25 => ['weights'],

    /* 6. codigo */
    26 => ["StackingClassifier(estimators=estimators, final_estimator=LogisticRegression())",
           "StackingClassifier(final_estimator=LogisticRegression(), estimators=estimators)"],
    27 => ["VotingClassifier(estimators=estimators, voting='soft')",
           "VotingClassifier(voting='soft', estimators=estimators)"],
];
$TEXTO = range(1, 25);

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Por que el meta-modelo <b>no</b> se entrena con las predicciones que hacen los modelos base sobre los mismos datos con los que fueron entrenados?',
        'opciones' => [
            'a' => 'Porque esas predicciones no existen',
            'b' => 'Porque sobre sus propios datos de entrenamiento los modelos base aciertan "demasiado": el meta-modelo aprenderia a confiar en ellos mas de la cuenta y <b>sobreajustaria</b>. Por eso se usan predicciones <b>fuera de fold</b> (validacion cruzada)',
            'c' => 'Porque el meta-modelo tiene que ser un arbol',
            'd' => 'Porque asi se entrena mas rapido'
        ],
        'porque'   => 'IBM: el meta-learner debe entrenarse con datos distintos a los de los base learners. Scikit-learn lo hace por dentro con <code>cross_val_predict</code>.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Voting suave con tres clasificadores de peso 1: las probabilidades promedio de las clases 1, 2 y 3 quedan en 0,37, 0,40 y 0,23. &iquest;Que clase predice?',
        'opciones' => [
            'a' => 'La clase 1, porque la eligio la mayoria de los modelos',
            'b' => 'La <b>clase 2</b>, la de mayor probabilidad promedio',
            'c' => 'La clase 3',
            'd' => 'Ninguna, hay empate'
        ],
        'porque'   => 'Es el ejemplo de la documentacion de sklearn. En voting <b>duro</b> cada modelo da una etiqueta y gana la mas votada; en <b>suave</b> se promedian probabilidades.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Diferencia de fondo entre <b>stacking</b> y <b>voting</b>:',
        'opciones' => [
            'a' => 'Ninguna, son lo mismo',
            'b' => 'Voting combina las predicciones con una <b>regla fija</b> (mayoria o promedio, con pesos que uno pone); stacking <b>aprende</b> como combinarlas entrenando un modelo final',
            'c' => 'Voting solo sirve para regresion',
            'd' => 'Stacking no usa modelos base'
        ],
        'porque'   => 'Por eso en la clasificacion de tecnicas voting/averaging/weighted average estan en "simples" y stacking en "avanzadas".',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'Un modelo debe responder en tiempo real en produccion (milisegundos). Segun los pros y contras de la presentacion, &iquest;que metodo es el menos indicado?',
        'opciones' => [
            'a' => 'Un solo arbol',
            'b' => '<b>Stacking</b>: entrenar y predecir toma mas tiempo (hay que pasar por todos los modelos base y luego por el meta-modelo)',
            'c' => 'Una regresion logistica',
            'd' => 'Max voting con dos modelos'
        ],
        'porque'   => 'Es el contra textual de la diapositiva: "puede no ser una buena opcion para un modelo de produccion que necesite predicciones rapidas".',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Ensambles 4 — Stacking, voting y comparación',
         'Ensemble Learning (Bagging, Boostrap, Stacking).pdf · IBM · scikit-learn');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>El ensamble paralelo y heterogeneo: stacking paso a paso, el voting de sklearn y la tabla
     final que compara los tres metodos.</p>
  <div class="nota">Secciones 1 a 5: <b>texto</b>. Seccion 6: <b>codigo</b>.</div>
</div>


<div class="card">
  <h2>1. Que es stacking</h2>
  <p>Combina varios estimadores para reducir sus sesgos: sus predicciones se apilan y entran a un
     estimador final, el <?php hueco(1, 16); ?>, que calcula la prediccion final. Ese estimador final
     se entrena mediante <?php hueco(2, 18); ?>.</p>
  <p>Sirve tanto para clasificacion como para <?php hueco(3, 10); ?>.</p>
  <p>Su nombre completo es <?php hueco(4, 20); ?>, y IBM lo pone como ejemplo de
     <?php hueco(5, 14); ?>: entrenar un modelo con las salidas de otros modelos.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Los 4 pasos</h2>
  <ol>
    <li>El dataset se divide en entrenamiento y prueba, y el entrenamiento en n <?php hueco(6, 8); ?>
        (n-fold cross-validation).</li>
    <li>Con esos folds, cada clasificador de nivel <?php hueco(7, 3); ?> (C1, C2, C3) calcula sus predicciones.</li>
    <li>Esas predicciones de nivel 1 se usan para entrenar el <?php hueco(8, 16); ?>.</li>
    <li>El meta-clasificador se prueba con el conjunto de <?php hueco(9, 7); ?> para obtener la prediccion final.</li>
  </ol>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Pros y contras</h2>
  <table class="datos">
    <tr><th>Pros</th><th>Contras</th></tr>
    <tr><td>se pueden usar diversos <?php hueco(10, 10); ?> con distintos supuestos como modelos base, sumando sus ventajas</td>
        <td>tarda mas en entrenar y predecir: mala opcion si en produccion se necesitan predicciones <?php hueco(12, 8); ?></td></tr>
    <tr><td>suele dar mayor precision; muy usado en <?php hueco(11, 12); ?></td><td></td></tr>
  </table>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Bagging vs Boosting vs Stacking</h2>
  <table class="datos">
    <tr><th></th><th>Bagging</th><th>Boosting</th><th>Stacking</th></tr>
    <tr><td>Entrenamiento de los modelos base</td><td><?php hueco(13, 10); ?></td><td><?php hueco(14, 10); ?></td><td>independiente, puede ser en paralelo</td></tr>
    <tr><td>Tipo de modelos base</td><td>homogeneos</td><td>homogeneos</td><td><?php hueco(15, 12); ?></td></tr>
    <tr><td>Numero de modelos base</td><td>alto</td><td>alto</td><td>bajo</td></tr>
    <tr><td>Profundidad de los arboles</td><td><?php hueco(16, 9); ?></td><td><?php hueco(17, 12); ?></td><td>no aplica</td></tr>
    <tr><td>Peso de cada modelo</td><td><?php hueco(18, 7); ?> para todos</td><td>mas peso a los que mejor predicen</td><td>el meta-learner decide cuanto aporta cada uno</td></tr>
    <tr><td>Objetivo principal</td><td>reducir <?php hueco(19, 9); ?></td><td>reducir <?php hueco(20, 6); ?></td><td>cualquiera de los dos, segun los modelos base</td></tr>
    <tr><td>Uso de memoria y CPU</td><td>alto</td><td><?php hueco(21, 6); ?></td><td>depende de los modelos base</td></tr>
  </table>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Voting en scikit-learn</h2>
  <p><code>VotingClassifier</code> junta clasificadores distintos:</p>
  <table class="datos">
    <tr><th><code>voting=</code></th><th>Como decide</th></tr>
    <tr><td><code>'<?php hueco(22, 5); ?>'</code></td><td>cada modelo da una etiqueta y gana la mayoria</td></tr>
    <tr><td><code>'<?php hueco(23, 5); ?>'</code></td><td>promedia las probabilidades y gana la mas alta; todos los modelos deben tener <code><?php hueco(24, 13); ?></code></td></tr>
  </table>
  <p>Con el parametro <code><?php hueco(25, 7); ?></code> (por ejemplo <code>[2, 5, 1]</code>) unos
     modelos pesan mas que otros. Para regresion existe <code>VotingRegressor</code>, que promedia.</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Las lineas de codigo</h2>
  <p>Supon que ya existe <code>estimators = [('rf', RandomForestClassifier()), ('knn', KNeighborsClassifier())]</code>.</p>
  <?php linea(26, 'un stacking con esos modelos base y una <b>regresion logistica</b> (sin argumentos) como estimador final', 'stack = ...'); ?>
  <?php linea(27, 'un voting <b>suave</b> con esos mismos modelos', 'vote = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Boosting/index.php', '../GradientBoosting/index.php');
