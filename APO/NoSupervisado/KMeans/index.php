<?php
/* ==========================================================================
   APO / NoSupervisado / KMeans  —  Inercia, algoritmo, supuestos, k-means++
        y n_init, codo y silueta, segmentacion de imagenes, Mall Customers
   Fuentes: 00-_actividad_aprendizaje_no_supervisado(clustering).ipynb ·
            01_Aprendizaje_NoSupervisado.ipynb · IBM "What is k-means clustering?"
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. que optimiza */
    1  => ['inercia', 'wcss', 'within cluster sum of squares'],
    2  => ['cuadrado', 'al cuadrado'],
    3  => ['media', 'promedio'],
    4  => ['asignacion'],
    5  => ['actualizacion'],
    6  => ['esfericos', 'esferico', 'convexos', 'convexos y esfericos'],

    /* 2. inicializacion */
    7  => ['optimo local', 'minimo local', 'local'],
    8  => ['k-means++', 'kmeans++', 'k means++'],
    9  => ['lejanos', 'lejos', 'alejados'],
    10 => ['10'],
    11 => ['menor', 'mas baja', 'minima'],
    12 => ['1508', '1507', '1507.81', '1508.41', '1511'],

    /* 3. eleccion de K */
    13 => ['disminuye', 'baja', 'decrece'],
    14 => ['0', 'cero'],
    15 => ['propio', 'su propio', 'mismo'],
    16 => ['vecino', 'mas cercano', 'vecino mas cercano'],
    17 => ['-1'],
    18 => ['frontera', 'borde'],
    19 => ['4', 'cuatro'],
    20 => ['sample_size'],

    /* 4. imagen */
    21 => ['3', 'tres'],
    22 => ['x, y', 'x y', 'xy', 'coordenadas', 'posicion'],
    23 => ['salpicado', 'salpicada'],
    24 => ['peso'],

    /* 5. mall */
    25 => ['5', 'cinco'],
    26 => ['?'],
    27 => ['moda', 'frecuencia'],
    28 => ['media', 'promedio'],

    /* 6. codigo */
    29 => ["KMeans(n_clusters=4, random_state=42)"],
    30 => ['kmeans.inertia_'],
    31 => ['silhouette_score(X_blobs, labels)'],
    32 => ['kmeans.cluster_centers_'],
];
$TEXTO = range(1, 28);
$TEXTO = array_values(array_diff($TEXTO, [20, 26]));   /* 26 es '?': se compara literal */

$MULTIPLE = [
    'm1' => [
        'texto'    => 'K-means con K = 2 sobre "dos lunas" corta cada luna por la mitad en vez de separarlas. &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque K = 2 es demasiado pequeno',
            'b' => 'Porque asigna cada punto al <b>centroide mas cercano</b>: la frontera entre dos centroides es una recta (la mediatriz), asi que solo produce grupos convexos; una luna curva no se puede separar asi',
            'c' => 'Porque falto normalizar',
            'd' => 'Porque n_init era 1'
        ],
        'porque'   => 'Viene de minimizar distancias euclidianas al cuadrado al centroide. Para formas no convexas sirven el enlace single o DBSCAN.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Con <code>init=\'random\'</code> y <code>n_init=1</code>, 6 semillas dan inercias entre 1562 y 1721; con <code>n_init=10</code> todas quedan cerca de 1508. &iquest;Que se concluye?',
        'opciones' => [
            'a' => 'Que las semillas no importan',
            'b' => 'Que K-means se queda en <b>optimos locales</b> distintos segun donde empiece; repetirlo 10 veces y quedarse con la menor inercia reduce mucho ese riesgo (a cambio de 10 veces mas computo)',
            'c' => 'Que n_init=10 cambia el numero de clusters',
            'd' => 'Que la inercia no sirve para comparar'
        ],
        'porque'   => 'Por eso es no determinista: con datos identicos dos corridas pueden dar asignaciones distintas. k-means++ (Arthur y Vassilvitskii) elige centroides iniciales lejanos entre si, con probabilidad segun la distancia.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => '&iquest;Por que no basta con elegir el K de menor inercia?',
        'opciones' => [
            'a' => 'Porque la inercia es negativa',
            'b' => 'Porque la inercia <b>siempre baja</b> al aumentar K (con K = N vale 0): se busca el <b>codo</b>, donde agregar clusters deja de ayudar, o se usa la silueta, que no decrece monotonamente',
            'c' => 'Porque la inercia solo funciona con K = 2',
            'd' => 'Porque la inercia depende de las etiquetas'
        ],
        'porque'   => 'IBM advierte que el metodo del codo no siempre es el mejor con datos de alta dimension o formas irregulares.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'Un K-means sobre datos de clientes tiene 3 clientes atipicos muy alejados. &iquest;Que les pasa?',
        'opciones' => [
            'a' => 'Quedan como ruido (-1)',
            'b' => 'K-means los <b>obliga</b> a pertenecer a algun cluster, y como el centroide es un promedio, lo <b>desplaza</b> hacia ellos',
            'c' => 'Se eliminan automaticamente',
            'd' => 'Forman un cluster nuevo siempre'
        ],
        'porque'   => 'IBM: es muy sensible a outliers porque los centroides son promedios. DBSCAN, en cambio, puede marcarlos como ruido.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('No supervisado 2 — K-means',
         'guia de clustering · 01_Aprendizaje_NoSupervisado.ipynb · IBM k-means');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Que optimiza K-means, como funciona, que supone sobre los datos, por que importa la inicializacion,
     como se elige K y los dos casos practicos (segmentar una imagen y clientes de un centro comercial).</p>
  <div class="nota">Texto salvo nombres de parametros y la seccion 6 (<b>codigo</b>).</div>
</div>


<div class="card">
  <h2>1. Que optimiza y como funciona</h2>
  <pre><code>Inercia = Σₖ Σ_{xᵢ ∈ Cₖ} ‖xᵢ − μₖ‖²</code></pre>
  <p>K-means minimiza la <?php hueco(1, 9); ?>: la suma de distancias euclidianas al
     <?php hueco(2, 9); ?> de cada punto al centroide de su cluster, que es la
     <?php hueco(3, 8); ?> de sus puntos.</p>
  <p>Alterna dos pasos hasta converger: <?php hueco(4, 11); ?> (cada punto al centroide mas cercano) y
     <?php hueco(5, 13); ?> (recalcular cada centroide). IBM los llama paso de expectativa y de maximizacion.</p>
  <p>Por usar distancia al cuadrado al centro, supone clusters convexos y aproximadamente
     <?php hueco(6, 10); ?>, de tamano parecido y sin outliers notables.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Inicializacion</h2>
  <p>K-means converge a un <?php hueco(7, 12); ?>, no necesariamente al global, y depende de donde empiecen
     los centroides.</p>
  <table class="datos">
    <tr><th>Parametro</th><th>Que hace</th><th>Por defecto</th></tr>
    <tr><td><code>init</code></td><td>como se eligen los centroides iniciales; la opcion inteligente los escoge <?php hueco(9, 8); ?> entre si</td><td><code>'<?php hueco(8, 9); ?>'</code></td></tr>
    <tr><td><code>n_init</code></td><td>cuantas veces se repite todo el proceso, quedandose con la inercia <?php hueco(11, 7); ?></td><td><?php hueco(10, 4); ?></td></tr>
  </table>
  <p>En el experimento con 6 clusters solapados, con <code>n_init=10</code> la inercia queda alrededor de
     <?php hueco(12, 6); ?> en todas las semillas.</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Como elegir K</h2>
  <p><b>Codo:</b> la inercia siempre <?php hueco(13, 9); ?> al aumentar K (con K = N vale
     <?php hueco(14, 4); ?>); se busca donde la curva se aplana.</p>
  <pre><code>s(i) = ( b(i) − a(i) ) / max( a(i), b(i) )</code></pre>
  <p><b>Silueta:</b> a(i) es la distancia promedio a los puntos de su <?php hueco(15, 7); ?> cluster
     (cohesion); b(i) la distancia promedio al cluster <?php hueco(16, 14); ?> (separacion).
     Va de <?php hueco(17, 3); ?> a 1: cerca de 1, bien ubicado; cerca de 0, en la
     <?php hueco(18, 9); ?> entre dos clusters; negativo, probablemente mal asignado.</p>
  <p>En <code>X_blobs</code> (generado con 4 centros) la mayor silueta se da con K = <?php hueco(19, 3); ?>.</p>
  <p>La silueta cuesta O(N&sup2;); para aproximarla con una submuestra se usa el parametro
     <code><?php hueco(20, 12); ?></code>.</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Practica: segmentar una imagen</h2>
  <p>Cada pixel es un punto con sus valores R, G, B. La imagen facil (fondo, circulo y rectangulo) da un
     codo claro en K = <?php hueco(21, 3); ?> y silueta aproximada de 0,90.</p>
  <p>Se escala con <code>MinMaxScaler</code>, porque color (0-255) y posicion (0-160) estan en escalas distintas.</p>
  <p>En la imagen dificil (vineta de iluminacion, poco contraste, mucho ruido), usar solo RGB da un
     resultado <?php hueco(23, 10); ?>. Agregar las coordenadas <?php hueco(22, 12); ?> ayuda, pero cuanto
     influyen depende del <?php hueco(24, 6); ?> que se les de: demasiado y la particion se vuelve puramente
     geometrica.</p>
  <div class="nota">Los numeros de cluster no tienen por que coincidir con los de la mascara real: si las
    formas coinciden, la segmentacion es correcta.</div>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Caso Mall Customers</h2>
  <p>Con ingreso anual y puntuacion de gasto, el codo sugiere <?php hueco(25, 3); ?> clusters, que se
     nombran a mano: ingreso alto/gasto alto, ingreso alto/gasto bajo, ingreso bajo/gasto alto, etc.</p>
  <p>En la base completa los faltantes vienen como <code>"<?php hueco(26, 3); ?>"</code>, asi que se
     reemplazan por NaN. Luego: Age &rarr; se eliminan esas filas; Annual Income &rarr; se rellena con la
     <?php hueco(27, 10); ?> ('78'); Spending Score &rarr; con la <?php hueco(28, 8); ?> (&asymp; 70,9).</p>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Las lineas de codigo</h2>
  <?php linea(29, 'un K-means de <b>4</b> clusters con <code>random_state=42</code>', 'kmeans = ...'); ?>
  <?php linea(30, 'la inercia del modelo ya entrenado <code>kmeans</code>'); ?>
  <?php linea(31, 'la silueta media de las etiquetas <code>labels</code> sobre <code>X_blobs</code>'); ?>
  <?php linea(32, 'las coordenadas de los centroides de <code>kmeans</code>', 'centroids = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Conceptos/index.php', '../Jerarquico/index.php');
