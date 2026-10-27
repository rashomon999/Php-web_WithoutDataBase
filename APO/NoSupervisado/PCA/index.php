<?php
/* ==========================================================================
   APO / NoSupervisado / PCA  —  Valores y vectores propios, por que PCA usa
        la covarianza, los pasos del algoritmo, proyeccion y reconstruccion
   Fuentes: 02_actividad_PCA.ipynb (secciones 1 a 5) ·
            01_Aprendizaje_NoSupervisado.ipynb · IBM "What is PCA?"
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. eigen */
    1  => ['direccion', 'la direccion'],
    2  => ['0', 'cero'],
    3  => ['λ^2 - 4λ + 3', 'λ²-4λ+3', 'l^2-4l+3', 'lambda^2-4lambda+3', 'λ2-4λ+3', 'λ^2-4λ+3'],
    4  => ['1'],
    5  => ['3'],
    6  => ['1, -1', '-1, 1', '(1, -1)', '(-1, 1)'],
    7  => ['simetrica', 'simetricas'],
    8  => ['ortogonales', 'perpendiculares'],
    9  => ['escala y signo', 'signo', 'escala'],

    /* 2. por que la covarianza */
    10 => ['unitario', 'norma 1', 'unitaria', 'longitud 1'],
    11 => ['lagrange', 'multiplicadores de lagrange'],
    12 => ['varianza'],
    13 => ['mayor', 'el mayor', 'mas grande'],

    /* 3. pasos */
    14 => ['pearson', 'karl pearson'],
    15 => ['1901'],
    16 => ['centrar', 'restar la media', 'centrado'],
    17 => ['n-1', 'n - 1'],
    18 => ['bessel'],
    19 => ['eigh'],
    20 => ['ascendente', 'de menor a mayor', 'creciente'],
    21 => ['scree plot', 'grafico de sedimentacion', 'scree'],
    22 => ['codo'],

    /* 4. proyeccion y reconstruccion */
    23 => ['rotado', 'rotacion', 'una rotacion'],
    24 => ['0', 'cero'],
    25 => ['independientes', 'independencia'],
    26 => ['descartados', 'descartadas'],
    27 => ['5', '5%'],

    /* 5. sklearn */
    28 => ['svd', 'descomposicion en valores singulares'],
    29 => ['filas'],
    30 => ['0.95', '0,95'],

    /* 6. codigo */
    31 => ['np.linalg.eigh(matriz_covarianza)'],
    32 => ['X_bar @ vectores_principales', 'np.dot(X_bar, vectores_principales)', 'X_bar.dot(vectores_principales)'],
    33 => ['pca_k.inverse_transform(Z_k)'],
];
$TEXTO = range(1, 30);
$TEXTO = array_values(array_diff($TEXTO, [3, 6, 19]));   /* 6 lleva signo: se compara como codigo */

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Por que el primer componente principal es el vector propio con el <b>mayor</b> valor propio?',
        'opciones' => [
            'a' => 'Por convencion, se podria usar cualquiera',
            'b' => 'Porque para un vector propio unitario w de &Sigma; se cumple <code>w<sup>T</sup>&Sigma;w = &lambda;</code>: el valor propio <b>es</b> la varianza de los datos proyectados sobre esa direccion, y PC1 es la de maxima varianza',
            'c' => 'Porque es el primero que devuelve numpy',
            'd' => 'Porque tiene la norma mas grande'
        ],
        'porque'   => 'Viene de maximizar <code>w<sup>T</sup>&Sigma;w</code> con <code>&#8214;w&#8214; = 1</code> por Lagrange: sale <code>&Sigma;w = &lambda;w</code>. PC2 es la de mayor varianza entre las ortogonales a PC1 (si no, volveria a salir PC1).',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'PC1 y PC2 tienen correlacion 0. &iquest;Significa que son estadisticamente <b>independientes</b>?',
        'opciones' => [
            'a' => 'Si, correlacion 0 y independencia son lo mismo',
            'b' => '<b>No necesariamente</b>: Pearson solo mide relacion <b>lineal</b>. Independencia implica correlacion 0, pero no al reves (puede haber relacion no lineal)',
            'c' => 'Si, porque son ortogonales',
            'd' => 'No, porque PCA las vuelve dependientes'
        ],
        'porque'   => 'PCA elimina la redundancia <b>lineal</b> (util contra la multicolinealidad), pero no garantiza nada sobre relaciones no lineales.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Tu PCA manual y el de sklearn dan proyecciones con correlacion <b>&minus;1,000000</b> en PC1. &iquest;Hay un error?',
        'opciones' => [
            'a' => 'Si, la implementacion manual esta mal',
            'b' => 'No: un vector propio esta definido <b>salvo el signo</b> (v y &minus;v son igual de validos); la direccion es la misma y la proyeccion solo sale con signo invertido',
            'c' => 'Si, sklearn no centra los datos',
            'd' => 'No, pero hay que multiplicar por la varianza'
        ],
        'porque'   => 'Otra diferencia de convencion: <code>np.linalg.eigh</code> da los vectores en <b>columnas</b>; <code>pca.components_</code> los da en <b>filas</b>.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'Se reduce de 2D a 1D y los puntos reconstruidos quedan todos sobre una recta. &iquest;Cuanto vale el error cuadratico medio de reconstruccion?',
        'opciones' => [
            'a' => 'Siempre 0',
            'b' => '(Casi) exactamente la <b>suma de los valores propios descartados</b> (aqui &lambda;<sub>2</sub>): la varianza que se tira es el error que se comete',
            'c' => 'El valor propio mas grande',
            'd' => 'No se puede calcular'
        ],
        'porque'   => 'Por eso "conservar el 95% de la varianza" equivale a aceptar un error de reconstruccion de como mucho el 5% de la varianza total. La pequena diferencia viene de n vs n&minus;1.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('No supervisado 4 — PCA: la teoría',
         '02_actividad_PCA.ipynb (secciones 1 a 5) · 01_Aprendizaje_NoSupervisado.ipynb · IBM PCA');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Lo que hay debajo de PCA: valores y vectores propios con un ejemplo a mano, por que las componentes
     son vectores propios de la covarianza, los pasos del algoritmo y que se pierde al reducir.</p>
  <div class="nota">Texto salvo la formula del polinomio, la funcion de numpy y la seccion 6 (<b>codigo</b>).</div>
</div>


<div class="card">
  <h2>1. Valores y vectores propios</h2>
  <pre><code>A·v = λ·v          (v ≠ 0)</code></pre>
  <p>Un vector propio no cambia de <?php hueco(1, 9); ?> al aplicarle A: solo se alarga, se acorta o se
     invierte. Si A tiene un valor propio igual a <?php hueco(2, 3); ?>, A no es invertible.</p>

  <h3>Ejemplo: A = [[2, 1], [1, 2]]</h3>
  <p>det(A &minus; &lambda;I) = (2 &minus; &lambda;)&sup2; &minus; 1 = <code><?php hueco(3, 12); ?></code> = 0</p>
  <table class="datos">
    <tr><th>Valor propio</th><th>Vector propio</th></tr>
    <tr><td>&lambda;<sub>1</sub> = <?php hueco(4, 3); ?></td><td>(<?php hueco(6, 7); ?>)</td></tr>
    <tr><td>&lambda;<sub>2</sub> = <?php hueco(5, 3); ?></td><td>(1, 1)</td></tr>
  </table>
  <p>Como A es <?php hueco(7, 10); ?>, el teorema espectral garantiza valores propios reales y vectores
     propios <?php hueco(8, 12); ?> entre si. Ademas, un vector propio esta definido solo salvo
     <?php hueco(9, 14); ?>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Por que la covarianza</h2>
  <pre><code>max  wᵀΣw    sujeto a  ‖w‖ = 1      →      Σw = λw</code></pre>
  <p>Se busca la direccion w que maximiza la varianza de la proyeccion. w tiene que ser un vector
     <?php hueco(10, 9); ?> (si no, bastaria con alargarlo). Resolviendo con multiplicadores de
     <?php hueco(11, 9); ?> sale exactamente la ecuacion de vectores propios de &Sigma;.</p>
  <p>Y como <code>w<sup>T</sup>&Sigma;w = &lambda;</code>, cada valor propio es la <?php hueco(12, 9); ?>
     a lo largo de su direccion. Por eso PC1 es el vector propio con el valor propio
     <?php hueco(13, 7); ?>.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Los pasos</h2>
  <p>IBM atribuye PCA a <?php hueco(14, 9); ?>, en <?php hueco(15, 5); ?>.</p>
  <ol>
    <li><b><?php hueco(16, 10); ?></b> los datos (y estandarizar si las escalas difieren).</li>
    <li><b>Matriz de covarianza</b>: <code>&Sigma; = X<sub>c</sub><sup>T</sup>X<sub>c</sub> / (<?php hueco(17, 5); ?>)</code>,
        la correccion de <?php hueco(18, 7); ?>. Es simetrica, de tamano p &times; p.</li>
    <li><b>Valores y vectores propios</b> de &Sigma;, con <code>np.linalg.<?php hueco(19, 5); ?></code>
        (la version para matrices simetricas). Devuelve los valores en orden <?php hueco(20, 11); ?>, asi que
        hay que reordenarlos de mayor a menor.</li>
    <li><b>Elegir k</b> con el <?php hueco(21, 12); ?> (buscando el <?php hueco(22, 5); ?>) o con la
        varianza acumulada (p. ej. 90-95%).</li>
    <li><b>Proyectar</b>: <code>Z = X<sub>c</sub>&middot;V<sub>k</sub></code>.</li>
  </ol>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Proyeccion y reconstruccion</h2>
  <p>Con k = p, Z es la misma nube de puntos <?php hueco(23, 8); ?>: sus ejes principales quedan
     alineados con los ejes de coordenadas.</p>
  <p>La correlacion entre PC1 y PC2 da <?php hueco(24, 3); ?>, aunque eso no las hace
     <?php hueco(25, 14); ?>.</p>
  <pre><code>X̂ = Z·Vₖᵀ + μ</code></pre>
  <p>Con k &lt; p se pierde informacion: el error cuadratico medio de reconstruccion es la suma de los
     valores propios <?php hueco(26, 11); ?>. Conservar el 95% de la varianza equivale a un error de como
     mucho el <?php hueco(27, 4); ?>% de la varianza total.</p>
  <?php mc('m2'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Frente a scikit-learn</h2>
  <p>sklearn no diagonaliza la covarianza: usa la <?php hueco(28, 6); ?> de X<sub>c</sub>, que es
     numericamente mas estable y da los mismos componentes.</p>
  <p><code>pca.components_</code> trae los componentes en <?php hueco(29, 7); ?>, y
     <code>pca.explained_variance_</code> los valores propios.</p>
  <p>Con <code>PCA(n_components=<?php hueco(30, 5); ?>)</code> se le pide que elija solo el menor numero de
     componentes que conserve el 95% de la varianza.</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Las lineas de codigo</h2>
  <?php linea(31, 'valores y vectores propios de <code>matriz_covarianza</code>, con la funcion para matrices simetricas', 'valores_propios, vectores_propios = ...'); ?>
  <?php linea(32, 'proyecte los datos centrados <code>X_bar</code> sobre <code>vectores_principales</code>', 'Z = ...'); ?>
  <?php linea(33, 'reconstruya los datos originales a partir de <code>Z_k</code> con el PCA <code>pca_k</code>', 'X_reconstruido = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Jerarquico/index.php', '../PCAPractica/index.php');
