<?php
/* ==========================================================================
   APO / Parcial1  —  Repaso del parcial 1
   Fuente: los PDF de C:\Users\luisg\Desktop\APO3\parciales

     - "Examen parcial 1_ 2025-B(GR1)...pdf"       (39 preguntas)
     - "Examen parcial 1_ 2025-B(GR1)... (1).pdf"  (copia byte a byte)
     - "Examen parcial 1_ 2025-2 (GR1)...pdf"      (39 preguntas, MISMO examen
                                                    con las opciones barajadas,
                                                    y con la clave de respuestas)

   Las 39 de 2025-B estan todas contenidas en 2025-2: cambia el orden de las
   opciones y en algunas hay un distractor extra ("Ninguna de las opciones").
   Quedan 39 preguntas unicas.

   Los enunciados y las opciones estan copiados TAL CUAL del examen, sin
   reescribir ni resumir; cuando las dos versiones daban opciones distintas se
   ponen todas. La 4 sigue siendo de ordenar, la 23 conserva las formulas como
   imagenes (extraidas del PDF) y la 28 sigue siendo de seleccion multiple.
   Las respuestas correctas salen de la revision de 2025-2.
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

/* --- pregunta 4: ordenar las fases de CRISP-DM (se responde escribiendo) --- */
$SOLUCIONES = [
    1 => ["Comprension del negocio"],
    2 => ["Preparacion de datos"],
    3 => ["Modelado"],
    4 => ["Evaluacion de modelos"],
    5 => ["Evaluacion de resultados"],
    6 => ["Implementacion o despliegue", "Implementacion", "Despliegue"],

    /* --- codigo: heladeria --- */
    7  => ['df.describe()', 'print(df.describe())'],
    8  => ['df.shape', 'print(df.shape)', 'print("Dimensiones:", df.shape)'],
    9  => ['promedios = df.groupby("Dia_Semana")["Gasto"].mean()',
           'df.groupby("Dia_Semana")["Gasto"].mean()',
           'df.groupby("Dia_Semana")["Gasto"].mean().sort_values()'],
    10 => ['promedios.idxmax()', 'df.groupby("Dia_Semana")["Gasto"].mean().idxmax()',
           'print(promedios.idxmax())'],
    11 => ['promedios.idxmin()', 'df.groupby("Dia_Semana")["Gasto"].mean().idxmin()',
           'print(promedios.idxmin())'],
    12 => ['df["Dia_Semana"].mode()', 'print(df["Dia_Semana"].mode())',
           'df["Dia_Semana"].value_counts().idxmax()'],

    /* --- codigo: automoviles --- */
    13 => ['df.replace("?", np.nan, inplace=True)', 'df = df.replace("?", np.nan)'],
    14 => ['df.isna().sum()', 'df.isnull().sum()', 'print(df.isna().sum())'],
    15 => ['df["caballos-fuerza"].astype("float").mean()',
           'df["caballos-fuerza"].astype(float).mean()'],
    16 => ['df["num-puertas"].value_counts()', 'print(df["num-puertas"].value_counts())'],
    17 => ['df.select_dtypes(include=["int64","float64"]).corr()',
           'df.select_dtypes(include=["number"]).corr()',
           'df.select_dtypes(include="number").corr()'],

    /* --- codigo: DATOS S4 --- */
    18 => ['fpr, tpr, thresholds = roc_curve(y_test, y_score)',
           'fpr, tpr, umbrales = roc_curve(y_test, y_score)',
           'roc_curve(y_test, y_score)'],
    19 => ['auc(fpr, tpr)', 'roc_auc_score(y_test, y_score)', 'print(auc(fpr, tpr))'],
    20 => ['accuracy_score(y_test, y_pred)',
           'accuracy_score(df["y_test"], df["y_pred"])'],
    21 => ['precision_score(y_test, y_pred)',
           'precision_score(df["y_test"], df["y_pred"])'],
    22 => ['recall_score(y_test, y_pred)',
           'recall_score(df["y_test"], df["y_pred"])'],
    23 => ['confusion_matrix(y_test, y_pred)',
           'confusion_matrix(df["y_test"], df["y_pred"])'],

    /* --- codigo: DATOS s5 --- */
    24 => ['print("Clase 1: ", sum(y_train==1))', 'print("Clase 1: ", sum(y_train == 1))',
           'sum(y_train==1)', 'y_train.value_counts()'],
    25 => ['KNeighborsClassifier(n_neighbors=7)',
           'knn = KNeighborsClassifier(n_neighbors=7)',
           'modelo = KNeighborsClassifier(n_neighbors=7)'],
    26 => ['LogisticRegression().fit(X_train, y_train)',
           'model = LogisticRegression().fit(X_train, y_train)',
           'modelo = LogisticRegression().fit(X_train, y_train)'],
    27 => ['model.coef_', 'modelo.coef_'],
    28 => ['model.intercept_', 'modelo.intercept_'],

    /* --- el montaje: imports y carga de datos --- */
    29 => ['import pandas as pd'],
    30 => ["df = pd.read_csv('heladeria.csv')", "df = pd.read_csv('heladeria.csv', sep=',')"],
    31 => ['df.head()', 'print(df.head())'],
    32 => ['import numpy as np'],
    33 => ["df = pd.read_csv('automoviles.csv')"],
    34 => ['from sklearn.metrics import roc_curve, auc'],
    35 => ['import matplotlib.pyplot as plt'],
    36 => ['plt.plot(fpr, tpr)', 'plt.plot(fpr, tpr, label="Clasificador 1")'],
    37 => ['from sklearn.metrics import accuracy_score, precision_score, recall_score, confusion_matrix',
           'from sklearn.metrics import accuracy_score, precision_score, recall_score',
           'from sklearn.metrics import accuracy_score,precision_score,recall_score,confusion_matrix'],
    38 => ['from sklearn.neighbors import KNeighborsClassifier'],
    39 => ['from sklearn.linear_model import LogisticRegression'],
    40 => ['print("Clase 0: ", sum(y_train==0))', 'print("Clase 0: ", sum(y_train == 0))',
           'sum(y_train==0)'],
];
$TEXTO = [1, 2, 3, 4, 5, 6];   // se comparan como texto: sin tildes ni mayusculas

$MULTIPLE = [

/* ============ Preguntas conceptuales sobre EDA y aprendizaje automatico ============ */

'm1' => [
    'texto'    => '&iquest;Qu&eacute; describe mejor el efecto de un alto sesgo en un modelo de IA en el contexto de machine learning?',
    'opciones' => [
        'a' => 'El modelo tiene un alto rendimiento en los datos de prueba, pero un bajo rendimiento en los de entrenamiento.',
        'b' => 'El modelo se ajusta muy bien a los datos de entrenamiento, pero tiene dificultades para generalizar a nuevos datos.',
        'c' => 'El modelo es muy sensible a peque&ntilde;as variaciones en los datos de entrenamiento, lo que afecta su capacidad para generalizar.',
        'd' => 'El modelo es muy sencillo, lo que puede causar un mal desempe&ntilde;o tanto en los datos de entrenamiento como en los de prueba.'
    ],
    'correcta' => 'd',
    'porque'   => 'Sesgo alto = <b>underfitting</b>: el modelo es demasiado simple y falla en las dos partes. La opcion de "se ajusta bien a entrenamiento pero no generaliza" es la trampa: eso es <b>varianza alta</b> (overfitting), no sesgo.'
],

'm2' => [
    'texto'    => '&iquest;Cu&aacute;l de las siguientes opciones describe mejor el sobreaprendizaje (overfitting) en un modelo de IA?',
    'opciones' => [
        'a' => 'El modelo es incapaz de detectar patrones en los datos de entrenamiento, lo que lo hace ineficaz en todas las situaciones.',
        'b' => 'El modelo no se ajusta adecuadamente a los datos de entrenamiento, resultando en un bajo rendimiento tanto en los datos de entrenamiento como en los de prueba.',
        'c' => 'El modelo se ajusta muy bien a los datos de entrenamiento, pero su desempe&ntilde;o disminuye considerablemente en los datos de prueba o datos nuevos.',
        'd' => 'El modelo logra un equilibrio entre un buen rendimiento en los datos de entrenamiento y una adecuada generalizaci&oacute;n a nuevos datos.'
    ],
    'correcta' => 'c',
    'porque'   => 'Es el espejo de la anterior: se aprende el ruido del entrenamiento. La opcion (b) es underfitting y la (d) es el modelo bien ajustado.'
],

'm3' => [
    'texto'    => '&iquest;Cu&aacute;l de las siguientes afirmaciones describe mejor el prop&oacute;sito de la normalizaci&oacute;n de datos?',
    'opciones' => [
        'a' => 'Ninguna de las opciones',
        'b' => 'Reducir la dimensionalidad de los datos.',
        'c' => 'Ajustar un modelo matem&aacute;tico a los datos.',
        'd' => 'Convertir los datos a una escala com&uacute;n sin distorsionar las diferencias en los rangos de valores'
    ],
    'correcta' => 'd',
    'porque'   => 'Reducir dimensionalidad es PCA, no normalizacion. Normalizar solo cambia la escala para que ninguna variable domine por sus unidades (clave en KNN y en modelos con regularizacion).'
],


/* ============ Heladeria ============ */

'm5' => [
    'texto'    => 'Al cargar el conjunto de datos podemos verificar que:',
    'opciones' => [
        'a' => '<code>El promedio del gasto es: 149.53<br>El valor m&aacute;ximo es: 264.68<br>El valor m&iacute;nimo es: 70.95<br>El total de registros es: 300</code>',
        'b' => '<code>El promedio del gasto es: 156.51<br>El valor m&aacute;ximo es: 188.06<br>El valor m&iacute;nimo es: 70.95<br>El total de registros es: 300</code>',
        'c' => '<code>El promedio del gasto es: 156.51<br>El valor m&aacute;ximo es: 264.68<br>El valor m&iacute;nimo es: 40.51<br>El total de registros es: 300</code>',
        'd' => '<code>El promedio del gasto es: 156.51<br>El valor m&aacute;ximo es: 264.68<br>El valor m&iacute;nimo es: 70.95<br>El total de registros es: 300</code>'
    ],
    'correcta' => 'd',
    'porque'   => 'Cada distractor cambia un solo numero: el promedio, el maximo o el minimo. El resumen estadistico y las dimensiones del dataframe te dan los cuatro datos de una (el codigo se pregunta al final de la tarjeta).'
],

'm6' => [
    'texto'    => 'De acuerdo a la informaci&oacute;n contenida en los datos, es correcto afirmar que:',
    'opciones' => [
        'a' => 'El d&iacute;a de la semana con mayor gasto promedio es el Lunes, con un promedio de 213.12',
        'b' => 'El d&iacute;a de la semana con mayor gasto promedio es el s&aacute;bado, con un promedio de 213.12',
        'c' => 'El d&iacute;a de la semana con mayor gasto promedio es el Domingo, con un promedio de 213.12',
        'd' => 'El d&iacute;a de la semana con mayor gasto promedio es el viernes, con un promedio de 138.40',
        'e' => 'Ninguna de las opciones es correcta'
    ],
    'correcta' => 'c',
    'porque'   => 'Se agrupa por dia, se promedia el gasto y se pide la <b>etiqueta</b> del maximo (no el valor). Confirma la sospecha del enunciado: el fin de semana se gasta mas.'
],

'm7' => [
    'texto'    => 'De acuerdo a la informaci&oacute;n contenida en los datos, es correcto afirmar que:',
    'opciones' => [
        'a' => 'El d&iacute;a de la semana con el m&iacute;nimo gasto promedio es el lunes, con un gasto promedio de 119.62',
        'b' => 'El d&iacute;a de la semana con el m&iacute;nimo gasto promedio es el mi&eacute;rcoles, con un gasto promedio de 134.52',
        'c' => 'El d&iacute;a de la semana con el m&iacute;nimo gasto promedio es el martes, con un gasto promedio de 119.62',
        'd' => 'El d&iacute;a de la semana con el m&iacute;nimo gasto promedio es el martes, con un gasto promedio de 127.64',
        'e' => 'Ninguna de las opciones es correcta'
    ],
    'correcta' => 'a',
    'porque'   => 'Mismo agrupamiento, pero pidiendo el minimo. Ojo: hay dos opciones con 119.62 y dos con "martes"; hay que acertar la pareja completa.'
],

'm8' => [
    'texto'    => 'En la variable <code>Dia_Semana</code>, la moda corresponde al d&iacute;a que m&aacute;s veces aparece en la muestra. Es correcto afirmar que:',
    'opciones' => [
        'a' => 'El d&iacute;a que ocurre con mayor frecuencia en el dataset, que es S&aacute;bado',
        'b' => 'El d&iacute;a que ocurre con mayor frecuencia en el dataset, que es Domingo',
        'c' => 'El d&iacute;a con la menor variabilidad en el gasto.',
        'd' => 'El d&iacute;a con el mayor gasto promedio.',
        'e' => 'El d&iacute;a que ocurre con mayor frecuencia en el dataset, que es Jueves'
    ],
    'correcta' => 'e',
    'porque'   => 'La moda de una categorica es el valor que <b>mas se repite</b>, y sale Jueves. Que el domingo sea el de mayor gasto promedio no lo hace la moda.'
],


/* ============ DATOS s2: automoviles ============ */

'm9' => [
    'texto'    => 'Identificar valores perdidos: Convertir "?" a NaN: para que pandas reconozca la existencia de valores perdidos que tienen el s&iacute;mbolo "?" dentro del dataframe, es necesario marcarlos como tal. Escribe el c&oacute;digo necesario para cumplir lo anterior. La variable con mayor cantidad de valores faltantes es:',
    'opciones' => [
        'a' => 'fabricante',
        'b' => 'Ninguna de las opciones',
        'c' => 'calibre',
        'd' => 'num-puertas',
        'e' => 'perdida-promedio-anual'
    ],
    'correcta' => 'e',
    'porque'   => 'Primero hay que marcar los "?" como NaN y despues contar los faltantes por columna. Sin ese reemplazo los "?" cuentan como texto valido y el conteo sale en cero.'
],

'm10' => [
    'texto'    => 'Las variables caballos-fuerza, pico-rpm, num-puertas tienen 2 valores faltantes cada una',
    'opciones' => ['a' => 'Verdadero', 'b' => 'Falso'],
    'correcta' => 'a',
    'porque'   => 'Se comprueba con el conteo de faltantes por columna, despues de haber marcado los "?" como NaN.'
],

'm11' => [
    'texto'    => 'Las variables carrera, calibre, precio tienen 3 valores faltantes cada una',
    'opciones' => ['a' => 'Verdadero', 'b' => 'Falso'],
    'correcta' => 'b',
    'porque'   => 'Mismo conteo de faltantes: los numeros no coinciden. Es la pregunta gemela de la anterior, cambiada para que no valga responder igual dos veces.'
],

'm12' => [
    'texto'    => 'Reemplazar por la media: Primero calcula la media de las variables "perdida-promedio-anual", "carrera", "calibre", "caballos-fuerza", y "pico-rpm". Luego reemplaza los valores NaN en esas variables por las medias que encontraste. La media de caballos-fuerza y pico-rpm son respectivamente:',
    'opciones' => [
        'a' => 'caballos-fuerza = 104.25, pico-rpm=5125.36',
        'b' => 'Ninguna de las opciones es correcta',
        'c' => 'caballos-fuerza = 184.25, pico-rpm=5135.36',
        'd' => 'caballos-fuerza = 120.25, pico-rpm=5225.36',
        'e' => 'caballos-fuerza = 104.25, pico-rpm=5225.36'
    ],
    'correcta' => 'a',
    'porque'   => 'Hay que <b>convertir la columna a float</b> antes de promediar: como traia "?", pandas la leyo como texto y el promedio ni siquiera corre. Fijate en las dos opciones con 104.25: solo cambia el rpm.'
],

'm13' => [
    'texto'    => 'Primero averigua los valores presentes en num-puertas y su respectiva frecuencia. Luego Reemplazar por la frecuencia mas alta los valores faltantes. Las frecuencias son:',
    'opciones' => [
        'a' => 'four= 112; two=98',
        'b' => 'four= 114; two=71',
        'c' => 'Ninguna de las opciones es correcta',
        'd' => 'four= 112; two=88',
        'e' => 'four= 114; two=89'
    ],
    'correcta' => 'e',
    'porque'   => 'Se cuentan las frecuencias de esa columna. Como <code>four</code> es lo mas frecuente, es tambien lo que se usa para rellenar sus faltantes (imputar por la moda).'
],

'm14' => [
    'texto'    => 'El fabricante m&aacute;s com&uacute;n, con su respectivo n&uacute;mero de veh&iacute;culos es:',
    'opciones' => [
        'a' => 'Nissan con 18 veh&iacute;culos',
        'b' => 'Nissan con 28 veh&iacute;culos',
        'c' => 'Toyota con 40 veh&iacute;culos',
        'd' => 'Mazda con 31 veh&iacute;culos',
        'e' => 'Toyota con 32 veh&iacute;culos',
        'f' => 'Mazda con 17 veh&iacute;culos'
    ],
    'correcta' => 'e',
    'porque'   => 'Mismo conteo de frecuencias, ahora sobre <code>fabricante</code>. Seis opciones y tres marcas repetidas: hay que acertar marca <b>y</b> cantidad.'
],

'm15' => [
    'texto'    => 'Selecciona &uacute;nicamente las variables num&eacute;ricas y calcula la matriz de correlaci&oacute;n. Podemos afirmar que: si queremos construir un modelo para predecir el precio del veh&iacute;culo, las variables longitud, peso vac&iacute;o y anchura presentan una alta colinealidad, evidenciada por coeficientes de correlaci&oacute;n superiores a 0.8 entre ellas. Debido a esta fuerte relaci&oacute;n, es posible prescindir de dos de estas variables sin perder informaci&oacute;n relevante, con el objetivo de simplificar el modelo y evitar problemas de multicolinealidad.',
    'opciones' => ['a' => 'Verdadero', 'b' => 'Falso'],
    'correcta' => 'a',
    'porque'   => 'Variables casi identicas aportan la misma informacion. Se ve en la matriz de correlacion calculada solo sobre las columnas numericas.'
],


/* ============ Metricas en contexto ============ */

'm16' => [
    'texto'    => '&iquest;Cu&aacute;l es el principal riesgo de usar &uacute;nicamente el RMSE como criterio de selecci&oacute;n en este caso?',
    'opciones' => [
        'a' => 'El RMSE no distingue entre errores sistem&aacute;ticos y errores aleatorios.',
        'b' => 'El RMSE no puede aplicarse a datos de series temporales.',
        'c' => 'El RMSE no captura la varianza de los errores.',
        'd' => 'El RMSE no se puede comparar entre modelos diferentes.'
    ],
    'correcta' => 'a',
    'porque'   => 'Un modelo que <b>siempre</b> se queda corto en hora punta genera desconfianza aunque su RMSE sea bajo: el numero no ve el sesgo.'
],

'm17' => [
    'texto'    => 'Si el objetivo es mejorar la satisfacci&oacute;n del usuario, &iquest;qu&eacute; m&eacute;trica o combinaci&oacute;n de m&eacute;tricas ser&iacute;a m&aacute;s adecuada?',
    'opciones' => [
        'a' => 'MAE, porque siempre penaliza m&aacute;s los errores peque&ntilde;os.',
        'b' => 'MAE y un an&aacute;lisis de sesgo medio (Mean Bias Error).',
        'c' => 'RMSE &uacute;nicamente.',
        'd' => 'R&sup2; para medir la varianza explicada.'
    ],
    'correcta' => 'b',
    'porque'   => 'El MAE se comunica en minutos ("nos equivocamos 3 minutos de media") y el sesgo medio dice si el error se va siempre hacia el mismo lado.'
],

'm18' => [
    'texto'    => '&iquest;Por qu&eacute; el Modelo X, a pesar de su alta exactitud, podr&iacute;a ser desastroso para el negocio?',
    'opciones' => [
        'a' => 'Porque la mayor&iacute;a de las transacciones son leg&iacute;timas, lo que hace que el Accuracy sea enga&ntilde;oso en datos desbalanceados.',
        'b' => 'Porque un Precision bajo invalida cualquier modelo de clasificaci&oacute;n.',
        'c' => 'Porque el Accuracy no se puede usar en problemas financieros.',
        'd' => 'Porque un alto Recall siempre es mejor que un alto Accuracy.'
    ],
    'correcta' => 'a',
    'porque'   => 'Diciendo "no hay fraude" siempre se acierta el 99% de las veces. Con Recall 35% se le escapan dos de cada tres fraudes, y eso es dinero perdido.'
],

'm19' => [
    'texto'    => 'Si el objetivo del banco es minimizar p&eacute;rdidas por fraude, &iquest;qu&eacute; m&eacute;trica deber&iacute;a priorizarse y por qu&eacute;?',
    'opciones' => [
        'a' => 'F1-Score, porque combina Precision y Recall en cualquier contexto',
        'b' => 'Precision, porque importa m&aacute;s no bloquear transacciones leg&iacute;timas',
        'c' => 'Accuracy, porque integra todos los errores',
        'd' => 'Recall, porque importa m&aacute;s detectar la mayor cantidad de fraudes posibles'
    ],
    'correcta' => 'd',
    'porque'   => 'Un falso positivo se arregla con una llamada de verificacion; un falso negativo es dinero que ya volo. Por eso pesa mas el recall.'
],

'm20' => [
    'texto'    => '&iquest;Qu&eacute; t&eacute;cnica de selecci&oacute;n de modelos lineales penaliza la magnitud de los coeficientes para prevenir el sobreajuste y puede llevar algunos coeficientes a ser exactamente cero?',
    'opciones' => [
        'a' => 'Logistic Regression',
        'b' => 'Lasso Regression',
        'c' => 'Ridge Regression',
        'd' => 'Ninguna de las opciones es correcta',
        'e' => 'Ordinary Least Squares (OLS)'
    ],
    'correcta' => 'b',
    'porque'   => 'Ridge tambien penaliza, pero solo <b>encoge</b> los coeficientes hacia cero sin llegar nunca. Llegar a cero exacto (y por tanto <b>seleccionar variables</b>) es lo propio de Lasso.'
],

'm40' => [
    'texto'    => '&iquest;Por qu&eacute; el MSE es una m&eacute;trica enga&ntilde;osa en este contexto?',
    'opciones' => [
        'a' => 'Porque el MSE no se puede calcular cuando hay valores at&iacute;picos, ya que estos deben eliminarse primero.',
        'b' => 'Porque el MSE solo es &uacute;til para problemas de clasificaci&oacute;n, no de regresi&oacute;n.',
        'c' => 'Porque el MSE mide el error absoluto, lo que hace insensible a la magnitud de los errores.',
        'd' => 'Porque el MSE penaliza los errores grandes de forma cuadr&aacute;tica, haciendo que unos pocos outliers (autos de lujo) dominen el valor, ocultando el buen desempe&ntilde;o en el segmento principal.'
    ],
    'correcta' => 'd',
    'porque'   => 'La respuesta correcta es que el MSE penaliza los errores grandes de forma cuadr&aacute;tica. En este caso, un error de $50,000 contribuye con 2.5 x 10<sup>9</sup> al MSE, mientras que un error de $2,000 aporta solo 4 x 10<sup>6</sup>. Por eso, unos pocos outliers pueden influir mucho en el MSE, enmascarando un buen rendimiento general.'
],

'm41' => [
    'texto'    => 'El equipo propone utilizar el <b>Error Absoluto Medio (MAE)</b> como m&eacute;trica alternativa. &iquest;Qu&eacute; ventaja ofrece el MAE frente al MSE para evaluar el modelo en este negocio?',
    'opciones' => [
        'a' => 'El MAE da un peso proporcional al error, sin magnificar los outliers, por lo que refleja mejor el error t&iacute;pico en el segmento de gama media.',
        'b' => 'El MAE es m&aacute;s sensible a outliers porque no eleva al cuadrado, lo que permite detectar mejor los errores grandes.',
        'c' => 'El MAE solo considera errores positivos, ignorando las subestimaciones.',
        'd' => 'El MAE siempre es menor que el MSE, por lo que har&aacute; que el modelo se vea mejor ante el director.'
    ],
    'correcta' => 'a',
    'porque'   => 'El MAE calcula el promedio de los errores absolutos, sin elevar al cuadrado. Esto significa que un error de $50,000 aporta $50,000 al promedio, mientras que en el MSE aporta 2.5 x 10<sup>9</sup>. Por eso, el MAE es m&aacute;s robusto frente a outliers y representa mejor el error t&iacute;pico en el segmento principal de gama media.'
],

'm21' => [
    'texto'    => '&iquest;Qu&eacute; m&eacute;trica se priorizar&iacute;a en un escenario donde los falsos negativos tienen un costo significativamente mayor que los falsos positivos, por ejemplo, en la detecci&oacute;n temprana de una enfermedad?',
    'opciones' => [
        'a' => 'Ninguna de las opciones es correcta, en ning&uacute;n escenario se presentar&aacute; tal situaci&oacute;n.',
        'b' => 'Recall (sensibilidad)',
        'c' => 'F1 score',
        'd' => 'Precisi&oacute;n (precision)',
        'e' => 'Exactitud (accuracy)'
    ],
    'correcta' => 'b',
    'porque'   => 'El recall mide cuantos enfermos reales detectas. Es la misma logica del caso del fraude: si el error caro es <b>no ver</b> el positivo, mandas el recall.'
],

'm22' => [
    'texto'    => 'Si un clasificador presenta una alta exactitud pero un bajo recall para la clase positiva, &iquest;qu&eacute; se puede inferir?',
    'opciones' => [
        'a' => 'El modelo tiene alta precisi&oacute;n en la clase positiva.',
        'b' => 'El modelo detecta correctamente casi todos los casos positivos',
        'c' => 'El modelo omite muchos casos positivos (alta tasa de falsos negativos).',
        'd' => 'El modelo presenta un buen equilibrio entre precisi&oacute;n y recall.'
    ],
    'correcta' => 'c',
    'porque'   => 'La exactitud alta viene de acertar la clase negativa, que es la mayoritaria. Bajo recall = se le escapan los positivos.'
],

'm23' => [
    'texto'    => '&iquest;Qu&eacute; forma tiene el t&eacute;rmino de penalizaci&oacute;n en la regresi&oacute;n Lasso?',
    'opciones' => [
        'a' => '<img src="img/lasso_a.png" alt="lambda por la suma de beta sub j" style="vertical-align:middle;height:34px">',
        'b' => '<img src="img/lasso_b.png" alt="lambda por la suma del valor absoluto de beta sub j" style="vertical-align:middle;height:34px">',
        'c' => 'Ninguna de las opciones es correcta',
        'd' => '<img src="img/lasso_d.png" alt="lambda por la suma de beta sub j al cuadrado" style="vertical-align:middle;height:34px">'
    ],
    'correcta' => 'b',
    'porque'   => 'La regresion Lasso usa la <b>norma L1</b>: penaliza la suma de los <b>valores absolutos</b> de los coeficientes. La de los cuadrados es la norma L2, que es Ridge; la suma sin valor absoluto no penalizaria nada, porque los signos se cancelan.'
],

'm24' => [
    'texto'    => 'Est&aacute;s ajustando un modelo de regresi&oacute;n lineal simple en Python. Despu&eacute;s de entrenarlo, obtienes un R&sup2; de 0.15 en el conjunto de prueba. &iquest;Qu&eacute; significa este valor?',
    'opciones' => [
        'a' => 'El modelo ha sobreajustado los datos de entrenamiento.',
        'b' => 'El modelo explica el 15% de la variabilidad en la variable de respuesta sobre los datos de prueba.',
        'c' => 'El modelo tiene un error de predicci&oacute;n del 85%',
        'd' => 'El modelo tiene un 15% de precisi&oacute;n en la clasificaci&oacute;n'
    ],
    'correcta' => 'b',
    'porque'   => 'R&sup2; es <b>varianza explicada</b>, no porcentaje de aciertos ni de error. Y 0.15 en test no dice por si solo que haya overfitting: para eso habria que comparar con el R&sup2; de entrenamiento.'
],

'm25' => [
    'texto'    => 'En un problema de clasificaci&oacute;n binaria, decides usar regresi&oacute;n log&iacute;stica. &iquest;Qu&eacute; salida produce el modelo y c&oacute;mo se interpreta?',
    'opciones' => [
        'a' => 'Produce una probabilidad de pertenecer a una clase, que se puede convertir en una etiqueta usando un umbral (por ejemplo, 0.5).',
        'b' => 'Calcula directamente la clase sin probabilidades asociadas.',
        'c' => 'Minimiza la suma de errores cuadrados como en la regresi&oacute;n lineal.',
        'd' => 'Genera valores continuos que representan la media de la respuesta.'
    ],
    'correcta' => 'a',
    'porque'   => 'Por eso existe <code>predict_proba()</code> ademas de <code>predict()</code>, y por eso mover el umbral cambia el equilibrio entre precision y recall.'
],

'm26' => [
    'texto'    => 'Si aplicas Lasso Regression con una penalizaci&oacute;n muy fuerte (&lambda; o alpha grande), &iquest;qu&eacute; esperas que ocurra con los coeficientes del modelo?',
    'opciones' => [
        'a' => 'Los coeficientes se mantienen iguales que en la regresi&oacute;n lineal sin regularizaci&oacute;n.',
        'b' => 'Algunos coeficientes se reducen exactamente a cero, eliminando variables del modelo.',
        'c' => 'El modelo solo selecciona variables categ&oacute;ricas.',
        'd' => 'Todos los coeficientes aumentan su magnitud para compensar la penalizaci&oacute;n.'
    ],
    'correcta' => 'b',
    'porque'   => 'Es la consecuencia practica de la norma L1: cuanto mas alpha, mas variables desaparecen. Lasso hace seleccion de variables por si solo.'
],


/* ============ KNN ============ */

'm27' => [
    'texto'    => '&iquest;C&oacute;mo se determina la clase o valor de una nueva instancia en el algoritmo KNN?',
    'opciones' => [
        'a' => 'Ninguna de las opciones es correcta',
        'b' => 'Se asigna la clase o valor de las instancia conocidas m&aacute;s cercana.',
        'c' => 'Se realiza una interpolaci&oacute;n lineal entre las instancias conocidas m&aacute;s cercanas.',
        'd' => 'Se descarta el valor de la instancia conocida m&aacute;s cercana.',
        'e' => 'Se vota o se promedian los valores de las instancias conocidas m&aacute;s cercanas.'
    ],
    'correcta' => 'e',
    'porque'   => 'Ojo con la trampa: "la mas cercana" (una sola) es el caso particular K=1. En general son <b>K</b> vecinos: se vota si es clasificacion, se promedia si es regresion.'
],

'm28' => [
    'texto'    => '&iquest;Cu&aacute;les son algunas desventajas del algoritmo KNN? <b>(Seleccione todas las que apliquen)</b>',
    'opciones' => [
        'a' => 'KNN no es sensible a la unidad de medida de los atributos, por lo que no es necesario normalizarlos.',
        'b' => 'KNN es propenso al sobreajuste (overfitting).',
        'c' => 'KNN es sensible a los valores at&iacute;picos.',
        'd' => 'KNN no sufre de la maldici&oacute;n de la dimensionalidad.',
        'e' => 'Ninguna de las opciones es correcta'
    ],
    'correctas' => ['b', 'c'],
    'porque'    => 'Son dos, y hay que marcar las dos. Las otras estan al reves: KNN <b>si</b> depende de la escala (por eso se normaliza) y <b>si</b> sufre la maldicion de la dimensionalidad.'
],

'm29' => [
    'texto'    => 'Un modelo KNN con K=1 es mas propenso al sobreaprendizaje que con K = 100.',
    'opciones' => ['a' => 'Verdadero', 'b' => 'Falso'],
    'correcta' => 'a',
    'porque'   => 'Con K=1 la frontera se pega a cada punto (y a cada dato ruidoso). Subir K suaviza: mas sesgo, menos varianza.'
],


/* ============ DATOS S4 ============ */

'm30' => [
    'texto'    => 'Usando los scores proporcionados graficar la curva ROC y seleccionar la opci&oacute;n correcta.',
    'opciones' => [
        'a' => 'Clasificador 1',
        'b' => 'Clasificador 4',
        'c' => 'Clasificador 3',
        'd' => 'Clasificador 2'
    ],
    'correcta' => 'a',
    'porque'   => 'Se calcula la curva ROC de cada clasificador y se compara el area bajo la curva: gana la que mas se despega de la diagonal.'
],

'm31' => [
    'texto'    => 'La m&eacute;trica Accuracy es:',
    'opciones' => [
        'a' => '80%', 'b' => '79%', 'c' => 'Ninguna de las opciones es correcta',
        'd' => '90%', 'e' => '89%'
    ],
    'correcta' => 'a',
    'porque'   => 'Exactitud = aciertos sobre el total. Cuidado con confundirla con la precision (89%), que es la respuesta de la pregunta siguiente.'
],

'm32' => [
    'texto'    => 'La m&eacute;trica Precision es:',
    'opciones' => [
        'a' => '79%', 'b' => '95%', 'c' => '89%',
        'd' => 'Ninguna de las opciones es correcta', 'e' => '60%'
    ],
    'correcta' => 'c',
    'porque'   => 'Precision: de los que predijo positivos, cuantos lo eran de verdad. Alta precision con recall bajo = es conservador al declarar positivos.'
],

'm33' => [
    'texto'    => 'La m&eacute;trica Recall es:',
    'opciones' => [
        'a' => '63%', 'b' => '69%', 'c' => 'Ninguna de las opciones es correcta',
        'd' => '93%', 'e' => '73%'
    ],
    'correcta' => 'a',
    'porque'   => 'Recall: de los positivos reales, cuantos encontro. 63% frente a 89% de precision confirma que se le escapan positivos.'
],

'm34' => [
    'texto'    => 'Verdadero o Falso - El n&uacute;mero de falsos negativos es mayor que el de falsos positivos.',
    'antes_opciones' => '<div style="margin: 12px 0 18px 0;"><img src="../../img/guia_499.png" alt="Matriz de confusi&oacute;n con falsos negativos" width="500"></div>',
    'opciones' => ['a' => 'Verdadero', 'b' => 'Falso'],
    'correcta' => 'a',
    'porque'   => 'Se lee en la matriz de confusion, y encaja con las metricas: recall bajo (63%) significa muchos FN, precision alta (89%) significa pocos FP.'
],

'm35' => [
    'texto'    => 'Verdadero o Falso - El clasificador identific&oacute; correctamente m&aacute;s de 85% de las instancias de la clase negativa.',
    'opciones' => ['a' => 'Verdadero', 'b' => 'Falso'],
    'correcta' => 'a',
    'porque'   => 'De la matriz: 156 de 166 negativas bien clasificadas, un 93%. Es la especificidad, y explica que la exactitud global se sostenga pese al recall bajo.'
],


/* ============ DATOS s5 ============ */

'm36' => [
    'texto'    => 'Verdadero o Falso - Los datos tienen igual proporci&oacute;n de registros (instancias) de cada clase. Son clases balanceadas.',
    'opciones' => ['a' => 'Verdadero', 'b' => 'Falso'],
    'correcta' => 'b',
    'porque'   => 'Se comprueba contando cuantos registros hay de cada clase en <code>y_train</code>. Estan desbalanceadas, y por eso la exactitud sola engania.'
],

'm37' => [
    'texto'    => 'Validando con el conjunto de prueba, y usando el accuracy como m&eacute;trica. El mejor valor de K - vecinos y su respectivo accuracy para el clasificador KNN es:',
    'opciones' => [
        'a' => 'K=3, con un accuracy= 90%',
        'b' => 'K=5, con un accuracy= 70%',
        'c' => 'K=3, con un accuracy= 92%',
        'd' => 'K=5, con un accuracy= 80%',
        'e' => 'K=7, con un accuracy= 95%'
    ],
    'correcta' => 'c',
    'porque'   => 'Se prueba K de 1 a 9 en un bucle guardando el mejor. Hay dos opciones con K=3: el numero que decide es el accuracy (92%, no 90%).'
],

'm38' => [
    'texto'    => 'Usando K=7, el n&uacute;mero de falsos positivos es:',
    'opciones' => ['a' => '8', 'b' => '5', 'c' => '10', 'd' => '20'],
    'correcta' => 'a',
    'porque'   => 'Se entrena el KNN con 7 vecinos y se lee la casilla de <b>falsos positivos</b> de la matriz de confusion (fila real negativa, columna predicha positiva).'
],

'm39' => [
    'texto'    => 'Usando un modelo de regresi&oacute;n log&iacute;stica, selecciona los par&aacute;metros del modelo que m&aacute;s se aproximen a su estimaci&oacute;n. No es necesario normalizar los datos:',
    'opciones' => [
        'a' => 'Coeficientes: 0.325, 1.433, Intercepto : 0.120',
        'b' => 'Coeficientes: -0.325, 1.433, Intercepto : -0.120',
        'c' => 'Coeficientes: -0.425, 0.433, Intercepto : -0.126',
        'd' => 'Coeficientes: -2.325, 3.433, Intercepto : -1.120',
        'e' => 'Coeficientes: -0.999, 1.667, Intercepto : 0.120'
    ],
    'correcta' => 'b',
    'porque'   => 'Los parametros se leen en los <b>atributos del modelo ya entrenado</b>. Fijate en los <b>signos</b>: la opcion con los mismos numeros en positivo es el distractor.'
],

];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('7 · Repaso parcial 1', 'las 39 preguntas unicas de los parciales anteriores');
?>

<div class="card">
  <h2>De donde sale esto</h2>
  <p>En la carpeta <code>parciales</code> habia <b>tres PDF</b>. Dos son el mismo archivo
     byte a byte (la copia <code>(1)</code>), y el tercero, el de <b>2025-2</b>, resulta ser
     <b>el mismo examen</b> que el de <b>2025-B</b>: las 39 preguntas coinciden una a una,
     solo cambia el orden de las opciones y en algunas hay un distractor extra
     (<code>Ninguna de las opciones</code>). Quedan <b>39 preguntas unicas</b>.</p>
  <p>Los enunciados y las opciones estan <b>tal cual salieron en el examen</b>. Cuando las
     dos versiones daban opciones distintas, aqui estan todas. Las respuestas correctas
     salen de la revision de 2025-2, que es la unica que trae la clave marcada.</p>
  <div class="nota"><b>Ojo:</b> los bloques de la heladeria, los automoviles y los DATOS S4
    y s5 se respondian ejecutando codigo sobre unos datasets que el profesor daba por
    enlace, y que no estan aqui. Las preguntas se conservan igual.</div>
</div>


<div class="card">
  <h2>Preguntas conceptuales sobre EDA y aprendizaje automatico</h2>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>

  <p><b>Pregunta 4.</b> Ordenar los pasos de la metodologia CRISP-DM:</p>
  <ol class="orden">
    <li><?php hueco(1, 30); ?></li>
    <li><?php hueco(2, 30); ?></li>
    <li><?php hueco(3, 30); ?></li>
    <li><?php hueco(4, 30); ?></li>
    <li><?php hueco(5, 30); ?></li>
    <li><?php hueco(6, 30); ?></li>
  </ol>
  <?php ayuda('Los seis nombres, desordenados: Modelado &middot; Evaluacion de resultados &middot; Comprension del negocio &middot; Implementacion o despliegue &middot; Preparacion de datos &middot; Evaluacion de modelos.'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Heladeria</h2>
  <p>Una heladeria quiere analizar el gasto promedio de los clientes en funcion del dia de
     la semana (variable categorica). Sospechan que los fines de semana los clientes gastan
     mas porque suelen ir en familia. Trabajaremos con el siguiente dataset:</p>
  <ul>
    <li><code>Dia_Semana</code> (Lunes a Domingo).</li>
    <li><code>Gasto</code> ($).</li>
  </ul>

   
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <h3>El codigo con el que se responde</h3>
  <p>Las cuatro preguntas de arriba salen de ejecutar codigo sobre el dataframe
     <code>df</code>. Escribelo de memoria:</p>

  <h4>Primero, el montaje</h4>
  <?php linea(29, 'importe la libreria necesaria para trabajar con <b>dataframes</b>, con su alias de siempre'); ?>
  <?php linea(30, 'cargue el archivo <code>heladeria.csv</code> en un dataframe llamado <code>df</code>', 'df = ...'); ?>
  <?php linea(31, 'muestre las primeras filas para comprobar que cargo bien', 'df...'); ?>

  <h4>Y ahora las respuestas</h4>
  <?php linea(7,  'obtenga el resumen estadistico de las columnas numericas: promedio, minimo, maximo y cuartiles, todo de una', 'df...'); ?>
  <?php linea(8,  'consulte cuantas filas y cuantas columnas tiene el dataframe', 'df...'); ?>
  <?php linea(9,  'calcule el gasto <b>promedio para cada dia de la semana</b> (gu&aacute;rdelo en <code>promedios</code> si quiere)', 'df...'); ?>
  <?php linea(10, 'sobre ese resultado, obtenga el <b>dia</b> (la etiqueta, no el valor) con el promedio mas alto', 'promedios...'); ?>
  <?php linea(11, 'y el <b>dia</b> con el promedio mas bajo', 'promedios...'); ?>
  <?php linea(12, 'obtenga la <b>moda</b> de <code>Dia_Semana</code>: el dia que mas veces se repite', 'df[...]'); ?>
  <?php ayuda('<code>.describe()</code> &middot; <code>.shape</code> &middot; <code>.groupby()</code> &middot; <code>.mean()</code> &middot; <code>.idxmax()</code> / <code>.idxmin()</code> &middot; <code>.mode()</code>'); ?>

  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>DATOS s2 — automoviles</h2>
  <p>Se trata de una coleccion de 205 registros de automoviles, el cual consta de variables
     que se clasifican en tres tipos de entidades: (a) la especificacion de un automovil en
     terminos de diversas caracteristicas, (b) su calificacion de riesgo de seguro asignada,
     (c) sus perdidas normalizadas en uso en comparacion con otros automoviles.</p>

  <?php mc('m9');  ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php mc('m14'); ?>
  <h3>El codigo con el que se responde</h3>
  <p>Este bloque es el tipico de limpieza: marcar faltantes, contarlos, imputar y mirar
     correlaciones.</p>

  <h4>Primero, el montaje</h4>
  <?php linea(32, 'importe la libreria necesaria para poder usar el valor <b>NaN</b>, con su alias de siempre'); ?>
  <?php linea(33, 'cargue <code>automoviles.csv</code> en <code>df</code>', 'df = ...'); ?>

  <h4>Y ahora las respuestas</h4>
  <?php linea(13, 'haga que pandas reconozca los <code>"?"</code> como valores perdidos (NaN), modificando <b>el mismo</b> dataframe', 'df...'); ?>
  <?php linea(14, 'cuente cuantos valores faltantes hay <b>en cada columna</b>', 'df...'); ?>
  <?php linea(15, 'calcule la media de <code>caballos-fuerza</code>, teniendo en cuenta que pandas leyo esa columna como texto', 'df["caballos-fuerza"]...'); ?>
  <?php linea(16, 'averigue que valores aparecen en <code>num-puertas</code> y con que frecuencia', 'df[...]'); ?>
  <?php linea(17, 'calcule la matriz de correlacion usando <b>unicamente</b> las variables numericas', 'df...'); ?>
  <?php ayuda('<code>np.nan</code> con <code>inplace=True</code> &middot; <code>.isna().sum()</code> &middot; <code>.astype("float")</code> &middot; <code>.value_counts()</code> &middot; <code>.select_dtypes(include=[...]).corr()</code>'); ?>

  <?php mc('m15'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Aprendizaje automatico — preguntas conceptuales</h2>
  <p><b>Buses.</b> Una empresa de transporte urbano quiere predecir el tiempo de llegada de
     autobuses en tiempo real. El objetivo principal es informar a los usuarios para que
     planifiquen mejor su viaje. Se desarrollan dos modelos:</p>
  <ul>
    <li><b>Modelo A:</b> RMSE = 3 minutos, pero con una tendencia a subestimar los tiempos
        en rutas con mucho trafico.</li>
    <li><b>Modelo B:</b> RMSE = 4 minutos, pero sus errores son mas equilibrados (a veces
        sobreestima, a veces subestima).</li>
  </ul>
  <p>El gerente de operaciones esta convencido de que el Modelo A es mejor, porque tiene un
     RMSE menor.</p>

  <?php mc('m16'); ?>
  <?php mc('m17'); ?>

  <p><b>Banco.</b> Un banco quiere implementar un modelo de IA para detectar transacciones
     fraudulentas con tarjetas de credito. Los ingenieros presentan dos modelos:</p>
  <ul>
    <li><b>Modelo X:</b> Accuracy = 99.5%, pero Recall (deteccion de fraudes) = 35%.</li>
    <li><b>Modelo Y:</b> Accuracy = 97%, Recall = 85%, Precision = 40%.</li>
  </ul>
  <p>El director financiero se inclina por el Modelo X porque "comete menos errores en general".</p>

  <?php mc('m18'); ?>
  <?php mc('m19'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>Caso de Estudio: Predicci&oacute;n de Precios de Veh&iacute;culos Usados</h2>
  <p>Una plataforma digital de compraventa de veh&iacute;culos usados, <b>AutoValue</b>, quiere implementar un modelo de machine learning para estimar el precio justo de un auto y as&iacute; ofrecer una recomendaci&oacute;n a vendedores y compradores. Su negocio principal se enfoca en veh&iacute;culos de gama media (entre $10,000 y $30,000), que representan el 90% de las transacciones. Sin embargo, en su base de datos tambi&eacute;n hay autos de lujo (precios superiores a $100,000) y autos muy antiguos de bajo valor (menos de $2,000). Estos casos extremos son pocos, pero generan errores de predicci&oacute;n muy grandes debido a su rareza y caracter&iacute;sticas at&iacute;picas.</p>

  <p>El equipo de ciencia de datos entrena un modelo de regresi&oacute;n y lo eval&uacute;a utilizando el <b>Error Cuadr&aacute;tico Medio (MSE)</b>. El resultado es un MSE de 50 millones, lo que lleva al director de producto a concluir que el modelo es in&uacute;til. Sin embargo, al analizar con m&aacute;s detalle, se descubre que el modelo predice muy bien los autos de gama media (error promedio de $2,000), pero falla estrepitosamente en los autos de lujo, donde el error puede superar los $50,000.</p>

  <?php mc('m40'); ?>
  <?php mc('m41'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>Regularizacion, regresion y clasificacion</h2>

  <?php mc('m20'); ?>
  <?php mc('m21'); ?>
  <?php mc('m22'); ?>
  <?php mc('m23'); ?>
  <?php mc('m24'); ?>
  <?php mc('m25'); ?>
  <?php mc('m26'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>KNN</h2>

  <?php mc('m27');  ?>
  <?php mcm('m28'); ?>
  <?php mc('m29');  ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>DATOS S4</h2>
  <p>En el archivo encontraras las etiquetas <code>y_test</code>, los scores
     <code>y_score</code> y la etiqueta predicha <code>y_pred</code> calculados usando un
     clasificador. Los encabezados del archivo son, en el mismo orden:
     <code>'y_test' 'y_score' 'y_pred'</code>.</p>

  <?php mc('m30'); ?>
  <?php mc('m31'); ?>
  <?php mc('m32'); ?>
  <?php mc('m33'); ?>
  <?php mc('m34'); ?>
  <h3>El codigo con el que se responde</h3>
  <p>Todo sale de <code>sklearn.metrics</code>, usando <code>y_test</code>,
     <code>y_score</code> (para la ROC) y <code>y_pred</code> (para las metricas).</p>

  <h4>Primero, el montaje</h4>
  <?php linea(34, 'importe lo necesario para poder <b>calcular la curva ROC</b> y el <b>area bajo ella</b>'); ?>
  <?php linea(37, 'importe lo necesario para calcular <b>exactitud, precision, recall</b> y la <b>matriz de confusion</b> (en ese orden, en una sola linea)'); ?>
  <?php linea(35, 'importe la libreria necesaria para <b>graficar</b>, con su alias de siempre'); ?>

  <h4>Y ahora las respuestas</h4>
  <?php linea(18, 'calcule los tres vectores de la curva ROC a partir de las etiquetas reales y los <b>scores</b>', 'fpr, tpr, ... = ...'); ?>
  <?php linea(19, 'calcule el <b>area bajo esa curva</b>'); ?>
  <?php linea(36, 'grafique la curva ROC: en el eje x va <code>fpr</code> y en el eje y <code>tpr</code>'); ?>
  <?php linea(20, 'calcule la <b>exactitud</b> (accuracy), comparando las etiquetas reales con las predichas'); ?>
  <?php linea(21, 'calcule la <b>precision</b>'); ?>
  <?php linea(22, 'calcule el <b>recall</b>'); ?>
  <?php linea(23, 'calcule la <b>matriz de confusion</b> (de ahi salen los FP y los FN)'); ?>
  <?php ayuda('El orden de los argumentos es siempre <b>(reales, predichas)</b>. La ROC es la excepcion: usa los <b>scores</b>, no las etiquetas predichas.'); ?>

  <?php mc('m35'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>DATOS s5</h2>
  <p>El archivo contiene dos conjuntos de datos: <code>train</code> y <code>test</code>.
     Debe entrenar un clasificador KNN y un modelo de regresion logistica para responder
     las siguientes preguntas.</p>

  <?php mc('m36'); ?>
  <p style="margin:16px 0 6px 18px">Escribe el codigo con el que se responde: contar e <b>imprimir</b>
     cuantos registros hay de cada clase en <code>y_train</code>. Son dos lineas.</p>
  <?php linea(24, 'imprima, con la etiqueta <code>"Clase 1: "</code> delante, cuantos registros hay de la clase <b>1</b>', 'print(...)'); ?>
  <?php linea(40, 'y lo mismo con la etiqueta <code>"Clase 0: "</code> para la clase <b>0</b>', 'print(...)'); ?>
  <?php ayuda('Comparar toda la serie contra un valor (<code>y_train==1</code>) da True/False; y sumar booleanos en Python cuenta cuantos True hay.'); ?>

  <?php mc('m37'); ?>
  <?php mc('m38'); ?>
  <h3>El codigo con el que se responde</h3>

  <h4>Primero, el montaje</h4>
  <?php linea(38, 'importe lo necesario para usar el <b>clasificador KNN</b>'); ?>
  <?php linea(39, 'importe lo necesario para usar la <b>regresion logistica</b>'); ?>

  <h4>Y ahora las respuestas</h4>
  <?php linea(25, 'cree el clasificador KNN configurado con <b>k=7</b>'); ?>
  <?php linea(26, 'entrene un modelo de regresion logistica con el conjunto de entrenamiento'); ?>
  <p>Y los parametros estimados se leen en dos atributos del modelo entrenado
     (<code>model</code>): los coeficientes en <?php hueco(27, 16); ?>
     y el intercepto en <?php hueco(28, 18); ?>.</p>
  <?php ayuda('Los atributos que sklearn crea <b>despues</b> de entrenar terminan en guion bajo: <code>_</code>.'); ?>

  <?php mc('m39'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Regresion/index.php', '');
