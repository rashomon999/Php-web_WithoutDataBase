<?php
/* ==========================================================================
   APO / Menu.php  —  Menu principal: un bloque por parcial
   Parcial1.php  -> todo lo que habia antes en este menu
   Parcial2.php  -> los temas del segundo corte (SVM, ...)
   ========================================================================== */

$PARCIALES = [
    [
        'n'    => '1',
        'ruta' => 'Parcial1.php',
        'tag'  => 'parcial',
        'tit'  => 'Parcial 1',
        'desc' => 'pandas, CRISP-DM, estadistica descriptiva, objetivos SMART, introduccion al ML, regresion lineal / multiple / polinomial, Unidad 2, regresion logistica y el repaso con preguntas de examenes anteriores.',
        'meta' => '10 bloques'
    ],
    [
        'n'    => '2',
        'ruta' => 'Parcial2.php',
        'tag'  => 'parcial',
        'tit'  => 'Parcial 2',
        'desc' => 'Maquinas de Vectores de Soporte (SVM): hiperplano, margen, C, kernels, SVR y sklearn.',
        'meta' => '1 bloque (SVM, 3 cuestionarios)'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APO — Cuestionarios</title>
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
a.item{display:block;background:#fff;border:1px solid var(--borde);border-left:5px solid var(--azul);
       border-radius:10px;padding:20px 22px;margin:0 0 16px;text-decoration:none;color:inherit;
       transition:.12s}
a.item:hover{box-shadow:0 4px 16px rgba(0,0,0,.12);transform:translateY(-1px);
             text-decoration:none;color:inherit;border-left-color:#1a7f37}
.item .num{display:inline-block;background:var(--azul);color:#fff;border-radius:50%;
           width:30px;height:30px;line-height:30px;text-align:center;font-size:15px;
           font-weight:700;margin-right:10px}
.item h3{display:inline;font-size:20px;margin:0;color:var(--azul)}
.item p{margin:10px 0 0;font-size:14.5px;color:#3c4654}
.item .meta{margin-top:8px;font-size:12.5px;color:#7a8494}
.item .meta b{color:#3c4654}
.tag{float:right;font-size:11.5px;letter-spacing:.5px;text-transform:uppercase;
     padding:2px 9px;border-radius:20px;font-weight:700}
.tag.parcial{background:#fdecea;color:#c0392b}
</style>
</head>
<body>

<div class="topbar">
  <div>
    <h1>APO · Cuestionarios</h1>
    <p class="sub">Analisis y procesamiento de datos — memorizar lo que cae, no entenderlo a medias</p>
  </div>
  <div class="spacer"></div>
  <a href="../index.php">&#8962; php_web</a>
</div>

<div class="wrap">
  <?php foreach ($PARCIALES as $s): ?>
    <a class="item" href="<?= $s['ruta'] ?>">
      <span class="tag <?= $s['tag'] ?>"><?= $s['tag'] ?></span>
      <span class="num"><?= $s['n'] ?></span><h3><?= $s['tit'] ?></h3>
      <p><?= $s['desc'] ?></p>
      <div class="meta"><b><?= $s['meta'] ?></b></div>
    </a>
  <?php endforeach; ?>
</div>
</body>
</html>
