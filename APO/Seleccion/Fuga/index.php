<?php
/* ==========================================================================
   APO / Seleccion / Fuga  —  Fuga de datos al seleccionar, el experimento
        con ruido puro, el caso diabetes (ceros disfrazados) y por que estas
        tecnicas siguen vigentes
   Fuente: Actividad_Feature_Selection.ipynb (Prof. Milton Orlando Sarria Paja)
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. fuga */
    1  => ['fuga de datos', 'data leakage', 'fuga', 'leakage'],
    2  => ['sobreestimada', 'sobreestimado', 'inflada', 'optimista'],
    3  => ['pipeline'],
    4  => ['entrenamiento', 'train'],

    /* 2. experimento con ruido */
    5  => ['50', '50%'],
    6  => ['88', '88%'],
    7  => ['68', '68%'],
    8  => ['azar', 'casualidad', 'suerte'],
    9  => ['techo', 'efecto techo'],

    /* 3. diabetes */
    10 => ['768'],
    11 => ['ceros', 'cero', '0'],
    12 => ['pregnancies', 'embarazos'],
    13 => ['mediana'],
    14 => ['117'],
    15 => ['125'],

    /* 4. tres metodos */
    16 => ['4', 'cuatro'],
    17 => ['3', 'tres'],
    18 => ['cero', '0'],

    /* 5. vigentes */
    19 => ['tabulares', 'tabular'],
    20 => ['espacial', 'espacial o secuencial'],
    21 => ['boruta'],
    22 => ['sombra', 'shadow', 'shadow features'],

    /* 6. codigo */
    23 => ["Pipeline([('seleccion', SelectKBest(f_classif, k=10)), ('modelo', LogisticRegression(max_iter=500))])",
           "Pipeline(steps=[('seleccion', SelectKBest(f_classif, k=10)), ('modelo', LogisticRegression(max_iter=500))])"],
    24 => ['data_limpia[columnas_con_cero_invalido].replace(0, np.nan)'],
    25 => ['Ridge(alpha=1.0)', 'Ridge(alpha=1)'],
];
$TEXTO = range(1, 22);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'X es ruido puro (1000 columnas, 50 filas). Si se eligen las 10 columnas mas correlacionadas con Y usando <b>todo</b> el dataset y luego se hace validacion cruzada, sale 88%. &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque el ruido tiene algo de senal',
            'b' => 'Porque entre 1000 columnas de ruido, algunas quedan correlacionadas con Y <b>por azar</b>; como la seleccion ya vio las filas que luego seran de prueba, esas columnas "funcionan" en la CV solo porque se escogieron mirandolas',
            'c' => 'Porque la regresion logistica sobreajusta siempre',
            'd' => 'Porque 50 filas son suficientes'
        ],
        'porque'   => 'Metiendo el <code>SelectKBest</code> dentro del <code>Pipeline</code>, en cada fold la seleccion se hace solo con los datos de entrenamiento de ese fold, y la exactitud baja a 68% (lo esperado real es 50%).',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Repites el experimento con el dataset sintetico (con senal real) y casi no hay diferencia entre con y sin pipeline. &iquest;Significa que ahi no hubo fuga?',
        'opciones' => [
            'a' => 'Si: si no se nota, no hay fuga',
            'b' => 'No: la fuga sigue ocurriendo, pero el problema es tan facil (casi 100% de exactitud de cualquier forma) que el <b>efecto techo</b> la oculta. Es mas peligrosa con poca senal, pocas filas y muchas variables candidatas',
            'c' => 'Si, porque el dataset sintetico no tiene ruido',
            'd' => 'No se puede saber'
        ],
        'porque'   => 'La conclusion practica: la seleccion de caracteristicas va siempre dentro del pipeline, igual que el escalado o la imputacion.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => '&iquest;Que pasa si no se corrigen los ceros de Glucose, BloodPressure, SkinThickness, Insulin y BMI antes de seleccionar variables?',
        'opciones' => [
            'a' => 'Nada, los ceros son valores validos',
            'b' => 'Se tratan como mediciones reales, y eso distorsiona las estadisticas y los puntajes de relevancia (y cualquier modelo posterior), sin que pandas ni <code>SelectKBest</code> avisen',
            'c' => 'El codigo da error',
            'd' => 'Solo cambia la columna Pregnancies'
        ],
        'porque'   => 'Nadie vivo tiene glucosa, presion o IMC igual a cero: son faltantes disfrazados. En cambio, 0 embarazos si es un valor posible.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'chi2, RFE y Ridge no eligen exactamente las mismas variables en el caso de diabetes. &iquest;Que conclusion propone la guia?',
        'opciones' => [
            'a' => 'Que hay que quedarse con el metodo que de el ranking mas corto',
            'b' => 'Que conviene <b>comparar varias tecnicas</b> (por ejemplo, una tabla de quien entra en el top de cada una): las variables en que coinciden son las mas confiables, y las discrepancias muestran que cada metodo mide algo distinto',
            'c' => 'Que dos de los tres metodos estan mal implementados',
            'd' => 'Que la seleccion no sirve en datos reales'
        ],
        'porque'   => 'chi2 es un filtro (y pensado para categoricas), RFE es wrapper con un modelo lineal, y Ridge da pesos relativos sin llegar a cero. Cada uno ve el problema desde otro angulo.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Selección 3 — Fuga de datos y caso diabetes',
         'Actividad_Feature_Selection.ipynb (Prof. Milton Orlando Sarria Paja)');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>El error mas facil de cometer al seleccionar variables (hacerlo antes de separar los datos), el
     experimento que lo demuestra, el caso real de diabetes y por que estas tecnicas siguen vigentes.</p>
  <div class="nota">Secciones 1 a 5: <b>texto</b>. Seccion 6: <b>codigo</b>.</div>
</div>


<div class="card">
  <h2>1. Seleccionar antes de separar es fuga de datos</h2>
  <p>Si se escogen las "mejores" variables con el dataset completo y despues se separa en
     entrenamiento y prueba, hay <?php hueco(1, 12); ?>: la exactitud de prueba queda
     <?php hueco(2, 12); ?>, porque la seleccion ya vio los datos de prueba.</p>
  <p>La solucion es meter la seleccion dentro de un <code><?php hueco(3, 9); ?></code>, para que se
     ajuste solo con los datos de <?php hueco(4, 13); ?> de cada particion de la validacion cruzada.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. El experimento con ruido puro</h2>
  <p>50 filas, 1000 columnas de ruido y una Y al azar con 2 clases.</p>
  <table class="datos">
    <tr><th>Caso</th><th>Exactitud</th></tr>
    <tr><td>Lo esperado de verdad (Y es ruido)</td><td><?php hueco(5, 4); ?>%</td></tr>
    <tr><td><code>SelectKBest</code> <b>fuera</b> del pipeline (con fuga)</td><td><?php hueco(6, 4); ?>%</td></tr>
    <tr><td><code>SelectKBest</code> <b>dentro</b> del pipeline</td><td><?php hueco(7, 4); ?>%</td></tr>
  </table>
  <p>La seleccion fuera del pipeline encuentra columnas correlacionadas con Y por puro
     <?php hueco(8, 7); ?>.</p>
  <p>Con el dataset sintetico (que es facil) la diferencia casi no se nota: un efecto
     <?php hueco(9, 7); ?> oculta la fuga.</p>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Caso diabetes (Pima): faltantes disfrazados</h2>
  <p>El dataset tiene <?php hueco(10, 5); ?> observaciones y 8 variables. Los faltantes no aparecen como
     NaN: estan codificados como <?php hueco(11, 6); ?> en columnas donde eso no tiene sentido fisiologico
     (Glucose, BloodPressure, SkinThickness, Insulin, BMI). La columna
     <?php hueco(12, 12); ?> si puede valer 0 legitimamente.</p>
  <p>Se reemplazan por NaN y se imputan con la <?php hueco(13, 8); ?> de cada columna, una opcion
     razonable por la asimetria de las variables clinicas.</p>
  <table class="datos">
    <tr><th>Columna</th><th>Valor imputado</th></tr>
    <tr><td>Glucose</td><td><?php hueco(14, 5); ?></td></tr>
    <tr><td>BloodPressure</td><td>72</td></tr>
    <tr><td>SkinThickness</td><td>29</td></tr>
    <tr><td>Insulin</td><td><?php hueco(15, 5); ?></td></tr>
    <tr><td>BMI</td><td>32,3</td></tr>
  </table>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Tres metodos sobre diabetes</h2>
  <table class="datos">
    <tr><th>Familia</th><th>Metodo en la guia</th></tr>
    <tr><td>Filtro</td><td><code>SelectKBest(chi2, k=<?php hueco(16, 3); ?>)</code></td></tr>
    <tr><td>Wrapper</td><td>RFE con regresion logistica, <code>n_features_to_select=<?php hueco(17, 3); ?></code> (sobre datos estandarizados)</td></tr>
    <tr><td>Embebido</td><td>Ridge: no lleva coeficientes a <?php hueco(18, 5); ?>, pero su magnitud relativa (con variables escaladas) muestra cuales pesan mas</td></tr>
  </table>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Por que siguen vigentes</h2>
  <p>Las redes como las CNN extraen caracteristicas solas cuando los datos tienen estructura
     <?php hueco(20, 10); ?> (bordes y contornos en una imagen, secuencias). En datos
     <?php hueco(19, 10); ?>, como los clinicos, esa estructura no existe, y estas tecnicas siguen siendo lo
     mas efectivo, rapido e interpretable.</p>
  <p>Para ir mas alla: el wrapper <?php hueco(21, 7); ?> compara la importancia de cada variable con la de
     copias aleatorias llamadas variables <?php hueco(22, 7); ?>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Las lineas de codigo</h2>
  <?php linea(23, "un Pipeline con <code>('seleccion', SelectKBest(f_classif, k=10))</code> y <code>('modelo', LogisticRegression(max_iter=500))</code>", 'pipeline_correcto = ...'); ?>
  <?php linea(24, 'cambie por NaN los ceros de las columnas <code>columnas_con_cero_invalido</code> de <code>data_limpia</code>', 'data_limpia[columnas_con_cero_invalido] = ...'); ?>
  <?php linea(25, 'un modelo Ridge con <code>alpha=1.0</code>', 'ridge = ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Wrappers/index.php', '');
