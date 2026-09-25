<?php
/* Gestion de Proyectos — menu de cuestionarios */

$CUESTIONARIOS = [
    [
        'n'    => '1',
        'ruta' => 'Grupo001/index.php',
        'tit'  => 'Examen 1 — Grupo001',
        'desc' => 'Refinamiento y DOR, resultados clave del objetivo de postventa, clasificacion de proyectos por objetivo estrategico, Scrum como enfoque adaptativo, el caso de los dashboards de servicios publicos, eventos de Scrum, caso de negocio, flujo de caja y los dos casos con diagrama (agricultura de precision y edificio vacacional).',
        'meta' => '13 preguntas · 26,00 puntos',
        'src'  => 'Revision del intento del 3 de septiembre de 2025'
    ],
    [
        'n'    => '2',
        'ruta' => 'Grupo003/index.php',
        'tit'  => 'Examen 1 — Grupo003',
        'desc' => 'Las mismas 13 preguntas del otro grupo pero en distinto orden y con variantes de redaccion: caso de negocio, flujo de caja, edificio vacacional, objetivos estrategicos de AutoData, agricultura de precision, sprint de pruebas, dashboards, Sprint Review, segundo sprint, resultados clave y el parrafo de DOFA, valores y proposito.',
        'meta' => '13 preguntas · 26,00 puntos',
        'src'  => 'Revision del intento del 11 de marzo de 2026'
    ],
    [
        'n'    => '3',
        'ruta' => 'Conceptos/index.php',
        'tit'  => 'Conceptos — proyecto, portafolio y OKR',
        'desc' => 'Solo huecos, sin opcion multiple: las definiciones literales del material. Los pilares de la planeacion estrategica con su definicion corta (mision, vision, valores, DOFA con sus cuatro componentes, objetivos estrategicos y resultados clave, cada uno con la pregunta que responde). Que es un proyecto (temporal, contexto unico, creacion de valor mediante cambio), proyecto frente a operacion, la definicion de gerencia de proyectos y sus 5 areas de foco, programa frente a portafolio, que son los OKR, los objetivos como el "que" y los resultados clave como el "como", la formula del KR, las iniciativas como proyectos, el ejemplo de ventas y por que fallan los objetivos.',
        'meta' => '100 huecos · 13 bloques',
        'src'  => 'Planeacion estrategica - HA (2).docx + Def Proyecto - OKRs.pdf'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion de Proyectos — Cuestionarios</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
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
.mkok{color:#1a7f37;font-weight:700}
.mkbad{color:#c0392b;font-weight:700}
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
    <h1>Gestion de Proyectos &middot; Cuestionarios</h1>
    <p class="sub">Gerencia de proyectos de T.I. — Unidad 1, Formulacion de Proyectos</p>
  </div>
  <div class="spacer"></div>
  <a href="../index.php">&#8962; php_web</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Los dos examenes tal cual, sin cambiar una palabra: mismas preguntas, mismas
       opciones, mismo orden y los mismos diagramas del enunciado.</p>
    <p><span class="mkok">&#10004;</span> bien &nbsp;&middot;&nbsp;
       <span class="mkbad">&#10008;</span> mal, y al verificar se resalta la opcion buena
       con la explicacion debajo.</p>
    <p>Las preguntas abiertas se practican con <b>huecos</b>: la respuesta que vale los
       puntos aparece escrita con las palabras clave en blanco. Se corrige sola al pulsar
       <b>Enter</b> o <b>Verificar</b>, y cada hueco suma en el marcador. No importan
       mayusculas ni tildes.</p>
    <p>Debajo de cada una quedan plegados: <b>escribirlo con mis palabras</b> (para
       redactarlo de verdad), la <b>rubrica</b>, la <b>retroalimentacion del profesor</b>
       y el <b>material del curso</b> en el que se apoya la respuesta.</p>
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
