<?php
/* ==========================================================================
   APO / NoSupervisado / Jerarquico  —  Clustering jerarquico y enlaces,
        DBSCAN, metricas internas y externas, y el caso wine
   Fuentes: 00-_actividad_aprendizaje_no_supervisado(clustering).ipynb ·
            IBM "What is unsupervised learning?"
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. jerarquico */
    1  => ['aglomerativo'],
    2  => ['divisivo'],
    3  => ['dendrograma'],
    4  => ['altura', 'distancia'],
    5  => ['N^2', 'n^2', 'n2', 'n²', 'cuadratica', 'O(N^2)', 'o(n2)', 'o(n²)'],

    /* 2. enlaces */
    6  => ['single'],
    7  => ['complete'],
    8  => ['average'],
    9  => ['ward'],
    10 => ['chaining', 'encadenamiento', 'cadenas', 'efecto chaining'],

    /* 3. DBSCAN */
    11 => ['densidad'],
    12 => ['eps', 'epsilon'],
    13 => ['min_samples'],
    14 => ['nucleo', 'core'],
    15 => ['borde', 'border'],
    16 => ['-1'],
    17 => ['si', 'sí'],
    18 => ['vecino', 'k-esimo vecino', 'k esimo vecino', 'kesimo vecino'],
    19 => ['optics', 'hdbscan'],

    /* 4. metricas */
    20 => ['menor', 'mas bajo', 'bajo'],
    21 => ['mayor', 'mas alto', 'alto'],
    22 => ['ari', 'indice de rand ajustado', 'adjusted rand index', 'rand ajustado'],
    23 => ['1', 'uno'],
    24 => ['nmi', 'informacion mutua normalizada', 'normalized mutual information'],

    /* 5. wine */
    25 => ['178'],
    26 => ['proline'],
    27 => ['3', 'tres'],

    /* 6. codigo */
    28 => ["AgglomerativeClustering(n_clusters=4, linkage='ward')",
           "AgglomerativeClustering(linkage='ward', n_clusters=4)"],
    29 => ['DBSCAN(eps=0.2, min_samples=5)', 'DBSCAN(min_samples=5, eps=0.2)'],
    30 => ['adjusted_rand_score(y_wine_real, y_kmeans_wine)'],
];
$TEXTO = range(1, 27);
$TEXTO = array_values(array_diff($TEXTO, [5, 6, 7, 8, 9, 12, 13]));

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Que da el dendrograma que no da correr K-means varias veces con distintos K?',
        'opciones' => [
            'a' => 'Nada, son equivalentes',
            'b' => 'Una jerarquia <b>anidada</b>: el agrupamiento con 3 clusters se obtiene fusionando dos del de 4, y se puede "cortar" a cualquier altura; en K-means el resultado con K = 3 no tiene por que estar contenido en el de K = 4',
            'c' => 'Una inercia menor',
            'd' => 'Etiquetas reales'
        ],
        'porque'   => 'A cambio es costoso: O(N&sup2;) en memoria y hasta O(N&sup3;) en tiempo, por eso se dibuja con una submuestra.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Sobre "dos lunas", &iquest;que enlace es el que las separa bien y por que?',
        'opciones' => [
            'a' => 'Ward, porque minimiza la varianza',
            'b' => '<b>Single</b>: solo necesita una cadena de puntos cercanos consecutivos para unir un grupo, asi que puede seguir una forma curva y alargada (aunque es sensible al ruido)',
            'c' => 'Complete, porque usa el par mas lejano',
            'd' => 'Ninguno puede'
        ],
        'porque'   => 'Ward se parece a K-means (minimiza varianza, clusters esfericos) y comparte su problema con formas no convexas.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Con <code>min_samples=5</code>, &iquest;cuantos vecinos <b>distintos de si mismo</b> necesita un punto dentro de <code>eps</code> para ser nucleo en scikit-learn?',
        'opciones' => [
            'a' => '5',
            'b' => '<b>4</b>, porque el propio punto cuenta dentro de los 5',
            'c' => '6',
            'd' => 'Depende de eps'
        ],
        'porque'   => 'Es la convencion de sklearn que la guia resalta. Por eso al hacer el grafico de distancias se usa <code>NearestNeighbors(n_neighbors=5)</code>, que tambien se cuenta a si mismo.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'En los circulos concentricos el anillo externo es menos denso que el interno. &iquest;Que problema tiene DBSCAN?',
        'opciones' => [
            'a' => 'Ninguno, siempre separa circulos',
            'b' => 'Un <code>eps</code> lo bastante grande para conectar los puntos dispersos del anillo externo puede ser tan grande que tambien una el anillo externo con el interno: con <b>densidades muy distintas</b> no hay un unico eps bueno',
            'c' => 'Que no acepta datos 2D',
            'd' => 'Que necesita saber K'
        ],
        'porque'   => 'OPTICS y HDBSCAN extienden DBSCAN para manejar densidades variables sin un unico eps global.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('No supervisado 3 — Jerárquico, DBSCAN y evaluación',
         'guia de clustering (secciones 4 a 6) · IBM');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Las otras dos familias de clustering de la guia (jerarquico y DBSCAN), cuando usar cada una, y como
     evaluar un clustering con y sin etiquetas.</p>
  <div class="nota">Texto salvo nombres de parametros/enlaces y la seccion 6 (<b>codigo</b>).</div>
</div>


<div class="card">
  <h2>1. Clustering jerarquico</h2>
  <p>El <?php hueco(1, 12); ?> empieza con cada punto como su propio cluster y los va fusionando de a pares
     (el mas usado); el <?php hueco(2, 9); ?> empieza con uno solo y lo va partiendo.</p>
  <p>El proceso se dibuja en un <?php hueco(3, 12); ?>: la <?php hueco(4, 9); ?> de cada fusion indica que
     tan lejos estaban los dos grupos, y al "cortar" a cierta altura se obtiene un numero de clusters.</p>
  <p>Escala peor que K-means: memoria O(<?php hueco(5, 5); ?>) y hasta O(N&sup3;) en tiempo.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Criterios de enlace (linkage)</h2>
  <table class="datos">
    <tr><th>Enlace</th><th>Distancia entre dos clusters</th><th>Tendencia</th></tr>
    <tr><td><code><?php hueco(6, 8); ?></code></td><td>el par de puntos <b>mas cercano</b></td><td>sigue formas alargadas, pero un punto "puente" encadena grupos</td></tr>
    <tr><td><code><?php hueco(7, 8); ?></code></td><td>el par de puntos <b>mas lejano</b></td><td>clusters compactos; puede romper grupos grandes</td></tr>
    <tr><td><code><?php hueco(8, 8); ?></code></td><td>el promedio de todas las distancias</td><td>intermedio</td></tr>
    <tr><td><code><?php hueco(9, 8); ?></code></td><td>el aumento de la varianza intra-cluster al fusionar</td><td>parecido a K-means: esfericos y de tamano similar</td></tr>
  </table>
  <p>El efecto de encadenar grupos por un puente se llama <?php hueco(10, 12); ?>.</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. DBSCAN</h2>
  <p>Un cluster es una region de alta <?php hueco(11, 9); ?> conectada. No hay que dar el numero de
     clusters: lo infiere. Dos parametros: <code><?php hueco(12, 6); ?></code> (radio de la vecindad) y
     <code><?php hueco(13, 12); ?></code> (puntos minimos en esa vecindad).</p>
  <table class="datos">
    <tr><th>Tipo de punto</th><th>Condicion</th></tr>
    <tr><td><?php hueco(14, 7); ?></td><td>tiene al menos min_samples puntos (contandose) dentro de eps</td></tr>
    <tr><td><?php hueco(15, 7); ?></td><td>no es nucleo, pero esta en la vecindad de uno</td></tr>
    <tr><td>Ruido (etiqueta <?php hueco(16, 3); ?>)</td><td>ni lo uno ni lo otro</td></tr>
  </table>
  <p>&iquest;Puede dejar puntos sin cluster, a diferencia de K-means y el jerarquico? <?php hueco(17, 3); ?>.</p>
  <p>Para elegir eps (Ester et al., 1996) se grafica la distancia de cada punto a su k-esimo
     <?php hueco(18, 10); ?>, ordenada, y se busca el codo. Para densidades muy distintas existen
     <?php hueco(19, 8); ?> y su variante.</p>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Como evaluar un clustering</h2>
  <table class="datos">
    <tr><th>Metrica</th><th>Tipo</th><th>Mejor si es&hellip;</th></tr>
    <tr><td>Silueta</td><td>interna (sin etiquetas)</td><td>mayor (max 1)</td></tr>
    <tr><td>Davies-Bouldin</td><td>interna</td><td><?php hueco(20, 7); ?></td></tr>
    <tr><td>Calinski-Harabasz (dispersion entre / dentro)</td><td>interna</td><td><?php hueco(21, 7); ?></td></tr>
    <tr><td><?php hueco(22, 14); ?></td><td>externa (necesita etiquetas)</td><td>1 = coincidencia perfecta salvo renumeracion; &asymp;0 = como el azar</td></tr>
    <tr><td><?php hueco(24, 14); ?></td><td>externa</td><td>mayor</td></tr>
  </table>
  <p>El indice de Rand ajustado vale <?php hueco(23, 3); ?> si las dos particiones coinciden perfectamente.
     IBM menciona ademas el indice de Dunn (mayor separacion = mejor).</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Caso wine</h2>
  <p><code>load_wine</code>: <?php hueco(25, 5); ?> vinos, 13 variables quimicas y
     <?php hueco(27, 3); ?> cultivares (que se guardan aparte y solo se usan para verificar al final).</p>
  <p>Hay que estandarizar antes: <code><?php hueco(26, 8); ?></code> va de cientos a miles, mientras
     <code>hue</code> es menor que 2, y dominaria cualquier distancia euclidiana.</p>
  <div class="nota">Para ir mas alla: los GMM generalizan K-means con clusters elipticos y asignacion "blanda" (probabilidades).</div>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Las lineas de codigo</h2>
  <?php linea(28, 'un clustering aglomerativo de <b>4</b> clusters con enlace <b>Ward</b>', 'hier = ...'); ?>
  <?php linea(29, 'un DBSCAN con radio <b>0.2</b> y <b>5</b> puntos minimos', 'dbscan = ...'); ?>
  <?php linea(30, 'el indice de Rand ajustado entre <code>y_wine_real</code> y <code>y_kmeans_wine</code>', 'ari = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../KMeans/index.php', '../PCA/index.php');
