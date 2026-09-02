<?php
/* ==========================================================================
   CompuNet 3 / Preguntas de exposiciones / Go
   Generado a partir de las preguntas publicadas en el foro del curso.
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [
    'p1' => [
        'texto'    => 'En la demostración del sistema de pedidos, ¿por qué el pago, el inventario y la notificación se implementaron mediante <b>goroutines</b>?',
        'opciones' => [
            'a' => 'Porque cada tarea necesita obligatoriamente ejecutarse en un servidor diferente.',
            'b' => 'Porque permite iniciar tareas independientes de manera concurrente, reduciendo potencialmente el tiempo total de procesamiento.',
            'c' => 'Porque reemplaza la necesidad de utilizar funciones en Go.',
            'd' => 'Porque obliga a que las tareas terminen exactamente en el orden en que fueron iniciadas.',
            'e' => 'Porque convierte automáticamente el programa en una aplicación web.',
        ],
        'correcta' => 'b',
        'porque'   => 'La D dice justo lo contrario de lo que es la concurrencia: con goroutines <b>no</b> controlas el orden de finalización, y por eso hacen falta canales o un <code>WaitGroup</code>.',
    ],
    'p2' => [
        'texto'    => '¿Cuáles de las siguientes características están relacionadas con los <b>objetivos de diseño</b> del lenguaje Go?',
        'opciones' => [
            'a' => 'Mantener una sintaxis relativamente simple y fácil de leer.',
            'b' => 'Facilitar el desarrollo de sistemas concurrentes y distribuidos.',
            'c' => 'Ofrecer compilación y ejecución eficiente para aplicaciones de alto rendimiento.',
            'd' => 'Requerir una jerarquía compleja de herencia basada en clases.',
            'e' => 'Proporcionar herramientas integradas para la gestión y construcción de proyectos.',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'b', 'c', 'e'],
        'porque'   => 'La D es lo que Go <b>evita a propósito</b>: no hay herencia de clases, se compone con interfaces y structs.',
    ],
    'p3' => [
        'texto'    => 'En la API desarrollada con <b>Gin</b>, ¿cuáles son las funciones principales del framework en la demostración?',
        'opciones' => [
            'a' => 'Definir rutas o endpoints HTTP, como GET y POST.',
            'b' => 'Recibir y procesar solicitudes enviadas por los clientes.',
            'c' => 'Convertir automáticamente Go en un lenguaje interpretado.',
            'd' => 'Facilitar el envío de respuestas en formato JSON.',
            'e' => 'Ejecutar automáticamente todas las funciones como goroutines sin necesidad de utilizar la palabra clave <code>go</code>.',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'b', 'd'],
        'porque'   => 'Gin es un router HTTP: rutas, peticiones y respuestas. Ni cambia cómo se compila Go ni reparte goroutines por su cuenta.',
    ],
    'p4' => [
        'texto'    => '¿Cuál de las siguientes afirmaciones describe correctamente una característica del lenguaje Go?',
        'opciones' => [
            'a' => 'Go es un lenguaje puramente interpretado que no requiere compilación.',
            'b' => 'Go utiliza tipado estático y normalmente compila el código fuente en un programa ejecutable.',
            'c' => 'Go requiere obligatoriamente una máquina virtual para ejecutar cualquier programa.',
            'd' => 'Go está basado exclusivamente en programación orientada a objetos mediante clases y herencia.',
            'e' => 'Go solo puede utilizarse para desarrollar aplicaciones web.',
        ],
        'correcta' => 'b',
        'porque'   => 'Compila a un binario único sin máquina virtual: por eso encaja tan bien en contenedores, la imagen queda diminuta.',
    ],
];

iniciar([], $MULTIPLE);
cabecera('Go', 'Goroutines, objetivos del lenguaje, Gin y tipado');
?>

<div class="card">
  <h2>Go</h2>
  <p>Por qué el sistema de pedidos usa goroutines, qué buscaba el diseño de Go, qué hace el framework Gin y cómo se ejecuta un programa en Go.</p>
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
pie('../Astro/index.php', '../DApps/index.php');
