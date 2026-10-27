<?php
/* ==========================================================================
   APO / NoSupervisado / PCADiap  —  Lo que agregan las diapositivas de
        PCA y Kernel PCA y donde chocan con las otras fuentes
   Fuente: PCA_y_Kernel_PCA.pdf (UNIDAD 2) — contrastado con
           02_actividad_PCA.ipynb, 01_Aprendizaje_NoSupervisado.ipynb e IBM
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. compresion */
    1  => ['784'],
    2  => ['28x28', '28 x 28', '28×28'],
    3  => ['bytes', 'tamano', 'peso'],
    4  => ['z'],

    /* 2. kernel pca */
    5  => ['no lineal', 'no-lineal'],
    6  => ['kernel', 'funcion kernel', 'funcion de kernel'],
    7  => ['mayor', 'mas alta', 'superior'],
    8  => ['linealmente separable', 'linealmente separables', 'separable'],

    /* 3. eigenvectores */
    9  => ['12, 8', '(12, 8)', '12,8', '(12,8)'],
    10 => ['4'],
    11 => ['cuadradas', 'cuadrada'],
    12 => ['raiz de 13', '√13', 'sqrt(13)', 'raiz(13)', '3.61', '3,61', '3.6', '3,6'],
    13 => ['1'],
    14 => ['-1'],
    15 => ['1'],
    16 => ['simetricas', 'simetrica'],

    /* 4. loadings */
    17 => ['loadings', 'loading', 'cargas', 'carga'],
    18 => ['positiva o negativamente', 'positiva o negativa', 'la correlacion', 'correlacion'],
    19 => ['signo', 'el signo'],
    20 => ['n-1', 'n - 1'],
    21 => ['p'],
    22 => ['menor', 'el menor'],

    /* 5. outliers */
    23 => ['sensible', 'muy sensible'],
    24 => ['eliminarlos', 'eliminar', 'eliminarlos'],
    25 => ['cuantil', 'cuantiles', 'percentiles'],
    26 => ['media', 'promedio'],
];
$TEXTO = array_values(array_diff(range(1, 26), [9, 12, 14]));

$MULTIPLE = [
    'm1' => [
        'texto'    => '<span class="tag-contra">Contraste</span> La presentacion dice: "todos los eigenvectors de una matriz son perpendiculares (ortogonales) entre ellos". Su propio ejemplo usa A = [[2, 3], [2, 1]], cuyos vectores propios son (3, 2) con &lambda; = 4 y (1, &minus;1) con &lambda; = &minus;1. &iquest;Es cierta la frase?',
        'opciones' => [
            'a' => 'Si, siempre son ortogonales',
            'b' => '<b>No en general</b>: (3, 2)&middot;(1, &minus;1) = 1 &ne; 0, asi que no son ortogonales. Solo esta garantizado para matrices <b>simetricas</b> (teorema espectral), como la matriz de covarianza; por eso en PCA si lo son',
            'c' => 'Si, porque son de dimension 2',
            'd' => 'No, nunca son ortogonales'
        ],
        'porque'   => 'La guia de PCA lo explica bien: es la simetria de &Sigma; (cov(x<sub>i</sub>, x<sub>j</sub>) = cov(x<sub>j</sub>, x<sub>i</sub>)) la que hace que los componentes sean perpendiculares. Para el examen: en PCA, ortogonales; para una matriz cualquiera, no.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => '&iquest;En que caso usarias Kernel PCA en vez de PCA?',
        'opciones' => [
            'a' => 'Cuando hay pocas variables',
            'b' => 'Cuando la estructura de los datos es <b>no lineal</b> (por ejemplo lunas o circulos concentricos): el kernel lleva los datos a un espacio de mayor dimension donde una proyeccion lineal si los separa, sin calcular ese espacio explicitamente',
            'c' => 'Cuando los datos ya estan estandarizados',
            'd' => 'Cuando se necesitan las etiquetas'
        ],
        'porque'   => 'Es la misma idea del truco del kernel de SVM. PCA es lineal (es una de sus limitaciones segun IBM); para visualizar tambien estan t-SNE y UMAP.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Corres PCA dos veces sobre los mismos datos y todos los <i>loadings</i> de PC1 salen con el signo cambiado. &iquest;Que paso?',
        'opciones' => [
            'a' => 'Hubo un error',
            'b' => 'Nada grave: PCA es <b>reproducible</b>, la direccion del componente es la misma y solo puede invertirse el signo de todos los loadings a la vez',
            'c' => 'Que los datos tienen outliers',
            'd' => 'Que PCA es aleatorio como K-means'
        ],
        'porque'   => 'A diferencia de K-means (no determinista por la inicializacion), PCA siempre da las mismas componentes. Es el mismo punto que en la guia: un vector propio esta definido salvo el signo.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'Tienes 50 pacientes (n) y 200 variables (p). &iquest;Cuantos componentes principales se pueden calcular como maximo?',
        'opciones' => [
            'a' => '200',
            'b' => '<b>49</b>: el maximo es el menor entre n &minus; 1 y p',
            'c' => '50',
            'd' => '250'
        ],
        'porque'   => 'Con n observaciones centradas, los datos viven en un subespacio de dimension n &minus; 1 como mucho: no hay mas direcciones con varianza.',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => '<span class="tag-contra">Contraste</span> La presentacion dice que PCA es <b>muy sensible a los outliers</b>, e IBM vende PCA para "filtrar ruido". &iquest;Como encajan?',
        'opciones' => [
            'a' => 'Se contradicen: una de las dos esta mal',
            'b' => 'Son cosas distintas: el ruido <b>pequeno y repartido</b> queda en los componentes de poca varianza (que se descartan); un outlier <b>grande</b> aporta tanta varianza que puede "arrastrar" la direccion de PC1. Por eso hay que tratar los outliers antes',
            'c' => 'IBM se refiere a datos ya sin outliers por definicion',
            'd' => 'PCA elimina los outliers automaticamente'
        ],
        'porque'   => 'PCA maximiza varianza con distancias al cuadrado (igual que K-means con los centroides), y por eso los valores extremos pesan muchisimo.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('No supervisado 7 — PCA y Kernel PCA: diapositivas y contraste',
         'PCA_y_Kernel_PCA.pdf contrastado con 02_actividad_PCA.ipynb, el notebook de Mall e IBM');
?>

<style>
.tag-contra{display:inline-block;font-size:11px;font-weight:700;text-transform:uppercase;
  letter-spacing:.4px;padding:1px 8px;border-radius:12px;margin-right:6px;vertical-align:1px;
  background:#fff4e0;color:#b5730a}
</style>

<div class="card">
  <h2>De que va esto</h2>
  <p>Solo lo que las diapositivas de PCA y Kernel PCA agregan a los cuestionarios 4 y 5 (sin repetir),
     y los puntos donde las fuentes chocan.</p>
  <div class="nota">Las preguntas marcadas <span class="tag-contra">Contraste</span> comparan fuentes.
    Respuestas en <b>texto</b>, salvo los vectores y la longitud (se comparan como codigo).</div>
</div>


<div class="card">
  <h2>1. Caso real: compresion de imagenes</h2>
  <p>Cada imagen (tipo MNIST) tiene <?php hueco(1, 5); ?> pixeles, una por cada posicion de una cuadricula de
     <?php hueco(2, 6); ?>; cada pixel es una variable. La compresion busca bajar el tamano en
     <?php hueco(3, 7); ?> conservando la mayor calidad posible.</p>
  <p>Con 10 componentes el digito es borroso; con 184 casi no se distingue del original.</p>
  <p>En general: donde antes se necesitaban p valores por individuo, ahora bastan
     <?php hueco(4, 3); ?> (cada una es un componente principal).</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Kernel PCA</h2>
  <p>Reduce la dimensionalidad de forma <?php hueco(5, 10); ?>: usa una funcion
     <?php hueco(6, 8); ?> para proyectar los datos a un espacio de dimension <?php hueco(7, 7); ?>, donde
     los datos son <?php hueco(8, 22); ?>.</p>
  <p>En sklearn: <code>KernelPCA(n_components=2, kernel='rbf')</code>.</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. El ejemplo de eigenvectores de la presentacion</h2>
  <pre><code>⎡2  3⎤   ⎡3⎤     ⎡12⎤       ⎡3⎤
⎣2  1⎦ · ⎣2⎦  =  ⎣ 8⎦  = 4 · ⎣2⎦</code></pre>
  <p>A&middot;(3, 2) = (<?php hueco(9, 7); ?>), que es <?php hueco(10, 3); ?> veces (3, 2): por eso
     (3, 2) es eigenvector con eigenvalue 4.</p>
  <p>Solo existen para matrices <?php hueco(11, 10); ?>. Se escalan a longitud 1: (3, 2) mide
     <?php hueco(12, 8); ?>, asi que se divide entre ese numero y queda (3/&radic;13, 2/&radic;13), de longitud
     <?php hueco(13, 3); ?>.</p>
  <p>El otro par de esa matriz: A&middot;(1, &minus;1) = (&minus;1, 1), o sea eigenvalue
     <?php hueco(14, 4); ?>. Y (3, 2)&middot;(1, &minus;1) = <?php hueco(15, 3); ?>, distinto de 0: estos dos
     <b>no</b> son ortogonales porque A no es <?php hueco(16, 10); ?>.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Loadings, reproducibilidad y numero de componentes</h2>
  <pre><code>Z₁ = φ₁₁·X₁ + φ₂₁·X₂ + … + φₚ₁·Xₚ</code></pre>
  <p>Los coeficientes &phi; se llaman <?php hueco(17, 9); ?>. Su signo indica si la variable y el componente
     estan correlacionados <?php hueco(18, 22); ?>.</p>
  <p>PCA siempre da las mismas componentes; lo unico que puede cambiar es el <?php hueco(19, 6); ?> de todos
     los loadings.</p>
  <p>Como maximo se pueden calcular <?php hueco(20, 5); ?> o <?php hueco(21, 3); ?> componentes: el
     <?php hueco(22, 6); ?> de los dos es el limite.</p>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Outliers</h2>
  <p>PCA es muy <?php hueco(23, 9); ?> a los outliers. Formas de tratarlos segun la presentacion:</p>
  <ol>
    <li><?php hueco(24, 11); ?>.</li>
    <li>Recortarlos por <?php hueco(25, 9); ?> (limites inferior y superior).</li>
    <li>Reemplazarlos por la <?php hueco(26, 8); ?>.</li>
  </ol>
  <?php mc('m5'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../KMeansDiap/index.php', '');
