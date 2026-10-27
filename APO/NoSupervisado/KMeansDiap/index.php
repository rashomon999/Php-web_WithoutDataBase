<?php
/* ==========================================================================
   APO / NoSupervisado / KMeansDiap  —  Lo que agregan las diapositivas de
        K-means (Ordonez) y donde chocan con las otras fuentes
   Fuente: K-means_algorithm.pdf (Jose Armando Ordonez, UNIDAD 2) — contrastado
           con la guia de clustering, 01_Aprendizaje_NoSupervisado.ipynb e IBM
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. caso twitter */
    1  => ['140'],
    2  => ['big five', 'ocean', 'ocean the big five', 'los cinco grandes'],
    3  => ['5', 'cinco'],
    4  => ['3', 'tres'],
    5  => ['centroides', 'centroids'],
    6  => ['etiquetas', 'etiqueta'],

    /* 2. los 8 pasos */
    7  => ['K', 'k', 'numero de clusters', 'el valor de k'],
    8  => ['calinski-harabasz', 'calinski harabasz', 'indice calinski-harabasz', 'calinski'],
    9  => ['euclidiana'],
    10 => ['media', 'promedio'],
    11 => ['varianza', 'varianza total'],
    12 => ['puntos de partida', 'inicializaciones', 'centroides iniciales', 'puntos iniciales'],
    13 => ['m', '1/m'],

    /* 3. inicializacion */
    14 => ['aleatoria', 'al azar', 'aleatoriamente'],
    15 => ['observaciones', 'observaciones existentes', 'datos'],
    16 => ['distancia'],

    /* 4. distancias */
    17 => ['euclidiana'],
    18 => ['manhattan'],
    19 => ['coseno'],
    20 => ['escala', 'la escala'],
    21 => ['baja', 'baja dimensionalidad'],
    22 => ['alta', 'alta dimensionalidad'],
    23 => ['5', 'cinco'],

    /* 5. normalizacion */
    24 => ['min', 'minimo', 'x_min', 'xmin'],
    25 => ['max', 'maximo', 'x_max', 'xmax'],
    26 => ['z-score', 'z score', 'zscore', 'estandarizacion', 'puntaje z'],
    27 => ['normal', 'distribucion normal'],

    /* 6. pros y contras */
    28 => ['lineal'],
    29 => ['numericos', 'numericas', 'numerico'],
    30 => ['convexas', 'no convexas'],
];
$TEXTO = range(1, 30);

$MULTIPLE = [
    /* --- las preguntas de "Comprueba tu conocimiento" de la presentacion --- */
    'm1' => [
        'texto'    => '<span class="tag-diap">Diapositiva</span> Selecciona la respuesta correcta:',
        'opciones' => [
            'a' => 'K-means es un algoritmo de aprendizaje supervisado que se utiliza solo para datos no etiquetados.',
            'b' => 'K-means es un algoritmo de aprendizaje supervisado que se utiliza para problemas de clasificacion.',
            'c' => 'K-means es un algoritmo de clasificacion no supervisada que se utiliza para datos no etiquetados.',
            'd' => 'K-means es un algoritmo de aprendizaje no supervisado que se utiliza para problemas de regresion.'
        ],
        'porque'   => 'Es no supervisado (descarta a y b) y agrupa, no predice valores continuos (descarta d).',
        'correcta' => 'c'
    ],
    'm2' => [
        'texto'    => '<span class="tag-diap">Diapositiva</span> &iquest;Como se puede determinar el numero optimo de clusters (k)?',
        'opciones' => [
            'a' => 'Se pueden utilizar solo 2 metodos: el metodo del codo y el metodo de la silueta',
            'b' => 'En realidad, k se puede determinar facilmente al azar',
            'c' => 'Solo es recomendable usar el metodo del codo',
            'd' => 'Existen 3 metodos: el metodo de la silueta, el metodo del codo y el de indice Calinski-Harabasz'
        ],
        'porque'   => 'Asi lo plantea la presentacion. En la guia de clustering Calinski-Harabasz (y Davies-Bouldin) aparecen como metricas internas; aqui se usan tambien para escoger K.',
        'correcta' => 'd'
    ],
    'm3' => [
        'texto'    => '<span class="tag-diap">Diapositiva</span> &iquest;Cual de las siguientes afirmaciones es cierta sobre los centroides en el algoritmo K-means?',
        'opciones' => [
            'a' => 'Los centroides son puntos de datos reales del conjunto de datos.',
            'b' => 'Los centroides son puntos seleccionados al azar dentro del rango de valores de los datos.',
            'c' => 'Los centroides son puntos iniciales generados por el algoritmo.',
            'd' => 'Los centroides son puntos que representan el centroide de cada cluster.'
        ],
        'porque'   => 'Al final son la media de los puntos del grupo: casi nunca coinciden con un dato real (a), y el azar solo interviene en la inicializacion (b, c).',
        'correcta' => 'd'
    ],
    'm4' => [
        'texto'    => '<span class="tag-diap">Diapositiva</span> &iquest;Cual es uno de los desafios del algoritmo K-means?',
        'opciones' => [
            'a' => 'No puede manejar datos numericos.',
            'b' => 'Es sensible a la inicializacion de centroides.',
            'c' => 'No puede manejar conjuntos de datos grandes.',
            'd' => 'Solo funciona con datos de baja dimensionalidad.'
        ],
        'porque'   => 'Al reves de a: solo maneja numericos. Y es escalable (c es falso).',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => '<span class="tag-diap">Diapositiva</span> &iquest;Cual de las siguientes tecnicas se utiliza para mitigar el problema de los minimos locales en el algoritmo K-means?',
        'opciones' => [
            'a' => 'La tecnica de reduccion de dimensionalidad.',
            'b' => 'La tecnica de regularizacion de los centroides.',
            'c' => 'La tecnica de inicializacion multiple.',
            'd' => 'La tecnica de normalizacion de los datos.'
        ],
        'porque'   => 'Es lo que hace <code>n_init=10</code>: correr varias veces con distintos puntos de partida y quedarse con el menor J. IBM y la guia agregan que normalizar es importante, pero no evita los optimos locales.',
        'correcta' => 'c'
    ],
    /* --- contrastes entre fuentes --- */
    'm6' => [
        'texto'    => '<span class="tag-contra">Contraste</span> IBM dice que K-means "generaliza a clusters de diferentes formas y tamanos". La presentacion dice que "no sirve para identificar grupos con formas no convexas". &iquest;A quien creerle?',
        'opciones' => [
            'a' => 'A IBM: K-means separa bien las lunas',
            'b' => 'A la <b>presentacion</b> (y a la guia, que lo comprueba con lunas y circulos): asignar al centroide mas cercano solo produce regiones convexas; la frase de IBM es demasiado optimista',
            'c' => 'A ninguno, depende de K',
            'd' => 'A los dos: con k-means++ separa formas no convexas'
        ],
        'porque'   => 'El propio IBM, en desventajas, dice que funciona mejor con clusters de tamano parecido y sin outliers. Para formas no convexas: enlace single o DBSCAN.',
        'correcta' => 'b'
    ],
    'm7' => [
        'texto'    => '<span class="tag-contra">Contraste</span> La presentacion define <code>J = (1/m)&middot;&Sigma; distancia(x<sub>i</sub> &minus; centroide)&sup2;</code> y la guia define la inercia como la suma sin dividir. &iquest;Cambia el K que se escoge con el codo?',
        'opciones' => [
            'a' => 'Si, salen K distintos',
            'b' => '<b>No</b>: dividir entre m (el numero de datos, fijo) solo cambia la escala del eje vertical, no la forma de la curva ni donde esta el codo',
            'c' => 'Si, porque J siempre es menor',
            'd' => 'No se pueden comparar'
        ],
        'porque'   => 'sklearn devuelve la suma (<code>inertia_</code>). J es el promedio por punto; para comparar valores de K da lo mismo.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('No supervisado 6 — K-means: diapositivas y contraste',
         'K-means_algorithm.pdf (Jose Armando Ordonez) contrastado con la guia, el notebook de Mall e IBM');
?>

<style>
.tag-diap,.tag-contra{display:inline-block;font-size:11px;font-weight:700;text-transform:uppercase;
  letter-spacing:.4px;padding:1px 8px;border-radius:12px;margin-right:6px;vertical-align:1px}
.tag-diap{background:#e8eefa;color:#2c5aa0}
.tag-contra{background:#fff4e0;color:#b5730a}
</style>

<div class="card">
  <h2>De que va esto</h2>
  <p>Solo lo que las diapositivas de K-means agregan a los cuestionarios 1 a 3 (sin repetir), las
     preguntas de su seccion <b>&iexcl;Comprueba tu conocimiento!</b> tal cual, y los puntos donde las
     fuentes no dicen lo mismo.</p>
  <div class="nota">Las preguntas marcadas <span class="tag-diap">Diapositiva</span> son copia textual de la
    presentacion; las marcadas <span class="tag-contra">Contraste</span> comparan fuentes. Respuestas en <b>texto</b>.</div>
</div>


<div class="card">
  <h2>1. Caso real: personalidad de usuarios de Twitter</h2>
  <p>Se filtraron <?php hueco(1, 5); ?> "famosos" (deporte, cantantes, actores&hellip;) y se describen con
     la metodologia "OCEAN: The <?php hueco(2, 10); ?>": op, co, ex, ag, ne.</p>
  <p>Se aplica <code>KMeans(n_clusters=<?php hueco(3, 3); ?>)</code> usando solo <?php hueco(4, 3); ?>
     variables (op, ex, ag) para poder verlo en 3D. Conclusion: los grupos no coinciden necesariamente con
     la actividad laboral.</p>
  <p>K-means entrega dos cosas: los <?php hueco(5, 10); ?> (para etiquetar muestras nuevas) y las
     <?php hueco(6, 9); ?> del conjunto de entrenamiento.</p>
  <?php mc('m1'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Los 8 pasos de la presentacion</h2>
  <ol>
    <li>Determinar <?php hueco(7, 6); ?>: con el codo, la silueta o el indice <?php hueco(8, 16); ?>.</li>
    <li>Escoger K centroides al azar.</li>
    <li>Medir la distancia <?php hueco(9, 10); ?> de cada punto a cada centroide.</li>
    <li>Asignar cada punto al grupo mas cercano.</li>
    <li>Recalcular cada centroide como la <?php hueco(10, 8); ?> del grupo.</li>
    <li>Repetir 3 a 5 hasta que no haya cambios o se llegue al maximo de iteraciones.</li>
    <li>Calcular la <?php hueco(11, 10); ?> de cada conglomerado.</li>
    <li>Repetir los pasos 2 a 7 con distintos <?php hueco(12, 14); ?> y quedarse con la agrupacion de varianza total mas baja.</li>
  </ol>
  <p>Funcion de costo del codo: <code>J = (1/<?php hueco(13, 4); ?>)&middot;&Sigma; distancia(x<sub>i</sub> &minus; centroide(x<sub>i</sub>))&sup2;</code>.
     Se escoge el ultimo k que da una reduccion "significativa".</p>
  <?php mc('m2'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Formas de inicializar</h2>
  <ul>
    <li>De forma <?php hueco(14, 10); ?> tomando puntos en R<sup>n</sup> (n = numero de atributos).</li>
    <li>Muestreando al azar las <?php hueco(15, 13); ?> existentes.</li>
    <li>Con k-means++: el primer centroide al azar; los siguientes al azar con una probabilidad dada por la
        <?php hueco(16, 9); ?> al centroide mas cercano ya escogido; se repite hasta tener K.</li>
  </ul>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. &iquest;Que distancia escoger?</h2>
  <table class="datos">
    <tr><th>Distancia</th><th>Lo que dice la presentacion</th></tr>
    <tr><td><?php hueco(17, 10); ?></td><td>no es invariante a la <?php hueco(20, 7); ?>: puede sesgarse segun las unidades. Apropiada en espacios de <?php hueco(21, 6); ?> dimensionalidad</td></tr>
    <tr><td><?php hueco(18, 10); ?></td><td>basada en bloques rectilineos (suma de diferencias absolutas)</td></tr>
    <tr><td><?php hueco(19, 8); ?></td><td>el coseno del angulo entre las dos instancias; apropiada en <?php hueco(22, 6); ?> dimensionalidad y big data</td></tr>
  </table>
  <p>En el ejemplo grafico, entre A y B: euclidiana &asymp; 3,6, Manhattan = <?php hueco(23, 3); ?> y angulo
     del coseno &asymp; 41,6&deg;.</p>
  <div class="nota"><b>Contraste:</b> IBM y la guia dicen que K-means clasico usa la euclidiana y que cambiar
    la distancia requiere modificar el algoritmo (la media es el centro solo para la euclidiana al cuadrado).
    La guia menciona coseno para agrupar documentos.</div>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Normalizar antes de K-means</h2>
  <table class="datos">
    <tr><th>Metodo</th><th>Formula</th><th>Rango</th></tr>
    <tr><td>Min-max</td><td><code>(x &minus; x<sub><?php hueco(24, 5); ?></sub>) / (x<sub><?php hueco(25, 5); ?></sub> &minus; x<sub>min</sub>)</code></td><td>[0, 1]</td></tr>
    <tr><td>Min-max a [a, b]</td><td><code>a + (x &minus; x<sub>min</sub>)(b &minus; a) / (x<sub>max</sub> &minus; x<sub>min</sub>)</code></td><td>[a, b], escogidos antes</td></tr>
    <tr><td><?php hueco(26, 12); ?></td><td><code>z = (x &minus; &mu;) / &sigma;</code></td><td>media 0, desviacion 1; supone distribucion <?php hueco(27, 7); ?></td></tr>
  </table>
  <div class="nota">En la guia, la segmentacion de imagenes usa <code>MinMaxScaler</code> (la primera fila)
    y el caso wine usa <code>StandardScaler</code> (la ultima).</div>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Ventajas y desventajas segun la presentacion</h2>
  <table class="datos">
    <tr><th>Ventajas</th><th>Desventajas</th></tr>
    <tr><td>simple de implementar e interpretar; complejidad <?php hueco(28, 7); ?> en el numero de puntos y de clusters; escalable</td>
        <td>solo trabaja con atributos <?php hueco(29, 10); ?> (necesita calcular el centroide); sensible a la inicializacion y a los outliers; no sirve para formas no <?php hueco(30, 9); ?></td></tr>
  </table>
  <?php mc('m4'); ?>
  <?php mc('m6'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../PCAPractica/index.php', '../PCADiap/index.php');
