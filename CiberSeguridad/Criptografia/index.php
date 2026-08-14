<?php
/* ==========================================================================
   CiberSeguridad / Criptografia
   Fuente: notas_3.pdf (Tab 5, preguntas 1 a 9 + transposicion)
   Estilo: definicion completa escrita, con las palabras clave en blanco.
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- el mapa, ahora con huecos --- */
    1  => ['criptografia'],
    2  => ['criptoanalisis'],
    3  => ['sustitucion', 'substitution'],
    4  => ['transposicion', 'transposition'],
    5  => ['simetrico', 'simetrica'],
    6  => ['asimetrico', 'asimetrica'],

    /* --- definiciones --- */
    7  => ['crear', 'construir'],
    8  => ['romper', 'atacar'],
    9  => ['cifrado', 'encryption'],
    10 => ['texto plano', 'plaintext', 'texto claro'],
    11 => ['texto cifrado', 'ciphertext'],
    12 => ['descifrado', 'decryption'],
    13 => ['cambian', 'se sustituyen'],
    14 => ['orden', 'la posicion', 'posicion'],

    /* --- longitud de clave --- */
    15 => ['combinaciones'],
    16 => ['duplica'],
    17 => ['128'],

    /* --- Cesar --- */
    18 => ['HWDUYTLWFUMD NX KZS', 'HWDUYTLWFUMDNXKZS'],
    19 => ['XJHZWNYD'],
    20 => ['HASH'],
    21 => ['ATTACK'],

    /* --- Vigenere --- */
    22 => ['BOATBOATBOATBOATB'],
    23 => ['DFYIUCGKBDHRJGFNO'],
    24 => ['polialfabetico', 'polialfabetica', 'polyalphabetic'],

    /* --- transposicion --- */
    25 => ['LGROH'],
    26 => ['EOTNT'],
    27 => ['TPYI'],
    28 => ['SATG'],
    29 => ['LGROH EOTNT TPYI SATG', 'LGROHEOTNTTPYISATG'],

    /* --- simetrico vs asimetrico --- */
    30 => ['clave', 'clave secreta'],
    31 => ['descifrar'],
    32 => ['publica'],
    33 => ['privada'],
    34 => ['lentos', 'mas lentos'],

    /* --- hash --- */
    35 => ['fija'],
    36 => ['una sola', 'un solo sentido', 'unico', 'irreversible'],
    37 => ['avalancha'],
    38 => ['64'],
    39 => ['128'],
    40 => ['sustituto', 'hash', 'huella'],
    41 => ['comparar', 'compara'],
    42 => ['sal', 'salt'],
    43 => ['lentas', 'lenta'],
    44 => ['integridad'],
];

$TEXTO = range(1, 44);

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Por que una clave larga es mas segura que una corta?',
        'opciones' => [
            'a' => 'Porque el algoritmo se vuelve secreto',
            'b' => 'Porque aumenta el numero de combinaciones posibles que hay que probar: <b>cada bit extra duplica</b> el trabajo del criptoanalista',
            'c' => 'Porque el cifrado se vuelve mas rapido',
            'd' => 'Porque las claves largas no se pueden copiar'
        ],
        'correcta' => 'b',
        'porque'   => 'Es crecimiento exponencial: una clave de n bits tiene 2<sup>n</sup> posibilidades. Pasar de 127 a 128 bits <b>duplica</b> el espacio de busqueda.'
    ],
    'm2' => [
        'texto'    => '&iquest;Cual es la diferencia entre criptografia y criptoanalisis?',
        'opciones' => [
            'a' => 'La criptografia crea algoritmos seguros; el criptoanalisis intenta romperlos',
            'b' => 'El criptoanalisis crea algoritmos y la criptografia los rompe',
            'c' => 'Son sinonimos',
            'd' => 'La criptografia es teorica y el criptoanalisis es la implementacion'
        ],
        'correcta' => 'a',
        'porque'   => 'Una construye, la otra ataca. Son las dos caras de la criptologia.'
    ],
    'm3' => [
        'texto'    => 'En el cifrado <b>Cesar</b>, &iquest;que le pasa a las letras?',
        'opciones' => [
            'a' => 'Se reordenan sin cambiar',
            'b' => 'Cada letra se <b>sustituye</b> por otra, desplazada un numero fijo de posiciones',
            'c' => 'Se eliminan las vocales',
            'd' => 'Se convierten a numeros'
        ],
        'correcta' => 'b',
        'porque'   => 'Cesar es <b>sustitucion</b>: A&rarr;F, B&rarr;G, C&rarr;H con desplazamiento 5. Los simbolos cambian.'
    ],
    'm4' => [
        'texto'    => 'En la <b>transposicion</b>, &iquest;que le pasa a las letras?',
        'opciones' => [
            'a' => 'Cada una se reemplaza por otra del alfabeto',
            'b' => 'No cambian: son <b>las mismas letras</b>, solo cambia el orden en que se leen',
            'c' => 'Se duplican',
            'd' => 'Se convierten a hexadecimal'
        ],
        'correcta' => 'b',
        'porque'   => 'Esa es la frase clave: en transposicion la L sigue siendo L. Solo cambia la <b>posicion</b>. Por eso el texto cifrado tiene exactamente las mismas letras que el original.'
    ],
    'm5' => [
        'texto'    => '&iquest;Por que el Vigenere se llama cifrado <b>polialfabetico</b>?',
        'opciones' => [
            'a' => 'Porque usa varios idiomas',
            'b' => 'Porque el desplazamiento <b>cambia</b> en cada letra segun la clave, en vez de ser uno solo fijo',
            'c' => 'Porque usa el alfabeto griego',
            'd' => 'Porque cifra dos veces'
        ],
        'correcta' => 'b',
        'porque'   => 'Cesar usa un unico alfabeto desplazado (mono-alfabetico). Vigenere usa uno distinto por posicion, marcado por la clave. Por eso resiste el analisis de frecuencias.'
    ],
    'm6' => [
        'texto'    => '&iquest;Cual es el problema principal de los cifrados <b>simetricos</b>?',
        'opciones' => [
            'a' => 'Que son muy lentos',
            'b' => 'Que hay que <b>compartir la clave secreta</b> de forma segura; si alguien la obtiene, puede descifrar los mensajes y hacerse pasar por los usuarios',
            'c' => 'Que solo funcionan con texto en ingles',
            'd' => 'Que necesitan dos claves distintas'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la paradoja del huevo y la gallina: para intercambiar mensajes seguros necesitas ya un canal seguro por donde mandar la clave.'
    ],
    'm7' => [
        'texto'    => '&iquest;Cual es la ventaja y cual la desventaja de los cifrados <b>asimetricos</b>?',
        'opciones' => [
            'a' => 'Ventaja: son mas rapidos. Desventaja: usan una sola clave',
            'b' => 'Ventaja: resuelven el intercambio de claves usando clave publica y privada. Desventaja: son <b>mas lentos</b> que los simetricos',
            'c' => 'Ventaja: no necesitan clave. Desventaja: son inseguros',
            'd' => 'Ventaja: la clave privada se puede publicar. Desventaja: ocupan mas espacio'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso en la practica se combinan: se usa asimetrico para <b>acordar</b> una clave y simetrico para <b>cifrar</b> los datos, que es lo pesado.'
    ],
    'm8' => [
        'texto'    => 'Calculaste el hash de tu nombre en mayusculas y en minusculas y salieron <b>completamente</b> distintos. &iquest;Como se llama esa propiedad?',
        'opciones' => [
            'a' => 'Colision',
            'b' => 'Efecto avalancha',
            'c' => 'Sal (salting)',
            'd' => 'Difusion de clave'
        ],
        'correcta' => 'b',
        'porque'   => 'Un cambio minimo en la entrada produce una salida totalmente diferente. Si no fuera asi, se podria adivinar el mensaje comparando hashes parecidos.'
    ],
    'm9' => [
        'texto'    => 'Una clave de 128 bits. &iquest;Cuantas combinaciones posibles hay?',
        'opciones' => [
            'a' => '128',
            'b' => '128<sup>2</sup>',
            'c' => '2<sup>128</sup>',
            'd' => '128!'
        ],
        'correcta' => 'c',
        'porque'   => 'Cada bit es un si/no independiente: 2 &times; 2 &times; ... 128 veces = 2<sup>128</sup>. Y añadir el bit 129 lo <b>duplica</b> otra vez.'
    ],

    /* ---------- hash: para que sirve ---------- */
    'h1' => [
        'texto'    => '&iquest;Cual es la diferencia de fondo entre <b>cifrar</b> y <b>hashear</b>?',
        'opciones' => [
            'a' => 'Ninguna, hashear es cifrar con otra palabra',
            'b' => 'El cifrado es <b>reversible</b> (con la clave vuelves al original); el hash es de <b>una sola via</b>: no existe forma de deshacerlo',
            'c' => 'El hash usa clave y el cifrado no',
            'd' => 'El cifrado solo sirve para texto y el hash para archivos'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso el hash no sirve para guardar algo que necesites recuperar. Sirve justo para lo contrario: guardar una prueba de algo que <b>no</b> quieres poder recuperar.'
    ],
    'h2' => [
        'texto'    => 'Un sitio guarda el <b>hash</b> de tu contraseña en vez de la contraseña. Si te roban la base de datos, &iquest;a quien protege eso?',
        'opciones' => [
            'a' => 'Al sitio, porque asi no lo demandan',
            'b' => 'A <b>ti</b>: el atacante se lleva hashes, no tus contraseñas, asi que no puede entrar a tu cuenta ahi ni en los otros sitios donde reutilizas la misma',
            'c' => 'A nadie, es solo una formalidad',
            'd' => 'Al servidor, porque ocupa menos espacio'
        ],
        'correcta' => 'b',
        'porque'   => 'El daño real de una filtracion no es solo esa cuenta: es que la gente repite contraseñas. El hash corta esa cadena.'
    ],
    'h3' => [
        'texto'    => 'Si el sitio no puede deshacer el hash, &iquest;como verifica que escribiste bien la contraseña al entrar?',
        'opciones' => [
            'a' => 'La descifra con su clave privada',
            'b' => 'Le aplica <b>el mismo hash</b> a lo que acabas de escribir y compara los dos resultados; si coinciden, era la buena',
            'c' => 'Te la pregunta al correo',
            'd' => 'Compara solo los primeros caracteres'
        ],
        'correcta' => 'b',
        'porque'   => 'Funciona porque el hash es <b>determinista</b>: la misma entrada da siempre la misma salida. El sistema te autentica sin llegar a saber nunca tu secreto.'
    ],
    'h4' => [
        'texto'    => 'Dos usuarios ponen la misma contraseña <code>123456</code>. Sin proteccion extra, sus hashes salen <b>identicos</b>. &iquest;Por que es un problema?',
        'opciones' => [
            'a' => 'Porque ocupa el doble de espacio',
            'b' => 'Porque el atacante puede precalcular los hashes de las contraseñas comunes una sola vez y romper a todos los usuarios de golpe (tablas rainbow)',
            'c' => 'Porque el sistema se confunde de usuario',
            'd' => 'No es un problema'
        ],
        'correcta' => 'b',
        'porque'   => 'La solucion es la <b>sal</b>: un valor aleatorio distinto por usuario que se mezcla antes de hashear. Asi el atacante tiene que atacar cada cuenta por separado.'
    ],
    'h5' => [
        'texto'    => 'SHA-256 es rapidisimo. Para guardar contraseñas, &iquest;eso es bueno o malo?',
        'opciones' => [
            'a' => 'Bueno, el login responde mas rapido',
            'b' => '<b>Malo</b>: si tu puedes calcular millones de hashes por segundo, el atacante tambien. Para contraseñas se usan funciones <b>lentas</b> a proposito',
            'c' => 'Da igual, la velocidad no influye',
            'd' => 'Malo, pero solo en servidores viejos'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso existen Argon2id, scrypt y bcrypt: estan diseñadas para consumir tiempo y memoria y hacer inviable la fuerza bruta. SHA-256 a secas <b>no</b> es apropiado para contraseñas.'
    ],
    'h6' => [
        'texto'    => 'Descargas un ISO y la pagina publica su SHA-256. Lo calculas y coincide. &iquest;Que acabas de comprobar?',
        'opciones' => [
            'a' => 'Que el archivo es confidencial',
            'b' => 'Su <b>integridad</b>: no se corrompio en la descarga ni lo alteraron por el camino',
            'c' => 'Que el archivo esta cifrado',
            'd' => 'Que el archivo esta disponible'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el otro gran uso del hash, y engancha con la triada CIA: el hash es la herramienta tipica de la <b>integridad</b>. Tambien es la base de las firmas digitales y del no repudio.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('3 · Criptografia', 'notas_3 (Tab 5) — Cesar, Vigenere, transposicion, simetrico/asimetrico, hash');
?>

<div class="card">
  <h2>1. El mapa</h2>
  <p>Reconstruyelo de memoria. Si esto te sale solo, el resto de la pagina es mecanica.</p>

  <pre><code>CRIPTOLOGIA
├── <?php hueco(1, 16); ?>  -> construir algoritmos seguros
└── <?php hueco(2, 16); ?>  -> romperlos

Dos operaciones fundamentales:
├── <?php hueco(3, 16); ?>  -> las letras CAMBIAN    (Cesar, Vigenere)
└── <?php hueco(4, 16); ?>  -> las letras se REORDENAN

Dos familias de cifrado:
├── <?php hueco(5, 14); ?>  -> una sola clave     -> problema: compartirla
└── <?php hueco(6, 14); ?>  -> publica + privada  -> resuelve eso, pero es mas lento</code></pre>

  <?php enviar(); ?>
  <div class="nota">No importan mayusculas ni tildes. Los textos cifrados tambien se aceptan
    en minusculas.</div>
</div>


<div class="card">
  <h2>2. Las definiciones</h2>

  <p>La <b>criptografia</b> es la ciencia de <?php hueco(7, 10); ?>
     algoritmos seguros para proteger la informacion. El <b>criptoanalisis</b> es la ciencia
     que intenta <?php hueco(8, 10); ?> esos algoritmos.</p>

  <p>Las dos operaciones fundamentales de la criptografia son:
     el <?php hueco(9, 12); ?> , que transforma el mensaje original
     (<?php hueco(10, 14); ?>) en un mensaje ilegible llamado
     <?php hueco(11, 14); ?> ; y el <?php hueco(12, 13); ?> ,
     que lo transforma de vuelta al mensaje original.</p>

  <p>En la <b>sustitucion</b> los simbolos <?php hueco(13, 12); ?> :
     A&rarr;F, B&rarr;G, C&rarr;H. En la <b>transposicion</b> las letras no cambian,
     solo cambia el <?php hueco(14, 10); ?> en que se leen.</p>

  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Longitud de la clave</h2>

  <p>Una clave larga es mas segura porque aumenta el numero de
     <?php hueco(15, 15); ?> posibles que un atacante tiene que probar.
     Cada bit adicional <?php hueco(16, 10); ?> el trabajo necesario para
     que un criptoanalista rompa la clave.</p>

  <p>Por eso una clave de <?php hueco(17, 6); ?> bits tiene 2<sup>128</sup> posibilidades.</p>

  <?php mc('m1'); ?>
  <?php mc('m9'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Cifrado Cesar (+5)</h2>
  <p>Desplazas cada letra 5 posiciones hacia adelante en el alfabeto ingles.
     Si te pasas de la Z, vuelves a empezar por la A.</p>
  <pre><code>A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
+5:
F G H I J K L M N O P Q R S T U V W X Y Z A B C D E</code></pre>

  <p>El del taller:</p>
  <?php linea(18, 'cifra <code>CRYPTOGRAPHY IS FUN</code> con Cesar +5', 'texto cifrado...'); ?>
  <?php ayuda('C&rarr;H, R&rarr;W, Y&rarr;D... y sigue. Los espacios se respetan.'); ?>

  <p>Dos mas para practicar el mecanismo:</p>
  <?php linea(19, 'cifra <code>SECURITY</code> con Cesar +5', 'texto cifrado...'); ?>
  <?php linea(20, '<b>descifra</b> <code>MFXM</code> (retrocede 5)', 'texto original...'); ?>
  <?php linea(21, '<b>descifra</b> <code>FYYFHP</code>', 'texto original...'); ?>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Cifrado Vigenere con clave <code>BOAT</code></h2>
  <p>Cada letra de la clave dice cuanto desplazar: <code>B</code>=+1, <code>O</code>=+14,
     <code>A</code>=+0, <code>T</code>=+19. La clave se repite hasta cubrir el mensaje.</p>

  <p>Texto plano: <code>CRYPTOGRAPHYISFUN</code> (17 letras).</p>
  <?php linea(22, 'escribe la <b>clave repetida</b> debajo, letra a letra, hasta completar las 17', 'BOATBOAT...'); ?>
  <?php linea(23, 'ahora el resultado cifrado', 'texto cifrado...'); ?>
  <?php ayuda('C+B = D, R+O = F, Y+A = Y, P+T = I... el resultado empieza por <code>DFYI</code>.'); ?>

  <p>Vigenere es un cifrado de sustitucion <?php hueco(24, 18); ?>
     porque el desplazamiento cambia en cada letra, en vez de ser uno solo fijo.</p>

  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Transposicion</h2>
  <p>Se escribe <code>LET'S GO PARTY TONIGHT</code> en una matriz de <b>4 columnas</b>
     y en vez de leer por filas se lee por <b>columnas</b>:</p>

  <pre><code>L E T S
G O P A
R T Y T
O N I G
H T</code></pre>

  <?php linea(25, 'primera columna, leida hacia abajo', 'columna 1...'); ?>
  <?php linea(26, 'segunda columna', 'columna 2...'); ?>
  <?php linea(27, 'tercera columna', 'columna 3...'); ?>
  <?php linea(28, 'cuarta columna', 'columna 4...'); ?>
  <?php linea(29, 'el mensaje cifrado completo (las cuatro columnas seguidas)', 'mensaje cifrado...'); ?>

  <div class="nota">Fijate: el resultado tiene <b>exactamente las mismas 18 letras</b> que el
    original, solo desordenadas. Eso es lo que lo separa de Cesar, donde los simbolos si cambian.</div>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Simetrico vs. asimetrico</h2>

  <p>El principal problema de los cifrados <b>simetricos</b> es compartir la
     <?php hueco(30, 14); ?> de forma segura. Si otra persona la obtiene,
     podria hacerse pasar por los usuarios y <?php hueco(31, 11); ?> los mensajes.</p>

  <p>Los <b>asimetricos</b> resuelven el problema del intercambio de claves porque utilizan dos:
     la clave <?php hueco(32, 10); ?> , que puede compartirse con cualquiera, y la clave
     <?php hueco(33, 10); ?> , que permanece secreta.
     Su desventaja es que son mas <?php hueco(34, 10); ?> que la criptografia simetrica.</p>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Funciones hash: para que sirven de verdad</h2>

  <p>Una funcion hash toma una entrada de cualquier tamaño y devuelve una salida de longitud
     <?php hueco(35, 8); ?> . Va en <?php hueco(36, 13); ?> direccion:
     del original al hash se puede, del hash al original <b>no</b>.</p>

  <div class="avisoflujo">
    <b>Y aqui esta el para que.</b> Un sitio no necesita <em>saber</em> tu contraseña: solo
    necesita <em>comprobar</em> que la sabes. Asi que en vez del valor real guarda un
    <?php hueco(40, 12); ?> , y cuando entras vuelve a hashear lo que escribiste
    para <?php hueco(41, 10); ?> los dos resultados.
    <br><br>
    Si le roban la base de datos, el atacante se lleva hashes, no contraseñas. Eso no protege
    al sitio: te protege <b>a ti</b>, y sobre todo protege las <em>otras</em> cuentas donde
    usas la misma contraseña. Y de paso te protege del propio sitio, porque ni sus
    administradores llegan a ver tu secreto.
  </div>

  <p>Pero el hash a secas no basta. Dos problemas y sus dos remedios:</p>
  <ul>
    <li>Si dos personas eligen la misma contraseña, sale el <b>mismo</b> hash, y el atacante
        puede precalcular los de las contraseñas comunes. Se arregla añadiendo a cada usuario
        un valor aleatorio distinto llamado <?php hueco(42, 8); ?> .</li>
    <li>SHA-256 es rapidisimo, y eso juega a favor del que prueba millones por segundo.
        Para contraseñas se usan funciones deliberadamente
        <?php hueco(43, 10); ?> como Argon2id, scrypt o bcrypt.</li>
  </ul>

  <p>El otro gran uso del hash es comprobar que un archivo o un mensaje no fue alterado.
     Eso es exactamente el principio de la triada que se llama
     <?php hueco(44, 14); ?> , y es tambien la base de las firmas digitales
     y del no repudio.</p>

  <h3>La propiedad del taller</h3>
  <p>Sacaste el SHA-256 y el SHA-512 de tu nombre en mayusculas y en minusculas: el unico
     cambio fue la capitalizacion y los hashes salieron totalmente distintos. Esa propiedad
     se llama efecto <?php hueco(37, 12); ?> .</p>

  <table class="datos">
    <tr><th>Funcion</th><th>bits</th><th>caracteres hex</th></tr>
    <tr><td>SHA-256</td><td>256</td><td><?php hueco(38, 6); ?></td></tr>
    <tr><td>SHA-512</td><td>512</td><td><?php hueco(39, 6); ?></td></tr>
  </table>
  <?php ayuda('Cada caracter hexadecimal representa 4 bits, asi que basta con dividir los bits entre 4.'); ?>

  <?php mc('h1'); ?>
  <?php mc('h2'); ?>
  <?php mc('h3'); ?>
  <?php mc('h4'); ?>
  <?php mc('h5'); ?>
  <?php mc('h6'); ?>
  <?php mc('m8'); ?>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Riesgos/index.php', '../Normas/index.php');
