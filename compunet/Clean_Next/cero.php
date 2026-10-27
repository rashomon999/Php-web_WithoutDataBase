<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. como nacio el proyecto --- */
  1  => ['npx'],
  2  => ['create-next-app', 'create next app'],
  3  => ['TypeScript', 'typescript'],
  4  => ['Tailwind', 'tailwind', 'Tailwind CSS'],
  5  => ['src'],
  6  => ['App Router', 'app router', 'app'],
  7  => ['@/*', '@/'],

  /* --- B. package.json --- */
  10 => ['dependencies'],
  11 => ['devDependencies'],
  12 => ['next'],
  13 => ['react'],
  14 => ['react-dom'],
  15 => ['typescript'],
  16 => ['vitest'],
  17 => ['eslint'],
  18 => ['npm run dev', 'next dev', 'dev'],
  19 => ['npm run api', 'api'],
  20 => ['3000'],
  21 => ['3001'],

  /* --- C. modulos --- */
  25 => ['import'],
  26 => ['export'],
  27 => ['node_modules'],
  28 => ['package-lock.json', 'package-lock'],
  29 => ['.gitignore', 'gitignore'],
  30 => ['npm install', 'npm i', 'install'],
  31 => ['import type', 'type'],

  /* --- D. el arbol de src/ --- */
  32 => ['components'],
  33 => ['features'],
  34 => ['shared'],
  42 => ['app'],

  /* --- E. App Router --- */
  35 => ['page.tsx', 'page'],
  36 => ['layout.tsx', 'layout'],
  37 => ['/mis-alquileres', 'mis-alquileres'],
  38 => ['metadata'],
  39 => ['children'],
  40 => ['servidor', 'server'],

  /* --- E. use client y los hooks --- */
  45 => ["'use client'", 'use client'],
  46 => ['useState'],
  47 => ['useEffect'],
  48 => ['[]'],
  49 => ['una vez', '1', 'una'],
  50 => ['infinito', 'bucle infinito', 'ciclo infinito'],
  51 => ['localStorage'],
  52 => ['hooks', 'hook'],

  /* --- F. de memoria --- */
  60 => ["'use client';"],
  61 => ['const [items, setItems] = useState<any[]>([]);'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => '¿Que es exactamente <code>useEffect</code>?',
    'opciones' => [
      'a' => 'Una funcion de Next.js que carga datos en el servidor antes de pintar la pagina.',
      'b' => 'Un hook de React que ejecuta codigo <b>despues</b> de que el componente se pinto, para lo que no es pintar: pedir datos, suscribirse a algo, tocar el navegador.',
      'c' => 'Un reemplazo de <code>try/catch</code> para errores de red.',
      'd' => 'Una forma de declarar variables que no provocan repintado.',
    ],
    'correcta' => 'b',
    'porque' => 'El cuerpo del componente solo debe calcular lo que se va a pintar. Todo lo que "sale al mundo" (red, <code>localStorage</code>, temporizadores) se llama <b>efecto</b> y va dentro de <code>useEffect</code>.',
  ],

  'm2' => [
    'texto' => 'El <code>useEffect</code> de <code>MyRentals</code> termina con <code>}, []);</code>. ¿Que hace ese array vacio?',
    'opciones' => [
      'a' => 'Es el valor inicial de la lista de alquileres.',
      'b' => 'Es el array de dependencias: con <code>[]</code>, el efecto corre <b>una sola vez</b>, tras el primer pintado. Si llevara variables dentro, volveria a correr cada vez que alguna cambiara.',
      'c' => 'Indica que el efecto no devuelve nada.',
      'd' => 'Es obligatorio y siempre va vacio.',
    ],
    'correcta' => 'b',
    'porque' => 'Es el parametro que mas confunde. Sin el array, el efecto corre tras <b>cada</b> render; con <code>[]</code>, solo tras el primero; con <code>[id]</code>, cada vez que cambie <code>id</code>.',
  ],

  'm3' => [
    'texto' => '¿Que pasaria si el <code>fetch</code> se escribiera directamente en el cuerpo del componente, sin <code>useEffect</code>?',
    'opciones' => [
      'a' => 'Nada, seria mas corto.',
      'b' => 'Se dispararia en cada render; como la respuesta llama a <code>setItems</code> y eso provoca otro render, se arma un <b>bucle infinito</b> de peticiones.',
      'c' => 'React lanzaria un error de compilacion.',
      'd' => 'Funcionaria solo la primera vez.',
    ],
    'correcta' => 'b',
    'porque' => 'Esa es toda la razon de ser de <code>useEffect</code>: separar "calcular lo que se ve" de "ir a buscar cosas afuera", y controlar cuando ocurre lo segundo.',
  ],

  'm4' => [
    'texto' => '¿Que hace la primera linea, <code>\'use client\'</code>?',
    'opciones' => [
      'a' => 'Marca el archivo como componente de cliente. En el App Router los componentes son del <b>servidor</b> por defecto, y ahi no existen ni los hooks, ni <code>onClick</code>, ni <code>localStorage</code>.',
      'b' => 'Obliga a que la pagina se renderice solo en produccion.',
      'c' => 'Activa el modo estricto de React.',
      'd' => 'Indica que el componente hace peticiones HTTP.',
    ],
    'correcta' => 'a',
    'porque' => 'Si lo borras de <code>MyRentals.tsx</code>, el error es inmediato: no se pueden usar <code>useState</code> ni <code>useEffect</code> en un componente de servidor. Fijate en que <code>app/page.tsx</code> y <code>layout.tsx</code> <b>no</b> lo llevan: no lo necesitan.',
  ],

  'm5' => [
    'texto' => '¿Que es <code>useState</code> y por que no basta con una variable normal?',
    'opciones' => [
      'a' => 'Es igual que una variable, pero con nombre mas largo.',
      'b' => 'Guarda un valor que <b>sobrevive entre renders</b> y, al cambiarlo con su funcion, le avisa a React que vuelva a pintar. Una variable normal se perderia en cada render y no repintaria nada.',
      'c' => 'Guarda datos en el navegador de forma permanente.',
      'd' => 'Es la forma de declarar propiedades que llegan del componente padre.',
    ],
    'correcta' => 'b',
    'porque' => 'Por eso van en pareja: <code>items</code> para leer y <code>setItems</code> para cambiar. Modificar <code>items</code> a mano no repinta nada; la pantalla se quedaria igual.',
  ],

  'm6' => [
    'texto' => 'En el App Router, ¿que define la ruta <code>/mis-alquileres</code>?',
    'opciones' => [
      'a' => 'Un archivo de rutas donde se registran todas las URL.',
      'b' => 'La propia carpeta: <code>src/app/mis-alquileres/</code> con un archivo <code>page.tsx</code> dentro. La estructura de carpetas <b>es</b> el mapa de rutas.',
      'c' => 'El <code>Link</code> que apunta a ella en el layout.',
      'd' => 'Una entrada en <code>next.config.ts</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Por eso no hay ningun archivo de rutas en el proyecto. Y ojo: solo <code>page.tsx</code> crea una ruta; <code>components/MyRentals.tsx</code> no es ninguna URL, es un archivo que la pagina importa.',
  ],

  'm7' => [
    'texto' => '¿Por que <code>next</code>, <code>react</code> y <code>react-dom</code> estan en <code>dependencies</code>, pero <code>typescript</code> y <code>vitest</code> en <code>devDependencies</code>?',
    'opciones' => [
      'a' => 'Por orden alfabetico.',
      'b' => 'Porque las primeras hacen falta para que la app <b>funcione</b>; las segundas solo para <b>desarrollarla</b> (compilar tipos, correr tests, revisar estilo). En produccion esas ultimas no se instalan.',
      'c' => 'Porque las de desarrollo son mas pesadas.',
      'd' => 'Porque <code>devDependencies</code> se instala antes.',
    ],
    'correcta' => 'b',
    'porque' => 'TypeScript desaparece al compilar: el navegador recibe JavaScript. Y nadie corre los tests en el servidor de produccion. Son herramientas del taller, no piezas del producto.',
  ],

  'm8' => [
    'texto' => 'La carpeta <code>node_modules</code> esta en <code>.gitignore</code>. ¿Como recupera un compañero esas librerias?',
    'opciones' => [
      'a' => 'Pidiendole un zip a quien ya las tiene.',
      'b' => 'Con <code>npm install</code>: lee <code>package.json</code> y <code>package-lock.json</code> y las descarga. Por eso el lock file <b>si</b> se sube: fija las versiones exactas.',
      'c' => 'No se puede, hay que subirla al repo.',
      'd' => 'Next.js las descarga sola al arrancar.',
    ],
    'correcta' => 'b',
    'porque' => 'Son miles de archivos reconstruibles. La idea es que el repo guarde <b>la receta</b> (que necesito y en que version), no el resultado.',
  ],

  'm9' => [
    'texto' => 'El proyecto necesita <b>dos</b> terminales: <code>npm run dev</code> y <code>npm run api</code>. ¿Por que?',
    'opciones' => [
      'a' => 'Para repartir la carga entre dos procesos.',
      'b' => 'Son dos programas distintos: el frontend de Next en el 3000 y la API simulada en el 3001. Si falta el segundo, la pagina carga pero no aparece ningun alquiler.',
      'c' => 'Una terminal compila y la otra sirve los archivos.',
      'd' => 'La segunda solo corre los tests.',
    ],
    'correcta' => 'b',
    'porque' => 'La API vive en <code>mock-api/server.mjs</code>, no tiene dependencias y guarda los datos <b>en memoria</b>: al reiniciarla, todo vuelve al estado inicial. Es el sintoma mas comun al empezar: "no me carga nada" por tener solo una terminal.',
  ],

  'm10' => [
    'texto' => 'En el dominio veras <code>import type { Money } from ...</code>. ¿Que aporta la palabra <code>type</code>?',
    'opciones' => [
      'a' => 'Nada, es decorativa.',
      'b' => 'Dice que solo se importa el <b>tipo</b>, no codigo que exista al ejecutar: desaparece al compilar y no crea una dependencia real entre archivos.',
      'c' => 'Importa todos los tipos del archivo de golpe.',
      'd' => 'Convierte la clase en interfaz.',
    ],
    'correcta' => 'b',
    'porque' => 'Importante en arquitectura limpia: <code>Rental</code> importa <code>DateRange</code> y <code>Money</code> con <code>import type</code>, asi que la entidad no arrastra codigo al compilado. Es una dependencia que solo existe para el compilador.',
  ],

  'm11' => [
    'texto' => 'El archivo <code>AGENTS.md</code> avisa de que esta version de Next tiene cambios incompatibles con lo conocido. ¿Que implica para ti?',
    'opciones' => [
      'a' => 'Que hay que bajar a una version anterior.',
      'b' => 'Que tutoriales, respuestas de foros y ejemplos viejos pueden no servir: conviene mirar la documentacion de la version instalada antes de copiar codigo de internet.',
      'c' => 'Que el proyecto esta roto.',
      'd' => 'Que solo funciona con agentes de IA.',
    ],
    'correcta' => 'b',
    'porque' => 'Este proyecto usa Next 16 y React 19, bastante nuevos. Ese archivo lo genera <code>next dev</code> solo; no lo escribio el profesor.',
  ],

  'm12' => [
    'texto' => '<code>src/</code> tiene <code>components/</code> Y <code>features/</code> al mismo tiempo. ¿Que relacion hay entre esas dos carpetas?',
    'opciones' => [
      'a' => 'Ninguna: son dos proyectos distintos que quedaron mezclados por error.',
      'b' => '<code>components/</code> es el codigo legado que ya funciona; <code>features/</code> es la version organizada en capas a la que se va migrando poco a poco, sin apagar la app mientras tanto.',
      'c' => '<code>components/</code> es para componentes pequeños y <code>features/</code> para paginas completas.',
      'd' => '<code>features/</code> reemplaza a <code>app/</code> como sistema de rutas.',
    ],
    'correcta' => 'b',
    'porque' => 'Es la misma idea del taller de la clase 1: no se reescribe todo de un golpe. <code>MyRentals.tsx</code> en <code>components/</code> sigue siendo lo que <code>app/mis-alquileres/page.tsx</code> importa HOY, mientras <code>features/rentals/</code> se va llenando de dominio y casos de uso probados, listos para el dia en que se conecte a la pantalla.',
  ],
];

$RETOS = [
  'r1' => [
    'titulo' => 'la cabecera de MyRentals.tsx: directiva, imports y estado',
    'huecos' => [45, 46, 47],
    'codigo' => "'use client';
import { useEffect, useState } from 'react';

export default function MyRentals() {
  const [items, setItems] = useState<any[]>([]);
  const [error, setError] = useState('');",
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 0 — Como se creo el proyecto y que hay dentro', 'create-next-app, package.json, modulos, App Router, use client, useState y useEffect');
?>

<div class="card">
  <h2>Antes de hablar de capas</h2>
  <p>Este cuestionario es la base: de donde salio el proyecto, que trae instalado y que significan
     las palabras que aparecen en <code>MyRentals.tsx</code> antes de llegar a la logica de negocio.
     Si esto no esta claro, los cuestionarios siguientes se leen como burocracia.</p>
  <div class="nota">
    Todo lo de aqui sale de la rama <code>clase3-next</code>: <code>package.json</code>,
    <code>tsconfig.json</code>, <code>next.config.ts</code>, <code>src/app/</code> y el propio
    <code>MyRentals.tsx</code>.
  </div>
</div>

<div class="card">
  <h2>A. Como nacio</h2>
  <p>Un proyecto de Next no se arma a mano: se genera con un asistente que hace unas preguntas
     y deja el esqueleto listo.</p>

<pre><code>$ <?php hueco(1, 5); ?> <?php hueco(2, 18); ?>@latest</code></pre>

  <p>Mirando los archivos se puede deducir que se respondio:</p>
  <ul>
    <li><b><?php hueco(3, 12); ?></b>: si &mdash; hay <code>tsconfig.json</code> y todo es <code>.ts</code>/<code>.tsx</code>.</li>
    <li><b><?php hueco(4, 12); ?></b>: no &mdash; no aparece en <code>package.json</code>; los estilos son un <code>globals.css</code> escrito a mano.</li>
    <li>Carpeta <b><?php hueco(5, 5); ?>/</b>: si &mdash; el codigo no esta en la raiz.</li>
    <li><b><?php hueco(6, 12); ?></b>: si &mdash; hay <code>src/app/</code> con <code>layout.tsx</code> y <code>page.tsx</code>, no <code>pages/</code>.</li>
    <li>Alias de importacion <b><?php hueco(7, 6); ?></b>: por eso se escribe <code>@/shared/domain/...</code> en vez de contar <code>../../..</code>.</li>
  </ul>

  <div class="avisoflujo">
    El asistente genera el esqueleto <b>tecnico</b>. Las carpetas <code>features/</code> y
    <code>shared/</code> no las crea nadie automaticamente: son la decision de arquitectura
    del curso, y van dentro de <code>src/</code>.
  </div>

  <?php mc('m11'); ?>
</div>

<div class="card">
  <h2>B. package.json: la ficha tecnica</h2>

<pre><code>"scripts": {
  "dev":   "next dev",                  // frontend, puerto <?php hueco(20, 6); ?>
  "api":   "node mock-api/server.mjs",  // API simulada, puerto <?php hueco(21, 6); ?>
  "build": "next build",
  "test":  "vitest run"
},
"<?php hueco(10, 14); ?>": {        // lo que la app necesita para funcionar
  "<?php hueco(12, 6); ?>": "16.4.2",
  "<?php hueco(13, 7); ?>": "19.3.0",
  "<?php hueco(14, 11); ?>": "19.3.0"
},
"<?php hueco(11, 17); ?>": {     // lo que solo hace falta para desarrollar
  "<?php hueco(15, 12); ?>": "^5",
  "<?php hueco(16, 8); ?>": "^5.0.5",
  "<?php hueco(17, 8); ?>": "^9"
}</code></pre>

  <p>Para trabajar hacen falta <b>dos terminales</b>: en una
     <?php hueco(18, 14); ?> y en la otra <?php hueco(19, 14); ?>.</p>

  <?php mc('m7'); mc('m9'); ?>
</div>

<div class="card">
  <h2>C. Que es un "modulo"</h2>
  <p>Un modulo es simplemente <b>un archivo</b> que comparte cosas con otros. Se sacan con
     <?php hueco(26, 8); ?> y se traen con <?php hueco(25, 8); ?>.
     No tiene nada que ver con los <code>@Module</code> de NestJS, que son otra cosa.</p>

<pre><code>// money.ts  &mdash; este archivo OFRECE la clase
export class Money { ... }

// pricing.ts &mdash; este archivo la PIDE
import { Money } from '@/shared/domain/value-objects/money';
<?php hueco(31, 12); ?> { DateRange } from '@/shared/domain/value-objects/date-range';  // solo el tipo</code></pre>

  <p>Las librerias de terceros se descargan a la carpeta <?php hueco(27, 14); ?>,
     que no se sube al repo porque esta en <?php hueco(29, 12); ?>. Para recuperarla
     se ejecuta <?php hueco(30, 14); ?>, que lee <code>package.json</code> y
     <?php hueco(28, 20); ?>, donde estan fijadas las versiones exactas.</p>

  <?php mc('m8'); mc('m10'); ?>
</div>

<div class="card">
  <h2>D. El arbol completo de src/</h2>
  <p>Antes de entrar en <code>app/</code>, la foto completa. Esto es lo que se ve hoy al abrir
     el explorador de archivos del proyecto:</p>

<pre><code>src/
├── <?php hueco(42, 4); ?>/          &rarr; las rutas: un archivo page.tsx por URL (siguiente bloque)
├── <?php hueco(32, 11); ?>/   &rarr; el codigo LEGADO: MyRentals.tsx, VehicleList.tsx (cuestionario 1)
├── <?php hueco(33, 9); ?>/      &rarr; el codigo NUEVO, organizado en capas (cuestionario 2 en adelante)
│   ├── rentals/
│   └── vehicles/
└── <?php hueco(34, 7); ?>/        &rarr; value objects que varias features usan: Money, DateRange</code></pre>

  <div class="nota">
    <b>Dos codigos conviven a proposito.</b> <code>components/</code> es el punto de partida que
    funciona pero esta mal organizado; <code>features/</code> es a donde se va mudando, capa por
    capa, sin romper la app mientras tanto. <code>app/</code> no tiene logica de negocio: solo
    importa componentes de una de las otras dos carpetas, segun que tan avanzada vaya cada pantalla.
  </div>

  <?php mc('m12'); ?>
</div>

<div class="card">
  <h2>E. Dentro de app/: las carpetas son las rutas</h2>

<pre><code>src/app/
├── <?php hueco(36, 12); ?>          &rarr; el marco comun: &lt;html&gt;, &lt;body&gt;, la barra de navegacion
├── <?php hueco(35, 10); ?>            &rarr; la ruta /
├── login/page.tsx          &rarr; la ruta /login
├── vehiculos/page.tsx      &rarr; la ruta /vehiculos
└── mis-alquileres/page.tsx &rarr; la ruta <?php hueco(37, 18); ?></code></pre>

  <p>El layout exporta un objeto <?php hueco(38, 10); ?> con el titulo y la descripcion
     de la pagina, y recibe la pagina activa en la propiedad <?php hueco(39, 10); ?>.</p>

  <p>Detalle clave: en el App Router los componentes son de <?php hueco(40, 10); ?>
     por defecto. Por eso <code>layout.tsx</code> y <code>app/page.tsx</code> no llevan ninguna
     directiva especial: no usan estado ni eventos.</p>

  <?php mc('m6'); ?>
</div>

<div class="card">
  <h2>F. Las tres palabras de MyRentals.tsx</h2>

<pre><code><?php hueco(45, 14); ?>;
import { useEffect, useState } from 'react';

export default function MyRentals() {
  const [items, setItems] = <?php hueco(46, 10); ?>&lt;any[]&gt;([]);

  <?php hueco(47, 11); ?>(() =&gt; {
    fetch('http://localhost:3001/rentals/me', { ... })
      .then((r) =&gt; r.json())
      .then((data) =&gt; setItems(data));
  }, <?php hueco(48, 4); ?>);          // &lt;-- array de dependencias</code></pre>

  <ul>
    <li><b>La directiva</b>: marca el archivo como componente de cliente. Sin ella no se pueden
        usar <?php hueco(52, 8); ?>, ni <code>onClick</code>, ni
        <?php hueco(51, 14); ?>, porque en el servidor nada de eso existe.</li>
    <li><b><code>useState</code></b>: guarda un valor entre renders y repinta al cambiarlo.
        Va en pareja: uno para leer, otro para cambiar.</li>
    <li><b><code>useEffect</code></b>: ejecuta codigo <b>despues</b> de pintar, para lo que no es
        pintar. Con el array vacio corre <?php hueco(49, 10); ?> sola vez.</li>
  </ul>

  <div class="avisoflujo">
    <b>Por que el fetch no puede ir suelto en el cuerpo:</b> el cuerpo corre en cada render, y
    <code>setItems</code> provoca otro render, asi que se arma un bucle
    <?php hueco(50, 12); ?> de peticiones al servidor.
  </div>

  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); ?>

  <?php reto('r1'); ?>
</div>

<div class="card">
  <h2>G. De memoria: la linea completa</h2>

  <?php linea(60, 'La primera linea de cualquier componente que use hooks o eventos.'); ?>
  <?php linea(61, 'La linea que declara el estado de la lista de alquileres, tal como esta hoy.'); ?>
</div>

<?php pie('Menu.php', 'index.php'); ?>
