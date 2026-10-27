<?php
/* ==========================================================================
   APO / NoSupervisado / index.php  —  Submenu: aprendizaje no supervisado (Parcial 2)
   ========================================================================== */

$CUESTIONARIOS = [
    [
        'n'=>'1','ruta'=>'Conceptos/index.php','tit'=>'Conceptos: aprendizaje no supervisado',
        'desc'=>'Supervisado vs no supervisado, por que no sirve el accuracy, las tres tareas, tipos de clustering (exclusivo, superpuesto, jerarquico, probabilistico / GMM), reglas de asociacion (Apriori), PCA / SVD / autoencoders y deteccion de anomalias.',
        'huecos'=>'23 huecos + 4 preguntas','src'=>'IBM · guia de clustering · 01_Aprendizaje_NoSupervisado.ipynb'
    ],
    [
        'n'=>'2','ruta'=>'KMeans/index.php','tit'=>'K-means',
        'desc'=>'Inercia, asignacion y actualizacion, supuesto de clusters esfericos, optimos locales, k-means++ y n_init, codo y silueta (a(i), b(i)), segmentacion de imagenes (RGB vs RGBXY) y el caso Mall Customers.',
        'huecos'=>'32 huecos (6 de codigo) + 4 preguntas','src'=>'guia de clustering · 01_Aprendizaje_NoSupervisado.ipynb · IBM'
    ],
    [
        'n'=>'3','ruta'=>'Jerarquico/index.php','tit'=>'Jerarquico, DBSCAN y evaluacion',
        'desc'=>'Aglomerativo vs divisivo, dendrograma, enlaces single / complete / average / ward, DBSCAN (eps, min_samples, nucleo / borde / ruido, grafico de k-distancias), metricas internas y externas (ARI, NMI) y el caso wine.',
        'huecos'=>'30 huecos (10 de codigo) + 4 preguntas','src'=>'guia de clustering · IBM'
    ],
    [
        'n'=>'4','ruta'=>'PCA/index.php','tit'=>'PCA: la teoria',
        'desc'=>'Valores y vectores propios con un ejemplo a mano, teorema espectral, por que maximizar la varianza lleva a la covarianza (Lagrange), los pasos del algoritmo, proyeccion, reconstruccion y comparacion con sklearn.',
        'huecos'=>'33 huecos (6 de codigo) + 4 preguntas','src'=>'02_actividad_PCA.ipynb · 01_Aprendizaje_NoSupervisado.ipynb · IBM'
    ],
    [
        'n'=>'5','ruta'=>'PCAPractica/index.php','tit'=>'PCA en la practica',
        'desc'=>'Cuando estandarizar (covarianza vs correlacion), compresion de imagenes y eigenfaces, visualizacion de wine, t-SNE / UMAP / Kernel PCA, pipeline con K-means en Mall, y ventajas, limites, LDA y analisis factorial.',
        'huecos'=>'28 huecos (3 de codigo) + 4 preguntas','src'=>'02_actividad_PCA.ipynb · 01_Aprendizaje_NoSupervisado.ipynb · IBM'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APO — Aprendizaje no supervisado</title>
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
    <h1>APO · Parcial 2 · Aprendizaje no supervisado</h1>
    <p class="sub">Clustering y PCA — de lo general a lo especifico</p>
  </div>
  <div class="spacer"></div>
  <a href="../Parcial2.php">&#8592; Parcial 2</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Cinco cuestionarios encadenados: los conceptos generales, despues K-means, clustering jerarquico
       y DBSCAN, y al final PCA (primero la teoria y luego la practica). Lo que ya se pregunto en uno no se repite en el siguiente.</p>
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
