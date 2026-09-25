<?php
/* ==========================================================================
   motor.php  —  Motor de cuestionarios de Gerencia de Proyectos de T.I.
   Carpeta: htdocs/php_web/GestionProyectos/

   Cada cuestionario vive en una subcarpeta (Grupo001/, Grupo003/) y hace:

       require_once __DIR__ . '/../motor.php';

       $MULTIPLE = [
           'p1' => [
               'texto'    => 'Enunciado...',
               'opciones' => ['a' => '...', 'b' => '...'],   // admite HTML e <img>
               'correcta' => 'b',
               'porque'   => 'Retroalimentacion que sale al verificar.'
           ]
       ];

       $EMPAREJAR = [
           'e1' => [
               'texto'    => 'Clasifique cada uno...',
               'opciones' => ['Ingresos', 'Egresos'],
               'items'    => ['Capacitacion del equipo --> $100' => 'Egresos']
           ]
       ];

       $SOLUCIONES = [                           // huecos de las preguntas abiertas
           1 => 'hibrido',                       // una sola respuesta
           2 => ['predictivo', 'en cascada']     // varias aceptadas
       ];

       iniciar($MULTIPLE, $EMPAREJAR, $SOLUCIONES);
       cabecera('Titulo', 'Subtitulo');
           ... mc('p1') ... empareja('e1') ...
           enunciado('(20 minutos)', 'texto de la pregunta abierta');
           ... texto con hueco(1, 12) intercalado ...
           escribir('a1', $PARTES); apoyo($EXTRA, $RUBRICA);
       pie('../Grupo001/index.php', '');

   Las opciones NO se rotan: el examen se ve en el mismo orden en que lo
   presento el profesor.

   COMO SE COMPARAN LOS HUECOS
   ---------------------------
   Es texto en castellano, no codigo: no importan mayusculas, tildes, el punto
   final ni el articulo de delante. "El Propósito." == "proposito".
   ========================================================================== */

$MC       = [];   // preguntas de opcion multiple
$MCRESP   = [];   // opcion marcada
$MCVERIF  = [];   // 'correcto' | 'incorrecto' | ''
$EMP      = [];   // preguntas de emparejar
$EMPRESP  = [];   // [id][indice] => valor elegido
$EMPVERIF = [];   // [id][indice] => 'correcto' | 'incorrecto' | ''
$SOL      = [];   // soluciones de los huecos
$RESP     = [];   // lo escrito en cada hueco
$VERIF    = [];   // 'correcto' | 'incorrecto' | ''
$ABIERTA  = [];   // texto escrito en las preguntas abiertas
$VER_SOL  = false;

if (!isset($MENU)) $MENU = '../Menu.php';
if (!isset($CSS))  $CSS  = '../../css/bootstrap.min.css';


/* ---------- normalizacion de texto en castellano ----------
   minusculas, sin tildes, sin puntuacion final, sin articulo inicial       */
function _texto($t) {
    $t = (string) $t;
    $t = str_replace("\xC2\xA0", ' ', $t);
    $t = preg_replace('/\s+/u', ' ', $t);
    $t = trim($t);
    $t = function_exists('mb_strtolower') ? mb_strtolower($t, 'UTF-8') : strtolower($t);
    $de = ['á','é','í','ó','ú','ü','ñ','à','è','ì','ò','ù','â','ê','î','ô','û'];
    $a  = ['a','e','i','o','u','u','n','a','e','i','o','u','a','e','i','o','u'];
    $t  = str_replace($de, $a, $t);
    $t  = preg_replace('/[.,;:!?]+$/u', '', $t);
    $t  = preg_replace('/^(el|la|los|las|un|una|de|del) /u', '', $t);
    return trim($t);
}

function _compararTexto($r, $acepta) {
    foreach ($acepta as $a) {
        if (_texto($r) === _texto($a)) return 'correcto';
    }
    return 'incorrecto';
}

function _oficial($n) {
    global $SOL;
    if (!isset($SOL[$n])) return '';
    return is_array($SOL[$n]) ? $SOL[$n][0] : $SOL[$n];
}


/* ---------- arranque: lee el POST y verifica ---------- */
function iniciar($mc = [], $emparejar = [], $soluciones = []) {
    global $MC, $MCRESP, $MCVERIF, $EMP, $EMPRESP, $EMPVERIF,
           $SOL, $RESP, $VERIF, $ABIERTA, $VER_SOL;

    $MC      = $mc;
    $EMP     = $emparejar;
    $SOL     = $soluciones;
    $VER_SOL = isset($_POST['mostrar_solucion']);

    foreach ($SOL as $n => $ok) {
        $acepta = is_array($ok) ? $ok : [$ok];

        if ($VER_SOL) {
            $RESP[$n]  = $acepta[0];
            $VERIF[$n] = 'correcto';
            continue;
        }

        $r        = isset($_POST["respuesta_$n"]) ? $_POST["respuesta_$n"] : '';
        $RESP[$n] = $r;

        if (trim($r) === '') $VERIF[$n] = '';
        else                 $VERIF[$n] = _compararTexto($r, $acepta);
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

    foreach ($EMP as $id => $p) {
        $i = 0;
        foreach ($p['items'] as $item => $ok) {
            if ($VER_SOL) {
                $EMPRESP[$id][$i]  = $ok;
                $EMPVERIF[$id][$i] = 'correcto';
                $i++;
                continue;
            }
            $r = isset($_POST["emp_{$id}_{$i}"]) ? $_POST["emp_{$id}_{$i}"] : '';
            $EMPRESP[$id][$i] = $r;

            if ($r === '')     $EMPVERIF[$id][$i] = '';
            elseif ($r === $ok) $EMPVERIF[$id][$i] = 'correcto';
            else                $EMPVERIF[$id][$i] = 'incorrecto';
            $i++;
        }
    }

    foreach ($_POST as $k => $v) {
        if (strpos($k, 'abierta_') === 0) $ABIERTA[substr($k, 8)] = $v;
    }
}


/* ---------- utilidades internas ---------- */
function _clase($c) {
    if ($c === 'correcto')   return 'ok';
    if ($c === 'incorrecto') return 'bad';
    return '';
}

function _marca($c) {
    if ($c === 'correcto')   return '<span class="mk ok">&#10004;</span>';
    if ($c === 'incorrecto') return '<span class="mk bad">&#10008;</span>';
    return '';
}


/* ---------- una pregunta de opcion multiple ---------- */
function mc($id) {
    global $MC, $MCRESP, $MCVERIF;
    if (!isset($MC[$id])) return;

    $p = $MC[$id];
    $r = isset($MCRESP[$id])  ? $MCRESP[$id]  : '';
    $c = isset($MCVERIF[$id]) ? $MCVERIF[$id] : '';

    echo '<div class="pregunta ' . _clase($c) . '">';
    if (isset($p['minutos'])) echo '<div class="minutos">(' . $p['minutos'] . ')</div>';
    echo '<div class="enunciado">' . $p['texto'] . ' ' . _marca($c) . '</div>';

    foreach ($p['opciones'] as $clave => $texto) {
        $checked = ($r === (string) $clave) ? ' checked' : '';
        $marca   = ($c !== '' && $clave === $p['correcta']) ? ' es-correcta' : '';
        echo '<label class="opcion' . $marca . '">';
        echo '<input type="radio" name="mc_' . $id . '" value="' . $clave . '"' . $checked . '> ';
        echo '<b>' . $clave . ')</b> ' . $texto;
        echo '</label>';
    }

    if ($c !== '' && isset($p['porque'])) {
        echo '<p class="porque">&#128161; ' . $p['porque'] . '</p>';
    }
    echo '</div>';
}


/* ---------- una pregunta de emparejar (listas desplegables) ---------- */
function empareja($id) {
    global $EMP, $EMPRESP, $EMPVERIF;
    if (!isset($EMP[$id])) return;

    $p    = $EMP[$id];
    $ok   = 0;
    $tot  = count($p['items']);
    foreach ($EMPVERIF[$id] as $v) if ($v === 'correcto') $ok++;
    $hay  = false;
    foreach ($EMPVERIF[$id] as $v) if ($v !== '') $hay = true;

    echo '<div class="pregunta empareja' . ($hay ? ($ok === $tot ? ' ok' : ' bad') : '') . '">';
    if (isset($p['minutos'])) echo '<div class="minutos">(' . $p['minutos'] . ')</div>';
    echo '<div class="enunciado">' . $p['texto']
       . ($hay ? ' <span class="parcial">' . $ok . ' / ' . $tot . '</span>' : '') . '</div>';

    echo '<table class="empa">';
    $i = 0;
    foreach ($p['items'] as $item => $bueno) {
        $r = isset($EMPRESP[$id][$i]) ? $EMPRESP[$id][$i] : '';
        $c = isset($EMPVERIF[$id][$i]) ? $EMPVERIF[$id][$i] : '';

        echo '<tr class="' . _clase($c) . '">';
        echo '<td class="it">' . $item . '</td>';
        echo '<td class="se">';
        echo '<select name="emp_' . $id . '_' . $i . '" class="sel ' . _clase($c) . '">';
        echo '<option value="">— elegir —</option>';
        foreach ($p['opciones'] as $op) {
            $sel = ($r === $op) ? ' selected' : '';
            echo '<option value="' . htmlspecialchars($op, ENT_QUOTES, 'UTF-8') . '"' . $sel . '>'
               . htmlspecialchars($op, ENT_QUOTES, 'UTF-8') . '</option>';
        }
        echo '</select> ' . _marca($c);
        if ($c === 'incorrecto') {
            echo '<div class="corregida">' . htmlspecialchars($bueno, ENT_QUOTES, 'UTF-8') . '</div>';
        }
        echo '</td></tr>';
        $i++;
    }
    echo '</table>';

    if ($hay && isset($p['porque'])) {
        echo '<p class="porque">&#128161; ' . $p['porque'] . '</p>';
    }
    echo '</div>';
}


/* ---------- pregunta abierta, partida en sub-respuestas ----------
   No puntua (nadie corrige un parrafo automaticamente), pero cada parte se
   escribe por separado, guarda lo escrito al verificar, deja ver esa parte
   resuelta, y "Mostrar solucion" rellena cada casilla con su modelo.

   $partes = [
       ['t' => 'Enfoque general',      // etiqueta de la sub-respuesta
        'ayuda' => 'una sola palabra', // pista opcional
        'filas' => 2,                  // alto del cuadro, por defecto 3
        'modelo' => 'Hibrido.'],       // TEXTO PLANO: es lo que se escribe
       ...
   ];
   $extra   = HTML con la ampliacion y la retroalimentacion del profesor.
   $rubrica = HTML con los criterios de calificacion.                        */
function enunciado($minutos, $texto) {
    echo '<div class="pregunta abierta">';
    if ($minutos !== '') echo '<div class="minutos">' . $minutos . '</div>';
    echo '<div class="enunciado">' . $texto . '</div>';
    echo '</div>';
}


/* ---------- un hueco dentro de la respuesta modelo ---------- */
function hueco($n, $size = 14) {
    global $RESP, $VERIF;

    $v = isset($RESP[$n])  ? htmlspecialchars($RESP[$n], ENT_QUOTES, 'UTF-8') : '';
    $c = isset($VERIF[$n]) ? $VERIF[$n] : '';

    echo '<span class="hbox">';
    echo '<input type="text" class="hueco ' . _clase($c) . '"'
       . ' name="respuesta_' . $n . '" id="respuesta_' . $n . '"'
       . ' value="' . $v . '" size="' . $size . '"'
       . ' title="hueco ' . $n . '" autocomplete="off" spellcheck="false">';
    echo _marca($c);
    if ($c === 'incorrecto') {
        echo '<span class="corr">' . htmlspecialchars(_oficial($n), ENT_QUOTES, 'UTF-8') . '</span>';
    }
    echo '</span>';
}


/* ---------- bloque de respuesta modelo con huecos ---------- */
function respuestaIni($titulo = 'Completa la respuesta') {
    echo '<div class="modelo-huecos"><div class="mh-tit">' . $titulo . '</div>';
}

function respuestaFin() {
    echo '</div>';
}


/* ---------- escribirlo con tus palabras (plegado, no puntua) ---------- */
function escribir($id, $partes) {
    global $ABIERTA, $VER_SOL;

    echo '<details class="desp escribir"' . ($VER_SOL ? ' open' : '') . '>';
    echo '<summary>Escribirlo con mis palabras (' . count($partes) . ' partes)</summary>';
    echo '<div class="cont">';

    $k = 0;
    foreach ($partes as $p) {
        $key    = $id . '_' . $k;
        $modelo = isset($p['modelo']) ? $p['modelo'] : '';
        $filas  = isset($p['filas'])  ? $p['filas']  : 3;

        if ($VER_SOL) {
            $v = htmlspecialchars($modelo, ENT_QUOTES, 'UTF-8');
        } else {
            $v = isset($ABIERTA[$key]) ? htmlspecialchars($ABIERTA[$key], ENT_QUOTES, 'UTF-8') : '';
        }

        echo '<div class="parte' . ($VER_SOL ? ' resuelta' : '') . '">';
        echo '<div class="pt"><span class="pn">' . ($k + 1) . '</span>' . $p['t'] . '</div>';
        if (isset($p['ayuda'])) echo '<div class="pista">' . $p['ayuda'] . '</div>';
        echo '<textarea name="abierta_' . $key . '" rows="' . $filas . '"'
           . ' class="hueco bloque" placeholder="tu respuesta...">' . $v . '</textarea>';

        if ($modelo !== '' && !$VER_SOL) {
            echo '<details class="desp modelo"><summary>Ver esta parte resuelta</summary>'
               . '<div class="cont">' . nl2br(htmlspecialchars($modelo, ENT_QUOTES, 'UTF-8'))
               . '</div></details>';
        }
        echo '</div>';
        $k++;
    }

    echo '</div></details>';
}


/* ---------- rubrica y material, siempre plegados ---------- */
function apoyo($extra = '', $rubrica = '') {
    global $VER_SOL;

    if ($rubrica !== '') {
        echo '<details class="desp"' . ($VER_SOL ? ' open' : '') . '>';
        echo '<summary>Rubrica de calificacion</summary><div class="cont">' . $rubrica . '</div>';
        echo '</details>';
    }
    if ($extra !== '') {
        echo '<details class="desp modelo"' . ($VER_SOL ? ' open' : '') . '>';
        echo '<summary>Ampliacion, material del curso y retroalimentacion del profesor</summary>';
        echo '<div class="cont">' . $extra . '</div></details>';
    }
}


/* ---------- boton de enviar intermedio ---------- */
function enviar($etiqueta = 'Verificar esta parte') {
    echo '<div class="acciones"><button type="submit" class="btn-ok">' . $etiqueta . '</button></div>';
}


/* ---------- contador de aciertos ---------- */
function _puntaje() {
    global $MCVERIF, $EMPVERIF, $VERIF;
    $ok = 0; $mal = 0; $vacio = 0;
    foreach ($VERIF as $v) {
        if     ($v === 'correcto')   $ok++;
        elseif ($v === 'incorrecto') $mal++;
        else                         $vacio++;
    }
    foreach ($MCVERIF as $v) {
        if     ($v === 'correcto')   $ok++;
        elseif ($v === 'incorrecto') $mal++;
        else                         $vacio++;
    }
    foreach ($EMPVERIF as $filas) {
        foreach ($filas as $v) {
            if     ($v === 'correcto')   $ok++;
            elseif ($v === 'incorrecto') $mal++;
            else                         $vacio++;
        }
    }
    return [$ok, $mal, $vacio, $ok + $mal + $vacio];
}


/* ---------- cabecera de pagina ---------- */
function cabecera($titulo, $subtitulo = '') {
    global $VER_SOL, $MENU, $CSS;
    list($ok, $mal, $vacio, $total) = _puntaje();
    $pct = $total ? round($ok * 100 / $total) : 0;
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
.card p{margin:10px 0}
.nota{background:#fff8e1;border-left:4px solid #f0b429;padding:10px 14px;
      border-radius:0 8px 8px 0;font-size:14.5px;margin:14px 0}
code{background:#eef0f3;padding:2px 6px;border-radius:4px;
     font-family:Consolas,Menlo,monospace;font-size:.92em;color:#b02a5b}

/* ---- preguntas ---- */
.pregunta{border:1px solid var(--borde);border-left:4px solid #9aa3ad;
          border-radius:8px;padding:14px 18px;margin:16px 0;background:#fcfcfd}
.pregunta.ok{border-left-color:var(--verde);background:var(--verde-bg)}
.pregunta.bad{border-left-color:var(--rojo);background:var(--rojo-bg)}
.pregunta .enunciado{font-weight:600;margin:0 0 10px}
.pregunta .minutos{font-size:12.5px;color:#7a8494;margin-bottom:4px}
.opcion{display:block;padding:7px 10px;border-radius:6px;cursor:pointer;font-size:15px;
        font-weight:400;border:1px solid transparent}
.opcion:hover{background:rgba(44,90,160,.07)}
.opcion.es-correcta{background:#d7f0dd;font-weight:600;border-color:#9fd6b0}
.opcion img{display:block;max-width:100%;height:auto;margin:8px 0;border:1px solid var(--borde);
            border-radius:8px;background:#fff}
.mk{font-weight:700;margin-left:4px}
.mk.ok{color:var(--verde)}
.mk.bad{color:var(--rojo)}
.porque{margin:12px 0 0;font-size:14px;background:#fff;border-radius:6px;
        padding:8px 12px;border:1px dashed var(--borde)}
.parcial{background:#fff;border:1px solid var(--borde);border-radius:20px;
         padding:1px 10px;font-size:13px;color:#3c4654;margin-left:6px}

/* ---- emparejar ---- */
table.empa{width:100%;border-collapse:collapse;margin-top:6px;font-weight:400}
table.empa td{border-top:1px solid var(--borde);padding:8px 6px;vertical-align:middle;font-size:14.5px}
table.empa td.it{width:64%}
table.empa tr.ok td{background:rgba(26,127,55,.07)}
table.empa tr.bad td{background:rgba(192,57,43,.07)}
.sel{font-size:14px;padding:4px 8px;border:2px solid #9aa3ad;border-radius:5px;
     background:#fffbe8;max-width:100%}
.sel.ok{border-color:var(--verde);background:var(--verde-bg)}
.sel.bad{border-color:var(--rojo);background:var(--rojo-bg)}
.corregida{margin-top:5px;font-size:13px;background:var(--verde-bg);color:#12602a;
           border-left:3px solid var(--verde);padding:4px 9px;border-radius:0 6px 6px 0;
           display:inline-block}

/* ---- huecos dentro de la respuesta modelo ---- */
.modelo-huecos{background:#fff;border:1px solid var(--borde);border-left:4px solid var(--azul);
               border-radius:8px;padding:14px 18px;margin:14px 0;line-height:2.5;font-size:15px}
.modelo-huecos .mh-tit{font-weight:600;font-size:14px;color:var(--azul);margin:0 0 10px;
                       line-height:1.5;text-transform:uppercase;letter-spacing:.03em}
.modelo-huecos p{margin:6px 0 14px}
.modelo-huecos p:last-child{margin-bottom:0}
.modelo-huecos .avisoflujo{background:#eef4ff;border-left:4px solid var(--azul);padding:9px 13px;
              border-radius:0 8px 8px 0;font-size:14px;line-height:1.6;margin:14px 0 0}
.modelo-huecos .sub{font-weight:600;color:#2f3a48;line-height:1.5;margin:16px 0 2px;font-size:14.5px}
.hbox{display:inline-block;white-space:nowrap}
.hueco{font-size:14.5px;border:2px solid #9aa3ad;border-radius:5px;padding:2px 8px;
       background:#fffbe8;color:#1f2733;outline:none;font-family:inherit}
.hueco:focus{border-color:var(--azul);box-shadow:0 0 0 3px rgba(44,90,160,.18)}
.hueco.ok{border-color:var(--verde);background:var(--verde-bg)}
.hueco.bad{border-color:var(--rojo);background:var(--rojo-bg)}
.corr{font-size:13px;margin-left:6px;background:var(--verde-bg);color:#12602a;
      padding:2px 8px;border-radius:4px;font-weight:600}

/* ---- abiertas ---- */
.pregunta.abierta{border-left-color:var(--azul)}
details.escribir{border-left:4px solid #9aa3ad}
.parte{margin:14px 0;padding:12px 14px;background:#fff;border:1px solid var(--borde);
       border-radius:8px;font-weight:400}
.parte.resuelta{border-color:#9fd6b0;background:var(--verde-bg)}
.parte .pt{font-weight:600;font-size:15px;margin:0 0 6px;display:flex;gap:8px;align-items:baseline}
.parte .pn{flex:0 0 auto;background:var(--azul);color:#fff;border-radius:50%;width:22px;height:22px;
           line-height:22px;text-align:center;font-size:12.5px;font-weight:700}
.parte .pista{font-size:13.5px;color:#6b7684;margin:0 0 8px;padding-left:30px}
.parte details.desp{margin-top:8px;padding:6px 10px}
.parte details.desp summary{font-size:13px}
.hueco.bloque{width:100%;font-size:14px;padding:9px 12px;background:#fffbe8;line-height:1.6;
              border:2px solid #9aa3ad;border-radius:6px;resize:vertical;outline:none}
.hueco.bloque:focus{border-color:var(--azul);box-shadow:0 0 0 3px rgba(44,90,160,.18)}
details.desp{margin-top:10px;background:#fff;border:1px solid var(--borde);border-radius:8px;
             padding:8px 12px;font-weight:400}
details.desp summary{cursor:pointer;font-size:14px;color:var(--azul);font-weight:600}
details.desp .cont{margin-top:8px;font-size:14.5px;border-top:1px solid #eceff3;padding-top:8px}
details.desp .cont ul{margin:6px 0 6px 18px;padding:0}
details.modelo{border-left:4px solid var(--verde)}
.fuente{margin:10px 0 0;font-size:13px;color:#5a6472;background:#eef4ff;border-left:3px solid var(--azul);
        padding:6px 10px;border-radius:0 6px 6px 0}
.fuente b{color:#2f3a48}

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
  table.empa td.it{width:100%;display:block;border-top:1px solid var(--borde)}
  table.empa td.se{width:100%;display:block;border-top:0;padding-top:0}
}
</style>
<script>
function enviarForm(e){
    e.preventDefault();
    var form = e.target;
    var fd   = new FormData(form);
    var s    = e.submitter;
    if (s && s.name) fd.append(s.name, s.value);

    /* Al verificar se repinta la pagina entera. Guardamos el scroll, que
       desplegables estaban abiertos y en que hueco estaba el cursor, para poder
       ir contestando hueco a hueco sin perder el sitio. */
    var scrollY  = window.pageYOffset;
    var abiertos = [].map.call(document.querySelectorAll('details'), function(d){ return d.open; });
    var foco     = document.activeElement ? document.activeElement.id : '';

    fetch(window.location.pathname, {method:'POST', body: fd})
        .then(function(r){ return r.text(); })
        .then(function(html){
            var doc = new DOMParser().parseFromString(html, 'text/html');
            document.body.innerHTML = doc.body.innerHTML;
            var ds = document.querySelectorAll('details');
            for (var i = 0; i < ds.length && i < abiertos.length; i++) ds[i].open = abiertos[i];
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

/* Enter dentro de un hueco = verificar, sin bajar hasta el boton */
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
    <?php if ($mal   > 0): ?> &nbsp;<span class="m"><?= $mal ?> mal</span><?php endif; ?>
    <?php if ($vacio > 0): ?> &nbsp;<span style="opacity:.6"><?= $vacio ?> en blanco</span><?php endif; ?>
  </div>
  <a href="<?= $MENU ?>">&#8962; Menu</a>
</div>

<?php if ($VER_SOL): ?>
<div class="wrap" style="padding-bottom:0">
  <div class="nota"><b>Modo solucion.</b> Todas las opciones estan marcadas con la respuesta correcta
  y las preguntas abiertas aparecen con la retroalimentacion desplegada.
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
