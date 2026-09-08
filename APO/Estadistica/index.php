<?php
/* ==========================================================================
   APO / Estadistica  —  Estadistica Descriptiva: fundamentos para IA y CD
   Fuente: Lecturas_curso/Estadistica_Descriptiva_apo3.pdf
           (Anibal Sosa / Milton Sarria — 30-07-2026)
   Respuestas de TEXTO: da igual tilde, mayuscula y articulo.
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [

    /* --- 1. que es la estadistica y sus dos ramas --- */
    1  => ["Descriptiva", "Estadistica descriptiva"],
    2  => ["Inferencial", "Estadistica inferencial"],
    3  => ["Poblacion"],
    4  => ["Muestra"],

    /* --- 2. tipos de variable --- */
    5  => ["Variable"],
    6  => ["Cualitativa", "Cualitativas", "Categorica"],
    7  => ["Cuantitativa", "Cuantitativas", "Numerica"],
    8  => ["Nominal"],
    9  => ["Ordinal"],
    10 => ["Discreta"],
    11 => ["Continua"],
    12 => ["Conteo", "Un conteo", "Contar"],
    13 => ["Medicion", "Una medicion", "Medir"],

    /* --- 3. describir cualitativas --- */
    14 => ["Tabla de frecuencias", "Tabla de frecuencia"],
    15 => ["Grafico de barras", "Diagrama de barras", "Barras"],
    16 => ["Grafico circular", "Graficos circulares", "Circular", "Pastel", "Torta"],

    /* --- 4. tendencia central --- */
    17 => ["Media", "Promedio"],
    18 => ["Mediana"],
    19 => ["Moda"],

    /* --- 5. dispersion --- */
    20 => ["Desviacion estandar"],
    21 => ["Varianza"],
    22 => ["Coeficiente de variacion", "CV"],
    23 => ["Homogeneo", "Poco variable", "Poco variable / homogeneo"],
    24 => ["Heterogeneo", "Variable", "Variable / heterogeneo"],
    25 => ["Muy heterogeneo", "Muy variable", "Muy variable / muy heterogeneo"],

    /* --- 6. medidas de posicion --- */
    26 => ["Cuartiles", "Cuartil"],
    27 => ["Deciles", "Decil"],
    28 => ["Percentiles", "Percentil"],
    29 => ["Minimo"],
    30 => ["Maximo"],

    /* --- 7. forma de la distribucion --- */
    31 => ["Asimetria", "Sesgo", "Skewness"],
    32 => ["Curtosis"],
    33 => ["Simetrica", "Distribucion simetrica"],
    34 => ["Sesgo a la izquierda", "Sesgo negativo", "Izquierda", "Negativo"],
    35 => ["Sesgo a la derecha", "Sesgo positivo", "Derecha", "Positivo"],
    36 => ["Mesocurtica"],
    37 => ["Leptocurtica"],
    38 => ["Platicurtica"],

    /* --- 8. analisis bivariado --- */
    39 => ["Tabla de contingencia"],
    40 => ["Boxplot", "Diagrama de caja", "Diagrama de cajas"],
    41 => ["Coeficiente de correlacion de Pearson", "Correlacion de Pearson", "Pearson"],
    42 => ["Diagrama de dispersion", "Grafico de dispersion", "Dispersion", "Scatter"],
];

$MULTIPLE = [

    'm1' => [
        'texto'    => '&iquest;Cual es la diferencia entre estadistica <b>descriptiva</b> e <b>inferencial</b>?',
        'opciones' => [
            'a' => 'La descriptiva usa graficos y la inferencial usa tablas',
            'b' => 'La descriptiva <b>organiza, resume y presenta</b> los datos; la inferencial <b>determina una propiedad de una poblacion</b> a partir de una muestra',
            'c' => 'La descriptiva es para variables cualitativas y la inferencial para cuantitativas',
            'd' => 'Son sinonimos'
        ],
        'correcta' => 'b',
        'porque'   => 'Descriptiva = <em>lo que tengo delante</em>. Inferencial = <em>generalizar de la muestra a la poblacion</em>. En un proyecto de datos la descriptiva vive sobre todo en <code>data understanding</code> y <code>preparation</code>.'
    ],

    'm2' => [
        'texto'    => 'La <b>escala de satisfaccion del cliente</b> (muy insatisfecho &hellip; muy satisfecho) es una variable:',
        'opciones' => [
            'a' => 'Cualitativa nominal',
            'b' => 'Cualitativa <b>ordinal</b>',
            'c' => 'Cuantitativa discreta',
            'd' => 'Cuantitativa continua'
        ],
        'correcta' => 'b',
        'porque'   => 'Hay categorias y <b>si hay orden</b>, pero la distancia entre ellas no esta definida numericamente. Otros ejemplos ordinales del PDF: perfil de riesgo, estrato socioeconomico, nivel de desempeno, posicion en una carrera de F1.'
    ],

    'm3' => [
        'texto'    => 'El <b>numero de goles</b> de un partido y el <b>tiempo de espera</b> en una parada de bus son, respectivamente:',
        'opciones' => [
            'a' => 'Continua y discreta',
            'b' => '<b>Discreta y continua</b>',
            'c' => 'Las dos discretas',
            'd' => 'Las dos continuas'
        ],
        'correcta' => 'b',
        'porque'   => 'La regla del PDF: la <b>discreta</b> resulta de un <em>conteo</em> y entre dos valores consecutivos no hay nada en medio; la <b>continua</b> resulta de una <em>medicion</em> y siempre existe (en teoria) un valor intermedio.'
    ],

    'm4' => [
        'texto'    => 'Alguien promedia una escala de satisfaccion de 1 a 10 y concluye: «el promedio es 8,5, estamos bien». &iquest;Que falla?',
        'opciones' => [
            'a' => 'Nada, es correcto',
            'b' => 'Que antes de promediar hay que preguntarse que tipo de variable es, si existe una unidad de medida real y si tiene sentido decir que un 10 es «dos veces» mas satisfactorio que un 5',
            'c' => 'Que deberia haber usado la moda siempre',
            'd' => 'Que 8,5 no es un valor posible de la escala'
        ],
        'correcta' => 'b',
        'porque'   => 'Es una variable <b>ordinal</b>: hay orden, pero la distancia entre categorias no esta definida. Promediarla le inventa una aritmetica que no tiene.'
    ],

    'm5' => [
        'texto'    => 'En las series <code>1,2,2,3,4</code> &rarr; <code>1,2,2,3,8</code> &rarr; <code>1,2,2,3,16</code> &rarr; <code>1,2,2,3,32</code>, la mediana se queda en 2 pero la media pasa de 2,4 a 3,2, 4,8 y 8. &iquest;Que ilustra el ejemplo?',
        'opciones' => [
            'a' => 'Que la mediana esta mal calculada',
            'b' => 'Que la <b>media es sensible a los valores extremos</b> y la mediana no',
            'c' => 'Que la moda es siempre la mejor medida',
            'd' => 'Que hay que eliminar siempre los valores extremos'
        ],
        'correcta' => 'b',
        'porque'   => 'Un solo dato extremo arrastra la media y deja la mediana intacta. Por eso, cuando se sospecha de atipicos o de asimetria, la mediana describe mejor el «centro».'
    ],

    'm6' => [
        'texto'    => 'Un conjunto de datos tiene media 40 y desviacion estandar 20. &iquest;Cual es su coeficiente de variacion, y como se lee segun la referencia de Vargas (2007)?',
        'opciones' => [
            'a' => 'CV = 20 %, poco variable / homogeneo',
            'b' => 'CV = <b>50 %</b>, variable / heterogeneo',
            'c' => 'CV = 50 %, muy variable / muy heterogeneo',
            'd' => 'CV = 200 %, no se puede interpretar'
        ],
        'correcta' => 'b',
        'porque'   => '<code>CV = Sx / |x&#772;| = 20 / 40 = 0,5 = 50 %</code>, que cae en la franja <b>30-70 %</b>. Y la advertencia del PDF: no hay umbral universal, depende del contexto (en manufactura un 5-10 % ya puede ser critico).'
    ],

    'm7' => [
        'texto'    => 'En el ejemplo de las visitas a la sucursal bancaria: media 29,83 y mediana 30. &iquest;Que forma tiene la distribucion?',
        'opciones' => [
            'a' => 'Fuertemente sesgada a la derecha',
            'b' => 'Fuertemente sesgada a la izquierda',
            'c' => 'Practicamente <b>simetrica</b>: media y mediana casi coinciden',
            'd' => 'Leptocurtica'
        ],
        'correcta' => 'c',
        'porque'   => 'La regla: <b>media = mediana</b> &rarr; simetrica; <b>media &lt; mediana</b> &rarr; sesgo a la izquierda (negativo); <b>mediana &lt; media</b> &rarr; sesgo a la derecha (positivo). Aqui 29,83 y 30 estan pegadas.'
    ],

    'm8' => [
        'texto'    => 'Una distribucion <b>puntiaguda en el centro y con colas largas</b> tiene un coeficiente de curtosis:',
        'opciones' => [
            'a' => 'Mayor que 0 &mdash; es <b>leptocurtica</b>',
            'b' => 'Menor que 0 &mdash; es platicurtica',
            'c' => 'Igual a 0 &mdash; es mesocurtica',
            'd' => 'La curtosis no tiene signo'
        ],
        'correcta' => 'a',
        'porque'   => 'Truco para no confundirlas: <b>lepto</b> = «delgada», la punta; <b>plati</b> = «plana», achatada y de colas cortas; <b>meso</b> = «media», igual que la normal (&asymp; 0). La curtosis mide la presencia de datos extremos en las colas.'
    ],

    'm9' => [
        'texto'    => 'Quieres explorar la relacion entre <b>sexo</b> (cualitativa) y <b>habito de fumar</b> (cualitativa). &iquest;Que usas?',
        'opciones' => [
            'a' => 'Coeficiente de Pearson y diagrama de dispersion',
            'b' => 'Boxplot comparativo',
            'c' => '<b>Tabla de contingencia</b> y/o grafico de barras',
            'd' => 'Media y desviacion estandar de cada una'
        ],
        'correcta' => 'c',
        'porque'   => 'La tabla del PDF: <b>dos cualitativas</b> &rarr; contingencia / barras; <b>cuantitativa + cualitativa</b> &rarr; tabla descriptiva por grupos y/o boxplot comparativo; <b>dos cuantitativas</b> &rarr; Pearson y dispersion.'
    ],

    'm10' => [
        'texto'    => 'Calculas <code>r = -0,72</code> entre dos variables cuantitativas. &iquest;Como se interpreta?',
        'opciones' => [
            'a' => 'Relacion lineal negativa <b>fuerte</b>',
            'b' => 'Relacion lineal negativa moderada/debil',
            'c' => 'Relacion nula',
            'd' => 'Relacion positiva fuerte'
        ],
        'correcta' => 'a',
        'porque'   => 'La escala del PDF: <code>-1,0 a -0,5</code> negativa fuerte &middot; <code>-0,5 a -0,1</code> negativa moderada/debil &middot; <code>-0,1 a 0,1</code> nula &middot; <code>0,1 a 0,5</code> positiva moderada/debil &middot; <code>0,5 a 1,0</code> positiva fuerte. Pearson mide solo la fuerza de la relacion <b>lineal</b>.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, range(1, 42));
cabecera('Estadistica Descriptiva · Fundamentos para IA y Ciencia de Datos', 'Estadistica_Descriptiva_apo3.pdf');
?>

<div class="card">
  <h2>Antes de empezar</h2>
  <p>Aqui se pregunta el <b>vocabulario</b> de la estadistica descriptiva: como se llama cada
     cosa y cuando se usa. Es lo que hace falta para leer un <code>describe()</code> sin
     inventarse nada.</p>
  <div class="nota">
    <b>Como se corrige.</b> Respuestas en castellano: da igual la <b>tilde</b>, la
    <b>mayuscula</b>, el <b>articulo</b> de delante y el punto final.
    <code>La Desviación Estándar</code> vale lo mismo que <code>desviacion estandar</code>.
    Pulsa <b>Enter</b> dentro de un hueco para verificar.
  </div>
</div>


<div class="card">
  <h2>1. Que es la estadistica y sus dos ramas</h2>
  <p>Segun Lind, Marchal &amp; Wathen (2015), la estadistica es la ciencia que <b>recoge,
     organiza, presenta, analiza e interpreta</b> datos con el fin de propiciar la toma de
     decisiones mas eficaz.</p>

  <p>La rama que <b>organiza, resume y presenta</b> los datos de manera informativa es la
     estadistica <?php hueco(1, 18); ?> , y la que determina una propiedad de una
     poblacion a partir de una muestra es la estadistica <?php hueco(2, 18); ?> .</p>

  <p>En esa segunda, el conjunto completo que se quiere describir se llama
     <?php hueco(3, 14); ?> , y el subconjunto que se observa realmente es la
     <?php hueco(4, 14); ?> .</p>

  <div class="avisoflujo">
    <b>Donde aparece cada una en un proyecto de datos</b> (IBM, 2015):
    la descriptiva manda en <em>data requirements / collection</em> y en
    <em>data understanding / preparation</em>; la inferencial aparece en
    <em>modeling</em> y <em>evaluation</em>.
  </div>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Tipos de variable</h2>

  <p>Una caracteristica o cualidad que puede tomar distintos valores en los individuos
     u objetos de estudio se llama <?php hueco(5, 14); ?> .</p>

  <p>Si es de naturaleza <b>no numerica</b> se llama <?php hueco(6, 16); ?> ,
     y si es de naturaleza <b>numerica</b> se llama <?php hueco(7, 16); ?> .</p>

  <h3>Las dos ramas de cada una</h3>

  <table class="datos">
    <tr><th>Tipo</th><th>Subtipo</th><th>Como se reconoce</th><th>Ejemplos del PDF</th></tr>
    <tr>
      <td rowspan="2"><b>Cualitativa</b></td>
      <td><?php hueco(8, 12); ?></td>
      <td>Categorias mutuamente excluyentes, <b>sin</b> ningun orden</td>
      <td>grupo sanguineo, ciudad de procedencia, estado civil, color de ojos</td>
    </tr>
    <tr>
      <td><?php hueco(9, 12); ?></td>
      <td>Categorias excluyentes donde <b>si</b> existe orden o jerarquia</td>
      <td>satisfaccion del cliente, perfil de riesgo, estrato, posicion en una carrera</td>
    </tr>
    <tr>
      <td rowspan="2"><b>Cuantitativa</b></td>
      <td><?php hueco(10, 12); ?></td>
      <td>Numero contable de valores; entre dos consecutivos no hay nada en medio</td>
      <td>numero de clientes, numero de goles, visitas a una web, numero de hijos</td>
    </tr>
    <tr>
      <td><?php hueco(11, 12); ?></td>
      <td>Infinitos valores entre dos puntos cualesquiera</td>
      <td>utilidades del mes, ingresos, tiempo de espera, peso o estatura</td>
    </tr>
  </table>

  <p>La regla de bolsillo para no confundirlas: la discreta resulta de un
     <?php hueco(12, 14); ?> y la continua resulta de una <?php hueco(13, 14); ?> .</p>

  <div class="nota">
    <b>Transformar cuantitativa &rarr; cualitativa.</b> Se pueden agrupar los valores de una
    variable cuantitativa en categorias (normalmente ordinales). Los tres casos recurrentes:
    <b>asimetria extrema</b> (ingresos), <b>pocas opciones de respuesta</b> (edad de
    estudiantes de primer semestre) y <b>subgrupos con comportamientos distintos</b>
    (rangos etarios). Lo decide el contexto del problema, no una regla fija.
  </div>

  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Describir variables cualitativas</h2>
  <p>No tiene sentido la media: se resumen con <b>conteos y proporciones</b>.</p>

  <p>De manera numerica se usa una <?php hueco(14, 24); ?> , con la frecuencia
     y la frecuencia relativa de cada categoria.</p>

  <p>De manera grafica, lo que el PDF <b>recomienda</b> es el
     <?php hueco(15, 22); ?> , y lo que recomienda <b>evitar</b> es el
     <?php hueco(16, 22); ?> .</p>

  <table class="datos">
    <tr><th>Ciudad</th><th>Frecuencia</th><th>Frec. relativa</th></tr>
    <tr><td>Cali</td><td>100</td><td>50,0 %</td></tr>
    <tr><td>Pradera</td><td>50</td><td>25,0 %</td></tr>
    <tr><td>El Cerrito</td><td>50</td><td>25,0 %</td></tr>
    <tr><td class="idx"><b>Total</b></td><td class="idx"><b>200</b></td><td class="idx"><b>100,0 %</b></td></tr>
  </table>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Medidas de tendencia central</h2>
  <p>Buscan el «centro» de los datos: alrededor de que punto se agrupan.</p>

  <?php linea(17, 'El valor <b>promedio</b> de los datos'); ?>
  <?php linea(18, 'El valor que esta por encima del <b>50 %</b> de los datos, al ordenarlos de menor a mayor'); ?>
  <?php linea(19, 'El valor que aparece con <b>mayor frecuencia</b>'); ?>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Medidas de dispersion</h2>
  <p>Indican que tan agrupados estan los datos alrededor del centro.</p>

  <?php linea(20, 'El promedio de la desviacion de cada dato respecto a la media'); ?>
  <?php linea(21, 'Esa misma medida <b>al cuadrado</b>'); ?>
  <?php linea(22, 'Mide la dispersion como <b>proporcion de la media</b>, con la formula <code>CV = Sx / |x&#772;|</code>; sirve para comparar conjuntos distintos'); ?>

  <h3>La referencia de Vargas (2007)</h3>
  <p>No hay umbral universal &mdash;depende del contexto&mdash; pero como orientacion general:</p>

  <table class="datos">
    <tr><th>0 % &ndash; 30 %</th><th>30 % &ndash; 70 %</th><th>70 % &ndash; 100 %</th></tr>
    <tr>
      <td><?php hueco(23, 20); ?></td>
      <td><?php hueco(24, 20); ?></td>
      <td><?php hueco(25, 22); ?></td>
    </tr>
  </table>

  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Medidas de posicion</h2>
  <p>Describen la posicion de un valor respecto al resto, dividiendo los datos en partes
     iguales <b>tras ordenarlos</b>.</p>

  <p>Los valores extremos del conjunto son el <?php hueco(29, 12); ?> y el
     <?php hueco(30, 12); ?> .</p>

  <p>Dividen los datos en <b>4</b> grupos del 25 % &mdash;los mas usados&mdash;:
     <?php hueco(26, 14); ?> .<br>
     Dividen los datos en <b>10</b> grupos del 10 %: <?php hueco(27, 14); ?> .<br>
     Dividen los datos en <b>100</b> grupos del 1 %: <?php hueco(28, 14); ?> .</p>

  <h3>Ejemplo integrador: visitas diarias a una sucursal (18 dias habiles)</h3>
  <table class="datos">
    <tr><th>Medida</th><th>Valor</th></tr>
    <tr><td>Media</td><td>29,83</td></tr>
    <tr><td>Mediana</td><td>30</td></tr>
    <tr><td>Desviacion estandar</td><td>3,5</td></tr>
    <tr><td>Coeficiente de variacion</td><td>11,7 %</td></tr>
    <tr><td>Minimo</td><td>23</td></tr>
    <tr><td>1er Cuartil</td><td>27,25</td></tr>
    <tr><td>3er Cuartil</td><td>32</td></tr>
    <tr><td>Maximo</td><td>36</td></tr>
  </table>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Forma de la distribucion</h2>

  <p>La medida de la forma de la distribucion <b>alrededor del centro</b> se llama
     <?php hueco(31, 16); ?> , y la que mide el grado de extremidad de las
     <b>colas</b> (la presencia de datos extremos) se llama <?php hueco(32, 16); ?> .</p>

  <h3>Las tres situaciones de la primera</h3>
  <table class="datos">
    <tr><th>Si&hellip;</th><th>Entonces la distribucion es&hellip;</th></tr>
    <tr><td>Media = Mediana</td><td><?php hueco(33, 26); ?></td></tr>
    <tr><td>Media &lt; Mediana</td><td><?php hueco(34, 26); ?></td></tr>
    <tr><td>Mediana &lt; Media</td><td><?php hueco(35, 26); ?></td></tr>
  </table>
  <p class="sub" style="font-size:14px;color:#7a8494">
     El coeficiente de asimetria de Pearson: cercano a 0 indica simetria; mayor a 0, sesgo
     positivo; menor a 0, sesgo negativo.</p>

  <h3>Los tres nombres de la segunda</h3>
  <table class="datos">
    <tr><th>Forma</th><th>Coeficiente</th><th>Nombre</th></tr>
    <tr><td>Igual forma que una distribucion normal</td><td>&asymp; 0</td><td><?php hueco(36, 18); ?></td></tr>
    <tr><td>Puntiaguda en el centro, colas largas</td><td>&gt; 0</td><td><?php hueco(37, 18); ?></td></tr>
    <tr><td>Achatada en el centro, colas cortas</td><td>&lt; 0</td><td><?php hueco(38, 18); ?></td></tr>
  </table>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Relacion entre dos variables</h2>
  <p>Lo que se puede usar depende del tipo de las dos variables. Esta tabla cae entera:</p>

  <table class="datos">
    <tr><th>Combinacion</th><th>Herramientas</th><th>Ejemplo</th></tr>
    <tr>
      <td><b>Dos cualitativas</b></td>
      <td><?php hueco(39, 24); ?> y/o grafico de barras</td>
      <td>sexo y habito de fumar</td>
    </tr>
    <tr>
      <td><b>Cuantitativa y cualitativa</b></td>
      <td>Tabla descriptiva por grupos y/o <?php hueco(40, 20); ?> comparativo</td>
      <td>expectativa de vida por continente</td>
    </tr>
    <tr>
      <td><b>Dos cuantitativas</b></td>
      <td><?php hueco(41, 34); ?> y <?php hueco(42, 26); ?></td>
      <td>relacion lineal, de -1 a 1</td>
    </tr>
  </table>

  <h3>La escala de r</h3>
  <table class="datos">
    <tr>
      <th>-1,0 a -0,5</th><th>-0,5 a -0,1</th><th>-0,1 a 0,1</th><th>0,1 a 0,5</th><th>0,5 a 1,0</th>
    </tr>
    <tr>
      <td>Negativa fuerte</td><td>Negativa moderada/debil</td><td>Nula</td>
      <td>Positiva moderada/debil</td><td>Positiva fuerte</td>
    </tr>
  </table>

  <?php mc('m9'); ?>
  <?php mc('m10'); ?>

  <div class="avisoflujo">
    <b>Take aways de la lectura.</b> La descriptiva organiza y resume; la inferencial
    generaliza desde una muestra. Identificar bien el <b>tipo de variable</b> es lo que
    determina que medidas y graficos son validos. La media, la mediana y la desviacion
    estandar se interpretan siempre en contexto. Y la correlacion con el diagrama de
    dispersion al lado, nunca sola.
  </div>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../CRISP/index.php', '../SMART/index.php');
