<?php
// ---------- Datos de los ejercicios ----------
// Respuestas aceptadas (varias separadas por |). Se comparan sin mayúsculas ni espacios extra.
$ex3a = [
    'a1' => 'be painted',
    'a2' => 'was invented',
    'a3' => 'were thrown',
    'a4' => 'has been invaded',
    'a5' => 'has been gradually damaged|has gradually been damaged',
    'a6' => 'being kissed',
    'a7' => 'to be killed',
    'a8' => 'be found',
    'a9' => 'had already been explored',
];
$ex3b_correctas = ['s2', 's7']; // Frisbee y Kangaroos
$ex4 = [
    'b1' => 'are being taught',
    'b2' => 'are sent',
    'b3' => 'be used',
    'b4' => 'decide',
    'b5' => 'will be used',
    'b6' => 'will allow',
    'b7' => 'be altered',
    'b8' => 'will also send',
    'b9' => 'was tested',
    'b10' => 'be introduced',
];

function norm($s) { return strtolower(preg_replace('/\s+/', ' ', trim((string)$s))); }
function esCorrecta($key, $lista) {
    $u = norm($_POST[$key] ?? '');
    foreach (explode('|', $lista[$key]) as $ok) if ($u === norm($ok)) return true;
    return false;
}

$enviado  = ($_SERVER['REQUEST_METHOD'] === 'POST');
$mostrar  = $enviado && isset($_POST['accion']) && $_POST['accion'] === 'mostrar';
$evaluar  = $enviado && !$mostrar;

// Input de ejercicio
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

// Puntajes
$p3a = $p3b = $p4 = 0;
if ($evaluar) {
    foreach ($ex3a as $k => $_) if (esCorrecta($k, $ex3a)) $p3a++;
    foreach ($ex4  as $k => $_) if (esCorrecta($k, $ex4))  $p4++;
    $sel = $_POST['s'] ?? [];
    foreach ($ex3b_correctas as $c) if (in_array($c, $sel)) $p3b++;
    if (count($sel) > 2) $p3b = max(0, $p3b - (count($sel) - 2));
}

$frases3b = [
    's1' => 'All gondolas in Venice, Italy, must be painted black, except if they belong to a high official.',
    's2' => 'The modern Frisbee was invented by the Frisbee Pie Company in 1946 when their pie tins were thrown around by employees during breaks.',
    's3' => 'Over the centuries, Korea has been invaded more times than any other country in the world.',
    's4' => 'The white surface of the Taj Mahal is gradually being damaged by pollution and is turning yellow.',
    's5' => 'British guidebooks in the nineteenth century advised women to put pins in their mouths to avoid being kissed in the dark.',
    's6' => 'You are more likely to be killed by a champagne cork than a poisonous spider, but most people are more afraid of spiders.',
    's7' => 'Kangaroos can be found in the wild in only two countries: Australia and New Zealand.',
    's8' => "When Christopher Columbus 'discovered' America in 1492, the continent had already been explored by the Vikings over three centuries earlier.",
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Passive</title>
<style>
    body { font-family: Arial, sans-serif; max-width: 900px; margin: 20px auto; padding: 0 15px; color: #333; line-height: 2; }
    h2 { color: #d32f2f; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin-top: 40px; }
    .inst { font-size: 14px; }
    ol { padding-left: 25px; }
    li { margin-bottom: 14px; }
    input[type=text] { padding: 3px 6px; border: 1px solid #bbb; border-radius: 3px; font-size: 15px; }
    input.ok  { border-color: #2e7d32; background: #e8f5e9; color: #2e7d32; font-weight: bold; }
    input.mal { border-color: #c62828; background: #ffebee; }
    .v { color: #2e7d32; font-weight: bold; }
    .x { color: #c62828; font-weight: bold; }
    .nota { float: right; border: 1px solid #ccc; padding: 2px 12px; font-size: 14px; }
    .fila { margin: 8px 0; }
    .fila.ok  { background: #e8f5e9; }
    .fila.mal { background: #ffebee; }
    .botones { text-align: center; margin: 40px 0; }
    .btn, button { display: inline-block; background: #455a64; color: #fff; border: 0; padding: 8px 26px; margin: 4px; border-radius: 3px;
                   font-size: 14px; cursor: pointer; text-decoration: none; line-height: normal; }
    .btn:hover, button:hover { background: #263238; }
    .parrafo { margin-bottom: 25px; }
</style>
</head>
<body>

<form method="POST" action="./index.php" autocomplete="off">

<!-- ================= EXERCISE 3A ================= -->
<h2>Exercise 3A <?php if ($evaluar): ?><span class="nota"><?= $p3a ?>/<?= count($ex3a) ?></span><?php endif; ?></h2>
<p class="inst">Complete the sentences with the passive form of the verbs in brackets.</p>
<p><strong>Strange but true!</strong></p>
<ol>
    <li>All gondolas in Venice, Italy, must <?= campo('a1', $ex3a) ?> (paint) black, except if they belong to a high official.</li>
    <li>The modern Frisbee <?= campo('a2', $ex3a) ?> (invent) by the Frisbee Pie Company in 1946 when their pie tins <?= campo('a3', $ex3a) ?> (throw) around by employees during breaks.</li>
    <li>Over the centuries, Korea <?= campo('a4', $ex3a) ?> (invade) more times than any other country in the world.</li>
    <li>The white surface of the Taj Mahal <?= campo('a5', $ex3a, 200) ?> (gradually/damage) by pollution and is turning yellow.</li>
    <li>British guidebooks in the nineteenth century advised women to put pins in their mouths to avoid <?= campo('a6', $ex3a) ?> (kiss) in the dark.</li>
    <li>You are more likely <?= campo('a7', $ex3a) ?> (kill) by a champagne cork than a poisonous spider, but most people are more afraid of spiders.</li>
    <li>Kangaroos can <?= campo('a8', $ex3a) ?> (find) in the wild in only two countries: Australia and New Zealand.</li>
    <li>When Christopher Columbus 'discovered' America in 1492, the continent <?= campo('a9', $ex3a, 200) ?> (already/explore) by the Vikings over three centuries earlier.</li>
</ol>

<!-- ================= EXERCISE 3B ================= -->
<h2>Exercise 3B <?php if ($evaluar): ?><span class="nota"><?= $p3b ?>/2</span><?php endif; ?></h2>
<p class="inst">Two of the facts are false. Which are they?</p>
<p><strong>Strange but true!</strong></p>
<?php foreach ($frases3b as $k => $txt):
    $marcada = in_array($k, $_POST['s'] ?? []);
    $esFalsa = in_array($k, $ex3b_correctas);
    $clase = '';
    if ($mostrar && $esFalsa) $clase = 'ok';
    elseif ($evaluar && $marcada) $clase = $esFalsa ? 'ok' : 'mal';
?>
    <div class="fila <?= $clase ?>">
        <label>
            <input type="checkbox" name="s[]" value="<?= $k ?>" <?= ($marcada || ($mostrar && $esFalsa)) ? 'checked' : '' ?>>
            <?= htmlspecialchars($txt) ?>
        </label>
        <?php if ($clase === 'ok') echo '<span class="v">✔</span>'; elseif ($clase === 'mal') echo '<span class="x">✘</span>'; ?>
    </div>
<?php endforeach; ?>

<!-- ================= EXERCISE 4 ================= -->
<h2>Exercise 4 <?php if ($evaluar): ?><span class="nota"><?= $p4 ?>/<?= count($ex4) ?></span><?php endif; ?></h2>
<p class="inst">Complete the sentences with the correct active or passive form of the verbs in brackets.</p>
<p><strong>TECHNOLOGY UPDATE</strong></p>
<div class="parrafo">
    Currently hundreds of trainee medical students <?= campo('b1', $ex4) ?> (teach) through the online virtual world Second Life.
    Once a day students <?= campo('b2', $ex4) ?> (send) to locations in the online world to treat computer-generated patients.
    When they are there, virtual equipment can <?= campo('b3', $ex4) ?> (use) to check the patients at the scene and then the trainees can
    <?= campo('b4', $ex4) ?> (decide) the best course of action. The training tool has been a great success so far and from next year it
    <?= campo('b5', $ex4) ?> (use) at a number of medical schools around the world.
</div>
<div class="parrafo">
    Pollution is an ever-growing problem in our cities but in the near future a new system <?= campo('b6', $ex4) ?> (allow) traffic managers to
    identify pollution hotspots. The movement of cars through the city will be able to <?= campo('b7', $ex4) ?> (alter) by changing the traffic light
    sequencing to direct cars away from problem areas. A computer <?= campo('b8', $ex4) ?> (also / send) commuters warning text alerts on their
    mobile phones so they can decide how to avoid the hotspot. The new pollution monitoring system <?= campo('b9', $ex4) ?> (test) successfully for
    the first time at a trial last month and could <?= campo('b10', $ex4) ?> (introduce) as soon as next year.
</div>

<?php if ($evaluar): $tot = $p3a + $p3b + $p4; $max = count($ex3a) + 2 + count($ex4); ?>
    <p style="text-align:center;font-size:18px"><strong>Total: <?= $tot ?>/<?= $max ?> (<?= round($tot / $max * 100) ?>%)</strong></p>
<?php endif; ?>

<div class="botones">
    <a class="btn" href="../Menu.php">Salir</a>
    <button type="submit" name="accion" value="enviar">Enviar</button>
    <button type="submit" name="accion" value="mostrar">Mostrar respuestas</button>
    <a class="btn" href="./index.php">Vuelva a intentarlo</a>
</div>

</form>
</body>
</html>
