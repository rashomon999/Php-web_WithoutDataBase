<?php
// ---------- Datos de los ejercicios ----------
// Respuestas aceptadas separadas por |. Se comparan sin mayúsculas, puntuación ni espacios extra.
$ex3 = [
    'a2' => 'have never managed|have not managed',
    'a3' => 'had',
    'a4' => 'wanted',
    'a5' => 'worked',
    'a6' => 'did the concert cost',
    'a7' => 'has the cost gone',
    'a8' => 'have you made',
    'a9' => 'have just finished',
    'a10' => 'requested',
    'a11' => 'has become',
];
$ex4 = [
    'b1' => 'left',
    'b2' => 'went',
    'b3' => 'have',
    'b4' => 'spoken',
    'b5' => "haven't asked|have not asked",
    'b6' => 'did',
    'b7' => 'get back',
    'b8' => 'have already forgotten|have forgotten already',
    'b9' => 'were',
    'b10' => 'happened',
    'b11' => 'has had',
    'b12' => 'stayed',
    'b13' => 'had',
    'b14' => 'has been',
];
$ex5 = [
    'c2' => "have visited|'ve visited",
    'c3' => "have often wanted|'ve often wanted",
    'c4' => "have never known|'ve never known",
    'c5' => "have been exploring|'ve been exploring",
    'c6' => "have found|'ve found",
    'c7' => 'has been presenting',
    'c8' => "have told|'ve told",
    'c9' => 'has been',
    'c10' => 'has recently appeared|has appeared recently',
];
// Ejercicio 2A: emparejar (letra correcta)
$ex2a_frases = [
    1 => "She's done", 2 => "She's been doing", 3 => "I've sent", 4 => "I've been sending",
    5 => "Pete's called", 6 => "Pete's been calling", 7 => "I've read this magazine", 8 => "I've been reading this magazine",
    9 => "Julia's gone to the gym –", 10 => "Julia's been going to the gym,", 11 => "The temperature has dropped", 12 => "The temperature has been dropping",
];
$ex2a_opc = [
    'a' => 'to minus thirty.',
    'b' => 'all her homework.',
    'c' => 'you all evening. Is your mobile on?',
    'd' => 'Do you want to borrow it?',
    'e' => "Do you want to borrow it when I've finished?",
    'f' => "and she's ten kilos lighter now.",
    'g' => 'all day.',
    'h' => 'her homework since she got home from school.',
    'i' => 'and left you a message.',
    'j' => 'shall I ask her to call you back?',
    'k' => 'twenty-five application letters this morning.',
    'l' => 'application letters all morning. I need a break!',
];
$ex2a = [2=>'h', 3=>'k', 4=>'l', 5=>'i', 6=>'c', 7=>'d', 8=>'e', 9=>'j', 10=>'f', 11=>'a', 12=>'g'];

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
    return '<input type="text" name="' . $key . '" class="' . $clase . '" style="width:' . $ancho . 'px" value="'
        . htmlspecialchars($valor, ENT_QUOTES) . '" autocomplete="off">' . $marca;
}
function ejemplo($texto, $ancho) {
    return '<input type="text" value="' . htmlspecialchars($texto, ENT_QUOTES) . '" style="width:' . $ancho . 'px" readonly class="ejemplo">';
}
function selector($n) {
    global $evaluar, $mostrar, $ex2a, $ex2a_opc;
    $sel = $mostrar ? $ex2a[$n] : ($_POST['m' . $n] ?? '');
    $clase = '';
    if ($mostrar) $clase = 'ok';
    elseif ($evaluar) $clase = ($sel === $ex2a[$n]) ? 'ok' : 'mal';
    $h = '<select name="m' . $n . '" class="' . $clase . '"><option value=""></option>';
    foreach ($ex2a_opc as $l => $_) $h .= '<option value="' . $l . '"' . ($sel === $l ? ' selected' : '') . '>' . $l . '</option>';
    $h .= '</select>';
    if ($clase === 'ok') $h .= ' <span class="v">✔</span>'; elseif ($clase === 'mal') $h .= ' <span class="x">✘</span>';
    return $h;
}

$p3 = $p4 = $p5 = $p2a = 0;
if ($evaluar) {
    foreach ($ex3 as $k => $_) if (esCorrecta($k, $ex3)) $p3++;
    foreach ($ex4 as $k => $_) if (esCorrecta($k, $ex4)) $p4++;
    foreach ($ex5 as $k => $_) if (esCorrecta($k, $ex5)) $p5++;
    foreach ($ex2a as $n => $l) if (($_POST['m' . $n] ?? '') === $l) $p2a++;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Present perfect</title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../style.css">
<style>
    body { font-family: Arial, sans-serif; max-width: 900px; margin: 20px auto; padding: 0 15px; color: #333; line-height: 2; }
    h2 { color: #d32f2f; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin-top: 40px; }
    .inst { font-size: 14px; }
    input[type=text], select { padding: 3px 6px; border: 1px solid #bbb; border-radius: 3px; font-size: 15px; }
    input.ejemplo { background: #fafafa; }
    input.ok, select.ok   { border-color: #2e7d32; background: #e8f5e9; color: #2e7d32; font-weight: bold; }
    input.mal, select.mal { border-color: #c62828; background: #ffebee; }
    .v { color: #2e7d32; font-weight: bold; }
    .x { color: #c62828; font-weight: bold; }
    .nota { float: right; border: 1px solid #ccc; padding: 2px 12px; font-size: 14px; }
    ol.frases { padding-left: 25px; }
    ol.frases li { margin-bottom: 14px; }
    .banco { background: #eef3f7; border: 1px solid #c9d6df; text-align: center; padding: 6px; margin: 20px 0; word-spacing: 6px; }
    .dialogo { margin-bottom: 25px; }
    .dialogo p { margin: 4px 0 4px 10px; }
    .dialogo .num { font-weight: bold; margin-top: 18px; }
    .parrafo { margin: 20px 0; }
    .match { display: flex; flex-wrap: wrap; gap: 30px; }
    .match > div { flex: 1 1 380px; }
    .match .op { margin: 4px 0; }
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
<p class="inst">Complete the sentences with the present perfect or past simple form of the verbs in brackets.</p>
<ol class="frases">
    <li>Is there something you <?= ejemplo('have always wanted', 140) ?> (always want) to do but somehow <?= campo('a2', $ex3, 140) ?> (never manage) to?</li>
    <li>Not long ago our company <?= campo('a3', $ex3, 90) ?> (have) a client who <?= campo('a4', $ex3, 100) ?> (want) to be a rock star.</li>
    <li>I <?= campo('a5', $ex3, 100) ?> (work) as a production manager in the film business for many years, till just a few years ago.</li>
    <li>How much <?= campo('a6', $ex3, 150) ?> (the concert / cost) last year, and <?= campo('a7', $ex3, 150) ?> (the cost / go) up since then?</li>
    <li>What other dreams <?= campo('a8', $ex3, 130) ?> (make) come true recently?</li>
    <li>We <?= campo('a9', $ex3, 130) ?> (just finish) working with a client who wants to fly across the Atlantic Ocean on a supersonic aeroplane.</li>
    <li>One client wanted to fly in space but that wasn't possible back when she first <?= campo('a10', $ex3, 110) ?> (request) it.</li>
    <li>Since then it <?= campo('a11', $ex3, 110) ?> (become) possible for ordinary people to go into space.</li>
</ol>

<!-- ================= EXERCISE 4 ================= -->
<h2>Exercise 4 <?php if ($evaluar): ?><span class="nota"><?= $p4 ?>/<?= count($ex4) ?></span><?php endif; ?></h2>
<p class="inst">Complete the conversations with the present perfect or past simple form of the verbs below.</p>
<div class="banco">speak &nbsp; forget &nbsp; leave &nbsp; happen &nbsp; not &nbsp; ask &nbsp; be (x2) &nbsp; get back &nbsp; see &nbsp; have (x2) &nbsp; stay &nbsp; go</div>
<div class="dialogo">
    <p class="num">1</p>
    <p><strong>A:</strong> <?= ejemplo('Has', 50) ?> anyone <?= ejemplo('seen', 60) ?> my pen?</p>
    <p><strong>B:</strong> What does it look like?</p>
    <p><strong>A:</strong> It's silver. I'm sure I <?= campo('b1', $ex4, 100) ?> it on the table before we <?= campo('b2', $ex4, 100) ?> to lunch.</p>

    <p class="num">2</p>
    <p><strong>A:</strong> <?= campo('b3', $ex4, 90) ?> you <?= campo('b4', $ex4, 100) ?> to Kiera today?</p>
    <p><strong>B:</strong> No, and I <?= campo('b5', $ex4, 120) ?> her yet if she wants to come out with us tomorrow.</p>

    <p class="num">3</p>
    <p><strong>A:</strong> Hi, Suzie. When <?= campo('b6', $ex4, 90) ?> you <?= campo('b7', $ex4, 110) ?> from holiday?</p>
    <p><strong>B:</strong> A few days ago but I <?= campo('b8', $ex4, 160) ?> (already) it. There <?= campo('b9', $ex4, 90) ?> over 300 emails in my inbox!</p>
    <p><strong>A:</strong> I sympathise! The same thing <?= campo('b10', $ex4, 110) ?> after my break.</p>

    <p class="num">4</p>
    <p><strong>A:</strong> Do you know anyone who <?= campo('b11', $ex4, 110) ?> bird flu?</p>
    <p><strong>B:</strong> No, thankfully. What about you?</p>
    <p><strong>A:</strong> Frank <?= campo('b12', $ex4, 100) ?> away from school last week as one of the other kids <?= campo('b13', $ex4, 90) ?> a bad fever, but it was a false alarm.</p>
    <p><strong>B:</strong> Yes, so far everyone in the family <?= campo('b14', $ex4, 110) ?> OK.</p>
</div>

<!-- ================= BLOG (2.1) ================= -->
<h2>Present perfect simple and continuous <?php if ($evaluar): ?><span class="nota"><?= $p5 ?>/<?= count($ex5) ?></span><?php endif; ?></h2>
<p class="inst">Complete the blog entry with the present perfect simple or continuous form of the verbs in brackets. If both are possible, use the continuous form.</p>
<div class="parrafo">
    I <?= ejemplo("'ve been travelling", 140) ?> (travel) all my life and I <?= campo('c2', $ex5, 120) ?> (visit) more than twenty-five countries,
    many of them less rich than my own. I <?= campo('c3', $ex5, 130) ?> (often / want) to take something to repay people for their hospitality but I
    <?= campo('c4', $ex5, 130) ?> (never / know) what to choose. Anyway, recently I <?= campo('c5', $ex5, 150) ?> (explore) a number of websites that
    give advice and I <?= campo('c6', $ex5, 110) ?> (find) a great one called stuffyourrucksack.com. It was created by Kate Humble, who
    <?= campo('c7', $ex5, 150) ?> (present) wildlife programmes on television for many years. It's a beautifully simple idea: the website matches up
    charities that need stuff with people who are willing to provide and deliver it. Travellers <?= campo('c8', $ex5, 110) ?> (tell) the website about
    187 organisations in 81 countries, and these include schools needing books or footballs, orphanages needing clothes and toys and trade organisations
    needing mobiles. So far it looks as if the response <?= campo('c9', $ex5, 100) ?> (be) good and the website <?= campo('c10', $ex5, 150) ?>
    (recently / appear) in a 'Find of the Year' survey of new sites.
</div>

<!-- ================= EXERCISE 2A ================= -->
<h2>Exercise 2A <?php if ($evaluar): ?><span class="nota"><?= $p2a ?>/<?= count($ex2a) ?></span><?php endif; ?></h2>
<p class="inst">Match the sentence halves.</p>
<div class="match">
    <div>
        <?php foreach ($ex2a_frases as $n => $txt): ?>
            <p style="margin:6px 0"><strong><?= $n ?></strong> &nbsp; <?= htmlspecialchars($txt) ?>
            <?php if ($n === 1): ?><input type="text" value="b" readonly class="ejemplo" style="width:40px;text-align:center">
            <?php else: ?><?= selector($n) ?><?php endif; ?></p>
        <?php endforeach; ?>
    </div>
    <div>
        <?php foreach ($ex2a_opc as $l => $txt): ?>
            <p class="op"><strong><?= $l ?></strong> &nbsp; <?= htmlspecialchars($txt) ?></p>
        <?php endforeach; ?>
    </div>
</div>

<?php if ($evaluar): $tot = $p3 + $p4 + $p5 + $p2a; $max = count($ex3) + count($ex4) + count($ex5) + count($ex2a); ?>
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
