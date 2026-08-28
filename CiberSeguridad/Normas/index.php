<?php
/* ==========================================================================
   CiberSeguridad / Normas  —  SOX, ISO 27001/27002 y casos de clase
   Fuente: notas_2.pdf (seccion "clase") + ampliacion verificada
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    1  => ['iso 27001', '27001', 'iso/iec 27001'],
    2  => ['iso 27002', '27002', 'iso/iec 27002'],
    3  => ['sgsi', 'isms', 'sistema de gestion de la seguridad de la informacion'],
 
];

$TEXTO = range(1, 5);

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Cual es la diferencia entre ISO 27001 e ISO 27002?',
        'opciones' => [
            'a' => 'La 27001 establece el estandar de gestion de la seguridad de la informacion; la 27002 es la guia complementaria de <b>como</b> implementar los controles',
            'b' => 'La 27002 es la certificable y la 27001 es la guia',
            'c' => 'Son la misma norma con dos numeraciones',
            'd' => 'La 27001 es para empresas y la 27002 para gobiernos'
        ],
        'correcta' => 'a',
        'porque'   => 'La analogia habitual: la 27001 es el <b>permiso de obra</b> que dice que hay que construir; la 27002 es el <b>manual de construccion</b> que explica como.'
    ],
    'm2' => [
        'texto'    => 'Tu empresa quiere <b>certificarse</b>. &iquest;Contra que norma la audita el auditor?',
        'opciones' => [
            'a' => 'Contra la ISO 27002',
            'b' => 'Contra la ISO 27001, porque la 27002 <b>no es certificable</b>',
            'c' => 'Contra las dos por igual',
            'd' => 'Contra ninguna, ISO no certifica'
        ],
        'correcta' => 'b',
        'porque'   => 'No existe un certificado ISO 27002. La 27002 solo orienta la implementacion; la conformidad se evalua contra la 27001.'
    ]
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('4 · Normas y casos', 'ISO 27001/27002 · SOX · Sony BMG · Mirai');
?>

<div class="card">
  <h2>1. ISO 27001 e ISO 27002</h2>
  <p>La frase de tus apuntes, con huecos:</p>
  <p><em>La norma <?php hueco(1, 12); ?> establece el estandar internacional para la
     <b>gestion</b> de la seguridad de la informacion, mientras que la
     <?php hueco(2, 12); ?> es un estandar complementario que <b>guia la implementacion</b>
     de los controles de seguridad de la informacion.</em></p>

  <p>El sistema que la 27001 te obliga a montar se llama, por sus siglas,
     <?php hueco(3, 10); ?> (Sistema de Gestion de la Seguridad de la Informacion).</p>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>

<?php
pie('../Criptografia/index.php', '');
