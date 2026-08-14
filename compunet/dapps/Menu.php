<?php
/* dApps — menu de cuestionarios (CompuNet 3) */

$CUESTIONARIOS = [
    [
        'n'     => '1',
        'ruta'  => 'Fundamentos/index.php',
        'tit'   => 'Fundamentos de las dApps',
        'desc'  => 'Que es una dApp, que problema resuelve, descentralizacion, P2P, que es una blockchain, por que todos los nodos ejecutan el contrato, ventajas y limitaciones, Web 1.0/2.0/3.0.',
        'huecos'=> '44 huecos + 7 preguntas',
        'src'   => 'exposicion.pdf — General, P2P, Blockchain, web3'
    ],
    [
        'n'     => '2',
        'ruta'  => 'SmartContracts/index.php',
        'tit'   => 'Smart Contracts',
        'desc'  => 'Definicion, "si X entonces Y", el ejemplo del alquiler, el codigo de la Caja en Solidity, los cinco pasos de ejecucion, beneficios, Solidity, y codigo inmutable vs estado mutable.',
        'huecos'=> '41 huecos + 8 preguntas',
        'src'   => 'exposicion.pdf — smartContract, solidity'
    ],
    [
        'n'     => '3',
        'ruta'  => 'Arquitectura/index.php',
        'tit'   => 'Arquitectura de una dApp',
        'desc'  => 'La pila completa, dApp vs app tradicional, los siete pasos de una interaccion, el ABI a fondo, ethers.js, window.ethereum, RPC y el flujo del boton Donar.',
        'huecos'=> '42 huecos + 10 preguntas',
        'src'   => 'exposicion.pdf — frontend, ABI, RPC, flujo_normal'
    ],
    [
        'n'     => '4',
        'ruta'  => 'Stack/index.php',
        'tit'   => 'El stack de la demo',
        'desc'  => 'Sepolia, Hardhat, Alchemy, MetaMask y Etherscan: que hace cada uno. Chain IDs, cliente-servidor vs p2p, gas, por que cada deploy crea un contrato nuevo, y Bitcoin vs Ethereum.',
        'huecos'=> '42 huecos + 11 preguntas',
        'src'   => 'exposicion.pdf — Tecnologias_usadas, gas, Sepolia'
    ],
];
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>dApps — Cuestionarios</title>
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
    <h1>&#128640; dApps · Cuestionarios</h1>
    <p class="sub">CompuNet 3 — preparacion de la exposicion</p>
  </div>
  <div class="spacer"></div>
  <a href="../Menu.php">&#8962; CompuNet</a>
</div>

<div class="wrap">

  <div class="intro">
    <p>Cuatro cuestionarios sacados de <code>exposicion.pdf</code>, ordenados igual que
       expondrias: primero el que y el por que, luego el como, y al final las herramientas.</p>
    <p>Las definiciones estan escritas <b>completas</b>, con las palabras clave en blanco.
       Cada hueco se corrige al pulsar <b>Enter</b> o <b>Verificar</b>.
       <span class="mkok">&#10004;</span> bien &nbsp;·&nbsp;
       <span class="mkbad">&#10008;</span> mal, y debajo aparece la respuesta buena.</p>
    <p>No importan mayusculas ni tildes.</p>
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
