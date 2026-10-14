<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Farley cap. 5 — bloque 03: Commit stage y Automated
   Acceptance Test Gate.
   Fuente: Continuous Delivery (Humble & Farley) — Chapter 5: "The Commit
   Stage" y "The Automated Acceptance Test Gate"
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- commit stage --- */
    1  => ['cada check-in', 'cada commit', 'cada cambio'],
    2  => ['release candidate', 'candidato a release', 'candidato de release', 'candidato a liberacion'],
    3  => ['no aptas', 'no aptos', 'inservibles', 'no aptas para produccion', 'no aptos para produccion'],
    4  => ['rapido', 'lo mas rapido posible', 'rapidamente', 'tan rapido como sea posible'],
    5  => ['minimo', 'un minimo'],
    6  => ['espera', 'esperar'],
    7  => ['grilla de build', 'build grid', 'grid de build', 'grid'],
    8  => ['cinco minutos', '5 minutos', '5'],
    9  => ['diez minutos', '10 minutos', '10'],
    10 => ['compilar', 'compila el codigo'],
    11 => ['pruebas de commit', 'commit tests', 'suite de commit', 'pruebas del commit'],
    12 => ['binarios', 'crear binarios'],
    13 => ['analisis del codigo', 'analisis de codigo', 'analisis'],
    14 => ['artefactos', 'preparar artefactos'],
    15 => ['base de datos de pruebas', 'bases de datos de prueba', 'test databases', 'bd de pruebas'],
    16 => ['inmediatamente', 'de inmediato', 'enseguida'],
    17 => ['desarrolladores que hicieron commit', 'los desarrolladores que hicieron commit', 'devs que hicieron commit', 'los que hicieron check-in', 'desarrolladores'],
    18 => ['unitarias', 'pruebas unitarias', 'unit tests'],
    19 => ['otros tipos', 'otro tipo', 'otros tipos de pruebas', 'de otros tipos'],
    20 => ['pretested commit', 'commit probado previamente', 'pretested', 'pretested commit en la build grid'],
    21 => ['todas las pruebas unitarias', 'todas las unitarias', 'todas las pruebas unitarias.'],
    22 => ['etapas posteriores', 'etapas tardias', 'etapas posteriores del pipeline', 'etapas tardias del pipeline'],
    23 => ['mejora continua', 'optimizacion continua', 'optimizacion del proceso', 'continua', 'optimizacion continua del proceso'],
    24 => ['no funcionales', 'caracteristicas no funcionales', 'no funcional'],
    25 => ['cobertura de pruebas', 'test coverage', 'cobertura', 'cobertura de tests'],
    26 => ['codigo duplicado', 'duplicacion', 'duplicacion de codigo', 'cantidad de codigo duplicado'],
    27 => ['complejidad ciclomatica', 'cyclomatic complexity', 'ciclomatica'],
    28 => ['acoplamiento aferente y eferente', 'acoplamiento', 'afferent and efferent coupling', 'aferente y eferente'],
    29 => ['advertencias', 'warnings', 'numero de advertencias', 'numero de warnings'],
    30 => ['estilo de codigo', 'estilo', 'code style'],
    31 => ['5', '5%', 'cinco', 'cinco por ciento'],
    32 => ['umbrales', 'umbrales prefijados', 'umbrales preestablecidos', 'thresholds'],
    33 => ['prueba fallida', 'test fallido', 'una prueba que falla', 'una prueba fallida', 'prueba que falla'],
    34 => ['ensamblado desplegable', 'ensamblaje desplegable', 'ensamblado listo para desplegar', 'ensamblaje del codigo', 'ensamblado del codigo'],
    35 => ['criterio de exito', 'criterio de exito propio', 'criterio de exito en si mismo'],
    36 => ['revisada', 'evaluacion', 'evaluado', 'revision', 'evaluacion constante', 'evaluacion y revision constantes'],
    37 => ['deshacer sus cambios', 'revertir sus cambios', 'retirar sus cambios', 'echar atras sus cambios', 'sacar sus cambios', 'back out'],
    38 => ['arreglar el problema rapidamente', 'arreglar rapidamente', 'arreglarlo rapidamente', 'arreglar el problema', 'arreglarlo'],
    39 => ['largas', 'lentas', 'lengthy', 'largas actividades', 'actividades largas', 'lentas y largas'],
    40 => ['procesadores', 'procesador', 'instrucciones', 'pipeline de instrucciones', 'procesadores pipelining', 'pipelining de instrucciones'],
    41 => ['paralelismo', 'un grado de paralelismo'],
    42 => ['adivinar', 'adivina', 'adivinan', 'suposicion'],
    43 => ['exito', 'que todas las etapas pasaran', 'que todo pasara', 'las pruebas pasaran'],
    44 => ['nuevas funcionalidades', 'nuevas features', 'nueva funcionalidad', 'nuevas caracteristicas'],
    45 => ['deuda tecnica', 'deuda tecnicas', 'nuestras deudas tecnicas'],
    46 => ['hito', 'milestone', 'compuerta', 'puerta'],
    47 => ['prioridad', 'maxima prioridad', 'la prioridad numero uno'],

    /* --- acceptance test gate --- */
    48 => ['nivel de api', 'api', 'nivel bajo de api', 'api de bajo nivel'],
    49 => ['de una manera particular', 'de una forma particular', 'de una determinada manera', 'de cierta manera', 'de una determinada forma'],
    50 => ['resuelve un problema', 'resuelve un problema particular', 'resuelve un problema concreto', 'soluciona un problema'],
    51 => ['80', 'ochenta', '80 desarrolladores'],
    52 => ['tres semanas', '3 semanas', 'tres', '3'],
    53 => ['90', '90%', 'noventa'],
    54 => ['solo ejecutaban las pruebas', 'ejecutaban las pruebas', 'las pruebas', 'solo las pruebas', 'solo ejecutaban pruebas'],
    55 => ['humo', 'smoke', 'smoke tests', 'pruebas de humo', 'pruebas smoke'],
    56 => ['perspectiva del desarrollador', 'perspectiva de un desarrollador', 'punto de vista del desarrollador', 'punto de vista del programador', 'perspectiva de desarrollador', 'la perspectiva del desarrollador'],
    57 => ['perspectiva del usuario', 'punto de vista del usuario', 'perspectiva del usuario.', 'la perspectiva del usuario', 'perspectiva de los usuarios'],
    58 => ['un entorno parecido a produccion', 'entorno parecido a produccion', 'entorno tipo produccion', 'entorno similar a produccion', 'entorno production-like'],
    59 => ['ciclo vicioso', 'circulo vicioso', 'bucle vicioso', 'un ciclo vicioso'],
    60 => ['experimento', 'un experimento', 'un nuevo experimento'],
    61 => ['de alto riesgo', 'alto riesgo', 'muy alto riesgo', 'riesgo alto', 'de muy alto riesgo'],
    62 => ['especificaciones del cliente', 'las especificaciones del cliente', 'especificaciones', 'especificacion del cliente'],
    63 => ['criterios de aceptacion', 'los criterios de aceptacion', 'criterios', 'criterios de aceptacion.'],
    64 => ['regresion', 'pruebas de regresion', 'suite de regresion', 'de regresion', 'regresion.'],
    65 => ['equipos multifuncionales', 'equipos transversales', 'equipos cross-functional', 'cross-functional', 'equipos multidisciplinarios', 'equipos de entrega multifuncionales', 'equipos multifuncionales de entrega'],
    66 => ['clientes', 'los clientes', 'cliente'],
    67 => ['inmediatamente', 'de inmediato', 'enseguida', 'inmediata'],
    68 => ['regresion', 'una regresion', 'una regresion introducida'],
    69 => ['cambio intencional', 'cambio intencionado', 'un cambio intencional', 'un cambio intencional en el comportamiento', 'cambio intencionado en el comportamiento'],
    70 => ['problema con la prueba', 'un problema con la prueba', 'problema en la prueba', 'un problema de la prueba', 'fallo de la prueba', 'error en la prueba'],
    71 => ['segundo hito', 'segundo milestone', 'segundo hito importante', 'segunda puerta', 'segunda compuerta', 'segundo hito significativo'],
    72 => ['hacer lo correcto', 'lo correcto', 'hacer lo correcto que lo incorrecto'],
    73 => ['nunca', 'jamas', 'nunca se libera', 'nunca sera liberado'],
    74 => ['copia', 'una copia', 'copia de este entorno', 'copia del entorno de produccion'],
    75 => ['reducida', 'version reducida', 'escala reducida', 'una version reducida', 'version a escala reducida', 'version a menor escala'],
    76 => ['test doubles', 'dobles de prueba', 'dobles de test', 'test double', 'dobles'],
    77 => ['grilla de build', 'build grid', 'grid de build', 'grid'],
    78 => ['en paralelo', 'paralelo', 'paralelamente', 'a la vez', 'simultaneamente'],
    79 => ['equipo dedicado', 'un equipo dedicado', 'equipo separado', 'un equipo aparte', 'un equipo separado', 'equipo aparte'],
    80 => ['propietarios', 'duenos', 'no se sienten duenos', 'duenos de las pruebas', 'propietarios de las pruebas', 'no las sienten propias'],
    81 => ['interfaz de usuario', 'ui', 'la ui', 'la interfaz de usuario', 'interfaz'],
    82 => ['frágiles', 'fragiles', 'fragil', 'quebradizas', 'quebradizos'],
    83 => ['todo el equipo', 'el equipo entero', 'el equipo completo', 'todo el equipo es dueno'],
    84 => ['maquinas de desarrollo', 'sus maquinas de desarrollo', 'entornos de desarrollo', 'sus entornos de desarrollo', 'la maquina de desarrollo', 'su maquina de desarrollo'],
    85 => ['licencias', 'licencias insuficientes', 'insuficientes licencias', 'falta de licencias', 'licencias del software de pruebas'],
    86 => ['arquitectura de la aplicacion', 'la arquitectura de la aplicacion', 'arquitectura', 'arquitectura de la app'],
    87 => ['lenguaje del negocio', 'el lenguaje del negocio', 'lenguaje de negocio', 'lenguaje ubicuo', 'ubiquitous language', 'el lenguaje ubicuo'],
    88 => ['eric evans', 'evans'],
    89 => ['place order', 'realizar pedido', 'hacer pedido', 'colocar pedido', 'place order.', 'hacer un pedido'],
    90 => ['click order button', 'hacer clic en el boton de pedido', 'click en boton de pedido', 'clic en el boton pedido', 'clic en el boton de pedido', 'hacer click en el boton de pedido'],
    91 => ['confirm fund transfer', 'confirmar transferencia de fondos', 'confirmar la transferencia de fondos', 'confirmar transferencia'],
    92 => ['pruebas de regresion', 'de regresion', 'regresion', 'tambien son pruebas de regresion'],
    93 => ['costosas', 'caras', 'costosas de crear y mantener', 'caras de crear y mantener', 'costosas y dificiles de mantener'],
    94 => ['ciegamente', 'de forma ingenua', 'sin pensar', 'ingenuamente', 'automatizar ciegamente', 'automatizarlos ciegamente', 'de manera ciega', 'de manera ingenua'],
    95 => ['cuesta mas que ahorra', 'cuestan mas de lo que ahorran', 'cuestan mas que ahorran', 'cuesta mas de lo que ahorra', 'costo mayor que el ahorro', 'cuestan mas esfuerzo del que ahorran', 'mas esfuerzo del que ahorran'],
];

$TEXTO = [];
for ($i = 1; $i <= 95; $i++) $TEXTO[] = $i;

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Cuál es el <b>objetivo de la etapa de commit</b>?',
        'opciones' => [
            'a' => 'Publicar el release',
            'b' => 'Eliminar builds no aptos para producción y avisar al equipo <b>lo más rápido posible</b> de que la aplicación está rota; gastar el mínimo esfuerzo en una versión obviamente rota',
            'c' => 'Probar el rendimiento',
            'd' => 'Hacer demos con el cliente'
        ],
        'correcta' => 'b',
        'porque'   => 'Se crea una instancia del pipeline con cada check-in y, si la primera etapa pasa, se crea un <b>release candidate</b>. El dev que hizo commit espera el resultado antes de pasar a otra tarea.'
    ],
    'm2' => [
        'texto'    => '¿Cuánto debería tardar la etapa de commit?',
        'opciones' => [
            'a' => 'Idealmente menos de <b>cinco minutos</b>; y desde luego no más de <b>diez</b>',
            'b' => 'Una hora',
            'c' => 'Un día',
            'd' => 'No importa'
        ],
        'correcta' => 'a',
        'porque'   => 'Los trabajos se ejecutan en una build grid para que termine en un tiempo razonable. Si supera los cinco minutos conviene dividirla en suites que corran en paralelo.'
    ],
    'm3' => [
        'texto'    => 'Pasos típicos de la etapa de commit:',
        'opciones' => [
            'a' => 'Desplegar y monitorear',
            'b' => 'Compilar el código (si hace falta), correr los <b>commit tests</b>, crear binarios para etapas posteriores, hacer análisis de código para comprobar su salud y preparar artefactos (p. ej. bases de datos de prueba)',
            'c' => 'Escribir documentación',
            'd' => 'Aprobar el release'
        ],
        'correcta' => 'b',
        'porque'   => 'Si la compilación falla, se falla la etapa de inmediato y se avisa a los desarrolladores que hicieron commit desde el último check-in exitoso.'
    ],
    'm4' => [
        'texto'    => '¿Por qué se llaman <b>“commit tests”</b> y no “unit tests”?',
        'opciones' => [
            'a' => 'Por marketing',
            'b' => 'Porque no son tests',
            'c' => 'Porque son manuales',
            'd' => 'Porque, aunque la gran mayoría son unitarios, conviene incluir una pequeña selección de <b>otros tipos</b> para tener más confianza de que la app realmente funciona si la etapa pasa'
        ],
        'correcta' => 'd',
        'porque'   => 'Son los mismos que los devs corren antes de hacer check-in (o mediante un <i>pretested commit</i> en la build grid).'
    ],
    'm5' => [
        'texto'    => '¿Cómo se diseña y evoluciona la <b>suite de commit tests</b>?',
        'opciones' => [
            'a' => 'Se empieza ejecutando todas las pruebas unitarias; luego, al aprender qué fallos son comunes en la aceptación y otras etapas, se agregan pruebas específicas para <b>encontrarlos temprano</b> (optimización continua del proceso, para evitar los costos de encontrar bugs más tarde)',
            'b' => 'Se define una vez y no se toca',
            'c' => 'Se elimina',
            'd' => 'Solo la escribe QA'
        ],
        'correcta' => 'a',
        'porque'   => 'Es una optimización de proceso continua.'
    ],
    'm6' => [
        'texto'    => 'Métricas de <b>análisis estático</b> para la etapa de commit (elige la lista correcta):',
        'opciones' => [
            'a' => 'Cobertura de pruebas, código duplicado, complejidad ciclomática, acoplamiento aferente y eferente, número de warnings y estilo de código',
            'b' => 'Ventas, usuarios y descargas',
            'c' => 'Latencia y throughput',
            'd' => 'Horas trabajadas'
        ],
        'correcta' => 'a',
        'porque'   => 'Si tus commit tests cubren solo el 5 % del código son casi inútiles. Incumplir umbrales prefijados debe hacer fallar la etapa igual que una prueba fallida.'
    ],
    'm7' => [
        'texto'    => '¿Qué pasa si el código no cumple los <b>umbrales</b> de las métricas de código?',
        'opciones' => [
            'a' => 'Se avisa por correo',
            'b' => 'Nada',
            'c' => 'La etapa de commit <b>falla</b>, igual que si fallara una prueba',
            'd' => 'Se pasa a la siguiente'
        ],
        'correcta' => 'c',
        'porque'   => 'Las métricas dan feedback sobre características <b>no funcionales</b> (mantenibilidad, seguridad, etc.), aunque probar capacidad sea difícil.'
    ],
    'm8' => [
        'texto'    => 'El <b>último paso</b> de la etapa de commit es…',
        'opciones' => [
            'a' => 'Un correo',
            'b' => 'Crear un ensamblado desplegable del código, listo para cualquier entorno posterior; también debe tener éxito para considerar exitosa la etapa, lo que somete al propio proceso de build a evaluación y revisión constantes',
            'c' => 'Subir a Git',
            'd' => 'Borrar el código'
        ],
        'correcta' => 'b',
        'porque'   => 'Tratar la creación del ejecutable como criterio de éxito en sí mismo.'
    ],
    'm9' => [
        'texto'    => 'Buenas prácticas de la etapa de commit: si <b>falla</b>, los desarrolladores deben…',
        'opciones' => [
            'a' => 'Irse a casa',
            'b' => 'Seguir trabajando en otra cosa',
            'c' => 'Arreglar el problema rápidamente o <b>deshacer sus cambios</b> del control de versiones',
            'd' => 'Ignorarlo'
        ],
        'correcta' => 'c',
        'porque'   => 'En un mundo ideal esperarían que pasen incluso las pruebas manuales, pero en la práctica las etapas posteriores son lentas.'
    ],
    'm10' => [
        'texto'    => '¿Por qué se le llama <b>“pipeline”</b> según los autores?',
        'opciones' => [
            'a' => 'Porque fluye como un líquido por una tubería',
            'b' => 'Porque lo inventó una petrolera',
            'c' => 'Por analogía con el <i>pipelining</i> de instrucciones de los <b>procesadores</b>: se “adivina” que las etapas posteriores pasarán y se sigue trabajando en paralelo; si se acierta, se gana velocidad; si no, se descarta sin pérdida',
            'd' => 'Porque usa tuberías de red'
        ],
        'correcta' => 'c',
        'porque'   => 'Se diseña la etapa de commit para atrapar la mayoría de problemas rápido; se apuesta por el éxito de las demás y se retoma el trabajo (nuevas funcionalidades) mientras el pipeline sigue optimistamente.'
    ],
    'm11' => [
        'texto'    => 'Tras pasar la etapa de commit los desarrolladores…',
        'opciones' => [
            'a' => 'Ya no tienen responsabilidad',
            'b' => 'Quedan libres para su siguiente tarea, pero <b>retienen la responsabilidad</b> de monitorear las etapas posteriores; arreglar builds rotos sigue siendo la máxima prioridad aunque el fallo ocurra en etapas tardías',
            'c' => 'Deben esperar a producción',
            'd' => 'Solo se ocupan de la documentación'
        ],
        'correcta' => 'b',
        'porque'   => '“Estamos apostando por el éxito, pero estamos listos para pagar nuestra deuda técnica si la apuesta falla.”'
    ],
    'm12' => [
        'texto'    => 'Solo con la <b>etapa de commit</b> implementada…',
        'opciones' => [
            'a' => 'No se gana nada',
            'b' => 'Ya es un enorme paso en fiabilidad y calidad, pero hacen falta más etapas para un pipeline mínimo',
            'c' => 'Ya está completo',
            'd' => 'Se puede liberar directamente'
        ],
        'correcta' => 'b',
        'porque'   => 'Siguiente hito: el acceptance test gate.'
    ],
    'm13' => [
        'texto'    => '¿Por qué las pruebas unitarias <b>no bastan</b>?',
        'opciones' => [
            'a' => 'Porque son lentas',
            'b' => 'Porque son caras',
            'c' => 'Porque están tan acopladas a la API de bajo nivel que caen en la trampa de probar que la solución funciona de una manera particular en lugar de afirmar que <b>resuelve un problema</b>; solo reflejan la perspectiva del desarrollador',
            'd' => 'Porque no existen'
        ],
        'correcta' => 'c',
        'porque'   => 'No prueban que la app cumple las especificaciones del cliente ni que puede desplegarse y sobrevivir en el mundo real.'
    ],
    'm14' => [
        'texto'    => 'Caso <b>“Why Unit Tests Aren’t Enough”</b> (proyecto de ~80 devs): ¿qué ocurrió?',
        'opciones' => [
            'a' => 'El build siempre falló',
            'b' => 'Alguien borró el código',
            'c' => 'El despliegue en test parecía roto; tras revisar la configuración, un senior probó en su máquina y tampoco funcionaba; retrocediendo versiones descubrieron que <b>hacía tres semanas</b> un bug oscuro impedía arrancar el sistema, con ~90 % de cobertura unitaria; los devs solo ejecutaban las pruebas, no la aplicación',
            'd' => 'La BD se llenó'
        ],
        'correcta' => 'c',
        'porque'   => 'Solución: unas pocas pruebas automatizadas de <b>humo</b> en el CI que demostraran que la aplicación corría y podía hacer su función más fundamental.'
    ],
    'm15' => [
        'texto'    => 'Del caso anterior, la lección fundamental es…',
        'opciones' => [
            'a' => 'Que las pruebas unitarias son inútiles',
            'b' => 'Que las pruebas unitarias solo prueban la <b>perspectiva del desarrollador</b> y tienen capacidad limitada para demostrar que la aplicación hace lo que debe desde la perspectiva del <b>usuario</b>',
            'c' => 'Que hay que contratar más devs',
            'd' => 'Que no se necesita CI'
        ],
        'correcta' => 'b',
        'porque'   => 'Ejecutar la app a mano ayudaría, pero no es eficaz en una aplicación grande y compleja.'
    ],
    'm16' => [
        'texto'    => 'En el mismo caso, su primera suposición fue que el problema era el <b>despliegue</b>. ¿Por qué era razonable?',
        'opciones' => [
            'a' => 'Porque el despliegue era un proceso complejo, manual y propenso a error; y como tardaba tanto, el proceso cambiaba cada vez que se hacía (cada intento era un <b>experimento nuevo</b>) → un círculo vicioso con releases de altísimo riesgo',
            'b' => 'Porque el despliegue era trivial',
            'c' => 'Porque no existía',
            'd' => 'Porque estaba automatizado'
        ],
        'correcta' => 'a',
        'porque'   => 'Por eso hay que extender el CI para probar y ensayar también el despliegue y la aceptación en un entorno tipo producción.'
    ],
    'm17' => [
        'texto'    => '<b>Objetivo de la etapa de pruebas de aceptación</b>:',
        'opciones' => [
            'a' => 'Comprobar el estilo de código',
            'b' => 'Comprobar que compila',
            'c' => 'Afirmar que el sistema entrega el valor que el cliente espera y cumple los <b>criterios de aceptación</b>; además sirve como <b>suite de regresión</b>',
            'd' => 'Medir cobertura'
        ],
        'correcta' => 'c',
        'porque'   => 'La mayoría de las pruebas de esta etapa son de aceptación funcional, pero no todas.'
    ],
    'm18' => [
        'texto'    => '¿Quién crea y mantiene las pruebas de aceptación automatizadas (Cap. 8)?',
        'opciones' => [
            'a' => 'Equipos separados de QA',
            'b' => 'Nadie',
            'c' => 'Un contratista externo',
            'd' => '<b>Equipos de entrega multifuncionales</b>: desarrolladores, testers y clientes trabajan juntos, junto a las pruebas unitarias y el código'
        ],
        'correcta' => 'd',
        'porque'   => 'No las hace un equipo aparte; forman parte del núcleo del proceso de desarrollo.'
    ],
    'm19' => [
        'texto'    => 'Si una prueba de aceptación se rompe, el equipo debe decidir si es…',
        'opciones' => [
            'a' => 'Una regresión introducida, un <b>cambio intencional</b> en el comportamiento de la app, o un <b>problema de la prueba</b>; y tomar de inmediato la acción adecuada para volver a ponerla en verde',
            'b' => 'Solo un bug',
            'c' => 'Un asunto de QA',
            'd' => 'Una molestia'
        ],
        'correcta' => 'a',
        'porque'   => 'El equipo debe responder de inmediato a estas roturas.'
    ],
    'm20' => [
        'texto'    => 'El <b>acceptance test gate</b> es…',
        'opciones' => [
            'a' => 'El primer hito',
            'b' => 'El segundo hito significativo del ciclo de vida de un release candidate: el pipeline solo permite que etapas posteriores (p. ej. despliegues solicitados manualmente) accedan a builds que superaron las pruebas de aceptación automatizadas',
            'c' => 'El último hito',
            'd' => 'Opcional'
        ],
        'correcta' => 'b',
        'porque'   => 'Subvertir el sistema es tan costoso que es mejor arreglar el problema: “el pipeline hace más fácil hacer lo correcto que lo incorrecto, así que los equipos hacen lo correcto”. Un candidato que no cumple sus criterios nunca llega a los usuarios.'
    ],
    'm21' => [
        'texto'    => '¿En qué entorno se deben ejecutar las pruebas de aceptación?',
        'opciones' => [
            'a' => 'En el portátil del tester',
            'b' => 'En una <b>copia</b> del entorno de producción; si es complejo o caro, en una versión <b>reducida</b> (p. ej. un par de servidores de middleware en vez de muchos) y con <b>test doubles</b> para la infraestructura externa de la que se dependa',
            'c' => 'En producción',
            'd' => 'En ningún entorno'
        ],
        'correcta' => 'b',
        'porque'   => 'Si hay que soportar muchos entornos destino (p. ej. software instalado en el PC del usuario), se corren en paralelo en una build grid con al menos un entorno por cada destino.'
    ],
    'm22' => [
        'texto'    => '¿Por qué es mala idea tener un <b>equipo separado</b> que mantenga la suite de aceptación?',
        'opciones' => [
            'a' => 'Porque los devs no sienten las pruebas como suyas, ignoran los fallos (la etapa queda rota mucho tiempo) y esas pruebas, escritas sin conocer el diseño, quedan acopladas a la UI, frágiles y mal factorizadas (sin capas de abstracción ni pruebas contra API pública)',
            'b' => 'Porque cuesta más caro',
            'c' => 'Porque no hay testers suficientes',
            'd' => 'No es mala idea'
        ],
        'correcta' => 'a',
        'porque'   => 'La realidad: todo el equipo es dueño de las pruebas de aceptación, igual que de cada etapa del pipeline. Si fallan, todo el equipo para y las arregla.'
    ],
    'm23' => [
        'texto'    => 'Corolario: los desarrolladores deben poder…',
        'opciones' => [
            'a' => 'Solo leer los resultados',
            'b' => 'Ejecutar las pruebas de aceptación en <b>sus propias máquinas de desarrollo</b> para arreglar y verificar localmente los fallos; los obstáculos más comunes son licencias insuficientes y una arquitectura que impide desplegar el sistema en dev',
            'c' => 'Pedirle a QA que las corra',
            'd' => 'Esperar al servidor'
        ],
        'correcta' => 'b',
        'porque'   => 'Hay que eliminar esos obstáculos si se quiere que la estrategia de aceptación automatizada funcione a largo plazo.'
    ],
    'm24' => [
        'texto'    => '¿En qué lenguaje deben expresarse las pruebas de aceptación?',
        'opciones' => [
            'a' => 'En el lenguaje de la tecnología (IDs de botones, tablas)',
            'b' => 'En SQL',
            'c' => 'En el <b>lenguaje del negocio</b> (el <i>ubiquitous language</i> de Eric Evans): “place order” en vez de “click order button”; “confirm fund transfer” en vez de “check fund_table has results”',
            'd' => 'En ensamblador'
        ],
        'correcta' => 'c',
        'porque'   => 'Se puede escribir en el mismo lenguaje de programación del equipo, pero la abstracción debe estar al nivel del comportamiento de negocio; así se evita el acoplamiento excesivo a una solución concreta.'
    ],
    'm25' => [
        'texto'    => '“Las pruebas de aceptación son <b>caras</b> de crear y mantener”. ¿Qué recomienda el libro?',
        'opciones' => [
            'a' => 'Automatizar ciegamente cada criterio de aceptación',
            'b' => 'No automatizar',
            'c' => 'Recordar que también son pruebas de regresión y <b>no automatizar ingenuamente todos</b> los criterios; y, si las pruebas cuestan más esfuerzo del que ahorran, dejar la automatización funcional es correcto (aunque cambiar cómo se gestionan puede cambiar la ecuación costo-beneficio)',
            'd' => 'Automatizar solo la UI'
        ],
        'correcta' => 'c',
        'porque'   => 'Hacer bien la aceptación es el tema del capítulo 8.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Farley cap. 5 · 3 — Commit stage y acceptance test gate', 'Continuous Delivery, cap. 5: etapa de commit, mejores prácticas, origen del término pipeline, pruebas de aceptación automatizadas');
?>

<div class="card">
  <h2>1. La etapa de commit</h2>
  <ul>
    <li>Una nueva instancia del pipeline se crea con <?php hueco(1, 14); ?>; si la primera etapa pasa, se crea un <?php hueco(2, 16); ?>.</li>
    <li>Su meta es eliminar builds <?php hueco(3, 12); ?> para producción y avisar <?php hueco(4, 14); ?> de que la aplicación está rota, gastando un <?php hueco(5, 8); ?> de esfuerzo en una versión rota.
        El dev que hizo el commit <?php hueco(6, 8); ?> el resultado antes de pasar a otra tarea.</li>
    <li>Los trabajos corren como un conjunto de jobs en una <?php hueco(7, 14); ?>; debería tardar menos de <?php hueco(8, 14); ?> y como mucho <?php hueco(9, 12); ?>.</li>
    <li>Pasos típicos: <?php hueco(10, 10); ?> el código, correr los <?php hueco(11, 20); ?>, crear <?php hueco(12, 10); ?> para etapas posteriores, hacer <?php hueco(13, 18); ?> para
        revisar la salud del código y preparar <?php hueco(14, 12); ?> como <?php hueco(15, 26); ?>.</li>
    <li>Si la compilación falla, se falla la etapa <?php hueco(16, 14); ?> y se avisa a los <?php hueco(17, 30); ?> desde el último check-in exitoso.</li>
    <li>Se llaman commit tests (no solo unit tests) porque, aunque la mayoría son <?php hueco(18, 10); ?>, se incluye una pequeña selección de <?php hueco(19, 12); ?> para tener más confianza. Son los mismos
        que los devs corren antes del check-in o mediante un <?php hueco(20, 18); ?> en la build grid.</li>
    <li>Diseño: se empieza corriendo <?php hueco(21, 26); ?>; luego, al aprender qué fallos son comunes en <?php hueco(22, 20); ?>, se agregan pruebas específicas para encontrarlos temprano
        (<?php hueco(23, 24); ?>).</li>
  </ul>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. Análisis de código y cierre de la etapa</h2>
  <ul>
    <li>Compilar y pasar tests no dice mucho sobre las características <?php hueco(24, 14); ?>. Se usan herramientas de análisis con métricas útiles:</li>
  </ul>
  <table class="datos">
    <tr><th>Métrica</th></tr>
    <tr><td><?php hueco(25, 20); ?> (si los commit tests cubren solo el <?php hueco(31, 4); ?> % del código, son casi inútiles)</td></tr>
    <tr><td>Cantidad de <?php hueco(26, 20); ?></td></tr>
    <tr><td><?php hueco(27, 22); ?></td></tr>
    <tr><td><?php hueco(28, 32); ?></td></tr>
    <tr><td>Número de <?php hueco(29, 12); ?></td></tr>
    <tr><td><?php hueco(30, 18); ?></td></tr>
  </table>
  <ul>
    <li>Incumplir los <?php hueco(32, 10); ?> prefijados debe hacer fallar la etapa igual que una <?php hueco(33, 22); ?>.</li>
    <li>Paso final: crear un <?php hueco(34, 26); ?> del código listo para cualquier entorno posterior; debe tener éxito, como <?php hueco(35, 24); ?>, así el propio build queda sometido a
        <?php hueco(36, 26); ?> por el CI.</li>
    <li>Si la etapa falla, los devs deben <?php hueco(38, 28); ?> o <?php hueco(37, 28); ?> del control de versiones. No esperan todas las etapas porque las posteriores son <?php hueco(39, 12); ?>.</li>
    <li>Origen del término <i>pipeline</i>: la analogía con cómo los <?php hueco(40, 14); ?> hacen <i>pipelining</i> de sus instrucciones para lograr cierto grado de <?php hueco(41, 14); ?>. Aquí se
        <?php hueco(42, 10); ?> que las etapas posteriores tendrán <?php hueco(43, 8); ?> y se retoma el trabajo en <?php hueco(44, 24); ?>; se está listo para pagar la <?php hueco(45, 16); ?> si la apuesta falla.</li>
    <li>Pasar la etapa de commit es un <?php hueco(46, 8); ?> que libera a los devs, pero arreglar builds rotos sigue siendo su <?php hueco(47, 16); ?> aun cuando el fallo ocurra en etapas tardías.</li>
  </ul>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Por qué las pruebas unitarias no bastan</h2>
  <ul>
    <li>Las pruebas unitarias están tan acopladas a la <?php hueco(48, 12); ?> que se cae en probar que la solución funciona <?php hueco(49, 24); ?> en lugar de afirmar que
        <?php hueco(50, 22); ?>.</li>
    <li>Caso: proyecto con unos <?php hueco(51, 4); ?> desarrolladores y CI disciplinado. El sistema llevaba <?php hueco(52, 12); ?> roto (bug oscuro que impedía arrancar) con una cobertura media de
        <?php hueco(53, 4); ?> %: los devs <?php hueco(54, 30); ?> en vez de ejecutar la aplicación.</li>
    <li>Se agregaron unas pocas pruebas automatizadas de <?php hueco(55, 8); ?> (smoke) al CI.</li>
    <li>Los unit tests solo prueban la <?php hueco(56, 30); ?>; tienen capacidad limitada para demostrar que la app hace lo que debe desde la <?php hueco(57, 30); ?>.</li>
    <li>Primera suposición fue que el despliegue estaba mal configurado, porque despliegues manuales eran comunes: cada intento era un <?php hueco(60, 16); ?> nuevo → un
        <?php hueco(59, 16); ?> con releases de <?php hueco(61, 16); ?>.</li>
    <li>Sin pruebas de aceptación en <?php hueco(58, 34); ?> no sabemos si la app cumple las <?php hueco(62, 30); ?> ni si puede desplegarse y sobrevivir en el mundo real.</li>
  </ul>
  <?php mc('m13'); ?>
  <?php mc('m14'); ?>
  <?php mc('m15'); ?>
  <?php mc('m16'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. La compuerta de las pruebas de aceptación automatizadas</h2>
  <ul>
    <li>Meta: afirmar que el sistema entrega el valor esperado y cumple los <?php hueco(63, 24); ?>. También sirve como suite de <?php hueco(64, 12); ?>.</li>
    <li>Las crean y mantienen <?php hueco(65, 34); ?> (devs, testers y <?php hueco(66, 10); ?>) junto con las unitarias.</li>
    <li>Ante una rotura, el equipo responde <?php hueco(67, 14); ?> y decide si es una <?php hueco(68, 10); ?> introducida, un <?php hueco(69, 24); ?> en el comportamiento o un
        <?php hueco(70, 30); ?>.</li>
    <li>Es el <?php hueco(71, 20); ?> del ciclo de vida de un release candidate. El pipeline hace más fácil <?php hueco(72, 20); ?> que lo incorrecto. Un candidato que no cumple sus criterios de aceptación
        <?php hueco(73, 8); ?> se libera.</li>
  </ul>
  <h3>Mejores prácticas</h3>
  <ul>
    <li>Ejecutar sobre una <?php hueco(74, 8); ?> del entorno de producción; si es complejo o caro, una versión <?php hueco(75, 10); ?> (p. ej. un par de servidores de middleware) y
        <?php hueco(76, 14); ?> para la infraestructura externa. Con muchos entornos destino, se corren pruebas en una <?php hueco(77, 14); ?> <?php hueco(78, 12); ?>.</li>
    <li>Mala idea: un <?php hueco(79, 18); ?>: los devs no se sienten <?php hueco(80, 18); ?>, ignoran fallos, y las pruebas quedan acopladas a la <?php hueco(81, 20); ?> y <?php hueco(82, 10); ?>.
        La realidad: <?php hueco(83, 20); ?> es dueño de las pruebas de aceptación.</li>
    <li>Los devs deben poder correrlas en sus <?php hueco(84, 26); ?>. Obstáculos comunes: <?php hueco(85, 24); ?> insuficientes y la <?php hueco(86, 34); ?> que impide desplegar en dev.</li>
    <li>Se expresan en el <?php hueco(87, 22); ?> (<i>ubiquitous language</i> de <?php hueco(88, 12); ?>): “<?php hueco(89, 14); ?>” y no “<?php hueco(90, 30); ?>”; “<?php hueco(91, 26); ?>” en vez de “check fund_table has results”.</li>
    <li>Son también pruebas de <?php hueco(92, 20); ?>; son <?php hueco(93, 10); ?> de mantener: no se debe <?php hueco(94, 16); ?> automatizar todos los criterios de aceptación. Si las pruebas
        <?php hueco(95, 30); ?>, abandonar la automatización es la decisión correcta.</li>
  </ul>
  <?php mc('m17'); ?>
  <?php mc('m18'); ?>
  <?php mc('m19'); ?>
  <?php mc('m20'); ?>
  <?php mc('m21'); ?>
  <?php mc('m22'); ?>
  <?php mc('m23'); ?>
  <?php mc('m24'); ?>
  <?php mc('m25'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('segundo.php', 'cuarto.php');
