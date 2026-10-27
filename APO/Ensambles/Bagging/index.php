<?php
/* ==========================================================================
   APO / Ensambles / Bagging  —  Bootstrap + aggregation, variantes, OOB,
                                 Random Forest, Extra-Trees y sklearn
   Fuentes: Ensemble Learning (Bagging, Boostrap, Stacking).pdf ·
            02_AprendSup-Ensambles.pptx · 04_Random_Forest.ipynb ·
            01_Arboles_Churn-STUD.ipynb · scikit-learn 1.11.2 / 1.11.3 · IBM
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. que es */
    1  => ['bootstrap aggregating', 'bootstrap aggregation'],
    2  => ['bootstrapping', 'bootstrap'],
    3  => ['sustitucion', 'reemplazo', 'reposicion', 'con sustitucion', 'con reemplazo'],
    4  => ['aggregation', 'agregacion'],
    5  => ['votacion', 'votacion maxima', 'voto', 'moda'],
    6  => ['promedio', 'media'],

    /* 2. que reduce */
    7  => ['robustos', 'robusto', 'fuertes', 'complejos'],
    8  => ['varianza'],
    9  => ['paralelo', 'en paralelo'],

    /* 3. variantes */
    10 => ['pasting'],
    11 => ['random subspaces', 'random subspace', 'subespacios aleatorios'],
    12 => ['random patches', 'parches aleatorios'],

    /* 4. OOB */
    13 => ['63.2', '63,2', '63.2%', '63,2%', '63'],
    14 => ['36.8', '36,8', '36.8%', '36,8%', '37'],
    15 => ['out of bag', 'out-of-bag', 'fuera de la bolsa', 'oob'],

    /* 5. pros y contras */
    16 => ['sobreajuste', 'overfitting'],
    17 => ['faltan', 'faltantes', 'datos faltantes', 'valores faltantes'],
    18 => ['memoria'],

    /* 6. random forest */
    19 => ['caracteristicas', 'variables', 'atributos', 'features'],
    20 => ['sqrt', 'raiz cuadrada', 'raiz'],
    21 => ['interpretar', 'interpretable'],
    22 => ['promedia', 'promedio', 'promediar'],

    /* 7. extra-trees */
    23 => ['umbrales', 'umbral', 'cortes', 'thresholds'],
    24 => ['false'],

    /* 8. codigo */
    25 => ['BaggingClassifier(KNeighborsClassifier(), max_samples=0.5, max_features=0.5)',
           'BaggingClassifier(KNeighborsClassifier(), max_features=0.5, max_samples=0.5)'],
    26 => ["RandomForestClassifier(n_estimators=100, max_depth=5, random_state=42)",
           "RandomForestClassifier(n_estimators=100, random_state=42, max_depth=5)",
           "RandomForestClassifier(max_depth=5, n_estimators=100, random_state=42)",
           "RandomForestClassifier(max_depth=5, random_state=42, n_estimators=100)",
           "RandomForestClassifier(random_state=42, n_estimators=100, max_depth=5)",
           "RandomForestClassifier(random_state=42, max_depth=5, n_estimators=100)"],
    27 => ['rforest.oob_score_'],
    28 => ['rf_clf.feature_importances_'],
];
$TEXTO = range(1, 24);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Del conjunto original A B C D E salen muestras bootstrap como <code>A A B C D</code>, <code>E B B C A</code>, <code>C A D D A</code>. &iquest;Que se ve en ellas?',
        'opciones' => [
            'a' => 'Que cada muestra contiene todos los registros exactamente una vez',
            'b' => 'Que, al muestrear <b>con reemplazo</b>, algunos registros se repiten y otros quedan fuera; cada muestra es un poco distinta y por eso cada modelo aprende algo distinto',
            'c' => 'Que las muestras son mas pequenas que el original',
            'd' => 'Que se eliminan los registros atipicos'
        ],
        'porque'   => 'Cada muestra tiene el mismo tamano que el original (n de n), pero con repeticiones. Esa diferencia entre muestras es la que da diversidad al ensamble.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Una ventaja del bagging que menciona la presentacion es que es resistente a los datos faltantes. &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque imputa automaticamente con la media',
            'b' => 'Porque cada arbol usa un <b>subconjunto</b> de registros y caracteristicas, asi que solo una parte de los modelos se ve afectada por los datos que faltan',
            'c' => 'Porque elimina las filas con faltantes',
            'd' => 'Porque los arboles no aceptan faltantes'
        ],
        'porque'   => 'El "contra" del bagging en la misma diapositiva: entrenar en paralelo consume mucha memoria y CPU.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Un BaggingClassifier de 100 arboles saca 85% y un Random Forest de 100 arboles saca 92% con los mismos datos. &iquest;Cual es la diferencia clave?',
        'opciones' => [
            'a' => 'El bagging no usa bootstrap',
            'b' => 'Random Forest, en cada division, solo mira un <b>subconjunto aleatorio de variables</b>; eso <b>descorrelaciona</b> los arboles (no eligen todos la misma variable dominante) y baja mas la varianza',
            'c' => 'Random Forest poda los arboles automaticamente',
            'd' => 'Random Forest usa arboles mas profundos'
        ],
        'porque'   => 'Si una variable es muy fuerte, en bagging casi todos los arboles la usan en el primer corte y terminan pareciendose. Promediar arboles parecidos reduce poco la varianza.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'La importancia de variables por impureza (<code>feature_importances_</code>, MDI) tiene dos defectos segun scikit-learn. &iquest;Cuales?',
        'opciones' => [
            'a' => 'Es negativa y no suma 1',
            'b' => 'Se calcula con los datos de <b>entrenamiento</b> (puede no reflejar el desempeno en datos nuevos) y <b>favorece a las variables con muchos valores distintos</b>; como alternativa recomiendan la importancia por permutacion',
            'c' => 'Solo funciona con un arbol',
            'd' => 'Requiere normalizar los datos'
        ],
        'porque'   => 'Es el mismo sesgo de los arboles hacia los atributos con mas valores, que viste en el cuestionario de criterios de division.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Ensambles 2 — Bagging y Random Forest',
         'Ensemble Learning.pdf · 02_AprendSup-Ensambles.pptx · 04_Random_Forest.ipynb · scikit-learn');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>El metodo paralelo y homogeneo: como se arman las muestras, que error reduce, sus variantes,
     el error OOB, Random Forest y Extra-Trees, y las lineas de sklearn.</p>
  <div class="nota">Secciones 1 a 7: <b>texto</b>. Seccion 8: <b>codigo</b>.</div>
</div>


<div class="card">
  <h2>1. Que es bagging</h2>
  <p>Es el acronimo de <?php hueco(1, 20); ?>, y por eso tiene dos partes:</p>
  <ol>
    <li><b><?php hueco(2, 12); ?></b>: volver a muestrear subconjuntos de datos con
        <?php hueco(3, 11); ?> a partir del conjunto inicial.</li>
    <li><b><?php hueco(4, 11); ?></b>: cada aprendiz se entrena de forma independiente y al final se
        juntan sus predicciones: por <?php hueco(5, 9); ?> en clasificacion ("la mayoria manda") y por
        <?php hueco(6, 8); ?> en regresion.</li>
  </ol>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Que modelos usa y que error reduce</h2>
  <p>Funciona mejor con modelos base <?php hueco(7, 9); ?> (complejos, como arboles profundos: bajo
     sesgo, alta varianza). Al agregarlos baja la <?php hueco(8, 9); ?>; el sesgo queda parecido.</p>
  <p>Como los modelos no dependen unos de otros, se entrenan en <?php hueco(9, 10); ?>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Variantes (segun que se muestrea)</h2>
  <table class="datos">
    <tr><th>Variante</th><th>Que se muestrea</th><th>Parametros en sklearn</th></tr>
    <tr><td><?php hueco(10, 9); ?></td><td>registros, <b>sin</b> reemplazo</td><td><code>max_samples</code>, <code>bootstrap=False</code></td></tr>
    <tr><td>Bagging</td><td>registros, <b>con</b> reemplazo</td><td><code>max_samples</code>, <code>bootstrap=True</code></td></tr>
    <tr><td><?php hueco(11, 15); ?></td><td>variables</td><td><code>max_features</code>, <code>bootstrap_features</code></td></tr>
    <tr><td><?php hueco(12, 15); ?></td><td>registros <b>y</b> variables</td><td>los dos a la vez</td></tr>
  </table>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Error OOB</h2>
  <p>Una muestra bootstrap trae en promedio el <?php hueco(13, 5); ?>% de los registros distintos del
     original; el <?php hueco(14, 5); ?>% restante no lo vio ese arbol.</p>
  <p>Evaluar cada arbol con lo que no vio da el error <?php hueco(15, 12); ?>: un estimador del
     error sin apartar un conjunto de prueba ni pagar un K-Fold. (Scikit-learn advierte que suele
     ser algo pesimista y que, si se puede, es preferible la validacion cruzada.)</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Pros y contras</h2>
  <table class="datos">
    <tr><th>Pros</th><th>Contras</th></tr>
    <tr><td>reduce la varianza y sirve para corregir el <?php hueco(16, 12); ?>; entrenar en paralelo ahorra tiempo</td>
        <td>en paralelo usa mucha <?php hueco(18, 8); ?> y CPU</td></tr>
    <tr><td>resistente a los datos que <?php hueco(17, 9); ?></td><td></td></tr>
  </table>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Random Forest</h2>
  <p>Es bagging de arboles con un paso mas: en cada division solo se considera una muestra
     aleatoria de las <?php hueco(19, 14); ?>. Asi tiene dos fuentes de aleatoriedad.</p>
  <table class="datos">
    <tr><th><code>max_features</code> por defecto</th><th>Diapositivas</th><th>scikit-learn</th></tr>
    <tr><td>Clasificacion</td><td>&radic;m</td><td><code>"<?php hueco(20, 6); ?>"</code></td></tr>
    <tr><td>Regresion</td><td>m/3</td><td><code>1.0</code> (todas las variables)</td></tr>
  </table>
  <p>No sobreajusta por poner mas arboles, pero es lento, ocupa mucha memoria y es muy dificil
     de <?php hueco(21, 10); ?>.</p>
  <p>Detalle de sklearn: en vez de que cada arbol vote, <?php hueco(22, 9); ?> las probabilidades
     de los arboles.</p>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Extra-Trees (arboles extremadamente aleatorios)</h2>
  <p><code>ExtraTreesClassifier</code> va un paso mas alla que Random Forest: tambien sortea los
     <?php hueco(23, 9); ?> de corte de cada variable candidata y se queda con el mejor de esos al
     azar. Baja un poco mas la varianza a cambio de un poco mas de sesgo.</p>
  <p>Por defecto Random Forest usa <code>bootstrap=True</code> y Extra-Trees
     <code>bootstrap=<?php hueco(24, 6); ?></code>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Las lineas de codigo</h2>
  <?php linea(25, 'un bagging de <b>KNN</b> (sin argumentos) que use el <b>50%</b> de los registros y el <b>50%</b> de las variables', 'bagging = ...'); ?>
  <?php linea(26, 'un Random Forest con <b>100</b> arboles, profundidad maxima <b>5</b> y <code>random_state=42</code>', 'rf_clf = ...'); ?>
  <?php linea(27, 'lea la exactitud OOB de un bosque <code>rforest</code> entrenado con <code>oob_score=True</code>'); ?>
  <?php linea(28, 'la importancia de las variables del bosque <code>rf_clf</code> ya entrenado'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Conceptos/index.php', '../Boosting/index.php');
