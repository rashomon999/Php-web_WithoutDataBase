<?php
// ---------- Datos del cuestionario ----------
// Basado en los primeros 16 minutos de "Introducción a la Biblia desde un punto de vista académico" (Matt Baker).
// Cada pregunta: 'opciones' (clave => texto) y 'correcta' (clave de la opción correcta).
$q1 = [
    'pregunta' => '¿De qué otra forma se le conoce a la Biblia judía?',
    'opciones' => [
        'a' => 'Tanaj',
        'b' => 'Talmud',
        'c' => 'Vulgata',
        'd' => 'Corán',
    ],
    'correcta' => 'a',
    'explicacion' => "La Biblia judía también se conoce como 'Tanaj'. El Talmud es un libro distinto (tradiciones orales y comentarios rabínicos); el Corán y la Vulgata no son textos judíos.",
];
$q2 = [
    'pregunta' => "¿Qué significa 'Pentateuco'?",
    'opciones' => [
        'a' => 'La ley de Moisés',
        'b' => 'Los cinco rollos',
        'c' => 'El libro sagrado',
        'd' => 'Las cinco tribus',
    ],
    'correcta' => 'b',
    'explicacion' => "Pentateuco viene del griego y significa 'los cinco rollos', refiriéndose a Génesis-Deuteronomio.",
];
$q3 = [
    'pregunta' => 'En la Hipótesis Documental clásica, ¿qué significan las siglas J, E, D y P?',
    'opciones' => [
        'a' => 'Jahvista, Elohista, Deuteronomista, Sacerdotal (Priestly)',
        'b' => 'Josué, Esdras, Daniel, Proverbios',
        'c' => 'Judá, Efraín, David, Palestina',
        'd' => 'Jerusalén, Egipto, Damasco, Persia',
    ],
    'correcta' => 'a',
    'explicacion' => 'Son las cuatro fuentes propuestas por la hipótesis clásica del siglo XIX: Jahvista, Elohista, Deuteronomista y Sacerdotal.',
];
$q4 = [
    'pregunta' => 'Según la Hipótesis Suplementaria, ¿cuál fue el núcleo original de la Torá, escrito hacia la época del rey Josías?',
    'opciones' => [
        'a' => 'Génesis',
        'b' => 'Éxodo',
        'c' => 'Levítico',
        'd' => 'Deuteronomio',
    ],
    'correcta' => 'd',
    'explicacion' => 'Deuteronomio (D) habría sido el texto original, con J/E añadidos durante el exilio babilónico y P durante el Segundo Templo.',
];
$q5 = [
    'pregunta' => "¿Cuál es la idea central de la 'Teoría de los Orígenes Duales' (Konrad Schmid)?",
    'opciones' => [
        'a' => 'Toda la Torá fue escrita por Moisés mismo',
        'b' => 'Hubo dos mitos de origen independientes (patriarcas y Éxodo) unidos después por sacerdotes',
        'c' => 'La Torá se escribió completa durante el reinado de Salomón',
        'd' => 'El Talmud es la fuente principal de la Torá',
    ],
    'correcta' => 'b',
    'explicacion' => 'La teoría propone que la tradición de Abraham/Isaac/Jacob (sur) y la tradición de Moisés/Éxodo (norte) se desarrollaron por separado y fueron combinadas por escritores sacerdotales en el Segundo Templo.',
];
$q6 = [
    'pregunta' => 'Según la Hipótesis Documental, ¿cuáles libros del Pentateuco son una mezcla de varias fuentes (J, E y P)?',
    'opciones' => [
        'a' => 'Génesis, Éxodo y Números',
        'b' => 'Levítico y Deuteronomio',
        'c' => 'Solo Génesis',
        'd' => 'Los cinco libros por igual',
    ],
    'correcta' => 'a',
    'explicacion' => 'Génesis, Éxodo y Números combinan material de varias fuentes; Levítico es enteramente P y Deuteronomio es enteramente D.',
];
$q7 = [
    'pregunta' => "¿Qué es un 'doblete' en el contexto de la Torá, según el video?",
    'opciones' => [
        'a' => 'Un libro escrito dos veces por el mismo autor',
        'b' => 'Dos versiones separadas de una misma historia (p. ej. dos relatos de la creación)',
        'c' => 'Una traducción doble del hebreo al griego',
        'd' => 'Un error de copista corregido después',
    ],
    'correcta' => 'b',
    'explicacion' => 'Los dobletes (como las dos historias de la creación, o Dios cambiando el nombre de Jacob a Israel dos veces) son evidencia de que varias tradiciones orales se combinaron por escrito.',
];

$preguntas = ['p1' => $q1, 'p2' => $q2, 'p3' => $q3, 'p4' => $q4, 'p5' => $q5, 'p6' => $q6, 'p7' => $q7];

function esCorrecta($key, $preguntas) {
    $u = $_POST[$key] ?? null;
    return $u !== null && $u === $preguntas[$key]['correcta'];
}

$enviado = ($_SERVER['REQUEST_METHOD'] === 'POST');
$mostrar = $enviado && ($_POST['accion'] ?? '') === 'mostrar';
$evaluar = $enviado && !$mostrar;

function pregunta($key, $preguntas) {
    global $evaluar, $mostrar;
    $p = $preguntas[$key];
    $seleccion = $mostrar ? $p['correcta'] : ($_POST[$key] ?? null);
    $html = '<div class="pregunta-bloque">';
    $html .= '<p class="enunciado">' . htmlspecialchars($p['pregunta'], ENT_QUOTES) . '</p>';
    $html .= '<ul class="opciones">';
    foreach ($p['opciones'] as $ok => $texto) {
        $marcada = $seleccion === $ok ? ' checked' : '';
        $clase = '';
        if ($mostrar && $ok === $p['correcta']) $clase = ' class="ok"';
        elseif ($evaluar) {
            if ($ok === $p['correcta']) $clase = ' class="ok"';
            elseif ($ok === $seleccion) $clase = ' class="mal"';
        }
        $disabled = ($mostrar || $evaluar) ? ' disabled' : '';
        $html .= "<li$clase><label><input type=\"radio\" name=\"$key\" value=\"$ok\"$marcada$disabled> " . htmlspecialchars($texto, ENT_QUOTES) . '</label>';
        if (($mostrar || $evaluar) && $ok === $p['correcta']) $html .= ' <span class="v">✔</span>';
        if ($evaluar && $ok === $seleccion && $ok !== $p['correcta']) $html .= ' <span class="x">✘</span>';
        $html .= '</li>';
    }
    $html .= '</ul>';
    if (($mostrar || $evaluar) && !empty($p['explicacion'])) {
        $html .= '<p class="explicacion">' . htmlspecialchars($p['explicacion'], ENT_QUOTES) . '</p>';
    }
    $html .= '</div>';
    return $html;
}

$total = 0;
if ($evaluar) {
    foreach ($preguntas as $k => $_) if (esCorrecta($k, $preguntas)) $total++;
}
$max = count($preguntas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>¿Quién escribió la Biblia? — Cuestionario</title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../style.css">
<style>
    body { font-family: Arial, sans-serif; max-width: 900px; margin: 20px auto; padding: 0 15px; color: #333; line-height: 1.8; }
    h2 { color: #d32f2f; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin-top: 10px; }
    .inst { font-size: 14px; color: #555; }
    .pregunta-bloque { margin-bottom: 34px; }
    .enunciado { font-weight: bold; margin-bottom: 8px; }
    ul.opciones { list-style: none; padding-left: 0; }
    ul.opciones li { padding: 6px 10px; border-radius: 4px; margin-bottom: 4px; }
    ul.opciones li.ok  { background: #e8f5e9; }
    ul.opciones li.mal { background: #ffebee; }
    .v { color: #2e7d32; font-weight: bold; }
    .x { color: #c62828; font-weight: bold; }
    .explicacion { font-size: 14px; color: #455a64; background: #f3f7fc; border-left: 3px solid #1B5FA8; padding: 8px 12px; margin-top: 8px; }
    .nota-total { text-align: center; font-size: 18px; margin: 30px 0; }
    .botones { text-align: center; margin: 40px 0; }
    .btn, button { display: inline-block; background: #455a64; color: #fff; border: 0; padding: 8px 26px; margin: 4px; border-radius: 3px;
                   font-size: 14px; cursor: pointer; text-decoration: none; line-height: normal; }
    .btn:hover, button:hover { background: #263238; color: #fff; }
</style>
<script>
function reemplazar(html, y) {
    const doc = new DOMParser().parseFromString(html, 'text/html');
    document.getElementById('contenido').innerHTML = doc.getElementById('contenido').innerHTML;
    window.scrollTo(0, y);
}
function handleSubmit(event) {
    event.preventDefault();
    const y = window.scrollY;
    const formData = new FormData(event.target);
    formData.set('accion', event.submitter && event.submitter.value ? event.submitter.value : 'enviar');
    fetch('./index.php', { method: 'POST', body: formData })
        .then(r => r.text()).then(html => reemplazar(html, y))
        .catch(e => console.error('Error al enviar el formulario:', e));
}
function reintentar() {
    const y = window.scrollY;
    fetch('./index.php').then(r => r.text()).then(html => reemplazar(html, y));
}
</script>
</head>
<body>
<div id="contenido">
<form method="POST" action="./index.php" onsubmit="handleSubmit(event)" autocomplete="off">

<h2>¿Quién escribió la Biblia? <?php if ($evaluar): ?><span style="float:right;border:1px solid #ccc;padding:2px 12px;font-size:14px;"><?= $total ?>/<?= $max ?></span><?php endif; ?></h2>
<p class="inst">Basado en la introducción académica de Matt Baker sobre la autoría del Pentateuco/Torá. Elige la opción correcta en cada pregunta.</p>

<?php foreach ($preguntas as $key => $p) echo pregunta($key, $preguntas); ?>

<?php if ($evaluar): ?>
    <p class="nota-total"><strong>Total: <?= $total ?>/<?= $max ?> (<?= round($total / $max * 100) ?>%)</strong></p>
<?php endif; ?>

<div class="botones">
    <a class="btn" href="../Menu.php">Salir</a>
    <button type="submit" name="accion" value="enviar">Enviar</button>
    <button type="submit" name="accion" value="mostrar">Mostrar respuestas</button>
    <button type="button" onclick="reintentar()">Vuelva a intentarlo</button>
</div>

</form>
</div>
</body>
</html>
