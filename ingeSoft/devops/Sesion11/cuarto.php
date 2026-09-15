<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 11 — bloque 04: Desacople, rendimiento y sidecar
   Fuente: sesion_11_computacion_nube_patrones.pdf (bloques 04 y 05)
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- queue-based load leveling --- */
    1  => ['queue-based load leveling', 'load leveling', 'nivelacion de carga'],
    2  => ['picos'],
    3  => ['cola persistente', 'cola'],
    4  => ['sqs'],
    5  => ['kafka'],
    6  => ['workers', 'worker'],
    7  => ['constante', 'sostenible'],
    8  => ['202'],
    9  => ['accepted'],
    10 => ['segundo plano'],
    11 => ['caudal', 'caudal predecible'],

    /* --- cache-aside --- */
    12 => ['cache-aside', 'lazy loading', 'cache aside'],
    13 => ['redis'],
    14 => ['miss'],
    15 => ['hit'],
    16 => ['ttl', 'time-to-live'],
    17 => ['90'],
    18 => ['submilisegundos', 'submilisegundo'],
    19 => ['aplicacion'],
    20 => ['coherencia'],

    /* --- sidecar --- */
    21 => ['sidecar'],
    22 => ['pod'],
    23 => ['localhost', 'loopback'],
    24 => ['envoy'],
    25 => ['fluentbit', 'fluent bit'],
    26 => ['8080'],
    27 => ['15001'],
    28 => ['/var/log'],
    29 => ['mtls'],
    30 => ['poliglota'],
    31 => ['negocio'],

    /* --- strangler fig --- */
    32 => ['strangler fig', 'strangler', 'higo estrangulador'],
    33 => ['api gateway', 'gateway', 'fachada'],
    34 => ['monolito'],
    35 => ['rebanadas'],
    36 => ['apagarse'],
    37 => ['reescribir'],

    /* --- criterios de eleccion --- */
    38 => ['patron de carga', 'carga'],
    39 => ['serverless'],
    40 => ['websockets'],
    41 => ['tco', 'costo total'],
    42 => ['bloqueo de proveedor', 'vendor lock-in', 'bloqueo'],
    43 => ['pci-dss', 'pci'],
    44 => ['hipaa'],

    45 => ['Patrones de Desacople y Rendimiento', 'Patrones de desacople y rendimiento'],
    46 => ['Arquitecturas asincronas'],
    47 => ['aceleracion con cache y modularidad'],
 
    48 => ['lazy loading'],
    49 => ['Contenedor adosado'],

    50 => ['higo estrangulador'],

    ];

$TEXTO = range(1, 44);

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Que problema resuelve el <b>Queue-Based Load Leveling</b>?',
        'opciones' => [
            'a' => 'La lentitud de la red',
            'b' => 'Que los picos imprevistos de usuarios <b>saturen las APIs y bloqueen las bases de datos transaccionales</b>',
            'c' => 'Los fallos de un microservicio',
            'd' => 'El costo del almacenamiento'
        ],
        'correcta' => 'b',
        'porque'   => 'El nombre lo dice: <em>nivelar</em> la carga. Transforma picos incontrolables en un <b>caudal predecible</b>, que es justo lo que una base de datos necesita para no morir.'
    ],
    'm2' => [
        'texto'    => 'El cliente recibe un <b>202 Accepted</b>. &iquest;Que significa exactamente?',
        'opciones' => [
            'a' => 'Que la operacion ya termino con exito',
            'b' => '&laquo;Recibi tu peticion y la voy a procesar&raquo; — <b>no</b> &laquo;ya la procese&raquo;. El trabajo pesado corre despues, en segundo plano',
            'c' => 'Que hubo un error temporal',
            'd' => 'Que la peticion fue rechazada'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la diferencia con un 200 OK, y tiene consecuencia de diseño: el cliente necesita alguna forma de consultar <em>despues</em> si su trabajo termino. A cambio, se acabaron los timeouts.'
    ],
    'm3' => [
        'texto'    => 'En este patron, &iquest;quien controla el ritmo de escritura en la base de datos?',
        'opciones' => [
            'a' => 'Los clientes',
            'b' => 'El <b>pool de workers</b>, que hace <em>pull</em> de la cola a una tasa controlada (ej. 500 ops/seg) y nunca mas rapido',
            'c' => 'El balanceador de carga',
            'd' => 'La propia base de datos'
        ],
        'correcta' => 'b',
        'porque'   => 'El giro esta en el <b>pull</b>: los workers <em>toman</em> trabajo cuando pueden, en vez de que el trafico se lo <em>empuje</em>. La cola absorbe la diferencia y actua de buffer elastico.'
    ],
    'm4' => [
        'texto'    => 'En el patron <b>Cache-Aside</b>, &iquest;que pasa cuando el dato NO esta en la cache (miss)?',
        'opciones' => [
            'a' => 'La peticion falla',
            'b' => 'La app lee de la base de datos, devuelve el dato <b>y ademas lo escribe en la cache</b> con un TTL, para que la proxima vez sea un hit',
            'c' => 'La cache lo busca sola en la BD',
            'd' => 'Se espera a que un job nocturno lo cargue'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso se llama <b>lazy loading</b>: la cache se puebla sola, bajo demanda, con lo que la gente realmente pide. No hay que decidir de antemano que cachear.'
    ],
    'm5' => [
        'texto'    => 'La estrategia dice que la <b>aplicacion es la unica responsable</b> de mantener la coherencia entre cache y BD. &iquest;Que riesgo trae eso?',
        'opciones' => [
            'a' => 'Que la cache consuma mucha RAM',
            'b' => 'Que si alguien actualiza la BD sin invalidar la cache, sirvas <b>datos viejos</b> hasta que expire el TTL',
            'c' => 'Que la BD se sature',
            'd' => 'Ninguno, la cache se sincroniza sola'
        ],
        'correcta' => 'b',
        'porque'   => 'La cache no vigila la base de datos. El <b>TTL</b> es el techo de cuanto tiempo puedes estar equivocado — por eso se elige corto para datos que cambian y largo para catalogos estables.'
    ],
    'm6' => [
        'texto'    => '&iquest;Que define a un contenedor <b>sidecar</b>?',
        'opciones' => [
            'a' => 'Que corre en otro servidor',
            'b' => 'Que va <b>adosado</b> al contenedor de negocio dentro del <b>mismo Pod</b>: comparte ciclo de vida, red (localhost) y disco',
            'c' => 'Que reemplaza al contenedor principal',
            'd' => 'Que solo se ejecuta al arrancar'
        ],
        'correcta' => 'b',
        'porque'   => 'De ahi el nombre: el sidecar de una moto va pegado, comparte el viaje, pero es una pieza aparte. Al compartir <code>localhost</code>, hablarse entre ellos no cuesta red.'
    ],
    'm7' => [
        'texto'    => '&iquest;Cual es el beneficio real del Sidecar para un equipo de plataforma?',
        'opciones' => [
            'a' => 'Ahorrar memoria',
            'b' => 'Poder inyectar <b>mTLS y observabilidad sin tocar el codigo fuente</b> de los desarrolladores — y el mismo componente sirve para Java, Python o Go',
            'c' => 'Reducir el numero de pods',
            'd' => 'Acelerar el arranque de la aplicacion'
        ],
        'correcta' => 'b',
        'porque'   => 'Ese es el punto <b>poliglota</b>: sin sidecar tendrias que mantener una libreria de seguridad por cada lenguaje del ecosistema, y actualizarlas todas cada vez que sale una vulnerabilidad.'
    ],
    'm8' => [
        'texto'    => '&iquest;Que ventaja tiene gestionar <b>mTLS por sidecar Envoy</b> en vez de compilar librerias en cada app? (pregunta 4 de la discusion)',
        'opciones' => [
            'a' => 'Es mas rapido en tiempo de ejecucion',
            'b' => 'Desacopla la seguridad del codigo: permite <b>rotar certificados X.509 y parchar vulnerabilidades en Envoy sin recompilar</b> los microservicios',
            'c' => 'Consume menos CPU',
            'd' => 'Permite usar HTTP en vez de HTTPS'
        ],
        'correcta' => 'b',
        'porque'   => 'Piensa en el coste de la alternativa: una vulnerabilidad en la libreria TLS = recompilar, testear y redesplegar <em>todos</em> los servicios, en todos los lenguajes. Con sidecar, actualizas el sidecar.'
    ],
    'm9' => [
        'texto'    => '&iquest;En que consiste el patron <b>Strangler Fig</b>?',
        'opciones' => [
            'a' => 'Reescribir el monolito desde cero en microservicios',
            'b' => 'Poner una <b>fachada API Gateway</b> delante del monolito e ir <b>desviando rutas</b> a microservicios nuevos, rebanada a rebanada, hasta poder apagarlo',
            'c' => 'Congelar el monolito y no tocarlo',
            'd' => 'Migrar la base de datos primero'
        ],
        'correcta' => 'b',
        'porque'   => 'El nombre viene del higo estrangulador, que crece alrededor de un arbol hasta reemplazarlo. Lo importante es que <b>el monolito sigue vivo</b> todo el proceso: nunca hay un &laquo;big bang&raquo;.'
    ],
    'm10' => [
        'texto'    => '&iquest;Cual es la <b>mitigacion de riesgo</b> que aporta Strangler Fig?',
        'opciones' => [
            'a' => 'Que es mas barato',
            'b' => 'Evita el riesgo catastrofico de <b>reescribir un sistema gigante desde cero</b>, y entrega valor a produccion desde la primera semana',
            'c' => 'Que elimina los bugs del monolito',
            'd' => 'Que no requiere pruebas'
        ],
        'correcta' => 'b',
        'porque'   => 'La reescritura total es el clasico proyecto de dos años que nunca sale. Aqui cada rebanada migrada ya esta en produccion dando valor, y si una sale mal, revierte esa ruta y ya.'
    ],
    'm11' => [
        'texto'    => 'Modernizando un sistema academico monolitico, &iquest;por que funcionalidad empiezas? (pregunta 5 de la discusion)',
        'opciones' => [
            'a' => 'Por el nucleo de matricula, que es lo mas importante',
            'b' => 'Por servicios de <b>baja criticidad y lectura intensiva</b> (consulta de cursos, pensum), para validar el pipeline y el enrutador — <b>nunca</b> por el nucleo financiero o de matricula',
            'c' => 'Por el modulo de pagos',
            'd' => 'Por el que tenga mas codigo'
        ],
        'correcta' => 'b',
        'porque'   => 'Las primeras rebanadas no son para ganar valor: son para <b>aprender el mecanismo</b> con poco riesgo. Si tu primer microservicio es el de matricula y falla, quemaste el proyecto entero.'
    ],
    'm12' => [
        'texto'    => 'Tu trafico es predecible y constante. &iquest;Que sugieren los criterios de eleccion?',
        'opciones' => [
            'a' => 'Serverless, siempre',
            'b' => 'Contenedores o IaaS: el serverless se reserva para <b>picos esporadicos</b>',
            'c' => 'On-premise',
            'd' => 'SaaS'
        ],
        'correcta' => 'b',
        'porque'   => 'Mismo razonamiento que la pregunta de Lambda vs. K8s del bloque 2: pagar por invocacion sale caro cuando siempre hay invocaciones.'
    ],
    'm13' => [
        'texto'    => 'El <b>TCO</b> (costo total) que pide evaluar la sesion incluye...',
        'opciones' => [
            'a' => 'Solo la factura mensual del proveedor',
            'b' => 'La factura cloud <b>y ademas las horas de ingenieria</b> requeridas para operarlo',
            'c' => 'Solo el costo del hardware',
            'd' => 'Solo las licencias de software'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el error tipico al comparar opciones: Kubernetes puede salir mas barato en la factura y mucho mas caro en salarios. Un equipo sin capacidad de operar K8s deberia mirar PaaS.'
    ],
    'm14' => [
        'texto'    => '&iquest;Cuando conviene un <b>fallback en cache</b> del Circuit Breaker y cuando fallar rapido? (pregunta 3 de la discusion)',
        'opciones' => [
            'a' => 'Siempre fallback, es mejor experiencia',
            'b' => 'Fallback en <b>lecturas tolerantes a consistencia eventual</b> (catalogos, recomendaciones); <b>fail-fast</b> en operaciones financieras o mutaciones criticas',
            'c' => 'Siempre fail-fast',
            'd' => 'Depende del proveedor de nube'
        ],
        'correcta' => 'b',
        'porque'   => 'La pregunta que hay que hacerse es: &laquo;&iquest;que duele mas, un dato viejo o un error?&raquo;. En un catalogo, un precio de hace 5 minutos no mata a nadie. En un saldo bancario, si.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 11 · 4 — Desacople, rendimiento y sidecar', 'sesion_11_computacion_nube_patrones.pdf — bloques 04 y 05');
?>

<div class="card">
    <p><?php hueco(45, 35); ?></p>
    <p><?php hueco(46, 24); ?> , <?php hueco(47, 37); ?></p>
  <h2>1. Patron 4: <?php hueco(1, 26); ?></h2>
  <p>Un amortiguador <b>asincrono</b> para nivelar picos violentos de trafico.</p>

  <ul>
    <li><b>El problema:</b> <?php hueco(2, 8); ?> imprevistos de usuarios saturan
        las APIs y bloquean las bases de datos transaccionales.</li>
    <li><b>Buffer de cola:</b> las peticiones de escritura se depositan en una
        <?php hueco(3, 16); ?> (AWS <?php hueco(4, 6); ?>, RabbitMQ,
        <?php hueco(5, 8); ?>).</li>
    <li><b>Flujo controlado:</b> los <?php hueco(6, 10); ?> procesan a un ritmo
        <?php hueco(7, 12); ?> sin sobrecargar los recursos de la BD.</li>
  </ul>

  <style>
  .dg{overflow-x:auto;padding:4px 0 2px;margin:16px 0 6px}
  .dg .flow{display:flex;align-items:center;justify-content:center;flex-wrap:nowrap;min-width:660px}
  .dg .bx{border:2px solid;border-radius:12px;padding:10px 12px;text-align:center;
          min-width:152px;display:flex;flex-direction:column;gap:3px;justify-content:center}
  .dg .bx .t{font-weight:700;font-size:14.5px;color:#2f3a48;line-height:1.3}
  .dg .bx .s{font-size:12.5px;color:#3c4654;line-height:1.45}
  .dg .bx .cd{font-family:Consolas,Menlo,monospace;font-size:12px;color:#5a6472}
  .dg .bx .cd .hueco{width:74px;text-align:center;font-size:12px}
  .dg .bx .s .hueco{width:96px;text-align:center;font-size:12px}
  .dg .msg{display:flex;gap:4px;justify-content:center;margin:2px 0}
  .dg .msg span{font-family:Consolas,Menlo,monospace;font-size:11.5px;font-weight:700;
                background:#fff;border:1px solid #e8a25c;border-radius:4px;padding:1px 5px;color:#b3540c}
  .dg .ar{display:flex;flex-direction:column;align-items:center;justify-content:center;
          padding:0 3px;min-width:92px;flex:0 0 auto}
  .dg .ar .lb{font-size:11.5px;font-weight:700;white-space:nowrap;margin-bottom:3px}
  .dg .ar .lb .hueco{width:62px;text-align:center;font-size:11.5px}
  .dg .ar .ln{display:block;width:100%;height:3px;background:currentColor;border-radius:2px;position:relative}
  .dg .ar .ln:after{content:'';position:absolute;right:-1px;top:50%;transform:translateY(-50%);
      border-left:9px solid currentColor;border-top:6px solid transparent;border-bottom:6px solid transparent}
  .dg .ar .ln.izqln:after{left:-1px;right:auto;border-left:0;
      border-right:9px solid currentColor}
  .dg .ar .lb2{font-size:11.5px;font-weight:700;white-space:nowrap;margin-top:3px}
  .dg .ar .lb2 .hueco{width:62px;text-align:center;font-size:11.5px}
  .dg .arv{display:flex;align-items:center;justify-content:center;gap:12px;padding:4px 0}
  .dg .arv .cana{display:flex;flex-direction:column;align-items:center}
  .dg .arv .lv{display:block;width:3px;height:34px;background:currentColor;border-radius:2px}
  .dg .arv .pta{line-height:0;font-size:0}
  .dg .arv .pta i{display:block;width:0;height:0;border-left:6px solid transparent;
                  border-right:6px solid transparent}
  .dg .arv .abajo i{border-top:9px solid currentColor}
  .dg .arv .arriba i{border-bottom:9px solid currentColor}
  .dg .arv .tx{font-size:11.5px;font-weight:700;white-space:nowrap}
  .dg .arv .tx .hueco{width:62px;text-align:center;font-size:11.5px}
  .b-azul  {border-color:#8b93e8;background:#eef0fd}
  .b-naranja{border-color:#e8a25c;background:#fdf2e6}
  .b-verde {border-color:#5bbd85;background:#eaf7ef}
  .b-morado{border-color:#9a86e8;background:#f0ecfd}
  .db{border-radius:44px/24px}
  .c-azul{color:#3b5bdb}.c-naranja{color:#d2691e}.c-verde{color:#2f9e44}.c-morado{color:#6741d9}
  .pod{border:2px dashed #6741d9;border-radius:14px;background:#faf9ff;padding:12px 12px 10px;
       min-width:640px;margin:0 auto}
  .pod .ph{text-align:center;font-weight:700;font-size:14px;color:#4b3fb5}
  .pod .psub{text-align:center;font-size:12px;color:#7a6fc0;margin:2px 0 12px}
  .pod .pvol{margin-top:12px;text-align:center;font-size:12.5px;color:#3c4654;
             border-top:1px dashed #c4bff5;padding-top:9px}
  .pod .pvol .hueco{width:96px;text-align:center;font-size:12px}
  </style>

  <div class="dg">
    <div class="flow">

      <div class="bx b-azul">
        <div class="t">Clientes / Web</div>
        <div class="s">Picos impredecibles</div>
        <div class="cd">HTTP POST</div>
      </div>

      <div class="ar c-azul">
        <span class="lb">Picos</span>
        <span class="ln"></span>
      </div>

      <div class="bx b-naranja">
        <div class="t">Cola de Mensajes</div>
        <div class="s">AWS SQS / RabbitMQ / Kafka</div>
        <div class="msg"><span>Msg 3</span><span>Msg 2</span><span>Msg 1</span></div>
        <div class="s">Buffer elastico</div>
      </div>

      <div class="ar c-naranja">
        <span class="lb">Pull seguro</span>
        <span class="ln"></span>
      </div>

      <div class="bx b-verde">
        <div class="t">Pool de Workers</div>
        <div class="s">Tasa controlada</div>
        <div class="s">(ej: 500 ops/seg)</div>
        <div class="s">Autoescalado por cola</div>
      </div>

      <div class="ar c-verde">
        <span class="lb">Escritura</span>
        <span class="ln"></span>
      </div>

      <div class="bx b-morado db">
        <div class="t">Base de<br>Datos</div>
      </div>

    </div>
  </div>

  <div class="avisoflujo">
    <b>Disponibilidad.</b> El cliente recibe confirmacion inmediata
    (<?php hueco(8, 6); ?> <?php hueco(9, 12); ?>) y el trabajo pesado se
    ejecuta en <?php hueco(10, 16); ?> sin timeouts.
  </div>

  <p><b>Principio:</b> transforma picos incontrolables en un
     <?php hueco(11, 12); ?> predecible, protegiendo las bases de datos.</p>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Patron 5: <?php hueco(12, 18); ?> (<?php hueco(48, 12); ?>)</h2>

  <ul>
    <li><b>Carga bajo demanda:</b> la app consulta primero la memoria rapida
        (<?php hueco(13, 10); ?>); si el dato no existe, lee de la base de datos.</li>
    <li><b>Poblacion y TTL:</b> el dato leido se almacena en la cache con un tiempo
        de expiracion (<?php hueco(16, 8); ?>).</li>
    <li><b>Optimizacion:</b> reduce hasta un <?php hueco(17, 6); ?> % de la carga
        sobre bases de datos cloud como AWS RDS o Azure SQL.</li>
  </ul>

  <style>
/* =========================================
   ESTILOS DEL DIAGRAMA
   ========================================= */

/* Contenedor principal */
.diagrama-contenedor {
  position: relative;
  width: 100%;
  max-width: 650px;
  height: 350px;
  font-family: sans-serif;
  margin: 30px auto;
  isolation: isolate;
}

/* Estilos base de las cajas */
.bx {
  position: absolute;
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 15px;
  text-align: center;
  background: #fff;
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
  z-index: 2; /* Encima del SVG */
}

.bx .t { font-weight: bold; font-size: 14px; color: #333; margin-bottom: 5px; }
.bx .s { font-size: 12px; color: #666; }

/* Posiciones específicas de cada caja */
.app-box {
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 150px;
  border-color: #a5d8ff;
  background-color: #f0f7ff;
}

.cache-box {
  right: 0;
  top: 20px;
  width: 200px;
  border-color: #ffc078;
  background-color: #fff4e6;
}

/* Simular la forma de cilindro de BD */
.db-box {
  right: 20px;
  bottom: 20px;
  width: 160px;
  border-color: #b197fc;
  background-color: #f3f0ff;
  border-radius: 8px 8px 20px 20px;
}

.db-box::before {
  content: '';
  position: absolute;
  top: -5px;
  left: -1px;
  right: -1px;
  height: 10px;
  background: #fff;
  border: 1px solid #b197fc;
  border-radius: 50%;
  z-index: 3;
}

/* El SVG que cubre todo el contenedor (Flechas) */
.flechas-svg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1; /* Detrás de las cajas y textos */
  pointer-events: none;
}

/* Etiquetas de texto flotantes generales */
.label {
  position: absolute;
  font-size: 12px;
  font-weight: bold;
  background: #fff;
  padding: 2px 6px;
  border-radius: 4px;
  z-index: 3;
  white-space: nowrap;
}

/* Etiquetas especiales para Hit y Miss (con cajitas de input) */
.label-badge {
  position: absolute;
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  font-weight: bold;
  z-index: 4;
  white-space: nowrap;
  pointer-events: auto;
}

.label-badge .badge {
  position: relative;
  z-index: 5;
  background: #fff;
  border: 1px solid #ccc;
  padding: 2px 8px;
  border-radius: 4px;
  font-size: 12px;
  min-width: 40px;
  text-align: center;
  box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
  pointer-events: auto;
}

.label-badge .hbox {
  position: relative;
  z-index: 6;
  pointer-events: auto;
}

/* Estilo por si el PHP genera un <input> dentro de .badge */
.label-badge .badge input {
  border: none;
  outline: none;
  width: 100%;
  text-align: center;
  font-size: 12px;
  background: #fff;
  color: #1f2733;
  position: relative;
  z-index: 6;
  pointer-events: auto;
}

.label-badge .arrow-text {
  background: #fff;
  padding: 2px 4px;
  border-radius: 4px;
}

/* Posiciones exactas de los textos */
.label-1 { top: 55px; left: 250px; }
.label-2a { top: 135px; left: 240px; color: #2f9e44; }
.label-2b { bottom: 65px; left: 240px; color: #e8590c; }
.label-3 { top: 140px; right: 100px; }

/* Colores de texto */
.c-azul { color: #3b82f6; }
.c-verde { color: #2f9e44; }
.c-naranja { color: #e8590c; }
.c-morado { color: #7048e8; }
</style>

<!-- =========================================
     ESTRUCTURA HTML DEL EJERCICIO
     ========================================= -->
<div class="card">
  <h2>2. Patron 5: <?php hueco(12, 18); ?> (<?php hueco(48, 12); ?>)</h2>

  <ul>
    <li><b>Carga bajo demanda:</b> la app consulta primero la memoria rapida
        (<?php hueco(13, 10); ?>); si el dato no existe, lee de la base de datos.</li>
    <li><b>Poblacion y TTL:</b> el dato leido se almacena en la cache con un tiempo
        de expiracion (<?php hueco(16, 8); ?>).</li>
    <li><b>Optimizacion:</b> reduce hasta un <?php hueco(17, 6); ?> % de la carga
        sobre bases de datos cloud como AWS RDS o Azure SQL.</li>
  </ul>

  <!-- Diagrama -->
  <div class="diagrama-contenedor">
    
    <!-- SVG para dibujar las flechas -->
    <svg class="flechas-svg" viewBox="0 0 600 300" preserveAspectRatio="none">
      <defs>
        <marker id="arrow-blue" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto">
          <path d="M 0 0 L 10 5 L 0 10 z" fill="#3b82f6" />
        </marker>
        <marker id="arrow-green" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto">
          <path d="M 0 0 L 10 5 L 0 10 z" fill="#2f9e44" />
        </marker>
        <marker id="arrow-orange" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto">
          <path d="M 0 0 L 10 5 L 0 10 z" fill="#e8590c" />
        </marker>
        <marker id="arrow-purple" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="8" markerHeight="8" orient="auto">
          <path d="M 0 0 L 10 5 L 0 10 z" fill="#7048e8" />
        </marker>
      </defs>

      <!-- 1. Consultar clave (Azul) -->
      <path d="M 180 130 Q 300 60 400 80" fill="none" stroke="#3b82f6" stroke-width="2" marker-end="url(#arrow-blue)" />
      
      <!-- 2a. Hit (Verde) -->
      <path d="M 400 110 Q 300 140 180 150" fill="none" stroke="#2f9e44" stroke-width="2" marker-end="url(#arrow-green)" />
      
      <!-- 2b. Miss -> Lee BD (Naranja) -->
      <path d="M 180 170 Q 300 230 390 230" fill="none" stroke="#e8590c" stroke-width="2" marker-end="url(#arrow-orange)" />
      
      <!-- 3. Escribe caché (Morado punteado) -->
      <path d="M 460 200 L 460 120" fill="none" stroke="#7048e8" stroke-width="3" stroke-dasharray="6,6" stroke-linecap="round" marker-end="url(#arrow-purple)" />
    </svg>

    <!-- Cajas de texto principales -->
    <div class="bx b-azul app-box">
      <div class="t">Servicio / App</div>
      <div class="s">(Backend)</div>
    </div>

    <div class="bx b-naranja cache-box">
      <div class="t">Memoria Caché</div>
      <div class="s">(Redis / Memcached)</div>
    </div>

    <div class="bx b-morado db-box">
      <div class="t">Base de Datos</div>
      <div class="s">AWS RDS / Azure SQL</div>
    </div>

    <!-- Etiquetas flotantes con fondo blanco -->
    <div class="label label-1 c-azul">1. Consultar clave &rarr;</div>
    
    <!-- 2a. Hit -->
    <div class="label-badge label-2a c-verde">
      <span class="arrow-text">&larr;</span>
      <span class="badge"><?php hueco(15, 8); ?></span>
      <span class="arrow-text">(Retorna)</span>
    </div>
    
    <!-- 2b. Miss -->
    <div class="label-badge label-2b c-naranja">
      <span class="badge"><?php hueco(14, 8); ?></span>
      <span class="arrow-text">&rarr; Lee BD</span>
    </div>
    
    <div class="label label-3 c-morado">3. Escribe caché</div>

  </div>
</div>

  <div class="nota">
    <b>Estrategia.</b> La <?php hueco(19, 12); ?> es la <b>unica</b> responsable de
    mantener la <?php hueco(20, 12); ?> entre cache y persistencia.
    <br><br>
    <b>Latencia Ultrabaja</b>
     : las lecturas en memoria responden en <?php hueco(18, 18); ?>
    (menos de 2 ms).
  </div>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Patron 6: <?php hueco(21, 12); ?> Pattern</h2>
  <p>Extiende la funcionalidad de un contenedor <b>sin modificar su codigo</b>.</p>

  <ul>
    <li><b><?php hueco(49, 19); ?> :</b> comparte el ciclo de vida y la red
        (<?php hueco(23, 12); ?>) del contenedor de negocio dentro del mismo
        <?php hueco(22, 8); ?>.</li>
    <li><b>Separacion de responsabilidades:</b> la app ejecuta logica de
        <?php hueco(31, 10); ?>; el sidecar gestiona proxies
        (<?php hueco(24, 10); ?>), metricas o logs.</li>
    <li><b>Ecosistema <?php hueco(30, 12); ?>:</b> el mismo componente de
        observabilidad y seguridad sirve para servicios en Java, Python o Go.</li>
  </ul>

<!-- Bloque blindado para evitar conflictos de CSS en plataformas LMS/CMS -->
<div id="k8s-diagrama-unico" style="display: flex !important; flex-direction: row !important; align-items: center !important; justify-content: center !important; gap: 20px !important; font-family: Arial, sans-serif !important; padding: 20px !important; box-sizing: border-box !important; width: 100% !important; background-color: #ffffff !important;">

  <!-- Flecha Ingress (Izquierda) -->
  <div style="display: flex !important; flex-direction: column !important; align-items: center !important; color: #e67e22 !important; font-weight: bold !important; font-size: 14px !important; width: 90px !important; text-align: center !important;">
    <div>Ingress<br>HTTP 8080</div>
    <div style="font-size: 24px !important; margin-top: 5px !important; line-height: 1 !important;">➔</div>
  </div>

  <!-- Cuerpo del Pod (Borde morado discontinuo) -->
  <div style="display: flex !important; flex-direction: column !important; align-items: center !important; border: 2px dashed #8e44ad !important; border-radius: 20px !important; padding: 20px 25px 25px 25px !important; background-color: #fafafa !important; position: relative !important; min-width: 680px !important; box-shadow: 0 4px 10px rgba(0,0,0,0.05) !important; box-sizing: border-box !important;">

    <!-- Títulos del Pod -->
    <div style="color: #8e44ad !important; font-size: 18px !important; font-weight: bold !important; margin-bottom: 4px !important;">Pod de Kubernetes</div>
    <div style="color: #9b59b6 !important; font-size: 13px !important; margin-bottom: 25px !important;">Misma IP &nbsp;&bull;&nbsp; Red Loopback &nbsp;&bull;&nbsp; Disco Compartido</div>

    <!-- Fila de Contenedores -->
    <div style="display: flex !important; flex-direction: row !important; align-items: center !important; justify-content: center !important; gap: 15px !important; width: 100% !important;">

      <!-- Contenedor Principal (Azul) -->
      <div style="display: flex !important; flex-direction: column !important; border: 2px solid #3b82f6 !important; border-radius: 12px !important; padding: 15px !important; width: 210px !important; text-align: center !important; background: #ffffff !important; box-sizing: border-box !important;">
        <div style="font-weight: bold !important; font-size: 16px !important; color: #333 !important; margin-bottom: 4px !important;">Contenedor Principal</div>
        <div style="font-size: 13px !important; color: #555 !important; line-height: 1.3 !important;">Lógica de Negocio<br>Microservicio REST</div>
        <div style="font-weight: bold !important; font-size: 14px !important; color: #000 !important; margin-top: 10px !important;">Puerto: <?php hueco(26, 8); ?></div>
      </div>

      <!-- Flecha Localhost (Doble sentido) -->
      <div style="display: flex !important; flex-direction: column !important; align-items: center !important; width: 110px !important; color: #333 !important;">
        <div style="width: 100% !important; height: 2px !important; background: #333 !important; position: relative !important;">
          <div style="position: absolute !important; left: 0 !important; top: -4px !important; border-width: 5px !important; border-style: solid !important; border-color: transparent #333 transparent transparent !important;"></div>
        </div>
        <div style="font-size: 12px !important; font-weight: bold !important; margin: 6px 0 !important; text-align: center !important; line-height: 1.1 !important;">Localhost<br>(Loopback)</div>
        <div style="width: 100% !important; height: 2px !important; background: #333 !important; position: relative !important;">
          <div style="position: absolute !important; right: 0 !important; top: -4px !important; border-width: 5px !important; border-style: solid !important; border-color: transparent transparent transparent #333 !important;"></div>
        </div>
      </div>

      <!-- Contenedor Sidecar (Verde) -->
      <div style="display: flex !important; flex-direction: column !important; border: 2px solid #22c55e !important; border-radius: 12px !important; padding: 15px !important; width: 210px !important; text-align: center !important; background: #ffffff !important; box-sizing: border-box !important;">
        <div style="font-weight: bold !important; font-size: 16px !important; color: #333 !important; margin-bottom: 4px !important;">Contenedor Sidecar</div>
        <div style="font-size: 13px !important; color: #555 !important; line-height: 1.3 !important;">Proxy y Telemetría<br>Fluentbit o Envoy</div>
        <div style="font-weight: bold !important; font-size: 14px !important; color: #000 !important; margin-top: 10px !important;">Puerto: <?php hueco(27, 8); ?></div>
      </div>

    </div>

    <!-- Sección del Volumen Compartido -->
    <div style="display: flex !important; flex-direction: column !important; align-items: center !important; width: 100% !important; margin-top: 35px !important; position: relative !important;">
      
      <!-- Flechas hacia el volumen -->
      <div style="display: flex !important; justify-content: space-between !important; width: 100% !important; padding: 0 130px !important; box-sizing: border-box !important; position: absolute !important; top: -35px !important; z-index: 1 !important;">
        <!-- Flecha Escribe logs (Azul) -->
        <div style="display: flex !important; flex-direction: column !important; align-items: center !important; color: #3b82f6 !important; font-size: 12px !important; font-weight: bold !important;">
          <span>Escribe logs</span>
          <span style="font-size: 18px !important; line-height: 1 !important; margin-top: 2px !important;">↓</span>
        </div>
        <!-- Flecha Lee y transmite (Verde) -->
        <div style="display: flex !important; flex-direction: column !important; align-items: center !important; color: #22c55e !important; font-size: 12px !important; font-weight: bold !important;">
          <span>Lee y transmite</span>
          <span style="font-size: 18px !important; line-height: 1 !important; margin-top: 2px !important;">↑</span>
        </div>
      </div>

      <!-- Caja del Volumen -->
      <div style="border: 2px solid #64748b !important; border-radius: 12px !important; padding: 12px 20px !important; text-align: center !important; background: #ffffff !important; font-weight: bold !important; color: #333 !important; font-size: 14px !important; z-index: 2 !important; display: inline-block !important;">
        Volumen Compartido (Disco emptyDir): <?php hueco(28, 10); ?> <code style="font-family: monospace !important; font-size: 15px !important; background: #f1f5f9 !important; padding: 2px 6px !important; border-radius: 4px !important;"> </code>
      </div>

    </div>
  </div>

  <!-- Flecha Telemetría (Derecha) -->
  <div style="display: flex !important; flex-direction: column !important; align-items: center !important; color: #27ae60 !important; font-weight: bold !important; font-size: 14px !important; width: 90px !important; text-align: center !important;">
    <div style="font-size: 24px !important; margin-bottom: 5px !important; line-height: 1 !important;">➔</div>
    <div>Telemetría<br>Logs / Mesh</div>
  </div>

</div>

  <div class="nota"><b>Modularidad.</b> Permite a los equipos de plataforma inyectar
    <?php hueco(29, 8); ?> y observabilidad sin tocar el codigo fuente de los
    desarrolladores.</div>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Patron 7: <?php hueco(32, 20); ?> (<?php hueco(50, 20); ?>)</h2>
  <p>Modernizacion <b>progresiva</b> de monolitos hacia microservicios cloud.</p>

  <ul>
    <li><b>Fachada <?php hueco(33, 16); ?>:</b> se coloca un router al frente del
        <?php hueco(34, 12); ?> historico para interceptar todas las llamadas.</li>
    <li><b>Migracion por <?php hueco(35, 12); ?>:</b> las nuevas funciones se crean
        como microservicios independientes en la nube.</li>
    <li><b>Desvio gradual:</b> el gateway redirige las rutas migradas a la nube hasta que el
        monolito puede <?php hueco(36, 10); ?> con seguridad.</li>
  </ul>

  <div class="avisoflujo">
    <b>Mitigacion de riesgo.</b> Evita el riesgo catastrofico de
    <?php hueco(37, 12); ?> sistemas gigantes desde cero, entregando valor a
    produccion desde la primera semana.
  </div>

  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Criterios de eleccion de arquitectura cloud</h2>

  <table class="datos">
    <tr><th>Factores de decision</th><th>Costo y gobernanza</th></tr>
    <tr>
      <td><b><?php hueco(38, 16); ?>:</b> &iquest;trafico predecible
          (contenedores/IaaS) o picos esporadicos (<?php hueco(39, 12); ?>)?</td>
      <td><b>Costo total (<?php hueco(41, 8); ?>):</b> evaluar no solo la factura
          cloud, sino las <b>horas de ingenieria</b> requeridas</td>
    </tr>
    <tr>
      <td><b>Latencia y conexiones:</b> &iquest;requiere <?php hueco(40, 14); ?>
          persistentes o peticiones HTTP cortas?</td>
      <td><b><?php hueco(42, 20); ?>:</b> balancear servicios propietarios
          con estandares abiertos</td>
    </tr>
    <tr>
      <td><b>Equipo de operaciones:</b> &iquest;capacidad para operar K8s, o se requiere
          velocidad PaaS?</td>
      <td><b>Seguridad y cumplimiento:</b> requisitos legales
          (<?php hueco(43, 10); ?>, <?php hueco(44, 10); ?>)</td>
    </tr>
  </table>

  <div class="avisoflujo">
    <b>Mensaje final.</b> El rol del ingeniero DevOps moderno no es operar servidores
    fisicos, sino <b>diseñar arquitecturas resilientes, escalables y costo-eficientes</b>.
  </div>

  <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php mc('m14'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>


<div class="card">
  <h2>Las 5 preguntas de discusion de la sesion</h2>
  <p>El PDF trae la guia de respuestas. Las tres primeras y la cuarta ya estan como preguntas
     arriba; aqui las tienes juntas para repasar antes de clase.</p>
  <ol>
    <li><b>Facturacion FaaS vs. CaaS</b> con 50 millones de eventos/dia continuos.</li>
    <li><b>Idempotencia en retries</b>: por que un Retry sobre una pasarela de pagos sin clave
        de idempotencia causa cobros duplicados.</li>
    <li><b>Fallback en Circuit Breaker</b>: cuando devolver datos degradados de cache y cuando
        propagar el fallo.</li>
    <li><b>Seguridad via Sidecar</b>: que aporta gestionar mTLS con Envoy frente a compilar
        librerias en cada app.</li>
    <li><b>Estrategia Strangler Fig</b>: que funcionalidad extraerias primero de un sistema
        academico monolitico, y por que.</li>
  </ol>
</div>

<?php
pie('tercero.php', '');
