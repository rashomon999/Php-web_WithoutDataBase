<?php
/* ==========================================================================
   APO / CRISP  —  Ciclo de vida de la mineria de datos: CRISP-DM y ASUM-DM
   Fuente: CRISP-ASUM.pdf  (IBM SPSS Modeler / ASUM-DM)
   Todas las respuestas son de TEXTO: da igual tilde, mayuscula y articulo.
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [

    /* --- 1. CRISP-DM: las siglas y las seis fases --- */
    1  => ["Cross-Industry Standard Process for Data Mining",
           "Cross Industry Standard Process for Data Mining"],
    2  => ["Entendimiento del negocio", "Comprension del negocio", "Entender el negocio"],
    3  => ["Comprension de datos", "Comprension de los datos",
           "Entendimiento de datos", "Entendimiento de los datos"],
    4  => ["Preparacion de datos", "Preparacion de los datos"],
    5  => ["Modelado"],
    6  => ["Evaluacion"],
    7  => ["Despliegue"],

    /* --- 2. ASUM-DM --- */
    8  => ["Analytics Solutions Unified Method",
           "Metodo Unificado para Soluciones de Analitica"],
    9  => ["Iniciar"],
    10 => ["Planear", "Planificar"],
    11 => ["Ejecutar"],
    12 => ["Cerrar"],

    /* --- 3. las diez etapas operativas de ASUM-DM --- */
    13 => ["Entendimiento del negocio", "Comprension del negocio"],
    14 => ["Enfoque analitico"],
    15 => ["Requisitos de datos", "Requerimientos de datos"],
    16 => ["Recopilacion de datos", "Recoleccion de datos"],
    17 => ["Entendimiento de datos", "Entendimiento de los datos"],
    18 => ["Preparacion de datos", "Preparacion de los datos"],
    19 => ["Construccion del modelo"],
    20 => ["Evaluacion del modelo"],
    21 => ["Despliegue de solucion", "Despliegue de la solucion", "Despliegue"],
    22 => ["Retroalimentacion"],

    /* --- 4. entendimiento del negocio: los cuatro pasos --- */
    23 => ["Determinar los objetivos del negocio", "Determinar objetivos del negocio"],
    24 => ["Evaluar la situacion actual del negocio", "Evaluar la situacion actual"],
    25 => ["Crear un plan de trabajo", "Crear plan de trabajo", "Plan de trabajo"],
    26 => ["Generar un reporte de entendimiento del negocio",
           "Generar reporte de entendimiento del negocio",
           "Reporte de entendimiento del negocio"],

    /* actividades de «evaluar la situacion actual» */
    27 => ["Inventario de los recursos", "Inventario de recursos",
           "Llevar un inventario de los recursos"],
    28 => ["Glosario de terminologia", "Generar un glosario de terminologia",
           "Glosario"],
    29 => ["Analisis de costo-beneficio", "Costo-beneficio",
           "Construir un analisis de costo-beneficio", "Analisis costo-beneficio"],

    /* --- 5. entendimiento de datos: los cinco pasos --- */
    30 => ["Recolectar datos iniciales", "Recolectar los datos iniciales"],
    31 => ["Describir los datos", "Describir datos"],
    32 => ["Explorar datos", "Explorar los datos"],
    33 => ["Verificar la calidad de datos", "Verificar la calidad de los datos",
           "Verificar calidad de datos"],
    34 => ["Escribir un reporte de entendimiento de datos",
           "Reporte de entendimiento de datos",
           "Escribir reporte de entendimiento de datos"],

    35 => ["Datos faltantes", "Faltantes"],
    36 => ["Inconsistencias", "Inconsistencias en los datos"],
    37 => ["Valores atipicos", "Atipicos", "Outliers"],

    /* --- 6. preparacion de datos: los seis pasos --- */
    38 => ["Seleccionar datos", "Seleccionar los datos"],
    39 => ["Limpiar datos", "Limpiar los datos"],
    40 => ["Complementar datos", "Complementar los datos"],
    41 => ["Integrar datos", "Integrar los datos"],
    42 => ["Formatear datos", "Formatear los datos"],
    43 => ["Escribir reporte sobre preparacion de datos",
           "Reporte sobre preparacion de datos",
           "Escribir un reporte sobre preparacion de datos"],

    /* --- 7. construccion del modelo --- */
    44 => ["Seleccionar tecnicas de modelado", "Seleccionar las tecnicas de modelado"],
    45 => ["Disenar pruebas", "Diseñar pruebas"],
    46 => ["Construir modelo", "Construir el modelo"],
    47 => ["Entrenamiento"],
    48 => ["Prueba"],

    /* --- 8. evaluacion del modelo --- */
    49 => ["Evaluar resultados", "Evaluar los resultados"],
    50 => ["Repasar proceso", "Repasar el proceso"],
];

$MULTIPLE = [

    'm1' => [
        'texto'    => '&iquest;Que fase de un proyecto de mineria de datos consume mas tiempo, y cuanto?',
        'opciones' => [
            'a' => 'El modelado, entre el 50 y el 70 % del proyecto',
            'b' => 'La <b>preparacion de datos</b>, entre el <b>50 y el 70 %</b> del tiempo y esfuerzo',
            'c' => 'El despliegue, alrededor del 40 %',
            'd' => 'La evaluacion, alrededor del 60 %'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el dato que mas cae en el parcial: <b>50-70 %</b>. Y el texto anade el matiz importante: dedicar esfuerzo a las fases previas de comprension del negocio y de los datos <em>reduce</em> ese gasto, pero no lo elimina.'
    ],

    'm2' => [
        'texto'    => '&iquest;Que relacion hay entre CRISP-DM y ASUM-DM?',
        'opciones' => [
            'a' => 'Son metodologias rivales e incompatibles',
            'b' => 'ASUM-DM <b>extiende</b> lo propuesto por CRISP-DM, anadiendo actividades de gestion de proyectos y de despliegue-operacion',
            'c' => 'CRISP-DM extiende a ASUM-DM',
            'd' => 'ASUM-DM sustituyo a CRISP-DM y ya no se usa CRISP'
        ],
        'correcta' => 'b',
        'porque'   => 'ASUM (Analytics Solutions Unified Method) parte de CRISP-DM y le suma lo que a CRISP le faltaba: el <b>como gestionar el proyecto</b> (iniciar, planear, ejecutar, cerrar) y las etapas de operar y optimizar despues del despliegue.'
    ],

    'm3' => [
        'texto'    => 'ASUM-DM no depende de ninguna tecnologia externa. &iquest;Que quiere decir eso exactamente?',
        'opciones' => [
            'a' => 'Que solo funciona con productos de IBM',
            'b' => 'Que es solo una <b>forma de organizar las etapas</b> del proyecto: no te obliga a usar ninguna herramienta o plataforma concreta',
            'c' => 'Que no se pueden usar herramientas de software en el proyecto',
            'd' => 'Que no necesita datos'
        ],
        'correcta' => 'b',
        'porque'   => 'Es una metodologia, no un producto. Define <em>que</em> actividades hacer y en que orden; con que software las haces es cosa tuya.'
    ],

    'm4' => [
        'texto'    => 'En un CSV encuentras la columna <code>fecha</code> con valores como <code>03/05/2024</code> y otros como <code>mayo 3-2024</code>. &iquest;Que problema es ese?',
        'opciones' => [
            'a' => 'Datos faltantes',
            'b' => 'Valores atipicos',
            'c' => 'Una <b>inconsistencia</b>: los datos no estan en el formato que usa el negocio',
            'd' => 'Un error de integracion'
        ],
        'correcta' => 'c',
        'porque'   => 'El PDF los separa con cuidado: <b>faltante</b> es lo que viene en blanco o marcado como <code>null</code>, <code>N/A</code>, <code>?</code>; <b>inconsistencia</b> es que el dato esta, pero escrito en otro formato. Y el <b>atipico</b> es el que se sale de la distribucion principal.'
    ],

    'm5' => [
        'texto'    => '&iquest;Para que sirve el <b>glosario de terminologia</b> del paso «evaluar la situacion actual»?',
        'opciones' => [
            'a' => 'Para documentar el codigo del proyecto',
            'b' => 'Para que el equipo de analitica entienda los terminos que el negocio usa con un significado propio, y asi sepa que significan los datos y los resultados',
            'c' => 'Para traducir el proyecto a otro idioma',
            'd' => 'Para nombrar las columnas del dataframe'
        ],
        'correcta' => 'b',
        'porque'   => 'Es un problema de comunicacion, no de programacion: si para el negocio «cliente activo» significa algo muy concreto y el cientifico de datos no lo sabe, el modelo mide otra cosa.'
    ],

    'm6' => [
        'texto'    => 'El PDF menciona tres posibles origenes de los datos. &iquest;Cuales son?',
        'opciones' => [
            'a' => 'Datos propios del negocio, datos externos abiertos en Internet y datos externos que se pueden comprar',
            'b' => 'Datos numericos, categoricos y de fecha',
            'c' => 'Datos de entrenamiento, de validacion y de prueba',
            'd' => 'Datos completos, faltantes e inconsistentes'
        ],
        'correcta' => 'a',
        'porque'   => 'Va en el paso «recolectar datos iniciales» de la etapa de entendimiento de datos: <b>propios</b>, <b>abiertos</b> y <b>comprados</b>.'
    ],

    'm7' => [
        'texto'    => '&iquest;En que paso de ASUM-DM se decide separar los datos en un grupo de entrenamiento y otro de prueba?',
        'opciones' => [
            'a' => 'En «limpiar datos», dentro de preparacion de datos',
            'b' => 'En «<b>disenar pruebas</b>», dentro de construccion del modelo',
            'c' => 'En «evaluar resultados», dentro de evaluacion del modelo',
            'd' => 'En «explorar datos», dentro de entendimiento de datos'
        ],
        'correcta' => 'b',
        'porque'   => 'Disenar pruebas es definir <em>como se va a comprobar</em> que el modelo sirve, y por eso ahi entra la particion entrenamiento/prueba de los modelos supervisados. Ojo: se disena <b>antes</b> de construir el modelo.'
    ],

    'm8' => [
        'texto'    => 'El modelo cumple todas las metricas tecnicas. &iquest;Basta con eso para dar por buena la etapa de <b>evaluacion</b>?',
        'opciones' => [
            'a' => 'Si: si las metricas tecnicas salen bien, el proyecto esta terminado',
            'b' => 'No: hay que evaluar los resultados contra los <b>criterios de exito del negocio</b> definidos al inicio del proyecto',
            'c' => 'No: hay que volver siempre a la etapa de recopilacion de datos',
            'd' => 'Si, siempre que el modelo no tenga datos faltantes'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la distincion clave de la fase: el modelado ya dijo que el modelo es <em>tecnicamente</em> correcto. La evaluacion pregunta otra cosa: &iquest;esto le sirve al negocio segun lo que el negocio dijo al principio?'
    ],

    'm9' => [
        'texto'    => 'Tras la etapa de <b>retroalimentacion</b> hay que ajustar los modelos. &iquest;A que etapa se vuelve?',
        'opciones' => [
            'a' => 'A la etapa 1, entendimiento del negocio',
            'b' => 'A la etapa 6, preparacion de datos',
            'c' => 'A la etapa <b>7, construccion del modelo</b>',
            'd' => 'No se vuelve: el proyecto termina en la etapa 10'
        ],
        'correcta' => 'c',
        'porque'   => 'Lo dice el PDF literalmente al cerrar la etapa 10: si el negocio pide correcciones o ajustes a los modelos, <b>se vuelve a la etapa 7</b>.'
    ],

    'm10' => [
        'texto'    => '&iquest;Por que el PDF insiste en <b>documentar</b> lo que se hace en el paso de limpiar datos?',
        'opciones' => [
            'a' => 'Porque lo exige la ley de proteccion de datos',
            'b' => 'Porque a partir de ahi los datos ya <b>no son los originales</b>, y esas decisiones hay que tenerlas en cuenta al analizar los modelos que salgan',
            'c' => 'Porque el reporte es lo unico que se entrega al cliente',
            'd' => 'Porque sin documentar no se puede ejecutar el codigo'
        ],
        'correcta' => 'b',
        'porque'   => 'Si rellenaste huecos con la media o estimaste valores con un modelo estadistico, el dataset ya lleva decisiones tuyas dentro. Sin ese registro nadie puede juzgar despues si un resultado raro viene de los datos o de la limpieza.'
    ],
];

/* todas las respuestas son texto libre en castellano */
iniciar($SOLUCIONES, $MULTIPLE, range(1, 50));
cabecera('CRISP-DM y ASUM-DM · Ciclo de vida de la mineria de datos', 'CRISP-ASUM.pdf');
?>

<div class="card">
  <h2>Antes de empezar</h2>
  <p>Este cuestionario es de <b>nombres y orden</b>: las fases, las etapas y los pasos, cada
     uno en su sitio. Es lo que se pregunta de esta lectura.</p>
  <div class="nota">
    <b>Como se corrige.</b> Aqui las respuestas son en castellano, asi que el motor es blando:
    da igual la <b>tilde</b>, da igual la <b>mayuscula</b>, da igual el <b>articulo</b> de delante
    y da igual el punto final. <code>La Preparacion de Datos</code>,
    <code>preparación de datos</code> y <code>Preparación de los datos.</code> se aceptan las tres.
    Pulsa <b>Enter</b> dentro de un hueco para verificar sin bajar al boton.
  </div>
</div>


<div class="card">
  <h2>1. CRISP-DM: que es y de que consta</h2>

  <p>CRISP-DM son las siglas de:</p>
  <?php linea(1, 'las cuatro palabras en ingles, tal cual'); ?>
  <?php ayuda('Empieza por <code>Cross-Industry</code>&hellip; y termina en <code>&hellip; for Data Mining</code>.'); ?>

  <p>Es un metodo probado para orientar los trabajos de mineria de datos, y se organiza en
     <b>seis fases</b>. Escribelas en orden:</p>

  <?php linea(2, 'Fase 1 — explorar las expectativas de la organizacion respecto a la mineria de datos, implicando a cuanta mas gente mejor'); ?>
  <?php linea(3, 'Fase 2 — estudiar mas de cerca los datos disponibles: acceder a ellos y explorarlos con tablas y graficos'); ?>
  <?php linea(4, 'Fase 3 — la mas larga: preparar y empaquetar los datos para la mineria'); ?>
  <?php linea(5, 'Fase 4 — se ejecuta en varias iteraciones, ajustando parametros o volviendo a la fase anterior'); ?>
  <?php linea(6, 'Fase 5 — comprobar los resultados contra los criterios de rendimiento <b>comercial</b> fijados al inicio'); ?>
  <?php linea(7, 'Fase 6 — usar los nuevos conocimientos para implementar mejoras en la organizacion'); ?>

  <?php mc('m1'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. ASUM-DM</h2>

  <p>ASUM son las siglas, en ingles, de:</p>
  <?php linea(8, 'las cuatro palabras en ingles (o su traduccion: «Metodo Unificado para Soluciones de Analitica»)'); ?>

  <p>Ademas de las actividades de operacion, ASUM-DM anade cuatro actividades de
     <b>gestion de proyectos</b>. Escribelas en orden:</p>

  <div class="lineain" style="gap:14px;flex-wrap:wrap">
    <span><?php hueco(9, 12); ?></span>
    <span>&#8594; <?php hueco(10, 12); ?></span>
    <span>&#8594; <?php hueco(11, 12); ?></span>
    <span>&#8594; <?php hueco(12, 12); ?></span>
  </div>

  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Las diez etapas operativas de ASUM-DM</h2>
  <p>Esta es la lista que hay que saberse de memoria y <b>en orden</b>. Fijate en que las
     cuatro primeras son de negocio y de datos, y solo la septima es modelar.</p>

  <?php linea(13, '<b>1.</b> Entender los objetivos y requerimientos desde la perspectiva del negocio, y convertirlos en un problema abordable desde la analitica'); ?>
  <?php linea(14, '<b>2.</b> Traducir los objetivos del negocio en metas de analitica: predecir, segmentar, clasificar, encontrar relaciones&hellip;'); ?>
  <?php linea(15, '<b>3.</b> Definir que datos se usaran: identificar posibles fuentes y variables'); ?>
  <?php linea(16, '<b>4.</b> Adquirir los datos a partir de fuentes propias y externas'); ?>
  <?php linea(17, '<b>5.</b> Explorar mas a fondo los datos ya recopilados: generar estadisticas y caracterizarlos'); ?>
  <?php linea(18, '<b>6.</b> La etapa mas larga: dejar los datos con la calidad que exige el proyecto'); ?>
  <?php linea(19, '<b>7.</b> Hacer el modelamiento; es iterativo y puede obligar a volver a la etapa 6'); ?>
  <?php linea(20, '<b>8.</b> Comprobar si los modelos son apropiados <em>para el negocio</em>, segun sus criterios de exito'); ?>
  <?php linea(21, '<b>9.</b> Definir como se le mostraran los resultados a los usuarios interesados'); ?>
  <?php linea(22, '<b>10.</b> El negocio opina sobre lo hecho y puede pedir correcciones a los modelos'); ?>

  <?php mc('m9'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Etapa 1 · Entendimiento del negocio</h2>
  <p>Cuatro pasos. El proposito de la etapa entera es convertir el objetivo del negocio en
     un problema que se pueda atacar con analitica.</p>

  <?php linea(23, '<b>Paso 1</b> — recuento historico del negocio, objetivo principal a lograr y criterios de exito medibles'); ?>
  <?php linea(24, '<b>Paso 2</b> — inventario de recursos, requerimientos y restricciones, riesgos, glosario y costo-beneficio'); ?>
  <?php linea(25, '<b>Paso 3</b> — describir paso a paso las tareas de cada etapa para lograr las metas de analitica'); ?>
  <?php linea(26, '<b>Paso 4</b> — consolidar todo lo anterior en un documento, para que negocio y equipo esten al tanto'); ?>

  <h3>Las cinco actividades del paso 2</h3>
  <p>Dos ya las tienes en la pista: <em>determinar requerimientos y restricciones</em> y
     <em>evaluar riesgos y contingencias</em>. Faltan estas tres:</p>

  <?php linea(27, 'Listar el personal, la informacion, la arquitectura computacional y el software disponibles'); ?>
  <?php linea(28, 'Recoger los terminos que el negocio usa con un significado propio, para que el equipo de analitica los entienda'); ?>
  <?php linea(29, 'Calcular cuanto cuesta el proyecto y cuanto ganara el negocio al completarlo'); ?>

  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Etapa 5 · Entendimiento de datos</h2>
  <p>Cinco pasos. «Un buen desarrollo de esta etapa ahorra problemas en el futuro».</p>

  <?php linea(30, '<b>Paso 1</b> — acceder a los datos disponibles y adquirir nuevos si hace falta; cargarlos e integrarlos'); ?>
  <?php linea(31, '<b>Paso 2</b> — examinar las propiedades generales: numero de filas, tipo de cada columna, promedio, desviacion, maximos, mediana y minimos'); ?>
  <?php linea(32, '<b>Paso 3</b> — visualizar en tablas, barras y diagramas de caja para ver lo comun, lo raro y los valores extremos'); ?>
  <?php linea(33, '<b>Paso 4</b> — consolidar los hallazgos y responder: &iquest;estan completos? &iquest;hay errores? &iquest;hay datos faltantes?'); ?>
  <?php linea(34, '<b>Paso 5</b> — cerrar la etapa con un reporte detallado de todo lo encontrado'); ?>

  <h3>Los tres problemas que hay que saber nombrar</h3>
  <?php linea(35, 'Los que aparecen en blanco o marcados como <code>null</code>, <code>N/A</code>, <code>?</code>'); ?>
  <?php linea(36, 'Cuando el dato existe pero no esta en el formato que usa el negocio (una fecha como «mes, dia-anio»)'); ?>
  <?php linea(37, 'Los datos que se salen de la distribucion principal'); ?>

  <?php mc('m4'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Etapa 6 · Preparacion de datos</h2>
  <p>Seis pasos, y en este orden. Es la etapa mas larga del proyecto porque los datos del
     negocio casi nunca vienen con la calidad que hace falta.</p>

  <?php linea(38, '<b>Paso 1</b> — escoger que datos se usan, segun la meta del proyecto, la calidad y las restricciones tecnologicas'); ?>
  <?php linea(39, '<b>Paso 2</b> — mejorar la calidad: insertar valores predeterminados o estimar los faltantes con modelado estadistico'); ?>
  <?php linea(40, '<b>Paso 3</b> — conseguir mas filas de las fuentes, o mas columnas calculadas a partir de las originales'); ?>
  <?php linea(41, '<b>Paso 4</b> — unir en una misma tabla lo que venia de fuentes distintas, con procesos de agregacion'); ?>
  <?php linea(42, '<b>Paso 5</b> — unificar la sintaxis: cambiar como se muestra la informacion conservando su significado'); ?>
  <?php linea(43, '<b>Paso 6</b> — describir detalladamente todo lo hecho en los pasos anteriores'); ?>

  <?php mc('m10'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Etapa 7 · Construccion del modelo</h2>
  <p>Tres pasos. Es iterativo: si el modelo no da la talla, se vuelve a la preparacion de datos.</p>

  <?php linea(44, '<b>Paso 1</b> — definir cual es el modelo mas apropiado y con que metricas se va a evaluar'); ?>
  <?php linea(45, '<b>Paso 2</b> — generar el procedimiento con el que se haran las pruebas de calidad y validez'); ?>
  <?php linea(46, '<b>Paso 3</b> — usar los datos ya preparados para generar el modelo, atento a problemas de ejecucion o inconsistencias'); ?>

  <p>Los modelos supervisados obligan a partir los datos en dos grupos: el grupo de
     <?php hueco(47, 16); ?> , con el que se construye el modelo, y el grupo de
     <?php hueco(48, 16); ?> , con el que se calcula la validez de los resultados.</p>

  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Etapas 8, 9 y 10 · Evaluar, desplegar y retroalimentar</h2>
  <p>La etapa 8 tiene dos pasos:</p>

  <?php linea(49, '<b>Paso 1</b> — comprobar que lo obtenido cumple los criterios de exito del negocio y si hubo hallazgos nuevos'); ?>
  <?php linea(50, '<b>Paso 2</b> — repasar las tareas hechas por si algo quedo por alto: fallas, pasos innecesarios o no planeados'); ?>

  <div class="avisoflujo">
    <b>El cierre del ciclo.</b> La etapa 9 (<em>despliegue de solucion</em>) define como se le
    muestran los resultados a los usuarios interesados. La etapa 10
    (<em>retroalimentacion</em>) recoge la opinion del negocio: si pide correcciones o ajustes
    a los modelos, se vuelve a la <b>etapa 7</b>. Por eso esto es un ciclo y no una lista.
  </div>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../Estadistica/index.php');
