<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Parcial de Express — Recipes &amp; Ingredients</title>
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
      border-radius:0 8px 8px 0;font-size:14.5px;margin:0 0 18px}
.caja.azul{background:#eef4ff;border-left-color:#2c5aa0}
table{width:100%;border-collapse:collapse;font-size:14px;margin:10px 0 0}
th,td{text-align:left;padding:6px 10px;border-bottom:1px solid #e3e6ea}
th{color:#5a636e;font-weight:600}
code{background:#eef0f3;padding:1px 5px;border-radius:4px;font-family:Consolas,Menlo,monospace;font-size:.92em;color:#b02a5b}
</style>
</head>
<body>
<div class="wrap">

  <h1>&#127859; Parcial de Express — Recipes &amp; Ingredients</h1>
  <p class="sub">Pre Parcial de Computación en Internet III · 2 horas · sobre el enunciado
     <i>Express Exam guide.pdf</i></p>

  <div class="caja azul">
    <b>De que va.</b> Un backend desde cero para gestionar <b>recetas</b> y los
    <b>ingredientes</b> de cada receta. CRUD de las dos entidades (40% + 40%) y una
    restriccion por <b>API_KEY</b> en un custom header (20%). El repositorio del examen
    llega practicamente vacio: solo el <code>package.json</code>, el
    <code>docker-compose.yml</code> con MongoDB y la coleccion de Postman.
    <table>
      <tr><th>Recipe (40%)</th><td>Create, FindAll, FindById, DeleteById, UpdateById</td></tr>
      <tr><th>Ingredient (40%)</th><td>Create, FindById, FindByProcessId, DeleteById, UpdateById</td></tr>
      <tr><th>API_KEY (20%)</th><td>minimo 20 caracteres, como custom header</td></tr>
    </table>
  </div>

  <div class="caja">
    <b>Como funciona.</b> Escribe en los huecos amarillos y marca las opciones; el boton
    <b>Verificar todo</b> pinta de verde y de rojo, y arriba llevas el marcador. Los huecos
    azules punteados son <b>firmas de metodo</b>: van enteras. Al final de varios bloques hay
    un <b>&#127919; reto</b> que se desbloquea cuando dejas el bloque en verde: escribir el
    archivo completo de memoria. No importan mayusculas, espacios, comillas ni el punto y coma.
  </div>

  <div class="grid">

    <a class="tarjeta" href="index.php">
      <div class="n">Parcial 1</div>
      <h2>De un enunciado al codigo</h2>
      <p>El metodo que sirve para cualquier parcial: que archivos necesita una entidad, que verbo y codigo HTTP toca en cada operacion, y los comandos del arranque.</p>
      <div class="tags">CRUD → rutas · 201/404 · tsc --noEmit</div>
    </a>

    <a class="tarjeta" href="segundo.php">
      <div class="n">Parcial 2</div>
      <h2>Interfaces y modelos</h2>
      <p>Recipe con su enum y su <code>createdAt</code>, Ingredient con la referencia a Recipe. Y que cambia respecto al modelo de User del curso.</p>
      <div class="tags">enum · ref · default: Date.now · Omit</div>
    </a>

    <a class="tarjeta" href="tercero.php">
      <div class="n">Parcial 3</div>
      <h2>API_KEY, arranque y middlewares</h2>
      <p>El 20% de la nota linea a linea, el <code>index.ts</code> entero, y los dos middlewares genericos.</p>
      <div class="tags">x-api-key · 401 · isValidObjectId · CastError</div>
    </a>

    <a class="tarjeta" href="cuarto.php">
      <div class="n">Parcial 4</div>
      <h2>Recipe completo</h2>
      <p>Schema de Zod, las cinco rutas, el service con <code>{new: true}</code> y el borrado en cascada, y el controller con sus codigos.</p>
      <div class="tags">partial() · findByIdAndUpdate · 201/400/404</div>
    </a>

    <a class="tarjeta" href="quinto.php">
      <div class="n">Parcial 5</div>
      <h2>Ingredient completo</h2>
      <p>La entidad dependiente: comprobar que la receta existe, <code>FindByProcessId</code>, y por que aqui el orden de las rutas no importa.</p>
      <div class="tags">ReferenceError · find({recipeId}) · omit</div>
    </a>

  </div>

  <div class="caja" style="margin-top:26px">
    <b>La solucion completa</b> esta en <code>Desktop\compu3\parcial-express-SOLUCION</code>,
    lista para correr con <code>docker compose up -d</code> y <code>npm run dev</code>, con su
    README y sus pruebas.
  </div>

  <a class="volver" href="../Menu.php">&#8592; Volver a CompuNet</a>

</div>
</body>
</html>
