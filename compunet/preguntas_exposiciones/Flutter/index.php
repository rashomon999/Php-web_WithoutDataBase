<?php
/* ==========================================================================
   CompuNet 3 / Preguntas de exposiciones / Flutter
   Generado a partir de las preguntas publicadas en el foro del curso.
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [
    'p1' => [
        'texto'    => 'Una compañía te contrata para una app móvil de marketplace y pide que los usuarios entren también por web <b>manteniendo exactamente el mismo diseño visual</b>. ¿Es Flutter adecuado y por qué?',
        'opciones' => [
            'a' => 'Sí, porque Flutter usa su propio motor gráfico para dibujar cada píxel de la interfaz en lugar de usar componentes nativos, garantizando que el diseño se vea idéntico tanto en móvil como en web usando una sola base de código en Dart.',
            'b' => 'Sí, porque Flutter funciona creando un «puente» que traduce automáticamente el código a HTML y CSS para la web, y a componentes de Android/iOS para los teléfonos.',
            'c' => 'No, porque Flutter es un framework diseñado exclusivamente para compilación móvil en iOS y Android; la versión web tendría que hacerse con JavaScript u otro lenguaje.',
            'd' => 'No, porque aunque Flutter soporta web, el modelo de desarrollo requiere escribir un código en Dart para la app móvil y reescribir la interfaz desde cero para que el navegador la entienda.',
            'e' => 'Sí, porque Flutter permite reutilizar gran parte del código entre móvil y web, aunque pueden existir diferencias de adaptación según la plataforma.',
        ],
        'correcta' => 'a',
        'porque'   => 'La clave es <b>dibujar</b> en vez de <b>traducir</b>. La opción B describe justo lo que hace React Native (puente a componentes nativos), que es lo contrario.',
    ],
    'p2' => [
        'texto'    => 'Tienes que desarrollar una página web para BU que sea responsive y segura. ¿Usarías Flutter?',
        'opciones' => [
            'a' => 'No es lo ideal. Flutter es pesado para páginas web puras y dificulta que la página aparezca en los buscadores (mal SEO). Para algo como BU, es mejor usar herramientas web tradicionales (como Django o React).',
            'b' => 'Sí, porque Flutter convierte todo a código web súper ligero, haciendo que cargue muy rápido y tenga el mejor SEO.',
            'c' => 'No, porque Flutter no permite hacer diseños que se adapten a la pantalla; la página siempre se vería del tamaño de un celular.',
            'd' => 'Sí, porque Flutter es la única herramienta que encripta los datos automáticamente en el navegador web.',
            'e' => 'Sí, porque Flutter permite crear interfaces responsive y reutilizar código y tiene el mejor SEO.',
        ],
        'correcta' => 'a',
        'porque'   => 'Es la otra cara de la pregunta anterior: dibujar en un canvas da control total del pixel, pero el buscador no encuentra texto que indexar.',
    ],
    'p3' => [
        'texto'    => '¿Cuál de los siguientes <b>atributos de calidad</b> se ve especialmente favorecido por Flutter?',
        'opciones' => [
            'a' => 'Seguridad',
            'b' => 'Disponibilidad',
            'c' => 'Fiabilidad',
            'd' => 'Portabilidad',
            'e' => 'Mantenibilidad',
        ],
        'correcta' => 'd',
        'porque'   => 'Un mismo código corriendo en Android, iOS, web y escritorio es la definición de <b>portabilidad</b>.',
    ],
    'p4' => [
        'texto'    => 'Una app Flutter ocupa 49 MB en un APK con varias arquitecturas, pero solo 17 MB al generar únicamente la versión ARM64. ¿Cuál es la mejor conclusión?',
        'opciones' => [
            'a' => 'Flutter siempre genera aplicaciones de aproximadamente 50 MB.',
            'b' => 'La diferencia se debe principalmente a que el código Dart se ejecuta interpretado',
            'c' => 'El tamaño depende, entre otras cosas, de las arquitecturas incluidas y del runtime/engine de Flutter.',
            'd' => 'La diferencia demuestra que Flutter no puede utilizarse en dispositivos ARM64',
            'e' => 'La diferencia de tamaño se debe a que Flutter elimina automáticamente parte del código Dart cuando se genera una aplicación para ARM64.',
        ],
        'correcta' => 'c',
        'porque'   => 'El APK «gordo» lleva el engine compilado para cada arquitectura. Al generar uno por arquitectura, cada usuario se baja solo el suyo.',
    ],
    'p5' => [
        'texto'    => '¿Qué <b>convenciones de nomenclatura</b> se usan en proyectos Flutter/Dart?',
        'opciones' => [
            'a' => 'Clases en <code>UpperCamelCase</code>, variables y métodos en <code>lowerCamelCase</code>, y archivos o carpetas en <code>snake_case</code>.',
            'b' => 'Clases en <code>snake_case</code>, variables y métodos en <code>UpperCamelCase</code>, y archivos en <code>kebab-case</code>.',
            'c' => 'Todo el código debe usar <code>lowerCamelCase</code> para mantener la uniformidad.',
            'd' => 'Clases y métodos en <code>UPPER_SNAKE_CASE</code>, y archivos en <code>UpperCamelCase</code>.',
            'e' => 'Clases, variables, métodos y archivos siempre en <code>UpperCamelCase</code>.',
        ],
        'correcta' => 'a',
        'porque'   => 'Es la convención de casi todo lenguaje moderno, con el detalle propio de Dart: los <b>archivos</b> en snake_case (<code>mi_widget.dart</code>).',
    ],
];

iniciar([], $MULTIPLE);
cabecera('Flutter', 'Motor gráfico propio, web y SEO, atributos de calidad, tamaño y convenciones');
?>

<div class="card">
  <h2>Flutter</h2>
  <p>Por qué se ve igual en todas partes, por qué no es buena idea para una web pública, qué atributo de calidad favorece y cómo se nombran las cosas en Dart.</p>
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
pie('../SeguridadWeb/index.php', '../Astro/index.php');
