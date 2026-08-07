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
 
        $respuesta_1 = 'herramienta';
    $respuesta_2 = 'tecnologia';
    $respuesta_3 = 'combinacion';
    $respuesta_4 = 'Personas';
    $respuesta_5 = 'Procesos';
    $respuesta_6 = 'Tecnologia';
    $respuesta_7 = 'capacidades';
    $respuesta_8 = 'ciclo de vida';
    $respuesta_9 = 'planificacion';
    $respuesta_10 = 'operacion';
    $respuesta_11 = 'produccion';
    $respuesta_12 = 'modelo';
    $respuesta_13 = 'diseñen';
    $respuesta_14 = 'Objetivos';
    $respuesta_15 = 'Desarrollo';
    $respuesta_16 = 'Pruebas';
    $respuesta_17 = 'Implementacion';
    $respuesta_18 = 'Operacion';
    $respuesta_19 = 'Retroalimentacion';
    $respuesta_20 = 'cliente';
    $respuesta_21 = 'cuatro';
    $respuesta_22 = 'Steer';
    $respuesta_23 = 'Dirigir';
    $respuesta_24 = 'Develop/Test';
    $respuesta_25 = 'Desarrollar/Probar';
    $respuesta_26 = 'Deploy';
    $respuesta_27 = 'Implementar';
    $respuesta_28 = 'Operate';
    $respuesta_29 = 'Operar';
    $respuesta_30 = 'desarrollo';
    $respuesta_31 = 'software';
    $respuesta_32 = 'objetivos';
    $respuesta_33 = 'negocio';
    $respuesta_34 = 'retroalimentacion';
    $respuesta_35 = 'clientes';
    $respuesta_36 = 'Planificacion';
    $respuesta_37 = 'planificacion';
    $respuesta_38 = 'agiles';
    $respuesta_39 = 'reaccionar';
    $respuesta_40 = 'cambios';
    $respuesta_41 = 'Steer';
    $respuesta_42 = 'Dirigir';
    $respuesta_43 = 'lentos';
    $respuesta_44 = 'manuales';
    $respuesta_45 = 'aislados';
    $respuesta_46 = 'silos';
    $respuesta_47 = 'comunicacion';
    $respuesta_48 = 'colaboren';
    $respuesta_49 = 'objetivos';
    $respuesta_50 = 'retroalimentacion';
    $respuesta_51 = 'agilidad';
    $respuesta_52 = 'decisiones';
    $respuesta_53 = 'desperdicios';
    $respuesta_54 = 'costos';
    $respuesta_55 = 'valor';
    $respuesta_56 = 'Develop/Test';
    $respuesta_57 = 'Desarrollar/Probar';
    $respuesta_58 = 'calidad';
    $respuesta_59 = 'colaboracion';
    $respuesta_60 = 'pruebas continuas';
    $respuesta_61 = 'Desarrollo colaborativo';
    $respuesta_62 = 'Pruebas continuas';
    $respuesta_63 = 'Desarrollo colaborativo';
    $respuesta_64 = 'juntos';
    $respuesta_65 = 'Desarrolladores';
    $respuesta_66 = 'Arquitectos';
    $respuesta_67 = 'negocio';
    $respuesta_68 = 'QA';
    $respuesta_69 = 'Operaciones';
    $respuesta_70 = 'seguridad';
    $respuesta_71 = 'Integracion continua';
    $respuesta_72 = 'Continuous Integration';
    $respuesta_73 = 'integran';
    $respuesta_74 = 'trabajo';
    $respuesta_75 = 'resto';
    $respuesta_76 = 'equipo';
    $respuesta_77 = 'errores';
    $respuesta_78 = 'integracion';
    $respuesta_79 = 'colaboracion';
    $respuesta_80 = 'probado';
    $respuesta_81 = 'Pruebas continuas';
    $respuesta_82 = 'Continuous Testing';
    $respuesta_83 = 'realizar';
    $respuesta_84 = 'ciclo';
    $respuesta_85 = 'desarrollo';
    $respuesta_86 = 'continuamente';
    $respuesta_87 = 'correcto';
    $respuesta_88 = 'software';
    $respuesta_89 = 'problemas';
    $respuesta_90 = 'produccion';
    $respuesta_91 = 'tempranas';
    $respuesta_92 = 'costos';
    $respuesta_93 = 'rapidos';
    $respuesta_94 = 'calidad';
    $respuesta_95 = 'Deploy';
    $respuesta_96 = 'Implementar';
    $respuesta_97 = 'liberar';
    $respuesta_98 = 'rapidamente';
    $respuesta_99 = 'confiable';
    $respuesta_100 = 'despliegue';
    $respuesta_101 = 'integracion';
    $respuesta_102 = 'automatizacion';
    $respuesta_103 = 'proceso';
    $respuesta_104 = 'Pipelines';
    $respuesta_105 = 'Automatizacion';
    $respuesta_106 = 'despliegues';
    $respuesta_107 = 'QA';
    $respuesta_108 = 'produccion';
    $respuesta_109 = 'funcionalidades';
    $respuesta_110 = 'errores';
    $respuesta_111 = 'eficiencia';
        
        // Marcar todas como correctas
    for ($i = 1; $i <= 122; $i++) {
    ${"verificar_$i"} = "correcto";
    }

    } else {
    $respuesta_1 = isset($_POST['respuesta_1']) ? $_POST['respuesta_1'] : '';
   if ($respuesta_1 === 'herramienta') {  
       $verificar_1 = "correcto";
   } elseif ($respuesta_1 === '') {
       $verificar_1 = '';
   } else {
       $verificar_1 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_2 = isset($_POST['respuesta_2']) ? $_POST['respuesta_2'] : '';
   if ($respuesta_2 === 'tecnologia') {  
       $verificar_2 = "correcto";
   } elseif ($respuesta_2 === '') {
       $verificar_2 = '';
   } else {
       $verificar_2 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_3 = isset($_POST['respuesta_3']) ? $_POST['respuesta_3'] : '';
   if ($respuesta_3 === 'combinacion') {  
       $verificar_3 = "correcto";
   } elseif ($respuesta_3 === '') {
       $verificar_3 = '';
   } else {
       $verificar_3 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_4 = isset($_POST['respuesta_4']) ? $_POST['respuesta_4'] : '';
   if ($respuesta_4 === 'Personas') {  
       $verificar_4 = "correcto";
   } elseif ($respuesta_4 === '') {
       $verificar_4 = '';
   } else {
       $verificar_4 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_5 = isset($_POST['respuesta_5']) ? $_POST['respuesta_5'] : '';
   if ($respuesta_5 === 'Procesos') {  
       $verificar_5 = "correcto";
   } elseif ($respuesta_5 === '') {
       $verificar_5 = '';
   } else {
       $verificar_5 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_6 = isset($_POST['respuesta_6']) ? $_POST['respuesta_6'] : '';
   if ($respuesta_6 === 'Tecnologia') {  
       $verificar_6 = "correcto";
   } elseif ($respuesta_6 === '') {
       $verificar_6 = '';
   } else {
       $verificar_6 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_7 = isset($_POST['respuesta_7']) ? $_POST['respuesta_7'] : '';
   if ($respuesta_7 === 'capacidades') {  
       $verificar_7 = "correcto";
   } elseif ($respuesta_7 === '') {
       $verificar_7 = '';
   } else {
       $verificar_7 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_8 = isset($_POST['respuesta_8']) ? $_POST['respuesta_8'] : '';
   if ($respuesta_8 === 'ciclo de vida') {  
       $verificar_8 = "correcto";
   } elseif ($respuesta_8 === '') {
       $verificar_8 = '';
   } else {
       $verificar_8 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_9 = isset($_POST['respuesta_9']) ? $_POST['respuesta_9'] : '';
   if ($respuesta_9 === 'planificacion') {  
       $verificar_9 = "correcto";
   } elseif ($respuesta_9 === '') {
       $verificar_9 = '';
   } else {
       $verificar_9 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_10 = isset($_POST['respuesta_10']) ? $_POST['respuesta_10'] : '';
   if ($respuesta_10 === 'operacion') {  
       $verificar_10 = "correcto";
   } elseif ($respuesta_10 === '') {
       $verificar_10 = '';
   } else {
       $verificar_10 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_11 = isset($_POST['respuesta_11']) ? $_POST['respuesta_11'] : '';
   if ($respuesta_11 === 'produccion') {  
       $verificar_11 = "correcto";
   } elseif ($respuesta_11 === '') {
       $verificar_11 = '';
   } else {
       $verificar_11 = "incorrecto";
   }


    // Verificar la respuesta de la primera pregunta
    $respuesta_12 = isset($_POST['respuesta_12']) ? $_POST['respuesta_12'] : '';
    if ($respuesta_12 === 'modelo') {  
        $verificar_12 = "correcto";
    } elseif ($respuesta_12 === '') {
        $verificar_12 = '';
    } else {
        $verificar_12 = "incorrecto";
    }
  
    // Verificar la respuesta de la segunda pregunta
    $respuesta_13 = isset($_POST['respuesta_13']) ? $_POST['respuesta_13'] : '';
    if ($respuesta_13 === 'diseñen') { 
        $verificar_13 = "correcto";
    } elseif ($respuesta_13 === '') {
        $verificar_13 = '';
    } else {
         $verificar_13 = "incorrecto";
    }
  
    // Verificar la respuesta de la tercera pregunta
    $respuesta_14 = isset($_POST['respuesta_14']) ? $_POST['respuesta_14'] : '';
    if ($respuesta_14 === 'Objetivos') {  
        $verificar_14 = "correcto";
    } elseif ($respuesta_14 === '') {
        $verificar_14 = '';
    } else {
        $verificar_14 = "incorrecto";
    }
  
    // Verificar la respuesta de la cuarta pregunta
    $respuesta_15 = isset($_POST['respuesta_15']) ? $_POST['respuesta_15'] : '';
    if ($respuesta_15 === 'Desarrollo') { 
        $verificar_15 = "correcto";
    } elseif ($respuesta_15 === '') {
        $verificar_15 = '';
    } else {
        $verificar_15 = "incorrecto";
    }
  
    // Verificar la respuesta de la quinta pregunta
    $respuesta_16 = isset($_POST['respuesta_16']) ? $_POST['respuesta_16'] : '';
    if ($respuesta_16 === 'Pruebas') {  
        $verificar_16 = "correcto";
    } elseif ($respuesta_16 === '') {
        $verificar_16 = '';
    } else {
        $verificar_16 = "incorrecto";
    }
  
    // Verificar la respuesta de la sexta pregunta
    $respuesta_17 = isset($_POST['respuesta_17']) ? $_POST['respuesta_17'] : '';
    if ($respuesta_17 === 'Implementacion') {  
        $verificar_17 = "correcto";
        } elseif ($respuesta_17 === '') {
        $verificar_17 = '';
    } else {
        $verificar_17 = "incorrecto";
    }
  
    // Verificar la respuesta de la séptima pregunta
    $respuesta_18 = isset($_POST['respuesta_18']) ? $_POST['respuesta_18'] : '';
    if ($respuesta_18 === 'Operacion') {  
        $verificar_18 = "correcto";
    } elseif ($respuesta_18 === '') {
        $verificar_18 = '';
    } else {
        $verificar_18 = "incorrecto";
    }
  
    // Verificar la respuesta de la octava pregunta
    $respuesta_19 = isset($_POST['respuesta_19']) ? $_POST['respuesta_19'] : '';
    if ($respuesta_19 === 'Retroalimentacion') {  
        $verificar_19 = "correcto";
    } elseif ($respuesta_19 === '') {
        $verificar_19 = '';
    } else {
        $verificar_19 = "incorrecto";
    }
  
    // Verificar la respuesta de la novena pregunta
    $respuesta_20 = isset($_POST['respuesta_20']) ? $_POST['respuesta_20'] : '';
    if ($respuesta_20 === 'cliente') {  
        $verificar_20 = "correcto";
    } elseif ($respuesta_20 === '') {
        $verificar_20 = '';
    } else {
        $verificar_20 = "incorrecto";
    }
  
    // Verificar la respuesta de la décima pregunta
    $respuesta_21 = isset($_POST['respuesta_21']) ? $_POST['respuesta_21'] : '';
    if ($respuesta_21 === 'cuatro') {  
         $verificar_21 = "correcto";
    } elseif ($respuesta_21 === '') {
        $verificar_21 = '';
    } else {
        $verificar_21 = "incorrecto";
    }
  
    // Verificar la respuesta de la undécima pregunta
    $respuesta_22 = isset($_POST['respuesta_22']) ? $_POST['respuesta_22'] : '';
    if ($respuesta_22 === 'Steer') {  
        $verificar_22 = "correcto";
    } elseif ($respuesta_22 === '') {
        $verificar_22 = '';
    } else {
        $verificar_22 = "incorrecto";
    }

     // Verificar la respuesta de la primera pregunta
   $respuesta_23 = isset($_POST['respuesta_23']) ? $_POST['respuesta_23'] : '';
   if ($respuesta_23 === 'Dirigir') {  
       $verificar_23 = "correcto";
   } elseif ($respuesta_23 === '') {
       $verificar_23 = '';
   } else {
       $verificar_23 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_24 = isset($_POST['respuesta_24']) ? $_POST['respuesta_24'] : '';
   if ($respuesta_24 === 'Develop/Test') {  
       $verificar_24 = "correcto";
   } elseif ($respuesta_24 === '') {
       $verificar_24 = '';
   } else {
       $verificar_24 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_25 = isset($_POST['respuesta_25']) ? $_POST['respuesta_25'] : '';
   if ($respuesta_25 === 'Desarrollar/Probar') { 
       $verificar_25 = "correcto";
   } elseif ($respuesta_25 === '') {
       $verificar_25 = '';
   } else {
       $verificar_25 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_26 = isset($_POST['respuesta_26']) ? $_POST['respuesta_26'] : '';
   if ($respuesta_26 === 'Deploy') {  
       $verificar_26 = "correcto";
   } elseif ($respuesta_26 === '') {
       $verificar_26 = '';
   } else {
       $verificar_26 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_27 = isset($_POST['respuesta_27']) ? $_POST['respuesta_27'] : '';
   if ($respuesta_27 === 'Implementar') {  
       $verificar_27 = "correcto";
   } elseif ($respuesta_27 === '') {
       $verificar_27 = '';
   } else {
       $verificar_27 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_28 = isset($_POST['respuesta_28']) ? $_POST['respuesta_28'] : '';
   if ($respuesta_28 === 'Operate') {  
       $verificar_28 = "correcto";
   } elseif ($respuesta_28 === '') {
       $verificar_28 = '';
   } else {
       $verificar_28 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_29 = isset($_POST['respuesta_29']) ? $_POST['respuesta_29'] : '';
   if ($respuesta_29 === 'Operar') {  
       $verificar_29 = "correcto";
   } elseif ($respuesta_29 === '') {
       $verificar_29 = '';
   } else {
       $verificar_29 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_30 = isset($_POST['respuesta_30']) ? $_POST['respuesta_30'] : '';
   if ($respuesta_30 === 'desarrollo') {  
       $verificar_30 = "correcto";
   } elseif ($respuesta_30 === '') {
       $verificar_30 = '';
   } else {
       $verificar_30 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_31 = isset($_POST['respuesta_31']) ? $_POST['respuesta_31'] : '';
   if ($respuesta_31 === 'software') {  
       $verificar_31 = "correcto";
   } elseif ($respuesta_31 === '') {
       $verificar_31 = '';
   } else {
       $verificar_31 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_32 = isset($_POST['respuesta_32']) ? $_POST['respuesta_32'] : '';
   if ($respuesta_32 === 'objetivos') {  
       $verificar_32 = "correcto";
   } elseif ($respuesta_32 === '') {
       $verificar_32 = '';
   } else {
       $verificar_32 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_33 = isset($_POST['respuesta_33']) ? $_POST['respuesta_33'] : '';
   if ($respuesta_33 === 'negocio') {  
       $verificar_33 = "correcto";
   } elseif ($respuesta_33 === '') {
       $verificar_33 = '';
   } else {
       $verificar_33 = "incorrecto";
   }

    $respuesta_34 = isset($_POST['respuesta_34']) ? $_POST['respuesta_34'] : '';
    if ($respuesta_34 === 'retroalimentacion') { 
        $verificar_34 = "correcto";
    } elseif ($respuesta_34 === '') {
        $verificar_34 = '';
    } else {
        $verificar_34 = "incorrecto";
    }

    $respuesta_35 = isset($_POST['respuesta_35']) ? $_POST['respuesta_35'] : '';
    if ($respuesta_35 === 'clientes') { 
        $verificar_35 = "correcto";
    } elseif ($respuesta_35 === '') {
        $verificar_35 = '';
    } else {
        $verificar_35 = "incorrecto";
    }

    $respuesta_36 = isset($_POST['respuesta_36']) ? $_POST['respuesta_36'] : '';
    if ($respuesta_36 === 'Planificacion') { 
        $verificar_36 = "correcto";
    } elseif ($respuesta_36 === '') {
    $verificar_36 = '';
    } else {
        $verificar_36 = "incorrecto";
    }

    $respuesta_37 = isset($_POST['respuesta_37']) ? $_POST['respuesta_37'] : '';
    if ($respuesta_37 === 'planificacion') { 
        $verificar_37 = "correcto";
    } elseif ($respuesta_37 === '') {
        $verificar_37 = '';
    } else {
        $verificar_37 = "incorrecto";
    }

    $respuesta_38 = isset($_POST['respuesta_38']) ? $_POST['respuesta_38'] : '';
    if ($respuesta_38 === 'agiles') { 
        $verificar_38 = "correcto";
    } elseif ($respuesta_38 === '') {
        $verificar_38 = '';
    } else {
        $verificar_38 = "incorrecto";
    }

    $respuesta_39 = isset($_POST['respuesta_39']) ? $_POST['respuesta_39'] : '';
    if ($respuesta_39 === 'reaccionar') { 
        $verificar_39 = "correcto";
    } elseif ($respuesta_39 === '') {
        $verificar_39 = '';
    } else {
        $verificar_39 = "incorrecto";
    }

    $respuesta_40 = isset($_POST['respuesta_40']) ? $_POST['respuesta_40'] : '';
    if ($respuesta_40 === 'cambios') { 
        $verificar_40 = "correcto";
    } elseif ($respuesta_40 === '') {
        $verificar_40 = '';
    } else {
        $verificar_40 = "incorrecto";
    }

    $respuesta_41 = isset($_POST['respuesta_41']) ? $_POST['respuesta_41'] : '';
    if ($respuesta_41 === 'Steer') { 
        $verificar_41 = "correcto";
    } elseif ($respuesta_41 === '') {
        $verificar_41 = '';
    } else {
        $verificar_41 = "incorrecto";
    }

    $respuesta_42 = isset($_POST['respuesta_42']) ? $_POST['respuesta_42'] : '';
    if ($respuesta_42 === 'Dirigir') { 
        $verificar_42 = "correcto";
    } elseif ($respuesta_42 === '') {
        $verificar_42 = '';
    } else {
        $verificar_42 = "incorrecto";
    }

    $respuesta_43 = isset($_POST['respuesta_43']) ? $_POST['respuesta_43'] : '';
    if ($respuesta_43 === 'lentos') { 
        $verificar_43 = "correcto";
    } elseif ($respuesta_43 === '') {
        $verificar_43 = '';
    } else {
    $verificar_43 = "incorrecto";
    }

    $respuesta_44 = isset($_POST['respuesta_44']) ? $_POST['respuesta_44'] : '';
    if ($respuesta_44 === 'manuales') { 
        $verificar_44 = "correcto";
    } elseif ($respuesta_44 === '') {
    $verificar_44 = '';
    } else {
        $verificar_44 = "incorrecto";
    }

    $respuesta_45 = isset($_POST['respuesta_45']) ? $_POST['respuesta_45'] : '';
    if ($respuesta_45 === 'aislados') { 
        $verificar_45 = "correcto";
    } elseif ($respuesta_45 === '') {
    $verificar_45 = '';
    } else {
        $verificar_45 = "incorrecto";
    }

    $respuesta_46 = isset($_POST['respuesta_46']) ? $_POST['respuesta_46'] : '';
    if ($respuesta_46 === 'silos') { 
        $verificar_46 = "correcto";
    } elseif ($respuesta_46 === '') {
    $verificar_46 = '';
    } else {
        $verificar_46 = "incorrecto";
    }

    $respuesta_47 = isset($_POST['respuesta_47']) ? $_POST['respuesta_47'] : '';
    if ($respuesta_47 === 'comunicacion') { 
        $verificar_47 = "correcto";
    } elseif ($respuesta_47 === '') {
        $verificar_47 = '';
    } else {
        $verificar_47 = "incorrecto";
    }

    $respuesta_48 = isset($_POST['respuesta_48']) ? $_POST['respuesta_48'] : '';
    if ($respuesta_48 === 'colaboren') { 
        $verificar_48 = "correcto";
    } elseif ($respuesta_48 === '') {
    $verificar_48 = '';
    } else {
        $verificar_48 = "incorrecto";
    }

    $respuesta_49 = isset($_POST['respuesta_49']) ? $_POST['respuesta_49'] : '';
    if ($respuesta_49 === 'objetivos') { 
        $verificar_49 = "correcto";
    } elseif ($respuesta_49 === '') {
    $verificar_49 = '';
    } else {
        $verificar_49 = "incorrecto";
    }

    $respuesta_50 = isset($_POST['respuesta_50']) ? $_POST['respuesta_50'] : '';
    if ($respuesta_50 === 'retroalimentacion') { 
        $verificar_50 = "correcto";
    } elseif ($respuesta_50 === '') {
    $verificar_50 = '';
    } else {
        $verificar_50 = "incorrecto";
    }

 $respuesta_51 = isset($_POST['respuesta_51']) ? $_POST['respuesta_51'] : '';
if ($respuesta_51 === 'agilidad') { 
    $verificar_51 = "correcto";
} elseif ($respuesta_51 === '') {
    $verificar_51 = '';
} else {
    $verificar_51 = "incorrecto";
}

 $respuesta_52 = isset($_POST['respuesta_52']) ? $_POST['respuesta_52'] : '';
if ($respuesta_52 === 'decisiones') { 
    $verificar_52 = "correcto";
} elseif ($respuesta_52 === '') {
    $verificar_52 = '';
} else {
    $verificar_52 = "incorrecto";
}

 $respuesta_53 = isset($_POST['respuesta_53']) ? $_POST['respuesta_53'] : '';
if ($respuesta_53 === 'desperdicios') { 
    $verificar_53 = "correcto";
} elseif ($respuesta_53 === '') {
    $verificar_53 = '';
} else {
    $verificar_53 = "incorrecto";
}

 $respuesta_54 = isset($_POST['respuesta_54']) ? $_POST['respuesta_54'] : '';
if ($respuesta_54 === 'costos') { 
    $verificar_54 = "correcto";
} elseif ($respuesta_54 === '') {
    $verificar_54 = '';
} else {
    $verificar_54 = "incorrecto";
}

 $respuesta_55 = isset($_POST['respuesta_55']) ? $_POST['respuesta_55'] : '';
if ($respuesta_55 === 'valor') { 
    $verificar_55 = "correcto";
} elseif ($respuesta_55 === '') {
    $verificar_55 = '';
} else {
    $verificar_55 = "incorrecto";
}


 $respuesta_56 = isset($_POST['respuesta_56']) ? $_POST['respuesta_56'] : '';
if ($respuesta_56 === 'Develop/Test') { 
    $verificar_56 = "correcto";
} elseif ($respuesta_56 === '') {
    $verificar_56 = '';
} else {
    $verificar_56 = "incorrecto";
}

 $respuesta_57 = isset($_POST['respuesta_57']) ? $_POST['respuesta_57'] : '';
if ($respuesta_57 === 'Desarrollar/Probar') { 
    $verificar_57 = "correcto";
} elseif ($respuesta_57 === '') {
    $verificar_57 = '';
} else {
    $verificar_57 = "incorrecto";
}

 $respuesta_58 = isset($_POST['respuesta_58']) ? $_POST['respuesta_58'] : '';
if ($respuesta_58 === 'calidad') { 
    $verificar_58 = "correcto";
} elseif ($respuesta_58 === '') {
    $verificar_58 = '';
} else {
    $verificar_58 = "incorrecto";
}

 $respuesta_59 = isset($_POST['respuesta_59']) ? $_POST['respuesta_59'] : '';
if ($respuesta_59 === 'colaboracion') { 
    $verificar_59 = "correcto";
} elseif ($respuesta_59 === '') {
    $verificar_59 = '';
} else {
    $verificar_59 = "incorrecto";
}

 $respuesta_60 = isset($_POST['respuesta_60']) ? $_POST['respuesta_60'] : '';
if ($respuesta_60 === 'pruebas continuas') { 
    $verificar_60 = "correcto";
} elseif ($respuesta_60 === '') {
    $verificar_60 = '';
} else {
    $verificar_60 = "incorrecto";
}

 $respuesta_61 = isset($_POST['respuesta_61']) ? $_POST['respuesta_61'] : '';
if ($respuesta_61 === 'Desarrollo colaborativo') { 
    $verificar_61 = "correcto";
} elseif ($respuesta_61 === '') {
    $verificar_61 = '';
} else {
    $verificar_61 = "incorrecto";
}

 $respuesta_62 = isset($_POST['respuesta_62']) ? $_POST['respuesta_62'] : '';
if ($respuesta_62 === 'Pruebas continuas') { 
    $verificar_62 = "correcto";
} elseif ($respuesta_62 === '') {
    $verificar_62 = '';
} else {
    $verificar_62 = "incorrecto";
}

 $respuesta_63 = isset($_POST['respuesta_63']) ? $_POST['respuesta_63'] : '';
if ($respuesta_63 === 'Desarrollo colaborativo') { 
    $verificar_63 = "correcto";
} elseif ($respuesta_63 === '') {
    $verificar_63 = '';
} else {
    $verificar_63 = "incorrecto";
}

 $respuesta_64 = isset($_POST['respuesta_64']) ? $_POST['respuesta_64'] : '';
if ($respuesta_64 === 'juntos') { 
    $verificar_64 = "correcto";
} elseif ($respuesta_64 === '') {
    $verificar_64 = '';
} else {
    $verificar_64 = "incorrecto";
}

 $respuesta_65 = isset($_POST['respuesta_65']) ? $_POST['respuesta_65'] : '';
if ($respuesta_65 === 'Desarrolladores') { 
    $verificar_65 = "correcto";
} elseif ($respuesta_65 === '') {
    $verificar_65 = '';
} else {
    $verificar_65 = "incorrecto";
}

 $respuesta_66 = isset($_POST['respuesta_66']) ? $_POST['respuesta_66'] : '';
if ($respuesta_66 === 'Arquitectos') { 
    $verificar_66 = "correcto";
} elseif ($respuesta_66 === '') {
    $verificar_66 = '';
} else {
    $verificar_66 = "incorrecto";
}

 $respuesta_67 = isset($_POST['respuesta_67']) ? $_POST['respuesta_67'] : '';
if ($respuesta_67 === 'negocio') { 
    $verificar_67 = "correcto";
} elseif ($respuesta_67 === '') {
    $verificar_67 = '';
} else {
    $verificar_67 = "incorrecto";
}

 $respuesta_68 = isset($_POST['respuesta_68']) ? $_POST['respuesta_68'] : '';
if ($respuesta_68 === 'QA') { 
    $verificar_68 = "correcto";
} elseif ($respuesta_68 === '') {
    $verificar_68 = '';
} else {
    $verificar_68 = "incorrecto";
}

 $respuesta_69 = isset($_POST['respuesta_69']) ? $_POST['respuesta_69'] : '';
if ($respuesta_69 === 'Operaciones') { 
    $verificar_69 = "correcto";
} elseif ($respuesta_69 === '') {
    $verificar_69 = '';
} else {
    $verificar_69 = "incorrecto";
}

 $respuesta_70 = isset($_POST['respuesta_70']) ? $_POST['respuesta_70'] : '';
if ($respuesta_70 === 'seguridad') { 
    $verificar_70 = "correcto";
} elseif ($respuesta_70 === '') {
    $verificar_70 = '';
} else {
    $verificar_70 = "incorrecto";
}

 $respuesta_71 = isset($_POST['respuesta_71']) ? $_POST['respuesta_71'] : '';
if ($respuesta_71 === 'Integracion continua') { 
    $verificar_71 = "correcto";
} elseif ($respuesta_71 === '') {
    $verificar_71 = '';
} else {
    $verificar_71 = "incorrecto";
}

 $respuesta_72 = isset($_POST['respuesta_72']) ? $_POST['respuesta_72'] : '';
if ($respuesta_72 === 'Continuous Integration') { 
    $verificar_72 = "correcto";
} elseif ($respuesta_72 === '') {
    $verificar_72 = '';
} else {
    $verificar_72 = "incorrecto";
}

 $respuesta_73 = isset($_POST['respuesta_73']) ? $_POST['respuesta_73'] : '';
if ($respuesta_73 === 'integran') { 
    $verificar_73 = "correcto";
} elseif ($respuesta_73 === '') {
    $verificar_73 = '';
} else {
    $verificar_73 = "incorrecto";
}

 $respuesta_74 = isset($_POST['respuesta_74']) ? $_POST['respuesta_74'] : '';
if ($respuesta_74 === 'trabajo') { 
    $verificar_74 = "correcto";
} elseif ($respuesta_74 === '') {
    $verificar_74 = '';
} else {
    $verificar_74 = "incorrecto";
}

 $respuesta_75 = isset($_POST['respuesta_75']) ? $_POST['respuesta_75'] : '';
if ($respuesta_75 === 'resto') { 
    $verificar_75 = "correcto";
} elseif ($respuesta_75 === '') {
    $verificar_75 = '';
} else {
    $verificar_75 = "incorrecto";
}

 $respuesta_76 = isset($_POST['respuesta_76']) ? $_POST['respuesta_76'] : '';
if ($respuesta_76 === 'equipo') { 
    $verificar_76 = "correcto";
} elseif ($respuesta_76 === '') {
    $verificar_76 = '';
} else {
    $verificar_76 = "incorrecto";
}

 $respuesta_77 = isset($_POST['respuesta_77']) ? $_POST['respuesta_77'] : '';
if ($respuesta_77 === 'errores') { 
    $verificar_77 = "correcto";
} elseif ($respuesta_77 === '') {
    $verificar_77 = '';
} else {
    $verificar_77 = "incorrecto";
}

 $respuesta_78 = isset($_POST['respuesta_78']) ? $_POST['respuesta_78'] : '';
if ($respuesta_78 === 'integracion') { 
    $verificar_78 = "correcto";
} elseif ($respuesta_78 === '') {
    $verificar_78 = '';
} else {
    $verificar_78 = "incorrecto";
}

 $respuesta_79 = isset($_POST['respuesta_79']) ? $_POST['respuesta_79'] : '';
if ($respuesta_79 === 'colaboracion') { 
    $verificar_79 = "correcto";
} elseif ($respuesta_79 === '') {
    $verificar_79 = '';
} else {
    $verificar_79 = "incorrecto";
}

 $respuesta_80 = isset($_POST['respuesta_80']) ? $_POST['respuesta_80'] : '';
if ($respuesta_80 === 'probado') { 
    $verificar_80 = "correcto";
} elseif ($respuesta_80 === '') {
    $verificar_80 = '';
} else {
    $verificar_80 = "incorrecto";
}

 $respuesta_81 = isset($_POST['respuesta_81']) ? $_POST['respuesta_81'] : '';
if ($respuesta_81 === 'Pruebas continuas') { 
    $verificar_81 = "correcto";
} elseif ($respuesta_81 === '') {
    $verificar_81 = '';
} else {
    $verificar_81 = "incorrecto";
}

    $respuesta_82 = isset($_POST['respuesta_82']) ? $_POST['respuesta_82'] : '';
    if ($respuesta_82 === 'Continuous Testing') { 
        $verificar_82 = "correcto";
    } elseif ($respuesta_82 === '') {
        $verificar_82 = '';
    } else {
        $verificar_82 = "incorrecto";
    }

    $respuesta_83 = isset($_POST['respuesta_83']) ? $_POST['respuesta_83'] : '';
    if ($respuesta_83 === 'realizar') { 
       $verificar_83 = "correcto";
    } elseif ($respuesta_83 === '') {
        $verificar_83 = '';
    } else {
        $verificar_83 = "incorrecto";
    }

    $respuesta_84 = isset($_POST['respuesta_84']) ? $_POST['respuesta_84'] : '';
    if ($respuesta_84 === 'ciclo') { 
        $verificar_84 = "correcto";
    } elseif ($respuesta_84 === '') {
        $verificar_84 = '';
    } else {
        $verificar_84 = "incorrecto";
    }

    $respuesta_85 = isset($_POST['respuesta_85']) ? $_POST['respuesta_85'] : '';
    if ($respuesta_85 === 'desarrollo') { 
        $verificar_85 = "correcto";
    } elseif ($respuesta_85 === '') {
        $verificar_85 = '';
    } else {
        $verificar_85 = "incorrecto";
    }

    $respuesta_86 = isset($_POST['respuesta_86']) ? $_POST['respuesta_86'] : '';
    if ($respuesta_86 === 'continuamente') { 
        $verificar_86 = "correcto";
    } elseif ($respuesta_86 === '') {
        $verificar_86 = '';
    } else {
        $verificar_86 = "incorrecto";
    }

    $respuesta_87 = isset($_POST['respuesta_87']) ? $_POST['respuesta_87'] : '';
    if ($respuesta_87 === 'correcto') { 
        $verificar_87 = "correcto";
    } elseif ($respuesta_87 === '') {
        $verificar_87 = '';
    } else {
        $verificar_87 = "incorrecto";
    }

    $respuesta_88 = isset($_POST['respuesta_88']) ? $_POST['respuesta_88'] : '';
    if ($respuesta_88 === 'software') { 
        $verificar_88 = "correcto";
    } elseif ($respuesta_88 === '') {
        $verificar_88 = '';
    } else {
        $verificar_88 = "incorrecto";
    }

 $respuesta_89 = isset($_POST['respuesta_89']) ? $_POST['respuesta_89'] : '';
if ($respuesta_89 === 'problemas') { 
    $verificar_89 = "correcto";
} elseif ($respuesta_89 === '') {
    $verificar_89 = '';
} else {
    $verificar_89 = "incorrecto";
}

 $respuesta_90 = isset($_POST['respuesta_90']) ? $_POST['respuesta_90'] : '';
if ($respuesta_90 === 'produccion') { 
    $verificar_90 = "correcto";
} elseif ($respuesta_90 === '') {
    $verificar_90 = '';
} else {
    $verificar_90 = "incorrecto";
}

 $respuesta_91 = isset($_POST['respuesta_91']) ? $_POST['respuesta_91'] : '';
if ($respuesta_91 === 'tempranas') { 
    $verificar_91 = "correcto";
} elseif ($respuesta_91 === '') {
    $verificar_91 = '';
} else {
    $verificar_91 = "incorrecto";
}

 $respuesta_92 = isset($_POST['respuesta_92']) ? $_POST['respuesta_92'] : '';
if ($respuesta_92 === 'costos') { 
    $verificar_92 = "correcto";
} elseif ($respuesta_92 === '') {
    $verificar_92 = '';
} else {
    $verificar_92 = "incorrecto";
}

 $respuesta_93 = isset($_POST['respuesta_93']) ? $_POST['respuesta_93'] : '';
if ($respuesta_93 === 'rapidos') { 
    $verificar_93 = "correcto";
} elseif ($respuesta_93 === '') {
    $verificar_93 = '';
} else {
    $verificar_93 = "incorrecto";
}

 $respuesta_94 = isset($_POST['respuesta_94']) ? $_POST['respuesta_94'] : '';
if ($respuesta_94 === 'calidad') { 
    $verificar_94 = "correcto";
} elseif ($respuesta_94 === '') {
    $verificar_94 = '';
} else {
    $verificar_94 = "incorrecto";
}

 $respuesta_95 = isset($_POST['respuesta_95']) ? $_POST['respuesta_95'] : '';
if ($respuesta_95 === 'Deploy') { 
    $verificar_95 = "correcto";
} elseif ($respuesta_95 === '') {
    $verificar_95 = '';
} else {
    $verificar_95 = "incorrecto";
}

 $respuesta_96 = isset($_POST['respuesta_96']) ? $_POST['respuesta_96'] : '';
if ($respuesta_96 === 'Implementar') { 
    $verificar_96 = "correcto";
} elseif ($respuesta_96 === '') {
    $verificar_96 = '';
} else {
    $verificar_96 = "incorrecto";
}

 $respuesta_97 = isset($_POST['respuesta_97']) ? $_POST['respuesta_97'] : '';
if ($respuesta_97 === 'liberar') { 
    $verificar_97 = "correcto";
} elseif ($respuesta_97 === '') {
    $verificar_97 = '';
} else {
    $verificar_97 = "incorrecto";
}

 $respuesta_98 = isset($_POST['respuesta_98']) ? $_POST['respuesta_98'] : '';
if ($respuesta_98 === 'rapidamente') { 
    $verificar_98 = "correcto";
} elseif ($respuesta_98 === '') {
    $verificar_98 = '';
} else {
    $verificar_98 = "incorrecto";
}

 $respuesta_99 = isset($_POST['respuesta_99']) ? $_POST['respuesta_99'] : '';
if ($respuesta_99 === 'confiable') { 
    $verificar_99 = "correcto";
} elseif ($respuesta_99 === '') {
    $verificar_99 = '';
} else {
    $verificar_99 = "incorrecto";
}


 $respuesta_100 = isset($_POST['respuesta_100']) ? $_POST['respuesta_100'] : '';
if ($respuesta_100 === 'despliegue') { 
    $verificar_100 = "correcto";
} elseif ($respuesta_100 === '') {
    $verificar_100 = '';
} else {
    $verificar_100 = "incorrecto";
}

 $respuesta_101 = isset($_POST['respuesta_101']) ? $_POST['respuesta_101'] : '';
if ($respuesta_101 === 'integracion') { 
    $verificar_101 = "correcto";
} elseif ($respuesta_101 === '') {
    $verificar_101 = '';
} else {
    $verificar_101 = "incorrecto";
}

 $respuesta_102 = isset($_POST['respuesta_102']) ? $_POST['respuesta_102'] : '';
if ($respuesta_102 === 'automatizacion') { 
    $verificar_102 = "correcto";
} elseif ($respuesta_102 === '') {
    $verificar_102 = '';
} else {
    $verificar_102 = "incorrecto";
}

 $respuesta_103 = isset($_POST['respuesta_103']) ? $_POST['respuesta_103'] : '';
if ($respuesta_103 === 'proceso') { 
    $verificar_103 = "correcto";
} elseif ($respuesta_103 === '') {
    $verificar_103 = '';
} else {
    $verificar_103 = "incorrecto";
}

 $respuesta_104 = isset($_POST['respuesta_104']) ? $_POST['respuesta_104'] : '';
if ($respuesta_104 === 'Pipelines') { 
    $verificar_104 = "correcto";
} elseif ($respuesta_104 === '') {
    $verificar_104 = '';
} else {
    $verificar_104 = "incorrecto";
}

 $respuesta_105 = isset($_POST['respuesta_105']) ? $_POST['respuesta_105'] : '';
if ($respuesta_105 === 'Automatizacion') { 
    $verificar_105 = "correcto";
} elseif ($respuesta_105 === '') {
    $verificar_105 = '';
} else {
    $verificar_105 = "incorrecto";
}

 $respuesta_106 = isset($_POST['respuesta_106']) ? $_POST['respuesta_106'] : '';
if ($respuesta_106 === 'despliegues') { 
    $verificar_106 = "correcto";
} elseif ($respuesta_106 === '') {
    $verificar_106 = '';
} else {
    $verificar_106 = "incorrecto";
}

 $respuesta_107 = isset($_POST['respuesta_107']) ? $_POST['respuesta_107'] : '';
if ($respuesta_107 === 'QA') { 
    $verificar_107 = "correcto";
} elseif ($respuesta_107 === '') {
    $verificar_107 = '';
} else {
    $verificar_107 = "incorrecto";
}

 $respuesta_108 = isset($_POST['respuesta_108']) ? $_POST['respuesta_108'] : '';
if ($respuesta_108 === 'produccion') { 
    $verificar_108 = "correcto";
} elseif ($respuesta_108 === '') {
    $verificar_108 = '';
} else {
    $verificar_108 = "incorrecto";
}

 $respuesta_109 = isset($_POST['respuesta_109']) ? $_POST['respuesta_109'] : '';
if ($respuesta_109 === 'funcionalidades') { 
    $verificar_109 = "correcto";
} elseif ($respuesta_109 === '') {
    $verificar_109 = '';
} else {
    $verificar_109 = "incorrecto";
}

 $respuesta_110 = isset($_POST['respuesta_110']) ? $_POST['respuesta_110'] : '';
if ($respuesta_110 === 'errores') { 
    $verificar_110 = "correcto";
} elseif ($respuesta_110 === '') {
    $verificar_110 = '';
} else {
    $verificar_110 = "incorrecto";
}

 $respuesta_111 = isset($_POST['respuesta_111']) ? $_POST['respuesta_111'] : '';
if ($respuesta_111 === 'eficiencia') {  
    $verificar_111 = "correcto";
} elseif ($respuesta_111 === '') {
    $verificar_111 = '';
} else {
    $verificar_111 = "incorrecto";
}

$respuesta_112 = isset($_POST['respuesta_112']) ? $_POST['respuesta_112'] : '';
if ($respuesta_112 === '36') {  
    $verificar_112 = "correcto";
} elseif ($respuesta_112 === '') {
    $verificar_112 = '';
} else {
    $verificar_112 = "incorrecto";
}

$respuesta_113 = isset($_POST['respuesta_113']) ? $_POST['respuesta_113'] : '';
if ($respuesta_113 === '48') {  
    $verificar_113 = "correcto";
} elseif ($respuesta_113 === '') {
    $verificar_113 = '';
} else {
    $verificar_113 = "incorrecto";
}

$respuesta_114 = isset($_POST['respuesta_114']) ? $_POST['respuesta_114'] : '';
if ($respuesta_114 === '60') {  
    $verificar_114 = "correcto";
} elseif ($respuesta_114 === '') {
    $verificar_114 = '';
} else {
    $verificar_114 = "incorrecto";
}

$respuesta_115 = isset($_POST['respuesta_115']) ? $_POST['respuesta_115'] : '';
if ($respuesta_115 === '72') {  
    $verificar_115 = "correcto";
} elseif ($respuesta_115 === '') {
    $verificar_115 = '';
} else {
    $verificar_115 = "incorrecto";
}

$respuesta_116 = isset($_POST['respuesta_116']) ? $_POST['respuesta_116'] : '';
if ($respuesta_116 === '84') {  
    $verificar_116 = "correcto";
} elseif ($respuesta_116 === '') {
    $verificar_116 = '';
} else {
    $verificar_116 = "incorrecto";
}

$respuesta_117 = isset($_POST['respuesta_117']) ? $_POST['respuesta_117'] : '';
if ($respuesta_117 === '96') {  
    $verificar_117 = "correcto";
} elseif ($respuesta_117 === '') {
    $verificar_117 = '';
} else {
    $verificar_117 = "incorrecto";
}

$respuesta_118 = isset($_POST['respuesta_118']) ? $_POST['respuesta_118'] : '';
if ($respuesta_118 === '108') {  
    $verificar_118 = "correcto";
} elseif ($respuesta_118 === '') {
    $verificar_118 = '';
} else {
    $verificar_118 = "incorrecto";
}

$respuesta_119 = isset($_POST['respuesta_119']) ? $_POST['respuesta_119'] : '';
if ($respuesta_119 === '120') {  
    $verificar_119 = "correcto";
} elseif ($respuesta_119 === '') {
    $verificar_119 = '';
} else {
    $verificar_119 = "incorrecto";
}

$respuesta_120 = isset($_POST['respuesta_120']) ? $_POST['respuesta_120'] : '';
if ($respuesta_120 === '132') {  
    $verificar_120 = "correcto";
} elseif ($respuesta_120 === '') {
    $verificar_120 = '';
} else {
    $verificar_120 = "incorrecto";
}

$respuesta_121 = isset($_POST['respuesta_121']) ? $_POST['respuesta_121'] : '';
if ($respuesta_121 === '144') {  
    $verificar_121 = "correcto";
} elseif ($respuesta_121 === '') {
    $verificar_121 = '';
} else {
    $verificar_121 = "incorrecto";
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
    height: 370vh;
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

 <h3>Resumen de repaso — Capítulo 2: Capacidades de DevOps y rutas de adopción</h3>

<p>
El Capítulo 2 explica las principales <strong>capacidades que forman DevOps</strong>
y cómo una organización puede adoptar DevOps mediante diferentes
<strong>rutas de implementación (adoption paths)</strong>.
</p>

<p>
La idea principal del capítulo es que <strong>DevOps no es solamente una 
<input type="text" name="respuesta_1" value="<?php echo $respuesta_1; ?>" size="8">    
o 
<input type="text" name="respuesta_2" value="<?php echo $respuesta_2; ?>" size="8">
 </strong>, sino una 
<input type="text" name="respuesta_3" value="<?php echo $respuesta_3; ?>" size="8">
  de:
</p>

<ul>
    <li><strong>
    <input type="text" name="respuesta_4" value="<?php echo $respuesta_4; ?>" size="8">    
     :</strong> equipos que colaboran.</li>
    <li><strong>
    <input type="text" name="respuesta_5" value="<?php echo $respuesta_5; ?>" size="8">    
     :</strong> prácticas de trabajo eficientes.</li>
    <li><strong>
    <input type="text" name="respuesta_6" value="<?php echo $respuesta_6; ?>" size="8">    
     :</strong> herramientas de automatización.</li>
</ul>

<p>
Estas 
<input type="text" name="respuesta_7" value="<?php echo $respuesta_7; ?>" size="8">
  abarcan todo el <strong>
<input type="text" name="respuesta_8" value="<?php echo $respuesta_8; ?>" size="8">    
  de entrega de software</strong>,
desde la 
<input type="text" name="respuesta_9" value="<?php echo $respuesta_9; ?>" size="8">
  del negocio hasta la 
<input type="text" name="respuesta_10" value="<?php echo $respuesta_10; ?>" size="8">
  del sistema en 
<input type="text" name="respuesta_11" value="<?php echo $respuesta_11; ?>" size="8">
 .
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
    <?php echo $verificar_9 ?>
    <?php echo $verificar_10 ?>
    <?php echo $verificar_11 ?> 

<hr>
<h3>Arquitectura de referencia de DevOps</h3>

<p>
El capítulo presenta una <strong>arquitectura de referencia de DevOps</strong>,
que sirve como 
<input type="text" name="respuesta_12" value="<?php echo $respuesta_12; ?>" size="8">
  para que las organizaciones 
<input type="text" name="respuesta_13" value="<?php echo $respuesta_13; ?>" size="8">
  una plataforma DevOps.
</p>

<p>
Esta arquitectura ayuda a integrar:
</p>

<ul>
    <li>
    <input type="text" name="respuesta_14" value="<?php echo $respuesta_14; ?>" size="8">    
      del negocio.</li>
    <li>
    <input type="text" name="respuesta_15" value="<?php echo $respuesta_15; ?>" size="8">    
      de software.</li>
    <li>
    <input type="text" name="respuesta_16" value="<?php echo $respuesta_16; ?>" size="8">    
     .</li>
    <li>
    <input type="text" name="respuesta_17" value="<?php echo $respuesta_17; ?>" size="8">    
     .</li>
    <li>
    <input type="text" name="respuesta_18" value="<?php echo $respuesta_18; ?>" size="8">    
     .</li>
    <li>
    <input type="text" name="respuesta_19" value="<?php echo $respuesta_19; ?>" size="8">    
      del 
    <input type="text" name="respuesta_20" value="<?php echo $respuesta_20; ?>" size="8">
     .</li>
</ul>

<p>
La arquitectura propone 
<input type="text" name="respuesta_21" value="<?php echo $respuesta_21; ?>" size="8">
  rutas principales de adopción:
</p>

<ol>
    <li><strong>
    <input type="text" name="respuesta_22" value="<?php echo $respuesta_22; ?>" size="8">    
      (
    <input type="text" name="respuesta_23" value="<?php echo $respuesta_23; ?>" size="8">    
     )</strong></li>
    <li><strong>
    <input type="text" name="respuesta_24" value="<?php echo $respuesta_24; ?>" size="8">    
      (
    <input type="text" name="respuesta_25" value="<?php echo $respuesta_25; ?>" size="8">    
     )</strong></li>
    <li><strong>
    <input type="text" name="respuesta_26" value="<?php echo $respuesta_26; ?>" size="8">    
      (
    <input type="text" name="respuesta_27" value="<?php echo $respuesta_27; ?>" size="8">    
     )</strong></li>
    <li><strong>
    <input type="text" name="respuesta_28" value="<?php echo $respuesta_28; ?>" size="8">    
      (
    <input type="text" name="respuesta_29" value="<?php echo $respuesta_29; ?>" size="8">    
     )</strong></li>
</ol>

    <button type="submit">Enviar</button>
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
    <?php echo $verificar_24 ?>
    <?php echo $verificar_25 ?>
    <?php echo $verificar_26 ?>
    <?php echo $verificar_27 ?>
    <?php echo $verificar_28 ?>
    <?php echo $verificar_29 ?>
    <hr>
<h3>1. 
<input type="text" name="respuesta_41" value="<?php echo $respuesta_41; ?>" size="8">    
  (
<input type="text" name="respuesta_42" value="<?php echo $respuesta_42; ?>" size="8">    
 )</h3>

<p>
Su objetivo es alinear el 
<input type="text" name="respuesta_30" value="<?php echo $respuesta_30; ?>" size="8">
  de 
<input type="text" name="respuesta_31" value="<?php echo $respuesta_31; ?>" size="8">
  con los
<strong>
<input type="text" name="respuesta_32" value="<?php echo $respuesta_32; ?>" size="8">    
  del 
<input type="text" name="respuesta_33" value="<?php echo $respuesta_33; ?>" size="8">
 </strong> y ajustarlos mediante la 
<input type="text" name="respuesta_34" value="<?php echo $respuesta_34; ?>" size="8">
  de los 
<input type="text" name="respuesta_35" value="<?php echo $respuesta_35; ?>" size="8">
 .
</p>

<h4>Práctica principal: 
<input type="text" name="respuesta_36" value="<?php echo $respuesta_36; ?>" size="8">    
  empresarial continua</h4>

<p>
La 
<input type="text" name="respuesta_37" value="<?php echo $respuesta_37; ?>" size="8">
  empresarial continua permite que las organizaciones sean
más 
<input type="text" name="respuesta_38" value="<?php echo $respuesta_38; ?>" size="8">
  y puedan 
<input type="text" name="respuesta_39" value="<?php echo $respuesta_39; ?>" size="8">
  rápidamente a los 
<input type="text" name="respuesta_40" value="<?php echo $respuesta_40; ?>" size="8">
  del mercado.
</p>
    <button type="submit">Enviar</button>
    <?php echo $verificar_30 ?>
    <?php echo $verificar_31 ?>
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
<p>
Los métodos tradicionales suelen ser 
<input type="text" name="respuesta_43" value="<?php echo $respuesta_43; ?>" size="8">
  debido a:
</p>

<ul>
    <li>Procesos 
    <input type="text" name="respuesta_44" value="<?php echo $respuesta_44; ?>" size="8">    
     .</li>
    <li>Equipos 
    <input type="text" name="respuesta_45" value="<?php echo $respuesta_45; ?>" size="8">    
      o trabajando en 
    <input type="text" name="respuesta_46" value="<?php echo $respuesta_46; ?>" size="8">
     .</li>
    <li>Falta de 
    <input type="text" name="respuesta_47" value="<?php echo $respuesta_47; ?>" size="8">    
    entre áreas.</li>
    </ul>

    <p>
    DevOps permite que los equipos 
    <input type="text" name="respuesta_48" value="<?php echo $respuesta_48; ?>" size="8">
      para definir 
    <input type="text" name="respuesta_49" value="<?php echo $respuesta_49; ?>" size="8">
      y modificarlos
    constantemente según la 
    <input type="text" name="respuesta_50" value="<?php echo $respuesta_50; ?>" size="8">
      de los clientes.
    </p>

<h4>Beneficios</h4>

<ul>
    <li>Mayor 
    <input type="text" name="respuesta_51" value="<?php echo $respuesta_51; ?>" size="8">    
      empresarial.</li>
    <li>Mejor toma de 
    <input type="text" name="respuesta_52" value="<?php echo $respuesta_52; ?>" size="8">    
     .</li>
    <li>Reducción de 
    <input type="text" name="respuesta_53" value="<?php echo $respuesta_53; ?>" size="8">    
      y 
    <input type="text" name="respuesta_54" value="<?php echo $respuesta_54; ?>" size="8">
     .</li>
    <li>Mayor 
    <input type="text" name="respuesta_55" value="<?php echo $respuesta_55; ?>" size="8">    
      entregado al cliente.</li>
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
    <?php echo $verificar_52 ?>
    <?php echo $verificar_53 ?>
    <?php echo $verificar_54 ?>
    <?php echo $verificar_55 ?>
<hr>
<h3>2. 
<input type="text" name="respuesta_56" value="<?php echo $respuesta_56; ?>" size="8">     
  (
<input type="text" name="respuesta_57" value="<?php echo $respuesta_57; ?>" size="14">     
 )</h3>

<p>
Su objetivo es crear software de 
<input type="text" name="respuesta_58" value="<?php echo $respuesta_58; ?>" size="8"> 
  mediante la 
<input type="text" name="respuesta_59" value="<?php echo $respuesta_59; ?>" size="8"> 
  entre equipos
y la realización de 
<input type="text" name="respuesta_60" value="<?php echo $respuesta_60; ?>" size="8"> 
 .
</p>

<p>
Incluye dos prácticas principales:
</p>

<ul>
    <li>
    <input type="text" name="respuesta_61" value="<?php echo $respuesta_61; ?>" size="8">     
     .</li>
    <li>
    <input type="text" name="respuesta_62" value="<?php echo $respuesta_62; ?>" size="8">     
     .</li>
</ul>


<h4>
<input type="text" name="respuesta_63" value="<?php echo $respuesta_63; ?>" size="8">    
 </h4>

<p>
Permite que diferentes equipos trabajen 
<input type="text" name="respuesta_64" value="<?php echo $respuesta_64; ?>" size="8">
 , incluyendo:
</p>

<ul>
    <li>
    <input type="text" name="respuesta_65" value="<?php echo $respuesta_65; ?>" size="8">    
     .</li>
    <li>
    <input type="text" name="respuesta_66" value="<?php echo $respuesta_66; ?>" size="8">    
      de software.</li>
    <li>Analistas de 
    <input type="text" name="respuesta_67" value="<?php echo $respuesta_67; ?>" size="8">    
     .</li>
    <li>Equipos de 
    <input type="text" name="respuesta_68" value="<?php echo $respuesta_68; ?>" size="8">    
     .</li>
    <li>
    <input type="text" name="respuesta_69" value="<?php echo $respuesta_69; ?>" size="8">    
     .</li>
    <li>Especialistas de 
    <input type="text" name="respuesta_70" value="<?php echo $respuesta_70; ?>" size="8">    
     .</li>
</ul>

<h4>
<input type="text" name="respuesta_71" value="<?php echo $respuesta_71; ?>" size="14">    
  (
<input type="text" name="respuesta_72" value="<?php echo $respuesta_72; ?>" size="14">    
 )</h4>

<p>
Consiste en que los desarrolladores 
<input type="text" name="respuesta_73" value="<?php echo $respuesta_73; ?>" size="8">
  frecuentemente su código con el
<input type="text" name="respuesta_74" value="<?php echo $respuesta_74; ?>" size="8">
  del 
<input type="text" name="respuesta_75" value="<?php echo $respuesta_75; ?>" size="8">
  del 
<input type="text" name="respuesta_76" value="<?php echo $respuesta_76; ?>" size="8">
 .
</p>

<h4>Beneficios</h4>

<ul>
    <li>Detección temprana de 
    <input type="text" name="respuesta_77" value="<?php echo $respuesta_77; ?>" size="8">    
     .</li>
    <li>Reducción de riesgos de 
    <input type="text" name="respuesta_78" value="<?php echo $respuesta_78; ?>" size="8">    
     .</li>
    <li>Mejor 
    <input type="text" name="respuesta_79" value="<?php echo $respuesta_79; ?>" size="8">    
      entre equipos.</li>
    <li>Código 
    <input type="text" name="respuesta_80" value="<?php echo $respuesta_80; ?>" size="8">    
      continuamente.</li>
</ul>


<button type="submit">Enviar</button>
<?php echo $verificar_56 ?>
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
<hr>

<h4>
<input type="text" name="respuesta_81" value="<?php echo $respuesta_81; ?>" size="14">    
  (
<input type="text" name="respuesta_82" value="<?php echo $respuesta_82; ?>" size="14">    
 )</h4>

<p>
Consiste en 
<input type="text" name="respuesta_83" value="<?php echo $respuesta_83; ?>" size="8">
  pruebas durante todo el 
<input type="text" name="respuesta_84" value="<?php echo $respuesta_84; ?>" size="8">
  de 
<input type="text" name="respuesta_85" value="<?php echo $respuesta_85; ?>" size="8">
  del software.
</p>

<p>
Busca:
</p>

<ul>
    <li>Verificar 
    <input type="text" name="respuesta_86" value="<?php echo $respuesta_86; ?>" size="8">    
      el código.</li>
    <li>Garantizar el 
    <input type="text" name="respuesta_87" value="<?php echo $respuesta_87; ?>" size="8">    
      funcionamiento del 
    <input type="text" name="respuesta_88" value="<?php echo $respuesta_88; ?>" size="8">
     .</li>
    <li>Detectar 
    <input type="text" name="respuesta_89" value="<?php echo $respuesta_89; ?>" size="8">    
      antes de llegar a 
    <input type="text" name="respuesta_90" value="<?php echo $respuesta_90; ?>" size="8">    
     .</li>
</ul>

<h4>Shift-left testing</h4>

<p>
Es un enfoque donde las pruebas se realizan desde etapas 
<input type="text" name="respuesta_91" value="<?php echo $respuesta_91; ?>" size="8">
  del
desarrollo para incorporar calidad desde el inicio.
</p>

<h4>Beneficios</h4>

<ul>
    <li>Menores 
    <input type="text" name="respuesta_92" value="<?php echo $respuesta_92; ?>" size="8">    
     .</li>
    <li>Ciclos de prueba más 
    <input type="text" name="respuesta_93" value="<?php echo $respuesta_93; ?>" size="8">    
     .</li>
    <li>Mayor 
    <input type="text" name="respuesta_94" value="<?php echo $respuesta_94; ?>" size="8">    
      del software.</li>
</ul>

<button type="submit">Enviar</button>
<?php echo $verificar_81 ?>
<?php echo $verificar_82 ?>
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
<?php echo $verificar_94 ?>
<hr>
 

 

 
   
</div>




<div class="seccion derecha">
    <h3>3. 
    <input type="text" name="respuesta_95" value="<?php echo $respuesta_95; ?>" size="8">    
      (
    <input type="text" name="respuesta_96" value="<?php echo $respuesta_96; ?>" size="8">    
     )</h3>

<p>
Su objetivo es 
<input type="text" name="respuesta_97" value="<?php echo $respuesta_97; ?>" size="8">
  software 
<input type="text" name="respuesta_98" value="<?php echo $respuesta_98; ?>" size="8">
  y de manera 
<input type="text" name="respuesta_99" value="<?php echo $respuesta_99; ?>" size="8">
 .
</p>

<h4>Entrega y 
<input type="text" name="respuesta_100" value="<?php echo $respuesta_100; ?>" size="8">    
  continuo</h4>

<p>
Lleva la 
<input type="text" name="respuesta_101" value="<?php echo $respuesta_101; ?>" size="8">
  continua a un siguiente nivel mediante la 
<input type="text" name="respuesta_102" value="<?php echo $respuesta_102; ?>" size="8">
  del 
<input type="text" name="respuesta_103" value="<?php echo $respuesta_103; ?>" size="8">
  de entrega.
</p>

<p>
Incluye:
</p>

<ul>
    <li>
    <input type="text" name="respuesta_104" value="<?php echo $respuesta_104; ?>" size="8">    
      de entrega.</li>
    <li>
    <input type="text" name="respuesta_105" value="<?php echo $respuesta_105; ?>" size="8">    
      de 
    <input type="text" name="respuesta_106" value="<?php echo $respuesta_106; ?>" size="8">
     .</li>
    <li>Implementación hacia 
    <input type="text" name="respuesta_107" value="<?php echo $respuesta_107; ?>" size="8">    
      y 
    <input type="text" name="respuesta_108" value="<?php echo $respuesta_108; ?>" size="8">    
     .</li>
</ul>

<h4>Beneficios</h4>

<ul>
    <li>Entrega rápida de nuevas 
    <input type="text" name="respuesta_109" value="<?php echo $respuesta_109; ?>" size="8">    
     .</li>
    <li>Menos 
    <input type="text" name="respuesta_110" value="<?php echo $respuesta_110; ?>" size="8">    
      humanos.</li>
    <li>Mayor 
    <input type="text" name="respuesta_111" value="<?php echo $respuesta_111; ?>" size="8">    
      en los procesos.</li>
</ul>
    <button type="submit">Enviar</button>
     <?php echo $verificar_95 ?>
<?php echo $verificar_96 ?>
<?php echo $verificar_97 ?>
<?php echo $verificar_98 ?>
<?php echo $verificar_99 ?>
<?php echo $verificar_100 ?>
<?php echo $verificar_101 ?>
<?php echo $verificar_102 ?>
<?php echo $verificar_103 ?>
<?php echo $verificar_104 ?>
<br><br>
<?php echo $verificar_105 ?>
<?php echo $verificar_106 ?>
<?php echo $verificar_107 ?>
<?php echo $verificar_108 ?>
<?php echo $verificar_109 ?>
<?php echo $verificar_110 ?>
<?php echo $verificar_111 ?>
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
