<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   PARCIAL 2 — Interfaces y modelos de Mongoose
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A: recipe.interface.ts --- */
    1  => ['"easy" | "medium" | "hard"', "'easy' | 'medium' | 'hard'"],
    2  => 'Difficulty',
    3  => '?',
    4  => 'Partial',

    /* --- B: recipe.model.ts --- */
    5  => 'mongoose',
    6  => 'RecipeInput',
    7  => 'Document',
    8  => 'Schema',
    9  => 'required',
    10 => 'enum',
    11 => ['easy', '"easy"'],
    12 => 'Number',
    13 => 'Date',
    14 => ['Date.now', 'Date.now()'],
    15 => 'versionKey',
    16 => ['recipes', "'recipes'"],
    17 => 'model',
    18 => ['Recipe', '"Recipe"'],

    /* --- C: ingredient.interface.ts --- */
    19 => 'string',
    20 => 'number',
    21 => 'boolean',
    22 => 'Omit',

    /* --- D: ingredient.model.ts --- */
    23 => ['Types', 'Schema.Types'],
    24 => 'ObjectId',
    25 => 'ref',
    26 => ['Recipe', '"Recipe"'],
    27 => 'required',
    28 => 'Boolean',
    29 => ['false', 'FALSE'],
    30 => ['ingredients', "'ingredients'"],
    31 => 'Ingredient',

    /* --- E: comparacion con el proyecto del curso --- */
    32 => ['timestamps', 'timestamps: true'],
    33 => ['createdAt', 'createdAt: {type: Date, default: Date.now}'],
    34 => ['unique', 'unique: true'],
    35 => ['select', 'select: false'],

    /* --- F: firmas y andamiaje --- */
    36 => 'export interface RecipeDocument extends RecipeInput, Document {',
    37 => 'const recipeSchema = new Schema({',
    38 => 'export interface IngredientDocument extends Document {',

    /* --- G: lineas completas --- */
    39 => 'name: { type: String, required: true },',
    40 => 'difficulty: { type: String, enum: ["easy", "medium", "hard"], default: "easy" },',
    41 => 'createdAt: { type: Date, default: Date.now }',
    42 => 'export const RecipeModel = model<RecipeDocument>("Recipe", recipeSchema);',
    43 => 'recipeId: { type: Schema.Types.ObjectId, ref: "Recipe", required: true },',
    44 => 'optional: { type: Boolean, default: false },',
    45 => 'export const IngredientModel = model<IngredientDocument>("Ingredient", ingredientSchema);',
    46 => 'export type IngredientUpdate = Partial<Omit<IngredientInput, "recipeId">>;',
    47 => 'RecipeInput',
];

$RETOS = [

'recipeInterface' => [
    'titulo' => '<code>src/recipes/recipe.interface.ts</code>',
    'huecos' => [1, 2, 3, 4],
    'codigo' => <<<'EOT'
export type Difficulty = "easy" | "medium" | "hard";

export interface RecipeInput {
    name: string,
    description?: string,
    difficulty?: Difficulty,
    preparationTimeMinutes?: number,
    servings?: number
}

export type RecipeUpdate = Partial<RecipeInput>;
EOT
],

'ingredientInterface' => [
    'titulo' => '<code>src/ingredients/ingredient.interface.ts</code>',
    'huecos' => [19, 20, 21, 22],
    'codigo' => <<<'EOT'
export interface IngredientInput {
    recipeId: string,
    name: string,
    quantity: number,
    unit?: string,
    optional?: boolean,
    notes?: string
}

export type IngredientUpdate = Partial<Omit<IngredientInput, "recipeId">>;
EOT
],

'recipeModel' => [
    'titulo' => '<code>src/recipes/recipe.model.ts</code>',
    'huecos' => [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 36, 37],
    'codigo' => <<<'EOT'
import { Document, Schema, model } from "mongoose";
import { RecipeInput } from "./recipe.interface";

export interface RecipeDocument extends RecipeInput, Document {
    createdAt: Date
}

const recipeSchema = new Schema({
    name: { type: String, required: true },
    description: { type: String },
    difficulty: { type: String, enum: ["easy", "medium", "hard"], default: "easy" },
    preparationTimeMinutes: { type: Number },
    servings: { type: Number },
    createdAt: { type: Date, default: Date.now }
}, { versionKey: false, collection: "recipes" });

export const RecipeModel = model<RecipeDocument>("Recipe", recipeSchema);
EOT
],

'ingredientModel' => [
    'titulo' => '<code>src/ingredients/ingredient.model.ts</code>',
    'huecos' => [23, 24, 25, 26, 27, 28, 29, 30, 31, 38],
    'codigo' => <<<'EOT'
import { Document, Schema, Types, model } from "mongoose";

export interface IngredientDocument extends Document {
    recipeId: Types.ObjectId,
    name: string,
    quantity: number,
    unit?: string,
    optional: boolean,
    notes?: string
}

const ingredientSchema = new Schema({
    recipeId: { type: Schema.Types.ObjectId, ref: "Recipe", required: true },
    name: { type: String, required: true },
    quantity: { type: Number, required: true },
    unit: { type: String },
    optional: { type: Boolean, default: false },
    notes: { type: String }
}, { versionKey: false, collection: "ingredients" });

export const IngredientModel = model<IngredientDocument>("Ingredient", ingredientSchema);
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Que hace exactamente <code>ref: "Recipe"</code> en el campo <code>recipeId</code>?',
        'opciones' => [
            'a' => 'Obliga a MongoDB a comprobar que esa receta existe antes de guardar.',
            'b' => 'Copia la receta dentro del ingrediente.',
            'c' => 'Solo le dice a Mongoose <b>de que modelo</b> es ese ObjectId, para poder usar <code>populate()</code>. No valida nada por si mismo.',
            'd' => 'Crea una llave foranea real en MongoDB.',
        ],
        'correcta' => 'c',
        'porque'   => 'MongoDB no tiene integridad referencial. Por eso en la solucion el <b>service</b> comprueba a mano que la receta exista antes de crear el ingrediente.',
    ],
    'm2' => [
        'texto'    => 'El enunciado pide <code>createdAt (date, default: now)</code>. En la solucion se declara el campo a mano en vez de usar <code>timestamps: true</code>. ¿Por que da igual... casi?',
        'opciones' => [
            'a' => 'Son identicos.',
            'b' => 'Porque <code>timestamps: true</code> agrega <b>dos</b> campos, <code>createdAt</code> y <code>updatedAt</code>, y el enunciado solo pide uno. Las dos opciones son validas, pero declararlo a mano es lo mas literal.',
            'c' => 'Porque <code>timestamps</code> no funciona con enums.',
            'd' => 'Porque el default de Mongoose no admite funciones.',
        ],
        'correcta' => 'b',
        'porque'   => 'Si usas <code>timestamps: {createdAt: true, updatedAt: false}</code> tambien queda exacto. Lo importante es poder explicar por que elegiste una.',
    ],
    'm3' => [
        'texto'    => 'En <code>default: Date.now</code>, ¿por que no se escribe <code>Date.now()</code>?',
        'opciones' => [
            'a' => 'Porque hay que pasar la <b>funcion</b>, no su resultado: si pusieras los parentesis, todos los documentos guardarian el instante en que arranco el servidor.',
            'b' => 'Porque Mongoose no admite parentesis en las opciones.',
            'c' => 'Es indiferente.',
            'd' => 'Porque <code>Date.now()</code> devuelve un string.',
        ],
        'correcta' => 'a',
        'porque'   => 'Es el clasico error de pasar el resultado en vez de la referencia. Mongoose llama a esa funcion cada vez que crea un documento.',
    ],
    'm4' => [
        'texto'    => '<code>enum: ["easy", "medium", "hard"]</code> en el schema, y ademas <code>zEnum(...)</code> en Zod. ¿Es redundante?',
        'opciones' => [
            'a' => 'Si, sobra uno de los dos.',
            'b' => 'No: Zod corta la peticion HTTP en el <b>400</b> antes de tocar la base de datos, y el enum de Mongoose protege la coleccion de cualquier escritura que no venga por esa ruta (un script, un seed, otro endpoint).',
            'c' => 'No, porque Zod no soporta enums.',
            'd' => 'Si, Mongoose ya devuelve 400 solo.',
        ],
        'correcta' => 'b',
        'porque'   => 'Son dos fronteras distintas: una protege la <b>API</b> y la otra protege los <b>datos</b>. Si falla el de Mongoose el error llega como 500, no como 400.',
    ],
    'm5' => [
        'texto'    => '<code>IngredientUpdate = Partial&lt;Omit&lt;IngredientInput, "recipeId"&gt;&gt;</code>. ¿Que consigue?',
        'opciones' => [
            'a' => 'Que todos los campos sean obligatorios menos recipeId.',
            'b' => 'Que <code>recipeId</code> sea opcional.',
            'c' => 'Que <code>recipeId</code> <b>no exista</b> en el tipo de update, y que todo lo demas sea opcional: un ingrediente no se puede mover de receta.',
            'd' => 'Que se borre recipeId de la base de datos al actualizar.',
        ],
        'correcta' => 'c',
        'porque'   => '<code>Omit</code> quita la propiedad del tipo y <code>Partial</code> hace opcional lo que queda. El schema de Zod hace lo mismo en tiempo de ejecucion con <code>.omit({recipeId: true}).partial()</code>.',
    ],
    'm6' => [
        'texto'    => '¿Que aporta <code>versionKey: false</code>?',
        'opciones' => [
            'a' => 'Quita el campo <code>__v</code> que Mongoose agrega por defecto para el control de versiones optimista.',
            'b' => 'Desactiva las validaciones.',
            'c' => 'Impide actualizar el documento.',
            'd' => 'Hace que <code>_id</code> sea un string.',
        ],
        'correcta' => 'a',
        'porque'   => 'Es cosmetico: deja las respuestas JSON mas limpias. No es obligatorio en el parcial.',
    ],
    'm7' => [
        'texto'    => 'En el proyecto del curso, <code>UserDocument</code> extendia <code>UserInput</code>. Aqui <code>IngredientDocument</code> NO extiende <code>IngredientInput</code>. ¿Por que?',
        'opciones' => [
            'a' => 'Por descuido.',
            'b' => 'Porque en el input <code>recipeId</code> es un <code>string</code> (lo que llega por HTTP) y en el documento es un <code>Types.ObjectId</code> (lo que guarda Mongo). Extenderlo daria un choque de tipos.',
            'c' => 'Porque Ingredient no tiene interface.',
            'd' => 'Porque Document ya incluye todo.',
        ],
        'correcta' => 'b',
        'porque'   => 'Es el mismo dato en dos representaciones. Mongoose castea el string a ObjectId al guardar, pero TypeScript no lo sabe.',
    ],
    'm8' => [
        'texto'    => '¿Cuando se aplican los <code>default</code> de Mongoose?',
        'opciones' => [
            'a' => 'Solo al guardar en la base de datos.',
            'b' => 'Al <b>construir el documento</b>: <code>new IngredientModel({...}).optional</code> ya vale <code>false</code> antes de tocar Mongo.',
            'c' => 'Nunca, hay que ponerlos a mano.',
            'd' => 'Solo cuando el campo llega como null.',
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso se pueden probar los modelos sin servidor: <code>new Model({...}).validateSync()</code> y los defaults funcionan igual.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Parcial 2 — Interfaces y modelos', 'Recipe e Ingredient: la forma de los datos y el esquema de Mongoose');
?>

<div class="card">
    <img src="../../img/guia_477.png" alt="">
  <h2>A. <code>src/recipes/recipe.interface.ts</code></h2>

<pre><code>export type Difficulty = <?php hueco(1, 30); ?>;

export interface <?php hueco(47, 12); ?> {
    name: <?php hueco(19, 8); ?>,
    description<?php hueco(3, 3); ?>: <?php hueco(20, 8); ?>,
    difficulty?: <?php hueco(2, 12); ?>,
    preparationTimeMinutes?: <?php hueco(21, 8); ?>,
    servings?: <?php hueco(22, 8); ?>
}

export type RecipeUpdate = <?php hueco(4, 9); ?>&lt;RecipeInput&gt;;</code></pre>

  <div class="nota">El <code>?</code> marca el campo como opcional. Solo <code>name</code> es
     requerido segun el enunciado, asi que todo lo demas lo lleva. Y como el PUT es parcial,
     el tipo de update hace opcional <b>todo</b> de golpe.</div>

  <?php reto('recipeInterface'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>src/recipes/recipe.model.ts</code></h2>

<pre><code>import { Document, <?php hueco(8, 8); ?>, model } from "<?php hueco(5, 10); ?>";
import { RecipeInput } from "./recipe.interface";

<?php firma(36, 56); ?>

    createdAt: <?php hueco(13, 6); ?>
}

<?php firma(37, 36); ?>

    name: { type: String, <?php hueco(9, 10); ?>: true },
    description: { type: <?php hueco(23, 8); ?> },
    difficulty: { type: String, <?php hueco(10, 6); ?>: ["easy", "medium", "hard"], default: "<?php hueco(11, 7); ?>" },
    preparationTimeMinutes: { type: <?php hueco(12, 8); ?> },
    servings: { type: <?php hueco(24, 8); ?> },
    createdAt: { type: Date, default: <?php hueco(14, 10); ?> }
}, { <?php hueco(15, 12); ?>: false, collection: "<?php hueco(16, 10); ?>" });

export const RecipeModel = <?php hueco(17, 7); ?>&lt;RecipeDocument&gt;("<?php hueco(18, 8); ?>", recipeSchema);</code></pre>

  <p>Y las dos piezas que faltan de la interfaz: extiende
     <code><?php hueco(6, 12); ?></code> (para heredar los campos) y
     <code><?php hueco(7, 10); ?></code> (para heredar <code>_id</code> y compania de Mongoose).</p>

  <?php reto('recipeModel'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
    <img src="../../img/guia_476.png" alt="">
  <h2>C. <code>src/ingredients/ingredient.interface.ts</code></h2>

<pre><code>export interface IngredientInput {
    recipeId: <?php hueco(19, 8); ?>,
    name: <?php hueco(25, 8); ?>,
    quantity: <?php hueco(20, 8); ?>,
    unit?: <?php hueco(26, 8); ?>,
    optional?: <?php hueco(21, 9); ?>,
    notes?: <?php hueco(27, 8); ?>
}

export type IngredientUpdate = Partial&lt;<?php hueco(22, 6); ?>&lt;IngredientInput, "recipeId"&gt;&gt;;</code></pre>

  <div class="avisoflujo">Fijate en el <code>recipeId: string</code>. Por HTTP llega como texto;
     dentro de Mongo vive como <code>ObjectId</code>. Son el mismo dato en dos formas, y por eso
     <code>IngredientDocument</code> no puede extender <code>IngredientInput</code>.</div>

  <?php reto('ingredientInterface'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. <code>src/ingredients/ingredient.model.ts</code></h2>

<pre><code>import { Document, Schema, Types, model } from "mongoose";

<?php firma(38, 52); ?>

    recipeId: <?php hueco(23, 8); ?>.<?php hueco(24, 10); ?>,
    name: <?php hueco(28, 8); ?>,
    quantity: <?php hueco(29, 8); ?>,
    unit?: <?php hueco(30, 8); ?>,
    optional: <?php hueco(31, 9); ?>,
    notes?: <?php hueco(32, 8); ?>
}

const ingredientSchema = new Schema({
    recipeId: { type: Schema.Types.ObjectId, <?php hueco(25, 5); ?>: "<?php hueco(26, 8); ?>", <?php hueco(27, 10); ?>: true },
    name: { type: String, required: true },
    quantity: { type: Number, required: true },
    unit: { type: String },
    optional: { type: <?php hueco(33, 9); ?>, default: <?php hueco(34, 7); ?> },
    notes: { type: String }
}, { versionKey: false, collection: "<?php hueco(35, 13); ?>" });

export const IngredientModel = model&lt;IngredientDocument&gt;("<?php hueco(36, 12); ?>", ingredientSchema);</code></pre>

  <?php reto('ingredientModel'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Que cambia respecto al proyecto del curso</h2>

  <p>El modelo de <code>User</code> que estudiaste usaba otras opciones. Completa la comparacion:</p>

<div class="tablabox">
<table class="tabla">
  <tr><th>En el curso (User)</th><th>En el parcial (Recipe / Ingredient)</th></tr>
  <tr>
    <td class="cod">{ <?php hueco(32, 12); ?>: true }<br>
        <span style="font-family:inherit;font-size:13px;color:#5a636e">agrega
        <code>createdAt</code> Y <code>updatedAt</code></span></td>
    <td>El campo <?php hueco(33, 12); ?> declarado a mano,
        porque el enunciado solo pide <b>uno</b></td>
  </tr>
  <tr>
    <td class="cod">email: { <?php hueco(34, 9); ?>: true }</td>
    <td>Aqui <b>ningun</b> campo es unico</td>
  </tr>
  <tr>
    <td class="cod">password: { <?php hueco(35, 9); ?>: false }</td>
    <td>Aqui <b>no</b> hay campos ocultos</td>
  </tr>
</table>
</div>

  <div class="nota">Eso significa que en este parcial <b>no</b> necesitas el truco del segundo
     parametro de <code>findByEmail</code>: no hay ningun campo con <code>select: false</code>
     que haya que pedir aparte.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. De memoria: escribe la linea completa</h2>

  <?php linea(39, 'El campo <b>name</b> de Recipe:'); ?>
  <?php linea(40, 'El campo <b>difficulty</b>, con su enum y su valor por defecto:'); ?>
  <?php linea(41, 'El campo <b>createdAt</b>, con el default del enunciado:'); ?>
  <?php linea(42, 'La creacion y exportacion del <b>modelo Recipe</b>:'); ?>
  <?php linea(43, 'El campo <b>recipeId</b> del ingrediente, con su referencia:'); ?>
  <?php linea(44, 'El campo <b>optional</b>, con su default:'); ?>
  <?php linea(45, 'La creacion y exportacion del <b>modelo Ingredient</b>:'); ?>
  <?php linea(46, 'El tipo de <b>update</b> del ingrediente, que impide cambiarlo de receta:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
