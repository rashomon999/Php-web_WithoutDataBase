<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cuestionarios — Express / Node.js</title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<style>
body{background:#f4f5f7;font-family:-apple-system,Segoe UI,Arial,sans-serif;margin:0;padding:30px 18px 60px;color:#22262b}
.wrap{max-width:960px;margin:0 auto}
h1{font-size:28px;margin:0 0 4px}
.sub{color:#5a636e;margin:0 0 26px;font-size:15px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px}
.tarjeta{background:#fff;border:1px solid #d8dbe0;border-radius:12px;padding:18px 20px;
         text-decoration:none;color:inherit;display:block;transition:.15s}
.tarjeta:hover{border-color:#2c5aa0;box-shadow:0 4px 14px rgba(44,90,160,.14);
               text-decoration:none;color:inherit;transform:translateY(-2px)}
.tarjeta .n{font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#2c5aa0;font-weight:700}
.tarjeta h2{font-size:18px;margin:4px 0 8px}
.tarjeta p{font-size:14px;color:#5a636e;margin:0 0 10px;line-height:1.55}
.tarjeta .tags{font-size:12px;color:#7a838f;font-family:Consolas,Menlo,monospace}
.volver{display:inline-block;margin-top:28px;color:#2c5aa0;text-decoration:none}
.caja{background:#fff8e1;border-left:4px solid #f0b429;padding:12px 16px;
      border-radius:0 8px 8px 0;font-size:14.5px;margin:0 0 26px}
</style>
</head>
<body>
<div class="wrap">

  <h1>&#128220; Cuestionarios — Express + Node.js</h1>
  <p class="sub">Basados en el proyecto <code>icesi-2026a-nodejs</code> y en la documentacion de
     <a href="../Express/index.php">compunet/Express</a>.</p>

  <div class="caja">
    <b>Como funciona:</b> escribe la respuesta en los huecos amarillos y marca las opciones.
    El boton <b>Verificar todo</b> pinta de verde lo correcto y de rojo lo incorrecto, y arriba
    llevas el marcador. <b>Mostrar solucion</b> rellena todo; <b>Limpiar</b> empieza de cero.
    En los huecos no importan mayusculas ni espacios de sobra.
    <br><br>
    Cada cuestionario termina con un bloque <b>"De memoria: la linea completa"</b>, donde hay que
    escribir la linea entera de codigo sin mirar; ahi tampoco importan el tipo de comillas ni el
    punto y coma final, y si fallas te enseña debajo la linea correcta.
    <br><br>
    Los huecos <b>azules y punteados</b> dentro del codigo son <b>firmas de metodo</b>: hay que
    escribirlas enteras, con la visibilidad, el <code>async</code>, los parametros con sus tipos y
    el tipo de retorno. El <code>try</code>, el <code>catch</code> y el <code>instanceof</code>
    tambien van tapados, para que reproduzcas la estructura y no solo las palabras sueltas.
  </div>

  <div class="caja" style="background:#fff6e5;border-left-color:#f0b429">
    <b>&#127919; Retos.</b> Cuando dejas <b>todos</b> los huecos de un bloque en verde se desbloquea
    su reto: escribir ese archivo o ese metodo <b>entero</b>, en un cuadro de texto, sin rellenar
    nada. Se compara linea a linea ignorando lineas en blanco, espacios, comillas y el punto y coma
    final, y si fallas te dice cuantas lineas llevas bien y en cual esta la primera diferencia.
    Hay un boton para <b>ocultar el codigo de arriba</b> mientras lo escribes. El marcador de retos
    va aparte, arriba a la derecha.
  </div>

  <div class="grid">

    <a class="tarjeta" href="index.php">
      <div class="n">Cuestionario 1</div>
      <h2>Arranque y <code>index.ts</code></h2>
      <p>Que es Express, npm vs Yarn, y el punto de entrada linea por linea hasta que el servidor queda activo.</p>
      <div class="tags">express() · loadEnvFile · app.use · db.then · listen</div>
    </a>

    <a class="tarjeta" href="segundo.php">
      <div class="n">Cuestionario 2</div>
      <h2>Router, rutas y recorridos</h2>
      <p>El <code>user.route.ts</code> completo, el prefijo <code>/user</code>, el orden de las rutas y los recorridos de cada GET.</p>
      <div class="tags">express.Router() · /:id · /profile · req · res</div>
    </a>

    <a class="tarjeta" href="tercero.php">
      <div class="n">Cuestionario 3</div>
      <h2>Flujo <code>POST /user</code></h2>
      <p>Zod, el middleware de validacion, el controller, el service, bcrypt y el modelo. Crear un usuario de punta a punta.</p>
      <div class="tags">validateSchema · 400 · 201 · bcrypt.hash</div>
    </a>

    <a class="tarjeta" href="cuarto.php">
      <div class="n">Cuestionario 4</div>
      <h2>Flujo <code>POST /user/login</code></h2>
      <p>Buscar por email con el password, comparar el hash y firmar el JWT que despues abre las rutas protegidas.</p>
      <div class="tags">select:false · bcrypt.compare · jwt.sign · 1m</div>
    </a>

    <a class="tarjeta" href="quinto.php">
      <div class="n">Cuestionario 5</div>
      <h2><code>GET /user/profile</code> y <code>auth</code></h2>
      <p>El middleware de autenticacion entero: header Authorization, Bearer, jwt.verify, TokenExpiredError y <code>next()</code>.</p>
      <div class="tags">401 · Token expired · req.params.id · 404</div>
    </a>

    <a class="tarjeta" href="sexto.php">
      <div class="n">Cuestionario 6</div>
      <h2>Capas, modelo y que es Express</h2>
      <p>El modelo de Mongoose, las interfaces, que librerias son Express y cuales no, los codigos HTTP y el Dockerfile.</p>
      <div class="tags">Schema · model · ODM · 201/400/401/404/422/500</div>
    </a>

  </div>

  <a class="volver" href="../Menu.php">&#8592; Volver a CompuNet</a>

</div>
</body>
</html>
