<?php
 
for ($i = 1; $i <= 230; $i++) {
    ${"respuesta_" . $i} = '';
}
 

     
for ($i = 1; $i <= 230; $i++) {
    ${"verificar_" . $i} = '';
}

     

$mostrar_solucion = ''; 
if ($_POST) {
    $mostrar_solucion = isset($_POST['mostrar_solucion']) ? $_POST['mostrar_solucion'] : '';
    
    if ($mostrar_solucion === 'mostrar_solucion') {        
 
          // ============================================================
    // Respuestas correctas según las validaciones del else (preguntas 1 a 134)
    // ============================================================
    $respuesta_1   = 'un master lanza workers';
    $respuesta_2   = 'solicitan tareas al master';
    $respuesta_3   = 'una tarea es asignada a un worker';
    $respuesta_4   = 'procesa la tarea';
    $respuesta_5   = 'retorna el resultado al master';
    $respuesta_6   = 'el worker termina';
    $respuesta_7   = 'procesar su tarea actual';
    $respuesta_8   = 'solicitara una nueva tarea al master hasta';
    $respuesta_9   = 'todas las tareas hayan sido procesadas';
    $respuesta_10  = 'entonces el master apagara todos los workers';
    $respuesta_11  = 'han sido procesadas';
    $respuesta_12  = 'master procesa los resultados parciales recolectados';
    $respuesta_13  = 'retorna el resultado final';
    $respuesta_14  = 'el master apaga todos los workers';
    $respuesta_15  = 'retornan sus resultados al master';
    $respuesta_16  = 'estructura de datos compartida';
    $respuesta_17  = 'acumular los resultados parciales';
    $respuesta_18  = 'condicion de terminación normalmente';
    $respuesta_19  = 'cumple';
    $respuesta_20  = 'todas las tareas estan completas';
    $respuesta_21  = 'problemas cuyo resultado final';
    $respuesta_22  = 'obtenerse antes de que todas las tareas hayan finalizado';
    $respuesta_23  = 'no todas las tareas son conocidas inicialmente';
    $respuesta_24  = 'Master';
    $respuesta_25  = 'Worker';
    $respuesta_26  = 'create_tasks()';
    $respuesta_27  = 'launch_workers()';
    $respuesta_28  = 'request_task()';
    $respuesta_29  = 'getTask()';
    $respuesta_30  = 'process_task()';
    $respuesta_31  = 'addPartialResult(Object)';
    $respuesta_32  = 'processPartialResult()';
    $respuesta_33  = 'shutdown_workers()';
    $respuesta_34  = 'las tareas complejas';
    $respuesta_35  = 'dividirse en tareas mas simples';
    $respuesta_36  = 'particion';
    $respuesta_37  = 'realizarse basandose';
    $respuesta_38  = 'analisis de dependencias';
    $respuesta_39  = 'tareas y datos compartidos';
    $respuesta_40  = 'patron facilita';
    $respuesta_41  = 'descomposicion eliminando dependencias';
    $respuesta_42  = 'tareas simples mediante';
    $respuesta_43  = 'Replicacion de datos globales';
    $respuesta_44  = 'Combinacion';
    $respuesta_45  = 'resultados individuales';
    $respuesta_46  = 'tareas en calculos globales';
    $respuesta_47  = 'forma de abordar la concurrencia';
    $respuesta_48  = 'mediante algoritmos basados en tareas';
    $respuesta_49  = 'estos algoritmos tienen dos desafios principales';
    $respuesta_50  = 'Distribuir las tareas entre nodos de procesamiento';
    $respuesta_51  = 'Gestionar las dependencias entre tareas';
    $respuesta_52  = 'incluyendo el uso de recursos';
    $respuesta_53  = 'abordarse por separado';
    $respuesta_54  = 'las dependencias pueden aislarse';
    $respuesta_55  = 'conjunto de tareas concurrentes';
    $respuesta_56  = 'permitiendo aprovechar la concurrencia';
    $respuesta_57  = 'utilizarse cuando el problema';
    $respuesta_58  = 'resolverse con un conjunto';
    $respuesta_59  = 'tareas concurrentes donde';
    $respuesta_60  = 'Solo una o ninguna';
    $respuesta_61  = 'tareas modifica los datos globales';
    $respuesta_62  = 'las demas tareas solo necesitan su valor inicial';
    $respuesta_63  = 'datos replicados';
    $respuesta_64  = 'resultado final puede construirse';
    $respuesta_65  = 'combinacion de resultados';
    $respuesta_66  = 'tareas independientes';
    $respuesta_67  = 'Eliminacion de dependencias entre tareas';
    $respuesta_68  = 'Separar';
    $respuesta_69  = 'dependencias';
    $respuesta_70  = 'resolver';
    $respuesta_71  = 'compartir';
    $respuesta_72  = 'permite';
    $respuesta_73  = 'concurrencia';
    $respuesta_74  = 'las tareas se clasifican';
    $respuesta_75  = 'ejecutarse al mismo tiempo';
    $respuesta_76  = 'aquellas que necesitan esperar';
    $respuesta_77  = 'que otras tareas finalicen';
    $respuesta_78  = 'mecanismo';
    $respuesta_79  = 'permita compartir datos';
    $respuesta_80  = 'tareas concurrentes';
    $respuesta_81  = 'mediante replicacion';
    $respuesta_82  = 'no todos los problemas';
    $respuesta_83  = 'Master';
    $respuesta_84  = '-queue: Queue <<Task>>';
    $respuesta_85  = '-globalResult: DataMergedStructure';
    $respuesta_86  = '-workers: ThreadPool';
    $respuesta_87  = '+create_tasks(): void';
    $respuesta_88  = '+launch_workers(): void';
    $respuesta_89  = '+separateDependencies(): void';
    $respuesta_90  = '+getTask(): Task';
    $respuesta_91  = '+addPartialResult(Object): void';
    $respuesta_92  = '+processResults(): void';
    $respuesta_93  = '+shutdown_workers(): void';
    $respuesta_94  = 'Task';
    $respuesta_95  = '-data: Data';
    $respuesta_96  = '+createTask(Data): Task';
    $respuesta_97  = '1';
    $respuesta_98  = '1..*';
    $respuesta_99  = 'Worker';
    $respuesta_100 = '-requestTask(): Task';
    $respuesta_101 = '+processTask(Task): void';
    $respuesta_102 = '1';
    $respuesta_103 = '1..*';
    $respuesta_104 = 'Master';
    $respuesta_105 = 'mismas responsabilidades';
    $respuesta_106 = 'proceso adicional que realizar';
    $respuesta_107 = 'crear nuevas tareas';
    $respuesta_108 = 'los datos replicados';
    $respuesta_109 = 'Worker';
    $respuesta_110 = 'mismas responsabilidades';
    $respuesta_111 = 'Task';
    $respuesta_112 = 'responsable';
    $respuesta_113 = 'definir y crear';
    $respuesta_114 = 'tareas independientes basadas';
    $respuesta_115 = 'replicacion';
    $respuesta_116 = 'datos necesarios';
    $respuesta_117 = 'ejecutar cada una de ellas';
    $respuesta_118 = 'definidos previamente';
    $respuesta_119 = 'el Master';
    $respuesta_120 = 'diferencia';
    $respuesta_121 = 'Task';
    $respuesta_122 = 'Master';
    $respuesta_123 = 'dos funciones';
    $respuesta_124 = 'Definir la funcionalidad de la tarea';
    $respuesta_125 = 'Replicar los datos requeridos';
    $respuesta_126 = 'definira los datos para cada tarea';
    $respuesta_127 = 'separateDependencies():void';
    $respuesta_128 = 'createTask(Data):Task';
    $respuesta_129 = 'launchWorkers():void';
    $respuesta_130 = 'requestTask():Task';
    $respuesta_131 = 'getTask():Task';
    $respuesta_132 = 'processTask(Task):void';
    $respuesta_133 = 'addPartialResult(Object):void';
    $respuesta_134 = 'shutdownWorkers():void';
        
        // Marcar todas como correctas
    for ($i = 1; $i <= 122; $i++) {
    ${"verificar_$i"} = "correcto";
    }

    } else {
    $respuesta_1 = isset($_POST['respuesta_1']) ? $_POST['respuesta_1'] : '';
   if ($respuesta_1 === 'un master lanza workers') {  
       $verificar_1 = "correcto";
   } elseif ($respuesta_1 === '') {
       $verificar_1 = '';
   } else {
       $verificar_1 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_2 = isset($_POST['respuesta_2']) ? $_POST['respuesta_2'] : '';
   if ($respuesta_2 === 'solicitan tareas al master') {  
       $verificar_2 = "correcto";
   } elseif ($respuesta_2 === '') {
       $verificar_2 = '';
   } else {
       $verificar_2 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_3 = isset($_POST['respuesta_3']) ? $_POST['respuesta_3'] : '';
   if ($respuesta_3 === 'una tarea es asignada a un worker') {  
       $verificar_3 = "correcto";
   } elseif ($respuesta_3 === '') {
       $verificar_3 = '';
   } else {
       $verificar_3 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_4 = isset($_POST['respuesta_4']) ? $_POST['respuesta_4'] : '';
   if ($respuesta_4 === 'procesa la tarea') {  
       $verificar_4 = "correcto";
   } elseif ($respuesta_4 === '') {
       $verificar_4 = '';
   } else {
       $verificar_4 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_5 = isset($_POST['respuesta_5']) ? $_POST['respuesta_5'] : '';
   if ($respuesta_5 === 'retorna el resultado al master') {  
       $verificar_5 = "correcto";
   } elseif ($respuesta_5 === '') {
       $verificar_5 = '';
   } else {
       $verificar_5 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_6 = isset($_POST['respuesta_6']) ? $_POST['respuesta_6'] : '';
   if ($respuesta_6 === 'el worker termina') {  
       $verificar_6 = "correcto";
   } elseif ($respuesta_6 === '') {
       $verificar_6 = '';
   } else {
       $verificar_6 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_7 = isset($_POST['respuesta_7']) ? $_POST['respuesta_7'] : '';
   if ($respuesta_7 === 'procesar su tarea actual') {  
       $verificar_7 = "correcto";
   } elseif ($respuesta_7 === '') {
       $verificar_7 = '';
   } else {
       $verificar_7 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_8 = isset($_POST['respuesta_8']) ? $_POST['respuesta_8'] : '';
   if ($respuesta_8 === 'solicitara una nueva tarea al master hasta') {  
       $verificar_8 = "correcto";
   } elseif ($respuesta_8 === '') {
       $verificar_8 = '';
   } else {
       $verificar_8 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_9 = isset($_POST['respuesta_9']) ? $_POST['respuesta_9'] : '';
   if ($respuesta_9 === 'todas las tareas hayan sido procesadas') {  
       $verificar_9 = "correcto";
   } elseif ($respuesta_9 === '') {
       $verificar_9 = '';
   } else {
       $verificar_9 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_10 = isset($_POST['respuesta_10']) ? $_POST['respuesta_10'] : '';
   if ($respuesta_10 === 'entonces el master apagara todos los workers') {  
       $verificar_10 = "correcto";
   } elseif ($respuesta_10 === '') {
       $verificar_10 = '';
   } else {
       $verificar_10 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_11 = isset($_POST['respuesta_11']) ? $_POST['respuesta_11'] : '';
   if ($respuesta_11 === 'han sido procesadas') {  
       $verificar_11 = "correcto";
   } elseif ($respuesta_11 === '') {
       $verificar_11 = '';
   } else {
       $verificar_11 = "incorrecto";
   }


    // Verificar la respuesta de la primera pregunta
    $respuesta_12 = isset($_POST['respuesta_12']) ? $_POST['respuesta_12'] : '';
    if ($respuesta_12 === 'master procesa los resultados parciales recolectados') {  
        $verificar_12 = "correcto";
    } elseif ($respuesta_12 === '') {
        $verificar_12 = '';
    } else {
        $verificar_12 = "incorrecto";
    }
  
    // Verificar la respuesta de la segunda pregunta
    $respuesta_13 = isset($_POST['respuesta_13']) ? $_POST['respuesta_13'] : '';
    if ($respuesta_13 === 'retorna el resultado final') { 
        $verificar_13 = "correcto";
    } elseif ($respuesta_13 === '') {
        $verificar_13 = '';
    } else {
         $verificar_13 = "incorrecto";
    }
  
    // Verificar la respuesta de la tercera pregunta
    $respuesta_14 = isset($_POST['respuesta_14']) ? $_POST['respuesta_14'] : '';
    if ($respuesta_14 === 'el master apaga todos los workers') {  
        $verificar_14 = "correcto";
    } elseif ($respuesta_14 === '') {
        $verificar_14 = '';
    } else {
        $verificar_14 = "incorrecto";
    }
  
    // Verificar la respuesta de la cuarta pregunta
    $respuesta_15 = isset($_POST['respuesta_15']) ? $_POST['respuesta_15'] : '';
    if ($respuesta_15 === 'retornan sus resultados al master') { 
        $verificar_15 = "correcto";
    } elseif ($respuesta_15 === '') {
        $verificar_15 = '';
    } else {
        $verificar_15 = "incorrecto";
    }
  
    // Verificar la respuesta de la quinta pregunta
    $respuesta_16 = isset($_POST['respuesta_16']) ? $_POST['respuesta_16'] : '';
    if ($respuesta_16 === 'estructura de datos compartida') {  
        $verificar_16 = "correcto";
    } elseif ($respuesta_16 === '') {
        $verificar_16 = '';
    } else {
        $verificar_16 = "incorrecto";
    }
  
    // Verificar la respuesta de la sexta pregunta
    $respuesta_17 = isset($_POST['respuesta_17']) ? $_POST['respuesta_17'] : '';
    if ($respuesta_17 === 'acumular los resultados parciales') {  
        $verificar_17 = "correcto";
        } elseif ($respuesta_17 === '') {
        $verificar_17 = '';
    } else {
        $verificar_17 = "incorrecto";
    }
  
    // Verificar la respuesta de la séptima pregunta
    $respuesta_18 = isset($_POST['respuesta_18']) ? $_POST['respuesta_18'] : '';
    if ($respuesta_18 === 'condicion de terminacion normalmente') {  
        $verificar_18 = "correcto";
    } elseif ($respuesta_18 === '') {
        $verificar_18 = '';
    } else {
        $verificar_18 = "incorrecto";
    }
  
    // Verificar la respuesta de la octava pregunta
    $respuesta_19 = isset($_POST['respuesta_19']) ? $_POST['respuesta_19'] : '';
    if ($respuesta_19 === 'cumple') {  
        $verificar_19 = "correcto";
    } elseif ($respuesta_19 === '') {
        $verificar_19 = '';
    } else {
        $verificar_19 = "incorrecto";
    }
  
    // Verificar la respuesta de la novena pregunta
    $respuesta_20 = isset($_POST['respuesta_20']) ? $_POST['respuesta_20'] : '';
    if ($respuesta_20 === 'todas las tareas estan completas') {  
        $verificar_20 = "correcto";
    } elseif ($respuesta_20 === '') {
        $verificar_20 = '';
    } else {
        $verificar_20 = "incorrecto";
    }
  
    // Verificar la respuesta de la décima pregunta
    $respuesta_21 = isset($_POST['respuesta_21']) ? $_POST['respuesta_21'] : '';
    if ($respuesta_21 === 'problemas cuyo resultado final') {  
         $verificar_21 = "correcto";
    } elseif ($respuesta_21 === '') {
        $verificar_21 = '';
    } else {
        $verificar_21 = "incorrecto";
    }
  
    // Verificar la respuesta de la undécima pregunta
    $respuesta_22 = isset($_POST['respuesta_22']) ? $_POST['respuesta_22'] : '';
    if ($respuesta_22 === 'obtenerse antes de que todas las tareas hayan finalizado') {  
        $verificar_22 = "correcto";
    } elseif ($respuesta_22 === '') {
        $verificar_22 = '';
    } else {
        $verificar_22 = "incorrecto";
    }

     // Verificar la respuesta de la primera pregunta
   $respuesta_23 = isset($_POST['respuesta_23']) ? $_POST['respuesta_23'] : '';
   if ($respuesta_23 === 'no todas las tareas son conocidas inicialmente') {  
       $verificar_23 = "correcto";
   } elseif ($respuesta_23 === '') {
       $verificar_23 = '';
   } else {
       $verificar_23 = "incorrecto";
   }
$respuesta_24 = isset($_POST['respuesta_24']) ? $_POST['respuesta_24'] : '';
if ($respuesta_24 === 'Master') { $verificar_24 = "correcto"; }
elseif ($respuesta_24 === '') { $verificar_24 = ''; }
else { $verificar_24 = "incorrecto"; }

$respuesta_25 = isset($_POST['respuesta_25']) ? $_POST['respuesta_25'] : '';
if ($respuesta_25 === 'Worker') { $verificar_25 = "correcto"; }
elseif ($respuesta_25 === '') { $verificar_25 = ''; }
else { $verificar_25 = "incorrecto"; }

$respuesta_26 = isset($_POST['respuesta_26']) ? $_POST['respuesta_26'] : '';
if ($respuesta_26 === 'create_tasks()') { $verificar_26 = "correcto"; }
elseif ($respuesta_26 === '') { $verificar_26 = ''; }
else { $verificar_26 = "incorrecto"; }

$respuesta_27 = isset($_POST['respuesta_27']) ? $_POST['respuesta_27'] : '';
if ($respuesta_27 === 'launch_workers()') { $verificar_27 = "correcto"; }
elseif ($respuesta_27 === '') { $verificar_27 = ''; }
else { $verificar_27 = "incorrecto"; }

$respuesta_28 = isset($_POST['respuesta_28']) ? $_POST['respuesta_28'] : '';
if ($respuesta_28 === 'request_task()') { $verificar_28 = "correcto"; }
elseif ($respuesta_28 === '') { $verificar_28 = ''; }
else { $verificar_28 = "incorrecto"; }

$respuesta_29 = isset($_POST['respuesta_29']) ? $_POST['respuesta_29'] : '';
if ($respuesta_29 === 'getTask()') { $verificar_29 = "correcto"; }
elseif ($respuesta_29 === '') { $verificar_29 = ''; }
else { $verificar_29 = "incorrecto"; }

$respuesta_30 = isset($_POST['respuesta_30']) ? $_POST['respuesta_30'] : '';
if ($respuesta_30 === 'process_task()') { $verificar_30 = "correcto"; }
elseif ($respuesta_30 === '') { $verificar_30 = ''; }
else { $verificar_30 = "incorrecto"; }

$respuesta_31 = isset($_POST['respuesta_31']) ? $_POST['respuesta_31'] : '';
if ($respuesta_31 === 'addPartialResult(Object)') { $verificar_31 = "correcto"; }
elseif ($respuesta_31 === '') { $verificar_31 = ''; }
else { $verificar_31 = "incorrecto"; }

$respuesta_32 = isset($_POST['respuesta_32']) ? $_POST['respuesta_32'] : '';
if ($respuesta_32 === 'processPartialResult()') { $verificar_32 = "correcto"; }
elseif ($respuesta_32 === '') { $verificar_32 = ''; }
else { $verificar_32 = "incorrecto"; }

$respuesta_33 = isset($_POST['respuesta_33']) ? $_POST['respuesta_33'] : '';
if ($respuesta_33 === 'shutdown_workers()') { $verificar_33 = "correcto"; }
elseif ($respuesta_33 === '') { $verificar_33 = ''; }
else { $verificar_33 = "incorrecto"; }

    $respuesta_34 = isset($_POST['respuesta_34']) ? $_POST['respuesta_34'] : '';
    if ($respuesta_34 === 'las tareas complejas') { 
        $verificar_34 = "correcto";
    } elseif ($respuesta_34 === '') {
        $verificar_34 = '';
    } else {
        $verificar_34 = "incorrecto";
    }

    $respuesta_35 = isset($_POST['respuesta_35']) ? $_POST['respuesta_35'] : '';
    if ($respuesta_35 === 'dividirse en tareas mas simples') { 
        $verificar_35 = "correcto";
    } elseif ($respuesta_35 === '') {
        $verificar_35 = '';
    } else {
        $verificar_35 = "incorrecto";
    }

    $respuesta_36 = isset($_POST['respuesta_36']) ? $_POST['respuesta_36'] : '';
    if ($respuesta_36 === 'particion') { 
        $verificar_36 = "correcto";
    } elseif ($respuesta_36 === '') {
    $verificar_36 = '';
    } else {
        $verificar_36 = "incorrecto";
    }

    $respuesta_37 = isset($_POST['respuesta_37']) ? $_POST['respuesta_37'] : '';
    if ($respuesta_37 === 'realizarse basandose') { 
        $verificar_37 = "correcto";
    } elseif ($respuesta_37 === '') {
        $verificar_37 = '';
    } else {
        $verificar_37 = "incorrecto";
    }

    $respuesta_38 = isset($_POST['respuesta_38']) ? $_POST['respuesta_38'] : '';
    if ($respuesta_38 === 'analisis de dependencias') { 
        $verificar_38 = "correcto";
    } elseif ($respuesta_38 === '') {
        $verificar_38 = '';
    } else {
        $verificar_38 = "incorrecto";
    }

    $respuesta_39 = isset($_POST['respuesta_39']) ? $_POST['respuesta_39'] : '';
    if ($respuesta_39 === 'tareas y datos compartidos') { 
        $verificar_39 = "correcto";
    } elseif ($respuesta_39 === '') {
        $verificar_39 = '';
    } else {
        $verificar_39 = "incorrecto";
    }

    $respuesta_40 = isset($_POST['respuesta_40']) ? $_POST['respuesta_40'] : '';
    if ($respuesta_40 === 'patron facilita') { 
        $verificar_40 = "correcto";
    } elseif ($respuesta_40 === '') {
        $verificar_40 = '';
    } else {
        $verificar_40 = "incorrecto";
    }

    $respuesta_41 = isset($_POST['respuesta_41']) ? $_POST['respuesta_41'] : '';
    if ($respuesta_41 === 'descomposicion eliminando dependencias') { 
        $verificar_41 = "correcto";
    } elseif ($respuesta_41 === '') {
        $verificar_41 = '';
    } else {
        $verificar_41 = "incorrecto";
    }

    $respuesta_42 = isset($_POST['respuesta_42']) ? $_POST['respuesta_42'] : '';
    if ($respuesta_42 === 'tareas simples mediante') { 
        $verificar_42 = "correcto";
    } elseif ($respuesta_42 === '') {
        $verificar_42 = '';
    } else {
        $verificar_42 = "incorrecto";
    }

    $respuesta_43 = isset($_POST['respuesta_43']) ? $_POST['respuesta_43'] : '';
    if ($respuesta_43 === 'Replicacion de datos globales') { 
        $verificar_43 = "correcto";
    } elseif ($respuesta_43 === '') {
        $verificar_43 = '';
    } else {
    $verificar_43 = "incorrecto";
    }

    $respuesta_44 = isset($_POST['respuesta_44']) ? $_POST['respuesta_44'] : '';
    if ($respuesta_44 === 'Combinacion') { 
        $verificar_44 = "correcto";
    } elseif ($respuesta_44 === '') {
    $verificar_44 = '';
    } else {
        $verificar_44 = "incorrecto";
    }

    $respuesta_45 = isset($_POST['respuesta_45']) ? $_POST['respuesta_45'] : '';
    if ($respuesta_45 === 'resultados individuales') { 
        $verificar_45 = "correcto";
    } elseif ($respuesta_45 === '') {
    $verificar_45 = '';
    } else {
        $verificar_45 = "incorrecto";
    }

    $respuesta_46 = isset($_POST['respuesta_46']) ? $_POST['respuesta_46'] : '';
    if ($respuesta_46 === 'tareas en calculos globales') { 
        $verificar_46 = "correcto";
    } elseif ($respuesta_46 === '') {
    $verificar_46 = '';
    } else {
        $verificar_46 = "incorrecto";
    }

    $respuesta_47 = isset($_POST['respuesta_47']) ? $_POST['respuesta_47'] : '';
    if ($respuesta_47 === 'forma de abordar la concurrencia') { 
        $verificar_47 = "correcto";
    } elseif ($respuesta_47 === '') {
        $verificar_47 = '';
    } else {
        $verificar_47 = "incorrecto";
    }

    $respuesta_48 = isset($_POST['respuesta_48']) ? $_POST['respuesta_48'] : '';
    if ($respuesta_48 === 'mediante algoritmos basados en tareas') { 
        $verificar_48 = "correcto";
    } elseif ($respuesta_48 === '') {
    $verificar_48 = '';
    } else {
        $verificar_48 = "incorrecto";
    }

    $respuesta_49 = isset($_POST['respuesta_49']) ? $_POST['respuesta_49'] : '';
    if ($respuesta_49 === 'estos algoritmos tienen dos desafios principales') { 
        $verificar_49 = "correcto";
    } elseif ($respuesta_49 === '') {
    $verificar_49 = '';
    } else {
        $verificar_49 = "incorrecto";
    }

    $respuesta_50 = isset($_POST['respuesta_50']) ? $_POST['respuesta_50'] : '';
    if ($respuesta_50 === 'Distribuir las tareas entre nodos de procesamiento') { 
        $verificar_50 = "correcto";
    } elseif ($respuesta_50 === '') {
    $verificar_50 = '';
    } else {
        $verificar_50 = "incorrecto";
    }

 $respuesta_51 = isset($_POST['respuesta_51']) ? $_POST['respuesta_51'] : '';
if ($respuesta_51 === 'Gestionar las dependencias entre tareas') { 
    $verificar_51 = "correcto";
} elseif ($respuesta_51 === '') {
    $verificar_51 = '';
} else {
    $verificar_51 = "incorrecto";
}

 $respuesta_52 = isset($_POST['respuesta_52']) ? $_POST['respuesta_52'] : '';
if ($respuesta_52 === 'incluyendo el uso de recursos') { 
    $verificar_52 = "correcto";
} elseif ($respuesta_52 === '') {
    $verificar_52 = '';
} else {
    $verificar_52 = "incorrecto";
}

 $respuesta_53 = isset($_POST['respuesta_53']) ? $_POST['respuesta_53'] : '';
if ($respuesta_53 === 'abordarse por separado') { 
    $verificar_53 = "correcto";
} elseif ($respuesta_53 === '') {
    $verificar_53 = '';
} else {
    $verificar_53 = "incorrecto";
}

 $respuesta_54 = isset($_POST['respuesta_54']) ? $_POST['respuesta_54'] : '';
if ($respuesta_54 === 'las dependencias pueden aislarse') { 
    $verificar_54 = "correcto";
} elseif ($respuesta_54 === '') {
    $verificar_54 = '';
} else {
    $verificar_54 = "incorrecto";
}

 $respuesta_55 = isset($_POST['respuesta_55']) ? $_POST['respuesta_55'] : '';
if ($respuesta_55 === 'conjunto de tareas concurrentes') { 
    $verificar_55 = "correcto";
} elseif ($respuesta_55 === '') {
    $verificar_55 = '';
} else {
    $verificar_55 = "incorrecto";
}


 $respuesta_56 = isset($_POST['respuesta_56']) ? $_POST['respuesta_56'] : '';
if ($respuesta_56 === 'permitiendo aprovechar la concurrencia') { 
    $verificar_56 = "correcto";
} elseif ($respuesta_56 === '') {
    $verificar_56 = '';
} else {
    $verificar_56 = "incorrecto";
}

 $respuesta_57 = isset($_POST['respuesta_57']) ? $_POST['respuesta_57'] : '';
if ($respuesta_57 === 'utilizarse cuando el problema') { 
    $verificar_57 = "correcto";
} elseif ($respuesta_57 === '') {
    $verificar_57 = '';
} else {
    $verificar_57 = "incorrecto";
}

 $respuesta_58 = isset($_POST['respuesta_58']) ? $_POST['respuesta_58'] : '';
if ($respuesta_58 === 'resolverse con un conjunto') { 
    $verificar_58 = "correcto";
} elseif ($respuesta_58 === '') {
    $verificar_58 = '';
} else {
    $verificar_58 = "incorrecto";
}

 $respuesta_59 = isset($_POST['respuesta_59']) ? $_POST['respuesta_59'] : '';
if ($respuesta_59 === 'tareas concurrentes donde') { 
    $verificar_59 = "correcto";
} elseif ($respuesta_59 === '') {
    $verificar_59 = '';
} else {
    $verificar_59 = "incorrecto";
}

 $respuesta_60 = isset($_POST['respuesta_60']) ? $_POST['respuesta_60'] : '';
if ($respuesta_60 === 'Solo una o ninguna') { 
    $verificar_60 = "correcto";
} elseif ($respuesta_60 === '') {
    $verificar_60 = '';
} else {
    $verificar_60 = "incorrecto";
}

 $respuesta_61 = isset($_POST['respuesta_61']) ? $_POST['respuesta_61'] : '';
if ($respuesta_61 === 'tareas modifica los datos globales') { 
    $verificar_61 = "correcto";
} elseif ($respuesta_61 === '') {
    $verificar_61 = '';
} else {
    $verificar_61 = "incorrecto";
}

 $respuesta_62 = isset($_POST['respuesta_62']) ? $_POST['respuesta_62'] : '';
if ($respuesta_62 === 'las demas tareas solo necesitan su valor inicial') { 
    $verificar_62 = "correcto";
} elseif ($respuesta_62 === '') {
    $verificar_62 = '';
} else {
    $verificar_62 = "incorrecto";
}

 $respuesta_63 = isset($_POST['respuesta_63']) ? $_POST['respuesta_63'] : '';
if ($respuesta_63 === 'datos replicados') { 
    $verificar_63 = "correcto";
} elseif ($respuesta_63 === '') {
    $verificar_63 = '';
} else {
    $verificar_63 = "incorrecto";
}

 $respuesta_64 = isset($_POST['respuesta_64']) ? $_POST['respuesta_64'] : '';
if ($respuesta_64 === 'resultado final puede construirse') { 
    $verificar_64 = "correcto";
} elseif ($respuesta_64 === '') {
    $verificar_64 = '';
} else {
    $verificar_64 = "incorrecto";
}

 $respuesta_65 = isset($_POST['respuesta_65']) ? $_POST['respuesta_65'] : '';
if ($respuesta_65 === 'combinacion de resultados') { 
    $verificar_65 = "correcto";
} elseif ($respuesta_65 === '') {
    $verificar_65 = '';
} else {
    $verificar_65 = "incorrecto";
}

 $respuesta_66 = isset($_POST['respuesta_66']) ? $_POST['respuesta_66'] : '';
if ($respuesta_66 === 'tareas independientes') { 
    $verificar_66 = "correcto";
} elseif ($respuesta_66 === '') {
    $verificar_66 = '';
} else {
    $verificar_66 = "incorrecto";
}

 $respuesta_67 = isset($_POST['respuesta_67']) ? $_POST['respuesta_67'] : '';
if ($respuesta_67 === 'Eliminacion de dependencias entre tareas') { 
    $verificar_67 = "correcto";
} elseif ($respuesta_67 === '') {
    $verificar_67 = '';
} else {
    $verificar_67 = "incorrecto";
}

 $respuesta_68 = isset($_POST['respuesta_68']) ? $_POST['respuesta_68'] : '';
if ($respuesta_68 === 'Separar') { 
    $verificar_68 = "correcto";
} elseif ($respuesta_68 === '') {
    $verificar_68 = '';
} else {
    $verificar_68 = "incorrecto";
}

 $respuesta_69 = isset($_POST['respuesta_69']) ? $_POST['respuesta_69'] : '';
if ($respuesta_69 === 'dependencias') { 
    $verificar_69 = "correcto";
} elseif ($respuesta_69 === '') {
    $verificar_69 = '';
} else {
    $verificar_69 = "incorrecto";
}

 $respuesta_70 = isset($_POST['respuesta_70']) ? $_POST['respuesta_70'] : '';
if ($respuesta_70 === 'resolver') { 
    $verificar_70 = "correcto";
} elseif ($respuesta_70 === '') {
    $verificar_70 = '';
} else {
    $verificar_70 = "incorrecto";
}

 $respuesta_71 = isset($_POST['respuesta_71']) ? $_POST['respuesta_71'] : '';
if ($respuesta_71 === 'compartir') { 
    $verificar_71 = "correcto";
} elseif ($respuesta_71 === '') {
    $verificar_71 = '';
} else {
    $verificar_71 = "incorrecto";
}

 $respuesta_72 = isset($_POST['respuesta_72']) ? $_POST['respuesta_72'] : '';
if ($respuesta_72 === 'permite') { 
    $verificar_72 = "correcto";
} elseif ($respuesta_72 === '') {
    $verificar_72 = '';
} else {
    $verificar_72 = "incorrecto";
}

 $respuesta_73 = isset($_POST['respuesta_73']) ? $_POST['respuesta_73'] : '';
if ($respuesta_73 === 'concurrencia') { 
    $verificar_73 = "correcto";
} elseif ($respuesta_73 === '') {
    $verificar_73 = '';
} else {
    $verificar_73 = "incorrecto";
}

 $respuesta_74 = isset($_POST['respuesta_74']) ? $_POST['respuesta_74'] : '';
if ($respuesta_74 === 'las tareas se clasifican') { 
    $verificar_74 = "correcto";
} elseif ($respuesta_74 === '') {
    $verificar_74 = '';
} else {
    $verificar_74 = "incorrecto";
}

 $respuesta_75 = isset($_POST['respuesta_75']) ? $_POST['respuesta_75'] : '';
if ($respuesta_75 === 'ejecutarse al mismo tiempo') { 
    $verificar_75 = "correcto";
} elseif ($respuesta_75 === '') {
    $verificar_75 = '';
} else {
    $verificar_75 = "incorrecto";
}

 $respuesta_76 = isset($_POST['respuesta_76']) ? $_POST['respuesta_76'] : '';
if ($respuesta_76 === 'aquellas que necesitan esperar') { 
    $verificar_76 = "correcto";
} elseif ($respuesta_76 === '') {
    $verificar_76 = '';
} else {
    $verificar_76 = "incorrecto";
}

 $respuesta_77 = isset($_POST['respuesta_77']) ? $_POST['respuesta_77'] : '';
if ($respuesta_77 === 'que otras tareas finalicen') { 
    $verificar_77 = "correcto";
} elseif ($respuesta_77 === '') {
    $verificar_77 = '';
} else {
    $verificar_77 = "incorrecto";
}

 $respuesta_78 = isset($_POST['respuesta_78']) ? $_POST['respuesta_78'] : '';
if ($respuesta_78 === 'mecanismo') { 
    $verificar_78 = "correcto";
} elseif ($respuesta_78 === '') {
    $verificar_78 = '';
} else {
    $verificar_78 = "incorrecto";
}

 $respuesta_79 = isset($_POST['respuesta_79']) ? $_POST['respuesta_79'] : '';
if ($respuesta_79 === 'permita compartir datos') { 
    $verificar_79 = "correcto";
} elseif ($respuesta_79 === '') {
    $verificar_79 = '';
} else {
    $verificar_79 = "incorrecto";
}

 $respuesta_80 = isset($_POST['respuesta_80']) ? $_POST['respuesta_80'] : '';
if ($respuesta_80 === 'tareas concurrentes') { 
    $verificar_80 = "correcto";
} elseif ($respuesta_80 === '') {
    $verificar_80 = '';
} else {
    $verificar_80 = "incorrecto";
}

 $respuesta_81 = isset($_POST['respuesta_81']) ? $_POST['respuesta_81'] : '';
if ($respuesta_81 === 'mediante replicacion') { 
    $verificar_81 = "correcto";
} elseif ($respuesta_81 === '') {
    $verificar_81 = '';
} else {
    $verificar_81 = "incorrecto";
}

    $respuesta_82 = isset($_POST['respuesta_82']) ? $_POST['respuesta_82'] : '';
    if ($respuesta_82 === 'no todos los problemas') { 
        $verificar_82 = "correcto";
    } elseif ($respuesta_82 === '') {
        $verificar_82 = '';
    } else {
        $verificar_82 = "incorrecto";
    }

      $respuesta_83 = isset($_POST['respuesta_83']) ? $_POST['respuesta_83'] : '';
    if ($respuesta_83 === 'Master') {
        $verificar_83 = "correcto";
    } elseif ($respuesta_83 === '') {
        $verificar_83 = '';
    } else {
        $verificar_83 = "incorrecto";
    }
 
    $respuesta_84 = isset($_POST['respuesta_84']) ? $_POST['respuesta_84'] : '';
    if ($respuesta_84 === '-queue: Queue <<Task>>') {
        $verificar_84 = "correcto";
    } elseif ($respuesta_84 === '') {
        $verificar_84 = '';
    } else {
        $verificar_84 = "incorrecto";
    }
 
    $respuesta_85 = isset($_POST['respuesta_85']) ? $_POST['respuesta_85'] : '';
    if ($respuesta_85 === '-globalResult: DataMergedStructure') {
        $verificar_85 = "correcto";
    } elseif ($respuesta_85 === '') {
        $verificar_85 = '';
    } else {
        $verificar_85 = "incorrecto";
    }
 
    $respuesta_86 = isset($_POST['respuesta_86']) ? $_POST['respuesta_86'] : '';
    if ($respuesta_86 === '-workers: ThreadPool') {
        $verificar_86 = "correcto";
    } elseif ($respuesta_86 === '') {
        $verificar_86 = '';
    } else {
        $verificar_86 = "incorrecto";
    }
 
    $respuesta_87 = isset($_POST['respuesta_87']) ? $_POST['respuesta_87'] : '';
    if ($respuesta_87 === '+create_tasks(): void') {
        $verificar_87 = "correcto";
    } elseif ($respuesta_87 === '') {
        $verificar_87 = '';
    } else {
        $verificar_87 = "incorrecto";
    }
 
    $respuesta_88 = isset($_POST['respuesta_88']) ? $_POST['respuesta_88'] : '';
    if ($respuesta_88 === '+launch_workers(): void') {
        $verificar_88 = "correcto";
    } elseif ($respuesta_88 === '') {
        $verificar_88 = '';
    } else {
        $verificar_88 = "incorrecto";
    }
 
    $respuesta_89 = isset($_POST['respuesta_89']) ? $_POST['respuesta_89'] : '';
    if ($respuesta_89 === '+separateDependencies(): void') {
        $verificar_89 = "correcto";
    } elseif ($respuesta_89 === '') {
        $verificar_89 = '';
    } else {
        $verificar_89 = "incorrecto";
    }
 
    $respuesta_90 = isset($_POST['respuesta_90']) ? $_POST['respuesta_90'] : '';
    if ($respuesta_90 === '+getTask(): Task') {
        $verificar_90 = "correcto";
    } elseif ($respuesta_90 === '') {
        $verificar_90 = '';
    } else {
        $verificar_90 = "incorrecto";
    }
 
    $respuesta_91 = isset($_POST['respuesta_91']) ? $_POST['respuesta_91'] : '';
    if ($respuesta_91 === '+addPartialResult(Object): void') {
        $verificar_91 = "correcto";
    } elseif ($respuesta_91 === '') {
        $verificar_91 = '';
    } else {
        $verificar_91 = "incorrecto";
    }
 
    $respuesta_92 = isset($_POST['respuesta_92']) ? $_POST['respuesta_92'] : '';
    if ($respuesta_92 === '+processResults(): void') {
        $verificar_92 = "correcto";
    } elseif ($respuesta_92 === '') {
        $verificar_92 = '';
    } else {
        $verificar_92 = "incorrecto";
    }
 
    $respuesta_93 = isset($_POST['respuesta_93']) ? $_POST['respuesta_93'] : '';
    if ($respuesta_93 === '+shutdown_workers(): void') {
        $verificar_93 = "correcto";
    } elseif ($respuesta_93 === '') {
        $verificar_93 = '';
    } else {
        $verificar_93 = "incorrecto";
    }
 
    $respuesta_94 = isset($_POST['respuesta_94']) ? $_POST['respuesta_94'] : '';
    if ($respuesta_94 === 'Task') {
        $verificar_94 = "correcto";
    } elseif ($respuesta_94 === '') {
        $verificar_94 = '';
    } else {
        $verificar_94 = "incorrecto";
    }
 
    $respuesta_95 = isset($_POST['respuesta_95']) ? $_POST['respuesta_95'] : '';
    if ($respuesta_95 === '-data: Data') {
        $verificar_95 = "correcto";
    } elseif ($respuesta_95 === '') {
        $verificar_95 = '';
    } else {
        $verificar_95 = "incorrecto";
    }
 
    $respuesta_96 = isset($_POST['respuesta_96']) ? $_POST['respuesta_96'] : '';
    if ($respuesta_96 === '+createTask(Data): Task') {
        $verificar_96 = "correcto";
    } elseif ($respuesta_96 === '') {
        $verificar_96 = '';
    } else {
        $verificar_96 = "incorrecto";
    }
 
    $respuesta_97 = isset($_POST['respuesta_97']) ? $_POST['respuesta_97'] : '';
    if ($respuesta_97 === '1') {
        $verificar_97 = "correcto";
    } elseif ($respuesta_97 === '') {
        $verificar_97 = '';
    } else {
        $verificar_97 = "incorrecto";
    }
 
    $respuesta_98 = isset($_POST['respuesta_98']) ? $_POST['respuesta_98'] : '';
    if ($respuesta_98 === '1..*') {
        $verificar_98 = "correcto";
    } elseif ($respuesta_98 === '') {
        $verificar_98 = '';
    } else {
        $verificar_98 = "incorrecto";
    }
 
    $respuesta_99 = isset($_POST['respuesta_99']) ? $_POST['respuesta_99'] : '';
    if ($respuesta_99 === 'Worker') {
        $verificar_99 = "correcto";
    } elseif ($respuesta_99 === '') {
        $verificar_99 = '';
    } else {
        $verificar_99 = "incorrecto";
    }
 
    $respuesta_100 = isset($_POST['respuesta_100']) ? $_POST['respuesta_100'] : '';
    if ($respuesta_100 === '-requestTask(): Task') {
        $verificar_100 = "correcto";
    } elseif ($respuesta_100 === '') {
        $verificar_100 = '';
    } else {
        $verificar_100 = "incorrecto";
    }
 
    $respuesta_101 = isset($_POST['respuesta_101']) ? $_POST['respuesta_101'] : '';
    if ($respuesta_101 === '+processTask(Task): void') {
        $verificar_101 = "correcto";
    } elseif ($respuesta_101 === '') {
        $verificar_101 = '';
    } else {
        $verificar_101 = "incorrecto";
    }
 
    $respuesta_102 = isset($_POST['respuesta_102']) ? $_POST['respuesta_102'] : '';
    if ($respuesta_102 === '1') {
        $verificar_102 = "correcto";
    } elseif ($respuesta_102 === '') {
        $verificar_102 = '';
    } else {
        $verificar_102 = "incorrecto";
    }
 
    $respuesta_103 = isset($_POST['respuesta_103']) ? $_POST['respuesta_103'] : '';
    if ($respuesta_103 === '1..*') {
        $verificar_103 = "correcto";
    } elseif ($respuesta_103 === '') {
        $verificar_103 = '';
    } else {
        $verificar_103 = "incorrecto";
    }
 $respuesta_104 = isset($_POST['respuesta_104']) ? $_POST['respuesta_104'] : '';
if ($respuesta_104 === 'Master') { 
    $verificar_104 = "correcto";
} elseif ($respuesta_104 === '') {
    $verificar_104 = '';
} else {
    $verificar_104 = "incorrecto";
}

 $respuesta_105 = isset($_POST['respuesta_105']) ? $_POST['respuesta_105'] : '';
if ($respuesta_105 === 'mismas responsabilidades') { 
    $verificar_105 = "correcto";
} elseif ($respuesta_105 === '') {
    $verificar_105 = '';
} else {
    $verificar_105 = "incorrecto";
}

 $respuesta_106 = isset($_POST['respuesta_106']) ? $_POST['respuesta_106'] : '';
if ($respuesta_106 === 'proceso adicional que realizar') { 
    $verificar_106 = "correcto";
} elseif ($respuesta_106 === '') {
    $verificar_106 = '';
} else {
    $verificar_106 = "incorrecto";
}

 $respuesta_107 = isset($_POST['respuesta_107']) ? $_POST['respuesta_107'] : '';
if ($respuesta_107 === 'crear nuevas tareas') { 
    $verificar_107 = "correcto";
} elseif ($respuesta_107 === '') {
    $verificar_107 = '';
} else {
    $verificar_107 = "incorrecto";
}

 $respuesta_108 = isset($_POST['respuesta_108']) ? $_POST['respuesta_108'] : '';
if ($respuesta_108 === 'los datos replicados') { 
    $verificar_108 = "correcto";
} elseif ($respuesta_108 === '') {
    $verificar_108 = '';
} else {
    $verificar_108 = "incorrecto";
}

 $respuesta_109 = isset($_POST['respuesta_109']) ? $_POST['respuesta_109'] : '';
if ($respuesta_109 === 'Worker') { 
    $verificar_109 = "correcto";
} elseif ($respuesta_109 === '') {
    $verificar_109 = '';
} else {
    $verificar_109 = "incorrecto";
}

 $respuesta_110 = isset($_POST['respuesta_110']) ? $_POST['respuesta_110'] : '';
if ($respuesta_110 === 'mismas responsabilidades') { 
    $verificar_110 = "correcto";
} elseif ($respuesta_110 === '') {
    $verificar_110 = '';
} else {
    $verificar_110 = "incorrecto";
}

// Tabla del 12
$respuesta_111 = isset($_POST['respuesta_111']) ? $_POST['respuesta_111'] : '';
if ($respuesta_111 === 'Task') {  
    $verificar_111 = "correcto";
} elseif ($respuesta_111 === '') {
    $verificar_111 = '';
} else {
    $verificar_111 = "incorrecto";
}

$respuesta_112 = isset($_POST['respuesta_112']) ? $_POST['respuesta_112'] : '';
if ($respuesta_112 === 'responsable') {  
    $verificar_112 = "correcto";
} elseif ($respuesta_112 === '') {
    $verificar_112 = '';
} else {
    $verificar_112 = "incorrecto";
}

$respuesta_113 = isset($_POST['respuesta_113']) ? $_POST['respuesta_113'] : '';
if ($respuesta_113 === 'definir y crear') {  
    $verificar_113 = "correcto";
} elseif ($respuesta_113 === '') {
    $verificar_113 = '';
} else {
    $verificar_113 = "incorrecto";
}

$respuesta_114 = isset($_POST['respuesta_114']) ? $_POST['respuesta_114'] : '';
if ($respuesta_114 === 'tareas independientes basadas') {  
    $verificar_114 = "correcto";
} elseif ($respuesta_114 === '') {
    $verificar_114 = '';
} else {
    $verificar_114 = "incorrecto";
}

$respuesta_115 = isset($_POST['respuesta_115']) ? $_POST['respuesta_115'] : '';
if ($respuesta_115 === 'replicacion') {  
    $verificar_115 = "correcto";
} elseif ($respuesta_115 === '') {
    $verificar_115 = '';
} else {
    $verificar_115 = "incorrecto";
}

$respuesta_116 = isset($_POST['respuesta_116']) ? $_POST['respuesta_116'] : '';
if ($respuesta_116 === 'datos necesarios') {  
    $verificar_116 = "correcto";
} elseif ($respuesta_116 === '') {
    $verificar_116 = '';
} else {
    $verificar_116 = "incorrecto";
}

$respuesta_117 = isset($_POST['respuesta_117']) ? $_POST['respuesta_117'] : '';
if ($respuesta_117 === 'ejecutar cada una de ellas') {  
    $verificar_117 = "correcto";
} elseif ($respuesta_117 === '') {
    $verificar_117 = '';
} else {
    $verificar_117 = "incorrecto";
}

$respuesta_118 = isset($_POST['respuesta_118']) ? $_POST['respuesta_118'] : '';
if ($respuesta_118 === 'definidos previamente') {  
    $verificar_118 = "correcto";
} elseif ($respuesta_118 === '') {
    $verificar_118 = '';
} else {
    $verificar_118 = "incorrecto";
}

$respuesta_119 = isset($_POST['respuesta_119']) ? $_POST['respuesta_119'] : '';
if ($respuesta_119 === 'el Master') {  
    $verificar_119 = "correcto";
} elseif ($respuesta_119 === '') {
    $verificar_119 = '';
} else {
    $verificar_119 = "incorrecto";
}

$respuesta_120 = isset($_POST['respuesta_120']) ? $_POST['respuesta_120'] : '';
if ($respuesta_120 === 'diferencia') {  
    $verificar_120 = "correcto";
} elseif ($respuesta_120 === '') {
    $verificar_120 = '';
} else {
    $verificar_120 = "incorrecto";
}

$respuesta_121 = isset($_POST['respuesta_121']) ? $_POST['respuesta_121'] : '';
if ($respuesta_121 === 'Task') {  
    $verificar_121 = "correcto";
} elseif ($respuesta_121 === '') {
    $verificar_121 = '';
} else {
    $verificar_121 = "incorrecto";
}

$respuesta_122 = isset($_POST['respuesta_122']) ? $_POST['respuesta_122'] : '';
if ($respuesta_122 === 'Master') {  
    $verificar_122 = "correcto";
} elseif ($respuesta_122 === '') {
    $verificar_122 = '';
} else {
    $verificar_122 = "incorrecto";
}

$respuesta_123 = isset($_POST['respuesta_123']) ? $_POST['respuesta_123'] : '';
if ($respuesta_123 === 'dos funciones') {  
    $verificar_123 = "correcto";
} elseif ($respuesta_123 === '') {
    $verificar_123 = '';
} else {
    $verificar_123 = "incorrecto";
}

$respuesta_124 = isset($_POST['respuesta_124']) ? $_POST['respuesta_124'] : '';
if ($respuesta_124 === 'Definir la funcionalidad de la tarea') {  
    $verificar_124 = "correcto";
} elseif ($respuesta_124 === '') {
    $verificar_124 = '';
} else {
    $verificar_124 = "incorrecto";
}

$respuesta_125 = isset($_POST['respuesta_125']) ? $_POST['respuesta_125'] : '';
if ($respuesta_125 === 'Replicar los datos requeridos') {  
    $verificar_125 = "correcto";
} elseif ($respuesta_125 === '') {
    $verificar_125 = '';
} else {
    $verificar_125 = "incorrecto";
}

$respuesta_126 = isset($_POST['respuesta_126']) ? $_POST['respuesta_126'] : '';
if ($respuesta_126 === 'definira los datos para cada tarea') {  
    $verificar_126 = "correcto";
} elseif ($respuesta_126 === '') {
    $verificar_126 = '';
} else {
    $verificar_126 = "incorrecto";
}

$respuesta_127 = isset($_POST['respuesta_127']) ? $_POST['respuesta_127'] : '';
if ($respuesta_127 === 'separateDependencies():void') {  
    $verificar_127 = "correcto";
} elseif ($respuesta_127 === '') {
    $verificar_127 = '';
} else {
    $verificar_127 = "incorrecto";
}

$respuesta_128 = isset($_POST['respuesta_128']) ? $_POST['respuesta_128'] : '';
if ($respuesta_128 === 'createTask(Data):Task') {  
    $verificar_128 = "correcto";
} elseif ($respuesta_128 === '') {
    $verificar_128 = '';
} else {
    $verificar_128 = "incorrecto";
}

$respuesta_129 = isset($_POST['respuesta_129']) ? $_POST['respuesta_129'] : '';
if ($respuesta_129 === 'launchWorkers():void') {  
    $verificar_129 = "correcto";
} elseif ($respuesta_129 === '') {
    $verificar_129 = '';
} else {
    $verificar_129 = "incorrecto";
}

$respuesta_130 = isset($_POST['respuesta_130']) ? $_POST['respuesta_130'] : '';
if ($respuesta_130 === 'requestTask():Task') {  
    $verificar_130 = "correcto";
} elseif ($respuesta_130 === '') {
    $verificar_130 = '';
} else {
    $verificar_130 = "incorrecto";
}

$respuesta_131 = isset($_POST['respuesta_131']) ? $_POST['respuesta_131'] : '';
if ($respuesta_131 === 'getTask():Task') {  
    $verificar_131 = "correcto";
} elseif ($respuesta_131 === '') {
    $verificar_131 = '';
} else {
    $verificar_131 = "incorrecto";
}

$respuesta_132 = isset($_POST['respuesta_132']) ? $_POST['respuesta_132'] : '';
if ($respuesta_132 === 'processTask(Task):void') {  
    $verificar_132 = "correcto";
} elseif ($respuesta_132 === '') {
    $verificar_132 = '';
} else {
    $verificar_132 = "incorrecto";
}

$respuesta_133 = isset($_POST['respuesta_133']) ? $_POST['respuesta_133'] : '';
if ($respuesta_133 === 'addPartialResult(Object):void') {  
    $verificar_133 = "correcto";
} elseif ($respuesta_133 === '') {
    $verificar_133 = '';
} else {
    $verificar_133 = "incorrecto";
}

$respuesta_134 = isset($_POST['respuesta_134']) ? $_POST['respuesta_134'] : '';
if ($respuesta_134 === 'shutdownWorkers():void') {  
    $verificar_134 = "correcto";
} elseif ($respuesta_134 === '') {
    $verificar_134 = '';
} else {
    $verificar_134 = "incorrecto";
}

$respuesta_135 = isset($_POST['respuesta_135']) ? $_POST['respuesta_135'] : '';
if ($respuesta_135 === '158') {  
    $verificar_135 = "correcto";
} elseif ($respuesta_135 === '') {
    $verificar_135 = '';
} else {
    $verificar_135 = "incorrecto";
}

}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas sobre simplificación de expresiones matemáticas</title>
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../style_2_0.css">
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<style>
 
    .seccion {
    /*width: 50%;*/    
    width: calc(50% - 7.5px);
    padding: 20px;
    box-sizing: border-box;
    height: 270vh;
    }

</style>
 
<script>
function handleSubmit(event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    fetch(event.target.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(html => {
        document.body.innerHTML = html;

        // Asegúrate de que MathJax procese el nuevo contenido
        if (window.MathJax) {
            MathJax.typeset();
        }
        actualizarFormula();
        actualizarFormula2();
        actualizarFormula3();
        actualizarFormula4();
        actualizarFormula5();
        actualizarFormula6();
        actualizarFormula7();
        actualizarFormula8();
        actualizarFormula9();
        actualizarFormula10();
        actualizarFormula11();
        actualizarFormula12();
        actualizarFormula13();
        actualizarFormula14();
        actualizarFormula15();
        actualizarFormula16();
        actualizarFormula17();
        actualizarFormula18();
        actualizarFormula19();
        actualizarFormula20();
    })
    .catch(error => {
        console.error('Error al enviar el formulario:', error);
    });
}

function actualizarFormula() {
    var f = document.getElementById('respuesta_1').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula2() {
    var f = document.getElementById('respuesta_2').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula2').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula3() {
    var f = document.getElementById('respuesta_3').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula3').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula4() {
    var f = document.getElementById('respuesta_4').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula4').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula5() {
    var f = document.getElementById('respuesta_5').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula5').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula6() {
    var f = document.getElementById('respuesta_6').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula6').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula7() {
    var f = document.getElementById('respuesta_7').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula7').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula8() {
    var f = document.getElementById('respuesta_8').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula8').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula9() {
    var f = document.getElementById('respuesta_9').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula9').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula10() {
    var f = document.getElementById('respuesta_10').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula10').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula11() {
    var f = document.getElementById('respuesta_11').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula11').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula12() {
    var f = document.getElementById('respuesta_12').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula12').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula13() {
    var f = document.getElementById('respuesta_13').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula13').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula14() {
    var f = document.getElementById('respuesta_14').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula14').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula15() {
    var f = document.getElementById('respuesta_15').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula15').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula16() {
    var f = document.getElementById('respuesta_16').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula16').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula17() {
    var f = document.getElementById('respuesta_17').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula17').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula18() {
    var f = document.getElementById('respuesta_18').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula18').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula19() {
    var f = document.getElementById('respuesta_19').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula19').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula20() {
    var f = document.getElementById('respuesta_20').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula20').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function mostrarMensaje() {
    document.getElementById("mensaje").style.display = 'block';
    // Asegúrate de que MathJax procese el nuevo contenido
    MathJax.typeset([document.getElementById("mensaje")]);
}

function ocultarMensaje() {
    document.getElementById("mensaje").style.display = 'none';
}


function mostrarMensaje2() {
    document.getElementById("mensaje2").style.display = 'block';
    // Asegúrate de que MathJax procese el nuevo contenido
    MathJax.typeset([document.getElementById("mensaje")]);
}

function ocultarMensaje2() {
    document.getElementById("mensaje2").style.display = 'none';
}



function mostrarMensaje3() {
    document.getElementById("mensaje3").style.display = 'block';
    // Asegúrate de que MathJax procese el nuevo contenido
    MathJax.typeset([document.getElementById("mensaje3")]);
}

function ocultarMensaje3() {
    document.getElementById("mensaje3").style.display = 'none';
}

function mostrarMensaje4() {
    document.getElementById("mensaje4").style.display = 'block';
    // Asegúrate de que MathJax procese el nuevo contenido
    MathJax.typeset([document.getElementById("mensaje4")]);
}

function ocultarMensaje4() {
    document.getElementById("mensaje4").style.display = 'none';
}




</script>
    
</head>
<body>  

<form action="./tercero.php" method="POST" onsubmit="handleSubmit(event)" autocomplete="off"> 
<div class="form-container">

    
<div class="seccion izquierda"> 
 

<h4>Comportamiento</h4>

<h5>Escenario de Procesamiento - Figura 3.11</h5>
<p>
Este escenario describe el comportamiento usual de procesamiento del patrón de diseño
Master / Worker.
</p>

<ul>
  <li>
    Cuando 
    <input type="text" name="respuesta_1" value="<?php echo $respuesta_1; ?>" size="21">
     , estos 
    <input type="text" name="respuesta_2" value="<?php echo $respuesta_2; ?>" size="21">
     .
  </li>

  <li>
    Cuando 
    <input type="text" name="respuesta_3" value="<?php echo $respuesta_3; ?>" size="31">
     , este 
    <input type="text" name="respuesta_4" value="<?php echo $respuesta_4; ?>" size="11">
      y 
    <input type="text" name="respuesta_5" value="<?php echo $respuesta_5; ?>" size="26">
     .
  </li>

  <li>
    Cuando 
    <input type="text" name="respuesta_6" value="<?php echo $respuesta_6; ?>" size="13">
      de 
    <input type="text" name="respuesta_7" value="<?php echo $respuesta_7; ?>" size="21">
     , 
    <input type="text" name="respuesta_8" value="<?php echo $respuesta_8; ?>" size="37">
      que 
    <input type="text" name="respuesta_9" value="<?php echo $respuesta_9; ?>" size="37">
      y 
    <input type="text" name="respuesta_10" value="<?php echo $respuesta_10; ?>" size="41">
     .
  </li>
</ul>

    <button type="submit">Enviar</button> 
    <?php echo $verificar_1 ?>
    <?php echo $verificar_2 ?>
    <?php echo $verificar_3 ?>
    <?php echo $verificar_4 ?>
    <?php echo $verificar_5 ?>
    <?php echo $verificar_6 ?>
    <?php echo $verificar_7 ?>  
    <?php echo $verificar_8 ?>
    <?php echo $verificar_9 ?>
    <?php echo $verificar_10 ?>
<hr>
<h5>Finalización - Figura 3.11</h5>
<p>
Este escenario describe cómo finaliza el patrón de diseño Master / Worker.
</p>

<ul>
  <li>
    Cuando todas las tareas 
    <input type="text" name="respuesta_11" value="<?php echo $respuesta_11; ?>" size="21">
     , el 
    <input type="text" name="respuesta_12" value="<?php echo $respuesta_12; ?>" size="47">
      y 
    <input type="text" name="respuesta_13" value="<?php echo $respuesta_13; ?>" size="21">
     ; si es necesario,
    <input type="text" name="respuesta_14" value="<?php echo $respuesta_14; ?>" size="29">
     .
  </li>
</ul>

<h5>Circunstancias especiales y variaciones</h5>

<ul>
  <li>
    Usualmente las tareas del problema 
    <input type="text" name="respuesta_15" value="<?php echo $respuesta_15; ?>" size="29">
     ;
    sin embargo, este patrón puede usar una 
    <input type="text" name="respuesta_16" value="<?php echo $respuesta_16; ?>" size="29">
     
    para 
    <input type="text" name="respuesta_17" value="<?php echo $respuesta_17; ?>" size="29">
     .
  </li>

  <li>
    La 
    <input type="text" name="respuesta_18" value="<?php echo $respuesta_18; ?>" size="33">
      se 
    <input type="text" name="respuesta_19" value="<?php echo $respuesta_19; ?>" size="5">
      cuando 
    <input type="text" name="respuesta_20" value="<?php echo $respuesta_20; ?>" size="28">
     ; sin embargo, existen 
    <input type="text" name="respuesta_21" value="<?php echo $respuesta_21; ?>" size="29">
      puede
    <input type="text" name="respuesta_22" value="<?php echo $respuesta_22; ?>" size="51">
     .
  </li>

  <li>
    Por ejemplo, una búsqueda en una base de datos donde cada worker posee
    un espacio de búsqueda independiente finaliza tan pronto como el primer
    worker encuentra el elemento buscado.
  </li>

  <li>
    En algunos casos, 
    <input type="text" name="respuesta_23" value="<?php echo $respuesta_23; ?>" size="41">
     , es decir,
    nuevas tareas son generadas mientras otras tareas están en ejecución.
    En estos casos, es muy importante asegurar una condición de terminación.
  </li>
</ul>


<button type="submit">Enviar</button>
<?php echo $verificar_11 ?> 
    <?php echo $verificar_12 ?>
    <?php echo $verificar_13 ?>
    <?php echo $verificar_14 ?>
    <?php echo $verificar_15 ?>
    <?php echo $verificar_16 ?>
    <?php echo $verificar_17 ?>
    <?php echo $verificar_18 ?>
    <?php echo $verificar_19 ?> 
    <?php echo $verificar_20 ?>
    <?php echo $verificar_21 ?>
    <?php echo $verificar_22 ?>
    <?php echo $verificar_23 ?>
<p>
Algunos autores no consideran el comportamiento descrito por la versión estática
del patrón de diseño Master-Worker como parte de este patrón; en su lugar,
prefieren describir este comportamiento como un patrón de diseño completamente nuevo.
</p>
   
<div style="position:relative; width:100%; padding-bottom:73.5%; display:block;">
<svg style="position:absolute; top:0; left:0; width:100%; height:100%;"
     viewBox="0 0 680 500" role="img" xmlns="http://www.w3.org/2000/svg">

  <title>Processing Sequence Diagram - Master-Worker Design Pattern</title>

  <defs>
    <marker id="arrow311"
            viewBox="0 0 10 10"
            refX="8" refY="5"
            markerWidth="6" markerHeight="6"
            orient="auto">
      <path d="M0 0L10 5L0 10Z" fill="#333"/>
    </marker>
  </defs>

  <!-- HEADERS -->
  <rect x="104" y="18" width="84" height="34" fill="white" stroke="#333" stroke-width="1"/>
  <rect x="108" y="22" width="84" height="34" fill="white" stroke="#333" stroke-width="1"/>

  <rect x="462" y="18" width="84" height="34" fill="white" stroke="#333" stroke-width="1"/>
  <rect x="466" y="22" width="84" height="34" fill="white" stroke="#333" stroke-width="1"/>

  <!-- LIFELINES -->
  <line x1="150" y1="56" x2="150" y2="490" stroke="#777" stroke-width="1" stroke-dasharray="8 8"/>
  <line x1="508" y1="56" x2="508" y2="490" stroke="#777" stroke-width="1" stroke-dasharray="8 8"/>

  <!-- ACTIVATION BOXES -->
  <rect x="144" y="84" width="12" height="360" fill="white" stroke="#333" stroke-width="1"/>
  <rect x="502" y="178" width="12" height="190" fill="white" stroke="#333" stroke-width="1"/>

  <!-- create_tasks() -->
  <line x1="150" y1="100" x2="150" y2="132" stroke="#333" stroke-width="1.2" marker-end="url(#arrow311)"/>

  <!-- launch_workers() -->
  <line x1="150" y1="150" x2="150" y2="182" stroke="#333" stroke-width="1.2" marker-end="url(#arrow311)"/>

  <!-- LOOP FRAME -->
  <rect x="42" y="198" width="598" height="170" fill="none" stroke="#333" stroke-width="1"/>
  <rect x="42" y="198" width="50" height="24" fill="white" stroke="#333" stroke-width="1"/>
  <text x="67" y="214" text-anchor="middle" font-size="11" font-family="sans-serif">Loop</text>

  <!-- request_task() Worker self-call -->
  <line x1="508" y1="200" x2="508" y2="232" stroke="#333" stroke-width="1.2" marker-end="url(#arrow311)"/>

  <!-- getTask() Worker→Master -->
  <line x1="502" y1="252" x2="156" y2="252" stroke="#333" stroke-width="1.2" marker-end="url(#arrow311)"/>

  <!-- process_task() Worker self-call -->
  <line x1="508" y1="276" x2="508" y2="308" stroke="#333" stroke-width="1.2" marker-end="url(#arrow311)"/>

  <!-- addPartialResult(Object) Worker→Master -->
  <line x1="502" y1="328" x2="156" y2="328" stroke="#333" stroke-width="1.2" marker-end="url(#arrow311)"/>

  <!-- [While there are tasks] note -->
  <text x="540" y="350" font-size="11" font-family="sans-serif">[While there are</text>
  <text x="540" y="366" font-size="11" font-family="sans-serif">tasks]</text>

  <!-- processPartialResult() -->
  <line x1="150" y1="388" x2="150" y2="420" stroke="#333" stroke-width="1.2" marker-end="url(#arrow311)"/>

  <!-- shutdown_workers() -->
  <line x1="150" y1="430" x2="150" y2="462" stroke="#333" stroke-width="1.2" marker-end="url(#arrow311)"/>

  <!-- CAPTION -->
  <text x="340" y="488" text-anchor="middle" font-size="12" font-style="italic" font-family="sans-serif">
    Figure 3.11: Processing Sequence Diagram - Master-Worker Design Pattern
  </text>

</svg>

<!-- respuesta_24: cabecera Master -->
<input type="text" name="respuesta_24"
  value="<?php echo $respuesta_24; ?>"
  style="position:absolute; left:15.9%; top:3.6%; width:12.4%; height:7.6%;
         font-size:14px; padding:1px 3px; border:1px solid #aaa;
         background:#fffde7; box-sizing:border-box;"/>

<!-- respuesta_25: cabecera Worker -->
<input type="text" name="respuesta_25"
  value="<?php echo $respuesta_25; ?>"
  style="position:absolute; left:68.5%; top:3.6%; width:12.4%; height:7.6%;
         font-size:14px; padding:1px 3px; border:1px solid #aaa;
         background:#fffde7; box-sizing:border-box;"/>

<!-- respuesta_26: create_tasks() -->
<input type="text" name="respuesta_26"
  value="<?php echo $respuesta_26; ?>"
  style="position:absolute; left:25%; top:20%; width:22%; height:4%;
         font-size:14px; padding:1px 3px; border:1px solid #aaa;
         background:#fffde7; box-sizing:border-box;"/>

<!-- respuesta_27: launch_workers() -->
<input type="text" name="respuesta_27"
  value="<?php echo $respuesta_27; ?>"
  style="position:absolute; left:25%; top:29%; width:22%; height:4%;
         font-size:14px; padding:1px 3px; border:1px solid #aaa;
         background:#fffde7; box-sizing:border-box;"/>

<!-- respuesta_28: request_task() Worker self-call -->
<input type="text" name="respuesta_28"
  value="<?php echo $respuesta_28; ?>"
  style="position:absolute; left:77.6%; top:39%; width:20%; height:4%;
         font-size:14px; padding:1px 3px; border:1px solid #aaa;
         background:#fffde7; box-sizing:border-box;"/>

<!-- respuesta_29: getTask() Worker→Master -->
<input type="text" name="respuesta_29"
  value="<?php echo $respuesta_29; ?>"
  style="position:absolute; left:40%; top:47%; width:16%; height:4%;
         font-size:14px; padding:1px 3px; border:1px solid #aaa;
         background:#fffde7; box-sizing:border-box;"/>

<!-- respuesta_30: process_task() Worker self-call -->
<input type="text" name="respuesta_30"
  value="<?php echo $respuesta_30; ?>"
  style="position:absolute; left:77.6%; top:53%; width:20%; height:4%;
         font-size:14px; padding:1px 3px; border:1px solid #aaa;
         background:#fffde7; box-sizing:border-box;"/>

<!-- respuesta_31: addPartialResult(Object) -->
<input type="text" name="respuesta_31"
  value="<?php echo $respuesta_31; ?>"
  style="position:absolute; left:33%; top:63%; width:28%; height:4%;
         font-size:14px; padding:1px 3px; border:1px solid #aaa;
         background:#fffde7; box-sizing:border-box;"/>

<!-- respuesta_32: processPartialResult() -->
<input type="text" name="respuesta_32"
  value="<?php echo $respuesta_32; ?>"
  style="position:absolute; left:26%; top:75%; width:26%; height:4%;
         font-size:14px; padding:1px 3px; border:1px solid #aaa;
         background:#fffde7; box-sizing:border-box;"/>

<!-- respuesta_33: shutdown_workers() -->
<input type="text" name="respuesta_33"
  value="<?php echo $respuesta_33; ?>"
  style="position:absolute; left:26%; top:84%; width:26%; height:4%;
         font-size:14px; padding:1px 3px; border:1px solid #aaa;
         background:#fffde7; box-sizing:border-box;"/>

 

</div>

<button type="submit">Enviar</button>
<?php echo $verificar_24 ?>
<?php echo $verificar_25 ?>
<?php echo $verificar_26 ?>
<?php echo $verificar_27 ?>
<?php echo $verificar_28 ?>
<?php echo $verificar_29 ?>
<?php echo $verificar_30 ?>
<?php echo $verificar_31 ?>
<?php echo $verificar_32 ?>
<?php echo $verificar_33 ?>

<hr>
<h3>3.2.8 Patrón de Diseño Separable Dependencies (Variante de 3.2.7)</h3>

<h4>Intención</h4>
<p>
Usualmente, 
<input type="text" name="respuesta_34" value="<?php echo $respuesta_34; ?>" size="15">
  pueden 
<input type="text" name="respuesta_35" value="<?php echo $respuesta_35; ?>" size="27">
 .
Esta 
<input type="text" name="respuesta_36" value="<?php echo $respuesta_36; ?>" size="8">
  debe 
<input type="text" name="respuesta_37" value="<?php echo $respuesta_37; ?>" size="21">
  en el 
<input type="text" name="respuesta_38" value="<?php echo $respuesta_38; ?>" size="21">
entre 
<input type="text" name="respuesta_39" value="<?php echo $respuesta_39; ?>" size="22">
 .
</p>

<p>
Este 
<input type="text" name="respuesta_40" value="<?php echo $respuesta_40; ?>" size="15">
  la 
<input type="text" name="respuesta_41" value="<?php echo $respuesta_41; ?>" size="41">
  entre 
<input type="text" name="respuesta_42" value="<?php echo $respuesta_42; ?>" size="22">
 :
</p>

<ul>
  <li>
    <input type="text" name="respuesta_43" value="<?php echo $respuesta_43; ?>" size="24">
     .
  </li>

  <li>
    <input type="text" name="respuesta_44" value="<?php echo $respuesta_44; ?>" size="11">
      de los 
    <input type="text" name="respuesta_45" value="<?php echo $respuesta_45; ?>" size="22">
      de las 
    <input type="text" name="respuesta_46" value="<?php echo $respuesta_46; ?>" size="22">
     .
  </li>
</ul>

<h4>Problema</h4>
<p>
Una 
<input type="text" name="respuesta_47" value="<?php echo $respuesta_47; ?>" size="31">
  es 
<input type="text" name="respuesta_48" value="<?php echo $respuesta_48; ?>" size="35">
 .
Sin embargo, 
<input type="text" name="respuesta_49" value="<?php echo $respuesta_49; ?>" size="41">
 :
</p>

<ul>
  <li>
    <input type="text" name="respuesta_50" value="<?php echo $respuesta_50; ?>" size="45">
     .
  </li>

  <li>
    <input type="text" name="respuesta_51" value="<?php echo $respuesta_51; ?>" size="36">
      (
    <input type="text" name="respuesta_52" value="<?php echo $respuesta_52; ?>" size="25">    
     ).
  </li>
</ul>

<p>
El patrón de diseño Separable Dependencies soporta problemas donde estos desafíos
pueden 
<input type="text" name="respuesta_53" value="<?php echo $respuesta_53; ?>" size="20">
 , es decir, 
<input type="text" name="respuesta_54" value="<?php echo $respuesta_54; ?>" size="28">
  del 
<input type="text" name="respuesta_55" value="<?php echo $respuesta_55; ?>" size="27">
 , 
<input type="text" name="respuesta_56" value="<?php echo $respuesta_56; ?>" size="34">
 .
</p>

<button type="submit">Enviar</button>
<?php echo $verificar_34 ?>
    <?php echo $verificar_35 ?>
    <?php echo $verificar_36 ?>
    <?php echo $verificar_37 ?>
    <?php echo $verificar_38 ?>
    <?php echo $verificar_39 ?>
    <?php echo $verificar_40 ?>
    <?php echo $verificar_41 ?>


    <?php echo $verificar_42 ?>
    <?php echo $verificar_43 ?>
    <?php echo $verificar_44 ?>  
    <?php echo $verificar_45 ?>
    <?php echo $verificar_46 ?>
    <?php echo $verificar_47 ?>
    <?php echo $verificar_48 ?>
    <?php echo $verificar_49 ?>
    <?php echo $verificar_50 ?>
    <?php echo $verificar_51 ?>
    <?php echo $verificar_52 ?>
    <?php echo $verificar_53 ?>
    <?php echo $verificar_54 ?>
    <?php echo $verificar_55 ?>
    <?php echo $verificar_56 ?>
<hr>
<h4>Contexto</h4>
<p>
Este patrón debe 
<input type="text" name="respuesta_57" value="<?php echo $respuesta_57; ?>" size="24">
  puede 
<input type="text" name="respuesta_58" value="<?php echo $respuesta_58; ?>" size="23">
de 
<input type="text" name="respuesta_59" value="<?php echo $respuesta_59; ?>" size="21">
 :
</p>

<ul>
  <li>
    <input type="text" name="respuesta_60" value="<?php echo $respuesta_60; ?>" size="15">
      de las 
    <input type="text" name="respuesta_61" value="<?php echo $respuesta_61; ?>" size="29">
     , y 
    <input type="text" name="respuesta_62" value="<?php echo $respuesta_62; ?>" size="41">
      (
        <input type="text" name="respuesta_63" value="<?php echo $respuesta_63; ?>" size="12">
       ).
  </li>

  <li>
    El 
    <input type="text" name="respuesta_64" value="<?php echo $respuesta_64; ?>" size="27">
      mediante la 
    <input type="text" name="respuesta_65" value="<?php echo $respuesta_65; ?>" size="21">
     
    de 
    <input type="text" name="respuesta_66" value="<?php echo $respuesta_66; ?>" size="21">
     .
  </li>
</ul>

<h4>Fuerzas</h4>

<h5>
<input type="text" name="respuesta_67" value="<?php echo $respuesta_67; ?>" size="36">    
 </h5>
<p>
<input type="text" name="respuesta_68" value="<?php echo $respuesta_68; ?>" size="8">
  las 
<input type="text" name="respuesta_69" value="<?php echo $respuesta_69; ?>" size="11">
  entre tareas y 
<input type="text" name="respuesta_70" value="<?php echo $respuesta_70; ?>" size="8">
  cómo 
<input type="text" name="respuesta_71" value="<?php echo $respuesta_71; ?>" size="8">
  los datos requeridos
<input type="text" name="respuesta_72" value="<?php echo $respuesta_72; ?>" size="8">
  aprovechar la 
<input type="text" name="respuesta_73" value="<?php echo $respuesta_73; ?>" size="8">
 .
</p>

<p>
Primero, 
<input type="text" name="respuesta_74" value="<?php echo $respuesta_74; ?>" size="19">
  de acuerdo con sus dependencias:
las que pueden 
<input type="text" name="respuesta_75" value="<?php echo $respuesta_75; ?>" size="23">
  y 
<input type="text" name="respuesta_76" value="<?php echo $respuesta_76; ?>" size="25">
 
a 
<input type="text" name="respuesta_77" value="<?php echo $respuesta_77; ?>" size="23">
 .
</p>

<p>
Segundo, se define un 
<input type="text" name="respuesta_78" value="<?php echo $respuesta_78; ?>" size="8">
  que 
<input type="text" name="respuesta_79" value="<?php echo $respuesta_79; ?>" size="21">
  entre 
<input type="text" name="respuesta_80" value="<?php echo $respuesta_80; ?>" size="16">
(en este caso, 
<input type="text" name="respuesta_81" value="<?php echo $respuesta_81; ?>" size="18">
 ).
</p>

<p>
Por supuesto, 
<input type="text" name="respuesta_82" value="<?php echo $respuesta_82; ?>" size="19">
  admiten soluciones con estas características.
</p>


<button type="submit">Enviar</button>
 <?php echo $verificar_57 ?>
    <?php echo $verificar_58 ?>
    <?php echo $verificar_59 ?>
    <?php echo $verificar_60 ?>
    <?php echo $verificar_61 ?>
    <?php echo $verificar_62 ?>
    <?php echo $verificar_63 ?>
    <?php echo $verificar_64 ?>
    <?php echo $verificar_65 ?>
    <?php echo $verificar_66 ?>

    <?php echo $verificar_67 ?>
<?php echo $verificar_68 ?>
<?php echo $verificar_69 ?>
<?php echo $verificar_70 ?>
<?php echo $verificar_71 ?>
<?php echo $verificar_72 ?>
<?php echo $verificar_73 ?>
<?php echo $verificar_74 ?>
<?php echo $verificar_75 ?>
<?php echo $verificar_76 ?>
<?php echo $verificar_77 ?>
<?php echo $verificar_78 ?>
<?php echo $verificar_79 ?>
<?php echo $verificar_80 ?>
<?php echo $verificar_81 ?>
<?php echo $verificar_82 ?>
</div>




<div class="seccion derecha">
   


<div style="position:relative; width:100%; padding-bottom:70.6%; display:block;">
 
  <svg style="position:absolute; top:0; left:0; width:100%; height:100%;"
       viewBox="0 0 680 480" role="img" xmlns="http://www.w3.org/2000/svg">
    <title>Structure Diagram - Master-Worker Design Pattern with Task</title>
 
    <!-- ── MASTER box ── -->
    <rect x="30"  y="20"  width="340" height="260" rx="0" fill="white" stroke="#333" stroke-width="1.2"/>
    <rect x="30"  y="20"  width="340" height="36"  rx="0" fill="white" stroke="#333" stroke-width="1.2"/>
    <!-- cabecera: respuesta_83 (texto quitado, input superpuesto) -->
 
    <!-- divisor atributos -->
    <line x1="30"  y1="56"  x2="370" y2="56"  stroke="#333" stroke-width="0.9"/>
    <!-- divisor atributos / métodos -->
    <line x1="30"  y1="104" x2="370" y2="104" stroke="#333" stroke-width="0.9"/>
 
    <!-- líneas separadoras internas atributos (y=56+16=72, 88) -->
    <line x1="30"  y1="72"  x2="370" y2="72"  stroke="#ddd" stroke-width="0.4"/>
    <line x1="30"  y1="88"  x2="370" y2="88"  stroke="#ddd" stroke-width="0.4"/>
 
    <!-- líneas separadoras internas métodos (+16 cada una desde y=104) -->
    <line x1="30"  y1="120" x2="370" y2="120" stroke="#ddd" stroke-width="0.4"/>
    <line x1="30"  y1="136" x2="370" y2="136" stroke="#ddd" stroke-width="0.4"/>
    <line x1="30"  y1="152" x2="370" y2="152" stroke="#ddd" stroke-width="0.4"/>
    <line x1="30"  y1="168" x2="370" y2="168" stroke="#ddd" stroke-width="0.4"/>
    <line x1="30"  y1="184" x2="370" y2="184" stroke="#ddd" stroke-width="0.4"/>
    <line x1="30"  y1="200" x2="370" y2="200" stroke="#ddd" stroke-width="0.4"/>
    <line x1="30"  y1="216" x2="370" y2="216" stroke="#ddd" stroke-width="0.4"/>
    <line x1="30"  y1="232" x2="370" y2="232" stroke="#ddd" stroke-width="0.4"/>
    <line x1="30"  y1="248" x2="370" y2="248" stroke="#ddd" stroke-width="0.4"/>
 
    <!-- ── TASK box ── -->
    <rect x="480" y="110" width="178" height="90"  rx="0" fill="white" stroke="#333" stroke-width="1.2"/>
    <rect x="480" y="110" width="178" height="34"  rx="0" fill="white" stroke="#333" stroke-width="1.2"/>
    <!-- cabecera: respuesta_94 -->
    <line x1="480" y1="144" x2="658" y2="144" stroke="#333" stroke-width="0.9"/>
    <line x1="480" y1="160" x2="658" y2="160" stroke="#ddd" stroke-width="0.4"/>
    <line x1="480" y1="168" x2="658" y2="168" stroke="#333" stroke-width="0.9"/>
    <line x1="480" y1="180" x2="658" y2="180" stroke="#ddd" stroke-width="0.4"/>
 
    <!-- Asociación Master → Task -->
    <line x1="370" y1="148" x2="480" y2="148" stroke="#333" stroke-width="1"/>
    <!-- multiplicidades: respuesta_97 (lado Master) y respuesta_98 (lado Task)
         posiciones aproximadas en SVG: x≈378,y≈143  y  x≈452,y≈143 -->
 
    <!-- ── WORKER box ── -->
    <rect x="120" y="370" width="240" height="88" rx="0" fill="white" stroke="#333" stroke-width="1.2"/>
    <rect x="120" y="370" width="240" height="34" rx="0" fill="white" stroke="#333" stroke-width="1.2"/>
    <!-- cabecera: respuesta_99 -->
    <line x1="120" y1="404" x2="360" y2="404" stroke="#333" stroke-width="0.9"/>
    <line x1="120" y1="420" x2="360" y2="420" stroke="#ddd" stroke-width="0.4"/>
    <line x1="120" y1="436" x2="360" y2="436" stroke="#ddd" stroke-width="0.4"/>
 
    <!-- Asociación Master → Worker (vertical) -->
    <line x1="200" y1="280" x2="200" y2="370" stroke="#333" stroke-width="1"/>
    <!-- multiplicidades: respuesta_102 y respuesta_103 -->
 
    <!-- Caption -->
    <text font-size="12" font-family="sans-serif" font-style="italic"
          x="340" y="472" text-anchor="middle">
      Figure 3.12: Structure Diagram - Master-Worker Design Pattern
    </text>
 
  </svg>
 
  <!-- ══════════════════════════════════════════════════
       INPUTS
       padding-bottom=70.6% → altura real del div = ancho × 0.706
       left  = x_svg / 680 * 100%
       top   = y_svg / 480 * 100%
  ══════════════════════════════════════════════════ -->
 
  <!-- respuesta_83 : "Master" — cabecera Master (rect y=20..56, cx=200)
       left=(200-65)/680=19.9%  top=20/480=4.2%  w=130/680=19.1% h=36/480=7.5% -->
 <input type="text" name="respuesta_83"
       value="<?php echo htmlspecialchars($respuesta_83); ?>"
       style="position:absolute; left:19.9%; top:4.2%; width:19.1%; height:7.1%;
              font-size:14px; font-weight:bold; padding:1px 4px;
              border:1px solid #aaa; background:#fffde7; box-sizing:border-box;
              text-align:center;"/>

<input type="text" name="respuesta_84"
       value="<?php echo htmlspecialchars($respuesta_84); ?>"
       style="position:absolute; left:4.4%; top:11.9%; width:50%; height:4.5%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_85"
       value="<?php echo htmlspecialchars($respuesta_85); ?>"
       style="position:absolute; left:4.4%; top:15.5%; width:50%; height:4.5%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_86"
       value="<?php echo htmlspecialchars($respuesta_86); ?>"
       style="position:absolute; left:4.4%; top:20%; width:50%; height:4.5%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_87"
       value="<?php echo htmlspecialchars($respuesta_87); ?>"
       style="position:absolute; left:4.4%; top:24%; width:50%; height:4.5%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_88"
       value="<?php echo htmlspecialchars($respuesta_88); ?>"
       style="position:absolute; left:4.4%; top:29%; width:50%; height:4.5%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_89"
       value="<?php echo htmlspecialchars($respuesta_89); ?>"
       style="position:absolute; left:4.4%; top:34%; width:50%; height:4.5%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_90"
       value="<?php echo htmlspecialchars($respuesta_90); ?>"
       style="position:absolute; left:4.4%; top:39%; width:50%; height:4.5%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_91"
       value="<?php echo htmlspecialchars($respuesta_91); ?>"
       style="position:absolute; left:4.4%; top:44%; width:50%; height:4.5%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_92"
       value="<?php echo htmlspecialchars($respuesta_92); ?>"
       style="position:absolute; left:4.4%; top:49%; width:50%; height:4.5%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_93"
       value="<?php echo htmlspecialchars($respuesta_93); ?>"
       style="position:absolute; left:4.4%; top:54%; width:50%; height:4.5%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_94"
       value="<?php echo htmlspecialchars($respuesta_94); ?>"
       style="position:absolute; left:74.4%; top:22.9%; width:18%; height:7.1%;
              font-size:14px; font-weight:bold; padding:1px 4px;
              border:1px solid #aaa; background:#fffde7; box-sizing:border-box;
              text-align:center;"/>

<input type="text" name="respuesta_95"
       value="<?php echo htmlspecialchars($respuesta_95); ?>"
       style="position:absolute; left:71.3%; top:30.2%; width:25%; height:5.2%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_96"
       value="<?php echo htmlspecialchars($respuesta_96); ?>"
       style="position:absolute; left:71.3%; top:35.2%; width:25%; height:5.2%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_97"
       value="<?php echo htmlspecialchars($respuesta_97); ?>"
       style="position:absolute; left:54.7%; top:27.1%; width:3.5%; height:4.6%;
              font-size:14px; padding:1px 2px; border:1px solid #aaa;
              background:#fff9c4; box-sizing:border-box; text-align:center;"/>

<input type="text" name="respuesta_98"
       value="<?php echo htmlspecialchars($respuesta_98); ?>"
       style="position:absolute; left:65.6%; top:27.1%; width:4.4%; height:4.6%;
              font-size:14px; padding:1px 2px; border:1px solid #aaa;
              background:#fff9c4; box-sizing:border-box; text-align:center;"/>

<input type="text" name="respuesta_99"
       value="<?php echo htmlspecialchars($respuesta_99); ?>"
       style="position:absolute; left:23.5%; top:77.1%; width:17.6%; height:7.1%;
              font-size:14px; font-weight:bold; padding:1px 4px;
              border:1px solid #aaa; background:#fffde7; box-sizing:border-box;
              text-align:center;"/>

<input type="text" name="respuesta_100"
       value="<?php echo htmlspecialchars($respuesta_100); ?>"
       style="position:absolute; left:17.6%; top:84.4%; width:35%; height:5.2%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_101"
       value="<?php echo htmlspecialchars($respuesta_101); ?>"
       style="position:absolute; left:17.6%; top:89.7%; width:35%; height:5.2%;
              font-size:14px; padding:1px 3px; border:1px solid #aaa;
              background:#fffde7; box-sizing:border-box;"/>

<input type="text" name="respuesta_102"
       value="<?php echo htmlspecialchars($respuesta_102); ?>"
       style="position:absolute; left:30.3%; top:59.2%; width:3.5%; height:4.6%;
              font-size:14px; padding:1px 2px; border:1px solid #aaa;
              background:#fff9c4; box-sizing:border-box; text-align:center;"/>

<input type="text" name="respuesta_103"
       value="<?php echo htmlspecialchars($respuesta_103); ?>"
       style="position:absolute; left:30.3%; top:72.5%; width:4.4%; height:4.6%;
              font-size:14px; padding:1px 2px; border:1px solid #aaa;
              background:#fff9c4; box-sizing:border-box; text-align:center;"/>
 
</div><!-- /.wrapper -->


<button type="submit">Enviar</button>
<?php echo $verificar_83 ?>
<?php echo $verificar_84 ?>
<?php echo $verificar_85 ?>
<?php echo $verificar_86 ?>
<?php echo $verificar_87 ?>
<?php echo $verificar_88 ?>
<?php echo $verificar_89 ?>
<?php echo $verificar_90 ?>
<?php echo $verificar_91 ?>
<?php echo $verificar_92 ?>
<?php echo $verificar_93 ?>
<br>
<?php echo $verificar_94 ?>
<?php echo $verificar_95 ?>
<?php echo $verificar_96 ?>
<?php echo $verificar_97 ?>
<?php echo $verificar_98 ?>
<?php echo $verificar_99 ?>
<?php echo $verificar_100 ?>
<?php echo $verificar_101 ?>
<?php echo $verificar_102 ?>
<?php echo $verificar_103 ?>
<hr>
<h4>Participantes</h4>

<h5>
<input type="text" name="respuesta_104" value="<?php echo $respuesta_104; ?>" size="4">    
 </h5>
<p>
Esta clase tiene las 
<input type="text" name="respuesta_105" value="<?php echo $respuesta_105; ?>" size="21">
  que el master en el patrón de diseño
Master / Worker (de la Sección 3.2.7):
</p>

<p>
“El Master contiene la colección compartida de tareas, usualmente una cola,
donde las tareas se almacenan después de ser divididas. Posee una segunda cola compartida
donde se almacenan los resultados de los cálculos de los workers. En resumen,
el Master mantiene registradas las tareas, lanza los procesadores (workers)
y recopila los resultados de los workers para producir el resultado final.”
</p>

<p>
En este patrón, esta clase tiene un 
<input type="text" name="respuesta_106" value="<?php echo $respuesta_106; ?>" size="26">
 .
El Master debe 
<input type="text" name="respuesta_107" value="<?php echo $respuesta_107; ?>" size="14">
  con 
<input type="text" name="respuesta_108" value="<?php echo $respuesta_108; ?>" size="16">
 .
</p>

<h5>
<input type="text" name="respuesta_109" value="<?php echo $respuesta_109; ?>" size="4">    
 </h5>
<p>
Esta clase tiene las 
<input type="text" name="respuesta_110" value="<?php echo $respuesta_110; ?>" size="22">
  que el worker en el patrón de diseño
Master / Worker (de la Sección 3.2.7):
</p>

<p>
“Los workers solicitan una tarea desde la colección compartida de tareas registradas
en la cola del master y la procesan. Finalmente, los workers retornan resultados
parciales del cálculo al master.”
</p>

<h5>
<input type="text" name="respuesta_111" value="<?php echo $respuesta_111; ?>" size="4">    
 </h5>
<p>
Es 
<input type="text" name="respuesta_112" value="<?php echo $respuesta_112; ?>" size="8">
  de 
<input type="text" name="respuesta_113" value="<?php echo $respuesta_113; ?>" size="10">
  las 
<input type="text" name="respuesta_114" value="<?php echo $respuesta_114; ?>" size="26">
  en la 
<input type="text" name="respuesta_115" value="<?php echo $respuesta_115; ?>" size="8">
  de los 
<input type="text" name="respuesta_116" value="<?php echo $respuesta_116; ?>" size="16">
  para 
<input type="text" name="respuesta_117" value="<?php echo $respuesta_117; ?>" size="21">
 , 
<input type="text" name="respuesta_118" value="<?php echo $respuesta_118; ?>" size="18">
  por 
<input type="text" name="respuesta_119" value="<?php echo $respuesta_119; ?>" size="11">
 .
</p>

<p>
Esta es la principal 
<input type="text" name="respuesta_120" value="<?php echo $respuesta_120; ?>" size="10">
  entre el patrón de diseño Master / Worker
y esta variación.
</p>


<button type="submit">Enviar</button>
<?php echo $verificar_104 ?>
<?php echo $verificar_105 ?>
<?php echo $verificar_106 ?>
<?php echo $verificar_107 ?>
<?php echo $verificar_108 ?>
<?php echo $verificar_109 ?>
<?php echo $verificar_110 ?>
<?php echo $verificar_111 ?>
<?php echo $verificar_112 ?>
<br>
<?php echo $verificar_113 ?>
<?php echo $verificar_114 ?>
<?php echo $verificar_115 ?>
<?php echo $verificar_116 ?>
<?php echo $verificar_117 ?>
<?php echo $verificar_118 ?>
<?php echo $verificar_119 ?>
<?php echo $verificar_120 ?>
<hr>
<h4>Comportamiento</h4>

<h5>Figura 3.13 - Patrón de Diseño Separable Dependencies</h5>

<p>
Los escenarios descritos en el patrón de diseño Master / Worker son casi los mismos
para este patrón (Sección 3.2.7).
</p>

<p>
La principal diferencia se encuentra en la clase 
<input type="text" name="respuesta_121" value="<?php echo $respuesta_121; ?>" size="4">
  y en la clase 
<input type="text" name="respuesta_122" value="<?php echo $respuesta_122; ?>" size="4">
 .
</p>

<p>
En el momento de la creación, las tareas deben ejecutarse con 
<input type="text" name="respuesta_123" value="<?php echo $respuesta_123; ?>" size="10">
 :
</p>

<ul>
  <li>
    <input type="text" name="respuesta_124" value="<?php echo $respuesta_124; ?>" size="29">
     .
  </li>

  <li>
    <input type="text" name="respuesta_125" value="<?php echo $respuesta_125; ?>" size="24">
     .
  </li>
</ul>

<p>
El Master 
<input type="text" name="respuesta_126" value="<?php echo $respuesta_126; ?>" size="29">
 .
</p>   

<button type="submit">Enviar</button>
    <?php echo $verificar_121 ?>
<?php echo $verificar_122 ?>
<?php echo $verificar_123 ?>
<?php echo $verificar_124 ?>
<?php echo $verificar_125 ?>
<?php echo $verificar_126 ?>

<hr>
     
<div style="position:relative; width:100%; padding-bottom:79.3%; display:block;">
 
  <svg style="position:absolute; top:0; left:0; width:100%; height:100%;"
       viewBox="28 0 820 650"
       role="img"
       xmlns="http://www.w3.org/2000/svg">
 
    <defs>
      <marker id="arr313"
              viewBox="0 0 10 10" refX="8" refY="5"
              markerWidth="5" markerHeight="6"
              orient="auto-start-reverse">
        <path d="M0 0L10 5L0 10Z" fill="#222" stroke="#222" stroke-width="0.5"/>
      </marker>
    </defs>
 
    <!-- ── LIFELINES ── -->
    <line x1="137" y1="68" x2="137" y2="615" stroke="#555" stroke-width="2.5" stroke-dasharray="4 3"/>
    <line x1="478" y1="68" x2="478" y2="615" stroke="#555" stroke-width="2.5" stroke-dasharray="4 3"/>
    <line x1="680" y1="68" x2="680" y2="615" stroke="#555" stroke-width="2.5" stroke-dasharray="4 3"/>
 
    <!-- ── PARTICIPANTS ── -->
    <!-- Master -->
    <rect x="92"  y="22" width="90" height="38" rx="3" fill="#f8f9fa" stroke="#222" stroke-width="2"/>
    <text x="137" y="46" text-anchor="middle" font-size="14" font-family="Arial, sans-serif" font-weight="600" fill="#222">Master</text>
 
    <!-- Task -->
    <rect x="440" y="22" width="76" height="36" rx="3" fill="#f8f9fa" stroke="#222" stroke-width="2"/>
    <text x="478" y="46" text-anchor="middle" font-size="14" font-family="Arial, sans-serif" font-weight="600" fill="#222">Task</text>
 
    <!-- Worker (doble rect = instancia) -->
    <rect x="642" y="18" width="76" height="36" rx="3" fill="#f8f9fa" stroke="#222" stroke-width="2"/>
    <rect x="636" y="24" width="76" height="36" rx="3" fill="#f8f9fa" stroke="#222" stroke-width="2"/>
    <text x="680" y="46" text-anchor="middle" font-size="14" font-family="Arial, sans-serif" font-weight="600" fill="#222">Worker</text>
 
    <!-- ── MASTER ACTIVATION BOX ── -->
    <rect x="130" y="68" width="14" height="520" rx="2" fill="#fff" stroke="#222" stroke-width="1.5"/>
 
    <!-- ── separateDependencies() SELF CALL ── -->
    <rect x="133" y="78" width="8" height="26" rx="2" fill="#fff" stroke="#222" stroke-width="1.1"/>
    <line x1="141" y1="88"  x2="182" y2="88"  stroke="#222" stroke-width="1.1"/>
    <line x1="182" y1="88"  x2="182" y2="104" stroke="#222" stroke-width="1.1"/>
    <line x1="141" y1="104" x2="182" y2="104" stroke="#222" stroke-width="1.1" marker-end="url(#arr313)"/>
    <!-- label: respuesta_127 — input superpuesto, texto quitado -->
 
    <!-- ── LOOP 1 ── -->
    <rect x="28" y="132" width="730" height="148" rx="4" fill="none" stroke="#444" stroke-width="2"/>
    <rect x="28" y="132" width="48"  height="22"  fill="#fff" stroke="#444" stroke-width="1.5"/>
    <text x="52" y="148" text-anchor="middle" font-size="12" font-family="Arial, sans-serif" fill="#444">Loop</text>
 
    <!-- createTask(Data):Task  Master→Task y=172 -->
    <line x1="137" y1="172" x2="478" y2="172" stroke="#222" stroke-width="1.4" marker-end="url(#arr313)"/>
    <!-- label: respuesta_128 -->
    <rect x="471" y="160" width="14" height="68" rx="2" fill="#fff" stroke="#222" stroke-width="1.2"/>
 
    <text x="155" y="208" font-size="10" font-family="Arial, sans-serif" fill="#444">[While there are</text>
    <text x="155" y="222" font-size="10" font-family="Arial, sans-serif" fill="#444">separated dependencies]</text>
 
    <!-- ── launchWorkers() Master→Worker y=260 ── -->
    <line x1="137" y1="260" x2="680" y2="260" stroke="#222" stroke-width="1.4" marker-end="url(#arr313)"/>
    <!-- label: respuesta_129 -->
    <rect x="673" y="256" width="14" height="32" rx="2" fill="#fff" stroke="#222" stroke-width="1.2"/>
 
    <!-- ── LOOP 2 ── -->
    <rect x="28"  y="312" width="730" height="218" rx="4" fill="none" stroke="#444" stroke-width="2"/>
    <rect x="28"  y="312" width="48"  height="22"  fill="#fff" stroke="#444" stroke-width="1.5"/>
    <text x="52"  y="328" text-anchor="middle" font-size="12" font-family="Arial, sans-serif" fill="#444">Loop</text>
 
    <!-- Worker activation -->
    <rect x="673" y="340" width="14" height="168" rx="2" fill="#fff" stroke="#222" stroke-width="1.5"/>
 
    <!-- requestTask() SELF CALL y≈360..376 -->
    <rect x="676" y="352" width="8" height="26" rx="2" fill="#fff" stroke="#222" stroke-width="1.1"/>
    <line x1="684" y1="360" x2="724" y2="360" stroke="#222" stroke-width="1.1"/>
    <line x1="724" y1="360" x2="724" y2="376" stroke="#222" stroke-width="1.1"/>
    <line x1="684" y1="376" x2="724" y2="376" stroke="#222" stroke-width="1.1" marker-end="url(#arr313)"/>
    <!-- label: respuesta_130 -->
 
    <!-- getTask() Worker→Master y=398 -->
    <line x1="680" y1="398" x2="137" y2="398" stroke="#222" stroke-width="1.4" marker-end="url(#arr313)"/>
    <!-- label: respuesta_131 -->
 
    <!-- processTask() SELF CALL y≈426..442 -->
    <rect x="676" y="418" width="8" height="26" rx="2" fill="#fff" stroke="#222" stroke-width="1.1"/>
    <line x1="684" y1="426" x2="724" y2="426" stroke="#222" stroke-width="1.1"/>
    <line x1="724" y1="426" x2="724" y2="442" stroke="#222" stroke-width="1.1"/>
    <line x1="684" y1="442" x2="724" y2="442" stroke="#222" stroke-width="1.1" marker-end="url(#arr313)"/>
    <!-- label: respuesta_132 -->
 
    <!-- addPartialResult() Worker→Master y=478 -->
    <line x1="680" y1="478" x2="137" y2="478" stroke="#222" stroke-width="1.4" marker-end="url(#arr313)"/>
    <!-- label: respuesta_133 -->
 
    <text x="700" y="502" font-size="10" font-family="Arial, sans-serif" fill="#444">[While there are tasks]</text>
 
    <!-- shutdownWorkers() Master→Worker y=562 -->
    <line x1="137" y1="562" x2="673" y2="562" stroke="#222" stroke-width="1.4" marker-end="url(#arr313)"/>
    <!-- label: respuesta_134 -->
    <rect x="673" y="558" width="14" height="32" rx="2" fill="#fff" stroke="#222" stroke-width="1.2"/>
 
    <!-- ── CAPTION ── -->
    <text x="310" y="630" text-anchor="middle" font-size="12.5"
          font-family="Arial, sans-serif" font-style="italic" fill="#444">
      Figure 3.13: Processing Sequence Diagram - Separable Dependencies Design Pattern
    </text>
 
  </svg>
 
  <!-- ══════════════════════════════════════════════════════
       INPUTS
       Wrapper: width=820 (viewBox 28..848), height=650
       left  = (x_svg - 28) / 820 * 100%
       top   = y_svg / 650 * 100%
  ══════════════════════════════════════════════════════ -->
 
  <!-- respuesta_127 : separateDependencies():void
       Texto SVG original: x=188, y=86 → encima de la flecha y=88
       input arriba del loop-back: left=(188-28)/820=19.5%  top=80/650=12.3% -->
  <input type="text" name="respuesta_127"
         value="<?php echo htmlspecialchars($respuesta_127); ?>"
         style="position:absolute; left:19.5%; top:11%; width:25%; height:4%;
                font-size:15px; padding:1px 3px; border:1px solid #aaa;
                background:#fffde7; box-sizing:border-box;"/>
 
  <!-- respuesta_128 : createTask(Data):Task
       Texto SVG: x=308 (centro), y=165 → encima flecha y=172
       left=(308-28-80)/820=24.4%  top=158/650=24.3% -->
  <input type="text" name="respuesta_128"
         value="<?php echo htmlspecialchars($respuesta_128); ?>"
         style="position:absolute; left:19%; top:23%; width:25%; height:4%;
                font-size:15px; padding:1px 3px; border:1px solid #aaa;
                background:#fffde7; box-sizing:border-box;"/>
 
  <!-- respuesta_129 : launchWorkers():void
       Texto SVG: x=410 (centro), y=253 → encima flecha y=260
       left=(410-28-100)/820=34.4%  top=245/650=37.7% -->
  <input type="text" name="respuesta_129"
         value="<?php echo htmlspecialchars($respuesta_129); ?>"
         style="position:absolute; left:25%; top:37%; width:25%; height:4%;
                font-size:15px; padding:1px 3px; border:1px solid #aaa;
                background:#fffde7; box-sizing:border-box;"/>
 
  <!-- respuesta_130 : requestTask():Task
       Texto SVG: x=730, y=363 → derecha del self-call Worker
       left=(730-28)/820=85.6%  top=356/650=54.8% -->
  <input type="text" name="respuesta_130"
         value="<?php echo htmlspecialchars($respuesta_130); ?>"
         style="position:absolute; left:86%; top:53%; width:15%; height:4%;
                font-size:15px; padding:1px 3px; border:1px solid #aaa;
                background:#fffde7; box-sizing:border-box;"/>
 
  <!-- respuesta_131 : getTask():Task
       Texto SVG: x=410 (centro), y=391 → encima flecha y=398
       left=(410-28-80)/820=36.8%  top=383/650=58.9% -->
  <input type="text" name="respuesta_131"
         value="<?php echo htmlspecialchars($respuesta_131); ?>"
         style="position:absolute; left:28%; top:58%; width:25%; height:4%;
                font-size:15px; padding:1px 3px; border:1px solid #aaa;
                background:#fffde7; box-sizing:border-box;"/>
 
  <!-- respuesta_132 : processTask(Task):void
       Texto SVG: x=710, y=419 → encima self-call Worker y=426
       left=(710-28)/820=83.2%  top=412/650=63.4% -->
  <input type="text" name="respuesta_132"
         value="<?php echo htmlspecialchars($respuesta_132); ?>"
         style="position:absolute; left:82%; top:62%; width:18%; height:4%;
                font-size:15px; padding:1px 3px; border:1px solid #aaa;
                background:#fffde7; box-sizing:border-box;"/>
 
  <!-- respuesta_133 : addPartialResult(Object):void
       Texto SVG: x=410 (centro), y=471 → encima flecha y=478
       left=(410-28-100)/820=34.4%  top=463/650=71.2% -->
  <input type="text" name="respuesta_133"
         value="<?php echo htmlspecialchars($respuesta_133); ?>"
         style="position:absolute; left:22%; top:70%; width:25%; height:4%;
                font-size:15px; padding:1px 3px; border:1px solid #aaa;
                background:#fffde7; box-sizing:border-box;"/>
 
  <!-- respuesta_134 : shutdownWorkers():void
       Texto SVG: x=410 (centro), y=555 → encima flecha y=562
       left=(410-28-100)/820=34.4%  top=547/650=84.2% -->
  <input type="text" name="respuesta_134"
         value="<?php echo htmlspecialchars($respuesta_134); ?>"
         style="position:absolute; left:25%; top:83%; width:25%; height:4%;
                font-size:15px; padding:1px 3px; border:1px solid #aaa;
                background:#fffde7; box-sizing:border-box;"/>
 
</div><!-- /.wrapper -->
 
    <button type="submit">Enviar</button>
<?php echo $verificar_126 ?>
<?php echo $verificar_127 ?>
<?php echo $verificar_128 ?>
<?php echo $verificar_129 ?>
<?php echo $verificar_130 ?>
<?php echo $verificar_131 ?>
<?php echo $verificar_132 ?>
<?php echo $verificar_133 ?>
<?php echo $verificar_134 ?>

<hr>
    <strong>si desea ver las soluciones escribir: mostrar_solucion</strong>
    <br>
    <input type="text" id="mostrar_solucion" name="mostrar_solucion"  value="<?php echo $mostrar_solucion?>">
    <button type="submit"   >Mostrar Solución</button>
</div>
</div>
 </form>
<div class="centered-container">
    <a
        name="siguiente"
        id="siguiente"
        class="btn btn-primary"
        href="Cuarto.php"
        role="button"
        width="50px"
        height="50px"
    >Siguiente</a>
</div>
</body>
</html>
