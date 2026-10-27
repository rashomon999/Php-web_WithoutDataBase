<?php
/* ==========================================================================
   APO / Metricas / Clasificacion  —  Metricas de clasificacion binaria
   Fuentes: Sesion5-2_metrics_for_classification.ipynb · Actividad_metricas.pdf (casos 1 y 3)
   No repite lo del repaso del parcial 1 (definiciones de accuracy / precision / recall,
   caso del fraude, umbral 0.5 -> 0.3).
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. matriz */
    1  => ['tn', 'vn', 'verdaderos negativos'],
    2  => ['tp', 'vp', 'verdaderos positivos'],
    3  => ['real', 'reales', 'clase real'],
    4  => ['fila', 'filas'],
    5  => ['0.75', '0,75', '75%', '75'],
    6  => ['0.727', '0,727', '0.73', '0,73', '8/11', '72.7%', '72,7%'],
    7  => ['0.8', '0,8', '0.80', '0,80', '80%'],
    8  => ['0.762', '0,762', '0.76', '0,76', '76.2%', '76,2%'],

    /* 2. metricas nuevas */
    9  => ['fp', 'falsos positivos'],
    10 => ['especificidad', 'specificity'],
    11 => ['0.595', '0,595', '0.6', '0,6', '59.5%', '59,5%'],
    12 => ['especificidad', 'specificity'],
    13 => ['armonica'],
    14 => ['zero_division'],

    /* 3. casos */
    15 => ['0.2', '0,2', '20%', '20'],

    /* 4. sales */
    16 => ['estratificada', 'estratificado', 'stratify'],
    17 => ['0.95', '0,95', '95%'],
    18 => ['0', '0.0', '0,0'],
    19 => ['0.333', '0,333', '0.33', '0,33', '1/3', '33%', '33.3%', '33,3%'],
    20 => ['0.5', '0,5', '50%'],
    21 => ['0.4', '0,4', '40%'],
    22 => ['support', 'soporte', 'numero de observaciones', 'tamano de cada clase'],

    /* 5. roc */
    23 => ['fpr', 'tasa de falsos positivos'],
    24 => ['izquierda', 'superior izquierda'],
    25 => ['diagonal'],
    26 => ['mayor', 'mas alta'],
    27 => ['aceptable'],

    /* 6. actividad */
    28 => ['99.5', '99,5', '99.5%', '99,5%'],
    29 => ['0.73', '0,73', '0.726', '0,726'],

    /* 7. codigo */
    30 => ['balanced_accuracy_score(y_true, y_pred)'],
    31 => ['roc_curve(y_test, y_scores)'],
];
$TEXTO = array_values(array_diff(range(1, 31), [14, 30, 31]));

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Un modelo predice "positivo" para las 10 observaciones; 9 de ellas son positivas de verdad. &iquest;Que metrica delata que no aprendio nada?',
        'opciones' => [
            'a' => 'La precision (90 %)',
            'b' => 'El accuracy (90 %)',
            'c' => 'La <b>especificidad (0 %)</b>: no identifica ni un solo negativo',
            'd' => 'El recall (100 %)'
        ],
        'porque'   => 'Es el caso 2 del notebook. Precision, accuracy, recall y F1 (94,7 %) se ven excelentes solo porque la clase positiva domina. Por eso la matriz completa se mira siempre.',
        'correcta' => 'c'
    ],
    'm2' => [
        'texto'    => 'Dos de los casos del notebook tienen el <b>mismo accuracy (80 %)</b>: el caso 1 (precision 33 %, recall 100 %) y el caso 4 (precision 0 %, recall 0 %). Para detectar una enfermedad rara, &iquest;cual se prefiere?',
        'opciones' => [
            'a' => 'Da igual, tienen el mismo accuracy',
            'b' => 'El <b>caso 1</b>: encuentra al unico enfermo (recall 100 %) a costa de 2 falsas alarmas; el caso 4 no detecta a nadie y su unica alarma es falsa',
            'c' => 'El caso 4, porque se equivoca menos veces',
            'd' => 'Ninguno se puede comparar'
        ],
        'porque'   => 'Es la pregunta de reflexion del notebook: el mismo accuracy esconde perfiles de error opuestos.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Un colega dice: "Mi modelo tiene AUC = 0,95, asi que no necesito revisar la matriz de confusion ni escoger el umbral con cuidado". &iquest;Que le falta?',
        'opciones' => [
            'a' => 'Nada, un AUC de 0,95 garantiza buen desempeno en cualquier umbral',
            'b' => 'El AUC resume <b>todos</b> los umbrales a la vez (capacidad de ordenar positivos sobre negativos); en produccion se usa <b>un</b> umbral, y alli precision, recall y la matriz pueden ser malos para el costo real de los errores',
            'c' => 'Que el AUC solo sirve para regresion',
            'd' => 'Que hay que mirar el accuracy en vez del AUC'
        ],
        'porque'   => 'Ejercicio 3 del notebook: el AUC es una medida "global"; precision, recall, F1 y la matriz son "puntuales" (dependen del umbral).',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'Caso 1 de la actividad: cancer raro (0,5 % de la poblacion). Modelo Alpha: accuracy 99,6 %, recall 0,15. Modelo Beta: accuracy 95 %, recall 0,92, precision 0,60. &iquest;Cual seguir explorando?',
        'opciones' => [
            'a' => 'Alpha, porque tiene mas accuracy',
            'b' => '<b>Beta</b>: detecta 92 de cada 100 pacientes con cancer; Alpha deja escapar 85 de cada 100. Las falsas alarmas de Beta (precision 60 %) se resuelven con una prueba de confirmacion',
            'c' => 'Ninguno, los dos son malos',
            'd' => 'Alpha, porque su precision seguro es mayor'
        ],
        'porque'   => 'Es la "paradoja de la exactitud": decir "sano" a todos ya da 99,5 % de accuracy. Las metricas que propone la actividad: recall (sensibilidad), precision, F1 (y especificidad / AUC).',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => 'Caso 3 de la actividad: moderar discurso de odio. Sentinel: recall 95 %, precision 40 % (F1 &asymp; 0,56). Guardian: precision 92 %, recall 70 % (F1 &asymp; 0,80). &iquest;Que priorizar y que hacer con lo que Guardian no detecta?',
        'opciones' => [
            'a' => 'Recall: usar Sentinel, borrar lo mas posible aunque sea legitimo',
            'b' => '<b>Precision</b>: con Sentinel 6 de cada 10 comentarios borrados serian legitimos (censura, usuarios que se van). Usar Guardian para borrar automatico lo muy seguro y mandar los casos dudosos y los reportes de usuarios a <b>revision humana</b>',
            'c' => 'Accuracy, porque es el promedio de todo',
            'd' => 'Ninguna: no se puede moderar con IA'
        ],
        'porque'   => 'Aqui el falso positivo (borrar algo legitimo) le cuesta a la red social la confianza de los usuarios. Es el mismo razonamiento del caso del banco en el parcial 1, pero en otro contexto: la metrica depende de que error es mas caro.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Metricas 3 — Metricas de clasificacion',
         'Sesion5-2_metrics_for_classification.ipynb · Actividad_metricas.pdf');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Lo que el notebook agrega a lo del parcial 1: la convencion de la matriz en sklearn, especificidad, exactitud balanceada,
     F1 como media armonica, el caso <code>zero_division</code>, el reporte de clasificacion, como se construye la curva ROC y
     los casos de la actividad. Las definiciones de accuracy, precision y recall no se repiten.</p>
  <div class="nota">Ojo con el idioma: <b>exactitud</b> = accuracy; <b>precision</b> = precision (VP / predichos positivos). No son lo mismo.
    Respuestas en <b>texto</b>; los numeros con punto o coma.</div>
</div>


<div class="card">
  <h2>1. La matriz de confusion en sklearn</h2>
  <p><code>confusion_matrix(y_true, y_pred)</code> devuelve <code>[[<?php hueco(1, 4); ?>, FP], [FN, <?php hueco(2, 4); ?>]]</code>:
     cada fila es la clase <?php hueco(3, 6); ?> y cada columna la predicha.
     Con <code>normalize='true'</code> se divide por el total de cada <?php hueco(4, 5); ?>.</p>
  <p>Ejemplo del notebook (20 casos): <code>[[7, 3], [2, 8]]</code>.</p>
  <table class="datos">
    <tr><th>Accuracy</th><th>Precision</th><th>Recall</th><th>F1</th></tr>
    <tr><td><?php hueco(5, 5); ?></td><td><?php hueco(6, 5); ?></td><td><?php hueco(7, 5); ?></td><td><?php hueco(8, 5); ?></td></tr>
  </table>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Las metricas nuevas</h2>
  <table class="datos">
    <tr><th>Metrica</th><th>Formula</th><th>Pregunta que responde</th></tr>
    <tr><td>Especificidad</td><td>VN / (VN + <?php hueco(9, 4); ?>)</td><td>de los que debia descartar, &iquest;cuantos descarte?</td></tr>
    <tr><td>Exactitud balanceada</td><td>&frac12; (recall + <?php hueco(10, 12); ?>)</td><td>accuracy promediado por clase: no lo infla la clase mayoritaria</td></tr>
    <tr><td>Tasa de falsos positivos (FPR)</td><td>FP / (FP + VN) = 1 &minus; <?php hueco(12, 12); ?></td><td>eje X de la curva ROC</td></tr>
    <tr><td>F1</td><td>2·P·R / (P + R)</td><td>media <?php hueco(13, 8); ?> de precision y recall: si una es baja, el F1 es bajo</td></tr>
  </table>
  <p>Ejemplo: 7 negativos (acierta 6) y 3 positivos (acierta 1). Accuracy = 0,70 pero exactitud balanceada =
     <?php hueco(11, 6); ?> (promedio de 85,7 % y 33,3 %).</p>
  <p>Si no hay ningun positivo predicho ni acertado, precision y recall son 0/0. sklearn lo resuelve con el parametro
     <code><?php hueco(14, 12); ?>=0</code>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Los cinco casos del notebook</h2>
  <p>Caso 3: 9 positivos, el modelo solo marca 1 (y acierta). Precision 100 %, recall 11 %, especificidad 100 %, pero el accuracy es apenas
     <?php hueco(15, 5); ?>. Si predice positivo, se le cree; si predice negativo, no.</p>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Caso aplicado: compras en una tienda deportiva (5 % compra)</h2>
  <p>950 no compran y 50 compran. Se parte con <code>stratify</code> (particion <?php hueco(16, 13); ?>) para que haya compradores en prueba.</p>
  <table class="datos">
    <tr><th>Modelo</th><th>Accuracy</th><th>Recall</th><th>Precision</th><th>F1</th></tr>
    <tr><td>Siempre "no compra"</td><td><?php hueco(17, 5); ?></td><td>0</td><td>0</td><td><?php hueco(18, 4); ?></td></tr>
    <tr><td>Regresion logistica <code>[[280, 5], [10, 5]]</code></td><td>0,95</td><td><?php hueco(19, 5); ?></td><td><?php hueco(20, 4); ?></td><td><?php hueco(21, 4); ?></td></tr>
  </table>
  <p>Mismo accuracy, mismos 15 errores, utilidad opuesta: solo el F1 (y el recall) lo muestra.</p>
  <p>En <code>classification_report</code>, <i>macro avg</i> promedia las clases sin ponderar; <i>weighted avg</i> pondera por el
     <?php hueco(22, 9); ?> de cada clase.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Curva ROC y AUC</h2>
  <ol>
    <li>Se predicen <b>probabilidades</b>, no etiquetas.</li>
    <li>Para cada umbral se calculan TPR (= recall) y FPR.</li>
    <li>Se grafica TPR (eje Y) contra <?php hueco(23, 6); ?> (eje X).</li>
  </ol>
  <p>El clasificador ideal llega a la esquina superior <?php hueco(24, 9); ?> (FPR = 0, TPR = 1); uno aleatorio sigue la
     <?php hueco(25, 8); ?>.</p>
  <p>El AUC se lee como la probabilidad de que un positivo tomado al azar reciba una probabilidad <?php hueco(26, 6); ?>
     que un negativo tomado al azar.</p>
  <table class="datos">
    <tr><th>AUC</th><th>0,90–1,00</th><th>0,80–0,90</th><th>0,70–0,80</th><th>0,60–0,70</th><th>0,50–0,60</th></tr>
    <tr><td>Discriminacion</td><td>excelente</td><td>muy buena</td><td><?php hueco(27, 9); ?></td><td>debil</td><td>casi aleatoria</td></tr>
  </table>
  <p>En breast cancer con solo 2 variables (para poder graficar) la logistica da AUC 0,9727; con las 30, 0,9974.</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Actividad: consultor de IA</h2>
  <p>Caso 1: si la enfermedad afecta al 0,5 %, un modelo que diga "sano" a todos ya tiene accuracy de <?php hueco(28, 5); ?> %.
     El F1 de Beta es 2·0,60·0,92 / (0,60 + 0,92) &asymp; <?php hueco(29, 5); ?>.</p>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. El codigo</h2>
  <?php linea(30, 'exactitud balanceada a partir de <code>y_true</code> y <code>y_pred</code>', 'balanced_accuracy_score(...)'); ?>
  <?php linea(31, 'los puntos de la curva ROC a partir de <code>y_test</code> y las probabilidades <code>y_scores</code> (devuelve fpr, tpr, umbrales)', 'roc_curve(...)'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Regularizacion/index.php', '../Regresion/index.php');
