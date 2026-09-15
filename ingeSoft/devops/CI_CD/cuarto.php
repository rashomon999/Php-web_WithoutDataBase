<?php
/* ==========================================================================
   IngeSoft5 / DevOps / CI_CD — bloque 04: CI/CD con GitHub Actions
   Fuente: CI_CD.pdf Seccion 04 + Presentacion_GitHub_Actions_CICD.pdf (1-3)
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- anatomia del pipeline --- */
    1  => ['workflows'],
    2  => ['workflow_dispatch', 'workflow dispatch'],
    3  => ['needs'],
    4  => ['run'],
    5  => ['uses'],
    6  => ['versionada'],
    7  => ['eventos', 'sucesos'],

    /* --- jobs y runners --- */
    8  => ['ubuntu-latest', 'ubuntu latest'],
    9  => ['paralelo'],
    10 => ['artefactos', 'artifacts'],
    11 => ['cancelan'],
    12 => ['limpia', 'efimera'],

    /* --- acciones del marketplace --- */
    13 => ['actions/checkout@v4'],
    14 => ['actions/setup-java@v4'],
    15 => ['actions/setup-node@v4'],
    16 => ['actions/upload-artifact@v4'],
    17 => ['actions/download-artifact@v4'],
    18 => ['temurin'],
    19 => ['17'],
    20 => ['20'],
    21 => ['maven'],
    22 => ['npm'],

    /* --- fases de CI --- */
    23 => ['estatico'],
    24 => ['cobertura'],
    25 => ['ci'],
    26 => ['eslint'],
    27 => ['vitest'],

    /* --- despliegues condicionales --- */
    28 => ['despliegues', 'despliegue'],
    29 => ['falla'],
    30 => ['release', 'release/*'],
    31 => ['salud'],
    32 => ['shift-left', 'shift left'],

    /* --- lineas y bloques --- */
    33 => 'uses: actions/checkout@v4',
    34 => 'runs-on: ubuntu-latest',
    35 => 'needs: [test-backend, test-frontend]',
    36 => "on:\n  push:\n    branches: [main]\n  pull_request:\n    branches: [main]",
];

$TEXTO = [1,2,3,4,5,6,7,8,9,10,11,12,18,21,22,23,24,25,26,27,28,29,30,31,32];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'El PDF llama a esto <b>Pipeline as Code</b>. &iquest;Cual es la consecuencia practica de que el workflow sea un archivo YAML <b>dentro del repositorio</b>?',
        'opciones' => [
            'a' => 'Que se ejecuta mas rapido',
            'b' => 'Que el pipeline se <b>versiona con el codigo</b>: viaja en las ramas, se revisa en el Pull Request, se puede revertir con <code>git revert</code> y cada commit antiguo sabe como se construia a si mismo',
            'c' => 'Que no hace falta conexion a internet',
            'd' => 'Que GitHub lo cifra automaticamente'
        ],
        'porque'   => 'Compara con la alternativa clasica: un Jenkins donde el trabajo se configura haciendo clic en una web. Ahi nadie sabe quien cambio que, no hay revision, no hay vuelta atras, y una rama vieja no se puede reconstruir. Con Pipeline as Code, cambiar el pipeline <b>es</b> un Pull Request.',
        'correcta' => 'b'
    ],
    'm2' => [
        'texto'    => 'Tienes <code>on: push: branches: [main]</code> y añades tambien <code>workflow_dispatch:</code>. &iquest;Que ganas?',
        'opciones' => [
            'a' => 'Que el workflow corre en todas las ramas',
            'b' => 'Un <b>boton de disparo manual</b> desde la interfaz web de GitHub, util para relanzar un despliegue o probar el pipeline sin tener que inventarse un commit',
            'c' => 'Que se ejecuta cada hora',
            'd' => 'Que se pueden pasar secretos'
        ],
        'correcta' => 'b',
        'porque'   => 'El truco sucio que evita: hacer <code>git commit --allow-empty -m "trigger ci"</code> solo para forzar una ejecucion. Con <code>workflow_dispatch</code> ademas puedes declarar <code>inputs:</code> y pedir parametros al lanzarlo (que entorno, que version).'
    ],
    'm3' => [
        'texto'    => 'Por defecto, dos jobs declarados en el mismo workflow...',
        'opciones' => [
            'a' => 'Se ejecutan en <b>paralelo</b>, cada uno en su propia maquina virtual limpia',
            'b' => 'Se ejecutan en secuencia, de arriba abajo',
            'c' => 'Se ejecutan en la misma maquina, compartiendo disco',
            'd' => 'Solo corre el primero'
        ],
        'correcta' => 'a',
        'porque'   => 'Esto tiene dos consecuencias que la gente choca a diario: (1) es <b>mas rapido</b> — <code>test-backend</code> y <code>test-frontend</code> corren a la vez; (2) los jobs <b>no comparten disco</b>, asi que un archivo generado en uno no existe en el otro. Para eso estan los artefactos.'
    ],
    'm4' => [
        'texto'    => 'El job <code>build-docker</code> necesita el <code>.jar</code> que compilo <code>test-backend</code>. &iquest;Como llega de un job al otro?',
        'opciones' => [
            'a' => 'Automaticamente, porque estan en el mismo workflow',
            'b' => 'Se sube con <code>actions/upload-artifact</code> en el primer job y se baja con <code>actions/download-artifact</code> en el segundo — los runners son maquinas <b>efimeras e independientes</b>',
            'c' => 'Se guarda en la cache de GitHub',
            'd' => 'Se hace commit del <code>.jar</code> al repositorio'
        ],
        'correcta' => 'b',
        'porque'   => 'No confundas <b>artefacto</b> con <b>cache</b>. El artefacto transporta <i>resultados</i> entre jobs (y te los deja descargar desde la web). La cache acelera <i>dependencias</i> (<code>~/.m2</code>, <code>node_modules</code>) y es best-effort: si se pierde, el build sigue funcionando, solo mas lento.'
    ],
    'm5' => [
        'texto'    => '&iquest;Cuando usas <code>run:</code> y cuando <code>uses:</code>?',
        'opciones' => [
            'a' => '<code>run:</code> para acciones del Marketplace y <code>uses:</code> para comandos de shell',
            'b' => '<code>run:</code> ejecuta comandos directos del shell del runner (<code>mvn test</code>, <code>npm run build</code>); <code>uses:</code> invoca una <b>accion reutilizable empaquetada</b> del Marketplace, configurada con <code>with:</code>',
            'c' => 'Son intercambiables',
            'd' => '<code>uses:</code> solo sirve para <code>checkout</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla practica: si tu proyecto ya sabe hacerlo con un comando, usa <code>run:</code>. Si es fontaneria del entorno (instalar un JDK, configurar cache, publicar una imagen), casi seguro ya existe una accion y escribirla a mano con <code>run:</code> son 30 lineas de bash fragil.'
    ],
    'm6' => [
        'texto'    => 'Añades <code>cache: \'maven\'</code> al <code>setup-java</code>. &iquest;Que ahorra exactamente?',
        'opciones' => [
            'a' => 'Evita recompilar las clases que no cambiaron',
            'b' => 'Guarda el repositorio local de dependencias (<code>~/.m2</code>) entre ejecuciones: como el runner nace <b>vacio</b> cada vez, sin cache se vuelven a descargar todos los JAR de internet en cada build',
            'c' => 'Cachea el resultado de las pruebas',
            'd' => 'Reduce el tamaño de la imagen Docker'
        ],
        'correcta' => 'b',
        'porque'   => 'Es una de las preguntas de reflexion de la presentacion. En un proyecto Spring de tamaño normal son varios minutos de descarga <b>por ejecucion</b>; multiplicado por cada push de cada persona del equipo, es la diferencia entre un pipeline de 2 minutos y uno de 8. Y en GitHub-hosted, los minutos se facturan.'
    ],
    'm7' => [
        'texto'    => 'Se abre un Pull Request hacia <code>develop</code>. Segun la estrategia del PDF, &iquest;que debe hacer el pipeline?',
        'opciones' => [
            'a' => 'Compilar, ejecutar las pruebas y <b>desplegar</b> a un servidor de staging',
            'b' => 'Compilar y ejecutar las pruebas <b>sin desplegar nada</b>, y <b>bloquear la integracion</b> si alguna prueba falla',
            'c' => 'Solo ejecutar el linter',
            'd' => 'Nada, los PR no disparan workflows'
        ],
        'correcta' => 'b',
        'porque'   => 'La regla es: <b>el PR valida, el merge despliega</b>. Desplegar desde una rama que aun no ha sido aprobada convierte cualquier PR abierto (incluido el de un desconocido) en una via hacia tus servidores. El CD se activa <b>solo</b> tras el merge exitoso a <code>main</code> o <code>release/*</code>.'
    ],
    'm8' => [
        'texto'    => 'Un desarrollador rompe una prueba unitaria del backend y abre un PR. &iquest;Como protege el pipeline la estabilidad de <code>main</code>?',
        'opciones' => [
            'a' => 'Revierte el commit automaticamente',
            'b' => 'El job <code>test-backend</code> sale con codigo distinto de cero &rarr; el check del PR se marca en <b>rojo</b> &rarr; con <b>branch protection</b> activo el boton de merge queda bloqueado, y ademas los jobs que dependian de el (<code>needs:</code>) se <b>cancelan</b> sin gastar minutos',
            'c' => 'Envia un correo al profesor',
            'd' => 'Despliega igual pero marca la version como inestable'
        ],
        'correcta' => 'b',
        'porque'   => 'Ojo al matiz que cae en el examen: Actions por si solo <b>no impide</b> el merge, solo reporta el estado. Lo que lo impide es la <b>proteccion de rama</b> configurada para exigir ese check. Pipeline sin branch protection = semaforo sin policia.'
    ],
    'm9' => [
        'texto'    => '&iquest;Por que se ejecutan las pruebas unitarias <b>antes</b> de construir las imagenes Docker, y no al reves?',
        'opciones' => [
            'a' => 'Porque Docker necesita el resultado de las pruebas',
            'b' => '<b>Fail fast</b>: las pruebas son rapidas y baratas; construir imagenes es lento y caro. Si el codigo esta roto, no tiene sentido gastar minutos empaquetando un artefacto que nadie va a desplegar',
            'c' => 'Porque el orden lo impone YAML',
            'd' => 'Porque las imagenes no se pueden construir sin JDK'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el principio de <b>shift-left</b> aplicado al orden de los jobs: mueve los controles baratos lo mas a la izquierda posible del pipeline. Ordena tu pipeline de mas rapido a mas lento — lint, unit, build, integracion, smoke — para que el feedback llegue en segundos y no en cuartos de hora.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('CI/CD · 4 — GitHub Actions: anatomia del pipeline', 'CI_CD.pdf Modulo 4 + Presentacion_GitHub_Actions_CICD.pdf');
?>

<div class="card">
  <h2>1. Anatomia de un pipeline declarativo</h2>

  <table class="datos">
    <tr><th>Pieza</th><th>Que es</th></tr>
    <tr><td><b>Ubicacion</b></td>
        <td>archivos YAML bajo <code>.github/<?php hueco(1, 14); ?>/</code></td></tr>
    <tr><td><b>Triggers (<code>on</code>)</b></td>
        <td><?php hueco(7, 12); ?> de activacion: <code>push</code>,
            <code>pull_request</code> o manual
            (<code><?php hueco(2, 20); ?></code>)</td></tr>
    <tr><td><b>Jobs</b></td>
        <td>tareas que corren en <?php hueco(9, 12); ?> o de forma secuencial
            mediante dependencias (<code><?php hueco(3, 10); ?>:</code>)</td></tr>
    <tr><td><b>Steps</b></td>
        <td>pasos atomicos que invocan acciones de la comunidad
            (<code><?php hueco(5, 8); ?>:</code>) o comandos de shell
            (<code><?php hueco(4, 8); ?>:</code>)</td></tr>
  </table>

  <div class="avisoflujo">
    <b>Pipeline as Code.</b> Toda la logica de integracion, pruebas y despliegue vive
    <?php hueco(6, 14); ?> en el mismo repositorio del proyecto.
  </div>

  <h3>Escribelo de memoria</h3>
  <?php bloque(36, 'El bloque <code>on:</code> completo que dispara el workflow ante <b>push</b> a <code>main</code> y ante <b>pull request</b> hacia <code>main</code>. Cinco lineas, con la sangria que quieras.', 6); ?>
  <?php ayuda('Estructura: <code>on:</code> &rarr; dentro <code>push:</code> y <code>pull_request:</code> &rarr; dentro de cada uno <code>branches: [main]</code>.'); ?>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Jobs, runners y aislamiento</h2>

  <ul>
    <li>Cada job corre en una maquina virtual <?php hueco(12, 12); ?>;
        el SO se declara con <code>runs-on: <?php hueco(8, 16); ?></code>.</li>
    <li><b>Aislamiento total:</b> los archivos de un job <b>no existen</b> en otro a menos
        que se compartan como <?php hueco(10, 14); ?>.</li>
    <li><b>Regla de oro de <code>needs:</code></b> si cualquier job predecesor falla,
        los jobs dependientes se <?php hueco(11, 12); ?> automaticamente.</li>
  </ul>

  <h3>Escribelo de memoria</h3>
  <?php linea(34, 'La linea que manda el job al runner estandar de Ubuntu en la nube de GitHub.', 'runs-on: ...'); ?>
  <?php linea(35, 'La linea que hace que <code>build-docker</code> espere a que terminen <b>bien</b> los jobs <code>test-backend</code> y <code>test-frontend</code>.', 'needs: ...'); ?>
  <?php linea(33, 'El <b>primer step</b> de practicamente cualquier job: descargar el codigo fuente del repositorio.', 'uses: ...'); ?>

  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Acciones del Marketplace que hay que saberse</h2>

  <table class="datos">
    <tr><th>Para que</th><th>Accion (<code>uses:</code>)</th></tr>
    <tr><td>Descargar el codigo del repositorio</td>
        <td><?php hueco(13, 26); ?></td></tr>
    <tr><td>Instalar el JDK</td>
        <td><?php hueco(14, 26); ?></td></tr>
    <tr><td>Instalar Node.js</td>
        <td><?php hueco(15, 26); ?></td></tr>
    <tr><td>Subir un binario para otro job</td>
        <td><?php hueco(16, 30); ?></td></tr>
    <tr><td>Bajarlo en el job siguiente</td>
        <td><?php hueco(17, 32); ?></td></tr>
  </table>

  <h3>Los parametros (<code>with:</code>) del taller</h3>
  <table class="datos">
    <tr><th>Accion</th><th>Parametros</th></tr>
    <tr><td><code>setup-java</code></td>
        <td><code>java-version: '<?php hueco(19, 6); ?>'</code>,
            <code>distribution: '<?php hueco(18, 12); ?>'</code>,
            <code>cache: '<?php hueco(21, 10); ?>'</code></td></tr>
    <tr><td><code>setup-node</code></td>
        <td><code>node-version: <?php hueco(20, 6); ?></code>,
            <code>cache: '<?php hueco(22, 8); ?>'</code></td></tr>
  </table>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. El pipeline de integracion continua (CI)</h2>

  <table class="datos">
    <tr><th>Fase backend (Spring Boot)</th><th>Fase frontend (React)</th></tr>
    <tr>
      <td>Configuracion del JDK con <code>actions/setup-java</code>.</td>
      <td>Instalacion determinista con <code>npm <?php hueco(25, 6); ?></code>.</td>
    </tr>
    <tr>
      <td>Ejecucion de pruebas unitarias y de integracion
          (<code>mvn test</code> / <code>gradle test</code>).</td>
      <td>Validacion de sintaxis y estilos con linters
          (<?php hueco(26, 10); ?>).</td>
    </tr>
    <tr>
      <td>Analisis <?php hueco(23, 12); ?> de codigo y reporte de
          <?php hueco(24, 12); ?> de pruebas.</td>
      <td>Pruebas unitarias de componentes con Jest o
          <?php hueco(27, 10); ?>.</td>
    </tr>
  </table>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Estrategia de despliegues condicionales</h2>

  <table class="datos">
    <tr><th>Validacion en Pull Requests</th><th>Despliegue continuo (CD)</th></tr>
    <tr>
      <td>Se activa ante <code>pull_request</code> hacia <code>develop</code> o
          <code>main</code>.</td>
      <td>Se activa <b>unicamente</b> tras el merge exitoso a <code>main</code> o
          <code><?php hueco(30, 14); ?></code>.</td>
    </tr>
    <tr>
      <td>Ejecuta compilacion y pruebas <b>sin realizar
          <?php hueco(28, 14); ?></b> en servidores.</td>
      <td>Construye las imagenes Docker optimizadas de la API y el frontend.</td>
    </tr>
    <tr>
      <td>Bloquea la integracion si alguna prueba unitaria
          <?php hueco(29, 10); ?>.</td>
      <td>Despliega los nuevos contenedores y valida la
          <?php hueco(31, 10); ?> del servicio.</td>
    </tr>
  </table>

  <div class="avisoflujo">
    <b>Principio clave.</b> <?php hueco(32, 14); ?> testing: detectar y corregir
    defectos en etapas <b>tempranas</b> mediante builds y tests automaticos en cada commit.
  </div>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('tercero.php', 'quinto.php');
