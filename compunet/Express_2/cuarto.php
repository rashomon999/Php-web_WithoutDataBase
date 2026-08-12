<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 4 — Flujo completo de POST /user/login
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- Bloque A: ruta y controller --- */
    1  => 'post',
    2  => ['/login', 'login'],
    3  => 'login',
    4  => 'userService',
    5  => 'UserLogin',
    6  => 'json',

    /* --- Bloque B: service.login --- */
    7  => 'findByEmail',
    8  => 'true',
    9  => 'null',
    10 => ['Not Authorized', 'not authorized'],
    11 => 'bcrypt',
    12 => 'compare',
    13 => '_id',
    14 => 'admin',
    15 => 'generateToken',

    /* --- Bloque B2: por que true --- */
    16 => 'password',
    17 => 'false',
    18 => ['no', 'NO'],
    19 => 'findOne',
    20 => ['hash', 'el hash'],

    /* --- Bloque C: generateToken --- */
    21 => 'findById',
    22 => 'JWT_SECRET',
    23 => 'jwt',
    24 => 'sign',
    25 => 'name',
    26 => 'email',
    27 => 'secret',
    28 => 'expiresIn',
    29 => '1m',
    30 => ['1 minuto', 'un minuto', '1m'],

    /* --- Bloque D: recorrido completo --- */
    31 => 'login',
    32 => 'UserLogin',
    33 => 'login',
    34 => 'true',
    35 => 'findOne',
    36 => ['Not Authorized', 'not authorized'],
    37 => 'bcrypt',
    38 => 'generateToken',
    39 => 'sign',
    40 => 'roles',
    41 => 'json',
    42 => ['token', 'JWT', 'el token'],

    /* --- Bloque E: lineas completas de memoria --- */
    43 => 'userRouter.post("/login", userController.login);',
    44 => 'const user = await userService.login(req.body as UserLogin);',
    45 => 'const userExists: UserDocument | null = await this.findByEmail(userLogin.email, true);',
    46 => 'const isMatch: boolean = await bcrypt.compare(userLogin.password, userExists.password);',
    47 => 'return UserModel.findOne({email}, {password});',
    48 => 'const user = await this.findById(id);',
    49 => 'const secret: string = process.env.JWT_SECRET || "";',
    50 => 'token: await this.generateToken(userExists._id.toString())',
];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Por que en el login se llama <code>findByEmail(email, <b>true</b>)</code> y en <code>create</code> no?',
        'opciones' => [
            'a' => 'Para que la busqueda sea mas rapida.',
            'b' => 'Porque en el modelo el campo <code>password</code> tiene <code>select: false</code>, asi que normalmente Mongoose no lo devuelve; y para hacer login si necesitamos el hash guardado.',
            'c' => 'Porque <code>true</code> significa "usuario activo".',
            'd' => 'Porque asi se salta la validacion de Zod.',
        ],
        'correcta' => 'b',
        'porque'   => 'Ese segundo parametro se llama <code>password</code> y termina en <code>UserModel.findOne({email}, {password})</code>, que es la proyeccion: que campos traer.',
    ],
    'm2' => [
        'texto'    => '<code>bcrypt.compare(a, b)</code> — ¿que compara exactamente?',
        'opciones' => [
            'a' => 'Dos hashes.',
            'b' => 'Dos contraseñas en texto plano.',
            'c' => 'La contraseña en texto plano que envio el cliente contra el hash guardado en MongoDB.',
            'd' => 'El email contra el password.',
        ],
        'correcta' => 'c',
        'porque'   => 'El hash de bcrypt no se puede "deshacer". Lo que hace <code>compare</code> es re-hashear el texto plano con la misma sal que lleva incrustada el hash y ver si coinciden.',
    ],
    'm3' => [
        'texto'    => '¿Que informacion viaja DENTRO del JWT que se genera aqui?',
        'opciones' => [
            'a' => '<code>id</code>, <code>name</code> y <code>email</code> del usuario.',
            'b' => 'El email y la contraseña.',
            'c' => 'Solo el <code>_id</code>.',
            'd' => 'El documento completo de MongoDB, incluido el hash.',
        ],
        'correcta' => 'a',
        'porque'   => 'Es lo que se le pasa a <code>jwt.sign({id, name, email}, secret, {expiresIn:"1m"})</code>. Nunca metas la contraseña ni el hash en un token: el payload de un JWT se puede leer sin el secreto.',
    ],
    'm4' => [
        'texto'    => 'Con <code>{expiresIn: "1m"}</code>, ¿que ocurre si usas ese token en <code>/user/profile</code> dos minutos despues?',
        'opciones' => [
            'a' => 'Funciona, el token no caduca.',
            'b' => '<code>jwt.verify</code> lanza <code>TokenExpiredError</code> y el middleware <code>auth</code> responde <code>401 Token expired</code>.',
            'c' => 'Se renueva automaticamente.',
            'd' => 'Responde 404.',
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso <code>auth</code> distingue ese error concreto con <code>error instanceof TokenExpiredError</code> y da un mensaje distinto al 401 generico.',
    ],
    'm5' => [
        'texto'    => 'En <code>user.controller.ts</code>, el <code>try/catch</code> de <code>login</code> esta <b>comentado</b>. Si el email no existe y el service hace <code>throw new ReferenceError("Not Authorized")</code>:',
        'opciones' => [
            'a' => 'El cliente recibe igualmente un 401 limpio.',
            'b' => 'Nadie captura el error en el controller, asi que no se convierte en 401: la promesa rechazada acaba en el manejador de errores de Express y el cliente ve un 500.',
            'c' => 'El servidor se cae.',
            'd' => 'Se devuelve <code>{}</code> con codigo 200.',
        ],
        'correcta' => 'b',
        'porque'   => 'Comparalo con <code>create</code>, que si tiene su try/catch. Descomentar ese bloque es justo lo que haria que un login fallido devolviera 401 en vez de 500.',
    ],
    'm6' => [
        'texto'    => '<code>roles: [\'admin\']</code> en la respuesta del login...',
        'opciones' => [
            'a' => 'Viene de una coleccion de roles en MongoDB.',
            'b' => 'Lo calcula el JWT.',
            'c' => 'Esta escrito fijo (hardcodeado) en el service: todos los usuarios salen como admin.',
            'd' => 'Lo manda el cliente en el body.',
        ],
        'correcta' => 'c',
        'porque'   => 'Mira el <code>return</code> de <code>userService.login</code>. El modelo <code>User</code> ni siquiera tiene campo de roles.',
    ],
    'm7' => [
        'texto'    => '<code>generateToken(id)</code> vuelve a hacer <code>findById(id)</code> aunque el login ya tenia el usuario. ¿Que implica?',
        'opciones' => [
            'a' => 'Nada, es obligatorio para firmar.',
            'b' => 'Es una consulta extra a MongoDB que se podria evitar pasandole el usuario ya cargado; funciona, pero es trabajo repetido.',
            'c' => 'Es necesario porque el _id cambia.',
            'd' => 'Sirve para refrescar la contraseña.',
        ],
        'correcta' => 'b',
        'porque'   => 'Un login acaba haciendo dos viajes a Mongo: <code>findOne({email})</code> y luego <code>findById(id)</code>. Util para entender el coste real del flujo.',
    ],
    'm8' => [
        'texto'    => '¿Para que le sirve al cliente el token que recibe?',
        'opciones' => [
            'a' => 'Para nada, es informativo.',
            'b' => 'Para mandarlo en el header <code>Authorization: Bearer &lt;token&gt;</code> y poder entrar a rutas protegidas como <code>GET /user/profile</code>.',
            'c' => 'Para guardarlo en MongoDB.',
            'd' => 'Para descifrar la contraseña.',
        ],
        'correcta' => 'b',
        'porque'   => 'Login y profile son las dos mitades del mismo mecanismo: uno firma el token, el otro lo verifica con el mismo <code>JWT_SECRET</code>.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('Cuestionario 4 — POST /user/login', 'Buscar por email, comparar el hash y firmar el JWT');
?>

<div class="card">
  <h2>A. La ruta y el controller</h2>

  <p>En <code>user.route.ts</code>:</p>
<pre><code>userRouter.<?php hueco(1, 6); ?>("<?php hueco(2, 8); ?>", userController.<?php hueco(3, 7); ?>);</code></pre>

  <p>Como el router esta montado en <code>/user</code>, la URL completa es <code>POST /user/login</code>.
     El cliente envia:</p>

<pre><code>{
  "email": "luis@gmail.com",
  "password": "12345678"
}</code></pre>

  <p>Y en <code>user.controller.ts</code>:</p>
<pre><code>public async login (req: Request, res: Response) {
    const user = await <?php hueco(4, 13); ?>.login(req.body as <?php hueco(5, 11); ?>);
    res.<?php hueco(6, 6); ?>(user);
}</code></pre>

  <div class="nota"><code>as UserLogin</code> solo le dice a TypeScript "trata este objeto como
     <code>{email, password}</code>". <b>No transforma ni valida</b> los datos. Y fijate que esta ruta,
     a diferencia de <code>POST /user</code>, <b>no</b> lleva <code>validateSchema</code>.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>user.service.ts</code> &rarr; <code>login</code></h2>

<pre><code>public async login(userLogin: UserLogin): Promise&lt;any&gt;{

    const userExists: UserDocument | null =
              await this.<?php hueco(7, 12); ?>(userLogin.email, <?php hueco(8, 6); ?>);

    if (userExists === <?php hueco(9, 6); ?>){
        throw new ReferenceError("<?php hueco(10, 15); ?>");
    }

    const isMatch: boolean =
              await <?php hueco(11, 8); ?>.<?php hueco(12, 9); ?>(userLogin.password, userExists.password);

    if (!isMatch){
        throw new ReferenceError("Not Authorized");
    }

    return {
        id: userExists.<?php hueco(13, 5); ?>,
        roles: ['<?php hueco(14, 7); ?>'],
        token: await this.<?php hueco(15, 14); ?>(userExists._id.toString())
    }
}</code></pre>

  <h3>¿Por que ese <code>true</code>?</h3>
  <p>El segundo parametro de <code>findByEmail</code> se llama <?php hueco(16, 10); ?>,
     y termina en <code>UserModel.<?php hueco(19, 9); ?>({email}, {password})</code>.</p>

  <p>Es importante porque en <code>user.model.ts</code> ese campo esta declarado asi:</p>
<pre><code>password: {type: String, required: true, select: <?php hueco(17, 7); ?>}</code></pre>

  <p>Es decir, normalmente Mongoose <?php hueco(18, 5); ?> devuelve el campo <code>password</code>.
     Pero para hacer login necesitamos justamente el <?php hueco(20, 8); ?> de la contraseña
     para poder compararlo.</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>generateToken()</code> — la firma del JWT</h2>

<pre><code>public async generateToken(id: string): Promise&lt;string&gt; {

    const user = await this.<?php hueco(21, 9); ?>(id);

    process.loadEnvFile();
    if (user == null){ throw new Error(); }

    const secret: string = process.env.<?php hueco(22, 12); ?> || "";

    return <?php hueco(23, 5); ?>.<?php hueco(24, 6); ?>({
                        id: user._id.toString(),
                        name: user.<?php hueco(25, 6); ?>,
                        email: user.<?php hueco(26, 7); ?>

                    },
                    <?php hueco(27, 8); ?>,
                    {<?php hueco(28, 10); ?>: "<?php hueco(29, 4); ?>"});
}</code></pre>

  <p>Por lo tanto, el token de este proyecto dura <?php hueco(30, 12); ?>.</p>

  <div class="avisoflujo">Ese mismo <code>JWT_SECRET</code> es el que usara despues el middleware
     <code>auth</code> con <code>jwt.verify(token, secret)</code>. Si cambias el secreto, todos los
     tokens ya emitidos dejan de valer.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. Recorrido completo de <code>POST /user/login</code></h2>

<pre class="flujo"><code>CLIENTE   POST /user/login   {email, password}
  ↓
Express   (express.json() llena req.body)
  ↓
app.use("/user", userRouter)
  ↓
userRouter.post("/login", userController.<?php hueco(31, 7); ?>)
  ↓
userController.login(req, res)
  ↓
req.body as <?php hueco(32, 11); ?>

  ↓
userService.<?php hueco(33, 7); ?>(userLogin)
  ↓
this.findByEmail(email, <?php hueco(34, 6); ?>)
  ↓
UserModel.<?php hueco(35, 9); ?>({email}, {password})
  ↓
MongoDB
  ↓
¿existe el usuario?
  ├── NO  →  throw "<?php hueco(36, 15); ?>"
  │
  └── SI
        ↓
      <?php hueco(37, 8); ?>.compare(contraseña enviada, hash de MongoDB)
        ↓
      ¿la contraseña coincide?
        ├── NO  →  throw "Not Authorized"
        │
        └── SI
              ↓
            <?php hueco(38, 14); ?>(id)
              ↓
            findById(id)  →  UserModel.findById()  →  MongoDB
              ↓
            jwt.<?php hueco(39, 6); ?>({id, name, email}, secret, {expiresIn:"1m"})
              ↓
            return { id, <?php hueco(40, 7); ?>, token }
              ↓
            const user = await userService.login(...)
              ↓
            res.<?php hueco(41, 6); ?>(user)
              ↓
            CLIENTE recibe el <?php hueco(42, 8); ?></code></pre>

  <p>El cliente recibe algo asi:</p>
<pre><code>{
  "id": "...",
  "roles": ["admin"],
  "token": "eyJhbGciOiJIUzI1Ni..."
}</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. De memoria: la linea completa</h2>
  <p>El login entero, linea a linea, sin mirar.</p>

  <?php linea(43, 'La <b>ruta</b> del login en <code>user.route.ts</code>:'); ?>
  <?php linea(44, 'En el controller: llamar al service con el cuerpo de la peticion:'); ?>
  <?php linea(45, 'En el service: buscar al usuario por email <b>trayendo tambien el password</b> (linea completa, con tipos):'); ?>
  <?php linea(46, 'En el service: <b>comparar</b> la contraseña enviada con el hash guardado (linea completa, con tipos):'); ?>
  <?php linea(47, 'El cuerpo de <code>findByEmail</code>: la consulta a Mongo con su proyeccion:'); ?>
  <?php linea(48, 'La primera linea de <code>generateToken</code>, que vuelve a buscar al usuario:'); ?>
  <?php linea(49, 'Obtener el <b>secreto</b> con el que se firma el token:'); ?>
  <?php linea(50, 'La propiedad <code>token</code> del objeto que devuelve <code>login</code> (sin la coma final):'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('tercero.php', 'quinto.php');
