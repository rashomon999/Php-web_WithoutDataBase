<?php
/* ==========================================================================
   CompuNet 3 / Preguntas de exposiciones / Angular y SPA
   Generado a partir de las preguntas publicadas en el foro del curso.
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [
    'p1' => [
        'texto'    => '¿Cuál de las siguientes opciones describe correctamente qué es una <b>Single Page Application (SPA)</b>?',
        'opciones' => [
            'a' => 'Una aplicación que recarga completamente la página cada vez que el usuario navega.',
            'b' => 'Una aplicación que carga una única página principal y actualiza su contenido dinámicamente sin recargar toda la página.',
            'c' => 'Una aplicación que solo puede tener una vista y no permite navegación.',
            'd' => 'Un tipo de servidor web usado exclusivamente por Angular.',
            'e' => 'Una arquitectura que requiere duplicar el código HTML para cada ruta del usuario.',
        ],
        'correcta' => 'b',
        'porque'   => '«Single page» es una sola <b>carga</b>, no una sola <b>vista</b>. La navegación existe: lo que no hay es recarga completa del documento.',
    ],
    'p2' => [
        'texto'    => '¿Qué sintaxis corresponde al <b>event binding</b> en Angular?',
        'opciones' => [
            'a' => '<code>{{ nombre }}</code>',
            'b' => '<code>[disabled]="condicion"</code>',
            'c' => '<code>(click)="hacerAlgo()"</code>',
            'd' => '<code>[(ngModel)]="valor"</code>',
            'e' => '<code>*ngIf="mostrar"</code>',
        ],
        'correcta' => 'c',
        'porque'   => 'Regla nemotécnica: llaves = interpolación, corchetes = propiedad (entra), <b>paréntesis = evento (sale)</b>, y <code>[()]</code> «banana in a box» = las dos cosas.',
    ],
    'p3' => [
        'texto'    => '¿Cuál de las siguientes <b>NO</b> es una desventaja de Angular mencionada en la exposición?',
        'opciones' => [
            'a' => 'Curva de aprendizaje pronunciada.',
            'b' => 'TypeScript obligatorio.',
            'c' => 'Arquitectura basada en componentes.',
            'd' => 'Migraciones entre versiones complicadas.',
            'e' => 'Tamaño inicial del proyecto más pesado en comparación con librerías pequeñas.',
        ],
        'correcta' => 'c',
        'porque'   => 'La arquitectura por componentes es una <b>ventaja</b> y una buena práctica. Ojo con el «NO» del enunciado: aquí se busca la que sobra.',
    ],
    'p4' => [
        'texto'    => 'En la relación <b>parent-child</b> de componentes, ¿qué mecanismo usa el componente hijo para notificar un evento al padre?',
        'opciones' => [
            'a' => '<code>@Input()</code> / <code>input()</code>',
            'b' => '<code>@Component()</code>',
            'c' => '<code>@Output()</code> / <code>output()</code>',
            'd' => '<code>@Injectable()</code>',
            'e' => '<code>@Directive()</code>',
        ],
        'correcta' => 'c',
        'porque'   => 'Los datos bajan con <code>@Input()</code> y los eventos suben con <code>@Output()</code>. Del padre al hijo entra, del hijo al padre sale.',
    ],
    'p5' => [
        'texto'    => 'Según la comparación de frameworks, ¿cuál es la principal diferencia de <b>tipo</b> entre Angular y React?',
        'opciones' => [
            'a' => 'Angular es una librería y React es un framework completo.',
            'b' => 'Angular es un framework completo y React es una librería para interfaces.',
            'c' => 'Ambos son exactamente el mismo tipo de herramienta.',
            'd' => 'Angular no permite crear interfaces de usuario.',
            'e' => 'React incluye de forma nativa la gestión de rutas y peticiones HTTP sin dependencias externas.',
        ],
        'correcta' => 'b',
        'porque'   => 'Angular trae router, HTTP e inyección de dependencias de fábrica. En React eso lo pones tú con librerías aparte.',
    ],
];

iniciar([], $MULTIPLE);
cabecera('Angular y SPA', 'Qué es una SPA, bindings, ventajas y desventajas, parent-child');
?>

<div class="card">
  <h2>Angular y SPA</h2>
  <p>Definición de SPA, las cuatro sintaxis de binding, comunicación entre componentes y en qué se diferencia Angular de React.</p>
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
pie('../Jenkins/index.php', '../Flask/index.php');
