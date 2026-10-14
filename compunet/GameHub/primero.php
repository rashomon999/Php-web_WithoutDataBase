<?php
require_once __DIR__ . '/../NestJS/motor.php';

/* ---------------------------------------------------------------
   GAMEHUB — CUESTIONARIO 1
   Quién llama a quién: el recorrido de una petición
   (código real de GameHub, parte de la Persona 1)
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A. El diagrama --- */
    1  => 'JwtAuthGuard',
    2  => ['canActivate', 'canActivate()'],
    3  => ['@Public()', '@Public', 'Public', 'Public()'],
    4  => ['Passport', 'AuthGuard', "AuthGuard('jwt')"],
    5  => 'JwtStrategy',
    6  => ['validate', 'validate()'],
    7  => ['req.user', 'request.user'],
    8  => 'RolesGuard',
    9  => 'ValidationPipe',
    10 => ['Controller', 'UsersController', 'AuthController'],
    11 => ['Service', 'UsersService', 'AuthService'],
    12 => ['Repository', 'Repositorio', 'repo'],
    13 => ['toPublic', 'toPublic()'],
    14 => '401',
    15 => '401',
    16 => '403',
    17 => '400',

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿En qué momento exacto <code>twoFactorEnabled</code> pasa a <code>true</code>?',
        'opciones' => [
            'a' => 'Al llamar a <code>POST /auth/2fa/setup</code>, cuando el servidor genera el secreto TOTP.',
            'b' => 'Al escanear el QR en la app autenticadora (Google Authenticator, Authy...).',
            'c' => 'Al llamar a <code>POST /auth/2fa/verify</code> con un código válido. La app autenticadora nunca habla con el servidor, así que ese código de 6 dígitos es la única prueba de que el secreto sí quedó configurado en el dispositivo.',
            'd' => 'En el primer login en el que se envía el campo <code>otp</code>.',
        ],
        'correcta' => 'c',
        'porque'   => '<code>setupTwoFactor</code> genera y guarda el secreto, pero <code>saveTwoFactorSecret</code> deja <code>twoFactorEnabled</code> en <code>false</code>. Solo <code>verifyTwoFactor</code> llama a <code>enableTwoFactor</code>. La separación en dos pasos evita quedar bloqueado: si falla la configuración del dispositivo, se repite el <code>setup</code> y se genera un secreto nuevo.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('GameHub 1 — Quién llama a quién', 'El recorrido de una petición: guards, Passport, JwtStrategy, pipes, controller, service');
?>

<style>
.diag{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1.25fr) minmax(0,1fr);gap:0 18px;
      align-items:center;margin:18px 0 6px}
.diag .c{grid-column:2;display:flex;justify-content:center}
.diag .l{grid-column:1;display:flex;justify-content:flex-end}
.diag .r{grid-column:3;display:flex;justify-content:flex-start}
.nodo{border:2px solid #9aa3ad;border-radius:10px;padding:10px 14px;text-align:center;
      background:#fff;width:100%;max-width:330px;line-height:1.5}
.nodo .s{display:block;font-size:13px;color:#5a636e}
.nodo.seg{border-color:#7b61c4;background:#f3f0fc}
.nodo.app{border-color:#1d9e75;background:#e8f7f1}
.nodo.err{border-color:#c0392b;background:#fdecea;max-width:230px}
.nodo.ini{border-radius:999px;background:#eef0f3}
.nodo.dec{border-style:dashed;border-color:#555;background:#fafafa}
.nodo.lado{max-width:230px;background:#eef0f3}
.nodo .donde{margin-top:4px;font-size:12px;color:#2c5aa0}
.flecha{grid-column:2;text-align:center;font-size:20px;color:#5a636e;line-height:1.4}
.flecha small{font-size:12px;margin-left:6px}
.hacia{font-size:13px;color:#5a636e;white-space:nowrap}
@media(max-width:760px){.diag{grid-template-columns:minmax(0,1fr)}
  .diag .c,.diag .l,.diag .r,.flecha{grid-column:1;justify-content:center}}
</style>

<div class="card">
  <h2>A. El diagrama: ¿qué clase va en cada caja?</h2>
  <p>Así recorre GameHub una petición. Morado = seguridad, verde = tu aplicación, rojo = el error que sale
     si esa capa falla. Escribe el nombre de la clase, método o código en cada hueco.</p>

  <div class="diag">

    <div class="c"><div class="nodo ini"><b>Llega la petición</b></div></div>
    <div class="flecha">↓</div>

    <div class="c"><div class="nodo seg"><b><?php hueco(1, 13); ?></b>
      <span class="s">método <?php hueco(2, 12); ?></span><span class="s donde">registrado global en <code>app.module.ts</code> con <code>APP_GUARD</code></span></div></div>
    <div class="flecha">↓</div>

    <div class="l"><div class="nodo lado"><b>Pasa directo</b><span class="s">no pide token y salta hasta RolesGuard</span></div></div>
    <div class="c"><div class="nodo dec"><span class="hacia">Sí ← </span><b>¿Tiene <?php hueco(3, 10); ?>?</b></div></div>
    <div class="flecha">↓<small>No</small></div>

    <div class="c"><div class="nodo seg"><b><?php hueco(4, 10); ?></b>
      <span class="s">ejecuta la receta de <code>passport-jwt</code>: saca el token del header y verifica firma y expiración</span><span class="s donde">es el <b>motor</b>; el <b>cómo</b> lo definió la Strategy en el <code>super({...})</code></span></div></div>
    <div class="r"><span class="hacia">→&nbsp;</span><div class="nodo err"><b><?php hueco(14, 4); ?></b><span class="s">token falta, malo o vencido</span></div></div>
    <div class="flecha">↓</div>

    <div class="c"><div class="nodo seg"><b><?php hueco(5, 12); ?></b>.<?php hueco(6, 9); ?>(payload)
      <span class="s">lo que retorna queda en <?php hueco(7, 12); ?></span><span class="s donde">en los <code>providers</code> de <code>auth.module.ts</code></span></div></div>
    <div class="r"><span class="hacia">→&nbsp;</span><div class="nodo err"><b><?php hueco(15, 4); ?></b><span class="s">sesión cerrada (tokenVersion)</span></div></div>
    <div class="flecha">↓</div>

    <div class="c"><div class="nodo seg"><b><?php hueco(8, 11); ?></b>
      <span class="s">¿la ruta tiene @Roles? compara con req.user.role</span><span class="s donde">registrado global en <code>app.module.ts</code> con <code>APP_GUARD</code></span></div></div>
    <div class="r"><span class="hacia">→&nbsp;</span><div class="nodo err"><b><?php hueco(16, 4); ?></b><span class="s">el rol no alcanza</span></div></div>
    <div class="flecha">↓</div>

    <div class="c"><div class="nodo app"><b><?php hueco(9, 14); ?></b>
      <span class="s">revisa el body contra el DTO</span><span class="s donde">registrado global en <code>main.ts</code> con <code>app.useGlobalPipes(...)</code></span></div></div>
    <div class="r"><span class="hacia">→&nbsp;</span><div class="nodo err"><b><?php hueco(17, 4); ?></b><span class="s">datos inválidos</span></div></div>
    <div class="flecha">↓</div>

    <div class="c"><div class="nodo app"><b><?php hueco(10, 13); ?></b>
      <span class="s">recibe @CurrentUser, @Body, @Param y llama al service</span></div></div>
    <div class="flecha">↓</div>

    <div class="c"><div class="nodo app"><b><?php hueco(11, 12); ?></b>
      <span class="s">lógica: bcrypt, JWT, TOTP, reglas; lanza 404 / 409</span></div></div>
    <div class="flecha">↓</div>

    <div class="c"><div class="nodo app"><b><?php hueco(12, 11); ?></b>
      <span class="s">TypeORM → Postgres (findOne, save, remove...)</span></div></div>
    <div class="flecha">↓</div>

    <div class="c"><div class="nodo ini"><b>Respuesta</b>, pasada por <?php hueco(13, 9); ?>
      <span class="s">sin password, twoFactorSecret ni tokenVersion</span></div></div>
  </div>

  <div class="nota"><b>Passport, Strategy y <code>@nestjs/passport</code> no son lo mismo.</b> <b>Passport</b> (el paquete <code>passport</code>) es el <i>motor</i>: el proceso genérico de &laquo;extraer credenciales, verificarlas y, si pasan, llenar <code>req.user</code>&raquo;. No sabe nada de JWT. La <b>Strategy</b> (<code>passport-jwt</code>) es la <i>receta</i>: define de dónde sale el token (<code>ExtractJwt.fromAuthHeaderAsBearerToken()</code>) y cómo se verifica (<code>secretOrKey</code>, <code>ignoreExpiration</code>). Si fuera usuario/contraseña sería <code>passport-local</code>, con el mismo motor. <b><code>@nestjs/passport</code></b> es el <i>adaptador</i>: <code>PassportStrategy(Strategy)</code> vuelve la receta un provider de Nest y <code>AuthGuard('jwt')</code> la vuelve un guard que Nest sabe ejecutar. Por eso la caja de arriba dice &laquo;Passport&raquo;, pero el <i>cómo</i> lo escribiste tú en el <code>super({...})</code> de <code>jwt.strategy.ts</code>. Regla corta: <b>Passport ejecuta el proceso; la Strategy es la receta que ejecuta.</b></div>

  <div class="avisoflujo">Las rutas <code>login</code>, <code>register</code> y <code>health</code> toman el camino <b>Sí</b>.
     Las de admin (<code>GET /users</code>, <code>DELETE /users/:id</code>...) son las únicas donde <code>RolesGuard</code>
     puede responder 403. Una petición sin body (<code>GET</code>, <code>logout</code>) pasa el <code>ValidationPipe</code> sin nada que revisar.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. 2FA: ¿cuándo queda activado?</h2>
  <p>El 2FA no viene activado para nadie: <code>twoFactorEnabled</code> arranca en <code>false</code>
     por el <code>default</code> de <code>user.entity.ts</code>. Se activa desde la propia API, en dos pasos.</p>

  <?php mc('m1'); ?>

  <div class="avisoflujo"><b>El flujo completo:</b>
     <code>POST /auth/2fa/setup</code> (genera el secreto y el QR; <code>twoFactorEnabled</code> sigue en <code>false</code>)
     &rarr; escanear el QR en la app autenticadora (el servidor no se entera)
     &rarr; <code>POST /auth/2fa/verify</code> con el código de 6 dígitos (<b>aquí</b> pasa a <code>true</code>).
     A partir de ahí, <code>AuthService.login</code> exige <code>otp</code>: sin él responde 401
     &laquo;Se requiere el código 2FA&raquo;, y con uno incorrecto 401 &laquo;Código 2FA inválido&raquo;.</div>

  <div class="nota">TOTP funciona <b>sin conexión</b>: el celular y el servidor calculan el mismo número
     a partir del secreto compartido y la hora actual (en bloques de 30 segundos). Por eso la app nunca
     llama a tu API, y por eso los relojes del PC y del celular tienen que estar sincronizados.
     Nunca pongas <code>twoFactorEnabled = true</code> a mano en la base de datos sin un
     <code>twoFactorSecret</code> válido: <code>authenticator.check(otp, null ?? '')</code> falla siempre
     y ese usuario queda bloqueado, porque la API no tiene endpoint para desactivar el 2FA.</div>

  <?php enviar('Verificar'); ?>
</div>


<?php
pie('Menu.php', '');
