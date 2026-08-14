<?php
/* ==========================================================================
   APO / Lectura_1  —  Fundamentos: cargar el dataset y explorarlo
   Fuente: Lecture_1.ipynb y Exercises_1.ipynb  (dataset: data/sales_data.csv)
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- 1. importar --- */
    1  => ["import numpy as np"],
    2  => ["import pandas as pd"],
    3  => ["import matplotlib.pyplot as plt"],
    4  => ["%matplotlib inline"],

    /* --- 2. cargar --- */
    5  => ["pd.read_csv"],
    6  => ["parse_dates"],
    7  => ["sales = pd.read_csv('data/sales_data.csv', parse_dates=['Date'])",
           "sales = pd.read_csv('data/sales_data.csv',parse_dates=['Date'])"],

    /* --- 3. la foto rapida --- */
    8  => ["sales.shape"],
    9  => ["sales.head()", "sales.head(5)"],
    10 => ["sales.tail()", "sales.tail(5)"],
    11 => ["sales.info()"],
    12 => ["sales.describe()"],
    13 => ["sales.columns"],
    14 => ["sales.dtypes"],
    15 => ["len(sales)", "sales.shape[0]"],
    16 => ["sales.head(3)"],

    /* --- 4. una sola columna --- */
    17 => ["sales['Unit_Cost'].describe()"],
    18 => ["sales['Unit_Cost'].mean()"],
    19 => ["sales['Unit_Cost'].median()"],
    20 => ["sales['Customer_Age'].mean()"],
    21 => ["sales['Customer_Age'].median()"],
    22 => ["sales['Order_Quantity'].mean()"],
    23 => ["sales['Unit_Cost'].max()"],
    24 => ["sales['Unit_Cost'].min()"],
    25 => ["sales['Unit_Cost'].std()"],
    26 => ["sales['Unit_Cost'].sum()"],

    /* --- 5. contar categorias --- */
    27 => ["sales['Age_Group'].value_counts()"],
    28 => ["sales['Year'].value_counts()"],
    29 => ["sales['Product'].unique()"],
    30 => ["sales['Product'].nunique()"],

    /* --- 6. calidad de los datos --- */
    31 => ["sales.duplicated().sum()"],
    32 => ["sales.isna().sum()"],
    33 => ["sales.corr()"],
];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Ejecutas <code>sales.shape</code> y sale <code>(113036, 18)</code>. &iquest;Que significa cada numero?',
        'opciones' => [
            'a' => '113036 columnas y 18 filas',
            'b' => '113036 filas (registros) y 18 columnas (atributos)',
            'c' => '113036 valores nulos y 18 columnas',
            'd' => '113036 celdas y 18 tipos de dato'
        ],
        'correcta' => 'b',
        'porque'   => 'Siempre en ese orden: <b>(filas, columnas)</b>. Cada fila es una venta; cada columna, un atributo de esa venta.'
    ],
    'm2' => [
        'texto'    => '&iquest;En que se diferencian <code>.info()</code> y <code>.describe()</code>?',
        'opciones' => [
            'a' => 'Son sinonimos, devuelven lo mismo',
            'b' => '<code>.info()</code> da tipos de dato y no-nulos por columna; <code>.describe()</code> da estadisticas (media, std, cuartiles) de las columnas numericas',
            'c' => '<code>.info()</code> es solo para columnas de texto y <code>.describe()</code> solo para fechas',
            'd' => '<code>.describe()</code> imprime el dataframe completo'
        ],
        'correcta' => 'b',
        'porque'   => '<code>.info()</code> responde &laquo;&iquest;que tengo y que me falta?&raquo;. <code>.describe()</code> responde &laquo;&iquest;como se reparten los numeros?&raquo;.'
    ],
    'm3' => [
        'texto'    => '&iquest;Que hace exactamente <code>sales[\'Year\'].value_counts()</code>?',
        'opciones' => [
            'a' => 'Suma todos los valores de la columna Year',
            'b' => 'Cuenta cuantas veces aparece cada valor unico de Year, ordenado de mayor a menor',
            'c' => 'Devuelve los anios sin repetir, sin contarlos',
            'd' => 'Cuenta cuantos valores nulos hay en Year'
        ],
        'correcta' => 'b',
        'porque'   => 'Es un &laquo;agrupar y contar&raquo;: toma las 113.036 filas, junta las que comparten anio y devuelve una Series con el anio de indice y el conteo de valor. Para ver los valores <em>sin contar</em> se usa <code>.unique()</code>.'
    ],
    'm4' => [
        'texto'    => '&iquest;Por que <code>sales.describe()</code> no muestra la columna <code>Country</code>?',
        'opciones' => [
            'a' => 'Porque tiene valores nulos',
            'b' => 'Porque por defecto solo resume las columnas <b>numericas</b>; Country es de tipo object (texto)',
            'c' => 'Porque Country tiene demasiados valores distintos',
            'd' => 'Porque hay que ordenarla primero'
        ],
        'correcta' => 'b',
        'porque'   => 'La media de un pais no significa nada. Si igual la quieres ver: <code>sales.describe(include=\'all\')</code>.'
    ],
    'm5' => [
        'texto'    => 'Cargas el CSV sin <code>parse_dates=[\'Date\']</code>. &iquest;Que pasa con la columna <code>Date</code>?',
        'opciones' => [
            'a' => 'No se carga',
            'b' => 'Se carga como texto (object), y no podras restar fechas ni usar <code>.dt</code>',
            'c' => 'Se carga como numero entero',
            'd' => 'pandas la detecta sola siempre, da igual'
        ],
        'correcta' => 'b',
        'porque'   => 'Para pandas todo lo que no reconoce es texto. <code>parse_dates</code> le dice &laquo;esta columna conviertela a datetime64 al leerla&raquo;.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE);
cabecera('1 · Fundamentos: cargar y explorar', 'sales_data.csv — Lecture_1 / Exercises_1');
?>

<div class="card">
  <h2>Antes de empezar</h2>
  <p>Este cuestionario es de <b>memoria muscular</b>. No hay que razonar mucho: hay que escribir
     la linea exacta hasta que salga sola. Cada hueco se verifica solo, uno por uno.</p>
  <div class="nota">
    <b>Como se corrige.</b>
    <span class="mk ok">&#10004;</span> exacto &nbsp;·&nbsp;
    <span class="mk casi">&#9888;</span> acertaste la estructura pero fallaste una mayuscula
    (en Python <code>sales['customer_age']</code> revienta) &nbsp;·&nbsp;
    <span class="mk bad">&#10008;</span> otra cosa.
    Da igual si usas comillas simples o dobles, y da igual el espaciado.
    Pulsa <b>Enter</b> dentro de un hueco para verificar sin bajar al boton.
  </div>
  <p>El dataframe siempre se llama <code>sales</code> y estas son sus columnas:</p>
  <pre><code>Date  Day  Month  Year  Customer_Age  Age_Group  Customer_Gender
Country  State  Product_Category  Sub_Category  Product
Order_Quantity  Unit_Cost  Unit_Price  Profit  Cost  Revenue</code></pre>
</div>


<div class="card">
  <h2>1. Las tres lineas con las que arranca todo notebook</h2>
  <p>Van siempre en el mismo orden y con los mismos alias. Escribelas de memoria:</p>

  <?php linea(1, 'numpy con el alias <b>np</b>'); ?>
  <?php linea(2, 'pandas con el alias <b>pd</b>'); ?>
  <?php linea(3, 'el modulo <b>pyplot</b> de matplotlib con el alias <b>plt</b>'); ?>
  <?php linea(4, 'la linea magica para que las graficas salgan dentro del notebook'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Cargar el CSV</h2>
  <p>La funcion de pandas que lee un archivo separado por comas es
     <?php hueco(5, 14); ?> , y el parametro que convierte una columna a fecha
     al leerla es <?php hueco(6, 14); ?> .</p>

  <p>Ahora la linea completa: carga <code>data/sales_data.csv</code> en un dataframe llamado
     <code>sales</code>, indicando que <code>Date</code> es una fecha.</p>
  <?php linea(7, 'ojo: la ruta lleva la carpeta <code>data/</code> delante, y <code>parse_dates</code> recibe una <b>lista</b>'); ?>
  <?php ayuda('<code>sales = pd.read_csv(\'ruta\', parse_dates=[\'columna\'])</code>'); ?>

  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. La foto rapida del dataframe</h2>
  <p>Esto es lo primero que se hace <em>siempre</em> al abrir un dataset. Son cinco lineas
     y las cinco caen en el parcial.</p>

  <?php linea(8,  '<b>dimensiones</b> del dataframe (filas y columnas). No lleva parentesis.'); ?>
  <?php linea(9,  '<b>primeras</b> filas (5 por defecto)'); ?>
  <?php linea(10, '<b>ultimas</b> filas'); ?>
  <?php linea(11, 'tipos de dato y cuantos <b>no nulos</b> hay por columna'); ?>
  <?php linea(12, '<b>estadisticas</b> basicas de las columnas numericas'); ?>

  <p>Dos mas que conviene tener a mano:</p>
  <?php linea(13, 'los <b>nombres</b> de las columnas'); ?>
  <?php linea(14, 'el <b>tipo de dato</b> de cada columna'); ?>

  <p>Y dos variantes que se preguntan mucho:</p>
  <?php linea(15, 'el <b>numero de filas</b> como un solo numero entero'); ?>
  <?php linea(16, 'solo las <b>3</b> primeras filas'); ?>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Bajar a una sola columna</h2>
  <p>Este es el patron que hay que automatizar. Siempre es el mismo:</p>
  <pre><code>dataframe['Nombre_De_La_Columna'].metodo()
   |              |                    |
 la tabla    la columna         que le hago</code></pre>

  <p>Aplicado a <code>Unit_Cost</code>:</p>
  <?php linea(17, 'estadisticas de <b>esa columna sola</b>'); ?>
  <?php linea(18, 'la <b>media</b>'); ?>
  <?php linea(19, 'la <b>mediana</b>'); ?>
  <?php linea(23, 'el valor <b>maximo</b>'); ?>
  <?php linea(24, 'el valor <b>minimo</b>'); ?>
  <?php linea(25, 'la <b>desviacion estandar</b>'); ?>
  <?php linea(26, 'la <b>suma</b> de toda la columna'); ?>

  <p>Ahora sin ayuda, cambiando de columna:</p>
  <?php linea(20, 'la <b>media</b> de <code>Customer_Age</code>'); ?>
  <?php linea(21, 'la <b>mediana</b> de <code>Customer_Age</code>'); ?>
  <?php linea(22, 'la <b>media</b> de <code>Order_Quantity</code>'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Contar categorias</h2>
  <p>Cuando la columna es de texto no tiene sentido la media: lo que se quiere saber es
     <b>cuantas veces aparece cada valor</b>.</p>

  <?php linea(27, 'cuantas ventas hay por cada <code>Age_Group</code>'); ?>
  <?php linea(28, 'cuantas ventas hay por cada <code>Year</code>'); ?>
  <?php linea(29, 'la lista de <code>Product</code> <b>sin repetir</b> (un array de numpy)'); ?>
  <?php linea(30, '<b>cuantos</b> productos distintos hay (un numero)'); ?>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. &iquest;Estan limpios los datos?</h2>
  <p>Dos preguntas obligatorias antes de analizar nada, y una tercera para ver relaciones.</p>

  <?php linea(31, 'cuantas filas estan <b>duplicadas</b> (un solo numero)'); ?>
  <?php ayuda('Primero <code>.duplicated()</code> devuelve True/False por fila; luego <code>.sum()</code> suma los True.'); ?>
  <?php linea(32, 'cuantos valores <b>nulos</b> hay <b>por columna</b>'); ?>
  <?php ayuda('Mismo truco: <code>.isna()</code> marca True/False celda a celda y <code>.sum()</code> los suma por columna. <code>.isnull()</code> es exactamente lo mismo.'); ?>
  <?php linea(33, 'la matriz de <b>correlacion</b> entre las columnas numericas'); ?>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('', '../Referencia/index.php');
