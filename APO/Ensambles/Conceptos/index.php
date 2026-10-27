<?php
/* ==========================================================================
   APO / Ensambles / Conceptos  —  Que es un ensamble, aprendices debiles y
                                   fuertes, sesgo/varianza, categorias y tecnicas
   Fuentes: Ensemble Learning (Bagging, Boostrap, Stacking).pdf ·
            02_AprendSup-Ensambles.pptx · IBM "What is ensemble learning?" ·
            scikit-learn 1.11 Ensembles
   ========================================================================== */

$MENU = '../index.php';
$CSS  = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../../motor.php';

$SOLUCIONES = [
    /* 1. que es */
    1  => ['unico', 'solo', 'un solo', 'un unico'],
    2  => ['precision', 'exactitud'],
    3  => ['committee-based learning', 'committee based learning', 'aprendizaje basado en comites', 'basado en comites', 'comites'],
    4  => ['sabiduria de las multitudes', 'wisdom of crowds', 'sabiduria de la multitud'],

    /* 2. aprendices */
    5  => ['weak learners', 'weak learner', 'aprendices debiles', 'debiles'],
    6  => ['strong learner', 'strong learners', 'aprendiz fuerte', 'fuerte', 'ensemble model'],
    7  => ['50', '50%'],
    8  => ['80', '80%'],
    9  => ['base learner', 'base model', 'base estimator', 'aprendiz base', 'modelo base', 'estimador base'],

    /* 3. sesgo y varianza */
    10 => ['entrenamiento', 'train'],
    11 => ['prueba', 'test', 'validacion', 'prueba y validacion'],
    12 => ['error irreducible', 'irreducible'],
    13 => ['diversidad', 'diversos', 'diferentes', 'variedad'],

    /* 4. categorias */
    14 => ['secuenciales', 'secuencial'],
    15 => ['dependencia'],
    16 => ['paralelos', 'paralelo'],
    17 => ['independencia'],
    18 => ['homogeneos', 'homogeneo'],
    19 => ['heterogeneos', 'heterogeneo'],

    /* 5. tecnicas */
    20 => ['max voting', 'votacion maxima', 'voto mayoritario', 'votacion por mayoria', 'majority voting'],
    21 => ['averaging', 'promedio', 'promediado'],
    22 => ['weighted average', 'promedio ponderado', 'weighted averaging'],
    23 => ['moda'],
    24 => ['stacking'],
    25 => ['bagging'],
    26 => ['boosting'],
];
$TEXTO = range(1, 26);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La diapositiva "Principal idea" muestra una persona sola empujando un carro y luego un grupo empujandolo juntos, y despues dos clasificadores con fronteras distintas que se combinan en uno. &iquest;Que idea representan?',
        'opciones' => [
            'a' => 'Que hay que usar el modelo mas grande posible',
            'b' => 'Que varios modelos, cada uno con sus errores, <b>combinados</b> logran una frontera y un resultado que ninguno consigue solo',
            'c' => 'Que hay que entrenar siempre con mas datos',
            'd' => 'Que un solo clasificador es suficiente si se ajusta bien'
        ],
        'porque'   => 'Es la base de todo el tema. En la diapositiva siguiente: KNN 0,75, arbol 0,85 y regresion logistica 0,91 &rarr; ensamble 0,93.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Segun IBM, un ensamble de modelos <b>poco regularizados</b> (que sobreajustan cada uno) frente a un solo modelo bien regularizado&hellip;',
        'opciones' => [
            'a' => 'siempre pierde, porque cada modelo sobreajusta',
            'b' => 'puede <b>superarlo</b>: al combinar modelos diversos los errores de varianza se compensan, conservando el bajo sesgo de cada uno',
            'c' => 'da exactamente el mismo resultado',
            'd' => 'no se puede comparar'
        ],
        'porque'   => 'Es el argumento del sesgo-varianza: cada modelo flexible tiene poco sesgo y mucha varianza; promediarlos baja la varianza. Cuanto mas diversos los modelos, mejor el ensamble.',
        'correcta' => 'b'
    ],
    'm3' => [
        'texto'    => 'En el ejemplo de la diapositiva de stacking, los modelos base (arbol, Random Forest, KNN, XGBoost) alimentan a una regresion logistica, que da 0,968 de accuracy. &iquest;Que papel cumple la regresion logistica ahi?',
        'opciones' => [
            'a' => 'Es un modelo base mas',
            'b' => 'Es el <b>meta-clasificador</b> (meta-modelo): aprende a combinar las predicciones de los modelos base',
            'c' => 'Sirve para escalar los datos',
            'd' => 'Es el baseline'
        ],
        'porque'   => 'Esta idea se desarrolla en el cuestionario de stacking. Aqui basta con reconocer que hay dos niveles: modelos base y un modelo que los combina.',
        'correcta' => 'b'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Ensambles 1 — Conceptos',
         'Ensemble Learning (Bagging, Boostrap, Stacking).pdf · IBM · scikit-learn');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Antes de ver cada metodo: que es un ensamble, que tipos de aprendices combina, por que funciona
     (sesgo y varianza) y como se clasifican los metodos.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayusculas, tildes ni el articulo.</div>
</div>


<div class="card">
  <h2>1. Que es un metodo de ensamble</h2>
  <p>Consiste en crear un <?php hueco(1, 8); ?> modelo de aprendizaje a partir de la combinacion de
     distintos modelos, para mejorar la <?php hueco(2, 10); ?> de los resultados: la prediccion final
     es mejor que la de cada modelo por separado.</p>
  <p>IBM dice que a veces se le llama <?php hueco(3, 22); ?>. En clase se presento como la
     <?php hueco(4, 22); ?> (wisdom of crowds).</p>
  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Tipos de aprendices</h2>
  <table class="datos">
    <tr><th>Nombre</th><th>Que es</th></tr>
    <tr><td><?php hueco(5, 14); ?></td><td>modelos que solos no dan buen resultado porque tienen mucho sesgo o mucha varianza</td></tr>
    <tr><td><?php hueco(6, 14); ?></td><td>la combinacion de varios de los anteriores, para reducir el sesgo y/o la varianza</td></tr>
  </table>
  <p>IBM pone numeros en clasificacion binaria: un aprendiz debil apenas supera el azar (alrededor
     del <?php hueco(7, 4); ?>% de accuracy) y uno fuerte llega a cerca del <?php hueco(8, 4); ?>% o mas.</p>
  <p>A cada modelo individual dentro del ensamble tambien se le llama <?php hueco(9, 14); ?>.</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Por que funciona: sesgo y varianza</h2>
  <table class="datos">
    <tr><th>Componente</th><th>Se nota como&hellip;</th></tr>
    <tr><td>Sesgo alto</td><td>mucho error en los datos de <?php hueco(10, 12); ?></td></tr>
    <tr><td>Varianza alta</td><td>mucho error en los datos de <?php hueco(11, 10); ?></td></tr>
    <tr><td><?php hueco(12, 16); ?></td><td>la aleatoriedad propia de los datos; ningun modelo la elimina</td></tr>
  </table>
  <p>Lo ideal es un modelo con bajo sesgo y baja varianza. Al combinar modelos se puede bajar el
     error total; cuanta mas <?php hueco(13, 10); ?> haya entre los modelos combinados, mas preciso
     suele ser el ensamble.</p>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Categorias</h2>
  <table class="datos">
    <tr><th>Categoria</th><th>Que aprovechan</th><th>Ejemplo</th></tr>
    <tr><td><?php hueco(14, 11); ?></td><td>la <?php hueco(15, 11); ?> entre aprendices: cada modelo corrige los errores del anterior</td><td>boosting</td></tr>
    <tr><td><?php hueco(16, 10); ?></td><td>la <?php hueco(17, 12); ?> entre aprendices: todos predicen y luego se combina ("democracia")</td><td>bagging</td></tr>
  </table>
  <p>Los paralelos se dividen en <?php hueco(18, 11); ?> (un unico tipo de modelo como aprendiz
     base, p. ej. bagging) y <?php hueco(19, 12); ?> (varios tipos de modelos, p. ej. stacking).</p>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Tipos de tecnicas</h2>
  <table class="datos">
    <tr><th>Simples</th><th>Como combina</th></tr>
    <tr><td><?php hueco(20, 14); ?></td><td>gana la prediccion con mas votos (la <?php hueco(23, 6); ?> de las predicciones); tipica en clasificacion</td></tr>
    <tr><td><?php hueco(21, 12); ?></td><td>el promedio de todas las predicciones; tipica en regresion</td></tr>
    <tr><td><?php hueco(22, 16); ?></td><td>el modelo con mayor poder predictivo pesa mas</td></tr>
  </table>
  <table class="datos">
    <tr><th>Avanzadas</th><th>En una linea</th></tr>
    <tr><td><?php hueco(24, 10); ?></td><td>combina modelos base mediante <b>otro modelo</b></td></tr>
    <tr><td><?php hueco(25, 10); ?></td><td>muestreo aleatorio y combinacion de modelos</td></tr>
    <tr><td><?php hueco(26, 10); ?></td><td>construccion secuencial, dando mas importancia a las instancias mal clasificadas</td></tr>
  </table>
  <?php mc('m3'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../Bagging/index.php');
