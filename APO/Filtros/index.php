<?php
/* ==========================================================================
   APO / Filtros  —  Filtrar, limpiar y crear columnas
   Fuente: Lecture_1.ipynb y Practica Netflix_Movies.ipynb
   ========================================================================== */

$MENU = '../Pandas.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- la mascara booleana --- */
    1  => ["sales['Country'] == 'France'"],
    2  => ["sales[sales['Country'] == 'France']"],
    3  => ["sales.loc[sales['State'] == 'Kentucky']"],
    4  => ["sales[sales['Revenue'] > 1000]"],
    5  => ["sales[sales['Country'] == 'France'].shape[0]",
           "len(sales[sales['Country'] == 'France'])"],

    /* --- filtro + columna --- */
    6  => ["sales.loc[sales['Age_Group'] == 'Adults (35-64)', 'Revenue']"],
    7  => ["sales.loc[sales['Age_Group'] == 'Adults (35-64)', 'Revenue'].mean()"],

    /* --- varias condiciones --- */
    8  => ["sales.loc[(sales['Age_Group'] == 'Youth (<25)') | (sales['Age_Group'] == 'Adults (35-64)')].shape[0]"],
    9  => ["sales.loc[(sales['Age_Group'] == 'Adults (35-64)') & (sales['Country'] == 'United States'), 'Revenue'].mean()"],
    10 => ["sales[sales['Country'].isin(['France', 'Germany'])]"],
    11 => ["sales[~(sales['Country'] == 'France')]", "sales[sales['Country'] != 'France']"],

    /* --- modificar --- */
    12 => ["sales.loc[sales['Country'] == 'France', 'Revenue'] *= 1.1"],
    13 => ["sales['Unit_Price'] *= 1.03"],
    14 => ["sales['Revenue_per_Age'] = sales['Revenue'] / sales['Customer_Age']"],
    15 => ["sales['Calculated_Cost'] = sales['Order_Quantity'] * sales['Unit_Cost']"],
    16 => ["sales['Calculated_Revenue'] = sales['Cost'] + sales['Profit']"],
    17 => ["(sales['Calculated_Cost'] != sales['Cost']).sum()"],

    /* --- limpieza (netflix) --- */
    18 => ["df_clean = netflix_df.copy()"],
    19 => ["df_clean.duplicated().sum()"],
    20 => ["netflix_df.isna().sum()"],
    21 => ["df_clean.dropna(subset=['date_added'], inplace=True)"],
    22 => ["df_clean = df_clean.reset_index(drop=True)"],
    23 => ["df_clean['date_added'].isna().sum()"],
    24 => ["df_clean['director'].replace(np.nan, 'Desconocido', inplace=True)"],
    25 => ["df_clean['cast'].replace(np.nan, 'Desconocido', inplace=True)"],
    26 => ["df_clean['country'].replace(np.nan, 'Desconocido', inplace=True)"],
    27 => ["df_clean.drop_duplicates(inplace=True)"],

    /* --- agrupar --- */
    28 => ["sales.groupby('Country')['Revenue'].sum()"],
    29 => ["sales.groupby('Country')['Revenue'].mean()"],
    30 => ["sales.groupby('Age_Group')['Profit'].mean()"],
];

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Que devuelve por si sola la expresion <code>sales[\'Country\'] == \'France\'</code>?',
        'opciones' => [
            'a' => 'Las filas de Francia',
            'b' => 'Una <b>Series de True/False</b> del mismo largo que la tabla (una mascara)',
            'c' => 'El numero de ventas en Francia',
            'd' => 'True o False, un solo valor'
        ],
        'correcta' => 'b',
        'porque'   => 'Ese es el truco de pandas: primero se construye una mascara booleana y luego se mete dentro de los corchetes para quedarse con las filas True.'
    ],
    'm2' => [
        'texto'    => 'Con dos condiciones, &iquest;por que se usa <code>&amp;</code> y no <code>and</code>?',
        'opciones' => [
            'a' => 'Por costumbre, las dos funcionan',
            'b' => 'Porque <code>and</code> compara <b>un</b> valor con otro, y aqui hay que comparar <b>columna contra columna</b> elemento a elemento; eso lo hace <code>&amp;</code>',
            'c' => 'Porque <code>and</code> es mas lento',
            'd' => 'Porque <code>and</code> solo sirve con numeros'
        ],
        'correcta' => 'b',
        'porque'   => 'Con <code>and</code> sale el error <em>&laquo;The truth value of a Series is ambiguous&raquo;</em>. Y = <code>&amp;</code>, O = <code>|</code>, NO = <code>~</code>.'
    ],
    'm3' => [
        'texto'    => '&iquest;Por que cada condicion va entre parentesis en <code>(a == 1) &amp; (b == 2)</code>?',
        'opciones' => [
            'a' => 'Por legibilidad nada mas',
            'b' => 'Porque en Python <code>&amp;</code> tiene <b>mas prioridad</b> que <code>==</code>, asi que sin parentesis intentaria hacer <code>1 &amp; b</code> primero y falla',
            'c' => 'Porque pandas lo exige siempre en cualquier expresion',
            'd' => 'Porque asi se evalua mas rapido'
        ],
        'correcta' => 'b',
        'porque'   => 'Es un detalle de precedencia de operadores, no de pandas. Sin parentesis: <code>TypeError</code>.'
    ],
    'm4' => [
        'texto'    => '&iquest;Que hace <code>inplace=True</code>?',
        'opciones' => [
            'a' => 'Modifica el dataframe original en vez de devolver una copia modificada',
            'b' => 'Guarda el dataframe en disco',
            'c' => 'Hace la operacion mas rapida',
            'd' => 'Deja el dataframe original intacto'
        ],
        'correcta' => 'a',
        'porque'   => 'Sin el, hay que reasignar: <code>df = df.dropna(...)</code>. Con el, la linea no devuelve nada (devuelve None), asi que <b>nunca</b> se combinan las dos cosas.'
    ],
    'm5' => [
        'texto'    => 'Despues de <code>dropna()</code> se hace <code>reset_index(drop=True)</code>. &iquest;Que pasa si te lo saltas?',
        'opciones' => [
            'a' => 'Nada, es opcional siempre',
            'b' => 'El indice se queda con <b>huecos</b> (0,1,4,7...) porque conserva las etiquetas viejas, y <code>loc[2]</code> puede fallar o no ser la tercera fila',
            'c' => 'Se pierden columnas',
            'd' => 'El dataframe queda vacio'
        ],
        'correcta' => 'b',
        'porque'   => 'Y el <code>drop=True</code> es lo que evita que el indice viejo se cuele como una columna nueva llamada <code>index</code>.'
    ],
    'm6' => [
        'texto'    => '&iquest;Por que <code>df_clean = netflix_df.copy()</code> y no <code>df_clean = netflix_df</code>?',
        'opciones' => [
            'a' => 'Son equivalentes',
            'b' => 'Sin <code>.copy()</code> las dos variables apuntan al <b>mismo</b> dataframe: cambiar una cambia la otra y pierdes el original',
            'c' => 'Porque <code>.copy()</code> ordena las filas',
            'd' => 'Porque <code>.copy()</code> elimina los nulos'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la regla: antes de ensuciar los datos, copia profunda. Asi siempre puedes volver a <code>netflix_df</code> sin recargar el CSV.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('3 · Filtrar, limpiar y crear columnas', 'mascaras booleanas · loc con condicion · dropna / replace');
?>

<div class="card">
  <h2>La idea de fondo</h2>
  <p>Filtrar en pandas <b>no</b> es un bucle. Es dos pasos:</p>
  <pre><code>1)  sales['Country'] == 'France'      ->  True, False, False, True, ...   (una mascara)
2)  sales[            mascara      ]  ->  solo las filas donde salio True</code></pre>
  <p>Todo lo demas de esta pagina son variaciones de eso.</p>
  <div class="nota">Recuerda: <b>Y</b> es <code>&amp;</code>, <b>O</b> es <code>|</code>, <b>NO</b> es <code>~</code>,
    y cada condicion va <b>entre parentesis</b>.</div>
</div>


<div class="card">
  <h2>1. La mascara y el filtro basico</h2>

  <?php linea(1, 'la <b>mascara</b> sola: True donde el pais es <code>France</code>'); ?>
  <?php linea(2, 'ahora las <b>filas</b> de Francia, metiendo la mascara en los corchetes'); ?>
  <?php linea(3, 'las ventas del estado <code>Kentucky</code>, pero escrito con <code>.loc[]</code>'); ?>
  <?php linea(4, 'las ventas con <code>Revenue</code> mayor que 1000'); ?>
  <?php linea(5, '<b>cuantas</b> ventas hay en Francia (un numero)'); ?>
  <?php ayuda('Filtras y luego pides <code>.shape[0]</code>, que es el numero de filas.'); ?>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Filtrar filas <em>y</em> quedarse con una columna</h2>
  <p>Aqui se ve para que sirve de verdad <code>.loc[]</code>: la coma separa
     <b>que filas</b> de <b>que columnas</b>.</p>
  <pre><code>sales.loc[ CONDICION , 'Columna' ]
           \_______/   \________/
            filas       columnas</code></pre>

  <?php linea(6, 'el <code>Revenue</code> <b>solo</b> de las filas cuyo <code>Age_Group</code> es <code>Adults (35-64)</code>'); ?>
  <?php linea(7, 'y ahora su <b>media</b>'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Varias condiciones a la vez</h2>

  <?php linea(8, 'cuantos registros son <code>Youth (&lt;25)</code> <b>o</b> <code>Adults (35-64)</code>'); ?>
  <?php ayuda('Filtras con <code>|</code>, y al final <code>.shape[0]</code> para el conteo.'); ?>
  <?php linea(9, 'la media de <code>Revenue</code> de <code>Adults (35-64)</code> <b>en</b> <code>United States</code>'); ?>
  <?php ayuda('Dos condiciones con <code>&amp;</code>, coma, y el nombre de la columna. Luego <code>.mean()</code>.'); ?>
  <?php linea(10, 'las ventas de Francia <b>o</b> Alemania, pero sin repetir la condicion (usa un metodo que recibe una lista)'); ?>
  <?php linea(11, 'las ventas que <b>no</b> son de Francia'); ?>

  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Modificar y crear columnas</h2>
  <p>Si una seleccion se puede leer, tambien se le puede asignar. Cambia el lado izquierdo del <code>=</code>.</p>

  <?php linea(12, 'subir un <b>10%</b> el <code>Revenue</code> <b>solo</b> de las ventas de Francia'); ?>
  <?php ayuda('Misma seleccion de antes (<code>loc[condicion, columna]</code>), pero a la izquierda del <code>*=</code>.'); ?>
  <?php linea(13, 'aplicar un <b>3% de impuesto</b> a todos los <code>Unit_Price</code>'); ?>

  <p>Columnas nuevas. Se crean solas nombrandolas:</p>
  <?php linea(14, '<code>Revenue_per_Age</code> = <code>Revenue</code> dividido por <code>Customer_Age</code>'); ?>
  <?php linea(15, '<code>Calculated_Cost</code> = <code>Order_Quantity</code> por <code>Unit_Cost</code>'); ?>
  <?php linea(16, '<code>Calculated_Revenue</code> = <code>Cost</code> mas <code>Profit</code>'); ?>
  <?php linea(17, 'comprobar en <b>cuantas filas</b> <code>Calculated_Cost</code> <b>no</b> coincide con <code>Cost</code>'); ?>
  <?php ayuda('Comparas las dos columnas con <code>!=</code>, envuelves en parentesis y sumas los True. Si sale 0, tu formula era correcta.'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Limpieza — el guion de la practica de Netflix</h2>
  <p>Estas ocho lineas van <b>siempre en este orden</b>. Merece la pena sabertelas seguidas.</p>

  <?php linea(18, 'hacer una <b>copia</b> de <code>netflix_df</code> llamada <code>df_clean</code>'); ?>
  <?php linea(19, 'cuantas filas estan <b>duplicadas</b>'); ?>
  <?php linea(20, 'cuantos <b>nulos</b> hay por columna en <code>netflix_df</code>'); ?>
  <?php linea(21, 'eliminar las filas con nulo en <code>date_added</code>, <b>modificando</b> <code>df_clean</code>'); ?>
  <?php ayuda('<code>.dropna(subset=[...], inplace=True)</code>. El <code>subset</code> es lo que evita que borre filas por culpa de otras columnas.'); ?>
  <?php linea(22, 'reorganizar el indice despues de borrar filas'); ?>
  <?php linea(23, 'verificar que ya no quedan nulos en <code>date_added</code>'); ?>
  <?php linea(24, 'sustituir los nulos de <code>director</code> por <code>Desconocido</code>'); ?>
  <?php ayuda('El valor nulo se escribe <code>np.nan</code>: <code>df[\'col\'].replace(np.nan, \'texto\', inplace=True)</code>.'); ?>
  <?php linea(25, 'lo mismo para <code>cast</code>'); ?>
  <?php linea(26, 'lo mismo para <code>country</code>'); ?>
  <?php linea(27, 'eliminar las filas duplicadas de <code>df_clean</code>'); ?>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Agrupar</h2>
  <p>Mismo patron siempre: <code>agrupa por esto</code> &rarr; <code>coge esta columna</code> &rarr; <code>resumela asi</code>.</p>
  <pre><code>sales.groupby('Country')['Revenue'].sum()
       \_________/  \_______/  \___/
        por que     de que     como</code></pre>

  <?php linea(28, '<code>Revenue</code> <b>total</b> por pais'); ?>
  <?php linea(29, '<code>Revenue</code> <b>medio</b> por pais'); ?>
  <?php linea(30, '<code>Profit</code> medio por <code>Age_Group</code>'); ?>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Referencia/index.php', '../Graficas/index.php');
