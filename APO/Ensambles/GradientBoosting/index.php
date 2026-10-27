<?php
/* ==========================================================================
   APO / Ensambles / GradientBoosting  —  Historia, pseudo-residuos, el
        algoritmo paso a paso, ejemplo a mano, boosting vs bagging y sklearn
   Fuente: Actividad_Gradient_Boosting.ipynb (Prof. Milton Orlando Sarria Paja)
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. historia */
    1  => ['friedman', 'jerome friedman', 'jerome h. friedman'],
    2  => ['2001'],
    3  => ['adaboost'],
    4  => ['exponencial'],
    5  => ['diferenciable', 'derivable'],

    /* 2. formulacion */
    6  => ['media', 'promedio'],
    7  => ['log-odds', 'logodds', 'log odds', 'logit'],
    8  => ['sigmoide', 'logistica', 'funcion sigmoide'],
    9  => ['pseudo-residuos', 'pseudoresiduos', 'pseudo residuos', 'pseudo-residuo'],
    10 => ['gradiente negativo', 'negativo del gradiente', 'menos el gradiente'],
    11 => ['cuadratica', 'perdida cuadratica', 'error cuadratico'],
    12 => ['y - p', 'y-p', 'y menos p'],

    /* 3. ejemplo a mano */
    13 => ['4.75', '4,75'],
    14 => ['-2.75', '-2,75'],
    15 => ['2.5', '2,5'],
    16 => ['2.25', '2,25'],
    17 => ['7.25', '7,25'],
    18 => ['0.25', '0,25'],
    19 => ['4.5', '4,5'],

    /* 4. boosting vs bagging */
    20 => ['poco profundos', 'superficiales', 'stumps', 'stump', 'poco profundo'],
    21 => ['sobreajustar', 'sobreajuste', 'overfitting'],
    22 => ['no'],

    /* 5. sklearn */
    23 => ['exactitud', 'accuracy'],
    24 => ['stochastic gradient boosting', 'gradient boosting estocastico', 'boosting estocastico'],

    /* 6. codigo */
    25 => ['gb.staged_predict(X_test)'],
    26 => ['GradientBoostingClassifier(n_iter_no_change=10, validation_fraction=0.1)',
           'GradientBoostingClassifier(validation_fraction=0.1, n_iter_no_change=10)'],
    27 => ['F0 + 0.1 * pred_h1', 'F0 + nu * pred_h1', 'F0+0.1*pred_h1'],
];
$TEXTO = range(1, 24);

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Que aporto Friedman frente a AdaBoost?',
        'opciones' => [
            'a' => 'Invento los arboles de decision',
            'b' => 'Generalizo la idea: si AdaBoost es descenso de gradiente sobre <b>una</b> perdida (la exponencial), se puede hacer lo mismo con <b>cualquier perdida diferenciable</b>, ajustando cada arbol al gradiente negativo. Asi boosting paso de ser un algoritmo a un <b>marco</b> para regresion, clasificacion, ranking&hellip;',
            'c' => 'Hizo que los arboles se entrenaran en paralelo',
            'd' => 'Elimino la tasa de aprendizaje'
        ],
        'porque'   => 'La observacion previa fue de Leo Breiman. Por eso Gradient Boosting se puede usar con MSE, MAE, log-loss, etc., cambiando solo la perdida.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => '&iquest;Por que se dice "pseudo-residuos" y no simplemente "residuos"?',
        'opciones' => [
            'a' => 'Porque no son errores de verdad',
            'b' => 'Porque en general son el <b>gradiente negativo</b> de una perdida cualquiera; solo con perdida <b>cuadratica</b> (&frac12;(y &minus; F)&sup2;) coinciden exactamente con el residuo ordinario y &minus; F(x)',
            'c' => 'Porque se calculan sobre el conjunto de prueba',
            'd' => 'Porque se dividen entre el numero de arboles'
        ],
        'porque'   => 'Derivando: &minus;&part;/&part;F [&frac12;(y &minus; F)&sup2;] = y &minus; F. Con log-loss el pseudo-residuo es y &minus; p, que se parece pero no es lo mismo.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'En Random Forest, pasar de 100 a 500 arboles casi nunca empeora la prueba. &iquest;Por que en Gradient Boosting <b>si</b> puede empeorar?',
        'opciones' => [
            'a' => 'Porque Gradient Boosting usa arboles profundos',
            'b' => 'Porque cada arbol nuevo sigue corrigiendo lo que queda del error de <b>entrenamiento</b>; cuando ya no queda senal, empieza a ajustar el <b>ruido</b> y sobreajusta (mas aun con learning_rate alto)',
            'c' => 'Porque los arboles se promedian',
            'd' => 'Porque necesita mas memoria'
        ],
        'porque'   => 'En RF los arboles son independientes y se promedian; en boosting se <b>suman</b> correcciones. Por eso se grafica entrenamiento vs prueba con <code>staged_predict</code> y se usa early stopping.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => '&iquest;Por que entrenar cada arbol con solo el 80% de las muestras (<code>subsample=0.8</code>) puede ayudar, aunque el boosting sea secuencial?',
        'opciones' => [
            'a' => 'Solo porque es mas rapido',
            'b' => 'Porque mete <b>aleatoriedad</b> como en bagging: los arboles se parecen menos entre si y el ensamble depende menos de puntos concretos, lo que ayuda a generalizar',
            'c' => 'Porque elimina el 20% de los outliers',
            'd' => 'Porque convierte el boosting en Random Forest'
        ],
        'porque'   => 'Es el "Stochastic Gradient Boosting", tambien de Friedman: combina la secuencialidad del boosting con la aleatoriedad en las muestras del bagging.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Ensambles 5 — Gradient Boosting a fondo',
         'Actividad_Gradient_Boosting.ipynb (Prof. Milton Orlando Sarria Paja)');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>La guia de Gradient Boosting: de donde sale, que son los pseudo-residuos, una iteracion hecha
     a mano, por que no es lo mismo que bagging y como se controla en sklearn.</p>
  <div class="nota">Secciones 1 a 5: <b>texto</b> (decimales con punto o coma). Seccion 6: <b>codigo</b>.</div>
</div>


<div class="card">
  <h2>1. Contexto historico</h2>
  <p>Lo propuso <?php hueco(1, 12); ?> (Stanford): reporte tecnico en 1999 y publicacion formal en
     <?php hueco(2, 5); ?>, <i>"Greedy Function Approximation: A Gradient Boosting Machine"</i>.</p>
  <p>Partio de una observacion de Leo Breiman: <?php hueco(3, 9); ?> puede verse como un descenso de
     gradiente sobre una perdida <?php hueco(4, 11); ?>. Friedman lo generalizo a cualquier perdida
     <?php hueco(5, 13); ?>.</p>
  <p>La analogia de la guia: un equipo de tutores donde cada uno se enfoca exactamente en lo que mas
     te costo con el anterior.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Formulacion</h2>
  <pre><code>F_M(x) = F₀(x) + Σ ν · γₘ · hₘ(x)          ν = learning rate (shrinkage),  γₘ = peso del arbol m</code></pre>
  <p>El punto de partida F<sub>0</sub>(x) es la <?php hueco(6, 8); ?> de y en regresion, o el
     <?php hueco(7, 9); ?> de la clase positiva en clasificacion.</p>
  <p>En clasificacion F(x) no es una probabilidad sino un logit; la probabilidad sale de pasarlo por la
     funcion <?php hueco(8, 10); ?>, igual que en regresion logistica.</p>

  <p>En cada iteracion se calculan los <?php hueco(9, 15); ?>: el
     <?php hueco(10, 16); ?> de la perdida respecto a F, y un arbol debil aprende a predecirlos.</p>
  <table class="datos">
    <tr><th>Perdida</th><th>r<sub>i</sub></th></tr>
    <tr><td><?php hueco(11, 11); ?> (&frac12;(y &minus; F)&sup2;)</td><td>y<sub>i</sub> &minus; F(x<sub>i</sub>): el residuo de siempre</td></tr>
    <tr><td>log-loss</td><td><?php hueco(12, 6); ?> (con p la probabilidad predicha)</td></tr>
  </table>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Una iteracion a mano</h2>
  <p>Datos: <code>x = [1, 2, 3, 4]</code>, <code>y = [2.0, 2.5, 7.0, 7.5]</code>, perdida cuadratica, &nu; = 1.</p>
  <table class="datos">
    <tr><th>Paso</th><th>Resultado</th></tr>
    <tr><td>F<sub>0</sub> = media de y</td><td><?php hueco(13, 5); ?></td></tr>
    <tr><td>Residuos y &minus; F<sub>0</sub></td><td>[<?php hueco(14, 5); ?>, &minus;2.25, 2.25, 2.75]</td></tr>
    <tr><td>Stump (corte en x &le; 2,5) ajustado a los residuos: predice el promedio de cada lado</td><td>[&minus;2.5, &minus;2.5, <?php hueco(15, 4); ?>, 2.5]</td></tr>
    <tr><td>F<sub>1</sub> = F<sub>0</sub> + h<sub>1</sub></td><td>[<?php hueco(16, 5); ?>, 2.25, <?php hueco(17, 5); ?>, 7.25]</td></tr>
    <tr><td>Nuevos residuos: todos valen &plusmn;</td><td><?php hueco(18, 5); ?></td></tr>
  </table>
  <p>Con <b>&nu; = 0,1</b> el primer punto queda en F<sub>1</sub> = 4,75 + 0,1&middot;(&minus;2,5) =
     <?php hueco(19, 5); ?>: avanza mucho mas despacio, por eso un &nu; pequeno necesita mas iteraciones
     (de ahi el nombre <i>shrinkage</i>).</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Boosting vs bagging (lo nuevo de la guia)</h2>
  <table class="datos">
    <tr><th></th><th>Bagging / Random Forest</th><th>Gradient Boosting</th></tr>
    <tr><td>Arboles base</td><td>profundos (bajo sesgo, alta varianza)</td><td><?php hueco(20, 12); ?> (alto sesgo, baja varianza)</td></tr>
    <tr><td>Al agregar mas arboles</td><td>rara vez empeora</td><td>puede <?php hueco(21, 11); ?> si el learning_rate es alto</td></tr>
    <tr><td>&iquest;Paralelizable al entrenar?</td><td>si, trivialmente</td><td><?php hueco(22, 3); ?>: cada arbol necesita el anterior</td></tr>
  </table>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. En sklearn (breast_cancer)</h2>
  <p>Ojo con el vocabulario: <code>.score()</code> de un clasificador devuelve la
     <?php hueco(23, 9); ?>, no la "precision" (TP/(TP+FP)).</p>
  <p>Para detener el entrenamiento cuando la validacion deja de mejorar, sin XGBoost, se usan
     <code>n_iter_no_change</code>, <code>validation_fraction</code> y <code>tol</code>.</p>
  <p>Las cinco formas de controlar el sobreajuste: bajar <code>max_depth</code>, bajar
     <code>learning_rate</code> (y subir <code>n_estimators</code>), regularizar (XGBoost),
     <code>subsample</code> &lt; 1 y early stopping. Usar <code>subsample</code> se llama
     <?php hueco(24, 22); ?>.</p>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Las lineas de codigo</h2>
  <?php linea(25, 'obtenga las predicciones de <code>gb</code> sobre <code>X_test</code> <b>despues de cada iteracion</b> (sin reentrenar)', 'for y_pred in ...'); ?>
  <?php linea(26, 'un GradientBoostingClassifier que se detenga si no mejora en <b>10</b> iteraciones, apartando el <b>10%</b> para validacion', 'gb_es = ...'); ?>
  <?php linea(27, 'actualice el modelo del ejemplo a mano con &nu; = <b>0.1</b> (usa <code>F0</code> y <code>pred_h1</code>)', 'F1 = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Stacking/index.php', '../XGBoost/index.php');
