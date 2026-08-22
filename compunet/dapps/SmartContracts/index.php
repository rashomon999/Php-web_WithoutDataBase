<?php
/* ==========================================================================
   CompuNet 3 / dApps / Smart Contracts
   Fuente: exposicion.pdf (smartContract, solidity, bosquejo 3, exp)
   ========================================================================== */

$CSS = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- definicion --- */
    1  => ['Los contratos inteligentes son contratos digitales almacenados'],
    2  => ['una blockchain'],
    3  => ['se ejecutan automaticamente cuando se cumplen terminos'],
    4  => ['condiciones predeterminados'],
    5  => ['intermediario'],
    6  => ['x'],
    7  => ['y'],

    /* --- ejemplo alquiler --- */
    8  => ['500'],
    9  => ['acceso'],

    /* --- codigo Caja (Solidity) --- */
    10 => ['contract'],
    11 => ['uint'],
    12 => ['function'],
    13 => ['public'],
    14 => ['view'],
    15 => ['returns'],

    /* --- como funcionan, 5 pasos --- */
    16 => ['condicion'],
    17 => ['nodos'],
    18 => ['mismo'],
    19 => ['resultado'],
    20 => ['blockchain'],

    /* --- beneficios --- */
    21 => ['velocidad'],
    22 => ['inmediatamente'],
    23 => ['tercero'],
    24 => ['cifrados'],
    25 => ['cadena'],
    26 => ['intermediarios'],

    /* --- solidity --- */
    27 => ['solidity'],
    28 => ['ethereum'],
    29 => ['objetos'],
    30 => ['determinista'],

    /* --- inmutable vs mutable --- */
    31 => ['codigo'],
    32 => ['inmutable'],
    33 => ['estado'],
    34 => ['mutable'],
    35 => ['como'],

    /* --- DeFi --- */
    36 => ['garantia', 'colateral'],
    37 => ['verifica'],
    38 => ['prestamo'],
    39 => ['banco'],

    /* --- del proyecto --- */
    40 => ['require'],
    41 => ['ong'],
];

$TEXTO = [1,2,3,4,5,8,9,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,41];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Resume un contrato inteligente en una frase.',
        'opciones' => [
            'a' => 'Un documento PDF firmado digitalmente',
            'b' => 'Codigo almacenado en una blockchain que se ejecuta <b>automaticamente</b> cuando se cumplen condiciones predeterminadas: si ocurre X, entonces ejecuta Y, sin intermediario',
            'c' => 'Un acuerdo entre dos empresas de software',
            'd' => 'Una base de datos con reglas de validacion'
        ],
        'correcta' => 'b',
        'porque'   => 'Si te piden la definicion corta en la expo, esta es. Lo de &laquo;sin intermediario&raquo; es la parte que la gente recuerda.'
    ],
    'm2' => [
        'texto'    => '&iquest;Por que se llama &laquo;contrato&raquo; si es codigo?',
        'opciones' => [
            'a' => 'Porque hay que firmarlo ante notario',
            'b' => 'Porque funciona parecido a un acuerdo: en el tradicional A promete pagar y B entrega; aqui se cumple una condicion y el codigo ejecuta la accion',
            'c' => 'Porque tiene clausulas legales dentro',
            'd' => 'Porque lo redacta un abogado'
        ],
        'correcta' => 'b',
        'porque'   => 'La analogia funciona bien en clase: mismo esquema de &laquo;si tu haces esto, yo hago aquello&raquo;, pero quien lo hace cumplir es el codigo, no la confianza.'
    ],
    'm3' => [
        'texto'    => 'Una vez desplegado, &iquest;puedes cambiar lo que hace la funcion <code>donate()</code> de tu contrato?',
        'opciones' => [
            'a' => 'Si, editando el .sol y volviendo a compilar',
            'b' => 'No. El codigo queda congelado en esa direccion para siempre. Ni tu como creador puedes cambiarlo, agregar funciones ni quitar un <code>require</code>',
            'c' => 'Si, pero solo con permiso de los nodos',
            'd' => 'Si, pagando mas gas'
        ],
        'correcta' => 'b',
        'porque'   => 'Y eso es lo que hace creible la promesa. Si pudieras cambiar las reglas despues, volverias a estar pidiendo confianza.'
    ],
    'm4' => [
        'texto'    => 'Si el codigo es inmutable, &iquest;como es que <code>totalDonated</code> cambia cada vez que alguien dona?',
        'opciones' => [
            'a' => 'Porque el codigo si se puede modificar un poco',
            'b' => 'Porque lo inmutable es el <b>codigo</b>; el <b>estado</b> (las variables) si cambia — pero solo de las formas exactas que el codigo congelado permite',
            'c' => 'Porque los nodos lo recalculan cada bloque',
            'd' => 'Porque es una variable externa al contrato'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la distincion mas fina de toda tu exposicion y la que te hace quedar bien: el codigo fijo es <b>quien controla como</b> puede cambiar el estado. Por eso nadie puede inflar <code>totalDonated</code> sin mandar ETH de verdad.'
    ],
    'm5' => [
        'texto'    => 'Alguien pregunta: &laquo;&iquest;y si el contrato tiene un bug?&raquo;. &iquest;Que respondes?',
        'opciones' => [
            'a' => 'Se corrige con un parche en el servidor',
            'b' => 'Que es el riesgo real de este modelo: como el codigo es inmutable, un bug tambien queda congelado. Por eso se prueba antes (Hardhat), se audita, y a veces se despliega un contrato nuevo en otra direccion',
            'c' => 'Los nodos lo detectan y lo arreglan',
            'd' => 'No puede haber bugs porque esta en blockchain'
        ],
        'correcta' => 'b',
        'porque'   => 'Tus apuntes ya lo listan como limitacion: &laquo;vulnerabilidades de los contratos&raquo;. La inmutabilidad corta en las dos direcciones.'
    ],
    'm6' => [
        'texto'    => '&iquest;Que es <b>Solidity</b>?',
        'opciones' => [
            'a' => 'Una blockchain',
            'b' => 'El lenguaje de programacion mas usado para escribir contratos inteligentes en Ethereum y redes compatibles',
            'c' => 'Una wallet',
            'd' => 'Una libreria de JavaScript'
        ],
        'correcta' => 'b',
        'porque'   => 'Es un lenguaje de proposito especifico, orientado a objetos, pensado para definir reglas de forma precisa y <b>determinista</b>.'
    ],
    'm7' => [
        'texto'    => '&iquest;Por que el contrato tiene que ser <b>determinista</b>?',
        'opciones' => [
            'a' => 'Para que sea mas rapido',
            'b' => 'Porque miles de nodos lo ejecutan por separado y <b>todos tienen que llegar al mismo resultado</b>; si dependiera del azar o de la hora local, no habria consenso posible',
            'c' => 'Porque Solidity no soporta numeros aleatorios',
            'd' => 'Para ahorrar gas'
        ],
        'correcta' => 'b',
        'porque'   => 'Engancha directo con los cinco pasos: si cada nodo obtuviera un resultado distinto, no habria mayoria que guardar en la blockchain.'
    ],
    'm8' => [
        'texto'    => 'En tu contrato de donaciones, &iquest;que impide que alguien que no es la ONG retire los fondos?',
        'opciones' => [
            'a' => 'Una validacion en el JavaScript del frontend',
            'b' => 'Un <code>require</code> dentro del contrato (via el modifier <code>onlyNGO</code>), que corre en la blockchain y rechaza la transaccion',
            'c' => 'La contraseña de MetaMask',
            'd' => 'Que la funcion esta oculta en el frontend'
        ],
        'correcta' => 'b',
        'porque'   => 'Punto clave: una validacion en el frontend no protege nada, porque cualquiera puede llamar al contrato desde Etherscan saltandose tu pagina. La regla tiene que estar <b>dentro</b> del contrato.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('2 · Smart Contracts', 'exposicion.pdf — definicion, ejecucion, Solidity, inmutabilidad');
?>

<div class="card">
  <h2>1. Definicion</h2>

  <p>  <?php hueco(1, 62); ?>
       en   <?php hueco(2, 14); ?> que  
     <?php hueco(3, 55); ?>   y  
     <?php hueco(4, 26); ?> .</p>

  <p>Se usan para automatizar la ejecucion de un acuerdo, de modo que todos los
     participantes puedan estar inmediatamente seguros del resultado, sin la participacion
     de ningun <?php hueco(5, 14); ?> ni perdida de tiempo.</p>

  <div class="avisoflujo">
    <b>La idea principal, en una linea:</b><br>
    &laquo;Si ocurre <?php hueco(6, 4); ?> , entonces ejecuta
    <?php hueco(7, 4); ?> automaticamente, sin necesitar un intermediario.&raquo;
  </div>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. El ejemplo del alquiler</h2>
  <p>Un contrato de alquiler normal necesita dueño, inquilino, banco, documentos y
     <b>confianza</b> entre las partes. Un contrato inteligente diria:</p>

  <pre><code>SI el usuario paga <?php hueco(8, 6); ?> USDT
ENTONCES entregar <?php hueco(9, 10); ?> al apartamento</code></pre>

  <p>La blockchain se encarga de ejecutar esa regla. Fijate en lo que desaparece de la lista:
     el banco y la confianza.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. El ejemplo de codigo: la Caja</h2>
  <p>Este es el contrato minimo de tus apuntes. Completa las palabras de Solidity:</p>

  <pre><code><?php hueco(10, 10); ?> Caja {

    <?php hueco(11, 6); ?> dinero;

    <?php hueco(12, 10); ?> guardar(uint cantidad) <?php hueco(13, 8); ?> {
      dinero = cantidad;
    }

    function consultar() public <?php hueco(14, 6); ?> <?php hueco(15, 9); ?>(uint) {
      return dinero;
    }
}</code></pre>

  <div class="nota">
    <b>Dos palabras que te pueden preguntar.</b>
    <code>public</code> = la funcion se puede llamar desde fuera del contrato.
    <code>view</code> = la funcion solo <em>lee</em>, no modifica el estado; por eso no cuesta gas
    cuando la llamas desde fuera.
  </div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Como funcionan, paso a paso</h2>
  <p>Cuando se cumplen las condiciones:</p>

  <ol>
    <li>Se ejecuta la <?php hueco(16, 11); ?> establecida.</li>
    <li>Los <?php hueco(17, 9); ?> de la red reciben la informacion.</li>
    <li>Los nodos ejecutan el <?php hueco(18, 9); ?> contrato inteligente.</li>
    <li>Llegan al mismo <?php hueco(19, 11); ?> .</li>
    <li>El resultado se guarda en la <?php hueco(20, 12); ?> .</li>
  </ol>

  <p>De esta manera se evita que una unica entidad pueda modificar el resultado.</p>

  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Beneficios</h2>

  <p><b><?php hueco(21, 12); ?>, eficiencia y precision.</b>
     Una vez que se cumple una condicion, el contrato se ejecuta
     <?php hueco(22, 16); ?> . No hay documentos fisicos que procesar
     ni errores manuales que corregir.</p>

  <p><b>Confianza y transparencia.</b> Como no existe un
     <?php hueco(23, 9); ?> involucrado y los registros se comparten entre los
     participantes, no hace falta cuestionar si la informacion fue alterada para beneficio propio.</p>

  <p><b>Seguridad.</b> Los registros estan <?php hueco(24, 10); ?> , y como cada
     registro esta conectado con el anterior y el siguiente, un atacante tendria que modificar
     toda la <?php hueco(25, 9); ?> para cambiar un solo registro.</p>

  <p><b>Ahorro.</b> Eliminan la necesidad de <?php hueco(26, 15); ?>
     y, por extension, sus retrasos y costos asociados.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Solidity</h2>

  <p><?php hueco(27, 12); ?> es el lenguaje de programacion mas usado para escribir
     contratos inteligentes en <?php hueco(28, 12); ?> y redes compatibles.
     Es un lenguaje de proposito especifico orientado a
     <?php hueco(29, 10); ?> , diseñado para que los desarrolladores puedan definir
     las reglas de un contrato de forma precisa y <?php hueco(30, 14); ?> .</p>

  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Codigo inmutable, estado mutable</h2>
  <p>Esta distincion es la que separa una exposicion buena de una regular. Vale la pena
     tenerla lista.</p>

  <p>El <?php hueco(31, 9); ?> (la logica) es <?php hueco(32, 12); ?> :
     una vez desplegado, esas reglas quedan congeladas para siempre en esa direccion.
     Nadie, ni tu como creador, puede cambiar que hace <code>donate()</code>, agregar una
     funcion nueva, ni quitar el <?php hueco(40, 10); ?> que impide retirar a quien
     no es la <?php hueco(41, 6); ?>.</p>

  <p>El <?php hueco(33, 9); ?> (los datos y variables) si es
     <?php hueco(34, 10); ?> — y de hecho ese es el proposito del contrato.
     <code>totalDonated</code>, <code>totalWithdrawn</code>, la lista de donaciones:
     todo eso cambia cada vez que alguien interactua.</p>

  <div class="avisoflujo">
    <b>La clave:</b> el codigo es quien controla <?php hueco(35, 6); ?> puede
    cambiar el estado. No puede cambiar de cualquier forma, solo de las formas exactas que
    el codigo (fijo) permite. Por eso nadie puede inflar <code>totalDonated</code> sin mandar
    ETH de verdad.
  </div>

  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Donde se usan: DeFi</h2>

  <pre><code>Usuario deposita <?php hueco(36, 10); ?>
     ↓
Smart contract <?php hueco(37, 10); ?>
     ↓
Entrega <?php hueco(38, 10); ?> automaticamente</code></pre>

  <p>No necesitas un <?php hueco(39, 8); ?> . Ese es el ejemplo de finanzas
     descentralizadas de tus apuntes. Ademas las dApps se usan en NFTs, juegos blockchain,
     exchanges descentralizados (Uniswap), sistemas de votacion, cadenas de suministro y
     arte digital.</p>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Fundamentos/index.php', '../Arquitectura/index.php');
