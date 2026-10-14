<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 4 — DTOs y validacion (class-validator + ValidationPipe)
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A. create-brand.dto.ts --- */
    1  => 'class-validator',
    2  => 'Length',
    3  => 'IsString',
    4  => 'IsOptional',
    5  => 'readonly',
    6  => '?',
    7  => 'message',
    8  => 'CreateBrandDto',

    /* --- B. update-brand.dto.ts --- */
    9  => 'PartialType',
    10 => ['@nestjs/mapped-types', 'mapped-types'],
    11 => 'extends',
    12 => 'CreateBrandDto',

    /* --- C. create-car.dto.ts / update-car.dto.ts --- */
    13 => 'IsNumber',
    14 => 'Min',
    15 => '1998',
    16 => 'Max',
    17 => '2040',
    18 => 'CreateCarDto',
    19 => 'IsOptional',

    /* --- D. create-user.dto.ts --- */
    20 => 'IsEmail',
    21 => 'MinLength',
    22 => '10',
    23 => 'IsOptional',
    24 => 'IsString',

    /* --- E. forma del error de validacion --- */
    25 => 'message',
    26 => 'error',
    27 => 'statusCode',

    /* --- F. escenarios: codigo de estado --- */
    30 => '400',
    31 => '400',
    32 => '400',
    33 => '400',
    34 => '201',
    35 => '400',
    36 => '201',
    37 => ['ValidationPipe', 'validation pipe', 'el ValidationPipe'],

    /* --- G. Lineas completas --- */
    40 => '@IsString()',
    41 => '@Length(3,20, {"message": "La marca debe tener una longitud entre 3 y 20"})',
    42 => "import { PartialType } from '@nestjs/mapped-types';",
    43 => 'export class UpdateBrandDto extends PartialType(CreateBrandDto) {}',
    44 => '@Min(1998)',
    45 => '@IsEmail()',
    46 => 'readonly slug?: string;',
    47 => 'export class CreateCarDto {',
];

$RETOS = [

'createbrand' => [
    'titulo' => '<code>create-brand.dto.ts</code>',
    'huecos' => [1, 2, 3, 4, 5, 6, 7, 8],
    'codigo' => <<<'EOT'
import { IsOptional, IsString, Length } from "class-validator";

export class CreateBrandDto {
    @Length(3,20, {"message": "La marca debe tener una longitud entre 3 y 20"})
    @IsString()
    readonly name: string;

    @Length(3,20, {"message": "El slug debe tener una longitud entre 3 y 20"})
    @IsString()
    @IsOptional()
    readonly slug?: string;
}
EOT
],

'updatebrand' => [
    'titulo' => '<code>update-brand.dto.ts</code>',
    'huecos' => [9, 10, 11, 12],
    'codigo' => <<<'EOT'
import { PartialType } from '@nestjs/mapped-types';
import { CreateBrandDto } from './create-brand.dto';

export class UpdateBrandDto extends PartialType(CreateBrandDto) {}
EOT
],

'createcar' => [
    'titulo' => '<code>create-car.dto.ts</code>',
    'huecos' => [13, 14, 15, 16, 17, 18],
    'codigo' => <<<'EOT'
import { IsNumber, IsString, Length, Max, Min } from "class-validator";

export class CreateCarDto {
    @Length(3,100, {"message": "La marca debe tener una longitud entre 3 y 100"})
    @IsString()
    brand: string;

    @Length(3,100)
    @IsString()
    model: string;

    @IsNumber()
    @Min(1998)
    @Max(2040)
    year: number;
}
EOT
],

'createuser' => [
    'titulo' => '<code>create-user.dto.ts</code>',
    'huecos' => [20, 21, 22, 23, 24],
    'codigo' => <<<'EOT'
import { IsEmail, IsOptional, IsString, MinLength } from "class-validator";

export class CreateUserDto {
    @IsEmail()
    email: string;

    @IsString()
    @MinLength(10)
    password: string;

    @IsString()
    name: string;

    @IsOptional()
    phone?: string;
}
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Que es un <b>DTO</b> (Data Transfer Object) y para que sirve <code>CreateBrandDto</code>?',
        'opciones' => [
            'a' => 'Una tabla de la base de datos.',
            'b' => 'Una clase que describe la <b>forma y las reglas de los datos que llegan</b> en el body de una peticion (que campos, de que tipo, cuanto miden).',
            'c' => 'Un middleware de Express.',
            'd' => 'La respuesta que se envia al cliente.',
        ],
        'correcta' => 'b',
        'porque'   => 'El DTO es el <b>contrato de entrada</b>. El controller lo usa como tipo del <code>@Body()</code> y el <code>ValidationPipe</code> lo lee para decidir si el body es valido antes de dejarlo pasar.',
    ],
    'm2' => [
        'texto'    => '¿Por que un DTO debe ser una <b>clase</b> y no una <code>interface</code>?',
        'opciones' => [
            'a' => 'Es solo convencion.',
            'b' => 'Porque las interfaces son mas lentas.',
            'c' => 'Porque TypeORM lo exige.',
            'd' => 'Porque una interface <b>desaparece al compilar</b>: no hay codigo en ejecucion al que pegarle decoradores ni que el pipe pueda leer. La clase si existe en runtime.',
        ],
        'correcta' => 'd',
        'porque'   => 'Por eso <code>interfaces/car.model.ts</code> (interfaz) sirve como tipo pero no valida nada, mientras que <code>CreateCarDto</code> (clase con decoradores) si.',
    ],
    'm3' => [
        'texto'    => 'Añades <code>nickname: string;</code> a <code>CreateUserDto</code> <b>sin ningun decorador</b> y mandas <code>{"nickname": "lu", ...}</code>. Con <code>whitelist</code> + <code>forbidNonWhitelisted</code>:',
        'opciones' => [
            'a' => 'Pasa, porque esta declarado en el DTO.',
            'b' => '<b>400</b>: "property nickname should not exist". Para <code>whitelist</code>, una propiedad solo es "conocida" si tiene <b>al menos un decorador de validacion</b>.',
            'c' => 'Se guarda como <code>null</code>.',
            'd' => '500.',
        ],
        'correcta' => 'b',
        'porque'   => 'Gotcha clasico: declarar el campo en la clase no basta. Si no quieres validarlo pero si aceptarlo, ponle <code>@IsOptional()</code> (como hace el profe con <code>phone</code>) u otro decorador.',
    ],
    'm4' => [
        'texto'    => '¿Que hace <code>@IsOptional()</code> sobre <code>slug?</code>?',
        'opciones' => [
            'a' => 'Si el campo <b>no viene</b> (<code>undefined</code>/<code>null</code>) se saltan los demas validadores de ese campo; si viene, se validan normalmente.',
            'b' => 'Hace que el campo se guarde en la BD.',
            'c' => 'Elimina el campo del DTO.',
            'd' => 'Permite cualquier valor, incluso de otro tipo.',
        ],
        'correcta' => 'a',
        'porque'   => 'Ojo: <code>slug: 12</code> <b>si</b> falla (<code>@IsString</code> y <code>@Length</code> se ejecutan porque el campo existe). Solo su <i>ausencia</i> esta permitida.',
    ],
    'm5' => [
        'texto'    => '<code>UpdateBrandDto extends PartialType(CreateBrandDto)</code>. ¿Que consigue?',
        'opciones' => [
            'a' => 'Una copia identica de <code>CreateBrandDto</code>.',
            'b' => 'Elimina las validaciones.',
            'c' => 'Una clase con los <b>mismos campos y validadores</b>, pero con todos marcados como <b>opcionales</b>: ideal para un PATCH parcial sin reescribir el DTO.',
            'd' => 'Una clase sin campos.',
        ],
        'correcta' => 'c',
        'porque'   => 'Compara con <code>UpdateCarDto</code>: el profe lo escribio a mano repitiendo <code>@IsOptional()</code> en cada campo. <code>PartialType</code> hace exactamente eso automaticamente. Viene de <code>@nestjs/mapped-types</code> (otros helpers: <code>PickType</code>, <code>OmitType</code>, <code>IntersectionType</code>).',
    ],
    'm6' => [
        'texto'    => 'Mandas <code>POST /cars</code> con <code>"year": "2020"</code> (string entre comillas). El DTO tiene <code>@IsNumber()</code> y el <code>ValidationPipe</code> <b>no</b> tiene <code>transform: true</code>. ¿Resultado?',
        'opciones' => [
            'a' => '<b>400</b>: "year must be a number...". Sin <code>transform</code> el pipe no convierte tipos; el JSON trae un string y <code>@IsNumber</code> lo rechaza.',
            'b' => '201: Nest convierte "2020" a numero.',
            'c' => '404.',
            'd' => '500 al guardar en Postgres.',
        ],
        'correcta' => 'a',
        'porque'   => 'Con <code>transform: true</code> se intentaria convertir los tipos primitivos segun lo declarado en el DTO. Aqui no esta activado, asi que el body se valida <i>tal cual llego</i>.',
    ],
    'm7' => [
        'texto'    => '<code>PATCH /brands/:id</code> con body <code>{}</code>. Todo es opcional, asi que la validacion pasa. Luego <code>BrandsService.update</code> llama <code>brandRepository.update(id, {})</code>. ¿Que ocurre?',
        'opciones' => [
            'a' => '200 devolviendo la marca sin cambios.',
            'b' => '404.',
            'c' => '400 del ValidationPipe.',
            'd' => 'TypeORM se queja de que no hay valores que actualizar (<code>UpdateValuesMissingError</code>); nadie lo captura, asi que llega como <b>500</b>.',
        ],
        'correcta' => 'd',
        'porque'   => 'Es un <b>caso borde</b>: una entrada valida para el DTO que rompe mas abajo. Una defensa posible: comprobar en el service que <code>Object.keys(dto).length &gt; 0</code> y lanzar <code>BadRequestException</code>.',
    ],
    'm8' => [
        'texto'    => 'Cuando falla la validacion, el cuerpo de la respuesta 400 tiene <code>message</code> como...',
        'opciones' => [
            'a' => 'Un objeto con un campo por error.',
            'b' => 'Siempre un string.',
            'c' => 'Un <b>arreglo de strings</b>, uno por cada regla incumplida (por ejemplo <code>["La marca debe tener una longitud entre 3 y 20"]</code>).',
            'd' => 'Un numero.',
        ],
        'correcta' => 'c',
        'porque'   => 'A diferencia de <code>NotFoundException(\'texto\')</code> (message string), el <code>ValidationPipe</code> agrupa <b>todos</b> los errores del body en un arreglo. En un cliente (React, Axios) toca contemplar ambos formatos.',
    ],
    'm9' => [
        'texto'    => 'Diferencia entre <code>CreateCarDto</code> y la entidad <code>Car</code>:',
        'opciones' => [
            'a' => 'Son la misma clase en dos archivos.',
            'b' => 'El DTO define lo que <b>acepta la API</b> (validacion, con class-validator); la entidad define <b>como se guarda</b> en la BD (columnas y relaciones, con TypeORM). Por eso <code>brand</code> es un string (el id) en el DTO y una relacion a <code>Brand</code> en la entidad.',
            'c' => 'El DTO es para GET y la entidad para POST.',
            'd' => 'La entidad valida y el DTO guarda.',
        ],
        'correcta' => 'b',
        'porque'   => 'Dos responsabilidades: <b>entrada</b> (DTO) vs <b>persistencia</b> (entidad). Mezclarlas es mala idea: un cliente podria intentar colar campos como <code>id</code> o <code>roles</code>.',
    ],
    'm10' => [
        'texto'    => 'En <code>CreateUserDto</code> la contraseña tiene <code>@MinLength(10)</code> y en <code>LoginUserDto</code> <code>@Length(8,50)</code>. ¿Que pasa con un usuario con clave de 9 caracteres?',
        'opciones' => [
            'a' => 'No se puede registrar (400: minimo 10), pero si <b>alguien</b> la tuviera de 9 pasaria el DTO de login.',
            'b' => 'Ambas reglas se aplican al registrarse.',
            'c' => 'Se registra igual.',
            'd' => 'No puede hacer login.',
        ],
        'correcta' => 'a',
        'porque'   => 'Son DTOs distintos con reglas distintas y no estan conectados: es una incoherencia. Lo importante del login es <b>comparar contra el hash</b>, no re-validar la longitud; una regla demasiado estricta en login puede incluso filtrar informacion sobre las claves.',
    ],
    'm11' => [
        'texto'    => 'En <code>LoginUserDto</code> el campo <code>email</code> tiene <code>@IsString()</code> y <code>@Length(8,50)</code>, no <code>@IsEmail()</code>. ¿Consecuencia?',
        'opciones' => [
            'a' => 'Ninguna, se valida igual el formato.',
            'b' => 'Cualquier texto de 8 a 50 caracteres pasa como "email" (ej. <code>"hola hola"</code>); el formato de email no se comprueba en el login.',
            'c' => 'Falla siempre.',
            'd' => 'Solo acepta emails de gmail.',
        ],
        'correcta' => 'b',
        'porque'   => 'Un "email" de 7 caracteres como <code>a@b.com</code> se rechaza por <b>longitud</b> aunque sea valido: falso negativo. Es mejor <code>@IsEmail()</code> (como en <code>CreateUserDto</code>).',
    ],
    'm12' => [
        'texto'    => '¿Que hace <code>readonly</code> en <code>readonly name: string;</code> dentro de un DTO?',
        'opciones' => [
            'a' => 'Hace que el campo sea obligatorio.',
            'b' => 'Solo lectura para TypeScript: una vez creado el objeto, ese campo no se puede reasignar en el codigo. No afecta a la validacion.',
            'c' => 'Impide que el cliente lo modifique en el JSON.',
            'd' => 'Lo oculta de las respuestas.',
        ],
        'correcta' => 'b',
        'porque'   => '<code>readonly</code> es una proteccion del compilador (el DTO es un contrato que no deberias mutar). Lo obligatorio/opcional lo decide la presencia de <code>?</code> y de <code>@IsOptional()</code>.',
    ],
    'm13' => [
        'texto'    => '¿Quien <b>ejecuta</b> realmente las reglas de <code>class-validator</code> de un DTO?',
        'opciones' => [
            'a' => 'Los propios decoradores, al leerse el archivo.',
            'b' => 'TypeORM al guardar.',
            'c' => 'El <code>ValidationPipe</code> global de <code>main.ts</code> (usa <code>class-transformer</code> para instanciar el DTO y <code>class-validator</code> para validarlo).',
            'd' => 'El controller.',
        ],
        'correcta' => 'c',
        'porque'   => 'Los decoradores solo registran metadata ("este campo debe ser string"). El pipe la lee, crea la instancia del DTO y llama al validador. Por eso ambos paquetes estan en las dependencias.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 4 — DTOs y validacion', 'class-validator, ValidationPipe, PartialType, casos borde de entrada');
?>

<div class="card">
  <h2>A. <code>create-brand.dto.ts</code></h2>

<pre><code>import { IsOptional, IsString, Length } from "<?php hueco(1, 15); ?>";

export class <?php hueco(8, 14); ?> {
    @<?php hueco(2, 6); ?>(3,20, {"<?php hueco(7, 7); ?>": "La marca debe tener una longitud entre 3 y 20"})
    @<?php hueco(3, 8); ?>()
    <?php hueco(5, 8); ?> name: string;

    @Length(3,20, {"message": "El slug debe tener una longitud entre 3 y 20"})
    @IsString()
    @<?php hueco(4, 10); ?>()
    readonly slug<?php hueco(6, 2); ?>: string;
}</code></pre>

  <div class="avisoflujo">Lectura: "<code>name</code> es obligatorio, texto de 3 a 20 caracteres; <code>slug</code> es
     opcional, y si viene tambien tiene que ser texto de 3 a 20".  Todas las reglas de un campo deben cumplirse a la vez.</div>

  <?php reto('createbrand'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>update-brand.dto.ts</code> — el DTO de update en una linea</h2>

<pre><code>import { <?php hueco(9, 11); ?> } from '<?php hueco(10, 20); ?>';
import { CreateBrandDto } from './create-brand.dto';

export class UpdateBrandDto <?php hueco(11, 7); ?> PartialType(<?php hueco(12, 14); ?>) {}</code></pre>

  <div class="nota">Compara con <code>update-car.dto.ts</code>, que <b>no usa</b> <code>PartialType</code>: repite todos los
     decoradores y le añade <code>@IsOptional()</code> a cada campo. Mismo resultado, mas codigo: el profe lo
     hizo a mano para que se vea lo que <code>PartialType</code> automatiza.</div>

  <?php reto('updatebrand'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>create-car.dto.ts</code> — validar numeros</h2>

<pre><code>import { IsNumber, IsString, Length, Max, Min } from "class-validator";

export class <?php hueco(18, 12); ?> {
    @Length(3,100, {"message": "La marca debe tener una longitud entre 3 y 100"})
    @IsString()
    brand: string;

    @Length(3,100)
    @IsString()
    model: string;

    @<?php hueco(13, 9); ?>()
    @<?php hueco(14, 4); ?>(<?php hueco(15, 5); ?>)
    @<?php hueco(16, 4); ?>(<?php hueco(17, 5); ?>)
    year: number;
}</code></pre>

  <p>En <code>UpdateCarDto</code> cada campo lleva ademas <code>@<?php hueco(19, 10); ?>()</code>, para que un PATCH
     pueda mandar solo el campo que cambia.</p>

  <div class="nota">Fijate que <code>brand</code> es un <b>string</b> (el <code>id</code> UUID de la marca), aunque en la
     entidad sea una relacion. El DTO habla el idioma del <b>cliente</b> (un id); la entidad, el de la <b>BD</b>.</div>

  <?php reto('createcar'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. <code>create-user.dto.ts</code> — email, clave y opcionales</h2>

<pre><code>import { IsEmail, IsOptional, IsString, MinLength } from "class-validator";

export class CreateUserDto {
    @<?php hueco(20, 7); ?>()
    email: string;

    @<?php hueco(24, 8); ?>()
    @<?php hueco(21, 9); ?>(<?php hueco(22, 3); ?>)
    password: string;

    @IsString()
    name: string;

    @<?php hueco(23, 10); ?>()
    phone?: string;
}</code></pre>

  <div class="nota">En este archivo el profe importa <code>minLength</code> (en minuscula) por accidente y nunca lo usa: el
     autoimport del editor. No rompe nada, pero es ruido; el linter (<code>oxlint</code>) lo marcaria.</div>

  <?php reto('createuser'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. La forma del error de validacion</h2>

<pre class="flujo"><code>POST /brands   {"name": "Ab"}

HTTP/1.1 400 Bad Request
{
  "<?php hueco(25, 7); ?>": [
     "La marca debe tener una longitud entre 3 y 20"
  ],
  "<?php hueco(26, 5); ?>": "Bad Request",
  "<?php hueco(27, 10); ?>": 400
}</code></pre>

  <div class="nota">Esta es la forma estandar de <b>cualquier</b> excepcion HTTP de Nest:
     <code>statusCode</code>, <code>message</code> y <code>error</code> (el nombre del estado). Cambia solo si
     personalizas un <i>exception filter</i>.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. Escenarios: ¿que responde la API?</h2>
  <p>Con el <code>ValidationPipe</code> de <code>main.ts</code> (<code>whitelist</code> + <code>forbidNonWhitelisted</code>,
     sin <code>transform</code>). Escribe el codigo de estado:</p>

<pre><code>POST /brands   {"name": "Ab"}                                   →  <?php hueco(30, 4); ?>   (menos de 3 caracteres)

POST /brands   {"name": "Toyota", "color": "rojo"}              →  <?php hueco(31, 4); ?>   (propiedad que no existe en el DTO)

POST /cars     {"brand": "&lt;uuid&gt;", "model": "Corolla", "year": "2020"}
                                                                →  <?php hueco(32, 4); ?>   (year llega como string)

POST /cars     {"brand": "&lt;uuid&gt;", "model": "Corolla", "year": 1990}
                                                                →  <?php hueco(33, 4); ?>   (menor que el Min(1998))

POST /brands   {"name": "Toyota"}                               →  <?php hueco(34, 4); ?>   (slug opcional; se rellena solo)

POST /user     {"email":"a@b.com","password":"123","name":"x"}  →  <?php hueco(35, 4); ?>   (MinLength(10))

POST /user     {"email":"a@b.com","password":"1234567890","name":"x"}   →  <?php hueco(36, 4); ?>   (phone es opcional)</code></pre>

  <p>En todos los casos de 400 la decision la toma el <?php hueco(37, 16); ?> <b>antes</b> de entrar al controller.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. De memoria: la linea completa</h2>

  <?php linea(47, 'Abrir la clase del DTO de creacion de coches:'); ?>
  <?php linea(40, 'Decorador que exige que un campo sea texto:'); ?>
  <?php linea(41, 'Decorador con longitud 3 a 20 y el mensaje personalizado "La marca debe tener una longitud entre 3 y 20" (con la clave <code>"message"</code> entre comillas):'); ?>
  <?php linea(46, 'El campo <code>slug</code> como solo lectura, opcional y de tipo string (con <code>;</code>):'); ?>
  <?php linea(42, 'El import de <code>PartialType</code> desde su paquete:'); ?>
  <?php linea(43, 'La declaracion completa de <code>UpdateBrandDto</code>:'); ?>
  <?php linea(44, 'Decorador que exige que el año sea al menos 1998:'); ?>
  <?php linea(45, 'Decorador para validar que un campo tiene formato de correo:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); mc('m9'); mc('m10'); mc('m11'); mc('m12'); mc('m13'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('tercero.php', 'quinto.php');
