<?php
/* ==========================================================================
   CiberSeguridad / Riesgos  —  NIST, amenazas, riesgo y ataques
   Fuente: notas_2.pdf (preguntas 1 a 8)
   Estilo: definicion completa escrita, con las palabras clave en blanco.
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- 1. NIST: verbo + definicion con huecos --- */
    1  => ['identificar', 'identify'],
    2  => ['identificar que activos'],
    3  => ['valor'],
    4  => ['proteger', 'protect'],
    5  => ['controles'],
    6  => ['detectar', 'detect'],
    7  => ['monitoreo'],
    8  => ['responder', 'respond'],
    9  => ['contener'],
    10 => ['propague', 'propagar', 'extienda'],
    11 => ['recuperar', 'recover'],
    12 => ['restaurar'],
    13 => ['gobernar', 'govern'],

    /* --- 2. agentes de amenaza --- */
    14 => ['amigables', 'friendly'],
    15 => ['no amigables', 'unfriendly'],
    16 => ['naturales', 'natural'],
    17 => ['accidentalmente', 'sin querer', 'por accidente'],
    18 => ['privilegios', 'permisos'],
    19 => ['desconocimiento', 'ignorancia'],

    /* --- 3. riesgo --- */
    20 => ['antes'],
    21 => ['probabilidad'],
    22 => ['impacto'],
    23 => ['despues'],
    24 => ['controles'],
    25 => ['cero'],
    26 => ['riesgo inherente', 'inherente'],
    27 => ['riesgo residual', 'residual'],

    /* --- 4. atributos del ataque --- */
    28 => ['vector de ataque', 'attack vector'],
    29 => ['entregar'],
    30 => ['carga util', 'payload'],
    31 => ['daño', 'dano'],
    32 => ['vulnerabilidad', 'vulnerability'],
    33 => ['debilidad'],
    34 => ['objetivo', 'target'],
    35 => ['vector de entrada', 'ingress vector', 'ingress'],
    36 => ['vector de salida', 'egress vector', 'egress'],

    /* --- 5. malware --- */
    37 => ['virus'],
    38 => ['gusano', 'worm'],
    39 => ['automaticamente'],
    40 => ['troyano', 'trojan horse', 'trojan', 'caballo de troya'],
    41 => ['legitimo'],
    42 => ['ransomware'],
    43 => ['pago', 'rescate'],
    44 => ['spyware'],
    45 => ['phishing'],
    46 => ['denegacion de servicio', 'dos', 'denial of service'],
    47 => ['legitimos'],

    /* --- 6. servicios --- */
    48 => ['autenticacion', 'authentication'],
    49 => ['pasar'],
    50 => ['anonimato', 'anonymity'],
    51 => ['identidad'],
];

$TEXTO = range(1, 51);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Segun el marco del NIST tal como lo pide el taller, &iquest;en que orden van las actividades?',
        'opciones' => [
            'a' => 'Proteger, Identificar, Detectar, Recuperar, Responder',
            'b' => 'Identificar, Proteger, Detectar, Responder, Recuperar',
            'c' => 'Detectar, Responder, Identificar, Proteger, Recuperar',
            'd' => 'Identificar, Detectar, Proteger, Recuperar, Responder'
        ],
        'correcta' => 'b',
        'porque'   => 'Es una linea de tiempo: primero sabes <b>que</b> tienes, lo blindas, vigilas, reaccionas cuando pasa algo, y al final vuelves a la normalidad.'
    ],
    'm2' => [
        'texto'    => '&iquest;Por que <b>Identificar</b> va primero y no <b>Proteger</b>?',
        'opciones' => [
            'a' => 'Porque proteger es mas caro',
            'b' => 'Porque no puedes proteger algo si todavia no sabes que activos tienes ni cuales tienen valor',
            'c' => 'Porque el NIST lo ordeno alfabeticamente',
            'd' => 'Porque identificar es opcional'
        ],
        'correcta' => 'b',
        'porque'   => 'Es literal en los apuntes: &laquo;es necesario saber que informacion, sistemas o recursos tienen valor <b>antes</b> de aplicar medidas de seguridad&raquo;.'
    ],
    'm3' => [
        'texto'    => 'Un empleado borra por accidente una carpeta importante. &iquest;Que tipo de agente de amenaza es?',
        'opciones' => [
            'a' => 'No amigable, porque causo daño',
            'b' => 'Amigable, porque el daño fue accidental y viene desde dentro sin intencion maliciosa',
            'c' => 'Natural',
            'd' => 'No es un agente de amenaza'
        ],
        'correcta' => 'b',
        'porque'   => '&laquo;Amigable&raquo; no significa inofensivo: significa <b>sin intencion de hacer daño</b>. Empleados, administradores y usuarios comunes entran aqui.'
    ],
    'm4' => [
        'texto'    => '&iquest;Cual es la relacion correcta entre riesgo inherente y riesgo residual?',
        'opciones' => [
            'a' => 'El residual es el riesgo antes de los controles y el inherente el de despues',
            'b' => 'El inherente es el riesgo <b>antes</b> de aplicar controles; el residual es el que <b>queda despues</b>',
            'c' => 'Son lo mismo con distinto nombre',
            'd' => 'El residual siempre es cero si los controles son buenos'
        ],
        'correcta' => 'b',
        'porque'   => 'Y el remate que cae en el parcial: <b>el riesgo nunca llega a cero</b>, solo se reduce o se mitiga. Siempre queda residual.'
    ],
    'm5' => [
        'texto'    => 'Un correo falso lleva un adjunto que cifra los archivos del contador. En la anatomia del ataque, el <b>correo</b> es...',
        'opciones' => [
            'a' => 'El payload',
            'b' => 'El vector de ataque',
            'c' => 'La vulnerabilidad',
            'd' => 'El objetivo'
        ],
        'correcta' => 'b',
        'porque'   => 'El vector es el <b>vehiculo</b> que entrega la carga. El payload es lo que hace el daño (aqui, el cifrado de los archivos).'
    ],
    'm6' => [
        'texto'    => 'En esa misma analogia del misil, &iquest;que es el <b>payload</b>?',
        'opciones' => [
            'a' => 'El misil que vuela',
            'b' => 'La parte del ataque que causa el daño: el explosivo, el codigo que roba o destruye la informacion',
            'c' => 'El radar que lo detecta',
            'd' => 'La debilidad del blindaje'
        ],
        'correcta' => 'b',
        'porque'   => 'Vector = como llega. Payload = que hace cuando llega. Vulnerabilidad = por donde entra. Objetivo = a que le apunta.'
    ],
    'm7' => [
        'texto'    => '&iquest;Cual es la diferencia entre un <b>virus</b> y un <b>gusano</b>?',
        'opciones' => [
            'a' => 'No hay diferencia',
            'b' => 'El virus necesita copiarse dentro de archivos; el gusano se replica y se propaga <b>solo</b> por la red',
            'c' => 'El gusano solo afecta a Linux',
            'd' => 'El virus cifra archivos y el gusano los borra'
        ],
        'correcta' => 'b',
        'porque'   => 'La palabra clave del gusano es <b>automaticamente</b>: no necesita que nadie abra nada para propagarse.'
    ],
    'm8' => [
        'texto'    => 'Un programa que parece un instalador legitimo pero trae codigo malicioso dentro es un...',
        'opciones' => [
            'a' => 'Gusano',
            'b' => 'Troyano',
            'c' => 'Ransomware',
            'd' => 'Spyware'
        ],
        'correcta' => 'b',
        'porque'   => 'El nombre lo dice todo: el caballo de Troya entra porque lo dejas entrar.'
    ],
    'm9' => [
        'texto'    => '&iquest;Para que sirve el servicio de <b>autenticacion</b>?',
        'opciones' => [
            'a' => 'Para ocultar quien eres',
            'b' => 'Para demostrarle a un sistema quien eres, y evitar que otra persona se haga pasar por ti',
            'c' => 'Para cifrar los mensajes',
            'd' => 'Para asegurar que el sistema este disponible'
        ],
        'correcta' => 'b',
        'porque'   => 'El ejemplo de los apuntes: el banco necesita verificar que quien entra a la cuenta es de verdad el dueño.'
    ],
    'm10' => [
        'texto'    => '&iquest;Cual de estos es un buen ejemplo del servicio de <b>anonimato</b>?',
        'opciones' => [
            'a' => 'Un canal de denuncias donde un empleado reporta corrupcion sin revelar su identidad',
            'b' => 'Una contraseña de 20 caracteres',
            'c' => 'Un backup diario de la base de datos',
            'd' => 'Un antivirus actualizado'
        ],
        'correcta' => 'a',
        'porque'   => 'Anonimato = ocultar <b>quien</b> hizo la accion, no la accion en si. Los ejemplos del video eran el voto electronico y las transacciones tipo Bitcoin.'
    ],
    'm11' => [
        'texto'    => 'Autenticacion y anonimato parecen contrarios. &iquest;Como conviven en el voto electronico?',
        'opciones' => [
            'a' => 'No conviven, hay que elegir uno',
            'b' => 'Se autentica que tienes <b>derecho a votar</b>, pero se desliga tu identidad del voto que emitiste',
            'c' => 'El anonimato reemplaza a la autenticacion',
            'd' => 'Se autentica despues de votar'
        ],
        'correcta' => 'b',
        'porque'   => 'Son dos preguntas distintas: &laquo;&iquest;puedes votar?&raquo; y &laquo;&iquest;que votaste?&raquo;. El sistema responde la primera y olvida la segunda.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('2 · Riesgo, amenazas y ataques', 'notas_2 — definiciones con huecos');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>La segunda lectura pasa de las definiciones al <b>oficio</b>: que hace un profesional
     de ciberseguridad, quien te ataca, como se mide el riesgo y como se descompone un ataque.</p>
</div>


<div class="card">
  <h2>1. Las cinco actividades del marco NIST</h2>
  <p>Cada una con su definicion. Rellena el verbo y las palabras clave.</p>

  <p><b>1&ordm;</b> <?php hueco(1, 13); ?> —
       <?php hueco(2, 24); ?> se quieren proteger. Es necesario saber
     que informacion, sistemas o recursos tienen <?php hueco(3, 8); ?>
     antes de aplicar medidas de seguridad.</p>

  <p><b>2&ordm;</b> <?php hueco(4, 13); ?> —
     establecer <?php hueco(5, 12); ?> , medidas y actividades para proteger
     los activos identificados.</p>

  <p><b>3&ordm;</b> <?php hueco(6, 13); ?> —
     mantener <?php hueco(7, 12); ?> constante para descubrir ataques o eventos
     que puedan afectar los sistemas.</p>

  <p><b>4&ordm;</b> <?php hueco(8, 13); ?> —
     tomar acciones para <?php hueco(9, 11); ?> y mitigar un ataque, evitando
     que se <?php hueco(10, 11); ?> mas.</p>

  <p><b>5&ordm;</b> <?php hueco(11, 13); ?> —
     <?php hueco(12, 12); ?> los sistemas despues de un ataque y asegurar que
     vuelvan a funcionar correctamente.</p>

  <?php enviar(); ?>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>

  <div class="avisoflujo">
    <b>Ojo con la version.</b> Las cinco de arriba son las del <b>CSF 1.1</b>, que es lo que
    pide tu taller. En 2024 el NIST publico el <b>CSF 2.0</b>, que añadio una <b>sexta</b>
    funcion en el centro de la rueda, dedicada a la estrategia, las politicas, los roles y
    la supervision del riesgo: <?php hueco(13, 12); ?> .
    Si en el parcial preguntan &laquo;cinco&raquo;, responde las cinco; si preguntan por la
    version actual, son seis.
  </div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Agentes de amenaza</h2>
  <p>El video divide las fuentes de amenaza en tres familias:</p>

  <p>Las <?php hueco(14, 14); ?> son las de dentro que hacen daño
     <?php hueco(17, 16); ?> ; las <?php hueco(15, 14); ?>
     atacan a proposito; y las <?php hueco(16, 12); ?> son los terremotos,
     incendios e inundaciones.</p>

  <table class="datos">
    <tr><th>Amigables (friendly)</th><th>por que hacen daño</th></tr>
    <tr><td>Empleados</td><td>borran o comparten archivos por accidente</td></tr>
    <tr><td>Administradores de sistemas</td><td>tienen <?php hueco(18, 13); ?> altos: un error suyo tumba sistemas enteros</td></tr>
    <tr><td>Usuarios comunes</td><td>abren enlaces maliciosos por <?php hueco(19, 16); ?></td></tr>
  </table>
  <table class="datos">
    <tr><th>No amigables (unfriendly)</th><th>que buscan</th></tr>
    <tr><td>Hackers</td><td>acceder a sistemas sin autorizacion</td></tr>
    <tr><td>Ciberdelincuentes</td><td>robar informacion o dinero</td></tr>
    <tr><td>Creadores de malware</td><td>desarrollar el software con el que se ataca</td></tr>
  </table>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Riesgo inherente y riesgo residual</h2>

  <p>El <b>riesgo inherente</b> es el riesgo que existe <?php hueco(20, 9); ?>
     de aplicar controles de seguridad. Depende de la <?php hueco(21, 13); ?>
     de que ocurra una amenaza y del <?php hueco(22, 9); ?>
     que tendria sobre el activo.</p>

  <p>El <b>riesgo residual</b> es el riesgo que permanece <?php hueco(23, 9); ?>
     de aplicar <?php hueco(24, 12); ?> para reducir el riesgo inicial.
     El riesgo nunca puede llegar completamente a <?php hueco(25, 7); ?> ;
     solamente puede reducirse o mitigarse.</p>

  <table class="datos">
    <tr><th>Momento</th><th>Nombre</th></tr>
    <tr><td>Antes de los controles</td><td><?php hueco(26, 18); ?></td></tr>
    <tr><td>Lo que queda despues</td><td><?php hueco(27, 18); ?></td></tr>
  </table>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Anatomia de un ataque</h2>
  <p>Cuatro atributos principales, cada uno con su definicion.</p>

  <p>El <?php hueco(28, 18); ?> es el metodo o vehiculo utilizado para
     <?php hueco(29, 10); ?> la carga maliciosa (por ejemplo, un correo electronico
     o un enlace).</p>

  <p>La <?php hueco(30, 14); ?> es la parte del ataque que causa el
     <?php hueco(31, 8); ?> : codigo malicioso, robo o destruccion de informacion.</p>

  <p>La <?php hueco(32, 16); ?> es la <?php hueco(33, 11); ?>
     del sistema que el atacante aprovecha para realizar el ataque.</p>

  <p>El <?php hueco(34, 12); ?> es el activo o sistema que el atacante quiere afectar.</p>

  <p>Ademas existen dos caminos: el <?php hueco(35, 18); ?>
     es el que se usa para entrar al sistema, y el <?php hueco(36, 18); ?>
     es el que se usa para extraer informacion de el.</p>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Tipos de malware y de ataque</h2>

  <p>Un <?php hueco(37, 10); ?> es un programa malicioso que se copia y puede
     dañar o modificar archivos.</p>

  <p>Un <?php hueco(38, 10); ?> es malware que se replica y se propaga
     <?php hueco(39, 16); ?> por redes.</p>

  <p>Un <?php hueco(40, 12); ?> es un programa que parece
     <?php hueco(41, 10); ?> pero contiene codigo malicioso.</p>

  <p>El <?php hueco(42, 13); ?> es malware que cifra o bloquea la informacion
     y exige un <?php hueco(43, 8); ?> para recuperarla.</p>

  <p>El <?php hueco(44, 11); ?> es software que recopila informacion del usuario
     sin autorizacion.</p>

  <p>El <?php hueco(45, 11); ?> es la tecnica de engaño en la que el atacante
     obtiene informacion mediante mensajes o sitios falsos.</p>

  <p>La <?php hueco(46, 24); ?> es el ataque cuyo objetivo es impedir que
     los usuarios <?php hueco(47, 11); ?> puedan acceder a un servicio.</p>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Dos servicios que se contraponen</h2>

  <p>La <?php hueco(48, 15); ?> es util porque permite demostrarle a un sistema
     quien eres, y evita que otra persona pueda hacerse <?php hueco(49, 8); ?>
     por ti. Por ejemplo, un banco necesita verificar que quien intenta acceder a una cuenta
     realmente es su dueño.</p>

  <p>El servicio de <?php hueco(50, 12); ?> es util cuando se necesita ocultar la
     <?php hueco(51, 11); ?> de una persona que realiza una accion o transaccion.
     Ejemplos: el voto electronico, las transacciones tipo Bitcoin y los canales de denuncia interna.</p>

  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Fundamentos/index.php', '../Criptografia/index.php');
