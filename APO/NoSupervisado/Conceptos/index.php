<?php
/* ==========================================================================
   APO / NoSupervisado / Conceptos  —  Que es, tareas, tipos de clustering,
        reglas de asociacion, reduccion de dimensionalidad, por que no
        accuracy, aplicaciones, retos y deteccion de anomalias
   Fuentes: IBM "What is unsupervised learning?" ·
            00-_actividad_aprendizaje_no_supervisado(clustering).ipynb ·
            01_Aprendizaje_NoSupervisado.ipynb (anomalias)
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. que es */
    1  => ['no etiquetados', 'sin etiquetas', 'no etiquetada', 'unlabeled'],
    2  => ['etiquetado', 'etiquetar', 'etiquetado manual'],
    3  => ['semi-supervisado', 'semisupervisado', 'semi supervisado'],
    4  => ['internas', 'interna'],
    5  => ['dominio', 'conocimiento del dominio'],

    /* 2. tareas */
    6  => ['clustering', 'agrupamiento', 'agrupacion'],
    7  => ['asociacion', 'reglas de asociacion'],
    8  => ['reduccion de dimensionalidad', 'reduccion de la dimensionalidad'],

    /* 3. tipos de clustering */
    9  => ['exclusivo', 'hard', 'duro', 'exclusive'],
    10 => ['superpuesto', 'soft', 'blando', 'overlapping', 'solapado'],
    11 => ['jerarquico', 'hierarchical'],
    12 => ['probabilistico', 'probabilistic'],
    13 => ['gmm', 'gaussian mixture models', 'mezcla de gaussianas', 'modelos de mezcla gaussiana', 'gaussian mixture model'],
    14 => ['em', 'expectation-maximization', 'expectation maximization', 'expectativa maximizacion'],

    /* 4. asociacion */
    15 => ['canasta de mercado', 'market basket', 'market basket analysis', 'cesta de la compra', 'canasta'],
    16 => ['apriori'],
    17 => ['itemsets frecuentes', 'conjuntos frecuentes', 'frequent itemsets', 'itemsets'],

    /* 5. reduccion */
    18 => ['svd', 'descomposicion en valores singulares'],
    19 => ['autoencoders', 'autoencoder', 'autocodificadores'],
    20 => ['cuello de botella', 'bottleneck'],

    /* 6. anomalias */
    21 => ['escasos', 'escasas', 'pocos', 'raros'],
    22 => ['isolation forest', 'isolationforest', 'bosque de aislamiento'],
    23 => ['one-class svm', 'one class svm', 'oneclasssvm', 'svm de una clase'],
];
$TEXTO = range(1, 23);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Tienes datos sinteticos con etiquetas reales y K-means encuentra exactamente los 2 grupos correctos, pero llama "cluster 0" al que en las etiquetas es "1" y viceversa. &iquest;Por que no sirve el <code>accuracy</code>?',
        'opciones' => [
            'a' => 'Porque K-means no devuelve etiquetas',
            'b' => 'Porque los numeros de cluster son <b>arbitrarios</b>: el accuracy daria 0% aunque la particion sea perfecta. Hacen falta metricas internas (silueta) o externas que ignoren la renumeracion (ARI, NMI)',
            'c' => 'Porque el accuracy solo sirve para regresion',
            'd' => 'Porque hay que normalizar primero'
        ],
        'porque'   => 'Es la pregunta de la seccion 2 de la guia de clustering. En un problema real ni siquiera hay etiquetas contra las que comparar.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Las recomendaciones "Los clientes que compraron este articulo tambien compraron&hellip;" de Amazon son un ejemplo de:',
        'opciones' => [
            'a' => 'Clustering jerarquico',
            'b' => '<b>Reglas de asociacion</b> (analisis de canasta de mercado)',
            'c' => 'Reduccion de dimensionalidad',
            'd' => 'Regresion logistica'
        ],
        'porque'   => 'IBM pone tambien el "Discover Weekly" de Spotify. Los algoritmos: Apriori (el mas usado), Eclat y FP-Growth.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => '&iquest;Por que la deteccion de anomalias suele hacerse de forma <b>no supervisada</b>?',
        'opciones' => [
            'a' => 'Porque los modelos supervisados no detectan anomalias',
            'b' => 'Porque los ejemplos de anomalias suelen ser <b>escasos</b> (fraudes, fallos): no hay suficientes etiquetados, asi que se aprende la estructura de lo "normal" y se marca lo que se desvia',
            'c' => 'Porque las anomalias no tienen variables',
            'd' => 'Porque es mas rapido'
        ],
        'porque'   => 'En el notebook: <code>IsolationForest(contamination=0.1)</code> aisla puntos con particiones aleatorias; <code>OneClassSVM(nu=0.1)</code> aprende una frontera alrededor de los datos normales.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => '&iquest;Cual de estos <b>no</b> es un reto del aprendizaje no supervisado segun IBM?',
        'opciones' => [
            'a' => 'Mayor complejidad computacional y tiempos de entrenamiento mas largos',
            'b' => 'Mayor riesgo de resultados inexactos y necesidad de validacion humana',
            'c' => 'Poca transparencia sobre por que se agruparon asi los datos',
            'd' => '<b>Necesitar que un experto etiquete todos los datos antes de entrenar</b>'
        ],
        'porque'   => 'Al contrario: no necesitar etiquetado (lento y caro en imagenes medicas o documentos legales) es justamente su gran ventaja.',
        'correcta' => 'd'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('No supervisado 1 — Conceptos',
         'IBM ¿Que es el aprendizaje no supervisado? · guia de clustering · 01_Aprendizaje_NoSupervisado.ipynb');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>La vision general antes de ver cada algoritmo: que es el aprendizaje no supervisado, sus tres
     tareas, los tipos de clustering, las reglas de asociacion, la reduccion de dimensionalidad y la
     deteccion de anomalias.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayusculas, tildes ni el articulo.</div>
</div>


<div class="card">
  <h2>1. Que es</h2>
  <p>Trabaja con datos <?php hueco(1, 14); ?>: no hay variable objetivo y; los algoritmos descubren
     patrones solo a partir de X.</p>
  <table class="datos">
    <tr><th></th><th>Supervisado</th><th>No supervisado</th></tr>
    <tr><td>Tareas</td><td>clasificacion, regresion</td><td>clustering, reduccion de dimensionalidad, anomalias</td></tr>
    <tr><td>Evaluacion</td><td>contra la etiqueta real (exactitud, F1, MSE)</td><td>metricas <?php hueco(4, 9); ?>, sin etiqueta</td></tr>
    <tr><td>Interpretar el resultado</td><td>directo</td><td>un cluster no trae significado: hace falta conocimiento del <?php hueco(5, 9); ?></td></tr>
  </table>
  <p>Ventaja de costo: no requiere el <?php hueco(2, 12); ?> manual de los datos. Cuando solo una parte
     de los datos esta etiquetada se habla de aprendizaje <?php hueco(3, 15); ?>.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Las tres tareas</h2>
  <ol>
    <li><?php hueco(6, 12); ?>: agrupar datos por similitud.</li>
    <li><?php hueco(7, 12); ?>: encontrar relaciones entre variables (que se compra con que).</li>
    <li><?php hueco(8, 24); ?>: bajar el numero de variables conservando la informacion.</li>
  </ol>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Tipos de clustering</h2>
  <table class="datos">
    <tr><th>Tipo</th><th>Idea</th><th>Ejemplo</th></tr>
    <tr><td><?php hueco(9, 10); ?></td><td>cada punto pertenece a un solo cluster</td><td>K-means</td></tr>
    <tr><td><?php hueco(10, 11); ?></td><td>un punto puede pertenecer a varios, con distinto grado</td><td>fuzzy k-means</td></tr>
    <tr><td><?php hueco(11, 11); ?></td><td>aglomerativo (de abajo hacia arriba) o divisivo (de arriba hacia abajo); se dibuja como dendrograma</td><td>enlace Ward</td></tr>
    <tr><td><?php hueco(12, 13); ?></td><td>segun la probabilidad de pertenecer a una distribucion</td><td><?php hueco(13, 8); ?></td></tr>
  </table>
  <p>Los modelos de mezcla gaussiana suelen estimarse con el algoritmo <?php hueco(14, 18); ?>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Reglas de asociacion</h2>
  <p>Se usan sobre todo en el analisis de <?php hueco(15, 16); ?> para ventas cruzadas y recomendaciones.
     El algoritmo mas usado es <?php hueco(16, 8); ?> (tambien estan Eclat y FP-Growth): recorre transacciones
     buscando <?php hueco(17, 16); ?>.</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Reduccion de dimensionalidad</h2>
  <p>Se usa en el preprocesamiento: baja el riesgo de sobreajuste y facilita visualizar. Tres tecnicas:</p>
  <table class="datos">
    <tr><th>Tecnica</th><th>Idea</th></tr>
    <tr><td>PCA</td><td>combinaciones lineales ortogonales ordenadas por varianza</td></tr>
    <tr><td><?php hueco(18, 6); ?></td><td>factoriza A = U&middot;S&middot;V<sup>T</sup> (S diagonal con los valores singulares)</td></tr>
    <tr><td><?php hueco(19, 12); ?></td><td>red neuronal que comprime la entrada en una capa oculta (el <?php hueco(20, 14); ?>) y luego la reconstruye</td></tr>
  </table>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Aplicaciones, retos y anomalias</h2>
  <p>Aplicaciones: agrupar noticias (Google News), segmentar clientes, recomendaciones, imagenes medicas,
     vision por computador, deteccion de anomalias.</p>
  <p>La deteccion de anomalias suele ser no supervisada porque los ejemplos anomalos son
     <?php hueco(21, 8); ?>. En el notebook se usan dos modelos:
     <?php hueco(22, 16); ?> (no supervisado, aisla con particiones aleatorias) y
     <?php hueco(23, 14); ?> (aprende una frontera alrededor de los datos normales).</p>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../KMeans/index.php');
