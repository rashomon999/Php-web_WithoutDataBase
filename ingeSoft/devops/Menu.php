<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DevOps · IngeSoft 5 — Cuestionarios</title>
<style>
:root{
  --azul:#2c5aa0; --tinta:#1f2733; --gris:#f4f5f7;
  --borde:#d8dbe0; --suave:#6b7683;
}
*{box-sizing:border-box}
body{margin:0;background:var(--gris);color:var(--tinta);
     font-family:-apple-system,Segoe UI,Arial,sans-serif;line-height:1.5}

/* ---- cabecera ---- */
.topbar{background:var(--tinta);color:#fff;padding:22px 24px}
.topbar .in{max-width:1180px;margin:0 auto;display:flex;flex-wrap:wrap;
            align-items:baseline;gap:14px}
.topbar h1{margin:0;font-size:22px;font-weight:600;letter-spacing:.2px}
.topbar .sub{font-size:14px;opacity:.7;margin:0}
.topbar .spacer{flex:1}
.topbar .total{background:#2c3746;border-radius:20px;padding:4px 14px;
               font-size:13px;white-space:nowrap}

/* ---- rejilla de bloques ---- */
.wrap{max-width:1180px;margin:0 auto;padding:26px 20px 60px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:18px}

.bloque{background:#fff;border:1px solid var(--borde);border-radius:12px;
        overflow:hidden;display:flex;flex-direction:column}
.bloque > header{padding:13px 18px;border-bottom:1px solid var(--borde);
                 display:flex;align-items:center;gap:10px}
.bloque > header .pt{font-size:20px;line-height:1}
.bloque > header h2{margin:0;font-size:15.5px;font-weight:700;letter-spacing:.2px}
.bloque > header .fuente{margin:2px 0 0;font-size:12px;color:var(--suave);font-weight:400}
.bloque > header .cuenta{margin-left:auto;font-size:12px;color:var(--suave);
                         background:var(--gris);border-radius:12px;padding:2px 9px;
                         white-space:nowrap}

.bloque ol{list-style:none;margin:0;padding:8px;flex:1}
.bloque li{margin:0}
.bloque a{display:flex;align-items:center;gap:11px;padding:9px 11px;
          border-radius:8px;text-decoration:none;color:var(--tinta);
          font-size:14.5px;transition:background .12s,color .12s}
.bloque a:hover{background:#eef4ff;color:var(--azul)}
.bloque a .n{flex:none;width:22px;height:22px;border-radius:50%;
             background:var(--gris);color:var(--suave);font-size:11.5px;
             font-weight:700;display:flex;align-items:center;justify-content:center}
.bloque a:hover .n{background:var(--azul);color:#fff}
.bloque a .fl{margin-left:auto;color:#c2c8d0;font-size:14px}
.bloque a:hover .fl{color:var(--azul)}

/* ---- color por bloque ---- */
.c-lectura  > header{background:#f3f0ff;border-bottom-color:#e0d8ff}
.c-bash     > header{background:#eef3f0;border-bottom-color:#d6e4db}
.c-linux    > header{background:#e6f4ea;border-bottom-color:#cbe6d4}
.c-parcial  > header{background:#fff4e0;border-bottom-color:#f5c98a}
.c-sesion05 > header{background:#e6f4ea;border-bottom-color:#cbe6d4}
.c-sesion06 > header{background:#e6f4ea;border-bottom-color:#cbe6d4}
.c-docker   > header{background:#e9f2fb;border-bottom-color:#cfe2f5}
.c-sesion3  > header{background:#fff4e0;border-bottom-color:#f5e2bf}
.c-sesion11 > header{background:#fdecea;border-bottom-color:#f6d5d1}
.c-cicd     > header{background:#e6f4ea;border-bottom-color:#cbe6d4}

.c-cicd,.c-sesion05,.c-sesion06,.c-linux{border-color:#9ccdb0;box-shadow:0 2px 10px rgba(26,127,55,.10)}
.nuevo{font-size:10.5px;font-weight:700;letter-spacing:.6px;text-transform:uppercase;
       background:#1a7f37;color:#fff;border-radius:4px;padding:2px 7px;margin-left:8px}

footer{max-width:1180px;margin:0 auto;padding:0 20px 40px;
       font-size:12.5px;color:var(--suave)}

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
      <h1>DevOps · Ingeniería de Software V</h1>
      <p class="sub">Cuestionarios de repaso — Universidad Icesi</p>
    </div>
    <div class="spacer"></div>
    <div class="total">30 cuestionarios · 10 bloques</div>
  </div>
</div>

<div class="wrap">
  <div class="grid">

    <section class="bloque c-parcial" style="grid-column:1/-1;border-color:#e0a047;box-shadow:0 2px 12px rgba(224,160,71,.18)">
      <header>
        <span class="pt">📝</span>
        <div>
          <h2>Parcial — simulador resuelto<span class="nuevo" style="background:#c77700">repaso</span></h2>
          <p class="fuente">parcial-devops-simulador.html · 18 preguntas con respuesta modelo</p>
        </div>
        <span class="cuenta">2</span>
      </header>
      <ol style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr))">
        <li><a href=".\Parcial\index.php"><span class="n">1</span>Preguntas 1 a 9<span class="fl">→</span></a></li>
        <li><a href=".\Parcial\segundo.php"><span class="n">2</span>Preguntas 10 a 18<span class="fl">→</span></a></li>
      </ol>
    </section>

    <section class="bloque c-lectura">
      <header>
        <span class="pt">📖</span>
        <div>
          <h2>Lectura 1</h2>
          <p class="fuente">DevOps for Dummies · IBM</p>
        </div>
        <span class="cuenta">2</span>
      </header>
      <ol>
        <li><a href=".\Lectura_1\index.php"><span class="n">1</span>Lectura_1<span class="fl">→</span></a></li>
        <li><a href=".\dummies\index.php"><span class="n">2</span>Lectura_1 (parte 2)<span class="fl">→</span></a></li>
      </ol>
    </section>

    <section class="bloque c-linux">
      <header>
        <span class="pt">🐧</span>
        <div>
          <h2>Linux para DevOps<span class="nuevo">nuevo</span></h2>
          <p class="fuente">introduccion_linux.pdf</p>
        </div>
        <span class="cuenta">3</span>
      </header>
      <ol>
        <li><a href=".\Linux\index.php"><span class="n">1</span>Consola y sistema de archivos<span class="fl">→</span></a></li>
        <li><a href=".\Linux\segundo.php"><span class="n">2</span>Permisos, propiedad y procesos<span class="fl">→</span></a></li>
        <li><a href=".\Linux\tercero.php"><span class="n">3</span>Background, servicios, SSH y SCP<span class="fl">→</span></a></li>
      </ol>
    </section>

    <section class="bloque c-bash">
      <header>
        <span class="pt">💻</span>
        <div>
          <h2>Bash</h2>
          <p class="fuente">Dev-Ops – bash · Ejercicios_Bash</p>
        </div>
        <span class="cuenta">2</span>
      </header>
      <ol>
        <li><a href=".\GitBash\index.php"><span class="n">1</span>El lenguaje<span class="fl">→</span></a></li>
        <li><a href=".\GitBash\segundo.php"><span class="n">2</span>Los 15 retos<span class="fl">→</span></a></li>
      </ol>
    </section>

    <section class="bloque c-sesion05">
      <header>
        <span class="pt">⌨️</span>
        <div>
          <h2>Sesión 5 — Scripting en Bash<span class="nuevo">nuevo</span></h2>
          <p class="fuente">sesion_05_scripting_bash.pdf</p>
        </div>
        <span class="cuenta">3</span>
      </header>
      <ol>
        <li><a href=".\Sesion05\index.php"><span class="n">1</span>Intérprete, permisos y variables<span class="fl">→</span></a></li>
        <li><a href=".\Sesion05\segundo.php"><span class="n">2</span>Control de flujo y listas<span class="fl">→</span></a></li>
        <li><a href=".\Sesion05\tercero.php"><span class="n">3</span>Flujos y manejo de errores<span class="fl">→</span></a></li>
      </ol>
    </section>

    <section class="bloque c-docker">
      <header>
        <span class="pt">🐳</span>
        <div>
          <h2>Docker</h2>
          <p class="fuente">TallerDocker · DevOps-Containers</p>
        </div>
        <span class="cuenta">2</span>
      </header>
      <ol>
        <li><a href=".\Docker\index.php"><span class="n">1</span>Contenedores<span class="fl">→</span></a></li>
        <li><a href=".\Docker\segundo.php"><span class="n">2</span>Dockerfile y comandos<span class="fl">→</span></a></li>
      </ol>
    </section>

    <section class="bloque c-sesion06">
      <header>
        <span class="pt">📦</span>
        <div>
          <h2>Sesión 6 — Introducción a Docker<span class="nuevo">nuevo</span></h2>
          <p class="fuente">sesion_06_introduccion_docker.pdf</p>
        </div>
        <span class="cuenta">3</span>
      </header>
      <ol>
        <li><a href=".\Sesion06\index.php"><span class="n">1</span>Contenedores y kernel de Linux<span class="fl">→</span></a></li>
        <li><a href=".\Sesion06\segundo.php"><span class="n">2</span>Imágenes, capas y caché<span class="fl">→</span></a></li>
        <li><a href=".\Sesion06\tercero.php"><span class="n">3</span>Redes, volúmenes y Compose<span class="fl">→</span></a></li>
      </ol>
    </section>

    <section class="bloque c-sesion3">
      <header>
        <span class="pt">🧩</span>
        <div>
          <h2>Sesión 3 — Fundamentos DevOps</h2>
          <p class="fuente">sesion_03_fundamentos_devops.pdf</p>
        </div>
        <span class="cuenta">4</span>
      </header>
      <ol>
        <li><a href=".\Sesion03\index.php"><span class="n">1</span>Definiciones y necesidad<span class="fl">→</span></a></li>
        <li><a href=".\Sesion03\segundo.php"><span class="n">2</span>Silos y sistemas<span class="fl">→</span></a></li>
        <li><a href=".\Sesion03\tercero.php"><span class="n">3</span>Prácticas y adopción<span class="fl">→</span></a></li>
        <li><a href=".\Sesion03\cuarto.php"><span class="n">4</span>Procesos, tecnología y equipos<span class="fl">→</span></a></li>
      </ol>
    </section>

    <section class="bloque c-sesion11">
      <header>
        <span class="pt">☁️</span>
        <div>
          <h2>Sesión 11 — Nube y patrones</h2>
          <p class="fuente">sesion_11_computacion_nube_patrones.pdf</p>
        </div>
        <span class="cuenta">4</span>
      </header>
      <ol>
        <li><a href=".\Sesion11\index.php"><span class="n">1</span>Fundamentos de la nube<span class="fl">→</span></a></li>
        <li><a href=".\Sesion11\segundo.php"><span class="n">2</span>IaaS / CaaS / PaaS / FaaS<span class="fl">→</span></a></li>
        <li><a href=".\Sesion11\tercero.php"><span class="n">3</span>Patrones de resiliencia<span class="fl">→</span></a></li>
        <li><a href=".\Sesion11\cuarto.php"><span class="n">4</span>Desacople, caché y sidecar<span class="fl">→</span></a></li>
      </ol>
    </section>

    <section class="bloque c-cicd">
      <header>
        <span class="pt">🚀</span>
        <div>
          <h2>CI/CD<span class="nuevo">nuevo</span></h2>
          <p class="fuente">CI_CD.pdf · GitHub Actions · Taller evaluativo</p>
        </div>
        <span class="cuenta">5</span>
      </header>
      <ol>
        <li><a href=".\CI_CD\index.php"><span class="n">1</span>Scripts de automatización<span class="fl">→</span></a></li>
        <li><a href=".\CI_CD\segundo.php"><span class="n">2</span>Docker multi-stage, Compose y proxy<span class="fl">→</span></a></li>
        <li><a href=".\CI_CD\tercero.php"><span class="n">3</span>GitFlow, SemVer y commits<span class="fl">→</span></a></li>
        <li><a href=".\CI_CD\cuarto.php"><span class="n">4</span>GitHub Actions: anatomía<span class="fl">→</span></a></li>
        <li><a href=".\CI_CD\quinto.php"><span class="n">5</span>Runners y el pipeline del taller<span class="fl">→</span></a></li>
      </ol>
    </section>

  </div>
</div>

<footer>Cada cuestionario guarda el marcador arriba y tiene botones de <b>Verificar</b>, <b>Mostrar solución</b> y <b>Limpiar</b>.</footer>

</body>
</html>
