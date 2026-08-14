<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 3 — bloque 04: Procesos, Tecnologia y Equipos
   Fuente: sesion_03_fundamentos_devops.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- el pipeline: 4 etapas --- */
    1  => ['desarrollo'],
    2  => ['build'],
    3  => ['paquetes'],
    4  => ['test'],
    5  => ['git'],
    6  => ['integracion'],
    7  => ['artefactos'],
    8  => ['performance'],
    9  => ['staging'],
    10 => ['tiempo real'],

    /* --- tecnicas continuas --- */
    11 => ['ci', 'integracion continua'],
    12 => ['cd', 'entrega continua'],
    13 => ['alm', 'change management'],
    14 => ['continuous testing', 'testing continuo'],
    15 => ['service virtualization', 'virtualizacion de servicios'],
    16 => ['stubs', 'stub'],
    17 => ['feedback loop', 'bucle de feedback'],
    18 => ['logs'],

    /* --- IaC vs SDE --- */
    19 => ['nodos'],
    20 => ['sde', 'software-defined environments'],
    21 => ['topologias'],
    22 => ['middleware'],
    23 => ['genericas'],
    24 => ['orquestacion'],
    25 => ['aprovisionamiento'],

    /* --- IMVU --- */
    26 => ['9'],
    27 => ['50'],
    28 => ['canary', 'canary deployments', 'canarios'],
    29 => ['rollback'],
    30 => ['prueba'],

    /* --- equipos --- */
    31 => ['dos pizzas', 'dos'],
    32 => ['amazon'],
    33 => ['microservicios'],
    34 => ['coordinacion'],

    /* --- roles --- */
    35 => ['service owner'],
    36 => ['gatekeeper'],
    37 => ['reliability engineer', 'sre', 'site reliability engineer'],
    38 => ['devops engineer'],
    39 => ['5 whys', 'cinco porques', '5 porques'],
    40 => ['toolchain'],

    /* --- coordinacion --- */
    41 => ['directa'],
    42 => ['persistente'],
    43 => ['sincrona'],
    44 => ['asincrona'],
    45 => ['arquitectura'],

    /* --- barreras --- */
    46 => ['estabilidad'],
    47 => ['regulados'],
    48 => ['politicos'],
    49 => ['50'],
    50 => ['antipatron'],
];

$TEXTO = range(1, 50);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En el pipeline de entrega, &iquest;que guarda el <b>repositorio de paquetes</b>?',
        'opciones' => [
            'a' => 'El codigo fuente y las ramas',
            'b' => 'Artefactos, binarios y scripts de IaC, de forma segura',
            'c' => 'Los datos de prueba',
            'd' => 'Las metricas de produccion'
        ],
        'correcta' => 'b',
        'porque'   => 'El codigo fuente vive en el control de versiones (etapa 1). El repositorio de paquetes guarda lo <b>construido</b>, que es lo que realmente se despliega.'
    ],
    'm2' => [
        'texto'    => '&iquest;Por que la sesion destaca que Staging y Produccion escalan a cientos o miles de nodos?',
        'opciones' => [
            'a' => 'Para justificar el costo de la nube',
            'b' => 'Porque a esa escala la automatizacion y el monitoreo <b>en tiempo real</b> dejan de ser un lujo y son esenciales para la estabilidad operativa',
            'c' => 'Porque hay que reducir el numero de nodos',
            'd' => 'Porque el testing manual escala igual de bien'
        ],
        'correcta' => 'b',
        'porque'   => 'Lo que en 3 servidores puedes hacer a mano, en 300 es imposible. La escala es lo que convierte la automatizacion en obligatoria.'
    ],
    'm3' => [
        'texto'    => '&iquest;Que resuelve la <b>service virtualization</b>?',
        'opciones' => [
            'a' => 'Correr los servicios en maquinas virtuales',
            'b' => 'Simular stubs o componentes externos <b>ausentes o costosos</b> para poder ejecutar tests funcionales continuos',
            'c' => 'Balancear la carga entre nodos',
            'd' => 'Desplegar en contenedores'
        ],
        'correcta' => 'b',
        'porque'   => 'Si tu suite depende de un servicio de terceros que cobra por llamada o que solo esta disponible en horario de oficina, tu testing continuo deja de ser continuo.'
    ],
    'm4' => [
        'texto'    => '&iquest;Cual es la diferencia entre <b>IaC</b> y <b>SDE</b>?',
        'opciones' => [
            'a' => 'Ninguna, son sinonimos',
            'b' => 'IaC define la configuracion de <b>nodos</b>; los Software-Defined Environments definen <b>topologias completas</b>, roles y politicas del sistema',
            'c' => 'IaC es para nube y SDE para servidores fisicos',
            'd' => 'SDE es una herramienta y IaC una practica'
        ],
        'correcta' => 'b',
        'porque'   => 'Es una diferencia de alcance: una maquina bien configurada vs. el sistema entero con sus relaciones. El SDE es el plano; el IaC, cada pieza.'
    ],
    'm5' => [
        'texto'    => 'Herramientas <b>middleware-centric</b> vs. <b>genericas</b>:',
        'opciones' => [
            'a' => 'Las middleware-centric automatizan servidores y despliegues sin tocar la configuracion del OS; las genericas son scripts de bajo nivel (red, cortafuegos, puertos)',
            'b' => 'Al reves',
            'c' => 'Las dos hacen lo mismo con distinto nombre',
            'd' => 'Las genericas solo funcionan en Linux'
        ],
        'correcta' => 'a',
        'porque'   => 'Cuanto mas alto el nivel, menos tienes que saber del sistema operativo — y menos control fino tienes cuando algo se rompe. Es el trade-off de siempre.'
    ],
    'm6' => [
        'texto'    => 'IMVU corre su suite de pruebas en <b>9 minutos</b> repartida en 30-40 maquinas. &iquest;Que habilita ese dato?',
        'opciones' => [
            'a' => 'Ahorrar en hardware',
            'b' => 'Que se pueda desplegar ~50 veces al dia: si las pruebas tardaran 3 horas, el despliegue continuo seria imposible por pura aritmetica',
            'c' => 'Que no hagan falta pruebas manuales',
            'd' => 'Que el rollback sea mas rapido'
        ],
        'correcta' => 'b',
        'porque'   => 'La velocidad del pipeline pone el techo a la frecuencia de despliegue. Por eso paralelizar las pruebas no es un detalle tecnico, es una decision de negocio.'
    ],
    'm7' => [
        'texto'    => '&iquest;Que es un <b>canary deployment</b>?',
        'opciones' => [
            'a' => 'Un despliegue nocturno',
            'b' => 'Desplegar primero en un <b>grupo pequeño</b> de servidores, y revertir automaticamente si se detecta una regresion estadistica',
            'c' => 'Un despliegue que avisa por correo',
            'd' => 'Un despliegue sin pruebas previas'
        ],
        'correcta' => 'b',
        'porque'   => 'El nombre viene del canario en la mina: si algo va mal, lo notas en el grupo pequeño antes de que afecte a todos. Y en IMVU, cada fallo revertido <b>genera una prueba nueva</b>.'
    ],
    'm8' => [
        'texto'    => 'La <b>regla de las dos pizzas</b> (Amazon) dice que...',
        'opciones' => [
            'a' => 'Hay que dar comida en las reuniones',
            'b' => 'El tamaño ideal de un equipo es el que se puede alimentar con dos pizzas: equipos pequeños deciden mas rapido y comparten objetivos claros',
            'c' => 'Cada equipo debe tener dos lideres',
            'd' => 'Las reuniones no deben durar mas de dos horas'
        ],
        'correcta' => 'b',
        'porque'   => 'Y tiene consecuencia arquitectonica: equipos pequeños conducen a <b>microservicios</b>, porque asi reducen la coordinacion necesaria entre ellos.'
    ],
    'm9' => [
        'texto'    => 'Segun la sesion, &iquest;cual es el <b>trade-off</b> de dividirse en equipos pequeños?',
        'opciones' => [
            'a' => 'No hay ninguno',
            'b' => 'Se acepta una duplicacion menor de esfuerzos y el costo de partir tareas complejas, a cambio de una <b>velocidad de mercado</b> significativamente superior',
            'c' => 'Se pierde calidad del codigo',
            'd' => 'Se necesita mas documentacion formal'
        ],
        'correcta' => 'b',
        'porque'   => 'Es honesto reconocerlo: los equipos pequeños <em>si</em> duplican trabajo. La apuesta es que la velocidad lo compensa con creces.'
    ],
    'm10' => [
        'texto'    => 'El rol que gestiona el post-despliegue (canarios) y busca la <b>causa raiz</b> con los 5 Whys es...',
        'opciones' => [
            'a' => 'Service Owner',
            'b' => 'Gatekeeper',
            'c' => 'Reliability Engineer (SRE)',
            'd' => 'DevOps Engineer'
        ],
        'correcta' => 'c',
        'porque'   => 'Reparto rapido: <b>Service Owner</b> = vision y prioridades. <b>Gatekeeper</b> = valida el paso por el pipeline. <b>SRE</b> = post-despliegue y causa raiz. <b>DevOps Engineer</b> = el toolchain.'
    ],
    'm11' => [
        'texto'    => 'Documentacion y codigo son coordinacion <b>persistente</b>; los stand-up meetings son...',
        'opciones' => [
            'a' => 'Persistente tambien',
            'b' => 'Efimera: se dice, se resuelve y desaparece',
            'c' => 'Asincrona',
            'd' => 'Indirecta'
        ],
        'correcta' => 'b',
        'porque'   => 'Los tres ejes son: directa/indirecta, persistente/efimera y sincrona/asincrona. Un stand-up es directo, efimero y sincrono — el combo mas caro de los tres.'
    ],
    'm12' => [
        'texto'    => '&iquest;Como puede la <b>arquitectura</b> reducir la necesidad de coordinacion?',
        'opciones' => [
            'a' => 'Obligando a mas reuniones de diseño',
            'b' => 'Definiendo al inicio de la iteracion las responsabilidades de los componentes, los modelos de coordinacion y datos, los limites de recursos y los mapeos: asi los equipos actuan con <b>autonomia total</b>',
            'c' => 'Centralizando todo en un monolito',
            'd' => 'Eliminando las interfaces entre modulos'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la idea mas fina del bloque: la arquitectura <b>es</b> un mecanismo de coordinacion. Lo que decides una vez en el diseño, no lo tienes que negociar cada dia en una reunion.'
    ],
    'm13' => [
        'texto'    => '&iquest;Por que los sectores regulados (finanzas, salud) son una barrera para la adopcion?',
        'opciones' => [
            'a' => 'Porque no usan software',
            'b' => 'Porque las regulaciones requieren <b>gatekeepers adicionales</b> para mitigar riesgos, lo que añade pasos de validacion al pipeline',
            'c' => 'Porque sus equipos son mas pequeños',
            'd' => 'Porque no pueden usar la nube'
        ],
        'correcta' => 'b',
        'porque'   => 'No es que DevOps sea imposible ahi: es que el pipeline tiene que incorporar esos controles en vez de saltarselos. La automatizacion ayuda, porque deja rastro auditable.'
    ],
    'm14' => [
        'texto'    => '&iquest;Cual es el <b>antipatron comun</b> con el que cierra la sesion?',
        'opciones' => [
            'a' => 'Automatizar demasiado pronto',
            'b' => 'Contratar a un solo &laquo;DevOps Engineer&raquo; y dar por terminada la transformacion',
            'c' => 'Usar demasiadas herramientas',
            'd' => 'Desplegar los viernes'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la conclusion de toda la sesion: DevOps no se compra ni se contrata, requiere transformacion cultural. Un puesto nuevo no cambia los incentivos de nadie.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 3 · 4 — Procesos, tecnología y equipos', 'sesion_03_fundamentos_devops.pdf — bloque 04');
?>

<div class="card">
  <h2>1. El pipeline de entrega</h2>

  <table class="datos">
    <tr><th>#</th><th>Etapa</th><th>Que contiene</th></tr>
    <tr><td>1</td><td>Entorno de <?php hueco(1, 14); ?></td>
        <td>IDEs, control de versiones (<?php hueco(5, 8); ?>), planeacion y unit testing local</td></tr>
    <tr><td>2</td><td>Servidor de <?php hueco(2, 10); ?></td>
        <td>compilacion y testing de <?php hueco(6, 14); ?> automatizado y continuo</td></tr>
    <tr><td>3</td><td>Repositorio de <?php hueco(3, 12); ?></td>
        <td>almacenamiento seguro de <?php hueco(7, 14); ?>, binarios y scripts de IaC</td></tr>
    <tr><td>4</td><td>Entorno de <?php hueco(4, 10); ?></td>
        <td>QA, testing de <?php hueco(8, 14); ?>, datos y stubs virtualizados</td></tr>
  </table>

  <div class="avisoflujo">
    <b>Etapa de produccion.</b> Los entornos de <?php hueco(9, 12); ?> y produccion
    escalan a cientos o miles de nodos, donde la automatizacion y las herramientas de
    monitoreo en <?php hueco(10, 14); ?> son esenciales para asegurar la
    estabilidad operativa.
  </div>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Tecnicas continuas</h2>

  <h3>Integracion, delivery y gestion del cambio</h3>
  <ul>
    <li><b><?php hueco(11, 10); ?> / <?php hueco(12, 10); ?>:</b> integracion
        frecuente para mitigar riesgos tempranamente, y automatizacion de despliegues en
        todos los entornos.</li>
    <li><b>Change Management (<?php hueco(13, 10); ?>):</b> gestion ligera y
        automatizada, vinculando tareas con artefactos y codigo.</li>
  </ul>

  <h3>Testing y monitoreo</h3>
  <ul>
    <li><b><?php hueco(14, 22); ?>:</b> provision de entornos, gestion de datos
        de prueba y pruebas de performance.</li>
    <li><b><?php hueco(15, 24); ?>:</b> simular <?php hueco(16, 10); ?>
        o componentes externos ausentes o costosos, para habilitar tests funcionales continuos.</li>
    <li><b><?php hueco(17, 18); ?>:</b> absorber feedback de app stores, redes
        sociales y <?php hueco(18, 8); ?> operativos.</li>
  </ul>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Infraestructura como Codigo (IaC)</h2>

  <ul>
    <li><b>IaC vs. SDE:</b> IaC define la configuracion de <?php hueco(19, 10); ?>;
        los <?php hueco(20, 10); ?> (Software-Defined Environments) definen
        <?php hueco(21, 14); ?> completas, roles y politicas del sistema.</li>
    <li><b>Herramientas <?php hueco(22, 14); ?>-centric:</b> automatizan servidores
        y despliegues sin tocar configuraciones del OS.</li>
    <li><b>Herramientas <?php hueco(23, 12); ?>:</b> scripts de bajo nivel
        (configuracion de red, cortafuegos, puertos).</li>
  </ul>

  <div class="avisoflujo">
    <b>Automatizacion estandarizada.</b> Las herramientas de
    <?php hueco(24, 16); ?> (como IBM UrbanCode Deploy with Patterns) permiten
    automatizar el <?php hueco(25, 18); ?> de entornos, acelerando y
    estandarizando la entrega.
  </div>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Caso de estudio: IMVU</h2>

  <ul>
    <li><b>Pruebas rapidas:</b> suite automatizada distribuida en 30-40 maquinas que se
        ejecuta en <?php hueco(26, 6); ?> minutos.</li>
    <li><b><?php hueco(28, 18); ?>:</b> el despliegue inicial se hace en un grupo
        pequeño de servidores.</li>
    <li><b>Muestreo y reversion:</b> <?php hueco(29, 12); ?> automatico si se
        detecta una regresion estadistica.</li>
    <li><b>Mejora continua:</b> cada fallo revertido genera una nueva
        <?php hueco(30, 10); ?> para blindar el pipeline.</li>
  </ul>

  <div class="avisoflujo">
    <b>Metrica de impacto.</b> IMVU realiza aproximadamente <?php hueco(27, 6); ?>
    despliegues diarios a produccion sin interrumpir el servicio, gracias a sus mecanismos de CD.
  </div>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Equipos y microservicios</h2>

  <ul>
    <li><b>Regla de las <?php hueco(31, 14); ?>:</b> el tamaño ideal de un equipo
        es el que puede alimentarse con dos pizzas (<?php hueco(32, 10); ?>).</li>
    <li><b>Cohesion y velocidad:</b> equipos pequeños deciden mas rapido y mantienen
        objetivos compartidos claros.</li>
    <li><b>Arquitectura alineada:</b> equipos pequeños conducen a arquitecturas de
        <?php hueco(33, 16); ?> para reducir la
        <?php hueco(34, 14); ?>.</li>
  </ul>

  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Roles clave</h2>

  <table class="datos">
    <tr><th>Rol</th><th>Que hace</th></tr>
    <tr><td><?php hueco(35, 16); ?></td>
        <td>mantiene la vision, prioriza tareas y maneja la coordinacion externa</td></tr>
    <tr><td><?php hueco(36, 14); ?></td>
        <td>valida el paso del pipeline (la ruta automatizada de Netflix, o el Release
            Coordinator de Mozilla)</td></tr>
    <tr><td><?php hueco(37, 22); ?></td>
        <td>gestiona el post-despliegue (canarios) y busca la causa raiz con los
            <?php hueco(39, 10); ?></td></tr>
    <tr><td><?php hueco(38, 18); ?></td>
        <td>administra el <?php hueco(40, 12); ?> y la calidad de la configuracion
            de infraestructura</td></tr>
  </table>

  <?php mc('m10'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Mecanismos de coordinacion</h2>
  <p>Tres ejes, cada uno con sus dos extremos:</p>

  <table class="datos">
    <tr><th>Eje</th><th>Un extremo</th><th>El otro</th></tr>
    <tr><td>1</td><td><?php hueco(41, 12); ?>: dialogo entre pares</td>
        <td>Indirecta: comunicacion general para roles</td></tr>
    <tr><td>2</td><td><?php hueco(42, 14); ?>: documentacion y codigo</td>
        <td>Efimera: stand-up meetings e info-radiators humanos</td></tr>
    <tr><td>3</td><td><?php hueco(43, 12); ?>: requiere agendas y reuniones</td>
        <td><?php hueco(44, 12); ?>: usa control de versiones y CI</td></tr>
  </table>

  <div class="nota"><b>El costo.</b> El exceso de comunicacion manual, directa, informal y
    sincrona frena la agilidad del equipo y retrasa la velocidad de entrega.</div>

  <h3>La arquitectura como mecanismo</h3>
  <p>La <?php hueco(45, 14); ?> define decisiones clave del sistema para reducir la
     necesidad de coordinarse de forma sincrona. Las cuatro decisiones de diseño son:</p>
  <ol>
    <li>Asignacion de responsabilidades de componentes.</li>
    <li>Modelos de coordinacion y de datos en runtime.</li>
    <li>Gestion y limites de recursos.</li>
    <li>Mapeos entre elementos y tiempos de binding.</li>
  </ol>

  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Barreras a la adopcion y conclusiones</h2>

  <table class="datos">
    <tr><th>Cultura y silos</th><th>Herramientas y costos</th></tr>
    <tr>
      <td>Resistencia en Ops: miedo a perder <?php hueco(46, 14); ?> e incentivos de no-cambio</td>
      <td>Curva tecnica: hace falta alta experiencia para configurar y operar el toolchain</td>
    </tr>
    <tr>
      <td>Regulaciones: los sectores <?php hueco(47, 12); ?> (finanzas, salud) requieren gatekeepers adicionales</td>
      <td>Costo de personal: Dev cuesta un <?php hueco(49, 6); ?> % mas que Ops, y la automatizacion debe justificar ese cambio</td>
    </tr>
    <tr>
      <td>Silos <?php hueco(48, 12); ?>: lealtad del personal al departamento local por encima de la organizacion</td>
      <td></td>
    </tr>
  </table>

  <h3>Conclusiones: DevOps como capacidad</h3>
  <ul>
    <li><b>Capacidad de negocio:</b> no se limita a comprar herramientas; requiere
        transformacion cultural profunda.</li>
    <li><b>Responsabilidad directa:</b> Dev asume soporte e infraestructura, eliminando
        esperas de coordinacion manual.</li>
    <li><b>Valor estrategico:</b> habilita la experimentacion rapida y segura de cara al
        cliente final.</li>
  </ul>

  <div class="avisoflujo">
    <b>El <?php hueco(50, 14); ?> comun.</b> Contratar a un solo &laquo;DevOps
    Engineer&raquo; y dar por terminada la transformacion es una barrera cultural comun y
    una receta para el fracaso.
  </div>

  <?php mc('m13'); ?>
  <?php mc('m14'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>


<div class="card">
  <h2>Las 5 preguntas de discusion de la sesion</h2>
  <p>No tienen respuesta unica: son para llevar pensadas a clase.</p>
  <ol>
    <li>&iquest;Han presenciado la &laquo;pared de la confusion&raquo; (culpas cruzadas
        Dev/Ops) en su experiencia de proyectos?</li>
    <li>&iquest;Cuales sistemas de sus proyectos academicos o laborales son <b>SoR</b> y
        cuales <b>SoE</b>?</li>
    <li>&iquest;Que practicas de DevOps (IaC, CD) creen que generen mayor resistencia
        cultural en una organizacion tradicional?</li>
    <li>Si aplicaran los <b>5 Whys</b> a una falla de entrega previa, &iquest;que fallo de
        proceso base identificarian?</li>
    <li>&iquest;Como influye el tamaño de sus equipos en la arquitectura de software
        elegida y en la necesidad de coordinacion sincrona?</li>
  </ol>
</div>

<?php
pie('tercero.php', '');
