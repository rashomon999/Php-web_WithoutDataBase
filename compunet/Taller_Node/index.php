<?php

// =========================================================
// ÚNICA FUENTE DE VERDAD: cada respuesta correcta se define UNA sola vez aquí.
// Se usa tanto para "mostrar_solucion" como para validar lo que llega por POST.
// =========================================================
$correctas = [
    1 => 'public async createVehicle(req: Request, res: Response) {',
    2 => 'const vehicle: VehicleDocument = await vehicleService.create(req.body as VehicleInput);',
    3 => 'return res.status(201).json(vehicle);',
    4 => 'return res.status(500).json({ message: "Error creating vehicle" });',

    // Tabla 13 (preguntas 5-11)
    5 => 'find();', 
    6 => 'find({ employeeId });', 
    7 => 'find({ employeeId, date });', 
    8 => 'find().limit(10).sort({ date: -1 });', 
    
    9 => 'const endDate = new Date();', 
    10 => 'const startDate = new Date();', 
    11 => 'startDate.setMonth(startDate.getMonth() - 1);',

    // Tabla 14 (preguntas 12-22)
    12 => 'return await SaleModel.find({', 
    13 => 'employeeId', 
    14 => 'saleDate: { $gte: startDate, $lte: endDate }', 
    15 => 'await', 
    16 => 'vehicleService',
    17 => 'async getSoldVehicles():Promise<VehicleDocument[]>{', 
    18 => 'return await VehicleModel.find({ isSold: true });', 19 => 'body', 20 => '140', 21 => '154', 22 => '168',

    // Tabla 15 (preguntas 23-33)
    23 => '30', 24 => '45', 25 => '60', 26 => '75', 27 => '90',
    28 => '105', 29 => '120', 30 => '135', 31 => '150', 32 => '165', 33 => '180',

    // Tabla 16 (preguntas 34-44)
    34 => '32', 35 => '48', 36 => '64', 37 => '80', 38 => '96',
    39 => '112', 40 => '128', 41 => '144', 42 => '160', 43 => '176', 44 => '192',

    // Tabla 17 (preguntas 45-55)
    45 => '34', 46 => '51', 47 => '68', 48 => '85', 49 => '102',
    50 => '119', 51 => '136', 52 => '153', 53 => '170', 54 => '187', 55 => '204',

    // Tabla 18 (preguntas 56-66)
    56 => '36', 57 => '54', 58 => '72', 59 => '90', 60 => '108',
    61 => '126', 62 => '144', 63 => '162', 64 => '180', 65 => '198', 66 => '216',

    // Tabla 19 (preguntas 67-77)
    67 => '38', 68 => '57', 69 => '76', 70 => '95', 71 => '114',
    72 => '133', 73 => '152', 74 => '171', 75 => '190', 76 => '209', 77 => '228',

    // Tabla 20 (preguntas 78-88)
    78 => '40', 79 => '60', 80 => '80', 81 => '100', 82 => '120',
    83 => '140', 84 => '160', 85 => '180', 86 => '200', 87 => '220', 88 => '240',

    // Tabla 21 (preguntas 89-99)
    89 => '42', 90 => '63', 91 => '84', 92 => '105', 93 => '126',
    94 => '147', 95 => '168', 96 => '189', 97 => '210', 98 => '231', 99 => '252',

    // Tabla 22 (preguntas 100-110)
    100 => '44', 101 => '66', 102 => '88', 103 => '110', 104 => '132',
    105 => '154', 106 => '176', 107 => '198', 108 => '220', 109 => '242', 110 => '264',

    // Tabla del 12 (preguntas 111-121)
    111 => '24', 112 => '36', 113 => '48', 114 => '60', 115 => '72',
    116 => '84', 117 => '96', 118 => '108', 119 => '120', 120 => '132', 121 => '144',
];

// Normaliza un string para comparar SIN QUE IMPORTEN LOS ESPACIOS EN ABSOLUTO:
// elimina todos los espacios, tabs y saltos de línea (no solo los colapsa).
function normalizar($str) {
    return preg_replace('/\s+/', '', $str);
}

// Inicializar todas las variables dinámicas (hasta 230, por si en el futuro se agregan más)
for ($i = 1; $i <= 230; $i++) {
    ${"respuesta_" . $i} = '';
    ${"verificar_" . $i} = '';
}

$mostrar_solucion = '';
if ($_POST) {
    $mostrar_solucion = isset($_POST['mostrar_solucion']) ? $_POST['mostrar_solucion'] : '';

    if ($mostrar_solucion === 'mostrar_solucion') {
        // Rellenar todas las respuestas con la solución y marcarlas como correctas
        foreach ($correctas as $i => $valor) {
            ${"respuesta_" . $i} = $valor;
            ${"verificar_" . $i} = "correcto";
        }
    } else {
        // Validar cada respuesta enviada contra el array $correctas (los espacios no importan)
        foreach ($correctas as $i => $valor) {
            $enviado = isset($_POST["respuesta_$i"]) ? $_POST["respuesta_$i"] : '';
            ${"respuesta_" . $i} = $enviado; // se muestra tal cual lo escribió el usuario

            $enviado_norm  = normalizar($enviado);
            $correcto_norm = normalizar($valor);

            if ($enviado_norm === $correcto_norm) {
                ${"verificar_" . $i} = "correcto";
            } elseif ($enviado_norm === '') {
                ${"verificar_" . $i} = '';
            } else {
                ${"verificar_" . $i} = "incorrecto";
            }
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
    height: 350vh;
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
<img src="../../img/guia_478.png" alt="" width="900">
<br><br>
<strong>Hay que saber:</strong>
<p>1. Los Controladores son async pero NO retornan datos</p>

<p>2. Los servicios retornan <code>Promise&lt;Datos&gt;</code> → porque devuelven información</p>

 
<p>Enviar respuesta significa: res.json(entidad gestionada por el controller)</p>

<strong>definamos la cabecera del metodo create:</strong>

<p>     
    
<input type="text" name="respuesta_1" value="<?php echo htmlspecialchars($respuesta_1, ENT_QUOTES); ?>" size="51">
 
</p>
<p>luego dentro de un bloque try definimos la constante</p>

<input type="text" name="respuesta_2" value="<?php echo htmlspecialchars($respuesta_2, ENT_QUOTES); ?>" size="85">

<p>Ahora enviamos la respuesta HTTP con estado 201:</p>

<input type="text" name="respuesta_3" value="<?php echo htmlspecialchars($respuesta_3, ENT_QUOTES); ?>" size="30">

<p>Y cerramos el catch:</p>

<input type="text" name="respuesta_4" value="<?php echo htmlspecialchars($respuesta_4, ENT_QUOTES); ?>" size="60">
<br><br>
<button type="submit">Enviar</button>
    <?php echo $verificar_1 ?>
    <?php echo $verificar_2 ?>
    <?php echo $verificar_3 ?>
    <?php echo $verificar_4 ?>
    <hr>

    <img src="../../img/guia_479.png" alt="" width="900">
    <p>vemos que no esta definido: getSalesByEmployee</p>
    <p>Estudiemos el metodo find de model que se llama desde service:</p>
    <pre>

// 1. Sin parámetros - trae TODOS los documentos
async getSales(): Promise &lt SaleDocument[] &gt {
    return await SaleModel.<input type="text" name="respuesta_5" value="<?php echo $respuesta_5; ?>" size="36"> 
}

// 2. Con filtro - trae documentos que coinciden
async getSalesByEmployee(employeeId: string): Promise&ltSaleDocument[]&gt {
    return await SaleModel.<input type="text" name="respuesta_6" value="<?php echo $respuesta_6; ?>" size="36"> 
}

// 3. Con múltiples filtros - trae documentos que coinciden con todos
async getSalesByEmployeeAndDate(employeeId: string, date: string): Promise&ltSaleDocument[]&gt {
    return await SaleModel.<input type="text" name="respuesta_7" value="<?php echo $respuesta_7; ?>" size="36">  
}

// 4. Con opciones avanzadas
async getSalesLimited(): Promise&ltSaleDocument[]&gt {
    return await SaleModel.<input type="text" name="respuesta_8" value="<?php echo $respuesta_8; ?>" size="36">   
}
    </pre>

    <button type="submit">Enviar</button>
    <?php echo $verificar_5 ?>
    <?php echo $verificar_6 ?>
    <?php echo $verificar_7 ?>  
    <?php echo $verificar_8 ?>
    <hr>
    <img src="../../img/guia_480.png" alt="" width="900">
    <br><br>
        <img src="../../img/guia_481.png" alt="" width="900">
    <br><br>
    <pre>
    async getSalesByEmployeeLastMonth(employeeId: string): Promise &lt SaleDocument[] &gt {
        <input type="text" name="respuesta_9" value="<?php echo $respuesta_9; ?>" size="36">
        <input type="text" name="respuesta_10" value="<?php echo $respuesta_10; ?>" size="36">
        <input type="text" name="respuesta_11" value="<?php echo $respuesta_11; ?>" size="43">
         
        <input type="text" name="respuesta_12" value="<?php echo $respuesta_12; ?>" size="36">
         
            <input type="text" name="respuesta_13" value="<?php echo $respuesta_13; ?>" size="36">
             ,
            <input type="text" name="respuesta_14" value="<?php echo $respuesta_14; ?>" size="43">
        });
    }

    </pre>
    <button type="submit">Enviar</button>
     <?php echo $verificar_9 ?>
    <?php echo $verificar_10 ?>
    <?php echo $verificar_11 ?> 
    <?php echo $verificar_12 ?>
    <?php echo $verificar_13 ?>
    <?php echo $verificar_14 ?>
    <hr>
</div>




<div class="seccion derecha">
    <img src="../../img/guia_482.png" alt="" width="900">
    <br><br>
    <p>vamos al test para ver:</p>
    <pre>
jest.spyOn(vehicleService, "markVehicleAsSold").mockResolvedValue(...)
                                                 ↑
                                        Esto te dice que es un método async
    </pre>
    <p>Es decir que tambien debemos definir un metodo markVehicleAsSold en vehicleService</p>
    <img src="../../img/guia_483.png" alt="" width="900">
    <br>
    <p>No se puede acceder a las propiedades porque falta:
    <input type="text" name="respuesta_15" value="<?php echo $respuesta_15; ?>" size="7">
    </p>
    <p>En esta clase SaleService necesitamos importar a 
    <input type="text" name="respuesta_16" value="<?php echo $respuesta_16; ?>" size="11">    
      </p>

    <button type="submit">Enviar</button>
    <?php echo $verificar_15 ?>
    <?php echo $verificar_16 ?>

    <hr>
        <img src="../../img/guia_485.png" alt="" width="900">

    <p>Cuando el método no recibe parámetros pero necesitas filtrar, el filtro va directo como argumento fijo dentro de find(), no como parámetro del método:</p>
    <p><strong>Implementar getSoldVehicles</strong></p>

<pre>
    <input type="text" name="respuesta_17" value="<?php echo $respuesta_17; ?>" size="61"> 
        <input type="text" name="respuesta_18" value="<?php echo $respuesta_18; ?>" size="61">
    }
</pre>

<button type="submit">Enviar</button>
<?php echo $verificar_17 ?>
    <?php echo $verificar_18 ?>
    <hr>

    <pre>
GET    /vehicles          → sin params ni body (lista todo)
GET    /vehicles/:id      → params (cuál)
POST   /vehicles          → <input type="text" name="respuesta_19" value="<?php echo $respuesta_19; ?>" size="7">  (data nueva)
PUT    /vehicles/:id      → params (cuál) + body (qué cambiar)
DELETE /vehicles/:id      → params (cuál)

    </pre>

    <button type="submit">Enviar</button>
<?php echo $verificar_19 ?>
     
    <hr>
    <strong>si desea ver las soluciones escribir: mostrar_solucion</strong>
    <br>
    <input type="text" id="mostrar_solucion" name="mostrar_solucion"  value="<?php echo htmlspecialchars($mostrar_solucion, ENT_QUOTES); ?>">
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