<?php
/* ==========================================================================
   CompuNet 3 / Preguntas de exposiciones / Flask
   Generado a partir de las preguntas publicadas en el foro del curso.
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [
    'p1' => [
        'texto'    => '¿Por qué Flask se considera un <b>microframework</b>?',
        'opciones' => [
            'a' => 'Porque solo permite crear aplicaciones pequeñas',
            'b' => 'Porque su núcleo incluye solo lo esencial y puede extenderse',
            'c' => 'Porque únicamente funciona con bases de datos pequeñas',
            'd' => 'Porque no permite utilizar librerías externas',
        ],
        'correcta' => 'b',
        'porque'   => '«Micro» se refiere al <b>núcleo</b>, no al tamaño de lo que puedes construir. No trae ORM ni validación de fábrica: los añades tú.',
    ],
    'p2' => [
        'texto'    => '¿Qué biblioteca de Flask gestiona principalmente solicitudes, respuestas y comunicación <b>WSGI</b>?',
        'opciones' => [
            'a' => 'Jinja',
            'b' => 'Blinker',
            'c' => 'Werkzeug',
            'd' => 'Click',
        ],
        'correcta' => 'c',
        'porque'   => 'Reparto de papeles: <b>Werkzeug</b> el WSGI, <b>Jinja</b> las plantillas, <b>Click</b> la línea de comandos y <b>Blinker</b> las señales.',
    ],
    'p3' => [
        'texto'    => '¿Qué herramienta permite dividir una aplicación Flask en <b>módulos</b> con rutas relacionadas?',
        'opciones' => [
            'a' => 'Blueprints',
            'b' => 'SECRET_KEY',
            'c' => 'Pydantic',
            'd' => 'JVM',
        ],
        'correcta' => 'a',
        'porque'   => 'Los <b>Blueprints</b> son lo que evita acabar con un <code>app.py</code> de dos mil líneas.',
    ],
    'p4' => [
        'texto'    => '¿En cuál de los siguientes escenarios Flask suele ser una <b>buena elección</b>?',
        'opciones' => [
            'a' => 'CRUD administrativo enorme con muchas tablas y roles',
            'b' => 'APIs REST y microservicios pequeños o medianos',
            'c' => 'Miles de conexiones WebSocket con E/S asíncrona intensiva',
            'd' => 'Aplicaciones que requieren muchas herramientas integradas desde el inicio',
        ],
        'correcta' => 'b',
        'porque'   => 'Para el CRUD enorme y para el «todo incluido» está Django; para la E/S asíncrona masiva, FastAPI o algo async de verdad.',
    ],
];

iniciar([], $MULTIPLE);
cabecera('Flask', 'Microframework, Werkzeug, Blueprints y cuándo usarlo');
?>

<div class="card">
  <h2>Flask</h2>
  <p>Por qué es un «micro» framework, qué hay debajo, cómo se organiza un proyecto grande y en qué escenarios encaja.</p>
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
pie('../Angular/index.php', '../SeguridadWeb/index.php');
