<?php
/* ==========================================================================
   APO / Examenes2  —  Test de practica con las preguntas de los parciales 2
   Fuentes (sin preguntas repetidas):
     - parcial2APO.pdf y parcial_2_revision.pdf  (mismo examen, 29-abr-2026, 38 preguntas)
     - Parcial2_IA.pdf  (Examen parcial 2 - 2025-1, 32 preguntas; aqui solo las 12 que no
       estan en el examen de 2026)
   Modo test: se responde todo, se envia, y solo se dice si cada una esta bien o mal.
   NO se muestra cual es la respuesta correcta.
   Texto copiado tal cual de los PDF. Donde la impresion corto el enunciado
   por el borde derecho se marca con […].
   ========================================================================== */

$INFO_KMEANS = 'Responde las siguientes preguntas usando los datos que encontrarás en <b>data_examen/k_means/data1.data</b>';
$INFO_FEAT   = 'Responder las siguientes preguntas en relación al proceso de selección de características. Para la parte práctica usar los datos disponibles en: <b>data_examen/feat_sel/datos_FEAT_SEL.data</b>';

/* cada pregunta: 'txt' enunciado, 'op' opciones (en el orden del PDF), 'ok' clave correcta,
   'pt' puntos en el parcial, 'src' de donde sale, 'info' (opcional) bloque Informacion antes */
$P = [
/* ======================= Parcial 2 — 2026 (parcial2APO / parcial_2_revision) ======================= */
[ 'src'=>'2026 · P1', 'pt'=>1,
  'txt'=>'Un árbol profundo alcanza 100% de accuracy en entrenamiento, pero tiene una pobre capacidad de generalización.<br><b>¿Qué técnica directamente mitiga este problema?</b>',
  'op'=>['a'=>'Usar un algoritmo de boosting.','b'=>'Eliminar variables irrelevantes antes de entrenar.','c'=>'Pruning (poda) posterior al entrenamiento.','d'=>'Aumentar la profundidad máxima ( <code>max_depth</code> ).'],
  'ok'=>'c' ],
[ 'src'=>'2026 · P2', 'pt'=>1,
  'txt'=>'Tienes un modelo de regresión lineal simple para predecir precios de casas. Observas que el RMSE en los datos de entrenamiento es bajo, pero en los de prueba es mucho mayor.<br><b>¿Qué estrategia es más adecuada para mejorar el desempeño en los datos de prueba?</b>',
  'op'=>['a'=>'Aumentar la complejidad del modelo agregando más términos polinomiales.','b'=>'Aplicar regularización (Ridge o Lasso).','c'=>'Eliminar outliers únicamente del conjunto de prueba.','d'=>'Disminuir la cantidad de datos de entrenamiento.'],
  'ok'=>'b' ],
[ 'src'=>'2026 · P3', 'pt'=>1,
  'txt'=>'¿Cuál de los siguientes métodos de ensamble combina múltiples modelos mediante el entrenamiento de un "meta-modelo" que toma las predicciones individuales como características de entrada?',
  'op'=>['a'=>'Ninguno de las opciones es correcta','b'=>'Bagging','c'=>'Boosting','d'=>'Stacking'],
  'ok'=>'d' ],
[ 'src'=>'2026 · P4', 'pt'=>1,
  'txt'=>'Se realiza clustering con K-Means en datos de clientes. Se sospecha que el algoritmo converge en un óptimo local.<br><b>¿Qué estrategia ayuda a mitigar este problema?</b>',
  'op'=>['a'=>'Usar múltiples inicializaciones y escoger la mejor.','b'=>'Cambiar el método de distancia a Manhattan.','c'=>'Normalizar los datos antes de aplicar K-Means.','d'=>'Aumentar el número de clústers (K).'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P5', 'pt'=>1,
  'txt'=>'En un análisis de reducción de dimensionalidad usando PCA, un investigador retiene 95% de la varianza explicada.<br><b>¿Cuál es una posible desventaja de esta decisión?</b>',
  'op'=>['a'=>'Se pierde interpretabilidad respecto a las variables originales.','b'=>'Se incrementa el riesgo de overfitting.','c'=>'Se aumenta la redundancia entre componentes principales.','d'=>'Se maximiza la multicolinealidad en los datos reducidos.'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P6', 'pt'=>1,
  'txt'=>'Tras aplicar PCA a un dataset de 50 features, los primeros 5 componentes explican el 90% de varianza.<br><b>¿Qué implica esto?</b>',
  'op'=>['a'=>'El dataset puede reducirse a cinco dimensiones (5D) sin pérdida crítica de información.','b'=>'Debe usarse K-Means en lugar de PCA.','c'=>'Las 45 features restantes son irrelevantes.','d'=>'PCA no es adecuado para este dataset.'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P7', 'pt'=>1,
  'txt'=>'Entrenas una SVM con kernel RBF y notas que al incrementar <code>C</code> obtienes 100% de precisión en entrenamiento pero bajo desempeño en validación.<br><b>¿Qué sugiere este comportamiento?</b>',
  'op'=>['a'=>'Sobreajuste (overfitting).','b'=>'<code>gamma</code> debe aumentarse.','c'=>'Subajuste (underfitting).','d'=>'La necesidad de usar un kernel lineal.'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P8', 'pt'=>1,
  'txt'=>'Trabajas con un conjunto de datos no linealmente separable. Se discuten dos opciones: usar SVM con kernel polinomial grado 2 o kernel RBF.<br><b>¿Cuál diferencia principal debería guiar tu elección?</b>',
  'op'=>['a'=>'Kernel RBF sólo sirve para datos linealmente separables.','b'=>'Kernel polinomial siempre tiene menor complejidad computacional.','c'=>'Kernel polinomial no requiere ajuste de hiperparámetros.','d'=>'RBF generaliza mejor en alta dimensionalidad.'],
  'ok'=>'d' ],
[ 'src'=>'2026 · P9', 'pt'=>1,
  'txt'=>'Al aplicar KNN a un dataset con características de un grupo de participantes, se tienen escalas diferentes (ej.: edad [0–100] vs. ingreso mensual [0 – 5 Millones]).<br><b>¿Qué paso es crítico antes de entrenar?</b>',
  'op'=>['a'=>'Seleccionar k óptimo con GridSearchCV.','b'=>'Convertir todas las variables a categóricas.','c'=>'Normalizar las características (ej.: StandardScaler).','d'=>'Aplicar one-hot encoding.'],
  'ok'=>'c' ],

[ 'src'=>'2026 · P10', 'pt'=>2, 'info'=>$INFO_KMEANS,
  'txt'=>'Utiliza el método del "codo" para determinar el número óptimo de clusters a usar en el algoritmo de K-means. Cuantos centroides deberías usar?',
  'op'=>['a'=>'6','b'=>'2','c'=>'5','d'=>'4'],
  'ok'=>'c' ],
[ 'src'=>'2026 · P11', 'pt'=>2,
  'txt'=>'Después de aplicar PCA, observa que las dos primeras componentes principales explican más del 60% de la varianza total de los datos. Esto significa que:',
  'op'=>['a'=>'La técnica no es adecuada para este conjunto de datos','b'=>'Las dos primeras componentes principales son irrelevantes para el análisis','c'=>'La afirmación no es correcta, siempre se requieren más de 4 componentes para lograr por lo menos 60% de la varianza acumulada','d'=>'Necesitas más componentes principales para reducir adecuadamente los datos','e'=>'Las dos primeras componentes principales capturan la mayor parte de la información contenida en las 4 variables originales'],
  'ok'=>'e' ],
[ 'src'=>'2026 · P12', 'pt'=>2,
  'txt'=>'Después de aplicar PCA, y usando solamente las dos primeras componentes para visualizar los datos en 2-D. Puede afirmar que:',
  'op'=>['a'=>'El algoritmo de K-Means no realiza un agrupamiento adecuado','b'=>'Se requiere una tercer componente para visualizar los centroides','c'=>'Ninguna de las opciones es correcta','d'=>'Los clusters no se visualizan de forma adecuada'],
  'ok'=>'c' ],

[ 'src'=>'2026 · P13', 'pt'=>2, 'info'=>$INFO_FEAT,
  'txt'=>'FALSO o VERDADERO: La base de datos está balanceada',
  'op'=>['v'=>'Verdadero','f'=>'Falso'],
  'ok'=>'f' ],
[ 'src'=>'2026 · P14', 'pt'=>2,
  'txt'=>'El número de variables, sin incluir la variable objetivo, es:',
  'op'=>['a'=>'Ninguna de las opciones es correcta','b'=>'1295','c'=>'1296','d'=>'1290'],
  'ok'=>'b' ],
[ 'src'=>'2026 · P15', 'pt'=>1,
  'txt'=>'Separar la columna "TARGET" y eliminar dicha columna del dataframe original. Aplicar one-hot-ecoding a la base de datos. El nuevo número de variables es:',
  'op'=>['a'=>'1414','b'=>'1461','c'=>'1462','d'=>'1415'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P16', 'pt'=>3,
  'txt'=>'Calcular la matriz de correlación. Esta matriz mide la correlación entre todos los pares de variables. Debes eliminar una de las variables (de cada par evaluado) cuando el valor absoluto de la correlación supere 0.9. El número de variables resultantes es:',
  'op'=>['a'=>'878','b'=>'521','c'=>'890','d'=>'850'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P17', 'pt'=>2,
  'txt'=>'Suponga que los datos se alojan en <b>X</b> y la variable objetivo en <b>y</b>. Debe calcular: <b>matriz de confusión</b>, <b>precision</b>, <b>recall</b>, y <b>AUC (Área bajo la curva ROC).</b> Use la siguiente configuración:'
        .'<pre>X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=42, stratify=y)'."\n\n"
        .'rf_classifier = RandomForestClassifier(random_state=42)'."\n\n"
        .'xgb_classifier = XGBClassifier(use_label_encoder=False, eval_metric=\'logloss\', random_state=42)</pre>'
        .'Para los dos clasificadores, el <b>Área bajo la curva ROC</b> es:',
  'op'=>['a'=>'Random forest: 0.72, XGBoost: 0.74','b'=>'Random forest: 0.74, XGBoost: 0.76','c'=>'Random forest: 0.70, XGBoost: 0.80','d'=>'Random forest: 0.74, XGBoost: 0.72'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P18', 'pt'=>2,
  'txt'=>'Es correcto afirmar que: El clasificador Random Forest no está prediciendo correctamente ninguna instancia positiva',
  'op'=>['v'=>'Verdadero','f'=>'Falso'],
  'ok'=>'v' ],
[ 'src'=>'2026 · P19', 'pt'=>2,
  'txt'=>'Es correcto afirmar que: El clasificador XGBoost predice correctamente 225 instancias positivas',
  'op'=>['v'=>'Verdadero','f'=>'Falso'],
  'ok'=>'f' ],
[ 'src'=>'2026 · P20', 'pt'=>3,
  'txt'=>'Realiza un ultimo experimento. Entrena de nuevo los clasificadores, pero en esta ocasión no eliminar ninguna característica después de hacer one-hot enconding.<br>FALSO o VERDADERO: Si no realiza selección de características el rendimiento de los modelos es mucho mejor comparando todas las métricas, pues al eliminar variables se pierde información valiosa',
  'op'=>['v'=>'Verdadero','f'=>'Falso'],
  'ok'=>'f' ],

[ 'src'=>'2026 · P21', 'pt'=>1,
  'txt'=>'Un modelo KNN (k-Vecinos más Cercanos) se entrena con los siguientes 5 puntos de datos en un espacio 2D, donde \'X1\' y \'X2\' son las características y \'Clase\' es la etiqueta:'
        .'<pre>Punto 1: (X1=2, X2=3), Clase A'."\n".'Punto 2: (X1=4, X2=5), Clase B'."\n".'Punto 3: (X1=1, X2=6), Clase A'."\n".'Punto 4: (X1=8, X2=1), Clase B'."\n".'Punto 5: (X1=3, X2=4), Clase A</pre>'
        .'Si se introduce un nuevo punto de datos en (X1=3, X2=5) y se utiliza k=3,<br>¿a qué clase se asignaría el nuevo punto utilizando la distancia Euclidiana?',
  'op'=>['a'=>'Se asignaría a ambas clases.','b'=>'Clase A','c'=>'No se puede determinar. Falta información','d'=>'Clase B'],
  'ok'=>'b' ],
[ 'src'=>'2026 · P22', 'pt'=>1,
  'txt'=>'Un modelo de regresión predice los precios de las casas. Si para una casa con un precio real de $300,000, el modelo predice $330,000, ¿cuál es el Error Absoluto Porcentual Medio (MAPE) solo para esta predicción?<br>MAPE se define como:'
        .'<pre>         100%    n  | yᵢ − ŷᵢ |'."\n".'MAPE = ─────── · Σ  | ─────── |'."\n".'           n    i=1 |   yᵢ    |</pre>',
  'op'=>['a'=>'-10%','b'=>'10%','c'=>'9.09%','d'=>'30,000'],
  'ok'=>'b' ],
[ 'src'=>'2026 · P23', 'pt'=>1,
  'txt'=>'En un Árbol de Decisión para clasificación, si un nodo tiene una distribución de clases de [10, 10]<br>(10 muestras de la Clase A y 10 de la Clase B),<br>¿cuál sería su impureza Gini?',
  'op'=>['a'=>'0','b'=>'1.0','c'=>'0.25','d'=>'0.5'],
  'ok'=>'d' ],
[ 'src'=>'2026 · P24', 'pt'=>1,
  'txt'=>'¿Cuál de las siguientes afirmaciones describe mejor la principal ventaja de un modelo de Bosque Aleatorio (Random Forest) sobre un único Árbol de Decisión?',
  'op'=>['a'=>'Reducen el sobreajuste (overfitting) mediante el promedio de múltiples árboles.','b'=>'Siempre tienen un mejor rendimiento con datos linealmente separables','c'=>'Son más fáciles de interpretar.','d'=>'Requieren menos hiperparámetros para ajustar.'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P25', 'pt'=>1,
  'txt'=>'En el contexto de los modelos de ensamble, ¿cuál es la diferencia fundamental entre Bagging (como en Random Forest) y Boosting (como en AdaBoost)?',
  'op'=>['a'=>'Bagging solo se puede usar con árboles de decisión, mientras que Boosting se puede usar con cualquier modelo.','b'=>'Boosting se enfoca en los errores del modelo anterior para entrenar el siguiente, mientras que Bagging no.','c'=>'Bagging entrena modelos secuencialmente, mientras que Boosting los entrena en paralelo.','d'=>'Boosting es menos propenso al sobreajuste que Bagging.'],
  'ok'=>'b' ],
[ 'src'=>'2026 · P26', 'pt'=>1,
  'txt'=>'Una Máquina de Soporte Vectorial (SVM) busca encontrar el hiperplano que mejor separa las clases. ¿Qué define este \'mejor\' hiperplano?',
  'op'=>['a'=>'El hiperplano que pasa por la mayor cantidad de puntos de datos.','b'=>'El hiperplano que minimiza el número de vectores de soporte.','c'=>'El hiperplano que es equidistante de los centroides de cada clase.','d'=>'El hiperplano que tiene el margen máximo entre las clases.'],
  'ok'=>'d' ],
[ 'src'=>'2026 · P27', 'pt'=>1,
  'txt'=>'Se ejecuta el algoritmo K-Means en un conjunto de datos con k=2. Después de la primera iteración, los centroides están en C1=(2,2) y C2=(8,5). Se presenta un nuevo punto P=(3,3). ¿A qué clúster se asignaría P y cuál sería la nueva ubicación del centroide de ese clúster si P fuera el único punto asignado en una nueva iteración?',
  'op'=>['a'=>'Se asigna a C1; el nuevo centroide sería (2.5, 2.5).','b'=>'Se asigna a C1; el nuevo centroide permanecería en (2, 2).','c'=>'Se asigna a C2; el nuevo centroide sería (3, 3).','d'=>'Se asigna a C2; el nuevo centroide sería (5.5, 4.0).'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P28', 'pt'=>1,
  'txt'=>'En un Análisis de Componentes Principales (PCA), si los dos primeros componentes principales explican el 95% de la varianza total de los datos originales (que tenían 10 características), ¿qué significa esto?',
  'op'=>['a'=>'Se han eliminado 8 características de forma permanente.','b'=>'Los datos originales son linealmente separables en 2D.','c'=>'El conjunto de datos puede ser representado con alta fidelidad en un espacio 2D, perdiendo solo un 5% de la información de varianza.','d'=>'El 5% restante de la varianza contiene ruido y debe ser ignorado.'],
  'ok'=>'c' ],
[ 'src'=>'2026 · P29', 'pt'=>1,
  'txt'=>'¿Cuál es el propósito principal de utilizar la Validación Cruzada (Cross-Validation) en el entrenamiento de modelos de Machine Learning?',
  'op'=>['a'=>'Para seleccionar las mejores características para el modelo.','b'=>'Para entrenar el modelo más rápidamente utilizando menos datos.','c'=>'Para aumentar la cantidad de datos de entrenamiento disponibles.','d'=>'Para obtener una estimación más robusta y fiable del rendimiento del modelo en datos no vistos.'],
  'ok'=>'d' ],
[ 'src'=>'2026 · P30', 'pt'=>1,
  'txt'=>'Se aplica el algoritmo DBSCAN a un conjunto de datos espacial bidimensional que contiene dos áreas de muy alta densidad separadas por una zona extensa con puntos muy dispersos (ruido). Si incrementamos gradualmente el valor del parámetro \'eps\' manteniendo \'min_samples\' constante en un valor de 5, ¿qué secuencia de eventos espaciales es la que describe correctamente el comportamiento del algoritmo?',
  'op'=>['a'=>'La cantidad de puntos clasificados como ruido aumentará, ya que los clústeres de alta densidad se fragmentarán en múltiples micro-clústeres debido a la superposición espacial.','b'=>'El modelo ignorará las zonas de alta densidad, ya que DBSCAN asume que la densidad debe ser paramétrica y estrictamente variable en el espacio.','c'=>'El número de clústeres se multiplicará exponencialmente, debido a que DBSCAN forzará a que cada punto de la zona dispersa actúe como un centroide K-means independiente.','d'=>'La cantidad de puntos clasificados como ruido disminuirá; los clústeres originales crecerán incorporando puntos limítrofes y, eventualmente, si \'eps\' es lo suficientemente grande, se fusionarán en un único gran clúster.'],
  'ok'=>'d' ],
[ 'src'=>'2026 · P31', 'pt'=>1,
  'txt'=>'Supón que estás entrenando un ensamblado de árboles para clasificar biopsias tumorales. El dataset tiene 30 características, pero una de ellas (\'tama[…] tiene un poder predictivo abrumadoramente superior al resto. Si entrenas un modelo Bagging y un Random Forest estándar con los mismos datos, ¿cuá[…] principal diferencia estructural entre ambos modelos?',
  'op'=>['a'=>'En el modelo Bagging, casi todos los árboles utilizarán \'tamaño_tumor\' en su primer corte, resultando en árboles altamente correlacionados. Random Forest forzará variedad limitando el subconjunto de características disponible en cada nodo.','b'=>'Random Forest ignorará automáticamente la característica \'tamaño_tumor\' por considerarla un sesgo (bias), obteniendo un peor desempeño inicial pero mejor precisión a largo plazo.','c'=>'Bagging logrará un menor sesgo que Random Forest, ya que Bagging aplica una técnica de penalización similar a la regularización Lasso sobre los árboles base.','d'=>'Ambos modelos producirán la misma estructura exacta de árboles, puesto que ambos utilizan la técnica Bootstrap para el muestreo de datos.'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P32', 'pt'=>1,
  'txt'=>'Entrenas un modelo SVM con kernel RBF (Gaussiano) y notas que logra una precisión del 100% en el conjunto de entrenamiento, pero su desempeño ca[…] a 55% en validación (sobreajuste severo). Al visualizar la frontera de decisión en 2D, notas que esta envuelve estrechamente a cada punto de entrenam[…] individual como pequeñas \'islas\'. Según la formulación del kernel RBF, ¿qué ajuste de hiperparámetros es la estrategia directa más lógica para solucion[…] problema geométrico?',
  'op'=>['a'=>'Cambiar la métrica del kernel RBF a distancia de Manhattan, lo que forzará a las islas a transformarse en un único hiperplano lineal.','b'=>'Disminuir el valor de γ (gamma), lo que ampliará el campo de influencia (similaridad) de cada vector de soporte, generando una frontera de decisión mucho más suave y global.','c'=>'Aumentar el valor de γ (gamma), para que la influencia del vector de soporte sea matemáticamente infinita y abarque todo el plano.','d'=>'Aumentar exponencialmente el parámetro de penalización C, para forzar al modelo a clasificar correctamente todos los puntos del conjunto de prueba.'],
  'ok'=>'b' ],
[ 'src'=>'2026 · P33', 'pt'=>1,
  'txt'=>'Al aplicar Análisis de Componentes Principales (PCA) a un conjunto de datos estandarizado en 2 dimensiones (X1, X2), se descubre que ambas variable[…] correlación de Pearson extremadamente alta y positiva (+0.95). El algoritmo extrae el primer vector propio v1. Matemáticamente y geométricamente, ¿c[…] sobre el segundo vector propio v2 es forzosamente correcta?',
  'op'=>['a'=>'v2 será paralelo a v1 pero con un sentido opuesto, y su autovalor λ2 será idéntico a λ1, distribuyendo la varianza equitativamente entre ambos.','b'=>'Es imposible calcular v2 en este escenario, ya que una correlación de +0.95 vuelve a la matriz de covarianza algebraicamente no invertible','c'=>'v2 será estrictamente ortogonal (perpendicular) a v1 en el espacio original, y su autovalor asociado λ2 será significativamente cercano a 0, ya que captura casi exclusivamente el ruido residual.','d'=>'v2 representará el eje original X2 sin ninguna rotación, ya que PCA siempre preserva el eje que contenga el mayor valor atípico (outlier).'],
  'ok'=>'c' ],
[ 'src'=>'2026 · P34', 'pt'=>1,
  'txt'=>'En el contexto de Selección de Características, consideremos dos enfoques aplicados a un dataset de 500 variables predictoras: Regularización Lasso ([…] Eliminación Recursiva de Características (RFE) respaldada por un SVM lineal. Conceptualmente, ¿cuál es la distinción algorítmica fundamental entre có[…] estos dos métodos?',
  'op'=>['a'=>'Lasso opera utilizando cálculos univariados de la teoría de la información (como la entropía), mientras que RFE explora el espacio de datos evaluando la impureza Gini multivariada.','b'=>'Lasso y RFE operan de manera idéntica en el espacio del algoritmo, siendo la única diferencia que RFE solo puede procesar características continuas, mientras que Lasso procesa categóricas.','c'=>'Lasso es un método Filter que no requiere un modelo de Machine Learning, ya que se basa únicamente en la matriz de correlación de Pearson, a diferencia de RFE.','d'=>'Lasso es un método Embedded que ajusta los coeficientes y simultáneamente penaliza algunos llevándolos a cero en un único entrenamiento. RFE es un método Wrapper que requiere entrenar el modelo repetidas veces, podando en cada ciclo las características con coeficientes menores.'],
  'ok'=>'d' ],
[ 'src'=>'2026 · P35', 'pt'=>1,
  'txt'=>'En el contexto matemático de las Máquinas de Soporte Vectorial (SVM), la frontera de decisión para un problema altamente no lineal requeriría un map[…] proyección (ϕ(x)) hacia un espacio dimensional masivo o incluso infinito, volviendo el procesamiento incalculable debido a la \'maldición de la dimensi[…] propiedad analítica del \'Truco del Kernel\' (Kernel Trick) resuelve computacionalmente este obstáculo analítico?',
  'op'=>['a'=>'Elimina los vectores de soporte redundantes y reduce el espacio utilizando una función Autoencoder, calculando los pesos antes de requerir la función de pérdida del hiperplano.','b'=>'Cambia la formulación de una penalización tipo norma L2 a norma L1, generando un modelo disperso donde el hiperplano transformado se simplifica a la ecuación de una línea recta interceptante nula.','c'=>'Aplica una operación algorítmica de Descomposición en Valores Singulares (SVD) sobre las variables atípicas antes del mapeo, cortando el árbol de expansión de Taylor en el grado 2 y descartando las infinitas dimensiones superiores.','d'=>'Demuestra que la formulación dual de la SVM depende estrictamente del producto interno entre pares de puntos en el espacio transformado (ϕ(xi)·ϕ(xj)). Esto permite sustituirlo por una función Kernel equivalente que se calcula directamente en el espacio original de baja dimensión.'],
  'ok'=>'d' ],
[ 'src'=>'2026 · P36', 'pt'=>1,
  'txt'=>'Un científico de datos aplica DBSCAN a un conjunto de datos que contiene dos clusters: uno muy denso y otro disperso, separados por una región de baja densidad. Ajusta <code>eps=0.3</code> y <code>min_samples=5</code> . Observa que el cluster denso se detecta correctamente, pero el cluster disperso se fragmenta en varios grupos pequeños y muchos puntos se marcan como ruido. ¿Qué modificación debería probar <b>principalmente</b> para mejorar la detección del cluster disperso sin perder el cluster denso?',
  'op'=>['a'=>'Aumentar <code>eps</code> a 0.6 y posiblemente reducir <code>min_samples</code> .','b'=>'Aumentar <code>min_samples</code> a 10.','c'=>'Cambiar a clustering jerárquico con enlace <code>complete</code> .','d'=>'Disminuir <code>eps</code> a 0.1.'],
  'ok'=>'a' ],
[ 'src'=>'2026 · P37', 'pt'=>1,
  'txt'=>'Un equipo entrenó un <code>BaggingClassifier</code> con 100 árboles de decisión sin restricciones y obtuvo un accuracy en prueba del 85%. Luego, entrenó un <code>RandomForestClassifier</code> con los mismos 100 árboles y los mismos datos, obteniendo un 92% de accuracy. ¿Cuál es la <b>principal razón</b> del mejor rendimiento del bosque aleatorio?',
  'op'=>['a'=>'Bagging no utiliza muestreo bootstrap, mientras que Random Forest sí.','b'=>'El bosque aleatorio introduce aleatoriedad en la selección de características en cada división, lo que reduce la correlación entre los árboles y disminuye la varianza.','c'=>'Random Forest utiliza poda posterior automática, eliminando el sobreajuste.','d'=>'El bosque aleatorio utiliza árboles más profundos que Bagging.'],
  'ok'=>'b' ],
[ 'src'=>'2026 · P38', 'pt'=>1,
  'txt'=>'Se aplica PCA a un conjunto de datos con 50 características. La varianza explicada acumulada por los primeros 5 componentes es del 60%, por los primeros 10 es del 85% y por los primeros 15 es del 95%. Si el objetivo es reducir la dimensionalidad conservando al menos el 90% de la varianza, ¿cuántos componentes se deben elegir?',
  'op'=>['a'=>'15','b'=>'No se puede determinar sin conocer la matriz de covarianza.','c'=>'10','d'=>'5'],
  'ok'=>'a' ],

/* ======================= Parcial 2 — 2025-1 (Parcial2_IA): solo las que no estan arriba ======================= */
[ 'src'=>'2025-1 · P2', 'pt'=>1,
  'txt'=>'Deseas medir la importancia relativa de las variables en un árbol de decisión.<br><b>¿Cuál criterio se utiliza más comúnmente para calcular la importancia?</b>',
  'op'=>['a'=>'El orden de aparición en el árbol (niveles más altos).','b'=>'La reducción promedio de la impureza (Gini o Entropía).','c'=>'El coeficiente de correlación con la variable objetivo.','d'=>'La frecuencia de aparición en splits.'],
  'ok'=>'b' ],
[ 'src'=>'2025-1 · P3', 'pt'=>1,
  'txt'=>'Un árbol de decisión para diagnóstico médico tiene profundidad 20 y está sobreajustado (train accuracy=1.0, test accuracy=0.70).<br><b>¿Qué acción controla mejor el sobreajuste?</b>',
  'op'=>['a'=>'Aumentar la profundidad máxima a 30.','b'=>'Cambiar la métrica de split a Gini en lugar de Entropía.','c'=>'Eliminar el 50% de las hojas aleatoriamente.','d'=>'Usar poda (pruning) con min_samples_leaf=5.'],
  'ok'=>'d' ],
[ 'src'=>'2025-1 · P4', 'pt'=>1,
  'txt'=>'Comparando Random Forest (RF) y XGBoost en un dataset desbalanceado (clase minoritaria 5%).<br><b>¿Qué modelo requiere ajuste explícito para manejar el desbalanceo?</b>',
  'op'=>['a'=>'XGBoost (tiene hiperparámetro <code>scale_pos_weight</code>).','b'=>'Ninguno, deben usarse con SMOTE.','c'=>'RF (usa bagging, no weighting).','d'=>'Ambos lo manejan automáticamente.'],
  'ok'=>'a' ],
[ 'src'=>'2025-1 · P5', 'pt'=>1,
  'txt'=>'¿Cuál de las siguientes opciones representa una desventaja común de los árboles de decisión en machine learning?',
  'op'=>['a'=>'Limitada capacidad para manejar problemas de clasificación multiclase.','b'=>'Requieren un tiempo de entrenamiento prolongado en comparación con otros algoritmos.','c'=>'Dificultad para manejar características numéricas en los datos.','d'=>'Tendencia al sobreajuste en conjuntos de datos complejos.'],
  'ok'=>'d' ],
[ 'src'=>'2025-1 · P7', 'pt'=>1,
  'txt'=>'Un equipo construye un modelo de clasificación para detectar correos spam usando un dataset fuertemente desbalanceado (5% spam, 95% no spam).<br><b>¿Cuál de las siguientes métricas es la mejor para evaluar el desempeño del modelo?</b>',
  'op'=>['a'=>'R² Score.','b'=>'Recall para la clase spam.','c'=>'Mean Absolute Error.','d'=>'Accuracy.'],
  'ok'=>'b' ],
[ 'src'=>'2025-1 · P8', 'pt'=>1,
  'txt'=>'En un modelo de regresión lineal para predecir el precio de viviendas, el error (RMSE) es alto y los residuos muestran un patrón no lineal (en forma de U).<br><b>¿Qué acción es más adecuada para mejorar el modelo?</b>',
  'op'=>['a'=>'Aplicar log-transform a la variable objetivo.','b'=>'Cambiar a un modelo de regresión polinómica.','c'=>'Aumentar la regularización L2 (Ridge).','d'=>'Eliminar outliers del dataset.'],
  'ok'=>'b' ],
[ 'src'=>'2025-1 · P10', 'pt'=>1,
  'txt'=>'Estás eligiendo entre Bagging y Boosting para un problema de clasificación en un dataset pequeño y ruidoso.<br><b>¿Cuál técnica sería preferible y por qué?</b>',
  'op'=>['a'=>'Boosting, porque combina modelos independientes en paralelo.','b'=>'Boosting, porque minimiza el bias aunque haya ruido.','c'=>'Bagging, porque reduce el bias mejor que Boosting.','d'=>'Bagging, porque reduce la varianza mejor que Boosting.'],
  'ok'=>'d' ],
[ 'src'=>'2025-1 · P11', 'pt'=>1,
  'txt'=>'Un analista argumenta que "Random Forest y XGBoost son equivalentes porque ambos usan árboles y agregan predicciones".<br><b>¿Cuál es una diferencia crítica?</b>',
  'op'=>['a'=>'Random Forest ajusta árboles de forma secuencial, XGBoost en paralelo.','b'=>'XGBoost construye árboles para corregir errores anteriores (gradiente), Random Forest no.','c'=>'Random Forest ajusta árboles basados en gradiente descendente, XGBoost no.','d'=>'XGBoost usa solo árboles de decisión lineales.'],
  'ok'=>'b' ],
[ 'src'=>'2025-1 · P12', 'pt'=>1,
  'txt'=>'Al aplicar KNN en un dataset numérico observas muy mal desempeño.<br><b>¿Qué preprocesamiento podría mejorar los resultados?</b>',
  'op'=>['a'=>'Eliminar instancias atípicas manualmente.','b'=>'Normalización o estandarización de características.','c'=>'Aplicar PCA antes del KNN.','d'=>'One-hot encoding.'],
  'ok'=>'b' ],
[ 'src'=>'2025-1 · P13', 'pt'=>1,
  'txt'=>'Entrenas KNN en un dataset de 3000 dimensiones. El accuracy en prueba es bajo pese a un buen desempeño en entrenamiento.<br><b>¿Qué fenómeno es el principal responsable?</b>',
  'op'=>['a'=>'Mal ajuste de la métrica de distancia.','b'=>'Sobreajuste por alta varianza.','c'=>'Efecto de la "maldición de la dimensionalidad".','d'=>'Uso de un <code>k</code> demasiado grande.'],
  'ok'=>'c' ],
[ 'src'=>'2025-1 · P17', 'pt'=>1,
  'txt'=>'Al entrenar un clasificador binario, la curva ROC muestra AUC = 0.65.<br><b>¿Qué interpretación es correcta?</b>',
  'op'=>['a'=>'La métrica AUC no aplica para clasificación binaria.','b'=>'El modelo no es mejor que adivinar al azar (AUC = 0.5).','c'=>'El modelo es mejor que aleatorio pero con margen de mejora.','d'=>'El modelo tiene alta precisión pero bajo recall.'],
  'ok'=>'c' ],
[ 'src'=>'2025-1 · P20', 'pt'=>1,
  'txt'=>'Un SVM con kernel RBF en un dataset de imágenes (n=10,000, p=100) tarda horas en entrenar.<br><b>¿Qué estrategia reduce el tiempo de entrenamiento sin sacrificar precisión?</b>',
  'op'=>['a'=>'Cambiar a kernel lineal y aplicar PCA.','b'=>'Reducir el valor del hiperparámetro C.','c'=>'Aumentar el parámetro gamma del kernel RBF.','d'=>'Usar un subconjunto aleatorio de datos (subsampling).'],
  'ok'=>'a' ],
];

/* ---------------- corregir ---------------- */
$enviado = ($_SERVER['REQUEST_METHOD'] === 'POST');
$resp = []; $estado = [];
$ok = 0; $mal = 0; $blanco = 0; $pts = 0; $ptsTot = 0;
foreach ($P as $i => $q) {
    $ptsTot += $q['pt'];
    $r = isset($_POST["q$i"]) ? (string) $_POST["q$i"] : '';
    $resp[$i] = $r;
    if (!$enviado) { $estado[$i] = ''; continue; }
    if ($r === '')            { $estado[$i] = 'blanco'; $blanco++; }
    elseif ($r === $q['ok'])  { $estado[$i] = 'ok';     $ok++; $pts += $q['pt']; }
    else                      { $estado[$i] = 'mal';    $mal++; }
}
$total = count($P);
$nota  = $ptsTot ? round($pts * 5 / $ptsTot, 2) : 0;
function h($t) { return htmlspecialchars($t, ENT_QUOTES, 'UTF-8'); }
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APO — Test parciales 2</title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<style>
:root{--azul:#2c5aa0;--gris:#f4f5f7;--borde:#d8dbe0;--verde:#1a7f37;--rojo:#c0392b;--naranja:#b5730a}
*{box-sizing:border-box}
body{margin:0;background:var(--gris);font-family:-apple-system,Segoe UI,Arial,sans-serif;color:#22262b;line-height:1.6;padding-bottom:80px}
.topbar{position:sticky;top:0;z-index:50;background:#1f2733;color:#fff;padding:10px 18px;display:flex;flex-wrap:wrap;gap:12px;align-items:center;box-shadow:0 2px 8px rgba(0,0,0,.25)}
.topbar h1{font-size:17px;margin:0;font-weight:600}
.topbar .sub{font-size:13px;opacity:.75;margin:0}
.topbar .spacer{flex:1}
.topbar a{color:#cfe3ff;text-decoration:none;font-size:14px}
.score{background:#2c3746;border-radius:20px;padding:4px 14px;font-size:14px;white-space:nowrap}
.score b{color:#7ee2a8} .score .m{color:#ff9d94} .score .c{color:#ffd08a}
.wrap{max-width:960px;margin:0 auto;padding:22px 16px}
.card{background:#fff;border:1px solid var(--borde);border-radius:12px;padding:18px 22px;margin:0 0 18px}
.card h2{margin:0 0 6px;font-size:20px;color:var(--azul)}
.info{background:#eef4fc;border:1px solid #c9daf3;border-radius:10px;padding:12px 16px;margin:0 0 18px;font-size:14.5px}
.info .tit{font-weight:700;color:var(--azul);margin-bottom:4px}
.q{background:#fff;border:1px solid var(--borde);border-left:5px solid #c4cad3;border-radius:10px;padding:14px 18px;margin:0 0 16px}
.q.ok{border-left-color:var(--verde)} .q.mal{border-left-color:var(--rojo)} .q.blanco{border-left-color:var(--naranja)}
.q .cab{display:flex;gap:10px;align-items:baseline;font-size:13px;color:#7a8494;margin-bottom:6px}
.q .cab b{font-size:16px;color:#22262b}
.q .res{margin-left:auto;font-weight:700;font-size:14px}
.q.ok .res{color:var(--verde)} .q.mal .res{color:var(--rojo)} .q.blanco .res{color:var(--naranja)}
.q .txt{margin:0 0 10px;font-size:15px}
.q pre{background:#f6f8fa;border:1px solid #e3e6ea;border-radius:6px;padding:8px 10px;font-size:13px;overflow-x:auto;margin:8px 0;white-space:pre}
.q code{background:#eef0f3;padding:1px 5px;border-radius:4px;font-size:.9em;color:#b02a5b}
.op{display:flex;gap:8px;align-items:flex-start;padding:6px 10px;border-radius:7px;cursor:pointer;margin:2px 0;font-size:14.5px}
.op:hover{background:#f1f4f8}
.op input{margin-top:5px;flex:none}
.op .l{font-weight:700;min-width:20px;color:#4a5462}
.resumen{font-size:16px} .resumen b{font-size:20px}
.pie{position:fixed;left:0;right:0;bottom:0;background:#fff;border-top:1px solid var(--borde);padding:10px 16px;display:flex;gap:10px;justify-content:center;flex-wrap:wrap;z-index:40}
.btn-ok{background:var(--azul);color:#fff;border:0;border-radius:8px;padding:9px 20px;font-size:15px;cursor:pointer}
.btn-ok:hover{background:#234a85}
.btn-gris{background:#eef0f3;color:#22262b;border:1px solid var(--borde);border-radius:8px;padding:9px 18px;font-size:15px;text-decoration:none}
.btn-gris:hover{background:#e2e5ea;text-decoration:none;color:#22262b}
</style>
</head>
<body>
<form method="post" action="index.php">
<div class="topbar">
  <div>
    <h1>Test — Preguntas de los parciales 2</h1>
    <p class="sub">parcial2APO · parcial_2_revision · Parcial2_IA — <?= $total ?> preguntas sin repetir</p>
  </div>
  <div class="spacer"></div>
  <span id="score"><?php if ($enviado): ?><span class="score"><b><?= $ok ?></b> / <?= $total ?> &nbsp;·&nbsp; <span class="m"><?= $mal ?> mal</span> &nbsp;·&nbsp; <span class="c"><?= $blanco ?> en blanco</span></span><?php endif; ?></span>
  <a href="../Parcial2.php">&#8592; Parcial 2</a>
</div>

<div class="wrap">

  <div id="resumen">
    <?php if ($enviado): ?>
    <div class="card resumen">
      <h2>Resultado</h2>
      <p>Correctas: <b><?= $ok ?></b> de <?= $total ?> &nbsp;·&nbsp; Puntos: <b><?= $pts ?></b> / <?= $ptsTot ?>
         &nbsp;·&nbsp; Nota: <b><?= number_format($nota, 2, ',', '') ?></b> / 5,00</p>
      <p style="margin:0;font-size:14px;color:#5b6573">Cada pregunta marca solo si esta bien o mal; la respuesta correcta no se muestra.
         Cambia las que fallaste y vuelve a enviar, o pulsa <b>Empezar de nuevo</b>.</p>
    </div>
    <?php else: ?>
    <div class="card">
      <h2>Instrucciones</h2>
      <p style="margin:0">Responde todas y pulsa <b>Enviar y verificar</b>. Al enviar solo se marca si cada pregunta
        esta <span style="color:var(--verde);font-weight:700">bien</span> o
        <span style="color:var(--rojo);font-weight:700">mal</span> &mdash; no se muestra la respuesta correcta.
        Las preguntas de datos (bloques "Información") necesitan los archivos del examen.</p>
    </div>
    <?php endif; ?>
  </div>

  <?php foreach ($P as $i => $q): $e = $estado[$i]; ?>
    <?php if (isset($q['info'])): ?>
      <div class="info"><div class="tit">Información</div><?= $q['info'] ?></div>
    <?php endif; ?>
    <div class="q <?= $e ?>" id="p<?= $i + 1 ?>">
      <div class="cab">
        <b>Pregunta <?= $i + 1 ?></b>
        <span><?= $q['pt'] ?> pt<?= $q['pt'] > 1 ? 's' : '' ?> · <?= h($q['src']) ?></span>
        <span class="res"><?= $e === 'ok' ? '&#10004; Correcta' : ($e === 'mal' ? '&#10008; Incorrecta' : ($e === 'blanco' ? 'Sin responder' : '')) ?></span>
      </div>
      <div class="txt"><?= $q['txt'] ?></div>
      <?php $n = 0; foreach ($q['op'] as $k => $t): ?>
        <label class="op">
          <input type="radio" name="q<?= $i ?>" value="<?= $k ?>"<?= $resp[$i] === (string) $k ? ' checked' : '' ?>>
          <?php if ($k !== 'v' && $k !== 'f'): ?><span class="l"><?= chr(97 + $n) ?>.</span><?php endif; ?>
          <span><?= $t ?></span>
        </label>
      <?php $n++; endforeach; ?>
    </div>
  <?php endforeach; ?>

</div>

<div class="pie">
  <button type="submit" class="btn-ok">Enviar y verificar</button>
  <a class="btn-gris" href="index.php">Empezar de nuevo</a>
  <a class="btn-gris" href="../Parcial2.php">Volver</a>
  <span id="estado-envio" role="status" aria-live="polite"></span>
</div>

</form>
<script>
document.querySelector('form').addEventListener('submit', async function (event) {
  event.preventDefault();

  const form = event.currentTarget;
  const button = form.querySelector('button[type="submit"]');
  const status = document.getElementById('estado-envio');
  const scrollY = window.scrollY;
  const anchor = Array.from(form.querySelectorAll('.q')).find(function (question) {
    return question.getBoundingClientRect().bottom > 0;
  });
  const anchorTop = anchor ? anchor.getBoundingClientRect().top : null;
  button.disabled = true;
  status.textContent = 'Enviando respuestas...';

  try {
    const response = await fetch(form.action, {
      method: form.method,
      body: new FormData(form)
    });
    if (!response.ok) {
      throw new Error('El servidor respondió con el estado ' + response.status + '.');
    }

    const html = await response.text();
    const resultDocument = new DOMParser().parseFromString(html, 'text/html');
    const newSummary = resultDocument.getElementById('resumen');
    const newScore = resultDocument.getElementById('score');
    const newQuestions = resultDocument.querySelectorAll('.q');
    const currentQuestions = form.querySelectorAll('.q');

    if (!newSummary || !newScore || newQuestions.length !== currentQuestions.length) {
      throw new Error('La respuesta recibida no tiene el formato esperado.');
    }

    document.getElementById('resumen').innerHTML = newSummary.innerHTML;
    document.getElementById('score').innerHTML = newScore.innerHTML;
    currentQuestions.forEach(function (question, index) {
      const updatedQuestion = newQuestions[index];
      question.className = updatedQuestion.className;
      question.querySelector('.res').textContent = updatedQuestion.querySelector('.res').textContent;
    });
    status.textContent = 'Respuestas verificadas.';
    if (anchor && anchorTop !== null) {
      window.scrollTo(0, window.scrollY + anchor.getBoundingClientRect().top - anchorTop);
    } else {
      window.scrollTo(0, scrollY);
    }
  } catch (error) {
    status.textContent = 'No se pudieron verificar las respuestas. ' + error.message;
  } finally {
    button.disabled = false;
  }
});
</script>
</body>
</html>
