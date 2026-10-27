<?php
/* ==========================================================================
   APO / Ensambles / index.php  —  Submenu: metodos de ensamble (Parcial 2)
   ========================================================================== */

$CUESTIONARIOS = [
    [
        'n'=>'1','ruta'=>'Conceptos/index.php','tit'=>'Conceptos: que es un ensamble',
        'desc'=>'Definicion, aprendices debiles vs fuertes (50% / 80%), sesgo, varianza y error irreducible, categorias secuenciales y paralelos (homogeneos / heterogeneos) y tecnicas simples (max voting, averaging, weighted average) vs avanzadas.',
        'huecos'=>'26 huecos + 3 preguntas','src'=>'Ensemble Learning.pdf · IBM · 02_AprendSup-Ensambles.pptx'
    ],
    [
        'n'=>'2','ruta'=>'Bagging/index.php','tit'=>'Bagging y Random Forest',
        'desc'=>'Bootstrap + aggregation, que error reduce, pasting / random subspaces / random patches, OOB (63,2% / 36,8%), pros y contras, Random Forest (max_features), importancia MDI, Extra-Trees y codigo.',
        'huecos'=>'28 huecos (4 de codigo) + 4 preguntas','src'=>'Ensemble Learning.pdf · 02_AprendSup-Ensambles.pptx · 04_Random_Forest.ipynb · scikit-learn'
    ],
    [
        'n'=>'3','ruta'=>'Boosting/index.php','tit'=>'Boosting',
        'desc'=>'Idea y algoritmo (pesos de las instancias), AdaBoost / Gradient Boosting / XGBoost, pros y contras, valores por defecto de AdaBoost, learning_rate y subsample en Gradient Boosting, HistGradientBoosting y codigo.',
        'huecos'=>'27 huecos (3 de codigo) + 4 preguntas','src'=>'Ensemble Learning.pdf · 02_AprendSup-Ensambles.pptx · 01_Arboles_Churn-STUD.ipynb · scikit-learn'
    ],
    [
        'n'=>'4','ruta'=>'Stacking/index.php','tit'=>'Stacking, voting y comparacion',
        'desc'=>'Stacking y meta-modelo, los 4 pasos con n-fold, pros y contras, la tabla Bagging vs Boosting vs Stacking, voting duro / suave con pesos, y codigo.',
        'huecos'=>'27 huecos (2 de codigo) + 4 preguntas','src'=>'Ensemble Learning.pdf · IBM · scikit-learn'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APO — Cuestionarios de ensambles</title>
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
.mkok{color:#1a7f37;font-weight:700}
.mkcasi{color:#b5730a;font-weight:700}
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
    <h1>APO · Parcial 2 · Métodos de ensamble</h1>
    <p class="sub">Bagging, boosting y stacking — de lo general a lo especifico</p>
  </div>
  <div class="spacer"></div>
  <a href="../Parcial2.php">&#8592; Parcial 2</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Cuatro cuestionarios encadenados: la idea del ensamble y luego bagging, boosting y stacking,
       cada uno con su teoria, sus pros y contras y su codigo en sklearn. Lo que ya se pregunto en uno no se repite en el siguiente.</p>
    <p><span class="mkok">&#10004;</span> exacto &nbsp;·&nbsp;
       <span class="mkcasi">&#9888;</span> bien salvo mayusculas (solo en las lineas de codigo) &nbsp;·&nbsp;
       <span class="mkbad">&#10008;</span> mal.</p>
  </div>

  <?php foreach ($CUESTIONARIOS as $c): ?>
    <a class="item" href="<?= $c['ruta'] ?>">
      <span class="num"><?= $c['n'] ?></span><h3><?= $c['tit'] ?></h3>
      <p><?= $c['desc'] ?></p>
      <div class="meta"><b><?= $c['huecos'] ?></b> &nbsp;·&nbsp; fuente: <?= $c['src'] ?></div>
    </a>
  <?php endforeach; ?>

</div>
</body>
</html>
