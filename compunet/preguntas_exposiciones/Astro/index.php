<?php
/* ==========================================================================
   CompuNet 3 / Preguntas de exposiciones / Astro
   Generado a partir de las preguntas publicadas en el foro del curso.
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [
    'p1' => [
        'texto'    => '¿Cuáles son razones válidas para elegir una plataforma <b>todo-en-uno</b> (Wix, Webflow) en lugar de un stack Astro + Contentful?',
        'opciones' => [
            'a' => 'El equipo no cuenta con desarrolladores disponibles para construir y mantener un frontend',
            'b' => 'Se necesita lanzar el sitio en cuestión de horas, sin tiempo para desarrollo',
            'c' => 'El sitio requiere un sistema de diseño completamente personalizado, no basado en plantillas',
            'd' => 'El rendimiento y el SEO son una ventaja competitiva crítica para el negocio',
            'e' => 'No hay requisitos específicos de rendimiento ni de diseño propio',
            'f' => 'Se anticipa escalar el sitio con funcionalidad a medida (paneles internos, integraciones)',
            'g' => 'El presupuesto favorece un gasto recurrente y predecible (suscripción) sobre una inversión inicial de desarrollo',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'b', 'e', 'g'],
        'porque'   => 'C, D y F son justo los argumentos <b>a favor</b> de Astro: diseño propio, rendimiento como ventaja competitiva y margen para crecer a medida.',
    ],
    'p2' => [
        'texto'    => '¿Por qué la <b>arquitectura de islas</b> no es la mejor opción para un dashboard con datos en tiempo real?',
        'opciones' => [
            'a' => 'La mayoría de los widgets de un dashboard necesitan ser interactivos, lo que reduce la ventaja de HTML estático por defecto',
            'b' => 'Sincronizar estado compartido entre muchas islas independientes añade una complejidad que un framework SPA ya resuelve de forma nativa',
            'c' => 'Astro no permite usar directivas <code>client:*</code> en más de un componente por página',
            'd' => 'Un dashboard en tiempo real termina requiriendo casi tanto JavaScript en el cliente como una SPA tradicional',
            'e' => 'Las islas de servidor (<code>server:defer</code>) están diseñadas específicamente para reemplazar los websockets',
            'f' => 'La arquitectura de islas obliga a recargar toda la página cada vez que cambia un dato',
            'g' => 'Cada isla se hidrata de forma aislada, lo que dificulta compartir un mismo estado en tiempo real entre varios widgets',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'b', 'd', 'g'],
        'porque'   => 'C, E y F son falsedades técnicas sobre Astro. El argumento real es que si <i>todo</i> es isla, ya no estás ganando nada frente a una SPA.',
    ],
    'p3' => [
        'texto'    => '¿En qué casos conviene usar <b>Content Collections</b> en lugar de un CMS headless externo como Contentful?',
        'opciones' => [
            'a' => 'El contenido lo gestiona directamente el equipo de desarrollo, sin necesidad de un flujo editorial separado',
            'b' => 'Se quiere evitar el costo adicional de un plan de pago de un CMS externo a partir de cierto volumen',
            'c' => 'El contenido necesita ser editado por un equipo de marketing sin conocimientos técnicos',
            'd' => 'Se requiere que el contenido se actualice sin necesidad de un nuevo build del sitio',
            'e' => 'El proyecto ya tiene una integración configurada con Contentful y no se quiere duplicar contenido',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'b'],
        'porque'   => 'C y D son exactamente para lo que existe un CMS headless: editores no técnicos y publicar sin rebuild. E es un argumento para quedarse donde estás.',
    ],
];

iniciar([], $MULTIPLE);
cabecera('Astro', 'Cuándo NO usarlo, arquitectura de islas y Content Collections');
?>

<div class="card">
  <h2>Astro</h2>
  <p>Las tres preguntas de la exposición sobre cuándo conviene una plataforma todo-en-uno, por qué las islas no sirven para un dashboard en tiempo real, y Content Collections frente a un CMS externo.</p>
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
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Flutter/index.php', '../Go/index.php');
