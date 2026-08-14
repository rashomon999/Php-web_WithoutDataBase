<?php
/* ==========================================================================
   CompuNet 3 / dApps / El stack de la demo
   Fuente: exposicion.pdf (Tecnologias_usadas, Sepolia, ALchemi, Hardhat,
           gas, ETH_sepolia, bitcoin_etherium, flujo_deploy)
   ========================================================================== */

$CSS = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- las cinco piezas --- */
    1  => ['sepolia'],
    2  => ['hardhat'],
    3  => ['alchemy'],
    4  => ['metamask'],
    5  => ['etherscan'],

    /* --- Sepolia --- */
    6  => ['testnet', 'red de pruebas'],
    7  => ['mainnet'],
    8  => ['11155111'],
    9  => ['1'],
    10 => ['protocolo'],

    /* --- clientes --- */
    11 => ['geth'],
    12 => ['diversidad'],

    /* --- Hardhat --- */
    13 => ['compilar'],
    14 => ['bytecode'],
    15 => ['abi'],
    16 => ['probar'],
    17 => ['memoria'],
    18 => ['desplegar'],

    /* --- Alchemy --- */
    19 => ['rpc'],
    20 => ['nodo'],
    21 => ['sincronizar'],
    22 => ['cliente-servidor', 'cliente servidor'],
    23 => ['peer-to-peer', 'p2p', 'peer to peer'],

    /* --- MetaMask / Etherscan --- */
    24 => ['privada'],
    25 => ['firma'],
    26 => ['explorador'],
    27 => ['verificar'],

    /* --- gas --- */
    28 => ['computacional'],
    29 => ['precio'],
    30 => ['21000', '21,000'],
    31 => ['gwei'],
    32 => ['eth'],
    33 => ['0.00042'],

    /* --- deploy --- */
    34 => ['nuevo'],
    35 => ['direccion'],

    /* --- bitcoin vs ethereum --- */
    36 => ['2009'],
    37 => ['2015'],
    38 => ['proof of work', 'pow', 'prueba de trabajo'],
    39 => ['proof of stake', 'pos', 'prueba de participacion'],
    40 => ['21'],
    41 => ['oro'],
    42 => ['computadora'],
];

$TEXTO = [1,2,3,4,5,6,7,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,34,35,38,39,41,42];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En una frase para la expo: &iquest;que es <b>Sepolia</b>?',
        'opciones' => [
            'a' => 'Una empresa que hospeda contratos',
            'b' => 'Una <b>blockchain</b>: una red publica de Ethereum dedicada a pruebas, que funciona igual que mainnet pero con ETH que no vale nada',
            'c' => 'Una herramienta para compilar Solidity',
            'd' => 'Una wallet de navegador'
        ],
        'correcta' => 'b',
        'porque'   => 'No es &laquo;una fabrica de blockchains&raquo; ni un servicio: es <b>una</b> cadena, con su propio historial, mantenida por nodos reales.'
    ],
    'm2' => [
        'texto'    => '&iquest;Que relacion hay entre mainnet y Sepolia?',
        'opciones' => [
            'a' => 'Sepolia es una copia de seguridad de mainnet',
            'b' => 'Son <b>cadenas completamente separadas</b> que solo comparten el mismo protocolo Ethereum; cada una con su propio historial y su propio chain ID',
            'c' => 'Sepolia se sincroniza con mainnet cada noche',
            'd' => 'Sepolia es una capa 2 de mainnet'
        ],
        'correcta' => 'b',
        'porque'   => 'Conviene separar <b>protocolo</b> (las reglas) de <b>red</b> (la cadena que corre esas reglas). Mismo idioma, historias distintas.'
    ],
    'm3' => [
        'texto'    => 'Alguien pregunta: &laquo;&iquest;el ETH de Sepolia es gratis e infinito?&raquo;',
        'opciones' => [
            'a' => 'Si, se genera solo',
            'b' => 'Es gratis <b>porque no vale nada</b>, pero no es infinito: alguien (Google, Alchemy) mantiene el faucet con un balance finito y limita la entrega para evitar abusos',
            'c' => 'No, cuesta unos centavos',
            'd' => 'Es infinito pero hay que minarlo'
        ],
        'correcta' => 'b',
        'porque'   => 'El limite de &laquo;un drip cada 24 horas&raquo; es control de abuso, no un indicador de que el ETH de prueba tenga valor economico.'
    ],
    'm4' => [
        'texto'    => '&iquest;Hardhat es una blockchain?',
        'opciones' => [
            'a' => 'Si, una blockchain local permanente',
            'b' => 'No: es una <b>herramienta que corre en tu computadora</b>. Compila, prueba (con una cadena falsa y temporal en memoria) y manda la transaccion de despliegue',
            'c' => 'Si, es la version de prueba de Ethereum',
            'd' => 'No, es una wallet'
        ],
        'correcta' => 'b',
        'porque'   => 'La imagen de tus apuntes: Hardhat es <b>el taller</b> donde preparas todo antes de publicarlo, no la calle donde queda publicado.'
    ],
    'm5' => [
        'texto'    => '&iquest;Hardhat le habla directamente a Sepolia?',
        'opciones' => [
            'a' => 'Si, se conecta a la red p2p el solo',
            'b' => 'No: no trae un nodo propio, asi que necesita a alguien ya sincronizado. En tu proyecto ese alguien es <b>Alchemy</b>, la URL que pusiste en <code>.env</code>',
            'c' => 'Si, usando MetaMask',
            'd' => 'No, usa Etherscan'
        ],
        'correcta' => 'b',
        'porque'   => 'La cadena real es: Hardhat &rarr; Alchemy &rarr; red p2p de Sepolia &rarr; los nodos validan y meten la transaccion en un bloque.'
    ],
    'm6' => [
        'texto'    => '&iquest;Alchemy le agrega algo a tu contrato?',
        'opciones' => [
            'a' => 'Si, lo optimiza antes de desplegarlo',
            'b' => 'No: solo te da <b>acceso</b> (la puerta RPC) a una cadena que ya existe. Todo el trabajo real (validar, minar, guardar) lo hace la red de Sepolia',
            'c' => 'Si, lo guarda en sus servidores',
            'd' => 'Si, cobra una comision del gas'
        ],
        'correcta' => 'b',
        'porque'   => 'Y podrias haberlo hecho tu: instalando Geth y sincronizandolo, tendrias tu propio RPC en <code>127.0.0.1:8545</code> y funcionaria igual. Alchemy solo te ahorra ese trabajo.'
    ],
    'm7' => [
        'texto'    => 'En tu proyecto, &iquest;donde hay cliente-servidor y donde hay peer-to-peer?',
        'opciones' => [
            'a' => 'Todo es peer-to-peer',
            'b' => 'Entre <b>tu y Alchemy</b> es cliente-servidor clasico (le mandas una peticion HTTPS a una URL); entre <b>los nodos de Ethereum</b> entre si es peer-to-peer',
            'c' => 'Todo es cliente-servidor',
            'd' => 'Depende de la wallet que uses'
        ],
        'correcta' => 'b',
        'porque'   => 'Son dos capas superpuestas. Tu nunca te vuelves parte de la red p2p: le hablas a un nodo, y ese nodo si esta adentro hablando con el resto del mundo.'
    ],
    'm8' => [
        'texto'    => '&iquest;Que es el <b>gas</b>?',
        'opciones' => [
            'a' => 'Una criptomoneda propia de Ethereum',
            'b' => 'Una <b>unidad de medida del trabajo computacional</b>, no dinero en si. Lo que pagas es gas usado &times; precio del gas, y el resultado se paga en ETH',
            'c' => 'La comision que cobra MetaMask',
            'd' => 'El costo de alquilar un nodo'
        ],
        'correcta' => 'b',
        'porque'   => 'Separar &laquo;cuanto trabajo cuesta&raquo; de &laquo;cuanto vale ese trabajo ahora&raquo; es justo lo que permite que el precio flote con la demanda sin cambiar el protocolo.'
    ],
    'm9' => [
        'texto'    => 'Vuelves a correr el script de deploy. &iquest;Que pasa con el contrato anterior?',
        'opciones' => [
            'a' => 'Se reemplaza por el nuevo',
            'b' => 'Sigue existiendo tal cual, en su propia direccion, para siempre. Cada deploy crea un contrato <b>nuevo</b> con una direccion <b>nueva</b>',
            'c' => 'Se borra de la blockchain',
            'd' => 'Se fusiona con el nuevo'
        ],
        'correcta' => 'b',
        'porque'   => 'No es como subir cambios a un servidor. Por eso <code>donations-address.json</code> guarda cual es la direccion que tu frontend debe usar.'
    ],
    'm10' => [
        'texto'    => 'Diferencia entre Bitcoin y Ethereum, en una linea.',
        'opciones' => [
            'a' => 'Bitcoin es mas seguro que Ethereum',
            'b' => 'Bitcoin = una version digital del oro o dinero. Ethereum = una computadora mundial descentralizada donde se pueden ejecutar programas',
            'c' => 'Ethereum es la version nueva de Bitcoin',
            'd' => 'Bitcoin usa blockchain y Ethereum no'
        ],
        'correcta' => 'b',
        'porque'   => 'Esa es la frase de tus apuntes, y es la que se queda. De ahi sale todo lo demas: por eso Ethereum es programable y por eso las dApps viven ahi.'
    ],
    'm11' => [
        'texto'    => 'Si en la demo alguien duda de tus numeros, &iquest;como se los demuestras <b>sin</b> pedirles que confien en tu frontend?',
        'opciones' => [
            'a' => 'Les enseño el codigo de donaciones.js',
            'b' => 'Buscando la direccion del contrato en <b>sepolia.etherscan.io</b>: ahi se ve cada donacion, cada retiro y el balance exacto, leidos de los nodos',
            'c' => 'Les muestro la consola del navegador',
            'd' => 'Les enseño el dashboard de Alchemy'
        ],
        'correcta' => 'b',
        'porque'   => 'Ese es el momento fuerte de la exposicion: <b>no es &laquo;confia en la ONG&raquo;, es &laquo;verificalo tu mismo&raquo;</b>, en un sitio que nadie controla unilateralmente.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('4 · El stack de la demo', 'exposicion.pdf — Sepolia, Hardhat, Alchemy, MetaMask, Etherscan, gas');
?>

<div class="card">
  <h2>1. Las cinco piezas, en una linea cada una</h2>
  <p>Si te preguntan &laquo;&iquest;y esto para que lo usaste?&raquo;, esta es la respuesta.</p>

  <table class="datos">
    <tr><th>Pieza</th><th>Que es</th></tr>
    <tr><td><?php hueco(1, 12); ?></td><td>la blockchain en si: red publica de Ethereum para pruebas, donde vive tu contrato</td></tr>
    <tr><td><?php hueco(2, 12); ?></td><td>la herramienta en tu computadora: compila, prueba y despliega</td></tr>
    <tr><td><?php hueco(3, 12); ?></td><td>tu nodo, la puerta de entrada a Sepolia</td></tr>
    <tr><td><?php hueco(4, 12); ?></td><td>tu wallet: guarda la llave privada y firma cada transaccion</td></tr>
    <tr><td><?php hueco(5, 12); ?></td><td>el explorador publico: lee de los nodos y te muestra lo registrado</td></tr>
  </table>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Sepolia</h2>

  <p>Sepolia <b>es</b> una blockchain, una en particular. Conviene separar dos cosas:
     el <?php hueco(10, 12); ?> Ethereum (las reglas: como se validan bloques,
     que es una transaccion, que es un contrato) y las <b>redes</b> que lo corren.</p>

  <table class="datos">
    <tr><th>Red</th><th>Que es</th><th>chain ID</th></tr>
    <tr><td>Mainnet</td><td>la red real, con ETH que vale dinero</td><td><?php hueco(9, 12); ?></td></tr>
    <tr><td>Sepolia</td><td>una <?php hueco(6, 14); ?>, con ETH que no vale nada</td><td><?php hueco(8, 12); ?></td></tr>
  </table>

  <p>Tienen historiales completamente separados: no hay ninguna conexion entre
     Sepolia y <?php hueco(7, 12); ?>.</p>

  <p>Los nodos corren software cliente de Ethereum: <?php hueco(11, 8); ?> (en Go),
     Nethermind (en C#), Besu (en Java), Erigon, Reth. Que existan varias implementaciones
     es a proposito; se llama <?php hueco(12, 12); ?> de clientes: si un bug afecta
     solo a una, la red no se cae entera.</p>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Hardhat: tres trabajos, ninguno necesita una blockchain propia</h2>

  <p><b><?php hueco(13, 10); ?></b> — <code>npx hardhat compile</code> toma tu
     <code>Donations.sol</code> y lo convierte en <?php hueco(14, 12); ?>
     (lo que puede ejecutar la blockchain) mas el <?php hueco(15, 6); ?>
     (la lista de funciones que tu frontend necesita). Es 100% local, no toca ninguna red.</p>

  <p><b><?php hueco(16, 10); ?></b> — <code>npx hardhat test</code> crea una
     blockchain falsa y temporal, solo en la <?php hueco(17, 10); ?> de tu
     computadora, la usa unos segundos y la destruye. Nunca se guarda en disco.</p>

  <p><b><?php hueco(18, 12); ?></b> — <code>npx hardhat run scripts/deploy-donations.js
     --network sepolia</code> le habla a Alchemy y manda la transaccion que crea tu
     contrato en la red publica real.</p>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Alchemy: solo la puerta</h2>

  <p>Alchemy no crea nada ni le agrega valor a tu contrato: te da el acceso — la puerta
     <?php hueco(19, 8); ?> — hacia la cadena que ya existe. Como correr tu
     propio <?php hueco(20, 8); ?> completo pesaria cientos de gigas, ellos ya
     tienen uno corriendo 24/7 y te prestan acceso por una URL.</p>

  <p>Podrias haberlo hecho tu: instalar Geth, <?php hueco(21, 12); ?> con
     Sepolia, y usar tu propio RPC local en <code>127.0.0.1:8545</code>. Habria funcionado igual.</p>

  <div class="avisoflujo">
    <b>Las dos capas, que es facil confundir.</b><br>
    Entre <b>tu y Alchemy</b> la relacion es <?php hueco(22, 18); ?> clasico:
    le mandas una peticion HTTPS a una URL unica.<br>
    Entre <b>los nodos de Ethereum entre si</b> la relacion es
    <?php hueco(23, 16); ?>: son todos iguales, no hay nodo jefe.<br>
    Tu nunca te vuelves parte de la red p2p.
  </div>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. MetaMask y Etherscan</h2>

  <p><b>MetaMask</b> es tu wallet, la extension del navegador. Guarda tu llave
     <?php hueco(24, 10); ?> , es tu identidad en la blockchain (reemplaza
     usuario/contraseña) y es quien <?php hueco(25, 8); ?> cada transaccion antes
     de mandarla a la red.</p>

  <p><b>Etherscan</b> es el <?php hueco(26, 12); ?> publico de la blockchain:
     una pagina que lee directamente de los nodos y muestra transacciones, balances y el
     codigo de tu contrato si lo <?php hueco(27, 10); ?> . Es tu forma de
     comprobar todo de manera independiente, sin depender de tu propio frontend.</p>

  <?php mc('m11'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Gas</h2>

  <p>El gas es una unidad de medida del trabajo <?php hueco(28, 15); ?> ,
     no es dinero en si mismo. Lo que realmente pagas es:</p>

  <pre><code>Costo total = Gas usado  ×  <?php hueco(29, 10); ?> del gas</code></pre>

  <p>Una transferencia simple usa <?php hueco(30, 8); ?> unidades de gas.
     El precio se mide en <?php hueco(31, 8); ?> , una fraccion de ETH
     (1 ETH = 1.000.000.000 gwei), y el resultado final se paga en
     <?php hueco(32, 6); ?> .</p>

  <p>Ejemplo concreto de tus apuntes: 21.000 gas &times; 20 gwei = 420.000 gwei =
     <?php hueco(33, 10); ?> ETH. Si el ETH vale 3.000 dolares, esa transaccion
     costo alrededor de 1,26 dolares.</p>

  <div class="nota">
    Desplegar un contrato o mintear un NFT consume mucho mas (100.000 a 2.000.000+ de gas).
    Por eso mucha gente trabaja en <b>Layer 2</b> (Polygon, Base, Arbitrum), donde la misma
    operacion cuesta centavos. En testnets y en la VM de Remix el gas es simulado y no cuesta nada real.
  </div>

  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Desplegar no es &laquo;subir cambios&raquo;</h2>

  <p>Cada vez que corres el script de deploy estas creando un contrato completamente
     <?php hueco(34, 10); ?> , con una <?php hueco(35, 12); ?>
     completamente nueva. El contrato anterior sigue existiendo tal cual, inmutable, aunque
     ya nadie lo use.</p>

  <?php mc('m9'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Bitcoin vs Ethereum</h2>
  <p>Por si en la introduccion alguien pregunta por que Ethereum y no Bitcoin.</p>

  <table class="datos">
    <tr><th>Caracteristica</th><th>Bitcoin</th><th>Ethereum</th></tr>
    <tr><td>Creacion</td><td><?php hueco(36, 8); ?></td><td><?php hueco(37, 8); ?></td></tr>
    <tr><td>Moneda</td><td>BTC</td><td>ETH</td></tr>
    <tr><td>Proposito</td><td>dinero digital</td><td>plataforma de aplicaciones</td></tr>
    <tr><td>Programable</td><td>limitado</td><td>si, mucho mas</td></tr>
    <tr><td>Suministro</td><td>maximo <?php hueco(40, 6); ?> millones</td><td>no tiene limite fijo</td></tr>
    <tr><td>Consenso</td><td><?php hueco(38, 18); ?></td><td><?php hueco(39, 18); ?></td></tr>
  </table>

  <p>Una forma sencilla de verlo: Bitcoin = una version digital del
     <?php hueco(41, 8); ?> o dinero. Ethereum = una
     <?php hueco(42, 14); ?> mundial descentralizada donde se pueden ejecutar programas.</p>

  <?php mc('m10'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Arquitectura/index.php', '');
