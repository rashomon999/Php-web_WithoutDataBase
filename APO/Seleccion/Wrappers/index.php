<?php
/* ==========================================================================
   APO / Seleccion / Wrappers  —  Forward selection, RFE, LASSO con
        SelectFromModel, importancia de Random Forest y PCA como contraste
   Fuente: Actividad_Feature_Selection.ipynb (Prof. Milton Orlando Sarria Paja)
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. forward */
    1  => ['ninguna', 'ninguna caracteristica', 'cero', 'vacio'],
    2  => ['greedy', 'voraz'],
    3  => ['mlxtend'],
    4  => ['0 y 1', '0, 1', '0,1'],
    5  => ['backward', 'hacia atras', 'backward elimination', 'eliminacion hacia atras'],
    6  => ['False'],

    /* 2. RFE */
    7  => ['coef_'],
    8  => ['feature_importances_'],
    9  => ['menos importantes', 'menos importante'],
    10 => ['orden', 'el orden'],
    11 => ['1', 'uno'],

    /* 3. LASSO */
    12 => ['cero', '0', 'exactamente cero'],
    13 => ['escala', 'escalas', 'magnitud'],
    14 => ['inverso', 'el inverso'],
    15 => ['mas', 'aumenta', 'mas coeficientes', 'sube'],
    16 => ['7', 'siete'],

    /* 4. random forest */
    17 => ['reparte', 'se reparte', 'divide', 'comparte'],
    18 => ['0.43', '0,43', '0.433', '0,433'],
    19 => ['0.28', '0,28', '0.282', '0,282'],

    /* 5. PCA */
    20 => ['varianza'],
    21 => ['Y', 'la clase', 'clase', 'la variable objetivo', 'variable objetivo', 'etiquetas'],
    22 => ['40', '40.19', '40,19', '40%', '40.2', '40,2'],
    23 => ['LDA', 'analisis discriminante lineal', 'linear discriminant analysis'],

    /* 6. codigo */
    24 => ["SequentialFeatureSelector(clf, k_features='best', forward=True, cv=5)",
           "SequentialFeatureSelector(clf, forward=True, k_features='best', cv=5)"],
    25 => ['RFE(clf, n_features_to_select=3)'],
    26 => ["LogisticRegression(C=1, penalty='l1', solver='liblinear')",
           "LogisticRegression(penalty='l1', C=1, solver='liblinear')",
           "LogisticRegression(penalty='l1', solver='liblinear', C=1)"],
    27 => ['SelectFromModel(estimator=clf, prefit=True)', 'SelectFromModel(clf, prefit=True)'],
];
$TEXTO = array_values(array_diff(range(1, 23), [6, 7, 8]));

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La seleccion hacia adelante con una regresion logistica elige solo [0, 1] y nunca agrega, por ejemplo, la columna 7 despues de la 2. &iquest;Por que los wrappers evitan esa redundancia?',
        'opciones' => [
            'a' => 'Porque revisan la matriz de correlacion antes de empezar',
            'b' => 'Porque en cada paso miden cuanto <b>mejora el modelo</b>: una columna casi identica a otra ya elegida no aporta informacion nueva, asi que no sube el desempeno y no se agrega',
            'c' => 'Porque eliminan las columnas pares',
            'd' => 'Porque usan informacion mutua'
        ],
        'porque'   => 'Es la ventaja de los wrappers frente a los filtros univariados: evaluan subconjuntos completos, asi que "ven" interacciones y redundancia. El costo: entrenar muchas veces.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'LASSO dejo en cero 5 coeficientes pero conservo 7 columnas, aunque solo 2 tienen senal. &iquest;Que harias para que descarte mas columnas de ruido?',
        'opciones' => [
            'a' => 'Subir C a 10',
            'b' => '<b>Bajar C</b> (por ejemplo a 0,1): como C es el inverso de la fuerza de regularizacion, un C menor penaliza mas y lleva mas coeficientes exactamente a cero',
            'c' => 'Quitar el StandardScaler',
            'd' => 'Cambiar a penalty=\'l2\''
        ],
        'porque'   => 'Con L2 (Ridge) los coeficientes se encogen pero casi nunca llegan a cero, asi que no seleccionan. Y sin escalar, la penalizacion castigaria segun la unidad de medida, no segun la relevancia.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Al proyectar a 2 componentes principales, las clases quedan mucho peor separadas que usando las columnas 0 y 1. &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque PCA necesita escalar y no se escalo',
            'b' => 'Porque PCA <b>no mira Y</b>: busca las direcciones de mayor varianza total, y las 10 columnas de ruido juntas tienen mas varianza que las 2 de senal',
            'c' => 'Porque 2 componentes nunca son suficientes',
            'd' => 'Porque PCA elimina las columnas 0 y 1'
        ],
        'porque'   => 'Maxima varianza no es lo mismo que maxima separacion entre clases. LDA, que si usa Y, busca justo la direccion que mejor separa las clases.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'En un dataset clinico, <code>mean radius</code>, <code>mean perimeter</code> y <code>mean area</code> aparecen cada una con importancia moderada en un Random Forest. &iquest;Como interpretarlo?',
        'opciones' => [
            'a' => 'Que ninguna de las tres es muy importante',
            'b' => 'Que como estan muy <b>correlacionadas</b>, la importancia MDI se <b>reparte</b> entre ellas: juntas pueden ser lo mas importante del modelo aunque cada una por separado parezca mediana',
            'c' => 'Que hay que eliminar las tres',
            'd' => 'Que el modelo esta mal entrenado'
        ],
        'porque'   => 'Es el experimento del duplicado: la columna 0 pasa de 0,43 a 0,28 al anadir su copia (que se lleva 0,27). La suma se mantiene aproximadamente.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Selección 2 — Wrappers, embebidos y PCA',
         'Actividad_Feature_Selection.ipynb (Prof. Milton Orlando Sarria Paja)');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Los metodos que usan un modelo para decidir: seleccion hacia adelante y RFE (wrappers), LASSO e
     importancia de Random Forest (embebidos), y PCA como contraste.</p>
  <div class="nota">Texto salvo nombres de atributos/valores de Python y la seccion 6 (<b>codigo</b>).</div>
</div>


<div class="card">
  <h2>1. Seleccion hacia adelante (forward)</h2>
  <p>Parte de <?php hueco(1, 8); ?> caracteristica, agrega la que mas mejora el modelo y repite hasta
     un criterio de parada. Es un metodo <?php hueco(2, 7); ?>.</p>
  <p>En la guia se usa <code>SequentialFeatureSelector</code> de la libreria <?php hueco(3, 8); ?>,
     con una regresion logistica y validacion cruzada de 5 folds. Selecciona las columnas
     <?php hueco(4, 6); ?>.</p>
  <p>La version que empieza con todas y va quitando es la <?php hueco(5, 14); ?>, y se activa con
     <code>forward=<?php hueco(6, 6); ?></code>.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Eliminacion recursiva (RFE)</h2>
  <p>Entrena con todas las variables y lee su importancia del atributo <code><?php hueco(7, 7); ?></code>
     (modelos lineales) o <code><?php hueco(8, 20); ?></code> (arboles). Quita las
     <?php hueco(9, 16); ?> y repite sobre el conjunto podado hasta llegar al numero pedido.</p>
  <p>Forward <b>construye</b> el subconjunto; RFE <b>poda</b> el conjunto completo.</p>
  <p><code>rfe.ranking_</code> no es una importancia: es el <?php hueco(10, 6); ?> en que cada variable
     fue eliminada. Las que sobreviven hasta el final tienen ranking <?php hueco(11, 3); ?>
     (y <code>support_</code> = True).</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. LASSO (L1) como metodo embebido</h2>
  <p>A diferencia de Ridge, LASSO puede llevar coeficientes exactamente a <?php hueco(12, 5); ?>,
     eliminando esa variable del modelo.</p>
  <p>Antes hay que estandarizar: L1/L2 penalizan la magnitud de los coeficientes, y sin escalar la
     penalizacion dependeria de la <?php hueco(13, 8); ?> de cada variable y no de su relevancia.
     (Un arbol no lo necesita.)</p>
  <p>En <code>LogisticRegression</code>, <code>C</code> es el <?php hueco(14, 8); ?> de la fuerza de
     regularizacion: si se disminuye C hay <?php hueco(15, 6); ?> coeficientes en cero.</p>
  <p>Con C = 1, LASSO conservo <?php hueco(16, 3); ?> columnas: [0, 1, 2, 5, 6, 7, 11].</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Importancia de Random Forest (MDI)</h2>
  <p>Con variables correlacionadas, la importancia se <?php hueco(17, 8); ?> entre ellas, y cada una
     parece menos relevante de lo que es.</p>
  <table class="datos">
    <tr><th>Experimento</th><th>Columna 0</th><th>Columna 1</th><th>Copia de la 0</th></tr>
    <tr><td>Sin duplicado</td><td><?php hueco(18, 5); ?></td><td>0,57</td><td>&mdash;</td></tr>
    <tr><td>Con duplicado (correlacion 0,999)</td><td><?php hueco(19, 5); ?></td><td>0,45</td><td>0,27</td></tr>
  </table>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. PCA: no es seleccion</h2>
  <p>PCA crea componentes ordenadas para capturar la mayor <?php hueco(20, 9); ?> posible, sin saber
     nada de <?php hueco(21, 9); ?>.</p>
  <p>En el dataset sintetico, las dos primeras componentes explican solo el
     <?php hueco(22, 6); ?>% de la varianza.</p>
  <p>El metodo que tambien reduce dimension pero <b>si</b> usa la clase es el
     <?php hueco(23, 22); ?>.</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Las lineas de codigo</h2>
  <p>Con <code>clf = LogisticRegression(...)</code> ya creado:</p>
  <?php linea(24, 'seleccion hacia adelante con mlxtend que elija el <b>mejor</b> numero de variables, con <b>5</b> folds', 'ffs = ...'); ?>
  <?php linea(25, 'RFE que deje <b>3</b> variables', 'rfe = ...'); ?>
  <?php linea(26, 'una regresion logistica con penalizacion <b>L1</b>, <code>C=1</code> y el solver <code>liblinear</code>', 'clf = ...'); ?>
  <?php linea(27, 'un selector que use el <code>clf</code> <b>ya entrenado</b> para quedarse con las columnas de coeficiente distinto de cero', 'modelo_sfm = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Filtros/index.php', '../Fuga/index.php');
