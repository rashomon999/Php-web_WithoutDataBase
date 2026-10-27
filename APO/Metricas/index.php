<?php
/* ==========================================================================
   APO / Metricas / index.php  —  Submenu: metricas, sesgo-varianza y regularizacion (Parcial 2)
   ========================================================================== */

$CUESTIONARIOS = [
    [
        'n'=>'1','ruta'=>'SesgoVarianza/index.php','tit'=>'El compromiso sesgo-varianza',
        'desc'=>'Errores reducibles e irreducibles, sesgo vs varianza, la diana, la curva de complejidad, como se detectan subajuste y sobreajuste, KNN segun k, y como se combate (validacion cruzada, menos atributos, regularizacion, weight decay, dropout, early stopping, poda).',
        'huecos'=>'28 huecos + 6 preguntas','src'=>'diap_regu.pdf · Sesion5-1_Regularizacion.ipynb · Analytics Vidhya'
    ],
    [
        'n'=>'2','ruta'=>'Regularizacion/index.php','tit'=>'Regularizacion: Ridge, Lasso y Elastic Net',
        'desc'=>'Norma p, la funcion de costo con L1 y L2, lambda (alpha y C = 1/lambda), el ejemplo de Ridge con dos puntos, la geometria circulo vs diamante, cuando usar cada una, estandarizar y escoger lambda con validacion cruzada.',
        'huecos'=>'33 huecos (3 de codigo) + 5 preguntas','src'=>'diap_regu.pdf · Sesion5-1_Regularizacion.ipynb'
    ],
    [
        'n'=>'3','ruta'=>'Clasificacion/index.php','tit'=>'Metricas de clasificacion',
        'desc'=>'La matriz en sklearn, especificidad, exactitud balanceada, F1 como media armonica, zero_division, los cinco casos, el caso de compras con 5 % de positivos, la curva ROC y el AUC, y los casos de la actividad (cancer raro y moderacion de contenido).',
        'huecos'=>'31 huecos (3 de codigo) + 5 preguntas','src'=>'Sesion5-2_metrics_for_classification.ipynb · Actividad_metricas.pdf'
    ],
    [
        'n'=>'4','ruta'=>'Regresion/index.php','tit'=>'Metricas de regresion: lo que muestran y lo que esconden',
        'desc'=>'Por que el MSE castiga los errores grandes, un dato malo en diabetes, el cuarteto de Anscombe, R² negativo, RMSE relativo y los casos de la actividad (mansiones y el queso con costo asimetrico).',
        'huecos'=>'28 huecos (3 de codigo) + 4 preguntas','src'=>'Sesion5-3_metrics_for_regresion.ipynb · Actividad_metricas.pdf'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APO — Metricas y regularizacion</title>
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
    <h1>APO · Parcial 2 · Metricas, sesgo-varianza y regularizacion</h1>
    <p class="sub">Por que un modelo falla, como se controla y como se mide</p>
  </div>
  <div class="spacer"></div>
  <a href="../Parcial2.php">&#8592; Parcial 2</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Cuatro cuestionarios encadenados: primero el compromiso sesgo-varianza (por que un modelo falla), luego la
       regularizacion (como se controla) y al final las metricas de clasificacion y de regresion (como se mide). No repiten
       lo que ya salio en el repaso del parcial 1; donde las fuentes no dicen lo mismo hay una pregunta de <b>contraste</b>.</p>
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
