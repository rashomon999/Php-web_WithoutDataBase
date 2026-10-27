<?php
/* ==========================================================================
   APO / Metricas / Regularizacion  —  Ridge, Lasso y Elastic Net
   Fuentes: diap_regu.pdf (secciones 03-04 y el ejemplo de 11 pasos)
            · Sesion5-1_Regularizacion.ipynb (secciones 2-7 y 10) — contrastadas
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. norma p */
    1  => ['valores absolutos', 'absolutos'],
    2  => ['euclidiana', 'longitud', 'magnitud'],
    3  => ['maximo'],

    /* 2. costo */
    4  => ['cuadrado', 'al cuadrado'],
    5  => ['grandes', 'grande'],
    6  => ['w0', 'el intercepto', 'intercepto', 'w_0', 'theta0', 'θ0'],
    7  => ['lasso'],
    8  => ['ridge'],
    9  => ['selection', 'seleccion'],

    /* 3. lambda */
    10 => ['ningun efecto', 'no tiene efecto', 'nada', 'ninguno', 'ninguna'],
    11 => ['pequenos', 'mas pequenos', 'chicos'],
    12 => ['subajuste', 'underfitting', 'sub ajuste'],
    13 => ['alpha'],
    14 => ['inverso', 'el inverso', '1/lambda', '1/λ', 'inverso de lambda', 'inverso de λ'],
    15 => ['np.inf'],

    /* 4. ejemplo ridge */
    16 => ['1.69', '1,69'],
    17 => ['0.74', '0,74'],
    18 => ['azul', 'la azul', 'linea azul', 'recta azul'],
    19 => ['varianza'],
    20 => ['sensible'],
    21 => ['infinitas', 'infinitas rectas', 'muchas'],

    /* 5. geometria */
    22 => ['circulo', 'circular', 'circunferencia', 'esfera'],
    23 => ['diamante', 'rombo'],
    24 => ['ejes', 'eje', 'ejes coordenados'],

    /* 6. comparacion */
    25 => ['correlacionadas', 'correlacion', 'multicolinealidad'],
    26 => ['arbitrariamente', 'al azar', 'arbitraria'],
    27 => ['lasso'],
    28 => ['ridge'],
    29 => ['grupo', 'todo el grupo', 'todas'],

    /* 7. practica */
    30 => ['estandarizar', 'escalar', 'estandarizacion', 'escalado'],
    31 => ['5', 'cinco'],
    32 => ['LassoCV(alphas=np.logspace(-3, 3, 50), cv=5)', 'LassoCV(alphas=np.logspace(-3,3,50), cv=5)'],
    33 => ['ElasticNet(alpha=0.1, l1_ratio=0.5)'],
];
$TEXTO = array_values(array_diff(range(1, 33), [15, 32, 33]));

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En <code>LogisticRegression</code> subes <code>C</code> de 1 a 100. &iquest;Que pasa con la regularizacion?',
        'opciones' => [
            'a' => 'Aumenta, porque C es como &lambda;',
            'b' => '<b>Disminuye</b>: C es el inverso de &lambda;; C grande = penalizacion debil, coeficientes mas libres (mas riesgo de sobreajuste)',
            'c' => 'No cambia, C solo afecta el umbral',
            'd' => 'Pasa de L2 a L1'
        ],
        'porque'   => 'Por eso en el notebook la logistica "sin regularizar" se escribe con <code>C=np.inf</code>. En <code>Ridge</code>/<code>Lasso</code> el parametro es <code>alpha</code> y va al reves: mas alpha, mas regularizacion.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'En el ejemplo grafico de la diapositiva se sube &lambda; hasta 1000. &iquest;Que diferencia hay entre Ridge y Lasso?',
        'opciones' => [
            'a' => 'Ninguna, las dos llevan la pendiente a cero',
            'b' => 'Con <b>Lasso la pendiente puede llegar a 0</b> (la variable desaparece); con <b>Ridge</b> se acerca a 0 cada vez mas pero <b>no llega</b>',
            'c' => 'Ridge lleva la pendiente a 0 y Lasso no',
            'd' => 'Las dos dejan la pendiente igual'
        ],
        'porque'   => 'Es lo que se ve en la trayectoria de coeficientes del notebook: en Ridge bajan suave y ninguno toca el 0; en Lasso van cayendo a 0 uno por uno y se quedan ahi.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Un colega dice: "Siempre deberiamos usar Elastic Net, porque combina lo mejor de Ridge y Lasso". &iquest;Que se le responde (ejercicio final del notebook)?',
        'opciones' => [
            'a' => 'Tiene razon, Elastic Net siempre gana',
            'b' => 'No siempre: Elastic Net tiene <b>dos hiperparametros</b> (alpha y l1_ratio) que hay que buscar con validacion cruzada, cuesta mas, y si solo interesa un modelo escueto e interpretable, Lasso puede bastar',
            'c' => 'Elastic Net no sirve para regresion',
            'd' => 'Elastic Net es lo mismo que Ridge'
        ],
        'porque'   => 'En el propio notebook, en diabetes, el mejor MSE de prueba lo saco LassoCV (2801,69), no ElasticNetCV (2858,68).',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => '&iquest;Por que hay que <b>estandarizar antes</b> de usar Ridge o Lasso?',
        'opciones' => [
            'a' => 'Para que el modelo entrene mas rapido',
            'b' => 'Porque la penalizacion trata igual a todos los coeficientes sin conocer las unidades: una variable de escala grande tiene coeficiente chico "solo por la escala" y la penalizacion seria injusta con las de escala pequena',
            'c' => 'Porque Lasso no acepta numeros negativos',
            'd' => 'No hace falta'
        ],
        'porque'   => 'Es el mismo argumento que para KNN, SVM, K-means y PCA. El escalador se ajusta con entrenamiento (<code>fit_transform</code>) y solo se aplica a prueba (<code>transform</code>).',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => '<span class="tag-contra">Contraste</span> En el caso Auto MPG, el texto del notebook dice que Lasso elimino <code>cylinders</code>, <code>displacement</code> y <code>origin</code>. La salida del codigo imprime <code>Coeficientes Lasso: [-0. -0. -0.174 -4.792 0. 2.454 0.584]</code>. &iquest;Que variables elimino de verdad?',
        'antes_opciones' => '<p style="font-size:13px;color:#555">Orden de las columnas: cylinders, displacement, horsepower, weight, acceleration, model year, origin.</p>',
        'opciones' => [
            'a' => 'cylinders, displacement y origin, como dice el texto',
            'b' => '<b>cylinders, displacement y acceleration</b>: los ceros estan en las posiciones 1, 2 y 5; origin conserva 0,584',
            'c' => 'Solo weight',
            'd' => 'Ninguna, los "-0." no son ceros'
        ],
        'porque'   => 'La propia celda lo imprime: <code>Variables eliminadas por Lasso: [\'cylinders\', \'displacement\', \'acceleration\']</code>. El texto tiene un error. La idea si es correcta: cylinders y displacement son redundantes con horsepower y weight. "-0." es cero (con signo).',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Metricas 2 — Regularizacion: Ridge, Lasso y Elastic Net',
         'diap_regu.pdf · Sesion5-1_Regularizacion.ipynb');
?>

<style>
.tag-contra{display:inline-block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.4px;
  padding:1px 8px;border-radius:12px;margin-right:6px;vertical-align:1px;background:#fff4e0;color:#b5730a}
</style>

<div class="card">
  <h2>De que va esto</h2>
  <p>La formula, la intuicion grafica, la geometria, cuando usar cada una y como escoger &lambda;.
     Del repaso del parcial 1 ya salieron: que Lasso puede dejar coeficientes en 0, su penalizacion L1 y que pasa con &lambda; muy grande; aqui no se repiten.</p>
  <div class="nota">Respuestas en <b>texto</b>, salvo las lineas de codigo (huecos 15, 32 y 33), que se comparan como codigo.</div>
</div>


<div class="card">
  <h2>1. Norma p de un vector</h2>
  <pre><code>‖W‖p = ( |W1|^p + |W2|^p + … + |Wn|^p )^(1/p)</code></pre>
  <ul>
    <li>p = 1: suma de los <?php hueco(1, 16); ?> → base de L1 (Lasso)</li>
    <li>p = 2: la longitud <?php hueco(2, 10); ?> del vector → base de L2 (Ridge)</li>
    <li>p = &infin;: el <?php hueco(3, 7); ?> de los valores absolutos</li>
  </ul>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. La funcion de costo regularizada</h2>
  <p>Sin regularizar, se minimiza la suma de los residuos al <?php hueco(4, 9); ?>. Regularizar agrega un termino que
     penaliza magnitudes <?php hueco(5, 8); ?> de los coeficientes. El termino <b>no</b> incluye a <?php hueco(6, 9); ?>.</p>
  <table class="datos">
    <tr><th>Penalizacion</th><th>Termino</th><th>Modelo</th></tr>
    <tr><td>L1</td><td>&lambda; &Sigma; |w<sub>j</sub>|</td><td><?php hueco(7, 7); ?></td></tr>
    <tr><td>L2</td><td>&lambda; &Sigma; w<sub>j</sub>&sup2;</td><td><?php hueco(8, 7); ?></td></tr>
    <tr><td>L1 + L2</td><td>&lambda; ( &rho; &Sigma;|w<sub>j</sub>| + (1&minus;&rho;)/2 &Sigma; w<sub>j</sub>&sup2; )</td><td>Elastic Net</td></tr>
  </table>
  <p>LASSO = Least Absolute Shrinkage and <?php hueco(9, 10); ?> Operator.</p>
  <div class="nota"><b>Contraste menor:</b> la diapositiva escribe la penalizacion como <code>&lambda;/2 &Sigma;</code> y el notebook como <code>&lambda; &Sigma;</code>.
    No cambia nada: la constante se absorbe en &lambda;.</div>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. El hiperparametro &lambda;</h2>
  <ul>
    <li>&lambda; = 0: la penalizacion no tiene <?php hueco(10, 12); ?> (es el modelo original).</li>
    <li>Mientras mas grande &lambda;, los coeficientes son mas <?php hueco(11, 10); ?>.</li>
    <li>&lambda; excesivo lleva al <?php hueco(12, 10); ?>.</li>
    <li>En <code>Ridge</code>, <code>Lasso</code> y <code>ElasticNet</code> de sklearn se llama <?php hueco(13, 6); ?>.</li>
    <li>En <code>LogisticRegression</code> el parametro es <code>C</code>, que es el <?php hueco(14, 10); ?> de &lambda;;
        sin penalizacion: <code>C=<?php hueco(15, 7); ?></code>.</li>
  </ul>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. La intuicion de la diapositiva: Ridge con dos puntos</h2>
  <p>Se entrena con solo 2 puntos (rojos). Minimos cuadrados traza la recta roja <code>Tamano = 0.4 + 1.3·Peso</code>, que pasa
     por los dos (error 0), pero falla con los datos nuevos (verdes). Ridge minimiza <code>suma de residuos&sup2; + &lambda;·pendiente&sup2;</code>. Con &lambda; = 1:</p>
  <table class="datos">
    <tr><th>Recta</th><th>Residuos&sup2;</th><th>&lambda;·pendiente&sup2;</th><th>Costo Ridge</th></tr>
    <tr><td>Roja (pendiente 1,3)</td><td>0</td><td>1 · 1,3&sup2;</td><td><?php hueco(16, 5); ?></td></tr>
    <tr><td>Azul (pendiente 0,8)</td><td>0,3&sup2; + 0,1&sup2;</td><td>1 · 0,8&sup2;</td><td><?php hueco(17, 5); ?></td></tr>
  </table>
  <p>Ridge escoge la <?php hueco(18, 6); ?>: acepta un poco de error en entrenamiento (mas sesgo) para bajar la
     <?php hueco(19, 9); ?>. Al subir &lambda; (1, 2, 3…) la recta se aplana: la prediccion es cada vez menos
     <?php hueco(20, 9); ?> al peso.</p>
  <p>Con un solo punto y dos parametros (intercepto y pendiente), minimos cuadrados no tiene solucion unica: hay
     <?php hueco(21, 9); ?> rectas que pasan por el punto con error 0. Ridge si escoge una, porque tambien optimiza la pendiente.</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. &iquest;Por que Lasso da ceros exactos y Ridge no? (geometria)</h2>
  <p>Regularizar equivale a minimizar el error con una restriccion sobre los coeficientes. Las curvas de nivel del error
     (elipses) crecen desde la solucion sin regularizar hasta tocar la region permitida:</p>
  <ul>
    <li>L2 (Ridge): la region es un <?php hueco(22, 9); ?>; el contacto cae en un punto suave, con ambos coeficientes distintos de 0.</li>
    <li>L1 (Lasso): la region es un <?php hueco(23, 9); ?>, con esquinas sobre los <?php hueco(24, 6); ?>;
        lo mas probable es tocar una esquina, donde un coeficiente vale exactamente 0.</li>
  </ul>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. &iquest;Cual uso?</h2>
  <table class="datos">
    <tr><th>Ridge (L2)</th><th>Lasso (L1)</th><th>Elastic Net</th></tr>
    <tr>
      <td>encoge todos los coeficientes en proporcion, ninguno llega a 0; todas las variables quedan; funciona bien con variables
          <?php hueco(25, 13); ?> (reparte el efecto); dificil de interpretar si hay muchas variables</td>
      <td>selecciona atributos (modelo "sparse"); entre variables muy correlacionadas escoge una
          <?php hueco(26, 13); ?>; puede borrar terminos polinomiales correlacionados entre si</td>
      <td><code>l1_ratio</code> = &rho;: &rho; = 1 es <?php hueco(27, 6); ?>, &rho; = 0 es <?php hueco(28, 6); ?>;
          ante un grupo de variables correlacionadas tiende a conservar todo el <?php hueco(29, 6); ?></td>
    </tr>
  </table>
  <p>Casos de negocio del notebook: Ridge para precios de vivienda (casi todo aporta algo); Lasso para escoger canales de
     publicidad (los que no sirven quedan en 0); Elastic Net en genes o texto (miles de variables correlacionadas).</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. En la practica</h2>
  <p>Antes de regularizar hay que <?php hueco(30, 11); ?> las variables.</p>
  <p>En diabetes (10 variables), <code>Lasso(alpha=4)</code> dejo <?php hueco(31, 3); ?> coeficientes en 0, y la logistica L1 con
     <code>C=1</code> en breast cancer dejo 15 de 30. Las tres versiones regularizadas igualaron o mejoraron el MSE / accuracy
     del modelo sin regularizar.</p>
  <p>&lambda; no se adivina: se busca con validacion cruzada. <code>LassoCV</code> encontro alpha &asymp; 1,53, distinto del 4
     puesto a mano, y dio el mejor MSE de toda la sesion (2801,69).</p>
  <?php linea(32, 'un <code>LassoCV</code> que pruebe 50 alphas entre 10<sup>-3</sup> y 10<sup>3</sup> (<code>np.logspace</code>) con 5 folds', 'LassoCV(...)'); ?>
  <?php linea(33, 'un <code>ElasticNet</code> con alpha = 0.1 y mitad L1 / mitad L2', 'ElasticNet(...)'); ?>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../SesgoVarianza/index.php', '../Clasificacion/index.php');
