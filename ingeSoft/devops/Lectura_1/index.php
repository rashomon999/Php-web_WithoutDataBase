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
     $respuesta_1 = 'conjunto de practicas destinadas';
    $respuesta_2 = 'reducir el tiempo';
    $respuesta_3 = 'realizar';
    $respuesta_4 = 'cambio';
    $respuesta_5 = 'sistema';
    $respuesta_6 = 'cambio';
    $respuesta_7 = 'produccion';
    $respuesta_8 = 'alta calidad';
    $respuesta_9 = 'tiempo';
    $respuesta_10 = 'entrega';
    $respuesta_11 = 'time';
    $respuesta_12 = 'rapido';
    $respuesta_13 = 'calidad';
    $respuesta_14 = 'errores';
    $respuesta_15 = 'Automatizar';
    $respuesta_16 = 'colaboracion';
    $respuesta_17 = 'silos';
    $respuesta_18 = 'cinco';
    $respuesta_19 = 'Operaciones';
    $respuesta_20 = 'ciudadanos';
    $respuesta_21 = 'primera clase';
    $respuesta_22 = 'First-class';
    $respuesta_23 = 'citizens';
    $respuesta_24 = 'Definicion';
    $respuesta_25 = 'requisitos';
    $respuesta_26 = 'monitoreo';
    $respuesta_27 = 'Logging';
    $respuesta_28 = 'Disponibilidad';
    $respuesta_29 = 'Seguridad';
    $respuesta_30 = 'final';
    $respuesta_31 = 'desplegar';
    $respuesta_32 = 'responsable';
    $respuesta_33 = 'incidentes relevantes';
    $respuesta_34 = 'entrega codigo';
    $respuesta_35 = 'mantiene sistema';
    $respuesta_36 = 'desarrolla';
    $respuesta_37 = 'operar';
    $respuesta_38 = 'problemas';
    $respuesta_39 = 'tiempo';
    $respuesta_40 = 'detectar';
    $respuesta_41 = 'error';
    $respuesta_42 = 'solucionarlo';
    $respuesta_43 = 'proceso';
    $respuesta_44 = 'despliegue comun';
    $respuesta_45 = 'Desarrollo';
    $respuesta_46 = 'Operaciones';
    $respuesta_47 = 'Equipos relacionados';
    $respuesta_48 = 'errores manuales';
    $respuesta_49 = 'configuraciones incorrectas';
    $respuesta_50 = 'facilidad';
    $respuesta_51 = 'rastrear cambios';
    $respuesta_52 = 'despliegue continuo';
    $respuesta_53 = 'reducir';
    $respuesta_54 = 'tiempo';
    $respuesta_55 = 'Commit';
    $respuesta_56 = 'desarrollador';
    $respuesta_57 = 'Produccion';
    $respuesta_58 = 'Integracion continua';
    $respuesta_59 = 'Pruebas automaticas';
    $respuesta_60 = 'Pipelines';
    $respuesta_61 = 'infraestructura';
    $respuesta_62 = 'codigo';
    $respuesta_63 = 'Infrastructure';
    $respuesta_64 = 'Code';
    $respuesta_65 = 'infraestructura';
    $respuesta_66 = 'manejarse';
    $respuesta_67 = 'software';
    $respuesta_68 = 'Scripts';
    $respuesta_69 = 'Configuraciones';
    $respuesta_70 = 'Archivos de definicion';
    $respuesta_71 = 'versiones';
    $respuesta_72 = 'Pruebas';
    $respuesta_73 = 'Revision';
    $respuesta_74 = 'plan';
    $respuesta_75 = 'lanzamiento';
    $respuesta_76 = 'Funcionalidades nuevas';
    $respuesta_77 = 'Fechas';
    $respuesta_78 = 'Recursos necesarios';
    $respuesta_79 = 'Capacitacion';
    $respuesta_80 = 'Operaciones';
    $respuesta_81 = 'compatibilidad';
    $respuesta_82 = 'compatibilidad';
    $respuesta_83 = 'Librerias';
    $respuesta_84 = 'Plataformas';
    $respuesta_85 = 'Servicios externos';
    $respuesta_86 = 'integridad';
    $respuesta_87 = 'paquete';
    $respuesta_88 = 'lanzamiento';
    $respuesta_89 = 'incluir';
    $respuesta_90 = 'antiguas accidentalmente';
    $respuesta_91 = 'componentes';
    $respuesta_92 = 'desplegados';
    $respuesta_93 = 'rastrear';
    $respuesta_94 = 'revertir cambios';
    $respuesta_95 = 'despliegue';
    $respuesta_96 = 'Instalar';
    $respuesta_97 = 'Probar';
    $respuesta_98 = 'Verificar';
    $respuesta_99 = 'Desinstalar';
    $respuesta_100 = 'rollback';
    $respuesta_101 = 'Automatizacion';
    $respuesta_102 = 'automaticamente';
    $respuesta_103 = 'cambios';
    $respuesta_104 = 'errores';
    $respuesta_105 = 'historial';
    $respuesta_106 = 'politicas';
    $respuesta_107 = 'Pruebas automaticas';
    $respuesta_108 = 'configuracion';
    $respuesta_109 = 'equipo';
    $respuesta_110 = 'desarrollo';
    $respuesta_111 = 'Entregar';
    $respuesta_112 = 'Mantener';
    $respuesta_113 = 'Monitorear';
    $respuesta_114 = 'Soportar';
    $respuesta_115 = 'agiles';
    $respuesta_116 = 'Inception';
    $respuesta_117 = 'inicio';
    $respuesta_118 = 'release';
    $respuesta_119 = 'Requisitos';
    $respuesta_120 = 'Operaciones';
    $respuesta_121_1 = 'Logs';
    $respuesta_121 = 'Compatibilidad';
    $respuesta_122 = 'Monitoreo';
    $respuesta_123 = 'Construction';
    $respuesta_124 = 'construccion';
    $respuesta_125 = 'Control';
    $respuesta_126 = 'versiones';
    $respuesta_127 = 'Integracion continua';
    $respuesta_128 = 'respuesta';
    $respuesta_129 = 'Pruebas automaticas';
    $respuesta_130 = 'Despliegue continuo';
    $respuesta_131 = 'Transition';
    $respuesta_132 = 'transicion';
    $respuesta_133 = 'despliegue';
    $respuesta_134 = 'Despliega';
    $respuesta_135 = 'Monitorea';
    $respuesta_136 = 'rollback';
    $respuesta_137 = 'problemas';
    $respuesta_138 = 'respuesta';
    $respuesta_139 = 'respuesta';
    $respuesta_140 = 'respuesta';
        // Marcar todas como correctas
    for ($i = 1; $i <= 122; $i++) {
    ${"verificar_$i"} = "correcto";
    }

    } else {
    $respuesta_1 = isset($_POST['respuesta_1']) ? $_POST['respuesta_1'] : '';
   if ($respuesta_1 === 'conjunto de practicas destinadas') {  
       $verificar_1 = "correcto";
   } elseif ($respuesta_1 === '') {
       $verificar_1 = '';
   } else {
       $verificar_1 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_2 = isset($_POST['respuesta_2']) ? $_POST['respuesta_2'] : '';
   if ($respuesta_2 === 'reducir el tiempo') {  
       $verificar_2 = "correcto";
   } elseif ($respuesta_2 === '') {
       $verificar_2 = '';
   } else {
       $verificar_2 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_3 = isset($_POST['respuesta_3']) ? $_POST['respuesta_3'] : '';
   if ($respuesta_3 === 'realizar') {  
       $verificar_3 = "correcto";
   } elseif ($respuesta_3 === '') {
       $verificar_3 = '';
   } else {
       $verificar_3 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_4 = isset($_POST['respuesta_4']) ? $_POST['respuesta_4'] : '';
   if ($respuesta_4 === 'cambio') {  
       $verificar_4 = "correcto";
   } elseif ($respuesta_4 === '') {
       $verificar_4 = '';
   } else {
       $verificar_4 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_5 = isset($_POST['respuesta_5']) ? $_POST['respuesta_5'] : '';
   if ($respuesta_5 === 'sistema') {  
       $verificar_5 = "correcto";
   } elseif ($respuesta_5 === '') {
       $verificar_5 = '';
   } else {
       $verificar_5 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_6 = isset($_POST['respuesta_6']) ? $_POST['respuesta_6'] : '';
   if ($respuesta_6 === 'cambio') {  
       $verificar_6 = "correcto";
   } elseif ($respuesta_6 === '') {
       $verificar_6 = '';
   } else {
       $verificar_6 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_7 = isset($_POST['respuesta_7']) ? $_POST['respuesta_7'] : '';
   if ($respuesta_7 === 'produccion') {  
       $verificar_7 = "correcto";
   } elseif ($respuesta_7 === '') {
       $verificar_7 = '';
   } else {
       $verificar_7 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_8 = isset($_POST['respuesta_8']) ? $_POST['respuesta_8'] : '';
   if ($respuesta_8 === 'alta calidad') {  
       $verificar_8 = "correcto";
   } elseif ($respuesta_8 === '') {
       $verificar_8 = '';
   } else {
       $verificar_8 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_9 = isset($_POST['respuesta_9']) ? $_POST['respuesta_9'] : '';
   if ($respuesta_9 === 'tiempo') {  
       $verificar_9 = "correcto";
   } elseif ($respuesta_9 === '') {
       $verificar_9 = '';
   } else {
       $verificar_9 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_10 = isset($_POST['respuesta_10']) ? $_POST['respuesta_10'] : '';
   if ($respuesta_10 === 'entrega') {  
       $verificar_10 = "correcto";
   } elseif ($respuesta_10 === '') {
       $verificar_10 = '';
   } else {
       $verificar_10 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_11 = isset($_POST['respuesta_11']) ? $_POST['respuesta_11'] : '';
   if ($respuesta_11 === 'time') {  
       $verificar_11 = "correcto";
   } elseif ($respuesta_11 === '') {
       $verificar_11 = '';
   } else {
       $verificar_11 = "incorrecto";
   }


    // Verificar la respuesta de la primera pregunta
    $respuesta_12 = isset($_POST['respuesta_12']) ? $_POST['respuesta_12'] : '';
    if ($respuesta_12 === 'rapido') {  
        $verificar_12 = "correcto";
    } elseif ($respuesta_12 === '') {
        $verificar_12 = '';
    } else {
        $verificar_12 = "incorrecto";
    }
  
    // Verificar la respuesta de la segunda pregunta
    $respuesta_13 = isset($_POST['respuesta_13']) ? $_POST['respuesta_13'] : '';
    if ($respuesta_13 === 'calidad') { 
        $verificar_13 = "correcto";
    } elseif ($respuesta_13 === '') {
        $verificar_13 = '';
    } else {
         $verificar_13 = "incorrecto";
    }
  
    // Verificar la respuesta de la tercera pregunta
    $respuesta_14 = isset($_POST['respuesta_14']) ? $_POST['respuesta_14'] : '';
    if ($respuesta_14 === 'errores') {  
        $verificar_14 = "correcto";
    } elseif ($respuesta_14 === '') {
        $verificar_14 = '';
    } else {
        $verificar_14 = "incorrecto";
    }
  
    // Verificar la respuesta de la cuarta pregunta
    $respuesta_15 = isset($_POST['respuesta_15']) ? $_POST['respuesta_15'] : '';
    if ($respuesta_15 === 'Automatizar') { 
        $verificar_15 = "correcto";
    } elseif ($respuesta_15 === '') {
        $verificar_15 = '';
    } else {
        $verificar_15 = "incorrecto";
    }
  
    // Verificar la respuesta de la quinta pregunta
    $respuesta_16 = isset($_POST['respuesta_16']) ? $_POST['respuesta_16'] : '';
    if ($respuesta_16 === 'colaboracion') {  
        $verificar_16 = "correcto";
    } elseif ($respuesta_16 === '') {
        $verificar_16 = '';
    } else {
        $verificar_16 = "incorrecto";
    }
  
    // Verificar la respuesta de la sexta pregunta
    $respuesta_17 = isset($_POST['respuesta_17']) ? $_POST['respuesta_17'] : '';
    if ($respuesta_17 === 'silos') {  
        $verificar_17 = "correcto";
        } elseif ($respuesta_17 === '') {
        $verificar_17 = '';
    } else {
        $verificar_17 = "incorrecto";
    }
  
    // Verificar la respuesta de la séptima pregunta
    $respuesta_18 = isset($_POST['respuesta_18']) ? $_POST['respuesta_18'] : '';
    if ($respuesta_18 === 'cinco') {  
        $verificar_18 = "correcto";
    } elseif ($respuesta_18 === '') {
        $verificar_18 = '';
    } else {
        $verificar_18 = "incorrecto";
    }
  
    // Verificar la respuesta de la octava pregunta
    $respuesta_19 = isset($_POST['respuesta_19']) ? $_POST['respuesta_19'] : '';
    if ($respuesta_19 === 'Operaciones'
    || $respuesta_19 === 'operaciones'
    ) {  
        $verificar_19 = "correcto";
    } elseif ($respuesta_19 === '') {
        $verificar_19 = '';
    } else {
        $verificar_19 = "incorrecto";
    }
  
    // Verificar la respuesta de la novena pregunta
    $respuesta_20 = isset($_POST['respuesta_20']) ? $_POST['respuesta_20'] : '';
    if ($respuesta_20 === 'ciudadanos') {  
        $verificar_20 = "correcto";
    } elseif ($respuesta_20 === '') {
        $verificar_20 = '';
    } else {
        $verificar_20 = "incorrecto";
    }
  
    // Verificar la respuesta de la décima pregunta
    $respuesta_21 = isset($_POST['respuesta_21']) ? $_POST['respuesta_21'] : '';
    if ($respuesta_21 === 'primera clase') {  
         $verificar_21 = "correcto";
    } elseif ($respuesta_21 === '') {
        $verificar_21 = '';
    } else {
        $verificar_21 = "incorrecto";
    }
  
    // Verificar la respuesta de la undécima pregunta
    $respuesta_22 = isset($_POST['respuesta_22']) ? $_POST['respuesta_22'] : '';
    if ($respuesta_22 === 'First-class'
    || $respuesta_22 === 'first-class'
    ) {  
        $verificar_22 = "correcto";
    } elseif ($respuesta_22 === '') {
        $verificar_22 = '';
    } else {
        $verificar_22 = "incorrecto";
    }

     // Verificar la respuesta de la primera pregunta
   $respuesta_23 = isset($_POST['respuesta_23']) ? $_POST['respuesta_23'] : '';
   if ($respuesta_23 === 'citizens') {  
       $verificar_23 = "correcto";
   } elseif ($respuesta_23 === '') {
       $verificar_23 = '';
   } else {
       $verificar_23 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_24 = isset($_POST['respuesta_24']) ? $_POST['respuesta_24'] : '';
   if ($respuesta_24 === 'Definicion') {  
       $verificar_24 = "correcto";
   } elseif ($respuesta_24 === '') {
       $verificar_24 = '';
   } else {
       $verificar_24 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_25 = isset($_POST['respuesta_25']) ? $_POST['respuesta_25'] : '';
   if ($respuesta_25 === 'requisitos') { 
       $verificar_25 = "correcto";
   } elseif ($respuesta_25 === '') {
       $verificar_25 = '';
   } else {
       $verificar_25 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_26 = isset($_POST['respuesta_26']) ? $_POST['respuesta_26'] : '';
   if ($respuesta_26 === 'monitoreo') {  
       $verificar_26 = "correcto";
   } elseif ($respuesta_26 === '') {
       $verificar_26 = '';
   } else {
       $verificar_26 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_27 = isset($_POST['respuesta_27']) ? $_POST['respuesta_27'] : '';
   if ($respuesta_27 === 'Logging') {  
       $verificar_27 = "correcto";
   } elseif ($respuesta_27 === '') {
       $verificar_27 = '';
   } else {
       $verificar_27 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_28 = isset($_POST['respuesta_28']) ? $_POST['respuesta_28'] : '';
   if ($respuesta_28 === 'Disponibilidad') {  
       $verificar_28 = "correcto";
   } elseif ($respuesta_28 === '') {
       $verificar_28 = '';
   } else {
       $verificar_28 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_29 = isset($_POST['respuesta_29']) ? $_POST['respuesta_29'] : '';
   if ($respuesta_29 === 'Seguridad') {  
       $verificar_29 = "correcto";
   } elseif ($respuesta_29 === '') {
       $verificar_29 = '';
   } else {
       $verificar_29 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_30 = isset($_POST['respuesta_30']) ? $_POST['respuesta_30'] : '';
   if ($respuesta_30 === 'final') {  
       $verificar_30 = "correcto";
   } elseif ($respuesta_30 === '') {
       $verificar_30 = '';
   } else {
       $verificar_30 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_31 = isset($_POST['respuesta_31']) ? $_POST['respuesta_31'] : '';
   if ($respuesta_31 === 'desplegar') {  
       $verificar_31 = "correcto";
   } elseif ($respuesta_31 === '') {
       $verificar_31 = '';
   } else {
       $verificar_31 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_32 = isset($_POST['respuesta_32']) ? $_POST['respuesta_32'] : '';
   if ($respuesta_32 === 'responsable') {  
       $verificar_32 = "correcto";
   } elseif ($respuesta_32 === '') {
       $verificar_32 = '';
   } else {
       $verificar_32 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_33 = isset($_POST['respuesta_33']) ? $_POST['respuesta_33'] : '';
   if ($respuesta_33 === 'incidentes relevantes') {  
       $verificar_33 = "correcto";
   } elseif ($respuesta_33 === '') {
       $verificar_33 = '';
   } else {
       $verificar_33 = "incorrecto";
   }

    $respuesta_34 = isset($_POST['respuesta_34']) ? $_POST['respuesta_34'] : '';
    if ($respuesta_34 === 'entrega codigo'
    || $respuesta_34 === 'entrega el codigo'
    ) { 
        $verificar_34 = "correcto";
    } elseif ($respuesta_34 === '') {
        $verificar_34 = '';
    } else {
        $verificar_34 = "incorrecto";
    }

    $respuesta_35 = isset($_POST['respuesta_35']) ? $_POST['respuesta_35'] : '';
    if ($respuesta_35 === 'mantiene sistema'
    || $respuesta_35 === 'mantiene el sistema'
    ) { 
        $verificar_35 = "correcto";
    } elseif ($respuesta_35 === '') {
        $verificar_35 = '';
    } else {
        $verificar_35 = "incorrecto";
    }

    $respuesta_36 = isset($_POST['respuesta_36']) ? $_POST['respuesta_36'] : '';
    if ($respuesta_36 === 'desarrolla') { 
        $verificar_36 = "correcto";
    } elseif ($respuesta_36 === '') {
    $verificar_36 = '';
    } else {
        $verificar_36 = "incorrecto";
    }

    $respuesta_37 = isset($_POST['respuesta_37']) ? $_POST['respuesta_37'] : '';
    if ($respuesta_37 === 'operar') { 
        $verificar_37 = "correcto";
    } elseif ($respuesta_37 === '') {
        $verificar_37 = '';
    } else {
        $verificar_37 = "incorrecto";
    }

    $respuesta_38 = isset($_POST['respuesta_38']) ? $_POST['respuesta_38'] : '';
    if ($respuesta_38 === 'problemas') { 
        $verificar_38 = "correcto";
    } elseif ($respuesta_38 === '') {
        $verificar_38 = '';
    } else {
        $verificar_38 = "incorrecto";
    }

    $respuesta_39 = isset($_POST['respuesta_39']) ? $_POST['respuesta_39'] : '';
    if ($respuesta_39 === 'tiempo') { 
        $verificar_39 = "correcto";
    } elseif ($respuesta_39 === '') {
        $verificar_39 = '';
    } else {
        $verificar_39 = "incorrecto";
    }

    $respuesta_40 = isset($_POST['respuesta_40']) ? $_POST['respuesta_40'] : '';
    if ($respuesta_40 === 'detectar') { 
        $verificar_40 = "correcto";
    } elseif ($respuesta_40 === '') {
        $verificar_40 = '';
    } else {
        $verificar_40 = "incorrecto";
    }

    $respuesta_41 = isset($_POST['respuesta_41']) ? $_POST['respuesta_41'] : '';
    if ($respuesta_41 === 'error') { 
        $verificar_41 = "correcto";
    } elseif ($respuesta_41 === '') {
        $verificar_41 = '';
    } else {
        $verificar_41 = "incorrecto";
    }

    $respuesta_42 = isset($_POST['respuesta_42']) ? $_POST['respuesta_42'] : '';
    if ($respuesta_42 === 'solucionarlo') { 
        $verificar_42 = "correcto";
    } elseif ($respuesta_42 === '') {
        $verificar_42 = '';
    } else {
        $verificar_42 = "incorrecto";
    }

    $respuesta_43 = isset($_POST['respuesta_43']) ? $_POST['respuesta_43'] : '';
    if ($respuesta_43 === 'proceso') { 
        $verificar_43 = "correcto";
    } elseif ($respuesta_43 === '') {
        $verificar_43 = '';
    } else {
    $verificar_43 = "incorrecto";
    }

    $respuesta_44 = isset($_POST['respuesta_44']) ? $_POST['respuesta_44'] : '';
    if ($respuesta_44 === 'despliegue comun') { 
        $verificar_44 = "correcto";
    } elseif ($respuesta_44 === '') {
    $verificar_44 = '';
    } else {
        $verificar_44 = "incorrecto";
    }

    $respuesta_45 = isset($_POST['respuesta_45']) ? $_POST['respuesta_45'] : '';
    if ($respuesta_45 === 'Desarrollo') { 
        $verificar_45 = "correcto";
    } elseif ($respuesta_45 === '') {
    $verificar_45 = '';
    } else {
        $verificar_45 = "incorrecto";
    }

    $respuesta_46 = isset($_POST['respuesta_46']) ? $_POST['respuesta_46'] : '';
    if ($respuesta_46 === 'Operaciones') { 
        $verificar_46 = "correcto";
    } elseif ($respuesta_46 === '') {
    $verificar_46 = '';
    } else {
        $verificar_46 = "incorrecto";
    }

    $respuesta_47 = isset($_POST['respuesta_47']) ? $_POST['respuesta_47'] : '';
    if ($respuesta_47 === 'Equipos relacionados') { 
        $verificar_47 = "correcto";
    } elseif ($respuesta_47 === '') {
        $verificar_47 = '';
    } else {
        $verificar_47 = "incorrecto";
    }

    $respuesta_48 = isset($_POST['respuesta_48']) ? $_POST['respuesta_48'] : '';
    if ($respuesta_48 === 'errores manuales') { 
        $verificar_48 = "correcto";
    } elseif ($respuesta_48 === '') {
    $verificar_48 = '';
    } else {
        $verificar_48 = "incorrecto";
    }

    $respuesta_49 = isset($_POST['respuesta_49']) ? $_POST['respuesta_49'] : '';
    if ($respuesta_49 === 'configuraciones incorrectas') { 
        $verificar_49 = "correcto";
    } elseif ($respuesta_49 === '') {
    $verificar_49 = '';
    } else {
        $verificar_49 = "incorrecto";
    }

    $respuesta_50 = isset($_POST['respuesta_50']) ? $_POST['respuesta_50'] : '';
    if ($respuesta_50 === 'facilidad') { 
        $verificar_50 = "correcto";
    } elseif ($respuesta_50 === '') {
    $verificar_50 = '';
    } else {
        $verificar_50 = "incorrecto";
    }

 $respuesta_51 = isset($_POST['respuesta_51']) ? $_POST['respuesta_51'] : '';
if ($respuesta_51 === 'rastrear cambios') { 
    $verificar_51 = "correcto";
} elseif ($respuesta_51 === '') {
    $verificar_51 = '';
} else {
    $verificar_51 = "incorrecto";
}

 $respuesta_52 = isset($_POST['respuesta_52']) ? $_POST['respuesta_52'] : '';
if ($respuesta_52 === 'despliegue continuo') { 
    $verificar_52 = "correcto";
} elseif ($respuesta_52 === '') {
    $verificar_52 = '';
} else {
    $verificar_52 = "incorrecto";
}

 $respuesta_53 = isset($_POST['respuesta_53']) ? $_POST['respuesta_53'] : '';
if ($respuesta_53 === 'reducir') { 
    $verificar_53 = "correcto";
} elseif ($respuesta_53 === '') {
    $verificar_53 = '';
} else {
    $verificar_53 = "incorrecto";
}

 $respuesta_54 = isset($_POST['respuesta_54']) ? $_POST['respuesta_54'] : '';
if ($respuesta_54 === 'tiempo') { 
    $verificar_54 = "correcto";
} elseif ($respuesta_54 === '') {
    $verificar_54 = '';
} else {
    $verificar_54 = "incorrecto";
}

 $respuesta_55 = isset($_POST['respuesta_55']) ? $_POST['respuesta_55'] : '';
if ($respuesta_55 === 'Commit') { 
    $verificar_55 = "correcto";
} elseif ($respuesta_55 === '') {
    $verificar_55 = '';
} else {
    $verificar_55 = "incorrecto";
}


 $respuesta_56 = isset($_POST['respuesta_56']) ? $_POST['respuesta_56'] : '';
if ($respuesta_56 === 'desarrollador') { 
    $verificar_56 = "correcto";
} elseif ($respuesta_56 === '') {
    $verificar_56 = '';
} else {
    $verificar_56 = "incorrecto";
}

 $respuesta_57 = isset($_POST['respuesta_57']) ? $_POST['respuesta_57'] : '';
if ($respuesta_57 === 'Produccion') { 
    $verificar_57 = "correcto";
} elseif ($respuesta_57 === '') {
    $verificar_57 = '';
} else {
    $verificar_57 = "incorrecto";
}

 $respuesta_58 = isset($_POST['respuesta_58']) ? $_POST['respuesta_58'] : '';
if ($respuesta_58 === 'Integracion continua') { 
    $verificar_58 = "correcto";
} elseif ($respuesta_58 === '') {
    $verificar_58 = '';
} else {
    $verificar_58 = "incorrecto";
}

 $respuesta_59 = isset($_POST['respuesta_59']) ? $_POST['respuesta_59'] : '';
if ($respuesta_59 === 'Pruebas automaticas') { 
    $verificar_59 = "correcto";
} elseif ($respuesta_59 === '') {
    $verificar_59 = '';
} else {
    $verificar_59 = "incorrecto";
}

 $respuesta_60 = isset($_POST['respuesta_60']) ? $_POST['respuesta_60'] : '';
if ($respuesta_60 === 'Pipelines') { 
    $verificar_60 = "correcto";
} elseif ($respuesta_60 === '') {
    $verificar_60 = '';
} else {
    $verificar_60 = "incorrecto";
}

 $respuesta_61 = isset($_POST['respuesta_61']) ? $_POST['respuesta_61'] : '';
if ($respuesta_61 === 'infraestructura') { 
    $verificar_61 = "correcto";
} elseif ($respuesta_61 === '') {
    $verificar_61 = '';
} else {
    $verificar_61 = "incorrecto";
}

 $respuesta_62 = isset($_POST['respuesta_62']) ? $_POST['respuesta_62'] : '';
if ($respuesta_62 === 'codigo') { 
    $verificar_62 = "correcto";
} elseif ($respuesta_62 === '') {
    $verificar_62 = '';
} else {
    $verificar_62 = "incorrecto";
}

 $respuesta_63 = isset($_POST['respuesta_63']) ? $_POST['respuesta_63'] : '';
if ($respuesta_63 === 'Infrastructure') { 
    $verificar_63 = "correcto";
} elseif ($respuesta_63 === '') {
    $verificar_63 = '';
} else {
    $verificar_63 = "incorrecto";
}

 $respuesta_64 = isset($_POST['respuesta_64']) ? $_POST['respuesta_64'] : '';
if ($respuesta_64 === 'Code') { 
    $verificar_64 = "correcto";
} elseif ($respuesta_64 === '') {
    $verificar_64 = '';
} else {
    $verificar_64 = "incorrecto";
}

 $respuesta_65 = isset($_POST['respuesta_65']) ? $_POST['respuesta_65'] : '';
if ($respuesta_65 === 'infraestructura') { 
    $verificar_65 = "correcto";
} elseif ($respuesta_65 === '') {
    $verificar_65 = '';
} else {
    $verificar_65 = "incorrecto";
}

 $respuesta_66 = isset($_POST['respuesta_66']) ? $_POST['respuesta_66'] : '';
if ($respuesta_66 === 'manejarse') { 
    $verificar_66 = "correcto";
} elseif ($respuesta_66 === '') {
    $verificar_66 = '';
} else {
    $verificar_66 = "incorrecto";
}

 $respuesta_67 = isset($_POST['respuesta_67']) ? $_POST['respuesta_67'] : '';
if ($respuesta_67 === 'software') { 
    $verificar_67 = "correcto";
} elseif ($respuesta_67 === '') {
    $verificar_67 = '';
} else {
    $verificar_67 = "incorrecto";
}

 $respuesta_68 = isset($_POST['respuesta_68']) ? $_POST['respuesta_68'] : '';
if ($respuesta_68 === 'Scripts') { 
    $verificar_68 = "correcto";
} elseif ($respuesta_68 === '') {
    $verificar_68 = '';
} else {
    $verificar_68 = "incorrecto";
}

 $respuesta_69 = isset($_POST['respuesta_69']) ? $_POST['respuesta_69'] : '';
if ($respuesta_69 === 'Configuraciones') { 
    $verificar_69 = "correcto";
} elseif ($respuesta_69 === '') {
    $verificar_69 = '';
} else {
    $verificar_69 = "incorrecto";
}

 $respuesta_70 = isset($_POST['respuesta_70']) ? $_POST['respuesta_70'] : '';
if ($respuesta_70 === 'Archivos de definicion') { 
    $verificar_70 = "correcto";
} elseif ($respuesta_70 === '') {
    $verificar_70 = '';
} else {
    $verificar_70 = "incorrecto";
}

 $respuesta_71 = isset($_POST['respuesta_71']) ? $_POST['respuesta_71'] : '';
if ($respuesta_71 === 'versiones') { 
    $verificar_71 = "correcto";
} elseif ($respuesta_71 === '') {
    $verificar_71 = '';
} else {
    $verificar_71 = "incorrecto";
}

 $respuesta_72 = isset($_POST['respuesta_72']) ? $_POST['respuesta_72'] : '';
if ($respuesta_72 === 'Pruebas') { 
    $verificar_72 = "correcto";
} elseif ($respuesta_72 === '') {
    $verificar_72 = '';
} else {
    $verificar_72 = "incorrecto";
}

 $respuesta_73 = isset($_POST['respuesta_73']) ? $_POST['respuesta_73'] : '';
if ($respuesta_73 === 'Revision') { 
    $verificar_73 = "correcto";
} elseif ($respuesta_73 === '') {
    $verificar_73 = '';
} else {
    $verificar_73 = "incorrecto";
}

 $respuesta_74 = isset($_POST['respuesta_74']) ? $_POST['respuesta_74'] : '';
if ($respuesta_74 === 'plan') { 
    $verificar_74 = "correcto";
} elseif ($respuesta_74 === '') {
    $verificar_74 = '';
} else {
    $verificar_74 = "incorrecto";
}

 $respuesta_75 = isset($_POST['respuesta_75']) ? $_POST['respuesta_75'] : '';
if ($respuesta_75 === 'lanzamiento') { 
    $verificar_75 = "correcto";
} elseif ($respuesta_75 === '') {
    $verificar_75 = '';
} else {
    $verificar_75 = "incorrecto";
}

 $respuesta_76 = isset($_POST['respuesta_76']) ? $_POST['respuesta_76'] : '';
if ($respuesta_76 === 'Funcionalidades nuevas') { 
    $verificar_76 = "correcto";
} elseif ($respuesta_76 === '') {
    $verificar_76 = '';
} else {
    $verificar_76 = "incorrecto";
}

 $respuesta_77 = isset($_POST['respuesta_77']) ? $_POST['respuesta_77'] : '';
if ($respuesta_77 === 'Fechas') { 
    $verificar_77 = "correcto";
} elseif ($respuesta_77 === '') {
    $verificar_77 = '';
} else {
    $verificar_77 = "incorrecto";
}

 $respuesta_78 = isset($_POST['respuesta_78']) ? $_POST['respuesta_78'] : '';
if ($respuesta_78 === 'Recursos necesarios') { 
    $verificar_78 = "correcto";
} elseif ($respuesta_78 === '') {
    $verificar_78 = '';
} else {
    $verificar_78 = "incorrecto";
}

 $respuesta_79 = isset($_POST['respuesta_79']) ? $_POST['respuesta_79'] : '';
if ($respuesta_79 === 'Capacitacion') { 
    $verificar_79 = "correcto";
} elseif ($respuesta_79 === '') {
    $verificar_79 = '';
} else {
    $verificar_79 = "incorrecto";
}

 $respuesta_80 = isset($_POST['respuesta_80']) ? $_POST['respuesta_80'] : '';
if ($respuesta_80 === 'Operaciones'
|| $respuesta_80 === 'operaciones'
) { 
    $verificar_80 = "correcto";
} elseif ($respuesta_80 === '') {
    $verificar_80 = '';
} else {
    $verificar_80 = "incorrecto";
}

 $respuesta_81 = isset($_POST['respuesta_81']) ? $_POST['respuesta_81'] : '';
if ($respuesta_81 === 'compatibilidad') { 
    $verificar_81 = "correcto";
} elseif ($respuesta_81 === '') {
    $verificar_81 = '';
} else {
    $verificar_81 = "incorrecto";
}

    $respuesta_82 = isset($_POST['respuesta_82']) ? $_POST['respuesta_82'] : '';
    if ($respuesta_82 === 'compatibilidad') { 
        $verificar_82 = "correcto";
    } elseif ($respuesta_82 === '') {
        $verificar_82 = '';
    } else {
        $verificar_82 = "incorrecto";
    }

    $respuesta_83 = isset($_POST['respuesta_83']) ? $_POST['respuesta_83'] : '';
    if ($respuesta_83 === 'Librerias') { 
       $verificar_83 = "correcto";
    } elseif ($respuesta_83 === '') {
        $verificar_83 = '';
    } else {
        $verificar_83 = "incorrecto";
    }

    $respuesta_84 = isset($_POST['respuesta_84']) ? $_POST['respuesta_84'] : '';
    if ($respuesta_84 === 'Plataformas') { 
        $verificar_84 = "correcto";
    } elseif ($respuesta_84 === '') {
        $verificar_84 = '';
    } else {
        $verificar_84 = "incorrecto";
    }

    $respuesta_85 = isset($_POST['respuesta_85']) ? $_POST['respuesta_85'] : '';
    if ($respuesta_85 === 'Servicios externos') { 
        $verificar_85 = "correcto";
    } elseif ($respuesta_85 === '') {
        $verificar_85 = '';
    } else {
        $verificar_85 = "incorrecto";
    }

    $respuesta_86 = isset($_POST['respuesta_86']) ? $_POST['respuesta_86'] : '';
    if ($respuesta_86 === 'integridad') { 
        $verificar_86 = "correcto";
    } elseif ($respuesta_86 === '') {
        $verificar_86 = '';
    } else {
        $verificar_86 = "incorrecto";
    }

    $respuesta_87 = isset($_POST['respuesta_87']) ? $_POST['respuesta_87'] : '';
    if ($respuesta_87 === 'paquete') { 
        $verificar_87 = "correcto";
    } elseif ($respuesta_87 === '') {
        $verificar_87 = '';
    } else {
        $verificar_87 = "incorrecto";
    }

    $respuesta_88 = isset($_POST['respuesta_88']) ? $_POST['respuesta_88'] : '';
    if ($respuesta_88 === 'lanzamiento') { 
        $verificar_88 = "correcto";
    } elseif ($respuesta_88 === '') {
        $verificar_88 = '';
    } else {
        $verificar_88 = "incorrecto";
    }

 $respuesta_89 = isset($_POST['respuesta_89']) ? $_POST['respuesta_89'] : '';
if ($respuesta_89 === 'incluir') { 
    $verificar_89 = "correcto";
} elseif ($respuesta_89 === '') {
    $verificar_89 = '';
} else {
    $verificar_89 = "incorrecto";
}

 $respuesta_90 = isset($_POST['respuesta_90']) ? $_POST['respuesta_90'] : '';
if ($respuesta_90 === 'antiguas accidentalmente') { 
    $verificar_90 = "correcto";
} elseif ($respuesta_90 === '') {
    $verificar_90 = '';
} else {
    $verificar_90 = "incorrecto";
}

 $respuesta_91 = isset($_POST['respuesta_91']) ? $_POST['respuesta_91'] : '';
if ($respuesta_91 === 'componentes') { 
    $verificar_91 = "correcto";
} elseif ($respuesta_91 === '') {
    $verificar_91 = '';
} else {
    $verificar_91 = "incorrecto";
}

 $respuesta_92 = isset($_POST['respuesta_92']) ? $_POST['respuesta_92'] : '';
if ($respuesta_92 === 'desplegados') { 
    $verificar_92 = "correcto";
} elseif ($respuesta_92 === '') {
    $verificar_92 = '';
} else {
    $verificar_92 = "incorrecto";
}

 $respuesta_93 = isset($_POST['respuesta_93']) ? $_POST['respuesta_93'] : '';
if ($respuesta_93 === 'rastrear') { 
    $verificar_93 = "correcto";
} elseif ($respuesta_93 === '') {
    $verificar_93 = '';
} else {
    $verificar_93 = "incorrecto";
}

 $respuesta_94 = isset($_POST['respuesta_94']) ? $_POST['respuesta_94'] : '';
if ($respuesta_94 === 'revertir cambios') { 
    $verificar_94 = "correcto";
} elseif ($respuesta_94 === '') {
    $verificar_94 = '';
} else {
    $verificar_94 = "incorrecto";
}

 $respuesta_95 = isset($_POST['respuesta_95']) ? $_POST['respuesta_95'] : '';
if ($respuesta_95 === 'despliegue') { 
    $verificar_95 = "correcto";
} elseif ($respuesta_95 === '') {
    $verificar_95 = '';
} else {
    $verificar_95 = "incorrecto";
}

 $respuesta_96 = isset($_POST['respuesta_96']) ? $_POST['respuesta_96'] : '';
if ($respuesta_96 === 'Instalar') { 
    $verificar_96 = "correcto";
} elseif ($respuesta_96 === '') {
    $verificar_96 = '';
} else {
    $verificar_96 = "incorrecto";
}

 $respuesta_97 = isset($_POST['respuesta_97']) ? $_POST['respuesta_97'] : '';
if ($respuesta_97 === 'Probar') { 
    $verificar_97 = "correcto";
} elseif ($respuesta_97 === '') {
    $verificar_97 = '';
} else {
    $verificar_97 = "incorrecto";
}

 $respuesta_98 = isset($_POST['respuesta_98']) ? $_POST['respuesta_98'] : '';
if ($respuesta_98 === 'Verificar') { 
    $verificar_98 = "correcto";
} elseif ($respuesta_98 === '') {
    $verificar_98 = '';
} else {
    $verificar_98 = "incorrecto";
}

 $respuesta_99 = isset($_POST['respuesta_99']) ? $_POST['respuesta_99'] : '';
if ($respuesta_99 === 'Desinstalar') { 
    $verificar_99 = "correcto";
} elseif ($respuesta_99 === '') {
    $verificar_99 = '';
} else {
    $verificar_99 = "incorrecto";
}


 $respuesta_100 = isset($_POST['respuesta_100']) ? $_POST['respuesta_100'] : '';
if ($respuesta_100 === 'rollback') { 
    $verificar_100 = "correcto";
} elseif ($respuesta_100 === '') {
    $verificar_100 = '';
} else {
    $verificar_100 = "incorrecto";
}

 $respuesta_101 = isset($_POST['respuesta_101']) ? $_POST['respuesta_101'] : '';
if ($respuesta_101 === 'Automatizacion') { 
    $verificar_101 = "correcto";
} elseif ($respuesta_101 === '') {
    $verificar_101 = '';
} else {
    $verificar_101 = "incorrecto";
}

 $respuesta_102 = isset($_POST['respuesta_102']) ? $_POST['respuesta_102'] : '';
if ($respuesta_102 === 'automaticamente') { 
    $verificar_102 = "correcto";
} elseif ($respuesta_102 === '') {
    $verificar_102 = '';
} else {
    $verificar_102 = "incorrecto";
}

 $respuesta_103 = isset($_POST['respuesta_103']) ? $_POST['respuesta_103'] : '';
if ($respuesta_103 === 'cambios') { 
    $verificar_103 = "correcto";
} elseif ($respuesta_103 === '') {
    $verificar_103 = '';
} else {
    $verificar_103 = "incorrecto";
}

 $respuesta_104 = isset($_POST['respuesta_104']) ? $_POST['respuesta_104'] : '';
if ($respuesta_104 === 'errores') { 
    $verificar_104 = "correcto";
} elseif ($respuesta_104 === '') {
    $verificar_104 = '';
} else {
    $verificar_104 = "incorrecto";
}

 $respuesta_105 = isset($_POST['respuesta_105']) ? $_POST['respuesta_105'] : '';
if ($respuesta_105 === 'historial') { 
    $verificar_105 = "correcto";
} elseif ($respuesta_105 === '') {
    $verificar_105 = '';
} else {
    $verificar_105 = "incorrecto";
}

 $respuesta_106 = isset($_POST['respuesta_106']) ? $_POST['respuesta_106'] : '';
if ($respuesta_106 === 'politicas') { 
    $verificar_106 = "correcto";
} elseif ($respuesta_106 === '') {
    $verificar_106 = '';
} else {
    $verificar_106 = "incorrecto";
}

 $respuesta_107 = isset($_POST['respuesta_107']) ? $_POST['respuesta_107'] : '';
if ($respuesta_107 === 'Pruebas automaticas') { 
    $verificar_107 = "correcto";
} elseif ($respuesta_107 === '') {
    $verificar_107 = '';
} else {
    $verificar_107 = "incorrecto";
}

 $respuesta_108 = isset($_POST['respuesta_108']) ? $_POST['respuesta_108'] : '';
if ($respuesta_108 === 'configuracion') { 
    $verificar_108 = "correcto";
} elseif ($respuesta_108 === '') {
    $verificar_108 = '';
} else {
    $verificar_108 = "incorrecto";
}

 $respuesta_109 = isset($_POST['respuesta_109']) ? $_POST['respuesta_109'] : '';
if ($respuesta_109 === 'equipo') { 
    $verificar_109 = "correcto";
} elseif ($respuesta_109 === '') {
    $verificar_109 = '';
} else {
    $verificar_109 = "incorrecto";
}

 $respuesta_110 = isset($_POST['respuesta_110']) ? $_POST['respuesta_110'] : '';
if ($respuesta_110 === 'desarrollo') { 
    $verificar_110 = "correcto";
} elseif ($respuesta_110 === '') {
    $verificar_110 = '';
} else {
    $verificar_110 = "incorrecto";
}

// Tabla del 12
$respuesta_111 = isset($_POST['respuesta_111']) ? $_POST['respuesta_111'] : '';
if ($respuesta_111 === 'Entregar') {  
    $verificar_111 = "correcto";
} elseif ($respuesta_111 === '') {
    $verificar_111 = '';
} else {
    $verificar_111 = "incorrecto";
}

$respuesta_112 = isset($_POST['respuesta_112']) ? $_POST['respuesta_112'] : '';
if ($respuesta_112 === 'Mantener') {  
    $verificar_112 = "correcto";
} elseif ($respuesta_112 === '') {
    $verificar_112 = '';
} else {
    $verificar_112 = "incorrecto";
}

$respuesta_113 = isset($_POST['respuesta_113']) ? $_POST['respuesta_113'] : '';
if ($respuesta_113 === 'Monitorear') {  
    $verificar_113 = "correcto";
} elseif ($respuesta_113 === '') {
    $verificar_113 = '';
} else {
    $verificar_113 = "incorrecto";
}

$respuesta_114 = isset($_POST['respuesta_114']) ? $_POST['respuesta_114'] : '';
if ($respuesta_114 === 'Soportar') {  
    $verificar_114 = "correcto";
} elseif ($respuesta_114 === '') {
    $verificar_114 = '';
} else {
    $verificar_114 = "incorrecto";
}

$respuesta_115 = isset($_POST['respuesta_115']) ? $_POST['respuesta_115'] : '';
if ($respuesta_115 === 'agiles') {  
    $verificar_115 = "correcto";
} elseif ($respuesta_115 === '') {
    $verificar_115 = '';
} else {
    $verificar_115 = "incorrecto";
}

$respuesta_116 = isset($_POST['respuesta_116']) ? $_POST['respuesta_116'] : '';
if ($respuesta_116 === 'Inception') {  
    $verificar_116 = "correcto";
} elseif ($respuesta_116 === '') {
    $verificar_116 = '';
} else {
    $verificar_116 = "incorrecto";
}

$respuesta_117 = isset($_POST['respuesta_117']) ? $_POST['respuesta_117'] : '';
if ($respuesta_117 === 'inicio') {  
    $verificar_117 = "correcto";
} elseif ($respuesta_117 === '') {
    $verificar_117 = '';
} else {
    $verificar_117 = "incorrecto";
}

$respuesta_118 = isset($_POST['respuesta_118']) ? $_POST['respuesta_118'] : '';
if ($respuesta_118 === 'release') {  
    $verificar_118 = "correcto";
} elseif ($respuesta_118 === '') {
    $verificar_118 = '';
} else {
    $verificar_118 = "incorrecto";
}

$respuesta_119 = isset($_POST['respuesta_119']) ? $_POST['respuesta_119'] : '';
if ($respuesta_119 === 'Requisitos') {  
    $verificar_119 = "correcto";
} elseif ($respuesta_119 === '') {
    $verificar_119 = '';
} else {
    $verificar_119 = "incorrecto";
}

$respuesta_120 = isset($_POST['respuesta_120']) ? $_POST['respuesta_120'] : '';
if ($respuesta_120 === 'Operaciones'
|| $respuesta_120 === 'operaciones'
) {  
    $verificar_120 = "correcto";
} elseif ($respuesta_120 === '') {
    $verificar_120 = '';
} else {
    $verificar_120 = "incorrecto";
}

$respuesta_121 = isset($_POST['respuesta_121']) ? $_POST['respuesta_121'] : '';
if ($respuesta_121 === 'Compatibilidad') {  
    $verificar_121 = "correcto";
} elseif ($respuesta_121 === '') {
    $verificar_121 = '';
} else {
    $verificar_121 = "incorrecto";
}


$respuesta_121_1 = isset($_POST['respuesta_121_1']) ? $_POST['respuesta_121_1'] : '';
if ($respuesta_121_1 === 'Logs') {   
    $verificar_121_1 = "correcto";
} elseif ($respuesta_121_1 === '') {
    $verificar_121_1 = '';
} else {
    $verificar_121_1 = "incorrecto";
}

$respuesta_122 = isset($_POST['respuesta_122']) ? $_POST['respuesta_122'] : '';
if ($respuesta_122 === 'Monitoreo') {   
    $verificar_122 = "correcto";
} elseif ($respuesta_122 === '') {
    $verificar_122 = '';
} else {
    $verificar_122 = "incorrecto";
}

$respuesta_123 = isset($_POST['respuesta_123']) ? $_POST['respuesta_123'] : '';
if ($respuesta_123 === 'Construction') {   
    $verificar_123 = "correcto";
} elseif ($respuesta_123 === '') {
    $verificar_123 = '';
} else {
    $verificar_123 = "incorrecto";
}

$respuesta_124 = isset($_POST['respuesta_124']) ? $_POST['respuesta_124'] : '';
if ($respuesta_124 === 'construccion') {   
    $verificar_124 = "correcto";
} elseif ($respuesta_124 === '') {
    $verificar_124 = '';
} else {
    $verificar_124 = "incorrecto";
}

$respuesta_125 = isset($_POST['respuesta_125']) ? $_POST['respuesta_125'] : '';
if ($respuesta_125 === 'Control') {   
    $verificar_125 = "correcto";
} elseif ($respuesta_125 === '') {
    $verificar_125 = '';
} else {
    $verificar_125 = "incorrecto";
}

$respuesta_126 = isset($_POST['respuesta_126']) ? $_POST['respuesta_126'] : '';
if ($respuesta_126 === 'versiones') {   
    $verificar_126 = "correcto";
} elseif ($respuesta_126 === '') {
    $verificar_126 = '';
} else {
    $verificar_126 = "incorrecto";
}

$respuesta_127 = isset($_POST['respuesta_127']) ? $_POST['respuesta_127'] : '';
if ($respuesta_127 === 'Integracion continua') {   
    $verificar_127 = "correcto";
} elseif ($respuesta_127 === '') {
    $verificar_127 = '';
} else {
    $verificar_127 = "incorrecto";
}

$respuesta_128 = isset($_POST['respuesta_128']) ? $_POST['respuesta_128'] : '';
if ($respuesta_128 === 'respuesta') {   
    $verificar_128 = "correcto";
} elseif ($respuesta_128 === '') {
    $verificar_128 = '';
} else {
    $verificar_128 = "incorrecto";
}

$respuesta_129 = isset($_POST['respuesta_129']) ? $_POST['respuesta_129'] : '';
if ($respuesta_129 === 'Pruebas automaticas') {   
    $verificar_129 = "correcto";
} elseif ($respuesta_129 === '') {
    $verificar_129 = '';
} else {
    $verificar_129 = "incorrecto";
}

$respuesta_130 = isset($_POST['respuesta_130']) ? $_POST['respuesta_130'] : '';
if ($respuesta_130 === 'Despliegue continuo') {   
    $verificar_130 = "correcto";
} elseif ($respuesta_130 === '') {
    $verificar_130 = '';
} else {
    $verificar_130 = "incorrecto";
}

$respuesta_131 = isset($_POST['respuesta_131']) ? $_POST['respuesta_131'] : '';
if ($respuesta_131 === 'Transition') {   
    $verificar_131 = "correcto";
} elseif ($respuesta_131 === '') {
    $verificar_131 = '';
} else {
    $verificar_131 = "incorrecto";
}

$respuesta_132 = isset($_POST['respuesta_132']) ? $_POST['respuesta_132'] : '';
if ($respuesta_132 === 'transicion') {   
    $verificar_132 = "correcto";
} elseif ($respuesta_132 === '') {
    $verificar_132 = '';
} else {
    $verificar_132 = "incorrecto";
}

$respuesta_133 = isset($_POST['respuesta_133']) ? $_POST['respuesta_133'] : '';
if ($respuesta_133 === 'despliegue') {   
    $verificar_133 = "correcto";
} elseif ($respuesta_133 === '') {
    $verificar_133 = '';
} else {
    $verificar_133 = "incorrecto";
}

$respuesta_134 = isset($_POST['respuesta_134']) ? $_POST['respuesta_134'] : '';
if ($respuesta_134 === 'Despliega') {   
    $verificar_134 = "correcto";
} elseif ($respuesta_134 === '') {
    $verificar_134 = '';
} else {
    $verificar_134 = "incorrecto";
}

$respuesta_135 = isset($_POST['respuesta_135']) ? $_POST['respuesta_135'] : '';
if ($respuesta_135 === 'Monitorea') {   
    $verificar_135 = "correcto";
} elseif ($respuesta_135 === '') {
    $verificar_135 = '';
} else {
    $verificar_135 = "incorrecto";
}

$respuesta_136 = isset($_POST['respuesta_136']) ? $_POST['respuesta_136'] : '';
if ($respuesta_136 === 'rollback') {   
    $verificar_136 = "correcto";
} elseif ($respuesta_136 === '') {
    $verificar_136 = '';
} else {
    $verificar_136 = "incorrecto";
}

$respuesta_137 = isset($_POST['respuesta_137']) ? $_POST['respuesta_137'] : '';
if ($respuesta_137 === 'problemas') {   
    $verificar_137 = "correcto";
} elseif ($respuesta_137 === '') {
    $verificar_137 = '';
} else {
    $verificar_137 = "incorrecto";
}

$respuesta_138 = isset($_POST['respuesta_138']) ? $_POST['respuesta_138'] : '';
if ($respuesta_138 === 'respuesta') {   
    $verificar_138 = "correcto";
} elseif ($respuesta_138 === '') {
    $verificar_138 = '';
} else {
    $verificar_138 = "incorrecto";
}

$respuesta_139 = isset($_POST['respuesta_139']) ? $_POST['respuesta_139'] : '';
if ($respuesta_139 === 'respuesta') {   
    $verificar_139 = "correcto";
} elseif ($respuesta_139 === '') {
    $verificar_139 = '';
} else {
    $verificar_139 = "incorrecto";
}

$respuesta_140 = isset($_POST['respuesta_140']) ? $_POST['respuesta_140'] : '';
if ($respuesta_140 === 'respuesta') {   
    $verificar_140 = "correcto";
} elseif ($respuesta_140 === '') {
    $verificar_140 = '';
} else {
    $verificar_140 = "incorrecto";
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
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../style_2_0.css">
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<style>
 
    .seccion {
    /*width: 50%;*/    
    width: calc(50% - 7.5px);
    padding: 20px;
    box-sizing: border-box;
    height: 500vh;
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

<form action="./index.php" method="POST" onsubmit="handleSubmit(event)" autocomplete="off"> 
<div class="form-container">

    
<div class="seccion izquierda"> 
<h3>1. Definición de DevOps</h3>

    <p>
    <strong>DevOps es un 
    <input type="text" name="respuesta_1" value="<?php echo $respuesta_1; ?>" size="27">    
      a 
    <input type="text" name="respuesta_2" value="<?php echo $respuesta_2; ?>" size="15">
      entre 
    <input type="text" name="respuesta_3" value="<?php echo $respuesta_3; ?>" size="8">
      un 
    <input type="text" name="respuesta_4" value="<?php echo $respuesta_4; ?>" size="8">
      en un 
    <input type="text" name="respuesta_5" value="<?php echo $respuesta_5; ?>" size="8">
      y colocar dicho 
    <input type="text" name="respuesta_6" value="<?php echo $respuesta_6; ?>" size="8">
      en 
    <input type="text" name="respuesta_7" value="<?php echo $respuesta_7; ?>" size="8">
      normal, garantizando al mismo tiempo una 
    <input type="text" name="respuesta_8" value="<?php echo $respuesta_8; ?>" size="8">
     .</strong>
    </p>

    <button type="submit">Enviar</button> 
    <?php echo $verificar_1 ?>
    <?php echo $verificar_2 ?>
    <?php echo $verificar_3 ?>
    <?php echo $verificar_4 ?>
    <?php echo $verificar_5 ?>
    <?php echo $verificar_6 ?>
    <?php echo $verificar_7 ?>  
    <?php echo $verificar_8 ?>
  <button onmousedown="mostrarMensaje()" onmouseup="ocultarMensaje()">Ayuda</button>
    <section id="mensaje" style="display: none; margin-top: 10px; padding: 10px; background-color: #f0f0f0;">
          <h4>Elementos clave de la definición</h4>

    <ul>
        <li><strong>Reducir tiempo:</strong> entregar cambios más rápido.</li>
        <li><strong>Cambio en el sistema:</strong> normalmente código.</li>
        <li><strong>Producción:</strong> usuarios reales.</li>
        <li><strong>Alta calidad:</strong> disponibilidad, seguridad, confiabilidad y estabilidad.</li>
    </ul>

    </section>
    
 


<h3>2. Objetivos principales de DevOps</h3>

<p>DevOps busca:</p>

<ol>
    <li>
        <strong>Reducir el 
        <input type="text" name="respuesta_9" value="<?php echo $respuesta_9; ?>" size="8">    
          de 
        <input type="text" name="respuesta_10" value="<?php echo $respuesta_10; ?>" size="8">
          (<em>
        <input type="text" name="respuesta_11" value="<?php echo $respuesta_11; ?>" size="8">    
          to market</em>)</strong>
        <ul>
            <li>Llevar funcionalidades desde la idea hasta los usuarios más 
            <input type="text" name="respuesta_12" value="<?php echo $respuesta_12; ?>" size="8">    
             .</li>
        </ul>
    </li>

    <li>
        <strong>Mantener alta 
        <input type="text" name="respuesta_13" value="<?php echo $respuesta_13; ?>" size="8">    
          del software</strong>
        <ul>
            <li>Evitar 
            <input type="text" name="respuesta_14" value="<?php echo $respuesta_14; ?>" size="8">
              en producción.</li>
            <li>Garantizar confiabilidad y seguridad.</li>
        </ul>
    </li>

    <li>
        <strong>
        <input type="text" name="respuesta_15" value="<?php echo $respuesta_15; ?>" size="8">    
          procesos</strong>
        <ul>
            <li>Reducir errores humanos.</li>
            <li>Acelerar despliegues.</li>
        </ul>
    </li>

    <li>
        <strong>Mejorar la 
        <input type="text" name="respuesta_16" value="<?php echo $respuesta_16; ?>" size="8">    
          entre Desarrollo y Operaciones</strong>
        <ul>
            <li>Romper los 
            <input type="text" name="respuesta_17" value="<?php echo $respuesta_17; ?>" size="8">    
              tradicionales.</li>
        </ul>
    </li>
</ol>
    <button type="submit">Enviar</button> 
    <?php echo $verificar_9 ?>
    <?php echo $verificar_10 ?>
    <?php echo $verificar_11 ?> 
    <?php echo $verificar_12 ?>
    <?php echo $verificar_13 ?>
    <?php echo $verificar_14 ?>
    <?php echo $verificar_15 ?>
    <?php echo $verificar_16 ?>
    <?php echo $verificar_17 ?>
    <hr>
<h3>3. Prácticas DevOps principales</h3>

<p>El libro identifica 
<input type="text" name="respuesta_18" value="<?php echo $respuesta_18; ?>" size="8">     
  categorías principales:</p>

<h4>1. Tratar a 
<input type="text" name="respuesta_19" value="<?php echo $respuesta_19; ?>" size="8">     
  como 
<input type="text" name="respuesta_20" value="<?php echo $respuesta_20; ?>" size="8"> 
  de 
<input type="text" name="respuesta_21" value="<?php echo $respuesta_21; ?>" size="8"> 
  (<em>
<input type="text" name="respuesta_22" value="<?php echo $respuesta_22; ?>" size="8">     
  
<input type="text" name="respuesta_23" value="<?php echo $respuesta_23; ?>" size="8"> 
 </em>)</h4>

<p>
Operaciones debe participar desde etapas tempranas del desarrollo.
</p>

<ul>
    <li>
    <input type="text" name="respuesta_24" value="<?php echo $respuesta_24; ?>" size="11">     
      de 
    <input type="text" name="respuesta_25" value="<?php echo $respuesta_25; ?>" size="8"> 
     .</li>
    <li>Necesidades de 
    <input type="text" name="respuesta_26" value="<?php echo $respuesta_26; ?>" size="8">     
     .</li>
    <li>
    <input type="text" name="respuesta_27" value="<?php echo $respuesta_27; ?>" size="8">     
     .</li>
    <li>
    <input type="text" name="respuesta_28" value="<?php echo $respuesta_28; ?>" size="11">     
     .</li>
    <li>
    <input type="text" name="respuesta_29" value="<?php echo $respuesta_29; ?>" size="8">     
     .</li>
</ul>

<p>
<strong>Idea clave:</strong> Operaciones no debe aparecer solamente al 
<input type="text" name="respuesta_30" value="<?php echo $respuesta_30; ?>" size="8"> 
  cuando hay que 
<input type="text" name="respuesta_31" value="<?php echo $respuesta_31; ?>" size="8"> 
 .
</p>

<button type="submit">Enviar</button>
<?php echo $verificar_18 ?>
    <?php echo $verificar_19 ?> 
    <?php echo $verificar_20 ?>
    <?php echo $verificar_21 ?>
    <?php echo $verificar_22 ?>
    <?php echo $verificar_23 ?>
    <?php echo $verificar_24 ?>
    <?php echo $verificar_25 ?>
    <?php echo $verificar_26 ?>
    <?php echo $verificar_27 ?>
    <?php echo $verificar_28 ?>
    <?php echo $verificar_29 ?>
    <?php echo $verificar_30 ?>
    <?php echo $verificar_31 ?>
    <hr>

<h4>2. Hacer que Desarrollo sea 
<input type="text" name="respuesta_32" value="<?php echo $respuesta_32; ?>" size="8">    
  de 
<input type="text" name="respuesta_33" value="<?php echo $respuesta_33; ?>" size="18">
 </h4>

<p>Modelo tradicional:</p>

<pre>
Dev → <input type="text" name="respuesta_34" value="<?php echo $respuesta_34; ?>" size="18"> 
Ops → <input type="text" name="respuesta_35" value="<?php echo $respuesta_35; ?>" size="18"> 
</pre>

<p>Modelo DevOps:</p>

<pre>
Dev → <input type="text" name="respuesta_36" value="<?php echo $respuesta_36; ?>" size="11"> + ayuda a <input type="text" name="respuesta_37" value="<?php echo $respuesta_37; ?>" size="8"> + responde <input type="text" name="respuesta_38" value="<?php echo $respuesta_38; ?>" size="9">
 
</pre>

<p>
Objetivo: reducir el 
<input type="text" name="respuesta_39" value="<?php echo $respuesta_39; ?>" size="9">
  entre 
<input type="text" name="respuesta_40" value="<?php echo $respuesta_40; ?>" size="9">
  un 
<input type="text" name="respuesta_41" value="<?php echo $respuesta_41; ?>" size="9">
  y 
<input type="text" name="respuesta_42" value="<?php echo $respuesta_42; ?>" size="9">
 .
</p>

    <button type="submit">Enviar</button> 
    <?php echo $verificar_32 ?>
    <?php echo $verificar_33 ?>
    <?php echo $verificar_34 ?>
    <?php echo $verificar_35 ?>
    <?php echo $verificar_36 ?>
    <?php echo $verificar_37 ?>
    <?php echo $verificar_38 ?>
    <?php echo $verificar_39 ?>
    <?php echo $verificar_40 ?>
    <?php echo $verificar_41 ?>
    <?php echo $verificar_42 ?>
    <hr>

<h4>3. Aplicar un 
<input type="text" name="respuesta_43" value="<?php echo $respuesta_43; ?>" size="9">    
  de 
<input type="text" name="respuesta_44" value="<?php echo $respuesta_44; ?>" size="14">
 </h4>

<p>
Todos deben seguir el mismo proceso:
</p>

<ul>
    <li>
    <input type="text" name="respuesta_45" value="<?php echo $respuesta_45; ?>" size="11">    
     .</li>
    <li>
    <input type="text" name="respuesta_46" value="<?php echo $respuesta_46; ?>" size="11">    
     .</li>
    <li>
    <input type="text" name="respuesta_47" value="<?php echo $respuesta_47; ?>" size="18">    
     .</li>
</ul>

<p>Beneficios:</p>

<ul>
    <li>Menos 
    <input type="text" name="respuesta_48" value="<?php echo $respuesta_48; ?>" size="14">    
     .</li>
    <li>Menos 
    <input type="text" name="respuesta_49" value="<?php echo $respuesta_49; ?>" size="23">    
     .</li>
    <li>Mayor 
    <input type="text" name="respuesta_50" value="<?php echo $respuesta_50; ?>" size="8">    
      para 
    <input type="text" name="respuesta_51" value="<?php echo $respuesta_51; ?>" size="14">
     .</li>
</ul>

    <button type="submit">Enviar</button>
    <?php echo $verificar_43 ?>
    <?php echo $verificar_44 ?>  
    <?php echo $verificar_45 ?>
    <?php echo $verificar_46 ?>
    <?php echo $verificar_47 ?>
    <?php echo $verificar_48 ?>
    <?php echo $verificar_49 ?>
    <?php echo $verificar_50 ?>
    <?php echo $verificar_51 ?>
<hr>

<h4>4. Usar 
<input type="text" name="respuesta_52" value="<?php echo $respuesta_52; ?>" size="16">    
   </h4>

<p>
Busca 
<input type="text" name="respuesta_53" value="<?php echo $respuesta_53; ?>" size="8">
  el 
<input type="text" name="respuesta_54" value="<?php echo $respuesta_54; ?>" size="8">
  entre:
</p>

<pre>
<input type="text" name="respuesta_55" value="<?php echo $respuesta_55; ?>" size="8"> del <input type="text" name="respuesta_56" value="<?php echo $respuesta_56; ?>" size="13"> 
          ↓
<input type="text" name="respuesta_57" value="<?php echo $respuesta_57; ?>" size="9">
 
</pre>

<p>Mediante:</p>

<ul>
    <li>
    <input type="text" name="respuesta_58" value="<?php echo $respuesta_58; ?>" size="18">    
     .</li>
    <li>
    <input type="text" name="respuesta_59" value="<?php echo $respuesta_59; ?>" size="16">    
     .</li>
    <li>
    <input type="text" name="respuesta_60" value="<?php echo $respuesta_60; ?>" size="9">    
     .</li>
</ul>

<button type="submit">Enviar</button>
<?php echo $verificar_52 ?>
    <?php echo $verificar_53 ?>
    <?php echo $verificar_54 ?>
    <?php echo $verificar_55 ?>
    <?php echo $verificar_56 ?>
    <?php echo $verificar_57 ?>
    <?php echo $verificar_58 ?>
    <?php echo $verificar_59 ?>
    <?php echo $verificar_60 ?>
<hr>
<h4>5. Tratar la 
<input type="text" name="respuesta_61" value="<?php echo $respuesta_61; ?>" size="11">    
  como 
<input type="text" name="respuesta_62" value="<?php echo $respuesta_62; ?>" size="9">
  (<em>
  <input type="text" name="respuesta_63" value="<?php echo $respuesta_63; ?>" size="12">  
    as 
  <input type="text" name="respuesta_64" value="<?php echo $respuesta_64; ?>" size="8">
   </em>)</h4>

<p>
La 
<input type="text" name="respuesta_65" value="<?php echo $respuesta_65; ?>" size="15">
  debe 
<input type="text" name="respuesta_66" value="<?php echo $respuesta_66; ?>" size="8">
  como 
<input type="text" name="respuesta_67" value="<?php echo $respuesta_67; ?>" size="8">
 :
</p>

<ul>
    <li>
    <input type="text" name="respuesta_68" value="<?php echo $respuesta_68; ?>" size="8">    
     .</li>
    <li>
    <input type="text" name="respuesta_69" value="<?php echo $respuesta_69; ?>" size="12">    
     .</li>
    <li>
    <input type="text" name="respuesta_70" value="<?php echo $respuesta_70; ?>" size="21">    
     .</li>
</ul>

<p>Debe incluir:</p>

<ul>
    <li>Control de 
    <input type="text" name="respuesta_71" value="<?php echo $respuesta_71; ?>" size="8">    
     .</li>
    <li>
    <input type="text" name="respuesta_72" value="<?php echo $respuesta_72; ?>" size="8">    
     .</li>
    <li>
    <input type="text" name="respuesta_73" value="<?php echo $respuesta_73; ?>" size="8">    
     .</li>
</ul>

<button type="submit">Enviar</button>
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
<hr>
 
 
</div>




<div class="seccion derecha">
    
 <h3>4. Proceso tradicional de Release</h3>

<h4>1. Definir 
<input type="text" name="respuesta_74" value="<?php echo $respuesta_74; ?>" size="8">     
  de 
<input type="text" name="respuesta_75" value="<?php echo $respuesta_75; ?>" size="8"> 
 </h4>

<ul>
    <li>
    <input type="text" name="respuesta_76" value="<?php echo $respuesta_76; ?>" size="21">     
     .</li>
    <li>
    <input type="text" name="respuesta_77" value="<?php echo $respuesta_77; ?>" size="8">     
     .</li>
    <li>
    <input type="text" name="respuesta_78" value="<?php echo $respuesta_78; ?>" size="15">     
     .</li>
    <li>
    <input type="text" name="respuesta_79" value="<?php echo $respuesta_79; ?>" size="8">     
      de 
    <input type="text" name="respuesta_80" value="<?php echo $respuesta_80; ?>" size="8"> 
     .</li>
</ul>
<button type="submit">Enviar</button>
<?php echo $verificar_74 ?>
<?php echo $verificar_75 ?>
<?php echo $verificar_76 ?>
<?php echo $verificar_77 ?>
<?php echo $verificar_78 ?>
<?php echo $verificar_79 ?>
<?php echo $verificar_80 ?>
<hr>
<h4>2. Asegurar 
<input type="text" name="respuesta_81" value="<?php echo $respuesta_81; ?>" size="11">    
 </h4>

<p>Verificar 
<input type="text" name="respuesta_82" value="<?php echo $respuesta_82; ?>" size="11">    
  de:</p>

<ul>
    <li>
    <input type="text" name="respuesta_83" value="<?php echo $respuesta_83; ?>" size="8">    
     .</li>
    <li>
    <input type="text" name="respuesta_84" value="<?php echo $respuesta_84; ?>" size="8">      
    .</li>
    <li>
    <input type="text" name="respuesta_85" value="<?php echo $respuesta_85; ?>" size="14">    
     .</li>
</ul>

<button type="submit">Enviar</button>
<?php echo $verificar_81 ?>
<?php echo $verificar_82 ?>
<?php echo $verificar_83 ?>
<?php echo $verificar_84 ?>
<?php echo $verificar_85 ?>
<hr>
<h4>3. Mantener 
<input type="text" name="respuesta_86" value="<?php echo $respuesta_86; ?>" size="9">    
  del 
<input type="text" name="respuesta_87" value="<?php echo $respuesta_87; ?>" size="9">
  de 
<input type="text" name="respuesta_88" value="<?php echo $respuesta_88; ?>" size="9">
 </h4>

<ul>
    <li>No 
    <input type="text" name="respuesta_89" value="<?php echo $respuesta_89; ?>" size="8">    
      versiones 
    <input type="text" name="respuesta_90" value="<?php echo $respuesta_90; ?>" size="21">
     .</li>
    <li>Registrar qué 
    <input type="text" name="respuesta_91" value="<?php echo $respuesta_91; ?>" size="9">    
      fueron 
    <input type="text" name="respuesta_92" value="<?php echo $respuesta_92; ?>" size="9">
     .</li>
</ul>

<button type="submit">Enviar</button>
<?php echo $verificar_86 ?>
<?php echo $verificar_87 ?>
<?php echo $verificar_88 ?>
<?php echo $verificar_89 ?>
<?php echo $verificar_90 ?>
<?php echo $verificar_91 ?>
<?php echo $verificar_92 ?>
<hr>

<h4>4. Poder 
<input type="text" name="respuesta_93" value="<?php echo $respuesta_93; ?>" size="9">    
  y 
<input type="text" name="respuesta_94" value="<?php echo $respuesta_94; ?>" size="14">
 </h4>

<p>Un 
<input type="text" name="respuesta_95" value="<?php echo $respuesta_95; ?>" size="9">    
  debe permitir:</p>

<ul>
    <li>
    <input type="text" name="respuesta_96" value="<?php echo $respuesta_96; ?>" size="9">    
     .</li>
    <li>
    <input type="text" name="respuesta_97" value="<?php echo $respuesta_97; ?>" size="9">    
     .</li>
    <li>
    <input type="text" name="respuesta_98" value="<?php echo $respuesta_98; ?>" size="9">    
     .</li>
    <li>
    <input type="text" name="respuesta_99" value="<?php echo $respuesta_99; ?>" size="9">    
     .</li>
    <li>Realizar 
    <input type="text" name="respuesta_100" value="<?php echo $respuesta_100; ?>" size="9">    
     .</li>
</ul>

<button type="submit">Enviar</button>
<?php echo $verificar_93 ?>
<?php echo $verificar_94 ?>
<?php echo $verificar_95 ?>
<?php echo $verificar_96 ?>
<?php echo $verificar_97 ?>
<?php echo $verificar_98 ?>
<?php echo $verificar_99 ?>
<?php echo $verificar_100 ?>
<hr>
<h3>5. Perspectiva DevOps</h3>

<h4>A. 
<input type="text" name="respuesta_101" value="<?php echo $respuesta_101; ?>" size="11">
 </h4>

<p>Las herramientas permiten:</p>

<ul>
    <li>Ejecutar acciones
    <input type="text" name="respuesta_102" value="<?php echo $respuesta_102; ?>" size="14">    
       .</li>
    <li>Validar 
    <input type="text" name="respuesta_103" value="<?php echo $respuesta_103; ?>" size="9">    
     .</li>
    <li>Notificar 
    <input type="text" name="respuesta_104" value="<?php echo $respuesta_104; ?>" size="9">    
     .</li>
    <li>Guardar 
    <input type="text" name="respuesta_105" value="<?php echo $respuesta_105; ?>" size="9">    
     .</li>
    <li>Aplicar 
    <input type="text" name="respuesta_106" value="<?php echo $respuesta_106; ?>" size="9">    
     .</li>
</ul>

<p>Ejemplos:</p>

<ul>
    <li>CI/CD.</li>
    <li>
    <input type="text" name="respuesta_107" value="<?php echo $respuesta_107; ?>" size="17">    
     .</li>
    <li>Herramientas de 
    <input type="text" name="respuesta_108" value="<?php echo $respuesta_108; ?>" size="11">    
     .</li>
</ul>


<h4>B. Responsabilidad del 
<input type="text" name="respuesta_109" value="<?php echo $respuesta_109; ?>" size="9">    
  de 
<input type="text" name="respuesta_110" value="<?php echo $respuesta_110; ?>" size="9">
 </h4>

<p>El equipo de desarrollo puede ser responsable de:</p>

<ul>
    <li>
    <input type="text" name="respuesta_111" value="<?php echo $respuesta_111; ?>" size="9">    
     .</li>
    <li>
    <input type="text" name="respuesta_112" value="<?php echo $respuesta_112; ?>" size="9">    
     .</li>
    <li>
    <input type="text" name="respuesta_113" value="<?php echo $respuesta_113; ?>" size="9">    
     .</li>
    <li>
    <input type="text" name="respuesta_114" value="<?php echo $respuesta_114; ?>" size="9">    
      el servicio.</li>
</ul>

<button type="submit">Enviar</button>
<?php echo $verificar_101 ?>
<?php echo $verificar_102 ?>
<?php echo $verificar_103 ?>
<?php echo $verificar_104 ?>
<?php echo $verificar_105 ?>
<?php echo $verificar_106 ?>
<?php echo $verificar_107 ?>
<?php echo $verificar_108 ?>
<?php echo $verificar_109 ?>
<?php echo $verificar_110 ?>
<?php echo $verificar_111 ?>
<?php echo $verificar_112 ?>
<?php echo $verificar_113 ?>
<?php echo $verificar_114 ?>
<hr>
 <h3>6. DevOps y Agile</h3>

<p>
DevOps complementa las metodologías 
<input type="text" name="respuesta_115" value="<?php echo $respuesta_115; ?>" size="9"> 
  e impacta tres fases:
</p>

<h4>1. 
<input type="text" name="respuesta_116" value="<?php echo $respuesta_116; ?>" size="9">     
  (
<input type="text" name="respuesta_117" value="<?php echo $respuesta_117; ?>" size="9">     
 )</h4>

<ul>
    <li>Planificación del 
    <input type="text" name="respuesta_118" value="<?php echo $respuesta_118; ?>" size="9">     
     .</li>
    <li>
    <input type="text" name="respuesta_119" value="<?php echo $respuesta_119; ?>" size="9">     
     .</li>
    <li>Participación de 
    <input type="text" name="respuesta_120" value="<?php echo $respuesta_120; ?>" size="9">     
     .</li>
</ul>

<p>Requisitos adicionales:</p>

<ul>
    <li>
    <input type="text" name="respuesta_121" value="<?php echo $respuesta_121; ?>" size="11">     
      hacia atrás.</li>
    <li>
    <input type="text" name="respuesta_121_1" value="<?php echo $respuesta_121_1; ?>" size="9">     
      adecuados.</li>
    <li>
    <input type="text" name="respuesta_122" value="<?php echo $respuesta_122; ?>" size="9">     
     .</li>
</ul>


<h4>2. 
<input type="text" name="respuesta_123" value="<?php echo $respuesta_123; ?>" size="9">     
  (
<input type="text" name="respuesta_124" value="<?php echo $respuesta_124; ?>" size="9">     
 )</h4>

<ul>
    <li>
    <input type="text" name="respuesta_125" value="<?php echo $respuesta_125; ?>" size="9">     
      de 
    <input type="text" name="respuesta_126" value="<?php echo $respuesta_126; ?>" size="9"> 
     .</li>
    <li>
    <input type="text" name="respuesta_127" value="<?php echo $respuesta_127; ?>" size="17">     
     .</li>
    <li>
    <input type="text" name="respuesta_129" value="<?php echo $respuesta_129; ?>" size="16">     
     .</li>
    <li>
    <input type="text" name="respuesta_130" value="<?php echo $respuesta_130; ?>" size="16">     
     .</li>

</ul>


<h4>3. 
<input type="text" name="respuesta_131" value="<?php echo $respuesta_131; ?>" size="9">     
  (
<input type="text" name="respuesta_132" value="<?php echo $respuesta_132; ?>" size="9">     
 /
<input type="text" name="respuesta_133" value="<?php echo $respuesta_133; ?>" size="9"> 
 )</h4>

<p>El equipo:</p>

<ul>
    <li>
    <input type="text" name="respuesta_134" value="<?php echo $respuesta_134; ?>" size="9">     
     .</li>
    <li>
    <input type="text" name="respuesta_135" value="<?php echo $respuesta_135; ?>" size="9">     
     .</li>
    <li>Decide 
    <input type="text" name="respuesta_136" value="<?php echo $respuesta_136; ?>" size="9">     
     .</li>
    <li>Analiza 
    <input type="text" name="respuesta_137" value="<?php echo $respuesta_137; ?>" size="9">     
     .</li>
</ul>

    <button type="submit">Enviar</button>
       <?php echo $verificar_115 ?>
<?php echo $verificar_116 ?>
<?php echo $verificar_117 ?>
<?php echo $verificar_118 ?>
<?php echo $verificar_119 ?>
<?php echo $verificar_120 ?>
<?php echo $verificar_121 ?>
<?php echo $verificar_122 ?>
<?php echo $verificar_123 ?>
<?php echo $verificar_124 ?>
<?php echo $verificar_125 ?>
<?php echo $verificar_126 ?>
<?php echo $verificar_127 ?>
<?php echo $verificar_128 ?>
<?php echo $verificar_129 ?>
<br><br>
<?php echo $verificar_130 ?>
<?php echo $verificar_131 ?>
<?php echo $verificar_132 ?>
<?php echo $verificar_133 ?>
<?php echo $verificar_134 ?>
<?php echo $verificar_135 ?>
<?php echo $verificar_136 ?>
<?php echo $verificar_137 ?>
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
        href="segundo.php"
        role="button"
        width="50px"
        height="50px"
    >Siguiente</a>
</div>
</body>
</html>
