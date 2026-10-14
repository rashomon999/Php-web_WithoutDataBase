<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 9 — El detective: bugs reales y casos borde del repo
   (examen integrador: todo lo anterior, aplicado a codigo que falla)
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A. GET /user/:id busca por email --- */
    1  => 'findById',
    2  => 'findOne',
    3  => 'email',

    /* --- B. catch vacio en el login --- */
    4  => 'throw',
    5  => 'error',

    /* --- C. hash de la clave en las respuestas --- */
    6  => 'select',
    7  => 'false',

    /* --- D. expiresIn con | en vez de || --- */
    8  => '600',
    9  => '600',
    10 => '3672',
    11 => '600',
    12 => '||',

    /* --- E. condicion muerta de affected --- */
    13 => '===',
    14 => '0',

    /* --- F. stubs sin implementar --- */
    15 => '200',
    16 => ['texto', 'string', 'un string', 'text', 'cadena', 'un texto'],

    /* --- G. LoginUserDto: email --- */
    17 => 'IsEmail',

    /* --- H. Integrador: ¿que responde la API? --- */
    20 => '201',
    21 => '409',
    22 => '400',
    23 => '201',
    24 => '201',
    25 => '400',
    26 => '200',
    27 => '401',
    28 => '200',
    29 => '400',
    30 => '404',
    31 => '200',
    32 => '401',
    33 => '403',

    /* --- I. Lineas completas: las correcciones --- */
    40 => '@Column({select: false})',
    41 => 'return this.userService.findById(id);',
    42 => '@IsEmail()',
    43 => "expiresIn: configService.get('JWT_EXPIRES_IN') || 600",
    44 => 'if (result.affected === 0)',
    45 => "throw new UnauthorizedException('Invalid Credentials');",
];

$RETOS = [

'loginfix' => [
    'titulo' => '<code>loginUser</code> <b>corregido</b> (sin el <code>try/catch</code> que traga el 401)',
    'huecos' => [4, 5],
    'codigo' => <<<'EOT'
async loginUser(loginUserDto: LoginUserDto){
    const {password, email} = loginUserDto;
    const user = await this.userService.findOne(email);

    if (!user || !bcrypt.compareSync(password, user.password))
        throw new UnauthorizedException('Invalid Credentials');

    return {
        user_id: user.id,
        email: user.email,
        roles: user.roles,
        token: this.jwtService.sign({user_id: user.id})
    }
}
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '<b>Bug 1.</b> <code>GET /user/3f2c8f0a-1b4d-4e6a-9c1d-2a7b5e9d1c11</code> con un usuario que <b>si existe</b> con ese id. El controller hace <code>this.userService.findOne(id)</code> y <code>UserService.findOne(email)</code> busca con <code>where: {email}</code>. ¿Que responde?',
        'opciones' => [
            'a' => '200 con el usuario.',
            'b' => '<b>200 con el cuerpo vacio</b>: busca un usuario cuyo <b>email</b> sea ese UUID, no lo encuentra (<code>null</code>) y Nest no convierte <code>null</code> en 404.',
            'c' => '404 <code>user with id ... not found</code>.',
            'd' => '400 del ParseUUIDPipe.',
        ],
        'correcta' => 'b',
        'porque'   => 'El nombre <code>findOne</code> engaña: en <code>BrandsService</code> busca por id, aqui busca por email. La correccion es llamar a <code>findById</code>, que si lanza el <code>NotFoundException</code>. Es un bug de <b>nombres inconsistentes entre servicios</b>.',
    ],
    'm2' => [
        'texto'    => '<b>Bug 2.</b> Tras quitar el <code>try/catch</code> de <code>loginUser</code>, un login con clave incorrecta responde:',
        'opciones' => [
            'a' => '201 con cuerpo vacio, como antes.',
            'b' => '500.',
            'c' => '<b>401</b> <code>Invalid Credentials</code>: la excepcion sube libre hasta el filtro de Nest, que la traduce a su codigo.',
            'd' => '400.',
        ],
        'correcta' => 'c',
        'porque'   => 'Regla: <b>no captures un error si no vas a hacer algo util con el</b>. Un <code>catch</code> que no relanza, no registra y no traduce solo esconde el problema.',
    ],
    'm3' => [
        'texto'    => '<b>Bug 3.</b> <code>POST /user</code> devuelve el usuario completo, incluido el campo <code>password</code> (el <b>hash</b>), y <code>GET /user</code> lo devuelve de todos los usuarios. ¿Cual es el arreglo mas directo en la entidad y que efecto colateral tendria?',
        'opciones' => [
            'a' => 'Poner <code>@Column({select: false})</code> en <code>password</code>. Efecto: <code>findOne({where: {email}})</code> ya <b>no trae</b> el hash, asi que <code>user.password</code> queda <code>undefined</code> en el login y hay que pedirlo explicitamente (<code>select</code>/<code>addSelect</code>).',
            'b' => 'Borrar la columna <code>password</code>. Efecto: ninguno.',
            'c' => 'Poner <code>unique: true</code>. Efecto: ninguno.',
            'd' => 'Poner <code>nullable: true</code>. Efecto: el hash se oculta.',
        ],
        'correcta' => 'a',
        'porque'   => 'Es el mismo problema (y la misma solucion) que en el proyecto Express, donde <code>findByEmail</code> pedia el password explicitamente con <code>{password}</code>. Otra opcion es un <code>@Exclude()</code> con <code>ClassSerializerInterceptor</code>.',
    ],
    'm4' => [
        'texto'    => '<b>Bug 3b (encadenado).</b> Aplicas <code>select: false</code> a <code>password</code> pero <b>no</b> cambias <code>findOne</code>. Con el <code>try/catch</code> vacio original, ¿que ve un usuario que hace login con credenciales <b>correctas</b>?',
        'opciones' => [
            'a' => '201 con el token.',
            'b' => '<b>201 con cuerpo vacio</b>: <code>bcrypt.compareSync(password, undefined)</code> lanza <i>data and hash arguments required</i>, el <code>catch</code> vacio lo traga y nunca hay token. Nadie puede iniciar sesion y <b>ningun error</b> lo delata.',
            'c' => '401.',
            'd' => '500.',
        ],
        'correcta' => 'b',
        'porque'   => 'Este es el ejemplo perfecto de <b>por que el catch vacio es peligroso</b>: un cambio inocente en otra capa rompe el login y el sistema responde "todo bien" sin cuerpo. Sin el <code>catch</code>, veriamos un 500 con el stack en consola y lo arreglariamos en un minuto.',
    ],
    'm5' => [
        'texto'    => '<b>Bug 4.</b> En <code>JwtStrategy.validate</code>, el <code>if(!user) throw new UnauthorizedException(...)</code> viene despues de <code>await this.userService.findById(id)</code>. ¿Se llega alguna vez a ese <code>throw</code>?',
        'opciones' => [
            'a' => 'Si, cuando el usuario fue borrado.',
            'b' => 'Si, cuando el token expiro.',
            'c' => 'Si, siempre.',
            'd' => '<b>Nunca</b>: <code>findById</code> ya lanza <code>NotFoundException</code> cuando no encuentra al usuario, asi que el codigo <b>muere antes</b> (y responde 404, no 401). El <code>if</code> es codigo inalcanzable.',
        ],
        'correcta' => 'd',
        'porque'   => 'Dos convenciones mezcladas: <code>findOne(email)</code> devuelve <code>null</code> y <code>findById</code> lanza. El <code>if(!user)</code> asume la primera pero se usa la segunda. Solucion: capturar el <code>NotFoundException</code> y lanzar 401, o que <code>findById</code> devuelva <code>null</code>.',
    ],
    'm6' => [
        'texto'    => '<b>Bug 5.</b> ¿Que es <code>configService.get(\'JWT_EXPIRES_IN\') | 600</code> y por que esta mal?',
        'opciones' => [
            'a' => 'Es un "o" logico: usa 600 si la variable no existe. Esta bien.',
            'b' => 'Es el <b>OR bit a bit</b> (una sola barra): convierte ambos lados a enteros de 32 bits y mezcla sus bits. Con <code>undefined</code> da 600 (por casualidad), pero con <code>\'3600\'</code> da <b>3672</b> y con <code>\'1h\'</code> da 600.',
            'c' => 'Es una tuberia de Nest.',
            'd' => 'Da error de compilacion.',
        ],
        'correcta' => 'b',
        'porque'   => 'Dos barras (<code>||</code>) = valor por defecto; una (<code>|</code>) = operacion de bits. Y ojo: en <code>app.module.ts</code> el profe si escribe bien <code>process.env.DB_PORT || \'5432\'</code>. TypeScript no avisa porque <code>get()</code> devuelve <code>any</code>.',
    ],
    'm7' => [
        'texto'    => '<b>Bug 6.</b> <code>user.entity.ts</code> declara <code>roles: string</code> con <code>@Column(\'varchar\', {array: true, ...})</code>. Si de verdad fuera un <b>string</b> <code>\'admin\'</code>, ¿que haria <code>for (const role of user.roles)</code> en el guard?',
        'opciones' => [
            'a' => 'Recorreria el string <b>caracter a caracter</b> (<code>\'a\',\'d\',\'m\',\'i\',\'n\'</code>) y ninguno estaria en <code>[\'admin\',\'editor\']</code>: 403 para todos.',
            'b' => 'Iteraria una vez con <code>\'admin\'</code>.',
            'c' => 'Lanzaria un error de tipo.',
            'd' => 'Funcionaria igual.',
        ],
        'correcta' => 'a',
        'porque'   => 'Hoy funciona porque en ejecucion Postgres/TypeORM entregan un <b>arreglo</b>. Pero el tipo <code>string</code> es <b>mentira</b> (deberia ser <code>string[]</code> o <code>AppRoles[]</code>) y el compilador no puede ayudarte. Igual pasa con <code>Car.brand: string</code>, que en realidad es una relacion a <code>Brand</code>.',
    ],
    'm8' => [
        'texto'    => '<b>Bug 7.</b> <code>UserService.update</code> y <code>remove</code> hacen <code>return `This action updates a #${id} user`</code>. ¿Que ocurre con <code>DELETE /user/&lt;uuid&gt;</code>?',
        'opciones' => [
            'a' => 'Borra el usuario y responde 200.',
            'b' => '404.',
            'c' => 'Responde <b>200 con un texto</b> ("This action removes a #... user") <b>sin borrar nada</b>: es el andamiaje que genera <code>nest g resource</code> y quedo sin implementar.',
            'd' => '500.',
        ],
        'correcta' => 'c',
        'porque'   => 'Un endpoint que responde 200 sin hacer nada es peor que un 501 Not Implemented: el cliente cree que funciono. Al generar un recurso con el CLI hay que <b>revisar todo lo que deja a medias</b>.',
    ],
    'm9' => [
        'texto'    => '<b>Bug 8.</b> Un usuario con email <code>a@b.co</code> (6 caracteres, totalmente valido) intenta hacer login. <code>LoginUserDto.email</code> tiene <code>@IsString()</code> y <code>@Length(8,50)</code>. ¿Resultado?',
        'opciones' => [
            'a' => '<b>400</b>: falla el <code>@Length(8,50)</code> aunque el email sea legitimo; un <b>falso negativo</b> por usar una regla de longitud donde correspondia <code>@IsEmail()</code>.',
            'b' => '401.',
            'c' => '201 con token.',
            'd' => '500.',
        ],
        'correcta' => 'a',
        'porque'   => 'Y al reves: <code>"hola hola hola"</code> (13 caracteres, sin arroba) <b>pasa</b> la validacion y llega hasta la busqueda en BD. La regla de negocio ("es un email") merece <code>@IsEmail()</code>.',
    ],
    'm10' => [
        'texto'    => '¿Cual de estas <b>NO</b> es un problema real del repo?',
        'opciones' => [
            'a' => 'Las credenciales de pgAdmin estan escritas en <code>docker-compose.yaml</code> y viajan en git.',
            'b' => 'No hay <code>ValidationPipe</code> global, asi que los DTOs no se validan.',
            'c' => '<code>synchronize: true</code> en <code>TypeOrmModule.forRoot</code>, peligroso en produccion.',
            'd' => 'Las respuestas de <code>POST /user</code> y <code>GET /user</code> incluyen el hash de la clave.',
        ],
        'correcta' => 'b',
        'porque'   => 'Si hay un <code>ValidationPipe</code> global en <code>main.ts</code>, con <code>whitelist</code> y <code>forbidNonWhitelisted</code>. Las otras tres son <b>problemas reales</b>: secretos en el repositorio, sincronizacion automatica de esquema y fuga del hash.',
    ],
    'm11' => [
        'texto'    => '¿Cual de estas cosas es <b>solo desorden</b> (no cambia el comportamiento)?',
        'opciones' => [
            'a' => 'El <code>catch</code> vacio del login.',
            'b' => 'El <code>|</code> de <code>expiresIn</code>.',
            'c' => '<code>const brand = await this.brandService.findOne(...)</code> en <code>CarsService.create</code> (variable nunca usada), <code>ParseIntPipe</code> y <code>minLength</code> importados sin usar.',
            'd' => '<code>findById</code> lanzando 404 dentro de la estrategia.',
        ],
        'correcta' => 'c',
        'porque'   => 'Variables e imports sin uso los marca el linter (<code>oxlint</code>) y no alteran nada. <b>Ojo:</b> el <code>const brand</code> <i>si</i> hace algo util indirectamente: la <b>llamada</b> a <code>findOne</code> es la que lanza el 404; lo inutil es guardar el resultado.',
    ],
    'm12' => [
        'texto'    => '<b>Bug 9.</b> <code>UserRoleGuard</code> tiene un <code>console.log(validRoles)</code> justo antes del <code>throw new ForbiddenException</code>. ¿Que hay que hacer con el?',
        'opciones' => [
            'a' => 'Dejarlo, ayuda en produccion.',
            'b' => 'Quitarlo: es <b>depuracion olvidada</b>. En produccion se usaria el <code>Logger</code> de Nest (<code>new Logger(UserRoleGuard.name)</code>) con el nivel adecuado.',
            'c' => 'Moverlo al controller.',
            'd' => 'Cambiarlo por <code>alert()</code>.',
        ],
        'correcta' => 'b',
        'porque'   => 'Igual el <code>console.log(user)</code> del endpoint <code>decorator</code>: en un servidor real esos logs pueden acabar mostrando datos personales.',
    ],
    'm13' => [
        'texto'    => 'Ordena de <b>mas a menos grave</b> los tres bugs siguientes: (1) el hash de la clave sale en las respuestas; (2) <code>GET /user/:id</code> busca por email; (3) el <code>const brand</code> sin usar.',
        'opciones' => [
            'a' => '(3), (2), (1)',
            'b' => '(2), (3), (1)',
            'c' => '(1), (3), (2)',
            'd' => '(1), (2), (3): la fuga de datos sensibles es de seguridad; el endpoint que no funciona rompe una funcion; la variable sin usar es solo estetica.',
        ],
        'correcta' => 'd',
        'porque'   => 'Criterio habitual: <b>seguridad &gt; corrección funcional &gt; calidad de código</b>.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 9 — El detective', 'Bugs reales, casos borde y examen integrador de todo el repo');
?>

<div class="card">
  <h2>A. Bug 1 — <code>GET /user/:id</code> busca por el campo equivocado</h2>

<pre><code>// user.controller.ts
@Get(':id')
findOne(@Param('id', ParseUUIDPipe) id: string) {
  return this.userService.<?php hueco(2, 8); ?>(id);          // ← lo que llama HOY (busca por <?php hueco(3, 6); ?>)
}

// user.service.ts
async findOne(email: string): Promise&lt;User | null&gt; { ... where: {email} ... }     // devuelve null si no hay
async findById(id: string): Promise&lt;User&gt;          { ... throw new NotFoundException ... }   // lanza 404</code></pre>

  <p>La correccion: en el controller debe llamarse a <code><?php hueco(1, 8); ?></code>, que si busca por <code>id</code> y lanza 404.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. Bug 2 — el <code>catch</code> vacio del login</h2>

<pre><code>async loginUser(loginUserDto: LoginUserDto){
    try {
        ...
        throw new UnauthorizedException('Invalid Credentials');
        ...
    } catch (error) {
        <span style="color:#8b98a8">// (vacio: traga el 401)</span>
    }
}

// arreglo minimo si quisieras conservar el try/catch:
    } catch (error) {
        <?php hueco(4, 6); ?> <?php hueco(5, 6); ?>;
    }</code></pre>

  <div class="avisoflujo">Aun mejor: <b>quitar el try/catch entero</b>. Nada de lo que hay dentro necesita traduccion de errores:
     las excepciones de Nest ya se traducen solas. Ese es el reto de esta seccion.</div>

  <?php reto('loginfix'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. Bug 3 — el hash de la clave en las respuestas</h2>

<pre><code>@Column({<?php hueco(6, 7); ?>: <?php hueco(7, 6); ?>})
password: string;</code></pre>

  <div class="nota"><b>Dos lecciones en una:</b> (1) el arreglo sencillo abre otro problema (el login necesita el hash, hay que
     pedirlo explicitamente); (2) sin arreglar el <code>catch</code> vacio, ese segundo problema seria <b>invisible</b>. Es el
     ejemplo de por que los bugs se encadenan.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. Bug 5 — <code>|</code> en vez de <code>||</code></h2>

<pre><code>signOptions:{expiresIn: configService.get('JWT_EXPIRES_IN') | 600}</code></pre>

  <p>Con <b>una sola barra</b> es una operacion de bits. Calcula que segundos acaba usando el token segun el valor de la variable:</p>

<pre><code>JWT_EXPIRES_IN no definida   →  <?php hueco(8, 5); ?> segundos     (0 | 600)

JWT_EXPIRES_IN=600           →  <?php hueco(9, 5); ?> segundos     (600 | 600)

JWT_EXPIRES_IN=3600          →  <?php hueco(10, 5); ?> segundos     ("3600" | 600)  ← ¡no son 3600!

JWT_EXPIRES_IN=1h            →  <?php hueco(11, 5); ?> segundos     ("1h" es NaN; NaN | 600)</code></pre>

  <p>El operador correcto para "usa este valor por defecto" es <code><?php hueco(12, 3); ?></code>.</p>

  <div class="nota">Truco mental: <code>|</code> y <code>&amp;</code> trabajan sobre los <b>bits</b> de los numeros;
     <code>||</code> y <code>&amp;&amp;</code> trabajan sobre <b>verdadero/falso</b>. Cuando una sola letra cambia el significado
     y el compilador no protesta (aqui porque <code>get()</code> devuelve <code>any</code>), es un bug muy dificil de ver.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Bug 6 — la condicion que nunca se cumple</h2>

<pre><code>const result = await this.brandRepository.update(id, updateBrandDto);
if(result.affected &amp;&amp; result.affected&lt;1)          // ← nunca es true: si affected es 0, el primer termino ya es falso
  throw new NotFoundException(`brand with id ${id} not found`);

// version correcta:
if(result.affected <?php hueco(13, 3); ?> <?php hueco(14, 2); ?>)
  throw new NotFoundException(`brand with id ${id} not found`);</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. Bug 7 — endpoints que "funcionan" pero no hacen nada</h2>

<pre><code>PATCH /user/&lt;uuid&gt;   →   UserService.update(id, dto)   →   return `This action updates a #${id} user`;

Respuesta HTTP:   <?php hueco(15, 4); ?>  con cuerpo de tipo  <?php hueco(16, 10); ?>     (y no se modifica ningun usuario)</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. Bug 8 — el DTO de login que rechaza emails validos</h2>

<pre><code>export class LoginUserDto {
    @IsString()
    @Length(8,50)         // ← rechaza "a@b.co"
    readonly email: string;
    ...
}

// lo correcto para un email: en vez de @IsString() + @Length(8,50)  →  @<?php hueco(17, 8); ?>()</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. Examen integrador: ¿que responde la API?</h2>
  <p>Con el repo <b>tal como esta</b> (bugs incluidos). Escribe el codigo de estado:</p>

<pre><code>POST /user   {"email":"a@b.com","password":"1234567890","name":"Ana"}    →  <?php hueco(20, 4); ?>   (¡y el cuerpo incluye el hash!)

POST /user   (el mismo email otra vez)                                    →  <?php hueco(21, 4); ?>   (ConflictException)

POST /user   {"email":"c@d.com","password":"123","name":"Ana"}            →  <?php hueco(22, 4); ?>   (MinLength(10))

POST /auth/login   (credenciales correctas, email de 8+ caracteres)       →  <?php hueco(23, 4); ?>   (con token)

POST /auth/login   (clave incorrecta)                                     →  <?php hueco(24, 4); ?>   (cuerpo VACIO: catch vacio)

POST /auth/login   {"email":"a@b.co","password":"12345678"}                →  <?php hueco(25, 4); ?>   (Length(8,50))

GET  /auth/private1   con token valido                                    →  <?php hueco(26, 4); ?>

GET  /auth/private1   sin token                                           →  <?php hueco(27, 4); ?>

GET  /user/&lt;uuid de un usuario que existe&gt;                                →  <?php hueco(28, 4); ?>   (cuerpo VACIO: busca por email)

GET  /brands/abc                                                          →  <?php hueco(29, 4); ?>

DELETE /brands/&lt;uuid que no existe&gt;                                       →  <?php hueco(30, 4); ?>

PATCH /user/&lt;uuid&gt;  {"name":"Nuevo"}                                       →  <?php hueco(31, 4); ?>   (texto; no cambia nada)

GET  /auth/private3   con token vacio: "Authorization: Bearer "           →  <?php hueco(32, 4); ?>

GET  /auth/private3   con token de un usuario con roles ['user']          →  <?php hueco(33, 4); ?></code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>I. De memoria: las correcciones</h2>

  <?php linea(40, 'Columna <code>password</code> que <b>no</b> se incluye en las consultas por defecto (decorador solo, en una linea):'); ?>
  <?php linea(41, 'Linea del controller que llama al metodo correcto para buscar por id:'); ?>
  <?php linea(42, 'Decorador del DTO de login que valida formato de email:'); ?>
  <?php linea(43, 'La propiedad <code>expiresIn</code> bien escrita (con <code>||</code>) tomando <code>JWT_EXPIRES_IN</code> del ConfigService, con 600 por defecto:'); ?>
  <?php linea(44, 'La condicion correcta (solo el <code>if</code>) para detectar que <code>update</code> no afecto ninguna fila:'); ?>
  <?php linea(45, 'La linea que <b>debe</b> llegar al cliente como 401 cuando las credenciales fallan:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>J. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); mc('m9'); mc('m10'); mc('m11'); mc('m12'); mc('m13'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('octavo.php', 'Menu.php');
