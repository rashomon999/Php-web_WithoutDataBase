<?php
/* ==========================================================================
   APO / SVM / Sklearn  —  Formulacion (margen 2/||w||, primal y dual),
                           SVR con el tubo epsilon y el codigo en sklearn
   Fuentes: SVM.pdf (Anibal Sosa) · 0_SVM_theory_examples_v2.ipynb ·
            1_SVM-sklearn.ipynb · articulo de Medium (seccion SVR)
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* --- 1. el margen en formulas --- */
    1  => ['1'],
    2  => ['1'],
    3  => ['2/||w||', '2/‖w‖', '2 / ||w||', '2/norma de w'],
    4  => ['minimizar'],
    5  => ['convexa', 'cuadratica', 'convexa y cuadratica'],
    6  => ['4.24', '4,24', '4.2426', '4,2426', '4.243', '4,243'],

    /* --- 2. primal y dual --- */
    7  => ['dual', 'problema dual'],
    8  => ['vectores de soporte', 'vector de soporte'],
    9  => ['0', 'cero'],
    10 => ['combinacion lineal'],
    11 => ['C'],

    /* --- 3. SVR --- */
    12 => ['epsilon', 'ε', 'e'],
    13 => ['tubo', 'calle', 'banda'],
    14 => ['no', 'ningun', 'nada', 'ninguna'],
    15 => ['C'],
    16 => ['outliers', 'atipicos', 'valores atipicos'],

    /* --- 4. sklearn (codigo: si importan mayusculas) --- */
    17 => ['from sklearn.svm import SVC, SVR', 'from sklearn.svm import SVR, SVC'],
    18 => ['X_train = scaler.fit_transform(X_train)'],
    19 => ['X_test = scaler.transform(X_test)'],
    20 => ["SVC(kernel='linear', C=1)", "SVC(C=1, kernel='linear')",
           "svm.SVC(kernel='linear', C=1)", "svm.SVC(C=1, kernel='linear')"],
    21 => ["SVC(kernel='poly', degree=3)", "SVC(degree=3, kernel='poly')"],
    22 => ["SVC(kernel='rbf', gamma=1, C=1)", "SVC(kernel='rbf', C=1, gamma=1)",
           "SVC(gamma=1, C=1, kernel='rbf')", "SVC(C=1, gamma=1, kernel='rbf')",
           "SVC(gamma=1, kernel='rbf', C=1)", "SVC(C=1, kernel='rbf', gamma=1)"],
    23 => ['clf.support_vectors_'],
    24 => ['clf.coef_[0]', 'clf.coef_'],
    25 => ['clf.intercept_[0]', 'clf.intercept_'],
    26 => ['2 / np.linalg.norm(w)', '2/np.linalg.norm(w)'],
    27 => ["SVR(kernel='rbf', C=100, epsilon=0.1)", "SVR(kernel='rbf', epsilon=0.1, C=100)",
           "SVR(C=100, epsilon=0.1, kernel='rbf')", "SVR(C=100, kernel='rbf', epsilon=0.1)",
           "SVR(epsilon=0.1, C=100, kernel='rbf')", "SVR(epsilon=0.1, kernel='rbf', C=100)"],
];

/* los de texto; del 17 al 27 son lineas de codigo */
$TEXTO = range(1, 16);

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Por que se minimiza <code>&frac12;&#8214;w&#8214;&sup2;</code> en lugar de maximizar directamente el margen <code>2/&#8214;w&#8214;</code>?',
        'opciones' => [
            'a' => 'Porque dan resultados distintos y el primero es mejor',
            'b' => 'Porque llevan al <b>mismo optimo</b>, pero &#8214;w&#8214;&sup2; es cuadratica y convexa: el problema tiene solucion unica y se resuelve eficientemente (programacion cuadratica)',
            'c' => 'Porque el margen no se puede calcular',
            'd' => 'Porque asi el modelo usa mas vectores de soporte'
        ],
        'porque'   => 'Maximizar 2/&#8214;w&#8214; &hArr; minimizar &#8214;w&#8214; &hArr; minimizar &#8214;w&#8214;&sup2;. El cuadrado (y el &frac12;) solo hacen la cuenta mas comoda de derivar.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'En el problema con holgura <code>min &frac12;&#8214;w&#8214;&sup2; + C&middot;&Sigma;&xi;&#7522;</code>, &iquest;que hacen los dos terminos?',
        'opciones' => [
            'a' => 'Los dos miden el error de entrenamiento',
            'b' => 'El primero pide un <b>margen ancho</b>; el segundo suma <b>cuanto se viola el margen</b>, multiplicado por C, que decide cual de los dos pesa mas',
            'c' => 'El primero es la exactitud y el segundo el numero de clases',
            'd' => 'C solo multiplica al primer termino'
        ],
        'porque'   => 'Son dos objetivos que compiten. Con C enorme, cualquier &xi;&#7522; &gt; 0 sale carisimo y el modelo se parece al margen duro.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'En el ejemplo de SVR se sube <code>epsilon</code> de 0.01 a 0.5 dejando C fijo. &iquest;Que pasa?',
        'opciones' => [
            'a' => 'Quedan mas puntos fuera del tubo',
            'b' => 'El tubo se ensancha y quedan <b>menos puntos fuera</b>: menos puntos penalizados (y menos "vectores de soporte")',
            'c' => 'No cambia nada, epsilon solo afecta a la clasificacion',
            'd' => 'El modelo pasa a ser lineal'
        ],
        'porque'   => 'Epsilon es el ancho de la zona donde el error "no cuenta". Cuanto mas ancha, mas puntos caben sin pagar nada.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => '&iquest;Por que al conjunto de prueba se le aplica <code>scaler.transform</code> y no <code>fit_transform</code>?',
        'opciones' => [
            'a' => 'Porque <code>fit_transform</code> no existe para el test',
            'b' => 'Porque la media y la desviacion se aprenden <b>solo del entrenamiento</b>; usar las del test seria "mirar" datos que el modelo no debe conocer (fuga de informacion)',
            'c' => 'Porque el test ya viene estandarizado',
            'd' => 'Da igual, se puede usar cualquiera'
        ],
        'porque'   => 'El test tiene que tratarse exactamente como se trataran los datos nuevos en produccion: con los parametros que se calcularon en el entrenamiento.',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => '&iquest;En que caso existe <code>clf.coef_</code> (el vector w) en un <code>SVC</code>?',
        'opciones' => [
            'a' => 'Siempre, con cualquier kernel',
            'b' => 'Solo con <b>kernel lineal</b>: con RBF o polinomico el w vive en el espacio transformado &phi;, que nunca se construye',
            'c' => 'Solo con kernel RBF',
            'd' => 'Nunca, hay que calcularlo a mano'
        ],
        'porque'   => 'Es la otra cara del truco del kernel: como nunca se calcula &phi;(x), tampoco hay un w explicito que mostrar. Lo que si existe siempre es <code>support_vectors_</code>.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('SVM 3 — Fórmulas, SVR y sklearn',
         'SVM.pdf · 0_SVM_theory_examples_v2.ipynb · 1_SVM-sklearn.ipynb');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Ya con la idea clara, aqui va lo que tiene mas formula: de donde sale el ancho del margen,
     el problema primal y el dual, la version de regresion (SVR) y las lineas de sklearn que
     aparecen en los notebooks.</p>
  <div class="nota">Secciones 1 a 3: <b>texto</b>. Seccion 4: <b>codigo</b>, ahi si importan
    las mayusculas (las comillas simples y dobles valen igual).</div>
</div>


<div class="card">
  <h2>1. El margen en formulas</h2>

  <pre><code>w · xᵢ + b ≥ +1   si yᵢ = +1
w · xᵢ + b ≤ −1   si yᵢ = −1          →    yᵢ (w · xᵢ + b) ≥ 1   para todo i</code></pre>

  <p>SVM escala w y b para que, en los vectores de soporte, se cumpla
     <code>y&#7522;(w&middot;x&#7522; + b) =</code> <?php hueco(1, 3); ?>. Asi la distancia del
     hiperplano a cada borde de la calle es <code><?php hueco(2, 3); ?>/&#8214;w&#8214;</code>,
     y el ancho total del margen es <?php hueco(3, 9); ?>.</p>

  <p>Conclusion: maximizar el margen equivale a <?php hueco(4, 10); ?> &#8214;w&#8214;.
     Se plantea como <code>min &frac12;&#8214;w&#8214;&sup2;</code> porque esa funcion es
     <?php hueco(5, 10); ?>.</p>

  <p>En el notebook: <code>w = [0.333, 0.333]</code>, <code>&#8214;w&#8214; = 0.4714</code>, asi que
     el margen mide 2 / 0.4714 &asymp; <?php hueco(6, 6); ?>.</p>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Primal y dual</h2>

  <pre><code>Primal:  min ½‖w‖²                      sujeto a  yᵢ(w·xᵢ + b) ≥ 1

Dual:    max Σαᵢ − ½ ΣΣ αᵢαⱼ yᵢyⱼ (xᵢ·xⱼ)    sujeto a  αᵢ ≥ 0,  Σ αᵢyᵢ = 0

w = Σ αᵢ yᵢ xᵢ          b = yₖ − w·xₖ   (k = cualquier vector de soporte)</code></pre>

  <p>Lo que se resuelve en la practica es el problema <?php hueco(7, 8); ?>, con un
     multiplicador &alpha;&#7522; por cada punto. Solo los <?php hueco(8, 18); ?> tienen
     &alpha;&#7522; &gt; 0; para todos los demas &alpha;&#7522; = <?php hueco(9, 4); ?>.</p>

  <p>Por eso w resulta ser una <?php hueco(10, 18); ?> de los vectores de soporte.</p>

  <h3>Con margen blando</h3>
  <pre><code>min ½‖w‖² + C · Σ ξᵢ          sujeto a  yᵢ(w·xᵢ + b) ≥ 1 − ξᵢ ,   ξᵢ ≥ 0</code></pre>
  <p>Valores altos de <?php hueco(11, 3); ?> producen margenes mas estrictos.</p>

  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. SVM para regresion (SVR)</h2>

  <pre><code>| yᵢ − f(xᵢ) | ≤ ε</code></pre>

  <p>En vez de separar clases, SVR busca una funcion que pase cerca de los datos,
     con una tolerancia llamada <?php hueco(12, 8); ?>. Esa tolerancia forma un
     <?php hueco(13, 6); ?> de ancho 2&epsilon; alrededor de la prediccion.</p>

  <p>Los puntos que caen dentro <?php hueco(14, 5); ?> generan penalizacion; los que quedan
     fuera pagan un costo proporcional a <?php hueco(15, 3); ?> y hacen el papel de los
     vectores de soporte.</p>

  <p>Al revés que la clasificacion (donde se quiere la calle vacia), SVR intenta meter el mayor
     numero de puntos <b>dentro</b> de la calle. Una ventaja frente a la regresion lineal es que es
     mas robusta a los <?php hueco(16, 10); ?>.</p>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Las lineas de sklearn</h2>

  <h4>Importar y escalar</h4>
  <?php linea(17, 'importe el clasificador y el regresor de SVM, en una sola linea'); ?>
  <?php linea(18, 'ajuste el <code>scaler</code> (un <code>StandardScaler()</code> ya creado) y transforme <code>X_train</code>', 'X_train = ...'); ?>
  <?php linea(19, 'transforme <code>X_test</code> con el mismo scaler', 'X_test = ...'); ?>

  <h4>Crear los modelos</h4>
  <?php linea(20, 'un SVC con kernel <b>lineal</b> y C = 1', 'SVC(...)'); ?>
  <?php linea(21, 'un SVC con kernel <b>polinomico de grado 3</b>', 'SVC(...)'); ?>
  <?php linea(22, 'un SVC con kernel <b>RBF</b>, gamma = 1 y C = 1', 'SVC(...)'); ?>

  <h4>Lo que se saca del modelo entrenado <code>clf</code> (kernel lineal)</h4>
  <?php linea(23, 'los puntos que quedaron como vectores de soporte', 'clf....'); ?>
  <?php linea(24, 'el vector normal <code>w</code> (primera fila)', 'w = ...'); ?>
  <?php linea(25, 'el sesgo <code>b</code> (primer elemento)', 'b = ...'); ?>
  <?php linea(26, 'el ancho del margen a partir de <code>w</code>, con numpy', 'margen = ...'); ?>
  <?php ayuda('La norma de un vector en numpy esta en el submodulo de algebra lineal.'); ?>

  <h4>Regresion</h4>
  <?php linea(27, 'un SVR con kernel RBF, C = 100 y epsilon = 0.1', 'SVR(...)'); ?>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Kernels/index.php', '');
