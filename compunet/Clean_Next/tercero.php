<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. DomainError --- */
  1  => ['abstract'],
  2  => ['Error'],
  3  => ['new.target.name'],
  4  => ['instanceof'],

  /* --- B. Money --- */
  10 => ['private'],
  11 => ['Number.isInteger', 'isInteger'],
  12 => ['InvalidMoneyError'],
  13 => ['0'],
  14 => ['static'],
  15 => ['Math.round', 'round'],
  16 => ['100'],
  17 => ['Money.cop', 'cop'],
  18 => ['this.amount'],
  19 => ['945000', '945_000'],

  /* --- C. DateRange --- */
  25 => ['Number.isNaN', 'isNaN'],
  26 => ['getTime'],
  27 => ['InvalidDateRangeError'],
  28 => ['new Date(start)', 'new Date (start)'],
  29 => ['Math.ceil', 'ceil'],
  30 => ['DAY_MS'],
  31 => ['HOUR_MS'],
  32 => ['3'],
  33 => ['negativo'],

  /* --- D. politicas --- */
  40 => ['minDays'],
  41 => ['percentage'],
  42 => ['minHoursBeforeStart'],
  43 => ['7'],
  44 => ['10'],
  45 => ['24'],

  /* --- E. las reglas --- */
  50 => ['days()', 'period.days()'],
  51 => ['times'],
  52 => ['>='],
  53 => ['withDiscount'],
  54 => ['hoursUntilStart'],
  55 => ['>'],

  /* --- F. de memoria --- */
  60 => ['return Math.ceil((this.end.getTime() - this.start.getTime()) / DAY_MS);'],
  61 => ['return rental.period.hoursUntilStart(now) > policy.minHoursBeforeStart;'],
  62 => ['const discountPercentage = days >= policy.minDays ? policy.percentage : 0;'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => '¿Por que el constructor de <code>Money</code> es <code>private</code> y se crea con <code>Money.cop(...)</code>?',
    'opciones' => [
      'a' => 'Por rendimiento: los metodos estaticos son mas rapidos.',
      'b' => 'Para que no exista forma de crear un <code>Money</code> invalido: toda instancia pasa obligatoriamente por las validaciones de <code>cop</code>.',
      'c' => 'Porque TypeScript no permite <code>new</code> en clases exportadas.',
      'd' => 'Para poder cambiar la moneda despues.',
    ],
    'correcta' => 'b',
    'porque' => 'Es lo que hace util a un <b>value object</b>: si existe, es valido. Si el constructor fuera publico, <code>new Money(-5.7)</code> seria legal y la validacion se volveria una sugerencia.',
  ],

  'm2' => [
    'texto' => '<code>withDiscount</code> termina con <code>return Money.cop(...)</code> en vez de <code>new Money(...)</code>. ¿Que gana con eso?',
    'opciones' => [
      'a' => 'Nada, es equivalente.',
      'b' => 'Que el resultado del descuento vuelve a pasar por las validaciones: si por un error diera un decimal o un negativo, revienta ahi mismo y no mas adelante.',
      'c' => 'Que el objeto original se modifica.',
      'd' => 'Que se evita el redondeo.',
    ],
    'correcta' => 'b',
    'porque' => 'Un value object protege sus invariantes <b>en cada operacion</b>, no solo al crearse. Y como devuelve una instancia nueva, el original no cambia: por eso el test comprueba que <code>rate.amount</code> sigue valiendo 150.000 despues de multiplicar.',
  ],

  'm3' => [
    'texto' => '<code>DateRange.create</code> guarda <code>new Date(start)</code> en vez de <code>start</code>. ¿Por que?',
    'opciones' => [
      'a' => 'Para convertir la zona horaria a Colombia.',
      'b' => 'Porque <code>Date</code> es mutable: si alguien de fuera hace <code>start.setFullYear(2030)</code>, cambiaria el periodo ya creado. La copia defensiva lo impide.',
      'c' => 'Para que funcione con strings ISO.',
      'd' => 'Porque <code>readonly</code> no funciona con objetos.',
    ],
    'correcta' => 'b',
    'porque' => '<code>readonly start</code> solo impide reasignar la propiedad, no modificar el objeto al que apunta. Hay un test dedicado a esto: modifica la fecha original y comprueba que el rango no se entero.',
  ],

  'm4' => [
    'texto' => 'El descuento se decide con <code>days &gt;= policy.minDays</code>. ¿Que pasaria con <code>&gt;</code>?',
    'opciones' => [
      'a' => 'Nada, el resultado es el mismo.',
      'b' => 'Que un alquiler de exactamente 7 dias se quedaria sin descuento: $1.050.000 en vez de $945.000, justo el bug de <code>VehicleList.tsx</code>.',
      'c' => 'Que el descuento se aplicaria dos veces.',
      'd' => 'Que fallaria la compilacion.',
    ],
    'correcta' => 'b',
    'porque' => 'La regla del cliente dice "una semana o mas". Un caracter de diferencia que solo se nota en el borde exacto: por eso hay un test con 7 dias y otro con 6.',
  ],

  'm5' => [
    'texto' => '<code>canCancel</code> recibe <code>now: Date</code> como parametro en vez de llamar a <code>new Date()</code> dentro. ¿Cual es la razon principal?',
    'opciones' => [
      'a' => 'Ahorrar memoria.',
      'b' => 'Que la funcion sea <b>determinista</b> y se pueda probar: con el reloj dentro, el test daria un resultado distinto cada dia y no se podria fijar el borde de las 24 horas.',
      'c' => 'Porque <code>new Date()</code> no funciona en el navegador.',
      'd' => 'Para soportar varias zonas horarias.',
    ],
    'correcta' => 'b',
    'porque' => 'El reloj es una dependencia del mundo exterior, igual que la red. El dominio no la busca: la recibe. Quien decide el "ahora" es el caso de uso, que si puede llamar a <code>new Date()</code>.',
  ],

  'm6' => [
    'texto' => 'Las politicas (<code>STANDARD_DISCOUNT</code>, <code>STANDARD_CANCELLATION</code>) son objetos que se pasan como tercer parametro con valor por defecto. ¿Que problema del cliente resuelve eso?',
    'opciones' => [
      'a' => 'El cambio 1: los nombres del JSON del backend.',
      'b' => 'Los cambios 2 y 3: descuentos de temporada y pasar la cancelacion de 24 a 48 horas para algunos carros, sin tocar la logica.',
      'c' => 'El cambio 5: el servidor nuevo en produccion.',
      'd' => 'El cambio 6: el rediseño de mercadeo.',
    ],
    'correcta' => 'b',
    'porque' => 'Con el numero escrito dentro de la funcion, "48 horas solo para camionetas" obliga a tocar la regla. Con la politica como parametro, es pasar otro objeto; la funcion ni se entera. Hay un test exactamente para ese caso.',
  ],

  'm7' => [
    'texto' => '¿Para que sirve que todos los errores del negocio hereden de <code>DomainError</code>?',
    'opciones' => [
      'a' => 'Para que se muestren en rojo en la consola.',
      'b' => 'Para que las capas de fuera distingan con <code>error instanceof DomainError</code> entre "el negocio dice que no" (mensaje claro al cliente) y una falla tecnica (red caida, 500).',
      'c' => 'Para que Vitest los capture automaticamente.',
      'd' => 'Porque TypeScript lo exige al extender <code>Error</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'El requerimiento pide "un mensaje entendible cuando algo falla, no un codigo de error". Esa distincion es lo que permite mostrar "ya no se puede cancelar" en un caso y "no pudimos conectarnos" en el otro.',
  ],

  'm8' => [
    'texto' => 'Un alquiler que ya empezo: <code>hoursUntilStart</code> devuelve un numero negativo. ¿Hace falta un <code>if</code> extra en <code>canCancel</code>?',
    'opciones' => [
      'a' => 'Si, hay que comprobar antes si la fecha ya paso.',
      'b' => 'No: un negativo nunca es mayor que 24, asi que la misma comparacion ya cubre ese caso.',
      'c' => 'Si, porque <code>hoursUntilStart</code> lanzaria un error.',
      'd' => 'No, porque la API ya lo impide.',
    ],
    'correcta' => 'b',
    'porque' => 'Un buen diseño hace que los casos borde caigan solos. Aun asi, el test lo comprueba explicitamente: si mañana alguien cambia el signo, quieres enterarte.',
  ],

  'm9' => [
    'texto' => '<code>Money.cop(1500.5)</code> lanza un error. ¿Por que no redondear y seguir?',
    'opciones' => [
      'a' => 'Porque redondear es lento.',
      'b' => 'Porque un decimal ahi significa que <b>alguien calculo mal</b>: el requerimiento dice pesos sin centavos. Fallar temprano enseña el bug; redondear en silencio lo esconde.',
      'c' => 'Porque JavaScript no sabe redondear bien.',
      'd' => 'Porque el backend rechaza decimales.',
    ],
    'correcta' => 'b',
    'porque' => 'Fijate en la diferencia: <code>cop</code> <b>rechaza</b> decimales de entrada, mientras <code>withDiscount</code> y <code>times</code> <b>redondean</b> su propio resultado. Uno protege de datos malos; el otro produce un dato valido.',
  ],
];

$RETOS = [
  'r1' => [
    'titulo' => 'la clase Money completa',
    'huecos' => [10, 11, 12, 13, 14, 15, 16, 17, 18],
    'codigo' => "export class Money {
  private constructor(readonly amount: number) {}

  static cop(amount: number): Money {
    if (!Number.isInteger(amount)) {
      throw new InvalidMoneyError(`El monto debe ser un numero entero de pesos: \${amount}`);
    }
    if (amount < 0) {
      throw new InvalidMoneyError(`El monto no puede ser negativo: \${amount}`);
    }
    return new Money(amount);
  }

  static zero(): Money {
    return new Money(0);
  }

  withDiscount(percentage: number): Money {
    return Money.cop(Math.round((this.amount * (100 - percentage)) / 100));
  }

  times(factor: number): Money {
    return Money.cop(Math.round(this.amount * factor));
  }

  equals(other: Money): boolean {
    return this.amount === other.amount;
  }
}",
  ],

  'r2' => [
    'titulo' => 'la funcion calculatePrice completa',
    'huecos' => [50, 51, 52, 53],
    'codigo' => "export function calculatePrice(
  period: DateRange,
  dailyRate: Money,
  policy: DiscountPolicy = STANDARD_DISCOUNT,
): RentalPrice {
  const days = period.days();
  const subtotal = dailyRate.times(days);
  const discountPercentage = days >= policy.minDays ? policy.percentage : 0;
  return {
    days,
    subtotal,
    discountPercentage,
    total: subtotal.withDiscount(discountPercentage),
  };
}",
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 3 — El dominio: los TODO resueltos', 'Money, DateRange, las politicas, calculatePrice, canCancel y DomainError');
?>

<div class="card">
  <h2>Que es "implementar el dominio"</h2>
  <p>En la rama de la clase 2, estas funciones existian pero lanzaban
     <code>throw new Error("TODO: not implemented")</code>: el nombre y los parametros estaban
     decididos, faltaba el cuerpo. En <code>clase3-next</code> ya estan escritas, y son <b>TypeScript puro</b>:
     ni <code>fetch</code>, ni React, ni <code>localStorage</code>.</p>
  <div class="nota">
    Los numeros del negocio (24 h, 7 dias, 10 %) <b>no</b> viven dentro de las funciones,
    sino en objetos de politica aparte. Esa separacion es la que responde a los cambios 2 y 3 del cliente.
  </div>
</div>

<div class="card">
  <h2>A. La base de los errores</h2>

<pre><code>// shared/domain/errors/domain-error.ts
export <?php hueco(1, 10); ?> class DomainError extends <?php hueco(2, 8); ?> {
  constructor(message: string) {
    super(message);
    this.name = <?php hueco(3, 16); ?>;
  }
}</code></pre>

  <p>Es <code>abstract</code> porque nadie debe lanzar un <code>DomainError</code> generico:
     se lanzan sus hijos (<code>InvalidMoneyError</code>, <code>CancellationNotAllowedError</code>...).
     Las capas de fuera preguntan <code>error <?php hueco(4, 12); ?> DomainError</code>
     para separar "el negocio dice que no" de "se cayo la red".</p>

  <?php mc('m7'); ?>
</div>

<div class="card">
  <h2>B. Money</h2>

<pre><code>export class Money {
  <?php hueco(10, 9); ?> constructor(readonly amount: number) {}

  <?php hueco(14, 8); ?> cop(amount: number): Money {
    if (!<?php hueco(11, 18); ?>(amount)) {
      throw new <?php hueco(12, 20); ?>(`El monto debe ser un numero entero de pesos`);
    }
    if (amount &lt; <?php hueco(13, 3); ?>) {
      throw new InvalidMoneyError(`El monto no puede ser negativo`);
    }
    return new Money(amount);
  }

  withDiscount(percentage: number): Money {
    return <?php hueco(17, 12); ?>(<?php hueco(15, 12); ?>((<?php hueco(18, 14); ?> * (<?php hueco(16, 5); ?> - percentage)) / 100));
  }
}</code></pre>

  <p>Comprobacion: <code>Money.cop(1_050_000).withDiscount(10).amount</code> vale
     <?php hueco(19, 10); ?>.</p>

  <?php mc('m1'); mc('m2'); mc('m9'); ?>

  <?php reto('r1'); ?>
</div>

<div class="card">
  <h2>C. DateRange</h2>

<pre><code>const HOUR_MS = 60 * 60 * 1000;
const DAY_MS  = 24 * HOUR_MS;

static create(start: Date, end: Date): DateRange {
  if (<?php hueco(25, 16); ?>(start.getTime()) || Number.isNaN(end.getTime())) {
    throw new <?php hueco(27, 22); ?>('Las fechas del periodo no son validas');
  }
  if (end.<?php hueco(26, 9); ?>() &lt;= start.getTime()) {
    throw new InvalidDateRangeError('La fecha de fin debe ser posterior a la de inicio');
  }
  // Copias defensivas: Date es mutable.
  return new DateRange(<?php hueco(28, 18); ?>, new Date(end));
}

days(): number {
  return <?php hueco(29, 11); ?>((this.end.getTime() - this.start.getTime()) / <?php hueco(30, 8); ?>);
}

hoursUntilStart(now: Date): number {
  return (this.start.getTime() - now.getTime()) / <?php hueco(31, 9); ?>;
}</code></pre>

  <p>Del 3 nov 10:00 al 5 nov 11:00 hay 49 horas, o sea <?php hueco(32, 3); ?> dias cobrables.
     Y si el periodo ya empezo, <code>hoursUntilStart</code> devuelve un numero
     <?php hueco(33, 10); ?>.</p>

  <?php mc('m3'); mc('m8'); ?>
</div>

<div class="card">
  <h2>D. Las politicas</h2>

<pre><code>export interface DiscountPolicy {
  readonly <?php hueco(40, 9); ?>: number;
  readonly <?php hueco(41, 12); ?>: number;
}
export const STANDARD_DISCOUNT: DiscountPolicy = { minDays: <?php hueco(43, 3); ?>, percentage: <?php hueco(44, 4); ?> };

export interface CancellationPolicy {
  readonly <?php hueco(42, 21); ?>: number;
}
export const STANDARD_CANCELLATION: CancellationPolicy = { minHoursBeforeStart: <?php hueco(45, 4); ?> };</code></pre>

  <div class="avisoflujo">
    <b>Por que son objetos y no constantes sueltas:</b> porque entran como parametro con valor
    por defecto. El codigo normal no las menciona, pero diciembre o una politica de 48 horas
    se resuelven pasando otro objeto, sin tocar ni una linea de logica.
  </div>

  <?php mc('m6'); ?>
</div>

<div class="card">
  <h2>E. Las dos reglas</h2>

<pre><code>export function calculatePrice(period, dailyRate, policy = STANDARD_DISCOUNT): RentalPrice {
  const days = period.<?php hueco(50, 9); ?>;
  const subtotal = dailyRate.<?php hueco(51, 7); ?>(days);
  const discountPercentage = days <?php hueco(52, 4); ?> policy.minDays ? policy.percentage : 0;
  return { days, subtotal, discountPercentage, total: subtotal.<?php hueco(53, 14); ?>(discountPercentage) };
}

export function canCancel(rental, now, policy = STANDARD_CANCELLATION): boolean {
  return rental.period.<?php hueco(54, 17); ?>(now) <?php hueco(55, 3); ?> policy.minHoursBeforeStart;
}</code></pre>

  <?php mc('m4'); mc('m5'); ?>

  <?php reto('r2'); ?>
</div>

<div class="card">
  <h2>F. De memoria: la linea completa</h2>

  <?php linea(60, 'El cuerpo de <code>days()</code>, con el redondeo que cobra el dia completo.'); ?>
  <?php linea(61, 'El cuerpo de <code>canCancel</code>, con la comparacion correcta.'); ?>
  <?php linea(62, 'La linea de <code>calculatePrice</code> que decide el porcentaje de descuento.'); ?>
</div>

<?php pie('segundo.php', 'cuarto.php'); ?>
