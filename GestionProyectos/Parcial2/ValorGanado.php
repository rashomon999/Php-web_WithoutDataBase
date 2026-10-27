<?php
/* ==========================================================================
   Parcial 2 — Valor ganado (EVM)
   Fuentes: Conceptos de Valor ganado.pdf, Ruta critica y Valor ganado.pdf
            (parte de valor ganado), Taller de Valor ganado.pdf, video de valor
            ganado (quioscos, TCPI, VAC) y los nombres de la presentacion de
            Control y seguimiento en MS Project.
   Las formulas y su lectura se preguntan SOLO aqui; ProjectControl.php
   pregunta lo propio de la herramienta.
   ========================================================================== */

$MENU = 'index.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [
    'pvac' => [
        'texto'    => 'En el mes 5 el PV del mes es $19.000 y el AC es $12.000. Alguien concluye que el proyecto va bien porque gastó menos de lo estimado. ¿Es correcto?',
        'opciones' => [
            'a' => 'Sí: gastar menos de lo planeado siempre es buena noticia',
            'b' => 'No: comparar PV con AC no tiene en cuenta el avance; hay que conocer cuánto trabajo se hizo (EV)',
            'c' => 'Sí, porque la SV es positiva',
            'd' => 'No, porque el AC siempre debe ser igual al PV',
        ],
        'correcta' => 'b',
        'porque'   => 'Si solo se mira el valor planeado frente a los costos reales, el proyecto “siempre estaría bien”. En el ejemplo, a esa fecha solo se había hecho el 30 % del trabajo cuando debía ir en 41,66 %.'
    ],
    'hab' => [
        'texto'    => 'Las habitaciones al día 5: ¿cómo va el proyecto?',
        'opciones' => [
            'a' => 'Adelantado y por debajo del presupuesto',
            'b' => 'Atrasado y sobrecosteado',
            'c' => 'Al día y en presupuesto: se gastó justo lo planeado',
            'd' => 'Atrasado pero dentro del presupuesto',
        ],
        'correcta' => 'b',
        'porque'   => 'SV y CV negativas, SPI y CPI de 0,6. Haber gastado la mitad del presupuesto no significa haber hecho la mitad del trabajo.'
    ],
    'kio' => [
        'texto'    => 'Los quioscos en la semana 4: ¿cómo va el proyecto?',
        'opciones' => [
            'a' => 'Atrasado y sobrecosteado',
            'b' => 'Adelantado y por debajo del presupuesto',
            'c' => 'Adelantado pero sobrecosteado',
            'd' => 'Atrasado pero ahorrando',
        ],
        'correcta' => 'c',
        'porque'   => 'En la semana 4 debían ir 4 quioscos y van 5 (SV = +1.000, SPI = 1,25): adelantado. Pero 5 quioscos debían costar 5.000 y costaron 6.000 (CV = −1.000, CPI = 0,83): sobrecosteado.'
    ],
];

$EMPAREJAR = [
    'lect' => [
        'texto'    => '¿Qué significa cada resultado?',
        'opciones' => ['Adelantado', 'Atrasado', 'Ahorro (bajo el presupuesto)', 'Sobrecosto', 'Según lo planeado'],
        'items'    => [
            'CV mayor que 0'           => 'Ahorro (bajo el presupuesto)',
            'CV menor que 0'           => 'Sobrecosto',
            'SV mayor que 0'           => 'Adelantado',
            'SV menor que 0'           => 'Atrasado',
            'CPI menor que 1'          => 'Sobrecosto',
            'CPI mayor que 1'          => 'Ahorro (bajo el presupuesto)',
            'SPI menor que 1'          => 'Atrasado',
            'SPI igual a 1 (SV = 0)'   => 'Según lo planeado',
        ],
        'porque'   => 'Variaciones: mayor que 0 = buena noticia, menor que 0 = mala. Índices: mayor que 1 = buena, menor que 1 = mala. En costo la buena noticia es ahorro y la mala sobrecosto; en tiempo, adelanto y atraso.'
    ],
    'eac' => [
        'texto'    => 'Las cuatro formas de pronosticar el EAC: ¿qué supone cada una?',
        'opciones' => [
            'Lo que falta se gasta con la misma eficiencia de hoy (la más usada)',
            'Lo que falta costará lo presupuestado originalmente',
            'Los retrasos del cronograma también encarecerán lo que falta',
            'El equipo reestima lo que falta: más precisa, pero más lenta y costosa',
        ],
        'items'    => [
            'EAC = BAC ÷ CPI'                          => 'Lo que falta se gasta con la misma eficiencia de hoy (la más usada)',
            'EAC = AC + (BAC − EV)'                    => 'Lo que falta costará lo presupuestado originalmente',
            'EAC = AC + (BAC − EV) ÷ (CPI × SPI)'      => 'Los retrasos del cronograma también encarecerán lo que falta',
            'EAC = AC + nueva estimación de lo que falta' => 'El equipo reestima lo que falta: más precisa, pero más lenta y costosa',
        ],
        'porque'   => 'Si el enunciado no dice otra cosa, en los ejercicios se usa <span class="formula">EAC = BAC / CPI</span>. Es lo mismo que <span class="formula">AC + (BAC − EV) / CPI</span>.'
    ],
];

$SOLUCIONES = [
/* ---- 1. Que es ---- */
 101 => ['completo'],
 102 => ['alcance'],
 103 => ['costo', 'costos'],
 104 => ['tiempo', 'cronograma'],
 105 => ['paquete de trabajo', 'paquete'],

/* ---- 2. Significado de PV, AC, EV, BAC y EAC ---- */
 202 => ['debería', 'deberia'],
 204 => ['gastado'],
 206 => ['costado'],
 207 => ['gestión', 'gestion'],
 208 => ['BAC', 'budget at completion'],
 209 => ['presupuesto'],
 210 => ['estado', 'corte'],
 211 => ['BAC x % planeado', 'programado', 'planificado'],
 212 => ['BAC x % real', 'completado', 'avance real'],
 213 => ['S', 'ese'],
 214 => ['recta'],
 215 => ['valor planeado', 'valor planificado', 'valor programado'],
 216 => ['costo real', 'costo actual'],
 217 => ['valor ganado', 'valor logrado'],
 218 => ['presupuesto a la terminacion', 'presupuesto hasta la terminacion', 'presupuesto al finalizar', 'presupuesto total'],
 219 => ['estimacion a la conclusion', 'estimacion al finalizar', 'costo estimado al finalizar', 'estimado hasta la conclusion'],

/* ---- 3. Variaciones e indices ---- */
 301 => ['EV - AC', 'EV − AC'],
 302 => ['EV - PV', 'EV − PV'],
 303 => ['EV / AC'],
 304 => ['EV / PV'],
 305 => ['restas', 'resta'],
 306 => ['divisiones', 'division', 'cocientes'],
 307 => ['1', 'uno'],

/* ---- 4. Pronosticos ---- */
 401 => ['EAC - AC'],
 402 => ['BAC - EAC'],
 403 => ['encima', 'arriba'],
 404 => ['AC'],
 405 => ['malo', 'mala noticia', 'mala'],
 406 => ['estimado hasta la conclusion'],
 407 => ['variacion a la conclusion'],
 408 => ['indice de desempeno para completar'],

/* ---- 5. Equivalencias de las siglas ---- */
 501 => ['BCWS', 'Budgeted Cost of Work Scheduled'],
 502 => ['CPTP', 'Costo Presupuestado del Trabajo Programado'],
 503 => ['ACWP', 'Actual Cost of Work Performed'],
 504 => ['CRTR', 'Costo Real del Trabajo Realizado'],
 505 => ['BCWP', 'Budgeted Cost of Work Performed'],
 506 => ['CPTR', 'Costo Presupuestado del Trabajo Realizado'],
 507 => ['costo de linea base'],
 508 => ['CPF', 'costo previsto para completarse'],

/* ---- 6. Habitaciones ---- */
 601 => '1.000', 602 => '600', 603 => '1.000',
 604 => '-400',  605 => '-400', 606 => '0,6', 607 => '0,6',

/* ---- 7. Quioscos ---- */
 701 => '4.000', 702 => '5.000', 703 => '6.000',
 704 => '-1.000', 705 => '1.000', 706 => '0,83', 707 => '1,25',
 708 => ['12.000', '12.048,19'],
 709 => ['-2.000', '-2.048,19'],
 710 => ['6.000', '6.048,19'],
 711 => '1,25',

/* ---- 8. Proyecto de 200.000 ---- */
 801 => '60.000', 802 => '2.000', 803 => '1,03', 804 => '-30.000', 805 => ['0,67', '0,66'],
 811 => '198.000',                          812 => '140.000',
 813 => ['193.333,33', '194.174,76'],       814 => ['135.333,33', '136.174,76'],
 815 => ['261.000', '263.943', '260.869,2'], 816 => ['203.000', '205.943', '202.869,2'],
 817 => '222.000',                          818 => '164.000',

/* ---- 9. Las 4 paredes ---- */
 901 => '4.000', 902 => '3.000', 903 => '2.500', 904 => '2.800',
 905 => '0,89',  906 => ['4.480', '4.494,38'], 907 => ['1.680', '1.694,38'],

/* ---- 10. Taller (fila = BAC, AC, PV, EV, CV, CPI, SV, SPI, EAC, ETC) ---- */
 1101 => '500.000', 1102 => '310.000', 1103 => '300.000', 1104 => '250.000', 1105 => '-60.000',
 1106 => '0,81', 1107 => '-50.000', 1108 => '0,83',
 1109 => ['620.000', '617.283,95'], 1110 => ['310.000', '307.283,95'],

 1201 => '930.000', 1202 => '406.000', 1203 => '345.428,57', 1204 => '434.000', 1205 => '28.000',
 1206 => '1,07', 1207 => '88.571,43', 1208 => '1,26',
 1209 => ['870.000', '869.158,88'], 1210 => ['464.000', '463.158,88'],

 1301 => '100.000', 1302 => '35.000', 1303 => '40.000', 1304 => '33.333,33', 1305 => '-1.666,67',
 1306 => '0,95', 1307 => '-6.666,67', 1308 => '0,83',
 1309 => ['105.000', '105.263,16'], 1310 => ['70.000', '70.263,16'],

 1401 => '150.000', 1402 => '70.000', 1403 => '75.000', 1404 => '75.000', 1405 => '5.000',
 1406 => '1,07', 1407 => '0', 1408 => '1',
 1409 => ['140.000', '140.186,92'], 1410 => ['70.000', '70.186,92'],
];

iniciar($MULTIPLE, $EMPAREJAR, $SOLUCIONES);
cabecera('Parcial 2 · Valor ganado', 'Earned Value Management: medir, leer y pronosticar');

/* fila de huecos: etiqueta + numeros */
$fila = function ($etq, $nums, $size = 9) {
    echo '<tr><td class="l"><b>' . $etq . '</b></td>';
    foreach ($nums as $n) { echo '<td>'; hueco($n, $size); echo '</td>'; }
    echo '</tr>';
};
?>
<link rel="stylesheet" href="p2.css?v=<?= filemtime(__DIR__ . "/p2.css") ?>">

<div class="card">
  <h2>Valor ganado</h2>
  <p>Las fórmulas se preguntan una vez, en los conceptos; los ejercicios son para aplicarlas.
     Los huecos numéricos aceptan <b>620.000</b>, <b>620,000</b> o <b>620000</b> y el redondeo;
     las variaciones negativas llevan <b>-</b>.</p>
  <div class="indice">
    <a href="#c1">Qué es</a><a href="#c2">Significado de siglas</a><a href="#c3">Variaciones e índices</a>
    <a href="#c4">Pronósticos</a><a href="#c5">Nombres en Project</a>
    <a href="#c6">Habitaciones</a><a href="#c7">Quioscos</a><a href="#c8">US$200.000</a>
    <a href="#c9">4 paredes</a><a href="#c10">Taller</a>
  </div>
</div>

<div class="parte-tit">Conceptos</div>

<!-- ============================================================ 1 -->
<div class="card" id="c1">
  <h2>1. Qué es el análisis de valor ganado</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">La definición</div>
    <p>Es el método más <?php hueco(101, 10); ?> de medida del desempeño: integra medidas de
       <?php hueco(102, 9); ?>, <?php hueco(103, 8); ?> y <?php hueco(104, 9); ?> para evaluar el
       desempeño del proyecto frente a sus líneas base.</p>
    <p>Desarrolla y monitorea tres dimensiones (PV, AC y EV) para cada
       <?php hueco(105, 17); ?>.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 2 -->
<div class="card" id="c2">
  <h2>2. Significado de las siglas: PV, AC, EV, BAC y EAC</h2>
  <div class="tp-wrap"><table class="tp">
    <tr><th>Sigla</th><th>Significado</th><th class="l">La pregunta que responde</th></tr>
    <tr><td><b>PV</b></td><td><?php hueco(215, 25); ?></td>
        <td class="l">¿Cuánto me <?php hueco(202, 9); ?> haber gastado a la fecha?</td></tr>
    <tr><td><b>AC</b></td><td><?php hueco(216, 25); ?></td>
        <td class="l">¿Cuánto me he <?php hueco(204, 9); ?> a la fecha?</td></tr>
    <tr><td><b>EV</b></td><td><?php hueco(217, 25); ?></td>
        <td class="l">Lo que he hecho, ¿cuánto me debería haber <?php hueco(206, 9); ?>?</td></tr>
    <tr><td><b>BAC</b></td><td><?php hueco(218, 25); ?></td>
        <td class="l">¿Cuál es el presupuesto total autorizado del proyecto?</td></tr>
    <tr><td><b>EAC</b></td><td><?php hueco(219, 25); ?></td>
        <td class="l">¿Cuánto se estima que costará el proyecto al terminar?</td></tr>
  </table></div>
  <div class="modelo-huecos">
    <div class="mh-tit">Lo que hay que saber de cada uno</div>
    <p>El PV es el presupuesto autorizado asignado al trabajo que debe ejecutarse. No incluye la
       reserva de <?php hueco(207, 9); ?>, y su total es el <?php hueco(208, 6); ?> (presupuesto a
       la terminación: la suma de todos los presupuestos del proyecto).</p>
    <p>El EV se expresa en términos del <?php hueco(209, 12); ?> autorizado para ese trabajo, no de
       lo que costó.</p>
    <p>La fecha de <?php hueco(210, 8); ?> es el punto en el tiempo en el que se hace el análisis.</p>
    <p><span class="formula">PV =   <?php hueco(211, 15); ?></span> a la fecha &nbsp;·&nbsp;
       <span class="formula">EV =   <?php hueco(212, 15); ?> completado</span></p>
    <p>El costo acumulado planeado contra el tiempo suele tener forma de curva
       <?php hueco(213, 3); ?>; si se gasta lo mismo en tiempos iguales, es una línea
       <?php hueco(214, 7); ?>.</p>
  </div>
  <?php mc('pvac'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 3 -->
<div class="card" id="c3">
  <h2>3. Variaciones e índices</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">El EV siempre va primero</div>
    <p><span class="formula">CV = <?php hueco(301, 14); ?></span> &nbsp;
       <span class="formula">SV = <?php hueco(302, 14); ?></span></p>
    <p><span class="formula">CPI = <?php hueco(303, 14); ?></span> &nbsp;
       <span class="formula">SPI = <?php hueco(304, 14); ?></span></p>
    <p>Las variaciones son <?php hueco(305, 9); ?> y se comparan con 0; los índices son
       <?php hueco(306, 10); ?> y se comparan con <?php hueco(307, 3); ?>.</p>
  </div>
  <?php empareja('lect'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 4 -->
<div class="card" id="c4">
  <h2>4. Pronósticos: EAC, ETC, VAC y TCPI</h2>
  <?php empareja('eac'); ?>
  <div class="modelo-huecos">
    <div class="mh-tit">Lo que sale del EAC</div>
    <p><b>ETC</b> (<?php hueco(406, 30); ?>, cuánta plata falta):
       <span class="formula">ETC =   <?php hueco(401, 8); ?></span></p>
    <p><b>VAC</b> (<?php hueco(407, 30); ?>):
    (¿cuánto me voy a pasar o ahorrar al terminar?)
       <span class="formula">VAC = <?php hueco(402, 8); ?></span>. Si es negativa, el proyecto
       va a terminar por <?php hueco(403, 8); ?> del presupuesto.</p>
    <p><b>TCPI</b> (<?php hueco(408, 34); ?>): el costo presupuestado del trabajo que falta
       dividido entre la plata que queda,
       <span class="formula">TCPI = (BAC − EV) ÷ (BAC − <?php hueco(404, 4); ?>)</span>. Si es mayor
       que 1 es <?php hueco(405, 7); ?>: cada peso que queda tiene que rendir más de un peso.</p>
  </div>
  <p class="nota">La diapositiva de MS Project escribe <span class="formula">VAC = BAC − AC</span>;
     la fórmula del material de clase y del video es <span class="formula">VAC = BAC − EAC</span>.</p>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 5 -->
<div class="card" id="c5">
  <h2>5. Equivalencias entre siglas</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">¿A qué equivalen estas siglas?</div>
    <div class="tp-wrap"><table class="tp">
      <tr><th>Sigla</th><th>Equivalencias</th></tr>
      <tr><td><b>PV</b></td><td><?php hueco(501, 18); ?>, <?php hueco(502, 18); ?></td></tr>
      <tr><td><b>AC</b></td><td><?php hueco(503, 18); ?>, <?php hueco(504, 18); ?></td></tr>
      <tr><td><b>EV</b></td><td><?php hueco(505, 18); ?>, <?php hueco(506, 18); ?></td></tr>
      <tr><td><b>BAC</b></td><td><?php hueco(507, 18); ?>, <?php hueco(508, 8); ?></td></tr>
    </table></div>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<div class="parte-tit">Ejercicios</div>

<!-- ============================================================ 6 -->
<div class="card" id="c6">
  <h2>6. Las diez habitaciones</h2>
  <div class="datos">Hay que pintar <b>10 habitaciones</b> similares en <b>10 días</b> (una por día)
     con un presupuesto de <b>US$2.000</b>: US$200 por habitación. Al final del <b>día 5</b> se
     han gastado <b>US$1.000</b> y solo se han pintado <b>3 habitaciones</b>.</div>
  <div class="tp-wrap"><table class="tp">
    <tr><th>PV</th><th>EV</th><th>AC</th><th>SV</th><th>CV</th><th>SPI</th><th>CPI</th></tr>
    <tr><?php foreach ([601,602,603,604,605,606,607] as $n) { echo '<td>'; hueco($n, 7); echo '</td>'; } ?></tr>
  </table></div>
  <?php mc('hab'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 7 -->
<div class="card" id="c7">
  <h2>7. Los diez quioscos (video)</h2>
  <div class="datos">Hay que construir <b>10 quioscos</b>; cada uno tarda <b>una semana</b> y cuesta
     <b>$1.000</b> (un solo equipo, uno tras otro). En la <b>semana 4</b> se han gastado
     <b>$6.000</b> y hay <b>5 quioscos</b> construidos.</div>
  <div class="tp-wrap"><table class="tp">
    <tr><th>PV</th><th>EV</th><th>AC</th><th>CV</th><th>SV</th><th>CPI</th></tr>
    <tr><?php foreach ([701,702,703,704,705,706] as $n) { echo '<td>'; hueco($n, 7); echo '</td>'; } ?></tr>
    <tr><th>SPI</th><th>EAC</th><th>VAC</th><th>ETC</th><th>TCPI</th><th></th></tr>
    <tr><?php foreach ([707,708,709,710,711] as $n) { echo '<td>'; hueco($n, 7); echo '</td>'; } ?><td></td></tr>
  </table></div>
  <?php mc('kio'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 8 -->
<div class="card" id="c8">
  <h2>8. El proyecto de US$200.000</h2>
  <div class="datos">Presupuesto total (BAC) <b>US$200.000</b>, plazo <b>12 meses</b>. Al final del
     <b>mes 5</b> el valor planeado acumulado es <b>90.000</b> (41,66 %), se ha realizado el
     <b>30 %</b> del trabajo y el gasto acumulado es <b>58.000</b>.</div>
  <div class="tp-wrap"><table class="tp">
    <tr><th>EV</th><th>CV</th><th>CPI</th><th>SV</th><th>SPI</th></tr>
    <tr><?php foreach ([801,802,803,804,805] as $n) { echo '<td>'; hueco($n, 8); echo '</td>'; } ?></tr>
  </table></div>
  <p>Ahora los cuatro pronósticos. En el último, el equipo reestimó los meses 6 a 12 y el
     acumulado al mes 12 le dio <b>222.000</b>.</p>
  <div class="tp-wrap"><table class="tp">
    <tr><th class="l">Supuesto</th><th>EAC</th><th>ETC</th></tr>
    <?php
    $fila('Según el presupuesto original', [811, 812], 11);
    $fila('Según el CPI actual',           [813, 814], 11);
    $fila('Considerando CPI y SPI',        [815, 816], 11);
    $fila('Con una nueva estimación',      [817, 818], 11);
    ?>
  </table></div>
  <p class="nota">Fíjate cómo cambia el pronóstico: con el presupuesto original sale por debajo de
     200.000, pero al meter el SPI salta a unos 261.000 porque el retraso también cuesta.</p>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 9 -->
<div class="card" id="c9">
  <h2>9. Las cuatro paredes</h2>
  <div class="datos">Un cuarto de <b>4 paredes</b> que se pintan en secuencia; cada pared se
     presupuesta en <b>1.000</b> y <b>un día</b>. Al final del <b>tercer día</b>:<br>
     Pared 1: 100 % · gastado 1.000 &nbsp;|&nbsp; Pared 2: 100 % · gastado 1.200 &nbsp;|&nbsp;
     Pared 3: 50 % · gastado 600 &nbsp;|&nbsp; Pared 4: 0 %</div>
  <div class="tp-wrap"><table class="tp">
    <tr><th>BAC</th><th>PV</th><th>EV</th><th>AC</th><th>CPI</th><th>EAC</th><th>ETC</th></tr>
    <tr><?php foreach ([901,902,903,904,905,906,907] as $n) { echo '<td>'; hueco($n, 7); echo '</td>'; } ?></tr>
  </table></div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 10 -->
<div class="card" id="c10">
  <h2>10. Taller de valor ganado</h2>
  <p>Cálculos con dos decimales. El EAC y el ETC se aceptan con el CPI exacto o con el CPI ya
     redondeado (por eso hay dos respuestas posibles).</p>
  <div class="datos"><b>1.</b> 10 oficinas idénticas a $50.000 cada una, en 20 meses. Llevas
     12 meses, has completado 5 oficinas y gastado $310.000.</div>
  <div class="datos"><b>2.</b> 15 km de carretera con presupuesto de $930.000 en 35 semanas.
     Llevas 13 semanas y se han construido 7 km a $58.000 por kilómetro.</div>
  <div class="datos"><b>3.</b> 6 oficinas idénticas por $100.000 en 5 semanas. Al final de la
     segunda semana has gastado $17.500 por oficina, has terminado 2 y vas a empezar la tercera.</div>
  <div class="datos"><b>4.</b> Una aplicación de software de 1 año, presupuestada en $12.500 por mes.
     A los seis meses está al 50 % y has gastado $70.000.</div>
  <div class="tp-wrap"><table class="tp">
    <tr><th class="l"></th><th>Ejercicio 1</th><th>Ejercicio 2</th><th>Ejercicio 3</th><th>Ejercicio 4</th></tr>
    <?php
    $et = ['BAC', 'AC', 'PV', 'EV', 'CV', 'CPI', 'SV', 'SPI', 'EAC', 'ETC'];
    foreach ($et as $j => $e) {
        $fila($e, [1101 + $j, 1201 + $j, 1301 + $j, 1401 + $j], 10);
    }
    ?>
  </table></div>
</div>

<?php
pie('RutaCritica.php', 'ProjectPlaneacion.php');
