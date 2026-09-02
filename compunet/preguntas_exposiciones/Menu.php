<?php
/* Preguntas de las exposiciones — menu (CompuNet 3) */

$CUESTIONARIOS = [
    [
        'n' => '1',
        'ruta' => 'ReactNative/index.php',
        'tit' => 'React Native',
        'desc' => 'Con qué se programa, qué componente hace de <code>div</code>, ventajas reales del framework, y los dos piezas de la nueva arquitectura: Hermes y Fabric.',
        'meta' => '5 preguntas (1 de varias correctas)',
    ],
    [
        'n' => '2',
        'ruta' => 'Jenkins/index.php',
        'tit' => 'Jenkins y CI/CD',
        'desc' => 'Las etapas del <code>Jenkinsfile</code>, cómo se compara con otras herramientas de CI/CD, los plugins destacados y lo que Jenkins hace mal.',
        'meta' => '4 preguntas (3 de varias correctas)',
    ],
    [
        'n' => '3',
        'ruta' => 'Angular/index.php',
        'tit' => 'Angular y SPA',
        'desc' => 'Definición de SPA, las cuatro sintaxis de binding, comunicación entre componentes y en qué se diferencia Angular de React.',
        'meta' => '5 preguntas',
    ],
    [
        'n' => '4',
        'ruta' => 'Flask/index.php',
        'tit' => 'Flask',
        'desc' => 'Por qué es un «micro» framework, qué hay debajo, cómo se organiza un proyecto grande y en qué escenarios encaja.',
        'meta' => '4 preguntas',
    ],
    [
        'n' => '5',
        'ruta' => 'SeguridadWeb/index.php',
        'tit' => 'Seguridad web y DevSecOps',
        'desc' => 'La diferencia real entre XSS y CSRF, por qué la seguridad va dentro del pipeline, qué pasó en Equifax y el peligro de <code>dangerouslySetInnerHTML</code>.',
        'meta' => '5 preguntas',
    ],
    [
        'n' => '6',
        'ruta' => 'Flutter/index.php',
        'tit' => 'Flutter',
        'desc' => 'Por qué se ve igual en todas partes, por qué no es buena idea para una web pública, qué atributo de calidad favorece y cómo se nombran las cosas en Dart.',
        'meta' => '5 preguntas',
    ],
    [
        'n' => '7',
        'ruta' => 'Astro/index.php',
        'tit' => 'Astro',
        'desc' => 'Las tres preguntas de la exposición sobre cuándo conviene una plataforma todo-en-uno, por qué las islas no sirven para un dashboard en tiempo real, y Content Collections frente a un CMS externo.',
        'meta' => '3 preguntas (3 de varias correctas)',
    ],
    [
        'n' => '8',
        'ruta' => 'Go/index.php',
        'tit' => 'Go',
        'desc' => 'Por qué el sistema de pedidos usa goroutines, qué buscaba el diseño de Go, qué hace el framework Gin y cómo se ejecuta un programa en Go.',
        'meta' => '4 preguntas (2 de varias correctas)',
    ],
    [
        'n' => '9',
        'ruta' => 'DApps/index.php',
        'tit' => 'dApps — preguntas de la exposición',
        'desc' => 'Las cuatro preguntas planteadas en la exposición de dApps. Si quieres el temario completo con huecos, está en <b>dApps — Cuestionarios</b>.',
        'meta' => '4 preguntas (2 de varias correctas)',
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Preguntas de exposiciones — CompuNet 3</title>
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
.topbar a{color:#cfe3ff;text-decoration:none;font-size:14px;margin-left:14px}
.wrap{max-width:900px;margin:0 auto;padding:26px 18px 60px}
.intro{background:#fff;border:1px solid var(--borde);border-radius:12px;padding:18px 22px;margin-bottom:22px}
.intro p{margin:8px 0}
.intro code{background:#eef0f3;padding:2px 6px;border-radius:4px;
            font-family:Consolas,Menlo,monospace;font-size:.92em;color:#b02a5b}
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
@media(max-width:768px){
  .wrap{padding:18px 12px 40px}
  .intro{padding:14px 16px}
  a.item{padding:14px 16px}
}
</style>
</head>
<body>

<div class="topbar">
  <div>
    <h1>&#127908; Preguntas de exposiciones</h1>
    <p class="sub">CompuNet 3 &mdash; lo que preguntaron los grupos en el foro</p>
  </div>
  <div class="spacer"></div>
  <a href="../Menu.php">&#8962; CompuNet</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Las preguntas que public&oacute; cada grupo despu&eacute;s de su exposici&oacute;n, tal cual,
       con la respuesta correcta y una explicaci&oacute;n corta de por qu&eacute; las otras opciones no lo son.</p>
    <p>Algunas admiten <b>varias respuestas</b>: esas van con casillas y solo cuentan si marcas
       el conjunto exacto. Abajo del todo tienes <b>Verificar todo</b> y <b>Mostrar soluci&oacute;n</b>.</p>
  </div>

  <?php foreach ($CUESTIONARIOS as $c): ?>
    <a class="item" href="<?= $c['ruta'] ?>">
      <span class="num"><?= $c['n'] ?></span><h3><?= $c['tit'] ?></h3>
      <p><?= $c['desc'] ?></p>
      <div class="meta"><b><?= $c['meta'] ?></b></div>
    </a>
  <?php endforeach; ?>

</div>
</body>
</html>
