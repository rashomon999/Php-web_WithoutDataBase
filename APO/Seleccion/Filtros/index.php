<?php
/* ==========================================================================
   APO / Seleccion / Filtros  —  Que es la seleccion de caracteristicas,
        seleccion vs extraccion, las 3 familias, dataset sintetico y metodos
        de filtro (informacion mutua, chi2, Fisher, correlacion)
   Fuente: Actividad_Feature_Selection.ipynb (Prof. Milton Orlando Sarria Paja)
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. que es */
    1  => ['subconjunto'],
    2  => ['interpretables', 'interpretable', 'explicables'],
    3  => ['entrenamiento', 'computo'],
    4  => ['varianza'],
    5  => ['maldicion de la dimensionalidad', 'dimensionalidad', 'curse of dimensionality'],

    /* 2. seleccion vs extraccion */
    6  => ['originales', 'original'],
    7  => ['nuevas', 'nuevas variables', 'combinaciones'],
    8  => ['pca', 'componentes principales'],
    9  => ['todas'],

    /* 3. familias */
    10 => ['filtro', 'filter', 'filtros'],
    11 => ['envolventes', 'wrapper', 'wrappers', 'envolvente'],
    12 => ['embebidos', 'embedded', 'embebido', 'integrados'],
    13 => ['supervisados', 'supervisado'],
    14 => ['VarianceThreshold'],

    /* 4. dataset sintetico */
    15 => ['0 y 1', '0, 1', '0,1', '0-1'],
    16 => ['ruido', 'ruido puro'],
    17 => ['redundancia', 'redundantes', 'redundante'],
    18 => ['1', '1.0', '1,0', '1.00'],

    /* 5. filtros */
    19 => ['no lineales', 'no lineal'],
    20 => ['categoricas', 'categorica', 'conteos'],
    21 => ['5', 'cinco'],
    22 => ['no negativos', 'positivos', 'no negativo', 'mayores o iguales a cero'],
    23 => ['10'],
    24 => ['separan', 'separacion', 'separa'],
    25 => ['dispersion', 'varianza', 'dispersa'],
    26 => ['anova'],
    27 => ['univariados', 'univariado'],
    28 => ['vif', 'factor de inflacion de varianza', 'variance inflation factor'],

    /* 6. codigo */
    29 => ['mutual_info_classif(X_new, Y, random_state=42)', 'mutual_info_classif(X_new, Y)'],
    30 => ['SelectKBest(chi2, k=3)', 'SelectKBest(score_func=chi2, k=3)'],
];
$TEXTO = range(1, 28);
$TEXTO = array_values(array_diff($TEXTO, [14]));   /* 14 es un nombre de clase: codigo */

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Tienes un sensor caro que mide una variable. &iquest;Por que la <b>seleccion</b> de caracteristicas puede ahorrar dinero y PCA no?',
        'opciones' => [
            'a' => 'Porque PCA borra los datos originales',
            'b' => 'Porque si la seleccion descarta esa variable, ya no hay que medirla; en cambio cada componente de PCA es una combinacion de <b>todas</b> las variables, asi que hay que seguir midiendolas todas',
            'c' => 'Porque PCA solo funciona con variables categoricas',
            'd' => 'No hay diferencia: los dos permiten dejar de medir variables'
        ],
        'porque'   => 'Es la ultima fila de la tabla de la seccion 1.1. Ademas, una variable seleccionada conserva su significado (Glucosa, IMC); una componente rara vez tiene sentido clinico directo.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'La informacion mutua da casi lo mismo a la columna 2 (ruido) y a la 7 (copia casi exacta de la 2). &iquest;Por que no detecta que una sobra?',
        'opciones' => [
            'a' => 'Porque la informacion mutua tiene un error de calculo',
            'b' => 'Porque es un filtro <b>univariado</b>: evalua cada columna contra Y por separado, sin mirar las demas. Ve <b>irrelevancia</b> frente a Y, pero no <b>redundancia</b> entre columnas',
            'c' => 'Porque la columna 7 es mas importante',
            'd' => 'Porque las dos columnas tienen correlacion 0'
        ],
        'porque'   => 'Para ver redundancia hay que comparar columnas entre si: matriz de correlacion (seccion 3.4) o VIF. Lo mismo le pasa al puntaje de Fisher.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => '<code>chi2</code> con k=3 escoge las columnas 1, 0 y <b>10</b>, aunque solo 0 y 1 tienen senal. &iquest;Cual es la leccion?',
        'opciones' => [
            'a' => 'Que la columna 10 tiene senal real',
            'b' => 'Que siempre hay que pedir k=2',
            'c' => 'Que <b>chi2 esta pensado para variables categoricas</b>: al discretizar datos continuos con <code>.astype(int)</code> se pierde informacion y el test puede quedarse con una columna de ruido para completar las k pedidas',
            'd' => 'Que chi2 detecta redundancia'
        ],
        'porque'   => 'Con k=3 el selector tiene que devolver 3 columnas aunque solo existan 2 utiles; la tercera sale de diferencias pequenas al azar entre columnas de ruido.',
        'correcta' => 'c'
    ],
    'm4' => [
        'texto'    => '&iquest;Por que KNN sufre mas que un arbol de decision cuando hay muchas columnas irrelevantes?',
        'opciones' => [
            'a' => 'Porque KNN no acepta mas de 10 columnas',
            'b' => 'Porque KNN usa <b>distancias</b> con todas las columnas: en muchas dimensiones las distancias entre puntos se parecen todas y el ruido las domina; un arbol elige en cada corte solo la variable que mejor separa',
            'c' => 'Porque el arbol normaliza los datos automaticamente',
            'd' => 'Porque KNN es un metodo de seleccion'
        ],
        'porque'   => 'Es la pregunta conceptual de la seccion 1. Ya la viste en el parcial: en 3000 dimensiones "todas las distancias tienden a ser similares".',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Selección 1 — Conceptos y métodos de filtro',
         'Actividad_Feature_Selection.ipynb (Prof. Milton Orlando Sarria Paja)');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Que es seleccionar caracteristicas y por que no es lo mismo que PCA, las tres familias de metodos,
     el dataset sintetico de la guia y los metodos de filtro.</p>
  <div class="nota">Respuestas en <b>texto</b>, salvo los nombres de clases y la seccion 6 (<b>codigo</b>).</div>
</div>


<div class="card">
  <h2>1. Que es y para que sirve</h2>
  <p>Es identificar el <?php hueco(1, 11); ?> de variables mas relevante, consistente y no redundante,
     y descartar las demas. Beneficios:</p>
  <ol>
    <li>Modelos mas simples e <?php hueco(2, 13); ?>.</li>
    <li>Tiempos de <?php hueco(3, 13); ?> mas cortos.</li>
    <li>Menos <?php hueco(4, 9); ?>: quitar ruido evita que el modelo aprenda patrones espurios.</li>
    <li>Mitigar la <?php hueco(5, 26); ?>: con mas columnas el espacio crece exponencialmente y los datos quedan dispersos.</li>
  </ol>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Seleccion vs extraccion</h2>
  <table class="datos">
    <tr><th></th><th>Seleccion</th><th>Extraccion</th></tr>
    <tr><td>Que hace</td><td>elige un subconjunto de las variables <?php hueco(6, 10); ?></td><td>construye variables <?php hueco(7, 10); ?> combinando las originales</td></tr>
    <tr><td>Ejemplo</td><td>quedarse con Glucosa e IMC</td><td><?php hueco(8, 6); ?></td></tr>
    <tr><td>Para usarla en el futuro</td><td>solo hay que medir las variables elegidas</td><td>hay que medir <?php hueco(9, 6); ?> las variables</td></tr>
  </table>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Las tres familias</h2>
  <table class="datos">
    <tr><th>Familia</th><th>Como decide</th><th>Ejemplos</th></tr>
    <tr><td><?php hueco(10, 8); ?></td><td>una metrica estadistica, <b>sin</b> entrenar el modelo final; rapidos, pero no ven interacciones</td><td>informacion mutua, chi2, Fisher, correlacion</td></tr>
    <tr><td><?php hueco(11, 11); ?></td><td>busqueda: entrenan y evaluan el modelo con distintos subconjuntos; costosos, pero si ven interacciones</td><td>forward, RFE, Boruta</td></tr>
    <tr><td><?php hueco(12, 10); ?></td><td>la seleccion ocurre <b>dentro</b> del entrenamiento</td><td>LASSO, importancia de Random Forest</td></tr>
  </table>
  <p>Casi todos son <?php hueco(13, 12); ?>: necesitan la variable objetivo Y. Sin etiquetas, una opcion
     es quitar las columnas de varianza casi nula con <code><?php hueco(14, 16); ?></code>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. El dataset sintetico</h2>
  <p>1000 puntos, dos nubes gaussianas y 12 columnas cuya respuesta conocemos de antemano:</p>
  <table class="datos">
    <tr><th>Columnas</th><th>Que son</th></tr>
    <tr><td><?php hueco(15, 6); ?></td><td>senal real (las dos nubes)</td></tr>
    <tr><td>2 a 6</td><td><?php hueco(16, 10); ?>, sin relacion con Y</td></tr>
    <tr><td>7 a 11</td><td>casi copias de las 2 a 6: sirven para probar si el metodo detecta <?php hueco(17, 12); ?></td></tr>
  </table>
  <p>La correlacion entre la columna 2 y la 7 da <?php hueco(18, 5); ?>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Metodos de filtro</h2>
  <h3>Informacion mutua</h3>
  <p>Mide cuanta incertidumbre sobre Y se reduce al conocer X<sub>j</sub>. A diferencia de Pearson,
     captura relaciones <?php hueco(19, 11); ?>. En la guia: columnas 0 y 1 &asymp; 0,54 y 0,65; el resto &asymp; 0.</p>

  <h3>Chi-cuadrado</h3>
  <p>Prueba si una variable y la clase son independientes. Condiciones: variables
     <?php hueco(20, 11); ?>, observaciones independientes y frecuencias esperadas mayores a
     <?php hueco(21, 3); ?> por celda. En sklearn ademas exige valores <?php hueco(22, 12); ?>,
     por eso se desplazan los datos. Elige las columnas 1, 0 y <?php hueco(23, 3); ?>.</p>

  <h3>Puntaje de Fisher</h3>
  <pre><code>        Σ n_c · (μ_jc − μ_j)²          ← cuanto se separan los centros de las clases
F_j = ─────────────────────
        Σ n_c · σ²_jc                   ← cuanta dispersion hay dentro de cada clase</code></pre>
  <p>Un puntaje alto = clases que se <?php hueco(24, 9); ?> bien y con poca
     <?php hueco(25, 10); ?> interna. Es la misma idea que el estadistico F del
     <?php hueco(26, 6); ?>. En la guia: 2,24 y 4,49 para las columnas 0 y 1; casi 0 para el resto.</p>

  <h3>Correlacion</h3>
  <p>Informacion mutua y Fisher son filtros <?php hueco(27, 11); ?>. La matriz de correlacion es la
     primera herramienta que detecta redundancia <b>entre</b> variables; para cuantificar la
     multicolinealidad existe el <?php hueco(28, 16); ?>.</p>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Las lineas de codigo</h2>
  <?php linea(29, 'la informacion mutua de cada columna de <code>X_new</code> respecto a <code>Y</code>, con <code>random_state=42</code>', 'importancias_mi = ...'); ?>
  <?php linea(30, 'un selector que se quede con las <b>3</b> mejores columnas segun <b>chi-cuadrado</b>', 'chi2_features = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../Wrappers/index.php');
