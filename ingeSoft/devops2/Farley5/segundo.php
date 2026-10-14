<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Farley cap. 5 — bloque 02: Prácticas del deployment
   pipeline.
   Fuente: Continuous Delivery (Humble & Farley) — Chapter 5, "Deployment
   Pipeline Practices"
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- build binaries once --- */
    1  => ['una vez', 'una sola vez', 'solo una vez'],
    2  => ['jars', 'jar'],
    3  => ['ensamblados', 'assemblies', 'ensamblados .net', 'assemblies .net'],
    4  => ['.so', 'so'],
    5  => ['compilador', 'version del compilador'],
    6  => ['terceros', 'de terceros', 'third-party'],
    7  => ['configuracion del compilador', 'configuracion'],
    8  => ['nivel del codigo fuente', 'codigo fuente', 'nivel de codigo fuente'],
    9  => ['reconstruir desde el codigo fuente', 'clearcase', 'rebuilding-from-source'],
    10 => ['eficiente', 'eficientes'],
    11 => ['cimientos solidos', 'fundamentos solidos', 'bases solidas', 'cimientos conocidos como solidos'],
    12 => ['hashes', 'hash', 'huellas'],
    13 => ['auditoria', 'auditorias'],
    14 => ['maliciosamente o por error', 'por error', 'maliciosamente'],
    15 => ['entorno especial', 'entorno especial que solo', 'un entorno especial'],
    16 => ['personal senior', 'personal veterano'],
    17 => ['sistema de archivos', 'un sistema de archivos', 'filesystem'],
    18 => ['derivados', 'derivado'],
    19 => ['linea base', 'baseline'],
    20 => ['definicion', 'la definicion'],
    21 => ['no vale la pena', 'poco esfuerzo', 'no mucho'],
    22 => ['recrearlos', 'volver a crearlos', 'recrear', 'reconstruirlos', 'recrearse'],
    23 => ['trazar', 'trazabilidad', 'rastrear'],
    24 => ['ear', 'war', 'ear y war', 'ears y wars', 'war y ear', 'wars y ears'],
    25 => ['codigo', 'el codigo'],
    26 => ['configuracion', 'la configuracion'],
    27 => ['cada entorno', 'todos los entornos', 'todo entorno'],
    28 => ['que cambia', 'lo que cambia'],
    29 => ['cinco', '5'],
    30 => ['servidor', 'un nuevo servidor', 'agregar un servidor'],
    31 => ['ninguna', 'no'],

    /* --- deploy the same way --- */
    32 => ['mismo proceso', 'el mismo proceso', 'de la misma manera', 'misma forma', 'la misma forma', 'igual'],
    33 => ['desarrolladores', 'developers'],
    34 => ['inversa', 'inversamente', 'inverso', 'es inversa'],
    35 => ['riesgo', 'el riesgo'],
    36 => ['produccion'],
    37 => ['cientos', 'cientos de veces'],
    38 => ['ip', 'direccion ip', 'una ip unica', 'ip unica'],
    39 => ['propiedades', 'archivos de propiedades', 'properties'],
    40 => ['nombre del host', 'hostname', 'host'],
    41 => ['variable de entorno', 'variables de entorno'],
    42 => ['ldap', 'activedirectory', 'active directory'],
    43 => ['base de datos', 'bd'],
    44 => ['escape'],
    45 => ['una sola fuente', 'una unica fuente', 'una fuente', 'un solo lugar'],
    46 => ['en mi maquina funciona', 'it works on my machine', 'funciona en mi maquina', 'en mi maquina'],
    47 => ['manual', 'manualmente'],
    48 => ['lo mismo', 'igual', 'el mismo proceso'],
    49 => ['entorno destino', 'entorno objetivo', 'el entorno de destino', 'entorno'],
    50 => ['version', 'la version'],
    51 => ['documentado', 'documentado y auditado', 'auditado'],
    52 => ['tres', '3'],
    53 => ['archivo de configuracion especifico del entorno', 'configuracion especifica del entorno', 'archivo de configuracion'],
    54 => ['infraestructura', 'los servicios de los que depende', 'problema de infraestructura'],
    55 => ['configuracion del entorno', 'del entorno', 'entorno'],

    /* --- smoke test --- */
    56 => ['smoke test', 'prueba de humo', 'smoke tests'],
    57 => ['pantalla principal', 'main screen', 'la pantalla principal'],
    58 => ['base de datos', 'bus de mensajes', 'servicio externo', 'bus de mensajeria'],
    59 => ['pruebas unitarias', 'suite de pruebas unitarias', 'pruebas unitarias.'],
    60 => ['diagnostico', 'diagnosticos', 'diagnostico basico'],

    /* --- copia de produccion --- */
    61 => ['copia', 'copia de produccion', 'copia exacta'],
    62 => ['topologia de red', 'topologia'],
    63 => ['firewall', 'firewall.'],
    64 => ['sistema operativo', 'so'],
    65 => ['parches', 'parches.'],
    66 => ['stack de aplicacion', 'stack', 'pila de aplicacion'],
    67 => ['estado conocido y valido', 'estado valido', 'conocido y valido', 'estado conocido'],
    68 => ['datos', 'los datos', 'migracion de datos'],
    69 => ['imagenes de disco', 'disk imaging', 'imagenes de disco y virtualizacion', 'virtualizacion'],
    70 => ['puppet', 'installshield'],

    /* --- propagacion instantanea --- */
    71 => ['programacion', 'horario', 'un horario', 'schedule'],
    72 => ['cada check-in', 'cada commit', 'cada checkin'],
    73 => ['inmediatamente', 'de inmediato'],
    74 => ['exitosa', 'con exito', 'la finalizacion exitosa'],
    75 => ['la mas reciente', 'mas reciente', 'la ultima', 'ultima', 'mas reciente disponible'],
    76 => ['4', 'cuatro', 'version 4'],
    77 => ['3 o 4', '3 y 4', 'commit 3 o 4', '3 o el 4', 'el 3 o el 4'],
    78 => ['5', 'cinco', 'version 5'],
    79 => ['inteligente', 'la programacion inteligente', 'scheduling inteligente'],
    80 => ['a demanda', 'bajo demanda', 'demanda'],
    81 => ['completamente automatizadas', 'automatizadas', 'totalmente automatizadas'],

    /* --- stop the line --- */
    82 => ['detener la linea', 'stop the line', 'parar la linea', 'detener la cadena'],
    83 => ['todo el equipo', 'el equipo entero', 'el equipo completo', 'todo el equipo es responsable'],
    84 => ['arreglarlo', 'arreglar', 'corregirlo', 'corregir', 'solucionarlo'],
    85 => ['antes de hacer cualquier otra cosa', 'primero', 'antes de cualquier otra cosa'],
    86 => ['rapidas', 'rapidos', 'repetibles y confiables', 'rapidas, repetibles y confiables'],
    87 => ['repetibles', 'repetible'],
    88 => ['confiables', 'confiable', 'fiables'],
    89 => ['cada vez', 'cada vez que'],
    90 => ['exitosamente', 'con exito', 'satisfactoriamente'],
    91 => ['pasa', 'pase', 'pasan'],
];

$TEXTO = [];
for ($i = 1; $i <= 91; $i++) $TEXTO[] = $i;

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La primera práctica del pipeline es <b>“Only Build Your Binaries Once”</b>. ¿Por qué?',
        'opciones' => [
            'a' => 'Por ahorrar disco',
            'b' => 'Cada vez que recompilas en otro contexto (commit, aceptación, capacidad, cada destino) corres el riesgo de introducir <b>alguna diferencia</b>: otra versión del compilador, otra versión de una librería de terceros o distinta configuración del compilador',
            'c' => 'Porque el compilador es caro',
            'd' => 'Porque las pruebas fallan si compilas dos veces'
        ],
        'correcta' => 'b',
        'porque'   => 'El libro dice haber visto bugs de cada una de esas fuentes llegar a producción.'
    ],
    'm2' => [
        'texto'    => 'Un antipatrón relacionado es…',
        'opciones' => [
            'a' => 'Usar un servidor de artefactos',
            'b' => 'Promover a nivel de <b>binario</b>',
            'c' => 'Promover a nivel de <b>código fuente</b> en lugar de binario (el “ClearCase and the Rebuilding-from-Source Antipattern”)',
            'd' => 'Usar hashes'
        ],
        'correcta' => 'c',
        'porque'   => 'Viola dos principios: (1) mantener el pipeline eficiente para tener feedback lo antes posible (recompilar toma tiempo) y (2) construir siempre sobre cimientos que se sabe que son sólidos.'
    ],
    'm3' => [
        'texto'    => '“Construir sobre cimientos sólidos” implica que los binarios en producción…',
        'opciones' => [
            'a' => 'Sean <b>exactamente los mismos</b> que pasaron las pruebas de aceptación; muchos pipelines lo verifican guardando <b>hashes</b> de los binarios al crearlos y comprobando que sean idénticos en cada etapa posterior',
            'b' => 'Sean parecidos',
            'c' => 'Sean más nuevos',
            'd' => 'Sean recompilados'
        ],
        'correcta' => 'a',
        'porque'   => 'Es el origen de “Build once, deploy many” y de desplegar por digest (sesión de empaquetamiento).'
    ],
    'm4' => [
        'texto'    => 'Para <b>auditoría</b>, ¿qué es esencial?',
        'opciones' => [
            'a' => 'Que se pueda recompilar rápido',
            'b' => 'Asegurar que no se hayan introducido cambios, maliciosos o por error, entre crear los binarios y hacer el release; algunas organizaciones incluso compilan y empaquetan en un <b>entorno especial</b> al que solo accede personal senior',
            'c' => 'Que todos tengan acceso',
            'd' => 'Que no se guarden binarios'
        ],
        'correcta' => 'b',
        'porque'   => 'Una vez creados, los binarios se reutilizan sin recrearlos en el punto de uso.'
    ],
    'm5' => [
        'texto'    => '¿Dónde deben guardarse los binarios y por qué <b>no</b> en control de versiones?',
        'opciones' => [
            'a' => 'En Git, porque son código',
            'b' => 'En el correo',
            'c' => 'En un sistema de archivos / repositorio de artefactos accesible; no en control de versiones porque son <b>derivados</b> de la línea base, no parte de su definición',
            'd' => 'En papel'
        ],
        'correcta' => 'c',
        'porque'   => 'No vale la pena esforzarse en respaldarlos: se pueden recrear exactamente ejecutando el build automatizado desde la revisión correcta. Los CI servers guardan artefactos y permiten trazarlos al check-in que los creó.'
    ],
    'm6' => [
        'texto'    => 'Un corolario de “build once” es que…',
        'opciones' => [
            'a' => 'Cada entorno tiene su binario',
            'b' => 'Debe ser posible desplegar esos binarios en <b>cada entorno</b>, lo que obliga a separar el <b>código</b> (igual entre entornos) de la <b>configuración</b> (distinta)',
            'c' => 'Hay que usar un solo servidor',
            'd' => 'Hay que compilar en producción'
        ],
        'correcta' => 'b',
        'porque'   => 'Esto empuja hacia mejores sistemas de build y mejor gestión de configuración. Ojo con plantillas que generan un único paso ear/war con código y configuración juntos.'
    ],
    'm7' => [
        'texto'    => '¿Por qué es mala práctica crear binarios <b>específicos de un entorno</b>?',
        'opciones' => [
            'a' => 'Ocupan más',
            'b' => 'No es una mala práctica',
            'c' => 'Los sistemas de build se vuelven muy complejos, llenos de hacks especiales (en un proyecto hacía falta un equipo de <b>cinco personas</b> a tiempo completo para mantener el build) y tareas triviales, como agregar un servidor a un clúster, se vuelven frágiles y caras',
            'd' => 'Porque son ilegales'
        ],
        'correcta' => 'c',
        'porque'   => 'Se resolvió separando la configuración específica del entorno de los binarios agnósticos.'
    ],
    'm8' => [
        'texto'    => 'La segunda práctica: <b>“Deploy the Same Way to Every Environment”</b>. ¿Qué razón principal se da?',
        'opciones' => [
            'a' => 'Que los devs se aburran menos',
            'b' => 'Que se ahorre tiempo',
            'c' => 'Que la frecuencia de despliegue es <b>inversa al riesgo</b>: se despliega mucho en dev, poco en producción (que es el más importante), y solo tras probar el proceso cientos de veces en muchos entornos se elimina el script como fuente de error',
            'd' => 'Que sea barato'
        ],
        'correcta' => 'c',
        'porque'   => 'Devs despliegan todo el tiempo; testers y analistas menos; a producción, poco.'
    ],
    'm9' => [
        'texto'    => '¿Significa eso usar un script <b>distinto</b> por entorno?',
        'opciones' => [
            'a' => 'Sí',
            'b' => 'No: se usa el mismo script y se mantienen aparte los <b>ajustes únicos</b> de cada entorno (IP, configuración de SO y middleware, ubicación de BDs y servicios externos, etc.)',
            'c' => 'Solo en producción',
            'd' => 'Solo en dev'
        ],
        'correcta' => 'b',
        'porque'   => 'Todo entorno es distinto en algo: como mínimo, su IP.'
    ],
    'm10' => [
        'texto'    => 'Formas de suministrar la <b>configuración de tiempo de despliegue</b> que menciona el libro:',
        'opciones' => [
            'a' => 'Archivos de propiedades por entorno versionados (elegido por hostname o variable de entorno), un servicio de directorio (LDAP/ActiveDirectory) o una base de datos accesible mediante una aplicación como ESCAPE',
            'b' => 'Correo',
            'c' => 'Hardcodeado',
            'd' => 'Pegado en la pared'
        ],
        'correcta' => 'a',
        'porque'   => 'Debe usarse el mismo mecanismo para todas las aplicaciones y existir <b>una sola fuente</b> donde consultar la configuración de todas las aplicaciones en todos los entornos.'
    ],
    'm11' => [
        'texto'    => '¿Por qué debe haber una única fuente de configuración para todas las aplicaciones y entornos?',
        'opciones' => [
            'a' => 'Por una cuestión de moda',
            'b' => 'Sin ella hay que escribir a equipos en distintos continentes para reconstruir qué configuración recibió una app en un entorno: una barrera enorme de eficiencia al buscar la causa raíz de un bug, que suma retrasos al value stream',
            'c' => 'Para ahorrar disco',
            'd' => 'Porque lo pide el auditor'
        ],
        'correcta' => 'b',
        'porque'   => 'La fuente puede ser un repositorio de control de versiones, un servicio de directorio o una base de datos.'
    ],
    'm12' => [
        'texto'    => 'Usar el mismo script para producción que para desarrollo es una gran forma de…',
        'opciones' => [
            'a' => 'Prevenir el síndrome del <b>“funciona en mi máquina”</b>; además, al llegar al release el despliegue ya se probó cientos de veces',
            'b' => 'Subir costos',
            'c' => 'Reducir pruebas',
            'd' => 'Evitar auditorías'
        ],
        'correcta' => 'a',
        'porque'   => 'Es uno de los mejores modos de mitigar el riesgo de liberar software.'
    ],
    'm13' => [
        'texto'    => 'Si hoy el despliegue es <b>manual</b>, ¿cómo se recomienda empezar?',
        'opciones' => [
            'a' => 'Esperar a tener presupuesto',
            'b' => 'Asegurar que el proceso sea <b>el mismo en cada entorno</b> y luego automatizarlo poco a poco hasta tenerlo totalmente scripteado: al final solo se especifica el entorno destino y la versión de la aplicación',
            'c' => 'Cambiar de proveedor',
            'd' => 'Mantener el manual'
        ],
        'correcta' => 'b',
        'porque'   => 'Un despliegue automatizado y estandarizado deja el proceso completamente documentado y auditado.'
    ],
    'm14' => [
        'texto'    => 'Si se usa el mismo proceso y un despliegue falla en un entorno, el problema se reduce a una de <b>tres</b> causas:',
        'opciones' => [
            'a' => 'El script, el compilador y el IDE',
            'b' => 'Un ajuste en el archivo de configuración específico del entorno de la aplicación; un problema de infraestructura o de un servicio del que depende; o la configuración del entorno',
            'c' => 'El código, el diseño y las pruebas',
            'd' => 'El desarrollador, el tester y el jefe'
        ],
        'correcta' => 'b',
        'porque'   => 'Esas tres se aíslan con las dos prácticas siguientes: smoke tests y desplegar en una copia de producción.'
    ],
    'm15' => [
        'texto'    => 'Práctica 3: <b>Smoke-test your deployments</b>. ¿Qué es y qué verifica?',
        'opciones' => [
            'a' => 'Una prueba unitaria más',
            'b' => 'Un script automatizado que comprueba que la aplicación <b>está arriba y funcionando</b> (p. ej. abrir la pantalla principal con el contenido esperado) y también que sus servicios dependientes (BD, bus de mensajes, servicios externos) funcionan; da diagnósticos básicos',
            'c' => 'Una prueba de carga',
            'd' => 'Una revisión de código'
        ],
        'correcta' => 'b',
        'porque'   => 'Es probablemente la prueba más importante de escribir después de tener una suite de unitarias; incluso más importante, ya que da confianza de que la app realmente corre.'
    ],
    'm16' => [
        'texto'    => 'Práctica 4: <b>Deploy into a copy of production</b>. ¿Qué debe ser igual?',
        'opciones' => [
            'a' => 'Solo el código',
            'b' => 'La infraestructura (topología de red, firewall), la configuración del SO incluyendo parches, el stack de aplicación y los <b>datos en un estado conocido y válido</b> (la migración de datos en upgrades es una fuente mayor de dolor)',
            'c' => 'Solo la BD',
            'd' => 'Solo la red'
        ],
        'correcta' => 'b',
        'porque'   => 'Herramientas: imágenes de disco, virtualización, Puppet, InstallShield con un repositorio de control de versiones (cap. 11 y 12).'
    ],
    'm17' => [
        'texto'    => 'Práctica 5: <b>Each change should propagate through the pipeline instantly</b>. ¿Qué se evita?',
        'opciones' => [
            'a' => 'Ejecutar etapas con horarios fijos (builds cada hora, aceptación por la noche, capacidad el fin de semana): la primera etapa se dispara con <b>cada check-in</b> y cada etapa dispara la siguiente inmediatamente tras terminar con éxito',
            'b' => 'Usar CI',
            'c' => 'Hacer commits',
            'd' => 'Hacer pruebas'
        ],
        'correcta' => 'a',
        'porque'   => 'Solo aplica a etapas totalmente automatizadas; las de despliegue a entornos manuales se activan <b>a demanda</b>.'
    ],
    'm18' => [
        'texto'    => 'Caso de la fig. 5.6: v1 pasa commit y arranca aceptación; llegan v2, v3 y v4 mientras la aceptación corre. ¿Qué hace el CI?',
        'opciones' => [
            'a' => 'Construye cada versión en orden (v2, v3, v4), por separado',
            'b' => 'Ignora todos los commits',
            'c' => 'Cuando termina una instancia, mira si hay cambios nuevos y construye desde la <b>más reciente</b> (aquí v4); si se rompe, los devs deducen si fue el 3 o el 4 (algunos CI permiten correr versiones fuera de orden); tras arreglar con v5, la aceptación siguiente corre sobre v5',
            'd' => 'Cancela la aceptación'
        ],
        'correcta' => 'c',
        'porque'   => 'Si construyera todos, se iría quedando cada vez más atrás de lo que hacen los devs. A esto se le llama scheduling inteligente y es crucial.'
    ],
    'm19' => [
        'texto'    => 'Práctica 6: <b>If any part of the pipeline fails, stop the line</b> significa…',
        'opciones' => [
            'a' => 'Ignorar los fallos de etapas tardías',
            'b' => 'Que solo el que rompió lo arregle',
            'c' => 'Que el equipo espera al viernes',
            'd' => 'Que cada vez que se hace check-in se acepta que construirá y pasará todas las pruebas; si un despliegue a un entorno falla, <b>todo el equipo es dueño del fallo</b> y debe pararse a arreglarlo antes de hacer otra cosa'
        ],
        'correcta' => 'd',
        'porque'   => 'El paso más importante para lograr releases rápidos, repetibles y confiables.'
    ],
    'm20' => [
        'texto'    => '¿Cuál de estas afirmaciones sobre las prácticas es <b>falsa</b>?',
        'opciones' => [
            'a' => 'Debe compilarse solo una vez en la etapa de commit',
            'b' => 'Se despliega de la misma forma a todos los entornos',
            'c' => 'Cada entorno debe tener su propio binario específico',
            'd' => 'Se hace smoke test de cada despliegue'
        ],
        'correcta' => 'c',
        'porque'   => 'Los binarios NO deben ser específicos de un entorno; solo la configuración cambia.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Farley cap. 5 · 2 — Prácticas del deployment pipeline', 'Continuous Delivery, cap. 5: build once, mismo despliegue, smoke tests, copia de producción, propagación instantánea, stop the line');
?>

<div class="card">
  <h2>1. Only build your binaries once</h2>
  <ul>
    <li>Los “binarios” son colecciones de código ejecutable: <?php hueco(2, 6); ?>, <?php hueco(3, 14); ?> .NET, ficheros <code><?php hueco(4, 4); ?></code>.</li>
    <li>Se debe construir <b><?php hueco(1, 12); ?></b>, en la etapa de commit. Recompilar en otros contextos arriesga diferencias: otra versión del
        <?php hueco(5, 12); ?>, otra versión de una librería <?php hueco(6, 10); ?>, o distinta <?php hueco(7, 20); ?> del compilador.</li>
    <li>Antipatrón relacionado: promover a nivel de <?php hueco(8, 20); ?> en vez de a nivel de binario (“ClearCase and the <?php hueco(9, 30); ?> Antipattern”).</li>
    <li>Viola dos principios: mantener el pipeline <?php hueco(10, 10); ?> (feedback rápido) y construir siempre sobre <?php hueco(11, 20); ?>.</li>
    <li>Los binarios en producción deben ser exactamente los que pasaron aceptación; muchos pipelines lo comprueban guardando <?php hueco(12, 8); ?> al crearlos y verificando que sean idénticos en cada etapa posterior.</li>
    <li>Para <?php hueco(13, 12); ?> es esencial que no se hayan introducido cambios <?php hueco(14, 26); ?>. Algunas organizaciones compilan en un <?php hueco(15, 18); ?> al que solo accede
        <?php hueco(16, 16); ?>.</li>
    <li>Los binarios se guardan en un <?php hueco(17, 16); ?>, no en control de versiones, porque son <?php hueco(18, 10); ?> de tu <?php hueco(19, 10); ?>, no parte de su
        <?php hueco(20, 12); ?>. No <?php hueco(21, 14); ?> respaldarlos: se pueden <?php hueco(22, 12); ?> ejecutando el build desde la revisión correcta. El CI permite <?php hueco(23, 8); ?> cada binario al check-in.</li>
    <li>Ojo con las plantillas de proyecto que generan un solo paso <?php hueco(24, 12); ?> con código y configuración juntos.</li>
    <li>Corolario: se puede desplegar el mismo binario en cada entorno, así que se separa el <?php hueco(25, 8); ?> (igual) de la <?php hueco(26, 14); ?> (distinta): la regla de separar
        <?php hueco(28, 12); ?> de lo que no.</li>
    <li>Binarios específicos de <?php hueco(27, 14); ?> generan builds tan complejos que en un proyecto hacía falta un equipo de <?php hueco(29, 6); ?> personas, y hacen frágil hasta tareas triviales como agregar un
        <?php hueco(30, 12); ?> a un clúster. ¿Cuántos entornos deberían tener binarios específicos? <?php hueco(31, 8); ?>.</li>
  </ul>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. Deploy the same way to every environment</h2>
  <ul>
    <li>Se usa el <?php hueco(32, 16); ?> para desplegar en la estación de un dev, en pruebas o en producción, para que el proceso de build y despliegue se pruebe con eficacia.</li>
    <li>Los <?php hueco(33, 16); ?> despliegan todo el tiempo y producción poco: la frecuencia es <?php hueco(34, 10); ?> al <?php hueco(35, 8); ?> asociado a cada entorno.
        El entorno donde menos se despliega (<?php hueco(36, 12); ?>) es el más importante; solo tras probar el proceso <?php hueco(37, 8); ?> de veces se elimina el script como fuente de error.</li>
    <li>Todo entorno se diferencia al menos en su <?php hueco(38, 14); ?> única, entre otras cosas. Por eso se mantienen aparte los ajustes únicos: archivos de <?php hueco(39, 14); ?> por
        entorno versionados, elegidos por el <?php hueco(40, 14); ?> del servidor o por una <?php hueco(41, 20); ?>; o un directorio de servicios (<?php hueco(42, 8); ?>/ActiveDirectory) o una
        <?php hueco(43, 14); ?> a la que se accede con una aplicación como <?php hueco(44, 8); ?>.</li>
    <li>Idealmente hay <?php hueco(45, 20); ?> (repositorio, directorio o BD) para consultar la configuración de todas las apps en todos los entornos.</li>
    <li>Es una gran forma de prevenir el síndrome “<?php hueco(46, 30); ?>”.</li>
    <li>Si el despliegue hoy es <?php hueco(47, 10); ?>, se empieza asegurando que sea <?php hueco(48, 12); ?> en cada entorno y se automatiza por partes; al final solo se especifica el
        <?php hueco(49, 16); ?> y la <?php hueco(50, 10); ?> de la aplicación. El proceso queda <?php hueco(51, 22); ?>.</li>
    <li>Si un despliegue falla, hay <?php hueco(52, 6); ?> causas posibles: un ajuste del <?php hueco(53, 40); ?>, un problema de <?php hueco(54, 20); ?> o de un servicio del que depende, o la
        <?php hueco(55, 24); ?>.</li>
  </ul>
  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php mc('m14'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Smoke test y despliegue en una copia de producción</h2>
  <ul>
    <li>Cada despliegue va acompañado de un script automatizado de <?php hueco(56, 12); ?> que comprueba que la app está arriba: p. ej. abre la
        <?php hueco(57, 20); ?> con el contenido esperado; también verifica los servicios de los que depende (<?php hueco(58, 20); ?>…).</li>
    <li>Es probablemente la prueba más importante después de tener la suite de <?php hueco(59, 18); ?>; si falla, debe dar <?php hueco(60, 14); ?> básico de si algo de lo que depende no funciona.</li>
    <li>Idealmente se prueba en una <?php hueco(61, 8); ?> de producción: misma <?php hueco(62, 16); ?> (y <?php hueco(63, 8); ?>), mismo <?php hueco(64, 18); ?> con sus <?php hueco(65, 8); ?>, mismo
        <?php hueco(66, 20); ?> y los <?php hueco(68, 6); ?> en un <?php hueco(67, 26); ?>.</li>
    <li>Herramientas para gestionar la configuración de entornos: <?php hueco(69, 30); ?>, y <?php hueco(70, 8); ?> o InstallShield junto a un repositorio de control de versiones.</li>
  </ul>
  <?php mc('m15'); ?>
  <?php mc('m16'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Propagación instantánea y “stop the line”</h2>
  <ul>
    <li>Antes de CI, las partes del proceso corrían con <?php hueco(71, 14); ?> (build cada hora, aceptación nocturna, capacidad el fin de semana). El pipeline dispara la primera etapa con
        <?php hueco(72, 14); ?> y cada etapa dispara la siguiente <?php hueco(73, 14); ?> tras la finalización <?php hueco(74, 8); ?> de la anterior.</li>
    <li>Cuando una instancia termina, el CI mira si hay cambios nuevos y construye desde la revisión <?php hueco(75, 16); ?>: en el ejemplo, la versión <?php hueco(76, 3); ?>. Si se rompe no sabe si fue el commit
        <?php hueco(77, 8); ?>; el fix llega con la versión <?php hueco(78, 3); ?>. Esa <?php hueco(79, 22); ?> del CI es crucial.</li>
    <li>Solo aplica a etapas <?php hueco(81, 22); ?> (con pruebas); las que despliegan a entornos manuales se activan <?php hueco(80, 10); ?>.</li>
    <li>Regla: <?php hueco(82, 20); ?> (“stop the line”): cada vez que se hace check-in se acepta que va a construir y <?php hueco(91, 6); ?> todas las pruebas. Si un despliegue falla, el
        <?php hueco(83, 20); ?> es dueño del fallo y debe <?php hueco(84, 12); ?> <?php hueco(85, 28); ?>.</li>
    <li>Objetivo de todo el libro: releases <?php hueco(86, 8); ?>, <?php hueco(87, 10); ?> y <?php hueco(88, 10); ?>, que se logra si <?php hueco(89, 10); ?> que se hace commit se
        construye <?php hueco(90, 14); ?> y pasa todas las pruebas.</li>
  </ul>
  <?php mc('m17'); ?>
  <?php mc('m18'); ?>
  <?php mc('m19'); ?>
  <?php mc('m20'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
