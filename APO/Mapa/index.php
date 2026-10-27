<?php
/* ==========================================================================
   APO / Mapa / index.php  —  Mapa de metodos: arbol + tablas de repaso
   Resume lo que ya esta en los cuestionarios de Parcial 1 y Parcial 2
   (no agrega contenido nuevo). Pagina de consulta, no es un cuestionario.
   ========================================================================== */

/* Cada hoja: n = nombre, t = etiquetas cortas, f = ficha [campo => texto], ir = cuestionario */
function hoja($n, $t, $f, $ir = '') { return ['n' => $n, 't' => $t, 'f' => $f, 'ir' => $ir]; }

$ARBOL = [
  ['n' => 'Aprendizaje supervisado', 'c' => 'sup', 'd' => 'Datos <b>con etiqueta</b> (y conocida). Aprende a predecir la y de datos nuevos.', 'h' => [

    ['n' => 'Regresión — y continua (precio, temperatura…)', 'h' => [
      hoja('Regresión lineal (simple y múltiple)', ['regresión', 'paramétrico'], [
        'Idea'      => 'Recta (o hiperplano) que minimiza el error cuadrático (MSE).',
        'Se evalúa' => 'MSE, RMSE (misma unidad que y), MAE (menos sensible a outliers), MAPE (%), R² (proporción de variabilidad explicada, sin unidades).',
        'Ojo'       => 'RMSE bajo en entrenamiento y alto en prueba → sobreajuste → <b>regularizar</b> (Ridge/Lasso). Residuos con forma de U → la relación no es lineal → términos polinomiales o transformar.',
        'sklearn'   => '<code>LinearRegression()</code>',
      ], '../Regresion/index.php'),
      hoja('Regresión polinomial', ['regresión'], [
        'Idea'      => 'Sigue siendo lineal en los coeficientes, pero agrega x², x³… para curvas.',
        'Ojo'       => 'Más grado → MSE de entrenamiento baja, pero el de prueba sube: <b>sobreajuste</b>.',
        'sklearn'   => '<code>PolynomialFeatures(degree=2)</code> + <code>LinearRegression()</code>',
      ], '../Multiple/index.php'),
      hoja('Ridge (L2)', ['regresión', 'regularización'], [
        'Idea'      => 'Penaliza la <b>suma de los cuadrados</b> de los coeficientes: los encoge hacia cero, pero <b>nunca llegan a cero</b>.',
        'Controla'  => 'Sobreajuste / varianza. <code>alpha</code> más grande → más penalización.',
        'Ojo'       => 'Necesita variables escaladas (la penalización depende de la escala). Con variables correlacionadas reparte el efecto entre ellas. En <code>LogisticRegression</code> la fuerza es <code>C</code> = 1/λ (C grande = poca regularización).',
        'sklearn'   => '<code>Ridge(alpha=1.0)</code> · <code>RidgeCV(alphas=...)</code> escoge λ con validación cruzada',
      ], '../Metricas/Regularizacion/index.php'),
      hoja('Lasso (L1)', ['regresión', 'regularización', 'selección embebida'], [
        'Idea'      => 'Penaliza la <b>suma de los valores absolutos</b>: lleva coeficientes a <b>cero exacto</b> → selecciona variables por sí solo.',
        'Controla'  => 'Sobreajuste. Más <code>alpha</code> → más variables desaparecen.',
        'Ojo'       => 'Es el ejemplo típico de selección <b>embebida</b> (vs RFE, que es envolvente).',
        'sklearn'   => '<code>Lasso(alpha=0.1)</code> · en clasificación: <code>LogisticRegression(penalty=\'l1\', solver=\'liblinear\')</code>',
      ], '../Seleccion/Wrappers/index.php'),
      hoja('Elastic Net (L1 + L2)', ['regresión', 'regularización'], [
        'Idea'      => 'Mezcla las dos penalizaciones con <code>l1_ratio</code> = ρ: ρ = 1 es Lasso, ρ = 0 es Ridge.',
        'Por qué'   => 'Ante un grupo de variables correlacionadas, Lasso se queda con una casi al azar; Elastic Net tiende a conservar el grupo.',
        'Ojo'       => 'Tiene <b>dos</b> hiperparámetros (alpha y l1_ratio): más costoso de ajustar; no siempre gana.',
        'sklearn'   => '<code>ElasticNet(alpha=0.1, l1_ratio=0.5)</code> · <code>ElasticNetCV</code>',
      ], '../Metricas/Regularizacion/index.php'),
    ]],

    ['n' => 'Clasificación — y categórica (binaria o multiclase)', 'h' => [
      hoja('Regresión logística', ['clasificación', 'binaria', 'probabilidad'], [
        'Idea'      => 'A pesar del nombre, <b>clasifica</b>: la sigmoide convierte la combinación lineal en una probabilidad; con umbral 0,5 se decide la clase.',
        'Ojo'       => 'Bajar el umbral → declara positivos más fácilmente: <b>sube el recall y baja la precisión</b>. Los θ aprendidos no cambian.',
        'sklearn'   => '<code>LogisticRegression()</code> · <code>predict_proba()</code> da la probabilidad',
      ], '../Logistica/index.php'),
    ]],

    ['n' => 'Sirven para las dos (clasificación y regresión)', 'h' => [
      hoja('KNN — K vecinos más cercanos', ['clasificación', 'regresión', 'distancias', 'escalar'], [
        'Idea'      => 'Busca los K puntos más cercanos: <b>vota</b> si es clasificación, <b>promedia</b> si es regresión (K = 1 es solo el caso particular).',
        'Clave'     => '<code>n_neighbors</code> (K) y la distancia (euclidiana por defecto).',
        'Ojo'       => '<b>Depende de la escala</b> → normalizar es crítico (edad 0–100 vs ingreso 0–5 M). Sufre la <b>maldición de la dimensionalidad</b>: con miles de dimensiones todas las distancias se parecen.',
        'sklearn'   => '<code>KNeighborsClassifier(n_neighbors=5)</code> · <code>KNeighborsRegressor</code>',
      ], '../Parcial1/index.php'),
      hoja('Árbol de decisión', ['clasificación', 'regresión', 'no paramétrico', 'no escalar'], [
        'Idea'      => 'Preguntas sí/no en cascada (raíz → nodos internos → hojas). Cortes perpendiculares a los ejes.',
        'Criterio'  => 'Clasificación: <b>Gini</b> (0 = puro, máx 0,5 con 2 clases, p.ej. [10, 10]) o <b>entropía</b> / ganancia de información. Regresión: <b>reducción de varianza</b> (la hoja predice el promedio).',
        'Algoritmos'=> 'ID3, C4.5, <b>CART</b> (divisiones binarias, el de sklearn), CHAID.',
        'Ojo'       => 'Desventajas: <b>sobreajuste</b> e <b>inestabilidad</b> (cambia mucho con pocos datos). 100 % en entrenamiento y mal en prueba → <b>poda</b>. La importancia de variables = reducción de impureza acumulada.',
        'sklearn'   => '<code>DecisionTreeClassifier(criterion=\'entropy\', max_depth=3)</code> · <code>feature_importances_</code>',
      ], '../Arboles/Basico/index.php'),
      hoja('Poda (pruning)', ['árboles', 'controla varianza'], [
        'Pre-poda'  => 'Detener antes: <code>max_depth</code>, <code>min_samples_leaf</code>, <code>min_samples_split</code>.',
        'Post-poda' => 'Crecer completo y luego recortar ramas (p.ej. <code>ccp_alpha</code>), escogiendo con validación cruzada.',
        'Ojo'       => 'Es la respuesta directa a "árbol profundo con 100 % en train y mala generalización". Aumentar la profundidad empeora; boosting no es la solución directa.',
      ], '../Arboles/Poda/index.php'),
      hoja('SVM / SVR — Máquinas de vectores de soporte', ['clasificación', 'regresión', 'kernels', 'escalar'], [
        'Idea'      => 'Busca el hiperplano de <b>margen máximo</b> (ancho 2/‖w‖). Solo importan los puntos más cercanos: los <b>vectores de soporte</b>.',
        'C'         => 'Margen blando. C alto → margen angosto, pocas violaciones → <b>sobreajuste</b>. C bajo → margen ancho → subajuste.',
        'Kernels'   => 'Lineal, polinómico (grado), <b>RBF</b> (por defecto; gamma) y sigmoide (tanh). Ver la tabla de kernels.',
        'SVR'       => 'Para regresión: un tubo de ancho <b>ε</b>; los puntos dentro del tubo no cuentan como error.',
        'Ojo'       => 'Hay que <b>escalar</b>. Lento con datasets grandes. Es un modelo de "caja negra" difícil de interpretar.',
        'sklearn'   => '<code>SVC(kernel=\'rbf\', gamma=1, C=1)</code> · <code>SVR(kernel=\'rbf\', C=100, epsilon=0.1)</code>',
      ], '../SVM/Basico/index.php'),
    ]],

    ['n' => 'Ensambles — combinar varios modelos', 'h' => [
      hoja('Bagging (bootstrap aggregating)', ['paralelo', 'reduce VARIANZA', 'homogéneo'], [
        'Idea'      => 'Cada modelo se entrena con una muestra <b>bootstrap</b> (con sustitución) y se agrega: <b>voto</b> (clasificación) o <b>promedio</b> (regresión).',
        'Números'   => 'Cada bolsa trae ~63,2 % de los datos distintos; el ~36,8 % restante es <b>out-of-bag</b> (sirve como validación gratis).',
        'Variantes' => 'Pasting (sin sustitución), random subspaces (solo columnas), random patches (filas y columnas).',
        'Ojo'       => 'Funciona mejor con modelos de alta varianza (árboles profundos). Preferible a boosting con datos <b>pequeños y ruidosos</b>.',
        'sklearn'   => '<code>BaggingClassifier(KNeighborsClassifier(), max_samples=0.5, max_features=0.5)</code>',
      ], '../Ensambles/Bagging/index.php'),
      hoja('Random Forest', ['paralelo', 'reduce VARIANZA', 'árboles'], [
        'Idea'      => 'Bagging de árboles <b>+ en cada división solo se mira un subconjunto aleatorio de variables</b> (√p en clasificación).',
        'Por qué'   => 'Ese muestreo de variables <b>descorrelaciona</b> los árboles. Si una variable domina, en bagging todos los árboles la usan arriba y se parecen; en RF a veces no está disponible → más diversidad → mejor promedio.',
        'Ojo'       => 'Pierde la interpretabilidad del árbol único y usa más memoria. <code>oob_score_</code> y <code>feature_importances_</code>.',
        'sklearn'   => '<code>RandomForestClassifier(n_estimators=100, max_depth=5, random_state=42)</code>',
      ], '../Ensambles/Bagging/index.php'),
      ['n' => 'Boosting — secuencial, reduce SESGO', 'h' => [
        hoja('Idea general del boosting', ['secuencial', 'reduce SESGO', 'débiles'], [
          'Idea'      => 'Modelos <b>débiles</b> (p.ej. stumps) entrenados <b>uno tras otro</b>: cada uno corrige los errores del anterior; resultado = promedio ponderado.',
          'Clave'     => '<code>learning_rate</code> (más bajo → necesita más árboles) y <code>n_estimators</code>.',
          'Ojo'       => 'Persigue los errores → con ruido u outliers puede <b>sobreajustar</b>. No se paraleliza entre árboles (más tiempo).',
        ], '../Ensambles/Boosting/index.php'),
        hoja('AdaBoost (adaptive boosting)', ['secuencial', 'reponderar muestras'], [
          'Idea'      => 'Aumenta el <b>peso de las muestras mal clasificadas</b> y disminuye el de las bien clasificadas. Pérdida exponencial.',
          'Defaults'  => '<code>n_estimators=50</code>, <code>learning_rate=1.0</code>, base = decision stumps.',
          'sklearn'   => '<code>AdaBoostClassifier(n_estimators=400, learning_rate=0.2)</code>',
        ], '../Ensambles/Boosting/index.php'),
        hoja('Gradient Boosting', ['secuencial', 'residuos'], [
          'Idea'      => '(Friedman, 2001) Cada árbol ajusta los <b>pseudo-residuos</b> = gradiente negativo de la pérdida. Sirve cualquier pérdida diferenciable.',
          'Arranque'  => 'F₀ = la media (regresión) o los log-odds (clasificación). Luego F₁ = F₀ + η·h₁.',
          'Clave'     => '<code>learning_rate=0.1</code>, árboles poco profundos, <code>subsample&lt;1</code> → stochastic GB, <code>n_iter_no_change</code> → early stopping.',
          'sklearn'   => '<code>GradientBoostingClassifier(n_estimators=100, learning_rate=0.1)</code>',
        ], '../Ensambles/GradientBoosting/index.php'),
        hoja('HistGradientBoosting', ['secuencial', 'datos grandes'], [
          'Idea'      => 'Gradient boosting que agrupa los valores en <b>bins</b> (histogramas): mucho más rápido con muchos datos y maneja <b>faltantes</b> de forma nativa.',
          'sklearn'   => '<code>HistGradientBoostingClassifier(max_iter=100)</code>',
        ], '../Ensambles/Boosting/index.php'),
        hoja('XGBoost (extreme gradient boosting)', ['secuencial', 'regularizado'], [
          'Idea'      => '(Tianqi Chen, 2016) Gradient boosting con <b>regularización</b> L1/L2 sobre los pesos de las hojas y segunda derivada (hessiano, tipo Newton).',
          'Extras'    => 'Aprende hacia dónde mandar los <b>faltantes</b>; <code>early_stopping_rounds</code>; GPU; importancia por <i>weight</i> o <i>gain</i>.',
          'Defaults'  => '<code>max_depth=6</code>, <code>gamma=0</code>, <code>eta=0.3</code>.',
          'vs RF'     => 'RF: árboles independientes en paralelo, promedio, baja varianza. XGBoost: árboles secuenciales que corrigen residuos, baja sesgo, con regularización.',
          'Parientes' => 'LightGBM y CatBoost: otras implementaciones de gradient boosting.',
        ], '../Ensambles/XGBoost/index.php'),
      ]],
      hoja('Stacking (stacked generalization)', ['heterogéneo', 'meta-modelo'], [
        'Idea'      => 'Modelos base <b>distintos</b>; sus predicciones (obtenidas con validación cruzada) son las <b>características de entrada de un meta-modelo</b>.',
        'Reduce'    => 'Combina estimadores para reducir sus sesgos.',
        'sklearn'   => '<code>StackingClassifier(estimators=estimators, final_estimator=LogisticRegression())</code>',
      ], '../Ensambles/Stacking/index.php'),
      hoja('Voting / averaging', ['heterogéneo', 'sin meta-modelo'], [
        'Hard'      => 'Gana la clase más votada (moda).',
        'Soft'      => 'Promedia las probabilidades (<code>predict_proba</code>); admite <code>weights</code>.',
        'Regresión' => 'Averaging o weighted average.',
        'sklearn'   => '<code>VotingClassifier(estimators=estimators, voting=\'soft\')</code>',
      ], '../Ensambles/Stacking/index.php'),
    ]],
  ]],

  ['n' => 'Aprendizaje no supervisado', 'c' => 'nosup', 'd' => 'Datos <b>sin etiqueta</b>. Busca estructura: grupos, menos dimensiones, reglas o rarezas.', 'h' => [
    ['n' => 'Clustering — agrupar', 'h' => [
      hoja('K-means', ['exclusivo', 'centroides', 'escalar'], [
        'Idea'      => 'Asigna cada punto al centroide más cercano y mueve cada centroide a la <b>media</b> de su grupo; repite. Minimiza la <b>inercia</b>.',
        'K'         => 'Se fija antes: método del codo, silueta (−1 a 1) o Calinski-Harabasz.',
        'Ojo'       => 'Converge a <b>óptimos locales</b> → varias inicializaciones (<code>n_init</code>) y k-means++. Supone grupos esféricos/convexos; falla con lunas o círculos. Sensible a outliers y a la escala; solo variables numéricas.',
        'sklearn'   => '<code>KMeans(n_clusters=4, random_state=42)</code> · <code>inertia_</code>, <code>cluster_centers_</code>',
      ], '../NoSupervisado/KMeans/index.php'),
      hoja('Clustering jerárquico', ['jerárquico', 'dendrograma'], [
        'Tipos'     => '<b>Aglomerativo</b> (de abajo hacia arriba, une) o <b>divisivo</b> (de arriba hacia abajo, separa).',
        'Enlaces'   => 'single (efecto cadena, formas alargadas), complete, average, <b>ward</b> (minimiza varianza).',
        'Ojo'       => 'No hay que fijar K antes: se corta el <b>dendrograma</b> a una altura. Costoso: memoria del orden de N².',
        'sklearn'   => '<code>AgglomerativeClustering(n_clusters=4, linkage=\'ward\')</code>',
      ], '../NoSupervisado/Jerarquico/index.php'),
      hoja('DBSCAN', ['densidad', 'detecta ruido'], [
        'Idea'      => 'Grupos = zonas <b>densas</b>. Puntos núcleo, borde y <b>ruido (etiqueta −1)</b>.',
        'Clave'     => '<code>eps</code> (radio) y <code>min_samples</code>.',
        'Ojo'       => 'No necesita K y encuentra formas arbitrarias. <b>Subir eps</b> → los grupos se fusionan (al extremo, uno solo). Con densidades muy distintas un solo eps no sirve → OPTICS.',
        'sklearn'   => '<code>DBSCAN(eps=0.2, min_samples=5)</code>',
      ], '../NoSupervisado/Jerarquico/index.php'),
      hoja('GMM — mezcla de gaussianas', ['probabilístico'], [
        'Idea'      => 'Clustering <b>probabilístico</b>: cada punto tiene una probabilidad de pertenecer a cada grupo. Se ajusta con EM.',
      ], '../NoSupervisado/Conceptos/index.php'),
    ]],
    ['n' => 'Reducción de dimensionalidad — menos variables', 'h' => [
      hoja('PCA — análisis de componentes principales', ['lineal', 'variables nuevas', 'escalar'], [
        'Idea'      => 'Crea variables <b>nuevas</b> (componentes) = combinaciones lineales de las originales, en la dirección de <b>máxima varianza</b>, ortogonales y no correlacionadas.',
        'Cómo'      => 'Vectores propios de la matriz de covarianza (simétrica → ortogonales); valor propio = varianza que explica.',
        'Leer'      => '"k componentes explican el 90 %" = con k variables nuevas se conserva el 90 % de la variabilidad. Se escoge el mínimo k que llega al umbral (codo del scree plot, o 0,95).',
        'Ojo'       => '<b>Estandarizar</b> antes. Pierde interpretabilidad. Muy sensible a outliers. Es lineal. Máximo min(n−1, p) componentes. Si X1 y X2 están muy correlacionadas positivamente, PC1 va por la diagonal (1, 1)/√2.',
        'sklearn'   => '<code>PCA(n_components=2)</code> · <code>explained_variance_ratio_</code>',
      ], '../NoSupervisado/PCA/index.php'),
      hoja('Kernel PCA', ['no lineal'], [
        'Idea'      => 'PCA con el <b>truco del kernel</b>: proyecta a un espacio de mayor dimensión donde la estructura sí es lineal. Para datos no lineales.',
        'sklearn'   => '<code>KernelPCA(n_components=2, kernel=\'rbf\')</code>',
      ], '../NoSupervisado/PCADiap/index.php'),
      hoja('t-SNE y UMAP', ['no lineal', 'visualización'], [
        'Idea'      => 'Reducciones no lineales pensadas para <b>visualizar</b> en 2D/3D.',
      ], '../NoSupervisado/PCAPractica/index.php'),
      hoja('SVD y autoencoders', ['otras'], [
        'SVD'       => 'Descomposición en valores singulares; sklearn calcula PCA con ella.',
        'Autoencoder'=> 'Red que comprime en un <b>cuello de botella</b> y reconstruye.',
      ], '../NoSupervisado/Conceptos/index.php'),
      hoja('LDA (¡ojo: es supervisado!)', ['supervisado', 'trampa'], [
        'Idea'      => 'También reduce dimensiones, pero <b>usa las etiquetas</b> para maximizar la separación entre clases. PCA no las usa.',
      ], '../NoSupervisado/PCAPractica/index.php'),
    ]],
    ['n' => 'Reglas de asociación', 'h' => [
      hoja('Apriori', ['canasta de mercado'], [
        'Idea'      => '"Quien compra X también compra Y": busca <b>itemsets frecuentes</b>. Ejemplo típico: canasta de mercado, recomendaciones.',
      ], '../NoSupervisado/Conceptos/index.php'),
    ]],
    ['n' => 'Detección de anomalías', 'h' => [
      hoja('Isolation Forest y One-class SVM', ['anomalías'], [
        'Idea'      => 'Encontrar los puntos raros (fraudes, fallas). DBSCAN también marca ruido (−1).',
      ], '../NoSupervisado/Conceptos/index.php'),
    ]],
  ]],

  ['n' => 'Semi-supervisado', 'c' => 'semi', 'd' => 'Pocos datos etiquetados + muchos sin etiquetar (etiquetar es caro).', 'h' => []],

  ['n' => 'Herramientas que sirven para todos', 'c' => 'trans', 'd' => 'No son modelos: se usan alrededor de cualquier modelo.', 'h' => [
    ['n' => 'Selección de características (conserva las variables originales)', 'h' => [
      hoja('Filtros', ['rápido', 'sin modelo', 'univariado'], [
        'Idea'      => 'Puntúa cada variable <b>sin entrenar el modelo final</b>.',
        'Ejemplos'  => '<code>VarianceThreshold</code>, correlación (quitar una de cada par con |r| &gt; 0,9), <b>chi²</b> (valores no negativos/categóricas), <b>información mutua</b> (capta relaciones no lineales), Fisher / ANOVA (<code>f_classif</code>).',
        'sklearn'   => '<code>SelectKBest(chi2, k=3)</code>',
      ], '../Seleccion/Filtros/index.php'),
      hoja('Envolventes (wrappers)', ['usa un modelo', 'costoso'], [
        'Idea'      => 'Prueba subconjuntos entrenando un modelo: <b>forward</b> (agrega), <b>backward</b> (quita), <b>RFE</b> (quita la menos importante y repite).',
        'sklearn'   => '<code>SequentialFeatureSelector(clf, forward=True, cv=5)</code> · <code>RFE(clf, n_features_to_select=3)</code>',
      ], '../Seleccion/Wrappers/index.php'),
      hoja('Embebidos', ['dentro del entrenamiento'], [
        'Idea'      => 'La selección ocurre <b>mientras el modelo aprende</b>: Lasso (coeficientes a cero), importancia de Random Forest.',
        'sklearn'   => '<code>SelectFromModel(estimator=clf, prefit=True)</code>',
      ], '../Seleccion/Wrappers/index.php'),
      hoja('Selección vs PCA y fuga de datos', ['trampa'], [
        'vs PCA'    => 'Selección <b>conserva</b> variables originales (interpretables); PCA <b>crea</b> variables nuevas.',
        'Fuga'      => 'Si se selecciona con todos los datos antes de separar, el resultado sale sobreestimado → seleccionar <b>dentro de un Pipeline</b> solo con entrenamiento.',
      ], '../Seleccion/Fuga/index.php'),
    ]],
    ['n' => 'Sesgo, varianza y validación cruzada', 'h' => [
      hoja('Sesgo vs varianza', ['subajuste', 'sobreajuste'], [
        'Sesgo alto'   => 'modelo demasiado simple → <b>subajuste</b>: malo en entrenamiento y en prueba.',
        'Varianza alta'=> 'modelo demasiado sensible a los datos → <b>sobreajuste</b>: muy bueno en entrenamiento, malo en prueba.',
        'Error'        => 'sesgo² + varianza + error irreducible (el ruido no se puede eliminar).',
        'Se combate'   => 'validación cruzada, menos atributos, menos complejidad, regularización (y en redes: weight decay, dropout, early stopping).',
      ], '../Metricas/SesgoVarianza/index.php'),
      hoja('Tipos de validación', ['generalización', 'hiperparámetros'], [
        'Para qué'  => 'Estimar qué tan bien <b>generaliza</b> el modelo a datos nuevos y elegir hiperparámetros sin tocar la prueba.',
        'K-Fold'    => 'K partes: entrena con K−1, prueba con 1, K veces; se promedia.',
        'Estratificado' => 'Mantiene la <b>proporción de clases</b> en cada parte → para datos desbalanceados.',
        'LOO'       => 'Leave-one-out: n particiones de un solo dato.',
        'ShuffleSplit' => 'Particiones aleatorias repetidas (Monte Carlo).',
        'sklearn'   => '<code>cross_val_score(pipeline, X, y, cv=StratifiedKFold(n_splits=10))</code>',
      ], '../Arboles/Validacion/index.php'),
    ]],
    ['n' => 'Preprocesamiento', 'h' => [
      hoja('Escalar / normalizar', ['escalar'], [
        'Quién lo necesita' => '<b>KNN, SVM, K-means, PCA</b> y modelos regularizados (Ridge, Lasso, logística con penalización). Los <b>árboles y sus ensambles no</b>.',
        'Cómo'      => 'Min-max a [0, 1] (<code>MinMaxScaler</code>) o z-score (<code>StandardScaler</code>). <code>fit</code> solo con entrenamiento.',
      ], '../NoSupervisado/KMeansDiap/index.php'),
      hoja('Variables categóricas y faltantes', ['one-hot'], [
        'One-hot'   => '<code>pd.get_dummies()</code>: una columna 0/1 por categoría (sube el número de variables).',
        'Faltantes' => 'Imputar (p.ej. mediana); ceros imposibles → <code>np.nan</code>. HistGradientBoosting y XGBoost los manejan solos.',
      ], '../Seleccion/Fuga/index.php'),
    ]],
  ]],
];

/* ---------- render del arbol ---------- */
$CONT = 0;
function pintar($nodos, $nivel = 0) {
    global $CONT;
    echo '<ul class="arbol' . ($nivel === 0 ? ' raiz' : '') . '">';
    foreach ($nodos as $nd) {
        if (isset($nd['f'])) {              // hoja
            $CONT++;
            $tags = '';
            foreach ($nd['t'] as $t) $tags .= '<span class="et">' . $t . '</span>';
            echo '<li class="hoja"><details><summary><span class="nom">' . $nd['n'] . '</span>' . $tags . '</summary><dl class="ficha">';
            foreach ($nd['f'] as $k => $v) echo '<dt>' . $k . '</dt><dd>' . $v . '</dd>';
            if ($nd['ir']) echo '<dt></dt><dd><a class="ir" href="' . $nd['ir'] . '">&#8594; practicar en el cuestionario</a></dd>';
            echo '</dl></details></li>';
        } else {                             // rama
            $c = isset($nd['c']) ? ' ' . $nd['c'] : '';
            echo '<li class="rama' . $c . '"><details' . ($nivel === 0 ? ' open' : '') . '><summary><span class="nom">' . $nd['n'] . '</span></summary>';
            if (!empty($nd['d'])) echo '<p class="desc">' . $nd['d'] . '</p>';
            if (!empty($nd['h'])) pintar($nd['h'], $nivel + 1);
            echo '</details></li>';
        }
    }
    echo '</ul>';
}
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APO — Mapa de métodos</title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<style>
:root{--azul:#2c5aa0;--gris:#f4f5f7;--borde:#d8dbe0;--sup:#2c5aa0;--nosup:#1a7f37;--semi:#8a6d00;--trans:#6b3fa0}
*{box-sizing:border-box}
body{margin:0;background:var(--gris);font-family:-apple-system,Segoe UI,Arial,sans-serif;color:#22262b;line-height:1.55}
.topbar{background:#1f2733;color:#fff;padding:14px 18px;display:flex;gap:14px;align-items:center;box-shadow:0 2px 8px rgba(0,0,0,.25);position:sticky;top:0;z-index:5}
.topbar h1{font-size:19px;margin:0;font-weight:600}
.topbar .sub{font-size:13px;opacity:.75;margin:0}
.topbar .spacer{flex:1}
.topbar a{color:#cfe3ff;text-decoration:none;font-size:14px}
.wrap{max-width:1000px;margin:0 auto;padding:22px 16px 70px}
.card{background:#fff;border:1px solid var(--borde);border-radius:10px;padding:18px 20px;margin:0 0 18px}
.card h2{font-size:18px;margin:0 0 10px;color:var(--azul)}
nav.indice{display:flex;flex-wrap:wrap;gap:8px;margin:0 0 18px}
nav.indice a{background:#fff;border:1px solid var(--borde);border-radius:20px;padding:4px 12px;font-size:13.5px;color:var(--azul);text-decoration:none}
nav.indice a:hover{background:#e8eefa}
.herr{display:flex;gap:8px;flex-wrap:wrap;align-items:center;margin-bottom:12px}
.herr input{flex:1;min-width:200px;padding:8px 12px;border:1px solid var(--borde);border-radius:8px;font-size:15px}
.herr button{border:1px solid var(--borde);background:#fff;border-radius:8px;padding:7px 12px;font-size:13.5px;cursor:pointer}
.herr button:hover{background:#eef1f5}
/* arbol */
ul.arbol{list-style:none;margin:0;padding-left:22px;position:relative}
ul.arbol.raiz{padding-left:0}
ul.arbol li{position:relative;margin:4px 0}
ul.arbol:not(.raiz)>li::before{content:"";position:absolute;left:-14px;top:0;bottom:-6px;border-left:2px solid #d3d8df}
ul.arbol:not(.raiz)>li:last-child::before{bottom:auto;height:17px}
ul.arbol:not(.raiz)>li::after{content:"";position:absolute;left:-14px;top:17px;width:12px;border-top:2px solid #d3d8df}
summary{cursor:pointer;list-style:none;padding:5px 10px;border-radius:7px;display:inline-flex;flex-wrap:wrap;gap:6px;align-items:center}
summary::-webkit-details-marker{display:none}
summary::before{content:"▸";color:#8892a0;font-size:12px;width:10px;transition:.15s}
details[open]>summary::before{transform:rotate(90deg)}
summary:hover{background:#eef1f5}
li.rama>details>summary .nom{font-weight:700}
ul.raiz>li.rama>details>summary{font-size:17px;color:#fff;padding:7px 14px}
ul.raiz>li.sup>details>summary{background:var(--sup)}
ul.raiz>li.nosup>details>summary{background:var(--nosup)}
ul.raiz>li.semi>details>summary{background:var(--semi)}
ul.raiz>li.trans>details>summary{background:var(--trans)}
ul.raiz>li>details>summary::before{color:#fff}
ul.raiz>li{margin:10px 0}
p.desc{margin:4px 0 4px 24px;font-size:14px;color:#505a68}
li.hoja>details>summary .nom{color:#1f2733}
.et{font-size:11px;background:#eef1f5;color:#4a5462;border-radius:10px;padding:0 7px;font-weight:600}
dl.ficha{margin:6px 0 10px 18px;background:#fbfcfd;border:1px solid var(--borde);border-left:4px solid var(--azul);border-radius:8px;padding:10px 14px;display:grid;grid-template-columns:max-content 1fr;gap:5px 14px;font-size:14.3px}
dl.ficha dt{font-weight:700;color:var(--azul)}
dl.ficha dd{margin:0}
a.ir{font-size:13px}
li.oculto{display:none}
mark{background:#fff3a3;padding:0}
/* tablas */
table.t{width:100%;border-collapse:collapse;font-size:14.2px}
table.t th,table.t td{border:1px solid var(--borde);padding:6px 9px;vertical-align:top;text-align:left}
table.t th{background:#eef1f5}
table.t td:first-child{font-weight:600}
.si{color:#1a7f37;font-weight:700}.no{color:#c0392b;font-weight:700}
.scroll{overflow-x:auto}
code{font-size:12.8px;color:#a3195b;background:#f6f2f4;padding:0 3px;border-radius:3px}
.nota{font-size:13.5px;color:#505a68;margin-top:8px}
@media(max-width:640px){dl.ficha{grid-template-columns:1fr}dl.ficha dt{margin-top:4px}}
</style>
</head>
<body>

<div class="topbar">
  <div>
    <h1>APO · Mapa de métodos</h1>
    <p class="sub">Qué es cada uno, de qué tipo es, qué reduce y dónde está la trampa</p>
  </div>
  <div class="spacer"></div>
  <a href="../Parcial2.php">&#8592; Parcial 2</a>
</div>

<div class="wrap">

<nav class="indice">
  <a href="#arbol">Árbol</a>
  <a href="#pistas">Si la pregunta dice…</a>
  <a href="#resumen">Tabla general</a>
  <a href="#hiper">Hiperparámetros</a>
  <a href="#kernels">Kernels</a>
  <a href="#boost">Bagging vs boosting</a>
  <a href="#metricas">Métricas</a>
</nav>

<div class="card" id="arbol">
  <h2>1. El árbol</h2>
  <div class="herr">
    <input id="buscar" type="search" placeholder="Buscar: varianza, kernel, escalar, eps, Lasso…" autocomplete="off">
    <button type="button" onclick="todo(true)">Abrir todo</button>
    <button type="button" onclick="todo(false)">Cerrar todo</button>
  </div>
  <?php pintar($ARBOL); ?>
  <p class="nota">Toca un método para ver su ficha (<?= $CONT ?> métodos y herramientas). Las etiquetas grises dicen de qué tipo es cada uno.</p>
</div>


<div class="card" id="pistas">
  <h2>2. Si la pregunta dice… piensa en…</h2>
  <div class="scroll"><table class="t">
    <tr><th>La pregunta dice</th><th>Piensa en</th></tr>
    <tr><td>árbol profundo, 100 % en entrenamiento, mal en prueba</td><td><b>Poda</b> (max_depth, min_samples_leaf, ccp_alpha). Subir la profundidad empeora.</td></tr>
    <tr><td>RMSE bajo en entrenamiento y alto en prueba (regresión)</td><td>Sobreajuste → <b>regularización</b> Ridge o Lasso.</td></tr>
    <tr><td>residuos con forma de U</td><td>Relación <b>no lineal</b> → términos polinomiales o transformar.</td></tr>
    <tr><td>reducir la <b>varianza</b> / modelos en paralelo / bootstrap</td><td><b>Bagging</b>, Random Forest.</td></tr>
    <tr><td>reducir el <b>sesgo</b> / débiles en secuencia / corregir errores</td><td><b>Boosting</b> (AdaBoost, Gradient Boosting, XGBoost).</td></tr>
    <tr><td>meta-modelo que usa las predicciones como características</td><td><b>Stacking</b>.</td></tr>
    <tr><td>Bagging vs RF con una variable que domina</td><td>RF muestrea variables en cada corte → árboles <b>menos correlacionados</b>.</td></tr>
    <tr><td>dataset pequeño y ruidoso: ¿bagging o boosting?</td><td><b>Bagging</b>: el boosting persigue el ruido y sobreajusta.</td></tr>
    <tr><td>SVM: al subir C → 100 % en train, mal en validación</td><td><b>Sobreajuste</b> (margen angosto). Bajar C (o gamma en RBF).</td></tr>
    <tr><td>datos no linealmente separables / mapear a un espacio enorme o infinito</td><td><b>Truco del kernel</b>: solo se calculan productos punto en el espacio original. RBF = dimensión infinita.</td></tr>
    <tr><td>escalas distintas (edad vs ingreso)</td><td><b>Estandarizar/normalizar</b> antes de KNN, SVM, K-means, PCA.</td></tr>
    <tr><td>KNN con miles de dimensiones, bien en train y mal en test</td><td><b>Maldición de la dimensionalidad</b>.</td></tr>
    <tr><td>K-means converge a un óptimo local</td><td><b>Varias inicializaciones</b> (<code>n_init</code>) y k-means++.</td></tr>
    <tr><td>¿cuántos clusters?</td><td>Codo (inercia), silueta, Calinski-Harabasz.</td></tr>
    <tr><td>formas no convexas, ruido, sin saber K</td><td><b>DBSCAN</b>.</td></tr>
    <tr><td>DBSCAN: subir eps</td><td>Los grupos se <b>fusionan</b> (al extremo, uno solo). Densidades distintas → un solo eps no sirve.</td></tr>
    <tr><td>PCA: "k componentes explican el X %"</td><td>Con k variables nuevas se conserva el X % de la variabilidad; el resto se pierde.</td></tr>
    <tr><td>Lasso vs RFE</td><td>Lasso = <b>embebido</b> (selecciona al entrenar); RFE = <b>envolvente</b> (reentrena quitando variables).</td></tr>
    <tr><td>selección de características vs PCA</td><td>Selección conserva las <b>originales</b>; PCA crea <b>nuevas</b>.</td></tr>
    <tr><td>importancia de variables en un árbol</td><td>Reducción de <b>impureza</b> (Gini/entropía) acumulada.</td></tr>
    <tr><td>datos desbalanceados: ¿qué métrica?</td><td><b>No</b> accuracy. Recall si el error caro es no ver el positivo; precisión si el caro es la falsa alarma; F1 o AUC para resumir.</td></tr>
    <tr><td>AUC = 0,65</td><td>0,5 = azar, 1 = perfecto: algo mejor que el azar, pero débil.</td></tr>
    <tr><td>propósito de la validación cruzada</td><td>Estimar la <b>generalización</b> a datos nuevos (y elegir hiperparámetros).</td></tr>
  </table></div>
</div>


<div class="card" id="resumen">
  <h2>3. Tabla general</h2>
  <div class="scroll"><table class="t">
    <tr><th>Método</th><th>Tipo</th><th>Tarea</th><th>¿Escalar?</th><th>Lo característico</th></tr>
    <tr><td>Regresión lineal / polinomial</td><td>supervisado</td><td>regresión</td><td class="no">no*</td><td>minimiza MSE</td></tr>
    <tr><td>Ridge / Lasso</td><td>supervisado</td><td>regresión</td><td class="si">sí</td><td>L2 encoge · L1 lleva a cero</td></tr>
    <tr><td>Regresión logística</td><td>supervisado</td><td>clasificación</td><td class="si">sí, si se regulariza</td><td>sigmoide → probabilidad</td></tr>
    <tr><td>KNN</td><td>supervisado</td><td>ambas</td><td class="si">sí</td><td>vecinos; maldición de la dimensionalidad</td></tr>
    <tr><td>Árbol de decisión</td><td>supervisado</td><td>ambas</td><td class="no">no</td><td>Gini/entropía; se sobreajusta → poda</td></tr>
    <tr><td>SVM / SVR</td><td>supervisado</td><td>ambas</td><td class="si">sí</td><td>margen máximo; C; kernels</td></tr>
    <tr><td>Bagging / Random Forest</td><td>supervisado (ensamble)</td><td>ambas</td><td class="no">no</td><td>paralelo · baja <b>varianza</b></td></tr>
    <tr><td>AdaBoost / GB / XGBoost</td><td>supervisado (ensamble)</td><td>ambas</td><td class="no">no</td><td>secuencial · baja <b>sesgo</b></td></tr>
    <tr><td>Stacking / Voting</td><td>supervisado (ensamble)</td><td>ambas</td><td>según modelos base</td><td>modelos distintos; meta-modelo / votación</td></tr>
    <tr><td>K-means</td><td>no supervisado</td><td>clustering</td><td class="si">sí</td><td>centroides; K previo; esféricos</td></tr>
    <tr><td>Jerárquico</td><td>no supervisado</td><td>clustering</td><td class="si">sí</td><td>dendrograma; enlaces</td></tr>
    <tr><td>DBSCAN</td><td>no supervisado</td><td>clustering</td><td class="si">sí</td><td>densidad; eps; ruido −1</td></tr>
    <tr><td>PCA / Kernel PCA</td><td>no supervisado</td><td>reducción</td><td class="si">sí</td><td>máxima varianza; variables nuevas</td></tr>
    <tr><td>LDA</td><td><b>supervisado</b></td><td>reducción</td><td class="si">sí</td><td>usa etiquetas</td></tr>
    <tr><td>Apriori</td><td>no supervisado</td><td>asociación</td><td>—</td><td>itemsets frecuentes</td></tr>
  </table></div>
  <p class="nota">* La lineal sin regularizar no lo necesita para predecir, pero sí para comparar coeficientes o si se agrega penalización.</p>
</div>


<div class="card" id="hiper">
  <h2>4. ¿Qué pasa si subo…?</h2>
  <div class="scroll"><table class="t">
    <tr><th>Hiperparámetro</th><th>Modelo</th><th>Si lo subo</th><th>Riesgo</th></tr>
    <tr><td><code>C</code></td><td>SVM</td><td>margen más angosto, menos violaciones</td><td>sobreajuste</td></tr>
    <tr><td><code>gamma</code></td><td>SVM RBF</td><td>cada punto influye en una zona más pequeña → frontera irregular</td><td>sobreajuste</td></tr>
    <tr><td><code>degree</code></td><td>SVM polinómico / regresión polinomial</td><td>frontera/curva más flexible</td><td>sobreajuste</td></tr>
    <tr><td><code>epsilon</code></td><td>SVR</td><td>tubo más ancho, menos puntos cuentan como error</td><td>subajuste</td></tr>
    <tr><td><code>max_depth</code></td><td>árboles, GB, XGBoost</td><td>árbol más complejo</td><td>sobreajuste</td></tr>
    <tr><td><code>min_samples_leaf</code></td><td>árboles</td><td>hojas más grandes, árbol más simple</td><td>subajuste</td></tr>
    <tr><td><code>n_estimators</code></td><td>RF / bagging</td><td>promedio más estable (no sobreajusta, solo cuesta tiempo)</td><td>tiempo y memoria</td></tr>
    <tr><td><code>n_estimators</code></td><td>boosting</td><td>más correcciones</td><td>sobreajuste (usar early stopping)</td></tr>
    <tr><td><code>learning_rate</code></td><td>boosting</td><td>pasos más grandes, necesita menos árboles</td><td>sobreajuste; bajarlo pide más árboles</td></tr>
    <tr><td><code>alpha</code></td><td>Ridge / Lasso</td><td>más penalización (Lasso: más coeficientes en cero)</td><td>subajuste</td></tr>
    <tr><td><code>n_neighbors</code> (K)</td><td>KNN</td><td>frontera más suave (K = 1 es la más irregular)</td><td>subajuste si es muy grande</td></tr>
    <tr><td><code>n_clusters</code> (K)</td><td>K-means</td><td>la inercia siempre baja</td><td>por eso se usa el codo, no el mínimo</td></tr>
    <tr><td><code>eps</code></td><td>DBSCAN</td><td>vecindarios más grandes → grupos se fusionan</td><td>todo en un cluster</td></tr>
    <tr><td><code>min_samples</code></td><td>DBSCAN</td><td>más exigente para ser núcleo → más ruido</td><td>grupos dispersos quedan como ruido</td></tr>
    <tr><td><code>n_components</code></td><td>PCA</td><td>se conserva más varianza</td><td>menos reducción</td></tr>
  </table></div>
</div>


<div class="card" id="kernels">
  <h2>5. Los kernels de SVM</h2>
  <div class="scroll"><table class="t">
    <tr><th>Kernel</th><th>Para qué</th><th>Parámetro</th><th>Ojo</th></tr>
    <tr><td>Lineal</td><td>datos linealmente separables, muchas variables (texto)</td><td>C</td><td>el más rápido; da <code>coef_</code> interpretables</td></tr>
    <tr><td>Polinómico</td><td>fronteras curvas de forma conocida</td><td><code>degree</code> (y C)</td><td>grado 2 = interacciones de pares; grado alto sobreajusta</td></tr>
    <tr><td>RBF (gaussiano)</td><td>no lineal general; <b>el de por defecto</b></td><td><code>gamma</code> y C</td><td>equivale a un espacio de dimensión <b>infinita</b>; mide similitud por distancia</td></tr>
    <tr><td>Sigmoide</td><td>parecido a una neurona</td><td>gamma, coef0</td><td>usa <code>tanh</code>; poco común</td></tr>
  </table></div>
  <p class="nota">Polinómico vs RBF: el polinómico fija la forma por el grado; el RBF es más flexible y depende de gamma.</p>
</div>


<div class="card" id="boost">
  <h2>6. Bagging vs boosting vs stacking</h2>
  <div class="scroll"><table class="t">
    <tr><th></th><th>Bagging / RF</th><th>Boosting</th><th>Stacking</th></tr>
    <tr><td>Entrenamiento</td><td>paralelo, independientes</td><td>secuencial, cada uno depende del anterior</td><td>base en paralelo + meta-modelo</td></tr>
    <tr><td>Modelos base</td><td>homogéneos, profundos (alta varianza)</td><td>homogéneos, débiles / poco profundos</td><td>heterogéneos</td></tr>
    <tr><td>Reduce</td><td><b>varianza</b></td><td><b>sesgo</b></td><td>sesgo (combina fortalezas)</td></tr>
    <tr><td>Datos</td><td>muestras bootstrap</td><td>reponderadas (AdaBoost) o residuos (GB)</td><td>predicciones con validación cruzada</td></tr>
    <tr><td>Combina</td><td>voto / promedio</td><td>promedio ponderado</td><td>lo aprende el meta-modelo</td></tr>
    <tr><td>Con ruido</td><td>robusto</td><td>puede sobreajustar</td><td>—</td></tr>
  </table></div>
  <h2 style="margin-top:16px">Familia del gradient boosting</h2>
  <div class="scroll"><table class="t">
    <tr><th>Variante</th><th>Qué cambia</th></tr>
    <tr><td>AdaBoost</td><td>repondera <b>muestras</b> mal clasificadas; pérdida exponencial; stumps</td></tr>
    <tr><td>Gradient Boosting</td><td>cada árbol ajusta los <b>pseudo-residuos</b> (gradiente negativo); cualquier pérdida diferenciable</td></tr>
    <tr><td>Stochastic GB</td><td>cada árbol con una submuestra (<code>subsample&lt;1</code>)</td></tr>
    <tr><td>HistGradientBoosting</td><td><b>bins</b> → rápido en datos grandes; faltantes nativos</td></tr>
    <tr><td>XGBoost</td><td><b>regularización</b> L1/L2 en hojas, hessiano (Newton), faltantes, early stopping, GPU</td></tr>
    <tr><td>LightGBM / CatBoost</td><td>otras implementaciones de gradient boosting</td></tr>
  </table></div>
</div>


<div class="card" id="metricas">
  <h2>7. Métricas: ¿cuál uso?</h2>
  <div class="scroll"><table class="t">
    <tr><th>Tarea</th><th>Métrica</th><th>Qué mide / cuándo</th></tr>
    <tr><td rowspan="8">Clasificación</td><td>Accuracy (exactitud)</td><td>aciertos / total. <b>Engaña con desbalance</b> (decir siempre "no" da 99 %).</td></tr>
    <tr><td>Precision</td><td>TP / (TP + FP): de los que dije positivos, cuántos lo eran. Importa si la falsa alarma es cara.</td></tr>
    <tr><td>Recall (sensibilidad)</td><td>TP / (TP + FN): de los positivos reales, cuántos encontré. Importa si no detectar es caro (fraude, enfermedad).</td></tr>
    <tr><td>F1</td><td>combina precision y recall.</td></tr>
    <tr><td>AUC-ROC</td><td>capacidad de separar clases con todos los umbrales; 0,5 = azar, 1 = perfecto.</td></tr>
    <tr><td>Matriz de confusión</td><td>TP, FP, FN, TN; de ahí salen todas las anteriores (y la especificidad).</td></tr>
    <tr><td>Especificidad</td><td>VN / (VN + FP): de los negativos reales, cuántos descarté. FPR = 1 − especificidad (eje X de la ROC).</td></tr>
    <tr><td>Exactitud balanceada</td><td>promedio de recall y especificidad: no la infla la clase mayoritaria.</td></tr>
    <tr><td rowspan="5">Regresión</td><td>MSE</td><td>castiga más los errores grandes; unidad al cuadrado.</td></tr>
    <tr><td>RMSE</td><td>raíz del MSE: en la misma unidad que y.</td></tr>
    <tr><td>MAE / MAPE</td><td>MAE: error absoluto, menos sensible a outliers. MAPE: error en %, |y − ŷ| / |y|.</td></tr>
    <tr><td>R²</td><td>proporción de la variabilidad de y que explica el modelo; sin unidades. Puede ser <b>negativo</b> en prueba (peor que predecir la media) y no detecta curvas ni outliers (Anscombe).</td></tr>
    <tr><td>RMSE relativo</td><td>RMSE / media de y: permite comparar problemas de escalas distintas.</td></tr>
    <tr><td rowspan="2">Clustering</td><td>Internas (sin etiquetas)</td><td>inercia, silueta (−1 a 1), Calinski-Harabasz (mayor mejor), Davies-Bouldin (menor mejor).</td></tr>
    <tr><td>Externas (con etiquetas reales)</td><td>ARI, NMI (1 = coincide perfecto).</td></tr>
  </table></div>
</div>

</div>

<script>
const caja = document.getElementById('buscar');
const hojas = [...document.querySelectorAll('li.hoja')];
const ramas = [...document.querySelectorAll('li.rama')];
function norm(s){return s.toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g,'');}
hojas.forEach(h => h.dataset.txt = norm(h.textContent));
function todo(abrir){ document.querySelectorAll('#arbol details').forEach(d => d.open = abrir); }
caja.addEventListener('input', () => {
  const q = norm(caja.value.trim());
  if (!q) { hojas.forEach(h => h.classList.remove('oculto')); ramas.forEach(r => r.classList.remove('oculto'));
            todo(false); document.querySelectorAll('ul.raiz>li>details').forEach(d => d.open = true); return; }
  hojas.forEach(h => {
    const ok = h.dataset.txt.includes(q);
    h.classList.toggle('oculto', !ok);
    h.querySelector('details').open = ok;
  });
  ramas.slice().reverse().forEach(r => {
    const visible = r.querySelector('li.hoja:not(.oculto)') !== null;
    r.classList.toggle('oculto', !visible);
    r.querySelector('details').open = visible;
  });
});
</script>
</body>
</html>
