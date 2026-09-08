<?php
/* ==========================================================================
   APO / SMART  —  Objetivos S.M.A.R.T.: como escribirlos  (cuestionario corto)
   Fuentes: SMART.pdf  (Performance Appraisal Planning 2016-2017)
            Writing S.M.A.R.T. Objectives.pdf  (adaptado de CDC, 2018)
   Respuestas de TEXTO: da igual tilde, mayuscula y articulo.
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [

    /* --- las cinco letras --- */
    1  => ["Specific", "Especifico"],
    2  => ["Measurable", "Medible"],
    3  => ["Achievable", "Alcanzable"],
    4  => ["Relevant", "Relevante"],
    5  => ["Time-Bound", "Time bound", "Limitado en el tiempo", "Con plazo"],

    /* --- las seis preguntas de la S --- */
    6  => ["Who", "Quien"],
    7  => ["What", "Que"],
    8  => ["When", "Cuando"],
    9  => ["Where", "Donde"],
    10 => ["Which", "Cual"],
    11 => ["Why", "Por que", "Porque"],

    /* --- medicion --- */
    12 => ["Quantitative", "Cuantitativa", "Cuantitativos"],
    13 => ["Qualitative", "Cualitativa", "Cualitativos"],
    14 => ["Milestones", "Milestone", "Hitos", "Hito"],

    /* --- la version CDC --- */
    15 => ["Realistic", "Realista"],
    16 => ["Deadline", "Fecha limite", "Fecha de entrega", "Plazo"],

    /* --- la estructura del objetivo --- */
    17 => ["Who", "Quien"],
    18 => ["What", "Que"],
    19 => ["How much", "Cuanto"],
    20 => ["When", "Cuando"],
];

$MULTIPLE = [

    'm1' => [
        'texto'    => 'Al fijar el alcance de un objetivo SMART, &iquest;en que hay que centrarse?',
        'opciones' => [
            'a' => 'En las <b>tareas</b> concretas del dia a dia',
            'b' => 'En los <b>resultados finales</b> (end results), no en las tareas',
            'c' => 'En el numero de horas trabajadas',
            'd' => 'En las herramientas que se van a usar'
        ],
        'correcta' => 'b',
        'porque'   => 'Literal del PDF: «to get the scope right, remember to focus on <b>end results not tasks</b>». Los objetivos deben ser lo bastante altos para abarcar los resultados clave de los que eres responsable, pero lo bastante especificos para poder medir el exito.'
    ],

    'm2' => [
        'texto'    => 'Tienes 14 objetivos para el ciclo. Segun la guia, &iquest;que indica eso?',
        'opciones' => [
            'a' => 'Que eres muy productivo',
            'b' => 'Que probablemente estan <b>planteados a un nivel demasiado bajo</b> y son mas tareas que resultados: conviene combinar varios en un area de resultado mas amplia',
            'c' => 'Que hay que eliminar la mitad al azar',
            'd' => 'Que faltan objetivos: deberian ser mas'
        ],
        'correcta' => 'b',
        'porque'   => '«Having too many goals can be an indicator that your goals are scoped at too low a level and are focused more on tasks than on end results.»'
    ],

    'm3' => [
        'texto'    => '&iquest;Cuantos verbos de accion debe llevar un objetivo bien escrito, y por que?',
        'opciones' => [
            'a' => 'Al menos tres, para que sea completo',
            'b' => 'Ninguno: los objetivos se escriben en sustantivos',
            'c' => '<b>Uno solo</b>, porque con mas de un verbo se estan midiendo varias actividades o comportamientos a la vez',
            'd' => 'Da igual, mientras sea medible'
        ],
        'correcta' => 'c',
        'porque'   => 'Es la regla de la <b>S</b> en el documento del CDC: «Use only one action verb since objectives with more than one verb imply that more than one activity or behavior is being measured». Si mides dos cosas, no sabras cual fallo.'
    ],

    'm4' => [
        'texto'    => 'La <b>M</b> exige medir. &iquest;Sirven solo los numeros?',
        'opciones' => [
            'a' => 'Si: si no es un numero, no se puede medir',
            'b' => 'No: los metodos pueden ser <b>cuantitativos</b> (productividad, dinero ahorrado o ganado) y tambien <b>cualitativos</b> (testimonios de clientes, encuestas)',
            'c' => 'Solo valen las encuestas',
            'd' => 'Solo valen los informes automatizados'
        ],
        'correcta' => 'b',
        'porque'   => 'Y el matiz que suele preguntarse: aunque no exista una medida directa perfecta, la <em>conversacion</em> sobre que resultado se busca y como se veria el exito ya es una parte valiosa de la planificacion.'
    ],

    'm5' => [
        'texto'    => 'Los dos documentos no usan la misma palabra para la <b>R</b>. &iquest;Cuales son y en que se parecen?',
        'opciones' => [
            'a' => '<b>Relevant</b> (SMART.pdf) y <b>Realistic</b> (CDC): las dos piden que el objetivo encaje con el alcance real del problema y con los objetivos mas amplios',
            'b' => 'Reliable y Rapid',
            'c' => 'Repeatable y Relevant',
            'd' => 'Las dos usan Realistic; no hay diferencia'
        ],
        'correcta' => 'a',
        'porque'   => 'Si el objetivo no se relaciona con la meta del programa, no ayuda a alcanzarla &mdash;aunque se cumpla&mdash;. Ese es el fondo comun de las dos versiones: tu equipo puede lanzar un programa nuevo, pero si la division no lo esta priorizando, no toca.'
    ],

    'm6' => [
        'texto'    => '«Teachers will be trained on the scientifically based health education curriculum.» &iquest;Por que <b>no</b> es SMART?',
        'opciones' => [
            'a' => 'Porque esta en ingles',
            'b' => 'Porque no es especifico, ni medible, ni tiene plazo: no dice <b>quien</b> entrena, <b>a cuantos</b>, a <b>quienes</b> ni <b>para cuando</b>',
            'c' => 'Porque tiene mas de un verbo de accion',
            'd' => 'Porque no es relevante para el programa'
        ],
        'correcta' => 'b',
        'porque'   => 'La version SMART del propio documento: «By year two of the project, <b>LEA staff</b> will have trained <b>75 %</b> of health education teachers in the school district on the selected scientifically based health education curriculum.»'
    ],

    'm7' => [
        'texto'    => '«90 % of youth participants will understand substance abuse prevention concepts» se arregla asi: «By the end of the school year, 90 % of youth participants in middle school will <b>define addiction as a disease</b>». &iquest;Que se gano?',
        'opciones' => [
            'a' => 'Solo el plazo',
            'b' => 'Un plazo (<em>by the end of the school year</em>), un <b>quien</b> concreto (middle school) y un verbo <b>observable</b> en lugar de «understand», que no se puede medir',
            'c' => 'Se gano relevancia, pero se perdio la medida',
            'd' => 'Nada: los dos son equivalentes'
        ],
        'correcta' => 'b',
        'porque'   => '«Comprender» pasa dentro de la cabeza de alguien y no se observa. «Definir la adiccion como una enfermedad» si: o lo hace o no lo hace. Ese cambio de verbo es lo que vuelve medible la <b>M</b>.'
    ],

    'm8' => [
        'texto'    => 'La <b>A</b> de <em>Achievable</em>. &iquest;Que busca exactamente?',
        'opciones' => [
            'a' => 'Que el objetivo sea lo mas ambicioso posible, aunque desanime',
            'b' => 'Que el objetivo sea <b>alcanzable</b> con el tiempo y los recursos disponibles: pensar como lograrlo, si tienes las herramientas y habilidades y, si no, que haria falta para conseguirlas',
            'c' => 'Que el objetivo no cambie nunca',
            'd' => 'Que el objetivo lo apruebe el jefe'
        ],
        'correcta' => 'b',
        'porque'   => 'El PDF lo dice en una linea: «The goal is meant to inspire <b>motivation, not discouragement</b>». Un objetivo imposible no motiva, paraliza.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, range(1, 20));
cabecera('Objetivos S.M.A.R.T. · Como escribirlos', 'SMART.pdf · Writing S.M.A.R.T. Objectives.pdf');
?>

<div class="card">
  <h2>Antes de empezar</h2>
  <p>Cuestionario <b>corto</b>. Un objetivo SMART es una declaracion concreta de lo que el
     proyecto intenta lograr, escrita de modo que al terminar se pueda evaluar
     facilmente <b>si se cumplio o no</b>.</p>
  <div class="nota">
    <b>Como se corrige.</b> Se aceptan las respuestas en <b>ingles o en castellano</b>
    (<code>Measurable</code> o <code>medible</code>), y da igual la tilde, la mayuscula y
    el articulo de delante. Pulsa <b>Enter</b> dentro de un hueco para verificar.
  </div>
</div>


<div class="card">
  <h2>1. Las cinco letras y la pregunta que responde cada una</h2>
  <p>Esta tabla es el cuestionario entero resumido. Rellena la columna del medio:</p>

  <table class="datos">
    <tr><th></th><th>Criterio</th><th>Pregunta que responde</th></tr>
    <tr>
      <td class="idx"><b>S</b></td>
      <td><?php hueco(1, 16); ?></td>
      <td>&iquest;Que se va a lograr? &iquest;Que acciones vas a tomar?</td>
    </tr>
    <tr>
      <td class="idx"><b>M</b></td>
      <td><?php hueco(2, 16); ?></td>
      <td>&iquest;Que datos mediran el objetivo? &iquest;Cuanto? &iquest;Como de bien?</td>
    </tr>
    <tr>
      <td class="idx"><b>A</b></td>
      <td><?php hueco(3, 16); ?></td>
      <td>&iquest;Es factible? &iquest;Tienes las habilidades y los recursos necesarios?</td>
    </tr>
    <tr>
      <td class="idx"><b>R</b></td>
      <td><?php hueco(4, 16); ?></td>
      <td>&iquest;Como encaja con objetivos mas amplios? &iquest;Por que importa el resultado?</td>
    </tr>
    <tr>
      <td class="idx"><b>T</b></td>
      <td><?php hueco(5, 16); ?></td>
      <td>&iquest;Cual es el marco de tiempo para lograrlo?</td>
    </tr>
  </table>

  <p>El documento del CDC («Writing S.M.A.R.T. Objectives») cambia una letra: alli la
     <b>R</b> es <?php hueco(15, 16); ?> , es decir, que el objetivo aborde con
     precision el alcance real del problema.</p>

  <?php mc('m5'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. La S: las seis preguntas para ser especifico</h2>
  <p>Al concretar un objetivo hay que responder «las cinco W y una H». Escribelas
     (en ingles o en castellano):</p>

  <table class="datos">
    <tr><th>Pregunta</th><th>Que hay que decidir</th></tr>
    <tr><td><?php hueco(6, 12); ?></td><td>Quien necesita estar involucrado para lograrlo</td></tr>
    <tr><td><?php hueco(7, 12); ?></td><td>Que quieres lograr exactamente; hay que ser muy detallado</td></tr>
    <tr><td><?php hueco(8, 12); ?></td><td>El marco de tiempo (aunque esto lo cubre sobre todo la T)</td></tr>
    <tr><td><?php hueco(9, 12); ?></td><td>El lugar o el evento relevante, si lo hay</td></tr>
    <tr><td><?php hueco(10, 12); ?></td><td>Los obstaculos o requisitos relacionados; ayuda a decidir si es realista</td></tr>
    <tr><td><?php hueco(11, 12); ?></td><td>La razon del objetivo: avance de la empresa, desarrollo de carrera&hellip;</td></tr>
  </table>

  <div class="nota">
    <b>Los verbos.</b> Los tipos de objetivo mas comunes son: <em>aumentar</em> algo,
    <em>hacer</em> algo, <em>mejorar</em> algo, <em>reducir</em> algo, <em>ahorrar</em> algo
    y <em>desarrollar</em> a alguien (&iexcl;a ti mismo!). Y la guia trae una lista de verbos
    para empezar: <code>Oversee · Coordinate · Supervise · Manage · Plan · Support ·
    Transition · Update · Upgrade · Develop · Create · Implement · Evaluate · Produce ·
    Write · Process · Provide · Maintain · Reconcile · Direct · Administer</code>.
  </div>

  <?php mc('m3'); ?>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. La M: medir de verdad</h2>
  <p>Los metodos de medicion pueden ser <?php hueco(12, 18); ?>
     (resultados de productividad, dinero ahorrado o ganado&hellip;) y tambien
     <?php hueco(13, 18); ?> (testimonios de clientes, encuestas&hellip;).</p>

  <p>Si el objetivo va a tardar varios meses, se fijan
     <?php hueco(14, 16); ?> : una serie de pasos intermedios que, sumados,
     dan por completado el objetivo principal.</p>

  <table class="datos">
    <tr><th>Tipos de dato</th><th>Metodos de recoleccion</th></tr>
    <tr><td>Tasas de calidad / exactitud</td><td>Informes automatizados</td></tr>
    <tr><td>Cantidades producidas</td><td>Auditorias, pruebas</td></tr>
    <tr><td>Ingresos generados</td><td>Encuestas</td></tr>
    <tr><td>Tasas de productividad</td><td>Productos de trabajo, muestras</td></tr>
    <tr><td>Satisfaccion del cliente</td><td>Otros documentos</td></tr>
  </table>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. La estructura de un objetivo bien escrito</h2>
  <p>Un objetivo bien escrito responde a cuatro preguntas. Completa la plantilla del CDC:</p>

  <div class="lineabox">
    <div class="pista">Plantilla: <em>«[ &nbsp; ] will conduct intervention resulting in
      [ &nbsp; ] and [ &nbsp; ] by [ &nbsp; ]»</em></div>
  </div>

  <table class="datos">
    <tr><th>Hueco</th><th>Que va ahi</th></tr>
    <tr><td><?php hueco(17, 12); ?></td><td>Quien se vera impactado por el resultado, o quien puede ejecutarlo</td></tr>
    <tr><td><?php hueco(18, 12); ?></td><td>Cual es el resultado deseado</td></tr>
    <tr><td><?php hueco(19, 12); ?></td><td>En cuanto quieres que cambie ese resultado</td></tr>
    <tr><td><?php hueco(20, 12); ?></td><td>Cuando ocurrira</td></tr>
  </table>

  <p>Al pasar a limpio el objetivo, la plantilla final pide tres cosas: la
     <b>descripcion</b>, el <b>milestone</b> (el hito intermedio) y la
     <?php hueco(16, 18); ?> , es decir la fecha en que vence del todo.</p>

  <div class="avisoflujo">
    <b>Ejemplo completo.</b> <em>Descripcion:</em> mejorar la experiencia del cliente en
    movil es una iniciativa clave este ano, asi que vamos a crear una app; al final del ano
    fiscal debe tener 50.000 instalaciones y una tasa de conversion del 5 %; se desarrolla
    en casa y se lanza a finales de junio con campana de marketing hasta fin de ano.<br>
    <em>Milestone:</em> la app se lanza a finales de junio. &nbsp;·&nbsp;
    <em>Deadline:</em> fin del ano fiscal.
  </div>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Estadistica/index.php', '../ML/index.php');
