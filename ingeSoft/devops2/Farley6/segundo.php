<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Farley cap. 6 — bloque 02: Principios y prácticas del
   scripting de build y despliegue.
   Fuente: Continuous Delivery (Humble & Farley) — Chapter 6, "Principles and
   Practices of Build and Deployment Scripting"
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- un script por etapa --- */
    1  => ['domain-driven design', 'diseno guiado por el dominio', 'ddd'],
    2  => ['un script por etapa', 'cada etapa', 'etapa'],
    3  => ['un solo script', 'unico script', 'un script'],
    4  => ['dummy', 'ficticios', 'de relleno', 'placeholders'],
    5  => ['commit'],
    6  => ['aceptacion funcional', 'pruebas de aceptacion funcional', 'aceptacion'],
    7  => ['no funcionales', 'nofuncionales', 'estres', 'seguridad'],
    8  => ['control de versiones', 'version control'],
    9  => ['mismo repositorio', 'mismo', 'el mismo repositorio'],
    10 => ['colaborar', 'colaboren', 'colaboracion'],

    /* --- tecnologia apropiada --- */
    11 => ['herramienta adecuada', 'herramienta apropiada', 'apropiada'],
    12 => ['middleware'],
    13 => ['wsadmin'],
    14 => ['websphere', 'websphere application server'],
    15 => ['desarrolladores', 'developers'],
    16 => ['al inicio', 'al principio', 'inicio'],
    17 => ['ant'],
    18 => ['operaciones'],
    19 => ['conan the deployer', 'conan'],
    20 => ['bash'],
    21 => ['participaron', 'involucrados', 'involucrado', 'los involucraron'],
    22 => ['actualizar', 'actualizacion', 'upgrade'],
    23 => ['desde cero', 'desde cero.'],
    24 => ['detener', 'apagar', 'apagar las versiones anteriores'],

    /* --- mismos scripts --- */
    25 => ['mismo', 'mismos'],
    26 => ['configuracion'],
    27 => ['uris', 'uri', 'ips', 'direcciones ip'],
    28 => ['control de versiones', 'version control'],
    29 => ['maquinas de los desarrolladores', 'maquinas de desarrollo', 'desarrolladores'],
    30 => ['paralelo', 'sistema de build paralelo'],
    31 => ['oracle', 'cluster oracle'],
    32 => ['en memoria', 'in-memory', 'memoria'],
    33 => ['no ejecutarse', 'casi no se ejecuta', 'se ejecuta mucho menos', 'menos'],

    /* --- empaquetado del SO --- */
    34 => ['binarios'],
    35 => ['empaquetado', 'empaquetar', 'paquetes'],
    36 => ['debian', 'debian package', 'apt'],
    37 => ['redhat', 'rpm', 'red hat'],
    38 => ['microsoft installer', 'msi'],
    39 => ['puppet'],
    40 => ['cfengine'],
    41 => ['marimba'],
    42 => ['repositorio organizacional', 'repositorio de la organizacion', 'repositorio'],
    43 => ['un paquete por capa', 'un paquete por tier', 'un paquete por tipo de maquina', 'un paquete por cada capa', 'un paquete'],
    44 => ['hibrido', 'enfoque hibrido'],
    45 => ['rubygems', 'gems'],
    46 => ['eggs', 'python eggs'],
    47 => ['cpan'],
    48 => ['administradores de sistemas', 'sysadmins', 'administradores'],

    /* --- idempotencia --- */
    49 => ['idempotente'],
    50 => ['mismo estado', 'mismo estado (correcto)', 'el mismo estado'],
    51 => ['linea base', 'baseline', 'linea base conocida'],
    52 => ['virtualizacion', 'aprovisionado', 'aprovisionamiento'],
    53 => ['validar', 'validar los supuestos', 'validar las suposiciones'],
    54 => ['fallar', 'falle', 'fallar el despliegue'],
    55 => ['todo', 'todas las capas', 'todos los niveles'],
    56 => ['desde cero', 'desde cero.'],
    57 => ['un solo commit', 'una sola revision', 'una sola', 'una revision'],
    58 => ['solo lo que cambio', 'solo lo que ha cambiado', 'solo lo modificado', 'solo lo cambiado'],
    59 => ['canary', 'canary releasing'],
    60 => ['tupla', 'tupla de revisiones'],
    61 => ['rsync'],
    62 => ['puppet'],
    63 => ['declarativa', 'declarativo', 'especificacion declarativa'],

    /* --- incremental --- */
    64 => ['incremental', 'incrementalmente'],
    65 => ['boton', 'un boton', 'push button', 'click'],
    66 => ['local', 'desarrollo local', 'entorno de desarrollo'],
    67 => ['pruebas', 'testing', 'entorno de pruebas'],
    68 => ['aceptacion', 'pruebas de aceptacion'],
    69 => ['produccion', 'staging y produccion'],
];

$TEXTO = [];
for ($i = 1; $i <= 69; $i++) $TEXTO[] = $i;

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Qué principio de diseño se aplica a los scripts de build, según los autores?',
        'opciones' => [
            'a' => 'Cada script debe hacer todo',
            'b' => 'La estructura de los scripts debe <b>representar claramente los procesos</b> que implementan (idea de domain-driven design), con estructura bien definida y mínimas dependencias entre componentes',
            'c' => 'Los scripts deben escribirse una sola vez y no tocarse',
            'd' => 'Los scripts no importan'
        ],
        'correcta' => 'b',
        'porque'   => 'Y el deployment pipeline es el principio organizador natural para dividir las responsabilidades entre scripts.'
    ],
    'm2' => [
        'texto'    => 'Al iniciar un proyecto, ¿cómo conviene organizar los scripts?',
        'opciones' => [
            'a' => 'Un script gigante con <b>targets ficticios</b> para lo no automatizado; cuando crezca, dividir en un script por etapa del pipeline',
            'b' => 'Un script por desarrollador',
            'c' => 'Un script por servidor',
            'd' => 'Ninguno; todo manual'
        ],
        'correcta' => 'a',
        'porque'   => 'Al dividir: commit (compilar, empaquetar, commit tests, análisis estático), aceptación funcional (desplegar, preparar datos, correr pruebas) y no funcionales (estrés, seguridad).'
    ],
    'm3' => [
        'texto'    => 'El <b>script de commit</b> contiene los targets para…',
        'opciones' => [
            'a' => 'Desplegar a producción',
            'b' => 'Ejecutar pruebas de estrés',
            'c' => 'Compilar la aplicación, empaquetarla, correr la <b>suite de commit tests</b> y hacer análisis estático del código',
            'd' => 'Preparar datos para UAT'
        ],
        'correcta' => 'c',
        'porque'   => 'El script de aceptación funcional llama a la herramienta de despliegue, prepara datos y corre las pruebas de aceptación.'
    ],
    'm4' => [
        'texto'    => '¿Dónde deben guardarse los scripts?',
        'opciones' => [
            'a' => 'En una carpeta compartida',
            'b' => 'En el servidor de CI únicamente',
            'c' => 'En el correo de operaciones',
            'd' => 'En control de versiones, <b>preferiblemente el mismo repositorio que el código fuente</b>, para que desarrolladores y operaciones colaboren'
        ],
        'correcta' => 'd',
        'porque'   => 'Es esencial que ambos roles colaboren sobre los scripts.'
    ],
    'm5' => [
        'texto'    => 'Para desplegar en un entorno tipo producción, se recomienda…',
        'opciones' => [
            'a' => 'Usar la <b>herramienta adecuada</b> (las propias del middleware: p. ej. Wsadmin en WebSphere) y no un lenguaje de scripting de propósito general, salvo despliegues muy simples',
            'b' => 'Usar siempre bash',
            'c' => 'Copiar archivos con FTP',
            'd' => 'Reiniciar el servidor'
        ],
        'correcta' => 'a',
        'porque'   => 'Casi todo middleware tiene sus herramientas de configuración y despliegue.'
    ],
    'm6' => [
        'texto'    => 'Caso de la <b>telecom</b>: los desarrolladores hicieron un despliegue con Ant; en UAT falló y operaciones se negó a usarlo. ¿Qué se hizo?',
        'opciones' => [
            'a' => 'Se despidió al equipo',
            'b' => 'Se compró una herramienta comercial',
            'c' => 'Se formó un equipo de build que creó, junto con operaciones y desarrolladores, un conjunto de scripts Bash (“<b>Conan the Deployer</b>”) usado en todos los entornos',
            'd' => 'Se dejó a operaciones desplegar a mano'
        ],
        'correcta' => 'c',
        'porque'   => 'Operaciones aceptó usarlo en producción porque (1) participó en su creación y (2) lo vio usarse en todos los entornos de prueba.'
    ],
    'm7' => [
        'texto'    => 'El script de despliegue debe cubrir…',
        'opciones' => [
            'a' => 'Solo instalación desde cero',
            'b' => 'Solo actualización',
            'c' => 'Tanto la <b>actualización</b> como la instalación desde cero (apagar versiones previas, crear la BD desde cero o actualizar una existente)',
            'd' => 'Solo pruebas'
        ],
        'correcta' => 'c',
        'porque'   => 'Un solo script para ambos casos.'
    ],
    'm8' => [
        'texto'    => 'Las diferencias entre entornos (URIs de servicios, IPs) se representan como…',
        'opciones' => [
            'a' => 'Código distinto en cada script',
            'b' => 'Scripts distintos por entorno',
            'c' => '<b>Información de configuración</b> gestionada por separado, guardada en control de versiones y recuperada por el script',
            'd' => 'Variables hardcodeadas'
        ],
        'correcta' => 'c',
        'porque'   => 'Mismos scripts en todos los entornos + configuración separada.'
    ],
    'm9' => [
        'texto'    => '¿Por qué debe funcionar el mismo script en las <b>máquinas de los desarrolladores</b>?',
        'opciones' => [
            'a' => 'Para que no surja un sistema de build paralelo que solo usan los desarrolladores; eso eliminaría una de las fuerzas que mantienen los scripts flexibles, bien factorizados y bien probados',
            'b' => 'Por costumbre',
            'c' => 'Porque es más barato',
            'd' => 'Para no usar CI'
        ],
        'correcta' => 'a',
        'porque'   => 'Si los desarrolladores dependen de recursos compartidos, ejecutan la aplicación mucho menos: feedback más lento, más defectos.'
    ],
    'm10' => [
        'texto'    => 'Para correr localmente una arquitectura compleja (p. ej. un <b>clúster Oracle</b>), se recomienda…',
        'opciones' => [
            'a' => 'No correrla localmente',
            'b' => 'Alquilar un clúster por desarrollador',
            'c' => 'Compartir el clúster',
            'd' => 'Simplificar: por ejemplo reemplazarlo por una <b>base de datos en memoria</b> al desplegar; el esfuerzo se amortiza'
        ],
        'correcta' => 'd',
        'porque'   => 'La pregunta no es “¿cómo justificamos el coste?” sino “¿cómo justificamos no invertir en poder correr la aplicación localmente?”.'
    ],
    'm11' => [
        'texto'    => '¿Por qué usar las <b>herramientas de empaquetado del sistema operativo</b> (deb, rpm, MSI)?',
        'opciones' => [
            'a' => 'Porque desplegar ficheros repartidos por el sistema de archivos es ineficiente y dificulta actualizar, revertir y desinstalar; un paquete lo simplifica y permite apoyarse en Puppet, CfEngine o Marimba',
            'b' => 'Porque son más lentas',
            'c' => 'Porque no requieren pruebas',
            'd' => 'Porque no necesitan repositorio'
        ],
        'correcta' => 'a',
        'porque'   => 'Suben los paquetes a un repositorio organizacional y las herramientas instalan la versión correcta, igual que instalan Apache.'
    ],
    'm12' => [
        'texto'    => 'Sistemas de paquetes del SO mencionados:',
        'opciones' => [
            'a' => 'Debian/Ubuntu: paquetes Debian; RedHat/SuSE: paquetes RedHat (rpm); Windows: Microsoft Installer',
            'b' => 'Debian: rpm; Redhat: deb',
            'c' => 'Windows: npm',
            'd' => 'Ubuntu: MSI'
        ],
        'correcta' => 'a',
        'porque'   => 'Bien soportados por herramientas y sencillos de usar.'
    ],
    'm13' => [
        'texto'    => 'Cuando no se puede desplegar solo con paquetes (p. ej. middleware comercial que exige herramientas propias), se usa un enfoque…',
        'opciones' => [
            'a' => 'Manual',
            'b' => '<b>Híbrido</b>: paquetes para lo que no requiere herramientas especiales y las herramientas especializadas para el resto',
            'c' => 'De reinstalar el SO',
            'd' => 'De copiar y pegar'
        ],
        'correcta' => 'b',
        'porque'   => 'También se puede crear un paquete por cada capa o tipo de máquina (arquitecturas n-tier).'
    ],
    'm14' => [
        'texto'    => '¿Por qué los autores prefieren el empaquetado del <b>SO</b> frente al de plataforma (RubyGems, Python Eggs, CPAN)?',
        'opciones' => [
            'a' => 'Porque los de plataforma son más nuevos',
            'b' => 'Porque están hechos por y para desarrolladores, no administradores de sistemas: añaden otra capa de gestión que no siempre convive bien con el gestor de paquetes del SO',
            'c' => 'Porque no existen',
            'd' => 'Porque son de pago'
        ],
        'correcta' => 'b',
        'porque'   => 'Excepción: una app Rails pura desplegada en varios SO puede usar RubyGems. Pero, donde se pueda, se prefiere la cadena estándar del SO.'
    ],
    'm15' => [
        'texto'    => 'Un despliegue <b>idempotente</b> es aquel que…',
        'opciones' => [
            'a' => 'Solo funciona una vez',
            'b' => 'Siempre despliega lo mismo aunque falle',
            'c' => 'Deja el entorno destino en el <b>mismo estado (correcto)</b>, sin importar el estado en que lo encuentre',
            'd' => 'Es muy rápido'
        ],
        'correcta' => 'c',
        'porque'   => 'La forma más simple: partir de una línea base conocida (aprovisionada automáticamente o con virtualización), con middleware ya instalado.'
    ],
    'm16' => [
        'texto'    => 'Si la gestión de configuración no permite partir de una línea base conocida, la siguiente mejor opción es…',
        'opciones' => [
            'a' => 'Ignorar el problema',
            'b' => '<b>Validar</b> las suposiciones sobre el entorno (middleware instalado, corriendo y en la versión correcta; servicios de los que depende) y <b>fallar</b> el despliegue si no se cumplen',
            'c' => 'Desplegar de todos modos',
            'd' => 'Reinstalar todo'
        ],
        'correcta' => 'b',
        'porque'   => 'En cualquier caso, también hay que validar que los servicios de los que depende la aplicación estén corriendo y en la versión correcta.'
    ],
    'm17' => [
        'texto'    => 'Si la aplicación se prueba, construye e integra como una sola pieza, conviene…',
        'opciones' => [
            'a' => 'Desplegar solo los artefactos modificados',
            'b' => 'Desplegar solo la capa de presentación',
            'c' => 'Desplegar <b>todo desde cero</b> en cada despliegue, con binarios de una sola revisión (todas las capas juntas)',
            'd' => 'Desplegar por FTP'
        ],
        'correcta' => 'c',
        'porque'   => 'Averiguar qué cambió es más complejo y propenso a errores que desplegar todo; además es mucho más difícil de probar: el caso patológico no considerado será el que ocurra en el release.'
    ],
    'm18' => [
        'texto'    => '¿Cuáles son las <b>excepciones</b> a “desplegar todo desde cero”?',
        'opciones' => [
            'a' => 'No hay excepciones',
            'b' => 'Solo cuando hay prisa',
            'c' => 'Sistemas en clúster (no siempre se redepliega todo el clúster a la vez: <b>canary releasing</b>); componentes de repositorios distintos (se despliega la tupla de revisiones y solo el que cambia si esa combinación ya fue probada); y herramientas idempotentes por sí mismas (Rsync, Puppet)',
            'd' => 'Solo en entornos de desarrollo'
        ],
        'correcta' => 'c',
        'porque'   => 'La clave: que el proceso de actualización del estado anterior al nuevo <b>ya haya sido probado</b>.'
    ],
    'm19' => [
        'texto'    => '¿Qué garantiza <b>Rsync</b> y qué hace <b>Puppet</b> (ejemplos de herramientas idempotentes)?',
        'opciones' => [
            'a' => 'Rsync compila; Puppet firma',
            'b' => 'Rsync asegura que un directorio destino sea idéntico al origen (transfiriendo solo las diferencias); Puppet analiza la configuración del destino y hace solo los cambios necesarios para alinearlo con la <b>especificación declarativa</b> del estado deseado',
            'c' => 'Ambos solo copian',
            'd' => 'Rsync es un test framework'
        ],
        'correcta' => 'b',
        'porque'   => 'También el control de versiones actualizando directorios logra un efecto similar.'
    ],
    'm20' => [
        'texto'    => 'Sobre <b>evolucionar el sistema de despliegue</b>:',
        'opciones' => [
            'a' => 'Hay que tenerlo completo antes de usarlo',
            'b' => 'Se hace todo de una vez con un equipo especial',
            'c' => 'Es una colección de <b>pasos simples e incrementales</b>; no hace falta terminarlos todos para obtener valor (empezar con un script local compartido, luego entorno de pruebas con operaciones, luego aceptación, luego staging y producción)',
            'd' => 'No es posible'
        ],
        'correcta' => 'c',
        'porque'   => 'Aparenta magia desde fuera; por dentro, pasos simples acumulados.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Farley cap. 6 · 2 — Principios y prácticas de scripting', 'Continuous Delivery, cap. 6: un script por etapa, misma herramienta en todo entorno, paquetes del SO, idempotencia');
?>

<div class="card">
  <h2>1. Crear un script para cada etapa del pipeline</h2>
  <ul>
    <li>Los autores aplican <?php hueco(1, 22); ?> también al diseño de los scripts de build: la estructura debe reflejar el proceso que implementan.</li>
    <li>El deployment pipeline es el principio organizador: se divide <?php hueco(2, 18); ?>.
        Al arrancar el proyecto, basta <?php hueco(3, 12); ?> con objetivos <?php hueco(4, 8); ?> para lo no automatizado.</li>
    <li>Script de <?php hueco(5, 8); ?>: compilar, empaquetar, correr commit tests y análisis estático.</li>
    <li>Script de <?php hueco(6, 20); ?>: llamar a la herramienta de despliegue, preparar datos y correr las pruebas.</li>
    <li>Script de pruebas <?php hueco(7, 14); ?> (estrés, seguridad).</li>
    <li>Todos en <?php hueco(8, 20); ?>, preferiblemente en el <?php hueco(9, 18); ?> que el código fuente, para que desarrolladores y operaciones puedan
        <?php hueco(10, 12); ?>.</li>
  </ul>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. Usar una tecnología apropiada y colaborar con operaciones</h2>
  <ul>
    <li>Usa la <?php hueco(11, 20); ?> para el trabajo, no un lenguaje de scripting general: casi todo <?php hueco(12, 10); ?> tiene sus propias herramientas
        (p. ej. <code><?php hueco(13, 8); ?></code> para <?php hueco(14, 12); ?>).</li>
    <li>El despliegue lo hacen <?php hueco(15, 16); ?> (en local), testers y operaciones; la decisión sobre cómo desplegar debe tomarse
        <?php hueco(16, 12); ?> del proyecto.</li>
    <li><b>Caso de la telecom:</b> los devs hicieron un despliegue con <?php hueco(17, 4); ?> que falló en UAT y el equipo de <?php hueco(18, 12); ?>
        se negó a usarlo. Se creó un conjunto de scripts <?php hueco(20, 5); ?> llamado “<?php hueco(19, 18); ?>”.</li>
    <li>Operaciones aceptó porque (1) <?php hueco(21, 12); ?> en su creación y (2) lo vio usarse en todo el pipeline de pruebas.</li>
    <li>El script debe cubrir la <?php hueco(22, 12); ?> y la instalación <?php hueco(23, 10); ?>: por ejemplo, <?php hueco(24, 10); ?> versiones previas y crear o actualizar la BD.</li>
  </ul>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Usar los mismos scripts para desplegar en todos los entornos</h2>
  <ul>
    <li>Se usa el <?php hueco(25, 8); ?> proceso en todos los entornos; las diferencias (<?php hueco(27, 12); ?> de servicios, IPs) son información de
        <?php hueco(26, 14); ?> gestionada aparte en <?php hueco(28, 20); ?>.</li>
    <li>Los scripts deben funcionar en las <?php hueco(29, 26); ?>; si surge un sistema de build <?php hueco(30, 10); ?> que solo usan los devs, se pierde una de las
        fuerzas que mantienen los scripts bien factorizados y probados.</li>
    <li>Ejemplo de simplificación: reemplazar un clúster <?php hueco(31, 8); ?> por una BD <?php hueco(32, 12); ?> al desplegar.</li>
    <li>Si los desarrolladores dependen de recursos compartidos, la aplicación se ejecuta <?php hueco(33, 12); ?>: feedback más lento, más defectos.</li>
  </ul>
  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Usar las herramientas de empaquetado del sistema operativo</h2>
  <ul>
    <li>Desplegar un conjunto de ficheros repartidos por el sistema de archivos dificulta actualizar, revertir y desinstalar. Por eso existen los sistemas de
        <?php hueco(35, 12); ?> de paquetes para agrupar los <?php hueco(34, 10); ?>.</li>
    <li>Debian y Ubuntu: sistema <?php hueco(36, 8); ?>; RedHat, SuSE: sistema <?php hueco(37, 8); ?>; Windows: <?php hueco(38, 20); ?>.</li>
    <li>Se puede montar el despliegue sobre herramientas de gestión de entornos como <?php hueco(39, 8); ?>, <?php hueco(40, 8); ?> y <?php hueco(41, 8); ?>:
        se suben los paquetes a un <?php hueco(42, 22); ?> y la herramienta instala la versión correcta.</li>
    <li>Si se necesitan cosas distintas en cada máquina (n-tier): <?php hueco(43, 18); ?>.</li>
    <li>Cuando no basta el paquete (middleware comercial con herramientas propias) se usa un enfoque <?php hueco(44, 8); ?>.</li>
    <li>Sistemas por plataforma: <?php hueco(45, 8); ?> (Ruby), <?php hueco(46, 12); ?> (Python), <?php hueco(47, 6); ?> (Perl). Los <?php hueco(48, 26); ?> los detestan.</li>
  </ul>
  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php mc('m14'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>5. Asegurar que el proceso de despliegue sea idempotente</h2>
  <ul>
    <li>Un despliegue <?php hueco(49, 12); ?> deja el entorno en el <?php hueco(50, 14); ?> (correcto) sin importar el estado inicial.</li>
    <li>Lo más sencillo: partir de una <?php hueco(51, 14); ?> conocida, aprovisionada automáticamente o mediante <?php hueco(52, 16); ?>.</li>
    <li>Si no se puede: <?php hueco(53, 10); ?> las suposiciones sobre el entorno y hacer <?php hueco(54, 8); ?> el despliegue cuando no se cumplan.</li>
    <li>Si la aplicación se prueba, construye e integra como una sola pieza, se despliega <?php hueco(55, 6); ?> (todas las capas) <?php hueco(56, 10); ?>, con binarios de
        <?php hueco(57, 18); ?> de control de versiones.</li>
    <li>Desplegar solo <?php hueco(58, 26); ?> es más complejo, propenso a errores y difícil de probar.</li>
    <li>Excepciones: clústeres (<?php hueco(59, 18); ?> releasing); componentes de varios repositorios: se despliega la <?php hueco(60, 8); ?> de revisiones;
        y herramientas idempotentes como <?php hueco(61, 6); ?> (sincroniza directorios) o <?php hueco(62, 8); ?> (estado deseado con especificación
        <?php hueco(63, 12); ?>).</li>
  </ul>
  <?php mc('m15'); ?>
  <?php mc('m16'); ?>
  <?php mc('m17'); ?>
  <?php mc('m18'); ?>
  <?php mc('m19'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>6. Evolucionar el sistema de despliegue de forma incremental</h2>
  <ul>
    <li>El despliegue con “un <?php hueco(65, 6); ?>” parece magia, pero es una colección de pasos simples que crece de forma <?php hueco(64, 14); ?>.</li>
    <li>Orden sugerido: primero un script para el entorno <?php hueco(66, 8); ?> compartido con el equipo; luego automatizar el despliegue en el entorno de
        <?php hueco(67, 10); ?> junto con operaciones; luego usarlo en el de <?php hueco(68, 12); ?>; por último que operaciones lo use en staging y
        <?php hueco(69, 12); ?>.</li>
  </ul>
  <?php mc('m20'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
