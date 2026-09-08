<?php
/* ==========================================================================
   APO / Referencia  —  Como se referencia la tabla, las columnas y las filas
   Fuente: Lecture_1.ipynb y Practica Netflix_Movies.ipynb
   ========================================================================== */

$MENU = '../Pandas.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- la tabla y sus columnas --- */
    1  => ["sales"],
    2  => ["sales['Customer_Age']"],
    3  => ["sales.Customer_Age"],
    4  => ["sales[['Customer_Age']]"],
    5  => ["sales[['Customer_Age', 'Revenue']]"],
    6  => ["sales[['Country', 'Product', 'Revenue']]"],
    7  => ["sales['Country'].head()"],

    /* --- filas por posicion (slicing simple) --- */
    8  => ["sales[0:10]"],
    9  => ["sales[:5]", "sales[0:5]"],

    /* --- iloc: POSICION --- */
    10 => ["sales.iloc[2]"],
    11 => ["sales.iloc[0:5]", "sales.iloc[:5]"],
    12 => ["sales.iloc[-1]"],
    13 => ["sales.iloc[2, 3]"],
    14 => ["sales.iloc[0:5, 0:3]", "sales.iloc[:5, :3]"],
    15 => ["sales.iloc[:, 0]"],
    16 => ["sales.iloc[[0, 2, 4]]"],

    /* --- loc: ETIQUETA --- */
    17 => ["sales.loc[2]"],
    18 => ["sales.loc[2, 'Country']"],
    19 => ["sales.loc[:, 'Country']"],
    20 => ["sales.loc[:, ['Country', 'Revenue']]"],
    21 => ["sales.loc[0:5, 'Country':'Revenue']"],
    22 => ["sales.loc[0:5, ['Country', 'Revenue']]"],
    23 => ["sales.at[2, 'Country']"],

    /* --- lo mismo sobre netflix_df --- */
    24 => ["netflix_df[0:10]"],
    25 => ["netflix_df.iloc[2]"],
    26 => ["netflix_df.loc[2, 'title']"],

    /* --- orden e indice --- */
    27 => ["sales.sort_values('Revenue')"],
    28 => ["sales.sort_values('Revenue', ascending=False)"],
    29 => ["sales.sort_values('Revenue', ascending=False).head(10)"],
    30 => ["sales.set_index('Date')"],
    31 => ["sales.reset_index(drop=True)"],
];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Verdadero o falso: <code>.iloc[]</code> selecciona por <b>posicion</b> y <code>.loc[]</code> selecciona por <b>etiqueta</b>.',
        'opciones' => [
            'a' => 'Verdadero',
            'b' => 'Falso, es al reves',
            'c' => 'Verdadero, pero solo para columnas',
            'd' => 'Falso, las dos hacen lo mismo'
        ],
        'correcta' => 'a',
        'porque'   => '<b>i</b>loc = <b>i</b>nteger location (posicion 0,1,2...). <b>loc</b> = label (la etiqueta del indice y el nombre de la columna).'
    ],
    'm2' => [
        'texto'    => '&iquest;Que diferencia hay entre <code>sales[\'Revenue\']</code> y <code>sales[[\'Revenue\']]</code>?',
        'opciones' => [
            'a' => 'Ninguna, los dobles corchetes son decorativos',
            'b' => 'El primero devuelve una <b>Series</b> (una columna suelta); el segundo devuelve un <b>DataFrame</b> de una sola columna',
            'c' => 'El segundo da error',
            'd' => 'El primero devuelve solo el primer valor'
        ],
        'correcta' => 'b',
        'porque'   => 'Corchete simple = una columna = Series. Corchete doble = le pasas una <b>lista</b> de columnas = te devuelve tabla. Por eso pedir varias columnas siempre lleva dos corchetes.'
    ],
    'm3' => [
        'texto'    => '<code>sales.iloc[0:5]</code> devuelve 5 filas, pero <code>sales.loc[0:5]</code> devuelve 6. &iquest;Por que?',
        'opciones' => [
            'a' => 'Es un bug de pandas',
            'b' => 'Porque <code>iloc</code> corta como Python (el final <b>no</b> se incluye) y <code>loc</code> corta por etiqueta (el final <b>si</b> se incluye)',
            'c' => 'Porque loc empieza a contar en 1',
            'd' => 'Porque loc anade siempre la cabecera'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el fallo mas comun del parcial. Con <code>loc</code> el rango es <b>cerrado</b>: <code>loc[0:5]</code> son las etiquetas 0,1,2,3,4 y 5.'
    ],
    'm4' => [
        'texto'    => '&iquest;Que hace <code>sales[0:10]</code> (corchetes sueltos con dos puntos)?',
        'opciones' => [
            'a' => 'Devuelve las columnas de la 0 a la 9',
            'b' => 'Devuelve las <b>filas</b> de la 0 a la 9',
            'c' => 'Devuelve las 10 primeras celdas',
            'd' => 'Da error, hay que usar iloc'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla rara pero fija: dentro de <code>[]</code>, si pones un <b>nombre</b> pandas entiende <b>columna</b>; si pones un <b>rango</b> entiende <b>filas</b>.'
    ],
    'm5' => [
        'texto'    => 'Quieres <b>un solo valor</b>: el pais de la fila con etiqueta 2. &iquest;Cual NO sirve?',
        'opciones' => [
            'a' => "<code>sales.loc[2, 'Country']</code>",
            'b' => "<code>sales.at[2, 'Country']</code>",
            'c' => "<code>sales['Country'][2]</code>",
            'd' => "<code>sales['Country', 2]</code>"
        ],
        'correcta' => 'd',
        'porque'   => 'Dentro de un corchete simple pandas espera nombres de columna, no un par (columna, fila). Para cruzar fila y columna se usa <code>loc</code> / <code>iloc</code> / <code>at</code>.'
    ],
    'm6' => [
        'texto'    => '&iquest;Que devuelve <code>sales.iloc[2, 3]</code>?',
        'opciones' => [
            'a' => 'Las filas 2 y 3',
            'b' => 'La celda que esta en la fila de posicion 2 y la columna de posicion 3 (un solo valor)',
            'c' => 'Las columnas 2 y 3',
            'd' => 'Un dataframe de 2 filas por 3 columnas'
        ],
        'correcta' => 'b',
        'porque'   => 'La coma separa <b>filas, columnas</b>. Siempre en ese orden: <code>[fila, columna]</code>.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('2 · Referenciar: tabla, columnas, filas y celdas', 'el corazon de pandas — loc / iloc / corchetes');
?>

<div class="card">
  <h2>El mapa mental</h2>
  <p>Casi todo pandas es responder a la pregunta <b>&laquo;&iquest;a que trozo de la tabla me estoy refiriendo?&raquo;</b>.
     Solo hay tres formas de decirlo:</p>
  <pre><code>sales['Country']          -> por NOMBRE de columna     (corchetes)
sales.iloc[2, 3]          -> por POSICION  fila, columna (i = integer)
sales.loc[2, 'Country']   -> por ETIQUETA  fila, columna (loc = label)</code></pre>

  <p>Trabajamos sobre esta tabla de ejemplo (las etiquetas del indice coinciden con la posicion,
     que es lo normal recien cargado el CSV):</p>

  <table class="datos">
    <tr><th></th><th>0 · Date</th><th>1 · Customer_Age</th><th>2 · Country</th><th>3 · Product</th><th>4 · Revenue</th></tr>
    <tr><td class="idx">0</td><td>2013-11-26</td><td>19</td><td>Canada</td><td>Hitch Rack</td><td>950</td></tr>
    <tr><td class="idx">1</td><td>2015-11-26</td><td>19</td><td>Canada</td><td>Hitch Rack</td><td>950</td></tr>
    <tr><td class="idx">2</td><td>2014-03-23</td><td>49</td><td>Australia</td><td>Road Tire</td><td>2401</td></tr>
    <tr><td class="idx">3</td><td>2016-03-23</td><td>49</td><td>Australia</td><td>Road Tire</td><td>2088</td></tr>
    <tr><td class="idx">4</td><td>2014-05-15</td><td>47</td><td>Australia</td><td>Mountain Tire</td><td>418</td></tr>
  </table>

  <div class="nota">El numero de la cabecera es la <b>posicion</b> de la columna (para <code>iloc</code>);
    el nombre es la <b>etiqueta</b> (para <code>loc</code>). La columna gris de la izquierda es el <b>indice</b>.</div>
</div>


<div class="card">
  <h2>1. La tabla y sus columnas</h2>

  <?php linea(1, 'la <b>tabla entera</b> (solo el nombre del dataframe)'); ?>
  <?php linea(2, 'la columna <code>Customer_Age</code> como <b>Series</b>'); ?>
  <?php linea(3, 'la misma columna, pero con la notacion de <b>punto</b>'); ?>
  <?php ayuda('Funciona solo si el nombre no tiene espacios ni choca con un metodo de pandas. Por eso en clase se prefiere el corchete.'); ?>
  <?php linea(4, 'esa columna sola pero como <b>DataFrame</b> (fijate en los corchetes)'); ?>
  <?php linea(5, '<code>Customer_Age</code> y <code>Revenue</code> juntas'); ?>
  <?php linea(6, '<code>Country</code>, <code>Product</code> y <code>Revenue</code>'); ?>
  <?php linea(7, 'las <b>primeras filas</b> solo de la columna <code>Country</code>'); ?>

  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Filas con el corchete suelto (slicing)</h2>
  <p>Es la forma rapida y perezosa. Sirve para mirar, no para seleccionar fino.</p>

  <?php linea(8, 'las <b>10 primeras filas</b> usando solo corchetes y dos puntos'); ?>
  <?php linea(9, 'las <b>5 primeras filas</b>, igual'); ?>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. <code>.iloc[]</code> — por POSICION</h2>
  <p>Todo son numeros, y se cuenta desde <b>0</b>. Dentro del corchete: <code>[fila, columna]</code>.</p>

  <?php linea(10, 'la fila que ocupa la <b>posicion 2</b> (la tercera)'); ?>
  <?php linea(11, 'las <b>5 primeras</b> filas'); ?>
  <?php linea(12, 'la <b>ultima</b> fila'); ?>
  <?php ayuda('En Python la posicion -1 es la ultima, -2 la penultima...'); ?>

  <p>Ahora cruzando fila y columna:</p>
  <?php linea(13, 'la celda de la fila 2 y la columna de posicion 3 (en la tabla de arriba: <code>Road Tire</code>)'); ?>
  <?php linea(14, 'el <b>bloque</b> de las 5 primeras filas y las 3 primeras columnas'); ?>
  <?php linea(15, '<b>todas</b> las filas de la <b>primera</b> columna'); ?>
  <?php ayuda('Los dos puntos solos, <code>:</code>, significan &laquo;todo este eje&raquo;.'); ?>
  <?php linea(16, 'solo las filas 0, 2 y 4 (una <b>lista</b> de posiciones)'); ?>

  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. <code>.loc[]</code> — por ETIQUETA</h2>
  <p>Mismo formato <code>[fila, columna]</code>, pero las columnas se nombran con su <b>nombre</b>
     y las filas con su <b>etiqueta de indice</b>.</p>

  <?php linea(17, 'la fila con etiqueta 2, entera'); ?>
  <?php linea(18, 'el <code>Country</code> de la fila con etiqueta 2 (un solo valor)'); ?>
  <?php linea(19, 'la columna <code>Country</code> completa, escrita con <code>loc</code>'); ?>
  <?php linea(20, '<code>Country</code> y <code>Revenue</code> completas, con <code>loc</code>'); ?>
  <?php linea(21, 'de la fila 0 a la 5, y de la columna <code>Country</code> a la columna <code>Revenue</code>'); ?>
  <?php ayuda('Con <code>loc</code> tambien se puede cortar un <b>rango de columnas</b> por nombre: <code>\'Country\':\'Revenue\'</code>. Con iloc eso no existe.'); ?>
  <?php linea(22, 'de la fila 0 a la 5, pero solo <code>Country</code> y <code>Revenue</code> (lista, no rango)'); ?>
  <?php linea(23, 'el valor de <code>Country</code> en la fila con etiqueta <code>2</code>, usando el acceso <b>rapido</b> a una sola celda'); ?>

  <?php mc('m1'); ?>
  <?php mc('m3'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Lo mismo sobre <code>netflix_df</code></h2>
  <p>Estas tres son literalmente las del notebook de la practica. Cambia el nombre de la tabla, nada mas.</p>

  <?php linea(24, 'ejemplo de <b>slicing</b>: las 10 primeras filas'); ?>
  <?php linea(25, 'ejemplo con <b>.iloc[]</b>: la fila de posicion 2'); ?>
  <?php linea(26, 'ejemplo con <b>.loc[]</b>: el <code>title</code> de la fila con etiqueta 2'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Ordenar y cambiar el indice</h2>
  <p>Ordenar tambien es &laquo;referenciar&raquo;: cambia que fila esta en cada posicion.</p>

  <?php linea(27, 'ordenar la tabla por <code>Revenue</code> (de menor a mayor)'); ?>
  <?php linea(28, 'lo mismo pero de <b>mayor a menor</b>'); ?>
  <?php linea(29, 'las <b>10 ventas mas grandes</b> por <code>Revenue</code>'); ?>
  <?php linea(30, 'usar la columna <code>Date</code> como <b>indice</b> de la tabla'); ?>
  <?php linea(31, 'volver a numerar el indice desde 0, <b>tirando</b> el indice viejo'); ?>
  <?php ayuda('Se usa siempre despues de filtrar o de borrar filas, porque si no el indice queda con huecos (0, 1, 4, 7...).'); ?>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Lectura_1/index.php', '../Filtros/index.php');
