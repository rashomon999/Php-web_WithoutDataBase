<?php
// ---------- Datos de los ejercicios ----------
// Respuestas aceptadas separadas por |. Se comparan sin mayúsculas, puntuación ni espacios extra.
$ex9a = [
    'a2' => 'project',
    'a3' => 'research',
    'a4' => 'decrease',
    'a5' => 'desert',
    'a6' => 'recorded',
    'a7' => 'permit',
    'a8' => 'fine',
    'a9' => 'imports',
];
$ex2b = [
    'b2'  => 'I was never particular about what I eat',
    'b3'  => 'Fabio tends to keep to himself and goes to bed very late',
    'b4'  => 'My colleague Bill is a real people person',
    'b5'  => "He's a good laugh, but with money|He is a good laugh, but with money",
    'b6'  => 'he tends to be tight-fisted and never pays',
    'b7'  => "He does his best work in the early hours, when no one's around",
    'b8'  => "so it's odd that he doesn't really pull his weight when we work together",
    'b9'  => "I think he's a real computer geek and he's not very practical|I think he's a real computer geek, and he's not very practical",
    'b10' => "but that's changed since I've started getting into cooking",
];
$ex9b = [
    'c2'  => 'increased',
    'c3'  => 'exports',
    'c4'  => 'permit',
    'c5'  => 'decrease',
    'c6'  => 'appeal',
    'c7'  => 'sponsors',
    'c8'  => 'present',
    'c9'  => 'produced',
    'c10' => 'project',
    'c11' => 'imports',
    'c12' => 'suspect',
];

function norm($s) {
    $s = strtolower(trim((string)$s));
    $s = str_replace(['’', '‘'], "'", $s);
    $s = preg_replace("/[^a-z0-9 ]/", ' ', $s);
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

function campo($key, $lista, $ancho = 110) {
    global $evaluar, $mostrar;
    $primera = explode('|', $lista[$key])[0];
    $valor = $mostrar ? $primera : ($_POST[$key] ?? '');
    $clase = '';
    if ($mostrar) $clase = 'ok';
    elseif ($evaluar) $clase = esCorrecta($key, $lista) ? 'ok' : 'mal';
    $marca = $clase === 'ok' ? ' <span class="v">✔</span>' : ($clase === 'mal' ? ' <span class="x">✘</span>' : '');
    return '<input type="text" name="' . $key . '" class="' . $clase . '" style="width:' . $ancho . 'px;max-width:100%" value="'
        . htmlspecialchars($valor, ENT_QUOTES) . '" autocomplete="off">' . $marca;
}
function ejemplo($texto, $ancho) {
    return '<input type="text" value="' . htmlspecialchars($texto, ENT_QUOTES) . '" style="width:' . $ancho . 'px;max-width:100%" readonly class="ejemplo">';
}

$p9a = $p2b = $p9b = 0;
if ($evaluar) {
    foreach ($ex9a as $k => $_) if (esCorrecta($k, $ex9a)) $p9a++;
    foreach ($ex2b as $k => $_) if (esCorrecta($k, $ex2b)) $p2b++;
    foreach ($ex9b as $k => $_) if (esCorrecta($k, $ex9b)) $p9b++;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vocabulary</title>
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
    .banco { background: #eef3f7; border: 1px solid #c9d6df; text-align: center; padding: 6px; margin: 20px 0; word-spacing: 6px; }
    .parrafo { margin: 20px 0; }
    ol.frases { padding-left: 30px; }
    ol.frases li { margin-bottom: 14px; }
    ol.frases.dobles li { margin-bottom: 22px; }
    .ejbox { background: #eef3f7; border: 1px solid #c9d6df; padding: 8px 14px; margin: 20px 0; }
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

<!-- ================= EXERCISE 9A ================= -->
<h2>Exercise 9A <?php if ($evaluar): ?><span class="nota"><?= $p9a ?>/<?= count($ex9a) ?></span><?php endif; ?></h2>
<p class="inst">Complete the news reports with the correct form of the words below. Then listen and check.</p>
<div class="banco">decrease &nbsp; record &nbsp; research &nbsp; desert &nbsp; fine &nbsp; project &nbsp; appeal &nbsp; import &nbsp; permit</div>
<div class="parrafo">
    A group of rock stars are <?= ejemplo('appealing', 100) ?> for people to fund a new <?= campo('a2', $ex9a, 100) ?> aimed at preventing malaria.
    Recent medical <?= campo('a3', $ex9a, 100) ?> shows there is a dramatic <?= campo('a4', $ex9a, 100) ?> in the disease when malaria nets are
    provided for families.
</div>
<div class="parrafo">
    Fifty-two tourists have been rescued from the <?= campo('a5', $ex9a, 100) ?> near the Step Pyramid in Egypt after temperatures reached 49 degrees
    Celsius – the highest level ever <?= campo('a6', $ex9a, 100) ?> in the area. The tourists were stranded when their bus broke down. The group's tour
    operator has been arrested for failing to obtain a <?= campo('a7', $ex9a, 100) ?> to conduct business in the area and has been ordered to pay a
    <?= campo('a8', $ex9a, 100) ?>.
</div>
<div class="parrafo">
    And in business, a number of European countries are planning to cut <?= campo('a9', $ex9a, 100) ?> from the United States as trade tensions
    continue. The USA has recently increased taxes on produce coming from abroad to an all-time high.
</div>

<!-- ================= EXERCISE 2B ================= -->
<h2>Exercise 2B <?php if ($evaluar): ?><span class="nota"><?= $p2b ?>/<?= count($ex2b) ?></span><?php endif; ?></h2>
<p class="inst">Rewrite the sentences, correcting the underlined mistakes.</p>
<div class="ejbox">
    <strong>Example:</strong><br>
    1 &nbsp; I don't know why you say he's down <u>on</u> earth.<br>
    <?= ejemplo("I don't know why you say he's down to earth", 420) ?> .
</div>
<ol class="frases dobles" start="2">
    <li>I was never <u>particularly</u> about what I eat.<br><?= campo('b2', $ex2b, 420) ?> .</li>
    <li>Fabio tends to keep <u>in</u> himself and goes to bed very late.<br><?= campo('b3', $ex2b, 420) ?> .</li>
    <li>My colleague Bill is a real '<u>person</u> person'.<br><?= campo('b4', $ex2b, 420) ?> .</li>
    <li>He's a good <u>laughter</u>, but with money ...<br><?= campo('b5', $ex2b, 420) ?> ...</li>
    <li>... he tends to be tight-<u>handed</u> and never pays.<br>... <?= campo('b6', $ex2b, 420) ?> .</li>
    <li>He does his best work in the early <u>times</u>, when no one's around.<br><?= campo('b7', $ex2b, 480) ?> .</li>
    <li>... so it's odd that he doesn't really <u>push</u> his weight when we work together.<br>... <?= campo('b8', $ex2b, 480) ?> .</li>
    <li>I think he's a real computer <u>gawk</u>, and he's not very practical.<br><?= campo('b9', $ex2b, 480) ?> .</li>
    <li>... but that's changed since I've started getting <u>in</u> cooking.<br>... <?= campo('b10', $ex2b, 480) ?> .</li>
</ol>

<!-- ================= EXERCISE 9B ================= -->
<h2>Verbs / nouns with the same form <?php if ($evaluar): ?><span class="nota"><?= $p9b ?>/<?= count($ex9b) ?></span><?php endif; ?></h2>
<p class="inst">Complete the sentences with the correct form of the verb or noun.</p>
<ol class="frases">
    <li>In the 2008 Olympics, Usain Bolt set three world <?= ejemplo('records', 90) ?> , including the 100 metres.</li>
    <li>Children's phone ownership has <?= campo('c2', $ex9b, 110) ?> dramatically to an all-time high.</li>
    <li>Germany <?= campo('c3', $ex9b, 110) ?> more items to other countries than any other country in the world.</li>
    <li>If you stay in Spain for more than ninety days you need to apply for a residence <?= campo('c4', $ex9b, 110) ?> .</li>
    <li>CCTV cameras have been successful, with a huge <?= campo('c5', $ex9b, 110) ?> in incidents of violence.</li>
    <li>Police have launched a nationwide <?= campo('c6', $ex9b, 110) ?> for help to find a missing sixteen-year-old.</li>
    <li>The BBC <?= campo('c7', $ex9b, 110) ?> a number of different charities, including Comic Relief and SportsAid.</li>
    <li>Ladies and gentlemen, I'd like to <?= campo('c8', $ex9b, 110) ?> our speaker for tonight, the well-known scientist Rajesh Gokhale.</li>
    <li>Last year the farm <?= campo('c9', $ex9b, 110) ?> twenty tonnes of apples and sent them direct to supermarkets.</li>
    <li>The National Gallery is planning to <?= campo('c10', $ex9b, 110) ?> gigantic images of Picasso paintings onto the outside of the building.</li>
    <li>The USA <?= campo('c11', $ex9b, 110) ?> more coffee from coffee-producing countries than any other country.</li>
    <li>The police have arrested the chief <?= campo('c12', $ex9b, 110) ?> in connection with the bank robbery.</li>
</ol>

<?php if ($evaluar): $tot = $p9a + $p2b + $p9b; $max = count($ex9a) + count($ex2b) + count($ex9b); ?>
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
