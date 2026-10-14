<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 6 — Excepciones y errores: tipos, origen y situaciones
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A. Excepciones incluidas en Nest --- */
    1  => 'BadRequestException',
    2  => 'UnauthorizedException',
    3  => 'ForbiddenException',
    4  => 'NotFoundException',
    5  => 'ConflictException',
    6  => 'InternalServerErrorException',
    7  => 'UnprocessableEntityException',
    8  => 'ServiceUnavailableException',
    9  => 'HttpException',
    10 => '@nestjs/common',

    /* --- B. cars.service.ts → create --- */
    11 => 'async create(car: CreateCarDto): Promise<Car> {',
    12 => 'try',
    13 => 'catch',
    14 => 'code',
    15 => '23505',
    16 => 'BadRequestException',
    17 => 'status',
    18 => '404',
    19 => 'NotFoundException',
    20 => 'InternalServerErrorException',
    21 => 'findOne',

    /* --- C. Sintoma → codigo y origen --- */
    22 => '400',
    23 => 'ParseUUIDPipe',
    24 => '400',
    25 => 'ValidationPipe',
    26 => '401',
    27 => ['AuthGuard', 'AuthGuard()', 'el AuthGuard', 'passport'],
    28 => '403',
    29 => ['UserRoleGuard', 'user-role.guard', 'el UserRoleGuard'],
    30 => '404',
    31 => ['BrandsService', 'brands.service', 'service', 'el service'],
    32 => '409',
    33 => ['UserService', 'user.service', 'service', 'el service'],
    34 => '404',
    35 => ['Nest', 'el router', 'router', 'el framework', 'framework', 'nest router'],
    36 => '500',
    37 => 'Internal server error',

    /* --- D. Forma de los JSON de error --- */
    38 => 'Forbidden',
    39 => 'Internal server error',
    40 => 'Unauthorized',

    /* --- E. Fases: cuando ocurre cada error --- */
    41 => ['arranque', 'boot', 'inicio', 'bootstrap'],
    42 => ['compilacion', 'compilación', 'build', 'tsc'],
    43 => ['arranque', 'boot', 'inicio', 'bootstrap'],
    44 => ['arranque', 'boot', 'inicio', 'bootstrap'],
    45 => ['peticion', 'petición', 'request', 'ejecucion', 'ejecución', 'runtime'],
    46 => ['peticion', 'petición', 'request', 'ejecucion', 'ejecución', 'runtime'],

    /* --- F. Lineas completas --- */
    50 => "throw new NotFoundException(`brand with id \${id} not found`);",
    51 => "throw new ConflictException('Email already in use');",
    52 => "throw new UnauthorizedException('Invalid Credentials');",
    53 => 'throw new ForbiddenException("user doesn\'t have required role");',
    54 => 'throw new BadRequestException("user not found");',
    55 => "throw new InternalServerErrorException('error creating car');",
    56 => 'if (error.code == 23505) {',
    57 => 'if (brand === null)',
];

$RETOS = [

'carscreate' => [
    'titulo' => '<code>CarsService.create</code> (el metodo completo)',
    'huecos' => [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21],
    'codigo' => <<<'EOT'
async create(car: CreateCarDto): Promise<Car> {
    try {
        const brand = await this.brandService.findOne(car.brand);
        const carNew = this.carRepository.create(car);
        return await this.carRepository.save(carNew)
    } catch (error: any) {

        if (error.code == 23505) {
            throw new BadRequestException('car already exists')
        }
        if(error.status==404)
            throw new NotFoundException(`brand with id ${car.brand} not found`);

        throw new InternalServerErrorException('error creating car');
    }
}
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Cual es la diferencia entre lanzar <code>new NotFoundException(\'x\')</code> y lanzar <code>new Error(\'x\')</code> desde un service?',
        'opciones' => [
            'a' => 'Ninguna: los dos dan 404.',
            'b' => 'Los dos dan 500.',
            'c' => 'La primera es una <b>HttpException</b>: Nest la reconoce y responde con <b>su</b> codigo (404) y su mensaje. La segunda es un error "inesperado": Nest responde <code>500 Internal server error</code> generico y deja el detalle solo en la consola del servidor.',
            'd' => 'La primera detiene el servidor.',
        ],
        'correcta' => 'c',
        'porque'   => 'El filtro de excepciones por defecto de Nest distingue: si es <code>HttpException</code> (o subclase) usa su status y cuerpo; si es cualquier otra cosa, responde <code>{"statusCode":500,"message":"Internal server error"}</code>. Asi no filtra detalles internos al cliente.',
    ],
    'm2' => [
        'texto'    => 'En un service escribes <code>return new NotFoundException(\'no existe\');</code> (con <code>return</code> en vez de <code>throw</code>). ¿Que recibe el cliente?',
        'opciones' => [
            'a' => '<code>404</code>, igual que con <code>throw</code>.',
            'b' => '<code>500</code>.',
            'c' => '<b>200</b> (o 201 si es POST) con el objeto de la excepcion serializado como JSON, porque nada se lanzo: solo se <i>devolvio</i> un objeto.',
            'd' => 'Nada, la peticion se cuelga.',
        ],
        'correcta' => 'c',
        'porque'   => 'Una excepcion solo actua si se <b>lanza</b> (<code>throw</code>). Es un error frecuente de principiante y muy dificil de ver: la API "funciona" pero con un status equivocado.',
    ],
    'm3' => [
        'texto'    => '<code>POST /cars</code> con un <code>brand</code> (UUID valido) que <b>no existe</b>. Siguiendo <code>CarsService.create</code>, ¿que respuesta sale y por que camino?',
        'opciones' => [
            'a' => '500: la relacion falla al guardar.',
            'b' => '201 con el coche creado sin marca.',
            'c' => '400 por <code>error.code == 23505</code>.',
            'd' => '<b>404</b> <code>brand with id ... not found</code>: <code>brandService.findOne</code> lanza <code>NotFoundException</code> dentro del <code>try</code>, el <code>catch</code> la atrapa (tiene <code>status == 404</code>) y lanza una nueva con el mensaje del coche.',
        ],
        'correcta' => 'd',
        'porque'   => 'Detalle fino: la excepcion 404 de <code>BrandsService</code> se lanza <b>dentro del try</b> de <code>CarsService</code>, asi que su propio <code>catch</code> la ve. Por eso pregunta por <code>error.status==404</code>. Si no lo hiciera, caeria al <code>InternalServerErrorException</code> final.',
    ],
    'm4' => [
        'texto'    => '<code>POST /cars</code> con un <code>model</code> que ya existe (columna <code>unique</code>). ¿Cual es el resultado?',
        'opciones' => [
            'a' => '<b>400</b> <code>car already exists</code>: Postgres lanza 23505 al guardar y el catch lo traduce a <code>BadRequestException</code>.',
            'b' => '409 Conflict automatico.',
            'c' => '201, se pisa el anterior.',
            'd' => '404.',
        ],
        'correcta' => 'a',
        'porque'   => 'Para el mismo tipo de situacion (duplicado), <code>UserService.create</code> usa <b>409 ConflictException</b> y <code>BrandsService/CarsService</code> usan <b>400</b>. Semanticamente 409 es mas preciso; es una inconsistencia entre modulos.',
    ],
    'm5' => [
        'texto'    => '¿Diferencia entre <b>401</b> y <b>403</b>?',
        'opciones' => [
            'a' => 'Son sinonimos.',
            'b' => '401 = no se sabe <b>quien eres</b> (sin token, token invalido o expirado). 403 = se sabe quien eres pero <b>no tienes permiso</b> (por ejemplo, rol insuficiente).',
            'c' => '401 es error del servidor, 403 del cliente.',
            'd' => '403 = no se sabe quien eres; 401 = no tienes permiso.',
        ],
        'correcta' => 'b',
        'porque'   => 'En el repo: <code>AuthGuard()</code> (Passport JWT) da 401; <code>UserRoleGuard</code> da 403 con <code>ForbiddenException("user doesn\'t have required role")</code>. Autenticacion &rarr; 401; autorizacion &rarr; 403.',
    ],
    'm6' => [
        'texto'    => 'Llamas <code>GET /marcas</code> (la ruta no existe). ¿Que responde Nest?',
        'opciones' => [
            'a' => '<code>404</code> con <code>{"message":"Cannot GET /marcas","error":"Not Found","statusCode":404}</code>: el propio router lanza un <code>NotFoundException</code>.',
            'b' => '500.',
            'c' => '200 con el HTML de la pagina de inicio.',
            'd' => 'Nada, se cuelga.',
        ],
        'correcta' => 'a',
        'porque'   => 'Tambien pasa con el verbo equivocado: <code>DELETE /brands</code> (sin id) da <code>Cannot DELETE /brands</code>. Es un 404 "de ruta", distinto del 404 "de recurso" que lanzan los services.',
    ],
    'm7' => [
        'texto'    => '¿Por que un <code>500</code> muestra solo <code>"Internal server error"</code> y no el error real de Postgres?',
        'opciones' => [
            'a' => 'Es un fallo de Nest.',
            'b' => 'Por seguridad: el detalle (SQL, nombres de tablas...) no debe llegar al cliente. Nest lo <b>escribe en el log</b> del servidor (<code>ERROR [ExceptionsHandler]</code>) y responde un mensaje generico.',
            'c' => 'Porque TypeORM oculta los errores.',
            'd' => 'Porque el mensaje real es demasiado largo.',
        ],
        'correcta' => 'b',
        'porque'   => 'Cuando aparezca un 500 en el cliente, la pista esta en <b>la terminal donde corre <code>pnpm run start:dev</code></b>, no en la respuesta.',
    ],
    'm8' => [
        'texto'    => 'Arrancas la app y ves <code>Nest can\'t resolve dependencies of the CarsService (CarRepository, ?)</code>. ¿En que <b>fase</b> ocurre y que significa el <code>?</code>?',
        'opciones' => [
            'a' => 'En una peticion. El <code>?</code> es el id.',
            'b' => 'En la compilacion. El <code>?</code> es un tipo.',
            'c' => 'En el <b>arranque</b> (al construir el grafo de modulos). El <code>?</code> marca <b>la dependencia que no encontro</b>: aqui la 2ª, <code>BrandsService</code>.',
            'd' => 'En el arranque. El <code>?</code> es un parametro opcional.',
        ],
        'correcta' => 'c',
        'porque'   => 'El mensaje ademas dice el indice (<code>[1]</code>) y en que modulo falta. Causas tipicas: falta <code>imports: [BrandsModule]</code> o falta <code>exports: [BrandsService]</code>.',
    ],
    'm9' => [
        'texto'    => 'Arrancas la app con <b>Postgres apagado</b>. ¿Que tipo de error es?',
        'opciones' => [
            'a' => 'Un error de <b>arranque</b>: TypeORM no puede conectarse (<code>ECONNREFUSED</code>); la app no llega a atender peticiones.',
            'b' => 'Un 500 en cada peticion.',
            'c' => 'Un error de compilacion de TypeScript.',
            'd' => 'Un 404 en todas las rutas.',
        ],
        'correcta' => 'a',
        'porque'   => 'Los errores de arranque (dependencias, BD, variables de entorno) son <b>los mas faciles de diagnosticar</b> porque ocurren de inmediato y el mensaje es claro. Los mas peligrosos son los silenciosos: los que <i>no</i> dan error.',
    ],
    'm10' => [
        'texto'    => '<code>JWT_SECRET</code> no esta definido en el <code>.env</code>. En <code>JwtStrategy</code> el <code>secretOrKey</code> queda <code>\'\'</code>. ¿Que pasa?',
        'opciones' => [
            'a' => 'La app arranca, pero cada login da 401.',
            'b' => 'La app arranca sin problema y firma con una clave vacia.',
            'c' => 'La app <b>falla al arrancar</b>: <code>passport-jwt</code> exige una clave no vacia (<i>JwtStrategy requires a secret or key</i>).',
            'd' => 'Nest genera una clave aleatoria.',
        ],
        'correcta' => 'c',
        'porque'   => 'Bien: es mejor que falle ruidosamente al arrancar a que firme tokens con una clave vacia. Ojo: en <code>auth.module.ts</code> el <code>JwtModule</code> usa <code>... as string | \'secret\'</code>, que es solo un <b>tipo</b> de TypeScript, no un valor por defecto real.',
    ],
    'm11' => [
        'texto'    => 'En TypeScript con <code>strict: true</code>, ¿por que el profe escribe <code>catch (error: any)</code> y luego usa <code>error.code</code>?',
        'opciones' => [
            'a' => 'Porque sin <code>any</code> el <code>catch</code> no funciona.',
            'b' => 'Porque con <code>strict</code> la variable del <code>catch</code> es <code>unknown</code> y no se pueden leer sus propiedades sin comprobar el tipo; <code>: any</code> desactiva esa comprobacion.',
            'c' => 'Porque <code>error.code</code> solo existe en Node.',
            'd' => 'Porque TypeORM lo obliga.',
        ],
        'correcta' => 'b',
        'porque'   => 'Lo mas seguro seria estrechar el tipo: <code>if (error instanceof QueryFailedError)</code> o comprobar <code>typeof error === \'object\'</code>. El <code>any</code> es un atajo comodo pero menos seguro. (La regla <code>no-explicit-any</code> esta apagada en <code>oxlint.json</code> precisamente por esto.)',
    ],
    'm12' => [
        'texto'    => 'Un <code>try { ... throw new UnauthorizedException() ... } catch (error) { }</code> con el <code>catch</code> vacio, dentro de <code>AuthService.loginUser</code>. ¿Que recibe el cliente con credenciales <b>incorrectas</b>?',
        'opciones' => [
            'a' => '401 Unauthorized.',
            'b' => '500.',
            'c' => '<b>201 Created con cuerpo vacio</b>: la excepcion se lanza y el <code>catch</code> vacio la <b>traga</b>; el metodo termina devolviendo <code>undefined</code>, y un POST sin error responde 201.',
            'd' => '400.',
        ],
        'correcta' => 'c',
        'porque'   => 'El peor tipo de error: uno que <b>no se ve</b>. El login "responde" pero no dice ni que fallo ni que funciono. Solucion: quitar el <code>try/catch</code> (dejar que la excepcion suba) o hacer <code>throw error</code> dentro del catch.',
    ],
    'm13' => [
        'texto'    => '¿Cual de estos es un error de <b>compilacion</b> y no de ejecucion?',
        'opciones' => [
            'a' => '<code>error TS2345: Argument of type \'string\' is not assignable to parameter of type \'number\'</code> al hacer <code>nest start</code>.',
            'b' => '<code>ECONNREFUSED 127.0.0.1:5432</code>.',
            'c' => '<code>404 Not Found</code> en <code>GET /brands/&lt;uuid&gt;</code>.',
            'd' => '<code>23505 duplicate key value</code>.',
        ],
        'correcta' => 'a',
        'porque'   => 'Los <code>TSxxxx</code> los detecta el compilador de TypeScript <b>antes</b> de ejecutar nada. Los otros tres ocurren cuando la app ya esta corriendo (conexion, peticion, base de datos).',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 6 — Excepciones y errores', 'HttpException, tipos de error, origen de cada codigo, fases y casos silenciosos');
?>

<div class="card">
  <h2>A. Las excepciones incluidas en <code>@nestjs/common</code></h2>
  <p>Todas nacen de la misma clase base y cada una fija un codigo HTTP:</p>

<pre><code>400  →  <?php hueco(1, 20); ?>          (datos incorrectos)
401  →  <?php hueco(2, 22); ?>        (no se sabe quien eres)
403  →  <?php hueco(3, 18); ?>          (no tienes permiso)
404  →  <?php hueco(4, 18); ?>          (no existe)
409  →  <?php hueco(5, 18); ?>          (conflicto: ya existe)
422  →  <?php hueco(7, 28); ?>     (sintaxis ok, pero no procesable)
500  →  <?php hueco(6, 28); ?>     (error del servidor)
503  →  <?php hueco(8, 26); ?>       (servicio no disponible)

Clase base de todas:  <?php hueco(9, 13); ?>      (paquete: <?php hueco(10, 15); ?>)</code></pre>

  <div class="nota">En el repo se usan seis: <code>BadRequest</code>, <code>Unauthorized</code>, <code>Forbidden</code>, <code>NotFound</code>,
     <code>Conflict</code> e <code>InternalServerError</code>. Las otras dos las verias en APIs mas grandes.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>cars.service.ts</code> → <code>create</code>: el manejo de errores mas completo del repo</h2>

<pre><code><?php firma(11, 56); ?>

    <?php hueco(12, 4); ?> {
        const brand = await this.brandService.<?php hueco(21, 8); ?>(car.brand);
        const carNew = this.carRepository.create(car);
        return await this.carRepository.save(carNew)
    } <?php hueco(13, 6); ?> (error: any) {

        if (error.<?php hueco(14, 5); ?> == <?php hueco(15, 6); ?>) {
            throw new <?php hueco(16, 20); ?>('car already exists')
        }
        if(error.<?php hueco(17, 7); ?>==<?php hueco(18, 4); ?>)
            throw new <?php hueco(19, 18); ?>(`brand with id ${car.brand} not found`);

        throw new <?php hueco(20, 28); ?>('error creating car');
    }
}</code></pre>

  <div class="avisoflujo"><b>Tres casos, tres salidas:</b> (1) el <code>findOne</code> de la marca falla con 404 →
     404 "brand ... not found"; (2) el <code>save</code> falla con 23505 → 400 "car already exists"; (3) cualquier otra cosa →
     500 "error creating car". Ojo que el <code>const brand</code> se declara y <b>nunca se usa</b>: solo sirve para
     que <code>findOne</code> lance el 404 si la marca no existe.</div>

  <?php reto('carscreate'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. Del sintoma al culpable</h2>
  <p>Escribe el <b>codigo</b> y <b>que pieza del codigo</b> lo produce:</p>

<pre><code>GET  /cars/abc                                    →  <?php hueco(22, 4); ?>   lo lanza:  <?php hueco(23, 14); ?>

POST /brands  {"name":"Toyota","color":"rojo"}     →  <?php hueco(24, 4); ?>   lo lanza:  <?php hueco(25, 15); ?>

GET  /auth/private1  (sin header Authorization)   →  <?php hueco(26, 4); ?>   lo lanza:  <?php hueco(27, 10); ?>

GET  /auth/private3  (token de rol "user")        →  <?php hueco(28, 4); ?>   lo lanza:  <?php hueco(29, 14); ?>

GET  /brands/&lt;uuid que no existe&gt;                  →  <?php hueco(30, 4); ?>   lo lanza:  <?php hueco(31, 14); ?>

POST /user   (email ya registrado)                →  <?php hueco(32, 4); ?>   lo lanza:  <?php hueco(33, 12); ?>

GET  /marcas  (ruta inexistente)                  →  <?php hueco(34, 4); ?>   lo lanza:  <?php hueco(35, 8); ?>

un service hace  throw new Error('boom')          →  <?php hueco(36, 4); ?>   con el mensaje:  "<?php hueco(37, 21); ?>"</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. La forma del JSON de error</h2>

<pre class="flujo"><code>403  (ForbiddenException("user doesn't have required role"))
{ "message": "user doesn't have required role", "error": "<?php hueco(38, 9); ?>", "statusCode": 403 }

401  (AuthGuard, sin token)
{ "message": "<?php hueco(40, 12); ?>", "statusCode": 401 }

500  (un Error cualquiera)
{ "statusCode": 500, "message": "<?php hueco(39, 21); ?>" }</code></pre>

  <div class="nota">El campo <code>error</code> es el nombre del estado HTTP y solo aparece cuando lanzas la excepcion con
     un <b>mensaje de texto</b>. El del 401 de Passport llega con solo <code>message</code> y <code>statusCode</code>.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. ¿En que fase ocurre cada error?</h2>
  <p>Los errores no son todos iguales: dependen de <b>cuando</b> aparecen. Escribe <code>compilacion</code>,
     <code>arranque</code> o <code>peticion</code> para cada uno:</p>

<pre><code>Nest can't resolve dependencies of the CarsService (?, BrandsService)      →  <?php hueco(41, 12); ?>

error TS2322: Type 'number' is not assignable to type 'string'             →  <?php hueco(42, 12); ?>

connect ECONNREFUSED 127.0.0.1:5432                                        →  <?php hueco(43, 12); ?>

TypeError: JwtStrategy requires a secret or key                            →  <?php hueco(44, 12); ?>

400 Bad Request al mandar year: "2020" como string                         →  <?php hueco(45, 12); ?>

500 por "duplicate key value violates unique constraint" sin try/catch     →  <?php hueco(46, 12); ?></code></pre>

  <div class="avisoflujo">
     <b>Regla para depurar:</b> <b>compilacion</b> → mira el mensaje <code>TSxxxx</code> y el archivo/linea.
     <b>Arranque</b> → mira los <code>imports/exports/providers</code> y el <code>.env</code>.
     <b>Peticion</b> → mira el codigo HTTP: 4xx = culpa de la peticion (o de una validacion), 5xx = revisa la terminal del servidor.
  </div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. De memoria: la linea completa</h2>

  <?php linea(50, 'Lanzar 404 con un mensaje que incluya el id (plantilla con backticks; con <code>;</code>):'); ?>
  <?php linea(51, 'Lanzar el error de conflicto cuando el email ya esta en uso (mensaje <code>Email already in use</code>):'); ?>
  <?php linea(52, 'Lanzar el error de credenciales incorrectas (mensaje <code>Invalid Credentials</code>):'); ?>
  <?php linea(53, 'Lanzar el error de rol insuficiente (mensaje <code>user doesn\'t have required role</code>):'); ?>
  <?php linea(54, 'En el guard: lanzar 400 cuando no hay usuario en la request (mensaje <code>user not found</code>):'); ?>
  <?php linea(55, 'Ultimo recurso de <code>CarsService.create</code>: lanzar el 500 (mensaje <code>error creating car</code>):'); ?>
  <?php linea(56, 'Comprobar si el error de Postgres es el de unicidad (con <code>==</code> y la llave abierta):'); ?>
  <?php linea(57, 'Comprobar si la busqueda no encontro nada (variable <code>brand</code>):'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); mc('m9'); mc('m10'); mc('m11'); mc('m12'); mc('m13'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('quinto.php', 'septimo.php');
