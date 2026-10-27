<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cuestionarios — Arquitectura limpia con Next.js</title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<style>
body{background:#f4f5f7;font-family:-apple-system,Segoe UI,Arial,sans-serif;margin:0;padding:30px 18px 60px;color:#22262b}
.wrap{max-width:960px;margin:0 auto}
h1{font-size:28px;margin:0 0 4px}
.sub{color:#5a636e;margin:0 0 26px;font-size:15px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px}
.tarjeta{background:#fff;border:1px solid #d8dbe0;border-radius:12px;padding:18px 20px;
         text-decoration:none;color:inherit;display:block;transition:.15s}
.tarjeta:hover{border-color:#1d6fa5;box-shadow:0 4px 14px rgba(29,111,165,.14);
               text-decoration:none;color:inherit;transform:translateY(-2px)}
.tarjeta .n{font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#1d6fa5;font-weight:700}
.tarjeta h2{font-size:18px;margin:4px 0 8px}
.tarjeta p{font-size:14px;color:#5a636e;margin:0 0 10px;line-height:1.55}
.tarjeta .tags{font-size:12px;color:#7a838f;font-family:Consolas,Menlo,monospace}
h2.seccion{font-size:21px;margin:38px 0 6px;padding-top:22px;border-top:1px solid #d8dbe0}
p.seccionsub{color:#5a636e;margin:0 0 18px;font-size:15px}
.volver{display:inline-block;margin-top:28px;color:#2c5aa0;text-decoration:none}
.caja{background:#fff8e1;border-left:4px solid #f0b429;padding:12px 16px;
      border-radius:0 8px 8px 0;font-size:14.5px;margin:0 0 26px}
.mapa{background:#1f2733;color:#cfe3ff;border-radius:10px;padding:16px 20px;margin:0 0 26px;
      font-family:Consolas,Menlo,monospace;font-size:13.5px;line-height:1.85;overflow-x:auto;white-space:pre}
</style>
</head>
<body>
<div class="wrap">

  <h1>&#129521; Cuestionarios — Arquitectura limpia con Next.js</h1>
  <p class="sub">Basados en el proyecto <b>RodaYa</b> (<code>icesi-2026b-nextjs</code>), rama <code>clase3-next</code>:
     alquiler de vehiculos, del componente legado a las capas.</p>

  <div class="caja">
    <b>Como funciona:</b> igual que los de NestJS. Escribe la respuesta en los huecos amarillos y marca las opciones.
    <b>Verificar todo</b> pinta de verde lo correcto y de rojo lo incorrecto; <b>Mostrar solucion</b> rellena todo;
    <b>Limpiar</b> empieza de cero. Los <b>retos</b> piden escribir un archivo entero de memoria y se desbloquean
    al acertar los huecos de su bloque.
    <br><br>
    <b>Orden recomendado:</b> del 0 al 6, en orden. El 6 es el mas corto: un repaso visual del circulo completo, ideal justo antes de un parcial. El 0 explica Next y React desde cero (que es <code>useEffect</code>, como se creo el proyecto, que modulos trae). El 1 explica <i>por que</i> se hace todo esto; si lo saltas,
    el resto parece burocracia. El 3 es el mas denso y el que mas cae en un parcial.
  </div>

  <div class="mapa">Peticion del cliente: "ver mis alquileres"
   &darr;  <span style="color:#7ee2a8">[presentation]</span>   MyRentals.tsx &middot; useMyRentals()  &rarr; solo pinta y formatea      (cuestionario 2)
   &darr;  <span style="color:#7ee2a8">[di]</span>             arma las piezas: caso de uso + repositorio real        (cuestionario 5)
   &darr;  <span style="color:#7ee2a8">[application]</span>    makeListMyRentals &middot; RentalRepository (el puerto)      (cuestionario 5)
   &darr;  <span style="color:#ffb86c">[infraestucture]</span> HttpRentalRepository &middot; mapper &middot; token &middot; API_URL      (pendiente)
   &darr;  <span style="color:#7ee2a8">[domain]</span>         calculatePrice &middot; canCancel &middot; Money &middot; DateRange       (cuestionarios 3 y 4)

las dependencias apuntan siempre <span style="color:#7ee2a8">hacia adentro</span>: el dominio no importa nada de fuera
y por eso se prueba en milisegundos, sin navegador y sin API                          (cuestionario 4)</div>

  <h2 class="seccion" style="border-top:0;padding-top:0;margin-top:10px">&#128218; Del componente legado a las capas</h2>
  <p class="seccionsub">Del 0 al 6, en orden. El 0 es la base de Next y React; el 1 es el "por que" de la arquitectura; el 3 y el 4 son los de codigo puro; el 6 es el repaso visual.</p>

  <div class="grid">

    <a class="tarjeta" href="cero.php">
      <div class="n">Cuestionario 0</div>
      <h2>Como se creo el proyecto y que hay dentro</h2>
      <p>La base antes de las capas: <code>create-next-app</code>, <code>package.json</code>, que es un modulo, el App Router, y que significan <code>'use client'</code>, <code>useState</code> y <code>useEffect</code>.</p>
      <div class="tags">npx &middot; dependencies &middot; node_modules &middot; page.tsx &middot; hooks</div>
    </a>

    <a class="tarjeta" href="index.php">
      <div class="n">Cuestionario 1</div>
      <h2>El codigo legado y las cuatro preguntas</h2>
      <p>Las preguntas del taller de la clase 1 sobre <code>MyRentals.tsx</code>: cuantas responsabilidades tiene, el bug de cancelar, y por que dos componentes calculan precios distintos.</p>
      <div class="tags">responsabilidades &middot; any &middot; res.ok &middot; ceil vs round &middot; &gt;= 7</div>
    </a>

    <a class="tarjeta" href="segundo.php">
      <div class="n">Cuestionario 2</div>
      <h2>Estructura de carpetas y capas</h2>
      <p>Que va en <code>domain</code>, <code>application</code>, <code>infraestucture</code>, <code>presentation</code> y <code>di</code>; la regla de dependencias, puertos y adaptadores, y por que se organiza por features.</p>
      <div class="tags">features &middot; shared &middot; puerto &middot; adaptador &middot; .gitkeep</div>
    </a>

    <a class="tarjeta" href="tercero.php">
      <div class="n">Cuestionario 3</div>
      <h2>El dominio: los TODO resueltos</h2>
      <p><code>Money</code>, <code>DateRange</code>, <code>DomainError</code>, las politicas de descuento y cancelacion, <code>calculatePrice</code> y <code>canCancel</code>, linea por linea.</p>
      <div class="tags">value object &middot; copia defensiva &middot; Math.ceil &middot; politicas</div>
    </a>

    <a class="tarjeta" href="cuarto.php">
      <div class="n">Cuestionario 4</div>
      <h2>Probar el dominio con Vitest</h2>
      <p>La clase 2: instalar y configurar vitest, <code>describe/it/expect</code>, <code>toThrow</code>, <code>it.each</code>, y por que los tests se ponen justo en los bordes.</p>
      <div class="tags">vitest.config.mts &middot; alias @ &middot; toThrow &middot; 7 vs 6 dias</div>
    </a>

    <a class="tarjeta" href="quinto.php">
      <div class="n">Cuestionario 5</div>
      <h2>Aplicacion: puertos y casos de uso</h2>
      <p>Lo nuevo de <code>clase3-next</code>: <code>RentalRepository</code>, <code>makeListMyRentals</code>, inyeccion de dependencias sin libreria y lo que falta por construir.</p>
      <div class="tags">interface &middot; factory &middot; Deps &middot; fake repository</div>
    </a>

    <a class="tarjeta" href="sexto.php">
      <div class="n">Cuestionario 6</div>
      <h2>El circulo completo</h2>
      <p>El diagrama de Clean Architecture dibujado con circulos de verdad: Entities, Use Cases, Interface Adapters, Frameworks &amp; Drivers, la leyenda, los puertos y la tabla de equivalencias.</p>
      <div class="tags">Devices &middot; Gateways &middot; Controllers &middot; leyenda &middot; mapeo</div>
    </a>

  </div>

  <a class="volver" href="../Menu.php">&larr; Volver al menu de CompuNet</a>

</div>
</body>
</html>
