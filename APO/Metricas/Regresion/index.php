<?php
/* ==========================================================================
   APO / Metricas / Regresion  —  Metricas de regresion: lo que muestran y lo que esconden
   Fuentes: Sesion5-3_metrics_for_regresion.ipynb · Actividad_metricas.pdf (casos 2 y 4)
   No repite lo del parcial 1 (que mide el R², unidad del MAE vs MSE, MAPE como formula).
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. unidades */
    1  => ['cuadrado', 'al cuadrado', 'unidades al cuadrado'],
    2  => ['adimensional', 'sin unidades', 'ninguna'],
    3  => ['media', 'promedio', 'la media de y'],

    /* 2. caso 1 */
    4  => ['2', '2.0', '2,0'],
    5  => ['40', '40.0', '40,0'],
    6  => ['6.325', '6,325', '6.32', '6,32', '6.3', '6,3'],
    7  => ['20', '20.0', '20,0'],
    8  => ['mediana'],

    /* 3. caso 2 */
    9  => ['mae'],
    10 => ['mse'],

    /* 4. anscombe */
    11 => ['1973'],
    12 => ['0.67', '0,67', '0.666', '0,666', '0.667', '0,667'],
    13 => ['no lineal', 'parabolica', 'curva', 'cuadratica'],
    14 => ['atipico', 'outlier', 'valor atipico'],
    15 => ['punto', 'un punto', 'unico punto'],
    16 => ['residuos', 'los residuos', 'datos'],

    /* 5. r2 negativo */
    17 => ['negativo', 'menor que 0', 'menor que cero'],
    18 => ['media', 'promedio', 'la media'],
    19 => ['prueba', 'test', 'validacion', 'validacion cruzada'],

    /* 6. relativo */
    20 => ['8.33', '8,33', '8.33%', '8,33%', '8.3', '8,3'],
    21 => ['17.5', '17,5', '17.5%', '17,5%'],
    22 => ['temperatura', 'el de temperatura'],
    23 => ['cero', '0'],
    24 => ['dos', '2'],

    /* 7. actividad */
    25 => ['subpredecir', 'subestimar', 'pedir menos', 'quedarse corto'],

    /* 8. codigo */
    26 => ['mean_absolute_error(y_test, pred)'],
    27 => ['np.sqrt(mean_squared_error(y_test, pred))'],
    28 => ['r2_score(y_test, pred)'],
];
$TEXTO = array_values(array_diff(range(1, 28), [26, 27, 28]));

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Cuando es <b>correcto</b> preferir el MSE / RMSE aunque castigue tanto los errores grandes?',
        'opciones' => [
            'a' => 'Nunca: el MAE siempre es mejor',
            'b' => 'Cuando un error grande es de verdad <b>desproporcionadamente mas costoso</b> que varios pequenos (control de procesos, seguridad): castigarlo al cuadrado es una eleccion deliberada, no un defecto',
            'c' => 'Cuando hay muchos outliers por errores de captura',
            'd' => 'Cuando se quiere comparar problemas con escalas distintas'
        ],
        'porque'   => 'Es la sintesis del notebook. Con outliers que son errores de captura (c) conviene el MAE; para comparar escalas distintas (d), R&sup2; o metricas relativas.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'En la prueba de sobreajuste del notebook, el polinomio de grado 3 tiene R&sup2; de <b>prueba</b> 0,967 y R&sup2; de <b>entrenamiento</b> 0,767. &iquest;Es una alarma?',
        'opciones' => [
            'a' => 'Si: es imposible que prueba supere a entrenamiento, hay un error',
            'b' => 'No necesariamente: con solo 10 puntos de prueba (40 % de 25), la particion al azar puede dejar en prueba puntos "faciles"; por eso se prefiere la validacion cruzada a una sola particion',
            'c' => 'Si: indica sobreajuste severo',
            'd' => 'No, porque el R&sup2; de prueba siempre es mayor'
        ],
        'porque'   => 'Es la pregunta de reflexion del caso 4. Con muestras chicas una sola particion es ruidosa en ambas direcciones.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'Caso 2 de la actividad: el MSE sale altisimo por unas pocas mansiones de lujo, aunque el modelo va bien en casas de 100 000 a 500 000. &iquest;Que proponer?',
        'opciones' => [
            'a' => 'Descartar el modelo, el MSE no miente',
            'b' => 'Reportar metricas robustas o relativas (<b>MAE</b>, <b>MAPE</b>/error relativo) y evaluarlas <b>por segmento</b> (rango medio aparte); mostrarle al CEO un grafico de real vs predicho o de errores por rango de precio',
            'c' => 'Cambiar a R&sup2;, que no se afecta por outliers',
            'd' => 'Elevar los errores al cubo para que pesen mas'
        ],
        'porque'   => 'El MSE eleva al cuadrado: un error de 2 millones pesa como 40 000 errores de 10 000. El R&sup2; tambien se basa en errores al cuadrado, asi que tambien lo arrastran los outliers (y el caso 3 de Anscombe lo muestra).',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => 'Caso 4 de la actividad: queso perecedero. Sobrepedir pierde el <b>costo completo</b> de lo que se bota (C<sub>d</sub>); subpedir pierde solo el <b>margen</b> de la venta (C<sub>o</sub>). &iquest;Que metrica sirve?',
        'opciones' => [
            'a' => 'El MAE, porque trata igual ambos errores',
            'b' => 'Un <b>costo asimetrico</b>: <code>Costo = C<sub>d</sub>·max(&ycirc; &minus; y, 0) + C<sub>o</sub>·max(y &minus; &ycirc;, 0)</code>; como C<sub>d</sub> &gt; C<sub>o</sub>, el modelo optimo tiende a pedir un poco menos de lo esperado',
            'c' => 'El R&sup2;',
            'd' => 'El RMSE, porque castiga mas los errores grandes'
        ],
        'porque'   => 'MAE y MSE son simetricos: sobrar 30 o faltar 30 cuesta lo mismo, y aqui no es asi. Con la metrica asimetrica se puede escoger un modelo distinto al que gana por MAE.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Metricas 4 — Metricas de regresion: lo que muestran y lo que esconden',
         'Sesion5-3_metrics_for_regresion.ipynb · Actividad_metricas.pdf');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>El notebook no repite las formulas: muestra con casos <b>por que</b> cada metrica se comporta como se comporta y que puede ocultar.
     Lo del parcial 1 (que mide el R&sup2;, que el MAE esta en la unidad de y y es menos sensible) no se repite.</p>
  <div class="nota">Respuestas en <b>texto</b>; los numeros con punto o coma. Las ultimas tres lineas son de codigo.</div>
</div>


<div class="card">
  <h2>1. Unidades y punto de referencia</h2>
  <p>El MSE esta en unidades de y al <?php hueco(1, 9); ?>; RMSE y MAE, en unidades de y; el R&sup2; es <?php hueco(2, 11); ?>.</p>
  <p>El R&sup2; compara el error del modelo contra el de un modelo trivial que siempre predice la <?php hueco(3, 7); ?> de y.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Caso 1: por que el MSE castiga tanto los errores grandes</h2>
  <p>10 observaciones. Modelo A: error de &plusmn;1 en todas. Modelo B: perfecto en 9 y un error de 20 en una.</p>
  <table class="datos">
    <tr><th></th><th>MAE</th><th>MSE</th><th>RMSE</th></tr>
    <tr><td>Modelo A</td><td>1</td><td>1</td><td>1</td></tr>
    <tr><td>Modelo B</td><td><?php hueco(4, 4); ?></td><td><?php hueco(5, 4); ?></td><td><?php hueco(6, 5); ?></td></tr>
  </table>
  <p>El MAE se duplica; el MSE se multiplica por 40 (20&sup2; = 400 entre 10).
     Si en vez de un error de 20 fueran dos errores de 10, el MSE seria <?php hueco(7, 4); ?>: la funcion cuadratica castiga mas
     un error concentrado que el mismo error repartido.</p>
  <p>El MAE es a la <?php hueco(8, 8); ?> lo que el MSE es a la media.</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Caso 2: un solo dato malo en diabetes</h2>
  <p>Se le suma +300 a una sola prediccion de 89 (1,1 % de los datos):</p>
  <table class="datos">
    <tr><th>MAE</th><th>MSE</th><th>RMSE</th></tr>
    <tr><td>+3,7 %</td><td>+16,4 %</td><td>+7,9 %</td></tr>
  </table>
  <p>El que mejor resiste es el <?php hueco(9, 4); ?>; el que mas se dispara es el <?php hueco(10, 4); ?>.
     Si el criterio unico es el MSE, un error de captura puede hacer creer que el modelo "empeoro".</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Caso 3: el cuarteto de Anscombe (lo que el R&sup2; esconde)</h2>
  <p>Anscombe (<?php hueco(11, 5); ?>) construyo cuatro conjuntos con la misma media, varianza, correlacion, recta y un R&sup2; de
     &asymp; <?php hueco(12, 5); ?> en los cuatro.</p>
  <table class="datos">
    <tr><th>Dataset</th><th>Que hay en realidad</th></tr>
    <tr><td>I</td><td>relacion lineal con ruido: el unico donde la recta es apropiada</td></tr>
    <tr><td>II</td><td>relacion <?php hueco(13, 10); ?>: la recta no capta la forma</td></tr>
    <tr><td>III</td><td>recta casi perfecta, torcida por un solo valor <?php hueco(14, 8); ?></td></tr>
    <tr><td>IV</td><td>casi todos con el mismo x: todo el ajuste lo decide un unico <?php hueco(15, 6); ?></td></tr>
  </table>
  <p>Leccion: el R&sup2; no verifica linealidad ni detecta puntos influyentes; siempre hay que graficar los datos y los <?php hueco(16, 8); ?>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Caso 4: R&sup2; negativo</h2>
  <table class="datos">
    <tr><th>Grado del polinomio</th><th>R&sup2; entrenamiento</th><th>R&sup2; prueba</th></tr>
    <tr><td>1</td><td>0,56</td><td>0,46</td></tr>
    <tr><td>3</td><td>0,77</td><td>0,97</td></tr>
    <tr><td>12</td><td>0,85</td><td>&minus;89 168</td></tr>
    <tr><td>18</td><td>1,00</td><td>&minus;14 mil millones</td></tr>
  </table>
  <p>El R&sup2; puede ser <?php hueco(17, 9); ?> cuando el modelo es peor que predecir siempre la <?php hueco(18, 6); ?>.
     Un R&sup2; alto en entrenamiento no certifica nada: las metricas se reportan sobre <?php hueco(19, 8); ?>
     (o con validacion cruzada).</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Caso 5: RMSE absoluto vs relativo</h2>
  <table class="datos">
    <tr><th>Modelo</th><th>RMSE</th><th>Media de y</th><th>RMSE relativo</th></tr>
    <tr><td>Precio de vivienda</td><td>$25 000</td><td>$300 000</td><td><?php hueco(20, 5); ?> %</td></tr>
    <tr><td>Temperatura maxima</td><td>3,5 &deg;C</td><td>20 &deg;C</td><td><?php hueco(21, 5); ?> %</td></tr>
  </table>
  <p>Aunque $25 000 "suena" peor, el modelo que mas se equivoca en proporcion es el de <?php hueco(22, 11); ?>.
     MSE, RMSE y MAE no se comparan entre problemas sin normalizar. Las metricas relativas (RMSE/media, MAPE) fallan si y puede
     estar cerca de <?php hueco(23, 5); ?>.</p>
  <p>Recomendacion del notebook: reportar al menos <?php hueco(24, 4); ?> metricas complementarias (RMSE con MAE, o R&sup2; con un grafico de residuos).</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Actividad: consultor de IA (casos 2 y 4)</h2>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <p>Con el costo asimetrico del queso, el modelo optimo tiende a <?php hueco(25, 11); ?>, porque sobrar sale mas caro que faltar.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. El codigo</h2>
  <?php linea(26, 'MAE entre <code>y_test</code> y <code>pred</code>', 'mean_absolute_error(...)'); ?>
  <?php linea(27, 'RMSE entre <code>y_test</code> y <code>pred</code> (sklearn da el MSE; saca la raiz con numpy)', 'np.sqrt(...)'); ?>
  <?php linea(28, 'R&sup2; entre <code>y_test</code> y <code>pred</code>', 'r2_score(...)'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Clasificacion/index.php', '');
