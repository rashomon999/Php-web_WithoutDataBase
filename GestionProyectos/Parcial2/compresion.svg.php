<?php
/* Diagrama de compresion del cronograma (redibujado de la diapositiva):
   flujo normal, fast-tracking y crashing. Sin etiquetas: van en los huecos. */
$per = function ($x, $y) {      // una persona de 26x34 con esquina sup-izq en (x,y)
    return '<use href="#cp-per" x="' . $x . '" y="' . $y . '" width="26" height="34"/>';
};
$bar = function ($x, $y, $txt, $verde) {
    $c = $verde ? '#2bb673' : '#0f2f44';
    return '<rect x="' . $x . '" y="' . $y . '" width="148" height="30" rx="2" fill="' . $c . '"/>'
         . '<text x="' . ($x + 9) . '" y="' . ($y + 21) . '" font-size="19" fill="#fff" '
         . 'font-family="Roboto,Segoe UI,Arial,sans-serif">' . $txt . '</text>';
};
$flecha = function ($x, $y1, $y2) {   // flecha verde hacia arriba, punta en y1
    return '<path d="M' . ($x - 7) . ' ' . $y2 . ' L' . ($x - 7) . ' ' . ($y1 + 16) . ' L' . ($x - 15) . ' ' . ($y1 + 16)
         . ' L' . $x . ' ' . $y1 . ' L' . ($x + 15) . ' ' . ($y1 + 16) . ' L' . ($x + 7) . ' ' . ($y1 + 16)
         . ' L' . ($x + 7) . ' ' . $y2 . ' Z" fill="#5cb87a" stroke="#1f6b3a" stroke-width="2"/>';
};
?>
<svg viewBox="0 0 500 560" xmlns="http://www.w3.org/2000/svg" role="img"
     aria-label="Tres cronogramas de tres actividades: flujo normal, fast-tracking y crashing">
  <defs>
    <symbol id="cp-per" viewBox="0 0 26 34">
      <path d="M1 34 C1 24 6 21 13 21 C20 21 25 24 25 34 Z" fill="#111"/>
      <path d="M9 21 L13 28 L17 21 Z" fill="#fff"/>
      <path d="M12 22 L14 22 L14.6 30 L13 32 L11.4 30 Z" fill="#c8102e"/>
      <circle cx="13" cy="11" r="8" fill="#f1c9a5"/>
      <path d="M5 11 C4 3 9 1 13 1 C18 1 22 3 21 11 C20 7 17 6 13 6 C9 6 6 7 5 11 Z" fill="#111"/>
    </symbol>
  </defs>

  <!-- flujo normal -->
  <?= $bar(12, 28, 'Activity 1', false) ?>  <?= $per(128, 52) ?>
  <?= $bar(160, 58, 'Activity 2', true) ?>  <?= $per(277, 82) ?>
  <?= $bar(308, 88, 'Activity 3', false) ?> <?= $per(428, 112) ?>

  <!-- fast-tracking -->
  <?= $bar(12, 195, 'Activity 1', true) ?>
  <?= $bar(127, 226, 'Activity 2', false) ?> <?= $per(98, 230) ?>
  <?= $bar(250, 257, 'Activity 3', true) ?>  <?= $per(222, 261) ?> <?= $per(366, 285) ?>

  <?= $flecha(140, 280, 352) ?>
  <?= $flecha(278, 318, 395) ?>
  <text x="182" y="340" font-size="16" font-weight="700" fill="#5b55d6" font-family="Segoe UI,Arial,sans-serif">Riesgo</text>
  <text x="182" y="360" font-size="16" font-weight="700" fill="#5b55d6" font-family="Segoe UI,Arial,sans-serif">elevado</text>

  <!-- crashing -->
  <?= $bar(12, 373, 'Activity 1', false) ?> <?= $per(96, 405) ?> <?= $per(124, 405) ?>
  <?= $bar(160, 404, 'Activity 2', true) ?>  <?= $per(216, 436) ?> <?= $per(244, 436) ?> <?= $per(272, 436) ?>
  <?= $bar(308, 434, 'Activity 3', false) ?> <?= $per(370, 466) ?> <?= $per(398, 466) ?> <?= $per(426, 466) ?>

  <text x="74" y="545" font-size="42" font-weight="700" fill="#000" font-family="Arial,sans-serif">($)</text>
  <text x="160" y="520" font-size="16" font-weight="700" fill="#5b55d6" font-family="Segoe UI,Arial,sans-serif">Costo</text>
  <text x="160" y="540" font-size="16" font-weight="700" fill="#5b55d6" font-family="Segoe UI,Arial,sans-serif">elevado</text>
</svg>
