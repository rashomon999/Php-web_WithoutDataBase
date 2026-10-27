<?php
require_once __DIR__ . '/motor.php';

$SOLUCIONES = [

  /* --- A. el puerto --- */
  1  => ['interface'],
  2  => ['findMine'],
  3  => ['cancel'],
  4  => ['Promise'],
  5  => ['void'],
  6  => ['application', 'aplicacion', 'aplicación'],

  /* --- B. el caso de uso --- */
  10 => ['Deps'],
  11 => ['STANDARD_DISCOUNT'],
  12 => ['STANDARD_CANCELLATION'],
  13 => ['new Date()', 'new Date'],
  14 => ['await'],
  15 => ['map'],
  16 => ['calculatePrice'],
  17 => ['canCancel'],
  18 => ['async'],
  19 => ['makeListMyRentals'],

  /* --- C. inyeccion de dependencias --- */
  25 => ['fabrica', 'fábrica', 'factory'],
  26 => ['di'],
  27 => ['implements'],
  28 => ['falso', 'fake', 'doble'],

  /* --- D. lo que falta --- */
  35 => ['CancellationNotAllowedError'],
  36 => ['RentalNotFoundError'],
  37 => ['mapper'],
  38 => ['HttpRentalRepository'],

  /* --- E. de memoria --- */
  45 => ['const mine = await rentals.findMine();'],
  46 => ['canCancel: canCancel(rental, now, cancellationPolicy)'],
];

$MULTIPLE = [

  'm1' => [
    'texto' => 'Un "caso de uso" es, en una frase:',
    'opciones' => [
      'a' => 'Una funcion que hace una peticion HTTP.',
      'b' => 'Una accion que el cliente quiere hacer, escrita sin saber de donde vienen los datos ni como se pinta el resultado.',
      'c' => 'Un componente de React que coordina otros componentes.',
      'd' => 'La clase que representa una tabla de la base de datos.',
    ],
    'correcta' => 'b',
    'porque' => 'En este proyecto son cuatro: ver mis alquileres, cancelar uno, buscar carros disponibles y reservar. Salen directamente de la seccion "que necesitan hacer nuestros clientes" del requerimiento.',
  ],

  'm2' => [
    'texto' => '<code>makeListMyRentals</code> es una funcion que devuelve otra funcion. ¿Para que ese rodeo?',
    'opciones' => [
      'a' => 'Para que sea asincrona.',
      'b' => 'La primera llamada recibe las <b>dependencias</b> (el repositorio, las politicas) y se hace una sola vez al arrancar; la funcion devuelta es la que se ejecuta cada vez que hay que listar, ya sin parametros.',
      'c' => 'Para evitar recursion.',
      'd' => 'Porque React exige funciones puras.',
    ],
    'correcta' => 'b',
    'porque' => 'Es inyeccion de dependencias sin libreria ni clases: se llama <b>factory</b>. El hook recibe una funcion lista para usar y no sabe nada del repositorio que lleva dentro.',
  ],

  'm3' => [
    'texto' => '¿Por que el caso de uso llama a <code>new Date()</code> y el dominio no?',
    'opciones' => [
      'a' => 'Por rendimiento.',
      'b' => 'Porque el reloj es una dependencia del mundo exterior: el dominio la recibe como parametro para ser determinista, y alguien tiene que decidir el "ahora". Ese alguien es el caso de uso.',
      'c' => 'Porque <code>canCancel</code> no acepta fechas.',
      'd' => 'Porque el dominio corre en el servidor y el caso de uso en el navegador.',
    ],
    'correcta' => 'b',
    'porque' => 'Fijate en que lo llama <b>una sola vez</b>, antes del <code>map</code>: asi todos los alquileres de la lista se evaluan con el mismo instante. Si estuviera dentro del map, dos alquileres podrian juzgarse con relojes distintos.',
  ],

  'm4' => [
    'texto' => 'El caso de uso devuelve <code>{ rental, price, canCancel }</code> en vez de solo la lista de alquileres. ¿Que consigue?',
    'opciones' => [
      'a' => 'Reducir el tamaño de la respuesta.',
      'b' => 'Que la vista reciba todo ya decidido y solo tenga que pintarlo: no calcula precios ni decide si mostrar el boton, solo formatea.',
      'c' => 'Que el repositorio pueda cachear.',
      'd' => 'Que TypeScript infiera mejor los tipos.',
    ],
    'correcta' => 'b',
    'porque' => 'Compara con el componente legado, que calculaba el precio dentro del JSX. Aqui la vista ya no tiene ninguna decision de negocio: recibe <code>canCancel: false</code> y simplemente no pinta el boton.',
  ],

  'm5' => [
    'texto' => 'Para probar <code>makeListMyRentals</code> sin servidor, se le pasa:',
    'opciones' => [
      'a' => 'Un servidor de pruebas levantado en el puerto 3001.',
      'b' => 'Un objeto cualquiera que cumpla <code>RentalRepository</code> y devuelva alquileres de mentira desde un array en memoria.',
      'c' => 'El <code>HttpRentalRepository</code> con una URL falsa.',
      'd' => 'Nada: los casos de uso no se prueban.',
    ],
    'correcta' => 'b',
    'porque' => 'Esa es toda la ganancia del puerto. El test puede ademas fijar el reloj y las politicas, asi que comprueba la <b>coordinacion</b> (que llame al repositorio y calcule bien cada fila) sin depender de la red.',
  ],

  'm6' => [
    'texto' => 'Las politicas llegan al caso de uso con valor por defecto (<code>discountPolicy = STANDARD_DISCOUNT</code>). ¿Que permite?',
    'opciones' => [
      'a' => 'Que el codigo normal no las mencione, y que en diciembre o en un test se pueda pasar otra sin tocar ni el dominio ni la vista.',
      'b' => 'Que se puedan cambiar en caliente desde el navegador.',
      'c' => 'Que el dominio no necesite politicas.',
      'd' => 'Que el repositorio decida el descuento.',
    ],
    'correcta' => 'a',
    'porque' => 'La politica se pasa de mano en mano: quien arma la aplicacion (la capa <code>di</code>) decide cual rige, el caso de uso la transporta y el dominio la aplica. Ninguno de los tres tiene el numero escrito dentro.',
  ],

  'm7' => [
    'texto' => 'Falta por escribir el caso de uso <code>cancelRental</code>. ¿Cual es el orden correcto de lo que debe hacer?',
    'opciones' => [
      'a' => 'Llamar al repositorio y, si responde error, mostrar un mensaje.',
      'b' => 'Preguntar al dominio con <code>canCancel</code>; si dice que no, lanzar <code>CancellationNotAllowedError</code> sin tocar la red; si dice que si, llamar a <code>repo.cancel(id)</code>.',
      'c' => 'Quitar el alquiler de la lista y despues avisar al servidor.',
      'd' => 'Validar la fecha en el componente antes de llamar al caso de uso.',
    ],
    'correcta' => 'b',
    'porque' => 'La opcion c es exactamente el bug del codigo legado. Y la regla se comprueba en el cliente para dar respuesta inmediata, pero el servidor vuelve a comprobarla (responde 422): la validacion del frontend es comodidad, nunca seguridad.',
  ],

  'm8' => [
    'texto' => 'En <code>clase3-next</code>, las carpetas <code>infraestucture</code>, <code>presentation</code> y <code>di</code> de rentals siguen vacias, y <code>MyRentals.tsx</code> sigue con su <code>fetch</code>. ¿Que significa?',
    'opciones' => [
      'a' => 'Que la refactorizacion se abandono.',
      'b' => 'Que se construye de adentro hacia afuera: primero el dominio, luego los tests, luego los casos de uso, y solo al final se conecta con la API y la vista. Hasta entonces, el componente viejo sigue funcionando.',
      'c' => 'Que esas capas no se van a usar.',
      'd' => 'Que falta hacer <code>git pull</code>.',
    ],
    'correcta' => 'b',
    'porque' => 'Es la ventaja de empezar por dentro: el dominio y los casos de uso ya estan probados antes de que exista una sola linea de <code>fetch</code>, y la app sigue en pie mientras tanto.',
  ],
];

$RETOS = [
  'r1' => [
    'titulo' => 'la interfaz RentalRepository completa',
    'huecos' => [1, 2, 3, 4, 5],
    'codigo' => "export interface RentalRepository {
  findMine(): Promise<Rental[]>;
  cancel(rentalId: number): Promise<void>;
}",
  ],

  'r2' => [
    'titulo' => 'el caso de uso makeListMyRentals completo',
    'huecos' => [10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
    'codigo' => "export function makeListMyRentals({
  rentals,
  discountPolicy = STANDARD_DISCOUNT,
  cancellationPolicy = STANDARD_CANCELLATION,
}: Deps) {
  return async () => {
    const now = new Date();
    const mine = await rentals.findMine();
    return mine.map((rental) => ({
      rental,
      price: calculatePrice(rental.period, rental.dailyRate, discountPolicy),
      canCancel: canCancel(rental, now, cancellationPolicy),
    }));
  };
}",
  ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 5 — La capa de aplicacion: puertos y casos de uso', 'RentalRepository, makeListMyRentals y la inyeccion de dependencias sin libreria');
?>

<div class="card">
  <h2>Donde estamos</h2>
  <p>El dominio ya sabe calcular precios y decidir cancelaciones, y esta probado. Ahora falta
     <b>coordinar</b>: traer los alquileres de algun sitio y aplicarles esas reglas. Eso es la capa
     de aplicacion, y es lo nuevo de la rama <code>clase3-next</code>.</p>
  <div class="nota">
    Regla que se mantiene: esta capa <b>tampoco</b> sabe que existe una API. Pide los datos a traves
    de una interfaz que ella misma define.
  </div>
  <?php mc('m1'); mc('m8'); ?>
</div>

<div class="card">
  <h2>A. El puerto</h2>

<pre><code>// features/rentals/<?php hueco(6, 13); ?>/repositories/rental-repository.ts
import { Rental } from "../../domain/entities/rental";

export <?php hueco(1, 10); ?> RentalRepository {
    <?php hueco(2, 10); ?>(): <?php hueco(4, 9); ?>&lt;Rental[]&gt;;
    <?php hueco(3, 8); ?>(rentalId: number): Promise&lt;<?php hueco(5, 6); ?>&gt;;
}</code></pre>

  <div class="avisoflujo">
    <b>Lo importante es lo que NO dice:</b> ni URL, ni token, ni JSON, ni <code>snake_case</code>.
    Solo "necesito poder traer mis alquileres y cancelar uno". Devuelve <code>Rental</code>,
    la entidad del dominio, no el DTO del servidor.
  </div>

  <?php reto('r1'); ?>
</div>

<div class="card">
  <h2>B. El caso de uso</h2>

<pre><code>interface <?php hueco(10, 6); ?> {
    rentals: RentalRepository,
    discountPolicy?: DiscountPolicy,
    cancellationPolicy?: CancellationPolicy
}

export function <?php hueco(19, 18); ?>({
    rentals,
    discountPolicy = <?php hueco(11, 18); ?>,
    cancellationPolicy = <?php hueco(12, 22); ?>
}: Deps) {
  return <?php hueco(18, 6); ?> () =&gt; {
    const now = <?php hueco(13, 11); ?>;
    const mine = <?php hueco(14, 6); ?> rentals.findMine();
    return mine.<?php hueco(15, 4); ?>((rental) =&gt; ({
        rental,
        price: <?php hueco(16, 15); ?>(rental.period, rental.dailyRate, discountPolicy),
        canCancel: <?php hueco(17, 10); ?>(rental, now, cancellationPolicy)
    }));
  }
}</code></pre>

  <p>Observa que devuelve una lista de <code>{ rental, price, canCancel }</code>: la vista
     recibe el precio ya calculado y la decision ya tomada, y solo tiene que formatear.</p>

  <?php mc('m2'); mc('m3'); mc('m4'); mc('m6'); ?>

  <?php reto('r2'); ?>
</div>

<div class="card">
  <h2>C. Inyeccion de dependencias, sin libreria</h2>

  <p>Una funcion que recibe dependencias y devuelve la funcion lista para usar se llama
     <?php hueco(25, 10); ?>. Quien la llama con las piezas reales es la capa
     <?php hueco(26, 4); ?>, que todavia esta vacia:</p>

<pre><code>// di/rentals.ts   (pendiente)
export const listMyRentals = makeListMyRentals({
  rentals: new HttpRentalRepository(API_URL, tokenStorage),
});

// en un test
const listMyRentals = makeListMyRentals({ rentals: new FakeRentalRepository([...]) });</code></pre>

  <p>Las dos clases cumplen la misma interfaz, con la palabra clave
     <?php hueco(27, 11); ?>. La segunda es un repositorio
     <?php hueco(28, 8); ?>: datos en memoria, sin red.</p>

  <?php mc('m5'); ?>
</div>

<div class="card">
  <h2>D. Lo que viene despues</h2>

  <ul>
    <li>El caso de uso <code>cancelRental</code>, que pregunta a <code>canCancel</code> y, si el
        negocio dice que no, lanza <?php hueco(35, 28); ?>
        sin llegar a tocar la red. Si el alquiler no existe, lanza
        <?php hueco(36, 20); ?>.</li>
    <li>En infraestructura, <?php hueco(38, 22); ?>: el <code>fetch</code> con el
        token y la URL en un solo sitio.</li>
    <li>Y el <?php hueco(37, 10); ?>, que convierte el JSON en <code>snake_case</code>
        a entidades del dominio. Cuando el backend renombre <code>start_date</code>, ese sera el
        unico archivo a tocar.</li>
  </ul>

  <?php mc('m7'); ?>
</div>

<div class="card">
  <h2>E. De memoria: la linea completa</h2>

  <?php linea(45, 'La linea que pide los alquileres al repositorio dentro del caso de uso.'); ?>
  <?php linea(46, 'La propiedad del objeto devuelto que decide si se muestra el boton de cancelar.'); ?>
</div>

<?php pie('cuarto.php', 'sexto.php'); ?>
