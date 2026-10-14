<?php
/* ==========================================================================
   APO / Pandas.php  —  Submenu de los cuatro cuestionarios de pandas
   (antes esto era el contenido de Menu.php; Menu.php es ahora el indice general)
   ========================================================================== */

$CUESTIONARIOS = [
    [
        'n'     => '1',
        'ruta'  => 'Lectura_1/index.php',
        'tit'   => 'Fundamentos: cargar y explorar',
        'desc'  => 'import, read_csv, shape, head, info, describe, mean/median, value_counts, unique, isna, corr.',
        'huecos'=> '33 huecos + 5 preguntas',
        'src'   => 'Lecture_1.ipynb · Exercises_1.ipynb'
    ],
    [
        'n'     => '2',
        'ruta'  => 'Referencia/index.php',
        'tit'   => 'Referenciar: tabla, columnas, filas y celdas',
        'desc'  => 'Corchetes, doble corchete, slicing, .iloc[fila, columna], .loc[etiqueta, nombre], rangos, .at, ordenar e indice.',
        'huecos'=> '31 huecos + 6 preguntas',
        'src'   => 'Lecture_1.ipynb · Netflix'
    ],
    [
        'n'     => '3',
        'ruta'  => 'Filtros/index.php',
        'tit'   => 'Filtrar, limpiar y crear columnas',
        'desc'  => 'Mascaras booleanas, & | ~, loc con condicion + columna, columnas calculadas, copy, dropna, replace, reset_index, groupby.',
        'huecos'=> '30 huecos + 6 preguntas',
        'src'   => 'Lecture_1.ipynb · Netflix'
    ],
    [
        'n'     => '4',
        'ruta'  => 'Graficas/index.php',
        'tit'   => 'Graficas',
        'desc'  => 'plot(kind=hist/density/box/bar/pie), value_counts + pie, scatter con x e y, boxplot(by=...), matplotlib a pelo.',
        'huecos'=> '31 huecos + 5 preguntas',
        'src'   => 'Lecture_1.ipynb · Exercises_1.ipynb'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APO — Cuestionarios de pandas</title>
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
</style>
</head>
<body>

<div class="topbar">
  <div>
    <h1>APO · Cuestionarios de pandas</h1>
    <p class="sub">Analisis exploratorio de datos — memorizar las lineas, no entenderlas a medias</p>
  </div>
  <div class="spacer"></div>
  <a href="Menu.php">&#8962; Menu</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Cuatro cuestionarios encadenados, de lo simple a lo complejo. Cada hueco se corrige
       solo al pulsar <b>Enter</b> o <b>Verificar</b>, y el marcador de arriba lleva la cuenta.</p>
    <p><span class="mkok">&#10004;</span> exacto &nbsp;·&nbsp;
       <span class="mkcasi">&#9888;</span> bien salvo mayusculas (en Python eso revienta, asi que te ensena la forma correcta) &nbsp;·&nbsp;
       <span class="mkbad">&#10008;</span> mal, y debajo aparece la linea buena.</p>
    <p>Las comillas simples y dobles valen igual, y el espaciado da lo mismo:
       <code>sales.loc[ sales['State']=='Kentucky' ]</code> se acepta.</p>
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
