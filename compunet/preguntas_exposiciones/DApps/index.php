<?php
/* ==========================================================================
   CompuNet 3 / Preguntas de exposiciones / dApps — preguntas de la exposición
   Generado a partir de las preguntas publicadas en el foro del curso.
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [
    'p1' => [
        'texto'    => '¿Cuál es una característica fundamental que diferencia a una <b>dApp</b> de una aplicación tradicional?',
        'opciones' => [
            'a' => 'Su interfaz siempre debe estar desarrollada en Solidity.',
            'b' => 'Su lógica puede ejecutarse mediante contratos inteligentes en una blockchain.',
            'c' => 'No necesita conexión con ninguna red para funcionar.',
            'd' => 'Toda su información debe almacenarse únicamente en el computador del usuario.',
            'e' => 'Solo puede utilizarse para realizar transacciones con criptomonedas.',
        ],
        'correcta' => 'b',
        'porque'   => 'Solidity es para los contratos, no para la interfaz: el frontend sigue siendo React, Vue o lo que quieras.',
    ],
    'p2' => [
        'texto'    => '¿Cuáles de las siguientes afirmaciones describen correctamente la <b>descentralización</b>?',
        'opciones' => [
            'a' => 'El control no está concentrado en un único servidor o autoridad.',
            'b' => 'La información puede distribuirse entre múltiples nodos de la red.',
            'c' => 'Las actividades registradas pueden ser verificadas y revisadas.',
            'd' => 'Una única entidad tiene el control absoluto sobre todas las operaciones.',
            'e' => 'Reduce la dependencia de un único punto de control.',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'b', 'c', 'e'],
        'porque'   => 'La D es la definición de lo <b>centralizado</b>: está puesta ahí como trampa.',
    ],
    'p3' => [
        'texto'    => 'En la arquitectura de una dApp, ¿cuál es la función principal de un <b>smart contract</b>?',
        'opciones' => [
            'a' => 'Diseñar la interfaz gráfica que observa el usuario.',
            'b' => 'Almacenar únicamente imágenes y archivos multimedia.',
            'c' => 'Definir y ejecutar reglas o acciones cuando se cumplen determinadas condiciones.',
            'd' => 'Reemplazar completamente la blockchain por un servidor tradicional.',
            'e' => 'Permitir que el usuario navegue por Internet sin conexión.',
        ],
        'correcta' => 'c',
        'porque'   => 'El «si X entonces Y» de la exposición. El contrato es la lógica de negocio, no la vista ni el almacenamiento de archivos.',
    ],
    'p4' => [
        'texto'    => '¿Cuáles de las siguientes pueden considerarse <b>limitaciones</b> de las dApps?',
        'opciones' => [
            'a' => 'Problemas de escalabilidad.',
            'b' => 'Costos asociados a algunas transacciones.',
            'c' => 'Mayor complejidad para nuevos usuarios debido al uso de wallets y otros componentes.',
            'd' => 'Posibles vulnerabilidades o errores en los smart contracts.',
            'e' => 'Eliminación total de cualquier riesgo de seguridad.',
        ],
        'multiple'  => true,
        'correctas' => ['a', 'b', 'c', 'd'],
        'porque'   => 'La E no es una limitación sino un imposible: nada elimina «totalmente» el riesgo, y menos un contrato inmutable que no puedes parchear.',
    ],
];

iniciar([], $MULTIPLE);
cabecera('dApps — preguntas de la exposición', 'Qué la diferencia de una app normal, descentralización, smart contracts y limitaciones');
?>

<div class="card">
  <h2>dApps — preguntas de la exposición</h2>
  <p>Las cuatro preguntas planteadas en la exposición de dApps. Si quieres el temario completo con huecos, está en <b>dApps — Cuestionarios</b>.</p>
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
pie('../Go/index.php', '');
