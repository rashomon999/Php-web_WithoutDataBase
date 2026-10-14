<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 3 — Controllers, rutas, decoradores y pipes de parametro
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A. brands.controller.ts --- */
    1  => 'Controller',
    2  => 'brands',
    3  => 'Post',
    4  => 'Body',
    5  => 'Get',
    6  => ':id',
    7  => 'Param',
    8  => 'ParseUUIDPipe',
    9  => 'Patch',
    10 => 'Delete',
    11 => 'BrandsService',
    12 => "update(@Param('id', ParseUUIDPipe) id: string, @Body() updateBrandDto: UpdateBrandDto) {",
    13 => 'remove',
    14 => 'ParseUUIDPipe',

    /* --- B. cars.controller.ts --- */
    15 => 'Promise',
    16 => 'Car',
    17 => 'getAll',
    18 => 'Body',
    19 => 'CreateCarDto',
    20 => 'Patch',
    21 => 'ParseUUIDPipe',
    22 => 'CarsService',

    /* --- C. Tabla de rutas: metodo + URL --- */
    23 => ['GET', 'get'],
    24 => ['/brands', 'brands'],
    25 => ['POST', 'post'],
    26 => ['/cars', 'cars'],
    27 => ['PATCH', 'patch'],
    28 => ['/cars/:id', 'cars/:id'],
    29 => ['DELETE', 'delete'],
    30 => ['/cars/:id', 'cars/:id'],
    31 => ['GET', 'get'],
    32 => ['/user', 'user'],
    33 => ['POST', 'post'],
    34 => ['/auth/login', 'auth/login'],
    35 => ['GET', 'get'],
    36 => ['/auth/private2', 'auth/private2'],
    37 => ['GET', 'get'],
    38 => '/',

    /* --- D. Ciclo de vida de la peticion --- */
    40 => ['Middleware', 'Middlewares'],
    41 => ['Guards', 'Guard', 'Guardias'],
    42 => ['Interceptors', 'Interceptor', 'Interceptores'],
    43 => ['Pipes', 'Pipe'],
    44 => ['Controller', 'Controllers', 'Handler'],
    45 => ['Service', 'Services'],
    46 => ['Exception Filter', 'Exception Filters', 'Filter', 'Filtro', 'ExceptionFilter'],

    /* --- E. Decoradores de parametro --- */
    47 => 'Body',
    48 => 'Param',
    49 => 'Query',
    50 => 'Headers',
    51 => 'HttpCode',
    52 => '201',
    53 => '200',

    /* --- F. Ordenes de rutas (variante) --- */
    54 => 'profile',
    55 => ':id',

    /* --- G. Lineas completas --- */
    60 => "@Get(':id')",
    61 => "findOne(@Param('id', ParseUUIDPipe) id: string) {",
    62 => 'return this.brandsService.findOne(id);',
    63 => 'create(@Body() createBrandDto: CreateBrandDto) {',
    64 => "@Patch(':id')",
    65 => 'getAll (): Promise<Car[]>{',
    66 => "@Controller('cars')",
    67 => ['constructor(private readonly carService: CarsService) {}', 'constructor(private readonly carService: CarsService) { }'],
];

$RETOS = [

'brandscontroller' => [
    'titulo' => '<code>brands.controller.ts</code>',
    'huecos' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
    'codigo' => <<<'EOT'
import { Controller, Get, Post, Body, Patch, Param, Delete, ParseIntPipe, ParseUUIDPipe } from '@nestjs/common';
import { BrandsService } from './brands.service';
import { CreateBrandDto } from './dto/create-brand.dto';
import { UpdateBrandDto } from './dto/update-brand.dto';

@Controller('brands')
export class BrandsController {
  constructor(private readonly brandsService: BrandsService) {}

  @Post()
  create(@Body() createBrandDto: CreateBrandDto) {
    return this.brandsService.create(createBrandDto);
  }

  @Get()
  findAll() {
    return this.brandsService.findAll();
  }

  @Get(':id')
  findOne(@Param('id', ParseUUIDPipe) id: string) {
    return this.brandsService.findOne(id);
  }

  @Patch(':id')
  update(@Param('id', ParseUUIDPipe) id: string, @Body() updateBrandDto: UpdateBrandDto) {
    return this.brandsService.update(id, updateBrandDto);
  }

  @Delete(':id')
  remove(@Param('id', ParseUUIDPipe) id: string) {
    return this.brandsService.remove(id);
  }
}
EOT
],

'carscontroller' => [
    'titulo' => '<code>cars.controller.ts</code> (la clase completa, sin los imports)',
    'huecos' => [15, 16, 17, 18, 19, 20, 21, 22],
    'codigo' => <<<'EOT'
@Controller('cars')
export class CarsController {

    constructor(
        private readonly carService: CarsService
    ) {}

    @Get('/')
    getAll (): Promise<Car[]>{
        return this.carService.getAll();
    }

    @Get(':id')
    getById(@Param('id', ParseUUIDPipe) id: string){
        return this.carService.getById(id);
    }

    @Post()
    create(@Body() car: CreateCarDto){
        return this.carService.create(car);
    }

    @Patch(':id')
    update(@Param('id', ParseUUIDPipe) id: string, @Body() car: UpdateCarDto){
        return this.carService.update(id, car);
    }

    @Delete(':id')
    delete(@Param('id', ParseUUIDPipe) id: string){
        return this.carService.delete(id);
    }
}
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Cual es el <b>unico</b> trabajo de un controller en Nest?',
        'opciones' => [
            'a' => 'Recibir la peticion HTTP, extraer lo que llega (params, body...) y <b>delegar</b> en el service; no contiene logica de negocio ni habla con la BD.',
            'b' => 'Guardar los datos en Postgres.',
            'c' => 'Validar contraseñas con bcrypt.',
            'd' => 'Definir las tablas de la base de datos.',
        ],
        'correcta' => 'a',
        'porque'   => 'Fijate en <code>BrandsController</code>: cada metodo es una sola linea, <code>return this.brandsService.xxx(...)</code>. La logica (y los errores como el 404) viven en el service.',
    ],
    'm2' => [
        'texto'    => 'Con <code>@Controller(\'brands\')</code> y <code>@Get(\':id\')</code> en un metodo, ¿que URL atiende?',
        'opciones' => [
            'a' => '<code>GET /:id</code>',
            'b' => '<code>GET /brands</code>',
            'c' => '<code>GET /brands/:id</code>, por ejemplo <code>GET /brands/3f2c...</code>',
            'd' => '<code>POST /brands/:id</code>',
        ],
        'correcta' => 'c',
        'porque'   => 'La ruta final es <b>prefijo del controller + ruta del metodo</b>. Y el verbo lo da el decorador: <code>@Get</code> &rarr; GET.',
    ],
    'm3' => [
        'texto'    => 'Llamas <code>GET /cars/123</code> (un id que no es UUID). ¿Que responde la API y quien lo decide?',
        'opciones' => [
            'a' => '<code>404 Not Found</code>, lo decide <code>CarsService</code>.',
            'b' => '<code>500</code>, revienta Postgres al comparar con la columna uuid.',
            'c' => '<code>200</code> con <code>null</code>.',
            'd' => '<code>400 Bad Request</code> ("Validation failed (uuid is expected)"); lo decide <code>ParseUUIDPipe</code> <b>antes</b> de entrar al metodo.',
        ],
        'correcta' => 'd',
        'porque'   => 'El pipe <code>ParseUUIDPipe</code> del parametro corre antes del handler. Si el id no es UUID lanza <code>BadRequestException</code> y el service ni se entera. Con un UUID valido pero inexistente si llegaria al service, que respondera 404.',
    ],
    'm4' => [
        'texto'    => 'Llamas <code>GET /cars/3f2c8f0a-1b4d-4e6a-9c1d-2a7b5e9d1c11</code> (UUID valido, pero no existe en la tabla). ¿Que pasa?',
        'opciones' => [
            'a' => '<code>400</code> del pipe.',
            'b' => '<code>404 Not Found</code>: <code>getById</code> hace <code>findOneBy({id})</code>, obtiene <code>null</code> y lanza <code>NotFoundException</code>.',
            'c' => '<code>200</code> con un arreglo vacio.',
            'd' => '<code>500</code>.',
        ],
        'correcta' => 'b',
        'porque'   => 'Dos filtros distintos: el <b>pipe</b> comprueba el <i>formato</i> (400); el <b>service</b> comprueba la <i>existencia</i> (404). Es la diferencia entre "no es un UUID" y "es un UUID pero no hay nada".',
    ],
    'm5' => [
        'texto'    => '¿Que codigo HTTP devuelve por defecto Nest en un <code>@Post()</code> exitoso, y en un <code>@Get()</code>?',
        'opciones' => [
            'a' => '200 en ambos.',
            'b' => '201 en POST y 200 en GET.',
            'c' => '204 en POST y 200 en GET.',
            'd' => '201 en ambos.',
        ],
        'correcta' => 'b',
        'porque'   => 'Nest usa <b>201 Created</b> para POST y <b>200 OK</b> para el resto (GET, PATCH, DELETE...). Se cambia con <code>@HttpCode(204)</code> u otro codigo. Ojo: por eso un <code>POST /auth/login</code> "exitoso" devuelve 201.',
    ],
    'm6' => [
        'texto'    => '¿Diferencia entre <code>@Param(\'id\')</code>, <code>@Query(\'id\')</code> y <code>@Body()</code>?',
        'opciones' => [
            'a' => 'Ninguna, son sinonimos.',
            'b' => '<code>@Param</code> lee la parte variable de la ruta (<code>/cars/<b>7</b></code>); <code>@Query</code> lee la query string (<code>/cars<b>?id=7</b></code>); <code>@Body</code> lee el cuerpo JSON de la peticion.',
            'c' => '<code>@Param</code> lee el cuerpo, <code>@Body</code> la URL.',
            'd' => '<code>@Query</code> es solo para POST.',
        ],
        'correcta' => 'b',
        'porque'   => 'En este repo solo se usan <code>@Param</code> y <code>@Body</code>. <code>@Query</code> aparece cuando se hace paginacion o filtros: <code>GET /cars?limit=10&amp;offset=0</code>.',
    ],
    'm7' => [
        'texto'    => 'Un handler <code>update</code> devuelve <code>this.carService.update(id, car)</code>, que es una <code>Promise&lt;Car&gt;</code>. ¿Hace falta <code>await</code> en el controller?',
        'opciones' => [
            'a' => 'Si, o la peticion se queda colgada.',
            'b' => 'Si, o TypeScript no compila.',
            'c' => 'No: Nest <b>espera la Promise</b> que devuelve el handler y serializa su resultado como JSON.',
            'd' => 'No, pero la respuesta sale vacia.',
        ],
        'correcta' => 'c',
        'porque'   => 'Un handler puede devolver un valor, una Promise o un Observable; Nest resuelve y responde. El <code>await</code> seria necesario solo si quisieras trabajar con el resultado dentro del metodo.',
    ],
    'm8' => [
        'texto'    => 'Si un handler devuelve <code>null</code> o <code>undefined</code> (por ejemplo <code>GET /user/:id</code> cuando el service no encuentra nada por email), ¿que recibe el cliente?',
        'opciones' => [
            'a' => '<code>404</code> automatico.',
            'b' => '<code>200 OK</code> con el cuerpo <b>vacio</b>.',
            'c' => '<code>500</code>.',
            'd' => '<code>{"data": null}</code>.',
        ],
        'correcta' => 'b',
        'porque'   => 'Nest <b>no inventa</b> un 404 por ti: si quieres 404 tienes que lanzar <code>NotFoundException</code> (como hacen <code>BrandsService.findOne</code> y <code>CarsService.getById</code>).',
    ],
    'm9' => [
        'texto'    => 'Variante: declaras <code>@Get(\':id\')</code> <b>antes</b> que <code>@Get(\'profile\')</code> en el mismo controller. ¿Que pasa al llamar <code>GET /x/profile</code>?',
        'opciones' => [
            'a' => 'Entra a <code>profile</code>, Nest ordena por especificidad.',
            'b' => 'Nest lanza error al arrancar por rutas ambiguas.',
            'c' => 'Entra al de <code>:id</code> con <code>id = "profile"</code> (las rutas se evaluan en el orden declarado), y si tiene <code>ParseUUIDPipe</code> responde 400.',
            'd' => 'Responde 404.',
        ],
        'correcta' => 'c',
        'porque'   => 'Igual que en Express: la ruta con parametro es un comodin y "se come" a las estaticas declaradas despues. Regla: <b>primero las rutas fijas, luego las de <code>:id</code></b>.',
    ],
    'm10' => [
        'texto'    => '¿Que hace <code>@Get(\'/\')</code> en <code>CarsController</code> frente a <code>@Get()</code> a secas en <code>BrandsController</code>?',
        'opciones' => [
            'a' => 'Lo mismo: ambos atienden <code>GET</code> sobre el prefijo del controller (<code>/cars</code> y <code>/brands</code>).',
            'b' => 'El de <code>\'/\'</code> atiende la raiz del servidor.',
            'c' => 'El de <code>\'/\'</code> da error.',
            'd' => 'El <code>@Get()</code> solo funciona con <code>Promise</code>.',
        ],
        'correcta' => 'a',
        'porque'   => 'La barra inicial/final se normaliza. Es solo estilo distinto entre la parte que genero el CLI (<code>@Get()</code>) y la que escribio el profe a mano.',
    ],
    'm11' => [
        'texto'    => 'Si en un handler usas <code>@Res()</code> (el objeto response de Express) en vez de devolver un valor:',
        'opciones' => [
            'a' => 'Nest sigue respondiendo por ti igual.',
            'b' => 'Nest <b>deja de responder automaticamente</b> y tu eres responsable de llamar <code>res.json(...)</code>/<code>res.send()</code>; si no, la peticion queda colgada.',
            'c' => 'Da error de compilacion.',
            'd' => 'Se ignoran los pipes.',
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso en este repo nunca se usa: devolver el valor mantiene el codigo simple y compatible con interceptors y filtros.',
    ],
    'm12' => [
        'texto'    => '¿Por que <code>update</code> y <code>remove</code> del controller reciben <code>@Param(\'id\', ParseUUIDPipe) id: string</code> y el <code>id</code> sigue tipado como <code>string</code>?',
        'opciones' => [
            'a' => 'Porque <code>ParseUUIDPipe</code> convierte el id a un objeto UUID.',
            'b' => 'Porque el tipo de TypeScript se ignora.',
            'c' => 'Porque <code>ParseUUIDPipe</code> solo <b>valida</b> el formato y devuelve el mismo string; a diferencia de <code>ParseIntPipe</code>, que si <b>transforma</b> a number.',
            'd' => 'Porque el id se guarda como string en Postgres.',
        ],
        'correcta' => 'c',
        'porque'   => 'Los pipes hacen dos cosas: <b>validar</b> y/o <b>transformar</b>. <code>ParseIntPipe</code>: "12" &rarr; 12. <code>ParseUUIDPipe</code>: valida y deja el string. (El <code>ParseIntPipe</code> esta importado en <code>brands.controller.ts</code> pero no se usa.)',
    ],
    'm13' => [
        'texto'    => 'En <code>CarsController</code> el metodo <code>getAll</code> declara <code>Promise&lt;Car[]&gt;</code> usando <code>Car</code> de <code>./interfaces/car.model</code>. ¿Que es eso?',
        'opciones' => [
            'a' => 'Una interfaz de TypeScript: solo existe al compilar, no genera codigo ni es la entidad de TypeORM (<code>entities/car.entity.ts</code>).',
            'b' => 'La entidad que crea la tabla.',
            'c' => 'Un DTO que valida la respuesta.',
            'd' => 'Una clase que se instancia en cada peticion.',
        ],
        'correcta' => 'a',
        'porque'   => 'Hay <b>dos</b> <code>Car</code>: la <i>interfaz</i> (solo tipos, ayuda al editor) y la <i>entidad</i> (clase con decoradores que TypeORM convierte en tabla). Que tengan el mismo nombre es confuso: por eso se distinguen por la carpeta de origen.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 3 — Controllers y rutas', 'Decoradores HTTP, @Param/@Body, ParseUUIDPipe, ciclo de vida de la peticion');
?>

<div class="card">
  <h2>A. <code>brands.controller.ts</code> — un CRUD completo en una pagina</h2>

<pre><code>import { Controller, Get, Post, Body, Patch, Param, Delete, ParseIntPipe, <?php hueco(14, 14); ?> } from '@nestjs/common';
import { BrandsService } from './brands.service';
import { CreateBrandDto } from './dto/create-brand.dto';
import { UpdateBrandDto } from './dto/update-brand.dto';

@<?php hueco(1, 11); ?>('<?php hueco(2, 7); ?>')
export class BrandsController {
  constructor(private readonly brandsService: <?php hueco(11, 14); ?>) {}

  @<?php hueco(3, 5); ?>()
  create(@<?php hueco(4, 5); ?>() createBrandDto: CreateBrandDto) {
    return this.brandsService.create(createBrandDto);
  }

  @<?php hueco(5, 4); ?>()
  findAll() {
    return this.brandsService.findAll();
  }

  @Get('<?php hueco(6, 4); ?>')
  findOne(@<?php hueco(7, 6); ?>('id', <?php hueco(8, 14); ?>) id: string) {
    return this.brandsService.findOne(id);
  }

  @<?php hueco(9, 6); ?>(':id')
  <?php firma(12, 92); ?>

    return this.brandsService.update(id, updateBrandDto);
  }

  @<?php hueco(10, 7); ?>(':id')
  remove(@Param('id', ParseUUIDPipe) id: string) {
    return this.brandsService.<?php hueco(13, 7); ?>(id);
  }
}</code></pre>

  <div class="avisoflujo">Cinco metodos = las cinco operaciones del <b>CRUD</b>:
     <code>@Post</code> (Create), <code>@Get</code> (Read), <code>@Patch</code> (Update), <code>@Delete</code> (Delete).
     Cada handler solo llama al service correspondiente.</div>

  <?php reto('brandscontroller'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>cars.controller.ts</code> — el mismo patron, escrito a mano</h2>

<pre><code>@Controller('cars')
export class CarsController {

    constructor(
        private readonly carService: <?php hueco(22, 12); ?>
    ) {}

    @Get('/')
    getAll (): <?php hueco(15, 8); ?>&lt;<?php hueco(16, 4); ?>[]&gt;{
        return this.carService.<?php hueco(17, 7); ?>();
    }

    @Get(':id')
    getById(@Param('id', ParseUUIDPipe) id: string){
        return this.carService.getById(id);
    }

    @Post()
    create(@<?php hueco(18, 5); ?>() car: <?php hueco(19, 13); ?>){
        return this.carService.create(car);
    }

    @<?php hueco(20, 6); ?>(':id')
    update(@Param('id', ParseUUIDPipe) id: string, @Body() car: UpdateCarDto){
        return this.carService.update(id, car);
    }

    @Delete(':id')
    delete(@Param('id', <?php hueco(21, 14); ?>) id: string){
        return this.carService.delete(id);
    }
}</code></pre>

  <div class="nota"><b>PATCH vs PUT.</b> En el repo se usa <code>@Patch</code>: actualizacion <b>parcial</b> (solo los campos
     que mandes). <code>PUT</code> significaria reemplazar el recurso completo. Por eso <code>UpdateCarDto</code> tiene todos los
     campos con <code>@IsOptional()</code>.</div>

  <?php reto('carscontroller'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. La tabla de rutas de toda la API</h2>
  <p>El prefijo lo da el <code>@Controller(...)</code> y el verbo el decorador del metodo. Escribe el verbo y la URL
     (con el prefijo) de cada uno:</p>

<pre><code>BrandsController.findAll        →  <?php hueco(23, 6); ?>  <?php hueco(24, 10); ?>

CarsController.create           →  <?php hueco(25, 6); ?>  <?php hueco(26, 8); ?>

CarsController.update           →  <?php hueco(27, 6); ?>  <?php hueco(28, 12); ?>

CarsController.delete           →  <?php hueco(29, 7); ?>  <?php hueco(30, 12); ?>

UserController.findAll          →  <?php hueco(31, 6); ?>  <?php hueco(32, 8); ?>    (ojo: en singular)

AuthController.loginUser        →  <?php hueco(33, 6); ?>  <?php hueco(34, 14); ?>

AuthController.private2         →  <?php hueco(35, 6); ?>  <?php hueco(36, 16); ?>

AppController.getHello          →  <?php hueco(37, 6); ?>  <?php hueco(38, 3); ?></code></pre>

  <div class="nota">Cuidado con los nombres: <code>brands</code> y <code>cars</code> van en <b>plural</b>, pero
     <code>user</code> y <code>auth</code> en <b>singular</b>. Es una inconsistencia real del repo que causa 404 tontos.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. El viaje de una peticion por Nest</h2>
  <p>Aqui esta el orden <b>oficial</b> del ciclo de vida. Completa la pieza que falta en cada paso:</p>

<pre class="flujo"><code>CLIENTE   (ej. PATCH /cars/3f2c...  con body JSON)
  ↓
<?php hueco(40, 12); ?>          (funciones que corren antes de todo; en este repo no hay ninguno propio)
  ↓
<?php hueco(41, 8); ?>              AuthGuard(), UserRoleGuard  →  pueden responder 401 / 403
  ↓
<?php hueco(42, 14); ?>       (antes del handler; no se usan en este repo)
  ↓
<?php hueco(43, 6); ?>               ValidationPipe (global, sobre el @Body)  +  ParseUUIDPipe (sobre el @Param)  →  400
  ↓
<?php hueco(44, 11); ?> (el metodo con @Patch)
  ↓
<?php hueco(45, 8); ?>  →  Repository  →  PostgreSQL
  ↓
respuesta JSON

Si en CUALQUIER punto se lanza una excepcion:
   una excepcion (NotFoundException, BadRequestException...) → <?php hueco(46, 16); ?> → JSON de error con su status</code></pre>

  <div class="avisoflujo">
     <b>Que aprender de este orden:</b> los <b>guards</b> corren <i>antes</i> que los <b>pipes</b>. Si mandas un token
     invalido y un body invalido a la vez, recibes <b>401</b>, no 400: la autenticacion se comprueba primero.
  </div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Decoradores de parametro y codigos de estado</h2>

<pre><code>@<?php hueco(47, 5); ?>()                       →  req.body
@<?php hueco(48, 6); ?>('id')                   →  req.params.id           (parte variable de la ruta)
@<?php hueco(49, 6); ?>('page')                 →  req.query.page          (?page=2)
@<?php hueco(50, 9); ?>('authorization')        →  req.headers.authorization
@<?php hueco(51, 10); ?>(204)                   →  cambia el codigo de estado por defecto

Estado por defecto:   POST → <?php hueco(52, 4); ?>      GET / PATCH / DELETE → <?php hueco(53, 4); ?></code></pre>

  <div class="nota">Tambien puedes crear los tuyos con <code>createParamDecorator</code>: el repo tiene
     <code>@UserDecorator()</code>, que saca <code>request.user</code> (lo veras en el cuestionario de guards).</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. Variante: el orden de las rutas importa</h2>

<pre><code>@Controller('demo')
export class DemoController {

  @Get(':id')                   // 1º declarada
  findOne(@Param('id') id: string) { ... }

  @Get('<?php hueco(54, 8); ?>')             // 2º declarada  →  GET /demo/profile
  profile() { ... }
}</code></pre>

  <p>Con ese orden, <code>GET /demo/profile</code> entra al primer metodo con <code>id = "profile"</code>. Para arreglarlo hay
     que declarar la ruta fija (<code>profile</code>) <b>antes</b> que la del parametro
     (<code>'<?php hueco(55, 4); ?>'</code>).</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. De memoria: la linea completa</h2>

  <?php linea(66, 'Decorador de clase para que <code>CarsController</code> atienda <code>/cars</code>:'); ?>
  <?php linea(67, 'El constructor de <code>CarsController</code> pidiendo <code>CarsService</code> como <code>carService</code> (una sola linea, con <code>{}</code>):'); ?>
  <?php linea(60, 'Decorador para el metodo que responde a <code>GET</code> con un id en la ruta:'); ?>
  <?php linea(61, 'Firma de <code>findOne</code> en <code>BrandsController</code>, validando el id como UUID (abre la llave):'); ?>
  <?php linea(62, 'Cuerpo de <code>findOne</code>: delegar en el service:'); ?>
  <?php linea(63, 'Firma de <code>create</code> en <code>BrandsController</code> recibiendo el body como <code>createBrandDto</code> (abre la llave):'); ?>
  <?php linea(64, 'Decorador para actualizar parcialmente un recurso por id:'); ?>
  <?php linea(65, 'La firma de <code>getAll</code> en <code>CarsController</code>, con su tipo de retorno (abre la llave):'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); mc('m9'); mc('m10'); mc('m11'); mc('m12'); mc('m13'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('segundo.php', 'cuarto.php');
