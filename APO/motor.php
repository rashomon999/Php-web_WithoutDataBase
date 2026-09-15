<?php
/* ==========================================================================
   motor.php  —  Motor de cuestionarios de pandas (APO)
   Carpeta: htdocs/php_web/APO/

   USO EN CADA CUESTIONARIO (que vive en una subcarpeta, p.ej. APO/Filtros/):

       require_once __DIR__ . '/../motor.php';

       $SOLUCIONES = [
           1 => "sales.shape",                         // respuesta unica
           2 => ["sales.head()", "sales.head(5)"]      // varias aceptadas
       ];

       $MULTIPLE = [
           'm1' => [
               'texto'    => 'Que devuelve sales.shape?',
               'opciones' => ['a' => '...', 'b' => '...'],
               'correcta' => 'b',
               'porque'   => 'Explicacion corta que aparece al verificar.'
           ]
       ];

       iniciar($SOLUCIONES, $MULTIPLE);
       cabecera('Titulo', 'Subtitulo');
          ... html ... hueco(1, 10) ... linea(2, 'pista') ... mc('m1') ...
       pie('../Otro/index.php', '../Siguiente/index.php');

   COMO COMPARA LAS RESPUESTAS
   ---------------------------
   pandas distingue mayusculas ('Customer_Age' NO es 'customer_age'), pero
   escribir mal una mayuscula no es el mismo error que no saberse el metodo.
   Por eso hay tres resultados y no dos:

       correcto    la linea coincide (ignorando espacios sobrantes y el
                   tipo de comillas: "title" vale igual que 'title')
       casi        acertaste la estructura pero fallaste mayusculas /
                   minusculas. Se marca en naranja y se te enseña la forma
                   exacta, porque en Python eso revienta.
       incorrecto  otra cosa.

   'casi' suma en el marcador, pero se cuenta aparte para que se vea.
   ========================================================================== */

$SOL      = [];   // soluciones de los huecos
$MC       = [];   // preguntas de opcion multiple
$RESP     = [];   // lo que escribio el usuario en cada hueco
$VERIF    = [];   // 'correcto' | 'casi' | 'incorrecto' | ''
$MCRESP   = [];   // opcion marcada en cada pregunta de opcion multiple
$MCVERIF  = [];   // 'correcto' | 'incorrecto' | ''
$VER_SOL  = false;
/* $MENU y $CSS se pueden fijar ANTES del require desde cada cuestionario,
   para carpetas que cuelgan a otra profundidad. Solo se ponen por defecto. */
if (!isset($MENU)) $MENU = '../Menu.php';
if (!isset($CSS))  $CSS  = '../../css/bootstrap.min.css';
$TXT      = [];   // numeros de hueco que son texto normal, no codigo


/* ---------- limpieza basica, SIN tocar mayusculas ----------
   espacio duro -> espacio, comillas tipograficas -> rectas,
   comillas dobles -> simples (en Python dan igual),
   espacios repetidos -> uno solo.                                */
function _limpia($t) {
    $t = (string) $t;
    $t = str_replace("\xC2\xA0", ' ', $t);
    $t = str_replace(['“', '”', '‘', '’'], ['"', '"', "'", "'"], $t);
    $t = str_replace('"', "'", $t);
    $t = preg_replace('/\s+/u', ' ', $t);
    return trim($t);
}

function _bajar($t) {
    return function_exists('mb_strtolower') ? mb_strtolower($t, 'UTF-8') : strtolower($t);
}

/* ---------- normalizacion "de codigo" ----------
   Quita los espacios alrededor de la puntuacion y el ; final, de modo que
   estas tres lineas se consideran la misma:

       sales.loc[ sales['State'] == 'Kentucky' ]
       sales.loc[sales['State']=='Kentucky']
       sales . loc [ sales [ 'State' ] == 'Kentucky' ]

   OJO: respeta las mayusculas. La version en minusculas es _codbajo().   */
function _cod($t) {
    $t = _limpia($t);
    $t = preg_replace('/\s*([(),;:{}\[\]])\s*/', '$1', $t);
    $t = preg_replace('/\s*(==|!=|>=|<=|\*=|\+=|-=|\/=|=>|=|\+|-|\*|\/|\||&|<|>)\s*/', '$1', $t);
    $t = preg_replace('/\s*\.\s*/', '.', $t);
    $t = rtrim($t, ';');
    return trim($t);
}

function _codbajo($t) { return _bajar(_cod($t)); }


/* ---------- comparacion de TEXTO normal (no codigo) ----------
   Para respuestas en castellano o ingles. Se ignoran:
     mayusculas, tildes y la enie          -> "Diseniar" == "diseñar"
     los signos de apertura y las comillas -> "¿Por que?" == "por que"
     guiones, barras y guiones bajos       -> "Time-Bound" == "time bound"
     la puntuacion final                   -> "Mediana." == "mediana"
     el articulo de delante                -> "El No Repudio" == "no repudio"     */
function _texto($t) {
    $t = _bajar(_limpia($t));
    $de = ['á','é','í','ó','ú','ü','ñ','à','è','ì','ò','ù','â','ê','î','ô','û'];
    $a  = ['a','e','i','o','u','u','n','a','e','i','o','u','a','e','i','o','u'];
    $t  = str_replace($de, $a, $t);
    $t  = str_replace(['-', '–', '—', '_', '/', '\\'], ' ', $t);
    $t  = preg_replace('/[¿¡"\'«»()\[\]{}]/u', '', $t);
    $t  = preg_replace('/[.,;:!?]+$/u', '', $t);
    $t  = preg_replace('/\s+/u', ' ', $t);
    $t  = preg_replace('/^(el|la|los|las|un|una|the|a|an) /u', '', $t);
    return trim($t);
}

function _compararTexto($r, $acepta) {
    foreach ($acepta as $a) {
        if (_texto($r) === _texto($a)) return 'correcto';
    }
    return 'incorrecto';
}


/* ---------- compara una respuesta contra las aceptadas ----------
   devuelve 'correcto' | 'casi' | 'incorrecto'                      */
function _comparar($r, $acepta) {
    foreach ($acepta as $a) {
        if (_cod($r) === _cod($a) || _limpia($r) === _limpia($a)) return 'correcto';
    }
    foreach ($acepta as $a) {
        if (_codbajo($r) === _codbajo($a)) return 'casi';
    }
    return 'incorrecto';
}


/* ---------- lo mismo para bloques de varias lineas ----------
   se ignoran las lineas en blanco, la sangria y los comentarios (#...)  */
function _lineas($t) {
    $t   = str_replace(["\r\n", "\r"], "\n", (string) $t);
    $out = [];
    foreach (explode("\n", $t) as $l) {
        $l = preg_replace('/#.*$/', '', $l);
        $l = trim($l);
        if ($l !== '') $out[] = $l;
    }
    return $out;
}

function _compararBloque($r, $acepta) {
    $mias = _lineas($r);
    foreach ($acepta as $a) {
        $suyas = _lineas($a);
        if (count($mias) !== count($suyas)) continue;
        $ok = true;
        for ($i = 0; $i < count($mias); $i++) {
            if (_cod($mias[$i]) !== _cod($suyas[$i])) { $ok = false; break; }
        }
        if ($ok) return 'correcto';
    }
    foreach ($acepta as $a) {
        $suyas = _lineas($a);
        if (count($mias) !== count($suyas)) continue;
        $ok = true;
        for ($i = 0; $i < count($mias); $i++) {
            if (_codbajo($mias[$i]) !== _codbajo($suyas[$i])) { $ok = false; break; }
        }
        if ($ok) return 'casi';
    }
    return 'incorrecto';
}


/* ---------- arranque: lee el POST y verifica todo ---------- */
function iniciar($soluciones, $mc = [], $texto = []) {
    global $SOL, $MC, $RESP, $VERIF, $MCRESP, $MCVERIF, $VER_SOL, $TXT;

    $SOL     = $soluciones;
    $MC      = $mc;
    $TXT     = array_flip($texto);
    $VER_SOL = isset($_POST['mostrar_solucion']);

    foreach ($SOL as $n => $ok) {
        $acepta  = is_array($ok) ? $ok : [$ok];
        $oficial = $acepta[0];

        if ($VER_SOL) {
            $RESP[$n]  = $oficial;
            $VERIF[$n] = 'correcto';
            continue;
        }

        $r        = isset($_POST["respuesta_$n"]) ? $_POST["respuesta_$n"] : '';
        $RESP[$n] = $r;

        if (_limpia($r) === '') { $VERIF[$n] = ''; continue; }

        if (isset($TXT[$n]))                       $VERIF[$n] = _compararTexto($r, $acepta);
        elseif (strpos($oficial, "\n") !== false)   $VERIF[$n] = _compararBloque($r, $acepta);
        else                                        $VERIF[$n] = _comparar($r, $acepta);
    }

    foreach ($MC as $id => $p) {
        /* 'correctas' (en plural) = pregunta de seleccion multiple: hay que
           marcar TODAS las correctas y ninguna de mas. Se pinta con mcm(). */
        $varias = isset($p['correctas']);

        if ($VER_SOL) {
            $MCRESP[$id]  = $varias ? $p['correctas'] : $p['correcta'];
            $MCVERIF[$id] = 'correcto';
            continue;
        }

        $r           = isset($_POST["mc_$id"]) ? $_POST["mc_$id"] : ($varias ? [] : '');
        $MCRESP[$id] = $r;

        if ($varias) {
            $marcadas = is_array($r) ? $r : ($r === '' ? [] : [$r]);
            if (!$marcadas) { $MCVERIF[$id] = ''; continue; }
            $a = array_map('strval', $marcadas);
            $b = array_map('strval', $p['correctas']);
            sort($a); sort($b);
            $MCVERIF[$id] = ($a === $b) ? 'correcto' : 'incorrecto';
            continue;
        }

        if ($r === '')                 $MCVERIF[$id] = '';
        elseif ($r === $p['correcta']) $MCVERIF[$id] = 'correcto';
        else                           $MCVERIF[$id] = 'incorrecto';
    }
}


/* ---------- utilidades internas ---------- */
function _clase($c) {
    if ($c === 'correcto')   return 'ok';
    if ($c === 'casi')       return 'casi';
    if ($c === 'incorrecto') return 'bad';
    return '';
}

function _marca($c) {
    if ($c === 'correcto')   return '<span class="mk ok">&#10004;</span>';
    if ($c === 'casi')       return '<span class="mk casi" title="mayusculas">&#9888;</span>';
    if ($c === 'incorrecto') return '<span class="mk bad">&#10008;</span>';
    return '';
}

function _oficial($n) {
    global $SOL;
    if (!isset($SOL[$n])) return '';
    return is_array($SOL[$n]) ? $SOL[$n][0] : $SOL[$n];
}


/* ---------- un hueco corto (una palabra, un metodo) ---------- */
function hueco($n, $size = 12) {
    global $RESP, $VERIF;

    $v = isset($RESP[$n])  ? htmlspecialchars($RESP[$n], ENT_QUOTES, 'UTF-8') : '';
    $c = isset($VERIF[$n]) ? $VERIF[$n] : '';

    echo '<span class="hbox">';
    echo '<input type="text" class="hueco ' . _clase($c) . '"'
       . ' name="respuesta_' . $n . '" id="respuesta_' . $n . '"'
       . ' value="' . $v . '" size="' . $size . '"'
       . ' title="hueco ' . $n . '" autocomplete="off" spellcheck="false">';
    echo _marca($c);
    if ($c === 'casi') {
        echo '<span class="corr">' . htmlspecialchars(_oficial($n), ENT_QUOTES, 'UTF-8') . '</span>';
    }
    echo '</span>';
}


/* ---------- una LINEA COMPLETA de codigo, de memoria ---------- */
function linea($n, $pista = '', $placeholder = 'escribe la linea completa...') {
    global $RESP, $VERIF, $TXT;

    $v = isset($RESP[$n])  ? htmlspecialchars($RESP[$n], ENT_QUOTES, 'UTF-8') : '';
    $c = isset($VERIF[$n]) ? $VERIF[$n] : '';

    echo '<div class="lineabox">';
    if ($pista !== '') echo '<div class="pista">' . $pista . '</div>';
    echo '<div class="lineain">';
    echo '<input type="text" class="hueco linea ' . _clase($c) . '"'
       . ' name="respuesta_' . $n . '" id="respuesta_' . $n . '"'
       . ' value="' . $v . '" autocomplete="off" spellcheck="false"'
       . ' placeholder="' . htmlspecialchars($placeholder, ENT_QUOTES, 'UTF-8') . '">';
    echo _marca($c);
    echo '</div>';

    if ($c === 'incorrecto' || $c === 'casi') {
        $aviso = ($c === 'casi' && !isset($TXT[$n]))
               ? 'Casi. Las mayusculas importan: ' : '';
        echo '<div class="corregida' . ($c === 'casi' ? ' aviso' : '') . '">'
           . $aviso . htmlspecialchars(_oficial($n), ENT_QUOTES, 'UTF-8') . '</div>';
    }
    echo '</div>';
}


/* ---------- un BLOQUE de varias lineas (bucles, graficas) ---------- */
function bloque($n, $pista = '', $filas = 5) {
    global $RESP, $VERIF;

    $v = isset($RESP[$n])  ? htmlspecialchars($RESP[$n], ENT_QUOTES, 'UTF-8') : '';
    $c = isset($VERIF[$n]) ? $VERIF[$n] : '';

    echo '<div class="lineabox">';
    if ($pista !== '') echo '<div class="pista">' . $pista . '</div>';
    echo '<div class="lineain">';
    echo '<textarea class="hueco bloque ' . _clase($c) . '"'
       . ' name="respuesta_' . $n . '" id="respuesta_' . $n . '"'
       . ' rows="' . $filas . '" autocomplete="off" spellcheck="false"'
       . ' placeholder="una instruccion por linea...">' . $v . '</textarea>';
    echo _marca($c);
    echo '</div>';

    if ($c === 'incorrecto' || $c === 'casi') {
        echo '<pre class="corregida">'
           . htmlspecialchars(_oficial($n), ENT_QUOTES, 'UTF-8') . '</pre>';
    }
    echo '</div>';
}


/* ---------- mostrar la solucion de un hueco concreto ---------- */
function sol($n) {
    echo '<span class="sol">' . htmlspecialchars(_oficial($n), ENT_QUOTES, 'UTF-8') . '</span>';
}

/* ---------- marca de verificacion suelta ---------- */
function chk($n) {
    global $VERIF;
    echo _marca(isset($VERIF[$n]) ? $VERIF[$n] : '');
}

/* ---------- boton de ayuda que se ve mientras lo mantienes pulsado ---------- */
function ayuda($texto) {
    static $i = 0;
    $i++;
    $id = 'ayuda_' . $i;
    echo '<span class="ayudabox">';
    echo '<button type="button" class="btn-ayuda"'
       . ' onmousedown="document.getElementById(\'' . $id . '\').style.display=\'block\'"'
       . ' onmouseup="document.getElementById(\'' . $id . '\').style.display=\'none\'"'
       . ' onmouseleave="document.getElementById(\'' . $id . '\').style.display=\'none\'"'
       . '>&#128161; pista</button>';
    echo '<span class="ayudatxt" id="' . $id . '" style="display:none">' . $texto . '</span>';
    echo '</span>';
}


/* ---------- reparto de la respuesta correcta en opcion multiple ----------
   Si las opciones van siempre en el mismo orden, la correcta acaba cayendo
   casi siempre en la misma letra y se aprende el patron en vez del
   contenido. Aqui se ROTAN de forma determinista.                          */
$MC_CONTADOR = 0;
$MC_PATRON   = [2, 0, 3, 1, 1, 3, 0, 2];

function _orden_opciones($p) {
    global $MC_CONTADOR, $MC_PATRON;

    $keys = array_keys($p['opciones']);
    $n    = count($keys);

    $offset = crc32(basename(dirname($_SERVER['PHP_SELF']))) % count($MC_PATRON);
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

    $p = $MC[$id];
    $r = isset($MCRESP[$id])  ? $MCRESP[$id]  : '';
    $c = isset($MCVERIF[$id]) ? $MCVERIF[$id] : '';

    echo '<div class="pregunta ' . _clase($c) . '">';
    echo '<p class="enunciado">' . $p['texto'] . ' ' . _marca($c) . '</p>';

    $orden = _orden_opciones($p);
    $i     = 0;
    foreach ($orden as $clave) {
        $texto   = $p['opciones'][$clave];
        $checked = ($r === (string) $clave) ? ' checked' : '';
        $marca   = ($c !== '' && $clave === $p['correcta']) ? ' es-correcta' : '';
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


/* ---------- pregunta de SELECCION MULTIPLE (varias correctas) ----------
   Igual que mc(), pero con casillas. En $MULTIPLE se declara con
   'correctas' => ['c', 'e'] en vez de 'correcta' => 'c'.
   Solo cuenta como acertada si se marcan todas y ninguna de mas.
   Las opciones NO se rotan: al haber varias correctas, rotar no aporta.   */
function mcm($id) {
    global $MC, $MCRESP, $MCVERIF;
    if (!isset($MC[$id])) return;

    $p = $MC[$id];
    $r = (isset($MCRESP[$id]) && is_array($MCRESP[$id])) ? array_map('strval', $MCRESP[$id]) : [];
    $c = isset($MCVERIF[$id]) ? $MCVERIF[$id] : '';

    echo '<div class="pregunta ' . _clase($c) . '">';
    echo '<p class="enunciado">' . $p['texto'] . ' ' . _marca($c) . '</p>';

    $i = 0;
    foreach ($p['opciones'] as $clave => $texto) {
        $checked = in_array((string) $clave, $r, true) ? ' checked' : '';
        $marca   = ($c !== '' && in_array($clave, $p['correctas'], true)) ? ' es-correcta' : '';
        echo '<label class="opcion' . $marca . '">';
        echo '<input type="checkbox" name="mc_' . $id . '[]" value="' . $clave . '"' . $checked . '> ';
        echo '<b>' . chr(65 + $i) . ')</b> ' . $texto;
        echo '</label>';
        $i++;
    }

    if ($c !== '' && isset($p['porque'])) {
        echo '<p class="porque">&#128161; ' . $p['porque'] . '</p>';
    }
    echo '</div>';
}


/* ---------- boton de enviar intermedio ---------- */
function enviar($etiqueta = 'Verificar esta parte') {
    echo '<div class="acciones"><button type="submit" class="btn-ok">' . $etiqueta . '</button></div>';
}


/* ---------- contador de aciertos ---------- */
function _puntaje() {
    global $VERIF, $MCVERIF;
    $ok = 0; $casi = 0; $mal = 0; $vacio = 0;
    foreach (array_merge(array_values($VERIF), array_values($MCVERIF)) as $v) {
        if     ($v === 'correcto')   $ok++;
        elseif ($v === 'casi')       $casi++;
        elseif ($v === 'incorrecto') $mal++;
        else                         $vacio++;
    }
    return [$ok, $casi, $mal, $vacio, $ok + $casi + $mal + $vacio];
}


/* ---------- cabecera de pagina ---------- */
function cabecera($titulo, $subtitulo = '') {
    global $VER_SOL, $MENU, $CSS;
    list($ok, $casi, $mal, $vacio, $total) = _puntaje();
    $pct = $total ? round(($ok + $casi) * 100 / $total) : 0;
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') ?></title>
<link rel="stylesheet" href="<?= $CSS ?>">
<style>
:root{
  --verde:#1a7f37; --verde-bg:#e6f4ea;
  --rojo:#c0392b;  --rojo-bg:#fdecea;
  --naranja:#b5730a; --naranja-bg:#fff4e0;
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
.score .c{color:#ffd08a}
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
table.datos{border-collapse:collapse;font-size:13.5px;margin:12px 0;background:#fff}
table.datos th,table.datos td{border:1px solid var(--borde);padding:5px 10px;text-align:left}
table.datos th{background:#eef0f3}
table.datos td.idx{background:#f7f8fa;color:#7a8494;font-weight:600}

/* ---- huecos ---- */
.hbox{display:inline-block;white-space:nowrap}
.hueco{font-family:Consolas,Menlo,monospace;font-size:13.5px;
       border:2px solid #9aa3ad;border-radius:5px;padding:1px 6px;
       background:#fffbe8;color:#1f2733;outline:none}
pre .hueco{background:#fdf6d8}
.hueco:focus{border-color:var(--azul);box-shadow:0 0 0 3px rgba(44,90,160,.18)}
.hueco.ok{border-color:var(--verde);background:var(--verde-bg)}
.hueco.casi{border-color:var(--naranja);background:var(--naranja-bg)}
.hueco.bad{border-color:var(--rojo);background:var(--rojo-bg)}
.mk{font-weight:700;margin-left:4px}
.mk.ok{color:var(--verde)}
.mk.casi{color:var(--naranja)}
.mk.bad{color:var(--rojo)}
.corr{font-family:Consolas,Menlo,monospace;font-size:12.5px;margin-left:6px;
      background:var(--naranja-bg);color:var(--naranja);padding:1px 6px;border-radius:4px}
.sol{font-family:Consolas,Menlo,monospace;background:var(--verde-bg);
     color:var(--verde);padding:1px 6px;border-radius:4px}

/* ---- lineas y bloques ---- */
.lineabox{margin:0 0 16px}
.lineabox .pista{font-size:14.5px;color:#3c4654;margin:0 0 5px}
.lineabox .pista b{color:#1f2733}
.lineain{display:flex;align-items:flex-start;gap:8px}
.hueco.linea{flex:1;width:100%;font-size:13.5px;padding:8px 11px;background:#fffbe8}
.hueco.bloque{flex:1;width:100%;font-size:13.5px;padding:8px 11px;background:#fffbe8;
              line-height:1.6;resize:vertical}
.corregida{margin-top:6px;font-family:Consolas,Menlo,monospace;font-size:13px;
           background:var(--verde-bg);color:#12602a;border-left:3px solid var(--verde);
           padding:6px 10px;border-radius:0 6px 6px 0;white-space:pre-wrap;word-break:break-word}
pre.corregida{background:var(--verde-bg);color:#12602a;line-height:1.6}
.corregida.aviso{background:var(--naranja-bg);color:var(--naranja);border-left-color:var(--naranja)}

/* ---- ayuda ---- */
.ayudabox{position:relative;display:inline-block}
.btn-ayuda{background:#fff;border:1px solid var(--borde);border-radius:6px;
           font-size:13px;padding:2px 10px;cursor:pointer;color:#3c4654}
.ayudatxt{position:absolute;z-index:30;left:0;top:110%;width:340px;
          background:#fffdf2;border:1px solid #f0b429;border-radius:8px;
          padding:10px 12px;font-size:14px;box-shadow:0 4px 14px rgba(0,0,0,.15)}

/* ---- opcion multiple ---- */
.pregunta{border:1px solid var(--borde);border-left:4px solid #9aa3ad;
          border-radius:8px;padding:12px 16px;margin:14px 0;background:#fcfcfd}
.pregunta.ok{border-left-color:var(--verde);background:var(--verde-bg)}
.pregunta.bad{border-left-color:var(--rojo);background:var(--rojo-bg)}
.pregunta .enunciado{font-weight:600;margin:0 0 8px}
.opcion{display:block;padding:5px 8px;border-radius:6px;cursor:pointer;font-size:15px}
.opcion:hover{background:rgba(44,90,160,.07)}
.opcion.es-correcta{background:#d7f0dd;font-weight:600}
.porque{margin:10px 0 0;font-size:14px;background:#fff;border-radius:6px;
        padding:8px 12px;border:1px dashed var(--borde)}

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
  pre{font-size:12.5px}
  .ayudatxt{width:260px}
}
</style>
<script>
function enviarForm(e){
    e.preventDefault();
    var form = e.target;
    var fd   = new FormData(form);
    var s    = e.submitter;
    if (s && s.name) fd.append(s.name, s.value);

    /* Al verificar se repinta la pagina entera. Guardamos el scroll vertical,
       el scroll horizontal de cada bloque de codigo y en que hueco estaba el
       cursor, para poder ir contestando hueco a hueco sin perder el sitio. */
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

/* Enter dentro de un hueco = verificar, sin tener que bajar al boton */
document.addEventListener('keydown', function(ev){
    if (ev.key === 'Enter' && ev.target && ev.target.classList.contains('hueco')
        && ev.target.tagName !== 'TEXTAREA') {
        ev.preventDefault();
        var f = ev.target.form;
        if (f) f.dispatchEvent(new Event('submit', {cancelable:true, bubbles:true}));
    }
});
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
    <?php if ($casi  > 0): ?> &nbsp;<span class="c"><?= $casi ?> casi</span><?php endif; ?>
    <?php if ($mal   > 0): ?> &nbsp;<span class="m"><?= $mal ?> mal</span><?php endif; ?>
    <?php if ($vacio > 0): ?> &nbsp;<span style="opacity:.6"><?= $vacio ?> en blanco</span><?php endif; ?>
  </div>
  <a href="<?= $MENU ?>">&#8962; Menu</a>
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
