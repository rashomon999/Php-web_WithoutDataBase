<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. CreateUserDto --- */
  1  => ['@IsEmail()', '@IsEmail'],
  2  => ['@MinLength(6)'],
  3  => ['@IsNotEmpty()', '@IsNotEmpty'],
  4  => ['@IsOptional()', '@IsOptional'],
  5  => ['@IsString()', '@IsString'],

  /* --- B. CreateHotelDto --- */
  10 => ['@IsNumber'],
  11 => ['@Min(0)'],
  12 => ['@Max(5)'],
  13 => ['400'],
  14 => ['message'],

  /* --- C. CreateRoomDto --- */
  20 => ['@IsIn'],
  21 => ['@Min(0.01)'],
  22 => ['@IsInt()', '@IsInt'],
  23 => ['@Min(1)'],

  /* --- D. CreateBookingDto --- */
  30 => ['@Type'],
  31 => ['Date'],
  32 => ['@IsDate()', '@IsDate'],
  33 => ['transform'],
  34 => ['@IsDateString()', '@IsDateString'],
  35 => ['class-transformer'],
  36 => ['class-validator'],

  /* --- E. update dto --- */
  40 => ['PartialType'],
  41 => ['@nestjs/mapped-types'],
  42 => ['available'],

  /* --- F. de memoria --- */
  50 => ['@IsEmail()'],
  51 => ['@IsString()'],
  52 => ['@MinLength(6)'],
  53 => ['@IsNumber({ maxDecimalPlaces: 1 })'],
  54 => ['@Min(0)'],
  55 => ['@Max(5)'],
  56 => ['@IsIn([\'single\', \'double\', \'suite\'])'],
  57 => ['@Type(() => Date)'],
  58 => ['@IsOptional()'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => '¿Por que <code>@IsOptional()</code> se pone <b>antes</b> que los demas decoradores del campo?',
    'opciones' => [
      'a' => 'Da igual el orden, los decoradores no tienen orden.',
      'b' => 'Porque marca el campo para que, si no viene (o viene <code>null</code>/<code>undefined</code>), se salten <b>todas</b> las demas validaciones de ese campo.',
      'c' => 'Porque si va despues, el campo se vuelve obligatorio.',
      'd' => 'Porque tiene que ser el mas cercano a la propiedad.',
    ],
    'correcta' => 'b',
    'porque' => 'Sin <code>@IsOptional()</code>, un <code>@IsString()</code> solo ya obliga a mandar el campo: <code>undefined</code> no es un string. Con el, <code>phone</code> puede faltar, pero si viene tiene que ser string.',
  ],

  'm2' => [
    'texto' => '<code>@IsNotEmpty()</code> y <code>@IsString()</code> en el mismo campo, ¿es redundante?',
    'opciones' => [
      'a' => 'Si: <code>@IsString()</code> ya rechaza la cadena vacia.',
      'b' => 'No: <code>@IsString()</code> acepta <code>""</code> perfectamente (es un string). <code>@IsNotEmpty()</code> es el que rechaza la cadena vacia. Y <code>@IsNotEmpty()</code> solo aceptaria un numero.',
      'c' => 'Si, pero se ponen los dos por costumbre.',
      'd' => 'No, porque <code>@IsNotEmpty()</code> solo mira <code>null</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Cada decorador comprueba una sola cosa. <code>{"name": ""}</code> pasa <code>@IsString()</code>; <code>{"name": 5}</code> pasa <code>@IsNotEmpty()</code>. Juntos cubren los dos huecos.',
  ],

  'm3' => [
    'texto' => 'Mandas <code>POST /hotels</code> con <code>{"name":"H","location":"D","city":"C","country":"CO","rating":6.5}</code>. ¿Que responde exactamente?',
    'opciones' => [
      'a' => '<code>422</code> con <code>{ "errors": { "rating": "..." } }</code>',
      'b' => '<code>400</code> con <code>{ "message": ["rating maximo 5"], "error": "Bad Request", "statusCode": 400 }</code>',
      'c' => '<code>400</code> con el texto plano <code>rating maximo 5</code>',
      'd' => '<code>201</code>, porque <code>@Max</code> solo avisa en consola',
    ],
    'correcta' => 'b',
    'porque' => 'El <code>ValidationPipe</code> lanza <code>BadRequestException</code> con un <b>array</b> de mensajes en <code>message</code>. Es array porque puede fallar mas de un campo a la vez.',
  ],

  'm4' => [
    'texto' => 'Con <code>forbidNonWhitelisted: true</code>, mandas <code>PUT /hotels/1</code> con <code>{"nombre":"x"}</code> (en español). ¿Respuesta?',
    'opciones' => [
      'a' => '<code>400</code> con <code>"property nombre should not exist"</code>',
      'b' => '<code>200</code> y no cambia nada, porque <code>nombre</code> se descarta',
      'c' => '<code>500</code>, porque el UPDATE se queda sin valores',
      'd' => '<code>404</code>',
    ],
    'correcta' => 'a',
    'porque' => 'Este es justo el caso que <code>whitelist</code> a secas te oculta: sin <code>forbidNonWhitelisted</code>, el pipe borra <code>nombre</code>, el DTO queda vacio y TypeORM lanza <code>UpdateValuesMissingError</code>: un 500 en vez de un 400 claro.',
  ],

  'm5' => [
    'texto' => '¿Por que la regla "checkOutDate tiene que ser posterior a checkInDate" NO esta en el DTO?',
    'opciones' => [
      'a' => 'Porque las fechas no se pueden comparar en un DTO.',
      'b' => 'Porque los decoradores de class-validator miran un campo a la vez; una regla que relaciona <b>dos</b> campos necesita un validador personalizado, y lo simple es comprobarla en el service.',
      'c' => 'Porque el ValidationPipe se ejecuta despues del service.',
      'd' => 'Porque es una regla de base de datos.',
    ],
    'correcta' => 'b',
    'porque' => 'Se puede hacer en el DTO, pero hay que escribir un <code>@ValidatorConstraint</code> propio o usar <code>@Validate(...)</code>. En el service es una linea: <code>if (checkOut &lt;= checkIn) throw new BadRequestException(...)</code>.',
  ],

  'm6' => [
    'texto' => 'Sin <code>transform: true</code>, ¿que pasa con <code>@Type(() =&gt; Date) @IsDate() checkInDate: Date</code>?',
    'opciones' => [
      'a' => 'Funciona igual, <code>@Type</code> no depende de transform.',
      'b' => 'El campo llega como string, <code>@Type</code> no se aplica y <code>@IsDate()</code> falla <b>siempre</b>: ninguna reserva se podria crear.',
      'c' => 'Falla al arrancar.',
      'd' => 'La fecha llega como <code>NaN</code>.',
    ],
    'correcta' => 'b',
    'porque' => '<code>@Type</code> es de <b>class-transformer</b>, y el pipe solo llama a class-transformer si <code>transform: true</code>. La alternativa sin transform es <code>@IsDateString()</code>, que valida el string tal cual y luego conviertes tu en el service.',
  ],

  'm7' => [
    'texto' => 'Diferencia entre <code>@IsDate()</code> y <code>@IsDateString()</code>:',
    'opciones' => [
      'a' => 'Son sinonimos.',
      'b' => '<code>@IsDate()</code> exige un objeto <code>Date</code> de verdad (necesita <code>@Type</code> + transform); <code>@IsDateString()</code> exige un string en formato ISO 8601.',
      'c' => '<code>@IsDate()</code> acepta cualquier formato y <code>@IsDateString()</code> solo <code>YYYY-MM-DD</code>.',
      'd' => '<code>@IsDateString()</code> convierte el string a Date.',
    ],
    'correcta' => 'b',
    'porque' => 'Regla practica: si usas <code>@IsDateString()</code>, el tipo de la propiedad deberia ser <code>string</code>, no <code>Date</code>, porque eso es lo que vas a recibir.',
  ],

  'm8' => [
    'texto' => '<code>@IsNumber({ maxDecimalPlaces: 1 })</code> en <code>rating</code>. ¿Que rechaza que <code>@IsNumber()</code> a secas dejaria pasar?',
    'opciones' => [
      'a' => 'Los negativos.',
      'b' => '<code>4.55</code> (dos decimales). Un rating de hotel con dos decimales no tiene sentido y ademas la columna es <code>scale: 2</code>.',
      'c' => 'Los numeros mayores que 5.',
      'd' => 'Los strings numericos como <code>"4.5"</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Ojo con el ultimo distractor: con <code>transform: true</code> y sin <code>enableImplicitConversion</code>, <code>"4.5"</code> (string) SI es rechazado por <code>@IsNumber()</code>, porque el pipe no convierte tipos primitivos del body por su cuenta.',
  ],

  'm9' => [
    'texto' => '<code>@Min(0.01)</code> en <code>pricePerNight</code> en vez de <code>@Min(0)</code>:',
    'opciones' => [
      'a' => 'Es lo mismo, <code>0</code> no es un precio valido para <code>@Min(0)</code>.',
      'b' => 'Con <code>@Min(0)</code>, un precio de <code>0</code> pasaria la validacion y crearias habitaciones gratis; <code>@Min(0.01)</code> es el minimo cobrable.',
      'c' => 'Evita los decimales.',
      'd' => 'Es para que funcione con <code>decimal</code>.',
    ],
    'correcta' => 'b',
    'porque' => '<code>@Min(n)</code> es "mayor o igual que n". El enunciado del taller pedia exactamente "min 0.01 para el precio".',
  ],

  'm10' => [
    'texto' => '<code>@IsIn([\'single\', \'double\', \'suite\'])</code>. ¿Que ventaja tiene frente a <code>@IsString()</code> a secas?',
    'opciones' => [
      'a' => 'Ninguna, es mas restrictivo sin motivo.',
      'b' => 'Convierte una convencion que solo vivia en un comentario (<code>// \'single\', \'double\', \'suite\'</code>) en una regla que la API hace cumplir: <code>"penthouse"</code> da 400.',
      'c' => 'Crea un enum en la base de datos.',
      'd' => 'Hace la busqueda mas rapida.',
    ],
    'correcta' => 'b',
    'porque' => 'Un comentario no valida nada. Lo mas robusto seria un <code>enum</code> de TypeScript + <code>@IsEnum(RoomType)</code>, que ademas te da autocompletado.',
  ],

  'm11' => [
    'texto' => '¿Que hace <code>PartialType(CreateRoomDto)</code>?',
    'opciones' => [
      'a' => 'Copia solo la mitad de los campos.',
      'b' => 'Genera una clase con los mismos campos y los mismos validadores, pero añadiendoles <code>@IsOptional()</code> a todos: justo lo que necesita un PATCH/PUT parcial.',
      'c' => 'Quita todos los validadores.',
      'd' => 'Convierte la clase en una interfaz.',
    ],
    'correcta' => 'b',
    'porque' => 'Lo importante es que <b>conserva</b> los validadores: si mandas <code>rating: 9</code> en el update, <code>@Max(5)</code> sigue actuando. Copiar el DTO a mano y olvidarte de un <code>@Max</code> es el error tipico.',
  ],

  'm12' => [
    'texto' => 'En este taller el <code>UpdateRoomDto</code> esta escrito a mano en vez de con <code>PartialType</code>. ¿Por que?',
    'opciones' => [
      'a' => 'Porque <code>PartialType</code> no permite añadir campos nuevos.',
      'b' => 'Porque el <code>package.json</code> pide <code>"@nestjs/mapped-types": "*"</code> y eso instala la version 12, que es solo ESM: jest la intenta cargar con <code>require</code> y revienta con <i>"Must use import to load ES Module"</i>.',
      'c' => 'Porque <code>PartialType</code> no funciona con <code>@IsBoolean</code>.',
      'd' => 'Por gusto del profe.',
    ],
    'correcta' => 'b',
    'porque' => 'Leccion de fondo: <code>"*"</code> como version en el <code>package.json</code> es una bomba de relojeria. Fijar <code>"^2.0.0"</code> tambien lo arreglaria.',
  ],

  'm13' => [
    'texto' => '<code>UpdateRoomDto</code> incluye <code>available</code>, que <code>CreateRoomDto</code> no tiene. ¿Por que?',
    'opciones' => [
      'a' => 'Por simetria con la entidad.',
      'b' => 'Porque al crear la habitacion arranca en <code>true</code> por el <code>default</code> de la entidad, pero al actualizar si quieres poder marcarla como ocupada. Y con <code>forbidNonWhitelisted</code>, si no esta en el DTO, mandarla da 400.',
      'c' => 'Porque <code>available</code> es obligatorio al actualizar.',
      'd' => 'Porque TypeORM lo exige.',
    ],
    'correcta' => 'b',
    'porque' => 'El test e2e manda justo <code>{ pricePerNight: 200, available: false }</code> a <code>PUT /hotels/1/rooms/1</code>. Sin <code>available</code> en el DTO, ese test recibiria un 400.',
  ],

  'm14' => [
    'texto' => '<code>@IsEmail()</code> valida el formato. ¿Valida tambien que el email no este repetido?',
    'opciones' => [
      'a' => 'Si, comprueba la tabla de usuarios.',
      'b' => 'No: un DTO solo mira el contenido de la peticion, no tiene acceso a la base de datos. Lo unico es el <code>findOne</code> del service, que responde 409.',
      'c' => 'Si, si la columna tiene <code>unique: true</code>.',
      'd' => 'Solo con <code>whitelist: true</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Frontera clara: <b>validacion de formato</b> = DTO (400). <b>Reglas de negocio que necesitan consultar datos</b> = service (409, 404, 400 de negocio).',
  ],
];

$RETOS = [
  'r1' => [
    'titulo' => 'el CreateUserDto entero (imports incluidos)',
    'huecos' => [1, 2, 3, 4, 5],
    'codigo' => "import { IsEmail, IsNotEmpty, IsOptional, IsString, MinLength } from 'class-validator';

export class CreateUserDto {
  @IsEmail()
  email: string;

  @IsString()
  @MinLength(6)
  password: string;

  @IsString()
  @IsNotEmpty()
  name: string;

  @IsOptional()
  @IsString()
  phone?: string;
}",
  ],
  'r2' => [
    'titulo' => 'el cuerpo del CreateRoomDto (sin los imports)',
    'huecos' => [20, 21, 22, 23],
    'codigo' => "export class CreateRoomDto {
  @IsString()
  @IsNotEmpty()
  roomNumber: string;

  @IsString()
  @IsIn(['single', 'double', 'suite'])
  type: string;

  @IsNumber({ maxDecimalPlaces: 2 })
  @Min(0.01)
  pricePerNight: number;

  @IsInt()
  @Min(1)
  capacity: number;

  @IsOptional()
  @IsString()
  description?: string;
}",
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Taller Hotel 3 — DTOs y validacion', 'Las 12 validaciones que pedia el taller, y donde acaba el DTO y empieza el service');
?>

<div class="card">
  <h2>La frontera</h2>
  <div class="avisoflujo">
    <b>DTO</b> = ¿tiene <i>forma</i> valida lo que me han mandado? Solo mira el body. Falla con <b>400</b>.<br>
    <b>Service</b> = ¿tiene <i>sentido</i> con lo que hay en la base de datos? Consulta datos. Falla con <b>409</b>, <b>404</b> o un <b>400</b> de negocio.<br>
    <b>Entidad</b> = ¿como es la <i>columna</i>? <code>nullable</code>, <code>unique</code>, <code>default</code>. Falla con un error de base de datos (500 si no lo capturas).
  </div>
  <p>El taller pedia 12 validaciones repartidas en 3 DTOs. Van aqui, mas las del DTO de reservas.</p>
</div>

<div class="card">
  <h2>A. CreateUserDto — 4 validaciones</h2>

<pre><code>export class CreateUserDto {
  <?php hueco(1, 13); ?>                      // rechaza "invalid-email"
  email: string;

  @IsString()
  <?php hueco(2, 16); ?>                  // rechaza "123"
  password: string;

  <?php hueco(5, 14); ?> 
  <?php hueco(3, 16); ?>                  // rechaza ""
  name: string;

  <?php hueco(4, 16); ?>                  // puede no venir...
  @IsString()                             // ...pero si viene, es string
  phone?: string;
}</code></pre>

  <?php mc('m1'); mc('m2'); mc('m14'); ?>
  <?php reto('r1'); ?>
</div>

<div class="card">
  <h2>B. CreateHotelDto — 4 validaciones</h2>

<pre><code>@IsString()
@IsNotEmpty()
name: string;          // lo mismo para location, city y country

<?php hueco(10, 11); ?>({ maxDecimalPlaces: 1 })
<?php hueco(11, 10); ?>                     // ningun rating por debajo de 0
<?php hueco(12, 10); ?>                     // ni por encima de 5
rating: number;</code></pre>

  <p>Con <code>rating: 6.5</code> la API responde <?php hueco(13, 6); ?>, y el array de
     mensajes viene en la propiedad <?php hueco(14, 10); ?> del JSON de error.</p>

  <?php mc('m3'); mc('m4'); mc('m8'); ?>
</div>

<div class="card">
  <h2>C. CreateRoomDto — 4 validaciones</h2>

<pre><code>@IsString()
@IsNotEmpty()
roomNumber: string;

@IsString()
<?php hueco(20, 8); ?>(['single', 'double', 'suite'])   // el comentario se vuelve regla
type: string;

@IsNumber({ maxDecimalPlaces: 2 })
<?php hueco(21, 14); ?>                                  // ni gratis ni negativo
pricePerNight: number;

<?php hueco(22, 11); ?>                                  // 2.5 personas no existen
<?php hueco(23, 11); ?>                                  // al menos una
capacity: number;</code></pre>

  <?php mc('m9'); mc('m10'); ?>
  <?php reto('r2'); ?>
</div>

<div class="card">
  <h2>D. CreateBookingDto: el problema de las fechas</h2>
  <p>El JSON no tiene tipo fecha. <code>checkInDate</code> llega SIEMPRE como string:</p>

<pre><code>{ "roomId": 1, "checkInDate": "2026-06-01T00:00:00.000Z", ... }</code></pre>

<pre><code>@IsInt()
@Min(1)
roomId: number;

<?php hueco(30, 8); ?>(() =&gt; <?php hueco(31, 8); ?>)            // convierte el string en Date
<?php hueco(32, 12); ?>                          // y comprueba que sea una fecha real
checkInDate: Date;</code></pre>

  <p>El decorador <code>@Type</code> es de la libreria <?php hueco(35, 20); ?>, no de
     <?php hueco(36, 18); ?>, y por eso solo se aplica si el <code>ValidationPipe</code>
     lleva la opcion <?php hueco(33, 11); ?>. La alternativa, si no quieres depender de eso,
     es validar el string tal cual con <?php hueco(34, 20); ?> y convertirlo tu en el service.</p>

  <div class="nota">
    La regla <b>checkOut &gt; checkIn</b> no cabe aqui: relaciona dos campos y los decoradores
    normales miran uno solo. Vive en <code>BookingService.create</code>:
    <code>if (checkOutDate &lt;= checkInDate) throw new BadRequestException(...)</code>.
  </div>

  <?php mc('m5'); mc('m6'); mc('m7'); ?>
</div>

<div class="card">
  <h2>E. Los DTOs de actualizacion</h2>
  <p>Lo normal seria <code>export class UpdateHotelDto extends <?php hueco(40, 13); ?>(CreateHotelDto) {}</code>,
     importando esa funcion de <?php hueco(41, 24); ?>.</p>
  <p>El <code>UpdateRoomDto</code> ademas añade un campo que <code>CreateRoomDto</code> no tiene:
     <?php hueco(42, 11); ?>, porque al crear la habitacion arranca en <code>true</code> sola,
     pero al actualizarla si quieres poder cambiarlo.</p>

  <?php mc('m11'); mc('m12'); mc('m13'); ?>
</div>

<div class="card">
  <h2>F. De memoria: el decorador exacto</h2>
  <p>Escribe el decorador completo, con sus parentesis y sus argumentos.</p>

  <?php linea(50, 'El email tiene que ser un correo valido.'); ?>
  <?php linea(51, 'Tiene que ser una cadena de texto.'); ?>
  <?php linea(58, 'Puede no venir; si no viene, no se valida nada mas de este campo.'); ?>
  <?php linea(52, 'La contraseña, minimo 6 caracteres.'); ?>
  <?php linea(53, 'Numero con como mucho 1 decimal (el rating del hotel).'); ?>
  <?php linea(54, 'No puede bajar de 0.'); ?>
  <?php linea(55, 'No puede pasar de 5.'); ?>
  <?php linea(56, 'Solo se admiten esos tres tipos de habitacion.'); ?>
  <?php linea(57, 'Convertir el string del JSON en un objeto Date.'); ?>
</div>

<?php pie('hotel2.php', 'hotel4.php'); ?>
