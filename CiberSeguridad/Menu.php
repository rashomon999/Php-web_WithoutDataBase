<?php
/* CiberSeguridad — menu de cuestionarios */

$CUESTIONARIOS = [
    [
        'n'     => '1',
        'ruta'  => 'Fundamentos/index.php',
        'tit'   => 'Fundamentos: CIA y no repudio',
        'desc'  => 'Ciberseguridad, confidencialidad, integridad, disponibilidad y no repudio. Seguridad de la informacion vs ciberseguridad. Las definiciones completas, con las palabras clave en blanco.',
        'huecos'=> '41 huecos + 8 preguntas',
        'src'   => 'notas_1.pdf (Tab 1)'
    ],
    [
        'n'     => '2',
        'ruta'  => 'Riesgos/index.php',
        'tit'   => 'Riesgo, amenazas y ataques',
        'desc'  => 'Las cinco funciones del NIST, agentes de amenaza amigables y no amigables, riesgo inherente vs residual, anatomia de un ataque, malware, autenticacion y anonimato.',
        'huecos'=> '51 huecos + 11 preguntas',
        'src'   => 'notas_2.pdf'
    ],
    [
        'n'     => '3',
        'ruta'  => 'Criptografia/index.php',
        'tit'   => 'Criptografia',
        'desc'  => 'El mapa de memoria, longitud de clave, sustitucion vs transposicion, Cesar +5, Vigenere con clave BOAT, simetrico vs asimetrico, y para que sirve de verdad un hash: sal, funciones lentas e integridad.',
        'huecos'=> '44 huecos + 15 preguntas',
        'src'   => 'notas_3.pdf (Tab 5)'
    ],
    [
        'n'     => '4',
        'ruta'  => 'Normas/index.php',
        'tit'   => 'Normas y casos',
        'desc'  => 'ISO 27001 vs ISO 27002, la ley SOX, el escandalo del rootkit de Sony BMG y la botnet Mirai contra Dyn.',
        'huecos'=> '15 huecos + 8 preguntas',
        'src'   => 'notas_2.pdf (clase) + ampliacion'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CiberSeguridad — Cuestionarios</title>
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
    <h1>CiberSeguridad · Cuestionarios</h1>
    <p class="sub">De la triada CIA a la criptografia — a partir de tus apuntes</p>
  </div>
  <div class="spacer"></div>
  <a href="../index.php">&#8962; php_web</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Cuatro cuestionarios, uno por cada bloque de apuntes. Cada hueco se corrige solo
       al pulsar <b>Enter</b> o <b>Verificar</b>, y el marcador de arriba lleva la cuenta.</p>
    <p><span class="mkok">&#10004;</span> bien &nbsp;·&nbsp;
       <span class="mkbad">&#10008;</span> mal, y debajo aparece la respuesta buena.</p>
    <p>Aqui las respuestas son en <b>texto</b>: no importan mayusculas ni tildes, y muchas
       se aceptan en español o en ingles (<code>no repudio</code> = <code>nonrepudiation</code>).</p>
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
