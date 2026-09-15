<?php
/* ==========================================================================
   APO / Graficas  —  .plot(kind=...) y matplotlib
   Fuente: Lecture_1.ipynb, Exercises_1.ipynb, Practica Netflix_Movies.ipynb
   ========================================================================== */

$MENU = '../Pandas.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- .plot(kind=...) sobre una Series --- */
    1  => ["sales['Unit_Cost'].plot(kind='box', vert=False, figsize=(14,6))"],
    2  => ["sales['Unit_Cost'].plot(kind='density', figsize=(14,6))"],
    3  => ["sales['Customer_Age'].plot(kind='density', figsize=(14,6))"],
    4  => ["sales['Customer_Age'].plot(kind='box', vert=False, figsize=(14,6))"],
    5  => ["sales['Unit_Cost'].plot(kind='hist', figsize=(14,6))"],
    6  => ["sales['Revenue'].plot(kind='hist', bins=100, figsize=(14,6))"],

    /* --- guardar el ax y etiquetar --- */
    7  => ["ax = sales['Order_Quantity'].plot(kind='hist', bins=32, figsize=(14,6))"],
    8  => ["ax.set_ylabel('Number of Sales')"],
    9  => ["ax.set_xlabel('Order Quantity')"],
    10 => ["ax.axvline(sales['Unit_Cost'].mean(), color='red')"],
    11 => ["ax.axvline(sales['Unit_Cost'].median(), color='green')"],

    /* --- categorias: pie y bar --- */
    12 => ["sales['Year'].value_counts()"],
    13 => ["sales['Year'].value_counts().plot(kind='pie', figsize=(6,6))"],
    14 => ["ax = sales['Age_Group'].value_counts().plot(kind='bar', figsize=(14,6))"],
    15 => ["sales['Month'].value_counts().plot(kind='bar', figsize=(14,6))"],
    16 => ["sales['Product'].value_counts().head(10).plot(kind='bar', figsize=(14,6))"],

    /* --- dos columnas: scatter --- */
    17 => ["sales.plot(kind='scatter', x='Customer_Age', y='Revenue', figsize=(6,6))"],
    18 => ["sales.plot(kind='scatter', x='Unit_Cost', y='Unit_Price', figsize=(6,6))"],
    19 => ["sales.plot(kind='scatter', x='Order_Quantity', y='Profit', figsize=(6,6))"],

    /* --- agrupado --- */
    20 => ["ax = sales[['Profit', 'Age_Group']].boxplot(by='Age_Group', figsize=(10,6))"],
    21 => ["sales[['Profit', 'Country']].boxplot(by='Country', figsize=(10,6))"],
    22 => ["sales[['Customer_Age', 'Country']].boxplot(by='Country', figsize=(10,6))"],

    /* --- .hist() del dataframe --- */
    23 => ["netflix_df.hist(column=atr, bins=num_bins, figsize=(5,5))"],

    /* --- matplotlib puro --- */
    24 => ["valores = netflix_df[atr].values"],
    25 => ["n, bins, patches = plt.hist(valores, num_bins, density=False, facecolor='green')"],
    26 => ["plt.xlabel(atr)"],
    27 => ["plt.ylabel('Cuentas')"],
    28 => ["plt.title('Histograma de duration')"],
    29 => ["plt.grid(True)"],
    30 => ["plt.show()"],
    31 => ["fig = plt.figure(figsize=(12, 8))"],
];

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Para que sirve <code>vert=False</code> en <code>plot(kind=\'box\', vert=False)</code>?',
        'opciones' => [
            'a' => 'Quita el eje vertical',
            'b' => 'Dibuja la caja en <b>horizontal</b> en vez de vertical',
            'c' => 'Invierte los valores',
            'd' => 'Oculta los outliers'
        ],
        'correcta' => 'b',
        'porque'   => 'Un box plot horizontal se lee mejor cuando solo tienes una variable, porque el eje de los valores queda a lo largo.'
    ],
    'm2' => [
        'texto'    => '&iquest;Que cambia entre <code>kind=\'hist\'</code> y <code>kind=\'density\'</code>?',
        'opciones' => [
            'a' => 'Nada, son sinonimos',
            'b' => 'El histograma cuenta en <b>barras por intervalo</b> (bins); density dibuja una <b>curva suave</b> (KDE) de la misma distribucion',
            'c' => 'density solo sirve para texto',
            'd' => 'hist solo funciona con fechas'
        ],
        'correcta' => 'b',
        'porque'   => 'Misma informacion, distinto acabado. El histograma depende de cuantos <code>bins</code> pongas; la KDE no.'
    ],
    'm3' => [
        'texto'    => '&iquest;Por que se escribe <code>ax = ...plot(...)</code> guardando el resultado?',
        'opciones' => [
            'a' => 'Para que la grafica se dibuje',
            'b' => 'Porque <code>.plot()</code> devuelve el <b>eje</b> (axes) y con el puedes seguir tocando la grafica: <code>ax.set_xlabel()</code>, <code>ax.axvline()</code>...',
            'c' => 'Para guardarla en un archivo',
            'd' => 'Porque si no, sale en blanco'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin guardarlo la grafica sale igual, pero te quedas sin mango para ponerle etiquetas o lineas.'
    ],
    'm4' => [
        'texto'    => 'Quieres un grafico de <b>tarta</b> con las ventas por anio. &iquest;Que falta antes del <code>.plot()</code>?',
        'opciones' => [
            'a' => 'Nada, <code>sales[\'Year\'].plot(kind=\'pie\')</code> ya vale',
            'b' => 'Hay que <b>contar</b> primero: <code>.value_counts()</code>, porque el pie necesita una categoria y su cantidad',
            'c' => 'Hay que ordenar con <code>sort_values()</code>',
            'd' => 'Hay que convertir a numpy con <code>.values</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'El pie y el bar de categorias casi siempre van pegados a <code>value_counts()</code>. Sin contar, intentaria dibujar 113.036 porciones.'
    ],
    'm5' => [
        'texto'    => 'En <code>sales[[\'Profit\', \'Age_Group\']].boxplot(by=\'Age_Group\')</code>, &iquest;por que se seleccionan justo esas dos columnas?',
        'opciones' => [
            'a' => 'Por rapidez, con la tabla entera tambien saldria igual',
            'b' => 'Porque el boxplot necesita <b>solo</b> la variable numerica que se dibuja y la categorica por la que se agrupa; si dejas mas columnas dibuja una caja por cada una',
            'c' => 'Porque boxplot no admite mas de dos columnas nunca',
            'd' => 'Porque Age_Group tiene que ser la primera'
        ],
        'correcta' => 'b',
        'porque'   => 'Se lee asi: &laquo;de estas dos columnas, dibujame <code>Profit</code> partido por los grupos de <code>Age_Group</code>&raquo;.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('4 · Graficas', 'plot(kind=...) · value_counts + pie/bar · scatter · boxplot by');
?>

<div class="card">
  <h2>El molde</h2>
  <p>Casi todas las graficas del curso salen de esta misma linea:</p>
  <pre><code>dataframe['Columna'].plot(kind='TIPO', figsize=(ancho,alto))</code></pre>
  <p>Lo unico que cambia es el <code>kind</code>:</p>
  <table class="datos">
    <tr><th>kind</th><th>para que</th><th>sobre que</th></tr>
    <tr><td><code>'hist'</code></td><td>como se reparten los valores, en barras</td><td>1 columna numerica</td></tr>
    <tr><td><code>'density'</code></td><td>lo mismo pero curva suave (KDE)</td><td>1 columna numerica</td></tr>
    <tr><td><code>'box'</code></td><td>mediana, cuartiles y outliers</td><td>1 columna numerica</td></tr>
    <tr><td><code>'bar'</code></td><td>comparar cantidades entre categorias</td><td><code>value_counts()</code></td></tr>
    <tr><td><code>'pie'</code></td><td>reparto porcentual</td><td><code>value_counts()</code></td></tr>
    <tr><td><code>'scatter'</code></td><td>relacion entre dos variables</td><td>el dataframe, con <code>x=</code> e <code>y=</code></td></tr>
  </table>
  <div class="nota"><b>Ojo:</b> <code>scatter</code> es el unico que se llama sobre <b>el dataframe entero</b>
    (<code>sales.plot(...)</code>), porque necesita dos columnas. Los demas cuelgan de una columna.</div>
</div>


<div class="card">
  <h2>1. Una columna numerica</h2>
    <img src="../../img/guia_486.png" alt="">
  <?php linea(1, '<b>box plot horizontal</b> de <code>Unit_Cost</code>, tamanio 14x6'); ?>
      <img src="../../img/guia_487.png" alt="">
  <?php linea(2, '<b>density (KDE)</b> de <code>Unit_Cost</code>, 14x6'); ?>
        <img src="../../img/guia_488.png" alt="">
  <?php linea(5, '<b>histograma</b> de <code>Unit_Cost</code>, 14x6'); ?>
  <?php linea(6, 'histograma de <code>Revenue</code> con <b>100 bins</b>, 14x6'); ?>
   
  <p>Ahora los dos que pide el ejercicio para <code>Customer_Age</code>:</p>
  <?php linea(3, 'density de <code>Customer_Age</code>'); ?>
  <img src="../../img/guia_489.png" alt="">
  <?php linea(4, 'box plot horizontal de <code>Customer_Age</code>'); ?>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Guardar el eje para poder retocarla</h2>
  <img src="../../img/guia_490.png" alt="">
  <p>Cuando quieres ponerle titulo a los ejes o marcar la media, hay que quedarse con el <code>ax</code>.</p>

  <?php linea(7, 'histograma de <code>Order_Quantity</code> con <b>32 bins</b>, 14x6, <b>guardando</b> el eje en <code>ax</code>'); ?>
  <?php linea(8, 'poner <code>Number of Sales</code> en el eje <b>Y</b>'); ?>
  <?php linea(9, 'poner <code>Order Quantity</code> en el eje <b>X</b>'); ?>

  <p>Y sobre una KDE de <code>Unit_Cost</code>, marcar donde caen la media y la mediana:</p>
  <?php linea(10, 'linea <b>vertical roja</b> en la <b>media</b> de <code>Unit_Cost</code>'); ?>
  <?php linea(11, 'linea <b>vertical verde</b> en la <b>mediana</b>'); ?>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Categorias: contar y luego dibujar</h2>
  <p>El paso que todo el mundo olvida es el <code>value_counts()</code> de en medio.</p>

  <?php linea(12, 'primero: cuantas ventas hay por anio'); ?>
  <?php linea(13, 'ahora esa misma cuenta como <b>grafico de tarta</b> de 6x6'); ?>
  <img src="../../img/guia_491.png" alt="" width="500">
  <?php linea(14, '<b>barras</b> con las ventas por <code>Age_Group</code>, 14x6, guardando el eje'); ?>
  <?php linea(15, 'barras con las ventas por <code>Month</code>, 14x6'); ?>
  <?php linea(16, 'barras con los <b>10 productos mas vendidos</b>, 14x6'); ?>
  <?php ayuda('Contar &rarr; quedarte con los 10 primeros (<code>value_counts()</code> ya viene ordenado de mayor a menor) &rarr; dibujar.'); ?>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Dos columnas: scatter</h2>
  <p>Se llama sobre <b>el dataframe</b>, y se le dicen las dos columnas por nombre.</p>
    <img src="../../img/guia_492.png" alt="" width="600">
  <?php linea(17, 'relacion entre <code>Customer_Age</code> (x) y <code>Revenue</code> (y), 6x6'); ?>
  <img src="../../img/guia_493.png" alt="" width="600">
  <?php linea(18, 'relacion entre <code>Unit_Cost</code> y <code>Unit_Price</code>, 6x6'); ?>
  <img src="../../img/guia_494.png" alt="" width="600">
  <?php linea(19, 'relacion entre <code>Order_Quantity</code> y <code>Profit</code>, 6x6'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Comparar una variable numerica <em>entre grupos</em></h2>
  <p>Aqui entra <code>boxplot(by=...)</code>: una caja por cada categoria.</p>
      <img src="../../img/guia_495.png" alt="" width="600">

  <?php linea(20, '<code>Profit</code> agrupado por <code>Age_Group</code>, 10x6, guardando el eje'); ?>
  <img src="../../img/guia_496.png" alt="" width="600">
  <?php linea(21, '<code>Profit</code> agrupado por <code>Country</code>, 10x6'); ?>
  <?php linea(22, '<code>Customer_Age</code> agrupado por <code>Country</code>, 10x6'); ?>

  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. matplotlib a pelo</h2>
  <p>Cuando <code>.plot()</code> se queda corto se baja a matplotlib. Este bloque es el del
     histograma de <code>duration</code> de la practica de Netflix.</p>
<img src="../../img/guia_497.png" alt="" width="500">
  <?php linea(23, 'histograma del dataframe indicando <code>column=atr</code>, <code>bins=num_bins</code> y tamanio 5x5'); ?>

  <p>Y ahora el mismo histograma, pero con matplotlib:</p>
  <?php linea(24, 'sacar el <b>ndarray</b> de la columna <code>atr</code> en la variable <code>valores</code>'); ?>
  <?php ayuda('El atributo (sin parentesis) que convierte una Series en array de numpy es <code>.values</code>.'); ?>
  <?php linea(25, 'dibujar el histograma con <code>plt</code>, en verde, sin densidad, recogiendo <code>n, bins, patches</code>'); ?>
  <img src="../../img/guia_498.png" alt="" width="500">
  <?php linea(26, 'texto del eje X (la variable <code>atr</code>)'); ?>
  <?php linea(27, 'texto del eje Y: <code>Cuentas</code>'); ?>
  <?php linea(28, 'titulo: <code>Histograma de duration</code>'); ?>
  <?php linea(29, 'activar la cuadricula'); ?>
  <?php linea(30, 'mostrar el grafico'); ?>

  <p>Y la que abre cualquier figura hecha a mano:</p>
  <?php linea(31, 'crear una figura de <b>12x8</b> guardada en <code>fig</code>'); ?>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Filtros/index.php', '');
