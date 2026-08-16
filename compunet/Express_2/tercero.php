<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 3 — Flujo completo de POST /user (crear usuario)
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- Bloque A: user.schema.ts (Zod) --- */
    1  => 'zod',
    2  => 'object',
    3  => 'string',
    4  => 'email',
    5  => 'min',
    6  => '8',
    7  => ['express-validator', 'express validator'],

    /* --- Bloque B: validate.middleware.ts --- */
    8  => 'NextFunction',
    9  => 'parseAsync',
    10 => 'next',
    11 => 'status',
    12 => '400',
    13 => 'next',
    14 => '400',

    /* --- Bloque C: controller.create --- */
    15 => 'userService',
    16 => 'UserInput',
    17 => 'status',
    18 => '201',
    19 => 'ReferenceError',
    20 => '422',

    /* --- Bloque D: service.create --- */
    21 => 'findByEmail',
    22 => 'null',
    23 => 'ReferenceError',
    24 => 'bcrypt',
    25 => 'hash',
    26 => '10',
    27 => 'UserModel',
    28 => 'create',
    29 => 'findOne',

    /* --- Bloque E: recorrido completo --- */
    30 => ['/user', 'user'],
    31 => 'post',
    32 => 'validateSchema',
    33 => '400',
    34 => 'next',
    35 => 'create',
    36 => 'ReferenceError',
    37 => 'bcrypt',
    38 => 'create',
    39 => '201',
    40 => 'json',

    /* --- Bloque F: responsabilidad de cada archivo --- */
    41 => ['user.route.ts', 'user.route'],
    42 => ['user.schema.ts', 'user.schema'],
    43 => ['validate.middleware.ts', 'validate.middleware'],
    44 => ['user.controller.ts', 'user.controller'],
    45 => ['user.service.ts', 'user.service'],
    46 => ['user.model.ts', 'user.model'],

    /* --- Bloque G: lineas completas de memoria --- */
    47 => 'await schema.parseAsync(req.body);',
    48 => 'res.status(400).json(error);',
    49 => 'const newUser = await userService.create(req.body as UserInput);',
    50 => 'res.status(201).json(newUser);',
    51 => 'const userExists: UserDocument | null = await this.findByEmail(userInput.email);',
    52 => 'throw new ReferenceError("user already exists");',
    53 => 'userInput.password = await bcrypt.hash(userInput.password, 10);',
    54 => 'return UserModel.create(userInput);',

    /* --- Firmas y andamiaje (try/catch), tapados en el propio codigo --- */
    55 => 'export const validateSchema = (schema: AnyZodObject) => {',
    56 => 'async',
    57 => 'try',
    58 => 'catch',
    59 => 'public async create (req: Request, res: Response) {',
    60 => 'try',
    61 => 'instanceof',
    62 => 'public async create (userInput: UserInput): Promise<UserDocument>{',
    63 => 'public findByEmail (email: string, password: boolean = false): Promise<UserDocument | null>{',

    /* --- Los imports de cada archivo --- */
    64 => 'express',                                   // validate.middleware.ts
    65 => 'AnyZodObject',
    66 => ['zod/v3', 'zod'],
    67 => 'express',                                   // user.controller.ts
    68 => 'userService',
    69 => ['user.interface', './user.interface'],
    70 => 'UserDocument',
    71 => 'bcrypt',                                    // user.service.ts
    72 => 'jsonwebtoken',
    73 => ['user.interface', './user.interface'],
    74 => 'UserModel',

    /* --- ¿Donde se valida cada cosa? --- */
    75 => ['user.schema.ts', 'user.schema', 'zod', 'el schema'],
    76 => ['user.service.ts', 'user.service', 'service', 'el service'],
    77 => ['user.controller.ts', 'user.controller', 'controller', 'el controller'],
    78 => ['user.model.ts', 'user.model', 'model', 'el model', 'el modelo'],
];

/* =====================================================================
   RETOS — se desbloquean al tener todos los huecos del bloque en verde
   ===================================================================== */
$RETOS = [

'schema' => [
    'titulo' => '<code>user.schema.ts</code>',
    'huecos' => [1, 2, 3, 4, 5, 6],
    'codigo' => <<<'EOT'
import {object, string, email} from 'zod';

export const userSchema: any = object({
    name: string({error: "Name is required"}),
    email: email({error: "Not a valid email address"}),
    password: string({error: "Password is required"})
                .min(8, "Password must be at least 8 characters long")
});
EOT
],

'middleware' => [
    'titulo' => '<code>validate.middleware.ts</code>',
    'huecos' => [8, 9, 10, 11, 12, 55, 56, 57, 58, 64, 65, 66],
    'codigo' => <<<'EOT'
import { NextFunction, Request, Response } from "express";
import {AnyZodObject} from 'zod/v3';

export const validateSchema = (schema: AnyZodObject) => {
   return async (req: Request, res: Response, next: NextFunction) => {
                try {
                    await schema.parseAsync(req.body);
                    next();
                } catch(error){
                    res.status(400).json(error);
                }
            }
}
EOT
],

'controller' => [
    'titulo' => 'el metodo <code>create</code> del controller',
    'huecos' => [15, 16, 17, 18, 19, 20, 59, 60, 61],
    'codigo' => <<<'EOT'
public async create (req: Request, res: Response) {
    try {
       const newUser = await userService.create(req.body as UserInput);
       res.status(201).json(newUser);
    } catch (error) {
       if(error instanceof ReferenceError) {
        res.status(422).json({message: "User already exists"});
       }
       res.status(500).json(error);
    }
}
EOT
],

'service' => [
    'titulo' => '<code>create</code> y <code>findByEmail</code> del service',
    'huecos' => [21, 22, 23, 24, 25, 26, 27, 28, 29, 62, 63],
    'codigo' => <<<'EOT'
public async create (userInput: UserInput): Promise<UserDocument>{
    const userExists: UserDocument | null = await this.findByEmail(userInput.email);
    if (userExists !== null){
        throw new ReferenceError("user already exists");
    }
    if(userInput.password){
        userInput.password = await bcrypt.hash(userInput.password, 10);
    }
    return UserModel.create(userInput);
}

public findByEmail (email: string, password: boolean = false): Promise<UserDocument | null>{
    return UserModel.findOne({email}, {password});
}
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Llega <code>POST /user</code> con <code>{"name":"Luis","email":"hola","password":"123"}</code>. ¿Que pasa?',
        'opciones' => [
            'a' => 'Zod falla, el middleware responde <code>400</code> y <b>el controller nunca se ejecuta</b>.',
            'b' => 'El controller se ejecuta igual y Mongo rechaza el documento.',
            'c' => 'Se crea el usuario con la contraseña corta.',
            'd' => 'Express responde 500.',
        ],
        'correcta' => 'a',
        'porque'   => 'El middleware entra al <code>catch</code>, hace <code>res.status(400).json(error)</code> y no llama a <code>next()</code>: la cadena se corta ahi mismo.',
    ],
    'm2' => [
        'texto'    => '¿Por que la contraseña se hashea en el <b>service</b> y no en la ruta o el controller?',
        'opciones' => [
            'a' => 'Por rendimiento.',
            'b' => 'Porque es logica de negocio: el service no sabe que existe HTTP, y asi podrias crear usuarios desde un script sin pasar por Express.',
            'c' => 'Porque bcrypt no funciona dentro de un middleware.',
            'd' => 'Es indiferente, esta ahi por costumbre.',
        ],
        'correcta' => 'b',
        'porque'   => 'La separacion en capas hace que cada una tenga un solo trabajo. El controller solo traduce HTTP; el service decide QUE se hace con los datos.',
    ],
    'm3' => [
        'texto'    => 'En <code>bcrypt.hash(userInput.password, 10)</code>, ¿que es el <code>10</code>?',
        'opciones' => [
            'a' => 'La longitud maxima de la contraseña.',
            'b' => 'Los segundos de espera antes de guardar.',
            'c' => 'El numero de <i>salt rounds</i> (coste): a mas rondas, mas lento y mas dificil de romper por fuerza bruta.',
            'd' => 'La cantidad de usuarios que se pueden crear.',
        ],
        'correcta' => 'c',
        'porque'   => 'El coste es exponencial: cada ronda extra duplica el trabajo de calcular el hash, tanto para ti como para un atacante.',
    ],
    'm4' => [
        'texto'    => 'En el proyecto hay dos cosas llamadas <code>userSchema</code>. ¿Son lo mismo?',
        'opciones' => [
            'a' => 'Si, es el mismo objeto importado en dos sitios.',
            'b' => 'No: el de <code>user.schema.ts</code> es de Zod (valida lo que llega por HTTP) y el de <code>user.model.ts</code> es de Mongoose (define como se guarda en Mongo). Coinciden solo en el nombre.',
            'c' => 'Si, Mongoose reutiliza los schemas de Zod.',
            'd' => 'No, uno valida y el otro tambien valida, pero son intercambiables.',
        ],
        'correcta' => 'b',
        'porque'   => 'Son dos librerias distintas y dos responsabilidades distintas: validar la <b>entrada HTTP</b> vs definir la <b>estructura en la base de datos</b>.',
    ],
    'm5' => [
        'texto'    => '¿Que devuelve <code>UserModel.create(userInput)</code>?',
        'opciones' => [
            'a' => 'Un booleano true/false.',
            'b' => 'El numero de documentos insertados.',
            'c' => 'El documento creado, ya con <code>_id</code>, <code>createdAt</code> y <code>updatedAt</code> generados.',
            'd' => 'Nada, es void.',
        ],
        'correcta' => 'c',
        'porque'   => 'Ese documento sube por el mismo camino: modelo &rarr; service &rarr; controller, y el controller lo manda al cliente con <code>res.status(201).json(newUser)</code>.',
    ],
    'm6' => [
        'texto'    => '<code>req.body as UserInput</code> — ¿que hace ese <code>as</code>?',
        'opciones' => [
            'a' => 'Convierte y valida el objeto en tiempo de ejecucion.',
            'b' => 'Solo le dice a TypeScript "trata esto como UserInput". No transforma ni valida nada; al compilar desaparece.',
            'c' => 'Copia el objeto.',
            'd' => 'Aplica el schema de Zod.',
        ],
        'correcta' => 'b',
        'porque'   => 'Quien valida de verdad es el middleware de Zod. El <code>as</code> es puramente de tipos: si el middleware no estuviera, llegaria basura igual.',
    ],
    'm7' => [
        'texto'    => 'Si el email ya existe, el service hace <code>throw new ReferenceError(...)</code>. ¿Que codigo intenta devolver el controller?',
        'opciones' => [
            'a' => '404',
            'b' => '400',
            'c' => '422 (y ademas cae en el <code>res.status(500)</code> siguiente, porque falta un <code>return</code>).',
            'd' => '201',
        ],
        'correcta' => 'c',
        'porque'   => 'Mira el <code>catch</code> de <code>create</code>: el <code>if</code> responde 422 pero no hace <code>return</code>, asi que sigue ejecutando <code>res.status(500).json(error)</code>. Es un bug real del codigo del curso, bueno para tenerlo presente.',
    ],
    'm9' => [
        'texto'    => 'En este proyecto, ¿donde se comprueba que el usuario que quieres crear <b>no exista ya</b>?',
        'opciones' => [
            'a' => 'En el schema de Zod, junto con el resto de validaciones del body.',
            'b' => 'En el <b>service</b>: es una regla de negocio y ademas hay que preguntarle a MongoDB, cosa que Zod no puede hacer.',
            'c' => 'En el controller, antes de llamar al service.',
            'd' => 'En el router, con un middleware.',
        ],
        'correcta' => 'b',
        'porque'   => 'Zod valida <b>la forma</b> del dato sin salir del proceso. Saber si un email ya esta usado exige ir a la base de datos, y eso ya es logica de negocio: <code>findByEmail</code> &rarr; <code>throw ReferenceError</code>. El modelo pone ademas una red de seguridad con <code>unique: true</code>.',
    ],
    'm8' => [
        'texto'    => 'Orden correcto de la cadena para <code>POST /user</code>:',
        'opciones' => [
            'a' => 'route &rarr; controller &rarr; middleware &rarr; service &rarr; model',
            'b' => 'route &rarr; middleware de validacion &rarr; controller &rarr; service &rarr; model &rarr; MongoDB',
            'c' => 'controller &rarr; route &rarr; service &rarr; model',
            'd' => 'middleware &rarr; service &rarr; controller &rarr; model',
        ],
        'correcta' => 'b',
        'porque'   => 'Cada capa solo habla con la de abajo y nunca se salta niveles. La respuesta vuelve por el mismo camino.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 3 — POST /user', 'Zod, middleware de validacion, controller, service, bcrypt y modelo');
?>

<div class="card">
  <h2>A. <code>src/users/user.schema.ts</code> — la validacion con Zod</h2>

<pre><code>import {object, string, email} from '<?php hueco(1, 6); ?>';

export const userSchema: any = <?php hueco(2, 8); ?>({
    name: <?php hueco(3, 8); ?>({error: "Name is required"}),
    email: <?php hueco(4, 8); ?>({error: "Not a valid email address"}),
    password: string({error: "Password is required"})
                .<?php hueco(5, 5); ?>(<?php hueco(6, 4); ?>, "Password must be at least 8 characters long")
});</code></pre>

  <p>Ademas de Zod, la otra opcion mencionada en el curso para validar los datos que llegan al backend
     (mediante reglas y middleware de Express) es <?php hueco(7, 20); ?>.</p>

  <?php reto('schema'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>src/global/validate.middleware.ts</code></h2>

<pre><code>import { NextFunction, Request, Response } from "<?php hueco(64, 9); ?>";
import {<?php hueco(65, 14); ?>} from '<?php hueco(66, 8); ?>';

<?php firma(55, 54); ?>

   return <?php hueco(56, 6); ?> (req: Request, res: Response, next: <?php hueco(8, 14); ?>) =&gt; {
                <?php hueco(57, 4); ?> {
                    await schema.<?php hueco(9, 12); ?>(req.body);
                    <?php hueco(10, 6); ?>();
                } <?php hueco(58, 6); ?>(error){
                    res.<?php hueco(11, 8); ?>(<?php hueco(12, 5); ?>).json(error);
                }
            }
}</code></pre>

  <div class="nota">
     <b>Ojo al import raro:</b> el schema se declara con <code>zod</code> a secas en
     <code>user.schema.ts</code>, pero el tipo <code>AnyZodObject</code> se importa de
     <code>'zod/v3'</code>. Es un resto de compatibilidad: en Zod 4 ese tipo ya no vive en la raiz
     del paquete, asi que se saca del espacio de la version 3.
  </div>

  <div class="nota">
     <b>Fijate en el truco:</b> <code>validateSchema(userSchema)</code> <b>no es</b> el middleware.
     Es una funcion que recibe el schema y <b>devuelve</b> la funcion middleware. Por eso en la ruta
     se escribe con parentesis: se ejecuta al registrar la ruta y lo que queda guardado es la funcion
     que Express llamara despues.
  </div>

  <p>La firma que Express espera de cualquier middleware es
     <code>(req, res, <?php hueco(13, 7); ?>)</code>.</p>

  <p>Si Zod detecta un error, el middleware responde con el codigo HTTP
     <?php hueco(14, 5); ?> y la cadena se corta: <b>no</b> se llama al controller.</p>

  <?php reto('middleware'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>user.controller.ts</code> &rarr; <code>create</code></h2>

<pre><code>import {Request, Response} from '<?php hueco(67, 9); ?>';
import { <?php hueco(68, 12); ?> } from './user.service';
import { UserInput, UserLogin, UserUpdate } from './<?php hueco(69, 15); ?>';
import { <?php hueco(70, 13); ?> } from './user.model';

<?php firma(59, 50); ?>

    <?php hueco(60, 4); ?> {
       const newUser = await <?php hueco(15, 13); ?>.create(req.body as <?php hueco(16, 11); ?>);
       res.<?php hueco(17, 7); ?>(<?php hueco(18, 5); ?>).json(newUser);
    } catch (error) {
       if(error <?php hueco(61, 11); ?> <?php hueco(19, 15); ?>) {
        res.status(<?php hueco(20, 5); ?>).json({message: "User already exists"});
       }
       res.status(500).json(error);
    }
}</code></pre>

  <div class="avisoflujo">El controller es <b>la ultima capa que sabe que existe HTTP</b>.
     Saca <code>req.body</code>, se lo pasa al service y con lo que le devuelvan arma la respuesta.
     No sabe nada de MongoDB.</div>

  <?php reto('controller'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. <code>user.service.ts</code> &rarr; <code>create</code></h2>

<pre><code>import <?php hueco(71, 8); ?> from "bcrypt";
import jwt from "<?php hueco(72, 14); ?>";

import { UserInput, UserLogin, UserUpdate } from "./<?php hueco(73, 15); ?>";
import { UserDocument, <?php hueco(74, 11); ?> } from "./user.model";

<?php firma(62, 62); ?>


    const userExists: UserDocument | null = await this.<?php hueco(21, 12); ?>(userInput.email);

    if (userExists !== <?php hueco(22, 6); ?>){
        throw new <?php hueco(23, 15); ?>("user already exists");
    }

    if(userInput.password){
        userInput.password = await <?php hueco(24, 8); ?>.<?php hueco(25, 6); ?>(userInput.password, <?php hueco(26, 4); ?>);
    }

    return <?php hueco(27, 11); ?>.<?php hueco(28, 8); ?>(userInput);
}</code></pre>

  <p>Y <code>findByEmail</code>, que es a quien llama primero, por dentro hace:</p>

<pre><code><?php firma(63, 93); ?>

    return UserModel.<?php hueco(29, 9); ?>({email}, {password});
}</code></pre>

  <?php reto('service'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Recorrido completo de <code>POST /user</code></h2>

<pre class="flujo"><code>CLIENTE   POST /user   {name, email, password}
  ↓
Express app   (express.json() llena req.body)
  ↓
app.use("<?php hueco(30, 7); ?>", userRouter)
  ↓
userRouter.<?php hueco(31, 6); ?>("/")
  ↓
<?php hueco(32, 15); ?>(userSchema)
  ↓
Zod
  ├─── ❌ invalido  →  HTTP <?php hueco(33, 5); ?>   (fin del recorrido)
  │
  └─── ✅ valido    →  <?php hueco(34, 6); ?>()
                          ↓
                      userController.<?php hueco(35, 8); ?>

                          ↓
                      userService.create()
                          ↓
                      findByEmail()  →  UserModel.findOne()  →  MongoDB
                          ↓
                      ¿el usuario ya existe?
                          ├── SI →  throw <?php hueco(36, 15); ?>

                          └── NO →  <?php hueco(37, 8); ?>.hash(password, 10)
                                       ↓
                                    UserModel.<?php hueco(38, 8); ?>(userInput)
                                       ↓
                                    MongoDB  →  documento creado
                                       ↓
                                    res.status(<?php hueco(39, 5); ?>).<?php hueco(40, 6); ?>(newUser)
                                       ↓
                                    CLIENTE</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. ¿De quien es cada responsabilidad?</h2>
  <p>Escribe el nombre del archivo que responde a cada pregunta:</p>

<pre><code>¿Que URL y que metodo llaman a que?             →  <?php hueco(41, 24); ?>


¿Los datos que llegan tienen estructura valida? →  <?php hueco(42, 24); ?>


Ejecuta Zod y decide si se puede continuar      →  <?php hueco(43, 24); ?>


Recibe la peticion y prepara la respuesta       →  <?php hueco(44, 24); ?>


Ejecuta la logica de negocio                    →  <?php hueco(45, 24); ?>


Define como se representa el usuario en Mongo   →  <?php hueco(46, 24); ?></code></pre>

  <div class="nota">El <code>route</code> no crea el usuario. Solo dice:
     <i>"cuando llegue POST /user, primero valida y despues llama a userController.create"</i>.</div>

  <h3>Y ahora la pregunta fina: "validar" no es una sola cosa</h3>
  <p>En este proyecto hay <b>cuatro</b> comprobaciones distintas y cada una vive en un sitio.
     Escribe el archivo (o la capa) donde ocurre cada una:</p>

<pre><code>Que el body tenga la FORMA correcta
(name texto, email valido, password de 8)        →  <?php hueco(75, 24); ?>

Que el usuario YA EXISTA al crearlo
(email repetido → ReferenceError)                →  <?php hueco(76, 24); ?>

Que el usuario NO EXISTA al leerlo por id
(user === null → 404)                            →  <?php hueco(77, 24); ?>

Que el email no se pueda repetir NUNCA,
garantizado por la base de datos (unique: true)  →  <?php hueco(78, 24); ?></code></pre>

  <div class="avisoflujo">
     La linea que las separa es esta: <b>Zod solo mira el dato que tiene delante</b>, sin salir del
     proceso. En cuanto una comprobacion necesita <b>preguntarle algo a MongoDB</b> ya no es
     validacion de entrada, es <b>logica de negocio</b>, y por eso vive en el service. El controller
     se queda con las comprobaciones de <b>respuesta</b> (¿hay algo que devolver? si no, 404), y el
     modelo pone la ultima red de seguridad a nivel de base de datos.
  </div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. De memoria: la linea completa</h2>
  <p>Recorre otra vez el flujo, pero ahora escribiendo tu la linea entera.</p>

  <?php linea(47, 'En el middleware: pedirle a <b>Zod</b> que valide el cuerpo de la peticion:'); ?>
  <?php linea(48, 'En el <code>catch</code> del middleware: responder que los datos son invalidos:'); ?>
  <?php linea(49, 'En el controller: pasarle el cuerpo al service, con el <code>as</code> de tipos:'); ?>
  <?php linea(50, 'En el controller: responder que el usuario se <b>creo</b>:'); ?>
  <?php linea(51, 'En el service: buscar si ya existe alguien con ese email (linea completa, con tipos):'); ?>
  <?php linea(52, 'En el service: lanzar el error cuando el usuario ya existe:'); ?>
  <?php linea(53, 'En el service: <b>hashear</b> la contraseña antes de guardarla:'); ?>
  <?php linea(54, 'En el service: crear finalmente el documento en MongoDB:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m9'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('segundo.php', 'cuarto.php');
