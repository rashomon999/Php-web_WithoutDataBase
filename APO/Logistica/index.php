<?php
/* ==========================================================================
   APO / Logistica  —  Regresion logistica: sigmoide, odds, MLE y log loss
   Fuente: Diapositivas Regresion Multiple - Regresion Logisitica-20260920/
           01reg_logistic.pptx  y  02reg_logistic_mle.pptx
   Prof. Milton Orlando Sarria Paja, PhD. — Universidad Icesi
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- 1. que es --- */
    1  => ['binaria', 'dicotomica', 'categorica binaria'],
    2  => ['probabilidad'],
    3  => ['continua'],
    4  => ['clasificacion'],

    /* --- 2. la sigmoide --- */
    5  => ['sigmoide', 'logistica', 'funcion sigmoide'],
    6  => ['0.5', '0,5', '1/2'],
    7  => ['1'],
    8  => ['0'],
    9  => ['0.5', '0,5'],
    10 => ['frontera de decision', 'frontera'],
    11 => ['0'],
    12 => ['1 / (1 + np.exp(-z))', '1/(1+np.exp(-z))'],

    /* --- 3. los cuatro pasos --- */
    13 => ['clasificacion'],
    14 => ['lineal', 'modelo lineal'],
    15 => ['sigmoide'],
    16 => ['umbral', 'umbral de decision'],

    /* --- 4. odds y log-odds --- */
    17 => ['exito'],
    18 => ['fracaso'],
    19 => ['4'],
    20 => ['0.333', '0,333', '1/3', '0.33', '0,33'],
    21 => ['3'],
    22 => ['lineal'],
    23 => ['log-odds', 'logodds', 'logaritmo de los odds', 'log odds'],
    24 => ['0.07', '0,07'],
    25 => ['1.0725', '1,0725', '1.07', '1,07'],
    26 => ['2.145', '2,145', '2.15', '2,15'],
    27 => ['7.25', '7,25', '7.25%', '7,25%'],
    28 => ['4.48', '4,48'],
    29 => ['348', '348%'],
    30 => ['1'],
    31 => ['np.exp(modelo.coef_)', 'np.exp(model.coef_)', 'np.exp(modelo.coef_[0])'],

    /* --- 5. MLE, funcion de costo y gradiente --- */
    32 => ['convexa'],
    33 => ['locales', 'minimos locales'],
    34 => ['probables', 'probable', 'verosimiles'],
    35 => ['verosimilitud', 'maxima verosimilitud', 'likelihood'],
    36 => ['producto', 'productoria', 'multiplicacion'],
    37 => ['logaritmo', 'log'],
    38 => ['suma', 'sumatoria'],
    39 => ['log loss', 'entropia cruzada binaria', 'binary cross-entropy',
           'entropia cruzada', 'logloss'],
    40 => ['minimizar'],
    41 => ['alpha', 'tasa de aprendizaje', 'learning rate'],
    42 => ['opuesta', 'contraria'],
    43 => ['error'],
    44 => ['from sklearn.linear_model import LogisticRegression'],
    45 => ['modelo.predict_proba(X_test)[:, 1]', 'model.predict_proba(X_test)[:, 1]',
           'modelo.predict_proba(X_test)'],
];

/* los que se comparan como texto; los de codigo (12, 31, 44, 45) quedan fuera */
$TEXTO = array_values(array_diff(range(1, 45), [12, 31, 44, 45]));

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Por que no sirve la regresion lineal para predecir una variable que solo vale 0 o 1?',
        'opciones' => [
            'a' => 'Porque no se puede ajustar una recta a datos binarios',
            'b' => 'Porque la recta no esta acotada: da valores por debajo de 0 y por encima de 1, que no se pueden leer como probabilidades',
            'c' => 'Porque la regresion lineal solo admite una variable predictora',
            'd' => 'Porque el MSE no se puede calcular con ceros y unos'
        ],
        'porque'   => 'En la diapositiva se ve la nube de puntos pegada a 0 y a 1 con una recta atravesandola y saliendose por los dos extremos. La sigmoide hace justo lo que falta: <b>aplastar</b> cualquier numero real dentro del intervalo (0, 1).',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'La salida de <code>h&theta;(x)</code> en regresion logistica es 0.73. &iquest;Que significa?',
        'opciones' => [
            'a' => 'Que la clase predicha es 0.73',
            'b' => 'Que la <b>probabilidad estimada</b> de pertenecer a la clase positiva es del 73%; con el umbral habitual de 0.5 se clasifica como 1',
            'c' => 'Que el modelo acierta el 73% de las veces',
            'd' => 'Que el error del modelo es 0.27'
        ],
        'porque'   => 'El modelo <b>no</b> devuelve una clase: devuelve una probabilidad. La clase aparece solo cuando aplicas el umbral. Por eso una misma prediccion puede ser 1 o 0 segun donde pongas ese umbral.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Bajas el umbral de 0.5 a 0.3. &iquest;Que le pasa al modelo?',
        'opciones' => [
            'a' => 'Nada, el umbral no afecta las predicciones',
            'b' => 'Declara positivos mas facilmente: <b>sube el recall</b> y normalmente <b>baja la precision</b>. La frontera se mueve, pero los &theta; aprendidos son los mismos',
            'c' => 'El modelo tiene que reentrenarse desde cero',
            'd' => 'Todas las predicciones pasan a ser 0'
        ],
        'porque'   => 'El umbral es una decision <b>posterior</b> al entrenamiento, y se elige segun lo que cueste cada tipo de error (un fraude que se escapa no cuesta lo mismo que una alarma falsa).',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'Una probabilidad de 0.8 da unos odds de 4. &iquest;Cual es la lectura correcta?',
        'opciones' => [
            'a' => 'Que el evento ocurre el 400% de las veces',
            'b' => 'Que es <b>4 veces mas probable</b> que el evento ocurra a que no ocurra (4 a 1 a favor)',
            'c' => 'Que la probabilidad es 4 veces mayor que 0.8',
            'd' => 'Que hay 4 casos posibles'
        ],
        'porque'   => 'Los odds comparan <b>exito contra fracaso</b>, no exito contra el total. Probabilidad 0.8 y odds 4 son el mismo hecho dicho de dos formas: 0.8/0.2 = 4.',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => '&iquest;Para que se pasa de los odds a los <b>log-odds</b> (el logaritmo natural de los odds)?',
        'opciones' => [
            'a' => 'Para que los numeros sean mas pequenos',
            'b' => 'Porque asi la parte derecha queda <b>lineal</b>: <code>ln(p/(1-p)) = &theta;&#8320; + &theta;&#8321;x&#8321; + &hellip;</code>, es decir, volvemos al modelo lineal de siempre, pero sobre los log-odds',
            'c' => 'Porque el logaritmo elimina los errores',
            'd' => 'Porque los odds no se pueden calcular con mas de una variable'
        ],
        'porque'   => 'Es el puente entre las dos mitades del tema: la probabilidad no es lineal en x (es una S), pero <b>el logaritmo de los odds si lo es</b>. La sigmoide es simplemente este despeje al reves.',
        'correcta' => 'b'
    ],
    'm6' => [
        'texto'    => 'En <code>ln(Odds de Diabetes) = -3.5 + 0.07 &times; Edad</code>, &iquest;que aporta calcular <code>e<sup>0.07</sup> &asymp; 1.0725</code>?',
        'opciones' => [
            'a' => 'La probabilidad de tener diabetes',
            'b' => 'El <b>Odds Ratio</b>: por cada ano adicional, los odds quedan multiplicados por 1.0725, o sea un <b>7.25% mas</b>. Es la version entendible de "los log-odds suben 0.07"',
            'c' => 'El error estandar del coeficiente',
            'd' => 'El umbral optimo de decision'
        ],
        'porque'   => 'Ningun paciente piensa en log-odds. El truco es que <code>e<sup>a+b</sup> = e<sup>a</sup>&middot;e<sup>b</sup></code>: lo que era una <b>suma</b> en log-odds se vuelve una <b>multiplicacion</b> en odds. Si los odds eran 2:1, con un ano mas son 2 &times; 1.0725 = 2.145.',
        'correcta' => 'b'
    ],
    'm7' => [
        'texto'    => 'Un coeficiente da un Odds Ratio de <b>0.80</b>. &iquest;Como se reporta?',
        'opciones' => [
            'a' => 'Aumenta los odds un 80%',
            'b' => 'Los <b>reduce un 20%</b>: si OR &lt; 1 se usa (1 &minus; OR) &times; 100%',
            'c' => 'No tiene efecto',
            'd' => 'Los reduce un 80%'
        ],
        'porque'   => 'Las tres reglas: OR &gt; 1 &rarr; (OR&minus;1)&times;100% de aumento; OR &lt; 1 &rarr; (1&minus;OR)&times;100% de disminucion; OR = 1 &rarr; <b>sin efecto</b> (porque e&#8304; = 1, es decir &theta; = 0).',
        'correcta' => 'b'
    ],
    'm8' => [
        'texto'    => '&iquest;Por que no se usa el error cuadratico medio como funcion de costo en regresion logistica?',
        'opciones' => [
            'a' => 'Porque el MSE no se puede derivar',
            'b' => 'Porque al meter la sigmoide dentro del MSE la superficie de costo deja de ser <b>convexa</b>: se llena de minimos locales y el gradiente descendente se puede quedar atrapado',
            'c' => 'Porque el MSE da siempre cero',
            'd' => 'Porque el MSE solo funciona con una variable'
        ],
        'porque'   => 'Es la diapositiva del &laquo;paisaje&raquo; con montanas y valles. Con la funcion de costo correcta (log loss) la superficie vuelve a tener <b>un solo minimo</b>, y ahi si el gradiente descendente llega siempre al mismo sitio.',
        'correcta' => 'b'
    ],
    'm9' => [
        'texto'    => '&iquest;Que pregunta responde la <b>Estimacion por Maxima Verosimilitud</b> (MLE)?',
        'opciones' => [
            'a' => '&iquest;Que datos son los mas probables dado un modelo fijo?',
            'b' => '&iquest;Que valores de &theta; harian que los datos que <b>ya observamos</b> sean lo mas probables posible?',
            'c' => '&iquest;Cual es el umbral que maximiza la exactitud?',
            'd' => '&iquest;Cuantas iteraciones necesita el gradiente descendente?'
        ],
        'porque'   => 'Se da vuelta el razonamiento: los datos estan fijos (ya ocurrieron) y lo que se mueve son los parametros. Se busca el &theta; que hace que lo observado parezca lo mas normal del mundo.',
        'correcta' => 'b'
    ],
    'm10' => [
        'texto'    => 'La verosimilitud es un <b>producto</b> de m terminos: <code>L(&theta;) = &prod; h<sup>y</sup>&middot;(1&minus;h)<sup>1&minus;y</sup></code>. &iquest;Por que se le toma logaritmo?',
        'opciones' => [
            'a' => 'Para que el resultado sea positivo',
            'b' => 'Porque el logaritmo convierte el <b>producto en suma</b> (mas facil de derivar y sin que el producto de cientos de probabilidades se vaya a cero), y como el log es creciente el maximo esta en el mismo sitio',
            'c' => 'Porque el logaritmo elimina los parametros',
            'd' => 'Porque asi se puede usar el MSE'
        ],
        'porque'   => 'Fijate en el truco del exponente: <code>h<sup>y</sup>(1&minus;h)<sup>1&minus;y</sup></code> es una sola formula que vale <code>h</code> cuando y = 1 y <code>1&minus;h</code> cuando y = 0. Al tomar log queda <code>y&middot;log(h) + (1&minus;y)&middot;log(1&minus;h)</code>.',
        'correcta' => 'b'
    ],
    'm11' => [
        'texto'    => 'La funcion de costo final es <code>J(&theta;) = &minus;(1/m) &Sigma; [ y&middot;log(h) + (1&minus;y)&middot;log(1&minus;h) ]</code>. &iquest;Que hace el signo <b>menos</b>?',
        'opciones' => [
            'a' => 'Corrige un error de calculo',
            'b' => 'Convierte el problema de <b>maximizar</b> la log-verosimilitud en uno de <b>minimizar</b> un costo, que es lo que sabe hacer el gradiente descendente (y el 1/m lo vuelve un promedio)',
            'c' => 'Hace que el costo pueda ser negativo',
            'd' => 'Sirve para invertir las clases'
        ],
        'porque'   => 'Maximizar &#8467;(&theta;) y minimizar &minus;&#8467;(&theta;) son el mismo problema. Con ese cambio de signo la log-verosimilitud se convierte en el <b>log loss</b> o <b>entropia cruzada binaria</b>, el costo estandar de clasificacion.',
        'correcta' => 'b'
    ],
    'm12' => [
        'texto'    => 'El gradiente queda <code>&part;J/&part;&theta;&#8323; = (1/m) &Sigma; (h&theta;(x) &minus; y)&middot;x&#8323;</code>. &iquest;Que tiene de llamativo?',
        'opciones' => [
            'a' => 'Que no depende de los datos',
            'b' => 'Que es <b>identico en forma</b> al de la regresion lineal: (prediccion &minus; real) &times; la caracteristica. Solo cambia quien es h&theta;(x): antes &theta;&#7488;x, ahora la sigmoide de &theta;&#7488;x',
            'c' => 'Que hay que calcularlo numericamente',
            'd' => 'Que solo sirve para &theta;&#8320;'
        ],
        'porque'   => 'Por eso la regla de actualizacion se ve igual: <code>&theta;&#8323; := &theta;&#8323; &minus; &alpha;&middot;&part;J/&part;&theta;&#8323;</code>. Cambiaste el modelo y la funcion de costo, pero reutilizas la misma maquinaria de optimizacion.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Regresión logística',
         '01reg_logistic.pptx y 02reg_logistic_mle.pptx — Prof. Milton Orlando Sarria Paja');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Las dos presentaciones de regresion logistica: la primera monta el modelo
     (sigmoide, frontera, odds, interpretacion de coeficientes) y la segunda explica
     de donde sale su <b>funcion de costo</b> (maxima verosimilitud &rarr; log loss) y
     como se minimiza.</p>
  <div class="nota">Respuestas conceptuales: <b>texto</b> (no importan mayusculas ni tildes).
    Lineas de <b>codigo</b>: si importan mayusculas. Los decimales aceptan punto o coma.</div>
</div>


<div class="card">
  <h2>1. Que es la regresion logistica</h2>

  <p>Es un tipo de regresion en la que la variable <b>dependiente</b> es
     <?php hueco(1, 10); ?>: solo tiene dos valores posibles
     (exito&ndash;falla, si&ndash;no, sano&ndash;enfermo).</p>

  <p>Lo que predice no es la clase directamente, sino la
     <?php hueco(2, 14); ?> de que una observacion pertenezca a una categoria
     especifica.</p>

  <table class="datos">
    <tr><th></th><th>Regresion lineal</th><th>Regresion logistica</th></tr>
    <tr><td>Variable dependiente</td>
        <td>es <?php hueco(3, 10); ?></td>
        <td>es binaria</td></tr>
    <tr><td>Sirve para</td>
        <td>predecir un valor numerico</td>
        <td><?php hueco(4, 14); ?></td></tr>
  </table>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. La funcion sigmoide</h2>

  <pre><code>            1                                                    1
σ(z) = ─────────        z = θ₀ + θ₁x₁ + … + θₙxₙ = θᵀx      p̂ = h(x) = σ(θᵀx) = ───────────
        1 + e⁻ᶻ                                                  1 + e⁻⁽θᵀˣ⁾</code></pre>

  <p>La funcion <?php hueco(5, 12); ?> toma cualquier numero real y lo aplasta dentro
     del intervalo (0, 1). En z = 0 vale <?php hueco(6, 5); ?>; cuando z tiende a
     +&infin; se acerca a <?php hueco(7, 3); ?> y cuando tiende a &minus;&infin; se acerca a
     <?php hueco(8, 3); ?>.</p>

  <p>Para decidir la clase se usa un umbral, normalmente
     <?php hueco(9, 5); ?>: si p&#770; &ge; ese valor &rarr; <b>1</b>, y si es menor &rarr; <b>0</b>.</p>

  <p>El conjunto de puntos donde el modelo duda (p&#770; = 0.5) se llama
     <?php hueco(10, 20); ?>, y corresponde justo a
     <code>&theta;&#7488;x = <?php hueco(11, 3); ?></code>. Con dos variables es una recta;
     a un lado quedan los de una categoria y al otro los de la otra.</p>

  <h4>En Python</h4>
  <?php linea(12, 'escriba la formula de la sigmoide para un valor (o vector) <code>z</code>, usando numpy', 'def sigmoide(z): return ...'); ?>

  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. El modelo en cuatro pasos</h2>
  <p>Asi resumen las diapositivas todo el proceso:</p>
  <ol>
    <li>Toma un problema de <?php hueco(13, 14); ?> (si/no, 0/1).</li>
    <li>Usa un modelo <?php hueco(14, 10); ?> para capturar la relacion entre las
        caracteristicas: <code>z = &theta;&#7488;x</code>.</li>
    <li>Pasa ese resultado por la funcion <?php hueco(15, 12); ?> para convertirlo en
        una probabilidad entre 0 y 1.</li>
    <li>Aplica un <?php hueco(16, 10); ?> de decision para asignar la clase final,
        creando asi una frontera que separa los grupos.</li>
  </ol>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Odds, log-odds y como se leen los coeficientes</h2>

  <pre><code>Odds = p / (1 − p)          Odds = e^(θᵀx)          ln( p / (1 − p) ) = θ₀ + θ₁x₁ + θ₂x₂ + …</code></pre>

  <p>Los <b>odds</b> son el cociente entre la probabilidad de
     <?php hueco(17, 8); ?> y la de <?php hueco(18, 9); ?>.</p>

  <table class="datos">
    <tr><th>Probabilidad</th><th>Odds</th><th>Como se dice</th></tr>
    <tr><td>p = 0.8</td><td><?php hueco(19, 5); ?></td>
        <td>el evento es 4 veces mas probable que su contrario</td></tr>
    <tr><td>p = 0.25</td><td><?php hueco(20, 7); ?></td>
        <td>por cada vez que ganas pierdes <?php hueco(21, 4); ?> (1:3, &laquo;3 a 1 en tu contra&raquo;)</td></tr>
  </table>

  <div class="nota">La probabilidad va de 0 a 1 y no es lineal en x; en cambio los
    <b>log-odds</b> si son una funcion <?php hueco(22, 8); ?> de las variables. Ese es el
    puente entre la recta de siempre y la curva en S.</div>

  <h3>Interpretacion directa (en <?php hueco(23, 12); ?>)</h3>
  <pre><code>ln(Odds de Diabetes) = −3.5 + 0.07 × Edad</code></pre>
  <p>Por cada ano adicional de edad, los log-odds de tener diabetes aumentan en
     <?php hueco(24, 6); ?> &mdash; algo que, como dice la diapositiva, no es nada intuitivo.</p>

  <h3>Interpretacion practica (el <b>Odds Ratio</b>)</h3>
  <p>Como <code>e<sup>a+b</sup> = e<sup>a</sup>&middot;e<sup>b</sup></code>, lo que era una suma
     en log-odds se vuelve una multiplicacion en odds. El OR de la edad es
     <code>e<sup>0.07</sup></code> &asymp; <?php hueco(25, 8); ?>.</p>

  <p>Si los odds de una persona de 50 anos son 2:1, para una de 51 anos son
     2 &times; 1.0725 = <?php hueco(26, 7); ?>.</p>

  <table class="datos">
    <tr><th>Caso</th><th>Conversion a porcentaje</th><th>Ejemplo</th></tr>
    <tr><td>OR &gt; 1</td><td>(OR &minus; 1) &times; 100%</td>
        <td>(1.0725 &minus; 1) &times; 100 = <?php hueco(27, 6); ?>%</td></tr>
    <tr><td>OR &lt; 1</td><td>(1 &minus; OR) &times; 100%</td>
        <td>OR = 0.80 &rarr; 20% menos</td></tr>
    <tr><td>OR = <?php hueco(30, 3); ?></td><td>no tiene efecto</td><td>e&#8304; = 1</td></tr>
  </table>

  <p>Variable binaria <code>&iquest;Es fumador?</code> con &theta; = 1.5:
     <code>e<sup>1.5</sup></code> &asymp; <?php hueco(28, 6); ?>, es decir un
     <?php hueco(29, 6); ?>% mas de odds.</p>

  <h4>En Python</h4>
  <?php linea(31, 'convierta los coeficientes de un modelo ya entrenado en Odds Ratios', 'odds_ratio = ...'); ?>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. De donde sale la funcion de costo (MLE)</h2>

  <p>Si metemos la sigmoide dentro del error cuadratico medio, la superficie de costo
     deja de ser <?php hueco(32, 10); ?> y se llena de minimos
     <?php hueco(33, 10); ?>, donde el gradiente descendente se puede quedar atrapado.</p>

  <p>La idea alternativa: &iquest;que valores de &theta; harian que los datos ya observados
     sean lo mas <?php hueco(34, 12); ?> posible? Eso es la estimacion por maxima
     <?php hueco(35, 14); ?> (MLE).</p>

  <pre><code>P(y | x; θ) = h(x)^y · (1 − h(x))^(1−y)        ← vale h si y=1, y 1−h si y=0

L(θ) = ∏ h(xⁱ)^yⁱ · (1 − h(xⁱ))^(1−yⁱ)

ℓ(θ) = log L(θ) = Σ [ yⁱ·log(h(xⁱ)) + (1 − yⁱ)·log(1 − h(xⁱ)) ]</code></pre>

  <p>La verosimilitud es un <?php hueco(36, 10); ?> de las probabilidades de todas las
     observaciones. Al tomar <?php hueco(37, 10); ?> se convierte en una
     <?php hueco(38, 8); ?>, mucho mas comoda de derivar.</p>

  <pre><code>          1
J(θ) = − ─── Σ [ yⁱ·log(h(xⁱ)) + (1 − yⁱ)·log(1 − h(xⁱ)) ]
          m</code></pre>

  <p>Esa funcion de costo se llama <?php hueco(39, 24); ?>. El signo menos sirve para
     <?php hueco(40, 10); ?> en vez de maximizar.</p>

  <?php mc('m8');  ?>
  <?php mc('m9');  ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Gradiente descendente</h2>

  <ol>
    <li>Inicializar los parametros &theta; (normalmente con valores aleatorios).</li>
    <li>Calcular el gradiente: la derivada parcial de J(&theta;) respecto a cada &theta;&#8323;.</li>
    <li>Actualizar dando un pequeno paso en la direccion <?php hueco(42, 10); ?> al gradiente.</li>
  </ol>

  <pre><code>θⱼ := θⱼ − α · ∂J/∂θⱼ            ∂J/∂θⱼ = (1/m) Σ ( h(xⁱ) − yⁱ ) · xⱼⁱ</code></pre>

  <p>El tamano del paso lo fija <?php hueco(41, 12); ?>. Y dentro de la sumatoria,
     <code>( h(x) &minus; y )</code> no es otra cosa que el
     <?php hueco(43, 8); ?> de cada prediccion.</p>

  <h4>En Python</h4>
  <?php linea(44, 'importe lo necesario para usar la <b>regresion logistica</b>'); ?>
  <?php linea(45, 'obtenga las <b>probabilidades</b> de la clase positiva (no la clase) para el conjunto de prueba', 'probas = ...'); ?>
  <?php ayuda('<code>predict()</code> ya aplica el umbral 0.5 y te devuelve clases; para la probabilidad hace falta la otra funcion, y su segunda columna es la de la clase 1.'); ?>

  <?php mc('m12'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', '');
