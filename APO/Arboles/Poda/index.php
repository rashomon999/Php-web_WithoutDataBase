<?php
/* ==========================================================================
   APO / Arboles / Poda  —  Sobreajuste, pre-poda y post-poda,
                            hiperparametros y codigo de sklearn
   Fuentes: 02_AprendSup-Ensambles.pptx (Prunning) · 00_Arboles ... CART.pptx ·
            01_Arboles_Churn-STUD.ipynb · 03_Practica_Decision_Trees.ipynb ·
            02_DSML book - Ch8 (Trees).ipynb · Interactive_Decision_Tree.ipynb
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. por que podar */
    1  => ['100', '100%'],
    2  => ['hoja', 'una hoja'],
    3  => ['simplicidad', 'sencillez'],

    /* 2. pre y post */
    4  => ['pre-pruning', 'prepruning', 'pre pruning', 'prepoda', 'pre-poda', 'pre poda'],
    5  => ['post-pruning', 'postpruning', 'post pruning', 'postpoda', 'post-poda', 'post poda'],
    6  => ['validacion cruzada', 'cross validation', 'cv', 'cross-validation'],
    7  => ['miope', 'peligroso', 'peligrosa'],

    /* 3. hiperparametros: mas grande -> ? */
    8  => ['complejo', 'mas complejo'],
    9  => ['sencillo', 'mas sencillo', 'simple', 'mas simple'],
    10 => ['sencillo', 'mas sencillo', 'simple', 'mas simple'],
    11 => ['sencillo', 'mas sencillo', 'simple', 'mas simple'],
    12 => ['gini'],
    13 => ['entropy'],

    /* 4. diabetes */
    14 => ['69', '68.8', '68,8', '69%', '68.83', '68,83'],
    15 => ['77', '77%', '77.05', '77,05'],

    /* 5. codigo */
    16 => ['from sklearn.tree import DecisionTreeClassifier'],
    17 => ["DecisionTreeClassifier(criterion='entropy', max_depth=3)",
           "DecisionTreeClassifier(max_depth=3, criterion='entropy')",
           "tree.DecisionTreeClassifier(criterion='entropy', max_depth=3)"],
    18 => ['clf.feature_importances_'],
    19 => ['DecisionTreeRegressor(max_depth=10)', 'DecisionTreeRegressor(max_depth=10, random_state=0)',
           'tree.DecisionTreeRegressor(max_depth=10)'],
    20 => ['pd.get_dummies(data[var_indep_cat])',
           'pd.get_dummies(data[var_indep_cat], prefix=var_indep_cat)'],
];
$TEXTO = range(1, 15);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Se grafica el error de validacion cruzada contra la profundidad del arbol (1 a 30), como en el notebook del libro. &iquest;Que forma tipica tiene la curva?',
        'opciones' => [
            'a' => 'Baja siempre: mas profundidad, menos error',
            'b' => 'Sube siempre: cualquier profundidad mayor que 1 empeora',
            'c' => '<b>Baja y luego sube</b>: con poca profundidad hay subajuste, con mucha sobreajuste; el minimo indica la profundidad a escoger',
            'd' => 'Es plana: la profundidad no influye'
        ],
        'porque'   => 'Es el mismo dibujo que el notebook interactivo hace con <code>max_leaf_nodes</code>: el MSE de entrenamiento siempre baja, pero el de prueba tiene un minimo.',
        'correcta' => 'c'
    ],
    'm2' => [
        'texto'    => 'En el taller de churn, el arbol sin restricciones logra 61,68% de exactitud en prueba con un baseline de 50,74%. &iquest;Que es el <b>baseline</b>?',
        'opciones' => [
            'a' => 'La exactitud en entrenamiento',
            'b' => 'La exactitud de predecir siempre la <b>clase mayoritaria</b>; cualquier modelo tiene que superarla para servir de algo',
            'c' => 'La exactitud de un KNN con k=1',
            'd' => 'El 50% fijo de cualquier problema binario'
        ],
        'porque'   => 'Por eso la Parte 1 del notebook pide calcular el baseline antes de nada: es <code>value_counts()</code> de la clase mayoritaria dividido entre el total.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Segun la practica de diabetes, &iquest;como se optimiza el arbol en scikit-learn?',
        'opciones' => [
            'a' => 'Solo con post-poda automatica',
            'b' => 'Solo mediante <b>pre-poda</b> (por ejemplo limitando <code>max_depth</code>)',
            'c' => 'Cambiando a regresion logistica',
            'd' => 'No se puede optimizar'
        ],
        'porque'   => 'La practica lo dice textual: "la optimizacion del clasificador de arbol de decision se realiza solo mediante prepruning". (Las diapositivas tambien muestran la poda por costo-complejidad, que es post-poda.)',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => '&iquest;Por que en el taller de churn hay que aplicar <code>pd.get_dummies</code> antes de entrenar el arbol, si los arboles "aceptan" variables categoricas?',
        'opciones' => [
            'a' => 'Porque los arboles no aceptan categoricas en ningun caso',
            'b' => 'Porque la implementacion de <b>scikit-learn</b> solo admite variables independientes <b>numericas</b>; hay que codificarlas (one-hot)',
            'c' => 'Para normalizar las variables',
            'd' => 'Para eliminar los valores faltantes'
        ],
        'porque'   => 'Es la "nota editorial" del notebook. En teoria el algoritmo trabaja con categoricas; la libreria no. Tras el one-hot quedaron 24 variables independientes.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Árboles 3 — Poda y sklearn',
         '02_AprendSup-Ensambles.pptx · 01_Arboles_Churn-STUD.ipynb · 03_Practica_Decision_Trees.ipynb');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>El problema grande de los arboles (el sobreajuste), como se ataca con la poda, que hace
     cada hiperparametro de <code>DecisionTreeClassifier</code> y las lineas de codigo de los notebooks.</p>
  <div class="nota">Secciones 1 a 4: <b>texto</b>. Seccion 5: <b>codigo</b>, ahi importan las mayusculas.</div>
</div>


<div class="card">
  <h2>1. Por que hay que podar</h2>
  <p>Si no se pone limite, un arbol puede llegar a <?php hueco(1, 5); ?>% de exactitud en
     entrenamiento. En el peor caso se crea una <?php hueco(2, 6); ?> por cada observacion,
     y al predecir datos nuevos falla.</p>
  <p>Hay que buscar un compromiso entre el poder de clasificacion y la
     <?php hueco(3, 11); ?> del arbol.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Las dos formas de podar</h2>
  <table class="datos">
    <tr><th>Tipo</th><th>Cuando</th></tr>
    <tr><td><?php hueco(4, 13); ?></td><td>se detiene el crecimiento <b>antes</b>, mientras el arbol crece (criterios de parada temprana)</td></tr>
    <tr><td><?php hueco(5, 13); ?></td><td>se deja crecer el arbol completo y <b>despues</b> se cortan las ramas poco importantes</td></tr>
  </table>
  <p>Valores como la profundidad maxima o el minimo de instancias para partir un nodo no se
     adivinan: se escogen con <?php hueco(6, 18); ?>.</p>
  <p>Parar solo porque el criterio de particion no mejora lo suficiente es
     <?php hueco(7, 9); ?>: un corte que hoy no ayuda puede habilitar uno muy bueno despues
     (el contraejemplo del XOR).</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Los hiperparametros de <code>DecisionTreeClassifier</code></h2>
  <table class="datos">
    <tr><th>Si este valor es mas grande&hellip;</th><th>el arbol queda mas&hellip;</th></tr>
    <tr><td><code>max_depth</code></td><td><?php hueco(8, 10); ?></td></tr>
    <tr><td><code>min_samples_split</code> (registros necesarios para partir un nodo)</td><td><?php hueco(9, 10); ?></td></tr>
    <tr><td><code>min_samples_leaf</code> (registros minimos en una hoja)</td><td><?php hueco(10, 10); ?></td></tr>
    <tr><td><code>min_impurity_decrease</code> (reduccion minima de impureza para crear una rama)</td><td><?php hueco(11, 10); ?></td></tr>
  </table>
  <p><code>criterion</code> acepta <code>'<?php hueco(12, 6); ?>'</code> (por defecto) o
     <code>'<?php hueco(13, 8); ?>'</code>. Tambien estan <code>max_leaf_nodes</code> y
     <code>class_weight</code> (pesos para clases de distinta importancia).</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. El caso de diabetes (Pima)</h2>
  <table class="datos">
    <tr><th>Modelo</th><th>Accuracy en prueba</th></tr>
    <tr><td><code>DecisionTreeClassifier()</code> sin limites</td><td>&asymp; <?php hueco(14, 5); ?>%</td></tr>
    <tr><td>con <code>criterion="entropy", max_depth=3</code></td><td>&asymp; <?php hueco(15, 5); ?>%</td></tr>
  </table>
  <p>Ademas de mejorar, el arbol podado se puede leer; el original "es inexplicable".</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Las lineas de codigo</h2>
  <?php linea(16, 'importe el clasificador de arbol de decision'); ?>
  <?php linea(17, 'cree un arbol con criterio de <b>entropia</b> y profundidad maxima <b>3</b>', 'clf = ...'); ?>
  <?php linea(18, 'obtenga la importancia de cada variable del arbol ya entrenado <code>clf</code>'); ?>
  <?php ayuda('Termina en guion bajo, como todo lo que el modelo aprende al hacer fit.'); ?>
  <?php linea(19, 'cree un arbol de <b>regresion</b> con profundidad maxima 10', 'regTree = ...'); ?>
  <?php linea(20, 'haga one-hot de las columnas categoricas <code>var_indep_cat</code> del DataFrame <code>data</code>', 'data_cat_one_hot = ...'); ?>
  <?php mc('m4'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Criterios/index.php', '../Validacion/index.php');
