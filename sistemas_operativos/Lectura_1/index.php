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
 
    $respuesta_1 = 'Hardware';
    $respuesta_2 = 'Sistema operativo';
    $respuesta_3 = 'Programas de aplicacion';
    $respuesta_4 = 'Usuarios';
    $respuesta_5 = 'CPU';
    $respuesta_6 = 'procesador';
    $respuesta_7 = 'Memoria RAM';
    $respuesta_8 = 'Dispositivos de entrada/salida';
    $respuesta_9 = 'Almacenamiento';
    $respuesta_10 = 'discos';
    $respuesta_11 = 'Kernel';
    $respuesta_12 = 'nucleo';
    $respuesta_13 = 'sistema operativo';
    $respuesta_14 = 'middleware';
    $respuesta_15 = 'aplicaciones';
    $respuesta_16 = 'sistema';
    $respuesta_17 = 'constantemente';
    $respuesta_18 = 'señal';
    $respuesta_19 = 'dispositivo';
    $respuesta_20 = 'atencion';
    $respuesta_21 = 'genera';
    $respuesta_22 = 'procesador';
    $respuesta_23 = 'evento';
    $respuesta_24 = 'rapida';
    $respuesta_25 = 'memoria electronica';
    $respuesta_26 = 'partes mecanicas';
    $respuesta_27 = 'tiempo';
    $respuesta_28 = 'acceso';
    $respuesta_29 = 'velocidad';
    $respuesta_30 = 'lectura/escritura';
    $respuesta_31 = 'consumo';
    $respuesta_32 = 'energia';
    $respuesta_33 = 'pierde';
    $respuesta_34 = 'informacion';
    $respuesta_35 = 'apaga';
    $respuesta_36 = 'computador';
    $respuesta_37 = 'RAM';
    $respuesta_38 = 'conserva';
    $respuesta_39 = 'apague';
    $respuesta_40 = 'SSD';
    $respuesta_41 = 'HDD';
    $respuesta_42 = 'USB';
    $respuesta_43 = 'capacidad';
    $respuesta_44 = 'procesamiento';
    $respuesta_45 = 'ejecutar';
    $respuesta_46 = 'tareas simultaneamente';
    $respuesta_47 = 'rendimiento';
    $respuesta_48 = 'disponibilidad';
    $respuesta_49 = 'sistema';
    $respuesta_50 = 'Falso';
    $respuesta_51 = 'modernos';
    $respuesta_52 = 'multiprocesamiento simetrico';
    $respuesta_53 = 'SMP';
    $respuesta_54 = 'Sistema multicore';
    $respuesta_55 = 'multinucleo';
    $respuesta_56 = 'nucleos';
    $respuesta_57 = 'mismo procesador';
    $respuesta_58 = 'computadores independientes';
    $respuesta_59 = 'una red';
    $respuesta_60 = 'proceso';
    $respuesta_61 = 'esperando';
    $respuesta_62 = 'ejecuta';
    $respuesta_63 = 'la CPU';
    $respuesta_64 = 'desocupada';
    $respuesta_65 = 'Proceso';
    $respuesta_66 = 'planificador';
    $respuesta_67 = 'scheduler';
    $respuesta_68 = 'Modo usuario';
    $respuesta_69 = 'Modo supervisor';
    $respuesta_70 = 'modo kernel';
    $respuesta_71 = 'Modo supervisor/kernel';
    $respuesta_72 = 'Modo supervisor/kernel';
    $respuesta_73 = 'Modo usuario';
    $respuesta_74 = 'Asignar memoria a los procesos';
    $respuesta_75 = 'Liberar memoria cuando deja de utilizarse';
    $respuesta_76 = 'Administrar memoria virtual';
    $respuesta_77 = 'Verdadero';
    $respuesta_78 = 'archivos';
    $respuesta_79 = 'carpetas';
    $respuesta_80 = 'Crear';
    $respuesta_81 = 'eliminar';
    $respuesta_82 = 'Leer';
    $respuesta_83 = 'escribir';
    $respuesta_84 = 'espacio libre';
    $respuesta_85 = 'lecturas';
    $respuesta_86 = 'escrituras';
    $respuesta_87 = 'particiones';
    $respuesta_88 = 'permisos';
    $respuesta_89 = 'Registros';
    $respuesta_90 = 'Cache';
    $respuesta_91 = 'Memoria principal';
    $respuesta_92 = 'RAM';
    $respuesta_93 = 'SSD';
    $respuesta_94 = 'Disco magnetico';
    $respuesta_95 = 'HDD';
    
        
        // Marcar todas como correctas
    for ($i = 1; $i <= 122; $i++) {
    ${"verificar_$i"} = "correcto";
    }

    } else {
    $respuesta_1 = isset($_POST['respuesta_1']) ? $_POST['respuesta_1'] : '';
   if ($respuesta_1 === 'Hardware') {  
       $verificar_1 = "correcto";
   } elseif ($respuesta_1 === '') {
       $verificar_1 = '';
   } else {
       $verificar_1 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_2 = isset($_POST['respuesta_2']) ? $_POST['respuesta_2'] : '';
   if ($respuesta_2 === 'Sistema operativo') {  
       $verificar_2 = "correcto";
   } elseif ($respuesta_2 === '') {
       $verificar_2 = '';
   } else {
       $verificar_2 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_3 = isset($_POST['respuesta_3']) ? $_POST['respuesta_3'] : '';
   if ($respuesta_3 === 'Programas de aplicacion') {  
       $verificar_3 = "correcto";
   } elseif ($respuesta_3 === '') {
       $verificar_3 = '';
   } else {
       $verificar_3 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_4 = isset($_POST['respuesta_4']) ? $_POST['respuesta_4'] : '';
   if ($respuesta_4 === 'Usuarios') {  
       $verificar_4 = "correcto";
   } elseif ($respuesta_4 === '') {
       $verificar_4 = '';
   } else {
       $verificar_4 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_5 = isset($_POST['respuesta_5']) ? $_POST['respuesta_5'] : '';
   if ($respuesta_5 === 'CPU') {  
       $verificar_5 = "correcto";
   } elseif ($respuesta_5 === '') {
       $verificar_5 = '';
   } else {
       $verificar_5 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_6 = isset($_POST['respuesta_6']) ? $_POST['respuesta_6'] : '';
   if ($respuesta_6 === 'procesador') {  
       $verificar_6 = "correcto";
   } elseif ($respuesta_6 === '') {
       $verificar_6 = '';
   } else {
       $verificar_6 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_7 = isset($_POST['respuesta_7']) ? $_POST['respuesta_7'] : '';
   if ($respuesta_7 === 'Memoria RAM') {  
       $verificar_7 = "correcto";
   } elseif ($respuesta_7 === '') {
       $verificar_7 = '';
   } else {
       $verificar_7 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_8 = isset($_POST['respuesta_8']) ? $_POST['respuesta_8'] : '';
   if ($respuesta_8 === 'Dispositivos de entrada/salida') {  
       $verificar_8 = "correcto";
   } elseif ($respuesta_8 === '') {
       $verificar_8 = '';
   } else {
       $verificar_8 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_9 = isset($_POST['respuesta_9']) ? $_POST['respuesta_9'] : '';
   if ($respuesta_9 === 'Almacenamiento') {  
       $verificar_9 = "correcto";
   } elseif ($respuesta_9 === '') {
       $verificar_9 = '';
   } else {
       $verificar_9 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_10 = isset($_POST['respuesta_10']) ? $_POST['respuesta_10'] : '';
   if ($respuesta_10 === 'discos') {  
       $verificar_10 = "correcto";
   } elseif ($respuesta_10 === '') {
       $verificar_10 = '';
   } else {
       $verificar_10 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_11 = isset($_POST['respuesta_11']) ? $_POST['respuesta_11'] : '';
   if ($respuesta_11 === 'Kernel') {  
       $verificar_11 = "correcto";
   } elseif ($respuesta_11 === '') {
       $verificar_11 = '';
   } else {
       $verificar_11 = "incorrecto";
   }


    // Verificar la respuesta de la primera pregunta
    $respuesta_12 = isset($_POST['respuesta_12']) ? $_POST['respuesta_12'] : '';
    if ($respuesta_12 === 'nucleo') {  
        $verificar_12 = "correcto";
    } elseif ($respuesta_12 === '') {
        $verificar_12 = '';
    } else {
        $verificar_12 = "incorrecto";
    }
  
    // Verificar la respuesta de la segunda pregunta
    $respuesta_13 = isset($_POST['respuesta_13']) ? $_POST['respuesta_13'] : '';
    if ($respuesta_13 === 'sistema operativo') { 
        $verificar_13 = "correcto";
    } elseif ($respuesta_13 === '') {
        $verificar_13 = '';
    } else {
         $verificar_13 = "incorrecto";
    }
  
    // Verificar la respuesta de la tercera pregunta
    $respuesta_14 = isset($_POST['respuesta_14']) ? $_POST['respuesta_14'] : '';
    if ($respuesta_14 === 'middleware') {  
        $verificar_14 = "correcto";
    } elseif ($respuesta_14 === '') {
        $verificar_14 = '';
    } else {
        $verificar_14 = "incorrecto";
    }
  
    // Verificar la respuesta de la cuarta pregunta
    $respuesta_15 = isset($_POST['respuesta_15']) ? $_POST['respuesta_15'] : '';
    if ($respuesta_15 === 'aplicaciones') { 
        $verificar_15 = "correcto";
    } elseif ($respuesta_15 === '') {
        $verificar_15 = '';
    } else {
        $verificar_15 = "incorrecto";
    }
  
    // Verificar la respuesta de la quinta pregunta
    $respuesta_16 = isset($_POST['respuesta_16']) ? $_POST['respuesta_16'] : '';
    if ($respuesta_16 === 'sistema') {  
        $verificar_16 = "correcto";
    } elseif ($respuesta_16 === '') {
        $verificar_16 = '';
    } else {
        $verificar_16 = "incorrecto";
    }
  
    // Verificar la respuesta de la sexta pregunta
    $respuesta_17 = isset($_POST['respuesta_17']) ? $_POST['respuesta_17'] : '';
    if ($respuesta_17 === 'constantemente') {  
        $verificar_17 = "correcto";
        } elseif ($respuesta_17 === '') {
        $verificar_17 = '';
    } else {
        $verificar_17 = "incorrecto";
    }
  
    // Verificar la respuesta de la séptima pregunta
    $respuesta_18 = isset($_POST['respuesta_18']) ? $_POST['respuesta_18'] : '';
    if ($respuesta_18 === 'señal') {  
        $verificar_18 = "correcto";
    } elseif ($respuesta_18 === '') {
        $verificar_18 = '';
    } else {
        $verificar_18 = "incorrecto";
    }
  
    // Verificar la respuesta de la octava pregunta
    $respuesta_19 = isset($_POST['respuesta_19']) ? $_POST['respuesta_19'] : '';
    if ($respuesta_19 === 'dispositivo') {  
        $verificar_19 = "correcto";
    } elseif ($respuesta_19 === '') {
        $verificar_19 = '';
    } else {
        $verificar_19 = "incorrecto";
    }
  
    // Verificar la respuesta de la novena pregunta
    $respuesta_20 = isset($_POST['respuesta_20']) ? $_POST['respuesta_20'] : '';
    if ($respuesta_20 === 'atencion') {  
        $verificar_20 = "correcto";
    } elseif ($respuesta_20 === '') {
        $verificar_20 = '';
    } else {
        $verificar_20 = "incorrecto";
    }
  
    // Verificar la respuesta de la décima pregunta
    $respuesta_21 = isset($_POST['respuesta_21']) ? $_POST['respuesta_21'] : '';
    if ($respuesta_21 === 'genera') {  
         $verificar_21 = "correcto";
    } elseif ($respuesta_21 === '') {
        $verificar_21 = '';
    } else {
        $verificar_21 = "incorrecto";
    }
  
    // Verificar la respuesta de la undécima pregunta
    $respuesta_22 = isset($_POST['respuesta_22']) ? $_POST['respuesta_22'] : '';
    if ($respuesta_22 === 'procesador') {  
        $verificar_22 = "correcto";
    } elseif ($respuesta_22 === '') {
        $verificar_22 = '';
    } else {
        $verificar_22 = "incorrecto";
    }

     // Verificar la respuesta de la primera pregunta
   $respuesta_23 = isset($_POST['respuesta_23']) ? $_POST['respuesta_23'] : '';
   if ($respuesta_23 === 'evento') {  
       $verificar_23 = "correcto";
   } elseif ($respuesta_23 === '') {
       $verificar_23 = '';
   } else {
       $verificar_23 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_24 = isset($_POST['respuesta_24']) ? $_POST['respuesta_24'] : '';
   if ($respuesta_24 === 'rapida') {  
       $verificar_24 = "correcto";
   } elseif ($respuesta_24 === '') {
       $verificar_24 = '';
   } else {
       $verificar_24 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_25 = isset($_POST['respuesta_25']) ? $_POST['respuesta_25'] : '';
   if ($respuesta_25 === 'memoria electronica') { 
       $verificar_25 = "correcto";
   } elseif ($respuesta_25 === '') {
       $verificar_25 = '';
   } else {
       $verificar_25 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_26 = isset($_POST['respuesta_26']) ? $_POST['respuesta_26'] : '';
   if ($respuesta_26 === 'partes mecanicas') {  
       $verificar_26 = "correcto";
   } elseif ($respuesta_26 === '') {
       $verificar_26 = '';
   } else {
       $verificar_26 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_27 = isset($_POST['respuesta_27']) ? $_POST['respuesta_27'] : '';
   if ($respuesta_27 === 'tiempo') {  
       $verificar_27 = "correcto";
   } elseif ($respuesta_27 === '') {
       $verificar_27 = '';
   } else {
       $verificar_27 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_28 = isset($_POST['respuesta_28']) ? $_POST['respuesta_28'] : '';
   if ($respuesta_28 === 'acceso') {  
       $verificar_28 = "correcto";
   } elseif ($respuesta_28 === '') {
       $verificar_28 = '';
   } else {
       $verificar_28 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_29 = isset($_POST['respuesta_29']) ? $_POST['respuesta_29'] : '';
   if ($respuesta_29 === 'velocidad') {  
       $verificar_29 = "correcto";
   } elseif ($respuesta_29 === '') {
       $verificar_29 = '';
   } else {
       $verificar_29 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_30 = isset($_POST['respuesta_30']) ? $_POST['respuesta_30'] : '';
   if ($respuesta_30 === 'lectura/escritura') {  
       $verificar_30 = "correcto";
   } elseif ($respuesta_30 === '') {
       $verificar_30 = '';
   } else {
       $verificar_30 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_31 = isset($_POST['respuesta_31']) ? $_POST['respuesta_31'] : '';
   if ($respuesta_31 === 'consumo') {  
       $verificar_31 = "correcto";
   } elseif ($respuesta_31 === '') {
       $verificar_31 = '';
   } else {
       $verificar_31 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_32 = isset($_POST['respuesta_32']) ? $_POST['respuesta_32'] : '';
   if ($respuesta_32 === 'energia') {  
       $verificar_32 = "correcto";
   } elseif ($respuesta_32 === '') {
       $verificar_32 = '';
   } else {
       $verificar_32 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_33 = isset($_POST['respuesta_33']) ? $_POST['respuesta_33'] : '';
   if ($respuesta_33 === 'pierde') {  
       $verificar_33 = "correcto";
   } elseif ($respuesta_33 === '') {
       $verificar_33 = '';
   } else {
       $verificar_33 = "incorrecto";
   }

    $respuesta_34 = isset($_POST['respuesta_34']) ? $_POST['respuesta_34'] : '';
    if ($respuesta_34 === 'informacion') { 
        $verificar_34 = "correcto";
    } elseif ($respuesta_34 === '') {
        $verificar_34 = '';
    } else {
        $verificar_34 = "incorrecto";
    }

    $respuesta_35 = isset($_POST['respuesta_35']) ? $_POST['respuesta_35'] : '';
    if ($respuesta_35 === 'apaga') { 
        $verificar_35 = "correcto";
    } elseif ($respuesta_35 === '') {
        $verificar_35 = '';
    } else {
        $verificar_35 = "incorrecto";
    }

    $respuesta_36 = isset($_POST['respuesta_36']) ? $_POST['respuesta_36'] : '';
    if ($respuesta_36 === 'computador') { 
        $verificar_36 = "correcto";
    } elseif ($respuesta_36 === '') {
    $verificar_36 = '';
    } else {
        $verificar_36 = "incorrecto";
    }

    $respuesta_37 = isset($_POST['respuesta_37']) ? $_POST['respuesta_37'] : '';
    if ($respuesta_37 === 'RAM') { 
        $verificar_37 = "correcto";
    } elseif ($respuesta_37 === '') {
        $verificar_37 = '';
    } else {
        $verificar_37 = "incorrecto";
    }

    $respuesta_38 = isset($_POST['respuesta_38']) ? $_POST['respuesta_38'] : '';
    if ($respuesta_38 === 'conserva') { 
        $verificar_38 = "correcto";
    } elseif ($respuesta_38 === '') {
        $verificar_38 = '';
    } else {
        $verificar_38 = "incorrecto";
    }

    $respuesta_39 = isset($_POST['respuesta_39']) ? $_POST['respuesta_39'] : '';
    if ($respuesta_39 === 'apague') { 
        $verificar_39 = "correcto";
    } elseif ($respuesta_39 === '') {
        $verificar_39 = '';
    } else {
        $verificar_39 = "incorrecto";
    }

    $respuesta_40 = isset($_POST['respuesta_40']) ? $_POST['respuesta_40'] : '';
    if ($respuesta_40 === 'SSD') { 
        $verificar_40 = "correcto";
    } elseif ($respuesta_40 === '') {
        $verificar_40 = '';
    } else {
        $verificar_40 = "incorrecto";
    }

    $respuesta_41 = isset($_POST['respuesta_41']) ? $_POST['respuesta_41'] : '';
    if ($respuesta_41 === 'HDD') { 
        $verificar_41 = "correcto";
    } elseif ($respuesta_41 === '') {
        $verificar_41 = '';
    } else {
        $verificar_41 = "incorrecto";
    }

    $respuesta_42 = isset($_POST['respuesta_42']) ? $_POST['respuesta_42'] : '';
    if ($respuesta_42 === 'USB') { 
        $verificar_42 = "correcto";
    } elseif ($respuesta_42 === '') {
        $verificar_42 = '';
    } else {
        $verificar_42 = "incorrecto";
    }

    $respuesta_43 = isset($_POST['respuesta_43']) ? $_POST['respuesta_43'] : '';
    if ($respuesta_43 === 'capacidad') { 
        $verificar_43 = "correcto";
    } elseif ($respuesta_43 === '') {
        $verificar_43 = '';
    } else {
    $verificar_43 = "incorrecto";
    }

    $respuesta_44 = isset($_POST['respuesta_44']) ? $_POST['respuesta_44'] : '';
    if ($respuesta_44 === 'procesamiento') { 
        $verificar_44 = "correcto";
    } elseif ($respuesta_44 === '') {
    $verificar_44 = '';
    } else {
        $verificar_44 = "incorrecto";
    }

    $respuesta_45 = isset($_POST['respuesta_45']) ? $_POST['respuesta_45'] : '';
    if ($respuesta_45 === 'ejecutar') { 
        $verificar_45 = "correcto";
    } elseif ($respuesta_45 === '') {
    $verificar_45 = '';
    } else {
        $verificar_45 = "incorrecto";
    }

    $respuesta_46 = isset($_POST['respuesta_46']) ? $_POST['respuesta_46'] : '';
    if ($respuesta_46 === 'tareas simultaneamente') { 
        $verificar_46 = "correcto";
    } elseif ($respuesta_46 === '') {
    $verificar_46 = '';
    } else {
        $verificar_46 = "incorrecto";
    }

    $respuesta_47 = isset($_POST['respuesta_47']) ? $_POST['respuesta_47'] : '';
    if ($respuesta_47 === 'rendimiento') { 
        $verificar_47 = "correcto";
    } elseif ($respuesta_47 === '') {
        $verificar_47 = '';
    } else {
        $verificar_47 = "incorrecto";
    }

    $respuesta_48 = isset($_POST['respuesta_48']) ? $_POST['respuesta_48'] : '';
    if ($respuesta_48 === 'disponibilidad') { 
        $verificar_48 = "correcto";
    } elseif ($respuesta_48 === '') {
    $verificar_48 = '';
    } else {
        $verificar_48 = "incorrecto";
    }

    $respuesta_49 = isset($_POST['respuesta_49']) ? $_POST['respuesta_49'] : '';
    if ($respuesta_49 === 'sistema') { 
        $verificar_49 = "correcto";
    } elseif ($respuesta_49 === '') {
    $verificar_49 = '';
    } else {
        $verificar_49 = "incorrecto";
    }

    $respuesta_50 = isset($_POST['respuesta_50']) ? $_POST['respuesta_50'] : '';
    if ($respuesta_50 === 'Falso') { 
        $verificar_50 = "correcto";
    } elseif ($respuesta_50 === '') {
    $verificar_50 = '';
    } else {
        $verificar_50 = "incorrecto";
    }

 $respuesta_51 = isset($_POST['respuesta_51']) ? $_POST['respuesta_51'] : '';
if ($respuesta_51 === 'modernos') { 
    $verificar_51 = "correcto";
} elseif ($respuesta_51 === '') {
    $verificar_51 = '';
} else {
    $verificar_51 = "incorrecto";
}

 $respuesta_52 = isset($_POST['respuesta_52']) ? $_POST['respuesta_52'] : '';
if ($respuesta_52 === 'multiprocesamiento simetrico') { 
    $verificar_52 = "correcto";
} elseif ($respuesta_52 === '') {
    $verificar_52 = '';
} else {
    $verificar_52 = "incorrecto";
}

 $respuesta_53 = isset($_POST['respuesta_53']) ? $_POST['respuesta_53'] : '';
if ($respuesta_53 === 'SMP') { 
    $verificar_53 = "correcto";
} elseif ($respuesta_53 === '') {
    $verificar_53 = '';
} else {
    $verificar_53 = "incorrecto";
}

 $respuesta_54 = isset($_POST['respuesta_54']) ? $_POST['respuesta_54'] : '';
if ($respuesta_54 === 'Sistema multicore') { 
    $verificar_54 = "correcto";
} elseif ($respuesta_54 === '') {
    $verificar_54 = '';
} else {
    $verificar_54 = "incorrecto";
}

 $respuesta_55 = isset($_POST['respuesta_55']) ? $_POST['respuesta_55'] : '';
if ($respuesta_55 === 'multinucleo') { 
    $verificar_55 = "correcto";
} elseif ($respuesta_55 === '') {
    $verificar_55 = '';
} else {
    $verificar_55 = "incorrecto";
}


 $respuesta_56 = isset($_POST['respuesta_56']) ? $_POST['respuesta_56'] : '';
if ($respuesta_56 === 'nucleos') { 
    $verificar_56 = "correcto";
} elseif ($respuesta_56 === '') {
    $verificar_56 = '';
} else {
    $verificar_56 = "incorrecto";
}

 $respuesta_57 = isset($_POST['respuesta_57']) ? $_POST['respuesta_57'] : '';
if ($respuesta_57 === 'mismo procesador') { 
    $verificar_57 = "correcto";
} elseif ($respuesta_57 === '') {
    $verificar_57 = '';
} else {
    $verificar_57 = "incorrecto";
}

 $respuesta_58 = isset($_POST['respuesta_58']) ? $_POST['respuesta_58'] : '';
if ($respuesta_58 === 'computadores independientes') { 
    $verificar_58 = "correcto";
} elseif ($respuesta_58 === '') {
    $verificar_58 = '';
} else {
    $verificar_58 = "incorrecto";
}

 $respuesta_59 = isset($_POST['respuesta_59']) ? $_POST['respuesta_59'] : '';
if ($respuesta_59 === 'una red') { 
    $verificar_59 = "correcto";
} elseif ($respuesta_59 === '') {
    $verificar_59 = '';
} else {
    $verificar_59 = "incorrecto";
}

 $respuesta_60 = isset($_POST['respuesta_60']) ? $_POST['respuesta_60'] : '';
if ($respuesta_60 === 'proceso') { 
    $verificar_60 = "correcto";
} elseif ($respuesta_60 === '') {
    $verificar_60 = '';
} else {
    $verificar_60 = "incorrecto";
}

 $respuesta_61 = isset($_POST['respuesta_61']) ? $_POST['respuesta_61'] : '';
if ($respuesta_61 === 'esperando') { 
    $verificar_61 = "correcto";
} elseif ($respuesta_61 === '') {
    $verificar_61 = '';
} else {
    $verificar_61 = "incorrecto";
}

 $respuesta_62 = isset($_POST['respuesta_62']) ? $_POST['respuesta_62'] : '';
if ($respuesta_62 === 'ejecuta') { 
    $verificar_62 = "correcto";
} elseif ($respuesta_62 === '') {
    $verificar_62 = '';
} else {
    $verificar_62 = "incorrecto";
}

 $respuesta_63 = isset($_POST['respuesta_63']) ? $_POST['respuesta_63'] : '';
if ($respuesta_63 === 'la CPU') { 
    $verificar_63 = "correcto";
} elseif ($respuesta_63 === '') {
    $verificar_63 = '';
} else {
    $verificar_63 = "incorrecto";
}

 $respuesta_64 = isset($_POST['respuesta_64']) ? $_POST['respuesta_64'] : '';
if ($respuesta_64 === 'desocupada') { 
    $verificar_64 = "correcto";
} elseif ($respuesta_64 === '') {
    $verificar_64 = '';
} else {
    $verificar_64 = "incorrecto";
}

 $respuesta_65 = isset($_POST['respuesta_65']) ? $_POST['respuesta_65'] : '';
if ($respuesta_65 === 'Proceso'
|| $respuesta_65 === 'proceso'
) { 
    $verificar_65 = "correcto";
} elseif ($respuesta_65 === '') {
    $verificar_65 = '';
} else {
    $verificar_65 = "incorrecto";
}

 $respuesta_66 = isset($_POST['respuesta_66']) ? $_POST['respuesta_66'] : '';
if ($respuesta_66 === 'planificador') { 
    $verificar_66 = "correcto";
} elseif ($respuesta_66 === '') {
    $verificar_66 = '';
} else {
    $verificar_66 = "incorrecto";
}

 $respuesta_67 = isset($_POST['respuesta_67']) ? $_POST['respuesta_67'] : '';
if ($respuesta_67 === 'scheduler') { 
    $verificar_67 = "correcto";
} elseif ($respuesta_67 === '') {
    $verificar_67 = '';
} else {
    $verificar_67 = "incorrecto";
}

 $respuesta_68 = isset($_POST['respuesta_68']) ? $_POST['respuesta_68'] : '';
if ($respuesta_68 === 'Modo usuario') { 
    $verificar_68 = "correcto";
} elseif ($respuesta_68 === '') {
    $verificar_68 = '';
} else {
    $verificar_68 = "incorrecto";
}

 $respuesta_69 = isset($_POST['respuesta_69']) ? $_POST['respuesta_69'] : '';
if ($respuesta_69 === 'Modo supervisor') { 
    $verificar_69 = "correcto";
} elseif ($respuesta_69 === '') {
    $verificar_69 = '';
} else {
    $verificar_69 = "incorrecto";
}

 $respuesta_70 = isset($_POST['respuesta_70']) ? $_POST['respuesta_70'] : '';
if ($respuesta_70 === 'modo kernel') { 
    $verificar_70 = "correcto";
} elseif ($respuesta_70 === '') {
    $verificar_70 = '';
} else {
    $verificar_70 = "incorrecto";
}

 $respuesta_71 = isset($_POST['respuesta_71']) ? $_POST['respuesta_71'] : '';
if ($respuesta_71 === 'Modo supervisor/kernel') { 
    $verificar_71 = "correcto";
} elseif ($respuesta_71 === '') {
    $verificar_71 = '';
} else {
    $verificar_71 = "incorrecto";
}

 $respuesta_72 = isset($_POST['respuesta_72']) ? $_POST['respuesta_72'] : '';
if ($respuesta_72 === 'Modo supervisor/kernel') { 
    $verificar_72 = "correcto";
} elseif ($respuesta_72 === '') {
    $verificar_72 = '';
} else {
    $verificar_72 = "incorrecto";
}

 $respuesta_73 = isset($_POST['respuesta_73']) ? $_POST['respuesta_73'] : '';
if ($respuesta_73 === 'Modo usuario') { 
    $verificar_73 = "correcto";
} elseif ($respuesta_73 === '') {
    $verificar_73 = '';
} else {
    $verificar_73 = "incorrecto";
}

 $respuesta_74 = isset($_POST['respuesta_74']) ? $_POST['respuesta_74'] : '';
if ($respuesta_74 === 'Asignar memoria a los procesos') { 
    $verificar_74 = "correcto";
} elseif ($respuesta_74 === '') {
    $verificar_74 = '';
} else {
    $verificar_74 = "incorrecto";
}

 $respuesta_75 = isset($_POST['respuesta_75']) ? $_POST['respuesta_75'] : '';
if ($respuesta_75 === 'Liberar memoria cuando deja de utilizarse') { 
    $verificar_75 = "correcto";
} elseif ($respuesta_75 === '') {
    $verificar_75 = '';
} else {
    $verificar_75 = "incorrecto";
}

 $respuesta_76 = isset($_POST['respuesta_76']) ? $_POST['respuesta_76'] : '';
if ($respuesta_76 === 'Administrar memoria virtual') { 
    $verificar_76 = "correcto";
} elseif ($respuesta_76 === '') {
    $verificar_76 = '';
} else {
    $verificar_76 = "incorrecto";
}

 $respuesta_77 = isset($_POST['respuesta_77']) ? $_POST['respuesta_77'] : '';
if ($respuesta_77 === 'Verdadero') { 
    $verificar_77 = "correcto";
} elseif ($respuesta_77 === '') {
    $verificar_77 = '';
} else {
    $verificar_77 = "incorrecto";
}

 $respuesta_78 = isset($_POST['respuesta_78']) ? $_POST['respuesta_78'] : '';
if ($respuesta_78 === 'archivos') { 
    $verificar_78 = "correcto";
} elseif ($respuesta_78 === '') {
    $verificar_78 = '';
} else {
    $verificar_78 = "incorrecto";
}

 $respuesta_79 = isset($_POST['respuesta_79']) ? $_POST['respuesta_79'] : '';
if ($respuesta_79 === 'carpetas') { 
    $verificar_79 = "correcto";
} elseif ($respuesta_79 === '') {
    $verificar_79 = '';
} else {
    $verificar_79 = "incorrecto";
}

 $respuesta_80 = isset($_POST['respuesta_80']) ? $_POST['respuesta_80'] : '';
if ($respuesta_80 === 'Crear') { 
    $verificar_80 = "correcto";
} elseif ($respuesta_80 === '') {
    $verificar_80 = '';
} else {
    $verificar_80 = "incorrecto";
}

 $respuesta_81 = isset($_POST['respuesta_81']) ? $_POST['respuesta_81'] : '';
if ($respuesta_81 === 'eliminar') { 
    $verificar_81 = "correcto";
} elseif ($respuesta_81 === '') {
    $verificar_81 = '';
} else {
    $verificar_81 = "incorrecto";
}

    $respuesta_82 = isset($_POST['respuesta_82']) ? $_POST['respuesta_82'] : '';
    if ($respuesta_82 === 'Leer') { 
        $verificar_82 = "correcto";
    } elseif ($respuesta_82 === '') {
        $verificar_82 = '';
    } else {
        $verificar_82 = "incorrecto";
    }

    $respuesta_83 = isset($_POST['respuesta_83']) ? $_POST['respuesta_83'] : '';
    if ($respuesta_83 === 'escribir') { 
       $verificar_83 = "correcto";
    } elseif ($respuesta_83 === '') {
        $verificar_83 = '';
    } else {
        $verificar_83 = "incorrecto";
    }

    $respuesta_84 = isset($_POST['respuesta_84']) ? $_POST['respuesta_84'] : '';
    if ($respuesta_84 === 'espacio libre') { 
        $verificar_84 = "correcto";
    } elseif ($respuesta_84 === '') {
        $verificar_84 = '';
    } else {
        $verificar_84 = "incorrecto";
    }

    $respuesta_85 = isset($_POST['respuesta_85']) ? $_POST['respuesta_85'] : '';
    if ($respuesta_85 === 'lecturas') { 
        $verificar_85 = "correcto";
    } elseif ($respuesta_85 === '') {
        $verificar_85 = '';
    } else {
        $verificar_85 = "incorrecto";
    }

    $respuesta_86 = isset($_POST['respuesta_86']) ? $_POST['respuesta_86'] : '';
    if ($respuesta_86 === 'escrituras') { 
        $verificar_86 = "correcto";
    } elseif ($respuesta_86 === '') {
        $verificar_86 = '';
    } else {
        $verificar_86 = "incorrecto";
    }

    $respuesta_87 = isset($_POST['respuesta_87']) ? $_POST['respuesta_87'] : '';
    if ($respuesta_87 === 'particiones') { 
        $verificar_87 = "correcto";
    } elseif ($respuesta_87 === '') {
        $verificar_87 = '';
    } else {
        $verificar_87 = "incorrecto";
    }

    $respuesta_88 = isset($_POST['respuesta_88']) ? $_POST['respuesta_88'] : '';
    if ($respuesta_88 === 'permisos') { 
        $verificar_88 = "correcto";
    } elseif ($respuesta_88 === '') {
        $verificar_88 = '';
    } else {
        $verificar_88 = "incorrecto";
    }

 $respuesta_89 = isset($_POST['respuesta_89']) ? $_POST['respuesta_89'] : '';
if ($respuesta_89 === 'Registros') { 
    $verificar_89 = "correcto";
} elseif ($respuesta_89 === '') {
    $verificar_89 = '';
} else {
    $verificar_89 = "incorrecto";
}

 $respuesta_90 = isset($_POST['respuesta_90']) ? $_POST['respuesta_90'] : '';
if ($respuesta_90 === 'Cache') { 
    $verificar_90 = "correcto";
} elseif ($respuesta_90 === '') {
    $verificar_90 = '';
} else {
    $verificar_90 = "incorrecto";
}

 $respuesta_91 = isset($_POST['respuesta_91']) ? $_POST['respuesta_91'] : '';
if ($respuesta_91 === 'Memoria principal') { 
    $verificar_91 = "correcto";
} elseif ($respuesta_91 === '') {
    $verificar_91 = '';
} else {
    $verificar_91 = "incorrecto";
}

 $respuesta_92 = isset($_POST['respuesta_92']) ? $_POST['respuesta_92'] : '';
if ($respuesta_92 === 'RAM') { 
    $verificar_92 = "correcto";
} elseif ($respuesta_92 === '') {
    $verificar_92 = '';
} else {
    $verificar_92 = "incorrecto";
}

 $respuesta_93 = isset($_POST['respuesta_93']) ? $_POST['respuesta_93'] : '';
if ($respuesta_93 === 'SSD') { 
    $verificar_93 = "correcto";
} elseif ($respuesta_93 === '') {
    $verificar_93 = '';
} else {
    $verificar_93 = "incorrecto";
}

 $respuesta_94 = isset($_POST['respuesta_94']) ? $_POST['respuesta_94'] : '';
if ($respuesta_94 === 'Disco magnetico') { 
    $verificar_94 = "correcto";
} elseif ($respuesta_94 === '') {
    $verificar_94 = '';
} else {
    $verificar_94 = "incorrecto";
}

 $respuesta_95 = isset($_POST['respuesta_95']) ? $_POST['respuesta_95'] : '';
if ($respuesta_95 === 'HDD') { 
    $verificar_95 = "correcto";
} elseif ($respuesta_95 === '') {
    $verificar_95 = '';
} else {
    $verificar_95 = "incorrecto";
}

 $respuesta_96 = isset($_POST['respuesta_96']) ? $_POST['respuesta_96'] : '';
if ($respuesta_96 === '189') { 
    $verificar_96 = "correcto";
} elseif ($respuesta_96 === '') {
    $verificar_96 = '';
} else {
    $verificar_96 = "incorrecto";
}

 $respuesta_97 = isset($_POST['respuesta_97']) ? $_POST['respuesta_97'] : '';
if ($respuesta_97 === '210') { 
    $verificar_97 = "correcto";
} elseif ($respuesta_97 === '') {
    $verificar_97 = '';
} else {
    $verificar_97 = "incorrecto";
}

 $respuesta_98 = isset($_POST['respuesta_98']) ? $_POST['respuesta_98'] : '';
if ($respuesta_98 === '231') { 
    $verificar_98 = "correcto";
} elseif ($respuesta_98 === '') {
    $verificar_98 = '';
} else {
    $verificar_98 = "incorrecto";
}

 $respuesta_99 = isset($_POST['respuesta_99']) ? $_POST['respuesta_99'] : '';
if ($respuesta_99 === '252') { 
    $verificar_99 = "correcto";
} elseif ($respuesta_99 === '') {
    $verificar_99 = '';
} else {
    $verificar_99 = "incorrecto";
}


 $respuesta_100 = isset($_POST['respuesta_100']) ? $_POST['respuesta_100'] : '';
if ($respuesta_100 === '44') { 
    $verificar_100 = "correcto";
} elseif ($respuesta_100 === '') {
    $verificar_100 = '';
} else {
    $verificar_100 = "incorrecto";
}

 $respuesta_101 = isset($_POST['respuesta_101']) ? $_POST['respuesta_101'] : '';
if ($respuesta_101 === '66') { 
    $verificar_101 = "correcto";
} elseif ($respuesta_101 === '') {
    $verificar_101 = '';
} else {
    $verificar_101 = "incorrecto";
}

 $respuesta_102 = isset($_POST['respuesta_102']) ? $_POST['respuesta_102'] : '';
if ($respuesta_102 === '88') { 
    $verificar_102 = "correcto";
} elseif ($respuesta_102 === '') {
    $verificar_102 = '';
} else {
    $verificar_102 = "incorrecto";
}

 $respuesta_103 = isset($_POST['respuesta_103']) ? $_POST['respuesta_103'] : '';
if ($respuesta_103 === '110') { 
    $verificar_103 = "correcto";
} elseif ($respuesta_103 === '') {
    $verificar_103 = '';
} else {
    $verificar_103 = "incorrecto";
}

 $respuesta_104 = isset($_POST['respuesta_104']) ? $_POST['respuesta_104'] : '';
if ($respuesta_104 === '132') { 
    $verificar_104 = "correcto";
} elseif ($respuesta_104 === '') {
    $verificar_104 = '';
} else {
    $verificar_104 = "incorrecto";
}

 $respuesta_105 = isset($_POST['respuesta_105']) ? $_POST['respuesta_105'] : '';
if ($respuesta_105 === '154') { 
    $verificar_105 = "correcto";
} elseif ($respuesta_105 === '') {
    $verificar_105 = '';
} else {
    $verificar_105 = "incorrecto";
}

 $respuesta_106 = isset($_POST['respuesta_106']) ? $_POST['respuesta_106'] : '';
if ($respuesta_106 === '176') { 
    $verificar_106 = "correcto";
} elseif ($respuesta_106 === '') {
    $verificar_106 = '';
} else {
    $verificar_106 = "incorrecto";
}

 $respuesta_107 = isset($_POST['respuesta_107']) ? $_POST['respuesta_107'] : '';
if ($respuesta_107 === '198') { 
    $verificar_107 = "correcto";
} elseif ($respuesta_107 === '') {
    $verificar_107 = '';
} else {
    $verificar_107 = "incorrecto";
}

 $respuesta_108 = isset($_POST['respuesta_108']) ? $_POST['respuesta_108'] : '';
if ($respuesta_108 === '220') { 
    $verificar_108 = "correcto";
} elseif ($respuesta_108 === '') {
    $verificar_108 = '';
} else {
    $verificar_108 = "incorrecto";
}

 $respuesta_109 = isset($_POST['respuesta_109']) ? $_POST['respuesta_109'] : '';
if ($respuesta_109 === '242') { 
    $verificar_109 = "correcto";
} elseif ($respuesta_109 === '') {
    $verificar_109 = '';
} else {
    $verificar_109 = "incorrecto";
}

 $respuesta_110 = isset($_POST['respuesta_110']) ? $_POST['respuesta_110'] : '';
if ($respuesta_110 === '264') { 
    $verificar_110 = "correcto";
} elseif ($respuesta_110 === '') {
    $verificar_110 = '';
} else {
    $verificar_110 = "incorrecto";
}

// Tabla del 12
$respuesta_111 = isset($_POST['respuesta_111']) ? $_POST['respuesta_111'] : '';
if ($respuesta_111 === '24') {  
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
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style_2_0.css">
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

 <h3>1.1. ¿Cuáles son los cuatro componentes de un sistema de cómputo?</h3>

<ul>
    <li>
    <input type="text" name="respuesta_1" value="<?php echo $respuesta_1; ?>" size="8">    
     </li>
    <li>
    <input type="text" name="respuesta_2" value="<?php echo $respuesta_2; ?>" size="16">    
     </li>
    <li>
    <input type="text" name="respuesta_3" value="<?php echo $respuesta_3; ?>" size="20">    
     </li>
    <li>
    <input type="text" name="respuesta_4" value="<?php echo $respuesta_4; ?>" size="8">    
     </li>
</ul>

    <button type="submit">Enviar</button>
    <?php echo $verificar_1 ?>
    <?php echo $verificar_2 ?>
    <?php echo $verificar_3 ?>
    <?php echo $verificar_4 ?>
<hr>
<h3>1.2. Mencione al menos tres recursos que el sistema operativo asigna.</h3>

<ul>
    <li>
    <input type="text" name="respuesta_5" value="<?php echo $respuesta_5; ?>" size="8">    
      (
    <input type="text" name="respuesta_6" value="<?php echo $respuesta_6; ?>" size="8">    
     )</li>
    <li>
    <input type="text" name="respuesta_7" value="<?php echo $respuesta_7; ?>" size="11">    
     </li>
    <li>
    <input type="text" name="respuesta_8" value="<?php echo $respuesta_8; ?>" size="26">    
     </li>
    <li>
    <input type="text" name="respuesta_9" value="<?php echo $respuesta_9; ?>" size="14">    
      (
    <input type="text" name="respuesta_10" value="<?php echo $respuesta_10; ?>" size="8">    
     )</li>
</ul>
       <button type="submit">Enviar</button>
<?php echo $verificar_5 ?>
    <?php echo $verificar_6 ?>
    <?php echo $verificar_7 ?>  
    <?php echo $verificar_8 ?>
    <?php echo $verificar_9 ?>
    <?php echo $verificar_10 ?>

    <hr>

    <h3>
    1.3. ¿Cuál es el nombre común que se emplea para referirse al programa principal del sistema operativo?
    </h3>
    <input type="text" name="respuesta_11" value="<?php echo $respuesta_11; ?>" size="8"> 
      o 
    <input type="text" name="respuesta_12" value="<?php echo $respuesta_12; ?>" size="8"> 
      del 
    <input type="text" name="respuesta_13" value="<?php echo $respuesta_13; ?>" size="14"> 
     .

     <br><br>
    <button type="submit">Enviar</button>
    <?php echo $verificar_11 ?> 
    <?php echo $verificar_12 ?>
    <?php echo $verificar_13 ?>
    <hr>

    <h3>1.4. ¿Qué incluyen generalmente los sistemas operativos móviles, además del núcleo del sistema operativo?</h3>

<p>
    Incluyen 
    <input type="text" name="respuesta_14" value="<?php echo $respuesta_14; ?>" size="8">
      y 
    <input type="text" name="respuesta_15" value="<?php echo $respuesta_15; ?>" size="8">
      del 
    <input type="text" name="respuesta_16" value="<?php echo $respuesta_16; ?>" size="8">
      que permiten administrar funciones del dispositivo como:
</p>

<ul>
    <li>Llamadas</li>
    <li>GPS</li>
    <li>Cámara</li>
    <li>Sensores</li>
    <li>Conectividad</li>
</ul>
    <button type="submit">Enviar</button>
    <?php echo $verificar_14 ?>
    <?php echo $verificar_15 ?>
    <?php echo $verificar_16 ?>
    <hr>

    <p>
    El Polling es un método de comunicación en el que la CPU consulta 
    <input type="text" name="respuesta_17" value="<?php echo $respuesta_17; ?>" size="11">
      a los 
    dispositivos de entrada y salida para saber si tienen información o necesitan atención.
    </p>
    <button type="submit">Enviar</button>
    <?php echo $verificar_17 ?>
    <hr>
<h3>1.5. ¿Qué es una interrupción?</h3>

<p>
    Es una 
    <input type="text" name="respuesta_18" value="<?php echo $respuesta_18; ?>" size="8">
      enviada al procesador por un 
    <input type="text" name="respuesta_19" value="<?php echo $respuesta_19; ?>" size="8">
      o programa para avisarle que necesita 
    <input type="text" name="respuesta_20" value="<?php echo $respuesta_20; ?>" size="8">
     .
</p>

<p>
    <strong>Ejemplo:</strong> el teclado envía una interrupción al procesador cuando se presiona una tecla.
</p>

    <button type="submit">Enviar</button>
    <?php echo $verificar_18 ?>
    <?php echo $verificar_19 ?> 
    <?php echo $verificar_20 ?>
    <hr>

    <h3>1.6. ¿Cuál es el mecanismo de disparo de una interrupción?</h3>

<p>
    El dispositivo 
    <input type="text" name="respuesta_21" value="<?php echo $respuesta_21; ?>" size="8">
      una señal eléctrica al 
    <input type="text" name="respuesta_22" value="<?php echo $respuesta_22; ?>" size="8">
      indicando que ocurrió un 
    <input type="text" name="respuesta_23" value="<?php echo $respuesta_23; ?>" size="8">
     .
</p>
    <button type="submit">Enviar</button>
    <?php echo $verificar_21 ?>
    <?php echo $verificar_22 ?>
    <?php echo $verificar_23 ?>
    <hr>

    <h3>1.7. ¿Cuál es una ventaja de emplear una unidad de estado sólido en lugar de un disco magnético?</h3>

<p>
    Una SSD es más 
    <input type="text" name="respuesta_24" value="<?php echo $respuesta_24; ?>" size="8">
      porque utiliza 
    <input type="text" name="respuesta_25" value="<?php echo $respuesta_25; ?>" size="15">
      y no 
    <input type="text" name="respuesta_26" value="<?php echo $respuesta_26; ?>" size="12">
     .
</p>

<p><strong>Ventajas:</strong></p>

<ul>
    <li>Menor 
    <input type="text" name="respuesta_27" value="<?php echo $respuesta_27; ?>" size="8">    
      de 
    <input type="text" name="respuesta_28" value="<?php echo $respuesta_28; ?>" size="8">
     </li>
    <li>Mayor 
    <input type="text" name="respuesta_29" value="<?php echo $respuesta_29; ?>" size="8">    
      de 
    <input type="text" name="respuesta_30" value="<?php echo $respuesta_30; ?>" size="12">
     </li>
    <li>Menor 
    <input type="text" name="respuesta_31" value="<?php echo $respuesta_31; ?>" size="8">    
      de 
    <input type="text" name="respuesta_32" value="<?php echo $respuesta_32; ?>" size="8">
     </li>
</ul>

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
    <hr>

    <h4>1.8. ¿Cuál es la diferencia entre almacenamiento volátil y no volátil?</h4>

<p><strong>Almacenamiento volátil:</strong> 
<input type="text" name="respuesta_33" value="<?php echo $respuesta_33; ?>" size="8">
  la 
<input type="text" name="respuesta_34" value="<?php echo $respuesta_34; ?>" size="8">
  cuando se 
<input type="text" name="respuesta_35" value="<?php echo $respuesta_35; ?>" size="8">
  el 
<input type="text" name="respuesta_36" value="<?php echo $respuesta_36; ?>" size="8">
 .</p>

<p>
  <strong>Ejemplo:</strong> 
  <input type="text" name="respuesta_37" value="<?php echo $respuesta_37; ?>" size="8">
   .
</p>

<p><strong>Almacenamiento no volátil:</strong> 
<input type="text" name="respuesta_38" value="<?php echo $respuesta_38; ?>" size="8">
  la información aunque se 
<input type="text" name="respuesta_39" value="<?php echo $respuesta_39; ?>" size="8">
  el computador.</p>

<p>
  <strong>Ejemplos:</strong> 
  <input type="text" name="respuesta_40" value="<?php echo $respuesta_40; ?>" size="8">
   , 
  <input type="text" name="respuesta_41" value="<?php echo $respuesta_41; ?>" size="8">
   , 
  <input type="text" name="respuesta_42" value="<?php echo $respuesta_42; ?>" size="8">
   .
</p>
       
    <button type="submit">Enviar</button>
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
    <h4>1.9. Mencione al menos dos ventajas de los sistemas multiprocesador</h4>

    <ul>
    <li>Mayor 
    <input type="text" name="respuesta_43" value="<?php echo $respuesta_43; ?>" size="8">    
      de 
    <input type="text" name="respuesta_44" value="<?php echo $respuesta_44; ?>" size="12">
     .</li>
    <li>Permiten 
    <input type="text" name="respuesta_45" value="<?php echo $respuesta_45; ?>" size="8">    
      varias 
    <input type="text" name="respuesta_46" value="<?php echo $respuesta_46; ?>" size="19">
     .</li>
    <li>Mejor 
    <input type="text" name="respuesta_47" value="<?php echo $respuesta_47; ?>" size="8">    
     .</li>
    <li>Mayor 
    <input type="text" name="respuesta_48" value="<?php echo $respuesta_48; ?>" size="10">    
      del 
    <input type="text" name="respuesta_49" value="<?php echo $respuesta_49; ?>" size="8">
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
    <hr>
</div>




<div class="seccion derecha">
    
  
    <h4>1.10. (Verdadero o falso) El sistema multiprocesador más común emplea multiprocesamiento asimétrico</h4>

<p><strong>
<input type="text" name="respuesta_50" value="<?php echo $respuesta_50; ?>" size="8">    
 .</strong></p>

<p>
  Los sistemas 
  <input type="text" name="respuesta_51" value="<?php echo $respuesta_51; ?>" size="8">
    utilizan principalmente 
  <strong>
  <input type="text" name="respuesta_52" value="<?php echo $respuesta_52; ?>" size="25">  
    (
  <input type="text" name="respuesta_53" value="<?php echo $respuesta_53; ?>" size="3">  
   ).</strong>
</p>


    <button type="submit">Enviar</button>
    <?php echo $verificar_50 ?>
    <?php echo $verificar_51 ?>
    <?php echo $verificar_52 ?>
    <?php echo $verificar_53 ?>
    <hr>
    <h4>1.11. ¿Cuál es el nombre de un sistema multiprocesador que emplea múltiples núcleos de computación?</h4>

    <p>
    <strong>
    <input type="text" name="respuesta_54" value="<?php echo $respuesta_54; ?>" size="15">    
      o 
    <input type="text" name="respuesta_55" value="<?php echo $respuesta_55; ?>" size="8">
     .</strong>
    </p>

    <button type="submit">Enviar</button>
    <?php echo $verificar_54 ?>
    <?php echo $verificar_55 ?>
    <hr>
<h4>1.12. ¿Cómo difiere un sistema en clúster de un sistema multinúcleo?</h4>

<p>
  Un <strong> 
  sistema multinúcleo</strong> tiene varios 
  <input type="text" name="respuesta_56" value="<?php echo $respuesta_56; ?>" size="8">
    dentro de un 
  <input type="text" name="respuesta_57" value="<?php echo $respuesta_57; ?>" size="16">
   .
</p>

<p>
  Un <strong>sistema en clúster</strong> tiene varios 
  <input type="text" name="respuesta_58" value="<?php echo $respuesta_58; ?>" size="25">
    conectados mediante 
  <input type="text" name="respuesta_59" value="<?php echo $respuesta_59; ?>" size="8">
   .
</p>

    <button type="submit">Enviar</button>
    <?php echo $verificar_56 ?>
    <?php echo $verificar_57 ?>
    <?php echo $verificar_58 ?>
    <?php echo $verificar_59 ?>
    <hr>
    <h4>1.13. ¿Cómo incrementa la multiprogramación el uso de la CPU?</h4>

<p>
  Cuando un 
   <input type="text" name="respuesta_60" value="<?php echo $respuesta_60; ?>" size="8">
    queda 
   <input type="text" name="respuesta_61" value="<?php echo $respuesta_61; ?>" size="8">
    (por ejemplo, entrada/salida), el sistema operativo 
   <input type="text" name="respuesta_62" value="<?php echo $respuesta_62; ?>" size="8">
    otro proceso para que 
   <input type="text" name="respuesta_63" value="<?php echo $respuesta_63; ?>" size="8">
    no quede 
   <input type="text" name="respuesta_64" value="<?php echo $respuesta_64; ?>" size="8">
   .
</p>
    <button type="submit">Enviar</button>
    <?php echo $verificar_60 ?>
    <?php echo $verificar_61 ?>
    <?php echo $verificar_62 ?>
    <?php echo $verificar_63 ?>
    <?php echo $verificar_64 ?>
    <hr>
    <h4>1.14. ¿Cómo se denomina un programa que ha sido cargado y se está ejecutando?</h4>

<p>
  <strong>
  <input type="text" name="respuesta_65" value="<?php echo $respuesta_65; ?>" size="8">  
   .</strong>
</p>

    <button type="submit">Enviar</button>
    <?php echo $verificar_65 ?>
    <hr>

<h4>1.15. ¿Cuál parte del sistema operativo toma la decisión de qué trabajo va a ejecutarse?</h4>

<p>
  El <strong>
  <input type="text" name="respuesta_66" value="<?php echo $respuesta_66; ?>" size="8">  
    (
  <input type="text" name="respuesta_67" value="<?php echo $respuesta_67; ?>" size="8">  
   )</strong> del sistema operativo.
</p>

    <button type="submit">Enviar</button>
<?php echo $verificar_66 ?>

    <?php echo $verificar_67 ?>

    <hr>
<h4>1.16. ¿Cuáles son los dos modos de operación de un sistema operativo?</h4>

<ol>
  <li>
  <input type="text" name="respuesta_68" value="<?php echo $respuesta_68; ?>" size="11">  
   .</li>
  <li>
  <input type="text" name="respuesta_69" value="<?php echo $respuesta_69; ?>" size="12">  
    o 
  <input type="text" name="respuesta_70" value="<?php echo $respuesta_70; ?>" size="11">
   .</li>
</ol>

    <button type="submit">Enviar</button>
<?php echo $verificar_68 ?>
<?php echo $verificar_69 ?>
<?php echo $verificar_70 ?>

    <hr>

    <h4>1.17. ¿Cuál es el modo del sistema en el momento del arranque (boot)?</h4>

<p>
  <strong>
  <input type="text" name="respuesta_71" value="<?php echo $respuesta_71; ?>" size="25">  
   .</strong>
</p>

    <button type="submit">Enviar</button>
<?php echo $verificar_71 ?>
    <hr>
 
<h4>1.18. ¿Cuál es el modo del sistema cuando el sistema operativo obtiene el control?</h4>

<p>
  <strong>
  <input type="text" name="respuesta_72" value="<?php echo $respuesta_72; ?>" size="25">  
   .</strong>
</p>

<h4>1.19. ¿Cuál es el modo del sistema cuando se está ejecutando un programa de usuario?</h4>

<p>
  <strong>
  <input type="text" name="respuesta_73" value="<?php echo $respuesta_73; ?>" size="25">  
   .</strong>
</p>

<button type="submit">Enviar</button>
<?php echo $verificar_72 ?>
<?php echo $verificar_73 ?>
<hr>
<h4>1.20. Mencione al menos dos actividades que realiza el sistema operativo con relación a la gestión de memoria</h4>

<ul>
  <li>
  <input type="text" name="respuesta_74" value="<?php echo $respuesta_74; ?>" size="31">  
   .</li>
  <li>
  <input type="text" name="respuesta_75" value="<?php echo $respuesta_75; ?>" size="37">  
   .</li>
  <li>
  <input type="text" name="respuesta_76" value="<?php echo $respuesta_76; ?>" size="31">  
   .</li>
</ul>

<h4>1.21. (Verdadero o falso) La gestión de archivos es uno de los aspectos más visibles de un sistema operativo</h4>

<p>
  <strong>
  <input type="text" name="respuesta_77" value="<?php echo $respuesta_77; ?>" size="8">  
   .</strong>
</p>

<p>
  Los usuarios interactúan constantemente con 
  <input type="text" name="respuesta_78" value="<?php echo $respuesta_78; ?>" size="8">
    y 
  <input type="text" name="respuesta_79" value="<?php echo $respuesta_79; ?>" size="8">
   .
</p>

<button type="submit">Enviar</button>
<?php echo $verificar_74 ?>
<?php echo $verificar_75 ?>
<?php echo $verificar_76 ?>
<?php echo $verificar_77 ?>
<?php echo $verificar_78 ?>
<?php echo $verificar_79 ?>
<hr>
<h4>1.22. Mencione al menos dos actividades que realiza el sistema operativo con relación a la gestión de archivos</h4>

<ul>
  <li>
  <input type="text" name="respuesta_80" value="<?php echo $respuesta_80; ?>" size="8">  
    y 
  <input type="text" name="respuesta_81" value="<?php echo $respuesta_81; ?>" size="8">
    archivos.</li>
  <li>
  <input type="text" name="respuesta_82" value="<?php echo $respuesta_82; ?>" size="8">  
    y 
  <input type="text" name="respuesta_83" value="<?php echo $respuesta_83; ?>" size="8">
    archivos.</li>
  <li>Crear y administrar directorios.</li>
</ul>

<h4>1.23. Mencione al menos dos actividades que realiza el sistema operativo con relación a la gestión de los discos</h4>

<ul>
  <li>Administrar 
  <input type="text" name="respuesta_84" value="<?php echo $respuesta_84; ?>" size="12">  
   .</li>
  <li>Planificar 
  <input type="text" name="respuesta_85" value="<?php echo $respuesta_85; ?>" size="8">  
    y 
  <input type="text" name="respuesta_86" value="<?php echo $respuesta_86; ?>" size="8">
   .</li>
  <li>Crear 
  <input type="text" name="respuesta_87" value="<?php echo $respuesta_87; ?>" size="8">  
   .</li>
  <li>Controlar 
  <input type="text" name="respuesta_88" value="<?php echo $respuesta_88; ?>" size="8">  
   .</li>
</ul>

<h4>1.24. Ordene los medios de almacenamiento del más rápido al más lento</h4>

<p>
  <strong>
  <input type="text" name="respuesta_89" value="<?php echo $respuesta_89; ?>" size="8">  
    → 
  <input type="text" name="respuesta_90" value="<?php echo $respuesta_90; ?>" size="8">
    → 
  <input type="text" name="respuesta_91" value="<?php echo $respuesta_91; ?>" size="15">
    (
  <input type="text" name="respuesta_92" value="<?php echo $respuesta_92; ?>" size="8">  
   ) → 
  <input type="text" name="respuesta_93" value="<?php echo $respuesta_93; ?>" size="8">
    → 
  <input type="text" name="respuesta_94" value="<?php echo $respuesta_94; ?>" size="12">
    (
  <input type="text" name="respuesta_95" value="<?php echo $respuesta_95; ?>" size="2">  
   )</strong>
</p>

    <button type="submit">Enviar</button>
    <?php echo $verificar_80 ?>
<?php echo $verificar_81 ?>
<?php echo $verificar_82 ?>
<?php echo $verificar_83 ?>
<?php echo $verificar_84 ?>
<?php echo $verificar_85 ?>
<?php echo $verificar_86 ?>
<?php echo $verificar_87 ?>
<?php echo $verificar_88 ?>
<?php echo $verificar_89 ?>
<br><br>
<?php echo $verificar_90 ?>
<?php echo $verificar_91 ?>
<?php echo $verificar_92 ?>
<?php echo $verificar_93 ?>
<?php echo $verificar_94 ?>
<?php echo $verificar_95 ?>
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
