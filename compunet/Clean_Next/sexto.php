<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. el circulo: las 10 piezas del dibujo --- */
  1  => ['Devices', 'devices'],
  2  => ['Web', 'web'],
  3  => ['Controllers', 'controllers', 'controller'],
  4  => ['Presenters', 'presenters', 'presenter'],
  5  => ['Use Cases', 'use cases', 'casos de uso'],
  6  => ['Entities', 'entities', 'entidades'],
  7  => ['Gateways', 'gateways', 'gateway'],
  8  => ['DB'],
  9  => ['External Interfaces', 'external interfaces'],
  10 => ['UI'],

  /* --- B. la leyenda de colores --- */
  15 => ['Enterprise Business Rules', 'enterprise business rules'],
  16 => ['Application Business Rules', 'application business rules'],
  17 => ['Interface Adapters', 'interface adapters'],
  18 => ['Frameworks & Drivers', 'frameworks and drivers', 'frameworks y drivers'],

  /* --- C. el diagrama de puertos --- */
  25 => ['Controller', 'controller'],
  26 => ['Use Case Input Port', 'input port'],
  27 => ['Interactor', 'interactor'],
  28 => ['Use Case Output Port', 'output port'],
  29 => ['Presenter', 'presenter'],
  30 => ['Flow of control', 'flow of control'],

  /* --- D. tu proyecto contra el libro --- */
  35 => ['domain'],
  36 => ['application'],
  37 => ['presentation'],
  38 => ['infraestucture', 'infrastructure', 'infraestructura'],
  39 => ['fetch'],

  /* --- E. de memoria --- */
  45 => ['Entities -> Use Cases -> Interface Adapters -> Frameworks & Drivers',
         'Entities -> Use Cases -> Interface Adapters -> Frameworks and Drivers',
         'entities -> use cases -> interface adapters -> frameworks & drivers'],
  46 => ['domain -> application -> presentation e infraestucture -> next.js, react y fetch',
         'domain -> application -> presentation e infraestructura -> next.js, react y fetch'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => 'En el dibujo, las tres flechas de la izquierda que entran al circulo representan:',
    'opciones' => [
      'a' => 'Los tres framework que soporta el proyecto.',
      'b' => 'Una peticion entrando desde afuera (un clic, un fetch) y atravesando los anillos hasta llegar a las reglas del negocio en el centro.',
      'c' => 'Las tres capas que SI pueden romper la regla de dependencia.',
      'd' => 'Los tres tipos de usuario de la aplicacion.',
    ],
    'correcta' => 'b',
    'porque' => 'Por eso solo hay flechas de entrada, nunca de salida: algo externo dispara la accion (un clic en "Cancelar") y esa peticion viaja hacia adentro, nunca al reves.',
  ],

  'm2' => [
    'texto' => '"Gateways" y "DB" aparecen en anillos DIFERENTES: Gateways en el verde, DB en el azul. ¿Por que no estan juntos?',
    'opciones' => [
      'a' => 'Es un error del diagrama original.',
      'b' => 'Gateways es el ADAPTADOR que tu escribes (por ejemplo HttpRentalRepository); DB es la base de datos real, una herramienta externa que ese adaptador usa pero no es codigo tuyo.',
      'c' => 'DB es mas importante, por eso va en el anillo exterior.',
      'd' => 'Gateways solo se usa para tests.',
    ],
    'correcta' => 'b',
    'porque' => 'Es la misma logica que separa infraestucture/ (tu codigo, el adaptador) de la base de datos de verdad (una herramienta que ni siquiera escribiste).',
  ],

  'm3' => [
    'texto' => 'La leyenda llama "Application Business Rules" a lo que nosotros llamamos simplemente "Use Cases" / application/. ¿Por que ese nombre mas largo?',
    'opciones' => [
      'a' => 'Son reglas que le importan a ESTA aplicacion en particular (como "listar mis alquileres ya con precio calculado"), a diferencia de las reglas de "Enterprise" que servirian para cualquier sistema de la empresa, incluso uno que no fuera esta app.',
      'b' => 'Es un sinonimo sin ninguna diferencia real.',
      'c' => 'Porque ahi se guardan las reglas de validacion de formularios.',
      'd' => 'Porque esas reglas cambian mas seguido que el codigo de presentation/.',
    ],
    'correcta' => 'a',
    'porque' => '"Enterprise Business Rules" (Entities) serian las mismas aunque la empresa vendiera por telefono en vez de por web. "Application Business Rules" (Use Cases) son especificas de que ESTA app, en concreto, coordina esas reglas de cierta forma.',
  ],

  'm4' => [
    'texto' => 'Si tuvieras que dibujar <code>MyRentals.tsx</code> (el componente LEGADO, sin refactorizar) en este circulo, ¿en que anillo caeria HOY?',
    'opciones' => [
      'a' => 'Entities, porque calcula precios.',
      'b' => 'En ninguno limpiamente: mezcla codigo de los 4 anillos en un solo archivo (fetch del azul, calculo de precios del amarillo, el JSX del verde...), que es justo el problema que el curso corrige.',
      'c' => 'Use Cases, porque coordina la llamada a la API.',
      'd' => 'Frameworks & Drivers, porque usa React.',
    ],
    'correcta' => 'b',
    'porque' => 'Ese es el diagnostico del cuestionario 1: un archivo que no respeta ningun anillo es un archivo dificil de cambiar sin romper otra cosa. El circulo sirve, sobre todo, para notar cuando algo esta mal ubicado.',
  ],

  'm5' => [
    'texto' => 'En la tabla "el libro vs tu proyecto", Interface Adapters mapea a DOS carpetas (presentation/ e infraestucture/) en vez de una sola. ¿Por que?',
    'opciones' => [
      'a' => 'Por error de quien diseño las carpetas.',
      'b' => 'Porque ese anillo del libro agrupa tres roles distintos (Controllers, Presenters, Gateways) y tu proyecto los reparte en dos carpetas: presentation/ para Controllers y Presenters (hablan con el usuario), infraestucture/ para Gateways (habla con el servidor).',
      'c' => 'Porque infraestucture/ en realidad es parte de Frameworks & Drivers.',
      'd' => 'Porque presentation/ no existe todavia en el proyecto.',
    ],
    'correcta' => 'b',
    'porque' => 'El libro usa 4 anillos; tu proyecto usa 4 carpetas; pero no es una correspondencia 1 a 1. Dos carpetas tuyas cubren un mismo anillo porque cumplen roles distintos dentro de el.',
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, []);
cabecera('Cuestionario 6 — El circulo completo', 'El diagrama de Clean Architecture, pieza por pieza, y como mapea contra RodaYa');
?>
<style>
.diagrama-scroll{overflow-x:auto;padding:4px 0 10px}
.diagrama-fila{display:flex;gap:28px;align-items:flex-start;flex-wrap:wrap;justify-content:center}
.diagrama-wrap{position:relative;width:560px;height:560px;flex:0 0 auto;margin:0 auto}
.anillo{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);border-radius:50%}
.anillo.azul{width:560px;height:560px;background:#c7e2f3;border:2px solid #8fbfdd}
.anillo.verde{width:424px;height:424px;background:#c7e9cd;border:2px solid #8fcf9d}
.anillo.rosa{width:288px;height:288px;background:#f3c8bf;border:2px solid #e0998a}
.anillo.amarillo{width:150px;height:150px;background:#faf0a8;border:2px solid #e3c94a}
.anillo-txt{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
            font-weight:700;font-size:13px;color:#2f3a48;text-align:center;pointer-events:none}
.etiqueta{position:absolute;transform:translate(-50%,-50%);text-align:center;z-index:5}
.etiqueta .hueco{width:auto}
.flechas-entrada{position:absolute;left:0;top:46%;display:flex;flex-direction:column;gap:14px;
                  font-size:20px;font-weight:700;color:#2c5aa0;z-index:6}
.leyenda{flex:0 0 240px;display:flex;flex-direction:column;gap:12px;padding-top:30px}
.leyenda .fila{display:flex;align-items:center;gap:10px}
.leyenda .swatch{width:18px;height:18px;border-radius:4px;flex:0 0 18px;border:2px solid rgba(0,0,0,.15)}
.leyenda .swatch.sw-amarillo{background:#faf0a8}
.leyenda .swatch.sw-rosa{background:#f3c8bf}
.leyenda .swatch.sw-verde{background:#c7e9cd}
.leyenda .swatch.sw-azul{background:#c7e2f3}

.pg-scroll{overflow-x:auto;padding:4px 0 10px}
.pg-wrap{position:relative;width:390px;margin:14px auto}
.pg-grid{display:grid;
  grid-template-columns:150px 50px 190px;
  grid-template-rows:64px 40px 64px 40px 64px;
  grid-template-areas:
    "presenter  harrow1 output"
    ".          .       varrow1"
    ".          .       interactor"
    ".          .       varrow2"
    "controller harrow2 input";
  position:relative;z-index:2}
.pg-box{border:2px solid #1a7f37;background:#e6f4ea;border-radius:8px;
        display:flex;align-items:center;justify-content:center;text-align:center;
        font-size:14px;font-weight:600;padding:6px 10px}
.pg-box.interactor{border-color:#c0392b;background:#fdecea}
.pg-box.puerto{border:2px dashed #2c5aa0;background:#fff;color:#2c5aa0;font-size:13px;font-weight:600}
.pg-presenter{grid-area:presenter}
.pg-output{grid-area:output}
.pg-interactor{grid-area:interactor}
.pg-controller{grid-area:controller}
.pg-input{grid-area:input}
.pg-harrow{display:flex;align-items:center;justify-content:center;font-size:20px;color:#5a636e}
.pg-harrow.h1{grid-area:harrow1}
.pg-harrow.h2{grid-area:harrow2}
.pg-varrow{display:flex;align-items:center;justify-content:center;font-size:18px;color:#5a636e}
.pg-varrow.v1{grid-area:varrow1}
.pg-varrow.v2{grid-area:varrow2}
.pg-flujo-svg{position:absolute;inset:0;width:100%;height:100%;z-index:1;pointer-events:none}
.pg-flujo-label{position:absolute;left:4px;top:148px;width:140px;font-size:13px;
                color:#c060c0;font-style:italic;text-align:left;z-index:3}

@media(max-width:700px){
  .diagrama-wrap{width:340px;height:340px;transform-origin:top left}
  .anillo.azul{width:340px;height:340px}
  .anillo.verde{width:258px;height:258px}
  .anillo.rosa{width:175px;height:175px}
  .anillo.amarillo{width:92px;height:92px}
  .anillo-txt{font-size:10px}
  .etiqueta{font-size:11px}
  .leyenda{padding-top:0}
}
</style>

<div class="card">
  <h2>Antes de resolver</h2>
  <p>Este es el mismo dibujo que viste al principio, pero con las 14 palabras del circulo y la
     leyenda convertidas en huecos. No hay truco: todo lo que necesitas para llenarlo ya lo viste
     en el cuestionario 2 y en las tarjetas de repaso. Si te atascas en una, pasa a la siguiente y
     vuelve al final.</p>
</div>

<div class="card">
  <h2>A. El circulo completo</h2>

  <div class="diagrama-scroll">
    <div class="diagrama-fila">

      <div class="diagrama-wrap">
        <div class="anillo azul"></div>
        <div class="anillo verde"></div>
        <div class="anillo rosa"></div>
        <div class="anillo amarillo"></div>

        <div class="flechas-entrada" style="left:-6px"><span>&rarr;</span><span>&rarr;</span><span>&rarr;</span></div>

        <div class="etiqueta" style="top:16%;left:15%"><?php hueco(1, 10); ?></div>
        <div class="etiqueta" style="top:16%;left:85%"><?php hueco(2, 8); ?></div>

        <div class="etiqueta" style="top:30%;left:24%"><?php hueco(3, 13); ?></div>
        <div class="etiqueta" style="top:30%;left:76%"><?php hueco(4, 13); ?></div>

        <div class="etiqueta" style="top:33%;left:50%"><?php hueco(5, 11); ?></div>

        <div class="etiqueta" style="top:50%;left:50%"><?php hueco(6, 10); ?></div>

        <div class="etiqueta" style="top:68%;left:22%"><?php hueco(7, 11); ?></div>
        <div class="etiqueta" style="top:85%;left:13%"><?php hueco(8, 5); ?></div>

        <div class="etiqueta" style="top:92%;left:50%"><?php hueco(9, 19); ?></div>
        <div class="etiqueta" style="top:80%;left:85%"><?php hueco(10, 5); ?></div>
      </div>

      <div class="leyenda">
        <div class="fila"><span class="swatch sw-amarillo"></span> <?php hueco(15, 27); ?></div>
        <div class="fila"><span class="swatch sw-rosa"></span> <?php hueco(16, 27); ?></div>
        <div class="fila"><span class="swatch sw-verde"></span> <?php hueco(17, 22); ?></div>
        <div class="fila"><span class="swatch sw-azul"></span> <?php hueco(18, 22); ?></div>
      </div>

    </div>
  </div>

  <div class="nota">
    Pista de lectura: las palabras que escribiste DENTRO de los anillos (Controllers, Use Cases,
    Entities, Gateways, Presenters) son <b>roles concretos</b>. Las de la leyenda, a la derecha,
    son los <b>nombres de los 4 anillos</b> en si. No son lo mismo, aunque esten relacionados.
  </div>

  <?php mc('m1'); mc('m2'); mc('m3'); ?>
</div>

<div class="card">
  <h2>B. El diagrama de puertos (la esquina inferior derecha del original)</h2>

  <div class="pg-scroll">
  <div class="pg-wrap">
    <svg class="pg-flujo-svg" viewBox="0 0 390 272" preserveAspectRatio="none" aria-hidden="true">
      <defs>
        <marker id="pgArrowHead" markerWidth="8" markerHeight="8" refX="4" refY="4" orient="auto">
          <path d="M0,0 L8,4 L0,8 Z" fill="#c060c0" />
        </marker>
      </defs>
      <path d="M 190,136 C 70,165 72,87 110,64" fill="none" stroke="#c060c0"
            stroke-width="2.5" stroke-linecap="round"
            marker-end="url(#pgArrowHead)" />
      <path d="M 145,220 C 190,214 165,150 202,140" fill="none" stroke="#c060c0"
            stroke-width="2.5" stroke-linecap="round"
            marker-end="url(#pgArrowHead)" />
    </svg>

    <div class="pg-grid">
      <div class="pg-box pg-presenter"><?php hueco(29, 9); ?></div>
      <div class="pg-harrow h1">&rarr;</div>
      <div class="pg-box puerto pg-output">[<?php hueco(28, 16); ?>]</div>

      <div class="pg-varrow v1">&#8597;</div>

      <div class="pg-box interactor pg-interactor">Use Case <?php hueco(27, 10); ?></div>

      <div class="pg-varrow v2">&#8597;</div>

      <div class="pg-box pg-controller"><?php hueco(25, 10); ?></div>
      <div class="pg-harrow h2">&rarr;</div>
      <div class="pg-box puerto pg-input">[<?php hueco(26, 15); ?>]</div>
    </div>

    <div class="pg-flujo-label">&#8617; <b><?php hueco(30, 15); ?></b></div>
  </div>
  </div>

  <p class="nota">Aunque el Interactor esta mas "adentro" que el Presenter, en tiempo de
     ejecucion el control sigue llegando hasta el (la curva punteada). Lo que NO pasa es
     que el Interactor importe codigo del Presenter.</p>

  <?php mc('m4'); ?>
</div>

<div class="card">
  <h2>C. Como mapea tu proyecto contra el libro</h2>

  <table style="width:100%;border-collapse:collapse">
    <tr>
      <th style="text-align:left;padding:8px 10px;border-bottom:2px solid #d8dbe0">El libro</th>
      <th style="text-align:left;padding:8px 10px;border-bottom:2px solid #d8dbe0">Tu proyecto</th>
    </tr>
    <tr>
      <td style="padding:10px;border-bottom:1px solid #eceff3">Entities</td>
      <td style="padding:10px;border-bottom:1px solid #eceff3"><?php hueco(35, 8); ?>/</td>
    </tr>
    <tr>
      <td style="padding:10px;border-bottom:1px solid #eceff3">Use Cases</td>
      <td style="padding:10px;border-bottom:1px solid #eceff3"><?php hueco(36, 13); ?>/</td>
    </tr>
    <tr>
      <td style="padding:10px;border-bottom:1px solid #eceff3">Interface Adapters</td>
      <td style="padding:10px;border-bottom:1px solid #eceff3">
        <?php hueco(37, 12); ?>/ (controllers/presenters) + <?php hueco(38, 15); ?>/ (gateways)
      </td>
    </tr>
    <tr>
      <td style="padding:10px">Frameworks &amp; Drivers</td>
      <td style="padding:10px">Next.js, React, <?php hueco(39, 6); ?>, el navegador — no es una
        carpeta tuya, es lo que usas</td>
    </tr>
  </table>

  <?php mc('m5'); ?>
</div>

<div class="card">
  <h2>D. De memoria</h2>

  <?php linea(45, 'Los 4 anillos, de adentro hacia afuera, separados por una flecha.'); ?>
  <?php linea(46, 'Las carpetas de tu proyecto que cubren esos 4 anillos, en el mismo orden.'); ?>
</div>

<?php pie('quinto.php', 'Menu.php'); ?>
