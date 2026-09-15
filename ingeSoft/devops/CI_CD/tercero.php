<?php
/* ==========================================================================
   IngeSoft5 / DevOps / CI_CD — bloque 03: Estrategias de Git y GitFlow
   Fuente: CI_CD.pdf — Seccion 03 (Modulo 3)
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- ramas permanentes --- */
    1  => ['produccion'],
    2  => ['etiquetados', 'etiquetadas'],
    3  => ['integracion'],

    /* --- ramas de soporte --- */
    4  => ['develop'],
    5  => ['estabilizacion'],
    6  => ['produccion'],
    7  => ['feature'],
    8  => ['release'],
    9  => ['hotfix'],

    /* --- semver --- */
    10 => ['incompatibles'],
    11 => ['retrocompatibles', 'retro compatibles'],
    12 => ['comportamiento'],
    13 => ['snapshot', '-snapshot'],
    14 => ['rc1', '-rc1'],
    15 => ['impacto'],

    /* --- semver aplicado --- */
    16 => ['1.4.3'],
    17 => ['1.5.0'],
    18 => ['2.0.0'],
    19 => ['2.0.0-rc1'],
    20 => ['1.5.0-snapshot'],

    /* --- commits convencionales --- */
    21 => ['feat'],
    22 => ['fix'],
    23 => ['refactor'],
    24 => ['ci'],
    25 => ['imperativo'],
    26 => ['pipeline'],
    27 => ['breaking change'],

    /* --- pull requests y calidad --- */
    28 => ['push'],
    29 => ['merge'],
    30 => ['revisor'],
    31 => ['squash and merge', 'squash'],
    32 => ['deuda'],
    33 => ['conocimiento'],
    34 => ['automatizada'],
];

$TEXTO = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En GitFlow, &iquest;de que rama nace una rama <code>feature/*</code> y a cual vuelve?',
        'opciones' => [
            'a' => 'Nace de <code>main</code> y vuelve a <code>main</code>',
            'b' => 'Nace de <code>develop</code> y vuelve a <code>develop</code>: <code>main</code> solo recibe releases estables y etiquetados',
            'c' => 'Nace de <code>release/*</code> y vuelve a <code>develop</code>',
            'd' => 'Nace de <code>develop</code> y vuelve a <code>main</code>'
        ],
        'correcta' => 'b',
        'porque'   => '<code>develop</code> es la <b>rama de integracion continua</b>: ahi convergen todas las funcionalidades terminadas y ahi es donde se descubren los conflictos entre ellas. <code>main</code> representa lo que esta corriendo en produccion <b>ahora mismo</b>; si metes features directo, ya no puedes saber que hay desplegado.'
    ],
    'm2' => [
        'texto'    => 'Produccion esta en <code>1.4.2</code> y hay un bug critico que tira el checkout. &iquest;De donde sale la rama de correccion?',
        'opciones' => [
            'a' => 'De <code>develop</code>, para que lleve tambien las features nuevas',
            'b' => 'Una rama <code>hotfix/*</code> desde <b><code>main</code></b>, porque hay que arreglar <b>exactamente</b> lo que esta en produccion sin arrastrar codigo a medio terminar',
            'c' => 'De la ultima <code>release/*</code>',
            'd' => 'Se parchea directamente sobre <code>main</code> sin rama'
        ],
        'correcta' => 'b',
        'porque'   => 'Esa es toda la razon de ser de <code>hotfix</code>: si ramificas de <code>develop</code>, al desplegar te llevas features sin probar a produccion. Y despues el hotfix se mergea en <b>los dos sitios</b>: a <code>main</code> (para publicar la <code>1.4.3</code>) y de vuelta a <code>develop</code> (para que la correccion no se pierda en la siguiente release).'
    ],
    'm3' => [
        'texto'    => 'Cambias el campo <code>precio</code> de la respuesta del API por <code>price</code>. Vienes de la version <code>1.4.2</code>. &iquest;Que numero publicas?',
        'opciones' => [
            'a' => '<code>1.4.3</code>, porque es un cambio pequeño',
            'b' => '<code>2.0.0</code>: rompes el contrato del API, y en SemVer eso es un cambio <b>MAJOR</b> aunque hayas tocado una sola linea',
            'c' => '<code>1.5.0</code>, porque es una mejora',
            'd' => '<code>1.4.2-RC1</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'SemVer no mide el <b>esfuerzo</b>, mide el <b>impacto en quien te consume</b>. Renombrar un campo es una linea de trabajo y un despliegue roto para todos los clientes. Esa es justo la promesa del contrato: si ves que subo de 1.x a 2.0, se que tengo que revisar mi codigo.'
    ],
    'm4' => [
        'texto'    => '&iquest;Para que sirve el sufijo <code>-SNAPSHOT</code>?',
        'opciones' => [
            'a' => 'Para marcar una version ya publicada y congelada',
            'b' => 'Para marcar una version <b>en desarrollo, todavia inestable</b>, que puede cambiar su contenido sin cambiar de numero — por eso Maven la vuelve a descargar en cada build',
            'c' => 'Para indicar que se hizo una copia de seguridad',
            'd' => 'Es un sinonimo de <code>-RC1</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Distingue bien los dos sufijos: <code>-SNAPSHOT</code> es «esto se mueve» (rama <code>develop</code>); <code>-RC1</code> es «esto ya esta congelado y solo falta validarlo» (rama <code>release/*</code>). Una version final <b>nunca</b> lleva sufijo, y una vez publicada es <b>inmutable</b>.'
    ],
    'm5' => [
        'texto'    => 'Arreglas un bug sin cambiar el comportamiento visible ni añadir nada. &iquest;Que tipo de commit convencional usas?',
        'opciones' => [
            'a' => '<code>feat</code>',
            'b' => '<code>fix</code>: correccion de un fallo reportado. (<code>refactor</code> seria si mejoras la estructura <b>sin</b> arreglar ni añadir nada)',
            'c' => '<code>refactor</code>',
            'd' => '<code>chore</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'La distincion importa porque muchas herramientas <b>generan el changelog y el numero de version automaticamente</b> leyendo estos prefijos: <code>fix</code> sube el PATCH, <code>feat</code> sube el MINOR y un <code>BREAKING CHANGE</code> sube el MAJOR. Si etiquetas mal, versionas mal.'
    ],
    'm6' => [
        'texto'    => 'El estandar pide el encabezado del commit en <b>modo imperativo</b> («agrega el endpoint», no «agregado el endpoint»). &iquest;Por que?',
        'opciones' => [
            'a' => 'Por tradicion, no tiene efecto practico',
            'b' => 'Porque el mensaje describe <b>lo que el commit hace al aplicarse</b>: se lee como «este commit <i>agrega</i> el endpoint», igual que los mensajes que genera el propio Git (<code>Merge branch...</code>, <code>Revert...</code>)',
            'c' => 'Porque los linters rechazan los participios',
            'd' => 'Porque ocupa menos caracteres'
        ],
        'correcta' => 'b',
        'porque'   => 'Y la otra mitad de la regla, que suele olvidarse: el <b>encabezado</b> dice <i>que</i> cambia, pero el <b>cuerpo</b> debe explicar el <b>por que</b>. El <i>que</i> ya lo puedes ver en el diff; el <i>por que</i> se pierde para siempre si no lo escribes.'
    ],
    'm7' => [
        'texto'    => 'Activas <b>branch protection</b> en <code>main</code>. &iquest;Que impide exactamente?',
        'opciones' => [
            'a' => 'Que se pueda clonar el repositorio',
            'b' => 'El <b>push directo</b>: todo cambio tiene que entrar por un Pull Request que pase el pipeline de CI y tenga al menos una aprobacion',
            'c' => 'Que se creen ramas nuevas',
            'd' => 'Que se hagan tags'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin proteccion, las reglas del equipo son una <b>convencion social</b> que alguien se salta a las 2 de la mañana. Con proteccion son una <b>restriccion tecnica</b>. Es lo que convierte «deberiamos correr las pruebas» en «no se puede mergear sin que pasen».'
    ],
    'm8' => [
        'texto'    => '&iquest;Que ventaja tiene <b>Squash and Merge</b> frente a un merge normal?',
        'opciones' => [
            'a' => 'Es mas rapido de ejecutar',
            'b' => 'Colapsa los 30 commits de trabajo de la rama («wip», «arreglo typo», «ahora si») en <b>un solo commit</b> con el mensaje del PR: el historial de <code>main</code> queda limpio y lineal, y cada commit corresponde a una funcionalidad completa',
            'c' => 'Conserva todos los commits individuales para auditoria',
            'd' => 'Evita los conflictos de merge'
        ],
        'correcta' => 'b',
        'porque'   => 'La contrapartida honesta: <b>pierdes</b> el detalle de los commits intermedios, y un <code>git bisect</code> te llevara a un commit grande en vez de a uno pequeño. Por eso muchos equipos hacen squash hacia <code>main</code> pero conservan el historial dentro de la rama de feature.'
    ],
    'm9' => [
        'texto'    => 'El PDF llama al Pull Request «punto focal de <b>transferencia de conocimiento</b>». Mas alla de encontrar bugs, &iquest;que significa eso?',
        'opciones' => [
            'a' => 'Que el autor le explica el codigo al revisor por chat',
            'b' => 'Que el code review reparte el conocimiento del sistema por el equipo: al menos <b>dos personas</b> entienden cada cambio, lo que reduce el riesgo de que una sola persona sea dueña exclusiva de una parte del codigo',
            'c' => 'Que se documenta automaticamente el codigo',
            'd' => 'Que se genera un informe para el profesor'
        ],
        'correcta' => 'b',
        'porque'   => 'Los tres efectos que nombra el PDF son <b>deteccion temprana de deuda tecnica</b>, <b>colaboracion tecnica</b> y <b>transferencia de conocimiento</b>. El ultimo es el que la gente subestima: es tu seguro contra el «eso solo lo entiende Juan, y Juan se fue».'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('CI/CD · 3 — Estrategias de Git y GitFlow', 'CI_CD.pdf — Modulo 3: ramas, SemVer, commits convencionales y code review');
?>

<div class="card">
  <h2>1. Estructura de ramas en GitFlow</h2>

  <h3>Ramas permanentes</h3>
  <table class="datos">
    <tr><th>Rama</th><th>Que representa</th></tr>
    <tr><td><code>main</code> / <code>master</code></td>
        <td>el estado en <?php hueco(1, 14); ?>. Contiene <b>solo</b> releases
            estables y <?php hueco(2, 14); ?>.</td></tr>
    <tr><td><code>develop</code></td>
        <td>rama de <?php hueco(3, 14); ?> continua donde convergen las nuevas
            funcionalidades terminadas.</td></tr>
  </table>

  <h3>Ramas de soporte temporal</h3>
  <table class="datos">
    <tr><th>Rama</th><th>Para que</th></tr>
    <tr><td><code><?php hueco(7, 12); ?>/*</code></td>
        <td>desarrollos individuales nacidos de <code><?php hueco(4, 12); ?></code></td></tr>
    <tr><td><code><?php hueco(8, 12); ?>/*</code></td>
        <td>preparacion y <?php hueco(5, 16); ?> de versiones</td></tr>
    <tr><td><code><?php hueco(9, 12); ?>/*</code></td>
        <td>correccion urgente de bugs criticos en <?php hueco(6, 14); ?></td></tr>
  </table>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Versionado semantico (SemVer 2.0.0)</h2>

  <table class="datos">
    <tr><th>Posicion</th><th>Cuando se incrementa</th></tr>
    <tr><td><b>MAJOR</b> (X.0.0)</td>
        <td>cambios <?php hueco(10, 16); ?> que rompen contratos de API o
            modelos de datos</td></tr>
    <tr><td><b>MINOR</b> (1.X.0)</td>
        <td>incorporacion de nuevas funcionalidades <?php hueco(11, 18); ?></td></tr>
    <tr><td><b>PATCH</b> (1.0.X)</td>
        <td>correccion de errores y bugs sin alterar el
            <?php hueco(12, 16); ?> general</td></tr>
    <tr><td><b>Sufijos</b></td>
        <td><code>-<?php hueco(13, 12); ?></code> para ramas de desarrollo y
            <code>-<?php hueco(14, 8); ?></code> para candidatos a release</td></tr>
  </table>

  <div class="avisoflujo">
    <b>Contrato de versiones.</b> SemVer permite a los clientes y consumidores de un API
    predecir el <?php hueco(15, 12); ?> de actualizar una dependencia o servicio.
  </div>

  <h3>Aplicalo: vienes de la version <code>1.4.2</code></h3>
  <table class="datos">
    <tr><th>Que hiciste</th><th>Nueva version</th></tr>
    <tr><td>Corriges un <code>NullPointerException</code> al listar productos.</td>
        <td><?php hueco(16, 10); ?></td></tr>
    <tr><td>Añades el endpoint <code>GET /api/products/search</code>, sin tocar los existentes.</td>
        <td><?php hueco(17, 10); ?></td></tr>
    <tr><td>Eliminas el campo <code>stock</code> de la respuesta del API.</td>
        <td><?php hueco(18, 10); ?></td></tr>
    <tr><td>Ese cambio grande ya esta congelado en <code>release/2.0.0</code> y se manda a QA.</td>
        <td><?php hueco(19, 14); ?></td></tr>
    <tr><td>Mientras tanto, en <code>develop</code> se sigue trabajando hacia el 1.5.0.</td>
        <td><?php hueco(20, 18); ?></td></tr>
  </table>

  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Commits convencionales y trazabilidad</h2>

  <table class="datos">
    <tr><th>Tipo</th><th>Cuando</th></tr>
    <tr><td><code><?php hueco(21, 10); ?>:</code></td>
        <td>nueva funcionalidad en backend o frontend</td></tr>
    <tr><td><code><?php hueco(22, 10); ?>:</code></td>
        <td>correccion de un fallo o error reportado</td></tr>
    <tr><td><code><?php hueco(23, 12); ?>:</code></td>
        <td>mejora estructural del codigo <b>sin cambiar comportamiento</b></td></tr>
    <tr><td><code><?php hueco(24, 8); ?></code> / <code>docs</code> / <code>test</code></td>
        <td>tareas de soporte y <?php hueco(26, 12); ?></td></tr>
  </table>

  <h3>Estructura del mensaje</h3>
  <ul>
    <li>Encabezado conciso en modo <?php hueco(25, 14); ?>, con alcance opcional
        — p. ej. <code>feat(backend): agregar busqueda de productos</code>.</li>
    <li>Cuerpo descriptivo explicando el <b>por que</b> del cambio, no el que.</li>
    <li>Referencias a tickets, issues o cambios disruptivos
        (<code><?php hueco(27, 20); ?></code>).</li>
  </ul>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Control de calidad: Pull Requests y code review</h2>

  <ul>
    <li><b>Proteccion de ramas:</b> restringir el <?php hueco(28, 10); ?>
        directo a <code>main</code> y <code>develop</code>.</li>
    <li><b>Pruebas automatizadas:</b> ejecucion <b>obligatoria</b> del pipeline de CI
        antes de autorizar el <?php hueco(29, 10); ?>.</li>
    <li><b>Revision por pares:</b> aprobacion requerida de al menos un
        <?php hueco(30, 12); ?> del equipo.</li>
    <li><b>Estrategia de merge:</b> uso de <?php hueco(31, 20); ?> para
        mantener un historial limpio y lineal.</li>
  </ul>

  <div class="avisoflujo">
    <b>Cultura de calidad.</b> El Pull Request es el punto focal de colaboracion tecnica,
    deteccion temprana de <?php hueco(32, 10); ?> tecnica y transferencia de
    <?php hueco(33, 14); ?>.
  </div>

  <div class="nota">
    <b>Integridad del codigo.</b> &laquo;Ningun cambio ingresa a las ramas principales sin
    validacion <?php hueco(34, 16); ?> de pruebas y revision de codigo.&raquo;
  </div>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('segundo.php', 'cuarto.php');
