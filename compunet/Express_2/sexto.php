<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 6 — Capas, modelo, que es Express y que no
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- Bloque A: user.model.ts --- */
    1  => 'mongoose',
    2  => 'UserInput',
    3  => 'Schema',
    4  => 'required',
    5  => 'unique',
    6  => 'select',
    7  => 'timestamps',
    8  => 'collection',
    9  => 'model',
    10 => 'User',
    11 => 'createdAt',
    12 => ['duplicados', 'emails duplicados', 'email duplicado', 'repetidos'],

    /* --- Bloque B: interfaces --- */
    13 => 'password',
    14 => 'email',
    15 => 'email',
    16 => ['no', 'NO'],
    17 => ['valida', 'validar'],
    18 => 'Document',

    /* --- Bloque C: es Express o no --- */
    19 => ['SI', 'si', 'sí'],
    20 => ['NO', 'no'],
    21 => ['SI', 'si', 'sí'],
    22 => ['NO', 'no'],
    23 => ['SI', 'si', 'sí'],
    24 => ['NO', 'no'],
    25 => ['SI', 'si', 'sí'],
    26 => ['NO', 'no'],
    27 => ['NO', 'no'],
    28 => ['SI', 'si', 'sí'],

    /* --- Bloque D: capas --- */
    29 => ['Controlador', 'controller'],
    30 => ['Servicio', 'service'],
    31 => ['Modelo', 'model'],
    32 => 'MongoDB',
    33 => ['controller', 'controlador', 'user.controller.ts'],
    34 => ['service', 'servicio', 'user.service.ts'],
    35 => ['model', 'modelo', 'user.model.ts'],
    36 => ['index.ts', 'index'],

    /* --- Bloque E: codigos HTTP --- */
    37 => '201',
    38 => '400',
    39 => '422',
    40 => '401',
    41 => '404',
    42 => '500',
    43 => ['res', 'Response', 'el res'],

    /* --- Bloque F: Dockerfile --- */
    44 => '22',
    45 => '/usr/src/app',
    46 => ['npm install', 'npm i'],
    47 => 'EXPOSE',
    48 => 'run',
    49 => 'dev',

    /* --- Bloque G: lineas completas de memoria --- */
    50 => 'name: {type: String, required: true },',
    51 => 'email: {type: String, required: true, unique: true },',
    52 => 'password: {type: String, required: true, select: false },',
    53 => '}, {timestamps: true, collection: \'users\'});',
    54 => 'export const UserModel = model<UserDocument>("User", userSchema);',
    55 => 'export interface UserDocument extends UserInput, Document{',
    56 => 'export const userService = new UserService();',
    57 => 'export * from \'./user.route\';',

    /* --- El import del modelo --- */
    58 => ['user.interface', './user.interface'],
];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Mongoose es parte de Express?',
        'opciones' => [
            'a' => 'Si, es su capa de datos oficial.',
            'b' => 'No: es un ODM independiente que habla con MongoDB. Vive en el modelo, lo llama el service, y no sabe que existe HTTP.',
            'c' => 'Si, viene incluido al instalar express.',
            'd' => 'No, pero necesita a Express para conectarse.',
        ],
        'correcta' => 'b',
        'porque'   => 'Podrias cambiar Express por otro framework (o por ningun framework) y Mongoose seguiria funcionando exactamente igual.',
    ],
    'm2' => [
        'texto'    => '¿Que pasaria si <code>userService</code> llamara directamente a <code>res.json(...)</code>?',
        'opciones' => [
            'a' => 'Nada, seria mas corto.',
            'b' => 'Romperia la separacion de capas: el service dejaria de ser reutilizable fuera de una peticion HTTP y no podrias llamarlo, por ejemplo, desde un script de consola.',
            'c' => 'Express lo prohibe y lanza un error.',
            'd' => 'Mongoose dejaria de funcionar.',
        ],
        'correcta' => 'b',
        'porque'   => 'El controller es la ultima capa que conoce <code>req</code> y <code>res</code>. De ahi hacia abajo solo viajan datos.',
    ],
    'm3' => [
        'texto'    => '<code>select: false</code> en el campo <code>password</code> significa:',
        'opciones' => [
            'a' => 'Que no se guarda en MongoDB.',
            'b' => 'Que no se puede modificar.',
            'c' => 'Que Mongoose no lo devuelve por defecto en las consultas, salvo que se pida explicitamente.',
            'd' => 'Que se cifra automaticamente.',
        ],
        'correcta' => 'c',
        'porque'   => 'Por eso el login llama a <code>findByEmail(email, true)</code>: para pedir ese campo cuando de verdad hace falta comparar el hash.',
    ],
    'm4' => [
        'texto'    => '¿Podrias usar <code>userService.create(...)</code> desde un script de consola, sin Express?',
        'opciones' => [
            'a' => 'Si: el service no depende de <code>req</code> ni de <code>res</code>, solo necesita la conexion a Mongo.',
            'b' => 'No, porque usa bcrypt.',
            'c' => 'No, porque necesita <code>req.body</code>.',
            'd' => 'Solo si copias el controller.',
        ],
        'correcta' => 'a',
        'porque'   => 'Ese es exactamente el beneficio practico de separar capas: la logica de negocio queda independiente del transporte.',
    ],
    'm5' => [
        'texto'    => '¿Que hace <code>export * from \'./user.route\';</code> dentro de <code>src/users/index.ts</code>?',
        'opciones' => [
            'a' => 'Ejecuta las rutas.',
            'b' => 'Reexporta todo lo que exporta ese archivo, para poder importar desde la carpeta (<code>from \'./users/\'</code>) en vez de desde el archivo concreto.',
            'c' => 'Crea una copia del router.',
            'd' => 'Registra el router en la app.',
        ],
        'correcta' => 'b',
        'porque'   => 'Es el patron "barrel": un unico punto de entrada por carpeta. Por eso <code>index.ts</code> puede escribir <code>import {userRouter} from \'./users/\'</code>.',
    ],
    'm6' => [
        'texto'    => 'Las interfaces de TypeScript (<code>UserInput</code>, <code>UserLogin</code>...) en tiempo de ejecucion:',
        'opciones' => [
            'a' => 'Se convierten en clases.',
            'b' => 'Validan los datos que llegan.',
            'c' => 'No existen: se borran al compilar. Solo sirven para que el compilador y el editor te avisen de errores de forma.',
            'd' => 'Se guardan en MongoDB.',
        ],
        'correcta' => 'c',
        'porque'   => 'Quien valida en tiempo de ejecucion es Zod (la entrada HTTP) y Mongoose (la estructura del documento). Las interfaces son documentacion verificada.',
    ],
    'm7' => [
        'texto'    => '¿Cual de estas lineas SI es un punto de contacto real con la libreria <code>express</code>?',
        'opciones' => [
            'a' => '<code>bcrypt.compare(a, b)</code>',
            'b' => '<code>jwt.sign(payload, secret)</code>',
            'c' => '<code>app.use("/user", userRouter)</code>',
            'd' => '<code>UserModel.findOne({email})</code>',
        ],
        'correcta' => 'c',
        'porque'   => 'Los puntos de contacto con Express son: <code>express()</code>, <code>express.json()</code>, <code>express.urlencoded()</code>, <code>express.Router()</code>, <code>app.use/get/post/...</code>, <code>app.listen()</code>, y los objetos <code>req</code>/<code>res</code>.',
    ],
    'm8' => [
        'texto'    => 'Orden correcto de las capas, de arriba a abajo:',
        'opciones' => [
            'a' => 'Rutas &rarr; Service &rarr; Controller &rarr; Model &rarr; MongoDB',
            'b' => 'Rutas &rarr; Controller &rarr; Service &rarr; Model &rarr; MongoDB',
            'c' => 'Controller &rarr; Rutas &rarr; Model &rarr; Service &rarr; MongoDB',
            'd' => 'Model &rarr; Service &rarr; Controller &rarr; Rutas &rarr; MongoDB',
        ],
        'correcta' => 'b',
        'porque'   => 'Cada capa solo le habla a la de abajo y nunca se salta niveles. La respuesta regresa por el mismo camino.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('Cuestionario 6 — Capas, modelo y que es Express', 'Mongoose, interfaces, codigos HTTP y Dockerfile');
?>

<div class="card">
  <h2>A. <code>src/users/user.model.ts</code> — el modelo de Mongoose</h2>

<pre><code>import {Document, Schema, model} from "<?php hueco(1, 10); ?>";
import { UserInput } from "./<?php hueco(58, 15); ?>";

export interface UserDocument extends <?php hueco(2, 11); ?>, Document{
    createdAt: Date,
    updatedAt: Date,
    deletedAt: Date
}

const userSchema = new <?php hueco(3, 8); ?>({
    name:     {type: String, <?php hueco(4, 9); ?>: true },
    email:    {type: String, required: true, <?php hueco(5, 8); ?>: true },
    password: {type: String, required: true, <?php hueco(6, 8); ?>: false },
}, {<?php hueco(7, 11); ?>: true, <?php hueco(8, 11); ?>: 'users'});

export const UserModel = <?php hueco(9, 7); ?>&lt;UserDocument&gt;("<?php hueco(10, 6); ?>", userSchema);</code></pre>

  <p>Gracias a <code>timestamps: true</code>, Mongoose agrega automaticamente los campos
     <?php hueco(11, 12); ?> y <code>updatedAt</code>.</p>

  <p>Y <code>unique: true</code> en el email evita <?php hueco(12, 16); ?>
     a nivel de base de datos.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>user.interface.ts</code> — los tipos que viajan entre capas</h2>

<pre><code>export interface UserInput{
    name: string,
    email: string,
    <?php hueco(13, 10); ?>: string
}

export interface UserUpdate {
    name: string,
    <?php hueco(14, 8); ?>: string
}

export interface UserLogin {
    <?php hueco(15, 8); ?>: string,
    password: string
}</code></pre>

  <p>Las interfaces de TypeScript <?php hueco(16, 5); ?> existen en tiempo de ejecucion:
     se borran al compilar.</p>

  <p>Por eso <code>req.body as UserInput</code> no transforma ni <?php hueco(17, 10); ?>
     los datos: es solo una afirmacion de tipos.</p>

  <p><code>UserDocument</code> extiende <code>UserInput</code> y ademas
     <code><?php hueco(18, 10); ?></code>, que es el tipo de Mongoose que aporta
     <code>_id</code>, <code>save()</code>, etc.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. ¿Esto es Express o no?</h2>
  <p>Escribe <b>SI</b> si la linea es un punto de contacto con la libreria <code>express</code>,
     o <b>NO</b> si pertenece a otra libreria del proyecto.</p>

<pre><code>express.Router()                        →  <?php hueco(19, 4); ?>

mongoose.connect(connectionString)      →  <?php hueco(20, 4); ?>

res.status(201).json(newUser)           →  <?php hueco(21, 4); ?>

bcrypt.hash(password, 10)               →  <?php hueco(22, 4); ?>

req.body                                →  <?php hueco(23, 4); ?>

jwt.sign(payload, secret)               →  <?php hueco(24, 4); ?>

app.use(express.json())                 →  <?php hueco(25, 4); ?>

schema.parseAsync(req.body)             →  <?php hueco(26, 4); ?>

UserModel.findById(id)                  →  <?php hueco(27, 4); ?>

app.listen(port)                        →  <?php hueco(28, 4); ?></code></pre>

  <div class="nota"><b>Lo que NO es Express:</b> Mongoose (ODM de MongoDB), bcrypt (hashing),
     jsonwebtoken (tokens) y Zod (validacion). Tus middlewares <code>auth</code> y
     <code>validateSchema</code> tampoco son Express: son funciones tuyas que <b>cumplen el contrato</b>
     <code>(req, res, next)</code> que Express sabe invocar.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. La cadena de capas</h2>

<pre class="flujo"><code>Rutas (Express)  →  <?php hueco(29, 13); ?>  →  <?php hueco(30, 11); ?>  →  <?php hueco(31, 9); ?> (Mongoose)  →  <?php hueco(32, 10); ?>

      ↑                                                                              |
      |______________ la respuesta regresa por el mismo camino _____________________|</code></pre>

  <p>Completa:</p>
  <ul>
    <li>La ultima capa que "sabe que existe HTTP" es el <?php hueco(33, 14); ?>.</li>
    <li>La capa donde vive la logica de negocio es el <?php hueco(34, 14); ?>.</li>
    <li>La unica capa que habla con MongoDB es el <?php hueco(35, 14); ?>.</li>
    <li>El archivo que reexporta todo el contenido de la carpeta <code>users</code> es
        <code><?php hueco(36, 10); ?></code>.</li>
  </ul>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Resumen de codigos HTTP del proyecto</h2>

<pre><code>Usuario creado correctamente (POST /user)            →  <?php hueco(37, 5); ?>

Body invalido segun Zod                              →  <?php hueco(38, 5); ?>

El email ya existe (ReferenceError en create)        →  <?php hueco(39, 5); ?>

Sin token / token invalido / token expirado          →  <?php hueco(40, 5); ?>

No existe un usuario con ese id                      →  <?php hueco(41, 5); ?>

Error inesperado del servidor                        →  <?php hueco(42, 5); ?></code></pre>

  <p><code>status()</code> y <code>json()</code> son metodos del objeto
     <?php hueco(43, 10); ?>, que es lo que Express usa para responder.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. El <code>Dockerfile</code> del proyecto</h2>

<pre><code># Imagen oficial de Node.js como base
FROM node:<?php hueco(44, 5); ?>


# Directorio de trabajo dentro del contenedor
WORKDIR <?php hueco(45, 16); ?>


# Copiamos los archivos de dependencias
COPY package*.json ./

# Instalamos las dependencias
RUN <?php hueco(46, 14); ?>


# Copiamos el resto del proyecto
COPY . .

# Puerto en el que escucha la aplicacion
<?php hueco(47, 8); ?> 3000

# Comando para iniciar la aplicacion
CMD ["npm", "<?php hueco(48, 5); ?>", "<?php hueco(49, 5); ?>"]</code></pre>

  <div class="nota">Se copia primero <code>package*.json</code> y solo despues el resto del codigo
     para aprovechar la cache de capas de Docker: si no cambian las dependencias, no se vuelve a
     ejecutar <code>npm install</code>.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. De memoria: la linea completa</h2>
  <p>El modelo y los exports que sostienen todo el proyecto.</p>

  <?php linea(50, 'El campo <b>name</b> del schema de Mongoose:'); ?>
  <?php linea(51, 'El campo <b>email</b>, que ademas no se puede repetir:'); ?>
  <?php linea(52, 'El campo <b>password</b>, que no se devuelve en las consultas:'); ?>
  <?php linea(53, 'La linea de <b>opciones</b> del schema, con los timestamps y el nombre de la coleccion:'); ?>
  <?php linea(54, 'La creacion y exportacion del <b>modelo</b>, con su generico:'); ?>
  <?php linea(55, 'La apertura de la interfaz <code>UserDocument</code> (solo esa linea):'); ?>
  <?php linea(56, 'El final de <code>user.service.ts</code>: la <b>instancia unica</b> que se exporta:'); ?>
  <?php linea(57, 'La linea de <code>users/index.ts</code> que reexporta las <b>rutas</b>:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('quinto.php', 'Menu.php');
