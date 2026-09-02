<?php
/* ==========================================================================
   CompuNet 3 / Preguntas de exposiciones / Seguridad web y DevSecOps
   Generado a partir de las preguntas publicadas en el foro del curso.
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [
    'p1' => [
        'texto'    => '¿Cuál es la diferencia clave entre <b>XSS</b> y <b>CSRF</b>?',
        'opciones' => [
            'a' => 'XSS explota que el sitio no sanitiza el contenido que muestra; CSRF explota que el navegador ya tiene una sesión activa',
            'b' => 'XSS y CSRF son exactamente el mismo tipo de ataque',
            'c' => 'CSRF inyecta código directamente en la base de datos, XSS no',
            'd' => 'XSS solo afecta al backend, CSRF solo al frontend',
        ],
        'correcta' => 'a',
        'porque'   => 'En XSS el atacante mete <i>su</i> código en tu página. En CSRF no mete nada: aprovecha que tu sesión ya está abierta para que <i>tú</i> hagas la petición sin saberlo.',
    ],
    'p2' => [
        'texto'    => '¿Por qué integrar los escaneos de seguridad dentro del pipeline de CI/CD (<b>DevSecOps</b>) es más efectivo que hacerlo manualmente?',
        'opciones' => [
            'a' => 'Porque es más barato que contratar un experto en seguridad',
            'b' => 'Porque se ejecutan automáticamente en cada cambio de código y pueden bloquear el build antes de llegar a producción',
            'c' => 'Porque elimina por completo la necesidad de actualizar dependencias',
            'd' => 'Porque reemplaza la necesidad de usar HTTPS',
        ],
        'correcta' => 'b',
        'porque'   => 'La idea es «shift left»: encontrar el fallo cuando cuesta un commit arreglarlo, no cuando ya está en producción.',
    ],
    'p3' => [
        'texto'    => '¿Cuál fue la <b>causa raíz</b> de la brecha de datos de Equifax en 2017?',
        'opciones' => [
            'a' => 'Un ataque de phishing a un empleado',
            'b' => 'Un ataque DDoS que tumbó sus servidores',
            'c' => 'Una vulnerabilidad conocida en Apache Struts que no fue parchada a tiempo, pese a existir el parche',
            'd' => 'Contraseñas débiles reutilizadas por los usuarios',
        ],
        'correcta' => 'c',
        'porque'   => 'Lo demoledor del caso: el parche <b>existía</b>. No fue un ataque sofisticado, fue no aplicarlo. Por eso encaja tan bien con el argumento de DevSecOps.',
    ],
    'p4' => [
        'texto'    => '¿Qué diferencia principal tiene un ataque <b>DDoS</b> frente a los otros vistos (SQL injection, XSS, credential stuffing)?',
        'opciones' => [
            'a' => 'Es el único que requiere acceso físico al servidor',
            'b' => 'No busca robar ni manipular información, sino saturar el sistema para que deje de responder',
            'c' => 'Solo puede ejecutarse contra bases de datos',
            'd' => 'Se previene únicamente con autenticación multifactor',
        ],
        'correcta' => 'b',
        'porque'   => 'Los otros van contra la confidencialidad o la integridad; el DDoS va contra la <b>disponibilidad</b>. Es la tercera pata de la tríada CIA.',
    ],
    'p5' => [
        'texto'    => 'Un formulario de login usa <code>dangerouslySetInnerHTML</code> en React para mostrar un mensaje de bienvenida con el nombre de usuario, sin sanitizarlo. ¿Qué riesgo introduce?',
        'opciones' => [
            'a' => 'Ninguno, React sanitiza automáticamente el contenido pase lo que pase',
            'b' => 'Abre la puerta a XSS, ya que el contenido se inserta como HTML crudo sin escapar',
            'c' => 'Hace que la aplicación sea más lenta, pero no representa un riesgo de seguridad',
            'd' => 'Solo afecta el diseño visual del componente',
        ],
        'correcta' => 'b',
        'porque'   => 'React escapa todo por defecto: por eso esa función se llama literalmente «dangerously». Al usarla renuncias justo a esa protección.',
    ],
];

iniciar([], $MULTIPLE);
cabecera('Seguridad web y DevSecOps', 'XSS, CSRF, DDoS, el caso Equifax y escaneos en el pipeline');
?>

<div class="card">
  <h2>Seguridad web y DevSecOps</h2>
  <p>La diferencia real entre XSS y CSRF, por qué la seguridad va dentro del pipeline, qué pasó en Equifax y el peligro de <code>dangerouslySetInnerHTML</code>.</p>
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
pie('../Flask/index.php', '../Flutter/index.php');
