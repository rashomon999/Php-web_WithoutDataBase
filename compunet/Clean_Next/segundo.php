<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. las carpetas --- */
  1  => ['domain', 'dominio'],
  2  => ['application', 'aplicacion', 'aplicación'],
  3  => ['infraestucture', 'infrastructure', 'infraestructura'],
  4  => ['presentation', 'presentacion', 'presentación'],
  5  => ['di'],
  6  => ['testing'],
  7  => ['features'],
  8  => ['shared'],
  9  => ['rentals'],
  10 => ['vehicles'],
  11 => ['app'],
  12 => ['components'],

  /* --- B. la regla de dependencias --- */
  15 => ['adentro', 'dentro', 'hacia adentro', 'interior'],
  16 => ['dominio', 'domain'],
  17 => ['nadie', 'ninguna', 'nada'],

  /* --- C. donde va cada cosa --- */
  20 => ['domain', 'dominio'],
  21 => ['domain', 'dominio'],
  22 => ['domain', 'dominio'],
  23 => ['application', 'aplicacion', 'aplicación'],
  24 => ['application', 'aplicacion', 'aplicación'],
  25 => ['infraestucture', 'infrastructure', 'infraestructura'],
  26 => ['infraestucture', 'infrastructure', 'infraestructura'],
  27 => ['infraestucture', 'infrastructure', 'infraestructura'],
  28 => ['presentation', 'presentacion', 'presentación'],
  29 => ['presentation', 'presentacion', 'presentación'],

  /* --- D. puertos --- */
  35 => ['puerto', 'port', 'interfaz', 'interface'],
  36 => ['adaptador', 'adapter', 'implementacion', 'implementación'],
  37 => ['invierte', 'invertir', 'inversion', 'inversión'],

  /* --- E. el alias y la carpeta shared --- */
  40 => ['@/'],
  41 => ['tsconfig.json', 'tsconfig'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => 'La regla de oro de la arquitectura limpia es que las dependencias apuntan hacia adentro. En la practica, ¿como se comprueba?',
    'opciones' => [
      'a' => 'Mirando que no haya ciclos entre archivos.',
      'b' => 'Abriendo cualquier archivo del dominio y revisando sus <code>import</code>: si aparece React, <code>fetch</code>, <code>localStorage</code> o un DTO del backend, la regla esta rota.',
      'c' => 'Contando las lineas de cada capa.',
      'd' => 'Comprobando que cada carpeta tenga un <code>index.ts</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Es una regla verificable a simple vista. El dominio de este proyecto solo importa de <code>@/shared/domain</code>, nada mas. Por eso sus tests corren en milisegundos y sin navegador.',
  ],

  'm2' => [
    'texto' => '¿Por que <code>RentalRepository</code> (la interfaz) vive en <b>application</b> y no en <b>infraestucture</b>, que es donde esta el <code>fetch</code>?',
    'opciones' => [
      'a' => 'Por costumbre; da igual donde se ponga.',
      'b' => 'Porque la interfaz es lo que el caso de uso <b>necesita</b>, no lo que la API <b>ofrece</b>: la define quien la usa y la implementa quien habla con el servidor. Asi la flecha de dependencia apunta hacia adentro.',
      'c' => 'Porque TypeScript no permite interfaces en infraestructura.',
      'd' => 'Porque asi se puede exportar al backend.',
    ],
    'correcta' => 'b',
    'porque' => 'Esto es la <b>inversion de dependencias</b>. Si la interfaz viviera en infraestructura, application tendria que importar de infraestructura y la flecha apuntaria hacia afuera: volveriamos a tener el caso de uso atado al <code>fetch</code>.',
  ],

  'm3' => [
    'texto' => 'En la rama <code>clase3-next</code>, casi todas las carpetas de <code>features/vehicles</code> solo tienen un archivo <code>.gitkeep</code>. ¿Que significa?',
    'opciones' => [
      'a' => 'Que esa feature se elimino.',
      'b' => 'Que git no guarda carpetas vacias: el <code>.gitkeep</code> las mantiene en el repo como un plano de lo que se va a construir en las proximas clases.',
      'c' => 'Que son carpetas generadas automaticamente por Next.js.',
      'd' => 'Que ahi va codigo compilado.',
    ],
    'correcta' => 'b',
    'porque' => 'La estructura esta puesta <b>antes</b> que el codigo, a proposito: cuando escribas algo nuevo, la pregunta "¿donde lo pongo?" ya tiene respuesta. Y el contraste entre <code>rentals</code> (con codigo) y <code>vehicles</code> (vacia) te dice exactamente por donde va el curso.',
  ],

  'm4' => [
    'texto' => 'Organizar por <b>features</b> (rentals, vehicles) y dentro por capas, en vez de carpetas globales <code>components/</code>, <code>services/</code>, <code>hooks/</code>, sirve sobre todo para:',
    'opciones' => [
      'a' => 'Reducir el numero de archivos.',
      'b' => 'Que al trabajar en una funcionalidad todo lo suyo este junto, y que borrarla o moverla sea borrar o mover una carpeta.',
      'c' => 'Mejorar el rendimiento de Next.js.',
      'd' => 'Evitar imports relativos.',
    ],
    'correcta' => 'b',
    'porque' => 'Con carpetas por tipo de archivo, una sola funcionalidad queda repartida en cinco sitios y nadie sabe si un <code>service</code> sigue en uso. Con carpetas por feature, el alcance de cada cambio es visible en el arbol de archivos.',
  ],

  'm5' => [
    'texto' => '¿Que distingue a <code>src/shared</code> de <code>src/features</code>?',
    'opciones' => [
      'a' => '<code>shared</code> es para codigo viejo que todavia no se ha migrado.',
      'b' => '<code>shared</code> guarda lo que no pertenece a ninguna funcionalidad concreta y varias usan: <code>Money</code>, <code>DateRange</code>, <code>DomainError</code>. Tambien esta dividido en capas.',
      'c' => '<code>shared</code> solo puede contener tipos, no clases.',
      'd' => '<code>shared</code> es la carpeta publica que sirve Next.js.',
    ],
    'correcta' => 'b',
    'porque' => 'Un alquiler y un vehiculo manejan los dos pesos y periodos de fechas, asi que esos value objects no son "de rentals". Fijate en que <code>shared</code> repite la misma division en capas: no es un cajon de sastre.',
  ],

  'm6' => [
    'texto' => 'Un compañero propone: "pongamos el <code>fetch</code> dentro del caso de uso y nos ahorramos la interfaz". ¿Que se pierde?',
    'opciones' => [
      'a' => 'Nada, es mas corto y hace lo mismo.',
      'b' => 'Se pierde poder probar el caso de uso sin servidor, poder cambiar de <code>fetch</code> a axios o a datos de prueba, y se vuelve a atar la logica a la red.',
      'c' => 'Solo se pierde el autocompletado del editor.',
      'd' => 'Se pierde el tipado de la respuesta.',
    ],
    'correcta' => 'b',
    'porque' => 'El test del caso de uso se escribe pasandole un repositorio falso en memoria. Si el <code>fetch</code> esta dentro, ya no hay forma de sustituirlo sin trucos raros, y el test necesita la API corriendo.',
  ],

  'm7' => [
    'texto' => 'En el proyecto, la carpeta esta escrita <code>infraestucture</code> (le falta una "r"). ¿Que conviene hacer?',
    'opciones' => [
      'a' => 'Renombrarla en tu copia y ya: es solo cosmetico.',
      'b' => 'Respetar como esta escrita en el repo del profe mientras trabajes sobre el, porque los <code>import</code> deben coincidir exactamente; si se renombra, hay que cambiarlos todos a la vez.',
      'c' => 'Es obligatorio escribirlo asi en arquitectura limpia.',
      'd' => 'Borrarla y poner todo en <code>shared</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Un detalle practico, pero real: en Windows el sistema de archivos no distingue mayusculas y el error puede no aparecer hasta que el proyecto se despliega en Linux. Si lo corriges, hazlo de una vez y con el compilador verificando.',
  ],

  'm8' => [
    'texto' => 'Mercadeo cambia la libreria de componentes y rehace toda la pantalla. Con esta estructura, ¿que archivos se tocan?',
    'opciones' => [
      'a' => 'Solo los de <code>presentation</code> (y <code>app/</code>): ni el dominio, ni los casos de uso, ni el repositorio HTTP se enteran.',
      'b' => 'Presentation y domain, porque el formato de los precios cambia.',
      'c' => 'Todas las capas, porque el cambio es visual y afecta a todo.',
      'd' => 'Solo <code>di</code>, que es donde se arma la pantalla.',
    ],
    'correcta' => 'a',
    'porque' => 'Ese es el examen de la arquitectura: para cada uno de los siete cambios anunciados, señalar las carpetas afectadas. Si un cambio visual toca el dominio, algo esta mal puesto.',
  ],
];

$RETOS = [
  'r1' => [
    'titulo' => 'las seis carpetas de una feature, en orden',
    'huecos' => [1, 2, 3, 4, 5, 6],
    'codigo' => "src/features/rentals/
domain/
application/
infraestucture/
presentation/
di/
testing/",
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 2 — La estructura de carpetas y la regla de dependencias', 'Que va en cada capa, por que, y como se comprueba que no se rompio la regla');
?>

<div class="card">
  <h2>El arbol de la rama clase3-next</h2>

<pre><code>src/
├── <?php hueco(11, 5); ?>/   &rarr; rutas de Next (login, mis-alquileres, vehiculos)
├── <?php hueco(12, 11); ?>/  &rarr; el codigo legado que vamos a vaciar
├── <?php hueco(7, 10); ?>/
│   ├── <?php hueco(9, 9); ?>/           &rarr; la funcionalidad con codigo ya escrito
│   │   ├── <?php hueco(1, 9); ?>/        &rarr; reglas del negocio: entities, rules, value-objects, errors
│   │   ├── <?php hueco(2, 12); ?>/   &rarr; casos de uso y los puertos que necesitan
│   │   ├── <?php hueco(3, 15); ?>/ &rarr; fetch, mapper, token, URL del servidor
│   │   ├── <?php hueco(4, 13); ?>/  &rarr; hooks y componentes de React
│   │   ├── <?php hueco(5, 4); ?>/            &rarr; donde se arman las piezas
│   │   └── <?php hueco(6, 9); ?>/       &rarr; pruebas
│   └── <?php hueco(10, 10); ?>/          &rarr; todavia vacia (.gitkeep): la clase que viene
└── <?php hueco(8, 8); ?>/
    ├── domain/               &rarr; Money, DateRange, DomainError
    ├── application/
    ├── infraestucture/
    └── presentation/</code></pre>

  <div class="nota">
    Las carpetas estan creadas <b>antes</b> que el codigo. Donde solo hay un <code>.gitkeep</code>,
    es un hueco reservado para las proximas clases.
  </div>

  <?php mc('m3'); mc('m4'); mc('m5'); mc('m7'); ?>

  <?php reto('r1'); ?>
</div>

<div class="card">
  <h2>A. La regla de oro</h2>
  <p>Las dependencias apuntan hacia <?php hueco(15, 10); ?>. Es decir:
     presentacion e infraestructura conocen a aplicacion y a
     <?php hueco(16, 10); ?>, pero el dominio no conoce a
     <?php hueco(17, 8); ?>.</p>

<pre><code>presentation  ──┐
                ├──&gt;  application  ──&gt;  domain
infraestucture ─┘                        (no importa nada de fuera)</code></pre>

  <div class="avisoflujo">
    <b>Como se verifica:</b> abre cualquier archivo de <code>domain</code> y mira sus <code>import</code>.
    Si aparece <code>react</code>, <code>next</code>, <code>fetch</code>, <code>localStorage</code> o un DTO
    del backend, la regla esta rota. En este proyecto, el dominio solo importa de
    <code>@/shared/domain</code>.
  </div>

  <?php mc('m1'); mc('m8'); ?>
</div>

<div class="card">
  <h2>B. Donde va cada pieza</h2>
  <p>Completa con <code>domain</code>, <code>application</code>, <code>infraestucture</code> o <code>presentation</code>:</p>

  <ul>
    <li><code>Rental</code> (la entidad) &rarr; <?php hueco(20, 15); ?></li>
    <li><code>calculatePrice</code> y <code>DateRange.days()</code> &rarr; <?php hueco(21, 15); ?></li>
    <li><code>canCancel(rental, now)</code> &rarr; <?php hueco(22, 15); ?></li>
    <li><code>RentalRepository</code> (interfaz: <code>findMine</code>, <code>cancel</code>) &rarr; <?php hueco(23, 15); ?></li>
    <li><code>makeListMyRentals</code> y <code>cancelRental</code> (casos de uso) &rarr; <?php hueco(24, 15); ?></li>
    <li><code>HttpRentalRepository</code> &rarr; <?php hueco(25, 15); ?></li>
    <li>El mapper <code>RentalDto &rarr; Rental</code> &rarr; <?php hueco(26, 15); ?></li>
    <li>La configuracion (<code>API_URL</code>) y el token &rarr; <?php hueco(27, 15); ?></li>
    <li>El hook <code>useMyRentals</code> &rarr; <?php hueco(28, 15); ?></li>
    <li><code>MyRentals.tsx</code> &rarr; <?php hueco(29, 15); ?></li>
  </ul>

  <div class="nota">
    Atencion a las dos lineas del medio: la <b>interfaz</b> del repositorio va en application,
    pero su <b>implementacion</b> va en infraestructura. No es un descuido.
  </div>
</div>

<div class="card">
  <h2>C. Puertos y adaptadores</h2>
  <p>La interfaz que el caso de uso necesita se llama <?php hueco(35, 12); ?>;
     la clase que la cumple hablando con el servidor real es el
     <?php hueco(36, 12); ?>.</p>

  <p>Como la interfaz la define quien la usa y no quien la implementa, se dice que esta
     tecnica <?php hueco(37, 12); ?> la dependencia: infraestructura depende de
     aplicacion, y no al reves.</p>

<pre><code>// application/repositories/rental-repository.ts   (el puerto)
export interface RentalRepository {
  findMine(): Promise&lt;Rental[]&gt;;
  cancel(rentalId: number): Promise&lt;void&gt;;
}

// infraestucture/http-rental-repository.ts        (el adaptador, aun por escribir)
export class HttpRentalRepository implements RentalRepository { ... }

// testing/fake-rental-repository.ts               (otro adaptador, para los tests)
export class FakeRentalRepository implements RentalRepository { ... }</code></pre>

  <?php mc('m2'); mc('m6'); ?>
</div>

<div class="card">
  <h2>D. Detalle practico: el alias de imports</h2>
  <p>En los archivos veras <code>import type { Money } from '<?php hueco(40, 4); ?>shared/domain/value-objects/money';</code>.
     Ese alias no es magia de Next: esta configurado en <?php hueco(41, 14); ?>
     y tambien hay que repetirlo en <code>vitest.config.mts</code> para que los tests lo entiendan.</p>
</div>

<?php pie('index.php', 'tercero.php'); ?>
