<?php
/* ==========================================================================
   CiberSeguridad / Normas  —  SOX, ISO 27001/27002 y casos de clase
   Fuente: notas_2.pdf (seccion "clase") + ampliacion verificada
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- ISO --- */
    1  => ['iso 27001', '27001', 'iso/iec 27001'],
    2  => ['iso 27002', '27002', 'iso/iec 27002'],
    3  => ['sgsi', 'isms', 'sistema de gestion de la seguridad de la informacion'],
    4  => ['93'],
    5  => ['4', 'cuatro'],

    /* --- SOX --- */
    6  => ['sarbanes-oxley', 'sarbanes oxley', 'sox', 'ley sarbanes-oxley'],
    7  => ['2002'],

    /* --- casos --- */
    8  => ['rootkit'],
    9  => ['sony bmg', 'sony'],
    10 => ['mirai'],
    11 => ['botnet', 'red de bots'],
    12 => ['iot', 'internet de las cosas', 'internet of things'],
    13 => ['credenciales por defecto', 'contraseñas por defecto', 'credenciales de fabrica',
           'claves por defecto', 'usuario y contraseña por defecto'],
    14 => ['dns'],
    15 => ['disponibilidad', 'availability'],
];

$TEXTO = range(1, 15);

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
    ],
    'm3' => [
        'texto'    => 'La ley <b>SOX</b> (Sarbanes-Oxley) nace en 2002 a raiz de escandalos contables como Enron. &iquest;Que exige, en lo que toca a TI?',
        'opciones' => [
            'a' => 'Cifrar todos los correos de la empresa',
            'b' => 'Controles internos sobre la <b>informacion financiera</b>, incluidos los sistemas que la producen: registros integros, auditables y no alterables',
            'c' => 'Contratar un hacker etico cada año',
            'd' => 'Prohibir el uso de la nube'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el ejemplo tipico de <b>integridad</b> y <b>no repudio</b> convertidos en obligacion legal: los registros contables deben ser fiables y quedar rastro de quien los toco.'
    ],
    'm4' => [
        'texto'    => 'Sony BMG (2005) metio en sus CD de musica un software de proteccion anticopia que se <b>ocultaba</b> en el sistema con tecnicas de rootkit. &iquest;Por que fue un desastre de seguridad?',
        'opciones' => [
            'a' => 'Porque los CD sonaban mal',
            'b' => 'Porque usaba las mismas tecnicas de ocultamiento que el malware, y otros atacantes las aprovecharon para <b>esconder sus propios virus</b> en los equipos afectados',
            'c' => 'Porque borraba la musica del disco duro',
            'd' => 'Porque enviaba las canciones a la competencia'
        ],
        'correcta' => 'b',
        'porque'   => 'A los pocos dias aparecieron troyanos que se escondian detras del mecanismo de Sony. Moraleja: un control instalado sin consentimiento del dueño del equipo <b>es</b> una amenaza.'
    ],
    'm5' => [
        'texto'    => '&iquest;Que hacia especial al malware <b>Mirai</b> (2016)?',
        'opciones' => [
            'a' => 'Cifraba archivos y pedia rescate',
            'b' => 'Infectaba <b>dispositivos IoT</b> (camaras, routers, grabadoras) que seguian con el usuario y la contraseña de fabrica, y los unia en una botnet para lanzar DDoS',
            'c' => 'Robaba tarjetas de credito de tiendas online',
            'd' => 'Se propagaba por USB'
        ],
        'correcta' => 'b',
        'porque'   => 'No exploto ninguna vulnerabilidad sofisticada: simplemente probo listas de credenciales por defecto. El codigo publicado traia las de mas de 60 modelos de dispositivo.'
    ],
    'm6' => [
        'texto'    => 'En octubre de 2016 Mirai tumbo a <b>Dyn</b>, un proveedor de DNS, y con el se cayeron Twitter, Amazon, GitHub y el New York Times. &iquest;Que principio de la triada se vio afectado?',
        'opciones' => [
            'a' => 'Confidencialidad',
            'b' => 'Integridad',
            'c' => 'Disponibilidad',
            'd' => 'No repudio'
        ],
        'correcta' => 'c',
        'porque'   => 'No se robo ni se altero informacion: simplemente nadie podia llegar a ella. Un DDoS es el ataque a la disponibilidad por excelencia.'
    ],
    'm7' => [
        'texto'    => 'En el caso Mirai, &iquest;cual fue la <b>vulnerabilidad</b> y cual el <b>vector de ataque</b>?',
        'opciones' => [
            'a' => 'Vulnerabilidad: las credenciales de fabrica sin cambiar. Vector: el acceso remoto (telnet) abierto a internet',
            'b' => 'Vulnerabilidad: el DNS de Dyn. Vector: el correo electronico',
            'c' => 'Vulnerabilidad: los usuarios de Twitter. Vector: un USB',
            'd' => 'No hubo vulnerabilidad, fue fuerza bruta pura'
        ],
        'correcta' => 'a',
        'porque'   => 'Practica de la pagina anterior: la <b>vulnerabilidad</b> es la debilidad (contraseña por defecto), el <b>vector</b> es por donde entra, el <b>payload</b> es el bot que lanza el DDoS y el <b>objetivo</b> final fue Dyn.'
    ],
    'm8' => [
        'texto'    => 'Aplicando lo de riesgo inherente y residual: cambias la contraseña de fabrica de tus camaras. &iquest;Que pasa con el riesgo?',
        'opciones' => [
            'a' => 'Se elimina por completo',
            'b' => 'Baja del inherente al residual, pero <b>no llega a cero</b>: sigue habiendo firmware sin parchar, claves debiles, dias cero',
            'c' => 'No cambia nada',
            'd' => 'Sube, porque puedes olvidar la nueva contraseña'
        ],
        'correcta' => 'b',
        'porque'   => 'El control reduce el riesgo, no lo borra. Ese remanente es exactamente el riesgo residual.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('4 · Normas y casos', 'ISO 27001/27002 · SOX · Sony BMG · Mirai');
?>

<div class="card">
  <h2>Aviso sobre esta pagina</h2>
  <p>En tus apuntes la seccion <em>clase</em> son cuatro apuntes sueltos:
     <code>Ley: SOX. Sarbanes-Oxley</code>, la diferencia entre ISO 27001 y 27002,
     <code>Sony bmg: root kit scandal</code> y <code>mirai</code>. Sin desarrollar.</p>
  <div class="nota">Las preguntas marcadas con <b>&#9432; ampliacion</b> no salen literales de los
    apuntes: las complete con las fuentes oficiales (NIST, ISO, CISA) para que los cuatro nombres
    signifiquen algo. La definicion de ISO 27001 vs 27002 si es la de tus notas, palabra por palabra.</div>
</div>


<div class="card">
  <h2>1. ISO 27001 e ISO 27002</h2>
  <p>La frase de tus apuntes, con huecos:</p>
  <p><em>La norma <?php hueco(1, 12); ?> establece el estandar internacional para la
     <b>gestion</b> de la seguridad de la informacion, mientras que la
     <?php hueco(2, 12); ?> es un estandar complementario que <b>guia la implementacion</b>
     de los controles de seguridad de la informacion.</em></p>

  <p>El sistema que la 27001 te obliga a montar se llama, por sus siglas,
     <?php hueco(3, 10); ?> (Sistema de Gestion de la Seguridad de la Informacion).</p>

  <p><b>&#9432; ampliacion:</b> en la revision de 2022 el catalogo de controles se reorganizo.</p>
  <table class="datos">
    <tr><th>Version 2022</th><th>cantidad</th></tr>
    <tr><td>Controles en total (antes eran 114)</td><td><?php hueco(4, 6); ?></td></tr>
    <tr><td>Temas en que se agrupan (organizativo, personas, fisico, tecnologico)</td><td><?php hueco(5, 6); ?></td></tr>
  </table>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. La ley SOX</h2>

  <?php linea(6, 'el nombre completo de la ley que en tus apuntes aparece como <code>SOX</code>', 'nombre de la ley...'); ?>
  <?php linea(7, '<b>&#9432; ampliacion:</b> el año en que se promulgo, tras los escandalos contables tipo Enron', 'año...'); ?>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Caso Sony BMG (2005)</h2>
  <p>Sony BMG distribuyo en unos 22 millones de CD de musica un software anticopia que
     se instalaba solo y se <b>escondia</b> del usuario y del antivirus.</p>

  <?php linea(8, 'como se llama la tecnica de ocultarse modificando el sistema operativo para no ser detectado', 'escribe el termino...'); ?>
  <?php linea(9, 'la discografica del escandalo', 'empresa...'); ?>

  <?php mc('m4'); ?>

  <div class="avisoflujo">
    <b>Por que se cuenta en clase.</b> Es el caso donde la <em>proteccion</em> se convirtio en la
    <em>amenaza</em>: al usar las mismas tecnicas que el malware, Sony le abrio la puerta a otros
    atacantes. Termino en retirada de discos, demandas colectivas y un acuerdo con la FTC.
  </div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Caso Mirai (2016)</h2>

  <?php linea(10, 'el nombre del malware', 'nombre...'); ?>
  <?php linea(11, 'el nombre de una red de dispositivos infectados y controlados a distancia', 'escribe el termino...'); ?>
  <?php linea(12, 'la sigla del tipo de dispositivos que infectaba: camaras, routers, grabadoras', 'sigla o nombre...'); ?>
  <?php linea(13, '<b>&#9432; ampliacion:</b> la debilidad que aprovechaba en esos dispositivos', 'la debilidad...'); ?>
  <?php ayuda('No era una vulnerabilidad sofisticada: los aparatos seguian con el usuario y la contraseña que traian de fabrica.'); ?>
  <?php linea(14, '<b>&#9432; ampliacion:</b> la sigla del servicio que presta Dyn, la empresa que tumbaron en octubre de 2016', 'sigla...'); ?>
  <?php linea(15, 'el principio de la triada que se vulnera en un DDoS', 'principio...'); ?>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php mc('m8'); ?>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Criptografia/index.php', '');
