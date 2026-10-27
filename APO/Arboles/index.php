<?php
/* ==========================================================================
   APO / Arboles / index.php  —  Submenu: arboles, ensambles y validacion cruzada (Parcial 2)
   ========================================================================== */

$CUESTIONARIOS = [
    [
        'n'=>'1','ruta'=>'Basico/index.php','tit'=>'Lo basico: que es un arbol',
        'desc'=>'Arbol de decision supervisado y no parametrico, terminologia (raiz, nodo interno, rama, hoja, splitting, profundidad), clasificacion vs regresion, regiones del espacio, ID3 / C4.5 / CART / CHAID, decision stump y ventajas / desventajas.',
        'huecos'=>'29 huecos + 5 preguntas','src'=>'00_Arboles de decision y CART.pptx · 01_AprendSup-Arboles1.pptx · 00_intro_arboles.ipynb · DecStump-Ejemplo.ipynb'
    ],
    [
        'n'=>'2','ruta'=>'Criterios/index.php','tit'=>'Criterios de division: Gini y entropia',
        'desc'=>'Impureza y nodo puro, las cinco medidas (Gini, entropia, ganancia de informacion, gain ratio, reduccion de varianza), Gini a mano con Edad/Salario y entropia + ganancia con el dataset del golf.',
        'huecos'=>'25 huecos + 4 preguntas','src'=>'01_AprendSup-Arboles1.pptx · 00_intro_arboles.ipynb'
    ],
    [
        'n'=>'3','ruta'=>'Poda/index.php','tit'=>'Poda y sklearn',
        'desc'=>'Sobreajuste, pre-poda y post-poda, que hace cada hiperparametro (max_depth, min_samples_split, min_samples_leaf, min_impurity_decrease), el baseline, el caso diabetes y el codigo de DecisionTreeClassifier / Regressor.',
        'huecos'=>'20 huecos (5 de codigo) + 4 preguntas','src'=>'02_AprendSup-Ensambles.pptx · 01_Arboles_Churn-STUD.ipynb · 03_Practica_Decision_Trees.ipynb'
    ],
    [
        'n'=>'4','ruta'=>'Validacion/index.php','tit'=>'Validacion cruzada',
        'desc'=>'Por que train/test no basta, validacion vs prueba, K-Fold (y el problema de no mezclar), estratificado, LOOCV, Shuffle & Split, hiperparametros con CV (C = 1/lambda, LassoCV vs RidgeCV) y pipelines.',
        'huecos'=>'30 huecos (5 de codigo) + 6 preguntas','src'=>'cross_val.pptx · 1-Methodologies to validate a classifier.ipynb'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APO — Cuestionarios de arboles</title>
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
    <h1>APO · Parcial 2 · Árboles y validación cruzada</h1>
    <p class="sub">Arboles de decision y validacion cruzada — de lo general a lo especifico</p>
  </div>
  <div class="spacer"></div>
  <a href="../Parcial2.php">&#8592; Parcial 2</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Cuatro cuestionarios encadenados: que es un arbol, como elige los cortes, como se poda
       y como se valida un modelo. Los ensambles tienen ahora su propio bloque en Parcial 2. Lo que ya se pregunto en uno no se repite en el siguiente.</p>
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
