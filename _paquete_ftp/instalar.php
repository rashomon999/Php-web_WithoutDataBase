<?php
/* =========================================================================
   instalar.php  —  descomprime sitio_01.zip ... sitio_09.zip en el servidor

   COMO SE USA
   1. Sube por FTP este archivo y los sitio_*.zip a la carpeta htdocs/
   2. Abre en el navegador:  https://TU-DOMINIO/instalar.php
   3. Se va refrescando solo hasta terminar.
   4. BORRA instalar.php, los sitio_*.zip y instalar_estado.json cuando acabe.
   ========================================================================= */

@set_time_limit(0);
@ini_set('memory_limit', '256M');

const ESTADO   = __DIR__ . '/instalar_estado.json';
const SEGUNDOS = 12;   // cuanto trabaja cada pasada antes de refrescar

function zips(): array {
    $z = glob(__DIR__ . '/sitio_*.zip');
    sort($z);
    return $z;
}

function leerEstado(): array {
    if (is_file(ESTADO)) {
        $d = json_decode((string)file_get_contents(ESTADO), true);
        if (is_array($d) && isset($d['zip'], $d['idx'], $d['hechos'])) return $d;
    }
    return ['zip' => 0, 'idx' => 0, 'hechos' => 0, 'errores' => []];
}

function guardarEstado(array $e): void {
    file_put_contents(ESTADO, json_encode($e));
}

function html(string $cuerpo, bool $refrescar = false): void {
    $meta = $refrescar ? '<meta http-equiv="refresh" content="1">' : '';
    echo "<!DOCTYPE html><html lang=\"es\"><head><meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">$meta
    <title>Instalando el sitio</title><style>
    body{font-family:-apple-system,Segoe UI,Arial,sans-serif;background:#f4f5f7;color:#22262b;
         margin:0;display:flex;min-height:100vh;align-items:center;justify-content:center;padding:20px}
    .caja{background:#fff;border:1px solid #d8dbe0;border-radius:10px;padding:28px 32px;
          max-width:620px;width:100%;box-shadow:0 2px 14px rgba(0,0,0,.07)}
    h1{font-size:20px;margin:0 0 14px}
    .barra{height:12px;background:#e9ecef;border-radius:6px;overflow:hidden;margin:18px 0 8px}
    .barra i{display:block;height:100%;background:#2c5aa0;transition:width .3s}
    .chico{font-size:13px;color:#5d666f}
    ul{font-size:14px;padding-left:20px}
    .ok{color:#1c7c4a;font-weight:600}
    .mal{color:#b3261e}
    code{background:#f0f2f5;padding:2px 6px;border-radius:4px;font-size:13px}
    </style></head><body><div class=\"caja\">$cuerpo</div></body></html>";
    exit;
}

/* ---------- comprobaciones previas ---------- */
$zips = zips();

if (!class_exists('ZipArchive')) {
    html('<h1>Falta la extensión ZipArchive</h1>
          <p class="chico">Este hosting no puede descomprimir por PHP. Tendrás que subir
          los archivos sueltos por FTP.</p>');
}
if (!$zips) {
    html('<h1>No encuentro los .zip</h1>
          <p class="chico">Sube <code>sitio_01.zip</code> … <code>sitio_09.zip</code> a esta
          misma carpeta y recarga.</p>');
}
if (!is_writable(__DIR__)) {
    html('<h1>La carpeta no tiene permisos de escritura</h1>');
}

/* ---------- reiniciar ---------- */
if (isset($_GET['reiniciar'])) {
    @unlink(ESTADO);
    header('Location: instalar.php');
    exit;
}

/* ---------- trabajo ---------- */
$e     = leerEstado();
$total = 0;
foreach ($zips as $z) {
    $za = new ZipArchive();
    if ($za->open($z) === true) { $total += $za->numFiles; $za->close(); }
}

$inicio = microtime(true);

while ($e['zip'] < count($zips) && (microtime(true) - $inicio) < SEGUNDOS) {

    $ruta = $zips[$e['zip']];
    $za   = new ZipArchive();

    if ($za->open($ruta) !== true) {
        $e['errores'][] = 'No se pudo abrir ' . basename($ruta);
        $e['zip']++; $e['idx'] = 0;
        continue;
    }

    $n = $za->numFiles;

    while ($e['idx'] < $n && (microtime(true) - $inicio) < SEGUNDOS) {
        $nombre = $za->getNameIndex($e['idx']);

        // seguridad: nada de rutas absolutas ni ../
        if ($nombre === false || $nombre === '' || $nombre[0] === '/'
            || strpos($nombre, '..') !== false) {
            $e['idx']++;
            continue;
        }

        if (substr($nombre, -1) === '/') {
            @mkdir(__DIR__ . '/' . $nombre, 0755, true);
        } else {
            $destino = __DIR__ . '/' . $nombre;
            $carpeta = dirname($destino);
            if (!is_dir($carpeta)) @mkdir($carpeta, 0755, true);

            $entrada = $za->getStream($nombre);
            if ($entrada) {
                $salida = @fopen($destino, 'wb');
                if ($salida) {
                    stream_copy_to_stream($entrada, $salida);
                    fclose($salida);
                } else {
                    $e['errores'][] = 'No pude escribir ' . $nombre;
                }
                fclose($entrada);
            } else {
                $e['errores'][] = 'No pude leer ' . $nombre;
            }
        }

        $e['idx']++;
        $e['hechos']++;
    }

    $za->close();

    if ($e['idx'] >= $n) { $e['zip']++; $e['idx'] = 0; }
}

guardarEstado($e);

/* ---------- pantalla ---------- */
$pct   = $total > 0 ? min(100, round($e['hechos'] * 100 / $total)) : 0;
$fin   = $e['zip'] >= count($zips);
$errs  = array_slice($e['errores'], 0, 10);
$lista = $errs ? '<p class="mal">Avisos:</p><ul class="mal"><li>'
                 . implode('</li><li>', array_map('htmlspecialchars', $errs))
                 . '</li></ul>' : '';

if ($fin) {
    html("<h1 class=\"ok\">Listo</h1>
    <p>Se extrajeron <strong>{$e['hechos']}</strong> archivos.</p>
    <div class=\"barra\"><i style=\"width:100%\"></i></div>
    $lista
    <p class=\"chico\"><strong>Ahora borra por FTP</strong>: <code>instalar.php</code>,
    <code>instalar_estado.json</code> y todos los <code>sitio_*.zip</code>.
    Ocupan sitio y no hacen falta.</p>
    <p><a href=\"index.php\">Ir al sitio &rarr;</a></p>");
}

$zipActual = $e['zip'] + 1;
$totalZips = count($zips);
html("<h1>Instalando…</h1>
<p class=\"chico\">Paquete $zipActual de $totalZips · {$e['hechos']} de $total archivos</p>
<div class=\"barra\"><i style=\"width:{$pct}%\"></i></div>
<p class=\"chico\">$pct % — no cierres esta pestaña, se refresca sola.</p>
$lista
<p class=\"chico\"><a href=\"instalar.php?reiniciar=1\">empezar de cero</a></p>", true);
