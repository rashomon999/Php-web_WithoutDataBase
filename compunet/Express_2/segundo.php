<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 2 — Router, rutas y recorridos
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- Bloque A: user.route.ts completo --- */
    1  => 'Router',
    2  => 'get',
    3  => 'getAll',
    4  => ['/profile', 'profile'],
    5  => ['/:id', ':id'],
    6  => 'post',
    7  => 'validateSchema',
    8  => 'create',
    9  => 'put',
    10 => 'update',
    11 => 'delete',
    12 => 'delete',
    13 => ['/login', 'login'],
    14 => 'login',

    /* --- Bloque B: URL final de cada ruta --- */
    15 => ['/user', 'GET /user'],
    16 => ['/user/profile', 'GET /user/profile'],
    17 => ['/user/:id', 'GET /user/:id'],
    18 => ['/user', 'POST /user'],
    19 => ['/user/:id', 'PUT /user/:id'],
    20 => ['/user/:id', 'DELETE /user/:id'],
    21 => ['/user/login', 'POST /user/login'],

    /* --- Bloque C: recorridos --- */
    22 => 'userRouter',
    23 => 'getAll',
    24 => 'getAll',
    25 => 'find',
    26 => ['/:id', ':id'],
    27 => 'getOne',
    28 => 'findById',
    29 => 'findById',
    30 => 'auth',
    31 => 'verify',
    32 => 'next',
    33 => 'getOne',
    34 => 'get',
    35 => 'send',

    /* --- Bloque D: req y res --- */
    36 => 'method',
    37 => 'params',
    38 => 'query',
    39 => 'body',
    40 => 'headers',
    41 => 'send',
    42 => 'json',
    43 => 'status',

    /* --- Bloque E: orden de rutas --- */
    44 => ['/profile', 'profile'],
    45 => ['/:id', ':id'],
    46 => ['profile', '"profile"'],

    /* --- Bloque F: lineas completas de memoria --- */
    47 => 'userRouter.get("/", userController.getAll);',
    48 => 'userRouter.get("/profile", auth, userController.getOne);',
    49 => 'userRouter.get("/:id", userController.getOne);',
    50 => 'userRouter.post("/", validateSchema(userSchema), userController.create);',
    51 => 'userRouter.put("/:id", userController.update);',
    52 => 'userRouter.delete("/:id", userController.delete);',
    53 => 'userRouter.post("/login", userController.login);',
    54 => 'app.get("/", (req: Request, res: Response) => {',
];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Al arrancar el servidor, <code>app.get("/", callback)</code>...',
        'opciones' => [
            'a' => 'Ejecuta la callback una vez para probarla.',
            'b' => 'Hace una peticion GET a la propia aplicacion.',
            'c' => 'Solo <b>registra</b> la regla "GET / &rarr; ejecutar callback". La callback se ejecutara cuando llegue una peticion.',
            'd' => 'Devuelve "Hola mundo" al terminal.',
        ],
        'correcta' => 'c',
        'porque'   => 'Registrar y ejecutar son dos momentos distintos: primero se configura todo, y solo despues, con el servidor escuchando, llegan peticiones que disparan las callbacks.',
    ],
    'm2' => [
        'texto'    => '¿Por que <code>userRouter.get("/profile", ...)</code> debe ir <b>antes</b> de <code>userRouter.get("/:id", ...)</code>?',
        'opciones' => [
            'a' => 'Por orden alfabetico.',
            'b' => 'Porque Express revisa las rutas en el orden en que se registraron y usa la primera que hace match; <code>/:id</code> tambien haria match con "profile".',
            'c' => 'Porque <code>auth</code> tiene que registrarse primero.',
            'd' => 'No importa el orden, Express elige siempre la mas especifica.',
        ],
        'correcta' => 'b',
        'porque'   => 'Si <code>/:id</code> estuviera primero, <code>GET /user/profile</code> entraria ahi con <code>id = "profile"</code> y buscaria en Mongo un usuario con ese id.',
    ],
    'm3' => [
        'texto'    => '¿Que es <code>express.Router()</code>?',
        'opciones' => [
            'a' => 'Un servidor HTTP independiente que escucha en otro puerto.',
            'b' => 'Una "mini aplicacion" de rutas, modular, que luego se monta en la app con <code>app.use(prefijo, router)</code>.',
            'c' => 'Una funcion que hace peticiones a otras APIs.',
            'd' => 'El controlador de usuarios.',
        ],
        'correcta' => 'b',
        'porque'   => 'Su unico trabajo es hacer match entre verbo HTTP + path y una cadena de funciones. No escucha nada por si mismo.',
    ],
    'm4' => [
        'texto'    => '<code>app.use("/user", userRouter);</code> — ¿esto hace una peticion a <code>/user</code>?',
        'opciones' => [
            'a' => 'Si, pide <code>/user</code> al arrancar.',
            'b' => 'No: conecta el prefijo <code>/user</code> con el router. Es configuracion, no una peticion.',
            'c' => 'Solo si el router tiene rutas GET.',
            'd' => 'Si, y por eso aparece en la consola.',
        ],
        'correcta' => 'b',
        'porque'   => 'Igual que <code>app.get</code>, <code>app.use</code> registra una regla. Aqui la regla es: "todo lo que empiece por /user, delegalo a userRouter".',
    ],
    'm5' => [
        'texto'    => 'Con <code>userRouter.get("/:id", userController.getOne)</code>, si llega <code>GET /user/abc</code>:',
        'opciones' => [
            'a' => '<code>req.params.id</code> vale <code>"abc"</code>.',
            'b' => '<code>req.body.id</code> vale <code>"abc"</code>.',
            'c' => '<code>req.query.id</code> vale <code>"abc"</code>.',
            'd' => 'Express responde 404 porque "abc" no es un numero.',
        ],
        'correcta' => 'a',
        'porque'   => 'Los segmentos con dos puntos (<code>:id</code>) son parametros de ruta y Express los deja en <code>req.params</code>.',
    ],
    'm6' => [
        'texto'    => 'Para <code>POST /user</code>, ¿cuantas funciones ejecuta Express y en que orden?',
        'opciones' => [
            'a' => 'Solo <code>userController.create</code>.',
            'b' => 'Dos: primero <code>validateSchema(userSchema)</code> y, si llama a <code>next()</code>, despues <code>userController.create</code>.',
            'c' => 'Dos, pero en paralelo.',
            'd' => 'Tres: auth, validateSchema y create.',
        ],
        'correcta' => 'b',
        'porque'   => 'La ruta define una cadena. Si el middleware responde (por ejemplo 400) y no llama a <code>next()</code>, la cadena se corta y el controller nunca corre.',
    ],
    'm7' => [
        'texto'    => 'La ruta <code>GET /</code> que responde "Hola mundo", ¿donde vive?',
        'opciones' => [
            'a' => 'En <code>user.route.ts</code>, dentro del userRouter.',
            'b' => 'Directamente sobre <code>app</code>, en <code>src/index.ts</code>.',
            'c' => 'En el controlador.',
            'd' => 'La crea Express por defecto.',
        ],
        'correcta' => 'b',
        'porque'   => 'Es la unica ruta declarada sobre la app principal; todas las demas estan en el router de usuarios montado en <code>/user</code>.',
    ],
    'm8' => [
        'texto'    => '¿Cual de estos NO es un objeto/propiedad que Express agrega o parsea sobre la peticion?',
        'opciones' => [
            'a' => '<code>req.body</code>',
            'b' => '<code>req.params</code>',
            'c' => '<code>req.header("Authorization")</code>',
            'd' => '<code>UserModel.findById()</code>',
        ],
        'correcta' => 'd',
        'porque'   => '<code>UserModel</code> es Mongoose (capa de datos). No tiene ninguna relacion con Express ni sabe que existe HTTP.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('Cuestionario 2 — Router, rutas y recorridos', 'user.route.ts, el prefijo /user y el camino de cada peticion');
?>

<div class="card">
  <h2>A. <code>src/users/user.route.ts</code> completo</h2>

<pre><code>import express, {Request, Response} from 'express';
import { userController } from './user.controller';
import { auth } from '../auth';
import { validateSchema } from '../global/validate.middleware';
import { userSchema } from './user.schema';

export const userRouter = express.<?php hueco(1, 8); ?>();

userRouter.<?php hueco(2, 7); ?>("/", userController.<?php hueco(3, 8); ?>);

userRouter.get("<?php hueco(4, 9); ?>", auth, userController.getOne);

userRouter.get("<?php hueco(5, 6); ?>", userController.getOne);

userRouter.<?php hueco(6, 6); ?>("/", <?php hueco(7, 15); ?>(userSchema), userController.<?php hueco(8, 8); ?>);

userRouter.<?php hueco(9, 6); ?>("/:id", userController.<?php hueco(10, 8); ?>);

userRouter.<?php hueco(11, 7); ?>("/:id", userController.<?php hueco(12, 8); ?>);

userRouter.post("<?php hueco(13, 8); ?>", userController.<?php hueco(14, 7); ?>);</code></pre>

  <div class="nota">Ojo: <code>delete</code> aparece dos veces porque el verbo HTTP y el metodo del
     controlador se llaman igual. No es un error.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. El prefijo <code>/user</code>: la URL real de cada ruta</h2>
  <p>En <code>index.ts</code> tenemos <code>app.use("/user", userRouter);</code>, asi que el path del
     router se <b>suma</b> al prefijo. Escribe la URL completa de cada una:</p>

<pre><code>userRouter.get("/", ...)          →  GET      <?php hueco(15, 16); ?>

userRouter.get("/profile", ...)   →  GET      <?php hueco(16, 16); ?>

userRouter.get("/:id", ...)       →  GET      <?php hueco(17, 16); ?>

userRouter.post("/", ...)         →  POST     <?php hueco(18, 16); ?>

userRouter.put("/:id", ...)       →  PUT      <?php hueco(19, 16); ?>

userRouter.delete("/:id", ...)    →  DELETE   <?php hueco(20, 16); ?>

userRouter.post("/login", ...)    →  POST     <?php hueco(21, 16); ?></code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. Recorridos de las peticiones GET</h2>

  <h3>1. <code>GET /user</code> — listar todos</h3>
<pre class="flujo"><code>GET /user
  ↓
app
  ↓
app.use("/user", <?php hueco(22, 12); ?>)
  ↓
userRouter.get("/")
  ↓
userController.<?php hueco(23, 8); ?>

  ↓
userService.<?php hueco(24, 8); ?>()
  ↓
UserModel.<?php hueco(25, 7); ?>()
  ↓
MongoDB</code></pre>

  <h3>2. <code>GET /user/123</code> — uno por id</h3>
<pre class="flujo"><code>GET /user/123
  ↓
userRouter.get("<?php hueco(26, 6); ?>")
  ↓
userController.<?php hueco(27, 8); ?>

  ↓
userService.<?php hueco(28, 9); ?>("123")
  ↓
UserModel.<?php hueco(29, 9); ?>("123")
  ↓
MongoDB</code></pre>

  <h3>3. <code>GET /user/profile</code> — protegida con JWT</h3>
<pre class="flujo"><code>GET /user/profile
  ↓
userRouter.get("/profile", ...)
  ↓
<?php hueco(30, 6); ?>                 ← middleware
  ↓
jwt.<?php hueco(31, 7); ?>()
  ↓
<?php hueco(32, 6); ?>()
  ↓
userController.<?php hueco(33, 8); ?>

  ↓
userService.findById()  →  UserModel.findById()  →  MongoDB</code></pre>

  <h3>4. <code>GET /</code> — la ruta de la app principal</h3>
<pre class="flujo"><code>GET /
  ↓
app
  ↓
app.<?php hueco(34, 5); ?>("/")
  ↓
(req, res) =&gt; { res.<?php hueco(35, 6); ?>("Hola mundo"); }
  ↓
NAVEGADOR</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. <code>req</code> y <code>res</code></h2>

  <p><code>req</code> representa la <b>peticion</b> que hizo el cliente. Completa cada propiedad:</p>
<pre><code>req.<?php hueco(36, 9); ?>    ←  el verbo HTTP (GET, POST, ...)
req.<?php hueco(37, 9); ?>    ←  los parametros de la URL, como el :id
req.<?php hueco(38, 9); ?>    ←  lo que viene despues del ? en la URL
req.<?php hueco(39, 9); ?>    ←  el cuerpo de la peticion (gracias a express.json())
req.<?php hueco(40, 9); ?>    ←  las cabeceras</code></pre>

  <p><code>res</code> es el objeto para <b>responder</b>:</p>
<pre><code>res.<?php hueco(41, 8); ?>("Hola mundo");
res.<?php hueco(42, 8); ?>({message: "OK"});
res.<?php hueco(43, 8); ?>(404);</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. El orden de las rutas importa</h2>

  <p>Express revisa las rutas <b>de arriba hacia abajo</b> y usa la primera que hace match.
     Por eso este orden es obligatorio:</p>

<pre><code>userRouter.get("<?php hueco(44, 9); ?>", auth, userController.getOne);   // debe ir ANTES
userRouter.get("<?php hueco(45, 6); ?>", userController.getOne);         // y esta DESPUES</code></pre>

  <p>Si estuvieran al reves, una peticion a <code>GET /user/profile</code> haria match con la ruta
     del parametro y el controlador recibiria <code>id = </code><?php hueco(46, 10); ?>,
     con lo que buscaria en MongoDB un usuario con ese id y nunca llegaria al perfil real.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. De memoria: las 7 rutas del router, linea a linea</h2>
  <p>Sin mirar <code>user.route.ts</code>. No importan mayusculas, espacios,
     tipo de comillas ni punto y coma final.</p>

  <?php linea(47, 'Listar <b>todos</b> los usuarios:'); ?>
  <?php linea(48, 'El <b>perfil</b>, protegido por el middleware de autenticacion:'); ?>
  <?php linea(49, 'Un usuario <b>por id</b>:'); ?>
  <?php linea(50, '<b>Crear</b> usuario, validando antes con Zod:'); ?>
  <?php linea(51, '<b>Actualizar</b> por id:'); ?>
  <?php linea(52, '<b>Borrar</b> por id:'); ?>
  <?php linea(53, '<b>Login</b>:'); ?>
  <?php linea(54, 'Y de <code>index.ts</code>: la apertura de la ruta <code>GET /</code> con sus dos parametros tipados (solo la primera linea):'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
