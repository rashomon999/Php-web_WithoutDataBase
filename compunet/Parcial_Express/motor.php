<?php
/* ==========================================================================
   motor.php  —  Motor de cuestionarios (huecos + opcion multiple)
   Carpeta: htdocs/php_web/compunet/Express_2/

   USO EN CADA CUESTIONARIO:

       require_once __DIR__ . '/motor.php';

       $SOLUCIONES = [
           1 => 'Node.js',                       // respuesta unica
           2 => ['package.json', 'package json'] // varias aceptadas (la 1a es la "oficial")
       ];

       $MULTIPLE = [
           'm1' => [
               'texto'    => '¿Que hace express()?',
               'opciones' => ['a' => '...', 'b' => '...'],
               'correcta' => 'b',
               'porque'   => 'Explicacion corta que aparece al verificar.'
           ]
       ];

       iniciar($SOLUCIONES, $MULTIPLE);
       cabecera('Titulo', 'Subtitulo');
          ... html ... hueco(1, 10) ... chk(1) ... mc('m1') ...
       pie('anterior.php', 'siguiente.php');

   La comparacion de los huecos ignora mayusculas/minusculas, espacios
   repetidos y espacios al inicio/final.
   ========================================================================== */

$SOL      = [];   // soluciones de los huecos
$MC       = [];   // preguntas de opcion multiple
$RETOS    = [];   // retos: escribir un bloque entero de memoria
$RESP     = [];   // lo que escribio el usuario en cada hueco
$VERIF    = [];   // 'correcto' | 'incorrecto' | ''
$MCRESP   = [];   // opcion marcada en cada pregunta de opcion multiple
$MCVERIF  = [];   // 'correcto' | 'incorrecto' | ''
$RTRESP   = [];   // texto escrito en cada reto
$RTINFO   = [];   // ['estado'=>..., 'ok'=>n, 'total'=>n, 'falla'=>linea]
$VER_SOL  = false;


/* ---------- normalizacion: para que "  Node.JS " == "node.js" ---------- */
function _norm($t) {
    $t = (string) $t;
    $t = str_replace("\xC2\xA0", ' ', $t);                                  // espacio duro
    $t = str_replace(['“', '”', '‘', '’'], ['"', '"', "'", "'"], $t);       // comillas tipograficas
    $t = preg_replace('/\s+/u', ' ', $t);
    $t = trim($t);
    return function_exists('mb_strtolower') ? mb_strtolower($t, 'UTF-8') : strtolower($t);
}

/* ---------- normalizacion "de codigo": mas tolerante todavia.
   Se usa como SEGUNDA oportunidad al comparar, sobre todo para las
   preguntas de linea completa. Unifica comillas, quita los espacios
   alrededor de la puntuacion y hace opcional el punto y coma final,
   de modo que estas dos se consideran iguales:

       app.use( express.json() ) ;
       app.use(express.json())
   ---------------------------------------------------------------- */
function _normcod($t) {
    $t = _norm($t);

    /* El texto de los mensajes es arbitrario y no hay por que memorizarlo:
       cualquier literal entrecomillado que contenga un espacio se vacia antes
       de comparar. Los literales SIN espacios (rutas como "/api/recipe",
       cabeceras como "x-api-key", nombres de modelo como "Recipe") si cuentan,
       porque esos si son parte de la estructura. */
    $t = preg_replace('/([\'"`])((?:(?!\1).)*\s(?:(?!\1).)*)\1/u', '$1$1', $t);

    $t = str_replace('"', "'", $t);
    $t = preg_replace('/\s*([(),;:{}\[\]<>])\s*/', '$1', $t);
    $t = preg_replace('/\s*=>\s*/', '=>', $t);
    $t = preg_replace('/\s*=\s*/', '=', $t);
    $t = preg_replace('/\s*\|\s*/', '|', $t);
    $t = preg_replace('/\s*\.\s*/', '.', $t);
    $t = rtrim($t, ';');
    return trim($t);
}


/* ---------- trocea un bloque de codigo en lineas comparables ---------- */
function _lineas($t) {
    $out = [];
    foreach (preg_split('/\r\n|\r|\n/', (string) $t) as $l) {
        $crudo = trim($l);
        if (strpos($crudo, '//') === 0) continue;   // comentario de linea entera
        $l = _normcod($l);
        if ($l !== '') $out[] = $l;
    }
    return $out;
}


/* ---------- arranque: lee el POST y verifica todo ---------- */
function iniciar($soluciones, $mc = [], $retos = []) {
    global $SOL, $MC, $RETOS, $RESP, $VERIF, $MCRESP, $MCVERIF,
           $RTRESP, $RTINFO, $VER_SOL;

    $SOL     = $soluciones;
    $MC      = $mc;
    $RETOS   = $retos;
    $VER_SOL = isset($_POST['mostrar_solucion']);

    foreach ($SOL as $n => $ok) {
        $acepta   = is_array($ok) ? $ok : [$ok];
        $oficial  = $acepta[0];

        if ($VER_SOL) {
            $RESP[$n]  = $oficial;
            $VERIF[$n] = 'correcto';
            continue;
        }

        $r        = isset($_POST["respuesta_$n"]) ? $_POST["respuesta_$n"] : '';
        $RESP[$n] = $r;

        if (_norm($r) === '') {
            $VERIF[$n] = '';
            continue;
        }

        $VERIF[$n] = 'incorrecto';
        foreach ($acepta as $a) {
            if (_norm($r) === _norm($a) || _normcod($r) === _normcod($a)) {
                $VERIF[$n] = 'correcto';
                break;
            }
        }
    }

    foreach ($MC as $id => $p) {
        if ($VER_SOL) {
            $MCRESP[$id]  = $p['correcta'];
            $MCVERIF[$id] = 'correcto';
            continue;
        }

        $r           = isset($_POST["mc_$id"]) ? $_POST["mc_$id"] : '';
        $MCRESP[$id] = $r;

        if ($r === '')                    $MCVERIF[$id] = '';
        elseif ($r === $p['correcta'])    $MCVERIF[$id] = 'correcto';
        else                              $MCVERIF[$id] = 'incorrecto';
    }

    /* --- retos: se compara linea a linea, ignorando vacias y formato --- */
    foreach ($RETOS as $id => $r) {
        $txt = $VER_SOL
             ? $r['codigo']
             : (isset($_POST["reto_$id"]) ? $_POST["reto_$id"] : '');
        $RTRESP[$id] = $txt;

        $esperadas = _lineas($r['codigo']);
        $dadas     = _lineas($txt);
        $total     = count($esperadas);

        if (count($dadas) === 0) {
            $RTINFO[$id] = ['estado' => '', 'ok' => 0, 'total' => $total, 'falla' => 0];
            continue;
        }

        $ok = 0; $falla = 0;
        for ($i = 0; $i < $total; $i++) {
            if (isset($dadas[$i]) && $dadas[$i] === $esperadas[$i]) {
                $ok++;
            } elseif ($falla === 0) {
                $falla = $i + 1;
            }
        }
        $perfecto = ($ok === $total && count($dadas) === $total);
        if (!$perfecto && $falla === 0) $falla = $total + 1;   // le sobran lineas

        $RTINFO[$id] = [
            'estado' => $perfecto ? 'correcto' : 'incorrecto',
            'ok'     => $ok,
            'total'  => $total,
            'falla'  => $falla,
            'sobran' => max(0, count($dadas) - $total),
        ];
    }
}


/* ---------- un hueco (input de texto) ---------- */
function hueco($n, $size = 12) {
    global $RESP, $VERIF;

    $v   = isset($RESP[$n])  ? htmlspecialchars($RESP[$n], ENT_QUOTES, 'UTF-8') : '';
    $c   = isset($VERIF[$n]) ? $VERIF[$n] : '';
    $cls = ($c === 'correcto') ? 'ok' : (($c === 'incorrecto') ? 'bad' : '');

    echo '<span class="hbox">';
    echo '<input type="text" class="hueco ' . $cls . '"'
       . ' name="respuesta_' . $n . '" id="respuesta_' . $n . '"'
       . ' value="' . $v . '" size="' . $size . '"'
       . ' title="hueco ' . $n . '" autocomplete="off" spellcheck="false">';
    if     ($c === 'correcto')   echo '<span class="mk ok">&#10004;</span>';
    elseif ($c === 'incorrecto') echo '<span class="mk bad">&#10008;</span>';
    echo '</span>';
}


/* ---------- una FIRMA de metodo dentro de un bloque de codigo ---------
   Igual que hueco(), pero ancho y con otro color: se usa para tapar la
   linea de la firma completa (visibilidad, async, parametros con sus
   tipos y tipo de retorno), que es lo que uno cree que sabe y no sabe.
   ---------------------------------------------------------------------- */
function firma($n, $size = 60) {
    global $RESP, $VERIF;

    $v   = isset($RESP[$n])  ? htmlspecialchars($RESP[$n], ENT_QUOTES, 'UTF-8') : '';
    $c   = isset($VERIF[$n]) ? $VERIF[$n] : '';
    $cls = ($c === 'correcto') ? 'ok' : (($c === 'incorrecto') ? 'bad' : '');

    echo '<span class="hbox">';
    echo '<input type="text" class="hueco firma ' . $cls . '"'
       . ' name="respuesta_' . $n . '" id="respuesta_' . $n . '"'
       . ' value="' . $v . '" size="' . $size . '"'
       . ' title="firma ' . $n . '" placeholder="firma completa del metodo"'
       . ' autocomplete="off" spellcheck="false">';
    if     ($c === 'correcto')   echo '<span class="mk ok">&#10004;</span>';
    elseif ($c === 'incorrecto') echo '<span class="mk bad">&#10008;</span>';
    echo '</span>';
}


/* ---------- mostrar la solucion de un hueco concreto (uso opcional) ---------- */
function sol($n) {
    global $SOL;
    if (!isset($SOL[$n])) return;
    $ok = is_array($SOL[$n]) ? $SOL[$n][0] : $SOL[$n];
    echo '<span class="sol">' . htmlspecialchars($ok, ENT_QUOTES, 'UTF-8') . '</span>';
}


/* ---------- marca de verificacion suelta ---------- */
function chk($n) {
    global $VERIF;
    $c = isset($VERIF[$n]) ? $VERIF[$n] : '';
    if     ($c === 'correcto')   echo '<span class="mk ok">&#10004;</span>';
    elseif ($c === 'incorrecto') echo '<span class="mk bad">&#10008;</span>';
}


/* ---------- una LINEA COMPLETA de codigo -----------------------------
   Igual que hueco(), pero a lo ancho: para pedir la linea entera de
   memoria en vez de una sola palabra.
   -------------------------------------------------------------------- */
function linea($n, $pista = '') {
    global $RESP, $VERIF, $SOL;

    $v   = isset($RESP[$n])  ? htmlspecialchars($RESP[$n], ENT_QUOTES, 'UTF-8') : '';
    $c   = isset($VERIF[$n]) ? $VERIF[$n] : '';
    $cls = ($c === 'correcto') ? 'ok' : (($c === 'incorrecto') ? 'bad' : '');

    echo '<div class="lineabox">';
    if ($pista !== '') echo '<div class="pista">' . $pista . '</div>';
    echo '<div class="lineain">';
    echo '<input type="text" class="hueco linea ' . $cls . '"'
       . ' name="respuesta_' . $n . '" id="respuesta_' . $n . '"'
       . ' value="' . $v . '" autocomplete="off" spellcheck="false"'
       . ' placeholder="escribe la linea completa...">';
    if     ($c === 'correcto')   echo '<span class="mk ok">&#10004;</span>';
    elseif ($c === 'incorrecto') echo '<span class="mk bad">&#10008;</span>';
    echo '</div>';

    /* si fallaste, se enseña la linea correcta debajo */
    if ($c === 'incorrecto' && isset($SOL[$n])) {
        $ok = is_array($SOL[$n]) ? $SOL[$n][0] : $SOL[$n];
        echo '<div class="corregida">' . htmlspecialchars($ok, ENT_QUOTES, 'UTF-8') . '</div>';
    }
    echo '</div>';
}


/* ---------- reparto de la respuesta correcta -----------------------
   Si escribes las opciones siempre en el mismo orden, la correcta acaba
   cayendo casi siempre en la misma letra y se aprende el patron en vez
   del contenido. Aqui las opciones se ROTAN de forma determinista para
   que la correcta caiga en una posicion distinta en cada pregunta,
   siguiendo el patron C, A, D, B, B, D, A, C (dos veces cada letra).

   Es determinista: en cada envio del formulario sale el mismo orden,
   asi que lo que marcaste sigue marcado. El value del radio es siempre
   la clave original, por lo que la verificacion no se ve afectada.
   ------------------------------------------------------------------- */
$MC_CONTADOR = 0;
$MC_PATRON   = [2, 0, 3, 1, 1, 3, 0, 2];

function _orden_opciones($p) {
    global $MC_CONTADOR, $MC_PATRON;

    $keys = array_keys($p['opciones']);
    $n    = count($keys);

    /* cada cuestionario arranca el patron en un punto distinto, para que
       la primera pregunta de todas las paginas no sea siempre la misma letra */
    $offset = crc32(basename($_SERVER['PHP_SELF'])) % count($MC_PATRON);
    $k      = $MC_CONTADOR++ + $offset;

    $c = array_search($p['correcta'], $keys, true);
    if ($c === false || $n < 2) return $keys;

    $target = $MC_PATRON[$k % count($MC_PATRON)] % $n;
    $shift  = ($target - $c + $n) % $n;

    $out = [];
    for ($i = 0; $i < $n; $i++) $out[$i] = $keys[($i - $shift + $n) % $n];
    return $out;
}


/* ---------- una pregunta de opcion multiple ---------- */
function mc($id) {
    global $MC, $MCRESP, $MCVERIF;
    if (!isset($MC[$id])) return;

    $p   = $MC[$id];
    $r   = isset($MCRESP[$id])  ? $MCRESP[$id]  : '';
    $c   = isset($MCVERIF[$id]) ? $MCVERIF[$id] : '';
    $cls = ($c === 'correcto') ? 'ok' : (($c === 'incorrecto') ? 'bad' : '');

    echo '<div class="pregunta ' . $cls . '">';
    echo '<p class="enunciado">' . $p['texto'];
    if     ($c === 'correcto')   echo ' <span class="mk ok">&#10004;</span>';
    elseif ($c === 'incorrecto') echo ' <span class="mk bad">&#10008;</span>';
    echo '</p>';

    $orden = _orden_opciones($p);
    $i     = 0;
    foreach ($orden as $clave) {
        $texto   = $p['opciones'][$clave];
        $checked = ($r === (string) $clave) ? ' checked' : '';
        $marca   = '';
        if ($c !== '' && $clave === $p['correcta']) $marca = ' es-correcta';
        echo '<label class="opcion' . $marca . '">';
        echo '<input type="radio" name="mc_' . $id . '" value="' . $clave . '"' . $checked . '> ';
        echo '<b>' . chr(65 + $i) . ')</b> ' . $texto;
        echo '</label>';
        $i++;
    }

    if ($c !== '' && isset($p['porque'])) {
        echo '<p class="porque">&#128161; ' . $p['porque'] . '</p>';
    }
    echo '</div>';
}


/* ---------- RETO: escribir el bloque entero de memoria ----------------
   Solo se desbloquea cuando todos los huecos de ese bloque estan bien.
   Es el escalon de dificultad: ya no rellenas, escribes.
   ---------------------------------------------------------------------- */
function reto($id) {
    global $RETOS, $RTRESP, $RTINFO, $VERIF;
    if (!isset($RETOS[$id])) return;

    $r = $RETOS[$id];

    $faltan = 0;
    foreach ($r['huecos'] as $n) {
        if (!isset($VERIF[$n]) || $VERIF[$n] !== 'correcto') $faltan++;
    }

    if ($faltan > 0) {
        echo '<div class="reto cerrado">';
        echo '<b>&#128274; Reto bloqueado</b> &mdash; te ' . ($faltan === 1 ? 'falta' : 'faltan')
           . ' <b>' . $faltan . '</b> ' . ($faltan === 1 ? 'hueco' : 'huecos')
           . ' de este bloque. Cuando esten todos en verde se desbloquea el reto: '
           . 'escribir <b>' . $r['titulo'] . '</b> entero, de memoria.';
        echo '</div>';
        return;
    }

    $info   = isset($RTINFO[$id]) ? $RTINFO[$id] : ['estado'=>'','ok'=>0,'total'=>0,'falla'=>0,'sobran'=>0];
    $txt    = isset($RTRESP[$id]) ? $RTRESP[$id] : '';
    $estado = $info['estado'];
    $cls    = ($estado === 'correcto') ? 'ok' : (($estado === 'incorrecto') ? 'bad' : '');
    $filas  = max(6, $info['total'] + 2);

    echo '<div class="reto abierto ' . $cls . '">';
    echo '<div class="retocab">';
    echo '<b>&#127919; Reto desbloqueado</b> &mdash; ahora escribe <b>' . $r['titulo'] . '</b> entero, sin mirar.';
    echo '<button type="button" class="btn-mini" onclick="ocultarCodigo(this)">Ocultar el codigo de arriba</button>';
    echo '</div>';

    echo '<textarea name="reto_' . $id . '" class="retotxt ' . $cls . '" rows="' . $filas . '"'
       . ' spellcheck="false" placeholder="escribe aqui el bloque completo, linea a linea...">'
       . htmlspecialchars($txt, ENT_QUOTES, 'UTF-8') . '</textarea>';

    if ($estado === 'correcto') {
        echo '<p class="retoinfo ok">&#10004; Perfecto: las ' . $info['total'] . ' lineas coinciden.</p>';
    } elseif ($estado === 'incorrecto') {
        echo '<p class="retoinfo bad">&#10008; ' . $info['ok'] . ' de ' . $info['total'] . ' lineas correctas. '
           . 'La primera diferencia esta en la <b>linea ' . $info['falla'] . '</b>'
           . ($info['sobran'] > 0 ? ' (y te sobran ' . $info['sobran'] . ' lineas)' : '')
           . '. Se ignoran lineas en blanco, espacios, comillas, el punto y coma final y el '
           . 'texto de los mensajes.</p>';
    } else {
        echo '<p class="retoinfo">Se compara linea a linea. Se ignoran las lineas en blanco, '
           . 'los espacios, el tipo de comillas, el punto y coma final y <b>el texto que va '
           . 'dentro de los mensajes</b> (eso es arbitrario, no hay que memorizarlo).</p>';
    }
    echo '</div>';
}


/* ---------- contador de retos ---------- */
function _puntaje_retos() {
    global $RTINFO;
    $ok = 0;
    foreach ($RTINFO as $i) if ($i['estado'] === 'correcto') $ok++;
    return [$ok, count($RTINFO)];
}


/* ---------- botones de enviar ---------- */
function enviar($etiqueta = 'Verificar esta parte') {
    echo '<div class="acciones"><button type="submit" class="btn-ok">' . $etiqueta . '</button></div>';
}


/* ---------- contador de aciertos ---------- */
function _puntaje() {
    global $VERIF, $MCVERIF;
    $ok = 0; $mal = 0; $vacio = 0;
    foreach (array_merge(array_values($VERIF), array_values($MCVERIF)) as $v) {
        if     ($v === 'correcto')   $ok++;
        elseif ($v === 'incorrecto') $mal++;
        else                         $vacio++;
    }
    return [$ok, $mal, $vacio, $ok + $mal + $vacio];
}


/* ---------- cabecera de pagina ---------- */
function cabecera($titulo, $subtitulo = '') {
    global $VER_SOL;
    list($ok, $mal, $vacio, $total) = _puntaje();
    list($rok, $rtot) = _puntaje_retos();
    $pct = $total ? round($ok * 100 / $total) : 0;
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') ?></title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<style>
:root{
  --verde:#1a7f37; --verde-bg:#e6f4ea;
  --rojo:#c0392b;  --rojo-bg:#fdecea;
  --azul:#2c5aa0;  --gris:#f4f5f7; --borde:#d8dbe0;
}
*{box-sizing:border-box}
body{margin:0;background:var(--gris);font-family:-apple-system,Segoe UI,Arial,sans-serif;
     color:#22262b;line-height:1.65;padding-bottom:90px}

/* ---- barra superior ---- */
.topbar{position:sticky;top:0;z-index:50;background:#1f2733;color:#fff;
        padding:10px 18px;display:flex;flex-wrap:wrap;gap:12px;align-items:center;
        box-shadow:0 2px 8px rgba(0,0,0,.25)}
.topbar h1{font-size:17px;margin:0;font-weight:600}
.topbar .sub{font-size:13px;opacity:.75;margin:0}
.topbar .spacer{flex:1}
.score{background:#2c3746;border-radius:20px;padding:4px 14px;font-size:14px;white-space:nowrap}
.score b{color:#7ee2a8}
.score .m{color:#ff9d94}
.barra{height:6px;background:#2c3746;border-radius:4px;overflow:hidden;width:150px}
.barra i{display:block;height:100%;background:#7ee2a8}
.topbar a{color:#cfe3ff;text-decoration:none;font-size:14px}
.topbar a:hover{text-decoration:underline}

/* ---- contenido ---- */
.wrap{max-width:1080px;margin:0 auto;padding:22px 18px}
.card{background:#fff;border:1px solid var(--borde);border-radius:12px;
      padding:20px 24px;margin:0 0 22px}
.card > h2{margin:0 0 4px;font-size:21px;color:var(--azul);
           border-bottom:2px solid #eceff3;padding-bottom:10px}
.card > h3{margin:22px 0 8px;font-size:17px;color:#2f3a48}
.field-list{margin:18px 0 18px}
.field-list h3{margin:0 0 10px;font-size:27px;line-height:1.2;color:#1f2733}
.field-list ul{margin:0;padding-left:28px;list-style:disc}
.field-list li{margin:6px 0;font-size:17px;line-height:1.5;list-style:disc}
.card p{margin:10px 0}
.nota{background:#fff8e1;border-left:4px solid #f0b429;padding:10px 14px;
      border-radius:0 8px 8px 0;font-size:14.5px;margin:14px 0}
.avisoflujo{background:#eef4ff;border-left:4px solid var(--azul);padding:10px 14px;
      border-radius:0 8px 8px 0;font-size:14.5px;margin:14px 0}
code{background:#eef0f3;padding:2px 6px;border-radius:4px;
     font-family:Consolas,Menlo,monospace;font-size:.92em;color:#b02a5b}
pre{background:#1f2733;color:#e6edf3;padding:16px 18px;border-radius:10px;
    overflow-x:auto;font-family:Consolas,Menlo,monospace;font-size:14px;line-height:1.9}
pre code{background:none;color:inherit;padding:0;font-size:inherit}
.flujo{background:#11161d;color:#cfe3ff}

/* ---- huecos ---- */
.hbox{display:inline-flex;align-items:center;gap:6px;max-width:100%;white-space:nowrap;flex-wrap:wrap}
.hueco{font-family:Consolas,Menlo,monospace;font-size:13.5px;
       border:2px solid #9aa3ad;border-radius:5px;padding:1px 8px;
       background:#fffbe8;color:#1f2733;outline:none;max-width:100%;
       min-width:120px; min-height:32px}
pre .hueco{background:#fdf6d8}
.hueco:focus{border-color:var(--azul);box-shadow:0 0 0 3px rgba(44,90,160,.18)}
.hueco.ok{border-color:var(--verde);background:var(--verde-bg)}
.hueco.bad{border-color:var(--rojo);background:var(--rojo-bg)}
.hueco.firma{background:#e3edfb;border-style:dashed}
pre .hueco.firma{background:#dbe8fa}
.hueco.firma.ok{background:var(--verde-bg);border-style:solid}
.hueco.firma.bad{background:var(--rojo-bg);border-style:solid}
.hueco.firma::placeholder{color:#8a97a8;font-style:italic}
.mk{font-weight:700;margin-left:4px}
.mk.ok{color:var(--verde)}
.mk.bad{color:var(--rojo)}
.sol{font-family:Consolas,Menlo,monospace;background:var(--verde-bg);
     color:var(--verde);padding:1px 6px;border-radius:4px}

/* ---- tablas (para columnas que NO se pueden alinear con espacios,
       porque los inputs no miden lo mismo que el texto) ---- */
.tablabox{border:1px solid var(--borde);border-radius:10px;overflow:hidden;margin:16px 0}
.tabla{width:100%;border-collapse:collapse;font-size:14.5px}
.tabla th{text-align:left;background:#1f2733;color:#cfe3ff;font-weight:600;
          padding:9px 12px;font-size:12.5px;letter-spacing:.04em;text-transform:uppercase}
.tabla td{padding:9px 12px;border-top:1px solid var(--borde);vertical-align:middle}
.tabla tbody tr:nth-child(even){background:#f7f8fa}
.tabla .cod{font-family:Consolas,Menlo,monospace;font-size:13.5px}
.tabla .op{font-family:Consolas,Menlo,monospace;font-weight:700;color:#2c5aa0;white-space:nowrap}
.tabla .nowrap{white-space:nowrap}
@media(max-width:700px){
  .tabla{font-size:13px}
  .tabla th,.tabla td{padding:7px 8px}
}

/* ---- lineas completas ---- */
.lineabox{margin:0 0 16px}
.lineabox .pista{font-size:14.5px;color:#3c4654;margin:0 0 5px}
.lineabox .pista b{color:#1f2733}
.lineain{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.hueco.linea{flex:1 1 420px;width:100%;min-width:280px;font-size:13.5px;padding:8px 11px;background:#fffbe8}
.corregida{margin-top:6px;font-family:Consolas,Menlo,monospace;font-size:13px;
           background:var(--verde-bg);color:#12602a;border-left:3px solid var(--verde);
           padding:6px 10px;border-radius:0 6px 6px 0;white-space:pre-wrap;word-break:break-word}

/* ---- opcion multiple ---- */
.pregunta{border:1px solid var(--borde);border-left:4px solid #9aa3ad;
          border-radius:8px;padding:12px 16px;margin:14px 0;background:#fcfcfd}
.pregunta.ok{border-left-color:var(--verde);background:var(--verde-bg)}
.pregunta.bad{border-left-color:var(--rojo);background:var(--rojo-bg)}
.pregunta .enunciado{font-weight:600;margin:0 0 8px}
.opcion{display:block;padding:5px 8px;border-radius:6px;cursor:pointer;font-size:15px;word-break:break-word;line-height:1.5}
.opcion:hover{background:rgba(44,90,160,.07)}
.opcion.es-correcta{background:#d7f0dd;font-weight:600}
.porque{margin:10px 0 0;font-size:14px;background:#fff;border-radius:6px;
        padding:8px 12px;border:1px dashed var(--borde);word-break:break-word}

/* ---- retos ---- */
.reto{margin:18px 0 4px;border-radius:10px;padding:14px 16px;font-size:14.5px}
.reto.cerrado{background:#f1f3f6;border:1px dashed var(--borde);color:#5a636e}
.reto.abierto{background:#fff6e5;border:2px solid #f0b429}
.reto.abierto.ok{background:var(--verde-bg);border-color:var(--verde)}
.reto.abierto.bad{background:var(--rojo-bg);border-color:var(--rojo)}
.retocab{display:flex;flex-wrap:wrap;gap:10px;align-items:center;
         justify-content:space-between;margin-bottom:10px}
.btn-mini{background:#fff;border:1px solid var(--borde);border-radius:6px;
          padding:4px 12px;font-size:13px;cursor:pointer;color:#2f3a48}
.btn-mini:hover{background:#eef0f3}
.retotxt{width:100%;font-family:Consolas,Menlo,monospace;font-size:13px;line-height:1.6;
         border:2px solid #9aa3ad;border-radius:8px;padding:10px 12px;background:#fffdf6;
         resize:vertical;tab-size:4}
.retotxt:focus{outline:none;border-color:var(--azul);box-shadow:0 0 0 3px rgba(44,90,160,.18)}
.retotxt.ok{border-color:var(--verde);background:#f2fbf5}
.retotxt.bad{border-color:var(--rojo);background:#fff7f6}
.retoinfo{margin:8px 0 0;font-size:14px}
.retoinfo.ok{color:var(--verde);font-weight:600}
.retoinfo.bad{color:var(--rojo)}
.card.sin-codigo pre{display:none}

/* ---- comandos del arranque ---- */
.command-list{display:grid;gap:10px;margin-top:16px}
.command-item{display:grid;grid-template-columns:46px minmax(180px, 220px) 1fr;gap:12px;align-items:center;
             background:#f8f9fb;border:1px solid var(--borde);border-radius:8px;padding:10px 12px}
.command-number{display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;
               border-radius:50%;background:#e8eefb;color:var(--azul);font-weight:700;font-family:Consolas,Menlo,monospace}
.command-box{display:flex;align-items:center;justify-content:center}
.command-text{font-size:14px;color:#2f3a48}

/* ---- botones ---- */
.acciones{margin:18px 0 4px;display:flex;gap:10px;flex-wrap:wrap}
.btn-ok{background:var(--azul);color:#fff;border:0;border-radius:8px;
        padding:9px 20px;font-size:15px;cursor:pointer}
.btn-ok:hover{background:#24487f}
.btn-gris{background:#fff;color:#2f3a48;border:1px solid var(--borde);
          border-radius:8px;padding:9px 20px;font-size:15px;cursor:pointer;
          text-decoration:none;display:inline-block}
.btn-gris:hover{background:#eef0f3;color:#2f3a48;text-decoration:none}

/* ---- pie fijo ---- */
.pie{position:fixed;bottom:0;left:0;width:100%;background:#fff;
     border-top:1px solid var(--borde);padding:12px 18px;
     display:flex;gap:10px;justify-content:center;align-items:center;z-index:40}

@media(max-width:700px){
  .wrap{padding:14px 10px}
  .card{padding:16px 14px}
  .topbar{padding:10px 12px}
  .topbar .spacer{display:none}
  .score{white-space:normal}
  .hbox{white-space:normal}
  .hueco.linea{flex-basis:100%}
  .lineain{align-items:flex-start}
  .command-item{grid-template-columns:36px 1fr;}
  .command-text{grid-column:2}
  pre{font-size:12.5px}
  .tabla, .tabla thead, .tabla tbody, .tabla th, .tabla td, .tabla tr{display:block;width:100%}
  .tabla thead{display:none}
  .tabla tbody tr{border-top:1px solid var(--borde);padding:8px 0}
  .tabla td{border-top:none;padding:6px 10px}
  .tabla td:before{content:attr(data-label);display:block;font-size:11px;letter-spacing:.04em;text-transform:uppercase;color:#5a636e;font-weight:700;margin-bottom:4px}
}
</style>
<script>
/* tarjetas cuyo bloque de codigo esta oculto (para el reto) */
var CARDS_OCULTAS = {};

function _indiceCard(card){
    var todas = document.querySelectorAll('.card');
    for (var i = 0; i < todas.length; i++) if (todas[i] === card) return i;
    return -1;
}

function ocultarCodigo(btn){
    var card = btn.closest('.card');
    if (!card) return;
    var oculto = card.classList.toggle('sin-codigo');
    btn.textContent = oculto ? 'Mostrar el codigo de arriba' : 'Ocultar el codigo de arriba';
    var i = _indiceCard(card);
    if (i >= 0) { if (oculto) CARDS_OCULTAS[i] = true; else delete CARDS_OCULTAS[i]; }
}

function _reaplicarOcultos(){
    var todas = document.querySelectorAll('.card');
    for (var i in CARDS_OCULTAS) {
        if (todas[i]) {
            todas[i].classList.add('sin-codigo');
            var b = todas[i].querySelector('.btn-mini');
            if (b) b.textContent = 'Mostrar el codigo de arriba';
        }
    }
}

function enviarForm(e){
    e.preventDefault();
    var form = e.target;
    var fd   = new FormData(form);
    var s    = e.submitter;
    if (s && s.name) fd.append(s.name, s.value);

    /* --- guardamos la posicion del scroll antes de repintar --------------
       Al verificar se reemplaza el contenido de la pagina, y eso reinicia
       tanto el scroll vertical como el horizontal de cada bloque de codigo.
       Guardamos ambos y los restauramos, para poder ir contestando hueco a
       hueco sin tener que volver a arrastrar la barra cada vez.
       ------------------------------------------------------------------- */
    var scrollY   = window.pageYOffset;
    var scrollPre = [].map.call(document.querySelectorAll('pre'), function(p){ return p.scrollLeft; });
    var foco      = document.activeElement ? document.activeElement.id : '';

    fetch(window.location.pathname, {method:'POST', body: fd})
        .then(function(r){ return r.text(); })
        .then(function(html){
            var doc = new DOMParser().parseFromString(html, 'text/html');
            document.body.innerHTML = doc.body.innerHTML;

            var pres = document.querySelectorAll('pre');
            for (var i = 0; i < pres.length && i < scrollPre.length; i++) {
                pres[i].scrollLeft = scrollPre[i];
            }
            window.scrollTo(0, scrollY);
            _reaplicarOcultos();

            /* y devolvemos el cursor al hueco donde estabas */
            if (foco) {
                var el = document.getElementById(foco);
                if (el && el.focus) {
                    el.focus({preventScroll: true});
                    if (el.setSelectionRange) {
                        try { el.setSelectionRange(el.value.length, el.value.length); } catch(err){}
                    }
                }
            }
        })
        .catch(function(err){ console.error('Error al enviar:', err); });
    return false;
}
</script>
</head>
<body>

<div class="topbar">
  <div>
    <h1><?= htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') ?></h1>
    <?php if ($subtitulo !== ''): ?><p class="sub"><?= htmlspecialchars($subtitulo, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
  </div>
  <div class="spacer"></div>
  <div class="barra"><i style="width:<?= $pct ?>%"></i></div>
  <div class="score">
    <b><?= $ok ?></b> / <?= $total ?>
    <?php if ($mal > 0): ?> &nbsp;<span class="m"><?= $mal ?> mal</span><?php endif; ?>
    <?php if ($vacio > 0): ?> &nbsp;<span style="opacity:.6"><?= $vacio ?> sin responder</span><?php endif; ?>
  </div>
  <?php if ($rtot > 0): ?>
  <div class="score" title="Retos: escribir un bloque entero de memoria">
    &#127919; <b><?= $rok ?></b> / <?= $rtot ?>
  </div>
  <?php endif; ?>
  <a href="Menu.php">&#8962; Menu</a>
</div>

<?php if ($VER_SOL): ?>
<div class="wrap" style="padding-bottom:0">
  <div class="nota"><b>Modo solucion.</b> Todos los huecos y opciones estan rellenados con la respuesta correcta.
  Pulsa <b>Limpiar</b> abajo para volver a intentarlo.</div>
</div>
<?php endif; ?>

<form method="POST" action="" onsubmit="return enviarForm(event)" autocomplete="off">
<div class="wrap">
<?php
}


/* ---------- pie de pagina ---------- */
function pie($anterior = '', $siguiente = '') {
?>
</div><!-- /wrap -->

<div class="pie">
  <?php if ($anterior !== ''): ?>
    <a class="btn-gris" href="<?= $anterior ?>">&#8592; Anterior</a>
  <?php endif; ?>
  <button type="submit" class="btn-ok">Verificar todo</button>
  <button type="submit" class="btn-gris" name="mostrar_solucion" value="1">Mostrar solucion</button>
  <a class="btn-gris" href="<?= htmlspecialchars(basename($_SERVER['PHP_SELF']), ENT_QUOTES, 'UTF-8') ?>">Limpiar</a>
  <?php if ($siguiente !== ''): ?>
    <a class="btn-gris" href="<?= $siguiente ?>">Siguiente &#8594;</a>
  <?php endif; ?>
</div>

</form>
</body>
</html>
<?php
}
