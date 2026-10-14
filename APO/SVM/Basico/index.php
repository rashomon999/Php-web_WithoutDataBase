<?php
/* ==========================================================================
   APO / SVM / Basico  —  SVM lo basico: que es, hiperplano, margen,
                          vectores de soporte, clasificar y pros/contras
   Fuentes: SVM.pdf (Anibal Sosa) · 0_SVM_theory_examples_v2.ipynb
            (Prof. Milton Orlando Sarria Paja) · articulo de Medium
            "Support Vector Machines (SVM): An Intuitive Explanation"
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* --- 1. que es --- */
    1  => ['supervisado'],
    2  => ['clasificacion'],
    3  => ['regresion'],
    4  => ['hiperplano'],
    5  => ['maximo', 'maximo posible', 'mas grande', 'mayor'],

    /* --- 2. hiperplano --- */
    6  => ['linea', 'recta', 'linea recta'],
    7  => ['plano'],
    8  => ['N-1', 'n-1', 'n - 1'],
    9  => ['normal', 'perpendicular', 'vector normal', 'de pesos', 'pesos'],
    10 => ['sesgo', 'bias', 'intercepto'],

    /* --- 3. margen --- */
    11 => ['cercanos', 'proximos', 'mas cercanos'],
    12 => ['calle', 'carretera', 'autopista', 'camino'],
    13 => ['generalizacion', 'generalizar'],
    14 => ['margen maximo', 'maximo margen', 'margen amplio'],

    /* --- 4. vectores de soporte --- */
    15 => ['vectores de soporte', 'vector de soporte', 'support vectors'],
    16 => ['margen', 'linea de margen', 'borde del margen'],
    17 => ['2', 'dos'],

    /* --- 5. clasificar un punto nuevo --- */
    18 => ['signo', 'sign'],
    19 => ['1.33', '1,33', '4/3', '1.333', '1,333'],
    20 => ['1.67', '1,67', '5/3', '1.667', '1,667'],
    21 => ['0', 'cero'],

    /* --- 6. ventajas y desventajas --- */
    22 => ['dimension', 'dimensionalidad', 'alta dimension'],
    23 => ['kernels', 'kernel', 'nucleos'],
    24 => ['escala', 'escalas'],
    25 => ['grandes', 'grande', 'muy grandes'],
    26 => ['negra'],
];

/* todo es texto (no hay lineas de codigo en este cuestionario) */
$TEXTO = range(1, 26);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Tres rectas distintas separan perfectamente los 6 puntos de entrenamiento. &iquest;Cual prefiere una SVM?',
        'opciones' => [
            'a' => 'Cualquiera, porque las tres clasifican bien el entrenamiento',
            'b' => 'La que deja <b>mas espacio libre</b> a ambos lados (la "del medio"), porque un punto nuevo un poco distinto tiene menos riesgo de caer del lado equivocado',
            'c' => 'La que pasa mas cerca de la clase mas grande',
            'd' => 'La que tenga pendiente positiva'
        ],
        'porque'   => 'Es el ejemplo de las candidatas A, B y C del notebook. A y B pasan rozando algunos puntos; C deja una calle ancha. Lo que hace SVM es convertir ese "a ojo" en un problema matematico: buscar la frontera con el <b>margen mas grande</b>.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => '&iquest;Por que el algoritmo se llama "maquina de <b>vectores de soporte</b>"?',
        'opciones' => [
            'a' => 'Porque usa todos los puntos del dataset por igual',
            'b' => 'Porque los puntos mas cercanos a la frontera son los que la "<b>sostienen</b>": determinan su posicion y orientacion',
            'c' => 'Porque necesita un vector de pesos por cada clase',
            'd' => 'Porque es un algoritmo de soporte tecnico'
        ],
        'porque'   => 'En la analogia del articulo de Medium, son los edificios que quedan al borde de la autopista: ellos limitan cuan ancha puede ser. Los demas edificios no influyen.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Mueves un punto de entrenamiento que esta <b>lejos</b> de la frontera (sigue del lado correcto y fuera del margen). &iquest;Que le pasa al hiperplano?',
        'opciones' => [
            'a' => 'Cambia por completo',
            'b' => 'Se desplaza un poco hacia ese punto',
            'c' => '<b>No cambia en absoluto</b>: solo los vectores de soporte definen la solucion',
            'd' => 'El modelo deja de funcionar'
        ],
        'porque'   => 'La solucion depende solo de un subconjunto pequeno de los datos. Por eso SVM es eficiente en memoria: puede "olvidar" los puntos lejanos.',
        'correcta' => 'c'
    ],
    'm4' => [
        'texto'    => 'Para el punto [5, 5] el modelo da <code>f(x) = 0.00</code>. &iquest;Que significa?',
        'opciones' => [
            'a' => 'Que el punto pertenece a la clase 0',
            'b' => 'Que el punto es un vector de soporte',
            'c' => 'Que cae <b>justo sobre el hiperplano</b>: es el caso mas ambiguo, el modelo no tiene ninguna confianza en esa prediccion',
            'd' => 'Que hubo un error de calculo'
        ],
        'porque'   => 'f(x) no solo da el signo (la clase), tambien la magnitud: cuanto mas lejos de 0, mas lejos esta el punto de la frontera y mas "seguro" es el resultado.',
        'correcta' => 'c'
    ],
    'm5' => [
        'texto'    => 'Una de las desventajas de SVM es que es sensible a la escala de los datos. &iquest;Que se hace en la practica (lo hace el notebook de sklearn)?',
        'opciones' => [
            'a' => 'Nada, no afecta al resultado',
            'b' => 'Eliminar las columnas con valores grandes',
            'c' => '<b>Estandarizar</b> las caracteristicas (por ejemplo con <code>StandardScaler</code>) antes de entrenar',
            'd' => 'Usar siempre el kernel lineal'
        ],
        'porque'   => 'El margen es una <b>distancia</b>: si una variable va de 0 a 1 y otra de 0 a 10&nbsp;000, la segunda domina la distancia. Estandarizar pone todas en la misma escala.',
        'correcta' => 'c'
    ],
    'm6' => [
        'texto'    => '&iquest;Cual de estas <b>NO</b> es una aplicacion tipica de SVM que menciona el articulo?',
        'opciones' => [
            'a' => 'Clasificacion de imagenes y reconocimiento de digitos escritos a mano',
            'b' => 'Clasificacion de texto: spam, analisis de sentimiento',
            'c' => 'Diagnostico medico y bioinformatica',
            'd' => '<b>Ordenar alfabeticamente una lista de nombres</b>'
        ],
        'porque'   => 'Ordenar una lista no es un problema de aprendizaje. El articulo cita imagenes (OCR, rostros), texto, bioinformatica, finanzas (fraude, credito) y medicina.',
        'correcta' => 'd'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('SVM 1 — Lo básico',
         'SVM.pdf (Anibal Sosa) · 0_SVM_theory_examples_v2.ipynb · articulo de Medium');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Primer cuestionario de SVM: la idea general antes de cualquier formula larga.
     Que hace el algoritmo, que es el hiperplano, el margen y los vectores de soporte,
     como se clasifica un punto nuevo y cuales son sus ventajas y desventajas.</p>
  <div class="nota">Todas las respuestas son <b>texto</b>: no importan mayusculas, tildes
    ni el articulo de delante. Los decimales aceptan punto o coma.</div>
</div>


<div class="card">
  <h2>1. Que es una SVM</h2>

  <p>Las Maquinas de Vectores de Soporte (SVM) son un algoritmo de aprendizaje
     <?php hueco(1, 12); ?> (necesitan datos con etiqueta).</p>

  <p>Se usan principalmente para <?php hueco(2, 14); ?>, aunque tambien se pueden
     adaptar a <?php hueco(3, 12); ?>.</p>

  <p>Su objetivo es encontrar el <?php hueco(4, 12); ?> que separe los datos en clases
     con el margen <?php hueco(5, 10); ?> posible.</p>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. El hiperplano</h2>

  <p>Es la <b>frontera de decision</b>: lo que cae de un lado es de una clase y lo que cae del
     otro es de la otra.</p>

  <table class="datos">
    <tr><th>Espacio</th><th>El hiperplano es&hellip;</th></tr>
    <tr><td>2 dimensiones</td><td>una <?php hueco(6, 8); ?></td></tr>
    <tr><td>3 dimensiones</td><td>un <?php hueco(7, 8); ?></td></tr>
    <tr><td>N dimensiones</td><td>algo de <?php hueco(8, 6); ?> dimensiones</td></tr>
  </table>

  <pre><code>w · x + b = 0</code></pre>

  <p><code>w</code> es el vector <?php hueco(9, 10); ?> al hiperplano (define su
     <b>orientacion</b>) y <code>b</code> es el <?php hueco(10, 8); ?>, que lo desplaza
     paralelamente a si mismo.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. El margen</h2>

  <p>El <b>margen</b> es la distancia entre el hiperplano y los puntos mas
     <?php hueco(11, 10); ?> de cada clase.</p>

  <p>La forma intuitiva de verlo: SVM trata de meter la <?php hueco(12, 8); ?> mas ancha
     posible entre las dos clases. La linea del centro es el hiperplano y los bordes son las
     lineas de margen.</p>

  <p>Un margen amplio mejora la capacidad de <?php hueco(13, 14); ?> a datos nuevos.
     Por eso a SVM tambien se le llama clasificador de <?php hueco(14, 14); ?>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Vectores de soporte</h2>

  <p>Los puntos de entrenamiento mas cercanos al hiperplano se llaman
     <?php hueco(15, 18); ?>. Caen exactamente sobre la linea de
     <?php hueco(16, 10); ?>, y son los que determinan la posicion y orientacion de la frontera.</p>

  <p>En el ejemplo del notebook hay 6 puntos de entrenamiento, pero el modelo solo marca
     <?php hueco(17, 4); ?> como vectores de soporte: <code>[3, 4]</code> y <code>[6, 7]</code>.</p>

  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Clasificar un punto nuevo</h2>

  <pre><code>f(x) = w · x + b         f(x) > 0  → clase +1
                         f(x) < 0  → clase −1
                         f(x) = 0  → justo sobre el hiperplano</code></pre>

  <p>En las diapositivas aparece como <code>sign(w·x &minus; b)</code>: lo que decide la
     clase es el <?php hueco(18, 8); ?> del resultado.</p>

  <p>El modelo entrenado del notebook tiene <code>w = [0.333, 0.333]</code> y
     <code>b = &minus;3.333</code>. Completa:</p>

  <table class="datos">
    <tr><th>Punto</th><th>f(x) = w&middot;x + b</th><th>Clase</th></tr>
    <tr><td>[7, 7]</td><td>0.333&middot;7 + 0.333&middot;7 &minus; 3.333 &asymp; <?php hueco(19, 6); ?></td><td>1</td></tr>
    <tr><td>[3, 2]</td><td>0.333&middot;3 + 0.333&middot;2 &minus; 3.333 &asymp; &minus;<?php hueco(20, 6); ?></td><td><?php hueco(21, 4); ?></td></tr>
  </table>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Ventajas, desventajas y usos</h2>

  <table class="datos">
    <tr><th>Ventajas</th><th>Desventajas</th></tr>
    <tr><td>Efectivo en espacios de alta <?php hueco(22, 12); ?></td>
        <td>Sensible a la <?php hueco(24, 8); ?> de los datos</td></tr>
    <tr><td>Robusto ante el sobreajuste gracias al margen maximo</td>
        <td>Costoso computacionalmente para datasets <?php hueco(25, 8); ?></td></tr>
    <tr><td>Versatil gracias a los <?php hueco(23, 8); ?></td>
        <td>Dificil de interpretar: modelo de caja <?php hueco(26, 8); ?></td></tr>
  </table>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../Kernels/index.php');
