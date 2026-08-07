<?php
 
 

$mostrar_solucion = '';
 
 
for ($i = 1; $i <= 230; $i++) {
    ${"respuesta_" . $i} = '';
}
  $respuesta_44_dos = '';
 $verificar_44_dos = '';
     
for ($i = 1; $i <= 230; $i++) {
    ${"verificar_" . $i} = '';
}
 
     
if ($_POST) {
    $mostrar_solucion = isset($_POST['mostrar_solucion']) ? $_POST['mostrar_solucion'] : '';
    
    if ($mostrar_solucion === 'mostrar_solucion') {
        // Establecer todas las respuestas correctas
        
        // Sección 3.3.1 Introducción
        $respuesta_1 = 'respuesta correcta';
        $respuesta_2 = 'eficiente';
        $respuesta_3 = 'eficiencia';
        $respuesta_4 = 'tiempo';
        $respuesta_5 = 'tamaño';
        $respuesta_6 = 'cantidad de memoria';
        $respuesta_7 = 'tiempo';
        $respuesta_8 = 'la memoria';
        $respuesta_9 = 'memoria';
        $respuesta_10 = 'espacial';
        $respuesta_11 = 'estructuras de datos';
        
        // Sección 3.3.2 Complejidad Temporal
        $respuesta_12 = 'cantidad';
        $respuesta_13 = 'operaciones';
        $respuesta_14 = 'realiza';
        $respuesta_15 = 'entrada';
        $respuesta_16 = 'tamaño';
        $respuesta_17 = 'comparacion';
        $respuesta_18 = 'operaciones';
        
        // Algoritmo dado (max)
        $respuesta_19 = 'i \leq n';
        $respuesta_20 = 'maximo';
        $respuesta_21 = 'maximo';
        $respuesta_22 = 'if max < a_i then';
        $respuesta_23 = 'n - 1';
        $respuesta_24 = '2 comparaciones';
        $respuesta_25 = '2(n - 1)';
        $respuesta_26 = 'n + 1';
        $respuesta_27 = '2(n-1)+1';
        $respuesta_28 = '2n-1';
        
        // Búsqueda Lineal
        $respuesta_29 = 'i \leq n';
        $respuesta_30 = 'x \neq a_1';
        $respuesta_31 = '2';
        $respuesta_32 = 'dentro';
        $respuesta_33 = '1';
        $respuesta_34 = 'fuera';
        $respuesta_35 = 'i \leq n';
        $respuesta_36 = 'fuera';
        $respuesta_37 = '2n';
        $respuesta_38 = '1';
        $respuesta_39 = '2n+2';
        
        // Búsqueda Binaria
        $respuesta_40 = 'divide';
        $respuesta_41 = 'mitad';
        $respuesta_42 = 'potencias';
        $respuesta_43 = '2';
        $respuesta_44 = '2^k';
        $respuesta_44_dos = 'lista';
        $respuesta_45 = 'log n';
        $respuesta_46 = 'i';
        $respuesta_47 = 'j';
        $respuesta_48 = 'contiene';
        $respuesta_49 = 'i<j';
        $respuesta_50 = 'continuar';
        $respuesta_51 = 'dividir';
        $respuesta_52 = '2^k';
        $respuesta_53 = '2';
        $respuesta_54 = '2^{k-1}';
        $respuesta_55 = '2';
        $respuesta_56 = '2';
        $respuesta_57 = '2';
        $respuesta_58 = 'log n';
        $respuesta_59 = '2logn+2';
        $respuesta_60 = '2^k';
        $respuesta_61 = '2logn+2';
        $respuesta_62 = '2^{k+1}';
        $respuesta_63 = '\lfloor \log n \rfloor';
        $respuesta_64 = 'log n';
        $respuesta_65 = '2^k';
        $respuesta_66 = '\frac{n}{2^k}';
        $respuesta_67 = '\frac{n}{2^k}=1';
        
        // Complejidad en el caso promedio
        $respuesta_68 = 'posibles';
        $respuesta_69 = 'complicado';
        $respuesta_70 = 'n';
        
        // Ejemplo 4: Rendimiento promedio
        $respuesta_71 = '2';
        $respuesta_72 = '5';
        $respuesta_73 = '2';
        $respuesta_74 = 'una';
        $respuesta_75 = '2i+1';
        $respuesta_76 = '\sum_{i=1}^{n}(2i+1)';
        
        // Marcar todas como correctas
        $verificar_1 = $verificar_2 = $verificar_3 = /* ... todas las variables de verificación ... */ $verificar_110 = "correcto";
    }else {
    $respuesta_1 = isset($_POST['respuesta_1']) ? $_POST['respuesta_1'] : '';
   if ($respuesta_1 === 'respuesta correcta') {  
       $verificar_1 = "correcto";
   } elseif ($respuesta_1 === '') {
       $verificar_1 = '';
   } else {
       $verificar_1 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_2 = isset($_POST['respuesta_2']) ? $_POST['respuesta_2'] : '';
   if ($respuesta_2 === 'eficiente') {  
       $verificar_2 = "correcto";
   } elseif ($respuesta_2 === '') {
       $verificar_2 = '';
   } else {
       $verificar_2 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_3 = isset($_POST['respuesta_3']) ? $_POST['respuesta_3'] : '';
   if ($respuesta_3 === 'eficiencia') {  
       $verificar_3 = "correcto";
   } elseif ($respuesta_3 === '') {
       $verificar_3 = '';
   } else {
       $verificar_3 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_4 = isset($_POST['respuesta_4']) ? $_POST['respuesta_4'] : '';
   if ($respuesta_4 === 'tiempo') {  
       $verificar_4 = "correcto";
   } elseif ($respuesta_4 === '') {
       $verificar_4 = '';
   } else {
       $verificar_4 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_5 = isset($_POST['respuesta_5']) ? $_POST['respuesta_5'] : '';
   if ($respuesta_5 === 'tamaño') {  
       $verificar_5 = "correcto";
   } elseif ($respuesta_5 === '') {
       $verificar_5 = '';
   } else {
       $verificar_5 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_6 = isset($_POST['respuesta_6']) ? $_POST['respuesta_6'] : '';
   if ($respuesta_6 === 'cantidad de memoria') {  
       $verificar_6 = "correcto";
   } elseif ($respuesta_6 === '') {
       $verificar_6 = '';
   } else {
       $verificar_6 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_7 = isset($_POST['respuesta_7']) ? $_POST['respuesta_7'] : '';
   if ($respuesta_7 === 'tiempo') {  
       $verificar_7 = "correcto";
   } elseif ($respuesta_7 === '') {
       $verificar_7 = '';
   } else {
       $verificar_7 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_8 = isset($_POST['respuesta_8']) ? $_POST['respuesta_8'] : '';
   if ($respuesta_8 === 'la memoria') {  
       $verificar_8 = "correcto";
   } elseif ($respuesta_8 === '') {
       $verificar_8 = '';
   } else {
       $verificar_8 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_9 = isset($_POST['respuesta_9']) ? $_POST['respuesta_9'] : '';
   if ($respuesta_9 === 'memoria') {  
       $verificar_9 = "correcto";
   } elseif ($respuesta_9 === '') {
       $verificar_9 = '';
   } else {
       $verificar_9 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_10 = isset($_POST['respuesta_10']) ? $_POST['respuesta_10'] : '';
   if ($respuesta_10 === 'espacial') {  
       $verificar_10 = "correcto";
   } elseif ($respuesta_10 === '') {
       $verificar_10 = '';
   } else {
       $verificar_10 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_11 = isset($_POST['respuesta_11']) ? $_POST['respuesta_11'] : '';
   if ($respuesta_11 === 'estructuras de datos') {  
       $verificar_11 = "correcto";
   } elseif ($respuesta_11 === '') {
       $verificar_11 = '';
   } else {
       $verificar_11 = "incorrecto";
   }


     // Verificar la respuesta de la primera pregunta
     $respuesta_12 = isset($_POST['respuesta_12']) ? $_POST['respuesta_12'] : '';
     if ($respuesta_12 === 'cantidad') {  
         $verificar_12 = "correcto";
     } elseif ($respuesta_12 === '') {
         $verificar_12 = '';
     } else {
         $verificar_12 = "incorrecto";
     }
  
     // Verificar la respuesta de la segunda pregunta
     $respuesta_13 = isset($_POST['respuesta_13']) ? $_POST['respuesta_13'] : '';
     if ($respuesta_13 === 'operaciones') { 
         $verificar_13 = "correcto";
     } elseif ($respuesta_13 === '') {
         $verificar_13 = '';
     } else {
         $verificar_13 = "incorrecto";
     }
  
     // Verificar la respuesta de la tercera pregunta
     $respuesta_14 = isset($_POST['respuesta_14']) ? $_POST['respuesta_14'] : '';
     if ($respuesta_14 === 'realiza') {  
         $verificar_14 = "correcto";
     } elseif ($respuesta_14 === '') {
         $verificar_14 = '';
     } else {
         $verificar_14 = "incorrecto";
     }
  
     // Verificar la respuesta de la cuarta pregunta
     $respuesta_15 = isset($_POST['respuesta_15']) ? $_POST['respuesta_15'] : '';
     if ($respuesta_15 === 'entrada') { 
         $verificar_15 = "correcto";
     } elseif ($respuesta_15 === '') {
         $verificar_15 = '';
     } else {
         $verificar_15 = "incorrecto";
     }
  
     // Verificar la respuesta de la quinta pregunta
     $respuesta_16 = isset($_POST['respuesta_16']) ? $_POST['respuesta_16'] : '';
     if ($respuesta_16 === 'tamaño') {  
         $verificar_16 = "correcto";
     } elseif ($respuesta_16 === '') {
         $verificar_16 = '';
     } else {
         $verificar_16 = "incorrecto";
     }
  
     // Verificar la respuesta de la sexta pregunta
     $respuesta_17 = isset($_POST['respuesta_17']) ? $_POST['respuesta_17'] : '';
     if ($respuesta_17 === 'comparacion') {  
         $verificar_17 = "correcto";
     } elseif ($respuesta_17 === '') {
         $verificar_17 = '';
     } else {
         $verificar_17 = "incorrecto";
     }
  
     // Verificar la respuesta de la séptima pregunta
     $respuesta_18 = isset($_POST['respuesta_18']) ? $_POST['respuesta_18'] : '';
     if ($respuesta_18 === 'operaciones') {  
         $verificar_18 = "correcto";
     } elseif ($respuesta_18 === '') {
         $verificar_18 = '';
     } else {
         $verificar_18 = "incorrecto";
     }
  
     // Verificar la respuesta de la octava pregunta
     $respuesta_19 = isset($_POST['respuesta_19']) ? $_POST['respuesta_19'] : '';
     $respuesta_19_dos = str_replace(' ','',$respuesta_19);
     if ($respuesta_19_dos === 'i\leqn') {  
         $verificar_19 = "correcto";
     } elseif ($respuesta_19_dos === '') {
         $verificar_19 = '';
     } else {
         $verificar_19 = "incorrecto";
     }
  
     // Verificar la respuesta de la novena pregunta
     $respuesta_20 = isset($_POST['respuesta_20']) ? $_POST['respuesta_20'] : '';
     if ($respuesta_20 === 'maximo') {  
         $verificar_20 = "correcto";
     } elseif ($respuesta_20 === '') {
         $verificar_20 = '';
     } else {
         $verificar_20 = "incorrecto";
     }
  
     // Verificar la respuesta de la décima pregunta
     $respuesta_21 = isset($_POST['respuesta_21']) ? $_POST['respuesta_21'] : '';
     if ($respuesta_21 === 'maximo') {  
         $verificar_21 = "correcto";
     } elseif ($respuesta_21 === '') {
         $verificar_21 = '';
     } else {
         $verificar_21 = "incorrecto";
     }
  
     // Verificar la respuesta de la undécima pregunta
     $respuesta_22 = isset($_POST['respuesta_22']) ? $_POST['respuesta_22'] : '';
     if ($respuesta_22 === 'if max < a_i then'
     || $respuesta_22 === 'if max < ai then'
      || $respuesta_22 === 'if max < aᵢ then'
     ) {  
         $verificar_22 = "correcto";
     } elseif ($respuesta_22 === '') {
         $verificar_22 = '';
     } else {
         $verificar_22 = "incorrecto";
     }

     // Verificar la respuesta de la primera pregunta
    $respuesta_23 = isset($_POST['respuesta_23']) ? $_POST['respuesta_23'] : '';
    $respuesta_23_dos = str_replace(' ','',$respuesta_23);
   if ($respuesta_23_dos === 'n-1') {  
       $verificar_23 = "correcto";
   } elseif ($respuesta_23_dos === '') {
       $verificar_23 = '';
   } else {
       $verificar_23 = "incorrecto";
   }

   // Verificar la respuesta de la segunda pregunta
   $respuesta_24 = isset($_POST['respuesta_24']) ? $_POST['respuesta_24'] : '';
   if ($respuesta_24 === '2 comparaciones') {  
       $verificar_24 = "correcto";
   } elseif ($respuesta_24 === '') {
       $verificar_24 = '';
   } else {
       $verificar_24 = "incorrecto";
   }

   // Verificar la respuesta de la tercera pregunta
   $respuesta_25 = isset($_POST['respuesta_25']) ? $_POST['respuesta_25'] : '';
   $respuesta_25_dos = str_replace(' ','',$respuesta_25);

   if ($respuesta_25_dos === '2(n-1)') { 
       $verificar_25 = "correcto";
   } elseif ($respuesta_25_dos === '') {
       $verificar_25 = '';
   } else {
       $verificar_25 = "incorrecto";
   }

   // Verificar la respuesta de la cuarta pregunta
   $respuesta_26 = isset($_POST['respuesta_26']) ? $_POST['respuesta_26'] : '';
   $respuesta_26_dos = str_replace(' ','',$respuesta_26);
   if ($respuesta_26_dos === 'n+1') {  
       $verificar_26 = "correcto";
   } elseif ($respuesta_26_dos === '') {
       $verificar_26 = '';
   } else {
       $verificar_26 = "incorrecto";
   }

   // Verificar la respuesta de la quinta pregunta
   $respuesta_27 = isset($_POST['respuesta_27']) ? $_POST['respuesta_27'] : '';
   $respuesta_27_dos = str_replace(' ','',$respuesta_27);
   if ($respuesta_27 === '2(n-1)+1') {  
       $verificar_27 = "correcto";
   } elseif ($respuesta_27 === '') {
       $verificar_27 = '';
   } else {
       $verificar_27 = "incorrecto";
   }

   // Verificar la respuesta de la sexta pregunta
   $respuesta_28 = isset($_POST['respuesta_28']) ? $_POST['respuesta_28'] : '';
   $respuesta_28_dos = str_replace(' ','',$respuesta_28);

   if ($respuesta_28 === '2n-1') {  
       $verificar_28 = "correcto";
   } elseif ($respuesta_28 === '') {
       $verificar_28 = '';
   } else {
       $verificar_28 = "incorrecto";
   }

   // Verificar la respuesta de la séptima pregunta
   $respuesta_29 = isset($_POST['respuesta_29']) ? $_POST['respuesta_29'] : '';
   if ($respuesta_29 === 'i \leq n') {  
       $verificar_29 = "correcto";
   } elseif ($respuesta_29 === '') {
       $verificar_29 = '';
   } else {
       $verificar_29 = "incorrecto";
   }

   // Verificar la respuesta de la octava pregunta
   $respuesta_30 = isset($_POST['respuesta_30']) ? $_POST['respuesta_30'] : '';
   if ($respuesta_30 === 'x \neq a_1') {  
       $verificar_30 = "correcto";
   } elseif ($respuesta_30 === '') {
       $verificar_30 = '';
   } else {
       $verificar_30 = "incorrecto";
   }

   // Verificar la respuesta de la novena pregunta
   $respuesta_31 = isset($_POST['respuesta_31']) ? $_POST['respuesta_31'] : '';
   if ($respuesta_31 === '2') {  
       $verificar_31 = "correcto";
   } elseif ($respuesta_31 === '') {
       $verificar_31 = '';
   } else {
       $verificar_31 = "incorrecto";
   }

   // Verificar la respuesta de la décima pregunta
   $respuesta_32 = isset($_POST['respuesta_32']) ? $_POST['respuesta_32'] : '';
   if ($respuesta_32 === 'dentro') {  
       $verificar_32 = "correcto";
   } elseif ($respuesta_32 === '') {
       $verificar_32 = '';
   } else {
       $verificar_32 = "incorrecto";
   }

   // Verificar la respuesta de la undécima pregunta
   $respuesta_33 = isset($_POST['respuesta_33']) ? $_POST['respuesta_33'] : '';
   if ($respuesta_33 === '1') {  
       $verificar_33 = "correcto";
   } elseif ($respuesta_33 === '') {
       $verificar_33 = '';
   } else {
       $verificar_33 = "incorrecto";
   }

 $respuesta_34 = isset($_POST['respuesta_34']) ? $_POST['respuesta_34'] : '';
if ($respuesta_34 === 'fuera') { 
    $verificar_34 = "correcto";
} elseif ($respuesta_34 === '') {
    $verificar_34 = '';
} else {
    $verificar_34 = "incorrecto";
}

 $respuesta_35 = isset($_POST['respuesta_35']) ? $_POST['respuesta_35'] : '';
 $respuesta_35_dos = str_replace(' ','',$respuesta_35);
if ($respuesta_35_dos === 'i\leqn') { 
    $verificar_35 = "correcto";
} elseif ($respuesta_35_dos === '') {
    $verificar_35 = '';
} else {
    $verificar_35 = "incorrecto";
}

 $respuesta_36 = isset($_POST['respuesta_36']) ? $_POST['respuesta_36'] : '';
if ($respuesta_36 === 'fuera') { 
    $verificar_36 = "correcto";
} elseif ($respuesta_36 === '') {
    $verificar_36 = '';
} else {
    $verificar_36 = "incorrecto";
}

 $respuesta_37 = isset($_POST['respuesta_37']) ? $_POST['respuesta_37'] : '';
if ($respuesta_37 === '2n') { 
    $verificar_37 = "correcto";
} elseif ($respuesta_37 === '') {
    $verificar_37 = '';
} else {
    $verificar_37 = "incorrecto";
}

 $respuesta_38 = isset($_POST['respuesta_38']) ? $_POST['respuesta_38'] : '';
if ($respuesta_38 === '1') { 
    $verificar_38 = "correcto";
} elseif ($respuesta_38 === '') {
    $verificar_38 = '';
} else {
    $verificar_38 = "incorrecto";
}

 $respuesta_39 = isset($_POST['respuesta_39']) ? $_POST['respuesta_39'] : '';
 $respuesta_39_dos = str_replace(' ','',$respuesta_39);
if ($respuesta_39_dos === '2n+2') { 
    $verificar_39 = "correcto";
} elseif ($respuesta_39_dos === '') {
    $verificar_39 = '';
} else {
    $verificar_39 = "incorrecto";
}

 $respuesta_40 = isset($_POST['respuesta_40']) ? $_POST['respuesta_40'] : '';
if ($respuesta_40 === 'divide') { 
    $verificar_40 = "correcto";
} elseif ($respuesta_40 === '') {
    $verificar_40 = '';
} else {
    $verificar_40 = "incorrecto";
}

 $respuesta_41 = isset($_POST['respuesta_41']) ? $_POST['respuesta_41'] : '';
if ($respuesta_41 === 'mitad') { 
    $verificar_41 = "correcto";
} elseif ($respuesta_41 === '') {
    $verificar_41 = '';
} else {
    $verificar_41 = "incorrecto";
}

 $respuesta_42 = isset($_POST['respuesta_42']) ? $_POST['respuesta_42'] : '';
if ($respuesta_42 === 'potencias') { 
    $verificar_42 = "correcto";
} elseif ($respuesta_42 === '') {
    $verificar_42 = '';
} else {
    $verificar_42 = "incorrecto";
}

 $respuesta_43 = isset($_POST['respuesta_43']) ? $_POST['respuesta_43'] : '';
if ($respuesta_43 === '2') { 
    $verificar_43 = "correcto";
} elseif ($respuesta_43 === '') {
    $verificar_43 = '';
} else {
    $verificar_43 = "incorrecto";
}

 $respuesta_44 = isset($_POST['respuesta_44']) ? $_POST['respuesta_44'] : '';
if ($respuesta_44 === '2^k') { 
    $verificar_44 = "correcto";
} elseif ($respuesta_44 === '') {
    $verificar_44 = '';
} else {
    $verificar_44 = "incorrecto";
}

 $respuesta_44_dos = isset($_POST['respuesta_44_dos']) ? $_POST['respuesta_44_dos'] : '';
if ($respuesta_44_dos === 'lista') { 
    $verificar_44_dos = "correcto";
} elseif ($respuesta_44_dos === '') {
    $verificar_44_dos = '';
} else {
    $verificar_44_dos= "incorrecto";
}


 $respuesta_45 = isset($_POST['respuesta_45']) ? $_POST['respuesta_45'] : '';
 $respuesta_45_dos = str_replace(' ','', $respuesta_45);

if ($respuesta_45_dos === 'logn') { 
    $verificar_45 = "correcto";
} elseif ($respuesta_45_dos === '') {
    $verificar_45 = '';
} else {
    $verificar_45 = "incorrecto";
}

 $respuesta_46 = isset($_POST['respuesta_46']) ? $_POST['respuesta_46'] : '';
if ($respuesta_46 === 'i') { 
    $verificar_46 = "correcto";
} elseif ($respuesta_46 === '') {
    $verificar_46 = '';
} else {
    $verificar_46 = "incorrecto";
}

 $respuesta_47 = isset($_POST['respuesta_47']) ? $_POST['respuesta_47'] : '';
if ($respuesta_47 === 'j') { 
    $verificar_47 = "correcto";
} elseif ($respuesta_47 === '') {
    $verificar_47 = '';
} else {
    $verificar_47 = "incorrecto";
}

 $respuesta_48 = isset($_POST['respuesta_48']) ? $_POST['respuesta_48'] : '';
if ($respuesta_48 === 'contiene') { 
    $verificar_48 = "correcto";
} elseif ($respuesta_48 === '') {
    $verificar_48 = '';
} else {
    $verificar_48 = "incorrecto";
}

 $respuesta_49 = isset($_POST['respuesta_49']) ? $_POST['respuesta_49'] : '';
 $respuesta_49_dos = str_replace(' ','', $respuesta_49);
if ($respuesta_49_dos === 'i<j') { 
    $verificar_49 = "correcto";
} elseif ($respuesta_49_dos === '') {
    $verificar_49 = '';
} else {
    $verificar_49 = "incorrecto";
}

 $respuesta_50 = isset($_POST['respuesta_50']) ? $_POST['respuesta_50'] : '';
if ($respuesta_50 === 'continuar') { 
    $verificar_50 = "correcto";
} elseif ($respuesta_50 === '') {
    $verificar_50 = '';
} else {
    $verificar_50 = "incorrecto";
}

 $respuesta_51 = isset($_POST['respuesta_51']) ? $_POST['respuesta_51'] : '';
if ($respuesta_51 === 'dividir') { 
    $verificar_51 = "correcto";
} elseif ($respuesta_51 === '') {
    $verificar_51 = '';
} else {
    $verificar_51 = "incorrecto";
}

 $respuesta_52 = isset($_POST['respuesta_52']) ? $_POST['respuesta_52'] : '';
if ($respuesta_52 === '2^k') { 
    $verificar_52 = "correcto";
} elseif ($respuesta_52 === '') {
    $verificar_52 = '';
} else {
    $verificar_52 = "incorrecto";
}

 $respuesta_53 = isset($_POST['respuesta_53']) ? $_POST['respuesta_53'] : '';
if ($respuesta_53 === '2') { 
    $verificar_53 = "correcto";
} elseif ($respuesta_53 === '') {
    $verificar_53 = '';
} else {
    $verificar_53 = "incorrecto";
}

 $respuesta_54 = isset($_POST['respuesta_54']) ? $_POST['respuesta_54'] : '';
if ($respuesta_54 === '2^{k-1}') { 
    $verificar_54 = "correcto";
} elseif ($respuesta_54 === '') {
    $verificar_54 = '';
} else {
    $verificar_54 = "incorrecto";
}

 $respuesta_55 = isset($_POST['respuesta_55']) ? $_POST['respuesta_55'] : '';
if ($respuesta_55 === '2') { 
    $verificar_55 = "correcto";
} elseif ($respuesta_55 === '') {
    $verificar_55 = '';
} else {
    $verificar_55 = "incorrecto";
}


 $respuesta_56 = isset($_POST['respuesta_56']) ? $_POST['respuesta_56'] : '';
if ($respuesta_56 === '2') { 
    $verificar_56 = "correcto";
} elseif ($respuesta_56 === '') {
    $verificar_56 = '';
} else {
    $verificar_56 = "incorrecto";
}

 $respuesta_57 = isset($_POST['respuesta_57']) ? $_POST['respuesta_57'] : '';
if ($respuesta_57 === '2') { 
    $verificar_57 = "correcto";
} elseif ($respuesta_57 === '') {
    $verificar_57 = '';
} else {
    $verificar_57 = "incorrecto";
}

 $respuesta_58 = isset($_POST['respuesta_58']) ? $_POST['respuesta_58'] : '';
  $respuesta_58_dos = str_replace(' ', '',  $respuesta_58);
if ($respuesta_58_dos === 'logn') { 
    $verificar_58 = "correcto";
} elseif ($respuesta_58_dos === '') {
    $verificar_58 = '';
} else {
    $verificar_58 = "incorrecto";
}

 $respuesta_59 = isset($_POST['respuesta_59']) ? $_POST['respuesta_59'] : '';
  $respuesta_59_dos = str_replace(' ', '',  $respuesta_59);
if ($respuesta_59_dos === '2logn+2') { 
    $verificar_59 = "correcto";
} elseif ($respuesta_59_dos === '') {
    $verificar_59 = '';
} else {
    $verificar_59 = "incorrecto";
}

 $respuesta_60 = isset($_POST['respuesta_60']) ? $_POST['respuesta_60'] : '';
if ($respuesta_60 === '2^k') { 
    $verificar_60 = "correcto";
} elseif ($respuesta_60 === '') {
    $verificar_60 = '';
} else {
    $verificar_60 = "incorrecto";
}

 $respuesta_61 = isset($_POST['respuesta_61']) ? $_POST['respuesta_61'] : '';
   $respuesta_61_dos = str_replace(' ', '',  $respuesta_61);

if ($respuesta_61_dos === '2logn+2') { 
    $verificar_61 = "correcto";
} elseif ($respuesta_61_dos === '') {
    $verificar_61 = '';
} else {
    $verificar_61 = "incorrecto";
}

 $respuesta_62 = isset($_POST['respuesta_62']) ? $_POST['respuesta_62'] : '';
if ($respuesta_62 === '2^{k+1}') { 
    $verificar_62 = "correcto";
} elseif ($respuesta_62 === '') {
    $verificar_62 = '';
} else {
    $verificar_62 = "incorrecto";
}

 $respuesta_63 = isset($_POST['respuesta_63']) ? $_POST['respuesta_63'] : '';
   $respuesta_63_dos = str_replace(' ', '',  $respuesta_63);

if ($respuesta_63_dos === '\lfloor\logn\rfloor') { 
    $verificar_63 = "correcto";
} elseif ($respuesta_63_dos === '') {
    $verificar_63 = '';
} else {
    $verificar_63 = "incorrecto";
}

    $respuesta_64 = isset($_POST['respuesta_64']) ? $_POST['respuesta_64'] : '';
    $respuesta_64_dos = str_replace(' ', '',  $respuesta_64);
    if ($respuesta_64_dos === 'logn') { 
        $verificar_64 = "correcto";
    } elseif ($respuesta_64_dos === '') {
        $verificar_64 = '';
    } else {
    $verificar_64 = "incorrecto";
    }

 $respuesta_65 = isset($_POST['respuesta_65']) ? $_POST['respuesta_65'] : '';
if ($respuesta_65 === '2^k') { 
    $verificar_65 = "correcto";
} elseif ($respuesta_65 === '') {
    $verificar_65 = '';
} else {
    $verificar_65 = "incorrecto";
}

 $respuesta_66 = isset($_POST['respuesta_66']) ? $_POST['respuesta_66'] : '';
if ($respuesta_66 === '\frac{n}{2^k}') { 
    $verificar_66 = "correcto";
} elseif ($respuesta_66 === '') {
    $verificar_66 = '';
} else {
    $verificar_66 = "incorrecto";
}

 $respuesta_67 = isset($_POST['respuesta_67']) ? $_POST['respuesta_67'] : '';
   $respuesta_67_dos = str_replace(' ', '',  $respuesta_67);

if ($respuesta_67_dos === '\frac{n}{2^k}=1') { 
    $verificar_67 = "correcto";
} elseif ($respuesta_67_dos === '') {
    $verificar_67 = '';
} else {
    $verificar_67 = "incorrecto";
}

 $respuesta_68 = isset($_POST['respuesta_68']) ? $_POST['respuesta_68'] : '';
if ($respuesta_68 === 'posibles') { 
    $verificar_68 = "correcto";
} elseif ($respuesta_68 === '') {
    $verificar_68 = '';
} else {
    $verificar_68 = "incorrecto";
}

 $respuesta_69 = isset($_POST['respuesta_69']) ? $_POST['respuesta_69'] : '';
if ($respuesta_69 === 'complicado') { 
    $verificar_69 = "correcto";
} elseif ($respuesta_69 === '') {
    $verificar_69 = '';
} else {
    $verificar_69 = "incorrecto";
}

 $respuesta_70 = isset($_POST['respuesta_70']) ? $_POST['respuesta_70'] : '';
if ($respuesta_70 === 'n') { 
    $verificar_70 = "correcto";
} elseif ($respuesta_70 === '') {
    $verificar_70 = '';
} else {
    $verificar_70 = "incorrecto";
}

 $respuesta_71 = isset($_POST['respuesta_71']) ? $_POST['respuesta_71'] : '';
if ($respuesta_71 === '2') { 
    $verificar_71 = "correcto";
} elseif ($respuesta_71 === '') {
    $verificar_71 = '';
} else {
    $verificar_71 = "incorrecto";
}

 $respuesta_72 = isset($_POST['respuesta_72']) ? $_POST['respuesta_72'] : '';
if ($respuesta_72 === '5' || $respuesta_72 === 'cinco') { 
    $verificar_72 = "correcto";
} elseif ($respuesta_72 === '') {
    $verificar_72 = '';
} else {
    $verificar_72 = "incorrecto";
}

 $respuesta_73 = isset($_POST['respuesta_73']) ? $_POST['respuesta_73'] : '';
if ($respuesta_73 === '2' || $respuesta_73 === 'dos') { 
    $verificar_73 = "correcto";
} elseif ($respuesta_73 === '') {
    $verificar_73 = '';
} else {
    $verificar_73 = "incorrecto";
}

 $respuesta_74 = isset($_POST['respuesta_74']) ? $_POST['respuesta_74'] : '';
if ($respuesta_74 === 'una' || $respuesta_74 === '1') { 
    $verificar_74 = "correcto";
} elseif ($respuesta_74 === '') {
    $verificar_74 = '';
} else {
    $verificar_74 = "incorrecto";
}

 $respuesta_75 = isset($_POST['respuesta_75']) ? $_POST['respuesta_75'] : '';
if ($respuesta_75 === '2i+1') { 
    $verificar_75 = "correcto";
} elseif ($respuesta_75 === '') {
    $verificar_75 = '';
} else {
    $verificar_75 = "incorrecto";
}

 $respuesta_76 = isset($_POST['respuesta_76']) ? $_POST['respuesta_76'] : '';
 $respuesta_76_dos = str_replace(' ', '',  $respuesta_76);
if ($respuesta_76_dos === '\sum_{i=1}^{n}(2i+1)'
|| $respuesta_76_dos === '\sum_{i=1}^n(2i+1)'
) { 
    $verificar_76 = "correcto";
} elseif ($respuesta_76_dos === '') {
    $verificar_76 = '';
} else {
    $verificar_76 = "incorrecto";
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
    .imagen {
        max-width: 100%;
        height: auto;
    }
    .seccion {
    width: 50%; /* El 50% del ancho de la página menos el margen izquierdo */
    padding: 20px; /* importante este padding*/
    box-sizing: border-box;
    height: 475vh;
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
    })
    .catch(error => {
        console.error('Error al enviar el formulario:', error);
    });
}

function actualizarFormula() {
    // Obtener los valores de los inputs
   
    var f = document.getElementById('respuesta_19').value || "";
 


    // Construir la fórmula dinámica
    var formula = ` \\  ${f} \\, `;

    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}
 

function actualizarFormula2() {
    // Obtener los valores de los inputs
   
    var f = document.getElementById('respuesta_19').value || "";
  
    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;

    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula2').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}



function actualizarFormula3() {
    // Obtener los valores de los inputs
   
    var f = document.getElementById('respuesta_29').value || "";
 


    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;

    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula3').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula4() {
    // Obtener los valores de los inputs
    var f = document.getElementById('respuesta_30').value || "";
   

    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula4').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}


function actualizarFormula5() {
    // Obtener los valores de los inputs
    var f = document.getElementById('respuesta_29').value || "";
  

    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula5').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}



function actualizarFormula6() {
    // Obtener los valores de los inputs
    var f = document.getElementById('respuesta_30').value || "";
  

    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula6').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}


function actualizarFormula7() {
    // Obtener los valores de los inputs
    var f = document.getElementById('respuesta_35').value || "";
  

    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula7').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula8() {
    // Obtener los valores de los inputs
    var f = document.getElementById('respuesta_44').value || "";
  

    // Construir la fórmula dinámica
    var formula = ` \\ n = ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula8').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}


function actualizarFormula9() {
    // Obtener los valores de los inputs
    var f = document.getElementById('respuesta_52').value || "";
  

    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula9').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}



function actualizarFormula10() {
    // Obtener los valores de los inputs
    var f = document.getElementById('respuesta_54').value || "";
  

    // Construir la fórmula dinámica
    var formula = ` \\ ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula10').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}


function actualizarFormula11() {
    // Obtener los valores de los inputs
    var f = document.getElementById('respuesta_60').value || "";
  

    // Construir la fórmula dinámica
    var formula = ` \\ n = ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula11').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}


function actualizarFormula12() {
    // Obtener los valores de los inputs
    var f = document.getElementById('respuesta_62').value || "";
  

    // Construir la fórmula dinámica
    var formula = ` \\  ${f}  \\, `;
    // Actualizar el contenido de la fórmula en el DOM
    document.getElementById('formula12').innerHTML = `\\( ${formula} \\)`;

    // Re-renderizar MathJax para mostrar los cambios
    if (window.MathJax) {
        MathJax.typeset();
    }
}



function actualizarFormula13() {
    var f = document.getElementById('respuesta_63').value || "";
    var formula = ` \\ k = ${f} \\, `;
    document.getElementById('formula13').innerHTML = `\\( ${formula} \\)`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula14() {
    var f = document.getElementById('respuesta_65').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula14').innerHTML = `\\( ${formula} \\)`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula15() {
    var f = document.getElementById('respuesta_66').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula15').innerHTML = `\\( ${formula} \\)`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula16() {
    var f = document.getElementById('respuesta_67').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula16').innerHTML = `$$ ${formula} $$`;
    if (window.MathJax) {
        MathJax.typeset();
    }
}

function actualizarFormula17() {
    var f = document.getElementById('respuesta_76').value || "";
    var formula = ` \\ ${f} \\, `;
    document.getElementById('formula17').innerHTML = `$$ ${formula} $$`;
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
<form action="./segundo.php" method="POST" onsubmit="handleSubmit(event)" autocomplete="off"> 
<div class="form-container">

    
<div class="seccion izquierda"> 
     
<h3> ALGORITMO 3: El Algoritmo de Búsqueda Binaria</h3>
    <pre>
    procedure binary_search(x: entero, a₁, a₂,… , aₙ: enteros en orden creciente)
        i := 1     {i es el extremo izquierdo del intervalo de búsqueda}
        j := n     {j es el extremo derecho del intervalo de búsqueda}
        while i < j
            m := ⌊(i + j) / 2⌋
            if x > aₘ then i := m + 1
            else j := m
        if x = aᵢ then location := i
        else location := 0
        return location
        {location es el subíndice i del término aᵢ igual a x, o 0 si x no se encuentra}
  </pre>

     <h3> EJEMPLO 3: Complejidad Temporal de la Búsqueda Binaria</h3>

  <div class="highlight">
    <strong>Descripción:</strong> Vamos a describir la complejidad temporal del algoritmo de búsqueda 
    binaria en términos del número de comparaciones utilizadas (ignorando el tiempo que toma calcular 
    m = ⌊(i + j)/2⌋ en cada iteración del bucle).
  </div>

    <p>
    La búsqueda binaria
   <input type="text" name="respuesta_40" value="<?php echo $respuesta_40; ?>" size="8"> 
    la lista a la 
    <input type="text" name="respuesta_41" value="<?php echo $respuesta_41; ?>" size="8"> 
    en cada paso, así que su comportamiento natural
    está ligado a 
    <input type="text" name="respuesta_42" value="<?php echo $respuesta_42; ?>" size="8"> 
    de 
    <input type="text" name="respuesta_43" value="<?php echo $respuesta_43; ?>" size="8"> 
    .
    </p>

    <h4> Suposición inicial:</h4>
    <p>Entonces, para simplificar, se supone que hay 
     
 <span id="formula8">
        \(  n =  \)
    </span>      
    <input type="text"  id="respuesta_44" name="respuesta_44"  value="<?php echo $respuesta_44; ?>" 
    oninput="actualizarFormula8()"
    size="9" >

    elementos en la 
    <input type="text" name="respuesta_44_dos" value="<?php echo $respuesta_44_dos; ?>" size="8"> 
    a₁, a₂, ..., aₙ, donde <strong>k</strong> es un entero no negativo. Observa que 
    <strong>k = </strong>
    <input type="text" name="respuesta_45" value="<?php echo $respuesta_45; ?>" size="8">
    .</p>




    <button onmousedown="mostrarMensaje2()" onmouseup="ocultarMensaje2()">aclaracion</button>
    <div id="mensaje2" style="display: none; margin-top: 10px; padding: 10px; background-color: #f0f0f0;">
    <p>(Si n no es una potencia de 2, se puede imaginar como parte de una lista más grande con 
    <strong>2<sup>k+1</sup></strong> elementos, donde <strong>2<sup>k</sup> &lt; n &lt; 2<sup>k+1</sup></strong>. 
    Aquí, <strong>2<sup>k+1</sup></strong> es la menor potencia de 2 mayor que n).</p>
    </div>

    <h4> ¿Qué sucede en cada etapa?</h4>
    <ul>
    <li>Se comparan las posiciones 
    <input type="text" name="respuesta_46" value="<?php echo $respuesta_46; ?>" size="8"> y 
    <input type="text" name="respuesta_47" value="<?php echo $respuesta_47; ?>" size="8">   
    para ver si el intervalo aún 
    <input type="text" name="respuesta_48" value="<?php echo $respuesta_48; ?>" size="8"> 
    más de un elemento.</li>
    <li>Si 
    <input type="text" name="respuesta_49" value="<?php echo $respuesta_49; ?>" size="8">    
    , se hace una comparación para ver si <strong>x &gt; aₘ</strong>, 
    donde m es el índice medio.</li>
    <li>Entonces, se hacen <strong>dos comparaciones por etapa</strong>: una para decidir si 
    <input type="text" name="respuesta_50" value="<?php echo $respuesta_50; ?>" size="8">
    , 
    otra para decidir cómo 
    <input type="text" name="respuesta_51" value="<?php echo $respuesta_51; ?>" size="8">
    .</li>
    </ul>

    <button onmousedown="mostrarMensaje4()" onmouseup="ocultarMensaje4()">aclaracion</button>
    <div id="mensaje4" style="display: none; margin-top: 10px; padding: 10px; background-color: #f0f0f0;">
     <img src="../../../../img/guia_471.png" alt="">
    </div>
    <button type="submit">Enviar</button>
<?php echo $verificar_40 ?>
<?php echo $verificar_41 ?>
<?php echo $verificar_42 ?>
<?php echo $verificar_43 ?>
<?php echo $verificar_44 ?>
<?php echo $verificar_44_dos ?>
 <?php echo $verificar_45 ?>
        <?php echo $verificar_46 ?>
        <?php echo $verificar_47 ?>
        <?php echo $verificar_48 ?>
        <?php echo $verificar_49 ?>
        <?php echo $verificar_50 ?>
        <?php echo $verificar_51 ?>


<hr>
    <h4> Progreso del algoritmo:</h4>
    <ul>
    <li>Primera etapa: lista de 
     <span id="formula9">
        \(   \)
    </span>      
    <input type="text"  id="respuesta_52" name="respuesta_52"  value="<?php echo $respuesta_52; ?>" 
    oninput="actualizarFormula9()"
    size="9" >    
    elementos → 
    <input type="text" name="respuesta_53" value="<?php echo $respuesta_53; ?>" size="8">
    comparaciones.</li>
    <li>Segunda etapa: se reduce a 
    <span id="formula10">
        \(   \)
    </span>      
    <input type="text"  id="respuesta_54" name="respuesta_54"  value="<?php echo $respuesta_54; ?>" 
    oninput="actualizarFormula10()"
    size="9" >        
    elementos → 
    <input type="text" name="respuesta_55" value="<?php echo $respuesta_55; ?>" size="8">
    comparaciones más.</li>
    <li>... y así sucesivamente.</li>
    <li>Cuando quedan solo 2 elementos → 
    <input type="text" name="respuesta_56" value="<?php echo $respuesta_56; ?>" size="8">    
    comparaciones.</li>
    <li>Finalmente, queda 1 término → se hacen 
    <input type="text" name="respuesta_57" value="<?php echo $respuesta_57; ?>" size="8">    
    comparaciones más.</li>
    </ul>

    <h4> Total de comparaciones:</h4>
    <p>Se hacen 2 comparaciones por cada etapa, y hay <strong>k = </strong> 
    <input type="text" name="respuesta_58" value="<?php echo $respuesta_58; ?>" size="8"> 
    etapas, más 2 comparaciones finales. Entonces:</p>
    <p><strong>Total = 
    <input type="text" name="respuesta_59" value="<?php echo $respuesta_59; ?>" size="8">    
    </strong></p>
    
    
   <h4>Conclusión:</h4>
    <ul>
    <li>Si la lista tiene \( n \) elementos y  
    <span id="formula11">
        \(  n =  \)
    </span>      
    <input type="text"  id="respuesta_60" name="respuesta_60"  value="<?php echo $respuesta_60; ?>" 
    oninput="actualizarFormula11()"
    size="9" >   
    , se requieren a lo sumo 
    <input type="text" name="respuesta_61" value="<?php echo $respuesta_61; ?>" size="8">
    comparaciones.</li>
    <li>Si \( n \) no es potencia de 2, se extiende a una lista de 
    
    <span id="formula12">
        \(   \)
    </span>      
    <input type="text"  id="respuesta_62" name="respuesta_62"  value="<?php echo $respuesta_62; ?>" 
    oninput="actualizarFormula12()"
    size="9" >   


    , con  
    
    
    <span id="formula13">
        \(  k =  \)
    </span>      
    <input type="text"  id="respuesta_63" name="respuesta_63"  value="<?php echo $respuesta_63; ?>" 
    oninput="actualizarFormula13()"
    size="15" >
    
    
    , y se requieren como máximo \( 2 \lceil \log_2 n \rceil + 2 \) comparaciones.</li>
    <li>En cualquier caso, el peor caso requiere \( O( \) 
    <input type="text" name="respuesta_64" value="<?php echo $respuesta_64; ?>" size="8">    
    \( ) \) comparaciones.</li>
    <li>Como el número de comparaciones también es al menos proporcional a \( \log n \), se concluye que:</li>
</ul>



    <button onmousedown="mostrarMensaje3()" onmouseup="ocultarMensaje3()">conclusion</button>
    <div id="mensaje3" style="display: none; margin-top: 10px; padding: 10px; background-color: #f0f0f0;">
    <p><strong>La búsqueda binaria tiene complejidad Θ(log n) en el peor caso.</strong></p>

    <h3> Comparación:</h3>
    <p>Este resultado muestra que, en el peor caso, la búsqueda binaria es más eficiente que la búsqueda lineal,
    que tenía complejidad <strong>Θ(n)</strong> según el Ejemplo 2.</p>
    <hr>
    Mas que cuantas comparaciones se hacen por cada etapa, lo que interesa es cuantas etapas son,
    por eso despejamos el exponente.

    </div>
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
<?php echo $verificar_61 ?>
<?php echo $verificar_62 ?>
<?php echo $verificar_63 ?>
<?php echo $verificar_64 ?>
<hr>
    <br>
 </div>




<div class="seccion derecha">
     
    <p>
      Se usa  
      <span id="formula14">
        \(   \)
    </span>      
    <input type="text"  id="respuesta_65" name="respuesta_65"  value="<?php echo $respuesta_65; ?>" 
    oninput="actualizarFormula14()"
    size="5" >
      
      porque la búsqueda binaria divide el espacio en dos partes iguales en cada etapa.
      Esa división por 2 en cada paso está en la naturaleza del algoritmo, por eso:
    </p>

    <p>
      <strong>Tamaño después de \( k \) pasos:</strong><br>
         <span id="formula15">
        \(   \)
    </span>      
    <input type="text"  id="respuesta_66" name="respuesta_66"  value="<?php echo $respuesta_66; ?>" 
    oninput="actualizarFormula15()"
    size="15" >

    </p>

    <p>
      Queremos saber cuántas veces puedo dividir por 2 hasta que me quede 1 solo elemento:
    </p>
    

    <span id="formula16">
        \(   \)
    </span>      
    <input type="text"  id="respuesta_67" name="respuesta_67"  value="<?php echo $respuesta_67; ?>" 
    oninput="actualizarFormula16()"
    size="15" >


    <p>
      \[
       \Rightarrow n = 2^k \Rightarrow k = \log_2 n
      \]
    </p>
 
<button type="submit">Enviar</button>
<?php echo $verificar_65 ?>
<?php echo $verificar_66 ?>
<?php echo $verificar_67 ?>
    <hr>

    <h3>COMPLEJIDAD EN EL CASO PROMEDIO</h3>

    <p>
    Otro tipo importante de análisis de complejidad, además del análisis del peor caso, es el llamado 
    <strong>análisis del caso promedio</strong>. En este tipo de análisis, se calcula el número   
    promedio de operaciones 
    utilizadas para resolver el problema considerando <em>todas las 
    <input type="text" name="respuesta_68" value="<?php echo $respuesta_68; ?>" size="8">    
    entradas de un tamaño dado</em>.
    </p>

    <p>
    El análisis de la complejidad temporal en el caso promedio suele ser 
    <strong>mucho más 
    <input type="text" name="respuesta_69" value="<?php echo $respuesta_69; ?>" size="8">     
    </strong> que el análisis del peor caso. 
    Sin embargo, el análisis del caso promedio para el 
    <strong>algoritmo de búsqueda lineal</strong> se puede hacer 
    <strong>sin dificultad</strong>, como se muestra en el Ejemplo 4.
    </p>


    <hr>
    En el caso de la búsqueda lineal, el peor caso y el caso promedio son ambos Θ(
    <input type="text" name="respuesta_70" value="<?php echo $respuesta_70; ?>" size="8">  
    ), pero no significan lo mismo,
    ni son siempre iguales en otros algoritmos.
    <br><br>
    <button type="submit">Enviar</button>
<?php echo $verificar_68 ?>
<?php echo $verificar_69 ?>
<?php echo $verificar_70 ?>
    <hr>

    <h2> EJEMPLO 4: Descripción del rendimiento promedio del algoritmo de búsqueda lineal</h2>

    <p><strong>Objetivo:</strong> Describir el comportamiento promedio del algoritmo de búsqueda lineal en
    términos del número promedio de comparaciones realizadas, <strong>asumiendo que el entero \(x\) está
    en la lista</strong> y que es <strong>igualmente probable que \(x\) esté en cualquier posición</strong>.</p>

    <h3> Solución:</h3>

    <p>Según la hipótesis, el entero \(x\) es uno de los elementos \(a_1, a_2, ..., a_n\) de la lista.</p>

    <ul>
    <li>Si \(x\) es el primer elemento \(a_1\):</li>
    <ul>
        <li>Se realizan <strong>tres comparaciones</strong>:
        <ol>
            <li>Una comparación \(i \leq n\) para saber si se ha llegado al final de la lista,</li>
            <li>Una comparación \(x \neq a_i\) para comparar \(x\) con el primer término,</li>
            <li>Una comparación \(i \leq n\) fuera del bucle.</li>
        </ol>
        </li>
    </ul>
    <li>Si \(x\) es el segundo elemento \(a_2\), se necesitan 
    <input type="text" name="respuesta_71" value="<?php echo $respuesta_71; ?>" size="8">     
    comparaciones más, haciendo un total de <strong>
    <input type="text" name="respuesta_72" value="<?php echo $respuesta_72; ?>" size="8">     
    comparaciones</strong>.</li>
    <li>En general, si \(x\) es el <em>i-ésimo</em> elemento \(a_i\):</li>
    <ul>
        <li>Se hacen <strong>
        <input type="text" name="respuesta_73" value="<?php echo $respuesta_73; ?>" size="8">     
        comparaciones por cada uno de los \(i\) pasos</strong> dentro del bucle,</li>
        <li>Más <strong>
        <input type="text" name="respuesta_74" value="<?php echo $respuesta_74; ?>" size="8">    
        comparación fuera del bucle</strong>,</li>
        <li>Para un total de:  
        <br><br>
         <input type="text" name="respuesta_75" value="<?php echo $respuesta_75; ?>" size="8"> comparaciones
        </li>
    </ul>
    </ul>
    </ul>
<button type="submit">Enviar</button>
<?php echo $verificar_71 ?>
<?php echo $verificar_72 ?>
<?php echo $verificar_73 ?>
<?php echo $verificar_74 ?>
<?php echo $verificar_75 ?>

    <hr>
 <h3> ¿Cuál es el número promedio de comparaciones?</h3>
    <h4> Paso 1: Expresamos la suma</h4>
<p>Queremos expresar:</p>
<p>\[
3 + 5 + 7 + \cdots + (2n + 1)
\]</p>

<p>Observa que:</p>
<p>\[
3 = 2(1) + 1,\quad 5 = 2(2) + 1,\quad 7 = 2(3) + 1,\quad \dots,\quad 2n + 1 = 2(n) + 1
\]</p>

<p>Así que:</p>
<p>\[
3 + 5 + 7 + \cdots + (2n + 1) =  
\]</p>

  <span id="formula17">
        \(   \)
    </span>      
    <input type="text"  id="respuesta_76" name="respuesta_76"  value="<?php echo $respuesta_76; ?>" 
    oninput="actualizarFormula17()"
    size="19" >
    <br><br>
    <button type="submit">Enviar</button>
<?php echo $verificar_76 ?>
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
        href="tercero.php"
        role="button"
        width="50px"
        height="50px"
    >Siguiente</a>
</div>
</body>
</html>
