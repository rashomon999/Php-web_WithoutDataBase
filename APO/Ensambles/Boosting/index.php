<?php
/* ==========================================================================
   APO / Ensambles / Boosting  —  Idea, algoritmo, AdaBoost, Gradient Boosting,
                                  XGBoost, HistGradientBoosting y sklearn
   Fuentes: Ensemble Learning (Bagging, Boostrap, Stacking).pdf ·
            02_AprendSup-Ensambles.pptx · 01_Arboles_Churn-STUD.ipynb ·
            IBM "What is ensemble learning?" · scikit-learn 1.11.1 / 1.11.7
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. que es */
    1  => ['debiles', 'debil', 'weak'],
    2  => ['sesgo', 'bias'],
    3  => ['secuencialmente', 'secuencial', 'en serie'],
    4  => ['promedio ponderado', 'ponderado', 'weighted average'],

    /* 2. algoritmo */
    5  => ['aumenta', 'aumentan', 'sube', 'suben', 'crece', 'se aumenta'],
    6  => ['disminuye', 'disminuyen', 'baja', 'bajan', 'se reduce', 'reduce'],
    7  => ['learning rate', 'tasa de aprendizaje', 'shrinking', 'shrinkage'],

    /* 3. variantes */
    8  => ['adaboost'],
    9  => ['gradient boosting'],
    10 => ['xgboost'],
    11 => ['adaptive boosting', 'boosting adaptativo'],
    12 => ['residuos', 'residuales', 'errores residuales', 'gradiente negativo', 'negativo del gradiente'],

    /* 4. pros y contras */
    13 => ['sesgo', 'bias'],
    14 => ['memoria'],
    15 => ['tiempo'],
    16 => ['sobreajuste', 'overfitting'],

    /* 5. sklearn */
    17 => ['decision stumps', 'decision stump', 'stumps', 'stump'],
    18 => ['50'],
    19 => ['1.0', '1', '1,0'],
    20 => ['0.1', '0,1'],
    21 => ['0.5', '0,5'],
    22 => ['regresion', 'regresor', 'arbol de regresion', 'regresores'],
    23 => ['faltantes', 'nan', 'valores faltantes', 'missing values', 'datos faltantes'],
    24 => ['max_iter'],

    /* 6. codigo */
    25 => ["AdaBoostClassifier(n_estimators=400, learning_rate=0.2)",
           "AdaBoostClassifier(learning_rate=0.2, n_estimators=400)",
           "AdaBoostClassifier(n_estimators=400, algorithm='SAMME', learning_rate=0.2)"],
    26 => ['GradientBoostingClassifier(n_estimators=100, learning_rate=0.1)',
           'GradientBoostingClassifier(learning_rate=0.1, n_estimators=100)'],
    27 => ['HistGradientBoostingClassifier(max_iter=100)'],
];
$TEXTO = range(1, 23);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Las tres "frases" de clase para las variantes de boosting. &iquest;Cual corresponde a <b>XGBoost</b>?',
        'opciones' => [
            'a' => '"Me equivoco en esto &rarr; voy a concentrarme mas ahi"',
            'b' => '"Voy a aprender exactamente que me falto para corregirlo"',
            'c' => '"Voy a corregirlo de la mejor forma posible, <b>rapido y sin sobreajustar</b>"',
            'd' => '"Voy a votar con todos los modelos a la vez"'
        ],
        'porque'   => 'a = AdaBoost (sube el peso de lo que fallo), b = Gradient Boosting (el siguiente modelo aprende el residuo), c = XGBoost (gradient boosting optimizado y con regularizacion).',
        'correcta' => 'c'
    ],
    'm2' => [
        'texto'    => 'Dataset pequeno y con mucho ruido en las etiquetas: &iquest;por que el boosting puede salir mal?',
        'opciones' => [
            'a' => 'Porque no acepta mas de dos clases',
            'b' => 'Porque cada modelo se concentra en lo que el anterior fallo, y los puntos <b>ruidosos</b> siempre se fallan: el ensamble termina persiguiendo el ruido y <b>sobreajusta</b>',
            'c' => 'Porque necesita entrenar en paralelo',
            'd' => 'Porque reduce la varianza demasiado'
        ],
        'porque'   => 'En ese escenario se prefiere bagging, que reduce varianza promediando y es mas robusto al ruido.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'En scikit-learn, &iquest;cuando conviene <code>HistGradientBoostingClassifier</code> en vez de <code>GradientBoostingClassifier</code>?',
        'opciones' => [
            'a' => 'Siempre, en cualquier tamano de datos',
            'b' => 'Con <b>muchas muestras</b> (de decenas de miles en adelante) puede ser ordenes de magnitud mas rapido porque agrupa los valores en bins (~256); con pocos datos el clasico puede ser mejor porque los cortes por bins quedan muy aproximados',
            'c' => 'Solo cuando el problema es de regresion',
            'd' => 'Solo cuando no hay variables categoricas'
        ],
        'porque'   => 'Ademas maneja NaN y categoricas de forma nativa, y activa early stopping por defecto cuando hay mas de 10.000 muestras.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'En el notebook de churn se comparan AdaBoost con <code>learning_rate</code> 1,0, 0,2 y 0,05 (400 modelos cada uno). &iquest;Que es razonable esperar?',
        'opciones' => [
            'a' => 'Que los tres den exactamente las mismas curvas',
            'b' => 'Que con tasa <b>baja</b> la exactitud suba mas despacio (hacen falta mas modelos) pero sea menos propensa a sobreajustar; con tasa alta sube rapido y puede empezar a sobreajustar antes',
            'c' => 'Que con 0,05 nunca aprenda nada',
            'd' => 'Que la tasa solo cambie el tiempo, no el resultado'
        ],
        'porque'   => 'Tasa de aprendizaje y numero de modelos van de la mano: si bajas una, necesitas subir el otro. Por eso <code>staged_predict</code> grafica la exactitud modelo a modelo.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Ensambles 3 — Boosting',
         'Ensemble Learning.pdf · 02_AprendSup-Ensambles.pptx · IBM · scikit-learn');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>El metodo secuencial: que combina, como cambia los pesos, las tres variantes que se vieron
     (AdaBoost, Gradient Boosting, XGBoost), pros y contras, y los estimadores de sklearn.</p>
  <div class="nota">Secciones 1 a 5: <b>texto</b>. Seccion 6: <b>codigo</b>.</div>
</div>


<div class="card">
  <h2>1. Que es boosting</h2>
  <p>Combina modelos <?php hueco(1, 8); ?> con alto sesgo para producir un modelo final con menos
     <?php hueco(2, 6); ?>. Los entrena <?php hueco(3, 14); ?>: cada uno mejora los errores de los
     anteriores.</p>
  <p>Las predicciones se agregan con un <?php hueco(4, 18); ?>: pesa mas el modelo con mayor poder
     predictivo.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. El algoritmo</h2>
  <ol>
    <li>Se entrena un primer modelo debil sobre los datos.</li>
    <li>Se le asigna un peso a su decision segun su error.</li>
    <li>El peso de las instancias mal predichas se <?php hueco(5, 9); ?> y el de las bien predichas
        se <?php hueco(6, 9); ?>.</li>
    <li>Se entrena un nuevo modelo influido por esos errores y se repite.</li>
    <li>La prediccion final es la suma ponderada de todos.</li>
  </ol>
  <p>Sus tres tipos de parametros: numero de arboles, <?php hueco(7, 14); ?> y complejidad de los arboles.</p>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Variantes</h2>
  <table class="datos">
    <tr><th>Variante</th><th>La frase de clase</th></tr>
    <tr><td><?php hueco(8, 10); ?></td><td>"Me equivoco en esto &rarr; voy a concentrarme mas ahi"</td></tr>
    <tr><td><?php hueco(9, 16); ?></td><td>"Voy a aprender exactamente que me falto para corregirlo"</td></tr>
    <tr><td><?php hueco(10, 9); ?></td><td>"Voy a corregirlo de la mejor forma posible, rapido y sin sobreajustar"</td></tr>
  </table>
  <p>AdaBoost significa <?php hueco(11, 16); ?>. En Gradient Boosting, cada arbol nuevo se entrena
     para predecir los <?php hueco(12, 12); ?> del modelo anterior (lo que le falto).</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Pros y contras</h2>
  <table class="datos">
    <tr><th>Pros</th><th>Contras</th></tr>
    <tr><td>suele reducir el <?php hueco(13, 6); ?> porque se centra en corregir las predicciones erroneas</td>
        <td>el entrenamiento secuencial requiere mucho <?php hueco(15, 7); ?></td></tr>
    <tr><td>construye un modelo a la vez: necesita menos <?php hueco(14, 8); ?> y CPU que bagging</td>
        <td>puede caer en <?php hueco(16, 12); ?></td></tr>
  </table>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. En scikit-learn</h2>
  <h3>AdaBoost</h3>
  <p><code>AdaBoostClassifier</code> usa por defecto <?php hueco(17, 14); ?> (arboles de
     profundidad 1), <code>n_estimators=<?php hueco(18, 4); ?></code> y
     <code>learning_rate=<?php hueco(19, 4); ?></code>.</p>

  <h3>Gradient Boosting</h3>
  <p>Cada paso se escala por la tasa de aprendizaje: <code>F<sub>m</sub> = F<sub>m&minus;1</sub> + &nu;&middot;h<sub>m</sub></code>.
     Scikit-learn recomienda <code>learning_rate</code> &le; <?php hueco(20, 4); ?> con suficientes
     arboles. Con <code>subsample</code> (tipico <?php hueco(21, 4); ?>) cada etapa usa solo una parte de los datos.</p>
  <p>Aunque el problema sea de clasificacion, cada <code>h<sub>m</sub></code> es un arbol de
     <?php hueco(22, 10); ?>, porque predice gradientes, que son numeros continuos.</p>

  <h3>HistGradientBoosting</h3>
  <p>Inspirado en LightGBM. Acepta valores <?php hueco(23, 10); ?> y categoricas sin preprocesar,
     y en lugar de <code>n_estimators</code> usa <code><?php hueco(24, 9); ?></code>.</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Las lineas de codigo</h2>
  <?php linea(25, 'un AdaBoost con <b>400</b> modelos y tasa de aprendizaje <b>0.2</b>', 'ada_02 = ...'); ?>
  <?php linea(26, 'un Gradient Boosting clasificador con <b>100</b> arboles y tasa <b>0.1</b>', 'gb = ...'); ?>
  <?php linea(27, 'un HistGradientBoosting clasificador con <b>100</b> iteraciones', 'clf = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Bagging/index.php', '../Stacking/index.php');
