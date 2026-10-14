<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 8 — Guards, decoradores propios y roles (autorizacion)
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A. app-roles.ts y role-protected.decorator.ts --- */
    1  => 'const',
    2  => 'enum',
    3  => 'admin',
    4  => 'editor',
    5  => 'META_ROLES',
    6  => 'SetMetadata',
    7  => '...roles',

    /* --- B. user-role.guard.ts --- */
    10 => 'CanActivate',
    11 => 'Reflector',
    12 => 'ExecutionContext',
    13 => 'get',
    14 => 'getHandler',
    15 => 'switchToHttp',
    16 => 'getRequest',
    17 => 'includes',
    18 => 'BadRequestException',
    19 => 'ForbiddenException',
    20 => 'canActivate(context: ExecutionContext): boolean | Promise<boolean> | Observable<boolean> {',
    21 => 'implements',

    /* --- C. auth.decorator.ts --- */
    22 => 'applyDecorators',
    23 => 'UseGuards',
    24 => 'AuthGuard',
    25 => 'UserRoleGuard',
    26 => 'RoleProtected',

    /* --- D. user.decorator.ts --- */
    27 => 'createParamDecorator',
    28 => 'data',
    29 => 'user',
    30 => 'ctx',

    /* --- E. Tabla de resultados --- */
    31 => '200',
    32 => '403',
    33 => '403',
    34 => '200',
    35 => '200',
    36 => '200',
    37 => '200',
    38 => '403',
    39 => '200',
    40 => '200',
    41 => '200',
    42 => '200',
    43 => '401',

    /* --- F. Recorrido de un 403 --- */
    44 => 'AuthGuard',
    45 => 'UserRoleGuard',
    46 => 'reflector',
    47 => 'ForbiddenException',
    48 => '403',

    /* --- G. Lineas completas --- */
    60 => "export const META_ROLES = 'roles';",
    61 => 'export const RoleProtected = (...roles: string[]) => {',
    62 => 'return(SetMetadata(META_ROLES, roles));',
    63 => 'const validRoles: string[] = this.reflector.get<string[]>(META_ROLES, context.getHandler());',
    64 => 'const user = context.switchToHttp().getRequest().user;',
    65 => 'if (validRoles.includes(role))',
    66 => '@UseGuards(AuthGuard(), UserRoleGuard)',
    67 => '@Auth(AppRoles.admin, AppRoles.user)',
    68 => 'return data ? user?.[data]: user;',
];

$RETOS = [

'roles' => [
    'titulo' => '<code>app-roles.ts</code>',
    'huecos' => [1, 2, 3, 4],
    'codigo' => <<<'EOT'
export const META_ROLES = 'roles';

export enum AppRoles {
    admin='admin',
    user='user',
    superuser='superuser',
    editor='editor'
}
EOT
],

'roleprotected' => [
    'titulo' => '<code>role-protected.decorator.ts</code>',
    'huecos' => [5, 6, 7],
    'codigo' => <<<'EOT'
import { SetMetadata } from "@nestjs/common"
import { META_ROLES } from "../interfaces/app-roles"

export const RoleProtected = (...roles: string[]) => {
    return(SetMetadata(META_ROLES, roles));
}
EOT
],

'guard' => [
    'titulo' => '<code>user-role.guard.ts</code> (la clase completa, sin imports)',
    'huecos' => [10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21],
    'codigo' => <<<'EOT'
@Injectable()
export class UserRoleGuard implements CanActivate {
  constructor (
    private readonly reflector: Reflector
  ){}

  canActivate(
    context: ExecutionContext,
  ): boolean | Promise<boolean> | Observable<boolean> {

    const  validRoles: string [] = this.reflector.get<string[]>(META_ROLES, context.getHandler());

    if(!validRoles || validRoles.length===0)
      return true;

    const user =  context.switchToHttp().getRequest().user;

    if (!user)
      throw new  BadRequestException("user not found");

    for (const role of user.roles) {
      if (validRoles.includes(role))
        return true
    }
    console.log(validRoles);

    throw new ForbiddenException("user doesn't have required role");

  }
}
EOT
],

'authdecorator' => [
    'titulo' => '<code>auth.decorator.ts</code>',
    'huecos' => [22, 23, 24, 25, 26],
    'codigo' => <<<'EOT'
import { applyDecorators, UseGuards } from "@nestjs/common";
import { AppRoles } from "../interfaces/app-roles";
import { RoleProtected } from "./role-protected.decorator";
import { AuthGuard } from "@nestjs/passport";
import { UserRoleGuard } from "../guards/user-role/user-role.guard";

export const Auth = (...roles: AppRoles[]) => {
    return applyDecorators(
        RoleProtected(...roles),
        UseGuards(AuthGuard(), UserRoleGuard)
    )
}
EOT
],

'userdecorator' => [
    'titulo' => '<code>user.decorator.ts</code>',
    'huecos' => [27, 28, 29, 30],
    'codigo' => <<<'EOT'
import { createParamDecorator, ExecutionContext } from "@nestjs/common";

export const  UserDecorator =  createParamDecorator(
    (data: string, ctx: ExecutionContext) => {
        const request = ctx.switchToHttp().getRequest();
        const user = request.user;

        return data ? user?.[data]: user;
    }
)
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Cual es la diferencia entre <b>autenticacion</b> y <b>autorizacion</b>, y donde vive cada una en el repo?',
        'opciones' => [
            'a' => 'Autenticacion = saber <b>quien eres</b> (<code>AuthGuard()</code> + <code>JwtStrategy</code>); autorizacion = saber <b>que puedes hacer</b> (<code>UserRoleGuard</code> con los roles).',
            'b' => 'Son lo mismo con distinto nombre.',
            'c' => 'Autorizacion = login; autenticacion = roles.',
            'd' => 'Autenticacion es solo para admins.',
        ],
        'correcta' => 'a',
        'porque'   => 'Se ven en los codigos de estado: fallar la autenticacion &rarr; 401. Fallar la autorizacion &rarr; 403.',
    ],
    'm2' => [
        'texto'    => '¿Que es un <b>Guard</b> y que devuelve <code>canActivate</code>?',
        'opciones' => [
            'a' => 'Una clase con <code>canActivate(context)</code> que decide si la peticion <b>puede seguir</b> hacia el handler: devuelve <code>true</code> (pasa) o <code>false</code>/lanza excepcion (se corta).',
            'b' => 'Un pipe que transforma datos.',
            'c' => 'Un servicio de acceso a base de datos.',
            'd' => 'Un middleware de Express identico.',
        ],
        'correcta' => 'a',
        'porque'   => 'Puede devolver <code>boolean</code>, <code>Promise&lt;boolean&gt;</code> u <code>Observable&lt;boolean&gt;</code> (por eso la firma larga del guard). Si devuelve <code>false</code>, Nest responde <b>403 Forbidden</b> por defecto.',
    ],
    'm3' => [
        'texto'    => '¿Que es <code>ExecutionContext</code> y para que se usa <code>switchToHttp().getRequest()</code>?',
        'opciones' => [
            'a' => 'Una variable de entorno.',
            'b' => 'Un envoltorio con la informacion de <b>lo que se esta ejecutando</b>. Como Nest soporta HTTP, WebSockets y microservicios, <code>switchToHttp()</code> indica "estoy en HTTP" y <code>getRequest()</code> devuelve el objeto request de Express.',
            'c' => 'El contexto de la base de datos.',
            'd' => 'Un hilo nuevo.',
        ],
        'correcta' => 'b',
        'porque'   => 'Asi el mismo guard podria funcionar en otros transportes. El request contiene <code>user</code>, que puso Passport tras validar el JWT.',
    ],
    'm4' => [
        'texto'    => '¿Que es <code>SetMetadata(\'roles\', [\'admin\', \'editor\'])</code> y quien lo lee despues?',
        'opciones' => [
            'a' => 'Cambia los roles de un usuario en la BD.',
            'b' => 'Crea una variable global.',
            'c' => 'Emite un evento.',
            'd' => '<b>Adjunta un dato</b> (clave <code>roles</code>, valor el arreglo) al metodo del controller. No hace nada por si mismo: lo lee el <code>Reflector</code> dentro de <code>UserRoleGuard</code> con <code>reflector.get(META_ROLES, context.getHandler())</code>.',
        ],
        'correcta' => 'd',
        'porque'   => 'Es un patron muy Nest: el decorador solo <i>etiqueta</i> y el guard <i>actua segun la etiqueta</i>. Por eso la clave (<code>\'roles\'</code>) debe ser <b>identica</b> en los dos lados: de ahi la constante <code>META_ROLES</code>.',
    ],
    'm5' => [
        'texto'    => '¿Que ventaja tiene <code>@RoleProtected(AppRoles.admin, AppRoles.editor)</code> sobre <code>@SetMetadata(\'roles\', [\'admin\',\'editor\'])</code>?',
        'opciones' => [
            'a' => 'Es mas rapido.',
            'b' => 'Funciona en mas versiones.',
            'c' => 'Evita las <b>cadenas magicas</b>: un typo en <code>\'roles\'</code> o en <code>\'admn\'</code> no lo detecta nadie, mientras que con la constante y el enum el compilador y el editor te avisan y autocompletan.',
            'd' => 'Ninguna, hacen distinto.',
        ],
        'correcta' => 'c',
        'porque'   => 'Hacen <b>exactamente lo mismo</b> (<code>RoleProtected</code> llama internamente a <code>SetMetadata(META_ROLES, roles)</code>). Es un refactor: de "string magico" a decorador tipado.',
    ],
    'm6' => [
        'texto'    => '¿Que hace <code>applyDecorators</code> en <code>@Auth(...)</code>?',
        'opciones' => [
            'a' => 'Ejecuta los decoradores en paralelo.',
            'b' => 'Combina <b>varios decoradores en uno solo</b>: <code>@Auth(admin, user)</code> equivale a poner <code>@RoleProtected(admin, user)</code> y <code>@UseGuards(AuthGuard(), UserRoleGuard)</code> a la vez.',
            'c' => 'Desactiva los guards.',
            'd' => 'Crea un decorador de clase.',
        ],
        'correcta' => 'b',
        'porque'   => 'Es la evolucion natural: <code>private1</code> &rarr; <code>private2</code> &rarr; <code>private3</code> &rarr; <code>private4</code> son <b>cuatro versiones de lo mismo</b>, cada una mas limpia que la anterior.',
    ],
    'm7' => [
        'texto'    => 'Un usuario con roles <code>[\'user\']</code> llama a <code>GET /auth/private3</code> (<code>@RoleProtected(admin, editor)</code>) con un token valido. ¿Resultado?',
        'opciones' => [
            'a' => '200.',
            'b' => '401.',
            'c' => '<b>403</b> <code>user doesn\'t have required role</code>: la autenticacion pasa, la autorizacion no.',
            'd' => '400.',
        ],
        'correcta' => 'c',
        'porque'   => 'El guard recorre <code>user.roles</code> buscando alguno dentro de <code>validRoles</code>; <code>\'user\'</code> no esta en <code>[\'admin\',\'editor\']</code>, asi que cae al <code>throw new ForbiddenException</code> final.',
    ],
    'm8' => [
        'texto'    => 'Un usuario con roles <code>[\'user\', \'editor\']</code> llama a <code>private3</code> (<code>admin</code> o <code>editor</code>). ¿Resultado?',
        'opciones' => [
            'a' => '403, porque tambien tiene <code>user</code>.',
            'b' => '<b>200</b>: basta con que <b>uno</b> de sus roles este entre los permitidos (<code>for ... includes ... return true</code>).',
            'c' => '401.',
            'd' => '200 solo si tiene todos los roles.',
        ],
        'correcta' => 'b',
        'porque'   => 'La logica es <b>OR</b> (cualquier rol vale), no <b>AND</b>. Para exigir todos los roles habria que cambiar el bucle por un <code>every</code>.',
    ],
    'm9' => [
        'texto'    => 'Cambias el orden a <code>@UseGuards(UserRoleGuard, AuthGuard())</code> en una ruta con <code>@RoleProtected(...)</code>. Llamas con un token perfectamente valido. ¿Que pasa?',
        'opciones' => [
            'a' => 'Funciona igual: el orden es indiferente.',
            'b' => '<b>400</b> <code>user not found</code>: los guards corren de izquierda a derecha, asi que <code>UserRoleGuard</code> se ejecuta <b>antes</b> de que <code>AuthGuard()</code> haya puesto el usuario en <code>request.user</code>.',
            'c' => '401.',
            'd' => '403.',
        ],
        'correcta' => 'b',
        'porque'   => 'Aqui el orden si importa: <b>primero autenticar (llena request.user), luego autorizar (lo lee)</b>. Es la razon por la que en el repo siempre es <code>AuthGuard(), UserRoleGuard</code>.',
    ],
    'm10' => [
        'texto'    => '¿Importa el orden entre <code>@UseGuards(...)</code> y <code>@RoleProtected(...)</code> (uno encima del otro) en un metodo?',
        'opciones' => [
            'a' => 'No: ambos solo <b>anotan</b> el metodo; el guard lee la metadata cuando llega la peticion, cuando las dos anotaciones ya existen.',
            'b' => 'Si: el de arriba se ejecuta primero.',
            'c' => 'Si, si estan al reves da error de compilacion.',
            'd' => 'Solo importa en produccion.',
        ],
        'correcta' => 'a',
        'porque'   => 'Distingue dos momentos: <b>al cargar la clase</b> se aplican los decoradores (dejando metadata); <b>en cada peticion</b> se ejecutan los guards. Lo unico que importa es el orden <i>dentro</i> de <code>UseGuards(a, b)</code>.',
    ],
    'm11' => [
        'texto'    => 'Pones <code>@RoleProtected(AppRoles.admin)</code> sobre la <b>clase</b> del controller (no sobre un metodo). El guard usa <code>reflector.get(META_ROLES, context.getHandler())</code>. ¿Que pasa?',
        'opciones' => [
            'a' => 'Se aplica a todos los metodos.',
            'b' => 'Error al arrancar.',
            'c' => '<code>getHandler()</code> es el <b>metodo</b>, y la metadata esta en la <b>clase</b>: <code>validRoles</code> queda <code>undefined</code> y el guard hace <code>return true</code>. Cualquier usuario autenticado pasa: un <b>agujero de seguridad silencioso</b>.',
            'd' => '403 siempre.',
        ],
        'correcta' => 'c',
        'porque'   => 'Para leer de ambos sitios se usa <code>reflector.getAllAndOverride(META_ROLES, [context.getHandler(), context.getClass()])</code>. Con <code>get</code> + <code>getHandler()</code> solo se mira el metodo.',
    ],
    'm12' => [
        'texto'    => 'Una ruta con <code>@Auth()</code> (sin roles). ¿Quien puede entrar?',
        'opciones' => [
            'a' => 'Nadie.',
            'b' => 'Cualquiera, incluso sin token.',
            'c' => 'Solo admin.',
            'd' => 'Cualquier usuario <b>autenticado</b> (token valido): <code>AuthGuard()</code> sigue exigiendo login, y como el arreglo de roles va vacio, <code>UserRoleGuard</code> hace <code>return true</code>.',
        ],
        'correcta' => 'd',
        'porque'   => 'Es la linea <code>if(!validRoles || validRoles.length===0) return true;</code>. Sin roles = "solo hace falta estar logueado". Igual que <code>private1</code>.',
    ],
    'm13' => [
        'texto'    => 'Los roles no viajan en el JWT (solo <code>user_id</code>). Si a un usuario le quitan el rol <code>editor</code> en la BD mientras su token sigue vigente, ¿cuando deja de poder entrar a una ruta de editor?',
        'opciones' => [
            'a' => 'Cuando caduque el token.',
            'b' => 'Cuando reinicie el servidor.',
            'c' => 'Nunca.',
            'd' => '<b>Inmediatamente</b>: en cada peticion <code>JwtStrategy.validate</code> vuelve a leer el usuario de la BD, asi que <code>request.user.roles</code> siempre esta al dia.',
        ],
        'correcta' => 'd',
        'porque'   => 'Ventaja de no guardar roles en el token: los cambios de permisos son inmediatos. Coste: una consulta a la BD por cada peticion protegida.',
    ],
    'm14' => [
        'texto'    => '¿Que devuelve <code>@UserDecorator(\'email\')</code> frente a <code>@UserDecorator()</code>?',
        'opciones' => [
            'a' => 'Ambos devuelven el usuario completo.',
            'b' => 'Con <code>\'email\'</code> lanza error.',
            'c' => 'Con <code>\'email\'</code> devuelve <code>request.user.email</code> (<code>data ? user?.[data] : user</code>); sin argumento devuelve el objeto <code>user</code> entero.',
            'd' => 'Con <code>\'email\'</code> lee el email del body.',
        ],
        'correcta' => 'c',
        'porque'   => 'El primer parametro de <code>createParamDecorator</code> (<code>data</code>) es lo que escribes entre los parentesis del decorador. Y <code>user?.[data]</code> es <i>optional chaining</i>: si <code>user</code> no existe devuelve <code>undefined</code> en vez de reventar.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 8 — Guards, decoradores y roles', 'AuthGuard, UserRoleGuard, Reflector, SetMetadata, applyDecorators y createParamDecorator');
?>

<div class="card">
  <h2>A. Las piezas de metadata: <code>app-roles.ts</code> y <code>role-protected.decorator.ts</code></h2>

<pre><code>export <?php hueco(1, 5); ?> META_ROLES = 'roles';

export <?php hueco(2, 4); ?> AppRoles {
    admin='<?php hueco(3, 6); ?>',
    user='user',
    superuser='superuser',
    <?php hueco(4, 6); ?>='editor'
}

// role-protected.decorator.ts
export const RoleProtected = (<?php hueco(7, 9); ?>: string[]) =&gt; {
    return(<?php hueco(6, 11); ?>(<?php hueco(5, 10); ?>, roles));
}</code></pre>

  <div class="nota">Lo unico que hace <code>RoleProtected</code> es <b>etiquetar</b> el metodo con
     <code>roles = [...]</code>. Todo el trabajo de comprobar lo hace el guard. Un <code>enum</code> da un conjunto
     cerrado de valores validos (<code>admin | user | superuser | editor</code>).</div>

  <?php reto('roles'); ?>
  <?php reto('roleprotected'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>user-role.guard.ts</code> — el guard que decide</h2>

<pre><code>@Injectable()
export class UserRoleGuard <?php hueco(21, 10); ?> <?php hueco(10, 11); ?> {
  constructor (
    private readonly reflector: <?php hueco(11, 9); ?>
  ){}

  <?php firma(20, 88); ?>

    const validRoles: string[] = this.reflector.<?php hueco(13, 3); ?>&lt;string[]&gt;(META_ROLES, context.<?php hueco(14, 10); ?>());

    if(!validRoles || validRoles.length===0)
      return true;

    const user = context.<?php hueco(15, 12); ?>().<?php hueco(16, 10); ?>().user;

    if (!user)
      throw new <?php hueco(18, 19); ?>("user not found");

    for (const role of user.roles) {
      if (validRoles.<?php hueco(17, 8); ?>(role))
        return true
    }

    throw new <?php hueco(19, 18); ?>("user doesn't have required role");
  }
}</code></pre>

  <p>El parametro de <code>canActivate</code> es de tipo <code><?php hueco(12, 16); ?></code>.</p>

  <div class="avisoflujo">
     <b>Los cuatro finales posibles del guard:</b><br>
     1) la ruta no tiene roles &rarr; <code>return true</code> (pasa cualquiera) &nbsp;|&nbsp;
     2) no hay <code>request.user</code> &rarr; <b>400</b> &nbsp;|&nbsp;
     3) el usuario tiene algun rol permitido &rarr; <code>return true</code> &nbsp;|&nbsp;
     4) ninguno coincide &rarr; <b>403</b>.
  </div>

  <?php reto('guard'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>auth.decorator.ts</code> — un decorador que junta todo</h2>

<pre><code>export const Auth = (...roles: AppRoles[]) =&gt; {
    return <?php hueco(22, 15); ?>(
        <?php hueco(26, 13); ?>(...roles),
        <?php hueco(23, 9); ?>(<?php hueco(24, 9); ?>(), <?php hueco(25, 13); ?>)
    )
}</code></pre>

  <?php reto('authdecorator'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. <code>user.decorator.ts</code> — un decorador de <b>parametro</b></h2>

<pre><code>export const UserDecorator = <?php hueco(27, 20); ?>(
    (<?php hueco(28, 5); ?>: string, <?php hueco(30, 4); ?>: ExecutionContext) =&gt; {
        const request = ctx.switchToHttp().getRequest();
        const user = request.<?php hueco(29, 5); ?>;

        return data ? user?.[data] : user;
    }
)</code></pre>

  <div class="nota">Uso en el controller: <code>async getUser(@UserDecorator() user: any)</code>. En vez de escribir
     <code>@Req() req</code> y luego <code>req.user</code> en cada handler, tienes un decorador propio que
     saca solo lo que necesitas.</div>

  <?php reto('userdecorator'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Las cuatro rutas protegidas: ¿que codigo devuelve cada una?</h2>

<pre><code>private1:  @UseGuards(AuthGuard())
private2:  @UseGuards(AuthGuard(), UserRoleGuard)  + @SetMetadata('roles', ['admin','editor'])
private3:  @UseGuards(AuthGuard(), UserRoleGuard)  + @RoleProtected(AppRoles.admin, AppRoles.editor)
private4:  @Auth(AppRoles.admin, AppRoles.user)</code></pre>

<pre><code>                          private1   private2   private3   private4
usuario roles ['user']    <?php hueco(31, 4); ?>       <?php hueco(32, 4); ?>       <?php hueco(33, 4); ?>       <?php hueco(34, 4); ?>
usuario roles ['editor']  <?php hueco(35, 4); ?>       <?php hueco(36, 4); ?>       <?php hueco(37, 4); ?>       <?php hueco(38, 4); ?>
usuario roles ['admin']   <?php hueco(39, 4); ?>       <?php hueco(40, 4); ?>       <?php hueco(41, 4); ?>       <?php hueco(42, 4); ?>
SIN token (cualquiera)    <?php hueco(43, 4); ?>       en las cuatro rutas</code></pre>

  <div class="nota">Recuerda: <code>private1</code> no exige rol (cualquiera <b>autenticado</b>). Los roles por defecto de un usuario
     nuevo son <code>['user']</code>. Y <code>private2</code>, <code>private3</code> y <code>private4</code> devuelven el mismo texto
     ("Ruta protegida 2") aunque el nombre del metodo cambie: copia y pega del profe.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. Recorrido de un 403</h2>
  <p><code>GET /auth/private4</code> con el token de un usuario con roles <code>['editor']</code>:</p>

<pre class="flujo"><code>GET /auth/private4   Authorization: Bearer &lt;token de un usuario con rol editor&gt;
  ↓
1er guard:  <?php hueco(44, 9); ?>()   →  token OK  →  JwtStrategy.validate  →  request.user = {..., roles: ['editor']}
  ↓
2º guard:  <?php hueco(45, 13); ?>
  ↓
this.<?php hueco(46, 9); ?>.get('roles', handler)   →   ['admin', 'user']
  ↓
user.roles = ['editor']   →   ninguno esta en ['admin','user']
  ↓
throw new <?php hueco(47, 18); ?>("user doesn't have required role")
  ↓
HTTP <?php hueco(48, 4); ?>   (el handler private4 nunca se ejecuta)</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. De memoria: la linea completa</h2>

  <?php linea(60, 'La constante con la clave de la metadata (con <code>export</code>):'); ?>
  <?php linea(61, 'Abrir <code>RoleProtected</code> como funcion flecha con parametros rest de tipo <code>string[]</code> (con la llave):'); ?>
  <?php linea(62, 'Cuerpo de <code>RoleProtected</code>: adjuntar los roles bajo la clave <code>META_ROLES</code> (con los parentesis extra del profe, sin <code>;</code> final o con el):'); ?>
  <?php linea(63, 'En el guard: leer los roles permitidos del <b>metodo</b> con el Reflector (con tipos y <code>const validRoles</code>):'); ?>
  <?php linea(64, 'En el guard: sacar el usuario de la request:'); ?>
  <?php linea(65, 'En el bucle del guard: ¿esta este rol entre los permitidos? (solo el <code>if</code>):'); ?>
  <?php linea(66, 'Decorador de metodo: primero autenticar, luego autorizar:'); ?>
  <?php linea(67, 'Decorador compuesto: solo admin o user:'); ?>
  <?php linea(68, 'Ultima linea del <code>UserDecorator</code>: devolver un campo si se pidio o el usuario entero:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); mc('m9'); mc('m10'); mc('m11'); mc('m12'); mc('m13'); mc('m14'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('septimo.php', 'noveno.php');
