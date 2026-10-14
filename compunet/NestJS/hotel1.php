<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. el error de arranque --- */
  1  => ['timestamp'],
  2  => ['sqlite'],
  3  => ['DataTypeNotSupportedError'],
  4  => ['datetime'],
  5  => ['@CreateDateColumn()', '@CreateDateColumn'],
  6  => ['arranque', 'bootstrap', 'inicio'],

  /* --- B. main.ts --- */
  10 => ['NestFactory'],
  11 => ['AppModule'],
  12 => ['useGlobalPipes'],
  13 => ['ValidationPipe'],
  14 => ['whitelist'],
  15 => ['forbidNonWhitelisted'],
  16 => ['transform'],
  17 => ['listen'],
  18 => ['3000'],
  19 => ['bootstrap'],

  /* --- C. app.module.ts --- */
  25 => ['@Module'],
  26 => ['imports'],
  27 => ['controllers'],
  28 => ['providers'],
  29 => ['forRoot'],
  30 => ['entities'],
  31 => ['synchronize'],
  32 => ['BookingModule'],
  33 => ['isGlobal'],
  34 => ['404'],

  /* --- D. fases --- */
  40 => ['compilacion', 'compilación'],
  41 => ['arranque'],
  42 => ['peticion', 'petición'],

  /* --- E. de memoria --- */
  50 => ['app.useGlobalPipes(new ValidationPipe({ whitelist: true, forbidNonWhitelisted: true, transform: true }));'],
  51 => ['const app = await NestFactory.create(AppModule);'],
  52 => ['await app.listen(process.env.PORT ?? 3000);'],
  53 => ['@CreateDateColumn()'],
  54 => ['TypeOrmModule.forRoot({'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => 'El profe puso <code>@Column({ type: \'timestamp\' })</code> en las cuatro entidades y la base de datos es sqlite. ¿Cuando te enteras del problema?',
    'opciones' => [
      'a' => 'En <code>npm run build</code>: TypeScript rechaza el string <code>\'timestamp\'</code>.',
      'b' => 'Al arrancar la app, antes de que escuche en el puerto: TypeORM valida los metadatos de las entidades y lanza <code>DataTypeNotSupportedError</code>.',
      'c' => 'En la primera peticion que escriba en la tabla.',
      'd' => 'Nunca: sqlite acepta cualquier tipo porque no tiene tipos estrictos.',
    ],
    'correcta' => 'b',
    'porque' => '<code>\'timestamp\'</code> es un string cualquiera para TypeScript, asi que compila sin problema. TypeORM valida los metadatos al inicializar el DataSource, o sea durante el arranque, y ahi revienta. La app nunca llega a escuchar.',
  ],

  'm2' => [
    'texto' => 'En <code>main.ts</code> estaba <code>import { ValidationPipe } from \'@nestjs/common\';</code> pero nunca se llamaba a <code>useGlobalPipes</code>. ¿Que pasaba al mandar <code>{"email": "no-soy-un-email"}</code>?',
    'opciones' => [
      'a' => 'Respondia 400 igual, porque <code>@IsEmail()</code> valida por su cuenta.',
      'b' => 'Respondia 500, porque el DTO no se pudo construir.',
      'c' => 'Respondia 201 y guardaba el usuario: sin pipe, los decoradores del DTO no se ejecutan nunca.',
      'd' => 'Respondia 422.',
    ],
    'correcta' => 'c',
    'porque' => 'Los decoradores de class-validator solo dejan metadatos anotados en la clase. Quien los lee y decide es el <code>ValidationPipe</code>. Sin el, el DTO es un simple objeto de tipos y todo pasa.',
  ],

  'm3' => [
    'texto' => '<code>booking.module.ts</code> existia, con su controller y su service bien declarados, pero <code>AppModule</code> no lo importaba. ¿Que devolvia <code>POST /bookings</code>?',
    'opciones' => [
      'a' => '404, porque esa ruta nunca se registro.',
      'b' => '500, porque <code>BookingService</code> no se pudo inyectar.',
      'c' => '201, porque Nest descubre los controladores escaneando la carpeta <code>src</code>.',
      'd' => '503, porque el modulo estaba en el disco pero sin arrancar.',
    ],
    'correcta' => 'a',
    'porque' => 'Nest NO escanea carpetas: el arbol de modulos es explicito. Un modulo que nadie importa no forma parte de la aplicacion, asi que su controller nunca registra rutas y Express responde 404. Y lo peor: no sale ningun error en consola.',
  ],

  'm4' => [
    'texto' => '¿Que diferencia hay entre <code>whitelist: true</code> y <code>forbidNonWhitelisted: true</code>?',
    'opciones' => [
      'a' => 'Son sinonimos; el segundo es el nombre nuevo.',
      'b' => '<code>whitelist</code> borra en silencio las propiedades sin decorador; <code>forbidNonWhitelisted</code> ademas responde 400 diciendo cual sobra.',
      'c' => '<code>whitelist</code> responde 400 y <code>forbidNonWhitelisted</code> borra en silencio.',
      'd' => '<code>whitelist</code> afecta al body y <code>forbidNonWhitelisted</code> a los query params.',
    ],
    'correcta' => 'b',
    'porque' => 'Con solo <code>whitelist</code>, mandar <code>{ "nombre": "x" }</code> a un DTO que espera <code>name</code> guarda el registro con el nombre vacio y sin avisar. Con <code>forbidNonWhitelisted</code> responde <code>"property nombre should not exist"</code>, que es lo que quieres mientras desarrollas.',
  ],

  'm5' => [
    'texto' => '¿Por que <code>transform: true</code> es obligatorio en este proyecto y no solo "recomendable"?',
    'opciones' => [
      'a' => 'Porque sin el, <code>whitelist</code> no funciona.',
      'b' => 'Porque <code>CreateBookingDto</code> usa <code>@Type(() => Date)</code>, y esa conversion la hace class-transformer solo cuando transform esta activo. Sin el, las fechas llegan como string y <code>@IsDate()</code> siempre falla.',
      'c' => 'Porque sin el, Nest no sabe a que controller mandar la peticion.',
      'd' => 'Porque convierte la respuesta a JSON.',
    ],
    'correcta' => 'b',
    'porque' => 'El JSON no tiene tipo fecha: <code>checkInDate</code> llega como <code>"2026-06-01T00:00:00.000Z"</code>, un string. <code>transform: true</code> hace que el pipe construya una instancia real del DTO y aplique <code>@Type</code>.',
  ],

  'm6' => [
    'texto' => 'Descomentaste <code>app.useGlobalPipes(...)</code> en <code>main.ts</code> y aun asi el test e2e <code>should fail with invalid rating (&gt; 5)</code> seguia sin dar 400. ¿Por que?',
    'opciones' => [
      'a' => 'Porque los tests e2e usan otra base de datos.',
      'b' => 'Porque <code>@Max(5)</code> no funciona con decimales.',
      'c' => 'Porque los e2e construyen la app con <code>moduleFixture.createNestApplication()</code> y nunca ejecutan <code>main.ts</code>: hay que registrar el pipe tambien dentro del test (o con <code>APP_PIPE</code> en <code>AppModule</code>).',
      'd' => 'Porque supertest no envia el header content-type.',
    ],
    'correcta' => 'c',
    'porque' => '<code>main.ts</code> es solo el arranque de produccion. Por eso cada <code>*.e2e-spec.ts</code> traia su propia linea <code>app.useGlobalPipes(...)</code> comentada con un TODO: habia que descomentarla. La alternativa que si se hereda es <code>{ provide: APP_PIPE, useClass: ValidationPipe }</code> en <code>app.module.ts</code>.',
  ],

  'm7' => [
    'texto' => '<code>synchronize: true</code> en <code>TypeOrmModule.forRoot</code>:',
    'opciones' => [
      'a' => 'Sincroniza las peticiones para que no haya condiciones de carrera.',
      'b' => 'Ajusta el esquema de la base de datos a las entidades en cada arranque. Comodo en desarrollo, destructivo en produccion.',
      'c' => 'Hace que todas las consultas sean sincronas.',
      'd' => 'Replica la base de datos en un segundo servidor.',
    ],
    'correcta' => 'b',
    'porque' => 'Si renombras una propiedad de la entidad, TypeORM borra la columna vieja y crea la nueva: con ella, los datos. En produccion se pone en false y se usan migraciones.',
  ],

  'm8' => [
    'texto' => 'Borras <code>database.sqlite</code> y vuelves a arrancar. ¿Que pasa?',
    'opciones' => [
      'a' => 'La app no arranca hasta que ejecutes una migracion.',
      'b' => 'Arranca y, gracias a <code>synchronize: true</code>, TypeORM vuelve a crear las tablas vacias a partir de las entidades.',
      'c' => 'Arranca pero todas las consultas dan 500.',
      'd' => 'Nada, porque sqlite guarda los datos en memoria.',
    ],
    'correcta' => 'b',
    'porque' => 'El fichero <code>database.sqlite</code> ES la base de datos. Borrarlo es empezar de cero; <code>synchronize</code> recrea el esquema, no los datos.',
  ],

  'm9' => [
    'texto' => 'Clasifica: escribes <code>this.hotelsRepositori.find()</code> (con i latina).',
    'opciones' => [
      'a' => 'Error de compilacion: lo ve <code>tsc</code> / <code>nest build</code> antes de ejecutar nada.',
      'b' => 'Error de arranque.',
      'c' => 'Error de peticion: solo salta cuando alguien llama al endpoint.',
      'd' => 'No es un error, JavaScript crea la propiedad sola.',
    ],
    'correcta' => 'a',
    'porque' => 'Una propiedad que no existe en la clase es un error de tipos. Ojo: en este proyecto <code>npm test</code> NO lo detecta, porque el <code>tsconfig.json</code> tiene <code>isolatedModules: true</code> y ts-jest solo transpila. Se ve con <code>npx tsc --noEmit</code> o <code>npm run build</code>.',
  ],

  'm10' => [
    'texto' => 'Clasifica: pones <code>@InjectRepository(Room)</code> en <code>BookingService</code> pero <code>BookingModule</code> hace <code>forFeature([Booking])</code> sin Room.',
    'opciones' => [
      'a' => 'Error de compilacion.',
      'b' => 'Error de arranque: Nest no puede construir el arbol de dependencias y lanza <code>Nest can\'t resolve dependencies of the BookingService</code>.',
      'c' => 'Error de peticion, en el primer <code>POST /bookings</code>.',
      'd' => 'Ningun error: Nest inyecta <code>undefined</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'El contenedor de inyeccion se resuelve al arrancar, no al recibir la peticion. TypeScript no sabe nada de tokens de DI, asi que compila perfectamente. (Inyecta <code>undefined</code> solo si añades <code>@Optional()</code>.)',
  ],

  'm11' => [
    'texto' => 'En <code>await app.listen(process.env.PORT ?? 3000)</code>, ¿por que <code>??</code> y no <code>||</code>?',
    'opciones' => [
      'a' => 'Son equivalentes, <code>??</code> es solo mas moderno.',
      'b' => 'Porque <code>??</code> solo cae al valor por defecto si es <code>null</code> o <code>undefined</code>; <code>||</code> tambien lo haria con <code>""</code> o <code>0</code>, que son valores validos en otros contextos.',
      'c' => 'Porque <code>||</code> no funciona con variables de entorno.',
      'd' => 'Porque <code>??</code> convierte el string a numero.',
    ],
    'correcta' => 'b',
    'porque' => 'La diferencia es falsy vs nullish. Y ojo con el error clasico del otro repo del profe: <code>|</code> (una sola barra) no es "o", es OR a nivel de bits: <code>\'3600\' | 600</code> da <code>3672</code>.',
  ],

  'm12' => [
    'texto' => 'El array <code>entities: [__dirname + \'/**/*.entity{.ts,.js}\']</code> incluye <code>.ts</code> y <code>.js</code>. ¿Por que los dos?',
    'opciones' => [
      'a' => 'Por si acaso alguien escribe una entidad en JavaScript puro.',
      'b' => 'Porque en desarrollo con ts-node los ficheros son <code>.ts</code> y en produccion, despues de <code>nest build</code>, son <code>.js</code> dentro de <code>dist/</code>.',
      'c' => 'Porque TypeORM necesita leer el codigo fuente y el compilado a la vez.',
      'd' => 'Es un error del profe: sobra el <code>.ts</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'El mismo patron sirve en los dos modos. La alternativa, mas segura, es importar las clases a mano: <code>entities: [User, Hotel, Room, Booking]</code>, que ademas falla en compilacion si borras una.',
  ],
];

$RETOS = [
  'r1' => [
    'titulo' => 'la funcion bootstrap() completa de main.ts',
    'huecos' => [10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
    'codigo' => "async function bootstrap() {
  const app = await NestFactory.create(AppModule);
  app.useGlobalPipes(
    new ValidationPipe({
      whitelist: true,
      forbidNonWhitelisted: true,
      transform: true,
    }),
  );
  await app.listen(process.env.PORT ?? 3000);
}
bootstrap();",
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Taller Hotel 1 — El arranque roto', 'main.ts, app.module.ts y los tres bugs que impiden que la API funcione');
?>

<div class="card">
  <h2>Antes de empezar</h2>
  <p>Este cuestionario va sobre el taller <code>taller_hotel_2h_nest_2025B</code>: una API de hoteles con
     <b>User</b>, <b>Hotel</b>, <b>Room</b> y <b>Booking</b>, con bugs metidos a proposito.
     Aqui se trata el bloque que <b>impide que la aplicacion funcione siquiera</b>.</p>
  <div class="nota">
    Los tres problemas de esta pagina tienen algo en comun: <b>ninguno lo detecta TypeScript</b>.
    El codigo compila perfecto. Uno revienta al arrancar, otro hace que un modulo entero no exista
    y otro deja las validaciones como decoracion muerta.
  </div>
</div>

<div class="card">
  <h2>A. El bug que no deja ni arrancar</h2>
  <p>Las cuatro entidades traian esta columna:</p>
<pre><code>@Column({ type: 'timestamp', default: () =&gt; 'CURRENT_TIMESTAMP' })
createdAt: Date;</code></pre>

  <p>Y al hacer <code>npm run start:dev</code> salia esto, <b>antes</b> de que la app escuchara en el puerto:</p>
<pre><code><?php hueco(3, 26); ?>: Data type "<?php hueco(1, 11); ?>" in "Hotel.createdAt"
is not supported by "<?php hueco(2, 8); ?>" database.</code></pre>

  <p>El tipo <code>timestamp</code> existe en Postgres y en MySQL. En sqlite el tipo equivalente
     se llama <?php hueco(4, 10); ?>. Pero lo portable es no elegir el tipo a mano y dejar que
     TypeORM decida por cada motor, con el decorador <?php hueco(5, 22); ?>, que ademas rellena
     la fecha solo al insertar (asi que sobra el <code>default</code>).</p>

  <p>Es un error de <?php hueco(6, 12); ?>: TypeScript no lo ve porque <code>'timestamp'</code> es
     un string valido, y no depende de ninguna peticion porque salta cuando TypeORM valida los
     metadatos de las entidades.</p>

  <?php mc('m1'); mc('m9'); mc('m10'); ?>
</div>

<div class="card">
  <h2>B. main.ts: el ValidationPipe fantasma</h2>
  <p>Asi venia el fichero. Fijate que <code>ValidationPipe</code> esta <b>importado</b> arriba
     y no aparece por ningun lado dentro de la funcion. Completa la version corregida:</p>

<pre><code>import { <?php hueco(10, 13); ?> } from '@nestjs/core';
import { <?php hueco(11, 11); ?> } from './app.module';
import { ValidationPipe } from '@nestjs/common';

async function <?php hueco(19, 11); ?>() {
  const app = await NestFactory.create(AppModule);

  app.<?php hueco(12, 16); ?>(
    new <?php hueco(13, 16); ?>({
      <?php hueco(14, 11); ?>: true,             // borra lo que no tenga decorador
      <?php hueco(15, 21); ?>: true,   // y ademas responde 400
      <?php hueco(16, 11); ?>: true,             // construye la instancia del DTO
    }),
  );

  await app.<?php hueco(17, 8); ?>(process.env.PORT ?? <?php hueco(18, 6); ?>);
}
bootstrap();</code></pre>

  <div class="avisoflujo">
    <b>La cadena completa:</b> el decorador <code>@IsEmail()</code> no valida nada por si mismo;
    solo deja un metadato en la clase. El <code>ValidationPipe</code> es quien lee esos metadatos
    y llama a <code>class-validator</code>. Si el pipe no esta registrado, la cadena se rompe en el
    primer eslabon y <b>todos</b> los decoradores de <b>todos</b> los DTOs son adorno.
  </div>

  <?php mc('m2'); mc('m4'); mc('m5'); mc('m6'); mc('m11'); ?>

  <?php reto('r1'); ?>
</div>

<div class="card">
  <h2>C. app.module.ts: el modulo que nadie importaba</h2>

<pre><code><?php hueco(25, 9); ?>({
  <?php hueco(26, 9); ?>: [
    ConfigModule.forRoot({ <?php hueco(33, 10); ?>: true }),
    TypeOrmModule.<?php hueco(29, 9); ?>({
      type: 'sqlite',
      database: 'database.sqlite',
      <?php hueco(30, 10); ?>: [__dirname + '/**/*.entity{.ts,.js}'],
      <?php hueco(31, 13); ?>: true,
    }),
    UserModule,
    HotelModule,
    RoomModule,
    <?php hueco(32, 15); ?>,          // &lt;-- esta linea faltaba
    AuthModule,
    PassportModule.register({ defaultStrategy: 'jwt' }),
  ],
  <?php hueco(27, 13); ?>: [AppController],
  <?php hueco(28, 11); ?>: [AppService],
})
export class AppModule {}</code></pre>

  <p>Sin esa linea, todas las rutas de <code>/bookings</code> respondian <?php hueco(34, 6); ?>,
     <b>y no aparecia ningun error en la consola</b>. Ese es el peligro: un fallo silencioso.</p>

  <div class="nota">
    Nest <b>no escanea carpetas</b>. El arbol de modulos es explicito y empieza en <code>AppModule</code>.
    Si un modulo no esta importado (ni directamente, ni por otro modulo que si lo este), para la
    aplicacion <b>no existe</b>: ni sus controllers, ni sus providers, ni sus entidades.
  </div>

  <?php mc('m3'); mc('m7'); mc('m8'); mc('m12'); ?>
</div>

<div class="card">
  <h2>D. Las tres fases donde puede fallar algo</h2>
  <p>Saber en que fase falla algo es media respuesta. Rellena el nombre de cada fase:</p>

  <table style="width:100%;border-collapse:collapse;font-size:14.5px">
    <tr style="background:#eef0f3">
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Fase</th>
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Quien lo detecta</th>
      <th style="text-align:left;padding:8px;border:1px solid #d8dbe0">Ejemplo de este taller</th>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(40, 13); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>tsc</code> / <code>nest build</code></td>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>roomId</code> no existe en <code>DeepPartial&lt;Booking&gt;</code></td>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(41, 13); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0">Nest + TypeORM, al crear la app</td>
      <td style="padding:8px;border:1px solid #d8dbe0"><code>DataTypeNotSupportedError</code>, <code>can't resolve dependencies</code></td>
    </tr>
    <tr>
      <td style="padding:8px;border:1px solid #d8dbe0"><?php hueco(42, 13); ?></td>
      <td style="padding:8px;border:1px solid #d8dbe0">El cliente, en la respuesta HTTP</td>
      <td style="padding:8px;border:1px solid #d8dbe0">400 de validacion, 404 de <code>findOne</code>, 409 de email repetido</td>
    </tr>
  </table>

  <div class="nota">
    Y hay una cuarta categoria, la peor: el <b>fallo silencioso</b>. No hay excepcion, no hay log,
    la respuesta es 200 o 201. En este taller son dos: el <code>BookingModule</code> sin importar
    (404 sin explicacion) y el <code>ValidationPipe</code> sin registrar (201 con datos basura).
  </div>
</div>

<div class="card">
  <h2>E. De memoria: la linea completa</h2>
  <p>Sin mirar arriba. Se ignoran los espacios, el tipo de comillas y el punto y coma final.</p>

  <?php linea(51, 'Crear la aplicacion Nest a partir de <b>AppModule</b>, en una constante <code>app</code>.'); ?>
  <?php linea(50, 'Registrar el ValidationPipe global con las <b>tres</b> opciones, todo en una sola linea.'); ?>
  <?php linea(52, 'Poner la app a escuchar en el puerto del entorno, o en el 3000 si no hay ninguno.'); ?>
  <?php linea(53, 'El decorador que sustituye a <code>@Column({ type: \'timestamp\' })</code> para la fecha de creacion.'); ?>
  <?php linea(54, 'La primera linea de la configuracion de TypeORM dentro de <code>imports</code> (con la llave abierta).'); ?>
</div>

<?php pie('Menu.php', 'hotel2.php'); ?>
