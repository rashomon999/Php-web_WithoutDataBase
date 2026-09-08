<?php
/* ==========================================================================
   APO / Menu.php  —  Menu principal
   Cada seccion es una lectura o un bloque del curso.
   La seccion de pandas abre su propio submenu (Pandas.php) con 5 cuestionarios.
   ========================================================================== */

$SECCIONES = [
    [
        'n'    => '1',
        'ruta' => 'Pandas.php',
        'tag'  => 'codigo',
        'tit'  => 'pandas — Analisis exploratorio en Python',
        'desc' => 'Los cinco cuestionarios encadenados de siempre: cargar y explorar, referenciar, filtrar y limpiar, graficas y la practica Netflix completa.',
        'meta' => '5 cuestionarios · 154 huecos + 28 preguntas',
        'src'  => 'Lecture_1.ipynb · Exercises_1.ipynb · Practica Netflix_Movies.ipynb'
    ],
    [
        'n'    => '2',
        'ruta' => 'CRISP/index.php',
        'tag'  => 'teoria',
        'tit'  => 'CRISP-DM y ASUM-DM — Ciclo de vida de la mineria de datos',
        'desc' => 'Las 6 fases de CRISP-DM y las 10 etapas de ASUM-DM paso a paso: entendimiento del negocio, entendimiento y preparacion de datos, modelado, evaluacion, despliegue y retroalimentacion.',
        'meta' => '50 huecos + 10 preguntas',
        'src'  => 'CRISP-ASUM.pdf'
    ],
    [
        'n'    => '3',
        'ruta' => 'Estadistica/index.php',
        'tag'  => 'teoria',
        'tit'  => 'Estadistica Descriptiva — Fundamentos para IA y Ciencia de Datos',
        'desc' => 'Tipos de variable, tablas de frecuencia, tendencia central, dispersion y coeficiente de variacion, medidas de posicion, asimetria y curtosis, y relacion entre dos variables.',
        'meta' => '42 huecos + 10 preguntas',
        'src'  => 'Estadistica_Descriptiva_apo3.pdf'
    ],
    [
        'n'    => '4',
        'ruta' => 'SMART/index.php',
        'tag'  => 'corto',
        'tit'  => 'Objetivos S.M.A.R.T. — Como escribirlos',
        'desc' => 'Cuestionario corto: que significa cada letra, que pregunta responde, la estructura de un objetivo bien escrito y como convertir un objetivo vago en uno SMART.',
        'meta' => '20 huecos + 8 preguntas',
        'src'  => 'SMART.pdf · Writing S.M.A.R.T. Objectives.pdf'
    ],
    [
        'n'    => '5',
        'ruta' => 'ML/index.php',
        'tag'  => 'teoria',
        'tit'  => 'Introduccion al Machine Learning',
        'desc' => 'La definicion de Mitchell (E, T, P), ML frente a IA, la historia de 1950 a 2017, regresion vs clasificacion, supervisado / no supervisado / por refuerzo, las tres fases del modelo y underfitting vs overfitting.',
        'meta' => '35 huecos + 10 preguntas',
        'src'  => 'Machine_Learning_Def.pdf · Introduccion al Machine Learning.pdf · Machine_Learning.pdf'
    ],
    [
        'n'    => '6',
        'ruta' => 'Regresion/index.php',
        'tag'  => 'mixto',
        'tit'  => 'Regresion lineal, multiple, polinomial y metricas',
        'desc' => 'Intercepto, pendiente y residuo; funcion de costo OLS y descenso de gradiente; particion 80/20; seleccion de variables (completo, tamano fijo, stepwise, PCA); MSE, RMSE y R&sup2;; y la codificacion de variables categoricas en pandas.',
        'meta' => '40 huecos + 10 preguntas',
        'src'  => 'Regresion_ma.pdf'
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
.intro{background:#fff;border:1px solid var(--borde);border-radius:12px;padding:18px 22px;margin-bottom:22px}
.intro p{margin:8px 0}
.intro code{background:#eef0f3;padding:2px 6px;border-radius:4px;
            font-family:Consolas,Menlo,monospace;font-size:.92em;color:#b02a5b}
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
.tag{float:right;font-size:11.5px;letter-spacing:.5px;text-transform:uppercase;
     padding:2px 9px;border-radius:20px;font-weight:700}
.tag.codigo{background:#e8eefa;color:#2c5aa0}
.tag.teoria{background:#e6f4ea;color:#1a7f37}
.tag.corto{background:#fff4e0;color:#b5730a}
.tag.mixto{background:#f0e8fa;color:#6b3fa0}
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

  <div class="intro">
    <p>Seis bloques: uno de <b>codigo</b> (pandas, con su propio submenu de cinco cuestionarios),
       cuatro de <b>lecturas</b> del curso y uno <b>mixto</b> (regresion, que mezcla concepto y
       nombres de pandas). Cada hueco se corrige solo al pulsar
       <b>Enter</b> o <b>Verificar</b>, y el marcador de arriba lleva la cuenta.</p>
    <p><span class="mkok">&#10004;</span> exacto &nbsp;·&nbsp;
       <span class="mkcasi">&#9888;</span> bien salvo mayusculas (solo se avisa en los de codigo,
       porque en Python eso revienta) &nbsp;·&nbsp;
       <span class="mkbad">&#10008;</span> mal, y debajo aparece la respuesta buena.</p>
    <p>En los cuestionarios de lectura las respuestas son en castellano y da igual
       la tilde, la mayuscula y el articulo de delante:
       <code>La Preparacion de Datos</code> se acepta igual que <code>preparación de datos</code>.</p>
  </div>

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
