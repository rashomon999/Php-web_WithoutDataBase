<?php
/* ==========================================================================
   APO / Netflix  —  La practica completa, de memoria y en orden
   Fuente: Practica Netflix_Movies.ipynb (solucion concreta)
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- 1. preparar --- */
    1  => ["import numpy as np"],
    2  => ["import pandas as pd"],
    3  => ["import matplotlib.pyplot as plt"],
    4  => ["netflix_df = pd.read_csv('netflix_data.csv', na_values=[' ', ''])"],

    /* --- 2. explorar --- */
    5  => ["netflix_df.shape"],
    6  => ["netflix_df.info()"],
    7  => ["netflix_df.head()"],
    8  => ["netflix_df.tail()"],
    9  => ["netflix_df.describe()"],
    10 => ["netflix_df[0:10]"],
    11 => ["netflix_df.iloc[2]"],
    12 => ["netflix_df.loc[2, 'title']"],

    /* --- 3. limpiar --- */
    13 => ["df_clean = netflix_df.copy()"],
    14 => ["df_clean.duplicated().sum()"],
    15 => ["netflix_df.isna().sum()"],
    16 => ["df_clean.dropna(subset=['date_added'], inplace=True)"],
    17 => ["df_clean = df_clean.reset_index(drop=True)"],
    18 => ["df_clean['date_added'].isna().sum()"],
    19 => ["df_clean['director'].replace(np.nan, 'Desconocido', inplace=True)"],
    20 => ["df_clean['cast'].replace(np.nan, 'Desconocido', inplace=True)"],
    21 => ["df_clean['country'].replace(np.nan, 'Desconocido', inplace=True)"],

    /* --- 4. los cuatro ejercicios --- */
    22 => ["netflix_subset = df_clean[df_clean['type'] == 'Movie']",
           "netflix_subset = df_clean.loc[df_clean['type'] == 'Movie']"],
    23 => ["netflix_movies = netflix_subset[['title', 'country', 'genre', 'release_year', 'duration']]"],
    24 => ["netflix_movies.head()"],
    25 => ["netflix_movies_less_60 = netflix_movies[netflix_movies['duration'] < 60]"],
    26 => ["netflix_movies_less_60.head(20)"],

    /* --- 5. bloques --- */
    27 => ["colors = []\nfor lab, row in netflix_movies.iterrows():\n    if row['genre'] == 'Children':\n        colors.append('red')\n    elif row['genre'] == 'Documentaries':\n        colors.append('blue')\n    elif row['genre'] == 'Stand-Up':\n        colors.append('green')\n    else:\n        colors.append('black')"],

    28 => ["fig = plt.figure(figsize=(12, 8))\nplt.scatter(netflix_movies['release_year'], netflix_movies['duration'], c=colors)\nplt.xlabel('Anio de lanzamiento')\nplt.ylabel('Duracion (min)')\nplt.title('Duracion de la pelicula por anio de lanzamiento')\nplt.show()"],

    /* --- 6. histograma --- */
    29 => ["netflix_df.hist(column='duration', bins=30, figsize=(5,5))"],
];

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Para que sirve <code>na_values=[\' \', \'\']</code> al leer el CSV?',
        'opciones' => [
            'a' => 'Para eliminar esas filas al cargar',
            'b' => 'Para que pandas trate las celdas vacias y las que solo tienen un espacio como <b>NaN</b> en vez de como texto',
            'c' => 'Para rellenar los huecos con un espacio',
            'd' => 'Para separar las columnas por espacios'
        ],
        'correcta' => 'b',
        'porque'   => 'Si no se lo dices, <code>\' \'</code> es una cadena valida y <code>.isna()</code> no la cuenta. Los nulos quedarian escondidos.'
    ],
    'm2' => [
        'texto'    => 'En <code>netflix_subset[[\'title\', \'country\', \'genre\', \'release_year\', \'duration\']]</code>, &iquest;por que dos corchetes?',
        'opciones' => [
            'a' => 'Por estetica',
            'b' => 'Porque el de dentro es la <b>lista</b> de columnas y el de fuera es el acceso al dataframe',
            'c' => 'Porque son cinco columnas y con una bastaria uno',
            'd' => 'Porque asi se ordenan alfabeticamente'
        ],
        'correcta' => 'b',
        'porque'   => '<code>df[ [\'a\',\'b\'] ]</code> = &laquo;dame estas columnas&raquo;. El corchete de dentro es la lista de Python.'
    ],
    'm3' => [
        'texto'    => 'El enunciado pide peliculas de <b>menos de 60 minutos</b>. &iquest;Cual es la condicion correcta?',
        'opciones' => [
            'a' => "<code>netflix_movies['duration'] &lt;= 60</code>",
            'b' => "<code>netflix_movies['duration'] &lt; 60</code>",
            'c' => "<code>netflix_movies['duration'] &gt; 60</code>",
            'd' => "<code>netflix_movies['duration'] == 60</code>"
        ],
        'correcta' => 'b',
        'porque'   => '&laquo;Menos de 60&raquo; excluye el 60. Con <code>&lt;=</code> colarias las de exactamente una hora.'
    ],
    'm4' => [
        'texto'    => '&iquest;Que devuelve <code>.iterrows()</code> en cada vuelta del bucle?',
        'opciones' => [
            'a' => 'Solo el valor de la primera columna',
            'b' => 'Un par: la <b>etiqueta</b> del indice y la <b>fila</b> entera como Series (por eso se escribe <code>for lab, row in ...</code>)',
            'c' => 'Una lista de columnas',
            'd' => 'El numero de la fila unicamente'
        ],
        'correcta' => 'b',
        'porque'   => 'Dentro del bucle, <code>row[\'genre\']</code> es el genero de esa fila. Es lento en tablas grandes, pero es lo que se pide en la practica.'
    ],
    'm5' => [
        'texto'    => 'La lista <code>colors</code> se pasa al scatter con <code>c=colors</code>. &iquest;Que condicion tiene que cumplir?',
        'opciones' => [
            'a' => 'Tener exactamente 4 elementos, uno por genero',
            'b' => 'Tener <b>tantos elementos como filas</b> tenga <code>netflix_movies</code>, uno por punto',
            'c' => 'Estar ordenada alfabeticamente',
            'd' => 'Ser un array de numpy'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso el bucle recorre <code>netflix_movies</code> entero y hace <code>append</code> una vez por fila. Si los largos no cuadran, matplotlib da error.'
    ],
    'm6' => [
        'texto'    => 'Mirando el grafico final: &iquest;podemos afirmar que las peliculas son cada vez mas cortas?',
        'opciones' => [
            'a' => 'Si, la nube de puntos baja claramente',
            'b' => 'No con seguridad: se ve mas dispersion en los anios recientes y muchas peliculas cortas son <b>Children</b>, <b>Documentaries</b> o <b>Stand-Up</b>; el grafico sugiere una tendencia pero no la demuestra',
            'c' => 'Si, porque hay mas peliculas de menos de 60 minutos que antes',
            'd' => 'No se puede saber nada del grafico'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la respuesta que pide el notebook: hay indicios, pero el efecto se confunde con el genero y con que ahora hay muchisimos mas titulos. Correlacion no es causalidad.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('5 · Practica Netflix completa', 'de la carga al scatter, en orden y de memoria');
?>

<div class="card">
  <h2>El encargo</h2>
  <p>Un analista cree que <b>la duracion media de las peliculas de Netflix esta bajando</b>.
     Hay que comprobarlo con <code>netflix_data.csv</code>. Los pasos son cuatro:</p>
  <ol>
    <li>Filtrar por tipo <code>Movie</code> y quedarse con <code>title</code>, <code>country</code>,
        <code>genre</code>, <code>release_year</code> y <code>duration</code> &rarr; <code>netflix_movies</code>.</li>
    <li>Filtrar las de menos de 60 minutos &rarr; <code>netflix_movies_less_60</code>.</li>
    <li>Con un bucle <code>for</code>, asignar un color a cada fila segun su genero.</li>
    <li>Scatter de duracion contra anio de lanzamiento usando esos colores.</li>
  </ol>
  <div class="nota">Esta pagina va <b>en el orden real del notebook</b>. Si la haces entera sin mirar,
    tienes la practica resuelta de memoria.</div>
</div>


<div class="card">
  <h2>1. Preparar el entorno y cargar</h2>

  <?php linea(1, 'numpy'); ?>
  <?php linea(2, 'pandas'); ?>
  <?php linea(3, 'pyplot'); ?>
  <?php linea(4, 'cargar <code>netflix_data.csv</code> en <code>netflix_df</code>, tratando los espacios y las cadenas vacias como nulos'); ?>
  <?php ayuda('<code>pd.read_csv(\'archivo.csv\', na_values=[\' \', \'\'])</code>'); ?>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Analisis exploratorio</h2>
  <p>Las columnas del dataset son:</p>
  <pre><code>show_id  type  title  director  cast  country
date_added  release_year  duration  description  genre</code></pre>

  <?php linea(5,  'tamanio del dataset'); ?>
  <?php linea(6,  'tipos de dato y no nulos'); ?>
  <?php linea(7,  'primeras filas'); ?>
  <?php linea(8,  'ultimas filas'); ?>
  <?php linea(9,  'estadisticas de las columnas numericas'); ?>

  <p>Las tres formas de mirar filas concretas que pide el notebook:</p>
  <?php linea(10, 'ejemplo de <b>slicing</b>: 10 primeras filas'); ?>
  <?php linea(11, 'ejemplo con <b>.iloc[]</b>: fila de posicion 2'); ?>
  <?php linea(12, 'ejemplo con <b>.loc[]</b>: el <code>title</code> de la fila con etiqueta 2'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Limpieza</h2>

  <?php linea(13, 'copia profunda del original en <code>df_clean</code>'); ?>
  <?php linea(14, 'numero de filas duplicadas'); ?>
  <?php linea(15, 'nulos por columna en <code>netflix_df</code>'); ?>
  <?php linea(16, 'eliminar las filas sin <code>date_added</code>, modificando <code>df_clean</code>'); ?>
  <?php linea(17, 'reorganizar el indice'); ?>
  <?php linea(18, 'verificar que ya no hay nulos en <code>date_added</code>'); ?>

  <p>Y rellenar los textos que faltan con <code>Desconocido</code>:</p>
  <?php linea(19, '<code>director</code>'); ?>
  <?php linea(20, '<code>cast</code>'); ?>
  <?php linea(21, '<code>country</code>'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Ejercicio 1 y 2 — filtrar</h2>

  <?php linea(22, 'quedarte solo con las filas cuyo <code>type</code> es <code>Movie</code>, en <code>netflix_subset</code>'); ?>
  <?php linea(23, 'de ahi, solo las columnas <code>title</code>, <code>country</code>, <code>genre</code>, <code>release_year</code> y <code>duration</code>, en <code>netflix_movies</code>'); ?>
  <?php linea(24, 'echarle un vistazo a <code>netflix_movies</code>'); ?>

  <?php mc('m2'); ?>

  <p>Ahora las peliculas cortas:</p>
  <?php linea(25, 'las de <b>menos de 60</b> minutos, en <code>netflix_movies_less_60</code>'); ?>
  <?php linea(26, 'las <b>20 primeras</b> de ese resultado, para inspeccionarlas'); ?>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Ejercicio 3 — la lista de colores</h2>
  <p>Lista vacia, bucle sobre las filas, y un color segun el genero:
     <code>Children</code> rojo, <code>Documentaries</code> azul, <code>Stand-Up</code> verde,
     el resto negro. Escribe el bloque entero (la sangria da igual, una instruccion por linea):</p>

  <?php bloque(27, 'nueve lineas: la lista, el <code>for</code>, tres <code>if/elif</code> con su <code>append</code>, y el <code>else</code>', 11); ?>
  <?php ayuda('Empieza asi:<br><code>colors = []</code><br><code>for lab, row in netflix_movies.iterrows():</code><br><code>&nbsp;&nbsp;&nbsp;&nbsp;if row[\'genre\'] == \'Children\':</code><br><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;colors.append(\'red\')</code>'); ?>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Ejercicio 4 — el grafico</h2>
  <p>Figura de <code>12 x 8</code>, scatter de <code>release_year</code> (x) contra <code>duration</code> (y)
     coloreado con <code>colors</code>, etiquetas <code>Anio de lanzamiento</code> y <code>Duracion (min)</code>,
     titulo <code>Duracion de la pelicula por anio de lanzamiento</code>, y mostrar.</p>

  <?php bloque(28, 'seis lineas, en ese orden', 8); ?>
  <?php ayuda('<code>fig = plt.figure(figsize=(12, 8))</code> &rarr; <code>plt.scatter(x, y, c=colors)</code> &rarr; <code>plt.xlabel()</code> &rarr; <code>plt.ylabel()</code> &rarr; <code>plt.title()</code> &rarr; <code>plt.show()</code>'); ?>

  <p>Y el histograma de <code>duration</code> que se hizo antes en la exploracion:</p>
  <?php linea(29, 'histograma de la columna <code>duration</code> con 30 bins, tamanio 5x5'); ?>

  <?php mc('m6'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Graficas/index.php', '');
