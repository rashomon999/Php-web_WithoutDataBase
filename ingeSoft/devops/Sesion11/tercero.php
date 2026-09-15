<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 11 — bloque 03: Patrones de resiliencia
   Fuente: sesion_11_computacion_nube_patrones.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- la ley fundamental ---
       Estos tres huecos ya no aparecen en la pagina (se quito esa seccion), asi que
       contaban como respuestas en blanco que nunca se podian llenar. Se dejan
       comentados; si vuelves a poner la seccion, descomentalos.
    1  => ['99.99'],
    2  => ['werner vogels', 'vogels'],
    3  => ['amazon'],
    */

    /* --- circuit breaker --- */
    4  => ['circuit breaker', 'disyuntor'],
    5  => ['cascada'],
    6  => ['hilos'],
    7  => ['fail-fast', 'falla rapida', 'fail fast'],
    8  => ['umbral'],
    9  => ['abre'],
    10 => ['enfriamiento'],
    11 => ['piloto'],

    /* --- maquina de estados --- */
    12 => ['cerrado', 'closed'],
    13 => ['abierto', 'open'],
    14 => ['semi-abierto', 'half-open', 'semiabierto'],
    15 => ['fallback'],
    16 => ['timeout'],
    17 => ['50'],

    /* --- retry --- */
    18 => ['retry con Exponential Backoff & Jitter','retry con Exponential Backoff y Jitter'],
    19 => ['Fallas transitorias'],
    20 => ['503'],
    21 => ['429'],
    22 => ['exponential backoff', 'backoff'],
    23 => ['duplica'],
    24 => ['200ms', '200'],
    25 => ['400ms', '400'],
    26 => ['jitter'],
    27 => ['desincronizar'],
    28 => ['retry storm'],
    29 => ['idempotentes', 'idempotente'],
    30 => ['get'],

    /* --- bulkhead --- */
    31 => ['bulkhead', 'mamparos', 'mamparo'],
    32 => ['barco'],
    33 => ['pools de hilos', 'pool'],
    34 => ['contencion de daño'],
    35 => ['checkout'],
    36 => ['degradacion gracil', 'degradacion'],
    37 => ['vitales'],
    38 => ['pods', 'pod'],

    39 => ['Patrones de resiliencia'],
    40 => ['Diseñando para la falla inevitable en sistemas distribuidos'],

    41 => ['mamparos de aislamiento'],
    42 => ['Aislamiento de recursos'],

     
];

$TEXTO = range(1, 38);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La frase de Werner Vogels dice que los fallos son un hecho dado. &iquest;Que implica para el diseño?',
        'opciones' => [
            'a' => 'Que hay que comprar hardware mas caro',
            'b' => 'Que no debes diseñar para que <em>nada falle</em>, sino <b>arquitecturas que prosperen cuando los componentes de abajo colapsan</b>',
            'c' => 'Que hay que evitar los sistemas distribuidos',
            'd' => 'Que la disponibilidad absoluta se logra con redundancia'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el giro mental de todo el bloque 3: <b>no existe la disponibilidad absoluta</b> en sistemas distribuidos. Los cuatro patrones que siguen no evitan los fallos — evitan que un fallo se lleve por delante todo lo demas.'
    ],
    'm2' => [
        'texto'    => '&iquest;Cual es el problema que resuelve el <b>Circuit Breaker</b>?',
        'opciones' => [
            'a' => 'Que un servicio se caiga',
            'b' => 'Que llamar a un servicio <b>degradado</b> agote los hilos de ejecucion del cliente, propagando el fallo <b>en cascada</b> a quien si estaba sano',
            'c' => 'Que la red sea lenta',
            'd' => 'Que la base de datos se sature'
        ],
        'correcta' => 'b',
        'porque'   => 'Fijate en la victima: el patron protege al <b>cliente</b>, no al servicio caido. Si A llama a B y B tarda 30 s, los hilos de A se quedan esperando y A tambien se cae — aunque A no tuviera ningun problema.'
    ],
    'm3' => [
        'texto'    => 'En estado <b>ABIERTO</b>, &iquest;que hace el circuito con las peticiones?',
        'opciones' => [
            'a' => 'Las encola hasta que el servicio vuelva',
            'b' => 'Las <b>rechaza de inmediato</b> sin intentar la llamada (fail-fast), y retorna un fallback',
            'c' => 'Las reintenta cada segundo',
            'd' => 'Las redirige a otro servicio'
        ],
        'correcta' => 'b',
        'porque'   => 'Contraintuitivo pero clave: fallar rapido es <b>mejor</b> que esperar. Liberas los recursos del cliente de inmediato y le das aire al servicio afectado para que se recupere sin mas carga encima.'
    ],
    'm4' => [
        'texto'    => 'Ordena las transiciones de la maquina de estados del Circuit Breaker:',
        'opciones' => [
            'a' => 'Cerrado &rarr;(fallos &gt; umbral)&rarr; Abierto &rarr;(timeout expira)&rarr; Semi-abierto &rarr;(exito sostenido)&rarr; Cerrado',
            'b' => 'Abierto &rarr; Cerrado &rarr; Semi-abierto',
            'c' => 'Cerrado &rarr; Semi-abierto &rarr; Abierto &rarr; Cerrado',
            'd' => 'Semi-abierto &rarr; Abierto &rarr; Cerrado'
        ],
        'correcta' => 'a',
        'porque'   => 'Y si en Semi-abierto la <b>prueba piloto falla</b>, vuelve a Abierto. El estado semi-abierto existe justamente para no reabrir la compuerta de golpe a todo el trafico.'
    ],
    'm5' => [
        'texto'    => 'Cuidado con el nombre: en un Circuit Breaker, &laquo;<b>cerrado</b>&raquo; significa...',
        'opciones' => [
            'a' => 'Que el servicio esta bloqueado',
            'b' => 'Que el <b>trafico pasa normal</b> — como un circuito electrico cerrado por el que fluye la corriente',
            'c' => 'Que el sistema esta apagado',
            'd' => 'Que hay mantenimiento'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la confusion mas comun del tema, porque en el lenguaje cotidiano &laquo;cerrado&raquo; suena a bloqueado. Piensa en el interruptor de la luz: <b>circuito cerrado = corriente pasa</b>; abierto = corriente cortada.'
    ],
    'm6' => [
        'texto'    => '&iquest;Que es una <b>falla transitoria</b>?',
        'opciones' => [
            'a' => 'Un bug del codigo',
            'b' => 'Un error efimero de red (HTTP 503, 429) que <b>se resuelve solo</b> en segundos',
            'c' => 'Una caida total del datacenter',
            'd' => 'Un error de validacion del usuario'
        ],
        'correcta' => 'b',
        'porque'   => 'La distincion importa: reintentar tiene sentido ante algo <b>pasajero</b>. Reintentar un HTTP 400 (peticion mal formada) es absurdo — va a fallar las mil veces.'
    ],
    'm7' => [
        'texto'    => '&iquest;Por que el <b>exponential backoff</b> duplica la espera en vez de reintentar cada 100 ms?',
        'opciones' => [
            'a' => 'Para ahorrar bateria',
            'b' => 'Porque si el servicio esta saturado, martillearlo cada 100 ms lo <b>hunde mas</b>. Espaciar los intentos le da tiempo real de recuperarse',
            'c' => 'Porque el estandar HTTP lo exige',
            'd' => 'Para reducir el numero total de reintentos'
        ],
        'correcta' => 'b',
        'porque'   => 'Reintentar agresivamente convierte una degradacion en una caida. La progresion es 100ms &rarr; 200ms &rarr; 400ms &rarr; ...'
    ],
    'm8' => [
        'texto'    => '&iquest;Que problema resuelve el <b>jitter</b> que el backoff por si solo no resuelve?',
        'opciones' => [
            'a' => 'Los errores de DNS',
            'b' => 'Que <b>mil clientes que fallaron a la vez reintenten a la vez</b>: sin aleatorizacion, sus esperas quedan sincronizadas y llegan en oleadas — un <b>retry storm</b>',
            'c' => 'La latencia de red',
            'd' => 'Los cold starts'
        ],
        'correcta' => 'b',
        'porque'   => 'El backoff arregla <em>un</em> cliente; el jitter arregla <em>la multitud</em>. Añadir variacion estocastica desparrama los reintentos en el tiempo en vez de concentrarlos.'
    ],
    'm9' => [
        'texto'    => 'La <b>regla critica</b> del patron Retry: solo debe aplicarse sobre operaciones...',
        'opciones' => [
            'a' => 'rapidas',
            'b' => '<b>idempotentes</b> — lecturas GET o peticiones con clave de idempotencia',
            'c' => 'de escritura',
            'd' => 'autenticadas'
        ],
        'correcta' => 'b',
        'porque'   => 'Idempotente = ejecutarla dos veces da el mismo resultado que ejecutarla una. Un GET lo es; un &laquo;cobrar 50 dolares&raquo; no.'
    ],
    'm10' => [
        'texto'    => 'Reintentas sobre una pasarela de pagos <b>sin</b> clave de idempotencia. &iquest;Que puede pasar? (pregunta 2 de la discusion)',
        'opciones' => [
            'a' => 'Nada, el pago se ignora',
            'b' => 'Si la red falla <b>despues</b> de procesar el cobro pero <b>antes</b> de recibir la confirmacion, el cliente reintenta y la pasarela ejecuta un <b>nuevo cobro</b>: se debita dos veces',
            'c' => 'La pasarela detecta el duplicado sola',
            'd' => 'Se cancela la transaccion original'
        ],
        'correcta' => 'b',
        'porque'   => 'El punto fino: el error no estuvo en el cobro, estuvo en <b>enterarse</b> del cobro. Desde fuera, &laquo;fallo&raquo; y &laquo;funciono pero no me llego la respuesta&raquo; se ven idénticos. La clave de idempotencia es lo que deja a la pasarela reconocer &laquo;esta peticion ya la procese&raquo;.'
    ],
    'm11' => [
        'texto'    => '&iquest;De donde viene la metafora del <b>Bulkhead</b>?',
        'opciones' => [
            'a' => 'De los cortafuegos de un edificio',
            'b' => 'De los <b>mamparos hermeticos de un barco</b>: si se inunda un compartimento, los demas siguen secos y el barco no se hunde',
            'c' => 'De los diques de un rio',
            'd' => 'De las particiones de un disco'
        ],
        'correcta' => 'b',
        'porque'   => 'La imagen explica el patron entera: no evitas la via de agua, evitas que el agua llegue a todo el casco.'
    ],
    'm12' => [
        'texto'    => 'El servicio de <b>reportes</b> colapsa por una consulta masiva y el <b>checkout</b> sigue funcionando. &iquest;Que patron esta actuando?',
        'opciones' => [
            'a' => 'Circuit Breaker',
            'b' => 'Retry',
            'c' => 'Bulkhead: pools de hilos, memoria y conexiones de BD <b>independientes</b> por modulo',
            'd' => 'Cache-Aside'
        ],
        'correcta' => 'c',
        'porque'   => 'A eso se le llama <b>degradacion gracil</b>: garantizar que el fallo de una funcion secundaria nunca tire abajo los componentes vitales del negocio. En cloud se implementa desplegando en clusteres o pods aislados.'
    ],
    'm13' => [
        'texto'    => 'Circuit Breaker y Bulkhead suenan parecido. &iquest;En que se diferencian?',
        'opciones' => [
            'a' => 'Son el mismo patron con dos nombres',
            'b' => 'El <b>Circuit Breaker</b> corta la llamada <em>hacia</em> un servicio que esta fallando; el <b>Bulkhead</b> reparte los recursos para que un modulo no pueda consumirselos todos',
            'c' => 'El Bulkhead solo aplica a bases de datos',
            'd' => 'El Circuit Breaker es para redes y el Bulkhead para discos'
        ],
        'correcta' => 'b',
        'porque'   => 'Uno es <em>cuando dejo de llamar</em>; el otro es <em>cuanto te presto</em>. Se usan juntos: el bulkhead te da un pool de hilos por dependencia, y el breaker decide cuando dejar de gastarlos.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 11 · 3 — Patrones de resiliencia', 'sesion_11_computacion_nube_patrones.pdf — bloque 03');
?>

<div class="card">
  <h2>1. La ley fundamental de la nube</h2>
    <h2>99.99%</h2>
<p>No existe la disponibilidad absoluta en sistemas distribuidos</p>
<p>“Failures are a given and everything will eventually fail over time.
You must architect systems that thrive when underlying
components collapse.” — Werner Vogels, CTO de Amazon</p>
  <p>Diseñar para la falla no es pesimismo: es la unica postura realista cuando tu sistema
     depende de decenas de componentes que no controlas.</p>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
    <?php hueco(39, 26); ?>
    <?php hueco(40, 60); ?>
  <h2>2. Patron 1: <?php hueco(4, 20); ?></h2>
  <p>Previene la propagacion de fallos en <?php hueco(5, 12); ?> entre microservicios.</p>

  <ul>
    <li><b>El problema:</b> llamar a un servicio degradado agota los
        <?php hueco(6, 10); ?> de ejecucion de la aplicacion cliente.</li>
    <li><b>Falla rapida (<?php hueco(7, 14); ?>):</b> si la tasa de errores supera un
        <?php hueco(8, 10); ?>, el circuito se <?php hueco(9, 10); ?>
        y rechaza peticiones de inmediato.</li>
    <li><b>Auto-recuperacion:</b> tras un tiempo de <?php hueco(10, 14); ?>,
        permite pruebas <?php hueco(11, 10); ?> para comprobar si el servicio sano.</li>
  </ul>

  <div class="nota"><b>Beneficio clave.</b> Protege al <b>cliente</b> liberando recursos de
    inmediato, y da tiempo al servicio afectado para recuperarse sin mas sobrecargas.</div>

  <h3>La maquina de estados</h3>
  <style>
  .cbwrap{overflow-x:auto;padding:6px 0 2px}
  .cb{--v:#1a7f37;--n:#d2691e;--m:#6b4fd8;
      position:relative;min-width:470px;max-width:760px;margin:14px auto 6px;
      display:grid;grid-template-columns:1fr 1fr 1fr;grid-template-rows:auto 104px auto}

  .cb .est{border:2px solid;border-radius:12px;padding:11px 10px;text-align:center;
           display:flex;flex-direction:column;gap:3px;justify-content:center}
  .cb .est .nom{font-size:15px;font-weight:700;letter-spacing:.4px}
  .cb .est .nom .hueco{width:128px;text-align:center;font-size:14px;font-weight:700}
  .cb .est .en{font-size:12px;color:#7a8494;font-style:italic;margin-bottom:2px}
  .cb .est .d{font-size:12.5px;color:#3c4654;line-height:1.45}
  .cb .est .d .hueco{width:96px;text-align:center;font-size:12.5px}
  .e-cerrado{grid-area:1/1/2/2;border-color:#5bbd85;background:#eaf7ef}
  .e-abierto{grid-area:1/3/2/4;border-color:#e8a25c;background:#fdf2e6}
  .e-semi   {grid-area:3/2/4/3;border-color:#9a86e8;background:#f0ecfd}

  /* CERRADO -> ABIERTO */
  .cb .c-top{grid-area:1/2/2/3;position:relative;align-self:center;margin:0 2px}
  .cb .c-top .ln{display:block;height:3px;background:var(--n);border-radius:2px}
  .cb .c-top .pt{position:absolute;right:-2px;top:50%;transform:translateY(-50%);
                 color:var(--n);font-size:17px;line-height:0}
  .cb .rot{position:absolute;left:50%;transform:translateX(-50%);bottom:10px;
           white-space:nowrap;font-size:12.5px;font-weight:700;color:var(--n)}
  .cb .rot .hueco{width:52px;text-align:center;font-size:12px}

  /* SEMI -> CERRADO (exito sostenido) */
  .cb .c-izq{grid-area:2/1/3/3;position:relative;margin:0 30% 0 20%;
             border-left:3px solid var(--v);border-bottom:3px solid var(--v);
             border-radius:0 0 0 16px}
  .cb .c-izq .pt{position:absolute;left:-9px;top:-9px;color:var(--v);font-size:17px;line-height:1}
  .cb .c-izq .lb{position:absolute;left:12px;top:16px;font-size:12.5px;font-weight:700;
                 color:var(--v);white-space:nowrap}

  /* ABIERTO -> SEMI (timeout expira) */
  .cb .c-der{grid-area:2/2/3/4;position:relative;margin:0 30% 0 38%;
             border-right:3px solid var(--m);border-bottom:3px solid var(--m);
             border-radius:0 0 16px 0}
  .cb .c-der .pt{position:absolute;left:-8px;bottom:-10px;color:var(--m);font-size:16px;line-height:1}
  .cb .c-der .lb{position:absolute;right:8px;top:9px;font-size:12.5px;font-weight:700;
                 color:var(--m);white-space:nowrap;text-align:right}
  .cb .c-der .lb .hueco{width:80px;text-align:center;font-size:12px}

  /* SEMI -> ABIERTO (la prueba falla) */
  .cb .c-der2{grid-area:2/2/3/4;position:relative;margin:8px 12% 18px 51%;
              border-right:2px dashed var(--n);border-bottom:2px dashed var(--n);
              border-radius:0 0 14px 0}
  .cb .c-der2 .pt{position:absolute;right:-8px;top:-12px;color:var(--n);font-size:15px;line-height:1}
  .cb .c-der2 .lb{position:absolute;left:4px;bottom:9px;
                  font-size:12px;font-weight:700;color:var(--n);white-space:nowrap}

  @media(max-width:760px){ .cb{margin-left:0;margin-right:0} }
  </style>

  <div class="cbwrap">
  <div class="cb">

    <div class="est e-cerrado">
      <div class="nom"><?php hueco(12, 14); ?></div>
      <div class="en">(Closed)</div>
      <div class="d">Trafico normal activo<br>Cuenta fallos consecutivos</div>
    </div>

    <div class="c-top">
      <span class="rot">Fallos &gt; Umbral (ej: <?php hueco(17, 6); ?> %)</span>
      <span class="ln"></span>
      <span class="pt">&#9654;</span>
    </div>

    <div class="est e-abierto">
      <div class="nom"><?php hueco(13, 14); ?></div>
      <div class="en">(Open)</div>
      <div class="d">Falla inmediata (Fail-Fast)<br>Retorna <?php hueco(15, 12); ?></div>
    </div>

    <div class="c-izq">
      <span class="pt">&#9650;</span>
      <span class="lb">Exito sostenido</span>
    </div>

    <div class="c-der">
      <span class="lb"><?php hueco(16, 10); ?> expira</span>
      <span class="pt">&#9664;</span>
    </div>

    <div class="c-der2">
      <span class="pt">&#9650;</span>
      <span class="lb">Prueba falla</span>
    </div>

    <div class="est e-semi">
      <div class="nom"><?php hueco(14, 16); ?></div>
      <div class="en">(Half-Open)</div>
      <div class="d">Permite llamadas piloto<br>Evalua recuperacion</div>
    </div>

  </div>
  </div>

  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Patron 2: <?php hueco(18, 39); ?>  </h2>
  <p>Manejo inteligente de fallas <b>transitorias</b> de red.</p>

  <ul>
    <li><b>  <?php hueco(19, 19); ?>:</b> errores efimeros de red
        (HTTP <?php hueco(20, 6); ?> / <?php hueco(21, 6); ?>) que se
        resuelven en segundos de forma natural.</li>
    <li><b><?php hueco(22, 20); ?>:</b> el tiempo de espera se
        <?php hueco(23, 10); ?> tras cada fallo consecutivo:
        100ms &rarr; <?php hueco(24, 8); ?> &rarr; <?php hueco(25, 8); ?>.</li>
    <li><b><?php hueco(26, 10); ?> (aleatorizacion):</b> añade variacion estocastica
        para <?php hueco(27, 16); ?> oleadas simultaneas de clientes
        (<?php hueco(28, 14); ?>).</li>
  </ul>

  <div class="avisoflujo">
    <b>Regla critica.</b> El patron Retry SOLO debe aplicarse sobre operaciones
    <?php hueco(29, 16); ?> — como lecturas <?php hueco(30, 6); ?>
    o peticiones con clave idempotente.
  </div>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Patron 3: <?php hueco(31, 16); ?> (<?php hueco(41, 23); ?>)</h2>
  <p>Inspirado en los mamparos hermeticos que impiden el hundimiento de un
     <?php hueco(32, 10); ?>.</p>

  <ul>
    <li><b><?php hueco(42, 24); ?> :</b> <?php hueco(33, 15); ?>  , memoria y
        conexiones de base de datos <b>independientes</b> para cada modulo.</li>
    <li><b><?php hueco(34, 19); ?>  :</b> si el servicio de reportes colapsa
        por una consulta masiva, el <?php hueco(35, 12); ?> sigue operando sin
        interrupcion.</li>
    <li><b>Aislamiento cloud:</b> despliegue de microservicios en clusteres independientes
        o <?php hueco(38, 8); ?> aislados.</li>
  </ul>

  <div class="nota">
    <b><?php hueco(36, 20); ?>.</b> Garantiza que el fallo en una funcion
    secundaria nunca tire abajo los componentes <?php hueco(37, 10); ?> del negocio.
  </div>

  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('segundo.php', 'cuarto.php');
