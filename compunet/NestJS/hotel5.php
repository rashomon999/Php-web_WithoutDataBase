<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. controller --- */
  1  => ['@Controller'],
  2  => ['@Post()', '@Post'],
  3  => ['@Get()', '@Get'],
  4  => ['@Put'],
  5  => ['@Delete'],
  6  => ['@Body()', '@Body'],
  7  => ['@Param'],
  8  => ['ParseIntPipe'],
  9  => ['hotels/:hotelId/rooms'],

  /* --- B. orden de rutas --- */
  15 => ['search'],
  16 => [':id'],
  17 => ['NaN'],
  18 => ['available'],

  /* --- C. codigos --- */
  20 => ['201'],
  21 => ['200'],
  22 => ['400'],
  23 => ['404'],
  24 => ['409'],
  25 => ['401'],
  26 => ['500'],

  /* --- D. tests --- */
  30 => ['getRepositoryToken'],
  31 => ['useValue'],
  32 => ['providers'],
  33 => ['compile'],
  34 => ['beforeEach'],
  35 => ['jest.fn()', 'jest.fn'],
  36 => ['supertest', 'request'],
  37 => ['@Optional()', '@Optional'],

  /* --- E. de memoria --- */
  50 => ['@Controller(\'hotels\')'],
  51 => ['@Get(\':id\')'],
  52 => ['async getHotel(@Param(\'id\', ParseIntPipe) id: number): Promise<Hotel> {'],
  53 => ['@Controller(\'hotels/:hotelId/rooms\')'],
  54 => ['provide: getRepositoryToken(Hotel),'],
  55 => ['service = module.get<HotelService>(HotelService);'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => 'El controller declara <code>@Get(\':id\')</code> antes que <code>@Get(\'search\')</code>. ¿Que devuelve <code>GET /hotels/search</code>?',
    'opciones' => [
      'a' => 'La lista filtrada, Nest prefiere siempre la ruta literal.',
      'b' => 'Entra por <code>:id</code> con <code>id = "search"</code>. Con <code>ParseIntPipe</code> es un 400; con <code>parseInt(id)</code> a pelo es <code>NaN</code> y acaba en un 404 incomprensible.',
      'c' => '405 Method Not Allowed.',
      'd' => 'Un 500.',
    ],
    'correcta' => 'b',
    'porque' => 'Nest registra las rutas en el <b>orden en que estan escritas</b> y gana la primera que encaje. <code>:id</code> es un comodin de un segmento y "search" es un segmento. Regla: literales primero, parametrizadas despues.',
  ],

  'm2' => [
    'texto' => '¿Por que <code>@Get(\':id\')</code> NO se come <code>/bookings/user/5</code>?',
    'opciones' => [
      'a' => 'Porque <code>user</code> esta en la lista de palabras reservadas.',
      'b' => 'Porque <code>:id</code> encaja con <b>un solo segmento</b> y <code>user/5</code> son dos. Por eso el orden no molesta ahi.',
      'c' => 'Porque <code>user</code> va en otro controller.',
      'd' => 'Porque lleva un numero al final.',
    ],
    'correcta' => 'b',
    'porque' => 'El problema del orden solo aparece cuando la ruta literal tiene <b>la misma cantidad de segmentos</b> que la parametrizada. <code>/hotels/search</code> vs <code>/hotels/:id</code>: colision. <code>/bookings/user/5</code> vs <code>/bookings/:id</code>: no.',
  ],

  'm3' => [
    'texto' => '<code>@Param(\'id\', ParseIntPipe)</code> frente a <code>@Param(\'id\') id: string</code> + <code>parseInt(id)</code>:',
    'opciones' => [
      'a' => 'Son equivalentes.',
      'b' => 'El pipe convierte y ademas <b>valida</b>: si no es numerico responde 400 antes de entrar al metodo. <code>parseInt("abc")</code> devuelve <code>NaN</code> en silencio y el <code>NaN</code> viaja hasta la consulta.',
      'c' => '<code>ParseIntPipe</code> solo convierte, no valida.',
      'd' => '<code>parseInt</code> es mas seguro porque no lanza.',
    ],
    'correcta' => 'b',
    'porque' => 'Es el mismo principio que el <code>ValidationPipe</code>: fallar pronto y con un mensaje claro. <code>GET /hotels/abc</code> responde <code>"Validation failed (numeric string is expected)"</code> en vez de un 404 confuso.',
  ],

  'm4' => [
    'texto' => 'El controller de habitaciones es <code>@Controller(\'hotels/:hotelId/rooms\')</code>. ¿Que consigue con eso?',
    'opciones' => [
      'a' => 'Que las habitaciones se guarden en la tabla de hoteles.',
      'b' => 'Rutas anidadas: todas las de este controller cuelgan de un hotel concreto, y <code>@Param(\'hotelId\')</code> esta disponible en cualquiera de sus metodos.',
      'c' => 'Que solo funcione con el hotel 1.',
      'd' => 'Nada, es decorativo.',
    ],
    'correcta' => 'b',
    'porque' => 'Es REST anidado: una habitacion no existe sin hotel. El precio es que <code>GET /hotels/:hotelId/rooms/:id</code> lleva el hotelId aunque el id de la habitacion ya sea unico; por eso <code>getRoom</code> solo usa <code>:id</code>.',
  ],

  'm5' => [
    'texto' => '<code>POST /users/register</code> correcto. ¿Que codigo devuelve Nest sin que le digas nada?',
    'opciones' => [
      'a' => '200',
      'b' => '201: es el <b>unico</b> verbo con un codigo por defecto distinto. El resto (GET, PUT, PATCH, DELETE) responden 200.',
      'c' => '204',
      'd' => '202',
    ],
    'correcta' => 'b',
    'porque' => 'Se cambia con <code>@HttpCode(200)</code>. Caso tipico: el login es un <code>@Post</code> pero no crea nada, asi que muchos le ponen <code>@HttpCode(200)</code>.',
  ],

  'm6' => [
    'texto' => 'El test <code>should create a new hotel</code> usa <code>getRepositoryToken(Hotel)</code>. ¿Que es un "token" en Nest?',
    'opciones' => [
      'a' => 'El JWT de autenticacion.',
      'b' => 'La <b>llave</b> con la que el contenedor de inyeccion guarda y busca cada provider. Para una clase normal el token es la clase; para un repositorio de TypeORM es un símbolo que genera <code>getRepositoryToken(Entidad)</code>.',
      'c' => 'Un identificador unico de cada peticion.',
      'd' => 'El nombre del fichero del provider.',
    ],
    'correcta' => 'b',
    'porque' => 'Por eso el test puede sustituir la base de datos entera por un objeto de <code>jest.fn()</code>: registra un provider con el <b>mismo token</b> pero con <code>useValue</code> distinto. <code>@InjectRepository(Hotel)</code> pide ese token y recibe el mock.',
  ],

  'm7' => [
    'texto' => '¿Por que el <code>beforeEach</code> recrea el <code>mockRepository</code> y el <code>TestingModule</code> en cada test?',
    'opciones' => [
      'a' => 'Por rendimiento.',
      'b' => 'Para que los tests esten aislados: un <code>jest.fn()</code> guarda las llamadas y los valores programados, y si se compartiera, un test podria pasar o fallar segun el orden en que se ejecuten.',
      'c' => 'Porque Nest obliga.',
      'd' => 'Porque el service guarda estado.',
    ],
    'correcta' => 'b',
    'porque' => 'Regla general de tests: ninguno debe depender de otro. Con <code>beforeAll</code> en vez de <code>beforeEach</code> tendrias tests que pasan solos y fallan en conjunto, que es lo peor que te puede pasar.',
  ],

  'm8' => [
    'texto' => 'El test <code>should delete a hotel</code> comprueba <code>expect(mockRepository.delete).toHaveBeenCalledWith(1)</code>. ¿Que pasa si tu implementacion escribe <code>delete({ id })</code>?',
    'opciones' => [
      'a' => 'Pasa igual, porque tambien borra.',
      'b' => 'Falla: el test no comprueba el efecto sino <b>como</b> llamaste al repositorio, y <code>{ id: 1 }</code> no es <code>1</code>.',
      'c' => 'Pasa pero con un aviso.',
      'd' => 'Falla al compilar.',
    ],
    'correcta' => 'b',
    'porque' => 'Es un test de interaccion, no de resultado. Tiene ventaja (no necesitas base de datos) e inconveniente (se rompe si cambias la implementacion aunque el comportamiento sea el mismo).',
  ],

  'm9' => [
    'texto' => 'Los tests unitarios (<code>*.spec.ts</code>) y los e2e (<code>*.e2e-spec.ts</code>) de este proyecto:',
    'opciones' => [
      'a' => 'Se ejecutan los dos con <code>npm test</code>.',
      'b' => '<code>npm test</code> corre solo los <code>.spec.ts</code> de <code>src</code> (la config de jest esta en el <code>package.json</code>, con <code>rootDir: "src"</code>); los e2e van por su cuenta con <code>npm run test:e2e</code> y su <code>test/jest-e2e.json</code>.',
      'c' => 'Los e2e se ejecutan primero.',
      'd' => 'Los e2e son los mismos tests con otro nombre.',
    ],
    'correcta' => 'b',
    'porque' => 'Y la diferencia de fondo: el unitario sustituye el repositorio por un mock y no levanta nada; el e2e levanta la aplicacion entera con base de datos real y habla por HTTP con supertest.',
  ],

  'm10' => [
    'texto' => 'El test e2e escribe <code>expect([400, 201]).toContain(res.status)</code> en vez de <code>.expect(400)</code>. ¿Que significa eso?',
    'opciones' => [
      'a' => 'Que el test esta mal escrito.',
      'b' => 'Que acepta las dos respuestas: son los tests "blandos" que el profe dejo para que no fallaran antes de implementar las validaciones. Un 201 ahi significa que <b>falta</b> una validacion, aunque el test este verde.',
      'c' => 'Que la ruta puede responder cualquiera de los dos por azar.',
      'd' => 'Que hay que elegir uno al entregar.',
    ],
    'correcta' => 'b',
    'porque' => 'Detalle importante para el taller: <b>tests en verde no significa taller terminado</b>. Los unicos estrictos son <code>.expect(400)</code> del rating &gt; 5 y los <code>.expect(200)</code> de las listas.',
  ],

  'm11' => [
    'texto' => '<code>DELETE /bookings/1</code> en este proyecto devuelve la reserva entera, no <code>{ success: true }</code>. ¿Por que?',
    'opciones' => [
      'a' => 'Por consistencia con los otros DELETE.',
      'b' => 'Porque el test e2e comprueba <code>expect(res.body).toHaveProperty(\'status\', \'cancelled\')</code>: cancelar devuelve el nuevo estado del recurso, y <code>{ success: true }</code> no lo llevaria.',
      'c' => 'Porque un DELETE no puede devolver un objeto.',
      'd' => 'Porque <code>cancel()</code> devuelve <code>void</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Leccion transversal: los tests son parte de la <b>especificacion</b>. Antes de implementar un metodo, lee que espera exactamente el test; te esta diciendo la firma y la forma de la respuesta.',
  ],

  'm12' => [
    'texto' => 'Quieres proteger <code>POST /bookings</code> con JWT. ¿Que haces y de donde sale el usuario?',
    'opciones' => [
      'a' => 'Poner <code>@UseGuards(AuthGuard(\'jwt\'))</code> encima del metodo; el usuario llega en <code>req.user</code>, que es lo que devuelve <code>JwtStrategy.validate()</code>.',
      'b' => 'Poner <code>@UseGuards(ValidationPipe)</code>.',
      'c' => 'Leer el header <code>Authorization</code> a mano en el controller.',
      'd' => 'Añadir <code>userId</code> al DTO.',
    ],
    'correcta' => 'a',
    'porque' => 'La cadena: el guard llama a Passport → Passport verifica la firma y la expiracion del token → llama a <code>validate(payload)</code> → lo que devuelvas ahi se guarda en <code>request.user</code>. Por eso <code>validate</code> es el sitio para buscar el usuario en la base de datos.',
  ],

  'm13' => [
    'texto' => 'En el orden del ciclo de vida de una peticion en Nest, ¿que va primero?',
    'opciones' => [
      'a' => 'Pipes, luego guards: primero validas y luego decides si puede pasar.',
      'b' => 'Guards, luego pipes: primero decides si el usuario puede pasar y solo despues validas y transformas el body.',
      'c' => 'Los dos a la vez.',
      'd' => 'Depende del verbo HTTP.',
    ],
    'correcta' => 'b',
    'porque' => 'Middleware → <b>Guards</b> → Interceptors → <b>Pipes</b> → el metodo del controller → Interceptors (vuelta) → Filtros de excepcion. Consecuencia practica: una peticion sin token a una ruta protegida da <b>401</b>, no 400, aunque el body venga mal.',
  ],

  'm14' => [
    'texto' => 'Un <code>findOne</code> devuelve <code>null</code> y tu haces <code>return user;</code> con la firma <code>Promise&lt;User&gt;</code>. Con <code>strictNullChecks: true</code>:',
    'opciones' => [
      'a' => 'No pasa nada, TypeScript confia.',
      'b' => 'Error de tipos <code>TS2322: Type \'User | null\' is not assignable to type \'User\'</code>. O declaras <code>Promise&lt;User | null&gt;</code>, o lanzas un 404 cuando sea null.',
      'c' => 'Error solo al ejecutar.',
      'd' => 'Se convierte a <code>undefined</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Las dos salidas son validas y significan cosas distintas: <code>Promise&lt;User | null&gt;</code> para un buscador interno (el login decide que hacer) y lanzar <code>NotFoundException</code> para lo que responde directamente a una ruta.',
  ],

  'm15' => [
    'texto' => 'En el proyecto, <code>npm test</code> pasa pero <code>npm run build</code> falla con errores de tipos. ¿Como es posible?',
    'opciones' => [
      'a' => 'Porque jest usa otro tsconfig.',
      'b' => 'Porque el <code>tsconfig.json</code> tiene <code>isolatedModules: true</code> y ts-jest se limita a transpilar fichero a fichero, sin comprobar tipos. El chequeo real solo ocurre con <code>tsc</code> / <code>nest build</code>.',
      'c' => 'Porque los tests ignoran la carpeta src.',
      'd' => 'No es posible.',
    ],
    'correcta' => 'b',
    'porque' => 'Por eso el bug de <code>roomId</code> sobrevivia: los tests pasaban. Acostumbrate a correr <code>npx tsc --noEmit</code> antes de entregar: es gratis y encuentra lo que los tests no ven.',
  ],
];

$RETOS = [
  'r1' => [
    'titulo' => 'las cinco rutas de HotelController en el orden correcto (solo los decoradores y las firmas)',
    'huecos' => [15, 16, 18],
    'codigo' => "@Post()
async createHotel(@Body() createHotelDto: CreateHotelDto): Promise<Hotel> {

@Get()
async getAllHotels(): Promise<Hotel[]> {

@Get('search')
async searchHotels(@Query('location') location: string): Promise<Hotel[]> {

@Get('available')
async getAvailableHotels(): Promise<Hotel[]> {

@Get(':id')
async getHotel(@Param('id', ParseIntPipe) id: number): Promise<Hotel> {",
  ],
  'r2' => [
    'titulo' => 'el beforeEach entero de hotel.service.spec.ts',
    'huecos' => [30, 31, 32, 33, 34, 35],
    'codigo' => "beforeEach(async () => {
  mockRepository = {
    create: jest.fn(),
    save: jest.fn(),
    find: jest.fn(),
    findOne: jest.fn(),
    update: jest.fn(),
    delete: jest.fn(),
  };

  const module: TestingModule = await Test.createTestingModule({
    providers: [
      HotelService,
      {
        provide: getRepositoryToken(Hotel),
        useValue: mockRepository,
      },
    ],
  }).compile();

  service = module.get<HotelService>(HotelService);
});",
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Taller Hotel 5 — Rutas, codigos HTTP y tests', 'El orden de las rutas, que responde la API en cada caso y como los tests sustituyen la base de datos');
?>

<div class="card">
  <h2>El ciclo de vida de una peticion</h2>
<pre class="flujo"><code>POST /hotels  { "name": "H", "rating": 6.5 }
  ↓  Middleware
  ↓  Guards          ¿puede pasar este usuario?     -> 401 / 403
  ↓  Interceptors    (antes)
  ↓  Pipes           ValidationPipe · ParseIntPipe  -> 400
  ↓  @Controller     elige el metodo por ruta+verbo -> 404 si no encaja
  ↓  Service         reglas de negocio              -> 409 / 404 / 400
  ↓  Repository      TypeORM -> sqlite              -> 500 si falla
  ↑  Interceptors    (vuelta)
  ↑  Filtros         convierten la excepcion en JSON

Lo importante: los GUARDS van ANTES que los PIPES.
Peticion sin token y con el body mal -> 401, no 400.</code></pre>
</div>

<div class="card">
  <h2>A. Los decoradores del controller</h2>

<pre><code><?php hueco(1, 12); ?>('hotels')
export class HotelController {
  constructor(private readonly hotelService: HotelService) {}

  <?php hueco(2, 9); ?> 
  async createHotel(<?php hueco(6, 9); ?> dto: CreateHotelDto): Promise&lt;Hotel&gt; { ... }

  <?php hueco(3, 8); ?> 
  async getAllHotels(): Promise&lt;Hotel[]&gt; { ... }

  @Get(':id')
  async getHotel(<?php hueco(7, 8); ?>('id', <?php hueco(8, 14); ?>) id: number): Promise&lt;Hotel&gt; { ... }

  <?php hueco(4, 8); ?>(':id')
  async updateHotel(...) { ... }

  <?php hueco(5, 10); ?>(':id')
  async deleteHotel(...) { ... }
}</code></pre>

  <p>Y el de habitaciones lleva el hotel en el propio prefijo:
     <code>@Controller('<?php hueco(9, 24); ?>')</code>, asi que todas sus rutas
     cuelgan de un hotel concreto.</p>

  <?php mc('m3'); mc('m4'); mc('m5'); mc('m13'); ?>
</div>

<div class="card">
  <h2>B. El bug del orden de las rutas</h2>
  <p>Asi venia el controller (fijate en el orden):</p>

<pre><code>@Get('<?php hueco(16, 6); ?>')       // declarada PRIMERO -> se come todo
async getHotel(@Param('id') id: string) {
  return this.hotelService.findOne(parseInt(id));
}

// ...mas abajo
@Get('<?php hueco(15, 9); ?>')    // esta ruta NUNCA se alcanza
async searchHotels(@Query('location') location: string) { ... }</code></pre>

  <p>Al pedir <code>GET /hotels/search</code>, Nest entra por la primera con
     <code>id = "search"</code>, y <code>parseInt("search")</code> devuelve
     <?php hueco(17, 6); ?>. La consulta busca el hotel con ese id, no lo encuentra,
     y sale un 404 que no explica nada.</p>

  <p>La otra ruta literal que hay que subir por encima de <code>:id</code> es
     <code><?php hueco(18, 11); ?></code>, tanto en hoteles como en habitaciones.</p>

  <div class="nota">
    <b>Regla:</b> en un controller, las rutas <b>literales</b> van antes que las
    <b>parametrizadas</b> con el mismo numero de segmentos. Y si necesitas que convivan
    de verdad, restringe el parametro: <code>@Get(':id(\\d+)')</code> solo encaja con digitos.
  </div>

  <?php mc('m1'); mc('m2'); ?>
  <?php reto('r1'); ?>
</div>

<div class="card">
  <h2>C. ¿Que responde la API? (examen)</h2>
  <p>Rellena el codigo HTTP de cada caso, con el proyecto ya corregido.</p>

  <table style="width:100%;border-collapse:collapse;font-size:14.5px">
    <tr style="background:#eef0f3">
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Peticion</th>
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Codigo</th>
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Quien lo decide</th>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>POST /hotels</code> con datos validos</td>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(20, 6); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0">Nest, por defecto en <code>@Post</code></td>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>GET /hotels</code></td>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(21, 6); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0">Nest, por defecto en el resto de verbos</td>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>POST /hotels</code> con <code>rating: 6.5</code></td>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(22, 6); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0">ValidationPipe + <code>@Max(5)</code></td>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>GET /hotels/9999</code></td>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(23, 6); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>HotelService.findOne</code></td>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>POST /users/register</code> con un email ya registrado</td>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(24, 6); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>UserService.create</code></td>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0">Ruta con <code>AuthGuard('jwt')</code> sin token</td>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(25, 6); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0">el guard, <b>antes</b> de los pipes</td>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>PUT /hotels/1</code> con <code>{}</code> (DTO vacio)</td>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(26, 6); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0">TypeORM: <code>UpdateValuesMissingError</code></td>
    </tr>
  </table>

  <div class="nota">
    <b>Los tres casos que mas se confunden:</b><br>
    · <code>POST /bookings</code> con checkOut antes que checkIn → <b>400</b> (regla del service, no del DTO).<br>
    · <code>POST /bookings</code> con fechas que se solapan → <b>400</b>, no 409: el enunciado lo trata como dato invalido.<br>
    · <code>DELETE /bookings/1</code> → <b>200</b> con la reserva en estado <code>cancelled</code>. No borra la fila.
  </div>

  <?php mc('m11'); mc('m12'); ?>
</div>

<div class="card">
  <h2>D. Como los tests sustituyen la base de datos</h2>

<pre><code><?php hueco(34, 11); ?>(async () =&gt; {
  mockRepository = {
    create:  <?php hueco(35, 11); ?>,       // funciones espia, sin implementacion
    save:    jest.fn(),
    find:    jest.fn(),
    findOne: jest.fn(),
    update:  jest.fn(),
    delete:  jest.fn(),
  };

  const module: TestingModule = await Test.createTestingModule({
    <?php hueco(32, 11); ?>: [
      HotelService,
      {
        provide: <?php hueco(30, 20); ?>(Hotel),   // el MISMO token que pide @InjectRepository
        <?php hueco(31, 10); ?>: mockRepository,          // pero con este valor
      },
    ],
  }).<?php hueco(33, 9); ?>();

  service = module.get&lt;HotelService&gt;(HotelService);
});</code></pre>

  <div class="avisoflujo">
    <b>Por que funciona:</b> el service no pide "la base de datos", pide <b>un token</b>.
    En la app ese token lo sirve <code>TypeOrmModule.forFeature([Hotel])</code> con un
    repositorio real; en el test lo sirve un objeto de <code>jest.fn()</code>. El service
    no nota la diferencia. <b>Eso</b> es para lo que sirve la inyeccion de dependencias.
  </div>

  <p>Y cuando un service necesita una dependencia que el test no registra (el caso de
     <code>Repository&lt;Room&gt;</code> dentro de <code>BookingService</code>), se marca con
     <?php hueco(37, 14); ?> para que Nest inyecte <code>undefined</code> en vez de tumbar
     todo el suite.</p>

  <p>Los tests e2e, en cambio, levantan la app entera y hablan por HTTP con la libreria
     <?php hueco(36, 12); ?>.</p>

  <?php mc('m6'); mc('m7'); mc('m8'); mc('m9'); mc('m10'); mc('m14'); mc('m15'); ?>
  <?php reto('r2'); ?>
</div>

<div class="card">
  <h2>E. De memoria: la linea completa</h2>

  <?php linea(50, 'El decorador de clase de HotelController.'); ?>
  <?php linea(53, 'El decorador de clase de RoomController (rutas anidadas bajo un hotel).'); ?>
  <?php linea(51, 'El decorador de la ruta que devuelve un hotel por id.'); ?>
  <?php linea(52, 'La firma completa de <code>getHotel</code>, con el pipe que convierte y valida el id.'); ?>
  <?php linea(54, 'Dentro del array de providers del test: la linea del <code>provide</code> para el repositorio de Hotel.'); ?>
  <?php linea(55, 'Sacar el HotelService del TestingModule ya compilado, en la variable <code>service</code>.'); ?>
</div>

<?php pie('hotel4.php', 'Menu.php'); ?>
