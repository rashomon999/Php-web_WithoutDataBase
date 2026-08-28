<?php
/* ==========================================================================
   CompuNet 3 / dApps / Fundamentos
   Fuente: exposicion.pdf (General, peer to peer, Blockchain, web3, bosquejo 1-2-7)
   ========================================================================== */

$CSS = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- definicion de dApp --- */
    1  => ['Una Aplicacion descentralizada'],
    2  => ['opera sobre una red blockchain'],
    3  => ['proporcionar mayor seguridad'],
    4  => ['transparencia'],
    5  => ['autonomia en comparacion con las aplicaciones tradicionales'],
    6  => ['Cuando usas una DApp'],
    7  => ['tu informacion no esta controlada por una unica empresa o servidor'],
    8  => ['sino que se registra en la blockchain y es verificada por multiples nodos'],

    /* --- que problema resuelve --- */
    9  => ['Las DApps buscan reducir la dependencia de intermediarios'],
    10 => ['autoridades centrales'],
    11 => ['directamente'],
    12 => ['verificadas'],

    /* --- descentralizacion --- */
    13 => ['control'],
    14 => ['distribuida', 'distribuido'],
    15 => ['auditadas', 'auditar'],

    /* --- P2P --- */
    16 => ['peer-to-peer', 'peer to peer', 'p2p'],
    17 => ['intermediarios'],
    18 => ['napster'],

    /* --- blockchain --- */
    19 => ['Blockchain es una base de datos o libro mayor digital descentralizado que almacena registros'],
    20 => ['transparente', 'transparentes'],
    21 => ['inmutable', 'inmutables'],
    22 => ['manipulacion'],
    23 => ['Cada bloque contiene datos'],
    24 => ['cadena cronologica'],
    25 => ['Modificar algo del pasado'],

    /* --- por que todos los nodos ejecutan --- */
    26 => ['transaccion'],
    27 => ['nodos'],
    28 => ['mismo'],
    29 => ['resultado'],
    30 => ['mayoria'],

    /* --- ventajas --- */
    31 => ['transparencia'],
    32 => ['descentralizacion'],
    33 => ['automatizacion'],
    34 => ['intermediarios'],
    35 => ['innovacion'],

    /* --- limitaciones --- */
    36 => ['escalabilidad'],
    37 => ['gas'],
    38 => ['complejidad'],
    39 => ['vulnerabilidades', 'vulnerabilidad'],

    /* --- web 1 2 3 --- */
    40 => ['estaticas', 'solo lectura'],
    41 => ['empresas'],
    42 => ['poseen', 'poseer'],
    43 => ['propiedad'],
    44 => ['wallet', 'billetera'],

    /*añadidos */
    45 => ['Utiliza las caracteristicas de esa red'],
    46 => ['forma segura a traves de una red de computadoras'],

];

$TEXTO = range(1, 44);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En una frase: &iquest;que es lo que hace que una aplicacion sea una <b>dApp</b> y no una app normal?',
        'opciones' => [
            'a' => 'Que usa criptomonedas para cobrar',
            'b' => 'Que la logica importante y los datos no viven en un servidor propio, sino en un <b>contrato desplegado en una blockchain</b> validada por muchos nodos',
            'c' => 'Que el frontend esta hecho en React',
            'd' => 'Que es de codigo abierto'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la respuesta que tienes que soltar de una si te preguntan en la exposicion. El frontend puede ser una pagina web comun y corriente; lo que cambia es <b>donde vive el backend</b>.'
    ],
    'm2' => [
        'texto'    => 'Si borraras por completo el frontend de tu dApp de donaciones, &iquest;que pasaria?',
        'opciones' => [
            'a' => 'Se perderian los fondos y el historial',
            'b' => 'El contrato seguiria existiendo y funcionando: cualquiera podria interactuar con el desde Etherscan o desde otro frontend',
            'c' => 'La blockchain lo borraria automaticamente',
            'd' => 'Habria que volver a desplegarlo'
        ],
        'correcta' => 'b',
        'porque'   => 'Este es <b>el</b> argumento de tu exposicion: el frontend es solo una ventana. Los fondos, el historial y las reglas viven en el contrato.'
    ],
    'm3' => [
        'texto'    => '&iquest;Por que <b>todos</b> los nodos ejecutan el mismo contrato en vez de uno solo?',
        'opciones' => [
            'a' => 'Para que vaya mas rapido',
            'b' => 'Porque si solo existiera un servidor, ese servidor podria modificar los datos; con miles de nodos comprobando lo mismo, alterar el resultado es extremadamente dificil',
            'c' => 'Para repartir el costo del gas',
            'd' => 'Porque cada nodo ejecuta una parte distinta'
        ],
        'correcta' => 'b',
        'porque'   => 'Ojo con el matiz: la redundancia <b>no</b> es para ganar velocidad — de hecho la sacrifica. Se paga rendimiento a cambio de que nadie pueda hacer trampa.'
    ],
    'm4' => [
        'texto'    => 'Alguien en clase pregunta: &laquo;&iquest;entonces una dApp es mas rapida que una app normal?&raquo;. &iquest;Que respondes?',
        'opciones' => [
            'a' => 'Si, porque no tiene servidor',
            'b' => 'No: normalmente es <b>mas lenta y mas cara</b>, porque cada operacion la repiten y validan miles de nodos. Lo que ganas es verificabilidad, no rendimiento',
            'c' => 'Depende del navegador',
            'd' => 'Si, porque la blockchain esta distribuida'
        ],
        'correcta' => 'b',
        'porque'   => 'La escalabilidad aparece en tus apuntes como la <b>primera limitacion</b>. Reconocerlo tu mismo en la expo da mucha mas credibilidad que ocultarlo.'
    ],
    'm5' => [
        'texto'    => 'Un servicio <b>P2P</b> y una <b>dApp</b>, &iquest;son lo mismo?',
        'opciones' => [
            'a' => 'Si, son sinonimos',
            'b' => 'No: P2P es la idea general de que las partes interactuen directamente sin intermediarios (Napster ya lo hacia en los 90). Una dApp usa esa idea <b>mas</b> una blockchain con contratos inteligentes',
            'c' => 'P2P es mas moderno que las dApps',
            'd' => 'Las dApps no son P2P'
        ],
        'correcta' => 'b',
        'porque'   => 'Buen gancho para la introduccion: el P2P no lo invento la blockchain, viene de los sistemas de intercambio de archivos de finales de los 90.'
    ],
    'm6' => [
        'texto'    => '&iquest;Cual es la diferencia entre Web 2.0 y Web 3.0 segun los apuntes?',
        'opciones' => [
            'a' => 'La Web 3.0 tiene mejor diseño',
            'b' => 'En la Web 2.0 el usuario lee y escribe pero las <b>grandes empresas controlan</b> los datos; en la Web 3.0 el usuario ademas <b>posee</b> lo que crea',
            'c' => 'La Web 3.0 es solo para criptomonedas',
            'd' => 'La Web 2.0 son paginas estaticas'
        ],
        'correcta' => 'b',
        'porque'   => 'La progresion es: <b>leer</b> (1.0) &rarr; <b>leer y escribir</b> (2.0) &rarr; <b>leer, escribir y poseer</b> (3.0). Paginas estaticas es la 1.0.'
    ],
    'm7' => [
        'texto'    => 'En una dApp, &iquest;cual es la identidad del usuario?',
        'opciones' => [
            'a' => 'Un usuario y contraseña guardados en tu base de datos',
            'b' => 'Su <b>wallet</b>: nadie se registra, nadie te da un correo ni una contraseña',
            'c' => 'Su correo electronico verificado',
            'd' => 'Un token JWT que emite tu servidor'
        ],
        'correcta' => 'b',
        'porque'   => 'Es un punto fuerte para la expo: en tu proyecto <b>no hay registro</b>. La wallet reemplaza al usuario/contraseña.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('1 · Fundamentos de las dApps', 'exposicion.pdf — que son, que problema resuelven, blockchain, P2P, Web3');
?>

<div class="card">
  <h2>Para que es esta pagina</h2>
  <p>Te toca exponer dApps. Esto no es para aprobar un quiz: es para que cuando alguien
     levante la mano en clase, la definicion salga sola y no tengas que buscarla en la diapositiva.</p>
  <div class="nota">
    Las definiciones estan escritas <b>completas</b>, con las palabras clave en blanco.
    No importan mayusculas ni tildes. Pulsa <b>Enter</b> dentro de un hueco para verificar.
  </div>
</div>


<div class="card">
  <h2>1. Que es una dApp</h2>

  <p>  <?php hueco(1, 31); ?> (DApp) es una aplicacion que
       <?php hueco(2, 30); ?> . 
        <?php hueco(45, 38); ?>
        
       para   <?php hueco(3, 28); ?> ,
     <?php hueco(4, 14); ?> y <?php hueco(5, 61); ?>
      .</p>

  <p>
  <?php hueco(6, 20); ?>  
   ,  
       <?php hueco(7, 66); ?> ,
      
     <?php hueco(8, 72); ?> de la red.</p>

  <?php enviar(); ?>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
</div>


<div class="card">
  <h2>2. Que problema buscan solucionar</h2>

  <p>  <?php hueco(9, 57); ?>
     y   <?php hueco(10, 22); ?> , permitiendo que los usuarios
     interactuen <?php hueco(11, 13); ?> y que las operaciones sean
     <?php hueco(12, 12); ?> por multiples participantes de la red.</p>

  <div class="avisoflujo">
    <b>La frase que remata.</b> En una aplicacion tradicional, un servidor central
    <em>podria</em> modificar los datos. En una DApp la informacion es verificada por
    multiples nodos, lo que hace extremadamente dificil alterar el resultado.
  </div>

  <p><b>Descentralizacion</b> significa que el <?php hueco(13, 9); ?>
     no esta concentrado en una unica empresa, servidor o autoridad: la informacion
     esta <?php hueco(14, 13); ?> y verificada por multiples nodos.
     Eso permite que las transacciones puedan ser verificadas y
     <?php hueco(15, 12); ?> publicamente.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Peer-to-Peer, el antecedente</h2>

  <p>Los servicios <?php hueco(16, 16); ?> son plataformas descentralizadas
     que permiten que compradores y vendedores interactuen directamente entre si, sin
     necesidad de <?php hueco(17, 15); ?> externos.
     Se popularizaron gracias a sistemas de intercambio de archivos como
     <?php hueco(18, 12); ?> , a finales de los años 90.</p>

  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Que es una blockchain</h2>

  <p>  <?php hueco(19, 91); ?>  
       de 
       <?php hueco(46, 47); ?>
          , de manera <?php hueco(20, 13); ?> ,
     <?php hueco(21, 12); ?> y resistente a la
     <?php hueco(22, 14); ?> .</p>

  <p>  <?php hueco(23, 26); ?>  , y los bloques estan enlazados formando una <?php hueco(24, 19); ?>
       .  <?php hueco(25, 26); ?>  significaria romper
     la cadena entera, y como hay miles de copias, el resto lo rechazaria.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Por que todos los nodos ejecutan el contrato</h2>
  <p>Esto es lo que te van a preguntar. Son cinco pasos, en orden. Supon que haces una compra:</p>

  <ol>
    <li>Envias la <?php hueco(26, 13); ?> .</li>
    <li>Todos los <?php hueco(27, 9); ?> reciben esa informacion.</li>
    <li>Cada nodo ejecuta el <?php hueco(28, 9); ?> contrato inteligente.</li>
    <li>Todos llegan al mismo <?php hueco(29, 11); ?> .</li>
    <li>Si la <?php hueco(30, 10); ?> obtiene el mismo resultado, ese resultado
        se guarda en la blockchain.</li>
  </ol>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Ventajas</h2>
  <p>Seis, y conviene decirlas con una frase corta cada una.</p>

  <table class="datos">
    <tr><th>Ventaja</th><th>En una linea</th></tr>
    <tr><td><?php hueco(31, 16); ?></td><td>todo queda en un libro publico que cualquiera puede verificar y auditar</td></tr>
    <tr><td><?php hueco(32, 18); ?></td><td>el control se reparte entre muchos participantes, no depende de una entidad</td></tr>
    <tr><td><?php hueco(33, 16); ?></td><td>el contrato ejecuta solo cuando se cumple la condicion</td></tr>
    <tr><td>Reduccion de <?php hueco(34, 15); ?></td><td>los usuarios interactuan directamente entre ellos</td></tr>
    <tr><td>Control sobre activos y datos</td><td>el usuario toma posesion de lo suyo</td></tr>
   </table>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Limitaciones</h2>
  <p>Decirlas tu mismo en la exposicion suma. Que no te las saquen ellos.</p>

  <table class="datos">
    <tr><th>Limitacion</th><th>En una linea</th></tr>
    <tr><td><?php hueco(36, 16); ?></td><td>algunas blockchains son lentas y limitadas en capacidad</td></tr>
    <tr><td>Costos de transaccion</td><td>Cada operación puede tener un costo, llamado <?php hueco(37, 7); ?></td></tr>
    <tr><td>Seguridad</td><td>no estan libres de <?php hueco(39, 18); ?> ni de intentos de hacking</td></tr>
    <tr><td><?php hueco(38, 14); ?></td><td>wallets, redes y firmas hacen la experiencia dura para un usuario nuevo</td></tr>
    <tr><td>Dependencia de la infraestructura</td><td>la dApp hereda los limites de la blockchain sobre la que corre</td></tr>
  </table>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Web 1.0, 2.0 y 3.0</h2>

  <table class="datos">
    <tr><th>Etapa</th><th>Que puede hacer el usuario</th></tr>
    <tr><td>Web 1.0</td><td>Paginas <?php hueco(40, 14); ?> de solo lectura</td></tr>
    <tr><td>Web 2.0</td><td>Redes sociales e interacciones, pero las grandes <?php hueco(41, 12); ?> controlan los datos y el contenido</td></tr>
    <tr><td>Web 3.0</td><td>Redes descentralizadas donde los usuarios leen, escriben y <?php hueco(42, 10); ?> lo que crean</td></tr>
  </table>

  <p>Web3 usa blockchain, criptomonedas y contratos inteligentes para dar a los usuarios la
     <?php hueco(43, 12); ?> real de sus datos, identidad y activos digitales,
     sin depender de grandes empresas tecnologicas. La identidad del usuario deja de ser
     un usuario/contraseña y pasa a ser su <?php hueco(44, 10); ?> .</p>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../SmartContracts/index.php');
