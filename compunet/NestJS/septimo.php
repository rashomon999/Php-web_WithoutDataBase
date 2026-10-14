<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 7 — Autenticacion: registro, login, JWT y Passport
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A. user.service.ts → create (registro) --- */
    31 => 'hash',
    32 => '10',
    33 => 'ConflictException',
    34 => 'findOne',
    35 => 'bcrypt',
    36 => 'create',
    37 => 'save',

    /* --- B. auth.service.ts → loginUser --- */
    1  => 'bcrypt',
    2  => 'findOne',
    3  => 'compareSync',
    4  => 'UnauthorizedException',
    5  => 'sign',
    6  => 'user_id',
    7  => 'JwtService',
    8  => 'async loginUser(loginUserDto: LoginUserDto){',

    /* --- C. auth.module.ts → JwtModule.registerAsync --- */
    10 => 'registerAsync',
    11 => 'imports',
    12 => 'inject',
    13 => 'ConfigService',
    14 => 'useFactory',
    15 => 'secret',
    16 => 'signOptions',
    17 => 'expiresIn',
    18 => 'JWT_SECRET',
    19 => 'JWT_EXPIRES_IN',

    /* --- D. jwt.strategy.ts --- */
    20 => 'PassportStrategy',
    21 => 'Strategy',
    22 => 'fromAuthHeaderAsBearerToken',
    23 => 'ignoreExpiration',
    24 => 'secretOrKey',
    25 => 'validate',
    26 => 'user_id',
    27 => 'findById',
    28 => 'super',
    29 => 'ExtractJwt',
    30 => 'passport-jwt',

    /* --- E. Flujo completo --- */
    40 => 'LoginUserDto',
    41 => 'AuthService',
    42 => 'findOne',
    43 => 'compareSync',
    44 => 'sign',
    45 => '201',
    46 => 'AuthGuard',
    47 => 'jwt',
    48 => 'validate',
    49 => 'findById',
    50 => ['request.user', 'req.user'],

    /* --- F. Lineas completas --- */
    60 => 'const {password, email} = loginUserDto;',
    61 => 'if (!user || !bcrypt.compareSync(password, user.password))',
    62 => 'token: this.jwtService.sign({user_id: user.id})',
    63 => 'jwtFromRequest: ExtractJwt.fromAuthHeaderAsBearerToken(),',
    64 => 'const hashedPassword = await bcrypt.hash(createUserDto.password, 10);',
    65 => 'const {password, ...userRet} = user;',
    66 => "PassportModule.register({defaultStrategy: 'jwt'}),",
    67 => 'export class JwtStrategy extends PassportStrategy(Strategy) {',
];

$RETOS = [

'jwtstrategy' => [
    'titulo' => '<code>jwt.strategy.ts</code> (la clase completa, sin imports)',
    'huecos' => [20, 21, 22, 23, 24, 25, 26, 27, 28, 29],
    'codigo' => <<<'EOT'
@Injectable()
export class JwtStrategy extends PassportStrategy(Strategy) {
  constructor(
    private readonly configService: ConfigService,
    private readonly userService: UserService
  ) {
    super({
      jwtFromRequest: ExtractJwt.fromAuthHeaderAsBearerToken(),
      ignoreExpiration: false,
      secretOrKey: configService.get('JWT_SECRET') || '',
    });
  }

  async validate(payload: any) {
    const id = payload.user_id;
    const user = await this.userService.findById(id);

    if(!user)
        throw new UnauthorizedException('User doesnt exists');

    const {password, ...userRet} = user;

    return userRet;
  }
}
EOT
],

'loginuser' => [
    'titulo' => '<code>AuthService</code> (la clase, sin imports; respeta el <code>try/catch</code> tal cual esta)',
    'huecos' => [1, 2, 3, 4, 5, 6, 7, 8],
    'codigo' => <<<'EOT'
@Injectable()
export class AuthService {
  constructor(
    private readonly userService: UserService,
    private readonly jwtService: JwtService
  ){}

  async loginUser(loginUserDto: LoginUserDto){
    try {
      const {password, email} = loginUserDto;
      const user = await  this.userService.findOne(email);

      if (!user || !bcrypt.compareSync(password, user.password))
        throw new UnauthorizedException('Invalid Credentials');

      return  {
        user_id: user.id,
        email: user.email,
        roles: user.roles,
        token: this.jwtService.sign({user_id: user.id})
      }
    } catch (error) {

    }
  }
}
EOT
],

'jwtmodule' => [
    'titulo' => 'el bloque <code>JwtModule.registerAsync(...)</code> de <code>auth.module.ts</code>',
    'huecos' => [10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
    'codigo' => <<<'EOT'
JwtModule.registerAsync({
  imports: [ConfigModule],
  inject: [ConfigService],
  useFactory: (configService: ConfigService) => ({
    secret: configService.get('JWT_SECRET') as string | 'secret',
    signOptions:{expiresIn: configService.get('JWT_EXPIRES_IN') | 600}
  })
})
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Que es un <b>JWT</b> y que contiene el que fabrica <code>jwtService.sign({user_id: user.id})</code>?',
        'opciones' => [
            'a' => 'Una sesion guardada en la base de datos.',
            'b' => 'Un texto con tres partes <code>cabecera.payload.firma</code>. El <b>payload</b> lleva <code>user_id</code> mas <code>iat</code> (cuando se emitio) y <code>exp</code> (cuando caduca); la <b>firma</b> se calcula con <code>JWT_SECRET</code>.',
            'c' => 'Un token cifrado: nadie puede leer su contenido sin la clave.',
            'd' => 'Una cookie de Express.',
        ],
        'correcta' => 'b',
        'porque'   => 'Un JWT esta <b>firmado, no cifrado</b>: cualquiera puede decodificar el payload (base64). La firma solo garantiza que <b>nadie lo modifico</b>. Por eso nunca se ponen secretos (contraseñas) en el payload; aqui solo va el id.',
    ],
    'm2' => [
        'texto'    => '¿Por que se guarda la contraseña con <code>bcrypt.hash</code> y no tal cual?',
        'opciones' => [
            'a' => 'Para ocupar menos espacio.',
            'b' => 'Porque asi se puede recuperar si el usuario la olvida.',
            'c' => 'Porque el hash es <b>de un solo sentido</b>: si roban la BD no obtienen las claves reales. El login compara con <code>bcrypt.compareSync</code>, que vuelve a calcular el hash.',
            'd' => 'Porque Postgres no admite texto plano.',
        ],
        'correcta' => 'c',
        'porque'   => 'Ademas bcrypt añade un <b>salt</b> aleatorio, asi dos usuarios con la misma clave tienen hashes distintos, y el <code>10</code> (coste) lo hace lento a proposito para frenar la fuerza bruta.',
    ],
    'm3' => [
        'texto'    => '¿Por que <code>loginUser</code> lanza el <b>mismo</b> <code>Invalid Credentials</code> tanto si el email no existe como si la clave es incorrecta?',
        'opciones' => [
            'a' => 'Por pereza.',
            'b' => 'Porque <code>compareSync</code> no puede distinguirlos.',
            'c' => 'Para no revelar <b>cual</b> de las dos cosas fallo: si dijera "ese email no existe", un atacante podria descubrir que emails estan registrados (<i>enumeracion de usuarios</i>).',
            'd' => 'Porque Nest solo permite un mensaje.',
        ],
        'correcta' => 'c',
        'porque'   => 'Detalle en el codigo: <code>!user || !bcrypt.compareSync(...)</code>. El <code>||</code> corta en corto: si <code>user</code> es <code>null</code>, ni siquiera se llama a <code>compareSync</code> (que reventaria al leer <code>user.password</code>).',
    ],
    'm4' => [
        'texto'    => '¿Que diferencia hay entre <code>bcrypt.compareSync(...)</code> y <code>await bcrypt.compare(...)</code>?',
        'opciones' => [
            'a' => 'Ninguna.',
            'b' => '<code>compareSync</code> <b>bloquea</b> el hilo de Node mientras calcula el hash; <code>compare</code> es asincrona y no bloquea. En una API con mucho trafico es preferible la asincrona.',
            'c' => '<code>compare</code> no funciona con hashes.',
            'd' => '<code>compareSync</code> es mas segura.',
        ],
        'correcta' => 'b',
        'porque'   => 'Nota: en <code>UserService.create</code> el profe si usa la version asincrona (<code>await bcrypt.hash</code>) pero en el login usa la sincrona (<code>compareSync</code>). Mismo resultado; distinta politica.',
    ],
    'm5' => [
        'texto'    => '¿Que es <code>JwtModule.registerAsync</code> y por que se usa en vez de <code>JwtModule.register({secret: \'SECRETA\', ...})</code> (que esta comentado)?',
        'opciones' => [
            'a' => 'Porque la version <code>register</code> esta obsoleta.',
            'b' => 'Para que el token se firme mas rapido.',
            'c' => 'Porque permite <b>obtener la configuracion de forma dinamica</b> inyectando <code>ConfigService</code> (<code>inject</code> + <code>useFactory</code>): asi el secreto sale del <code>.env</code> y no queda escrito en el codigo.',
            'd' => 'Para tener dos claves distintas.',
        ],
        'correcta' => 'c',
        'porque'   => 'Un secreto escrito en el codigo acaba en git. Con <code>registerAsync</code>, Nest espera a tener listo el <code>ConfigService</code>, ejecuta la <code>useFactory</code> con el y usa lo que devuelva.',
    ],
    'm6' => [
        'texto'    => '<code>signOptions: {expiresIn: 600}</code>. ¿Cuanto dura el token?',
        'opciones' => [
            'a' => '600 milisegundos.',
            'b' => '600 minutos.',
            'c' => '600 horas.',
            'd' => '600 <b>segundos</b> (10 minutos). Un numero se interpreta como segundos; un string como <code>"10m"</code> o <code>"1h"</code> lleva unidad.',
        ],
        'correcta' => 'd',
        'porque'   => 'Es la convencion de la libreria <code>jsonwebtoken</code>. Al pasar el tiempo, <code>ExtractJwt</code>/<code>passport-jwt</code> rechaza el token (por <code>ignoreExpiration: false</code>) y la ruta protegida responde 401.',
    ],
    'm7' => [
        'texto'    => '¿Que hace <code>ExtractJwt.fromAuthHeaderAsBearerToken()</code>?',
        'opciones' => [
            'a' => 'Lee el token del <b>header</b> <code>Authorization: Bearer &lt;token&gt;</code>.',
            'b' => 'Lee el token de una cookie.',
            'c' => 'Lo lee del body del POST.',
            'd' => 'Lo genera.',
        ],
        'correcta' => 'a',
        'porque'   => 'Si mandas <code>Authorization: &lt;token&gt;</code> (sin la palabra <code>Bearer</code>) o <code>Token &lt;token&gt;</code>, la estrategia no lo encuentra y la respuesta es <b>401</b>. Otras opciones existen: <code>fromHeader</code>, <code>fromBodyField</code>, <code>fromUrlQueryParameter</code>.',
    ],
    'm8' => [
        'texto'    => '¿Que verifica <b>passport-jwt</b> por ti <b>antes</b> de llamar a <code>validate(payload)</code>?',
        'opciones' => [
            'a' => 'Que el usuario exista en la base de datos.',
            'b' => 'Que la <b>firma</b> sea valida con <code>secretOrKey</code> y que el token <b>no haya expirado</b>. Solo si ambas cosas pasan se ejecuta <code>validate</code>.',
            'c' => 'Que el usuario tenga el rol correcto.',
            'd' => 'Nada: todo lo hace <code>validate</code>.',
        ],
        'correcta' => 'b',
        'porque'   => 'Reparto de trabajo: la libreria comprueba <b>criptografia y caducidad</b>; <code>validate</code> es donde <b>tu</b> decides si el usuario todavia es valido (buscarlo en BD) y que objeto queda en <code>request.user</code>.',
    ],
    'm9' => [
        'texto'    => '¿Para que sirve el <b>valor que devuelve</b> <code>validate(payload)</code>?',
        'opciones' => [
            'a' => 'Se manda como respuesta al cliente.',
            'b' => 'Se guarda en la base de datos.',
            'c' => 'Passport lo asigna a <code>request.user</code>; ahi lo leen despues <code>UserRoleGuard</code> y el decorador <code>@UserDecorator()</code>.',
            'd' => 'Se descarta.',
        ],
        'correcta' => 'c',
        'porque'   => 'Por eso <code>UserRoleGuard</code> puede hacer <code>context.switchToHttp().getRequest().user</code>: lo puso la estrategia. Es el puente entre <b>autenticacion</b> (quien eres) y <b>autorizacion</b> (que puedes hacer).',
    ],
    'm10' => [
        'texto'    => '<code>const {password, ...userRet} = user; return userRet;</code> ¿Que hace?',
        'opciones' => [
            'a' => 'Copia el usuario completo.',
            'b' => 'Borra el password de la base de datos.',
            'c' => 'Encripta el password.',
            'd' => 'Desestructura: saca <code>password</code> aparte y junta <b>todo lo demas</b> (operador <i>rest</i> <code>...</code>) en <code>userRet</code>; asi <code>request.user</code> no lleva el hash.',
        ],
        'correcta' => 'd',
        'porque'   => 'Buena practica: no arrastrar el hash por toda la app. Ojo: <code>UserService.create/findAll</code> <b>si</b> devuelven el hash al cliente (ver el cuestionario de bugs).',
    ],
    'm11' => [
        'texto'    => 'Un usuario hace login, recibe un token de 10 minutos y a los 3 minutos alguien <b>borra</b> a ese usuario de la BD. Con el token aun vigente llama a <code>GET /auth/private1</code>. ¿Que pasa?',
        'opciones' => [
            'a' => '200, porque el token es valido.',
            'b' => 'La firma y la caducidad pasan, pero <code>validate</code> hace <code>findById(id)</code>, que <b>lanza <code>NotFoundException</code></b> (404) al no encontrarlo; el <code>if(!user)</code> con su 401 nunca se alcanza.',
            'c' => '401, siempre.',
            'd' => '500.',
        ],
        'correcta' => 'b',
        'porque'   => 'Es un caso borde interesante: la <b>intencion</b> del profe era 401 ("User doesnt exists"), pero como <code>findById</code> ya lanza su propia excepcion, el resultado real es <b>404</b>. Lo coherente seria devolver 401.',
    ],
    'm12' => [
        'texto'    => 'Un atacante modifica el <code>user_id</code> del payload del token (cambiando el base64) y lo manda. ¿Que pasa?',
        'opciones' => [
            'a' => 'Accede como el otro usuario.',
            'b' => 'Se descubre la clave secreta.',
            'c' => 'La <b>firma deja de coincidir</b> con el contenido; passport-jwt rechaza el token y responde 401 sin llamar a <code>validate</code>.',
            'd' => 'El token se regenera solo.',
        ],
        'correcta' => 'c',
        'porque'   => 'Esa es toda la gracia de la firma: sin <code>JWT_SECRET</code> no puedes fabricar una firma valida para un payload distinto. Por eso el secreto debe ser largo, aleatorio y estar solo en el servidor.',
    ],
    'm13' => [
        'texto'    => '¿En que archivo se <b>registra</b> que <code>AuthGuard()</code> (sin argumentos) debe usar la estrategia <code>jwt</code>?',
        'opciones' => [
            'a' => 'En <code>main.ts</code>.',
            'b' => 'En <code>auth.module.ts</code>: <code>PassportModule.register({defaultStrategy: \'jwt\'})</code>. Sin eso habria que escribir <code>AuthGuard(\'jwt\')</code> en cada uso.',
            'c' => 'En <code>jwt.strategy.ts</code>.',
            'd' => 'En el <code>.env</code>.',
        ],
        'correcta' => 'b',
        'porque'   => 'El nombre <code>\'jwt\'</code> es el que <code>PassportStrategy(Strategy)</code> asigna por defecto a la estrategia de <code>passport-jwt</code>. <code>defaultStrategy</code> hace que <code>AuthGuard()</code> use ese sin repetirlo.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 7 — Autenticacion con JWT', 'bcrypt, login, JwtModule, Passport, JwtStrategy y request.user');
?>

<div class="card">
  <h2>A. Registro: <code>UserService.create</code> — guardar la clave como hash</h2>

<pre><code>async create(createUserDto: CreateUserDto): Promise&lt;User&gt; {
    const existingUser = await this.<?php hueco(34, 8); ?>(createUserDto.email);

    if (existingUser)
      throw new <?php hueco(33, 17); ?>('Email already in use');

    const hashedPassword = await <?php hueco(35, 8); ?>.<?php hueco(31, 5); ?>(createUserDto.password, <?php hueco(32, 3); ?>);

    const user = this.userRepository.<?php hueco(36, 7); ?> (
      {
        ...createUserDto,
        password: hashedPassword
      });

    return this.userRepository.<?php hueco(37, 5); ?>(user);
}</code></pre>

  <div class="avisoflujo"><code>{...createUserDto, password: hashedPassword}</code>: se copian todos los campos del DTO y
     luego se <b>sobrescribe</b> <code>password</code> con el hash. El orden importa: si <code>password</code> fuera primero,
     el <code>...createUserDto</code> lo volveria a pisar con la clave en claro.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>auth.service.ts</code> — el login</h2>

<pre><code>import * as <?php hueco(1, 8); ?> from 'bcrypt';

@Injectable()
export class AuthService {
  constructor(
    private readonly userService: UserService,
    private readonly jwtService: <?php hueco(7, 10); ?>
  ){}

  <?php firma(8, 46); ?>

    try {
      const {password, email} = loginUserDto;
      const user = await this.userService.<?php hueco(2, 8); ?>(email);

      if (!user || !bcrypt.<?php hueco(3, 12); ?>(password, user.password))
        throw new <?php hueco(4, 21); ?>('Invalid Credentials');

      return {
        user_id: user.id,
        email: user.email,
        roles: user.roles,
        token: this.jwtService.<?php hueco(5, 5); ?>({<?php hueco(6, 8); ?>: user.id})
      }
    } catch (error) {

    }
  }
}</code></pre>

  <div class="nota"><b>¡Ojo al <code>catch</code> vacio!</b> Se estudia con detalle en el cuestionario de bugs:
     la excepcion 401 que se lanza dentro del <code>try</code> es <b>tragada</b> por ese <code>catch</code>.</div>

  <?php reto('loginuser'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>auth.module.ts</code> — configurar el JWT desde el <code>.env</code></h2>

<pre><code>JwtModule.<?php hueco(10, 13); ?>({
  <?php hueco(11, 7); ?>: [ConfigModule],
  <?php hueco(12, 6); ?>: [<?php hueco(13, 13); ?>],
  <?php hueco(14, 10); ?>: (configService: ConfigService) =&gt; ({
    <?php hueco(15, 6); ?>: configService.get('<?php hueco(18, 10); ?>') as string | 'secret',
    <?php hueco(16, 11); ?>:{<?php hueco(17, 9); ?>: configService.get('<?php hueco(19, 14); ?>') | 600}
  })
})</code></pre>

  <div class="nota">Lectura de <code>registerAsync</code>: "importa <code>ConfigModule</code>, <b>inyecta</b> el
     <code>ConfigService</code> y con el (<code>useFactory</code>) arma la configuracion". Es el mismo patron de
     <b>inyeccion de dependencias</b> aplicado a la configuracion de un modulo.</div>

  <?php reto('jwtmodule'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. <code>jwt.strategy.ts</code> — como Passport valida el token</h2>

<pre><code>import { <?php hueco(29, 10); ?>, Strategy } from '<?php hueco(30, 12); ?>';

@Injectable()
export class JwtStrategy extends <?php hueco(20, 16); ?>(<?php hueco(21, 8); ?>) {
  constructor(
    private readonly configService: ConfigService,
    private readonly userService: UserService
  ) {
    <?php hueco(28, 5); ?>({
      jwtFromRequest: ExtractJwt.<?php hueco(22, 27); ?>(),
      <?php hueco(23, 16); ?>: false,
      <?php hueco(24, 11); ?>: configService.get('JWT_SECRET') || '',
    });
  }

  async <?php hueco(25, 8); ?>(payload: any) {
    const id = payload.<?php hueco(26, 7); ?>;
    const user = await this.userService.<?php hueco(27, 8); ?>(id);

    if(!user)
        throw new UnauthorizedException('User doesnt exists');

    const {password, ...userRet} = user;
    return userRet;
  }
}</code></pre>

  <div class="avisoflujo"><code>super({...})</code> le pasa a la clase padre <b>como leer y como verificar</b> el token
     (donde esta y con que clave). <code>validate</code> es el gancho que Passport llama <b>despues</b> de verificar la firma,
     con el payload ya decodificado.</div>

  <?php reto('jwtstrategy'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Recorrido completo: de <code>login</code> a una ruta protegida</h2>

<pre class="flujo"><code>POST /auth/login   {"email": "...", "password": "..."}
  ↓
ValidationPipe  →  valida el body con <?php hueco(40, 12); ?>
  ↓
AuthController.loginUser  →  <?php hueco(41, 11); ?>.loginUser(dto)
  ↓
userService.<?php hueco(42, 8); ?>(email)         →  SELECT en Postgres
  ↓
bcrypt.<?php hueco(43, 12); ?>(password, user.password)     →  ¿coincide con el hash?
  ↓
jwtService.<?php hueco(44, 5); ?>({user_id})           →  token firmado con JWT_SECRET
  ↓
<?php hueco(45, 4); ?> Created  +  {user_id, email, roles, token}


GET /auth/private1   Authorization: Bearer &lt;token&gt;
  ↓
<?php hueco(46, 9); ?>()   →  usa la estrategia '<?php hueco(47, 4); ?>'
  ↓
ExtractJwt saca el token del header  →  verifica firma y caducidad
  ↓
JwtStrategy.<?php hueco(48, 8); ?>(payload)   →   userService.<?php hueco(49, 8); ?>(payload.user_id)
  ↓
lo que devuelve validate  →  queda en <?php hueco(50, 12); ?>
  ↓
el handler responde 'Ruta protegida 1'</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. De memoria: la linea completa</h2>

  <?php linea(60, 'En <code>loginUser</code>: sacar <code>password</code> y <code>email</code> del DTO con desestructuracion:'); ?>
  <?php linea(61, 'La condicion del login: no hay usuario <b>o</b> la clave no coincide con el hash (en una linea, sin la llave):'); ?>
  <?php linea(62, 'La propiedad <code>token</code> del objeto que devuelve el login (firmar con <code>user_id</code>):'); ?>
  <?php linea(63, 'En la estrategia: de donde se lee el token (con la coma final):'); ?>
  <?php linea(64, 'En el registro: calcular el hash de la clave con coste 10 (con <code>const hashedPassword =</code>):'); ?>
  <?php linea(65, 'En <code>validate</code>: quitar el password del usuario que se devuelve (desestructuracion con rest):'); ?>
  <?php linea(66, 'En <code>AuthModule</code>: que <code>AuthGuard()</code> use jwt por defecto (con la coma final):'); ?>
  <?php linea(67, 'La declaracion de la clase de la estrategia:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); mc('m9'); mc('m10'); mc('m11'); mc('m12'); mc('m13'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('sexto.php', 'octavo.php');
