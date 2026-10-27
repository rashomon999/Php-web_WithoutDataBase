<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. el fetch a mano --- */
  1  => ['localStorage'],
  2  => ['token'],
  3  => ['Authorization'],
  4  => ['Bearer'],
  5  => ['any', 'any[]'],
  6  => ['3001'],

  /* --- B. el calculo metido en la vista --- */
  10 => ['Math.ceil', 'ceil'],
  11 => ['Math.round', 'round'],
  12 => ['86400000', '86_400_000', '86400_000'],
  13 => ['>=', 'mayor o igual'],
  14 => ['>', 'mayor'],
  15 => ['0.9'],
  16 => ['945000', '945.000', '$945.000'],
  17 => ['1050000', '1.050.000', '$1.050.000'],

  /* --- C. el bug de cancelar --- */
  20 => ['401'],
  21 => ['422'],
  22 => ['res.ok', 'ok'],
  23 => ['DELETE'],

  /* --- D. los nombres del backend --- */
  30 => ['snake_case', 'snake case'],
  31 => ['start_date'],
  32 => ['brand_name'],
  33 => ['mapper'],

  /* --- E. responsabilidades --- */
  40 => ['dominio', 'domain'],
  41 => ['infraestructura', 'infrastructure', 'infraestuctura'],
  42 => ['presentacion', 'presentación', 'presentation'],
  43 => ['aplicacion', 'aplicación', 'application'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => '¿Cuantas responsabilidades distintas tiene hoy <code>MyRentals.tsx</code>?',
    'opciones' => [
      'a' => 'Una sola: mostrar la lista. Todo lo demas son detalles de implementacion.',
      'b' => 'Dos: pedir los datos y pintarlos.',
      'c' => 'Seis o siete: direccion del servidor, sesion, formato del JSON, calculo del precio, regla de cancelacion, estado y errores, y el HTML.',
      'd' => 'Ninguna: es un componente de presentacion puro.',
    ],
    'correcta' => 'c',
    'porque' => 'La prueba es preguntarse <b>quien pediria cambiar cada cosa</b>: quien despliega (la URL), seguridad (el token), el equipo del backend (los nombres del JSON), negocio (descuento y plazo de cancelacion), producto (los mensajes) y mercadeo (el diseño). Seis jefes distintos tocando el mismo archivo.',
  ],

  'm2' => [
    'texto' => 'Si el backend renombra <code>start_date</code> a <code>startsAt</code>, lo peor del codigo actual no es cuantos archivos hay que tocar, sino:',
    'opciones' => [
      'a' => 'Que hay que reiniciar el servidor.',
      'b' => 'Que los datos estan tipados como <code>any</code>, asi que TypeScript no avisa de nada: si olvidas un sitio, sale <code>Invalid Date</code> y el precio da <code>NaN</code>, en silencio.',
      'c' => 'Que hay que volver a hacer login.',
      'd' => 'Que Next.js cachea el JSON viejo.',
    ],
    'correcta' => 'b',
    'porque' => 'Un fallo que el compilador detecta cuesta minutos; uno que solo se ve en pantalla cuesta una llamada de un cliente molesto. Con un <code>mapper</code> y una entidad tipada, el cambio es un solo archivo <b>y</b> el compilador te lleva de la mano.',
  ],

  'm3' => [
    'texto' => 'Cancelas un alquiler, desaparece de la pantalla y al recargar vuelve a aparecer. ¿Por que?',
    'opciones' => [
      'a' => 'Porque el <code>DELETE</code> sale sin el header <code>Authorization</code>, la API responde 401, y el componente quita el alquiler de la lista sin mirar si la respuesta fue exitosa.',
      'b' => 'Porque React no refresca el estado tras un <code>DELETE</code>.',
      'c' => 'Porque la API guarda en memoria y se reinicio.',
      'd' => 'Porque falta un <code>revalidatePath</code> de Next.',
    ],
    'correcta' => 'a',
    'porque' => 'Son dos fallos encadenados: no mandar el token, y no comprobar <code>res.ok</code>. El alquiler nunca se cancelo en el servidor y el cliente nunca se entero. Es justo la queja del punto 3 del requerimiento.',
  ],

  'm4' => [
    'texto' => 'Con tarifa de $150.000 y exactamente 7 dias, <code>MyRentals</code> muestra $945.000 y <code>VehicleList</code> muestra $1.050.000. ¿Cual esta bien y por que?',
    'opciones' => [
      'a' => '<code>VehicleList</code>, porque el descuento es a partir del octavo dia.',
      'b' => 'Los dos: depende de si la reserva ya existe o no.',
      'c' => '<code>MyRentals</code>, porque la regla dice "una semana o mas", o sea <code>&gt;=7</code>, y <code>VehicleList</code> usa <code>&gt;7</code>.',
      'd' => 'Ninguno: deberia ser $1.000.000 redondeado.',
    ],
    'correcta' => 'c',
    'porque' => 'El requerimiento tambien dice que el precio que el cliente ve antes de confirmar debe ser <b>exactamente</b> el que aparece despues, y que si no coinciden hay que cobrar el menor. Dos copias de una regla siempre terminan desincronizandose.',
  ],

  'm5' => [
    'texto' => 'Ademas del descuento, los dos componentes difieren en el redondeo de los dias: <code>Math.ceil</code> frente a <code>Math.round</code>. ¿Cual cumple la regla del negocio?',
    'opciones' => [
      'a' => '<code>Math.round</code>, porque es mas justo para el cliente.',
      'b' => '<code>Math.ceil</code>: "si el cliente devuelve el carro una hora tarde, le cobramos el dia completo".',
      'c' => '<code>Math.floor</code>, para no cobrar de mas.',
      'd' => 'Da igual: con fechas de dias completos siempre coinciden.',
    ],
    'correcta' => 'b',
    'porque' => 'Con <code>round</code>, 49 horas se convierten en 2 dias; con <code>ceil</code>, en 3. La opcion d es la trampa: <b>casi siempre</b> coinciden, y por eso el bug sobrevive hasta que un cliente alquila de lunes 10:00 a miercoles 11:00.',
  ],

  'm6' => [
    'texto' => 'De los siete cambios anunciados por el cliente, ¿cual NO toca la capa de dominio?',
    'opciones' => [
      'a' => 'Cambiar el descuento de temporada en diciembre.',
      'b' => 'Pasar el plazo de cancelacion de 24 a 48 horas.',
      'c' => 'Mercadeo renueva el diseño visual con otra libreria de componentes.',
      'd' => 'Ninguno: todos tocan el dominio.',
    ],
    'correcta' => 'c',
    'porque' => 'Ese es el objetivo del curso: que un cambio de diseño toque <b>solo</b> presentacion, que un cambio de nombres del JSON toque <b>solo</b> el mapper, y que un cambio de regla toque <b>solo</b> una constante del dominio. Hoy, los tres tocan el mismo archivo.',
  ],

  'm7' => [
    'texto' => 'El cliente quiere una app movil mas adelante y pide "que las reglas del negocio no se tengan que volver a escribir". ¿Que lo hace posible?',
    'opciones' => [
      'a' => 'Usar React Native, que comparte componentes.',
      'b' => 'Que el dominio sea TypeScript puro, sin <code>fetch</code>, sin React y sin <code>localStorage</code>: solo funciones y clases que se pueden copiar tal cual.',
      'c' => 'Guardar las reglas en la base de datos.',
      'd' => 'Exponer las reglas como endpoints del backend.',
    ],
    'correcta' => 'b',
    'porque' => 'Esta es la razon practica de la regla "el dominio no depende de nadie". Un <code>calculatePrice</code> que no importa nada del mundo exterior funciona igual en web, en movil y en un test que corre en milisegundos.',
  ],

  'm8' => [
    'texto' => 'La rama <code>main</code> del repo "funciona, pero esta mal organizada a proposito". ¿Que significa eso para estudiar?',
    'opciones' => [
      'a' => 'Que hay que memorizar <code>MyRentals.tsx</code> tal cual, porque es el codigo final.',
      'b' => 'Que es el punto de partida: el objetivo no es que funcione (ya funciona), sino que cada cambio futuro toque un solo sitio.',
      'c' => 'Que el profesor se equivoco al subirla.',
      'd' => 'Que hay que borrarla antes de empezar.',
    ],
    'correcta' => 'b',
    'porque' => '"Funciona" y "esta bien hecho" son cosas distintas. Todo el curso vive en esa diferencia: el codigo legado pasa las pruebas manuales, pero cada peticion del cliente cuesta semanas y rompe algo.',
  ],
];

$RETOS = [];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 1 — El codigo legado y las cuatro preguntas', 'MyRentals.tsx: que hace de mas, que hace mal y por que duele cada cambio');
?>

<div class="card">
  <h2>De que va esto</h2>
  <p>Proyecto <b>RodaYa</b> (<code>icesi-2026b-nextjs</code>): el frontend de una empresa de alquiler de vehiculos.
     La rama <code>main</code> <b>funciona, pero esta mal organizada a proposito</b>. Este cuestionario cubre
     las cuatro preguntas del taller de la clase 1, que son las que justifican todo lo demas.</p>
  <div class="nota">
    La pregunta que se repite en todo el curso no es "¿funciona?", sino
    <b>"¿quien pediria cambiar esto, y cuantos sitios tendria que tocar?"</b>.
  </div>
</div>

<div class="card">
  <h2>A. Como pide los datos hoy</h2>
  <p>Asi carga la lista el componente, dentro de un <code>useEffect</code>:</p>

<pre><code>const [items, setItems] = useState&lt;<?php hueco(5, 6); ?>[]&gt;([]);   // sin tipos: el compilador no ayuda

const token = <?php hueco(1, 14); ?>.getItem('<?php hueco(2, 8); ?>');

fetch('http://localhost:<?php hueco(6, 6); ?>/rentals/me', {
  headers: { <?php hueco(3, 15); ?>: `<?php hueco(4, 8); ?> ${token}` },
})
  .then((r) =&gt; r.json())
  .then((data) =&gt; setItems(data))
  .catch(() =&gt; setError('Error cargando'));</code></pre>

  <p>En esas pocas lineas ya hay tres responsabilidades que no son "mostrar alquileres":
     la direccion del servidor, la forma de guardar la sesion y el formato del JSON.
     Las tres estan en la lista de cambios anunciados por el cliente.</p>

  <?php mc('m1'); mc('m7'); ?>
</div>

<div class="card">
  <h2>B. El calculo metido en la vista</h2>
  <p>Los dos componentes calculan lo mismo... de forma distinta:</p>

<pre><code>// MyRentals.tsx
const days  = <?php hueco(10, 10); ?>((end - start) / <?php hueco(12, 12); ?>);
const total = days * r.daily_rate * (days <?php hueco(13, 4); ?> 7 ? <?php hueco(15, 5); ?> : 1);

// VehicleList.tsx
const days  = <?php hueco(11, 11); ?>((end - start) / 86_400_000);
const total = days * v.daily_rate * (days <?php hueco(14, 4); ?> 7 ? 0.9 : 1);</code></pre>

  <p>Con tarifa de $150.000 y <b>exactamente 7 dias</b>, uno muestra
     $<?php hueco(16, 10); ?> y el otro $<?php hueco(17, 11); ?>.</p>

  <div class="avisoflujo">
    <b>Por que importa:</b> el requerimiento dice que el precio que el cliente ve antes de confirmar
    debe ser <b>exactamente</b> el que aparece despues en "Mis alquileres", y que si no coinciden
    hay que cobrarle el menor. Una regla copiada en dos sitios es una regla que ya empezo a divergir.
  </div>

  <?php mc('m4'); mc('m5'); ?>
</div>

<div class="card">
  <h2>C. El bug de cancelar</h2>
  <p>Cancelas, el alquiler desaparece... y al recargar vuelve. El codigo:</p>

<pre><code>const cancel = async (id: number) =&gt; {
  await fetch(`http://localhost:3001/rentals/${id}`, { method: '<?php hueco(23, 8); ?>' });
  //                                   falta el header Authorization  &lt;--
  setItems(items.filter((i) =&gt; i.id !== id));
  //  y nunca se mira <?php hueco(22, 8); ?>  &lt;--
};</code></pre>

  <p>Sin token, la API responde <?php hueco(20, 5); ?>. Y aunque el token estuviera,
     si faltan 24 horas o menos la API responde <?php hueco(21, 5); ?> con un mensaje
     que el cliente nunca llega a ver.</p>

  <?php mc('m3'); ?>
</div>

<div class="card">
  <h2>D. Los nombres del backend</h2>
  <p>La API simulada imita al backend de NestJS: rutas y JSON en <?php hueco(30, 12); ?>.
     Por eso el componente lee <code><?php hueco(31, 12); ?></code> y
     <code><?php hueco(32, 12); ?></code> directamente en el JSX.</p>

  <p>El cliente ya aviso de que esos nombres van a cambiar. La pieza que traduce el JSON del
     servidor a la entidad del dominio se llama <?php hueco(33, 10); ?>, y es el unico
     archivo que habria que tocar.</p>

  <?php mc('m2'); mc('m6'); mc('m8'); ?>
</div>

<div class="card">
  <h2>E. A donde se va a mudar cada cosa</h2>
  <p>Adelanto del cuestionario 2. Cada responsabilidad de <code>MyRentals.tsx</code> tiene su capa:</p>

  <ul>
    <li>Calcular dias, precio y si se puede cancelar &rarr; <?php hueco(40, 14); ?></li>
    <li>Coordinar "traeme mis alquileres y calculales el precio" &rarr; <?php hueco(43, 14); ?></li>
    <li>El <code>fetch</code>, el token y la URL del servidor &rarr; <?php hueco(41, 18); ?></li>
    <li>El hook de React y el HTML &rarr; <?php hueco(42, 14); ?></li>
  </ul>
</div>

<?php pie('cero.php', 'segundo.php'); ?>
