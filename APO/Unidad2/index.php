<?php
/* ==========================================================================
   APO / Unidad2  —  Correlacion, statsmodels vs sklearn y supuestos de la regresion
   Fuente: Notebooks-20260908/
           UNIDAD2-1-Correlacion y Dependencia de Variables.ipynb
           UNIDAD2-2-statmodels_vs_sklearn.ipynb
           UNIDAD2-3-Supuestos_teoricos.ipynb
   Prof. Milton Orlando Sarria Paja, PhD.
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- 1. covarianza vs correlacion --- */
    1  => ['direccion'],
    2  => ['magnitud'],
    3  => ['unidades'],
    4  => ['desviaciones estandar', 'desviaciones', 'desviacion estandar'],
    5  => ['pearson'],
    6  => ['-1'],
    7  => ['1'],
    8  => ['0.7643', '0,7643'],

    /* --- 2. Pearson: interpretacion --- */
    9  => ['positiva'],
    10 => ['negativa'],
    11 => ['lineal'],
    12 => ['atipicos', 'outliers', 'valores atipicos'],
    13 => ['causalidad'],
    14 => ['anscombe', 'cuarteto de anscombe'],
    15 => ['grafica', 'graficar', 'grafica tus datos'],

    /* --- 3. codigo de correlacion --- */
    16 => ['df.corr()'],
    17 => ['sns.heatmap(correlation_matrix, annot=True, cmap=\'coolwarm\')',
           'sns.heatmap(correlation_matrix, annot=True, cmap="coolwarm")'],

    /* --- 4. dependencia no lineal --- */
    18 => ['spearman'],
    19 => ['monotona'],
    20 => ['rangos'],
    21 => ['informacion mutua', 'mutual information'],
    22 => ['correlacion de distancia', 'distance correlation'],
    23 => ['independientes'],
    24 => ['fuga de datos', 'data leakage', 'fuga'],

    /* --- 5. statsmodels --- */
    25 => ['smf.ols(formula=\'y ~ X\', data=df)', 'smf.ols(formula="y ~ X", data=df)'],
    26 => ['resultado_sm = modelo_sm.fit()', 'modelo_sm.fit()'],
    27 => ['print(resultado_sm.summary())', 'resultado_sm.summary()'],
    28 => ['intercepto'],
    29 => ['pendiente'],
    30 => ['r-squared', 'r cuadrado', 'r2'],
    31 => ['significativos'],

    /* --- 6. sklearn --- */
    32 => ['X_sk = df[[\'X\']]', 'df[[\'X\']]'],
    33 => ['modelo_sk = LinearRegression()', 'LinearRegression()'],
    34 => ['modelo_sk.fit(X_sk, y_sk)'],
    35 => ['modelo_sk.intercept_'],
    36 => ['modelo_sk.coef_[0]'],
    37 => ['2d', 'bidimensional', 'matriz 2d'],

    /* --- 7. metricas --- */
    38 => ['mse', 'mean_squared_error'],
    39 => ['rmse'],
    40 => ['mae', 'mean_absolute_error'],
    41 => ['cuadrado', 'al cuadrado'],
    42 => ['unidad', 'misma unidad'],

    /* --- 8. los cuatro supuestos --- */
    43 => ['linealidad'],
    44 => ['independencia'],
    45 => ['homoscedasticidad', 'homocedasticidad'],
    46 => ['normalidad'],

    /* --- 9. las pruebas --- */
    47 => ['residuos'],
    48 => ['aleatoria'],
    49 => ['durbin-watson', 'durbin watson'],
    50 => ['2'],
    51 => ['breusch-pagan', 'breusch pagan'],
    52 => ['constante'],
    53 => ['shapiro-wilk', 'shapiro wilk', 'shapiro'],
    54 => ['q-q', 'qq', 'grafico q-q'],
    55 => ['recta', 'linea recta'],
    56 => ['cono', 'forma de cono'],
];

$TEXTO = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,18,19,20,21,22,23,24,
          28,29,30,31,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Mides altura y peso, y luego cambias las unidades de cm a metros. &iquest;Que le pasa a la covarianza y que a la correlacion?',
        'opciones' => [
            'a' => 'Las dos cambian igual',
            'b' => 'La <b>covarianza cambia drasticamente</b> (de 48.08 a 0.48) pero la <b>correlacion se queda igual</b> (0.7643), porque al dividir por las desviaciones estandar se cancela el efecto de la escala',
            'c' => 'La correlacion cambia y la covarianza no',
            'd' => 'Ninguna cambia'
        ],
        'porque'   => 'Es el experimento entero del notebook: cm-kg, m-kg, in-lb y cm-g dan covarianzas de 48.08, 0.48, 41.73 y 48079.61 — y <b>las cuatro correlaciones dan 0.7643</b>. La relacion entre las variables nunca cambio; solo la regla con la que medimos.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Quieres comparar si la relacion (altura, peso) es mas fuerte que la relacion (ingreso, gasto). &iquest;Que usas?',
        'opciones' => [
            'a' => 'La covarianza, porque conserva las unidades',
            'b' => 'La <b>correlacion</b>: al no tener unidades y estar acotada entre -1 y 1, es comparable entre pares de variables con escalas completamente distintas',
            'c' => 'Cualquiera de las dos',
            'd' => 'La varianza de cada variable'
        ],
        'porque'   => 'Decir &laquo;48 unidades de covarianza&raquo; no significa nada sin conocer las escalas. Por eso los mapas de calor de EDA se hacen con <code>df.corr()</code> y no con la covarianza.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Obtienes <b>r = 0</b> entre dos variables. &iquest;Que puedes concluir?',
        'opciones' => [
            'a' => 'Que las variables son independientes',
            'b' => 'Que no hay relacion <b>lineal</b> — pero puede seguir existiendo una relacion no lineal fuerte y perfectamente predecible',
            'c' => 'Que hay un error en los datos',
            'd' => 'Que la relacion es debil en cualquier forma'
        ],
        'porque'   => 'Esta es la limitacion numero uno de Pearson. Un r cercano a cero <b>no</b> es prueba de independencia: solo dice que una recta no describe bien la nube de puntos.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => '&iquest;Que demuestra el <b>cuarteto de Anscombe</b>?',
        'opciones' => [
            'a' => 'Que hay cuatro tipos de correlacion',
            'b' => 'Que cuatro conjuntos de datos pueden tener <b>casi el mismo r</b> (y las mismas medias y varianzas) y aun asi verse completamente distintos al graficarlos',
            'c' => 'Que la correlacion siempre implica causalidad',
            'd' => 'Que hacen falta al menos cuatro variables'
        ],
        'porque'   => 'De ahi sale la regla de oro del notebook: <b>siempre grafica tus datos, no confies solo en el numero</b>. Fijate en el conjunto IV: todos los x valen 8 salvo un solo punto en 19 — un unico outlier fabrica la correlacion entera.',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => 'Temperatura y ventas de helado estan claramente relacionadas, pero el r de Pearson sale bajo. &iquest;Que metrica te ayuda si la relacion es <b>monotona</b> pero curva?',
        'opciones' => [
            'a' => 'La covarianza',
            'b' => 'La correlacion de <b>Spearman</b>, que trabaja sobre los <b>rangos</b> de los datos en vez de sus valores originales',
            'c' => 'El MSE',
            'd' => 'La varianza'
        ],
        'porque'   => 'Spearman mide si al crecer una variable la otra crece (o decrece) <em>consistentemente</em>, sin exigir que sea en linea recta. Para dependencias que ni siquiera son monotonas hacen falta la <b>informacion mutua</b> o la <b>correlacion de distancia</b>.',
        'correcta' => 'b'
    ],
    'm6' => [
        'texto'    => 'Encuentras una <i>feature</i> con r casi perfecto (0.99) respecto al <i>target</i>. &iquest;Que sospechas?',
        'opciones' => [
            'a' => 'Que encontraste la mejor variable del dataset',
            'b' => 'Una posible <b>fuga de datos</b>: esa columna probablemente contiene informacion del target que no estara disponible al momento de predecir de verdad',
            'c' => 'Que hay que eliminar el target',
            'd' => 'Que los datos estan mal escalados'
        ],
        'porque'   => 'Suena a buena noticia y casi siempre es un error. Ejemplo tipico: predecir si un paciente sera hospitalizado usando la columna &laquo;dias de hospitalizacion&raquo;. En produccion ese dato todavia no existe.',
        'correcta' => 'b'
    ],
    'm7' => [
        'texto'    => 'En sklearn escribes <code>df[[\'X\']]</code> con doble corchete y no <code>df[\'X\']</code>. &iquest;Por que?',
        'opciones' => [
            'a' => 'Por estilo, es indiferente',
            'b' => 'Porque scikit-learn espera que X sea una <b>matriz 2D</b>; el corchete simple devuelve una Series de una dimension',
            'c' => 'Porque asi se ordenan las columnas',
            'd' => 'Porque el corchete simple es mas lento'
        ],
        'porque'   => 'La alternativa equivalente que da el notebook es <code>df[\'X\'].values.reshape(-1, 1)</code>. Es exactamente el mismo doble corchete que viste al filtrar columnas en pandas — aqui la razon es la forma que exige el modelo.',
        'correcta' => 'b'
    ],
    'm8' => [
        'texto'    => 'Los coeficientes de <code>statsmodels</code> y <code>scikit-learn</code> salen identicos. &iquest;Entonces para que existen las dos?',
        'opciones' => [
            'a' => 'Una es mas precisa que la otra',
            'b' => 'Ajustan el mismo modelo, pero <b>statsmodels</b> apunta a la <b>estadistica inferencial</b> (te da el summary con p-valores e intervalos) y <b>sklearn</b> al <b>machine learning predictivo</b> (facilidad de uso e integracion con el resto del pipeline)',
            'c' => 'sklearn solo sirve para clasificacion',
            'd' => 'statsmodels no puede predecir'
        ],
        'porque'   => 'Por eso en la actividad se pide ajustar con statsmodels: necesitas leer el <code>summary()</code> para interpretar coeficientes y significancia, cosa que <code>LinearRegression</code> no te da.',
        'correcta' => 'b'
    ],
    'm9' => [
        'texto'    => 'De MSE, RMSE y MAE, &iquest;cual esta en la <b>misma unidad</b> que la variable dependiente y ademas es <b>menos sensible a outliers</b>?',
        'opciones' => [
            'a' => 'El MSE',
            'b' => 'El RMSE esta en la misma unidad, pero el <b>MAE</b> es el que ademas es menos sensible a los valores atipicos',
            'c' => 'El MSE es menos sensible',
            'd' => 'Los tres son igual de sensibles'
        ],
        'porque'   => 'Reparto: <b>MSE</b> penaliza mas los errores grandes y su unidad (&laquo;dolares al cuadrado&raquo;) no se interpreta. <b>RMSE</b> arregla la unidad. <b>MAE</b> tambien esta en la unidad de y y ademas no castiga tanto un outlier suelto.',
        'correcta' => 'b'
    ],
    'm10' => [
        'texto'    => 'El grafico de <b>residuos vs. valores ajustados</b> muestra una forma curva clara. &iquest;Que supuesto esta fallando?',
        'opciones' => [
            'a' => 'La normalidad',
            'b' => 'La <b>linealidad</b>: un patron sistematico indica que el modelo lineal no captura la relacion, y toca meter terminos polinomicos o transformar variables',
            'c' => 'La independencia',
            'd' => 'Ninguno, es normal'
        ],
        'porque'   => 'La lectura de ese grafico es siempre la misma: <b>si no ves patron, todo bien</b>. Los residuos deben repartirse de forma aleatoria alrededor de cero.',
        'correcta' => 'b'
    ],
    'm11' => [
        'texto'    => 'El estadistico de <b>Durbin-Watson</b> te da 2.03. &iquest;Que concluyes?',
        'opciones' => [
            'a' => 'Hay autocorrelacion positiva fuerte',
            'b' => 'Que los errores son <b>independientes</b>: el estadistico va de 0 a 4 y un valor cercano a 2 indica que no hay autocorrelacion',
            'c' => 'Que los residuos no son normales',
            'd' => 'Que hay heteroscedasticidad'
        ],
        'porque'   => 'Escala completa: <b>&lt;2</b> autocorrelacion <b>positiva</b> (errores consecutivos en la misma direccion), <b>&asymp;2</b> independencia, <b>&gt;2</b> autocorrelacion <b>negativa</b>. Importa sobre todo en datos temporales o secuenciales.',
        'correcta' => 'b'
    ],
    'm12' => [
        'texto'    => 'La prueba de <b>Breusch-Pagan</b> te da p = 0.394. &iquest;Se cumple la homoscedasticidad?',
        'opciones' => [
            'a' => 'No, porque el p-valor es alto',
            'b' => '<b>Si</b>: H&#8320; dice que la varianza de los errores es constante, y como p = 0.394 &gt; 0.05 no hay evidencia para rechazarla',
            'c' => 'No se puede saber sin el grafico',
            'd' => 'Si, porque el p-valor es menor que 0.05'
        ],
        'porque'   => 'Ojo con la logica invertida: aqui <b>la hipotesis nula es la buena noticia</b>. Un p-valor <b>bajo</b> (&lt; 0.05) es el que delata heteroscedasticidad. Lo mismo pasa con Shapiro-Wilk, donde H&#8320; es &laquo;los datos son normales&raquo;.',
        'correcta' => 'b'
    ],
    'm13' => [
        'texto'    => 'En el ejemplo de <b>violacion</b> del supuesto, el grafico de residuos muestra una forma de <b>cono</b>. &iquest;Que significa y que consecuencia tiene?',
        'opciones' => [
            'a' => 'Que faltan datos',
            'b' => 'Heteroscedasticidad: la varianza de los errores crece con los valores ajustados. Aunque la normalidad se mantenga, <b>sesga los intervalos de confianza y las pruebas de significancia</b>',
            'c' => 'Que el modelo tiene demasiadas variables',
            'd' => 'Que hay autocorrelacion'
        ],
        'porque'   => 'Detalle importante para la actividad: los <b>coeficientes</b> siguen siendo utilizables, lo que se rompe es la <b>inferencia</b> — los p-valores y los intervalos dejan de ser de fiar.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Unidad 2 · Correlación, statsmodels vs sklearn y supuestos',
         'Notebooks-20260908 — Prof. Milton Orlando Sarria Paja');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Los tres notebooks de la <b>Unidad 2</b> que dejo el profe en
     <code>Notebooks-20260908/</code>, mas los datasets de
     <code>Data-20260908/</code>. Tres bloques encadenados:</p>
  <ol>
    <li><b>Correlacion y dependencia</b> — antes de modelar, medir si las variables se relacionan.</li>
    <li><b>statsmodels vs sklearn</b> — las dos formas de ajustar la misma recta.</li>
    <li><b>Supuestos teoricos</b> — como saber si esa recta es de fiar.</li>
  </ol>
  <div class="nota">Las respuestas conceptuales son <b>texto</b> (no importan mayusculas ni
    tildes); las de <b>codigo</b> si respetan mayusculas. Pulsa <b>Enter</b> para verificar.</div>
</div>


<div class="card">
  <h2>1. Covarianza vs. correlacion</h2>

  <pre><code>Cov(X,Y) = (1/n) · Σ (Xᵢ − X̄)(Yᵢ − Ȳ)          ← muestra: n−1

        r = Cov(X,Y) / (σ_X · σ_Y)</code></pre>

  <p>La covarianza indica la <?php hueco(1, 12); ?> de la relacion lineal
     (el signo), pero su <?php hueco(2, 12); ?> no es directamente interpretable,
     porque depende de las <?php hueco(3, 12); ?> en las que esten medidas X e Y.</p>

  <p>Por eso se estandariza dividiendo por el producto de las
     <?php hueco(4, 22); ?>, obteniendo el coeficiente de
     <?php hueco(5, 12); ?>. En otras palabras: <b>la correlacion es una covarianza
     sin unidades</b>, acotada siempre entre <?php hueco(6, 6); ?> y
     <?php hueco(7, 6); ?>.</p>

  <h3>El experimento del notebook</h3>
  <p>Los mismos 50 datos de altura y peso, cambiando solo las unidades:</p>

  <table class="datos">
    <tr><th>Unidades comparadas</th><th>Covarianza</th><th>Correlacion</th></tr>
    <tr><td>cm vs. kg</td><td>48.08</td><td><?php hueco(8, 10); ?></td></tr>
    <tr><td>m vs. kg</td><td>0.48</td><td>0.7643</td></tr>
    <tr><td>in vs. lb</td><td>41.73</td><td>0.7643</td></tr>
    <tr><td>cm vs. g</td><td>48079.61</td><td>0.7643</td></tr>
  </table>

  <div class="nota">La covarianza pasa de <b>0.48 a 48079.61</b> sin que la relacion entre
    las variables haya cambiado en absoluto. La correlacion no se mueve.</div>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Pearson: como se lee y donde falla</h2>

  <table class="datos">
    <tr><th>Valor</th><th>Significa</th></tr>
    <tr><td>r = 1</td><td>correlacion perfectamente <?php hueco(9, 12); ?></td></tr>
    <tr><td>r = −1</td><td>correlacion perfectamente <?php hueco(10, 12); ?></td></tr>
    <tr><td>r = 0</td><td>no hay relacion <?php hueco(11, 10); ?> — puede seguir habiendo una no lineal</td></tr>
  </table>

  <p><b>Sus tres limitaciones:</b></p>
  <ol>
    <li>Solo detecta relaciones <b>lineales</b>. El famoso cuarteto de
        <?php hueco(14, 14); ?> son cuatro conjuntos con casi identico r pero formas
        completamente distintas al graficarlos. De ahi la regla de oro:
        <b>siempre <?php hueco(15, 12); ?> tus datos</b>, no confies solo en el numero.</li>
    <li>Es sensible a los valores <?php hueco(12, 12); ?>, que pueden inflar o
        deflactar artificialmente el valor de r.</li>
    <li>No implica <?php hueco(13, 12); ?>.</li>
  </ol>

  <h3>El codigo</h3>
  <?php linea(16, 'la matriz de correlacion de un dataframe', 'correlation_matrix = ...'); ?>
  <?php linea(17, 'dibujarla como mapa de calor con los valores escritos y la paleta <code>coolwarm</code>', 'sns.heatmap(...)'); ?>

  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Dependencia no lineal</h2>
  <p>Hay relaciones fuertes y predecibles donde Pearson sale cercano a cero: la felicidad
     y el dinero (curva en S), la edad y la capacidad de reaccion (curva cuadratica),
     o el caso de <code>Ice_cream_selling_data.csv</code>.</p>

  <table class="datos">
    <tr><th>Metrica alternativa</th><th>Que detecta</th></tr>
    <tr><td>Correlacion de <?php hueco(18, 12); ?> (ρ)</td>
        <td>si la relacion se describe con una funcion <?php hueco(19, 12); ?>
            (no necesariamente lineal), usando los <?php hueco(20, 10); ?>
            de los datos en vez de sus valores</td></tr>
    <tr><td><?php hueco(21, 20); ?></td>
        <td>cuanta informacion comparte una variable sobre otra: capta dependencias
            arbitrarias, lineales o no</td></tr>
    <tr><td><?php hueco(22, 24); ?></td>
        <td>detecta cualquier tipo de dependencia, incluso no monotona; es cero
            <b>si y solo si</b> las variables son <?php hueco(23, 14); ?></td></tr>
  </table>

  <div class="avisoflujo">
    <b>Del take-away del notebook.</b> En Machine Learning la correlacion sirve para
    seleccionar variables, detectar multicolinealidad y prevenir la
    <?php hueco(24, 16); ?> — pero no reemplaza el juicio sobre causalidad.
  </div>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Ajustar la recta: statsmodels vs. scikit-learn</h2>
  <p>Datos sinteticos del notebook, con relacion verdadera <code>y = 5 + 2.5·X</code> mas ruido.</p>

  <h3>Metodo 1 — <code>statsmodels</code></h3>
  <?php linea(25, 'define el modelo con sintaxis de <b>formula</b>: modelar <code>y</code> en funcion de <code>X</code>', 'modelo_sm = ...'); ?>
  <?php linea(26, 'ajusta el modelo a los datos', 'resultado_sm = ...'); ?>
  <?php linea(27, 'muestra el resumen estadistico completo', 'print(...)'); ?>

  <p>Como se lee ese <code>summary()</code>:</p>
  <table class="datos">
    <tr><th>Campo</th><th>Que es</th></tr>
    <tr><td><code>Intercept</code> (coef)</td><td>el <?php hueco(28, 12); ?> estimado (θ&#8320;)</td></tr>
    <tr><td><code>X</code> (coef)</td><td>la <?php hueco(29, 12); ?> estimada (θ&#8321;)</td></tr>
    <tr><td><code><?php hueco(30, 12); ?></code></td><td>el % de la variabilidad de <code>y</code> explicada por <code>X</code></td></tr>
    <tr><td><code>P&gt;|t|</code></td><td>si vale 0.000, los coeficientes son estadisticamente <?php hueco(31, 16); ?></td></tr>
  </table>

  <h3>Metodo 2 — <code>scikit-learn</code></h3>
  <?php linea(32, 'prepara X como matriz de dos dimensiones (doble corchete)', 'X_sk = ...'); ?>
  <?php linea(33, 'crea la instancia del modelo', 'modelo_sk = ...'); ?>
  <?php linea(34, 'ajusta el modelo', 'modelo_sk...'); ?>
  <?php linea(35, 'obtiene el intercepto (β&#8320;)', 'intercepto_sk = ...'); ?>
  <?php linea(36, 'obtiene la pendiente (β&#8321;)', 'pendiente_sk = ...'); ?>

  <p>Scikit-learn exige que X sea una matriz <?php hueco(37, 10); ?>; por eso el
     doble corchete, o su equivalente <code>df['X'].values.reshape(-1, 1)</code>.</p>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Metricas de desempeño</h2>

  <table class="datos">
    <tr><th>Sigla</th><th>Que es</th><th>Detalle</th></tr>
    <tr><td><?php hueco(38, 8); ?></td><td>promedio de los errores al <?php hueco(41, 10); ?></td>
        <td>penaliza mas los errores grandes; su unidad no se interpreta</td></tr>
    <tr><td><?php hueco(39, 8); ?></td><td>la raiz cuadrada del anterior</td>
        <td>esta en la misma <?php hueco(42, 10); ?> que <code>y</code></td></tr>
    <tr><td><?php hueco(40, 8); ?></td><td>promedio de los errores absolutos</td>
        <td>tambien en la unidad de <code>y</code>, y <b>menos sensible</b> a outliers</td></tr>
  </table>

  <?php mc('m9'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Los cuatro supuestos y como se verifican</h2>
  <p>Esta es la tabla que hay que tener en la cabeza para la actividad.</p>

  <table class="datos">
    <tr><th>Supuesto</th><th>Que dice</th><th>Como se verifica</th></tr>
    <tr><td><?php hueco(43, 14); ?></td>
        <td>la relacion entre las variables es lineal</td>
        <td>grafico de <?php hueco(47, 12); ?> vs. valores ajustados</td></tr>
    <tr><td><?php hueco(44, 16); ?> de los errores</td>
        <td>no hay correlacion entre los residuos</td>
        <td>prueba de <?php hueco(49, 18); ?></td></tr>
    <tr><td><?php hueco(45, 20); ?></td>
        <td>la varianza de los errores es <?php hueco(52, 12); ?></td>
        <td>prueba de <?php hueco(51, 18); ?></td></tr>
    <tr><td><?php hueco(46, 14); ?> de los errores</td>
        <td>los residuos siguen una distribucion normal</td>
        <td>grafico <?php hueco(54, 8); ?> y prueba de <?php hueco(53, 16); ?></td></tr>
  </table>

  <h3>Como se leen</h3>
  <ul>
    <li><b>Residuos vs. ajustados:</b> si el modelo esta bien especificado, los residuos se
        distribuyen de forma <?php hueco(48, 12); ?> alrededor de cero, sin patron.
        Un patron curvo pide terminos polinomicos o transformar variables.</li>
    <li><b>Durbin-Watson:</b> el estadistico va de 0 a 4. Un valor cercano a
        <?php hueco(50, 6); ?> indica independencia; por debajo, autocorrelacion
        positiva; por encima, negativa.</li>
    <li><b>Q-Q:</b> si los puntos se alinean en una <?php hueco(55, 12); ?>,
        los datos son normales; si se desvian, hay colas gruesas o asimetria.</li>
    <li><b>Violacion de homoscedasticidad:</b> el grafico de residuos muestra un patron en
        forma de <?php hueco(56, 10); ?>.</li>
  </ul>

  <div class="avisoflujo">
    <b>La trampa de los p-valores.</b> Tanto en Breusch-Pagan como en Shapiro-Wilk,
    la hipotesis nula H&#8320; es <b>la buena noticia</b> (varianza constante / datos normales).
    Un <b>p-valor alto</b> (&gt; 0.05) significa que el supuesto <b>se cumple</b>.
  </div>

  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>


<div class="card">
  <h2>Los tres casos de la actividad</h2>
  <p>Sin huecos: es lo que hay que <em>hacer</em>, no memorizar.</p>

  <table class="datos">
    <tr><th>Caso</th><th>Dataset</th><th>Que se espera</th></tr>
    <tr><td>1 · Horas de estudio y calificaciones</td><td><code>score_updated.csv</code></td>
        <td>relacion lineal; ajustar, calcular RMSE, <b>meter 3 outliers a mano</b> y reevaluar</td></tr>
    <tr><td>2 · Temperatura y ventas de helado</td><td><code>Ice_cream_selling_data.csv</code></td>
        <td>relacion <b>no lineal</b>; ver que el RMSE por si solo no basta</td></tr>
    <tr><td>3 · Enfermedades cardiacas</td><td><code>dataset_2190_cholesterol.csv</code></td>
        <td>elegir las <b>3 variables con mayor correlacion</b> con <code>num</code> y comparar tres modelos</td></tr>
  </table>

  <p>En <code>Data-20260908/</code> hay ademas otros datasets que no usa la actividad pero
     que sirven para practicar: <code>Advertising.csv</code>, <code>alturas-pesos.csv</code>,
     <code>housing.csv</code>, <code>abalone.data</code>, <code>phone.csv</code>,
     <code>sleepdata.csv</code>, <code>estatura_edad.csv</code> y
     <code>weather_data.csv</code>.</p>

  <div class="nota">Ojo con las rutas: los notebooks traen
    <code>pd.read_csv('ruta a archivo /score_updated.csv')</code> como marcador de posicion.
    Hay que reemplazarlo por la ruta real, por ejemplo
    <code>pd.read_csv('../Data-20260908/score_updated.csv')</code>.</div>
</div>

<?php
pie('../Menu.php', '');
