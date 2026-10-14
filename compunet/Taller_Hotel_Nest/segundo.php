<?php

// =========================================================
// TALLER HOTEL NESTJS — PARTE 2: npm run test:e2e, DTOs y rutas
// =========================================================
$correctas = [
    // timestamp en sqlite
    1  => 'sqlite',
    2  => '@CreateDateColumn()',
    3  => '5000',

    // supertest
    4  => "import request from 'supertest';",

    // ValidationPipe / DTOs
    5  => '@IsNumber()',
    6  => '@Min(0)',
    7  => '@Max(5)',
    8  => '@Min(0.01)',
    9  => '@IsEmail()',
    10 => '@MinLength(6)',
    11 => '@IsOptional()',
    12 => 'whitelist',
    13 => 'forbidNonWhitelisted',
    14 => '@IsDateString()',

    // orden de las rutas
    15 => 'NaN',
    16 => "@Get('search')",
    17 => "async searchHotels(@Query('location') location: string): Promise<Hotel[]> {",
    18 => "@Get('available')",
    19 => "async getHotel(@Param('id', ParseIntPipe) id: number): Promise<Hotel> {",

    // delete -> 404
    20 => 'if (!deleted) {',
    21 => 'throw new NotFoundException(`Hotel with id ${id} not found`);',
    22 => 'return { success: true };',

    // base de datos de tests
    23 => "database: process.env.NODE_ENV === 'test' ? ':memory:' : 'database.sqlite',",

    // tabla de códigos HTTP
    24 => '201',
    25 => '400',
    26 => '409',
    27 => '404',
    28 => '200',
    29 => '400',
];

function normalizar($str) {
    return preg_replace('/\s+/', '', $str);
}

for ($i = 1; $i <= 60; $i++) {
    ${"respuesta_" . $i} = '';
    ${"verificar_" . $i} = '';
}

$mostrar_solucion = '';
if ($_POST) {
    $mostrar_solucion = isset($_POST['mostrar_solucion']) ? trim($_POST['mostrar_solucion']) : '';
    $clave = strtolower(str_replace([' ', '_', '-', 'ó', 'Ó'], ['', '', '', 'o', 'o'], $mostrar_solucion));

    if ($clave === 'mostrarsolucion') {
        foreach ($correctas as $i => $valor) {
            ${"respuesta_" . $i} = $valor;
            ${"verificar_" . $i} = "correcto";
        }
    } else {
        foreach ($correctas as $i => $valor) {
            $enviado = isset($_POST["respuesta_$i"]) ? $_POST["respuesta_$i"] : '';
            ${"respuesta_" . $i} = $enviado;
            $e = normalizar($enviado);
            if ($e === normalizar($valor))      ${"verificar_" . $i} = "correcto";
            elseif ($e === '')                   ${"verificar_" . $i} = '';
            else                                 ${"verificar_" . $i} = "incorrecto";
        }
    }
}

function campo($i, $size) {
    $val = $GLOBALS["respuesta_$i"];
    $ver = $GLOBALS["verificar_$i"];
    $cls = $ver === 'correcto' ? 'ok' : ($ver === 'incorrecto' ? 'mal' : '');
    return '<input type="text" class="' . $cls . '" name="respuesta_' . $i . '" value="'
         . htmlspecialchars($val, ENT_QUOTES) . '" size="' . $size . '" spellcheck="false">';
}

function verificar(...$ids) {
    $out = '';
    foreach ($ids as $i) {
        $v = $GLOBALS["verificar_$i"];
        if ($v === '') continue;
        $out .= '<span class="v ' . ($v === 'correcto' ? 'ok' : 'mal') . '">' . $i . ': ' . $v . '</span> ';
    }
    return '<span class="resultado" id="res_' . implode('_', $ids) . '">' . $out . '</span>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller Hotel NestJS — Parte 2: test:e2e</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style_2_0.css">

<style>
    .seccion {
        width: calc(50% - 7.5px);
        padding: 20px;
        box-sizing: border-box;
        height: auto;
    }
    .seccion img { max-width: 100%; height: auto; border-radius: 6px; }
    .seccion pre { background: #f6f8fa; border: 1px solid #e1e4e8; border-radius: 6px; padding: 10px 12px; font-size: 13.5px; }
    .seccion input[type=text] { font-family: Consolas, Menlo, monospace; font-size: 13.5px; max-width: 100%; }
    input.ok  { border: 2px solid #1a7f37; background: #eaf6ee; }
    input.mal { border: 2px solid #cf222e; background: #fdecec; }
    .v { font-size: 13px; font-weight: bold; margin-right: 6px; }
    .v.ok { color: #1a7f37; } .v.mal { color: #cf222e; }
    .titulo { background: #1f2733; color: #fff; padding: 14px 20px; border-radius: 8px; margin: 10px 0 0; }
    .titulo h1 { font-size: 22px; margin: 0; } .titulo p { margin: 4px 0 0; color: #cfe3ff; font-size: 14px; }
    .bug { display: inline-block; background: #cf222e; color: #fff; font-size: 12px; font-weight: bold; padding: 2px 8px; border-radius: 10px; margin-right: 6px; }
    .met { display: inline-block; background: #2f5d8a; color: #fff; font-size: 12px; font-weight: bold; padding: 2px 8px; border-radius: 10px; margin-right: 6px; }
    table.codigos { border-collapse: collapse; font-size: 14px; }
    table.codigos td, table.codigos th { border: 1px solid #d0d7de; padding: 5px 9px; }
    table.codigos th { background: #f6f8fa; }
    .solucion { background: #fff8e1; border-left: 4px solid #f0b429; padding: 10px 16px; border-radius: 0 8px 8px 0; margin: 12px 0 0; }
    .solucion input { margin: 0 8px; }
    @media (max-width: 900px) { .seccion { width: 100%; } }
</style>

<script>
// Envío SIN recargar: se manda el formulario por fetch y solo se actualizan
// los valores de las casillas, sus colores y los resultados. La página no se mueve.
// Si algo falla, se hace un envío normal como respaldo.
function enviar(event) {
    event.preventDefault();
    var form = event.target;
    var sy = document.getElementById('scroll_y');
    if (sy) sy.value = String(Math.round(window.scrollY));
    fetch(form.getAttribute('action'), { method: 'POST', body: new FormData(form), credentials: 'same-origin' })
        .then(function (r) { if (!r.ok) throw new Error('HTTP ' + r.status); return r.text(); })
        .then(function (html) {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            if (!doc.querySelector('form')) throw new Error('respuesta sin formulario');
            doc.querySelectorAll('input[name]').forEach(function (nuevo) {
                if (nuevo.type === 'hidden') return;
                var actual = form.querySelector('input[name="' + nuevo.name + '"]');
                if (!actual) return;
                actual.value = nuevo.getAttribute('value') || '';
                actual.className = nuevo.className;
            });
            doc.querySelectorAll('.resultado').forEach(function (nuevo) {
                var actual = document.getElementById(nuevo.id);
                if (actual) actual.innerHTML = nuevo.innerHTML;
            });
        })
        .catch(function (err) {
            console.error('Fallo el envio por fetch, se envia normal:', err);
            form.submit();
        });
    return false;
}
</script>
</head>
<body>

<div class="titulo">
    <h1>&#127976; Taller Hotel NestJS — Parte 2: <code style="color:#f5f543">npm run test:e2e</code></h1>
    <p>Los errores que solo aparecen cuando la app arranca de verdad: base de datos, validación, rutas y códigos HTTP.</p>
</div>

<form action="./segundo.php" method="POST" onsubmit="return enviar(event)" autocomplete="off">
<div class="solucion">
    <strong>si desea ver las soluciones escribir: mostrar_solucion</strong>
    <input type="text" id="mostrar_solucion" name="mostrar_solucion" value="<?php echo htmlspecialchars($mostrar_solucion, ENT_QUOTES); ?>">
    <button type="submit">Mostrar Solución</button>
</div>
<div class="form-container">


<!-- ======================= IZQUIERDA ======================= -->
<div class="seccion izquierda">

<strong>Hay que saber:</strong>
<p>1. Un test <b>unitario</b> reemplaza el repositorio por un <code>jest.fn()</code>: nunca toca la base de datos ni levanta la app.</p>
<p>2. Un test <b>e2e</b> monta el <code>AppModule</code> completo, conecta TypeORM y hace peticiones HTTP reales con <code>supertest</code>. Por eso aparecen errores nuevos aunque <code>npm test</code> ya esté en verde.</p>

<hr>
<p><span class="bug">ERROR</span><strong>La app ni siquiera arranca</strong></p>
<img src="../../img/guia_508.png" alt="" width="900">
<br><br>
<p>El proyecto usa la base de datos <?php echo campo(1, 8); ?> y <code>timestamp</code> es un tipo de Postgres/MySQL. TypeORM no puede conectarse, reintenta... y el <code>beforeAll</code> se queda esperando.</p>
<p>Por eso Jest dice "timeout" y no el error real: un hook espera por defecto este número de ms: <?php echo campo(3, 6); ?></p>
<p>En las 4 entidades (Hotel, Room, User, Booking) cambia:</p>
<pre>
@Column({ type: 'timestamp', default: () =&gt; 'CURRENT_TIMESTAMP' })
createdAt: Date;
</pre>
<p>por el decorador portable (funciona en sqlite y en postgres):</p>
<pre>
<?php echo campo(2, 24); ?>

createdAt: Date;
</pre>
<p><small>Este error también rompía <code>npm run start:dev</code>.</small></p>
<button type="submit">Enviar</button>
<?php echo verificar(1, 2, 3); ?>

<hr>
<p><span class="bug">ERROR</span><strong>request is not a function</strong></p>
<img src="../../img/guia_509.png" alt="" width="900">
<br><br>
<p>Con <code>esModuleInterop</code> activo, <code>import * as request</code> trae el <b>objeto del módulo</b>, no la función. En los 5 archivos <code>test/*.e2e-spec.ts</code>:</p>
<?php echo campo(4, 45); ?>
<br><br>
<button type="submit">Enviar</button>
<?php echo verificar(4); ?>

<hr>
<p><span class="bug">ERROR</span><strong>Esperaba 400 y llegó 201</strong></p>
<img src="../../img/guia_510.png" alt="" width="900">
<br><br>
<p>El hotel con <code>rating: 6.5</code> se guardó feliz. Faltan dos cosas: el <code>ValidationPipe</code> activo (Parte 1, bug 5) <b>y</b> los decoradores en el DTO.</p>
<pre>
// create-hotel.dto.ts
<?php echo campo(5, 14); ?>

<?php echo campo(6, 10); ?>

<?php echo campo(7, 10); ?>

rating: number;

// create-room.dto.ts — el precio no puede ser negativo ni 0
@IsNumber()
<?php echo campo(8, 12); ?>

pricePerNight: number;

// create-user.dto.ts
<?php echo campo(9, 14); ?>

email: string;

@IsNotEmpty()
@IsString()
<?php echo campo(10, 16); ?>

password: string;

// create-booking.dto.ts — en JSON las fechas llegan como texto ISO
<?php echo campo(14, 18); ?>

checkInDate: Date;
</pre>
<p>Con <code>whitelist</code> también los campos opcionales necesitan decorador, si no se borran (o se rechazan):</p>
<pre>
<?php echo campo(11, 16); ?>

@IsString()
description?: string;
</pre>
<p>Opción que <b>quita</b> las propiedades sin decorador: <?php echo campo(12, 22); ?></p>
<p>Opción que además <b>responde 400</b> si llegan: <?php echo campo(13, 22); ?></p>
<button type="submit">Enviar</button>
<?php echo verificar(5, 6, 7, 8, 9, 10, 14, 11, 12, 13); ?>
<hr>
</div>



<!-- ======================= DERECHA ======================= -->
<div class="seccion derecha">

<p><span class="bug">ERROR</span><strong>GET /hotels/search responde 500</strong></p>
<img src="../../img/guia_511.png" alt="" width="900">
<br><br>
<img src="../../img/guia_517.png" alt="" width="760">
<br><br>
<p>No existe una ruta <code>search</code>, así que <code>/hotels/search</code> cae en <code>@Get(':id')</code> con <code>id = "search"</code>. <code>parseInt("search")</code> da <?php echo campo(15, 6); ?> y SQLite revienta: <code>no such column: NaN</code>.</p>
<p><b>Regla:</b> las rutas fijas van <b>antes</b> que <code>:id</code>. Nest las revisa en el orden en que están escritas.</p>
<pre>
@Get()
async getAllHotels(): Promise&lt;Hotel[]&gt; { ... }

<?php echo campo(16, 18); ?>

<?php echo campo(17, 78); ?>

  return this.hotelService.searchByLocation(location);
}

<?php echo campo(18, 18); ?>

async getAvailableHotels(): Promise&lt;Hotel[]&gt; { ... }

@Get(':id')
<?php echo campo(19, 72); ?>

  return this.hotelService.findOne(id);
}
</pre>
<p><code>ParseIntPipe</code> convierte el texto a número, y si no es un número responde <b>400</b> en vez de llegar a la base de datos con <code>NaN</code>.</p>
<button type="submit">Enviar</button>
<?php echo verificar(15, 16, 17, 18, 19); ?>

<hr>
<p><span class="met">ENDPOINT</span><strong>DELETE /hotels/:id — 200 o 404</strong></p>
<p>El test acepta <code>[200, 404]</code>. El service devuelve <code>true/false</code>; el <b>controller</b> traduce eso a HTTP:</p>
<pre>
@Delete(':id')
async deleteHotel(@Param('id', ParseIntPipe) id: number): Promise&lt;{ success: boolean }&gt; {
  const deleted = await this.hotelService.delete(id);
  <?php echo campo(20, 18); ?>

    <?php echo campo(21, 62); ?>

  }
  <?php echo campo(22, 28); ?>

}
</pre>
<p><small>Igual para <code>DELETE /hotels/:hotelId/rooms/:id</code>. <code>DELETE /bookings/:id</code> en cambio devuelve la reserva con <code>status: 'cancelled'</code> (el test lo revisa).</small></p>
<button type="submit">Enviar</button>
<?php echo verificar(20, 21, 22); ?>

<hr>
<p><span class="bug">ERROR</span><strong>Pasa la primera vez y falla la segunda</strong></p>
<p>Los tests escriben en <code>database.sqlite</code>. En la segunda corrida <code>newuser@example.com</code> ya existe → 409 donde se esperaba 201. Jest pone <code>NODE_ENV=test</code>, así que en tests usamos una base en memoria que empieza vacía:</p>
<pre>
TypeOrmModule.forRoot({
  type: 'sqlite',
  <?php echo campo(23, 75); ?>

  ...
</pre>
<button type="submit">Enviar</button>
<?php echo verificar(23); ?>

<hr>
<p><strong>¿Qué responde la API?</strong> (ya corregida)</p>
<table class="codigos">
<tr><th>Petición</th><th>Código</th></tr>
<tr><td><code>POST /hotels</code> con datos válidos</td><td><?php echo campo(24, 4); ?></td></tr>
<tr><td><code>POST /hotels</code> con <code>rating: 6.5</code></td><td><?php echo campo(25, 4); ?></td></tr>
<tr><td><code>POST /users/register</code> con un email ya usado</td><td><?php echo campo(26, 4); ?></td></tr>
<tr><td><code>DELETE /hotels/999</code></td><td><?php echo campo(27, 4); ?></td></tr>
<tr><td><code>DELETE /bookings/1</code> (cancelar)</td><td><?php echo campo(28, 4); ?></td></tr>
<tr><td><code>POST /bookings</code> con salida antes de la entrada</td><td><?php echo campo(29, 4); ?></td></tr>
</table>
<br>
<button type="submit">Enviar</button>
<?php echo verificar(24, 25, 26, 27, 28, 29); ?>

</div>

</div>
</form>

<div class="centered-container">
    <a class="btn btn-secondary" href="index.php" role="button">Anterior</a>
    <a class="btn btn-primary" href="../Menu.php" role="button">Volver al menú</a>
</div>
</body>
</html>
