<?php
/* ==========================================================================
   APO / Metricas / SesgoVarianza  —  El compromiso sesgo-varianza
   Fuentes: diap_regu.pdf (secciones 01-02) · Sesion5-1_Regularizacion.ipynb (sec. 1 y 9)
            · Analytics Vidhya, "Bias and Variance Tradeoff" (2020) — contrastadas
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. tipos de error */
    1  => ['irreducibles', 'irreducible'],
    2  => ['reducibles', 'reducible'],
    3  => ['cuadrado', 'al cuadrado', '2'],

    /* 2. definiciones */
    4  => ['simple', 'demasiado simple'],
    5  => ['subajuste', 'underfitting', 'sub ajuste', 'subaprendizaje', 'sub aprendizaje'],
    6  => ['entrenamiento', 'conjunto de entrenamiento'],
    7  => ['sensibilidad', 'sensible'],
    8  => ['sobreajuste', 'overfitting', 'sobre ajuste', 'sobreaprendizaje', 'sobre aprendizaje'],
    9  => ['ruido'],

    /* 3. complejidad */
    10 => ['aumenta', 'crece', 'sube'],
    11 => ['disminuye', 'decrece', 'baja'],
    12 => ['igual'],

    /* 4. como se detecta */
    13 => ['pobre', 'mala', 'malo'],
    14 => ['muy buena', 'muy bueno', 'buena', 'excelente', 'alta'],
    15 => ['pobre', 'mala', 'malo', 'baja'],
    16 => ['1', 'uno'],
    17 => ['15', 'quince'],
    18 => ['grandes', 'grande'],

    /* 5. knn */
    19 => ['varianza', 'alta varianza'],
    20 => ['sesgo', 'alto sesgo'],

    /* 6. como combatirlo */
    21 => ['validacion cruzada', 'cross validation', 'cross-validation'],
    22 => ['atributos', 'caracteristicas', 'variables'],
    23 => ['complejidad'],
    24 => ['regularizacion'],
    25 => ['weight decay'],
    26 => ['dropout'],
    27 => ['early stopping', 'detencion temprana', 'parada temprana'],
    28 => ['poda', 'pruning'],
];
$TEXTO = range(1, 28);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En la diana de la diapositiva, los disparos quedan <b>alrededor del centro pero muy dispersos</b>. &iquest;Que combinacion es?',
        'opciones' => [
            'a' => 'Sesgo alto, varianza baja',
            'b' => '<b>Sesgo bajo, varianza alta</b>: en promedio apunta bien, pero cada entrenamiento da algo muy distinto',
            'c' => 'Sesgo bajo, varianza baja',
            'd' => 'Sesgo alto, varianza alta'
        ],
        'porque'   => 'Sesgo = que tan lejos del centro queda el promedio de los disparos. Varianza = que tan dispersos estan entre si. Sesgo alto y varianza baja seria un grupo apretado pero corrido del centro.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'En el foro del articulo alguien pregunta: "&iquest;como puede haber <b>varianza baja</b> si las predicciones estan lejos del objetivo?". &iquest;Que se responde?',
        'opciones' => [
            'a' => 'No puede: si estan lejos, la varianza es alta',
            'b' => 'Varianza baja significa que las predicciones <b>cambian poco cuando cambian los datos</b>, aunque esten equivocadas; estar lejos del objetivo es <b>sesgo</b>',
            'c' => 'Es un error del grafico',
            'd' => 'Solo pasa con KNN'
        ],
        'porque'   => 'Son dos preguntas distintas: &iquest;acierta en promedio? (sesgo) y &iquest;es estable? (varianza). Un modelo puede ser muy estable y estar siempre corrido: es el caso del subajuste.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => '<span class="tag-contra">Contraste</span> El articulo de Analytics Vidhya dice que el error total es <code>sesgo + varianza + ruido</code>. La curva de la diapositiva grafica <code>Bias&sup2;</code>. &iquest;Cual es la forma correcta?',
        'opciones' => [
            'a' => 'Las dos son iguales',
            'b' => '<b>Error esperado = sesgo&sup2; + varianza + error irreducible</b>: el sesgo va al cuadrado (como en la diapositiva); el articulo lo simplifica',
            'c' => 'sesgo + varianza&sup2; + ruido',
            'd' => 'Solo sesgo + varianza: el ruido no cuenta'
        ],
        'porque'   => 'Con error cuadratico, el error esperado se descompone exactamente en sesgo al cuadrado + varianza + ruido. Para el examen basta saber cual es reducible (sesgo y varianza) y cual no (ruido).',
        'correcta' => 'b'
    ],
    'm4' => [
        'texto'    => '<span class="tag-contra">Contraste</span> En el experimento de KNN del articulo, el k se escoge mirando cual da el <b>mejor puntaje en el conjunto de prueba</b>. Segun lo visto en clase (validacion cruzada), &iquest;que tiene de malo?',
        'opciones' => [
            'a' => 'Nada, es lo correcto',
            'b' => 'Que el conjunto de prueba se usa para <b>escoger</b> el hiperparametro, y entonces deja de ser una estimacion honesta del desempeno: hay que escoger k con validacion cruzada sobre entrenamiento y usar la prueba una sola vez al final',
            'c' => 'Que KNN no tiene hiperparametros',
            'd' => 'Que deberia escoger el k con mejor puntaje de entrenamiento'
        ],
        'porque'   => 'Es la misma razon por la que existe la validacion cruzada. Un lector del articulo senala otro descuido: el codigo escala con todos los datos antes de partir (fuga de informacion); el escalador se ajusta solo con entrenamiento.',
        'correcta' => 'b'
    ],
    'm5' => [
        'texto'    => '<span class="tag-contra">Contraste</span> La diapositiva define sesgo como "diferencia entre los valores reales y las predicciones del modelo". &iquest;Por que esa frase se queda corta?',
        'opciones' => [
            'a' => 'Porque el sesgo no tiene que ver con las predicciones',
            'b' => 'Porque asi definido seria el <b>error</b> de cualquier modelo. El sesgo es el error <b>sistematico</b> que queda por usar un modelo demasiado simple (la definicion del notebook): falla incluso en entrenamiento',
            'c' => 'Porque el sesgo solo existe en clasificacion',
            'd' => 'No se queda corta, es la definicion exacta'
        ],
        'porque'   => 'Un modelo sobreajustado tambien tiene diferencias entre real y predicho (en prueba), y no por eso tiene sesgo alto: su problema es la varianza.',
        'correcta' => 'b'
    ],
    'm6' => [
        'texto'    => 'Un modelo da R&sup2; = 0,62 en entrenamiento y 0,60 en prueba, y ambos son bajos para el problema. &iquest;Que lo describe mejor y que harias?',
        'opciones' => [
            'a' => 'Sobreajuste: regularizar mas',
            'b' => '<b>Subajuste (sesgo alto)</b>: entrenamiento y prueba igual de pobres; hay que darle mas capacidad (mas variables, terminos polinomiales, menos regularizacion)',
            'c' => 'Esta perfecto porque los dos valores son parecidos',
            'd' => 'Varianza alta: quitar variables'
        ],
        'porque'   => 'Lo que delata el sobreajuste es la <b>brecha</b> entre entrenamiento y prueba; lo que delata el subajuste es que <b>ambos</b> son malos. Regularizar mas empeoraria este caso.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Metricas 1 — El compromiso sesgo-varianza',
         'diap_regu.pdf · Sesion5-1_Regularizacion.ipynb · Analytics Vidhya (bias-variance tradeoff)');
?>

<style>
.tag-contra{display:inline-block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.4px;
  padding:1px 8px;border-radius:12px;margin-right:6px;vertical-align:1px;background:#fff4e0;color:#b5730a}
</style>

<div class="card">
  <h2>De que va esto</h2>
  <p>Por que un modelo puede fallar "por simple" o "por memorioso", como se ve en los errores de entrenamiento y prueba,
     y que herramientas lo controlan. Lo que ya se pregunto en el repaso del parcial 1 (efecto del sesgo alto) no se repite.</p>
  <div class="nota">Las preguntas marcadas <span class="tag-contra">Contraste</span> comparan fuentes que no dicen lo mismo.
    Respuestas en <b>texto</b>.</div>
</div>


<div class="card">
  <h2>1. Los tipos de error</h2>
  <p>En ML hay errores <?php hueco(1, 12); ?> (el ruido propio de los datos, no se pueden eliminar) y errores
     <?php hueco(2, 11); ?>, que son dos: el <b>sesgo</b> y la <b>varianza</b>.</p>
  <p>En la curva de error total de la diapositiva, la componente de sesgo aparece elevada al <?php hueco(3, 10); ?>.</p>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Sesgo y varianza</h2>
  <table class="datos">
    <tr><th></th><th>Sesgo alto</th><th>Varianza alta</th></tr>
    <tr><td>Que es</td><td>el modelo es demasiado <?php hueco(4, 8); ?>: no capta la relacion real</td>
        <td><?php hueco(7, 11); ?> del modelo a fluctuaciones en los datos de entrenamiento</td></tr>
    <tr><td>Produce</td><td><?php hueco(5, 11); ?>: falla incluso en <?php hueco(6, 11); ?></td>
        <td><?php hueco(8, 11); ?>: aprende hasta el <?php hueco(9, 6); ?> y no generaliza</td></tr>
  </table>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. La complejidad del modelo</h2>
  <p>Al agregar mas y mas parametros, la varianza <?php hueco(10, 8); ?> y el sesgo <?php hueco(11, 9); ?>.
     El punto optimo es donde la disminucion del sesgo es <?php hueco(12, 6); ?> al aumento de la varianza
     (el fondo de la "U" del error total).</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Como se detecta</h2>
  <table class="datos">
    <tr><th></th><th>Subajuste</th><th>Ajuste optimo</th><th>Sobreajuste</th></tr>
    <tr><td>Desempeno en entrenamiento</td><td><?php hueco(13, 6); ?></td><td>buena</td><td><?php hueco(14, 9); ?></td></tr>
    <tr><td>Desempeno en validacion / prueba</td><td>pobre</td><td>buena</td><td><?php hueco(15, 6); ?></td></tr>
  </table>
  <p>En el notebook, con polinomios sobre una seno con ruido: grado <?php hueco(16, 3); ?> subajusta, grado 4 ajusta bien,
     grado <?php hueco(17, 3); ?> pasa por todos los puntos y sobreajusta.</p>
  <p>Sintoma numerico del sobreajuste: los coeficientes &theta; toman valores muy <?php hueco(18, 8); ?>, y la curva se vuelve "ondulante".</p>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. El ejemplo del articulo: KNN y la diabetes de Pima</h2>
  <p>Con <b>pocos vecinos</b> el modelo cambia de prediccion por diferencias minimas (glucosa 78 vs 75): tiene
     <?php hueco(19, 9); ?> alta. Con <b>muchos vecinos</b> simplifica de mas: tiene <?php hueco(20, 7); ?> alto.</p>
  <p>Al subir k, el puntaje de entrenamiento baja y el de prueba sube, hasta que quedan cerca.</p>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Como se combate el sobreajuste</h2>
  <p>Los cuatro metodos de la diapositiva:</p>
  <ol>
    <li><?php hueco(21, 16); ?></li>
    <li>Reducir el numero de <?php hueco(22, 11); ?></li>
    <li>Reducir la <?php hueco(23, 11); ?> del modelo</li>
    <li><?php hueco(24, 13); ?> (Ridge, Lasso, Elastic Net: el siguiente cuestionario)</li>
  </ol>
  <p>El mismo principio aparece en todos lados (seccion 9 del notebook):</p>
  <table class="datos">
    <tr><th>Tecnica</th><th>Que hace</th></tr>
    <tr><td><?php hueco(25, 12); ?></td><td>el equivalente de Ridge (L2) en redes neuronales</td></tr>
    <tr><td><?php hueco(26, 9); ?></td><td>apaga neuronas al azar en cada iteracion</td></tr>
    <tr><td><?php hueco(27, 14); ?></td><td>deja de entrenar cuando el error de validacion deja de bajar</td></tr>
    <tr><td><?php hueco(28, 7); ?></td><td>en arboles: quitar ramas que aportan poco</td></tr>
  </table>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../Regularizacion/index.php');
