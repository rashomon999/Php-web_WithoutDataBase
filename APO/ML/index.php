<?php
/* ==========================================================================
   APO / ML  —  Introduccion al Machine Learning
   Fuentes: Machine_Learning_Def.pdf           (definicion de Mitchell, 1997)
            Introduccion al Machine Learning.pdf  (Unidad 1: aprendizaje supervisado)
            Machine_Learning.pdf                (The Fundamentals of Machine Learning)
   Respuestas de TEXTO: da igual tilde, mayuscula, articulo y guion.
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [

    /* --- 1. la definicion de Mitchell y ML vs IA --- */
    1  => ["Experiencia", "E"],
    2  => ["Tareas", "Tarea", "T"],
    3  => ["Rendimiento", "Medida de rendimiento", "Desempeno", "P"],
    4  => ["Inteligencia artificial", "IA", "AI"],
    5  => ["Machine learning", "Aprendizaje automatico", "Aprendizaje de maquina"],

    /* --- 2. historia --- */
    6  => ["1950"],
    7  => ["Alan Turing", "Turing"],
    8  => ["1952"],
    9  => ["Damas", "Checkers", "Juego de damas", "Las damas"],
    10 => ["Frank Rosenblatt", "Rosenblatt"],
    11 => ["1957"],
    12 => ["Nearest neighbor", "Vecino mas cercano", "Nearest neighbour"],
    13 => ["2006"],
    14 => ["2014"],
    15 => ["Deep learning", "Aprendizaje profundo"],

    /* --- 3. tipos de problema --- */
    16 => ["Regresion"],
    17 => ["Clasificacion"],
    18 => ["Binaria", "Clasificacion binaria"],
    19 => ["Multiclase", "Clasificacion multiclase"],
    20 => ["Multietiqueta", "Clasificacion multietiqueta"],
    21 => ["Ordinal", "Clasificacion ordinal"],

    /* --- 4. las tres categorias de aprendizaje --- */
    22 => ["Supervisado", "Aprendizaje supervisado"],
    23 => ["No supervisado", "Aprendizaje no supervisado"],
    24 => ["Por refuerzo", "Refuerzo", "Aprendizaje por refuerzo"],
    25 => ["k-means", "kmeans", "k means"],
    26 => ["PCA", "Analisis de componentes principales"],
    27 => ["Clustering", "Agrupamiento", "Agrupacion"],

    /* --- 5. las tres fases del modelo supervisado --- */
    28 => ["Entrenamiento"],
    29 => ["Prueba", "Test"],
    30 => ["Evaluacion"],
    31 => ["Hiperparametros", "Los hiperparametros"],

    /* --- 6. underfitting y overfitting --- */
    32 => ["Underfitting", "Subentrenamiento", "Sub entrenamiento"],
    33 => ["Overfitting", "Sobreentrenamiento", "Sobre entrenamiento"],

    /* --- 7. redes neuronales --- */
    34 => ["Recurrentes", "RNN", "Redes neuronales recurrentes", "Recurrent neural networks"],
    35 => ["Convolucionales", "CNN", "Redes neuronales convolucionales", "Convolutional neural networks"],
];

$MULTIPLE = [

    'm1' => [
        'texto'    => 'Tu programa de correo observa que mensajes marcas como spam y, con eso, aprende a filtrar mejor. Segun Mitchell, &iquest;cual es la <b>tarea T</b>?',
        'opciones' => [
            'a' => 'Observarte etiquetar los correos como spam o no spam',
            'b' => '<b>Clasificar los correos como spam o no spam</b>',
            'c' => 'El numero (o la fraccion) de correos clasificados correctamente',
            'd' => 'Ninguna: esto no es un problema de machine learning'
        ],
        'correcta' => 'b',
        'porque'   => 'Las otras dos opciones tambien salen, pero en otro papel: <b>E</b> = observarte etiquetar los correos; <b>P</b> = la fraccion de correos bien clasificados. T es <em>lo que el programa hace</em>, E es <em>de donde aprende</em> y P es <em>como se mide</em>.'
    ],

    'm2' => [
        'texto'    => '&iquest;Como se relacionan el machine learning y la inteligencia artificial?',
        'opciones' => [
            'a' => 'Son exactamente lo mismo con dos nombres',
            'b' => 'La IA es una rama del machine learning',
            'c' => 'El machine learning es la <b>tecnologia subyacente</b> de la IA: le da las herramientas matematicas con las que la IA imita el comportamiento humano',
            'd' => 'No tienen ninguna relacion'
        ],
        'correcta' => 'c',
        'porque'   => 'El whitepaper lo resume asi: el objetivo de la IA es imitar el comportamiento humano, y el machine learning aporta las matematicas que lo hacen posible. El ML, como las personas, aprende de los datos.'
    ],

    'm3' => [
        'texto'    => '&iquest;Que es lo unico que decide si un aprendizaje es <b>supervisado</b> o <b>no supervisado</b>?',
        'opciones' => [
            'a' => 'Si los datos estan <b>etiquetados</b> o no',
            'b' => 'La cantidad de datos disponibles',
            'c' => 'Si se usa una red neuronal o no',
            'd' => 'Si el problema es de regresion o de clasificacion'
        ],
        'correcta' => 'a',
        'porque'   => 'Supervisado = le decimos al modelo que queremos que aprenda, porque cada ejemplo trae su etiqueta. No supervisado = no hay etiqueta que predecir; el algoritmo busca patrones o agrupa por afinidad.'
    ],

    'm4' => [
        'texto'    => 'Predecir el <b>precio de una casa</b> a partir del numero de habitaciones es un problema de:',
        'opciones' => [
            'a' => 'Clasificacion binaria',
            'b' => '<b>Regresion</b>: la salida es un valor numerico continuo',
            'c' => 'Clustering',
            'd' => 'Aprendizaje por refuerzo'
        ],
        'correcta' => 'b',
        'porque'   => 'La regla es la salida, no la entrada: si lo que se predice es un <b>numero continuo</b>, es regresion; si es una <b>etiqueta o categoria</b>, es clasificacion. Detectar spam, con esa misma logica, es clasificacion.'
    ],

    'm5' => [
        'texto'    => 'La <b>segmentacion de clientes</b> de un negocio, sin conocer de antemano los segmentos, es un ejemplo de:',
        'opciones' => [
            'a' => 'Aprendizaje supervisado',
            'b' => 'Aprendizaje por refuerzo',
            'c' => 'Aprendizaje <b>no supervisado</b> (clustering)',
            'd' => 'Regresion polinomial'
        ],
        'correcta' => 'c',
        'porque'   => 'No hay etiquetas previas: el algoritmo identifica patrones y agrupa a los clientes por afinidad. Los dos ejemplos de algoritmos del PDF son <b>k-means</b> y <b>PCA</b>.'
    ],

    'm6' => [
        'texto'    => 'Un robot que aprende a caminar a base de prueba y error, con recompensas y penalizaciones, es:',
        'opciones' => [
            'a' => 'Aprendizaje supervisado',
            'b' => 'Aprendizaje no supervisado',
            'c' => 'Aprendizaje <b>por refuerzo</b>',
            'd' => 'Una red neuronal convolucional'
        ],
        'correcta' => 'c',
        'porque'   => 'Un <em>agente</em> percibe e interpreta el entorno, ejecuta acciones y aprende por prueba y error. El otro ejemplo tipico son los juegos de estrategia; el whitepaper anade navegacion y videojuegos.'
    ],

    'm7' => [
        'texto'    => 'Tu modelo da un error <b>muy bajo</b> con los datos de entrenamiento y <b>alto</b> con los de prueba. &iquest;Que pasa?',
        'opciones' => [
            'a' => 'Underfitting: el modelo no captura la relacion',
            'b' => '<b>Overfitting</b>: el modelo se ajusto demasiado bien a los datos de entrenamiento',
            'c' => 'El dataset esta desbalanceado, seguro',
            'd' => 'Nada, es el resultado ideal'
        ],
        'correcta' => 'b',
        'porque'   => 'La regla de los dos errores: <b>alto en train y alto en test</b> &rarr; underfitting (el modelo se queda corto). <b>Bajo en train y alto en test</b> &rarr; overfitting (se aprendio los datos de memoria y no generaliza).'
    ],

    'm8' => [
        'texto'    => 'En la <b>fase 1 (entrenamiento)</b>, &iquest;cual de estas preguntas NO corresponde a esa fase segun el PDF?',
        'opciones' => [
            'a' => '&iquest;Clasificacion o regresion? &iquest;Que atributos voy a utilizar?',
            'b' => '&iquest;Como particiono los datos entre entrenamiento, validacion y prueba?',
            'c' => '&iquest;El dataset es desbalanceado?',
            'd' => '<b>&iquest;Se presenta underfitting u overfitting?</b>'
        ],
        'correcta' => 'd',
        'porque'   => 'Esa es de la <b>fase 3, evaluacion</b>, junto con «&iquest;que metricas voy a usar?» y «&iquest;cuales son los criterios de exito?». Solo se puede juzgar el sobreajuste cuando ya hay resultados sobre datos de prueba.'
    ],

    'm9' => [
        'texto'    => 'Segun el whitepaper, &iquest;por que sigue haciendo falta el <b>elemento humano</b> en el machine learning?',
        'opciones' => [
            'a' => 'Porque las maquinas no pueden hacer calculos complejos',
            'b' => 'Porque los humanos <b>etiquetan los datos</b> que alimentan el modelo y ayudan a predecir y corregir imprecisiones, lo que da resultados mas exactos',
            'c' => 'Porque la ley obliga a que un humano firme cada prediccion',
            'd' => 'Porque los modelos no pueden ejecutarse sin supervision constante'
        ],
        'correcta' => 'b',
        'porque'   => 'Y el otro argumento del texto: si el modelo se topa con un dato que no entiende, una persona puede intervenir en tiempo real y ensenarselo, de modo que la proxima vez acierte.'
    ],

    'm10' => [
        'texto'    => 'Entre los <b>retos</b> que menciona el whitepaper esta el problema de los datos no etiquetados. &iquest;Por que es un problema?',
        'opciones' => [
            'a' => 'Porque los datos sin etiqueta ocupan mas espacio en disco',
            'b' => 'Porque el machine learning aprende de los datos y necesita <b>gran cantidad de datos etiquetados</b> para funcionar bien, pero muchas veces no estan disponibles o no vienen etiquetados',
            'c' => 'Porque los datos no etiquetados siempre estan mal',
            'd' => 'Porque las redes neuronales no admiten datos numericos'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la contracara del otro miedo que discute el texto («la tecnologia nos superara»): la IA es un conjunto de ecuaciones y algoritmos que <em>hay que entrenar</em>, asi que es tan lista como la ensenemos a ser.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, range(1, 35));
cabecera('Introduccion al Machine Learning', 'Machine_Learning_Def · Introduccion al ML · The Fundamentals of ML');
?>

<div class="card">
  <h2>Antes de empezar</h2>
  <p>Este cuestionario junta las tres lecturas de introduccion: la <b>definicion formal</b> de
     Mitchell, la <b>unidad 1</b> del curso (tipos de problema, categorias de aprendizaje y las
     tres fases) y el <b>whitepaper</b> en ingles (historia, tecnicas y aplicaciones).</p>
  <div class="nota">
    <b>Como se corrige.</b> Respuestas en castellano o en ingles, como prefieras
    (<code>por refuerzo</code> o <code>reinforcement</code>&hellip; bueno, ese en castellano).
    Da igual la tilde, la mayuscula, el guion y el articulo de delante:
    <code>K-Means</code> vale lo mismo que <code>k means</code>.
    Pulsa <b>Enter</b> dentro de un hueco para verificar.
  </div>
</div>


<div class="card">
  <h2>1. Que es el machine learning</h2>

  <h3>La definicion de Mitchell (1997)</h3>
  <p>Es la que hay que saberse literal. Completa las tres letras:</p>

  <div class="nota" style="background:#f7f8fa;border-left-color:#9aa3ad">
    Se dice que un programa de computador <b>aprende</b> de la
    <?php hueco(1, 16); ?> <b>E</b> respecto a una clase de
    <?php hueco(2, 14); ?> <b>T</b> y una medida de
    <?php hueco(3, 18); ?> <b>P</b>, si su desempeno en las T,
    medido por P, <b>mejora</b> con la E.
  </div>

  <h3>Machine learning y IA no son lo mismo</h3>
  <p>El objetivo de la <?php hueco(4, 24); ?> es imitar el comportamiento
     humano; el <?php hueco(5, 24); ?> es la tecnologia subyacente que le
     da las herramientas matematicas para conseguirlo.</p>

  <p>En su forma mas simple, el machine learning es <b>un conjunto de algoritmos aprendidos
     a partir de datos y experiencias, en lugar de ser programados explicitamente</b>.</p>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Un poco de historia</h2>
  <p>Los hitos que trae el whitepaper. Rellena lo que falta:</p>

  <table class="datos">
    <tr><th>Anio</th><th>Quien</th><th>Que</th></tr>
    <tr>
      <td><?php hueco(6, 8); ?></td>
      <td><?php hueco(7, 18); ?></td>
      <td>Crea el «Turing Test» para decidir si un computador es realmente inteligente</td>
    </tr>
    <tr>
      <td><?php hueco(8, 8); ?></td>
      <td>Arthur Samuel</td>
      <td>Primer programa que aprende: el juego de <?php hueco(9, 14); ?></td>
    </tr>
    <tr>
      <td><?php hueco(11, 8); ?></td>
      <td><?php hueco(10, 18); ?></td>
      <td>Disena la primera red neuronal para computadores</td>
    </tr>
    <tr>
      <td>1967</td>
      <td>&mdash;</td>
      <td>Se escribe el algoritmo del <?php hueco(12, 20); ?>, que permite empezar a reconocer patrones basicos</td>
    </tr>
    <tr>
      <td>1981</td><td>Gerald Dejong</td>
      <td>Explanation Based Learning (EBL): la maquina analiza los datos y crea una regla general descartando lo irrelevante</td>
    </tr>
    <tr>
      <td>1992</td><td>AT&amp;T</td>
      <td>Support Vector Machines (SVM) y el primer reconocimiento automatico de voz a escala nacional</td>
    </tr>
    <tr>
      <td>1996 / 1997</td><td>Patrick Haffner · AT&amp;T</td>
      <td>Primera red neuronal convolucional (CNN) y algoritmo Adaboost</td>
    </tr>
    <tr>
      <td><?php hueco(13, 8); ?></td><td>&mdash;</td>
      <td>Se promueve con exito el concepto de <?php hueco(15, 20); ?>, que aumenta la potencia y precision de las redes neuronales</td>
    </tr>
    <tr>
      <td><?php hueco(14, 8); ?></td><td>Google y Facebook</td>
      <td>Convierten el machine learning en la tecnologia central de su negocio</td>
    </tr>
  </table>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Los dos tipos de problema</h2>

  <p>En los problemas de <?php hueco(16, 18); ?> el objetivo es predecir un
     <b>valor numerico continuo</b> en funcion de un conjunto de variables de entrada.
     Sus tipos: lineal, logistica, Ridge y Lasso, y de arboles de decision.</p>

  <p>En los problemas de <?php hueco(17, 18); ?> el objetivo es asignar una
     <b>etiqueta o categoria</b> a un objeto o instancia en funcion de sus caracteristicas.
     Sus cuatro tipos son:</p>

  <div class="lineain" style="gap:14px;flex-wrap:wrap">
    <span><?php hueco(18, 14); ?></span>
    <span><?php hueco(19, 14); ?></span>
    <span><?php hueco(20, 16); ?></span>
    <span><?php hueco(21, 14); ?></span>
  </div>

  <div class="avisoflujo">
    <b>Los dos ejemplos del PDF.</b> Regresion: predecir el <em>precio de una casa</em> segun
    el numero de habitaciones &mdash; los puntos son los datos de entrenamiento y la recta es
    la mejor aproximacion. Clasificacion: decidir si un correo es <em>spam o no spam</em> a
    partir del remitente, el contenido y las palabras clave &mdash; los puntos se colorean
    segun su clase.
  </div>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Las tres categorias de aprendizaje</h2>

  <table class="datos">
    <tr><th>Categoria</th><th>Como son los datos</th><th>Ejemplo</th></tr>
    <tr>
      <td><?php hueco(22, 22); ?></td>
      <td>Conjuntos de datos <b>etiquetados</b>: le decimos al modelo que queremos que aprenda</td>
      <td>Reconocer numeros escritos a mano</td>
    </tr>
    <tr>
      <td><?php hueco(23, 22); ?></td>
      <td>Datos <b>sin etiquetar</b>: no hay etiqueta que predecir; se busca extraer conocimiento o agrupar por afinidad</td>
      <td>Segmentacion de clientes</td>
    </tr>
    <tr>
      <td><?php hueco(24, 22); ?></td>
      <td>Se <b>recompensan</b> los comportamientos deseados y se <b>penalizan</b> los no deseados; el agente aprende por prueba y error</td>
      <td>Un robot que aprende a caminar; juegos de estrategia</td>
    </tr>
  </table>

  <p>Los dos algoritmos de aprendizaje no supervisado que menciona el PDF son
     <?php hueco(25, 14); ?> y <?php hueco(26, 14); ?> .
     La tarea tipica del no supervisado, categorizar los datos en grupos de datos similares,
     se llama <?php hueco(27, 18); ?> .</p>

  <?php mc('m3'); ?>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Las tres fases de un modelo supervisado</h2>

  <p><b>Fase 1 &mdash; <?php hueco(28, 20); ?></b>. Las preguntas: &iquest;clasificacion o
     regresion?, &iquest;que atributos uso?, &iquest;como particiono los datos (cuantos para
     entrenamiento, validacion y prueba, se escogen al azar, el dataset esta desbalanceado)?,
     &iquest;que modelo uso y como ajusto el valor de los
     <?php hueco(31, 20); ?>?</p>

  <p><b>Fase 2 &mdash; <?php hueco(29, 20); ?></b>. Se usan datos que <b>no</b> se usaron
     para entrenar, y para cada conjunto de atributos de entrada se genera una prediccion.</p>

  <p><b>Fase 3 &mdash; <?php hueco(30, 20); ?></b>. &iquest;Que metricas uso (unas si es
     regresion, otras si es clasificacion)?, &iquest;cuales son los criterios de exito?,
     &iquest;hay underfitting u overfitting? Si el modelo no funciona, se modifican los
     hiperparametros o se cambia de modelo.</p>

  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Underfitting y overfitting</h2>
  <p>Se distinguen mirando <b>dos errores a la vez</b>, nunca uno solo:</p>

  <table class="datos">
    <tr><th>Nombre</th><th>Que ocurre</th><th>Error en entrenamiento</th><th>Error en prueba</th></tr>
    <tr>
      <td><?php hueco(32, 18); ?></td>
      <td>El modelo <b>no puede capturar</b> la relacion entre la variable objetivo y los predictores</td>
      <td>Alto</td><td>Alto</td>
    </tr>
    <tr>
      <td><?php hueco(33, 18); ?></td>
      <td>El modelo se ajusta <b>demasiado bien</b> a los datos de entrenamiento</td>
      <td>Bajo</td><td>Alto</td>
    </tr>
  </table>

  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Redes neuronales y el elemento humano</h2>

  <p>Las redes neuronales profundas (DNN) anaden capas <b>ocultas</b> que extraen
     representaciones intermedias. Las dos arquitecturas mas conocidas son las redes
     neuronales <?php hueco(34, 22); ?> , cuyas neuronas se mandan senales de
     retroalimentacion entre si, y las <?php hueco(35, 22); ?> , de tipo
     feed-forward y usadas sobre todo en reconocimiento visual y de imagenes.</p>

  <div class="avisoflujo">
    <b>Quien usa machine learning</b>, segun el whitepaper: finanzas (fraude, trading,
    riesgo crediticio), salud (diagnostico, informacion del paciente, descubrimiento de
    farmacos), marketing y ventas (personalizacion), servicios publicos, petroleo y gas,
    y transporte. Y en el dia a dia: Siri, la busqueda de Google, la carpeta de spam y
    las recomendaciones de Netflix.
  </div>

  <?php mc('m9'); ?>
  <?php mc('m10'); ?>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../SMART/index.php', '../Regresion/index.php');
