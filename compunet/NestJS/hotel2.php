<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. anatomia de una entidad --- */
  1  => ['@Entity()', '@Entity'],
  2  => ['@PrimaryGeneratedColumn()', '@PrimaryGeneratedColumn'],
  3  => ['@Column()', '@Column'],
  4  => ['nullable'],
  5  => ['default'],
  6  => ['unique'],
  7  => ['@CreateDateColumn()', '@CreateDateColumn'],
  8  => ['decimal'],
  9  => ['precision'],
  10 => ['scale'],

  /* --- B. Hotel / Room --- */
  15 => ['@OneToMany'],
  16 => ['rooms'],
  17 => ['@ManyToOne'],
  18 => ['hotel'],
  19 => ['onDelete'],
  20 => ['CASCADE'],
  21 => ['hotelId'],
  22 => ['Room', 'room'],

  /* --- C. Booking --- */
  25 => ['@ManyToOne'],
  26 => ['bookings'],
  27 => ['onDelete'],
  28 => ['user'],
  29 => ['cascade'],
  30 => ['roomId'],
  31 => ['userId'],

  /* --- D. cascade vs onDelete --- */
  35 => ['cascade'],
  36 => ['onDelete'],
  37 => ['TypeORM'],
  38 => ['base de datos', 'la base de datos', 'bd'],

  /* --- E. de memoria --- */
  50 => ['@PrimaryGeneratedColumn()'],
  51 => ['@Column({ nullable: true })'],
  52 => ['@Column(\'decimal\', { precision: 10, scale: 2 })'],
  53 => ['@ManyToOne(() => Room, (room) => room.bookings, { onDelete: \'CASCADE\' })'],
  54 => ['@OneToMany(() => Booking, (booking) => booking.user, { cascade: true })'],
  55 => ['@Column({ default: true })'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => 'En <code>@ManyToOne(() =&gt; Hotel, (hotel) =&gt; hotel.rooms)</code>, ¿para que sirve el <b>segundo</b> argumento?',
    'opciones' => [
      'a' => 'Es el valor por defecto de la relacion.',
      'b' => 'Le dice a TypeORM cual es la propiedad del otro lado que apunta de vuelta: sin ella no sabe emparejar <code>Hotel.rooms</code> con <code>Room.hotel</code>.',
      'c' => 'Es una funcion de filtrado que se ejecuta en cada consulta.',
      'd' => 'Es el nombre de la columna en la base de datos.',
    ],
    'correcta' => 'b',
    'porque' => 'Es el "lado inverso". Sin el, TypeORM crearia <b>dos</b> relaciones independientes en vez de los dos lados de la misma, y acabarias con dos columnas de clave foranea.',
  ],

  'm2' => [
    'texto' => '¿Por que la primera funcion es <code>() =&gt; Hotel</code> y no simplemente <code>Hotel</code>?',
    'opciones' => [
      'a' => 'Por estilo, para que se parezca al segundo argumento.',
      'b' => 'Porque permite referencias circulares: <code>Room</code> importa <code>Hotel</code> y <code>Hotel</code> importa <code>Room</code>. La flecha retrasa la evaluacion hasta que las dos clases existen.',
      'c' => 'Porque TypeORM necesita una instancia nueva en cada consulta.',
      'd' => 'Porque asi la relacion es perezosa (lazy) por defecto.',
    ],
    'correcta' => 'b',
    'porque' => 'Es el patron "thunk". Si pusieras la clase directamente, en el momento de evaluar el decorador una de las dos todavia seria <code>undefined</code> y tendrias un error rarisimo al arrancar.',
  ],

  'm3' => [
    'texto' => '¿En que tabla acaba la columna de clave foranea de una relacion <code>@ManyToOne</code> / <code>@OneToMany</code>?',
    'opciones' => [
      'a' => 'En la tabla del <code>@OneToMany</code> (<code>hotel</code>), como un array.',
      'b' => 'En una tercera tabla de union.',
      'c' => 'En la tabla del <code>@ManyToOne</code> (<code>room</code>), como <code>hotelId</code>: ese es el lado <b>dueño</b> de la relacion.',
      'd' => 'En las dos, para poder navegar en ambos sentidos.',
    ],
    'correcta' => 'c',
    'porque' => 'Regla corta: la clave foranea vive siempre en el lado "muchos". Una habitacion tiene un hotel, asi que <code>room.hotelId</code>. El <code>@OneToMany</code> no crea ninguna columna, es puro reflejo.',
  ],

  'm4' => [
    'texto' => '<code>cascade: true</code> frente a <code>onDelete: \'CASCADE\'</code>:',
    'opciones' => [
      'a' => 'Son lo mismo escrito de dos formas.',
      'b' => '<code>cascade</code> lo aplica TypeORM en JavaScript al hacer <code>save()</code>/<code>remove()</code>; <code>onDelete</code> es una restriccion de la clave foranea que aplica la propia base de datos siempre.',
      'c' => '<code>cascade</code> es para borrar y <code>onDelete</code> para guardar.',
      'd' => '<code>onDelete</code> solo funciona en Postgres.',
    ],
    'correcta' => 'b',
    'porque' => 'Consecuencia practica: si borras una fila con un <code>DELETE</code> a mano desde el cliente de sql, <code>onDelete</code> actua igualmente y <code>cascade</code> no, porque TypeORM ni se entera.',
  ],

  'm5' => [
    'texto' => '¿Donde se pone <code>onDelete: \'CASCADE\'</code>?',
    'opciones' => [
      'a' => 'En el <code>@ManyToOne</code>, que es el lado dueño y el que tiene la columna de clave foranea.',
      'b' => 'En el <code>@OneToMany</code>, que es el que "manda".',
      'c' => 'En los dos, tiene que coincidir.',
      'd' => 'En <code>@Entity()</code>, afecta a toda la tabla.',
    ],
    'correcta' => 'a',
    'porque' => '<code>onDelete</code> forma parte de la definicion de la FOREIGN KEY, y la FK esta en la tabla del lado "muchos". Ponerlo en el <code>@OneToMany</code> no hace nada.',
  ],

  'm6' => [
    'texto' => 'Con <code>Booking.room</code> marcado <code>onDelete: \'CASCADE\'</code>, borras la habitacion 1 que tiene 3 reservas. ¿Que pasa?',
    'opciones' => [
      'a' => 'Falla con un error de integridad referencial.',
      'b' => 'La habitacion se borra y las 3 reservas se quedan con <code>roomId = NULL</code>.',
      'c' => 'La base de datos borra tambien las 3 reservas.',
      'd' => 'Se borra la habitacion y las reservas quedan apuntando a un id que ya no existe.',
    ],
    'correcta' => 'c',
    'porque' => 'Justo eso es lo que faltaba: sin <code>onDelete</code>, el comportamiento por defecto en sqlite deja las reservas huerfanas o hace fallar el borrado, segun como esten las claves foraneas.',
  ],

  'm7' => [
    'texto' => '<code>@Column({ nullable: true })</code> en <code>phone</code>. ¿Que valida eso?',
    'opciones' => [
      'a' => 'Que la peticion puede venir sin <code>phone</code>.',
      'b' => 'Nada de la peticion: es solo la definicion de la <b>columna</b> (acepta NULL). Que el cliente pueda omitirlo lo decide <code>@IsOptional()</code> en el DTO.',
      'c' => 'Que <code>phone</code> puede ser una cadena vacia.',
      'd' => 'Que TypeORM lo rellena con <code>null</code> si el DTO no lo trae.',
    ],
    'correcta' => 'b',
    'porque' => 'Son dos capas distintas y hay que tenerlas separadas en la cabeza: la <b>entidad</b> describe la tabla, el <b>DTO</b> describe lo que acepta la API. Si te olvidas de <code>nullable: true</code> tienes un error de base de datos (NOT NULL constraint failed); si te olvidas de <code>@IsOptional()</code> tienes un 400.',
  ],

  'm8' => [
    'texto' => '<code>@Column(\'decimal\', { precision: 10, scale: 2 })</code> en <code>pricePerNight</code>. Al leerlo de sqlite, ¿de que tipo viene <code>room.pricePerNight</code> en JavaScript?',
    'opciones' => [
      'a' => 'Siempre <code>number</code>, TypeORM lo convierte.',
      'b' => 'Depende del driver: en varios motores los <code>decimal</code> llegan como <b>string</b> para no perder precision, por eso en el service se escribe <code>Number(room.pricePerNight)</code>.',
      'c' => 'Viene como <code>BigInt</code>.',
      'd' => 'Viene como objeto <code>Decimal</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Clasico que te come una tarde: <code>5 * "150"</code> da 750 (JavaScript convierte al multiplicar) pero <code>5 + "150"</code> da <code>"5150"</code>. Por eso el <code>Number(...)</code> explicito al calcular el precio.',
  ],

  'm9' => [
    'texto' => '<code>precision: 5, scale: 2</code> en <code>rating</code>. ¿Que significan?',
    'opciones' => [
      'a' => '5 digitos en total, 2 de ellos decimales: hasta <code>999.99</code>.',
      'b' => '5 decimales con 2 de margen.',
      'c' => 'Minimo 5, maximo 2.',
      'd' => '5 bytes de almacenamiento y 2 de indice.',
    ],
    'correcta' => 'a',
    'porque' => '<code>precision</code> = digitos totales, <code>scale</code> = cuantos de ellos van detras de la coma. Para un rating de 0 a 5 sobra muchisimo, pero no estorba.',
  ],

  'm10' => [
    'texto' => 'Quieres que un email no se pueda repetir. ¿Donde lo pones?',
    'opciones' => [
      'a' => 'Solo <code>@IsEmail()</code> en el DTO: ya comprueba que sea unico.',
      'b' => 'Solo la comprobacion en el service con <code>findOne</code>.',
      'c' => 'Las dos cosas: <code>@Column({ unique: true })</code> en la entidad (garantia real, a nivel de tabla) y el <code>findOne</code> en el service para poder responder un 409 con un mensaje legible.',
      'd' => 'En el <code>ValidationPipe</code>, con <code>whitelist</code>.',
    ],
    'correcta' => 'c',
    'porque' => 'El <code>findOne</code> solo no basta: entre la consulta y el insert puede colarse otra peticion (condicion de carrera). El indice unico es la garantia; el <code>findOne</code> es la buena educacion.',
  ],

  'm11' => [
    'texto' => 'En <code>RoomService.create</code> se escribe <code>hotel: { id: hotelId }</code>. ¿Por que no hace falta cargar el hotel entero?',
    'opciones' => [
      'a' => 'Porque TypeORM lo carga solo por detras.',
      'b' => 'Porque para guardar la relacion solo se necesita la clave foranea, o sea el id. El objeto parcial <code>{ id }</code> es suficiente para que escriba <code>hotelId</code>.',
      'c' => 'Porque <code>create()</code> no guarda nada.',
      'd' => 'Porque la relacion es <code>eager</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Es la forma barata de asignar un <code>@ManyToOne</code>: un SELECT menos. El precio es que si el hotel no existe, el fallo llega al insertar (FOREIGN KEY constraint) en vez de con un 404 limpio.',
  ],

  'm12' => [
    'texto' => '<code>relations: [\'hotel\', \'bookings\']</code> en un <code>findOne</code>. ¿Que hace?',
    'opciones' => [
      'a' => 'Filtra los resultados para que solo salgan los que tienen hotel y reservas.',
      'b' => 'Hace JOIN y rellena esas propiedades en el objeto devuelto; sin eso, <code>room.hotel</code> y <code>room.bookings</code> vienen <code>undefined</code>.',
      'c' => 'Valida que las relaciones existan.',
      'd' => 'Borra las relaciones en cascada.',
    ],
    'correcta' => 'b',
    'porque' => 'Por defecto TypeORM NO trae las relaciones. Las alternativas son <code>relations</code> en cada consulta, <code>{ eager: true }</code> en la entidad (siempre, aunque no lo necesites) o un QueryBuilder con <code>leftJoinAndSelect</code>.',
  ],

  'm13' => [
    'texto' => 'Borras un <code>User</code> que tiene reservas. <code>Booking.user</code> tiene <code>onDelete: \'CASCADE\'</code> y <code>User.bookings</code> tiene <code>cascade: true</code>. ¿Cual de los dos hace el trabajo?',
    'opciones' => [
      'a' => '<code>cascade: true</code>, porque esta en el lado que se borra.',
      'b' => '<code>onDelete: \'CASCADE\'</code>: la base de datos borra las filas de booking cuyo <code>userId</code> apunta al usuario. <code>cascade: true</code> es para guardar/quitar en cascada desde TypeORM.',
      'c' => 'Los dos a la vez, y por eso se borran dos veces.',
      'd' => 'Ninguno: hay que borrar las reservas a mano antes.',
    ],
    'correcta' => 'b',
    'porque' => '<code>cascade: true</code> sirve sobre todo para el caso contrario: guardar un usuario con <code>user.bookings = [...]</code> y que TypeORM inserte tambien las reservas en el mismo <code>save()</code>.',
  ],
];

$RETOS = [
  'r1' => [
    'titulo' => 'la entidad Booking entera',
    'huecos' => [25, 26, 27, 28, 30, 31],
    'codigo' => "@Entity()
export class Booking {
  @PrimaryGeneratedColumn()
  id: number;

  @Column({ type: 'datetime' })
  checkInDate: Date;

  @Column({ type: 'datetime' })
  checkOutDate: Date;

  @Column({ default: 'pending' })
  status: string;

  @Column('decimal', { precision: 10, scale: 2, default: 0 })
  totalPrice: number;

  @CreateDateColumn()
  createdAt: Date;

  @ManyToOne(() => Room, (room) => room.bookings, { onDelete: 'CASCADE' })
  room: Room;

  @ManyToOne(() => User, (user) => user.bookings, { onDelete: 'CASCADE' })
  user: User;
}",
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Taller Hotel 2 — Entidades y relaciones', 'Columnas, claves foraneas, lado dueño, cascade y onDelete');
?>

<div class="card">
  <h2>El mapa de las cuatro entidades</h2>
<pre class="flujo"><code>User  1 ──────&lt; N  Booking  N &gt;────── 1  Room  N &gt;────── 1  Hotel

  @OneToMany           @ManyToOne          @ManyToOne
  bookings             room / user         hotel

La clave foranea (la columna de verdad en la tabla) esta SIEMPRE
en el lado @ManyToOne:   booking.userId · booking.roomId · room.hotelId</code></pre>
  <div class="nota">
    <b>Lado dueño</b> = el que tiene la columna = el <code>@ManyToOne</code>. Ahi van
    <code>onDelete</code>, <code>@JoinColumn</code> y el nombre real de la columna.
    El <code>@OneToMany</code> no crea nada en la base de datos: es solo la vista desde el otro lado.
  </div>
</div>

<div class="card">
  <h2>A. Anatomia de una entidad</h2>
  <p>La entidad <code>User</code>, ya corregida:</p>

<pre><code><?php hueco(1, 10); ?> 
export class User {
  <?php hueco(2, 26); ?> 
  id: number;

  @Column({ <?php hueco(6, 8); ?>: true })      // no se puede repetir en la tabla
  email: string;

  <?php hueco(3, 10); ?> 
  name: string;

  @Column()
  password: string;

  @Column({ <?php hueco(4, 10); ?>: true })    // la columna acepta NULL
  phone: string;

  <?php hueco(7, 22); ?>                        // fecha de creacion automatica
  createdAt: Date;

  @OneToMany(() =&gt; Booking, (booking) =&gt; booking.user, { <?php hueco(29, 9); ?>: true })
  bookings: Booking[];
}</code></pre>

  <p>Y las columnas de dinero y de rating usan el tipo <?php hueco(8, 10); ?>, con
     <?php hueco(9, 11); ?> (digitos totales) y <?php hueco(10, 8); ?> (digitos decimales).
     La columna <code>available</code> de <code>Room</code> arranca en <code>true</code>
     gracias a la opcion <?php hueco(5, 9); ?>.</p>

  <?php mc('m7'); mc('m8'); mc('m9'); mc('m10'); ?>
</div>

<div class="card">
  <h2>B. Hotel ←→ Room</h2>

<pre><code>// hotel.entity.ts
<?php hueco(15, 12); ?>(() =&gt; Room, (room) =&gt; room.<?php hueco(18, 8); ?>, { cascade: true })
rooms: Room[];

// room.entity.ts
<?php hueco(17, 12); ?>(() =&gt; Hotel, (hotel) =&gt; hotel.<?php hueco(16, 8); ?>, { <?php hueco(19, 10); ?>: '<?php hueco(20, 9); ?>' })
hotel: Hotel;</code></pre>

  <p>La columna que existe de verdad en la base de datos se llama <?php hueco(21, 10); ?> 
     y esta en la tabla de <?php hueco(22, 8); ?>, porque es el lado <code>@ManyToOne</code>.</p>

  <?php mc('m1'); mc('m2'); mc('m3'); mc('m5'); mc('m11'); mc('m12'); ?>
</div>

<div class="card">
  <h2>C. Booking: dos claves foraneas</h2>
  <p>Una reserva apunta a una habitacion <b>y</b> a un usuario. Los dos son <code>@ManyToOne</code>,
     asi que la tabla <code>booking</code> tiene dos columnas de clave foranea:
     <?php hueco(30, 9); ?> y <?php hueco(31, 9); ?>.</p>

<pre><code><?php hueco(25, 12); ?>(() =&gt; Room, (room) =&gt; room.<?php hueco(26, 10); ?>, { <?php hueco(27, 10); ?>: 'CASCADE' })
room: Room;

@ManyToOne(() =&gt; User, (<?php hueco(28, 6); ?>) =&gt; user.bookings, { onDelete: 'CASCADE' })
user: User;</code></pre>

  <div class="avisoflujo">
    <b>El bug que traia el taller:</b> la relacion con <code>User</code> ya tenia
    <code>onDelete: 'CASCADE'</code>, pero la relacion con <code>Room</code> no.
    Resultado asimetrico: borrar un usuario limpiaba sus reservas, pero borrar una
    habitacion dejaba reservas apuntando a una habitacion que ya no existia.
  </div>

  <?php mc('m6'); mc('m13'); ?>
  <?php reto('r1'); ?>
</div>

<div class="card">
  <h2>D. La tabla que hay que saberse</h2>

  <table style="width:100%;border-collapse:collapse;font-size:14.5px">
    <tr style="background:#eef0f3">
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Opcion</th>
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Quien lo ejecuta</th>
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Cuando</th>
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Donde se declara</th>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(35, 9); ?>: true</td>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(37, 9); ?>, en JavaScript</td>
      <td style="padding:8px;border:1px solid #d8dbe0">al hacer <code>save()</code> o <code>remove()</code> del padre</td>
      <td style="padding:8px;border:1px solid #d8dbe0">normalmente en el <code>@OneToMany</code></td>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(36, 10); ?>: 'CASCADE'</td>
      <td style="padding:8px;border:1px solid #d8dbe0">la <?php hueco(38, 16); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0">siempre que se borre la fila padre, incluso con SQL a mano</td>
      <td style="padding:8px;border:1px solid #d8dbe0">en el <code>@ManyToOne</code> (lado dueño)</td>
    </tr>
  </table>

  <?php mc('m4'); ?>
</div>

<div class="card">
  <h2>E. De memoria: la linea completa</h2>

  <?php linea(50, 'La clave primaria autoincremental.'); ?>
  <?php linea(51, 'Una columna que acepta NULL.'); ?>
  <?php linea(55, 'La columna <code>available</code> de Room, que arranca en <code>true</code>.'); ?>
  <?php linea(52, 'La columna <code>pricePerNight</code>: decimal, 10 digitos, 2 decimales.'); ?>
  <?php linea(53, 'La relacion <code>Booking.room</code> completa, con borrado en cascada de la base de datos.'); ?>
  <?php linea(54, 'La relacion <code>User.bookings</code> completa, con cascade de TypeORM.'); ?>
</div>

<?php pie('hotel1.php', 'hotel3.php'); ?>
