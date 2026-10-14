<?php
// ---------- Datos de los ejercicios ----------
// Respuestas aceptadas separadas por |. Se comparan sin mayúsculas, signos de puntuación ni espacios extra.
$ex3 = [
    'a2' => 'What are these headaches like',
    'a3' => 'What causes the headaches, do you think|What do you think causes the headaches',
    'a4' => 'What are you thinking about at the moment',
    'a5' => 'Does that clock remind you of anything',
    'a6' => 'Why is that',
    'a7' => 'OK. How would you like to pay - cash or credit card|How would you like to pay - cash or credit card',
];
$ex4a = [
    'b2' => 'asking how much your camera',
    'b3' => 'telling me what you',
    'b4' => 'whether it is really',
    'b5' => 'the Eurostar train leaves',
    'b6' => 'think he will do',
];
$ex5 = [
    'c2' => "in knowing how you think you've changed|to know how you think you've changed",
    'c3' => 'what you have done that you are most proud of',
    'c4' => 'if it is possible for a person to stay the same all his life|whether it is possible for a person to stay the same all his life',
    'c5' => 'me who has influenced you the most',
    'c6' => 'if you would like to direct a movie yourself|whether you would like to direct a movie yourself',
];

function norm($s) {
    $s = strtolower(trim((string)$s));
    $s = str_replace(['’', '‘'], "'", $s);
    $s = preg_replace("/[^a-z0-9 ]/", ' ', $s);   // quita puntuación
    return trim(preg_replace('/\s+/', ' ', $s));
}
function esCorrecta($key, $lista) {
    $u = norm($_POST[$key] ?? '');
    if ($u === '') return false;
    foreach (explode('|', $lista[$key]) as $ok) if ($u === norm($ok)) return true;
    return false;
}

$enviado = ($_SERVER['REQUEST_METHOD'] === 'POST');
$mostrar = $enviado && ($_POST['accion'] ?? '') === 'mostrar';
$evaluar = $enviado && !$mostrar;

function campo($key, $lista, $ancho = 150) {
    global $evaluar, $mostrar;
    $primera = explode('|', $lista[$key])[0];
    $valor = $mostrar ? $primera : ($_POST[$key] ?? '');
    $clase = '';
    if ($mostrar) $clase = 'ok';
    elseif ($evaluar) $clase = esCorrecta($key, $lista) ? 'ok' : 'mal';
    $marca = $clase === 'ok' ? ' <span class="v">✔</span>' : ($clase === 'mal' ? ' <span class="x">✘</span>' : '');
    return '<input type="text" name="' . $key . '" class="' . $clase . '" style="width:' . $ancho . 'px" value="'
        . htmlspecialchars($valor, ENT_QUOTES) . '" autocomplete="off">' . $marca;
}
function ejemplo($texto, $ancho) {
    return '<input type="text" value="' . htmlspecialchars($texto, ENT_QUOTES) . '" style="width:' . $ancho . 'px" readonly class="ejemplo">';
}

$p3 = $p4 = $p5 = 0;
if ($evaluar) {
    foreach ($ex3  as $k => $_) if (esCorrecta($k, $ex3))  $p3++;
    foreach ($ex4a as $k => $_) if (esCorrecta($k, $ex4a)) $p4++;
    foreach ($ex5  as $k => $_) if (esCorrecta($k, $ex5))  $p5++;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Direct and indirect questions</title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../style.css">
<style>
    body { font-family: Arial, sans-serif; max-width: 900px; margin: 20px auto; padding: 0 15px; color: #333; line-height: 2; }
    h2 { color: #d32f2f; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin-top: 40px; }
    .inst { font-size: 14px; }
    input[type=text] { padding: 3px 6px; border: 1px solid #bbb; border-radius: 3px; font-size: 15px; }
    input.ejemplo { background: #fafafa; }
    input.ok  { border-color: #2e7d32; background: #e8f5e9; color: #2e7d32; font-weight: bold; }
    input.mal { border-color: #c62828; background: #ffebee; }
    .v { color: #2e7d32; font-weight: bold; }
    .x { color: #c62828; font-weight: bold; }
    .nota { float: right; border: 1px solid #ccc; padding: 2px 12px; font-size: 14px; }
    .dialogo p { margin: 6px 0 6px 40px; }
    .prompt { font-size: 14px; color: #555; }
    ol.frases { padding-left: 25px; }
    ol.frases li { margin-bottom: 22px; }
    .botones { text-align: center; margin: 40px 0; }
    .btn, button { display: inline-block; background: #455a64; color: #fff; border: 0; padding: 8px 26px; margin: 4px; border-radius: 3px;
                   font-size: 14px; cursor: pointer; text-decoration: none; line-height: normal; }
    .btn:hover, button:hover { background: #263238; color: #fff; }
</style>
<script>
// Se envía con fetch y se reemplaza solo el contenido, conservando el scroll.
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

<!-- ================= EXERCISE 3 ================= -->
<h2>Exercise 3 <?php if ($evaluar): ?><span class="nota"><?= $p3 ?>/<?= count($ex3) ?></span><?php endif; ?></h2>
<p class="inst">Use the prompts to write the therapist's questions.</p>
<div class="dialogo">
    <p><strong>A:</strong> <?= ejemplo('Why have you come to see me today', 210) ?> ? <span class="prompt">(Why / you / come / see / me / today?)</span></p>
    <p><strong>B:</strong> I keep getting headaches.</p>
    <p><strong>A:</strong> <?= campo('a2', $ex3, 260) ?> ? <span class="prompt">(What / these headaches / like?)</span></p>
    <p><strong>B:</strong> Absolutely terrible.</p>
    <p><strong>A:</strong> <?= campo('a3', $ex3, 300) ?> ? <span class="prompt">(What / cause / headaches, / think?)</span></p>
    <p><strong>B:</strong> Mainly thinking about money.</p>
    <p><strong>A:</strong> <?= campo('a4', $ex3, 300) ?> ? <span class="prompt">(What / think / about / moment?)</span></p>
    <p><strong>B:</strong> That clock.</p>
    <p><strong>A:</strong> <?= campo('a5', $ex3, 300) ?> ? <span class="prompt">(that clock / remind / you / anything?)</span></p>
    <p><strong>B:</strong> Yes, money.</p>
    <p><strong>A:</strong> <?= campo('a6', $ex3, 200) ?> ? <span class="prompt">(Why / that?)</span></p>
    <p><strong>B:</strong> Because I'm paying by the minute! Let's stop now.</p>
    <p><strong>A:</strong> <?= campo('a7', $ex3, 380) ?> ? <span class="prompt">(OK. / How / like / pay - / cash / credit card?)</span></p>
</div>

<!-- ================= EXERCISE 4A ================= -->
<h2>Exercise 4A <?php if ($evaluar): ?><span class="nota"><?= $p4 ?>/<?= count($ex4a) ?></span><?php endif; ?></h2>
<p class="inst">Complete the second sentence so that it has a similar meaning to the first. Use between three and five words, including the word in brackets.</p>
<ol class="frases">
    <li>Could you introduce us to the director? (wonder)<br>
        I <?= ejemplo('wonder if you could introduce', 210) ?> us to the director.</li>
    <li>How much did your camera cost? (camera)<br>
        Do you mind me <?= campo('b2', $ex4a, 230) ?> cost?</li>
    <li>What do you do exactly? (telling)<br>
        Would you mind <?= campo('b3', $ex4a, 200) ?> do exactly?</li>
    <li>Is it really worth upgrading to the new smartphone? (whether)<br>
        I'd like to know <?= campo('b4', $ex4a, 200) ?> worth upgrading to the new smartphone.</li>
    <li>Which platform does the Eurostar train leave from? (train)<br>
        Can you tell me which platform <?= campo('b5', $ex4a, 220) ?> from?</li>
    <li>In your opinion, what will he do when he discovers the mistake? (do / think)<br>
        What do you <?= campo('b6', $ex4a, 200) ?> when he discovers the mistake?</li>
</ol>

<!-- ================= EXERCISE 5 ================= -->
<h2>Exercise 5 <?php if ($evaluar): ?><span class="nota"><?= $p5 ?>/<?= count($ex5) ?></span><?php endif; ?></h2>
<p class="inst">Change the direct questions into indirect questions.</p>
<ol class="frases">
    <li>What were you like ten years ago?<br>
        Can you tell me <?= ejemplo('what you were like ten years ago', 240) ?> ?</li>
    <li>How do you think you've changed?<br>
        I'd be interested <?= campo('c2', $ex5, 300) ?> ?</li>
    <li>What have you done that you are most proud of?<br>
        Would you mind telling me <?= campo('c3', $ex5, 320) ?> ?</li>
    <li>Is it possible for a person to stay the same all his life?<br>
        I wonder <?= campo('c4', $ex5, 380) ?> .</li>
    <li>Who has influenced you the most?<br>
        Could you tell <?= campo('c5', $ex5, 280) ?> ?</li>
    <li>Would you like to direct a movie yourself?<br>
        I was wondering <?= campo('c6', $ex5, 320) ?> .</li>
</ol>

<?php if ($evaluar): $tot = $p3 + $p4 + $p5; $max = count($ex3) + count($ex4a) + count($ex5); ?>
    <p style="text-align:center;font-size:18px"><strong>Total: <?= $tot ?>/<?= $max ?> (<?= round($tot / $max * 100) ?>%)</strong></p>
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
