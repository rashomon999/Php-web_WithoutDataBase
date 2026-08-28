<?php
/* ==========================================================================
   CompuNet 3 / dApps / Nuestra demo: tecnologias y flujo
   Enfocado en la EXPOSICION: que es cada pieza, que papel jugo y como
   encajan. No se pide escribir codigo.
   ========================================================================== */

$CSS = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- 1. las capas del flujo --- */
    1  => ['frontend'],
    2  => ['ethers.js', 'ethers'],
    3  => ['wallet', 'metamask'],
    4  => ['smart contract', 'contrato inteligente', 'contrato'],
    5  => ['sepolia'],
    6  => ['blockchain'],

    /* --- 2. las tecnologias --- */
    7  => ['solidity'],
    8  => ['hardhat'],
    9  => ['ethers.js', 'ethers'],
    10 => ['metamask'],
    11 => ['alchemy'],
    12 => ['sepolia'],
    13 => ['netlify'],
    14 => ['etherscan'],

    /* --- 3. la red por dentro --- */
    15 => ['nodo'],
    16 => ['rpc'],
    17 => ['peer-to-peer', 'p2p', 'peer to peer'],
    18 => ['cliente-servidor', 'cliente servidor'],
    19 => ['sincronizado', 'sincronizada', 'sincronizar'],
    20 => ['protocolo'],
    21 => ['11155111'],
    22 => ['testnet', 'red de pruebas'],

    /* --- 4. dApp vs app tradicional --- */
    23 => ['servidor'],
    24 => ['contrato'],
    25 => ['wallet'],
    26 => ['web3'],
    27 => ['descentralizada'],
    28 => ['estatico', 'estatica'],

    /* --- 5. el contrato como concepto --- */
    29 => ['codigo'],
    30 => ['estado'],
    31 => ['inmutable'],
    32 => ['donado'],
    33 => ['retirado'],
    34 => ['balance'],
    35 => ['razon'],
    36 => ['ong'],

    /* --- 6. el ABI --- */
    37 => ['abi'],
    38 => ['bytecode'],
    39 => ['lista'],

    /* --- 7. desplegar --- */
    40 => ['nuevo'],
    41 => ['direccion'],
    42 => ['una'],

    /* --- 8. que aguanta y que no --- */
    43 => ['interfaz'],
    44 => ['contrato'],
    45 => ['nodos'],

    /* --- 9. gas y ETH de prueba --- */
    46 => ['gas'],
    47 => ['faucet'],
    48 => ['mainnet'],
    49 => ['gratis'],
    50 => ['abuso'],

     52 => ['la libreria que sirve de intermediario entre JavaScript y la blockchain'],
    53 => ['la extension del navegador'],
    54 => ['con la llave privada'],
    55 => ['quien puede donar'],
    56 => ['quien puede retirar'],
    57 => ['que queda registrado'],
    58 => ['la red publica de pruebas de Ethereum'],
    59 => ['el historial replicado en miles de nodos'],
    60 => ['Remote Procedure Call'],
   61 => ['un protocolo de comunicacion que permite'],
   62 => ['un programa ejecutar codigo'],
   63 => ['funciones en otra computadora'],
   64 => ['traves de una red de forma transparente'],
   65 => ['es una red blockchain de prueba de Ethereum'],
   66 => ['utilizada para desarrollar y probar Smart Contracts'],
   67 => ['DApps sin utilizar ETH de la red principal'],

   /* --- Hardhat --- */
   68 => ['es un entorno de desarrollo para Ethereum'],
   69 => ['que nos permite compilar, probar y desplegar Smart Contracts'],
   70 => ['compilar y desplegar el contrato TransparentDonations'],

   /* --- Alchemy --- */
   71 => ['es un proveedor de infraestructura'],
   72 => ['que nos da acceso mediante RPC a nodos conectados a la red Sepolia'],
   73 => ['para enviar la transaccion de despliegue del Smart Contract a Sepolia'],

   /* --- MetaMask --- */
   74 => ['es una wallet de criptomonedas'],
   75 => ['que permite a los usuarios gestionar sus cuentas'],
   76 => ['y conectarse con aplicaciones descentralizadas (DApps)'],
   77 => ['para firmar y autorizar transacciones en redes blockchain como Ethereum'],


];


/* Practicamente todo es texto en castellano: no importan mayusculas ni tildes */
$TEXTO = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,22,23,24,25,26,27,28,
          29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La mejor forma de describir <b>Alchemy</b> en una frase es:',
        'opciones' => [
            'a' => 'Tu nodo, la puerta de entrada a Sepolia',
            'b' => 'Un <b>proveedor de acceso RPC</b>: opera una flota de nodos ya sincronizados con la red y te presta acceso por una URL, para no tener que correr tu propio nodo',
            'c' => 'La empresa que hospeda tu contrato inteligente',
            'd' => 'El servicio que valida las transacciones de tu dApp'
        ],
        'correcta' => 'b',
        'porque'   => '&laquo;Tu nodo&raquo; se queda corto en tres cosas: <b>no es tuyo</b> (es de ellos), <b>no es uno</b> (es una flota detras de una sola URL) y <b>no te lo entregan</b> (te prestan acceso). Alchemy no valida ni guarda nada: eso lo hace la red entera.'
    ],
    'm2' => [
        'texto'    => 'Entonces, &iquest;que hace exactamente Alchemy por tu proyecto?',
        'opciones' => [
            'a' => 'Guarda el contrato en sus servidores',
            'b' => 'Solo te da <b>acceso</b> a una cadena que ya existe. Todo el trabajo real (validar, minar, replicar) lo hace la red de Sepolia, no Alchemy',
            'c' => 'Optimiza el contrato antes de desplegarlo',
            'd' => 'Cobra una comision del gas'
        ],
        'correcta' => 'b',
        'porque'   => 'Y podrias haberlo hecho tu: instalando un cliente de Ethereum y sincronizandolo tendrias tu propio RPC local. Alchemy solo te ahorra ese trabajo.'
    ],
    'm3' => [
        'texto'    => 'Si Alchemy cerrara mañana, &iquest;que pasaria con tu contrato?',
        'opciones' => [
            'a' => 'Se perderia, porque esta alojado ahi',
            'b' => 'Nada: <b>sigue existiendo igual</b>. Miles de nodos independientes tienen la misma copia. Solo perderias esa puerta comoda y tendrias que entrar por otra',
            'c' => 'Habria que volver a desplegarlo',
            'd' => 'Quedaria congelado hasta encontrar otro proveedor'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la prueba mental que demuestra que Alchemy es <b>la puerta</b>, no la casa.'
    ],
    'm4' => [
        'texto'    => 'En tu demo, &iquest;quien usa Alchemy y cuando?',
        'opciones' => [
            'a' => 'La pagina, cada vez que alguien dona',
            'b' => 'Solo <b>Hardhat</b>, desde tu computador, y solo <b>una vez</b>: para mandar la transaccion que desplego el contrato',
            'c' => 'MetaMask, siempre',
            'd' => 'Etherscan, para leer los datos'
        ],
        'correcta' => 'b',
        'porque'   => 'Cuando alguien dona en la pagina en vivo, la transaccion sale por el RPC que tiene configurado <b>su propia MetaMask</b>. Cada visitante entra por su puerta.'
    ],
    'm5' => [
        'texto'    => '&iquest;Que es un <b>nodo</b>?',
        'opciones' => [
            'a' => 'Un servidor especial de Ethereum',
            'b' => 'Una <b>computadora normal</b> con un programa cliente de Ethereum corriendo: guarda una copia del historial, se conecta con otros nodos y valida lo que llega',
            'c' => 'Un bloque de la cadena',
            'd' => 'Una cuenta con ETH'
        ],
        'correcta' => 'b',
        'porque'   => 'No hay nada especial en el hardware. Puede ser un servidor en la nube o el PC de alguien en su casa; solo necesita disco y ancho de banda.'
    ],
    'm6' => [
        'texto'    => 'Entonces, &laquo;la blockchain&raquo;, en concreto, &iquest;que es?',
        'opciones' => [
            'a' => 'Una base de datos en la nube',
            'b' => '<b>Bytes reales en discos reales</b>, duplicados en miles de nodos independientes. Sepolia es la suma de todas esas copias identicas, sincronizadas entre si',
            'c' => 'Un servicio que ofrecen empresas como Alchemy',
            'd' => 'Un protocolo, sin datos propios'
        ],
        'correcta' => 'b',
        'porque'   => 'No es abstracto ni flota en ningun lado: por eso es tan dificil de alterar, habria que cambiar miles de copias a la vez.'
    ],
    'm7' => [
        'texto'    => '&iquest;Donde hay cliente-servidor y donde peer-to-peer en tu demo?',
        'opciones' => [
            'a' => 'Todo es peer-to-peer',
            'b' => 'Son <b>dos capas superpuestas</b>: entre tu y el proveedor RPC es cliente-servidor; entre los nodos de Ethereum entre si es peer-to-peer',
            'c' => 'Todo es cliente-servidor',
            'd' => 'Depende de la wallet'
        ],
        'correcta' => 'b',
        'porque'   => 'Tu nunca te vuelves parte de la red p2p: le hablas a un nodo, y <b>ese nodo</b> si esta adentro hablando con el resto del mundo.'
    ],
    'm8' => [
        'texto'    => '&iquest;Que hace que esto sea una <b>dApp</b> y no una web normal?',
        'opciones' => [
            'a' => 'Que usa criptomonedas',
            'b' => 'Que el <b>backend</b> (la logica y los datos) vive en un contrato en la blockchain, no en un servidor tuyo, y la identidad del usuario es su <b>wallet</b>, no una cuenta que creo contigo',
            'c' => 'Que el frontend esta en Netlify',
            'd' => 'Que el codigo es abierto'
        ],
        'correcta' => 'b',
        'porque'   => 'El frontend sigue siendo una web normal y corriente: eso es lo habitual. Lo que cambia es <b>a que le habla</b>.'
    ],
    'm9' => [
        'texto'    => 'Alguien dona 0.01 ETH. &iquest;Que cambia exactamente?',
        'opciones' => [
            'a' => 'Se actualiza el codigo del contrato',
            'b' => 'Cambia solo el <b>estado</b> guardado en la blockchain (totales, historial, balance). El <b>codigo</b> del contrato y los archivos de la pagina no se tocan nunca',
            'c' => 'Se despliega una version nueva',
            'd' => 'Se actualiza la base de datos de Netlify'
        ],
        'correcta' => 'b',
        'porque'   => 'Tres capas distintas: <b>codigo</b> (fijo), <b>estado</b> (cambia), y <b>lo que ves</b> (una foto momentanea que el navegador vuelve a pedir cada vez).'
    ],
    'm10' => [
        'texto'    => 'La pagina oculta el panel de retiro si no eres la ONG. &iquest;Eso es lo que da la seguridad?',
        'opciones' => [
            'a' => 'Si, por eso nadie mas puede retirar',
            'b' => 'No: ocultarlo es solo <b>cosmetico</b>. Quien de verdad rechaza un retiro ajeno es el <b>contrato</b>, que comprueba la direccion antes de mover un solo wei',
            'c' => 'Si, porque MetaMask lo valida',
            'd' => 'No, y el contrato tampoco lo impide'
        ],
        'correcta' => 'b',
        'porque'   => 'Cualquiera podria saltarse tu pagina y llamar al contrato desde Etherscan. La seguridad <b>nunca</b> vive en el frontend: esa es una idea clave de la exposicion.'
    ],
    'm11' => [
        'texto'    => 'Si alguien duda de tus numeros en la demo, &iquest;como se lo demuestras?',
        'opciones' => [
            'a' => 'Enseñando el codigo del frontend',
            'b' => 'Buscando la direccion del contrato en <b>sepolia.etherscan.io</b>: ahi se ve cada donacion, cada retiro y el balance, leidos directamente de los nodos',
            'c' => 'Mostrando la consola del navegador',
            'd' => 'Mostrando el panel de Alchemy'
        ],
        'correcta' => 'b',
        'porque'   => 'Ese es el momento fuerte: <b>no es &laquo;confia en la ONG&raquo;, es &laquo;verificalo tu mismo&raquo;</b>, en un sitio que nadie controla unilateralmente.'
    ],
    'm12' => [
        'texto'    => 'Vuelves a correr el despliegue. &iquest;Que pasa con el contrato anterior?',
        'opciones' => [
            'a' => 'Se reemplaza por el nuevo',
            'b' => 'Nace uno <b>nuevo, en otra direccion</b>, con el historial en cero. El anterior sigue existiendo intacto, aunque ya nadie lo use',
            'c' => 'Se borra de la blockchain',
            'd' => 'Los dos comparten el mismo historial'
        ],
        'correcta' => 'b',
        'porque'   => 'Desplegar <b>nunca</b> es sobreescribir, como si subieras cambios a un servidor. Solo se puede añadir, nunca modificar lo ya escrito.'
    ],
    'm13' => [
        'texto'    => 'Netlify desaparece mañana. &iquest;Que se pierde?',
        'opciones' => [
            'a' => 'Todo, donaciones incluidas',
            'b' => 'Solo la <b>interfaz</b>. El contrato y su historial siguen intactos en Sepolia: cualquiera podria seguir usandolo desde Etherscan o desde otro frontend',
            'c' => 'Hay que volver a desplegar el contrato',
            'd' => 'Los fondos se devuelven solos'
        ],
        'correcta' => 'b',
        'porque'   => 'Justo lo contrario de una app tradicional, donde si cae el servidor cae todo: aqui el backend ya no depende de ti.'
    ],
    'm14' => [
        'texto'    => '&laquo;&iquest;El ETH de Sepolia es gratis e infinito?&raquo;',
        'opciones' => [
            'a' => 'Si, se genera solo',
            'b' => 'Es gratis <b>porque no vale nada</b>, pero no infinito: alguien mantiene el faucet con un balance finito y limita la entrega para evitar abusos',
            'c' => 'No, cuesta unos centavos',
            'd' => 'Es infinito pero hay que minarlo'
        ],
        'correcta' => 'b',
        'porque'   => 'El limite de &laquo;un envio cada 24 horas&raquo; es control de <b>abuso</b>, no un indicador de que el ETH de prueba tenga valor economico.'
    ],
    'm15' => [
        'texto'    => 'En una frase, &iquest;que es el <b>ABI</b>?',
        'opciones' => [
            'a' => 'El codigo compilado que se sube a la blockchain',
            'b' => 'La <b>lista de funciones</b> del contrato en un formato que ethers.js entiende: le permite al frontend saber que puede llamar y con que parametros',
            'c' => 'La direccion del contrato',
            'd' => 'El historial de transacciones'
        ],
        'correcta' => 'b',
        'porque'   => 'La blockchain solo guarda <b>bytecode</b> ilegible. Sin el ABI, tu pagina no sabria ni que funciones existen ni como empaquetar los datos.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('4 · Nuestra demo: tecnologias y flujo', 'Que es cada pieza, que papel jugo y como encajan — sin escribir codigo');
?>

<div class="card">
  <h2>1. El flujo, capa por capa</h2>
  <p>El esquema de la diapositiva, de izquierda a derecha. Escribe el nombre de cada capa.</p>

  <table class="datos">
    <tr><th>Papel</th><th>Capa</th><th>En nuestra demo</th></tr>
    <tr><td>Interfaz de usuario</td><td><?php hueco(1, 14); ?></td><td>la pagina que ve la gente </td></tr>
    <tr><td>Conexion con la wallet</td><td><?php hueco(2, 14); ?></td><td><?php hueco(52, 71); ?> </td></tr>
     <tr><td>Las reglas del negocio</td><td><?php hueco(4, 18); ?></td><td><?php hueco(55, 18); ?> , <?php hueco(56, 18); ?> ,  <?php hueco(57, 20); ?> </td></tr>
     <tr><td>El registro permanente</td><td><?php hueco(6, 14); ?></td><td><?php hueco(59, 39); ?> </td></tr>
  </table>
    
    <p>RPC significa: <?php hueco(60, 22); ?> </p>
    <p>
        <?php hueco(61, 39); ?>
       a 
     <?php hueco(62, 26); ?>
       o 
     <?php hueco(63, 28); ?>
       o servidor a 
     <?php hueco(64, 39); ?>
      .    
    </p>
    <p>
    Sepolia
    <?php hueco(65, 42); ?>
       , 
    <?php hueco(66, 50); ?>
      y
    <?php hueco(67, 42); ?>
      .
    </p>
    <p>
    Hardhat
    <?php hueco(68, 40); ?>
      <?php hueco(69, 60); ?>
      . En nuestro proyecto lo utilizamos principalmente para
    <?php hueco(70, 52); ?>
      en la red Sepolia .
    </p>
    <p>
    Alchemy
    <?php hueco(71, 33); ?>
      <?php hueco(72, 65); ?>
      . En nuestro caso, Hardhat utiliza esa conexion RPC
    <?php hueco(73, 67); ?>
      .
    </p>
    <p>
    MetaMask
    <?php hueco(74, 30); ?>
      <?php hueco(75, 47); ?>
      <?php hueco(76, 53); ?>
      <?php hueco(77, 69); ?>
      .
    </p>
  <div class="avisoflujo">
    <b>La frase que resume todo:</b> el frontend es solo una ventana.
    Lo que de verdad importa &mdash; los fondos, el historial, quien es la ONG &mdash;
    se calcula y se guarda en la blockchain. Si borraras la pagina entera, el contrato
    seguiria existiendo y funcionando.
  </div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Las tecnologias: una linea cada una</h2>
  <p>Si te preguntan &laquo;&iquest;y esto para que lo usaste?&raquo;, esta es la respuesta.</p>

  <table class="datos">
    <tr><th>Tecnologia</th><th>Que es y para que la usamos</th></tr>
    <tr><td><?php hueco(7, 14); ?></td><td>el lenguaje de programacion en el que se escriben los contratos inteligentes</td></tr>
    <tr><td><?php hueco(8, 14); ?></td><td>el entorno de desarrollo en tu computador: compila, prueba y despliega el contrato</td></tr>
    <tr><td><?php hueco(9, 14); ?></td><td>la libreria de JavaScript que permite al frontend hablar con el contrato y con la wallet</td></tr>
    <tr><td><?php hueco(10, 14); ?></td><td>la wallet del navegador: guarda la llave privada, es la identidad del usuario y firma cada transaccion</td></tr>
    <tr><td><?php hueco(11, 14); ?></td><td>el proveedor de acceso RPC: opera nodos ya sincronizados y nos presta acceso por una URL</td></tr>
    <tr><td><?php hueco(12, 14); ?></td><td>la red publica de pruebas de Ethereum donde vive de verdad el contrato</td></tr>
    <tr><td><?php hueco(13, 14); ?></td><td>el hosting estatico gratuito que sirve la pagina 24/7 sin depender de tu computador</td></tr>
    <tr><td><?php hueco(14, 14); ?></td><td>el explorador publico: lee de los nodos y muestra transacciones, balances y contratos</td></tr>
  </table>

  <div class="nota">
    <b>Ojo con la descripcion de Alchemy.</b> Decir &laquo;tu nodo&raquo; se queda corto:
    no es <b>tuyo</b>, no es <b>uno solo</b> (es una flota detras de una URL) y no te lo
    entregan a ti (te prestan <b>acceso</b>). Y en esta demo solo lo uso Hardhat, una vez,
    para desplegar.
  </div>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. La red por dentro</h2>

  <p>Un <?php hueco(15, 10); ?> es una computadora normal con un programa cliente de
     Ethereum corriendo. Hace tres cosas: guarda una copia del historial, se conecta con otros
     para mantenerse <?php hueco(19, 14); ?> , y valida lo que llega antes de aceptarlo.</p>

  <p>Para pedirle algo a un nodo se usa un <?php hueco(16, 8); ?> , que es el
     <b>protocolo</b> (el idioma) con el que se le hace una pregunta y responde. Ojo: no es una
     red, es solo la puerta para tocar a <b>un</b> nodo.</p>

  <div class="avisoflujo">
    <b>Las dos capas que es facil confundir.</b><br>
    Entre <b>tu y el proveedor RPC</b>: <?php hueco(18, 18); ?> clasico &mdash;
    le mandas una peticion a una URL y te responde.<br>
    Entre <b>los nodos de Ethereum entre si</b>: <?php hueco(17, 16); ?> &mdash;
    todos iguales, sin nodo jefe.<br>
    Tu nunca te vuelves parte de esa segunda red.
  </div>

  <p>Conviene separar el <?php hueco(20, 12); ?> Ethereum (las reglas) de las
     <b>redes</b> que lo corren. Mainnet y Sepolia hablan el mismo idioma pero son cadenas
     completamente separadas, cada una con su propio historial y su propio chain ID:
     el de Sepolia es <?php hueco(21, 12); ?> .</p>

  <p>Sepolia es una <?php hueco(22, 16); ?> : funciona exactamente igual que la red
     real, pero con ETH que no vale nada. Y no es &laquo;tuya&raquo;: es una sola red compartida
     por todo el mundo, asi que tu contrato es visible para cualquiera, entre por la puerta que entre.</p>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. dApp frente a app tradicional</h2>

  <table class="datos">
    <tr><th>&nbsp;</th><th>App tradicional (Web2)</th><th>Nuestra dApp (Web3)</th></tr>
    <tr><td>Donde vive la logica</td><td>en un <?php hueco(23, 12); ?> que controla el dueño</td><td>en un <?php hueco(24, 12); ?> en la blockchain</td></tr>
    <tr><td>Identidad del usuario</td><td>usuario y contraseña en una base de datos</td><td>su propia <?php hueco(25, 12); ?></td></tr>
    <tr><td>Quien puede cambiar las reglas</td><td>el dueño, cuando quiera</td><td>nadie, ni el creador</td></tr>
    <tr><td>Quien guarda los datos</td><td>una empresa</td><td>miles de nodos independientes</td></tr>
  </table>

  <p>A ese modelo se le llama <?php hueco(26, 10); ?> : aplicaciones donde el
     backend no es un servidor centralizado sino una blockchain
     <?php hueco(27, 18); ?> entre muchos participantes.</p>

  <p>La unica parte de nuestro proyecto que sigue siendo Web2 clasico es el frontend
     <?php hueco(28, 12); ?> que sirve Netlify. Eso es lo normal: casi todas las dApps
     reales combinan un frontend corriente con un backend en blockchain.</p>

  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. El contrato: lo que nunca cambia y lo que si</h2>

  <p>Es la idea que hace especial a un smart contract:</p>

  <table class="datos">
    <tr><th>&nbsp;</th><th>Que incluye</th><th>&iquest;Cambia?</th></tr>
    <tr><td>El <?php hueco(29, 10); ?></td><td>las reglas: quien puede donar, quien puede retirar, con que condiciones</td><td>nunca, es <?php hueco(31, 12); ?></td></tr>
    <tr><td>El <?php hueco(30, 10); ?></td><td>los totales, el historial de donaciones y retiros, el balance</td><td>con cada transaccion</td></tr>
  </table>

  <p>Y lo importante: las reglas fijas controlan <b>como</b> puede cambiar el estado.
     No se mueve de cualquier forma, solo de las que el contrato permite. De ahi sale la cuenta
     que cualquiera puede verificar:</p>

  <pre><code>total <?php hueco(32, 10); ?>  &minus;  total <?php hueco(33, 10); ?>  =  <?php hueco(34, 10); ?> del contrato</code></pre>

  <p>Ademas, cada retiro exige una <?php hueco(35, 10); ?> obligatoria, que queda
     grabada para siempre junto al monto y la fecha: no hay forma de sacar dinero en silencio.
     Y solo puede retirar la direccion registrada como <?php hueco(36, 8); ?> al
     desplegar, que tampoco se puede cambiar despues.</p>

  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. El ABI: el puente entre el frontend y el contrato</h2>

  <p>Al compilar, Solidity produce dos cosas. Lo unico que se sube a la blockchain es el
     <?php hueco(38, 12); ?> , que es binario ilegible. Aparte queda el
     <?php hueco(37, 8); ?> , que es la <?php hueco(39, 10); ?> de funciones
     y eventos del contrato, en un formato que ethers.js entiende.</p>

  <p>Sin el, tu pagina no sabria ni que funciones existen ni como empaquetar los datos para
     llamarlas. Es literalmente el manual de instrucciones de una caja negra.</p>

  <?php mc('m15'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Desplegar no es &laquo;subir cambios&raquo;</h2>

  <p>Desplegar el contrato se hace <?php hueco(42, 8); ?> sola vez. Cada vez que
     lo repites se crea un contrato completamente <?php hueco(40, 10); ?> , con una
     <?php hueco(41, 12); ?> completamente nueva y su historial en cero.
     El anterior sigue existiendo tal cual, para siempre, aunque ya nadie lo use.</p>

  <p>Por eso en una blockchain no se <b>sobreescribe</b>: solo se <b>añade</b>. Tu despliegue
     no modifico nada de lo que ya habia en Sepolia; se sumo al final de la cadena, como una
     pagina nueva en un libro donde no se puede tachar ninguna pagina anterior.</p>

  <?php mc('m12'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Que aguanta y que no</h2>
  <p>Buena pregunta de examen: &iquest;de que depende realmente tu dApp?</p>

  <table class="datos">
    <tr><th>Si desaparece...</th><th>Que pasa</th></tr>
    <tr><td>Netlify</td><td>se pierde la <?php hueco(43, 12); ?> , pero el contrato sigue vivo y usable desde Etherscan</td></tr>
    <tr><td>Alchemy</td><td>nada: solo era una puerta; se entra por otra</td></tr>
    <tr><td>Tu computador</td><td>nada: el <?php hueco(44, 12); ?> ya no depende de ti desde el momento en que se desplego</td></tr>
    <tr><td>La mitad de los <?php hueco(45, 10); ?> de Sepolia</td><td>la red sigue funcionando con el resto: por eso esta replicada</td></tr>
  </table>

  <?php mc('m3'); ?>
  <?php mc('m13'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>9. El gas y el ETH de prueba</h2>

  <p>Cambiar el estado del contrato (donar, retirar) cuesta <?php hueco(46, 8); ?> ,
     que es la comision por ejecutar la transaccion. Leer datos, en cambio, es siempre
     <?php hueco(49, 10); ?> .</p>

  <p>En Sepolia ese gas se paga con ETH de prueba, que se consigue en un
     <?php hueco(47, 10); ?> : un servicio que regala ETH sin valor a cualquier direccion.
     Limita la entrega (uno cada 24 horas) como control de <?php hueco(50, 10); ?> ,
     no porque el ETH de prueba valga algo.</p>

  <p>En <?php hueco(48, 12); ?> , la red real, ese mismo gas se pagaria con ETH que
     cuesta dinero de verdad. Todo lo demas funciona exactamente igual: por eso una testnet
     sirve para aprender sin arriesgar nada.</p>

  <?php mc('m14'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Stack/index.php', '../Arquitectura/index.php');
