<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 2 — Modulos e inyeccion de dependencias
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A. brands.module.ts --- */
    1  => 'controllers',
    2  => 'providers',
    3  => 'imports',
    4  => 'forFeature',
    5  => 'Brand',
    6  => 'exports',
    7  => 'BrandsService',
    8  => 'BrandsModule',

    /* --- B. cars.module.ts --- */
    10 => 'forFeature',
    11 => 'Car',
    12 => 'BrandsModule',
    13 => ['../brands/brands.module', './../brands/brands.module'],

    /* --- C. user.module.ts y auth.module.ts --- */
    14 => 'exports',
    15 => 'UserService',
    16 => 'UserModule',
    17 => 'PassportModule',
    18 => 'JwtModule',
    19 => 'JwtStrategy',
    20 => ['../user/user.module', './../user/user.module'],

    /* --- D. Mapa de modulos --- */
    21 => 'ConfigModule',
    22 => 'TypeOrmModule',
    23 => 'BrandsModule',
    24 => 'UserModule',
    25 => 'BrandsService',
    26 => 'UserService',
    27 => 'PassportModule',
    28 => 'JwtModule',

    /* --- E. La inyeccion en el service --- */
    30 => 'Injectable',
    31 => 'InjectRepository',
    32 => 'Repository',
    33 => 'readonly',
    34 => 'BrandsService',
    35 => 'private',
    36 => 'Car',
    37 => 'Repository',
    38 => 'InjectRepository',
    39 => 'User',

    /* --- F. Quien provee que --- */
    40 => 'CarsService',
    41 => ['TypeOrmModule.forFeature([Car])', 'forFeature([Car])', 'forFeature'],
    42 => 'BrandsModule',
    43 => ['ConfigModule', 'global', 'isGlobal', 'ConfigModule global'],
    44 => 'UserModule',

    /* --- G. Lineas completas de memoria --- */
    50 => ['TypeOrmModule.forFeature([Brand]),', 'TypeOrmModule.forFeature([Brand])'],
    51 => 'exports: [BrandsService]',
    52 => 'constructor(private readonly brandsService: BrandsService) {}',
    53 => '@InjectRepository(Brand) private readonly brandRepository: Repository<Brand>',
    54 => '@Controller("brands")',
    55 => ['private readonly brandService: BrandsService,', 'private readonly brandService: BrandsService'],
    56 => ['imports: [TypeOrmModule.forFeature([Car]), BrandsModule,]', 'imports: [TypeOrmModule.forFeature([Car]), BrandsModule]'],
    57 => '@Injectable()',
];

$RETOS = [

'brandsmodule' => [
    'titulo' => '<code>brands.module.ts</code>',
    'huecos' => [1, 2, 3, 4, 5, 6, 7, 8],
    'codigo' => <<<'EOT'
import { Module } from '@nestjs/common';
import { BrandsService } from './brands.service';
import { BrandsController } from './brands.controller';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Brand } from './entities/brand.entity';

@Module({
  controllers: [BrandsController],
  providers: [BrandsService],
  imports: [
    TypeOrmModule.forFeature([Brand]),
  ],
  exports: [BrandsService]
})
export class BrandsModule {}
EOT
],

'carsmodule' => [
    'titulo' => '<code>cars.module.ts</code>',
    'huecos' => [10, 11, 12, 13],
    'codigo' => <<<'EOT'
import { Module } from '@nestjs/common';
import { CarsController } from './cars.controller';
import { CarsService } from './cars.service';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Car } from './entities/car.entity';
import { BrandsModule } from '../brands/brands.module';

@Module({
  controllers: [CarsController],
  providers: [CarsService],
  imports: [
    TypeOrmModule.forFeature([Car]),
    BrandsModule,
  ]
})
export class CarsModule {}
EOT
],

'usermodule' => [
    'titulo' => '<code>user.module.ts</code>',
    'huecos' => [14, 15],
    'codigo' => <<<'EOT'
import { Module } from '@nestjs/common';
import { UserService } from './user.service';
import { UserController } from './user.controller';
import { TypeOrmModule } from '@nestjs/typeorm';
import { User } from './entities/user.entity';

@Module({
  controllers: [UserController],
  providers: [UserService],
  imports: [
    TypeOrmModule.forFeature([User]),
  ],
  exports: [UserService]
})
export class UserModule {}
EOT
],

'carsservice' => [
    'titulo' => 'el <code>constructor</code> de <code>CarsService</code> (con su decorador de clase)',
    'huecos' => [30, 31, 32, 33, 34, 35, 36, 37],
    'codigo' => <<<'EOT'
@Injectable()
export class CarsService {
    constructor(
        @InjectRepository(Car) private readonly carRepository: Repository<Car>,
        private readonly brandService: BrandsService,
    ) { }
}
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Que es la <b>inyeccion de dependencias</b> en Nest, con un ejemplo de este repo?',
        'opciones' => [
            'a' => 'Que dentro de <code>CarsService</code> escribes <code>new BrandsService()</code> cada vez que lo necesitas.',
            'b' => 'Que Nest guarda las clases en una base de datos.',
            'c' => 'Que en el <b>constructor</b> pides lo que necesitas (<code>private readonly brandService: BrandsService</code>) y <b>Nest te lo entrega ya construido</b>, sin que tu hagas <code>new</code>.',
            'd' => 'Que los servicios se importan con <code>import</code> y ya.',
        ],
        'correcta' => 'c',
        'porque'   => 'Nest mantiene un <b>contenedor</b> con una instancia de cada provider. Cuando construye <code>CarsService</code> lee los tipos del constructor y le pasa esas instancias. Ventajas: un solo <code>BrandsService</code> compartido y clases faciles de probar (en un test le pasas un falso).',
    ],
    'm2' => [
        'texto'    => '¿Que significa <code>private readonly</code> antes de un parametro del constructor, como en <code>constructor(private readonly carService: CarsService)</code>?',
        'opciones' => [
            'a' => 'Declara y asigna la propiedad de clase <code>this.carService</code> automaticamente (atajo de TypeScript); <code>readonly</code> impide reasignarla.',
            'b' => 'Que el parametro es opcional.',
            'c' => 'Que el service solo se puede usar una vez.',
            'd' => 'Que el service es privado de otros modulos.',
        ],
        'correcta' => 'a',
        'porque'   => 'Es una <i>parameter property</i> de TypeScript: equivale a declarar <code>private readonly carService: CarsService;</code> y escribir <code>this.carService = carService;</code> dentro del constructor. Nada que ver con la visibilidad entre modulos.',
    ],
    'm3' => [
        'texto'    => '¿Para que sirve <code>@Injectable()</code> sobre una clase como <code>CarsService</code>?',
        'opciones' => [
            'a' => 'Convierte la clase en un controller.',
            'b' => 'La marca como <b>provider</b> gestionable por Nest y hace que TypeScript emita los tipos de su constructor, para que Nest sepa que inyectar.',
            'c' => 'Hace que la clase se pueda importar desde otros archivos.',
            'd' => 'Crea automaticamente la tabla en la BD.',
        ],
        'correcta' => 'b',
        'porque'   => 'Un decorador sobre la clase hace que TS genere <code>design:paramtypes</code> (los tipos del constructor). Sin ningun decorador, esa metadata no se emite y Nest no puede resolver dependencias.',
    ],
    'm4' => [
        'texto'    => 'El <code>CarsService</code> necesita el <code>BrandsService</code>. ¿Que dos cosas hacen falta para que Nest se lo pueda dar?',
        'opciones' => [
            'a' => 'Solo escribirlo en el constructor.',
            'b' => 'Que <code>BrandsModule</code> haga <code>exports: [BrandsService]</code> <b>y</b> que <code>CarsModule</code> tenga <code>BrandsModule</code> en su <code>imports</code>.',
            'c' => 'Que <code>BrandsService</code> este en los <code>providers</code> de <code>AppModule</code>.',
            'd' => 'Que los dos modulos esten en la misma carpeta.',
        ],
        'correcta' => 'b',
        'porque'   => 'Los providers son <b>privados de su modulo</b>. Para prestarlos: el dueño los <code>exports</code> y el que los quiere <code>imports</code> el modulo del dueño. Es un apreton de manos de dos pasos.',
    ],
    'm5' => [
        'texto'    => 'Quitas <code>exports: [BrandsService]</code> de <code>BrandsModule</code> (dejando todo lo demas igual). Al arrancar:',
        'opciones' => [
            'a' => 'Todo funciona: <code>CarsModule</code> ya importa <code>BrandsModule</code>.',
            'b' => 'El error solo aparece cuando alguien llama a <code>POST /cars</code>.',
            'c' => 'Error de arranque: <i>Nest can\'t resolve dependencies of the CarsService (..., ?)</i>: <code>BrandsService</code> no esta disponible en el contexto de <code>CarsModule</code>.',
            'd' => 'Error de compilacion de TypeScript.',
        ],
        'correcta' => 'c',
        'porque'   => 'Es un error de <b>arranque</b>, no de peticion: Nest resuelve todo el grafo antes de abrir el puerto. El mensaje indica el service, el indice del parametro que no pudo resolver (<code>?</code>) y el modulo donde falta.',
    ],
    'm6' => [
        'texto'    => 'Quitas <code>TypeOrmModule.forFeature([Car])</code> de <code>CarsModule</code>. ¿Que falla?',
        'opciones' => [
            'a' => 'Nada, <code>autoLoadEntities</code> lo suple.',
            'b' => 'Nest no puede resolver el <code>CarRepository</code> (parametro <code>[0]</code> de <code>CarsService</code>): el repositorio de <code>Car</code> nunca se registro como provider.',
            'c' => 'Falla <code>BrandsService</code>.',
            'd' => 'La tabla <code>car</code> no se crea pero todo lo demas funciona.',
        ],
        'correcta' => 'b',
        'porque'   => '<code>forFeature([Car])</code> hace dos cosas: registra la entidad (para <code>autoLoadEntities</code>) y <b>crea el provider</b> <code>Repository&lt;Car&gt;</code> que <code>@InjectRepository(Car)</code> pide. Sin el, el token no existe.',
    ],
    'm7' => [
        'texto'    => '¿Por que hace falta <code>@InjectRepository(Car)</code> si el parametro ya esta tipado como <code>Repository&lt;Car&gt;</code>?',
        'opciones' => [
            'a' => 'Porque en tiempo de ejecucion los genericos desaparecen: el tipo emitido es solo <code>Repository</code>, igual para <code>Car</code>, <code>Brand</code> o <code>User</code>. El decorador aporta el <b>token</b> concreto de cada entidad.',
            'b' => 'Es solo decorativo.',
            'c' => 'Porque <code>Repository</code> es una interfaz.',
            'd' => 'Para que la entidad se cree en la BD.',
        ],
        'correcta' => 'a',
        'porque'   => 'TypeScript borra <code>&lt;Car&gt;</code> al compilar; Nest solo veria "un Repository". Con <code>@InjectRepository(Car)</code> le dices <i>cual</i> (internamente un token derivado de la entidad).',
    ],
    'm8' => [
        'texto'    => 'Olvidas agregar <code>CarsService</code> al arreglo <code>providers</code> de <code>CarsModule</code>. ¿Que pasa?',
        'opciones' => [
            'a' => 'Funciona porque tiene <code>@Injectable()</code>.',
            'b' => 'Error de arranque: <code>CarsController</code> pide un <code>CarsService</code> y Nest no lo encuentra en el modulo.',
            'c' => 'Solo falla el <code>DELETE</code>.',
            'd' => 'Nest lo crea sin avisar.',
        ],
        'correcta' => 'b',
        'porque'   => '<code>@Injectable()</code> no registra nada por si sola. Solo lo que aparece en <code>providers</code> (o llega por <code>imports</code>) existe para el contenedor de ese modulo.',
    ],
    'm9' => [
        'texto'    => '¿Por que <code>JwtStrategy</code> puede inyectar <code>ConfigService</code> sin que <code>AuthModule</code> importe <code>ConfigModule</code> en su <code>imports</code> de forma explicita para eso?',
        'opciones' => [
            'a' => 'Porque <code>ConfigModule.forRoot({isGlobal: true})</code> lo hace global: su <code>ConfigService</code> esta disponible en todos los modulos.',
            'b' => 'Porque <code>ConfigService</code> es una variable global de Node.',
            'c' => 'Porque las estrategias no necesitan modulos.',
            'd' => 'Porque <code>PassportModule</code> lo exporta.',
        ],
        'correcta' => 'a',
        'porque'   => 'Un modulo marcado global no necesita ser importado por los demas. (Aun asi el profe lo importa en <code>registerAsync</code>: redundante pero inofensivo.)',
    ],
    'm10' => [
        'texto'    => '<code>AuthModule</code> importa <code>UserModule</code> y <code>UserModule</code> importaria a su vez <code>AuthModule</code>. ¿Que problema aparece?',
        'opciones' => [
            'a' => 'Ninguno, es lo normal.',
            'b' => 'Una <b>dependencia circular</b>: Nest no sabe cual construir primero y lanza error; se resuelve con <code>forwardRef(() =&gt; ...)</code> o, mejor, rediseñando para que la dependencia sea de un solo sentido.',
            'c' => 'Se duplican las tablas.',
            'd' => 'Solo da un warning de lint.',
        ],
        'correcta' => 'b',
        'porque'   => 'En el repo la dependencia va en <b>un solo sentido</b> (Auth &rarr; User, nunca al reves). Por eso funciona sin <code>forwardRef</code>.',
    ],
    'm11' => [
        'texto'    => 'Por defecto, ¿cuantas instancias de <code>BrandsService</code> hay en la app aunque lo usen <code>BrandsController</code> y <code>CarsService</code>?',
        'opciones' => [
            'a' => 'Una por peticion.',
            'b' => 'Una por cada archivo que lo importe.',
            'c' => 'Dos.',
            'd' => 'Una sola: los providers son <b>singleton</b> por defecto.',
        ],
        'correcta' => 'd',
        'porque'   => 'Scope <code>DEFAULT</code> = singleton: se crea al arrancar y todos comparten la misma instancia. (Existen scopes <code>REQUEST</code> y <code>TRANSIENT</code>, pero no se usan aqui.)',
    ],
    'm12' => [
        'texto'    => 'Diferencia entre <code>providers</code>, <code>imports</code> y <code>exports</code> en un <code>@Module</code>:',
        'opciones' => [
            'a' => '<code>providers</code>: los servicios que <b>este modulo crea</b>; <code>imports</code>: los modulos <b>de los que toma</b> providers; <code>exports</code>: los providers propios que <b>presta</b> a quien lo importe.',
            'b' => 'Los tres significan lo mismo, solo cambia el orden.',
            'c' => '<code>imports</code> es para librerias npm, <code>providers</code> para tus clases.',
            'd' => '<code>exports</code> publica una ruta HTTP.',
        ],
        'correcta' => 'a',
        'porque'   => 'Ejemplo: <code>UserModule</code> tiene <code>UserService</code> en <code>providers</code> y en <code>exports</code>; <code>AuthModule</code> lo trae con <code>imports: [UserModule]</code>.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 2 — Modulos e inyeccion de dependencias', 'providers, imports, exports, forFeature, @Injectable, @InjectRepository');
?>

<div class="card">
  <h2>A. <code>brands.module.ts</code> — una caja completa</h2>

<pre><code>import { Module } from '@nestjs/common';
import { BrandsService } from './brands.service';
import { BrandsController } from './brands.controller';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Brand } from './entities/brand.entity';

@Module({
  <?php hueco(1, 11); ?>: [BrandsController],
  <?php hueco(2, 9); ?>: [BrandsService],
  <?php hueco(3, 7); ?>: [
    TypeOrmModule.<?php hueco(4, 10); ?>([<?php hueco(5, 6); ?>]),
  ],
  <?php hueco(6, 7); ?>: [<?php hueco(7, 14); ?>]
})
export class <?php hueco(8, 13); ?> {}</code></pre>

  <div class="avisoflujo">
     <b>Lectura rapida:</b> "este modulo tiene un controller (<code>BrandsController</code>), un service
     (<code>BrandsService</code>), necesita el repositorio de <code>Brand</code> (<code>forFeature</code>) y
     <b>presta</b> su service a los demas".
  </div>

  <?php reto('brandsmodule'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>cars.module.ts</code> — un modulo que usa a otro</h2>

<pre><code>import { Module } from '@nestjs/common';
import { CarsController } from './cars.controller';
import { CarsService } from './cars.service';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Car } from './entities/car.entity';
import { BrandsModule } from '<?php hueco(13, 24); ?>';

@Module({
  controllers: [CarsController],
  providers: [CarsService],
  imports: [
    TypeOrmModule.<?php hueco(10, 10); ?>([<?php hueco(11, 4); ?>]),
    <?php hueco(12, 13); ?>,
  ]
})
export class CarsModule {}</code></pre>

  <div class="nota">Fijate que <code>CarsModule</code> <b>no tiene</b> <code>exports</code>: nadie mas necesita
     <code>CarsService</code>, asi que no lo presta. <code>BrandsModule</code> si exporta porque
     <code>CarsService</code> lo necesita.</div>

  <?php reto('carsmodule'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>user.module.ts</code> y <code>auth.module.ts</code> — el mismo patron</h2>

<pre><code>// user.module.ts
@Module({
  controllers: [UserController],
  providers: [UserService],
  imports: [TypeOrmModule.forFeature([User])],
  <?php hueco(14, 7); ?>: [<?php hueco(15, 12); ?>]
})
export class UserModule {}

// auth.module.ts
import { UserModule } from '<?php hueco(20, 21); ?>';

@Module({
  controllers: [AuthController],
  providers: [AuthService, <?php hueco(19, 11); ?>],
  imports: [
    ConfigModule.forRoot({isGlobal: true}),
    <?php hueco(16, 10); ?>,
    <?php hueco(17, 14); ?>.register({defaultStrategy: 'jwt'}),
    <?php hueco(18, 9); ?>.registerAsync({ ... })
  ]
})
export class AuthModule {}</code></pre>

  <div class="avisoflujo">
     <code>AuthService</code> inyecta <code>UserService</code> y <code>JwtService</code>; <code>JwtStrategy</code>
     inyecta <code>UserService</code> y <code>ConfigService</code>. Por eso <code>AuthModule</code> importa
     <code>UserModule</code> (que exporta <code>UserService</code>) y <code>JwtModule</code> (que aporta <code>JwtService</code>).
  </div>

  <?php reto('usermodule'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. El mapa de modulos del proyecto</h2>
  <p>Completa quien importa a quien y que servicio viaja por cada flecha:</p>

<pre class="flujo"><code>AppModule
  ├── imports: <?php hueco(21, 13); ?>.forRoot({isGlobal: true})      (variables de entorno, global)
  ├── imports: <?php hueco(22, 13); ?>.forRoot({...})      (conexion a Postgres)
  ├── imports: CarsModule
  │              ├── TypeOrmModule.forFeature([Car])
  │              └── imports: <?php hueco(23, 13); ?>    ← aqui viaja  <?php hueco(25, 14); ?>
  ├── imports: BrandsModule    (exports: [BrandsService])
  ├── imports: <?php hueco(24, 10); ?>
  │              └── exports: [<?php hueco(26, 12); ?>]
  └── imports: AuthModule
                 ├── imports: UserModule            ← aqui viaja  UserService
                 ├── imports: <?php hueco(27, 14); ?>.register({defaultStrategy: 'jwt'})
                 └── imports: <?php hueco(28, 9); ?>.registerAsync({...})</code></pre>

  <div class="nota">Regla practica para <b>leer cualquier proyecto Nest</b>: empieza por <code>AppModule</code>,
     sigue las flechas de <code>imports</code> y en cada modulo mira que <code>providers</code> tiene y cuales
     <code>exports</code> presta. Con eso entiendes toda la estructura.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. La inyeccion en la practica: el constructor del service</h2>

<pre><code><span style="color:#8b98a8">// cars.service.ts</span>
@<?php hueco(30, 10); ?>()
export class CarsService {
    constructor(
        @<?php hueco(31, 16); ?>(<?php hueco(36, 4); ?>) <?php hueco(35, 7); ?> <?php hueco(33, 8); ?> carRepository: <?php hueco(32, 10); ?>&lt;Car&gt;,
        private readonly brandService: <?php hueco(34, 14); ?>,
    ) { }
}

<span style="color:#8b98a8">// user.service.ts</span>
constructor(
    @<?php hueco(38, 16); ?>(<?php hueco(39, 4); ?>)
    private readonly userRepository: <?php hueco(37, 10); ?>&lt;User&gt;
){}</code></pre>

  <div class="nota">Dos tipos de dependencia en el mismo constructor: un <b>repositorio de TypeORM</b>
     (necesita <code>@InjectRepository</code> porque hay uno por entidad) y un <b>service normal</b>
     (se inyecta solo por su tipo, sin decorador de parametro).</div>

  <?php reto('carsservice'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. ¿Quien provee cada cosa?</h2>
  <p>Cuando Nest construye <code>CarsController</code>, sigue la cadena. Completa de donde sale cada pieza:</p>

<pre><code>CarsController  necesita  →  <?php hueco(40, 12); ?>

CarsService     necesita  →  Repository&lt;Car&gt;   viene de:  <?php hueco(41, 34); ?>

                             BrandsService       viene de:  el modulo <?php hueco(42, 13); ?> (que lo exporta)

JwtStrategy     necesita  →  ConfigService       viene de:  <?php hueco(43, 13); ?> (es global)

AuthService     necesita  →  UserService         viene de:  el modulo <?php hueco(44, 10); ?> (que lo exporta)</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. De memoria: la linea completa</h2>

  <?php linea(50, 'En <code>BrandsModule</code>: registrar el repositorio de la entidad <code>Brand</code> (con la coma final):'); ?>
  <?php linea(51, 'En <code>BrandsModule</code>: prestar el service a otros modulos:'); ?>
  <?php linea(52, 'En <code>BrandsController</code>: pedir el service en el constructor (con el <code>{}</code> vacio):'); ?>
  <?php linea(53, 'En <code>BrandsService</code>: el parametro que pide el repositorio de <code>Brand</code> (sin coma):'); ?>
  <?php linea(54, 'Decorador de clase que hace que <code>BrandsController</code> atienda las rutas que empiezan por <code>/brands</code>:'); ?>
  <?php linea(55, 'En <code>CarsService</code>: pedir el service de marcas (con la coma final):'); ?>
  <?php linea(56, 'En <code>CarsModule</code>: el arreglo <code>imports</code> completo, en una sola linea:'); ?>
  <?php linea(57, 'El decorador que va encima de toda clase que sea un provider (un service):'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); mc('m9'); mc('m10'); mc('m11'); mc('m12'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
