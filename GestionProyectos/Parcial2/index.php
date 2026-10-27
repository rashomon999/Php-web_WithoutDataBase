<?php
/* Gestion de Proyectos — Parcial 2: submenu de cuestionarios */

$CUESTIONARIOS = [
    [
        'n'    => '1',
        'ruta' => 'RutaCritica.php',
        'tit'  => 'Ruta critica',
        'desc' => 'ES, EF, LS y LF, recorrido hacia adelante y hacia atras, la regla de la convergencia (sumando se escoge el mayor, restando el menor), holgura positiva, cero y negativa, que es la ruta critica y las dos tecnicas de compresion. Luego el ejemplo de clase resuelto nodo a nodo y los dos ejercicios del taller.',
        'meta' => 'huecos + opcion multiple · 3 diagramas de red',
        'src'  => 'Conceptos de ruta critica.pdf, Ruta critica y Valor ganado.pdf, Taller de ruta critica.pdf'
    ],
    [
        'n'    => '2',
        'ruta' => 'ValorGanado.php',
        'tit'  => 'Valor ganado',
        'desc' => 'PV, AC, EV y BAC con la pregunta que responde cada uno, variaciones e indices y como se leen, los cuatro EAC con su supuesto, ETC, VAC y TCPI, y la tabla de nombres PMI / MS Project. Ejercicios: las habitaciones, los quioscos del video, el proyecto de 200.000, las 4 paredes y los 4 del taller.',
        'meta' => 'huecos numericos + emparejar',
        'src'  => 'Conceptos de Valor ganado.pdf, Ruta critica y Valor ganado.pdf, Taller de Valor ganado.pdf, video de valor ganado'
    ],
    [
        'n'    => '3',
        'ruta' => 'ProjectPlaneacion.php',
        'tit'  => 'MS Project — Planeacion',
        'desc' => 'Para que sirve, la interfaz, la configuracion del Backstage, calendarios, tipos de tareas, relaciones FC/CC/FF/CF con adelantos y atrasos, tipos de recursos, linea base y como se ve la ruta critica. Cierra con el Cronocurso completo: predecesoras, duracion y costo planeado.',
        'meta' => 'huecos + emparejar',
        'src'  => 'Presentacion de Planeacion en MS Project.pdf + videos 1, 2, 3, 5, 6 y 7'
    ],
    [
        'n'    => '4',
        'ruta' => 'ProjectControl.php',
        'tit'  => 'MS Project — Control y seguimiento',
        'desc' => 'Las 4 actividades de control, las 6 tecnicas de seguimiento, los tres grupos de datos (programados, previstos, reales), que pasa con cada campo en el ejercicio de "Tipos de campos", el % completado, la fecha de estado, la tabla de valor acumulado en Project y los indicadores con semaforo.',
        'meta' => 'huecos + emparejar',
        'src'  => 'Control y seguimiento - MS Project.pdf + videos 8 y 9'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Parcial 2 — Cuestionarios</title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<style>
:root{--azul:#2c5aa0;--gris:#f4f5f7;--borde:#d8dbe0}
*{box-sizing:border-box}
body{margin:0;background:var(--gris);font-family:-apple-system,Segoe UI,Arial,sans-serif;
     color:#22262b;line-height:1.6}
.topbar{background:#1f2733;color:#fff;padding:14px 18px;display:flex;gap:14px;align-items:center;
        box-shadow:0 2px 8px rgba(0,0,0,.25)}
.topbar h1{font-size:19px;margin:0;font-weight:600}
.topbar .sub{font-size:13px;opacity:.75;margin:0}
.topbar .spacer{flex:1}
.topbar a{color:#cfe3ff;text-decoration:none;font-size:14px}
.wrap{max-width:900px;margin:0 auto;padding:26px 18px 60px}
.intro{background:#fff;border:1px solid var(--borde);border-radius:12px;padding:18px 22px;margin-bottom:22px}
.intro p{margin:8px 0}
a.item{display:block;background:#fff;border:1px solid var(--borde);border-left:5px solid var(--azul);
       border-radius:10px;padding:16px 20px;margin:0 0 14px;text-decoration:none;color:inherit;
       transition:.12s}
a.item:hover{box-shadow:0 4px 16px rgba(0,0,0,.12);transform:translateY(-1px);
             text-decoration:none;color:inherit;border-left-color:#1a7f37}
.item .num{display:inline-block;background:var(--azul);color:#fff;border-radius:50%;
           width:26px;height:26px;line-height:26px;text-align:center;font-size:14px;
           font-weight:700;margin-right:8px}
.item h3{display:inline;font-size:17px;margin:0;color:var(--azul)}
.item p{margin:8px 0 0;font-size:14.5px;color:#3c4654}
.item .meta{margin-top:8px;font-size:12.5px;color:#7a8494}
.item .meta b{color:#3c4654}
</style>
</head>
<body>

<div class="topbar">
  <div>
    <h1>Parcial 2 &middot; Cuestionarios</h1>
    <p class="sub">Gestion del cronograma y de los costos: ruta critica, valor ganado y MS Project</p>
  </div>
  <div class="spacer"></div>
  <a href="../Menu.php">&#8962; Menu</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Cada concepto se pregunta <b>una sola vez</b>, en el cuestionario donde mejor encaja:
       las formulas e interpretacion del valor ganado viven en <b>Valor ganado</b>, y en
       <b>Control y seguimiento</b> solo se pregunta lo propio de la herramienta (donde estan
       las columnas, como se llaman, que hace Project). Lo mismo con la ruta critica: el
       calculo en su cuestionario, el boton de Project en <b>Planeacion</b>.</p>
    <p>Los huecos numericos aceptan <b>620.000</b>, <b>620,000</b> o <b>620000</b>, con o sin
       <b>$</b>, y el redondeo a dos decimales. El signo si cuenta: una variacion negativa
       se escribe con <b>-</b>.</p>
  </div>

  <?php foreach ($CUESTIONARIOS as $c): ?>
    <a class="item" href="<?= $c['ruta'] ?>">
      <span class="num"><?= $c['n'] ?></span><h3><?= $c['tit'] ?></h3>
      <p><?= $c['desc'] ?></p>
      <div class="meta"><b><?= $c['meta'] ?></b> &nbsp;&middot;&nbsp; fuente: <?= $c['src'] ?></div>
    </a>
  <?php endforeach; ?>

</div>
</body>
</html>
