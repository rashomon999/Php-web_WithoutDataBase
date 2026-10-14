<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DevOps 2 · IngeSoft 5 — Cuestionarios exhaustivos</title>
<style>
:root{
  --azul:#2c5aa0; --tinta:#1f2733; --gris:#f4f5f7;
  --borde:#d8dbe0; --suave:#6b7683;
}
*{box-sizing:border-box}
body{margin:0;background:var(--gris);color:var(--tinta);
     font-family:-apple-system,Segoe UI,Arial,sans-serif;line-height:1.5}
.topbar{background:var(--tinta);color:#fff;padding:22px 24px}
.topbar .in{max-width:1180px;margin:0 auto;display:flex;flex-wrap:wrap;align-items:baseline;gap:14px}
.topbar h1{margin:0;font-size:22px;font-weight:600;letter-spacing:.2px}
.topbar .sub{font-size:14px;opacity:.7;margin:0}
.topbar .spacer{flex:1}
.topbar .total{background:#2c3746;border-radius:20px;padding:4px 14px;font-size:13px;white-space:nowrap}
.topbar a.volver{color:#cfd8e6;font-size:13px;text-decoration:none;border:1px solid #47546a;border-radius:20px;padding:4px 12px}
.topbar a.volver:hover{background:#2c3746}
.wrap{max-width:1180px;margin:0 auto;padding:26px 20px 60px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:18px}
.bloque{background:#fff;border:1px solid var(--borde);border-radius:12px;overflow:hidden;display:flex;flex-direction:column}
.bloque > header{padding:13px 18px;border-bottom:1px solid var(--borde);display:flex;align-items:center;gap:10px}
.bloque > header .pt{font-size:20px;line-height:1}
.bloque > header h2{margin:0;font-size:15.5px;font-weight:700;letter-spacing:.2px}
.bloque > header .fuente{margin:2px 0 0;font-size:12px;color:var(--suave);font-weight:400}
.bloque > header .cuenta{margin-left:auto;font-size:12px;color:var(--suave);background:var(--gris);border-radius:12px;padding:2px 9px;white-space:nowrap}
.bloque ol{list-style:none;margin:0;padding:8px;flex:1}
.bloque li{margin:0}
.bloque a{display:flex;align-items:center;gap:11px;padding:9px 11px;border-radius:8px;text-decoration:none;color:var(--tinta);font-size:14.5px;transition:background .12s,color .12s}
.bloque a:hover{background:#eef4ff;color:var(--azul)}
.bloque a .n{flex:none;width:22px;height:22px;border-radius:50%;background:var(--gris);color:var(--suave);font-size:11.5px;font-weight:700;display:flex;align-items:center;justify-content:center}
.bloque a:hover .n{background:var(--azul);color:#fff}
.bloque a .fl{margin-left:auto;color:#c2c8d0;font-size:14px}
.bloque a:hover .fl{color:var(--azul)}
.c-emp    > header{background:#e9f2fb;border-bottom-color:#cfe2f5}
.c-f6     > header{background:#fff4e0;border-bottom-color:#f5e2bf}
.c-f5     > header{background:#f3f0ff;border-bottom-color:#e0d8ff}
.c-jenk   > header{background:#fdecea;border-bottom-color:#f6d5d1}
.nuevo{font-size:10.5px;font-weight:700;letter-spacing:.6px;text-transform:uppercase;background:#1a7f37;color:#fff;border-radius:4px;padding:2px 7px;margin-left:8px}
footer{max-width:1180px;margin:0 auto;padding:0 20px 40px;font-size:12.5px;color:var(--suave)}
@media(max-width:700px){
  .wrap{padding:18px 12px 40px}
  .grid{grid-template-columns:1fr;gap:14px}
  .topbar{padding:18px 16px}
  .topbar h1{font-size:19px}
}
</style>
</head>
<body>

<div class="topbar">
  <div class="in">
    <div>
      <h1>DevOps 2 &middot; Ingenier&iacute;a de Software V</h1>
      <p class="sub">Cuestionarios exhaustivos de repaso para el parcial &mdash; Universidad Icesi</p>
    </div>
    <div class="spacer"></div>
    <a class="volver" href="..\devops\Menu.php">&larr; devops (primera serie)</a>
    <div class="total">17 cuestionarios &middot; 4 bloques</div>
  </div>
</div>

<div class="wrap">
  <div class="grid">
    <section class="bloque c-emp">
      <header>
        <span class="pt">📦</span>
        <div>
          <h2>Empaquetamiento, artefactos e inmutabilidad<span class="nuevo">nuevo</span></h2>
          <p class="fuente">empaquetamiento_artefactos_inmutabilidad.pdf · Prof. Alejandro Mu&ntilde;oz Bravo</p>
        </div>
        <span class="cuenta">5</span>
      </header>
      <ol>
        <li><a href=".\Empaquetamiento\index.php"><span class="n">1</span>La fase de construcci&oacute;n<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Empaquetamiento\segundo.php"><span class="n">2</span>Dependencias, contenedores y multi-stage<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Empaquetamiento\tercero.php"><span class="n">3</span>Artefactos, versionamiento e integridad<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Empaquetamiento\cuarto.php"><span class="n">4</span>Repositorios de artefactos<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Empaquetamiento\quinto.php"><span class="n">5</span>Inmutabilidad en DevOps<span class="fl">&rarr;</span></a></li>
      </ol>
    </section>
    <section class="bloque c-f6">
      <header>
        <span class="pt">🔧</span>
        <div>
          <h2>Farley cap. 6 — Build y Deployment Scripting<span class="nuevo">nuevo</span></h2>
          <p class="fuente">Continuous Delivery · Humble &amp; Farley · Chapter 6</p>
        </div>
        <span class="cuenta">3</span>
      </header>
      <ol>
        <li><a href=".\Farley6\index.php"><span class="n">1</span>Herramientas de build<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Farley6\segundo.php"><span class="n">2</span>Principios y pr&aacute;cticas de scripting<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Farley6\tercero.php"><span class="n">3</span>Layout, despliegue y tips<span class="fl">&rarr;</span></a></li>
      </ol>
    </section>
    <section class="bloque c-f5">
      <header>
        <span class="pt">🛤️</span>
        <div>
          <h2>Farley cap. 5 — Anatom&iacute;a del Deployment Pipeline<span class="nuevo">nuevo</span></h2>
          <p class="fuente">Continuous Delivery · Humble &amp; Farley · Chapter 5</p>
        </div>
        <span class="cuenta">5</span>
      </header>
      <ol>
        <li><a href=".\Farley5\index.php"><span class="n">1</span>Qu&eacute; es el deployment pipeline<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Farley5\segundo.php"><span class="n">2</span>Pr&aacute;cticas del deployment pipeline<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Farley5\tercero.php"><span class="n">3</span>Commit stage y acceptance test gate<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Farley5\cuarto.php"><span class="n">4</span>Etapas posteriores, release y back-out<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Farley5\quinto.php"><span class="n">5</span>Implementar el pipeline y m&eacute;tricas<span class="fl">&rarr;</span></a></li>
      </ol>
    </section>
    <section class="bloque c-jenk">
      <header>
        <span class="pt">⚙️</span>
        <div>
          <h2>Jenkins CI/CD — Sesi&oacute;n 17<span class="nuevo">nuevo</span></h2>
          <p class="fuente">sesion_17_jenkins_cicd_pipelines.pdf</p>
        </div>
        <span class="cuenta">4</span>
      </header>
      <ol>
        <li><a href=".\Jenkins\index.php"><span class="n">1</span>Arquitectura y pipelines declarativos<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Jenkins\segundo.php"><span class="n">2</span>Git, triggers, multibranch y secretos<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Jenkins\tercero.php"><span class="n">3</span>Shared Libraries<span class="fl">&rarr;</span></a></li>
        <li><a href=".\Jenkins\cuarto.php"><span class="n">4</span>Nexus, despliegue continuo y rollback<span class="fl">&rarr;</span></a></li>
      </ol>
    </section>

  </div>
</div>

<footer>Cada cuestionario guarda el marcador arriba y tiene botones de <b>Verificar</b>, <b>Mostrar soluci&oacute;n</b> y <b>Limpiar</b>. Los huecos ignoran may&uacute;sculas, tildes, art&iacute;culos y punto final.</footer>

</body>
</html>
