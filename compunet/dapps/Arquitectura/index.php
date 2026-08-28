<?php
/* ==========================================================================
   CompuNet 3 / dApps / Arquitectura
   Fuente: exposicion.pdf (frontend, bosquejo 4-5-8, ABI, ABI_analisis,
           ethers.js, RPC, flujo_normal, javascript-html, web3_)
   ========================================================================== */

$CSS = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- la pila de una dApp --- */
    1  => ['frontend'],
    2  => ['ethers.js', 'web3.js', 'ethers'],
    3  => ['wallet', 'metamask'],
    4  => ['smart contract', 'contrato inteligente', 'contrato'],
    5  => ['blockchain', 'ethereum'],

    /* --- la pila tradicional --- */
    6  => ['backend'],
    7  => ['base de datos'],

    /* --- comparacion --- */
    8  => ['servidor'],
    9  => ['blockchain'],
    10 => ['smart contract', 'contrato inteligente', 'contrato'],
    11 => ['nodos'],
    12 => ['wallet'],

    /* --- los 7 pasos --- */
    13 => ['frontend'],
    14 => ['firma', 'firmar'],
    15 => ['red', 'blockchain'],
    16 => ['contrato'],
    17 => ['resultado'],
    18 => ['blockchain'],
    19 => ['frontend'],

    /* --- ABI --- */
    20 => ['application binary interface'],
    21 => ['funciones'],
    22 => ['parametros'],
    23 => ['devuelven', 'retornan'],
    24 => ['traductor'],
    25 => ['bytecode'],
    26 => ['compilar'],
    27 => ['tuple'],
    28 => ['getter'],
    29 => ['public'],
    30 => ['indexed'],

    /* --- ethers.js / window.ethereum --- */
    31 => ['ethers.js', 'ethers'],
    32 => ['window.ethereum'],
    33 => ['metamask'],
    34 => ['privada'],

    /* --- RPC --- */
    35 => ['remote procedure call'],
    36 => ['json-rpc', 'json rpc'],
    37 => ['eth_blockNumber'],
    38 => ['eth_sendRawTransaction'],

    /* --- puente HTML/JS --- */
    39 => ['document.getElementById(id)', 'document.getelementbyid(id)'],
    40 => ['addEventListener'],

    /* --- web2 vs web3 en el proyecto --- */
    41 => ['frontend'],
    42 => ['contrato', 'smart contract'],
];

$TEXTO = [1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,31,33,34,35,36,41,42];

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Cual es la diferencia estructural entre una app tradicional y una dApp, en una frase?',
        'opciones' => [
            'a' => 'Que la dApp no tiene frontend',
            'b' => 'Que el <b>backend tradicional se reemplaza, en gran parte, por smart contracts</b> que se ejecutan en una blockchain',
            'c' => 'Que la dApp no usa JavaScript',
            'd' => 'Que la dApp no guarda datos'
        ],
        'correcta' => 'b',
        'porque'   => 'Es literal en tus apuntes y es la mejor diapositiva de la exposicion: misma forma (usuario &rarr; frontend &rarr; logica &rarr; datos), distinto sitio donde vive la logica.'
    ],
    'm2' => [
        'texto'    => 'El frontend de tu dApp esta servido por Netlify, que es un hosting normal. &iquest;Eso la descalifica como dApp?',
        'opciones' => [
            'a' => 'Si, tendria que estar en IPFS para contar',
            'b' => 'No: casi todas las dApps reales tienen un frontend Web2 tradicional que habla con un backend Web3 (el contrato). Esa combinacion es el patron estandar',
            'c' => 'Si, porque Netlify es una empresa centralizada',
            'd' => 'No, porque Netlify usa blockchain internamente'
        ],
        'correcta' => 'b',
        'porque'   => 'Te lo pueden sacar como &laquo;pega&raquo; en la expo. Adelantate tu: lo que define a la dApp es donde vive la <b>logica y los datos</b>, no donde se sirve el HTML.'
    ],
    'm3' => [
        'texto'    => '&iquest;Que es exactamente el <b>ABI</b>?',
        'opciones' => [
            'a' => 'El codigo compilado del contrato',
            'b' => 'Un <b>manual de instrucciones</b>: una descripcion de que funciones y eventos tiene el contrato, con sus parametros y lo que devuelven. No es codigo que se ejecute',
            'c' => 'La direccion del contrato en la blockchain',
            'd' => 'La llave privada que firma las transacciones'
        ],
        'correcta' => 'b',
        'porque'   => 'La blockchain solo guarda <b>bytecode</b>, que es binario ilegible. El ABI se genera aparte al compilar y es lo que permite a ethers.js, MetaMask o Etherscan saber como hablarle a ese binario.'
    ],
    'm4' => [
        'texto'    => 'En tu <code>donaciones.js</code> el ABI esta escrito a mano en formato corto. &iquest;Es el ABI completo del contrato?',
        'opciones' => [
            'a' => 'Si, siempre es el completo',
            'b' => 'No: es un <b>subconjunto</b> (human-readable ABI) con solo lo que el frontend necesita. El completo lo genera Hardhat en JSON dentro de <code>artifacts/</code>',
            'c' => 'No, es una version cifrada',
            'd' => 'Si, pero sin los eventos'
        ],
        'correcta' => 'b',
        'porque'   => 'Buen detalle para la expo: tu contrato tiene <code>donationCount()</code> y <code>withdrawalCount()</code> que <b>si existen</b> en la blockchain, pero no estan en ese ABI. Cualquiera podria llamarlas desde Etherscan.'
    ],
    'm5' => [
        'texto'    => 'El ABI de <code>withdraw</code> no menciona el modifier <code>onlyNGO</code>. &iquest;Que significa eso?',
        'opciones' => [
            'a' => 'Que el modifier no funciona',
            'b' => 'Que los modifiers son logica <b>interna</b> de Solidity, invisible desde fuera: cualquiera puede <em>intentar</em> llamar <code>withdraw</code>, y descubre que falla solo cuando el <code>require</code> de adentro lo rechaza',
            'c' => 'Que hay que agregarlo al ABI a mano',
            'd' => 'Que el contrato esta mal compilado'
        ],
        'correcta' => 'b',
        'porque'   => 'Refuerza lo de la pagina anterior: el ABI describe la <b>puerta</b>, no las reglas de quien puede pasar. Las reglas se aplican dentro.'
    ],
    'm6' => [
        'texto'    => 'Nunca escribiste una funcion llamada <code>totalDonated()</code>, pero el ABI la tiene y el frontend la llama. &iquest;De donde salio?',
        'opciones' => [
            'a' => 'La genera ethers.js automaticamente',
            'b' => 'La genera <b>Solidity</b>: cuando una variable se declara <code>public</code>, crea sola una funcion getter con ese nombre',
            'c' => 'La creo Hardhat al desplegar',
            'd' => 'Viene incluida en todos los contratos'
        ],
        'correcta' => 'b',
        'porque'   => 'Detalle fino que impresiona: <code>uint256 public totalDonated;</code> produce un getter que, de cara afuera, se comporta como cualquier otra funcion.'
    ],
    'm7' => [
        'texto'    => '&iquest;Que es lo que realmente conecta tu JavaScript con la blockchain?',
        'opciones' => [
            'a' => 'ethers.js',
            'b' => '<code>window.ethereum</code>, un objeto que MetaMask <b>inyecta</b> en cada pagina que visitas. Tu nunca lo programaste: aparece porque tienes la extension',
            'c' => 'Un fetch a la API de Alchemy',
            'd' => 'Un WebSocket con Sepolia'
        ],
        'correcta' => 'b',
        'porque'   => 'ethers.js es solo la capa comoda encima. Sin ella tendrias que armar a mano el JSON con <code>method: "eth_sendTransaction"</code> y todos sus parametros.'
    ],
    'm8' => [
        'texto'    => 'Cuando firmas una transaccion en MetaMask, &iquest;donde ocurre la firma?',
        'opciones' => [
            'a' => 'En los nodos de Sepolia',
            'b' => '<b>Localmente</b>, dentro de la extension, en tu computadora. Tu llave privada nunca sale de ahi',
            'c' => 'En los servidores de MetaMask',
            'd' => 'En Alchemy'
        ],
        'correcta' => 'b',
        'porque'   => 'Es una de las preguntas mas probables del publico. Lo que viaja a la red es la transaccion <b>ya firmada</b>, nunca la llave.'
    ],
    'm9' => [
        'texto'    => 'Tu codigo hace <code>const tx = await contract.donate(...)</code> y luego <code>await tx.wait()</code>. &iquest;Por que hacen falta las dos?',
        'opciones' => [
            'a' => 'Por compatibilidad con navegadores viejos',
            'b' => 'La primera devuelve el objeto de transaccion enseguida (con su hash) pero <b>sin confirmar</b>; <code>tx.wait()</code> se queda preguntando por RPC hasta que entra en un bloque',
            'c' => '<code>wait()</code> vuelve a mandar la transaccion',
            'd' => '<code>wait()</code> firma la transaccion'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la diferencia entre &laquo;la mande&raquo; y &laquo;quedo escrita&raquo;. Solo despues del <code>wait()</code> tiene sentido llamar a <code>loadData()</code> para redibujar los numeros.'
    ],
    'm10' => [
        'texto'    => '&iquest;Que significa <b>RPC</b> y que es &laquo;el RPC de Sepolia&raquo;?',
        'opciones' => [
            'a' => 'Es la red de nodos de Sepolia',
            'b' => 'Remote Procedure Call: un protocolo para preguntarle algo a otra maquina. &laquo;El RPC de Sepolia&raquo; no es la red, es la <b>puerta</b> que un nodo expone para que le hagas esas preguntas',
            'c' => 'Es el lenguaje de los contratos',
            'd' => 'Es el formato de las direcciones'
        ],
        'correcta' => 'b',
        'porque'   => 'La red es Sepolia (p2p). El RPC es solo la forma de tocar la puerta de <b>uno</b> de esos nodos. Ethereum usa la variante JSON-RPC.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('3 · Arquitectura de una dApp', 'exposicion.pdf — la pila, ABI, ethers.js, window.ethereum, RPC');
?>

<div class="card">
  <h2>1. La pila, de arriba abajo</h2>
  <p>Esta es la diapositiva que mas te van a mirar. Reconstruyela de memoria:</p>

  <pre><code>Usuario
  ↓
<?php hueco(1, 14); ?>          (React, Angular, Vue, HTML + JS)
  ↓
<?php hueco(2, 14); ?>          (la libreria que traduce)
  ↓
<?php hueco(3, 14); ?>          (firma la transaccion)
  ↓
<?php hueco(4, 18); ?>      (las reglas, en Solidity)
  ↓
<?php hueco(5, 14); ?>          (donde queda escrito)</code></pre>

  <p>Y la de una aplicacion tradicional, para comparar:</p>

  <pre><code>Usuario
  ↓
Frontend
  ↓
<?php hueco(6, 14); ?>          (servidor de la empresa)
  ↓
<?php hueco(7, 16); ?>    (centralizada)
  ↓
Empresa</code></pre>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. dApp vs aplicacion tradicional</h2>

  <table class="datos">
    <tr><th>Aplicacion tradicional</th><th>dApp</th></tr>
    <tr><td>Depende de un <?php hueco(8, 12); ?> central</td>
        <td>Utiliza una red <?php hueco(9, 12); ?> distribuida</td></tr>
    <tr><td>La empresa controla el backend</td>
        <td>La logica importante vive en un <?php hueco(10, 18); ?></td></tr>
    <tr><td>Base de datos centralizada</td>
        <td>Los registros se almacenan en blockchain</td></tr>
    <tr><td>Se depende de una entidad central</td>
        <td>La informacion es verificada por multiples <?php hueco(11, 10); ?></td></tr>
    <tr><td>El usuario interactua con el sistema de la empresa</td>
        <td>El usuario interactua mediante una <?php hueco(12, 10); ?></td></tr>
  </table>

  <p>En tu proyecto, la parte Web2 clasica es solo el
     <?php hueco(41, 12); ?> estatico que sirve Netlify; toda la logica y los
     datos que importan viven en el <?php hueco(42, 12); ?> desplegado en Sepolia.</p>

  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Los siete pasos de una interaccion</h2>
  <p>El guion de la demo. Si te trabas, empieza por aqui y no te pierdes.</p>

  <ol>
    <li>El usuario interactua con el <?php hueco(13, 12); ?> : entra y presiona un boton.</li>
    <li>Se usa la wallet, que permite realizar y <?php hueco(14, 9); ?> la transaccion.</li>
    <li>La transaccion llega a la <?php hueco(15, 12); ?> blockchain.</li>
    <li>Los nodos reciben la informacion y ejecutan el mismo <?php hueco(16, 11); ?> .</li>
    <li>Los nodos llegan al mismo <?php hueco(17, 11); ?> .</li>
    <li>El resultado se registra en la <?php hueco(18, 12); ?> .</li>
    <li>El <?php hueco(19, 12); ?> muestra el resultado al usuario.</li>
  </ol>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. El ABI</h2>

  <p>ABI significa <?php hueco(20, 32); ?> — interfaz binaria de aplicacion.
     En una dApp es el contrato de comunicacion entre el frontend (JavaScript) y el smart
     contract (Solidity): le dice a JavaScript que <?php hueco(21, 12); ?>
     existen en el contrato, que <?php hueco(22, 12); ?> reciben y que datos
     <?php hueco(23, 12); ?> .</p>

  <pre><code>Frontend JavaScript
     ↓
    ABI     &lt;- el <?php hueco(24, 12); ?>
     ↓
Smart Contract Solidity</code></pre>

  <p>Hace falta porque la blockchain solo guarda <?php hueco(25, 12); ?> ,
     que es binario ilegible. El ABI se genera aparte al <?php hueco(26, 10); ?>
     y es lo que permite a ethers.js, MetaMask o Etherscan saber como hablarle.</p>

  <h3>Tres detalles que impresionan si los sueltas</h3>
  <ul>
    <li>El ABI no tiene el concepto de <code>struct</code>: lo traduce a un
        <?php hueco(27, 10); ?> , una lista ordenada de campos con su tipo.</li>
    <li><code>totalDonated()</code> nunca la escribiste: Solidity genera sola una funcion
        <?php hueco(28, 10); ?> porque la variable esta declarada
        <?php hueco(29, 9); ?> .</li>
    <li>En el evento <code>NewDonation</code>, la palabra <?php hueco(30, 10); ?>
        sobre <code>donor</code> hace que ese campo quede etiquetado para poder filtrar
        rapido (&laquo;dame todas las donaciones de esta direccion&raquo;) sin recorrer el historial entero.</li>
  </ul>

  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. ethers.js, window.ethereum y RPC</h2>

  <p><?php hueco(31, 12); ?> es una biblioteca que permite que aplicaciones
     JavaScript se comuniquen con Ethereum y con contratos inteligentes.
     Pero la pieza que <b>realmente</b> conecta tu JavaScript con la blockchain es
     <?php hueco(32, 18); ?> , un objeto que la extension de
     <?php hueco(33, 12); ?> inyecta en cada pagina web que visitas.</p>

  <p>Cuando confirmas, MetaMask firma la transaccion con tu llave
     <?php hueco(34, 10); ?> — eso pasa localmente, dentro de la extension,
     y esa llave nunca sale de tu computadora.</p>

  <p><b>RPC</b> significa <?php hueco(35, 26); ?> . Ethereum usa la variante
     <?php hueco(36, 12); ?> : todo nodo expone el mismo &laquo;menu&raquo; de
     preguntas posibles. Dos ejemplos del menu:</p>

  <table class="datos">
    <tr><th>Metodo</th><th>Que pide</th></tr>
    <tr><td><?php hueco(37, 20); ?></td><td>dame el bloque mas reciente</td></tr>
    <tr><td><code>eth_getBalance</code></td><td>dame el balance de esta direccion</td></tr>
    <tr><td><?php hueco(38, 26); ?></td><td>manda esta transaccion firmada</td></tr>
  </table>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php mc('m10'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. El puente entre el HTML y el JavaScript</h2>
  <p>La linea que lo une todo en tu <code>donaciones.js</code>:</p>

  <pre><code>const $ = (id) =&gt; <?php hueco(39, 30); ?>;</code></pre>

  <p>El HTML crea el elemento con un <code>id</code>, el JavaScript lo busca por ese id,
     y despues le engancha el comportamiento con
     <?php hueco(40, 18); ?>("click", ...).</p>

  <pre><code>&lt;button id="connectBtn"&gt;Conectar wallet&lt;/button&gt;
        ↓
$("connectBtn")  =  document.getElementById("connectBtn")
        ↓
$("connectBtn").addEventListener("click", async () =&gt; { ... })</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. El flujo completo del boton &laquo;Donar&raquo;</h2>
  <p>Leelo dos veces antes de la demo. Es literalmente lo que va a pasar en pantalla:</p>

  <pre class="flujo"><code>Clic en "Donar"
   ↓  el listener de JS puro se dispara
contract.donate(mensaje, {value})
   ↓  ethers.js lo traduce a calldata usando el ABI
provider.getSigner()  →  window.ethereum
   ↓  la puerta que inyecta MetaMask
MetaMask muestra la ventana de confirmacion
   ↓  firmas con tu llave privada (nunca sale de tu compu)
MetaMask manda la transaccion firmada por su RPC
   ↓
la red p2p de Sepolia valida y mina un bloque
   ↓
el contrato actualiza su estado (totalDonated, lista de donaciones)
   ↓
tx.wait() detecta la confirmacion (mas llamadas RPC)
   ↓
loadData()  →  totalDonated(), getDonations()...
   ↓
la pagina redibuja los numeros y el historial</code></pre>

  <?php mc('m9'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../SmartContracts/index.php', '../MiDapp/index.php');
