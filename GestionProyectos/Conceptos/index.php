<?php
/* ==========================================================================
   Gerencia de Proyectos de T.I.  —  Conceptos de la Unidad 1
   Todo de huecos, sin opcion multiple. Las definiciones son literales del
   material: "Def Proyecto - OKRs.pdf".
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [

/* ---- 1. Que es un proyecto ---- */
  1 => ['temporal'],
  2 => ['objetivos'],
  3 => ['recursos'],
  4 => ['prioridades'],
  5 => ['unico'],
  6 => ['valor'],
  7 => ['cambio'],
  8 => ['actual'],
  9 => ['futuro'],

/* ---- 2. Proyecto vs operacion ---- */
 10 => ['unicos'],
 11 => ['temporalidad'],
 12 => ['repetitivas'],
 13 => ['permanentemente'],
 14 => ['direccion'],
 15 => ['procesos'],

/* ---- 3. Direccion de proyectos ---- */
 16 => ['habilidades'],
 17 => ['herramientas'],
 18 => ['tecnicas'],
 19 => ['requisitos'],
 20 => ['inicio'],
 21 => ['planeacion', 'planificacion'],
 22 => ['ejecucion'],
 23 => ['seguimiento y control', 'monitoreo y control', 'seguimiento', 'monitoreo'],
 24 => ['cierre'],

/* ---- 4. Programa y portafolio ---- */
 25 => ['programa'],
 26 => ['coordinada'],
 27 => ['beneficios'],
 28 => ['mayor'],
 29 => ['portafolio'],
 30 => ['estrategia'],
 31 => ['estrategicos'],
 32 => ['cuantificables'],
 33 => ['clasificados'],
 34 => ['priorizados'],

/* ---- 5. Que es OKR ---- */
 35 => ['objectives'],
 36 => ['key results'],
 37 => ['Es un marco de trabajo colaborativo de establecimiento de objetivos'],
 38 => ['ambiciosas'],
 39 => ['medibles'],

/* ---- 6. Objetivos, el "que" ---- */
 40 => ['prioridad'],
 41 => ['lograr', 'conseguir'],
 42 => ['direccion'],
 43 => ['inspiran'],
 44 => ['motivadores'],
 45 => ['incomodos'],
 46 => ['cualitativos'],
 47 => ['recordacion'],

/* ---- 7. Resultados clave, el "como" ---- */
 48 => ['llegando'],
 49 => ['alcanzado'],
 50 => ['progreso'],
 51 => ['infinitivo'],
 52 => ['indicador'],
 53 => ['meta'],
 54 => ['voy'],
 55 => ['alcanzado'],

/* ---- 8. Iniciativas = proyectos ---- */
 56 => ['iniciativas'],
 57 => ['llego'],
 58 => ['hipotesis'],
 59 => ['impacto'],
 60 => ['medible'],
 61 => ['controlable'],
 62 => ['derivada'],
 63 => ['lejos'],
 64 => ['proyectos'],

/* ---- 9. El ejemplo de clase ---- */
 65 => ['ventas'],
 66 => ['50'],
 67 => ['tarea', 'iniciativa'],
 68 => ['aumenta', 'incrementa', 'sube'],

/* ---- 10. Por que fallan los objetivos ---- */
 69 => ['ambiguos'],
 70 => ['alineacion'],
 71 => ['realistas'],
 72 => ['recursos'],
 73 => ['seguimiento'],
 74 => ['cambio'],

 75 => ['Objetivos y Resultados Clave' ],
 76 => ['qué', 'que'],
 77 => ['cómo', 'como'],
 78 => ['el proyecto'],
   79 => ['Objetivo estratégico'],
   80 => ['Resultado clave'],
   81 => ['Iniciativa (proyecto)'],
   82 => ['Caso de negocio'],

   83 => ['Temporal'],
   84 => ['Contexto único'],
   85 => ['Creación de valor mediante cambio'],
   86 => ['Análisis', 'Analisis'],
   87 => ['Diseño', 'Diseno'],
   88 => ['Planeación', 'Planeacion'],
   89 => ['Desarrollo'],
   90 => ['Incremento'],
   91 => ['Predictivo'],
   92 => ['Adaptativo'],
   93 => ['Incremental'],
   94 => ['Iterativo'],
   95 => ['una sola vez'],
 
 ];

iniciar([], [], $SOLUCIONES);
cabecera('Conceptos · Proyecto, portafolio y OKR', 'Unidad 1 · definiciones literales del material del curso');
?>

<style>
.ruta-okr{display:flex;align-items:stretch;gap:20px;margin:34px 0 24px}
.ruta-okr__paso{position:relative;flex:1;min-width:0;background:#f7f5fb;border-radius:10px;
                        padding:34px 24px 28px;text-align:center;box-shadow:0 3px 10px rgba(31,39,51,.12)}
.ruta-okr__numero{display:flex;align-items:center;justify-content:center;width:72px;height:72px;
                           margin:0 auto 42px;border-radius:50%;color:#fff;font-size:26px;font-weight:700}
.ruta-okr__paso h3{margin:0 0 70px;color:#20285d;font-family:Georgia,serif;font-size:22px;line-height:1.25}
.ruta-okr__paso h3 .hbox{display:block}
.ruta-okr__paso h3 .hueco{width:100%;max-width:100%;padding:4px 6px;text-align:center;
                             color:#20285d;background:transparent;border-color:transparent;
                             font-family:Georgia,serif;font-size:22px;font-weight:700;line-height:1.25}
.ruta-okr__paso h3 .hueco:focus{border-color:#2c5aa0;background:#fff}
.ruta-okr__paso h3 .hueco.ok{border-color:#1a7f37;background:#e6f4ea}
.ruta-okr__paso h3 .hueco.bad{border-color:#c0392b;background:#fdecea}
.ruta-okr__paso h3 .corr{display:block;margin:6px 0 0;font-family:-apple-system,Segoe UI,Arial,sans-serif;
                          font-size:13px;line-height:1.3}
.ruta-okr__paso p{margin:0;color:#20285d;font-size:16px;line-height:1.55}
.ruta-okr__paso:not(:last-child)::after{content:"";position:absolute;top:50%;right:-22px;
                                                          border-top:14px solid transparent;border-bottom:14px solid transparent;
                                                          border-left:24px solid #706a84;transform:translateY(-50%);z-index:1}
.ruta-okr__paso--uno .ruta-okr__numero{background:#302052}
.ruta-okr__paso--dos .ruta-okr__numero{background:#dda638}
.ruta-okr__paso--tres .ruta-okr__numero{background:#3f8f70}
.ruta-okr__paso--cuatro .ruta-okr__numero{background:#c64e2d}
.flujo-incremental{position:relative;margin:34px 0 24px;padding:40px 28px 24px;
                              background-color:#f8fafc;background-image:linear-gradient(#e7ebf0 1px,transparent 1px),
                              linear-gradient(90deg,#e7ebf0 1px,transparent 1px);background-size:24px 24px;
                              border-right:4px dashed #26303d;overflow:hidden}
.flujo-incremental__linea{display:flex;align-items:center;gap:42px;position:relative;z-index:1}
.flujo-incremental__etapa{position:relative;flex:0 1 150px;text-align:center}
.flujo-incremental__etapa:not(:last-child)::after{content:"";position:absolute;top:50%;left:100%;width:42px;
                                                                              border-top:3px solid #303944}
.flujo-incremental__etapa:not(:last-child)::before{content:"";position:absolute;top:calc(50% - 7px);left:calc(100% + 32px);
                                                                               border-top:7px solid transparent;border-bottom:7px solid transparent;
                                                                               border-left:12px solid #303944}
.flujo-incremental__input{width:100%;padding:10px 8px;text-align:center;font-size:18px;color:#28313d;
                                       background:#fff;border:2px solid #303944;border-radius:16px;outline:none}
.flujo-incremental__etapa:first-child .flujo-incremental__input{border-color:#7c55d9;border-radius:5px}
.flujo-incremental__etapa:nth-child(2) .flujo-incremental__input{border-color:#303944;border-radius:50%;transform:rotate(45deg)}
.flujo-incremental__etapa:nth-child(2) .hbox{display:block}
.flujo-incremental__etapa:nth-child(2) .flujo-incremental__input{padding:28px 8px;}
.flujo-incremental__etapa:nth-child(2) .flujo-incremental__input::placeholder{transform:rotate(-45deg)}
.flujo-incremental__etapa:nth-child(3) .flujo-incremental__input{border-radius:16px}
.flujo-incremental__etapa:nth-child(4) .flujo-incremental__input{border-radius:50%;padding:28px 8px}
.flujo-incremental__etapa:nth-child(5) .flujo-incremental__input{border-color:#f0a600;border-radius:0;background:#fff9e8}
.flujo-incremental__input:focus{box-shadow:0 0 0 3px rgba(44,90,160,.2)}
.flujo-incremental__input.ok{border-color:#1a7f37;background:#e6f4ea}
.flujo-incremental__input.bad{border-color:#c0392b;background:#fdecea}
.flujo-incremental__etapa .mk{display:block;margin:4px 0 0}
.flujo-incremental__nota{margin:34px 0 0;padding:14px 20px;border:2px solid #f0a600;border-radius:12px;
                                        background:#fff9e8;color:#604410;text-align:left;line-height:1.55}
.flujo-incremental__retro{position:absolute;left:27%;top:3px;color:#4f6d8c;font-size:14px;font-style:italic}
@media(max-width:850px){
   .flujo-incremental{padding:30px 16px 20px}
   .flujo-incremental__linea{gap:16px;justify-content:space-between}
   .flujo-incremental__etapa{flex:1 1 0}
   .flujo-incremental__etapa:not(:last-child)::after{width:16px}
   .flujo-incremental__etapa:not(:last-child)::before{left:calc(100% + 7px)}
   .flujo-incremental__input{font-size:14px;padding:8px 3px}
   .flujo-incremental__etapa:nth-child(2) .flujo-incremental__input,
   .flujo-incremental__etapa:nth-child(4) .flujo-incremental__input{padding:22px 3px}
}
@media(max-width:560px){
   .flujo-incremental{overflow-x:auto}
   .flujo-incremental__linea{min-width:710px;gap:34px}
   .flujo-incremental__etapa{flex:0 0 120px}
   .flujo-incremental__retro{position:static;margin:0 0 16px;text-align:center}
   .flujo-incremental__nota{min-width:0}
}
@media(max-width:850px){
   .ruta-okr{gap:14px}
   .ruta-okr__paso{flex-basis:calc(50% - 7px);padding:26px 18px 22px}
   .ruta-okr__paso:nth-child(2)::after{display:none}
   .ruta-okr__paso h3{margin-bottom:38px;font-size:19px}
   .ruta-okr__numero{width:58px;height:58px;margin-bottom:28px;font-size:22px}
}
@media(max-width:560px){
   .ruta-okr{display:block}
   .ruta-okr__paso{margin:0 0 28px}
   .ruta-okr__paso:not(:last-child)::after{top:auto;right:50%;bottom:-27px;border-top:18px solid #706a84;
                                                                border-right:14px solid transparent;border-left:14px solid transparent;
                                                                border-bottom:0;transform:translateX(50%)}
   .ruta-okr__paso:nth-child(2)::after{display:block}
}
</style>

<div class="card">
  <h2>Conceptos de la Unidad 1</h2>
  <p>Solo huecos: aquí no hay opción múltiple. Las frases son las definiciones del
     material, con las palabras clave en blanco. Pulsa <b>Enter</b> dentro de un hueco
     o el botón de cada bloque para corregir. No importan mayúsculas ni tildes.</p>
  <p style="font-size:14px;color:#6b7684">Fuente: <i>Def Proyecto - OKRs.pdf</i> (Material del curso).</p>
</div>

<!-- ============================================================ 1 -->
<div class="card">
  <h2>1. Qué es un proyecto</h2>

  <div class="modelo-huecos">
    <div class="mh-tit">Las tres características distintivas</div>

    <p class="sub"><?php hueco(83, 11); ?> </p>
    <p>Los proyectos son <?php hueco(1, 11); ?>: tienen inicio y fin definidos. Finalizan cuando
       se alcanzan los <?php hueco(2, 12); ?>, se agotan los <?php hueco(3, 11); ?>, cambian las
       <?php hueco(4, 13); ?> o por razones legales o de cumplimiento.</p>

    <p class="sub"><?php hueco(84, 11); ?> </p>
    <p>Cada proyecto se distingue por condiciones específicas —objetivos, alcance, ubicación,
       tecnología, recursos e interesados—, es decir, cada proyecto tiene un contexto
       <?php hueco(5, 10); ?> y requiere estrategias personalizadas.</p>

    <p class="sub"><?php hueco(85, 31); ?> </p>
    <p>Los proyectos crean <?php hueco(6, 9); ?> impulsando el <?php hueco(7, 10); ?> organizacional:
       llevan a la organización del estado <?php hueco(8, 10); ?> al estado <?php hueco(9, 10); ?>
       para lograr objetivos específicos.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 2 -->
<div class="card">
  <h2>2. Proyecto frente a operación</h2>

  <div class="modelo-huecos">
    <div class="mh-tit">Lo que los separa</div>
    <p>Los proyectos son <?php hueco(10, 10); ?> y tienen la característica de la
       <?php hueco(11, 14); ?>.</p>
    <p>Las operaciones, en cambio, son continuas y <?php hueco(12, 13); ?>: es una función que
       se efectúa <?php hueco(13, 16); ?>, por lo general para proveer un servicio.</p>
    <p>Por eso los proyectos requieren <?php hueco(14, 11); ?> de proyectos, mientras que las
       operaciones requieren gestión de <?php hueco(15, 11); ?>.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 3 -->
<div class="card">
  <h2>3. Qué es la gerencia de proyectos</h2>

  <div class="modelo-huecos">
    <div class="mh-tit">La definición</div>
    <p>Es la aplicación de información, conocimientos, <?php hueco(16, 13); ?>,
       <?php hueco(17, 14); ?> y <?php hueco(18, 11); ?> a las actividades involucradas en un
       proyecto para cumplir con los <?php hueco(19, 12); ?> del mismo.</p>

    <p class="sub">Las cinco áreas de foco, en orden</p>
    <p><?php hueco(20, 10); ?> &rarr; <?php hueco(21, 13); ?> &rarr; <?php hueco(22, 11); ?>
       &rarr; <?php hueco(23, 20); ?> &rarr; <?php hueco(24, 10); ?></p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 4 -->
<div class="card">
  <h2>4. Programa y portafolio</h2>

  <div class="modelo-huecos">
    <div class="mh-tit">Dos agrupaciones que no son lo mismo</div>
    <p>Un <?php hueco(25, 12); ?> es un conjunto de proyectos que deben gerenciarse de manera
       <?php hueco(26, 12); ?> para obtener mayores <?php hueco(27, 13); ?>. Existen para
       alcanzar un objetivo <?php hueco(28, 9); ?>.</p>
    <p>Un <?php hueco(29, 12); ?> es una colección de programas, proyectos y operaciones del
       negocio, cuyo fin es demostrar el cumplimiento de la <?php hueco(30, 12); ?> o de los
       objetivos <?php hueco(31, 14); ?>.</p>
    <p>Sus componentes son <?php hueco(32, 15); ?>: pueden ser medidos,
       <?php hueco(33, 14); ?> y <?php hueco(34, 13); ?>.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 5 -->
<div class="card">
  <h2>5. Qué son los OKR</h2>

  <div class="modelo-huecos">
    <div class="mh-tit">La definición del marco</div>
    <p>«OKR» significa <?php hueco(35, 13); ?> and <?php hueco(36, 14); ?> — <?php hueco(75, 28); ?>.</p>
    <p>  <?php hueco(37, 62); ?>  , utilizado
       por equipos e individuos para establecer metas desafiantes y <?php hueco(38, 13); ?> con
       resultados <?php hueco(39, 11); ?>.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 6 -->
<div class="card">
  <h2>6. Los objetivos · el «<?php hueco(76, 5); ?>»</h2>

  <div class="modelo-huecos">
    <div class="mh-tit">Las preguntas que responde un objetivo</div>
    <p>&iquest;Cuál es mi mayor <?php hueco(40, 12); ?>? &iquest;Qué quiero
       <?php hueco(41, 10); ?>?</p>
    <p>Los objetivos son declaraciones que marcan la <?php hueco(42, 11); ?> e
       <?php hueco(43, 10); ?>, y que ayudan a establecer prioridades.</p>
    <p>Deben ser <?php hueco(44, 13); ?> en vez de frustrantes, y por ser ambiciosos se perciben
       un poco <?php hueco(45, 12); ?>.</p>
    <p>Son <?php hueco(46, 13); ?>, inspiradores y de fácil <?php hueco(47, 13); ?>.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 7 -->
<div class="card">
  <h2>7. Los resultados clave · el «<?php hueco(77, 5); ?>»</h2>

  <div class="modelo-huecos">
    <div class="mh-tit">Las preguntas que responde un resultado clave</div>
    <p>&iquest;Cómo sé hasta dónde estoy <?php hueco(48, 11); ?>? &iquest;Cómo sé que se ha
       <?php hueco(49, 12); ?>?</p>
    <p>Los resultados clave miden tu <?php hueco(50, 11); ?> hacia un objetivo.</p>

    <p class="sub">La fórmula de un Key Result</p>
    <p>Verbo en <?php hueco(51, 12); ?> &nbsp;+&nbsp; <?php hueco(52, 12); ?> &nbsp;+&nbsp;
       ahora / <?php hueco(53, 9); ?></p>

    <p class="sub">La estructura completa</p>
    <p>El <b>objetivo</b> responde &iquest;a dónde <?php hueco(54, 8); ?>? y los
       <b>resultados clave</b> responden &iquest;cómo sé que he <?php hueco(55, 12); ?> el
       objetivo?</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 8 -->
<div class="card">
  <h2>8. iniciativas ·  <?php hueco(78, 8); ?> </h2>

  <div class="modelo-huecos">
    <div class="mh-tit">&iquest;Cómo llego a la meta?</div>
    <p>Las <?php hueco(56, 12); ?> son las acciones tomadas para avanzar en los resultados clave;
       responden a la pregunta &iquest;cómo <?php hueco(57, 9); ?> a la meta?</p>
    <p>Son solo <?php hueco(58, 11); ?> sobre qué trabajo podría generar el mayor
       <?php hueco(59, 10); ?>.</p>
    <p>Sus características: son una actividad específica, <?php hueco(60, 10); ?>,
       directamente <?php hueco(61, 13); ?> y <?php hueco(62, 11); ?> de los OKR.</p>
    <p><i>«Mientras que el objetivo te dice a dónde ir, los resultados clave te dicen qué tan
       <?php hueco(63, 9); ?> estás de tu último destino… ¡los <?php hueco(64, 12); ?> te llevan
       al destino!»</i></p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 9 -->
<div class="card">
  <h2>9. El ejemplo de clase</h2>

  <div class="modelo-huecos">
    <div class="mh-tit">Objetivo, resultado clave y tarea</div>
    <p><b>Objetivo:</b> alcanzar un record de <?php hueco(65, 10); ?>.</p>
    <p><b>Resultado clave:</b> incrementar las ventas en un <?php hueco(66, 6); ?>% en el primer
       semestre.</p>
    <p><b>«Llamar a 10 clientes»</b> no es un resultado clave: es una <?php hueco(67, 12); ?>.</p>
    <p>La pregunta que lo desarma: &iquest;qué <?php hueco(68, 11); ?> o disminuye con llamar a 10
       clientes? Eso que se mueve es el resultado clave.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 10 -->
<div class="card">
  <h2>10. Por qué fallan los objetivos</h2>

  <div class="modelo-huecos">
    <div class="mh-tit">Las razones que enumera el material</div>
    <p>Porque son poco claros o <?php hueco(69, 12); ?>.</p>
    <p>Por falta de <?php hueco(70, 13); ?> con la misión, la visión y la estrategia de la
       organización.</p>
    <p>Porque son poco <?php hueco(71, 12); ?> y desmotivan al equipo.</p>
    <p>Por falta de <?php hueco(72, 11); ?>: tiempo, dinero o personal.</p>
    <p>Por falta de <?php hueco(73, 13); ?> y evaluación del progreso.</p>
    <p>Por resistencia al <?php hueco(74, 10); ?> y por falta de compromiso.</p>
  </div>
</div>

<div class="ruta-okr" aria-label="Ruta de una iniciativa alineada con la estrategia">
   <article class="ruta-okr__paso ruta-okr__paso--uno">
      <div class="ruta-okr__numero">1</div>
      <h3><?php hueco(79, 22); ?></h3>
      <p>Ej.: “Mejorar la eficiencia operativa y la experiencia de compra.”</p>
   </article>
   <article class="ruta-okr__paso ruta-okr__paso--dos">
      <div class="ruta-okr__numero">2</div>
      <h3><?php hueco(80, 18); ?></h3>
      <p>Ej.: “Reducir el tiempo de facturación en caja en 50%.”</p>
   </article>
   <article class="ruta-okr__paso ruta-okr__paso--tres">
      <div class="ruta-okr__numero">3</div>
      <h3><?php hueco(81, 22); ?></h3>
      <p>Ej.: “Implementar un sistema POS e inventario centralizado.”</p>
   </article>
   <article class="ruta-okr__paso ruta-okr__paso--cuatro">
      <div class="ruta-okr__numero">4</div>
      <h3><?php hueco(82, 17); ?></h3>
      <p>¿Vale la pena esta iniciativa? Se responde con datos.</p>
   </article>
</div>

<div class="flujo-incremental" aria-label="Flujo incremental del proyecto">
   <div class="flujo-incremental__retro">el cliente retroalimenta el diseño de la interfaz<br><i>(iteración sobre el mismo entregable)</i></div>
   <div class="flujo-incremental__linea">
      <div class="flujo-incremental__etapa"><?php hueco(86, 10); ?></div>
      <div class="flujo-incremental__etapa"><?php hueco(87, 10); ?></div>
      <div class="flujo-incremental__etapa"><?php hueco(88, 10); ?></div>
      <div class="flujo-incremental__etapa"><?php hueco(89, 10); ?></div>
      <div class="flujo-incremental__etapa"><?php hueco(90, 10); ?></div>
   </div>
   <div class="flujo-incremental__nota">Requerimientos funcionales bien definidos y línea base del alcance congelada:<br>
      <b>NO</b> hay reuniones para definir requerimientos nuevos durante estos 4 meses.<br>
      Un solo <b>incremento, entregado al final del mes 4.</b>
   </div>
</div>
<p>El texto dice "no cambiara" y Todo lo relevante para el proyecto ya está acordado desde el inicio</p>
<?php hueco(91, 10); ?>
<p>El backlog se ajusta en cada sprint según la retroalimentación del cliente piloto :</p>
<?php hueco(92, 10); ?>
<p>(8 sprints)En cada sprint.... libera al final del sprint una versión funcional y utilizable en producción para ese cliente.</p>
<?php hueco(93, 10); ?>
<p>El ciclo se repite 8 veces sobre el mismo producto que se sigue refinando sprint tras sprint (no son partes cerradas e independientes)</p>
<?php hueco(94, 10); ?>
   <p>La diferencia con el Proyecto 4 (cursos) o el 9 (ciudades), que son incremental puro,
   es esta: ahí cada parte (un curso, una ciudad) se define, se construye 
   <?php hueco(95, 12); ?>
     y
   nunca se vuelve a tocar. En el Proyecto 6, en cambio, el mismo producto se retrabaja 
   sprint a sprint — el sprint 3 puede modificar o construir sobre lo que se hizo en el 
   sprint 2, porque el backlog se re-prioriza constantemente.</p>
<?php
pie('../Grupo003/index.php', '');
