<?php
/* ==========================================================================
   APO / SVM / index.php  —  Submenu de los cuestionarios de SVM (Parcial 2)
   ========================================================================== */

$CUESTIONARIOS = [
    [
        'n'     => '1',
        'ruta'  => 'Basico/index.php',
        'tit'   => 'Lo basico: hiperplano, margen y vectores de soporte',
        'desc'  => 'Que es una SVM, que es el hiperplano en 2D, 3D y N dimensiones, el margen como "la calle mas ancha", los vectores de soporte, como se clasifica un punto nuevo con f(x) = w&middot;x + b, y ventajas / desventajas.',
        'huecos'=> '26 huecos + 6 preguntas',
        'src'   => 'SVM.pdf · 0_SVM_theory_examples_v2.ipynb · Medium'
    ],
    [
        'n'     => '2',
        'ruta'  => 'Kernels/index.php',
        'tit'   => 'Margen blando, C y los kernels',
        'desc'  => 'Margen duro vs blando y las variables de holgura, que hace C grande o pequeno, el truco del kernel, los cuatro kernels (lineal, polinomico, RBF, sigmoide) y para que sirve cada uno, un kernel polinomico a mano, y gamma.',
        'huecos'=> '28 huecos + 6 preguntas',
        'src'   => 'SVM.pdf · notebooks 0, 1 y 2 · Medium'
    ],
    [
        'n'     => '3',
        'ruta'  => 'Sklearn/index.php',
        'tit'   => 'Formulas, SVR y sklearn',
        'desc'  => 'Por que el margen vale 2/&#8214;w&#8214;, problema primal y dual (los &alpha;), margen blando en formula, regresion con el tubo epsilon, y las lineas de sklearn: SVC, SVR, StandardScaler, support_vectors_, coef_, intercept_.',
        'huecos'=> '27 huecos (11 de codigo) + 5 preguntas',
        'src'   => 'SVM.pdf · 0_SVM_theory_examples_v2.ipynb · 1_SVM-sklearn.ipynb'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APO — Cuestionarios de SVM</title>
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
    <h1>APO · Parcial 2 · SVM</h1>
    <p class="sub">Maquinas de Vectores de Soporte — de lo general a lo especifico</p>
  </div>
  <div class="spacer"></div>
  <a href="../Parcial2.php">&#8592; Parcial 2</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Tres cuestionarios encadenados: primero la idea general, luego margen blando y kernels,
       y al final las formulas y el codigo. Lo que ya se pregunto en uno no se repite en el siguiente.</p>
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
