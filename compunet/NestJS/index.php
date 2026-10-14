<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 1 — Panorama, arranque y configuracion
   Repo: icesi-2026b-nestjs (car-dealershop)
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A. main.ts --- */
    1  => 'NestFactory',
    2  => 'create',
    3  => 'useGlobalPipes',
    4  => 'ValidationPipe',
    5  => 'whitelist',
    6  => 'forbidNonWhitelisted',
    7  => 'listen',
    8  => 'PORT',
    9  => '3000',
    10 => 'bootstrap',
    11 => 'async function bootstrap() {',
    12 => '@nestjs/core',
    13 => '@nestjs/common',
    14 => ['express', 'platform-express', '@nestjs/platform-express'],
    15 => ['fastify', 'platform-fastify', '@nestjs/platform-fastify'],
    66 => 'express',
    67 => 'DB_HOST',
    68 => 'DB_PORT',
    69 => 'NestFactory',

    /* --- B. app.module.ts --- */
    16 => 'Module',
    17 => 'imports',
    18 => 'forRoot',
    19 => 'isGlobal',
    20 => 'postgres',
    21 => 'synchronize',
    22 => 'autoLoadEntities',
    23 => 'controllers',
    24 => 'providers',
    25 => 'AppModule',
    26 => 'ConfigModule',
    27 => 'TypeOrmModule',
    28 => 'DB_HOST',
    29 => 'parseInt',

    /* --- C. package.json / CLI --- */
    30 => '--watch',
    31 => ['node dist/main', 'dist/main'],
    32 => 'jest',
    33 => 'oxlint',
    34 => ['nest build', 'build'],
    35 => ['nest g resource cars', 'nest generate resource cars'],
    36 => 'pnpm',

    /* --- D. docker-compose y variables de entorno --- */
    37 => 'postgres',
    38 => 'POSTGRES_PASSWORD',
    39 => 'POSTGRES_DB',
    40 => '5432',
    41 => '8888',
    42 => 'DB_PORT',
    43 => 'DB_NAME',
    44 => 'DB_USER',
    45 => 'DB_PASSWORD',
    46 => 'JWT_SECRET',
    47 => 'JWT_EXPIRES_IN',

    /* --- E. tsconfig --- */
    48 => 'experimentalDecorators',
    49 => 'emitDecoratorMetadata',
    50 => 'strictPropertyInitialization',

    /* --- F. Recorrido de arranque --- */
    51 => 'main.ts',
    52 => 'bootstrap',
    53 => 'NestFactory.create',
    54 => 'AppModule',
    55 => ['.env', 'env'],
    56 => 'TypeOrmModule',
    57 => 'synchronize',
    58 => ['controller', 'controllers', '@Controller'],
    59 => 'listen',

    /* --- G. lineas completas de memoria --- */
    60 => 'const app = await NestFactory.create(AppModule);',
    61 => 'app.useGlobalPipes(new ValidationPipe({whitelist: true, forbidNonWhitelisted: true}));',
    62 => 'await app.listen(process.env.PORT ?? 3000);',
    63 => 'ConfigModule.forRoot({isGlobal: true}),',
    64 => 'export class AppModule {}',
    65 => 'bootstrap();',

    /* --- CLI: crear la estructura --- */
    70 => ['new', 'n'],
    71 => ['module', 'mo'],
    72 => ['controller', 'co'],
    73 => ['service', 's'],
    74 => ['resource', 'res'],
    75 => 'app.module.ts',
    76 => 'user.module.ts',
    77 => 'user.module.ts',
    78 => 'app.module.ts',
    79 => 'app.controller.ts',
    80 => 'app.service.ts',
    81 => 'no-spec',
    82 => '@nestjs/cli',
    83 => 'nest g module user',
    84 => 'nest g controller user',
    85 => 'nest g service user',
    86 => 'nest g resource user',
    87 => 'nest new car-dealershop',
];

$RETOS = [

'main' => [
    'titulo' => '<code>main.ts</code>',
    'huecos' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 69],
    'codigo' => <<<'EOT'
import { NestFactory } from '@nestjs/core';
import { AppModule } from './app.module';
import { ValidationPipe } from '@nestjs/common';

async function bootstrap() {
  const app = await NestFactory.create(AppModule);
  app.useGlobalPipes(
    new ValidationPipe({
      whitelist: true,
      forbidNonWhitelisted: true,
    })
  );
  await app.listen(process.env.PORT ?? 3000);
}
bootstrap();
EOT
],

'appmodule' => [
    'titulo' => '<code>app.module.ts</code>',
    'huecos' => [16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29],
    'codigo' => <<<'EOT'
import { Module } from '@nestjs/common';
import { AppController } from './app.controller';
import { AppService } from './app.service';
import { CarsModule } from './cars/cars.module';
import { BrandsModule } from './brands/brands.module';
import { ConfigModule } from '@nestjs/config';
import { TypeOrmModule } from '@nestjs/typeorm';
import { UserModule } from './user/user.module';
import { AuthModule } from './auth/auth.module';

@Module({
  imports: [
    ConfigModule.forRoot({isGlobal: true}),
    TypeOrmModule.forRoot({
      type: 'postgres',
      host: process.env.DB_HOST,
      port: parseInt(process.env.DB_PORT|| '5432'),
      database: process.env.DB_NAME,
      username: process.env.DB_USER,
      password: process.env.DB_PASSWORD,
      synchronize: true,
      autoLoadEntities: true
    }),
    CarsModule, BrandsModule, UserModule, AuthModule],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Que es NestJS respecto a Express?',
        'opciones' => [
            'a' => 'Un reemplazo total: Nest no usa Express ni nada parecido por debajo.',
            'b' => 'Un framework con arquitectura opinionada (modulos, controllers, services, inyeccion de dependencias, decoradores) que por defecto corre <b>encima</b> de Express.',
            'c' => 'Una libreria de base de datos.',
            'd' => 'Lo mismo que Express pero con otro nombre.',
        ],
        'correcta' => 'b',
        'porque'   => 'Express te da rutas y middlewares y ya; tu decides como organizar todo. Nest impone una estructura (la de Angular, pero en backend) y usa Express (o Fastify) como motor HTTP. En este repo esta <code>@nestjs/platform-express</code> en el <code>package.json</code>.',
    ],
    'm2' => [
        'texto'    => 'En <code>main.ts</code>, ¿que pasaria si <b>quitas</b> el <code>app.useGlobalPipes(new ValidationPipe(...))</code> pero dejas los DTOs con <code>@IsString()</code>, <code>@Length()</code>...?',
        'opciones' => [
            'a' => 'Nada cambia: los decoradores de class-validator se ejecutan solos.',
            'b' => 'La app no compila.',
            'c' => 'Los decoradores quedan como simple metadata: <b>nadie los ejecuta</b>, asi que entra cualquier body sin validar.',
            'd' => 'Nest usa un ValidationPipe por defecto igual.',
        ],
        'correcta' => 'c',
        'porque'   => 'Los decoradores de <code>class-validator</code> solo <i>describen</i> reglas. Quien las aplica es el <code>ValidationPipe</code>. Sin el pipe (global, o puesto con <code>@UsePipes</code>) el DTO es una clase decorativa.',
    ],
    'm3' => [
        'texto'    => '<code>whitelist: true</code> y <code>forbidNonWhitelisted: true</code> juntos, ante un body con una propiedad que <b>no esta en el DTO</b>:',
        'opciones' => [
            'a' => 'Ignoran la propiedad extra y siguen sin avisar.',
            'b' => 'Aceptan la propiedad y la guardan.',
            'c' => 'Responden <code>500</code>.',
            'd' => 'Rechazan la peticion con <code>400 Bad Request</code> diciendo que la propiedad no deberia existir.',
        ],
        'correcta' => 'd',
        'porque'   => '<code>whitelist</code> a secas <b>elimina</b> en silencio lo que no este en el DTO. Al añadir <code>forbidNonWhitelisted</code>, en vez de eliminar, lanza el error (<code>property xxx should not exist</code>).',
    ],
    'm4' => [
        'texto'    => '¿Que hace <code>isGlobal: true</code> en <code>ConfigModule.forRoot({isGlobal: true})</code>?',
        'opciones' => [
            'a' => 'Hace que el <code>ConfigService</code> se pueda inyectar en cualquier modulo sin tener que importar <code>ConfigModule</code> en cada uno.',
            'b' => 'Sube las variables de entorno a internet.',
            'c' => 'Permite que la app corra en varios puertos a la vez.',
            'd' => 'Convierte todos los modulos en singletons.',
        ],
        'correcta' => 'a',
        'porque'   => 'Un modulo global exporta sus providers a toda la app. Ojo: en <code>auth.module.ts</code> el profe vuelve a llamar <code>ConfigModule.forRoot({isGlobal: true})</code>; es redundante (con el de <code>app.module.ts</code> bastaba).',
    ],
    'm5' => [
        'texto'    => '<code>synchronize: true</code> en <code>TypeOrmModule.forRoot</code>. ¿Que hace y por que es peligroso en produccion?',
        'opciones' => [
            'a' => 'Sincroniza la hora del servidor con la del cliente.',
            'b' => 'Al arrancar compara las entidades con la BD y <b>crea/modifica tablas y columnas solo</b>. En produccion puede alterar o borrar columnas y datos; alli se usan migraciones.',
            'c' => 'Hace que las consultas sean sincronas.',
            'd' => 'Sincroniza dos bases de datos entre si.',
        ],
        'correcta' => 'b',
        'porque'   => 'Comodo en clase (cambias una entidad y la tabla se actualiza). Peligroso en produccion: un cambio de nombre o de tipo puede provocar perdida de datos. Lo profesional son las <b>migraciones</b>.',
    ],
    'm6' => [
        'texto'    => '¿Para que sirve <code>autoLoadEntities: true</code>?',
        'opciones' => [
            'a' => 'Para cargar automaticamente datos de prueba.',
            'b' => 'Para que TypeORM cargue solo las entidades que cada modulo registre con <code>TypeOrmModule.forFeature([...])</code>, sin listarlas todas en <code>forRoot</code>.',
            'c' => 'Para que las entidades se guarden en cache.',
            'd' => 'Para cargar las entidades desde el <code>.env</code>.',
        ],
        'correcta' => 'b',
        'porque'   => 'Asi cada modulo declara sus propias entidades (<code>forFeature([Car])</code>, <code>forFeature([Brand])</code>...) y <code>app.module.ts</code> no tiene que conocerlas.',
    ],
    'm7' => [
        'texto'    => 'El contenedor de Postgres esta apagado y haces <code>pnpm run start:dev</code>. ¿Que ocurre?',
        'opciones' => [
            'a' => 'La app arranca y las rutas responden 404.',
            'b' => 'La app arranca y crea la BD en memoria.',
            'c' => 'TypeORM no puede conectar (algo como <code>ECONNREFUSED</code>), reintenta y la app <b>no termina de arrancar</b>.',
            'd' => 'Nest arranca un Postgres por su cuenta.',
        ],
        'correcta' => 'c',
        'porque'   => 'La conexion se abre durante el arranque, cuando se construye <code>TypeOrmModule</code>. Si la BD no esta, el modulo no se inicializa y <code>listen</code> nunca llega a abrir el puerto. Primero <code>docker compose up -d</code>.',
    ],
    'm8' => [
        'texto'    => 'Sobre <code>emitDecoratorMetadata</code> y <code>experimentalDecorators</code> en <code>tsconfig.json</code>:',
        'opciones' => [
            'a' => 'Son opcionales: Nest funciona igual sin ellos.',
            'b' => 'Solo sirven para el linter.',
            'c' => 'Sirven para acelerar la compilacion.',
            'd' => 'Sin ellos no funcionan los decoradores ni la <b>inyeccion de dependencias</b>: TypeScript no emitiria los tipos del constructor y Nest no sabria que inyectar.',
        ],
        'correcta' => 'd',
        'porque'   => 'Cuando escribes <code>constructor(private readonly carService: CarsService)</code>, TypeScript deja en tiempo de ejecucion el tipo <code>CarsService</code> gracias a <code>emitDecoratorMetadata</code>. Nest lee ese metadato y sabe que debe inyectar ese provider.',
    ],
    'm9' => [
        'texto'    => '¿Por que las entidades pueden declarar <code>id: string;</code> sin inicializarlo, sin error de TypeScript?',
        'opciones' => [
            'a' => 'Porque <code>strictPropertyInitialization</code> esta en <code>false</code> en el <code>tsconfig.json</code>.',
            'b' => 'Porque <code>strict</code> esta en <code>false</code>.',
            'c' => 'Porque Nest inicializa las propiedades por ti.',
            'd' => 'Porque TypeORM reescribe el codigo al compilar.',
        ],
        'correcta' => 'a',
        'porque'   => 'En el repo <code>strict</code> es <code>true</code> pero se apaga solo esa regla concreta. Con la regla activa TS exigiria un valor inicial o un constructor. Las entidades y DTOs las rellena TypeORM/class-transformer en ejecucion.',
    ],
    'm10' => [
        'texto'    => '¿Que hace <code>nest g resource cars</code>?',
        'opciones' => [
            'a' => 'Crea la base de datos <code>cars</code>.',
            'b' => 'Genera el andamiaje del recurso: <b>modulo, controller, service, DTOs, entidad y specs</b>, y registra el modulo en <code>app.module.ts</code>.',
            'c' => 'Descarga una libreria llamada cars.',
            'd' => 'Ejecuta los tests de cars.',
        ],
        'correcta' => 'b',
        'porque'   => 'Es el generador del CLI (<code>@nestjs/schematics</code>). Por eso <code>brands</code>, <code>cars</code> y <code>user</code> tienen todos la misma estructura de carpetas: <code>dto/</code>, <code>entities/</code>, <code>*.controller.ts</code>, <code>*.service.ts</code>, <code>*.module.ts</code>.',
    ],
    'm11' => [
        'texto'    => 'En <code>main.ts</code>, ¿por que <code>bootstrap</code> es una funcion <code>async</code> y se usa <code>await</code> en <code>create</code> y en <code>listen</code>?',
        'opciones' => [
            'a' => 'Es solo estilo, no cambia nada.',
            'b' => 'Porque crear la app (construir modulos, conectar a la BD) y abrir el puerto son operaciones asincronas que devuelven <code>Promise</code>.',
            'c' => 'Porque Express lo exige.',
            'd' => 'Para que la app corra en un hilo aparte.',
        ],
        'correcta' => 'b',
        'porque'   => '<code>NestFactory.create</code> devuelve una <code>Promise</code> (inicializa providers, conexiones, etc.) y <code>listen</code> tambien. <code>await</code> garantiza ese orden.',
    ],
    'm12' => [
        'texto'    => 'Ejecutas <code>nest g module user</code>, luego <code>nest g controller user</code> y <code>nest g service user</code>. ¿Que archivos se <b>modifican</b> (UPDATE) ademas de crearse los nuevos?',
        'opciones' => [
            'a' => 'Ninguno, solo se crean archivos.',
            'b' => 'Siempre <code>main.ts</code>.',
            'c' => '<code>app.module.ts</code> (importa <code>UserModule</code>) y luego <code>user.module.ts</code> dos veces (añade el controller a <code>controllers</code> y el service a <code>providers</code>).',
            'd' => 'Solo <code>package.json</code>.',
        ],
        'correcta' => 'c',
        'porque'   => 'Es exactamente lo que se ve en el video: <code>UPDATE src/app.module.ts</code> tras el modulo, y <code>UPDATE src/user/user.module.ts</code> tras el controller y tras el service. El CLI <b>registra por ti</b> lo que crea en el modulo mas cercano.',
    ],
    'm13' => [
        'texto'    => '¿Que diferencia hay entre <code>nest g controller user</code> y <code>nest g resource user</code>?',
        'opciones' => [
            'a' => 'Ninguna.',
            'b' => '<code>controller</code> crea <b>solo</b> un controller casi vacio (<code>@Controller(\'user\')</code> y una clase sin metodos). <code>resource</code> crea de golpe modulo + controller + service + DTOs + entidad, con los <b>cinco metodos del CRUD</b> ya escritos como andamiaje.',
            'c' => '<code>resource</code> solo crea la base de datos.',
            'd' => '<code>controller</code> crea tambien el servicio.',
        ],
        'correcta' => 'b',
        'porque'   => 'Los metodos de <code>resource</code> devuelven textos como <code>This action returns all user</code>; de ahi vienen los <code>return `This action updates a #${id} user`</code> que se ven en <code>UserService</code> y que el profe no reemplazo (ver cuestionario 9).',
    ],
    'm14' => [
        'texto'    => 'Ejecutas <code>nest g controller user</code> <b>antes</b> de crear el modulo <code>user</code>. ¿Donde lo registra el CLI?',
        'opciones' => [
            'a' => 'En el <b>modulo mas cercano</b> que encuentre hacia arriba: como aun no existe <code>user.module.ts</code>, lo añade a <code>app.module.ts</code>. Por eso conviene crear primero el modulo.',
            'b' => 'Da error y no crea nada.',
            'c' => 'Crea el modulo por su cuenta.',
            'd' => 'En <code>main.ts</code>.',
        ],
        'correcta' => 'a',
        'porque'   => 'Orden recomendado: <code>module</code> &rarr; <code>controller</code> &rarr; <code>service</code>. Si te equivocas, mueve el controller a <code>user.module.ts</code> a mano.',
    ],
    'm15' => [
        'texto'    => 'Al crear un proyecto con <code>nest new</code>, ¿que trae ya el <b>proyecto inicial</b>?',
        'opciones' => [
            'a' => 'Solo <code>main.ts</code>.',
            'b' => 'Un modulo raiz <code>AppModule</code> con un <code>AppController</code> (un <code>GET /</code> que responde "Hello World!") y un <code>AppService</code>, mas <code>main.ts</code>, tsconfig, tests, etc.',
            'c' => 'Todos los modulos de un CRUD.',
            'd' => 'Nada: hay que crearlo todo con <code>nest g</code>.',
        ],
        'correcta' => 'b',
        'porque'   => 'Ese es el "modulo inicial" que mencionas: <code>app.module.ts</code>, <code>app.controller.ts</code> y <code>app.service.ts</code> (con su <code>app.controller.spec.ts</code>). Todo lo que generas despues con <code>nest g</code> cuelga de <code>AppModule</code>.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 1 — Panorama y arranque', 'CLI de Nest, main.ts, app.module.ts, configuracion, Docker y variables de entorno');
?>

<div class="card">
  <h2>0. Antes de escribir codigo: el CLI de Nest crea la estructura</h2>
  <p>Nadie escribe a mano los modulos, controllers y services vacios: se generan con el CLI
     (<code><?php hueco(82, 12); ?></code>, que se instala con <code>npm i -g @nestjs/cli</code>). Completa los comandos:</p>

<pre><code>$ nest <?php hueco(70, 4); ?> car-dealershop       <span style="color:#8b98a8"># crea el PROYECTO INICIAL (te pregunta el gestor: npm, yarn, pnpm)</span>

$ nest g <?php hueco(71, 8); ?> user            <span style="color:#8b98a8"># CREATE src/user/user.module.ts
                                       # UPDATE src/app.module.ts</span>

$ nest g <?php hueco(72, 12); ?> user        <span style="color:#8b98a8"># CREATE src/user/user.controller.ts (+ .spec.ts)
                                       # UPDATE src/user/user.module.ts</span>

$ nest g <?php hueco(73, 8); ?> user            <span style="color:#8b98a8"># CREATE src/user/user.service.ts (+ .spec.ts)
                                       # UPDATE src/user/user.module.ts</span>

$ nest g <?php hueco(74, 9); ?> user          <span style="color:#8b98a8"># hace TODO lo anterior + DTOs + entidad + los 5 metodos del CRUD</span></code></pre>

  <p>Lo que hace cada UPDATE (son los que se ven en el video): el modulo se registra en
     <code><?php hueco(75, 13); ?></code>; el controller se añade a <code>controllers</code> de
     <code><?php hueco(76, 14); ?></code>; el service se añade a <code>providers</code> de
     <code><?php hueco(77, 14); ?></code>.</p>

  <p>El <b>proyecto inicial</b> que crea <code>nest new</code> ya trae, ademas de <code>main.ts</code>:
     <code><?php hueco(78, 13); ?></code> (el modulo raiz), <code><?php hueco(79, 17); ?></code> (un <code>GET /</code> que
     responde "Hello World!") y <code><?php hueco(80, 15); ?></code>. Para no generar los archivos de prueba se añade la
     bandera <code>--<?php hueco(81, 8); ?></code>.</p>

  <div class="avisoflujo">
     <b>Orden recomendado:</b> <code>module</code> &rarr; <code>controller</code> &rarr; <code>service</code>. Asi cada cosa
     que creas se registra sola en <code>user.module.ts</code>. Con <code>resource</code> te ahorras los tres, pero conviene
     saber hacerlo por partes para entender <b>que conecta con que</b> (es justo lo que ves en cada linea <code>UPDATE</code>).
     Abreviaturas utiles: <code>g</code> = generate, <code>mo</code> = module, <code>co</code> = controller, <code>s</code> = service.
  </div>

  <h3>De memoria: los comandos completos</h3>
  <?php linea(87, 'Crear el proyecto <code>car-dealershop</code>:'); ?>
  <?php linea(83, 'Generar el modulo <code>user</code>:'); ?>
  <?php linea(84, 'Generar el controller <code>user</code>:'); ?>
  <?php linea(85, 'Generar el service <code>user</code>:'); ?>
  <?php linea(86, 'Generar todo el recurso <code>user</code> (modulo, controller, service, DTOs, entidad y CRUD) de una vez:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>A. <code>src/main.ts</code> — el punto de entrada</h2>

  <p>Nest corre por defecto sobre <?php hueco(14, 12); ?> (paquete <code>@nestjs/platform-<?php hueco(66, 8); ?></code>);
     la otra plataforma HTTP que soporta es <?php hueco(15, 10); ?>.</p>

<pre><code>import { <?php hueco(1, 12); ?> } from '<?php hueco(12, 12); ?>';
import { AppModule } from './app.module';
import { <?php hueco(4, 15); ?> } from '<?php hueco(13, 15); ?>';

<?php firma(11, 34); ?>

  const app = await <?php hueco(69, 11); ?>.<?php hueco(2, 7); ?>(AppModule);
  app.<?php hueco(3, 15); ?>(
    new ValidationPipe({
      <?php hueco(5, 10); ?>: true,
      <?php hueco(6, 21); ?>: true,
    })
  );
  await app.<?php hueco(7, 7); ?>(process.env.<?php hueco(8, 5); ?> ?? <?php hueco(9, 5); ?>);
}
<?php hueco(10, 10); ?>();</code></pre>

  <div class="nota"><code>process.env.PORT ?? 3000</code>: el operador <code>??</code> solo usa el <code>3000</code> si
     <code>PORT</code> es <code>undefined</code> o <code>null</code> (a diferencia de <code>||</code>, que tambien
     lo usaria con <code>""</code> o <code>0</code>).</div>

  <?php reto('main'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>src/app.module.ts</code> — el modulo raiz</h2>

<pre><code>import { Module } from '@nestjs/common';
import { AppController } from './app.controller';
import { AppService } from './app.service';
import { CarsModule } from './cars/cars.module';
import { BrandsModule } from './brands/brands.module';
import { <?php hueco(26, 13); ?> } from '@nestjs/config';
import { <?php hueco(27, 13); ?> } from '@nestjs/typeorm';
import { UserModule } from './user/user.module';
import { AuthModule } from './auth/auth.module';

@<?php hueco(16, 6); ?>({
  <?php hueco(17, 7); ?>: [
    ConfigModule.<?php hueco(18, 7); ?>({<?php hueco(19, 8); ?>: true}),
    TypeOrmModule.forRoot({
      type: '<?php hueco(20, 8); ?>',
      host: process.env.<?php hueco(28, 7); ?>,
      port: <?php hueco(29, 8); ?>(process.env.DB_PORT|| '5432'),
      database: process.env.DB_NAME,
      username: process.env.DB_USER,
      password: process.env.DB_PASSWORD,
      <?php hueco(21, 11); ?>: true,
      <?php hueco(22, 16); ?>: true
    }),
    CarsModule, BrandsModule, UserModule, AuthModule],
  <?php hueco(23, 11); ?>: [AppController],
  <?php hueco(24, 9); ?>: [AppService],
})
export class <?php hueco(25, 9); ?> {}</code></pre>

  <div class="avisoflujo">
     <b>Idea clave:</b> un <code>@Module</code> es una <b>caja</b>. Dentro declara:
     <code>controllers</code> (quien atiende rutas), <code>providers</code> (servicios inyectables),
     <code>imports</code> (otros modulos que necesita) y <code>exports</code> (que providers presta a los que lo importen).
     <code>AppModule</code> es la caja raiz: importa las demas cajas.
  </div>

  <?php reto('appmodule'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>package.json</code> y el CLI</h2>

<pre><code>"scripts": {
  "build":      "<?php hueco(34, 10); ?>",
  "start":      "nest start",
  "start:dev":  "nest start <?php hueco(30, 8); ?>",
  "start:prod": "<?php hueco(31, 15); ?>",
  "lint":       "<?php hueco(33, 7); ?> src/ test/",
  "test":       "<?php hueco(32, 5); ?>"
}</code></pre>

  <p>El gestor de paquetes de este repo es <?php hueco(36, 6); ?> (lo delata el archivo
     <code>pnpm-lock.yaml</code>). Para generar de golpe modulo + controller + service + DTOs + entidad de
     <i>cars</i> se escribe: <?php hueco(35, 26); ?></p>

  <div class="nota"><code>start:prod</code> no compila: ejecuta lo que dejo <code>nest build</code> en la carpeta
     <code>dist/</code>. En desarrollo <code>start:dev</code> recompila y reinicia cada vez que guardas.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. Docker y variables de entorno</h2>

<pre><code>services:
  db:
    image: <?php hueco(37, 9); ?>:18.6
    ports:
      - "${<?php hueco(42, 8); ?>}:<?php hueco(40, 5); ?>"
    environment:
      <?php hueco(38, 17); ?>: ${DB_PASSWORD}
      <?php hueco(39, 11); ?>: ${DB_NAME}
    container_name: car_dealership

  pgadmin:
    image: dpage/pgadmin4
    ports:
      - "<?php hueco(41, 5); ?>:80"</code></pre>

  <p>El puerto de la izquierda (<code>${DB_PORT}</code>) es el de <b>tu maquina</b>; el <code>5432</code> de la
     derecha es el de <b>dentro del contenedor</b>. pgAdmin se abre en <code>localhost:8888</code>.</p>

  <p>Las variables que el codigo lee en <code>app.module.ts</code>: <?php hueco(67, 8); ?>,
     <?php hueco(68, 8); ?>, <?php hueco(43, 8); ?>, <?php hueco(44, 8); ?> y <?php hueco(45, 12); ?>.
     Y las de JWT en <code>auth.module.ts</code>: <?php hueco(46, 11); ?> (la clave con la que se firma) y
     <?php hueco(47, 15); ?> (cuanto dura el token).</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. <code>tsconfig.json</code> — las tres lineas que hacen posible Nest</h2>

<pre><code>{
  "compilerOptions": {
    "<?php hueco(48, 22); ?>": true,      // habilita la sintaxis @Decorador
    "<?php hueco(49, 21); ?>": true,      // TypeScript deja los tipos en tiempo de ejecucion
    "strict": true,
    "<?php hueco(50, 28); ?>": false   // permite  id: string;  sin inicializar
  }
}</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. Recorrido de arranque: de <code>pnpm run start:dev</code> a "servidor activo"</h2>

<pre class="flujo"><code>pnpm run start:dev
  ↓
nest start --watch      (compila TypeScript a dist/ y vigila cambios)
  ↓
se ejecuta <?php hueco(51, 7); ?>  →  llama a  <?php hueco(52, 9); ?>()
  ↓
<?php hueco(53, 18); ?>(<?php hueco(54, 9); ?>)
  ↓
Nest lee los @Module y construye el grafo de dependencias (inyeccion)
  ↓
ConfigModule carga el archivo <?php hueco(55, 4); ?> a process.env
  ↓
<?php hueco(56, 13); ?> conecta a Postgres y, con <?php hueco(57, 11); ?>: true, crea/ajusta las tablas
  ↓
Nest registra las rutas de cada <?php hueco(58, 11); ?> (@Get, @Post, ...)
  ↓
app.<?php hueco(59, 6); ?>(3000)   →   servidor activo</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. De memoria: la linea completa</h2>

  <?php linea(60, 'En <code>main.ts</code>: crear la aplicacion a partir del modulo raiz:'); ?>
  <?php linea(61, 'En <code>main.ts</code>: registrar el ValidationPipe global que elimina y <b>prohibe</b> propiedades extra (en una sola linea):'); ?>
  <?php linea(62, 'En <code>main.ts</code>: levantar el servidor en el puerto de <code>PORT</code> o, si no existe, en el 3000:'); ?>
  <?php linea(63, 'En <code>app.module.ts</code>: cargar el <code>.env</code> y hacerlo global:'); ?>
  <?php linea(64, 'La declaracion de la clase del modulo raiz (con export):'); ?>
  <?php linea(65, 'La ultima linea de <code>main.ts</code>, la que realmente dispara todo:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); mc('m9'); mc('m10'); mc('m11'); mc('m12'); mc('m13'); mc('m14'); mc('m15'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('Menu.php', 'segundo.php');
