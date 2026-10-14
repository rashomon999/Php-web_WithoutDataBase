<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Empaquetamiento — bloque 04: Repositorios de
   artefactos (Nexus, Docker/OCI Registry, manifiestos, seguridad).
   Fuente: empaquetamiento_artefactos_inmutabilidad.pdf — Sección 03
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- por que git no --- */
    1  => ['linea a linea', 'diferencias'],
    2  => ['blob', 'blob completo'],
    3  => ['git bloat', 'bloat'],
    4  => ['historial'],
    5  => ['binarios'],
    6  => ['metadatos'],
    7  => ['checksums'],
    8  => ['docker v2', 'docker v2 registry api', 'v2'],
    9  => ['retencion', 'purga', 'retencion y purga'],
    10 => ['maven rest', 'maven'],

    /* --- topologia: hosted / proxy / group --- */
    11 => ['3', 'tres'],
    12 => ['hosted', 'hosted repository'],
    13 => ['proxy', 'proxy repository'],
    14 => ['group', 'group repository'],
    15 => ['releases'],
    16 => ['1.0.0'],
    17 => ['snapshots'],
    18 => ['rbac'],
    19 => ['tokens'],
    20 => ['maven central'],
    21 => ['npmjs'],
    22 => ['pypi'],
    23 => ['docker hub'],
    24 => ['velocidad', 'velocidad lan', 'lan'],
    25 => ['resiliencia'],
    26 => ['ahorro'],
    27 => ['una sola url', 'url', 'unica url'],
    28 => ['settings.xml'],
    29 => ['.npmrc', 'npmrc'],
    30 => ['hosted', 'hosted interno'],

    /* --- flujo con nexus --- */
    31 => ['mvn package', 'package'],
    32 => ['mvn deploy', 'deploy'],
    33 => ['desacople', 'desacople total'],
    34 => ['ci', 'pipeline de ci', 'pipeline'],
    35 => ['unico', 'punto de deposito unico'],
    36 => ['gobernanza', 'gobernanza y auditoria'],
    37 => ['sha-256', 'sha256'],
    38 => ['pre-empaquetado', 'preempaquetado'],
    39 => ['clonan', 'clonan git'],

    /* --- nexus --- */
    40 => ['multiformato', 'soporte multiformato universal'],
    41 => ['helm'],
    42 => ['raw'],
    43 => ['air-gapped', 'air gapped', 'airgapped'],
    44 => ['cleanup policies', 'cleanup'],
    45 => ['firewall', 'firewall integrado'],
    46 => ['licencias'],
    47 => ['fideicomiso'],

    /* --- registros OCI --- */
    48 => ['oci distribution spec', 'distribution spec'],
    49 => ['http'],
    50 => ['content-addressable storage', 'content addressable storage', 'content-addressable'],
    51 => ['tar.gz', 'targz'],
    52 => ['sha-256', 'sha256'],
    53 => ['deduplicacion', 'deduplicacion masiva'],
    54 => ['50'],
    55 => ['alpine:3.19', 'alpine 3.19'],
    56 => ['delta', 'capa de aplicacion'],
    57 => ['docker build', 'build'],
    58 => ['docker push', 'push'],
    59 => ['docker pull', 'pull'],
    60 => ['efimero', 'entorno efimero'],
    61 => ['manifiestos', 'manifests'],
    62 => ['concurrentemente', 'en paralelo'],

    /* --- manifiesto --- */
    63 => ['schemaversion'],
    64 => ['mediatype'],
    65 => ['config'],
    66 => ['layers', 'capas'],
    67 => ['image index', 'index'],
    68 => ['2'],
    69 => ['unionfs', 'union fs', 'overlayfs'],
    70 => ['mismo digest', 'digest'],
    71 => ['application/vnd.oci.image.manifest.v1+json'],
    72 => ['multi-arch', 'multi arch', 'multiarquitectura'],

    /* --- registry vs nexus --- */
    73 => ['coexisten', 'no son mutuamente excluyentes'],
    74 => ['runtime', 'despliegue'],
    75 => ['construccion', 'construccion y entrega'],
    76 => ['harbor'],
    77 => ['cncf', 'cncf graduated'],
    78 => ['trivy'],
    79 => ['cosign'],
    80 => ['ecr', 'aws ecr'],
    81 => ['ghcr.io', 'ghcr'],
    82 => ['artifactory', 'jfrog artifactory'],
    83 => ['soberania', 'soberania de datos'],

    /* --- seguridad --- */
    84 => ['minimo privilegio', 'privilegio minimo'],
    85 => ['push', 'write', 'write/push'],
    86 => ['imagepullsecrets', 'image pull secrets'],
    87 => ['read-only', 'solo lectura', 'read only', 'lectura'],
    88 => ['politicas de admision', 'admision'],
    89 => ['kyverno'],
    90 => ['zero-trust', 'zero trust'],
    91 => ['firmadas', 'no firmadas'],
    93 => ['Resiliencia'],
    94 => ['config'],
    95 => ['layers'],
    96 => ['deduplicación'],

    /* --- lineas --- */
    92 => 'docker push cicd:9080/app:1.0.0',
];

$TEXTO = [];
for ($i = 1; $i <= 91; $i++) $TEXTO[] = $i;
$TEXTO[] = 93;
$TEXTO[] = 94;
$TEXTO[] = 95;
$TEXTO[] = 96;

$MULTIPLE = [
    'm8' => [
        'texto'    => 'En el flujo Git → CI → Nexus → Deploy, ¿quién es el <b>único actor autorizado</b> para publicar (deploy) en Nexus?',
        'opciones' => [
            'a' => 'Cualquier desarrollador',
            'b' => 'El equipo de QA',
            'c' => 'El <b>pipeline de CI</b>',
            'd' => 'El servidor de producción'
        ],
        'correcta' => 'c',
        'porque'   => 'Punto de depósito único: garantiza que todo binario pasó por build y pruebas.'
    ],
    'm9' => [
        'texto'    => '“Desacople total” en el flujo de Nexus significa que…',
        'opciones' => [
            'a' => 'Nexus no usa red',
            'b' => 'Los servidores de destino <b>nunca compilan código fuente ni clonan Git</b>',
            'c' => 'El CI está separado de Git',
            'd' => 'Los equipos no se comunican'
        ],
        'correcta' => 'b',
        'porque'   => 'Solo descargan el artefacto pre-empaquetado desde Nexus.'
    ],
    'm10' => [
        'texto'    => '¿Qué registra Nexus para gobernanza y auditoría?',
        'opciones' => [
            'a' => 'Solo el nombre del archivo',
            'b' => 'Solo la IP del cliente',
            'c' => 'Fecha, autor, pipeline de origen y hash SHA-256',
            'd' => 'El código fuente'
        ],
        'correcta' => 'c',
        'porque'   => 'Auditoría + trazabilidad del binario.'
    ],
    'm11' => [
        'texto'    => '¿Cuál es una capacidad de <b>Sonatype Nexus</b> mencionada?',
        'opciones' => [
            'a' => 'Solo gestiona imágenes Docker',
            'b' => 'Multiformato: Maven, npm, Docker/OCI, PyPI, NuGet, Helm, RubyGems y Raw; operación <b>air-gapped</b>; Cleanup Policies; Firewall integrado',
            'c' => 'Compila el código',
            'd' => 'Ejecuta contenedores'
        ],
        'correcta' => 'b',
        'porque'   => 'El Firewall bloquea open-source con vulnerabilidades críticas o licencias prohibidas.'
    ],
    'm12' => [
        'texto'    => '¿Qué son las <b>Cleanup Policies</b>?',
        'opciones' => [
            'a' => 'Reglas de RBAC',
            'b' => 'Reglas para firmar imágenes',
            'c' => 'Reglas automáticas para borrar snapshots antiguos o imágenes Docker en desuso y no saturar el disco',
            'd' => 'Reglas de linter'
        ],
        'correcta' => 'c',
        'porque'   => 'Mantienen el disco bajo control sin borrar a mano.'
    ],
    'm13' => [
        'texto'    => '“Aislamiento air-gapped” significa…',
        'opciones' => [
            'a' => 'Operar pipelines de CI/CD en redes corporativas cerradas <b>sin salida directa a Internet</b>',
            'b' => 'Usar WiFi',
            'c' => 'Cifrar todo el tráfico',
            'd' => 'Ejecutar sin contenedores'
        ],
        'correcta' => 'a',
        'porque'   => 'El Proxy/Hosted de Nexus sirve todo lo necesario dentro de la red cerrada.'
    ],
    'm14' => [
        'texto'    => '¿Cómo funciona el <b>almacenamiento direccionable por contenido</b> de un OCI Registry?',
        'opciones' => [
            'a' => 'Cada capa (tar.gz) se indexa por su <b>SHA-256</b>',
            'b' => 'Cada capa se indexa por su nombre',
            'c' => 'Cada imagen por su fecha',
            'd' => 'Por el usuario que la subió'
        ],
        'correcta' => 'a',
        'porque'   => 'Content-Addressable Storage: el nombre de la capa ES su hash.'
    ],
    'm15' => [
        'texto'    => 'Si <b>50 microservicios</b> usan <code>alpine:3.19</code>, ¿cuántas veces se almacena/transfiere esa capa?',
        'opciones' => [
            'a' => '50 veces',
            'b' => 'Una vez (<b>deduplicación masiva</b>)',
            'c' => '25 veces',
            'd' => 'Depende de la región'
        ],
        'correcta' => 'b',
        'porque'   => 'Si un host ya tiene las capas base, el pull solo descarga la capa de aplicación faltante.'
    ],
    'm16' => [
        'texto'    => 'En el flujo de distribución, ¿qué hace <code>docker push</code> desde el runner?',
        'opciones' => [
            'a' => 'Envía la imagen completa siempre',
            'b' => 'Envía únicamente las capas que <b>no existan</b> previamente en el Registry',
            'c' => 'Descarga las capas',
            'd' => 'Compila el Dockerfile'
        ],
        'correcta' => 'b',
        'porque'   => 'docker build (en el runner efímero) → docker push (solo lo nuevo) → Registry (manifiestos + blobs deduplicados) → docker pull (concurrente en los nodos).'
    ],
    'm17' => [
        'texto'    => '¿Cuál es el orden correcto de comandos en el pipeline de contenedorización OCI?',
        'opciones' => [
            'a' => 'docker pull → docker build → docker push',
            'b' => 'docker push → docker build → docker pull',
            'c' => 'docker build → docker push → docker pull',
            'd' => 'docker build → docker pull → docker push'
        ],
        'correcta' => 'c',
        'porque'   => 'Dockerfile → build (imagen con capas) → push (Registry) → pull (servidor / clúster K8s).'
    ],
    'm18' => [
        'texto'    => '¿Qué es un <b>manifiesto de imagen OCI</b>?',
        'opciones' => [
            'a' => 'Un documento JSON que actúa como <b>receta de capas</b> de la imagen',
            'b' => 'El Dockerfile',
            'c' => 'La firma de la imagen',
            'd' => 'Un archivo de logs'
        ],
        'correcta' => 'a',
        'porque'   => 'Contiene schemaVersion, mediaType, config y layers.'
    ],
    'm19' => [
        'texto'    => 'En el manifiesto, ¿qué describe <code>config</code> y qué describe <code>layers</code>?',
        'opciones' => [
            'a' => '<code>config</code>: sistema de archivos; <code>layers</code>: variables de entorno',
            'b' => 'Ambos describen la CPU',
            'c' => '<code>config</code>: descriptor que apunta al blob JSON con ENV, puertos, entrypoint y arquitectura CPU (<b>cómo se ejecuta</b>); <code>layers</code>: lista ordenada de capas tar.gz con su SHA-256 (<b>el sistema de archivos superpuesto, UnionFS</b>)',
            'd' => 'No describen nada'
        ],
        'correcta' => 'c',
        'porque'   => 'Si dos imágenes comparten una capa, apuntan al mismo digest SHA-256 (deduplicación).'
    ],
    'm20' => [
        'texto'    => '¿Para qué sirve un <b>Image Index (multi-arch)</b>?',
        'opciones' => [
            'a' => 'Para indexar los logs',
            'b' => 'Para firmar imágenes',
            'c' => 'Para versionar en SemVer',
            'd' => 'Es un manifiesto padre que agrupa varias arquitecturas bajo la <b>misma etiqueta</b>'
        ],
        'correcta' => 'd',
        'porque'   => 'Así <code>app:1.0.0</code> sirve amd64 y arm64 con la misma etiqueta.'
    ],
    'm21' => [
        'texto'    => 'Valor de <code>schemaVersion</code> y <code>mediaType</code> del manifiesto de ejemplo del PDF:',
        'opciones' => [
            'a' => '<code>1</code> y <code>text/plain</code>',
            'b' => '<code>2</code> y <code>application/vnd.oci.image.manifest.v1+json</code>',
            'c' => '<code>3</code> y <code>application/json</code>',
            'd' => '<code>2</code> y <code>application/xml</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Y el <code>config.mediaType</code> es <code>application/vnd.oci.image.config.v1+json</code>; cada capa: <code>…layer.v1.tar+gzip</code>.'
    ],
    'm22' => [
        'texto'    => 'Comparativa de <b>alcance</b>: Docker/OCI Registry vs. Nexus.',
        'opciones' => [
            'a' => 'Registry: multiformato; Nexus: solo imágenes',
            'b' => 'Registry: especializado en imágenes de contenedores; Nexus: <b>multiformato universal</b> (Maven, npm, PyPI, NuGet, Helm, Docker, Raw)',
            'c' => 'Son idénticos',
            'd' => 'Registry: solo Maven; Nexus: solo npm'
        ],
        'correcta' => 'b',
        'porque'   => 'Ubicación en el ciclo: Registry = despliegue y runtime (K8s, ECS, Docker Engine); Nexus = construcción y entrega (dependencias y releases).'
    ],
    'm23' => [
        'texto'    => '¿Compiten Nexus y un Docker Registry?',
        'opciones' => [
            'a' => 'Sí, hay que elegir uno',
            'b' => 'Nexus reemplaza siempre al Registry',
            'c' => 'El Registry reemplaza siempre a Nexus',
            'd' => 'No: <b>coexisten</b>. Nexus provee las librerías al build y el Registry sirve las imágenes a producción'
        ],
        'correcta' => 'd',
        'porque'   => 'Es la conclusión de arquitectura de la comparativa.'
    ],
    'm24' => [
        'texto'    => '¿Cuál es una solución <b>self-hosted</b> con escaneo Trivy integrado, firma con Cosign, cuotas y replicación entre sedes?',
        'opciones' => [
            'a' => 'AWS ECR',
            'b' => 'GHCR',
            'c' => 'Harbor (CNCF Graduated)',
            'd' => 'Azure ACR'
        ],
        'correcta' => 'c',
        'porque'   => 'Self-hosted: Harbor, Nexus, Artifactory. Nube: AWS ECR, ghcr.io, Google Artifact Registry, Azure ACR.'
    ],
    'm25' => [
        'texto'    => '¿Cuándo conviene <b>self-hosted</b> y cuándo un servicio gestionado en la nube?',
        'opciones' => [
            'a' => 'Self-hosted: soberanía de datos estricta (bancos, telecom); nube: equipos cloud-native que quieren eliminar la sobrecarga de operar y respaldar servidores',
            'b' => 'Self-hosted para startups; nube para bancos',
            'c' => 'Siempre nube',
            'd' => 'Siempre self-hosted'
        ],
        'correcta' => 'a',
        'porque'   => 'ECR: integración nativa con IAM, ECS, EKS. GHCR: integración natural con GitHub Actions.'
    ],
    'm26' => [
        'texto'    => '¿Qué permisos deben tener los <b>runners de CI</b> y los <b>clústeres de cómputo</b> respectivamente?',
        'opciones' => [
            'a' => 'Ambos: admin',
            'b' => 'Runners: tokens temporales solo write/push; clústeres (ImagePullSecrets): solo <b>lectura (read-only)</b>',
            'c' => 'Runners: read-only; clústeres: write',
            'd' => 'Ambos: sin credenciales'
        ],
        'correcta' => 'b',
        'porque'   => 'Mínimo privilegio. El registro es una frontera de seguridad crítica (Zero-Trust Registry).'
    ],
    'm27' => [
        'texto'    => 'Una <b>política de admisión</b> de Kubernetes sirve para…',
        'opciones' => [
            'a' => 'Rechazar pods de registros públicos no autorizados (p. ej. un Docker Hub personal)',
            'b' => 'Acelerar el pull',
            'c' => 'Compilar imágenes',
            'd' => 'Crear tokens'
        ],
        'correcta' => 'a',
        'porque'   => 'Además, Kyverno o Cosign Gatekeeper bloquean el despliegue si la imagen no está firmada por el CI.'
    ],
    'm28' => [
        'texto'    => '“Zero-Trust Registry” quiere decir…',
        'opciones' => [
            'a' => 'No usar registros',
            'b' => 'Todo el mundo puede publicar',
            'c' => 'Ningún binario entra sin validación del pipeline y ningún nodo corre imágenes no firmadas',
            'd' => 'Solo se acepta latest'
        ],
        'correcta' => 'c',
        'porque'   => 'El registro es una frontera de seguridad crítica.'
    ],
];

$MULTIPLE = [];
iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Empaquetamiento · 4 — Repositorios de artefactos', 'empaquetamiento_artefactos_inmutabilidad.pdf — Sección 03: Nexus, Docker/OCI Registry, manifiestos, seguridad');
?>

<div class="card">
  <h2>1. ¿Por qué Git NO es un repositorio de artefactos?</h2>
  <table class="datos">
    <tr><th>El Diseño de Git</th><th>El Diseño de un Artifact Manager</th></tr>
    <tr><td>Diseñado para comparar y almacenar diferencias <?php hueco(1, 12); ?> en texto plano.</td>
        <td>Diseñado específicamente para almacenar y servir archivos <?php hueco(5, 10); ?> pesados.</td></tr>
    <tr><td>Cada versión de un binario (JAR de 50MB o imagen de 300MB) se almacena como un <?php hueco(2, 6); ?> completo indivisible.</td>
        <td>Indexación por <?php hueco(6, 10); ?> (SemVer, <?php hueco(7, 10); ?>, dependencias, arquitecturas CPU).</td></tr>
    <tr><td><b><?php hueco(3, 10); ?>:</b> Clonar el repositorio descarga todo el <?php hueco(4, 10); ?> de binarios pasados, haciendo el clon inviable.</td>
        <td>Soporta protocolos nativos (<?php hueco(10, 10); ?>, npm registry, <?php hueco(8, 10); ?> Registry API).</td></tr>
    <tr><td></td><td>Políticas de <?php hueco(9, 16); ?> y purga automática de versiones obsoletas.</td></tr>
  </table>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. Topología de un gestor de artefactos (Nexus / Artifactory)</h2>
    <p class="repo-types-intro">Los gestores empresariales implementan una arquitectura de <?php hueco(11, 3); ?> tipos de repositorios fundamentales:</p>
    <div class="repo-types-grid">
        <section class="repo-type-card repo-hosted">
            <h3 class="repo-type-head">1. <?php hueco(12, 8); ?> Repository</h3>
            <div class="repo-type-body">
                <ul>
                    <li><b>Propósito:</b> Almacén interno privado de artefactos propios.</li>
                    <li><b>Separación de ciclos:</b>
                        <ul>
                            <li><i><?php hueco(15, 10); ?>:</i> Inmutables (<code><?php hueco(16, 6); ?></code> nunca se sobrescribe).</li>
                            <li><i><?php hueco(17, 10); ?>:</i> Versiones temporales en desarrollo.</li>
                        </ul>
                    </li>
                    <li><b>Seguridad:</b> <?php hueco(19, 8); ?> y roles <?php hueco(18, 6); ?>.</li>
                </ul>
            </div>
        </section>

        <section class="repo-type-card repo-proxy">
            <h3 class="repo-type-head">2. <?php hueco(13, 8); ?> Repository</h3>
            <div class="repo-type-body">
                <ul>
                    <li><b>Propósito:</b> Caché intermediaria de repositorios públicos (<?php hueco(20, 14); ?>, <?php hueco(21, 6); ?>, <?php hueco(22, 6); ?>, <?php hueco(23, 12); ?>).</li>
                    <li><b>Beneficios:</b>
                        <ul>
                            <li><b><?php hueco(24, 10); ?>:</b> Descargas a velocidad LAN.</li>
                            <li><b><?php hueco(25, 12); ?>:</b> Si npm/Hub cae, CI no se detiene.</li>
                            <li><b><?php hueco(26, 8); ?>:</b> Menor consumo de red externa.</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </section>

        <section class="repo-type-card repo-group">
            <h3 class="repo-type-head">3. <?php hueco(14, 8); ?> Repository</h3>
            <div class="repo-type-body">
                <ul>
                    <li><b>Propósito:</b> Punto de entrada unificado que combina Hosted y Proxy bajo <?php hueco(27, 12); ?>.</li>
                    <li><b>Simplicidad:</b> Una única URL en <code><?php hueco(28, 12); ?></code> o <code><?php hueco(29, 8); ?></code>.</li>
                    <li><b>Prioridad:</b> Busca primero en <?php hueco(30, 8); ?> interno, luego en Proxy público.</li>
                </ul>
            </div>
        </section>
    </div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Flujo de integración y entrega con Sonatype Nexus</h2>
    <div class="nexus-flow-layout">
        <section class="nexus-cycle">
            <h3>Ciclo de Vida del Artefacto en Nexus</h3>
            <div class="nexus-cycle-body">
                <div class="nexus-stage">Git (Código Fuente)</div>
                <div class="nexus-transition"><span>↓</span></div>
                <div class="nexus-stage">CI Pipeline (GitHub Actions / Jenkins)</div>
                <div class="nexus-transition"><span>↓</span></div>
                <div class="nexus-stage">Build &amp; Test (<code><?php hueco(31, 12); ?></code>)</div>
                <div class="nexus-transition"><span>↓</span><small><?php hueco(32, 12); ?></small></div>
                <div class="nexus-stage nexus-stage-hub">Sonatype Nexus</div>
                <div class="nexus-transition"><span>↓</span><small>descarga inmutable</small></div>
                <div class="nexus-stage">Deploy / Release (Staging / Prod)</div>
            </div>
        </section>
        <section class="nexus-aspects">
            <h3>Aspectos Clave del Flujo</h3>
            <ul>
                <li><b><?php hueco(33, 10); ?> Total:</b> Los servidores de destino nunca compilan código fuente ni <?php hueco(39, 8); ?> Git.</li>
                <li><b>Punto de Depósito <?php hueco(35, 8); ?>:</b> El pipeline de <?php hueco(34, 4); ?> es el único actor autorizado para publicar (deploy) en Nexus.</li>
                <li><b><?php hueco(36, 10); ?> y Auditoría:</b> Nexus registra fecha, autor, pipeline de origen y hash <?php hueco(37, 8); ?>.</li>
                <li><b><?php hueco(93, 11); ?>:</b> El despliegue a producción solo requiere descargar el artefacto <?php hueco(38, 16); ?> desde Nexus.</li>
            </ul>
        </section>
    </div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Sonatype Nexus Repository Manager</h2>
    <p class="nexus-manager-intro">Estándar de la industria en gestión de binarios:</p>
    <div class="nexus-manager-layout">
        <ul class="nexus-manager-list">
            <li><b>Soporte <?php hueco(40, 14); ?> Universal:</b> Gestiona Maven, npm, Docker/OCI, PyPI, NuGet, <?php hueco(41, 6); ?>, RubyGems y archivos <?php hueco(42, 4); ?>.</li>
            <li><b>Aislamiento <?php hueco(43, 12); ?>:</b> Permite operar pipelines de CI/CD en redes corporativas cerradas sin salida directa a Internet.</li>
            <li><b><?php hueco(44, 16); ?>:</b> Reglas automáticas para borrar snapshots antiguos o imágenes Docker en desuso, evitando saturar el disco.</li>
            <li><b><?php hueco(45, 10); ?> Integrado:</b> Bloquea automáticamente paquetes open-source con vulnerabilidades críticas o <?php hueco(46, 10); ?> prohibidas.</li>
        </ul>
        <aside class="nexus-governance">
            <h3>Gobierno de Binarios</h3>
            <p>Nexus actúa como el <b><?php hueco(47, 12); ?></b> de la propiedad intelectual: todo binario desplegado o consumido está auditado, centralizado y catalogado.</p>
        </aside>
    </div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>5. Registros de contenedores y el estándar OCI</h2>
    <p class="oci-intro">¿Cómo funciona un Docker / OCI Registry?</p>
    <div class="oci-layout">
        <ul class="oci-lista">
            <li><b><?php hueco(48, 20); ?>:</b> Protocolo <?php hueco(49, 5); ?> API estandarizado para consultar, subir (push) y descargar (pull) imágenes.</li>
            <li><b><?php hueco(50, 26); ?>:</b> Cada capa de sistema de archivos es un archivo comprimido (<code><?php hueco(51, 8); ?></code>) indexado por su <?php hueco(52, 8); ?>.</li>
            <li><b><?php hueco(53, 14); ?> Masiva:</b> Si <?php hueco(54, 4); ?> microservicios usan <code><?php hueco(55, 12); ?></code>, los nodos y el registro solo almacenan y transfieren esa capa una vez.</li>
            <li><b>Descargas Eficientes:</b> Si un host ya tiene las capas base, el pull solo descarga la capa de aplicación faltante.</li>
        </ul>
        <aside class="oci-eficiencia">
            <h3>Eficiencia de Red</h3>
            <p>La arquitectura en capas del OCI Registry permite despliegues en segundos, transfiriendo únicamente el <?php hueco(56, 8); ?> modificado en vez de la imagen entera.</p>
        </aside>
    </div>
    <div class="oci-distribucion-layout">
        <section class="oci-pipeline">
            <h3>Pipeline de Contenedorización OCI</h3>
            <div class="oci-pipeline-body">
                <div class="oci-stage">Código Fuente</div>
                <div class="oci-stage-arrow">↓</div>
                <div class="oci-stage">Dockerfile (Receta de Capas)</div>
                <div class="oci-stage-arrow">↓</div>
                <div class="oci-stage oci-stage-action"><code><?php hueco(57, 14); ?></code></div>
                <div class="oci-stage-arrow">↓</div>
                <div class="oci-stage">Docker Image (Capas OCI)</div>
                <div class="oci-stage-arrow">↓</div>
                <div class="oci-stage oci-stage-action"><code><?php hueco(58, 14); ?></code></div>
                <div class="oci-stage-arrow">↓</div>
                <div class="oci-stage oci-stage-registry">Docker Registry</div>
                <div class="oci-stage-arrow">↓</div>
                <div class="oci-stage oci-stage-action"><code><?php hueco(59, 14); ?></code></div>
                <div class="oci-stage-arrow">↓</div>
                <div class="oci-stage">Servidor / Clúster K8s</div>
            </div>
        </section>
        <section class="oci-puntos">
            <h3>Puntos Críticos del Flujo</h3>
            <ul>
                <li><b>Construcción en el Runner:</b> <code>docker build</code> compila y ensambla capas en el entorno <?php hueco(60, 10); ?> del CI.</li>
                <li><b>Subida (<code>push</code>):</b> El runner envía únicamente las capas que no existan previamente en el Registry.</li>
                <li><b>Almacenamiento Central:</b> El Registry indexa <?php hueco(61, 12); ?> y almacena los blobs deduplicados.</li>
                <li><b>Descarga (<code>pull</code>):</b> Los nodos del clúster descargan <?php hueco(62, 16); ?> las capas para instanciar los contenedores en producción.</li>
            </ul>
        </section>
    </div>
  <?php linea(92, 'Sube la imagen <code>app</code> versión <code>1.0.0</code> al registro <code>cicd:9080</code> (formato del PDF de Jenkins).', 'docker push ...'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
    <h2>6. ¿Qué es un Manifiesto de Imagen OCI?</h2>
    <p class="manifest-intro">El <b>Manifest</b> (<code>manifest.json</code>) es el documento JSON que actúa como receta de capas de una imagen:</p>
    <div class="manifest-layout">
        <section class="manifest-panel manifest-components">
            <h3>Componentes Esenciales</h3>
            <div class="manifest-panel-body">
                <ul>
                    <li><code><?php hueco(63, 14); ?></code>: Versión formal de la especificación OCI / Docker v<?php hueco(68, 2); ?>.</li>
                    <li><code><?php hueco(64, 10); ?></code>: Tipo MIME del documento y formato de serialización. Ejemplo: <code><?php hueco(71, 44); ?></code>.</li>
                    <li><code><?php hueco(65, 8); ?></code>: Descriptor que apunta al blob JSON con ENV, puertos, entrypoint y CPU arch.</li>
                </ul>
            </div>
        </section>
        <section class="manifest-panel manifest-layers">
            <h3>Capas y Multi-Arquitectura</h3>
            <div class="manifest-panel-body">
                <ul>
                    <li><code><?php hueco(66, 8); ?></code>: Lista ordenada de capas tar.gz con su hash SHA-256 único;  .</li>
                    <li><b><?php hueco(67, 12); ?> (<?php hueco(72, 10); ?>):</b> Manifiesto padre que agrupa arquitecturas bajo la misma etiqueta.</li>
                </ul>
            </div>
        </section>
    </div>
  <?php enviar(); ?>
</div>

<div class="card">
    <h2>7. Estructura de un Manifiesto OCI: <code>manifest.json</code></h2>
    <div class="manifest-detail-layout">
        <section class="manifest-descriptor">
            <h3>Interpretación del Descriptor:</h3>
            <ul>
                <li><b><?php hueco(94, 8); ?>:</b> Define cómo se ejecuta el contenedor (CPU arch, ENV, CMD).</li>
                <li><b><?php hueco(95, 8); ?>:</b> Describen el sistema de archivos superpuesto (UnionFS).</li>
                <li><b><?php hueco(96, 16); ?>:</b> Si dos imágenes comparten una capa, apuntan al mismo digest SHA-256.</li>
            </ul>
        </section>
        <section class="manifest-json-panel">
            <h3><code>manifest.json</code> (Especificación OCI)</h3>
            <pre class="manifest-json"><code>{
    "schemaVersion": 2,
    "mediaType": "application/vnd.oci.image.manifest.v1+json",
    "config": {
        "mediaType": "application/vnd.oci.image.config.v1+json",
        "digest": "sha256:4b9a1f28bc...",
        "size": 7023
    },
    "layers": [
        {
            "mediaType": "application/...layer.v1.tar+gzip",
            "digest": "sha256:d4fc045c0b...",
            "size": 3260901
        },
        {
            "mediaType": "application/...layer.v1.tar+gzip",
            "digest": "sha256:1a82f34e89...",
            "size": 42105
        }
    ]
}</code></pre>
        </section>
    </div>
    <?php enviar(); ?>
</div>

<div class="card">
    <h2>8. Docker Registry vs. Sonatype Nexus: Comparativa</h2>
  <p class="registry-comparison-intro">Análisis de alcance, formato y convivencia en la arquitectura DevOps:</p>
  <table class="datos registry-comparison">
    <tr><th>Criterio</th><th>Docker / OCI Registry</th><th>Sonatype Nexus Repository</th></tr>
    <tr><td><b>Alcance de Formato</b></td>
        <td>Especializado en imágenes de contenedores OCI/Docker (capas, blobs y manifests).</td>
        <td><b>Multiformato universal:</b> Maven (JAR), npm, PyPI, NuGet, Helm, Docker, Raw.</td></tr>
    <tr><td><b>Ubicación en el Ciclo</b></td>
        <td>Fase de despliegue y <?php hueco(74, 8); ?> (consumido por Kubernetes, ECS, Docker Engine).</td>
        <td>Fase de <?php hueco(75, 12); ?> y entrega (resuelve dependencias y almacena releases).</td></tr>
    <tr><td><b>Almacenamiento</b></td>
        <td>Deduplicación estricta a nivel de capas de sistema de archivos por SHA-256.</td>
        <td>Almacenamiento organizado por ecosistemas de paquetes y árboles de coordenadas.</td></tr>
    <tr><td><b>Capacidad de Proxy</b></td>
        <td>Pull-through cache de Docker Hub (en implementaciones como Harbor o ECR).</td>
        <td>Proxy avanzado de Maven Central, npmjs, PyPI y Docker Hub con reglas de filtrado.</td></tr>
    <tr><td><b>Gobernanza / Firewall</b></td>
        <td>Escaneo de vulnerabilidades en imágenes (<?php hueco(78, 6); ?>, Clair, Notary/<?php hueco(79, 6); ?>).</td>
        <td>Políticas de licencias open-source, cuarentena de dependencias y auditoría SCA.</td></tr>
  </table>
  <div class="avisoflujo"><b>Conclusión de Arquitectura:</b> No son mutuamente excluyentes; <?php hueco(73, 12); ?>: Nexus provee las librerías al build, y el Registry sirve las imágenes a producción.</div>

    <h3 class="ecosistema-title">Ecosistema de Registros: Self-Hosted vs. Cloud</h3>
    <div class="ecosistema-layout">
        <section class="ecosistema-col ecosistema-selfhosted">
            <h3>Soluciones Self-Hosted / On-Premise</h3>
            <ul>
                <li><b><?php hueco(76, 8); ?> (<?php hueco(77, 6); ?> Graduated):</b> Registro open-source con escaneo Trivy integrado, firma con Cosign, cuotas y replicación entre sedes.</li>
                <li><b>Sonatype Nexus / JFrog <?php hueco(82, 12); ?>:</b> Repositorios multiformato con soporte nativo de Docker Registry.</li>
                <li><b>Caso de uso:</b> <?php hueco(83, 10); ?> de datos estricta, entornos bancarios o telecomunicaciones.</li>
            </ul>
        </section>
        <section class="ecosistema-col ecosistema-cloud">
            <h3>Servicios Gestionados en la Nube</h3>
            <ul>
                <li><b><?php hueco(80, 8); ?>:</b> Integración nativa con IAM, ECS y EKS; replicación geográfica y escaneo automático.</li>
                <li><b>GitHub Container Registry (<code><?php hueco(81, 8); ?></code>):</b> Integración natural con GitHub Actions y permisos de repo.</li>
                <li><b>Google Artifact Registry / Azure ACR.</b></li>
                <li><b>Caso de uso:</b> Equipos cloud-native que eliminan la sobrecarga de operar y respaldar servidores propios.</li>
            </ul>
        </section>
    </div>
  <?php enviar(); ?>
</div>

<div class="card">
        <h2>9. Seguridad en el Registro y Consumo en Kubernetes</h2>
    <p class="seguridad-intro">Mecanismos de control para distribución segura:</p>
    <div class="seguridad-layout">
        <ul class="seguridad-lista">
            <li><b><?php hueco(84, 18); ?>:</b> Runners de CI poseen tokens temporales con permisos exclusivos de <?php hueco(85, 10); ?>.</li>
            <li><b><?php hueco(86, 16); ?>:</b> Clústeres de cómputo solo poseen credenciales de lectura (<?php hueco(87, 10); ?>) para descargar imágenes autorizadas.</li>
            <li><b><?php hueco(88, 20); ?>:</b> Kubernetes rechaza pods de registros públicos no autorizados (Docker Hub personal).</li>
            <li><b>Verificación en Runtime:</b> <i><?php hueco(89, 8); ?></i> o Cosign Gatekeeper bloquean el despliegue si la imagen no está <?php hueco(91, 8); ?> por el CI.</li>
        </ul>
        <aside class="seguridad-zero-trust">
            <h3><?php hueco(90, 10); ?> Registry</h3>
            <p>El registro de artefactos es una frontera de seguridad crítica: ningún binario entra sin validación del pipeline, y ningún nodo corre imágenes no firmadas.</p>
        </aside>
    </div>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('tercero.php', 'quinto.php');
