<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 1 — Arranque del proyecto e index.ts
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- Bloque A: que es Express / gestores de paquetes --- */
    1  => ['Node.js', 'node', 'nodejs', 'node js'],
    2  => ['Rutas', 'ruta', 'routes'],
    3  => ['Middleware', 'middlewares'],
    4  => ['dependencias', 'dependencies'],
    5  => 'package-lock.json',
    6  => 'yarn.lock',
    7  => ['node_modules', 'node_modules/'],
    8  => ['npm install express', 'npm i express'],
    9  => 'yarn add express',
    10 => ['npm run dev', 'yarn dev'],

    /* --- Bloque B: index.ts completo --- */
    11 => 'express',
    12 => ['./users/', './users'],
    13 => ['./config/connectionDB', './config/connectionDB.ts'],
    14 => 'express',
    15 => 'loadEnvFile',
    16 => 'parseInt',
    17 => 'json',
    18 => 'urlencoded',
    19 => ['/user', 'user'],
    20 => 'Response',
    21 => 'send',
    22 => 'db',
    23 => 'listen',

    /* --- Bloque C: los 4 elementos del import --- */
    24 => 'express',
    25 => 'Express',
    26 => 'Request',
    27 => 'Response',

    /* --- Bloque D: recorrido del import de userRouter --- */
    28 => ['./users/', './users'],
    29 => ['index.ts', 'index'],
    30 => ['user.route', './user.route', 'user.route.ts'],
    31 => 'Router',
    32 => ['Promise', 'promesa'],
    33 => 'connect',

    /* --- Bloque E: .env y puerto --- */
    34 => ['.env', 'env'],
    35 => ['PORT', 'process.env.PORT'],
    36 => ['MONGO_URL', 'process.env.MONGO_URL'],
    37 => ['JWT_SECRET', 'process.env.JWT_SECRET'],
    38 => ['3000', '"3000"'],

    /* --- Bloque F: flujo de arranque --- */
    39 => ['index.ts', 'src/index.ts'],
    40 => ['express()', 'express'],
    41 => ['json()', 'json'],
    42 => 'userRouter',
    43 => 'db',
    44 => 'listen',

    /* --- Bloque G: lineas completas de memoria --- */
    45 => 'import express, {Express, Request, Response} from \'express\';',
    46 => 'const app: Express = express();',
    47 => 'const port: number = parseInt(process.env.PORT || "3000");',
    48 => 'app.use(express.json());',
    49 => 'app.use(express.urlencoded({extended: true}));',
    50 => 'app.use("/user", userRouter);',
    51 => 'export const userRouter = express.Router();',
    52 => 'const connectionString: string = process.env.MONGO_URL || "";',

    /* --- Los imports de connectionDB.ts --- */
    53 => 'mongoose',
    54 => 'dns',
    55 => 'setServers',
];

$MULTIPLE = [
    'm1' => [
        'texto'    => '<code>const app: Express = express();</code> — ¿que hace exactamente esta linea?',
        'opciones' => [
            'a' => 'Arranca el servidor y empieza a escuchar peticiones.',
            'b' => 'Crea la aplicacion Express y la guarda en <code>app</code>; todavia NO escucha peticiones.',
            'c' => 'Se conecta a MongoDB.',
            'd' => 'Registra automaticamente todas las rutas del proyecto.',
        ],
        'correcta' => 'b',
        'porque'   => 'Escuchar peticiones ocurre despues, con <code>app.listen(port)</code>. Aqui solo se crea el objeto que administrara las peticiones.',
    ],
    'm2' => [
        'texto'    => '¿Por que <code>app.listen()</code> esta dentro de <code>db.then(...)</code>?',
        'opciones' => [
            'a' => 'Porque Express no funciona sin Mongoose.',
            'b' => 'Para que el servidor empiece a escuchar solo cuando la conexion con MongoDB ya termino correctamente.',
            'c' => 'Porque <code>then</code> es obligatorio en Express.',
            'd' => 'Para que el puerto sea asincrono.',
        ],
        'correcta' => 'b',
        'porque'   => '<code>db</code> es una Promise. <code>.then()</code> significa "cuando la promesa termine bien, ejecuta esto". Asi evitamos aceptar peticiones antes de tener base de datos.',
    ],
    'm3' => [
        'texto'    => '<code>import {userRouter} from \'./users/\';</code> — ¿que archivo se busca primero?',
        'opciones' => [
            'a' => '<code>src/users/user.route.ts</code>',
            'b' => '<code>src/users/index.ts</code>, porque es el archivo indice de la carpeta.',
            'c' => '<code>src/index.ts</code>',
            'd' => '<code>src/users/user.controller.ts</code>',
        ],
        'correcta' => 'b',
        'porque'   => 'Se importa desde una CARPETA, asi que Node busca su archivo indice. Ese index.ts hace <code>export * from \'./user.route\'</code> y de ahi sale el userRouter.',
    ],
    'm4' => [
        'texto'    => 'Si borras <code>app.use(express.json())</code>, ¿que pasa con <code>POST /user</code>?',
        'opciones' => [
            'a' => 'Nada, funciona igual.',
            'b' => '<code>req.body</code> queda vacio / undefined, asi que la validacion de Zod falla y responde 400.',
            'c' => 'Express responde 500 automaticamente.',
            'd' => 'MongoDB deja de conectarse.',
        ],
        'correcta' => 'b',
        'porque'   => '<code>express.json()</code> es el middleware que convierte el cuerpo crudo de la peticion en un objeto de JavaScript disponible en <code>req.body</code>. Sin el, nadie llena req.body.',
    ],
    'm5' => [
        'texto'    => 'Si en el <code>.env</code> tienes <code>PORT=4000</code>, ¿cuanto vale <code>port</code>?',
        'opciones' => [
            'a' => '3000, porque el <code>||</code> siempre gana.',
            'b' => 'El numero 4000.',
            'c' => 'El texto <code>"4000"</code>, y por eso <code>listen</code> falla.',
            'd' => 'undefined.',
        ],
        'correcta' => 'b',
        'porque'   => '<code>process.env.PORT</code> existe, asi que <code>||</code> devuelve "4000"; luego <code>parseInt()</code> lo convierte al numero 4000. El "3000" solo es el valor por defecto.',
    ],
    'm6' => [
        'texto'    => 'Sobre npm y Yarn en un mismo proyecto:',
        'opciones' => [
            'a' => 'Hay que usar los dos, cada uno instala cosas distintas.',
            'b' => 'Hacen practicamente lo mismo; lo recomendable es usar solo uno y no mezclarlos.',
            'c' => 'Yarn es para TypeScript y npm para JavaScript.',
            'd' => 'Yarn reemplaza a Node.',
        ],
        'correcta' => 'b',
        'porque'   => 'Ambos son gestores de paquetes. Mezclarlos genera dos archivos de bloqueo (<code>package-lock.json</code> y <code>yarn.lock</code>) que pueden contradecirse.',
    ],
    'm7' => [
        'texto'    => '¿Que es <code>Express</code> (con mayuscula) en <code>import express, {Express, Request, Response}</code>?',
        'opciones' => [
            'a' => 'Otra funcion para crear aplicaciones.',
            'b' => 'Un tipo de TypeScript que se usa para tipar <code>app</code>.',
            'c' => 'Una clase que hay que instanciar con <code>new</code>.',
            'd' => 'El router principal de la aplicacion.',
        ],
        'correcta' => 'b',
        'porque'   => '<code>express</code> (minuscula) es la funcion; <code>Express</code>, <code>Request</code> y <code>Response</code> son tipos. Los tipos desaparecen al compilar, no existen en tiempo de ejecucion.',
    ],
    'm8' => [
        'texto'    => 'Al arrancar, ¿cual de estos pasos ocurre <b>al final</b>?',
        'opciones' => [
            'a' => 'Se resuelven los imports y se crea el <code>userRouter</code>.',
            'b' => 'Se registran los middlewares con <code>app.use(...)</code>.',
            'c' => 'Se registra la ruta <code>GET /</code>.',
            'd' => 'Se ejecuta <code>app.listen(port)</code> y el servidor queda activo.',
        ],
        'correcta' => 'd',
        'porque'   => 'Todo lo demas es REGISTRO (configuracion). <code>app.listen()</code> es lo unico que realmente abre el puerto, y ademas espera a que MongoDB se conecte.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('Cuestionario 1 — Arranque e index.ts', 'Express, npm/Yarn y el punto de entrada linea por linea');
?>

<div class="card">
  <h2>A. ¿Que es Express? Y esos archivos raros de la raiz</h2>

  <p>Express es un framework para el entorno de ejecucion
     <?php hueco(1, 10); ?>
     que facilita la creacion de aplicaciones web y APIs, sobre todo
     microservicios y APIs RESTful.</p>

  <p>Dos de sus caracteristicas clave son:</p>
  <ul>
    <li><b><?php hueco(2, 8); ?></b>: permite asociar peticiones HTTP (GET, POST, PUT, DELETE)
        con funciones especificas.</li>
    <li><b><?php hueco(3, 12); ?></b>: funciones que se ejecutan durante el ciclo de vida de una
        solicitud (autenticacion, manejo de errores, parseo del cuerpo...).</li>
  </ul>

  <h3>Los archivos de la raiz del proyecto</h3>
  <ul>
    <li><code>package.json</code> &rarr; define las <?php hueco(4, 14); ?> y los scripts del proyecto.</li>
    <li><?php hueco(5, 20); ?> &rarr; archivo de bloqueo generado por <b>npm</b>.</li>
    <li><?php hueco(6, 14); ?> &rarr; archivo de bloqueo generado por <b>Yarn</b>.</li>
    <li><?php hueco(7, 16); ?> &rarr; carpeta donde se instalan las dependencias.</li>
  </ul>

  <h3>Instalar y ejecutar</h3>
  <p>Instalar Express con npm: <?php hueco(8, 24); ?></p>
  <p>Instalar Express con Yarn: <?php hueco(9, 24); ?></p>
  <p>Teniendo <code>"dev": "tsx --watch src/index.ts"</code> en <code>package.json</code>,
     el comando para levantar el proyecto en modo desarrollo es
     <?php hueco(10, 18); ?></p>

  <div class="nota">Yarn y npm hacen practicamente lo mismo. Lo recomendable es <b>usar uno solo</b>
     dentro del proyecto y no mezclarlos.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>src/index.ts</code> completo</h2>
  <p>Este es el <b>punto de entrada</b> de la aplicacion: crea y configura el servidor.
     Rellena cada hueco.</p>

<pre><code>import express, {Express, Request, Response} from '<?php hueco(11, 10); ?>';

import {userRouter} from '<?php hueco(12, 10); ?>';

import {db} from '<?php hueco(13, 24); ?>';

const app: Express = <?php hueco(14, 9); ?>();

process.<?php hueco(15, 12); ?>();

const port: number = <?php hueco(16, 9); ?>(process.env.PORT || "3000");

app.use(express.<?php hueco(17, 6); ?>());
app.use(express.<?php hueco(18, 11); ?>({extended: true}));

app.use("<?php hueco(19, 7); ?>", userRouter);

app.get("/", (req: Request, res: <?php hueco(20, 9); ?>) =&gt; {
    res.<?php hueco(21, 6); ?>("Hola mundo");
});

<?php hueco(22, 4); ?>.then( () =&gt;
    app.<?php hueco(23, 7); ?>(port, () =&gt; {
        console.log(`Server is running on port ${port}`);
    })
)</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. El primer import trae cuatro cosas</h2>

<pre><code>import express, {Express, Request, Response} from 'express';</code></pre>

  <ul>
    <li><?php hueco(24, 9); ?> &rarr; es la <b>funcion principal</b>. Con ella se crea la aplicacion:
        <code>const app = express();</code></li>
    <li><?php hueco(25, 9); ?> &rarr; es un <b>tipo de TypeScript</b>. Sirve para indicar que
        <code>app</code> es una aplicacion Express.</li>
    <li><?php hueco(26, 9); ?> &rarr; tipo que representa la <b>peticion</b> HTTP (<code>req</code>).</li>
    <li><?php hueco(27, 9); ?> &rarr; tipo que representa la <b>respuesta</b> HTTP (<code>res</code>).</li>
  </ul>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. Recorrido del import de <code>userRouter</code></h2>
  <p>Estamos en <code>src/index.ts</code>, asi que <code>./users/</code> significa <code>src/users/</code>.
     Como importamos desde una <b>carpeta</b>, se busca el archivo indice.</p>

<pre class="flujo"><code>src/index.ts
  ↓
import {userRouter} from '<?php hueco(28, 10); ?>'
  ↓
src/users/<?php hueco(29, 10); ?>

  ↓
export * from './<?php hueco(30, 12); ?>'
  ↓
src/users/user.route.ts
  ↓
export const userRouter = express.<?php hueco(31, 8); ?>()
  ↓
Se crea userRouter
  ↓
src/index.ts recibe userRouter</code></pre>

  <h3>Y el import de la base de datos</h3>
<pre><code>import {db} from './config/connectionDB';</code></pre>

  <p>Y ese archivo, <code>src/config/connectionDB.ts</code>, empieza asi:</p>

<pre><code>import <?php hueco(53, 10); ?> from "mongoose";
import <?php hueco(54, 5); ?> from "dns";

// Configurar DNS antes de que Mongoose intente conectarse
dns.<?php hueco(55, 12); ?>(["8.8.8.8", "8.8.4.4"]);

const connectionString: string =  process.env.MONGO_URL || "";

export const db = mongoose.<?php hueco(33, 9); ?>(connectionString)
                    .then( () =&gt; console.log("Connected to MongoDB") )
                    .catch( (error) =&gt; console.error(error) );</code></pre>

  <p>Por lo tanto <code>db</code> no es la conexion en si: es una
     <?php hueco(32, 10); ?> relacionada con la conexion a MongoDB.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Variables de entorno y puerto</h2>

<pre><code>process.loadEnvFile();
const port: number = parseInt(process.env.PORT || "3000");</code></pre>

  <p><code>process.loadEnvFile()</code> carga las variables del archivo
     <?php hueco(34, 8); ?>. En este proyecto ese archivo tiene tres variables:</p>

  <ul>
    <li><?php hueco(35, 14); ?> &rarr; el puerto donde escucha el servidor.</li>
    <li><?php hueco(36, 14); ?> &rarr; la cadena de conexion de MongoDB.</li>
    <li><?php hueco(37, 14); ?> &rarr; el secreto con el que se firman y verifican los JWT.</li>
  </ul>

  <p>Si <code>process.env.PORT</code> no existe, se usa el valor por defecto
     <?php hueco(38, 8); ?>, y <code>parseInt()</code> lo convierte de texto a numero.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. Todo el recorrido al arrancar el servidor</h2>

<pre class="flujo"><code>npm run dev
  ↓
Node ejecuta <?php hueco(39, 12); ?>

  ↓
se resuelven los imports (userRouter, db)
  ↓
const app = <?php hueco(40, 11); ?>

  ↓
process.loadEnvFile()   →   obtener PORT
  ↓
app.use(express.<?php hueco(41, 8); ?>)
  ↓
app.use(express.urlencoded({extended: true}))
  ↓
app.use("/user", <?php hueco(42, 12); ?>)
  ↓
app.get("/", ...)
  ↓
<?php hueco(43, 5); ?>.then(...)   →   MongoDB se conecta
  ↓
app.<?php hueco(44, 8); ?>(port)
  ↓
SERVIDOR ACTIVO</code></pre>

  <div class="avisoflujo"><b>Idea clave:</b> todo lo anterior a <code>app.listen()</code> es
     <b>registro</b>, no ejecucion. Escribir <code>app.get("/", callback)</code> NO hace una peticion GET:
     esta guardando la regla <i>"si llega GET /, ejecuta esta funcion"</i>.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. De memoria: escribe la linea completa</h2>
  <p>Sin mirar el codigo. No importan las mayusculas, los espacios de sobra, el tipo de comillas
     ni el punto y coma final.</p>

  <?php linea(45, 'El <b>import de Express</b> con la funcion y los tres tipos que usa el proyecto:'); ?>
  <?php linea(46, 'Crear la aplicacion, <b>tipada</b> con el tipo <code>Express</code>:'); ?>
  <?php linea(47, 'Obtener el <b>puerto</b> como numero, con 3000 por defecto:'); ?>
  <?php linea(48, 'Registrar el middleware que llena <code>req.body</code> con <b>JSON</b>:'); ?>
  <?php linea(49, 'Registrar el middleware de <b>formularios</b> (url encoded), con <code>extended</code>:'); ?>
  <?php linea(50, 'Montar el <b>router de usuarios</b> bajo el prefijo <code>/user</code>:'); ?>
  <?php linea(51, 'La linea de <code>user.route.ts</code> que <b>crea y exporta</b> el router:'); ?>
  <?php linea(52, 'En <code>connectionDB.ts</code>, obtener la <b>cadena de conexion</b> de Mongo con "" por defecto:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('Menu.php', 'segundo.php');
