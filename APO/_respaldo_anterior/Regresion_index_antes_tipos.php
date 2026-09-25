<?php
/* ==========================================================================
   APO / Regresion  —  Regresion lineal simple, multivariada, polinomial y metricas
   Fuente: Regresion_ma.pdf  (Unidad 1: Regresion Lineal)
   Huecos 1-35 de TEXTO (castellano); 36-40 de CODIGO (nombres de pandas/sklearn).
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [

    /* --- 1. que es la regresion --- */
    1  => ["Continuos", "Continuo", "Numericos continuos"],
    2  => ["Objetivo", "Target", "Variable objetivo"],
    3  => ["Predictores", "Variables independientes", "Independientes"],
    4  => ["Linea base", "Baseline", "Linea de base"],
    5  => ["Promedio", "Media", "Medida de tendencia central"],

    /* --- 2. la recta y el residuo --- */
    6  => ["Intercepto"],
    7  => ["Pendiente"],
    8  => ["Error aleatorio", "Error"],
    9  => ["Dependiente", "Variable dependiente", "Respuesta"],
    10 => ["Independiente", "Variable independiente", "Explicatoria", "Explicativa"],
    11 => ["Residuo"],
    12 => ["Valor predicho", "Prediccion", "Valor estimado", "Predicho"],

    /* --- 3. funcion de costo --- */
    13 => ["Al cuadrado", "Cuadrado", "Elevar al cuadrado"],
    14 => ["OLS", "Minimos cuadrados ordinarios", "Ordinary least squares"],
    15 => ["Funcion de costo", "Costo"],

    /* --- 4. estimacion de parametros --- */
    16 => ["Descenso de gradiente", "Gradient descent", "Gradiente"],
    17 => ["LMS"],

    /* --- 5. particion --- */
    18 => ["80", "80%"],
    19 => ["20", "20%"],

    /* --- 6. seleccion de variables en la regresion multiple --- */
    20 => ["Completo"],
    21 => ["Tamano fijo", "Tamaño fijo"],
    22 => ["Paso a paso", "Stepwise"],
    23 => ["Hacia adelante", "Forward", "Adelante"],
    24 => ["Hacia atras", "Backward", "Atras"],
    25 => ["PCA", "Analisis de componentes principales"],

    /* --- 7. polinomial --- */
    26 => ["Polinomial", "Regresion polinomial"],

    /* --- 8. metricas --- */
    27 => ["MSE", "Error cuadratico medio"],
    28 => ["RMSE", "Raiz del error cuadratico medio"],
    29 => ["R2", "R^2", "Coeficiente de determinacion"],

    /* --- 9. underfitting y overfitting --- */
    30 => ["Underfitting", "Subentrenamiento", "Sub entrenamiento"],
    31 => ["Overfitting", "Sobreentrenamiento", "Sobre entrenamiento"],

    /* --- 10. variables categoricas: los cuatro metodos --- */
    32 => ["Reemplazar valores", "Reemplazo de valores", "Reemplazar"],
    33 => ["Codificacion binaria", "Binary encoding", "Binaria"],
    34 => ["Codificar etiquetas", "Label encoding", "Codificacion de etiquetas"],
    35 => ["One-hot encoding", "One hot encoding", "Codificacion 1 de n", "One-hot"],

    /* --- CODIGO (aqui si importan las mayusculas) --- */
    36 => ["replace", ".replace()", "replace()"],
    37 => ["get_dummies()", "get_dummies", "pd.get_dummies()"],
    38 => ["LabelEncoder"],
    39 => ["BinaryEncoder"],
    40 => ["category_encoders"],
];

$MULTIPLE = [

    'r1' => [
        'texto'    => '&iquest;Cual es el objetivo de un modelo de regresion?',
        'opciones' => [
            'a' => 'Asignar una etiqueta a cada observacion',
            'b' => 'Agrupar los datos por afinidad, sin etiquetas',
            'c' => 'Ajustar un modelo para <b>predecir valores continuos</b> de la variable objetivo respecto a una o varias variables independientes',
            'd' => 'Reducir la dimensionalidad del conjunto de datos'
        ],
        'correcta' => 'c',
        'porque'   => 'Los metodos que lista el PDF: regresion lineal (simple y multiple), polinomial, KNN y arboles de regresion. La opcion A es clasificacion, la B clustering y la D es lo que hace PCA.'
    ],

    'r2' => [
        'texto'    => 'La regresion construye una linea o curva a traves de los puntos. &iquest;Que criterio se usa para decidir cual es la mejor?',
        'opciones' => [
            'a' => 'Que la <b>distancia vertical</b> entre los puntos de datos y la curva sea <b>minima</b>',
            'b' => 'Que la curva pase exactamente por todos los puntos',
            'c' => 'Que la curva sea lo mas corta posible',
            'd' => 'Que la pendiente sea siempre positiva'
        ],
        'correcta' => 'a',
        'porque'   => 'Esa distancia vertical entre el dato y la curva es justo el <b>residuo</b>. La opcion B suena bien pero es la receta del overfitting: un modelo que pasa por todos los puntos se aprendio el ruido.'
    ],

    'r3' => [
        'texto'    => '&iquest;Por que la funcion de costo <b>eleva al cuadrado</b> los errores en vez de sumarlos directamente?',
        'opciones' => [
            'a' => 'Para que el calculo sea mas rapido',
            'b' => 'Porque en la suma directa los errores <b>positivos y negativos se cancelan</b> entre si, y un modelo malo podria dar una suma cercana a cero',
            'c' => 'Porque asi el resultado siempre es un numero entero',
            'd' => 'Es indiferente: dan el mismo resultado'
        ],
        'correcta' => 'b',
        'porque'   => 'Al elevar al cuadrado todos los errores pasan a ser positivos, asi que ya no se compensan, y ademas se penaliza mas fuerte a los errores grandes. Esa suma de cuadrados es lo que minimiza <b>OLS</b>.'
    ],

    'r4' => [
        'texto'    => 'En el ejemplo de las 200 tiendas, los coeficientes dicen: TV 4,6 &middot; radio 18,6 &middot; prensa 0,08. &iquest;Como se lee el de radio?',
        'opciones' => [
            'a' => 'Que la radio genera 18,6 % de las ventas totales',
            'b' => 'Que se deben invertir 18,6 € en radio',
            'c' => 'Que por <b>cada euro invertido en radio</b>, las ventas suben <b>18,6 €</b>',
            'd' => 'Que la radio explica el 18,6 % de la varianza'
        ],
        'correcta' => 'c',
        'porque'   => 'Un coeficiente de regresion es «cuanto cambia la <em>y</em> cuando esa <em>x</em> sube una unidad, manteniendo el resto igual». Por eso la conclusion practica del ejemplo es que la prensa (0,08) casi no aporta.'
    ],

    'r5' => [
        'texto'    => 'La metodologia de entrenamiento del PDF parte la base en dos. &iquest;Para que sirve el conjunto de <b>test</b>?',
        'opciones' => [
            'a' => 'Para ajustar los coeficientes del modelo',
            'b' => 'Para <b>medir el modelo con datos que no vio</b> durante el entrenamiento',
            'c' => 'Para eliminar los valores atipicos',
            'd' => 'Para escoger las variables categoricas'
        ],
        'correcta' => 'b',
        'porque'   => 'El reparto tipico es <b>80 % train / 20 % test</b>. Si midieras el modelo con los mismos datos con los que lo entrenaste, nunca detectarias el overfitting.'
    ],

    'r6' => [
        'texto'    => '&iquest;Que mide el <b>R&sup2;</b> (coeficiente de determinacion) y en que se diferencia del MSE y el RMSE?',
        'opciones' => [
            'a' => 'Los tres miden lo mismo con distinta escala',
            'b' => 'El R&sup2; indica <b>que proporcion de la variabilidad</b> de la variable objetivo explica el modelo, mientras que MSE y RMSE miden el <b>tamano del error</b> en unidades de la variable',
            'c' => 'El R&sup2; mide el tiempo de entrenamiento',
            'd' => 'El R&sup2; solo sirve para clasificacion'
        ],
        'correcta' => 'b',
        'porque'   => 'Practico: el <b>RMSE</b> se lee en las mismas unidades que la <em>y</em> (euros, grados&hellip;), porque es la raiz del MSE; el <b>R&sup2;</b> no tiene unidades y por eso permite comparar modelos de problemas distintos.'
    ],

    'r7' => [
        'texto'    => 'En la seleccion de variables <b>paso a paso (stepwise)</b>, &iquest;que diferencia hay entre <em>forward</em> y <em>backward</em>?',
        'opciones' => [
            'a' => 'Forward evalua todas las combinaciones posibles; backward solo las de tamano fijo',
            'b' => '<b>Forward</b> va anadiendo variables una a una; <b>backward</b> parte de todas y las va quitando',
            'c' => 'Forward es para regresion y backward para clasificacion',
            'd' => 'No hay diferencia, son sinonimos'
        ],
        'correcta' => 'b',
        'porque'   => 'Las otras estrategias del PDF: <b>completo</b> (se evaluan todas las combinaciones posibles y se escoge la mejor), <b>tamano fijo</b> (todas las combinaciones de K variables) y <b>PCA</b> (transformar los datos a un espacio de menor dimension).'
    ],

    'r8' => [
        'texto'    => '&iquest;Cual es la ventaja del <b>one-hot encoding</b> frente al <em>label encoding</em>?',
        'opciones' => [
            'a' => 'Que genera menos columnas',
            'b' => 'Que es mas rapido de calcular',
            'c' => 'Que <b>no pondera un valor de forma incorrecta</b>: al crear una columna 0/1 por categoria, no se sugiere que una categoria «valga mas» que otra',
            'd' => 'Que funciona con variables numericas'
        ],
        'correcta' => 'c',
        'porque'   => 'El <em>label encoding</em> convierte cada categoria en un numero entre 0 y (n&minus;1), y el modelo puede interpretar que 3 &gt; 1 aunque sean solo etiquetas. La <b>codificacion binaria</b> es el termino medio: usa menos dimensiones que one-hot.'
    ],

    'r9' => [
        'texto'    => 'La grafica muestra una relacion claramente <b>no lineal</b> entre la variable dependiente y la independiente, y aun asi se ajusta una recta. &iquest;Que pasa?',
        'opciones' => [
            'a' => 'La recta no pasa por los puntos de manera significativa, asi que los coeficientes no se pueden interpretar y habra errores en la prediccion',
            'b' => 'No pasa nada: la regresion lineal funciona igual',
            'c' => 'El modelo se convierte automaticamente en polinomial',
            'd' => 'El R&sup2; sera 1'
        ],
        'correcta' => 'a',
        'porque'   => 'Es el caso que justifica la <b>regresion polinomial</b>: cuando la relacion tiene curva, se anaden terminos de grado superior para que el modelo pueda seguirla. La grafica de residuos es lo que delata el problema.'
    ],

    'r10' => [
        'texto'    => '&iquest;Que es un <b>modelo de linea base</b> (baseline) y para que se usa?',
        'opciones' => [
            'a' => 'El modelo con mejor R&sup2; de todos los probados',
            'b' => 'Un modelo tonto que predice siempre una <b>medida de tendencia central</b> (por ejemplo el promedio), y que sirve de <b>referencia minima</b> para juzgar si tu modelo aporta algo',
            'c' => 'La primera version del modelo, antes de limpiar los datos',
            'd' => 'El modelo entrenado con el 100 % de los datos'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la pregunta honesta que hay que hacerse siempre: &iquest;mi modelo lo hace mejor que <em>predecir el promedio y ya</em>? Si no, todo el trabajo de modelado no ha aportado nada.'
    ],
];

/* solo 1-35 son texto libre; 36-40 son nombres de codigo y ahi si cuentan las mayusculas */
iniciar($SOLUCIONES, $MULTIPLE, range(1, 35));
cabecera('Regresion lineal simple, multivariada, polinomial y metricas', 'Regresion_ma.pdf — Unidad 1');
?>

<div class="card">
  <h2>Antes de empezar</h2>
  <p>Este cuestionario cubre la unidad entera de regresion: el acercamiento intuitivo, la
     descripcion matematica, la estimacion de parametros, las metricas y las consideraciones
     finales.</p>
  <div class="nota">
    <b>Ojo, aqui hay dos tipos de hueco.</b> Los de <b>concepto</b> son en castellano y
    perdonan tilde, mayuscula y guion. Los del ultimo bloque son <b>nombres de codigo</b>
    (<code>get_dummies()</code>, <code>LabelEncoder</code>&hellip;) y ahi las mayusculas si
    cuentan: si fallas solo una, sale el aviso naranja
    <span class="mk casi">&#9888;</span> con la forma correcta.
    Pulsa <b>Enter</b> dentro de un hueco para verificar.
  </div>
</div>


<div class="card">
  <h2>1. Que es la regresion</h2>

  <p><b>Objetivo:</b> ajustar modelos para predecir valores
     <?php hueco(1, 16); ?> de la variable
     <?php hueco(2, 16); ?> respecto a una o varias variables
     independientes, tambien llamadas <?php hueco(3, 18); ?> .</p>

  <p><b>Metodos:</b> regresion lineal (simple y multiple), regresion
     <?php hueco(26, 16); ?> , KNN y arboles de regresion.</p>

  <p>La <?php hueco(4, 16); ?> es la evaluacion que da un modelo que
     simplemente predice una medida de tendencia central, por ejemplo el
     <?php hueco(5, 16); ?> . Si tu modelo no la supera, no ha aportado nada.</p>

  <?php mc('r1'); ?>
  <?php mc('r2'); ?>
  <?php mc('r10'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. La recta y el residuo</h2>

  <p>En la regresion lineal simple <code>y = &beta;&#8320; + &beta;&#8321;x + &epsilon;</code>,
     cada pieza tiene su nombre:</p>

  <table class="datos">
    <tr><th>Pieza</th><th>Como se llama</th></tr>
    <tr><td><code>&beta;&#8320;</code></td><td><?php hueco(6, 18); ?></td></tr>
    <tr><td><code>&beta;&#8321;</code></td><td><?php hueco(7, 18); ?></td></tr>
    <tr><td><code>&epsilon;</code></td><td><?php hueco(8, 18); ?></td></tr>
    <tr><td><code>y</code></td><td>Variable <?php hueco(9, 18); ?> (respuesta)</td></tr>
    <tr><td><code>x</code></td><td>Variable <?php hueco(10, 18); ?> (explicatoria)</td></tr>
  </table>

  <h3>El residuo</h3>
  <p>El <?php hueco(11, 14); ?> es la distancia entre los datos y la curva
     construida, e indica si el modelo ha capturado la relacion entre los predictores y la
     variable objetivo:</p>

  <div class="nota" style="background:#f7f8fa;border-left-color:#9aa3ad">
    <b>e</b> = valor observado de salida &minus; <?php hueco(12, 20); ?>
  </div>

  <p>Los modelos de regresion buscan <b>minimizar</b> ese valor para el conjunto de
     predictores de entrenamiento. La <b>grafica de residuos</b> ayuda a identificar si el
     modelo ha capturado de verdad la relacion.</p>

  <?php mc('r9'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. La funcion de costo y OLS</h2>

  <p>La <?php hueco(15, 20); ?> es lo que el modelo intenta minimizar.</p>

  <p>No se puede usar la suma directa de los errores, asi que primero hay que elevarlos
     <?php hueco(13, 16); ?> . Esa suma de errores cuadraticos es la funcion
     de costo <?php hueco(14, 14); ?> , que en notacion matricial se escribe
     extendiendo la matriz de caracteristicas <b>X</b> y el vector de parametros
     <b>&theta;</b>.</p>

  <?php mc('r3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Estimacion de parametros</h2>

  <p>Hay dos caminos para llegar a los parametros: resolver <b>OLS</b> directamente, o
     actualizarlos poco a poco con el <?php hueco(16, 24); ?> , que
     empieza con un &theta; inicial y repite la actualizacion hasta minimizar
     <code>J(&theta;)</code>.</p>

  <p>En la regresion lineal multiple, ese algoritmo de actualizacion repetida recibe el
     nombre de algoritmo <?php hueco(17, 12); ?> .</p>

  <h3>Metodologia para entrenar el modelo</h3>
  <p>La base <code>{x, y}</code> se parte en dos: <b>train</b> con el
     <?php hueco(18, 8); ?> % y <b>test</b> con el
     <?php hueco(19, 8); ?> %. Se entrena con el primero y se mide con el segundo.</p>

  <?php mc('r5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Regresion multiple: elegir que variables entran</h2>
  <p>Con varias variables independientes hay que decidir cuales usar, dada una medida de
     calidad del ajuste. Las cuatro estrategias:</p>

  <table class="datos">
    <tr><th>Estrategia</th><th>En que consiste</th></tr>
    <tr>
      <td><?php hueco(20, 16); ?></td>
      <td>Se evaluan <b>todas</b> las combinaciones posibles de variables independientes y se escoge la mejor</td>
    </tr>
    <tr>
      <td><?php hueco(21, 16); ?></td>
      <td>Se evaluan todas las combinaciones posibles de <b>K</b> variables y se escoge la mejor</td>
    </tr>
    <tr>
      <td><?php hueco(22, 16); ?></td>
      <td>Se va decidiendo variable a variable, <?php hueco(23, 18); ?> (forward) o <?php hueco(24, 18); ?> (backward)</td>
    </tr>
    <tr>
      <td><?php hueco(25, 16); ?></td>
      <td>Se transforman los datos a un nuevo espacio vectorial de <b>menor dimensionalidad</b> que el de entrada</td>
    </tr>
  </table>

  <?php mc('r7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Metricas de evaluacion</h2>
  <p>Las tres mas utilizadas para un modelo de regresion:</p>

  <table class="datos">
    <tr><th>Sigla</th><th>Que es</th></tr>
    <tr><td><?php hueco(27, 12); ?></td><td>Media de los errores elevados al cuadrado</td></tr>
    <tr><td><?php hueco(28, 12); ?></td><td>Su raiz cuadrada, que vuelve a las unidades de la variable objetivo</td></tr>
    <tr><td><?php hueco(29, 14); ?></td><td>Coeficiente de determinacion: la proporcion de variabilidad explicada</td></tr>
  </table>

  <?php mc('r6'); ?>
  <?php mc('r4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Consideraciones finales: underfitting y overfitting</h2>

  <table class="datos">
    <tr><th>Nombre</th><th>Que ocurre</th><th>Error train</th><th>Error test</th></tr>
    <tr>
      <td><?php hueco(30, 18); ?></td>
      <td>El modelo <b>no puede capturar</b> la relacion entre la variable objetivo y los predictores</td>
      <td>Alto</td><td>Alto</td>
    </tr>
    <tr>
      <td><?php hueco(31, 18); ?></td>
      <td>El modelo captura <b>demasiado bien</b> la relacion en el conjunto de entrenamiento; los modelos complejos con muchos terminos tienden a esto</td>
      <td>Muy bajo</td><td>Alto</td>
    </tr>
  </table>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Variables categoricas &rarr; numericas</h2>
  <p>Muchas librerias exigen que los predictores sean numericos. Las cuatro opciones del PDF,
     con la herramienta de cada una:</p>

  <table class="datos">
    <tr><th>Metodo</th><th>Que hace</th><th>Con que</th></tr>
    <tr>
      <td><?php hueco(32, 20); ?></td>
      <td>Sustituye las categorias por numeros «deseados»</td>
      <td><?php hueco(36, 14); ?> de pandas</td>
    </tr>
    <tr>
      <td><?php hueco(33, 20); ?></td>
      <td>Primero ordinal, luego a binario, y cada digito de la cadena binaria a su propia columna. Usa <b>menos dimensiones</b> que one-hot</td>
      <td><?php hueco(39, 16); ?> de la libreria <?php hueco(40, 20); ?></td>
    </tr>
    <tr>
      <td><?php hueco(34, 20); ?></td>
      <td>Convierte cada valor de la columna en un numero entre 0 y (numero de categorias &minus; 1)</td>
      <td><?php hueco(38, 16); ?></td>
    </tr>
    <tr>
      <td><?php hueco(35, 20); ?></td>
      <td>Cada valor de la categoria pasa a ser una columna nueva con 1 o 0. No pondera ningun valor de forma incorrecta</td>
      <td><?php hueco(37, 18); ?> de pandas</td>
    </tr>
  </table>

  <?php ayuda('El de one-hot lleva parentesis: es una <b>funcion</b> de pandas, no una clase. Los dos <code>Encoder</code> son clases y van en CamelCase.'); ?>

  <?php mc('r8'); ?>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../ML/index.php', '');
