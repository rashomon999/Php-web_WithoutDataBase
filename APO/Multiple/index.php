<?php
/* ==========================================================================
   APO / Multiple  —  Regresion lineal multiple y polinomica
   Fuente: Python material regresion MULTIPLE - POLINOMIAL-20260918/
           Sesion3-2-multiple-polinomial.ipynb  (+ Advertising.csv, Temp_press_data.csv)
   Prof. Milton Orlando Sarria Paja, PhD.
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- 1. de la simple a la multiple --- */
    1  => ['dependiente', 'variable dependiente'],
    2  => ['multiples', 'varias', 'muchas'],
    3  => ['unidad', '1', 'una unidad'],
    4  => ['constantes', 'fijas'],
    5  => ['ceteris paribus'],
    6  => ['n+1', 'n + 1'],
    7  => ['unos', '1', 'unos (1)'],
    8  => ['intercepto', 'theta0', 'θ0', 'sesgo'],
    9  => ['ecuacion normal'],
    10 => ['descenso de gradiente', 'gradiente descendente', 'gradiente'],
    11 => ['columnas', 'variables'],
    12 => ['supuestos', 'supuestos teoricos'],
    13 => ['ajuste'],
    14 => ['inferencia', 'inferencia estadistica'],

    /* --- 2. multicolinealidad --- */
    15 => ['correlacionadas'],
    16 => ['explica'],
    17 => ['arbitraria', 'arbitraria e inestable'],
    18 => ['contraintuitivo', 'contraintuitivos', 'contrario', 'opuesto'],
    19 => ['inflacion'],
    20 => ['varianza'],
    21 => ['5'],
    22 => ['singular', 'no invertible'],
    23 => ['infinitas'],
    24 => ['variance_inflation_factor(X_multi.values, i)'],
    25 => ['predicciones'],
    26 => ['inestables'],

    /* --- 3. train / test --- */
    27 => ['memorizar'],
    28 => ['sobreajuste', 'overfitting'],
    29 => ['generalizar'],
    30 => ['0.3', '0,3', '.3'],
    31 => ['reproducibilidad'],
    32 => ['70'],

    /* --- 4. caso Advertising: TV -> Sales --- */
    33 => ['47.689', '47,689', '47.7', '47,7', '47.69', '47,69'],
    34 => ['asociativa', 'correlacional'],
    35 => ['9.55', '9,55', '9.546', '9,546', '9.5463', '9.546336', '9.5'],
    36 => ['constante'],
    37 => ['embudo', 'cono'],
    38 => ['rechazamos', 'se rechaza', 'rechazar', 'rechaza'],
    39 => ['insesgados'],
    40 => ['logaritmo', 'log'],
    41 => ['raiz cuadrada', 'sqrt'],
    42 => ['grandes'],
    43 => ['porcentuales', 'porcentual', 'multiplicativos'],
    44 => ['(np.exp(m_log_y.params[\'TV\']) - 1) * 100',
           '(np.exp(m_log_y.params["TV"]) - 1) * 100',
           '100 * (np.exp(m_log_y.params[\'TV\']) - 1)',
           '100 * (np.exp(m_log_y.params["TV"]) - 1)'],
    45 => ['0.379', '0,379', '0.379%', '0,379%', '0.38', '0,38'],

    /* --- 5. varias variables --- */
    46 => ['2.66', '2,66', '2.6595', '2,6595', '2.659', '2,659'],
    47 => ['0.831', '0,831'],
    48 => ['relacion'],
    49 => ['cero', '0'],
    50 => ['0.05', '0,05', '5%'],

    /* --- 6. polinomica --- */
    51 => ['parametros', 'parametros theta'],
    52 => ['x'],
    53 => ['y'],
    54 => ['entrenamiento', 'train'],
    55 => ['ruido'],
    56 => ['prueba', 'test'],
    57 => ['extrapolar', 'extrapolacion'],
    58 => ['X_poly = np.column_stack((x, x**2, x**3))'],
    59 => ['negativas'],
    60 => ['subajusta', 'subajuste', 'underfitting'],
    61 => ['1.77', '1,77', '1.7686', '1,7686', '1.769', '1,769'],
    62 => ['complementarias'],
    63 => ['feature engineering', 'ingenieria de caracteristicas'],

    /* --- 7. las diapositivas: notacion vectorial y el truco polinomico --- */
    64 => ['1', 'uno'],
    65 => ['punto', 'escalar', 'producto punto', 'interno'],
    66 => ['2m', '2 m'],
    67 => ['error'],
    68 => ['caracteristicas', 'variables', 'features'],
    69 => ['grado'],
    70 => ['multiple'],
    71 => ['sobreajuste', 'overfitting'],
];

/* los que se comparan como texto (sin mayusculas ni tildes) */
$TEXTO = array_values(array_diff(range(1, 71), [24, 44, 58]));

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En <code>Sales = θ₀ + θ₁·TV + θ₂·Radio</code>, &iquest;que significa exactamente θ₂?',
        'opciones' => [
            'a' => 'Cuanto cambia Sales cuando Radio sube una unidad, sin importar lo que haga TV',
            'b' => 'El cambio esperado en Sales cuando Radio sube una unidad <b>manteniendo TV constante</b>',
            'c' => 'La correlacion entre Radio y Sales',
            'd' => 'El porcentaje de Sales explicado por Radio'
        ],
        'porque'   => 'Esa coletilla &laquo;manteniendo constantes las demas&raquo; (<i>ceteris paribus</i>) es lo que distingue a la multiple de la simple: cada coeficiente es el efecto de <b>esa</b> variable <b>descontando</b> a las otras que ya estan en el modelo. Por eso el mismo θ de TV puede cambiar si agregas o quitas Radio.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Los datos se generaron con θ₁ = 3 y θ₂ = 1.5 (ambos positivos), pero con x1 y x2 casi identicas el modelo estima <b>−21.21</b> y <b>25.75</b>. &iquest;Que significa el −21.21?',
        'opciones' => [
            'a' => 'Que x1 tiene en realidad un efecto negativo sobre y',
            'b' => 'Nada interpretable: como x1 y x2 llevan la misma informacion, el modelo no puede separarlas y <b>reparte el efecto combinado</b> de forma arbitraria (fijate que −21.21 + 25.75 ≈ 4.5 = 3 + 1.5)',
            'c' => 'Que hay un error en statsmodels',
            'd' => 'Que hay que subir el tamano de la muestra a 1000'
        ],
        'porque'   => 'La <b>suma</b> sigue siendo correcta; lo que se rompe es el <b>reparto</b>. Por eso la multicolinealidad no dana las predicciones pero si la interpretacion de cada coeficiente. Otras senales del notebook: errores estandar enormes (≈11.1), <code>Cond. No.</code> alto y correlacion 0.99999 entre x1 y x2.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Tu dataset tiene &laquo;ingreso mensual&raquo; e &laquo;ingreso anual&raquo; del mismo cliente. &iquest;Que haces?',
        'opciones' => [
            'a' => 'Dejar ambas, mas variables siempre es mejor',
            'b' => '<b>Quitar una</b>: una es la otra por 12 (relacion deterministica), asi que es multicolinealidad <b>perfecta</b> y no aporta informacion nueva',
            'c' => 'Multiplicarlas entre si',
            'd' => 'Usar solo el intercepto'
        ],
        'porque'   => 'Es la pregunta de reflexion de la seccion 2.4. Con X2 = X1/2 y X3 = X1/5 la matriz Xᵀ·X es <b>singular</b>: hay infinitas soluciones con el mismo ajuste y statsmodels devuelve <em>alguna</em> (via pseudo-inversa) cuyos coeficientes no significan nada. Este caso es mas facil de detectar que el anterior porque la correlacion es <b>exactamente</b> 1.',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'En Advertising, <code>Newspaper</code> no es significativo (p = 0.831). El VIF de TV, Radio y Newspaper es ≈ 1.0–1.15. &iquest;Que concluyes?',
        'opciones' => [
            'a' => 'Newspaper no sale significativo porque compite con Radio',
            'b' => 'Como no hay multicolinealidad, la falta de significancia es real: Newspaper <b>no aporta informacion predictiva adicional</b> una vez estan TV y Radio',
            'c' => 'Que el VIF esta mal calculado',
            'd' => 'Que hay que quitar TV'
        ],
        'porque'   => 'El VIF sirve justo para descartar la otra explicacion. En el ejemplo sintetico si habia &laquo;competencia&raquo; entre variables; aqui no. (El VIF alto de <code>const</code>, 6.85, no se interpreta.)',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => '<code>train_test_split(X, y, ...)</code> devuelve cuatro cosas. &iquest;En que orden?',
        'opciones' => [
            'a' => '<code>X_train, y_train, X_test, y_test</code>',
            'b' => '<code>X_train, X_test, y_train, y_test</code>',
            'c' => '<code>X_test, X_train, y_test, y_train</code>',
            'd' => '<code>y_train, y_test, X_train, X_test</code>'
        ],
        'porque'   => 'Primero las dos partes de X (train, test) y luego las dos de y, en el mismo orden en que le pasaste X e y. Equivocar el orden no da error: entrenas con el test sin darte cuenta.',
        'correcta' => 'b'
    ],
    'm6' => [
        'texto'    => 'Comparando transformaciones contra Breusch-Pagan: <code>log(Sales)~log(TV)</code> tiene el <b>mejor R²</b> (0.742, p = 0.0014) y <code>log(Sales)~TV</code> tiene R² 0.616 con p = 0.274. &iquest;Cual se elige y por que?',
        'opciones' => [
            'a' => 'log-log, porque tiene mejor R²',
            'b' => '<b>log(Sales) ~ TV</b>: es el unico en que <b>no se rechaza</b> la homocedasticidad (p &gt; 0.05), que era el problema que motivo transformar',
            'c' => 'sqrt(Sales) ~ TV, porque esta en medio',
            'd' => 'El original, porque no hay que transformar'
        ],
        'porque'   => 'Idea clave de la sesion: <b>la transformacion que mas sube el R² no es necesariamente la que corrige el supuesto</b>. Depende del objetivo: ajuste vs. validez de la inferencia. A veces toca un compromiso.',
        'correcta' => 'b'
    ],
    'm7' => [
        'texto'    => 'En el modelo <b>log-lineal</b> <code>log(Sales) = θ₀ + θ₁·TV</code>, &iquest;que cambia respecto al modelo original?',
        'opciones' => [
            'a' => 'Nada, θ₁ se sigue leyendo en unidades de venta',
            'b' => 'θ₁ pasa a leerse como un cambio <b>porcentual</b>: cada $1,000 en TV sube las ventas ≈ 0.379%, y eso es el mismo porcentaje para un mercado grande que para uno pequeno',
            'c' => 'θ₁ ahora es el logaritmo del efecto en unidades',
            'd' => 'Ya no se puede interpretar'
        ],
        'porque'   => '&laquo;Corregir un supuesto no es gratis&raquo;: cambia como le comunicas el resultado al negocio. Antes eran 47.7 unidades fijas; ahora es un efecto <b>multiplicativo</b>, que suele ser mas natural para ventas o ingresos (crecen en proporcion, no en cantidades fijas).',
        'correcta' => 'b'
    ],
    'm8' => [
        'texto'    => 'Al pasar de TV+Radio (MSE 2.6595) a TV+Radio+Newspaper, el MSE de prueba sube a 2.6698. &iquest;Como puede empeorar si agregas informacion?',
        'opciones' => [
            'a' => 'Es un error de redondeo',
            'b' => 'Porque Newspaper no aporta senal nueva: el modelo solo gana un parametro mas para ajustar <b>ruido</b> del train, y eso se paga un poco en el test',
            'c' => 'Porque Newspaper tiene valores negativos',
            'd' => 'Porque el MSE siempre sube con mas variables'
        ],
        'porque'   => 'En el <b>entrenamiento</b> agregar variables nunca empeora el ajuste; en <b>prueba</b> si puede. Por eso se compara siempre sobre el mismo <code>X_test</code>/<code>y_test</code>. Y cuadra con el p = 0.831.',
        'correcta' => 'b'
    ],
    'm9' => [
        'texto'    => '<code>Pressure ~ T + T⁴</code> dibuja una curva. &iquest;Por que se sigue llamando modelo <b>lineal</b>?',
        'opciones' => [
            'a' => 'Porque T sigue apareciendo sin exponente',
            'b' => 'Porque es lineal <b>en los parametros</b> θ: T⁴ es solo una columna mas de X, y se resuelve con la misma ecuacion normal / gradiente. Lo no lineal es la relacion entre x e y',
            'c' => 'Es un error, es un modelo no lineal',
            'd' => 'Porque el MSE es lineal'
        ],
        'porque'   => 'Para OLS no hay diferencia entre una columna &laquo;TV&raquo; y una columna &laquo;TV²&raquo;: ambas son numeros que se multiplican por un θ y se suman. Por eso sirve <code>np.column_stack((x, x**2, x**3))</code> + <code>sm.OLS</code> sin nada nuevo.',
        'correcta' => 'b'
    ],
    'm10' => [
        'texto'    => 'Agregar TV² y TV³ baja el MSE solo de 9.94 a 9.73, pero agregar <b>Radio</b> lo baja a 2.66. &iquest;Que te dice eso?',
        'opciones' => [
            'a' => 'Que la polinomica esta mal implementada',
            'b' => 'Que TV → Sales es a lo sumo <b>debilmente no lineal</b>; lo que le faltaba al modelo no era curvatura sino una <b>variable</b> (Radio)',
            'c' => 'Que Radio es una transformacion de TV',
            'd' => 'Que hay que subir el grado a 15'
        ],
        'porque'   => 'Antes de complicar la forma funcional, pregunta si falta informacion. El mejor modelo combina las dos ideas: <code>TV + sqrt(TV) + Radio</code> con MSE 1.77 (&gt;80% mejor que el simple).',
        'correcta' => 'b'
    ],
    'm11' => [
        'texto'    => 'Con un polinomio de <b>grado 15</b> sobre TV, frente al de grado 3, &iquest;que esperas?',
        'opciones' => [
            'a' => 'Menor MSE en train y en test',
            'b' => 'MSE de <b>entrenamiento</b> menor (o igual), pero MSE de <b>prueba</b> probablemente mayor: el polinomio empieza a ajustar ruido (sobreajuste)',
            'c' => 'Mayor MSE en train y en test',
            'd' => 'El mismo MSE, el grado no importa'
        ],
        'porque'   => 'Es el ejercicio de reflexion 3. Mas grado = mas flexibilidad = pasa mas cerca de cada punto observado. Ademas, fuera del rango de x los polinomios altos se vuelven erraticos, por eso <b>no se extrapola</b>.',
        'correcta' => 'b'
    ],
    'm12' => [
        'texto'    => '&iquest;Para que se define <code>x&#8320; = 1</code> dentro del vector de caracteristicas?',
        'opciones' => [
            'a' => 'Para normalizar las variables',
            'b' => 'Para que el intercepto &theta;&#8320; entre en el producto <code>&theta;&#7488;x</code> como un termino mas y todo el modelo quepa en una sola multiplicacion de vectores',
            'c' => 'Porque la primera variable siempre vale 1',
            'd' => 'Para contar el numero de observaciones'
        ],
        'porque'   => 'Es exactamente lo que hace <code>sm.add_constant()</code>: <code>&theta;&#8320;(1) + &theta;&#8321;x&#8321; + &hellip;</code>. Sin esa columna de unos el intercepto se quedaria fuera de la notacion matricial.',
        'correcta' => 'b'
    ],
    'm13' => [
        'texto'    => 'La ultima diapositiva de regresion polinomica muestra un ajuste de <b>grado 15</b> que sube y baja pegandose a cada punto. &iquest;Que ilustra?',
        'opciones' => [
            'a' => 'Que el grado 15 es el mejor modelo posible',
            'b' => 'El <b>sobreajuste</b>: el modelo memoriza el ruido de los datos de entrenamiento y entre punto y punto hace cualquier cosa, asi que generaliza pesimo',
            'c' => 'Que faltan variables en el modelo',
            'd' => 'Que los datos estan mal escalados'
        ],
        'porque'   => 'Mas grado = mas flexibilidad = menos error de entrenamiento, pero llega un punto en que lo que se esta ajustando es el ruido. Por eso el grado se elige mirando el conjunto de <b>prueba</b>.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Regresión múltiple y polinómica',
         'Sesion3-2-multiple-polinomial.ipynb — Prof. Milton Orlando Sarria Paja');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>El notebook de la sesion 3-2 extiende la regresion simple en <b>dos direcciones</b>:</p>
  <ol>
    <li><b>Multiple</b> — meter varias variables predictoras (TV, Radio, Newspaper).</li>
    <li><b>Polinomica</b> — permitir curvas (x², x³, √x) sin salir de OLS.</li>
  </ol>
  <p>En medio: multicolinealidad, particion train/test, heterocedasticidad en el caso
     Advertising y como cambia la interpretacion al transformar.</p>
  <div class="nota">Respuestas conceptuales: <b>texto</b> (no importan mayusculas ni tildes).
    Lineas de <b>codigo</b>: si importan mayusculas. Los decimales aceptan punto o coma.</div>
</div>


<div class="card">
  <h2>1. De la simple a la multiple</h2>

  <pre><code>h(x) = θ₀ + θ₁·x₁ + θ₂·x₂ + … + θₙ·xₙ          y = X·θ + ε</code></pre>

  <p>La <b>regresion lineal multiple</b> modela la relacion entre una variable
     <?php hueco(1, 12); ?> y <?php hueco(2, 10); ?> variables independientes.</p>

  <p>Cada θⱼ es el cambio esperado en y ante un incremento de una
     <?php hueco(3, 8); ?> en xⱼ, manteniendo <?php hueco(4, 11); ?> las demas
     variables. Esa lectura se llama <i><?php hueco(5, 14); ?></i>.</p>

  <p>En forma matricial, <b>X</b> tiene dimension m × <?php hueco(6, 5); ?>: una fila por
     observacion y, como primera columna, un vector de <?php hueco(7, 6); ?> para
     incluir el <?php hueco(8, 11); ?> θ₀.
     <?php ayuda('n variables + 1 columna extra. Es justo lo que agrega <code>sm.add_constant()</code>.'); ?></p>

  <p>Para minimizar J(θ) se usa lo mismo que en la simple: la
     <?php hueco(9, 15); ?> θ = (XᵀX)⁻¹Xᵀy, o el <?php hueco(10, 20); ?>.
     Lo unico que cambia es que X ahora tiene mas <?php hueco(11, 10); ?>.</p>

  <div class="nota">Un R² alto <b>no</b> garantiza que se cumplan los
    <?php hueco(12, 10); ?> del modelo: el R² mide el <?php hueco(13, 8); ?>
    de las predicciones, no si la <?php hueco(14, 11); ?> (p-valores, intervalos)
    es confiable.</div>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Multicolinealidad</h2>

  <p>Aparece cuando dos variables independientes estan altamente
     <?php hueco(15, 14); ?>: el modelo no puede distinguir cual de las dos
     <?php hueco(16, 8); ?> la variacion de y, y reparte el efecto de forma
     <?php hueco(17, 10); ?>.</p>

  <p>En el experimento (x2 = x1 + ruido minimo) los coeficientes salen con signo
     <?php hueco(18, 14); ?> y con errores estandar enormes.</p>

  <?php mc('m2'); ?>

  <h3>Como se diagnostica</h3>
  <p>Ademas de la matriz de correlacion, el <b>VIF</b> — Factor de
     <?php hueco(19, 10); ?> de la <?php hueco(20, 9); ?> — cuantifica cuanto se infla
     la varianza del coeficiente de xⱼ por su correlacion con las demas predictoras.
     Regla practica: VIF &gt; <?php hueco(21, 3); ?> (o 10) es problematico.</p>

  <pre><code>vif_data['VIF'] = [ ______________________________ for i in range(X_multi.shape[1])]</code></pre>
  <?php linea(24, 'calcule, para la columna <code>i</code>, el indicador que mide cuanto se infla la varianza de su coeficiente (la matriz se pasa en formato numpy)'); ?>

  <h3>El caso extremo: multicolinealidad perfecta</h3>
  <p>Con X2 = X1/2 y X3 = X1/5 las tres columnas tienen exactamente la misma informacion.
     Entonces XᵀX es <?php hueco(22, 10); ?> (no invertible) y hay
     <?php hueco(23, 10); ?> combinaciones de θ con el mismo ajuste.</p>

  <p>Resumen: la multicolinealidad no sesga las <?php hueco(25, 12); ?> globales del
     modelo, pero vuelve los coeficientes individuales <?php hueco(26, 10); ?> y dificiles
     de interpretar.</p>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Particion train / test</h2>

  <p>Si entrenas y evaluas con los mismos datos, el modelo puede simplemente
     <?php hueco(27, 10); ?> las respuestas: eso es el <?php hueco(28, 12); ?>.
     El objetivo no es acertar lo ya visto sino <?php hueco(29, 11); ?> a datos nuevos.
     <?php ayuda('La analogia del notebook: el train son las tareas; el test es el examen final con preguntas que nunca viste.'); ?></p>

  <pre><code>X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=42)</code></pre>

  <p><code>test_size=</code><?php hueco(30, 4); ?> deja el 30% para prueba.
     Fijar <code>random_state</code> sirve para la <?php hueco(31, 16); ?>: siempre sale
     la misma division. Con un df de 100 filas y 3 features,
     <code>X_train.shape</code> da (<?php hueco(32, 4); ?>, 3).</p>

  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Caso Advertising: TV → Sales</h2>
  <p>200 mercados; TV, Radio y Newspaper en <b>miles de dolares</b>, Sales en
     <b>miles de unidades</b>. Modelo simple con train/test 70/30:</p>

  <pre><code>const    7.161893
TV       0.047689</code></pre>

  <p>Gastar $1,000 adicionales en TV se asocia con <?php hueco(33, 7); ?> unidades
     mas de venta. Es una interpretacion <?php hueco(34, 11); ?>, no necesariamente causal.</p>

  <p>Para un mercado con $50,000 en TV (<code>TV = 50</code>) el modelo predice
     <?php hueco(35, 6); ?> (miles de unidades).
     <?php ayuda('7.161893 + 0.047689 × 50'); ?></p>

  <h3>Heterocedasticidad</h3>
  <p>La homocedasticidad supone que la varianza de los errores es
     <?php hueco(36, 10); ?>. En el grafico de residuos vs. ajustados de TV → Sales se ve
     un patron de <?php hueco(37, 8); ?>: residuos pequenos con poco gasto y cada vez mas
     dispersos al subir el gasto.</p>

  <p>Breusch-Pagan da p ≈ 4.18·10⁻¹², asi que <?php hueco(38, 11); ?> H₀ (homocedasticidad).
     Los coeficientes siguen siendo <?php hueco(39, 10); ?>; lo que deja de ser confiable son
     los errores estandar, p-valores e intervalos del <code>summary()</code>.</p>

  <h3>Transformar para estabilizar la varianza</h3>
  <p>Las transformaciones mas comunes son el <?php hueco(40, 10); ?> y la
     <?php hueco(41, 13); ?>, que comprimen los valores <?php hueco(42, 8); ?> mas que los
     pequenos.</p>

  <table class="datos">
    <tr><th>Modelo</th><th>R²</th><th>p Breusch-Pagan</th></tr>
    <tr><td>Sales ~ TV</td><td>0.612</td><td>4.2·10⁻¹²</td></tr>
    <tr><td>log(Sales) ~ TV</td><td>0.616</td><td>0.274</td></tr>
    <tr><td>sqrt(Sales) ~ TV</td><td>0.633</td><td>0.0008</td></tr>
    <tr><td>log(Sales) ~ log(TV)</td><td>0.742</td><td>0.0014</td></tr>
  </table>

  <?php mc('m6'); ?>

  <h3>Reinterpretar el coeficiente</h3>
  <p>En <code>log(Sales) ~ TV</code> (θ₁ = 0.003787) la lectura pasa a terminos
     <?php hueco(43, 12); ?>. La version exacta es 100·(e^θ₁ − 1)%:</p>
  <?php linea(44, 'calcule el cambio porcentual exacto a partir del coeficiente de TV de <code>m_log_y.params</code>', 'cambio_porcentual = ...'); ?>
  <p>Resultado: cada $1,000 mas en TV ≈ <?php hueco(45, 6); ?>% mas ventas.</p>

  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Agregando Radio y Newspaper</h2>

  <table class="datos">
    <tr><th>Modelo</th><th>MSE (test)</th></tr>
    <tr><td>solo TV</td><td>9.94</td></tr>
    <tr><td>TV + Radio</td><td><?php hueco(46, 6); ?></td></tr>
    <tr><td>TV + Radio + Newspaper</td><td>2.67</td></tr>
  </table>

  <p>La <b>hipotesis nula</b> de cada coeficiente dice que no hay
     <?php hueco(48, 9); ?> entre esa variable y el objetivo, es decir, que su coeficiente
     verdadero es <?php hueco(49, 5); ?>. Si el p-valor es menor a
     <?php hueco(50, 5); ?> la variable es significativa.</p>

  <p>TV y Radio salen con p &lt; 0.001. Newspaper sale con p = <?php hueco(47, 6); ?>.</p>

  <?php mc('m8'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Regresion polinomica</h2>

  <pre><code>h(x) = θ₀ + θ₁x + θ₂x² + θ₃x³ + … + θₙxⁿ</code></pre>

  <p>Sigue siendo un modelo <b>lineal en los</b> <?php hueco(51, 11); ?>; lo que deja de ser
     lineal es la relacion entre <?php hueco(52, 3); ?> y <?php hueco(53, 3); ?>.</p>

  <p>Subir el grado siempre reduce (o no aumenta) el error de
     <?php hueco(54, 13); ?>, pero un grado alto termina ajustando el
     <?php hueco(55, 7); ?> en vez de la tendencia. Por eso el grado se elige con el error del
     conjunto de <?php hueco(56, 8); ?>, y hay que evitar <?php hueco(57, 11); ?> fuera del
     rango observado de x.</p>

  <p>Crear a mano las columnas de grado 3 a partir de <code>x</code>:</p>
  <?php linea(58, 'arme la matriz de caracteristicas apilando como columnas x, x&sup2; y x&sup3;', 'X_poly = ...'); ?>

  <?php mc('m9'); ?>

  <h3>Temperatura y presion</h3>
  <p>La recta sobre <code>Temp_press_data.csv</code> predice presiones
     <?php hueco(59, 10); ?> para temperaturas bajas (sin sentido fisico): el modelo
     <?php hueco(60, 10); ?> los datos. Agregando T⁴ el MSE pasa de 0.00287 a 0.0000337.</p>

  <h3>Volviendo a Advertising</h3>
  <table class="datos">
    <tr><th>Modelo</th><th>Variables</th><th>MSE (test)</th></tr>
    <tr><td>Lineal simple</td><td>TV</td><td>9.94</td></tr>
    <tr><td>Polinomico grado 3</td><td>TV, TV², TV³</td><td>9.73</td></tr>
    <tr><td>Raiz</td><td>√TV</td><td>9.80</td></tr>
    <tr><td>Multiple</td><td>TV, Radio</td><td>2.66</td></tr>
    <tr><td><b>Multiple + polinomico</b></td><td>TV, √TV, Radio</td><td><?php hueco(61, 6); ?></td></tr>
  </table>

  <?php mc('m10'); ?>

  <p>Conclusion: regresion multiple y polinomica no son alternativas excluyentes sino
     herramientas <?php hueco(62, 15); ?>. Y transformar variables (log, √, potencias) es lo
     que en Machine Learning se llama <i><?php hueco(63, 20); ?></i>.</p>

  <?php mc('m11'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<div class="card">
  <h2>7. Lo mismo en las diapositivas: notacion vectorial</h2>
  <p>Las presentaciones <code>00reg_multiple.pptx</code> y <code>reg_poli_.pptx</code> cuentan
     esta misma historia, pero escrita con vectores.</p>

  <pre><code>      ⎛θ₀⎞            ⎛x₀⎞   ⎛1 ⎞
      ⎜θ₁⎟            ⎜x₁⎟   ⎜x₁⎟
  θ = ⎜θ₂⎟        x = ⎜x₂⎟ = ⎜x₂⎟            ŷ = θᵀx
      ⎜⋮ ⎟            ⎜⋮ ⎟   ⎜⋮ ⎟
      ⎝θₙ⎠            ⎝xₙ⎠   ⎝xₙ⎠</code></pre>

  <p>En el <b>vector de caracteristicas</b> la primera componente siempre vale
     <?php hueco(64, 4); ?>, para que <code>&theta;&#8320;</code> pueda multiplicarse por algo.
     La ecuacion vectorial <code>&#375; = &theta;&#7488;x</code> no es mas que un producto
     <?php hueco(65, 10); ?> entre los dos vectores:
     <code>&theta;&#8320;(1) + &theta;&#8321;x&#8321; + &hellip; + &theta;&#8345;x&#8345;</code>.</p>

  <?php mc('m12'); ?>

  <h3>La funcion objetivo (otra vez)</h3>
  <pre><code>          1    m                              1    m
J(θ) =  ───── Σ (ŷᵢ − yᵢ)²        J(θ) =  ───── Σ (θᵀx⁽ⁱ⁾ − yᵢ)²
          2m  i=1                            2m  i=1</code></pre>

  <p>Es la misma de la regresion simple: el promedio (dividido entre
     <?php hueco(66, 5); ?>) de los cuadrados del <?php hueco(67, 8); ?>, es decir,
     de la diferencia entre lo que predice el modelo y el valor real.</p>

  <h3>El truco genial de la polinomica</h3>
  <p>En vez de inventar un modelo nuevo, se crean nuevas
     <?php hueco(68, 16); ?> elevando la variable original a distintas potencias:</p>

  <pre><code>h(x) = θ₀ + θ₁x₁ + θ₂x₂ + θ₃x₃
     = θ₀ + θ₁(size) + θ₂(size)² + θ₃(size)³          x_poly = (1, x, x², …, x^d)</code></pre>

  <p>Asi, una regresion <b>no lineal con una sola variable</b> se convierte en una regresion
     lineal <?php hueco(70, 10); ?> con varias caracteristicas, y en
     <code>&#375; = &theta;&#8320; + &theta;&#8321;x + &theta;&#8322;x&sup2; + &hellip; + &theta;&#8340;x&#7496;</code>
     la letra d es el <?php hueco(69, 8); ?> del polinomio.</p>

  <div class="nota">La diapositiva final muestra un ajuste de grado 15 que serpentea entre los
    puntos: el recordatorio de que subir el grado sin control lleva al
    <?php hueco(71, 12); ?>.</div>

  <?php mc('m13'); ?>
  <?php enviar('Verificar esta parte'); ?>
</div>

<?php
pie('../Menu.php', '');
