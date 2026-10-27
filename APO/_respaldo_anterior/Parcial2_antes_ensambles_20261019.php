<?php
/* ==========================================================================
   APO / Parcial2.php  —  Menu del parcial 2
   Cada bloque abre su propio submenu de cuestionarios.
   ========================================================================== */

$SECCIONES = [
    [
        'n'    => '1',
        'ruta' => 'SVM/index.php',
        'tag'  => 'mixto',
        'tit'  => 'SVM — Maquinas de Vectores de Soporte',
        'desc' => 'Tres cuestionarios de lo general a lo especifico: lo basico (hiperplano, margen, vectores de soporte), margen blando + kernels (C, lineal / polinomico / RBF / sigmoide, gamma) y formulas + SVR + sklearn.',
        'meta' => '3 cuestionarios · 81 huecos + 17 preguntas',
        'src'  => 'SVM.pdf · 0_SVM_theory_examples_v2.ipynb · 1_SVM-sklearn.ipynb · 2_SVM_Exercises.ipynb · Medium (Tibrewal)'
    ],
    [
        'n'    => '2',
        'ruta' => 'Arboles/index.php',
        'tag'  => 'mixto',
        'tit'  => 'Árboles de decisión, ensambles y validación cruzada',
        'desc' => 'Cinco cuestionarios de lo general a lo especifico: que es un arbol, criterios de division (Gini, entropia), poda y sklearn, ensambles (bagging, Random Forest, boosting) y validacion cruzada (K-Fold, estratificado, LOO, Shuffle & Split).',
        'meta' => '5 cuestionarios · 132 huecos + 24 preguntas',
        'src'  => 'Arboles Diapositivas · Python notebooks y data (arboles) · cross-validation (2026-10-19)'
    ],
    [
        'n'    => '3',
        'ruta' => 'Examenes2/index.php',
        'tag'  => 'test',
        'tit'  => 'Test — Preguntas de parciales 2 anteriores',
        'desc' => 'Las preguntas tal cual de los examenes, sin repetir: arboles y poda, ensambles (bagging, boosting, stacking, RF vs XGBoost), KNN, K-Means, DBSCAN, PCA, SVM, seleccion de caracteristicas y metricas. Se responde todo, se envia y solo se marca bien o mal; no muestra la respuesta correcta.',
        'meta' => '50 preguntas (38 del parcial 2026 + 12 del 2025-1 que no se repiten)',
        'src'  => 'parcial2APO.pdf · parcial_2_revision.pdf · Parcial2_IA.pdf'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APO — Parcial 2</title>
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
.tag{float:right;font-size:11.5px;letter-spacing:.5px;text-transform:uppercase;
     padding:2px 9px;border-radius:20px;font-weight:700}
.tag.mixto{background:#f0e8fa;color:#6b3fa0}
.tag.test{background:#fdecea;color:#c0392b}
</style>
</head>
<body>

<div class="topbar">
  <div>
    <h1>APO · Parcial 2</h1>
    <p class="sub">Temas del segundo corte</p>
  </div>
  <div class="spacer"></div>
  <a href="Menu.php">&#8962; Menu</a>
</div>

<div class="wrap">
  <?php foreach ($SECCIONES as $s): ?>
    <a class="item" href="<?= $s['ruta'] ?>">
      <span class="tag <?= $s['tag'] ?>"><?= $s['tag'] ?></span>
      <span class="num"><?= $s['n'] ?></span><h3><?= $s['tit'] ?></h3>
      <p><?= $s['desc'] ?></p>
      <div class="meta"><b><?= $s['meta'] ?></b> &nbsp;·&nbsp; fuente: <?= $s['src'] ?></div>
    </a>
  <?php endforeach; ?>
</div>
</body>
</html>
