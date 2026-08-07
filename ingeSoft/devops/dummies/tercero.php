<?php
/*
    Preguntas de opción múltiple sobre el Capítulo 3: Adopción de DevOps.

    - Respeta la estructura del modelo base: mismos <link> de estilos
      (bootstrap.min.css y style_2_0.css), mismos contenedores
      (.form-container, .seccion.izquierda / .seccion.derecha) y el
      mismo enlace final "Siguiente" dentro de .centered-container.
    - Cada pregunta se puede validar de forma INDIVIDUAL: cada una
      tiene su propio botón "Verificar" que envía solo esa respuesta
      por AJAX (fetch) y el servidor responde en JSON solo con el
      resultado de esa pregunta, sin recargar ni revisar las demás.
    - También se conserva el envío completo del formulario (botones
      "Enviar" por bloque y "Mostrar Solución"), igual que en el
      modelo base.

    FIX: el <form action="..."> ya no apunta a un nombre de archivo
    fijo (que podía no coincidir con el nombre real del archivo en el
    servidor, causando 404 al enviar/verificar). Ahora usa
    $_SERVER['PHP_SELF'], que siempre apunta al propio archivo sin
    importar cómo se llame o en qué carpeta esté.
*/

$preguntas = [

    1 => [
        'seccion' => 'Idea principal del capítulo',
        'texto'   => '¿Cuáles son los tres elementos fundamentales para la adopción de DevOps?',
        'opciones' => [
            'a' => 'Personas, Procesos y Tecnología',
            'b' => 'Código, Pruebas y Despliegue',
            'c' => 'Planificación, Ejecución y Control',
            'd' => 'Velocidad, Estabilidad y Seguridad',
        ],
        'correcta' => 'a',
    ],
    2 => [
        'seccion' => 'Idea principal del capítulo',
        'texto'   => 'Según el capítulo, DevOps es...',
        'opciones' => [
            'a' => 'Solamente una herramienta de software',
            'b' => 'Una transformación organizacional que combina cultura, procesos y tecnología',
            'c' => 'Un lenguaje de programación',
            'd' => 'Una metodología exclusiva para equipos de operaciones',
        ],
        'correcta' => 'b',
    ],

    3 => [
        'seccion' => '¿Por dónde comenzar con DevOps?',
        'texto'   => '¿Qué debe definir una organización antes de implementar DevOps?',
        'opciones' => [
            'a' => 'El presupuesto anual de TI',
            'b' => 'El proveedor de nube que usará',
            'c' => 'Qué problemas desea resolver, qué resultados espera obtener y cómo medirá el éxito',
            'd' => 'El número exacto de servidores físicos necesarios',
        ],
        'correcta' => 'c',
    ],
    4 => [
        'seccion' => '¿Por dónde comenzar con DevOps?',
        'texto'   => '¿Cuáles son los tres tipos de cuellos de botella del pipeline mencionados en el capítulo?',
        'opciones' => [
            'a' => 'Errores de código, falta de pruebas y mala documentación',
            'b' => 'Sobrecarga innecesaria, trabajo repetido (rework) y sobreproducción',
            'c' => 'Falta de presupuesto, de personal y de tiempo',
            'd' => 'Bugs, vulnerabilidades y deuda técnica',
        ],
        'correcta' => 'b',
    ],

    5 => [
        'seccion' => 'Personas en DevOps',
        'texto'   => 'DevOps es principalmente...',
        'opciones' => [
            'a' => 'Un cambio cultural',
            'b' => 'Una herramienta de automatización',
            'c' => 'Un lenguaje de scripting',
            'd' => 'Un producto comercial específico',
        ],
        'correcta' => 'a',
    ],
    6 => [
        'seccion' => 'Personas en DevOps',
        'texto'   => 'En el modelo tradicional, ¿qué prioriza el equipo de Operaciones?',
        'opciones' => [
            'a' => 'Velocidad',
            'b' => 'Nuevas funcionalidades',
            'c' => 'Estabilidad',
            'd' => 'Experimentación',
        ],
        'correcta' => 'c',
    ],
    7 => [
        'seccion' => 'Personas en DevOps',
        'texto'   => 'En el modelo DevOps, ¿qué comparten Desarrollo y Operaciones?',
        'opciones' => [
            'a' => 'La responsabilidad de entregar nuevas capacidades rápidamente y de forma segura',
            'b' => 'El mismo presupuesto exclusivamente',
            'c' => 'La misma oficina física',
            'd' => 'El mismo horario de trabajo',
        ],
        'correcta' => 'a',
    ],
    8 => [
        'seccion' => 'Personas en DevOps',
        'texto'   => '¿Cómo se puede medir la cultura DevOps según el capítulo?',
        'opciones' => [
            'a' => 'Con el número de líneas de código escritas',
            'b' => 'Con encuestas, comunicación entre equipos y colaboración directa para resolver problemas',
            'c' => 'Con el tiempo de actividad (uptime) del servidor',
            'd' => 'No es posible medirla de ninguna forma',
        ],
        'correcta' => 'b',
    ],
    9 => [
        'seccion' => 'Personas en DevOps',
        'texto'   => 'Un equipo DevOps separado debe actuar como...',
        'opciones' => [
            'a' => 'Dueño exclusivo de DevOps',
            'b' => 'Una nueva capa burocrática',
            'c' => 'Centro de excelencia',
            'd' => 'Reemplazo del equipo de operaciones',
        ],
        'correcta' => 'c',
    ],
    10 => [
        'seccion' => 'Personas en DevOps',
        'texto'   => 'En el modelo NoOps...',
        'opciones' => [
            'a' => 'No existe ningún equipo de operaciones en la empresa',
            'b' => 'Un mismo equipo administra desarrollo y operación',
            'c' => 'Las operaciones siempre se subcontratan',
            'd' => 'Solo existe el equipo de desarrollo',
        ],
        'correcta' => 'b',
    ],

    11 => [
        'seccion' => 'Procesos en DevOps',
        'texto'   => 'El objetivo de la Gestión de Cambios (Change Management) es...',
        'opciones' => [
            'a' => 'Eliminar todos los cambios posibles en el sistema',
            'b' => 'Aumentar la burocracia del equipo',
            'c' => 'Controlar cambios, registrar modificaciones y mantener trazabilidad',
            'd' => 'Reducir el número de desarrolladores',
        ],
        'correcta' => 'c',
    ],
    12 => [
        'seccion' => 'Procesos en DevOps',
        'texto'   => '¿Cuál de las siguientes NO es una capacidad mencionada como necesaria para la gestión de cambios?',
        'opciones' => [
            'a' => 'Gestión de elementos de trabajo',
            'b' => 'Control de acceso basado en roles',
            'c' => 'Planificación ágil e iterativa',
            'd' => 'Reducción de sueldos del equipo',
        ],
        'correcta' => 'd',
    ],

    13 => [
        'seccion' => 'Técnicas DevOps',
        'texto'   => '¿Cuál es el objetivo principal de la Integración Continua (Continuous Integration)?',
        'opciones' => [
            'a' => 'Detectar errores temprano, reducir riesgos y mejorar la colaboración',
            'b' => 'Reducir el número de servidores disponibles',
            'c' => 'Aumentar el tamaño de cada versión',
            'd' => 'Eliminar la necesidad de pruebas',
        ],
        'correcta' => 'a',
    ],
    14 => [
        'seccion' => 'Técnicas DevOps',
        'texto'   => 'La Entrega Continua (Continuous Delivery) involucra las etapas de:',
        'opciones' => [
            'a' => 'Diseño, Desarrollo y Marketing',
            'b' => 'Pruebas, Staging y Producción',
            'c' => 'Planificación, Presupuesto y Ejecución',
            'd' => 'Análisis, Diseño y Codificación',
        ],
        'correcta' => 'b',
    ],
    15 => [
        'seccion' => 'Técnicas DevOps',
        'texto'   => '¿Qué busca la planificación de versiones según el capítulo?',
        'opciones' => [
            'a' => 'Versiones grandes, poco frecuentes e impredecibles',
            'b' => 'Una sola versión al año',
            'c' => 'Versiones pequeñas, frecuentes y predecibles',
            'd' => 'Versiones sin pasar por pruebas',
        ],
        'correcta' => 'c',
    ],

    16 => [
        'seccion' => 'Tecnología en DevOps',
        'texto'   => 'La tecnología en DevOps permite principalmente...',
        'opciones' => [
            'a' => 'Automatización, reutilización, escalabilidad y consistencia',
            'b' => 'Reducir el número de empleados de la empresa',
            'c' => 'Eliminar por completo la necesidad de pruebas',
            'd' => 'Sustituir completamente a las personas',
        ],
        'correcta' => 'a',
    ],
    17 => [
        'seccion' => 'Tecnología en DevOps',
        'texto'   => 'Infraestructura como Código (IaC) permite administrar mediante código...',
        'opciones' => [
            'a' => 'Únicamente el código fuente de la aplicación',
            'b' => 'Solo las bases de datos',
            'c' => 'Aprovisionamiento, configuración y creación de ambientes',
            'd' => 'Solo la facturación en la nube',
        ],
        'correcta' => 'c',
    ],
    18 => [
        'seccion' => 'Tecnología en DevOps',
        'texto'   => '¿Cuál es una limitación de las herramientas de Tipo 1 (centradas en aplicación/middleware)?',
        'opciones' => [
            'a' => 'No pueden automatizar absolutamente nada',
            'b' => 'No realizan tareas de bajo nivel como configurar el sistema operativo',
            'c' => 'Solo funcionan en la nube pública',
            'd' => 'Requieren hardware especializado',
        ],
        'correcta' => 'b',
    ],
    19 => [
        'seccion' => 'Tecnología en DevOps',
        'texto'   => '¿Qué ejemplo se menciona de herramienta de entorno y despliegue (Tipo 2)?',
        'opciones' => [
            'a' => 'IBM UrbanCode Deploy with Patterns',
            'b' => 'Jenkins',
            'c' => 'Docker',
            'd' => 'Kubernetes',
        ],
        'correcta' => 'a',
    ],
    20 => [
        'seccion' => 'Tecnología en DevOps',
        'texto'   => 'Según el capítulo, ¿cuál es la ventaja principal de las herramientas genéricas (Tipo 3)?',
        'opciones' => [
            'a' => 'Requieren menos trabajo inicial',
            'b' => 'Son siempre gratuitas',
            'c' => 'Mayor flexibilidad',
            'd' => 'No requieren scripts',
        ],
        'correcta' => 'c',
    ],

    21 => [
        'seccion' => 'Pipeline de entrega',
        'texto'   => '¿Cuáles son las etapas del pipeline de entrega mencionadas en el capítulo?',
        'opciones' => [
            'a' => 'Diseño, Codificación y Documentación',
            'b' => 'Compra, Instalación y Configuración',
            'c' => 'Análisis, Requisitos y Mantenimiento',
            'd' => 'Entorno de desarrollo, Build, Repositorio de paquetes, Entorno de pruebas, Staging y producción',
        ],
        'correcta' => 'd',
    ],

    22 => [
        'seccion' => 'Automatización y gestión de versiones',
        'texto'   => '¿Qué herramienta se menciona como ejemplo de automatización de despliegue?',
        'opciones' => [
            'a' => 'Terraform',
            'b' => 'IBM UrbanCode Deploy',
            'c' => 'Ansible',
            'd' => 'Chef',
        ],
        'correcta' => 'b',
    ],
    23 => [
        'seccion' => 'Automatización y gestión de versiones',
        'texto'   => '¿Qué herramienta se menciona como ejemplo de gestión de versiones (Release Management)?',
        'opciones' => [
            'a' => 'Git',
            'b' => 'SVN',
            'c' => 'IBM UrbanCode Release',
            'd' => 'Bitbucket',
        ],
        'correcta' => 'c',
    ],
];

$total_preguntas = count($preguntas);

/* ------------------------------------------------------------------
   Verificación INDIVIDUAL (AJAX): responde solo con el resultado de
   una pregunta, sin tocar el resto del formulario ni recargar la
   página. Se detecta por la presencia de 'verificar_individual'.
------------------------------------------------------------------ */
if (isset($_POST['verificar_individual'])) {
    $pid = (int) $_POST['verificar_individual'];
    header('Content-Type: application/json; charset=utf-8');

    if (!isset($preguntas[$pid])) {
        echo json_encode(['pid' => $pid, 'estado' => 'error']);
        exit;
    }

    $campo = 'respuesta_' . $pid;
    $valor = isset($_POST[$campo]) ? $_POST[$campo] : '';

    if ($valor === '') {
        $estado = '';
    } elseif ($valor === $preguntas[$pid]['correcta']) {
        $estado = 'correcto';
    } else {
        $estado = 'incorrecto';
    }

    echo json_encode(['pid' => $pid, 'estado' => $estado]);
    exit;
}

/* ------------------------------------------------------------------
   Envío completo del formulario (botones "Enviar" y "Mostrar Solución")
------------------------------------------------------------------ */
$respuesta = [];
$verificar = [];
foreach ($preguntas as $pid => $p) {
    $respuesta[$pid] = '';
    $verificar[$pid] = '';
}

$mostrar_solucion = '';

if ($_POST) {
    $mostrar_solucion = isset($_POST['mostrar_solucion']) ? $_POST['mostrar_solucion'] : '';

    if ($mostrar_solucion === 'mostrar_solucion') {
        foreach ($preguntas as $pid => $p) {
            $respuesta[$pid] = $p['correcta'];
            $verificar[$pid] = 'correcto';
        }
    } else {
        foreach ($preguntas as $pid => $p) {
            $campo = 'respuesta_' . $pid;
            $valor = isset($_POST[$campo]) ? $_POST[$campo] : '';
            $respuesta[$pid] = $valor;

            if ($valor === '') {
                $verificar[$pid] = '';
            } elseif ($valor === $p['correcta']) {
                $verificar[$pid] = 'correcto';
            } else {
                $verificar[$pid] = 'incorrecto';
            }
        }
    }
}

$puntaje = 0;
foreach ($verificar as $v) {
    if ($v === 'correcto') {
        $puntaje++;
    }
}

function etiqueta_verificacion($estado)
{
    if ($estado === 'correcto') {
        return '<span class="resultado correcto">&#10004; Correcto</span>';
    } elseif ($estado === 'incorrecto') {
        return '<span class="resultado incorrecto">&#10008; Incorrecto</span>';
    }
    return '<span class="resultado pendiente"></span>';
}

// Agrupar ids de preguntas por sección, preservando el orden de aparición
$secciones = [];
foreach ($preguntas as $pid => $p) {
    $secciones[$p['seccion']][] = $pid;
}

// Distribución de secciones en las dos columnas del modelo base
// (izquierda / derecha), balanceando aproximadamente el número de preguntas
$columna_izquierda = [
    'Idea principal del capítulo',
    '¿Por dónde comenzar con DevOps?',
    'Personas en DevOps',
    'Procesos en DevOps',
];
$columna_derecha = [
    'Técnicas DevOps',
    'Tecnología en DevOps',
    'Pipeline de entrega',
    'Automatización y gestión de versiones',
];

/**
 * Imprime los bloques de secciones indicados, cada pregunta con su
 * propio botón "Verificar" (validación individual) y cada bloque de
 * sección con un botón "Enviar" (validación de todo el formulario),
 * igual que en el modelo base.
 */
function imprimir_secciones($lista_secciones, $secciones, $preguntas, $respuesta, $verificar)
{
    foreach ($lista_secciones as $nombre_seccion) {
        if (empty($secciones[$nombre_seccion])) {
            continue;
        }
        echo '<div class="tabla-bloque">';
        echo '<h3>' . htmlspecialchars($nombre_seccion) . '</h3>';

        foreach ($secciones[$nombre_seccion] as $pid) {
            $p = $preguntas[$pid];
            echo '<div class="pregunta" id="pregunta_' . $pid . '">';
            echo '  <p class="enunciado">' . $pid . '. ' . htmlspecialchars($p['texto']) . '</p>';

            foreach ($p['opciones'] as $clave => $texto_opcion) {
                $checked = ($respuesta[$pid] === $clave) ? 'checked' : '';
                echo '  <label class="opcion">';
                echo '    <input type="radio" name="respuesta_' . $pid . '" value="' . $clave . '" ' . $checked . '>';
                echo '    ' . strtoupper($clave) . ') ' . htmlspecialchars($texto_opcion);
                echo '  </label>';
            }

            echo '  <button type="button" class="btn-verificar" onclick="verificarPregunta(' . $pid . ')">Verificar</button>';
            echo '  <span id="resultado_' . $pid . '">' . etiqueta_verificacion($verificar[$pid]) . '</span>';
            echo '</div>';
        }

        echo '<button type="submit">Enviar</button>';
        echo '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas: Capítulo 3 - Adopción de DevOps</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../style_2_0.css">

    <style>
        body {
    min-height: 300vh; /* o el valor que quieras, en px, vh, etc. */
}
        .seccion {
            width: calc(50% - 7.5px);
            padding: 20px;
            box-sizing: border-box;
         }
        .tabla-bloque {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 16px;
            background: #fafafa;
        }
        .tabla-bloque h3 {
            margin-top: 0;
        }
        .pregunta {
            margin: 14px 0;
        }
        .pregunta p.enunciado {
            font-weight: bold;
            margin-bottom: 6px;
        }
        .opcion {
            display: block;
            margin: 3px 0 3px 12px;
        }
        .btn-verificar {
            margin-top: 6px;
        }
        .resultado {
            font-weight: bold;
            margin-left: 8px;
        }
        .resultado.correcto {
            color: #1a7f37;
        }
        .resultado.incorrecto {
            color: #c62828;
        }
        .resultado.pendiente {
            color: transparent;
        }
        .puntaje {
            font-size: 1.1em;
            font-weight: bold;
            margin: 10px 0 20px;
        }
    </style>

    <script>
        // Envío completo del formulario: botones "Enviar" por bloque
        // y "Mostrar Solución"
        function handleSubmit(event) {
            event.preventDefault();
            const formData = new FormData(event.target);

            fetch(event.target.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(html => {
                document.open();
                document.write(html);
                document.close();
            })
            .catch(error => {
                console.error('Error al enviar el formulario:', error);
            });
        }

        // Validación individual de una sola pregunta (AJAX)
        function verificarPregunta(pid) {
            const form = document.querySelector('form');
            const seleccionada = form.querySelector('input[name="respuesta_' + pid + '"]:checked');
            const valor = seleccionada ? seleccionada.value : '';

            const formData = new FormData();
            formData.append('verificar_individual', pid);
            formData.append('respuesta_' + pid, valor);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const contenedor = document.getElementById('resultado_' + data.pid);
                if (!contenedor) return;

                if (data.estado === 'correcto') {
                    contenedor.innerHTML = '<span class="resultado correcto">&#10004; Correcto</span>';
                } else if (data.estado === 'incorrecto') {
                    contenedor.innerHTML = '<span class="resultado incorrecto">&#10008; Incorrecto</span>';
                } else {
                    contenedor.innerHTML = '<span class="resultado pendiente"></span>';
                }
            })
            .catch(error => {
                console.error('Error al verificar la pregunta:', error);
            });
        }
    </script>
</head>
<body>

<h1>Capítulo 3: Adopción de DevOps</h1>
<p>Preguntas de opción múltiple sobre los conceptos del capítulo.</p>

<?php if ($_POST && $mostrar_solucion !== 'mostrar_solucion' && !isset($_POST['verificar_individual'])): ?>
    <div class="puntaje">Puntaje: <?php echo $puntaje; ?> / <?php echo $total_preguntas; ?></div>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="handleSubmit(event)" autocomplete="off">
<div class="form-container">

    <div class="seccion izquierda">
        <?php imprimir_secciones($columna_izquierda, $secciones, $preguntas, $respuesta, $verificar); ?>
    </div>

    <div class="seccion derecha">
        <?php imprimir_secciones($columna_derecha, $secciones, $preguntas, $respuesta, $verificar); ?>

        <hr>
        <strong>si desea ver las soluciones escribir: mostrar_solucion</strong>
        <br>
        <input type="text" id="mostrar_solucion" name="mostrar_solucion" value="<?php echo htmlspecialchars($mostrar_solucion); ?>">
        <button type="submit">Mostrar Solución</button>
    </div>

</div>
</form>

<div class="centered-container">
    <a
        name="siguiente"
        id="siguiente"
        class="btn btn-primary"
        href="segundo.php"
        role="button"
        width="50px"
        height="50px"
    >Siguiente</a>
</div>

</body>
</html>