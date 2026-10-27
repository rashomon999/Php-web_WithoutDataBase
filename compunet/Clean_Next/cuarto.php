<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. instalacion y configuracion --- */
  1  => ['vitest'],
  2  => ['devDependencies'],
  3  => ['vitest run', 'run'],
  4  => ['vitest.config.mts', 'vitest.config'],
  5  => ['defineConfig'],
  6  => ['alias'],
  7  => ['include'],
  8  => ['node'],
  9  => ['.test.ts', 'test.ts'],

  /* --- B. anatomia de un test --- */
  15 => ['describe'],
  16 => ['it'],
  17 => ['expect'],
  18 => ['toBe'],
  19 => ['toThrow'],
  20 => ['it.each', 'each'],
  21 => ['toBeLessThan'],

  /* --- C. los casos borde --- */
  30 => ['7'],
  31 => ['6'],
  32 => ['3'],
  33 => ['24'],
  34 => ['26'],
  35 => ['945000', '945_000'],
  36 => ['637500', '637_500'],

  /* --- D. de memoria --- */
  40 => ['expect(() => Money.cop(-1)).toThrow(InvalidMoneyError);'],
  41 => ['expect(Money.cop(1_050_000).withDiscount(10).amount).toBe(945_000);'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => '¿Por que los tests del dominio corren en milisegundos y sin navegador ni API?',
    'opciones' => [
      'a' => 'Porque Vitest usa una cache muy agresiva.',
      'b' => 'Porque el dominio es TypeScript puro: no importa React, ni hace <code>fetch</code>, ni toca <code>localStorage</code>. Solo son funciones y clases.',
      'c' => 'Porque Vitest levanta la API en segundo plano.',
      'd' => 'Porque corren compilados a JavaScript nativo.',
    ],
    'correcta' => 'b',
    'porque' => 'Es la recompensa directa de la regla de dependencias. Si <code>calculatePrice</code> necesitara un servidor, cada test costaria segundos y dejarias de correrlos.',
  ],

  'm2' => [
    'texto' => 'El archivo <code>vitest.config.mts</code> repite el alias <code>@</code> que ya esta en <code>tsconfig.json</code>. ¿Por que hace falta?',
    'opciones' => [
      'a' => 'Es redundante; se puede borrar.',
      'b' => 'Porque <code>tsconfig.json</code> solo le dice al compilador como resolver tipos; quien ejecuta los tests es Vite, y necesita su propia tabla para encontrar los archivos en tiempo de ejecucion.',
      'c' => 'Porque Next.js borra el tsconfig al compilar.',
      'd' => 'Porque los tests usan otra version de TypeScript.',
    ],
    'correcta' => 'b',
    'porque' => 'Sintoma tipico si falta: <code>Cannot find module \'@/shared/domain/value-objects/money\'</code> en los tests, mientras el editor y <code>npm run build</code> funcionan perfectos.',
  ],

  'm3' => [
    'texto' => 'Los tests comprueban 7 dias (con descuento) y 6 dias (sin descuento), pero no 15 ni 40. ¿Por que esos numeros?',
    'opciones' => [
      'a' => 'Por ahorrar tiempo de ejecucion.',
      'b' => 'Porque los bugs viven en los <b>bordes</b>: 6 y 7 son los valores a cada lado de la frontera del descuento. 15 y 40 estan en medio de una zona donde ya nada cambia.',
      'c' => 'Porque el maximo son 30 dias.',
      'd' => 'Porque son los unicos que dan numeros redondos.',
    ],
    'correcta' => 'b',
    'porque' => 'Lo mismo con la cancelacion: 26 h, 24 h exactas, 23 h y "ya empezo". Un test de 100 h no habria detectado nunca la diferencia entre <code>&gt;</code> y <code>&gt;=</code>.',
  ],

  'm4' => [
    'texto' => '<code>expect(() =&gt; Money.cop(-1)).toThrow(...)</code> envuelve la llamada en una funcion flecha. ¿Que pasa si se escribe <code>expect(Money.cop(-1)).toThrow(...)</code>?',
    'opciones' => [
      'a' => 'Funciona igual.',
      'b' => 'El error se lanza <b>antes</b> de que <code>expect</code> lo reciba, asi que el test falla con la excepcion suelta en vez de comprobarla.',
      'c' => 'Vitest lo detecta y lo corrige.',
      'd' => 'Devuelve <code>undefined</code> y el test pasa siempre.',
    ],
    'correcta' => 'b',
    'porque' => 'Para comprobar que algo explota hay que entregarle a <code>expect</code> <b>la forma de llamarlo</b>, no el resultado. Es el fallo mas comun al escribir los primeros tests.',
  ],

  'm5' => [
    'texto' => 'El test "no se ve afectado si se modifica la fecha original" modifica un <code>Date</code> despues de crear el rango. ¿Que esta protegiendo?',
    'opciones' => [
      'a' => 'Que las fechas se guarden en UTC.',
      'b' => 'La copia defensiva: <code>readonly</code> impide reasignar la propiedad, pero no impide que alguien mute el <code>Date</code> al que apunta.',
      'c' => 'Que no se acepten fechas del pasado.',
      'd' => 'Que <code>equals</code> compare por valor.',
    ],
    'correcta' => 'b',
    'porque' => 'Sin <code>new Date(start)</code> en <code>create</code>, ese test falla. Es un test que documenta una decision de diseño que de otro modo pareceria un <code>new Date()</code> de mas.',
  ],

  'm6' => [
    'texto' => '¿Que ventaja tiene <code>it.each([...])</code> frente a escribir cuatro <code>it</code> casi identicos?',
    'opciones' => [
      'a' => 'Corre en paralelo y es mas rapido.',
      'b' => 'Los casos quedan como una tabla legible y añadir uno nuevo es añadir una fila, sin copiar y pegar logica.',
      'c' => 'Permite saltarse los <code>expect</code>.',
      'd' => 'Agrupa los fallos en un solo mensaje.',
    ],
    'correcta' => 'b',
    'porque' => 'En <code>pricing.test.ts</code> la tabla es <code>[dias, subtotal, descuento, total]</code>: se lee como la hoja de calculo del cliente, no como codigo. Añadir "¿y con 30 dias?" es una linea.',
  ],

  'm7' => [
    'texto' => 'Pasar de un test que afirma "con 7 dias el total es 945.000" a uno que afirma "el descuento se aplica desde minDays" cambia algo importante:',
    'opciones' => [
      'a' => 'Nada, son equivalentes.',
      'b' => 'El primero comprueba la <b>regla del negocio</b> con numeros que el cliente reconoce; el segundo solo repite la implementacion y pasaria igual aunque la regla estuviera mal.',
      'c' => 'El segundo es mas rapido.',
      'd' => 'El primero no se puede escribir con <code>it.each</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Un test que calcula lo mismo que el codigo no prueba nada. Por eso los ejemplos del requerimiento ($150.000, 7 dias, $945.000) aparecen tal cual en los tests: son el acuerdo con el cliente, escrito en codigo.',
  ],

  'm8' => [
    'texto' => '¿Que relacion hay entre el archivo <code>CLASE2.md</code> y estos tests?',
    'opciones' => [
      'a' => 'Es la documentacion generada por Vitest.',
      'b' => 'Es la bitacora de la clase: instalar vitest, crear <code>vitest.config.mts</code>, añadir el script <code>test</code> y crear los cuatro archivos <code>.test.ts</code>. Sirve para repetir los pasos desde cero.',
      'c' => 'Es la lista de tests que faltan por escribir.',
      'd' => 'Es un archivo generado automaticamente por el profesor.',
    ],
    'correcta' => 'b',
    'porque' => 'Vale la pena leerlo antes de un parcial: son los pasos exactos, en orden, para montar las pruebas en un proyecto nuevo.',
  ],
];

$RETOS = [
  'r1' => [
    'titulo' => 'el archivo vitest.config.mts completo',
    'huecos' => [4, 5, 6, 7, 8],
    'codigo' => "import { defineConfig } from 'vitest/config';
import { fileURLToPath } from 'node:url';

export default defineConfig({
  resolve: {
    alias: { '@': fileURLToPath(new URL('./src', import.meta.url)) },
  },
  test: {
    include: ['src/**/*.test.ts'],
    environment: 'node',
  },
});",
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 4 — Probar el dominio con Vitest', 'La clase 2: configuracion, anatomia de un test y los casos borde que importan');
?>

<div class="card">
  <h2>Por que el dominio se prueba primero</h2>
  <p>Es la unica capa que no necesita nada del mundo exterior, asi que sus tests corren en
     milisegundos y nunca fallan "por culpa de la red". Y como ahi viven las reglas que el
     cliente reclama (el descuento, el plazo de cancelacion), son los tests que mas valen.</p>
  <div class="nota">
    Los pasos de la clase estan en <code>src/CLASE2.md</code>: instalar vitest, crear la
    configuracion, añadir el script y crear los cuatro archivos de test.
  </div>
  <?php mc('m1'); mc('m8'); ?>
</div>

<div class="card">
  <h2>A. Montarlo desde cero</h2>

<pre><code>npm i -D <?php hueco(1, 10); ?>          # queda en <?php hueco(2, 18); ?> del package.json

// package.json
"scripts": {
  "test": "<?php hueco(3, 12); ?>",
  "test:watch": "vitest watch"
}</code></pre>

  <p>La configuracion va en <?php hueco(4, 20); ?>, en la raiz del proyecto:</p>

<pre><code>import { <?php hueco(5, 14); ?> } from 'vitest/config';
import { fileURLToPath } from 'node:url';

export default defineConfig({
  resolve: {
    <?php hueco(6, 7); ?>: { '@': fileURLToPath(new URL('./src', import.meta.url)) },
  },
  test: {
    <?php hueco(7, 9); ?>: ['src/**/*<?php hueco(9, 10); ?>'],
    environment: '<?php hueco(8, 6); ?>',
  },
});</code></pre>

  <div class="avisoflujo">
    <b>El entorno es <code>node</code>, no <code>jsdom</code>:</b> no hace falta simular un navegador
    porque no hay nada de React en el dominio. Si algun dia hubiera que probar componentes,
    esos tests necesitarian otro entorno.
  </div>

  <?php mc('m2'); ?>
  <?php reto('r1'); ?>
</div>

<div class="card">
  <h2>B. Anatomia de un test</h2>

<pre><code>import { <?php hueco(15, 10); ?>, <?php hueco(17, 8); ?>, <?php hueco(16, 4); ?> } from 'vitest';
import { InvalidMoneyError, Money } from './money';

describe('Money', () =&gt; {
  it('rechaza montos negativos', () =&gt; {
    expect(() =&gt; Money.cop(-1)).<?php hueco(19, 9); ?>(InvalidMoneyError);
  });

  it('aplica un descuento porcentual', () =&gt; {
    expect(Money.cop(1_050_000).withDiscount(10).amount).<?php hueco(18, 6); ?>(945_000);
  });
});</code></pre>

  <p>Para varios casos del mismo tipo se usa <?php hueco(20, 9); ?>, que recibe
     una tabla de filas. Y para comprobar que un numero es negativo sin fijar su valor exacto,
     <code>expect(...).<?php hueco(21, 14); ?>(0)</code>.</p>

  <?php mc('m4'); mc('m6'); ?>
</div>

<div class="card">
  <h2>C. Los casos borde que de verdad importan</h2>

  <p>Rellena los numeros de los tests que ya existen:</p>

  <ul>
    <li>Descuento: con <?php hueco(30, 3); ?> dias <b>si</b> aplica; con <?php hueco(31, 3); ?> dias <b>no</b>.</li>
    <li>49 horas de alquiler se cobran como <?php hueco(32, 3); ?> dias.</li>
    <li>Cancelacion: con <?php hueco(34, 4); ?> h <b>si</b> se puede; con <?php hueco(33, 4); ?> h exactas <b>no</b>.</li>
    <li>7 dias a $150.000 dan un total de $<?php hueco(35, 10); ?>.</li>
    <li>Con una politica de temporada (5 dias, 15 %), 5 dias dan $<?php hueco(36, 10); ?>.</li>
  </ul>

  <div class="nota">
    Fijate en el patron: cada test esta puesto <b>justo al lado de una frontera</b>.
    Ninguno comprueba valores comodos del medio, porque ahi nunca hay bugs.
  </div>

  <?php mc('m3'); mc('m5'); mc('m7'); ?>
</div>

<div class="card">
  <h2>D. De memoria: la linea completa</h2>

  <?php linea(40, 'Comprobar que <code>Money.cop(-1)</code> lanza <code>InvalidMoneyError</code>.'); ?>
  <?php linea(41, 'Comprobar que un descuento del 10 % sobre 1.050.000 da 945.000.'); ?>
</div>

<?php pie('tercero.php', 'quinto.php'); ?>
