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
   Para respuestas en castellano o ingles: da igual mayusculas, tildes,
   el punto final y el articulo de delante. "El No Repudio" == "no repudio".  */
function _texto($t) {
    $t = _bajar(_limpia($t));
    $de = ['á','é','í','ó','ú','ü','ñ','à','è','ì','ò','ù','â','ê','î','ô','û'];
    $a  = ['a','e','i','o','u','u','n','a','e','i','o','u','a','e','i','o','u'];
    $t  = str_replace($de, $a, $t);
    $t  = preg_replace('/[.,;:!?]+$/u', '', $t);
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
        if ($VER_SOL) {
            $MCRESP[$id]  = $p['correcta'];
            $MCVERIF[$id] = 'correcto';
            continue;
        }

        $r           = isset($_POST["mc_$id"]) ? $_POST["mc_$id"] : '';
        $MCRESP[$id] = $r;

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
        echo $texto;
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

.tabla-doble{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:22px;margin:18px 0 10px}
.tabla-col{background:#fafbfd;border:1px solid var(--borde);border-radius:10px;padding:14px 18px}
.tabla-col h3{margin:0 0 12px;font-size:22px;line-height:1.2;color:var(--azul);font-weight:700}
.ecosistema-lista{margin:0;padding-left:20px;list-style:disc}
.ecosistema-lista li{margin:10px 0;line-height:1.5;font-size:16px;color:#22262b}
.ecosistema-lista strong{color:var(--azul)}

.pom-layout{display:grid;grid-template-columns:1.1fr 1.2fr;gap:20px;align-items:stretch;margin-top:18px}
.pom-panel{background:#fff;border:1px solid var(--borde);border-radius:10px;overflow:hidden}
.pom-head{background:linear-gradient(90deg,#5a67d8,#6d5ee7);padding:16px 18px;color:#fff;font-size:22px;font-weight:700;line-height:1.2}
.pom-body{padding:16px 18px;background:#f7f8fa}
.pom-lista{margin:0;padding-left:22px;list-style:disc;font-size:19px;line-height:1.7;color:#22262b}
.pom-lista li{margin:8px 0}
.pom-lista strong{color:var(--azul)}
.pom-sublista{margin:8px 0 0 24px;padding-left:18px;list-style:disc;font-size:18px;line-height:1.5;color:#2a2f34}
.pom-sublista li{margin:6px 0}
.pom-code{background:#1f2733;border-radius:10px;padding:18px 16px;color:#eef3ff;font-family:Consolas,Menlo,monospace;font-size:14px;line-height:1.8;white-space:pre-wrap;overflow-x:auto;margin:0;border:1px solid #293446}
.pom-intro{font-size:24px;line-height:1.4;margin:0 0 10px;color:#1f2733;font-weight:500}
.pom-intro b{font-weight:700;color:#1f2733}

.docker-compare{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin:18px 0 12px}
.docker-panel{background:#f6f7f8;border:1px solid #d2d6db;border-radius:10px;overflow:hidden;box-shadow:0 1px 0 rgba(17,24,39,.03)}
.docker-head{padding:12px 18px;font-size:18px;font-weight:700;line-height:1.3;color:#fff}
.docker-body{padding:12px 14px;background:#f3f5f7}
.docker-body.dark{background:#1f2733}
.docker-monolitico .docker-body{background:#1f2733}
.docker-code{margin:0;white-space:pre-wrap;word-break:break-word;color:#1f2733;font-size:14px;line-height:1.7;font-family:Consolas,Menlo,monospace}
.docker-body.dark .docker-code, .docker-monolitico .docker-body .docker-code{color:#edf3ff}
.docker-monolitico .docker-head{background:linear-gradient(90deg,#f59a3f,#e56a24)}
.docker-multistage .docker-head{background:linear-gradient(90deg,#53b678,#2ea76d)}
.docker-foot{padding:10px 16px 12px;font-size:15.5px;line-height:1.45;color:#e0712f;font-weight:700}
.docker-multistage .docker-foot{color:#1d8a52}
.docker-table{margin:18px 0 0}
.docker-table th,.docker-table td{font-size:14px;vertical-align:middle}
.docker-table td:first-child{font-weight:700;background:#f4f7fa}

.flujo-compare{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin:18px 0 18px}
.flujo-panel{border-radius:10px;overflow:hidden;border:1px solid #d4d7db;background:#f7f8fa;box-shadow:0 1px 0 rgba(17,24,39,.04)}
.flujo-head{padding:12px 18px;color:#fff;font-size:19px;font-weight:700;line-height:1.35}
.flujo-caos .flujo-head{background:linear-gradient(90deg,#f39b3d,#ea6f2d)}
.flujo-estandar .flujo-head{background:linear-gradient(90deg,#42b37e,#32a96c)}
.flujo-body{padding:16px 18px;background:#f6f7f6;min-height:280px}
.flujo-caos .flujo-body{background:#f8efe6}
.flujo-estandar .flujo-body{background:#eaf7f0}
.flujo-step{display:block;width:100%;padding:10px 12px;margin:0 auto 10px;background:#f5f4f4;border:2px solid #d0d5db;border-radius:8px;font-size:16px;line-height:1.35;text-align:center;color:#20252a;font-weight:500}
.flujo-arrow{display:block;text-align:center;font-size:22px;color:#ea6f2d;margin:4px 0 8px;line-height:1}
.flujo-row{display:grid;grid-template-columns:1fr 36px 1.2fr;align-items:center;gap:10px;margin-bottom:12px}
.flujo-deploy-flow{display:grid;grid-template-columns:1fr 36px 1.2fr;gap:10px}
.flujo-arrow-final{grid-column:3;justify-self:center;display:block;width:18px;text-align:center;font-size:22px;color:#ea6f2d;line-height:1}
.flujo-box{padding:10px 12px;border:2px solid #7b8dcb;border-radius:8px;background:#f5f7ff;color:#1f2733;text-align:center;font-size:18px;font-weight:600;min-height:56px;display:flex;align-items:center;justify-content:center}
.flujo-box.repo{display:flex;flex-direction:column;gap:2px;align-items:center;justify-content:center;min-height:78px}
.flujo-box.repo small{font-size:14px;font-weight:600}
.flujo-box.small{font-size:16px;min-height:50px}
.flujo-arrow-lg{font-size:32px;color:#4a5ed8;text-align:center;line-height:1}
.flujo-final{display:flex;align-items:center;justify-content:center;min-height:60px;padding:10px 12px;border:2px solid #7b8dcb;border-radius:8px;background:#f5f7ff;color:#1f2733;text-align:center;font-size:18px;font-weight:600;margin-top:8px}
.flujo-deploy-flow .flujo-final{grid-column:1 / -1;margin-top:0}
.flujo-footer{padding:14px 18px 18px;font-size:15px;line-height:1.6;color:#1f2733}
.flujo-footer ul{margin:0; padding-left:20px}
.flujo-footer li{margin:6px 0}

.taxonomia-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;margin:18px 0 10px;align-items:stretch}
.taxonomia-card{--taxonomia-color:#514be8;--taxonomia-bg:#eef0ff;display:flex;flex-direction:column;overflow:hidden;border:4px solid var(--taxonomia-color);border-radius:14px;background:var(--taxonomia-bg)}
.taxonomia-sistema{--taxonomia-color:#8752e8;--taxonomia-bg:#f3edff}
.taxonomia-infraestructura{--taxonomia-color:#f45d12;--taxonomia-bg:#fff0e7}
.taxonomia-head{margin:0;padding:10px 14px;background:var(--taxonomia-color);color:#fff;font-size:18px;line-height:1.25;font-weight:700}
.taxonomia-body{flex:1;padding:12px 14px;background:var(--taxonomia-bg);font-size:15px;line-height:1.4;color:#17191d}
.taxonomia-body ul{margin:0;padding-left:20px}
.taxonomia-body li{margin:5px 0}
.taxonomia-purpose{margin:8px 0 0;line-height:1.45}

.repo-types-intro{margin:14px 0 18px;font-size:18px;line-height:1.5}
.repo-types-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:22px;align-items:start;margin:18px 0 12px}
.repo-type-card{--repo-color:#514be8;--repo-bg:#eef0ff;overflow:hidden;border:4px solid var(--repo-color);border-radius:14px;background:var(--repo-bg)}
.repo-proxy{--repo-color:#f45d12;--repo-bg:#fff0e7}
.repo-group{--repo-color:#31865f;--repo-bg:#eaf6ef}
.repo-type-head{margin:0;padding:9px 14px;background:var(--repo-color);color:#fff;font-size:18px;line-height:1.3;font-weight:700}
.repo-type-head .hueco{font-family:inherit;font-size:inherit;font-weight:inherit;color:inherit;background:rgba(255,255,255,.16);border-color:rgba(255,255,255,.7);padding:0 4px}
.repo-type-body{padding:10px 12px 12px;background:var(--repo-bg);font-size:14.5px;line-height:1.4;color:#17191d}
.repo-type-body ul{margin:0;padding-left:18px;list-style:disc}
.repo-type-body ul ul{margin-top:2px;padding-left:18px}
.repo-type-body li{margin:3px 0}
.repo-type-body>ul>li::marker{color:#20252a}
.repo-type-body ul ul li::marker{color:#5e50ef}

.nexus-flow-layout{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:34px;align-items:center;margin:20px 16px}
.nexus-cycle{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f7f7fb}
.nexus-cycle>h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;font-size:18px;line-height:1.3;text-align:left}
.nexus-cycle-body{padding:14px 18px}
.nexus-stage{width:82%;min-height:42px;margin:0 auto;padding:6px 10px;display:flex;align-items:center;justify-content:center;border:1px solid #6658ff;border-radius:9px;background:#f0efff;color:#17191d;text-align:center;font-size:16px;font-weight:700;line-height:1.25}
.nexus-stage .hueco{font-weight:500}
.nexus-stage-hub{min-height:48px;background:#e9e3ff;font-size:20px}
.nexus-transition{min-height:24px;display:flex;align-items:center;justify-content:center;gap:8px;color:#7655eb;font-size:20px;font-weight:700;line-height:1}
.nexus-transition small{font-family:Consolas,Menlo,monospace;font-size:13px;font-weight:500}
.nexus-aspects h3{margin:0 0 12px;color:#5e50ef;font-size:21px;line-height:1.3;font-weight:700}
.nexus-aspects ul{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:17px;line-height:1.45}
.nexus-aspects li{padding-left:2px;margin:0 0 12px}
.nexus-aspects li::marker{color:#5e50ef}

.nexus-manager-intro{margin:14px 0 10px;font-size:18px;line-height:1.5}
.nexus-manager-layout{display:grid;grid-template-columns:minmax(0,1.4fr) minmax(290px,1fr);gap:26px;align-items:start;margin:14px 8px 18px}
.nexus-manager-list{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:17px;line-height:1.5}
.nexus-manager-list li{padding-left:2px;margin:0 0 12px}
.nexus-manager-list li::marker{color:#5e50ef}
.nexus-governance{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f3edff}
.nexus-governance h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;text-align:center;font-size:22px;line-height:1.25}
.nexus-governance p{margin:0;padding:14px 18px;font-size:18px;line-height:1.5;text-align:justify}

.semver-layout{display:grid;grid-template-columns:minmax(0,1.55fr) minmax(280px,1fr);gap:24px;align-items:start;margin:18px 0}
.semver-intro{font-size:18px;line-height:1.55;margin:0 0 12px}
.semver-lista{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:18px;line-height:1.5}
.semver-lista li{padding-left:2px;margin:0 0 12px}
.semver-lista li::marker{color:#5e50ef}
.semver-lista code{font-size:.92em}
.semver-version{margin:10px 0 0;font-size:16px}
.semver-confidence{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f3edff}
.semver-confidence h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;text-align:center;font-size:22px;line-height:1.25}
.semver-confidence p{margin:0;padding:14px 18px;font-size:18px;line-height:1.5}

.tag-alerta{margin:24px 0 18px;padding:18px 26px 20px;text-align:center;background:#f7f7fb;border-radius:12px}
.tag-impacto{color:#f45d12;font-size:88px;font-weight:700;line-height:1}
.tag-subtitulo{margin:4px 0 22px;color:#5e50ef;font-size:24px;font-weight:700;line-height:1.35}
.tag-subtitulo code{background:none;color:inherit;font-size:.95em;padding:0}
.tag-alerta blockquote{max-width:900px;margin:0 auto;color:#17191d;font-size:23px;font-style:italic;line-height:1.55}

.integridad-layout{display:grid;grid-template-columns:minmax(0,1.55fr) minmax(290px,1fr);gap:26px;align-items:start;margin:18px 0}
.integridad-content h3{margin:0 0 12px;color:#17191d;font-size:21px;line-height:1.35;font-weight:500}
.integridad-lista{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:18px;line-height:1.5}
.integridad-lista li{padding-left:2px;margin:0 0 12px}
.integridad-lista li::marker{color:#5e50ef}
.integridad-ejemplo{display:block;margin:6px 0 20px;text-align:center;background:none;color:#1f2733;font-size:14px;white-space:normal;word-break:break-word}
.integridad-inmutable{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f3edff}
.integridad-inmutable h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;text-align:center;font-size:22px;line-height:1.25}
.integridad-inmutable p{margin:0;padding:14px 18px;font-size:18px;line-height:1.5;text-align:justify}

.sbom-layout{display:grid;grid-template-columns:minmax(0,1.45fr) minmax(300px,1fr);gap:26px;align-items:start;margin:18px 0}
.sbom-intro{margin:0 0 10px;font-size:18px;line-height:1.5}
.sbom-lista{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:17px;line-height:1.5}
.sbom-lista li{padding-left:2px;margin:0 0 12px}
.sbom-lista li::marker{color:#5e50ef}
.sbom-transparencia{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f3edff}
.sbom-transparencia h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;text-align:center;font-size:22px;line-height:1.25}
.sbom-transparencia p{margin:0;padding:14px 18px;font-size:18px;line-height:1.5;text-align:justify}

.escaneo-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:34px;margin:18px 6px 10px;align-items:start}
.escaneo-col h3{margin:0 0 20px;color:#5e50ef;font-size:22px;line-height:1.3;font-weight:700}
.escaneo-oci h3{color:#8752e8}
.escaneo-col ul{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:18px;line-height:1.5}
.escaneo-col li{padding-left:2px;margin:0 0 14px}
.escaneo-col li::marker{color:#5e50ef}

.oci-intro{margin:14px 0 10px;font-size:18px;line-height:1.5}
.oci-layout{display:grid;grid-template-columns:minmax(0,1.4fr) minmax(290px,1fr);gap:26px;align-items:start;margin:14px 8px 20px}
.oci-lista{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:17px;line-height:1.5}
.oci-lista li{padding-left:2px;margin:0 0 12px}
.oci-lista li::marker{color:#5e50ef}
.oci-eficiencia{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f3edff}
.oci-eficiencia h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;text-align:center;font-size:22px;line-height:1.25}
.oci-eficiencia p{margin:0;padding:14px 18px;font-size:18px;line-height:1.5;text-align:justify}

.oci-distribucion-layout{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:32px;align-items:center;margin:24px 8px 20px}
.oci-pipeline{overflow:hidden;border:4px solid #514be8;border-radius:14px;background:#f7f7fb}
.oci-pipeline>h3{margin:0;padding:8px 14px;background:#514be8;color:#fff;font-size:18px;line-height:1.3}
.oci-pipeline-body{padding:12px 16px}
.oci-stage{width:78%;min-height:35px;margin:0 auto;padding:5px 8px;display:flex;align-items:center;justify-content:center;border:1px solid #6658ff;border-radius:8px;background:#f0efff;color:#17191d;text-align:center;font-size:15px;font-weight:700;line-height:1.25}
.oci-stage-action{border-color:#f45d12;background:#fff0e7;font-family:Consolas,Menlo,monospace;font-weight:500}
.oci-stage-action code{background:none;color:#17191d;padding:0}
.oci-stage-action .hueco{font:inherit;background:transparent;border-color:transparent;padding:0 2px}
.oci-stage-registry{min-height:40px;border-color:#31865f;background:#dcf1e5;font-size:18px}
.oci-stage-arrow{height:16px;color:#514be8;text-align:center;font-size:17px;line-height:16px}
.oci-puntos h3{margin:0 0 14px;color:#5e50ef;font-size:22px;line-height:1.3;font-weight:700}
.oci-puntos ul{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:17px;line-height:1.45}
.oci-puntos li{padding-left:2px;margin:0 0 13px}
.oci-puntos li::marker{color:#5e50ef}

.manifest-intro{margin:14px 0 18px;font-size:18px;line-height:1.5}
.manifest-layout{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:30px;align-items:start;margin:18px 8px}
.manifest-panel{--manifest-color:#514be8;overflow:hidden;border:4px solid var(--manifest-color);border-radius:14px;background:#f0efff}
.manifest-layers{--manifest-color:#8752e8;background:#f3edff}
.manifest-panel h3{margin:0;padding:8px 14px;background:var(--manifest-color);color:#fff;text-align:center;font-size:20px;line-height:1.3}
.manifest-panel-body{padding:12px 16px}
.manifest-panel-body ul{margin:0;padding-left:22px;list-style:disc;color:#20252a;font-size:17px;line-height:1.5}
.manifest-panel-body li{padding-left:2px;margin:0 0 12px}
.manifest-panel-body li::marker{color:#5e50ef}
.manifest-panel-body li:last-child{margin-bottom:0}

.registry-comparison-intro{margin:14px 0 18px;font-size:18px;line-height:1.5}
.registry-comparison{width:100%}
.registry-comparison tr:nth-child(odd) td{background:#f1f2f5}
.registry-comparison td:first-child{white-space:nowrap}

.ecosistema-title{margin:26px 0 18px;color:#514be8;font-size:22px;line-height:1.3}
.ecosistema-layout{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:34px;align-items:start;margin:14px 8px 18px}
.ecosistema-col h3{margin:0 0 18px;color:#514be8;font-size:21px;line-height:1.3;font-weight:700}
.ecosistema-cloud h3{color:#8752e8}
.ecosistema-col ul{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:17px;line-height:1.5}
.ecosistema-col li{padding-left:2px;margin:0 0 14px}
.ecosistema-col li::marker{color:#5e50ef}

.seguridad-intro{margin:14px 0 10px;font-size:18px;line-height:1.5}
.seguridad-layout{display:grid;grid-template-columns:minmax(0,1.4fr) minmax(290px,1fr);gap:28px;align-items:start;margin:14px 8px 18px}
.seguridad-lista{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:17px;line-height:1.5}
.seguridad-lista li{padding-left:2px;margin:0 0 14px}
.seguridad-lista li::marker{color:#5e50ef}
.seguridad-zero-trust{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f3edff}
.seguridad-zero-trust h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;text-align:center;font-size:22px;line-height:1.25}
.seguridad-zero-trust .hueco{font-family:inherit;font-size:inherit;font-weight:inherit;color:inherit;background:rgba(255,255,255,.16);border-color:rgba(255,255,255,.7);padding:0 4px}
.seguridad-zero-trust p{margin:0;padding:14px 18px;font-size:18px;line-height:1.5;text-align:justify}

.jenkins-orquestador-layout{display:grid;grid-template-columns:minmax(0,1.45fr) minmax(290px,1fr);gap:28px;align-items:start;margin:18px 8px}
.jenkins-orquestador-content>p{margin:0 0 12px;font-size:18px;line-height:1.5}
.jenkins-orquestador-content ul{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:17px;line-height:1.45}
.jenkins-orquestador-content li{padding-left:2px;margin:0 0 12px}
.jenkins-orquestador-content li::marker{color:#5e50ef}
.jenkins-principio{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f3edff}
.jenkins-principio h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;text-align:center;font-size:22px;line-height:1.25}
.jenkins-principio p{margin:0;padding:14px 18px;font-size:18px;line-height:1.5;text-align:justify}

.manifest-detail-layout{display:grid;grid-template-columns:minmax(0,.85fr) minmax(0,1.15fr);gap:28px;align-items:start;margin:20px 6px}
.manifest-descriptor h3{margin:0 0 12px;color:#17191d;font-size:20px;line-height:1.35}
.manifest-descriptor ul{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:18px;line-height:1.5}
.manifest-descriptor li{padding-left:2px;margin:0 0 14px}
.manifest-descriptor li::marker{color:#5e50ef}
.manifest-json-panel{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f7f7fb}
.manifest-json-panel h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;font-size:18px;line-height:1.3}
.manifest-json-panel h3 code{background:none;color:inherit;padding:0;font-size:inherit}
pre.manifest-json{margin:0;padding:14px 16px;border-radius:0;background:#f7f7fb;color:#17191d;font-size:12px;line-height:1.45;white-space:pre;overflow:auto}
pre.manifest-json code{background:none;color:inherit;padding:0;font-size:inherit}

.regla-oro{margin:16px 0 24px;padding:12px 20px 18px;text-align:center;background:#f7f7fb;border-radius:12px}
.regla-impacto{color:#f45d12;font-size:84px;font-weight:700;line-height:1.05}
.regla-subtitulo{margin:0 0 20px;color:#5e50ef;font-size:22px;font-weight:700;line-height:1.35}
.regla-oro blockquote{max-width:850px;margin:0 auto;color:#17191d;font-size:22px;font-style:italic;line-height:1.5}
.regla-beneficios{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:28px;margin:18px 12px}
.regla-beneficio,.promo-beneficio{overflow:hidden;border:4px solid var(--beneficio-color);border-radius:12px;background:#f7f7fb}
.regla-beneficio{--beneficio-color:#514be8}
.regla-velocidad{--beneficio-color:#31865f}
.regla-beneficio h3,.promo-beneficio h3{margin:0;padding:8px 12px;background:var(--beneficio-color);color:#fff;text-align:center;font-size:18px;line-height:1.3}
.regla-beneficio p,.promo-beneficio p{margin:0;padding:10px 16px;font-size:15px;line-height:1.45;text-align:center}

.promo-intro{margin:14px 0 20px;font-size:18px;line-height:1.5}
.promo-flow{display:grid;grid-template-columns:minmax(0,1fr) 34px minmax(0,1.05fr) 32px minmax(0,1.5fr);gap:10px;align-items:center;margin:22px 12px 28px}
.promo-node{border:1px solid #6658ff;border-radius:9px;background:#f0efff;color:#17191d;text-align:center}
.promo-build,.promo-artifact{min-height:86px;padding:12px 10px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:5px}
.promo-build b,.promo-artifact b{font-size:21px}
.promo-node small{display:block;font-size:13px;line-height:1.35}
.promo-artifact{background:#e9e3ff}
.promo-artifact strong{font-size:13px}
.promo-artifact code{font-size:12px}
.promo-arrow{color:#7655eb;text-align:center;font-size:28px;line-height:1}
.promo-targets{position:relative;display:grid;gap:11px;padding-left:24px}
.promo-targets::before{position:absolute;top:12%;bottom:12%;left:7px;border-left:3px solid #7655eb;content:""}
.promo-env{position:relative;padding:8px 10px;border-color:#31865f;background:#e5f5eb}
.promo-env::before{position:absolute;top:50%;left:-18px;width:18px;border-top:3px solid #7655eb;content:""}
.promo-env b{display:block;font-size:17px}
.promo-env small{margin-top:3px}
.promo-beneficios{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:28px;margin:18px 12px}
.promo-beneficios-solo{grid-template-columns:minmax(0,680px);justify-content:center}
.promo-calidad{--beneficio-color:#514be8}
.promo-velocidad{--beneficio-color:#31865f}
.promo-ciclo-intro{margin:14px 0 20px;font-size:18px;line-height:1.5}
.promo-fases{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;align-items:start;margin:18px 8px 22px}
.promo-fase{--fase-color:#514be8;--fase-bg:#eef0ff;overflow:hidden;border:4px solid var(--fase-color);border-radius:12px;background:var(--fase-bg)}
.promo-fase h3{min-height:42px;margin:0;padding:8px 10px;background:var(--fase-color);color:#fff;font-size:16px;line-height:1.25;text-align:center}
.promo-fase-dev{--fase-color:#8752e8;--fase-bg:#f3edff}
.promo-fase-qa{--fase-color:#f45d12;--fase-bg:#fff0e7}
.promo-fase-prod{--fase-color:#31865f;--fase-bg:#e5f5eb}
.promo-fase ul{margin:0;padding:10px 12px 12px 27px;list-style:disc;color:#17191d;font-size:14px;line-height:1.4}
.promo-fase li{margin:0 0 5px}
.promo-fase li:last-child{margin-bottom:0}
.promo-garantia{margin:10px 12px 18px;padding:12px 16px;border-radius:8px;background:#f0efff;color:#5e50ef;text-align:center;font-size:17px;line-height:1.45}
.trivia-check-list{margin:16px 0;padding-left:30px;color:#20252a;font-size:17px;line-height:1.5}
.trivia-check-list li{padding-left:4px;margin:0 0 18px}
.trivia-check-list li::marker{color:#5e50ef;font-weight:700}
.trivia-check-list li:last-child{margin-bottom:0}

.recompilar-layout{display:grid;grid-template-columns:minmax(0,1.25fr) minmax(340px,.95fr);gap:36px;align-items:start;margin:20px 12px 24px}
.recompilar-content>p{margin:0 0 14px;font-size:20px;line-height:1.5}
.recompilar-content ul{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:19px;line-height:1.5}
.recompilar-content li{padding-left:2px;margin:0 0 17px}
.recompilar-content li::marker{color:#5e50ef}
.recompilar-invalidez{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f3edff}
.recompilar-invalidez h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;text-align:center;font-size:22px;line-height:1.25}
.recompilar-invalidez h3 .hueco{font-family:inherit;font-size:inherit;font-weight:inherit;color:#fff;background:transparent;border-color:transparent;padding:0 4px}
.recompilar-invalidez p{margin:0;padding:18px 20px;font-size:19px;line-height:1.5;text-align:justify}

.factor3-layout{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:34px;align-items:start;margin:18px 8px 22px}
.factor3-col h3{margin:0 0 18px;color:#514be8;font-size:22px;line-height:1.3;font-weight:700}
.factor3-inyeccion h3{color:#8752e8}
.factor3-col ul{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:17px;line-height:1.5}
.factor3-col li{padding-left:2px;margin:0 0 13px}
.factor3-col li::marker{color:#5e50ef}

.petcattle-layout{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:34px;align-items:start;margin:18px 8px 22px}
.petcattle-col h3{margin:0 0 18px;color:#514be8;font-size:22px;line-height:1.3;font-weight:700}
.petcattle-cattle h3{color:#8752e8}
.petcattle-col ul{margin:0;padding-left:24px;list-style:disc;color:#20252a;font-size:18px;line-height:1.5}
.petcattle-col li{padding-left:2px;margin:0 0 14px}
.petcattle-col li::marker{color:#5e50ef}

.mutable-comparison{width:100%}
.mutable-comparison tr:nth-child(even) td{background:#f1f2f5}
.mutable-comparison td:first-child{white-space:nowrap}

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
.opcion.es-correcta{background:#d7f0dd}
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
      .recompilar-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .factor3-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .petcattle-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .jenkins-orquestador-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
        .regla-impacto{font-size:64px}
        .regla-subtitulo{font-size:19px}
        .regla-oro blockquote{font-size:18px}
        .regla-beneficios,.promo-beneficios{grid-template-columns:1fr;margin-right:0;margin-left:0}
        .promo-fases{grid-template-columns:1fr 1fr;margin-right:0;margin-left:0}
        .promo-garantia{margin-right:0;margin-left:0}
        .promo-flow{grid-template-columns:1fr;margin-right:0;margin-left:0}
        .promo-arrow{transform:rotate(90deg)}
    .taxonomia-grid{grid-template-columns:1fr}
    .repo-types-grid{grid-template-columns:1fr}
    .nexus-flow-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .nexus-manager-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .semver-layout{grid-template-columns:1fr}
    .integridad-layout{grid-template-columns:1fr}
    .sbom-layout{grid-template-columns:1fr}
    .escaneo-grid{grid-template-columns:1fr;gap:20px}
    .oci-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .oci-distribucion-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .manifest-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .manifest-detail-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .ecosistema-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .seguridad-layout{grid-template-columns:1fr;margin-right:0;margin-left:0}
    .tag-alerta{padding:16px 12px}
    .tag-impacto{font-size:72px}
    .tag-subtitulo{font-size:20px}
    .tag-alerta blockquote{font-size:18px}
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
