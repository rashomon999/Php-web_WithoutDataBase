<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. el repositorio --- */
  1  => ['@Injectable()', '@Injectable'],
  2  => ['@InjectRepository'],
  3  => ['Repository'],
  4  => ['create'],
  5  => ['save'],
  6  => ['find'],
  7  => ['findOne'],
  8  => ['update'],
  9  => ['delete'],
  10 => ['affected'],

  /* --- B. update / delete --- */
  15 => ['update'],
  16 => ['affected'],
  17 => ['NotFoundException'],
  18 => ['findOne'],
  19 => ['delete'],
  20 => ['true'],

  /* --- C. buscar --- */
  25 => ['Like'],
  26 => ['relations'],
  27 => ['Between'],
  28 => ['Not'],
  29 => ['available'],
  30 => ['some'],
  31 => ['filter'],

  /* --- D. reservas --- */
  35 => ['ConflictException'],
  36 => ['BadRequestException'],
  37 => ['checkOutDate'],
  38 => ['checkInDate'],
  39 => ['cancelled'],
  40 => ['Number'],
  41 => ['Math.ceil', 'ceil'],
  42 => ['pending'],

  /* --- E. de memoria --- */
  50 => ['const hotel = this.hotelsRepository.create(createHotelDto);'],
  51 => ['return this.hotelsRepository.save(hotel);'],
  52 => ['const result = await this.hotelsRepository.delete(id);'],
  53 => ['throw new NotFoundException(`Hotel with id ${id} not found`);'],
  54 => ['return this.bookingsRepository.find({ where: { user: { id: userId } }, relations: [\'room\', \'user\'] });'],
  55 => ['const result = await this.bookingsRepository.update(id, { status: \'cancelled\' });'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => '<code>this.hotelsRepository.create(dto)</code>. ¿Que hace exactamente?',
    'opciones' => [
      'a' => 'Ejecuta un INSERT y devuelve la fila creada.',
      'b' => 'Solo construye un objeto <code>Hotel</code> en memoria a partir del DTO. No toca la base de datos: quien inserta es <code>save()</code>.',
      'c' => 'Crea la tabla si no existe.',
      'd' => 'Valida el DTO y luego inserta.',
    ],
    'correcta' => 'b',
    'porque' => 'Es el error numero uno con TypeORM: llamar a <code>create()</code> y esperar que haya guardado. <code>create()</code> es sincrono (no devuelve promesa) y eso ya es una pista.',
  ],

  'm2' => [
    'texto' => '¿Por que <code>update()</code> va siempre seguido de un <code>findOne()</code>?',
    'opciones' => [
      'a' => 'Para comprobar que el update funciono.',
      'b' => 'Porque <code>update()</code> lanza un UPDATE directo y devuelve un <code>UpdateResult</code> (<code>{ affected: 1 }</code>), no la entidad. Si quieres devolver el objeto actualizado hay que releerlo.',
      'c' => 'Porque <code>update()</code> no guarda hasta que haces <code>findOne()</code>.',
      'd' => 'Por costumbre; se podria devolver el <code>UpdateResult</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Lo dice el test: <code>mockRepository.update.mockResolvedValue({ affected: 1 })</code> y aparte <code>mockRepository.findOne.mockResolvedValue(updatedHotel)</code>, y luego comprueba <code>result.name</code>. Si devolvieras el UpdateResult no habria <code>name</code>.',
  ],

  'm3' => [
    'texto' => '<code>delete(9999)</code> con un id que no existe. ¿Que pasa?',
    'opciones' => [
      'a' => 'Lanza <code>EntityNotFoundError</code>.',
      'b' => 'Devuelve <code>{ affected: 0 }</code> sin lanzar nada: si quieres un 404 lo tienes que comprobar tu.',
      'c' => 'Devuelve <code>null</code>.',
      'd' => 'Lanza un error de clave foranea.',
    ],
    'correcta' => 'b',
    'porque' => 'Por eso el patron es <code>if (result.affected === 0) throw new NotFoundException(...)</code>. El que lanza solo es <code>findOneOrFail</code>.',
  ],

  'm4' => [
    'texto' => 'Diferencia entre <code>remove(entidad)</code> y <code>delete(id)</code>:',
    'opciones' => [
      'a' => 'Ninguna, <code>remove</code> es el nombre viejo.',
      'b' => '<code>remove()</code> recibe la <b>entidad ya cargada</b> (hace falta un SELECT antes) y dispara los <code>cascade</code> y los hooks de TypeORM; <code>delete()</code> recibe el id y manda un DELETE directo, sin cargar nada.',
      'c' => '<code>delete()</code> es soft delete.',
      'd' => '<code>remove()</code> devuelve <code>{ affected }</code>.',
    ],
    'correcta' => 'b',
    'porque' => '<code>delete()</code> es mas rapido (una consulta menos) pero se salta la logica de TypeORM. Si dependes de <code>cascade: true</code> en JavaScript, necesitas <code>remove()</code>; si dependes de <code>onDelete: \'CASCADE\'</code>, <code>delete()</code> vale, porque eso lo hace la base de datos.',
  ],

  'm5' => [
    'texto' => 'En <code>update(id, {})</code> con un objeto vacio, TypeORM:',
    'opciones' => [
      'a' => 'No hace nada y devuelve <code>{ affected: 0 }</code>.',
      'b' => 'Lanza <code>UpdateValuesMissingError</code>: no puede construir un UPDATE sin columnas que cambiar. Sale como un 500.',
      'c' => 'Borra todas las columnas.',
      'd' => 'Devuelve la entidad sin cambios.',
    ],
    'correcta' => 'b',
    'porque' => 'Como se llega a eso: con <code>whitelist</code> pero SIN <code>forbidNonWhitelisted</code>, mandar <code>{ "nombre": "x" }</code> deja el DTO vacio. <code>forbidNonWhitelisted</code> te convierte ese 500 en un 400 que se entiende.',
  ],

  'm6' => [
    'texto' => 'La regla del solape de fechas. Dos rangos <code>[aIn, aOut)</code> y <code>[bIn, bOut)</code> chocan si:',
    'opciones' => [
      'a' => '<code>aIn &lt; bOut &amp;&amp; aOut &gt; bIn</code>',
      'b' => '<code>aIn &lt; bIn &amp;&amp; aOut &gt; bOut</code>',
      'c' => '<code>aIn &gt;= bIn &amp;&amp; aOut &lt;= bOut</code>',
      'd' => '<code>aIn === bIn || aOut === bOut</code>',
    ],
    'correcta' => 'a',
    'porque' => 'Esa unica condicion cubre los cuatro casos (empieza antes y termina dentro, empieza dentro y termina despues, lo contiene, esta contenido) sin enumerar ninguno. Y como los signos son estrictos, salir el dia 5 y que otro entre el dia 5 NO es conflicto: justo lo que quieres en un hotel.',
  ],

  'm7' => [
    'texto' => '¿Por que <code>cancel()</code> hace <code>update(id, { status: \'cancelled\' })</code> y no <code>delete(id)</code>?',
    'opciones' => [
      'a' => 'Porque <code>delete</code> no funciona con relaciones.',
      'b' => 'Porque cancelar no es borrar: quieres conservar el historico (quien reservo, cuando, cuanto pago) y ademas el test e2e comprueba <code>body.status === \'cancelled\'</code>.',
      'c' => 'Porque el id se reutilizaria.',
      'd' => 'Porque <code>delete</code> es mas lento.',
    ],
    'correcta' => 'b',
    'porque' => 'Es el patron "soft delete" hecho a mano con un campo de estado. Ademas <code>hasDateConflict</code> puede ignorar las canceladas con <code>status: Not(\'cancelled\')</code> y liberar esas fechas.',
  ],

  'm8' => [
    'texto' => 'El mock de <code>booking.service.spec.ts</code> solo registra el repositorio de <code>Booking</code>. Si pones <code>@InjectRepository(Room)</code> como dependencia normal en <code>BookingService</code>:',
    'opciones' => [
      'a' => 'Nest inyecta <code>undefined</code> y los tests siguen pasando.',
      'b' => 'Falla <b>todo</b> el suite con <code>Nest can\'t resolve dependencies of the BookingService (BookingRepository, ?)</code>, al compilar el TestingModule.',
      'c' => 'Solo falla el test de <code>create</code>.',
      'd' => 'Falla solo si el test usa el precio.',
    ],
    'correcta' => 'b',
    'porque' => 'El contenedor se resuelve entero en <code>.compile()</code>, dentro del <code>beforeEach</code>. Si una dependencia no tiene provider, ningun test de ese fichero llega a ejecutarse. Por eso la solucion aqui fue <code>@Optional() @InjectRepository(Room)</code>.',
  ],

  'm9' => [
    'texto' => '¿Que hace <code>@Optional()</code> delante de <code>@InjectRepository(Room)</code>?',
    'opciones' => [
      'a' => 'Marca la propiedad como <code>?</code> en TypeScript.',
      'b' => 'Le dice al contenedor de Nest que, si no encuentra un provider para ese token, inyecte <code>undefined</code> en vez de lanzar un error de arranque.',
      'c' => 'Retrasa la inyeccion hasta el primer uso.',
      'd' => 'Crea el repositorio si no existe.',
    ],
    'correcta' => 'b',
    'porque' => 'En la app real <code>BookingModule</code> hace <code>forFeature([Booking, Room])</code> y la inyecta de verdad; en el test llega <code>undefined</code>, y por eso el codigo escribe <code>if (this.roomsRepository) { ... }</code>.',
  ],

  'm10' => [
    'texto' => 'En <code>hasDateConflict</code> esta escrito <code>const solapadas = (reservas ?? []).filter(...)</code>. ¿Por que el <code>?? []</code>?',
    'opciones' => [
      'a' => 'Porque <code>find()</code> puede devolver <code>null</code> en TypeORM.',
      'b' => 'Porque en el test de <code>create</code>, <code>mockRepository.find</code> es un <code>jest.fn()</code> sin <code>mockResolvedValue</code>, o sea que devuelve <code>undefined</code>; sin el fallback saldria <code>Cannot read properties of undefined (reading \'filter\')</code>.',
      'c' => 'Porque las reservas canceladas llegan como <code>undefined</code>.',
      'd' => 'Por estilo defensivo, no hace falta.',
    ],
    'correcta' => 'b',
    'porque' => 'Es la leccion de los mocks incompletos: un mock solo devuelve lo que le programas. Si el codigo llama a un metodo que el test no preparo, recibes <code>undefined</code>, no un error claro.',
  ],

  'm11' => [
    'texto' => '<code>Like(\'%Downtown%\')</code> en el <code>where</code>. ¿Y si el <code>where</code> es un <b>array</b> de dos objetos?',
    'opciones' => [
      'a' => 'Es un AND: tienen que cumplirse los dos.',
      'b' => 'Es un OR: basta con que se cumpla uno. <code>where: [{ location: Like(..) }, { city: Like(..) }]</code> busca en location O en city.',
      'c' => 'Es un error de sintaxis.',
      'd' => 'Aplica el primero y descarta el resto.',
    ],
    'correcta' => 'b',
    'porque' => 'Regla de TypeORM: dentro de un objeto = AND entre sus propiedades; entre objetos de un array = OR. Muy facil de olvidar.',
  ],

  'm12' => [
    'texto' => '<code>getAvailableHotels()</code> filtra en JavaScript con <code>hotels.filter(h =&gt; h.rooms.some(r =&gt; r.available))</code>. ¿Que problema tiene eso en una base de datos grande?',
    'opciones' => [
      'a' => 'Ninguno, es lo mismo que filtrar en SQL.',
      'b' => 'Que trae TODOS los hoteles con TODAS sus habitaciones a memoria y luego descarta. Lo correcto a escala es un QueryBuilder con <code>innerJoin</code> y <code>where(\'room.available = true\')</code>, para que filtre la base de datos.',
      'c' => 'Que <code>some</code> no funciona con relaciones.',
      'd' => 'Que hay que usar <code>eager: true</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Para un taller esta bien y es legible. La frase que hay que saber decir en un examen: "esto no escala porque el filtrado ocurre en la aplicacion y no en el motor".',
  ],

  'm13' => [
    'texto' => '<code>totalPrice = noches * Number(room.pricePerNight)</code>. ¿Por que <code>Number(...)</code>?',
    'opciones' => [
      'a' => 'Por seguridad de tipos en TypeScript, en tiempo de ejecucion da igual.',
      'b' => 'Porque las columnas <code>decimal</code> llegan como <b>string</b> en varios drivers; sin la conversion, un <code>+</code> en vez de un <code>*</code> concatenaria en lugar de sumar.',
      'c' => 'Porque <code>noches</code> es un string.',
      'd' => 'Para redondear.',
    ],
    'correcta' => 'b',
    'porque' => '<code>5 * "150"</code> da 750 (JavaScript convierte al multiplicar) pero <code>5 + "150"</code> da <code>"5150"</code>. Convertir explicito te ahorra el dia en que alguien cambie la formula.',
  ],

  'm14' => [
    'texto' => '<code>findOne({ where: { user: { id: userId } } })</code>. ¿Que esta haciendo ese objeto anidado?',
    'opciones' => [
      'a' => 'Cargando el usuario entero y comparandolo.',
      'b' => 'Filtrando por la clave foranea de la relacion: equivale a <code>WHERE booking.userId = ?</code>.',
      'c' => 'Creando el usuario si no existe.',
      'd' => 'Es la sintaxis de <code>relations</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Es la forma moderna de filtrar por relacion en TypeORM 0.3. Ojo: filtrar por relacion NO la carga; si quieres el objeto <code>user</code> en la respuesta, necesitas ademas <code>relations: [\'user\']</code>.',
  ],

  'm15' => [
    'texto' => 'Email repetido en <code>UserService.create</code>. El codigo traia <code>NotFoundException</code>. ¿Cual es la correcta y por que?',
    'opciones' => [
      'a' => '<code>BadRequestException</code> (400), porque el dato es invalido.',
      'b' => '<code>ConflictException</code> (409), porque el recurso ya existe y choca con el estado actual del servidor.',
      'c' => '<code>NotFoundException</code> (404) esta bien: no se encontro un hueco libre.',
      'd' => '<code>ForbiddenException</code> (403).',
    ],
    'correcta' => 'b',
    'porque' => '404 = "no existe". 409 = "ya existe / conflicto". El test lo dice literal: <code>.rejects.toThrow(ConflictException)</code>. Es el tipo de detalle que separa una API que se entiende de una que no.',
  ],
];

$RETOS = [
  'r1' => [
    'titulo' => 'los metodos update() y delete() de HotelService',
    'huecos' => [15, 16, 17, 18, 19, 20],
    'codigo' => "async update(id: number, updateData: UpdateHotelDto): Promise<Hotel> {
  const result = await this.hotelsRepository.update(id, updateData);

  if (result && result.affected === 0) {
    throw new NotFoundException(`Hotel with id \${id} not found`);
  }

  return this.findOne(id);
}

async delete(id: number): Promise<boolean> {
  const result = await this.hotelsRepository.delete(id);

  if (result && result.affected === 0) {
    throw new NotFoundException(`Hotel with id \${id} not found`);
  }

  return true;
}",
  ],
  'r2' => [
    'titulo' => 'el metodo hasDateConflict() entero',
    'huecos' => [28, 37, 38, 39],
    'codigo' => "async hasDateConflict(
  roomId: number,
  checkInDate: Date,
  checkOutDate: Date,
): Promise<boolean> {
  const reservas = await this.bookingsRepository.find({
    where: {
      room: { id: roomId },
      status: Not('cancelled'),
    },
    relations: ['room'],
  });

  const solapadas = (reservas ?? []).filter(
    (reserva) =>
      new Date(reserva.checkInDate) < checkOutDate &&
      new Date(reserva.checkOutDate) > checkInDate,
  );

  return solapadas.length > 0;
}",
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Taller Hotel 4 — Servicios, repositorio y CRUD', 'create vs save, update vs remove, affected, Like/Between/Not y la regla del solape');
?>

<div class="card">
  <h2>Los 7 metodos del Repository que hay que tener en la cabeza</h2>

  <table style="width:100%;border-collapse:collapse;font-size:14.5px">
    <tr style="background:#eef0f3">
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Metodo</th>
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">¿Toca la BD?</th>
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Devuelve</th>
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Si no existe</th>
    </tr>
    <tr><td style="padding:8px;border:1px solid #d8dbe0"><code><?php hueco(4, 8); ?>(dto)</code></td>
        <td style="padding:8px;border:1px solid #d8dbe0"><b>No</b></td>
        <td style="padding:8px;border:1px solid #d8dbe0">la entidad en memoria</td>
        <td style="padding:8px;border:1px solid #d8dbe0">—</td></tr>
    <tr><td style="padding:8px;border:1px solid #d8dbe0"><code><?php hueco(5, 8); ?>(entidad)</code></td>
        <td style="padding:8px;border:1px solid #d8dbe0">Si (INSERT o UPDATE)</td>
        <td style="padding:8px;border:1px solid #d8dbe0">la entidad guardada, con id</td>
        <td style="padding:8px;border:1px solid #d8dbe0">la crea</td></tr>
    <tr><td style="padding:8px;border:1px solid #d8dbe0"><code><?php hueco(6, 8); ?>(opts)</code></td>
        <td style="padding:8px;border:1px solid #d8dbe0">Si</td>
        <td style="padding:8px;border:1px solid #d8dbe0">un array (vacio si no hay nada)</td>
        <td style="padding:8px;border:1px solid #d8dbe0"><code>[]</code></td></tr>
    <tr><td style="padding:8px;border:1px solid #d8dbe0"><code><?php hueco(7, 10); ?>(opts)</code></td>
        <td style="padding:8px;border:1px solid #d8dbe0">Si</td>
        <td style="padding:8px;border:1px solid #d8dbe0">la entidad o <code>null</code></td>
        <td style="padding:8px;border:1px solid #d8dbe0"><code>null</code> (¡no lanza!)</td></tr>
    <tr><td style="padding:8px;border:1px solid #d8dbe0"><code><?php hueco(8, 8); ?>(id, datos)</code></td>
        <td style="padding:8px;border:1px solid #d8dbe0">Si (UPDATE directo)</td>
        <td style="padding:8px;border:1px solid #d8dbe0"><code>UpdateResult</code>: <code>{ <?php hueco(10, 10); ?> }</code></td>
        <td style="padding:8px;border:1px solid #d8dbe0"><code>affected: 0</code></td></tr>
    <tr><td style="padding:8px;border:1px solid #d8dbe0"><code><?php hueco(9, 8); ?>(id)</code></td>
        <td style="padding:8px;border:1px solid #d8dbe0">Si (DELETE directo)</td>
        <td style="padding:8px;border:1px solid #d8dbe0"><code>DeleteResult</code></td>
        <td style="padding:8px;border:1px solid #d8dbe0"><code>affected: 0</code></td></tr>
    <tr><td style="padding:8px;border:1px solid #d8dbe0"><code>remove(entidad)</code></td>
        <td style="padding:8px;border:1px solid #d8dbe0">Si</td>
        <td style="padding:8px;border:1px solid #d8dbe0">la entidad borrada (sin id)</td>
        <td style="padding:8px;border:1px solid #d8dbe0">hace falta cargarla antes</td></tr>
  </table>

  <?php mc('m1'); mc('m3'); mc('m4'); mc('m5'); ?>
</div>

<div class="card">
  <h2>A. Como llega el repositorio al service</h2>

<pre><code><?php hueco(1, 13); ?> 
export class HotelService {
  constructor(
    <?php hueco(2, 19); ?>(Hotel)
    private hotelsRepository: <?php hueco(3, 12); ?>&lt;Hotel&gt;,
  ) {}</code></pre>

  <div class="avisoflujo">
    <b>La cadena:</b> <code>TypeOrmModule.forFeature([Hotel])</code> en <code>hotel.module.ts</code>
    registra un provider con el token <code>getRepositoryToken(Hotel)</code> →
    <code>@InjectRepository(Hotel)</code> pide <b>ese</b> token →
    Nest inyecta el <code>Repository&lt;Hotel&gt;</code>.
    Si falta el <code>forFeature</code>, el fallo es de <b>arranque</b>, no de peticion.
  </div>

  <?php mc('m8'); mc('m9'); ?>
</div>

<div class="card">
  <h2>B. El patron de update y delete</h2>

<pre><code>async update(id: number, updateData: UpdateHotelDto): Promise&lt;Hotel&gt; {
  const result = await this.hotelsRepository.<?php hueco(15, 8); ?>(id, updateData);

  if (result && result.<?php hueco(16, 10); ?> === 0) {
    throw new <?php hueco(17, 20); ?>(`Hotel with id ${id} not found`);
  }

  return this.<?php hueco(18, 10); ?>(id);   // update no devuelve la entidad
}

async delete(id: number): Promise&lt;boolean&gt; {
  const result = await this.hotelsRepository.<?php hueco(19, 8); ?>(id);

  if (result && result.affected === 0) {
    throw new NotFoundException(`Hotel with id ${id} not found`);
  }

  return <?php hueco(20, 6); ?>;
}</code></pre>

  <?php mc('m2'); ?>
  <?php reto('r1'); ?>
</div>

<div class="card">
  <h2>C. Buscar: los operadores de TypeORM</h2>

<pre><code>// buscar por texto parcial: WHERE location LIKE '%Downtown%'
where: [
  { location: <?php hueco(25, 8); ?>(`%${location}%`) },   // un array de objetos = OR
  { city:     Like(`%${location}%`) },
],
<?php hueco(26, 12); ?>: ['rooms'],        // sin esto, hotel.rooms viene undefined

// rango de fechas: WHERE checkInDate BETWEEN ? AND ?
where: { checkInDate: <?php hueco(27, 10); ?>(startDate, endDate) }

// todo menos las canceladas: WHERE status != 'cancelled'
where: { status: <?php hueco(28, 6); ?>('cancelled') }

// habitaciones libres de un hotel
where: { hotel: { id: hotelId }, <?php hueco(29, 11); ?>: true }</code></pre>

  <p>Y en <code>getAvailableHotels()</code> el filtrado se hace en JavaScript:
     <code>hotels.<?php hueco(31, 8); ?>(h =&gt; h.rooms.<?php hueco(30, 6); ?>(r =&gt; r.available))</code>.
     Se lee muy bien, pero trae todo a memoria antes de descartar.</p>

  <?php mc('m11'); mc('m12'); mc('m14'); ?>
</div>

<div class="card">
  <h2>D. BookingService: las tres reglas de negocio</h2>

<pre><code>async create(userId: number, dto: CreateBookingDto): Promise&lt;Booking&gt; {
  const checkInDate  = new Date(dto.checkInDate);
  const checkOutDate = new Date(dto.checkOutDate);

  // 1) la salida despues de la entrada
  if (<?php hueco(37, 14); ?> &lt;= <?php hueco(38, 13); ?>) {
    throw new <?php hueco(36, 22); ?>('checkOutDate debe ser posterior a checkInDate');
  }

  // 2) sin solape con otras reservas de la misma habitacion
  const conflicto = await this.hasDateConflict(dto.roomId, checkInDate, checkOutDate);
  if (conflicto) {
    throw new BadRequestException('La habitacion ya esta reservada en esas fechas');
  }

  // 3) precio = noches x precio por noche
  const noches = <?php hueco(41, 11); ?>(
    (checkOutDate.getTime() - checkInDate.getTime()) / (1000 * 60 * 60 * 24),
  );
  totalPrice = noches * <?php hueco(40, 8); ?>(room.pricePerNight);

  const booking = this.bookingsRepository.create({
    checkInDate,
    checkOutDate,
    room: { id: dto.roomId },      // NO 'roomId': la relacion se llama 'room'
    user: { id: userId },
    status: '<?php hueco(42, 9); ?>',
    totalPrice,
  });

  return this.bookingsRepository.save(booking);
}</code></pre>

  <p>Y cancelar no borra: cambia el estado a <code>'<?php hueco(39, 11); ?>'</code>.
     (Un email repetido, en cambio, es un caso para <?php hueco(35, 20); ?>, que da 409.)</p>

  <div class="avisoflujo">
    <b>La regla del solape, dibujada.</b> La reserva nueva es <code>[nIn, nOut)</code>
    y la existente <code>[eIn, eOut)</code>:
<pre class="flujo" style="margin:10px 0 0"><code>existente:        |=========|
nueva A:    |====|                 no choca (nOut &lt;= eIn)
nueva B:       |=====|             SI choca
nueva C:            |====|         SI choca (dentro)
nueva D:                |=====|    SI choca
nueva E:                    |===|  no choca (nIn &gt;= eOut)

una sola condicion los cubre todos:   eIn &lt; nOut   Y   eOut &gt; nIn</code></pre>
  </div>

  <?php mc('m6'); mc('m7'); mc('m10'); mc('m13'); mc('m15'); ?>
  <?php reto('r2'); ?>
</div>

<div class="card">
  <h2>E. De memoria: la linea completa</h2>

  <?php linea(50, 'Construir el hotel en memoria a partir del DTO (sin guardar), en una constante <code>hotel</code>.'); ?>
  <?php linea(51, 'Guardarlo y devolverlo.'); ?>
  <?php linea(52, 'Borrar por id y quedarte con el resultado en <code>result</code>.'); ?>
  <?php linea(53, 'Lanzar el 404 del hotel, con el id interpolado en el mensaje (plantilla con comillas invertidas).'); ?>
  <?php linea(55, 'El UPDATE de <code>cancel()</code>: poner el estado en cancelado, guardando el resultado en <code>result</code>.'); ?>
  <?php linea(54, 'Devolver las reservas de un usuario, cargando las relaciones room y user (todo en una linea).'); ?>
</div>

<?php pie('hotel3.php', 'hotel5.php'); ?>
