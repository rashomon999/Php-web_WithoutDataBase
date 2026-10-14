<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Farley cap. 6 — bloque 03: Layout JVM, gestión de
   librerías, scripting de despliegue, capas, tips y resumen.
   Fuente: Continuous Delivery (Humble & Farley) — Chapter 6 (segunda mitad)
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- layout --- */
    1  => ['maven standard directory layout', 'standard directory layout'],
    2  => ['convencion', 'convencion de layout', 'estandar'],
    3  => ['net', '.net'],
    4  => ['lib'],
    5  => ['paquete', 'package', 'nombre del paquete'],
    6  => ['una clase por archivo', 'una clase', 'una'],
    7  => ['checkstyle', 'findbugs'],
    8  => ['pascalcase', 'pascal case'],
    9  => ['camelcase', 'camel case'],
    10 => ['target'],
    11 => ['src'],
    12 => ['limpiar', 'borrar', 'clean', 'eliminar'],
    13 => ['control de versiones', 'version control', 'git'],

    /* --- tests --- */
    14 => ['test/[language]', 'test/language', 'test'],
    15 => ['espejo', 'mirror', 'espejo de la jerarquia de paquetes'],
    16 => ['mismo paquete', 'el mismo paquete'],
    17 => ['acceptance', 'aceptacion'],
    18 => ['integration', 'integracion'],
    19 => ['nombre de paquete', 'filtrado por nombre de paquete', 'filtrado'],
    20 => ['reports', 'reportes', 'informes'],

    /* --- salida --- */
    21 => ['ignorar', 'ignorado', 'ignorarse'],
    22 => ['jars', 'jar'],
    23 => ['wars'],
    24 => ['ears'],
    25 => ['almacenar', 'artifact repository', 'repositorio de artefactos'],
    26 => ['uno', 'un jar', '1'],
    27 => ['eficiente', 'mas eficiente'],
    28 => ['grafo de dependencias', 'dependencias', 'complejidad del grafo de dependencias'],
    29 => ['ensamblar', 'ensamblaje', 'assemble'],
    30 => ['flexibilidad', 'cambiar de opinion'],

    /* --- librerias --- */
    31 => ['delegar', 'maven', 'ivy', 'maven o ivy'],
    32 => ['lib'],
    33 => ['build', 'compilacion'],
    34 => ['test', 'pruebas'],
    35 => ['run', 'runtime', 'ejecucion'],
    36 => ['proyecto propio', 'otro proyecto', 'proyecto aparte', 'un proyecto propio'],
    37 => ['repositorio propio', 'repositorio interno', 'repositorio organizacional', 'repositorio dentro de la organizacion'],
    38 => ['compliance', 'cumplimiento'],
    39 => ['bendecidas', 'aprobadas', 'blessed'],
    40 => ['produccion'],

    /* --- scripting de despliegue --- */
    41 => ['automatizado', 'automatico', 'proceso automatizado'],
    42 => ['remotamente', 'por acceso remoto', 'conectarse remotamente'],
    43 => ['script local', 'un script local', 'en la misma maquina', 'local'],
    44 => ['orquestacion'],
    45 => ['tres', '3'],
    46 => ['iniciar sesion', 'loguearse', 'login', 'hace login', 'hace ssh', 'ssh'],
    47 => ['agentes', 'agente'],
    48 => ['empaquetar', 'paquete', 'empaquetar la aplicacion'],
    49 => ['la tercera', 'tercera', 'tercero', '3'],
    50 => ['declarativas', 'declarativo'],
    51 => ['idempotentes', 'idempotente'],
    52 => ['caidas', 'apagadas', 'caida', 'down'],
    53 => ['controltier', 'bmc bladelogic', 'puppet', 'cfengine', 'marionette collective'],
    54 => ['operaciones'],
    55 => ['agente', 'agentes', 'modelo de agentes'],
    56 => ['dashboard', 'panel', 'tablero'],
    57 => ['scp', 'rsync'],
    58 => ['ssh'],
    59 => ['psexec', 'powershell'],
    60 => ['fabric', 'func', 'capistrano'],
    61 => ['parcialmente', 'incompletos', 'parcialmente completados', 'despliegues parciales'],
    62 => ['nuevo nodo', 'nodo nuevo', 'nuevo', 'nodo'],

    /* --- capas --- */
    63 => ['fundamentos', 'bases', 'cimientos'],
    64 => ['sistema operativo', 'so', 'operating system'],
    65 => ['middleware'],
    66 => ['configuracion', 'configuracion especifica'],
    67 => ['binarios', 'software', 'nuestro software'],
    68 => ['smoke tests', 'smoke test', 'pruebas de humo'],
    69 => ['presencia o ausencia', 'presencia', 'presencia/ausencia'],
    70 => ['config.xml', 'config xml'],
    71 => ['ruby'],
    72 => ['ping', 'pings'],

    /* --- tips --- */
    73 => ['relativas', 'relativos', 'rutas relativas'],
    74 => ['dos', '2'],
    75 => ['propiedades', 'archivo de propiedades', 'properties'],
    76 => ['fhs', 'filesystem hierarchy standard'],
    77 => ['raices', 'raiz', 'roots'],
    78 => ['2', 'dos', 'opcion 2', 'la 2'],
    79 => ['3', 'tres', 'opcion 3', 'la 3'],
    80 => ['manuales', 'pasos manuales'],
    81 => ['segunda vez', 'la segunda vez', 'segunda'],
    82 => ['tercera vez', 'la tercera vez', 'tercera'],
    83 => ['trazabilidad'],
    84 => ['manifiesto', 'manifest', 'manifest del jar'],
    85 => ['md5', 'hash md5'],
    86 => ['no', 'no hacer commit', 'no hacerlo'],
    87 => ['sistema de archivos compartido', 'filesystem compartido', 'sistema de ficheros compartido', 'sistema de archivos'],
    88 => ['metadatos', 'metadatos asociados'],
    89 => ['fallar el build', 'fallar', 'falle el build'],
    90 => ['flag', 'bandera', 'marca'],
    91 => ['failure-property', 'failureproperty'],
    92 => ['3 a.m.', '3 am', '3 de la manana', '3am'],
    93 => ['1 de enero', 'primero de enero'],
    94 => ['obj', 'bin y obj'],
    95 => ['devenv', 'devenv clean', 'clean solution'],
    96 => ['show hidden files', 'archivos ocultos'],

    /* --- resumen --- */
    97 => ['scripts', 'automatizacion'],
    98 => ['primera clase', 'first-class', 'primera clase.'],
    99 => ['toda su vida', 'toda la vida', 'toda la vida del sistema'],
    100=> ['unico mecanismo', 'el unico mecanismo', 'unico'],
    101=> ['becario', 'practicante', 'intern'],
];

$TEXTO = [];
for ($i = 1; $i <= 101; $i++) $TEXTO[] = $i;

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Por qué el libro dedica una sección al layout de proyectos JVM?',
        'opciones' => [
            'a' => 'Porque Java es el único lenguaje válido',
            'b' => 'Porque existen convenciones útiles pero <b>no se imponen</b> fuera del mundo Maven; seguir el layout estándar facilita la vida y es abstraíble a otras tecnologías (.NET usa el mismo con barras invertidas)',
            'c' => 'Porque Maven es obligatorio',
            'd' => 'Porque el layout no importa'
        ],
        'correcta' => 'b',
        'porque'   => 'Una de las contribuciones más importantes de Maven es la convención de layout, aunque no te guste Maven.'
    ],
    'm2' => [
        'texto'    => 'Convenciones de <b>código fuente Java</b> que menciona el libro:',
        'opciones' => [
            'a' => 'Archivos en directorios con el nombre del <b>paquete</b>, una clase por archivo; paquetes en PascalCase y clases en camelCase (según el libro), verificados con CheckStyle o FindBugs en el análisis del commit stage',
            'b' => 'Todo en un solo directorio',
            'c' => 'Varias clases por archivo',
            'd' => 'Nombres en mayúsculas'
        ],
        'correcta' => 'a',
        'porque'   => 'Violar estas convenciones genera bugs difíciles de encontrar, dificulta el mantenimiento y el compilador avisa con warnings.'
    ],
    'm3' => [
        'texto'    => '¿Dónde deben ir la configuración o metadatos <b>generados</b> (p. ej. por anotaciones o XDoclet)?',
        'opciones' => [
            'a' => 'En el directorio <code>src</code>',
            'b' => 'En el directorio <code>target</code>, para poder borrarlos con un clean y evitar que se suban a control de versiones por error',
            'c' => 'En <code>lib</code>',
            'd' => 'En la raíz del repositorio'
        ],
        'correcta' => 'b',
        'porque'   => 'Lo generado es derivado, no fuente.'
    ],
    'm4' => [
        'texto'    => 'Sobre la organización de los <b>tests</b>:',
        'opciones' => [
            'a' => 'Van mezclados con el código fuente',
            'b' => 'Van en el directorio de tests: las pruebas unitarias en un <b>espejo de la jerarquía de paquetes</b> (mismo paquete que la clase que prueban); otras pruebas (aceptación, componentes, integración) en paquetes separados o directorios aparte y se ejecutan por separado filtrando por nombre de paquete',
            'c' => 'Van en un servidor aparte',
            'd' => 'No se organizan'
        ],
        'correcta' => 'b',
        'porque'   => 'Ejemplos: com.mycompany.myproject.acceptance.ui / .acceptance.api / .integration. Usar directorios separados es cuestión de preferencia.'
    ],
    'm5' => [
        'texto'    => '¿Qué se hace con el directorio <code>target</code>?',
        'opciones' => [
            'a' => 'Se hace commit de todo su contenido',
            'b' => 'Se versiona solo el JAR',
            'c' => 'Se <b>ignora</b> en control de versiones; contiene todo lo generado (código, metadatos, JARs, WARs, EARs, reportes) y limpiar es tan simple como borrarlo',
            'd' => 'Se envía por correo'
        ],
        'correcta' => 'c',
        'porque'   => 'Si se decide versionar algún artefacto binario, se copia a otro directorio del repositorio. Sin Maven, se usa un directorio <code>reports</code> bajo target para reportes de test.'
    ],
    'm6' => [
        'texto'    => '¿Por qué crear <b>varios JARs</b> en lugar de uno?',
        'opciones' => [
            'a' => 'Porque Maven lo exige',
            'b' => 'Por estética',
            'c' => 'Para simplificar el despliegue y hacer más eficiente el build minimizando la <b>complejidad del grafo de dependencias</b>',
            'd' => 'Para engañar al compilador'
        ],
        'correcta' => 'c',
        'porque'   => 'Al principio, cada proyecto crea un JAR. Un paso separado de ensamblaje permite cambiar de opinión sobre el empaquetado. Alternativa: un proyecto separado por componente.'
    ],
    'm7' => [
        'texto'    => 'Opciones para <b>gestionar librerías</b>:',
        'opciones' => [
            'a' => 'Solo copiarlas a mano',
            'b' => 'Delegar en Maven/Ivy (declarar dependencias, sin versionar librerías); o versionar todas las librerías en <code>lib</code> (separadas por build, test y run); o tener un repositorio interno de la organización (útil para compliance: librerías “bendecidas”)',
            'c' => 'Descargarlas de Internet en producción',
            'd' => 'Ninguna'
        ],
        'correcta' => 'b',
        'porque'   => 'Dependencias de build (p. ej. Ant) pueden vivir en un proyecto propio en control de versiones.'
    ],
    'm8' => [
        'texto'    => '“Ivy y Maven <b>no tienen lugar en las máquinas de producción</b>” porque…',
        'opciones' => [
            'a' => 'Son lentos',
            'b' => 'Son herramientas de build: las librerías que la aplicación necesita deben empaquetarse con los binarios como parte del pipeline',
            'c' => 'No funcionan en Linux',
            'd' => 'Son de pago'
        ],
        'correcta' => 'b',
        'porque'   => 'En producción no se resuelven dependencias ni se compila: se despliega lo ya empaquetado.'
    ],
    'm9' => [
        'texto'    => 'Principio de las <b>modificaciones a entornos de test y producción</b>:',
        'opciones' => [
            'a' => 'Se hacen a mano por SSH',
            'b' => 'Solo por el CEO',
            'c' => 'Solo a través de un <b>proceso automatizado</b>; no se debe acceder remotamente para desplegar',
            'd' => 'Se hacen con un IDE'
        ],
        'correcta' => 'c',
        'porque'   => 'Un solo script si corre en una máquina; si no, orquestación de varios scripts (uno por parte independiente: BD, servidores de aplicación, servicios).'
    ],
    'm10' => [
        'texto'    => 'Las <b>tres opciones</b> para desplegar en máquinas remotas:',
        'opciones' => [
            'a' => 'FTP, correo, USB',
            'b' => 'Solo scripts',
            'c' => '(1) Un script que se conecta a cada máquina y ejecuta comandos; (2) un script local con <b>agentes</b> que lo ejecutan en cada máquina; (3) <b>empaquetar</b> con la tecnología de la plataforma y que una herramienta de infraestructura/despliegue empuje las nuevas versiones',
            'd' => 'Todo manual'
        ],
        'correcta' => 'c',
        'porque'   => 'La tercera es la más potente.'
    ],
    'm11' => [
        'texto'    => '¿Por qué la opción 3 (paquetes + herramienta declarativa e idempotente) es la más potente?',
        'opciones' => [
            'a' => 'Porque asegura que la versión correcta de los paquetes esté en todas las máquinas necesarias aunque estén caídas al programarse el despliegue o se agregue una máquina nueva; y usa las mismas herramientas para desplegar e infraestructura (mismo equipo: operaciones)',
            'b' => 'Porque es gratis',
            'c' => 'Porque no necesita paquetes',
            'd' => 'Porque no usa red'
        ],
        'correcta' => 'a',
        'porque'   => 'Herramientas: ControlTier, BMC BladeLogic; infraestructura: Marionette Collective, CfEngine, Puppet.'
    ],
    'm12' => [
        'texto'    => 'Si no puedes usar esas herramientas, la opción 2 (agentes del <b>servidor de CI</b>) aporta…',
        'opciones' => [
            'a' => 'Menos trabajo: se escriben los scripts como si fueran locales y el CI los corre en las máquinas; da re-ejecución ante fallos, salida de consola y un <b>dashboard</b> con las versiones desplegadas por entorno; y los agentes pueden llamar al servidor CI sin dar acceso remoto a los entornos',
            'b' => 'Más trabajo',
            'c' => 'Nada',
            'd' => 'Solo logs'
        ],
        'correcta' => 'a',
        'porque'   => 'Según los requisitos de seguridad puede convenir que los agentes “llamen” al servidor en vez de permitir acceso remoto.'
    ],
    'm13' => [
        'texto'    => 'Si programas tus propios despliegues (última opción), ¿qué herramientas aparecen?',
        'opciones' => [
            'a' => 'UNIX: Scp/Rsync para copiar y Ssh para ejecutar; Windows: PsExec y PowerShell; de alto nivel: Fabric, Func y Capistrano',
            'b' => 'UNIX: PsExec; Windows: Ssh',
            'c' => 'Solo FTP',
            'd' => 'Solo Bash'
        ],
        'correcta' => 'a',
        'porque'   => 'Pero ni el CI ni tus scripts resolverán errores como despliegues parcialmente completados o un nuevo nodo que se agrega al grid: por eso es preferible una herramienta de despliegue “apropiada”.'
    ],
    'm14' => [
        'texto'    => 'El modelo de <b>despliegue en capas</b> propone depositar…',
        'opciones' => [
            'a' => 'Primero la aplicación y luego el SO',
            'b' => 'Todo a la vez',
            'c' => 'Solo la aplicación',
            'd' => 'SO → middleware y software del que depende → configuración específica → tu software (binarios, servicios/daemons y su configuración)'
        ],
        'correcta' => 'd',
        'porque'   => 'Construir sobre fundamentos conocidos como buenos: se prueba cada capa al aplicarla para fallar rápido y saber dónde está el problema.'
    ],
    'm15' => [
        'texto'    => 'Las pruebas de configuración de entorno (infrastructure smoke tests)…',
        'opciones' => [
            'a' => 'Deben ser exhaustivas',
            'b' => 'Se omiten',
            'c' => 'No necesitan ser exhaustivas: son <b>smoke tests simples</b> que afirman la presencia o ausencia de recursos clave, para dar confianza de que la capa recién desplegada funciona',
            'd' => 'Son solo manuales'
        ],
        'correcta' => 'c',
        'porque'   => 'Ejemplos: recuperar un registro de la BD, contactar el sitio web, verificar los mensajes registrados en el broker, enviar “pings” a través del firewall para probar reparto round-robin.'
    ],
    'm16' => [
        'texto'    => 'Caso <b>.NET n-tier</b>: los servicios tenían puertos/URIs en archivos de configuración y diagnosticar era doloroso. ¿Qué hicieron?',
        'opciones' => [
            'a' => 'Un script Ruby que <b>parseaba los config.xml e intentaba conectarse a cada URI</b>, imprimiendo el resultado en consola',
            'b' => 'Reinstalaron los servidores',
            'c' => 'Cambiaron de lenguaje',
            'd' => 'Eliminaron los tiers'
        ],
        'correcta' => 'a',
        'porque'   => 'Antes había que revisar logs en las máquinas de ambos extremos.'
    ],
    'm17' => [
        'texto'    => 'Tip: <b>usar rutas relativas</b>. ¿Por qué?',
        'opciones' => [
            'a' => 'Son más cortas',
            'b' => 'Las rutas absolutas crean una dependencia estrecha con la configuración de una máquina y hacen imposible, por ejemplo, tener <b>dos checkouts del mismo proyecto</b> en una máquina; con relativas cada instancia del build es autocontenida',
            'c' => 'Porque Windows lo exige',
            'd' => 'Porque Linux no soporta absolutas'
        ],
        'correcta' => 'b',
        'porque'   => 'Si es inevitable (p. ej. librerías de terceros con rutas fijas), aislarlas en archivos de propiedades y como caso especial. Para instalaciones, seguir convenciones como FHS y hacer las rutas relativas a raíces bien definidas (despliegue, configuración).'
    ],
    'm18' => [
        'texto'    => 'Tip: <b>eliminar pasos manuales</b>. ¿Cuándo automatizar?',
        'opciones' => [
            'a' => 'Nunca',
            'b' => 'Al cabo de un año',
            'c' => 'Cuando tengas que hacerlo por <b>segunda vez</b>; a la tercera debe hacerse con un proceso automatizado',
            'd' => 'Solo en producción'
        ],
        'correcta' => 'c',
        'porque'   => 'Un “script de build” como documento impreso siempre está desactualizado y es un ejercicio de memoria, propenso a errores.'
    ],
    'm19' => [
        'texto'    => 'Tip: <b>trazabilidad de binarios a control de versiones</b>. ¿Cómo lograrla?',
        'opciones' => [
            'a' => 'Confiar en la memoria',
            'b' => 'Incluir metadatos de versión y el identificador de revisión en el binario (metadatos de ensamblados .NET, manifest del JAR); si no se puede, guardar en una base de datos el <b>hash MD5</b> de cada binario junto con su nombre y revisión',
            'c' => 'Poner el nombre del desarrollador',
            'd' => 'No es necesaria'
        ],
        'correcta' => 'b',
        'porque'   => 'Ante un problema en producción, saber exactamente qué versión de cada componente hay en la caja y de dónde viene puede salvar el día.'
    ],
    'm20' => [
        'texto'    => 'Tip: <b>no hacer commit de binarios</b> generados por el build. ¿Por qué?',
        'opciones' => [
            'a' => 'Porque el ID de revisión sirve para trazar cambios, y los binarios subidos tendrían un identificador propio distinto: confusión; los binarios/reportes van a un sistema de archivos compartido o a un repositorio de artefactos (Maven, Ivy, Nexus) como <b>metadatos asociados</b> a la revisión que los generó',
            'b' => 'Porque Git no acepta binarios',
            'c' => 'Porque pesan mucho solamente',
            'd' => 'Porque son secretos'
        ],
        'correcta' => 'a',
        'porque'   => 'Regla general: no versionar nada creado por el ciclo build-test-deploy. Si se pierden, se recrean desde el fuente; si no se puede, la gestión de configuración no está a la altura. (Coincide con Empaquetamiento: “Git no es un repositorio de artefactos”.)'
    ],
    'm21' => [
        'texto'    => 'Tip: <b>los targets de test no deben fallar el build inmediatamente</b>. ¿Qué se hace?',
        'opciones' => [
            'a' => 'Registrar que la actividad falló (con un flag) y continuar el resto del build; al final, si alguna tarea falló, salir con código de error; así se generan más reportes y se ejecuta la suite completa (en Ant/NAnt con el atributo <code>failure-property</code>)',
            'b' => 'Detener todo al primer fallo',
            'c' => 'Ignorar los fallos',
            'd' => 'Reintentar hasta que pasen'
        ],
        'correcta' => 'a',
        'porque'   => 'Si los unit tests fallan y detienen todo, no sabremos si los de integración pasaban hasta el siguiente check-in: tiempo perdido. (Ojo: es distinto del fail-fast del pipeline entre etapas.)'
    ],
    'm22' => [
        'texto'    => 'Tip: <b>restringir tu aplicación con smoke tests integrados</b>:',
        'opciones' => [
            'a' => 'Hacer que los scripts de despliegue verifiquen que están en la <b>máquina correcta</b> antes de desplegar, y que los componentes batch (mensuales, trimestrales, anuales) validen su configuración al instalarse',
            'b' => 'Restringir el número de usuarios',
            'c' => 'Cerrar la aplicación',
            'd' => 'Reducir las pruebas'
        ],
        'correcta' => 'a',
        'porque'   => 'Para no depurar a las 3 A.M. del 1 de enero la instalación que hiciste hoy.'
    ],
    'm23' => [
        'texto'    => 'Tips específicos de <b>.NET</b>:',
        'opciones' => [
            'a' => 'No hay ninguno',
            'b' => 'Archivos quitados de la solución pero presentes en disco confunden: mantener el proyecto limpio (activar Show Hidden Files); y asegurar que el <b>clean</b> borre todos los directorios <code>bin</code> y <code>obj</code> (p. ej. llamando el clean solution de Devenv)',
            'c' => 'Usar solo Ant',
            'd' => 'Usar solo Make'
        ],
        'correcta' => 'b',
        'porque'   => 'Las soluciones y proyectos .NET referencian los archivos que compilan; los no referenciados no se compilan.'
    ],
    'm24' => [
        'texto'    => 'Del <b>resumen</b> del capítulo, ¿qué son los “scripts”?',
        'opciones' => [
            'a' => 'Solo archivos .sh',
            'b' => 'Solo el makefile',
            'c' => 'Un concepto amplio: <b>toda la automatización</b> que ayuda a construir, probar, desplegar y liberar; ciudadanos de primera clase que viven toda la vida del sistema, versionados, mantenidos, probados y refactorizados, y el <b>único mecanismo</b> para desplegar',
            'd' => 'Documentos'
        ],
        'correcta' => 'c',
        'porque'   => 'Y no son tarea para un becario: hay que dedicar tiempo a diseñarlos bien.'
    ],
    'm25' => [
        'texto'    => 'Estrategia recomendada para crecer la automatización:',
        'opciones' => [
            'a' => 'Automatizarlo todo antes de empezar',
            'b' => 'Crecer paso a paso avanzando a lo largo del pipeline, identificando y automatizando iterativamente los pasos <b>más dolorosos</b>, con el objetivo de compartir el mismo mecanismo de despliegue entre desarrollo, pruebas y producción, e involucrando a operaciones y desarrolladores',
            'c' => 'Contratar consultores',
            'd' => 'No automatizar'
        ],
        'correcta' => 'b',
        'porque'   => 'No obsesionarse desde el principio con el objetivo final.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Farley cap. 6 · 3 — Layout, despliegue y tips', 'Continuous Delivery, cap. 6: layout JVM, librerías, scripting de despliegue, capas, tips y resumen');
?>

<div class="card">
  <h2>1. Layout de proyectos JVM y código fuente</h2>
  <ul>
    <li>Layout que asume Maven: <?php hueco(1, 30); ?>. Su contribución más importante es esa <?php hueco(2, 12); ?>; los proyectos <?php hueco(3, 4); ?>
        pueden usarlo cambiando barras por barras invertidas.</li>
    <li>El directorio <code><?php hueco(4, 4); ?></code> no es parte de Maven: solo si no se usa Maven se versionan las librerías ahí.</li>
    <li>Los archivos van en directorios con el nombre del <?php hueco(5, 8); ?>, <?php hueco(6, 18); ?>. Los paquetes en <?php hueco(8, 10); ?> y las clases en
        <?php hueco(9, 10); ?> (según el texto). Se vigila con <?php hueco(7, 12); ?> o FindBugs en el análisis del commit stage.</li>
    <li>La configuración o metadatos generados no van en <code><?php hueco(11, 4); ?></code>, sino en <code><?php hueco(10, 8); ?></code>, para poder
        <?php hueco(12, 8); ?> con un clean y para que no se suban a <?php hueco(13, 20); ?> por error.</li>
  </ul>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. Tests, salida del build y JARs</h2>
  <ul>
    <li>Todo el código de tests va en <code><?php hueco(14, 14); ?></code>. Las pruebas unitarias en un <?php hueco(15, 8); ?> de la jerarquía de paquetes:
        una prueba de una clase va en el <?php hueco(16, 14); ?> que la clase.</li>
    <li>Otras pruebas van en paquetes como <code>…<?php hueco(17, 12); ?>.ui</code>, <code>…acceptance.api</code>, <code>…<?php hueco(18, 12); ?></code>; en los scripts de build se ejecutan por separado
        usando <?php hueco(19, 24); ?>.</li>
    <li>Sin Maven, los reportes de test pueden ir en un directorio <code><?php hueco(20, 8); ?></code> bajo target. Nada de <code>target</code> se sube a control de
        versiones: se debe <?php hueco(21, 10); ?> en el sistema de control de versiones.</li>
    <li>El build genera binarios como <?php hueco(22, 4); ?>, <?php hueco(23, 4); ?> y <?php hueco(24, 4); ?> que el sistema de build debe <?php hueco(25, 12); ?> en el
        repositorio de artefactos.</li>
    <li>Al principio, cada proyecto crea <?php hueco(26, 4); ?> JAR. Crear varios sirve para que el despliegue sea sencillo y el build más
        <?php hueco(27, 10); ?>, minimizando la complejidad del <?php hueco(28, 24); ?>. Un paso separado para <?php hueco(29, 10); ?> la aplicación mantiene la
        <?php hueco(30, 14); ?> para cambiar de opinión.</li>
  </ul>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Gestión de librerías</h2>
  <ul>
    <li>Opción 1: <?php hueco(31, 12); ?> la gestión a Maven o Ivy (declarar dependencias; no se versionan librerías).</li>
    <li>Opción 2: versionar todas las librerías en el directorio <code><?php hueco(32, 4); ?></code>, separadas según se requieran en tiempo de
        <?php hueco(33, 8); ?>, <?php hueco(34, 8); ?> o <?php hueco(35, 8); ?>.</li>
    <li>Las dependencias de build muy grandes se guardan en un <?php hueco(36, 18); ?> dentro del control de versiones; o se crea un
        <?php hueco(37, 26); ?> que sirve, donde importa el <?php hueco(38, 12); ?>, para ofrecer las librerías <?php hueco(39, 10); ?>.</li>
    <li>Ivy y Maven no tienen lugar en las cajas de <?php hueco(40, 12); ?>.</li>
  </ul>
  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Scripting de despliegue</h2>
  <ul>
    <li>Los cambios en testing y producción solo por un proceso <?php hueco(41, 14); ?>; no se debe acceder <?php hueco(42, 12); ?> para desplegar.</li>
    <li>Si el sistema corre en una sola máquina: <?php hueco(43, 14); ?>. Si no, hace falta <?php hueco(44, 14); ?>: un script por cada parte independiente
        (BD, servidores de aplicación, servicios de los que depende), no necesariamente uno por servidor.</li>
    <li>Hay <?php hueco(45, 5); ?> opciones para desplegar en remoto: (1) un script que <?php hueco(46, 14); ?> en cada máquina; (2) un script local y
        <?php hueco(47, 8); ?> que lo ejecutan en cada máquina; (3) <?php hueco(48, 12); ?> la aplicación y que una herramienta empuje las nuevas versiones.
        La más potente es <?php hueco(49, 10); ?>.</li>
    <li>La opción 3 usa herramientas <?php hueco(50, 14); ?> e <?php hueco(51, 14); ?> (ControlTier, BladeLogic, Puppet…) que instalan la versión correcta aunque las máquinas estén
        <?php hueco(52, 8); ?> al momento del despliegue o se agregue una máquina nueva. Ejemplos: <?php hueco(53, 12); ?>. Es el mismo equipo de
        <?php hueco(54, 12); ?> quien gestiona ambos.</li>
    <li>La opción 2 aprovecha el <?php hueco(55, 8); ?> del CI: reintentos, consola y un <?php hueco(56, 10); ?> con las versiones desplegadas por entorno.</li>
    <li>Scripts propios: en UNIX <?php hueco(57, 6); ?>/Rsync para copiar y <?php hueco(58, 5); ?> para ejecutar; en Windows <?php hueco(59, 10); ?> y PowerShell;
        alto nivel: <?php hueco(60, 10); ?>. No resuelven despliegues <?php hueco(61, 14); ?> completados ni el caso de un <?php hueco(62, 10); ?> que se agrega al grid.</li>
  </ul>
  <p>La opción de los <b>agentes del CI</b> es la número <?php hueco(78, 3); ?>; la de <b>paquetes + herramienta de despliegue</b> es la número <?php hueco(79, 3); ?>.</p>
  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>5. Desplegar y probar en capas</h2>
  <ul>
    <li>Regla central: construir sobre <?php hueco(63, 12); ?> que se sabe que son buenos.</li>
    <li>Capas de abajo a arriba: <?php hueco(64, 16); ?> → <?php hueco(65, 10); ?> y demás software del que depende → <?php hueco(66, 14); ?> específica → nuestro
        <?php hueco(67, 10); ?> (binarios, servicios/daemons y su configuración).</li>
    <li>Cada capa se prueba al aplicarla, con <?php hueco(68, 14); ?> simples que afirman la <?php hueco(69, 20); ?> de recursos clave (recuperar un registro de la BD, contactar
        el sitio web, verificar los mensajes del broker, enviar <?php hueco(72, 6); ?>s por el firewall).</li>
    <li>Caso .NET n-tier: un script <?php hueco(71, 5); ?> que parseaba los <code><?php hueco(70, 12); ?></code> y probaba conectar a cada URI.</li>
  </ul>
  <?php mc('m14'); ?>
  <?php mc('m15'); ?>
  <?php mc('m16'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>6. Tips y trucos</h2>
  <ul>
    <li><b>Rutas <?php hueco(73, 10); ?>:</b> las absolutas impiden tener <?php hueco(74, 4); ?> checkouts del mismo proyecto en una máquina. Si son inevitables, van en
        archivos de <?php hueco(75, 12); ?>. Para instalaciones, seguir convenciones como el <?php hueco(76, 5); ?> de UNIX y hacer las rutas relativas a
        <?php hueco(77, 8); ?> bien definidas.</li>
    <li><b>Eliminar pasos <?php hueco(80, 10); ?>:</b> se automatiza cuando hay que hacerlo por <?php hueco(81, 12); ?>; a la <?php hueco(82, 12); ?> debe hacerlo un proceso automatizado.</li>
    <li><b><?php hueco(83, 14); ?>:</b> desde un binario poder saber su revisión. En .NET/Java: metadatos en ensamblados o en el <?php hueco(84, 10); ?> del JAR; si no,
        guardar el hash <?php hueco(85, 4); ?> con nombre y revisión en una base de datos.</li>
    <li><b>Binarios y control de versiones:</b> ¿se debe hacer commit de binarios generados? <?php hueco(86, 4); ?>: van a un <?php hueco(87, 30); ?> o repositorio de artefactos como
        <?php hueco(88, 10); ?> asociados a la revisión.</li>
    <li><b>Targets de test:</b> no deben <?php hueco(89, 14); ?> de inmediato; se marca un <?php hueco(90, 6); ?> y se falla al final. En Ant/NAnt: <code><?php hueco(91, 16); ?></code>.</li>
    <li><b>Smoke tests integrados:</b> los scripts verifican que están en la máquina correcta; los procesos batch validan su configuración al instalarse para no depurar a las
        <?php hueco(92, 8); ?> del <?php hueco(93, 12); ?>.</li>
    <li><b>.NET:</b> mantener limpio el proyecto (<?php hueco(96, 20); ?>); el clean debe borrar los directorios <?php hueco(94, 10); ?>, p. ej. con el <?php hueco(95, 12); ?> clean solution.</li>
  </ul>
  <?php mc('m17'); ?>
  <?php mc('m18'); ?>
  <?php mc('m19'); ?>
  <?php mc('m20'); ?>
  <?php mc('m21'); ?>
  <?php mc('m22'); ?>
  <?php mc('m23'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>7. Resumen</h2>
  <p>Por “script” se entiende toda la <?php hueco(97, 14); ?> que ayuda a construir, probar, desplegar y liberar. Los scripts son ciudadanos de
     <?php hueco(98, 12); ?>: deben vivir <?php hueco(99, 14); ?>, estar versionados, mantenidos, probados y refactorizados, y ser el
     <?php hueco(100, 16); ?> con el que se despliega el software. No es una tarea para un <?php hueco(101, 8); ?> del equipo.</p>
  <?php mc('m24'); ?>
  <?php mc('m25'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('segundo.php', '../Menu.php');
