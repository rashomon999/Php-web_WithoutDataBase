<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cuestionarios — GameHub</title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<style>
body{background:#f4f5f7;font-family:-apple-system,Segoe UI,Arial,sans-serif;margin:0;padding:30px 18px 60px;color:#22262b}
.wrap{max-width:960px;margin:0 auto}
h1{font-size:28px;margin:0 0 4px}
.sub{color:#5a636e;margin:0 0 26px;font-size:15px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px}
.tarjeta{background:#fff;border:1px solid #d8dbe0;border-radius:12px;padding:18px 20px;
         text-decoration:none;color:inherit;display:block;transition:.15s}
.tarjeta:hover{border-color:#7b61c4;box-shadow:0 4px 14px rgba(123,97,196,.16);
               text-decoration:none;color:inherit;transform:translateY(-2px)}
.tarjeta .n{font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#7b61c4;font-weight:700}
.tarjeta h2{font-size:18px;margin:4px 0 8px}
.tarjeta p{font-size:14px;color:#5a636e;margin:0 0 10px;line-height:1.55}
.tarjeta .tags{font-size:12px;color:#7a838f;font-family:Consolas,Menlo,monospace}
.tarjeta.pendiente{border-style:dashed;opacity:.6;pointer-events:none}
.volver{display:inline-block;margin-top:28px;color:#2c5aa0;text-decoration:none}
.caja{background:#fff8e1;border-left:4px solid #f0b429;padding:12px 16px;
      border-radius:0 8px 8px 0;font-size:14.5px;margin:0 0 26px}
</style>
</head>
<body>
<div class="wrap">

  <h1>&#127918; Cuestionarios — GameHub</h1>
  <p class="sub">Sobre el código real de mi proyecto (NestJS 11 + PostgreSQL + TypeORM), parte de la Persona 1:
     setup, auth con JWT y 2FA, guards, roles y el módulo Users.</p>

  <div class="caja">Mismo funcionamiento que los de NestJS: escribe en los huecos amarillos y marca las opciones.
     <b>Verificar</b> pinta de verde o rojo, <b>Mostrar solución</b> rellena todo y <b>Limpiar</b> empieza de cero.
     Los retos se desbloquean cuando todos los huecos de su bloque están en verde.</div>

  <div class="grid">

    <a class="tarjeta" href="primero.php">
      <div class="n">Cuestionario 1</div>
      <h2>Quién llama a quién</h2>
      <p>El recorrido de una petición: <code>JwtAuthGuard</code>, Passport, <code>JwtStrategy.validate</code>,
         <code>RolesGuard</code>, <code>ValidationPipe</code>, controller, service y repository. Más el arranque y <code>@CurrentUser</code>.</p>
      <div class="tags">APP_GUARD · super.canActivate · validate · req.user</div>
    </a>

    <div class="tarjeta pendiente">
      <div class="n">Cuestionario 2 · pendiente</div>
      <h2>Roles y 403</h2>
      <p><code>RolesGuard</code>, <code>@Roles</code>, <code>Reflector</code> y la prueba con Ana.</p>
      <div class="tags">@Roles · Reflector · 401 vs 403</div>
    </div>

    <div class="tarjeta pendiente">
      <div class="n">Cuestionario 3 · pendiente</div>
      <h2>Logout, 2FA y CRUD de users</h2>
      <p><code>tokenVersion</code>, TOTP con otplib, y el CRUD línea por línea.</p>
      <div class="tags">tokenVersion · otplib · toPublic · ParseUUIDPipe</div>
    </div>

  </div>

  <a class="volver" href="../Menu.php">&#8592; Volver a CompuNet</a>
</div>
</body>
</html>
