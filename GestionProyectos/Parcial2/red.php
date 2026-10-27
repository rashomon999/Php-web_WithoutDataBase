<?php
/* Dibuja un diagrama de red (actividad en el nodo) como SVG.
   $nodos   = ['A' => ['x'=>160,'y'=>125,'d'=>6], 'Inicio' => ['x'=>45,'y'=>125,'ext'=>1], ...]
   $aristas = [['Inicio','A'], ['A','F'], ...]                                   */
function red_svg($id, $nodos, $aristas, $w, $h, $unidad = 'sem') {
    $hw = function ($n) { return isset($n['ext']) ? 36 : 42; };
    $o  = '<svg class="red" viewBox="0 0 ' . $w . ' ' . $h . '" xmlns="http://www.w3.org/2000/svg" role="img">';
    $o .= '<defs><marker id="fl-' . $id . '" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" '
        . 'markerHeight="7" orient="auto-start-reverse"><path d="M0,0 L10,5 L0,10 z" fill="#4a5563"/></marker></defs>';
    foreach ($aristas as $a) {
        $p = $nodos[$a[0]];
        $q = $nodos[$a[1]];
        $o .= '<line x1="' . ($p['x'] + $hw($p)) . '" y1="' . $p['y'] . '" x2="' . ($q['x'] - $hw($q) - 3)
            . '" y2="' . $q['y'] . '" stroke="#4a5563" stroke-width="1.6" marker-end="url(#fl-' . $id . ')"/>';
    }
    foreach ($nodos as $nom => $n) {
        if (isset($n['ext'])) {
            $o .= '<ellipse cx="' . $n['x'] . '" cy="' . $n['y'] . '" rx="36" ry="20" fill="#1f2733"/>';
            $o .= '<text x="' . $n['x'] . '" y="' . ($n['y'] + 5) . '" text-anchor="middle" font-size="14" '
                . 'font-weight="600" fill="#fff" font-family="Segoe UI,Arial,sans-serif">' . $nom . '</text>';
        } else {
            $o .= '<rect x="' . ($n['x'] - 42) . '" y="' . ($n['y'] - 22) . '" width="84" height="44" rx="8" '
                . 'fill="#fff" stroke="#2c5aa0" stroke-width="2"/>';
            $o .= '<text x="' . $n['x'] . '" y="' . ($n['y'] - 1) . '" text-anchor="middle" font-size="17" '
                . 'font-weight="700" fill="#2c5aa0" font-family="Segoe UI,Arial,sans-serif">' . $nom . '</text>';
            $o .= '<text x="' . $n['x'] . '" y="' . ($n['y'] + 15) . '" text-anchor="middle" font-size="12" '
                . 'fill="#5a6472" font-family="Segoe UI,Arial,sans-serif">' . $n['d'] . ' ' . $unidad . '</text>';
        }
    }
    return $o . '</svg>';
}
