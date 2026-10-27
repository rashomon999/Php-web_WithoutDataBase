<?php
/* ==========================================================================
   APO / NoSupervisado / PCAPractica  —  Estandarizar, covarianza vs
        correlacion, compresion de imagenes, visualizacion, pipeline con
        K-means, ventajas, limitaciones y alternativas
   Fuentes: 02_actividad_PCA.ipynb (secciones 2.1, 6 a 8) ·
            01_Aprendizaje_NoSupervisado.ipynb · IBM "What is PCA?"
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. estandarizar */
    1  => ['unidades', 'escala', 'escalas', 'unidades de medida'],
    2  => ['proline'],
    3  => ['correlacion', 'matriz de correlacion'],
    4  => ['0'],
    5  => ['1'],
    6  => ['misma', 'la misma unidad', 'misma escala', 'misma unidad'],

    /* 2. imagenes */
    7  => ['64'],
    8  => ['8x8', '8 x 8', '8×8'],
    9  => ['eigenfaces'],
    10 => ['1991'],
    11 => ['varianza'],

    /* 3. visualizacion */
    12 => ['13'],
    13 => ['etiquetas', 'cultivares', 'clases', 'la clase'],
    14 => ['t-sne', 'tsne', 't sne'],
    15 => ['umap'],
    16 => ['kernel pca'],

    /* 4. mall + pipeline */
    17 => ['labelencoder', 'label encoder'],
    18 => ['4', 'cuatro'],
    19 => ['33', '33.1', '33,1', '33%'],
    20 => ['2', 'dos'],

    /* 5. pros, contras, comparaciones */
    21 => ['multicolinealidad'],
    22 => ['lineal'],
    23 => ['interpretabilidad', 'interpretacion'],
    24 => ['lda', 'analisis discriminante lineal'],
    25 => ['latentes', 'latente', 'factores latentes'],

    /* 6. codigo */
    26 => ['PCA(n_components=2).fit(X_wine)'],
    27 => ['pca.explained_variance_ratio_'],
    28 => ['make_pipeline(scaler, pca2, kmeans)'],
];
$TEXTO = range(1, 25);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'PCA sobre <code>load_wine</code> <b>sin</b> estandarizar: PC1 explica casi toda la varianza y su mayor carga es <code>proline</code>. &iquest;Como se interpreta?',
        'opciones' => [
            'a' => 'Que proline es la unica variable quimica importante',
            'b' => 'Que es un <b>artefacto de escala</b>: proline va de 278 a 1680 y hue de 0,48 a 1,71; PCA busca varianza, y la variable con numeros mas grandes la acapara aunque no signifique nada',
            'c' => 'Que hay que quitar proline',
            'd' => 'Que PCA funciona mejor sin estandarizar'
        ],
        'porque'   => 'Al estandarizar, PC1 pasa a depender de varias variables a la vez, con mas sentido quimico. Estandarizar equivale a hacer PCA sobre la matriz de <b>correlacion</b>.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => '&iquest;Por que en la compresion de <code>load_digits</code> <b>no</b> se estandariza?',
        'opciones' => [
            'a' => 'Porque se olvido',
            'b' => 'Porque todos los pixeles ya comparten la <b>misma unidad</b> (intensidad 0 a 16): sus diferencias de varianza son informacion real del contraste de la imagen, no un artefacto',
            'c' => 'Porque las imagenes no tienen varianza',
            'd' => 'Porque PCA no acepta datos escalados'
        ],
        'porque'   => 'La regla practica: estandarizar cuando las variables estan en unidades o escalas distintas; no hace falta (y puede estorbar) cuando todas comparten escala.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'PCA del wine estandarizado a 2D separa bastante bien los 3 cultivares sin haber visto las etiquetas. &iquest;Esto esta garantizado en cualquier dataset?',
        'opciones' => [
            'a' => 'Si, PCA siempre separa las clases',
            'b' => '<b>No</b>: PCA busca maxima varianza, no maxima separacion. Si la mayor fuente de varianza fuera, por ejemplo, ruido del instrumento, las direcciones de PCA no tendrian que ver con las clases',
            'c' => 'Si, porque se estandarizo',
            'd' => 'No, porque PCA usa las etiquetas'
        ],
        'porque'   => 'Ya lo viste en la guia de seleccion de caracteristicas: con 10 columnas de ruido, PCA a 2D separaba peor que las 2 columnas con senal. LDA si usa las etiquetas.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'En el notebook de Mall, &iquest;que hace <code>make_pipeline(scaler, pca2, kmeans)</code>?',
        'opciones' => [
            'a' => 'Entrena tres modelos independientes y vota',
            'b' => 'Encadena <b>estandarizar &rarr; reducir a 2 componentes &rarr; agrupar con K-means (K = 5)</b>, de modo que <code>predict</code> sobre clientes nuevos (el test) aplica los mismos pasos con lo aprendido en entrenamiento',
            'c' => 'Busca automaticamente el mejor K',
            'd' => 'Convierte K-means en un clasificador supervisado'
        ],
        'porque'   => 'Asi el test se transforma con la media, desviacion y componentes del train, sin fuga de informacion. IBM menciona justamente PCA + K-means para motores de recomendacion.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('No supervisado 5 — PCA en la práctica',
         '02_actividad_PCA.ipynb (secciones 6 a 8) · 01_Aprendizaje_NoSupervisado.ipynb · IBM PCA');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>PCA aplicado: cuando estandarizar, comprimir imagenes, visualizar datos de muchas dimensiones,
     combinarlo con K-means en un pipeline, y sus ventajas, limites y alternativas.</p>
  <div class="nota">Secciones 1 a 5: <b>texto</b>. Seccion 6: <b>codigo</b>.</div>
</div>


<div class="card">
  <h2>1. Estandarizar o no</h2>
  <p>La varianza de una variable depende de sus <?php hueco(1, 10); ?> (en milimetros es ~1&nbsp;000&nbsp;000
     veces la de metros). Sin corregirlo, PCA queda dominado por la variable de numeros mas grandes; en wine,
     <code><?php hueco(2, 8); ?></code>.</p>
  <p>Estandarizar (media <?php hueco(4, 3); ?>, varianza <?php hueco(5, 3); ?>) equivale a hacer PCA sobre la
     matriz de <?php hueco(3, 12); ?> en vez de la de covarianza.</p>
  <p>No hace falta cuando todas las variables tienen la <?php hueco(6, 10); ?> unidad, como los pixeles.</p>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Compresion de imagenes</h2>
  <p>Cada imagen de <code>load_digits</code> mide <?php hueco(8, 5); ?> pixeles, o sea
     <?php hueco(7, 4); ?> variables. Con pocos componentes se reconstruye un digito legible: se conserva
     lo que mas aporta a la <?php hueco(11, 9); ?> (trazos gruesos) y se tira el detalle fino.</p>
  <p>Aplicado a rostros, la tecnica se llama <?php hueco(9, 10); ?> (Turk y Pentland,
     <?php hueco(10, 5); ?>), uno de los primeros metodos practicos de reconocimiento facial.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Visualizar datos de muchas dimensiones</h2>
  <p>Wine tiene <?php hueco(12, 4); ?> variables. Proyectado a 2 componentes (estandarizado) se pueden
     colorear los puntos por cultivar, aunque PCA no uso las <?php hueco(13, 10); ?> para calcularlos.</p>
  <p>Alternativas <b>no lineales</b>, pensadas para visualizar preservando vecindarios:
     <?php hueco(14, 6); ?> y <?php hueco(15, 5); ?>. La extension no lineal del propio PCA (util para
     lunas o circulos) es <?php hueco(16, 10); ?>.</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. PCA + K-means: Mall Customers</h2>
  <ol>
    <li>Se convierte <code>Genre</code> a numero con <?php hueco(17, 12); ?>.</li>
    <li>Se estandarizan las <?php hueco(18, 3); ?> variables (Genre, Age, Annual Income, Spending Score).</li>
    <li>PCA completo: PC1 explica solo el <?php hueco(19, 4); ?>% (luego 26,7%, 23% y 17,2%), asi que la
        varianza esta bastante repartida.</li>
    <li>Se queda con <?php hueco(20, 3); ?> componentes, codo de inercia y K-means con 5 clusters.</li>
  </ol>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Ventajas, limites y comparaciones (IBM)</h2>
  <table class="datos">
    <tr><th>Ventajas</th><th>Limites</th></tr>
    <tr><td>reduce la complejidad (maldicion de la dimensionalidad); minimiza la <?php hueco(21, 16); ?> y el sobreajuste; facilita visualizar; eficiente con matrices</td>
        <td>es una tecnica <?php hueco(22, 7); ?>; hay que normalizar antes; se pierde <?php hueco(23, 16); ?> al combinar variables</td></tr>
  </table>
  <table class="datos">
    <tr><th>Frente a&hellip;</th><th>Diferencia</th></tr>
    <tr><td><?php hueco(24, 6); ?></td><td>tambien reduce dimension, pero es supervisado: usa las clases</td></tr>
    <tr><td>analisis factorial</td><td>busca factores <?php hueco(25, 9); ?> no medidos que expliquen la estructura</td></tr>
    <tr><td>K-means</td><td>no reduce variables: agrupa puntos por distancia a centros</td></tr>
  </table>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Las lineas de codigo</h2>
  <?php linea(26, 'un PCA de <b>2</b> componentes ajustado sobre <code>X_wine</code> (sin escalar), en una sola linea', 'pca_sin_escalar = ...'); ?>
  <?php linea(27, 'la proporcion de varianza explicada por cada componente del PCA <code>pca</code>'); ?>
  <?php linea(28, 'un pipeline con <code>scaler</code>, <code>pca2</code> y <code>kmeans</code>, en ese orden, usando la funcion corta de sklearn', 'pipeline = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../PCA/index.php', '../KMeansDiap/index.php');
