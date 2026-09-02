<?php
/* ==========================================================================
   CompuNet 3 / Preguntas de exposiciones / Jenkins y CI/CD
   Generado a partir de las preguntas publicadas en el foro del curso.
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [
    'p1' => [
        'texto'    => '¿Cuáles de las siguientes son <b>etapas típicas de un pipeline</b> mencionadas en la diapositiva de Jenkinsfile?',
        'opciones' => [
            'a' => 'Checkout',
            'b' => 'Build',
            'c' => 'Sprint Planning',
            'd' => 'Test',
            'e' => 'Deploy',
            'f' => 'Code Review',
            'g' => 'Refactorización',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'b', 'd', 'e'],
        'porque'   => 'Sprint Planning, Code Review y Refactorización son prácticas del equipo, no etapas que ejecuta el pipeline.',
    ],
    'p2' => [
        'texto'    => 'Según la comparativa de Jenkins contra otras herramientas CI/CD, ¿cómo se clasifica el <b>hosting</b> de Jenkins?',
        'opciones' => [
            'a' => 'Cloud (SaaS), igual que CircleCI',
            'b' => 'Self-hosted',
            'c' => 'Híbrido obligatorio con Azure',
            'd' => 'Solo disponible como app móvil',
            'e' => 'Cloud / self-hosted, igual que GitLab CI/CD',
        ],
        'correcta' => 'b',
        'porque'   => 'Jenkins lo instalas y lo mantienes tú. De ahí sale una de sus desventajas: requiere mantenimiento propio.',
    ],
    'p3' => [
        'texto'    => '¿Cuáles de los siguientes son <b>plugins de Jenkins</b> mencionados en la diapositiva «Plugins destacados»?',
        'opciones' => [
            'a' => 'Blue Ocean',
            'b' => 'TensorFlow Extended',
            'c' => 'Docker Pipeline',
            'd' => 'Webpack Bundle Analyzer',
            'e' => 'Credentials Binding',
            'f' => 'NodeJS Plugin',
            'g' => 'Slack Notification',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'c', 'e', 'f', 'g'],
        'porque'   => 'TensorFlow Extended es de pipelines de machine learning y Webpack Bundle Analyzer es una herramienta de build de frontend. Ninguno es plugin de Jenkins.',
    ],
    'p4' => [
        'texto'    => '¿Cuáles de las siguientes se mencionan explícitamente como <b>desventajas</b> de Jenkins?',
        'opciones' => [
            'a' => 'Interfaz poco moderna',
            'b' => 'Costo de licencia elevado',
            'c' => 'Requiere mantenimiento propio',
            'd' => 'Curva de aprendizaje pronunciada',
            'e' => 'Configuración inicial compleja',
            'f' => 'Falta total de comunidad',
            'g' => 'Conflictos entre plugins',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'c', 'd', 'e', 'g'],
        'porque'   => 'Las dos falsas se caen solas: Jenkins es libre y gratuito, y su comunidad es justo uno de sus puntos fuertes (de ahí los miles de plugins... y sus conflictos).',
    ],
];

iniciar([], $MULTIPLE);
cabecera('Jenkins y CI/CD', 'Etapas del pipeline, hosting, plugins y desventajas');
?>

<div class="card">
  <h2>Jenkins y CI/CD</h2>
  <p>Las etapas del <code>Jenkinsfile</code>, cómo se compara con otras herramientas de CI/CD, los plugins destacados y lo que Jenkins hace mal.</p>
  <div class="nota">
    Las preguntas marcadas <b>varias correctas</b> se responden con casillas y solo
    cuentan si marcas <b>exactamente</b> el conjunto bueno: ni de menos ni de mas.
    Al verificar, la opcion buena se resalta en verde y debajo aparece el porque.
  </div>
</div>

<div class="card">
  <h2>Preguntas</h2>
  <?php mc('p1'); ?>
  <?php mc('p2'); ?>
  <?php mc('p3'); ?>
  <?php mc('p4'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../ReactNative/index.php', '../Angular/index.php');
