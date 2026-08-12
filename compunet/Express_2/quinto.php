<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 5 — GET /user/profile y el middleware auth
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- Bloque A: auth.middleware.ts --- */
    1  => 'express',
    2  => 'TokenExpiredError',
    3  => 'NextFunction',
    4  => 'header',
    5  => 'Authorization',
    6  => '401',
    7  => ['Not Authorized', 'not authorized'],
    8  => 'replace',
    9  => ['Bearer ', 'Bearer'],
    10 => 'JWT_SECRET',
    11 => 'verify',
    12 => 'params',
    13 => 'id',
    14 => 'id',
    15 => 'next',
    16 => 'TokenExpiredError',
    17 => ['Token expired', 'token expired'],
    18 => '401',

    /* --- Bloque B: el header --- */
    19 => 'Authorization',
    20 => 'Bearer',
    21 => 'verify',
    22 => ['controller', 'userController.getOne', 'getOne', 'el controller'],

    /* --- Bloque C: controller.getOne + service --- */
    23 => 'params',
    24 => 'id',
    25 => 'findById',
    26 => 'null',
    27 => '404',
    28 => 'json',
    29 => '500',
    30 => 'findById',
    31 => ['/profile', 'profile'],
    32 => ['middleware', 'auth', 'el middleware'],

    /* --- Bloque D: recorrido completo --- */
    33 => 'auth',
    34 => 'getOne',
    35 => 'header',
    36 => '401',
    37 => 'Bearer',
    38 => 'JWT_SECRET',
    39 => 'verify',
    40 => ['Token expired', 'token expired'],
    41 => 'id',
    42 => 'next',
    43 => 'findById',
    44 => 'json',

    /* --- Bloque E: lineas completas de memoria --- */
    45 => 'let token: string | undefined = req.header("Authorization");',
    46 => 'res.status(401).json({"message": "Not Authorized"});',
    47 => 'token = token.replace("Bearer ", "");',
    48 => 'const decoded: any = await jwt.verify(token, secret);',
    49 => 'req.params.id = decoded.id;',
    50 => 'if (error instanceof TokenExpiredError) {',
    51 => 'const id: string = req.params.id as string || \'\';',
    52 => 'const user: UserDocument | null = await userService.findById(id);',
];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Por que <code>auth</code> escribe el id en <code>req.params.id</code> y no en cualquier otra propiedad?',
        'opciones' => [
            'a' => 'Porque Express obliga a usar params.',
            'b' => 'Porque el siguiente eslabon, <code>userController.getOne</code>, lee justamente <code>req.params.id</code>; asi se reutiliza el mismo controller para <code>/user/:id</code> y para <code>/user/profile</code>.',
            'c' => 'Porque <code>req.body</code> esta lleno.',
            'd' => 'Porque el JWT solo se puede guardar ahi.',
        ],
        'correcta' => 'b',
        'porque'   => 'Al controller le da igual de donde salio el id: si de la URL o si lo inyecto un middleware. Solo lee <code>req.params.id</code>.',
    ],
    'm2' => [
        'texto'    => '¿<code>auth</code> es parte de Express?',
        'opciones' => [
            'a' => 'Si, es un middleware built-in como <code>express.json()</code>.',
            'b' => 'No: es una funcion tuya. Funciona solo porque respeta el contrato <code>(req, res, next)</code> que Express espera y porque Express la invoca dentro de la cadena de la ruta.',
            'c' => 'Es parte de la libreria jsonwebtoken.',
            'd' => 'Es parte de Mongoose.',
        ],
        'correcta' => 'b',
        'porque'   => 'Lo mismo pasa con <code>validateSchema</code>: middlewares propios que cumplen la firma que Express sabe llamar.',
    ],
    'm3' => [
        'texto'    => 'Llega <code>GET /user/profile</code> <b>sin</b> header <code>Authorization</code>. ¿Que ocurre?',
        'opciones' => [
            'a' => '<code>auth</code> responde <code>401 Not Authorized</code> y hace <code>return</code>: <code>getOne</code> nunca se ejecuta.',
            'b' => 'Express responde 404.',
            'c' => 'Se ejecuta <code>getOne</code> con <code>id</code> vacio y devuelve 404.',
            'd' => 'Se crea un token nuevo.',
        ],
        'correcta' => 'a',
        'porque'   => 'Sin <code>next()</code> la cadena se corta. Ese es todo el mecanismo de proteccion de la ruta.',
    ],
    'm4' => [
        'texto'    => 'Un JWT valido pero emitido con OTRO <code>JWT_SECRET</code>:',
        'opciones' => [
            'a' => 'Se acepta, porque el formato es correcto.',
            'b' => '<code>jwt.verify</code> lanza error, se entra al <code>catch</code> y se responde <code>401 Not Authorized</code>.',
            'c' => 'Responde <code>401 Token expired</code>.',
            'd' => 'Responde 500.',
        ],
        'correcta' => 'b',
        'porque'   => 'La firma es lo que garantiza que el token lo emitiste tu. Si no cuadra con el secreto, no vale, aunque el payload se pueda leer.',
    ],
    'm5' => [
        'texto'    => 'Si en <code>auth</code> quitaras el <code>return</code> que hay despues de <code>res.status(401).json(...)</code>:',
        'opciones' => [
            'a' => 'No cambiaria nada.',
            'b' => 'La funcion seguiria ejecutandose e intentaria verificar un token inexistente, pudiendo acabar en un error de "cabeceras ya enviadas" al responder dos veces.',
            'c' => 'Express lo detecta y lo corrige.',
            'd' => 'Se enviaria un 200.',
        ],
        'correcta' => 'b',
        'porque'   => '<code>res.status().json()</code> no interrumpe la funcion: solo escribe la respuesta. Hay que cortar el flujo a mano con <code>return</code>.',
    ],
    'm6' => [
        'texto'    => 'Sobre el JWT: ¿viaja cifrado?',
        'opciones' => [
            'a' => 'Si, nadie puede leer su contenido.',
            'b' => 'No: viaja <b>firmado</b>. Cualquiera puede decodificar y leer el payload (id, name, email), pero nadie puede modificarlo sin conocer el secreto.',
            'c' => 'Depende del algoritmo elegido siempre cifra.',
            'd' => 'Solo se cifra si usas HTTPS.',
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso nunca se guarda informacion sensible en el payload. La firma da <b>integridad</b> y <b>autenticidad</b>, no confidencialidad.',
    ],
    'm7' => [
        'texto'    => 'El mismo <code>userController.getOne</code> sirve para dos rutas distintas. ¿Por que funciona?',
        'opciones' => [
            'a' => 'Porque Express duplica el controlador.',
            'b' => 'Porque el controller solo depende de <code>req.params.id</code>, y ese dato lo puede haber puesto la URL (<code>/user/:id</code>) o el middleware <code>auth</code> (<code>/user/profile</code>).',
            'c' => 'Porque ambas rutas son GET.',
            'd' => 'Porque el router lo copia.',
        ],
        'correcta' => 'b',
        'porque'   => 'Es un buen ejemplo de por que las capas de abajo no deben saber "de donde" vienen los datos, solo su forma.',
    ],
    'm8' => [
        'texto'    => 'Si el token es valido pero ese usuario ya fue borrado de MongoDB:',
        'opciones' => [
            'a' => '401 Not Authorized.',
            'b' => '<code>auth</code> pasa sin problema (el token sigue firmado correctamente), pero <code>findById</code> devuelve <code>null</code> y el controller responde <code>404 User with id ... not found</code>.',
            'c' => '500.',
            'd' => 'Devuelve un usuario vacio con 200.',
        ],
        'correcta' => 'b',
        'porque'   => 'El middleware solo valida el token, no consulta la base de datos. La existencia real del usuario se comprueba mas abajo, en el controller.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('Cuestionario 5 — GET /user/profile', 'El middleware auth: Authorization, Bearer, jwt.verify y next()');
?>

<div class="card">
  <h2>A. <code>src/auth/auth.middleware.ts</code> completo</h2>

<pre><code>import { NextFunction, Request, Response } from "<?php hueco(1, 9); ?>";
import jwt, { <?php hueco(2, 18); ?> } from "jsonwebtoken";

export const auth = async (req: Request, res: Response, next: <?php hueco(3, 14); ?>) =&gt; {

    let token: string | undefined = req.<?php hueco(4, 7); ?>("<?php hueco(5, 14); ?>");

    process.loadEnvFile();

    if(!token){
        res.status(<?php hueco(6, 5); ?>).json({"message": "<?php hueco(7, 15); ?>"});
        return;
    }

    try {
        token = token.<?php hueco(8, 8); ?>("<?php hueco(9, 8); ?>","");

        const secret: string = process.env.<?php hueco(10, 12); ?> || "";

        const decoded: any = await jwt.<?php hueco(11, 7); ?>(token, secret);

        req.<?php hueco(12, 7); ?>.<?php hueco(13, 4); ?> = decoded.<?php hueco(14, 4); ?>;

        <?php hueco(15, 6); ?>();

    }catch(error){
        console.error(error);

        if(error instanceof <?php hueco(16, 18); ?>){
            res.status(401).json({"message": "<?php hueco(17, 14); ?>"});
            return;
        }

        res.status(<?php hueco(18, 5); ?>).json({"message": "Not Authorized"});
    }
}</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. El header y el prefijo</h2>

  <p>El cliente manda el JWT en el header <?php hueco(19, 15); ?>,
     precedido por la palabra <?php hueco(20, 9); ?>:</p>

<pre><code>Authorization: Bearer eyJhbGciOiJIUzI1Ni...</code></pre>

  <p>Por eso el middleware hace <code>token.replace("Bearer ", "")</code>: quita el prefijo y deja
     unicamente el token.</p>

<pre><code>Antes:    Bearer eyJhbGci...
Despues:  eyJhbGci...</code></pre>

  <p>Durante el login el token se creo con <code>jwt.sign(..., secret)</code>. Ahora, en profile,
     se usa <b>ese mismo secreto</b> con <code>jwt.<?php hueco(21, 8); ?>(token, secret)</code>.</p>

  <div class="avisoflujo">Si el middleware responde y <b>no</b> llama a <code>next()</code>,
     el <?php hueco(22, 14); ?> nunca se ejecuta. Ese es todo el mecanismo de proteccion.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>userController.getOne</code> y el service</h2>

<pre><code>public async getOne (req: Request, res: Response) {
     try {
        const id: string = req.<?php hueco(23, 7); ?>.<?php hueco(24, 4); ?> as string || '';

        const user: UserDocument | null = await userService.<?php hueco(25, 9); ?>(id);

        if (user === <?php hueco(26, 6); ?>){
            res.status(<?php hueco(27, 5); ?>).json({message: `User with id ${id} not found`});
            return;
        }

        res.<?php hueco(28, 6); ?>(user);

     } catch (error) {
        res.status(<?php hueco(29, 5); ?>).json(error);
     }
}</code></pre>

  <p>Y en el service:</p>
<pre><code>public findById (id: string): Promise&lt;UserDocument | null&gt;{
    return UserModel.<?php hueco(30, 9); ?>(id);
}</code></pre>

  <h3>Un detalle importante</h3>
  <p>La <b>misma</b> funcion <code>userController.getOne</code> atiende dos rutas:
     <code>GET /user/:id</code> y <code>GET /user/<?php hueco(31, 9); ?></code>.</p>
  <p>Funciona porque el controller solo lee <code>req.params.id</code>, sin importarle si ese valor
     vino de la URL o si lo puso el <?php hueco(32, 14); ?> de autenticacion.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. Recorrido completo de <code>GET /user/profile</code></h2>

<pre class="flujo"><code>CLIENTE   GET /user/profile
          Authorization: Bearer eyJhbGci...
  ↓
Express   →   app.use("/user", userRouter)
  ↓
userRouter.get("/profile", <?php hueco(33, 6); ?>, userController.<?php hueco(34, 8); ?>)
  ↓
auth()
  ↓
req.<?php hueco(35, 8); ?>("Authorization")
  ↓
¿existe el token?
  ├── NO  →  <?php hueco(36, 5); ?> Not Authorized      (fin)
  │
  └── SI
        ↓  quitar "<?php hueco(37, 8); ?> "
        ↓  obtener process.env.<?php hueco(38, 12); ?>

        ↓  jwt.<?php hueco(39, 7); ?>(token, secret)
        ↓
      ¿el JWT es valido?
        ├── NO        →  401 Not Authorized     (fin)
        ├── EXPIRADO  →  401 <?php hueco(40, 14); ?>        (fin)
        │
        └── SI
              ↓  decoded = {id, name, email}
              ↓  req.params.id = decoded.<?php hueco(41, 4); ?>

              ↓  <?php hueco(42, 6); ?>()
              ↓
            userController.getOne()
              ↓  const id = req.params.id
              ↓
            userService.findById(id)
              ↓
            UserModel.<?php hueco(43, 9); ?>(id)
              ↓
            MongoDB
              ↓
            ¿lo encontro?
              ├── NO  →  404 User with id ... not found
              └── SI  →  res.<?php hueco(44, 6); ?>(user)
                            ↓
                         CLIENTE</code></pre>

  <div class="nota"><b>La idea fundamental:</b> el login <i>genera</i> el JWT y profile lo <i>consume</i>.
     <code>auth</code> se coloca entre la ruta y el controller, y <code>next()</code> es lo unico que
     permite que la peticion pase de uno a otro.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. De memoria: la linea completa</h2>
  <p>El middleware <code>auth</code> es corto pero denso. Escribelo linea a linea.</p>

  <?php linea(45, 'Leer el token del header (linea completa, con el tipo que permite <code>undefined</code>):'); ?>
  <?php linea(46, 'Responder que no esta autorizado, con el mensaje tal cual esta en el codigo:'); ?>
  <?php linea(47, 'Quitarle el prefijo al token:'); ?>
  <?php linea(48, 'Verificar el JWT y guardar lo que devuelve (linea completa, con tipo):'); ?>
  <?php linea(49, 'Inyectar el id del token donde el controller lo va a leer:'); ?>
  <?php linea(50, 'La condicion del <code>catch</code> que detecta un token caducado (solo la linea del <code>if</code>):'); ?>
  <?php linea(51, 'En <code>getOne</code>: sacar el id de la peticion, con su tipo y su valor por defecto:'); ?>
  <?php linea(52, 'En <code>getOne</code>: pedirle el usuario al service (linea completa, con tipos):'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('cuarto.php', 'sexto.php');
