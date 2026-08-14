<?php
/* ==========================================================================
   CiberSeguridad / Fundamentos  —  CIA y no repudio
   Fuente: notas_1.pdf (Tab 1) y notas_2.pdf (pregunta 2)
   Estilo: la definicion completa escrita, con las palabras clave en blanco.
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- 1. Ciberseguridad --- */
    1  => ['proteccion'],
    2  => ['activos'],
    3  => ['informacion'],
    4  => ['amenazas'],
    5  => ['procesada'],
    6  => ['almacenada'],
    7  => ['transportada'],
    8  => ['interconectados'],

    /* --- 2. Confidencialidad --- */
    9  => ['proteccion'],
    10 => ['acceso'],
    11 => ['divulgacion'],
    12 => ['autorizados'],
    13 => ['autorizadas'],
    14 => ['sensible'],

    /* --- 3. Disponibilidad --- */
    15 => ['acceso'],
    16 => ['oportuno'],
    17 => ['confiable'],
    18 => ['autorizados'],
    19 => ['necesitan'],

    /* --- 4. Integridad --- */
    20 => ['proteccion'],
    21 => ['modificacion', 'modificaciones'],
    22 => ['autorizada', 'autorizadas'],
    23 => ['precisa'],
    24 => ['completa'],
    25 => ['confiable'],

    /* --- 5. No repudio --- */
    26 => ['garantia'],
    27 => ['negar'],
    28 => ['enviado'],
    29 => ['recibido'],
    30 => ['autentico', 'genuino'],
    31 => ['firmas digitales', 'firma digital'],
    32 => ['registros de transacciones', 'registro de transacciones'],

    /* --- dado el ataque, el principio --- */
    33 => ['confidencialidad'],
    34 => ['integridad'],
    35 => ['disponibilidad'],
    36 => ['no repudio'],

    /* --- 6. infosec vs ciberseguridad --- */
    37 => ['subconjunto'],
    38 => ['digital', 'digitalmente'],
    39 => ['papel'],
    40 => ['seguridad de la informacion'],
    41 => ['ciberseguridad'],
];

/* todas son texto: no importan mayusculas ni tildes */
$TEXTO = range(1, 41);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Un atacante lee la nomina de la empresa sin permiso, pero no cambia nada. &iquest;Que principio se rompio?',
        'opciones' => [
            'a' => 'Integridad',
            'b' => 'Confidencialidad',
            'c' => 'Disponibilidad',
            'd' => 'No repudio'
        ],
        'correcta' => 'b',
        'porque'   => 'Confidencialidad = proteger la informacion del <b>acceso o divulgacion</b> no autorizados. Como no modifico nada, la integridad sigue intacta.'
    ],
    'm2' => [
        'texto'    => 'Un empleado altera las cifras de un reporte financiero. &iquest;Que principio se rompio?',
        'opciones' => [
            'a' => 'Confidencialidad',
            'b' => 'Disponibilidad',
            'c' => 'Integridad',
            'd' => 'Anonimato'
        ],
        'correcta' => 'c',
        'porque'   => 'Integridad = proteger la informacion de la <b>modificacion</b> no autorizada, para que siga siendo precisa, completa y confiable.'
    ],
    'm3' => [
        'texto'    => 'Un ataque tumba el portal del banco y nadie puede entrar durante seis horas. La informacion no se filtro ni se altero. &iquest;Que principio se rompio?',
        'opciones' => [
            'a' => 'Disponibilidad',
            'b' => 'Confidencialidad',
            'c' => 'Integridad',
            'd' => 'Ninguno, no hubo robo'
        ],
        'correcta' => 'a',
        'porque'   => 'Disponibilidad = acceso <b>oportuno y confiable</b> a la informacion y a los sistemas cuando los usuarios autorizados los necesitan. Un DoS ataca exactamente esto.'
    ],
    'm4' => [
        'texto'    => 'Alguien firma digitalmente un contrato y despues dice que el no lo envio. La firma prueba que si fue el. &iquest;Que servicio esta actuando?',
        'opciones' => [
            'a' => 'Confidencialidad',
            'b' => 'Disponibilidad',
            'c' => 'No repudio',
            'd' => 'Integridad'
        ],
        'correcta' => 'c',
        'porque'   => 'No repudio = la garantia de que una persona <b>no puede negar</b> haber enviado o recibido informacion. Se implementa con firmas digitales y registros de transacciones.'
    ],
    'm5' => [
        'texto'    => 'Segun los apuntes, &iquest;cual de estas afirmaciones es la correcta?',
        'opciones' => [
            'a' => 'La ciberseguridad y la seguridad de la informacion son sinonimos',
            'b' => 'La ciberseguridad es un <b>subconjunto</b> de la seguridad de la informacion',
            'c' => 'La seguridad de la informacion es un subconjunto de la ciberseguridad',
            'd' => 'Son disciplinas independientes que no se solapan'
        ],
        'correcta' => 'b',
        'porque'   => 'La seguridad de la informacion protege <b>toda</b> la informacion (papel, digital, e incluso la que esta en la cabeza de las personas). La ciberseguridad se concentra en la informacion digital.'
    ],
    'm6' => [
        'texto'    => 'Un expediente medico impreso guardado en un archivador con llave. &iquest;Que lo protege?',
        'opciones' => [
            'a' => 'Solo la ciberseguridad',
            'b' => 'La seguridad de la informacion, porque no es informacion digital',
            'c' => 'Ninguna de las dos, el papel no cuenta',
            'd' => 'Las dos por igual'
        ],
        'correcta' => 'b',
        'porque'   => 'Es justo el ejemplo que separa los dos terminos: papel = seguridad de la informacion, no ciberseguridad.'
    ],
    'm7' => [
        'texto'    => 'En la definicion de ciberseguridad, la informacion se protege en tres estados. &iquest;Cuales son?',
        'opciones' => [
            'a' => 'Creada, leida y borrada',
            'b' => 'Procesada, almacenada y transportada',
            'c' => 'Publica, privada y secreta',
            'd' => 'Cifrada, firmada y respaldada'
        ],
        'correcta' => 'b',
        'porque'   => '&laquo;...amenazas a la informacion que es <b>procesada, almacenada y transportada</b> por sistemas de informacion interconectados&raquo;. Cae tal cual en el parcial.'
    ],
    'm8' => [
        'texto'    => 'Confidencialidad e integridad se confunden. &iquest;Cual es la diferencia en una linea?',
        'opciones' => [
            'a' => 'Confidencialidad se rompe cuando alguien <b>ve</b> lo que no debe; integridad cuando alguien <b>cambia</b> lo que no debe',
            'b' => 'Confidencialidad es para datos digitales e integridad para papel',
            'c' => 'Confidencialidad es tecnica e integridad es legal',
            'd' => 'Son lo mismo visto desde dos angulos'
        ],
        'correcta' => 'a',
        'porque'   => 'Un atacante puede leer sin cambiar (rompe C), cambiar sin leer (rompe I), o las dos. Son independientes.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('1 · Fundamentos: CIA y no repudio', 'notas_1 (Tab 1) — definiciones con huecos');
?>

<div class="card">
  <h2>Como se usa</h2>
  <p>Cada definicion esta escrita <b>completa</b>, con las palabras clave en blanco. La idea no es
     adivinar: es leer la frase entera hasta que las palabras que faltan salgan solas.</p>
  <div class="nota">
    No importan mayusculas ni tildes: <code>proteccion</code> = <code>Protección</code>.
    Pulsa <b>Enter</b> dentro de un hueco para verificar sin bajar al boton.
  </div>
</div>


<div class="card">
  <h2>1. Ciberseguridad</h2>

  <p>La ciberseguridad es la <?php hueco(1, 13); ?>
     de los <?php hueco(2, 10); ?>
     de <?php hueco(3, 13); ?>
     mediante la identificacion y el tratamiento de las <?php hueco(4, 11); ?>
     a la informacion que es <?php hueco(5, 12); ?> ,
     <?php hueco(6, 13); ?> y
     <?php hueco(7, 14); ?>
     por sistemas de informacion <?php hueco(8, 16); ?> .</p>

  <?php enviar(); ?>
  <?php ayuda('Los tres estados van en este orden: <b>procesada, almacenada y transportada</b>. Y lo que se protege son <b>activos de informacion</b>.'); ?>

  <?php mc('m7'); ?>
</div>


<div class="card">
  <h2>2. Confidencialidad</h2>

  <p>La confidencialidad es la <?php hueco(9, 13); ?>
     de la informacion contra el <?php hueco(10, 10); ?>
     o la <?php hueco(11, 13); ?>
     no <?php hueco(12, 13); ?> .
     Garantiza que solo las personas <?php hueco(13, 13); ?>
     puedan acceder a informacion <?php hueco(14, 11); ?> .</p>

  <?php enviar(); ?>
  <?php ayuda('Dos verbos distintos: <b>acceso</b> (yo entro y lo veo) y <b>divulgacion</b> (alguien lo saca y lo cuenta).'); ?>

  <?php mc('m1'); ?>
</div>


<div class="card">
  <h2>3. Disponibilidad</h2>

  <p>La disponibilidad garantiza el <?php hueco(15, 10); ?>
     <?php hueco(16, 11); ?> y
     <?php hueco(17, 11); ?>
     a la informacion y a los sistemas siempre que los usuarios
     <?php hueco(18, 13); ?>
     los <?php hueco(19, 12); ?> .</p>

  <?php enviar(); ?>
  <?php ayuda('Las dos palabras que la definen son <b>oportuno</b> (a tiempo) y <b>confiable</b> (siempre que hace falta, no a veces).'); ?>

  <?php mc('m3'); ?>
</div>


<div class="card">
  <h2>4. Integridad</h2>

  <p>La integridad es la <?php hueco(20, 13); ?>
     de la informacion contra la <?php hueco(21, 15); ?>
     no <?php hueco(22, 13); ?> .
     Garantiza que la informacion permanezca <?php hueco(23, 10); ?> ,
     <?php hueco(24, 11); ?> y
     <?php hueco(25, 11); ?> .</p>

  <?php enviar(); ?>
  <?php ayuda('Los tres adjetivos del final van juntos: <b>precisa, completa y confiable</b>.'); ?>

  <?php mc('m2'); ?>
  <?php mc('m8'); ?>
</div>


<div class="card">
  <h2>5. No repudio</h2>

  <p>El no repudio es la <?php hueco(26, 11); ?>
     de que una persona no puede <?php hueco(27, 9); ?>
     haber <?php hueco(28, 10); ?> o
     <?php hueco(29, 10); ?> informacion.
     Verifica que un mensaje sea <?php hueco(30, 11); ?>
     y, por lo general, se implementa mediante
     <?php hueco(31, 20); ?> y
     <?php hueco(32, 26); ?> .</p>

  <?php enviar(); ?>
  <?php ayuda('Las dos implementaciones: lo que <b>firma el remitente</b> y el <b>rastro que deja el sistema</b>.'); ?>

  <?php mc('m4'); ?>
</div>


<div class="card">
  <h2>6. Al reves: dado el ataque, el principio</h2>
  <p>Ahora sin la definicion delante. Escribe que principio se rompe en cada caso.</p>

  <table class="datos">
    <tr><th>Lo que pasa</th><th>Principio que se rompe</th></tr>
    <tr><td>Alguien <b>ve</b> informacion que no le corresponde</td><td><?php hueco(33, 18); ?></td></tr>
    <tr><td>Alguien <b>altera</b> un dato sin autorizacion</td><td><?php hueco(34, 18); ?></td></tr>
    <tr><td>El sistema <b>se cae</b> y los usuarios legitimos no pueden entrar</td><td><?php hueco(35, 18); ?></td></tr>
    <tr><td>Alguien <b>niega</b> haber enviado un mensaje que si envio</td><td><?php hueco(36, 18); ?></td></tr>
  </table>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Seguridad de la informacion vs. ciberseguridad</h2>

  <p>La ciberseguridad es un <?php hueco(37, 14); ?>
     de la seguridad de la informacion.</p>

  <p>La <b>ciberseguridad</b> se enfoca en proteger la informacion almacenada o transmitida
     de forma <?php hueco(38, 10); ?> : datos en computadoras, redes, discos duros
     y otros dispositivos electronicos.</p>

  <p>La <b>seguridad de la informacion</b> es mas amplia: protege todo tipo de informacion,
     incluyendo la digital, los documentos fisicos en <?php hueco(39, 9); ?>
     e incluso la informacion almacenada en la mente de las personas.</p>

  <p>En conclusion: la <?php hueco(40, 26); ?>
     protege toda la informacion, mientras que la <?php hueco(41, 18); ?>
     se enfoca principalmente en la informacion digital.</p>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../Riesgos/index.php');
