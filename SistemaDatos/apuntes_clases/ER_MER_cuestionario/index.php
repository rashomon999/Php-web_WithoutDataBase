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
 
 
 
        
 $respuesta_1 = 'propiedades';
$respuesta_2 = 'definen';
$respuesta_3 = 'entidad';
$respuesta_4 = 'define';
$respuesta_5 = 'estructura';
$respuesta_6 = 'relacion';
$respuesta_7 = 'representa';
$respuesta_8 = 'nombre';
$respuesta_9 = 'relacion';
$respuesta_10 = 'atributos';
$respuesta_11 = 'representa';
$respuesta_12 = 'fila';
$respuesta_13 = 'relacion';
$respuesta_14 = 'Cada tupla';
$respuesta_15 = 'conjunto';
$respuesta_16 = 'valores';
$respuesta_17 = 'atributos';
$respuesta_18 = 'describen';
$respuesta_19 = 'entidad particular';
$respuesta_20 = 'conjunto';
$respuesta_21 = 'tuplas';
$respuesta_22 = 'relacion';
$respuesta_23 = 'instante particular';
$respuesta_24 = 'tiempo';
$respuesta_25 = 'Puede cambiar';
$respuesta_26 = 'insertan';
$respuesta_27 = 'eliminan';
$respuesta_28 = 'actualizan';
$respuesta_29 = 'numero';
$respuesta_30 = 'atributos';
$respuesta_31 = 'relacion';
$respuesta_32 = 'conoce';
$respuesta_33 = 'grado';
$respuesta_34 = 'relacion';
$respuesta_35 = 'numero';
$respuesta_36 = 'tuplas';
$respuesta_37 = 'relacion';
$respuesta_38 = 'conoce';
$respuesta_39 = 'cardinalidad';
$respuesta_40 = 'desconocido';
$respuesta_41 = 'disponible';
$respuesta_42 = 'columna';
$respuesta_43 = 'conjunto de columnas';
$respuesta_44 = 'identifican';
$respuesta_45 = 'fila';
$respuesta_46 = 'diseñada';
$respuesta_47 = 'imponer';
$respuesta_48 = 'exclusividad';
$respuesta_49 = 'fila';
$respuesta_50 = 'conjunto';
$respuesta_51 = 'atributos';
$respuesta_52 = 'identificar';
$respuesta_53 = 'unica';
$respuesta_54 = 'tupla';
$respuesta_55 = 'relacion';
$respuesta_56 = 'clave secundaria';
$respuesta_57 = 'conjunto';
$respuesta_58 = 'atributos';
$respuesta_59 = 'identificar';
$respuesta_60 = 'unica';
$respuesta_61 = 'tupla';
$respuesta_62 = 'atributo';
$respuesta_63 = 'relacion';
$respuesta_64 = 'referencia';
$respuesta_65 = 'clave primaria';
$respuesta_66 = 'relacion';
$respuesta_67 = 'combinando dos';
$respuesta_68 = 'atributos';
$respuesta_69 = 'manera unica';
$respuesta_70 = 'tupla';
$respuesta_71 = 'conjunto';
$respuesta_72 = 'valores atomicos';
$respuesta_73 = 'atributo';
$respuesta_74 = 'tipo de datos';
$respuesta_75 = 'rango';
$respuesta_76 = 'valores posibles';
$respuesta_77 = 'restricciones';
$respuesta_78 = 'cumplir';
$respuesta_79 = 'valores';
$respuesta_80 = 'atributo';
$respuesta_81 = 'indica';
$respuesta_82 = 'solo algunas ocurrencias';
$respuesta_83 = 'entidad';
$respuesta_84 = 'intervenir';
$respuesta_85 = 'relacion';
$respuesta_86 = 'continua';
$respuesta_87 = 'discontinua';
$respuesta_88 = 'tabla';
$respuesta_89 = 'bidimensional';
$respuesta_90 = 'filas';
$respuesta_91 = 'columnas';
$respuesta_92 = 'comprension';
$respuesta_93 = 'extension';
$respuesta_94 = 'propiedad';
$respuesta_95 = 'numerar';
$respuesta_96 = 'uno por uno';
$respuesta_97 = 'no tienen orden';
$respuesta_98 = 'tupla';
$respuesta_99 = 'repetidas';
$respuesta_100 = 'atributos';
$respuesta_101 = 'atributo';
$respuesta_102 = 'clave';
$respuesta_103 = 'dominio del atributo';
$respuesta_104 = 'atomico';
$respuesta_105 = 'univaluado';
$respuesta_106 = 'compuestos';
$respuesta_107 = 'multivaluados';
$respuesta_108 = 'no es relevante';
$respuesta_109 = 'integridad de entidad';
$respuesta_110 = 'integridad referencial';
$respuesta_111 = 'clave foranea';
$respuesta_112 = 'coincidan';
$respuesta_113 = 'clave primaria';
        // Marcar todas como correctas
    for ($i = 1; $i <= 122; $i++) {
    ${"verificar_$i"} = "correcto";
    }

    } else {
    $respuesta_1 = isset($_POST['respuesta_1']) ? $_POST['respuesta_1'] : '';
   if ($respuesta_1 === 'propiedades') {  
       $verificar_1 = "correcto";
   } elseif ($respuesta_1 === '') {
       $verificar_1 = '';
   } else {
       $verificar_1 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_2 = isset($_POST['respuesta_2']) ? $_POST['respuesta_2'] : '';
   if ($respuesta_2 === 'definen') {  
       $verificar_2 = "correcto";
   } elseif ($respuesta_2 === '') {
       $verificar_2 = '';
   } else {
       $verificar_2 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_3 = isset($_POST['respuesta_3']) ? $_POST['respuesta_3'] : '';
   if ($respuesta_3 === 'entidad') {  
       $verificar_3 = "correcto";
   } elseif ($respuesta_3 === '') {
       $verificar_3 = '';
   } else {
       $verificar_3 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_4 = isset($_POST['respuesta_4']) ? $_POST['respuesta_4'] : '';
   if ($respuesta_4 === 'define') {  
       $verificar_4 = "correcto";
   } elseif ($respuesta_4 === '') {
       $verificar_4 = '';
   } else {
       $verificar_4 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_5 = isset($_POST['respuesta_5']) ? $_POST['respuesta_5'] : '';
   if ($respuesta_5 === 'estructura') {  
       $verificar_5 = "correcto";
   } elseif ($respuesta_5 === '') {
       $verificar_5 = '';
   } else {
       $verificar_5 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_6 = isset($_POST['respuesta_6']) ? $_POST['respuesta_6'] : '';
   if ($respuesta_6 === 'relacion') {  
       $verificar_6 = "correcto";
   } elseif ($respuesta_6 === '') {
       $verificar_6 = '';
   } else {
       $verificar_6 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_7 = isset($_POST['respuesta_7']) ? $_POST['respuesta_7'] : '';
   if ($respuesta_7 === 'representa') {  
       $verificar_7 = "correcto";
   } elseif ($respuesta_7 === '') {
       $verificar_7 = '';
   } else {
       $verificar_7 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_8 = isset($_POST['respuesta_8']) ? $_POST['respuesta_8'] : '';
   if ($respuesta_8 === 'nombre') {  
       $verificar_8 = "correcto";
   } elseif ($respuesta_8 === '') {
       $verificar_8 = '';
   } else {
       $verificar_8 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_9 = isset($_POST['respuesta_9']) ? $_POST['respuesta_9'] : '';
   if ($respuesta_9 === 'relacion') {  
       $verificar_9 = "correcto";
   } elseif ($respuesta_9 === '') {
       $verificar_9 = '';
   } else {
       $verificar_9 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_10 = isset($_POST['respuesta_10']) ? $_POST['respuesta_10'] : '';
   if ($respuesta_10 === 'atributos') {  
       $verificar_10 = "correcto";
   } elseif ($respuesta_10 === '') {
       $verificar_10 = '';
   } else {
       $verificar_10 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_11 = isset($_POST['respuesta_11']) ? $_POST['respuesta_11'] : '';
   if ($respuesta_11 === 'representa') {  
       $verificar_11 = "correcto";
   } elseif ($respuesta_11 === '') {
       $verificar_11 = '';
   } else {
       $verificar_11 = "incorrecto";
   }


    // Verificar la respuesta de la primera pregunta
    $respuesta_12 = isset($_POST['respuesta_12']) ? $_POST['respuesta_12'] : '';
    if ($respuesta_12 === 'fila') {  
        $verificar_12 = "correcto";
    } elseif ($respuesta_12 === '') {
        $verificar_12 = '';
    } else {
        $verificar_12 = "incorrecto";
    }
  
    // Verificar la respuesta de la segunda pregunta
    $respuesta_13 = isset($_POST['respuesta_13']) ? $_POST['respuesta_13'] : '';
    if ($respuesta_13 === 'relacion') { 
        $verificar_13 = "correcto";
    } elseif ($respuesta_13 === '') {
        $verificar_13 = '';
    } else {
         $verificar_13 = "incorrecto";
    }
  
    // Verificar la respuesta de la tercera pregunta
    $respuesta_14 = isset($_POST['respuesta_14']) ? $_POST['respuesta_14'] : '';
    if ($respuesta_14 === 'Cada tupla') {  
        $verificar_14 = "correcto";
    } elseif ($respuesta_14 === '') {
        $verificar_14 = '';
    } else {
        $verificar_14 = "incorrecto";
    }
  
    // Verificar la respuesta de la cuarta pregunta
    $respuesta_15 = isset($_POST['respuesta_15']) ? $_POST['respuesta_15'] : '';
    if ($respuesta_15 === 'conjunto') { 
        $verificar_15 = "correcto";
    } elseif ($respuesta_15 === '') {
        $verificar_15 = '';
    } else {
        $verificar_15 = "incorrecto";
    }
  
    // Verificar la respuesta de la quinta pregunta
    $respuesta_16 = isset($_POST['respuesta_16']) ? $_POST['respuesta_16'] : '';
    if ($respuesta_16 === 'valores') {  
        $verificar_16 = "correcto";
    } elseif ($respuesta_16 === '') {
        $verificar_16 = '';
    } else {
        $verificar_16 = "incorrecto";
    }
  
    // Verificar la respuesta de la sexta pregunta
    $respuesta_17 = isset($_POST['respuesta_17']) ? $_POST['respuesta_17'] : '';
    if ($respuesta_17 === 'atributos') {  
        $verificar_17 = "correcto";
        } elseif ($respuesta_17 === '') {
        $verificar_17 = '';
    } else {
        $verificar_17 = "incorrecto";
    }
  
    // Verificar la respuesta de la séptima pregunta
    $respuesta_18 = isset($_POST['respuesta_18']) ? $_POST['respuesta_18'] : '';
    if ($respuesta_18 === 'describen') {  
        $verificar_18 = "correcto";
    } elseif ($respuesta_18 === '') {
        $verificar_18 = '';
    } else {
        $verificar_18 = "incorrecto";
    }
  
    // Verificar la respuesta de la octava pregunta
    $respuesta_19 = isset($_POST['respuesta_19']) ? $_POST['respuesta_19'] : '';
    if ($respuesta_19 === 'entidad particular') {  
        $verificar_19 = "correcto";
    } elseif ($respuesta_19 === '') {
        $verificar_19 = '';
    } else {
        $verificar_19 = "incorrecto";
    }
  
    // Verificar la respuesta de la novena pregunta
    $respuesta_20 = isset($_POST['respuesta_20']) ? $_POST['respuesta_20'] : '';
    if ($respuesta_20 === 'conjunto') {  
        $verificar_20 = "correcto";
    } elseif ($respuesta_20 === '') {
        $verificar_20 = '';
    } else {
        $verificar_20 = "incorrecto";
    }
  
    // Verificar la respuesta de la décima pregunta
    $respuesta_21 = isset($_POST['respuesta_21']) ? $_POST['respuesta_21'] : '';
    if ($respuesta_21 === 'tuplas') {  
         $verificar_21 = "correcto";
    } elseif ($respuesta_21 === '') {
        $verificar_21 = '';
    } else {
        $verificar_21 = "incorrecto";
    }
  
    // Verificar la respuesta de la undécima pregunta
    $respuesta_22 = isset($_POST['respuesta_22']) ? $_POST['respuesta_22'] : '';
    if ($respuesta_22 === 'relacion') {  
        $verificar_22 = "correcto";
    } elseif ($respuesta_22 === '') {
        $verificar_22 = '';
    } else {
        $verificar_22 = "incorrecto";
    }

     // Verificar la respuesta de la primera pregunta
   $respuesta_23 = isset($_POST['respuesta_23']) ? $_POST['respuesta_23'] : '';
   if ($respuesta_23 === 'instante particular') {  
       $verificar_23 = "correcto";
   } elseif ($respuesta_23 === '') {
       $verificar_23 = '';
   } else {
       $verificar_23 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_24 = isset($_POST['respuesta_24']) ? $_POST['respuesta_24'] : '';
   if ($respuesta_24 === 'tiempo') {  
       $verificar_24 = "correcto";
   } elseif ($respuesta_24 === '') {
       $verificar_24 = '';
   } else {
       $verificar_24 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_25 = isset($_POST['respuesta_25']) ? $_POST['respuesta_25'] : '';
   if ($respuesta_25 === 'Puede cambiar') { 
       $verificar_25 = "correcto";
   } elseif ($respuesta_25 === '') {
       $verificar_25 = '';
   } else {
       $verificar_25 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_26 = isset($_POST['respuesta_26']) ? $_POST['respuesta_26'] : '';
   if ($respuesta_26 === 'insertan') {  
       $verificar_26 = "correcto";
   } elseif ($respuesta_26 === '') {
       $verificar_26 = '';
   } else {
       $verificar_26 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_27 = isset($_POST['respuesta_27']) ? $_POST['respuesta_27'] : '';
   if ($respuesta_27 === 'eliminan') {  
       $verificar_27 = "correcto";
   } elseif ($respuesta_27 === '') {
       $verificar_27 = '';
   } else {
       $verificar_27 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_28 = isset($_POST['respuesta_28']) ? $_POST['respuesta_28'] : '';
   if ($respuesta_28 === 'actualizan') {  
       $verificar_28 = "correcto";
   } elseif ($respuesta_28 === '') {
       $verificar_28 = '';
   } else {
       $verificar_28 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_29 = isset($_POST['respuesta_29']) ? $_POST['respuesta_29'] : '';
   if ($respuesta_29 === 'numero') {  
       $verificar_29 = "correcto";
   } elseif ($respuesta_29 === '') {
       $verificar_29 = '';
   } else {
       $verificar_29 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_30 = isset($_POST['respuesta_30']) ? $_POST['respuesta_30'] : '';
   if ($respuesta_30 === 'atributos') {  
       $verificar_30 = "correcto";
   } elseif ($respuesta_30 === '') {
       $verificar_30 = '';
   } else {
       $verificar_30 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_31 = isset($_POST['respuesta_31']) ? $_POST['respuesta_31'] : '';
   if ($respuesta_31 === 'relacion') {  
       $verificar_31 = "correcto";
   } elseif ($respuesta_31 === '') {
       $verificar_31 = '';
   } else {
       $verificar_31 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_32 = isset($_POST['respuesta_32']) ? $_POST['respuesta_32'] : '';
   if ($respuesta_32 === 'conoce') {  
       $verificar_32 = "correcto";
   } elseif ($respuesta_32 === '') {
       $verificar_32 = '';
   } else {
       $verificar_32 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_33 = isset($_POST['respuesta_33']) ? $_POST['respuesta_33'] : '';
   if ($respuesta_33 === 'grado') {  
       $verificar_33 = "correcto";
   } elseif ($respuesta_33 === '') {
       $verificar_33 = '';
   } else {
       $verificar_33 = "incorrecto";
   }

    $respuesta_34 = isset($_POST['respuesta_34']) ? $_POST['respuesta_34'] : '';
    if ($respuesta_34 === 'relacion') { 
        $verificar_34 = "correcto";
    } elseif ($respuesta_34 === '') {
        $verificar_34 = '';
    } else {
        $verificar_34 = "incorrecto";
    }

    $respuesta_35 = isset($_POST['respuesta_35']) ? $_POST['respuesta_35'] : '';
    if ($respuesta_35 === 'numero') { 
        $verificar_35 = "correcto";
    } elseif ($respuesta_35 === '') {
        $verificar_35 = '';
    } else {
        $verificar_35 = "incorrecto";
    }

    $respuesta_36 = isset($_POST['respuesta_36']) ? $_POST['respuesta_36'] : '';
    if ($respuesta_36 === 'tuplas') { 
        $verificar_36 = "correcto";
    } elseif ($respuesta_36 === '') {
    $verificar_36 = '';
    } else {
        $verificar_36 = "incorrecto";
    }

    $respuesta_37 = isset($_POST['respuesta_37']) ? $_POST['respuesta_37'] : '';
    if ($respuesta_37 === 'relacion') { 
        $verificar_37 = "correcto";
    } elseif ($respuesta_37 === '') {
        $verificar_37 = '';
    } else {
        $verificar_37 = "incorrecto";
    }

    $respuesta_38 = isset($_POST['respuesta_38']) ? $_POST['respuesta_38'] : '';
    if ($respuesta_38 === 'conoce') { 
        $verificar_38 = "correcto";
    } elseif ($respuesta_38 === '') {
        $verificar_38 = '';
    } else {
        $verificar_38 = "incorrecto";
    }

    $respuesta_39 = isset($_POST['respuesta_39']) ? $_POST['respuesta_39'] : '';
    if ($respuesta_39 === 'cardinalidad') { 
        $verificar_39 = "correcto";
    } elseif ($respuesta_39 === '') {
        $verificar_39 = '';
    } else {
        $verificar_39 = "incorrecto";
    }

    $respuesta_40 = isset($_POST['respuesta_40']) ? $_POST['respuesta_40'] : '';
    if ($respuesta_40 === 'desconocido') { 
        $verificar_40 = "correcto";
    } elseif ($respuesta_40 === '') {
        $verificar_40 = '';
    } else {
        $verificar_40 = "incorrecto";
    }

    $respuesta_41 = isset($_POST['respuesta_41']) ? $_POST['respuesta_41'] : '';
    if ($respuesta_41 === 'disponible') { 
        $verificar_41 = "correcto";
    } elseif ($respuesta_41 === '') {
        $verificar_41 = '';
    } else {
        $verificar_41 = "incorrecto";
    }

    $respuesta_42 = isset($_POST['respuesta_42']) ? $_POST['respuesta_42'] : '';
    if ($respuesta_42 === 'columna') { 
        $verificar_42 = "correcto";
    } elseif ($respuesta_42 === '') {
        $verificar_42 = '';
    } else {
        $verificar_42 = "incorrecto";
    }

    $respuesta_43 = isset($_POST['respuesta_43']) ? $_POST['respuesta_43'] : '';
    if ($respuesta_43 === 'conjunto de columnas') { 
        $verificar_43 = "correcto";
    } elseif ($respuesta_43 === '') {
        $verificar_43 = '';
    } else {
    $verificar_43 = "incorrecto";
    }

    $respuesta_44 = isset($_POST['respuesta_44']) ? $_POST['respuesta_44'] : '';
    if ($respuesta_44 === 'identifican') { 
        $verificar_44 = "correcto";
    } elseif ($respuesta_44 === '') {
    $verificar_44 = '';
    } else {
        $verificar_44 = "incorrecto";
    }

    $respuesta_45 = isset($_POST['respuesta_45']) ? $_POST['respuesta_45'] : '';
    if ($respuesta_45 === 'fila') { 
        $verificar_45 = "correcto";
    } elseif ($respuesta_45 === '') {
    $verificar_45 = '';
    } else {
        $verificar_45 = "incorrecto";
    }

    $respuesta_46 = isset($_POST['respuesta_46']) ? $_POST['respuesta_46'] : '';
    if ($respuesta_46 === 'diseñada') { 
        $verificar_46 = "correcto";
    } elseif ($respuesta_46 === '') {
    $verificar_46 = '';
    } else {
        $verificar_46 = "incorrecto";
    }

    $respuesta_47 = isset($_POST['respuesta_47']) ? $_POST['respuesta_47'] : '';
    if ($respuesta_47 === 'imponer') { 
        $verificar_47 = "correcto";
    } elseif ($respuesta_47 === '') {
        $verificar_47 = '';
    } else {
        $verificar_47 = "incorrecto";
    }

    $respuesta_48 = isset($_POST['respuesta_48']) ? $_POST['respuesta_48'] : '';
    if ($respuesta_48 === 'exclusividad') { 
        $verificar_48 = "correcto";
    } elseif ($respuesta_48 === '') {
    $verificar_48 = '';
    } else {
        $verificar_48 = "incorrecto";
    }

    $respuesta_49 = isset($_POST['respuesta_49']) ? $_POST['respuesta_49'] : '';
    if ($respuesta_49 === 'fila') { 
        $verificar_49 = "correcto";
    } elseif ($respuesta_49 === '') {
    $verificar_49 = '';
    } else {
        $verificar_49 = "incorrecto";
    }

    $respuesta_50 = isset($_POST['respuesta_50']) ? $_POST['respuesta_50'] : '';
    if ($respuesta_50 === 'conjunto') { 
        $verificar_50 = "correcto";
    } elseif ($respuesta_50 === '') {
    $verificar_50 = '';
    } else {
        $verificar_50 = "incorrecto";
    }

 $respuesta_51 = isset($_POST['respuesta_51']) ? $_POST['respuesta_51'] : '';
if ($respuesta_51 === 'atributos') { 
    $verificar_51 = "correcto";
} elseif ($respuesta_51 === '') {
    $verificar_51 = '';
} else {
    $verificar_51 = "incorrecto";
}

 $respuesta_52 = isset($_POST['respuesta_52']) ? $_POST['respuesta_52'] : '';
if ($respuesta_52 === 'identificar') { 
    $verificar_52 = "correcto";
} elseif ($respuesta_52 === '') {
    $verificar_52 = '';
} else {
    $verificar_52 = "incorrecto";
}

 $respuesta_53 = isset($_POST['respuesta_53']) ? $_POST['respuesta_53'] : '';
if ($respuesta_53 === 'unica') { 
    $verificar_53 = "correcto";
} elseif ($respuesta_53 === '') {
    $verificar_53 = '';
} else {
    $verificar_53 = "incorrecto";
}

 $respuesta_54 = isset($_POST['respuesta_54']) ? $_POST['respuesta_54'] : '';
if ($respuesta_54 === 'tupla') { 
    $verificar_54 = "correcto";
} elseif ($respuesta_54 === '') {
    $verificar_54 = '';
} else {
    $verificar_54 = "incorrecto";
}

 $respuesta_55 = isset($_POST['respuesta_55']) ? $_POST['respuesta_55'] : '';
if ($respuesta_55 === 'relacion') { 
    $verificar_55 = "correcto";
} elseif ($respuesta_55 === '') {
    $verificar_55 = '';
} else {
    $verificar_55 = "incorrecto";
}


 $respuesta_56 = isset($_POST['respuesta_56']) ? $_POST['respuesta_56'] : '';
if ($respuesta_56 === 'clave secundaria') { 
    $verificar_56 = "correcto";
} elseif ($respuesta_56 === '') {
    $verificar_56 = '';
} else {
    $verificar_56 = "incorrecto";
}

 $respuesta_57 = isset($_POST['respuesta_57']) ? $_POST['respuesta_57'] : '';
if ($respuesta_57 === 'conjunto') { 
    $verificar_57 = "correcto";
} elseif ($respuesta_57 === '') {
    $verificar_57 = '';
} else {
    $verificar_57 = "incorrecto";
}

 $respuesta_58 = isset($_POST['respuesta_58']) ? $_POST['respuesta_58'] : '';
if ($respuesta_58 === 'atributos') { 
    $verificar_58 = "correcto";
} elseif ($respuesta_58 === '') {
    $verificar_58 = '';
} else {
    $verificar_58 = "incorrecto";
}

 $respuesta_59 = isset($_POST['respuesta_59']) ? $_POST['respuesta_59'] : '';
if ($respuesta_59 === 'identificar') { 
    $verificar_59 = "correcto";
} elseif ($respuesta_59 === '') {
    $verificar_59 = '';
} else {
    $verificar_59 = "incorrecto";
}

 $respuesta_60 = isset($_POST['respuesta_60']) ? $_POST['respuesta_60'] : '';
if ($respuesta_60 === 'unica') { 
    $verificar_60 = "correcto";
} elseif ($respuesta_60 === '') {
    $verificar_60 = '';
} else {
    $verificar_60 = "incorrecto";
}

 $respuesta_61 = isset($_POST['respuesta_61']) ? $_POST['respuesta_61'] : '';
if ($respuesta_61 === 'tupla') { 
    $verificar_61 = "correcto";
} elseif ($respuesta_61 === '') {
    $verificar_61 = '';
} else {
    $verificar_61 = "incorrecto";
}

 $respuesta_62 = isset($_POST['respuesta_62']) ? $_POST['respuesta_62'] : '';
if ($respuesta_62 === 'atributo') { 
    $verificar_62 = "correcto";
} elseif ($respuesta_62 === '') {
    $verificar_62 = '';
} else {
    $verificar_62 = "incorrecto";
}

 $respuesta_63 = isset($_POST['respuesta_63']) ? $_POST['respuesta_63'] : '';
if ($respuesta_63 === 'relacion') { 
    $verificar_63 = "correcto";
} elseif ($respuesta_63 === '') {
    $verificar_63 = '';
} else {
    $verificar_63 = "incorrecto";
}

 $respuesta_64 = isset($_POST['respuesta_64']) ? $_POST['respuesta_64'] : '';
if ($respuesta_64 === 'referencia') { 
    $verificar_64 = "correcto";
} elseif ($respuesta_64 === '') {
    $verificar_64 = '';
} else {
    $verificar_64 = "incorrecto";
}

 $respuesta_65 = isset($_POST['respuesta_65']) ? $_POST['respuesta_65'] : '';
if ($respuesta_65 === 'clave primaria') { 
    $verificar_65 = "correcto";
} elseif ($respuesta_65 === '') {
    $verificar_65 = '';
} else {
    $verificar_65 = "incorrecto";
}

 $respuesta_66 = isset($_POST['respuesta_66']) ? $_POST['respuesta_66'] : '';
if ($respuesta_66 === 'relacion') { 
    $verificar_66 = "correcto";
} elseif ($respuesta_66 === '') {
    $verificar_66 = '';
} else {
    $verificar_66 = "incorrecto";
}

 $respuesta_67 = isset($_POST['respuesta_67']) ? $_POST['respuesta_67'] : '';
if ($respuesta_67 === 'combinando dos') { 
    $verificar_67 = "correcto";
} elseif ($respuesta_67 === '') {
    $verificar_67 = '';
} else {
    $verificar_67 = "incorrecto";
}

 $respuesta_68 = isset($_POST['respuesta_68']) ? $_POST['respuesta_68'] : '';
if ($respuesta_68 === 'atributos') { 
    $verificar_68 = "correcto";
} elseif ($respuesta_68 === '') {
    $verificar_68 = '';
} else {
    $verificar_68 = "incorrecto";
}

 $respuesta_69 = isset($_POST['respuesta_69']) ? $_POST['respuesta_69'] : '';
if ($respuesta_69 === 'manera unica') { 
    $verificar_69 = "correcto";
} elseif ($respuesta_69 === '') {
    $verificar_69 = '';
} else {
    $verificar_69 = "incorrecto";
}

 $respuesta_70 = isset($_POST['respuesta_70']) ? $_POST['respuesta_70'] : '';
if ($respuesta_70 === 'tupla') { 
    $verificar_70 = "correcto";
} elseif ($respuesta_70 === '') {
    $verificar_70 = '';
} else {
    $verificar_70 = "incorrecto";
}

 $respuesta_71 = isset($_POST['respuesta_71']) ? $_POST['respuesta_71'] : '';
if ($respuesta_71 === 'conjunto') { 
    $verificar_71 = "correcto";
} elseif ($respuesta_71 === '') {
    $verificar_71 = '';
} else {
    $verificar_71 = "incorrecto";
}

 $respuesta_72 = isset($_POST['respuesta_72']) ? $_POST['respuesta_72'] : '';
if ($respuesta_72 === 'valores atomicos') { 
    $verificar_72 = "correcto";
} elseif ($respuesta_72 === '') {
    $verificar_72 = '';
} else {
    $verificar_72 = "incorrecto";
}

 $respuesta_73 = isset($_POST['respuesta_73']) ? $_POST['respuesta_73'] : '';
if ($respuesta_73 === 'atributo') { 
    $verificar_73 = "correcto";
} elseif ($respuesta_73 === '') {
    $verificar_73 = '';
} else {
    $verificar_73 = "incorrecto";
}

 $respuesta_74 = isset($_POST['respuesta_74']) ? $_POST['respuesta_74'] : '';
if ($respuesta_74 === 'tipo de datos') { 
    $verificar_74 = "correcto";
} elseif ($respuesta_74 === '') {
    $verificar_74 = '';
} else {
    $verificar_74 = "incorrecto";
}

 $respuesta_75 = isset($_POST['respuesta_75']) ? $_POST['respuesta_75'] : '';
if ($respuesta_75 === 'rango') { 
    $verificar_75 = "correcto";
} elseif ($respuesta_75 === '') {
    $verificar_75 = '';
} else {
    $verificar_75 = "incorrecto";
}

 $respuesta_76 = isset($_POST['respuesta_76']) ? $_POST['respuesta_76'] : '';
if ($respuesta_76 === 'valores posibles') { 
    $verificar_76 = "correcto";
} elseif ($respuesta_76 === '') {
    $verificar_76 = '';
} else {
    $verificar_76 = "incorrecto";
}

 $respuesta_77 = isset($_POST['respuesta_77']) ? $_POST['respuesta_77'] : '';
if ($respuesta_77 === 'restricciones') { 
    $verificar_77 = "correcto";
} elseif ($respuesta_77 === '') {
    $verificar_77 = '';
} else {
    $verificar_77 = "incorrecto";
}

 $respuesta_78 = isset($_POST['respuesta_78']) ? $_POST['respuesta_78'] : '';
if ($respuesta_78 === 'cumplir') { 
    $verificar_78 = "correcto";
} elseif ($respuesta_78 === '') {
    $verificar_78 = '';
} else {
    $verificar_78 = "incorrecto";
}

 $respuesta_79 = isset($_POST['respuesta_79']) ? $_POST['respuesta_79'] : '';
if ($respuesta_79 === 'valores') { 
    $verificar_79 = "correcto";
} elseif ($respuesta_79 === '') {
    $verificar_79 = '';
} else {
    $verificar_79 = "incorrecto";
}

 $respuesta_80 = isset($_POST['respuesta_80']) ? $_POST['respuesta_80'] : '';
if ($respuesta_80 === 'atributo') { 
    $verificar_80 = "correcto";
} elseif ($respuesta_80 === '') {
    $verificar_80 = '';
} else {
    $verificar_80 = "incorrecto";
}

 $respuesta_81 = isset($_POST['respuesta_81']) ? $_POST['respuesta_81'] : '';
if ($respuesta_81 === 'indica') { 
    $verificar_81 = "correcto";
} elseif ($respuesta_81 === '') {
    $verificar_81 = '';
} else {
    $verificar_81 = "incorrecto";
}

    $respuesta_82 = isset($_POST['respuesta_82']) ? $_POST['respuesta_82'] : '';
    if ($respuesta_82 === 'solo algunas ocurrencias') { 
        $verificar_82 = "correcto";
    } elseif ($respuesta_82 === '') {
        $verificar_82 = '';
    } else {
        $verificar_82 = "incorrecto";
    }

    $respuesta_83 = isset($_POST['respuesta_83']) ? $_POST['respuesta_83'] : '';
    if ($respuesta_83 === 'entidad') { 
       $verificar_83 = "correcto";
    } elseif ($respuesta_83 === '') {
        $verificar_83 = '';
    } else {
        $verificar_83 = "incorrecto";
    }

    $respuesta_84 = isset($_POST['respuesta_84']) ? $_POST['respuesta_84'] : '';
    if ($respuesta_84 === 'intervenir') { 
        $verificar_84 = "correcto";
    } elseif ($respuesta_84 === '') {
        $verificar_84 = '';
    } else {
        $verificar_84 = "incorrecto";
    }

    $respuesta_85 = isset($_POST['respuesta_85']) ? $_POST['respuesta_85'] : '';
    if ($respuesta_85 === 'relacion') { 
        $verificar_85 = "correcto";
    } elseif ($respuesta_85 === '') {
        $verificar_85 = '';
    } else {
        $verificar_85 = "incorrecto";
    }

    $respuesta_86 = isset($_POST['respuesta_86']) ? $_POST['respuesta_86'] : '';
    if ($respuesta_86 === 'continua') { 
        $verificar_86 = "correcto";
    } elseif ($respuesta_86 === '') {
        $verificar_86 = '';
    } else {
        $verificar_86 = "incorrecto";
    }

    $respuesta_87 = isset($_POST['respuesta_87']) ? $_POST['respuesta_87'] : '';
    if ($respuesta_87 === 'discontinua') { 
        $verificar_87 = "correcto";
    } elseif ($respuesta_87 === '') {
        $verificar_87 = '';
    } else {
        $verificar_87 = "incorrecto";
    }

    $respuesta_88 = isset($_POST['respuesta_88']) ? $_POST['respuesta_88'] : '';
    if ($respuesta_88 === 'tabla') { 
        $verificar_88 = "correcto";
    } elseif ($respuesta_88 === '') {
        $verificar_88 = '';
    } else {
        $verificar_88 = "incorrecto";
    }

 $respuesta_89 = isset($_POST['respuesta_89']) ? $_POST['respuesta_89'] : '';
if ($respuesta_89 === 'bidimensional') { 
    $verificar_89 = "correcto";
} elseif ($respuesta_89 === '') {
    $verificar_89 = '';
} else {
    $verificar_89 = "incorrecto";
}

 $respuesta_90 = isset($_POST['respuesta_90']) ? $_POST['respuesta_90'] : '';
if ($respuesta_90 === 'filas') { 
    $verificar_90 = "correcto";
} elseif ($respuesta_90 === '') {
    $verificar_90 = '';
} else {
    $verificar_90 = "incorrecto";
}

 $respuesta_91 = isset($_POST['respuesta_91']) ? $_POST['respuesta_91'] : '';
if ($respuesta_91 === 'columnas') { 
    $verificar_91 = "correcto";
} elseif ($respuesta_91 === '') {
    $verificar_91 = '';
} else {
    $verificar_91 = "incorrecto";
}

 $respuesta_92 = isset($_POST['respuesta_92']) ? $_POST['respuesta_92'] : '';
if ($respuesta_92 === 'comprension') { 
    $verificar_92 = "correcto";
} elseif ($respuesta_92 === '') {
    $verificar_92 = '';
} else {
    $verificar_92 = "incorrecto";
}

 $respuesta_93 = isset($_POST['respuesta_93']) ? $_POST['respuesta_93'] : '';
if ($respuesta_93 === 'extension') { 
    $verificar_93 = "correcto";
} elseif ($respuesta_93 === '') {
    $verificar_93 = '';
} else {
    $verificar_93 = "incorrecto";
}

 $respuesta_94 = isset($_POST['respuesta_94']) ? $_POST['respuesta_94'] : '';
if ($respuesta_94 === 'propiedad') { 
    $verificar_94 = "correcto";
} elseif ($respuesta_94 === '') {
    $verificar_94 = '';
} else {
    $verificar_94 = "incorrecto";
}

 $respuesta_95 = isset($_POST['respuesta_95']) ? $_POST['respuesta_95'] : '';
if ($respuesta_95 === 'numerar') { 
    $verificar_95 = "correcto";
} elseif ($respuesta_95 === '') {
    $verificar_95 = '';
} else {
    $verificar_95 = "incorrecto";
}

 $respuesta_96 = isset($_POST['respuesta_96']) ? $_POST['respuesta_96'] : '';
if ($respuesta_96 === 'uno por uno') { 
    $verificar_96 = "correcto";
} elseif ($respuesta_96 === '') {
    $verificar_96 = '';
} else {
    $verificar_96 = "incorrecto";
}

 $respuesta_97 = isset($_POST['respuesta_97']) ? $_POST['respuesta_97'] : '';
if ($respuesta_97 === 'no tienen orden') { 
    $verificar_97 = "correcto";
} elseif ($respuesta_97 === '') {
    $verificar_97 = '';
} else {
    $verificar_97 = "incorrecto";
}

 $respuesta_98 = isset($_POST['respuesta_98']) ? $_POST['respuesta_98'] : '';
if ($respuesta_98 === 'tupla') { 
    $verificar_98 = "correcto";
} elseif ($respuesta_98 === '') {
    $verificar_98 = '';
} else {
    $verificar_98 = "incorrecto";
}

 $respuesta_99 = isset($_POST['respuesta_99']) ? $_POST['respuesta_99'] : '';
if ($respuesta_99 === 'repetidas') { 
    $verificar_99 = "correcto";
} elseif ($respuesta_99 === '') {
    $verificar_99 = '';
} else {
    $verificar_99 = "incorrecto";
}


 $respuesta_100 = isset($_POST['respuesta_100']) ? $_POST['respuesta_100'] : '';
if ($respuesta_100 === 'atributos') { 
    $verificar_100 = "correcto";
} elseif ($respuesta_100 === '') {
    $verificar_100 = '';
} else {
    $verificar_100 = "incorrecto";
}

 $respuesta_101 = isset($_POST['respuesta_101']) ? $_POST['respuesta_101'] : '';
if ($respuesta_101 === 'atributo') { 
    $verificar_101 = "correcto";
} elseif ($respuesta_101 === '') {
    $verificar_101 = '';
} else {
    $verificar_101 = "incorrecto";
}

 $respuesta_102 = isset($_POST['respuesta_102']) ? $_POST['respuesta_102'] : '';
if ($respuesta_102 === 'clave') { 
    $verificar_102 = "correcto";
} elseif ($respuesta_102 === '') {
    $verificar_102 = '';
} else {
    $verificar_102 = "incorrecto";
}

 $respuesta_103 = isset($_POST['respuesta_103']) ? $_POST['respuesta_103'] : '';
if ($respuesta_103 === 'dominio del atributo') { 
    $verificar_103 = "correcto";
} elseif ($respuesta_103 === '') {
    $verificar_103 = '';
} else {
    $verificar_103 = "incorrecto";
}

 $respuesta_104 = isset($_POST['respuesta_104']) ? $_POST['respuesta_104'] : '';
if ($respuesta_104 === 'atomico') { 
    $verificar_104 = "correcto";
} elseif ($respuesta_104 === '') {
    $verificar_104 = '';
} else {
    $verificar_104 = "incorrecto";
}

 $respuesta_105 = isset($_POST['respuesta_105']) ? $_POST['respuesta_105'] : '';
if ($respuesta_105 === 'univaluado') { 
    $verificar_105 = "correcto";
} elseif ($respuesta_105 === '') {
    $verificar_105 = '';
} else {
    $verificar_105 = "incorrecto";
}

 $respuesta_106 = isset($_POST['respuesta_106']) ? $_POST['respuesta_106'] : '';
if ($respuesta_106 === 'compuestos') { 
    $verificar_106 = "correcto";
} elseif ($respuesta_106 === '') {
    $verificar_106 = '';
} else {
    $verificar_106 = "incorrecto";
}

 $respuesta_107 = isset($_POST['respuesta_107']) ? $_POST['respuesta_107'] : '';
if ($respuesta_107 === 'multivaluados') { 
    $verificar_107 = "correcto";
} elseif ($respuesta_107 === '') {
    $verificar_107 = '';
} else {
    $verificar_107 = "incorrecto";
}

 $respuesta_108 = isset($_POST['respuesta_108']) ? $_POST['respuesta_108'] : '';
if ($respuesta_108 === 'no es relevante') { 
    $verificar_108 = "correcto";
} elseif ($respuesta_108 === '') {
    $verificar_108 = '';
} else {
    $verificar_108 = "incorrecto";
}

 $respuesta_109 = isset($_POST['respuesta_109']) ? $_POST['respuesta_109'] : '';
if ($respuesta_109 === 'integridad de entidad') { 
    $verificar_109 = "correcto";
} elseif ($respuesta_109 === '') {
    $verificar_109 = '';
} else {
    $verificar_109 = "incorrecto";
}

 $respuesta_110 = isset($_POST['respuesta_110']) ? $_POST['respuesta_110'] : '';
if ($respuesta_110 === 'integridad referencial') { 
    $verificar_110 = "correcto";
} elseif ($respuesta_110 === '') {
    $verificar_110 = '';
} else {
    $verificar_110 = "incorrecto";
}

// Tabla del 12
$respuesta_111 = isset($_POST['respuesta_111']) ? $_POST['respuesta_111'] : '';
if ($respuesta_111 === 'clave foranea') {  
    $verificar_111 = "correcto";
} elseif ($respuesta_111 === '') {
    $verificar_111 = '';
} else {
    $verificar_111 = "incorrecto";
}

$respuesta_112 = isset($_POST['respuesta_112']) ? $_POST['respuesta_112'] : '';
if ($respuesta_112 === 'coincidan') {  
    $verificar_112 = "correcto";
} elseif ($respuesta_112 === '') {
    $verificar_112 = '';
} else {
    $verificar_112 = "incorrecto";
}

$respuesta_113 = isset($_POST['respuesta_113']) ? $_POST['respuesta_113'] : '';
if ($respuesta_113 === 'clave primaria') {  
    $verificar_113 = "correcto";
} elseif ($respuesta_113 === '') {
    $verificar_113 = '';
} else {
    $verificar_113 = "incorrecto";
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
    height: 400vh;
    }

  .title {
    text-align: center;
    font-size: 32px;
    font-weight: bold;
    color: #1f4fbf;
    margin: 20px 0;
  }

  .desc {
    text-align: center;
    max-width: 900px;
    margin: auto;
    color: #1f4fbf;
    font-size: 16px;
  }

  svg {
    display: block;
    margin: 30px auto;
  }

  .table {
    fill: #fff7a8;
    stroke: #0033cc;
    stroke-width: 2;
    rx: 8;
  }

  .header {
    fill: #0033cc;
  }

  .header-text {
    fill: white;
    font-weight: bold;
    font-size: 14px;
  }

  .cell-text {
    fill: #006600;
    font-size: 13px;
  }

  .pk {
    fill: red;
    font-weight: bold;
  }

  .fk {
    fill: blue;
    font-weight: bold;
  }

  .relation {
    stroke: black;
    stroke-width: 2;
    marker-end: url(#arrow);
  }

  .relation-dashed {
    stroke-dasharray: 6;
  }

  .note {
    fill: #1f4fbf;
    font-size: 14px;
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
<h5>Key Terms in the Relational Model</h5>

<button onmousedown="mostrarImagen()" onmouseup="ocultarImagen()">Explicacion</button>
    <!-- Elemento para mostrar la imagen -->

    <img id="imagenMostrada" src="../../../img/guia_308.png" style="display: none; max-width: 100%" width="560">

    <script>
        function mostrarImagen() {
        var imagenMostrada2 = document.getElementById('imagenMostrada');

        // Mostrar la imagen
        imagenMostrada.style.display = 'block';
        }

        function ocultarImagen() {
        var imagenMostrada = document.getElementById('imagenMostrada');

        // Ocultar la imagen al soltar el botón
        imagenMostrada.style.display = 'none';
        }
    </script>


 
<ul>
    <li>
        <strong>Attribute:</strong>
        Los atributos son las 
        <input type="text" name="respuesta_1" value="<?php echo $respuesta_1; ?>" size="8">
          que 
        <input type="text" name="respuesta_2" value="<?php echo $respuesta_2; ?>" size="8">
          una 
        <input type="text" name="respuesta_3" value="<?php echo $respuesta_3; ?>" size="8">
         . 
        Por ejemplo: ROLL_NO, NAME, ADDRESS, etc.
    </li>

    <li>
        <strong>Relation Schema:</strong>
        Un esquema de relación 
        <input type="text" name="respuesta_4" value="<?php echo $respuesta_4; ?>" size="8">
          la 
        <input type="text" name="respuesta_5" value="<?php echo $respuesta_5; ?>" size="8">
          de la 
          <input type="text" name="respuesta_6" value="<?php echo $respuesta_6; ?>" size="8">
             y 
          <input type="text" name="respuesta_7" value="<?php echo $respuesta_7; ?>" size="8">
            el 
          <input type="text" name="respuesta_8" value="<?php echo $respuesta_8; ?>" size="8">
            de la 
          <input type="text" name="respuesta_9" value="<?php echo $respuesta_9; ?>" size="8">
            junto con sus 
          <input type="text" name="respuesta_10" value="<?php echo $respuesta_10; ?>" size="8">
           .
           <button onmousedown="mostrarMensaje()" onmouseup="ocultarMensaje()">Ayuda</button>
    <div id="mensaje" style="display: none; margin-top: 10px; padding: 10px; background-color: #f0f0f0;">
    Por ejemplo, <em>STUDENT (ROLL_NO, NAME, ADDRESS, PHONE, AGE)</em> es el esquema de relación de STUDENT.
        Si un esquema tiene más de una relación, se denomina <em>Relational Schema</em>.
    </div>
      
    </li>

    <li>
        <strong>Tuple:</strong>
        Una tupla 
        <input type="text" name="respuesta_11" value="<?php echo $respuesta_11; ?>" size="8">
          una 
        <input type="text" name="respuesta_12" value="<?php echo $respuesta_12; ?>" size="8">
          en una 
        <input type="text" name="respuesta_13" value="<?php echo $respuesta_13; ?>" size="8">
         . 
        <input type="text" name="respuesta_14" value="<?php echo $respuesta_14; ?>" size="8">
          contiene un 
        <input type="text" name="respuesta_15" value="<?php echo $respuesta_15; ?>" size="8">
          de 
        <input type="text" name="respuesta_16" value="<?php echo $respuesta_16; ?>" size="8">
          de 
        <input type="text" name="respuesta_17" value="<?php echo $respuesta_17; ?>" size="8">
          que 
        <input type="text" name="respuesta_18" value="<?php echo $respuesta_18; ?>" size="8">
          una 
        <input type="text" name="respuesta_19" value="<?php echo $respuesta_19; ?>" size="14">
         .
        Por ejemplo, <em>(1, RAM, DELHI, 9455123451, 18)</em> es una tupla en la tabla STUDENT.
    </li>

    <li>
        <strong>Relation Instance:</strong>
        El 
        <input type="text" name="respuesta_20" value="<?php echo $respuesta_20; ?>" size="8">
          de 
        <input type="text" name="respuesta_21" value="<?php echo $respuesta_21; ?>" size="8">
          de una 
        <input type="text" name="respuesta_22" value="<?php echo $respuesta_22; ?>" size="8">
          en un 
        <input type="text" name="respuesta_23" value="<?php echo $respuesta_23; ?>" size="14">
          de 
        <input type="text" name="respuesta_24" value="<?php echo $respuesta_24; ?>" size="8">
          se denomina instancia de relación.
        <input type="text" name="respuesta_25" value="<?php echo $respuesta_25; ?>" size="11">
          cuando se 
        <input type="text" name="respuesta_26" value="<?php echo $respuesta_26; ?>" size="7">
         , 
        <input type="text" name="respuesta_27" value="<?php echo $respuesta_27; ?>" size="7">
          o 
        <input type="text" name="respuesta_28" value="<?php echo $respuesta_28; ?>" size="7">
          datos en la base de datos.
    </li>

    <li>
        <strong>Degree:</strong>
        El 
        <input type="text" name="respuesta_29" value="<?php echo $respuesta_29; ?>" size="8">
          de 
        <input type="text" name="respuesta_30" value="<?php echo $respuesta_30; ?>" size="8">
          en una 
        <input type="text" name="respuesta_31" value="<?php echo $respuesta_31; ?>" size="8">
          se 
        <input type="text" name="respuesta_32" value="<?php echo $respuesta_32; ?>" size="8">
          como el 
        <input type="text" name="respuesta_33" value="<?php echo $respuesta_33; ?>" size="8">
          de la 
        <input type="text" name="respuesta_34" value="<?php echo $respuesta_34; ?>" size="8">
         .
        <button onmousedown="mostrarMensaje2()" onmouseup="ocultarMensaje2()">Ayuda</button>
        <div id="mensaje" style="display: none; margin-top: 10px; padding: 10px; background-color: #f0f0f0;">
        Por ejemplo, la relación STUDENT tiene grado 5 porque posee 5 atributos.
        </div>
         
    </li>

    <li>
        <strong>Cardinality:</strong>
        El 
        <input type="text" name="respuesta_35" value="<?php echo $respuesta_35; ?>" size="8">
          de 
        <input type="text" name="respuesta_36" value="<?php echo $respuesta_36; ?>" size="8">
          en una 
        <input type="text" name="respuesta_37" value="<?php echo $respuesta_37; ?>" size="8">
          se 
        <input type="text" name="respuesta_38" value="<?php echo $respuesta_38; ?>" size="8">
          como la 
        <input type="text" name="respuesta_39" value="<?php echo $respuesta_39; ?>" size="8">
         .

        <button onmousedown="mostrarMensaje2()" onmouseup="ocultarMensaje2()">Ayuda</button>
        <div id="mensaje" style="display: none; margin-top: 10px; padding: 10px; background-color: #f0f0f0;">
        Por ejemplo, la relación STUDENT definida anteriormente tiene cardinalidad 4.
        </div>
         
    </li>

    <li>
        <strong>NULL Values:</strong>
        Un valor que es 
        <input type="text" name="respuesta_40" value="<?php echo $respuesta_40; ?>" size="8">
          o no está 
        <input type="text" name="respuesta_41" value="<?php echo $respuesta_41; ?>" size="8">
          se denomina valor <code>NULL</code>.
        Por ejemplo, el atributo PHONE del estudiante con ROLL_NO 4 es <code>NULL</code>.
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
    <?php echo $verificar_11 ?> 
    <br>

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
    <br>
    <?php echo $verificar_23 ?>
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
    <br>
    <?php echo $verificar_34 ?>
    <?php echo $verificar_35 ?>
    <?php echo $verificar_36 ?>
    <?php echo $verificar_37 ?>
    <?php echo $verificar_38 ?>
    <?php echo $verificar_39 ?>
    <?php echo $verificar_40 ?>
    <?php echo $verificar_41 ?>
<hr>
<h5>Types of Keys in the Relational Model</h5>

<ul>
    <li>
        <strong>Primary Key:</strong>
        Una clave primaria es una 
        <input type="text" name="respuesta_42" value="<?php echo $respuesta_42; ?>" size="8">
          o un 
        <input type="text" name="respuesta_43" value="<?php echo $respuesta_43; ?>" size="18">
          en una tabla cuyos valores 
        <input type="text" name="respuesta_44" value="<?php echo $respuesta_44; ?>" size="8">
          de forma exclusiva una 
        <input type="text" name="respuesta_45" value="<?php echo $respuesta_45; ?>" size="8">
          de la tabla. Una base de datos relacional está 
        <input type="text" name="respuesta_46" value="<?php echo $respuesta_46; ?>" size="8">
          para 
        <input type="text" name="respuesta_47" value="<?php echo $respuesta_47; ?>" size="8">
          la 
        <input type="text" name="respuesta_48" value="<?php echo $respuesta_48; ?>" size="8">
          de las claves primarias permitiendo que haya sólo una 
        <input type="text" name="respuesta_49" value="<?php echo $respuesta_49; ?>" size="8">
          con un valor de clave primaria específico en una tabla.
    </li>

    <li>
        <strong>Candidate Key (Clave secundaria):</strong>
        Una clave candidata es un 
        <input type="text" name="respuesta_50" value="<?php echo $respuesta_50; ?>" size="8">
          de 
        <input type="text" name="respuesta_51" value="<?php echo $respuesta_51; ?>" size="8">
          que puede 
        <input type="text" name="respuesta_52" value="<?php echo $respuesta_52; ?>" size="8">
          de manera 
        <input type="text" name="respuesta_53" value="<?php echo $respuesta_53; ?>" size="8">
          una 
        <input type="text" name="respuesta_54" value="<?php echo $respuesta_54; ?>" size="8">
          en una 
        <input type="text" name="respuesta_55" value="<?php echo $respuesta_55; ?>" size="8">
         .
        Cuando una clave candidata no es seleccionada como clave primaria, suele denominarse <em>
        <input type="text" name="respuesta_56" value="<?php echo $respuesta_56; ?>" size="12">    
         </em>
        en contextos de enseñanza o diagramas prácticos.
    </li>

    <li>
        <strong>Super Key:</strong>
        Una superclave es un 
        <input type="text" name="respuesta_57" value="<?php echo $respuesta_57; ?>" size="8"> 
          de 
        <input type="text" name="respuesta_58" value="<?php echo $respuesta_58; ?>" size="8"> 
          que puede 
        <input type="text" name="respuesta_59" value="<?php echo $respuesta_59; ?>" size="8"> 
          de manera 
        <input type="text" name="respuesta_60" value="<?php echo $respuesta_60; ?>" size="8"> 
          una 
        <input type="text" name="respuesta_61" value="<?php echo $respuesta_61; ?>" size="8"> 
         .
    </li>

    <li>
        <strong>Foreign Key:</strong>
        Una clave foránea es un 
        <input type="text" name="respuesta_62" value="<?php echo $respuesta_62; ?>" size="8"> 
          en una 
        <input type="text" name="respuesta_63" value="<?php echo $respuesta_63; ?>" size="8"> 
          que hace 
        <input type="text" name="respuesta_64" value="<?php echo $respuesta_64; ?>" size="8"> 
          a la 
        <input type="text" name="respuesta_65" value="<?php echo $respuesta_65; ?>" size="10"> 
          de otra 
        <input type="text" name="respuesta_66" value="<?php echo $respuesta_66; ?>" size="8"> 
         .
    </li>

    <li>
        <strong>Composite Key:</strong>
        Una clave compuesta se forma 
        <input type="text" name="respuesta_67" value="<?php echo $respuesta_67; ?>" size="12"> 
          o más 
        <input type="text" name="respuesta_68" value="<?php echo $respuesta_68; ?>" size="8"> 
          para identificar de 
        <input type="text" name="respuesta_69" value="<?php echo $respuesta_69; ?>" size="10"> 
          una 
        <input type="text" name="respuesta_70" value="<?php echo $respuesta_70; ?>" size="8"> 
         .
    </li>
</ul>
    <button type="submit">Enviar</button>
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
    <br>
    <?php echo $verificar_52 ?>
    <?php echo $verificar_53 ?>
    <?php echo $verificar_54 ?>
    <?php echo $verificar_55 ?>   
    <?php echo $verificar_56 ?>
    <?php echo $verificar_57 ?>
    <?php echo $verificar_58 ?>
    <?php echo $verificar_59 ?>
    <?php echo $verificar_60 ?>
    <?php echo $verificar_61 ?>
    <br>
    <?php echo $verificar_62 ?>
    <?php echo $verificar_63 ?>
    <?php echo $verificar_64 ?>
    <?php echo $verificar_65 ?>
    <?php echo $verificar_66 ?>
    <?php echo $verificar_67 ?>
    <?php echo $verificar_68 ?>
    <?php echo $verificar_69 ?>
    <?php echo $verificar_70 ?>
    
    <img src="../../../img/guia_309.png" alt="" width="600">

    <h5>Domain (Dominio)</h5>

<p>
Un <strong>dominio</strong> es el 
<input type="text" name="respuesta_71" value="<?php echo $respuesta_71; ?>" size="8">
  de 
<input type="text" name="respuesta_72" value="<?php echo $respuesta_72; ?>" size="13">
  permitidos para un 
<input type="text" name="respuesta_73" value="<?php echo $respuesta_73; ?>" size="8">
 .
Define el 
<input type="text" name="respuesta_74" value="<?php echo $respuesta_74; ?>" size="9">
 , el 
<input type="text" name="respuesta_75" value="<?php echo $respuesta_75; ?>" size="8">
  de 
<input type="text" name="respuesta_76" value="<?php echo $respuesta_76; ?>" size="11">
  y, en algunos casos,
las 
<input type="text" name="respuesta_77" value="<?php echo $respuesta_77; ?>" size="8">
  que deben 
<input type="text" name="respuesta_78" value="<?php echo $respuesta_78; ?>" size="8">
  los 
<input type="text" name="respuesta_79" value="<?php echo $respuesta_79; ?>" size="8">
    de un 
    <input type="text" name="respuesta_80" value="<?php echo $respuesta_80; ?>" size="8">
 .
</p>

<h5>Participación</h5>

<p>
La <strong>participación</strong> 
<input type="text" name="respuesta_81" value="<?php echo $respuesta_81; ?>" size="8">
  si todas o 
<input type="text" name="respuesta_82" value="<?php echo $respuesta_82; ?>" size="20">
  de una 
<input type="text" name="respuesta_83" value="<?php echo $respuesta_83; ?>" size="8">
  deben 
<input type="text" name="respuesta_84" value="<?php echo $respuesta_84; ?>" size="8">
  en una 
<input type="text" name="respuesta_85" value="<?php echo $respuesta_85; ?>" size="8">
  dentro del modelo Entidad–Relación.
Puede ser <strong>total (obligatoria)</strong> o <strong>parcial (opcional)</strong>.
</p>


    <button type="submit">Enviar</button>
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
    <?php echo $verificar_83 ?>
    <?php echo $verificar_84 ?>
    <?php echo $verificar_85 ?>
    <hr>
 

 
</div>




<div class="seccion derecha">
   
<img src="../../../img/PERSONAL.png" alt="">
<h5>Participación de las Entidades en una Relación</h5>

<ul>
    <li>
        <strong>🔹 Línea 
        <input type="text" name="respuesta_86" value="<?php echo $respuesta_86; ?>" size="8">    
          (participación total)</strong><br>
        Indica una <strong>participación obligatoria</strong> de la entidad en la relación.<br>
        &rarr; Toda ocurrencia de la entidad <em>debe</em> participar al menos una vez en la relación.<br>
        <br>
        Ejemplo: todo <em>DIRECTIVO</em> <em>debe</em> tener al menos un subordinado.
    </li>

    <br>

    <li>
        <strong>🔹 Línea 
        <input type="text" name="respuesta_87" value="<?php echo $respuesta_87; ?>" size="8">    
        (participación parcial)</strong><br>
        Indica una <strong>participación opcional</strong> de la entidad en la relación.<br>
        &rarr; Una ocurrencia de la entidad <em>puede o no</em> participar en la relación.<br>
        <br>
        Ejemplo: un <code>PERSONAL</code> puede o no tener un directivo (por ejemplo, el director general).
    </li>
</ul>

    <button type="submit">Enviar</button>
    <?php echo $verificar_86 ?>
    <?php echo $verificar_87 ?>
<hr>
  
<h5>Elementos del Modelo Relacional</h5>

<p>
La <strong>relación</strong>, también llamada 
<input type="text" name="respuesta_88" value="<?php echo $respuesta_88; ?>" size="8">
   , es el elemento fundamental del modelo relacional.
Representa un concepto abstracto de estructura 
<input type="text" name="respuesta_89" value="<?php echo $respuesta_89; ?>" size="8">
  compuesta por 
<input type="text" name="respuesta_90" value="<?php echo $respuesta_90; ?>" size="8">
  y 
<input type="text" name="respuesta_91" value="<?php echo $respuesta_91; ?>" size="8">
 .
</p>

<h5>Definición de una Relación</h5>

<p>
Una relación puede definirse de dos formas:
</p>

<ul>
    <li>
        <strong>Por 
        <input type="text" name="respuesta_92" value="<?php echo $respuesta_92; ?>" size="8">    
         :</strong>
        se describe la 
        <input type="text" name="respuesta_94" value="<?php echo $respuesta_94; ?>" size="8">
          que deben cumplir los elementos de la relación.
        <br>
        Ejemplo:
        <br>
        <em>
        R = { x | x (identificación, nombre, salario) es empleado de la Universidad }
        </em>
    </li>

    <li>
        <strong>Por 
        <input type="text" name="respuesta_93" value="<?php echo $respuesta_93; ?>" size="8">    
         :</strong>
        consiste en 
        <input type="text" name="respuesta_95" value="<?php echo $respuesta_95; ?>" size="8">
          explícitamente, 
          <input type="text" name="respuesta_96" value="<?php echo $respuesta_96; ?>" size="8">
           , todos los elementos
        (filas o tuplas) que pertenecen a la relación.
    </li>
</ul>

<h5>Propiedades de una Relación</h5>

<ul>
    <li>
        Una relación es un <strong>conjunto de filas</strong>; por definición, las filas 
        <input type="text" name="respuesta_97" value="<?php echo $respuesta_97; ?>" size="13">
         .
    </li>

    <li>
        Cada instancia o fila de una relación se denomina  
        <input type="text" name="respuesta_98" value="<?php echo $respuesta_98; ?>" size="8">
          .
    </li>

    <li>
        En una relación <strong>no existen tuplas 
        <input type="text" name="respuesta_99" value="<?php echo $respuesta_99; ?>" size="8">    
         </strong>.
    </li>

    <li>
        Las columnas de una relación se denominan 
        <input type="text" name="respuesta_100" value="<?php echo $respuesta_100; ?>" size="8">
        y cada 
        <input type="text" name="respuesta_101" value="<?php echo $respuesta_101; ?>" size="8">
          debe tener un nombre único dentro de la relación.
    </li>

    <li>
        Cada relación debe poseer un <strong>atributo o conjunto de atributos</strong>
        que identifique de manera única a cada tupla; a este conjunto se le denomina
        <input type="text" name="respuesta_102" value="<?php echo $respuesta_102; ?>" size="8">
           .
    </li>

    <li>
        Para cada atributo existe un conjunto de valores permitidos,
        denominado 
        <input type="text" name="respuesta_103" value="<?php echo $respuesta_103; ?>" size="16">
         .
    </li>

    <li>
        Cada celda de una relación contiene un valor <strong>
        <input type="text" name="respuesta_104" value="<?php echo $respuesta_104; ?>" size="8">    
          o 
        <input type="text" name="respuesta_105" value="<?php echo $respuesta_105; ?>" size="8">
         </strong>,
        es decir, no admite valores 
        <input type="text" name="respuesta_106" value="<?php echo $respuesta_106; ?>" size="8">
          ni 
        <input type="text" name="respuesta_107" value="<?php echo $respuesta_107; ?>" size="10">
         .
    </li>

    <li>
        El orden de las filas y de las columnas <strong>
        <input type="text" name="respuesta_108" value="<?php echo $respuesta_108; ?>" size="11">    
         </strong>
        para el sistema gestor de bases de datos (DBMS).
    </li>

</ul>

    <button type="submit">Enviar</button>
    <?php echo $verificar_88 ?> 
    <?php echo $verificar_89 ?>
    <?php echo $verificar_90 ?>
    <?php echo $verificar_91 ?>
    <?php echo $verificar_92 ?>
    <?php echo $verificar_93 ?>
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
    <?php echo $verificar_104 ?>
    <?php echo $verificar_105 ?>
    <?php echo $verificar_106 ?>
    <?php echo $verificar_107 ?>
    <?php echo $verificar_108 ?>
<hr>

<h5>Regla de 
<input type="text" name="respuesta_109" value="<?php echo $respuesta_109; ?>" size="17">    
 : Clave primaria</h5>
<p>Toda relación debe poseer una clave primaria. Atributo  (o conjunto de atributos) tomado   del conjunto de atributos 
    que son claves candidatas.
</p>

<h5>Regla de 
<input type="text" name="respuesta_110" value="<?php echo $respuesta_110; ?>" size="17">    
 : Clave foránea
</h5>
<p>Garantiza que los valores de 
<input type="text" name="respuesta_111" value="<?php echo $respuesta_111; ?>" size="14">    
  en una tabla hija 
<input type="text" name="respuesta_112" value="<?php echo $respuesta_112; ?>" size="8">    
  con valores existentes de 
<input type="text" name="respuesta_113" value="<?php echo $respuesta_113; ?>" size="10">
  en la 
    tabla padre, manteniendo 
    relaciones válidas entre tablas.</p>

    <button type="submit">Enviar</button>
    <?php echo $verificar_109 ?>
    <?php echo $verificar_110 ?>
    <?php echo $verificar_111 ?>
    <?php echo $verificar_112 ?>
    <?php echo $verificar_113 ?>
    <hr>
      <img src="../../../img/guia_310.png" alt="" width="700">

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
