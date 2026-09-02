<?php
/* ==========================================================================
   CompuNet 3 / Preguntas de exposiciones / React Native
   Generado a partir de las preguntas publicadas en el foro del curso.
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [
    'p1' => [
        'texto'    => '¿Con qué lenguajes se desarrollan principalmente las aplicaciones en React Native?',
        'opciones' => [
            'a' => 'Dart',
            'b' => 'Swift y Kotlin',
            'c' => 'JavaScript y TypeScript',
            'd' => 'Java y C++',
            'e' => 'Python',
        ],
        'correcta' => 'c',
        'porque'   => 'Dart es de Flutter; Swift y Kotlin son los nativos de iOS y Android. React Native escribe la app en JavaScript o TypeScript.',
    ],
    'p2' => [
        'texto'    => '¿Qué componente de React Native cumple la función que en React para web tiene el elemento <code>div</code>?',
        'opciones' => [
            'a' => 'Box',
            'b' => 'View',
            'c' => 'Container',
            'd' => 'Text',
            'e' => 'Section',
        ],
        'correcta' => 'b',
        'porque'   => '<b>View</b> es el contenedor genérico. <code>Text</code> existe pero es para texto, y en React Native el texto <i>tiene</i> que ir dentro de un <code>Text</code>.',
    ],
    'p3' => [
        'texto'    => 'De las siguientes opciones, ¿cuáles corresponden a <b>ventajas</b> de usar React Native?',
        'opciones' => [
            'a' => 'Un solo código para Android e iOS',
            'b' => 'Fast Refresh para ver los cambios al instante',
            'c' => 'Rendimiento superior al nativo puro en tareas de cómputo pesado',
            'd' => 'Gran ecosistema de librerías y comunidad',
            'e' => 'Elimina por completo la necesidad de escribir código nativo',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'b', 'd'],
        'porque'   => 'Las dos falsas son las absolutas: en cómputo pesado el nativo puro gana, y para ciertas funciones sigue haciendo falta bajar a código nativo o a un módulo que lo envuelva.',
    ],
    'p4' => [
        'texto'    => 'Dentro de la arquitectura de React Native, ¿cuál es la función principal de <b>Hermes</b>?',
        'opciones' => [
            'a' => 'Renderizar los componentes en la interfaz nativa',
            'b' => 'Ejecutar el código JavaScript optimizando el inicio y el uso de memoria',
            'c' => 'Gestionar la navegación entre pantallas',
            'd' => 'Acceder a la cámara y los sensores del dispositivo',
            'e' => 'Almacenar los datos de la aplicación',
        ],
        'correcta' => 'b',
        'porque'   => 'Hermes es el <b>motor de JavaScript</b>. Renderizar es trabajo de Fabric: no confundas los dos.',
    ],
    'p5' => [
        'texto'    => '¿Qué elemento de la nueva arquitectura de React Native se encarga de llevar los cambios de React hacia la interfaz nativa?',
        'opciones' => [
            'a' => 'Hermes',
            'b' => 'Redux',
            'c' => 'Fabric',
            'd' => 'Expo',
            'e' => 'AsyncStorage',
        ],
        'correcta' => 'c',
        'porque'   => '<b>Fabric</b> es el renderizador. Redux es estado, Expo es tooling y AsyncStorage es almacenamiento: ninguno pinta la interfaz.',
    ],
];

iniciar([], $MULTIPLE);
cabecera('React Native', 'Lenguajes, componentes, ventajas, Hermes y Fabric');
?>

<div class="card">
  <h2>React Native</h2>
  <p>Con qué se programa, qué componente hace de <code>div</code>, ventajas reales del framework, y los dos piezas de la nueva arquitectura: Hermes y Fabric.</p>
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
  <?php mc('p5'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../Jenkins/index.php');
