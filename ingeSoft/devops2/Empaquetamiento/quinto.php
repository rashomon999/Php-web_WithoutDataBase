<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Empaquetamiento — bloque 05: Inmutabilidad en DevOps,
   12-Factor, left-pad, mascotas vs ganado, síntesis y debate.
   Fuente: empaquetamiento_artefactos_inmutabilidad.pdf — Secciones 04 y 05
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- regla de oro --- */
    1  => ['1', 'una', 'una sola vez', 'uno'],
    2  => ['build once, deploy to many environments', 'build once deploy to many environments', 'build once, deploy to many', 'build once deploy to many'],
    3  => ['exactamente el mismo', 'el mismo', 'identico'],
    4  => ['bit por bit', 'bit a bit'],
    5  => ['compilar', 'recompilar'],
    6  => ['segundos'],
    7  => ['variables del entorno', 'variables de entorno', 'configuracion'],

    /* --- recompilar por entorno --- */
    8  => ['build --env=qa', '--env=qa', 'env=qa'],
    9  => ['build --env=prod', '--env=prod', 'env=prod'],
    10 => ['parche', 'parche flotantes', 'versiones parche flotantes'],
    11 => ['flags', 'diferencias de flags'],
    12 => ['concurrencia'],
    13 => ['invalidez de pruebas', 'invalidez'],
    14 => ['qa'],

    /* --- 12 factor --- */
    15 => ['iii', '3', 'tres'],
    16 => ['configuracion'],
    17 => ['codigo'],
    18 => ['100', '100%'],
    19 => ['prueba del acido', 'acido'],
    20 => ['github publico'],
    21 => ['secretos'],
    22 => ['variables de entorno', 'variables de entorno de so'],
    23 => ['process.env', 'process env'],
    24 => ['system.getenv()', 'system.getenv', 'getenv'],
    25 => ['configmaps', 'configmaps de kubernetes'],
    26 => ['vault', 'hashicorp vault'],
    27 => ['aws secrets manager', 'secrets manager'],
    28 => ['rotacion', 'rotacion de llaves'],

    /* --- ciclo de promocion --- */
    29 => ['dev'],
    30 => ['humo', 'pruebas de humo'],
    31 => ['e2e', 'end-to-end'],
    32 => ['rendimiento', 'pruebas de rendimiento'],
    33 => ['aprobacion formal', 'aprobacion'],
    34 => ['mismo hash', 'el mismo hash'],
    35 => ['blue-green', 'blue green', 'bluegreen'],
    36 => ['canary'],
    37 => ['mocks'],
    38 => ['v1.4.0@sha256', 'v1.4.0'],
    39 => ['staging'],

    /* --- left-pad --- */
    40 => ['2016'],
    41 => ['left-pad', 'leftpad', 'left pad'],
    42 => ['11'],
    43 => ['npmjs'],
    44 => ['babel', 'react'],
    45 => ['segundos'],
    46 => ['disponibilidad', 'disponibilidad en vivo'],
    47 => ['proxies locales', 'proxy local', 'proxies', 'nexus'],
    48 => ['pre-construidos', 'preconstruidos', 'prebuilt', 'pre construidos'],

    /* --- mascotas vs ganado --- */
    49 => ['mascotas', 'pets'],
    50 => ['ganado', 'cattle'],
    51 => ['ssh'],
    52 => ['configuration drift', 'drift'],
    53 => ['efimeros', 'efimero'],
    54 => ['solo lectura', 'read-only', 'solo-lectura'],
    55 => ['git'],
    56 => ['reemplaza', 'reemplazar'],
    57 => ['destruir y recrear', 'destruir'],
    58 => ['anonimos'],

    /* --- comparativa mutable vs inmutable --- */
    59 => ['recompilacion'],
    60 => ['hardcodeada', 'hardcodeado'],
    61 => ['trivial'],
    62 => ['digest', 'digest sha-256', 'digest sha-256 anterior'],
    63 => ['difusa'],
    64 => ['exacta'],
    65 => ['mttr'],
    66 => ['horas'],
    67 => ['segundos'],

    /* --- sintesis y debate --- */
    68 => ['lockfiles'],
    69 => ['multi-stage', 'multi stage', 'multistage'],
    70 => ['semver'],
    71 => ['sbom', 'sboms'],
    72 => ['nexus'],
    73 => ['docker registries', 'registries', 'registry'],
    74 => ['industrializando el empaquetamiento', 'industrializar el empaquetamiento', 'industrializando'],
    75 => ['fija', 'version fija', 'fijar'],
    76 => ['latest'],
    77 => ['nginx'],

    /* --- lineas --- */
    78 => 'FROM node:20.11.1-alpine',
    79 => 'docker run -e DB_URL=$DB_URL mi-app:1.4.0',
    80 => ['compilar', 'recompilar'],
    81 => ['segundos'],
    82 => ['variables del entorno', 'variables de entorno'],
    83 => ['determinismo'],
    84 => ['binarios privados propios', 'artefactos privados propios'],
    85 => ['industrializando el empaquetamiento', 'industrializar el empaquetamiento', 'industrializando'],
];

$TEXTO = [];
for ($i = 1; $i <= 77; $i++) $TEXTO[] = $i;
$TEXTO = array_merge($TEXTO, [80,81,82,83,84,85]);

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Cuál es la “<b>regla de oro</b>” de DevOps según la sesión?',
        'opciones' => [
            'a' => 'Compilar una vez por cada entorno',
            'b' => 'Nunca usar contenedores',
            'c' => '<b>Build Once, Deploy to Many Environments</b>: el código se compila y empaqueta una única vez en el CI y el mismo artefacto se promueve a Pruebas, Staging y Producción',
            'd' => 'Desplegar solo los viernes'
        ],
        'correcta' => 'c',
        'porque'   => 'Una sola vez en todo el ciclo de entrega.'
    ],
    'm2' => [
        'texto'    => 'Promover a producción con “Build Once” implica que…',
        'opciones' => [
            'a' => 'Es una simple operación de descarga y arranque en segundos con las variables del entorno; no requiere compilar',
            'b' => 'Hay que recompilar con los flags de producción',
            'c' => 'Hay que volver a pasar el código por el linter',
            'd' => 'Hay que clonar Git en el servidor'
        ],
        'correcta' => 'a',
        'porque'   => 'Es la “velocidad de despliegue” de la inmutabilidad. La “garantía matemática de calidad”: lo aprobado por QA es bit por bit idéntico a lo de producción.'
    ],
    'm3' => [
        'texto'    => 'La práctica errada más común y peligrosa en equipos inmaduros es…',
        'opciones' => [
            'a' => 'Usar lockfile',
            'b' => 'Ejecutar <code>build --env=qa</code> para pruebas y otro <code>build --env=prod</code> para el release',
            'c' => 'Usar multi-stage',
            'd' => 'Firmar imágenes'
        ],
        'correcta' => 'b',
        'porque'   => 'Se despliega software nuevo que <b>jamás pasó</b> por los controles de calidad del entorno de pruebas.'
    ],
    'm4' => [
        'texto'    => '¿Cuáles son los problemas de “recompilar por entorno”?',
        'opciones' => [
            'a' => 'Ninguno, es una práctica segura',
            'b' => 'Dependencias distintas (parches flotantes), diferencias de flags (pueden ocultar o generar bugs de <b>concurrencia</b>) e <b>invalidez de pruebas</b>',
            'c' => 'Solo que tarda más',
            'd' => 'Solo que necesita más disco'
        ],
        'correcta' => 'b',
        'porque'   => 'Lo que corre en producción jamás fue probado por QA.'
    ],
    'm5' => [
        'texto'    => '<b>Twelve-Factor App, Factor III</b> establece:',
        'opciones' => [
            'a' => 'Separación estricta de la <b>configuración</b> respecto del código',
            'b' => 'Los logs son flujos de eventos',
            'c' => 'Una base de código por app',
            'd' => 'Los procesos son stateless'
        ],
        'correcta' => 'a',
        'porque'   => 'La configuración (URLs de BD, credenciales, niveles de log) varía entre entornos; el código y las librerías son 100 % idénticos.'
    ],
    'm6' => [
        'texto'    => 'La “<b>prueba del ácido</b>” de la configuración externa es:',
        'opciones' => [
            'a' => '¿Compila en Windows?',
            'b' => '¿Tiene más de 80 % de cobertura?',
            'c' => '¿Podrías publicar tu repo en GitHub público <b>sin exponer secretos</b>?',
            'd' => '¿Tiene Dockerfile?'
        ],
        'correcta' => 'c',
        'porque'   => 'Si hay que censurar algo antes de hacerlo público, la configuración no está bien separada.'
    ],
    'm7' => [
        'texto'    => '¿Cuáles son los <b>mecanismos modernos de inyección</b> de configuración?',
        'opciones' => [
            'a' => 'Hardcodear en el binario',
            'b' => 'Recompilar con --env',
            'c' => 'Copiar un archivo por SSH al servidor',
            'd' => 'Variables de entorno (<code>process.env</code>, <code>System.getenv()</code>), ConfigMaps de Kubernetes y gestores de secretos (HashiCorp Vault, AWS Secrets Manager con rotación de llaves)'
        ],
        'correcta' => 'd',
        'porque'   => 'Variables de entorno = estándar agnóstico de SO leído en runtime. ConfigMaps = archivos desacoplados montados en runtime.'
    ],
    'm8' => [
        'texto'    => 'Una app debe conectarse a BD distintas en Dev y Prod. ¿Qué debe cambiar? (Trivia del PDF)',
        'opciones' => [
            'a' => 'Solo las <b>variables de entorno</b> inyectadas al contenedor en runtime; la imagen y el binario son 100 % idénticos',
            'b' => 'El código fuente',
            'c' => 'El Dockerfile',
            'd' => 'La versión del compilador'
        ],
        'correcta' => 'a',
        'porque'   => 'Es aplicación directa del Factor III de Twelve-Factor.'
    ],
    'm9' => [
        'texto'    => 'En el ciclo de promoción de artefactos inmutables, lo que cambia entre entornos es…',
        'opciones' => [
            'a' => 'El binario',
            'b' => 'El hash',
            'c' => 'Solo las configuraciones del entorno (Dev, DB Staging/Mocks, Vault/Prod Secrets); el <b>MISMO hash</b> se promueve',
            'd' => 'La versión de Java'
        ],
        'correcta' => 'c',
        'porque'   => 'Fase 1: Build &amp; CI (commit, pruebas, imagen con hash, push a Nexus/ECR, artefacto <code>v1.4.0@sha256:…</code>). Fase 2: Dev con pruebas de humo. Fase 3: QA/Staging con E2E y rendimiento, aprobación formal de release. Fase 4: Producción con Blue-Green o Canary.'
    ],
    'm10' => [
        'texto'    => '¿En qué fase se ejecutan las pruebas <b>E2E y de rendimiento</b> con aprobación formal del release?',
        'opciones' => [
            'a' => 'Fase 1: Build &amp; CI',
            'b' => 'Fase 2: Entorno Dev',
            'c' => 'Fase 4: Producción',
            'd' => 'Fase 3: Entorno QA/Staging'
        ],
        'correcta' => 'd',
        'porque'   => 'QA/Stg: promoción del mismo hash, inyección de DB Staging/Mocks, E2E y rendimiento, aprobación formal.'
    ],
    'm11' => [
        'texto'    => '¿Qué estrategias de despliegue se mencionan en la fase de Producción?',
        'opciones' => [
            'a' => 'Big Bang y Rolling Stone',
            'b' => 'Blue-Green o Canary',
            'c' => 'A/B y Waterfall',
            'd' => 'Ninguna'
        ],
        'correcta' => 'b',
        'porque'   => 'Con el MISMO hash e inyección de Vault / Prod Secrets: cero sorpresas de compilación.'
    ],
    'm12' => [
        'texto'    => '<b>Caso left-pad (marzo 2016)</b>: ¿qué ocurrió?',
        'opciones' => [
            'a' => 'Un desarrollador retiró de npmjs una función de <b>11 líneas</b> y miles de proyectos (Babel, React, Facebook, Netflix) que recompilaban descargando de Internet se rompieron en segundos',
            'b' => 'Nexus dejó de funcionar',
            'c' => 'Docker Hub fue hackeado',
            'd' => 'Una vulnerabilidad en Log4j'
        ],
        'correcta' => 'a',
        'porque'   => 'Causa raíz: pipelines sin inmutabilidad que dependían de la disponibilidad en vivo de servicios externos para compilar.'
    ],
    'm13' => [
        'texto'    => '¿Cuál es la <b>lección DevOps</b> de left-pad?',
        'opciones' => [
            'a' => 'No usar npm',
            'b' => 'No depender de repositorios públicos en vivo durante un despliegue crítico; usar <b>proxies locales (Nexus)</b> con caché inmutable y desplegar artefactos pre-construidos',
            'c' => 'Escribir todo desde cero',
            'd' => 'Publicar más paquetes'
        ],
        'correcta' => 'b',
        'porque'   => 'Tres puntos: (1) nunca depender de repos públicos en vivo, (2) proxies locales con caché inmutable, (3) artefactos pre-construidos, nunca código dependiente de descargas.'
    ],
    'm14' => [
        'texto'    => 'Servidores tradicionales (<b>mascotas / pets</b>) se caracterizan por…',
        'opciones' => [
            'a' => 'Ser anónimos y efímeros',
            'b' => 'Filesystem raíz de solo lectura',
            'c' => 'Tener nombres propios (<code>servidor-pagos-prod</code>), parcharse por SSH en caliente y volverse únicos y artesanales (<b>configuration drift</b>)',
            'd' => 'Recrearse desde la imagen'
        ],
        'correcta' => 'c',
        'porque'   => 'Imposibles de reproducir ante una catástrofe, con alto riesgo operativo.'
    ],
    'm15' => [
        'texto'    => 'Contenedores inmutables (<b>ganado / cattle</b>):',
        'opciones' => [
            'a' => 'Se modifican por SSH',
            'b' => 'Anónimos, idénticos y efímeros; nunca se modifican en ejecución (filesystem raíz de <b>solo lectura</b>); si hay un bug, se corrige en Git, se construye un nuevo artefacto y se <b>reemplaza</b> el contenedor',
            'c' => 'Tienen nombres propios',
            'd' => 'Se parchean en caliente'
        ],
        'correcta' => 'b',
        'porque'   => 'Recuperación instantánea: destruir y recrear desde la imagen.'
    ],
    'm16' => [
        'texto'    => '<b>Rollback</b> en el paradigma inmutable:',
        'opciones' => [
            'a' => 'Complejo: recompilar o revertir commits en caliente',
            'b' => 'Imposible',
            'c' => 'Trivial: apuntar el balanceador al <b>digest SHA-256 anterior</b>',
            'd' => 'Requiere reiniciar el servidor'
        ],
        'correcta' => 'c',
        'porque'   => 'Mutable: rollback complejo. Inmutable: trivial.'
    ],
    'm17' => [
        'texto'    => 'MTTR en el paradigma tradicional vs. el inmutable:',
        'opciones' => [
            'a' => 'Tradicional: segundos; inmutable: horas',
            'b' => 'Tradicional: horas diagnosticando diferencias en servidores vivos; inmutable: <b>segundos</b> desplegando el contenedor validado',
            'c' => 'Iguales',
            'd' => 'Tradicional: días; inmutable: semanas'
        ],
        'correcta' => 'b',
        'porque'   => 'MTTR = tiempo medio de reparación.'
    ],
    'm18' => [
        'texto'    => 'Trazabilidad: paradigma mutable vs. inmutable.',
        'opciones' => [
            'a' => 'Mutable: exacta; inmutable: difusa',
            'b' => 'Ambos igual de difusos',
            'c' => 'Ambos exactos',
            'd' => 'Mutable: difusa (difícil saber qué versión corre en qué host); inmutable: <b>exacta</b> (cada contenedor tiene un hash SHA-256 inmutable)'
        ],
        'correcta' => 'd',
        'porque'   => 'Consistencia: mutable vulnerable a configuration drift; inmutable 100 % idéntica entre Dev, QA, Staging y Producción.'
    ],
    'm19' => [
        'texto'    => '<b>Escenario A (debate)</b>: un equipo de React compila la SPA dos veces (<code>npm run build</code> con la URL de Staging y luego con la de Prod). ¿Qué riesgo introduce y cómo se corrige?',
        'opciones' => [
            'a' => 'Ningún riesgo, es la práctica estándar',
            'b' => 'Riesgo: dos binarios distintos, lo probado en Staging no es lo que corre en Prod. Solución: una sola imagen Nginx con <b>configuración inyectada en runtime</b> (p. ej. un <code>config.js</code> o variables de entorno con plantilla al arrancar)',
            'c' => 'Riesgo: velocidad. Solución: más runners',
            'd' => 'Riesgo: memoria. Solución: usar Vite'
        ],
        'correcta' => 'b',
        'porque'   => 'El PDF deja la pregunta abierta para debate; la respuesta alineada con la sesión es Build Once + configuración externa (Factor III) también en el frontend.'
    ],
    'm20' => [
        'texto'    => '<b>Escenario B (debate)</b>: Dockerfile con <code>FROM node:alpine</code> sin versión ni digest. Tras 6 meses de funcionar, a las 2 AM el contenedor no inicia. ¿Qué pasó?',
        'opciones' => [
            'a' => 'Nexus se cayó',
            'b' => 'Se perdió el lockfile',
            'c' => 'La etiqueta <code>node:alpine</code> (mutable) apuntó a una <b>nueva versión del base image</b> publicada aguas arriba en Docker Hub que rompió algo; fallaron los controles de versión fija/digest, el proxy con caché inmutable y el escaneo/promoción de imágenes base',
            'd' => 'Kubernetes cambió de versión'
        ],
        'correcta' => 'c',
        'porque'   => 'Es el problema de las etiquetas mutables. Fix: fijar versión exacta o digest y mirrorear la base en tu registry.'
    ],
    'm21' => [
        'texto'    => 'Trivia 2: diferencia funcional entre un repositorio <b>Proxy</b> y uno <b>Hosted</b> en Nexus.',
        'opciones' => [
            'a' => 'Proxy almacena binarios privados; Hosted cachea públicos',
            'b' => 'Son idénticos',
            'c' => 'Hosted almacena binarios <b>privados propios</b>; Proxy <b>cachea y aísla</b> repositorios externos públicos (Maven Central, npmjs, Docker Hub)',
            'd' => 'Proxy es solo para Docker'
        ],
        'correcta' => 'c',
        'porque'   => 'Y Group los unifica bajo una URL.'
    ],
    'm22' => [
        'texto'    => 'Trivia 1: ¿por qué es indispensable commitear <code>package-lock.json</code> o <code>poetry.lock</code>?',
        'opciones' => [
            'a' => 'Por estética',
            'b' => 'Para asegurar <b>determinismo</b>: que cualquier desarrollador o runner descargue exactamente las mismas sub-versiones y hashes de dependencias transitivas',
            'c' => 'Para que Git pese más',
            'd' => 'Porque lo pide npm'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin lockfile en Git, no hay reproducibilidad.'
    ],
    'm23' => [
        'texto'    => 'El <b>mensaje central</b> de la sesión es…',
        'opciones' => [
            'a' => 'La velocidad de entrega se logra <b>industrializando el empaquetamiento</b> y confiando plenamente en la inmutabilidad de los artefactos',
            'b' => 'La velocidad se logra con más desarrolladores',
            'c' => 'La calidad se logra con pruebas manuales',
            'd' => 'La seguridad se logra ocultando el código'
        ],
        'correcta' => 'a',
        'porque'   => 'Los 4 pilares: (1) build automatizado con lockfiles y multi-stage; (2) artefactos con SemVer, SHA-256 y SBOM; (3) repositorios dedicados (Nexus, Registries); (4) inmutabilidad y 12-Factor.'
    ],
];

$MULTIPLE = [];
iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Empaquetamiento · 5 — Inmutabilidad en DevOps', 'empaquetamiento_artefactos_inmutabilidad.pdf — Secciones 04 y 05: Build Once, 12-Factor, left-pad, mascotas vs ganado, síntesis');
?>

<div class="card">
  <h2>1. La regla de oro de DevOps</h2>
    <div class="regla-oro">
        <div class="regla-impacto"><?php hueco(1, 3); ?> Sola Vez</div>
        <div class="regla-subtitulo">debe compilarse y empaquetarse el código fuente en todo el ciclo de entrega</div>
        <blockquote>“<?php hueco(2, 40); ?>. El código fuente se compila y empaqueta una única vez en el pipeline de CI. El artefacto binario resultante es <?php hueco(3, 16); ?> el que se promueve y ejecuta en Pruebas, Staging y Producción.”</blockquote>
    </div>
  <?php enviar(); ?>
</div>

<div class="card">
    <h2>2. El Flujo de Inmutabilidad: Build Once, Deploy to Many</h2>
    <p class="promo-intro">Un único artefacto binario inmutable alimenta todos los entornos de la cadena de valor:</p>
    <div class="promo-flow">
        <div class="promo-node promo-build"><b>Build (CI)</b><small>Compilación y Tests</small></div>
        <div class="promo-arrow">→</div>
        <div class="promo-node promo-artifact"><b>Artifact</b><strong>Hash SHA-256 Inmutable</strong><code><?php hueco(38, 16); ?></code></div>
        <div class="promo-arrow">→</div>
        <div class="promo-targets">
            <div class="promo-node promo-env">
                <b>Testing / QA</b>
                <small>Inyección: Config Test · <?php hueco(29, 4); ?> · humo <?php hueco(30, 6); ?> · <?php hueco(37, 6); ?></small>
            </div>
            <div class="promo-node promo-env">
                <b>Staging</b>
                <small>Inyección: Config <?php hueco(39, 8); ?> · pruebas <?php hueco(31, 4); ?> y <?php hueco(32, 12); ?> · <?php hueco(33, 18); ?></small>
            </div>
            <div class="promo-node promo-env">
                <b>Production</b>
                <small>Inyección: Secrets Prod · <?php hueco(35, 12); ?> o <?php hueco(36, 8); ?></small>
            </div>
        </div>
    </div>
    <div class="promo-beneficios promo-beneficios-solo">
        <section class="promo-beneficio promo-velocidad">
            <h3>Velocidad de Despliegue</h3>
            <p>Promover a producción no requiere <?php hueco(80, 10); ?>: es una simple operación de descarga y arranque en <?php hueco(81, 10); ?> con las <?php hueco(82, 22); ?>.</p>
        </section>
    </div>
    <?php enviar(); ?>
</div>

<div class="card">
                <h2>3. La Trampa de “Recompilar por Entorno”</h2>
    <div class="recompilar-layout">
        <section class="recompilar-content">
            <p>El anti-patrón más común y peligroso en equipos inmaduros:</p>
            <ul>
                <li><b>La práctica errada:</b> Ejecutar <code><?php hueco(8, 16); ?></code> para pruebas y otro <code><?php hueco(9, 16); ?></code> para el release.</li>
                <li><b>Dependencias distintas:</b> El compilador puede resolver versiones <?php hueco(10, 10); ?> flotantes diferentes entre builds.</li>
                <li><b>Diferencias de <?php hueco(11, 6); ?>:</b> Cambios en optimizaciones de compilación pueden ocultar o generar bugs de <?php hueco(12, 14); ?>.</li>
            </ul>
        </section>
        <aside class="recompilar-invalidez">
            <h3><?php hueco(13, 18); ?></h3>
            <p>Si recompilas para producción, estás desplegando software nuevo que jamás pasó por los controles de calidad del entorno de <?php hueco(14, 4); ?>.</p>
        </aside>
    </div>
  <?php enviar(); ?>
</div>

<div class="card">
    <h2>4. The Twelve-Factor App: Factor <?php hueco(15, 4); ?> (Configuración)</h2>
    <div class="factor3-layout">
        <section class="factor3-col factor3-principio">
            <h3>El Principio de Configuración Externa</h3>
            <ul>
                <li><b>Regla del Factor III:</b> Separación estricta de la <?php hueco(16, 14); ?> respecto del <?php hueco(17, 8); ?>.</li>
                <li>La configuración varía entre entornos (URLs de BD, credenciales, niveles de log).</li>
                <li>El código y las librerías son <?php hueco(18, 4); ?> % idénticos en todos los entornos.</li>
                <li><b>Prueba del ácido:</b> ¿Podrías publicar tu repo en <?php hueco(20, 14); ?> sin exponer <?php hueco(21, 10); ?>?</li>
            </ul>
        </section>
        <section class="factor3-col factor3-inyeccion">
            <h3>Mecanismos Modernos de Inyección</h3>
            <ul>
                <li><b><?php hueco(22, 22); ?>:</b> Estándar agnóstico de SO leído en runtime (<code><?php hueco(23, 12); ?></code>, <code><?php hueco(24, 16); ?></code>).</li>
                <li><b><?php hueco(25, 12); ?> de Kubernetes:</b> Archivos de configuración desacoplados montados en runtime.</li>
                <li><b>Gestores de Secretos:</b> HashiCorp <?php hueco(26, 8); ?>, <?php hueco(27, 20); ?> con rotación de <?php hueco(28, 10); ?>.</li>
            </ul>
        </section>
    </div>
  <?php linea(79, 'Arranca la imagen <code>mi-app:1.4.0</code> inyectando la URL de la BD como variable de entorno <code>DB_URL</code> tomada de tu shell.', 'docker run ...'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
    <h2>5. El Ciclo de Promoción de Artefactos Inmutables</h2>
    <p class="promo-ciclo-intro">Flujo de promoción continua: el binario es inmutable; solo cambian las configuraciones del entorno:</p>
    <div class="promo-fases">
        <section class="promo-fase promo-fase-build">
            <h3>Fase 1: Build &amp; CI</h3>
            <ul>
                <li>Git commit en rama principal.</li>
                <li>Compilación y pruebas unitarias.</li>
                <li>Generación de imagen con hash.</li>
                <li>Push a Nexus / ECR.</li>
                <li><b>Artefacto:</b> <code><?php hueco(38, 16); ?>:…</code></li>
            </ul>
        </section>
        <section class="promo-fase promo-fase-dev">
            <h3>Fase 2: Entorno Dev</h3>
            <ul>
                <li>Despliegue de imagen inmutable.</li>
                <li>Inyección: Configs de Dev.</li>
                <li>Pruebas de humo automáticas.</li>
                <li>Validación ágil del equipo.</li>
            </ul>
        </section>
        <section class="promo-fase promo-fase-qa">
            <h3>Fase 3: Entorno QA/Stg</h3>
            <ul>
                <li>Promoción del <?php hueco(34, 12); ?>.</li>
                <li>Inyección: DB Staging / <?php hueco(37, 6); ?>.</li>
                <li>Pruebas <?php hueco(31, 4); ?> y de <?php hueco(32, 12); ?>.</li>
                <li><?php hueco(33, 18); ?> del release.</li>
            </ul>
        </section>
        <section class="promo-fase promo-fase-prod">
            <h3>Fase 4: Producción</h3>
            <ul>
                <li>Despliegue del MISMO hash.</li>
                <li>Inyección: Vault / Prod Secrets.</li>
                <li><?php hueco(35, 12); ?> o <?php hueco(36, 8); ?>.</li>
                <li>Cero sorpresas de compilación.</li>
            </ul>
        </section>
    </div>
    <div class="promo-garantia"><b>Garantía Matemática:</b> La certeza de estabilidad en Producción proviene de haber probado el idéntico binario en Staging. El software aprobado por QA es <b><?php hueco(4, 12); ?></b> idéntico al que entra a Producción.</div>
    <?php enviar(); ?>
</div>

<div class="card">
    <h2>6. Estudio de caso real: el incidente de “left-pad”</h2>
  <ul>
    <li><b>El suceso:</b> en marzo de <?php hueco(40, 5); ?> un desarrollador retiró de <?php hueco(43, 8); ?> una función de
        <?php hueco(42, 3); ?> líneas llamada <code><?php hueco(41, 10); ?></code>.</li>
    <li><b>Impacto global:</b> miles de proyectos (<?php hueco(44, 8); ?>, Facebook, Netflix) que recompilaban en CI descargando de Internet se rompieron en
        <?php hueco(45, 10); ?>.</li>
    <li><b>Causa raíz:</b> pipelines sin inmutabilidad que dependían de la <?php hueco(46, 22); ?> de servicios externos para compilar.</li>
    <li><b>Lección:</b> nunca depender de repos públicos en vivo en un despliegue crítico; usar <?php hueco(47, 14); ?> con caché inmutable;
        desplegar artefactos <?php hueco(48, 16); ?>, nunca código dependiente de descargas.</li>
  </ul>
  <?php enviar(); ?>
</div>

<div class="card">
    <h2>7. Infraestructura Inmutable: Mascotas vs. Ganado</h2>
    <div class="petcattle-layout">
        <section class="petcattle-col petcattle-pets">
            <h3>Servidores Tradicionales (<?php hueco(49, 10); ?> - Pets)</h3>
            <ul>
                <li>Servidores con nombres propios (<code>servidor-pagos-prod</code>).</li>
                <li>Se conectan por <?php hueco(51, 4); ?> para aplicar parches, modificar configs o instalar paquetes en caliente.</li>
                <li>Cada servidor se vuelve único y artesanal con el tiempo.</li>
                <li><b><?php hueco(52, 20); ?>:</b> Imposible de reproducir ante una catástrofe; alto riesgo operativo.</li>
            </ul>
        </section>
        <section class="petcattle-col petcattle-cattle">
            <h3>Contenedores Inmutables (<?php hueco(50, 8); ?> - Cattle)</h3>
            <ul>
                <li>Contenedores <?php hueco(58, 10); ?>, idénticos y completamente <?php hueco(53, 10); ?>.</li>
                <li><b>Nunca se modifican en ejecución:</b> El sistema de archivos raíz es de <?php hueco(54, 12); ?>.</li>
                <li>Si hay un bug, se corrige en <?php hueco(55, 5); ?>, se construye un nuevo artefacto inmutable y se <?php hueco(56, 10); ?> el contenedor.</li>
                <li>Recuperación instantánea ante fallas: <?php hueco(57, 20); ?> desde la imagen.</li>
            </ul>
        </section>
    </div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>8. Cuadro Comparativo: Paradigma Mutable vs. Inmutable</h2>
  <table class="datos mutable-comparison">
    <tr><th>Dimensión</th><th>Paradigma Tradicional (Mutable)</th><th>Paradigma DevOps (Inmutable)</th></tr>
    <tr><td><b>Construcción</b></td>
        <td><?php hueco(59, 14); ?> en cada entorno (<code>--env=qa</code>, <code>--env=prod</code>).</td>
        <td>Construcción única en CI (<i>Build Once, Deploy to Many</i>).</td></tr>
    <tr><td><b>Configuración</b></td>
        <td><?php hueco(60, 14); ?> en código o empaquetada en el binario.</td>
        <td>Inyectada en runtime vía variables de entorno / Vault.</td></tr>
    <tr><td><b>Rollback</b></td>
        <td>Complejo: recompilar o revertir commits en caliente.</td>
        <td><?php hueco(61, 8); ?>: apuntar el balanceador al <?php hueco(62, 20); ?> SHA-256 anterior.</td></tr>
    <tr><td><b>Trazabilidad</b></td>
        <td><?php hueco(63, 8); ?>: difícil saber qué versión exacta corre en qué host.</td>
        <td><?php hueco(64, 8); ?>: cada contenedor tiene un hash SHA-256 inmutable.</td></tr>
    <tr><td><b>Consistencia</b></td>
        <td>Vulnerable al “Configuration Drift” entre entornos.</td>
        <td>100 % idéntica entre Dev, QA, Staging y Producción.</td></tr>
    <tr><td><b><?php hueco(65, 6); ?> (Reparación)</b></td>
        <td><?php hueco(66, 8); ?> diagnosticando diferencias en servidores vivos.</td>
        <td><?php hueco(67, 10); ?> desplegando el contenedor inmutable validado.</td></tr>
  </table>
  <?php enviar(); ?>
</div>

<div class="card">
    <h2>9. Síntesis, debate y trivia</h2>
  <h3>Los 4 pilares</h3>
  <ol>
    <li><b>Build automatizado:</b> proceso determinista con <?php hueco(68, 10); ?> y builds <?php hueco(69, 12); ?> que separan compilador de runtime.</li>
    <li><b>Artefactos e integridad:</b> el código fuente no se despliega; se gestionan binarios inmutables con <?php hueco(70, 8); ?>, hashes SHA-256 y
        <?php hueco(71, 6); ?>.</li>
    <li><b>Repositorios dedicados:</b> Sonatype <?php hueco(72, 8); ?> (Hosted/Proxy/Group) y <?php hueco(73, 16); ?> centralizan y gobiernan la entrega.</li>
    <li><b>Inmutabilidad y 12-Factor:</b> “Build Once, Deploy to Many”, configuración externa y contenedores efímeros.</li>
  </ol>
  <div class="avisoflujo"><b>Mensaje central.</b> La velocidad de entrega en DevOps se logra <?php hueco(74, 34); ?> y confiando
     plenamente en la inmutabilidad de los artefactos.</div>

  <h3>Debate</h3>
  <p><b>Escenario A.</b> Tienes que cumplir la inmutabilidad del contenedor <?php hueco(77, 8); ?> de la SPA: la solución es inyectar la URL del backend en runtime.<br>
     <b>Escenario B.</b> El fallo a medianoche viene de <code>FROM node:alpine</code>: la etiqueta mutable
     <?php hueco(76, 8); ?> / sin versión. La solución es fijar una <?php hueco(75, 8); ?> (o digest).</p>
  <?php linea(78, 'Corrige el <b>Escenario B</b>: escribe un <code>FROM</code> con <b>versión fija</b> <code>20.11.1</code> de la variante alpine de node.', 'FROM ...'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<div class="card">
    <h2>10. Check Rápido de Comprensión (Trivia Conceptual)</h2>
    <ol class="trivia-check-list">
        <li><b>¿Por qué es indispensable commitear <code>package-lock.json</code> o <code>poetry.lock</code> en Git?</b><br>
                Para asegurar el <?php hueco(83, 16); ?>: que cualquier desarrollador o runner de CI descargue exactamente las mismas sub-versiones y hashes de dependencias transitivas.</li>
        <li><b>En Sonatype Nexus, ¿cuál es la diferencia funcional entre un repositorio Proxy y uno Hosted?</b><br>
                Hosted almacena <?php hueco(84, 28); ?>; Proxy cachea y aísla repositorios externos públicos (Maven Central, npmjs, Docker Hub).</li>
        <li><b>¿Cuál es el mensaje central de la sesión?</b><br>
                La velocidad de entrega en DevOps se logra <?php hueco(85, 34); ?> y confiando plenamente en la inmutabilidad de los artefactos.</li>
    </ol>
    <?php enviar('Verificar la trivia'); ?>
</div>

<?php
pie('cuarto.php', '../Menu.php');
